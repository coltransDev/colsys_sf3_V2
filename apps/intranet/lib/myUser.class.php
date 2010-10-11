<?php

class myUser extends sfBasicSecurityUser
{
    public function getUserId(){
		return $this->getAttribute('user_id' );
	}

    public function signIn( $login ){
		$this->setAuthenticated( true );
		$this->setUserId( $login );
	}
	public function signOut(){
		
        $this->setAttribute('user_id', null);
		        
			
		$this->setAuthenticated(false);		
		$this->clearCredentials();
		//session_destroy();
	}

    public function getNivelAcceso( $rutina ){
		$usuario = Doctrine::getTable('Usuario')->createQuery('u')->where('u.ca_login = ? ', $this->getUserId() )->fetchOne();
        return $usuario->getNivelAcceso( $rutina );
	}

    public function getMenu( ){
        
    }

    public function setUserId( $userId  ){
		$this->setAttribute('user_id', $userId );
		$user = Doctrine::getTable("Usuario")->find( $userId );

		if( $user ){
			//$sucursal = $user->getSucursal();
			$this->setAttribute('idsucursal',  $user->getCaIdsucursal() );
			$this->setAttribute('nombre', $user->getCaNombre());
			$this->setAttribute('email', $user->getCaEmail() );
			$this->setAttribute('cargo', $user->getCaCargo() );
			$this->setAttribute('extension', $user->getCaExtension());
            $this->setAttribute('nombres', $user->getCaNombres());
		}
    }
    
    public function getNombre(){
		return $this->getAttribute('nombre');
	}

    public function getNombres(){
		return $this->getAttribute('nombres');
	}
}