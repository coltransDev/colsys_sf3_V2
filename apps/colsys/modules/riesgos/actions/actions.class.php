<?php

/**
 * gestDocumental actions.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class riesgosActions extends sfActions {
    const RUTINA = "208";
    const EDITAR = 1;
    /**
     * Executes index action
     *
     */
    public function executeIndex() {

        //$response = sfContext::getInstance()->getResponse();
        //$response->addJavaScript("extExtras/FileUploadField",'last');
    }
    
    public function executeIndexExt5() {

        //$response = sfContext::getInstance()->getResponse();
        //$response->addJavaScript("extExtras/FileUploadField",'last');
    }



    function executeDatosProcesos($request) {
        
        $sql = "SELECT p.ca_idproceso, p.ca_nombre, r.ca_idriesgo, r.ca_codigo, r.ca_riesgo, r.ca_laft
                FROM idg.tb_procesos p
                    LEFT OUTER JOIN idg.tb_riesgos r on p.ca_idproceso = r.ca_idproceso
                ORDER BY p.ca_nombre, r.ca_codigo";
        
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $riesgos = $st->fetchAll();
        
        $data = array();
        $childrens = array();
        $clase = null;
        $uno = true;
        
        $user = $this->getUser();
        
        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA); 
        //print_r($permisosRutinas);
        /*Accesos solicitados para el método*/
        $acceso = $user->getControlAccesoMetodo($permisosRutinas, self::EDITAR);
        //echo "acceso".$acceso."<-";
        
        foreach ($riesgos as $riesgo) {            
            if ($uno) {
                $proceso = utf8_encode($riesgo["ca_nombre"]);                
                $uno = false;
            }
            
            if ($proceso != utf8_encode($riesgo["ca_nombre"])) {                
                $data[] = array("text" => $proceso, "idproceso"=>$idproceso,"expanded" => false, "children" => $childrens);
                $proceso = utf8_encode($riesgo["ca_nombre"]);
                $childrens = array();
            }
            
            $q = Doctrine::getTable("IdgUsuProcesos")
                    ->createQuery("up")
                    ->where("up.ca_idproceso = ?", $riesgo["ca_idproceso"]);            
            $usuariosProceso = $q->execute();
            
            $usuproceso[$riesgo["ca_idproceso"]] = array();            
            if($usuariosProceso){
                foreach($usuariosProceso as $u){                    
                    if(!in_array($u->getCaLogin(),$usuproceso[$riesgo["ca_idproceso"]]))
                        $usuproceso[$riesgo["ca_idproceso"]][] = $u->getCaLogin();                
                }
            }
            $permisos = false;
            
            //print_r($usuproceso);
            /*Verifica si el usuario tiene acceso al proceso y pertenece al perfil Gestión de Riesgos*/
            if(in_array($user->getUserId(), $usuproceso[$riesgo["ca_idproceso"]]) && $acceso === true){
                $permisos = true;                
            }            
            
            $idproceso = $riesgo["ca_idproceso"];
            $laft = $riesgo["ca_laft"];
            $textoLaft = $laft?"<span style='color:blue'>Aplica LAFT </span>":"";
            $nombre = utf8_encode($riesgo["ca_nombre"]);            
            $childrens[] = array(
                "text" => utf8_encode($riesgo["ca_codigo"]),
                "children" => array("idtipo" => $riesgo["ca_idriesgo"]),
                "descripcion" => "<div>".$textoLaft.utf8_encode($riesgo["ca_riesgo"])."</div>",
                "laft"=>$laft,
                "cls"=>$laft?"bluenode":"",
                "leaf" => true,
                "id" => $riesgo["ca_idriesgo"],                
                "idproceso" => $idproceso,
                "permisos" => $permisos
            );
        }        
        if ($proceso) {
            $data[] = array("text" => $proceso, "idproceso"=>$riesgo["ca_idproceso"], "expanded" => false, "children" => $childrens);
        }
        
        $this->responseArray = array("text" => "Riesgos", "expanded" => true, "children" => $data);
        $this->setTemplate("responseTemplate");
    }
    
    function executeGeneral($request) {
        
        $idriesgo = $request->getParameter("idriesgo");
        $this->riesgo = Doctrine::getTable("IdgRiesgos")->find($idriesgo);        
    }
    
    function executeDatosFormGeneral($request){if (count($root) < 1)
            $root[]["idmaster" . $idmaster] = $idmaster;
        
        $idriesgo = $request->getParameter("idriesgo");
        if($idriesgo){
            $riesgo = Doctrine::getTable("IdgRiesgos")->find($idriesgo);
            
            $data = array();
            if ($riesgo) {
                $data["ca_codigo"] = utf8_encode($riesgo->getCaCodigo());
                $data["ca_laft"] = utf8_encode($riesgo->getCaLaft());
                $data["ca_riesgo"] = utf8_encode($riesgo->getCaRiesgo());
                $data["ca_etapa"] = utf8_encode($riesgo->getCaEtapa());
                $data["ca_potenciador"] = utf8_encode($riesgo->getCaPotenciador());
                $data["ca_controles"] = utf8_encode($riesgo->getCaControles());
                $data["ca_ap"] = utf8_encode($riesgo->getCaAp());
                $data["ca_contingencia"] = utf8_encode($riesgo->getCaContingencia());
                
                $factores = $riesgo->getIdgFactor();
                if($factores){
                    foreach($factores as $factor){
                        $data["nfactor[]"][] = utf8_encode($factor->getCaFactor());
                    }
                }
            }
            $this->responseArray = array("success" => true, "data" => $data);
        
        }else{
            $this->responseArray = array("success" => false, "data" => $data);
        }
        
        $this->setTemplate("responseTemplate");        
    }
    
    function executeGuardarFormGeneral($request){
        
        $datos = json_decode($request->getParameter("datos"), true);
        $datosCausas = json_decode($request->getParameter("datosGrid"), true);
        
        $idriesgo = $datos["idriesgo"];
        //$this->forward404Unless($idriesgo);
        
        $nfactor = $datos["nfactor[]"];
        
        if($idriesgo){
            $riesgo = Doctrine::getTable("IdgRiesgos")->find($idriesgo);
        }else{
            $riesgo = new IdgRiesgos();
            $nuevo = true;
        }
        $conn = Doctrine::getTable("IdgRiesgos")->getConnection();
        $conn->beginTransaction();
        
        try{
            if($datos["ca_idproceso"]){
                $riesgo->setCaIdproceso(utf8_decode($datos["ca_idproceso"]));
            }
            if($datos["ca_codigo"]){
                $riesgo->setCaCodigo(utf8_decode($datos["ca_codigo"]));
            }
            if($datos["ca_laft"]){
                $riesgo->setCaLaft(true);
            }
            if($datos["ca_riesgo"]){if (count($root) < 1)
            $root[]["idmaster" . $idmaster] = $idmaster;
                $riesgo->setCaRiesgo(utf8_decode($datos["ca_riesgo"]));
            }
            if($datos["ca_etapa"]){
                $riesgo->setCaEtapa(utf8_decode($datos["ca_etapa"]));
            }
            if($datos["ca_potenciador"]){
                $riesgo->setCaPotenciador(utf8_decode($datos["ca_potenciador"]));
            }            
            if($datos["ca_controles"]){
                $riesgo->setCaControles(utf8_decode($datos["ca_controles"]));
            }
            if($datos["ca_ap"]){
                $riesgo->setCaAp(utf8_decode($datos["ca_ap"]));
            }
            if($datos["ca_contingencia"]){
                $riesgo->setCaContingencia(utf8_decode($datos["ca_contingencia"]));
            }
            $riesgo->save($conn);
            
            if($nfactor && is_array($nfactor) && count($nfactor)>0){                
                $factores = Doctrine::getTable("IdgFactor")
                        ->createQuery("f")
                        ->where("f.ca_idriesgo = ?", $riesgo->getCaIdriesgo())
                        ->execute();
                            
                if($factores){
                    foreach($factores as $factor){
                        if(!in_array($factor->getCaFactor(), $nfactor))
                            $factor->delete($conn);
                    }
                }
            
                foreach($nfactor as $key => $val){
                    $factor = Doctrine::getTable("IdgFactor")->find(array($riesgo->getCaIdriesgo(), $val));
                    if(!$factor){
                        $factor = new IdgFactor();                    
                        $factor->setCaIdriesgo($riesgo->getCaIdriesgo());
                        $factor->setCaFactor(utf8_decode($val));
                        $factor->save($conn);
                    }
                }
            
            }
            if($datosCausas){
                foreach($datosCausas as $grid){
                    if($grid["valor"]!=""){
                        if(is_int($grid["id"])){
                            $causa = Doctrine::getTable("IdgCausas")->find($grid["id"]);                                                        
                        }else{
                            $causa = new IdgCausas();
                            $causa->setCaIdriesgo($riesgo->getCaIdriesgo());                            
                        }               
                    $causa->setCaCausa(utf8_decode($grid["valor"]));
                    $causa->setCaNueva($grid["nueva"]);
                    $causa->save($conn);
                    }
                }            
            }            
            $conn->commit();
            $this->responseArray = array("success" => true,"text" => "Riesgos", "expanded" => true, "nuevo"=>$nuevo,"idriesgo" => $riesgo->getCaIdriesgo(), "text"=>$riesgo->getCaCodigo());            
        }catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false,"text" => "Riesgos", "errorInfo" => $e->getMessage() , "idriesgo" => $riesgo->getCaIdriesgo());
        }
        $this->setTemplate("responseTemplate");        
    }
    
    public function executeDatosGridValoracion(sfWebRequest $request) {
        $idriesgo = $request->getParameter("idriesgo");
        $this->forward404Unless($idriesgo);
        $valoraciones = Doctrine::getTable("IdgValoracion")
                ->createQuery("v")
                ->select("v.*")                             
                ->where("v.ca_idriesgo = ?", $idriesgo)
                ->addOrderBy("v.ca_ano")
                ->execute();
        
        $data = array();
        
        foreach ($valoraciones as $val) {
            $row = array();
            $row["idvaloracion"] = $val->getCaIdvaloracion();
            $row["ano"]       = $val->getCaAno();
            $row["peso"]      = $val->getCaPeso();
            $row["operativo"] = $val->getCaOperativo();
            $row["legal"]     = $val->getCaLegal();
            $row["economico"] = $val->getCaEconomico();
            $row["comercial"] = $val->getCaComercial();
            $row["impacto"]   = (($val->getCaOperativo()*10*0.01)+($val->getCaLegal()*30*0.01)+($val->getCaEconomico()*40*0.01)+($val->getCaComercial()*20*0.01));
            $row["score"]     = $row["impacto"]*$val->getCaPeso();
            $data[] = $row;
        }
        
        if (count($data) < 1)
            $data[]["idriesgo" . $idriesgo] = $idriesgo;

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "nvaloracion" => count($valoraciones));
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * @autor Felipe Nari?o
     * @return un objeto JSON con la variable succes representando exito o falla en la transaccion
     * @param sfRequest $request A request 
     *        datos : JSON con todos los elementos del house correspondiente a una referencia especifica  * 
     * @date:  2016-04-25
     */
    public function executeGuardarGridValoracion($request) {
        $datos = $request->getParameter("datos");
        $vals = json_decode($datos);
        
        $conn = Doctrine::getTable("IdgValoracion")->getConnection();
        $conn->beginTransaction();
        
        try {
            $ids = array();
            $idvals = array();
            foreach ($vals as $v) {
                if ($v->idvaloracion>0) {
                    $valoracion = Doctrine::getTable("IdgValoracion")->find($v->idvaloracion);

                    $this->forward404Unless($valoracion);
                } else {
                    $valoracion = new IdgValoracion();
                    $valoracion->setCaIdriesgo($v->idriesgo);
                }
                
                $valoracion->setCaAno($v->ano);
                $valoracion->setCaOperativo($v->operativo);
                $valoracion->setCaLegal($v->legal);
                $valoracion->setCaEconomico($v->economico);
                $valoracion->setCaComercial($v->comercial);
                $valoracion->setCaPeso($v->peso);
                $valoracion->save($conn);
                
                $ids[] = $v->id;
                $idvals[] = $valoracion->getCaIdvaloracion();
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "idvaloracion"=>$valoracion->getCaIdvaloracion(), "ids" => $ids, "idvals" => $idvals);
        
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGridEventos(sfWebRequest $request) {
        $idriesgo = $request->getParameter("idriesgo");
        $this->forward404Unless($idriesgo);
        
        $data = array();
        if(!$request->getParameter("nuevo")){
            $eventos = Doctrine::getTable("IdgEventos")
                    ->createQuery("e")
                    ->select("e.*")        
                    ->where("e.ca_idriesgo = ?", $idriesgo)
                    ->addOrderBy("e.ca_fchevento")
                    ->execute();
            
            foreach ($eventos as $evento) {
                $row = array();
                $row["idevento"]    = $evento->getCaIdevento();           
                $row["fchevento"]   = $evento->getCaFchevento();
                $row["descripcion"] = utf8_encode($evento->getCaDescripcion());
                $row["pa"]          = utf8_encode($evento->getCaPa());
                $row["iddoc"]       = $iddoc;
                $row["tipodoc"]     = utf8_encode($evento->getCaTipoDoc());
                $row["documento"]   = $evento->getCaDocumento();
                $row["idcliente"]   = $evento->getCaIdcliente();
                $row["cliente"]     = $evento->getCliente()->getIds()->getCaNombre();
                $row["idsucursal"]  = $evento->getCaIdsucursal();
                $row["sucursal"]    = utf8_encode($evento->getSucursal()->getCaNombre());
                $row["perdida_ope"] = $evento->getCaPerdidaOpe();
                $row["perdida_leg"] = $evento->getCaPerdidaLeg();
                $row["perdida_eco"] = $evento->getCaPerdidaEco();
                $row["perdida_com"] = $evento->getCaPerdidaCom();
                $row["perdida_tot"] = $evento->getCaPerdidaTot();
                if($evento->getCaIdcausa())
                    $row["causa"]      = utf8_encode($evento->getIdgCausas()->getCaCausa());
                $data[] = $row;
            }
        }
        
        if (count($data) < 1)
            $data[]["idriesgo" . $idriesgo] = $idriesgo;
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "neventos" => count($eventos));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosFormEventos(sfWebRequest $request) {
        //$datos = $request->getParameter("data");
        //print_r($datos);
        
        $data = array();
        $iddoc = "";
        $caso = "CU054";
        
        if(!$request->getParameter("nuevo")){
            $idevento = $request->getParameter("idevento");
            $this->forward404Unless($idevento);
            
            $evento = Doctrine::getTable("IdgEventos")
                    ->createQuery("e")
                    ->select("e.*")
                    ->where("e.ca_idevento = ?", $idevento)
                    ->addOrderBy("e.ca_fchevento")
                    ->fetchOne();
            
            $iddoc = "";
            $caso = "CU054";
            if($evento->getCaTipoDoc()){               
                $c = ParametroTable::retrieveByCaso($caso, $evento->getCaTipoDoc());
                $iddoc = $c[0]->getCaIdentificacion();
            }    
            
            $data["idevento"]       = $evento->getCaIdevento();
            $data["idriesgo"]       = $evento->getCaIdriesgo();
            $data["fchevento"]      = $evento->getCaFchevento();
            $data["descripcion"]    = utf8_encode($evento->getCaDescripcion());
            $data["pa"]             = utf8_encode($evento->getCaPa());
            $data["iddoc"]          = $iddoc;
            $data["tipodoc"]        = utf8_encode($evento->getCaTipoDoc());
            $data["documento"]      = $evento->getCaDocumento();
            $data["idcliente"]      = $evento->getCaIdcliente();
            $data["cliente"]        = $evento->getCliente()->getIds()->getCaNombre();
            $data["idsucursal"]     = $evento->getCaIdsucursal();
            $data["sucursal"]       = utf8_encode($evento->getSucursal()->getCaNombre());
            $data["perdida_ope"]    = $evento->getCaPerdidaOpe();
            $data["perdida_leg"]    = $evento->getCaPerdidaLeg();
            $data["perdida_eco"]    = $evento->getCaPerdidaEco();
            $data["perdida_com"]    = $evento->getCaPerdidaCom();
            $data["perdida_tot"]    = $evento->getCaPerdidaTot();
            $data["idcausa"]        = $evento->getCaIdcausa();
            if($evento->getCaIdcausa())
                $data["causa"]      = utf8_encode($evento->getIdgCausas()->getCaCausa());
        }else{
            if($request->getParameter("iddoc")){
                $data["iddoc"] = $request->getParameter("iddoc");
                
                $c = ParametroTable::retrieveByCaso($caso, null, null, $request->getParameter("iddoc"));
                $data["tipodoc"] = utf8_encode($c[0]->getCaValor());
            }
            if($request->getParameter("documento"))
                $data["documento"] = $request->getParameter("documento");
            if($request->getParameter("idcliente")){
                $data["idcliente"] = $request->getParameter("idcliente");
                $data["cliente"] = utf8_encode(Doctrine::getTable("Cliente")->find($request->getParameter("idcliente")));
            }
            if($request->getParameter("idsucursal")){
                $data["idsucursal"] = $request->getParameter("idsucursal");                
            }
        }
        $this->responseArray = array("success" => true, "data" => $data, "total" => count($evento));

        $this->setTemplate("responseTemplate");
    }
    
    /**
     * @autor Andrea Ramírez
     * @return un objeto JSON con la variable succes representando exito o falla en la transaccion
     * @param sfRequest $request A request 
     *        datos : JSON con todos los elementos del house correspondiente a una evento especifica  * 
     * @date:  2016-04-25
     */
    
    public function executeGuardarFormEvento($request) {
        $idriesgo = $request->getParameter("idriesgo");
        $this->forward404Unless($idriesgo);
        try{
            $conn = Doctrine::getTable("IdgEventos")->getConnection();
            $conn->beginTransaction();
            
            if($request->getParameter("idevento")){
                $evento = Doctrine::getTable("IdgEventos")->find($request->getParameter("idevento"));
            }else{
                $evento = new IdgEventos();
            }
            if($request->getParameter("idriesgo")){
                $evento->setCaIdriesgo($idriesgo);
            }
            if($request->getParameter("fchevento")){
                $evento->setCaFchevento($request->getParameter("fchevento"));
            }
            if($request->getParameter("descripcion")){
                $evento->setCaDescripcion($request->getParameter("descripcion"));
            }
            if($request->getParameter("pa")){
                $evento->setCaPa(utf8_decode($request->getParameter("pa")));
            }
            if($request->getParameter("tipodoc")){
                $c = ParametroTable::retrieveQueryByCaso('CU054', null, null, $request->getParameter("tipodoc"));                
                $doc = $c->fetchOne();
                $evento->setCaTipoDoc($doc->getCaValor());
            }
            if($request->getParameter("documento")){
                $evento->setCaDocumento(utf8_decode($request->getParameter("documento")));
            }
            if($request->getParameter("idcliente")){
                $evento->setCaIdcliente($request->getParameter("idcliente"));
            }
            if($request->getParameter("idsucursal")){
                $evento->setCaIdsucursal($request->getParameter("idsucursal"));
            }            
            if($request->getParameter("perdida_ope")){
                $evento->setCaPerdidaOpe($request->getParameter("perdida_ope"));
            }
            if($request->getParameter("perdida_leg")){
                $evento->setCaPerdidaLeg($request->getParameter("perdida_leg"));
            }
            if($request->getParameter("perdida_eco")){
                $evento->setCaPerdidaEco($request->getParameter("perdida_eco"));
            }
            if($request->getParameter("perdida_com")){
                $evento->setCaPerdidaCom($request->getParameter("perdida_com"));
            }
            if($request->getParameter("perdida_tot")){
                $evento->setCaPerdidaTot($request->getParameter("perdida_tot"));
            }
            if($request->getParameter("idcausa")){
                $evento->setCaIdcausa($request->getParameter("idcausa"));
            }            
            $evento->save($conn);
            
            $riesgo = Dontrine::getTable("IdgRiesgos")->find($idriesgo);
            $proceso = $riesgo->getIdgProcesos();            
            $usuprocesos = Doctrine::getTable("IdgUsuProcesos")->findBy("ca_idproceso", $proceso->getCaIdproceso());
            
            $email = new Email();
            $email->setCaUsuenvio($this->getUser()->getUserId());
            $email->setCaTipo("Riesgos");
            $email->setCaIdcaso($evento->getCaIdevento());
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");
            $email->setCaSubject("Nuevo evento: ".  strtoupper($proceso->getCaNombre()));
            
            foreach($usuprocesos as $user){
                $logins[] = $user->getCaLogin();
            }            

            $request->setParameter("proceso", $proceso->getCaNombre());
            $request->setParameter("idevento", $evento->getCaIdevento());
            $request->setParameter("format", "email");
            
            $texto = sfContext::getInstance()->getController()->getPresentationFor('riesgos', 'emailEvento');
            $email->setCaBodyhtml($texto);

            /*foreach ($logins as $login) {                
                $usuario = Doctrine::getTable("Usuario")->find($login);
                $email->addTo($usuario->getCaEmail());
            }*/

            $email->save($conn);            
            
            $conn->commit();
            $this->responseArray = array("success"=>true,"text" => "Riesgos", "expanded" => true, "idevento" => $evento->getCaIdevento(), "idemail" => $email->getCaIdemail());
        }catch(Exception $e){
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage(), "doc"=>$doc);
        }
        $this->setTemplate("responseTemplate"); 
    }
    
    /**
     * @autor alramirez
     * @return un objeto JSON con los datos de Idg Causas
     * @date:  2016-07-22
     */
    public function executeDatosCausas(sfWebRequest $request) {
       
        $idriesgo = $request->getParameter("idriesgo");
        
        $data = array();
        if($idriesgo){
            $causas = Doctrine::getTable("IdgCausas")
                    ->createQuery("c")
                    ->where("c.ca_idriesgo = ?",$idriesgo)
                    ->orderBy("c.ca_fchcreado")
                    ->execute();
            
            foreach ($causas as $causa) {
                $data[] = array("id" => $causa->getCaIdcausa(), "valor" => utf8_encode($causa->getCaCausa()), "nueva"=>$causa->getCaNueva(), "fecha"=>$causa->getCaFchcreado());
            }
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEliminarCausas(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $iddeduccion = $request->getParameter("iddeduccion");

        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        try {
            $conn->beginTransaction();
            $deduccion = Doctrine::getTable("InoDeduccion")
                    ->createQuery("d")
                    ->addWhere("d.ca_iddeduccion = ? and d.ca_idcomprobante = ?", array($iddeduccion, $idcomprobante))
                    ->fetchOne();
            if ($deduccion) {
                $deduccion->delete();
                $conn->commit();
                $this->responseArray = array("success" => true);
            } else {
                $this->responseArray = array("success" => "error");
            }
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEmailEvento(sfWebRequest $request){
        
        $this->proceso = $request->getParameter("proceso");
        $idevento = $request->getParameter("idevento");
        
        $this->evento = Doctrine::getTable("IdgEventos")->find($idevento);
        
        $this->setLayout("none");
    }
    
    public function executeDatosFactor(sfWebRequest $request){        

        $data = array();
        $data[] = array("valor" => "Agentes");
        $data[] = array("valor" => "Clientes");
        $data[] = array("valor" => utf8_encode("Entes Públicos"));
        $data[] = array("valor" => "Entes Privados");
        $data[] = array("valor" => "Proveedores");
        $data[] = array("valor" => "Todos los colaboradores");
        
        /*$cargos = Doctrine::getTable("Cargo")
                ->createQuery("c")
                ->leftJoin("c.Empresa e")
                ->where("c.ca_activo = ?", true)
                ->orderBy("c.ca_cargo, e.ca_idempresa")
                ->execute();*/
        
        $cargos = ParametroTable::retrieveByCaso("CU266");                
        
        foreach ($cargos as $cargo) {            
            $data[] = array("valor" => utf8_encode($cargo->getCaValor()) ,"empresa" => utf8_encode($cargo->getCaValor2()));
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeHtmlProceso(sfWebRequest $request){        

        $idproceso = $request->getParameter("idproceso");
        $this->proceso = Doctrine::getTable("IdgProcesos")->find( $idproceso );
        $this->forward404Unless( $this->proceso );
        
        $this->riesgos=$this->proceso->getIdgRiesgos();        
        $this->responsables = $this->proceso->getIdgUsuProcesos();                
        $this->user = $this->getUser();
        
        $this->setLayout("none");
    }
    
    public function executeHtmlRiesgo(sfWebRequest $request){        

        $idriesgo = $request->getParameter("idriesgo");        
        $this->riesgo = Doctrine::getTable("IdgRiesgos")->find($idriesgo);        
        $this->forward404Unless( $this->riesgo );
        
        $this->proceso = $this->riesgo->getIdgProcesos();
        $this->nriesgo = $request->getParameter("nriesgo");
        $this->triesgos = $request->getParameter("triesgos");
        $this->user = $this->getUser();        
        $this->val = $this->riesgo->getUltimaValoracion();
        if($this->val){
            $datosVal = json_decode($this->val->getCaDatos());
            $this->operativo = utf8_decode($datosVal->operativo);
            $this->legal = utf8_decode($datosVal->legal);
            $this->economico = utf8_decode($datosVal->economico);
            $this->comercial = utf8_decode($datosVal->comercial);
        }
        
        $this->setLayout("none");
    }
    
    public function executePdfProceso(sfWebRequest $request) {
        $idproceso=$request->getParameter("idproceso");
        $user = $this->getUser();
        
        $q = Doctrine::getTable("IdgProcesos")
                ->createQuery("p")
                ->orderBy("ca_nombre");
        
        if($idproceso){
            $q->addWhere("ca_idproceso = ?", $idproceso);
        }
        
        $procesos = $q->execute();
        
        ob_start();
        ini_set('display_errors', 'on');
        $pdf = new TCPDF("L", PDF_UNIT, "LEGAL", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Coltrans');
        $pdf->SetMargins(2, 2, 2,true);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('helvetica', '', 10);
        
        foreach($procesos as $proceso){
        
            $riesgos = $proceso->getIdgRiesgos();
            $i=1;
            $triesgos = count($riesgos);
            foreach($riesgos as $riesgo){

                $pdf->AddPage('', '',true);            
                $this->getRequest()->setParameter('idriesgo',$riesgo->getCaIdriesgo());
                $this->getRequest()->setParameter('nriesgo',$i);
                $this->getRequest()->setParameter('triesgos',$triesgos);            
                $html=sfContext::getInstance()->getController()->getPresentationFor( 'riesgos', 'htmlRiesgo');
                $html=utf8_encode($html);

                $pdf->writeHTML($html, true, false, true, false, '');
                $i++;
            }
        }
        
        $pdf->lastPage();
        //ob_end_clean();
        $pdf->Output('Informe de Riesgos.pdf', 'I');
        ob_end_flush();

       exit;
    }
    
    public function executeDatosGraficaxRiesgo(sfWebRequest $request){
        $idriesgo = $request->getParameter("idriesgo");
        $idproceso = $request->getParameter("idproceso");
        
        $q = new Doctrine_RawSql();
        
        $q->select('{vl.*}');
        $q->from("idg.tb_valoracion vl
                LEFT JOIN idg.tb_riesgos r ON r.ca_idriesgo = vl.ca_idriesgo
                INNER JOIN (SELECT ca_idriesgo, max(ca_ano) as ca_ano 
                            FROM idg.tb_valoracion 
                            GROUP BY ca_idriesgo order by ca_idriesgo) ul on ul.ca_idriesgo = vl.ca_idriesgo and ul.ca_ano = vl.ca_ano");

        $q->addComponent('vl', 'IdgValoracion vl');
        $q->addComponent('r', 'vl.IdgRiesgos r');
        
        if($idriesgo){            
            $q->addWhere("vl.ca_idriesgo = ?", $idriesgo);
        }
        if($idproceso){
            $q->addWhere("r.ca_idproceso = ?", $idproceso);
        }
        
        $valores = $q->execute();       
        $data = array();
        
        foreach($valores as $valor){
            $tolerable = (($valor->getCaOperativo()*10*0.01)+($valor->getCaLegal()*30*0.01)+($valor->getCaEconomico()*40*0.01)+($valor->getCaComercial()*20*0.01));
            $data[] = array(
                'idriesgo' => $valor->getCaIdriesgo(),
                'ano' => $valor->getCaAno(),
                'tolerable'=> $valor->getCaPeso(),
                'data1'=>$tolerable,
                'score'=>$tolerable*$valor->getCaPeso(),
                'codigo'=>$valor->getIdgRiesgos()->getCaCodigo()
                    );
            //$data["data1"][] = $valor->getCaPeso();
            //$data["tolerable"][] = (($valor->getCaOperativo()*10*0.01)+($valor->getCaLegal()*30*0.01)+($valor->getCaEconomico()*40*0.01)+($valor->getCaComercial()*20*0.01));
            //$data["score"] = $data["tolerable"]*$valor->getCaPeso();            
        }
       
        //Funcion que verifica valores repetidos en un array
        $k=0.2;
        for($i=0;$i<count($data);$i++){
            for($j=0;$j<count($data);$j++){
                if($i!=$j){
                    if($data[$i]["data1"]==$data[$j]["data1"]){
                        $data[$i]["data1"]+=$k;
                        $k+=0.2;
                    }
                }
            }
        }
        
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * @autor alramirez
     * @return un objeto JSON con los datos de Idg Causas
     * @date:  2016-07-22
     */
    public function executeDatosFormImpacto(sfWebRequest $request) {
       
        $id = $request->getParameter("idvaloracion");
        
        $val = Doctrine::getTable("IdgValoracion")->find($id);
        $this->forward404Unless($val);
        
        $data = array();
        
        if($val->getCaDatos())
            $data = json_decode($val->getCaDatos(),true);
        
        $this->responseArray = array("success" => true, "data" =>$data , "total" => count($data), "id" => $id, "d1"=>json_decode($val->getCaDatos()));        
        
        $this->setTemplate("responseTemplate");
    }
    
    
    /**
     * @autor alramirez
     * @return un objeto JSON con los datos de Idg Causas
     * @date:  2016-07-22
     */
    public function executeGuardarFormImpacto(sfWebRequest $request) {
        
        $idval = $request->getParameter("idvaloracion");        
        $val = Doctrine::getTable("IdgValoracion")->find($idval);
        $this->forward404Unless($val);
        
        $data = array();
       
        $data["operativo"] = utf8_encode($request->getParameter("operativo"));
        $data["legal"] = utf8_encode($request->getParameter("legal"));
        $data["economico"] = utf8_encode($request->getParameter("economico"));
        $data["comercial"] = utf8_encode($request->getParameter("comercial"));
        
        $datos = json_encode($data);
        
        $val->setCaDatos($datos);
        $val->save();
        
        $this->responseArray = array("success" => true, "data" =>$datos , "total" => count($data));        
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGraficaAreaxRiesgo(sfWebRequest $request){
        
        $idriesgo = $request->getParameter("idriesgo");
        $idproceso = $request->getParameter("idproceso");
        
        // Data que gráfica el área 
        $data[] = array ( "x"=> 1,"aceptable"=> 6, "tolerable"=> 0, "critico"=> 0, "critico"=> 0);
        $data[] = array ( "x"=> 2, "aceptable"=> 6, "tolerable"=> 0, "critico"=> 0, "critico"=> 0);                
        $data[] = array ( "x"=> 2, "aceptable"=> 3, "tolerable"=> 3, "critico"=> 0, "critico"=> 0);                
        $data[] = array ( "x"=> 3, "aceptable"=> 3, "tolerable"=> 3, "critico"=> 0, "critico"=> 0);                
        $data[] = array ( "x"=> 3, "aceptable"=> 2, "tolerable"=> 4, "critico"=> 0, "critico"=> 0);                               
        $data[] = array ( "x"=> 5, "aceptable"=> 2, "tolerable"=> 4, "critico"=> 0, "critico"=> 0);
        $data[] = array ( "x"=> 5, "aceptable"=> 2, "tolerable"=> 3, "critico"=> 1, "mcritico"=> 0);               
        $data[] = array ( "x"=> 6, "aceptable"=> 2, "tolerable"=> 3, "critico"=> 1, "mcritico"=> 0);
        $data[] = array ( "x"=> 6, "aceptable"=> 1, "tolerable"=> 4, "critico"=> 1, "mcritico"=> 0);                
        $data[] = array ( "x"=> 7, "aceptable"=> 1, "tolerable"=> 4, "critico"=> 1, "mcritico"=> 0);
        $data[] = array ( "x"=> 7, "aceptable"=> 1, "tolerable"=> 3, "critico"=> 2, "mcritico"=> 0);                
        $data[] = array ( "x"=> 9, "aceptable"=> 1, "tolerable"=> 3, "critico"=> 2, "mcritico"=> 0);
        $data[] = array ( "x"=> 9, "aceptable"=> 1, "tolerable"=> 2, "critico"=> 3, "mcritico"=> 0);                           
        $data[] = array ( "x"=> 12, "aceptable"=> 1, "tolerable"=> 2, "critico"=> 3, "mcritico"=> 0);
        $data[] = array ( "x"=> 12, "aceptable"=> 1, "tolerable"=> 2, "critico"=> 2, "mcritico"=> 1);                
        $data[] = array ( "x"=> 13, "aceptable"=> 1, "tolerable"=> 2, "critico"=> 2, "mcritico"=> 1);
        $data[] = array ( "x"=> 13, "aceptable"=> 1, "tolerable"=> 1, "critico"=> 3, "mcritico"=> 1);
        $data[] = array ( "x"=> 15, "aceptable"=> 1, "tolerable"=> 1, "critico"=> 3, "mcritico"=> 1);
        $data[] = array ( "x"=> 15, "aceptable"=> 1, "tolerable"=> 1, "critico"=> 2, "mcritico"=> 2);        
        $data[] = array ( "x"=> 20, "aceptable"=> 1, "tolerable"=> 1, "critico"=> 2, "mcritico"=> 2);
        $data[] = array ( "x"=> 20, "aceptable"=> 1, "tolerable"=> 1, "critico"=> 1, "mcritico"=> 3);
        $data[] = array ( "x"=> 21, "aceptable"=> 1, "tolerable"=> 1, "critico"=> 1, "mcritico"=> 3);
        
        
        $q = new Doctrine_RawSql();        
        $q->select('{vl.*}');
        $q->from("idg.tb_valoracion vl
                LEFT JOIN idg.tb_riesgos r ON r.ca_idriesgo = vl.ca_idriesgo
                INNER JOIN (SELECT ca_idriesgo, max(ca_ano) as ca_ano 
                            FROM idg.tb_valoracion 
                            GROUP BY ca_idriesgo order by ca_idriesgo) ul on ul.ca_idriesgo = vl.ca_idriesgo and ul.ca_ano = vl.ca_ano");

        $q->addComponent('vl', 'IdgValoracion vl');
        $q->addComponent('r', 'vl.IdgRiesgos r');
        
        if($idriesgo){            
            $q->addWhere("vl.ca_idriesgo = ?", $idriesgo);
        }
        if($idproceso){
            $q->addWhere("r.ca_idproceso = ?", $idproceso);
        }
        $valores = $q->execute();       
        
        
        
        if(!empty($valores)){
            foreach($valores as $valor){
                $impacto = (($valor->getCaOperativo()*10*0.01)+($valor->getCaLegal()*30*0.01)+($valor->getCaEconomico()*40*0.01)+($valor->getCaComercial()*20*0.01));
                $grafica[] = array(
                    'idriesgo' => $valor->getCaIdriesgo(),
                    'ano' => $valor->getCaAno(),
                    'probabilidad'=> $valor->getCaPeso(),
                    'dataImpacto'=>$impacto,
                    'score'=>$impacto*$valor->getCaPeso(),
                    'codigo'=>$valor->getIdgRiesgos()->getCaCodigo()
                );            
            }         

            //echo "<pre>";print_r($grafica);echo "</pre>";

            // Data que grafica los valores de cada riesgo
            if(!empty($grafica)){
                foreach($grafica as $g){
                    $data[] = array(
                        "impacto"=>$g["dataImpacto"], 
                        "probabilidad"=>$g["probabilidad"], 
                        "codigo"=>$g["codigo"], 
                        "idriesgo"=>$g["idriesgo"],
                        "score"=>$g["score"]                    
                    );        
                }
            }

            /*Funcion que verifica valores repetidos en un array
             Por solicitud del usuario se corren en Y los riesgos que esten en el mismo valor.
            **/
            for($i=0;$i<count($data);$i++){
                for($j=0;$j<count($data);$j++){
                    if($i!=$j){
                        /*if($data[$i]["impacto"].""==$data[$j]["impacto"].""){
                            $data[$i]["impacto"]++;
                            $i = 0;
                            $j = 0;
                        }*/
                        //$dataImpactoIni = $data[$j]["impacto"];
                        $izquierdo = $data[$j]["impacto"]-0.5;                    
                        $derecho = $data[$j]["impacto"]+0.5;
                        if(($data[$i]["impacto"]>=$izquierdo && $data[$i]["impacto"]<=$derecho)&& ($data[$i]["probabilidad"]==$data[$j]["probabilidad"])){
                            $data[$i]["probabilidad"]=$data[$i]["probabilidad"]+0.16;
                            $i = 0;
                            $j = 0;
                        }
                        if($data[$i]["probabilidad"]==1){
                            $data[$i]["probabilidad"]=$data[$i]["probabilidad"]+0.16;
                        }
                    }
                }
            }
        }
        
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true, "debug"=>$q->getSqlQuery());
        $this->setTemplate("responseTemplate");
    }
    
    public function executeNuevoEventoExt5( sfWebRequest $request ){
        
        $this->idriesgo = $request->getParameter("idriesgo");
        $this->idproceso = $request->getParameter("idproceso");
        $this->iddoc = $request->getParameter("iddoc");
        $this->documento = $request->getParameter("documento");
        
        $this->proceso = Doctrine::getTable("IdgProcesos")->find($request->getParameter("idproceso"));
        $this->riesgo = Doctrine::getTable("IdgRiesgos")->find($request->getParameter("idriesgo"));
        $this->nombre = strip_tags($this->riesgo->getCaRiesgo());
        
        switch($request->getParameter("iddoc")){
            case 1: // Cotización
                $cotizacion = Doctrine::getTable("Cotizacion")->find($request->getParameter("documento"));
                $this->documento = $cotizacion->getCaConsecutivo();
                $this->idcliente = $cotizacion->getContacto()->getCliente()->getCaIdcliente();
                $this->idsucursal = $cotizacion->getContacto()->getCliente()->getUsuario()->getCaIdsucursal();
                break;
            case 2: // Reporte de Negocios
                $cotizacion = Doctrine::getTable("Cotizacion")->find($request->getParameter("documento"));
                $this->documento = $cotizacion->getCaConsecutivo();
                $this->idcliente = $cotizacion->getContacto()->getCliente()->getCaIdcliente();
                $this->idsucursal = $cotizacion->getContacto()->getCliente()->getUsuario()->getCaIdsucursal();
                break;
        }        
    }
}
?>