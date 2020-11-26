<?php

//use NotTarea;

/**
 * status actions.
 *
 * @package    symfony
 * @subpackage status
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statusActions extends sfActions {

    /**
     * Executes index action
     * 
     * */
    const RUTINA_CONFIRMACIONES = 213;
    const RUTINA_MARITIMO = 201;
    const RUTINA_OTM = 204;

    const RUTINA_AEREO = 200;
    const RUTINA_TERRESTRE = 202;
    const RUTINA_EXPORTACION = 203;

    /*
     * @param sfRequest $request A request object
     */

    public function executeIndex() {
        //$this->forward('default', 'module');
        //echo "si";
    }

    public function executeIndexExt5($request) {

        $user = $this->getUser();
        $this->permisos = array();

        $accesosConf = $user->getControlAcceso(self::RUTINA_CONFIRMACIONES);
        $accesosSea = $user->getControlAcceso(self::RUTINA_MARITIMO);
        $accesosOtm = $user->getControlAcceso(self::RUTINA_OTM);

        $accesosAer = $user->getControlAcceso(self::RUTINA_AEREO);
        $accesosTer = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $accesosExpo = $user->getControlAcceso(self::RUTINA_EXPORTACION);

        $coordinadores = array();
        $parametros = ParametroTable::retrieveByCaso("CU046");
        $tx = "";
        foreach ($parametros as $parametro) {
            $valor = explode("|", $parametro->getCaValor());
            if ($tx == "") {
                $tx.= utf8_encode($parametro->getCaValor2());
            }
            $coordinadores[$valor[0]] = utf8_encode($valor[1]);
            $textOtm[$valor[0]] = $tx . " " . $coordinadores[$valor[0]];
        }
        //echo "<pre>";print_r($textOtm);echo "</pre>";
        //echo implode("|", $textOtm);
        //print_r($accesosConf);
        //exit;

        foreach ($accesosConf as $key => $metodo) {
            $texto = Doctrine::getTable("Parametro")
                    ->createQuery("p")
                    ->where("p.ca_casouso = ?", "CU273")
                    ->addWhere("p.ca_valor = ?", $metodo)
                    ->fetchOne();

            $rutinaNivel = Doctrine::getTable("RutinaNivel")
                    ->createQuery("r")
                    ->addWhere("r.ca_rutina = ? AND r.ca_nivel = ?", array(self::RUTINA_CONFIRMACIONES, $key))
                    ->fetchOne();

            if ($rutinaNivel) {
                $detalle = utf8_encode($rutinaNivel->getCaDescripcion());
            }
            if ($accesosSea[0] && $rutinaNivel) {
                $this->permisos["maritimo"][utf8_encode($metodo)]["valor"] = true;
                $this->permisos["maritimo"][utf8_encode($metodo)]["detalle"] = $detalle;
                $this->permisos["maritimo"][utf8_encode($metodo)]["texto"] = utf8_encode($texto->getCaValor2());
                if ($metodo === "llegada") {
                    $this->permisos["maritimo"][utf8_encode($metodo)]["textotm"] = $textOtm;
                }
                if ($metodo === "ffletes") {
                    $this->permisos["maritimo"][utf8_encode($metodo)]["texto"] = json_decode($this->permisos["maritimo"][utf8_encode($metodo)]["texto"], 1);
                }
            }
            if ($accesosOtm[0]) {
                $this->permisos["otm"][utf8_encode($metodo)]["valor"] = true;
                $this->permisos["otm"][utf8_encode($metodo)]["detalle"] = $detalle;
                $this->permisos["otm"][utf8_encode($metodo)]["texto"] = utf8_encode($texto->getCaValor2());

                if ($metodo === "ffletes") {
                    $this->permisos["otm"][utf8_encode($metodo)]["texto"] = json_decode($this->permisos["otm"][utf8_encode($metodo)]["texto"], 1);
                }
            }
            
            if ($accesosAer[0]) {
                $this->permisos["aereo"][utf8_encode($metodo)]["valor"] = true;
                $this->permisos["aereo"][utf8_encode($metodo)]["detalle"] = $detalle;
                $this->permisos["aereo"][utf8_encode($metodo)]["texto"] = utf8_encode($texto->getCaValor2());

                if ($metodo === "ffletes") {
                    $this->permisos["aereo"][utf8_encode($metodo)]["texto"] = json_decode($this->permisos["aereo"][utf8_encode($metodo)]["texto"], 1);
                }
            }
            
            if ($accesosTer[0]) {
                $this->permisos["terrestre"][utf8_encode($metodo)]["valor"] = true;
                $this->permisos["terrestre"][utf8_encode($metodo)]["detalle"] = $detalle;
                $this->permisos["terrestre"][utf8_encode($metodo)]["texto"] = utf8_encode($texto->getCaValor2());

                if ($metodo === "ffletes") {
                    $this->permisos["terrestre"][utf8_encode($metodo)]["texto"] = json_decode($this->permisos["terrestre"][utf8_encode($metodo)]["texto"], 1);
                }
            }
            
            if ($accesosExpo[0]) {
                $this->permisos["expo"][utf8_encode($metodo)]["valor"] = true;
                $this->permisos["expo"][utf8_encode($metodo)]["detalle"] = $detalle;
                $this->permisos["expo"][utf8_encode($metodo)]["texto"] = utf8_encode($texto->getCaValor2());

                if ($metodo === "ffletes") {
                    $this->permisos["expo"][utf8_encode($metodo)]["texto"] = json_decode($this->permisos["expo"][utf8_encode($metodo)]["texto"], 1);
                }
            }
            unset($texto);
        }
        
        //print_r($this->permisos);
        //exit;

        $this->inoMaster = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
        $this->modulo = $request->getParameter("modulo") ? $request->getParameter("modulo") : null;
//        echo "<pre>";print_r($this->permisos);echo "</pre>";
//        //echo "<pre>";print_r($textos);echo "</pre>";
//        exit();
    }

    function executeDatosBusqueda($request) {

        $user = $this->getUser();
        $permisos = array();

        try {
            /* Accesos del usuario */
            $accesosConf = $user->getControlAcceso(self::RUTINA_CONFIRMACIONES);
            $accesosSea = $user->getControlAcceso(self::RUTINA_MARITIMO);
            $accesosOtm = $user->getControlAcceso(self::RUTINA_OTM);

            $accesosAer = $user->getControlAcceso(self::RUTINA_AEREO);
            $accesosTer = $user->getControlAcceso(self::RUTINA_TERRESTRE);
            $accesosExpo = $user->getControlAcceso(self::RUTINA_EXPORTACION);

            for ($i = 0; $i < count($accesosConf); $i++) {
                if ($accesosSea[0]) { //consulta                
                    $permisos["maritimo"][utf8_encode($accesosConf[$i])] = true;
                }
                if ($accesosOtm[0]) { //consulta                
                    $permisos["otm"][utf8_encode($accesosConf[$i])] = true;
                }
                
                if ($accesosAer[0]) { //consulta                
                    $permisos["aereo"][utf8_encode($accesosConf[$i])] = true;
            }
                if ($accesosTer[0]) { //consulta                
                    $permisos["terrestre"][utf8_encode($accesosConf[$i])] = true;
                }
                if ($accesosExpo[0]) { //consulta                
                    $permisos["expo"][utf8_encode($accesosConf[$i])] = true;
                }
            }

            //echo "<pre>";print_r($permisos);echo "</pre>";

            $where = "";
            foreach ($request->getParameter("opciones") as $o) {
                if ($where != "")
                    $where .=" OR ";
                $where .= $o . " like ?";
                $whereq[] = "%" . $request->getParameter("q") . "%";
            }
            if ($where != "") {
                $where = " ($where)";
            }

            $q = Doctrine::getTable("InoViBusqueda")
                    ->createQuery("m")
                    ->distinct("ca_referencia")
                    ->select("ca_referencia, ca_fchcreado,ca_transporte,ca_impoexpo,ca_idmaster,ca_modalidad,ca_fchcerrado")
                    ->addWhere("" . $where, $whereq)
                    ->orderBy("ca_fchcreado DESC")
                    ->limit(40)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $where = "";
            $whereq = array();
            $wherePermisos = " (";
            if ($permisos["maritimo"]) {
                if ($where != "")
                    $where .=" OR ";
                $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
                $whereq[] = Constantes::IMPO;
                $whereq[] = Constantes::MARITIMO;
            }

            if ($permisos["maritimo"]) {
                if ($where != "")
                    $where .=" OR ";
                $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
                $whereq[] = Constantes::TRIANGULACION;
                $whereq[] = Constantes::MARITIMO;
            }

            if ($permisos["otm"]) {
                if ($where != "")
                    $where .=" OR ";
                $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
                $whereq[] = Constantes::OTMDTA;
                $whereq[] = Constantes::TERRESTRE;
            }

            if ($permisos["aereo"]) {
                if ($where != "")
                    $where .= " OR ";
                $where .= "( (ca_impoexpo = ? or ca_impoexpo = ?) AND ca_transporte=? ) ";
                $whereq[] = Constantes::IMPO;
                $whereq[] = Constantes::TRIANGULACION;
                $whereq[] = Constantes::AEREO;
            }

            if ($permisos["terrestre"]) {
                //echo "ss";
                if ($where != "")
                    $where .= " OR ";
                $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
                $whereq[] = Constantes::INTERNO;
                $whereq[] = Constantes::TERRESTRE;
            }

            if ($permisos["exportacion"]) {
                if ($where != "")
                    $where .= " OR ";
                $where .= "(ca_impoexpo = ?  ) ";
                $whereq[] = Constantes::EXPO;
            }

            $wherePermisos.=$where . " )";
            $q->addWhere("" . $where, $whereq);
            $debug = utf8_encode($q->getSqlQuery());
            $datos = $q->execute();

            foreach ($datos as $k => $d) {
                $datos[$k]["m_ca_transporte"] = utf8_encode($datos[$k]["m_ca_transporte"]);
                $datos[$k]["m_ca_impoexpo"] = utf8_encode($datos[$k]["m_ca_impoexpo"]);
                $datos[$k]["m_ca_modalidad"] = utf8_encode($datos[$k]["m_ca_modalidad"]);
            }

            $this->permisos = $permisos;

            $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "debug" => $debug);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeHtmlCabecera($request) {

        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $master = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($master);

        try {
            $data = array();
            $data["fchreferencia"] = $master->getCaFchreferencia();
            $data["referencia"] = $master->getCaReferencia();
            $data["modalidad"] = utf8_encode($master->getCaModalidad());
            $data["mbl"] = utf8_encode($master->getCaMaster());
            $data["traorigen"] = utf8_encode($master->getOrigen()->getTrafico()->getCaNombre());
            $data["origen"] = utf8_encode($master->getOrigen()->getCaCiudad());
            $data["tradestino"] = utf8_encode($master->getDestino()->getTrafico()->getCaNombre());
            $data["destino"] = utf8_encode($master->getDestino()->getCaCiudad());
            $data["linea"] = utf8_encode($master->getIdsProveedor()->getIds()->getCaNombre());
            $data["motonave"] = utf8_encode($master->getCaMotonave());
            $data["fchembarque"] = $master->getCaFchsalida();
            $data["fcharribo"] = $master->getCaFchllegada();
            $data["observaciones"] = utf8_encode($master->getCaObservaciones());

            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        } catch (Exception $e) {
            //$conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
        //$this->setLayout("none");        
    }

    public function executeConfirmaciones($request) {

        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $master = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($master);

        try {
            $confirmaciones = Doctrine::getTable("Confirmaciones")
                    ->createQuery("e")
                    ->select("e.ca_idemail, e.ca_subject, e.ca_fchenvio")
                    ->where("e.ca_idmaster = ?", $idmaster)
                    ->addWhere("e.ca_tipo = ? OR e.ca_tipo = ? OR e.ca_tipo = ? OR e.ca_tipo = ?", array('Not.Llegada', 'Not.Desconsolidación', 'Not.Planilla', 'Not.DIAN 1207'))
                    ->addOrderBy("e.ca_fchenvio DESC")
                    ->execute();

            if ($confirmaciones->count() > 0) {
                foreach ($confirmaciones as $c) {
                    $rowconf[] = array("idemail" => $c->getCaIdemail(), "subject" => utf8_encode($c->getCaSubject()), "fchenvio" => $c->getCaFchenvio());
                }
                $data["confirmaciones"] = $rowconf;
            }

            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        } catch (Exception $e) {            
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeTickets($request) {

        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $master = Doctrine::getTable("InoMaster")->find($idmaster);
        $this->forward404Unless($master);

        try {
            $q = Doctrine::getTable("HdeskTicket")
                    ->createQuery("t")
                    ->select(".ca_idticket, t.ca_title, MAX(e.ca_idemail) as idemail")
                    ->leftJoin("t.HdeskAuditDocuments ad")
                    ->leftJoin("t.Email e")
                    ->where("ad.ca_numero_doc like ?", '%' . $master->getCaReferencia() . '%')
                    ->addWhere("e.ca_tipo in ('Notificación Rta','Notificación Tareas')")
                    ->groupBy("t.ca_idticket, t.ca_title")
                    ->addOrderBy("t.ca_idticket DESC");                    
            
            $debug = $q->getSqlQuery();
            $tickets = $q->execute();

            if ($tickets->count() > 0) {
                foreach ($tickets as $t) {
                    $rowtk = array();
                    $rowtk[] = array("idticket" => $t->getCaIdticket(), "idemail" => $t->idemail, "title" => utf8_encode($t->getCaTitle()));
                }
                $data["tickets"] = $rowtk;
            }

            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug"=> utf8_encode($debug));
        } catch (Exception $e) {            
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeHtmlHouse($request) {

        $idhouse = $request->getParameter("idhouse");
        $this->house = Doctrine::getTable("InoHouse")->find($idhouse);
        $this->setLayout("none");
    }

    public function executeDatosArchivos($request) {

        $idmaster = $request->getParameter("idmaster");
        $idhouse = $request->getParameter("idhouse");

        if ($idmaster) {
            $master = Doctrine::getTable("InoMaster")->find($idmaster);
            $house = $idhouse ? Doctrine::getTable("InoHouse")->find($idhouse) : null;

            $data = array();
            $data["ref1"] = $master->getCaReferencia();
            $data["ref2"] = $house ? $house->getCaDoctransporte() : null;
            $archivos = ArchivosTable::getArchivosActivos($data);

            foreach ($archivos as $archivo) {
                $datosFile = json_decode($archivo->getCaDatos());
                
                $row = array();
                $row["ref1"] = $master->getCaReferencia();
                $row["ref2"] = $house ? $house->getCaDoctransporte() : null;
                $row["idarchivo"] = $archivo->getCaIdarchivo();
                $row["iddocumental"] = $archivo->getCaIddocumental();
                $row["documento"] = utf8_encode($archivo->getTipoDocumental()->getCaDocumento());
                $row["nombre"] = utf8_encode($archivo->getCaNombre());
                $row["mime"] = utf8_encode($archivo->getCaMime());
                $row["path"] = utf8_encode($archivo->getCaPath());
                $row["fchcreado"] = $archivo->getCaFchcreado();
                $row["usucreado"] = $archivo->getCaUsucreado();
                $row["idcomprobante"] = $datosFile->idcomprobante?$datosFile->idcomprobante:null;
                $datos[] = $row;
            }

            $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "narchivos" => count($archivos));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "No existe Idmaster");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosConcliente($request) {

        $idcliente = $request->getParameter("idcliente");
        $idreporte = $request->getParameter("idreporte");
        $cReporte = array();
        
        if($idreporte)
        {
            $reporte = Doctrine::getTable("Reporte")->find($idreporte);
            $idcliente=$idcliente?$idcliente:$reporte->getCliente()->getCaIdcliente();
        }

        if ($idcliente) {
            
            $cliente = Doctrine::getTable("Cliente")->find($idcliente);
            if($idreporte){
                $reporte = Doctrine::getTable("Reporte")->find($idreporte);
                if($reporte->getCaConfirmarClie() != null && $reporte->getCaConfirmarClie() != "" && $reporte->getCaConfirmarClie() != '')
                    $cReporte = explode(",", $reporte->getCaConfirmarClie());
            }

            $cfijos = Doctrine::getTable("Contacto")
                    ->createQuery("c")
                    ->addWhere("c.ca_idcliente = ?", $cliente->getCaIdcliente())
                    ->addWhere("ca_fijo = ?", true)
                    ->addWhere("ca_cargo != ?", 'Extrabajador')
                    ->execute();
            
            if($reporte->getCaConfirmarClie() != null && $reporte->getCaConfirmarClie() != "" && $reporte->getCaConfirmarClie() != '')
                $cReporte = explode(",", $reporte->getCaConfirmarClie());
            $cCliente = explode(",", $cliente->getCaConfirmar());

            $cOtros = array_unique(array_merge($cReporte, $cCliente));
            
            foreach ($cfijos as $fijos) {
                $row = array();
                //$row["idcontacto"] = $fijos->getCaIdcontacto();
                $row["email"] = $fijos->getCaEmail();
                $row["cargo"] = utf8_encode($fijos->getCaCargo());
                $row["tipo"] = "Contactos Fijos";
                $row["sel"] = empty($cReporte)?true:($fijos->getCaEmail() ? (in_array($fijos->getCaEmail(), $cReporte) ? ($fijos->getCaEmail() != "" ? true : false) : false) : false);
                $datos[] = $row;
            }

            foreach ($cOtros as $c) {
                $row = array();
                $email = $c;
                
                $contacto = Doctrine::getTable("Contacto")->findByDql("ca_email = ? AND ca_idcliente = ?", array($email, $idcliente))->getFirst();                        
                $cargo = $contacto?$contacto->getCaCargo():null;

                $row["email"] = $c;
                $row["cargo"] = utf8_encode($cargo);
                $row["tipo"] = "Otros Contactos";
                $row["sel"] = $email ? (in_array($email, $cReporte) ? ($email != "" ? true : false) : false) : false;
                $datos[] = $row;
            }
            $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "narchivos" => count($cfijos));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "No existe Idcliente");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosFormPrincipal($request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $master = Doctrine::getTable("InoMaster")->find($idmaster);
        $masterSea = $master->getInoMasterSea();
        $datosMaster = $master->getDatosMasterSea();

        $muelle = ParametroTable::retrieveByCaso("CU268", null, null, $masterSea->getCaIdmuelle())->getFirst();

        $data = array();

        $data["fchconfirmacion"] = $masterSea->getCaFchconfirmacion();
        $data["horaconfirmacion"] = $masterSea->getCaHoraconfirmacion();
        $data["registroadu"] = utf8_encode($datosMaster["registroadu"]);
        $data["fchregistroadu"] = $datosMaster["fchregistroadu"];
        $data["bandera"] = utf8_encode($datosMaster["bandera"]);
        $data["mnllegada"] = utf8_encode($datosMaster["mnllegada"]);
        $data["idmuelle"] = $masterSea->getCaIdmuelle();
        $data["muelle"] = $data["idmuelle"] ? utf8_encode($muelle->getCaValor()) : null;
        $data["fchvaciado"] = $masterSea->getCaFchvaciado();
        $data["horavaciado"] = $masterSea->getCaHoravaciado();
        $data["fchsyga"] =   Utils::parseDate($masterSea->getCaFchmuisca());
        $data["destino"] = $master->getCaDestino();

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executePruebaExt5() {
        
    }

    public function executeCrearStatus($request) {

        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $conn = Doctrine::getTable("RepStatus")->getConnection();
        $conn->beginTransaction();

        try {
            $master = Doctrine::getTable("InoMaster")->find($idmaster);
            $masterSea = Doctrine::getTable("InoMasterSea")->find($idmaster);

            if (!$masterSea) {
                $masterSea = new InoMasterSea();
                $masterSea->setCaIdmaster($idmaster);
                $masterSea->save();
            }

            $datosMaster = $master->getDatosMasterSea();
            $user = sfContext::getInstance()->getUser();

            $referencia = $master->getCaReferencia();
            $tipo_msg = $request->getParameter("modulo");
            $modo = explode("-", $tipo_msg)[0];
            $data = array();
            $data["iddocumental"] = 3;

            switch ($tipo_msg) {
                case "pto-llegada":
                case "llegada":
                    $fchconfirmacion = Utils::parseDate($request->getParameter("fchconfirmacion"));
                    $masterSea->setCaFchconfirmacion($fchconfirmacion);
                    if ($master->getCaFchllegada() != $fchconfirmacion) {
                        $observaciones = $master->getCaObservaciones() . chr(13) . date("m/d/Y") . " Se actualizó la Fecha de Arribo de " . $master->getCaFchllegada() . " por $fchconfirmacion según confirmación de llegada.";
                        $master->setCaFchllegada($fchconfirmacion);
                        $master->setCaObservaciones($observaciones);
                        $equipos = $master->getInoEquipo();
                        foreach($equipos as $equipo){
                            $equipo->calcularLimDevolucion($fchconfirmacion, $conn);
                        }
                    }

                    $masterSea->setCaHoraconfirmacion($request->getParameter("horaconfirmacion"));
                    $masterSea->setCaFchconfirmado(date("Y-m-d H:i:s"));
                    $masterSea->setCaUsuconfirmado($this->getUser()->getUserId());
                    $masterSea->setCaIdmuelle($request->getParameter("idmuelle"));

                    $datosMaster["registroadu"] = utf8_encode($request->getParameter("registroadu"));
                    if ($request->getParameter("fchregistroadu")) {
                        $datosMaster["fchregistroadu"] = Utils::parseDate($request->getParameter("fchregistroadu"));
                    }
                    $datosMaster["bandera"] = utf8_encode($request->getParameter("bandera"));
                    $datosMaster["mensaje"] = utf8_encode($request->getParameter("mensaje"));
                    $datosMaster["mnllegada"] = utf8_encode($request->getParameter("mnllegada"));

                    $masterSea->setCaDatos(json_encode($datosMaster));
                    $master->save($conn);
                    $masterSea->save($conn);

                    if ($master->getCaModalidad() == "FCL" && $modo === "pto") {
                        $tarea1207 = $master->getTarea1207($datosMaster);
                    }
                    $tipo = "Llegada";
                    $title = "Confirmación de Llegada";
                    $intro = $request->getParameter("mensaje");
                    $body = ""; //$request->getParameter("email_body");                                            

                    break;
                case "pto-desconsolidacion":

                    if ($request->getParameter("fchvaciado") || $request->getParameter("horavaciado")) {
                        $masterSea->setCaFchvaciado(Utils::parseDate($request->getParameter("fchvaciado")));
                        $masterSea->setCaHoravaciado($request->getParameter("horavaciado"));
                        $masterSea->save($conn);
                    }

                    if ($master->getCaModalidad() == "LCL") {
                        $tarea1207 = $master->getTarea1207($datosMaster);
                    }

                    $tipo = "Desconsolidación";
                    $title = "Información de Desconsolidación";
                    $intro = $request->getParameter("mensaje");
                    $body = "";
                    $otm = true;
                    break;
                case "pto-planilla":
                    $datosPlanilla = json_decode(utf8_encode($request->getParameter("datosPlanilla")), 1);
                    $email_body_planilla = "Se reportan los siguientes números de planilla así:<br>";
                    $email_body_planilla.="<table style='border: 1px solid black; border-collapse:collapse;'><tr><th style='border: 1px solid black;'>Cliente</th><th style='border: 1px solid black;'>HBL</th><th style='border: 1px solid black;'>Planilla Envio</th></tr>";

                    foreach ($datosPlanilla as $key => $d) {
                        $idhouse = $d["idhouse"];
                        $planilla = $d["planilla"];
                        $houseSea = Doctrine::getTable("InoHouseSea")->find($idhouse);
                        $continuacion = $houseSea->getCaContinuacion();

                        if (isset($continuacion) && $continuacion !== "N/A") {
                            if($continuacion !== "")
                                continue;
                        }

                        $datosHouse = json_decode(utf8_encode($houseSea->getCaDatos()));
                        $hbls = $houseSea->getInoHouse()->getCaDoctransporte();
                        $cliente = $houseSea->getInoHouse()->getCliente();

                        $datosHouse->planilla = $planilla;
                        $houseSea->setCaDatos(json_encode($datosHouse));
                        $houseSea->save($conn);
                        $email_body_planilla.= "<tr><td style='border: 1px solid black;'>" . $cliente->getCaCompania() . "</td><td style='border: 1px solid black;'>" . $hbls . "</td><td style='border: 1px solid black;'>Planilla # " . $planilla . "</td></tr>";
                    }

                    $tipo = "Planilla";
                    $title = "Información de Planilla";
                    $intro = $request->getParameter("mensaje");

                    $email_body_planilla.= "</table>";
                    $body = $email_body_planilla;
                    break;
                case "pto-dian":
                    $tipo = "DIAN 1207";
                    $title = "Formulario DIAN 1207";
                    $intro = $request->getParameter("mensaje");
                    if ($request->getParameter("fchsyga")) {
                        $masterSea->setCaFchfinmuisca(Utils::parseDate($request->getParameter("fchsyga")));
                    }
                    $body = "";
                    $otm = true;
                    $destOtm = false; // Solo destinatarios de otm // Ticket #86454 May/25/2020

                    $data["iddocumental"] = 11;
                    
                    //Finalización de Tarea Envio Formulario 1207
                    $idtarea = $datosMaster["idtarea"];
                    if ($idtarea) {
                        $tarea = Doctrine::getTable("NotTarea")->find($idtarea);
                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                        $tarea->setCaUsuterminada($this->getUser()->getUserId());
                        $tarea->save($conn);
                    }
                    break;
            }

            /*
             * Attachments Principal. Válido para toda la referencia.
             */
            $i = 0;

            if (isset($_FILES["file"]) and $_FILES["file"]["name"]) {
                $attachmentPpal = $_FILES['file'];
            } else {
                $attachmentPpal = null;
            }

            if ($attachmentPpal) {

                $data["ref1"] = $referencia;

                $tipDoc = Doctrine::getTable("TipoDocumental")->find($data['iddocumental']);
                $folder = $tipDoc->getCaDirectorio();
                //$attachment['name'] = $attachment['filename'];
                $directorio = date("Y") . DIRECTORY_SEPARATOR . $folder . $data["ref1"] . "/";
                $fileName = preg_replace('/\s\s+/', ' ', $attachmentPpal['name']);
                $fileName = urlencode($fileName);
                $fileName = str_replace("+", " ", $fileName);
                $success = ArchivosTable::subirDocumento($_FILES['file'], $data);

                if ($success["estado"] != true) {
                    $this->responseArray = array("success" => false, "No se pudo mover el archivo!");
                    echo "
                        <script>
                            alert('No se pudo mover el archivo');
                        </script>";
                    exit;
                }
                $attachPpal[] = $directorio . $fileName;
            }

            /*
             * Notificación Puerto
             */

            if ($modo == "pto") {

                $sql = "
                    SELECT distinct(ca_email) ca_email 
                    FROM control.tb_usuarios WHERE ca_login in (
                        SELECT DISTINCT ca_usucreado as ca_usuario FROM ino.tb_house where ca_idmaster = $idmaster
                        UNION SELECT DISTINCT ca_usuactualizado as ca_usuario FROM ino.tb_house WHERE ca_idmaster = $idmaster
                        UNION SELECT DISTINCT ca_usumuisca as ca_usuario FROM ino.tb_master_sea WHERE ca_idmaster = $idmaster 
                        UNION SELECT DISTINCT ms.ca_datosmuisca->>'usuenvio' as usuenvio FROM ino.tb_master_sea ms JOIN ino.tb_master m ON m.ca_idmaster = ms.ca_idmaster WHERE ms.ca_idmaster = $idmaster AND ms.ca_datosmuisca->>'usuenvio' IS NOT NULL
                        UNION SELECT DISTINCT hs.ca_datosmuisca->>'usucreado' as usumuisca FROM ino.tb_house_sea hs JOIN ino.tb_house h ON h.ca_idhouse = hs.ca_idhouse WHERE h.ca_idmaster = $idmaster AND hs.ca_datosmuisca->>'usucreado' IS NOT NULL
                        UNION SELECT DISTINCT hs.ca_datosmuisca->>'usuactualizado' as usuactualizado FROM ino.tb_house_sea hs JOIN ino.tb_house h ON h.ca_idhouse = hs.ca_idhouse WHERE h.ca_idmaster = $idmaster AND hs.ca_datosmuisca->>'usuactualizado' IS NOT NULL
                        UNION SELECT DISTINCT ca_usucreado as ca_usuario FROM ino.tb_master WHERE ca_idmaster = $idmaster
                        UNION (
                            SELECT DISTINCT ca_idusuario as ca_usuario FROM control.tb_usu_parametros up INNER JOIN control.tb_usuarios u ON u.ca_login = up.ca_idusuario WHERE ca_idcliente in (
                            SELECT ca_idcliente FROM ino.tb_house WHERE ca_idmaster = $idmaster) AND ca_idsucursal in (
                                SELECT ca_idsucursal FROM control.tb_usuarios WHERE ca_login in (
                                    SELECT ca_vendedor FROM vi_clientes_reduc WHERE ca_idcliente in (
                                        SELECT ca_idcliente FROM ino.tb_house WHERE ca_idmaster = $idmaster)))))";

                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                $this->resul = $st->fetchAll();

                $destinatarios = array();
                foreach ($this->resul as $r) {
                    $destinatarios[] = $r["ca_email"];
                }

                /*Si la comunicación de Puerto debe ser copiada a Otm*/
                if ($otm) {
                    /*Solo cuando la referencia tiene reportes Otm*/
                    if($master->existeReporteOtm()){
                        /*Si la comunicación es solo para Otm. Ej 1207*/
                        if($destOtm)
                            $destinatarios = array();

                        $sql2 = "
                            SELECT DISTINCT u.ca_email
                            FROM control.tb_usuarios u
                            JOIN control.tb_sucursales sc on sc.ca_idsucursal=u.ca_idsucursal
                            JOIN control.tb_empresas e on sc.ca_idempresa=e.ca_idempresa
                            JOIN control.tb_usuarios_perfil up on up.ca_login = u.ca_login
                                WHERE up.ca_perfil = 'cordinador-de-otm' and u.ca_activo = true
                                    and sc.ca_nombre in (
                                    select distinct(s.ca_nombre)
                                    from ino.tb_house  h
                                        inner join tb_reportes r on r.ca_idreporte=h.ca_idreporte                                    
                                        inner join ino.tb_house_sea hs ON hs.ca_idhouse = h.ca_idhouse
                                        INNER JOIN ino.tb_master m ON m.ca_idmaster = h.ca_idmaster
                                        inner join control.tb_usuarios u on r.ca_usucreado=u.ca_login
                                        inner join control.tb_sucursales s on s.ca_idsucursal=u.ca_idsucursal
                                    where m.ca_idmaster = $idmaster AND hs.ca_continuacion IS NOT NULL AND hs.ca_continuacion != 'N/A')";

                        $con = Doctrine_Manager::getInstance()->connection();
                        $st = $con->execute($sql2);
                        $coords_otm = $st->fetchAll();
                    
                        /*Ticket # 89149 SOLICITUD REVISIÓN NOTIFICACIONES COLTRANS. Si no existen coordinadores en la ciudad de destino del BL se copia a los Coordinadores Otm de Bogotá*/
                        if(count($coords_otm)==0){
                            $sql2 = "
                                SELECT DISTINCT u.ca_email
                                FROM control.tb_usuarios u
                                    JOIN control.tb_sucursales sc on sc.ca_idsucursal=u.ca_idsucursal
                                    JOIN control.tb_empresas e on sc.ca_idempresa=e.ca_idempresa
                                    JOIN control.tb_usuarios_perfil up on up.ca_login = u.ca_login
                                WHERE up.ca_perfil = 'cordinador-de-otm' and u.ca_activo = true and sc.ca_nombre = 'Bogotá D.C.'";
                    
                    $con = Doctrine_Manager::getInstance()->connection();
                    $st = $con->execute($sql2);
                            $coords_otm = $st->fetchAll();
                        }

                        foreach ($coords_otm as $r) {
                        $destinatarios[] = $r["ca_email"];
                    }
                        
                        /*Colaboradores en el Puerto*/
                        $q = Doctrine::getTable("Usuario")
                                ->createQuery("u")
                                ->select("s.ca_nombre, u.ca_email")
                                ->innerJoin("u.Sucursal s")
                                ->where("s.ca_idempresa = ? and ca_email IS NOT NULL and u.ca_activo = TRUE", Constantes::IDCOLOTM)
                                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                        
                        $usupuerto = $q->execute();
                        
                        foreach($usupuerto as $key => $data){                            
                            $usuotm["sucursal"][] = $data["s_ca_nombre"];
                            $usuotm[$data["s_ca_nombre"]][] = $data["u_ca_email"];                                                        
                }

                        /*Verifica si se tienen colaboradores en el Puerto, si no reporta a Bogotá*/
                        $origenOtm =$master->getDestino()->getCaCiudad();
                        if(!in_array($origenOtm, $usuotm["sucursal"])){
                            $origenOtm = "Bogotá, D.C.";
                            if($origenOtm == "Santa Marta" || $oriOtm == "Barranquilla"){
                                $origenOtm = "Cartagena";
                            }
                        }                           

                        foreach ($usuotm[$origenOtm] as $r => $email) {
                            if(!in_array($email, $destinatarios))
                                $destinatarios[] = $email;
                        }
                    }
                }

                $email = new Email();
                $email->setCaUsuenvio($user->getUserId());
                $email->setCaTipo("Not." . $tipo);
                $email->setCaIdcaso($idmaster);
                $email->setCaFrom($user->getEmail());
                $email->setCaFromname($user->getNombre());
                $email->setCaReplyto($user->getEmail());

                foreach ($destinatarios as $recip) {
                    $recip = str_replace(" ", "", $recip);
                    if ($recip) {
                        $email->addTo($recip);
                    }
                }

                $email->addCC($user->getEmail());

                $asunto = "Notificación de " . $tipo . " desde el Puerto de " . $master->getDestino()->getCaCiudad() . " Ref.: " . $master->getCaReferencia();
                $email->setCaSubject(substr($asunto, 0, 250));

                if ($attachPpal) {
                    $email->setCaAttachment(implode("|", $attachPpal));
                }

                sfContext::getInstance()->getRequest()->setParameter("idmaster", $master->getCaIdmaster());
                sfContext::getInstance()->getRequest()->setParameter("tipo", $tipo_msg);
                sfContext::getInstance()->getRequest()->setParameter("titulo", $title);
                sfContext::getInstance()->getRequest()->setParameter("intro_body", $intro);
                sfContext::getInstance()->getRequest()->setParameter("email_body", $body);
                $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('status', 'emailConfirmacion'));
                $email->save($conn);

                $confirmaciones = new Confirmaciones();
                $confirmaciones->setCaIdemail($email->getCaIdemail());
                $confirmaciones->setCaIdmaster($email->getCaIdcaso());
                $confirmaciones->setCaTipo($email->getCaTipo());
                $confirmaciones->setCaSubject($email->getCaSubject());
                $confirmaciones->setCaFchenvio(date('Y-m-d H:i:s'));
                $confirmaciones->save($conn);
                
                //Creación de tarea Envío Formulario 1207
                if ($tarea1207) {
                    $tarea = new NotTarea();
                    $tarea->setCaUrl("/status/idmaster/$idmaster/modulo/pto-dian");
                    $tarea->setCaIdlistatarea(13);
                    $tarea->setCaFchcreado(date("Y-m-d H:i:s"));
                    $tarea->setCaFchvisible(date("Y-m-d H:i:s"));
                    $tarea->setCaFchvencimiento(date("Y-m-d H:i:s"));
                    $tarea->setCaUsucreado($this->getUser()->getUserId());
                    $tarea->setCaTitulo("Debe enviar el Formulario DIAN 1207 - Referencia: " . $referencia);
                    $tarea->setCaTexto("Debe enviar el Formulario DIAN 1207 - Referencia: " . $referencia);
                    $tarea->save($conn);

                    $datosMaster["idtarea"] = $tarea->getCaIdtarea();
                    $datosMaster["mensaje"] = utf8_encode($datosMaster["mensaje"]);

                    $masterSea->setCaDatos(json_encode($datosMaster));
                    $masterSea->save($conn);

                    $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
                    $usuariosTarea = UsuarioTable::getUsuariosxPerfil('finalizacion-de-descarge-dian-colsys', $usuario->getCaIdsucursal(), null);

                    foreach ($usuariosTarea as $usuarioTarea) {
                        $loginAsignaciones[] = $usuarioTarea->getCaLogin();
                    }
                    $tarea->setAsignaciones($loginAsignaciones);
                }

                $conn->commit();
                $this->responseArray = array("success" => true, "mensaje" => "Se ha creado el status!", "modulo" => $tipo_msg);
            } else {
                $idhouses = json_decode($request->getParameter("idhouses"), 1);
                
                $archivos = utf8_encode($request->getParameter("datosArchivos"));
                $datosForm = json_decode(utf8_encode($request->getParameter("datosForm")), 1);
                $dataFiles = json_decode($archivos, 1);
                $dataContactos = json_decode($request->getParameter("datosContactos"), 1);
                
                if ($datosForm) {
                    foreach ($datosForm as $key => $data) {
                        $idhouse = $data["idhouse"];

                        $form[$idhouse]["mensaje_cliente"] = $data["mensaje"];
                        $form[$idhouse]["fchrecibido"] = $data["fchstatus"] ? Utils::parseDate($data["fchstatus"]) . " " . date("H:i:s", strtotime($data["horastatus"])) : null;
                        $form[$idhouse]["observaciones_idg"] = $data["juststatus"]?$data["juststatus"]:null;
                        if($tipo_msg == "otm"){
                            $form[$idhouse]["etapaOtm"] = $data["etapaOtm"];
                            $form[$idhouse]["idbodega"] = $data["idbodega"];
                            $form[$idhouse]["fchllegadaOtm"] = Utils::parseDate($data["fchllegadaOtm"]);
                            $form[$idhouse]["fchcargueOtm"] = $data["fchcargueOtm"];
                            $form[$idhouse]["fchsalidaOtm"] = $data["fchsalidaOtm"];
                            $form[$idhouse]["fchcierreOtm"] = $data["fchcierreOtm"];
                            $form[$idhouse]["fchplanillaOtm"] = $data["fchplanillaOtm"];
                        }
                    }
                }

                if ($dataFiles) {
                    foreach ($dataFiles as $key => $data) {
                        $idhouse = $data["idhouse"];
                        $idarchivo = $data["idarchivo"];

                        $file = Doctrine::getTable("Archivos")->find($idarchivo);
                        $attachment[$idhouse][] = str_replace(sfConfig::get('app_digitalFile_root'), "", $file->getCaPath());
                    }
                }

                if ($dataContactos) {
                    foreach ($dataContactos as $key => $data) {
                        $idhouse = $data["idhouse"];
                        $contactos[$idhouse][] = $data["email"];
                    }
                }
            
                $sql = "SELECT h.ca_idhouse as ca_idhouse, h.ca_idreporte as ca_idreporte, h.ca_idbodega, sqa.ca_doctransporte as ca_doctransporte, hs.ca_datos as ca_datos, sqa.ca_piezas as ca_piezas, sqa.ca_peso as ca_peso, sqa.ca_volumen as ca_volumen, sqa.ca_idnave as ca_idnave, sqa.ca_fchsalida as ca_fchsalida, sqa.ca_fchllegada as ca_fchllegada, sqa.ca_fchcontinuacion as ca_fchcontinuacion
                        FROM ino.tb_house h
                            LEFT JOIN ino.tb_house_sea hs ON hs.ca_idhouse = h.ca_idhouse 
                            LEFT JOIN tb_reportes r ON r.ca_idreporte = h.ca_idreporte
                            RIGHT JOIN ( SELECT sf.ca_consecutivo, ca_fchsalida, ca_fchllegada, ca_piezas, ca_peso, ca_volumen, ca_doctransporte, ca_idnave, ca_fchcontinuacion
                                   FROM tb_repstatus sta
                                     RIGHT JOIN ( SELECT p.ca_consecutivo,
                                            max(sta_1.ca_idstatus) AS ca_idstatus
                                           FROM tb_repstatus sta_1
                                             JOIN tb_reportes p ON p.ca_idreporte = sta_1.ca_idreporte                  
                                          GROUP BY p.ca_consecutivo) sf ON sta.ca_idstatus = sf.ca_idstatus) sqa ON r.ca_consecutivo::text = sqa.ca_consecutivo::text
                        WHERE  h.ca_idhouse in (". implode(',', $idhouses).")";                  
                
                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                $houses = $st->fetchAll();

                foreach($houses as $house){
                    list($useg, $seg) = explode(" ", microtime(true));                    
                    
                    $idhouse = $house["ca_idhouse"];//->getCaIdhouse();
                    $houseSea = Doctrine::getTable("InoHouseSea")->find($house["ca_idhouse"]);
                    
                    $datosHouse = json_decode(utf8_encode($house["ca_datos"]), 1);

                    $options = array();
                    $mensaje = "";

                    $hbls = $house["ca_doctransporte"];
                    
                    $reporte = Doctrine::getTable("Reporte")->find($house["ca_idreporte"]);
                    
                    //No reporta las planillas a reportes con Otm
                    if ($tipo_msg == "planilla" && trim($house["ca_continuacion"] != NULL)) {
                        continue;
                    }

                    $status = new RepStatus();
                    $status->setCaIdreporte($reporte->getCaIdreporte());
                    $status->setCaFchstatus(date("Y-m-d H:i:s"));
                    $status->setCaFchenvio(date("Y-m-d H:i:s"));
                    $status->setCaUsuenvio($this->getUser()->getUserId());
                    $status->setCaTipo("2"); //tipo 2 para maritimo

                    if ($form[$idhouse]["observaciones_idg"]) {
                        $status->setCaObservacionesIdg($form[$idhouse]["observaciones_idg"]);
                    }

                    if ($form[$idhouse]["fchrecibido"]) {
                        $horaRecibo = $form[$idhouse]["horarecibido"];
                        $status->setCaFchrecibo($form[$idhouse]["fchrecibido"] . " " . $horaRecibo);
                    }
                    $ultimostatus = $reporte->getUltimoStatus();
                    
                    if ($ultimostatus) {                        
                        $status->setCaPiezas($ultimostatus->getCaPiezas());
                        $status->setCaPeso($ultimostatus->getCaPeso());
                        $status->setCaVolumen($ultimostatus->getCaVolumen());
                        $status->setCaIdnave($ultimostatus->getCaIdnave());
                        $status->setCaFchsalida($ultimostatus->getCaFchsalida());
                        $status->setCaFchllegada($ultimostatus->getCaFchllegada());
                        $status->setCaFchcontinuacion($ultimostatus->getCaFchcontinuacion());
                        $status->setCaDoctransporte($ultimostatus->getCaDoctransporte());
                    }
                    
                    
                        $status->setCaPiezas($house["ca_piezas"]);
                        $status->setCaPeso($house["ca_peso"]);
                        $status->setCaVolumen($house["ca_volumen"]);
                        $status->setCaIdnave($house["ca_idnave"]);
                        $status->setCaFchsalida($house["ca_fchsalida"]);
                        $status->setCaFchllegada($house["ca_fchllegada"]);
                        $status->setCaFchcontinuacion($house["ca_fchcontinuacion"]);
                        $status->setCaDoctransporte($house["ca_doctransporte"]);
                    
                    /* Divide el texto en salto de página, o por dos puntos cuándo es Factura de Fletes, Certificación o Recargos Locales */
                    if ($tipo_msg == "ffletes") {
                        $mensajeArray = preg_split("/[:]+/", $request->getParameter("mensaje"));
                    } else {
                        $mensajeArray = preg_split("/[\n]+/", $request->getParameter("mensaje"));
                    }

                    $mensajeIntro = $tipo_msg == "llegada" ? $request->getParameter("mensaje") : $mensajeArray[0];
                    $status->setCaIntroduccion($mensajeIntro);


                    $datosHouse["mensaje"] = $form[$idhouse]["mensaje_cliente"];
                    $houseSea->setCaDatos(json_encode($datosHouse));
                    $houseSea->save($conn);

                    for ($i=1; $i < count($mensajeArray); $i++) {
                        if (trim($mensajeArray[$i]) !== "") {
                            $mensaje.=$mensajeArray[$i] . "\n";
                        }
                    }

                    $mensajeStatus = $tipo_msg == "llegada" ? $form[$idhouse]["mensaje_cliente"] : $mensaje . "\n" . $form[$idhouse]["mensaje_cliente"];
                    $mensaje = $form[$idhouse]["mensaje_cliente"];
                    switch ($tipo_msg) {
                        case "llegada":
                            if ($houseSea->getCaImprimirorigen() && $datosHouse["idagente"] !== '830003960' && $house["ca_idbodega"] !== 1269) {
                                $mensajeStatus.= "<br />Agradecemos informar en el evento que su Compa?ía modifique el Agente de Aduana que realice la intermediación, de lo contrario seguiremos entregando los documentos originales a quienes Uds previamente han autorizado";
                            }
                            $status->setCaIdetapa("IMCPD");
                            $status->setCaFchllegada($master->getInoMasterSea()->getCaFchconfirmacion());
                            break;
                        case "desconsolidacion":
                            $status->setCaIdetapa("IMDES");
                            $confirmaciones = Doctrine::getTable("Confirmaciones")->findByDql("ca_idmaster = ? AND ca_tipo = ?", array($master->getCaIdmaster(), 'Not.Desconsolidación'))->getLast();
                            if($confirmaciones){                                
                                $status->setCaFchrecibo($confirmaciones->getCaFchenvio());
                            }
                            break;
                        case "contenedores":
                            $options["subject"] = "División de Contenedores Id.: " . $reporte->getCaConsecutivo() . " ";
                            $status->setCaIdetapa("IMCNT");
                            break;
                        case "planilla":
                            $mensajeStatus.= "<br />Planilla No: <b>" . $datosHouse["planilla"] . "</b>";
                            $status->setCaIdetapa("IMPLA");
                            $confirmaciones = Doctrine::getTable("Confirmaciones")->findByDql("ca_idmaster = ? AND ca_tipo = ?", array($master->getCaIdmaster(), 'Not.Planilla'))->getLast();
                            if($confirmaciones){                                
                                $status->setCaFchrecibo($confirmaciones->getCaFchenvio());
                            }
                            $options["subject"] = "Planilla de Envío Id.: " . $reporte->getCaConsecutivo() . " ";
                            break;
                        case "ffletes":
                            switch ($request->getParameter("combofactura")) {
                                case "ffletes":
                                    $options["subject"] = "Factura de Fletes Id.: " . $reporte->getCaConsecutivo() . " ";
                                    $status->setProperty("idetapa2", "IMFFL");
                                    break;
                                case "cfletes":
                                    $options["subject"] = "Certificación de Fletes Id.: " . $reporte->getCaConsecutivo() . " ";
                                    break;
                                case "rlocales":
                                    $options["subject"] = "Recargos Locales Id.: " . $reporte->getCaConsecutivo() . " ";
                                    $status->setProperty("idetapa2", "IMFFL");
                                    break;
                            }
                            $status->setCaIdetapa("88888");
                            break;
                        case "fotm":
                            $options["subject"] = "Factura de OTM Id.: " . $reporte->getCaConsecutivo() . " ";
                            $status->setCaIdetapa("88888");
                            break;
                        case "fcontenedores":
                            $options["subject"] = "Factura de Contenedores Id.: " . $reporte->getCaConsecutivo() . " ";
                            $status->setCaIdetapa("88888");
                            break;
                        case "otm":                            
                            $etapa = $form[$idhouse]["etapaOtm"];                            
                            $repotm = $reporte->getRepUltVersion()->getRepOtm();
                            if ($etapa == "IMCOL") {
                                $status->setCaFchcontinuacion($form[$idhouse]["fchllegadaOtm"]);                            
                                $idbodega = $form[$idhouse]["idbodega"];
                                $status->setProperty("idbodega", $idbodega);
                            }
                            
                            if ($etapa == "OTDES") {
                                $fchcargue = $form[$idhouse]["fchcargueOtm"];
                                $fchsalida = $form[$idhouse]["fchsalidaOtm"];                                
                                $repotm->setCaFchcargue($fchcargue);
                                $repotm->setCaFchsalida($fchsalida);
                                $repotm->save($conn);                            
                            }
                            
                            if ($etapa == "99999") {
                                $fchplanilla = $form[$idhouse]["fchplanillaOtm"];
                                $fchcierre = $form[$idhouse]["fchcierreOtm"];
                                $status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));                                
                                
                                $repotm->setCaFchcierre($fchcierre);
                                $repotm->save($conn);
                            }

                            $status->setCaIdetapa($etapa);
                            break;
                        default:
                            $status->setCaIdetapa("88888");
                            break;
                    }
                    $options["nuevo"] = true;
                    
                    if (isset($attachPpal)) {
                        $attachment[$idhouse][] = $attachPpal[0];
                    }

                    if ($datosMaster["mnllegada"]) {
                        $status->setCaIdnave($datosMaster["mnllegada"]);
                    } else {
                        $status->setCaIdnave($master->getCaMotonave());
                    }

                    if ($request->getParameter("fcharribo")) {
                        $status->setCaFchllegada($request->getParameter("fcharribo"));
                        $master->setCaFchllegada($request->getParameter("fcharribo"));
                        $master->save($conn);
                    }

                    $destinatarios = $contactos[$idhouse];
                    $attachments = $attachment[$idhouse] ? $attachment[$idhouse] : [];
                    
                    $status->setStatus($mensajeStatus);
                    
                    $status->save($conn);
                    list($useg, $seg) = explode(" ", microtime(true));                                        
                    
                    $status->send($destinatarios, array(), $attachments, $options);
                    list($useg, $seg) = explode(" ", microtime(true));                                        
                }
                $conn->commit();
                $this->responseArray = array("success" => true, "mensaje" => "Las comunicaciones se han enviado correctamente!", "modulo" => $tipo_msg/*, "tiempo"=> $tiempo*/);
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEmailConfirmacion($request) {
        $this->master = Doctrine::getTable("InoMaster")->find($request->getParameter("idmaster"));
        $this->forward404Unless($this->master);

        $this->usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $masterSea = $this->master->getInoMasterSea();

        $this->tipo = $request->getParameter("tipo");
        $this->titulo = $request->getParameter("titulo");
        $this->intro_body = $request->getParameter("intro_body");
        $this->email_body = $request->getParameter("email_body");
        $this->datos = $this->master->getDatosMasterSea();
        $this->muelle = ParametroTable::retrieveByCaso("CU268", null, null, $masterSea->getCaIdmuelle())->getFirst();
        $this->fchsyga = $masterSea->getCaFchfinmuisca();
        $this->setLayout("email");
    }

    public function executeDatosContenedores(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");
        $equipos = Doctrine::getTable("InoEquipo")
                ->createQuery("e")
                ->addWhere("e.ca_idmaster = ?", $idmaster)
                ->execute();
        $data = array();

        foreach ($equipos as $equipo) {
            $concepto = Doctrine::getTable("Concepto")->find($equipo->getCaIdconcepto());
            $datosEquipo = json_decode(utf8_encode($equipo->getCaDatos()),1);
            $data[] = array(
                "idequipo" => $equipo->getCaIdequipo(),
                "idconcepto" => $equipo->getCaIdconcepto(),
                "concepto" => utf8_encode($concepto->getCaConcepto()),
                "idvehiculo" => $equipo->getCaIdvehiculo(),
                "serial" => $equipo->getCaSerial(),
                "precinto" => $equipo->getCaNumprecinto(),
                "observaciones" => $equipo->getCaObservaciones(),
                "cantidad" => $equipo->getCaCantidad(),
                "comodato" => $datosEquipo["ca_entrega_comodato"],
                "idpatio" => $datosEquipo["ca_idpatio"],
                "inspeccion" => $datosEquipo["ca_inspeccion_fch"],
                "diaslibres" => $datosEquipo["ca_dias_libres"],
                "devolucion" => $datosEquipo["ca_devolucion_fch"]
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "count" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeIdgConfirmacion1($request) {
        
        $idhouses = json_decode($request->getParameter("idhouses"), 1);        
        $fechas = json_decode($request->getParameter("fechas"),1);        
        $horas = json_decode($request->getParameter("horas"), 1);
        $justificaciones = json_decode($request->getParameter("justificaciones"), 1);
        $modo = $request->getParameter("modo");
        
        try{
            foreach($idhouses as $key => $idhouse){
                $house = Doctrine::getTable("InoHouse")->find($idhouse);
                $idg = RepStatus::IDG_STATUS_MARITIMO;
                
                $fecha = $fechas[$key];
                $hora = $horas[$key];
                $justifica = $justificaciones[$key];
                
                switch($modo){
                    case "llegada":
                        $idg = RepStatus::IDG_CONF_LLEGADA;
                        
                        $fecha = $request->getParameter("fechallegada");
                        $hora = $request->getParameter("horallegada");
                        break;
                    case "desconsolidacion":                        
                        $confirmaciones = Doctrine::getTable("Confirmaciones")->findByDql("ca_idmaster = ? AND ca_tipo = ?", array($house->getInoMaster()->getCaIdmaster(), 'Not.Desconsolidación'))->getLast();
                        if($confirmaciones){                                
                            $fecha = Utils::parseDate($confirmaciones->getCaFchenvio(), 'Y-m-d');
                            $hora =  Utils::parseDate($confirmaciones->getCaFchenvio(), "H:i:s");
                        }
                        break;
                    case "planilla":                        
                        $confirmaciones = Doctrine::getTable("Confirmaciones")->findByDql("ca_idmaster = ? AND ca_tipo = ?", array($house->getInoMaster()->getCaIdmaster(), 'Not.Planilla'))->getLast();
                        if($confirmaciones){                                
                            $fecha = Utils::parseDate($confirmaciones->getCaFchenvio(), 'Y-m-d');
                            $hora =  Utils::parseDate($confirmaciones->getCaFchenvio(), "H:i:s");
                        }
                        break;
                }
                        
                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($fecha." ".$hora, "%d-%d-%d %d:%d:%d");
                $inicio = mktime($hor, $min, $seg, $mes, $dia, $ano);
                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s"), "%d-%d-%d %d:%d:%d");
                $final = mktime($hor, $min, $seg, $mes, $dia, $ano);

                $festivos = TimeUtils::getFestivos(date("Y"));
                $diff = TimeUtils::calcDiff($festivos, $inicio, $final); // Retorna la diferencia en segundos entre dos fechas, horas hábiles excluyendo fines de semana y festivos

                $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
                $idgMax = IdgTable::getUnIndicador($idg, date("Y-m-d"), $usuario->getCaIdsucursal());
                $horas = intval($idgMax->getCaLim1());
                $minutos = 60 * ($idgMax->getCaLim1()-intval($idgMax->getCaLim1()));
                $idgMax = ($horas * 60 * 60) + ($minutos * 60);

                if ($diff > $idgMax and strlen($justifica)==1){
                    $row[] = array("cumplio" => "No", "doctransporte" => $house->getCaDoctransporte(), "idhouse"=>$idhouse);
                }else if ($diff > $idgMax and strlen($justifica)>1){
                    $row[] = array("cumplio" => "Justifico", "doctransporte" => $house->getCaDoctransporte(), "idhouse"=>$idhouse);
                    $options = array("idtipo"=>$house->getReporte()->getCaConsecutivo());
                }else{
                    $row[] = array("cumplio" => "Si", "doctransporte" => $house->getCaDoctransporte(), "idhouse"=>$idhouse);                    
                }                
            }

            $this->responseArray = array("success" => true, "data"=>$row);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeIdgConfirmacion($request) {
        
        $idhouses = json_decode($request->getParameter("idhouses"), 1);        
        $fechas = json_decode($request->getParameter("fechas"),1);        
        $horas = json_decode($request->getParameter("horas"), 1);
        $justificaciones = json_decode($request->getParameter("justificaciones"), 1);
        $exclusiones = json_decode($request->getParameter("exclusiones"), 1);
        $modo = $request->getParameter("modo");
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        
        try{
            foreach($idhouses as $key => $idhouse){
                $house = Doctrine::getTable("InoHouse")->find($idhouse);
                
                $fecha = $fechas[$key];
                $hora = $horas[$key];
                $idetapa = '88888';
                $justifica = $justificaciones[$key];
                $idexclusion = $exclusiones[$key];                
                
                $options["idcaso"] = $house->getReporte()->getCaConsecutivo();
                $options["idhouse"] = $house->getCaIdhouse();
                $options["doctransporte"] = $house->getCaDoctransporte();
                $options["observaciones"] = $justifica;
                $options["idexclusion"] = $idexclusion;
                
                if($modo != "ffletes"){
                    $options["idg"] = RepStatus::IDG_STATUS_MARITIMO;
                    switch($modo){                    
                        case "llegada":
                            $options["idg"] = RepStatus::IDG_CONF_LLEGADA;
                            $idetapa = 'IMCPD';                        

                            $fecha = $request->getParameter("fechallegada");
                            $hora = $request->getParameter("horallegada");
                            break;
                        case "desconsolidacion":                        
                            $idetapa = 'IMDES';

                            $confirmaciones = Doctrine::getTable("Confirmaciones")->findByDql("ca_idmaster = ? AND ca_tipo = ?", array($house->getInoMaster()->getCaIdmaster(), 'Not.Desconsolidación'))->getLast();
                            if($confirmaciones){                                
                                $fecha = Utils::parseDate($confirmaciones->getCaFchenvio(), 'Y-m-d');
                                $hora =  Utils::parseDate($confirmaciones->getCaFchenvio(), "H:i:s");
                            }
                            break;
                        case "planilla":     
                            $idetapa = 'IMPLA';

                            $confirmaciones = Doctrine::getTable("Confirmaciones")->findByDql("ca_idmaster = ? AND ca_tipo = ?", array($house->getInoMaster()->getCaIdmaster(), 'Not.Planilla'))->getLast();
                            if($confirmaciones){                                
                                $fecha = Utils::parseDate($confirmaciones->getCaFchenvio(), 'Y-m-d');
                                $hora =  Utils::parseDate($confirmaciones->getCaFchenvio(), "H:i:s");
                            }
                            break;
                    }

                    $indicador = Doctrine::getTable("Idg")->find($options["idg"]);

                    $options["idetapa"] = $idetapa;
                    $options["fecha"] = $fecha;
                    $options["idsucursal"] = $house->getIdsucursalxHouse();
                    $options["fchini"] = Utils::parseDate($fecha." ".$hora, "Y-m-d H:i:s");
                    $options["fchend"] = date("Y-m-d H:i:s");
//                    print_r($options);
                    $idgConfig = IdgTable::getNuevoIndicador($options);
                    $calculo = $idgConfig->calcularIndicador($options);
                    $cumple = $idgConfig->evaluarIndicador($calculo["estado"], $calculo["val"], $options);                    
                    $cumple["idhouse"] = $idhouse;
                
                    $resultado[] = $cumple;
                    
                }else{
                    if($house->getInoMaster()->getRequiereIdg()){
                        $tipofactura = $request->getParameter("tipofactura");
                        if($tipofactura == "ffletes"){
                            $archivos = $request->getParameter("datosArchivos");

                            $dataFiles = json_decode($archivos, 1);

                            if ($dataFiles) {
                                foreach ($dataFiles as $key => $data) {                                
                                    if(strpos($data["documento"], "Factura") !== false){                  

                                        $idcomprobante = $data["idcomprobante"];
                                        if($idcomprobante){
                                            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);                

                                            $options["fecha"] = date("Y-m-d");                                    

                                            $cumple = $comprobante->generarIdg($options);
                                            $cumple["idhouse"] = $idhouse;
                                            $cumple["exclusiones"] = true;

                                            $resultado[] = $cumple;

                                        }else{
                                            $resultado[] = array("cumplio" => "No", "mensaje"=>"Por favor genere el archivo desde INO por GUARDAR TRD.<br/>", "idhouse" => $options["idhouse"]);
                                        }
                                    }
                                }
                            }
                        }
                    }                
                }
            }
            
            $this->responseArray = array("success" => true, "data"=>$resultado);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeVerEmailTerceros(){ 
          
        $login = $this->getUser()->getUserId();
        $this->usuario = Doctrine::getTable("Usuario")->find($login);
        
        $this->ids = Doctrine::getTable("Ids")->find($this->getRequestParameter("id"));
        $comprobante = Doctrine::getTable("InoComprobante")->find($this->getRequestParameter("idcomprobante"));
        $this->reporte = $comprobante->getInoHouse()->getReporte();
        $this->idhouse = $comprobante->getInoHouse()->getCaIdhouse();
        $this->exclusiones = $this->reporte->getExclusiones();
        
        $idcomprobantes = array();
        $this->archivos=$this->reporte->getFilesGestDoc();
        foreach($this->archivos as $file){
            $tipodoc = $file->getTipoDocumental();                                
            if(strpos($tipodoc->getCaDocumento(), "Factura")>=0){                
                $datos = json_decode(utf8_encode($file->getCaDatos()));                
                $idcomprobantes[$file->getCaIdarchivo()] = $datos->idcomprobante;
            }
        }
        $this->idcomprobantes = $idcomprobantes;
        
        $this->contactos = array();
        $sucursales = $this->ids->getIdsSucursal();
                
        foreach($sucursales as $sucursal){
            $contactos = Doctrine::getTable("IdsContacto")->findBy("ca_idsucursal", $sucursal->getCaIdsucursal());
            foreach($contactos as $contacto){
                if($contacto->getCaEmail() != null && $contacto->getCaEmail() != "")
                    $this->contactos[] = $contacto->getCaEmail();
            }
        }
        $this->contactos = implode(",", $this->contactos);
        $asunto = "Factura de Venta Id.: ".$this->reporte->getCaConsecutivo()." ";
        $asunto.= $this->reporte->getUltimoStatus()?$this->reporte->getUltimoStatus()->getAsunto():"";
        $asunto.= ($this->reporte->getCaImpoexpo()== Constantes::EXPO?$this->reporte->getCaOrdenClie():null);
        
        $this->asunto = $asunto;        
        $this->setLayout("minimal");
    }
    
    public function executeEnviarEmailTerceros($request) {        

        $user = $this->getUser();
        //Crea el correo electronico
        $email = new Email();
        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Status Terceros");
        $email->setCaIdcaso($this->getRequestParameter("id"));
        $email->setCaFrom($user->getEmail());
        $email->setCaFromname($user->getNombre());

        if ($this->getRequestParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }

        $email->setCaReplyto($user->getEmail());

        $recips = explode(",", $this->getRequestParameter("destinatario"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addTo($recip);
                }
            }
        }
        
        $mensaje = ($this->getRequestParameter("mensaje") . "\n\n");
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());

        $email->addCc($this->getUser()->getEmail());        
        $email->setCaSubject($this->getRequestParameter("asunto"));
        
        $email->setCaBody($mensaje ."<br/>". $usuario->getFirma());
        $email->setCaBodyhtml(Utils::replace($mensaje));
        
        $attachments = $this->getRequestParameter("attachments");
        if ($attachments) {
           foreach ($attachments as $attachment) {
                $params = explode("_", $attachment);
                $idreporte = $params[0];
                $reporte = Doctrine::getTable("Reporte")->find($idreporte);
                $this->forward404Unless($reporte);

                $file = base64_decode($params[1]);
                $directory = $reporte->getDirectorioBaseDocs($file);

                $name = $directory;
                $email->AddAttachment($name);
           }
        }
        $email->save(); //guarda el cuerpo del mensaje    
        $this->setLayout("email");
    }
    
    public function executeVerEmailDocs(){ 
          
        $login = $this->getUser()->getUserId();
        $this->usuario = Doctrine::getTable("Usuario")->find($login);
        
        $this->archivos=explode(",", $this->getRequestParameter("iddocs"));
        
        $inoMaster= Doctrine::getTable("InoMaster")->find($this->getRequestParameter("idmaster"));
        
        $this->files=array();
        foreach($this->archivos as $a){            
            $file= Doctrine::getTable("Archivos")->find($a);
            $this->files[] = $file;
        }
        
        $this->contactos = array();        
        $this->contactos = implode(",", $this->contactos);
        $asunto = "Documentos referencia : ".$inoMaster->getCaReferencia();
        
        $this->asunto = $asunto;        
        $this->setLayout("minimal");
    }
    
    public function executeEnviarEmailDocs($request) {        

        $user = $this->getUser();
        //Crea el correo electronico
        $email = new Email();
        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Status Terceros");
        $email->setCaIdcaso($this->getRequestParameter("id"));
        $email->setCaFrom($user->getEmail());
        $email->setCaFromname($user->getNombre());

        if ($this->getRequestParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }

        $email->setCaReplyto($user->getEmail());

        $recips = explode(",", $this->getRequestParameter("destinatario"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addTo($recip);
                }
            }
        }
        
        $mensaje = ($this->getRequestParameter("mensaje") . "\n\n");
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());

        $email->addCc($this->getUser()->getEmail());        
        $email->setCaSubject($this->getRequestParameter("asunto"));
        
        $email->setCaBody($mensaje ."<br/>". $usuario->getFirma());
        
        $attachments = $this->getRequestParameter("attachments");
        if ($attachments) {
           foreach ($attachments as $att) {
               $archivo = Doctrine::getTable("Archivos")->find($att);
                $name = $archivo->getCaPath();
                //$email->AddAttachment($name);
                $mensaje.="\nArchivo : ".$archivo->getCaNombre();
            }        
        }
        
        $email->setCaBodyhtml(Utils::replace($mensaje));
        
        $email->save(); //guarda el cuerpo del mensaje    
        $this->setLayout("email");
    }
    
    public function executeInformeFindescargue($request) {        
        
        try{        
            $con = Doctrine_Manager::getInstance()->getConnection('master');
            $hoy = date('Y-m-d');
            $dias = 5;
            $sql="
                SELECT m.ca_idmaster, m.ca_referencia, m.ca_impoexpo, m.ca_transporte, ori.ca_ciudad as origen, des.ca_ciudad as destino, m.ca_fchllegada, cf.ca_tipo, (CAST(ca_fchllegada AS DATE) + CAST($dias||' days' AS INTERVAL)) as ca_fchlimite
                FROM tb_confirmaciones cf	
                RIGHT JOIN (
                    SELECT m.ca_idmaster
                    FROM ino.tb_master m
                            INNER JOIN ino.tb_master_sea ms ON ms.ca_idmaster = m.ca_idmaster	
                        WHERE ms.ca_fchconfirmacion > '2020-05-18' and substring(ca_referencia from 16 for 2) = '20') q on q.ca_idmaster = cf.ca_idmaster and ca_tipo = 'Not.DIAN 1207'
                    INNER JOIN ino.tb_master m ON m.ca_idmaster = q.ca_idmaster
                    INNER JOIN tb_ciudades ori on ori.ca_idciudad = m.ca_origen
                    INNER JOIN tb_ciudades des on des.ca_idciudad = m.ca_destino
                WHERE cf.ca_tipo IS NULL    
                ";
            
            $stmt = $con->execute($sql);
            $datos = $stmt->fetchAll();
            
            $data = array();
            foreach($datos as $key => $val){
                list($year, $month, $day) = sscanf($datos[$key]["ca_fchlimite"], "%d-%d-%d");                
                $fchlimite = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
                
                $color = "green";
                if($hoy >= $fchlimite){
                    $color = "pink";
                }
                
                $row["ca_idmaster"] = $datos[$key]["ca_idmaster"];
                $row["ca_referencia"] = $datos[$key]["ca_referencia"];
                $row["ca_impoexpo"] = utf8_encode($datos[$key]["ca_impoexpo"]);
                $row["ca_transporte"] = utf8_encode($datos[$key]["ca_transporte"]);
                $row["ca_origen"] = utf8_encode($datos[$key]["origen"]);
                $row["ca_destino"] = utf8_encode($datos[$key]["destino"]);
                $row["ca_fchllegada"] = utf8_encode($datos[$key]["ca_fchllegada"]);
                $row["ca_fchlimite"] = utf8_encode($datos[$key]["ca_fchlimite"]);
                $row["ca_color"] = $color;
                $data[] = $row;
            }
//            echo "<pre>";print_r($data);echo "</pre>";
//            exit;
            
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $sql);           
            
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        
        $this->setTemplate("responseTemplate");
        
    }
}