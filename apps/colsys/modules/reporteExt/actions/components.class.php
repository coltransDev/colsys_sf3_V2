<?php

/**
 * pricing components.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reporteExtComponents extends sfComponents
{ 
 	
	/*
	* Muestra la presentación del reporte maritimo al exterior
	* @author: Andres Botero 
	*/
	public function executeReporteMaritimoExt(){
		$c = new Criteria();
		$c->add( RepTarifaPeer::CA_IDREPORTE, $this->reporte->getCaIdreporte() );	
		$this->tarifas = RepTarifaPeer::doSelect( $c );
		
		$c = new Criteria();
		$c->add( RepGastoPeer::CA_IDREPORTE, $this->reporte->getCaIdreporte() );	
		//$c->add( RepGastoPeer::CA_TIPO, Constantes::RECARGO_EN_ORIGEN);	
		$this->gastos = RepGastoPeer::doSelect( $c );
		
	}			
}
?>