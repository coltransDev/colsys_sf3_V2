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
?>