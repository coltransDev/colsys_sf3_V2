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
	* Muestra la informacion de un reporte desde aca se pueden actualizar status y 
	* avisos
	*/		
	public function executeInfoReporte(){
		
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
	public function executeMainPanel(){
			
	}
	
	/*
	* 
	*/
	public function executeQueryPanel(){
			
	}
	
	
	
	
	
	
	 
	
	
}
?>