<?php

/**
 * aereo actions.
 *
 * @package    colsys
 * @subpackage aereo
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class aereoActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{					
		
	}
	
	/*
	* Muestra detalles de la referencia
	*/	
	public function executeVerReferencia(){		
		$referencia =  $this->getRequestParameter("referencia");		
		$this->forward404Unless( $referencia );
		
		$c = new Criteria();
		$c->add( InoClientesAirPeer::CA_REFERENCIA, $referencia );
		$c->add( InoClientesAirPeer::CA_IDCLIENTE, $this->getUser()->getClienteActivo() );
		$this->referenciasCliente = InoClientesAirPeer::doSelect( $c );		
		
		$this->user = $this->getUser();
	}
	
}

?>