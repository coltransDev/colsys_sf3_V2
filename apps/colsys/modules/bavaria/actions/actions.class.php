<?php

/**
 * falabella actions.
 *
 * @package    colsys
 * @subpackage falabella
 * @author     Your name here
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

		//$c->addJoin( ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO, Criteria::LEFT_JOIN );
		$c->add( TerceroPeer::CA_IDTERCERO, TerceroPeer::CA_IDTERCERO."::text IN (array_to_string(string_to_array(".ReportePeer::CA_IDPROVEEDOR.",'|'),','))" , Criteria::CUSTOM );
				
		//tr1.ca_idtercero::text IN 
		
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
		$tipo_contenedor = array( "10"=>"1", "15"=>"2", "21"=>"3", "11"=>"4", "16"=>"5", "12"=>"6", "18"=>"7" );

		$c = new Criteria();
		
		$c->addJoin( ReportePeer::CA_CONSECUTIVO, BavariaNotifyPeer::CA_CONSECUTIVO, Criteria::LEFT_JOIN );
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO, Criteria::LEFT_JOIN );
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE, Criteria::LEFT_JOIN );
		
		$c->add( ClientePeer::CA_IDGRUPO , $idBavaria );
		$c->add( ReportePeer::CA_CONSECUTIVO, BavariaNotifyPeer::CA_CONSECUTIVO, Criteria::NOT_EQUAL );
		$c->add( ReportePeer::CA_FCHREPORTE, '2009-01-01', Criteria::GREATER_THAN );
		
		$c->addAscendingOrderByColumn( ReportePeer::CA_CONSECUTIVO );

		$reportes = ReportePeer::doSelect($c);
		
		$salida_one = '';
		$salida_two = '';
		$salida_tree= '';
		
		set_time_limit(0);
		foreach( $reportes as $reporte ){
			if( !$reporte->esUltimaVersion() ){
				continue;				
			}	

			if ( $reporte->getCaModalidad() == 'FCL' ){
				$c = new Criteria();
				$c->addJoin( ReportePeer::CA_IDREPORTE, InoClientesSeaPeer::CA_IDREPORTE, Criteria::LEFT_JOIN );
				$c->addJoin( InoClientesSeaPeer::CA_REFERENCIA, InoEquiposSeaPeer::CA_REFERENCIA, Criteria::LEFT_JOIN );
				$c->add( ReportePeer::CA_CONSECUTIVO , $reporte->getCaConsecutivo() );
				$equipos = InoEquiposSeaPeer::doSelect($c);
			} else {
				$equipos = array();
			}
			
			$contacto = $reporte->getContacto ();
			$status = $reporte->getUltimoStatus();
			
			$salida_one.= "1";  // 1
			$salida_one.= "BA00";  // 2
			$salida_one.= str_pad(substr($reporte->getCaOrdenClie(),1,10),10, " "); // 3
			$salida_one.= str_pad($reporte->getProperty("numfactproveedor"),15, " "); // 4
			$salida_one.= str_pad(null,10, " "); // 5
			
			$fchfactProveedor = Utils::transformDate($reporte->getProperty("fchfactproveedor"), $format="Ymd");
			$salida_one.= str_pad($fchfactProveedor,8, " "); // 6

			$fchETS = ($status)?(Utils::transformDate($status->getCaFchsalida(), $format="Ymd")):null;
			$salida_one.= str_pad($fchETS,8, " "); // 7

			$salida_one.= str_pad($reporte->getDoctransporte(),25, " "); // 8
			$fchdoctransporte = Utils::transformDate($reporte->getProperty("fchdoctransporte"), $format="Ymd");
			$salida_one.= str_pad($fchdoctransporte,8, " "); // 9
			$salida_one.= str_pad(null,8, " "); // 10
			$salida_one.= str_pad(null,8, " "); // 11
			$fchrecibocarga = Utils::transformDate($reporte->getProperty("fchrecibocarga"), $format="Ymd");
			$salida_one.= str_pad($fchrecibocarga,8, " "); // 12

			$pesos = ($status)?explode("|",$status->getCaPeso()):null;
			$salida_one.= str_pad($pesos[0],15, " "); // 13
			$salida_one.= str_pad($cod_unipeso[$pesos[1]],15, " "); // 14

			$salida_one.= str_pad(null,15, " "); // 15
			$salida_one.= str_pad($mod_transporte[$reporte->getCaTransporte()], 1, " " ); // 16

			$piezas = ($status)?explode("|",$status->getCaPiezas()):null;
			$salida_one.= str_pad($cod_embalaje[$piezas[1]],15, " "); // 17
			
			$salida_one.= str_pad(null,10, " "); // 18 -> Empresa Transportadora
			$salida_one.= str_pad(null,3, " "); // 19 -> Bandera Empresa Transportadora
			$salida_one.= str_pad($frm_embarque[$reporte->getCaModalidad()], 2, " " ); // 20
			$salida_one.= str_pad("US",2, " "); // 21 -> Clave de Moneda
			
			$salida_one.= str_pad(null,117, " "); // Campos del 22 al 31
			
			$salida_one.= str_pad((($piezas[1]=="Bultos")?$piezas[0]:null),15, " "); // 32
			$salida_one.= str_pad((($piezas[1]=="Pallets")?$piezas[0]:null),13, " "); // 33
			
			$salida_one.= str_pad(null,673, " "); // Campos del 34 al 55
			
			$salida_one.= "\r";

			$salida_two.= "2";  // 1
			$salida_two.= "BA00";  // 2
			$salida_two.= str_pad(substr($reporte->getCaOrdenClie(),1,10),10, " "); // 3
			$salida_two.= str_pad($reporte->getProperty("numfactproveedor"),15, " "); // 4
			$salida_two.= str_pad(null,15, " "); // 5 -> Facturas Adicionales			
			$fchfactProveedor = Utils::transformDate($reporte->getProperty("fchfactproveedor"), $format="Ymd");
			$salida_two.= str_pad($fchfactProveedor,8, " "); // 6
			$salida_two.= str_pad(number_format($reporte->getProperty("vlrfactproveedor")*100, 0, '', ''),13, " "); // 7
			$salida_two.= "\r";
			
			foreach( $equipos as $equipo ){
				$salida_tree.= "3";  // 1
				$salida_tree.= "BA00";  // 2
				$salida_tree.= str_pad(substr($reporte->getCaOrdenClie(),1,10),10, " "); // 3
				$salida_tree.= str_pad($reporte->getProperty("numfactproveedor"),15, " "); // 4
				$salida_tree.= str_pad($equipo->getCaIdequipo(),25, " "); // 5
				$fchLlegada = Utils::transformDate($status->getCaFchllegada(), $format="Ymd");
				$salida_tree.= str_pad($fchLlegada,8, " "); // 6
				$salida_tree.= str_pad(null,42, " "); // Campos del 7 al 10
				$salida_tree.= str_pad($tipo_contenedor[$equipo->getCaIdconcepto()], 1, " " ); // 11
				$salida_tree.= str_pad(null,1, " "); // 12
				$salida_tree.= "\r";
			}
			
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

		$filename = $directory.DIRECTORY_SEPARATOR.'equipos.txt';
		$handle = fopen($filename , 'w');	
		
		if (fwrite($handle, $salida_tree) === FALSE) {
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
		
		$filename3 = $directory.DIRECTORY_SEPARATOR.'equipos.txt';		
		@unlink($filename3);
		
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
		$email->AddAttachment( $filename3 );
		
		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();	
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}
	}
}
?>
