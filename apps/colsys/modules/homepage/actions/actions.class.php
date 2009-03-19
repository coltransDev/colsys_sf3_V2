<?php

/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class homepageActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
	
		$c = new Criteria();
		$c->add( ColNovedadPeer::CA_FCHARCHIVAR, date("Y-m-d"), Criteria::GREATER_EQUAL );
		
		$c->addDescendingOrderByColumn( ColNovedadPeer::CA_FCHPUBLICACION );
		$c->addDescendingOrderByColumn( ColNovedadPeer::CA_FCHARCHIVAR );
		$this->novedades = ColNovedadPeer::doSelect( $c ); 

		
	}
}
