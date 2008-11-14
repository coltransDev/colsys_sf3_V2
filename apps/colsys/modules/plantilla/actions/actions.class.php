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
			$ldap_server=sfConfig::get("app_ldap_host");
			
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
					
					$this->redirect("users/frame");
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
	* Frameset de la aplicacion
	*
	* @param sfRequest $request A request object
	*/
	public function executeFrame(){		
		$this->setLayout("none");
		
	}
	
	/*
	* Pagina inicial de la aplicacion
	*
	* @param sfRequest $request A request object
	*/
	public function executeHomepage(){
		
	}
	
	/*
	* Titulo de la aplicacion
	*
	* @param sfRequest $request A request object
	*/
	public function executeTitulo(){
		$response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("top");
		$this->setLayout("minimal");
	}
	
	
	/*
	* Menú de la aplicacion
	*
	* @param sfRequest $request A request object
	*/
	public function executeMenu(){
		
		$this->user  = $this->getUser();
				
		$c = new Criteria();		
		$c->addJoin( RutinaPeer::CA_RUTINA, AccesoGrupoPeer::CA_RUTINA , Criteria::LEFT_JOIN );
		$c->addJoin( RutinaPeer::CA_RUTINA, AccesoUsuarioPeer::CA_RUTINA,  Criteria::LEFT_JOIN );
		
		$criterion = $c->getNewCriterion( AccesoGrupoPeer::CA_GRUPO, $this->user->getGrupos(), Criteria::IN );								
		$criterion->addOr($c->getNewCriterion( AccesoUsuarioPeer::CA_LOGIN, $this->user->getUserId() ));	
		$c->add($criterion);			
		$c->setDistinct();
				
		$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
		$c->addAscendingOrderByColumn( RutinaPeer::CA_OPCION );
		$this->rutinas = RutinaPeer::doSelect( $c );
		
		$this->setLayout("minimal");		
	}
	
	/*
	* Administración de rutinas
	*/
	public function executeAdminRutinas(){
		
		$this->data = array();
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
		$c->addAscendingOrderByColumn( RutinaPeer::CA_OPCION );
		$rutinas = RutinaPeer::doSelect( $c );
		foreach(  $rutinas as $rutina ){
			
			$row = array(			 
				'rutina'=>"".$rutina->getCaRutina(),
				'grupo'=>utf8_encode($rutina->getCaGrupo()),
				'opcion'=>utf8_encode($rutina->getCaOpcion()),
				'programa'=>utf8_encode($rutina->getCaPrograma()),
				'descripcion'=>utf8_encode($rutina->getCaDescripcion())
			);
			
			$this->data[] = $row;
		}		
	}
	
	/*
	* guarda los cambios en las rutinas 
	*/
	public function executeObserveAdminRutinas(){
		$rutina = $this->getRequestParameter( 'rutina' );
		$grupo = $this->getRequestParameter( 'grupo' );
		$opcion = $this->getRequestParameter( 'opcion' );
		$programa = $this->getRequestParameter( 'programa' );
		$descripcion = $this->getRequestParameter( 'descripcion' );
		$id = $this->getRequestParameter( 'id' );
		
		$rutinaObj = RutinaPeer::retrieveByPk( $rutina );
		
		if( !$rutinaObj ){
			$rutinaObj = new Rutina();	
			$rutinaObj->setCaRutina( RutinaPeer::getConsecutivo() );
		}	
		
		if( $grupo ){
			$rutinaObj->setCaGrupo( $grupo );
		}
		
		if( $opcion ){
			$rutinaObj->setCaOpcion( $opcion );
		}
		
		if( $programa ){
			$rutinaObj->setCaPrograma( $programa );
		}
		
		if( $descripcion ){
			$rutinaObj->setCaDescripcion( $descripcion );
		}
		$rutinaObj->save();
		$this->responseArray = array("id"=>$id, "rutina"=>$rutinaObj->getCaRutina());
		
	}
	
	public function executeEliminarAdminRutina(){
		$rutina = $this->getRequestParameter( 'rutina' );	
		$rutinaObj = RutinaPeer::retrieveByPk( $rutina );
		if( $rutinaObj ){
			$rutinaObj->delete(); 
		}
		return sfView::NONE;
	}
	
	/******************************************************************
	* Administración de usuarios y grupos
	*
	*******************************************************************/
	
	public function executeAdminGrupos(){
		$username = sfConfig::get("app_ldap_user");;
		$passwd = sfConfig::get("app_ldap_passwd");;		
		if( $username && $passwd ){
			$auth_user="cn=".$username.",o=coltrans_bog";			
			$ldap_server=sfConfig::get("app_ldap_host");
			
			if($connect=ldap_connect($ldap_server)){
				
				if(@$bind=ldap_bind($connect, $auth_user, $passwd)){
									
					$sr = ldap_search($connect,"o=coltrans_bog" , "(&(objectclass=group)(!(equivalentToMe=cn=admin,o=coltrans_bog)))" );
 					$this->grupos = ldap_get_entries($connect, $sr);
										
					
				}else{					
				 	echo "No se puede conectar al servidor";					
				}
				ldap_close($connect);           
			}else{
				echo "sin conexion";
			}
		}
	}
	
}
?>