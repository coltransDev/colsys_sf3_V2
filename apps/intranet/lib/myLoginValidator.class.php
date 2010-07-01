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
        //echo $username. $passwd;
		if( $username && $passwd ){
			
			$usuario = Doctrine::getTable("Usuario")->find( $username );
			if( $usuario && $usuario->checkPasswd( $passwd ) ){
				sfContext::getInstance()->getUser()->signIn( $username );
                return $values;					
			}
		}		
		throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));	
	}
}
?>