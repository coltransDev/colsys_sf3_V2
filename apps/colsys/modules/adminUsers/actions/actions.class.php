<?php

/**
 * adminUsers actions.
 *
 * @package    colsys
 * @subpackage adminUsers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminUsersActions extends sfActions
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
		
		$this->usuario->save();
		
		
		
		
	 
	}
	
	
}
?>