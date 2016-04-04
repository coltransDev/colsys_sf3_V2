<?php

/**
 * falabella actions.
 *
 * @package    colsys
 * @subpackage falabella
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class falabellaActions extends sfActions {
    /*
     * Accion por defecto
     */

    public function executeIndex() {
        return $this->forward('falabella', 'list');
    }
    
    /*
     * Conexión a la base de datos de réplica
     */
    
    public  function getConnReplica()
    {
        if(!$this->conReplica)
        {
            $databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases_replica.yml');
            $confCon=$databaseConf['prod']['doctrine'];            
            $dsn = $confCon['param']['dsn'];        
            $principal =  substr( $dsn, 0,  strpos( $dsn, ";") );            
            $servidor = substr( $dsn,  strlen( $principal )+6 );
            $database = substr( $principal, strpos( $principal, "dbname")+7 );
            $usuarioDb = $confCon['param']['username'];
            $password = $confCon['param']['password'];
            
            $this->conReplica = Doctrine_Manager::connection(new PDO("pgsql:dbname=".$database.";host=".$servidor, $usuarioDb, $password));

        }
        return $this->conReplica;
    }

    /*
     * Lista los PO disponibles
     */

    public function executeList() {
        $this->fala_headers = Doctrine::getTable("FalaHeader")
                ->createQuery("f")
                ->addWhere("f.ca_fcharchivado is null")
                ->addOrderBy("f.ca_fecha_carpeta DESC")
                ->execute();
    }

    /*
     * Lista los Facturas por Agenciamiento de Carga
     */

    public function executeDatosFacturacion() {
        $this->fala_facturacion = Doctrine::getTable("FalaFacturacion")
                ->createQuery("f")
                ->addWhere("f.ca_fcharchivado is null")
                ->addOrderBy("f.ca_emision_fch DESC")
                ->execute();
    }

    /*
     * Edición de Facturas
     */

    public function executeDatosFactura() {
        
    }

    /*
     * Panel de facturacion
     */

    public function executeObservePanelFacturacion(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $numdocumento = $request->getParameter("olddocumento");

        $factura = Doctrine::getTable("FalaFacturacion")->find($numdocumento);
        if (!$factura) {
            $factura = new FalaFacturacion();
        }
        if ($this->getRequestParameter('numdocumento')) {
            $factura->setCaNumdocumento($this->getRequestParameter('numdocumento'));
        }
        if ($this->getRequestParameter('emision_fch')) {
            $factura->setCaEmisionFch($this->getRequestParameter('emision_fch'));
        }
        if ($this->getRequestParameter('vencimiento_fch')) {
            $factura->setCaVencimientoFch($this->getRequestParameter('vencimiento_fch'));
        }
        if ($this->getRequestParameter('moneda')) {
            $factura->setCaMoneda($this->getRequestParameter('moneda'));
        }
        if ($this->getRequestParameter('tipo_cambio')) {
            $factura->setCaTipoCambio($this->getRequestParameter('tipo_cambio'));
        }
        if ($this->getRequestParameter('afecto_vlr')) {
            $factura->setCaAfectoVlr($this->getRequestParameter('afecto_vlr'));
        }
        if ($this->getRequestParameter('iva_vlr')) {
            $factura->setCaIvaVlr($this->getRequestParameter('iva_vlr'));
        }
        if ($this->getRequestParameter('exento_vlr')) {
            $factura->setCaExentoVlr($this->getRequestParameter('exento_vlr'));
        }
        $factura->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeArchivarFactura(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("FalaFacturacion")->find($numdocumento);
        if ($factura) {
            $factura->setCaFcharchivado(date("d M Y H:i:s"));
            $factura->setCaUsuarchivado($this->getUser()->getUserId());
            $factura->save();
        }
        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeRevertirFactura(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("FalaFacturacion")->find($numdocumento);
        if ($factura) {
            $factura->setCaFchprocesado(null);
            $factura->setCaUsuprocesado(null);
            $factura->save();
        }
        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeAnularFactura(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("FalaFacturacion")->find($numdocumento);
        if ($factura) {
            $factura->setCaFchanulado(date("d M Y H:i:s"));
            $factura->setCaUsuanulado($this->getUser()->getUserId());
            $factura->save();
        }
        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarFactura(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("FalaFacturacion")->find($numdocumento);
        if ($factura) {
            $factura->delete();
        }
        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Permite ver las intrucciones de embarque
     */

    public function executeShippingInstructions() {
        $this->header = Doctrine::getTable("FalaHeader")->find(base64_decode($this->getRequestParameter('iddoc')));
        $this->forward404Unless($this->header);
        $this->instructions = $this->header->getFalaInstruction();
        $this->info = $this->header->getFalaShipmentInfo();

        $this->emails = ParametroTable::retrieveByCaso("CU085");

        $contactos = '';
        foreach ($this->emails as $email) {
            $contactos.= $email->getCaValor() . ",";
        }
        $this->contactos = substr($contactos, 0, strlen($contactos) - 1);
    }

    /*
     * Permite ver los detalles del PO y confirmar los datos para generar el archivo de salida
     */

    public function executeDetails() {
        $this->fala_header = Doctrine::getTable("FalaHeader")->find(base64_decode($this->getRequestParameter('iddoc')));
        $this->forward404Unless($this->fala_header);

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn", 'last');
        $response->addJavaScript("extExtras/StatusBar", 'last');
    }

    /*
     * Guarda los cambios en el encabezado del documento
     */

    public function executeObserveHeader() {
        $fala_header = Doctrine::getTable("FalaHeader")->find($this->getRequestParameter('iddoc'));
        $this->forward404Unless($fala_header);

        $this->responseArray = array("id" => $this->getRequestParameter('id'), "success" => false);

        if ($this->getRequestParameter('reporte') !== null) {
            $fala_header->setCaReporte($this->getRequestParameter('reporte'));
        }

        if ($this->getRequestParameter('num_viaje') !== null) {
            $fala_header->setCaNumViaje($this->getRequestParameter('num_viaje'));
        }

        if ($this->getRequestParameter('container_mode') !== null) {
            $fala_header->setCaContainerMode($this->getRequestParameter('container_mode'));
        }

        if ($this->getRequestParameter('cod_carrier') !== null) {
            $fala_header->setCaCodCarrier($this->getRequestParameter('cod_carrier'));
        }

        if ($this->getRequestParameter('numero_invoice') !== null) {
            $fala_header->setCaNumeroInvoice($this->getRequestParameter('numero_invoice'));
        }

        if ($this->getRequestParameter('monto_invoice_miles') !== null) {
            $fala_header->setCaMontoInvoiceMiles($this->getRequestParameter('monto_invoice_miles'));
        }

        if ($this->getRequestParameter('concepto') !== null) {
            $fala_header->setCaConcepto($this->getRequestParameter('concepto'));
        }

        if ($this->getRequestParameter('documento_tipo') !== null) {
            $fala_header->setCaDocumentoTipo($this->getRequestParameter('documento_tipo'));
        }        
        $fala_header->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios en el detalle del documento
     */

    public function executeObserveDetail() {
        $faladetail = Doctrine::getTable("FalaDetail")->find(array($this->getRequestParameter('iddoc'), $this->getRequestParameter('sku')));
        $this->forward404Unless($faladetail);

        $this->responseArray = array("id" => $this->getRequestParameter('id'), "success" => false);

        if ($this->getRequestParameter('cantidad_miles') !== null) {
            $faladetail->setCaCantidadMiles($this->getRequestParameter('cantidad_miles'));
        }

        if ($this->getRequestParameter('unidad_medidad_cantidad')) {
            $faladetail->setCaUnidadMedidadCantidad($this->getRequestParameter('unidad_medidad_cantidad'));
        }

        if ($this->getRequestParameter('cantidad_paquetes_miles')) {
            $faladetail->setCaCantidadPaquetesMiles($this->getRequestParameter('cantidad_paquetes_miles'));
        }

        if ($this->getRequestParameter('unidad_medida_paquetes')) {
            $faladetail->setCaUnidadMedidaPaquetes($this->getRequestParameter('unidad_medida_paquetes'));
        }

        if ($this->getRequestParameter('cantidad_volumen_miles')) {
            $faladetail->setCaCantidadVolumenMiles($this->getRequestParameter('cantidad_volumen_miles'));
        }

        if ($this->getRequestParameter('unidad_medida_volumen')) {
            $faladetail->setCaUnidadMedidaVolumen($this->getRequestParameter('unidad_medida_volumen'));
        }

        if ($this->getRequestParameter('cantidad_peso_miles')) {
            $faladetail->setCaCantidadPesoMiles($this->getRequestParameter('cantidad_peso_miles'));
        }

        if ($this->getRequestParameter('unidad_medida_peso')) {
            $faladetail->setCaUnidadMedidaPeso($this->getRequestParameter('unidad_medida_peso'));
        }

        if ($this->getRequestParameter('num_cont_part1')) {
            $faladetail->setCaNumContPart1($this->getRequestParameter('num_cont_part1'));
        }

        if ($this->getRequestParameter('num_cont_part2')) {
            $faladetail->setCaNumContPart2($this->getRequestParameter('num_cont_part2'));
        }

        if ($this->getRequestParameter('num_cont_sell')) {
            $faladetail->setCaNumContSell($this->getRequestParameter('num_cont_sell'));
        }

        if ($this->getRequestParameter('container_iso')) {
            $faladetail->setCaContainerIso($this->getRequestParameter('container_iso'));
        }
        $faladetail->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Actualiza el reporte en el encabezado del documento
     */

    public function executeBuscarReporte() {
        $fala_header = Doctrine::getTable("FalaHeader")->find($this->getRequestParameter('iddoc'));
        $this->forward404Unless($fala_header);

        $consecutivo = $this->getRequestParameter("reporte");

        $reporte = ReportePeer::retrieveByConsecutivo($consecutivo);
        if ($reporte) {
            $fala_header->setCaReporte($reporte->getCaConsecutivo());
            $fala_header->save();
            return sfView::SUCCESS;
        } else {
            return sfView::ERROR;
        }
    }

    /*
     * Genera informe de cantidades
     */

    public function executeInformarOrden() {
        $details = Doctrine::getTable("FalaDetail") // Elimina los registros anteriores
                ->createQuery("d")
                ->where("d.ca_iddoc = ?", base64_decode($this->getRequestParameter('iddoc')))
                ->addOrderBy("d.ca_sku")
                ->execute();
        $this->iddoc = $this->getRequestParameter('iddoc');
        $salida = '';
        $salida.= "Carpeta" . "\t"; // 1
        $salida.= "SKU" . "\t"; // 2
        $salida.= "Descripcion" . "\t"; // 3
        $salida.= "Cant.Pedida" . "\t"; // 4
        $salida.= "Cant.Despachada" . "\t"; // 5
        $salida.= "\r\n";
        foreach ($details as $detail) {
            $salida.= substr($detail->getCaIddoc(), 0, 15) . "\t"; // 1
            $salida.= $detail->getSkuNeto() . "\t"; // 2
            $salida.= $detail->getCaDescripcionItem() . "\t"; // 3
            $salida.= number_format($detail->getCaCantidadPedido(), 0, '', '') . "\t"; // 4
            $salida.= number_format($detail->getCaCantidadMiles(), 0, '', '') . "\t"; // 5
            $salida.= "\r\n";
        }

        $this->salida = $salida;
    }

    /*
     * Permite archivar la Orden de Pedido
     */

    public function executeArchivarOrden() {
        $fala_header = Doctrine::getTable("FalaHeader")->find(base64_decode($this->getRequestParameter('iddoc')));
        $this->forward404Unless($fala_header);
        $fala_header->setCaFcharchivado(date("d M Y H:i:s"));
        $fala_header->setCaUsuarchivado($this->getUser()->getUserId());
        $fala_header->save();
        $this->redirect("falabella/list");
    }

    /*
     * Permite anular la Orden de Pedido
     */

    public function executeAnularOrden() {
        $fala_header = Doctrine::getTable("FalaHeader")->find(base64_decode($this->getRequestParameter('iddoc')));
        $this->forward404Unless($fala_header);
        $fala_header->setCaFchanulado(date("d M Y H:i:s"));
        $fala_header->setCaUsuanulado($this->getUser()->getUserId());
        $fala_header->save();
        $this->redirect("falabella/list");
    }

    /*
     * Permite Duplicar un registro de la Orden de Pedido
     */

    public function executeDuplicateRecord() {
        $faladetail = FalaDetailPeer::retrieveByPk(base64_decode($this->getRequestParameter('iddoc')), $this->getRequestParameter('sku'));
        $this->forward404Unless($faladetail);
        $doc_mem = $this->getRequestParameter('iddoc');
        $sku_mem = $faladetail->getSkuNeto();

        $c = new Criteria();
        $c->add(FalaDetailPeer::CA_IDDOC, FalaDetailPeer::CA_IDDOC . " = '$doc_mem'", Criteria::CUSTOM);
        $c->addAnd(FalaDetailPeer::CA_SKU, FalaDetailPeer::CA_SKU . " LIKE '$sku_mem%'", Criteria::CUSTOM);
        $sku_num = FalaDetailPeer::doCount($c);

        $sku_mem.= "-" . $sku_num;

        $new_faladetail = $faladetail->copy(FALSE);
        $new_faladetail->setCaIddoc($this->getRequestParameter('iddoc'));
        $new_faladetail->setCaSku($sku_mem);
        $new_faladetail->setCaCantidadPedido(0);
        $new_faladetail->setCaCantidadMiles(0);
        $new_faladetail->save();
        $this->redirect("falabella/details?iddoc=" . base64_encode($doc_mem));
        return sfView::NONE;
    }

    /*
     * Generar una Nueva Orden con los productos faltantes
     */

    public function executeGenerarNuevaOrden() {
        $doc_mem = base64_decode($this->getRequestParameter('iddoc'));
        $fala_header = Doctrine::getTable("FalaHeader")->find($doc_mem);
        $this->forward404Unless($fala_header);

        $c = new Criteria();
        $c->add(FalaHeaderPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC . " LIKE '$doc_mem%'", Criteria::CUSTOM);
        $doc_mem = $fala_header->getIdDocNeto();
        $doc_num = FalaHeaderPeer::doCount($c);
        $doc_mem.= "-" . $doc_num;

        $new_falaheader = $fala_header->copy(FALSE);
        $new_falaheader->setCaIddoc($doc_mem);
        $new_falaheader->setCaProcesado(FALSE);
        $new_falaheader->setCaFchanulado(NULL);
        $new_falaheader->setCaUsuanulado(NULL);
        $new_falaheader->save();

        $faladetails = $fala_header->getFalaDetails();
        foreach ($faladetails as $detail) {
            if ($detail->getCaCantidadMiles() < $detail->getCaCantidadPedido()) {
                $new_faladetail = $detail->copy(FALSE);
                $new_faladetail->setCaIddoc($doc_mem);
                $new_faladetail->setCaSku($detail->getCaSku());
                $new_faladetail->setCaCantidadPedido($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
                $new_faladetail->setCaCantidadMiles($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
                $new_faladetail->save();
            }
        }
        $falashippings = $fala_header->getFalaShipmentInfos();
        foreach ($falashippings as $shipping) {
            $new_shipping = $shipping->copy(FALSE);
            $new_shipping->setCaIddoc($doc_mem);
            $new_shipping->save();
        }
        $this->redirect("falabella/generarArchivo?iddoc=" . $this->getRequestParameter('iddoc'));
        return sfView::NONE;
    }

    /*
     * Genera el archivo de salida
     */

    public function executeGenerarArchivo() {
        $fala_header = Doctrine::getTable("FalaHeader")->find(base64_decode($this->getRequestParameter('iddoc')));

        $details = Doctrine::getTable("FalaDetail") // Elimina los registros anteriores
                ->createQuery("d")
                ->where("d.ca_iddoc = ?", base64_decode($this->getRequestParameter('iddoc')))
                ->addOrderBy("d.ca_sku")
                ->execute();

        $reporte = ReporteTable::retrieveByConsecutivo($fala_header->getcaReporte());
        $this->forward404unless($reporte);

        $status = $reporte->getUltimoStatus();
        $salida = '';
        foreach ($details as $detail) {
            $salida.= substr($fala_header->getCaIddoc(), 0, 15) . "|"; // 1
            $salida.= $fala_header->getCaArchivoOrigen() . "|"; // Archivo de Origen 2
            $salida.= "ASN|"; // 3
            $salida.= "COL|"; // 4
            $salida.= "|"; // Correlativo Coltrans 5
            $salida.= (($reporte->getcaTransporte() != 'Aéreo') ? "MB" : "AW") . "|"; // 6
            $salida.= $reporte->getDoctransporte() . "|"; // 7
            $salida.= "|"; // Contact 8  /blanco
            $salida.= "|"; // Contact Number 9
            $salida.= "|"; // Lloyd  10
            $salida.= (($reporte->getcaTransporte() == "Aéreo") ? "AIR" : $reporte->getIdnave() ) . "|"; // Vessel 11
            $salida.= $fala_header->getCaNumViaje() . "|"; // NÃºmero de Viaje 12
            $salida.= "COLT|"; // Carrier 13
            $salida.= (($reporte->getcaTransporte() == "Aéreo") ? "L" : "") . "|"; // Vessel 14
            $salida.= (($reporte->getcaTransporte() == "Aéreo") ? "A" : "S") . "|"; // Vessel 15
            $salida.= "UN|"; // Vessel 16
            $salida.= $fala_header->getCaCodigoPuertoPickup() . "|"; // 17
            $salida.= "UN|"; // Vessel 18
            $salida.= $fala_header->getCaCodigoPuertoPickup() . "|"; // 19
            $salida.= "UN|"; // Vessel 20
            $salida.= $fala_header->getCaCodigoPuertoDescarga() . "|"; // 21
            $salida.= "UN|"; // Vessel 22
            $salida.= $fala_header->getCaCodigoPuertoDescarga() . "|"; // 23

            $ets_mem = (strlen(trim($reporte->getETS())) == 0 and $status) ? Utils::parseDate($status->getCaFchsalida(), "Ymd") : Utils::parseDate($reporte->getETS(), "Ymd");
            $eta_mem = (strlen(trim($reporte->getETA())) == 0 and $status) ? Utils::parseDate($status->getCaFchllegada(), "Ymd") : Utils::parseDate($reporte->getETA(), "Ymd");
            $salida.= $ets_mem . "|"; // 24
            $salida.= $ets_mem . "|"; // 25
            $salida.= $eta_mem . "|"; // 26
            $salida.= $eta_mem . "|"; // 27

            $salida.= str_replace("-", "", $detail->getCaNumContPart1()) . "|"; // Id Cont 4 Car  28
            $salida.= str_replace("-", "", $detail->getCaNumContPart2()) . "|"; // Id Cont 10 Car  29
            $salida.= $detail->getCaNumContSell() . "|"; // Sello de Cont Car  30
            $salida.= $detail->getCaContainerIso() . "|"; // Cod ISO 31
            $salida.= (($reporte->getcaTransporte() != "Aéreo") ? $fala_header->getCaContainerMode() : "") . "|"; // Container Mode 32
            $salida.= (($reporte->getcaTransporte() == "Aéreo") ? $reporte->getDoctransporte() : "") . "|"; // Vessel 33
            $salida.= "|"; // 34
            $salida.= "|"; // 35
            $salida.= "|"; // 36
            $salida.= substr($fala_header->getCaIddoc(), 0, 15) . "|"; // 37
            $salida.= Utils::parseDate($fala_header->getCaFechaCarpeta(), "Ymd") . "|"; // 38
            $salida.= $detail->getSkuNeto() . "|"; // 39
            $salida.= $detail->getCaVpn() . "|"; // 40
            $salida.= number_format($detail->getCaCantidadMiles() * 10000, 0, '', '') . "|"; // 41
            $salida.= $detail->getCaUnidadMedidadCantidad() . "|"; // 42
            $salida.= $detail->getCaDescripcionItem() . "|"; // 43
            $salida.= number_format($detail->getCaCantidadPaquetesMiles() * 10000, 0, '', '') . "|"; // 44
            $salida.= $detail->getCaUnidadMedidaPaquetes() . "|"; // 45
            $salida.= number_format($detail->getCaCantidadVolumenMiles() * 10000, 0, '', '') . "|"; // 46
            $salida.= $detail->getCaUnidadMedidaVolumen() . "|"; // 47
            $salida.= number_format($detail->getCaCantidadPesoMiles() * 10000, 0, '', '') . "|"; // 48
            $salida.= $detail->getCaUnidadMedidaPeso() . "|"; // 49
            $salida.= "01-01|"; // Vessel 50
            $salida.= "|"; // 51
            $salida.= "|"; // 52
            $salida.= "|"; // 53
            $salida.= "|"; // 54
            $salida.= "UN|"; // Vessel 55
            $salida.= $fala_header->getCaCodigoPuertoPickup() . "|"; // 56
            $salida.= "UN|"; // Vessel 57
            $salida.= $fala_header->getCaCodigoPuertoDescarga() . "|"; // 58
            $salida.= $fala_header->getCaNombreProveedor() . "|"; // 59
            $salida.= $fala_header->getCaCampo_59() . "|"; // 60
            $salida.= $fala_header->getCaCodigoProveedor() . "|"; // 61
            $salida.= $fala_header->getCaCampo_61() . "|"; // 62
            $salida.= number_format($fala_header->getCaMontoInvoiceMiles() * 10000, 0, '', '') . "|"; // 63
            $salida.= $fala_header->getCaProformaNumber(); // 64
            $salida.= "\r\n";
        }
        $directory = sfConfig::get('app_falabella_output');
        $filename = $directory . DIRECTORY_SEPARATOR . 'ASN' . date('ymdHis') . '.txt';
        $handle = fopen($filename, 'w');

        if (fwrite($handle, $salida) === FALSE) {
            echo "No se puede escribir al archivo {$filename}";
            exit;
        } else {
            $fala_header->setCaProcesado(true);
            $fala_header->save();
        }
        $this->redirect("falabella/list");
    }

    /*
     * Genera el archivo de facturacion
     */

    public function executeGenerarFactura() {
        $q = Doctrine::getTable("FalaFacturacion")
                ->createQuery("d")
                ->select("d.ca_numdocumento")
                ->where("d.ca_fcharchivado IS NULL")
                ->addWhere("d.ca_fchanulado IS NULL");
        
        if ($this->getRequestParameter('iddoc')){
            $fala_header = Doctrine::getTable("FalaHeader")->find(base64_decode($this->getRequestParameter('iddoc')));
            $this->forward404Unless($fala_header);
            
            $q->addWhere("d.ca_numdocumento = ?", $fala_header->getCaNumeroInvoice());
        }
        
        $invoices = $q->execute();

        foreach ($invoices as $invoice) {
            $sql = "select fh.ca_iddoc, fh.ca_numero_invoice, fh.ca_cod_carrier, fh.ca_monto_invoice_miles, fs.ca_monto_invoice_sum, (fh.ca_monto_invoice_miles / fs.ca_monto_invoice_sum) as ca_percent, fh.ca_concepto, fh.ca_documento_tipo";
            $sql.= "  from tb_falaheader fh inner join";
            $sql.= "  (select ca_numero_invoice, sum(ca_monto_invoice_miles) as ca_monto_invoice_sum from tb_falaheader group by ca_numero_invoice) fs";
            $sql.= "  on fs.ca_numero_invoice = fh.ca_numero_invoice";
            $sql.= "  where fh.ca_numero_invoice = '" . $invoice->getCaNumdocumento() . "'";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($sql);

            $salida = "";
            $vlr_control = 0;
            while ($row = $stmt->fetch()) {
                $vlr_afecto = floatval($invoice->getCaAfectoVlr());
                $vlr_exento = floatval($invoice->getCaExentoVlr());
                $vlr_iva = floatval($invoice->getCaIvaVlr());
                $vlr_total = $vlr_afecto + $vlr_exento + $vlr_iva;

                //$documento = ($vlr_afecto!=0 and $vlr_exento==0)?"87":"88";
                $salida.= $row["ca_documento_tipo"]; // 1
                $salida.= "800024075 "; // 2
                $salida.= "8"; // 3
                $salida.= "900017447 "; // 4
                $salida.= "8"; // 5
                $salida.= str_pad($invoice->getCaNumdocumento(), 10, " "); // 6
                $salida.= str_pad(null, 10, " "); // 7
                list($anno, $mes, $dia) = sscanf($invoice->getCaEmisionFch(), "%d-%d-%d");
                $emision = date("Ymd", mktime(0, 0, 0, $mes, $dia, $anno));
                $salida.= $emision; // 8
                list($anno, $mes, $dia) = sscanf($invoice->getCaVencimientoFch(), "%d-%d-%d");
                $vencimiento = date("Ymd", mktime(0, 0, 0, $mes, $dia, $anno));
                $salida.= $vencimiento; // 9
                $salida.= str_pad($invoice->getCaMoneda(), 3, " "); // 10  Siempre en Pesos Colombianos
                $salida.= str_pad(floatval($invoice->getCaTipoCambio()), 10, "0", STR_PAD_LEFT); // 11

                $salida.= str_pad($vlr_total, 10, "0", STR_PAD_LEFT); // 12
                $salida.= str_pad($vlr_afecto, 10, "0", STR_PAD_LEFT); // 13
                $salida.= str_pad($vlr_iva, 10, "0", STR_PAD_LEFT); // 14

                //$concepto = ($vlr_afecto!=0 and $vlr_exento==0)?"12":"21";
                $salida.= str_pad($row["ca_concepto"], 5, " "); // 15 Concepto
                $salida.= str_pad(substr($row["ca_iddoc"], 0, 15), 20, " "); // 16

                $dec_pre = ($invoice->getCaMoneda()!="COP")?2:0;
                $salida.= str_pad(floatval($row["ca_cod_carrier"]), 2, "0", STR_PAD_LEFT); // 17 Embarque
                $vlr_control+= round(floatval($vlr_total * $row["ca_percent"]), $dec_pre);
                $vlr_ajustes = ( abs($vlr_total-$vlr_control) <= 2 )? $vlr_total - $vlr_control: 0; // Si hay una diferencia inferior o igual a 2 pesos -> ajusta
                $salida.= str_pad(round(floatval($vlr_total * $row["ca_percent"]), $dec_pre) + $vlr_ajustes, 10, "0", STR_PAD_LEFT); // 18 Valor del Embarque

                $spaces = array(8, 30, 30, 4, 20, 20, 10); // Campos del 19 al 27
                foreach ($spaces as $space) {
                    $salida.= str_pad(null, $space, " ");
                }

                $salida.= str_pad($vlr_exento, 10, "0", STR_PAD_LEFT); // 28
                $salida.= str_pad("", 30, " "); // 29
                $salida.= "\r\n";
            }
            /*  No se reporta por ser autoretenedores.
            $salida.= "12"; // 1
            $salida.= "800024075"; // 2
            $salida.= "900017447 "; // 3
            $salida.= str_pad($invoice->getCaNumdocumento(), 10, " "); // 4
            $salida.= str_pad("003", 50, " "); // 5 Concepto de Retención en la Fuente
            $salida.= str_pad(floatval($invoice->getCaAfectoVlr()), 10, "0", STR_PAD_LEFT); // 6
            $salida.= "\r\n";
            */
            $salida.= "13"; // 1
            $salida.= "800024075"; // 2
            $salida.= "900017447 "; // 3
            $salida.= str_pad($invoice->getCaNumdocumento(), 10, " "); // 4
            $salida.= str_pad("002", 50, " "); // 5 Concepto del IVA
            $salida.= str_pad(floatval($invoice->getCaIvaVlr()), 10, "0", STR_PAD_LEFT); // 6
            $salida.= "\r\n";

            $directory = sfConfig::get('app_falabella_output');
            $filename = $directory . DIRECTORY_SEPARATOR . 'FAC_' . $invoice->getCaNumdocumento() . '.txt';
            $handle = fopen($filename, 'w');

            if (fwrite($handle, $salida) === FALSE) {
                echo "No se puede escribir al archivo {$filename}";
                exit;
            }
        }

        $this->redirect("falabella/list");
    }

    public function executeEnviarEmail() {

        // $this->setLayout("ajax");
        $content = sfContext::getInstance()->getController()->getPresentationFor('falabella', 'shippingInstructions', 'email');

        $user = $this->getUser();

        //Crea el correo electronico
        $email = new Email();
        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Fal Shipping Inst.");
        $email->setCaIdcaso(substr(base64_decode($this->getRequestParameter('iddoc')), -5));
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

        $recips = explode(",", $this->getRequestParameter("cc"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addCc($recip);
                }
            }
        }

        $email->addCc($this->getUser()->getEmail());
        $email->setCaSubject($this->getRequestParameter("asunto"));
        $email->setCaBody($this->getRequestParameter("mensaje") . "<br />" . $content);

        $email->save(); //guarda el cuerpo del mensaje
        //$email->send(); //envía el mensaje

        $this->redirect("falabella/list");
    }

    public function executeIndicadoresGestion(sfWebRequest $request) {

        $this->opcion = $this->getRequestParameter("opcion");
        $this->idpais_origen = $this->getRequestParameter("idpais_origen");
        $this->pais_origen = $this->getRequestParameter("pais_origen");
        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
        //list($nom_mes, $ano) = explode("-", $this->fechafinal);
        //$this->nom_mes=$nom_mes;
        //$this->ano=$ano;
        //$this->mes = Utils::nmes($nom_mes);
        //$this->mesp = $this->mes;
        if ($this->fechainicial) {
            list($ano_ini, $mes_ini) = explode("-", $this->fechainicial);
            $this->mesinicial = Utils::mesLargo($mes_ini);
            $this->ano_ini = $ano_ini;
        }
        if ($this->fechafinal) {
            list($ano_fin, $mes_fin) = explode("-", $this->fechafinal);
            $this->mesfinal = Utils::mesLargo($mes_fin);
        }

        $this->indicador = array();
        $this->grid = array();
        $this->entcarga = array();

        $this->indi_LCL = array();
        $this->indi_FCL = array();

        $this->indi_LCL[$this->pais_origen] = 3;
        $this->indi_FCL[$this->pais_origen] = 3;

        if ($this->opcion == 'buscar') {
            if ($this->transporte == "Aéreo") {
                $sql = "SELECT * 
                        FROM vi_repindicadores 
                                LEFT OUTER JOIN (
                                    SELECT rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_fchllegada, CASE WHEN rs.ca_fchllegada-rs.ca_fchsalida <1 THEN '1'  else rs.ca_fchllegada-rs.ca_fchsalida  END AS ca_diferencia, 
                                        rs.ca_piezas as ca_piezas, rs.ca_peso as ca_peso, rs.ca_volumen as ca_volumen, extract(YEAR from rs.ca_fchsalida) as ca_ano1 ,extract(MONTH from rs.ca_fchsalida) as ca_mes1
                                    FROM tb_repstatus rs 
                                        INNER JOIN tb_reportes rp ON rp.ca_idreporte = rs.ca_idreporte
                                    WHERE rs.ca_idetapa in ('IACAD','IMCPD') 
                                    GROUP BY rp.ca_consecutivo, rs.ca_fchsalida, rs.ca_fchllegada, ca_diferencia,rs.ca_piezas,rs.ca_peso,rs.ca_volumen,extract(YEAR from rs.ca_fchsalida) ,extract(MONTH from rs.ca_fchsalida)) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) 
                        WHERE vi_repindicadores.ca_impoexpo = '" . Constantes::IMPO . "' and vi_repindicadores.ca_transporte = '" . $this->transporte . "' and upper(vi_repindicadores.ca_compania) like upper('%falabella de colombia%')  
                              and vi_repindicadores.ca_traorigen= '" . $this->pais_origen . "' and sq.ca_fchsalida BETWEEN '" . $this->fechainicial . "' and '" . $this->fechafinal . "'
                        ORDER BY sq.ca_fchsalida";

                //exit;
                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                //echo $sql;
                $this->resul = $st->fetchAll();
            } elseif ($this->transporte == "Marítimo") {
                $sql = "SELECT DISTINCT v.ca_idreporte, sq.ca_consecutivo_sub, sq.ca_fchsalida, sq.ca_fchllegada, sq.ca_diferencia, sq.ca_peso, sq.ca_ano1, sq.ca_mes1, v.ca_propiedades, v.ca_traorigen, v.ca_ciudestino, v.ca_transporte, v.ca_modalidad, tt.ca_concepto, v.ca_nombre as proveedor,
                            ((SELECT sum(t.ca_liminferior) AS sum FROM tb_inoequipos_sea eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 AS teus, 
                            (SELECT count(*) AS count FROM tb_inoequipos_sea eq WHERE eq.ca_referencia::text = m.ca_referencia::text AND eq.ca_idconcepto = tt.ca_idconcepto) AS ncontenedores, 
                            (SELECT sum(ca_peso) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS ca_peso, 
                            (SELECT sum(ca_numpiezas) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS ca_piezas, 
                            (SELECT sum(ca_volumen) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS ca_volumen 
                        FROM vi_repindicadores v
                                LEFT OUTER JOIN (
                                    SELECT rp.ca_idreporte, rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_fchllegada, CASE WHEN rs.ca_fchllegada-rs.ca_fchsalida <1 THEN '1'  else rs.ca_fchllegada-rs.ca_fchsalida  END AS ca_diferencia, 
                                        rs.ca_peso as ca_peso,extract(YEAR from rs.ca_fchsalida) as ca_ano1 ,extract(MONTH from rs.ca_fchsalida) as ca_mes1
                                    FROM tb_repstatus rs 
                                        INNER JOIN tb_reportes rp ON rp.ca_idreporte = rs.ca_idreporte
                                    WHERE rs.ca_idetapa in ('IACAD','IMCPD') 
                                    GROUP BY rp.ca_idreporte, rp.ca_consecutivo, rs.ca_fchsalida, rs.ca_fchllegada, ca_diferencia, rs.ca_peso,extract(YEAR from rs.ca_fchsalida) ,extract(MONTH from rs.ca_fchsalida)) sq ON (v.ca_consecutivo = sq.ca_consecutivo_sub) 
                                JOIN tb_inoclientes_sea ics ON ics.ca_idreporte = sq.ca_idreporte
                                JOIN tb_inomaestra_sea m ON m.ca_referencia = ics.ca_referencia
                                JOIN tb_inoequipos_sea e ON e.ca_referencia = ics.ca_referencia
                                JOIN tb_conceptos tt ON e.ca_idconcepto = tt.ca_idconcepto
                        WHERE v.ca_impoexpo IN ('" . Constantes::IMPO . "','" . Constantes::OTMDTA . "') and v.ca_transporte IN ('" . $this->transporte . "','Terrestre') and upper(v.ca_compania) like upper('%falabella de colombia%')  
                              and v.ca_traorigen= '" . $this->pais_origen . "' and sq.ca_fchsalida BETWEEN '" . $this->fechainicial . "' and '" . $this->fechafinal . "'
                        ORDER BY sq.ca_fchsalida";
                //exit;
                //echo $sql;
                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);

                $this->resul = $st->fetchAll();
            }

            foreach ($this->resul as $r) {
               
                if ($r["ca_diferencia"] < 1) {
                    $r["ca_diferencia"] = 1;
                }

                $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta"] = (isset($this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta"])) ? ($this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta"] + 1) : "1";
                $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diferencia"]+=$r["ca_diferencia"];
                if ($this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diferencia"] == 0) {
                    $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diferencia"]+=1;
                }
                list($peso, $medida) = explode("|", $r["ca_peso"]);
                $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["peso"]+=$peso;
                // []=array("diferencia"=>$r["ca_diferencia"],"peso"=>$r["ca_peso"]);
                // Párametros necesarios para Gráficar Tiempo de Entrega de la carga en el Aeropuerto

                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["idreporte"] = $r["ca_idreporte"];

                $idreporte = $r["ca_idreporte"];

                $reporte = Doctrine::getTable("Reporte")->find($idreporte);

                $this->parametros = ParametroTable::retrieveByCaso("CU103", null, null, '900017447');
                $parametros = $this->parametros;
                //echo "<pre>";print_r($this->entcarga);echo "</pre>";

                foreach ($parametros as $parametro) {

                    $valor = explode(":", $parametro->getCaValor());
                    $name = $valor[0];
                    $type = $valor[1];

                    switch ($name) {
                        case "fchdocorig":
                            $fchdocorig = $reporte->getProperty($name);
                            break;
                        case "fchentregamcia":
                            $fchentregamcia = $reporte->getProperty($name);
                            break;
                        case "fchingresoasn":
                            $fchingresoasn = $reporte->getProperty($name);
                            break;
                    }
                }

                $fchsalida = $r["ca_fchsalida"];

                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["fchdocorig"] = TimeUtils::dateDiff($fchsalida, $fchdocorig);
                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchdocorig"] = (isset($this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchdocorig"])) ? ($this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchdocorig"] + 1) : "1";
                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diff_fchdocorig"]+=$this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["fchdocorig"];

                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["fchentregamcia"] = TimeUtils::dateDiff($fchsalida, $fchentregamcia);
                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchentregamcia"] = (isset($this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchentregamcia"])) ? ($this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchentregamcia"] + 1) : "1";
                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diff_fchentregamcia"]+=$this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["fchentregamcia"];

                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["fchingresoasn"] = TimeUtils::dateDiff($fchsalida, $fchingresoasn);
                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchingresoasn"] = (isset($this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchingresoasn"])) ? ($this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta_fchingresoasn"] + 1) : "1";
                $this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diff_fchingresoasn"]+=$this->entcarga[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["fchingresoasn"];
            }
        }
        //echo "<pre>";print_r($this->resul);echo "</pre>";
    }

    public function executeIndicadoresGestionExt4(sfWebRequest $request) {
        
        
        $this->years = array();
        for ($i = 0; $i < 5; $i++) {
            $this->years[] = array("year" => date('Y') - $i);
        }
        
        $periodo = utf8_decode($this->getRequestParameter("combo-inputEl"));
        $ano = $this->getRequestParameter("year");
        $idtrafico = utf8_decode($this->getRequestParameter("idtrafico"));        
        $criterio = $request->getParameter("criterio");
        $transporte = $request->getParameter("transporte-inputEl");
        $trans = $transporte=="air"?"Aéreo":"Marítimo";
        
        switch($periodo){
            case 1:
                $serieMes = array('Ene','Feb');
                $subtitle = $ano." / Ene-Feb";
                $periodo = 1;
                $end = 2;
                break;
            case 2:
                $serieMes = array('Mar','Abr');
                $subtitle = $ano." / Mar-Abr";
                $periodo = 2;
                $end = 4;
                break;
            case 3:
                $serieMes = array('May','Jun');
                $subtitle = $ano." / May-Jun";
                $periodo = 3;
                $end = 6;
                break;
            case 4:
                $serieMes = array('Jul','Ago');
                $subtitle = $ano." / Jul-Ago";
                $periodo = 4;
                $end = 8;
                break;
            case 5:
                $serieMes = array('Sep','Oct');
                $subtitle = $ano." / Sep-Oct";
                $periodo = 5;
                $end = 10;
                break;
            case 6:
                $serieMes = array('Nov','Dic');
                $subtitle = $ano." / Nov-Dic";
                $periodo = 6;
                $end = 12;
                break;
        }
        $andWhere = "";
        
        if($criterio){

            if($idtrafico){
                $andWhere = "and tro.ca_idtrafico = '" . $idtrafico . "'";                
            }

            $sql1 = "SELECT sqa.ca_ano1, sqa.ca_mes1, rp.ca_idreporte, rp.ca_consecutivo, rp.ca_orden_clie, /*i.ca_nombre AS ca_linea,*/(CASE rp.ca_modalidad 
				WHEN 'LCL' THEN 'CONSOLIDADO PROPIO COLTRANS' 
				WHEN 'COLOADING' THEN 'CONSOLIDADO PROPIO COLTRANS' 
				ELSE i.ca_nombre END) as ca_linea, tro.ca_idtrafico, tro.ca_nombre AS ca_traorigen, cio.ca_ciudad AS ca_ciuorigen, cid.ca_ciudad AS ca_ciudestino, rp.ca_transporte,rp.ca_modalidad,rp.ca_propiedades, 
                            ccn.ca_idcliente as ca_idcliente, sqa.ca_fchllegada, sqa.ca_peso, sqa.ca_piezas as ca_piezas, sqa.ca_volumen, sqa.ca_doctransporte, ca_fchsalida_cd, (CASE WHEN sqa.ca_fchllegada-ca_fchsalida_cd = 0 THEN 1 ELSE sqa.ca_fchllegada-ca_fchsalida_cd END) as ca_diferencia,
                            (CASE WHEN rp.ca_modalidad = 'COLOADING' THEN 'LCL' ELSE rp.ca_modalidad END) as nva_modalidad,	
                            (select ca_concepto 
                                    from tb_conceptos c 
                                    join tb_repequipos e on c.ca_idconcepto = e.ca_idconcepto
                                    JOIN tb_reportes r ON e.ca_idreporte = r.ca_idreporte 
                                    where c.ca_idconcepto = e.ca_idconcepto and r.ca_consecutivo = rp.ca_consecutivo
                            limit 1) as concepto
                    FROM tb_reportes rp
                         RIGHT JOIN ( SELECT tb_reportes.ca_consecutivo AS ca_consecutivo_f,
                                tb_reportes.ca_fchreporte,
                                max(tb_reportes.ca_version) AS ca_version,
                                min(tb_reportes.ca_fchcreado) AS ca_fchcreado
                               FROM tb_reportes
                              WHERE tb_reportes.ca_usuanulado IS NULL AND tb_reportes.ca_tiporep <> 4
                              GROUP BY tb_reportes.ca_consecutivo, tb_reportes.ca_fchreporte
                              ORDER BY tb_reportes.ca_consecutivo) rx ON rp.ca_consecutivo::text = rx.ca_consecutivo_f::text AND rp.ca_version = rx.ca_version
                         RIGHT OUTER JOIN ( SELECT extract(YEAR from rs.ca_fchsalida) as ca_ano1 ,extract(MONTH from rs.ca_fchsalida) as ca_mes1, ca_idreporte, ca_consecutivo, ca_fchllegada, ca_piezas, ca_peso, ca_volumen, ca_doctransporte
                                ,ca_fchsalida as ca_fchsalida_cd
                                FROM tb_repstatus rs 
                                    RIGHT JOIN ( SELECT rp.ca_consecutivo, max(rs.ca_idstatus) as ca_idstatus 
                                            FROM tb_repstatus rs 
                                                INNER JOIN tb_reportes rp on rp.ca_idreporte = rs.ca_idreporte 
                                            WHERE rs.ca_idetapa in ('IMETA','IMETT','IACCR','IMCEM')
                                            GROUP BY rp.ca_consecutivo) sf on rs.ca_idstatus = sf.ca_idstatus)  sqa ON rp.ca_consecutivo = sqa.ca_consecutivo
                         JOIN ids.tb_ids i ON rp.ca_idlinea = i.ca_id
                         JOIN tb_ciudades cio ON rp.ca_origen::text = cio.ca_idciudad::text
                         JOIN tb_traficos tro ON cio.ca_idtrafico::text = tro.ca_idtrafico::text
                         JOIN tb_ciudades cid ON rp.ca_destino::text = cid.ca_idciudad::text
                         JOIN tb_concliente ccn ON rp.ca_idconcliente = ccn.ca_idcontacto     
                 WHERE ca_impoexpo IN ('Importación','OTM-DTA')                            
                       AND ca_idcliente = 900017447
                       AND ca_ano1::numeric = $ano
                       AND ca_mes1::numeric BETWEEN 1 and $end AND ca_transporte IN ('$trans') $andWhere
                ORDER BY sqa.ca_fchsalida_cd";
                    
            $con = Doctrine_Manager::getInstance()->connection();
            //$con = $this->getConnReplica();
            $st = $con->execute($sql1);            
            $this->resul = $st->fetchAll();
            
            $obs = array();
            
            $q = Doctrine::getTable("FalaIdg")
                    ->createQuery("f")
                    ->where("f.ca_periodo = ? and ca_via = ?", array($periodo, $transporte));                    
            
            if($idtrafico)
                $q->addWhere("f.ca_idtrafico = ?", $idtrafico);
                    
            $observaciones = $q->execute();
            
            if($observaciones){
                foreach($observaciones as $observacion){
                    if($obs[$observacion->getCaIdgrafica()])
                        $obs[$observacion->getCaIdgrafica()] = $obs[$observacion->getCaIdgrafica()]."<br/>".$observacion->getCaObservacion();
                    else
                        $obs[$observacion->getCaIdgrafica()] = $observacion->getCaObservacion();
                }
            }
            

            $data = array();
            $data2 = array();
            $dataTraf = array();            
            $dataVol = array();
            $load = array();            
            $serieMes2 = array();
            $serieTraf = array();            
            
            $metaAsn_air = 1;
            $metaAsn_sea = 2;
            
            $metaDoc_air = 2;
            $metaDoc_sea = 2;
            
            $metaAsn = ${"metaAsn_".$transporte};
            $metaDoc = ${"metaDoc_".$transporte};

            foreach ($this->resul as $r) {

                $mes = Utils::getMonth(substr($r["ca_fchsalida_cd"], 5,2));
                $trafico = utf8_encode($r["ca_traorigen"]);
                $modalidad = $r["nva_modalidad"];
                $fchsalida = $r["ca_fchsalida_cd"];                
                $concepto = $modalidad!="LCL"?utf8_decode($r["concepto"]):"LCL";
                $cofa = $r["ca_orden_clie"];
                $idreporte = $r["ca_idreporte"];
                $linea = utf8_encode($r["ca_linea"]);
                
                if(!in_array($mes, $serieMes2))
                    $serieMes2[] = $mes;
                
                if(!in_array($trafico, $serieTraf))
                    $serieTraf[] = $trafico;
                
                //* Ventana de Despacho
                
                $shipment = Doctrine::getTable("FalaShipmentInfo")
                        ->createQuery("f")
                        ->select("f.ca_iddoc, f.ca_begin_window, f.ca_end_window")
                        ->where("f.ca_iddoc like ?", "%" . $cofa . "%")
                        ->limit(1)
                        ->fetchOne();
                
                if($shipment){
                    $beginW = $shipment->getCaBeginWindow();
                    $endW = $shipment->getCaEndWindow();                    
                }
               
                //* Fechas de Indicadores Falabella
                $reporte = Doctrine::getTable("Reporte")->find($idreporte);
                $parametros = ParametroTable::retrieveByCaso("CU103", null, null, '900017447');

                foreach ($parametros as $parametro) {

                    $valor = explode(":", $parametro->getCaValor());
                    $name = $valor[0];
                    $type = $valor[1];

                    switch ($name) {
                        case "fchdocorig":
                            $fchdocorig = $reporte->getProperty($name);
                            break;
                        case "fchentregamcia":
                            $fchentregamcia = $reporte->getProperty($name);
                            break;
                        case "fchingresoasn":                                
                            $fchingresoasn = $reporte->getProperty($name);
                            break;
                    }
                }
                
                $festivos = TimeUtils::getFestivos($ano);
                $diffFchAsn = TimeUtils::workDiff($festivos, $fchsalida, $fchingresoasn);
                $diffFchDoc = TimeUtils::dateDiff($fchsalida, $fchdocorig);
                
                //*GRID DE DATOS
                    
                $datos[] = array(                                        
                    "month" => $r["ca_mes1"],
                    "mes" => $mes,
                    "cofa" => utf8_encode($cofa),
                    "origen" => utf8_encode($r["ca_traorigen"]),
                    "destino" => utf8_encode($r["ca_ciudestino"]),                    
                    "modalidad" => $r["nva_modalidad"],
                    "rn"=> $r["ca_consecutivo"],
                    "peso"=> $r["ca_peso"],
                    "piezas"=> $r["ca_piezas"],
                    "volumen"=> $r["ca_volumen"],
                    "fchsalida" => $fchsalida,
                    "fchllegada" =>$r["ca_fchllegada"] ,
                    "fchdocorig" => $fchdocorig,
                    "fchingresoasn" => $fchingresoasn,
                    "beginw" => $beginW,
                    "endw" => $endW
                );
                
                //PARA LAS GRAFICAS BIMESTRALES
                if(in_array($mes, $serieMes)){
                    
                    $data[$mes]["total"] +=1;
                    $dataTraf[$trafico]["total"]+=1;
                    $load[$concepto]+=1;
                    $lineaBim[$linea]+=$r["ca_volumen"];

                    if($diffFchAsn && $diffFchAsn<=$metaAsn)
                        $dataTraf[$trafico]["cumplimiento_asn"]+=1;
                    else
                        $dataTraf[$trafico]["incumplimiento_asn"]+=1;
                }
                
                $data2[$mes]["total"] +=1; 
                $dataTrafCon[$trafico]["total"]+=1;
                $loadAcum[$concepto]+=1;
                $lineaAcum[$linea]+=$r["ca_volumen"];
               
                if($diffFchAsn && $diffFchAsn<=$metaAsn){
                    $data2[$mes]["cumplimiento_asn"]+=1;
                    $dataTrafCon[$trafico]["cumplimiento_asn"]+=1;
                }else{
                    $data2[$mes]["incumplimiento_asn"]+=1;
                    $dataTrafCon[$trafico]["incumplimiento_asn"]+=1;
                }
                
                if($diffFchDoc && $diffFchDoc<=$metaDoc)
                    $data2[$mes]["cumplimiento_doc"]+=1;                 
                else
                    $data2[$mes]["incumplimiento_doc"]+=1;
                
                if($fchsalida >= $beginW && $fchsalida<=$endW)
                    $data2[$mes]["cumplimiento_des"]+=1;
                else
                    $data2[$mes]["incumplimiento_des"]+=1;
                
                $dataVol[$trafico][$mes]+=$r["ca_volumen"];
                
                
            }

            foreach($serieMes2 as $key => $mes){
                if(in_array($mes, $serieMes)){
                    if($data[$mes]["total"]>0){
                        $data[$mes]["performance_asn"] = $data2[$mes]["cumplimiento_asn"]?round(($data2[$mes]["cumplimiento_asn"]*100)/$data[$mes]["total"]):0;
                        $data[$mes]["performance_doc"] = $data2[$mes]["cumplimiento_doc"]?round(($data2[$mes]["cumplimiento_doc"]*100)/$data[$mes]["total"]):0;
                        $data[$mes]["performance_des"] = $data2[$mes]["cumplimiento_des"]?round(($data2[$mes]["cumplimiento_des"]*100)/$data[$mes]["total"]):0;
                    }
                }
                if($data2[$mes]["total"]>0){
                    $data2[$mes]["performance_asn"] = $data2[$mes]["cumplimiento_asn"]?round(($data2[$mes]["cumplimiento_asn"]*100)/$data2[$mes]["total"]):0;
                    $data2[$mes]["performance_doc"] = $data2[$mes]["cumplimiento_doc"]?round(($data2[$mes]["cumplimiento_doc"]*100)/$data2[$mes]["total"]):0;
                    $data2[$mes]["performance_des"] = $data2[$mes]["cumplimiento_des"]?round(($data2[$mes]["cumplimiento_des"]*100)/$data2[$mes]["total"]):0;
                }                
            }
            
            foreach($serieTraf as $key => $trafico){
                if($dataTraf[$trafico]["total"]>0){
                    $dataTraf[$trafico]["performance_asn"] = $dataTraf[$trafico]["cumplimiento_asn"]?round(($dataTraf[$trafico]["cumplimiento_asn"]*100)/$dataTraf[$trafico]["total"]):0;
                    $dataTraf[$trafico]["performance_doc"] = $dataTraf[$trafico]["cumplimiento_doc"]?round(($dataTraf[$trafico]["cumplimiento_doc"]*100)/$dataTraf[$trafico]["total"]):0;
                }
                if($dataTrafCon[$trafico]["total"]>0){
                    $dataTrafCon[$trafico]["performance_asn"] = $dataTrafCon[$trafico]["cumplimiento_asn"]?round(($dataTrafCon[$trafico]["cumplimiento_asn"]*100)/$dataTrafCon[$trafico]["total"]):0;
                    $dataTrafCon[$trafico]["performance_doc"] = $dataTrafCon[$trafico]["cumplimiento_doc"]?round(($dataTrafCon[$trafico]["cumplimiento_doc"]*100)/$dataTrafCon[$trafico]["total"]):0;
                }
            }
            
            foreach($dataVol as $trafico => $gridMes){
                foreach($serieMes2 as $key => $mes){
                    if($gridMes[$mes]){
                        $data3[$trafico]["name"] = $trafico;                    
                        $data3[$trafico]["data"][] = $gridMes[$mes];                    
                    }else{
                        $data3[$trafico]["name"] = $trafico;
                        $data3[$trafico]["data"][] = null;
                    }
                }
            }
            
            foreach($data3 as $trafico => $gridSerie){
                $data4[] = $gridSerie;                
            }
            
            foreach($load as $key=> $val){
                $pieBim[] = array("index"=>$key, "value"=>$val);
            }

            foreach($loadAcum as $key=> $val){
                $pieAcum[] = array("index"=>$key, "value"=>$val);
            }
            if($lineaBim){
                arsort($lineaBim);
                foreach($lineaBim as $key=> $val){
                    $pieLineaBim[] = array("index"=>$key, "value"=>$val);
                }
            }
            arsort($lineaAcum);
            foreach($lineaAcum as $key=> $val){
                $pieLineaAcum[] = array("index"=>$key, "value"=>$val);
            }

            $this->responseArray = array("success" => true, "total" => count($data), "data" => $data, "transporte"=>$transporte, "data2"=>$data2,  "dataTraf" => $dataTraf , "dataTrafCon" => $dataTrafCon, "dataVol"=>$data4, "trafico"=>$trafico, "load"=> $pieBim, "loadAcum"=>$pieAcum, "pieLineaBim"=> $pieLineaBim, "pieLineaAcum"=>$pieLineaAcum, "datos"=>$datos, "subtitle"=>$subtitle, "ano"=>$ano, "obs"=>$obs);
            $this->setTemplate("responseTemplate");
        }
    }
    
    public function executeDatosGridObservaciones(sfWebRequest $request) {
        
        $observaciones = Doctrine::getTable("FalaIdg")
            ->createQuery("f")            
            ->orderBy("f.ca_ano, f.ca_via, f.ca_periodo, f.ca_idgrafica")
            ->execute();
        
        $periodos = json_decode($request->getParameter("periodos"), true);
        $graficas = json_decode($request->getParameter("graficas"), true);
        $graf = array();
        
        foreach($graficas as $grafica){
            $graf[$grafica["id"]] = $grafica["name"];
        }
        
        $vias = array("air" => "Aéreo", "sea"=>"Marítimo");
        
        //echo "<pre>";print_r($graficas);echo "</pre>";
        
        foreach($observaciones as $obs){
            
            $trafico = Doctrine::getTable("Trafico")->find($obs->getCaIdtrafico());
            
            $data[] = array(
                "ca_ididg" => $obs->getCaIdidg(),
                "ca_ano" => $obs->getCaAno(),
                "ca_idvia" => $obs->getCaVia(),
                "ca_via" => utf8_encode($vias[$obs->getCaVia()]),
                "ca_idperiodo" => $obs->getCaPeriodo(),
                "ca_periodo" => $periodos[$obs->getCaPeriodo()-1]["name"],
                "ca_idgrafica" => $obs->getCaIdgrafica(),
                "ca_grafica"=>$graf[$obs->getCaIdgrafica()],
                "ca_idtrafico"=>$obs->getCaIdtrafico(),
                "ca_trafico"=>$obs->getCaIdtrafico()?utf8_encode($trafico->getCaNombre()):"",
                "ca_observacion" => $obs->getCaObservacion()
            );
        }
        
        //echo "<pre>";print_r($data);echo "</pre>";
        
        $this->responseArray = array("total" => count($data), "data" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarObservacionesIdg(sfWebRequest $request) {
        
        $datos = json_decode($request->getParameter("datos"),true);
                
        $conn = Doctrine::getTable("FalaIdg")->getConnection();
        $conn->beginTransaction();
        try{
            foreach ($datos as $dato) {
                if ($dato["ca_ididg"] > 0) {
                    $falaIdg = Doctrine::getTable("FalaIdg")
                            ->createQuery("f")
                            ->where("f.ca_ididg = ?", $dato["ca_ididg"])
                            ->fetchOne();
                } else {
                    $falaIdg = new FalaIdg();
                }
                $falaIdg->setCaAno($dato["ca_ano"]);
                $falaIdg->setCaVia($dato["ca_idvia"]);
                $falaIdg->setCaPeriodo($dato["ca_idperiodo"]);
                $falaIdg->setCaIdgrafica($dato["ca_idgrafica"]);
                $falaIdg->setCaIdtrafico($dato["ca_trafico"]);
                $falaIdg->setCaObservacion($dato["ca_observacion"]);
                $falaIdg->save($conn);                
            }
            $conn->commit();            

            $this->responseArray = array("success" => true, "total" => count($datos), "data" => $datos);            
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
        
    }
}
?>