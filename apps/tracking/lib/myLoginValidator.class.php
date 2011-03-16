<?php
 
class myLoginValidator extends sfValidatorBase
{    
	public function configure($options = array(), $messages = array()){
		$this->addOption('email_field', 'email');
		$this->addOption('password_field', 'clave');    		
		
		$this->setMessage('invalid', 'El correo electronico o la clave es invalida');
		
	}
  
  
 
	protected function doClean($values)
	{	
		
		$email = isset($values[$this->getOption('email_field')]) ? $values[$this->getOption('email_field')] : '';
		$password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';
		
		$user = Doctrine::getTable("TrackingUser")->find( strtolower(trim($email)) );
		if( $user ){
            $contactos = Doctrine::getTable("Contacto")
                ->createQuery("c")
                ->addWhere("c.ca_email = ?", $user->getCaEmail() )
                ->execute();
			
			if( count($contactos)>0 ){
				if ($user->checkPasswd($password)){		
					sfContext::getInstance()->getUser()->signIn( $user );	
					sfContext::getInstance()->getUser()->log("Inicio de sesion");		
					return array_merge($values, array('user' => $user));
				}
			}
		}
		
		throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));	
	}
}
?>