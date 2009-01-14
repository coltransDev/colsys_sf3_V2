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
		$fala_header = FalaHeaderPeer::retrieveByPk ( $this->getRequestParameter ( 'iddoc' ) );
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
		$faladetail = FalaDetailPeer::retrieveByPk( $this->getRequestParameter ( 'iddoc' ), $this->getRequestParameter ( 'sku' ));
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
		
		$salida = '';
		foreach( $details as $detail ){
			$salida.= substr($fala_header->getCaIddoc(),0,15)."|"; // 1
			$salida.= $fala_header->getCaArchivoOrigen()."|"; // Archivo de Origen 2
			$salida.= "ASN|"; // 3
			$salida.= "COL|"; // 4
			$salida.= "|"; // Correlativo Coltrans 5
			$salida.= (($reporte->getCaTransporte() != 'Aéreo')?"MB":"AW")."|"; // 6
			$salida.= $reporte->getDoctransporte()."|"; // 7
			$salida.= "|"; // Contact 8  /blanco
			$salida.= "|"; // Contact Number 9
			$salida.= "|"; // Lloyd  10
			$salida.= (($reporte->getCaTransporte() == "Aéreo")?"AIR":$reporte->getIdnave() )."|"; // Vessel 11
			$salida.= "|"; // Número de Viaje 12
			$salida.= "COLT|"; // Carrier 13
			$salida.= (($reporte->getCaTransporte() == "Aéreo")?"L":"")."|"; // Vessel 14
			$salida.= (($reporte->getCaTransporte() == "Aéreo")?"A":"S")."|"; // Vessel 15
			$salida.= "UN|"; // Vessel 16
			$salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 17 
			$salida.= "UN|"; // Vessel 18
			$salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 19
			$salida.= "UN|"; // Vessel 20
			$salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 21
			$salida.= "UN|"; // Vessel 22
			$salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 23
			$salida.= $reporte->getETS("Ymd")."|"; // 24
			$salida.= $reporte->getETS("Ymd")."|"; // 25
			$salida.= $reporte->getETA("Ymd")."|"; // 26
			$salida.= $reporte->getETA("Ymd")."|"; // 27
			$salida.= str_replace("-","",$detail->getCaNumContPart1())."|"; // Id Cont 4 Car  28
			$salida.= str_replace("-","",$detail->getCaNumContPart2())."|"; // Id Cont 10 Car  29
			$salida.= $detail->getCaNumContSell()."|"; // Sello de Cont Car  30
			$salida.= $detail->getCaContainerIso()."|"; // Cod ISO 31
			$salida.= (($reporte->getCaTransporte() != "Aéreo")?$fala_header->getCaContainerMode():"")."|"; // Container Mode 32
			$salida.= (($reporte->getCaTransporte() == "Aéreo")?"AIR":"")."|"; // Vessel 33
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
			$salida.= $detail->getCaCantidadPaquetesMiles()."|"; // 44
			$salida.= $detail->getCaUnidadMedidaPaquetes()."|"; // 45
			$salida.= $detail->getCaCantidadVolumenMiles()."|"; // 46
			$salida.= $detail->getCaUnidadMedidaVolumen()."|"; // 47
			$salida.= $detail->getCaCantidadPesoMiles()."|"; // 48
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
