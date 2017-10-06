<?php

/**
 * InoF2 actions.
 *
 * @package    colsys
 * @subpackage InoF2
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inoF2Actions extends sfActions {

    /**
     * Executes index action
     *
     */
    const RUTINA_AEREO = 200;
    const RUTINA_MARITIMO = 201;
    const RUTINA_TERRESTRE = 202;
    const RUTINA_EXPORTACION = 203;
    const RUTINA_OTM = 204;

    public function executeIndexExt5(sfWebRequest $request) {

        $this->permisos = array();

        $user = $this->getUser();

        $permisosRutinas["aereo"] = $user->getControlAcceso(self::RUTINA_AEREO);
        $permisosRutinas["maritimo"] = $user->getControlAcceso(self::RUTINA_MARITIMO);

        $permisosRutinas["terrestre"] = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $permisosRutinas["exportacion"] = $user->getControlAcceso(self::RUTINA_EXPORTACION);
        $permisosRutinas["otm"] = $user->getControlAcceso(self::RUTINA_OTM);

        $tipopermisos = array('Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Anular' => 3, 'Liquidar' => 4, 'Cerrar' => 5, 'Abrir' => 6, 'General' => 7, 'House' => 8, 'Facturacion' => 9, 'Costos' => 10, 'Documentos' => 11, 'Muisca' => 12, 'MuiscaEd' => 13, 'MuiscaDig' => 14, 'MuiscaRev' => 15, 'GenerarXml' => 16, 'DarLiberacion' => 17, 'RevLiberacion' => 18, 'LiberacionPto' => 19, 'Comodatos' => 20);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                $this->permisos[$k][$index] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }
        
        $this->inoMaster = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
    }

    function executeDatosBusqueda($request) {


        $user = $this->getUser();

        /* Accesos del usuario */
        $permisosRutinas["aereo"] = $user->getControlAcceso(self::RUTINA_AEREO);
        $permisosRutinas["maritimo"] = $user->getControlAcceso(self::RUTINA_MARITIMO);

        $permisosRutinas["terrestre"] = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $permisosRutinas["exportacion"] = $user->getControlAcceso(self::RUTINA_EXPORTACION);
        $permisosRutinas["otm"] = $user->getControlAcceso(self::RUTINA_OTM);

        $tipopermisos = array('Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Anular' => 3, 'Liquidar' => 4, 'Cerrar' => 5, 'Abrir' => 6, 'General' => 7, 'House' => 8, 'Facturacion' => 9, 'Costos' => 10, 'Documentos' => 11, 'Muisca' => 12, 'MuiscaEd' => 13, 'MuiscaDig' => 14, 'MuiscaRev' => 15, 'GenerarXml' => 16, 'DarLiberacion' => 17, 'RevLiberacion' => 18, 'LiberacionPto' => 19, 'Comodatos' => 20);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                //$permisos[$k][$index]=$permisosRutinas[$k][$tp];
                $permisos[$k][$index] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }
        
        $where = "";
        foreach ($request->getParameter("opciones") as $o) {
            if ($where != "")
                $where .= " OR ";
            
            if($o!="ca_consecutivo")
            {
                $where .= $o . " like ?";
                $whereq[] = "%" . $request->getParameter("q") . "%";
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

        $q = Doctrine::getTable("InoViBusqueda")
                ->createQuery("m")
                ->distinct("ca_referencia")
                ->select("ca_referencia, ca_fchcreado,ca_transporte,ca_impoexpo,ca_idmaster,ca_modalidad,ca_fchcerrado")
                ->where("" . $where, $whereq)
                ->orderBy("ca_fchcreado DESC")
                ->limit(40)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $where = "";
        $whereq = array();
        $wherePermisos = " (";
        if ($permisos["aereo"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $whereq[] = Constantes::IMPO;
            $whereq[] = Constantes::AEREO;
        }

        if ($permisos["maritimo"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $whereq[] = Constantes::IMPO;
            $whereq[] = Constantes::MARITIMO;
        }

        if ($permisos["terrestre"]["Consultar"]) {
            //echo "ss";
            if ($where != "")
                $where .= " OR ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $whereq[] = Constantes::INTERNO;
            $whereq[] = Constantes::TERRESTRE;
        }

        if ($permisos["exportacion"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            $where .= "(ca_impoexpo = ?  ) ";
            $whereq[] = Constantes::EXPO;
        }

        if ($permisos["otm"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $whereq[] = Constantes::OTMDTA;
            $whereq[] = Constantes::TERRESTRE;
        }


        $wherePermisos .= $where . " )";
        $q->addWhere("" . $where, $whereq);

        $debug = utf8_encode($q->getSqlQuery());
        $datos = $q->execute();
        foreach ($datos as $k => $d) {
            $datos[$k]["m_ca_transporte"] = utf8_encode($datos[$k]["m_ca_transporte"]);
            $datos[$k]["m_ca_impoexpo"] = utf8_encode($datos[$k]["m_ca_impoexpo"]);
            $datos[$k]["m_ca_modalidad"] = utf8_encode($datos[$k]["m_ca_modalidad"]);

            $ticket = Doctrine::getTable("HdeskAuditDocuments")
                    ->createQuery("t")
                    ->addWhere("t.ca_numero_doc = ?", $datos[$k]["m_ca_referencia"])
                    ->fetchOne();
            if ($ticket) {
                $datos[$k]["m_ca_idticket"] = $ticket->getCaIdticket();
            } else {
                $datos[$k]["m_ca_idticket"] = -1;
            }
        }
        $usuario = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->addWhere("u.ca_login = ?", $this->getUser()->getUserId())
                ->fetchOne();
        $datosusuario = json_decode($usuario->getCaDatos());

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "debug" => $debug, "tipofacturacion" => $datosusuario->factura_ino);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarPreferencias(sfWebRequest $request) {

        $style = $request->getParameter("user_style");
        $user_factuaIno = $request->getParameter("user_factuaIno");

        $usuario = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->addWhere("u.ca_login = ?", $this->getUser()->getUserId())
                ->fetchOne();
        $datos = json_decode($usuario->getCaDatos());


        if (($style && $style != "")) {
            $datos->estiloIno = $style;
        }
        if ($user_factuaIno && $user_factuaIno != "") {
            $datos->factura_ino = $user_factuaIno;
        }

        $datos = json_encode($datos);
        $conn = Doctrine::getTable("Usuario")->getConnection();
        $conn->beginTransaction();
        try {

            $usuario->setCaDatos($datos);
            $usuario->save();
            $conn->commit();

            $this->getUser()->setDatos($datos);
            $this->responseArray = array("success" => "true", "style" => $style);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "style" => $style);
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosGridHouse(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $inoHouses = Doctrine::getTable("InoHouse")
                ->createQuery("c")
                ->select("c.*, cl.*")
                //->innerJoin("c.Ids cl")
                ->innerJoin("c.Cliente cl")
                ->where("c.ca_idmaster = ?", $idmaster)
                ->addOrderBy("cl.ca_compania")
                ->execute();

        $data = array();
        foreach ($inoHouses as $inoHouse) {
            $row = array();
            $row["idmaster"] = $inoHouse->getCaIdmaster();
            $row["idhouse"] = $inoHouse->getCaIdhouse();
            $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
            $row["fchdoctransporte"] = $inoHouse->getCaFchdoctransporte();
            $row["numorden"] = utf8_encode($inoHouse->getCaNumorden());
            $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
            $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
            $row["vendedor"] = $inoHouse->getCaVendedor();
            $row["idreporte"] = $inoHouse->getCaIdreporte();
            $row["reporte"] = $inoHouse->getReporte()->getCaConsecutivo();
            $row["numpiezas"] = $inoHouse->getCaNumpiezas() . " " . utf8_encode($inoHouse->getCaMpiezas());
            //$totales["numpiezas"] +=$inoHouse->getCaNumpiezas();
            $row["peso"] = $inoHouse->getCaPeso();
            //$totales["peso"] +=$inoHouse->getCaPeso();
            $row["volumen"] = $inoHouse->getCaVolumen();
            //$totales["volumen"] +=$inoHouse->getCaVolumen();
            $row["idtercero"] = $inoHouse->getCaIdtercero();
            $row["tercero"] = utf8_encode($inoHouse->getTercero()->getCaNombre());
            $row["bodega"] = $inoHouse->getCaIdbodega();
            $bodega = Doctrine::getTable("Bodega")->find($inoHouse->getCaIdbodega());
            if ($bodega) {
                $row["nombrebodega"] = utf8_encode($bodega->getCaNombre());
            }
            $comprobantes = $inoHouse->getInoComprobante();
            if (count($comprobantes) < 1) {
                $row["color"] = "pink";
            }
            $row["planilla"] = $datos["planilla"];
            $row["url"] = $inoHouse->getVendedor()->getImagenUrl('60x80');
            $row["global"] = $inoHouse->getCliente()->getProperty("cuentaglobal");
            $row["comunicaciones"] = $inoHouse->getCliente()->getProperty("consolidar_comunicaciones");

            $inoHouseSea = $inoHouse->getInoHouseSea();

            $datos = json_decode($inoHouseSea->getCaDatos(), true);

            $row["continuacion"] = $inoHouseSea->getCaContinuacion();
            $row["destinofinal"] = $inoHouseSea->getCaContinuacionDest();
            //print_r($datos);
            //exit;
            $inoEquipos = Doctrine::getTable("InoEquipo")
                    ->createQuery("e")
                    ->select("e.* ")
                    ->where("e.ca_idmaster = ?", $idmaster)
                    ->addOrderBy("e.ca_idequipo")
                    ->execute();
            $equipos = array();
            foreach ($inoEquipos as $e) {
                $piezas = "";
                $kilos = "";
                if ($datos["equipos"]) {
                    foreach ($datos["equipos"] as $de) {
                        if ($de["idconcepto"] == $e->getCaIdconcepto()) {
                            $piezas = $de["piezas"];
                            $kilos = $de["kilos"];
                            continue;
                        }
                    }
                }
                $equipos[] = array("sel" => true, "idequipo" => $e->getCaIdequipo(), "idconcepto" => $e->getConcepto()->getCaIdconcepto(), "concepto" => $e->getConcepto()->getCaConcepto(), "serial" => $e->getCaSerial(), "numprecinto" => $e->getCaNumprecinto(), "piezas" => $piezas, "kilos" => $kilos);
            }
            $row["equipos"] = $equipos;
            $data[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "ncomprobantes" => count($comprobantes));

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosReporteCarga(sfWebRequest $request) {

        $data = array();
        $reporte = Doctrine::getTable("Reporte")->find($request->getParameter("idreporte"));

        $prov = $reporte->getProveedores();
        if (count($prov) > 0) {
            $data["idproveedor"] = $prov[0]->getCaIdtercero();
            $data["proveedor"] = $prov[0]->getCaNombre();
        }

        $data["origen"] = $reporte->getDocTransporte();
        $data["impoexpo"] = utf8_encode($reporte->getCaImpoexpo());
        $data["transporte"] = utf8_encode($reporte->getCaTransporte());
        $data["modalidad"] = $reporte->getCaModalidad();
        $data["origen"] = $reporte->getCaOrigen();
        $data["destino"] = $reporte->getCaDestino();
        $data["idlinea"] = $reporte->getCaIdlinea();
        $data["linea"] = utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());
        $data["idagente"] = $reporte->getCaIdagente();
        $data["ca_fchsalida"] = $reporte->getEts();
        $data["ca_fchllegada"] = $reporte->getEta();
        $data["ca_master"] = $reporte->getCaDocmaster();
        $repstatus = $reporte->getUltimoStatus();

        if ($repstatus) {
            $data["ca_peso"] = $repstatus->getCaPeso();
            $data["ca_piezas"] = $repstatus->getCaPiezas();
            $data["ca_volumen"] = $repstatus->getCaVolumen();
            $data["ca_docmaster"] = $repstatus->getCaDocmaster();
        }

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    /*public function executeDatosFacturas(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $q = Doctrine::getTable("InoHouse")
                ->createQuery("c")
                ->select("c.ca_idhouse,  c.ca_idcliente ,c.ca_doctransporte, 
                        ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,cl.ca_propiedades, 
                        comp.ca_idcomprobante, comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,
                        m.ca_nombre,s.ca_descripcion,det.ca_iddetalle,comp.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,
                        clH.ca_idcliente,clH.ca_compania,cric.ca_rteica,det.*")
                ->innerJoin("c.InoComprobante comp")
                ->innerJoin("comp.Ids ids")
                ->innerJoin("ids.IdsCliente cl")
//                        ->innerJoin("comp.InoHouse h")                        
                ->innerJoin("c.Cliente clH")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                ->leftJoin("comp.InoDetalle det WITH det.ca_idconcepto is not null AND ( (ca_cr>0 AND tcomp.ca_tipo='F') or (ca_db>0 AND tcomp.ca_tipo<>'F' ) )")
                ->leftJoin("comp.Ids fact")
                ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                //->leftJoin("comp.Ctarteiva criv")
                //->leftJoin("comp.Ctaiva ci")                
                //->innerJoin("tcomp.InoCentroCosto ccosto")
                ->leftJoin("comp.Moneda m")
                ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                ->where("c.ca_idmaster = $idmaster  ")
                ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $datos = $q->execute();
        $this->data = array();

        foreach ($datos as $d) {
            $consecutivo = ($d["tcomp_ca_tipo"] == "F") ? "FACTURA " : (($d["tcomp_ca_tipo"] == "C") ? "<span class=row_yellow>NOTA CREDITO</span>" : "");
            $consecutivo .= ($d["comp_ca_consecutivo"] == "") ? " Sin Generar - " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
            $consecutivo .= " - " . utf8_encode($d["ids_ca_nombre"]) . " - " . $d["c_ca_doctransporte"];

            if ($d["clH_ca_compania"] != $d["ids_ca_nombre"])
                $consecutivo .= " - " . utf8_encode($d["clH_ca_compania"]);


            if ($d["comp_ca_fchgenero"] != "" && $d["comp_ca_usugenero"] != "")
                $consecutivo .= "({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})";

            if ($d["comp_ca_estado"] == "5") {
                $consecutivo = "<span class='row_green'>$consecutivo</span>";
            } else if ($d["comp_ca_estado"] == "6") {
                $consecutivo = "<span class='row_pink'>$consecutivo</span>";
            } else if ($d["comp_ca_estado"] == "8") {
                $consecutivo = "<span class='row_purple'>$consecutivo</span>";
            }
            $cuenta_forma_pago = "";
            if ($d["cl_ca_propiedades"]) {
                $array = sfToolkit::stringToArray($d["cl_ca_propiedades"]);
                if ($d["tcomp_ca_idempresa"] == "2") {
                    $cuenta_forma_pago = isset($array["cuenta_forma_pago_coltrans"]) ? $array["cuenta_forma_pago_coltrans"] : '';
                } else if ($d["tcomp_ca_idempresa"] == "8")
                    $cuenta_forma_pago = isset($array["cuenta_forma_pago_colotm"]) ? $array["cuenta_forma_pago_colotm"] : '';
                else
                    $cuenta_forma_pago = '';
            }

            $this->data[] = array(
                "idhouse" => $d["c_ca_idhouse"], "idcomprobante" => $d["comp_ca_idcomprobante"],
                "tipocomprobante" => $d["tcomp_ca_tipo"],
                "comprobante" => $consecutivo, "fchcomprobante" => $d["comp_ca_fchcomprobante"],
                "cliente" => $d["cl_ca_nombre"], "doctransporte" => $d["c_ca_doctransporte"],
                "idmoneda" => $d["m_ca_idmoneda"], "moneda" => $d["m_ca_nombre"],
                "valor" => ($d["det_ca_cr"] > 0 ? $d["det_ca_cr"] : $d["det_ca_db"]),
                // "valor"=>$d["det_ca_cr"] , 
                "idconcepto" => $d["det_ca_idconcepto"],
                "concepto" => utf8_encode($d["det_ca_idconcepto"] . "-" . $d["s_ca_descripcion"]),
                "iddetalle" => $d["det_ca_iddetalle"], "estado" => $d["comp_ca_estado"],
                "cuentapago" => $cuenta_forma_pago, "idccosto" => $d["tcomp_ca_idccosto"]
            );
        }
        //print_r($this->data);
        //echo $consecutivo;
        $this->responseArray = array("success" => true, "root" => $this->data, "total" => count($this->data), "debug" => $q->getSqlQuery());
        $this->setTemplate("responseTemplate");
    }*/

    public function executeDatosFacturas2(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $q = Doctrine::getTable("InoHouse")
                ->createQuery("c")
                ->select("c.ca_idhouse,  c.ca_idcliente ,c.ca_doctransporte,  
                        ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,cl.ca_propiedades, 
                        comp.ca_idcomprobante, comp.ca_idcomprobante_cruce,comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,
                        m.ca_nombre,comp.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,
                        clH.ca_idcliente,clH.ca_compania,cric.ca_rteica,comp.ca_valor,comp.ca_valor2,comp.ca_tcambio,
                        (SELECT SUM(det.ca_cr) FROM InoDetalle det WHERE det.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor3,
                        (SELECT SUM(det1.ca_db) FROM InoDetalle det1 WHERE det1.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor4")
                ->innerJoin("c.InoComprobante comp")
                ->innerJoin("comp.Ids ids")
                ->innerJoin("ids.IdsCliente cl")
                ->innerJoin("c.Cliente clH")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                ->leftJoin("comp.Ids fact")
                ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                ->where("c.ca_idmaster = $idmaster  ")
                ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $datos = $q->execute();
        $this->data = array();

        foreach ($datos as $d) {
            $consecutivo = ($d["tcomp_ca_tipo"] == "F") ? "FACTURA " : (($d["tcomp_ca_tipo"] == "C") ? "<span class=row_yellow>NOTA CREDITO</span>" : "");
            $consecutivo .= ($d["comp_ca_consecutivo"] == "") ? " Sin Gen. " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
            $file = ($d["tcomp_ca_tipo"] == "F" && $d["comp_ca_consecutivo"] != "") ? "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"]."/sap/1" : "";
            $file = "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"]."/sap/1";

            $house = $d["c_ca_doctransporte"];
            if ($d["clH_ca_compania"] != $d["ids_ca_nombre"])
                $house .= " - " . utf8_encode($d["clH_ca_compania"]);

            $class = "";
            if ($d["comp_ca_estado"] == "5")
                $class = "row_green";
            else if ($d["comp_ca_estado"] == "6")
                $class = "row_pink";
            else if ($d["comp_ca_estado"] == "8")
                $class = "row_purple";

            $cuenta_forma_pago = "";
            if ($d["cl_ca_propiedades"]) {
                $array = sfToolkit::stringToArray($d["cl_ca_propiedades"]);
                if ($d["tcomp_ca_idempresa"] == "2") {
                    $cuenta_forma_pago = isset($array["cuenta_forma_pago_coltrans"]) ? $array["cuenta_forma_pago_coltrans"] : '';
                } else if ($d["tcomp_ca_idempresa"] == "8")
                    $cuenta_forma_pago = isset($array["cuenta_forma_pago_colotm"]) ? $array["cuenta_forma_pago_colotm"] : '';
                else
                    $cuenta_forma_pago = '';
            }
            $rc = "";
            if ($d["comp_ca_idcomprobante_cruce"] != "" && $d["comp_ca_idcomprobante_cruce"] != null) {
                $idcomp = $d["comp_ca_idcomprobante_cruce"];
                $compro = Doctrine::getTable("InoComprobante")->find($idcomp);
                $fecha = $rest = substr($compro->getCaFchcreado(), 0, -9);
                $tipocruce = $compro->getInoTipoComprobante()->getCaTipo();
                if ($tipocruce == "R")
                    $rc = "<table class='recibocaja' id='intermitente'  ><td>   <div id='foot' style='width:280px; font-weight: bold; text-align: center;'   >RC: #" . $compro->getCaConsecutivo() . "  " . $fecha . "  $" . number_format($compro->getCaValor(), 2, ",", ".") . "</div> </td></table>";
            }


            $valor = ($d["comp_ca_valor"] != "") ? $d["comp_ca_valor"] : (($d["c_ca_valor3"] >= $d["c_ca_valor4"]) ? $d["c_ca_valor3"] : $d["c_ca_valor4"]);
            $this->data[] = array(
                "tipocomprobante" => $d["tcomp_ca_tipo"],
                "titulohouse" => "House", "titulotaza" => "Valor x tasa cambio", "titulocambio" => "Tasa de cambio",
                "idhouse" => $d["c_ca_idhouse"], "idcomprobante" => $d["comp_ca_idcomprobante"],
                "comprobante" => $consecutivo, "fchcomprobante" => $d["comp_ca_fchcomprobante"],
                "cliente" => utf8_encode($d["ids_ca_nombre"]), "doctransporte" => $d["c_ca_doctransporte"],
                "idmoneda" => $d["comp_ca_idmoneda"],
                "valor" => number_format($valor, 0),
                "house" => $house, "valor2" => $d["comp_ca_valor2"],
                "valortcambio" => number_format(( (float) $valor * (float) $d["comp_ca_tcambio"]), 0), "tcambio" => $d["comp_ca_tcambio"],
                "tcambio" => $d["comp_ca_tcambio"],
                /* "valor"=>$d["det_ca_cr"] , */
                "idconcepto" => $d["det_ca_idconcepto"],
                "concepto" => utf8_encode($d["det_ca_idconcepto"] . "-" . $d["s_ca_descripcion"]),
                "iddetalle" => $d["det_ca_iddetalle"], "estado" => $d["comp_ca_estado"],
                "cuentapago" => $cuenta_forma_pago, "idccosto" => $d["tcomp_ca_idccosto"],
                "class" => $class, "file" => $file,
                "footer" => $rc,
                "tooltip" => "Generado:({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})"
            );
        }
        $comprobantes = Doctrine::getTable("InoComprobante")
                ->createQuery("c")
                ->select("c.*,tcomp.* ,ids.*")
                ->innerJoin("c.Ids ids")
                ->innerJoin("c.InoTipoComprobante tcomp")
                ->addWhere("c.ca_idmaster = ? and tcomp.ca_tipo = 'R'", $idmaster)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        foreach ($comprobantes as $compro) {
            $this->data[] = array(
                "idhouse" => "",
                "idcomprobante" => $compro["c_ca_idcomprobante"],
                "comprobante" => "RECIBO DE CAJA " . $compro["tcomp_ca_tipo"] . $compro["tcomp_ca_comprobante"] . "-" . $compro["c_ca_consecutivo"] . " ANTICIPO <br><br><br>",
                "idcliente" => $compro["c_ca_id"],
                "cliente" => utf8_encode($compro["ids_ca_nombre"]),
                "idmoneda" => "",
                "estilo" => "background-color: #FFFFCC !important;",
                "valor" => $compro["c_ca_valor"],
                "house" => "",
                "valortcambio" => "",
                "tcambio" => "",
                "idconcepto" => "",
                "concepto" => "",
                "iddetalle" => "",
                "cuentapago" => "",
                "class" => "", "file" => "",
                "footer" => "",
                "tooltip" => ""
            );
        }


        $this->responseArray = array("success" => true, "root" => $this->data);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor ?
     * @return un objeto JSON con idreferencia , idtransporte e idimpoexpo
     * @param sfRequest $request A request 
     *        idmaster,tipo, impoexpo, transporte, modalidad, idorigen, iddestino,fchreferencia,
     *       fchllegada, proveedor, idagente,piezas, peso, volumen, idreporte, observaciones
     *       (los datos capturados de Formmaster.js)
     * 
     * @date:  2016-03-28
     */
    public function executeGuardarMaster(sfWebRequest $request) {
        $errors = array();
        $conn = Doctrine::getTable("InoMaster")->getConnection();
        $conn->beginTransaction();
        try {

            $idmaster = $request->getParameter("idmaster");
            $tipo = ($request->getParameter("tipo") == "") ? "full" : $request->getParameter("tipo");
            $impoexpo = utf8_decode($request->getParameter("impoexpo"));
            $transporte = utf8_decode($request->getParameter("transporte"));

            $modalidad = utf8_decode($request->getParameter("modalidad"));
            $idorigen = $request->getParameter("idorigen");
            $iddestino = $request->getParameter("iddestino");
            $tipovehiculo = $request->getParameter("tipovehiculo");
            $fchreferencia = $request->getParameter("fchreferencia");
            $fchreferenciaTm = strtotime($fchreferencia);

            $fchllegada = $request->getParameter("ca_fchllegada");
            $fchllegadaTm = strtotime($fchllegada);
            $error = "";

            $q = Doctrine::getTable("InoMaster")
                    ->createQuery("m")
                    ->addWhere("m.ca_master = ?", $request->getParameter("ca_master"));

            if ($idmaster) {
                $q->addWhere("m.ca_idmaster != ?", $idmaster);
            }
            $m = $q->fetchOne();

            if ($m) {
                $error = "El numero de master ya se incluyo en la referencia " . $m->getCaReferencia();
            }

            if ($error == "") {

                if ($idmaster && $idmaster != "0") {
                    $ino = Doctrine::getTable("InoMaster")->find($idmaster);
                    $this->forward404Unless($ino);
                } else {

                    $ino = new InoMaster();
                    $mmRef = Utils::parseDate($fchllegada, "m");
                    $aaRef = substr(Utils::parseDate($fchllegada, "Y"), -2, 2);
                    if (Utils::parseDate($fchllegada, "d") >= "26") {
                        $mmRef = $mmRef + 1;
                        if ($mmRef >= 13) {
                            $mmRef = "01";
                            $aaRef = $aaRef + 1;
                        }
                    }
                    $numRef = InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, $mmRef, $aaRef);

                    $ino->setCaReferencia($numRef);
                    $ino->setCaImpoexpo($impoexpo);
                    $ino->setCaTransporte($transporte);
                }

                if ($impoexpo == Constantes::EXPO) {
                    $datos = array("modalidad" => $request->getParameter("ca_modalidad"),
                        "agencia" => $request->getParameter("idlinea"),
                        "idlinea" => $request->getParameter("idlinea"),
                        "incoterms" => $request->getParameter("ca_incoterms"),
                        "consignatario" => $request->getParameter("ca_consignatario"),
                        "direccion" => $request->getParameter("ca_direccion"),
                        "idg" => $request->getParameter("aplicaidg"),
                        "cliente" => $request->getParameter("cliente"),
                        "contacto" => $request->getParameter("ca_contacto"),
                        "descripcion" => $request->getParameter("ca_descripcion"),
                        "cartaporte" => $request->getParameter("ca_cartaporte"),
                        "fchcargue" => $request->getParameter("ca_fechacargue"),
                    );
                    $ino->setCaDatos(json_encode($datos));
                } else {
                    
                }

                $ino->setCaModalidad($modalidad);
                if (($ino->getCaFchreferencia() == null) || ($ino->getCaFchreferencia() == "")) {
                    $ino->setCaFchreferencia(date("Y-m-d"));
                }
                $ino->setCaOrigen($idorigen);
                $ino->setCaDestino($iddestino);
                $ino->setCaIdlinea($request->getParameter("proveedor"));

                if ($request->getParameter("agente")) {
                    $ino->setCaIdagente($request->getParameter("agente"));
                }
                if ($transporte == "Terrestre") {
                    $datos = json_decode($ino->getCaDatos());
                    $datos->tipovehiculo = $tipovehiculo;
                    $datos = json_encode($datos);
                    $ino->setCaDatos($datos);
                }
                if (($impoexpo == "INTERNO" || $impoexpo == "OTM-DTA") && $transporte == "Terrestre") {//terrestre y empoexpo interno -> modo 6
                    if ($numRef != "")
                        $ino->setCaMaster($numRef);
                } else {
                    $ino->setCaMaster($request->getParameter("ca_master"));
                    $ino->setCaFchmaster($request->getParameter("ca_fchmaster"));
                }



                $ino->setCaFchsalida($request->getParameter("ca_fchsalida"));
                $ino->setCaFchllegada($request->getParameter("ca_fchllegada"));
                $ino->setCaMotonave(utf8_decode($request->getParameter("ca_motonave")));

                if ($request->getParameter("ca_piezas") != "")
                    $ino->setCaPiezas($request->getParameter("ca_piezas"));
                else
                    $ino->setCaPiezas(0);

                if ($request->getParameter("ca_peso") != "")
                    $ino->setCaPeso($request->getParameter("ca_peso"));
                else
                    $ino->setCaPeso(0);

                if ($request->getParameter("ca_volumen") != "")
                    $ino->setCaVolumen($request->getParameter("ca_volumen"));
                else
                    $ino->setCaVolumen(0);


                $ino->setCaObservaciones(utf8_decode($request->getParameter("ca_observaciones")));
                $ino->save();


                if ($idmaster > 0 && $request->getParameter("idreporte") != "" /* && $impoexpo==Constantes::EXPO */) {


                    $reporte = Doctrine::getTable("Reporte")->find($request->getParameter("idreporte"));

                    $house = new InoHouse();
                    $house->setCaIdmaster($ino->getCaIdmaster());
                    $house->setCaIdreporte($request->getParameter("idreporte"));

                    $house->setCaIdcliente($reporte->getCliente()->getCaIdcliente());
                    $house->setCaVendedor($reporte->getCaLogin());
                    $house->setCaNumorden($reporte->getCaOrdenClie());
                    $status = $reporte->getUltimoStatus();

                    if ($status) {
                        $piezas = explode("|", $status->getCaPiezas());
                        $house->setCaNumpiezas(($request->getParameter("ca_piezas") != "") ? $request->getParameter("ca_piezas") : ($piezas[0] ? $piezas[0] : 0));
                        $house->setCaMpiezas($piezas[1] ? $piezas[1] : "");

                        $peso = explode("|", $status->getCaPeso());
                        $house->setCaPeso(($request->getParameter("peso") != "") ? $request->getParameter("peso") : ((isset($peso[0])) ? $peso[0] : 0));

                        $volumen = explode("|", $status->getCaVolumen());
                        $house->setCaVolumen(($request->getParameter("ca_volumen") != "") ? $request->getParameter("ca_volumen") : ((isset($volumen[0])) ? $volumen[0] : 0));
                        $house->setCaFchdoctransporte(null);
                        $house->setCaDoctransporte($status->getCaDoctransporte());
                    } else {
                        $house->setCaNumpiezas(($request->getParameter("ca_piezas") != "") ? $request->getParameter("ca_piezas") : 0);
                        $house->setCaPeso(($request->getParameter("peso") != "") ? $request->getParameter("peso") : 0);
                        $house->setCaVolumen(($request->getParameter("ca_volumen") != "") ? $request->getParameter("ca_volumen") : 0);
                    }
                    $house->save();
                }

                $conn->commit();
                $this->responseArray = array("success" => true, "idreferencia" => $numRef, "idmaster" => $ino->getCaIdmaster(),
                    'idtransporte' => utf8_encode($transporte), 'idimpoexpo' => utf8_encode($impoexpo), 'modalidad' => $modalidad);
                $this->setTemplate("responseTemplate");
            } else {

                $this->responseArray = array("success" => false, "errorInfo" => $error);
                $this->setTemplate("responseTemplate");
            }
        } catch (Exception $e) {

            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            $this->setTemplate("responseTemplate");
        }
    }

    /**
     * @autor ?
     * @return un objeto JSON con los datos de la tabla inomaster filtrados por un idmaster
     * @param sfRequest $request A request 
     *        idmaster : entero identificador de inomaster
     * 
     * @date:  2016-03-28
     */
    public function executeDatosMaster(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        if ($idmaster != "0") {
            $this->forward404Unless($idmaster);

            $ino = Doctrine::getTable("InoMaster")->find($idmaster);

            $this->forward404Unless($ino);

            try {
                $datos = json_decode(utf8_encode($ino->getCaDatos()));
                $data["idmaster"] = $idmaster;
                $data["aplicaidg"] = utf8_encode($datos->idg);
                $data["ca_idlinea"] = utf8_encode($ino->getCaIdlinea());
                if ($datos->agencia) {
                    $proveedor = Doctrine::getTable("IdsProveedor")->find(utf8_encode($datos->agencia));
                    $data["ca_linea"] = utf8_encode($proveedor->getIds()->getCaNombre());
                }

                $data["ca_idcliente"] = utf8_encode($datos->cliente);
                if ($datos->cliente) {
                    $cliente = Doctrine::getTable("Cliente")->find(utf8_encode($datos->cliente));
                    $data["ca_compania"] = utf8_encode($cliente->getCaCompania());
                }

                $data["ca_contacto"] = utf8_encode($datos->contacto);
                $data["ca_direccion"] = utf8_encode($datos->direccion);
                $data["fchcargue"] = utf8_encode($datos->fchcargue);
                $data["ca_incoterms"] = utf8_encode($datos->incoterms);

                $caso = "CU011";
                $datomod = ParametroTable::retrieveByCaso($caso, null, null, $datos->modalidad);

                $data["id_modalidad"] = $datos->modalidad;
                if ($datos->modalidad) {
                    $data["ca_modalidad"] = utf8_encode($datomod[0]->getCaValor());
                }
                $data["cartaporte"] = utf8_encode($datos->cartaporte);
                $data["ca_descripcion"] = utf8_encode($datos->descripcion);
                $data["ca_consignatario"] = utf8_encode($datos->consignatario);
                $data["idlinea"] = utf8_encode($datos->idlinea);
                if ($datos->idlinea) {
                    $agencia = Doctrine::getTable("Ids")->find(utf8_encode($datos->idlinea));
                    $data["agencia"] = utf8_encode($agencia->getCaNombre());
                }

                $data["impoexpo"] = utf8_encode($ino->getCaImpoexpo());
                $data["transporte"] = utf8_encode($ino->getCaTransporte());
                $data["modalidad"] = utf8_encode($ino->getCaModalidad());

                if ($data['modalidad'] != null && $data['modalidad'] != "") {
                    $data['modalidadnoeditable'] = true;
                } else {
                    $data['modalidadnoeditable'] = false;
                }


                $data["fchreferencia"] = utf8_encode($ino->getCaFchreferencia());
                $data["idorigen"] = utf8_encode($ino->getCaOrigen());
                $ciudadorigen = Doctrine::getTable('Ciudad')->createQuery('c')
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
                        ->innerJoin('c.Trafico t')
                        ->addWhere('c.ca_idciudad = ?', $ino->getCaDestino())
                        ->fetchOne();
                if ($ciudadestino) {
                    $data['destino'] = utf8_encode($ciudadestino->getCaCiudad());
                }

                //
                if ($data['iddestino'] != null && $data['iddestino'] != "") {
                    $data['destinonoeditable'] = true;
                } else {
                    $data['destinonoeditable'] = false;
                }

                $data["proveedor"] = utf8_encode($ino->getCaIdlinea());
                $data["linea"] = utf8_encode($ino->getIdsProveedor()->getIds()->getCaNombre());


                $data["idagente"] = utf8_encode($ino->getCaIdagente());
                $data["nombre"] = utf8_encode($ino->getIdsAgente()->getIds()->getCaNombre());
                $data["ca_master"] = utf8_encode($ino->getCaMaster());
                $data["ca_fchmaster"] = utf8_encode($ino->getCaFchmaster());
                $data["ca_motonave"] = utf8_encode($ino->getCaMotonave());
                $data["ca_fchsalida"] = utf8_encode($ino->getCaFchsalida());
                $data["ca_fchllegada"] = utf8_encode($ino->getCaFchllegada());
                $data["ca_piezas"] = utf8_encode($ino->getCaPiezas());
                $data["ca_peso"] = utf8_encode($ino->getCaPeso());
                $data["ca_volumen"] = utf8_encode($ino->getCaVolumen());
                $data["ca_observaciones"] = utf8_encode($ino->getCaObservaciones());
                $data["anulado"] = utf8_encode($ino->getCaUsuanulado());

                $datos = json_decode($ino->getCaDatos());
                $data["tipovehiculo"] = $datos->tipovehiculo;

                $this->responseArray = array("success" => true, "data" => $data);
            } catch (Exception $e) {
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        } else {
            $this->responseArray = array("success" => true, "data" => '');
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarFactura(sfWebRequest $request) {
        //try {
        $idcomprobante = $request->getParameter("idcomprobante");
        $idtipocomprobante = $request->getParameter("idtipocomprobante");

        $idsucursal = $request->getParameter("idsucursal");

        $sucursal = Doctrine::getTable("IdsSucursal")->find($idsucursal);

        if ($idcomprobante) {
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            /* $comprobante = new InoComprobante();
              $comprobante->getInoDetalle() */
            $this->forward404Unless($comprobante);
            $idcliente_old = $comprobante->getCaId();
        } else {
            $comprobante = new InoComprobante();
        }
        $comprobante->setCaIdtipo($idtipocomprobante);

        $conn = $comprobante->getTable()->getConnection();
        $conn->beginTransaction();

        $idhouse = $request->getParameter("idhouse");
        $house = Doctrine::getTable("InoHouse")->find($idhouse);


        $comprobante->setCaIdsucursal($idsucursal);

        $comprobante->setCaId($sucursal->getIds()->getCaId());
        $comprobante->setCaIdhouse($idhouse);
        //$comprobante->setCaValor( $valor );
        $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));
        $comprobante->setCaTcambio($request->getParameter("tcambio"));

        $comprobante->setProperty("bienestrans", $request->getParameter("bienestrans"));
        $comprobante->setProperty("detalle", $request->getParameter("detalle"));
        $comprobante->setProperty("anexos", $request->getParameter("anexos"));
        $comprobante->setProperty("idcontacto", $request->getParameter("idcontacto"));

        $ccosto = Doctrine::getTable("InoCentroCosto")
                ->createQuery("c")
                ->select("*")
                ->where('ca_impoexpo = ? and ca_transporte = ? and ca_idsucursal is null ', array($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo(), $comprobante->getInoHouse()->getInoMaster()->getCaTransporte()/*, $comprobante->getInoTipoComprobante()->getCaIdsucursal()*/))
                ->fetchOne();

        $comprobante->setCaIdccosto($ccosto->getCaIdccosto());
        $comprobante->save($conn);


        $conn->commit();

        $this->responseArray = array("success" => "true", "idcomprobante" => $comprobante->getCaIdcomprobante());
        // } catch (Exception $e) {
        // $conn->rollback();
        //  $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        //}
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarGridFacturacion(sfWebRequest $request) {
        $datos = $request->getParameter("datos");

        $datos_det = json_decode($datos);

        $errorInfo = "";
        $ids = array();

        $inoDetalle = new InoDetalle();
        $conn = $inoDetalle->getTable()->getConnection();
        $conn->beginTransaction();

        //try {
        $comprobante = $tipoComprobante = null;
        $total = 0;
        $impuestos = array();
        $idcomprobante = 0;
        foreach ($datos_det as $t) {
            if ($t->concepto == "" || $t->valor == "")
                continue;
            if ($comprobante == null) {
                $comprobante = Doctrine::getTable("InoComprobante")->find($t->idcomprobante);
                $this->forward404Unless($comprobante);
                $idcomprobante = $t->idcomprobante;
                $tipoComprobante = $comprobante->getInoTipoComprobante();
            }

            $inoDetalle = Doctrine::getTable("InoDetalle")->find($t->iddetalle);
            if (!$inoDetalle)
                $inoDetalle = new InoDetalle();

            $inoDetalle->setCaIdcomprobante($t->idcomprobante);
            if ($tipoComprobante->getCaTipo() == "C")
                $inoDetalle->setCaDb($t->valor);
            else
                $inoDetalle->setCaCr($t->valor);
            $inoDetalle->setCaIdconcepto(is_numeric($t->concepto) ? $t->concepto : $t->idconcepto );
            $inoDetalle->setCaId($comprobante->getCaId());
            $inoDetalle->save($conn);

            $ids[] = $t->id;
            $ids_reg[] = $inoDetalle->getCaIddetalle();
            $valor += $t->valor;
        }
        $conn->commit();
        $this->responseArray = array("errorInfo" => "", "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
        // } catch (Exception $e) {
        //    $errorInfo.=$e->getMessage() . "<br>";
        //    $this->responseArray = array("errorInfo" => $errorInfo, "success" => false);
        //echo $e->getMessage();
        //}
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarGridFacturacion(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        try {
            $conn = Doctrine::getTable("InoDetalle")->getConnection();
            $conn->beginTransaction();
            foreach ($datos as $dato) {
                $inoDetalle = Doctrine::getTable("InoDetalle")
                        ->createQuery("i")
                        ->addWhere("i.ca_idetalle = ? ", array($dato->iddetalle))
                        ->fetchOne();
                if ($inoDetalle) {
                    $inoDetalle->delete();
                }
            }
            $conn->commit();
            $this->responseArray = array("errorInfo" => "error", "success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("errorInfo" => "error", "success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    public function executeDatosSobreventa(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");
        $idinocosto = $request->getParameter("idinocosto");

        $utils = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("h.ca_doctransporte,u.ca_idutilidad,h.ca_idhouse,c.ca_idinocosto,u.ca_valor")
                ->innerJoin("h.InoMaster m WITH h.ca_idmaster=m.ca_idmaster")
                ->innerJoin("m.InoCosto c WITH c.ca_idinocosto=?", $idinocosto)
                ->leftJoin("h.InoUtilidad u WITH u.ca_idinocosto=?", $idinocosto)
                ->where("h.ca_idmaster = ?", $idmaster)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        $this->responseArray = array("success" => true, "root" => $utils, "total" => count($utils));
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarGridSobreventa(sfWebRequest $request) {


        $datos = $request->getParameter("datos");

        $datos_det = json_decode($datos);

        $errorInfo = "";
        $ids = array();

        $inoUtilidad = new InoUtilidad();
        $conn = $inoUtilidad->getTable()->getConnection();
        $conn->beginTransaction();

        //try
        {

            foreach ($datos_det as $t) {
                if (($t->doctransporte == "" || $t->doctransporte == "null") ||
                        ($t->idhouse == "" || $t->idhouse == "null") ||
                        ($t->valor == "" || $t->valor == "null")
                )
                    continue;
                if ($t->idutilidad == "null" || $t->idutilidad == "") {
                    $inoUtilidad = new InoUtilidad();
                    $inoUtilidad->setCaIdhouse($t->idhouse);
                    $inoUtilidad->setCaIdinocosto($t->idinocosto);
                    //$inoUtilidad->setCaIdinocosto()
                } else {
                    $inoUtilidad = Doctrine::getTable("InoUtilidad")->find($t->idutilidad);
                }

                $inoUtilidad->setCaValor($t->valor);
                $inoUtilidad->save($conn);

                $ids[] = $t->id;
                $ids_reg[] = $inoUtilidad->getCaIdutilidad();
            }

            $conn->commit();
        }
        // catch(Exception $e)
        //  {
        //  $errorInfo.=$e->getMessage()."<br>";
        //echo $e->getMessage();
        //  } 

        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * @return un objeto JSON con los eventos (fechas, documentos) correspondientes a un caso de uso espec?fico 
     * y a una referencia especif?ca.
     * @param sfRequest $request A request 
     *       caso_uso: caso de uso en el cual se buscan los eventos
     *      referencia: identificador de referencia
     *              
     * @date:  2016-03-28
     */
    public function executeDatosEventos(sfWebRequest $request) {
        $caso_uso = $request->getParameter("caso_uso");

        $datos = array();
        $referencia = $request->getParameter("referencia");
        $con = Doctrine_Manager::getInstance()->connection();

        $q1 = ParametroTable::retrieveByCaso("CU011", null, null, $caso_uso);



        $sql = "select ca_idconfig from control.tb_config where ca_param = '" . $q1[0]->getCaValor2() . "'";
        $rs = $con->execute($sql);
        $ca_config = $rs->fetchAll();

        $sql = "select * from control.tb_config_values cv 
                left join tb_expo_tracking et 
                ON (cv.ca_ident = et.ca_idevento and  
                et.ca_referencia = '$referencia' ) where cv.ca_idconfig =" . $ca_config[0]["ca_idconfig"] . " order by ca_ident";

        $rs = $con->execute($sql);
        $eventos = $rs->fetchAll();
        $eve = "";
        foreach ($eventos as $evento) {

            if ($evento["ca_realizado"] == "1") {
                $evento["ca_realizado"] = "SI";
            } else if ($evento["ca_realizado"] == "0") {
                $evento["ca_realizado"] = "NO";
            }
            $tipoespecial = "";
            if (utf8_encode($evento["ca_value"]) == "SAE") {
                $tipoespecial = "SAE";
            } else if (utf8_encode($evento["ca_value"]) == "DEX") {
                $tipoespecial = "DEX";
            }

            $stringdocs = "";
            $eve .= $evento["ca_idevento"];

            if ($evento["ca_idevento"] == 9 || $evento["ca_idevento"] == 10) {

                $documentos = Doctrine::getTable("ExpoAedex")
                        ->createQuery("m")
                        ->addWhere("m.ca_referencia = ? and ca_idevento = ?", array($referencia, $evento["ca_idevento"]))
                        ->execute();

                if ($documentos) {
                    foreach ($documentos as $document) {
                        $stringdocs .= "Doc: " . $document->getCaIddocumento() . " Fecha: " . $document->getCaFechadoc() . " | ";
                    }
                }
            }
            $datos[] = array("idevento" => $evento["ca_ident"],
                "evento" => utf8_encode($evento["ca_value"]),
                "fchevento" => $evento["ca_fchevento"],
                "opcion" => $evento["ca_realizado"],
                "tipoespecial" => $tipoespecial,
                "documentos" => utf8_encode($stringdocs));
        }

        $this->responseArray = array("eve" => $eve, "success" => true, "root" => $datos);
        $this->setTemplate("responseTemplate");
    }

    public function executeAnularReferencia(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $conn = Doctrine::getTable("IdsCliente")->getConnection();
        $conn->beginTransaction();

        try {
            $ino = Doctrine::getTable("InoMaster")->find($idmaster);
            if ($ino) {
                $ino->setCaFchanulado(date("Y-m-d H:i:s"));
                $ino->setCaUsuanulado($this->getUser()->getUserId());
                $ino->setCaMotivoanulado($request->getParameter("motivo"));
                $ino->save();
                $conn->commit();
                $this->responseArray = array("success" => true, "idreferenca" => $ino->getCaReferencia());
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "error" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * @return retorna success cuando se almacena correctamente la informaci?n
     * @param sfRequest $request A request 
     *      datosGrid : json con todos los elementos de la grilla de eventos
     *              
     * @date:  2016-03-28
     */
    public function executeGuardarEventos(sfWebRequest $request) {

        $gridEventos = $request->getParameter("datosGrid");
        $gridEventos = json_decode($gridEventos);
        $referencia = $request->getParameter("referencia");

        $conn = Doctrine::getTable("IdsCliente")->getConnection();
        $conn->beginTransaction();

        try {

            foreach ($gridEventos as $evento) {
                $ev = Doctrine::getTable("ExpoTracking")
                        ->createQuery("m")
                        ->addWhere("m.ca_referencia = ? and m.ca_idevento = ?", array($referencia, $evento->idevento))
                        ->fetchOne();
                if (!$ev) {
                    $ev = new ExpoTracking();
                    $ev->setCaReferencia($referencia);
                    $ev->setCaIdevento($evento->idevento);
                }
                if ($evento->opcion == "SI") {
                    $ev->setCaRealizado(1);
                } else {
                    $ev->setCaRealizado(0);
                }

                $ev->setCaUsuario($this->getUser()->getUserId());
                $ev->setCaFchevento($evento->fchevento);
                $ev->save();
            }
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "error" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * @return retorna JSON de todos los documentos para eventos SAE y DEX
     * @param sfRequest $request A request 
     *     referencia: entero identificador de referencia a la cual se le almacenar?n
     *      los eventos.
     *      idevento: entero identificador del evento del cual se buscan los eventos SAE y DEX
     * @date:  2016-03-28
     */
    public function executeDatosEventosSAEDEX(sfWebRequest $request) {
        $referencia = $request->getParameter("referencia");
        $idevento = $request->getParameter("idevento");
        $eventos = Doctrine::getTable("ExpoAedex")
                ->createQuery("m")
                ->addWhere("ca_idevento = ? and m.ca_referencia = ? ", array($idevento, $referencia))
                ->execute();
        $datos = array();
        foreach ($eventos as $evento) {
            $datos[] = array("documento" => $evento->getCaIddocumento(),
                "fchelaboracion" => $evento->getCaFechadoc(),
                "fchremision" => $evento->getCaFecharem());
        }
        $this->responseArray = array("success" => true, "root" => $datos);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * @return retorna success cuando se almacena correctamente la informaci?n
     * @param sfRequest $request A request 
     *      datos : json con todos los elementos de la grilla de eventos
     *     referencia: entero identificador de referencia a la cual se le almacenar?n
     *      los eventos.
     * Descripci?n : almacena los eventos SAE y DEX.
     *              
     * @date:  2016-03-28
     */
    public function executeGuardarEventosSAEDEX(sfWebRequest $request) {
        $referencia = $request->getParameter("referencia");

        $gridEventos = $request->getParameter("datos");
        $gridEventos = json_decode($gridEventos);
        $conn = Doctrine::getTable("ExpoAedex")->getConnection();
        $conn->beginTransaction();
        try {
            foreach ($gridEventos as $evento) {
                $eventoDEX = new ExpoAedex();
                $eventoDEX->setCaReferencia($referencia);
                $eventoDEX->setCaIdevento($evento->idevento);
                $eventoDEX->setCaIddocumento($evento->documento);
                $eventoDEX->setCaFechadoc($evento->fchelaboracion);
                $eventoDEX->setCaFecharem($evento->fchremision);
                $eventoDEX->save();
            }
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("errorInfo" => "No pueden haber documentos repetidos", "sqlerror" => $e->getMessage());
            $conn->rollback();
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarGridHouse(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idhouse"));
        $idhouse = $request->getParameter("idhouse");
        $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
        $this->forward404Unless($inoHouse);

        try {
            $inoHouse->delete();
            $this->responseArray = array("success" => true, "errorInfo" => "");
        } catch (Exception $e) {
            $this->responseArray = array("success" => true, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * @return retorna success cuando se elimina correctamente la informaci?n
     * @param sfRequest $request A request     *     
     *     referencia: entero identificador de referencia a la cual se le eliminan
     *      los eventos.
     * fecha: fecha de creaci?n del documento
     * fecharemision: fecha de remisi?n del documento
     * documento: nombre del documento
     * idevento: entero identificicador del evento.
     * Descripci?n : elimina los eventos SAE y DEX.
     *              
     * @date:  2016-03-28
     */
    public function executeEliminardocumentosSAEDEX(sfWebRequest $request) {
        $referencia = $request->getParameter("referencia");
        $fecha = $request->getParameter("fecha");
        $fecharemision = $request->getParameter("fecharemision");
        $documento = $request->getParameter("documento");
        $idevento = $request->getParameter("idevento");


        $conn = Doctrine::getTable("ExpoAedex")->getConnection();
        $conn->beginTransaction();
        try {
            $eventoDEX = Doctrine::getTable("ExpoAedex")
                    ->createQuery("m")
                    ->addWhere("m.ca_referencia = ? and m.ca_fechadoc = ? and m.ca_iddocumento = ? and ca_idevento = ? ", array($referencia, $fecha, $documento, $idevento))
                    ->fetchOne();
            if ($eventoDEX) {
                $eventoDEX->delete();
            }
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => true);
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosConceptosFact(sfWebRequest $request) {
        $this->data = array();
        if ($request->getParameter("idcomprobante") > 0) {
            $idcomprobante = $request->getParameter("idcomprobante");
            $this->forward404Unless($idcomprobante);
            $q = Doctrine::getTable("InoHouse")
                    ->createQuery("c")
                    ->select("c.ca_idhouse,  c.ca_idcliente ,c.ca_doctransporte, 
                            ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,cl.ca_propiedades, 
                            comp.ca_idcomprobante, comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,
                            m.ca_nombre,s.ca_concepto_esp,det.ca_iddetalle,comp.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,
                            clH.ca_idcliente,clH.ca_compania,det.*")
                    ->innerJoin("c.InoComprobante comp")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("ids.IdsCliente cl")
                    ->innerJoin("c.Cliente clH")
                    ->innerJoin("comp.InoTipoComprobante tcomp")
                    ->leftJoin("comp.InoDetalle det WITH det.ca_idconcepto is not null AND ( (ca_cr>0 AND tcomp.ca_tipo='F') or (ca_db>0 AND tcomp.ca_tipo<>'F' ) )")
                    ->leftJoin("comp.Ids fact")
                    ->leftJoin("comp.Moneda m")
                    ->leftJoin('det.InoMaestraConceptos s  ')
                    ->where("comp.ca_idcomprobante = $idcomprobante  ")
                    ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            $datos = $q->execute();

            foreach ($datos as $d) {
                $consecutivo = ($d["tcomp_ca_tipo"] == "F") ? "FACTURA " : (($d["tcomp_ca_tipo"] == "C") ? "<span class='row_yellow'>NOTA CREDITO</span>" : "");
                $consecutivo .= ($d["comp_ca_consecutivo"] == "") ? " Sin Generar - " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
                $consecutivo .= " - " . utf8_encode($d["ids_ca_nombre"]) . " - " . $d["c_ca_doctransporte"];

                if ($d["clH_ca_compania"] != $d["ids_ca_nombre"])
                    $consecutivo .= " - " . utf8_encode($d["clH_ca_compania"]);


                if ($d["comp_ca_fchgenero"] != "" && $d["comp_ca_usugenero"] != "")
                    $consecutivo .= "({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})";

                $class = "";
                if ($d["comp_ca_estado"] == "5") {
                    $class = "row_green";
                } else if ($d["comp_ca_estado"] == "6") {
                    $class = "row_pink";
                } else if ($d["comp_ca_estado"] == "8") {
                    $class = "row_purple";
                }
                $cuenta_forma_pago = "";
                if ($d["cl_ca_propiedades"]) {
                    $array = sfToolkit::stringToArray($d["cl_ca_propiedades"]);
                    if ($d["tcomp_ca_idempresa"] == "2") {
                        $cuenta_forma_pago = isset($array["cuenta_forma_pago_coltrans"]) ? $array["cuenta_forma_pago_coltrans"] : '';
                    } else if ($d["tcomp_ca_idempresa"] == "8")
                        $cuenta_forma_pago = isset($array["cuenta_forma_pago_colotm"]) ? $array["cuenta_forma_pago_colotm"] : '';
                    else
                        $cuenta_forma_pago = '';
                }

                $this->data[] = array(
                    "idhouse" => $d["c_ca_idhouse"], "idcomprobante" => $d["comp_ca_idcomprobante"],
                    "comprobante" => $consecutivo, "fchcomprobante" => $d["comp_ca_fchcomprobante"],
                    "cliente" => $d["cl_ca_nombre"], "doctransporte" => $d["c_ca_doctransporte"],
                    "idmoneda" => $d["comp_ca_idmoneda"], "moneda" => $d["m_ca_nombre"],
                    "valor" => ($d["det_ca_cr"] > 0 ? $d["det_ca_cr"] : $d["det_ca_db"]),
                    "idconcepto" => $d["det_ca_idconcepto"],
                    "concepto" => utf8_encode($d["det_ca_idconcepto"] . "-" . $d["s_ca_concepto_esp"]),
                    "iddetalle" => $d["det_ca_iddetalle"], "estado" => $d["comp_ca_estado"],
                    "cuentapago" => $cuenta_forma_pago, "idccosto" => $d["tcomp_ca_idccosto"],
                    "class" => $class
                );
            }
            $sql = $q->getSqlQuery();
        }
        else {
            $this->data[] = array(
                "idhouse" => " ",
                "comprobante" => " ",
                "cliente" => " ",
                "idmoneda" => " ",
                "valor" => " ",
                "idconcepto" => " ",
                "concepto" => " ",
                "iddetalle" => " ",
                "cuentapago" => " ",
                "class" => " "
            );
            $sql = "";
        }

        $this->responseArray = array("success" => true, "root" => $this->data, "total" => count($this->data), "debug" => $sql);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosFormFactura(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("idcomprobante"));
        $idcomprobante = $request->getParameter("idcomprobante");
        $inoComprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        $this->forward404Unless($inoComprobante);

        $data = array();

        $data["idcomprobante"] = $idcomprobante;
        $data["idhouse"] = $inoComprobante->getCaIdhouse();
        $data["consecutivo"] = $inoComprobante->getCaConsecutivo();
        $data["fecha"] = $inoComprobante->getCaFchcomprobante();
        $data["idtipocomprobante"] = $inoComprobante->getCaIdtipo();

        $data["idcliente"] = $inoComprobante->getCaId();
        $data["cliente"] = utf8_encode($inoComprobante->getIds()->getCaNombre());

        $data["idsucursal"] = $inoComprobante->getCaIdsucursal();
        $data["ciudad"] = utf8_encode($inoComprobante->getIdsSucursal()->getCiudad()->getCaCiudad());

        $data["tcambio"] = $inoComprobante->getCaTcambio();
        $data["idmoneda"] = $inoComprobante->getCaIdmoneda();
        $data["moneda"] = $inoComprobante->getMoneda()->getCaNombre();
        $data["observaciones"] = utf8_encode($inoComprobante->getCaObservaciones());

        $data["bienestrans"] = utf8_encode($inoComprobante->getProperty("bienestrans"));
        $data["detalle"] = utf8_encode($inoComprobante->getProperty("detalle"));
        $data["anexos"] = utf8_encode($inoComprobante->getProperty("anexos"));
        $data["idcontacto"] = utf8_encode($inoComprobante->getProperty("idcontacto"));

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGenerarComprobante(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $ncomprobante = $request->getParameter("ncomprobante");
        $errorInfo = $info = "";
        $ids = array();

        $inoDetalle = new InoDetalle();

        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        $transout = new IntTransaccionesOut();
        $idinttipo = 7;
        switch ($comprobante->getInoTipoComprobante()->getCaTipo()) {
            case "F":
                $idinttipo = 7;
                break;
            case "C":
                $idinttipo = 13;
                break;
        }
        $idtransaccion = IntTransaccionesOut::procesarTransacciones($idinttipo, $idcomprobante);
        
        if ($idtransaccion!="" && $idtransaccion > 0) {            
            try {                
                $resul = IntTransaccionesOut::enviarWs($idtransaccion);
                //print_r($resul);
                $success = true;
            } catch (Exception $e) {         
                $resul = $e->getTraceAsString();
                $success = false;
            }            
        }
        else
        {
            $success = false;
            $resul= $idtransaccion;
        }

        $this->responseArray = array("success" => $success, "resul" => $resul);
        $this->setTemplate("responseTemplate");
    }

    public function EnviarSiigoConect($idcomprobante) {

        //$idcomprobante = $request->getParameter("idcomprobante");
        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
        $comproSiigo = Doctrine::getTable("SiigoComprobante")->find($idcomprobante);
        $consecutivo = $comprobante->getCaConsecutivo();
        $comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
        $comprobante->save($conn);

        $tipoComprobante = $comprobante->getInoTipoComprobante();

        ProjectConfiguration::registerZend();

        //$client = new Zend_Soap_Client( "http://10.192.1.97:8000/WebService2/Service1.asmx?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));        ///WebService2/Service1.asmx/HelloWorld
        $config = sfConfig::get('app_soap_siigo');


        //temporal, quitar cuando se ponga en produccion.
        $client = new Zend_Soap_Client($config["wsdl_uri"], array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2));
        $result = $client->actualiza(
                array(
                    a => date("Y", strtotime($comproSiigo->getFechaCont())),
                    t => $tipoComprobante->getCaTipo(),
                    nt => $tipoComprobante->getCaComprobante(),
                    c => $consecutivo,
                    d => $tipoComprobante->getCaIdempresa()));


        $comproSiigo = Doctrine::getTable("SiigoComprobante")->find($idcomprobante);

        $indincor = $comproSiigo->getIndIncorpCont();
        $errorsiigo = $comproSiigo->getCdErrsiigoCont();

        if (($indincor == "+6" || $indincor == "6") && $errorsiigo == "26") {
            //$comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
            //$comprobante->save($conn);
            $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            $comprobante->save($conn);
        } else if ($indincor == "+5" || $indincor == "5") {
            $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            $comprobante->save($conn);
        }

        return array("success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result, "info" => $info);
        //$this->responseArray = array("success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result, "info" => $info);
        //$this->setTemplate("responseTemplate");
    }

    public function executeEnviarSiigoConect(sfWebRequest $request) {

        $idcomprobante = $request->getParameter("idcomprobante");

        $this->responseArray = $this->EnviarSiigoConect($idcomprobante);


        //$this->responseArray = array("success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result, "info" => $info);
        $this->setTemplate("responseTemplate");
    }

    public function executeAnularComprobante(sfWebRequest $request) {
        try {
            $idcomprobante = $request->getParameter("idcomprobante");
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);


            $transout = new IntTransaccionesOut();
            $this->getRequest()->setParameter('idtipo', "10");
            $this->getRequest()->setParameter('indice1', $idcomprobante);

            $idtransaccion = sfContext::getInstance()->getController()->getPresentationFor('integraciones', 'procesarTransacciones');
            if ($idtransaccion > 0) {
                $resul = integracionesActions::enviarWs($idtransaccion);
                if ($resul == "Ok") {
                    $comprobante->anular($this->getUser()->getUserId());
                }
            }


            //InoComprobante::TRANSFERIDO;
            $this->responseArray = array("success" => "true", "errorInfo" => "");
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * @return un objeto JSON con los datos de cierre y liquidacion de una referencia
     * @param sfRequest $request A request 
     *        idmaster     * 
     * @date:  2016-04-25
     */
    public function executeDatosCierre(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $ino = Doctrine::getTable("InoMaster")->find($idmaster);
        $data = array();

        $data["creado"] = trim(utf8_encode($ino->getCaUsucreado() . " " . $ino->getCaFchcreado()));
        $data["actualizado"] = trim(utf8_encode($ino->getCaUsuactualizado() . " " . $ino->getCaFchactualizado()));

        $data["cerrado"] = trim(utf8_encode($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
        $data["liquidado"] = trim(utf8_encode($ino->getCaUsuliquidado() . " " . $ino->getCaFchliquidado()));

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * @return un objeto JSON con la variable succes representando exito o falla en la transaccion
     * @param sfRequest $request A request 
     *        datos : JSON con todos los elementos del house correspondiente a una referencia especifica  * 
     * @date:  2016-04-25
     */
    public function executeGuardarGridHouse($request) {
        $datos = $request->getParameter("datos");

        $houses = json_decode($datos);
        $idshouse = array();
        $ids = array();
        //try {
        foreach ($houses as $c) {

            if ($c->idhouse) {
                $house = Doctrine::getTable("InoHouse")->find($c->idhouse);
                $this->forward404Unless($house);
            } else {
                $house = new InoHouse();
                $house->setCaIdmaster($c->idmaster);
            }
            if ($c->idreporte != "") {
                $house->setCaIdreporte($c->idreporte);
            }

            if ((!$c->doctransporte == "") && (!$c->idcliente == "")) {
                $house->setCaDoctransporte($c->doctransporte);
                $house->setCaFchdoctransporte($c->fchdoctransporte);
                $house->setCaIdtercero($c->idtercero);
                $house->setCaTercero(utf8_encode($c->tercero));
                $house->setCaIdcliente($c->idcliente);
                $house->setCaVendedor($c->vendedor);
                $house->setCaNumorden($c->numorden);
                $house->setCaNumpiezas($c->numpiezas);
                $house->setCaPeso($c->peso);
                $house->setCaVolumen($c->volumen);
                if ($c->idbodega > 0)
                    $house->setCaIdbodega($c->idbodega);

                //echo "<pre>";print_r($c->equipos);echo "</pre>";
                $houseSea = $house->getInoHouseSea();
                if ($houseSea->count() < 1)
                    $houseSea = new InoHouseSea();
                $datos = json_decode($houseSea->getCaDatos());
                //$equipos=$c->equipos;
                $datos->equipos = $c->equipos;
                $houseSea->setCaDatos(json_encode($datos));

                $houseSea->setCaContinuacion($c->continuacion);
                $houseSea->setCaContinuacionDest($c->destinofinal);


                $house->setInoHouseSea($houseSea);

                $house->save();
                $ids[] = $c->null;
            }
            $idshouse[] = $house->getCaIdhouse();
        }
        $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "idhouse" => implode(",", $idshouse), "success" => true);
        /* } catch (Exception $e) {
          $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
          } */

        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * Liquida una referencia llenanado los campos usuliquidado y fchliquidado con el usuario de la sesion
     * @return un objeto JSON con la variable succes representando exito o falla en la transaccion
     * @param sfRequest $request A request 
     *        idmaster
     *    opcion: liquidar o deshacer liquidacion
     * @date:  2016-04-25
     */
    public function executeLiquidarReferencia(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $opcion = $request->getParameter("opcion");
        $conn = Doctrine::getTable("InoMaster")->getConnection();
        $conn->beginTransaction();

        try {
            $ino = Doctrine::getTable("InoMaster")->find($idmaster);
            if ($opcion == "Liquidar") {
                $ino->setCaUsuliquidado($this->getUser()->getUserId());
                $ino->setCaFchliquidado(date("Y-m-d H:i:s"));
            } else {
                $ino->setCaUsuliquidado(null);
                $ino->setCaFchliquidado(null);
            }
            $ino->save();
            $conn->commit();
            $this->responseArray = array("success" => true, "usuarioLiquidado" => ($ino->getCaUsuliquidado() . " " . $ino->getCaFchliquidado()));
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * cierra una referencia llenanado los campos uducerrado y fchcerrado con el usuario de la sesion
     * @return un objeto JSON con la variable succes representando exito o falla en la transaccion
     * @param sfRequest $request A request 
     *        idmaster
     *    opcion: abrir o cerrar referencia
     * @date:  2016-04-25
     */
    public function executeCerrarReferencia(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $opcion = $request->getParameter("opcion");
        $conn = Doctrine::getTable("InoMaster")->getConnection();
        $conn->beginTransaction();

        try {
            $ino = Doctrine::getTable("InoMaster")->find($idmaster);
            if ($opcion == "Cerrar") {

                if ($ino->getCaImpoexpo() != Constantes::INTERNO && $ino->getCaImpoexpo() != Constantes::OTMDTA) {
                    $piezasMaster = $ino->getCaPiezas();
                    $pesoMaster = $ino->getCaPeso();
                    $volumenMaster = $ino->getCaVolumen();


                    $houses = Doctrine::getTable("InoHouse")
                            ->createQuery("h")
                            ->addWhere("ca_idmaster = ?", $idmaster)
                            ->execute();
                    $totalpiezashouse = 0;
                    $totalpesohouse = 0;
                    $totalvolumenhouse = 0;

                    foreach ($houses as $house) {
                        $totalpesohouse += $house->getCaPeso();
                        $totalpiezashouse += $house->getCaNumpiezas();
                        $totalvolumenhouse += $house->getCaVolumen();
                    }
                    if (($piezasMaster == $totalpiezashouse) && ($pesoMaster == $totalpesohouse) && ($volumenMaster == $totalvolumenhouse)) {
                        $ino->setCaUsucerrado($this->getUser()->getUserId());
                        $ino->setCaFchcerrado(date("Y-m-d H:i:s"));

                        $this->getUser()->log("Cerrar INO F2", false, array("url" => $idmaster));

                        $ino->save();
                        $conn->commit();
                        $this->responseArray = array("success" => true, "usuarioCerrado" => ($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
                    } else {
                        $this->responseArray = array("success" => false, "errorInfo" => "Los valores De Piezas, peso y volumen no coinciden");
                    }
                } else {
                    $ino->setCaUsucerrado($this->getUser()->getUserId());
                    $ino->setCaFchcerrado(date("Y-m-d H:i:s"));
                    $this->getUser()->log("Cerrar INO F2", false, array("url" => $idmaster));

                    $ino->save();
                    $conn->commit();
                    $this->responseArray = array("success" => true, "usuarioCerrado" => ($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
                }
            } else {
                $ino->setCaUsucerrado(null);
                $ino->setCaFchcerrado(null);
                $this->getUser()->log("Abrir INO F2", false, array("url" => $idmaster));

                $ino->save();
                $conn->commit();
                $this->responseArray = array("success" => true, "usuarioCerrado" => ($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
            }
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeHistorialStatus($request) {

        $this->forward404Unless($this->getRequestParameter("idreporte"));
        $house = $this->getRequestParameter("idhouse");
        $this->reporte = Doctrine::getTable("Reporte")->find($this->getRequestParameter("idreporte"));
        $this->forward404Unless($this->reporte);
        if ($house) {

            $statusList = $this->reporte->getRepstatus();

            $data = array();
            foreach ($statusList as $status) {
                $row = array();
                $row["fchstatus"] = $status->getCaFchenvio();
                $row["etapa"] = utf8_encode($status->getTrackingEtapa()->getCaEtapa());
                $row["idemail"] = $status->getCaIdemail();
                $row["status"] = utf8_encode($status->getStatus());
                $data[] = $row;
            }

            $this->responseArray = array("root" => $data);
            $this->setTemplate("responseTemplate");
        }
    }

    /**
     * @autor Felipe Nari?o
     * eliminar costos
     * @return un objeto JSON con la variable succes representando exito o falla en la transaccion
     * @param sfRequest $request A request 
     *        idinocosto : identificador de costo a eliminar

     * @date:  2016-04-25
     */
    public function executeEliminarCosto(sfWebRequest $request) {

        $idinocosto = $request->getParameter("idinocosto");
        $inoCosto = Doctrine::getTable("InoCosto")->find($idinocosto);
        $this->forward404Unless($inoCosto);

        try {
            $inoCosto->delete();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * Cargar los costos en una grilla, correspondientes a un idmaster
     * @return un objeto JSON con los datos de la grilla de costos
     * @param sfRequest $request A request 
     *       idmaster

     * @date:  2016-04-25
     */
    /*public function executeDatosGridCostos(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $costos = Doctrine::getTable("InoCosto")
                ->createQuery("c")
                ->select("c.ca_idinocosto, c.ca_idmaster, c.ca_neto, c.ca_venta, c.ca_factura,c.ca_fchfactura,
                                  c.ca_tcambio, c.ca_tcambio_usd, c.ca_idcosto, p.ca_sigla, i.ca_nombre,
                                  c.ca_idmoneda, c.ca_fchfactura,c.ca_idproveedor,c.ca_idcomprobante ")
                //->innerJoin("c.InoConcepto cs")
                ->innerJoin("c.Ids i")
                ->where("c.ca_idmaster = ?", $idmaster)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();


        foreach ($costos as $key => $val) {
            $data = array();

            $utils = Doctrine::getTable("InoHouse")
                    ->createQuery("h")
                    ->select("h.ca_doctransporte,u.ca_idutilidad,h.ca_idhouse,c.ca_idinocosto,u.ca_valor")
                    ->innerJoin("h.InoMaster m WITH h.ca_idmaster=m.ca_idmaster")
                    ->innerJoin("m.InoCosto c WITH c.ca_idinocosto=?", $costos[$key]["c_ca_idinocosto"])
                    ->leftJoin("h.InoUtilidad u WITH u.ca_idinocosto=?", $costos[$key]["c_ca_idinocosto"])
                    ->where("h.ca_idmaster = ?", $idmaster)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();

            $data["idmaster"] = $costos[$key]["c_ca_idmaster"];
            $data["idmaster" . $data["idmaster"]] = $costos[$key]["c_ca_idmaster"];
            $data["idinocosto" . $data["idmaster"]] = $costos[$key]["c_ca_idinocosto"];
            $data["idcosto" . $data["idmaster"]] = $costos[$key]["c_ca_idcosto"];
            if($costos[$key]["c_ca_idcomprobante"]>0)
            {
                $concepto = Doctrine::getTable("InoMaestraConceptos")->find($costos[$key]["c_ca_idcosto"]);
                $nomcomcepto=($concepto) ? (utf8_encode($concepto->getCaConceptoEsp())) : "";
            }
            else
            {
                $concepto = Doctrine::getTable("InoConcepto")->find($costos[$key]["c_ca_idcosto"]);
                $nomcomcepto=($concepto) ? (utf8_encode($concepto->getCaConcepto())) : "";
            }
            
            
            $data["nombrecosto" . $data["idmaster"]] = "::".$nomcomcepto;
            $data["idproveedor" . $data["idmaster"]] = utf8_encode($costos[$key]["c_ca_idproveedor"]);
            $data["proveedor" . $data["idmaster"]] = utf8_encode($costos[$key]["i_ca_nombre"]);
            $data["factura" . $data["idmaster"]] = $costos[$key]["c_ca_factura"];
            $data["fchfactura" . $data["idmaster"]] = $costos[$key]["c_ca_fchfactura"];
            $data["idmoneda" . $data["idmaster"]] = $costos[$key]["c_ca_idmoneda"];
            $data["neto" . $data["idmaster"]] = $costos[$key]["c_ca_neto"];
            $data["venta" . $data["idmaster"]] = $costos[$key]["c_ca_venta"];
            $data["tcambio" . $data["idmaster"]] = $costos[$key]["c_ca_tcambio"];
            $data["tcambio_usd" . $data["idmaster"]] = $costos[$key]["c_ca_tcambio_usd"];
            if ($data["tcambio_usd" . $data["idmaster"]] != 0) {
                $data["neto_usd" . $data["idmaster"]] = $costos[$key]["c_ca_neto"] / $data["tcambio_usd" . $data["idmaster"]];
            } else {
                $data["neto_usd" . $data["idmaster"]] = 0;
            }
            $data["valor_pesos" . $data["idmaster"]] = $data["tcambio" . $data["idmaster"]] * $data["neto_usd" . $data["idmaster"]];
            $data["utilidad" . $data["idmaster"]] = $costos[$key]["utilidad"];


            $valor = 0;
            foreach ($utils as $util => $va) {
                $valor = $valor + $utils[$util]["u_ca_valor"];
            }
            $data["valor" . $data["idmaster"]] = $valor;
            $valor = 0;
            $data["inoventa" . $data["idmaster"]] = $data["venta" . $data["idmaster"]] - $data["valor_pesos" . $data["idmaster"]];

            $data["ventacop" . $data["idmaster"]] = $costos[$key][""];


            $data["orden" . $data["idmaster"]] = utf8_encode($costos[$key]["ca_idinocosto"]);
            $data["idcomprobante" . $data["idcomprobante"]] = $costos[$key]["c_ca_idcomprobante"];

            $root[] = $data;
        }
        if (count($root) < 1)
            $root[]["idmaster" . $idmaster] = $idmaster;


        $this->responseArray = array("success" => true, "root" => $root, "total" => count($root));
        $this->setTemplate("responseTemplate");
    }*/
    
    public function executeDatosGridCostos(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $costos = Doctrine::getTable("InoCosto")
                ->createQuery("c")
                ->select("c.ca_idinocosto, c.ca_idmaster, c.ca_neto, c.ca_venta, c.ca_factura,c.ca_fchfactura,
                                  c.ca_tcambio, c.ca_tcambio_usd, c.ca_idcosto, p.ca_sigla, i.ca_nombre,
                                  c.ca_idmoneda, c.ca_fchfactura,c.ca_idproveedor,c.ca_idcomprobante ")
                //->innerJoin("c.InoConcepto cs")
                ->innerJoin("c.Ids i")
                ->where("c.ca_idmaster = ?", $idmaster)
                ->orderBy("c.ca_idcosto")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();


        foreach ($costos as $key => $val) {
            $data = array();

            

            $data["idmaster"] = $costos[$key]["c_ca_idmaster"];
            $data["idmaster"] = $costos[$key]["c_ca_idmaster"];
            $data["idinocosto"] = $costos[$key]["c_ca_idinocosto"];
            $data["idcosto"] = $costos[$key]["c_ca_idcosto"];
            if($costos[$key]["c_ca_idcomprobante"]>0)
            {
                $concepto = Doctrine::getTable("InoMaestraConceptos")->find($costos[$key]["c_ca_idcosto"]);
                $nomcomcepto=($concepto) ? (utf8_encode($concepto->getCaConceptoEsp())) : "";
            }
            else
            {
                $concepto = Doctrine::getTable("InoConcepto")->find($costos[$key]["c_ca_idcosto"]);
                $nomcomcepto=($concepto) ? (utf8_encode($concepto->getCaConcepto())) : "";
            }
            
            
            $data["nombrecosto"] = $costos[$key]["c_ca_idcosto"]."-".$nomcomcepto;
            $data["idproveedor"] = utf8_encode($costos[$key]["c_ca_idproveedor"]);
            $data["proveedor"] = utf8_encode($costos[$key]["i_ca_nombre"]);
            $data["factura"] = $costos[$key]["c_ca_factura"];
            $data["fchfactura"] = $costos[$key]["c_ca_fchfactura"];
            $data["idmoneda"] = $costos[$key]["c_ca_idmoneda"];
            $data["neto"] = $costos[$key]["c_ca_neto"];
            $data["venta"] = $costos[$key]["c_ca_venta"];
            $data["tcambio"] = $costos[$key]["c_ca_tcambio"];
            $data["tcambio_usd"] = $costos[$key]["c_ca_tcambio_usd"];
            if ($data["tcambio_usd"] != 0) {
                $data["neto_usd"] = $costos[$key]["c_ca_neto"] / $data["tcambio_usd"];
            } else {
                $data["neto_usd"] = 0;
            }
            $data["valor_pesos"] = round($data["tcambio"] * $data["neto_usd"],2);
            $data["utilidad"] = $costos[$key]["utilidad"];

            
            $valor = 0;
            $data["inoventa"] = $data["venta"] - $data["valor_pesos"];

            $data["ventacop"] = $costos[$key][""];


            $data["orden"] = utf8_encode($nomcomcepto);
            $data["idcomprobante"] = $costos[$key]["c_ca_idcomprobante"];

            $utils = array();
            //$equipos[] = array("sel" => true, "doctransporte" => "1", "idhouse" => "2", 
///                    "idutilidad" => "3", "serial" => "4", "inocosto" => "5", "valor"=>"6");
            $tmputil = Doctrine::getTable("InoHouse")
                    ->createQuery("h")
                    ->select("h.ca_doctransporte AS doctransporte,u.ca_idutilidad AS idutilidad,h.ca_idhouse AS idhouse ,c.ca_idinocosto AS inocosto,u.ca_valor AS valor")
                    ->innerJoin("h.InoMaster m WITH h.ca_idmaster=m.ca_idmaster")
                    ->innerJoin("m.InoCosto c WITH c.ca_idinocosto=?", $costos[$key]["c_ca_idinocosto"])
                    ->leftJoin("h.InoUtilidad u WITH u.ca_idinocosto=?", $costos[$key]["c_ca_idinocosto"])
                    ->where("h.ca_idmaster = ?", $idmaster)
                    
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
            $valor = 0;
            foreach( $tmputil as $u)
            {
                $utils[]=array("sel" => true, "doctransporte" => $u["h_doctransporte"], "idhouse" => $u["h_idhouse"], 
                    "idutilidad" => $u["u_idutilidad"], "inocosto" => $u["c_inocosto"], "valor"=>$u["u_valor"]);
                $valor = $valor + $u["u_valor"];
            }
            foreach($utils as $k => $u)
            {
                $utils[$k]["util"]=$data["inoventa"];
            }
            
            
            /*foreach ($utils as $util => $va) {
                $valor = $valor + $utils[$util]["u_ca_valor"];
            }*/
            $data["valor"] = $valor;
            /*$util = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("h.ca_doctransporte AS doctransporte,u.ca_idutilidad AS idutilidad,h.ca_idhouse AS idhouse ,c.ca_idinocosto AS inocosto,u.ca_valor AS valor")
                ->innerJoin("h.InoMaster m WITH h.ca_idmaster=m.ca_idmaster")
                ->innerJoin("m.InoCosto c WITH c.ca_idinocosto=?", $idinocosto)
                ->leftJoin("h.InoUtilidad u WITH u.ca_idinocosto=?", $idinocosto)
                ->where("h.ca_idmaster = ?", $idmaster)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();*/
            $data["sobreventas"] = $utils;
            //echo "<pre>";print_r($data);echo "</pre>";
            $root[] = $data;
        }
        if (count($root) < 1)
            $root[]["idmaster"] = $idmaster;


        $this->responseArray = array("success" => true, "root" => $root, "total" => count($root));
        $this->setTemplate("responseTemplate");
    }

    /**
     * @autor Felipe Nari?o
     * guardar costos
     * @return un objeto JSON con la variable succes representando exito o falla en la transaccion
     * @param sfRequest $request A request 
     *        datos: JSON con la grilla de todos los costos a almacenar

     * @date:  2016-04-25
     */
    /*public function executeGuardarGridCosto(sfWebRequest $request) {


        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("InoCosto")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = array();
            $idinocostos = array();
            foreach ($datos as $dato) {
                $costo = Doctrine::getTable("InoCosto")->find($dato->idinocosto);

                if (!$costo) {
                    $costo = new InoCosto();
                }
                $costo->setCaIdmaster($dato->idmaster);
                if ($dato->idcosto) {

                    $costo->setCaIdcosto($dato->idcosto);
                }
                $costo->setCaFactura($dato->factura);
                $costo->setCaFchfactura($dato->fchfactura);
                $costo->setCaIdproveedor($dato->idproveedor);
                $costo->setCaIdmoneda($dato->idmoneda);
                $costo->setCaTcambio($dato->tcambio);
                $costo->setCaTcambioUsd($dato->tcambio_usd);
                $costo->setCaNeto($dato->neto);
                $costo->setCaVenta($dato->venta);
                $costo->setCaFchactualizado(date("Y-m-d H:i:s"));
                $costo->setCaUsuactualizado($this->getUser()->getUserId());

                $costo->save();
                $ids[] = $dato->id;
                $idinocostos[] = $costo->getCaIdinocosto();
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids, "idinocostos" => $idinocostos);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }*/
    
    
    public function executeGuardarGridCosto(sfWebRequest $request) {


        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("InoCosto")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = array();
            $idinocostos = array();
            foreach ($datos as $dato) {
                $costo = Doctrine::getTable("InoCosto")->find($dato->idinocosto);
                if($dato->venta>0)
                {
                    $costo->setCaVenta($dato->venta);
                    $costo->save($conn);
                }
                
                foreach ($dato->sobreventas as $t) {
                    //print_r($t);
                    if (($t->doctransporte == "" || $t->doctransporte == "null") ||
                            ($t->idhouse == "" || $t->idhouse == "null") ||
                            ($t->valor == "" || $t->valor == "null")
                    )
                        continue;
                    if ($t->idutilidad == "null" || $t->idutilidad == "") {
                        $inoUtilidad = new InoUtilidad();
                        $inoUtilidad->setCaIdhouse($t->idhouse);
                        $inoUtilidad->setCaIdinocosto($t->inocosto);
                        //$inoUtilidad->setCaIdinocosto()
                    } else {
                        $inoUtilidad = Doctrine::getTable("InoUtilidad")->find($t->idutilidad);
                    }

                    $inoUtilidad->setCaValor($t->valor);
                    $inoUtilidad->save($conn);

                    /*$ids[] = $t->id;
                    $ids_reg[] = $inoUtilidad->getCaIdutilidad();*/
                }
                
                $ids[] = $dato->id;
                $idinocostos[] = $costo->getCaIdinocosto();
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids, "idinocostos" => $idinocostos);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosProveedor(sfWebRequest $request) {
        $idproveedor = $request->getParameter("idproveedor");

        $proveedor = Doctrine::getTable("Tercero")
                ->createQuery("t")
                ->addWhere("t.ca_idtercero = ?", $idproveedor)
                ->fetchOne();


        if ($proveedor) {
            $data[] = array(
                "nombre" => $proveedor->getCaNombre(),
                "identificacion" => $proveedor->getCaIdentificacion(),
                "direccion" => $proveedor->getCaDireccion(),
                "telefono" => $proveedor->getCaTelefono(),
                "fax" => $proveedor->getCaFax(),
                "email" => $proveedor->getCaEmail(),
                "contacto" => $proveedor->getCaContacto(),
                "ciudad" => $proveedor->getCaIdCiudad()
                    //"nombreciudad"=>$proveedor->getCiudad()->getCaNombre();
            );
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeBalance(sfWebRequest $request) {

        $idmaster = $request->getParameter("idmaster");
        $this->referencia = Doctrine::getTable("InoMaster")->find($idmaster);
    }

    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarGridFacturacionPanel(sfWebRequest $request) {
        try {
            $errorInfo = "";

            $idcomprobante = $request->getParameter("idcomprobante");
            $iddetalle = $request->getParameter("iddetalle");

            $obj = null;
            if ($idcomprobante != "" && $idcomprobante > 0) {
                $obj = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                $c = $obj->getCaIdcomprobante();
            } else if ($iddetalle > 0) {
                $obj = Doctrine::getTable("InoDetalle")->find($iddetalle);
                $c = $obj->getCaIddetalle();
            }

            if ($obj) {
                $obj->delete();
            } else
                $errorInfo = "No fue posible encontrar ningun registro";

            $this->responseArray = array("success" => true, "c" => $c, "errorInfo" => $errorInfo);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosVistapreviaTicket(sfWebRequest $request) {
        $numeroTicket = $request->getParameter("idticket");

        $ticket = Doctrine::getTable("HdeskTicket")
                ->createQuery("t")
                ->addWhere("ca_idticket = ?", $numeroTicket)
                ->fetchOne();
        $data = array();
        if ($ticket) {
            $data["ca_titulo"] = utf8_encode("Ticket # $numeroTicket " . $ticket->getCaTitle());
            $data["ca_reportado"] = utf8_encode("by " . $ticket->getUsuario()->getCaNombre());
            $data["ca_contacto"] = utf8_encode($ticket->getUsuario()->getSucursal()->getCaNombre() . " Ext." . $ticket->getUsuario()->getCaExtension());
            $data["ca_asignado"] = utf8_encode($ticket->getAssignedTo()->getCaNombre());
            $data["ca_area"] = utf8_encode($ticket->getHdeskGroup()->getCaName());
            $data["ca_proyecto"] = utf8_encode($ticket->getHdeskProject()->getCaName());
            $data["ca_prioridad"] = utf8_encode($ticket->getCaPriority());
            $data["ca_tipo"] = utf8_encode($ticket->getCaType());
            $data["ca_estado"] = utf8_encode($ticket->getCaAction());
            $data["ca_descripcion"] = utf8_encode($ticket->getCaText());
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosRespuestas(sfWebRequest $request) {
        //$referencia = $request->getParameter("referencia");
        //buscar el # de ticket en tabla tb_auditdocs por referencia
        $numeroTicket = $request->getParameter("idticket");
        $respuestas = Doctrine::getTable("HdeskResponse")
                ->createQuery("t")
                ->addWhere("ca_idticket = ?", $numeroTicket)
                ->addOrderBy("ca_createdat")
                ->execute();
        $data = array();
        foreach ($respuestas as $respuesta) {
            $fecha = str_replace(" ", "<br/>", $respuesta->getCaCreatedat());
            $data[] = array("ca_encabezado" => utf8_encode($respuesta->getUsuario()->getCaNombre() . "<span style='font-size: 9px;'> -Ext." . $respuesta->getUsuario()->getCaExtension() . "</span>" . "<br/>"),
                "ca_cuerpo" => utf8_encode($respuesta->getCaText()),
                "ca_fecha" => utf8_encode($fecha),
                "ca_idticket" => utf8_encode($respuesta->getCaIdticket()));
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarNuevaRespuesta(sfWebRequest $request) {


        $numeroTicket = $request->getParameter("idticket");
        $texto = $request->getParameter("texto");

        $conn = Doctrine::getTable(HdeskResponse)->getConnection();
        $conn->beginTransaction();

        try {
            $respuesta = new HdeskResponse();
            $respuesta->setCaIdticket($numeroTicket);
            //$texto = str_replace("<p>", "<p style='font-family: arial, helvetica, sans-serif; font-size: 12.7273px;'>", $texto);
            $respuesta->setCaText(utf8_decode($texto));
            $respuesta->setCaLogin($this->getUser()->getUserId());
            $respuesta->setCaCreatedat(date("Y-m-d H:i:s"));
            $respuesta->save();
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeObtenerIdticket(sfWebRequest $request) {

        $this->responseArray = array("success" => true, "idticket" => "26561");
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarDeducciones(sfWebRequest $request) {

        $idcomprobante = $request->getParameter("idcomprobante");
        $comprobante = Doctrine::getTable("InoComprobante")
                ->createQuery("c")
                ->addWhere("c.ca_idcomprobante = ?", $idcomprobante)
                ->fetchOne();
        $totalDed = 0;
        $deducciones = json_decode($request->getParameter("gridDeducciones"));
        $conn = Doctrine::getTable("InoComprobante")->getConnection();

        try {
            $conn->beginTransaction();
            $ids = array();
            if ($deducciones) {
                foreach ($deducciones as $d) {
                    if ($d->neto) {
                        $inoDeduccion = Doctrine::getTable("InoDeduccion")->find(array($d->iddeduccion, $idcomprobante));
                        if (!$inoDeduccion) {
                            $inoDeduccion = new InoDeduccion();
                            $inoDeduccion->setCaIdcomprobante($idcomprobante);
                            $inoDeduccion->setCaIddeduccion($d->iddeduccion);
                        }
                        $inoDeduccion->setCaNeto($d->neto);
                        $inoDeduccion->setCaTcambio($comprobante->getCaTcambio());
                        $inoDeduccion->save($conn);
                        $ids[] = $d->id;
                    }
                }
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDeducciones(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $deducciones = Doctrine::getTable("InoDeduccion")
                ->createQuery("d")
                ->addWhere("ca_idcomprobante = ?", $idcomprobante)
                ->execute();
        $data = array();
        foreach ($deducciones as $deduccion) {
            $data[] = array("iddeduccion" => $deduccion->getCaIddeduccion(),
                "neto" => $deduccion->getCaNeto(),
                "tcambio" => $deduccion->getCaTcambio(),
                "valor" => ($deduccion->getCaNeto() * $deduccion->getCaTcambio()));
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarDeduccion(sfWebRequest $request) {
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

    public function executeGuardarContenedores(sfWebRequest $request) {
        $contenedores = $request->getParameter("gridContenedores");
        $contenedores = json_decode($contenedores);

        //try 
        {
            $ids = array();
            $idequipos = array();
            foreach ($contenedores as $contenedor) {
                if (!$contenedor->idequipo) {
                    $equipo = new InoEquipo();
                    $equipo->setCaUsucreado($this->getUser()->getUserId());
                    $equipo->setCaFchcreado(date('Y-m-d H:i:s'));
                } else {
                    $equipo = Doctrine::getTable("InoEquipo")->find($contenedor->idequipo);
                }
                $equipo->setCaIdconcepto($contenedor->idconcepto);
                if ($contenedor->idvehiculo != "")
                    $equipo->setCaIdvehiculo($contenedor->idvehiculo);
                $equipo->setCaSerial(utf8_decode($contenedor->serial));
                $equipo->setCaIdmaster($request->getParameter("idmaster"));
                $equipo->setCaNumprecinto(utf8_decode($contenedor->precinto));
                $equipo->setCaObservaciones(utf8_decode($contenedor->observaciones));
                $equipo->setCaCantidad($contenedor->cantidad);
                $equipo->setCaUsuactualizado($this->getUser()->getUserId());
                $equipo->setCaFchactualizado(date('Y-m-d H:i:s'));
                $ids[] = $contenedor->id;

                $equipo->save();
                $idequipos[] = $equipo->getCaIdequipo();
            }

            $this->responseArray = array("success" => true, "ids" => $ids, "idequipos" => $idequipos);
        } /* catch (Exception $e) {
          $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
          } */
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosContenedores(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $equipos = Doctrine::getTable("InoEquipo")
                ->createQuery("e")
                ->addWhere("e.ca_idmaster = ?", $idmaster)
                ->execute();
        $data = array();
        foreach ($equipos as $equipo) {
            $data[] = array("idequipo" => $equipo->getCaIdequipo(),
                "idconcepto" => $equipo->getCaIdconcepto(),
                "idvehiculo" => $equipo->getCaIdvehiculo(),
                "serial" => $equipo->getCaSerial(),
                "precinto" => $equipo->getCaNumprecinto(),
                "observaciones" => $equipo->getCaObservaciones(),
                "cantidad" => $equipo->getCaCantidad()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "count" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarContenedor(sfWebRequest $request) {
        $idequipo = $request->getParameter("idequipo");
        $conn = Doctrine::getTable("InoEquipo")->getConnection();
        try {
            $conn->beginTransaction();
            $equipo = Doctrine::getTable("InoEquipo")->find($idequipo);
            if ($equipo) {
                $equipo->delete();
                $conn->commit();
            }
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosfacturasporreferenciaycliente(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $idcliente = $request->getParameter("idcliente");
        $cliente = $request->getParameter("cliente");
        $idreferencia = $request->getParameter("idreferencia");
        $data = array();
        $houses = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("h.* , mast.*")
                ->innerJoin("h.InoMaster mast")
                ->addWhere("h.ca_idmaster = ?", $idmaster)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();


        foreach ($houses as $house) {
            $comprobantes = Doctrine::getTable("InoComprobante")
                    ->createQuery("c")
                    ->select("c.*,tcomp.* ,ids.* ")
                    ->innerJoin("c.Ids ids")
                    ->innerJoin("c.InoTipoComprobante tcomp")
                    ->addWhere("c.ca_idhouse = ? ", $house["h_ca_idhouse"])
                    ->addWhere("c.ca_id = ? ", $idcliente)
                    ->addWhere("c.ca_consecutivo is not null")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
            $referencia = $house["mast_ca_referencia"];

            foreach ($comprobantes as $comprobante) {
                $seleccionado = false;
                if ($comprobante["c_ca_idcomprobante_cruce"] == $idreferencia) {
                    $seleccionado = true;
                }
                $data[] = array("idmaster" => $idmaster,
                    "idcomprobante" => $comprobante["c_ca_idcomprobante"],
                    "referencia" => utf8_encode($referencia),
                    "factura" => utf8_encode($comprobante["tcomp_ca_tipo"] . $comprobante["tcomp_ca_comprobante"] . "-" . $comprobante["c_ca_consecutivo"]),
                    "cliente" => utf8_encode($cliente),
                    "seleccionado" => $seleccionado
                );
            }
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeAsignarAnticipoaFactura(sfWebRequest $request) {
        $datosgrid = $request->getParameter("datosGrid");
        $datosgrid = json_decode($datosgrid);
        $idcomprobante = $request->getParameter("idcomprobante");
        try {
            foreach ($datosgrid as $dato) {

                $comprobante = Doctrine::getTable("InoComprobante")->find($dato->idcomprobante);
                if ($comprobante) {
                    if ($dato->seleccionado == true) {
                        $comprobante->setCaIdcomprobanteCruce($idcomprobante);
                        $comprobante->save();
                    } else {
                        if ($comprobante->getCaIdcomprobanteCruce() == $idcomprobante) {
                            $comprobante->setCaIdcomprobanteCruce(null);
                            $comprobante->save();
                        }
                    }
                }
            }
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosRepGastos(sfWebRequest $request) {
        $tipo = ($request->getParameter("tipo") != "") ? $request->getParameter("tipo") : "1";
        $idhouse = $request->getParameter("idhouse");
        $house = Doctrine::getTable("InoHouse")->find($idhouse);
        $data = array();
        if ($house) {
            //$repgastos = $house->getReporte()->getRepGasto();

            $tarifas = Doctrine::getTable("RepTarifa")
                    ->createQuery("t")
                    ->where("t.ca_idreporte = ? and t.ca_idconcepto!=9999 ", $house->getReporte()->getCaIdreporte())
                    ->orderBy("t.ca_fchcreado ASC")
                    ->execute();
            $data = array();
            foreach ($tarifas as $tarifa) {

                $repgastos = Doctrine::getTable("RepGasto")
                        ->createQuery("r")
                        ->addWhere("r.ca_idreporte = ? and ca_idconcepto = ?", array($tarifa->getCaIdreporte(), $tarifa->getCaIdconcepto()))
                        ->execute();
                foreach ($repgastos as $repgasto) {
                    $data[] = array("idconcepto" => utf8_encode($repgasto->getConcepto()->getCaIdconcepto()),
                        "concepto" => utf8_encode($repgasto->getTipoRecargo()->getCaRecargo()),
                        "aplicacion" => utf8_encode($repgasto->getCaAplicacion()),
                        "moneda" => utf8_encode($repgasto->getCaIdmoneda()),
                        "cobrar" => $repgasto->getCaCobrarTar(),
                        "agrupador" => utf8_encode($tarifa->getConcepto()->getCaConcepto())
                    );
                }
            }

            $recargos = Doctrine::getTable("RepGasto")
                    ->createQuery("t")
                    ->innerJoin("t.TipoRecargo tr")
                    ->where("t.ca_idreporte = ?", $house->getReporte()->getCaIdreporte())
                    ->addWhere("(t.ca_tiporecargo = ? or t.ca_tiporecargo is null ) and t.ca_idreporte = ? and t.ca_idconcepto = ? and t.ca_recargoorigen='true'", array($tipo, $house->getReporte()->getCaIdreporte(), 9999))
                    ->orderBy("t.ca_fchcreado ASC")
                    ->execute();
            //if($tipo=="1")        
            {
                if (count($recargos) > 0) {
                    foreach ($recargos as $recargo) {
                        $data[] = array("idconcepto" => utf8_encode($recargo->getConcepto()->getCaIdconcepto()),
                            "concepto" => utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
                            "aplicacion" => utf8_encode($recargo->getCaAplicacion()),
                            "moneda" => utf8_encode($recargo->getCaIdmoneda()),
                            "cobrar" => $recargo->getCaCobrarTar(),
                            "agrupador" => utf8_encode("Recargo general del trayecto")
                        );
                    }
                }
            }
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDianDepositos($request) {
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select ca_codigo, ca_nombre from tb_diandepositos where lower(ca_codigo||' '||ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' ";
        $rs = $con->execute($sql);
        $depositos = $rs->fetchAll();

        $data = array();
        foreach ($depositos as $deposito) {
            $data[] = array(
                "codigo" => $deposito["ca_codigo"],
                "nombre" => $deposito["ca_codigo"] . " " . utf8_encode($deposito["ca_nombre"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTransportistas($request) {
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select ca_idtransportista, ca_nombre from vi_transportistas where ca_idtransportista in (select ca_valor::text from tb_parametros where ca_casouso = 'CU073' and ca_identificacion = 10) and lower(ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' order by ca_nombre";   // and ca_valor2 like '%" . $rs->Value("ca_destino") . "%'" . "

        $rs = $con->execute($sql);
        $transportistas = $rs->fetchAll();

        $data = array();
        foreach ($transportistas as $transportista) {
            $data[] = array(
                "idtransportista" => $transportista["ca_idtransportista"],
                "nombre" => utf8_encode($transportista["ca_nombre"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarMasterRadicacion($request) {
        $idmaster = $request->getParameter("idmaster");
        try {
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);
            $data = array();
            if ($inoMaster) {
                $inoMasterSea = $inoMaster->getInoMasterSea();
                $data = json_decode($inoMasterSea->getCaDatosmuisca());
                $data->fchinicial = substr($data->fchinicial, 0, 10);
                $data->fchfinal = substr($data->fchfinal, 0, 10);
                $data->fchmuisca = $inoMasterSea->getCaFchmuisca();
                $data->usumuisca = $inoMasterSea->getCaUsumuisca();
                $data->fchradicado = null;
                $data->usuradicado = null;
                $data->radicacion = null;
            }
            $this->responseArray = array("data" => $data, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosPatiosDevolucion($request) {
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select pt.ca_idpatio, pt.ca_nombre from pric.tb_patios pt where lower(ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' order by pt.ca_nombre";

        $rs = $con->execute($sql);
        $patios = $rs->fetchAll();

        $data = array();
        foreach ($patios as $patio) {
            $data[] = array(
                "idpatio" => $patio["ca_idpatio"],
                "nombre" => utf8_encode($patio["ca_nombre"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosAgentesAduana($request) {
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "SELECT p.ca_idproveedor, i.ca_nombre FROM ids.tb_proveedores p JOIN ids.tb_ids i ON p.ca_idproveedor = i.ca_id and p.ca_tipo IN ('ADU','TRI','TRN','OPE','DEP') where lower(i.ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' order by i.ca_nombre";

        $rs = $con->execute($sql);
        $agentes = $rs->fetchAll();

        $data = array();
        foreach ($agentes as $agente) {
            $data[] = array(
                "idagente" => $agente["ca_idproveedor"],
                "nombre" => utf8_encode($agente["ca_nombre"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    public function executeDatosHouseRadicacion($request) {
        $idmaster = $request->getParameter("idmaster");
        try {
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);

            if ($inoMaster) {
                $inoHouses = $inoMaster->getInoHouse();
                $data = array();
                foreach ($inoHouses as $inoHouse) {
                    $inoHouseSea = $inoHouse->getInoHouseSea();
                    $campos = array(
                        "idhouse" => $inoHouse->getCaIdhouse(),
                        "doctransporte" => $inoHouse->getCaDoctransporte()
                    );
                    if ($inoHouseSea->getCaDatosmuisca()) {
                        $rec = json_decode(utf8_encode($inoHouseSea->getCaDatosmuisca()));
                        $rec->idhouse = $inoHouse->getCaIdhouse();
                        $rec->doctransporte = $inoHouse->getCaDoctransporte();
                        $data[] = $rec;
                    } else {
                        $data[] = $campos;
                    }
                }
            }
            $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarHouseRadicacion($request) {
        $idhouse = $request->getParameter("idhouse");
        try {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $data = array();
            if ($inoHouse) {
                $inoHouseSea = $inoHouse->getInoHouseSea();
                if ($inoHouseSea->getCaDatosmuisca()) {
                    $data = json_decode($inoHouseSea->getCaDatosmuisca());
                }
            }
            $this->responseArray = array("data" => $data, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarMasterRadicacion($request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $datos = $request->getParameter("datos");

        $conn = Doctrine::getTable("InoMaster")->getConnection();

        if ($idmaster != "0") {
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);

            $this->forward404Unless($inoMaster);
            try {
                $conn->beginTransaction();
                $inoMasterSea = $inoMaster->getInoMasterSea();

                $inoMasterSea->setCaDatosmuisca($datos);
                $inoMasterSea->save();
                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeGuardarHouseRadicacion($request) {
        $idhouse = $request->getParameter("idhouse");
        $datos = $request->getParameter("datos");

        $conn = Doctrine::getTable("InoMaster")->getConnection();

        if ($idhouse != "0") {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);

            $this->forward404Unless($inoHouse);
            try {
                $conn->beginTransaction();
                $inoHouseSea = $inoHouse->getInoHouseSea();

                $inoHouseSea->setCaDatosmuisca($datos);
                $inoHouseSea->save();
                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeEliminarHouseRadicacion($request) {
        $idhouse = $request->getParameter("idhouse");

        $conn = Doctrine::getTable("InoMaster")->getConnection();

        if ($idhouse != "0") {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);

            $this->forward404Unless($inoHouse);
            try {
                $conn->beginTransaction();
                $inoHouseSea = $inoHouse->getInoHouseSea();

                $inoHouseSea->setCaDatosmuisca(null);
                $inoHouseSea->save();
                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeDigitacionRadicacionOk($request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $conn = Doctrine::getTable("InoMaster")->getConnection();

        if ($idmaster != "0") {
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);

            $this->forward404Unless($inoMaster);
            try {
                $user = $this->getUser();
                $conn->beginTransaction();
                $inoMasterSea = $inoMaster->getInoMasterSea();

                $inoMasterSea->setCaFchmuisca(date("Y-m-d H:i:s"));
                $inoMasterSea->setCaUsumuisca($user->getUserId());
                $inoMasterSea->save();

                $email = new Email();
                $email->setCaUsuenvio($user->getUserId());
                $email->setCaTipo("Ok Digitación Muisca");
                $email->setCaFrom($user->getEmail());
                $email->setCaReplyto($user->getEmail());
                $email->setCaFromname($user->getNombre());
                $email->setCaSubject("Digitación Muisca OK - Ref.:" . $inoMaster->getCaReferencia());

                $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "login" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "email.yml";
                $yml = sfYaml::load($config);
                $contentPlain = sprintf($yml['email'], "https://" . sfConfig::get("app_branding_url"), "http://" . sfConfig::get("app_branding_url"));

                $contentHTML = "<html><head></head><body>";
                $contentHTML .= "Apreciados Compañeros:<br /><br />";
                $contentHTML .= "La presente con el fin de informar que las casillas Muisca en Colsys han sido totalmente diligenciadas y ustedes pueden proceder a generar el xml dejandolo en la bandeja de la DIAN comprobando su recibo exitoso en los tiempos de la Aduana, adjunto a la referencia encontrará el (los) Hbl`(s ) y Mbl amparados en dicha referencia.<br /><br />";
                $contentHTML .= "<br />";
                $contentHTML .= "TENER PRESENTE LA FECHA DE LLEGADA DE LA MERCANCÍA SUMINISTRADA EN EL EMAIL, O LA DADA POR LA PAGINA WEB DEL TERMINAL MARÍTIMO EN MOTONAVES ANUNCIADAS O PREVISTA A SU ARRIBO.<br /><br />";
                $contentHTML .= "DESPUÉS DE LA PRESENTACIÓN FÍSICA EN PUERTO DEL ORIGINAL DEL HBL ENTREGAR EL MBL SIN VALOR DE FLETES AL AGENTE DE ADUANA, SI EL CLIENTE GOZA DE FIRMA DE CONTRATO DE COMODATO , FAVOR PROCEDER A LA CONSECUCIÓN DEL PAZ Y SALVO DEL CONTENEDOR MÁXIMO EL MISMO DÍA DE LLEGADA DEL BUQUE.<br /><br />";
                $contentHTML .= "Quedamos pendientes,<br /><br />";
                $contentHTML .= Doctrine::getTable("Usuario")->find($user->getUserId())->getFirmaHTML() . "<br />";
                $contentHTML .= "</body></html>";


                $ciudad = ($inoMaster->getCaDestino() == "STA-0005") ? "BAQ-0005" : $inoMaster->getCaDestino();
                $con = Doctrine_Manager::getInstance()->connection();
                $sql = "select up.ca_login, us.ca_email, us.ca_sucursal from control.tb_usuarios_perfil up";
                $sql .= "  inner join vi_usuarios us on us.ca_login = up.ca_login";
                $sql .= "  where us.ca_sucursal = '$ciudad' and up.ca_perfil like '%asistente-marítimo-puerto%' and us.ca_activo = true";
                $usuarios = $con->execute($sql);
                foreach ($usuarios as $usuario) {
                    $email->addTo($usuario["ca_email"]);
                }
                $sql = "select us.ca_email "
                        . "from control.tb_usuarios_perfil up "
                        . "inner join control.tb_usuarios us on us.ca_login = up.ca_login "
                        . "inner join control.tb_sucursales sc on sc.ca_idsucursal=us.ca_idsucursal "
                        . "where up.ca_perfil ='cordinador-de-otm' and us.ca_activo = true and sc.ca_nombre in ( "
                        . "select distinct(sc.ca_nombre) "
                        . " from ino.tb_house_sea hs "
                        . "     inner join ino.tb_house hh on hh.ca_idhouse = hs.ca_idhouse "
                        . "     inner join tb_reportes rp on rp.ca_idreporte=hh.ca_idreporte "
                        . "     inner join control.tb_usuarios us on rp.ca_usucreado=us.ca_login "
                        . "     inner join control.tb_sucursales sc on sc.ca_idsucursal=us.ca_idsucursal "
                        . " where hh.ca_idmaster = '" . $idmaster . "' and hs.ca_continuacion <> 'N/A') ";
                $usuarios = $con->execute($sql);
                foreach ($usuarios as $usuario) {
                    $email->addTo($usuario["ca_email"]);
                }
                $email->setCaBodyhtml($contentHTML);
                $email->setCaBody($contentPlain);
                $email->save();

                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeReversarDigitacionOk($request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $conn = Doctrine::getTable("InoMaster")->getConnection();

        if ($idmaster != "0") {
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);

            $this->forward404Unless($inoMaster);
            try {
                $conn->beginTransaction();
                $inoMasterSea = $inoMaster->getInoMasterSea();

                $inoMasterSea->setCaFchmuisca(null);
                $inoMasterSea->setCaUsumuisca(null);
                $inoMasterSea->save();

                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
            $this->setTemplate("responseTemplate");
        }
    }
    public function executeCargarControlMandato($request) {
        $idequipo = $request->getParameter("idequipo");
        try {
            $inoEquipo = Doctrine::getTable("InoEquipo")->find($idequipo);
            $data = array();
            if ($inoEquipo) {
                if ($inoEquipo->getCaDatos()) {
                    $data = json_decode($inoEquipo->getCaDatos());
                }
            }
            $this->responseArray = array("data" => $data, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarControlMandato($request) {
        $idequipo = $request->getParameter("idequipo");
        $datos = $request->getParameter("datos");

        $conn = Doctrine::getTable("InoEquipo")->getConnection();

        if ($idequipo) {
            $inoEquipo = Doctrine::getTable("InoEquipo")->find($idequipo);

            $this->forward404Unless($inoEquipo);
            try {
                $conn->beginTransaction();

                $inoEquipo->setCaDatos($datos);
                $inoEquipo->save();
                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeCargarDarLiberacion($request) {
        $idhouse = $request->getParameter("idhouse");
        try {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $inoHouseSea = $inoHouse->getInoHouseSea();
            
            $data = array();
            if ($inoHouseSea) {
                if ($inoHouseSea->getCaDatos()) {
                    $data = json_decode(utf8_encode($inoHouseSea->getCaDatos()));
                    $data->fchliberacion = $inoHouseSea->getCaFchliberacion();
                }
            }
            $this->responseArray = array("data" => $data, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarLiberarDocumentos($request) {
        $idhouse = $request->getParameter("idhouse");
        try {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $inoHouseSea = $inoHouse->getInoHouseSea();
            
            $data = array();
            if ($inoHouseSea) {
                if ($inoHouseSea->getCaDatos()) {
                    $data = json_decode(utf8_encode($inoHouseSea->getCaDatos()));
                    $data->fchliberacion = $inoHouseSea->getCaFchliberacion();
                }
            }
            $this->responseArray = array("data" => $data, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarDarLiberacion($request) {
        $idhouse = $request->getParameter("idhouse");

        $conn = Doctrine::getTable("InoHouse")->getConnection();

        if ($idhouse) {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $inoHouseSea = $inoHouse->getInoHouseSea();

            $this->forward404Unless($inoHouseSea);
            try {
                $user = $this->getUser();
                $conn->beginTransaction();
                
                if ($request->getParameter("fchliberacion")) {
                    $inoHouseSea->setCaFchliberacion($request->getParameter("fchliberacion"));
                    $inoHouseSea->setCaFchliberado(date('Y-m-d h:i:s'));
                }
                $datos = json_decode(utf8_encode(($inoHouseSea->getCaDatos())));
                if ($request->getParameter("estado_liberacion")) {
                    $datos->estado_liberacion = $request->getParameter("estado_liberacion");
                }
                if ($request->getParameter("nota_liberacion")) {
                    $datos->nota_liberacion = $request->getParameter("nota_liberacion");
                }
                if ($request->getParameter("observaciones")) {
                    $datos->observaciones = $request->getParameter("observaciones");
                }
                $datos->usuliberacion = $user->getUserId();
                $inoHouseSea->setCaDatos(json_encode($datos));
                
                $inoHouseSea->save();
                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarLiberarDocumentos($request) {
        $idhouse = $request->getParameter("idhouse");

        $conn = Doctrine::getTable("InoHouse")->getConnection();

        if ($idhouse) {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $inoHouseSea = $inoHouse->getInoHouseSea();

            $this->forward404Unless($inoHouseSea);
            // try {
                $user = $this->getUser();
                $conn->beginTransaction();
                
                if ($request->getParameter("idagente")) {
                    $inoHouseSea->setCaFchlibero(date('Y-m-d h:i:s'));
                }
                $datos = json_decode(utf8_encode(($inoHouseSea->getCaDatos())));
                if ($request->getParameter("idagente")) {
                    $datos->idagente = $request->getParameter("idagente");
                }
                if ($request->getParameter("agente")) {
                    $datos->agente = $request->getParameter("agente");
                }
                if ($request->getParameter("detalles")) {
                    $datos->detalles = $request->getParameter("detalles");
                }
                $datos->usulibero = $user->getUserId();
                $inoHouseSea->setCaDatos(json_encode($datos));
                
                $inoHouseSea->save();
                $conn->commit();
                $this->responseArray = array("success" => true);
//            } catch (Exception $e) {
//                $conn->rollBack();
//                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
//            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGeneracionArchivoXml($request) {
        $idmaster = $request->getParameter("idmaster");
        $NumEnvio = $request->getParameter("NumEnvio");

        $inoMasterSea = Doctrine::getTable("InoMasterSea")->find($idmaster);
        $this->forward404Unless($idmaster);

        $this->outXML = $inoMasterSea->getArchivoXml($NumEnvio);

        if (is_array($this->outXML)) {
            $this->responseArray = $this->outXML;
            $this->setTemplate("responseTemplate");
        } else {
            $this->setTemplate("downloadXml");
        }
    }

}
