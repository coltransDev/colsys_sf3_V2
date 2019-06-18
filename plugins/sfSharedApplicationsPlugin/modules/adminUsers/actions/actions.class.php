    <?php

/**
 * adminUsers actions.
 *
 * @package    colsys
 * @subpackage adminUsers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
//implementamos la función        


class adminUsersActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    const RUTINA_COLSYS = 73;
    const RUTINA_INTRANET = 98;

    public function getNivel() {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        //return 1;
        switch ($app) {
            case "colsys":
                $rutina = adminUsersActions::RUTINA_COLSYS;
                break;
            case "intranet":
                $rutina = adminUsersActions::RUTINA_INTRANET;
                break;
        }

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        
        if ($this->nivel<0 && $app=="intranet" ) {
            $this->nivel = 0;
        }

        //$this->forward404Unless($this->nivel>=0);
        if ($this->nivel == -1) {
            $this->forward404();
        }        

        return $this->nivel;
    }

    public function executeDirectory(sfWebRequest $request) {
        

        $this->empresas = Doctrine::getTable("Empresa")
                        ->createQuery("e")
                        ->addWhere('e.ca_activo=?', true)
                        ->addOrderBy("e.ca_nombre")
                        ->execute();

        $this->departamentos = Doctrine::getTable("Departamento")
                        ->createQuery("d")
                        ->select("d.ca_idempresa, d.ca_nombre")
                        ->innerJoin('d.Empresa e')
                        ->addOrderBy("d.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->departamentos as $key => $val) {
            $this->departamentos[$key]["ca_nombre"] = utf8_encode($this->departamentos[$key]["ca_nombre"]);
        }

        $this->sucursales = Doctrine::getTable("Sucursal")
                        ->createQuery("s")
                        ->select("s.ca_idsucursal, s.ca_idempresa, s.ca_nombre")
                        ->innerJoin('s.Empresa e')
                        ->addOrderBy("s.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->sucursales as $key => $val) {
            $this->sucursales[$key]["ca_nombre"] = utf8_encode($this->sucursales[$key]["ca_nombre"]);
        }
    }

    

    public function executeFormUsuario($request) {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->userinicio = sfContext::getInstance()->getUser();
        $userinicio = Doctrine::getTable('Usuario')->find($this->userinicio->getUserId());
        $this->grupoEmp = $userinicio->getGrupoEmpresarial();
        
        $this->nivel = $this->getNivel();

        $this->key = $request->getParameter("key");
        
        if ($this->usuario) {
            $this->manager = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
            $this->manager = $this->manager->getManager();
        }

        switch ($app) {
            case "intranet":
                
                break;
        }
        if (!($this->nivel == 0 and $request->getParameter("login") == $this->getUser()->getUserId())) {
            if ( $this->nivel < 2 ) {
                $this->forward("adminUsers", "noAccess");
            }
        }

        if (!$this->usuario) {
            $this->usuario = new Usuario();
        }

        $this->departamentos = Doctrine::getTable("Departamento")
                        ->createQuery("d")
                        ->select("d.ca_idempresa, d.ca_nombre")
                        ->innerJoin('d.Empresa e')
                        ->addOrderBy("d.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->departamentos as $key => $val) {
            $this->departamentos[$key]["ca_nombre"] = utf8_encode($this->departamentos[$key]["ca_nombre"]);
        }

        $this->sucursales = Doctrine::getTable("Sucursal")
                        ->createQuery("s")
                        ->select("s.ca_idsucursal, s.ca_idempresa, s.ca_nombre")
                        ->innerJoin('s.Empresa e')
                        ->addOrderBy("s.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->sucursales as $key => $val) {
            $this->sucursales[$key]["ca_nombre"] = utf8_encode($this->sucursales[$key]["ca_nombre"]);
        }

        $this->cargos = Doctrine::getTable("Cargo")
                        ->createQuery("c")
                        ->select('c.ca_cargo, c.ca_idempresa')
                        ->innerJoin('c.Empresa e')
                        ->addWhere('c.ca_activo = ?', true)
                        ->addOrderBy("c.ca_cargo")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->cargos as $key => $val) {
            $this->cargos[$key]["ca_cargo"] = utf8_encode($this->cargos[$key]["ca_cargo"]);
        }

        $this->jefes = Doctrine::getTable("Usuario")
                        ->createQuery("j")
                        ->select('j.ca_login, j.ca_nombre, j.ca_cargo, c.ca_idempresa')
                        ->innerJoin('j.Cargo c')
                        ->innerJoin('c.Empresa e')
                        ->addWhere('j.ca_activo = ?', true)
                        ->addWhere('c.ca_manager= ?', true)
                        ->addOrderBy("j.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        //->limit(2)
                        ->execute();
        
        foreach ($this->jefes as $key => $val) {
            $this->jefes[$key]["j_ca_nombre"] = utf8_encode($this->jefes[$key]["j_ca_nombre"]);
            $this->jefes[$key]["j_ca_cargo"] = utf8_encode($this->jefes[$key]["j_ca_cargo"]);            
        }
        
        $this->claves = Doctrine::getTable("UsuarioClave")
                        ->createQuery("uc")
                        ->innerJoin('uc.Usuario u')
                        ->addWhere("u.ca_login = ? ", $request->getParameter("login"))
                        ->addOrderBy("uc.ca_fchcreado DESC")
                        ->limit(1)
                        ->execute();
                        
        
        /*$this->hijos = Doctrine::getTable("Hijos")
                        ->createQuery("h")
                        ->select('h.ca_login, h.ca_nombres, h.ca_fchnacimiento')
                        ->innerJoin('h.Usuario u')
                        ->addWhere('h.ca_login = ?', $request->getParameter("login"))
                        ->addOrderBy("h.ca_nombres")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        foreach ($this->hijos as $key => $val) {
            $this->hijos[$key]["h_ca_nombres"] = $this->hijos[$key]["h_ca_nombres"];
        }*/

        $this->empresas = Doctrine::getTable("Empresa")
                        ->createQuery("e")
                        ->addWhere('e.ca_activo=?', true)
                        ->addOrderBy("e.ca_nombre")
                        ->execute();

        $m = Doctrine::getTable('Usuario')
            ->createQuery('u')
            ->addWhere('u.ca_activo = ?', true);
        $this->users = $m->execute();

        $p = Doctrine_Manager::getInstance()->connection();
        $query = "SELECT DISTINCT ca_tiposangre";
        $query.= "	from control.tb_usuarios";
        $query.= "  order by ca_tiposangre ASC";
        $this->tiposangre = $p->execute($query);
        
        $q = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("s.ca_idsucursal")
                ->andWhereIn("s.ca_idempresa",$this->grupoEmp)
                ->andWhere("s.ca_nombre = ?", $userinicio->getSucursal()->getCaNombre())
                ->orderBy("s.ca_idsucursal")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        
        foreach($q as $key => $val){
            $s[] = $val["s_ca_idsucursal"];
        }
        //echo "<pre>";print_r($q);echo "</pre>";
        $suc = implode("|",$s);
        
        $this->parentescos = ParametroTable::retrieveByCaso('CU093');
        $this->nivestudios = ParametroTable::retrieveByCaso('CU105');
        $this->fcesantias = ParametroTable::retrieveByCaso('CU225');
        $this->estados = ParametroTable::retrieveByCaso('CU240');
        $this->comites = ParametroTable::retrieveByCaso('CU241');
        $this->zonas = ParametroTable::retrieveByCaso('CU242',null,$suc);
        $this->sexo = array("F","M");
        
        $datos = json_decode(utf8_encode($this->usuario->getCaDatos()));
        $this->subc = $datos->subcontratado;
        
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("tabpane/tabpane", 'last');
        $response->addStylesheet("tabpane/luna/tab", 'last');
        
        $this->app = $app;
        
    }
    
    /*
     * Formulario de hoja de vida colmas web
     */
    public function executeFormColmas($request) {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless( $usuario );
        $this->userinicio = sfContext::getInstance()->getUser();
        $this->nivel = $this->getNivel();

        
        if ( $this->nivel !=1 ) {
            $this->forward("adminUsers", "noAccess");
        }
        
        
        if( $request->isMethod("post") ){
            
            
           
            if ($request->getParameter("cargo_web")) {
                $usuario->setCaCargoweb($request->getParameter("cargo_web"));
            }else{
                $usuario->setCaCargoweb( null );
            }
            
            if ($request->getParameter("docidentidad")) {
                $docidentidad = $request->getParameter("docidentidad");
                $docidentidad =str_replace(".", "", $docidentidad);
                $docidentidad =str_replace(",", "", $docidentidad);
                $docidentidad =str_replace(" ", "", $docidentidad);
                $docidentidad =str_replace("-", "", $docidentidad);
                $usuario->setCaDocidentidad($docidentidad);
            }else{
                $usuario->setCaDocidentidad( null );
            }   
                        
            if ($request->getParameter("experiencia")) {
                $usuario->setCaExperiencia(strtoupper($request->getParameter("experiencia")));
            }else{
                $usuario->setCaExperiencia( null );    
            }
            
            if ($request->getParameter("profesion")) {
                $usuario->setCaProfesion(strtoupper($request->getParameter("profesion")));
            }else{
                $usuario->setCaProfesion( null );    
            }
            
            if ($request->getParameter("hoja_vida")) {
                $usuario->setCaHojaVida($request->getParameter("hoja_vida"));
            }else{
                $usuario->setCaHojaVida( null );    
            }
            
            
            
            
            $usuario->save();
            $this->redirect("adminUsers/viewUser?login=".$usuario->getCaLogin());
        }
        
        $this->usuario = $usuario;
        
        $this->cargos_web = ParametroTable::retrieveByCaso("CU109");
       
    }
    
    public function executeIndexExt5(sfWebRequest $request) {
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        
        switch ($app) {
            case "intranet":
                $this->setLayout("layout1col");                
            break;
        }
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $editarCargos = UsuarioTable::getUsuariosxPerfilxUsuario("administrar-cargos-intranet", $this->getUser()->getUserId());        
        $this->permisos = !count($editarCargos)>0?false:true;
        
        $this->app = $app;
    }
    
    function executeDatosIndex($request) {
        $idopcion = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Opciones","leaf" => true,"id" => "1");
        
        $nameZ = utf8_encode("Zonas de Evacuación");
        
        $zonas = ParametroTable::retrieveByCaso("CU242");
        
        foreach($zonas as $zona){
            $childrenZonas[] = array(
                "text" => utf8_encode(substr($zona->getCaValor(),0,strpos($zona->getCaValor(),":"))),
                "leaf" => true,
                "id" => "z".$zona->getCaIdentificacion(),
                "descripcion"=> utf8_encode(substr($zona->getCaValor(),strpos($zona->getCaValor(),":")+1,strlen($zona->getCaValor()))),
                "nzonas"=>count($zonas)
            );
        }
        if($idopcion==0){
            $childrens[] = array("text" => "Usuarios","leaf" => true,"id" => "10", "iconCls"=> 'fa fa-users');            
            $childrens[] = array("text" => "Cargos","leaf" => true,"id" => "20", "iconCls"=>"fa fa-briefcase");
            $childrens[] = array("text" => "Hijos","leaf" => true,"id" => "30", "iconCls"=>"fa fa-child");
            $childrens[] = array("text" => "Sucursales","leaf" => true,"id" => "40", "iconCls"=>"fa fa-globe");
            $childrens[] = array("text" => "Departamentos","leaf" => true,"id" => "50", "iconCls"=>"fa fa-building");
            $childrens[] = array("text" => $nameZ,"leaf" => false,"id" => "60", "iconCls"=>"fa fa-life-ring", "children"=>$childrenZonas);
        }        

        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }
    
    function executeDatosUsuarios($request) {
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $mostrarInactivos = $request->getParameter("mostrarInactivos");
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $q = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_docidentidad, u.ca_login, u.ca_nombre, u.ca_departamento, u.ca_cargo, s.ca_idsucursal, s.ca_nombre, e.ca_idempresa, e.ca_nombre"
                        .",u.ca_email, u.ca_extension, u.ca_activo, u.ca_cumpleanos, u.ca_fchingreso, u.ca_nombres, (u.ca_papellido ||' '|| u.ca_sapellido) as ca_apellidos, u.ca_telparticular, ca_telfamiliar"
                        .",u.ca_movil, u.ca_direccion, m.ca_nombre, u.ca_tiposangre, u.ca_nombrefamiliar, u.ca_parentesco, u.ca_nivestudios, u.ca_estrato, u.ca_donante"    
                        .",u.ca_enfermedad, u.ca_alergico, u.ca_sexo, (SELECT dd.ca_value FROM ColsysConfigValue dd WHERE ca_idconfig = 218 and ca_ident = u.ca_fcesantias) as fcesantias"
                        .",(SELECT ec.ca_value FROM ColsysConfigValue ec WHERE ec.ca_idconfig = 239 and ec.ca_ident = ub.ca_ecivil) as ecivil, u.ca_datos->'subcontratado' as ca_subcontratado, u.ca_fchcreado, u.ca_fchactualizado")
                ->leftJoin('u.Sucursal s')
                ->leftJoin('s.Empresa e')
                ->leftJoin('u.Manager m')
                ->leftJoin('u.UsuBrigadas ub')
                //->addWhere('u.ca_activo = ?', true)
                ->andWhereIn("s.ca_idempresa", $grupoEmp)
                ->andWhere("u.ca_login not in ('web','falabella','Comercial','comercialmed','comercialbaq','auxaduana','comercial-baq','comercial-med','consolcargo', 'coltrans', 'comercial-clo')")
                ->addOrderBy("u.ca_login ASC");
                //->limit(500);                
        
        if($mostrarInactivos=="true"){
            $q->addWhere("u.ca_activo = ?", false);                
        }else{
            $q->addWhere("u.ca_activo = ?", true);                
        }
        
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                
        $debug = $q->getSqlQuery();        
        $usuarios = $q->execute();
        
        foreach($usuarios as $key=>$val){
            $usuarios[$key]["u_ca_nombre"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_nombre")]);
            $usuarios[$key]["u_ca_departamento"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_departamento")]);
            $usuarios[$key]["u_ca_cargo"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_cargo")]);
            $usuarios[$key]["s_ca_nombre"]=utf8_encode($usuarios[$key][utf8_encode("s_ca_nombre")]);
            $usuarios[$key]["e_ca_nombre"]=utf8_encode($usuarios[$key][utf8_encode("e_ca_nombre")]);            
            $usuarios[$key]["m_ca_nombre"]=utf8_encode($usuarios[$key][utf8_encode("m_ca_nombre")]);            
            $usuarios[$key]["u_ca_extension"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_extension")]);
            $usuarios[$key]["u_ca_nombres"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_nombres")]);
            $usuarios[$key]["u_ca_apellidos"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_apellidos")]);
            $usuarios[$key]["u_ca_telparticular"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_telparticular")]);
            $usuarios[$key]["u_ca_direccion"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_direccion")]);
            $usuarios[$key]["u_ca_alergico"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_alergico")]);
            $usuarios[$key]["u_ca_nombrefamiliar"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_nombrefamiliar")]);
            $usuarios[$key]["u_ca_parentesco"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_parentesco")]);
            $usuarios[$key]["u_ca_nivestudios"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_nivestudios")]);
            $usuarios[$key]["u_ca_enfermedad"]=utf8_encode($usuarios[$key][utf8_encode("u_ca_enfermedad")]);
            $usuarios[$key]["u_fcesantias"]=utf8_encode($usuarios[$key][utf8_encode("u_fcesantias")]);
            $usuarios[$key]["u_ecivil"]=utf8_encode($usuarios[$key][utf8_encode("u_ecivil")]);
        }
        
        //echo "<pre>";print_r($usuarios);echo "</pre>";
        $this->responseArray = array("success" => true, "root" => $usuarios, "total" =>count($usuarios) ,"debug"=>$debug,"idempresa"=>$grupoEmp);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarUsuario($request) {
       
        $conn = Doctrine::getTable("Usuario")->getConnection();
        $conn->beginTransaction();
        
        $config = sfConfig::get("app_soap_adminUsers");
        
        $user = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $user->getGrupoEmpresarial();
       
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $datos = json_decode(utf8_encode($usuario->getCaDatos()));
        $new = $request->getParameter("key");
        $this->nivel = $this->getNivel();
       
        $nuevo = 0;
        $cambiodireccion = 0;

        if ($usuario) {
            if($new == "new"){
                $this->redirect("adminUsers/noAccess?key=".$new);
            }
            $direccion = $usuario->getCaDireccion();
            $activo = $usuario->getCaActivo();
        }
        
        if (!($this->nivel == 0 and $request->getParameter("login") == $this->getUser()->getUserId())) {
            if (!($this->nivel > 1)) {
                $this->forward("users", "noAccess");
            }
        }
        if (!$usuario) {
            $nuevo = 1;
            $usuario = new Usuario();
            if(!$request->getParameter("login")){
                $this->redirect("adminUsers/noAccess?login=null");
            }else{
                $usuario->setCaLogin(strtolower($request->getParameter("login")));
            }
        }
        
        if ($request->getParameter("nombre")) {
            $usuario->setCaNombre(ucwords(strtolower($request->getParameter("nombre"))));
        }

        if ($request->getParameter("cargo")) {
            $usuario->setCaCargo($request->getParameter("cargo"));
        }

        if ($request->getParameter("departamento")) {
            $usuario->setCaDepartamento($request->getParameter("departamento"));
        }

        if ($request->getParameter("idsucursal")) {
            $usuario->setCaIdsucursal($request->getParameter("idsucursal"));
        }
        
        if($request->getParameter("subcontrato")){
            $datos->subcontratado = true;            
        }else{
            $datos->subcontratado = false;            
        }
        
        $usuario->setCaDatos(json_encode($datos));

        if ($request->getParameter("email")) {
            $usuario->setCaEmail($request->getParameter("email"));
        }
        
        if ($request->getParameter("clave_email")) {
            $pasw = $request->getParameter("clave_email");
            $key = hash("md5", uniqid(rand(), true));            
            $usuario->setCaKeypass($key);
            $clave = $usuario->getEncrypt($pasw, $key);
            $usuario->setCaMailpasw($clave);
        }
        
        if ($request->getParameter("extension")) {
            $usuario->setCaExtension($request->getParameter("extension"));
        }

        if ($request->getParameter("auth_method")) {
            $usuario->setCaAuthmethod($request->getParameter("auth_method"));
        }

        if ($request->getParameter("passwd1") && $request->getParameter("passwd1") == $request->getParameter("passwd2")) {
            $usuario->setPasswd($request->getParameter("passwd1"));
            $usuario->setCaFchvencimiento(Utils::calcularVencimientoClave());
        }
        
        if(( $this->nivel>=2 && in_array($usuario->getSucursal()->getCaIdempresa(),$grupoEmp)) || $this->nivel>=3){
            
            if ($request->getParameter("activo")) {
                $usuario->setCaActivo(true);
            }else{
                $usuario->setCaActivo(false);           
            }
            
            if ($request->getParameter("forcechange")) {
                $usuario->setCaForcechange(true);
            } else {
                $usuario->setCaForcechange(false);
            }       
        }
        if (isset($_FILES['foto'])) {
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {

                $directory = $usuario->getDirectorio() . DIRECTORY_SEPARATOR;
                if (!is_dir($directory)) {
                    @mkdir($directory, 0777, true);
                }
                
                $nombre_archivo = $directory . 'foto.jpg';
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $nombre_archivo)) {
                    
                    // Obtener nuevos tamaños
                    list($ancho, $alto) = getimagesize($nombre_archivo);
                    $nuevo_ancho = 120;
                    $nuevo_alto = 150;

                    // Cargar
                    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                    $origen = imagecreatefromjpeg($nombre_archivo);

                    // Cambiar el tamaño
                    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                    // Imprimir
                    imagejpeg($thumb, $usuario->getDirectorio() . DIRECTORY_SEPARATOR . 'foto120x150.jpg', 100);

                    $nuevo_ancho = 60;
                    $nuevo_alto = 80;

                    // Cargar
                    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                    $origen = imagecreatefromjpeg($nombre_archivo);

                    // Cambiar el tamaño
                    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                    // Imprimir
                    imagejpeg($thumb, $usuario->getDirectorio() . DIRECTORY_SEPARATOR . 'foto60x80.jpg', 100);
                }
            }
        }
    
        if($this->nivel>0){
            if ($request->getParameter("cumpleanos")) {
                $usuario->setCaCumpleanos($request->getParameter("cumpleanos"));
            }else{
                $usuario->setCaCumpleanos( null );
            }

            if ($request->getParameter("fchingreso")) {
                $usuario->setCaFchingreso($request->getParameter("fchingreso"));
            }

            if ($request->getParameter("nombres")) {
                $usuario->setCaNombres(strtoupper($request->getParameter("nombres")));
            }else{
                $usuario->setCaNombres( null );
            }

            /*if ($request->getParameter("apellidos")) {
                $usuario->setCaApellidos(strtoupper($request->getParameter("apellidos")));
            }else{
                $usuario->setCaApellidos( null );
            }*/
            if ($request->getParameter("papellido")) {
                $usuario->setCaPapellido(strtoupper($request->getParameter("papellido")));
            }else{
                $usuario->setCaPapellido( null );
            }
            if ($request->getParameter("sapellido")) {
                $usuario->setCaSapellido(strtoupper($request->getParameter("sapellido")));
            }else{
                $usuario->setCaSapellido( null );
            }
        }
        
        if ($request->getParameter("tiposangre")) {
            $usuario->setCaTiposangre($request->getParameter("tiposangre"));
        }else{
            $usuario->setCaTiposangre( null );
        }
        if ($request->getParameter("docidentidad")) {
            $usuario->setCaDocidentidad($request->getParameter("docidentidad"));
        }else{
            $usuario->setCaDocidentidad( null );
        }
        if ($request->getParameter("estrato")) {
            $usuario->setCaEstrato($request->getParameter("estrato"));
        }else{
            $usuario->setCaEstrato( null );
        }
        if ($request->getParameter("sexo")) {
            $usuario->setCaSexo($request->getParameter("sexo"));
        }else{
            $usuario->setCaSexo( null );
        }
        if ($request->getParameter("nivestudio")) {
            $usuario->setCaNivestudios($request->getParameter("nivestudio"));
        }else{
            $usuario->setCaNivestudios( null );
        }
        if ($request->getParameter("donante")) {
            $usuario->setCaDonante(true);
        } else {
            $usuario->setCaDonante(false);
        }
        
        if ($request->getParameter("chk_enfermedad")=='on') {
            if ($request->getParameter("enfermedad")) {
                $usuario->setCaEnfermedad($request->getParameter("enfermedad"));
            } else {
                $usuario->setCaEnfermedad($request->getParameter("enfermedad"));
            }
        }else{
            $usuario->setCaEnfermedad(null);
        }
        if ($request->getParameter("chk_alergico")=='on') {
            if ($request->getParameter("alergico")) {
                $usuario->setCaAlergico($request->getParameter("alergico"));
            } else {
                $usuario->setCaAlergico($request->getParameter("alergico"));
            }
        }else{
            $usuario->setCaAlergico(null);
        }

        if ($request->getParameter("telparticular")) {
            $usuario->setCaTelparticular($request->getParameter("telparticular"));
        }else{
            $usuario->setCaTelparticular( null );
        }

        if ($request->getParameter("telfamiliar")) {
            $usuario->setCaTelfamiliar($request->getParameter("telfamiliar"));
        }else{
            $usuario->setCaTelfamiliar( null );
        }

        if ($request->getParameter("nombrefamiliar")) {
            $usuario->setCaNombrefamiliar(strtoupper($request->getParameter("nombrefamiliar")));
        }else{
            $usuario->setCaNombrefamiliar(null);            
        }

        if ($request->getParameter("movil")) {
            $usuario->setCaMovil($request->getParameter("movil"));
        }else{
            $usuario->setCaMovil( null );           
        }

        if ($request->getParameter("manager")) {
            $usuario->setCaManager($request->getParameter("manager"));
        }

        if ($request->getParameter("direccion")) {
            $usuario->setCaDireccion($request->getParameter("direccion"));
        }else{
            $usuario->setCaDireccion( null );
        }
        
        if ($request->getParameter("parentesco")) {
            $usuario->setCaParentesco($request->getParameter("parentesco"));
        }else{
            $usuario->setCaParentesco( null );
        }
        
        if ($request->getParameter("fcesantias")) {
            $usuario->setCaFcesantias($request->getParameter("fcesantias"));
        }else{
            $usuario->setCaFcesantias( null );
        }
        
        $usuario->save( $conn );
        
        $usuBrigadas = $usuario->getUsuBrigadas();
        
        if(!$usuBrigadas->getCaLogin())
            $usuBrigadas->setCaLogin($usuario->getCaLogin());
        
        if ($request->getParameter("zona")) {
            $usuBrigadas->setCaZona($request->getParameter("zona"));
        }
        
        if ($request->getParameter("estado")) {
            $usuBrigadas->setCaEcivil($request->getParameter("estado"));
        }
        
        $comites = ParametroTable::retrieveByCaso('CU241');
        
        foreach($comites as $comite){
            if ($request->getParameter("comite".$comite->getCaIdentificacion())) {
                $ids[] = $comite->getCaIdentificacion();
                if ($request->getParameter("comite_pr".$comite->getCaIdentificacion()))
                    $obs[$comite->getCaIdentificacion()]["obs"] = $request->getParameter("comite_pr".$comite->getCaIdentificacion());
            }
        }
        
        $usuBrigadas->setCaComites(implode("|",$ids));        
        $usuBrigadas->setCaPropiedades(null);
        foreach($obs as $key=>$val){            
            $usuBrigadas->setProperty("comite".$key, $val["obs"] );
        }
        $usuBrigadas->save($conn);
        
        $conn->commit();
        
//        if( $config["updateUser"] ){
//            ProjectConfiguration::registerZend();   
//            $wsdl_uri = $config["wsdl_uri"];            
//            $client = new Zend_Soap_Client( $wsdl_uri, array('encoding'=>'ISO-8859-1'));        
//            $error =  $client->updateUser( sfConfig::get("app_soap_secret"),serialize($usuario) );
//            
//            if( $error ){
//                throw new Exception( $error );                
//            }
//        }
        
        $login = $usuario->getCaLogin();
        $usuario = Doctrine::getTable("Usuario")->find($login);
        
        //Reporta al Jefe Administrativo el cambio de dirección de un empleado
        if ($nuevo == 0) {
            if ($direccion != $usuario->getCaDireccion()) {
                $asunto = "address";
                $usuario->emailUsuario($login,$asunto,$direccion,null,null,$grupoEmp);
                $this->cambiodireccion = $cambiodireccion + 1;
            }
        //Envia correo a nivel nacional sobre ingreso de un colaborador a la compañía    
        }else{
            $empresa=sfConfig::get('app_branding_name');
            
            $parametros = ParametroTable::retrieveByCaso("CU239");
            $empresas = array();
            
            foreach($parametros as $parametro){
                $empresas[] = $parametro->getCaIdentificacion();
            }
            
            $grupoEmp = $usuario->getGrupoEmpresarial();
            
            if($empresa!='TPLogistics' && in_array($usuario->getSucursal()->getCaIdempresa(), $empresas)){ // Solo se envia correo para Coltrans, Colmas y ColOtm
                $asunto = "ingreso";
                $usuario->emailUsuario($login,$asunto,null,null,null,$grupoEmp);
            }
        }
        
        $this->usuario = $usuario;
        $this->setTemplate("guardarUsuario");
    }
    /*
     * Permite cambiar el password de un usuario que se autentica por BD
     */

    public function executeChangePasswd($request) {
        $this->form = new CambioClaveForm();

        if ($request->isMethod('post')) {

            $this->form->bind(
                    array(
                        'clave_ant' => $request->getParameter('clave_ant'),
                        'clave1' => $request->getParameter('clave1'),
                        'clave2' => $request->getParameter('clave2')
                    )
            );

            if ($this->form->isValid()) {
                
                $conn = Doctrine::getTable("Usuario")->getConnection();
                $conn->beginTransaction();
                
                $user = $this->getUser()->getUserId();
                $user = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
                //$user->setPasswd($this->getRequestParameter("clave1"));
                $salt = hash("md5", uniqid(rand(), true));
                $passwd = $this->getRequestParameter("clave1");
                $new_pass = sha1($passwd);
                
                $claves = Doctrine::getTable("UsuarioClave")
                        ->createQuery("c")
                        ->addWhere("c.ca_login = ? ", $user->getCaLogin())
                        ->addOrderBy("c.ca_fchcreado DESC")
                        ->limit(5)
                        ->execute();
                
                foreach($claves as $clave){
                    if($clave->getCaClave()== $new_pass){
                        $igual = 1;
                        $this->setTemplate("changePasswdError");
                    }
                }
                
                if($igual!=1){
                    
                    $fch_vencimiento = Utils::calcularVencimientoClave();
                    
                    $user->setCaPasswd(sha1($passwd . $salt));
                    $user->setCaSalt($salt);
                    $user->setCaForcechange(false);
                    $user->setCaFchvencimiento($fch_vencimiento);
                    $user->save( $conn );
                    
                    $usr_clave = new UsuarioClave();
                    $usr_clave->setCaLogin($user->getCaLogin());
                    $usr_clave->setCaClave($new_pass);
                    $usr_clave->save();

                    $config = sfConfig::get("app_soap_adminUsers");
//                    if( $config["updateUser"] ){
//                        ProjectConfiguration::registerZend();   
//                        $wsdl_uri = $config["wsdl_uri"];            
//                        $client = new Zend_Soap_Client( $wsdl_uri, array('encoding'=>'ISO-8859-1'));        
//                        $error =  $client->updateUser( sfConfig::get("app_soap_secret"),serialize($user) );
//
//                        if( $error ){
//                            throw new Exception( $error );                
//                        }
//                    }

                    $conn->commit();
                    $this->getUser()->setAttribute('forcechange', false);
                    $this->setTemplate("changePasswdOk");
                }
            }
        }
    }    

    /*
     *
     */

    public function executeFormPermisos($request) {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();

        switch ($app) {
            case "intranet":
                
                break;
        }

        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($this->usuario);

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        $accesos = Doctrine::getTable("AccesoUsuario")
                        ->createQuery("a")
                        ->innerJoin("a.Rutina r")
                        ->where("a.ca_login= ? ", $this->usuario->getCaLogin())
                        ->addWhere("r.ca_aplicacion = ?", $app)
                        ->execute();
        $this->accesos = array();
        foreach ($accesos as $acceso) {
            $this->accesos[$acceso->getCaRutina()] = $acceso->getCaAcceso();
        }

        $accesos = Doctrine::getTable("AccesoPerfil")
                        ->createQuery("a")
                        ->innerJoin("a.UsuarioPerfil up")
                        ->innerJoin("a.Rutina r")
                        ->where("up.ca_login= ? ", $this->usuario->getCaLogin())
                        ->addWhere("r.ca_aplicacion = ?", $app)
                        ->addOrderBy("a.ca_acceso")
                        ->execute();

        $this->accesosPerfil = array();
        foreach ($accesos as $acceso) {
            $perfil = $acceso->getPerfil();
            $this->accesosPerfil[$acceso->getCaRutina()]['nivel'] = $acceso->getCaAcceso();
            $this->accesosPerfil[$acceso->getCaRutina()]['perfil'] = $perfil->getCaNombre();
        }
    }

    /*
     *
     */

    public function executeGuardarPermisos($request) {
        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($this->usuario);

        $accesos = Doctrine::getTable("AccesoUsuario")
                        ->createQuery("a")
                        ->where("a.ca_login= ? ", $this->usuario->getCaLogin())
                        ->execute();

        foreach ($accesos as $acceso) {
            $acceso->delete();
        }

        $accesosForm = $request->getParameter("acceso");
        $niveles = $request->getParameter("nivel");

        foreach ($accesosForm as $key => $accesoForm) {
            $acceso = new AccesoUsuario();
            $acceso->setCaLogin($this->usuario->getCaLogin());
            $acceso->setCaRutina($key);
            $acceso->setCaAcceso($niveles[$key]);
            $acceso->save();
        }

        $this->redirect("adminUsers/formUsuario?login=" . $this->usuario->getCaLogin());
    }

    /*
     *
     */

    public function executeFormPerfiles($request) {
        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($this->usuario);


        $this->perfiles = Doctrine::getTable("Perfil")
                        ->createQuery("p")
                        ->addOrderBy("p.ca_departamento")
                        ->addOrderBy("p.ca_nombre")
                        ->execute();


        $perfilesUsuario = Doctrine::getTable("UsuarioPerfil")
                        ->createQuery("up")
                        ->where("up.ca_login= ? ", $this->usuario->getCaLogin())
                        ->execute();


        $this->perfilesUsuario = array();
        foreach ($perfilesUsuario as $perfilUsuario) {
            $this->perfilesUsuario[] = $perfilUsuario->getCaPerfil();
        }
    }

    /*
     *
     */

    public function executeGuardarPerfiles($request) {
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($usuario);

        $perfilesUsuario = Doctrine::getTable("UsuarioPerfil")
                        ->createQuery("up")
                        ->where("up.ca_login= ? ", $usuario->getCaLogin())
                        ->execute();

        foreach ($perfilesUsuario as $perfilUsuario) {
            $perfilUsuario->delete();
        }

        $perfiles = $request->getParameter('perfiles');

        foreach ($perfiles as $perfil) {
            $perfilObj = new UsuarioPerfil();
            $perfilObj->setCaLogin($usuario->getCaLogin());
            $perfilObj->setCaPerfil($perfil);
            $perfilObj->save();
        }

        $this->redirect("adminUsers/formUsuario?login=" . $usuario->getCaLogin());
    }

    public function executeListaExtensiones(sfWebRequest $request) {
         
       $this->user = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->nivel = $this->getNivel();
        $criterio = $request->getParameter('criterio');
        $empresa = $request->getParameter('empresa');
        $sucursal = utf8_decode($request->getParameter("idsucursal"));
        $departamento = $request->getParameter("departamento");

        $q = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->innerJoin('u.Sucursal s')
                        ->innerJoin('s.Empresa e')
                        ->addWhere('u.ca_activo = ?', true);

        if ($criterio) {
            switch ($criterio) {
                case "buttondirnal":
                    $q->addOrderBy("e.ca_nombre");
                    $q->addOrderBy("u.ca_idsucursal");
                    $q->addOrderBy("u.ca_departamento");
                    $q->addOrderBy("u.ca_nombres");
                    break;
                case "buttoncom":
                    $q->addWhere('e.ca_idempresa = ?', $empresa);
                    $q->addOrderBy("u.ca_idsucursal");
                    $q->addOrderBy("u.ca_departamento");
                    break;
                case "buttonsuc":
                    $q->addWhere('e.ca_idempresa = ?', $empresa);
                    $q->addWhere('(u.ca_idsucursal) LIKE ?', $sucursal);
                    $q->addOrderBy("u.ca_departamento");
                    break;
                case "buttondep":
                    $q->addWhere('e.ca_idempresa = ?', $empresa);
                    $q->addWhere('(u.ca_idsucursal) LIKE ?', '%' . $sucursal . '%');
                    $q->addWhere('(u.ca_departamento) LIKE ?', $departamento);
                    $q->addOrderBy("s.ca_nombre");
                    break;
            }
            $q->distinct();
            $this->usuarios = $q->execute();
            $this->criterio = $criterio;
        }
    }

    public function executeLogin($request) {
        //header("Location: /users/login");
        //exit();
        //echo "login".session_id();
        //$response = sfContext::getInstance()->getResponse();
        //$response->addStylesheet("login");
        
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        
        if($app=="intranet"){
            if( $request->isMethod("get")){            
                $this->getUser()->setAttribute("path_info", substr($request->getPathInfo(),1,  strlen($request->getPathInfo())-1));
                $this->getUser()->setAttribute("request_parameters", $request->getGetParameters());
            }
        }
        
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect("homepage/index");
        }

        $this->form = new LoginForm();
        if ($request->isMethod('post')) {
            $this->form->bind(
                    array(
                        'username' => $request->getParameter('username'),
                        'passwd' => $request->getParameter('passwd')
                    )
            );
            if ($this->form->isValid()) {
                if( $this->getUser()->getAttribute("path_info") && $this->getUser()->getAttribute("path_info")!="/adminUsers/logout"){
                    $url = $this->getUser()->getAttribute("path_info");
                    $params = $this->getUser()->getAttribute("request_parameters");
                    
                    $p = "";
                    $i=0;
                    foreach( $params as $key=>$val ){
                        if( $i++==0 ){
                            $p.="?";
                        }else{
                            $p.="&";
                        }

                        $p.=$key."=".$val;
                        $request->setParameter($key, $val);
                    }
                    
                    $url.= $p;                   
                    $url="/intranet/".$url;
                   
                }else{
                    $url = "homepage/index";
                }
                //Se valido correctamente
                $this->redirect($url);
                //echo "OK";
            }
        }

        $this->setLayout("login");
    }

    public function executeLogout($request) {
        $this->getUser()->signOut();
        $this->redirect("adminUsers/login");
    }

    public function executeMainUsers(sfWebRequest $request) {
        
        $this->userinicio = sfContext::getInstance()->getUser();
        $this->nivel = $this->getNivel();
    }

    public function executePhoneBook(sfWebRequest $request) {

        
        $this->criterio = $request->getParameter('criterio');

        $this->sucursales = Doctrine::getTable("Sucursal")
                        ->createQuery("s")
                        ->select("s.ca_idsucursal, s.ca_idempresa, s.ca_nombre")
                        ->innerJoin('s.Empresa e')
                        ->addOrderBy("s.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        foreach ($this->sucursales as $key => $val) {
            $this->sucursales[$key]["ca_nombre"] = utf8_encode($this->sucursales[$key]["ca_nombre"]);
        }

        $this->departamentos = Doctrine::getTable("Departamento")
                        ->createQuery("d")
                        ->select("d.ca_idempresa, d.ca_nombre")
                        ->innerJoin('d.Empresa e')
                        ->addOrderBy("d.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->departamentos as $key => $val) {
            $this->departamentos[$key]["ca_nombre"] = utf8_encode($this->departamentos[$key]["ca_nombre"]);
        }

        $this->empresas = Doctrine::getTable("Empresa")
                        ->createQuery("e")
                        ->addWhere('e.ca_activo=?', true)
                        ->addOrderBy("e.ca_nombre")
                        ->execute();
    }

    public function executeNoAccess($request) {
        
        $this->key = $request->getParameter("key");
        
    }

    public function executeTraerImagen($request) {
        $username = $request->getParameter('username');
        $tamano = $request->getParameter('tamano');

        $user = Doctrine::getTable('Usuario')->find($username);

        $this->imagen = $user->getImagen($tamano);
    }

    public function executeViewOrganigrama(sfWebRequest $request) {
        
        $usuario = Doctrine::getTable("usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();       
        
        $this->manager = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->forward404Unless($this->manager);

        $this->usuarios = $this->manager->getSubordinado();

        if (count($this->usuarios) == 0) {
            $this->manager = $this->manager->getManager();
            $this->usuarios = $this->manager->getSubordinado();
        }
        
        $q = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_login, u.ca_manager, u.ca_nombre, s.ca_idsucursal, u.ca_cargo, r.ca_idempresa, e.ca_nombre")
                ->leftJoin("u.Sucursal s")
                ->leftJoin("s.Empresa e")
                ->where("u.ca_activo = true")
                ->andWhereIn("s.ca_idempresa", $grupoEmp)
                ->andWhere("u.ca_login not in ('web','falabella','Comercial','comercialmed','comercialbaq','auxaduana','comercial-baq','comercial-med','consolcargo','hbingenieria1','hbingenieria2')")
                ->orderBy("s.ca_nombre, u.ca_cargo");
                
        $this->usuariosNal = $q->execute();
        $this->presidencia = Doctrine::getTable("Usuario")->find("jraute");
        
        $this->user = sfContext::getInstance()->getUser();
    }

    public function executeViewUser(sfWebRequest $request) {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        switch ($app) {
            case "intranet":
                
                break;
        }
        $this->userinicio = sfContext::getInstance()->getUser();
        $userinicio = Doctrine::getTable('Usuario')->find($this->userinicio->getUserId());
        
        $this->grupoEmp = $userinicio->getGrupoEmpresarial();
        $this->comites = array();
        
        $this->nivel = $this->getNivel();

        $verUsuario = $request->getParameter('verUsuario');
        $this->user = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        if($this->user){
            $this->manager = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
            $this->manager = $this->manager->getManager();

            //Obtiene direccion desde e-directory
            $ldap_server = sfConfig::get("app_ldap_host");
            $auth_user = "cn=" . sfConfig::get("app_ldap_user") . ",o=coltrans_bog";
            $passwd = sfConfig::get("app_ldap_passwd");

            $this->addresses = array();
            /*if ($connect = ldap_connect($ldap_server)) {
                if ($bind = ldap_bind($connect, $auth_user, $passwd)) {
                    $searchString = "(&(cn=" . $request->getParameter('login') . "))";
                    $sr = ldap_search($connect, "o=coltrans_bog", $searchString, array("networkAddress"));
                    $entry = ldap_first_entry($connect, $sr);
                    @$attrs = ldap_get_attributes($connect, $entry);
                    @$result = $attrs["networkAddress"];
                    if(is_array($result)){
                        foreach ($result as $key => $val) {
                            if (trim($key) != "count") {
                                $this->addresses[] = Utils::LDAPNetAddr($val);
                            }
                        }
                    }
                }
            }*/
            
            if($this->user->getUsuBrigadas()->getCaComites() && strrpos($this->user->getUsuBrigadas()->getCaComites(), "|"))
                $this->comites = explode("|",$this->user->getUsuBrigadas()->getCaComites());
            else
                $this->comites[] = $this->user->getUsuBrigadas()->getCaComites();            
            
            $this->vacaciones = $this->user->getEnVacaciones(); 
            $datos = json_decode(utf8_encode($this->user->getCaDatos()));
            $this->subc = $datos->subcontratado;
            
            $this->responseArray = array("success" => true, "login" => $this->user->getCaLogin());            
        }
    }
    
    /*
     * Busqueda general
     */
    public function executeSearch(sfWebRequest $request) {
        $criterio = ('%' . strtolower($request->getParameter('buscar')) . '%');
        
        $usuario = Doctrine::getTable("usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();       

        $q = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->innerJoin('u.Sucursal s')
                        ->innerJoin('s.Empresa e')
                        ->addWhere('u.ca_activo = ?', true)
                        ->andWhereIn("s.ca_idempresa", $grupoEmp);
        
        
        
        $q->addWhere('(LOWER(u.ca_login) LIKE ? OR LOWER(u.ca_nombre) LIKE ? 
                        OR LOWER(u.ca_nombres) LIKE ? OR LOWER(u.ca_apellidos) LIKE ?
                        OR LOWER(u.ca_apellidos) LIKE ? OR LOWER(u.ca_email) LIKE ?
                        OR LOWER(u.ca_cargo) LIKE ? OR LOWER(u.ca_departamento) LIKE ?
                        OR LOWER(s.ca_nombre) LIKE ? OR LOWER(e.ca_nombre) LIKE ?)
                        
                     ', array($criterio, $criterio, $criterio, $criterio, $criterio,
                              $criterio, $criterio, $criterio, $criterio, $criterio));
       
        
        $q->addOrderBy("u.ca_nombre ASC");       
        $q->distinct();
        $this->usuarios = $q->execute();
        
        $this->setTemplate("doSearch");
    }
    /*
     * Busqueda personalizada
     */
    public function executeDoSearch(sfWebRequest $request) {

        $criterio = ('%' . strtolower($request->getParameter('criterio')) . '%');
        $opcion = $request->getParameter("opcion");
        $departamento = utf8_decode($request->getParameter("departamento"));
        $sucursal = utf8_decode($request->getParameter("sucursal"));
        $empresa = utf8_decode($request->getParameter("empresa"));
        $sangre = $request->getParameter("type");

        $q = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->innerJoin('u.Sucursal s')
                        ->innerJoin('s.Empresa e')
                        ->addWhere('u.ca_activo = ?', true);
        if ($criterio) {
            switch ($opcion) {
                case "login":
                    $q->addWhere('LOWER(u.ca_login) LIKE ?', $criterio);
                    break;
                case "nombre":
                    $q->addWhere('(LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_nombres) LIKE ? OR LOWER(u.ca_apellidos) LIKE ? )', array($criterio, $criterio, $criterio));
                    break;
                case "apellido":
                    $q->addWhere('(LOWER(u.ca_apellidos) LIKE ?)', $criterio);
                    break;
                case "correo":
                    $q->addWhere('LOWER(u.ca_email) LIKE ?', $criterio);
                    break;
                case "tiposangre":
                    $q->addWhere('LOWER(u.ca_tiposangre) LIKE ?', $criterio);
                    break;
                case "cargo":
                    $q->addWhere('LOWER(u.ca_cargo) LIKE ?', $criterio);
                    break;
            }
        }
        if ($departamento) {
            $q->addWhere('LOWER(u.ca_departamento) LIKE ?', strtolower($departamento));
        }
        if ($sucursal) {
            $q->addWhere('u.ca_idsucursal = ?', $sucursal);
        }
        if ($empresa) {
            $q->addWhere('s.ca_idempresa = ?', $empresa);
        }
        $q->addOrderBy("u.ca_login ASC");       
        $q->distinct();
        $this->usuarios = $q->execute();
    }
    
    public function executeCambioClaveColsys($request) {
        
        $hoy = date("Y-m-d");
        
        $usuarios = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->addWhere("u.ca_authmethod = ? ", "sha1")
                        ->addWhere("u.ca_fchvencimiento = ? ", $hoy)
                        ->addOrderBy("u.ca_login DESC")
                        ->execute();
        
        foreach($usuarios as $usuario){
            $usuario->setCaForcechange(true);
            $usuario->save();
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEmailIntranet($request) {
        
        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));        
        $this->setLayout("none");
        
        $this->asunto = $request->getParameter("asunto");
        $this->direccion = $request->getParameter("direccion");
        $this->logo = $request->getParameter("logo");
        $this->tiempo = $request->getParameter("tiempo");
        $this->fchingreso = $request->getParameter("fchingreso");
        $this->grupoEmp = $request->getParameter("grupoEmp");
        
        if($this->asunto=="cumpleanos"){
            $inicial = date('m-d',time());
            $final = $inicial;
            if(date("N")>=5)
                $final = date('m-d',time()+86400 * 2);
            
            $this->users = Doctrine::getTable('Usuario')
                    ->createQuery('u')
                    ->innerJoin('u.Sucursal s')
                    ->innerJoin('s.Empresa e')
                    ->where('substring(ca_cumpleanos::text, 6,5) BETWEEN ? AND ?', array($inicial,$final))
                    ->andWhereIn('e.ca_idempresa',$this->grupoEmp)
                    ->addWhere('ca_activo = ?', true)
                    ->addOrderBy('substring(ca_cumpleanos::text, 6,5)  ASC')
                    ->execute();            
        }
    }
    
    public function executeTiempoColaborador(sfWebRequest $request){
        
        $anoActual = date('Y');

        $q = Doctrine::getTable('Usuario')
                ->createQuery ('u')
                ->select('u.*')
                ->innerJoin('u.Sucursal s')
                ->innerJoin('s.Empresa e')
                ->where('u.ca_activo = ?', true)
                ->addWhere('e.ca_idempresa != 4')
                ->addWhere("CASE WHEN substr((ca_fchingreso - 4)::text,6,5) = substr(now()::text,6,5) THEN(CASE WHEN ((date_part('".year."', now() + INTERVAL '4' DAY) - date_part('".year."', ca_fchingreso))::int) NOT IN (5,0) THEN ((date_part('".year."', now() + INTERVAL '4' DAY) - date_part('".year."', ca_fchingreso))::int)%5=0 ELSE false END ) ELSE false END")
                ->orderby('ca_fchingreso DESC');
        
        $usuarios = $q->execute();
        
        if($usuarios){
            foreach ($usuarios as $usuario){

                list($ano,$mes,$dia) = explode("-",$usuario->getCaFchingreso());

                $tiempoCumplido = date("Y") - $ano;
                $login = $usuario->getCaLogin();
                $fchingreso = $usuario->getCaFchingreso();

                $usuario = Doctrine::getTable("Usuario")->find($login);
                $asunto = "reconocimiento";

                $usuario->emailUsuario($login,$asunto,null,$tiempoCumplido,$fchingreso);            
            }
        }
    }
    
    public function executeBirthdayEmail(sfWebRequest $request) {
        
        
        $usuario = Doctrine::getTable("Usuario")->find('Administrador');
        
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $dia = date('N');
        $inicial = date('m-d',time());
        $final = $inicial;
        if($dia>=5)
            $final = date('m-d',time()+86400 * 2);

        $q = Doctrine::getTable('Usuario')
                ->createQuery('u')
                ->innerJoin('u.Sucursal s')
                ->innerJoin('s.Empresa e')
                ->where('substring(ca_cumpleanos::text, 6,5) BETWEEN ? AND ?', array($inicial, $final))
                ->andWhereIn('e.ca_idempresa', $grupoEmp)
                ->addWhere('ca_activo = ?', true)
                ->addOrderBy('substring(ca_cumpleanos::text, 6,5)  ASC');
        
        $users = $q->execute();
        
        if(count($users)>0){
            if($dia != 6 && $dia != 7){            
                $asunto = "cumpleanos";            
                $usuario = new Usuario();
                $usuario->emailUsuario('Administrador',$asunto,null,null,null,$grupoEmp);
            }
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeBirthdayEmailConsol(sfWebRequest $request) {
        
        $usuario = Doctrine::getTable("Usuario")->find('consolcargo');
        $grupoEmp = $usuario->getGrupoEmpresarial();
        $dia = date('N');
        $inicial = date('m-d',time());
        $final = $inicial;
        if($dia>=5)
            $final = date('m-d',time()+86400 * 2);

        $q = Doctrine::getTable('Usuario')
                ->createQuery('u')
                ->innerJoin('u.Sucursal s')
                ->innerJoin('s.Empresa e')
                ->where('substring(ca_cumpleanos::text, 6,5) BETWEEN ? AND ?', array($inicial, $final))
                ->andWhereIn('e.ca_idempresa', $grupoEmp)
                ->addWhere('ca_activo = ?', true)
                ->addOrderBy('substring(ca_cumpleanos::text, 6,5)  ASC');

        $users = $q->execute();
        
        if(count($users)>0){
            if($dia != 6 && $dia != 7){            
                $asunto = "cumpleanos";            
                $usuario = new Usuario();
                $usuario->emailUsuario('consolcargo',$asunto,null,null,null,$grupoEmp);
            }
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEmailDesvinculacion(sfWebRequest $request){
        
        $login = $request->getParameter("login");
        $usuario = Doctrine::getTable("Usuario")->find($login);        
        $grupoEmp = $usuario->getGrupoEmpresarial();
        $asunto = "desvinculacion";
        
        $usuario->emailUsuario($login,$asunto,null,null,null,$grupoEmp);
    }
    
    /*
     * @Nataly
     * @return arreglo de cargos por empresa
     * @param $request 
        * idempresa: n\FAmero de identificaci\F3n de la empresa
     */
    function executeDatosCargos($request) {
        $empresa = $request->getParameter("idempresa");
        
        $q = Doctrine::getTable("Cargo")
                            ->createQuery("s")
                            ->select("*")
                            ->where("s.ca_idempresa = ?",$empresa)
                            ->addOrderBy( "s.ca_cargo ASC" );                            
        
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        $debug = $q->getSqlQuery();
        $cargos = $q->execute();
        
        foreach($cargos as $k=>$c){
            $cargos[$k]["s_ca_cargo"]=utf8_encode($cargos[$k][utf8_encode("s_ca_cargo")]);
        }
        $this->responseArray = array("success" => true, "root" => $cargos, "total" =>count($cargos) ,"debug"=>$debug,"idempresa"=>$empresa);
        $this->setTemplate("responseTemplate");
    }
    /*
     * @Nataly
     * @return nuevo Cargo
     * @param $request 
        * datos: Json de datos por almacenar
     */
    function executeGuardarGridCargos($request) {
        $datos = $request->getParameter("datos");
        $datos=  utf8_decode($datos);
        $cargos = json_decode(utf8_encode($datos));
        $ids = array();
        
        $conn = Doctrine::getTable("Cargo")->getConnection();
        $conn->beginTransaction();
        try{
            foreach($cargos as  $c){                   
                $cargo = Doctrine::getTable("Cargo")->find(utf8_decode($c->ca_cargo));
                if(!$cargo)
                {
                    $cargo = new Cargo();
                    $cargo->setCaCargo(utf8_decode($c->ca_cargo));  
                }
                $cargo->setCaActivo($c->ca_activo);
                $cargo->setCaManager($c->ca_manager?TRUE:FALSE);
                $cargo->setCaIdempresa($c->ca_idempresa);            
                $cargo->save($conn);
                $ids[] = $c->id;
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "id" => implode(",", $ids));
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    function executeEmailVacaciones($request){
        
        if($request->getParameter("login")){
            $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
            $idempresa = $this->usuario->getSucursal()->getCaIdempresa();

            $this->from = Utils::parseDate($request->getParameter("from"), "d-M-Y");
            $this->to = Utils::parseDate($request->getParameter("to"), "d-M-Y");
            $this->returnDate = Utils::parseDate($request->getParameter("returnDate"), "d-M-Y");
            $this->mensaje = strip_tags($request->getParameter("mensaje"),'<br>');
            $this->logo = $this->usuario->getLogoHtml($idempresa);
            
            if($request->getParameter("encargado1"))
                $this->encargado1 = Doctrine::getTable("Usuario")->find($request->getParameter("encargado1"));
            
            if($request->getParameter("encargado2"))
                $this->encargado2 = Doctrine::getTable("Usuario")->find($request->getParameter("encargado2"));
            
            $this->responseArray = array("success" => true, "mensaje"=>$this->message);
        }else{
            $this->responseArray = array("success" => false);
            
        }
        
        $this->setLayout("none");
        
    }
    
    function executeGuardarVacaciones(sfWebRequest $request){
        
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $grupoEmp = $usuario->getGrupoEmpresarial();
        $from = Utils::parseDate($request->getParameter("from"), "d-M-Y");
        $to = Utils::parseDate($request->getParameter("to"), "d-M-Y");
        $returnDate = Utils::parseDate($request->getParameter("returnDate"), "d-M-Y");
        $message = strip_tags($request->getParameter("message"),'<br>');
        
        $conn = Doctrine::getTable("UsuVacaciones")->getConnection();
        $conn->beginTransaction();
        
        try {            
            
            $vacaciones = new UsuVacaciones();
            $vacaciones->setCaLogin($request->getParameter("login"));
            $vacaciones->setCaFrom($from);
            $vacaciones->setCaTo($to);            

            $request->setParameter("login", $request->getParameter("login"));
            $request->setParameter("from", $from);
            $request->setParameter("to", $to);
            $request->setParameter("returnDate", $returnDate);
            $request->setParameter("mensaje", $message);                
            $html= sfContext::getInstance()->getController()->getPresentationFor('adminUsers', 'emailVacaciones');

            $vacaciones->setCaBodyhtml($html);
            $vacaciones->save($conn);
            
            $destinatarios = array();
            $parametros = ParametroTable::retrieveByCaso("CU239");
            foreach($parametros as $parametro){
                $remitente[$parametro->getCaIdentificacion()] = $parametro->getCaValor2();
                $destinatarios[$parametro->getCaIdentificacion()] = $parametro->getCaValor();
            }

            $email = new Email();
            $email->setCaUsuenvio($usuario->getCaLogin());
            $email->setCaTipo("Vacaciones");
            $email->setCaIdcaso($vacaciones->getCaId());
            $email->setCaFrom($usuario->getCaEmail());
            $email->setCaFromname($usuario->getCaNombre());
            $subject = "VACACIONES: ".$usuario->getCaNombre()." ".$usuario->getSucursal()->getCaNombre()." ".$usuario->getSucursal()->getEmpresa()->getCaNombre();
            $email->setCaSubject($subject);
            $email->setCaBodyhtml($html);
            $email->addCc("alramirez@coltrans.com.co");
            foreach($grupoEmp as $empresa){
                if($destinatarios[$empresa]){
                    if( $destinatarios[$empresa] != "null")
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
            $email->save($conn);

            $this->responseArray = array("success" => true);
            $conn->commit();
        
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        
        $this->setTemplate("responseTemplate");        
    }
    
    /*
     * Panel que muestra los usuarios correspondientes al panel de búsqueda
     * @author: Andres Botero
     */

    public function executeDatosHijos($request) {
        
        $login = $request->getParameter("login");
        
        $addWhere = "";        
        if($login){
            $addWhere.= "AND up.ca_parent = $login";
        }
            
        $sql = "SELECT h.ca_idhijo, h.ca_documento, h.ca_nombres, h.ca_fchnacimiento, s.ca_nombre as sucursal, e.ca_nombre as empresa,string_agg(u.ca_nombre::text, '|'::text) AS ca_parents, up.ca_idhijo, string_agg(up.ca_parent::text, '|'::text) AS ca_idparents
                FROM intranet.tb_usuhijos h
                        LEFT JOIN intranet.tb_usuparents up ON h.ca_idhijo = up.ca_idhijo
                        LEFT JOIN control.tb_usuarios u ON u.ca_login = up.ca_parent
                        LEFT JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal
                        LEFT JOIN control.tb_empresas e ON e.ca_idempresa = s.ca_idempresa
                $addWhere
                GROUP BY h.ca_idhijo, h.ca_nombres, s.ca_nombre, e.ca_nombre, up.ca_idhijo
                ORDER BY h.ca_fchnacimiento DESC";
        
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $hijos = $st->fetchAll();
        
        $data = array();

        foreach ($hijos as $hijo) {
            
            $edad_detalle = TimeUtils::calcularEdad($hijo["ca_fchnacimiento"], date('Y-m-d'), true);
            
            $row = array();
            $row["h_ca_idhijo"] = $hijo["ca_idhijo"];
            $row["h_ca_documento"] = $hijo["ca_documento"];
            $row["h_ca_nombres"] = utf8_encode($hijo["ca_nombres"]);
            $row["h_ca_fchnacimiento"] = $hijo["ca_fchnacimiento"];
            $row["edad"] = utf8_encode(TimeUtils::calcularEdad($hijo["ca_fchnacimiento"], date('Y-m-d')));
            $row["detalle"] = utf8_encode($edad_detalle);
            $row["padres"] = utf8_encode($hijo["ca_parents"]);
            $row["idpadres"] = utf8_encode($hijo["ca_idparents"]);
            $row["s_ca_nombre"] = utf8_encode($hijo["sucursal"]);
            $row["e_ca_nombre"] = utf8_encode($hijo["empresa"]);
            
            $data[] = $row;
}
        
        $this->responseArray = array("success" => true, "root" => $data, "debug"=>$sql);
        $this->setTemplate("responseTemplate");
    }
    
    
    /*
     * Panel que muestra los usuarios correspondientes al panel de búsqueda
     * @author: Andres Botero
     */

    public function executeDatosUsuariosZonas($request) {

        $this->forward404Unless($request->getParameter("idzona"));
        //$zona = ParametroTable::retrieveQueryByCaso('CU242', $request->getParameter("idzona"));
        $idzona = $request->getParameter("idzona");

        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->innerJoin("u.UsuBrigadas ub")                
                ->addWhere("ub.ca_zona = ?", $idzona)
                ->addOrderBy("u.ca_departamento, u.ca_nombre")
                ->execute();

        $data = array();

        foreach ($usuarios as $usuario) {
            $row = array();
            $row["login"] = $usuario->getCaLogin();
            $row["name"] = utf8_encode($usuario->getCaNombre());
            $row["icon"] = $usuario->getImagenUrl("60x80");
            $data[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarUsuarioZona(sfWebRequest $request) {
    
        $this->forward404Unless($request->getParameter("login"));
        //$zona = ParametroTable::retrieveQueryByCaso('CU242', $request->getParameter("idzona"));
        $idzona = $request->getParameter("idzona");
        
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));        
        
        if ($usuario) {
            $brigada = $usuario->getUsuBrigadas();        
            $brigada->setCaZona(null);
            $usuario->save();
            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"));
        } else {
            $this->responseArray = array("success" => false);
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeAgregarUsuarioZona(sfWebRequest $request) {
       
        $this->forward404Unless($request->getParameter("login"));
        $idzona = $request->getParameter("idzona");
        
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));        
        
        if ($usuario) {
            $brigada = $usuario->getUsuBrigadas();        
            $brigada->setCaZona($idzona);
            $usuario->save();
            $this->responseArray = array("success" => true, "idzona" => $idzona);
        } else {
            $this->responseArray = array("success" => false);
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeGenerarPdfPlanilla(sfWebRequest $request) {
       
        $this->forward404Unless($request->getParameter("idzona"));
        $caso = $request->getParameter("caso");
        //$idzona = $request->getParameter("idzona");
        
        //$caso = "CU264";
        $brigadista = ParametroTable::retrieveByCaso($caso, null, null);
        /*$brigadista = '{
            "Sucursal": [
                "ABO",
                "BOG"
            ],
            "Brigadista": [
                "alrammirez",
                "ygomez"
            ]
          }';*/
        //{"Sucursal": ["ABO","BOG"],"Brigadista": ["alrammirez","ygomez"]}

        $data = array();
        $jsonArray = json_decode($brigadista[0]->getCaValor2(), true); 
        
        /*foreach ($jsonArray as $json){
            print_r($json["Sucursal"]);
            
        }*/
        $sucursales = $jsonArray["Sucursal"];
        $brigadistas = $jsonArray["Brigadista"];
        
        //$factores = $riesgo->getIdgFactor();
                if($brigadistas){
                    foreach($brigadistas as $brigadista){
                        $data["login[]"][] = utf8_encode($factor->getCaFactor());
            }
                }
        
        /*echo "jsponArray".$jsonArray;
        print_r($data);
        
        echo "<pre>";print_r($jsonArray);echo "</pre>";        */
        
        $this->setTemplate("responseTemplate");
       
    }
    
    /**
     * Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarHijos(sfWebRequest $request) {
        
        $login = $request->getParameter("login");
        $datos = $request->getParameter("datos");
        
        $datos = json_decode($datos);
        
        $conn = Doctrine::getTable("UsuHijos")->getConnection();
        $conn->beginTransaction();
        
        try{
            foreach($datos as $dato){
                
                if($dato->ca_idhijo>0){
                    $hijo = Doctrine::getTable("UsuHijos")->find($dato->ca_idhijo); 
                }else{
                    $hijo = new UsuHijos();
                }
                $fechanacimiento = date_format(new DateTime($dato->ca_fchnacimiento), 'Y-m-d');
                
                $hijo->setCaDocumento($dato->ca_documento);
                $hijo->setCaNombres($dato->ca_nombres);
                $hijo->setCaFchnacimiento($fechanacimiento);
                $hijo->save($conn);

                $npadres = $dato->ca_padres?explode(",",$dato->ca_padres):explode(",",$dato->ca_idpadres);
                foreach($npadres as $padre){                    
                    $loginpadre = $dato->ca_padres?Doctrine::getTable("Usuario")->findOneBy("ca_nombre", $padre):Doctrine::getTable("Usuario")->find($padre);                                        
                    $existe = Doctrine::getTable("UsuParents")->findByDql('ca_idhijo = ? and ca_parent = ?' ,array($hijo->getCaIdhijo(), $loginpadre->getCaLogin()));
                    
                    if(!$existe->count()>0){
                        $usuparents = new UsuParents();
                        $usuparents->setCaIdhijo($hijo->getCaIdhijo());
                        $usuparents->setCaParent($loginpadre->getCaLogin());
                        $usuparents->save($conn);
                    }
                }
               
                $idhijos[] = $hijo->getCaIdhijo();
                $ids[] = $dato->id;
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "idhijos"=>$idhijos, "ids"=>$ids);
            
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");        
    }
    
     public function executeEliminarHijo(sfWebRequest $request) {
         
        $idhijo = $request->getParameter("idhijo");
        $conn = Doctrine::getTable("UsuHijos")->getConnection();
        $conn->beginTransaction();
        
        try{
            $hijo = Doctrine::getTable("UsuHijos")->find($idhijo);
            $hijo->delete($conn);
            
            $usuparents = Doctrine::getTable("UsuParents")->findBy("ca_idhijo", $idhijo);            
            foreach($usuparents as $up){
                $up->delete($conn);
            }
            
            $conn->commit();
            $this->responseArray = array("success" => true);
        }catch (Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");   
    }
    
    public function executeInfoVacaciones(sfWebRequest $request) {
        $login = $request->getParameter("login");
        $usuario = Doctrine::getTable("Usuario")->find($login);
        
        if($usuario->getEnVacaciones()){
            $vacaciones = $usuario->getEnVacaciones();
            
            $this->responseArray = array("success"=> true, "html"=>utf8_encode($vacaciones->getCaBodyhtml()), "id"=>$vacaciones->getCaId());
        }else{
            $this->responseArray = array("success"=> false);
        }
        $this->setTemplate("responseTemplate");   
    }
}
?>