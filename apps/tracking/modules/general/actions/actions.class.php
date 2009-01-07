<?php

/**
 * general actions.
 *
 * @package    colsys
 * @subpackage general
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class generalActions extends sfActions
{
 
 	public function executeFileViewer(){
		$idx = $this->getRequestParameter("idx"); 
		$this->name = $this->getUser()->getFile( $idx );		
	}
	
	public function executeAttachmentViewer(){
		$idx = $this->getRequestParameter("idx"); 
		$this->attachment = EmailAttachmentPeer::retrieveByPk( $idx );				
		
	}
	
	/*
	* 
	*/
	
	public function executeListaClientesJSON(){
		$criterio =  $this->getRequestParameter("query");		
		$c = new Criteria();
		$c->addSelectColumn(ClientePeer::CA_IDCLIENTE );
		$c->addSelectColumn(ClientePeer::CA_COMPANIA );		
				
		$c->setDistinct();			
		$c->add( ClientePeer::CA_COMPANIA , "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );	
		
		$c->addAscendingOrderByColumn( ClientePeer::CA_COMPANIA );		
		$c->setLimit(40);
		$stmt = ClientePeer::doSelectStmt( $c );
		
		$clientes = array();
 
   		while ( $row = $stmt->fetch() ) {			
      		$clientes[] = $row;
		}		
		
		$this->responseArray=array( "totalCount"=>count( $clientes ), "clientes"=>$clientes  );
		$this->setLayout("ajax");
		$this->setTemplate("responseTemplate");
	}
}
?>