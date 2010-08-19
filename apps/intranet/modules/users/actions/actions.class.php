<?php

/**
 * users actions.
 *
 * @package    symfony
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeViewUser(sfWebRequest $request) {
		$this->setLayout("layout2col");
        $this->user=Doctrine::getTable('Usuario')->find($request->getParameter('login'));

        $this->manager=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->manager = $this->manager->getManager();
     
    }

    public function executeViewOrganigrama(sfWebRequest $request) {
        $this->manager=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->forward404Unless( $this->manager );
        
        $this->usuarios = $this->manager->getSubordinado();

        if(count($this->usuarios)==0){
            $this->manager = $this->manager->getManager();
            $this->usuarios = $this->manager->getSubordinado();
        }

                    /*Doctrine::getTable('Usuario')
                    ->createQuery('u')
                    ->where("u.ca_manager= ? ", $this->user->getCaLogin())
                    ->execute();*/

      


    }

    public function executeDirectory(sfWebRequest $request) {

    }

    public function executeDoSearch(sfWebRequest $request) {
        $criterio = '%'.strtolower($request->getParameter('criterio')).'%';
        $this->usuarios=Doctrine::getTable('Usuario')
                    ->createQuery('u')
                    ->addWhere('(LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_nombres) LIKE ? OR LOWER(u.ca_apellidos) LIKE ? )', array($criterio,$criterio,$criterio))
					->addWhere('u.ca_activo = ?', true)
					->distinct()
                    ->execute();
					

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
	
	public function executeLogout($request)
	{
		$this->getUser()->signOut();
		$this->redirect("users/login");
	}
    public function executeTraerImagen($request)
    {
        $username=$request->getParameter('username');
        $user=Doctrine::getTable('Usuario')->find($username);

        $this->imagen=$user->getImagen();
    }
    
    public function executeFormUsuario( $request ){
        $this->setLayout("layout2col");
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
            $query.= "  order by ca_empresa DESC";

        $this->empresas = $q->execute($query);
		
		$this->manager=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->manager = $this->manager->getManager();
		
		
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("tabpane/tabpane",'last');
        $response->addStylesheet("tabpane/luna/tab",'last');



	}

    public function executeGuardarUsuario( $request ){
		$usuario = Doctrine::getTable("Usuario")->find( $request->getParameter("login") );
		if( !$usuario ){
			$usuario = new Usuario();
			$usuario->setCaLogin( $request->getParameter("login") );
		}

		/*
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
		}*/


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
        $usuario->save();

        $this->usuario=$usuario;

	}

}

	


