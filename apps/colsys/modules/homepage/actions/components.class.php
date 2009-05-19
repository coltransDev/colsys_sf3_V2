<?php

/**
 * homepage components.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class homepageComponents  extends sfComponents
{
	/**
	* Muestra las novedades de colsys
	*	
	*/
	public function executeNovedades()
	{
		$c = new Criteria();
		$c->add( ColNovedadPeer::CA_FCHARCHIVAR, date("Y-m-d"), Criteria::GREATER_EQUAL );
		
		$c->addDescendingOrderByColumn( ColNovedadPeer::CA_FCHPUBLICACION );
		$c->addDescendingOrderByColumn( ColNovedadPeer::CA_FCHARCHIVAR );
		$this->novedades = ColNovedadPeer::doSelect( $c ); 
		
		
	}
}
