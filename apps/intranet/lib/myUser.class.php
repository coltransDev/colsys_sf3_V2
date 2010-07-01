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
}


