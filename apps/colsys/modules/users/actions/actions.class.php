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
	const RUTINA = "1";
	const RUTINA_CONTROL = "72";
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
        //header("Location: /users/login");
        //exit();
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
	* Administración de rutinas
	*/
	public function executeAdminRutinas(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );
			
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		
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
		
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<1 ){
			$this->forward404();
		}
	
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
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<2 ){
			$this->forward404();
		}
		
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
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel==-1 ){
			$this->forward404();
		}
				
		$this->setLayout("ajax");
		
		$this->rutina = RutinaPeer::retrieveByPk($this->getRequestParameter("rutina"));
		$this->forward404Unless( $this->rutina );		
	}
	
	/*
	* Guarda los accesos de un grupo y su nivel de acceso a cada opción
	*/
	public function executeObserveRutinasGrupos(){
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<1 ){
			$this->forward404();
		}
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
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<1 ){
			$this->forward404();
		}
		
		$usuarios=utf8_decode($this->getRequestParameter("usuarios"));
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
	
	
	/*
	* Permite simular ser otro usuario, esto para facilitar la tarea de revisión de comisiones
	* o hacer test de los programas.
	*/
	public function executeTomarControl( $request ){
		
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA_CONTROL );			
		if( $this->nivel<3 ){
			$this->forward404();
		}
		
		$this->form = new CambioUsuarioForm();	
		
		if ($request->isMethod('post')){
			
			$this->form->bind(
				array(
						'username' => $request->getParameter('username')
						
		
					)
				); 
			
			if ($this->form->isValid()){
				
				$username = $request->getParameter('username');				
				$user = Doctrine::getTable("Usuario")->find( $username );
				if( $user->getCaAuthmethod()=="ldap" ){
					$this->getUser()->signInLDAP( $username );				
				}else{
					$this->getUser()->signInAlternative( $username );					
				}
				$this->redirect("homepage/index");
				
			}
		}
	}
	
	
	/*
	* Informa al usuario que no tiene acceso
	*/
	public function executeNoAccess( $request ){
	
	}
    
    
    /*
	* Verifica si el usuario esta logueado.
	*/
	public function executeCheckLogin( $request ){
        if( $this->getUser()->isAuthenticated() ){
           $this->responseArray = array( "success"=>true, "login"=>true );
        }else{
           $this->responseArray = array( "success"=>true, "login"=>false );
        }
        $this->setTemplate("responseTemplate");
	}

    /*
	* Verifica si el usuario esta logueado.
	*/
	public function executeValidateLogin( $request ){
        $this->responseArray = array( "success"=>true, "login"=>false );

        $username = $request->getParameter("username");
        $passwd = $request->getParameter("passwd");

        if( $username && $passwd ){

			$usuario = Doctrine::getTable("Usuario")->find( $username );
			if( $usuario && $usuario->checkPasswd( $passwd ) ){
				if( $usuario->getCaAuthmethod()=="ldap" ){
                    sfContext::getInstance()->getUser()->signInLDAP( $username );
                    $this->responseArray["login"] = true;
				}

				if( $usuario->getCaAuthmethod()=="sha1" ){
                    sfContext::getInstance()->getUser()->signInAlternative( $username );
                    $this->responseArray["login"] = true;
				}
			}
		}

        $this->setTemplate("responseTemplate");
	}


    public function executeLoginWindow(){
        $this->setLayout("none");
        sfConfig::set('sf_web_debug', false) ;			
    }


		
}
?>