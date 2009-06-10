<?php

/**
 * adminUsers actions.
 *
 * @package    colsys
 * @subpackage adminUsers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminPerfilesActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$c = new Criteria();
		$c->addAscendingOrderByColumn( PerfilPeer::CA_DEPARTAMENTO );
		$c->addAscendingOrderByColumn( PerfilPeer::CA_NOMBRE );
		$this->perfiles = PerfilPeer::doSelect( $c );
	}
	
	/*
	*
	*/
	public function executeFormPerfil( $request ){
		$this->perfil = PerfilPeer::retrieveByPk( $request->getParameter("perfil") );
		if( !$this->perfil ){
			$this->perfil = new Perfil();
		}
	 
	 	$c = new Criteria();
		$c->addAscendingOrderByColumn( DepartamentoPeer::CA_NOMBRE );
		$this->departamentos = DepartamentoPeer::doSelect( $c );
	}
	
	/*
	*
	*/
	public function executeGuardarPerfil( $request ){
		$perfil = PerfilPeer::retrieveByPk( $request->getParameter("perfil") );
		if( !$perfil ){
			$perfil = new Perfil();
			$idperfil = str_replace(" ", "-", strtolower( $request->getParameter("nombre") ));
			$perfil->setCaPerfil( $idperfil );
		}
						
		$perfil->setCaNombre( $request->getParameter("nombre") );		
		$perfil->setCaDescripcion( $request->getParameter("descripcion") );	
		if( $request->getParameter("departamento") ){	
			$perfil->setCaDepartamento( $request->getParameter("departamento") );		
		}else{
			$perfil->setCaDepartamento( null );		
		}
		$perfil->save();
	 	
		
		$this->redirect("adminPerfiles/index" );
		
	}
	
	/*
	*
	*/
	public function executeFormPermisos( $request ){
		$this->perfil = PerfilPeer::retrieveByPk( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
	 
		
		$c = new Criteria();
		$c->add( AccesoPerfilPeer::CA_PERFIL, $this->perfil->getCaPerfil() );
		$accesos = AccesoPerfilPeer::doSelect( $c );
		
		$this->accesos = array();
		foreach( $accesos as $acceso ){
			$this->accesos[ $acceso->getCaRutina() ] = $acceso->getCaAcceso();
		}	
		
			
	}
	
	
	/*
	*
	*/
	public function executeGuardarPermisos( $request ){
		$this->perfil = PerfilPeer::retrieveByPk( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
	 
		
		$c = new Criteria();
		$c->add( AccesoPerfilPeer::CA_PERFIL, $this->perfil->getCaPerfil() );
		$accesos = AccesoPerfilPeer::doSelect( $c );
				
		foreach( $accesos as $acceso ){
			$acceso->delete();
		}
		
		$accesosForm = $request->getParameter( "acceso" );
		$niveles = $request->getParameter( "nivel" );
		
		foreach( $accesosForm as $key=>$accesoForm ){
			$acceso = new AccesoPerfil();
			$acceso->setCaPerfil(  $this->perfil->getCaPerfil() );
			$acceso->setCaRutina( $key );
			$acceso->setCaAcceso( $niveles[$key] );
			$acceso->save();
		}
		
		$this->redirect("adminPerfiles/formPerfil?perfil=".$this->perfil->getCaPerfil() );
	}
	
	/*
	*
	*/
	public function executeFormUsers( $request ){
		$this->perfil = PerfilPeer::retrieveByPk( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
	 
	 	
		$c = new Criteria();
		$c->add( UsuarioPeer::CA_ACTIVO, true );
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_NOMBRE );
		$this->usuarios = UsuarioPeer::doSelect( $c );
		
		
		$c = new Criteria();
		$c->add( UsuarioPerfilPeer::CA_PERFIL, $this->perfil->getCaPerfil() );
		$perfilesUsuario = UsuarioPerfilPeer::doSelect( $c );
		
		$this->usuariosPerfil = array();
		foreach( $perfilesUsuario as $perfilUsuario ){
			$this->usuariosPerfil[  ] = $perfilUsuario->getCaLogin();
		}		
	}
	
	/*
	*
	*/
	public function executeGuardarPerfilesUsuario( $request ){
		$this->perfil = PerfilPeer::retrieveByPk( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
	 	
		$c = new Criteria();
		$c->add( UsuarioPerfilPeer::CA_PERFIL, $this->perfil->getCaPerfil() );
		$perfilesUsuario = UsuarioPerfilPeer::doSelect( $c );
						
		foreach( $perfilesUsuario as $perfilUsuario ){		
			$perfilUsuario->delete();
		}		
		
		$logins = $request->getParameter( "logins");
		
		
		foreach( $logins as $login ){
			$usuarioPerfil = new UsuarioPerfil();
			$usuarioPerfil->setCaPerfil( $this->perfil->getCaPerfil() );
			$usuarioPerfil->setCaLogin( $login );
			$usuarioPerfil->save();
			
		}
		
		
		$this->redirect("adminPerfiles/formPerfil?perfil=".$this->perfil->getCaPerfil() );
		
		
	}
	
	
	
	
	
}
?>