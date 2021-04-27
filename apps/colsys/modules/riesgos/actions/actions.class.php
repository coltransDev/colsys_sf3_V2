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
    const CONSULTAR = 0;
    const ADMINISTRAR = 1;
    const PERFIL_ADMON = 'admon-riesgos-colsys';
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
        $criterios[] = array ("name"=> 'empresa', "type"=> "string");
        $criterios[] = array ("name"=> 'compartido', "type"=> "string");
                       
        foreach($ponderacion as $p){            
            $criterios[] = array("name"=> utf8_encode($p->getCaValor()), "type"=>"string");            
            $headers[] = utf8_encode($p->getCaValor());
        }
        
        $this->criterios = $criterios;
        $this->headers = $headers; 
        
        $user = $this->getUser();
        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA);
        /*Accesos solicitados para el método*/
        //$accesoConsulta = $user->getControlAccesoMetodo($permisosRutinas, self::CONSULTAR);
        $this->accesoAdmon = $user->getControlAccesoMetodo($permisosRutinas, self::ADMINISTRAR);        
        $this->setTemplate("indexExt5");
    }

    public function executeDatosProcesosPorEmpresa(sfWebRequest $request) {
        
        $inactivos = $request->getParameter("inactivos");
        $user = $this->getUser();
        $idempresaUser = $user->getIdempresa();                
        
        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA);        

        /*Accesos solicitados para el método*/
        $accesoConsulta = $user->getControlAccesoMetodo($permisosRutinas, self::CONSULTAR);
        $accesoAdmon = $user->getControlAccesoMetodo($permisosRutinas, self::ADMINISTRAR);        

