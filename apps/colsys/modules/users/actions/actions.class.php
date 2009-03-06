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
		//echo "login".session_id();
		$response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("login");
		
		if($this->getUser()->isAuthenticated()){
			$this->redirect("homepage/index");
		}
					
		$this->form = new LoginForm();		
		if ($request->isMethod('post')){		
			$this->form->bind(
				array(						
						'username' => $request->getParameter('username'),
						'passwd' => $request->getParameter('passwd')		
					)
				); 
			if( $this->form->isValid() ){	
				//Se valido correctamente			
				$this->redirect("homepage/index");
				//echo "OK";	
			}
		}
								
		//------------
	
		/*
		
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
		*/
		$this->setLayout("login");
	}
	
	/**
	* Muestra un formulario donde un usuario puede iniciar sesion
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogout($request)
	{
		$this->getUser()->signOut();
		$this->redirect("users/login");
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
		
		
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/CheckColumn",'last');
		
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
		
	/*
	* Muestra una lista de usuarios y grupos con un checkbox 
	* para seleccionar los permisos
	*/
	public function executePermisosRutinas(){
		$this->setLayout("ajax");
		
		$this->rutina = RutinaPeer::retrieveByPk($this->getRequestParameter("rutina"));
		$this->forward404Unless( $this->rutina );		
	}
	
	/*
	* Guarda los accesos de un grupo y su nivel de acceso a cada opción
	*/
	public function executeObserveRutinasGrupos(){
		$grupos=$this->getRequestParameter("grupos");
		$this->forward404Unless( $grupos );
		
		$rutina=$this->getRequestParameter("rutina");
		$this->forward404Unless( $rutina );
		
		$c = new Criteria();
		$c->add( AccesoGrupoPeer::CA_RUTINA, $rutina );
		$accesoGrupos = AccesoGrupoPeer::doSelect( $c );
		foreach( $accesoGrupos as $accesoGrupo ){
			$accesoGrupo->delete();
		}
		
		$opciones = explode( "|", $grupos );
		foreach( $opciones as $opcion ){
			$op = explode(",", $opcion );
			$accesoGrupo = new AccesoGrupo();
			$accesoGrupo->setCaRutina($rutina);
			$accesoGrupo->setCaGrupo($op[0]);
			$accesoGrupo->setCaAcceso($op[1]);
			$accesoGrupo->save();			
		}
		
		$this->setLayout("ajax");
		$this->responseArray = array("success"=>true);	
		$this->setTemplate("responseTemplate");				
	}
	
	/*
	* Guarda los accesos de un grupo y su nivel de acceso a cada opción
	*/
	public function executeObserveRutinasUsuarios(){
		$usuarios=$this->getRequestParameter("usuarios");
		$this->forward404Unless( $usuarios );
		
		$rutina=$this->getRequestParameter("rutina");
		$this->forward404Unless( $rutina );
		
		$c = new Criteria();
		$c->add( AccesoUsuarioPeer::CA_RUTINA, $rutina );
		$accesoUsuarios = AccesoUsuarioPeer::doSelect( $c );
		foreach( $accesoUsuarios as $accesoUsuario ){
			$accesoUsuario->delete();
		}
		
		$opciones = explode( "|", $usuarios );
		foreach( $opciones as $opcion ){
			$op = explode(",", $opcion );
			$accesoUsuario = new AccesoUsuario();
			$accesoUsuario->setCaRutina($rutina);
			$accesoUsuario->setCaLogin($op[0]);
			$accesoUsuario->setCaAcceso($op[1]);
			$accesoUsuario->save();			
		}
		
		$this->setLayout("ajax");
		$this->responseArray = array("success"=>true);	
		$this->setTemplate("responseTemplate");				
	}	
		
		
}
?>