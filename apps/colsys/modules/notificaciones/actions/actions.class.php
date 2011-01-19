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
		
		$tarea = Doctrine::getTable("NotTarea")->find( $id );
		$this->forward404Unless( $tarea );
				
		if( !$tarea->getCaFchterminada() ){
			$this->redirect( $tarea->getCaUrl() );
		}						
		$this->tarea = $tarea;			
	}
    
    
    public function executeCalendario(sfWebRequest $request){
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("calendar/calendar-all.js", 'last');
        $response->addStylesheet("calendar/css/calendar.css", 'last');
    }


    public function executeDatosCalendario(sfWebRequest $request){
        
      
    }


	
	
	
	
}
?>