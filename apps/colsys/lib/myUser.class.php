<?php
 
class myUser extends sfBasicSecurityUser
{
	public function signIn( $login ){
		$this->setAuthenticated( true );
		$this->setAttribute('user_id', $login );
	}
		
	public function __toString() {
        return $this->getUserId();
    }


	public function setUserId( $userId  ){
		$this->setAttribute('user_id', $userId );
		$user = Doctrine::getTable("Usuario")->find( $userId );
				
		if( $user ){		
			//$sucursal = $user->getSucursal();
						
			$this->setAttribute('idsucursal',  $user->getCaIdsucursal() );		
			$this->setAttribute('nombre', $user->getCaNombre() );		
			$this->setAttribute('email', $user->getCaEmail() );
			$this->setAttribute('cargo', $user->getCaCargo() );
			$this->setAttribute('extension', $user->getCaExtension() );
			$this->setAttribute('idtrafico',  $user->getSucursal()->getEmpresa()->getCaIdtrafico());
            $this->setAttribute('idempresa',  $user->getSucursal()->getEmpresa()->getCaIdempresa());

			
			$c = new Criteria();
			$c->add(DepartamentoPeer::CA_NOMBRE, $user->getCaDepartamento() );
			$departamento = DepartamentoPeer::doSelectOne( $c );
			if( $departamento ){
				$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
			}
		}
	}
	
	public function getUserId(){
		return $this->getAttribute('user_id' );
	}
	
	public function getEmail(){
		return $this->getAttribute('email' );
	}
	
	public function getNombre(){
		return $this->getAttribute('nombre' );
	}
	
	public function getIdSucursal(){
		return $this->getAttribute('idsucursal' );
	}
	
	public function getIddepartamento(){
		return $this->getAttribute('iddepartamento' );
	}
	
	public function getCargo(){
		return $this->getAttribute('cargo' );
	}
	
	public function getExtension(){
		return $this->getAttribute('extension' );
	}

    public function getIdtrafico(){
		return ($this->getAttribute('idtrafico'))?$this->getAttribute('idtrafico'):"CO-057";
	}

    public function getIdempresa(){
		return $this->getAttribute('idempresa');
	}

	public function getNivelAcceso( $rutina ){        
		$usuario = Doctrine::getTable('Usuario')->createQuery('u')->where('u.ca_login = ? ', $this->getUserId() )->fetchOne();		
        return $usuario->getNivelAcceso( $rutina );
	}
	
	public function getGrupos( ){		
		return $this->getAttribute('grupos');
	}

	
	public function setGrupos( $grupos ){		
		$this->setAttribute('grupos', $grupos );
	}

    public function getSucursal(){
        return $this->getAttribute('idsucursal');
	}
	
	
		
	/*
	* A�ade un archivo en la lista de archivos del usuario para enviar por correo 
	* o realizar otras tareas
	*/		
	public function addFile($file){				
		
		$userFiles=$this->getAttribute('userFiles');
						
		$idx=md5(count( $userFiles ).time().rand());
						
		$userFiles[$idx] = base64_encode($file);
		
		$this->setAttribute('userFiles', $userFiles );
		return $idx;
	}
		
	/*
	* Retorna un archivo en la lista de archivos del usuario para enviar por correo 
	* o realizar otras tareas
	*/
	public function getFile( $k ){		
		$userFiles=$this->getAttribute('userFiles');		
		if( isset($userFiles[$k]) ){
			return base64_decode($userFiles[$k]);
		} 		
	}
	
	/*
	* Retorna todos los archivos en la lista de archivos del usuario para enviar por correo 
	* o realizar otras tareas
	*/
	public function getFiles( ){		
		$files = $this->getAttribute('userFiles');
		
		foreach( $files as $key =>$file ){
			$files[$key] =  base64_decode($files[$k]);
		}
		
		return $this->getAttribute('userFiles');
	}
	
