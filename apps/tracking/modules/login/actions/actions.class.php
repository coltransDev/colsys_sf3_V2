<?php

/**
 * login actions.
 *
 * @package    colsys
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class loginActions extends sfActions
{
	/**
	* Muestra el formulario solicitando login y passwd
	*
	*/
	public function executeIndex()
	{
		if($this->getUser()->isAuthenticated()){
			$this->redirect("homepage/index");
		}
	}
	
	/*
	* Toma el error que ocurrios en register y lo devuelve a la paina donde se encontraba 
	* con el mensaje de error
	*/
	public function handleErrorRegister(){
		$this->forward("login", "index");
	}
	
	/*
	* Determina si el correo se encuentra en la base de datos de contactos 
	* y si es asi envia un email de confirmacion
	*/
	public function executeRegister(){
		//Verifica que el usuario este registrado en la BD de lo contrario muestra un formulario
		//solicitando otros datos y busca un representante comercial 
		$email = strtolower(trim($this->getRequestParameter("user_email")));		
		$register = $this->getRequestParameter("register");		
		$password = $this->getRequestParameter("password");
		
		if( $email ){			
			$c = new Criteria();
			$c->add( TrackingUserPeer::CA_EMAIL, $email );
			$user = TrackingUserPeer::doSelectOne( $c );
				
			
			//Valida password si es necesario
			if( $register == "login" ){	
				if( $user ){ 										
					$passwd = sha1($user->getCaActivationCode().$this->getRequestParameter("password"));	
					if( $passwd == $user->getCaPasswd() ){		
						$this->getUser()->signIn( $user );	
						$this->redirect("homepage/index");	
					}else{
						$this->getRequest()->setError("clave_invalida", "La clave es incorrecta");
						$location = $this->getRequestParameter("location");	
						if( $location == "alreadyRegistered"){	
							$this->forward("login", "alreadyRegistered");	
						}else{
							$this->forward("login", "index");	
						}
					}
				}else{
					$this->getRequest()->setError("clave_invalida", "La clave es incorrecta");
					$this->forward("login", "index");		
									
					
				}								
			}elseif( $register == "register" ){					
				
				if( $user && $user->getCaActivated() ){
					//Muestra formulario con olvido su contrasena
					//$user-getCaBloqueado(); activado				
					
					$this->forward("login", "alreadyRegistered");
				}else{
					
					
					$c = new Criteria();
					$c->add( ContactoPeer::CA_EMAIL, $email );
					$contacto = ContactoPeer::doSelectOne( $c );		
															
					if( $contacto ){ //Manda un email de confirmacion 
						//Genera un codigo de activacion						
					
						if( !$user ){
							$user = new TrackingUser();
							$user->setCaEmail( $email );
							$user->setCaActivated( false );					
							$code = $user->generateActivationCode();						
							$user->setCaIdcontacto( $contacto->getCaIdcontacto() );						
							$user->save();
						}else{
							$code=$user->getCaActivationCode();
						}	
							
						$link = "/tracking/login/activate/code/".$code ;						
						$content = Utils::replace(" Apreciado/a ".$contacto->getCaNombres()." ".$contacto->getCaPapellido()."\n
		Gracias por utilizar el servicio de tracking and tracing de Coltrans S.A., hemos enviado este correo para activar la clave de su cuenta, por favor haga click en el enlace que se encuentra a continuación: \n");
		
						$content .= "<a href='https://".$_SERVER['HTTP_HOST'].$link."'>Haga click aca para activar su cuenta</a>";
						$content .= Utils::replace("\n						
						Si desea conocer más de este servicio por favor comuníquese con nuestro departamento de servicio al cliente\n
						Cordialmente 
						\n\n
						Coltrans S.A.					
						");	
						$from = "serclientebog@coltrans.com.co";
						$fromName = "Servicio al cliente";
						$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() ); //	echo $contacto->getCaEmail();			
																														
						StaticEmail::sendEmail( "CORREO DE ACTIVACION", $content, $from, $fromName, $to );
																					
					}else{	
						$this->setTemplate("registerNotFound");
												
					}					
				}
			}			
		}		
	}
	
	/*
	* Verifica el link de activacion y solicita el password
	*/
	public function executeActivate(){
		$code = $this->getRequestParameter( "code" );
		$this->forward404Unless( $code );
		$c = new Criteria();
		$c->add( TrackingUserPeer::CA_ACTIVATION_CODE , $code );
		$c->add( TrackingUserPeer::CA_ACTIVATED , false );
		$user = TrackingUserPeer::doSelectOne( $c );		
		$this->forward404Unless( $user );
			
		//Solicita el password
		$this->user = $user;
		$this->code = $code;	
		
	}
	
	public function executeDoActivate(){
		$code = $this->getRequestParameter( "code" );
		$this->forward404Unless( $code );
		
		$c = new Criteria();
		$c->add( TrackingUserPeer::CA_ACTIVATION_CODE , $code );
		$c->add( TrackingUserPeer::CA_ACTIVATED , false );
		$user = TrackingUserPeer::doSelectOne( $c );		
		$this->forward404Unless( $user );
		
		$passwd1 = $this->getRequestParameter("password1");
		$passwd2 = $this->getRequestParameter("password2");
		
		if( $passwd1!=$passwd2 ){
		
		}else{
			$user->setCaActivated(true);			
			$user->setPasswd( $passwd1 );
			$user->save();
			//Valida el usuario y lo ingresa al sistema			
			$this->getUser()->signIn( $user );
			$this->redirect( "homepage/index" );
		}
		
	}
	
	/*
	* Si ocurre un error reenvia a la pagina original y muestra los mensajes de error
	* @author: Andres Botero
	*/
	public function handleErrorDoActivate()
	{
		$this->forward("login","activate");
	}
	
	
	
	/*
	* Permite cerrar la sesion del usuario activo	
	*/
	public function executeSignout(){
		$this->getUser()->signOut();	 
	  	$this->redirect('login/index');
	}
	
	/*
	* SOlicita el correo electronico para asignar un nuevo passwd
	*/
	public function executeRememberPasswd(){
		
	}
	
	/*
	* Toma el error que ocurrio en register y lo devuelve a la paina donde se encontraba 
	* con el mensaje de error
	*/
	public function handleErrorRememberPasswdDo(){
		$this->forward("login", "rememberPasswd");
	}
	
	/*
	* Envia un email de confirmacion 
	*/
	public function executeRememberPasswdDo(){
		$email = strtolower(trim($this->getRequestParameter("user_email")));		
			
		if( $email ){			
			$c = new Criteria();
			$c->add( TrackingUserPeer::CA_EMAIL, $email );
			$user = TrackingUserPeer::doSelectOne( $c );
			
			if( $user ){
				$user->setCaActivated( false );
				$user->save();				
				$code=$user->getCaActivationCode();
				
				$link = "/tracking/login/activate/code/".$code ;						
				$content = Utils::replace(" Apreciado/a cliente:\n 
Gracias por utilizar el servicio de tracking and tracing de Coltrans S.A., hemos enviado este correo para activar la clave de su cuenta, por favor haga click en el enlace que se encuentra a continuación: \n");

				$content .= "<a href='https://".$_SERVER['HTTP_HOST'].$link."'>Haga click aca para activar su cuenta</a>";
				$content .= Utils::replace("\n						
				Si desea conocer más de este servicio por favor comuníquese con nuestro departamento de servicio al cliente\n
				Cordialmente 
				\n\n
				Coltrans S.A.					
				");	
								
				$from = "serclientebog@coltrans.com.co";
				$fromName = "Servicio al cliente";
				$to = array($user->getCaEmail()=>$contacto->getCaEmail()); 																													
				StaticEmail::sendEmail( "CORREO DE ACTIVACION", $content, $from, $fromName, $to );
			}else{
				// No se ha encontrado la cuenta<br />
				$this->getRequest()->setError("no_encontrada", "No se ha encontrado registrado su correo electronico");
				$this->forward("login","rememberPasswd");
			}
		}
	}
	
	
	/*
	* Muestra un formulario con la clave cuando el usuario intenta 
	* registrarse y ya lo realizo anteriormente 
	*/
	public function executeAlreadyRegistered(){
		$this->email = strtolower(trim($this->getRequestParameter("user_email")));
	}
	
	/*
	* Muestra el formulario inicial para que los usuarios se autentiquen usando LDAP en Novell
	*/
	public function executeNovell(){
		$username = $this->getRequestParameter("username");
		$passwd = $this->getRequestParameter("password");		
		if( $username && $passwd ){
			$auth_user="cn=".$username.",o=coltrans_bog";			
			$ldap_server="10.192.1.15";
			
			if($connect=ldap_connect($ldap_server)){
				
				if(@$bind=ldap_bind($connect, $auth_user, $passwd)){
					$this->getUser()->signInNovell( $username );	
					$this->redirect("homepage/index");
				}else{
					$this->getRequest()->setError("clave_invalida", "El usuario o la clave es incorrecta");
					
				}
				ldap_close($connect);           
			}
		}
	}
	
	/*
	* Si ocurre un error reenvia a la pagina original y muestra los mensajes de error
	* @author: Andres Botero
	*/
	public function handleErrorNovell()
	{
		return sfView::SUCCESS;		
	}
	
	
	
}
?>