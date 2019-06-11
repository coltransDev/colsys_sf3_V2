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
    const RUTINA_COMISIONES = 214;
    const RUTINA_COLOTM = 216;

    public function executeIndexExt5(sfWebRequest $request) {

        /*$n="0004";
        echo $n;echo "<br>";
        echo (int)$n;echo "<br>";
        echo ltrim($n,"0");echo "<br>";
        exit;*/
        $this->permisos = array();

        $user = $this->getUser();

        $permisosRutinas["aereo"] = $user->getControlAcceso(self::RUTINA_AEREO);
        $permisosRutinas["maritimo"] = $user->getControlAcceso(self::RUTINA_MARITIMO);

        $permisosRutinas["terrestre"] = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $permisosRutinas["exportacion"] = $user->getControlAcceso(self::RUTINA_EXPORTACION);
        $permisosRutinas["otm"] = $user->getControlAcceso(self::RUTINA_OTM);

        $permisosRutinas["colotm"] = $user->getControlAcceso(self::RUTINA_COLOTM);

        $tipopermisos = 
                array(
                    'Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Anular' => 3, 'Liquidar' => 4, 'Cerrar' => 5, 'Abrir' => 6, 
                    'General' => 7, 'House' => 8, 'Facturacion' => 9, 'Costos' => 10, 'Documentos' => 11,'NotasCredito' => 12,  
                    'MuiscaEd' => 13, 'MuiscaDig' => 14, 'MuiscaRev' => 15, 'GenerarXml' => 16, 'DarLiberacion' => 17, 
                    'RevLiberacion' => 18, 'LiberacionPto' => 19, 'Comodatos' => 20,'Muisca' => 21,'Balance' => 22);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                $this->permisos[$k][$index] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }

        if($request->getParameter("idmaster"))
        {
            $this->inoMaster = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->whereIn("m.ca_idmaster", json_decode($request->getParameter("idmaster")))
                //->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
        }        
    }

    function executeDatosBusqueda($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

        $user = $this->getUser();

        /* Accesos del usuario */
        $permisosRutinas["aereo"] = $user->getControlAcceso(self::RUTINA_AEREO);
        $permisosRutinas["maritimo"] = $user->getControlAcceso(self::RUTINA_MARITIMO);

        $permisosRutinas["terrestre"] = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $permisosRutinas["exportacion"] = $user->getControlAcceso(self::RUTINA_EXPORTACION);
        $permisosRutinas["otm"] = $user->getControlAcceso(self::RUTINA_OTM);
        $permisosRutinas["colotm"] = $user->getControlAcceso(self::RUTINA_COLOTM);
        
        $usuario = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->addWhere("u.ca_login = ?", $this->getUser()->getUserId())
                ->fetchOne();
        $datosusuario = json_decode($usuario->getCaDatos());
        $permisos = array();
        //$tipopermisos = array('Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Anular' => 3, 'Liquidar' => 4, 'Cerrar' => 5, 'Abrir' => 6, 'General' => 7, 'House' => 8, 'Facturacion' => 9, 'Costos' => 10, 'Documentos' => 11, 'Muisca' => 12, 'MuiscaEd' => 13, 'MuiscaDig' => 14, 'MuiscaRev' => 15, 'GenerarXml' => 16, 'DarLiberacion' => 17, 'RevLiberacion' => 18, 'LiberacionPto' => 19, 'Comodatos' => 20,'balance' => 22);
        $tipopermisos= array(
                    'Consultar' => 0, 'Crear' => 1, 'Editar' => 2, 'Anular' => 3, 'Liquidar' => 4, 'Cerrar' => 5, 'Abrir' => 6, 
                    'General' => 7, 'House' => 8, 'Facturacion' => 9, 'Costos' => 10, 'Documentos' => 11,'NotasCredito' => 12,  
                    'MuiscaEd' => 13, 'MuiscaDig' => 14, 'MuiscaRev' => 15, 'GenerarXml' => 16, 'DarLiberacion' => 17, 
                    'RevLiberacion' => 18, 'LiberacionPto' => 19, 'Comodatos' => 20,'Muisca' => 21,'Balance' => 22);
        //print_r($permisosRutinas["aereo"]);
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
            
            if($o!="ca_consecutivo" && $o!="ca_idlinea" )
            {
                //$where .= strtoupper($o) . " like ?";
                $where .= ' UPPER('.$o.')' . " like ?";
                $whereq[] = "%" . strtoupper($request->getParameter("q")) . "%";                
            }
            else if($o=="ca_idlinea")
            {
                $where .=  "ca_nomlinea like ?";
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
        
        $q = Doctrine::getTable("InoViBusqueda")
                ->createQuery("m")
                ->distinct("ca_referencia")
                ->select("ca_referencia, ca_fchcreado,ca_transporte,ca_impoexpo,ca_idmaster,ca_modalidad,ca_fchcerrado,ca_fchanulado,ca_fchliquidado")
                ->addWhere("ca_referencia IS NOT NULL")
                ->orderBy("ca_fchcreado DESC")
                ->limit(40)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        if($where!="")
            $q->addWhere("" . $where, $whereq);
        
        //echo $q->getSqlQuery();
        $where = "";
        $whereq = array();
        $wherePermisos = " (";
        if ($permisos["aereo"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            $where .= "( (ca_impoexpo = ? or ca_impoexpo = ?) AND ca_transporte=? ) ";
            $whereq[] = Constantes::IMPO;
            $whereq[] = Constantes::TRIANGULACION;
            $whereq[] = Constantes::AEREO;
        }

        if ($permisos["maritimo"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            $where .= "((ca_impoexpo = ? or ca_impoexpo = ?) AND ca_transporte=? ) ";
            $whereq[] = Constantes::IMPO;
            $whereq[] = Constantes::TRIANGULACION;
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
            //$where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? AND SUBSTR(ca_referencia::TEXT,1,1) = ? ) ";
            $whereq[] = Constantes::OTMDTA;
            $whereq[] = Constantes::TERRESTRE;
            $whereq[] = "4";
        }

        if ($permisos["colotm"]["Consultar"]) {
            if ($where != "")
                $where .= " OR ";
            //$where .= "(ca_impoexpo = ? AND ca_transporte=? AND ca_datos like ? ) ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? AND SUBSTR(ca_referencia::TEXT,1,1) = ? ) ";
            $whereq[] = Constantes::OTMDTA;
            $whereq[] = Constantes::TERRESTRE;
            $whereq[] = "7";
        }


        $wherePermisos .= $where . " )";
        $q->addWhere("" . $where, $whereq);

        if($request->getParameter("fieldsearch")!="")
        {
            switch($request->getParameter("fieldsearch"))
            {
                case "cotizacion":
                    $q->addWhere("ca_cotizacion=?" , $request->getParameter("q"));
                break;
                case "contenedor":
                    $q->addWhere("ca_idmaster IN (SELECT ie.ca_idmaster FROM InoEquipo ie WHERE ca_serial like ?) " ,  "%".$request->getParameter("q")."%");
                break;
                case "facturaprov":
                    $q->addWhere("ca_idmaster IN (SELECT ic.ca_idmaster FROM InoCosto ic WHERE ca_factura like ?) " ,  "%".$request->getParameter("q")."%");
                break;
            }
        }

        $debug = utf8_encode($q->getSqlQuery());
        $datos = $q->execute();
        
        foreach ($datos as $k => $d) {
            $datos[$k]["m_ca_transporte"] = utf8_encode($datos[$k]["m_ca_transporte"]);
            $datos[$k]["m_ca_impoexpo"] = utf8_encode($datos[$k]["m_ca_impoexpo"]);
            $datos[$k]["m_ca_modalidad"] = utf8_encode($datos[$k]["m_ca_modalidad"]);

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
            $datos[$k]["tipofacturacion"] = $datosusuario->factura_ino;

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
        //print_r($whereq);
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos), "debug" => $debug, "permisos"=> $permisos);
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
            
            $row["idbodega"] = $inoHouse->getCaIdbodega();
            $bodega = Doctrine::getTable("Bodega")->find($inoHouse->getCaIdbodega());
            if ($bodega) {
                $row["bodega"] = utf8_encode($bodega->getCaNombre());
            }
            $comprobantes = $inoHouse->getInoComprobante();
            if (count($comprobantes) < 1) {
                $row["color"] = "pink";
            }else{
                $row["color"] = "white";
            }
            
            $row["url"] = $inoHouse->getVendedor()->getImagenUrl('60x80');
            $row["global"] = $inoHouse->getCliente()->getProperty("cuentaglobal");
            $row["comunicaciones"] = $inoHouse->getCliente()->getProperty("consolidar_comunicaciones");

            $inoHouseSea = $inoHouse->getInoHouseSea();

            $datosSea = utf8_encode($inoHouseSea->getCaDatos());
            $datos = json_decode($datosSea, true);
            $datosMuisca = json_decode(utf8_encode($inoHouseSea->getCaDatosmuisca()), true);

            $row["continuacion"] = $inoHouseSea->getCaContinuacion();
            $row["destinofinal"] = ($inoHouseSea->getCaContinuacion()!="N/A")?$inoHouseSea->getCaContinuacionDest():"";
            $row["operador"] = null;
            if ( $inoHouseSea->getCaContinuacion() == "OTM" ) {
                if($inoHouse->getReporte()->getConsignatario())
                {
                    $consignatario = $inoHouse->getReporte()->getConsignatario();
                    $row["operador"] = $consignatario->getCaNombre() . " Id. " . $consignatario->getCaIdentificacion();
                }else
                {
                    $row["operador"]="";
                }
            }
            $row["dispocarga"] = $datosMuisca["dispocarga"];
            $row["planilla"] = $datos["planilla"];
            $row["utilidad"] = $inoHouse->getUtilidadPorHouse();
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
                        //if ($de["idconcepto"] == $e->getCaIdconcepto()) {
                        if ($de["serial"] == $e->getCaSerial()) {
                            $piezas = floatval($de["piezas"]);
                            $kilos = floatval($de["kilos"]);
                            continue;
                        }
                    }
                }
                $equipos[] = array("sel" => true, "idequipo" => $e->getCaIdequipo(), "idconcepto" => $e->getConcepto()->getCaIdconcepto(), "concepto" => utf8_encode($e->getConcepto()->getCaConcepto()), "serial" => $e->getCaSerial(), "numprecinto" => $e->getCaNumprecinto(), "piezas" => $piezas, "kilos" => $kilos);
            }
            $row["equipos"] = $equipos;
            $data[] = $row;
        }
