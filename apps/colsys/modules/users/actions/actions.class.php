<?php
 
/**
 * users actions.
 *
 * @package    colsys
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class usersActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex($request)
	{
		$this->forward('users', 'login');
	}
  
	/**
	* Muestra un formulario donde un usuario puede iniciar sesion
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogin($request)
	{
		$ldap_server = "10.192.1.5";
		$username = $request->getParameter("user");
		$passwd = $request->getParameter("passwd");;
		$auth_user = "cn={$username},o=coltrans_bog";		
		
		if ($connect = ldap_connect ( $ldap_server )) {			
			if (@$bind = ldap_bind ( $connect, $auth_user, $passwd )) {				
				ldap_close ( $connect );
				$user = $this->getUser();
				$user->setAuthenticated( true );
				$user->setUserId( $username );				
				$this->redirect("users/homepage");				
			} else{
				$request->setError("user", "No se ha podido iniciar sesion");
			}
		} //if connected to ldap
	}
	
	/*
	* Pagina inicial de la aplicacion
	*
	* @param sfRequest $request A request object
	*/
	public function executeHomepage(){
		
	}
}
?>