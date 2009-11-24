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
	
	
		
	/*
	* Añade un archivo en la lista de archivos del usuario para enviar por correo 
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
	/*public function signInLDAP( $username )
	{ 		
		$user = Doctrine::getTable("Usuario")->find( $username );
		
		if( $user ){	
			
			$gruposArray = array();
			
			$ldap_server=sfConfig::get("app_ldap_host");
			$auth_user="cn=".sfConfig::get("app_ldap_user").",o=coltrans_bog";			
					
			$passwd =sfConfig::get("app_ldap_passwd");
			
			if($connect=ldap_connect($ldap_server)){						
				if($bind=ldap_bind($connect, $auth_user, $passwd)){
					
					//Determina la pertenecia a los grupos en el serv. LDAP		
					$gruposObj = GrupoPeer::doSelect( new Criteria() );
					foreach( $gruposObj as $grupoObj ){
						$gruposArray[]=$grupoObj->getCaNombre();
					}						
											
					$sr = ldap_search($connect,"o=coltrans_bog" , "(&(objectclass=person)(cn=".$username."))" );
					$info = ldap_get_entries($connect, $sr);										
					$person = $info[0];		
						
					$grupos = array();
					foreach($person['groupmembership'] as $key=>$grupo ){												
						if( $key!=="count"){							
							$grupo = str_replace(",o=coltrans_bog", "", $grupo);
							$grupo = strtolower(str_replace("cn=", "", $grupo));		
							if( in_array( $grupo, $gruposArray ) ){													
								$grupos[]=$grupo;
							}
						}
					}						
					
					
					//Borra todos los grupos a los que pertenece  
					$c = new Criteria();
					$c->add( UsuarioGrupoPeer::CA_LOGIN, $username );
					$accesos = UsuarioGrupoPeer::doSelect( $c );
					foreach( $accesos as $acceso ){
						$acceso->delete();			
					}
				
					foreach( $grupos as $grupo ){
						$usuarioGrupo = new UsuarioGrupo();
						$usuarioGrupo->setCaLogin( $username );
						$usuarioGrupo->setCaGrupo( $grupo );
						$usuarioGrupo->save();
					}	
																									
					$this->setGrupos( $grupos );	
				
					
				
					
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
					$this->setAttribute('authmethod', $user->getCaAuthmethod() );
					$this->setAttribute('forcechange', false );					
					$c = new Criteria();
					$c->add(DepartamentoPeer::CA_NOMBRE, $user->getCaDepartamento() );
					$departamento = DepartamentoPeer::doSelectOne( $c );
					if( $departamento ){
						$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
					}	
					
										
				}	
		
			}
		}
	}
	*/
	
	
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
		//$this->getAttributeHolder()->removeNamespace('colsys_user');
		$this->setAuthenticated(false);	
		
		$this->setAttribute('user_id', null);
		$this->setAttribute('nombre', null);
		$this->setAttribute('email', null);
		$this->setAttribute('cargo', null);
		$this->setAttribute('extension', null);
		$this->setAttribute('iddepartamento', null);
		$this->setAttribute('authmethod', null);
		
		//setcookie("JSESSIONID", "" );	
		
			
		$this->setAuthenticated(false);		
		$this->clearCredentials();
		//session_destroy();
	}
	
}

?>
