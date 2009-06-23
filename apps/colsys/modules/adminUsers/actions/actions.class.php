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
		if( !$this->usuario ){
			$this->usuario = new Usuario();
		}
	 
	 	$c = new Criteria();
		$c->addAscendingOrderByColumn( DepartamentoPeer::CA_NOMBRE );
		$this->departamentos = DepartamentoPeer::doSelect( $c );
		
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( SucursalPeer::CA_NOMBRE );
		$this->sucursales = SucursalPeer::doSelect( $c );
	}
	
	/*
	*
	*/
	public function executeGuardarUsuario( $request ){
		$usuario = UsuarioPeer::retrieveByPk( $request->getParameter("login") );
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
			$sucursal = SucursalPeer::retrieveByPk( $request->getParameter("idsucursal") );
			$usuario->setCaSucursal( $sucursal->getCaNombre() );
			
		}
		
		if( $request->getParameter("auth_method") ){
			$usuario->setCaAuthMethod( $request->getParameter("auth_method") );
		}
		
		if( $request->getParameter("passwd1") && $request->getParameter("passwd1")==$request->getParameter("passwd2") ){
			$usuario->setPasswd( $request->getParameter("passwd1") );
		}
		
		
		if( $request->getParameter("forcechange") ){
			$usuario->setCaForcechange( true );
		}else{
			$usuario->setCaForcechange( false );
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
				$user = UsuarioPeer::retrieveByPk( $this->getUser()->getUserId() );
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
		$this->usuario = UsuarioPeer::retrieveByPk( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );
	 
		
		$c = new Criteria();
		$c->add( AccesoUsuarioPeer::CA_LOGIN, $this->usuario->getCaLogin() );
		$accesos = AccesoUsuarioPeer::doSelect( $c );
		
		$this->accesos = array();
		foreach( $accesos as $acceso ){
			$this->accesos[ $acceso->getCaRutina() ] = $acceso->getCaAcceso();
		}	
		
		$c = new Criteria();
		$c->addJoin( UsuarioPerfilPeer::CA_PERFIL, AccesoPerfilPeer::CA_PERFIL );
		$c->add( UsuarioPerfilPeer::CA_LOGIN, $this->usuario->getCaLogin() );
		$c->addAscendingOrderByColumn( AccesoPerfilPeer::CA_ACCESO );
		$accesos = AccesoPerfilPeer::doSelect( $c );
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
		$this->usuario = UsuarioPeer::retrieveByPk( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );
	 
		
		$c = new Criteria();
		$c->add( AccesoUsuarioPeer::CA_LOGIN, $this->usuario->getCaLogin() );
		$accesos = AccesoUsuarioPeer::doSelect( $c );
				
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
		$this->usuario = UsuarioPeer::retrieveByPk( $request->getParameter("login") );
		$this->forward404Unless( $this->usuario );
	 
	 	$c = new Criteria();
		$c->addAscendingOrderByColumn( PerfilPeer::CA_DEPARTAMENTO );
		$c->addAscendingOrderByColumn( PerfilPeer::CA_NOMBRE );
		$this->perfiles = PerfilPeer::doSelect( $c );
		
		$c = new Criteria();
		$c->add( UsuarioPerfilPeer::CA_LOGIN, $this->usuario->getCaLogin() );
		$perfilesUsuario = UsuarioPerfilPeer::doSelect( $c );
		
		$this->perfilesUsuario = array();
		foreach( $perfilesUsuario as $perfilUsuario ){
			$this->perfilesUsuario[ ] = $perfilUsuario->getCaPerfil();
		}		
	}
	
	
	/*
	*
	*/
	public function executeGuardarPerfiles( $request ){
		$usuario = UsuarioPeer::retrieveByPk( $request->getParameter("login") );
		$this->forward404Unless( $usuario );
		
		
		$c = new Criteria();
		$c->add( UsuarioPerfilPeer::CA_LOGIN, $usuario->getCaLogin() );
		$perfilesUsuario = UsuarioPerfilPeer::doSelect( $c );
		
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