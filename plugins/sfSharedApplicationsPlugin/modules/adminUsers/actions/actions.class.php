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
        $this->usuarios = Doctrine::getTable("Usuario")
                          ->createQuery("u")
                          ->addOrderBy("u.ca_activo DESC")
                          ->addOrderBy("u.ca_nombre")
                          ->execute();
	}
	
	/*
	*
	
	*/
	public function executeFormUsuario( $request ){
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


		
	}
	
	/*
	*
	*/
	public function executeGuardarUsuario( $request ){
		$usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
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
			* FIX-ME: Se deben arreglar las opciones del prrograma donde se use el nombre de la sucursal
			*/			
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
            $nombre_archivo=$usuario->getDirectorio().DIRECTORY_SEPARATOR.'foto.jpg';
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
        if( $request->getParameter("nombres") ){
			$usuario->setCaNombres( $request->getParameter("nombres") );
		}

        }
		$usuario->save();		
	 
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
	
	
	
}
?>