<?php

/**
 * homepage Components.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class homepageComponents extends sfComponents
{
    /**
    * Muestra la lista de todos los clientes
    *
    */
	public function executeListaClientes()
	{
		$c = new Criteria();
		$c->setLimit(25);
		$c->addAscendingOrderByColumn( ClientePeer::CA_COMPANIA );
		
		if( isset($this->filtro) ){
			$c->add( ClientePeer::CA_COMPANIA, "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower($this->filtro)."%'" , Criteria::CUSTOM );
		}
		$this->clientes = ClientePeer::doSelect( $c );
	}	
}


?>