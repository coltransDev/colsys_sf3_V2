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
	public function executeCambiarClave(){
		$user = $this->getUser()->getTrackingUser();
		if( $user ){
			$passwd = sha1($user->getCaActivationCode().$this->getRequestParameter("clave_ant"));	
			if( $passwd == $user->getCaPasswd() ){	
				$user->setPasswd( $this->getRequestParameter("clave") );
				$user->save();
				$this->setTemplate("cambiarClaveOk");
			}else{
				$this->getRequest()->setError("clave_ant", "No se ha podido comprobar la clave");
				return sfView::SUCCESS;
			}
		}else{
			$this->getRequest()->setError("clave_ant", "La clave de Novell se debe cambiar en el Dpto de sistemas");
			return sfView::SUCCESS;
		}
	}
}
?>