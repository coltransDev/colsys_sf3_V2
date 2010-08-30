<?php

class myUser extends sfBasicSecurityUser
{
    public function getUserId(){
		return $this->getAttribute('user_id' );
	}

    public function signIn( $login ){
		$this->setAuthenticated( true );
		$this->setAttribute('user_id', $login );
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
}


