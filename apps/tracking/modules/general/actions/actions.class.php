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
}
?>