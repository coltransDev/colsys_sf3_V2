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

        
    }
    
    public function executeIndexExt5() {
        
        $ponderacion = ParametroTable::retrieveByCaso("CU276");
        
        $criterios[] = array ("name"=> 'idcargo', "type"=> "integer");
        $criterios[] = array ("name"=> 'cargoiso', "type"=> "string");
        $criterios[] = array ("name"=> 'impacto', "type"=> "float");
        $criterios[] = array ("name"=> 'todos', "type"=> "float");
        $criterios[] = array ("name"=> 'pondfinal', "type"=> "float");
        $criterios[] = array ("name"=> 'total', "type"=> "float");
        $criterios[] = array ("name"=> 'color', "type"=> "string");
                       
        foreach($ponderacion as $p){            
            $criterios[] = array("name"=> utf8_encode($p->getCaValor()), "type"=>"string");            
            $headers[] = utf8_encode($p->getCaValor());
        }
        
        $this->criterios = $criterios;
        $this->headers = $headers;        
    }



    function executeDatosProcesos($request) {
        
        $user = $this->getUser();        
        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA);         
        /*Accesos solicitados para el método*/
        $acceso = $user->getControlAccesoMetodo($permisosRutinas, self::EDITAR);
        
        $sql = "SELECT p.ca_idproceso, p.ca_nombre, r.ca_idriesgo, r.ca_codigo, r.ca_riesgo, r.ca_laft
                FROM idg.tb_procesos p
                    LEFT OUTER JOIN idg.tb_riesgos r on p.ca_idproceso = r.ca_idproceso
                WHERE r.ca_activo = TRUE
                ORDER BY p.ca_nombre, r.ca_codigo";
        
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $riesgos = $st->fetchAll();
        
        $data =  $childrens = $verProceso = array();         
        $clase = null;
        $uno = true;
        
        $procesos = Doctrine::getTable("IdgProcesos")->createQuery("p")->execute();
        
        foreach($procesos as $proceso){
            $hijos = [];
            $versiones = $proceso->getIdgVersion();
            
            if($versiones){
                foreach($versiones as $version){
                    $hijos[] = array(
                        "text"=> utf8_encode($version->getCaNombre()), 
                        "leaf"=>true, 
                        "iconCls" => 'fa fa-file-pdf',
                        "descripcion" => "<span style='color:blue; font-weight: bold;'>".utf8_encode($version->getCaNombre())."</span><div>Version:".$version->getCaVersion()."</br>Notas: ". utf8_encode($version->getCaObservaciones())."<br/>Usucreado:".$version->getCaUsucreado()."</br>Fchcreado:".$version->getCaFchcreado()."</div>",
                        "idproceso" => $proceso->getCaIdproceso(),
                        "idversion" => $version->getCaId(),
                        "usucreado" => $version->getCaUsucreado(),
                        "fchcreado" => $version->getCaFchcreado()
                    );
                }
                if(count($hijos) >0){
                    $verProceso[$proceso->getCaIdproceso()] = $hijos;
                }
            }
        }
        
        foreach ($riesgos as $riesgo) {            
            if ($uno) {
                $proceso = utf8_encode($riesgo["ca_nombre"]);                
                $uno = false;                
                if(count($verProceso[$riesgo["ca_idproceso"]])>0){
                    $childrens[] = array("text"=>"Versiones", "iconCls"=> 'fa fa-code-branch', "children"=>$verProceso[$riesgo["ca_idproceso"]]);
                }
            }
            
            if ($proceso != utf8_encode($riesgo["ca_nombre"])) {                                               
                $data[] = array("text" => $proceso, "idproceso"=>$idproceso,"expanded" => false, "children" => $childrens);
                $proceso = utf8_encode($riesgo["ca_nombre"]);
                
                $childrens = array();
                if(count($verProceso[$riesgo["ca_idproceso"]])>0){
                    $childrens[] = array("text"=>"Versiones", "iconCls"=> 'fa fa-code-branch', "children"=>$verProceso[$riesgo["ca_idproceso"]]);
                }
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
        //$datosCausas = json_decode($request->getParameter("datosGrid"), true);
        
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
            }else{
                $riesgo->setCaLaft(false);
            }
            
            if($datos["ca_riesgo"]){
                if (count($root) < 1)
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
            
//            if($nfactor && is_array($nfactor) && count($nfactor)>0){                
//                $factores = Doctrine::getTable("IdgFactor")
//                        ->createQuery("f")
//                        ->where("f.ca_idriesgo = ?", $riesgo->getCaIdriesgo())
//                        ->execute();
//                            
//                if($factores){
//                    foreach($factores as $factor){
//                        if(!in_array($factor->getCaFactor(), $nfactor))
//                            $factor->delete($conn);
//                    }
//                }
//            
//                foreach($nfactor as $key => $val){
//                    $factor = Doctrine::getTable("IdgFactor")->find(array($riesgo->getCaIdriesgo(), $val));
//                    if(!$factor){
//                        $factor = new IdgFactor();                    
//                        $factor->setCaIdriesgo($riesgo->getCaIdriesgo());
//                        $factor->setCaFactor(utf8_decode($val));
//                        $factor->save($conn);
//                    }
//                }
//            
//            }
//            if($datosCausas){
//                foreach($datosCausas as $grid){
//                    if($grid["valor"]!=""){
//                        if(is_int($grid["id"])){
//                            $causa = Doctrine::getTable("IdgCausas")->find($grid["id"]);                                                        
//                        }else{
//                            $causa = new IdgCausas();
//                            $causa->setCaIdriesgo($riesgo->getCaIdriesgo());                            
//                        }               
//                    $causa->setCaCausa(utf8_decode($grid["valor"]));
//                    $causa->setCaNueva($grid["nueva"]);
//                    $causa->save($conn);
//                    }else{
//                        if(is_int($grid["id"])){
//                            $causa = Doctrine::getTable("IdgCausas")->find($grid["id"]); 
//                            $causa->delete();
//                        }
//                    }
//                }            
//            }            
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
                $causa = "";
                
                $row["idevento"]    = $evento->getCaIdevento();           
                $row["fchevento"]   = $evento->getCaFchevento();
                $row["descripcion"] = utf8_encode($evento->getCaDescripcion());
                $row["pa"]          = utf8_encode($evento->getCaPa());
                $row["iddoc"]       = $iddoc;
                $row["tipodoc"]     = utf8_encode($evento->getCaTipoDoc());
                $row["documento"]   = utf8_encode($evento->getCaDocumento());
                $row["idcliente"]   = $evento->getCaIdcliente();
                $row["cliente"]     = utf8_encode($evento->getCliente()->getIds()->getCaNombre());
                $row["idsucursal"]  = $evento->getCaIdsucursal();
                $row["sucursal"]    = utf8_encode($evento->getSucursal()->getCaNombre());
                $row["perdida_ope"] = $evento->getCaPerdidaOpe();
                $row["perdida_leg"] = $evento->getCaPerdidaLeg();
                $row["perdida_eco"] = $evento->getCaPerdidaEco();
                $row["perdida_com"] = $evento->getCaPerdidaCom();
                $row["perdida_tot"] = $evento->getCaPerdidaTot();
                $row["fchcreado"]   = $evento->getCaFchcreado();
                $row["usucreado"]   = $evento->getCaUsucreado();
//                if($evento->getCaIdcausa())
//                    $row["causa"]      = utf8_encode($evento->getIdgCausas()->getCaCausa());
                
                $eventosCausas = Doctrine::getTable("IdgEventoCausa")->findBy("ca_idevento", $evento->getCaIdevento());
                
                if($eventosCausas->count() > 0){
                    foreach($eventosCausas as $ec){
                        $causa.= "- ". utf8_encode($ec->getIdgCausas()->getCaCausa())."<br/>";
                    }
                }
                $row["causa"] = $causa;
                $data[] = $row;
            }
        }
        
        if (count($data) < 1)
            $data[]["idriesgo" . $idriesgo] = $idriesgo;
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "neventos" => count($eventos));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosFormEventos(sfWebRequest $request) {
        
        $data = array();
        $iddoc = "";
        $caso = "CU054";

        if (!$request->getParameter("nuevo")) {
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
            if ($evento->getCaTipoDoc()) {
                $c = ParametroTable::retrieveByCaso($caso, $evento->getCaTipoDoc());
                $iddoc = $c[0]->getCaIdentificacion();
            }

            $data["idevento"] = $evento->getCaIdevento();
            $data["idriesgo"] = $evento->getCaIdriesgo();
            $data["fchevento"] = $evento->getCaFchevento();
            $data["descripcion"] = utf8_encode($evento->getCaDescripcion());
            $data["pa"] = utf8_encode($evento->getCaPa());
            $data["iddoc"] = $iddoc;
            $data["tipodoc"] = utf8_encode($evento->getCaTipoDoc());
            $data["documento"] = utf8_encode($evento->getCaDocumento());
            $data["idcliente"] = $evento->getCaIdcliente();
            $data["cliente"] = $evento->getCliente()->getIds()->getCaNombre();
            $data["idsucursal"] = $evento->getCaIdsucursal();
            $data["sucursal"] = utf8_encode($evento->getSucursal()->getCaNombre());
            $data["perdida_ope"] = $evento->getCaPerdidaOpe();
            $data["perdida_leg"] = $evento->getCaPerdidaLeg();
            $data["perdida_eco"] = $evento->getCaPerdidaEco();
            $data["perdida_com"] = $evento->getCaPerdidaCom();
            $data["perdida_tot"] = $evento->getCaPerdidaTot();

            $causas = $evento->getIdgEventoCausa();

            if ($causas) {
                foreach ($causas as $causa) {
                    $data["ncausa[]"][] = utf8_encode($causa->getCaIdcausa());
                }
            }
        } else {
            if ($request->getParameter("iddoc")) {
                $data["iddoc"] = $request->getParameter("iddoc");

                $c = ParametroTable::retrieveByCaso($caso, null, null, $request->getParameter("iddoc"));
                $data["tipodoc"] = utf8_encode($c[0]->getCaValor());
            }
            
            if ($request->getParameter("documento"))
                $data["documento"] = $request->getParameter("documento");
            
            if ($request->getParameter("idcliente")) {
                $data["idcliente"] = $request->getParameter("idcliente");
                $data["cliente"] = utf8_encode(Doctrine::getTable("Cliente")->find($request->getParameter("idcliente")));
            }
            
            if ($request->getParameter("idsucursal")) {
                $data["idsucursal"] = $request->getParameter("idsucursal");
            }
            
            if ($request->getParameter("descripcion")) {
                $data["descripcion"] = $request->getParameter("descripcion");
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
        $datos = json_decode($request->getParameter("datos"), true);        
        $ncausa = $datos["ncausa[]"]?$datos["ncausa[]"]:[];
        
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
                $evento->setCaDescripcion(utf8_decode($request->getParameter("descripcion")));
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
            /*if($request->getParameter("idcausa")){
                $evento->setCaIdcausa($request->getParameter("idcausa"));
            } */           
            $evento->save($conn);
            
            $causas = Doctrine::getTable("IdgEventoCausa")->createQuery("ec")->where("ca_idevento = ?", $evento->getCaIdevento())->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();
            
            /*Elimina las causas que sean eliminadadas del evento*/
            if(count($causas)>0){
                foreach($causas as $key => $arrayCausa){
                    //print_r($arrayCausa);
                    if(!in_array($arrayCausa["ca_idcausa"], $ncausa)){
                        $eventoCausa = Doctrine::getTable("IdgEventoCausa")->find(array($evento->getCaIdevento(), $arrayCausa["ca_idcausa"]));
                        $eventoCausa->delete($conn);
                    }
                }
            }
            
            /*Crea las causas que no existan en el evento*/
            if(count($ncausa) >0){
                foreach($ncausa as $key => $idcausa){
                    $eventoCausa = Doctrine::getTable("IdgEventoCausa")->find(array($evento->getCaIdevento(), $idcausa));

                    if(!$eventoCausa){
                        $eventoCausa = new IdgEventoCausa();
                        $eventoCausa->setCaIdevento($evento->getCaIdevento());
                        $eventoCausa->setCaIdcausa($idcausa);
                        $eventoCausa->save($conn);
                    }
                }
            }
            
            $riesgo = Doctrine::getTable("IdgRiesgos")->find($idriesgo);
            $proceso = $riesgo->getIdgProcesos();            
            $sucevento = Doctrine::getTable("Sucursal")->find($request->getParameter("idsucursal"));
            
            
            $email = new Email();
            $email->setCaUsuenvio($this->getUser()->getUserId());
            $email->setCaTipo("Riesgos");
            $email->setCaIdcaso($evento->getCaIdevento());
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");
            $email->setCaSubject("NUEVO EVENTO REPORTADO: ".  strtoupper($proceso->getCaNombre()));
            
            $request->setParameter("proceso", $proceso->getCaNombre());
            $request->setParameter("idevento", $evento->getCaIdevento());
            $request->setParameter("format", "email");
            
            $texto = sfContext::getInstance()->getController()->getPresentationFor('riesgos', 'emailEvento');
            $email->setCaBodyhtml($texto);
            
            $usuprocesos = Doctrine::getTable("IdgUsuProcesos")->findBy("ca_idproceso", $proceso->getCaIdproceso());
            $admons = UsuarioTable::getUsuariosxPerfil("admon-riesgos-colsys");
                    
            foreach($usuprocesos as $user){                
                $logins[] = $user->getCaLogin();
            }
            foreach ($admons as $a) {
                $logins[] = $a->getCaLogin();                
            }
//            print_r($logins);
            foreach ($logins as $login) {                
                $usuario = Doctrine::getTable("Usuario")->find($login);
                if(!in_array($usuario->getCaEmail(), $logins)){
                    if($usuario->getSucursal()->getCaNombre() == $sucevento->getCaNombre()){
                        if($usuario->getCaActivo())
                            $email->addTo($usuario->getCaEmail());
                    }
                }
            }
            
            $email->addCC($this->getUser()->getEmail());
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
            $q = Doctrine::getTable("IdgCausas")
                    ->createQuery("c")
                    ->where("c.ca_idriesgo = ?",$idriesgo)
                    ->orderBy("c.ca_orden ASC");
            
            if($request->getParameter("idcausa")){
                $q->addWhere("c.ca_idcausa = ?", $request->getParameter("idcausa"));
            }
            
            $debug = $q->getSqlQuery();            
            $causas = $q->execute();
            
            foreach ($causas as $causa) {
                $data[] = array(
                    "idriesgo"=>$causa->getCaIdriesgo(), 
                    "id" => $causa->getCaIdcausa(), 
                    "orden" => $causa->getCaOrden(), 
                    "causa" => utf8_encode(strip_tags($causa->getCaCausa())), 
                    "nueva"=>$causa->getCaNueva(), 
                    "fecha"=>$causa->getCaFchcreado(), 
                    "orden"=>$causa->getCaOrden()
                );                
                $dataForm["idriesgo"] = $causa->getCaIdriesgo();
                $dataForm["id"] = $causa->getCaIdcausa();
                $dataForm["nueva"] = $causa->getCaNueva()?TRUE:FALSE;
                $dataForm["causa"] = utf8_encode(strip_tags($causa->getCaCausa()));
                $dataForm["orden"] = $causa->getCaOrden();
            }
        }
        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true, "debug"=>$debug, "data"=>$dataForm);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEmailEvento(sfWebRequest $request){
        
        $this->proceso = $request->getParameter("proceso");
        $idevento = $request->getParameter("idevento");
        
        $this->evento = Doctrine::getTable("IdgEventos")->find($idevento);        
        $this->nriesgo = strip_tags($this->evento->getIdgRiesgos()->getCaRiesgo());
        $this->descripcion = strip_tags($this->evento->getCaDescripcion());
        
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
    
    public function executeDatosTreeFactores(sfWebRequest $request){        

        $root = $data = $cargosempresa = array();
        $cargos = Doctrine::getTable("CargosIso")
                ->createQuery("ci")
                ->innerJoin("ci.Empresa e")
                ->where("ci.ca_activo = TRUE")
                ->execute();
        
        foreach ($cargos as $cargo) {
            if(!in_array($cargo->getEmpresa()->getCaNombre(), $cargosempresa))
                $cargosempresa[] = $cargo->getEmpresa()->getCaNombre();
        }
        
        foreach($cargosempresa as $key => $empresa){                                
            $root = array(
                "text" => utf8_encode($empresa),
                "iconCls" => 'x-fa fa-database'
            );
            foreach ($cargos as $cargo) {
                if($cargo->getEmpresa()->getCaNombre() == $empresa){
                    $root["children"][] = array(
                        "text" =>  utf8_encode($cargo->getCaCargoiso()),
                        "iconCls" => 'x-fa fa-home',                        
                        "leaf" => true
                    );
                }                
            }
            $data[] = $root;            
        }
        
        $otros = ParametroTable::retrieveByCaso("CU266");
        $root = array("text" => "Otros","iconCls" => 'x-fa fa-database');
        foreach($otros as $otro){
            $root["children"][] = array(
                "text" =>  utf8_encode($otro->getCaValor()),
                "iconCls" => 'x-fa fa-home',                        
                "leaf" => true
            );            
        }
        
        $data[] = $root;
        
        $this->responseArray = array("text" => "Riesgos", "expanded" => true, "children" => $data);        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosTreeFactorRiesgo(sfWebRequest $request){        

        $idriesgo = $request->getParameter("idriesgo");
        
        $factores = Doctrine::getTable("IdgFactor")->findBy("ca_idriesgo",$idriesgo);
        
        foreach($factores as $factor){
            $root = array(
                "text" => utf8_encode($factor->getCaFactor()),                
                "iconCls" => 'x-fa fa-database',
                "leaf" => true
            );
            $data[] = $root;
        }
                
                
        $this->responseArray = array("text" => "Riesgos", "expanded" => true, "children" => $data);        
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
        $this->tipo = $request->getParameter("tipo");
        $this->version = $request->getParameter("version");
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
        $laft = $request->getParameter("laft");
        
        if($request->getParameter("tipo")){
            $tipo = $request->getParameter("tipo");            
            
            $conn = Doctrine::getTable("IdgProcesos")->getConnection();
            $conn->beginTransaction();
        
            try{
            
                $proceso = Doctrine::getTable("IdgProcesos")->find($idproceso);
                $filename = $request->getParameter("filename");

                $version = new IdgVersion();
                $version->setCaVersion($proceso->getUltimaVersion());
                $version->setCaIdproceso($idproceso);
                $version->setCaNombre(utf8_decode($request->getParameter("filename")));
                $version->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
                $version->save($conn);
                $conn->commit();
                
            }catch(Exception $e){
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
            }
        }
        
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
            $q = Doctrine::getTable("IdgRiesgos")
                    ->createQuery("r")
                    ->where("ca_idproceso = ?", $proceso->getCaIdproceso());
            
            if($laft == "si"){
                $q->addWhere("ca_laft = ?", true);
            }
            
            $q->orderBy("ca_codigo ASC");
            $riesgos = $q->execute();           
            
            $i=1;
            $triesgos = count($riesgos);
            foreach($riesgos as $riesgo){                
                if($riesgo->getCaActivo() == true){
                    //if(!$laft || ($laft=="si" && $riesgo->getCaLaft() == true)){
                        $pdf->AddPage('', '',true);            
                        $this->getRequest()->setParameter('idriesgo',$riesgo->getCaIdriesgo());
                        $this->getRequest()->setParameter('nriesgo',$i);
                        $this->getRequest()->setParameter('triesgos',$triesgos); 
                        $this->getRequest()->setParameter('tipo',$tipo);
                        $this->getRequest()->setParameter('version',$version);
                        $html=sfContext::getInstance()->getController()->getPresentationFor( 'riesgos', 'htmlRiesgo');
                        $html=utf8_encode($html);

                        $pdf->writeHTML($html, true, false, true, false, '');
                        $i++;
                    //}
                }                
            }
        }
        
        $pdf->lastPage();
        //ob_end_clean();
        if($tipo == "repos"){
                
                $directorio = $proceso->getDirectorio().DIRECTORY_SEPARATOR."versiones".DIRECTORY_SEPARATOR.$version->getCaId();
                
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }
                
                $pdf->Output($directorio . DIRECTORY_SEPARATOR.$filename.'.pdf', 'F');
                $this->responseArray = array("success" => true, "idproceso"=>$idproceso, "mensaje"=> utf8_encode("Versión guardada correctamente"));
            
            
        }else{
            $pdf->Output('Informe de Riesgos.pdf', 'I');
            ob_end_flush();
            exit;
        }
        $this->setTemplate("responseTemplate");   
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
                LEFT JOIN idg.tb_riesgos r ON r.ca_idriesgo = vl.ca_idriesgo AND r.ca_activo = TRUE
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
//        echo $q->getSqlQuery();
//        exit();
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
        
        $this->idproceso = $request->getParameter("idproceso");
        $this->idtipo = $request->getParameter("idtipo");
        $this->documento = $request->getParameter("documento");
        
        if( $this->idproceso){
            $this->proceso = Doctrine::getTable("IdgProcesos")->find($this->idproceso);
        }
        
        switch($this->idtipo){
            case 0: // INOs
                $master = Doctrine::getTable("InoMaster")->find($this->documento);                
                $impoexpo = $master->getCaImpoexpo();
                $transporte = $master->getCaTransporte();
                
                if($impoexpo == "Importación" && $transporte == "Marítimo"){
                    $this->idtipo = 4;
                    $this->idproceso = 11;
                }else if($impoexpo == "Importación" && $transporte == "Aéreo"){
                    $this->idtipo = 3;
                    $this->idproceso = 4;
                }else if($impoexpo == "Exportación"){
                    $this->idtipo = 5;
                    $this->idproceso = 12;
                }
                $this->proceso = Doctrine::getTable("IdgProcesos")->find($this->idproceso);                
                
                $this->consecutivo = $master->getCaReferencia();
                $house = Doctrine::getTable("InoHouse")->find($request->getParameter("idhouse"));
                
                $this->idcliente = $house->getCliente()->getCaIdcliente();
                $this->idsucursal = $house->getCliente()->getUsuario()->getCaIdsucursal();
                break;
            case 1: // Cotización
                $cotizacion = Doctrine::getTable("Cotizacion")->find($this->documento);
                
                $this->consecutivo = $cotizacion->getCaConsecutivo();
                $this->idcliente = $cotizacion->getContacto()->getCliente()->getCaIdcliente();
                $this->idsucursal = $cotizacion->getContacto()->getCliente()->getUsuario()->getCaIdsucursal();
                break;
            case 2: // Reporte de Negocios
                $reporte = Doctrine::getTable("Reporte")->find($this->documento);
                
                $this->consecutivo = $reporte->getCaConsecutivo();                
                $this->idcliente = $reporte->getContacto()->getCliente()->getCaIdcliente();
                $this->idsucursal = $reporte->getContacto()->getCliente()->getUsuario()->getCaIdsucursal();
                break;
            case 13: // Evaluación de Proveedores
                $ids = Doctrine::getTable("Ids")->find($this->documento);
                
                $proveedor = $ids->getIdsProveedor();
                
                $this->consecutivo = utf8_encode($ids->getCaNombre());                
                $this->idcliente = 800024075;
                $this->idsucursal = 'BOG';
                break;            
            case 14: // HelpDesk
                $ticket = Doctrine::getTable("HdeskTicket")->find($this->documento);
                
                $this->consecutivo = $this->documento;
                $this->descripcion = html_entity_decode(strip_tags($ticket->getCaText()));
                $this->idcliente = $ticket->getUsuario()->getSucursal()->getEmpresa()->getCaId();
                $this->idsucursal = $ticket->getUsuario()->getCaIdsucursal();
                break;
            case 15: // Cliente
                $ids = Doctrine::getTable("Ids")->findBy("ca_idalterno",$this->documento)->getFirst();
                
                $this->consecutivo = $this->documento;                
                $this->idcliente = $ids->getCaId();
                $this->idsucursal = $ids->getIdsCliente()->getUsuario()->getCaIdsucursal();
                break;
        }        
        
        //$this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarCausa(sfWebRequest $request ){
        
        $idcausa = $request->getParameter("id");
        $idriesgo = $request->getParameter("idriesgo");
        $texto = utf8_decode($request->getParameter("causa"));
        $orden = $request->getParameter("orden");
        $nueva = $request->getParameter("nueva")?$request->getParameter("nueva"):false;
        
        $conn = Doctrine::getTable("IdgCausas")->getConnection();
        $conn->beginTransaction();
        
        try{
            if($idcausa){
                $causa = Doctrine::getTable("IdgCausas")->find($idcausa);
            }else{
                $causa = new IdgCausas();
                $causa->setCaIdriesgo($idriesgo);
            }            
            $causa->setCaOrden($orden);
            $causa->setCaNueva($nueva);
            $causa->setCaCausa($texto);
            $causa->save($conn);
            
            $conn->commit();
            $this->responseArray = array("success" => true, "msg"=> "Causa actualizada correctamente!");
        } catch (Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEliminarCausa(sfWebRequest $request){
        
        $idcausa = $request->getParameter("idcausa");
       
        $conn = Doctrine::getTable("IdgCausas")->getConnection();
        $conn->beginTransaction();
        
        try{            
            $causa = Doctrine::getTable("IdgCausas")->find($idcausa);            
            $eventos = Doctrine::getTable("IdgEventoCausa")->findBy("ca_idcausa", $causa->getCaIdcausa());
            if(count($eventos)==0){                                
                $causa->delete($conn);
                $conn->commit();
                $this->responseArray = array("success" => true, "mensaje"=> "Causa eliminada correctamente!");
            }else{                
                $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode("Existe(n) evento(s) asociados a ésta causa. No es posible eliminarla!"));
            }
        } catch (Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");       
    }
    
    public function executeActualizarFactores(sfWebRequest $request){
        
        $idriesgo = $request->getParameter("idriesgo");
        $factores = json_decode($request->getParameter("factores"),1);
        $tipo = $request->getParameter("tipo");
        
        $conn = Doctrine::getTable("IdgFactor")->getConnection();
        $conn->beginTransaction();
        //print_r($factores);
        try{
            if(count($factores)>0){
                switch($tipo){
                    case "agregar":
                            $error = 0;
                            $existen = [];

                            foreach($factores as $key => $arrayFactor){                            
                                $factor = utf8_decode($arrayFactor["factor"]);
                                $idgFactor = Doctrine::getTable("IdgFactor")->find(array($idriesgo, $factor));

                                if(!$idgFactor){
                                    $factores = new IdgFactor();
                                    $factores->setCaIdriesgo($idriesgo);
                                    $factores->setCaFactor($factor);
                                    $factores->save($conn);                                
                                }else{
                                    $error++;
                                    array_push($existen, $factor);                                
                                }
                            }
                            if($error > 0){
                                $conn->rollback();
                                $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode("El(los) factor(es): ".implode(",", $existen). ", ya están asociados a este riesgo"));
                            }else{
                                $conn->commit();
                                $this->responseArray = array("success" => true, "mensaje"=> utf8_encode("Factores actualizados correctamente"));
                            }
                        break;
                    case "eliminar":
                        $factor = utf8_decode($factores[0]["factor"]);                        
                        $idgFactor = Doctrine::getTable("IdgFactor")->find(array($idriesgo, $factor));
                        
                        if($idgFactor){
                            $idgFactor->delete($conn);
                             $this->responseArray = array("success" => true, "mensaje"=> utf8_encode("Factor eliminado correctamente"));
                            $conn->commit();
                        }else{
                            $conn->rollback();
                            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode("El factor: ".$factor." no existe en éste riesgo!"));
                        }
                        break;
                }
            }else{
                $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode("No existen factores para actualizar"));
            }
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");       
        
    }
    
    public function executeDatosRiesgos(sfWebRequest $request){
        
        $idproceso = $request->getParameter("idproceso");
        
        $riesgos = Doctrine::getTable("IdgRiesgos")
                ->createQuery("r")
                ->where("ca_idproceso = ?",$idproceso)
                ->orderBy("ca_codigo")
                ->execute();
        
        foreach($riesgos as $riesgo){
            $data[] = array(
                "idriesgo" => $riesgo->getCaIdriesgo(),
                "codigo" => $riesgo->getCaCodigo(),
                "riesgo" => $riesgo->getCaCodigo()." - ".utf8_encode(str_replace("&nbsp;", "",strip_tags($riesgo->getCaRiesgo())))
            );
        }
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeDatosVersiones(sfWebRequest $request){
    
        $idproceso = $request->getParameter("idproceso");
        $proceso = Doctrine::getTable("IdgProcesos")->find($idproceso);
        
        
        $data = array();
        $data["version"] = $proceso->getUltimaVersion();        
        $data["filename"] = "MAPA DE RIESGOS ".strtoupper(utf8_encode($proceso->getCaNombre()))." ver. ".$data["version"];
        
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
       
    }
    
    public function executeDatosCargosCriticos(sfWebRequest $request){
        
        $criticos = $criterios = $listacargos = $propiedades = array();
        $sql = "SELECT f.ca_factor, sum(v.impacto) as impacto, (
                    SELECT sum(v.impacto)
                    FROM idg.tb_factores f
                            INNER JOIN idg.tb_riesgos r ON f.ca_idriesgo = r.ca_idriesgo	
                            INNER JOIN (
                                    SELECT max(ca_idvaloracion), ca_idriesgo, ca_peso as probabilidad, ((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01)) as impacto
                                    FROM idg.tb_valoracion
                                    GROUP BY ca_idriesgo, probabilidad, impacto order by ca_idriesgo ) as v ON v.ca_idriesgo = f.ca_idriesgo
                                    WHERE ca_factor = 'Todos los colaboradores') as todos
            FROM idg.tb_factores f
                    INNER JOIN idg.tb_riesgos r ON f.ca_idriesgo = r.ca_idriesgo	
                    INNER JOIN (
                            SELECT max(ca_idvaloracion), ca_idriesgo, ca_peso as probabilidad, ((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01)) as impacto
                            FROM idg.tb_valoracion
                            group by ca_idriesgo, probabilidad, impacto order by ca_idriesgo ) as v ON v.ca_idriesgo = f.ca_idriesgo
            GROUP BY f.ca_factor
            ORDER BY ca_factor";
        
        $con = Doctrine_Manager::getInstance()->connection();

        $st = $con->execute($sql);
        $this->resul = $st->fetchAll();
        $debug = $sql;
        
        $ponderacion = ParametroTable::retrieveByCaso("CU276");
        
        foreach($ponderacion as $p){            
            $criterios[$p->getCaIdentificacion()] = array("criterio"=> utf8_encode($p->getCaValor()), "valor"=>$p->getCaValor2());
        }
        
//        echo "<pre>";print_r($criterios);echo "</pre>";
        
        $cargosiso = Doctrine::getTable("CargosIso")
                ->createQuery("ci")
                ->execute();
        
        foreach($cargosiso as $c){
            $datos = json_decode($c->getCaDatos(),1);            
            foreach($datos["ponderacion"] as $idcriterio => $valor){
                $criterio = $criterios[intval($idcriterio)]["criterio"];
                $criterioxCargo[utf8_encode($c->getCaCargoiso())][$criterio] = $valor;
                $ids[utf8_encode($c->getCaCargoiso())] = $c->getCaIdcargo();
                $listacargos[] = utf8_encode($c->getCaCargoiso());
            }
        }

        foreach($this->resul as $r){
            $factor = utf8_encode($r["ca_factor"]);
            if(in_array($factor, $listacargos)){
                foreach($criterios as $key => $criterioArray){                
                        $propiedades[$factor][$criterioArray["criterio"]] = $criterioxCargo[$factor][$criterioArray["criterio"]];
                }
                $columnas = array(
                    "idcargo"=>$ids[$r["ca_factor"]],
                    "cargoiso"=> $factor, 
                    "impacto"=>$r["impacto"], 
                    "todos"=>$r["todos"], 
                    "pondfinal"=>$r["todos"]+$r["impacto"], 
                    $criterios[1]["criterio"]=>$propiedades[$factor][$criterios[1]["criterio"]],
                    $criterios[2]["criterio"]=>$propiedades[$factor][$criterios[2]["criterio"]],
                    $criterios[3]["criterio"]=>$propiedades[$factor][$criterios[3]["criterio"]],
                    $criterios[4]["criterio"]=>$propiedades[$factor][$criterios[4]["criterio"]],
                    $criterios[5]["criterio"]=>$propiedades[$factor][$criterios[5]["criterio"]],
                    $criterios[6]["criterio"]=>$propiedades[$factor][$criterios[6]["criterio"]],
                    $criterios[7]["criterio"]=>$propiedades[$factor][$criterios[7]["criterio"]],
                    "total"=>(($r["todos"]+$r["impacto"])* $criterios[0]["valor"])+
                            ($criterios[1]["valor"]*$propiedades[$factor][$criterios[1]["criterio"]])+
                            ($criterios[2]["valor"]*$propiedades[$factor][$criterios[2]["criterio"]])+
                            ($criterios[3]["valor"]*$propiedades[$factor][$criterios[3]["criterio"]])+
                            ($criterios[4]["valor"]*$propiedades[$factor][$criterios[4]["criterio"]])+
                            ($criterios[5]["valor"]*$propiedades[$factor][$criterios[5]["criterio"]])+
                            ($criterios[6]["valor"]*$propiedades[$factor][$criterios[6]["criterio"]])+
                            ($criterios[7]["valor"]*$propiedades[$factor][$criterios[7]["criterio"]])
                );

                $criticos[] = $columnas;
            }
        }
//        echo "<pre>";print_r($propiedades);echo "</pre>";
//        echo "<pre>";print_r($criticos);echo "</pre>";
        
        /*Ordena de mayor a menor por el total*/
        foreach ($criticos as $clave => $data) {
            $total[$clave] = $data['total'];                        
        }        
        array_multisort($total, SORT_DESC, $criticos);
        
        /*Calcula los límites para delimitar los colores*/
        $mayorvalor = $criticos[0]["total"];
        $menorvalor = $criticos[count($criticos)-1]["total"];
        
        $limsuperior = $mayorvalor - $menorvalor;
        $limmedio = $limsuperior*80/100;
        $liminferior = $limsuperior*50/100;        
        
        foreach($criticos as $key => $arrayData){
            if($arrayData["total"]>$limmedio){
                $arrayData["color"] = "row_pink";
                $criticos[$key] = $arrayData;
            }else if($arrayData["total"] < $limmedio && $arrayData["total"] > $liminferior){
                $arrayData["color"] = "row_yellow";
                $criticos[$key] = $arrayData;
            }else{
                $arrayData["color"] = "row_green";
                $criticos[$key] = $arrayData;
            }
        }
        
        $this->responseArray = array("root" => $criticos, "total" => count($criticos), "success" => true, "debug"=>$debug);
//        echo "<pre>";print_r($criticos);echo "</pre>";
        $this->setTemplate("responseTemplate");
    }
}
?>
