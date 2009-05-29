<?php

/**
 * homepage components.
 *
 * @package    colsys
 * @subpackage notificaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class notificacionesComponents  extends sfComponents
{
	/**
	* Muestra las novedades de colsys
	*	
	*/
	public function executeTareasPendientes()
	{
		$c = new Criteria();
		$c->addJoin( NotTareaPeer::CA_IDLISTATAREA, NotListaTareasPeer::CA_IDLISTATAREA );
		$c->addJoin( NotTareaPeer::CA_IDTAREA, NotTareaAsignacionPeer::CA_IDTAREA );		
		$c->add( NotTareaPeer::CA_FCHTERMINADA, null, Criteria::ISNULL );
		$c->add( NotTareaAsignacionPeer::CA_LOGIN, $this->getUser()->getUserId() );	
		$c->setDistinct();					
		$this->listaTareas = NotListaTareasPeer::doSelect( $c );	
		
		
		
		$this->user = $this->getUser()->getUserId();		
				
		
	}
}
?>