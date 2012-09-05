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
		return $this->forward ( 'falabella', 'list' );
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
	* Permite ver las intrucciones de embarque
	*/
	public function executeShippingInstructions(){
		$this->header = Doctrine::getTable("FalaHeader")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($this->header);
		$this->instructions = $this->header->getFalaInstruction();
		$this->info = $this->header->getFalaShipmentInfo();

                $this->emails = ParametroTable::retrieveByCaso("CU085");

                $contactos = '';
                foreach($this->emails as $email){
                    $contactos.= $email->getCaValor().",";
                }
                $this->contactos = substr($contactos, 0, strlen($contactos)-1);
	}


	/*
	* Permite ver los detalles del PO y confirmar los datos para generar el archivo de salida
	*/
	public function executeDetails(){
		$this->fala_header = Doctrine::getTable("FalaHeader")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($this->fala_header);

                $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/CheckColumn",'last');
                $response->addJavaScript("extExtras/StatusBar",'last');
	}

	/*
	* Guarda los cambios en el encabezado del documento
	*/
	public function executeObserveHeader(){
		$fala_header = Doctrine::getTable("FalaHeader")->find ( $this->getRequestParameter ( 'iddoc' ) );
		$this->forward404Unless($fala_header);

                $this->responseArray=array("id"=>$this->getRequestParameter('id'), "success"=>false);

		if( $this->getRequestParameter ( 'reporte' )!==null ){
			$fala_header->setCaReporte( $this->getRequestParameter ( 'reporte' ) );
		}

		if( $this->getRequestParameter ( 'num_viaje' )!==null ){
			$fala_header->setCaNumViaje( $this->getRequestParameter ( 'num_viaje' ) );
		}

		if( $this->getRequestParameter ( 'cod_carrier' )!==null ){
			$fala_header->setCaCodCarrier( $this->getRequestParameter ( 'cod_carrier' ) );
		}

		if( $this->getRequestParameter ( 'container_mode' )!==null ){
			$fala_header->setCaContainerMode( $this->getRequestParameter ( 'container_mode' ) );
		}

		if( $this->getRequestParameter ( 'numero_invoice' )!==null ){
			$fala_header->setCaNumeroInvoice( $this->getRequestParameter ( 'numero_invoice' ) );
		}

		if( $this->getRequestParameter ( 'monto_invoice_miles' )!==null ){
			$fala_header->setCaMontoInvoiceMiles( $this->getRequestParameter ( 'monto_invoice_miles' ) );
		}

		$fala_header->save();

                $this->responseArray["success"]=true;
                $this->setTemplate("responseTemplate");
	}

	/*
	* Guarda los cambios en el detalle del documento
	*/
	public function executeObserveDetail(){
		$faladetail = Doctrine::getTable("FalaDetail")->find(array( $this->getRequestParameter ( 'iddoc' ), $this->getRequestParameter ( 'sku' ) ) ) ;
		$this->forward404Unless($faladetail);

                $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

		if( $this->getRequestParameter ( 'cantidad_miles' )!==null ){
			$faladetail->setCaCantidadMiles( $this->getRequestParameter ( 'cantidad_miles' ) );
		}

		if( $this->getRequestParameter ( 'unidad_medidad_cantidad' ) ){
			$faladetail->setCaUnidadMedidadCantidad( $this->getRequestParameter ( 'unidad_medidad_cantidad' ) );
		}

		if( $this->getRequestParameter ( 'cantidad_paquetes_miles' ) ){
			$faladetail->setCaCantidadPaquetesMiles( $this->getRequestParameter ( 'cantidad_paquetes_miles' ) );
		}

		if( $this->getRequestParameter ( 'unidad_medida_paquetes' ) ){
			$faladetail->setCaUnidadMedidaPaquetes( $this->getRequestParameter ( 'unidad_medida_paquetes' ) );
		}

		if( $this->getRequestParameter ( 'cantidad_volumen_miles' ) ){
			$faladetail->setCaCantidadVolumenMiles( $this->getRequestParameter ( 'cantidad_volumen_miles' ) );
		}

		if( $this->getRequestParameter ( 'unidad_medida_volumen' ) ){
			$faladetail->setCaUnidadMedidaVolumen( $this->getRequestParameter ( 'unidad_medida_volumen' ) );
		}

		if( $this->getRequestParameter ( 'cantidad_peso_miles' ) ){
			$faladetail->setCaCantidadPesoMiles( $this->getRequestParameter ( 'cantidad_peso_miles' ) );
		}

		if( $this->getRequestParameter ( 'unidad_medida_peso' ) ){
			$faladetail->setCaUnidadMedidaPeso( $this->getRequestParameter ( 'unidad_medida_peso' ) );
		}

		if( $this->getRequestParameter ( 'num_cont_part1' ) ){
			$faladetail->setCaNumContPart1( $this->getRequestParameter ( 'num_cont_part1' ) );
		}

		if( $this->getRequestParameter ( 'num_cont_part2' ) ){
			$faladetail->setCaNumContPart2( $this->getRequestParameter ( 'num_cont_part2' ) );
		}

		if( $this->getRequestParameter ( 'num_cont_sell' ) ){
			$faladetail->setCaNumContSell( $this->getRequestParameter ( 'num_cont_sell' ) );
		}

		if( $this->getRequestParameter ( 'container_iso' ) ){
			$faladetail->setCaContainerIso( $this->getRequestParameter ( 'container_iso' ) );
		}
                $faladetail->save();

                $this->responseArray["success"]=true;
		$this->setTemplate("responseTemplate");
	}

	/*
	* Actualiza el reporte en el encabezado del documento
	*/
	public function executeBuscarReporte(){
		$fala_header = Doctrine::getTable("FalaHeader")->find ( $this->getRequestParameter ( 'iddoc' ) );
		$this->forward404Unless($fala_header);

		$consecutivo = $this->getRequestParameter("reporte");

		$reporte = ReportePeer::retrieveByConsecutivo( $consecutivo );
		if( $reporte ){
			$fala_header->setCaReporte( $reporte->getCaConsecutivo() );
			$fala_header->save();
			return sfView::SUCCESS;
		}else{
			return sfView::ERROR;
		}

	}

	/*
	* Genera informe de cantidades
	*/
	public function executeInformarOrden(){
                $details = Doctrine::getTable("FalaDetail") // Elimina los registros anteriores
                               ->createQuery("d")
                               ->where("d.ca_iddoc = ?", base64_decode($this->getRequestParameter ( 'iddoc' )) )
                               ->addOrderBy("d.ca_sku")
                               ->execute();
                $this->iddoc = $this->getRequestParameter ( 'iddoc' );
		$salida = '';
                $salida.= "Carpeta"."\t"; // 1
                $salida.= "SKU"."\t"; // 2
                $salida.= "Descripcion"."\t"; // 3
                $salida.= "Cant.Pedida"."\t"; // 4
                $salida.= "Cant.Despachada"."\t"; // 5
                $salida.= "\r\n";
		foreach( $details as $detail ){
			$salida.= substr($detail->getCaIddoc(),0,15)."\t"; // 1
                        $salida.= $detail->getSkuNeto()."\t"; // 2
                        $salida.= $detail->getCaDescripcionItem()."\t"; // 3
			$salida.= number_format($detail->getCaCantidadPedido(), 0, '', '')."\t"; // 4
                        $salida.= number_format($detail->getCaCantidadMiles(), 0, '', '')."\t"; // 5
			$salida.= "\r\n";
		}

        	$this->salida = $salida;
	}

	/*
	* Permite archivar la Orden de Pedido
	*/
	public function executeArchivarOrden(){
		$fala_header = Doctrine::getTable("FalaHeader")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($fala_header);
		$fala_header->setCaFcharchivado(date("d M Y H:i:s"));
		$fala_header->setCaUsuarchivado($this->getUser()->getUserId());
		$fala_header->save();
		$this->redirect("falabella/list");
	}

	/*
	* Permite anular la Orden de Pedido
	*/
	public function executeAnularOrden(){
		$fala_header = Doctrine::getTable("FalaHeader")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($fala_header);
		$fala_header->setCaFchanulado(date("d M Y H:i:s"));
		$fala_header->setCaUsuanulado($this->getUser()->getUserId());
		$fala_header->save();
		$this->redirect("falabella/list");
	}

	/*
	* Permite Duplicar un registro de la Orden de Pedido
	*/
	public function executeDuplicateRecord(){
		$faladetail = FalaDetailPeer::retrieveByPk( base64_decode($this->getRequestParameter ( 'iddoc' )), $this->getRequestParameter ( 'sku' ));
		$this->forward404Unless($faladetail);
		$doc_mem = $this->getRequestParameter ( 'iddoc' );
		$sku_mem = $faladetail->getSkuNeto();

		$c = new Criteria();
		$c->add( FalaDetailPeer::CA_IDDOC, FalaDetailPeer::CA_IDDOC." = '$doc_mem'" , Criteria::CUSTOM );
		$c->addAnd( FalaDetailPeer::CA_SKU, FalaDetailPeer::CA_SKU." LIKE '$sku_mem%'" , Criteria::CUSTOM );
		$sku_num = FalaDetailPeer::doCount($c);

		$sku_mem.= "-".$sku_num;

		$new_faladetail = $faladetail->copy(FALSE);
		$new_faladetail->setCaIddoc($this->getRequestParameter ( 'iddoc' ));
		$new_faladetail->setCaSku($sku_mem);
		$new_faladetail->setCaCantidadPedido(0);
		$new_faladetail->setCaCantidadMiles(0);
		$new_faladetail->save();
		$this->redirect("falabella/details?iddoc=".base64_encode($doc_mem));
		return sfView::NONE;
	}

	/*
	* Generar una Nueva Orden con los productos faltantes
	*/
	public function executeGenerarNuevaOrden(){
		$doc_mem = base64_decode($this->getRequestParameter ( 'iddoc' ));
		$fala_header = Doctrine::getTable("FalaHeader")->find ( $doc_mem );
		$this->forward404Unless($fala_header);

		$c = new Criteria();
		$c->add( FalaHeaderPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC." LIKE '$doc_mem%'" , Criteria::CUSTOM );
		$doc_mem = $fala_header->getIdDocNeto();
		$doc_num = FalaHeaderPeer::doCount($c);
		$doc_mem.= "-".$doc_num;

		$new_falaheader = $fala_header->copy(FALSE);
		$new_falaheader->setCaIddoc($doc_mem);
		$new_falaheader->setCaProcesado(FALSE);
		$new_falaheader->setCaFchanulado(NULL);
		$new_falaheader->setCaUsuanulado(NULL);
		$new_falaheader->save();

		$faladetails = $fala_header->getFalaDetails();
		foreach( $faladetails as $detail ){
			if ($detail->getCaCantidadMiles() < $detail->getCaCantidadPedido()){
				$new_faladetail = $detail->copy(FALSE);
				$new_faladetail->setCaIddoc($doc_mem);
				$new_faladetail->setCaSku($detail->getCaSku());
				$new_faladetail->setCaCantidadPedido($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
				$new_faladetail->setCaCantidadMiles($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
				$new_faladetail->save();
			}
		}
		$falashippings = $fala_header->getFalaShipmentInfos();
		foreach( $falashippings as $shipping ){
			$new_shipping = $shipping->copy(FALSE);
			$new_shipping->setCaIddoc($doc_mem);
			$new_shipping->save();
		}
		$this->redirect("falabella/generarArchivo?iddoc=".$this->getRequestParameter ( 'iddoc' ));
		return sfView::NONE;
	}

	/*
	* Genera el archivo de salida
	*/
	public function executeGenerarArchivo(){
		$fala_header = Doctrine::getTable("FalaHeader")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );

                $details = Doctrine::getTable("FalaDetail") // Elimina los registros anteriores
                               ->createQuery("d")
                               ->where("d.ca_iddoc = ?", base64_decode($this->getRequestParameter ( 'iddoc' )) )
                               ->addOrderBy("d.ca_sku")
                               ->execute();

		$reporte = ReporteTable::retrieveByConsecutivo( $fala_header->getcaReporte() );
		$this->forward404unless( $reporte );

		$status = $reporte->getUltimoStatus();
		$salida = '';
		foreach( $details as $detail ){
			$salida.= substr($fala_header->getCaIddoc(),0,15)."|"; // 1
			$salida.= $fala_header->getCaArchivoOrigen()."|"; // Archivo de Origen 2
			$salida.= "ASN|"; // 3
			$salida.= "COL|"; // 4
			$salida.= "|"; // Correlativo Coltrans 5
			$salida.= (($reporte->getcaTransporte() != 'A�reo')?"MB":"AW")."|"; // 6
			$salida.= $reporte->getDoctransporte()."|"; // 7
			$salida.= "|"; // Contact 8  /blanco
			$salida.= "|"; // Contact Number 9
			$salida.= "|"; // Lloyd  10
			$salida.= (($reporte->getcaTransporte() == "A�reo")?"AIR":$reporte->getIdnave() )."|"; // Vessel 11
			$salida.= $fala_header->getCaNumViaje()."|"; // Número de Viaje 12
			$salida.= "COLT|"; // Carrier 13
			$salida.= (($reporte->getcaTransporte() == "A�reo")?"L":"")."|"; // Vessel 14
			$salida.= (($reporte->getcaTransporte() == "A�reo")?"A":"S")."|"; // Vessel 15
			$salida.= "UN|"; // Vessel 16
			$salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 17
			$salida.= "UN|"; // Vessel 18
			$salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 19
			$salida.= "UN|"; // Vessel 20
			$salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 21
			$salida.= "UN|"; // Vessel 22
			$salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 23

			$ets_mem= (strlen(trim($reporte->getETS()))==0 and $status)?Utils::parseDate($status->getCaFchsalida(),"Ymd"):Utils::parseDate($reporte->getETS(),"Ymd");
			$eta_mem= (strlen(trim($reporte->getETA()))==0 and $status)?Utils::parseDate($status->getCaFchllegada(),"Ymd"):Utils::parseDate($reporte->getETA(),"Ymd");
			$salida.= $ets_mem."|"; // 24
			$salida.= $ets_mem."|"; // 25
			$salida.= $eta_mem."|"; // 26
			$salida.= $eta_mem."|"; // 27

			$salida.= str_replace("-","",$detail->getCaNumContPart1())."|"; // Id Cont 4 Car  28
			$salida.= str_replace("-","",$detail->getCaNumContPart2())."|"; // Id Cont 10 Car  29
			$salida.= $detail->getCaNumContSell()."|"; // Sello de Cont Car  30
			$salida.= $detail->getCaContainerIso()."|"; // Cod ISO 31
			$salida.= (($reporte->getcaTransporte() != "A�reo")?$fala_header->getCaContainerMode():"")."|"; // Container Mode 32
			$salida.= (($reporte->getcaTransporte() == "A�reo")?$reporte->getDoctransporte():"")."|"; // Vessel 33
			$salida.= "|"; // 34
			$salida.= "|"; // 35
			$salida.= "|"; // 36
			$salida.= substr($fala_header->getCaIddoc(),0,15)."|"; // 37
			$salida.= Utils::parseDate($fala_header->getCaFechaCarpeta(),"Ymd")."|"; // 38
			$salida.= $detail->getSkuNeto()."|"; // 39
			$salida.= $detail->getCaVpn()."|"; // 40
			$salida.= number_format($detail->getCaCantidadMiles()*10000, 0, '', '')."|"; // 41
			$salida.= $detail->getCaUnidadMedidadCantidad()."|"; // 42
			$salida.= $detail->getCaDescripcionItem()."|"; // 43
			$salida.= number_format($detail->getCaCantidadPaquetesMiles()*10000, 0, '', '')."|"; // 44
			$salida.= $detail->getCaUnidadMedidaPaquetes()."|"; // 45
			$salida.= number_format($detail->getCaCantidadVolumenMiles()*10000, 0, '', '')."|"; // 46
			$salida.= $detail->getCaUnidadMedidaVolumen()."|"; // 47
			$salida.= number_format($detail->getCaCantidadPesoMiles()*10000, 0, '', '')."|"; // 48
			$salida.= $detail->getCaUnidadMedidaPeso()."|"; // 49
			$salida.= "01-01|"; // Vessel 50
			$salida.= "|"; // 51
			$salida.= "|"; // 52
			$salida.= "|"; // 53
			$salida.= "|"; // 54
			$salida.= "UN|"; // Vessel 55
			$salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 56
			$salida.= "UN|"; // Vessel 57
			$salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 58
			$salida.= $fala_header->getCaNombreProveedor()."|"; // 59
			$salida.= $fala_header->getCaCampo_59()."|";// 60
			$salida.= $fala_header->getCaCodigoProveedor()."|"; // 61
			$salida.= $fala_header->getCaCampo_61()."|";// 62
			$salida.= number_format($fala_header->getCaMontoInvoiceMiles()*10000, 0, '', '')."|";// 63
			$salida.= $fala_header->getCaProformaNumber();// 64
			$salida.= "\r\n";
		}
		$directory=sfConfig::get('app_falabella_output');
		$filename = $directory.DIRECTORY_SEPARATOR.'ASN'.date('ymdHis').'.txt';
		$handle = fopen($filename , 'w');

		if (fwrite($handle, $salida) === FALSE) {
			echo "No se puede escribir al archivo {$filename}";
			exit;
		}else{
			$fala_header->setCaProcesado(true);
			$fala_header->save();
		}
    	$this->redirect("falabella/list");
	}

	/*
	* Genera el archivo de facturacion
	*/
	public function executeGenerarFactura(){
		$fala_header = Doctrine::getTable("FalaHeader")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($fala_header);

		$reporte = ReporteTable::retrieveByConsecutivo( $fala_header->getCaReporte() );
		$this->forward404unless( $reporte );

		// $c = new Criteria();

		if ($reporte->getcaTransporte() == 'Mar�timo'){
                    $query = "select ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls, ic.ca_idreporte, rp.ca_consecutivo, ii.ca_factura, ii.ca_fchfactura, ii.ca_tcambio, ii.ca_idmoneda, ii.ca_valor ";
                    $query.= "  from tb_inoclientes_sea ic ";
                    $query.= "      inner join tb_reportes rp on (ic.ca_idreporte = rp.ca_idreporte) ";
                    $query.= "      inner join tb_inoingresos_sea ii on (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls = ii.ca_hbls) ";
                    $query.= "  where rp.ca_consecutivo = '".$reporte->getCaConsecutivo()."'";
                    $query.= "  order by ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls";

                    // echo "<br />".$query."<br />";
                    $q = Doctrine_Manager::getInstance()->connection();
                    $stmt = $q->execute($query);

		}else if ($reporte->getcaTransporte() == 'A�reo'){
                    $query = "select ic.ca_referencia, ic.ca_idcliente, ic.ca_hawb, ic.ca_idreporte, rp.ca_consecutivo, ii.ca_factura, ii.ca_fchfactura, 'USD' as ca_tcambio, ii.ca_tcalaico as ca_idmoneda, ii.ca_valor ";
                    $query.= "  from tb_inoclientes_air ic ";
                    $query.= "      inner join tb_reportes rp on (ic.ca_idreporte = rp.ca_consecutivo) ";
                    $query.= "      inner join tb_inoingresos_air ii on (ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb = ii.ca_hawb) ";
                    $query.= "  where rp.ca_consecutivo = '".$reporte->getCaConsecutivo()."'";
                    $query.= "  order by ic.ca_referencia, ic.ca_idcliente, ic.ca_hawb";

                    // echo "<br />".$query."<br />";
                    $q = Doctrine_Manager::getInstance()->connection();
                    $stmt = $q->execute($query);
		}

		$salida = '';
		while ( $row = $stmt->fetch() ) {
			$salida.= "88"; // 1
			$salida.= "800024075 "; // 2
			$salida.= "8"; // 3
			$salida.= "900017447 "; // 4
			$salida.= "8"; // 5
			$salida.= str_pad($row["ca_factura"],10, " "); // 6
			$salida.= str_pad(null,10, " "); // 7
			list($anno,$mes,$dia) = sscanf($row["ca_fchfactura"],"%d-%d-%d");
			$emision = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
			$salida.= $emision; // 8
			list($anno,$mes,$dia) = sscanf($row["ca_fchfactura"],"%d-%d-%d");
			$vencimiento = date("Ymd", mktime(0,0,0,$mes+1,$dia,$anno));
			$salida.= $vencimiento; // 9
			$salida.= str_pad("COP",3, " "); // 10  Siempre en Pesos Colombianos
			$salida.= str_pad(1, 10, "0", STR_PAD_LEFT); // 11

			$vlr_afecto = floatval($reporte->getProperty("vlrAfecto"));
                        $vlr_exento = floatval($reporte->getProperty("vlrExento"));
                        $vlr_iva    = floatval($reporte->getProperty("vlrIVA"));
                        $vlr_total  = $vlr_afecto + $vlr_exento + $vlr_iva;

			$salida.= str_pad($vlr_total, 10, "0", STR_PAD_LEFT); // 12
			$salida.= str_pad($vlr_afecto, 10, "0", STR_PAD_LEFT); // 13
			$salida.= str_pad($vlr_iva, 10, "0", STR_PAD_LEFT); // 14

			$salida.= str_pad("21",5, " "); // 15 Concepto
			$salida.= str_pad(substr($fala_header->getCaIddoc(),0,15),20, " "); // 16

			$salida.= str_pad(floatval($reporte->getProperty("numEmbarque")), 2, "0", STR_PAD_LEFT); // 17 Embarque
			$salida.= str_pad(floatval($reporte->getProperty("vlrEmbarque")), 10, "0", STR_PAD_LEFT); // 18 Valor del Embarque

			$spaces = array(8,30,30,4,20,20,10); // Campos del 19 al 27
			foreach( $spaces as $space ){
				$salida.= str_pad(null,$space, " ");
			}

                        $salida.= str_pad($vlr_exento, 10, "0", STR_PAD_LEFT); // 28
                        $salida.= str_pad("650_BOG_DIRECCION_GENERAL", 30, " "); // 29
			$salida.= "\r\n";

			$salida.= "12"; // 1
			$salida.= "800024075"; // 2
			$salida.= "900017447 "; // 3
			$salida.= str_pad($row["ca_factura"],10, " "); // 4
			$salida.= str_pad("003",50, " "); // 5 Concepto de Retenci�n en la Fuente
			$salida.= str_pad($vlr_afecto, 10, "0", STR_PAD_LEFT); // 6
			$salida.= "\r\n";

			$salida.= "13"; // 1
			$salida.= "800024075"; // 2
			$salida.= "900017447 "; // 3
			$salida.= str_pad($row["ca_factura"],10, " "); // 4
			$salida.= str_pad("002",50, " "); // 5 Concepto del IVA
			$salida.= str_pad($vlr_iva, 10, "0", STR_PAD_LEFT); // 6
			$salida.= "\r\n";

			$directory=sfConfig::get('app_falabella_output');
			$filename = $directory.DIRECTORY_SEPARATOR.'FAC_'.$row["ca_factura"].'.txt';
			$handle = fopen($filename , 'w');

			if (fwrite($handle, $salida) === FALSE) {
				echo "No se puede escribir al archivo {filename}";
				exit;
			}
		}

    	$this->redirect("falabella/list");
	}

	public function executeEnviarEmail(){

		// $this->setLayout("ajax");
		$content  = sfContext::getInstance()->getController()->getPresentationFor( 'falabella', 'shippingInstructions', 'email') ;

		$user = $this->getUser();

		//Crea el correo electronico
		$email = new Email();
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Fal Shipping Inst." );
		$email->setCaIdcaso( substr(base64_decode($this->getRequestParameter('iddoc')),-5) );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );

                if( $this->getRequestParameter("readreceipt") ) {
                    $email->setCaReadreceipt( true );
                }else {
                    $email->setCaReadreceipt( false );
                }

		$email->setCaReplyto( $user->getEmail() );

		$recips = explode(",",$this->getRequestParameter("destinatario"));
		if( is_array($recips) ){
			foreach( $recips as $recip ){
				$recip = str_replace(" ", "", $recip );
				if( $recip ){
					$email->addTo( $recip );
				}
			}
		}

		$recips =  explode(",",$this->getRequestParameter("cc")) ;
		if( is_array($recips) ){
			foreach( $recips as $recip ){
				$recip = str_replace(" ", "", $recip );
				if( $recip ){
					$email->addCc( $recip );
				}
			}
		}

		$email->addCc( $this->getUser()->getEmail() );
		$email->setCaSubject( $this->getRequestParameter("asunto") );
		$email->setCaBody( $this->getRequestParameter("mensaje")."<br />".$content );

		$email->save(); //guarda el cuerpo del mensaje
                $email->send(); //env�a el mensaje
                
        $this->redirect("falabella/list");
	}
    
    public function executeIndicadoresGestion(sfWebRequest $request){
        
        $this->opcion=$this->getRequestParameter("opcion");
        $this->idpais_origen=$this->getRequestParameter("idpais_origen");
        $this->pais_origen=$this->getRequestParameter("pais_origen");
        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
        //list($nom_mes, $ano) = explode("-", $this->fechafinal);
        //$this->nom_mes=$nom_mes;
        //$this->ano=$ano;
        //$this->mes = Utils::nmes($nom_mes);
        //$this->mesp = $this->mes;
        if($this->fechainicial){
            list($ano_ini, $mes_ini) = explode("-", $this->fechainicial);
            $this->mesinicial = Utils::mesLargo($mes_ini);
            $this->ano_ini = $ano_ini;
        }
        if($this->fechafinal){
            list($ano_fin, $mes_fin) = explode("-", $this->fechafinal);
            $this->mesfinal = Utils::mesLargo($mes_fin);
        }
        
        $this->indicador = array();
        $this->grid = array();
        $this->entcarga = array();
        
        $this->indi_LCL=array();
        $this->indi_FCL=array();
        
        $this->indi_LCL[$this->pais_origen] = 3;
        $this->indi_FCL[$this->pais_origen] = 3;
        
        if ($this->opcion=='buscar') {
            if($this->transporte=="A�reo"){
                $sql = "SELECT * 
                        FROM vi_repindicadores 
                                LEFT OUTER JOIN (
                                    SELECT rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_fchllegada, CASE WHEN rs.ca_fchllegada-rs.ca_fchsalida <1 THEN '1'  else rs.ca_fchllegada-rs.ca_fchsalida  END AS ca_diferencia, 
                                        rs.ca_peso as ca_peso, rs.ca_volumen as ca_volumen, extract(YEAR from rs.ca_fchsalida) as ca_ano1 ,extract(MONTH from rs.ca_fchsalida) as ca_mes1
                                    FROM tb_repstatus rs 
                                        INNER JOIN tb_reportes rp ON rp.ca_idreporte = rs.ca_idreporte
                                    WHERE rs.ca_idetapa in ('IACAD','IMCPD') 
                                    GROUP BY ca_consecutivo, ca_fchsalida, ca_fchllegada, ca_diferencia,ca_peso,ca_volumen,extract(YEAR from rs.ca_fchsalida) ,extract(MONTH from rs.ca_fchsalida)) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) 
                        WHERE ca_impoexpo = '" . Constantes::IMPO . "' and ca_transporte = '".$this->transporte."' and upper(ca_compania) like upper('%falabella%')  
                              and ca_traorigen= '".$this->pais_origen."' and ca_fchsalida BETWEEN '".$this->fechainicial."' and '".$this->fechafinal."'
                        ORDER BY ca_fchsalida";

                //exit;
                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                //echo $sql;
                $this->resul = $st->fetchAll();
            }elseif($this->transporte=="Mar�timo"){
                $sql = "SELECT DISTINCT v.ca_idreporte, sq.ca_consecutivo_sub, sq.ca_fchsalida, sq.ca_fchllegada, sq.ca_diferencia, sq.ca_peso, sq.ca_ano1, sq.ca_mes1, v.ca_propiedades, v.ca_traorigen, v.ca_ciudestino, v.ca_transporte, v.ca_modalidad, tt.ca_concepto,
                            ((SELECT sum(t.ca_liminferior) AS sum FROM tb_inoequipos_sea eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 AS teus, 
                            (SELECT count(*) AS count FROM tb_inoequipos_sea eq WHERE eq.ca_referencia::text = m.ca_referencia::text AND eq.ca_idconcepto = tt.ca_idconcepto) AS ncontenedores, 
                            (SELECT sum(ca_peso) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS ca_peso, 
                            (SELECT sum(ca_numpiezas) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS piezas, 
                            (SELECT sum(ca_volumen) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS volumen 
                        FROM vi_repindicadores v
                                LEFT OUTER JOIN (
                                    SELECT rp.ca_idreporte, rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_fchllegada, CASE WHEN rs.ca_fchllegada-rs.ca_fchsalida <1 THEN '1'  else rs.ca_fchllegada-rs.ca_fchsalida  END AS ca_diferencia, 
                                        rs.ca_peso as ca_peso,extract(YEAR from rs.ca_fchsalida) as ca_ano1 ,extract(MONTH from rs.ca_fchsalida) as ca_mes1
                                    FROM tb_repstatus rs 
                                        INNER JOIN tb_reportes rp ON rp.ca_idreporte = rs.ca_idreporte
                                    WHERE rs.ca_idetapa in ('IACAD','IMCPD') 
                                    GROUP BY rp.ca_idreporte, ca_consecutivo, ca_fchsalida, ca_fchllegada, ca_diferencia,ca_peso,extract(YEAR from rs.ca_fchsalida) ,extract(MONTH from rs.ca_fchsalida)) sq ON (v.ca_consecutivo = sq.ca_consecutivo_sub) 
                                JOIN tb_inoclientes_sea ics ON ics.ca_idreporte = sq.ca_idreporte
                                JOIN tb_inomaestra_sea m ON m.ca_referencia = ics.ca_referencia
                                JOIN tb_inoequipos_sea e ON e.ca_referencia = ics.ca_referencia
                                JOIN tb_conceptos tt ON e.ca_idconcepto = tt.ca_idconcepto
                        WHERE v.ca_impoexpo = '" . Constantes::IMPO . "' and v.ca_transporte = '".$this->transporte."' and upper(ca_compania) like upper('%falabella%')  
                              and ca_traorigen= '".$this->pais_origen."' and ca_fchsalida BETWEEN '".$this->fechainicial."' and '".$this->fechafinal."'
                        ORDER BY ca_fchsalida";
                //exit;
                //echo $sql;
                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                
                $this->resul = $st->fetchAll();
            }
            
            foreach ($this->resul as $r) {
                /*if (!$r["ca_diferencia"])
                    continue;
                if ($r["ca_modalidad"] == Constantes::FCL) {
                    if ($r["ca_diferencia"] > $this->indi_FCL[$this->pais_origen]) {
                        $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"]++;
                    } else {
                        $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"]++;
                    }
                } else if ($r["ca_modalidad"] == Constantes::LCL) {
                    if ($r["ca_diferencia"] > $this->indi_LCL[$this->pais_origen]) {
                        $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"]++;
                    } else {
                        $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"]++;
                    }
                }*/
                if($r["ca_diferencia"]<1){
                    $r["ca_diferencia"]=1;
                }
                
                $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta"] = (isset($this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta"])) ? ($this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["conta"] + 1) : "1";
                $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diferencia"]+=$r["ca_diferencia"];
                if($this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diferencia"]==0){
                    $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["diferencia"]+=1;
                }
                list($peso, $medida) = explode("|", $r["ca_peso"]);
                $this->grid[$r["ca_ano1"]][(int) ($r["ca_mes1"])]["peso"]+=$peso;
                // []=array("diferencia"=>$r["ca_diferencia"],"peso"=>$r["ca_peso"]);

                
                // P�rametros necesarios para Gr�ficar Tiempo de Entrega de la carga en el Aeropuerto
                
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["idreporte"] = $r["ca_idreporte"];
                
                $idreporte = $r["ca_idreporte"];
                
                $reporte = Doctrine::getTable("Reporte")->find($idreporte);
                                
                $this->parametros = ParametroTable::retrieveByCaso("CU103", null, null, '900017447' );
                $parametros = $this->parametros;
                //echo "<pre>";print_r($this->entcarga);echo "</pre>";
                
                foreach($parametros as $parametro){
                    
                     $valor = explode(":", $parametro->getCaValor());
                     $name = $valor[0];
                     $type = $valor[1];
                     
                     switch($name){
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
                
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["fchdocorig"]=  TimeUtils::dateDiff($fchsalida, $fchdocorig);
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchdocorig"] = (isset($this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchdocorig"]))?($this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchdocorig"] + 1):"1";
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["diff_fchdocorig"]+=$this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["fchdocorig"];
                
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["fchentregamcia"]=  TimeUtils::dateDiff($fchsalida, $fchentregamcia);
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchentregamcia"] = (isset($this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchentregamcia"]))?($this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchentregamcia"] + 1):"1";
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["diff_fchentregamcia"]+=$this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["fchentregamcia"];
                
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["fchingresoasn"]=  TimeUtils::dateDiff($fchsalida, $fchingresoasn);
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchingresoasn"] = (isset($this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchingresoasn"]))?($this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["conta_fchingresoasn"] + 1):"1";
                $this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["diff_fchingresoasn"]+=$this->entcarga[$r["ca_ano1"]][(int)($r["ca_mes1"])]["fchingresoasn"];
                
                      
            }   
        }
        //echo "<pre>";print_r($this->resul);echo "</pre>";
    }
}
?>