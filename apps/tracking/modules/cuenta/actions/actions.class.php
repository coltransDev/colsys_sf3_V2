<?php

/**
 * cuenta actions.
 *
 * @package    colsys
 * @subpackage cuenta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class cuentaActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
		
	}
	
	public function handleErrorCambiarClave(){
		return sfView::SUCCESS;
	}
	
	/*
	* Muestra un formulario donde el usuario puede cambiar la clave
	*/
	public function executeCambiarClave( $request ){
        if( $this->getUser()->hasCredential("colsys_user") ){
            return sfView::ERROR;
        }

		$this->form = new CambioClaveForm();	
		
		if ($request->isMethod('post')){
			
			$this->form->bind(
				array(
						'clave_ant' => $request->getParameter('clave_ant'),
						'clave1' => $request->getParameter('clave1'),
						'clave2' => $request->getParameter('clave2')
		
					)
				); 
			
			if ($this->form->isValid()){
				$user = $this->getUser()->getTrackingUser();
				$user->setPasswd( $this->getRequestParameter("clave1") );
				$user->save();
				$this->setTemplate("cambiarClaveOk");					
				
			}
		}	
	
	}
}
?>