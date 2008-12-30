<?php

/**
 * reportes Components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesComponents extends sfComponents
{
    /**
    * Muestra las respuestas de los reportes
    *
    */
	public function executeListaRespuestas()
	{
		$c = new Criteria();	
		$c->add( RepStatusRespuestaPeer::CA_IDEMAIL, $this->idemail );	
		$c->add( RepStatusRespuestaPeer::CA_IDREPORTE, $this->idreporte );	
		$c->addAscendingOrderByColumn( RepStatusRespuestaPeer::CA_FCHCREADO );				
		$this->respuestas = RepStatusRespuestaPeer::doSelect( $c );
	}	
}


?>