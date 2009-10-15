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
			if( $usuario && $usuario->getCaActivo() ){
				if( $usuario->getCaAuthmethod()=="ldap" ){
					$auth_user="cn=".$username.",o=coltrans_bog";						
					$ldap_server=sfConfig::get("app_ldap_host");
					
					if( $connect=ldap_connect($ldap_server)){						
						if(@$bind=ldap_bind($connect, $auth_user, utf8_encode($passwd))){	
												
							sfContext::getInstance()->getUser()->signInLDAP( $username );
																	
														
							return $values;
						}
						
						ldap_close($connect);           
					}
				}
				
				if( $usuario->getCaAuthmethod()=="sha1" ){
					
					if( $usuario->getCaPasswd() ){
						if(  $usuario->checkPasswd( $passwd )  ){
							sfContext::getInstance()->getUser()->signInAlternative( $username );	
							return $values;
						}						
					}else{
						//Este procedimiento se hara por unos dias mientras se recopilan las claves del colsys anterior
						
						@$dbconn = pg_connect("host=10.192.1.127 port=5432 dbname=Coltrans user=".$username." password=".$passwd );
						if( $dbconn ){
							
							$usuario->setPasswd( $passwd );
							$usuario->save();
							sfContext::getInstance()->getUser()->signInAlternative( $username );	
							pg_close( $dbconn );							
							return $values;
						}/*else{
							echo "No DB Conn";
						}*/
					}
					
				}				
			}
		}		
		throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));	
	}
}
?>