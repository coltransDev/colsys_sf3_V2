<?php

/**
 * adminUsers actions.
 *
 * @package    colsys
 * @subpackage adminUsers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminPerfilesActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$c = new Criteria();
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_NOMBRE );
		$this->usuarios = UsuarioPeer::doSelect( $c );
	}
	
	/*
	*
	*/
	public function executeFormUsuario( $request ){
		$this->usuario = UsuarioPeer::retrieveByPk( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );
	 
	}
	
	/*
	*
	*/
	public function executeGuardarUsuario( $request ){
		$this->usuario = UsuarioPeer::retrieveByPk( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );
		
		if( $request->getParameter("auth_method") ){
			$this->usuario->setCaAuthMethod( $request->getParameter("auth_method") );
		}
		
		if( $request->getParameter("passwd1") && $request->getParameter("passwd1")==$request->getParameter("passwd2") ){
			$this->usuario->setPasswd( $request->getParameter("passwd1") );
		}
		
		
		if( $request->getParameter("forcechange") ){
			$this->usuario->setCaForcechange( true );
		}else{
			$this->usuario->setCaForcechange( false );
		}
		
		$this->usuario->save();		
	 
	}
	
	/*
	* Permite cambiar el password de un usuario que se autentica por BD
	*/
	public function executeChangePasswd( $request ){
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
				$user = $this->getUser()->getUserId();
				$user = UsuarioPeer::retrieveByPk( $this->getUser()->getUserId() );
				$user->setPasswd( $this->getRequestParameter("clave1") );
				$user->setCaForcechange( false );
				$user->save();
				
				$this->getUser()->setAttribute('forcechange', false);
								
				$this->setTemplate("changePasswdOk");					
				
			}
		}	
	}	
	
}
?>