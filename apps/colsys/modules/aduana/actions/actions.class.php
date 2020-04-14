<?php

/**
 * aduana actions.
 *
 * @package    symfony
 * @subpackage aduana
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class aduanaActions extends sfActions {
    
    const RUTINA_EXPOADUANA = 226;
    const RUTINA_CRM = 211;

    public function executeIndexExt5(sfWebRequest $request) {
        
        $this->permisos = array();

        $user = $this->getUser();

        $permisosRutinas["expoaduana"] = $user->getControlAcceso(self::RUTINA_EXPOADUANA);
        
        $tipopermisos = array('Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Abrir' => 3, 'Cerrar' => 4, 'Auditoría' => 5);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                $this->permisos[$k][utf8_encode($index)] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }

        if($request->getParameter("idmaster")){
            $this->inoMaster = Doctrine::getTable("InoMaestraAdu")
                ->createQuery("m")
                ->select("m.ca_idmaster,m.ca_referencia,m.ca_impoexpo,m.ca_transporte,m.ca_fchcerrado,m.ca_fchliquidado")
                ->whereIn("m.ca_idmaster", json_decode($request->getParameter("idmaster")))                
                ->execute();
        }           
//        echo "<pre>";print_r($this->permisos);echo "</pre>";
//        exit;
                
        $this->permisosCrm = array();

        $permisosCrm = $user->getControlAcceso(self::RUTINA_CRM);

        $tipopermisosCrm = $user->getAccesoTotalRutina(self::RUTINA_CRM);
        foreach ($tipopermisosCrm as $index => $tp) {
            $this->permisosCrm[$index] = in_array($tp, $permisosCrm) ? true : false;
        }
    }
    
    function executeDatosBusqueda($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $user = $this->getUser();

        /* Accesos del usuario */
        $permisosRutinas["expoaduana"] = $user->getControlAcceso(self::RUTINA_EXPOADUANA);
        
        $usuario = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("ca_login,ca_datos")
                ->addWhere("u.ca_login = ?", $this->getUser()->getUserId())
                ->fetchOne();
        
        $datosusuario = json_decode($usuario->getCaDatos());
        
        $permisos = array();
        $tipopermisos = array('Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Abrir' => 3, 'Cerrar' => 4, 'Auditoría' => 5);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                $permisos[$k][utf8_encode($index)] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }
        
        $where = "";
        foreach ($request->getParameter("opciones") as $o) {    
            if ($where != "")
                $where .= " OR ";
            
            if($o=="ca_compania" || $o=="ca_factura" || $o=="ca_referencia")
            {
                $where .= ' UPPER('.$o.')' . " like ?";
                $whereq[] = "%" . strtoupper($request->getParameter("q")) . "%";                
            }            
            else
            {
                $where .= $o . " = ?";
                $whereq[] = "" . $request->getParameter("q") . "";
            }
        }
        if ($where != "") {
            $where = " ($where)";
        }
        
        $q = Doctrine::getTable("InoViExpoAduana")
                ->createQuery("m")
                ->distinct("ca_referencia")
                ->select("ca_idmaster, ca_referencia, ca_idreporte, ca_consecutivo, ca_transporte,ca_impoexpo,ca_regimen,ca_fchcreado, ca_fchcerrado,ca_fchliquidado, ca_origen, ca_destino")                
                ->orderBy("ca_fchcreado DESC")
                ->limit(40)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        if($where!="")
            $q->addWhere("" . $where, $whereq);
        
        $where = "";
        $whereq = array();
        $wherePermisos = " (";
        if ($permisos["expoaduana"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            $where .= "(ca_impoexpo = ?) ";
            $whereq[] = Constantes::EXPO;
        }

        $wherePermisos .= $where . " )";
        $q->addWhere("" . $where, $whereq);
        
        $debug = utf8_encode($q->getSqlQuery());
        $datos = $q->execute();
        
        foreach ($datos as $k => $d) {
            $datos[$k]["m_ca_transporte"] = utf8_encode($datos[$k]["m_ca_transporte"]);
            $datos[$k]["m_ca_impoexpo"] = utf8_encode($datos[$k]["m_ca_impoexpo"]);
            $datos[$k]["m_ca_modalidad"] = utf8_encode($datos[$k]["m_ca_modalidad"]);
            $datos[$k]["m_ca_regimen"] = utf8_encode($datos[$k]["m_ca_regimen"]);

            if(!$datos[$k]["m_ca_idreporte"]){
                $origen = $datos[$k]["m_ca_origen"];
                $datos[$k]["m_ca_origen"] = $datos[$k]["m_ca_destino"];
                $datos[$k]["m_ca_destino"] = $origen;
            }
            
            $class="";
            if($datos[$k]["m_ca_fchanulado"]!="")
            {
                $class="row_purple";
            }
            else if($datos[$k]["m_ca_fchcerrado"]!="")
            {
                $class="row_gray";
            }
            else if($datos[$k]["m_ca_fchliquidado"]!="")
            {
                $class="row_yellow";
            }
            $datos[$k]["class"]=$class;            
        }
        
//        echo "<pre>";print_r($datos);echo "</pre>";
//        exit;
        
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "debug" => $debug, "permisos"=> $permisos);
        $this->setTemplate("responseTemplate");
    }

    public function executeInoAduanaExpoExt5(sfWebRequest $request){
        
        $this->permisos = array();

        $user = $this->getUser();

        $permisosRutinas["expoaduana"] = $user->getControlAcceso(self::RUTINA_EXPOADUANA);
        
        $tipopermisos = array('Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Abrir' => 3, 'Cerrar' => 4, 'Auditoría' => 5);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                $this->permisos[$k][utf8_encode($index)] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }
                
        $this->permisosCrm = array();

        $permisosCrm = $user->getControlAcceso(self::RUTINA_CRM);

        $tipopermisosCrm = $user->getAccesoTotalRutina(self::RUTINA_CRM);
        foreach ($tipopermisosCrm as $index => $tp) {
            $this->permisosCrm[$index] = in_array($tp, $permisosCrm) ? true : false;
        }
    }
    
    
    public function executeGuardarMasterAdu(sfWebRequest $request){
        $conn = Doctrine::getTable("InoMaestraAdu")->getConnection();        
        $conn->beginTransaction();
        try 
        {
            $idmaster = $request->getParameter("idmaster");
            $referencia = $request->getParameter("referencia");
            $this->forward404Unless($referencia);
            $error = "";
            
            $inoMaestraAdu = Doctrine::getTable("InoMaestraAdu")->find($referencia);            
            
//            echo $idmaster;
//		exit;
            if ($idmaster == "0") {
                $idreporte = $request->getParameter("idreporte");
                $this->forward404Unless($idreporte);
            }else{
                $idreporte = $inoExpoAdu->getCaIdreporte();
            }

            $reporte = Doctrine::getTable("Reporte")->find($idreporte);
            if($reporte->getRepAduana()){                
                $reporteEnAduana = $reporte->getReferenciaExpoAdu();        

		if(is_object($reporteEnAduana) && ($reporteEnAduana->getCaReferencia() !== $referencia))                
                    $error = "El reporte de negocios ".$reporte->getCaConsecutivo()." ya está siendo usado en la referencia: ".$reporteEnAduana->getCaReferencia();            
	    }else{
                $error = "El reporte de negocios ".$reporte->getCaConsecutivo()." no tiene Aduana";
            }
            
            if ($error == "") {
                $repexpo = $reporte->getRepexpo();
                if(!$inoExpoAdu){                    
                    $inoExpoAdu = new InoExpoAdu();                    
                    $inoExpoAdu->setCaReferencia($referencia);
                }

                if($idmaster == "0"){
                    $inoMaestraAdu->setCaCoordinador($reporte->getRepAduana()->getCaCoordinador());
                    $inoMaestraAdu->setCaPedido(substr($reporte->getCaOrdenClie(), 1,100));
                    $inoMaestraAdu->setCaTransporte($reporte->getCaTransporte());
                    $inoExpoAdu->setCaIdreporte($idreporte);
                }

                $inoMaestraAdu->setCaOrigen($request->getParameter("idorigen"));
                $inoMaestraAdu->setCaDestino($request->getParameter("iddestino"));
                $inoMaestraAdu->setCaMercancia($request->getParameter("ca_descripcion"));
                $inoMaestraAdu->setCaFcharribo($request->getParameter("ca_fchllegada"));
                $inoMaestraAdu->setCaPiezas($request->getParameter("ca_piezas"));
                $inoMaestraAdu->setCaPeso($request->getParameter("ca_peso"));
                $inoMaestraAdu->setCaAplicaidg($request->getParameter("aplicaidg")=="SI"?true:false);                        
                $inoMaestraAdu->setCaImpoexpo(utf8_decode($request->getParameter("impoexpo")));                    

                $inoMaestraAdu->setDatosJson("ca_modalidad", utf8_decode($request->getParameter("modalidad")));
                $inoMaestraAdu->setDatosJson("ca_idlinea", intval($request->getParameter("proveedor")));
                $inoMaestraAdu->setDatosJson("ca_idagente", intval($request->getParameter("agente")));
                $inoMaestraAdu->setDatosJson("ca_volumen", intval($request->getParameter("ca_volumen")));                    
                $inoMaestraAdu->setDatosJson("ca_fchsalida", $request->getParameter("ca_fchsalida"));                    
                $inoMaestraAdu->save($conn);

                $inoExpoAdu->setCaIdregimen(intval($request->getParameter("ca_modalidad")));
                $inoExpoAdu->setCaIdagencia(intval($request->getParameter("agenciaad")));
                $inoExpoAdu->save($conn);
                
                $repexpo->setCaRefaduana($referencia);
                $repexpo->save($conn);

                $conn->commit();
                $this->responseArray = array("success" => true, "idmaster" => $inoMaestraAdu->getCaIdmaster(), "idreferencia" => $inoMaestraAdu->getCaReferencia(), 'idtransporte' => utf8_encode($inoMaestraAdu->getCaTransporte()), 'idimpoexpo' => utf8_encode($inoMaestraAdu->getCaImpoexpo()), "origen"=>$inoMaestraAdu->getCaOrigen(), "destino"=>($inoMaestraAdu->getCaDestino()));                

            } else {
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($error));
                $this->setTemplate("responseTemplate");
            }
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success"=>false, "errorInfo"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosMasterAduana(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        if ($idmaster != "0") {
            $this->forward404Unless($idmaster);

            $ino = Doctrine::getTable("InoMaestraAdu")->findBy("ca_idmaster",$idmaster)->getFirst();

            $this->forward404Unless($ino);

            try {
                $datos = json_decode(utf8_encode($ino->getCaDatos()));
                $data["idmaster"] = $idmaster;                
                $data["referencia"] = utf8_encode($ino->getCaReferencia());
                $data["aplicaidg"] = $ino->getCaAplicaidg()?"SI":"NO";

                $data["ca_idcliente"] = $ino->getCliente()->getCaIdalterno();
                if ($ino->getCaIdcliente()) {
                    $cliente = Doctrine::getTable("Cliente")->find(utf8_encode($ino->getCaIdcliente()));
                    $data["ca_compania"] = utf8_encode($cliente->getCaCompania());
                }
                
                $data["idreporte"] = $ino->getInoExpoAdu()->getCaIdreporte();
                echo $data["idreporte"];
                exit;
                
                $reporte = Doctrine::getTable("Reporte")->find($data["idreporte"]);
                $data["consecutivo"] = $reporte->getCaConsecutivo();

                $caso = "CU011";
                $datomod = ParametroTable::retrieveByCaso($caso, null, null, $ino->getInoExpoAdu()->getCaIdregimen());

                $data["id_modalidad"] = $ino->getInoExpoAdu()->getCaIdregimen();
                if ($ino->getInoExpoAdu()->getCaIdregimen()) {
                    $data["ca_modalidad"] = utf8_encode($datomod[0]->getCaValor());
                }
                
                $data["ca_descripcion"] = utf8_encode($ino->getCaMercancia());                
                $data["idagencia"] = $ino->getInoExpoAdu()->getCaIdagencia();
                if ($data["idagencia"]) {
                    $agencia = Doctrine::getTable("Ids")->find($data["idagencia"]);
                    if($agencia)
                        $data["agencia"] = utf8_encode($agencia->getCaNombre());
                }

                $data["impoexpo"] = utf8_encode($ino->getCaImpoexpo());
                $data["transporte"] = utf8_encode($ino->getCaTransporte());
                $data["modalidad"] = $datos->ca_modalidad;

                if ($data['modalidad'] != null && $data['modalidad'] != "" ) {
                    $data['modalidadnoeditable'] = true;
                } else {
                    $data['modalidadnoeditable'] = false;
                }

                $data["fchreferencia"] = utf8_encode($ino->getCaFchreferencia());
                $data["idorigen"] = utf8_encode($ino->getCaOrigen());
                $ciudadorigen = Doctrine::getTable('Ciudad')->createQuery('c')
                        ->select("ca_idciudad,ca_ciudad")
                        ->innerJoin('c.Trafico t')
                        ->addWhere('c.ca_idciudad = ?', $ino->getCaOrigen())
                        ->fetchOne();
                if ($ciudadorigen) {
                    $data['origen'] = utf8_encode($ciudadorigen->getCaCiudad());
                }
                //
                if ($data['idorigen'] != null && $data['idorigen'] != "") {
                    $data['origennoeditable'] = true;
                } else {
                    $data['origennoeditable'] = false;
                }

                $data["iddestino"] = utf8_encode($ino->getCaDestino());
                $ciudadestino = Doctrine::getTable('Ciudad')->createQuery('c')
                        ->select("ca_idciudad,ca_ciudad")
                        ->innerJoin('c.Trafico t')
                        ->addWhere('c.ca_idciudad = ?', $ino->getCaDestino())
                        ->fetchOne();
                if ($ciudadestino) {
                    $data['destino'] = utf8_encode($ciudadestino->getCaCiudad());
                }
                
                if ($data['iddestino'] != null && $data['iddestino'] != "") {
                    $data['destinonoeditable'] = true;
                } else {
                    $data['destinonoeditable'] = false;
                }

                $data["proveedor"] =$datos->ca_idlinea;
                    $proveedor = Doctrine::getTable("IdsProveedor")->find($datos->ca_idlinea);
                    if($proveedor)
                        $data["linea"] = utf8_encode($proveedor->getIds()->getCaNombre());

                $data["idagente"] = $datos->ca_idagente;
                    $agente = Doctrine::getTable("IdsProveedor")->find($datos->ca_idagente);
                    if($agente)
                        $data["nombre"] = utf8_encode($agente->getIds()->getCaNombre());
                
                $data["ca_fchsalida"] = $datos->ca_fchsalida;
                $data["ca_fchllegada"] = $ino->getCaFcharribo();
                $data["ca_piezas"] = utf8_encode($ino->getCaPiezas());
                $data["ca_peso"] = utf8_encode($ino->getCaPeso());
                $data["ca_volumen"] = $datos->ca_volumen;
                
                $datos = json_decode($ino->getCaDatos());
                
                $this->responseArray = array("success" => true, "data" => $data);
            } catch (Exception $e) {
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        } else {
            $this->responseArray = array("success" => true, "data" => '');
        }
        $this->setTemplate("responseTemplate");
    }        
    
    public function executeGuardarReferenciaAduana(sfWebRequest $request){
        $conn = Doctrine::getTable("InoMaestraAdu")->getConnection();        
        $conn->beginTransaction();
        try 
        {

            $idreferencia = $request->getParameter("comboReferencia");
            
            $referencia = Doctrine::getTable("InoMaestraAdu")->find($idreferencia);
            
            if($referencia){
                
                $datos = json_decode(utf8_encode($referencia->getCaDatos()));
                $idreporte = $request->getParameter("comboReporte");                
                $reporte = Doctrine::getTable("Reporte")->find($idreporte);                
                $repexpo = $reporte->getRepexpo();
                
                if($reporte->getCaConsecutivo() != $datos->consecutivo){
                    $q = new Doctrine_RawSql();

                    $q->select("{adu.ca_referencia}");
                    $q->from("tb_brk_maestra adu
                            inner join (
                                SELECT ca_referencia, case when count(ca_datos->'idreporte') >0 then true else false end
                                from tb_brk_maestra
                                where (ca_datos->'consecutivo')::text = '\"".$reporte->getCaConsecutivo()."\"' group by ca_referencia) v ON v.ca_referencia = adu.ca_referencia");

                    $q->limit(1);
                    $q->addComponent('adu', 'InoMaestraAdu adu');

                    //                echo $q->getSqlQuery();
                    //                exit;
                    //                
                    $refs = $q->execute();
                }
                
                if(count($refs) == 0){                
                    
                    $datos->agencia = $request->getParameter("agenciaad");
                    $datos->idg = $request->getParameter("aplicaidg");
                    $datos->modalidad = $request->getParameter("ca_modalidad");
                    $datos->idreporte = $idreporte;
                    $datos->consecutivo = $reporte->getCaConsecutivo();
                    $datos->impoexpo = utf8_encode($reporte->getCaImpoexpo());
                    $referencia->setCaTransporte(utf8_decode($request->getParameter("fmTransporte")));
                    $referencia->setCaDatos(json_encode($datos));
                    $referencia->save($conn);
                    
                    $repexpo->setCaRefaduana($referencia->getCaReferencia());
                    $repexpo->save($conn);
                    
                    $conn->commit();
                    $this->responseArray = array("success"=>true, "msg"=>utf8_decode("Los datos de la referencia han sido guardados correctamente"));
                }else{
                    $this->responseArray = array("success"=>false, "msg"=> utf8_encode("No es posible guardar. El reporte ya fué usado en otra referencia. ".$refs[0]->getCaReferencia()));
                }
            }else{
                $this->responseArray = array("success"=>false, "msg"=> utf8_encode("No se encontró la referencia seleccionada"));
            }
            
            
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success"=>false, "msg"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
}
