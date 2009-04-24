<?php

/**
 * reportes actions.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesActions extends sfActions
{
  /*
	* Muestra una vista previa del reporte cuando el usuario hace click sobre el embarque
	*/
	public function executeDetalleReporte(){
		
		
		
		$reporte_id = $this->getRequestParameter( "rep" );
		$this->reporte = ReportePeer::retrieveByConsecutivo( $reporte_id );
		$this->forward404Unless( $this->reporte );
		
		
		$this->user = $this->getUser();	
		$cliente = $this->reporte->getCliente();
		
		
		if(!$this->user->getTrackingUser()){
			$this->user->setClienteActivo($cliente->getCaIdcliente());
		}
				
		if( $cliente->getCaIdCliente()!= $this->getUser()->getClienteActivo() && $cliente->getCaIdgrupo()!= $this->getUser()->getClienteActivo()){ // En este caso esta tratando de ver informacion que no es del cliente
			$this->forward404();			
		}	
		
		$this->statusReporte = $this->reporte->getRepStatuss();
		$this->trackingUser = $this->getUser()->getTrackingUser();
		
		/*
		* Muestra los archivos adjuntos al reporte 
		*/
		$directory = $this->reporte->getDirectorio();									
		if( !is_dir($directory) ){			
			@mkdir($directory, 0777);			
		}		
		$this->files=sfFinder::type('file')->maxDepth(0)->in($directory);								
		$this->user->clearFiles();
			
	}
	
	public function executeVerEmail(){
		$idemail = $this->getRequestParameter( "email" );	
		$idstatus = $this->getRequestParameter( "idstatus" );
		
		$this->forward404Unless( $idemail );
		
		if( $idstatus ){
			$status = RepStatusPeer::retrieveByPk($idstatus);
			if( $status ){
				//$this->forward404Unless( $status );
				$reporte = $status->getReporte();
				
				$cliente = $reporte->getCliente();				
				if( $cliente->getCaIdCliente()!= $this->getUser()->getClienteActivo() ){ // En este caso esta tratando de ver informacion que no es del cliente
					$this->forward404();			
				}
			}
		}	
		$this->email = EmailPeer::retrieveByPk( $idemail );				
		$this->forward404Unless( $this->email );
	}
	
	/*
	* Guarda un comentario realizado en un status
	*/
	public function executeGuardarRespuesta( $request ){		
		$this->setLayout("ajax");
		
		$idstatus = $request->getParameter("idstatus"); 
		$comentario = $request->getParameter("comentario"); 
		
		//print_r($_POST );
		$status = RepStatusPeer::retrieveByPk( $idstatus );
		$this->forward404Unless( $status );
		$reporte = $status->getReporte();	

		$cliente = $reporte->getCliente();	
			
		if( $cliente->getCaIdCliente()!= $this->getUser()->getClienteActivo() ){ // En este caso esta tratando de ver informacion que no es del cliente
			$this->forward404();			
		}
					
		$respuesta  = new RepStatusRespuesta();
		$respuesta->setCaIdstatus( $idstatus );
		$respuesta->setCaRespuesta( $comentario );
		$respuesta->setCaFchcreado( time() );
		
		$user = $this->getUser()->getTrackingUser();	
		
		if( $user ){
			$respuesta->setCaEmail( $user->getCaEmail() ); 
		}else{
			$respuesta->setCaLogin( $this->getUser()->getUserId() ); 
		}
		$respuesta->save();
		
		if( $user ){ // FIX-ME Se crea una notificacion
			$email = new Email();
			$email->setCaFchenvio( date("Y-m-d H:i:s") );
			$email->setCaUsuenvio( "Administrador" );
			
			$email->setCaTipo( "Respuesta a Status" ); 	
			
			$email->setCaIdcaso( $respuesta->getCaIdrepstatusrespuestas() ); //
			$email->setCaFrom( "colsys_notificaciones" );
			$email->setCaFromname( "Respuesta a status desde pagina Web" );
				
			/*		
			$recips = explode( ",", $reporte->getCaConfirmarClie() );									
			if( is_array($recips) ){
				foreach( $recips as $recip ){			
					$recip = str_replace(" ", "", $recip );			
					if( $recip && strpos($recip, "coltrans.com.co")!==false){
						$email->addTo( $recip ); 
					}
				}	
			}
						
			if ($this->getRequestParameter("copiar_cont")){
				$recips = explode(",",$reporte->getCaContinuacionConf());			
				foreach( $recips as $recip ){			
					$recip = str_replace(" ", "", $recip );			
					if( $recip && strpos($recip, "coltrans.com.co")!==false ){					
						//$email->addCc( $recip ); 
					}
				}	   
			}
							
			if ($this->getRequestParameter("copiar_adua")){
				$cordinador = $reporte->getCliente()->getCoordinador(); 	
			 
				if( $cordinador ){			
					//$email->addCc( $cordinador->getCaEmail() );				
				}		  		   
			}
						*/
			$email->setCaSubject( "Respuesta a status desde Tracking" );
			
			$email->setCaAddress("abotero@coltrans.com.co"); //--------
			$txt = "Reporte: \n\n".$reporte->getCaConsecutivo()." ".$reporte->getCliente()->getCaCompania()."\n"."Respuesta: \n".$comentario."\n\nStatus: \n".$status->getStatus()."\n\nPara responder haga click en el siguiente vinculo:\n\n";
			
			$link ="https://www.coltrans.com.co/tracking/reportes/detalleReporte/rep/".$reporte->getCaConsecutivo()."/idstatus/".$idstatus;
			
			$linkHtml= "<a href='$link'>$link</a>";
			
			$email->setCaBody( $txt.$link );
			$email->setCaBodyHtml( Utils::replace($txt).$linkHtml );		
			$email->save(); 
			$email->send();
			
			
		}else{ // Se envia un email al usuario
			 $email = new Email();
			$email->setCaFchenvio( date("Y-m-d H:i:s") );
			$email->setCaUsuenvio( "Administrador" );
			
			$email->setCaTipo( "Respuesta a Status" ); 	
			
			$email->setCaIdcaso( $respuesta->getCaIdrepstatusrespuestas() ); //
			$email->setCaFrom( "colsys_notificaciones" );
			$email->setCaFromname( "Respuesta a status desde pagina Web" );
									
			$email->setCaSubject( "Respuesta a status desde Tracking" );
			
			$email->setCaAddress("abotero@coltrans.com.co"); //--------
			$txt = "Reporte: \n\n".$reporte->getCaConsecutivo()." ".$reporte->getCliente()->getCaCompania()."\n"."Respuesta: \n".$comentario."\n\nStatus: \n".$status->getStatus()."\n\nPara responder haga click en el siguiente vinculo:\n\n";
			
			$link ="https://www.coltrans.com.co/tracking/reportes/detalleReporte/rep/".$reporte->getCaConsecutivo()."/idstatus/".$idstatus;
			
			$linkHtml= "<a href='$link'>$link</a>";
			
			$email->setCaBody( $txt.$link );
			$email->setCaBodyHtml( Utils::replace($txt).$linkHtml );		
			$email->save(); 
			$email->send();	
		}		
		
		$this->idreporte = $idreporte;
		$this->idstatus = $idstatus;
		
	}
	
	/*
	* Exporta a Excel el listado
	*/
	public function executeInformeTraficosFormato1(  ){
				
		set_time_limit(0);		
		
		$this->impoexpo = $this->getRequestParameter("impoexpo");
		$this->transporte = $this->getRequestParameter("transporte");
		$this->cliente = ClientePeer::retrieveByPk( $this->getUser()->getClienteActivo() );
				
		$this->forward404Unless( $this->cliente );
		$this->forward404unless( $this->impoexpo );
		
		
		if( $this->impoexpo==Constantes::IMPO ){	
			$this->forward404unless( $this->transporte );
			if( $this->transporte==Constantes::MARITIMO ){				
				$this->reportes = ReportePeer::getReportesActivosImpoMaritimo( $this->getUser()->getClienteActivo() );
			}elseif( $this->transporte==Constantes::AEREO ){
				$this->reportes = ReportePeer::getReportesActivosImpoAereo( $this->getUser()->getClienteActivo() );
			}
		}elseif( $this->impoexpo==Constantes::EXPO ){				
			$this->reportes = ReportePeer::getReportesActivosExpo( $this->getUser()->getClienteActivo() );
		}
					
		
		$this->parametros = ParametroPeer::retrieveByCaso( "CU059", null , null, $this->getUser()->getClienteActivo() );
		
		$this->filename = $this->getRequestParameter("filename");
		
		$this->setLayout("excel");
	}
	
}


?>