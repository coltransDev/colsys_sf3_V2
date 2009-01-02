<?php

/**
 * aduana actions.
 *
 * @package    colsys
 * @subpackage aduana
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class aduanaActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
  	{
    	$c = new Criteria();
		$c->add( AduanaMaestraPeer::CA_IDCLIENTE,  $this->getUser()->getClienteActivo() );
		$c->add( AduanaMaestraPeer::CA_FCHREFERENCIA,  "2008-01-01", Criteria::GREATER_EQUAL);
		
		$c->add( AduanaMaestraPeer::CA_REFERENCIA,  "2%", Criteria::LIKE);
			
		//$c->addDescendingOrderByColumn( InoMaestraSeaPeer::CA_FCHEMBARQUE );
		$c->addDescendingOrderByColumn( AduanaMaestraPeer::CA_REFERENCIA );
		$this->referencias = AduanaMaestraPeer::doSelect($c);
  	}
	
	/*
	* Muestra detalles de la referencia
	*/	
	public function executeVerReferencia(){		
		$referencia =  $this->getRequestParameter("referencia");		
		$this->forward404Unless( $referencia );
		
		$c = new Criteria();
		$c->add( AduanaMaestraPeer::CA_REFERENCIA, $referencia );
		$c->add( AduanaMaestraPeer::CA_IDCLIENTE, $this->getUser()->getClienteActivo() );
		$this->referencia = AduanaMaestraPeer::doSelectOne( $c );	
		
		$c = new Criteria();
		$c->add( AduanaEventoPeer::CA_REFERENCIA, $referencia );
		$c->add( AduanaEventoPeer::CA_REALIZADO, 1 );
		$c->addDescendingOrderByColumn( AduanaEventoPeer::CA_FCHEVENTO );
		$this->eventos = AduanaEventoPeer::doSelect( $c );
		
		$c = new Criteria();
		$c->add( AduanaEventoExtraPeer::CA_REFERENCIA, $referencia );		
		$c->addDescendingOrderByColumn( AduanaEventoExtraPeer::CA_FCHCREADO );
		$this->eventosExtra = AduanaEventoExtraPeer::doSelect( $c );
					
		
	}
}
?>