	/*
	* Borra todos los archivos en la lista de archivos del usuario para enviar por correo 
	* o realizar otras tareas
	*/
	public function clearFiles(){
		$this->setAttribute('userFiles', array() );
	}
	
		
	/*
	* Registra un evento para el usuario
	*/
	public function log( $event ){	
		
		$log = new UsuarioLog();
		$log->setCaLogin( $this->getUserId() );
		$log->setCaFchevento(date("Y-m-d H:i:s"));
		$log->setCaUrl(  $_SERVER['REQUEST_URI'] );
		$log->setCaEvent($event);
		$log->setCaIpaddress( $_SERVER['REMOTE_ADDR'] );
		$log->setCaUseragent( $_SERVER['HTTP_USER_AGENT'] );
		$log->save();
	}
	
	
	
	
	/*
	* Inicia la sesion y verifica a los grupos a los que pertenece
	*  el usuario el el directorio LDAP
	*/
	public function signInLDAP( $username )
	{ 		
		$user = Doctrine::getTable("Usuario")->find( $username );
		
		if( $user ){				
			$this->setAttribute('user_id', $username );			
			$this->setAuthenticated(true);							
			$this->addCredential('colsys_user');
			$this->setCulture('es_CO');			
							
			$sucursal = $user->getSucursal();			
			$this->setAttribute('idsucursal',  $user->getCaIdsucursal() );
			$this->setAttribute('nombre', $user->getCaNombre() );		
			$this->setAttribute('email', $user->getCaEmail() );
			$this->setAttribute('cargo', $user->getCaCargo() );			
			$this->setAttribute('extension', $user->getCaExtension() );
            $this->setAttribute('idtrafico', $user->getSucursal()->getEmpresa()->getCaIdtrafico() );
            $this->setAttribute('idempresa', $user->getSucursal()->getEmpresa()->getCaIdempresa() );
			$this->setAttribute('authmethod', $user->getCaAuthmethod() );
			$this->setAttribute('forcechange', false );					
			
			$departamento = Doctrine::getTable("Departamento")
                                      ->createQuery("d")
                                      ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                                      ->fetchOne();
			if( $departamento ){
				$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
			}									

            $this->log("Login LDAP");            
		}
	}	
	
	
	/*
	* Inicia la sesion usando un metodo alternativo para usarios sin novell
	*/
	public function signInAlternative( $username )
	{ 		
		$user = Doctrine::getTable("Usuario")->find( $username );
		
		if( $user ){	
						
			$this->setAttribute('user_id', $username );			
			$this->setAuthenticated(true);							
			$this->addCredential('colsys_user');
			$this->setCulture('es_CO');			
							
			$sucursal = $user->getSucursal();			
			$this->setAttribute('idsucursal',  $user->getCaIdsucursal() );
			$this->setAttribute('nombre', $user->getCaNombre() );		
			$this->setAttribute('email', $user->getCaEmail() );
			$this->setAttribute('cargo', $user->getCaCargo() );			
			$this->setAttribute('extension', $user->getCaExtension() );
            $this->setAttribute('idtrafico', $user->getSucursal()->getEmpresa()->getCaIdtrafico() );
            $this->setAttribute('idempresa', $user->getSucursal()->getEmpresa()->getCaIdempresa() );
			$this->setAttribute('authmethod', $user->getCaAuthmethod() );			
			$this->setAttribute('forcechange', $user->getCaForcechange() );
			
			$departamento = Doctrine::getTable("Departamento")
                                      ->createQuery("d")
                                      ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                                      ->fetchOne();
			if( $departamento ){
				$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
			}
            $this->log("Login SHA1");
            
		}
	}
	
	/*
	* Cierra la sesion
	*/
	public function signOut()
	{
		
        //setcookie("menu", false, time()+3600);
        
        
		
        $this->setAuthenticated(false);
		
		$this->setAttribute('user_id', null);
		$this->setAttribute('nombre', null);
		$this->setAttribute('email', null);
		$this->setAttribute('cargo', null);
		$this->setAttribute('extension', null);
        $this->setAttribute('idtrafico', null );
        $this->setAttribute('idempresa', null );
		$this->setAttribute('iddepartamento', null);
		$this->setAttribute('authmethod', null);
        $this->setAttribute('menu', null);

        
        $this->setAttribute('menu',  null );
		
		//setcookie("JSESSIONID", "" );	
		$cache = myCache::getInstance();
        $cookie = $_COOKIE["colsys"];
        list($session_id, $signature) = explode(':', $cookie, 2);
        $cache->set($session_id."_menu", "");
			
		$this->setAuthenticated(false);		
		$this->clearCredentials();
		//session_destroy();
	}


    /*
     * Recrea el menu y lo almacena en cache
     */

    private function buildMenu(){
        $app =  sfContext::getInstance()->getConfiguration()->getApplication();        
        $rutinas = Doctrine::getTable("Rutina")
                          ->createQuery("r")
                          ->select('r.*')
                          ->leftJoin("r.AccesoPerfil ap")
                          ->leftJoin("ap.UsuarioPerfil up")
                          ->leftJoin("r.AccesoUsuario au")
                          ->where(" (up.ca_login = ? or au.ca_login = ? )", array($this->getUserId(), $this->getUserId()) )
                          ->addWhere(" (ap.ca_acceso >= ? or ap.ca_acceso IS NULL )", 0 )
                          ->addWhere(" (au.ca_acceso >= ? or au.ca_acceso IS NULL )", 0 )
                          ->addWhere("r.ca_aplicacion =  ? ", $app )
                          ->addOrderBy("r.ca_grupo ASC")
                          ->addOrderBy("r.ca_opcion ASC")
                          ->distinct()
                          ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                          ->execute();

        $grupos = array();
        foreach( $rutinas as $rutina ){
            if( !isset( $grupos[$rutina["ca_grupo"]] )){
                $grupos[$rutina["ca_grupo"]]=array();
            }
            $grupos[$rutina["ca_grupo"]][]=$rutina;
        }
       

        $cache = myCache::getInstance();
        $cookie = $_COOKIE["colsys"];
        list($session_id, $signature) = explode(':', $cookie, 2);
        $cache->set($session_id."_menu", $grupos);        
        return $grupos;
       
    }

    public function getMenu(){
        $cache = myCache::getInstance();
        $cookie = $_COOKIE["colsys"];
        list($session_id, $signature) = explode(':', $cookie, 2);
        $menu = $cache->get($session_id."_menu", null);        
        if( !$menu ){
            $menu = $this->buildMenu();
        }        
        return $menu;
    }
    
}

?>