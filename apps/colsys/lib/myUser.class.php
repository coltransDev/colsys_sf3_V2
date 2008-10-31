<?php
 
class myUser extends sfBasicSecurityUser
{
	public function signIn( $login ){
		$this->setAuthenticated( true );
		$this->setAttribute('login', $login );					
		
	}
		
	
	public function setUserId( $userId  ){
		$this->setAttribute('user_id', $userId );
		$user = UsuarioPeer::retrieveByPk( $userId );
		
		if( $user ){
			$c = new Criteria();
			$c->add( NivelesAccesoPeer::CA_LOGIN , $userId );
			$c->add( NivelesAccesoPeer::CA_BASEDEDATOS , "Coltrans" );
			$acceso = NivelesAccesoPeer::doSelectOne( $c );	
			
			$sucursal = $user->getSucursal();
						
			
			$this->setAttribute('sucursal', $sucursal );
			$this->setAttribute('nombre', $user->getCaNombre() );		
			$this->setAttribute('email', $user->getCaEmail() );
			$this->setAttribute('cargo', $user->getCaCargo() );
			$this->setAttribute('extension', $user->getCaExtension() );
			if( $acceso ){  				
				$this->setAttribute('nivel_acceso', $acceso->getCaNivel() );
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
	
	public function getSucursal(){
		return $this->getAttribute('sucursal' );
	}
	
	public function getCargo(){
		return $this->getAttribute('cargo' );
	}
	
	public function getExtension(){
		return $this->getAttribute('extension' );
	}
	
	
	public function getNivelAcceso(){		
		return $this->getAttribute('nivel_acceso' );
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
	public function addFile($file, $idx=null){		
		$userFiles=$this->getAttribute('userFiles');
		if( !$idx ){		
			$idx=count( $userFiles );
		}
		
		$userFiles[$idx] = $file;
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
			return $userFiles[$k];
		} 		
	}
	
	/*
	* Retorna todos los archivos en la lista de archivos del usuario para enviar por correo 
	* o realizar otras tareas
	*/
	public function getFiles( ){
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
}

?>