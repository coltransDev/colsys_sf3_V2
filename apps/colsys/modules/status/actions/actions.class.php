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

    /*
     * @param sfRequest $request A request object
     */

    public function executeIndex() {
        //$this->forward('default', 'module');
        //echo "si";
    }

    public function executeIndexExt5($request) {

        $user = $this->getUser();
        $this->permisos = [];

        $accesosConf = $user->getControlAcceso(self::RUTINA_CONFIRMACIONES);
        $accesosSea = $user->getControlAcceso(self::RUTINA_MARITIMO);
        $accesosOtm = $user->getControlAcceso(self::RUTINA_OTM);

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
            unset($texto);
        }
        
        //print_r($this->permisos);
        //exit;

        $this->inoMaster = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
        $this->modulo = $request->getParameter("modulo") ? $request->getParameter("modulo") : null;
        //echo "<pre>";print_r($this->permisos);echo "</pre>";
        //echo "<pre>";print_r($textos);echo "</pre>";
        //exit();
    }

    function executeDatosBusqueda($request) {

        $user = $this->getUser();
        $permisos = array();

        try {
            /* Accesos del usuario */
            $accesosConf = $user->getControlAcceso(self::RUTINA_CONFIRMACIONES);
            $accesosSea = $user->getControlAcceso(self::RUTINA_MARITIMO);
            $accesosOtm = $user->getControlAcceso(self::RUTINA_OTM);

            //echo "Confirmaciones";print_r($accesosConf); 
            //echo "sea";print_r($accesosSea); 
            //echo "otm";print_r($accesosOtm); 
            //        exit();
//            foreach ($accesosConf as $key => $metodo) {
//                if ($accesosSea[0]) { //consulta                
//                    $permisos["maritimo"][utf8_encode($metodo)] = true;
//                }
//                if ($accesosOtm[0]) { //consulta                
//                    $permisos["otm"][utf8_encode($metodo)] = true;
//                }
//            }

            for ($i = 0; $i < count($accesosConf); $i++) {
                if ($accesosSea[0]) { //consulta                
                    $permisos["maritimo"][utf8_encode($accesosConf[$i])] = true;
                }
                if ($accesosOtm[0]) { //consulta                
                    $permisos["otm"][utf8_encode($accesosConf[$i])] = true;
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

//            $confirmaciones = Doctrine::getTable("Email")
//                    ->createQuery("e")
//                    ->select("e.ca_idemail, e.ca_subject, e.ca_fchenvio")
//                    ->where("e.ca_subject like ?", '%' . $master->getCaReferencia() . '%')
//                    ->addWhere("e.ca_tipo = ? OR e.ca_tipo = ? OR e.ca_tipo = ? OR e.ca_tipo = ?", array('Not.Llegada', 'Not.Desconsolidación', 'Not.Planilla', 'Not.DIAN 1207'))
//                    ->addOrderBy("e.ca_fchenvio DESC")
//                    ->execute();
//
//            if ($confirmaciones->count() > 0) {
//                foreach ($confirmaciones as $c) {
//                    $rowconf[] = array("idemail" => $c->getCaIdemail(), "subject" => utf8_encode($c->getCaSubject()), "fchenvio" => $c->getCaFchenvio());
//                }
//                $data["confirmaciones"] = $rowconf;
//            }
//
//            $tickets = Doctrine::getTable("HdeskTicket")
//                    ->createQuery("t")
//                    ->select(".ca_idticket, t.ca_title, MAX(e.ca_idemail) as idemail")
//                    ->leftJoin("t.HdeskAuditDocuments ad")
//                    ->leftJoin("t.Email e")
//                    ->where("ad.ca_numero_doc like ?", '%' . $master->getCaReferencia() . '%')
//                    ->addWhere("e.ca_tipo = 'Notificación'")
//                    ->groupBy("t.ca_idticket, t.ca_title")
//                    ->addOrderBy("t.ca_idticket DESC")
//                    ->execute();
//
//            if ($tickets->count() > 0) {
//                foreach ($tickets as $t) {
//                    $rowtk = array();
//                    $rowtk[] = array("idticket" => $t->getCaIdticket(), "idemail" => $t->idemail, "title" => utf8_encode($t->getCaTitle()));
//                }
//                $data["tickets"] = $rowtk;
//            }

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
            $tickets = Doctrine::getTable("HdeskTicket")
                    ->createQuery("t")
                    ->select(".ca_idticket, t.ca_title, MAX(e.ca_idemail) as idemail")
                    ->leftJoin("t.HdeskAuditDocuments ad")
                    ->leftJoin("t.Email e")
                    ->where("ad.ca_numero_doc like ?", '%' . $master->getCaReferencia() . '%')
                    ->addWhere("e.ca_tipo = 'Notificación'")
                    ->groupBy("t.ca_idticket, t.ca_title")
                    ->addOrderBy("t.ca_idticket DESC")
                    ->execute();

            if ($tickets->count() > 0) {
                foreach ($tickets as $t) {
                    $rowtk = array();
                    $rowtk[] = array("idticket" => $t->getCaIdticket(), "idemail" => $t->idemail, "title" => utf8_encode($t->getCaTitle()));
                }
                $data["tickets"] = $rowtk;
            }

            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
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

        if ($idcliente) {

            $cliente = Doctrine::getTable("Cliente")->find($idcliente);
            $reporte = Doctrine::getTable("Reporte")->find($idreporte);

            $cfijos = Doctrine::getTable("Contacto")
                    ->createQuery("c")
                    ->addWhere("c.ca_idcliente = ?", $cliente->getCaIdcliente())
                    ->addWhere("ca_fijo = ?", true)
                    ->addWhere("ca_cargo != ?", 'Extrabajador')
                    ->execute();

            $cReporte = explode(",", $reporte->getCaConfirmarClie());
            $cCliente = explode(",", $cliente->getCaConfirmar());

            $cOtros = array_unique(array_merge($cReporte, $cCliente));

            foreach ($cfijos as $fijos) {
                $row = array();
                //$row["idcontacto"] = $fijos->getCaIdcontacto();
                $row["email"] = $fijos->getCaEmail();
                $row["cargo"] = utf8_encode($fijos->getCaCargo());
                $row["tipo"] = "Contactos Fijos";
                $row["sel"] = true;
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

        //try {
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

//                    if ($request->getParameter("fchdesconsolidacion")) {
//                        $referencia->setCaFchdesconsolidacion(Utils::parseDate($request->getParameter("fchdesconsolidacion")));
//                    }
//                    if ($request->getParameter("fchsyga")) {
//                        $referencia->setCaFchfinmuisca(Utils::parseDate($request->getParameter("fchsyga")));
//                    }

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
                        /* if ($request->getParameter("fchdesconsolidacion")) {
                          $referencia->setCaFchdesconsolidacion(Utils::parseDate($request->getParameter("fchdesconsolidacion")));
                          } */
                        $masterSea->setCaFchvaciado(Utils::parseDate($request->getParameter("fchvaciado")));
                        $masterSea->setCaHoravaciado($request->getParameter("horavaciado"));
                        if ($request->getParameter("fchsyga")) {
                            $masterSea->setCaFchfinmuisca(Utils::parseDate($request->getParameter("fchsyga")));
                        }
                        $masterSea->save($conn);
                    }

                    if ($master->getCaModalidad() == "LCL") {
                        $tarea1207 = $master->getTarea1207($datosMaster);
                    }

                    $tipo = "Desconsolidación";
                    $title = "Información de Desconsolidación";
                    $intro = $request->getParameter("mensaje");
                    $body = ""; //$request->getParameter("email_body");
                    $otm = true;
                    $where = " and sc.ca_nombre in (
                            select distinct(s.ca_nombre)
                            from ino.tb_house  h
                                inner join tb_reportes r on r.ca_idreporte=h.ca_idreporte                                    
                                inner join ino.tb_house_sea hs ON hs.ca_idhouse = h.ca_idhouse
                                INNER JOIN ino.tb_master m ON m.ca_idmaster = h.ca_idmaster
                                inner join control.tb_usuarios u on r.ca_usucreado=u.ca_login
                                inner join control.tb_sucursales s on s.ca_idsucursal=u.ca_idsucursal
                            where m.ca_referencia = '$referencia' AND hs.ca_continuacion IS NOT NULL AND hs.ca_continuacion != 'N/A')";
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
                    $body = ""; //$request->getParameter("email_body");
                    $otm = true;

                    $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
                    //$sucursal = $usuario->getSucursal()->getCaNombre();
                    $where = " OR sc.ca_nombre = '" . $master->getDestino()->getCaCiudad() . "' and e.ca_idempresa = 8";

                    $data["iddocumental"] = 11;
                    
                    $destOtm = true; // Solo destinatarios de otm
                    //Finalización de Tarea Envio Formulario 1207
                    //$inoMaestraSea = Doctrine::getTable("InoMaestraSea")->find($ca_referencia);                
                    //$idtarea = $inoMaestraSea->getProperty("idtarea");
                    $idtarea = $datosMaster["idtarea"];
                    if ($idtarea) {
//                         $tareas = Doctrine::getTable("NotTarea")
//                                ->createQuery("n")
//                                ->addWhere("n.ca_idtarea = ? ", $idtarea)                                  
//                                ->execute();
                        $tarea = Doctrine::getTable("NotTarea")->find($idtarea);
                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                        $tarea->setCaUsuterminada($this->getUser()->getUserId());
                        $tarea->save($conn);
                    }

//                    foreach($tareas as $tarea){
//                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
//                        $tarea->setCaUsuterminada($this->getUser()->getUserId());
//                        $tarea->save();
//                    }
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

            /* print_r($attachments);
              exit(); */


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
                                SELECT DISTINCT(ca_login) FROM control.tb_usuarios WHERE ca_idsucursal in (
                                        SELECT ca_idsucursal FROM control.tb_usuarios WHERE ca_login in (
                                                SELECT ca_vendedor FROM vi_clientes_reduc WHERE ca_idcliente in (
                                                        SELECT ca_idcliente FROM ino.tb_house WHERE ca_idmaster = $idmaster ) 
                                                                AND (ca_propiedades like '%cuentaglobal=true%' OR ca_propiedades like '%cuentaglobal=1%'))) 
                                                                AND ca_departamento = 'Cuentas Globales' 
                                                                AND ca_activo = true))";

                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                $this->resul = $st->fetchAll();

                $destinatarios = array();
                foreach ($this->resul as $r) {
                    $destinatarios[] = $r["ca_email"];
                }

                if ($otm) {
                    $sql2 = "SELECT DISTINCT u.ca_email
                            FROM control.tb_usuarios u
                            JOIN control.tb_sucursales sc on sc.ca_idsucursal=u.ca_idsucursal
                            JOIN control.tb_empresas e on sc.ca_idempresa=e.ca_idempresa
                            JOIN control.tb_usuarios_perfil up on up.ca_login = u.ca_login
                            WHERE up.ca_perfil = 'cordinador-de-otm' and u.ca_activo = true";

                    $sql2 = $sql2 . $where;
                    
                    /*Si la comunicación es solo para Otm. Ej 1207*/
                    if($destOtm)
                    $destinatarios = array();
                    
                    $con = Doctrine_Manager::getInstance()->connection();
                    $st = $con->execute($sql2);
                    $this->resul = $st->fetchAll();
                    foreach ($this->resul as $r) {
                        $destinatarios[] = $r["ca_email"];
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


                //            if ($tipo_msg == "Desc") {
                //                sfContext::getInstance()->getRequest()->setParameter("fchsyga", $request->getParameter("fchsyga"));
                //            }
                //$modo = $request->getParameter("modo");
                $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('status', 'emailConfirmacion'));
                $email->save($conn);
                $email->send($conn);

                $confirmaciones = new Confirmaciones();
                $confirmaciones->setCaIdemail($email->getCaIdemail());
                $confirmaciones->setCaIdmaster($email->getCaIdcaso());
                $confirmaciones->setCaTipo($email->getCaTipo());
                $confirmaciones->setCaSubject($email->getCaSubject());
                $confirmaciones->setCaFchenvio($email->getCaFchenvio());
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
                
                $archivos = $request->getParameter("datosArchivos");
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
            
            //echo "<pre>";print_r($attachment);echo "</pre>";
            //exit;
                
                /*$houses = Doctrine::getTable("InoHouse")
                     ->createQuery("h")
                     ->select("h.*")
                     ->whereIn("h.ca_idhouse",$idhouses)
                     ->execute();
                */
                //$sql="SELECT * FROM ino.tb_house h LEFT JOIN ino.tb_house_sea hs ON hs.ca_idhouse = h.ca_idhouse WHERE  h.ca_idhouse in (". implode(",", $idhouses).")";
//                $sql = "SELECT h.ca_idhouse as ca_idhouse, h.ca_idreporte as ca_idreporte, h.ca_idbodega, sqa.ca_doctransporte as ca_doctransporte, hs.ca_datos as ca_datos, sqa.ca_piezas as ca_piezas, sqa.ca_peso as ca_peso, sqa.ca_volumen as ca_volumen, sqa.ca_idnave as ca_idnave, sqa.ca_fchsalida as ca_fchsalida, sqa.ca_fchllegada as ca_fchllegada, sqa.ca_fchcontinuacion as ca_fchcontinuacion
//                        FROM ino.tb_house h
//                            LEFT JOIN ino.tb_house_sea hs ON hs.ca_idhouse = h.ca_idhouse 
//                            LEFT JOIN ( 
//                                SELECT ca_idreporte, ca_fchsalida, ca_fchllegada, ca_piezas, ca_peso, ca_volumen, ca_doctransporte, ca_idnave, ca_fchcontinuacion                   
//                                FROM tb_repstatus rs 
//                                RIGHT JOIN (
//                                    SELECT max(rs.ca_idstatus) as ca_idstatus 
//                                    FROM tb_repstatus rs                                                                                                             
//                                    GROUP BY rs.ca_idreporte) sf on rs.ca_idstatus = sf.ca_idstatus)  sqa ON h.ca_idreporte = sqa.ca_idreporte
//                        WHERE  h.ca_idhouse in (". implode(',', $idhouses).")";
                
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
                
                //echo $sql;
                //exit();
                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                $houses = $st->fetchAll();

                
//                foreach($houses as $house){
//                    list($useg, $seg) = explode(" ", microtime(true));                    
//                    //$idhouse = $house->getCaIdhouse();
//                    $idhouse = $house["ca_idhouse"];//->getCaIdhouse();
//                    $tiempo[$idhouse]["ini"] = ((float)$useg + (float)$seg);
//                    
//                    
//                    //$reporte = $house->getReporte();
//                    
//                    $status = new RepStatus();
//                    $status->setCaIdreporte(528186/*$reporte->getCaIdreporte()*/);
//                    $status->setCaFchstatus(date("Y-m-d H:i:s"));
//                    $status->setCaFchenvio(date("Y-m-d H:i:s"));
//                    $status->setCaUsuenvio($this->getUser()->getUserId());
//                    $status->setCaTipo("2"); //tipo 2 para maritimo
//                    $status->setStatus("prueba");
//                    $status->setCaIdetapa("88888");
//                    $status->save();
//                    
//                    $destinatarios = $contactos[$idhouse];
//                    $attachments = $attachment[$idhouse] ? $attachment[$idhouse] : [];  
//                    
//                    list($useg, $seg) = explode(" ", microtime(true));                    
//                    $tiempo[$idhouse]["entre"] = ((float)$useg + (float)$seg);
//                    
//                    $status->send($destinatarios, array(), $attachments, $options, $conn);     
//                    
//                    list($useg, $seg) = explode(" ", microtime(true));                    
//                    $tiempo[$idhouse]["fin"] = ((float)$useg + (float)$seg);
//                }

                //print_r($attachment);

                foreach($houses as $house){
                    list($useg, $seg) = explode(" ", microtime(true));                    
                    //$idhouse = $house->getCaIdhouse();
                    $idhouse = $house["ca_idhouse"];//->getCaIdhouse();
                    //$tiempo[$idhouse]["ini"] = ((float)$useg + (float)$seg);
                    //$house = Doctrine::getTable("InoHouse")->find($idhouse);
                    $houseSea = Doctrine::getTable("InoHouseSea")->find($house["ca_idhouse"]);
                    
                    $datosHouse = json_decode(utf8_encode($house["ca_datos"]), 1);

                    $options = array();
                    $mensaje = "";

                    $hbls = $house["ca_doctransporte"];
                    //$reporte = $house->getReporte();
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
                    

                    /* Otm
                      if (substr($referencia->getCaReferencia(), 0, 1) == "7") {
                      $status->setCaPiezas($inoCliente->getCaNumpiezas());
                      $status->setCaPeso($inoCliente->getCaPeso());
                      $status->setCaVolumen($inoCliente->getCaVolumen());
                      $status->setCaFchsalida($referencia->getCaFchembarque());
                      $status->setCaFchllegada($referencia->getCaFcharribo());
                      $status->setCaIdnave($referencia->getCaMotonave());
                      $status->setCaDoctransporte($inoCliente->getCaHbls());
                      } */

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
                            //$options["nuevo"] = true;
                            $status->setCaIdetapa("88888");
                            break;
                        case "fotm":
                            $options["subject"] = "Factura de OTM Id.: " . $reporte->getCaConsecutivo() . " ";
                            //$options["nuevo"] = true;
                            $status->setCaIdetapa("88888");
                            break;
                        case "fcontenedores":
                            $options["subject"] = "Factura de Contenedores Id.: " . $reporte->getCaConsecutivo() . " ";
                            //$options["nuevo"] = true;
                            $status->setCaIdetapa("88888");
                            break;
                        case "otm":                            
                            $etapa = $form[$idhouse]["etapaOtm"];                            
                            $repotm = $reporte->getRepUltVersion()->getRepOtm();
                            //var_export($form);
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
                            //$options["nuevo"] = true;
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
                    //echo "<pre>";print_r($attachments);echo "</pre>";
                    //exit;
                    $status->setStatus($mensajeStatus);
                    
                    $status->save($conn);
                    list($useg, $seg) = explode(" ", microtime(true));                                        
                    //$tiempo[$idhouse]["entre"] = ((float)$useg + (float)$seg);
                    
                    $status->send($destinatarios, array(), $attachments, $options);
                    list($useg, $seg) = explode(" ", microtime(true));                                        
                    //$tiempo[$idhouse]["fin"] = ((float)$useg + (float)$seg);
                }
                $conn->commit();
                $this->responseArray = array("success" => true, "mensaje" => "Las comunicaciones se han enviado correctamente!", "modulo" => $tipo_msg/*, "tiempo"=> $tiempo*/);
            }
        /*} catch (Exception $e) {
            //$conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }*/

        $this->setTemplate("responseTemplate");





//        } else {
//            foreach ($oids as $oid) {
//
//                switch ($modo) {
//                    
//                    case "otm":
//                        
//                        
//                        $etapa = $this->getRequestParameter("tipo_" . $oid);
//
//                        if ($etapa == "IMCOL" || $this->getRequestParameter("modfchllegada_" . $oid)) {
//                            $status->setCaFchcontinuacion(Utils::parseDate($this->getRequestParameter("fchllegada_" . $oid)));
//                        }
//                        if ($etapa == "IMCOL") {
//                            $idbodega = $this->getRequestParameter("bodega_" . $oid);
//                            $status->setProperty("idbodega", $idbodega);
//                        }
//                        if ($etapa == "99999") {
//                            $fchplanilla = $this->getRequestParameter("fchplanilla_" . $oid);
//                            $status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));
//                        }
//                        
//                        if ($etapa == "OTDES" || $this->getRequestParameter("fchcargue_" . $oid)) {
//                            $repotm = $reporte->getRepUltVersion()->getRepOtm();                            
//                            $repotm->setCaFchcargue($this->getRequestParameter("fchcargue_" . $oid));
//                            $repotm->setCaFchsalida($this->getRequestParameter("fchsalidaotm_" . $oid));
//                            $repotm->save();                            
//                        }
//                        
//                        if ($etapa == "99999" || $this->getRequestParameter("fchcierreotm_" . $oid)) {
//                            $repotm = $reporte->getRepUltVersion()->getRepOtm();                            
//                            $repotm->setCaFchcierre($this->getRequestParameter("fchcierreotm_" . $oid));
//                            $repotm->save();                            
//                        }
//                        
//                        $status->setCaIdetapa($etapa);
//                        break;
//                    default:
//                        $status->setCaIdetapa("88888");
//                        break;
//                }
//
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
        //$this->fchsyga = $request->getParameter("fchsyga");
        //echo $request->getParameter("datos");
        //$this->datos = $request->getParameter("datos");
        //echo $this->usuario->getCaLogin();
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

//                echo "Fch Llegada:".$fechallegada." Hora Llegada:".$horallegada."<br/>";
//                echo "inicio:".$inicio." Final:".$final."<br/>";
//                echo "diff" .$house->getCaDoctransporte().": ".$diff."<br/>";
//                echo "idgMax " .$house->getCaDoctransporte().": ".$idgMax."<br/>";
//                echo "fecha ".$fecha." hora: ".$hora."<br/>";
//                echo "justifica " .$house->getCaDoctransporte().": ". strlen($justifica)." $justifica<br/>";
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
        $modo = $request->getParameter("modo");
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        
        try{
            foreach($idhouses as $key => $idhouse){
                $house = Doctrine::getTable("InoHouse")->find($idhouse);
                $options["idg"] = RepStatus::IDG_STATUS_MARITIMO;
                
                $fecha = $fechas[$key];
                $hora = $horas[$key];
                $idetapa = '88888';
                $justifica = $justificaciones[$key];
                $existe = false;
                
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
                $options["idcaso"] = $house->getReporte()->getCaConsecutivo();
                $options["idhouse"] = $house->getCaIdhouse();
                $options["doctransporte"] = $house->getCaDoctransporte();
                $options["observaciones"] = $justifica;
                $options["idetapa"] = $idetapa;
                $options["fecha"] = $fecha;
                $options["fchini"] = Utils::parseDate($fecha." ".$hora, "Y-m-d H:i:s");
                $options["fchend"] = date("Y-m-d H:i:s");
                
                $row[] = $indicador->calcularIndicador($options);
                
            }
            $this->responseArray = array("success" => true, "data"=>$row);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
}