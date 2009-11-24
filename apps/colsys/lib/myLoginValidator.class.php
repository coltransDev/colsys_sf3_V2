<?php
 
class myLoginValidator extends sfValidatorBase
{    
	public function configure($options = array(), $messages = array()){
		$this->addOption('username_field', 'username');
		$this->addOption('password_field', 'passwd');    		
		
		$this->setMessage('invalid', 'El usuario o la clave es invalida');
		
	}
  
 
	protected function doClean($values)
	{			
		$username = isset($values[$this->getOption('username_field')]) ? $values[$this->getOption('username_field')] : '';
		$passwd = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';			
		if( $username && $passwd ){
			
			$usuario = Doctrine::getTable("Usuario")->find( $username );
			if( $usuario && $usuario->checkPasswd( $passwd ) ){
				if( $usuario->getCaAuthmethod()=="ldap" ){
                    sfContext::getInstance()->getUser()->signInLDAP( $username );
                    return $values;					
				}
				
				if( $usuario->getCaAuthmethod()=="sha1" ){										                   
                    sfContext::getInstance()->getUser()->signInAlternative( $username );
                    return $values;                    
				}				
			}
		}		
		throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));	
	}
}
?>