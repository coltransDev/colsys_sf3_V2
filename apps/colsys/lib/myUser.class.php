<?php
 
class myUser extends sfBasicSecurityUser
{
	public function signIn( $login ){
		$this->setAuthenticated( true );
		$this->setAttribute('user_id', $login );
	}
		
	
	public function setUserId( $userId  ){
		$this->setAttribute('user_id', $userId );
		$user = UsuarioPeer::retrieveByPk( $userId );
				
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
		$acceso = AccesoUsuarioPeer::retrieveByPk( $rutina, $this->getUserId() );
		
		if( $acceso ){					
			return $acceso->getCaAcceso();
		}else{
			if( $this->getAttribute('authmethod')=="ldapP" ){						
				$c = new Criteria();									
				$c->addJoin( AccesoPerfilPeer::CA_PERFIL, UsuarioPerfilPeer::CA_PERFIL );				
				$c->add( UsuarioPerfilPeer::CA_LOGIN , $this->getUserId() );
				$c->add( AccesoPerfilPeer::CA_RUTINA , $rutina );
				
				$acceso = AccesoPerfilPeer::doSelectOne( $c );
				if( $acceso ){				
					return $acceso->getCaAcceso();
				}
			}else{
				$c = new Criteria();									
				$c->addJoin( AccesoGrupoPeer::CA_GRUPO, UsuarioGrupoPeer::CA_GRUPO );				
				$c->add( UsuarioGrupoPeer::CA_LOGIN , $this->getUserId() );
				$c->add( AccesoGrupoPeer::CA_RUTINA , $rutina );
				
				$acceso = AccesoGrupoPeer::doSelectOne( $c );
				if( $acceso ){				
					return $acceso->getCaAcceso();
				}
			}		
		}
		
		return -1;
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
		
	/*
	* Añade un archivo en la lista de archivos del usuario para enviar por correo 
	* o realizar otras tareas
	*/
	/*public function addFile($file){				
		
		$userFiles=explode("|",$this->getAttribute('userFiles'));
						
		$idx=md5(count( $userFiles ).time().rand());
						
		$userFiles[$idx] = base64_encode($file);
		echo  implode("|",$userFiles);
		//$this->setAttribute('userFiles', implode("|",$userFiles) );
		return $idx;
	}*/
	
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
	
	
	
	
	
	public function log( $event, $module, $action ){
		$log = new usuarioLog();
		$log->setCaLogin( $this->getUserId() );
		$log->setCaEvent( $event );
		$log->setCaModule( $module );
		$log->setCaAction( $action );
		$log->save();
	}
	
	/*
	* Registra un evento para el usuario
	*/
	/*public function log( $event ){	
		$log = new TrackingUserLog();
		$log->setCaEmail( $this->getAttribute('email') );
		$log->setCaFchevento(time());	
		$log->setCaUrl(  $_SERVER['PATH_INFO'] );
		$log->setCaEvento($event);
		$log->setCaIpaddress( $_SERVER['REMOTE_ADDR'] );	
		$log->save();
	}*/
	
	/*
	* Inicia la sesion y verifica a los grupos a los que pertenece
	*  el usuario el el directorio LDAP
	*/
	public function signInLDAP( $username )
	{ 		
		$user = UsuarioPeer::retrieveByPk( $username );
		
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
	
	
	
	/*
	* Inicia la sesion y verifica a los grupos a los que pertenece
	*  el usuario el el directorio LDAP
	*/
	public function signInLDAPPerfiles( $username )
	{ 		
		$user = UsuarioPeer::retrieveByPk( $username );
		
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
			$c = new Criteria();
			$c->add(DepartamentoPeer::CA_NOMBRE, $user->getCaDepartamento() );
			$departamento = DepartamentoPeer::doSelectOne( $c );
			if( $departamento ){
				$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
			}									
			
		}
			
	}
	
	
	
	
	
	
	/*
	* Inicia la sesion usando un metodo alternativo para usarios sin novell
	*/
	public function signInAlternative( $username )
	{ 		
		$user = UsuarioPeer::retrieveByPk( $username );
		
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
			
			$c = new Criteria();
			$c->add(DepartamentoPeer::CA_NOMBRE, $user->getCaDepartamento() );
			$departamento = DepartamentoPeer::doSelectOne( $c );
			if( $departamento ){
				$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
			}
						
			/*
			* En este caso los grupos no cambian dinamicamente como en el LDAP y semantienen en la BD
			* en caso que el usuario inicie sesion con LDAP estos se borraran. 
			*/
			$grupos = array();
			$c = new Criteria();
			$c->add( UsuarioGrupoPeer::CA_LOGIN, $username );
			$accesos = UsuarioGrupoPeer::doSelect( $c );
			foreach( $accesos as $acceso ){
				$grupos[] = $acceso->getCaGrupo();	
			}
											
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
	
	/*
	* Sobrecarga la function isAuthenticated de la clase sfBasicSecurityUser para determinar si cumplio el maximo tiempo de sesion
	*/
	/*public function isAuthenticated(){
		return parent::isAuthenticated();
	}*/
	
	
	
	
}

?>