//        echo "accesoconsulta".$accesoConsulta."<br/>";
//        echo "accesoadmon".$accesoAdmon."<br/>";
//        echo "<pre>";print_r($permisosRutinas);echo "</pre>";
//        exit;
        
        if($accesoConsulta){
            
            $q = Doctrine::getTable("RsgoViRiesgos")
                    ->createQuery("p")                    
                    ->where("p.ca_activo = true and ca_activo_riesgo = true")                    
                    ->orderBy("ca_empresa ASC, ca_orden ASC, ca_codigo ASC");

            if($inactivos){
                $q->orWhere("ca_activo_riesgo = ?", false);
            }

            $procesos = $q->execute();    
            
            if($accesoAdmon){        
                $dataPermisos["general"]["riesgos"]["ver"] = true;
                $dataPermisos["general"]["riesgos"]["crear"] = true;
                $dataPermisos["general"]["riesgos"]["editar"] = true;
                $dataPermisos["general"]["riesgos"]["eliminar"] = true;
                $dataPermisos["general"]["riesgos"]["aprobar"] = true;
                $dataPermisos["general"]["valoracion"]["ver"] = true;
                $dataPermisos["general"]["valoracion"]["crear"] = true;
                $dataPermisos["general"]["valoracion"]["editar"] = true;
                $dataPermisos["general"]["valoracion"]["eliminar"] = true;
                $dataPermisos["general"]["eventos"]["ver"] = true;
                $dataPermisos["general"]["eventos"]["crear"] = true;
                $dataPermisos["general"]["eventos"]["editar"] = true;
                $dataPermisos["general"]["eventos"]["eliminar"] = true;
                $dataPermisos["general"]["informes"]["ver"] = true;
                $dataPermisos["general"]["informes"]["crearversion"] = true;
            }
            
            $request->setParameter("idempresaUser", $idempresaUser);
            $request->setParameter("procesos", $procesos);
            $request->setParameter("login", $user->getUserId());
            $dataPermisos["proceso"] = $this->executeGetPermisosByUsuario($request);            
//            array_push($dataPermisos, $permisosxproceso);
//        
//            echo "<pre>";print_r($dataPermisos);echo "</pre>";
//            exit;

                    
            
            $request->setParameter("idempresa", null);                                
            $lastYearGeneral = $this->executeGetLastYear($request);
            
            if($dataPermisos["proceso"] > 0){
            $tree = new JTree();
            $root = $tree->createNode("Riesgos");
            $tree->getNode($root)->setAttribute("expanded", true);
            $tree->getNode($root)->setAttribute("permisos", $dataPermisos["general"]);
            $tree->getNode($root)->setAttribute("ano", $lastYearGeneral?$lastYearGeneral->getCaAno():"Sin definir");
            $tree->addFirst($root);
            foreach ($procesos as $proceso) {                
                
                
                $uid = $root;
                $eje_raiz = array();
                $eje_raiz[] = utf8_encode($proceso->getCaEmpresa());
                //$esAuditor = $dataPermisos["proceso"][$proceso->getCaIdproceso()]["auditor"];
//                echo $proceso->getCaNombre()."=>".utf8_encode($proceso->getCaEmpresa())." Idempresa=>".$proceso->getCaIdempresa()." idempresauser=>".$idempresaUser." accesoAdmon=>".$accesoAdmon."<br/>";
//                echo $proceso->$proceso->getCaCodigo()."=>".$dataPermisos["proceso"][$proceso->getCaIdproceso()]["riesgos"]["ver"]."<br/>";
//                echo "******************************************************<br/>";
                if($proceso->getCaIdempresa() === NULL || $proceso->getCaIdempresa() === $idempresaUser || $accesoAdmon || $dataPermisos["proceso"][$proceso->getCaIdproceso()]["riesgos"]["ver"]){
                    /*Nodo que desplega las empresas con riesgos*/
                    foreach ($eje_raiz as $eje) {                    
                        $value = $eje;                    
                        $node_uid = $tree->findValue($uid, $value);                    

                        if (!$node_uid) {                            
//                            $verificacion = $proceso->getCaIdempresa() === NULL?0:$proceso->getCaIdempresa();
//                            echo "verificacion".$verificacion."<br/>";
                            $request->setParameter("idempresa", $proceso->getCaIdempresa() === NULL?"Transversales":$proceso->getCaIdempresa());
                            $lastYearEmpresa = $this->executeGetLastYear($request);
                            
                            $nodo = $tree->createNode($value);
                            $tree->getNode($nodo)->setAttribute("expanded", true); 
                            $tree->getNode($nodo)->setAttribute("idempresa", $proceso->getCaIdempresa());
                            $tree->getNode($nodo)->setAttribute("permisos", $dataPermisos["proceso"][$proceso->getCaIdproceso()]);
                            $tree->getNode($nodo)->setAttribute("empresa", $proceso->getRsgoProcesos()->getEmpresaGrupo());
                            $tree->getNode($nodo)->setAttribute("ano", $lastYearEmpresa?$lastYearEmpresa->getCaAno():"Sin definir");
                            $tree->addChild($uid, $nodo);
                            $uid = $nodo;
                        } else {
                            $uid = $node_uid;
                        }
                    }
                    $nodo = $tree->getNode($uid);
//                    echo "<pre>";print_r($tree->getNode($uid));echo "</pre>";
//                    echo "***************************************";
                    /*Nodo que desplega el listado de procesos*/
                    if($dataPermisos["proceso"][$proceso->getCaIdproceso()]["riesgos"]["ver"] || $accesoAdmon){
                        $value = utf8_encode($riesgo["ca_proceso"]);                    
                        $value = utf8_encode($proceso->getRsgoProcesos()->getCaNombreProceso());                    
                        $node_uid = $tree->findValue($uid, $value);

                        if (!$node_uid) {
                            if($value){
                                $request->setParameter("idempresa", null);
                                $request->setParameter("idproceso", $proceso->getCaIdproceso());
                                
                                $lastYearProceso = $this->executeGetLastYear($request);
                            
                                $nodo = $tree->createNode($value);
                                $tree->getNode($nodo)->setAttribute("idproceso", $proceso->getCaIdproceso());
                                $tree->getNode($nodo)->setAttribute("prefijo", $proceso->getCaPrefijo());
                                $tree->getNode($nodo)->setAttribute("idempresa", $proceso->getCaIdempresa());                    
                                $tree->getNode($nodo)->setAttribute("permisos", $dataPermisos["proceso"][$proceso->getCaIdproceso()]);
                                $tree->getNode($nodo)->setAttribute("ano", $lastYearProceso?$lastYearProceso->getCaAno():"Sin definir");
                                $tree->getNode($nodo)->setAttribute("expanded", false);
                                $tree->addChild($uid, $nodo);
                                $uid = $nodo;
                            }
                        } else {
                            $uid = $node_uid;
                        }

                        $nodo = $tree->getNode($uid);                        
//                        echo "<pre>";print_r($tree->getNode($uid));echo "</pre>";
//                        echo "***************************************";
                        /*Nodo que desplega el listado de riesgos por cada proceso*/
                        $value = utf8_encode($proceso->getCaCodigo());                    
                        $node_uid = $tree->findValue($uid, $value);
            
                        $textoLaft = "Clasificado como:<br/>".$proceso->getRiesgos()->getClasificacion()."<br/>";
                        if (!$node_uid) {
                            if($value){
                                $request->setParameter("idempresa", null);
                                $request->setParameter("idproceso", null);
                                $request->setParameter("idriesgo", $proceso->getCaIdriesgo());
                                $lastYearRiesgo = $this->executeGetLastYear($request);
                                //echo $lastYearRiesgo?$lastYearRiesgo->getCaAno():"Sin definir"."<br/>";
                                
                                $nodo = $tree->createNode($value);
                                $tree->addChild($uid, $nodo);                        
                                $tree->getNode($nodo)->setAttribute("leaf", true);
                                $tree->getNode($nodo)->setAttribute("descripcion", "<div>".$textoLaft.utf8_encode($proceso->getCaRiesgo())."</div>");
                                $tree->getNode($nodo)->setAttribute("laft", strpos($proceso->getCaClasificacion(),"1")?true:false);
                                $tree->getNode($nodo)->setAttribute("cls", !$proceso->getCaActivoRiesgo()?"inactivenode":!$proceso->getCaAprobado()?"inapprovednode":((strpos($proceso->getCaClasificacion(),"1")?"bluenode":"")));
                                $tree->getNode($nodo)->setAttribute("id", $proceso->getCaIdriesgo());
                                $tree->getNode($nodo)->setAttribute("idproceso", $proceso->getCaIdproceso());
                                $tree->getNode($nodo)->setAttribute("proceso", utf8_encode($proceso->getRsgoProcesos()->getCaNombreProceso()));                                                       
                                $tree->getNode($nodo)->setAttribute("idempresa", $proceso->getCaIdempresa());     
                                $tree->getNode($nodo)->setAttribute("aprobado", $proceso->getCaAprobado());
                                $tree->getNode($nodo)->setAttribute("ano", $lastYearRiesgo?$lastYearRiesgo->getCaAno():"Sin definir");
                            }
                        }        
                    }
                }
            }

//            echo "<pre>";print_r($tree->getTreeNodes());echo "</pre>";
//            exit;

            $this->responseArray = array("text" => "Riesgos", "expanded" => false, "children" => $tree->getTreeNodes());
            }
            else{
                $this->responseArray = array("success"=>false, "errorInfo"=> utf8_encode("No tiene permisos asignados"));
            }
        }else{
            $this->responseArray = array("success"=>false, "errorInfo"=> utf8_encode("No tiene acceso de consulta para éste módulo. Favor solicitelo al área de sistemas"));
        }
        $this->setTemplate("responseTemplate");
    }
        

    function executeDatosTreeProcesos($request) {
        
        $user = $this->getUser();        
        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA);         
        /*Accesos solicitados para el método*/
        $acceso = $user->getControlAccesoMetodo($permisosRutinas, self::EDITAR);
        
        $sql = "SELECT p.ca_idproceso, p.ca_nombre, r.ca_idriesgo, r.ca_codigo, r.ca_riesgo, r.ca_laft
                FROM riesgos.tb_procesos p
                    LEFT OUTER JOIN riesgos.tb_riesgos r on p.ca_idproceso = r.ca_idproceso
                WHERE r.ca_activo = TRUE
                ORDER BY p.ca_nombre, r.ca_codigo";
        
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $riesgos = $st->fetchAll();
        
        $data =  $childrens = $verProceso = array();         
        $clase = null;
        $uno = true;
        
        $procesos = Doctrine::getTable("RsgoProcesos")->createQuery("p")->execute();
        
        foreach($procesos as $proceso){
            $hijos = [];
            $versiones = $proceso->getRsgoVersion();
            
            if($versiones){
                foreach($versiones as $version){
                    if(!$version->getCaFcheliminado()){
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
            
            $q = Doctrine::getTable("RsgoUsuProcesos")
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
        $this->riesgo = Doctrine::getTable("Riesgos")->find($idriesgo);        
    }
    
    function executeDatosFormRiesgo($request){if (count($root) < 1)
            $root[]["idmaster" . $idmaster] = $idmaster;
        
        $idriesgo = $request->getParameter("idriesgo");
        if($idriesgo){
            $riesgo = Doctrine::getTable("Riesgos")->find($idriesgo);
            
            
            if($riesgo->getCaClasificacion()){
                $clasificacion = [];
                $arrayClasificacion = explode(",",str_replace(array("{","}"), "", $riesgo->getCaClasificacion()));
                for($i=1;$i<8;$i++){
                    if(in_array($i, $arrayClasificacion)){                        
                        array_push($clasificacion, $i);
                    }/*else{
                        $clasificacion[$i] = 0;
                    }*/
                }
            }
            
            $data = array();
            if ($riesgo) {
                $data["ca_codigo"] = utf8_encode($riesgo->getCaCodigo());
                $data["ca_laft"] = utf8_encode($riesgo->getCaLaft());
//                $data["ca_clasificacion"] = explode(",",str_replace(array("{","}"), "", $riesgo->getCaClasificacion()));
                $data["ca_clasificacion"] = $clasificacion;
                $data["ca_activo"] = $riesgo->getCaActivo();
                $data["ca_riesgo"] = utf8_encode($riesgo->getCaRiesgo());
                $data["ca_etapa"] = utf8_encode($riesgo->getCaEtapa());
                $data["ca_potenciador"] = utf8_encode($riesgo->getCaPotenciador());
                $data["ca_controles"] = utf8_encode($riesgo->getCaControles());
                $data["ca_ap"] = utf8_encode($riesgo->getCaAp());
                $data["ca_contingencia"] = utf8_encode($riesgo->getCaContingencia());
                
                $factores = $riesgo->getRsgoFactor();
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
    
    function executeGuardarFormRiesgo($request){
        
        $datos = json_decode($request->getParameter("datos"), true);        
        
        $idriesgo = $datos["idriesgo"];
        $nfactor = $datos["nfactor[]"];
        
        if($idriesgo){
            $riesgo = Doctrine::getTable("Riesgos")->find($idriesgo);
        }else{
            $riesgo = new Riesgos();
            $nuevo = true;
        }
        $conn = Doctrine::getTable("Riesgos")->getConnection();
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
            
            if($datos["ca_clasificacion"]){
                for($i=1;$i<8;$i++){
                    if(in_array($i, $datos["ca_clasificacion"])){
                        $clasificacion[$i] = $i;
                    }else{
                        $clasificacion[$i] = 0;
                    }
                }
//                echo "<pre>";print_r($clasificacion);echo "<pre>";
//                exit;
                $riesgo->setCaClasificacion("{".implode(",", $clasificacion)."}");
            }else{
                $riesgo->setCaClasificacion(null);
            }
            if($datos["ca_activo"]){
                $riesgo->setCaActivo(true);
            }else{
                $riesgo->setCaActivo(false);
            }
            
            if($datos["ca_riesgo"]){
                if (count($root) < 1)
                    $root[]["idmaster" . $idmaster] = $idmaster;
                $riesgo->setCaRiesgo(Utils::formatHtml($datos["ca_riesgo"]));
            }else{
                $riesgo->setCaRiesgo(null);
            }
            if($datos["ca_etapa"]){
                $riesgo->setCaEtapa(Utils::formatHtml($datos["ca_etapa"]));    
            }else{
                $riesgo->setCaEtapa(null);
            }
            if($datos["ca_potenciador"]){
                $riesgo->setCaPotenciador(Utils::formatHtml($datos["ca_potenciador"]));
            }else{
                $riesgo->setCaPotenciador(null);
            }
            if($datos["ca_controles"]){                
                $riesgo->setCaControles(Utils::formatHtml($datos["ca_controles"]));
            }else{
                $riesgo->setCaControles(null);
            }
            if($datos["ca_ap"]){
                $riesgo->setCaAp(Utils::formatHtml($datos["ca_ap"]));
            }else{
                $riesgo->setCaAp(null);
            }
            if($datos["ca_contingencia"]){
                $riesgo->setCaContingencia(Utils::formatHtml($datos["ca_contingencia"]));                
            }else{
                $riesgo->setCaContingencia(null);
            }
            $riesgo->save($conn);
            
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
        $tipo = $request->getParameter("tipo");
        $this->forward404Unless($idriesgo);
        $valoraciones = Doctrine::getTable("RsgoValoracion")
                ->createQuery("v")
                ->select("v.*")                             
                ->where("v.ca_idriesgo = ?", $idriesgo)
                ->orderBy("v.ca_ano DESC")
                ->execute();
        
        $data = array();
        
        foreach ($valoraciones as $val) {
            $impacto   = (($val->getCaOperativo()*10*0.01)+($val->getCaLegal()*30*0.01)+($val->getCaEconomico()*40*0.01)+($val->getCaComercial()*20*0.01));
            $dataxsucxano[$val->getCaAno()][utf8_encode($val->getSucursal()->getCaNombre())]+=$impacto*$val->getCaPeso();
            $dataxano[$val->getCaAno()]+=$impacto*$val->getCaPeso();
            $registros[$val->getCaAno()]++;
        }
        
//        echo "<pre>";print_r($dataxsucxano);echo "</pre>";
//        echo "<pre>";print_r($dataxano);echo "</pre>";
//        exit;
        
        foreach ($valoraciones as $val) {
            $vlrAnoActual = $dataxano[$val->getCaAno()]/$registros[$val->getCaAno()];
            $vlrAnoAnterior = $dataxano[$val->getCaAno()-1]/$registros[$val->getCaAno()-1];
//            
//            echo $vlrAnoActual."<br/>";
//            echo $vlrAnoAnterior."<br/>";
//            echo "prmedio".(($vlrAnoActual/$vlrAnoAnterior)-1)*100;
//            echo "XXXXXXXXXXXXXXXXXXXXXXXX";
//            exit;
//            $row = array();
            $row["idriesgo"] = $idriesgo;
            $row["idvaloracion"] = $val->getCaIdvaloracion();
            $row["idsucursal"] = $val->getCaIdsucursal();
            $row["sucursal"] = utf8_encode($val->getSucursal()->getCaNombre());
            $row["ano"]       = $val->getCaAno();
            $row["peso"]      = $val->getCaPeso();
            $row["operativo"] = $val->getCaOperativo();
            $row["legal"]     = $val->getCaLegal();
            $row["economico"] = $val->getCaEconomico();
            $row["comercial"] = $val->getCaComercial();
            $row["impacto"]   = (($val->getCaOperativo()*10*0.01)+($val->getCaLegal()*30*0.01)+($val->getCaEconomico()*40*0.01)+($val->getCaComercial()*20*0.01));
            $row["score"]     = $row["impacto"]*$val->getCaPeso();
            $row["promedioscorexano"]  = $vlrAnoActual;
            $row["porcentajexsucursal"]  = (($dataxsucxano[$val->getCaAno()][utf8_encode($val->getSucursal()->getCaNombre())]/$dataxsucxano[$val->getCaAno()-1][utf8_encode($val->getSucursal()->getCaNombre())])-1)*100;
            $row["porcentajepromedioanual"]  = round(((($vlrAnoActual/$vlrAnoAnterior)-1)*100),2);            
            $data[] = $row;
        }
//        exit;
        
        if (count($data) < 1)
            $data[]["idriesgo" . $idriesgo] = $idriesgo;
        if($tipo == "html")
            return $data;
        else{
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "nvaloracion" => count($valoraciones));
            $this->setTemplate("responseTemplate");
        }
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
        
        $conn = Doctrine::getTable("RsgoValoracion")->getConnection();
        $conn->beginTransaction();
        
        try {
            $ids = array();
            $idvals = array();
            foreach ($vals as $v) {
                if ($v->idvaloracion>0) {
                    $valoracion = Doctrine::getTable("RsgoValoracion")->find($v->idvaloracion);

                    $this->forward404Unless($valoracion);
                } else {
                    $valoracion = new RsgoValoracion();
                    $valoracion->setCaIdriesgo($v->idriesgo);
                }
                
                $valoracion->setCaAno($v->ano);
                $valoracion->setCaOperativo($v->operativo);
                $valoracion->setCaLegal($v->legal);
                $valoracion->setCaEconomico($v->economico);
                $valoracion->setCaComercial($v->comercial);
                $valoracion->setCaPeso($v->peso);
                $valoracion->setCaIdsucursal($v->idsucursal);
                $valoracion->save($conn);
                
                $ids[] = $v->id;
                $idvals[] = $valoracion->getCaIdvaloracion();
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "mensaje"=>utf8_encode("Información almacenada correctamente. "), "idvaloracion"=>$valoracion->getCaIdvaloracion(), "ids" => $ids, "idvals" => $idvals);
        
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGridEventos(sfWebRequest $request) {
        $idriesgo = $request->getParameter("idriesgo");        
        $idproceso = $request->getParameter("idproceso");        
        $idempresa = $request->getParameter("idempresa");        
        
        $data = array();
        if(!$request->getParameter("nuevo")){
            $q = Doctrine::getTable("RsgoEventos")
                    //->select("e.*")        
                    ->createQuery("e")
                    ->innerJoin("e.Riesgos r")
                    ->innerJoin("r.RsgoProcesos p")                    
                    ->addOrderBy("e.ca_fchevento");
            
            if($idriesgo){
                $q->where("e.ca_idriesgo = ?", $idriesgo);
            }
            
            if($idproceso){
                $q->where("p.ca_idproceso = ?", $idproceso);
            }
            
            if($idempresa){
                $q->where("p.ca_idempresa = ?", $idempresa);
            }
            
            $debug = $q->getSqlQuery();            
            $eventos = $q->execute();
            
            foreach ($eventos as $evento) {
                
                $row = array();
                $causa = "";
                $row["empresa"]     = utf8_encode($evento->getRiesgos()->getRsgoProcesos()->getEmpresaGrupo());
                $row["proceso"]     = utf8_encode($evento->getRiesgos()->getRsgoProcesos()->getCaNombre());
                $row["codigo"]      = utf8_encode($evento->getRiesgos()->getCaCodigo());
                $row["riesgo"]      = utf8_encode($evento->getRiesgos()->getCaRiesgo());
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
                
                $eventosCausas = Doctrine::getTable("RsgoEventoCausa")->findBy("ca_idevento", $evento->getCaIdevento());
                
                if($eventosCausas->count() > 0){
                    foreach($eventosCausas as $ec){
                        $causa.= "- ". utf8_encode($ec->getRsgoCausas()->getCaCausa())."<br/>";
                    }
                }
                $row["causa"] = $causa;
                $data[] = $row;
            }
        }
        
        if (count($data) < 1)
            $data[]["idriesgo" . $idriesgo] = $idriesgo;
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "neventos" => count($eventos), "debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosFormEventos(sfWebRequest $request) {
        
        $data = array();
        $iddoc = "";
        $caso = "CU054";

        if (!$request->getParameter("nuevo")) {
            $idevento = $request->getParameter("idevento");
            $this->forward404Unless($idevento);

            $evento = Doctrine::getTable("RsgoEventos")
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

            $causas = $evento->getRsgoEventoCausa();

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
            $conn = Doctrine::getTable("RsgoEventos")->getConnection();
            $conn->beginTransaction();
            
            if($request->getParameter("idevento")){
                $evento = Doctrine::getTable("RsgoEventos")->find($request->getParameter("idevento"));
            }else{
                $evento = new RsgoEventos();
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
            
            $causas = Doctrine::getTable("RsgoEventoCausa")->createQuery("ec")->where("ca_idevento = ?", $evento->getCaIdevento())->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();
            
            /*Elimina las causas que sean eliminadadas del evento*/
            if(count($causas)>0){
                foreach($causas as $key => $arrayCausa){
                    //print_r($arrayCausa);
                    if(!in_array($arrayCausa["ca_idcausa"], $ncausa)){
                        $eventoCausa = Doctrine::getTable("RsgoEventoCausa")->find(array($evento->getCaIdevento(), $arrayCausa["ca_idcausa"]));
                        $eventoCausa->delete($conn);
                    }
                }
            }
            
            /*Crea las causas que no existan en el evento*/
            if(count($ncausa) >0){
                foreach($ncausa as $key => $idcausa){
                    $eventoCausa = Doctrine::getTable("RsgoEventoCausa")->find(array($evento->getCaIdevento(), $idcausa));

                    if(!$eventoCausa){
                        $eventoCausa = new RsgoEventoCausa();
                        $eventoCausa->setCaIdevento($evento->getCaIdevento());
                        $eventoCausa->setCaIdcausa($idcausa);
                        $eventoCausa->save($conn);
                    }
                }
            }
            
            $riesgo = Doctrine::getTable("Riesgos")->find($idriesgo);
            $proceso = $riesgo->getRsgoProcesos();            
            $sucevento = Doctrine::getTable("Sucursal")->find($request->getParameter("idsucursal"));
            
            
            $email = new Email();
            $email->setCaUsuenvio($this->getUser()->getUserId());
            $email->setCaTipo("Riesgos");
            $email->setCaIdcaso($evento->getCaIdevento());
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");
            $email->setCaSubject("NUEVO EVENTO REPORTADO: ".  strtoupper($proceso->getCaNombreProceso()));
            
            $request->setParameter("proceso", $proceso->getCaNombreProceso());
            $request->setParameter("idevento", $evento->getCaIdevento());
            $request->setParameter("format", "email");
            
            $texto = sfContext::getInstance()->getController()->getPresentationFor('riesgos', 'emailEvento');
            $email->setCaBodyhtml($texto);
            
//            $usuprocesos = Doctrine::getTable("RsgoPermisos")->findBy("ca_idproceso", $proceso->getCaIdproceso());
            $admons = UsuarioTable::getUsuariosxPerfil("admon-riesgos-colsys");
                    
            foreach($usuprocesos as $user){                
                $logins[] = $user->getCaLogin();
            }
            foreach ($admons as $a) {
                $logins[] = $a->getCaLogin();                
            }
//            print_r($logins);
//            exit;
            foreach ($logins as $login) {                
                $usuario = Doctrine::getTable("Usuario")->find($login);
                if(!in_array($usuario->getCaEmail(), $logins)){
                    //if($usuario->getSucursal()->getCaNombre() == $sucevento->getCaNombre()){
                        if($usuario->getCaActivo())
                            $email->addTo($usuario->getCaEmail());
                    //}
                }
            }
            
            $email->addCC($this->getUser()->getEmail());
            $email->save($conn);
            
            $conn->commit();
            $this->responseArray = array("success"=>true,"text" => "Riesgos", "expanded" => true, "idevento" => $evento->getCaIdevento(), "idemail" => $email->getCaIdemail());
        }catch(Exception $e){
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()), "doc"=>$doc);
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
            $q = Doctrine::getTable("RsgoCausas")
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
        
        $this->evento = Doctrine::getTable("RsgoEventos")->find($idevento);        
        $this->nriesgo = strip_tags(html_entity_decode($this->evento->getRiesgos()->getCaRiesgo()));
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
                        "leaf" => true,
                        "checked" => false
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
                "leaf" => true,
                "checked" => false
            );            
        }
        
        $data[] = $root;
        
        $this->responseArray = array("text" => "Riesgos", "expanded" => true, "children" => $data);        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosTreeFactorRiesgo(sfWebRequest $request){        

        $idriesgo = $request->getParameter("idriesgo");
        
        $factores = Doctrine::getTable("RsgoFactor")->findBy("ca_idriesgo",$idriesgo);
        
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
        $this->proceso = Doctrine::getTable("RsgoProcesos")->find( $idproceso );
        $this->forward404Unless( $this->proceso );
        
        $this->riesgos=$this->proceso->getRiesgos();        
        $this->responsables = $this->proceso->getRsgoUsuProcesos();                
        $this->user = $this->getUser();
        
        $this->setLayout("none");
    }
    
    public function executeHtmlRiesgo(sfWebRequest $request){        

        $idriesgo = $request->getParameter("idriesgo"); 
        $this->riesgo = Doctrine::getTable("Riesgos")->find($idriesgo);        
        $this->forward404Unless( $this->riesgo );
        
        $this->proceso = $this->riesgo->getRsgoProcesos();
        $this->nriesgo = $request->getParameter("nriesgo");
        $this->triesgos = $request->getParameter("triesgos");
        $this->tipo = $request->getParameter("tipo");
        $this->ano = $request->getParameter("ano");
        
        $this->version = $request->getParameter("version");
        $this->user = $this->getUser();        
        $this->val = $this->riesgo->getUltimaValoracion();        
        
        if($this->val){
            if($this->ano)
                $lastYear = Doctrine::getTable("RsgoValoracion")->createQuery("ca_ano")->where("ca_ano = ?", $this->ano)->execute()->getFirst();
            else
                $lastYear = Doctrine::getTable("RsgoValoracion")->createQuery("ca_ano")->where("ca_idriesgo = ?", $idriesgo)->orderBy("ca_ano DESC")->execute()->getFirst();
            
            $request->setParameter("idriesgo", $idriesgo);
            $request->setParameter("tipo", "html");
            $valoraciones = $this->executeDatosGridValoracion($request);
            
            foreach($valoraciones as $key => $val){                
                if($val["ano"] == $lastYear->getCaAno()){
                    $sucursales[$val["sucursal"]] = $val;
                }            
            }
            
            $this->valores = $sucursales;
            
        }
        
        $this->setLayout("none");
    }
    
    public function executePdfProceso(sfWebRequest $request) {
        $idproceso=$request->getParameter("idproceso");
        $idriesgo=$request->getParameter("idriesgo");
        $idempresa=$request->getParameter("idempresa");
        $ano=$request->getParameter("ano");        
        
        $laft = $request->getParameter("laft");
        $filtroClasificacion = json_decode($request->getParameter("idclasificacion"));        
        
        if($request->getParameter("tipo")){
            $tipo = $request->getParameter("tipo");            
            
            $conn = Doctrine::getTable("RsgoProcesos")->getConnection();
            $conn->beginTransaction();
        
            try{
            
                $proceso = Doctrine::getTable("RsgoProcesos")->find($idproceso);
                $filename = $request->getParameter("filename");

                $version = new RsgoVersion();
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
        
        $q = Doctrine::getTable("RsgoProcesos")
                ->createQuery("p")
                ->orderBy("ca_nombre");
        
        if($idproceso){
            $q->addWhere("ca_idproceso = ?", $idproceso);
        }
        
        if($idempresa){
            if($idempresa == null || $idempresa == "null")
                $q->addWhere("ca_idempresa is null");
            else
                $q->addWhere ("ca_idempresa = ?", $idempresa);
        }
        
//        die($q->getSqlQuery());
        
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
        
            $riesgos = $proceso->getRiesgos();
            $q = Doctrine::getTable("Riesgos")
                    ->createQuery("r")
                    ->where("ca_idproceso = ?", $proceso->getCaIdproceso());
            
            if($laft == "si"){
                $q->addWhere("ca_laft = ?", true);
            }
            
            if($idriesgo){
                $q->addWhere("ca_idriesgo = ?", $idriesgo);
            }            
            
            
            $q->orderBy("ca_codigo ASC");
            $riesgos = $q->execute();           
            
            $i=1;
            $triesgos = count($riesgos);
            foreach($riesgos as $riesgo){                
                if($riesgo->getCaActivo() == true){                    
                    /*Busca el riesgo en las clasificaciones solicitadas*/
                    $arregloClasificacion = explode(",", trim($riesgo->getCaClasificacion(),"{}"));
                    $filtro = array_intersect($filtroClasificacion, $arregloClasificacion);
                    if(!empty($filtroClasificacion) && empty($filtro)) {
                        continue;
                    }
                    
                    $pdf->AddPage('', '',true);            
//                    $pdf->AddPage('L', $resolution);
                    $this->getRequest()->setParameter('idriesgo',$riesgo->getCaIdriesgo());
                    $this->getRequest()->setParameter('nriesgo',$i);
                    $this->getRequest()->setParameter('triesgos',$triesgos); 
                    $this->getRequest()->setParameter('tipo',$tipo);
                    $this->getRequest()->setParameter('version',$version);
                    $this->getRequest()->setParameter('ano',$ano);                    
                    $html=sfContext::getInstance()->getController()->getPresentationFor( 'riesgos', 'htmlRiesgo');
                    $html=utf8_encode($html);

                    $pdf->writeHTML($html, true, false, true, false, '');
                    $i++;                    
                }                
            }
        }        
//        exit;
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
    
//    public function executeDatosGraficaxRiesgo(sfWebRequest $request){
//        $idriesgo = $request->getParameter("idriesgo");
//        $idproceso = $request->getParameter("idproceso");
//        
//        $q = new Doctrine_RawSql();
//        
//        $q->select('{vl.*}');
//        $q->from("riesgos.tb_valoracion vl
//                LEFT JOIN riesgos.tb_riesgos r ON r.ca_idriesgo = vl.ca_idriesgo
//                INNER JOIN (SELECT ca_idriesgo, max(ca_ano) as ca_ano 
//                            FROM riesgos.tb_valoracion 
//                            GROUP BY ca_idriesgo order by ca_idriesgo) ul on ul.ca_idriesgo = vl.ca_idriesgo and ul.ca_ano = vl.ca_ano");
//
//        $q->addComponent('vl', 'RsgoValoracion vl');
//        $q->addComponent('r', 'vl.Riesgos r');
//        
//        if($idriesgo){            
//            $q->addWhere("vl.ca_idriesgo = ?", $idriesgo);
//        }
//        if($idproceso){
//            $q->addWhere("r.ca_idproceso = ?", $idproceso);
//        }
//        echo $q->getSqlQuery();
//        exit;
//        $valores = $q->execute();       
//        $data = array();
//        
//        foreach($valores as $valor){
//            $tolerable = (($valor->getCaOperativo()*10*0.01)+($valor->getCaLegal()*30*0.01)+($valor->getCaEconomico()*40*0.01)+($valor->getCaComercial()*20*0.01));
//            $data[] = array(
//                'idriesgo' => $valor->getCaIdriesgo(),
//                'ano' => $valor->getCaAno(),
//                'tolerable'=> $valor->getCaPeso(),
//                'data1'=>$tolerable,
//                'score'=>$tolerable*$valor->getCaPeso(),
//                'codigo'=>$valor->getRiesgos()->getCaCodigo()
//                    );
//            //$data["data1"][] = $valor->getCaPeso();
//            //$data["tolerable"][] = (($valor->getCaOperativo()*10*0.01)+($valor->getCaLegal()*30*0.01)+($valor->getCaEconomico()*40*0.01)+($valor->getCaComercial()*20*0.01));
//            //$data["score"] = $data["tolerable"]*$valor->getCaPeso();            
//        }
//       
//        //Funcion que verifica valores repetidos en un array
//        $k=0.2;
//        for($i=0;$i<count($data);$i++){
//            for($j=0;$j<count($data);$j++){
//                if($i!=$j){
//                    if($data[$i]["data1"]==$data[$j]["data1"]){
//                        $data[$i]["data1"]+=$k;
//                        $k+=0.2;
//                    }
//                }
//            }
//        }
//        
//        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
//        $this->setTemplate("responseTemplate");
//    }
    
    /**
     * @autor alramirez
     * @return un objeto JSON con los datos de Causas
     * @date:  2016-07-22
     */
    public function executeDatosFormImpacto(sfWebRequest $request) {
       
        $id = $request->getParameter("idvaloracion");
        
        $val = Doctrine::getTable("RsgoValoracion")->find($id);
        $this->forward404Unless($val);
        
        $data = array();
        
        if($val->getCaDatos())
            $data = json_decode($val->getCaDatos(),true);
        
        $this->responseArray = array("success" => true, "data" =>$data , "total" => count($data), "id" => $id, "d1"=>json_decode($val->getCaDatos()));        
        
        $this->setTemplate("responseTemplate");
    }
    
    
    /**
     * @autor alramirez
     * @return un objeto JSON con los datos de Causas
     * @date:  2016-07-22
     */
    public function executeGuardarFormImpacto(sfWebRequest $request) {
        
        $idval = $request->getParameter("idvaloracion");        
        $val = Doctrine::getTable("RsgoValoracion")->find($idval);
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
        $idempresa = $request->getParameter("idempresa");
        $idvaloracion = $request->getParameter("idvaloracion");
        $filtroClasificacion = json_decode($request->getParameter("idclasificacion"));                
        
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
        
        if($idvaloracion){

            $q = new Doctrine_RawSql();        
            $q->select('{r.*},{vl.ca_probabilidad},{vl.ca_impacto},{vl.ca_score}');
            $q->from("riesgos.tb_riesgos r                
                    INNER JOIN (
                        SELECT vl.ca_idvaloracion,ca_ano, ca_idriesgo, ca_peso as ca_probabilidad, 
                            round(((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01)),2) as ca_impacto,
                            round((((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01))*ca_peso),2) as ca_score
                        FROM riesgos.tb_valoracion vl                         
                        ORDER BY ca_idriesgo, ca_ano) vl on vl.ca_idriesgo = r.ca_idriesgo");                


            $q->addComponent('r', 'Riesgos r');
            $q->addComponent('vl', 'r.RsgoValoracion vl');            

            $q->addWhere("vl.ca_idvaloracion = ?", $idvaloracion);            
            
            $lastYear = $request->getParameter("ano");

        }else{
            

            $q = new Doctrine_RawSql();        
            $q->select('{p.*},{r.*},{vl.ca_probabilidad},{vl.ca_impacto},{vl.ca_score}');
            $q->from("riesgos.tb_riesgos r                
                    INNER JOIN riesgos.tb_procesos p ON p.ca_idproceso = r.ca_idproceso
                    INNER JOIN (
                        SELECT max(ca_idvaloracion) as ca_idvaloracion, ca_ano, ca_idriesgo, round(avg(ca_peso)) as ca_probabilidad, 
                            round(avg((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01)),2) as ca_impacto,
                            round(avg(((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01))*ca_peso),2) as ca_score
                        FROM riesgos.tb_valoracion vl 
                        GROUP BY ca_ano, ca_idriesgo
                        ORDER BY ca_idriesgo, ca_ano) vl on vl.ca_idriesgo = r.ca_idriesgo");                
            $q->addComponent('r', 'Riesgos r');
            $q->addComponent('p', 'r.RsgoProcesos p');
            $q->addComponent('vl', 'r.RsgoValoracion vl');            
            
            
            $request->setParameter("idriesgo", $idriesgo);
            $request->setParameter("idproceso", $idproceso);
            $request->setParameter("idempresa", $idempresa);                    
            //$success =  $this->executeCerrarTicket($request);
            $lastYear = $this->executeGetLastYear($request);
            
            if($idempresa){
                $q->where("ca_ano = ?", $lastYear->getCaAno());                
                $q->addWhere("p.ca_idempresa = ?", $idempresa);
            }
            
            if($idproceso){                
                $q->where("ca_ano = ?", $lastYear->getCaAno());                
                $q->addWhere("r.ca_idproceso = ?", $idproceso);
            }
            
            if($idriesgo){                            
                $q->where("ca_ano = ?", $lastYear->getCaAno());                
                $q->addWhere("r.ca_idriesgo = ?", $idriesgo);                                
            }
            
            if(!$idempresa && !$idproceso && !$idriesgo){
                $q->where("ca_ano = ?", $lastYear->getCaAno());
            }
            
            
        }
//        echo $q->getSqlQuery();
//        print_r($q->getParams());
//        exit;

        $riesgos = $q->execute(); 
        
        
        
//        echo count("riesgos");
//        var_dump("#riesgpos",count($riesgos));
        
        if(!empty($riesgos)){
            foreach($riesgos->toArray() as $riesgo){
//                echo "idproceso =".$riesgo["RsgoProcesos"]["ca_idproceso"];
//                echo "<pre>";print_r($riesgo);echo "</pre>";
//                exit;
                
                
                $arregloClasificacion = explode(",", trim($riesgo["ca_clasificacion"],"{}"));                
                $filtro = array_intersect($filtroClasificacion, $arregloClasificacion);
                if(!empty($filtroClasificacion) && empty($filtro)) {
                    continue;
                }

                $valoraciones = $riesgo["RsgoValoracion"];
                foreach($valoraciones as $key => $valor){ 
                    $grafica[] = array(
                        'idproceso' => $riesgo["RsgoProcesos"]["ca_idproceso"],
                        'idriesgo' => $valor["ca_idriesgo"],
                        'ano' => $valor["ca_ano"],
                        'probabilidad'=> round($valor["ca_probabilidad"]),
                        'dataImpacto'=>$valor["ca_impacto"],
                        'score'=>$valor["ca_score"],
                        'codigo'=>$riesgo["ca_codigo"]
                    );            
                }
            }
            
                    
//                echo "<pre>";print_r($riesgo);echo "</pre>";
//                exit;
            
            // Data que grafica los valores de cada riesgo
            if(!empty($grafica)){
                foreach($grafica as $g){
                    $data[] = array(
                        'idproceso' => $g["idproceso"],
                        "impacto"=>$g["dataImpacto"], 
                        "probabilidad"=>round($g["probabilidad"]), 
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
//            echo "<pre>";print_r($data);echo "</pre>";
//            var_dump($data);
//            exit;
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "ano"=>$lastYear, "debug"=>$q->getSqlQuery());
        }else{
            $this->responseArray = array("success" => false, "errorInfo"=>utf8_encode("No hay información registrada para graficar"));
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeNuevoEventoExt5( sfWebRequest $request ){
        
        $this->idproceso = $request->getParameter("idproceso");
        $this->idtipo = $request->getParameter("idtipo");
        $this->documento = $request->getParameter("documento");
        
        if( $this->idproceso){
            $this->proceso = Doctrine::getTable("RsgoProcesos")->find($this->idproceso);
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
                $this->proceso = Doctrine::getTable("RsgoProcesos")->find($this->idproceso);                
                
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
        
        $conn = Doctrine::getTable("RsgoCausas")->getConnection();
        $conn->beginTransaction();
        
        try{
            if($idcausa){
                $causa = Doctrine::getTable("RsgoCausas")->find($idcausa);
            }else{
                $causa = new RsgoCausas();
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
       
        $conn = Doctrine::getTable("RsgoCausas")->getConnection();
        $conn->beginTransaction();
        
        try{            
            $causa = Doctrine::getTable("RsgoCausas")->find($idcausa);            
            $eventos = Doctrine::getTable("RsgoEventoCausa")->findBy("ca_idcausa", $causa->getCaIdcausa());
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
        
        $conn = Doctrine::getTable("RsgoFactor")->getConnection();
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
                                $idgFactor = Doctrine::getTable("RsgoFactor")->find(array($idriesgo, $factor));

                                if(!$idgFactor){
                                    $factores = new RsgoFactor();
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
                        $idgFactor = Doctrine::getTable("RsgoFactor")->find(array($idriesgo, $factor));
                        
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
        
        $riesgos = Doctrine::getTable("Riesgos")
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
    
    public function executeDatosFormVersiones(sfWebRequest $request){
    
        $idproceso = $request->getParameter("idproceso");
        $proceso = Doctrine::getTable("RsgoProcesos")->find($idproceso);        
        
        $data = array();
        $data["version"] = $proceso->getUltimaVersion();        
        $data["filename"] = "MAPA DE RIESGOS ".strtoupper(utf8_encode($proceso->getCaNombreProceso()))." ver. ".$data["version"];
        
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
       
    }
    
    public function executeDatosGridVersiones(sfWebRequest $request){
    
        $idproceso = $request->getParameter("idproceso");
        $idempresa = $request->getParameter("idempresa");
        $tipo = $request->getParameter("tipo");
        
        $q = Doctrine::getTable("RsgoProcesos")
                ->createQuery("p");
                
        
        if($idproceso){
            $q->addWhere("ca_idproceso = ?", $idproceso);
        }
        
        if($idempresa){            
            $q->addWhere ("ca_idempresa = ?", $idempresa);
        }
        
        if($tipo == "empresa" && !$idempresa){            
            $q->addWhere ("ca_idempresa is null");
        }
        
        $procesos = $q->execute();            
        
        try{
            $data = array();
            foreach($procesos as $proceso){            
                $versiones = $proceso->getRsgoVersion();
                if($versiones){
                    foreach($versiones as $version){
                        if(!$version->getCaFcheliminado()){                     
                            $row["idversion"] = $version->getCaId();
                            $row["idempresa"] = $proceso->getCaIdempresa();
                            $row["empresa"] = utf8_encode($proceso->getEmpresaGrupo());
                            $row["idproceso"] = $proceso->getCaIdproceso();
                            $row["proceso"] = utf8_encode($proceso->getCaNombreProceso());
                            $row["version"] = $version->getCaVersion();
                            $row["nombre"] = utf8_encode($version->getCaNombre());
                            $row["observaciones"] = utf8_encode($version->getCaObservaciones());
                            //"descripcion" => "<span style='color:blue; font-weight: bold;'>".utf8_encode($version->getCaNombre())."</span><div>Version:".$version->getCaVersion()."</br>Notas: ". utf8_encode($version->getCaObservaciones())."<br/>Usucreado:".$version->getCaUsucreado()."</br>Fchcreado:".$version->getCaFchcreado()."</div>",                    
                            $row["usucreado"] = $version->getCaUsucreado();
                            $row["fchcreado"] = $version->getCaFchcreado();                    
                        }
                        $data[] = $row;
                    }
                }        
            }

            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "lastVersion"=>$proceso?$proceso->getUltimaVersion():"");
        }catch(Exception $e){
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
       
    }
    
    public function executeDatosCargosCriticos(sfWebRequest $request){
        
        $criticos = $criterios = $listacargos = $propiedades = array();
        $sql = "SELECT f.ca_factor, sum(v.impacto) as impacto, (
                    SELECT sum(v.impacto)
                    FROM riesgos.tb_factores f
                            INNER JOIN riesgos.tb_riesgos r ON f.ca_idriesgo = r.ca_idriesgo AND r.ca_activo = TRUE
                            INNER JOIN (
                                    SELECT max(ca_idvaloracion), ca_idriesgo, ca_peso as probabilidad, ((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01)) as impacto
                                    FROM riesgos.tb_valoracion
                                    GROUP BY ca_idriesgo, probabilidad, impacto order by ca_idriesgo ) as v ON v.ca_idriesgo = f.ca_idriesgo
                                    WHERE ca_factor = 'Todos los colaboradores') as todos
            FROM riesgos.tb_factores f
                    INNER JOIN riesgos.tb_riesgos r ON f.ca_idriesgo = r.ca_idriesgo AND r.ca_activo = TRUE
                    INNER JOIN (
                            SELECT max(ca_idvaloracion), ca_idriesgo, ca_peso as probabilidad, ((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01)) as impacto
                            FROM riesgos.tb_valoracion
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
                $empresa[utf8_encode($c->getCaCargoiso())] = utf8_encode($c->getEmpresa()->getCaNombre());
                $compartido[utf8_encode($c->getCaCargoiso())] = $c->getDatosJson("compartido");
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
                    "empresa"=> $empresa[$factor], 
                    "compartido"=> $compartido[$factor], 
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
    
    public function executeAsignarRiesgosxCargo(sfWebRequest $request){
        
        $cargo = utf8_decode($request->getParameter("cargo"));
        $cargo2 = utf8_decode($request->getParameter("cargo2"));
        
        $factores = Doctrine::getTable("RsgoFactor")->createQuery("f")->select("ca_idriesgo, ca_factor")->where("ca_factor = ?",$cargo)->execute();
        
        $conn = Doctrine::getTable("RsgoFactor")->getConnection();
        $conn->beginTransaction();
        
        try{    
            if(count($factores)>0){
                //echo count($factores);
                foreach($factores as $factor){
                    echo $factor->getCaIdriesgo()."<br/>";
                    $facnew = new RsgoFactor();
                    $facnew->setCaIdriesgo($factor->getCaIdriesgo());
                    $facnew->setCaFactor($cargo2);
                    $facnew->save($conn);                    
                }
                $conn->commit();

                $this->responseArray = array("success" => true,"cargobuscado"=>$cargo, "nuevocargo"=>$cargo2, "total"=>count($factores));
            }
        }catch(Exception $e){
            $conn->rollBack();
            $this->responseArray = array("success" => false,"text" => "Riesgos", "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
//    
//    public function executeDatosFormProceso(sfWebRequest $request){
//        
//        $idproceso = $request->getParameter("idproceso");
//        
//        $q = Doctrine::getTable("RsgoViProcesos")
//                ->createQuery("p")
//                //->leftJoin("p.Empresa e")                
//                ->orderBy("p.ca_empresa ASC, p.ca_orden ASC, p.ca_prefijo ASC");
//                //->execute();
//        
//        if($idproceso){
//            $q->addWhere("ca_idproceso = ?", $idproceso);
//        }
//        
//        $procesos = $q->execute();
//        
//        $data = [];
//        
//        foreach($procesos as $proceso){
//            $row = [];
//            $row["ca_idempresa"] = $proceso->getCaIdempresa();
//            $row["ca_idproceso"] = $proceso->getCaIdproceso();
//            $row["ca_empresa"] = utf8_encode($proceso->getCaEmpresa());
//            $row["ca_orden"] = $proceso->getCaOrden();
//            $row["ca_prefijo"] = $proceso->getCaPrefijo();
//            $row["ca_proceso"] = utf8_encode($proceso->getCaNombre());
//            $row["ca_activo"] =  $proceso->getCaActivo();     
//            
//            $data[] = $row;
//        }
//        
//        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
//        $this->setTemplate("responseTemplate");
//        
//    }

    public function executeDatosProcesos(sfWebRequest $request){
        
        $idproceso = $request->getParameter("idproceso");
        
        $q = Doctrine::getTable("RsgoViProcesos")
                ->createQuery("p")                
                ->orderBy("p.ca_empresa ASC, p.ca_orden ASC, p.ca_prefijo ASC");                
        
        if($idproceso){
            $q->addWhere("ca_idproceso = ?", $idproceso);
        }        
        $procesos = $q->execute();
        
        $data = [];        
        foreach($procesos as $proceso){
            $row = [];
            $row["ca_idempresa"] = $proceso->getCaIdempresa();
            $row["ca_idproceso"] = $proceso->getCaIdproceso();
            $row["ca_empresa"] = $proceso->getCaEmpresa()?utf8_encode($proceso->getCaEmpresa()):utf8_encode($proceso->getRsgoProcesos()->getEmpresaGrupo());
            $row["ca_orden"] = $proceso->getCaOrden();
            $row["ca_prefijo"] = $proceso->getCaPrefijo();
            $row["ca_proceso"] = utf8_encode($proceso->getCaNombre());
            $row["ca_activo"] =  $proceso->getCaActivo();    
            $row["ca_nriesgos"] =  0;     
            
            if($proceso->getCaIdproceso()){
                $riesgos = Doctrine::getTable("Riesgos")->findBy("ca_idproceso", $proceso->getCaIdproceso());
                $row["ca_nriesgos"] =  count($riesgos);     
            }
            
            $request->setParameter("login", $this->getUser()->getUserId());
            $permisos = $this->executeGetPermisosByUsuario($request);
            
            $row["ca_permisos"] =  $permisos[$proceso->getCaIdproceso()];     
            $data[] = $row;
        }
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "data"=>$row);
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeDatosGridUsuarios(sfWebRequest $request){
        
        $idproceso = $request->getParameter("idproceso");
        
        $usuprocesos = Doctrine::getTable("RsgoUsuProcesos")
                ->createQuery("up")
                ->innerJoin("up.Usuario u")      
                ->innerJoin("up.Parametro cf")                
                ->where("cf.ca_casouso = ?",'CU285')
                ->addwhere("ca_idproceso = ?", $idproceso)                
                ->execute();
        
        $data = [];
        
        foreach($usuprocesos as $usuproceso){
            $row = [];
            $row["ca_idempresa"] = $usuproceso->getUsuario()->getSucursal()->getCaIdempresa();
            $row["ca_empresa"] = utf8_encode($usuproceso->getUsuario()->getSucursal()->getEmpresa()->getCaNombre());
            $row["ca_idsucursal"] = $usuproceso->getUsuario()->getSucursal()->getCaIdsucursal();
            $row["ca_sucursal"] = utf8_encode($usuproceso->getUsuario()->getSucursal()->getCaNombre());
            $row["ca_nombre"] = utf8_encode($usuproceso->getUsuario()->getCaNombre());
            $row["ca_perfil"] = utf8_encode($usuproceso->getParametro()->getCaValor());
            
            
            $data[] = $row;
        }
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeDatosGridPermisos(sfWebRequest $request){
        
        $idproceso = $request->getParameter("idproceso");
        
        $permisos = Doctrine::getTable("RsgoPermisos")
                ->createQuery("rp")
                ->innerJoin("rp.Usuario u")                
                //->orderBy("ca_idproceso ASC")
                //->where("up.ca_perfil = ? AND u.ca_activo = TRUE", $perfil)                
                ->execute();
        
        $data = [];
        
        foreach($permisos as $permiso){
            $row = [];
            $row["ca_idproceso"] = $permiso->getCaIdproceso();
            $row["ca_proceso"] = utf8_encode($permiso->getRsgoProcesos()->getCaNombreProceso());
            $row["ca_idempresa"] = $permiso->getUsuario()->getSucursal()->getCaIdempresa();
            $row["ca_empresa"] = utf8_encode($permiso->getUsuario()->getSucursal()->getEmpresa()->getCaNombre());
            $row["ca_sucursal"] = utf8_encode($permiso->getUsuario()->getSucursal()->getCaNombre());
            $row["ca_login"] = $permiso->getCaLogin();
            $row["ca_nombre"] = utf8_encode($permiso->getUsuario()->getCaNombre());
            $row["ca_riesgos_view"] = $permiso->getCaRiesgosView();
            $row["ca_riesgos_new"] = $permiso->getCaRiesgosNew();
            $row["ca_riesgos_edit"] = $permiso->getCaRiesgosEdit();
            $row["ca_riesgos_delete"] = $permiso->getCaRiesgosDelete();
            $row["ca_riesgos_approval"] = $permiso->getCaRiesgosApproval();
            $row["ca_eventos_view"] = $permiso->getCaEventosView();
            $row["ca_eventos_new"] = $permiso->getCaEventosNew();
            $row["ca_eventos_edit"] = $permiso->getCaEventosEdit();
            $row["ca_eventos_delete"] = $permiso->getCaEventosDelete();
            $row["ca_valoracion_view"] = $permiso->getCaValoracionView();
            $row["ca_valoracion_new"] = $permiso->getCaValoracionNew();
            $row["ca_valoracion_edit"] = $permiso->getCaValoracionEdit();
            $row["ca_valoracion_delete"] = $permiso->getCaValoracionDelete();
            $row["ca_informes_view"] = $permiso->getCaInformesView();
            $row["ca_informes_new"] = $permiso->getCaInformesNew();            
            //$row["ca_auditor"] = $permiso->getCaAuditor();
            $row["ca_usucreado"] = utf8_encode($permiso->getUsuCreado()->getCaNombre());
            $row["ca_fchcreado"] = $permiso->getUsuario()->getCaFchcreado();
            $row["ca_usuactualizado"] = utf8_encode($permiso->getUsuActualizado()->getCaNombre());
            $row["ca_fchactualizado"] = $permiso->getUsuario()->getCaFchactualizado();
            
            $usu_admins = Doctrine::getTable("UsuarioPerfil")->findBy("ca_perfil", self::PERFIL_ADMON);
            
            if($permiso->getCaIdperfil()){
                $perfil = ParametroTable::retrieveByCaso("CU285", null, null, $permiso->getCaIdperfil());

                $row["ca_idperfil"] = $permiso->getCaIdperfil();
                $row["ca_perfil"] = utf8_encode($perfil[0]->getCaValor());
            }
            
            foreach($usu_admins as $usuario){
                //echo $permiso->getCaIdproceso()." - Administrador: ".$usuario->getCaLogin()." - Permiso: ".$permiso->getCaLogin();
                if($usuario->getCaLogin() == $permiso->getCaLogin()){                    
                    $row["ca_admin"] = true;
                    $row["ca_perfil"] = "Administrador";
                    //echo "Admin<br/>";
                    break;
                }else{
                    //echo "NO AD<br/>";
                    $row["ca_admin"] = false;
                }
            }
            //exit;
            
            
            
            $data[] = $row;
        }
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeGuardarFormProceso(sfWebRequest $request){
        
        $user = $this->getUser();        
        $conn = Doctrine::getTable("RsgoProcesos")->getConnection();
        $conn->beginTransaction();
        
        try{
            $idproceso = $request->getParameter("idproceso");        

            if($idproceso){
                $proceso = Doctrine::getTable("RsgoProcesos")->find($idproceso);
            }else{
                $proceso = new RsgoProcesos();
            }

            if($request->getParameter("ca_idempresa")){
                $proceso->setCaIdempresa($request->getParameter("ca_idempresa"));
            }else{
                $proceso->setCaIdempresa(null);
            }
            if($request->getParameter("ca_orden")){
                $proceso->setCaOrden($request->getParameter("ca_orden"));
            }else{
                $proceso->setCaOrden(null);
            }
            if($request->getParameter("ca_prefijo")){
                $proceso->setCaPrefijo($request->getParameter("ca_prefijo"));
            }else{
                $proceso->setCaPrefijo(null);
            }
            if($request->getParameter("ca_proceso")){
                $proceso->setCaNombre(utf8_decode($request->getParameter("ca_proceso")));
            }

            if($request->getParameter("ca_activo")){
                $proceso->setCaActivo(true);
            }else{
                $proceso->setCaActivo(false);
            }

            $proceso->save($conn);            
            
            $usu_admins = Doctrine::getTable("UsuarioPerfil")->findBy("ca_perfil", self::PERFIL_ADMON);                        
            
            foreach($usu_admins as $usuario){
                $permiso = Doctrine::getTable("RsgoPermisos")->findByDql("ca_idproceso = ? AND ca_login = ?", array($proceso->getCaIdproceso(),$usuario->getCaLogin()))->getFirst();
                        
                if(!$permiso){
                    $permiso = new RsgoPermisos();
                    $permiso->setCaIdproceso($proceso->getCaIdproceso());
                    $permiso->setCaLogin($usuario->getCaLogin());
                }

                $permiso->setCaRiesgosView(true);
                $permiso->setCaRiesgosNew(true);
                $permiso->setCaRiesgosEdit(true);
                $permiso->setCaRiesgosDelete(true);
                $permiso->setCaRiesgosApproval(true);
                $permiso->setCaValoracionView(true);
                $permiso->setCaValoracionNew(true);
                $permiso->setCaValoracionEdit(true);
                $permiso->setCaValoracionDelete(true);
                $permiso->setCaEventosView(true);
                $permiso->setCaEventosNew(true);
                $permiso->setCaEventosEdit(true);
                $permiso->setCaEventosDelete(true);
                $permiso->setCaInformesView(true);
                $permiso->setCaInformesNew(true);
                $permiso->save($conn);
            }
            $conn->commit();
            
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
                
        } catch (Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));            
        }        
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarProceso(sfWebRequest $request){
        
        $idproceso = $request->getParameter("idproceso");
       
        $conn = Doctrine::getTable("RsgoProcesos")->getConnection();
        $conn->beginTransaction();
        
        try{            
            $proceso = Doctrine::getTable("RsgoProcesos")->find($idproceso);
            $proceso->delete($conn);
            $conn->commit();
            $this->responseArray = array("success" => true, "mensaje"=> "Proceso eliminado correctamente!");
        } catch (Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");       
    }

    public function executeEliminarRiesgo(sfWebRequest $request){
        
        $idriesgo = $request->getParameter("idriesgo");
       
        $conn = Doctrine::getTable("Riesgos")->getConnection();
        $conn->beginTransaction();
        
        try{            
            $riesgo = Doctrine::getTable("Riesgos")->find($idriesgo);
            $riesgo->delete($conn);
            $conn->commit();
            $this->responseArray = array("success" => true, "mensaje"=> "Riesgo eliminado correctamente!");
        } catch (Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");       
    }    
    
    public function executeEliminarPermiso(sfWebRequest $request){
        
        $login = $request->getParameter("login");
        $idproceso = $request->getParameter("idproceso");
       
        $conn = Doctrine::getTable("RsgoPermisos")->getConnection();
        $conn->beginTransaction();
        
        try{            
            $permiso = Doctrine::getTable("RsgoPermisos")->findByDql(("ca_idproceso = ? AND ca_login = ?"), array($idproceso, $login))->getFirst();
            $permiso->delete($conn);
            $conn->commit();
            $this->responseArray = array("success" => true, "mensaje"=> "Permiso eliminado correctamente!");
        } catch (Exception $e){
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");       
    } 
    
//    public function executeModificarAuditor(sfWebRequest $request){
//        
//        $login = $request->getParameter("login");
//        $idproceso = $request->getParameter("idproceso");
//       
//        $conn = Doctrine::getTable("RsgoPermisos")->getConnection();
//        $conn->beginTransaction();
//        
//        try{            
//            $permiso = Doctrine::getTable("RsgoPermisos")->findByDql(("ca_idproceso = ? AND ca_login = ?"), array($idproceso, $login))->getFirst();
//            $permiso->setCaAuditor($permiso->getCaAuditor()?false:true);
//            $permiso->save($conn);
//            $conn->commit();
//            $this->responseArray = array("success" => true, "mensaje"=> "Perfil de auditor modificado correctamente!");
//        } catch (Exception $e){
//            $conn->rollback();
//            $this->responseArray = array("success" => false, "errorInfo"=> utf8_encode($e->getMessage()));
//        }
//        
//        $this->setTemplate("responseTemplate");       
//    } 
    
    public function executeDatosGridInforme(sfWebRequest $request){
        
        $idproceso = $request->getParameter("idproceso");
        $idempresa = $request->getParameter("idempresa");
        $filtroClasificacion = json_decode($request->getParameter("idclasificacion"));
        $where = "";
        
        if($idproceso){
            $where.="WHERE r.ca_idproceso = $idproceso";
        }
        
        if($idempresa){
            $where.="WHERE p.ca_idempresa = $idempresa";
        }
        
        $con = Doctrine_Manager::getInstance()->connection();        
        $sql = "
            SELECT e.ca_nombre as ca_empresa, (p.ca_prefijo ||' ' ||p.ca_nombre) as ca_proceso, r.ca_idriesgo, ca_codigo, ca_riesgo, ca_etapa, ca_potenciador, ca_controles, ca_ap, ca_contingencia, r.ca_activo, q.ca_causas, q.ca_factores, r.ca_activo
            FROM riesgos.tb_riesgos r
            INNER JOIN (
		SELECT r.ca_idriesgo, string_agg(DISTINCT ca_orden ||'. ' ||ca_causa,'<br/>') as ca_causas,string_agg(DISTINCT ca_factor,'<br/>') as ca_factores
		FROM riesgos.tb_riesgos r
			INNER JOIN riesgos.tb_causas c ON r.ca_idriesgo = c.ca_idriesgo
			INNER JOIN riesgos.tb_factores f ON r.ca_idriesgo = c.ca_idriesgo		
                $where
		GROUP BY r.ca_idriesgo
		) as q ON q.ca_idriesgo = r.ca_idriesgo
            INNER JOIN riesgos.tb_procesos p ON p.ca_idproceso = r.ca_idproceso
            INNER JOIN control.tb_empresas e ON e.ca_idempresa = p.ca_idempresa
            ORDER BY 1,2,4";
        
        $sql = "
            SELECT r.ca_idriesgo, 
                CASE WHEN em.ca_nombre IS NULL THEN 'Transversales' ELSE em.ca_nombre END as ca_empresa, 
                s.ca_nombre as ca_sucursal, 
                p.ca_nombre as ca_proceso,
                r.ca_codigo,
                r.ca_riesgo, 
                causas.ca_causas,
                r.ca_ap, 
                e.ca_documento, 
                i.ca_nombre as ca_compania, 
                ca_perdida_ope,
                ca_perdida_leg,
                ca_perdida_eco,
                ca_perdida_com,
                r.ca_clasificacion,
                tb_clasificacion.*
            FROM riesgos.tb_riesgos r
                INNER JOIN (	
                    SELECT r.ca_idriesgo, string_agg(DISTINCT ca_orden ||'. ' ||ca_causa,'<br/>') as ca_causas
                    FROM riesgos.tb_riesgos r			
                                    INNER JOIN riesgos.tb_causas c ON r.ca_idriesgo = c.ca_idriesgo	
                    GROUP BY r.ca_idriesgo
                ) as causas ON causas.ca_idriesgo = r.ca_idriesgo
                INNER JOIN riesgos.tb_procesos p ON r.ca_idproceso = p.ca_idproceso
                LEFT JOIN control.tb_empresas em ON em.ca_idempresa = p.ca_idempresa
                INNER JOIN riesgos.tb_eventos e ON r.ca_idriesgo = e.ca_idriesgo
                LEFT JOIN control.tb_sucursales s ON e.ca_idsucursal = s.ca_idsucursal
                LEFT JOIN ids.tb_ids i ON e.ca_idcliente = i.ca_id        
                LEFT JOIN (
                        SELECT ca_idriesgo, 
                                CASE WHEN (array_agg(clase))[1] IS NOT NULL then TRUE ELSE FALSE END as ca_laft,
                                CASE WHEN (array_agg(clase))[2] IS NOT NULL then TRUE ELSE FALSE END as ca_oea,
                                CASE WHEN (array_agg(clase))[3] IS NOT NULL then TRUE ELSE FALSE END as ca_calidad,
                                CASE WHEN (array_agg(clase))[4] IS NOT NULL then TRUE ELSE FALSE END as ca_legal,
                                CASE WHEN (array_agg(clase))[5] IS NOT NULL then TRUE ELSE FALSE END as ca_reputacional,
                                CASE WHEN (array_agg(clase))[6] IS NOT NULL then TRUE ELSE FALSE END as ca_operacional,
                                CASE WHEN (array_agg(clase))[7] IS NOT NULL then TRUE ELSE FALSE END as ca_contagio
                        FROM (
                                SELECT list.ca_idriesgo, cv.ca_value as clase
                                FROM (SELECT ca_idriesgo, unnest(ca_clasificacion) id_clasificacion FROM riesgos.tb_riesgos GROUP BY ca_idriesgo) as list
                                        LEFT JOIN control.tb_config_values cv ON cv.ca_ident = list.id_clasificacion AND cv.ca_idconfig = 286 
                                ) as list_clasificacion
                        GROUP BY ca_idriesgo
                ) AS tb_clasificacion ON tb_clasificacion.ca_idriesgo = r.ca_idriesgo
        $where
        ORDER BY 2,4,3,5";        
        
        $rs = $con->execute($sql);
        $riesgos = $rs->fetchAll();
        
//        echo $sql;
//        echo "<pre>";print_r($riesgos);echo "</pre>";
//        exit;
        
        foreach($riesgos as $riesgo){
            
            $arregloClasificacion = explode(",", trim($riesgo["ca_clasificacion"],"{}"));                
            $filtro = array_intersect($filtroClasificacion, $arregloClasificacion);
//            echo $riesgo["ca_codigo"]."<br/>";
//            echo "<pre>";print_r($filtroClasificacion);echo "</pre>";
//            echo "<pre>";print_r($arregloClasificacion);echo "</pre>";
//            echo "<pre>";print_r($filtro);echo "</pre>";
            if(!empty($filtroClasificacion) && empty($filtro)) {
                continue;
            }
            
            foreach($riesgo as $columna => $valor){
                if(!is_int($columna)){
                    $row[$columna] = utf8_encode($valor);
//                    echo $prop."<br/>";
                }
            }        
            $data[] = $row;
        }
        
        
//        echo "<pre>";print_r($data);echo "</pre>";
//        exit;
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");

    }
    
    public function executeActualizarClasificacion(){
        
        $riesgos = Doctrine::getTable("Riesgos")->createQuery("r")->orderBy("ca_idriesgo ASC")->execute();
        
        $conn = Doctrine::getTable("Riesgos")->getConnection();
        $conn->beginTransaction();
        
        //echo "<pre>";print_r($datos["ca_clasificacion"]);echo "<pre>";
        //exit;
        
        try{
            foreach($riesgos as $riesgo){
                if($riesgo->getCaLaft()){
                    $laft = 1;
                }else{
                    $laft = null;
                }
                 for($i=1;$i<8;$i++){
                    if($i === $laft){
                        $clasificacion[$i] = $i;
                    }else{
                        $clasificacion[$i] = 0;
                    }
                }
                $data[$riesgo->getCaCodigo()] = $clasificacion;

                $riesgo->setCaClasificacion("{".implode(",", $clasificacion)."}");
                $riesgo->setCaAprobado(true);
                $riesgo->save($conn);
            }        
            $conn->commit();
            echo "<pre>";print_r($data);echo "</pre>";
            
        }catch(Exception $e){
            $conn->rollback();
            echo $e->getMessage();
        }
        
        $this->setTemplate("responseTemplate");        
    }
    
    public function executeActualizarPermisos(){
        
        $conn = Doctrine::getTable("RsgoPermisos")->getConnection();
        $conn->beginTransaction();
        
        //echo "<pre>";print_r($datos["ca_clasificacion"]);echo "<pre>";
        //exit;
        
        try{
            $idproceso = 6;
            $procesos = Doctrine::getTable("RsgoProcesos")
                    ->createQuery("p")
                    //->where("p.ca_idproceso = ?", $idproceso)
                    ->orderBy("ca_idproceso ASC")
                    ->execute();

            foreach($procesos as $p){

                //$usuarios = Doctrine::getTable("RsgoUsuProcesos")->createQuery("up")->where("up.ca_idproceso = ?", $p->getCaIdproceso())->execute();
                $auditores = array(
                    "croman",
                    "yrobayo",
                    "nherrera",
                    "atorres",
                    "rlvaca",
                    "macorrea",
                    "jcorrea",
                    "avaron"                    
                );
                $idperfil = 3;                
                
                
                $usuarios = Doctrine::getTable("Usuario")->createQuery("u")->whereIn("ca_login", $auditores)->execute();               
                
                
                echo count($usuarios)."<br>";
                echo $p->getCaIdproceso()."fasdfasd".is_object($usuarios);
                
                if(is_object($usuarios)){
                    foreach($usuarios as $usuario){

                        $permiso = Doctrine::getTable("RsgoPermisos")->findByDql("ca_idproceso = ? AND ca_login = ?", array($p->getCaIdproceso(),$usuario->getCaLogin()))->getFirst();
                        
//                        echo $usuario->getCaLogin();
//                        echo $p->getCaIdproceso();

                        if(!$permiso){
                            $permiso = new RsgoPermisos();
                            $permiso->setCaIdproceso($p->getCaIdproceso());
                            $permiso->setCaLogin($usuario->getCaLogin());
                            
                            $permiso->setCaRiesgosView(true);
                            $permiso->setCaRiesgosNew(false);
                            $permiso->setCaRiesgosEdit(false);
                            $permiso->setCaRiesgosDelete(false);
                            $permiso->setCaRiesgosApproval(false);

                            $permiso->setCaValoracionView(false);
                            $permiso->setCaValoracionNew(false);
                            $permiso->setCaValoracionEdit(false);
                            $permiso->setCaValoracionDelete(false);

                            $permiso->setCaEventosView(true);
                            $permiso->setCaEventosNew(false);
                            $permiso->setCaEventosEdit(false);
                            $permiso->setCaEventosDelete(false);
                            
                            $permiso->setCaIdperfil($idperfil);
    //
                            $permiso->setCaInformesView(true);
                            $permiso->setCaInformesNew(false);                
    //
                            $permiso->setCaUsucreado("alramirez");
                            $permiso->setCaFchcreado(date('Y-m-d H:i:s'));
                            $permiso->save($conn);

                            $data[$p->getCaIdproceso()][] = $usuario->getCaLogin();
                        }else{
                            $data["error"][] = "El usuario=>".$usuario->getCaLogin()." ya tiene un perfil asignadopara el proceso=>".$p->getCaIdproceso()."<br/>";
                        }
                        
//                        exit;
                    }
                }



            }
            $conn->commit();
            echo "<pre>";print_r($data);echo "</pre>";
        } catch (Exception $e){
            $conn->rollback();
            echo $e->getMessage();
            
        }
                
                $this->setTemplate("responseTemplate");        
        
    }
    
    public function executeGetLastYear(sfWebRequest $request){
        
//        echo "idempresa".$request->getParameter("idempresa")."<br/>";
//        echo "idproceso".$request->getParameter("idproceso")."<br/>";
//        echo "idriesgo".$request->getParameter("idriesgo")."<br/>";
        //exit;
        //if($params){
            if($request->getParameter("idempresa")){
                if($request->getParameter("idempresa") == "Transversales"){
                    return Doctrine::getTable("RsgoValoracion")
                        ->createQuery("v")
                        ->innerJoin("v.Riesgos r")
                        ->innerJoin("r.RsgoProcesos p")
                        ->where("p.ca_idempresa IS NULL")
                        ->orderBy("ca_ano DESC")
                        ->execute()
                        ->getFirst();
                }else{
                    return Doctrine::getTable("RsgoValoracion")
                        ->createQuery("v")
                        ->innerJoin("v.Riesgos r")
                        ->innerJoin("r.RsgoProcesos p")
                        ->where("p.ca_idempresa = ?", $request->getParameter("idempresa"))
                        ->orderBy("ca_ano DESC")
                        ->execute()
                        ->getFirst();
                }                
            }else if($request->getParameter("idproceso")){
                return Doctrine::getTable("RsgoValoracion")
                        ->createQuery("v")
                        ->innerJoin("v.Riesgos r")
                        ->where("r.ca_idproceso = ?", $request->getParameter("idproceso"))
                        ->orderBy("ca_ano DESC")
                        ->execute()
                        ->getFirst();
            }else if($request->getParameter("idriesgo")){
                return Doctrine::getTable("RsgoValoracion")
                        ->createQuery("v")
                        ->where("ca_idriesgo = ?", $request->getParameter("idriesgo"))
                        ->orderBy("ca_ano DESC")
                        ->execute()
                        ->getFirst();
            }else if($request->getParameter("idriesgo")){
                return Doctrine::getTable("RsgoValoracion")
                        ->createQuery("v")
                        ->where("ca_idriesgo = ?", $request->getParameter("idriesgo"))
                        ->orderBy("ca_ano DESC")
                        ->execute()
                        ->getFirst();
            }else{
                return Doctrine::getTable("RsgoValoracion")
                        ->createQuery("v")
                        ->orderBy("ca_ano DESC")
                        ->execute()
                        ->getFirst();
            }
        //}
        $this->setTemplate("responseTemplate");   
    }
    
    public function executeAprobarRiesgo(sfWebRequest $request){
        
        $conn = Doctrine::getTable("Riesgos")->getConnection();
        $conn->beginTransaction();
        
        try{
            $idriesgo =$request->getParameter("idriesgo");
            $riesgo = Doctrine::getTable("Riesgos")->find($idriesgo);
            
            if($riesgo){
                $riesgo->setCaAprobado(true);
                $riesgo->save($conn);
                $conn->commit();
                
                $this->responseArray = array("success" => true, "mensaje"=>utf8_encode("El riesgo ".$riesgo->getCaCodigo()." ha sido aprobado correctamente."));
            }else{
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode("No se ha identificado el riesgo para aprobar!"));
            }                        
        }catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");        
        
    }
    
    public function executeGuardarPermisosProcesos(sfWebRequest $request){
        $user = $this->getUser();        
        $datos = json_decode($request->getParameter("datos"));

        $conn = Doctrine::getTable("RsgoPermisos")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = array();
            foreach ($datos as $dato) {
                
                $permiso = Doctrine::getTable("RsgoPermisos")->findByDql(("ca_idproceso = ? AND ca_login = ?"), array($dato->ca_idproceso, $dato->ca_login))->getFirst();
                if (!$permiso) {
                    $permiso = new RsgoPermisos();
                    $permiso->setCaLogin($dato->ca_nombre);
                    $permiso->setCaIdproceso($dato->ca_idproceso);
                }
                
                $permiso->setCaRiesgosView($dato->ca_riesgos_view);
                $permiso->setCaRiesgosNew($dato->ca_riesgos_new);
                $permiso->setCaRiesgosEdit($dato->ca_riesgos_edit);
                $permiso->setCaRiesgosDelete($dato->ca_riesgos_delete);
                $permiso->setCaRiesgosApproval($dato->ca_riesgos_approval);

                $permiso->setCaValoracionView($dato->ca_valoracion_view);
                $permiso->setCaValoracionNew($dato->ca_valoracion_new);
                $permiso->setCaValoracionEdit($dato->ca_valoracion_edit);
                $permiso->setCaValoracionDelete($dato->ca_valoracion_delete);

                $permiso->setCaEventosView($dato->ca_eventos_view);
                $permiso->setCaEventosNew($dato->ca_eventos_new);
                $permiso->setCaEventosEdit($dato->ca_eventos_edit);
                $permiso->setCaEventosDelete($dato->ca_eventos_delete);
                
                $permiso->setCaIdperfil($dato->ca_idperfil);
//
                $permiso->setCaInformesView($dato->ca_informes_view);
                $permiso->setCaInformesNew($dato->ca_informes_new);                
//
                //$permiso->setCaUsucreado($user->getUserId());
                //$permiso->setCaFchcreado(date('Y-m-d H:i:s'));
                $permiso->save($conn);
                $ids[] = $dato->id;
                $idsprocesos[] = $permiso->getCaIdproceso();
            }
            $conn->commit();
                
                $this->responseArray = array("success" => true, "mensaje"=>utf8_encode("Permisos Ok"), "ids" => $ids, "idsprocesos"=>$idsprocesos);
         }catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGridRiesgos(sfWebRequest $request){
        
        $filtroClasificacion = json_decode($request->getParameter("idclasificacion"));
        $con = Doctrine_Manager::getInstance()->connection();        
        
        $sql = "
            SELECT r.ca_idriesgo, 
                p.ca_idproceso,
                CASE WHEN em.ca_nombre IS NULL THEN 'Transversales' ELSE em.ca_nombre END as ca_empresa,                                 
                p.ca_orden as ca_orden,
                p.ca_nombre as ca_proceso,
                r.ca_codigo,
                r.ca_riesgo,    
                r.ca_activo,
                r.ca_aprobado,
                r.ca_usucreado,
                r.ca_fchcreado,
                r.ca_usuactualizado,
                r.ca_fchactualizado,
                r.ca_clasificacion,
                tb_valoracion.*,
                tb_clasificacion.*
            FROM riesgos.tb_riesgos r
                INNER JOIN riesgos.tb_procesos p ON r.ca_idproceso = p.ca_idproceso
                LEFT JOIN control.tb_empresas em ON em.ca_idempresa = p.ca_idempresa                
                LEFT JOIN (
                        SELECT ca_idriesgo as ca_idriesgo_cla, 
                                CASE WHEN (array_agg(clase))[1] IS NOT NULL then TRUE ELSE FALSE END as ca_laft,
                                CASE WHEN (array_agg(clase))[2] IS NOT NULL then TRUE ELSE FALSE END as ca_oea,
                                CASE WHEN (array_agg(clase))[3] IS NOT NULL then TRUE ELSE FALSE END as ca_calidad,
                                CASE WHEN (array_agg(clase))[4] IS NOT NULL then TRUE ELSE FALSE END as ca_legal,
                                CASE WHEN (array_agg(clase))[5] IS NOT NULL then TRUE ELSE FALSE END as ca_reputacional,
                                CASE WHEN (array_agg(clase))[6] IS NOT NULL then TRUE ELSE FALSE END as ca_operacional,
                                CASE WHEN (array_agg(clase))[7] IS NOT NULL then TRUE ELSE FALSE END as ca_contagio
                        FROM (
                                SELECT list.ca_idriesgo, cv.ca_value as clase
                                FROM (SELECT ca_idriesgo, unnest(ca_clasificacion) id_clasificacion FROM riesgos.tb_riesgos GROUP BY ca_idriesgo) as list
                                                LEFT JOIN control.tb_config_values cv ON cv.ca_ident = list.id_clasificacion AND cv.ca_idconfig = 286 
                                ) as list_clasificacion
                        GROUP BY ca_idriesgo
                ) AS tb_clasificacion ON tb_clasificacion.ca_idriesgo_cla = r.ca_idriesgo
                LEFT JOIN (
                        SELECT v.ca_idriesgo as ca_idriesgo_val, max(v.ca_ano) as ca_ano, string_agg(DISTINCT s.ca_nombre,'<br/>') as ca_sucursal, round(avg(((ca_operativo*10*0.01)+(ca_legal*30*0.01)+(ca_economico*40*0.01)+(ca_comercial*20*0.01))*ca_peso),2) as ca_score
                        FROM riesgos.tb_valoracion v
                                INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = v.ca_idsucursal
                                INNER JOIN (SELECT ca_idriesgo, max(ca_ano) as ca_ano FROM riesgos.tb_valoracion v GROUP BY ca_idriesgo) as y ON y.ca_idriesgo = v.ca_idriesgo AND y.ca_ano = v.ca_ano
                        GROUP BY v.ca_idriesgo
                ) AS tb_valoracion ON tb_valoracion.ca_idriesgo_val = r.ca_idriesgo
            ORDER BY 3,4,5,6";        
        
        $rs = $con->execute($sql);
        $riesgos = $rs->fetchAll();
        
        foreach($riesgos as $riesgo){
            
            $arregloClasificacion = explode(",", trim($riesgo["ca_clasificacion"],"{}"));                
            $filtro = array_intersect($filtroClasificacion, $arregloClasificacion);
            if(!empty($filtroClasificacion) && empty($filtro)) {
                continue;
            }
            
            foreach($riesgo as $columna => $valor){
                if(!is_int($columna)){
                    $row[$columna] = utf8_encode($valor);
                }
            }        
            $data[] = $row;
        }
        
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGetPermisosByUsuario(sfWebRequest $request){
        
        $idempresaUser = $request->getParameter("idempresaUser");    
        $login = $request->getParameter("login");
        $procesos = $request->getParameter("procesos");
        
        $permisos = Doctrine::getTable("RsgoPermisos")
            ->createQuery("p")
            ->where("p.ca_login = ?", $login)
            ->execute();
        
        $dataPermisos = array();       
            
        foreach($permisos as $p){            
            $dataPermisos[$p->getCaIdproceso()]["riesgos"]["ver"] = $p->getCaRiesgosView();
            $dataPermisos[$p->getCaIdproceso()]["riesgos"]["crear"] = $p->getCaRiesgosNew();
            $dataPermisos[$p->getCaIdproceso()]["riesgos"]["editar"] = $p->getCaRiesgosEdit();            
            $dataPermisos[$p->getCaIdproceso()]["riesgos"]["eliminar"] = $p->getCaRiesgosDelete();
            $dataPermisos[$p->getCaIdproceso()]["riesgos"]["aprobar"] = $p->getCaRiesgosApproval();
            $dataPermisos[$p->getCaIdproceso()]["valoracion"]["ver"] = $p->getCaValoracionView();
            $dataPermisos[$p->getCaIdproceso()]["valoracion"]["crear"] = $p->getCaValoracionNew();
            $dataPermisos[$p->getCaIdproceso()]["valoracion"]["editar"] = $p->getCaValoracionEdit();            
            $dataPermisos[$p->getCaIdproceso()]["valoracion"]["eliminar"] = $p->getCaValoracionDelete();
            $dataPermisos[$p->getCaIdproceso()]["eventos"]["ver"] = $p->getCaEventosView();
            $dataPermisos[$p->getCaIdproceso()]["eventos"]["crear"] = $p->getCaEventosNew();
            $dataPermisos[$p->getCaIdproceso()]["eventos"]["editar"] = $p->getCaEventosEdit();            
            $dataPermisos[$p->getCaIdproceso()]["eventos"]["eliminar"] = $p->getCaEventosDelete();
            $dataPermisos[$p->getCaIdproceso()]["informes"]["ver"] = $p->getCaInformesView();
            $dataPermisos[$p->getCaIdproceso()]["informes"]["crearversion"] = $p->getCaInformesNew();            
            //$dataPermisos[$p->getCaIdproceso()]["auditor"] = $p->getCaAuditor();            
            $dataPermisos[$p->getCaIdproceso()]["admin"] = false;

            $usu_admins = Doctrine::getTable("UsuarioPerfil")->findBy("ca_perfil", self::PERFIL_ADMON);        
            foreach($usu_admins as $usuario){
                if($usuario->getCaLogin() == $login){
                    $dataPermisos[$p->getCaIdproceso()]["admin"] = true;
                }
            }
            $procesosConPermiso[] = $p->getCaIdproceso();
        } 
        
        foreach($procesos as $proceso){
            if(!in_array($proceso->getCaIdproceso(), $procesosConPermiso)){
                if($proceso->getCaIdempresa() === NULL || $proceso->getCaIdempresa() === $idempresaUser){
                    $dataPermisos[$proceso->getCaIdproceso()]["riesgos"]["ver"] = true;
                    $dataPermisos[$proceso->getCaIdproceso()]["valoracion"]["ver"] = true;
                    $dataPermisos[$proceso->getCaIdproceso()]["eventos"]["ver"] = false;
                    $dataPermisos[$proceso->getCaIdproceso()]["informes"]["ver"] = false;
                }
            }
        }
        
        $this->setTemplate("none");
        return $dataPermisos;
    }
    
    public function executeGuardarGridMaestraRiesgos(sfWebRequest $request){
        $user = $this->getUser();        
        $datos = json_decode($request->getParameter("datos"));

        $conn = Doctrine::getTable("Riesgos")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = array();
            foreach ($datos as $dato) {
                
                $riesgo = Doctrine::getTable("Riesgos")->find($dato->idriesgo);                
                
                if(intval($dato->proceso)>0)
                    $riesgo->setCaIdproceso($dato->proceso);
                
                $riesgo->setCaCodigo($dato->codigo);
                
                if($dato->activo)
                    $riesgo->setCaActivo(true);
                else{
                    $riesgo->setCaActivo(false);
                }
                
                if($dato->aprobado)
                    $riesgo->setCaAprobado(true);
                else{
                    $riesgo->setCaAprobado(false);
                }
                
                $clasificaciones = array("laft","oea","calidad","legal","reputacional","operacional","contagio");
                
                foreach($clasificaciones as $key => $valor){                    
                    eval('$item = $dato->'.$valor.';');                    
                    if($item){
                        $clasificacion[$key+1] = $key+1;
                    }else{
                        $clasificacion[$key+1] = 0;
                    }
                }
                $riesgo->setCaClasificacion("{".implode(",", $clasificacion)."}");
                $riesgo->save($conn);
                $ids[] = $dato->id;
                $idsriesgos[] = $riesgo->getCaIdriesgo();
            }
            //exit;
            $conn->commit();
                
            $this->responseArray = array("success" => true, "mensaje"=>utf8_encode("Riesgo modificado correctamente"), "ids" => $ids, "idsriesgos"=>$idsriesgos);
         }catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEsAdministrador(sfWebRequest $request){
        $this->setTemplate("none");
        $login = $request->getParameter("login");
        
        $usu_admins = Doctrine::getTable("UsuarioPerfil")->findBy("ca_perfil", self::PERFIL_ADMON);        
        foreach($usu_admins as $usuario){
            if($usuario->getCaLogin() == $login){
                return true;
            }
        }
        
        return false;
    }    
    
    
    
    
    
}
?>
