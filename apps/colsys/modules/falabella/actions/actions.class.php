<?php

/**
 * bavaria actions.
 *
 * @package    colsys
 * @subpackage bavaria
 * @author     Carlos Gilberto López M.
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class bavariaActions extends sfActions {
	
	/*
	* Accion por defecto
	*/
	public function executeIndex() {
		return $this->forward ( 'bavaria', 'list' );
	}
	
	/*
	* Lista los PO disponibles
	*/	
	public function executeList() {
		$c = new Criteria ();

		$c->addSelectColumn( BavariaNotifyPeer::CA_CONSECUTIVO );
		$c->addSelectColumn( ClientePeer::CA_COMPANIA );
		$c->addSelectColumn( ReportePeer::CA_FCHREPORTE );
		$c->addSelectColumn( ReportePeer::CA_MERCANCIA_DESC );
		$c->addSelectColumn( ReportePeer::CA_ORDEN_CLIE );
		$c->addSelectColumn( TerceroPeer::CA_NOMBRE );
		$c->addSelectColumn( BavariaNotifyPeer::CA_FCHENVIO );
		$c->addSelectColumn( BavariaNotifyPeer::CA_USUENVIO );

		$c->addJoin( BavariaNotifyPeer::CA_CONSECUTIVO, ReportePeer::CA_CONSECUTIVO, Criteria::LEFT_JOIN );
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO, Criteria::LEFT_JOIN );
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE, Criteria::LEFT_JOIN );

		$c->addJoin( ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO, Criteria::LEFT_JOIN );

		$c->addDescendingOrderByColumn( BavariaNotifyPeer::CA_CONSECUTIVO );

		$this->bavaria_notifys = BavariaNotifyPeer::doSelect ( $c );
	}
	

	/*
	* Genera el archivo para envio
	*/
	public function executeGenerarArchivo(){
		$idBavaria =  "860005224";
		$cod_empresas = array( "860005224"=>"0001", "890900168"=>"0002", ""=>"", "800172251"=>"0003", "900136638"=>"0004", "830101107"=>"0005", "860528319"=>"0006" );
		$cod_unipeso = array( ""=>"", "Kilos"=>"kg" );
		$mod_transporte = array( "Aéreo"=>"4", "Marítimo"=>"1", "Terrestre"=>"3" );
		$cod_embalaje = array( ""=>"", "Bultos"=>"PK", "Cajas"=>"CS", "Cartones"=>"CT", "Pallets"=>"PC", "Patines"=>"YY", "Piezas"=>"BT", "Rollos"=>"RO", "Sacos"=>"BG", "Tambores"=>"YY" );
		$frm_embarque = array( "FCL"=>"01", "CONSOLIDADO"=>"02", "LCL"=>"03", "COLOADING"=>"03" );

		$c = new Criteria();
		
		$c->addJoin( ReportePeer::CA_CONSECUTIVO, BavariaNotifyPeer::CA_CONSECUTIVO, Criteria::LEFT_JOIN );
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO, Criteria::LEFT_JOIN );
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE, Criteria::LEFT_JOIN );
		
		$c->add( ClientePeer::CA_IDGRUPO , $idBavaria );
		$c->add( ReportePeer::CA_CONSECUTIVO, BavariaNotifyPeer::CA_CONSECUTIVO, Criteria::NOT_EQUAL );
		$c->add( ReportePeer::CA_FCHREPORTE, '2008-10-01', Criteria::GREATER_THAN );

		$c->addAscendingOrderByColumn( ReportePeer::CA_CONSECUTIVO );

		$reportes = ReportePeer::doSelect($c);
		
		$salida_one = '';
		$salida_two = '';
		
		set_time_limit(0);
		foreach( $reportes as $reporte ){
			if( !$reporte->esUltimaVersion() or !$reporte->getCaIncoterms() ){
				continue;				
			}
			$contacto = $reporte->getContacto ();
	
			$salida_one.= str_pad( $cod_empresas[$contacto->getCaIdCliente()], 6, " " ); // 1
			$salida_one.= str_pad(substr($reporte->getCaOrdenClie(),0,10),10, " "); // 2
			$salida_one.= str_pad(substr($reporte->getProperty("numfactproveedor"),0,15),15, " "); // 3
			$salida_one.= str_pad(null,10, " "); // 4
			
			$fchfactProveedor = Utils::transformDate( $reporte->getProperty("fchfactproveedor") , $format="Ymd" );
			$salida_one.= str_pad($fchfactProveedor,8, " "); // 5

			$fchETS = Utils::transformDate( $reporte->getETS(), $format="Ymd" );
			$salida_one.= str_pad($fchETS,8, " "); // 6

			//$salida_one.= str_pad($reporte->getETS("Ymd"),8, " "); // 6
			$salida_one.= str_pad($reporte->getDoctransporte(),25, " "); // 7
			$fchdoctransporte = Utils::transformDate( $reporte->getProperty("fchdoctransporte") , $format="Ymd" );
			$salida_one.= str_pad($fchdoctransporte,8, " "); // 8
			$salida_one.= str_pad(null,8, " "); // 9
			$salida_one.= str_pad(null,8, " "); // 10
			$fchrecibocarga = Utils::transformDate( $reporte->getProperty("fchrecibocarga") , $format="Ymd" );
			$salida_one.= str_pad($fchrecibocarga,8, " "); // 11

			list($peso_vlr, $peso_uni) = sscanf($reporte->getPeso(), "%s %s");
			$salida_one.= str_pad($peso_vlr,15, " "); // 12
			$salida_one.= str_pad($cod_unipeso[$peso_uni],15, " "); // 13

			$salida_one.= str_pad(null,15, " "); // 14
			$salida_one.= str_pad( $mod_transporte[$reporte->getCaTransporte()], 1, " " ); // 15
			
			$salida_one.= str_pad(null,15, " "); // 16
			
			list($pieza_vlr, $pieza_uni) = sscanf($reporte->getPiezas(), "%s %s");
			$salida_one.= str_pad($cod_embalaje[$pieza_uni],15, " "); // 17
			$salida_one.= str_pad(null,10, " "); // 18 -> Empresa Transportadora
			$salida_one.= str_pad(null,3, " "); // 19 -> Bandera Empresa Transportadora
			$salida_one.= str_pad(null,2, " "); // 20
			$salida_one.= str_pad( $frm_embarque[$reporte->getCaModalidad()], 2, " " ); // 21
			$salida_one.= str_pad("US",2, " "); // 22 -> Clave de Moneda
			
			$salida_one.= str_pad(null,117, " "); // Campos del 23 al 32
			
			$salida_one.= str_pad((($pieza_uni=="Bultos")?$pieza_vlr:null),15, " "); // 33
			$salida_one.= str_pad((($pieza_uni=="Pallets")?$pieza_vlr:null),13, " "); // 34
			
			$salida_one.= str_pad(null,673, " "); // Campos del 35 al 56
			
			$salida_one.= "\r\n";

			$salida_two.= str_pad( $cod_empresas[$contacto->getCaIdCliente()], 6, " " ); // 1
			$salida_two.= str_pad(substr($reporte->getCaOrdenClie(),0,10),10, " "); // 2
			$salida_two.= str_pad(substr($reporte->getProperty("numfactproveedor"),0,15),15, " "); // 3
			$salida_two.= str_pad(null,15, " "); // 4 -> Facturas Adicionales			
			$fchfactProveedor = Utils::transformDate( $reporte->getProperty("fchfactproveedor") , $format="Ymd" );
			$salida_two.= str_pad($fchfactProveedor,8, " "); // 5
			$salida_two.= str_pad($reporte->getProperty("vlrfactproveedor"),13, " "); // 6
			$salida_two.= "\r\n";
			
		}	
		$directory= sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR;
		$filename = $directory.DIRECTORY_SEPARATOR.'notificacion.txt';
		$handle = fopen($filename , 'w');	
		
		if (fwrite($handle, $salida_one) === FALSE) {
			echo "No se puede escribir al archivo {filename}";
			exit;
		}else{
			/*$fala_header->setCaProcesado(true);
			$fala_header->save();*/
		}

		$filename = $directory.DIRECTORY_SEPARATOR.'facturacion.txt';
		$handle = fopen($filename , 'w');	
		
		if (fwrite($handle, $salida_two) === FALSE) {
			echo "No se puede escribir al archivo {filename}";
			exit;
		}else{
			/*$fala_header->setCaProcesado(true);
			$fala_header->save();*/
		}
		return sfView::NONE;
		
	}
	
	/*
	 * Func...
	*/
	public function executeNuevoMensaje(){
	}
	
	
	public function executeEnviarEmail(){
				
		$this->setLayout("ajax");
		
		$directory= sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR;
		$filename1 = $directory.DIRECTORY_SEPARATOR.'notificacion.txt';
		@unlink($filename1);
		
		$filename2 = $directory.DIRECTORY_SEPARATOR.'facturacion.txt';		
		@unlink($filename2);
		
		$this->executeGenerarArchivo();
		
		
		$user = $this->getUser();
					
		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Fal Shipping Inst." ); 		
		$email->setCaIdcaso( '1' );
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
		$email->setCaBody( $this->getRequestParameter("mensaje") );	
		
		//**
		$email->AddAttachment( $filename1 );
		$email->AddAttachment( $filename2 );
		
		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();	
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}
	}
}
?>
