<?
class StaticEmail{
	public static function sendEmail( $subject , $content, $from, $fromName , $recips, $cc=null){
		$smtp = new Swift_Connection_SMTP( sfConfig::get("app_smtp_host"), sfConfig::get("app_smtp_port") );
		$smtp->setUsername(sfConfig::get("app_smtp_user"));
		$smtp->setPassword(sfConfig::get("app_smtp_passwd"));
		
		$swift = new Swift( $smtp,  "[".sfConfig::get("app_smtp_public_ip")."]" );
		
		$mess = new Swift_Message( $subject );							
		
		//Add some "parts"  
		//Sending a multipart email decrease your spam score		
		if(isset( $content["plain"] )){				
			$mess->attach( new Swift_Message_Part(  $content["plain"] , "text/plain") );
		}
		if(isset( $content["html"] )){			
			$mess->attach( new Swift_Message_Part(  $content["html"] , "text/html") );						
		}
		//Recipients 
		$recipients = new Swift_RecipientList();	
		
		foreach( $recips as $key=>$recip ){	
																
			$recipients->addTo( $recip , $key ); 
		}
		
		// Todo log the message id and find in the SMTP log  
		$id = $mess->generateId();					
		$sender = new Swift_Address( $from, $fromName );					 
		if ($swift->send($mess,  $recipients , $sender ))
		{
			$error="";
		}
		else
		{
			$error="No se ha podido enviar el mensaje, por favor intentelo nuevamente";
		}	
		
		return $error;
					 
		//It's polite to do this when you're finished
		$swift->disconnect();
	}
}