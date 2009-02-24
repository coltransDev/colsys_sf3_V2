<?php

/**
 * kbase actions.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class kbaseActions extends sfActions
{
	const RUTINA = "0500700000";
	/**
	* Muestra un listado de la base de datos
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$c = new Criteria();
		$c->addAscendingOrderByColumn( HdeskKBaseCategoryPeer::CA_PARENT );
		$c->addAscendingOrderByColumn( HdeskKBaseCategoryPeer::CA_NAME );
		$c->setLimit(1);		
		$this->categorias = HdeskKBaseCategoryPeer::doSelect( $c );
			
	}
	
	/**
	* Muestra el detalle de un item de la base de datos
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerContenido(sfWebRequest $request)
	{
		$this->kbase = HdeskKBasePeer::retrieveByPk( $request->getParameter("id") );
		$this->forward404Unless( $this->kbase );
			
	}
}
?>