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
	public function executeIndex( $request )
	{	
		if( !$this->getUser()->getAttribute("request_uri") ){
			$this->getUser()->setAttribute("request_uri", $_SERVER['REQUEST_URI'] );	
		}
		
		if($this->getUser()->isAuthenticated()){
			
			$this->redirect("homepage/index");
			
		}
					
		$this->form = new LoginForm();		
		if ($request->isMethod('post')){		
			$this->form->bind(
				array(						
						'email' => $request->getParameter('email'),
						'clave' => $request->getParameter('clave')		
					)
				); 
			if( $this->form->isValid() ){	
				//Se valido correctamente		
				$this->redirect("homepage/index");
				
			}
		}
	}
	
	
	/*
	* Determina si el correo se encuentra en la base de datos de contactos 
	* y si es asi envia un email de confirmacion
	*/
	public function executeGetPasswd( $request ){
		$this->form = new RememberPasswdForm();
		
		if ($request->isMethod('post')){	
			$this->form->bind(
				array(						
						'email' => $request->getParameter('email')							
					)
				); 
			if( $this->form->isValid() ){	
				$email = strtolower(trim($this->getRequestParameter("email")));					
				$this->forward404Unless( $email );		
				$c = new Criteria();
				$c->add( ContactoPeer::CA_EMAIL, $email );
				$contacto = ContactoPeer::doSelectOne( $c );	
				
				if( $contacto ){ //Manda un email de confirmacion 
					$user = TrackingUserPeer::retrieveByPk( $email );	
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
					if( $user->getCaBlocked() ){
						$this->setTemplate("registerNotFound");	
					}else{
						$link = "/tracking/login/activate/code/".$code ;	
						$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."login".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."email.yml";
						$yml = sfYaml::load($config);		
				
						
						$contentPlain = sprintf($yml['email'], "https://www.coltrans.com.co".$link, "http://www.coltrans.com.co" );
						$contentHTML = sprintf(Utils::replace($yml['email']), "<a href='https://www.coltrans.com.co".$link."'>https://www.coltrans.com.co".$link."</a>", "<a href='http://www.coltrans.com.co'>http://www.coltrans.com.co</a>" );
											
						
						$from = "serclientebog@coltrans.com.co";
						$fromName = "Coltrans S.A. - Servicio al cliente";
						$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );
																												
						//StaticEmail::sendEmail( "Activación Clave Coltrans.com.co", array("plain"=>$contentPlain,"html"=>$contentHTML), $from, $fromName, $to );
						
						
						$email = new Email();									
						$email->setCaUsuenvio( "Administrador" );	
						$email->setCaTipo( "Activación Tracking" );
						$email->setCaFrom( $from );
						$email->setCaReplyto( $from );	
						$email->setCaFromname( $fromName );
						$email->addTo( $contacto->getCaEmail() );																
						$email->setCaSubject( "Activación Clave Coltrans.com.co" );
						$email->setCaBodyHtml( $contentHTML );		
						$email->setCaBody( $contentPlain );			
						$email->save();
						$email->send();		
						
																			
						$this->setTemplate("register");
					}											
				}else{	
					$this->setTemplate("registerNotFound");											
				}	
			}
		}
	}
					
	
	
	
	/*
	* Verifica el link de activacion y solicita el password
	*/
	public function executeActivate( $request ){
		$code = $this->getRequestParameter( "code" );
		$this->forward404Unless( $code );
				
		$c = new Criteria();
		$c->add( TrackingUserPeer::CA_ACTIVATION_CODE , $code );		
		$user = TrackingUserPeer::doSelectOne( $c );		
		$this->forward404Unless( $user );
		
		$this->form = new ActivateForm();	
		
		if ($request->isMethod('post')){
			$this->form->bind(
				array(						
						'clave1' => $request->getParameter('clave1'),
						'clave2' => $request->getParameter('clave2')		
					)
				); 
			
			if ($this->form->isValid()){
				if( !$user->getCaBlocked() ){				
					$user->setCaActivated(true);			
					$user->setPasswd( $request->getParameter('clave1') );
					$user->save();
					//Valida el usuario y lo ingresa al sistema			
					$this->getUser()->signIn( $user );
					
									
					$this->redirect( "homepage/index" );
				}
			}
			
		}					
		//Solicita el password
		$this->user = $user;
		$this->code = $code;	
		
	}
		
	
	/*
	* Permite cerrar la sesion del usuario activo	
	*/
	public function executeSignout(){
		$this->getUser()->setClienteActivo(null);
		$this->getUser()->signOut();	 
	  	$this->redirect('login/index');
	}
	
		
	
	/*
	* Muestra el formulario inicial para que los usuarios se autentiquen usando LDAP en Novell
	*/
	public function executeNovell( $request ){
						
		if($this->getUser()->isAuthenticated()){
			if( $this->getUser()->getAttribute("request_uri") ){					
				$url = $this->getUser()->getAttribute("request_uri");					
				$this->getUser()->setAttribute("request_uri", null );
				$this->redirect( $url );
			}else{
				$this->redirect("homepage/index");
			}
		}
					
		$this->form = new LoginFormNovell();		
		if ($request->isMethod('post')){		
			$this->form->bind(
				array(						
						'username' => $request->getParameter('username'),
						'passwd' => $request->getParameter('passwd')		
					)
				); 
			if( $this->form->isValid() ){	
				//Se valido correctamente	
				
				if( $this->getUser()->getAttribute("request_uri") ){					
					$url = $this->getUser()->getAttribute("request_uri");					
					$this->getUser()->setAttribute("request_uri", null );
					$this->redirect( $url );
				}else{
					$this->redirect("homepage/index");
				}
		
			}
		}
		
		
		
		
		
	}	
}
?>