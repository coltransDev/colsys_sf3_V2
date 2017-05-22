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
		//echo "auth: ". $this->getUser()->isAuthenticated();
        //exit();
        
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
                $contacto = Doctrine::getTable("Contacto")
                        ->createQuery("c")
                        ->addWhere("c.ca_email = ?", $email)
                        ->fetchOne();
                
				
				if( $contacto ){ //Manda un email de confirmacion 
					$user = Doctrine::getTable("TrackingUser")->find( $email );
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
				
						
						$contentPlain = sprintf($yml['email'], "https://".sfConfig::get("app_branding_url").$link, "http://".sfConfig::get("app_branding_url") );
						$contentHTML = sprintf(Utils::replace($yml['email']), "<a href='https://".sfConfig::get("app_branding_url").$link."'>https://".sfConfig::get("app_branding_url").$link."</a>", "<a href='http://".sfConfig::get("app_branding_url")."'>http://".sfConfig::get("app_branding_url")."</a>" );
											
						
						$from = sfConfig::get("app_branding_from");
						$fromName = sfConfig::get("app_branding_name")." - Servicio al cliente";
						$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );
																												
						//StaticEmail::sendEmail( "Activación Clave Coltrans.com.co", array("plain"=>$contentPlain,"html"=>$contentHTML), $from, $fromName, $to );
						
						
						$email = new Email();									
						$email->setCaUsuenvio( "Administrador" );	
						$email->setCaTipo( "Activación Tracking" );
						$email->setCaFrom( $from );
						$email->setCaReplyto( $from );	
						$email->setCaFromname( $fromName );
						$email->addTo( $contacto->getCaEmail() );																
						$email->setCaSubject( "Activación Clave ".sfConfig::get("app_branding_from") );
						$email->setCaBodyhtml( $contentHTML );
						$email->setCaBody( $contentPlain );			
						$email->save();
						//$email->send();																			
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
		
		
        $user = Doctrine::getTable("TrackingUser")
                ->createQuery("tu")
                ->addWhere("tu.ca_activation_code = ?", $code)
                ->fetchOne();
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
			/*if( $this->getUser()->getAttribute("request_uri") ){					
				$url = $this->getUser()->getAttribute("request_uri");					
				$this->getUser()->setAttribute("request_uri", null );                
                //exit("2");
				$this->redirect( $url );
			}else{*/
                //exit("3");
				//$this->redirect("homepage/index");
			//}
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
				/*if( $this->getUser()->getAttribute("request_uri") ){                    
                    //exit("4");
					$url = $this->getUser()->getAttribute("request_uri");					
					$this->getUser()->setAttribute("request_uri", null );
                    //exit($url);
					$this->redirect( $url );
				}else{*/
                    //exit("5");
					$this->redirect("homepage/index");
				//}		
                
                 //echo $this->getUser()->isAuthenticated();
                 //exit( "ASDDAaaa");
			}
            
               
           
		}		
        
	}	
}
?>