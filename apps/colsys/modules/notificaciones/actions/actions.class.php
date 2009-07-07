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
	
	}
	
	
	/**
	* Redirige al usuario a la url definida en la tarea si la tarea ni se ha cumplido
	*
	* @param sfRequest $request A request object
	*/
	public function executeRealizarTarea(sfWebRequest $request){
		$id = $request->getParameter("id");
		$this->forward404Unless( $id );
		
		$tarea = NotTareaPeer::retrieveByPk( $id );
		$this->forward404Unless( $tarea );
				
		if( !$tarea->getCaFchterminada() ){
			$this->redirect( $tarea->getCaUrl() );
		}						
		$this->tarea = $tarea;			
	}
	
	/*
	* Muestra las tareas pendientes de un usuario 
	*
	* @param sfRequest $request A request object
	*/
	public function executeResumenTareasPendientes(sfWebRequest $request){
		$login = $request->getParameter("login");
		$this->forward404Unless( $login );
		$usuario = UsuarioPeer::retrieveByPk( $login ); 
		$this->forward404Unless( $usuario );
		
		$c = new Criteria();
		$c->addJoin( NotTareaPeer::CA_IDLISTATAREA, NotListaTareasPeer::CA_IDLISTATAREA );
		$c->addJoin( NotTareaPeer::CA_IDTAREA, NotTareaAsignacionPeer::CA_IDTAREA );	
		$c->add( NotTareaPeer::CA_FCHVISIBLE, date("Y-m-d H:i:s"), Criteria::LESS_EQUAL );	
		$c->add( NotTareaPeer::CA_FCHTERMINADA, null, Criteria::ISNULL );
		$c->add( NotTareaAsignacionPeer::CA_LOGIN, $usuario->getCaLogin() );	
		$c->setDistinct();					
		$this->listaTareas = NotListaTareasPeer::doSelect( $c );	
		
		$this->usuario = $usuario;						
	}
	
	
}
?>