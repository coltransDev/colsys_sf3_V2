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
		$email_id = $this->getRequestParameter( "email" );	
		$this->email = EmailPeer::retrieveByPk( $email_id );				
		//$this->forward404Unless( $this->email );
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
		
		$respuesta  = new RepStatusRespuesta();
		$respuesta->setCaIdreporte( $idreporte );
		$respuesta->setCaIdemail( $idemail );
		$respuesta->setCaRespuesta( $comentario );
		$respuesta->setCaFchcreado( time() );
		$respuesta->save();
		//$respuesta->setCaEmail(); ca_idrepstatusrespuestas
		
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
					
		
		$this->parametros = ParametroPeer::retrieveByCaso( "CU059", null , null, $this->idCliente );
		
		$this->filename = $this->getRequestParameter("filename");
		
		$this->setLayout("excel");
	}
	
}


?>