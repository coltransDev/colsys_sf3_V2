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
		$username = $this->getRequestParameter("username");
		$passwd = $this->getRequestParameter("password");		
		if( $username && $passwd ){
			$auth_user="cn=".$username.",o=coltrans_bog";			
			$ldap_server="10.192.1.15";
			
			if($connect=ldap_connect($ldap_server)){
				
				if(@$bind=ldap_bind($connect, $auth_user, $passwd)){
					$this->getUser()->signIn( $username );						
					$sr = ldap_search($connect,"o=coltrans_bog" , "(&(objectclass=person)(cn=".$username."))" );
 					$info = ldap_get_entries($connect, $sr);
					$person = $info[0];					
					$grupos = array();
					foreach($person['groupmembership'] as $key=>$grupo ){						
						if( $key!=="count"){
							$grupo = str_replace(",o=coltrans_bog", "", $grupo);
							$grupo = str_replace("cn=", "", $grupo);						
							$grupos[]=$grupo;
						}
					}
										
					$this->getUser()->setGrupos( $grupos );
					
					//$this->redirect("users/homepage");
				}else{					
					$this->getRequest()->setError("clave_invalida", "El usuario o la clave es incorrecta");					
				}
				ldap_close($connect);           
			}else{
				echo "sin conexion";
			}
		}
		
		
	}
	
	/*
	* Pagina inicial de la aplicacion
	*
	* @param sfRequest $request A request object
	*/
	public function executeHomepage(){
		
	}
	
	
	/*
	* Menú de la aplicacion
	*
	* @param sfRequest $request A request object
	*/
	public function executeMenu(){
		$this->user  = $this->getUser();
		
		$c = new Criteria();
		$c->addJoin( AccesoGrupoPeer::CA_RUTINA, RutinaPeer::CA_RUTINA );
		$c->add( AccesoGrupoPeer::CA_GRUPO, $this->user->getGrupos(), Criteria::IN );
		$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
		$c->addAscendingOrderByColumn( RutinaPeer::CA_OPCION );
		$this->rutinas = RutinaPeer::doSelect( $c );
		
	}
}
?>