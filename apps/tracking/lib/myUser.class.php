<?php

class myUser extends sfBasicSecurityUser
{
  
	public function signIn( $trackingUser )
	{ 		
		$this->setAttribute('email', $trackingUser->getCaEmail());
		$this->setAttribute('trackingUser', $trackingUser);
		$this->setAuthenticated(true);
				
		
		$contactos = Doctrine::getTable("Contacto")
                            ->createQuery("c")
                            ->addWhere("c.ca_email = ?", $trackingUser->getCaEmail())
                            ->execute();
		
		$clientes = array();
		foreach( $contactos as $contacto ){
			$clientes[]=$contacto->getCaIdcliente();
		}
		
		$this->setAttribute('clientes', $clientes );		
		$this->addCredential('customer');				
				
//		$this->setAttribute('name', $employed->getName());		
		$this->setCulture('es_CO');		
		
		$this->log("Inicio de sesion");
		
	}
	
	

	/*
	* Inicia la sesion y verifica a los grupos a los que pertenece
	*  el usuario el el directorio LDAP
	*/
	public function signInLDAP( $username )
	{
        echo "S1";
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
			$this->setAttribute('authmethod', $user->getCaAuthmethod() );
			$this->setAttribute('forcechange', false );

			$departamento = Doctrine::getTable("Departamento")
                                      ->createQuery("d")
                                      ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                                      ->fetchOne();
			if( $departamento ){
				$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
			}

            //$this->log("Login LDAP");
		}
	}


	/*
	* Inicia la sesion usando un metodo alternativo para usarios sin novell
	*/
	public function signInAlternative( $username )
	{
        echo "S2";
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
			$this->setAttribute('authmethod', $user->getCaAuthmethod() );
			$this->setAttribute('forcechange', $user->getCaForcechange() );

			$departamento = Doctrine::getTable("Departamento")
                                      ->createQuery("d")
                                      ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                                      ->fetchOne();
			if( $departamento ){
				$this->setAttribute('iddepartamento', $departamento->getCaIddepartamento() );
			}
            //$this->log("Login SHA1");

		}
	}
	
	 
	public function signOut()
	{
		$this->getAttributeHolder()->removeNamespace('customer');
		$this->setAttribute('email', null);
		$this->setAttribute('clientes', null);
		$this->setClienteActivo(null);
		$this->setAuthenticated(false);		
		$this->clearCredentials();
	}
	
	
	public function getClientes(){
		$clientesIds = $this->getAttribute('clientes');
		$clientes =array();
		
		foreach( $clientesIds as $clientesId ){
			$clientes[]= Doctrine::getTable("Cliente")->find( $clientesId );
		}		
		return $clientes;
	}
	
	
	public function setClienteActivo( $clienteActivo ){
		$this->setAttribute('clienteActivo', $clienteActivo);
	}
	
	public function getClienteActivo(){
		return $this->getAttribute('clienteActivo');
	}
	
	
	public function getContacto(){		
		$contacto = Doctrine::getTable("Contacto")
                            ->createQuery("c")
                            ->addWhere("c.ca_email = ?", $this->getAttribute('email') )
                            ->fetchOne();
		return $contacto;
	}
	
	/*
	* Retorna un objeto TrackingUser 
	* o null encaso que el usuario se haya logeado por ldap
	*/
	public function getTrackingUser(){
		return $this->getAttribute('trackingUser');
	}
	
	public function getUserId(){
		return $this->getAttribute('username');
	}
	
	
	
	/*
	* Añade un archivo en la lista de archivos del usuario para enviar por correo 
	* o realizar otras tareas
	*/
	public function addFile($file){		
		$userFiles=$this->getAttribute('userFiles');
		$k=count( $userFiles );
		$userFiles[$k] = $file;
		$this->setAttribute('userFiles', $userFiles );
		return $k;
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
	
	/*
	* Registra un evento para el usuario
	*/
	public function log( $event ){	
		$log = new TrackingUserLog();
		$log->setCaEmail( $this->getAttribute('email') );
		$log->setCaFchevento(date("Y-m-d H:i:s"));
		$log->setCaUrl(  $_SERVER['PATH_INFO'] );
		$log->setCaEvento($event);
		$log->setCaIpaddress( $_SERVER['REMOTE_ADDR'] );
		$log->setCaUseragent( $_SERVER['HTTP_USER_AGENT'] );
		
		$log->save();
	}
	
	
}
?>