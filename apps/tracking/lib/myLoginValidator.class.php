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
		
		$user = TrackingUserPeer::retrieveByPk( strtolower(trim($email)) );
		if( $user ){	
			$c = new Criteria();
			$c->add( ContactoPeer::CA_EMAIL, $user->getCaEmail() );
			$contactos = ContactoPeer::doSelect( $c );
			
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