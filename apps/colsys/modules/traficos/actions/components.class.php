<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage traficos
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class traficosComponents extends sfComponents
{
	/*
	* Muestra la información de un reporte desde aca se pueden actualizar status y 
	* avisos
	*/		
	public function executeInfoReporte(){
		
	}
	
	
	/*
	* Muestra una lista de todos los status, esta se incluye en los status del cliente y en la accion verHistorialStatus
	*/
	public function executeListaStatus( ){			
		if( !isset( $this->linkEmail ) ){
			$this->linkEmail = false;
		}	
		
		$c = new Criteria();
		$c = new Criteria();
		if(  isset($this->endDate)  ){
			$c->add( RepStatusPeer::CA_FCHENVIO , $this->endDate, Criteria::LESS_EQUAL );
		}
		
		$c->addDescendingOrderByColumn( RepStatusPeer::CA_FCHENVIO );
		$this->statusList = $this->reporte->getRepstatuss( $c );	
	}
	
	/*
	* 
	*/
	public function executeTabCloseMenu(){
			
	}
	
	/*
	* 
	*/
	public function executeSessionProvider(){
			
	}
	
	/*
	* 
	*/
	public function executeTrackingViewer(){
		
	}
	
	/*
	* 
	*/
	public function executeFeedWindow(){
		
	}
	
	/*
	* 
	*/
	public function executeStatusGrid(){
		$this->impoexpo = $this->getRequestParameter("impoexpo");
		$this->transporte = $this->getRequestParameter("transporte");		
	}
	
	/*
	* 
	*/
	public function executeStatusList(){
	
	}
	
		
	
	/*
	* 
	*/
	public function executeMainPanel(){
			
	}
	
	/*
	* 
	*/
	public function executeQueryPanel(){
			
	}
	
	/*
	* 
	*/
	public function executePreviewPanel(){
			
	}
	
	
	
	
	
	
	 
	
	
}
?>