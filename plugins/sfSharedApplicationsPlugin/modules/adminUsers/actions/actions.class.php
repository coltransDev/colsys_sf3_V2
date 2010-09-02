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

    const RUTINA_COLSYS = 73;
    const RUTINA_INTRANET = 98;

    public function getNivel() {

        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
        return 5;
        switch( $app ){
            case "colsys":
                $rutina = adminUsersActions::RUTINA_COLSYS;
                break;
            case "intranet":
                $rutina = adminUsersActions::RUTINA_INTRANET;
                break;
        }

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        if (!$this->nivel) {
            $this->nivel = 0;
        }

        $this->forward404Unless($this->nivel != -1);

        return $this->nivel;
    }
    
    public function executeDirectory(sfWebRequest $request) {
        $this->setLayout("layout2col");

    }

    public function executeDoSearch(sfWebRequest $request) {
        
        $criterio = '%'.strtolower($request->getParameter('criterio')).'%';
        $opcion = $request->getParameter("opcion");
        $sangre = $request->getParameter("type");

        $q=Doctrine::getTable('Usuario')
                    ->createQuery('u')
                    ->addWhere('u.ca_activo = ?', true);

        $this->opcion = $opcion;
        switch($opcion){
            case "login":
                $q->addWhere('LOWER(u.ca_login) LIKE ?', $criterio);
            case "nombre":
                $q->addWhere('(LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_nombres) LIKE ? OR LOWER(u.ca_apellidos) LIKE ? )', array($criterio,$criterio,$criterio));
                break;
            case "apellido":
                $q->addWhere('(LOWER(u.ca_apellidos) LIKE ?)', $criterio);
                break;

            case "correo":
                $q->addWhere('LOWER(u.ca_email) LIKE ?', $criterio);
                break;
            case "tiposangre":
                $q->addWhere('LOWER(u.ca_tiposangre) LIKE ?', $criterio);

                break;
        }
        $q->distinct();
        $this->usuarios = $q->execute();

     }

     public function executeFormUsuario( $request ){

        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
        //return 5;
        switch( $app ){
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }
		 
        $this->nivel = $this->getNivel();

        if( !($this->nivel==0 and $request->getParameter("login")==$this->getUser()->getUserId())){
            if(!($this->nivel>1)){
                   $this->forward("users", "noAccess");
            }
        }

		$this->usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
		if( !$this->usuario ){
			$this->usuario = new Usuario();
		}

	 	$this->departamentos = Doctrine::getTable("Departamento")
                          ->createQuery("d")
                          ->addOrderBy("d.ca_nombre")
                          ->execute();

        $this->sucursales = Doctrine::getTable("Sucursal")
                          ->createQuery("s")
                          ->addOrderBy("s.ca_nombre")
                          ->execute();

		$q = Doctrine_Manager::getInstance()->connection();
			$query = "SELECT DISTINCT ca_empresa";
			$query.= "	from control.tb_usuarios";
            $query.= "  order by ca_empresa ASC";

        $this->empresas = $q->execute($query);

        $p = Doctrine_Manager::getInstance()->connection();
			$query = "SELECT DISTINCT ca_tiposangre";
			$query.= "	from control.tb_usuarios";
            $query.= "  order by ca_tiposangre ASC";

        $this->tiposangre = $p->execute($query);

        $r = Doctrine_Manager::getInstance()->connection();
			$query = "SELECT DISTINCT ca_parentesco";
			$query.= "	from control.tb_usuarios";
            $query.= "  order by ca_parentesco ASC";

        $this->parentescos = $r->execute($query);

		$this->manager=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        //$this->manager = $this->manager->getManager();


        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("tabpane/tabpane",'last');
        $response->addStylesheet("tabpane/luna/tab",'last');
	}

	public function executeIndex(sfWebRequest $request)	{
        $app =  sfContext::getInstance()->getConfiguration()->getApplication();

        switch( $app ){
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }
        
        $this->usuarios = Doctrine::getTable("Usuario")
                          ->createQuery("u")
                          ->addOrderBy("u.ca_activo DESC")
                          ->addOrderBy("u.ca_login")
                          ->execute();
	}

    public function executeGuardarUsuario( $request ){
		$usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
        $this->nivel = $this->getNivel();

        if( !($this->nivel==0 and $request->getParameter("login")==$this->getUser()->getUserId())){
           if(!($this->nivel>1)){
               $this->forward("users", "noAccess");
            }
        }
		if( !$usuario ){
			$usuario = new Usuario();
			$usuario->setCaLogin( $request->getParameter("login") );
		}

		if( $request->getParameter("nombre") ){
			$usuario->setCaNombre( $request->getParameter("nombre") );
		}

		if( $request->getParameter("extension") ){
			$usuario->setCaExtension( $request->getParameter("extension") );
		}

		if( $request->getParameter("email") ){
			$usuario->setCaEmail( $request->getParameter("email") );
		}

		if( $request->getParameter("cargo") ){
			$usuario->setCaCargo( $request->getParameter("cargo") );
		}

		if( $request->getParameter("departamento") ){
			$usuario->setCaDepartamento( $request->getParameter("departamento") );
		}

		if( $request->getParameter("idsucursal") ){
			$usuario->setCaIdsucursal( $request->getParameter("idsucursal") );

			/*
			* FIX-ME: Se deben arreglar las opciones del prrograma donde se use el nombre de la sucursal*/

			$sucursal = Doctrine::getTable("Sucursal")->find( $request->getParameter("idsucursal") );
			$usuario->setCaSucursal( $sucursal->getCaNombre() );

		}

		if( $request->getParameter("auth_method") ){
			$usuario->setCaAuthmethod( $request->getParameter("auth_method") );
		}

		if( $request->getParameter("passwd1") && $request->getParameter("passwd1")==$request->getParameter("passwd2") ){
			$usuario->setPasswd( $request->getParameter("passwd1") );
		}


		if( $request->getParameter("forcechange") ){
			$usuario->setCaForcechange( true );
		}else{
			$usuario->setCaForcechange( false );
		}


		if( $request->getParameter("activo") ){
			$usuario->setCaActivo( true );
		}else{
			$usuario->setCaActivo( false );
		}


        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
            $directory=$usuario->getDirectorio().DIRECTORY_SEPARATOR;

            if(!is_dir($directory)){
               @mkdir($directory, 0777, true);
            }
            $nombre_archivo=$directory.'foto.jpg';
            if (move_uploaded_file($_FILES['foto']['tmp_name'],$nombre_archivo)){

                // Obtener nuevos tamaños
                list($ancho, $alto) = getimagesize($nombre_archivo);
                $nuevo_ancho = 120;
                $nuevo_alto = 150;

                // Cargar
                $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                $origen = imagecreatefromjpeg($nombre_archivo);

                // Cambiar el tamaño
                imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                // Imprimir
                imagejpeg($thumb,$usuario->getDirectorio().DIRECTORY_SEPARATOR.'foto120x150.jpg',100);

                $nuevo_ancho = 60;
                $nuevo_alto = 80;

                // Cargar
                $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                $origen = imagecreatefromjpeg($nombre_archivo);

                // Cambiar el tamaño
                imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                // Imprimir
                imagejpeg($thumb,$usuario->getDirectorio().DIRECTORY_SEPARATOR.'foto60x80.jpg',100);
            }
        }
        if( $request->getParameter("cumpleanos") ){
			$usuario->setCaCumpleanos( $request->getParameter("cumpleanos") );
		}

        if( $request->getParameter("empresa") ){
			$usuario->setCaEmpresa( $request->getParameter("empresa") );
		}

		if( $request->getParameter("fchingreso") ){
			$usuario->setCaFchingreso( $request->getParameter("fchingreso") );
		}

		if( $request->getParameter("nombres") ){
			$usuario->setCaNombres( $request->getParameter("nombres") );
		}

		if( $request->getParameter("apellidos") ){
			$usuario->setCaApellidos( $request->getParameter("apellidos") );
		}

		if( $request->getParameter("teloficina") ){
			$usuario->setCaTeloficina( $request->getParameter("teloficina") );
		}

		if( $request->getParameter("telparticular") ){
			$usuario->setCaTelparticular( $request->getParameter("telparticular") );
		}

		if( $request->getParameter("telfamiliar") ){
			$usuario->setCaTelfamiliar( $request->getParameter("telfamiliar") );
		}

		if( $request->getParameter("nombrefamiliar") ){
			$usuario->setCaNombrefamiliar( $request->getParameter("nombrefamiliar") );
		}

		if( $request->getParameter("movil") ){
			$usuario->setCaMovil( $request->getParameter("movil") );
		}

		if( $request->getParameter("direccion") ){
			$usuario->setCaDireccion( $request->getParameter("direccion") );
		}

		if( $request->getParameter("tiposangre") ){
			$usuario->setCaTiposangre( $request->getParameter("tiposangre") );
		}
        if( $request->getParameter("parentesco") ){
			$usuario->setCaParentesco( $request->getParameter("parentesco") );
		}
        $usuario->save();

        $this->usuario=$usuario;

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
				$user = Doctrine::getTable("Usuario")->find( $this->getUser()->getUserId() );
				$user->setPasswd( $this->getRequestParameter("clave1") );
				$user->setCaForcechange( false );
				$user->save();
				
				$this->getUser()->setAttribute('forcechange', false);
								
				$this->setTemplate("changePasswdOk");					
				
			}
		}	
	}	
	
	/*
	*
	*/
	public function executeFormPermisos( $request ){

        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
       
        switch( $app ){
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }
        
		$this->usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );

        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
        $accesos = Doctrine::getTable("AccesoUsuario")
                            ->createQuery("a")
                            ->innerJoin("a.Rutina r")
                            ->where("a.ca_login= ? ", $this->usuario->getCaLogin())
                            ->addWhere("r.ca_aplicacion = ?", $app)
                            ->execute();
		$this->accesos = array();
		foreach( $accesos as $acceso ){
			$this->accesos[ $acceso->getCaRutina() ] = $acceso->getCaAcceso();
		}	
		
        $accesos = Doctrine::getTable("AccesoPerfil")
                            ->createQuery("a")
                            ->innerJoin("a.UsuarioPerfil up")
                            ->innerJoin("a.Rutina r")
                            ->where("up.ca_login= ? ", $this->usuario->getCaLogin())
                            ->addWhere("r.ca_aplicacion = ?", $app)
                            ->addOrderBy("a.ca_acceso")
                            ->execute();

		$this->accesosPerfil = array();
		foreach( $accesos as $acceso ){
			$perfil =  $acceso->getPerfil();
			$this->accesosPerfil[ $acceso->getCaRutina() ]['nivel'] = $acceso->getCaAcceso();
			$this->accesosPerfil[ $acceso->getCaRutina() ]['perfil'] = $perfil->getCaNombre();
		}		
	}
	
	/*
	*
	*/
	public function executeGuardarPermisos( $request ){
		$this->usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );
	 
        $accesos = Doctrine::getTable("AccesoUsuario")
                            ->createQuery("a")
                            ->where("a.ca_login= ? ", $this->usuario->getCaLogin())
                            ->execute();
				
		foreach( $accesos as $acceso ){
			$acceso->delete();
		}
		
		$accesosForm = $request->getParameter( "acceso" );
		$niveles = $request->getParameter( "nivel" );
		
		foreach( $accesosForm as $key=>$accesoForm ){
			$acceso = new AccesoUsuario();
			$acceso->setCaLogin(  $this->usuario->getCaLogin() );
			$acceso->setCaRutina( $key );
			$acceso->setCaAcceso( $niveles[$key] );
			$acceso->save();
		}
		
		$this->redirect("adminUsers/formUsuario?login=".$this->usuario->getCaLogin() );
		
	}
	
	
	/*
	*
	*/
	public function executeFormPerfiles( $request ){
		$this->usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );
	 
	 			
        $this->perfiles = Doctrine::getTable("Perfil")
                            ->createQuery("p")                            
                            ->addOrderBy("p.ca_departamento")
                            ->addOrderBy("p.ca_nombre")
                            ->execute();


        $perfilesUsuario = Doctrine::getTable("UsuarioPerfil")
                            ->createQuery("up")
                            ->where("up.ca_login= ? ", $this->usuario->getCaLogin())
                            ->execute();

		
		$this->perfilesUsuario = array();
		foreach( $perfilesUsuario as $perfilUsuario ){
			$this->perfilesUsuario[ ] = $perfilUsuario->getCaPerfil();
		}		
	}
	
	
	/*
	*
	*/
	public function executeGuardarPerfiles( $request ){
		$usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
		$this->forward404Unless( $usuario );
		
        $perfilesUsuario = Doctrine::getTable("UsuarioPerfil")
                            ->createQuery("up")
                            ->where("up.ca_login= ? ", $usuario->getCaLogin())
                            ->execute();
		
		foreach( $perfilesUsuario as $perfilUsuario ){
			$perfilUsuario->delete();
		}
		
		$perfiles = $request->getParameter('perfiles');
		
		foreach( $perfiles as $perfil ){
			$perfilObj = new UsuarioPerfil();
			$perfilObj->setCaLogin( $usuario->getCaLogin()  );
			$perfilObj->setCaPerfil( $perfil );
			$perfilObj->save();
			
		}		
		
		$this->redirect("adminUsers/formUsuario?login=".$usuario->getCaLogin() );

		
		
	}

    public function executeLogin($request){
        //header("Location: /users/login");
        //exit();
		//echo "login".session_id();
		//$response = sfContext::getInstance()->getResponse();
		//$response->addStylesheet("login");

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

	public function executeLogout($request){
		$this->getUser()->signOut();
		$this->redirect("adminUsers/login");
	}

    public function executeMainUsers(sfWebRequest $request) {

        $this->userinicio = sfContext::getInstance()->getUser();
        $this->nivel = $this->getNivel();
    }


    public function executeNoAccess( $request ){

    }

    public function executeTraerImagen($request){
        $username=$request->getParameter('username');
        $tamano=$request->getParameter('tamano');

        $user=Doctrine::getTable('Usuario')->find($username);

        $this->imagen=$user->getImagen($tamano);
    }

    public function executeViewOrganigrama(sfWebRequest $request) {
        $this->manager=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->forward404Unless( $this->manager );

        $this->usuarios = $this->manager->getSubordinado();

        if(count($this->usuarios)==0){
            $this->manager = $this->manager->getManager();
            $this->usuarios = $this->manager->getSubordinado();
        }
    }
    
    public function executeViewUser(sfWebRequest $request) {

        $this->setLayout("layout2col");
        $this->userinicio = sfContext::getInstance()->getUser();
        $this->nivel = $this->getNivel();

        $this->user=Doctrine::getTable('Usuario')->find($request->getParameter('login'));

        $this->manager=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->manager = $this->manager->getManager();

        
    }
}
?>