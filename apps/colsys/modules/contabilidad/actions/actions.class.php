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
            $this->permisos = array("imprimir" => false, "anular" => false, "busquedatotal" => false, "maestras" => false, "enviarsiigo" => false);            

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
        parent::preExecute();
    }

    /**
     * Executes index action
     *
     */
    public function executeIndex() {
        
    }

    public function executeIndexExt5() {

        $usuario = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->addWhere("u.ca_login = ?", $this->getUser()->getUserId())
                ->fetchOne();
        $datosusuario = json_decode($usuario->getCaDatos());
        
        $this->tipofacturacion = $datosusuario->factura_ino;
    }

    function executeDatosIndex($request) {
        $idproceso = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        $tree = array("text" => "Proceso/Riesgo", "leaf" => true, "id" => "1");

        if ($idproceso == 0) {

            if ($this->permisos["maestras"]) {
                $childrens1[] = array("text" => "Cuentas Contables", "leaf" => true, "id" => "1");
                $childrens1[] = array("text" => "Conceptos", "leaf" => true, "id" => "2");
                $childrens1[] = array("text" => "Tipos Comprobantes", "leaf" => true, "id" => "6");
                $childrens1[] = array("text" => "Formas de pago", "leaf" => true, "id" => "7");
                $childrens1[] = array("text" => "Parametros Generales", "leaf" => true, "id" => "8");
                $childrens1[] = array("text" => "Parametros Clientes", "leaf" => true, "id" => "9");

                $childrens[] = array("text" => utf8_encode("Administraci&oacute;n"), "leaf" => false, "children" => $childrens1);
            }
            $childrens1 = array();
            $childrens1[] = array("text" => "Consulta", "leaf" => true, "id" => "3");
            $childrens1[] = array("text" => "Creacion", "leaf" => true, "id" => "5");
            $childrens1[] = array("text" => "Facturas Proveedores", "leaf" => true, "id" => "13");            

            $childrens[] = array("text" => "Comprobantes", "leaf" => false, "children" => $childrens1);

            $childrens1 = array();
            $childrens1[] = array("text" => utf8_encode("Facturaci&oacute;n"), "leaf" => true, "id" => "4");
            $childrens[] = array("text" => "Coldepositos", "leaf" => false, "children" => $childrens1);
            
            $childrens1 = array();
            $childrens1[] = array("text" => "Panel de Transacciones", "leaf" => true, "id" => "12");
            $childrens1[] = array("text" => "Metodos FE", "leaf" => true, "id" => "14");
            $childrens[] = array("text" => "Integracion", "leaf" => false, "children" => $childrens1);
        }

        $tree["children"] = $childrens;

        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }

    function executeEliminarGridConceptos($request) {

        $datos = json_decode($request->getParameter("datos"));
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
        $query = $request->getParameter("query");
        $q = Doctrine::getTable("InoConSiigo")
                ->createQuery("s")
                ->select("s.*,e.ca_nombre")
                ->innerjoin("s.Empresa e")
                ->addOrderBy("s.ca_idconceptosiigo")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($idempresa) {
            $q->addWhere("ca_idempresa = ?", $idempresa);
        }
        if ($query !== "") {
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
            $cuenta = Doctrine::getTable("SiigoCuenta")->findBy("ca_idcuenta", $c->s_ca_idcuenta);
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
        /* } catch (Exception $e) {
          $this->responseArray = array("errorInfo" => 'Error. La empresa ya cuenta con este codigo', "id" => implode(",", $ids), "success" => true);
          } */

        $this->setTemplate("responseTemplate");
    }

    function executeEliminarGridCuentas($request) {

        $datos = json_decode($request->getParameter("datos"));
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
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
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
        $ca_idempresa = $request->getParameter("ca_idempresa");

        $q = Doctrine::getTable("InoViConsComprobante")
                ->createQuery("s")
                ->select("s.*")                
                ->addOrderBy( "ca_idcomprobante DESC" )
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

        if ($fecha_inicial != "") {
            $q->addWhere("ca_fchgenero >= ?", $fecha_inicial." 00:00:00");
        }
        if ($fecha_final != "") {
            $q->addWhere("ca_fchgenero <= ?", $fecha_final." 23:59:59");
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
        if ($ca_idempresa != "") {
            $q->addWhere("ca_idempresa = ?", $ca_idempresa);
        }

        $comprobantes = $q->execute();

        foreach ($comprobantes as $k => $c) {
            
            $comprobantes[$k]["ca_transporte"] = utf8_encode($comprobantes[$k]["ca_transporte"]);
            $comprobantes[$k]["ca_impoexpo"] = utf8_encode($comprobantes[$k]["ca_impoexpo"]);
            $comprobantes[$k]["ca_ciuorigen"] = utf8_encode($comprobantes[$k]["ca_ciuorigen"]);
            $comprobantes[$k]["ca_ciudestino"] = utf8_encode($comprobantes[$k]["ca_ciudestino"]);
            $comprobantes[$k]["ca_succliente"] = utf8_encode($comprobantes[$k]["ca_succliente"]);
            $comprobantes[$k]["ca_empresa"] = utf8_encode($comprobantes[$k]["ca_empresa"]);
            $comprobantes[$k]["ca_nomfacturado"] = utf8_encode($comprobantes[$k]["ca_nomfacturado"]);
            $comprobantes[$k]["ca_consecutivo"] = $comprobantes[$k]["ca_tipo"] . $comprobantes[$k]["ca_comprobante"] . "-" . $comprobantes[$k]["ca_consecutivo"];
            $comprobantes[$k]["ca_valor"] = round($comprobantes[$k]["ca_valor"]);
            $comprobantes[$k]["ca_valor2"] = round($comprobantes[$k]["ca_valor2"]);
            $comprobantes[$k]["ca_datos"] = utf8_encode($comprobantes[$k]["ca_datos"]);
            $comprobantes[$k]["ca_usugenero"] = utf8_encode($comprobantes[$k]["ca_usugenero"]);
            $comprobantes[$k]["ca_fchgenero"] = utf8_encode($comprobantes[$k]["ca_fchgenero"]);
            
            $file = "/inocomprobantes/generarComprobantePDF/id/" . $comprobantes[$k]["ca_idcomprobante"]."/sap/1";
            
            $comprobantes[$k]["file"] = $file;
        }
        //echo "<pre>";print_r($comprobantes);echo "</pre>";
        
        $this->responseArray = array("root" => $comprobantes, "success" => true, "debug" => $q->getSqlQuery());
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

        $this->responseArray = array("html" => $html, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    function executeAnularComprobantes($request) {

        
        $ids = json_decode($request->getParameter("id"));
        $observaciones = $request->getParameter("observaciones");
        $errorInfo = "";
        $resultado="";//array();
         $success = true;
        //try {

            $this->comprobantes = Doctrine::getTable("InoComprobante")
                    ->createQuery("c")
                    ->select("*")
                    ->andWhereIn("ca_idcomprobante", $ids)
                    ->execute();

            $consecutivos = "";            
            foreach ($this->comprobantes as $comprobante) {
                
                try{
                    $datos=json_decode($comprobante->getCaDatos());
                    $idanticipo=$datos->idanticipo;
                    /*$datos->idanticipo="";
                    $comprobante->setCaDatos(json_encode($datos));*/
                    if($comprobante->getCaEstado()!="8")
                    {
                        $datosArray=json_decode(utf8_encode($comprobante->getCaDatos()) , true);
                        $idanticipo=$datosArray["idanticipo"];
                        unset($datosArray["idanticipo"]);                        
                        
                        $comprobante->setCaDatos(json_encode($datosArray));                        
                        
                        $an=$comprobante->anular($this->getUser()->getUserId(), utf8_encode($observaciones));
                        
                        if($an==false)
                        {
                            $errorInfo=$resultado="El comprobante no se puede anular, porque la referencia esta bloqueada";
                            $success = false;
                            $resultado.="453";
                        }else{
                            $resultado.="469";
                            $observaciones = $comprobante->eliminarVinculados($this->getUser()->getUserId() ,utf8_encode($observaciones),null, "colsys");
                            $success = true;
                        }                        
                    }
                    else
                    {
                        $errorInfo=$resultado="El comprobante ya se encuentra anulado";
                        $success = false;
                        $resultado.="479";
                    }
                } 
                catch (Exception $e) {         
                    $resul = $e->getTraceAsString();                    
                    $resultado.=$resul;
                    $success = false;
                    $resultado.="486";
                }   
                
                if( $success == true)
                {
                    $tipo = $comprobante->getInoTipoComprobante();                   
                    $idtransaccion = IntTransaccionesOut::procesarTransacciones("10", $comprobante->getCaIdcomprobante());                    
                    if ($idtransaccion!="" && $idtransaccion > 0) {
                        try {//110556  698214
                            if($tipo->getCaAplicacion()=="1")
                            {
                                $resul = IntTransaccionesOut::enviarWs($idtransaccion,$this->getUser()->getUserId());                            
                                $resul=$resul[0];
                            }
                            else
                            {
                                $resul->Message = "Anulado desde colsys";
                                $resul->Status="0";
                            }                            
                            $mensaje_cancelado = strpos(trim($resul->Message),"Document is already cancelled - Object reference not set to an instance of an object");                            
                            
                            if( ($resul->Status=="1" &&  $mensaje_cancelado===false) || $resul==null || !$resul  )
                            {                                
                                $comprobante->setCaFchanulado(null);
                                $comprobante->setCaUsuanulado(null);
                                $comprobante->setCaEstado("5"); 
                                $comprobante->setProperty("msgAnulado",$resul->Message);
                                $datos->idanticipo=$idanticipo;                        
                                $comprobante->setCaDatos(json_encode($datos));                
                                $comprobante->save();
                                $errorInfo=$resul->Message;
                            }
                            else
                            {
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
                    
                                $comprobante->eliminarVinculados($this->getUser()->getUserId());
                                //$conn->commit();
                            }
                            $success = true;
                        } catch (Exception $e) {         
                            $resul = $e->getTraceAsString();
                            $success = false;      
                            $resultado.="517";
                        }            
                    }
                    else
                    {
                        $success = false;
                        $resultado.="522";
                        $resul= $idtransaccion;
                    }
                    $resultado.=utf8_encode($comprobante->getCaConsecutivo()."::".$resul->Message."<br>");
                }
            }

            if($success)
            {
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
            }
        
        $this->responseArray = array("errorInfo" => $errorInfo, "success" => $success,"resul"=>$resultado);
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
        $client = new Zend_Soap_Client("http://wms.coldepositos.com.co/suite/webservices/conceptosfacturacion.php?wsdl", array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2, "login" => "COLSYS", "password" => "super091"));
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
        $this->responseArray = array("root" => $data, "success" => true);
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
            } else {
                $this->responseArray = array("success" => true, "ids" => $ids, "errorInfo" => "Error interno");
            }
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarFormFacturaPr($request) {

        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();

        try {            
            $tipoComprobante = Doctrine::getTable("InoTipoComprobante")->find($request->getParameter("idtipocomprobante"));
            $ccosto = Doctrine::getTable("InoCentroCosto")->find($request->getParameter("cc"));            
            
            $idsucursal = $request->getParameter("idsucursal");
            $sucursal = Doctrine::getTable("IdsSucursal")->find($idsucursal);

            $existe = Doctrine::getTable("InoComprobante")->findByDql('ca_consecutivo = ? and ca_id = ? and ca_fchanulado = ? ', array($request->getParameter("nfactura"), $sucursal->getIds()->getCaId(), null));
            
            if (!$existe->count() > 0) {
                if($request->getParameter("idcomprobante"))
                    $comprobante = Doctrine::getTable ("InoComprobante")->find($request->getParameter("idcomprobante"));
                else
                    $comprobante = new InoComprobante();
                $comprobante->setCaIdtipo($request->getParameter("idtipocomprobante"));
                $comprobante->setCaConsecutivo($request->getParameter("consecutivo"));
                $comprobante->setCaFchcomprobante($request->getParameter("fecha"));
                $comprobante->setCaId($sucursal->getIds()->getCaId());
                $comprobante->setCaObservaciones($request->getParameter("observaciones"));
                $comprobante->setCaTcambio($request->getParameter("tcambio"));
                $comprobante->setCaEstado(0);
                $comprobante->setCaIdmoneda($request->getParameter("idmoneda"));
                $comprobante->setCaIdsucursal($idsucursal);
                $comprobante->setCaIdccosto($ccosto->getCaIdccosto());
                
                
                $datosArray=json_decode(utf8_encode($comprobante->getCaDatos()) , true);
                $datosArray["collect"]=$request->getParameter("collect");                
                $comprobante->setCaDatos(json_encode($datosArray));
                
                $comprobante->save($conn);
                $conn->commit();
                
                $this->responseArray = array("success" => true, "idcomprobante" => $comprobante->getCaIdcomprobante());
            } else {
                $this->responseArray = array("success" => false, "errorInfo" => "Comprobante ya existe");
            }            
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarGridFacturaPr($request) {
        
        $datos = json_decode($request->getParameter("datos"));
        //print_r($datos);
        
        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();   
        try{
            if(count($datos)>0){
                $costos = array();

                foreach ($datos as $dt) {
                    if ($dt->idconcepto === "" || $dt->idconcepto === 0 || $dt->neto === "" || $dt->neto === 0)
                        continue;
                    $comprobante = Doctrine::getTable("InoComprobante")->find($dt->idcomprobante);
                    $tipoComprobante = $comprobante->getInoTipoComprobante();

                    if($dt->iddetalle)
                        $inodetalleF = Doctrine::getTable("InoDetalle")->find($dt->iddetalle);
                    else
                        $inodetalleF = new InoDetalle();

                    $inodetalleF->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                    $inodetalleF->setCaIdconcepto($dt->idconcepto);
                    $inodetalleF->setCaIdhouse($dt->idhouse===0?null:$dt->idhouse);
                    $inodetalleF->setCaIdmaster($dt->idempresa !== 11?$dt->idmaster:null);
                    $inodetalleF->setCaId($comprobante->getCaId());
                    $inodetalleF->setCaDb($tipoComprobante->getCaTipo()=='D'?$dt->neto:0);
                    $inodetalleF->setCaCr($tipoComprobante->getCaTipo()=='P'?$dt->neto:0);                    
                    $inodetalleF->save($conn);

                    $ids_reg[] = $inodetalleF->getCaIddetalle();
                    $ids[] = $dt->id;
                    
                    if($idempresa != 11 && $idempresa != 12){
                        $existeCosto = Doctrine::getTable("InoCosto")->findByDql('ca_idmaster = ? and ca_idcosto = ? and ca_factura = ? and ca_idhouse = ?', array($dt->idmaster, $dt->idconcepto, $comprobante->getCaConsecutivo(), $dt->idhouse===0?null:$dt->idhouse))->getFirst();
                        
                        if($existeCosto){
                            $referencia = Doctrine::getTable("InoMaster")->find($dt->idmaster);
                            if($dt->idhouse)
                                $house = Doctrine::getTable("InoHouse")->find($dt->idhouse);
                            $costos[$referencia->getCaReferencia()]["doctransporte"] = $dt->idhouse?$house->getCaDoctransporte():null;
                            $costos[$referencia->getCaReferencia()]["consecutivo"] = $comprobante->getCaConsecutivo();
                            $costos[$referencia->getCaReferencia()]["concepto"] = $dt->idconcepto;
                            $costos[$referencia->getCaReferencia()]["idcomprobante"] = $existeCosto->getCaIdcomprobante();
                        }
                    }
                }
                if(count($costos)>0){
                    $info = "";
                    foreach($costos as $referencia =>$valor){
                        $info.= "Comprobante #: ".$valor["idcomprobante"]."Referencia: ".$referencia." # ".$valor["consecutivo"]." Doc Transporte: ".$valor["doctransporte"]." Id concepto: ".$valor["concepto"]."\n";
                    }
                    
                    $this->responseArray = array("success" => false, "errorInfo" => utf8_encode("Ya existe un comprobante de costo con los mismos datos! Revise la informaci�n y vuelva a intentarlo. $info"));
                }else{
                    $conn->commit();

                    if($comprobante){
                        $q = Doctrine::getTable("InoDetalle")
                                ->createQuery("det")
                                ->select("det.*,s.*,ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv")
                                ->innerJoin("det.InoComprobante comp")                                                
                                ->addWhere("det.ca_idcomprobante = ? ", $comprobante->getCaIdcomprobante())                    
                                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                        $movs = $q->execute();

                        $creditos = 0;
                        foreach ($movs as $mov) {
                            $creditos += $mov["det_ca_cr"]!=0?$mov["det_ca_cr"]:$mov["det_ca_db"];
                        }

                        $comprobante->setCaValor($creditos);
                        $comprobante->save($conn);
                        $this->responseArray = array("success" => true, "id"=>implode(",", $ids), "idreg" => implode(",", $ids_reg), "idcomprobante" => $comprobante->getCaIdcomprobante());
                    }else{
                        $this->responseArray = array("success" => false, "errorInfo" => utf8_encode("No se encontraron datos para guardar!"));
                    }
                }                
            }else{
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode("No se encontraron datos para guardar!"));
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");
        
        
    }
    
    public function executeDatosFacturasPr(sfWebRequest $request) {
        
        
        $q = Doctrine::getTable("InoComprobante")
                ->createQuery("comp")
                ->select("comp.ca_idhouse,  comp.ca_id ,  
                        ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv, 
                        comp.ca_idcomprobante, comp.ca_idcomprobante_cruce,comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_estado,
                        comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,
                        m.ca_nombre,c.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,emp.ca_nombre,
                        comp.ca_valor,comp.ca_valor2,comp.ca_tcambio,comp.ca_datos,comp.ca_docentry,
                        (SELECT SUM(det.ca_cr) FROM InoDetalle det WHERE det.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor3,
                        (SELECT SUM(det1.ca_db) FROM InoDetalle det1 WHERE det1.ca_idcomprobante = comp.ca_idcomprobante) as ca_valor4,
                        ccosto.ca_nombre, ccosto.ca_impoexpo, ccosto.ca_transporte")
                ->innerJoin("comp.Ids ids")                
                ->innerJoin("comp.InoTipoComprobante tcomp")
                ->innerJoin("tcomp.Empresa emp")
                ->innerJoin("comp.InoCentroCosto ccosto")                
                ->where("comp.ca_usucreado = ? AND comp.ca_estado in (?,?) AND comp.ca_docentry IS NULL AND tcomp.ca_prefijo_sap IN ('C','RC')",array($this->getUser()->getUserId(),0,6))
                ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        $debug=$q->getSqlQuery();
        $datos = $q->execute();
        $this->data = array();
        
        foreach ($datos as $d) {
            $consecutivo="";
            $consecutivo .= ($d["tcomp_ca_tipo"] == "P") ? "FACTURA PROV. # " : (($d["tcomp_ca_tipo"] == "D") ? "<span class=row_yellow>NOTA CREDITO PROV. # </span>" : "");
            $consecutivo .= ($d["comp_ca_docentry"] == "") ? $d["comp_ca_consecutivo"]." Id: " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
            $file = ($d["tcomp_ca_tipo"] == "F" && $d["comp_ca_docentry"] != "") ? "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"]."/sap/1" : "";
            $file = "/inocomprobantes/generarComprobantePDF/id/" . $d["comp_ca_idcomprobante"]."/sap/1";

            $house = $d["c_ca_doctransporte"];
            if ($d["clH_ca_compania"] != $d["ids_ca_nombre"])
                $house .= " - " . utf8_encode($d["clH_ca_compania"]);

            $class = "";
            if ($d["comp_ca_estado"] == "5")
                $class = "row_green";
            else if ($d["comp_ca_estado"] == "6")
                $class = "row_yellow";
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
            $datosjson=json_decode(utf8_encode($d["comp_ca_datos"]));
            $valor = ($d["comp_ca_valor"] != "") ? $d["comp_ca_valor"] : (($d["comp_ca_valor3"] >= $d["comp_ca_valor4"]) ? $d["comp_ca_valor3"] : $d["comp_ca_valor4"]);
            $this->data[] = array(
                "tipocomprobante" => $d["tcomp_ca_tipo"],
                "titulohouse" => "House", 
                "titulotaza" => "Valor x tasa cambio", 
                "titulocambio" => "Tasa de cambio",
                "idempresa" => $d["tcomp_ca_idempresa"], 
                "empresa" => utf8_encode($d["emp_ca_nombre"]),
                "idhouse" => $d["c_ca_idhouse"], 
                "idcomprobante" => $d["comp_ca_idcomprobante"], 
                "docentry" => $d["comp_ca_docentry"],
                "comprobante" => $consecutivo, 
                "fchcomprobante" => $d["comp_ca_fchcomprobante"],
                "cliente" => utf8_encode($d["ids_ca_nombre"]), 
                "doctransporte" => $d["c_ca_doctransporte"],
                "idmoneda" => $d["comp_ca_idmoneda"],
                "impoexpo" => utf8_encode($d["ccosto_ca_impoexpo"]),
                "transporte" => utf8_encode($d["ccosto_ca_transporte"]),
                "nameccosto" => utf8_encode($d["ccosto_ca_nombre"]),
                "valor" => round($valor, 2),
                "house" => $house, 
                "valor2" => $d["comp_ca_valor2"],
                "valortcambio" => round(( (float) $valor * (float) $d["comp_ca_tcambio"]), 2), 
                "tcambio" => $d["comp_ca_tcambio"],                
                "idconcepto" => $d["det_ca_idconcepto"],
                "concepto" => utf8_encode($d["det_ca_idconcepto"] . "-" . $d["s_ca_descripcion"]),
                "iddetalle" => $d["det_ca_iddetalle"], 
                "estado" => $d["comp_ca_estado"],
                "idccosto" => $d["tcomp_ca_idccosto"], 
                "class" => $class, "file" => $file,
                "footer" => $rc,
                "tooltip" => "Generado:({$d["comp_ca_usugenero"]}-{$d["comp_ca_fchgenero"]})",
                "collect" => ($datosjson->collect?$datosjson->collect:"off")
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
                    "tooltip" => "",
                    "collect" => "off"
                );
            }
        }


        $this->responseArray = array("success" => true, "root" => $this->data,"debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosConceptosFactPr(sfWebRequest $request) {
        $this->data = array();
        
        if ($request->getParameter("idcomprobante") > 0) {
            $idcomprobante = $request->getParameter("idcomprobante");
            $this->forward404Unless($idcomprobante);
            $q = Doctrine::getTable("InoComprobante")
                    ->createQuery("comp")
                    ->select("c.ca_idhouse,  c.ca_idcliente ,c.ca_doctransporte, im.ca_referencia,
                            ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv,
                            comp.ca_idcomprobante, comp.ca_consecutivo,comp.ca_fchcomprobante,comp.ca_idmoneda,comp.ca_usugenero,comp.ca_fchgenero,
                            m.ca_nombre,s.ca_concepto_esp,det.ca_iddetalle,comp.ca_estado,tcomp.ca_tipo,tcomp.ca_comprobante,tcomp.ca_idempresa,
                            det.*")                    
                    ->innerJoin("comp.Ids ids")                    
                    ->innerJoin("comp.InoTipoComprobante tcomp")
                    ->innerJoin("comp.InoDetalle det WITH det.ca_idconcepto is not null AND (ca_cr != 0 OR ca_DB != 0) AND tcomp.ca_tipo in ('P','D')")
                    ->leftJoin("det.InoMaster im")
                    ->leftJoin("det.InoHouse c")
                    ->leftJoin("comp.Ids fact")
                    ->leftJoin("comp.Moneda m")
                    ->leftJoin('det.InoMaestraConceptos s  ')
                    ->where("comp.ca_idcomprobante = $idcomprobante  ")
                    ->addOrderBy("tcomp.ca_tipo,tcomp.ca_comprobante")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            
            $sql = $q->getSqlQuery();
            $datos = $q->execute();
            
            foreach ($datos as $d) {
                $consecutivo = ($d["tcomp_ca_tipo"] == "F") ? "FACTURA " : (($d["tcomp_ca_tipo"] == "C") ? "<span class='row_yellow'>NOTA CREDITO</span>" : "");
                $consecutivo .= ($d["comp_ca_consecutivo"] == "") ? " Factura # ".$d["comp.ca_consecutivo"]."- Sin Gen. Id.: " . $d["comp_ca_idcomprobante"] : $d["tcomp_ca_tipo"] . "" . $d["tcomp_ca_comprobante"] . "-" . $d["comp_ca_consecutivo"];
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
                    "class" => $class,                        
                    "ca_iddetalle" => $d["det_ca_iddetalle"],
                    "ca_idconcepto" => $d["det_ca_idconcepto"],
                    "ca_concepto" => utf8_encode($d["det_ca_idconcepto"] . "-" . $d["s_ca_concepto_esp"]),
                    "ca_referencia" => $d["im_ca_referencia"],
                    "ca_idmaster" => $d["det_ca_idmaster"],
                    "idcomprobante" => $d["comp_ca_idcomprobante"],
                    "comprobante" => $consecutivo, 
                    "fchcomprobante" => $d["comp_ca_fchcomprobante"],
                    "idmoneda" => $d["comp_ca_idmoneda"], 
                    "moneda" => $d["m_ca_nombre"],
                    "ca_valor" => ($d["det_ca_cr"]!=0?$d["det_ca_cr"]:$d["det_ca_db"]),                    
                    "ca_idhouse" => $d["det_ca_idhouse"],
                    "ca_hbl" => $d["c_ca_doctransporte"],
                );
            }
            
        }
        
        if(count($this->data)==0)
        {
            $this->data[] = array(                
                "ca_idconcepto" => '',
                "ca_concepto" => '-',
                "ca_referencia" => '',
                "ca_idmaster" => '',
                "idcomprobante" => '',
                "comprobante" => '', 
                "fchcomprobante" => '',
                "idmoneda" => '', 
                "moneda" => '',
                "ca_valor" => '',                    
                "ca_idhouse" => '',
                "ca_hbl" => '',
            );
            $sql = "";
            
        }
        
        $this->responseArray = array("success" => true, "root" => $this->data, "total" => count($this->data), "debug" => $sql);
        $this->setTemplate("responseTemplate");
    }
               
    
    function executeDatosTransaccionesOut($request) {
        
        echo "1";
        $q = Doctrine::getTable("IntTransaccionesOut")
                ->createQuery("it")
                ->leftJoin("it.IntTipos t")
                ->orderBy("ca_idtransaccion DESC")
                ->limit(50)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);;
        
        $debug = $q->getSqlQuery();
        
        $transacciones = $q->execute();
        echo "2";
        exit();
        echo "<pre>";print_r($transacciones);echo "</pre>";
        
        foreach ($transacciones as $k => $c) {
            $transacciones[$k]["it_ca_datos"] = utf8_encode($transacciones[$k]["it_ca_datos"]);
            $transacciones[$k]["it_ca_respuesta"] = utf8_encode($transacciones[$k]["it_ca_respuesta"]);
        }
        
        
        
        $this->responseArray = array("success" => true, "root" => $transacciones, "total" => count($transacciones), "debug" => $debug);
        
        $this->setTemplate("responseTemplate");
        
    }
    
    function executeDatosTransaccionesIn($request) {
        
        $q = Doctrine::getTable("IntTransaccionesIn")
                ->createQuery("it")
                ->orderBy("ca_idtransaccion DESC")
                ->limit(50)
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);;
        
        $debug = $q->getSqlQuery();
        
        $transacciones = $q->execute();
        
        
        foreach ($transacciones as $k => $c) {
            $transacciones[$k]["it_ca_datos"] = utf8_encode($transacciones[$k]["it_ca_datos"]);
            $transacciones[$k]["it_ca_respuesta"] = utf8_encode($transacciones[$k]["it_ca_respuesta"]);
            
            switch($transacciones[$k]["it_ca_tipo"]){
                case 1:
                    $transacciones[$k]["it_ca_tipodet"] = "Factura de Compra";
                    break;
                case 2:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Cancelaci�n de comprobantes");
                    break;
                case 3:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Pagos Recibidos");
                    break;
                case 4:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Activaci�n Cliente");
                    break;
                case 5:
                    $transacciones[$k]["it_ca_tipodet"] = utf8_encode("Activaci�n Conceptos");
                    break;
            }
        }
        
        $this->responseArray = array("success" => true, "root" => $transacciones, "total" => count($transacciones), "debug" => $debug);        
        $this->setTemplate("responseTemplate");        
    }
}