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
		$reporte_id = $this->getRequestParameter( "reporte" );
		$this->reporte = ReportePeer::retrieveByPk( $reporte_id );
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
			mkdir($directory, 0777);			
		}		
		$this->files=sfFinder::type('file')->maxDepth(0)->in($directory);								
		$this->user->clearFiles();
						
	}
	
	public function executeVerEmail(){
		$email_id = $this->getRequestParameter( "email" );	
		$this->email = EmailPeer::retrieveByPk( $email_id );
		
		$this->setLayout("popup");
		//$this->forward404Unless( $this->email );
		
		
	}
}


?>