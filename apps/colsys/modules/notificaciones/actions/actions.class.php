<?php

/**
 * notificaciones actions.
 *
 * @package    colsys
 * @subpackage notificaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class notificacionesActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$c = new Criteria();
		$c->addJoin( NotTareaPeer::CA_IDLISTATAREA, NotListaTareasPeer::CA_IDLISTATAREA );
		$c->add( NotTareaPeer::CA_FCHTERMINADA, null, Criteria::ISNULL );	
		$c->setDistinct();			
		$this->listaTareas = NotListaTareasPeer::doSelect( $c );
	}
}
?>