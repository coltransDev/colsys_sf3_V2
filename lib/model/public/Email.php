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
		
		
		$transport = Swift_SmtpTransport::newInstance(sfConfig::get("app_smtp_host"), sfConfig::get("app_smtp_port"))
	  ->setUsername(sfConfig::get("app_smtp_user"))
	  ->setPassword(sfConfig::get("app_smtp_passwd"));
		
		
		$mailer = Swift_Mailer::newInstance( $transport );
		
		$logger = new Swift_Plugins_Loggers_ArrayLogger();
		$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
		
		$message = Swift_Message::newInstance( $this->getCaSubject() );
				
        $message->setFrom(array( $this->getCaFrom() => $this->getCaFromname() ));
		
		if( sfConfig::get("app_smtp_debugAddress") ){
			$message->setTo(array( sfConfig::get("app_smtp_debugAddress")));
		}else{		
			if( $this->getCaAddress() ){				
				$recips = explode( ",", $this->getCaAddress() ); 		
				foreach( $recips as $key=>$recip ){		
					$recip = str_replace(" ", "", $recip );																
					$message->addTo( $recip  ); 
				}
			}	
			
			if( $this->getCaCc() ){		
				$recips = explode( ",", $this->getCaCc() ); 		
				foreach( $recips as $key=>$recip ){		
					$recip = str_replace(" ", "", $recip );																
					$message->addCc( $recip  ); 
				}		
			}
		}
		
		if( $this->getCaBodyhtml() ){
			$message->setBody($this->getCaBodyhtml(), 'text/html'); 		
		}
		
		if( $this->getCaBody() ){		
			$message->addPart( $this->getCaBody() , 'text/plain');			
		}/*else{
			$mess->attach( new Swift_Message_Part(  "«« Este mensaje está en formato HTML pero su equipo no está configurado para mostrarlo automáticamente. Active la opción HTML del menú Ver en su cliente de correo electrónico para una correcta visualización>>" , "text/plain") );
		}*/
		
		//acuse de recibo
		if( $this->getCaReadReceipt() ){			
			$message->setReadReceiptTo($this->getCaFrom());			
		}
				
		if( $this->getCaAttachment() ){
			$atchFiles = explode( "|",  $this->getCaAttachment() );
			//Attachments	
			foreach( $atchFiles as $file ){	
				if( file_exists($file) ){								
					$message->attach(Swift_Attachment::fromPath($file));							
				}
			}
		}
				
		$attachments = $this->getEmailAttachments();
		foreach( $attachments as $attachment ){	
			$fp =  $attachment->getCaContent();			
			
			$attachment = Swift_Attachment::newInstance()
				  ->setFilename(Utils::replace($attachment->getCaHeaderFile()))
				  ->setContentType( Utils::mimetype($attachment->getCaHeaderFile()) )
				  ->setBody( stream_get_contents($fp) )
				  ;				 
			$message->attach($attachment);							 
 			fclose( $fp );				 
		}
		
		try{
			$mailer->send($message);
			$this->setCaFchenvio( time() );
			$this->save();
			return true;
		}catch (Exception $e) {
			//echo 'Caught exception: ',  $e->getMessage(), "\n";			
			$file= sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."log".DIRECTORY_SEPARATOR."mail_error.log";
			$fp = fopen ($file, 'w+'); 			
			fwrite($fp, date("Y-m-d H:i:s")." email_id: ".$this->getCaIdemail()."\r\n");
			fwrite($fp, $logger->dump()."\r\n-------------------------------------------------\r\n\r\n\r\n");
			fclose ($fp); 
			
			
		}					
		return false;
		
		
	}
}
?>