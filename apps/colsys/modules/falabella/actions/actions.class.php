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
		$c = new Criteria ();
		$c->addDescendingOrderByColumn( FalaHeaderPeer::CA_FECHA_CARPETA );
		$this->fala_headers = FalaHeaderPeer::doSelect ( $c );
	}
	
	/*
	* Permite ver las intrucciones de embarque 
	*/
	public function executeShippingInstructions(){
		$this->header = FalaHeaderPeer::retrieveByPk ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($this->header);
		$this->instructions = $this->header->getFalaInstructions();
		$this->info = $this->header->getFalaShipmentInfo();
	}
	
	
	/*
	* Permite ver los detalles del PO y confirmar los datos para generar el archivo de salida
	*/
	public function executeDetails(){
		
		$this->fala_header = FalaHeaderPeer::retrieveByPk ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($this->fala_header);
		$c = new Criteria();
		$c->addAscendingOrderByColumn( FalaDetailPeer::CA_SKU );
		$this->details = $this->fala_header->getFalaDetails($c);
		$this->container = ParametroPeer::retrieveByCaso("CU057");
	}
	
	/*
	* Guarda los cambios en el encabezado del documento
	*/
	public function executeObserveHeader(){
		$fala_header = FalaHeaderPeer::retrieveByPk ( $this->getRequestParameter ( 'iddoc' ) );
		$this->forward404Unless($fala_header);
	
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

		if( $this->getRequestParameter ( 'monto_invoice' )!==null ){
			$fala_header->setCaMontoInvoiceMiles( $this->getRequestParameter ( 'monto_invoice' ) );
		}

		$fala_header->save();
		return sfView::NONE;		
		
	}
	
	/*
	* Guarda los cambios en el detalle del documento
	*/	
	public function executeObserveDetail(){
		$faladetail = FalaDetailPeer::retrieveByPk( $this->getRequestParameter ( 'iddoc' ), $this->getRequestParameter ( 'sku' ));		
		$this->forward404Unless($faladetail);
		
		if( $this->getRequestParameter ( 'num_unidades' )!==null ){
			$faladetail->setCaCantidadMiles( $this->getRequestParameter ( 'num_unidades' ) );
		}
		
		if( $this->getRequestParameter ( 'uni_unidades' ) ){
			$faladetail->setCaUnidadMedidadCantidad( $this->getRequestParameter ( 'uni_unidades' ) );
		}
		
		if( $this->getRequestParameter ( 'num_paquetes' ) ){
			$faladetail->setCaCantidadPaquetesMiles( $this->getRequestParameter ( 'num_paquetes' ) );
		}
		
		if( $this->getRequestParameter ( 'paq_unidades' ) ){
			$faladetail->setCaUnidadMedidaPaquetes( $this->getRequestParameter ( 'paq_unidades' ) );
		}
		
		if( $this->getRequestParameter ( 'peso' ) ){
			$faladetail->setCaCantidadPesoMiles( $this->getRequestParameter ( 'peso' ) );
		}
		
		if( $this->getRequestParameter ( 'pes_unidades' ) ){
			$faladetail->setCaUnidadMedidaPeso( $this->getRequestParameter ( 'pes_unidades' ) );
		}
		
		if( $this->getRequestParameter ( 'volumen' ) ){
			$faladetail->setCaCantidadVolumenMiles( $this->getRequestParameter ( 'volumen' ) );
		}

		if( $this->getRequestParameter ( 'vol_unidades' ) ){
			$faladetail->setCaUnidadMedidaVolumen( $this->getRequestParameter ( 'vol_unidades' ) );
		}

		if( $this->getRequestParameter ( 'cont_part1' ) ){			
			$faladetail->setCaNumContPart1( $this->getRequestParameter ( 'cont_part1' ) );
		}
		
		if( $this->getRequestParameter ( 'cont_part2' ) ){
			$faladetail->setCaNumContPart2( $this->getRequestParameter ( 'cont_part2' ) );
		}

		if( $this->getRequestParameter ( 'cont_sell' ) ){
			$faladetail->setCaNumContSell( $this->getRequestParameter ( 'cont_sell' ) );
		}

		if( $this->getRequestParameter ( 'container_iso' ) ){
			$faladetail->setCaContainerIso( $this->getRequestParameter ( 'container_iso' ) );
		}
	
		$faladetail->save();
		return sfView::NONE;		
	}
	
	/*
	* Actualiza el reporte en el encabezado del documento
	*/
	public function executeBuscarReporte(){
		$fala_header = FalaHeaderPeer::retrieveByPk ( $this->getRequestParameter ( 'iddoc' ) );
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
	* Permite anular la Orden de Pedido
	*/
	public function executeAnularOrden(){
		$fala_header = FalaHeaderPeer::retrieveByPk ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
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
		$fala_header = FalaHeaderPeer::retrieveByPk ( $doc_mem );
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
		$fala_header = FalaHeaderPeer::retrieveByPk ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($fala_header);
		$c = new Criteria();
		$c->addAscendingOrderByColumn( FalaDetailPeer::CA_SKU );
		$details = $fala_header->getFalaDetails($c);
		
		$reporte = ReportePeer::retrieveByConsecutivo( $fala_header->getcaReporte() );
		$this->forward404unless( $reporte );

		$status = $reporte->getUltimoStatus();
		$salida = '';
		foreach( $details as $detail ){
			$salida.= substr($fala_header->getCaIddoc(),0,15)."|"; // 1
			$salida.= $fala_header->getCaArchivoOrigen()."|"; // Archivo de Origen 2
			$salida.= "ASN|"; // 3
			$salida.= "COL|"; // 4
			$salida.= "|"; // Correlativo Coltrans 5
			$salida.= (($reporte->getcaTransporte() != 'Aéreo')?"MB":"AW")."|"; // 6
			$salida.= $reporte->getDoctransporte()."|"; // 7
			$salida.= "|"; // Contact 8  /blanco
			$salida.= "|"; // Contact Number 9
			$salida.= "|"; // Lloyd  10
			$salida.= (($reporte->getcaTransporte() == "Aéreo")?"AIR":$reporte->getIdnave() )."|"; // Vessel 11
			$salida.= $fala_header->getCaNumViaje()."|"; // NÃºmero de Viaje 12
			$salida.= "COLT|"; // Carrier 13
			$salida.= (($reporte->getcaTransporte() == "Aéreo")?"L":"")."|"; // Vessel 14
			$salida.= (($reporte->getcaTransporte() == "Aéreo")?"A":"S")."|"; // Vessel 15
			$salida.= "UN|"; // Vessel 16
			$salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 17 
			$salida.= "UN|"; // Vessel 18
			$salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 19
			$salida.= "UN|"; // Vessel 20
			$salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 21
			$salida.= "UN|"; // Vessel 22
			$salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 23

			$ets_mem= (strlen(trim($reporte->getETS("Ymd")))==0 and $status)?$status->getCaFchsalida("Ymd"):$reporte->getETS("Ymd");
			$eta_mem= (strlen(trim($reporte->getETA("Ymd")))==0 and $status)?$status->getCaFchllegada("Ymd"):$reporte->getETA("Ymd");
			$salida.= $ets_mem."|"; // 24
			$salida.= $ets_mem."|"; // 25
			$salida.= $eta_mem."|"; // 26
			$salida.= $eta_mem."|"; // 27

			$salida.= str_replace("-","",$detail->getCaNumContPart1())."|"; // Id Cont 4 Car  28
			$salida.= str_replace("-","",$detail->getCaNumContPart2())."|"; // Id Cont 10 Car  29
			$salida.= $detail->getCaNumContSell()."|"; // Sello de Cont Car  30
			$salida.= $detail->getCaContainerIso()."|"; // Cod ISO 31
			$salida.= (($reporte->getcaTransporte() != "Aéreo")?$fala_header->getCaContainerMode():"")."|"; // Container Mode 32
			$salida.= (($reporte->getcaTransporte() == "Aéreo")?"AIR":"")."|"; // Vessel 33
			$salida.= "|"; // 34
			$salida.= "|"; // 35
			$salida.= "|"; // 36
			$salida.= substr($fala_header->getCaIddoc(),0,15)."|"; // 37
			$salida.= $fala_header->getCaFechaCarpeta("Ymd")."|"; // 38
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
			$salida.= $fala_header->getCaCampo59()."|";// 60
			$salida.= $fala_header->getCaCodigoProveedor()."|"; // 61
			$salida.= $fala_header->getCaCampo61()."|";// 62
			$salida.= number_format($fala_header->getCaMontoInvoiceMiles()*10000, 0, '', '')."|";// 63
			$salida.= $fala_header->getCaProformaNumber();// 64
			$salida.= "\r\n";			
		}	
		$directory=sfConfig::get('app_falabella_output');
		$filename = $directory.DIRECTORY_SEPARATOR.'ASN'.date('ymdHis').'.txt';
		$handle = fopen($filename , 'w');	
		
		if (fwrite($handle, $salida) === FALSE) {
			echo "No se puede escribir al archivo {filename}";
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
		
		$fala_header = FalaHeaderPeer::retrieveByPk ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($fala_header);
		
		$reporte = ReportePeer::retrieveByConsecutivo( $fala_header->getcaReporte() );
		$this->forward404unless( $reporte );

		$c = new Criteria();

		if ($reporte->getcaTransporte() == 'Marítimo'){
			$c->addSelectColumn(InoClientesSeaPeer::CA_REFERENCIA );
			$c->addSelectColumn(InoClientesSeaPeer::CA_IDCLIENTE );
			$c->addSelectColumn(InoClientesSeaPeer::CA_HBLS );
			$c->addSelectColumn(InoClientesSeaPeer::CA_IDREPORTE );
			$c->addSelectColumn(ReportePeer::CA_CONSECUTIVO );
			
			$c->addSelectColumn(InoIngresosSeaPeer::CA_FACTURA );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_FCHFACTURA );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_TCAMBIO );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_IDMONEDA );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_VALOR );
			$c->setDistinct();
			
			$c->addJoin( ReportePeer::CA_IDREPORTE, InoClientesSeaPeer::CA_IDREPORTE );
			$c->addJoin( InoClientesSeaPeer::CA_REFERENCIA, InoIngresosSeaPeer::CA_REFERENCIA );
			$c->addJoin( InoClientesSeaPeer::CA_IDCLIENTE, InoIngresosSeaPeer::CA_IDCLIENTE );
			$c->addJoin( InoClientesSeaPeer::CA_HBLS, InoIngresosSeaPeer::CA_HBLS );
			
			$c->add( ReportePeer::CA_CONSECUTIVO, ReportePeer::CA_CONSECUTIVO." = '".$reporte->getcaConsecutivo()."'" , Criteria::CUSTOM );
			$stmt = InoClientesSeaPeer::doSelectStmt( $c );
		}else if ($reporte->getcaTransporte() == 'Aéreo'){
			$c->addSelectColumn(InoClientesAirPeer::CA_REFERENCIA );
			$c->addSelectColumn(InoClientesAirPeer::CA_IDCLIENTE );
			$c->addSelectColumn(InoClientesAirPeer::CA_HAWB );
			$c->addSelectColumn(InoClientesAirPeer::CA_IDREPORTE );
			$c->addSelectColumn(ReportePeer::CA_CONSECUTIVO );
			
			$c->addSelectColumn(InoIngresosAirPeer::CA_FACTURA );
			$c->addSelectColumn(InoIngresosAirPeer::CA_FCHFACTURA );
			$c->addAsColumn("CA_TCAMBIO",InoIngresosAirPeer::CA_TCALAICO);
			$c->addAsColumn("CA_IDMONEDA", "'USD'::TEXT");
			$c->addSelectColumn(InoIngresosAirPeer::CA_VALOR );
			$c->setDistinct();
			
			$c->addJoin( ReportePeer::CA_CONSECUTIVO, InoClientesAirPeer::CA_IDREPORTE );
			$c->addJoin( InoClientesAirPeer::CA_REFERENCIA, InoIngresosAirPeer::CA_REFERENCIA );
			$c->addJoin( InoClientesAirPeer::CA_IDCLIENTE, InoIngresosAirPeer::CA_IDCLIENTE );
			$c->addJoin( InoClientesAirPeer::CA_HAWB, InoIngresosAirPeer::CA_HAWB );
			
			$c->add( ReportePeer::CA_CONSECUTIVO, ReportePeer::CA_CONSECUTIVO." = '".$reporte->getcaConsecutivo()."'" , Criteria::CUSTOM );
			$stmt = InoClientesSeaPeer::doSelectStmt( $c );
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
			$salida.= str_pad("003",50, " "); // 5 Concepto de Retención en la Fuente
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
				
		$this->setLayout("ajax");
		$content  = sfContext::getInstance()->getController()->getPresentationFor( 'falabella', 'shippingInstructions', 'email') ;
		
		$user = $this->getUser();
					
		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Fal Shipping Inst." ); 		
		$email->setCaIdcaso( substr(-20,20,base64_decode($this->getRequestParameter('iddoc'))) );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );
		
		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
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
		$this->error = $email->send();	
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}
		
	
	}
}
?>
