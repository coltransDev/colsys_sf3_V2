<?php

/**
 * Subclass for representing a row from the 'tb_emails' table.
 *
 *  
 *
 * @package lib.model.public
 */ 
class Email extends BaseEmail
{
	/*
	* Agrega un attahcment
	* author: Andres Botero
	*/
	public function addAttachment( $file ){
		$attachmentsStr = $this->getCaAttachment();
		if( $attachmentsStr ){
			$attachmentsStr.="|";
		}
		$attachmentsStr.= $file;
		$this->setCaAttachment( $attachmentsStr );
	}		
	
	/*
	* Agrega un destinatario
	* author: Andres Botero
	*/
	public function addTo( $address ){
		$toStr = $this->getCaAddress();
		if( $toStr ){
			$toStr.=",";
		}
		$toStr.= $address;
		$this->setCaAddress( $toStr );
	}	
	
	/*
	* Agrega un cc
	* author: Andres Botero
	*/
	public function addCC( $address ){
		$ccStr = $this->getCaCc();
		if( $ccStr ){
			$ccStr.=",";
		}
		$ccStr.= $address;
		$this->setCaCc( $ccStr );
	}
	
	/*
	* Envia un correo electronico a partir de la informacion de la BD
	* author: Andres Botero
	*/			
	public function send( ){
		
		
		require_once('lib/vendor/swift/swift_init.php'); # needed due to symfony autoloader
		
		
		$logFile = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."log".DIRECTORY_SEPARATOR."mail_error.log";
		$logHeader= date("Y-m-d H:i:s")." email_id: ".$this->getCaIdemail()."\r\n";
		$logHeader.= "Subject: ".$this->getCaSubject()."\r\n";
		$logHeader.= "To: ".$this->getCaAddress()."\r\n";
		$logHeader.= "CC: ".$this->getCacc()."\r\n";
		
		$transport = Swift_SmtpTransport::newInstance(sfConfig::get("app_smtp_host"), sfConfig::get("app_smtp_port"))
	  ->setUsername(sfConfig::get("app_smtp_user"))
	  ->setPassword(sfConfig::get("app_smtp_passwd"));
		
		Swift_Preferences::getInstance()->setCharset('iso-8859-1');
		
		$mailer = Swift_Mailer::newInstance( $transport );
		
		$logger = new Swift_Plugins_Loggers_ArrayLogger();
		$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
		
		$message = Swift_Message::newInstance( $this->getCaSubject() );
				
        $message->setFrom(array( $this->getCaFrom() => $this->getCaFromname() ));
		
		
		
		if( sfConfig::get("app_smtp_debugAddress") ){			
			try{
				$message->addTo( sfConfig::get("app_smtp_debugAddress") ); 
			}catch (Exception $e) {					
				$event= $logHeader;						
				$event.= $e->getMessage();
									
				Utils::writeLog($logFile , $event );					
			}	
			
		}else{
			
			if( $this->getCaAddress() ){				
				$recips = explode( ",", $this->getCaAddress() ); 		
				foreach( $recips as $key=>$recip ){		
					$recip = str_replace(" ", "", $recip );		
					
					try{
						$message->addTo( $recip  ); 
					}catch (Exception $e) {										
						$event= $logHeader;						
						$event.= $e->getMessage();
											
						Utils::writeLog($logFile , $event );					
					}
				}
			}
			
			if( $this->getCaCc() ){		
				$recips = explode( ",", $this->getCaCc() ); 		
				foreach( $recips as $key=>$recip ){		
					$recip = str_replace(" ", "", $recip );																
								
					try{
						$message->addCc( $recip  ); 
					}catch (Exception $e) {												
						$event= $logHeader;						
						$event.= $e->getMessage();
						
						
						Utils::writeLog( $logFile , $event );					
					}
					 
				}		
			}
			
		}
		
		if( $this->getCaBodyhtml() ){			
			$message->setBody($this->getCaBodyhtml(), 'text/html', 'iso-8859-1' );		
		}
		
		if( $this->getCaBody() ){	
			$message->addPart( $this->getCaBody() , 'text/plain', 'iso-8859-1');			
		}else{
			$message->addPart( "<< Este mensaje está en formato HTML pero su equipo no está configurado para mostrarlo automáticamente. Active la opción HTML del menú Ver en su cliente de correo electrónico para una correcta visualización>>" , 'text/plain', 'iso-8859-1');				
		}
		
		//acuse de recibo
		if( $this->getCaReadReceipt() ){				
			try{
				$message->setReadReceiptTo($this->getCaFrom());	
			}catch (Exception $e) {
				//echo 'Caught exception: ',  $e->getMessage(), "\n";						
				$event= $logHeader;						
				$event.= $e->getMessage();									
				Utils::writeLog($logFile , $event );					
			}						
		}
				
		if( $this->getCaAttachment() ){
			$atchFiles = explode( "|",  $this->getCaAttachment() );
			//Attachments	
			foreach( $atchFiles as $file ){	
				if( file_exists($file) ){						
					try{
						$message->attach(Swift_Attachment::fromPath($file)->setFilename(Utils::replace(basename($file))));							
					}catch (Exception $e) {						
						$event= $logHeader;						
						$event.= $logger->dump();
											
						Utils::writeLog($logFile , $event );					
					}
				}
			}
		}
				
		$attachments = $this->getEmailAttachments();
		foreach( $attachments as $attachment ){	
			try{
				$fp =  $attachment->getCaContent();
				$attachment = Swift_Attachment::newInstance()
					  ->setFilename(Utils::replace($attachment->getCaHeaderFile()))
					  ->setContentType( Utils::mimetype($attachment->getCaHeaderFile()) )
					  ->setBody( stream_get_contents($fp) )
					  ;				 
				$message->attach($attachment);							 
				fclose( $fp );	
			}catch (Exception $e) {				
				$event= $logHeader;						
				$event.= $logger->dump();
									
				Utils::writeLog($logFile , $event );					
			}			 
		}
		
		$failures = null;
		try{
			$mailer->send($message, $failures);
			
			if( $failures ){
				$event= $logHeader;	
				$event.="Failures:\r\n";						
				$event.= var_export( $failures, true ) ;
									
				Utils::writeLog($logFile , $event );			
			}
			
			$this->setCaFchenvio( time() );
			$this->save();
			return true;
		}catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";						
			$event= $logHeader;						
			$event.= $logger->dump();								
			Utils::writeLog($logFile , $event );						
		}					
		return false;		
	}
	
	
	/*
	public function send( ){
	
		
		$smtp = new Swift_Connection_SMTP( sfConfig::get("app_smtp_host"), sfConfig::get("app_smtp_port") );
		$smtp->setUsername(sfConfig::get("app_smtp_user"));
		$smtp->setPassword(sfConfig::get("app_smtp_passwd"));
		
		$swift = new Swift( $smtp,  "[".sfConfig::get("app_smtp_public_ip")."]" );
				
		$mess = new Swift_Message( $this->getCaSubject() );							
		
		
		$this->setCaAddress("abotero@coltrans.com.co");
		$this->setCaCc("");
				
		//Add some "parts"  
		//Sending a multipart email decrease your spam score	

		if( $this->getCaBody() ){		
			$mess->attach( new Swift_Message_Part(  $this->getCaBody() , "text/plain") );
		}
		
		if( $this->getCaBodyhtml() ){
			$mess->attach( new Swift_Message_Part(  $this->getCaBodyhtml() , "text/html") );			
		}
								
		//Recipients 
		$recipients = new Swift_RecipientList();	
		
		$recips = explode( ",", $this->getCaAddress() ); 		
		foreach( $recips as $key=>$recip ){		
			$recip = str_replace(" ", "", $recip );																
			$recipients->addTo( $recip  ); 
		}
		
		$recips = explode( ",", $this->getCaCc() ); 		
		foreach( $recips as $key=>$recip ){		
			$recip = str_replace(" ", "", $recip );																
			$recipients->addCc( $recip  ); 
		}
		
			
		if( $this->getCaAttachment() ){
			$atchFiles = explode( "|",  $this->getCaAttachment() );
			//Attachments	
			foreach( $atchFiles as $file ){	
				if( file_exists($file) ){								
					$sfFile = new Swift_File($file);
					$attachment = new Swift_Message_Attachment($sfFile);		 
					$mess->attach($attachment);				
				}
			}
		}
		
		//Busca los attachments en la tabla de attachments 
		$attachments = $this->getEmailAttachments();
		foreach( $attachments as $attachment ){	
			$fp =  $attachment->getCaContent();		
			$mess->attach(new Swift_Message_Attachment( 
 							 stream_get_contents($fp), Utils::replace($attachment->getCaHeaderFile()), Utils::mimetype($attachment->getCaHeaderFile())));
 			fclose( $fp );				 
		}
		
		//acuse de recibo
		if( $this->getCaReadReceipt() ){			
			$mess->requestReadReceipt( $this->getCaFrom() );
		}
				
		// Todo log the message id and find in the SMTP log  
		$id = $mess->generateId();					
		$sender = new Swift_Address( $this->getCaFrom() , $this->getCaFromname() );					 
		if ($swift->send($mess,  $recipients , $sender ))
		{
			$error="";
			$this->setCaFchenvio( time() );
			$this->save();
		}
		else
		{
			$error="No se ha podido enviar el mensaje, por favor intentelo nuevamente";
		}	
				
		return $error;
					 
		//It's polite to do this when you're finished
		$swift->disconnect();
	}*/
	
}
?>