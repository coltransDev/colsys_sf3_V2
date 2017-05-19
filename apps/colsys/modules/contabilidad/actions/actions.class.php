<?php

/**
 * gestDocumental actions.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class contabilidadActions extends sfActions {

    const RUTINA_TERRESTRE = "158";

    public function preExecute() {

        if (count($this->permisos) < 1) {
            $this->nivel = $this->getUser()->getNivelAcceso(contabilidadActions::RUTINA_TERRESTRE);
            //echo $this->nivel;
            //$this->nivel=6;
            $this->permisos = array("imprimir" => false, "anular" => false, "busquedatotal" => false, "maestras" => false, "enviarsiigo" => false);
            //echo "nivel".$this->nivel;            

            switch ($this->nivel) {
                case "1"://operativo
                    $this->permisos["imprimir"] = true;
                    $this->permisos["enviarsiigo"] = true;
                    break;
                case "2"://contabilidad
                    $this->permisos["imprimir"] = true;
                    $this->permisos["anular"] = true;
                    $this->permisos["busquedatotal"] = true;
                    $this->permisos["maestras"] = true;
                    $this->permisos["enviarsiigo"] = true;
                    break;
                case "3"://auditoria
                    $this->permisos["busquedatotal"] = true;
                    break;
                case "4"://admin
                    $this->permisos["imprimir"] = true;
                    $this->permisos["anular"] = true;
                    $this->permisos["busquedatotal"] = true;
                    $this->permisos["maestras"] = true;
                    $this->permisos["enviarsiigo"] = true;
                    break;
            }
        }
        //$this->permisos=array("imprimir"=>true,"anular"=>true,"busquedatotal"=>true,"maestras"=>true);
        //print_r($this->permisos);

        parent::preExecute();
    }

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

   /* function executeDatosIndex($request) {
        $idproceso = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Proceso/Riesgo", "leaf" => true, "id" => "1");

        if ($idproceso == 0) {

            $childrens1 = array();

            if ($this->permisos["maestras"]) {
                $childrens1[] = array("text" => "Cuentas Contables", "leaf" => true, "id" => "1");
                $childrens1[] = array("text" => "Conceptos", "leaf" => true, "id" => "2");
                $childrens[] = array("text" => utf8_encode("Administración"), "leaf" => false, "children" => $childrens1);
            }
            $childrens1 = array();
            $childrens1[] = array("text" => "Consulta", "leaf" => true, "id" => "3");
            $childrens1[] = array("text" => "Creacion", "leaf" => true, "id" => "5");
            //$childrens1[] = array("text" => "Conceptos","leaf" => true,"id" => "2");

            $childrens[] = array("text" => "Comprobantes", "leaf" => false, "children" => $childrens1);

            $childrens1 = array();
            $childrens1[] = array("text" => utf8_encode("Facturación"), "leaf" => true, "id" => "4");
            $childrens[] = array("text" => "Coldepositos", "leaf" => false, "children" => $childrens1);
        }

        $tree["children"] = $childrens;

        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }*/
        function executeDatosIndex($request) {
        $idproceso = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Proceso/Riesgo","leaf" => true,"id" => "1");
        
        if($idproceso==0)
        {
            $childrens1=array();
            
            if($this->permisos["maestras"])
            {
                $childrens1[] = array("text" => "Cuentas Contables","leaf" => true,"id" => "1");
                $childrens1[] = array("text" => "Conceptos","leaf" => true,"id" => "2");
                $childrens1[] = array("text" => "Tipos Comprobantes","leaf" => true,"id" => "6");
                $childrens1[] = array("text" => "Formas de pago","leaf" => true,"id" => "7");
                $childrens1[] = array("text" => "Parametros Generales","leaf" => true,"id" => "8");
                $childrens1[] = array("text" => "Parametros Clientes","leaf" => true,"id" => "9");
                
                $childrens[] = array("text" => utf8_encode("Administración"),"leaf" =>false,"children"=>$childrens1);
            }
            $childrens1=array();
            $childrens1[] = array("text" => "Consulta","leaf" => true,"id" => "3");
            $childrens1[] = array("text" => "Creacion", "leaf" => true, "id" => "5");
            
            //$childrens1[] = array("text" => "Conceptos","leaf" => true,"id" => "2");
            
            $childrens[] = array("text" => "Comprobantes","leaf" =>false,"children"=>$childrens1);
            
            $childrens1=array();            
            $childrens1[] = array("text" => utf8_encode("Facturación"),"leaf" => true,"id" => "4");
            $childrens[] = array("text" => "Coldepositos","leaf" =>false,"children"=>$childrens1);
            
        }

        $tree["children"] = $childrens;
        
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }

    function executeEliminarGridConceptos($request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $ids = array();
        $i = 0;

        foreach ($datos as $dato) {
            $i++;
            $inoconsiigo = Doctrine::getTable("InoConSiigo")->find($dato->s_ca_idconceptosiigo);
            if ($inoconsiigo) {
                $inoconsiigo->delete();
            }
            $ids[] = $dato->id;
        }
        $this->responseArray = array("success" => true, "ids" => $ids, "count" => $i);
        $this->setTemplate("responseTemplate");
    }

    function executeDatosConceptosSiigo($request) {
        $idempresa = $request->getParameter("idempresa");
        $q = Doctrine::getTable("InoConSiigo")
                ->createQuery("s")
                ->select("s.*,e.ca_nombre")
                ->innerjoin("s.Empresa e")
                ->addOrderBy("s.ca_idconceptosiigo")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($idempresa) {
            $q->addWhere("ca_idempresa = ?", $idempresa);
        }
        if ($query != "") {
            $q->addWhere("UPPER(ca_descripcion) like ?", '%' . strtoupper($query) . '%');
        }
        $debug = $q->getSqlQuery();

        $conceptosSiigo = $q->execute();
        foreach ($conceptosSiigo as $k => $c) {
            $conceptosSiigo[$k]["s_ca_descripcion"] = utf8_encode($conceptosSiigo[$k]["s_ca_descripcion"]);
            $conceptosSiigo[$k]["e_ca_nombre"] = utf8_encode($conceptosSiigo[$k]["e_ca_nombre"]);
        }
        $this->responseArray = array("success" => true, "root" => $conceptosSiigo, "total" => count($conceptosSiigo), "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    function executeDatosCuentas($request) {
        $empresa = $request->getParameter("idempresa");
        $q = Doctrine::getTable("SiigoCuenta")
                ->createQuery("s")
                ->select("s.ca_idcuenta,s.codigocuenta,s.nombrecuenta,s.ca_idempresa,e.ca_nombre")
                ->innerjoin("s.Empresa e")
                ->where("s.ca_usuanulado is null ")
                //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                ->addOrderBy("s.codigocuenta")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($empresa) {
            $q->addWhere("s.ca_idempresa = ?", $empresa);
        }
        $debug = $q->getSqlQuery();

        $cuentas = $q->execute();
        foreach ($cuentas as $k => $c) {
            $cuentas[$k]["s_nombrecuenta"] = utf8_encode($cuentas[$k]["s_nombrecuenta"]);
            $cuentas[$k]["e_ca_nombre"] = utf8_encode($cuentas[$k]["e_ca_nombre"]);
        }

        $this->responseArray = array("success" => true, "root" => $cuentas, "total" => count($cuentas), "debug" => $debug);
        $this->setTemplate("responseTemplate");
    }

    function executeGuardarGridCuentas($request) {

        $datos = $request->getParameter("datos");
        $cuentas = json_decode($datos);
        $ids = array();

        //try {
            foreach ($cuentas as $c) {
                $cuenta = Doctrine::getTable("SiigoCuenta")->findBy ("ca_idcuenta",$c->s_ca_idcuenta);
                if (!$cuenta) {
                    $cuenta = new SiigoCuenta();
                    $cuenta->setCodigocuenta($c->s_codigocuenta);
                    $cuenta->setCaIdempresa($c->s_ca_idempresa);
                }
                $cuenta->setNombrecuenta($c->s_nombrecuenta);
                $cuenta->save();
                $ids[] = $c->id;
                $this->responseArray = array("errorInfo" => '', "id" => implode(",", $ids), "success" => true);
            }
        /*} catch (Exception $e) {
            $this->responseArray = array("errorInfo" => 'Error. La empresa ya cuenta con este codigo', "id" => implode(",", $ids), "success" => true);
        }*/

        $this->setTemplate("responseTemplate");
    }

    function executeEliminarGridCuentas($request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $ids = array();

        $conn = Doctrine::getTable("SiigoCuenta")->getConnection();
        $conn->beginTransaction();

        try {
            foreach ($datos as $dato) {
                $cuenta = Doctrine::getTable("SiigoCuenta")->find($dato->s_ca_idcuenta);
                if ($cuenta) {
                    $cuenta->setCaUsuanulado($this->getUser()->getUserId());
                    $cuenta->setCaFchanulado(date("Y-m-d H:i:s"));
                    $cuenta->save();
                }
                $ids[] = $dato->id;
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false);
        }
        $this->setTemplate("responseTemplate");
    }

    function executeGuardarGridConceptos($request) {

        $datos = $request->getParameter("datos");
        $cuentas = json_decode($datos);
        $ids = array();
        $idconceptos = array();
        $errorInfo = "";
        $conn = Doctrine::getTable("InoConSiigo")->getConnection();
        $conn->beginTransaction();

        try {
            foreach ($cuentas as $c) {

                if ($c->ca_idconceptosiigo) {
                    $concepto = Doctrine::getTable("InoConSiigo")
                            ->createQuery("s")
                            ->where("s.ca_idconceptosiigo = ?", $c->ca_idconceptosiigo)
                            ->andWhere("s.ca_idempresa = ?", $c->ca_idempresa)
                            ->fetchOne();

                    if (!$concepto) {
                        $concepto = new InoConSiigo();
                        $concepto->setCaIdempresa($c->ca_idempresa);
                    }
                } else {
                    $concepto = new InoConSiigo();
                    $concepto->setCaIdempresa($c->ca_idempresa);
                }
                $concepto->setCaCod($c->ca_cod);
                $concepto->setCaCuenta($c->ca_cuenta);
                $concepto->setCaDescripcion(utf8_encode($c->ca_descripcion));
                $concepto->setCaPt($c->ca_pt);
                $concepto->setCaIva($c->ca_iva);
                $concepto->setCaPorciva($c->ca_porciva);
                $concepto->setCaAutoret($c->ca_autoret);
                $concepto->setCaBasear($c->ca_basear);
                $concepto->setCaCc($c->ca_cc);
                $concepto->setCaScc($c->ca_scc);
                $concepto->setCaValor($c->ca_valor);
                $concepto->setCaRetfte($c->ca_retfte);
                $concepto->setCaCuentarf($c->ca_cuentarf);
                $concepto->setCaBaserf($c->ca_baserf);
                $concepto->setCaPorcrf($c->ca_porcrf);
                $concepto->setCaMone($c->ca_mone);
                $concepto->setCaConvenio($c->ca_convenio);
                $concepto->setCaTipo($c->ca_tipo);

                $concepto->save();
                $ids[] = $c->id;
                if ($c->ca_idconceptosiigo) {
                    $idconceptos[] = $c->ca_idconceptosiigo;
                } else {
                    $sql = "select last_value from ino.tb_conceptossiigo_id";
                    $q = Doctrine_Manager::getInstance()->connection();
                    $stmt = $q->execute($sql);
                    $idcon = $stmt->fetch();
                    $idconceptos[] = $idcon['last_value'];
                }
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            $errorInfo.= $e->getMessage() . "<br>";
        }

        $this->responseArray = array("idconceptos" => $idconceptos, "errorInfo" => $errorInfo, "id" => implode(",", $ids), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    function executeConsultaResult($request) {
        $fecha_inicial = $request->getParameter("fecha_inicial");
        $fecha_final = $request->getParameter("fecha_final");
        $idtipocomprobante = $request->getParameter("idtipocomprobante");
        $no_comprobante = $request->getParameter("no_comprobante");
        $no_comprobante2 = $request->getParameter("no_comprobante2");
        $ca_referencia = $request->getParameter("ca_referencia");
        $ca_estado = $request->getParameter("ca_estado");

        $q = Doctrine::getTable("InoViConsComprobante")
                ->createQuery("s")
                ->select("s.*")
                //->where("SUBSTR(ca_cod::TEXT,1,2)=? and ca_idempresa=?  ",array($ccosto->getCaCentro().$ccosto->getCaSubcentro() , $ccosto->getCaIdempresa()) )
                //->addOrderBy( "s.codigocuenta" )
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

        if ($fecha_inicial != "") {
            $q->addWhere("ca_fchgenero >= ?", $fecha_inicial);
        }
        if ($fecha_final != "") {
            $q->addWhere("ca_fchgenero <= ?", $fecha_final);
        }

        if ($no_comprobante != "" && $no_comprobante2 == "") {
            $q->addWhere("ca_consecutivo = ?", $no_comprobante);
        } else if ($no_comprobante != "" && $no_comprobante2 != "") {
            $q->addWhere("ca_consecutivo BETWEEN ? AND ?", array($no_comprobante, $no_comprobante2));
        }


        if ($idtipocomprobante != "") {
            $q->addWhere("ca_idtipo = ?", $idtipocomprobante);
        }

        if ($ca_referencia != "") {
            $q->addWhere("ca_referencia like ?", '%' . $ca_referencia . '%');
        }
        if ($ca_estado != "") {
            $q->addWhere("ca_estado = ?", $ca_estado);
        }

        //echo $q->getSqlQuery();
        $comprobantes = $q->execute();

        foreach ($comprobantes as $k => $c) {
            $comprobantes[$k]["ca_ciuorigen"] = utf8_encode($comprobantes[$k]["ca_ciuorigen"]);
            $comprobantes[$k]["ca_ciudestino"] = utf8_encode($comprobantes[$k]["ca_ciudestino"]);
            $comprobantes[$k]["ca_empresa"] = utf8_encode($comprobantes[$k]["ca_empresa"]);
            $comprobantes[$k]["ca_nomfacturado"] = utf8_encode($comprobantes[$k]["ca_nomfacturado"]);
            $comprobantes[$k]["ca_consecutivo"] = $comprobantes[$k]["ca_tipo"] . $comprobantes[$k]["ca_comprobante"] . "-" . $comprobantes[$k]["ca_consecutivo"];
            $comprobantes[$k]["ca_valor"] = round($comprobantes[$k]["ca_valor"]);
            $comprobantes[$k]["ca_valor2"] = round($comprobantes[$k]["ca_valor2"]);
        }
        //echo "<pre>";print_r($comprobantes);echo "</pre>";
        $this->responseArray = array("errorInfo" => $errorInfo, "root" => $comprobantes, "success" => true, "debug" => $q->getSqlQuery());
        $this->setTemplate("responseTemplate");
    }

    function executeBusquedaComprobantes($request) {


        $fecha_inicial = $request->getParameter("fecha_inicial");

        $fecha_final = $request->getParameter("fecha_final");
        $idtipocomprobante = $request->getParameter("idtipocomprobante");
        $no_comprobante = $request->getParameter("no_comprobante");

        $this->getRequest()->setParameter('fecha_inicial', $fecha_inicial);
        $this->getRequest()->setParameter('fecha_final', $fecha_final);
        $this->getRequest()->setParameter('idtipocomprobante', $idtipocomprobante);
        $this->getRequest()->setParameter('no_comprobante', $no_comprobante);
        $html = sfContext::getInstance()->getController()->getPresentationFor('contabilidad', 'busquedaResult');

        $this->responseArray = array("errorInfo" => $errorInfo, "html" => $html, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    function executeAnularComprobantes($request) {

        $ids = json_decode($request->getParameter("id"));
        $observaciones = $request->getParameter("observaciones");
        $errorInfo = "";
        try {

            $this->comprobantes = Doctrine::getTable("InoComprobante")
                    ->createQuery("c")
                    ->select("*")
                    ->andWhereIn("ca_idcomprobante", $ids)
                    ->execute();

            //$comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);            
            $consecutivos = "";
            foreach ($this->comprobantes as $comprobante) {
                $comprobante->anular($this->getUser()->getUserId(), $observaciones);
                $consecutivos.=" , " . $comprobante->getCaConsecutivo();
            }

            Utils::sendEmail(
                    array(
                        "from" => "colsys@coltrans.com.co",
                        "to" => $this->getUser()->getEmail(),
                        "subject" => "Anulacion de facturas",
                        "body" => "Anulacion de Comprobantes",
                        "mensaje" => "En caso de ver alguna informacion incorrecta, por favor informar al Depto. de Sistemas. <br>"
                        . "Se Anularon los comprobantes no :<br>"
                        . $consecutivos . "<br>"
                        . "<br>coressponden a los ids:" . implode(" , ", $ids) . "<br>"
                    )
            );
        } catch (Exception $e) {
            $errorInfo.=$e->getMessage() . "<br>";
        }
        $this->responseArray = array("errorInfo" => $errorInfo, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeEnviarSiigoConect(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("idcomprobante"));

        //$this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("id"));


        $ids = json_decode($request->getParameter("idcomprobante"));
        //print_r($ids);
        //exit;

        $html = array();
        //print_r(count($ids));
        foreach ($ids as $idcomprobante) {            
            $this->getRequest()->setParameter('respuesta', "false");
            $this->getRequest()->setParameter('idcomprobante', $idcomprobante);
            sfContext::getInstance()->getController()->getPresentationFor('inoF2', 'EnviarSiigoConect');
            //$html[]=json_decode($html);
        }
        //$this->responseArray = array("errorInfo" => $errorInfo, "success" => true,"html"=>$html);
        //$this->setTemplate("responseTemplate");
    }

    function executeConsultaWsFactColDepositos($request) {

        $fecha_inicial = $request->getParameter("fecha_inicial");
        $fecha_final = $request->getParameter("fecha_final");

        $idcliente = $request->getParameter("idcliente");
        $doctransporte = $request->getParameter("doctransporte");

        ProjectConfiguration::registerZend();
        $client = new Zend_Soap_Client("http://wms.coldepositos.com.co/suite/webservices/conceptosfacturacion.php?wsdl", array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2,"login"=>"COLSYS","password"=>"super091"));
        //$client = new Zend_Soap_Client("http://10.194.1.5/suite/webservices/conceptosfacturacion.php?wsdl", array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2));
        
        $result = $client->ConsultarProveedor(
                array(
                    punto => "CZF1",
                    //proveedor=>"LAVASECOMODERNOLTD",
                    //proveedor=>"COLMAS",
                    proveedor => "",
                    identificacion => $idcliente,
                    fecha_inicial => $fecha_inicial,
                    fecha_final => $fecha_final,
                    agrupador => $doctransporte
        ));
        /* echo "<pre>";
          print_r($result);
          echo "</pre>";
         */
        $data = array();
        foreach ($result->arreglo_respuestas as $r) {
            $data[] = $r;
        }
        $this->responseArray = array("errorInfo" => $errorInfo, "root" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarComprobante(sfWebRequest $request) {
        $datos = json_decode($request->getParameter("datos"));
        $valor = 0;
        foreach ($datos as $dato) {
            $valor += $dato->valor;
        }
        $conn = Doctrine::getTable("InoTipoComprobante")->getConnection();
        $conn->beginTransaction();
        try {
            $sumatoria = 0;
            $tipocomprobante = $request->getParameter("tipocomprobante");
            $sucursal = $request->getParameter("cliente");
            $cuenta = $request->getParameter("cuenta");
            $centrocostos = $request->getParameter("centrocostos");
            $id = $request->getParameter("cli");
            $ids = array();
            $comprobante = new InoComprobante();
            $comprobante->setCaIdtipo($tipocomprobante);
            $inotimpocomprobante = Doctrine::getTable("InoTipoComprobante")->find($tipocomprobante);
            $consecutivo = intval($inotimpocomprobante->getCaNumeracionActual()) + 1;
            $inotimpocomprobante->setCaNumeracionActual($consecutivo);
            $inotimpocomprobante->save($conn);
            $comprobante->setCaConsecutivo($consecutivo);
            $comprobante->setCaFchcomprobante(date('Y-m-d'));
            $comprobante->setCaId($id);
            $comprobante->setCaFchcreado(date('Y-m-d H:i:s'));
            $comprobante->setCaUsucreado($this->getUser()->getUserId());
            $comprobante->setCaTcambio(1);
            $comprobante->setCaEstado(0);
            $comprobante->setCaValor($valor);
            $comprobante->setCaIdmoneda("COP");
            $comprobante->setCaTcambioUsd(1);
            $comprobante->setCaIdsucursal($sucursal);
            $comprobante->save($conn);


            foreach ($datos as $dt) {
                $inodetalle = new InoDetalle();
                // caso en el que llega cuenta y no factura
                if ($dt->cuenta != null) {
                    $inodetalle->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                    $inodetalle->setCaIdcuenta($dt->cuenta);
                    if ($dt->costos != null && $dt->costos != "-") {
                        $inodetalle->setCaIdccosto($dt->costos);
                    }
                    $inodetalle->setCaId($dt->tercero);
                    if ($dt->naturaleza == "D") {
                        $inodetalle->setCaDb($dt->valor);
                        $inodetalle->setCaCr(0);
                        $sumatoria += $dt->valor;
                    }
                    if ($dt->naturaleza == "C") {
                        $inodetalle->setCaCr($dt->valor);
                        $inodetalle->setCaDb(0);
                        $sumatoria -= $dt->valor;
                    }
                    $inodetalle->setCaObservaciones($dt->descripcion);
                }
                // caso en el que llega factura y no cuenta
                if ($dt->factura != null) {
                    $inodetalle->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                    $inodetalle->setCaIdcuenta($dt->cuentaformapago);
                    $inodetalle->setCaId($dt->tercero);
                    if ($dt->naturaleza == "D") {
                        $inodetalle->setCaDb($dt->valor);
                        $inodetalle->setCaCr(0);
                        $sumatoria += $dt->valor;
                        $debitos += $dt->valor;
                    }
                    if ($dt->naturaleza == "C") {
                        $inodetalle->setCaCr($dt->valor);
                        $inodetalle->setCaDb(0);
                        $sumatoria -= $dt->valor;
                        $creditos += $dt->valor;
                    }
                    $inodetalle->setCaObservaciones("CANCELA FACTURA  No.  : " . $dt->factura . "  " . $dt->referencia);
                }
                $inodetalle->save($conn);
                $ids[] = $dt->id;
            }
            $inodetalleF = new InoDetalle();
            $inodetalleF->setCaIdcomprobante($comprobante->getCaIdcomprobante());
            $inodetalleF->setCaIdcuenta($cuenta);
            $inodetalleF->setCaId($id);
            $inodetalleF->setCaDb(abs($sumatoria));
            $inodetalleF->setCaCr(0);
            $inodetalleF->setCaObservaciones("CABECERA");
            $inodetalleF->setCaIdccosto($centrocostos);

            $inodetalleF->save($conn);

            $q = Doctrine::getTable("InoDetalle")
                    ->createQuery("det")
                    ->select("det.*,s.*,ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv")
                    ->innerJoin("det.InoComprobante comp")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("comp.InoTipoComprobante tcomp")
                    ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                    ->addWhere("det.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante())
                    ->addOrderBy("s.ca_pt DESC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            $movs = $q->execute();
            $debitos = 0;
            $creditos = 0;
            foreach ($movs as $mov) {
                $debitos += $mov["det_ca_db"];
                $creditos += $mov["det_ca_cr"];
            }

            if ($debitos == $creditos) {
              //  $this->responseArray = array("success" => true, "ErrorInfo" => "La suma de debitos y creditos debe ser 0");
                //$this->setTemplate("responseTemplate");
      

            $comproSiigo = new SiigoComprobante();
            $comproSiigo->setIdUnegCont($comprobante->getCaIdcomprobante());
            $comproSiigo->setCdDocCont($inotimpocomprobante->getCaTipo());
            $comproSiigo->setNuDocsopCont($inotimpocomprobante->getCaComprobante());
            $comproSiigo->setNuCont($consecutivo);
            $comproSiigo->setTpDocSopCont($inotimpocomprobante->getCaTipo());
            $comproSiigo->setFechaCont(date("Y-m-d"));
            $comproSiigo->setIdtpoIdapbCont("C");
            $comproSiigo->setNitApbCont($comprobante->getIds()->getCaIdalterno());
            $comproSiigo->setDvApbCont($comprobante->getIds()->getCaDv());
            $comproSiigo->setIdSucCont("0");
            $comproSiigo->setTotalDbCont($debitos);
            $comproSiigo->setTotalCrCont($creditos);
            $comproSiigo->setIndIncorpCont("2");
            $comproSiigo->setCodaltUnegCont('1');
            $comproSiigo->setCodaltEmpreCont('4');
            $comproSiigo->setIndAnulCont("N");

            $comproSiigo->save($conn);

            $ccosto = Doctrine::getTable("InoCentroCosto")->find($centrocostos);
            foreach ($movs as $m) {
                //if ($m["det_ca_idcuenta"] != "") {
                $cuenta = $m["det_ca_idcuenta"];
                $cc = str_pad($ccosto->getCaCentro(), 4, "0", STR_PAD_LEFT);
                $scc = str_pad($ccosto->getCaSubcentro(), 4, "0", STR_PAD_LEFT);
                $nconcepto = "Proceso Automatico Siigoconect";
                //    } 
                $detComproSiigo = new SiigoDetComprobante();
                $detComproSiigo->setIdUnegMovcont($comproSiigo->getIdUnegCont());
                $detComproSiigo->setCodDoccontMovcont($inotimpocomprobante->getCaTipo());
                $detComproSiigo->setNumTipDoccontMovcont($inotimpocomprobante->getCaComprobante());
                $detComproSiigo->setNumDoccontMovcont($consecutivo);
                $detComproSiigo->setCtaMovcont($cuenta);
                $detComproSiigo->setTpIdepcteMovcont("CC");
                $detComproSiigo->setSucMovcont("0");
                $detComproSiigo->setIdentPcteMovcont($m["ids_ca_idalterno"]);
                $detComproSiigo->setDescripMovcont($nconcepto);
                if ($m["det_ca_cr"] > 0) {
                    $valor = $m["det_ca_cr"];
                    $nat = "C";
                } else {
                    $valor = $m["det_ca_db"];
                    $nat = "D";
                }
                $detComproSiigo->setValorMovcont($valor); //valor
                $detComproSiigo->setNatuMovcont($nat); //naturaleza C o D
                $detComproSiigo->setVlBaseMovcont(0); //valor Base
                $detComproSiigo->setIdCcMovcont("0001"); //centro de costo
                $detComproSiigo->setIdBodegaMovcont("0001");
                $detComproSiigo->setCodalInvMovcont("0");
                $detComproSiigo->setCantInvMovcont("1");
                $detComproSiigo->setCodaltDepMovcont("0");
                $detComproSiigo->setCodaltBodMovcont("0");
                $detComproSiigo->setCodaltUbiMovcont("0");
                $detComproSiigo->setCodaltCcMovcont($cc);
                $detComproSiigo->setIdAreaMovcont("0");
                $detComproSiigo->setCodaltSccMovcont($scc); //??
                $detComproSiigo->setTpIdterMovcont("CC");
                $detComproSiigo->setIdentTerMovcont($m["ids_ca_idalterno"]); //nit
                $detComproSiigo->setTipConCarMovcont($inotimpocomprobante->getCaTipo());
                $detComproSiigo->setComConCarMovcont($inotimpocomprobante->getCaComprobante());
                $detComproSiigo->setNumConCarMovcont($consecutivo);
                $detComproSiigo->setVctConCarMovcont(1);
                $detComproSiigo->setFecConMovcont(date("Y-m-d"));
                $detComproSiigo->setNomTercMovcont("SIIGONECT"); //
                $detComproSiigo->setConceptoNomMovcont(0);
                $detComproSiigo->setVariableAcumMovcont(0);
                $detComproSiigo->setNroquinAcumMovcont(0);
                $detComproSiigo->setTipModMovhbMovcont($ccosto->getCaTipmodsiigo());

                $detComproSiigo->save($conn);
            }


            $conn->commit();


            $request->setParameter("idcomprobante", $comprobante->getCaIdcomprobante());
            sfContext::getInstance()->getController()->getPresentationFor('inoF', 'EnviarSiigoConect');



            $this->responseArray = array("success" => true, "ids" => $ids, "idcomprobante" => $comprobante->getCaIdcomprobante());
        
            }else{
                $this->responseArray = array("success" => true, "ids" => $ids, "errorInfo" => "Error interno");
            }
            
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

}

?>
