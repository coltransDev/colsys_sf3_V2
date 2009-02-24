<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage helpdesk
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class helpdeskComponents extends sfComponents
{
	/*
	* Muestra las referencias que el usuario ha buscado
	* @author: Andres Botero
	*/
	public function executeListaRespuestasTicket(){				
		$c = new Criteria(); 
		$c->add( HdeskResponsePeer::CA_IDTICKET, $this->idticket );		
		$c->addAscendingOrderByColumn( HdeskResponsePeer::CA_CREATEDAT );
		$c->addAscendingOrderByColumn( HdeskResponsePeer::CA_IDRESPONSE );
		$this->responses = HdeskResponsePeer::doSelect( $c );		
			
	}
	
	
	
}
?>