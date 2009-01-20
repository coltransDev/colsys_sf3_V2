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
		if( $cliente->getCaIdCliente()!= $this->getUser()->getClienteActivo() ){ // En este caso esta tratando de ver informacion que no es del cliente
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
		$idreporte = $this->getRequestParameter( "idreporte" );
		$this->forward404Unless( $idreporte );
		$this->forward404Unless( $idemail );
		
		$status = RepStatusPeer::retrieveByPk($idreporte, $idemail);
		if( $status ){
			//$this->forward404Unless( $status );
			$reporte = $status->getReporte();
			
			$cliente = $reporte->getCliente();				
			if( $cliente->getCaIdCliente()!= $this->getUser()->getClienteActivo() ){ // En este caso esta tratando de ver informacion que no es del cliente
				$this->forward404();			
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
		
		$idreporte = $request->getParameter("idreporte"); 
		$idemail = $request->getParameter("idemail"); 
		$comentario = $request->getParameter("comentario"); 
		
		//print_r($_POST );
		$reporte = ReportePeer::retrieveByPk( $idreporte );	

		$cliente = $reporte->getCliente();				
		if( $cliente->getCaIdCliente()!= $this->getUser()->getClienteActivo() ){ // En este caso esta tratando de ver informacion que no es del cliente
			$this->forward404();			
		}
		
		$status = RepStatusPeer::retrieveByPk($idreporte, $idemail);

		$user = $this->getUser()->getTrackingUser();
		
		
		$respuesta  = new RepStatusRespuesta();
		$respuesta->setCaIdreporte( $idreporte );
		$respuesta->setCaIdemail( $idemail );
		$respuesta->setCaRespuesta( $comentario );
		$respuesta->setCaFchcreado( time() );
		$respuesta->setCaEmail( $user->getCaEmail() ); 
		$respuesta->save();
		
		
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( "tracking" );
		
		$email->setCaTipo( "Respuesta a Status" ); 	
		
		
		$email->setCaIdcaso( 0 ); //$respuesta->getCaIdrepstatusrespuestas()
		$email->setCaFrom( $user->getCaEmail() );
		$email->setCaFromname( "Respuesta a status desde pagina Web" );
		
		

		$email->setCaReplyto( $user->getCaEmail() );
				
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
					$email->addCc( $recip ); 
				}
			}	   
		}

		
		if ($this->getRequestParameter("copiar_adua")){
			$cordinador = $reporte->getCliente()->getCoordinador(); 	
		 
			if( $cordinador ){			
				$email->addCc( $cordinador->getCaEmail() );				
			}		  		   
		}
					
		$email->setCaSubject( "Respuesta a status desde Tracking" );
		
		$email->setCaAddress("abotero@coltrans.com.co"); //--------
		$email->setCaBody( "Respuesta: <br />".$comentario."<br /><br />Status: <br />".$status->getStatus() );		
		$email->save(); 
		$email->send(); 	
				
		
		$this->idreporte = $idreporte;
		$this->idemail = $idemail;
		
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