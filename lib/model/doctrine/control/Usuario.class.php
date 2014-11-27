<?php

/**
 * Usuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class Usuario extends BaseUsuario {
    const FOLDER = "Usuarios";

    public function __toString() {
        $result = $this->getCaNombre();
        if (!$this->getCaActivo()) {
            $result .=" (Inactivo)";
        }
        return $result;
    }

    public function getNivelAcceso($rutina) {

        $acceso = Doctrine::getTable("AccesoUsuario")
                        ->createQuery("a")
                        ->where('a.ca_login = ?', $this->getCaLogin())
                        ->addWhere('a.ca_rutina = ?', $rutina)
                        ->addOrderBy('a.ca_acceso DESC')
                        ->fetchOne();

        if ($acceso) {
            return $acceso->getCaAcceso();
        } else {
            $acceso = Doctrine::getTable("AccesoPerfil")
                            ->createQuery("a")
                            ->innerJoin("a.Perfil p")
                            ->innerJoin("p.UsuarioPerfil up")
                            ->where('up.ca_login = ?', $this->getCaLogin())
                            ->addWhere('a.ca_rutina = ?', $rutina)
                            ->addOrderBy('a.ca_acceso DESC')
                            ->fetchOne();
            if ($acceso) {
                return $acceso->getCaAcceso();
            }
        }
        return -1;
    }

    public function getFirmaHTML() {

        $sucursal = $this->getSucursal();
        $empresa = $sucursal->getEmpresa();
        $resultado = "<strong>" . Utils::replace(strtoupper($this->getCaNombre())) . "</strong><br />";
        $resultado .= $this->getCaCargo() . "-" . strtoupper($empresa->getCaNombre()) . "<br />";

        if ($sucursal) {
            $resultado .= $sucursal->getCaDireccion() . "<br />";
            $resultado .= "Tel.: " . $sucursal->getCaTelefono() . " " . $this->getCaExtension() . "<br />";
            $resultado .= "Fax.: " . $sucursal->getCaFax() . "<br />";
            $resultado .= "Cod. Postal: " . $sucursal->getCaCodpostal() . "<br />";
        }
        $resultado .= Utils::replace($sucursal->getCaNombre()) . "-" . $empresa->getTrafico()->getCaNombre() . "<br />";
        $resultado .= "<a href=\"http://" . $empresa->getCaUrl() . "\">" . $empresa->getCaUrl() . "</a>";
        return $resultado;
    }

    public function getFirma() {
        $sucursal = $this->getSucursal();
        $empresa = $sucursal->getEmpresa();
        $resultado = Utils::replace(strtoupper($this->getCaNombre())) . "\n";
        $resultado .= $this->getCaCargo() . "\n" . strtoupper($empresa->getCaNombre()) . ".\n";

        if ($sucursal) {
            $resultado .= $sucursal->getCaDireccion() . "\n";
            $resultado .= "Tel.: " . $sucursal->getCaTelefono() . " " . $this->getCaExtension() . "\n";
            $resultado .= "Fax.: " . $sucursal->getCaFax() . "\n";
            $resultado .= "Cod. Postal: " . $sucursal->getCaCodpostal() . "\n";
        }
        $resultado .= $sucursal->getCaNombre() . " - " . $empresa->getTrafico()->getCaNombre();
        $resultado .= "http://" . $empresa->getCaUrl();
        return $resultado;
    }
    
    public function getFirmaOtmHTML($company) {
        $sucursaltmp = $this->getSucursal();
        
            if($company=="coltrans.com.co")
            {
                if($sucursaltmp->getCaNombre()==Constantes::BOGOTA )
                {
                    $idsucursal="BOG";
                    $ext="161-201-260-460";
                }
                else if($sucursaltmp->getCaNombre()==Constantes::MEDELLIN )
                    $idsucursal="MDE";
                else
                {
                    $idsucursal="BOG";
                    $ext="161-201-260-460";
                }
                
            }
            else if($company=="consolcargo.com")
            {
                $idsucursal="CBO";
                $ext="129-132";
            }
            else if($company=="colotm.com")
            {
                $idsucursal="OBO";
                $ext="161-201-260-460";
            }
            if($this->getCaLogin()=="yaurrea")
                $idsucursal="OBO";
            
            
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal); 
        
        
        $empresa = $sucursal->getEmpresa();
        $resultado = "<strong>" . Utils::replace(strtoupper($this->getCaNombre())) . "</strong><br />";
        $resultado .= $this->getCaCargo() . "\n" . strtoupper($empresa->getCaNombre()) . "<br />";

        if ($sucursal) {
            $resultado .= $sucursal->getCaDireccion() . "<br />";
            $resultado .= "Tel.: " . $sucursal->getCaTelefono() . " " . (($ext!="")?$ext:$this->getCaExtension()) . "<br />";
            $resultado .= "Fax.: " . $sucursal->getCaFax() . "<br />";
            $resultado .= "Cod. Postal: " . $sucursal->getCaCodpostal() . "<br />";
        }
        $resultado .= $sucursal->getCaNombre() . " - " . $empresa->getTrafico()->getCaNombre(). "<br />";
        $resultado .= "<a href=\"http://" . $empresa->getCaUrl() . "\">" . $empresa->getCaUrl() . "</a>";
        return $resultado;
    }

    public function setPasswd($passwd) {
        $salt = hash("md5", uniqid(rand(), true));
        $this->setCaPasswd(sha1($passwd . $salt));
        $this->setCaSalt($salt);
    }

    public function checkPasswd($passwd, &$error="", &$errorno="") {
        if ($this->getCaActivo()) {
            $username = $this->getCaLogin();
            $ldap_auth_enabled = sfConfig::get("app_ldap_auth_enabled");
            if (!$ldap_auth_enabled) {
                $this->setCaAuthmethod("sha1");
            }

            if ($this->getCaAuthmethod() == "ldap") {
                //$auth_user = "cn=" . $username . ",o=coltrans_bog";
                // CN=CARLOS GILBERTO LOPEZ MENDEZ,OU=Sistemas,OU=Usuarios,OU=Coltrans_Bog,DC=COLTRANS,DC=LOCAL
                $auth_user = $username . "@COLTRANS.LOCAL";
                $ldap_server = sfConfig::get("app_ldap_host");
                
                $connect = ldap_connect($ldap_server);
                if ($connect) {
                    if (@$bind = ldap_bind($connect, $auth_user, utf8_encode($passwd))) {
                        try {
                            $this->stopBlaming();
                            $this->setPasswd($passwd);
                            $this->save();
                        } catch (Exception $e) {
                            //echo $e->getMessage();
                        }
                        return true;
                    } else {
                        $error = ldap_error($connect);
                        $errorno = ldap_errno($connect);
                    }
                    ldap_close($connect);
                }
            }

            if ($this->getCaAuthmethod() == "sha1") {
                return $this->getCaPasswd() == sha1($passwd . $this->getCaSalt());
            }
        }
        return false;
    }

    public function getDirectorio() {
        $folder = self::FOLDER;
        return $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $this->getDirectorioBase();
    }

    public function getDirectorioBase() {
        $folder = self::FOLDER;
        return $directory = $folder . DIRECTORY_SEPARATOR . $this->getCaLogin();
    }

    public function getImagenBase($tamano='120x150') {

        switch ($tamano) {
            case '120x150':
                $imagen = $this->getDirectorioBase() . DIRECTORY_SEPARATOR . 'foto120x150.jpg';
                break;
            case '60x80':
                $imagen = $this->getDirectorioBase() . DIRECTORY_SEPARATOR . 'foto60x80.jpg';
                break;
            case '30x40':
                $imagen = $this->getDirectorioBase() . DIRECTORY_SEPARATOR . 'foto30x40.jpg';
                break;
            default:
                $imagen = $this->getDirectorioBase() . DIRECTORY_SEPARATOR . 'foto120x150.jpg';
                break;
        }
        

        return $imagen;
    }

    public function getImagen($tamano='120x150') {

        switch ($tamano) {
            case '120x150':
                $imagen = $this->getDirectorio() . DIRECTORY_SEPARATOR . 'foto120x150.jpg';
                break;
            case '60x80':
                $imagen = $this->getDirectorio() . DIRECTORY_SEPARATOR . 'foto60x80.jpg';
                break;
            case '30x40':
                $imagen = $this->getDirectorio() . DIRECTORY_SEPARATOR . 'foto30x40.jpg';
                break;
            default:
                $imagen = $this->getDirectorio() . DIRECTORY_SEPARATOR . 'foto120x150.jpg';
                break;
        }

        if( !file_exists($imagen)){
            $imagen =  sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR. Usuario::FOLDER. DIRECTORY_SEPARATOR . "nologin60x80.jpg";
        }
        return $imagen;

        
    }

    public function getImagenUrl($tamano='120x150') {
        $baseUrl = "";
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        
        if($app == "intranet")
            $baseUrl = "/intranet";
        
        if (file_exists($this->getImagen($tamano))) {
            $imagen = $baseUrl."/gestDocumental/verArchivo/folder/" . base64_encode($this->getDirectorioBase()) . "/idarchivo/" . base64_encode("foto" . $tamano . ".jpg");
        } else {
            $imagen = $baseUrl."/gestDocumental/verArchivo/folder/" . base64_encode(Usuario::FOLDER) . "/idarchivo/" . base64_encode("nologin60x80.jpg");
        }

        return $imagen;
    }

    public function getEsJefe($login) {

        if ($this->getCaManager() == $login) {
            return true;
        }

        if (!$this->getCaManager() && $login != $this->getCaLogin()) {
            return false;
        }

        $manager = $this->getManager();

        if (!$manager) {
            return true;
        }

        return $manager->getEsJefe($login);
    }

    public function updateLuceneIndex() {

        $index = $this->getTable()->getLuceneIndex();

        // remove an existing entry

        $hits = $index->find('ca_login:' . $this->getCaLogin());
        foreach ($hits as $hit) {

            $index->delete($hit->id);
        }

        // don't index expired and non-activated jobs
        if (!$this->getCaActivo()) {
            return;
        }

        $doc = new Zend_Search_Lucene_Document();

        // store job primary key URL to identify it in the search results
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('pk', $this->getCaLogin()));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_login', $this->getCaLogin()));

        // index job fields
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_nombre', utf8_encode($this->getCaNombre()), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_nombres', utf8_encode($this->getCaNombres()), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_apellidos', utf8_encode($this->getCaApellidos()), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_cargo', utf8_encode($this->getCaCargo()), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_sucursal', utf8_encode($this->getSucursal()->getCaNombre()), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('ca_empresa', utf8_encode($this->getSucursal()->getEmpresa()->getCaNombre()), 'utf-8'));

        // add job to the index
        $index->addDocument($doc);
        $index->commit();
    }
    
        
    /*public function save(Doctrine_Connection $conn = null) {
        // ...

        $conn = $conn ? $conn : $this->getTable()->getConnection();
        $conn->beginTransaction();
        try {
            $ret = parent::save($conn);

            $this->updateLuceneIndex();

            $conn->commit();

            return $ret;
        } catch (Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }

    // lib/model/doctrine/JobeetJob.class.php
    public function delete(Doctrine_Connection $conn = null) {
        $index = UsuarioTable::getLuceneIndex();

        if ($hit = $index->find('pk:' . $this->getCaLogin())) {
            $index->delete($hit->id);
        }

        return parent::delete($conn);
    }*/

    public function getDirectorioIp() {
        $directorio = Doctrine::getTable("Directorio")
                        ->createQuery("d")
                        ->select('d.ca_phoneip')
                        ->addWhere('d.ca_callfrom=?', sfContext::getInstance()->getUser()->getIdSucursal())
                        ->addWhere('d.ca_callto=?', $this->getCaIdsucursal())
                        ->fetchOne();
        return $directorio;
    }
    
    public function getCaSucursal(){
        $suc = Doctrine::getTable("Sucursal")->find($this->getCaIdsucursal());  
        if( $suc ){
            return $suc->getCaNombre();
        }
    }
    
    function getEncrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
           $result.=$char;
        }
        return base64_encode($result);
    }
    
    function getDecrypt($string, $key) {
        $result = '';
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)-ord($keychar));
           $result.=$char;
        }
        return $result;
    }
    
    function getLogoHtml($idempresa){
        
        switch($idempresa){
            case 1:
                $link = 'http://www.coltrans.com.co/logosoficiales/colmas/ColmasSmall.png';
                break;
            case 2:
                $link = 'http://www.coltrans.com.co/logosoficiales/coltrans/ColtransSmall.png';
                break;
            case 4:
                $link = 'http://www.coltrans.com.co/logosoficiales/consolcargo/ConsolcargoSmall.png';
                break;
            case 8:
                $link = 'http://www.coltrans.com.co/logosoficiales/colotm/logo_colotm.png';
                break;
            default:
                $link = "";
        }
        
        return $link;
    }
    
    public function getGrupoEmpresarial() {
        
        $sucursal = Doctrine::getTable("Sucursal")->find($this->getCaIdsucursal());
        $grupoColtrans = array(1,2,6,8);
        
        if(in_array($sucursal->getCaIdempresa(), $grupoColtrans))
            $idempresa = $grupoColtrans;
        else
            $idempresa = array($sucursal->getCaIdempresa());
        
        return $idempresa; 
    }
    
    public function emailUsuario($login,$asunto,$direccion,$tiempoCumplido,$fchingreso, $grupoEmp = array()){
        
        $user = Doctrine::getTable('Usuario')->find(sfContext::getInstance()->getUser()->getUserId());
        $usuario = Doctrine::getTable("Usuario")->find($login);
        $idempresa = $usuario->getSucursal()->getEmpresa()->getCaIdempresa();             
        //if($idempresa == 1 || $idempresa == 2 || $idempresa == 8){
        $logo = $usuario->getLogoHtml($idempresa);        
        //$sucursal = $usuario->getSucursal()->getCaNombre();
        $parametros = ParametroTable::retrieveByCaso("CU239");
        $remitente = array();
        $destinatarios = array();
        foreach($parametros as $parametro){
            $remitente[$parametro->getCaIdentificacion()] = $parametro->getCaValor2();
            $destinatarios[$parametro->getCaIdentificacion()] = $parametro->getCaValor();
        }
            
        $email = new Email();
        $email->setCaUsuenvio($asunto=="address"||$asunto=="desvinculacion"?$user->getCaLogin():$login);
        $email->setCaIdcaso(null);
        $email->setCaFrom($asunto=="address"?$user->getCaEmail():$remitente[$idempresa]);
        $email->setCaFromname($asunto=="address"?$user->getCaNombre():"TALENTO HUMANO");
        $email->setCaCc($asunto=="address"?$usuario->getCaEmail():"");
        $email->setCaReplyto($asunto=="address"?$usuario->getCaEmail():"");

        switch ($asunto) {
            case "address":
                $subject = 'Cambio de direcci�n Colaborador '.strtoupper($usuario->getSucursal()->getEmpresa()->getCaNombre())." ".$usuario->getSucursal()->getCaNombre();
                if( $sucursal != "Bogot� D.C." ){
                    $cargo = 'Jefe Dpto. Administrativo';
                }else{            
                    $cargo = 'Jefe Dpto. Talento Humano';
                }

                $recips = Doctrine::getTable("Usuario")
                        ->createQuery('u')
                        ->innerJoin('u.Sucursal s')
                        ->addWhere('s.ca_nombre = ?', $sucursal)
                        ->addWhere('u.ca_activo=?', true)
                        ->addWhere('u.ca_cargo=?', $cargo)
                        ->execute();
                foreach ($recips as $recip) {
                    if ($recip->getCaEmail()) {
                        $email->addTo(str_replace(" ", "", $recip->getCaEmail()));
                    }
                }
                $tipo = "Cambio de Direccion";
                break;
            case "ingreso":
                $subject = 'Ingreso Nuevo Colaborador '.strtoupper($usuario->getSucursal()->getEmpresa()->getCaNombre())." ".$usuario->getSucursal()->getCaNombre();
                $tipo = "Nuevo Colaborador";
                break;
            case "desvinculacion":
                $subject = 'Desvinculaci�n Colaborador '.strtoupper($usuario->getSucursal()->getEmpresa()->getCaNombre())." ".$usuario->getSucursal()->getCaNombre();
                $tipo = "Desvinculacion";
                break;
            case "reconocimiento":
                $subject = 'Reconocimiento Especial: '.$usuario->getCaNombre()." ".strtoupper($usuario->getSucursal()->getEmpresa()->getCaNombre())." ".$usuario->getSucursal()->getCaNombre();
                $email->addTo("kcamacho@coltrans.com.co");
                $email->addTo("jraute@coltrans.com.co");
                $email->addTo("thomaspeters@coltrans.com.co");
                $tipo = "Reconocimiento";
                break;
            case "cumpleanos":
                $fecha = date('Y-m-d');
                $dia = date('N');
                $finDeSemana = "";
                if($dia>=5){
                    $finDeSemana = " & FIN DE SEMANA";
                }
                $subject = 'FELIZ CUMPLEA�OS '.$fecha.$finDeSemana;
                $tipo = "Cumpleanos";
                break;                
        }
        $email->setCaTipo($tipo);
        $email->setCaSubject($subject);

        if($asunto=="ingreso" || $asunto == "desvinculacion" || $asunto == "cumpleanos"){
            //$email->setCaAddress("empleados-nal@coltrans.com.co");
            //$email->addTo("colmasnal@colmas.com.co");
            //$email->addTo("colotmnal@colotm.com");
            foreach($grupoEmp as $empresa){
                if($destinatarios[$empresa] != "null")
                    $email->addTo($destinatarios[$empresa]);
                else {
                    //$correos = array();
                    $correos = $email->getDirectorioCorp($empresa);
                    foreach($correos as $correo){
                        $email->addCC($correo);
                    }
                    break;
                }
            }
        }

        $request = sfContext::getInstance()->getRequest();
        $request->setParameter('direccion', $direccion);
        $request->setParameter('login', $login);
        $request->setParameter("format", "email" );	
        $request->setParameter("asunto", $asunto);
        $request->setParameter('logo', $logo);
        $request->setParameter('tiempo', $tiempoCumplido);
        $request->setParameter('fchingreso', $fchingreso);
        $request->setParameter('grupoEmp', $grupoEmp);
        $texto= sfContext::getInstance()->getController()->getPresentationFor( 'adminUsers', 'emailIntranet');

        $email->setCaBodyhtml($texto);
        $email->save();        
    }
}