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
        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
		$this->perfiles = Doctrine::getTable("Perfil")
                          ->createQuery("p")
                          ->addWhere("p.ca_aplicacion = ?", $app)
                          ->addOrderBy("p.ca_departamento")
                          ->addOrderBy("p.ca_nombre")
                          ->execute();
	}
	
	/*
	*
	*/
	public function executeFormPerfil( $request ){
		$this->perfil = Doctrine::getTable("Perfil")->find( $request->getParameter("perfil") );
		if( !$this->perfil ){
			$this->perfil = new Perfil();
		}
	 
        $this->departamentos = Doctrine::getTable("Departamento")
                          ->createQuery("d")
                          ->addOrderBy("d.ca_nombre")
                          ->execute();

	}
	
	/*
	*
	*/
	public function executeGuardarPerfil( $request ){
		$perfil = Doctrine::getTable("Perfil")->find( $request->getParameter("perfil") );
        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
		if( !$perfil ){
			$perfil = new Perfil();			
            $idperfil = Utils::slugify( $request->getParameter("nombre") );
			$perfil->setCaPerfil( $idperfil."-".$app );
		}


		$perfil->setCaNombre( $request->getParameter("nombre") );		
		$perfil->setCaDescripcion( $request->getParameter("descripcion") );
        $perfil->setCaAplicacion( $app );
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
		$this->perfil = Doctrine::getTable("Perfil")->find( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
		$accesos = Doctrine::getTable("AccesoPerfil")
                            ->createQuery("a")
                            ->innerJoin("a.Rutina r")
                            ->where("a.ca_perfil= ? ", $this->perfil->getCaPerfil())
                            ->addWhere("r.ca_aplicacion = ?", $app)
                            ->execute();
		
		$this->accesos = array();
		foreach( $accesos as $acceso ){
			$this->accesos[ $acceso->getCaRutina() ] = $acceso->getCaAcceso();
		}	
		
			
	}
	
	
	/*
	*
	*/
	public function executeGuardarPermisos( $request ){
		$this->perfil = Doctrine::getTable("Perfil")->find( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
	 
		
        $accesos = Doctrine::getTable("AccesoPerfil")
                            ->createQuery("a")
                            ->where("a.ca_perfil= ? ", $this->perfil->getCaPerfil())
                            ->execute();
		
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
		$this->perfil = Doctrine::getTable("Perfil")->find( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
	 	 	
		$this->usuarios = Doctrine::getTable("Usuario")
                                    ->createQuery("u")
                                    ->where("u.ca_activo = ? ", true)
                                    ->addOrderBy("u.ca_nombre")
                                    ->execute();
		
				
		$perfilesUsuario = Doctrine::getTable("UsuarioPerfil")->createQuery("u")
                                    ->where("u.ca_perfil = ? ", $this->perfil->getCaPerfil())
                                    ->execute();

		
		$this->usuariosPerfil = array();
		foreach( $perfilesUsuario as $perfilUsuario ){
			$this->usuariosPerfil[  ] = $perfilUsuario->getCaLogin();
		}		
	}
	
	/*
	*
	*/
	public function executeGuardarPerfilesUsuario( $request ){
		$this->perfil = Doctrine::getTable("Perfil")->find( $request->getParameter("perfil") );
		$this->forward404Unless( $this->perfil );
	 	
		$perfilesUsuario = Doctrine::getTable("UsuarioPerfil")->createQuery("u")
                                    ->where("u.ca_perfil = ? ", $this->perfil->getCaPerfil())
                                    ->execute();
						
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
	
	
	/*
	Lista de los permisos de los usuarios 
	*/
	public function executeListaAccesoUsuarios( $request ){
		
		$rutina = $request->getParameter("rutina");
		$this->rutina = Doctrine::getTable("Rutina")->find( $rutina );
		$this->forward404Unless( $this->rutina );

        
       
       $this->usuarios = Doctrine::getTable("Usuario")
                                   ->createQuery("u")
                                   ->leftJoin("u.UsuarioPerfil up")
                                   ->leftJoin("up.AccesoPerfil ap")
                                   ->leftJoin("u.AccesoUsuario au")
                                   ->where("ap.ca_rutina = ? OR au.ca_rutina = ?", array($rutina, $rutina))
                                   ->addWhere("au.ca_acceso >= 0 OR au.ca_acceso IS NULL")
                                   ->addWhere("ap.ca_acceso >= 0 OR ap.ca_acceso IS NULL")
                                    ->addWhere("u.ca_activo = true")
                                   ->addOrderBy("u.ca_idsucursal")
                                   ->addOrderBy("u.ca_departamento")
                                   ->addOrderBy("u.ca_cargo")
                                   ->addOrderBy("u.ca_nombre")
                                   ->distinct()
                                   ->execute();
       
		$rutinasNivel = Doctrine::getTable("RutinaNivel")
                                  ->createQuery("rn")
                                  ->select("rn.*")
                                  ->where("rn.ca_rutina = ?", $rutina )
                                  ->addOrderBy("rn.ca_nivel")                                 
                                  ->execute();
        
		$this->rutinasNivel = array("-1"=>"Sin acceso", 0=>"Con Acceso");
		foreach( $rutinasNivel as $rutinaNivel ){
			$this->rutinasNivel[ $rutinaNivel->getCaNivel() ] = $rutinaNivel->getCaValor();
		}       
	}
	
	
	
	
	
}
?>