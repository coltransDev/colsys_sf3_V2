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
		$this->statusList = $this->reporte->getRepStatuss();
	} 
	
	
	/*
	* Muestra las referencias que el usuario ha buscado
	* @author: Andres Botero
	*/
	public function executeVerArchivosReporte(){				
		$this->files=$this->reporte->getFiles();					
		$this->user = $this->getUser();		
		
	}
	
}
?>