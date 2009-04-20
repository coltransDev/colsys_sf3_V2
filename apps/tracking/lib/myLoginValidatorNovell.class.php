<?php
 
class myLoginValidatorNovell extends sfValidatorBase
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
			$auth_user="cn=".$username.",o=coltrans_bog";			
			$ldap_server="10.192.1.15";
			
			if($connect=ldap_connect($ldap_server)){
				
				if(@$bind=ldap_bind($connect, $auth_user, utf8_encode($passwd))){
					sfContext::getInstance()->getUser()->signInNovell( $username );	
					return $values;
				}
				ldap_close($connect);           
			}
		}
		
		throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));	
	}
}
?>