//        if($idmaster=="27265")
//            print_r($data);

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "ncomprobantes" => count($comprobantes));

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosReporteCarga(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        $ino = $request->getParameter("ino");
        
        if($idmaster!="")
        {
            $this->forward404Unless($idmaster);
            $q = Doctrine::getTable("InoHouse")
                    ->createQuery("c")
                    ->select("c.ca_idhouse,  c.ca_idcliente ,c.ca_doctransporte,  
                            ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,cl.ca_propiedades, 
                            comp.ca_idcomprobante, comp.ca_idcomprobante_cruce,comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,comp.ca_docentry,
                            m.ca_nombre,comp.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,
                            clH.ca_idcliente,clH.ca_compania,comp.ca_valor,comp.ca_valor2,comp.ca_tcambio,comp.ca_datos,
                            (SELECT SUM(det.ca_cr) FROM InoDetalle det WHERE det.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor3,
                            (SELECT SUM(det1.ca_db) FROM InoDetalle det1 WHERE det1.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor4,
                            (SELECT SUM(ded.ca_neto) FROM InoDeduccion ded WHERE ded.ca_idcomprobante = comp.ca_idcomprobante) as ca_valordeducciones,
                            comp.ca_plazo")
                    ->innerJoin("c.InoComprobante comp")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("ids.IdsCliente cl")
                    ->innerJoin("c.Cliente clH")
                    ->innerJoin("comp.InoTipoComprobante tcomp WITH tcomp.ca_tipo IN ('F','C')")
                    ->leftJoin("comp.Ids fact")
                    //->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                    ->where("c.ca_idmaster = $idmaster ")
                    ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        }
        else{
            
            $q = Doctrine::getTable("InoComprobante")
                    ->createQuery("comp")
                    ->select("comp.ca_idhouse,  comp.ca_id ,  
                            ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,cl.ca_propiedades, 
                            comp.ca_idcomprobante, comp.ca_idcomprobante_cruce,comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_estado,
                            comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,comp.ca_docentry,h.ca_doctransporte,h.ca_idmaster,
                            ,clH.ca_idcliente,clH.ca_compania,m.ca_transporte,m.ca_impoexpo,
                            c.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,emp.ca_nombre,
                            comp.ca_valor,comp.ca_valor2,comp.ca_tcambio,comp.ca_datos,comp.ca_docentry,comp.ca_idhouse,
                            (SELECT SUM(det.ca_cr) FROM InoDetalle det WHERE det.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor3,
                            (SELECT SUM(det1.ca_db) FROM InoDetalle det1 WHERE det1.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor4,
                            (SELECT SUM(ded.ca_neto) FROM InoDeduccion ded WHERE ded.ca_idcomprobante = comp.ca_idcomprobante) as ca_valordeducciones,
                            comp.ca_plazo")
                    ->leftJoin("comp.InoHouse h")
                    ->leftJoin("h.InoMaster m")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("ids.IdsCliente cl")
                    ->leftJoin("h.Cliente clH")
                    ->innerJoin("comp.InoTipoComprobante tcomp")
                    ->innerJoin("tcomp.Empresa emp")
                    ->leftJoin("comp.Ids fact")
                    //->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                    ->where(" tcomp.ca_aplicacion=?",array("1"))
                    ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            if($request->getParameter("consecutivo")!="")
            {
                $q->addWhere("comp.ca_consecutivo = ?",$request->getParameter("consecutivo"));
            }
            else
            {
                $q->addWhere("comp.ca_usucreado = ?  AND comp.ca_consecutivo IS NULL AND comp.ca_estado = ?",array($this->getUser()->getUserId(),0));
            }
        }
        $debug=$q->getSqlQuery();
        $datos = $q->execute();
        $this->data = array();
    
        foreach ($datos as $d) {
            $datosJson=json_decode(utf8_encode($d["comp_ca_datos"]));
            $consecutivo="";
            $consecutivo .= ($d["tcomp_ca_tipo"] == "F") ? "FACTURA " : (($d["tcomp_ca_tipo"] == "C") ? "<span class=row_yellow>NOTA CREDITO</span>" : "");
            $consecutivo .= ($d["comp_ca_consecutivo"] == "") ? " Sin Gen. " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
            $file = ($d["tcomp_ca_tipo"] == "F" && $d["comp_ca_consecutivo"] != "") ? "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"]."/sap/1" : "";
            $file = "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"]."/sap/1";

            $house = ($d["c_ca_doctransporte"]!="")?$d["c_ca_doctransporte"]:$d["h_ca_doctransporte"];
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
            
            foreach($datosJson->idanticipo as $a)
            {
                if ($a>0) {
                    $anticipo = Doctrine::getTable("InoComprobante")->find($a);
                    if($anticipo)
                    {
                        $txt="Anticipo ".$anticipo->getInoTipoComprobante()->getCaPrefijoSap()."-".$anticipo->getInoTipoComprobante()->getCaComprobante()." ". $anticipo->getCaConsecutivo()." :: ".number_format($anticipo->getCaValor(), 2, ",", ".")." (TRM : ".$anticipo->getCaTcambio().")";
                    //if ($tipocruce == "R" || $tipocruce == "A")
                        $rc .= "<table class='recibocaja' id='intermitente'  ><td>   <div id='foot' style='width:320px; font-weight: bold; text-align: center;'   >" . $txt . "</div> </td></table>";
                    }
                }
            }
            
            if($d["comp_ca_estado"] == 5){
                $comprobante = Doctrine::getTable("InoComprobante")->find($d["comp_ca_idcomprobante"]);
                $idg = $comprobante->getResultadoIndicador();
                
                $idgestado = -1;
                
                if($idg["sucess"] == true){
                    $idgestado = $idg["datos"]["estado"];
                    $idgvalor = $idg["datos"]["valor"];                
                if($idgestado == 0){                    
                        $idexclusion = $idg["datos"]["idexclusion"];
                        $exclusion = $idg["datos"]["exclusion"]; 
                    }
                    
                }
//                $idgestado = $datosJson->idg->OFC->estado;
//                $idgvalor = $datosJson->idg->OFC->valor;                
//                if($idgestado == 0){                    
//                    $idexclusion = $datosJson->idg->OFC->idexclusion;
//                    if($idexclusion && $idexclusion > 0){
//                        $obs = ParametroTable::retrieveByCaso("CU275",null,null,$idexclusion)->getFirst();
//                        $exclusion = utf8_encode($obs->getCaValor());
//                    }
//                }
            }
            
            if ($d["comp_ca_idcomprobante_cruce"] != "" && $d["comp_ca_idcomprobante_cruce"] != null) {
                $idcomp = $d["comp_ca_idcomprobante_cruce"];
                $compro = Doctrine::getTable("InoComprobante")->find($idcomp);
                $fecha = $rest = substr($compro->getCaFchcreado(), 0, -9);
                $tipocruce = $compro->getInoTipoComprobante()->getCaTipo();
                //$rc.= $compro->getInoTipoComprobante()->getCaTipo();
                if ($tipocruce == "R" || $tipocruce == "A" || $tipocruce == "D" || $tipocruce == "P")
                    $rc .= "<table class='recibocaja' id='intermitente'  ><td>   <div id='foot' style='width:320px; font-weight: bold; text-align: center;'   >RC: #" . $compro->getCaConsecutivo() . "  " . $fecha ."</div> </td></table>";
            }
            
            if($idmaster!="")
                $valor = ($d["comp_ca_valor"] != "") ? $d["comp_ca_valor"] : (($d["c_ca_valor3"] >= $d["c_ca_valor4"]) ? $d["c_ca_valor3"] : $d["c_ca_valor4"]);
            else
                $valor = ($d["comp_ca_valor"] != "") ? $d["comp_ca_valor"] : (($d["comp_ca_valor3"] >= $d["comp_ca_valor4"]) ? $d["comp_ca_valor3"] : $d["comp_ca_valor4"]);
            $this->data[] = array(
                "tipocomprobante" => $d["tcomp_ca_tipo"],
                "titulohouse" => "House", "titulotaza" => "Valor Pesos", "titulocambio" => "TRM",
                "idempresa"=>$d["tcomp_ca_idempresa"],"empresa"=>utf8_encode($d["emp_ca_nombre"]),
                "idhouse" => (($d["c_ca_idhouse"]!="")?$d["c_ca_idhouse"]:$d["comp_ca_idhouse"]), "idcomprobante" => $d["comp_ca_idcomprobante"], "docentry" => $d["comp_ca_docentry"],
                "idmaster"=>($idmaster!="")?$idmaster:$d["h_ca_idmaster"],
                "comprobante" => $consecutivo, "fchcomprobante" => $d["comp_ca_fchcomprobante"],
                "cliente" => utf8_encode($d["ids_ca_nombre"]), "doctransporte" => $d["c_ca_doctransporte"],
                "idmoneda" => $d["comp_ca_idmoneda"],
                //"valor" => number_format($valor, 0),
                "valor" => round($valor, 0),
                "house" => $house, "valor2" => $d["comp_ca_valor2"],
                "valortcambio" => round(( (float) $valor * (float) $d["comp_ca_tcambio"]), 0), "tcambio" => $d["comp_ca_tcambio"],
                "tcambio" => $d["comp_ca_tcambio"],
                "valordeducciones"=>($d["c_ca_valordeducciones"]) , 
                "idconcepto" => $d["det_ca_idconcepto"],
                "concepto" => utf8_encode($d["det_ca_idconcepto"] . "-" . $d["s_ca_descripcion"]),
                "iddetalle" => $d["det_ca_iddetalle"], "estado" => $d["comp_ca_estado"],
                "idccosto" => $d["tcomp_ca_idccosto"], "class" => $class, "file" => $file,
                "footer" => $rc,
                "transporte"=> utf8_encode($d["m_ca_transporte"]),
                "impoexpo"=> utf8_encode($d["m_ca_impoexpo"]),
                "idexclusion"=> $idexclusion,               
                "exclusion"=> $exclusion,
                "idgestado"=> $idgestado,
                "idgvalor"=> $idgvalor,
                "idcliente"=> $comprobante?$comprobante->getIds()->getCaId():null,
                "idagente"=> $comprobante?$comprobante->getInoHouse()->getInoMaster()->getIdsAgente()->getCaIdagente():null,
                "idproveedor"=> $comprobante?$comprobante->getInoHouse()->getInoMaster()->getIdsProveedor()->getCaIdproveedor():null,
                "plazo"=>$d["comp_ca_plazo"],
                "tooltip" => "Generado:({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})",
                "do" => $datosJson->do
            );
        }
        if($idmaster>0)
        {
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
        }


        $this->responseArray = array("success" => true, "root" => $this->data,"debug"=>$debug);
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
        //try 
        {

            $idmaster = $request->getParameter("idmaster");
            $tipo = ($request->getParameter("tipo") == "") ? "full" : $request->getParameter("tipo");
            $impoexpo = utf8_decode($request->getParameter("impoexpo"));
            $transporte = utf8_decode($request->getParameter("transporte"));
            $idempresa=$request->getParameter("idempresa");

            $modalidad = utf8_decode($request->getParameter("modalidad"));
            $idorigen = $request->getParameter("idorigen");
            $iddestino = $request->getParameter("iddestino");
            $tipovehiculo = $request->getParameter("tipovehiculo");
            $fchreferencia = $request->getParameter("fchreferencia");
            $fchreferenciaTm = strtotime($fchreferencia);

            $facturaUnica = $request->getParameter("factura_unica");
            $fchllegada = $request->getParameter("ca_fchllegada");
            $fchllegadaTm = strtotime($fchllegada);
            $error = "";

           // if( !(($impoexpo == "INTERNO" || $impoexpo == "OTM-DTA") && $transporte == "Terrestre") )            
            if ( !( (($impoexpo == Constantes::INTERNO || $impoexpo == Constantes::OTMDTA) && $transporte == Constantes::TERRESTRE) || ($impoexpo==Constantes::EXPO && ($transporte == Constantes::MARITIMO || $transporte == Constantes::TERRESTRE) ) ) ) 
            {
                $q = Doctrine::getTable("InoMaster")
                        ->createQuery("m")
                        ->addWhere("m.ca_master = ? AND ca_usuanulado is null", $request->getParameter("ca_master"));

                if ($idmaster) {
                    $q->addWhere("m.ca_idmaster != ?", $idmaster);
                }
                $m = $q->fetchOne();

                if ($m) {
                    $error = "El numero de master ya se incluyo en la referencia " . $m->getCaReferencia();
                }
            }

            if ($error == "") {

                if ($idmaster && $idmaster != "0") {
                    $ino = Doctrine::getTable("InoMaster")->find($idmaster);
                    $this->forward404Unless($ino);
                } else {

                    $ino = new InoMaster();
                    $mmRef = Utils::parseDate($fchllegada, "m");
                    $aaRef = substr(Utils::parseDate($fchllegada, "Y"), -2, 2);
                    
                    //if( !($transporte == Constantes::AEREO && $impoexpo== Constantes::IMPO) )
                    if( !( ($transporte == Constantes::AEREO && $impoexpo== Constantes::IMPO) || ($transporte == Constantes::TERRESTRE && $impoexpo== Constantes::INTERNO)  ))                    
                    {
                        if (Utils::parseDate($fchllegada, "d") >= "26") {
                            $mmRef = $mmRef + 1;
                            if ($mmRef >= 13) {
                                $mmRef = "01";
                                $aaRef = $aaRef + 1;
                            }
                        }
                    }
                    if($impoexpo== Constantes::EXPO)
                    {
                        $idorigen1=$this->getUser()->getIdciudad();
                    }
                    else
                        $idorigen1=$idorigen;
                    
                    $numRef = InoMasterTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen1, $iddestino, $mmRef, $aaRef,$idempresa);

                    $ino->setCaReferencia($numRef);
                    $ino->setCaImpoexpo($impoexpo);
                    $ino->setCaTransporte($transporte);
                    $ino->setCaModalidad($modalidad);
                    $ino->setCaOrigen($idorigen);
                    $ino->setCaDestino($iddestino);
                }

                if ($impoexpo == Constantes::EXPO) {
                    $datos = array("modalidad" => $request->getParameter("ca_modalidad"),
                        "agencia" => $request->getParameter("agenciaad"),
                        "idlinea" => $request->getParameter("agenciaad"),
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
                
                if (($ino->getCaFchreferencia() == null) || ($ino->getCaFchreferencia() == "")) {
                    $ino->setCaFchreferencia(date("Y-m-d"));
                }                
                $ino->setCaIdlinea($request->getParameter("proveedor"));

                if ($request->getParameter("agente")) {
                    $ino->setCaIdagente($request->getParameter("agente"));
                }
                if ($impoexpo == Constantes::OTMDTA || ($impoexpo == Constantes::INTERNO && $transporte== Constantes::TERRESTRE)) {
                    $datos = json_decode($ino->getCaDatos());
                    $datos->tipovehiculo = $tipovehiculo;
                    if($idempresa!="" && $impoexpo == Constantes::OTMDTA)
                        $datos->idempresa = $idempresa;
                    $datos = json_encode($datos);
                    $ino->setCaDatos($datos);
                }
                if ( (($impoexpo == Constantes::INTERNO || $impoexpo == Constantes::OTMDTA) && $transporte == Constantes::TERRESTRE) || ($impoexpo==Constantes::EXPO && ($transporte == Constantes::MARITIMO || $transporte == Constantes::TERRESTRE )) ) {
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

                $datos = json_decode($ino->getCaDatos());
                if ($facturaUnica) {    // Identifica Referencias con multimples Houses y una sola factura
                    $datos->facturaUnica = $facturaUnica;
                    $datos = json_encode($datos);
                    $ino->setCaDatos($datos);
                } else if ($datos->facturaUnica) {
                    unset($datos->facturaUnica);
                    $datos = json_encode($datos);
                    $ino->setCaDatos($datos);
                }
                $ino->setCaObservaciones(utf8_decode($request->getParameter("ca_observaciones")));
                $ino->save();


                if ($idmaster > 0 && trim($request->getParameter("idreporte")) != "" /* && $impoexpo==Constantes::EXPO */) {


                    $reporte = Doctrine::getTable("Reporte")->find($request->getParameter("idreporte"));                    
                        
                    if($reporte->count()>0)
                    {
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
                }

                $conn->commit();
                $this->responseArray = array("success" => true, "idreferencia" => $numRef, "idmaster" => $ino->getCaIdmaster(),
                    'idtransporte' => utf8_encode($transporte), 'idimpoexpo' => utf8_encode($impoexpo), 'modalidad' => $modalidad);
                $this->setTemplate("responseTemplate");
            } else {

                $this->responseArray = array("success" => false, "errorInfo" => $error);
                $this->setTemplate("responseTemplate");
            }
        } /*catch (Exception $e) {

            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            $this->setTemplate("responseTemplate");
        }*/
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        if ($idmaster != "0") {
            $this->forward404Unless($idmaster);

            $ino = Doctrine::getTable("InoMaster")->find($idmaster);

            $this->forward404Unless($ino);

            //try {
                $datos = json_decode(utf8_encode($ino->getCaDatos()));
                $data["idmaster"] = $idmaster;                
                $data["referencia"] = utf8_encode($ino->getCaReferencia());
                $data["aplicaidg"] = utf8_encode($datos->idg);
                $data["ca_idlinea"] = utf8_encode($ino->getCaIdlinea());
                if (is_numeric($datos->agencia)) {
                    $proveedor = Doctrine::getTable("IdsProveedor")->find(utf8_encode($datos->agencia));
		   if($proveedor)
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
                $data["idagencia"] = utf8_encode($datos->idlinea);
                if (is_numeric($datos->idlinea)) {
                    $agencia = Doctrine::getTable("Ids")->find(utf8_encode($datos->idlinea));
                    if($agencia)
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
                if ($datos->facturaUnica)
                    $data["factura_unica"] = $datos->facturaUnica;

                $this->responseArray = array("success" => true, "data" => $data);
            /*} catch (Exception $e) {
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }*/
        } else {
            $this->responseArray = array("success" => true, "data" => '');
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarFactura(sfWebRequest $request) {
        try {
            $idcomprobante = $request->getParameter("idcomprobante");
            $idtipocomprobante = $request->getParameter("idtipocomprobante");

            $idsucursal = $request->getParameter("idsucursal");      

            $sucursal = Doctrine::getTable("IdsSucursal")->find($idsucursal);

            $ids=$sucursal->getIds();

            if ($idcomprobante) {
                $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);               
                $this->forward404Unless($comprobante);
                $idcliente_old = $comprobante->getCaId();
            } else {
                $comprobante = new InoComprobante();
            }
            $datos=json_decode($comprobante->getCaDatos());
            $comprobante->setCaIdtipo($idtipocomprobante);
           
            if($ids)
            {               
                $idsCreditos=$ids->getIdsCredito();
                $plazo=0;       
                foreach($idsCreditos as $idsc)
                {
                    if($idsc->getCaIdempresa()==$comprobante->getInoTipoComprobante()->getCaIdempresa())
                        $plazo=$idsc->getCaDias();
                }
            }           
           
            if($request->getParameter("plazo")<=$plazo || $request->getParameter("plazo")!="")
            {
               
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
               
                if($request->getParameter("plazo")!="")
                    $comprobante->setCaPlazo($request->getParameter("plazo"));
                else
                    $comprobante->setCaPlazo($plazo);                   
               

                $comprobante->setProperty("bienestrans", preg_replace("/[\n\r]/","",utf8_decode($request->getParameter("bienestrans"))));
                $comprobante->setProperty("detalle", utf8_decode($request->getParameter("detalle")));
                $comprobante->setProperty("anexos", utf8_decode($request->getParameter("anexos")));
                $comprobante->setProperty("idcontacto", utf8_decode($request->getParameter("idcontacto")));

                if($request->getParameter("idanticipo")!="")
                    $datos->idanticipo= $request->getParameter("idanticipo");
                if($request->getParameter("referencia")!="")
                    $datos->ca_referencia= $request->getParameter("referencia");

                if($request->getParameter("piezas")!="")
                    $datos->ca_piezas= $request->getParameter("piezas");
                if($request->getParameter("peso")!="")
                    $datos->ca_peso= $request->getParameter("peso");
                if($request->getParameter("volumen")!="")
                    $datos->ca_volumen= $request->getParameter("volumen");
                if($request->getParameter("doctransporte")!="")
                    $datos->ca_doctransporte= $request->getParameter("doctransporte");
                if($request->getParameter("trayecto")!="")
                    $datos->ca_trayecto= $request->getParameter("trayecto");

                if($request->getParameter("idexclusion"))
                    $datos->obsidg= $request->getParameter("idexclusion");
                else
                    $datos->obsidg = "";

                if($request->getParameter("txttrm"))
                    $datos->txttrm= ($request->getParameter("txttrm"));
                else
                    $datos->txttrm="";

                if($request->getParameter("baseentry")!="")
                    $datos->baseentry= $request->getParameter("baseentry");


                $datos = json_encode($datos);
                $comprobante->setCaDatos($datos);

                if($request->getParameter("cc")!="")
                {
                    $cc=$request->getParameter("cc");
                }
                else
                {
                    $ccosto = Doctrine::getTable("InoCentroCosto")
                        ->createQuery("c")
                        ->select("*")
                        ->where('ca_impoexpo = ? and ca_transporte = ? and ca_idsucursal is null and ca_idempresa = ?', array($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo(), $comprobante->getInoHouse()->getInoMaster()->getCaTransporte(), $comprobante->getInoTipoComprobante()->getCaIdempresa()))
                        ->fetchOne();
                    $cc=$ccosto->getCaIdccosto();
                }
                $comprobante->setCaIdccosto($cc);           



                $comprobante->save($conn);
               
               

                $conn->commit();
                $this->responseArray = array("success" => "true", "idcomprobante" => $comprobante->getCaIdcomprobante());
            }
            else
            {
                $conn->rollback();
                $this->responseArray = array("success" => "false", "errorInfo" => "El plazo es mayor a los dias de credito asignados");
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }
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

        try {
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
         } catch (Exception $e) {
            $errorInfo.=$e->getMessage() . "<br>";
            $this->responseArray = array("errorInfo" => $errorInfo, "success" => false);
        //echo $e->getMessage();
        }
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
                        ->addWhere("i.ca_iddetalle = ? ", array($dato->iddetalle))
                        ->fetchOne();
                if ($inoDetalle) {
                    $inoDetalle->delete();
                }
            }
            $conn->commit();
            $this->responseArray = array("errorInfo" => "error", "success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("errorInfo" => "error ".$e->getMessage(), "success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    public function executeDatosSobreventa(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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

            $evento["ca_idevento"] = $evento["ca_ident"];
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

            //if ($evento["ca_idevento"] == 9 || $evento["ca_idevento"] == 10 || $evento["ca_idevento"] == 6 || $evento["ca_idevento"] == 7) {

                $documentos = Doctrine::getTable("ExpoAedex")
                        ->createQuery("m")
                        ->addWhere("m.ca_referencia = ? and ca_idevento = ?", array($referencia, $evento["ca_idevento"]))
                        ->execute();

                if ($documentos) {
                    foreach ($documentos as $document) {
                        $stringdocs .= "Doc: " . $document->getCaIddocumento() . " Fecha: " . $document->getCaFechadoc() . " | ";
                    }
                }
            //}
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
        //$conn = Doctrine::getTable("IdsCliente")->getConnection();
        //$conn->beginTransaction();        
        $ino = Doctrine::getTable("InoMaster")->find($idmaster);
        try {

            $facturas = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*")      
                        ->innerJoin("c.Cliente cl")
                        ->innerJoin("c.InoComprobante comp")
                        ->leftJoin("comp.InoTipoComprobante tcomp")
                        ->innerJoin("comp.Ids fact")
                        ->where("c.ca_idmaster = ? and comp.ca_fchanulado is null and comp.ca_usuanulado is null and comp.ca_estado=5 ", $idmaster)
                        ->execute();

            /*$costos = Doctrine::getTable("InoCosto")
                    ->createQuery("c")
                    ->where("ca_idmaster = ? AND ca_fchanulado IS NULL", $idmaster)
                    ->execute();
             * 
             */

            if(count($facturas)>0 )
            {
                $errorInfo="La referencia no se puede eliminar porque ya posee ".count($facturas)." comprobante(s) creado(s)";
                $this->responseArray = array("success" => false, "errorinfo"=>$errorInfo);
            }
            else if($ino->getVlrCosto()!=0)
            {
                $errorInfo="La referencia no se puede eliminar porque ya un valor ".$ino->getVlrCosto()." en los costos de la Referencia";
                $this->responseArray = array("success" => false, "errorinfo"=>$errorInfo);
            }
            else
            {                
                if ($ino) {
                    
                    $ino->setCaMaster($idmaster.'-ANULADO');
                    $ino->setCaFchanulado(date("Y-m-d H:i:s"));
                    $ino->setCaFchanulado(date("Y-m-d H:i:s"));
                    $ino->setCaUsuanulado($this->getUser()->getUserId());
                    $ino->setCaMotivoanulado($request->getParameter("motivo"));
                    $ino->save();
                    
                    $inoHouses = $ino->getInoHouse();
                    foreach ($inoHouses as $inoHouse) {
                        $del=true;
                        $ccomp=$inoHouse->getInoComprobante();
                        foreach($ccomp as $c)
                        {
                            if($c->getCaEstado()=="8")
                                $del=false;
                        }
                        if($del==true)
                            $inoHouse->delete();
                    }
                    //$conn->commit($conn);                    
                    $this->responseArray = array("success" => true, "idreferenca" => $ino->getCaReferencia());
                }
            }
        } catch (Exception $e) {
        //    $conn->rollback();
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
        
        if( strlen($referencia)>12 )
        {

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
        }
        else
        {
            $this->responseArray = array("success" => false, "error" => "Numero de Referencia invalido ".$referencia);
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
            $this->responseArray = array("success" => true, "errorInfo" => utf8_encode($e->getMessage()));
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->data = array();
        
        if ($request->getParameter("idcomprobante") > 0) {
            $idcomprobante = $request->getParameter("idcomprobante");
            $this->forward404Unless($idcomprobante);
            $q = Doctrine::getTable("InoComprobante")
                    ->createQuery("comp")
                    ->select("c.ca_idhouse,  c.ca_idcliente ,c.ca_doctransporte, 
                            ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,cl.ca_propiedades, 
                            comp.ca_idcomprobante, comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,
                            m.ca_nombre,s.ca_concepto_esp,det.ca_iddetalle,comp.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,
                            clH.ca_idcliente,clH.ca_compania,det.*")
                    ->leftJoin("comp.InoHouse c")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("ids.IdsCliente cl")
                    ->leftJoin("c.Cliente clH")
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
        
        if(count($this->data)==0)
        {
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
            //$sql = "";
            
        }

        $this->responseArray = array("success" => true, "root" => $this->data, "total" => count($this->data), "debug" => $sql);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosFormFactura(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
        $data["tipocomprobante"]= $inoComprobante->getInoTipoComprobante()->getCaTipo();

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
       
        $data["idempresa"] = $inoComprobante->getInoTipoComprobante()->getCaIdempresa();       
        $data["idcc"] = $inoComprobante->getCaIdccosto();
       
        $data["plazo"] = $inoComprobante->getCaPlazo();
       
       
        $datos=json_decode(utf8_encode($inoComprobante->getCaDatos()));
        if($datos->idanticipo>0 && $datos->idanticipo!="" && $datos->idanticipo!="null")
        {
            $nanticipos=array();
            foreach($datos->idanticipo as $a)
            {
                if($a>0 && $a!="")
                    $nanticipos[]=$a;
            }
           
            if(count($nanticipos)>0)
            {
           
                $anticipos = Doctrine::getTable("InoComprobante")
                    ->createQuery("m")
                    ->whereIn("m.ca_idcomprobante", $nanticipos)
                    ->execute();

                foreach($anticipos as $a)
                {
                    if ($a) {
                        $data["idanticipo"][] = $a->getCaIdcomprobante();
                        $data["anticipo"][] = $a->getCaConsecutivo();
                    }
                }
            }
        }
        if($datos->ca_referencia!="")
            $data["referencia"] =$datos->ca_referencia;
       
        if($datos->ca_piezas!="")
            $data["piezas"]= $datos->ca_piezas;
        if($datos->ca_peso!="")
            $data["peso"]= $datos->ca_peso;
        if($datos->ca_volumen!="")
            $data["volumen"]= $datos->ca_volumen;
        if($datos->ca_doctransporte!="")
            $data["doctransporte"]= $datos->ca_doctransporte;
        if($datos->ca_trayecto!="")
            $data["trayecto"]= $datos->ca_trayecto;
       
        if($datos->txttrm!="")
            $data["txttrm"]= $datos->txttrm;
       
        if($datos->collect!="")
            $data["collect"]= $datos->collect;
       
        if($datos->obsidg >0){
            $obs = ParametroTable::retrieveByCaso("CU275",null,null,$datos->obsidg)->getFirst();           
           
            $data["idexclusion"] = $obs->getCaIdentificacion();
            $data["exclusion"] = utf8_encode($obs->getCaValor());
        }
       

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGenerarComprobante(sfWebRequest $request) {
        
        $idcomprobante = $request->getParameter("idcomprobante");        
        $errorInfo = $info =  $file = "";
        $ids = array();
        $comprobantes = Doctrine::getTable("InoComprobante")
                ->createQuery("m")
                ->whereIn("m.ca_idcomprobante", json_decode($idcomprobante))
                //->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
        
        foreach($comprobantes as $comprobante)
        {
            $resul[]=$this->generarComprobante($comprobante,$success);
        }
        if(count($resul)==1)
        {
            $resul=$resul[0];
            $file = "/inocomprobantes/generarComprobantePDF/id/" . $comprobante->getCaIdcomprobante()."/sap/1";
        }
        
        $this->responseArray = array("success" => $success, "resul" => $resul,"count"=>count($comprobantes),"file"=>$file, "idmoneda"=>$comprobante->getCaIdmoneda());
        $this->setTemplate("responseTemplate");
    }
    
    public function generarComprobante($comprobante,&$success)
    {
        
        if($comprobante->getCaPlazo()<0 )
        {
            
            $idsCreditos=$comprobante->getIds()->getIdsCredito();
            $plazo=0;
            foreach($idsCreditos as $idsc)
            {
                if($idsc->getCaIdempresa()==$comprobante->getInoTipoComprobante()->getCaIdempresa())
                    $plazo=$idsc->getCaDias();
            }
            $comprobante->setCaPlazo($plazo);
            $comprobante->save();
        }
        /*if($comprobante->getCaIdcomprobante()==147922)
        {
            echo $plazo;
            exit;
        }*/
        //exit;
        /*else
            $plazo=$comprobante->getCaPlazo($plazo);*/
        
        $transout = new IntTransaccionesOut();
        $idinttipo = 7;
        $file="";
        switch ($comprobante->getInoTipoComprobante()->getCaTipo()) {
            case "F":
                $idinttipo = 7;                
                break;
            case "C":
                $idinttipo = 13;
                break;
            case "P":
                $idinttipo = 8;
                break;
            case "D":
                $idinttipo = 20;
                break;
        }
        $idtransaccion = IntTransaccionesOut::procesarTransacciones($idinttipo, $comprobante->getCaIdcomprobante());
        
        if ($idtransaccion!="" && $idtransaccion > 0) {
         //   try {
                $resul = IntTransaccionesOut::enviarWs($idtransaccion,$this->getUser()->getUserId());
                $resul=$resul[0];
                $success = true;
        }
        else
        {
            $success = false;
            $resul= $idtransaccion;
        }
        return $resul;
    }
    
    

   
    public function executeAnularComprobante(sfWebRequest $request) {
        //$conn = Doctrine::getTable("InoMaster")->getConnection();
        //$conn->beginTransaction();
        try {
            $idcomprobante = $request->getParameter("idcomprobante");
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);

            try{
                $datos=json_decode(utf8_encode($comprobante->getCaDatos()));
                $idanticipo=$datos->idanticipo;
                $datos->idanticipo="";
                $comprobante->setCaDatos(json_encode($datos));
                $comprobante->anular($this->getUser()->getUserId());
            } 
            catch (Exception $e) {         
                $resul = $e->getTraceAsString();
                $success = false;
            }   

            $idtransaccion = IntTransaccionesOut::procesarTransacciones("10", $idcomprobante);
            
            if ($idtransaccion!="" && $idtransaccion > 0) {            
                try {                
                    $resul = IntTransaccionesOut::enviarWs($idtransaccion);
                    $resul=$resul[0];
                    
                    if($resul->Status!="0")
                    {                        
                        $comprobante->setCaFchanulado(null);
                        $comprobante->setCaUsuanulado(null);
                        $comprobante->setCaEstado("5");
                        $comprobante->setProperty("msgAnulado",$resul->Message);
                        $datos->idanticipo=$idanticipo;                        
                        $comprobante->setCaDatos(json_encode($datos));
                        $comprobante->save();
                    }
                    else
                    {
                        $tipo = $comprobante->getInoTipoComprobante();                        
                        $fileName = $tipo->getCaTipo().$tipo->getCaComprobante()."-".$comprobante->getCaConsecutivo()."(";
                        
                         $docs = Doctrine::getTable("Archivos")
                            ->createQuery("a")
                            ->select("a.*")                                                        
                            ->where("a.ca_fcheliminado is NULL " )
                            ->addWhere("ca_iddocumental = 7 AND ca_nombre like ? ", "%".$fileName."%" )
                            ->execute();
                         foreach($docs as $d)
                         {
                             $d->setCaUsueliminado($this->getUser()->getUserId());
                             $d->setCafcheliminado(date("Y-m-d H:i:s"));
                             $d->setCaobservacion("Factura Anulada");
                             $d->save();
                         }
                    }
                    $resultado=$resul->Message;

                    $success = true;
                } catch (Exception $e) {         
                    $resul = $e->getTraceAsString();
                    $success = false;
                    //$conn->rollBack();
                }            
            }
            else
            {
                $success = false;
                $resul= $idtransaccion;
            }
            $this->responseArray = array("success" => "true","resul"=>$resultado);
        } catch (Exception $e) {
            //$conn->rollback();
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        $ino = Doctrine::getTable("InoMaster")->find($idmaster);
        $data = array();

        
        $data["creado"] = "Elaborado Por: ". trim(utf8_encode($ino->getCaUsucreado() . " " . $ino->getCaFchcreado()));
        
        
        $data["actualizado"] = "Actualizado Por: ".trim(utf8_encode($ino->getCaUsuactualizado() . " " . $ino->getCaFchactualizado()));

        if(trim(utf8_encode($ino->getCaUsucerrado().$ino->getCaFchcerrado()))!="")
            $data["cerrado"] = "Cerrado Por: ".trim(utf8_encode($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
        else
            $data["cerrado"]="";
            
        /*if(trim(utf8_encode($ino->getCaUsuliquidado().$ino->getCaFchliquidado()))!="")
            $data["liquidado"] = "Liquidado Por: ".trim(utf8_encode($ino->getCaUsuliquidado() . " " . $ino->getCaFchliquidado()));
        else
            $data["liquidado"] ="";
         * 
         */

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeVerHistorialRef(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        
         
        $this->logs = Doctrine::getTable("UsuarioLog")
                        ->createQuery("l")
                        ->select("l.*")                        
                        ->where("l.ca_url = ? ", $idmaster)
                        ->orderBy("ca_id DESC")
                        ->execute();
        $this->setLayout("email");
    }
    
    public function executeVerCompSAP(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");

        $master = Doctrine::getTable("InoMaster")->find($idmaster);
        
        $idempresa="2";
        $datos=json_decode(utf8_encode($master->getCaDatos()));
        
        //echo $master->getCaDatos();
        //print_r($datos);
        if($datos->idempresa!="")
            $idempresa=$datos->idempresa;
        
        $empresa=$bodega = Doctrine::getTable("Empresa")->find($idempresa);
        $path=$empresa->getCaPathsap(); 

        $datos=array();
        $datos["NumeroReferencia"]=$master->getCaReferencia();//"500.05.06.0108.18";
        //$datos["TipoDoc"]="V";
        $datos["Company"]=$path;
        echo "<pre>";
        $this->logs =IntTransaccionesOut::getDocumentsxParam($datos);
        //print_r($this->logs);
        echo "</pre>";
        //exit;

        $this->setLayout("email");
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
        $errorInfo="";
        try {
            
            foreach ($houses as $c) {

                if ($c->idhouse) {
                    $house = Doctrine::getTable("InoHouse")->find($c->idhouse);
                    if(!$house)
                    {
                        echo $house->getCaIdhouse()."<br>";
                        continue;
                    }                    
                } else {
                    $house = new InoHouse();
                    $house->setCaIdmaster($c->idmaster);
                }
                

                if ($c->idreporte != "" && $c->idreporte != "0" ) {
                    $house->setCaIdreporte($c->idreporte);
                }
                //else
                //    continue;

                if ((!$c->doctransporte == "") && (!$c->idcliente == "")) {
                    $mastertmp=Doctrine::getTable("Inomaster")->find($house->getCaIdmaster());
                    $dattmp= json_decode(utf8_encode( $mastertmp->getCaDatos() ) );
                    

                    $q = Doctrine::getTable("InoHouse")
                    ->createQuery("c")
                    ->select("c.*,m.ca_referencia")                              
                    ->innerJoin("c.InoMaster m")                        
                    ->where("m.ca_transporte= ? AND m.ca_impoexpo=? AND c.ca_idhouse != ? AND c.ca_doctransporte=? AND ca_referencia is not null ", array( $mastertmp->getCaTransporte(), $mastertmp->getCaImpoexpo(),$house->getCaIdhouse(),$c->doctransporte ));
                    $docTrans=$q->execute();

                    //$errorInfo.=$q->getSqlQuery()." : ".utf8_encode($mastertmp->getCaTransporte())." : ". utf8_encode($mastertmp->getCaImpoexpo())." : ".utf8_encode($house->getCaIdhouse())." : ".utf8_encode($c->doctransporte)."<br>";

                    if(count($docTrans)>0)
                    {
                        $dat= json_decode(utf8_encode($docTrans[0]->getInoMaster()->getCaDatos()));                        
                        if($dattmp->idempresa==$dat->idempresa)
                        {
                            $errorInfo.="El Documento de transporte ".$c->doctransporte." ya se encuentra en la base de datos, asociado a :".$docTrans[0]->getInoMaster()->getCaReferencia()."<br>";
                            continue;
                        }
                    }

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

                    $houseSea = $house->getInoHouseSea();
                    if ($houseSea->count() < 1)
                        $houseSea = new InoHouseSea();
                    $datos = json_decode(utf8_encode($houseSea->getCaDatos()));                    
                    $datos->equipos = $c->equipos;
                    $houseSea->setCaDatos(json_encode($datos));

                    $houseSea->setCaContinuacion($c->continuacion);
                    $houseSea->setCaContinuacionDest($c->destinofinal);

                    $house->setInoHouseSea($houseSea);

                    $house->save();
                    $ids[] = $c->id;
                    $idshouse[] = $house->getCaIdhouse();
                }
                else
                {
                    $errorInfo.="Por favor llenar los datos de cliente y/o documento de transporte<br>";
                }

            }
            $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "idhouse" => implode(",", $idshouse), "success" => true);
        } catch (Exception $e) {
          $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

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
        
        $success=true;
        $errorInfo="";

        try {
            $facturas = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*")
                        ->innerJoin("c.Cliente cl")
                        ->innerJoin("c.InoComprobante comp")
                        ->leftJoin("comp.InoTipoComprobante tcomp")
                        ->innerJoin("comp.Ids fact")
                        ->where("c.ca_idmaster = ? and comp.ca_fchanulado is null and comp.ca_usuanulado is null and comp.ca_estado in (5) ", $idmaster)
                        ->execute();
            
            
            if(count($facturas)>0)
            {
                $ino = Doctrine::getTable("InoMaster")->find($idmaster);
                if ($opcion == "Liquidar") {
                    $ino->setCaUsuliquidado($this->getUser()->getUserId());
                    $ino->setCaFchliquidado(date("Y-m-d H:i:s"));
                    $this->getUser()->log("Liquidar INO F2", false, array("url" => $idmaster));
                } else {
                    $this->getUser()->log("Cancelar Liquidacion INO F2", false, array("url" => $idmaster));
                    $ino->setCaUsuliquidado(null);
                    $ino->setCaFchliquidado(null);
                }
                $ino->save();
                $conn->commit();
                
                $datos["impoexpo"]=utf8_encode($ino->getCaImpoexpo());
                $datos["transporte"]=utf8_encode($ino->getCaTransporte());
                $datos["fchcerrado"]=$ino->getCaFchcerrado();
                $datos["fchanulado"]=$ino->getCaFchanulado();
                $datos["fchliquidado"]=$ino->getCaFchliquidado();
                $datos["modalidad"]=$ino->getCaModalidad();
                $datos["referencia"]=$ino->getCaReferencia();
                $datos["tipofac"]="0";
                $datos["idticket"]="0";

                $responseArray = array("success" => true, "datos"=>$datos, "usuarioLiquidado" => ($ino->getCaUsuliquidado() . " " . $ino->getCaFchliquidado()));
            }
            else{
                $success=false;
                $errorInfo="No es posible Liquidar porque no posee ingresos.";
                $responseArray= array("success" => $success, "errorInfo" => $errorInfo);
            }
        } catch (Exception $e) {
            $conn->rollBack();
            $success=false;
            $errorInfo=$e->getMessage();
            $responseArray= array("success" => $success, "errorInfo" => $errorInfo);
        }
        
        $this->responseArray = $responseArray;// array("success" => $success, "errorInfo" => $errorInfo);
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

        $success=true;
        $errorInfo="";
        
        try {
            $ino = Doctrine::getTable("InoMaster")->find($idmaster);
            if ($opcion == "Cerrar") {
                
                
                $facturas = Doctrine::getTable("InoHouse")
                        ->createQuery("c")
                        ->select("c.*")
                        ->innerJoin("c.Cliente cl")
                        ->innerJoin("c.InoComprobante comp")
                        ->leftJoin("comp.InoTipoComprobante tcomp")
                        ->innerJoin("comp.Ids fact")
                        ->where("c.ca_idmaster = ? and comp.ca_fchanulado is null and comp.ca_usuanulado is null and comp.ca_estado in (5) ", $idmaster)
                        ->execute();
            
            
                if(count($facturas)>0)
                {
                    $ino = Doctrine::getTable("InoMaster")->find($idmaster);
                    
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
                        if ((round($piezasMaster) == round($totalpiezashouse)) && ( round($pesoMaster) == round($totalpesohouse) ) && (round($volumenMaster) == round($totalvolumenhouse) )) 
                        {
                            $ino->setCaUsucerrado($this->getUser()->getUserId());
                            $ino->setCaFchcerrado(date("Y-m-d H:i:s"));
                            $ino->setCaUsuliquidado($this->getUser()->getUserId());
                            $ino->setCaFchliquidado(date("Y-m-d H:i:s"));

                            $this->getUser()->log("Cerrar INO F2", false, array("url" => $idmaster));

                            $ino->save();
                            $conn->commit();
                    
                            $datos["impoexpo"]=utf8_encode($ino->getCaImpoexpo());
                            $datos["transporte"]=utf8_encode($ino->getCaTransporte());
                            $datos["fchcerrado"]=$ino->getCaFchcerrado();
                            $datos["fchanulado"]=$ino->getCaFchanulado();
                            $datos["fchliquidado"]=$ino->getCaFchliquidado();
                            $datos["modalidad"]=$ino->getCaModalidad();
                            $datos["referencia"]=$ino->getCaReferencia();
                            $datos["tipofac"]="0";
                            $datos["idticket"]="0";
                    
                            $responseArray = array("success" => true, "datos"=>$datos,"usuarioCerrado" => ($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
                        } else {
                            $responseArray = array("success" => false, "errorInfo" => "Los valores De Piezas, peso y volumen no coinciden");
                        }
                    } else {
                        $ino->setCaUsucerrado($this->getUser()->getUserId());
                        $ino->setCaFchcerrado(date("Y-m-d H:i:s"));
                        $ino->setCaUsuliquidado($this->getUser()->getUserId());
                        $ino->setCaFchliquidado(date("Y-m-d H:i:s"));
                        $this->getUser()->log("Cerrar INO F2", false, array("url" => $idmaster));

                        $ino->save();
                        $conn->commit();
                        $datos["impoexpo"]=utf8_encode($ino->getCaImpoexpo());
                        $datos["transporte"]=utf8_encode($ino->getCaTransporte());
                        $datos["fchcerrado"]=$ino->getCaFchcerrado();
                        $datos["fchanulado"]=$ino->getCaFchanulado();
                        $datos["fchliquidado"]=$ino->getCaFchliquidado();
                        $datos["modalidad"]=$ino->getCaModalidad();
                        $datos["referencia"]=$ino->getCaReferencia();
                        $datos["tipofac"]="0";
                        $datos["idticket"]="0";

                        $responseArray = array("success" => true, "datos"=>$datos, "usuarioLiquidado" => ($ino->getCaUsuliquidado() . " " . $ino->getCaFchliquidado()));
                        //$this->responseArray = array("success" => true, "usuarioCerrado" => ($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
                    }
                    $ino->generarComisiones();  /* Método para Causar Comisiones */
                }
                else{
                    $success=false;
                    $errorInfo="No es posible Liquidar porque no posee ingresos.";
                    $responseArray= array("success" => $success, "errorInfo" => $errorInfo);
                }

                
            } else {
                $ino->setCaUsucerrado(null);
                $ino->setCaFchcerrado(null);
                $ino->setCaUsuliquidado(null);
                $ino->setCaFchliquidado(null);                
                $this->getUser()->log("Abrir INO F2", false, array("url" => $idmaster));
                $datos["impoexpo"]=utf8_encode($ino->getCaImpoexpo());
                $datos["transporte"]=utf8_encode($ino->getCaTransporte());
                $datos["fchcerrado"]=$ino->getCaFchcerrado();
                $datos["fchanulado"]=$ino->getCaFchanulado();
                $datos["fchliquidado"]=$ino->getCaFchliquidado();
                $datos["modalidad"]=$ino->getCaModalidad();
                $datos["referencia"]=$ino->getCaReferencia();                
                $datos["tipofac"]="0";
                $datos["idticket"]="0";
                $ino->save();
                $conn->commit();
                $responseArray = array("success" => true, "datos"=>$datos, "usuarioCerrado" => ($ino->getCaUsucerrado() . " " . $ino->getCaFchcerrado()));
            }
        } catch (Exception $e) {
            $conn->rollBack();
            $success=false;
            $errorInfo=$e->getMessage();
            $responseArray= array("success" => $success, "errorInfo" => $errorInfo);
        }
        
        $this->responseArray = $responseArray;// array("success" => $success, "errorInfo" => $errorInfo);
        $this->setTemplate("responseTemplate");
    }

    public function executeHistorialStatus($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        
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
//    public function executeEliminarCosto(sfWebRequest $request) {
//
//        $idinocosto = $request->getParameter("idinocosto");
//        $inoCosto = Doctrine::getTable("InoCosto")->find($idinocosto);
//        $this->forward404Unless($inoCosto);
//
//        try {
//            $inoCosto->delete();
//            $this->responseArray = array("success" => true);
//        } catch (Exception $e) {
//            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
//        }
//
//        $this->setTemplate("responseTemplate");
//    }

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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $costos = Doctrine::getTable("InoCosto")
                ->createQuery("c")
                ->select("c.ca_idinocosto, c.ca_idmaster, c.ca_neto, c.ca_venta, c.ca_factura,c.ca_fchfactura,
                                  c.ca_tcambio, c.ca_tcambio_usd, c.ca_idcosto, p.ca_sigla, i.ca_nombre,
                                  c.ca_idmoneda, c.ca_fchfactura,c.ca_idproveedor,c.ca_idcomprobante,c.ca_fchcreado,c.ca_usucreado, c.ca_idhouse ")
                //->innerJoin("c.InoConcepto cs")
                ->innerJoin("c.Ids i")
                ->where("c.ca_idmaster = ?", $idmaster)
                ->addWhere("c.ca_usuanulado IS NULL")
                ->orderBy("c.ca_idcosto")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();


        foreach ($costos as $key => $val) {
            $data = array();

            

            $data["idmaster"] = $costos[$key]["c_ca_idmaster"];
            $data["idmaster"] = $costos[$key]["c_ca_idmaster"];
            $data["idinocosto"] = $costos[$key]["c_ca_idinocosto"];
            $data["idcosto"] = $costos[$key]["c_ca_idcosto"];
            $data["idcomprobantec"] = $costos[$key]["c_ca_idcomprobante"];
            $data["datoscreacion"] = $costos[$key]["c_ca_usucreado"]." ".$costos[$key]["c_ca_fchcreado"];
            
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
            if($costos[$key]["c_ca_idhouse"]){
                $house = Doctrine::getTable("InoHouse")->find($costos[$key]["c_ca_idhouse"]);
                $data["cliente"] = utf8_encode($house->getCliente()->getCaCompania());
            }else{
                $data["cliente"] = null;
            }                

            if($costos[$key]["c_ca_idcomprobante"]){
                $comprobante = Doctrine::getTable("InoComprobante")->find($costos[$key]["c_ca_idcomprobante"]);
                if($comprobante->getCaUsugenero()){
                    $data["usugenerado"] = $comprobante->getCaUsugenero();
                    $data["fchgenerado"] = $comprobante->getCaFchgenero();
                }else{
                    $data["usugenerado"] = $comprobante->getCaUsucreado();
                    $data["fchgenerado"] = $comprobante->getCaFchcreado();
                }
            }

            $utils = array();
            //$equipos[] = array("sel" => true, "doctransporte" => "1", "idhouse" => "2", 
///                    "idutilidad" => "3", "serial" => "4", "inocosto" => "5", "valor"=>"6");
            $tmputil = Doctrine::getTable("InoHouse")
                    ->createQuery("h")
                    ->select("i.ca_compania as compania, i.ca_vendedor as comercial, h.ca_doctransporte AS doctransporte,u.ca_idutilidad AS idutilidad,h.ca_idhouse AS idhouse ,c.ca_idinocosto AS inocosto,u.ca_valor AS valor,c.ca_idhouse AS idhousecosto")
                    ->innerJoin("h.InoMaster m WITH h.ca_idmaster=m.ca_idmaster")
                    ->innerJoin("m.InoCosto c WITH c.ca_idinocosto=?", $costos[$key]["c_ca_idinocosto"])
                    ->innerJoin("h.Cliente i WITH i.ca_idcliente=h.ca_idcliente")
                    ->leftJoin("h.InoUtilidad u WITH u.ca_idinocosto=?", $costos[$key]["c_ca_idinocosto"])
                    ->where("h.ca_idmaster = ? and u.ca_usuanulado IS NULL", $idmaster)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
            $valor = 0;
            foreach( $tmputil as $u)
            {
                $utils[]=array("sel" => true, "doctransporte" => $u["h_doctransporte"], "idhouse" => $u["h_idhouse"],"idhousecosto" => $u["c_idhousecosto"], 
                    "idutilidad" => $u["u_idutilidad"], "inocosto" => $u["c_inocosto"], "valor"=>$u["u_valor"], "cliente"=> utf8_encode($u["i_compania"]), "comercial"=> utf8_encode($u["i_comercial"]), );
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
                if(is_numeric($dato->venta))
                {
                    $costo->setCaVenta($dato->venta);
                    $costo->save($conn);
                }
                
                foreach ($dato->sobreventas as $t) {
                    
                    if (($t->doctransporte == "" || $t->doctransporte == "null") ||
                            ($t->idhouse == "" || $t->idhouse == "null") ||
                            ( !is_numeric($t->valor))
                    )                                           
                        continue;
                    
                    $inoUtilidad = Doctrine::getTable("InoUtilidad")
                        ->createQuery("u")
                        ->select("u.*")                        
                        ->where("u.ca_idhouse = ? and ca_idinocosto=? ", array($t->idhouse,$t->inocosto))
                        ->fetchOne();
                        //->execute();

                    
                    if(!$inoUtilidad)
                    //if ($t->idutilidad == "null" || $t->idutilidad == "") 
                    {
                        $inoUtilidad = new InoUtilidad();
                        $inoUtilidad->setCaIdhouse($t->idhouse);
                        $inoUtilidad->setCaIdinocosto($t->inocosto);
                        //$inoUtilidad->setCaIdinocosto()
                    } else {
                        //$inoUtilidad = Doctrine::getTable("InoUtilidad")->find($t->idutilidad);
                    }

                    
                    $inoUtilidad->setCaValor($t->valor);
                    //echo $t->valor."<br>";
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $numeroTicket = $request->getParameter("idticket");

        $ticket = Doctrine::getTable("HdeskTicket")
                ->createQuery("t")
                ->addWhere("ca_idticket = ?", $numeroTicket)
                ->fetchOne();
        
        $parametros = ParametroTable::retrieveByCaso("CU110");
        $status = array();
        foreach ($parametros as $p) {
            $status[$p->getCaIdentificacion()] = array("nombre" => utf8_encode($p->getCaValor()), "color" => $p->getCaValor2());
        }
        
        $data = array();
        if ($ticket) {
            $data["ca_titulo"] = utf8_encode("Hallazgo # $numeroTicket " . $ticket->getCaTitle());
            $data["ca_reportado"] = utf8_encode("a " . $ticket->getUsuario()->getCaNombre());
            $data["ca_contacto"] = utf8_encode($ticket->getUsuario()->getSucursal()->getCaNombre() . " Ext." . $ticket->getUsuario()->getCaExtension());
            $data["ca_asignado"] = utf8_encode($ticket->getAssignedTo()->getCaNombre());
            $data["ca_area"] = utf8_encode($ticket->getHdeskGroup()->getCaName());
            $data["ca_proyecto"] = utf8_encode($ticket->getHdeskProject()->getCaName());
            $data["ca_prioridad"] = utf8_encode($ticket->getCaPriority());
            $data["ca_tipo"] = utf8_encode($ticket->getCaType());
            $data["ca_estado"] = utf8_encode($ticket->getCaAction());
            $data["ca_descripcion"] = utf8_encode($ticket->getCaText());
            $data["ca_status"] = isset($status[$ticket->getCaStatus()]) ? utf8_encode($status[$ticket->getCaStatus()]["nombre"]) : "";
            $data["ca_fecha"] = Utils::fechaMes($ticket->getCaOpened());
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosRespuestas(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
            $fecha = $respuesta->getCaCreatedat();
            $data[] = array("ca_encabezado" => utf8_encode("<span style='font-weight: bold;'>".$respuesta->getUsuario()->getCaNombre() ."</span><span style='font-size: 9px;'> -Ext." . $respuesta->getUsuario()->getCaExtension() . "</span>" . "<br/><br/>"),
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

    /*public function executeObtenerIdticket(sfWebRequest $request) {

        $this->responseArray = array("success" => true, "idticket" => "26561");
        $this->setTemplate("responseTemplate");
    }*/

    public function executeGuardarDeducciones(sfWebRequest $request) {

        $idcomprobante = $request->getParameter("idcomprobante");
        /*$comprobante = Doctrine::getTable("InoComprobante")
                ->createQuery("c")
                ->addWhere("c.ca_idcomprobante = ?", $idcomprobante)
                ->fetchOne();*/
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
                        $inoDeduccion->setCaObservaciones($d->observaciones);
                        //$inoDeduccion->setCaTcambio($comprobante->getCaTcambio());
                        $inoDeduccion->setCaTcambio(1);
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
                "observaciones" => $deduccion->getCaObservaciones() );
                //"valor" => ($deduccion->getCaNeto() * $deduccion->getCaTcambio()));
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

//        try 
//        {
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
                // $equipo->setCaIdconcepto($contenedor->idconcepto);
                if (is_integer((int)$contenedor->idconcepto) && (int)$contenedor->idconcepto > 0) {
                    $equipo->setCaIdconcepto($contenedor->idconcepto);
                }
                else if (is_integer((int)$contenedor->concepto)) {                    
                    $equipo->setCaIdconcepto($contenedor->concepto);
                }
                else
                {
                    $equipo->setCaIdconcepto(0);
                }                
                if ($contenedor->idvehiculo != "")
                    $equipo->setCaIdvehiculo($contenedor->idvehiculo);
                $equipo->setCaSerial(utf8_decode($contenedor->serial));
                $equipo->setCaIdmaster($request->getParameter("idmaster"));
                $equipo->setCaNumprecinto(utf8_decode($contenedor->precinto));
                $equipo->setCaObservaciones(utf8_decode($contenedor->observaciones));
                $equipo->setCaCantidad($contenedor->cantidad===""?0:$contenedor->cantidad);
                $equipo->setCaUsuactualizado($this->getUser()->getUserId());
                $equipo->setCaFchactualizado(date('Y-m-d H:i:s'));
                $ids[] = $contenedor->id;

                $equipo->save();
                $idequipos[] = $equipo->getCaIdequipo();
            }
            $this->responseArray = array("success" => true, "ids" => $ids, "idequipos" => $idequipos);
//        } catch (Exception $e) {
//            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
//        } 
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosContenedores(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        $equipos = Doctrine::getTable("InoEquipo")
                ->createQuery("e")
                ->addWhere("e.ca_idmaster = ?", $idmaster)
                ->execute();
        $data = array();
        foreach ($equipos as $equipo) {
            $data[] = array("idequipo" => $equipo->getCaIdequipo(),
                "idconcepto" => $equipo->getCaIdconcepto(),
                "concepto" => $equipo->getConcepto()->getCaConcepto(),
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
                    //if($repgasto->getInoConcepto()->getCaIdpadre()>0)
                    {
                        $data[] = array("idconcepto" => utf8_encode($repgasto->getInoConcepto()->getCaIdconcepto()),
                            "concepto" => utf8_encode($repgasto->getTipoRecargo()->getCaRecargo()),
                            "idpadre" => $repgasto->getInoConcepto()->getCaIdpadre(),
                            "aplicacion" => utf8_encode($repgasto->getCaAplicacion()),
                            "moneda" => utf8_encode($repgasto->getCaIdmoneda()),
                            "cobrar" => $repgasto->getCaCobrarTar(),
                            "agrupador" => utf8_encode($tarifa->getConcepto()->getCaConcepto())
                        );
                    }
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
                        //if($recargo->getInoConcepto()->getCaIdpadre()>0)
                        {
                            $data[] = array("idconcepto" => utf8_encode($recargo->getInoConcepto()->getCaIdconcepto()),
                                "concepto" => utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
                                "idpadre" => $recargo->getTipoRecargo()->getCaIdpadre(),
                                "aplicacion" => utf8_encode($recargo->getCaAplicacion()),
                                "moneda" => utf8_encode($recargo->getCaIdmoneda()),
                                "cobrar" => $recargo->getCaCobrarTar(),
                                "agrupador" => utf8_encode("Recargo general del trayecto")
                            );
                        }
                    }
                }
            }
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDianDepositos($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        $master = Doctrine::getTable("InoMaster")->find($idmaster);
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select distinct ca_idtransportista, ca_nombre, ca_idtransportista from vi_transportistas where ca_idtransportista in (select ca_valor::text from tb_parametros where ca_casouso = 'CU073' and ca_identificacion = 10 and ca_valor2 like '%" . $master->getCaDestino() . "%') and lower(ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' order by ca_nombre";
        $rs = $con->execute($sql);
        $transportistas = $rs->fetchAll();

        $data = array();
        foreach ($transportistas as $transportista) {
            $data[] = array(
                "idtransportista" => $transportista["ca_idtransportista"],
                "nombre" => utf8_encode($transportista["ca_nombre"]). " Nit. " . number_format($transportista["ca_idtransportista"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarMasterRadicacion($request) {
        $idmaster = $request->getParameter("idmaster");
        try {
            $data = array();
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);
            if ($inoMaster) {
                $radicable = true;
                $inoHouses = $inoMaster->getInoHouse();
                foreach ($inoHouses as $inoHouse) {
                    $inoHouseSea = $inoHouse->getInoHouseSea();
                    if (!$inoHouseSea->getCaDatosmuisca()) {
                        $radicable = false;
                    }
                }
                $inoMasterSea = $inoMaster->getInoMasterSea();
                if ($inoMasterSea) {
                    if ($inoMasterSea->getCaDatosmuisca()) {
                        $data = json_decode(utf8_encode($inoMasterSea->getCaDatosmuisca()));
                        $data->fchinicial = substr($data->fchinicial, 0, 10);
                        $data->fchfinal = substr($data->fchfinal, 0, 10);
                        $data->fchmuisca = $inoMasterSea->getCaFchmuisca();
                        $data->usumuisca = $inoMasterSea->getCaUsumuisca();
                    } else {
                        $data['codconcepto'] = 1;
                        $data['tipodocviaje'] = 10;
                        $data['dispocarga'] = 21;
                        $data['precursores'] = 'N';
                        $data['idcondiciones'] = 1;
                        $data['responsabilidad'] = 'S';
                        $data['fchinicial'] = date("Y-m-d", mktime(0,0,0,1,1,date("Y")));
                        $data['fchfinal'] = date("Y-m-d", mktime(0,0,0,12,31,date("Y")));
                    }
                }
            }
            $this->responseArray = array("data" => $data, "total" => count($data), "radicable" => $radicable, "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosPatiosDevolucion($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select cd.ca_ciudad, pt.ca_idpatio, pt.ca_nombre, pt.ca_direccion from pric.tb_patios pt inner join tb_ciudades cd on cd.ca_idciudad = pt.ca_idciudad where lower(pt.ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' order by cd.ca_ciudad, pt.ca_nombre";

        $rs = $con->execute($sql);
        $patios = $rs->fetchAll();

        $data = array();
        foreach ($patios as $patio) {
            $data[] = array(
                "ciudad" =>  utf8_encode($patio["ca_ciudad"]),
                "idpatio" => $patio["ca_idpatio"],
                "nombre" => utf8_encode($patio["ca_nombre"]),
                "direccion" => utf8_encode($patio["ca_direccion"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosAgentesLiberacion($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();

//        $sql = "SELECT p.ca_idproveedor, i.ca_nombre FROM ids.tb_proveedores p JOIN ids.tb_ids i ON p.ca_idproveedor = i.ca_id and p.ca_tipo IN ('ADU','TRI','TRN','OPE','DEP') where lower(i.ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' order by i.ca_nombre";
        $sql = "SELECT i.ca_id, i.ca_nombre FROM ids.tb_ids i where lower(i.ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' order by i.ca_nombre";

        $rs = $con->execute($sql);
        $idss = $rs->fetchAll();

        $data = array();
        foreach ($idss as $ids) {
            $data[] = array(
                "id" => $ids["ca_id"],
                "nombre" => utf8_encode($ids["ca_nombre"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosHouseRadicacion($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        try {
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);
            $inoMasterSea = $inoMaster->getInoMasterSea();
            
            if ($inoMasterSea->getCaDatosmuisca()) {
                $editable = true;
            } else {
                $editable = false;
            }
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
                        $rec->style = "";
                        $rec->idhouse = $inoHouse->getCaIdhouse();
                        $rec->doctransporte = $inoHouse->getCaDoctransporte();
                        if($inoMaster->getCaModalidad()!="PARTICULARES")
                        {
                            $docs=$inoHouse->getDocs("45");
                            
                            if( $rec->dispocarga=="21" && $rec->responsabilidad=="S" && $rec->tipodocviaje=='3' )
                            {
                                if(count($docs)<1)
                                    $rec->style="row_orange";
                            }
                        }
                        $data[] = $rec;
                    } else {
                        $data[] = $campos;
                    }
                }
            }
            $this->responseArray = array("root" => $data, "total" => count($data), "editable" => $editable, "success" => true);
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
                    $data = json_decode(utf8_encode($inoHouseSea->getCaDatosmuisca()));
                    if ($data->bodega == "") {
                        $data->bodega = utf8_encode($inoHouse->getReporte()->getRepUltVersion()->getBodega()->getCaNombre());
                    }
                } else {
                    $con = Doctrine_Manager::getInstance()->connection();
                    $bodega = $inoHouse->getReporte()->getRepUltVersion()->getBodega();
                    $sql = "select ca_razonsocial from tb_dianservicios "
                            . "where ca_identificacion =  '" . $bodega->getCaIdentificacion() . "'";
                    $rs = $con->execute($sql);
                    $razonsocial = $rs->fetchAll(PDO::FETCH_COLUMN);

                    $data['dispocarga'] = 21;
                    $data['tipodocviaje'] = 3;
                    $data['precursores'] = 'N';
                    $data['tipocarga'] = 1;
                    $data['idcondiciones'] = 1;
                    $data['responsabilidad'] = 'S';
                    $data['vlrfob'] = 0;
                    $data['vlrflete'] = 0;
                    $data['mercancia_desc'] = utf8_encode($inoHouse->getReporte()->getRepUltVersion()->getCaMercanciaDesc());
                    $data['bodega'] = utf8_encode($razonsocial[0]);
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

                $datos = json_decode($datos);
                if (!$inoMasterSea->getCaDatosmuisca()){
                    $datos->usucreado = $this->getUser()->getUserId();
                    $datos->fchcreado = date("Y-m-d H:i:s");
                } else {
                    $datos->usuactualizado = $this->getUser()->getUserId();
                    $datos->fchactualizado = date("Y-m-d H:i:s");
                }
                
                $inoMasterSea->setCaDatosmuisca(json_encode($datos));
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

                $datos = json_decode($datos);
                if (!$inoHouseSea->getCaDatosmuisca()){
                    $datos->usucreado = $this->getUser()->getUserId();
                    $datos->fchcreado = date("Y-m-d H:i:s");
                } else {
                    $datos->usuactualizado = $this->getUser()->getUserId();
                    $datos->fchactualizado = date("Y-m-d H:i:s");
                }
                
                $inoHouseSea->setCaDatosmuisca(json_encode($datos));
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


                $idciudad = ($inoMaster->getCaDestino() == "STA-0005") ? "BAQ-0005" : $inoMaster->getCaDestino();
                $ciudad = Doctrine::getTable("Ciudad")->find($idciudad);
                $con = Doctrine_Manager::getInstance()->connection();
                $sql = "select up.ca_login, us.ca_email, us.ca_sucursal from control.tb_usuarios_perfil up";
                $sql .= "  inner join vi_usuarios us on us.ca_login = up.ca_login";
                $sql .= "  where us.ca_sucursal = '" . $ciudad->getCaCiudad() . "' and up.ca_perfil like '%asistente-marítimo-puerto%' and us.ca_activo = true";
                $email->addTo($user->getEmail());
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
                } else {
                    $fchArribo  = $inoEquipo->getInoMaster()->getCaFchllegada();
                    $fchEntrega = date('Y-m-d');
                    $data = array("fecha_entrega" => $fchEntrega, "fecha_arribo" => $fchArribo);
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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idhouse = $request->getParameter("idhouse");
        try {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $inoHouseSea = $inoHouse->getInoHouseSea();
            
            $data = array();
            $liberable = true;
            if ($inoHouseSea) {
                if ($inoHouseSea->getCaDatos()) {
                    $data = json_decode(utf8_encode($inoHouseSea->getCaDatos()));                    
                    $data->fchliberacion = $inoHouseSea->getCaFchliberacion();
                    if ($data->estado_liberacion == "Liberada") {
                        $liberable = false;
                    }
                }
            }
            $this->responseArray = array("data" => $data, "liberable" => $liberable, "total" => count($data), "success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarLiberarDocumentos($request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idhouse = $request->getParameter("idhouse");
        try {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $inoHouseSea = $inoHouse->getInoHouseSea();
            
            $data = array();
            $liberable = false;
            if ($inoHouseSea) {
                if ($inoHouseSea->getCaDatos()) {
                    $data = json_decode(utf8_encode($inoHouseSea->getCaDatos()));
                    $data->fchliberacion = $inoHouseSea->getCaFchliberacion();
                    if ($data->estado_liberacion == "Liberada") {
                        $liberable = true;
                    }
                }
            }
            $this->responseArray = array("data" => $data, "liberable" => $liberable, "total" => count($data), "success" => true);
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
                
                $inoHouseSea->save($conn);
                
                $usuarioLog = new UsuarioLog();
                $usuarioLog->setCaLogin($user);
                $usuarioLog->setCaFchevento(date('Y-m-d h:i:s'));
                $usuarioLog->setCaUrl($inoHouse->getInoMaster()->getCaIdmaster());
                $usuarioLog->setCaEvent("Dar Liberación ".$inoHouse->getCaDoctransporte());
                $usuarioLog->setCaIpaddress($_SERVER['REMOTE_ADDR']);
                $usuarioLog->setCaUseragent($_SERVER['HTTP_USER_AGENT']);
                $usuarioLog->save($conn);
                
                $conn->commit();
                $this->responseArray = array("success" => true, "errorInfo" => "");
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
            try {
                $user = $this->getUser();
                $conn->beginTransaction();
                
                $datos = json_decode(utf8_encode($inoHouseSea->getCaDatos()));
                if ($request->getParameter("idagente")) {
                    $inoHouseSea->setCaFchlibero(date('Y-m-d h:i:s'));
                }
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
                
                $inoHouseSea->save($conn);
                
                $usuarioLog = new UsuarioLog();
                $usuarioLog->setCaLogin($user);
                $usuarioLog->setCaFchevento(date('Y-m-d h:i:s'));
                $usuarioLog->setCaUrl($inoHouse->getInoMaster()->getCaIdmaster());
                $usuarioLog->setCaEvent("Liberó Documentos ".$inoHouse->getCaDoctransporte());
                $usuarioLog->setCaIpaddress($_SERVER['REMOTE_ADDR']);
                $usuarioLog->setCaUseragent($_SERVER['HTTP_USER_AGENT']);
                $usuarioLog->save($conn);
                
                $conn->commit();
                $this->responseArray = array("success" => true, "errorInfo" => "");
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeReversarLiberacion($request) {
        $idhouse = $request->getParameter("idhouse");

        $conn = Doctrine::getTable("InoHouse")->getConnection();

        if ($idhouse) {
            $inoHouse = Doctrine::getTable("InoHouse")->find($idhouse);
            $inoHouseSea = $inoHouse->getInoHouseSea();

            $this->forward404Unless($inoHouseSea);
            try {
                $reversable = false;
                if ($inoHouseSea->getCaFchliberado() && !$inoHouseSea->getCaFchlibero()) {
                    $user = $this->getUser();
                    $conn->beginTransaction();

                    $inoHouseSea->setCaFchliberacion(null);
                        $inoHouseSea->setCaFchliberado(null);

                    $datos = json_decode(utf8_encode(($inoHouseSea->getCaDatos())));
                    unset($datos->estado_liberacion);
                    unset($datos->nota_liberacion);
                    unset($datos->usuliberacion);
                    unset($datos->observaciones);

                    $inoHouseSea->setCaDatos(json_encode($datos));
                    $inoHouseSea->save($conn);

                    $usuarioLog = new UsuarioLog();
                    $usuarioLog->setCaLogin($user);
                    $usuarioLog->setCaFchevento(date('Y-m-d h:i:s'));
                    $usuarioLog->setCaUrl($inoHouse->getInoMaster()->getCaIdmaster());
                    $usuarioLog->setCaEvent("Reversar Liberación ".$inoHouse->getCaDoctransporte());
                    $usuarioLog->setCaIpaddress($_SERVER['REMOTE_ADDR']);
                    $usuarioLog->setCaUseragent($_SERVER['HTTP_USER_AGENT']);
                    $usuarioLog->save($conn);

                    $conn->commit();
                    $reversable = false;
                }
                $this->responseArray = array("success" => true, "reversable" => $reversable, "errorInfo" => "");
            } catch (Exception $e) {
                $conn->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
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
    
    public function executeDuplicarComprobante($request) {
        
        $idcomprobante = $request->getParameter("idcomprobante");
        
        $conn = Doctrine_Manager::getInstance()->getConnection('master');
        $conn->beginTransaction();
        
        
        $comprobantes = Doctrine::getTable("InoComprobante")
                ->createQuery("m")
                ->whereIn("m.ca_idcomprobante", json_decode($idcomprobante))
                //->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
        
        foreach($comprobantes as $comprobante)
        {
        //$comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            $newComprobante=$comprobante->copy(true);

            $newComprobante->setCaConsecutivo(null);
            $newComprobante->setCaFchcomprobante(null);

            $newComprobante->setCaFchcreado(null);
            $newComprobante->setCaUsucreado(null);
            $newComprobante->setCaFchactualizado(null);
            $newComprobante->setCaUsuactualizado(null);
            $newComprobante->setCaFchgenero(null);
            $newComprobante->setCaUsugenero(null);
            $newComprobante->setCaFchanulado(null);
            $newComprobante->setCaUsuanulado(null);
            $newComprobante->setCaEstado(0);
            $newComprobante->setCaValor(null);
            $newComprobante->setCaValor2(null);
            //$newComprobante->setCaPropiedades(null);
            $newComprobante->setCaIdcomprobanteCruce(null);
            $datosjson=json_decode(utf8_encode($comprobante->getCaDatos()));
            $datos["txttrm"]=($datosjson->txttrm);
            //print_r(json_encode($datos));
            //exit;
            $newComprobante->setCaDatos(json_encode($datos));
            $newComprobante->setCaDocentry(null);
            $newComprobante->save($conn);

            $newDetalle = new InoDetalle();
            //$detalles->copy(true);
            $detalles= $comprobante->getInoDetalle();

            foreach( $detalles as $d)
            {
                $newDetalle = $d->copy();
                $newDetalle->setCaIdcomprobante($newComprobante->getCaIdcomprobante());

                $newDetalle->setCaFchcreado(null);
                $newDetalle->setCaUsucreado(null);
                $newDetalle->setCaIdcuenta(null);
                $newDetalle->save($conn);
            }
        }
        $conn->commit();
        $this->responseArray = array("success" => "true", "idcomprobante" => $newComprobante->getCaIdcomprobante());        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeEnviarSap(sfWebRequest $request) {
        
        
        $idcomprobante = $request->getParameter("idcomprobante");
        
        $conn = Doctrine_Manager::getInstance()->getConnection('master');
        $conn->beginTransaction();        
        
        $comprobantes = Doctrine::getTable("InoComprobante")
                ->createQuery("m")
                ->whereIn("m.ca_idcomprobante", json_decode($idcomprobante))
                //->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))
                ->execute();
        
        $q = Doctrine::getTable("IntTransaccionesOut")
                            ->createQuery("tr")
                            ->select("*")          
                            ->where("tr.ca_estado!=? and tr.ca_datos is not null", array("P"))
                            ->limit(1);
        /*foreach($comprobantes as $c)
        {
            $idtransaccion
        }*/
        
        $respuesta=IntTransaccionesOut::enviarWs($idtransaccion);
        //$reporte=IntTransaccionesOut::reporteErrores();
        //exit;
        $this->responseArray = array("respuesta" => $respuesta, "success" => true);        
        $this->setTemplate("responseTemplate");
        
    }

    public function executeValidarGuiaNumero(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $referencia = $request->getParameter("ref");
        $consecutivo = $request->getParameter("datos");
        
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select ca_referencia from tb_expo_awbtransporte where ca_consecutivo = '$consecutivo' limit 1";
        $rs = $con->execute($sql);
        $expoAwbtransporte = $rs->fetch();
        
        if (!$expoAwbtransporte['ca_referencia']){
            $this->responseArray = array("success" => true, "valid" => true);
        }else{
            $this->responseArray = array("success" => true, "valid" => false, "errorInfo" => utf8_encode("Número de guía usado en Referencia ".$expoAwbtransporte['ca_referencia']));
}
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCarriers(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $query = strtolower($this->getRequestParameter("query"));
        $data = array();
        if ($query) {
            $carriers = Doctrine::getTable("ExpoCarrier")
                ->createQuery("c")
                ->addWhere("lower(c.ca_carrier) like '%$query%'")
                //->getSQLQuery();
                ->execute();
            
            foreach ($carriers as $carrier) {
                $data[] = array("idcarrier" => $carrier->getCaIdcarrier(), "carrier" => utf8_encode($carrier->getCaCarrier()));
            }
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeValoresPorDefecto(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $data = array();
        if( $request->getParameter("idconfig") ){
            $config = Doctrine::getTable("ColsysConfig")->find( $request->getParameter("idconfig") );
            $this->forward404Unless($config);
            
            $values = $config->getColsysConfigValue();
            foreach ($values as $value) {
                $data[$value->getCaValue2()] = utf8_encode($value->getCaValue());
            }
        }
        
        if ($request->getParameter("idmaster")) {
            $house = Doctrine::getTable("InoHouse")->findOneBy('ca_idmaster', $request->getParameter("idmaster"));
            $reporte = Doctrine::getTable("Reporte")
                    ->createQuery("r")
                    ->where("r.ca_consecutivo = ?", $house->getReporte()->getCaConsecutivo())
                    ->addWhere("r.ca_fchanulado IS NULL")
                    ->addOrderBy("r.ca_version DESC")
                    ->limit(1)
                    ->fetchOne();
            if($reporte->getCaModalidad() == "DIRECTO"){
                $data['nature_quantity'] = utf8_encode($reporte->getCaMercanciaDesc());
            }
        }
        
        $con = Doctrine_Manager::connection();
        $sql = "select ca_fecha,ca_pesos,ca_euro from tb_trms t order by ca_fecha desc limit 1";
        $trm = $con->fetchArray($sql);
        
        $data['accounting_info'] = "T.C.$ ".number_format($trm[1], 2)."\nHAWB: ".$request->getParameter("referencia");
        $this->responseArray = array("success" => true, "data" => $data);

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosAwbsTransporte(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $this->getRequestParameter("idmaster");
        $documentos = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("e")
                ->addWhere("e.ca_idmaster = ?", $idmaster)
                ->execute();
        $data = array();

        foreach ($documentos as $documento) {
            $data[] = array("iddoctransporte" => $documento->getCaIddoctransporte(),
                "referencia" => $documento->getCaReferencia(),
                "iddestino_uno" => $documento->getCaIddestinoUno(),
                "idcarrier_uno" => $documento->getCaIdcarrierUno(),
                "carrier_uno" => $documento->getExpoCarrierUno()->getCaCarrier(),
                "iddestino_dos" => $documento->getCaIddestinoDos(),
                "idcarrier_dos" => $documento->getCaIdcarrierDos(),
                "carrier_dos" => $documento->getExpoCarrierDos()->getCaCarrier(),
                "iddestino_trs" => $documento->getCaIddestinoTrs(),
                "idcarrier_trs" => $documento->getCaIdcarrierTrs(),
                "carrier_trs" => $documento->getExpoCarrierTrs()->getCaCarrier(),
                "consecutivo" => $documento->getCaConsecutivo(),
                "fchdoctransporte" => $documento->getCaFchdoctransporte(),
                "charges_code" => $documento->getCaChargesCode(),
                "airport_departure" => $documento->getCaAirportDeparture(),
                "airport_destination" => $documento->getCaAirportDestination(),
                "accounting_info" => utf8_encode($documento->getCaAccountingInfo()),
                "handing_info" => utf8_encode($documento->getCaHandingInfo()),
                "number_packages" => $documento->getCaNumberPackages(),
                "kind_packages" => $documento->getCaKindPackages(),
                "gross_weight" => $documento->getCaGrossWeight(),
                "gross_unit" => $documento->getCaGrossUnit(),
                "weight_charge" => $documento->getCaWeightCharge(),
                "weight_details" => $documento->getCaWeightDetails(),
                "kind_rate" => $documento->getCaKindRate(),
                "rate_charge" => $documento->getCaRateCharge(),
                "due_agent" => $documento->getCaDueAgent(),
                "due_carrier" => $documento->getCaDueCarrier(),
                "commodity_item" => $documento->getCaCommodityItem(),
                "delivery_goods" => $documento->getCaDeliveryGoods(),
                "other_charges" => $documento->getCaOtherCharges(),
                "shipper_certifies" => $documento->getCaShipperCertifies(),
                "childrens" => $documento->getCaChildrens(),
                "fchliquidado" => $documento->getCaFchliquidado(),
                "usuliquidado" => $documento->getCaUsuliquidado()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarAwbsTransporte(sfWebRequest $request) {
        $idmaster = $request->getParameter("id");
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if (!$datos->iddoctransporte) {
                $expoAwbtransporte = new ExpoAwbtransporte();
                $expoAwbtransporte->setCaIdmaster($idmaster);
            } else {
                $expoAwbtransporte = Doctrine::getTable("ExpoAwbtransporte")
                        ->createQuery("d")
                        ->addWhere("d.ca_iddoctransporte = ?", $datos->iddoctransporte)
                        ->fetchOne();
            }

            if ($datos->consecutivo) {
                $expoDocNumbers = Doctrine::getTable('ExpoDocNumbers')->find($datos->consecutivo);
                if ($expoDocNumbers) {
                    $expoDocNumbers->setCaReferencia($referencia);
                    $expoDocNumbers->save();
                }
                $expoAwbtransporte->setCaConsecutivo($datos->consecutivo);
            }

            if ($datos->fchdoctransporte) {
                $expoAwbtransporte->setCaFchdoctransporte($datos->fchdoctransporte);
            }
            if ($datos->iddestino_uno) {
                $expoAwbtransporte->setCaIddestinoUno($datos->iddestino_uno);
            }
            if ($datos->idcarrier_uno) {
                $expoAwbtransporte->setCaIdcarrierUno($datos->idcarrier_uno);
            }
            if ($datos->iddestino_dos) {
                $expoAwbtransporte->setCaIddestinoDos($datos->iddestino_dos);
            }
            if ($datos->idcarrier_dos) {
                $expoAwbtransporte->setCaIdcarrierDos($datos->idcarrier_dos);
            }
            if ($datos->iddestino_trs) {
                $expoAwbtransporte->setCaIddestinoTrs($datos->iddestino_trs);
            }
            if ($datos->idcarrier_trs) {
                $expoAwbtransporte->setCaIdcarrierTrs($datos->idcarrier_trs);
            }
            if ($datos->charges_code) {
                $expoAwbtransporte->setCaChargesCode($datos->charges_code);
            }
            if ($datos->airport_departure) {
                $expoAwbtransporte->setCaAirportDeparture($datos->airport_departure);
            }
            if ($datos->airport_destination) {
                $expoAwbtransporte->setCaAirportDestination($datos->airport_destination);
            }
            if ($datos->accounting_info) {
                $expoAwbtransporte->setCaAccountingInfo(utf8_decode($datos->accounting_info));
            }
            if ($datos->handing_info) {
                $expoAwbtransporte->setCaHandingInfo(utf8_decode($datos->handing_info));
            }
            if ($datos->shipper_certifies) {
                $expoAwbtransporte->setCaShipperCertifies(utf8_decode($datos->shipper_certifies));
            }
            $expoAwbtransporte->save();
            $conn->commit();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }
 
     public function executeEliminarAwbsTransporte(sfWebRequest $request) {
        $iddoctransporte = $request->getParameter("id");

        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if ($iddoctransporte) {
                $expoAwbtransporte = Doctrine::getTable("ExpoAwbtransporte")
                        ->createQuery("d")
                        ->addWhere("d.ca_iddoctransporte = ?", $iddoctransporte)
                        ->fetchOne();
                if ($expoAwbtransporte) {
                    $expoAwbtransporte->delete();
                }
            }
            
            $conn->commit();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }   
    
    public function executeGuardarLiquidDocs(sfWebRequest $request) {
        $referencia = $request->getParameter("id");
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if ($datos->iddoctransporte) {
                $expoAwbtransporte = Doctrine::getTable("ExpoAwbtransporte")
                        ->createQuery("d")
                        ->addWhere("d.ca_iddoctransporte = ?", $datos->iddoctransporte)
                        ->fetchOne();
            }
            if (isset($datos->number_packages)) {
                $expoAwbtransporte->setCaNumberPackages($datos->number_packages);
            }
            if (isset($datos->kind_packages)) {
                $expoAwbtransporte->setCaKindPackages($datos->kind_packages);
            }
            if ($datos->gross_weight or $datos->gross_weight == 0) {
                $expoAwbtransporte->setCaGrossWeight($datos->gross_weight);
            }
            if ($datos->gross_unit) {
                $expoAwbtransporte->setCaGrossUnit($datos->gross_unit);
            }
            if ($datos->weight_details) {
                $expoAwbtransporte->setCaWeightDetails($datos->weight_details);
            }
            if ($datos->weight_charge or $datos->weight_charge == 0) {
                $expoAwbtransporte->setCaWeightCharge($datos->weight_charge);
            }
            if ($datos->kind_rate) {
                $expoAwbtransporte->setCaKindRate($datos->kind_rate);
            }
            if ($datos->rate_charge or $datos->rate_charge == 0) {
                $expoAwbtransporte->setCaRateCharge($datos->rate_charge);
            }
            if ($datos->due_agent or $datos->due_agent == 0) {
                $expoAwbtransporte->setCaDueAgent($datos->due_agent);
            }
            if ($datos->due_carrier or $datos->due_carrier == 0) {
                $expoAwbtransporte->setCaDueCarrier($datos->due_carrier);
            }
            if ($datos->delivery_goods) {
                $expoAwbtransporte->setCaDeliveryGoods($datos->delivery_goods);
            }
            if ($datos->commodity_item) {
                $expoAwbtransporte->setCaCommodityItem($datos->commodity_item);
            }
            if ($datos->other_charges) {
                $expoAwbtransporte->setCaOtherCharges($datos->other_charges);
            }
            $expoAwbtransporte->setCaUsuliquidado($this->getUser()->getUserId());
            $expoAwbtransporte->setCaFchliquidado(date("Y-m-d H:i:s"));
            $expoAwbtransporte->save();

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeImprimirAwbsTransporte(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $this->documento = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("e")
                ->addWhere("e.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->fetchOne();
        $this->master = $this->documento->getInoMaster();
        $houses = $this->master->getInoHouse();
        foreach ($houses as $house) {
            $consecutivo = $house->getReporte()->getCaConsecutivo();
            break;
        }

        $this->reporte = Doctrine::getTable("Reporte")
                ->createQuery("r")
                ->where("r.ca_consecutivo = ?", $consecutivo)
                ->addWhere("r.ca_fchanulado IS NULL")
                ->addOrderBy("r.ca_version DESC")
                ->limit(1)
                ->fetchOne();
        $this->empresa = Doctrine::getTable("Empresa")->find(2); // Localiza la empresa Coltrans
        
        $config = Doctrine::getTable("ColsysConfig")->find( 260 );
        $values = $config->getColsysConfigValue();
        $this->config = array();
        foreach ($values as $value) {
            $this->config[$value->getCaValue2()] = utf8_encode($value->getCaValue());
        }
        
        $this->consignatario = Doctrine::getTable("Tercero")->find($this->reporte->getCaIdconsignatario());
        $this->notify = Doctrine::getTable("Tercero")->find($this->reporte->getCaIdnotify());
        $this->usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $this->borrador = ($this->getRequestParameter("borrador")=='true')?true:false;
        $this->plantilla = ($this->getRequestParameter("plantilla")=='true')?true:false;
        $this->copia = ($this->getRequestParameter("copia")=='true')?true:false;
        $this->guiahija = ($this->getRequestParameter("guiahija")=='true')?true:false;
    }

    public function executeImprimirAwbsStickers(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $documento = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("e")
                ->addWhere("e.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->fetchOne();
        $inoMaster = $documento->getInoMaster();
        $this->stickers = array();
        
        $prefijo = $documento->getExpoCarrierUno()->getCaPrefijo();
        $consecutivo = $documento->getCaConsecutivo();
        if ($documento->getCaIddestinoTrs()){
            $destination = $documento->getCaIddestinoTrs();
        }elseif ($documento->getCaIddestinoDos()){
            $destination = $documento->getCaIddestinoDos();
        }else{
            $destination = $documento->getCaIddestinoUno();
        }
        
        $guia_numero = $prefijo. " " .$consecutivo. (($guiahija && count($guias)>1)?chr(65+$key):"");
        $mawb_pieces = $documento->getCaNumberPackages();
        
        if ($documento->getCaChildrens()){
            $guias = json_decode(html_entity_decode($documento->getCaChildrens()), true);
            foreach ($guias as $key => $guia){
                $ref_array = explode(".", $inoMaster->getCaReferencia());
                $prefijo = $ref_array[0];
                // $ref_array[3] = ((count($guias)>1)?substr($ref_array[3],1,3):$ref_array[3]); // Si hay más de una guía hija, quita un cero al consecutivo
                $ref_array[3] = substr($ref_array[3],1,3); // Siempre quitará un dígito al consecutivo para la guía hija
                $consecutivo = $ref_array[1].$ref_array[2].$ref_array[3].$ref_array[4];
                $guia_hija = $prefijo. " " .$consecutivo. ((count($guias)>1)?chr(65+$key):"");

                $numero_stickers = $guia['number_packages'];
                for($i=0; $i< $numero_stickers; $i++){
                    $this->stickers[] = array(
                        "guia_numero" => $guia_numero,
                        "destination" => $destination,
                        "mawb_pieces" => $mawb_pieces,
                        "guia_hija" => $guia_hija,
                        "numero_stickers" => $numero_stickers
                    );
                }
            }
        }else {
            for($i=0; $i< $mawb_pieces; $i++){
                $this->stickers[] = array(
                    "guia_numero" => $guia_numero,
                    "destination" => $destination,
                    "mawb_pieces" => $mawb_pieces,
                    "guia_hija" => "",
                    "numero_stickers" => ""
                );
            }
        }
    }

    public function executeDatosHawbs(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $id = $request->getParameter("id");
        
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select ca_childrens from tb_expo_awbtransporte where ca_iddoctransporte = '$id' limit 1";
        $rs = $con->execute($sql);
        $expoHawbs = $rs->fetch();
        $datos = ($expoHawbs['ca_childrens'])?json_decode($expoHawbs['ca_childrens']):array();
        
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarHawbs(sfWebRequest $request) {
        $id = $request->getParameter("id");
        
        $documento = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("e")
                ->addWhere("e.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->fetchOne();
        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if ($documento){
                $documento->setCaChildrens($request->getParameter("datos"));
                $documento->save();
                $conn->commit();
            }
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");
    }
   
    public function executeDatosLiberacion(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);
        $inoHouses = $inoMaster->getInoHouse();
        
        $datos = array();
        foreach ($inoHouses as $inoHouse) {
            $row = array();
            $inoHouseSea = $inoHouse->getInoHouseSea();
            $json = json_decode(utf8_encode($inoHouseSea->getCaDatos()), true);
            if (!$inoHouseSea->getCaFchliberacion()) {
                $row["estado_liberacion"] = "Sin Liberar";
                $row["nota_liberacion"] = "";
                $row["usuliberacion"] = "";
                $row["observaciones"] = "";
                $row["fchliberacion"] = "";
                $row["color"] = "#ffe6e6";
            } else {
                $row["estado_liberacion"] = $json["estado_liberacion"];
                $row["nota_liberacion"] = $json["nota_liberacion"];
                $row["usuliberacion"] = $json["usuliberacion"];
                $row["observaciones"] = $json["observaciones"]?$json["observaciones"]:"Ninguna";
                $row["fchliberacion"] = $inoHouseSea->getCaFchliberacion();
                if (utf8_encode($json["estado_liberacion"]) == "Liberada") {
                    $row["color"] = "#ffffe6";
                } else {
                    $row["color"] = "#ff0000";
}
                if ($inoHouseSea->getCaFchlibero()) {
                    $row["agente"] = $json["agente"];
                    $row["usulibero"] = $json["usulibero"];
                    $row["detalles"] = $json["detalles"]?$json["detalles"]:"Ninguno";
                    $row["fchlibero"] = $inoHouseSea->getCaFchlibero();
                    $row["color"] = "#ebfaeb";
                }
            }
            $row["usucreado"] = $inoHouse->getCaUsucreado();
            $row["fchcreado"] = $inoHouse->getCaFchcreado();
            $row["usuactualizado"] = $inoHouse->getCaUsuactualizado();
            $row["fchactualizado"] = $inoHouse->getCaFchactualizado();
            $datos[$inoHouseSea->getCaIdhouse()] = $row;
        }
        
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        
        $this->setTemplate("responseTemplate");
    }
   
    public function executeDatosComodato(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $idmaster = $request->getParameter("idmaster");
        $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);
        $inoEquipos = $inoMaster->getInoEquipo();
        
        $datos = array();
        foreach ($inoEquipos as $inoEquipo) {
            $row = array();
            if ($inoEquipo->getCaDatos()) {
                $json = json_decode($inoEquipo->getCaDatos(), true);
                $row["patio"] = utf8_encode($json["patio"]);
                $row["dias_libres"] = utf8_encode($json["dias_libres"]);
                $row["limite_devolucion"] = $json["limite_devolucion"];
                $row["fecha_entrega"] = $json["fecha_entrega"];
                $row["observaciones"] = $json["observaciones"];
                if ($json["devolucion_fch"]) {
                    $row["devolucion_fch"] = $json["devolucion_fch"];
                } else {
                    $row["devolucion_fch"] = "";
                }
            } else {
                $row["patio"] = "Sin Datos de Comodato";
                $row["dias_libres"] = "";
                $row["limite_devolucion"] = "";
                $row["fecha_entrega"] = "";
                $row["observaciones"] = "";
                $row["devolucion_fch"] = "";
            }
            $datos[$inoEquipo->getCaIdequipo()] = $row;
        }
        
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        
        $this->setTemplate("responseTemplate");
    }
    
    
    /*public function EnviarSiigoConect($idcomprobante) {

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
    }*/


    /*public function executeEnviarSiigoConect(sfWebRequest $request) {

        $idcomprobante = $request->getParameter("idcomprobante");
        
        $this->responseArray=$this->EnviarSiigoConect($idcomprobante);
        

        //$this->responseArray = array("success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result, "info" => $info);
        $this->setTemplate("responseTemplate");
    }*/
    
    public function executeGenerarComisiones(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        
        $conn = Doctrine_Manager::getInstance()->connection();
        if ($idmaster) {
//            $sql = "delete from ino.tb_comisiones ic where ic.ca_idhouse in ("
//                    . " select distinct ca_idhouse from ino.tb_house where ca_idmaster = $idmaster"
//                    . ")";
//            $rs = $conn->execute($sql);
            $inoMaster = Doctrine::getTable("InoMaster")->find($idmaster);
            if ($inoMaster) {
                $inoMaster->generarComisiones();
            }
        }else if ($anio && $mes) {
            set_time_limit(0);
            $sql = "select ca_idmaster from ino.tb_master where ca_referencia like '%.%.$mes.%.$anio' and ca_fchcerrado is not null";
            $rs = $conn->execute($sql);
            $casos = $rs->fetchAll();
            
            $i = 1;
            foreach ($casos as $caso) {
                $inoMaster = Doctrine::getTable("InoMaster")->find($caso['ca_idmaster']);
                if ($inoMaster) {
                    echo $i++ . "=> " .$inoMaster->getCaReferencia(). "<br />";
                    $inoMaster->generarComisiones();
                }
            }
        }
        
        $this->setTemplate("responseTemplate");
    }

       
    public function executeLiquidarComisionesExt5(sfWebRequest $request) {
        $this->permisos = array();

        $user = $this->getUser();
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_COMISIONES);
        $tipopermisos = $user->getAccesoTotalRutina(self::RUTINA_COMISIONES);
        foreach ($tipopermisos as $index => $tp) {
            $this->permisos[$index] = in_array($tp, $permisosRutinas) ? true : false;
        }
    }

    public function executeFiltrosComisiones(sfWebRequest $request) {
        $annos = array();
        for ($i = (int) date("Y"); $i >= (date("Y") - 5); $i--) {
            $annos[] = $i;
        }
        
        $meses = array();
        $meses[] = array("idmes" => "01", "nommes" => "Enero");
        $meses[] = array("idmes" => "02", "nommes" => "Febrero");
        $meses[] = array("idmes" => "03", "nommes" => "Marzo");
        $meses[] = array("idmes" => "04", "nommes" => "Abril");
        $meses[] = array("idmes" => "05", "nommes" => "Mayo");
        $meses[] = array("idmes" => "06", "nommes" => "Junio");
        $meses[] = array("idmes" => "07", "nommes" => "Julio");
        $meses[] = array("idmes" => "08", "nommes" => "Agosto");
        $meses[] = array("idmes" => "09", "nommes" => "Septiembre");
        $meses[] = array("idmes" => "10", "nommes" => "Octubre");
        $meses[] = array("idmes" => "11", "nommes" => "Noviembre");
        $meses[] = array("idmes" => "12", "nommes" => "Diciembre");
        
        $usuarios_rs = Doctrine::getTable("Usuario")
           ->createQuery("u")
           ->innerJoin("u.Sucursal s")
           ->addWhere("u.ca_departamento='Comercial' or u.ca_cargo='Representante de Ventas'")
           ->orderBy("u.ca_login")
           ->execute();
        $vendedores = array();
        foreach ($usuarios_rs as $usuario) {
             $vendedores[] = array("login" => $usuario->getCaLogin(), "vendedor" => utf8_encode($usuario->getCaNombre()));
        }
        $vendedores[] = array("login" => "%", "vendedor" => "Todos los Vendedores");
        $criterios = array();
        $criterios[] = "Referencia";
        $criterios[] = "Factura";
        $criterios[] = "Rec.Caja";
        $criterios[] = "Cliente";
        $criterios[] = "Doc.Transporte";
        
        $datos = array("annos" => $annos, "meses" => $meses, "vendedores" => $vendedores, "criterios" => $criterios);
        
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGridComisiones(sfWebRequest $request) {
        $idVendedor = $request->getParameter("idVendedor");
        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        $criterio = $request->getParameter("criterio");
        $cadena = $request->getParameter("cadena");
        $novedades = $request->getParameter("novedades");
        $comprobantes = array();
        
        $q = Doctrine::getTable("InoComision")
           ->createQuery("c")
           ->select("c.ca_idcomision")
           ->addWhere("c.ca_consecutivo IS NOT NULL")
           ->addWhere("c.ca_consecutivo > 0");
        
        if (!$idVendedor) {
            $q->addWhere("c.ca_vendedor = ?", $this->getUser()->getUserId());
        } else if ($idVendedor != "%") {
            $q->addWhere("c.ca_vendedor = ?", $idVendedor);
        }
        if ($anio || $mes || $criterio) {
            $q->innerJoin("c.InoHouse h");
            $q->innerJoin("h.InoMaster m");
        }
        if ($anio || $mes) {
            $referencia = array_fill(0, 5, '%');
            $referencia[2] = $mes?$mes:$referencia[2];
            $referencia[4] = $anio?substr($anio,-2):$referencia[4];
            $referencia = implode(".", $referencia);
            $q->addWhere("m.ca_referencia LIKE '$referencia'");
        }
        if ($criterio == "Referencia"){
            $q->addWhere("m.ca_referencia = ?", $cadena);
        }
        if ($criterio == "Doc.Transporte"){
            $q->addWhere("h.ca_doctransporte like '%$cadena%'");
        }
        if ($criterio == "Cliente"){
            $q->innerJoin("h.Cliente cl");
            $q->addWhere("cl.ca_compania like '%$cadena%'");
        }
        $q->distinct();
        
        $idComisiones = array();    /* Esto solo saca el valor que se encuentra en el arreglo anidado */
        $ids = $q->execute($idComisiones, Doctrine_Core::HYDRATE_NONE);
        foreach ($ids as $id){
            $idComisiones[] = $id[0];
        }
        if (count($idComisiones)) {
            Doctrine_Manager::getInstance()->setCurrentConnection('replica');
            $con = Doctrine_Manager::getInstance()->connection();
            if ($novedades)
                $sql = "SELECT DISTINCT ca_consecutivo, max(u.ca_nombre) as ca_vendedor, max(ca_usuliquidado) as ca_usuliquidado, max(ca_fchliquidado) as ca_fchliquidado, sum(ca_comision) as ca_vlrcomprobante FROM ino.tb_comisiones c inner join control.tb_usuarios u on u.ca_login = c.ca_vendedor where ca_idcomision in (" .implode(",", $idComisiones). ") group by ca_consecutivo order by ca_consecutivo DESC";
            else
                $sql = "SELECT DISTINCT ca_consecutivo, max(ca_fchliquidado) as ca_fchliquidado FROM ino.tb_comisiones c where ca_idcomision in (" .implode(",", $idComisiones). ") group by ca_consecutivo order by ca_consecutivo DESC";
            $rs = $con->execute($sql);
            $comprobantes = $rs->fetchAll();
        }

        $datos = array();
        foreach ($comprobantes as $comprobante) {
            $row["consecutivo"] = $comprobante["ca_consecutivo"];
            $row["fchliquidado"]= $comprobante["ca_fchliquidado"];
            if ($novedades) {
                $row["vendedor"]= utf8_encode($comprobante["ca_vendedor"]);
                $row["usuliquidado"]= $comprobante["ca_usuliquidado"];
                $row["vlrcomprobante"]= $comprobante["ca_vlrcomprobante"];
            }
            $datos[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosGridComisionDetalles(sfWebRequest $request) {
        set_time_limit(0);
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        if ($request->getParameter("consecutivo")) {    // Modo Consulta de detalles de un Comprobante
            $comprobantes = Doctrine::getTable("InoComision")->findBy("ca_consecutivo", $request->getParameter("consecutivo"));
        } else {
            $datos = $request->getParameter("datos");   // Modo Generacion de casos para comisionar
            $datos = json_decode($datos);
            
            $vendedor = (!$datos->idVendedor) ? $this->getUser()->getUserId() : $datos->idVendedor;
            $exclusion = Doctrine::getTable("InoComisionExclusion")
                    ->createQuery("e")
                    ->addWhere("e.ca_exclusion = ?", "Meta")
                    ->addWhere("e.ca_vendedor = ?", $vendedor)
                    ->limit(1)
                    ->fetchOne();
            $exclusiones = array();
            
            $referencia = array_fill(0, 5, '%');
            $referencia[2] = $datos->mes?$datos->mes:$referencia[2];
            $referencia[4] = $datos->anio?substr($datos->anio,-2):$referencia[4];
            $referencia = implode(".", $referencia);
            if ($exclusion) {   // Exclusión por Meta
                $houses = Doctrine::getTable("InoHouse")
                        ->createQuery("h")
                        ->innerJoin("h.InoMaster m")
                        ->addWhere("h.ca_vendedor = ?", $vendedor)
                        ->addWhere("m.ca_referencia like ?", $referencia)
                        ->addWhere("m.ca_fchcerrado IS NOT NULL")
                        ->execute();
                $exclusiones["por_meta"]["meta"] = $exclusion->getCaMeta();
                $exclusiones["por_meta"]["ino"] = 0;
                $exclusiones["por_meta"]["abiertos"] = 0;
                foreach ($houses as $house) {
                    $exclusiones["por_meta"]["ino"]+= $house->getUtilidadPorHouse();
                    if ($house->getInoMaster()->getCaImpoexpo() == Constantes::IMPO && $house->getInoMaster()->getCaTransporte() == Constantes::MARITIMO) {
                        $exclusiones["por_meta"]["ino"]+= $house->getUtilidadPorSobreventa();
                    }
                    $exclusiones["por_meta"]["abiertos"]+= (!$house->getInoMaster()->getCerrado()) ? 1 : 0;
                }
            }
            
            $q = Doctrine::getTable("InoComision")
                    ->createQuery("c")
                    ->innerJoin("c.InoHouse h")
                    ->innerJoin("h.InoMaster m")
                    ->addWhere("c.ca_consecutivo IS NULL")
                    ->addWhere("c.ca_vendedor like ?", $vendedor);
            if (date($datos->anio."-".$datos->mes."-01") >= date('Y-m-01')) {   // No permite ver comisiones del mes corriente
                $q->addWhere("false");
            } else if ($exclusion && ($datos->anio || $datos->mes)) {
                $q->addWhere("m.ca_referencia LIKE '$referencia'");
            } else {
                $corte = date('Y-m-01');    // Fecha por defecto para corte de comisiones es hoy
                if ($datos->mes && $datos->anio) {
                    $corte = date("Y-m-d", mktime(0,0,0,$datos->mes+1,0,$datos->anio));
                }
                $q->addWhere("to_date(right(m.ca_referencia, 2)||substr(m.ca_referencia, 8, 2), 'YYMM') < ?", $corte);
            }
            $comprobantes = $q->execute();
        }
        
        $datos = array();
        $con = Doctrine_Manager::getInstance()->connection();
        foreach ($comprobantes as $comprobante) {
            if (!$comprobante->getCaIdutilidad()) {
                $concepto = "Ingreso General";
            } else {
                $concepto = "Verificar Concepto";
                if( intval(substr($comprobante->getInoHouse()->getInoMaster()->getCaReferencia(),7,2 ))  < 6 && intval(substr($comprobante->getInoHouse()->getInoMaster()->getCaReferencia(),15,2 ))  <= 18 ) 
                {
                    $sql = "select c.ca_concepto from ino.tb_conceptos c where c.ca_idconcepto = ".$comprobante->getInoUtilidad()->getInoCosto()->getCaIdcosto();
                    $st = $con->execute($sql);
                    $costo = $st->fetch();
                    if (count($costo)) {
                        $concepto = utf8_encode($costo["ca_concepto"]);
                    }
                }
                else 
                {
                    $sql = "select c.ca_concepto_esp from ino.tb_maestra_conceptos c where c.ca_idconcepto = ".$comprobante->getInoUtilidad()->getInoCosto()->getCaIdcosto();
                    $st = $con->execute($sql);
                    $costo = $st->fetch();
                    if (count($costo)) {
                        $concepto = utf8_encode($costo["ca_concepto_esp"]);
                    }
                }
            }
            $sel = false;
            $comentario = "";
            $incoterms = explode(" - ", $comprobante->getInoHouse()->getReporte()->getIncotermsStr());
            $stdcircular = $comprobante->getInoHouse()->getCliente()->getCaStdcircular();
            $comisionable = false;
            $pagosRecibidos = array();
            
            $num_facs = array();
            $datosMaster = json_decode($comprobante->getInoHouse()->getInoMaster()->getCaDatos());
            $facturaUnica = $datosMaster->facturaUnica;     // Valida si la refencia tiene multiples houses y una sola factura
            if ($facturaUnica) {
                $sql = "select h1.ca_idhouse from ino.tb_house h1 inner join ino.tb_house h2 on h1.ca_idmaster = h2.ca_idmaster and h2.ca_idhouse = " . $comprobante->getCaIdhouse();
                
                $stmt = $con->execute($sql);
                $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);
                $facturas = Doctrine::getTable("InoComprobante")
                    ->createQuery("c")
                    ->innerJoin("c.InoHouse h")
                    ->innerJoin("h.InoMaster m")
                    ->whereIn("h.ca_idhouse", $rs)
                    ->addWhere("h.ca_idcliente = ?", $comprobante->getInoHouse()->getCaIdcliente())
                    ->addWhere("c.ca_usuanulado IS NULL")
                    ->execute();
            } else {
                $facturas = $comprobante->getInoHouse()->getInoComprobante();
            }
            foreach ($facturas as $factura) {
                if ($factura->getCaUsuanulado()) {
                    continue;
                }
                if ($factura->getInoTipoComprobante()->getCaTipo() == 'F') {
                    $num_facs[] = $factura->getCaConsecutivo();
                }
                if ($factura->getInoTipoComprobante()->getCaTipo() != 'F') {
                    continue;
                } else if (!$factura->getCaIdcomprobanteCruce()) {
                    continue;
                }
                
                $sql = "select c.ca_consecutivo, c.ca_fchcomprobante from ino.tb_comprobantes c where c.ca_idcomprobante = ".$factura->getCaIdcomprobanteCruce()." and c.ca_usuanulado IS NULL";
                $st = $con->execute($sql);
                $comprPago = $st->fetch();
                if (count($comprPago)) {
                    $pagosRecibidos[] = $comprPago["ca_consecutivo"] . " - " . $comprPago["ca_fchcomprobante"];
                }
            }
            $crucescomp = null;

            if (count($pagosRecibidos) >= count($num_facs)){
                $comisionable = true;
                $crucescomp = implode(", ", $pagosRecibidos);
            }
            $num_facs = implode(", ", $num_facs);
            $desmarcable = ($comisionable && $comprobante->getCaComision()<0)?false:true;
            
            
            if (!$comprobante->getInoHouse()->getInoMaster()->getCaUsucerrado()) {
                $comisionable = false;
                $bgcolor = "row_yellow"; // Color Amarillo para Referencias Abiertas
                $comentario = utf8_encode("Referencia abierta, posible reliquidación");
            } else if (!$comisionable) {
                $bgcolor = "row_pink"; // Color Rosado no se puede comisionar
                $comentario = "Factura(s) pendientes de recaudo";
            } else if (!$desmarcable) {
                $sel = true;    // Auditoría si puede desmarcar los degativos
                $desmarcable = ($usuario->getCaDepartamento() == 'Auditoría'?true:false);
                $bgcolor = "row_gray"; // Color Gris para valores negativos
                $comentario = "Obligatorio reintegro";
            } else if ($stdcircular != "Vigente") {
                $comisionable = false;
                $bgcolor = "row_yellow"; // Color Amarillo para clientes con circular vencida
                $comentario = "Cliente con Circular 0170 vencida";
            } else {
                $bgcolor = "row_green"; // Color Verde OK para comisionar
                $comentario = "Ok para cobro de comisiones";
            }
            $is_new = true;
            if ($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() == Constantes::IMPO && $comprobante->getInoHouse()->getInoMaster()->getCaTransporte() == Constantes::AEREO) {
                foreach ($datos as $key => $dato) {
                    if ($dato["idhouse"] == $comprobante->getCaIdhouse()) {
                        $datos[$key]["concepto"] = "Ingreso Individual";
                        $datos[$key]["utilidad"]+= $comprobante->getCaValor();
                        $datos[$key]["comision"]+= $comprobante->getCaComision();
                        $is_new = false;
                        break;
                    }
                }
            }
            if ($is_new) {
                $datos[] = array(
                    "idcomision" => $comprobante->getCaIdcomision(),
                    "llave" => utf8_encode($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo()) . ' - ' . utf8_encode($comprobante->getInoHouse()->getInoMaster()->getCaTransporte()),
                    "idmaster" => $comprobante->getInoHouse()->getInoMaster()->getCaIdmaster(),
                    "idhouse" => $comprobante->getCaIdhouse(),
                    "referencia" => $comprobante->getInoHouse()->getInoMaster()->getCaReferencia(),
                    "doctransporte" => utf8_encode($comprobante->getInoHouse()->getCaDoctransporte()),
                    "cliente" => utf8_encode($comprobante->getInoHouse()->getCliente()->getCaCompania()),
                    "reporte" => $comprobante->getInoHouse()->getReporte()->getCaConsecutivo(),
                    "incoterms" => $incoterms[0],
                    "concepto" => $concepto,
                    "utilidad" => $comprobante->getCaValor(),
                    "comision" => $comprobante->getCaComision(),
                    "facturas" => $num_facs,
                    "crucescomp" => $crucescomp,
                    "usucausado" => $comprobante->getCaUsuactualizado()?$comprobante->getCaUsuactualizado():$comprobante->getCaUsucreado(),
                    "fchcausado" => $comprobante->getCaUsuactualizado()?$comprobante->getCaFchactualizado():$comprobante->getCaFchcreado(),
                    "stdcircular" => $stdcircular,
                    "comisionable" => $comisionable,
                    "desmarcable" => $desmarcable,
                    "bgcolor" => $bgcolor,
                    "comentario" => $comentario,
                    "sel" => $sel
                );
            }
        }
        /* Validacion periodos habiles para comisionar */
        $festivos = TimeUtils::getFestivos();
        list($year, $month) = sscanf(date('Y-m'), "%d-%d");
        $i = 0; 
        $fch_con = new DateTime(date("Y-m-d", mktime(0, 0, 0, $month+1, 0, $year)));
        $fchs_ok = array();
        
        $x = ($fch_con->format("m") == 12)?8:(($fch_con->format("m") == 6)?2:0); // Ventana de dias para Junio y Diciembre
        while ($i < (9 + $x)) {
            if ($fch_con->format("d")!=31 && $fch_con->format("l")!='Saturday' && $fch_con->format("l")!='Sunday' && !in_array($fch_con->format("Y-m-d"), $festivos)) {
                $i++;
                if ($i >= (6 + $x) && $i <= (9 + $x)) { 
                    $fchs_ok[] = $fch_con->format("Y-m-d");
                }
            }
            $fch_con->sub(new DateInterval('P1D'));
        }
        $habilitado = false;
        if ($usuario->getCaDepartamento() == 'Auditoría' || in_array(date('Y-m-d'), $fchs_ok)) {    //, mktime(0,0,0,3,21,2019)
            $habilitado = true;
        }

        $this->responseArray = array("success" => true, "root" => $datos, "exclusiones" => $exclusiones, "habilitado" => $habilitado, "total" => count($datos));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGenerarNovedadesComision(sfWebRequest $request) {
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $datos = $request->getParameter("datos");
        $novedades = json_decode($datos);
        $fchImpreso = new DateTime();

        $subject = null;
        $bodymsg = null;
        $bodytbl = null;
        $vendedor = null;
        $recordtbl = "";
        $valor_total = 0;

        $conn = Doctrine::getTable("HdeskTicket")->getConnection();
        $conn->beginTransaction();
        try {
            foreach ($novedades as $novedad) {
                if (!$subject) {
                    $subject = "Noveades de N\u00F3mina - Comisiones de " . $novedad->vendedor . " a " . $fchImpreso->format("Y-m-d H:i:s");
                    $bodytbl = "<table border=\"1\">"
                            . "     <tr>"
                            . "         <td colspan=\"4\">" . $novedad->vendedor . "</td>"
                            . "     </tr>"
                            . "     <tr>"
                            . "         <th>Consecutivo</th>"
                            . "         <th>Fch.Liquidado</th>"
                            . "         <th>Usu.Liquidado</th>"
                            . "         <th>Valor Comprobante</th>"
                            . "     </tr>"
                            . "     ##tabla_contenido##"
                            . "</table>";
                }
                $consecutivo = $novedad->consecutivo;
                $comisiones = Doctrine::getTable("InoComision")
                        ->createQuery("c")
                        ->addWhere("c.ca_consecutivo = ?", $consecutivo)
                        ->execute();
                $valor_parcial = 0;
                foreach ($comisiones as $comision) {
                    if (!$vendedor) {
                        $vendedor = $comision->getVendedor();
                    }
                    $valor_parcial += $comision->getCaComision();
                    $comision->setCaFchimpreso($fchImpreso->format("Y-m-d H:i:s"));
                    $comision->setCaUsuimpreso($usuario->getCaLogin());
                    //$comision->save();
                }
                $recordtbl .= ""
                        . "<tr>"
                        . "     <td>" . $consecutivo . "</td>"
                        . "     <td>" . $novedad->fchliquidado . "</td>"
                        . "     <td align=\"center\">" . $novedad->usuliquidado . "</td>"
                        . "     <td align=\"right\">" . number_format($valor_parcial, 2, '.', ',') . "</td>"
                        . "</tr>";
                if ($novedad->vlrnovedad != $valor_parcial) {
                    // INCONSISTENCIA FATAL
                    die("Diferencia " . number_format($novedad->vlrnovedad, 2, '.', ',') . " -> " . number_format($valor_parcial, 2, '.', ',') . " = " . number_format($novedad->vlrnovedad - $valor_parcial, 2, '.', ','));
                }
                $valor_total += $valor_parcial;
            }
            $recordtbl .= ""
                    . "<tr>"
                    . "     <td align=\"right\" colspan=\"3\"><strong>GRAN TOTAL...:</strong></td>"
                    . "     <td align=\"right\"><strong>" . number_format($valor_total, 2, '.', ',') . "</strong></td>"
                    . "</tr>";
            $bodytbl = str_replace("##tabla_contenido##", $recordtbl, $bodytbl);
            $bodymsg = "Respetados, cordial saludo:<br /><br />"
                    . "Sirvase encontrar adjunto, el archivo correspondiente a las $subject, correspondiente a (el/los) siguiente(s) soportes(s):"
                    . "<br /><br />$bodytbl<br /><br />"
                    . "Cordialmente"
                    . "<br /><br /><br /><br />" . $usuario->getFirmaHTML();

            /*
             * Se crea el ticket con las noveades para nómina.
             */
            $ticket = new HdeskTicket();
            $ticket->setCaIdgroup(48);  // 01- Nómina Coltrans
            $ticket->setCaLogin($usuario->getCaLogin());
            $ticket->setCaTitle($subject);
            $ticket->setCaText($bodymsg);
            $ticket->setCaPriority("Baja");
            $ticket->setCaOpened(date("Y-m-d H:i:s"));
            $ticket->setCaAction("Abierto");
            $ticket->save();

            /*
             * Se crea la tarea para los miembros del grupo.
             */
            $request->setParameter("id", $ticket->getCaIdticket());
            $request->setParameter("format", "email");
            $titulo = "Nuevo Ticket #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]";
            $texto = "Se ha creado un nuevo ticket \n\n<br /><br />";
            $texto.= $bodymsg;

            $grupo = $ticket->getHdeskGroup();

            $tarea = new NotTarea();
            $tarea->setCaUrl("/pm/verTicket?id=" . $ticket->getCaIdticket());
            $tarea->setCaIdlistatarea(1);
            $tarea->setCaFchcreado(date("Y-m-d H:i:s"));
            $tarea->setTiempo(TimeUtils::getFestivos(), $grupo->getCaMaxresponsetime());
            $tarea->setCaUsucreado($usuario->getCaLogin());
            $tarea->setCaTitulo($titulo);
            $tarea->setCaTexto($texto);
            $tarea->save($conn);
            $tarea->notificar();

            $ticket->setCaIdtarea($tarea->getCaIdtarea());
            $ticket->save($conn);
            $conn->commit();

            /*
             * Se genera archivo plano con las noveades para nómina.
             */
            $columnas = Utils::camposArchivoPlanoHeinsohn();
            $registro = array_fill(0, count($columnas) - 1, '');
            $fchImpreso->modify('last day of this month');
            if ($fchImpreso->format("d") > 30) {
                $fchImpreso->sub("P1D");
            }

            $registro[0] = 1;
            $registro[1] = "C";
            $registro[2] = $vendedor->getCaDocidentidad();
            $registro[3] = "COMISIONES PRESTACIONALES";
            $registro[4] = 4;
            $registro[6] = $valor_total;
            $registro[7] = "Y";
            $registro[8] = 1;
            $registro[16] = "0001001";
            $registro[24] = $fchImpreso->format("Y-m-d");

            $idticket = $ticket->getCaIdticket();
            $directorio = $ticket->getDirectorio();

            if (!is_dir($directorio)) {
                mkdir($directorio, 0755, true);
            }
            $file = "Novedades-" . $idticket . "-" . $fchImpreso->format("Ymd") . ".csv";
            $handle = fopen($directorio . DIRECTORY_SEPARATOR . $file, "w");

            $current = utf8_encode(implode(";", $columnas));
            $current .= "\r\n";
            $current .= utf8_encode(implode(";", $registro));
            fwrite($handle, $current);
            fclose($handle);

            $datos = array("idticket" => $ticket->getCaIdticket());
            $this->responseArray = array("success" => true, "datos" => $datos, "total" => count($datos));
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeCasosFacturaSinDoccruce(sfWebRequest $request) {
        set_time_limit(0);
        $comprobantes = Doctrine::getTable("InoComision")
                ->createQuery("c")
                ->innerJoin("c.InoHouse h")
                ->innerJoin("h.InoMaster m")
                ->addWhere("c.ca_consecutivo IS NULL")
                ->addWhere("to_date(right(m.ca_referencia, 2)||substr(m.ca_referencia, 8, 2), 'YYMM') < ?", date('Y-m-01'))
                ->execute();
        
        $datos = array();
        foreach ($comprobantes as $comprobante) {
            if (!$comprobante->getCaIdutilidad()) {
                $concepto = "Ingreso General";
            } else {
                $costo = Doctrine::getTable("InoMaestraConceptos")->find($comprobante->getInoUtilidad()->getInoCosto()->getCaIdcosto());
                if ($costo) {
                    $concepto = utf8_encode($costo->getCaConceptoEsp());
                } else {
                    $concepto = "Revisar concepto";
                }
            }
            $sel = false;
            $comentario = "";
            $incoterms = explode(" - ", $comprobante->getInoHouse()->getReporte()->getIncotermsStr());
            $stdcircular = $comprobante->getInoHouse()->getCliente()->getCaStdcircular();
            $comisionable = false;
            $pagosRecibidos = array();
            $facturas = $comprobante->getInoHouse()->getInoComprobante();
            $num_facs = "";
            $ven_facs = true;
            foreach ($facturas as $factura) {
                if ($factura->getInoTipoComprobante()->getCaTipo() == 'F') {
                    $num_facs.= $factura->getCaConsecutivo().", ";
                    if ($factura->getFchVencimiento() > date('Y-m-d')) {
                        $ven_facs = false;
                    }
                }
                if ($factura->getInoTipoComprobante()->getCaTipo() == 'F' && !$factura->getCaFchanulado()) {
                    continue;
                } else if (!$factura->getCaIdcomprobanteCruce()) {
                    continue;
                }
                $comprPago = Doctrine::getTable("InoComprobante")
                    ->createQuery("c")
                    ->addWhere("c.ca_idcomprobante = ?", $factura->getCaIdcomprobanteCruce())
                    ->addWhere("c.ca_usuanulado IS NULL")
                    ->fetchOne();
                
                if ($comprPago) {
                    $pagosRecibidos[] = $comprPago->getCaConsecutivo() . " - " . $comprPago->getCaFchcomprobante();
                }
            }
            $num_facs = substr($num_facs, 0, strlen($num_facs)-2);
            $crucescomp = null;
            if (count($pagosRecibidos) > 0){
                $comisionable = true;
                $crucescomp = implode(", ", $pagosRecibidos);
            }
            $desmarcable = ($comisionable && $comprobante->getCaComision()<0)?false:true;
            
            if (!$desmarcable) {
                $sel = true;
                $bgcolor = "row_gray"; // Color Rojo para valores negativos
                $comentario = "Obligatorio reintegro";
            } else if (!$comisionable) {
                $bgcolor = "row_pink"; // Color Rosado no se puede comisionar
                $comentario = "Factura(s) pendientes de recaudo";
            } else if (!$comprobante->getInoHouse()->getInoMaster()->getCaUsucerrado()) {
                $comisionable = false;
                $bgcolor = "row_yellow"; // Color Amarillo para Referencias Abiertas
                $comentario = utf8_encode("Referencia abierta, posible reliquidación");
            } else if ($stdcircular != "Vigente") {
                $comisionable = false;
                $bgcolor = "row_yellow"; // Color Amarillo para clientes con circular vencida
                $comentario = "Cliente con Circular 0170 vencida";
            } else {
                $bgcolor = "row_green"; // Color Verde OK para comisionar
                $comentario = "Ok para cobro de comisiones";
            }
            $is_new = true;
            if ($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() == Constantes::IMPO && $comprobante->getInoHouse()->getInoMaster()->getCaTransporte() == Constantes::AEREO) {
                foreach ($datos as $key => $dato) {
                    if ($dato["idhouse"] == $comprobante->getCaIdhouse()) {
                        $datos[$key]["concepto"] = "Ingreso Individual";
                        $datos[$key]["utilidad"]+= $comprobante->getCaValor();
                        $datos[$key]["comision"]+= $comprobante->getCaComision();
                        $is_new = false;
                        break;
                    }
                }
            }
            if ($is_new) {
                if ($comentario != "Ok para cobro de comisiones" && $comentario != "Obligatorio reintegro") {
                    $datos[] = array(
                        "idcomision" => $comprobante->getCaIdcomision(),
                        "llave" => utf8_encode($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo()) . ' - ' . utf8_encode($comprobante->getInoHouse()->getInoMaster()->getCaTransporte()),
                        "idmaster" => $comprobante->getInoHouse()->getInoMaster()->getCaIdmaster(),
                        "idhouse" => $comprobante->getCaIdhouse(),
                        "referencia" => $comprobante->getInoHouse()->getInoMaster()->getCaReferencia(),
                        "doctransporte" => utf8_encode($comprobante->getInoHouse()->getCaDoctransporte()),
                        "cliente" => utf8_encode($comprobante->getInoHouse()->getCliente()->getCaCompania()),
                        "vendedor" => $comprobante->getCaVendedor(),
                        "reporte" => $comprobante->getInoHouse()->getReporte()->getCaConsecutivo(),
                        "incoterms" => $incoterms[0],
                        "concepto" => $concepto,
                        "utilidad" => $comprobante->getCaValor(),
                        "comision" => $comprobante->getCaComision(),
                        "facturas" => $num_facs,
                        "vencidas" => $ven_facs?"SI":"NO",
                        "crucescomp" => $crucescomp,
                        "stdcircular" => $stdcircular,
                        "comentario" => $comentario
                    );
                }
            }
        }
        echo "<table>";
        foreach ($datos as $dato) {
            echo "<tr>";
            foreach ($dato as $field) {
                echo "<td>";
                echo utf8_decode($field);
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        die("Fin del Listado");
    }
    
    public function executeDatosGridCasosAbiertos(sfWebRequest $request) {
        $idVendedor = $request->getParameter("idVendedor");
        $vendedor = (!$idVendedor) ? $this->getUser()->getUserId() : $idVendedor;
        $houses = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->innerJoin("h.InoMaster m")
                ->addWhere("h.ca_vendedor = ?", $vendedor)
                ->addWhere("m.ca_fchcerrado IS NULL")
                ->addWhere("m.ca_fchanulado IS NULL")
                ->addWhere("m.ca_referencia IS NOT NULL")
                ->addWhere("m.ca_impoexpo <> ?", Constantes::OTMDTA)
                ->orderBy("m.ca_fchreferencia")
                ->orderBy("m.ca_referencia")
                ->execute();
        foreach ($houses as $house) {
            $incoterms = explode(" - ", $house->getReporte()->getIncotermsStr());
            $stdcircular = $house->getCliente()->getCaStdcircular();
            $datos[] = array(
                "llave" => Utils::mesLargo(substr($house->getInoMaster()->getCaReferencia(), 7, 2)) . " / " . substr($house->getInoMaster()->getCaReferencia(), -2),
                "idmaster" => $house->getInoMaster()->getCaIdmaster(),
                "referencia" => $house->getInoMaster()->getCaReferencia(),
                "doctransporte" => utf8_encode($house->getCaDoctransporte()),
                "cliente" => utf8_encode($house->getCliente()->getCaCompania()),
                "reporte" => $house->getReporte()->getCaConsecutivo(),
                "incoterms" => $incoterms[0],
                "stdcircular" => $stdcircular
            );
        }
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeProcesarComisiones(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $comprobantes = Doctrine::getTable("InoComision")
                ->createQuery("c")
                ->innerJoin("c.InoHouse h")
                ->innerJoin("h.InoMaster m")
                ->addWhere("c.ca_consecutivo IS NULL")
                ->whereIn("c.ca_idcomision", $datos)
                ->execute();

        $conn = Doctrine_Manager::getInstance()->connection();
        $conn->beginTransaction();
        try {
            $sql = "SELECT nextval('ino.tb_comisiondoc_id')";
            $stmt = $conn->execute($sql);
            $nextVal = $stmt->fetchAll(PDO::FETCH_COLUMN);

            foreach ($comprobantes as $comprobante) {
                //if ($house->getInoMaster()->getCaImpoexpo() == Constantes::IMPO && $house->getInoMaster()->getCaTransporte() == Constantes::AEREO) {
                if ($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() == Constantes::IMPO && $comprobante->getInoHouse()->getInoMaster()->getCaTransporte() == Constantes::AEREO) {
                    $subcomprobantes = Doctrine::getTable("InoComision")
                            ->createQuery("c")
                            ->addWhere("c.ca_consecutivo IS NULL")
                            ->addWhere("c.ca_idhouse = ?", $comprobante->getCaIdhouse())
                            ->execute();
                    foreach ($subcomprobantes as $subcomprobante) {
                        $subcomprobante->setCaConsecutivo($nextVal[0]);
                        $subcomprobante->setCaFchliquidado(date("Y-m-d H:i:s"));
                        $subcomprobante->setCaUsuliquidado($this->getUser()->getUserId());
                        $subcomprobante->save($conn);
                    }
                } else {
                    $comprobante->setCaConsecutivo($nextVal[0]);
                    $comprobante->setCaFchliquidado(date("Y-m-d H:i:s"));
                    $comprobante->setCaUsuliquidado($this->getUser()->getUserId());
                    $comprobante->save($conn);
                }
            }

            $conn->commit();
            $this->responseArray = array("success" => true, "idcomp" => $nextVal);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeImprimirComisiones(sfWebRequest $request) {
        if ($request->getParameter("consecutivo")) {
            $comprobantes = Doctrine::getTable("InoComision")
                    ->createQuery("c")
                    ->innerJoin("c.InoHouse h")
                    ->innerJoin("h.InoMaster m")
                    ->addWhere("ca_consecutivo = ?", $request->getParameter("consecutivo"))
                    ->orderBy("m.ca_impoexpo, m.ca_transporte, m.ca_idmaster")
                    ->execute();

            $this->comprobante = null;
            $this->usuario = $this->getUser();
            $this->vendedor = null;
            $this->liquidado= null;

            $this->datos = array();
            foreach ($comprobantes as $comprobante) {
                $this->liquidado= Doctrine::getTable("Usuario")->find($comprobante->getCaUsuliquidado());
                if (!$this->vendedor) {
                    $this->comprobante = $comprobante;
                    $this->vendedor = Doctrine::getTable("Usuario")->find($comprobante->getCaVendedor());
                }
                $incoterms = explode(" - ", $comprobante->getInoHouse()->getReporte()->getIncotermsStr());
                if (!$comprobante->getCaIdutilidad()) {
                    $concepto = "Ingreso General";
                } else {
                    $costo = Doctrine::getTable("InoMaestraConceptos")->find($comprobante->getInoUtilidad()->getInoCosto()->getCaIdcosto());
                    if ($costo) {
                        $concepto = utf8_encode($costo->getCaConceptoEsp());
                    } else {
                        $concepto = "Revisar concepto";
                    }
                }
                $pagosRecibidos = array();
                $num_facs = "";
                $facturas = $comprobante->getInoHouse()->getInoComprobante();
                foreach ($facturas as $factura) {
                    if ($factura->getInoTipoComprobante()->getCaTipo() == 'F' && !$factura->getCaFchanulado()) {
                        $num_facs .= $factura->getCaConsecutivo() . ", ";
                    }
                    if ($factura->getInoTipoComprobante()->getCaTipo() != 'F') {
                        continue;
                    } else if (!$factura->getCaIdcomprobanteCruce()) {
                        continue;
                    }

                    $comprPago = Doctrine::getTable("InoComprobante")
                            ->createQuery("c")
                            ->addWhere("c.ca_idcomprobante = ?", $factura->getCaIdcomprobanteCruce())
                            ->addWhere("c.ca_usuanulado IS NULL")
                            ->fetchOne();

                    if ($comprPago) {
                        $pagosRecibidos[] = $comprPago->getCaConsecutivo() . " - " . $comprPago->getCaFchcomprobante();
                    }
                }
                $crucescomp = null;
                if (count($pagosRecibidos) > 0) {
                    $crucescomp = implode(", ", $pagosRecibidos);
                }
                $is_new = true;
                if ($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() == Constantes::IMPO && $comprobante->getInoHouse()->getInoMaster()->getCaTransporte() == Constantes::AEREO) {
                    foreach ($this->datos as $key => $dato) {
                        if ($dato["idhouse"] == $comprobante->getCaIdhouse()) {
                            $this->datos[$key]["concepto"] = "Ingreso Individual";
                            $this->datos[$key]["utilidad"] += $comprobante->getCaValor();
                            $this->datos[$key]["comision"] += $comprobante->getCaComision();
                            $is_new = false;
                            break;
                        }
                    }
                }
                if ($is_new) {
                    $this->datos[] = array(
                        "idcomision" => $comprobante->getCaIdcomision(),
                        "llave" => $comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() . ' - ' . $comprobante->getInoHouse()->getInoMaster()->getCaTransporte(),
                        "idmaster" => $comprobante->getInoHouse()->getInoMaster()->getCaIdmaster(),
                        "idhouse" => $comprobante->getCaIdhouse(),
                        "referencia" => $comprobante->getInoHouse()->getInoMaster()->getCaReferencia(),
                        "doctransporte" => $comprobante->getInoHouse()->getCaDoctransporte(),
                        "cliente" => $comprobante->getInoHouse()->getCliente()->getCaCompania(),
                        "reporte" => $comprobante->getInoHouse()->getReporte()->getCaConsecutivo(),
                        "incoterms" => $incoterms[0],
                        "concepto" => $concepto,
                        "utilidad" => $comprobante->getCaValor(),
                        "comision" => $comprobante->getCaComision(),
                        "facturas" => $num_facs,
                        "crucescomp" => $crucescomp,
                        "usucausado" => $comprobante->getCaUsuactualizado() ? $comprobante->getCaUsuactualizado() : $comprobante->getCaUsucreado(),
                        "fchcausado" => $comprobante->getCaUsuactualizado() ? $comprobante->getCaFchactualizado() : $comprobante->getCaFchcreado()
                    );
                }
            }
        }
    }

    public function executeRegistrarObservacionIdg(sfWebRequest $request){
       
        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();

        $datos = json_decode($request->getParameter("datos"));
        $error = 0;

        try {
            if (count($datos) > 0) {
                foreach ($datos as $dt) {
                    if ($dt->id) {
                        $registro = Doctrine::getTable("InoIndicadores")->find($dt->id);
                    } else {
                        $idcomprobante = $dt->idcomprobante;
                        $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                        if ($comprobante) {
                            $registro = $comprobante->getInoIndicadores();
                        } else {
                            $error++;
                            $mensaje = "No existe el comprobante: " . $idcomprobante;                            
                        }
                    }

                    if ($registro) {
                        $datos = json_decode(utf8_encode($registro->getCaDatos()));
                        if ($dt->observaciones)
                            $datos->observaciones = $dt->observaciones;
                        else
                            $datos->observaciones = null;

                        $registro->setCaIdexclusion($dt->idexclusion);
                        $registro->setCaDatos(json_encode($datos));
                        $registro->save($conn);
                        
                    }else {
                        $error++;
                        $mensaje = "No existe el indicador solicitado";  
                    }
                }
                if($error >0){
                    $conn->rollback();
                    $this->responseArray = array("success" => true, "consecutivo" => $registro->getCaIdcaso(), "errorInfo" => utf8_encode($mensaje));                    
                }else{
                    $conn->commit();
                    $this->responseArray = array("success" => true, "consecutivo" => $registro->getCaIdcaso(), "errorInfo" => "");
                }
            } else {
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo" => "No existen datos para guardar");
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }    
    
    public function executeGuardarDo(sfWebRequest $request){
       
        
        $idcomprobante = $request->getParameter("idcomprobante");
        $do = $request->getParameter("do");
        
        if ($idcomprobante) {
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante); 
            
            $datos=json_decode(utf8_encode($comprobante->getCaDatos()),true);

            $datos["do"]=$do;
            
            $comprobante->setCaDatos(json_encode($datos));
            $comprobante->save();
        }
        
        $this->responseArray = array("success" => true, "consecutivo" => $comprobante->getCaConsecutivo(), "errorInfo"=>"");
        
        $this->setTemplate("responseTemplate");
        
    }
   
    public function executePruebaComisionDetalles(sfWebRequest $request) {
        set_time_limit(0);
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $q = Doctrine::getTable("InoComision")
                ->createQuery("c")
                ->innerJoin("c.InoHouse h")
                ->innerJoin("h.InoMaster m")
                ->addWhere("c.ca_consecutivo IS NOT NULL")
                ->addWhere("m.ca_fchreferencia between ? and ?", array("2019-01-01", "2019-03-31"));
        $comprobantes = $q->execute();
        
        echo "<table border=1>";
        $datos = array();
        foreach ($comprobantes as $comprobante) {
            if (!$comprobante->getCaIdutilidad()) {
                $concepto = "Ingreso General";
            } else {
                $concepto = "Verificar Concepto";
                if( intval(substr($comprobante->getInoHouse()->getInoMaster()->getCaReferencia(),7,2 ))  < 6 && intval(substr($comprobante->getInoHouse()->getInoMaster()->getCaReferencia(),15,2 ))  <= 18 ) 
                {
                    $costo = Doctrine::getTable("InoConcepto")->find($comprobante->getInoUtilidad()->getInoCosto()->getCaIdcosto());
                    if ($costo) {
                        $concepto = utf8_encode($costo->getCaConcepto());
                    }
                }
                else 
                {
                    $costo = Doctrine::getTable("InoMaestraConceptos")->find($comprobante->getInoUtilidad()->getInoCosto()->getCaIdcosto());
                    if ($costo) {
                        $concepto = utf8_encode($costo->getCaConceptoEsp());
                    }
                }
            }
            $incoterms = explode(" - ", $comprobante->getInoHouse()->getReporte()->getIncotermsStr());
            $stdcircular = $comprobante->getInoHouse()->getCliente()->getCaStdcircular();
            $pagosRecibidos = array();
            
            $num_facs = array();
            $datosMaster = json_decode($comprobante->getInoHouse()->getInoMaster()->getCaDatos());
            $facturaUnica = $datosMaster->facturaUnica;     // Valida si la refencia tiene multiples houses y una sola factura
            if ($facturaUnica) {
                $con = Doctrine_Manager::getInstance()->connection();
                $sql = "select h1.ca_idhouse from ino.tb_house h1 inner join ino.tb_house h2 on h1.ca_idmaster = h2.ca_idmaster and h2.ca_idhouse = " . $comprobante->getCaIdhouse();
                
                $stmt = $con->execute($sql);
                $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);
                $facturas = Doctrine::getTable("InoComprobante")
                    ->createQuery("c")
                    ->innerJoin("c.InoHouse h")
                    ->innerJoin("h.InoMaster m")
                    ->whereIn("h.ca_idhouse", $rs)
                    ->addWhere("h.ca_idcliente = ?", $comprobante->getInoHouse()->getCaIdcliente())
                    ->addWhere("c.ca_usuanulado IS NULL")
                    ->execute();
            } else {
                $facturas = $comprobante->getInoHouse()->getInoComprobante();
            }
            foreach ($facturas as $factura) {
                if ($factura->getCaUsuanulado()) {
                    continue;
                }
                if ($factura->getInoTipoComprobante()->getCaTipo() == 'F') {
                    $num_facs[] = $factura->getCaConsecutivo();
                }
                if ($factura->getInoTipoComprobante()->getCaTipo() != 'F') {
                    continue;
                } else if (!$factura->getCaIdcomprobanteCruce()) {
                    continue;
                }
                
                $comprPago = Doctrine::getTable("InoComprobante")
                    ->createQuery("c")
                    ->addWhere("c.ca_idcomprobante = ?", $factura->getCaIdcomprobanteCruce())
                    ->addWhere("c.ca_usuanulado IS NULL")
                    ->fetchOne();
                
                if ($comprPago) {
                    $pagosRecibidos[] = $comprPago->getCaConsecutivo() . " - " . $comprPago->getCaFchcomprobante();
                }
            }
            $crucescomp = null;

            if (count($pagosRecibidos) >= count($num_facs)){
                $crucescomp = implode(", ", $pagosRecibidos);
            }
            $num_facs = implode(", ", $num_facs);
            $is_new = true;
            if ($comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() == Constantes::IMPO && $comprobante->getInoHouse()->getInoMaster()->getCaTransporte() == Constantes::AEREO) {
                foreach ($datos as $key => $dato) {
                    if ($dato["idhouse"] == $comprobante->getCaIdhouse()) {
                        $datos[$key]["concepto"] = "Ingreso Individual";
                        $datos[$key]["utilidad"]+= $comprobante->getCaValor();
                        $datos[$key]["comision"]+= $comprobante->getCaComision();
                        $is_new = false;
                        break;
                    }
                }
            }
            if ($is_new) {
                echo "<tr>";
                    echo "<td>".$comprobante->getCaConsecutivo()."</td>";
                    echo "<td>".$comprobante->getCaIdcomision()."</td>";
                    echo "<td>".$comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() . ' - ' . $comprobante->getInoHouse()->getInoMaster()->getCaTransporte()."</td>";
                    echo "<td>".$comprobante->getInoHouse()->getInoMaster()->getCaIdmaster()."</td>";
                    echo "<td>".$comprobante->getCaIdhouse()."</td>";
                    echo "<td>".$comprobante->getInoHouse()->getInoMaster()->getCaReferencia()."</td>";
                    echo "<td>".$comprobante->getInoHouse()->getCaDoctransporte()."</td>";
                    echo "<td>".$comprobante->getInoHouse()->getCliente()->getCaCompania()."</td>";
                    echo "<td>".$comprobante->getInoHouse()->getReporte()->getCaConsecutivo()."</td>";
                    echo "<td>".$incoterms[0]."</td>";
                    echo "<td>".$concepto."</td>";
                    echo "<td>".$comprobante->getVendedor()->getSucursal()->getCaNombre()."</td>";
                    echo "<td>".$comprobante->getCaVendedor()."</td>";
                    echo "<td>".$comprobante->getCaValor()."</td>";
                    echo "<td>".$comprobante->getCaComision()."</td>";
                    echo "<td>".$num_facs."</td>";
                    echo "<td>".$crucescomp."</td>";
                    echo "<td>".($comprobante->getCaUsuactualizado()?$comprobante->getCaUsuactualizado():$comprobante->getCaUsucreado())."</td>";
                    echo "<td>".($comprobante->getCaUsuactualizado()?$comprobante->getCaFchactualizado():$comprobante->getCaFchcreado())."</td>";
                    echo "<td>".$comprobante->getCaUsuliquidado()."</td>";
                    echo "<td>".$comprobante->getCaFchliquidado()."</td>";
                    echo "<td>".$stdcircular."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        die();
        //$this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        $this->setTemplate("responseTemplate");
    }
}
