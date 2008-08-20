<?php

class myUser extends sfBasicSecurityUser
{
	public function signIn( $trackingUser )
	{ 		
		$this->setAttribute('email', $trackingUser->getCaEmail());
		$this->setAttribute('trackingUser', $trackingUser);
		$this->setAuthenticated(true);
				
		$c = new Criteria();
		$c->add( ContactoPeer::CA_IDCONTACTO, $trackingUser->getCaIdcontacto() );
		$contactos = ContactoPeer::doSelect( $c );
		
		$clientes = array();
		foreach( $contactos as $contacto ){
			$clientes[]=$contacto->getCaIdCliente();
		}
		$this->setAttribute('clientes', $clientes );		
		$this->addCredential('customer');				
				
//		$this->setAttribute('name', $employed->getName());		
		$this->setCulture('es_CO');		
	}
	
	
	public function signInNovell( $username )
	{ 		
		$this->setAttribute('username', $username );
		$this->setAuthenticated(true);
				
						
		$this->setAttribute('clientes', "*" );		
		$this->addCredential('colsys_user');				
				
//		$this->setAttribute('name', $employed->getName());		
		$this->setCulture('es_CO');		
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
			$clientes[]= ClientePeer::retrieveByPk( $clientesId );
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
		$c = new Criteria();
		$c->add( ContactoPeer::CA_EMAIL, $this->getAttribute('email') );
		$contacto = ContactoPeer::doSelectOne( $c );
		return $contacto;
	}
	
	public function getTrackingUser(){
		return $this->getAttribute('trackingUser');
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
	
}
?>