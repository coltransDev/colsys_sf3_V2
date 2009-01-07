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
		$c = new Criteria();
		$c->add( ContactoPeer::CA_IDCLIENTE , $this->getUser()->getClienteActivo() );		
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE , ContactoPeer::CA_IDCONTACTO );					
		$c->addDescendingOrderByColumn( ReportePeer::CA_FCHREPORTE );
		$c->add( ReportePeer::CA_TRANSPORTE, "Aéreo" );
		$c->add( ReportePeer::CA_FCHREPORTE,"2008-04-01" , Criteria::GREATER_EQUAL );	
		$c->add( ReportePeer::CA_USUANULADO, null, Criteria::ISNULL );
		
		$pager = new sfPropelPager('Reporte', 20);		
		$pager->setCriteria($c);	
		$pager->setPage($this->getRequestParameter('page', 1));			
		$pager->init();
		
		$this->reportes_pager = $pager;	
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