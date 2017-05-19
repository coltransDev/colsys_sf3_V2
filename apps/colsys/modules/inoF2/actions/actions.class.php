<?php

/**
 * gestDocumental actions.
 *
 * @package    colsys
 * @subpackage gestDocumental
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

        //$response = sfContext::getInstance()->getResponse();
        //$response->addJavaScript("extExtras/FileUploadField",'last');

        /*$this->modo = Doctrine::getTable("Modo")
                ->createQuery("m")
                ->addWhere("m.ca_impoexpo = 'INTERNO'")
                ->addWhere("m.ca_transporte = 'Terrestre'")
                ->fetchOne();
*/
        //var permisos={'Consultar':true,'Crear':true,'Editar':true,'Anular':true,'Cerrar':true,'Liquidar':true,'General':true,'House':true,'Facturacion':true,'Costos':true,'Documentos':true}
        /* $this->permisos=array(
          'Consultar'=>true,'Crear'=>true,'Editar'=>true,'Anular'=>true,'Cerrar'=>true,'Liquidar'=>true,
          'General'=>true,'House'=>true,'Facturacion'=>true,'Costos'=>true,'Documentos'=>true);
         *
         */
        $this->permisos = array();
        /*$this->permisos["aereo"] = array(
            'Consultar' => true, 'Crear' => true, 'Editar' => true, 'Anular' => true, 'Liquidar' => true, 'Cerrar' => true,
            'General' => true, 'House' => true, 'Facturacion' => true, 'Costos' => true, 'Documentos' => true
        );
        $this->permisos["maritimo"] = array(
            'Consultar' => true, 'Crear' => true, 'Editar' => true, 'Anular' => true, 'Liquidar' => true, 'Cerrar' => true,
            'General' => true, 'House' => true, 'Facturacion' => true, 'Costos' => true, 'Documentos' => true
        );
        $this->permisos["terrestre"] = array(
            'Consultar' => true, 'Crear' => true, 'Editar' => true, 'Anular' => true, 'Liquidar' => true, 'Cerrar' => true,
            'General' => true, 'House' => true, 'Facturacion' => true, 'Costos' => true, 'Documentos' => true
        );
        $this->permisos["exportacion"] = array(
            'Consultar' => true, 'Crear' => true, 'Editar' => true, 'Anular' => true, 'Liquidar' => true, 'Cerrar' => true,
            'General' => true, 'House' => true, 'Facturacion' => true, 'Costos' => true, 'Documentos' => true
        );
        $this->permisos["otm"] = array(
            'Consultar' => true, 'Crear' => true, 'Editar' => true, 'Anular' => true, 'Liquidar' => true, 'Cerrar' => true,
            'General' => true, 'House' => true, 'Facturacion' => true, 'Costos' => true, 'Documentos' => true
        );*/
        $user = $this->getUser();
        
        $permisosRutinas["aereo"] = $user->getControlAcceso(self::RUTINA_AEREO);        
        $permisosRutinas["maritimo"] = $user->getControlAcceso(self::RUTINA_MARITIMO);
        
        $permisosRutinas["terrestre"] = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $permisosRutinas["exportacion"] = $user->getControlAcceso(self::RUTINA_EXPORTACION);
        $permisosRutinas["otm"] = $user->getControlAcceso(self::RUTINA_OTM);

        $tipopermisos=array('Consultar'=>0, 'Crear'=>1, 'Editar'=>2, 'Anular'=>3, 'Liquidar'=>4, 'Cerrar'=>5,'Abrir'=>6, 'General'=>7, 'House'=>8, 'Facturacion'=>9, 'Costos'=>10, 'Documentos'=>11);

        foreach($permisosRutinas as $k=>$p)
        {
            foreach($tipopermisos as $index=>$tp)
            {
                $this->permisos[$k][$index]=isset($permisosRutinas[$k][$tp])?true:false;
            }            
        }
        
        //print_r($this->permisos);
        //exit;
        //echo json_encode($this->permisos);
        $this->inoMaster = Doctrine::getTable("InoMaster")
                ->createQuery("m")
                ->addWhere("m.ca_idmaster = ?", array($request->getParameter("idmaster")))                
                ->execute();
        
        
        
    }

    /* function executeDatosIndex($request) {
      $idproceso = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
      $tree = array("text" => "Proceso/Riesgo","leaf" => true,"id" => "1");

      if($idproceso==0)
      {

      $childrens1=array();

      if($this->permisos["maestras"])
      {
      $childrens1[] = array("text" => "Cuentas Contables","leaf" => true,"id" => "1");
      $childrens1[] = array("text" => "Conceptos","leaf" => true,"id" => "2");
      $childrens[] = array("text" => utf8_encode("Administración"),"leaf" =>false,"children"=>$childrens1);
      }
      $childrens1=array();
      $childrens1[] = array("text" => "Consulta","leaf" => true,"id" => "3");
      //$childrens1[] = array("text" => "Conceptos","leaf" => true,"id" => "2");

      $childrens[] = array("text" => "Comprobantes","leaf" =>false,"children"=>$childrens1);

      $childrens1=array();
      $childrens1[] = array("text" => utf8_encode("Facturación"),"leaf" => true,"id" => "4");
      $childrens[] = array("text" => "Coldepositos","leaf" =>false,"children"=>$childrens1);

      }

      $tree["children"] = $childrens;

      $this->responseArray = $tree;
      $this->setTemplate("responseTemplate");
      } */

    function executeDatosBusqueda($request) {

        
        $user = $this->getUser();
        
        /*Accesos del usuario*/
        $permisosRutinas["aereo"] = $user->getControlAcceso(self::RUTINA_AEREO);        
        $permisosRutinas["maritimo"] = $user->getControlAcceso(self::RUTINA_MARITIMO);
        
        $permisosRutinas["terrestre"] = $user->getControlAcceso(self::RUTINA_TERRESTRE);
        $permisosRutinas["exportacion"] = $user->getControlAcceso(self::RUTINA_EXPORTACION);
        $permisosRutinas["otm"] = $user->getControlAcceso(self::RUTINA_OTM);

        $tipopermisos=array('Consultar'=>0, 'Crear'=>1, 'Editar'=>2, 'Anular'=>3, 'Liquidar'=>4, 'Cerrar'=>5,'Abrir'=>6, 'General'=>7, 'House'=>8, 'Facturacion'=>9, 'Costos'=>10, 'Documentos'=>11);

        foreach($permisosRutinas as $k=>$p)
        {
            foreach($tipopermisos as $index=>$tp)
            {
                //$permisos[$k][$index]=$permisosRutinas[$k][$tp];
                $permisos[$k][$index]=isset($permisosRutinas[$k][$tp])?true:false;
            }            
        }

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
                ->where("" . $where, $whereq)
                ->orderBy("ca_fchcreado DESC")
                ->limit(40)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $where = "";
        $whereq = array();
        $wherePermisos = " (";
        if ($permisos["aereo"]["Consultar"]) {
            if ($where != "")
                $where .=" OR ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $whereq[] = Constantes::IMPO;
            $whereq[] = Constantes::AEREO;
        }

        if ($permisos["maritimo"]["Consultar"]) {
            if ($where != "")
                $where .=" OR ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $whereq[] = Constantes::IMPO;
            $whereq[] = Constantes::MARITIMO;
        }

        if ($permisos["terrestre"]["Consultar"]) {
            //echo "ss";
            if ($where != "")
                $where .=" OR ";
            $where .= "(ca_impoexpo = ? AND ca_transporte=? ) ";
            $whereq[] = Constantes::INTERNO;
            $whereq[] = Constantes::TERRESTRE;
        }

        if ($permisos["exportacion"]["Consultar"]) {
            if ($where != "")
                $where .=" OR ";
            $where .= "(ca_impoexpo = ?  ) ";
            $whereq[] = Constantes::EXPO;
        }

        if ($permisos["otm"]["Consultar"]) {
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

        //error_reporting(E_ALL);
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


        //$estilo = json_encode(array("estiloIno"=> $style));
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
        //$totales =array("doctransporte"=>"TOTALES") ;
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

    public function executeDatosFacturas(sfWebRequest $request) {
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
            $consecutivo.=($d["comp_ca_consecutivo"] == "") ? " Sin Generar - " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
            $consecutivo.=" - " . utf8_encode($d["ids_ca_nombre"]) . " - " . $d["c_ca_doctransporte"];

            if ($d["clH_ca_compania"] != $d["ids_ca_nombre"])
                $consecutivo.= " - " . utf8_encode($d["clH_ca_compania"]);


            if ($d["comp_ca_fchgenero"] != "" && $d["comp_ca_usugenero"] != "")
                $consecutivo.= "({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})";

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
                /* "valor"=>$d["det_ca_cr"] , */
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
    }

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
//                        ->innerJoin("comp.InoHouse h")                        
                ->innerJoin("c.Cliente clH")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                //->leftJoin("comp.InoDetalle det WITH det.ca_idconcepto is not null AND ( (ca_cr>0 AND tcomp.ca_tipo='F') or (ca_db>0 AND tcomp.ca_tipo<>'F' ) )")
                ->leftJoin("comp.Ids fact")
                ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                //->leftJoin("comp.Ctarteiva criv")
                //->leftJoin("comp.Ctaiva ci")
                //->innerJoin("tcomp.InoCentroCosto ccosto")
                //->leftJoin("comp.Moneda m")
                //->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                ->where("c.ca_idmaster = $idmaster  ")
                ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

//        echo $this->idmaster."<br>";
        //echo $q->getSqlQuery();
        //exit;
        $datos = $q->execute();
        $this->data = array();

        foreach ($datos as $d) {
            $consecutivo = ($d["tcomp_ca_tipo"] == "F") ? "FACTURA " : (($d["tcomp_ca_tipo"] == "C") ? "<span class=row_yellow>NOTA CREDITO</span>" : "");
            $consecutivo.=($d["comp_ca_consecutivo"] == "") ? " Sin Gen. " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
            $file = ($d["tcomp_ca_tipo"] == "F" && $d["comp_ca_consecutivo"] != "") ? "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"] : "";
            $file = "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"];

            $house = $d["c_ca_doctransporte"];
            if ($d["clH_ca_compania"] != $d["ids_ca_nombre"])
                $house.= " - " . utf8_encode($d["clH_ca_compania"]);

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
//$consecutivo.=" - ".utf8_encode($d["ids_ca_nombre"])." - ".$d["c_ca_doctransporte"];
            //print_r($d);
            //exit;
            $rc = "";
            if ($d["comp_ca_idcomprobante_cruce"] != "" && $d["comp_ca_idcomprobante_cruce"] != null) {
                $idcomp = $d["comp_ca_idcomprobante_cruce"];
                $compro = Doctrine::getTable("InoComprobante")->find($idcomp);
                $fecha = $rest = substr($compro->getCaFchcreado(), 0, -9);
                $tipocruce = $compro->getInoTipoComprobante()->getCaTipo();
                if ($tipocruce == "R")
                    $rc = "<table class='recibocaja' id='intermitente'  ><td>   <div id='foot' style='width:280px; font-weight: bold; text-align: center;'   >RC: #" . $compro->getCaConsecutivo() . "  " . $fecha . "  $" . number_format($compro->getCaValor(), 2, ",", ".") . "</div> </td></table>";
            }


            $valor = ($d["comp_ca_valor"] != "") ? $d["comp_ca_valor"] : (($d["c_ca_valor3"]>=$d["c_ca_valor4"])?$d["c_ca_valor3"]:$d["c_ca_valor4"]);
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

    /* public function executeDatosGridCostosPanel(sfWebRequest $request) {
      $idmaster = $request->getParameter("idmaster");
      $this->forward404Unless($idmaster);

      $costos = Doctrine::getTable("InoCosto")
      ->createQuery("c")
      ->select("c.ca_idinocosto, c.ca_idmaster, c.ca_neto, c.ca_venta, c.ca_factura,
      c.ca_tcambio, c.ca_tcambio_usd, c.ca_idcosto, p.ca_sigla, i.ca_nombre,
      c.ca_idmoneda, cs.ca_concepto,c.ca_fchfactura,c.ca_idproveedor ")
      ->innerJoin("c.InoConcepto cs")
      ->innerJoin("c.Ids i")
      ->where("c.ca_idmaster = ?", $idmaster)
      ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
      ->execute();

      foreach ($costos as $key => $val) {
      $costos[$key]["i_ca_nombre"] = utf8_encode($costos[$key]["i_ca_nombre"]);
      $costos[$key]["cs_ca_concepto"] = utf8_encode($costos[$key]["cs_ca_concepto"]);
      $costos[$key]["orden"] = utf8_encode($costos[$key]["ca_idinocosto"]);
      }

      //$costos[]["cs_ca_concepto"]="+";
      //$costos[]["orden"]="z";

      $this->responseArray = array("success" => true, "root" => $costos, "total" => count($costos));
      $this->setTemplate("responseTemplate");
      } */

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
                } else
                    $ino->setCaMaster($request->getParameter("ca_master"));



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


            /* $inotimpocomprobante = Doctrine::getTable("InoTipoComprobante")->find($idtipocomprobante);
              $consecutivo = intval($inotimpocomprobante->getCaNumeracionActual()) + 1;
              $inotimpocomprobante->setCaNumeracionActual($consecutivo);
              $inotimpocomprobante->save($conn);


              $comprobante->setCaConsecutivo($consecutivo);
              $comprobante->setCaFchcomprobante(date("Y-m-d")); */
            //$idcliente = ($request->getParameter("idclienteF")!="")?$request->getParameter("idclienteF"):$house->getCliente()->getCaIdcliente();

            $comprobante->setCaIdsucursal($idsucursal);

            $comprobante->setCaId($sucursal->getIds()->getCaId());
            $comprobante->setCaIdhouse($idhouse);
            //$comprobante->setCaValor( $valor );
            $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));
            $comprobante->setCaTcambio($request->getParameter("tcambio"));
            
            $comprobante->setCaIdccosto($request->getParameter("cc"));


            //$comprobante->setCaPlazo($request->getParameter("plazo"));
            //$comprobante->setCaObservaciones($request->getParameter("observaciones"));

            $comprobante->setProperty("bienestrans", $request->getParameter("bienestrans"));
            $comprobante->setProperty("detalle", $request->getParameter("detalle"));
            $comprobante->setProperty("anexos", $request->getParameter("anexos"));
            $comprobante->setProperty("idcontacto", $request->getParameter("idcontacto"));

            //$comprobante->save();
            $comprobante->save($conn);

            /*if ($idcliente_old != $idcliente) {
                $detalles = $comprobante->getInoDetalle();
                foreach ($detalles as $d) {
                    $d->setCaId($idcliente);
                    $d->save($conn);
                }
            }*/

            $conn->commit();

            $this->responseArray = array("success" => "true","idcomprobante"=>$comprobante->getCaIdcomprobante());
       /* } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }*/
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
                $inoDetalle->setCaIdconcepto(is_numeric($t->concepto)?$t->concepto:$t->idconcepto );
                $inoDetalle->setCaId($comprobante->getCaId());
                $inoDetalle->save($conn);

                $ids[] = $t->id;
                $ids_reg[] = $inoDetalle->getCaIddetalle();
                $valor+=$t->valor;
            }
            $conn->commit();
            $this->responseArray = array("errorInfo" => "", "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
       /* } catch (Exception $e) {

            $errorInfo.=$e->getMessage() . "<br>";
            $this->responseArray = array("errorInfo" => $errorInfo, "success" => false);
            //echo $e->getMessage();
        }*/


        $this->setTemplate("responseTemplate");
    }
    public function executeEliminarGridFacturacion(sfWebRequest $request){
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        
        try{
            $conn = Doctrine::getTable("InoDetalle")->getConnection();
            $conn->beginTransaction();
            foreach ($datos as $dato){
                $inoDetalle = Doctrine::getTable("InoDetalle")
                        ->createQuery("i")
                        ->addWhere("i.ca_idconcepto = ? and i.ca_idcomprobante = ?", array($dato->idconcepto, $dato->idcomprobante))
                        ->fetchOne();
                if ($inoDetalle){
                    $inoDetalle->delete();
                }
            }
            $conn->commit();
            $this->responseArray = array("errorInfo" => "error", "success" => true);
        }catch(Exception $e){
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

                /* $inoDetalle = Doctrine::getTable("InoDetalle")->find($t->iddetalle);
                  if(!$inoDetalle)
                  $inoDetalle = new InoDetalle();

                  $inoDetalle->setCaIdcomprobante( $t->idcomprobante );
                  if($tipoComprobante->getCaTipo()=="C")
                  $inoDetalle->setCaDb( $t->valor );
                  else
                  $inoDetalle->setCaCr( $t->valor );
                  $inoDetalle->setCaIdconcepto( $t->idconcepto );
                  $inoDetalle->setCaId( $comprobante->getCaId() );
                  $inoDetalle->save( $conn );
                 * 
                 */

                $ids[] = $t->id;
                //$inoUtilidad->getCaIdutilidad()
                $ids_reg[] = $inoUtilidad->getCaIdutilidad();
                //$valor+=$t->valor;            
            }

            $conn->commit();
        }
        /* catch(Exception $e)
          {
          $errorInfo.=$e->getMessage()."<br>";
          //echo $e->getMessage();
          } */

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
            $this->responseArray = array("success" => true ,"errorInfo" =>"");
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
        if($request->getParameter("idcomprobante")>0)
        {
            $idcomprobante = $request->getParameter("idcomprobante");
            $this->forward404Unless($idcomprobante);
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
                    ->where("comp.ca_idcomprobante = $idcomprobante  ")
                    ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

    //        echo $this->idmaster."<br>";
            //echo $q->getSqlQuery();
            //exit;
            $datos = $q->execute();
            

            foreach ($datos as $d) {
                $consecutivo = ($d["tcomp_ca_tipo"] == "F") ? "FACTURA " : (($d["tcomp_ca_tipo"] == "C") ? "<span class='row_yellow'>NOTA CREDITO</span>" : "");
                $consecutivo.=($d["comp_ca_consecutivo"] == "") ? " Sin Generar - " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
                $consecutivo.=" - " . utf8_encode($d["ids_ca_nombre"]) . " - " . $d["c_ca_doctransporte"];

                if ($d["clH_ca_compania"] != $d["ids_ca_nombre"])
                    $consecutivo.= " - " . utf8_encode($d["clH_ca_compania"]);


                if ($d["comp_ca_fchgenero"] != "" && $d["comp_ca_usugenero"] != "")
                    $consecutivo.= "({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})";

                $class = "";
                if ($d["comp_ca_estado"] == "5") {
                    $class = "row_green";
                    //$consecutivo="<span class='row_green'>$consecutivo</span>";
                } else if ($d["comp_ca_estado"] == "6") {
                    $class = "row_pink";
                    //$consecutivo="<span class='row_pink'>$consecutivo</span>";
                } else if ($d["comp_ca_estado"] == "8") {
                    $class = "row_purple";
                    //$consecutivo="<span class='row_purple'>$consecutivo</span>";
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
                    /* "valor"=>$d["det_ca_cr"] , */
                    "idconcepto" => $d["det_ca_idconcepto"],
                    "concepto" => utf8_encode($d["det_ca_idconcepto"] . "-" . $d["s_ca_descripcion"]),
                    "iddetalle" => $d["det_ca_iddetalle"], "estado" => $d["comp_ca_estado"],
                    "cuentapago" => $cuenta_forma_pago, "idccosto" => $d["tcomp_ca_idccosto"],
                    "class" => $class
                );
            }
            $sql=$q->getSqlQuery();
        }
        else
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
               // print_r($this->data);
                $sql="";
        }
        //print_r($this->data);
        //echo $consecutivo;
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

    
    
    public function executeGenerarFactura(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $ncomprobante = $request->getParameter("ncomprobante");
        $errorInfo= $info = "";
        $ids = array();

        $inoDetalle = new InoDetalle();
        $conn = $inoDetalle->getTable()->getConnection();

        $conn->beginTransaction();
        $house=null;
        $total=0;
        $impuestos=array();
        $retfte=array();
        $autoret=0;
        //try
        {
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            $tipoComprobante = $comprobante->getInoTipoComprobante();
            if(trim($ncomprobante)!="")
            {
                $consecutivo=  $ncomprobante;
            }
            else{
                $consecutivo=  intval($tipoComprobante->getCaNumeracionActual())+1;
                $tipoComprobante->setCaNumeracionActual($consecutivo);
                $tipoComprobante->save($conn);
            }
            
            $regContributivo=$comprobante->getIds()->getIdsCliente()->getProperty('regimen_contributivo');

            $house = Doctrine::getTable("InoHouse")->find($comprobante->getCaIdhouse());
            /*if(!$house)
            {
                echo "dd";
                exit;
            }*/

            $movs = Doctrine::getTable("InoDetalle")
                ->createQuery("det")
                ->select("det.*,s.*,tcomp.ca_ctarteica,cric.ca_rteica")
                ->innerJoin("det.InoComprobante comp")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                //->innerJoin("tcomp.InoCentroCosto ccosto")
                ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                ->addWhere("det.ca_idconcepto IS NOT NULL")
                ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
                ->addOrderBy("s.ca_pt DESC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
            /*echo Doctrine::getTable("InoDetalle")
                ->createQuery("det")
                ->select("det.*,s.*,tcomp.ca_ctarteica,cric.ca_rteica")
                ->innerJoin("det.InoComprobante comp")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                //->innerJoin("tcomp.InoCentroCosto ccosto")
                ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                ->addWhere("det.ca_idconcepto IS NOT NULL")
                ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
                ->addOrderBy("s.ca_pt DESC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->getSqlQuery();
            echo $idcomprobante."<br>";*/
            
            foreach ($movs as $m) {
                if($tipoComprobante->getCaTipo()=="C")
                    $valortmp=($m["det_ca_db"]*$comprobante->getCaTcambio());
                else
                    $valortmp=($m["det_ca_cr"]*$comprobante->getCaTcambio());

                if($m["s_ca_idconceptosiigo"]>0)
                {
                    //echo "1611-";
                    if($m["s_ca_iva"]=="S")
                    {
                        $ctaiva = $tipoComprobante->getCaCtaiva();//ParametroTable::retrieveByCaso("CU232",$tipoComprobante->getCaCtaiva());
                        //echo "1615-";
                        if($ctaiva!="")
                        {
                            //$cuentaImp = $q1[0];
                            $valoriva=round($valortmp * ($m["s_ca_porciva"]/100));
                            $impuestos[$ctaiva]+=$valoriva;
                            //echo "1621($ctaiva)-";
                            //reteiva
                            if($regContributivo=="G" )//gran contribuyente 
                            {
                                /*$q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."4");
                                if($q1[0])
                                {
                                    $impuestos[$q1[0]->getCaValor()] += round(  ($valoriva * 15)/100);
                                }*/
                                //echo "1630-";
                                $ctarteiva = $tipoComprobante->getCaCtarteiva();//ParametroTable::retrieveByCaso("CU232",$tipoComprobante->getCaCtaiva());
                                if($ctarteiva!="")
                                {
                                    //echo "1634($ctarteiva)-";
                                    $impuestos[$ctarteiva] += round(  ($valoriva * 15)/100);
                                }                                
                                
                            }
                        }
                    }
                    //echo "s_ca_autoret:".$m["s_ca_autoret"]."<br>basear:".$valortmp."|".($m["s_ca_basear"]*$comprobante->getCaTcambio())."<br>";
                    if($m["s_ca_autoret"]=="S" && $valortmp>=($m["s_ca_basear"]*$comprobante->getCaTcambio()))
                    {
                        //echo "1644-";
                        $autoret+=round($valortmp * (4/100));
                        //$valortmp=0;
                        //continue;
                    }
                    //RETEICA
                    //echo "regContributivo:".$regContributivo."<br>s_ca_pt:".($m["s_ca_pt"])."<br>";
                    if($regContributivo=="G" && $m["s_ca_pt"]=="P")//gran contribuyente e ingresos propios
                    {
                        //echo "1653({$m["tcomp_ca_ctarteica"]})-";
                        $impuestos[$m["tcomp_ca_ctarteica"]]+=round($valortmp * ($m["cric_ca_rteica"]/100));
                    }                    
                }                
                $total+=$valortmp;
                //echo "<br>";
            }

            $totalsinimpuestos=$total;
            
            //print_r($impuestos);
            
            //$conn->rollback();
            //exit;
            foreach($impuestos as $cuenta=>$s)
            {
                $inoDetalle = new InoDetalle();
                $inoDetalle->setCaIdcomprobante( $idcomprobante );                
                if($tipoComprobante->getCaTipo()=="C")
                {
                    $inoDetalle->setCaDb( $s );
                    $total+=$s;
                }
                else
                {
                    if( substr($cuenta,0,1)=="2")
                    {
                        $inoDetalle->setCaCr( $s );
                        $total+=$s;
                    }
                    else if( substr($cuenta,0,1)=="1")
                    {
                        $inoDetalle->setCaDb( $s );
                        $total-=$s;
                    }
                }
                $inoDetalle->setCaIdcuenta( $cuenta );            
                $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                $inoDetalle->save( $conn );                
            }

            //cuenta cruce
            $inoDetalle = new InoDetalle();
            $inoDetalle->setCaIdcomprobante( $idcomprobante );
            if($tipoComprobante->getCaTipo()=="C")
                $inoDetalle->setCaCr( $total );
            else
                $inoDetalle->setCaDb( $total/$comprobante->getCaTcambio() );

            switch($tipoComprobante->getCaIdempresa())
            {
                case 2:
                    $cuenta_pago="cuenta_forma_pago_coltrans";
                    break;
                case 8:
                    $cuenta_pago="cuenta_forma_pago_colotm";
                    break;
                default :
                    $cuenta_pago="cuenta_forma_pago_".$tipoComprobante->getCaIdempresa();
            }
            //$cuenta_pago=($tipoComprobante->getCaIdempresa()=="2")?"cuenta_forma_pago_coltrans":"cuenta_forma_pago_colotm";
            $inoDetalle->setCaIdcuenta( $comprobante->getIds()->getIdsCliente()->getProperty($cuenta_pago) );
            //$inoDetalle->setCaId( $house->getCliente()->getCaIdcliente() );
            $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
            $inoDetalle->save( $conn );
            
            
            if($autoret>0)
            {
                $q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."1");
                
                if($q1[0])
                {
                    $inoDetalle = new InoDetalle();
                    $inoDetalle->setCaIdcomprobante( $idcomprobante );                
                    $inoDetalle->setCaDb( $autoret );                    
                    $inoDetalle->setCaIdcuenta( $q1[0]->getCaValor() );
                    $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                    $inoDetalle->save( $conn );
                    //echo "<pre>";echo($q1[0]->getCaValor2());echo "</pre>";
                }
                
                $q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."2");                
                if($q1[0])
                {
                    $inoDetalle = new InoDetalle();
                    $inoDetalle->setCaIdcomprobante( $idcomprobante );
                    $inoDetalle->setCaCr( $autoret );
                    $inoDetalle->setCaIdcuenta( $q1[0]->getCaValor() );
                    $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                    $inoDetalle->save( $conn );
                    //echo "<pre>";echo( $q1[0]->getCaValor2());echo "</pre>";
                }                
                $total+=$autoret;
                //$inoDetalle->setCaCr( $autoret );
            }

            /***********TABLAS SIIGO**************/
            if($tipoComprobante->getCaTipo()=="F")
            {
            //CABECERA COMPROBANTE
                $comproSiigo = new SiigoComprobante();                
                $comproSiigo->setIdUnegCont($idcomprobante);
                $comproSiigo->setCdDocCont($tipoComprobante->getCaTipo());
                $comproSiigo->setNuDocsopCont($tipoComprobante->getCaComprobante());
                $comproSiigo->setNuCont($consecutivo);        
                $comproSiigo->setTpDocSopCont($tipoComprobante->getCaTipo());
                $comproSiigo->setFechaCont(date("Y-m-d"));
                //$comproSiigo->setFechaCont("2014-02-15");
                $comproSiigo->setIdtpoIdapbCont("C");

                $comproSiigo->setNitApbCont($comprobante->getIds()->getCaIdalterno());
                $dv=($comprobante->getIds()->getCaDv()!="" && $comprobante->getIds()->getCaDv()!=null)?$comprobante->getIds()->getCaDv():"0";
                $comproSiigo->setDvApbCont($dv);
                //$comproSiigo->setNitApbCont($house->getCliente()->getCaIdalterno());
                //$comproSiigo->setDvApbCont($house->getCliente()->getCaDigito());        
                $comproSiigo->setIdSucCont("0");
                //$comproSiigo->setTotalDbCont($total*$comprobante->getCaTcambio());
                //$comproSiigo->setTotalCrCont($total*$comprobante->getCaTcambio());
                $comproSiigo->setTotalDbCont($total);
                $comproSiigo->setTotalCrCont($total);
                $comproSiigo->setIndIncorpCont("2");
                $comproSiigo->setCodaltUnegCont('1');
                $comproSiigo->setCodaltEmpreCont('4');
                //$comproSiigo->setCdErrsiigoCont();
                $comproSiigo->setIndAnulCont("N");
                //$comproSiigo->setArchivo();
                //$comproSiigo->setErrorArchivo();
                $comproSiigo->save($conn);

                $q = Doctrine::getTable("InoDetalle")
                    ->createQuery("det")
                    ->select("det.*,s.*,ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv")            
                    ->innerJoin("det.InoComprobante comp")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("comp.InoTipoComprobante tcomp")
                    //->innerJoin("tcomp.InoCentroCosto ccosto")
                    ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')            
                    ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
                    ->addOrderBy("s.ca_pt DESC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                $movs=$q->execute();
                /*echo "<pre>";print_r($movs);echo "</pre>";
                $conn->rollback();
                exit;*/

                if($comprobante->getCaIdccosto()=="")
                {
                    $ccosto = Doctrine::getTable("InoCentroCosto")
                                  ->createQuery("c")
                                  ->addWhere("c.ca_impoexpo = ?", $comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo())
                                  ->addWhere("c.ca_transporte = ?", $comprobante->getInoHouse()->getInoMaster()->getCaTransporte())
                                  ->addWhere("c.ca_idsucursal = ?", $comprobante->getInoTipoComprobante()->getCaIdsucursal())                                  
                                  ->fetchOne();
                }
                else
                {
                    $ccosto = Doctrine::getTable("InoCentroCosto")->find($comprobante->getCaIdccosto());
                }
                // $this->getUser()->getSucursal()



                /*echo "<pre>";print_r($movs);echo "</pre>";
                $conn->rollback();
                exit;*/
                foreach ($movs as $m) {
                    //$conSiigo = $m->getInoConSiigo();  
                    if($m["det_ca_idcuenta"]!="")
                    {
                        $cuenta=$m["det_ca_idcuenta"];
                        $cc="0001";
                        $scc="001";
                        $nconcepto="Proceso Automatico Siigoconect";
                        //echo "1::";
                    }
                    else
                    {
                        $cuenta=$m["s_ca_cuenta"];
                        //$cod=$conSiigo->getCaCod();
                        $cc=  "000".$m["s_ca_cc"];
                        $scc="00".$m["s_ca_scc"];
                        $nconcepto=$m["s_ca_descripcion"];
                    }
                    if($cuenta=="")
                    {
                       // echo $m->getCaIddetalle();
                        //exit();
                    }

                    $detComproSiigo=new SiigoDetComprobante();
                    $detComproSiigo->setIdUnegMovcont($comproSiigo->getIdUnegCont());
                    $detComproSiigo->setCodDoccontMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setNumTipDoccontMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumDoccontMovcont($consecutivo);
                    $detComproSiigo->setCtaMovcont($cuenta);
                    $detComproSiigo->setTpIdepcteMovcont("CC");
                    $detComproSiigo->setSucMovcont("0");
                    $detComproSiigo->setIdentPcteMovcont($m["ids_ca_idalterno"]);//nit            
                    $detComproSiigo->setDescripMovcont($nconcepto);//nombre concepto
                    if($m["det_ca_cr"]>0)
                    {
                        $valor=$m["det_ca_cr"];
                        $nat="C";
                    }
                    else
                    {
                        $valor=$m["det_ca_db"];
                        $nat="D";
                    }
                    $detComproSiigo->setValorMovcont(round($valor*$comprobante->getCaTcambio(),2) );//valor
                    $detComproSiigo->setNatuMovcont($nat);//naturaleza C o D
                    $detComproSiigo->setVlBaseMovcont(0);//valor Base
                    $detComproSiigo->setIdCcMovcont("0001");//centro de costo
                    $detComproSiigo->setIdBodegaMovcont("0001");
                    //$detComproSiigo->setCodalInvMovcont("0010001000007");
                    $detComproSiigo->setCodalInvMovcont("0");
                    $detComproSiigo->setCantInvMovcont("1");
                    $detComproSiigo->setCodaltDepMovcont("0");
                    $detComproSiigo->setCodaltBodMovcont("0");
                    $detComproSiigo->setCodaltUbiMovcont("0");
                    $detComproSiigo->setCodaltCcMovcont($cc);
                    $detComproSiigo->setIdAreaMovcont("0");
                    $detComproSiigo->setCodaltSccMovcont($scc);//??
                    $detComproSiigo->setTpIdterMovcont("CC");
                    $detComproSiigo->setIdentTerMovcont($m["ids_ca_idalterno"]);//nit
                    $detComproSiigo->setTipConCarMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setComConCarMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumConCarMovcont($consecutivo);
                    $detComproSiigo->setVctConCarMovcont(1);
                    if($tipoComprobante->getCaTipo()=="F")
                    {  
                        $fechComprobante=Utils::parseDate(($comprobante->getCaFchcomprobante()=="")?date("Y-m-d"):$comprobante->getCaFchcomprobante(), "Y-m-d");
                        if( !$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito() ||$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="" || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()<0 || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="0" )
                        {
                            $dcredito=0;
                            $fchDocCruce=date("Y-m-d");
                        }
                        else
                            $dcredito=$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito();
                        
                        if($dcredito>0)
                            $fchDocCruce=Utils::agregarDias($fechComprobante, $dcredito,  "Y-m-d");
                        else
                            $fchDocCruce=date("Y-m-d");
                    }
                    else
                    {
                        $fchDocCruce=date("Y-m-d");
                        $dcredito=0;
                    }
                    
                    if($fchDocCruce=="1999-12-30")
                    {
                        $fchDocCruce=date("Y-m-d");
                        $dcredito=0;
                    }
                    //$detComproSiigo->setFecConMovcont(date("Y-m-d"));
                    $detComproSiigo->setFecConMovcont($fchDocCruce);

                    $detComproSiigo->setNomTercMovcont("SIIGONECT");//
                    $detComproSiigo->setConceptoNomMovcont(0);
                    $detComproSiigo->setVariableAcumMovcont(0);
                    $detComproSiigo->setNroquinAcumMovcont(0);
                    $detComproSiigo->setTipModMovhbMovcont($ccosto->getCaTipmodsiigo());
                    $detComproSiigo->setRefMasMovhbMovcont( str_replace(".", "",  ($house)?$house->getInoMaster()->getCaReferencia() : ""  ));
                    $detComproSiigo->setNroBlhMovhbMovcont(  ($house)?$house->getCaDoctransporte():"" );
                    $detComproSiigo->save($conn);
                }
            }
            //$autoret
            /*************************/

    /*        ProjectConfiguration::registerZend();

            $client = new Zend_Soap_Client( "http://10.192.1.97:8000/WebService2/Service1.asmx?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
            $result = $client->actualiza(array(a=>"2014",t=>$tipoComprobante->getCaTipo(),nt=>$tipoComprobante->getCaComprobante(),c=>$consecutivo));

            $comproSiigo->refresh();
            $indincor=$comproSiigo->getIndIncorpCont();

            if($indincor=="+6" || $indincor=="6")
            {
                $comprobante->setCaEstado(InoComprobante::ERROR_TRANSFERIDO);
            }
            else if($indincor=="+5" || $indincor=="5")
            {
                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            }*/
            $comprobante->setCaConsecutivo($consecutivo);
            $comprobante->setCaFchcomprobante(date("Y-m-d"));
            $comprobante->setCaValor($totalsinimpuestos);
            $comprobante->setCaValor2($total);
            $comprobante->setCaUsugenero($this->getUser()->getUserId());
            $comprobante->setCaFchgenero(date("Y-m-d H:i:s"));
            $comprobante->setCaPlazo($dcredito);

            //$comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            if($tipoComprobante->getCaTipo()=="C")
                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            
            $comprobante->save($conn);

            if( $tipoComprobante->getCaTipo()=="F" && $comprobante->getCaId()=="800024075" && $tipoComprobante->getCaIdempresa()=="8"  )
            {
                $resultadoCosto=InoCostosSea::setCosto($comprobante,$conn);
                //echo $resultadoCosto;
                if($resultadoCosto<0)
                {
                    switch ($resultadoCosto)
                    {
                        case "-1":
                            $info="error:$resultadoCosto -> HBL: NO ENCONTRADO";
                            break;
                        case "-2":
                            $info="error:$resultadoCosto -> REFERENCIA MARITIMA CERRADA";
                            break;
                        case "-3":
                            $info="error:$resultadoCosto -> REFERENCIA MARITIMA YA POSEE COSTO INGRESADO";
                            break;
                        case "-4":
                            $info="error:$resultadoCosto -> NO SE ENCONTRO LA DEDUCCION EN EL CASO MARITIMO";
                            break;
                    }

                    Utils::sendEmail(
                        array(
                            "from"=>"colsys@coltrans.com.co",
                            "fromname" => "colsys",
                            "to"=>$this->getUser()->getEmail().",gerencia@colotm.com",
                            "subject"=>"Error al enviar costo a ref maritima",
                            "body"=>"Error al enviar costo a ref maritima",
                            "mensaje"=> "No fue posible pasar el costo :$info<br>"
                                        ."Ref :".$house->getInoMaster()->getCaReferencia()."<br>"
                                        ."Comprobante:".$consecutivo."<br>"
                            )
                        );
                }
            }
            $conn->commit();

            if($tipoComprobante->getCaTipo()=="F")
            {
                /*$request->setParameter("idcomprobante", $idcomprobante);
                $request->setParameter("info", $info);
                $this->executeEnviarSiigoConect($request);
                 * 
                 */
                try{
                    $this->EnviarSiigoConect($idcomprobante);
                }catch(Exception $e) 
                {
                    
                }
            }
            
            
            $success=true;
        }
        /*catch(Exception $e)
        {
            $errorInfo=$e->getMessage();
            $conn->rollback();
            $success=false;
        }*/

        $this->responseArray = array("errorInfo" => $errorInfo,"info" => $info, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => $success,"consecutivo"=>$consecutivo ,"indincor"=>$indincor,"wsdl"=>$result );
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
        
        $this->responseArray=$this->EnviarSiigoConect($idcomprobante);
        

        //$this->responseArray = array("success" => true, "consecutivo" => $consecutivo, "indincor" => $indincor, "wsdl" => $result, "info" => $info);
        $this->setTemplate("responseTemplate");
    }

    public function executeAnularComprobante(sfWebRequest $request) {
        try {
            $idcomprobante = $request->getParameter("idcomprobante");
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);

            $comprobante->anular($this->getUser()->getUserId());
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
        try {
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
                    $house->setCaIdtercero($c->idtercero);
                    $house->setCaTercero(utf8_encode($c->tercero));
                    $house->setCaIdcliente($c->idcliente);
                    $house->setCaVendedor($c->vendedor);
                    $house->setCaNumorden($c->numorden);
                    $house->setCaNumpiezas($c->numpiezas);
                    $house->setCaPeso($c->peso);
                    $house->setCaVolumen($c->volumen);
                    if($c->idbodega>0)
                        $house->setCaIdbodega($c->idbodega);
                    $house->save();
                    $ids[] = $c->null;
                }
                $idshouse[] = $house->getCaIdhouse();
            }
            $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "idhouse" => implode(",", $idshouse), "success" => true);
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

                if($ino->getCaImpoexpo()!=Constantes::INTERNO && $ino->getCaImpoexpo()!=Constantes::OTMDTA)
                {
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
                }else
                {
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
    public function executeDatosGridCostos(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);

        $costos = Doctrine::getTable("InoCosto")
                ->createQuery("c")
                ->select("c.ca_idinocosto, c.ca_idmaster, c.ca_neto, c.ca_venta, c.ca_factura,c.ca_fchfactura,
                                  c.ca_tcambio, c.ca_tcambio_usd, c.ca_idcosto, p.ca_sigla, i.ca_nombre,
                                  c.ca_idmoneda, cs.ca_concepto,c.ca_fchfactura,c.ca_idproveedor ")
                ->innerJoin("c.InoConcepto cs")
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
            $concepto = Doctrine::getTable("InoConcepto")->find($costos[$key]["c_ca_idcosto"]);
            $data["nombrecosto" . $data["idmaster"]] = ($concepto) ? (utf8_encode($concepto->getCaConcepto())) : "";
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

            $root[] = $data;
        }
        if (count($root) < 1)
            $root[]["idmaster" . $idmaster] = $idmaster;


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
            if ($idcomprobante > 0) {
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

        try {
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
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
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

}
