8<?php

/**
 * Email
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
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


		require_once(sfConfig::get('sf_lib_dir').'/vendor/Swift/lib/swift_init.php'); # needed due to symfony autoloader

        $result = false;
		$logFile = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."log".DIRECTORY_SEPARATOR."mail_error.log";
		$logHeader= date("Y-m-d H:i:s")." email_id: ".$this->getCaIdemail()." >> ";
		$logHeader.= "Subject: ".$this->getCaSubject()." >> ";
		$logHeader.= "To: ".$this->getCaAddress()." >> ";
		$logHeader.= "CC: ".$this->getCaCc()." >> ";

		$transport = Swift_SmtpTransport::newInstance(sfConfig::get("app_smtp_host"), sfConfig::get("app_smtp_port"));
        if( sfConfig::get("app_smtp_user") ){
            $transport->setUsername(sfConfig::get("app_smtp_user"))
                      ->setPassword(sfConfig::get("app_smtp_passwd"));
        }
		Swift_Preferences::getInstance()->setCharset('utf-8');

		$mailer = Swift_Mailer::newInstance( $transport );

		$logger = new Swift_Plugins_Loggers_ArrayLogger();
		$mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

		$message = Swift_Message::newInstance( $this->getCaSubject() );

        try{
            $message->setFrom(array( $this->getCaFrom() => $this->getCaFromname() ));
        }catch (Exception $e) {
            $event= $logHeader;
            $event.= $e->getMessage();

            Utils::writeLog($logFile , $event );
        }

        $badAddresses = array();


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

                        $badAddresses[] = $recip;
					}
				}
			}

			if( $this->getCaCc() ){
				$recips = explode( ",", $this->getCaCc() );

                $address = explode( ",", $this->getCaAddress() );

				foreach( $recips as $key=>$recip ){
					$recip = str_replace(" ", "", $recip );

                    if(!in_array($recip , $address) ){
                        try{
                            $message->addCc( $recip  );
                        }catch (Exception $e) {
                            $event= $logHeader;
                            $event.= $e->getMessage();

                            Utils::writeLog( $logFile , $event );

                            $badAddresses[] = $recip;
                        }
                    }
				}
			}
		}
        $message->setMaxLineLength(1000);
		if( $this->getCaBodyhtml() ){
			$message->setBody(utf8_encode($this->getCaBodyhtml()), 'text/html', 'utf-8' );
		}

		if( $this->getCaBody() ){
			$message->addPart( utf8_encode($this->getCaBody()) , 'text/plain', 'utf-8');
		}else{
            if( !$this->getCaBodyhtml() ){
                $message->addPart( "<< Este mensaje est� en formato HTML pero su equipo no est� configurado para mostrarlo autom�ticamente. Active la opci�n HTML del men� Ver en su cliente de correo electr�nico para una correcta visualizaci�n>>" , 'text/plain', 'iso-8859-1');
            }

		}
        
        
		//acuse de recibo
		if( $this->getCaReadreceipt() ){
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
                $file = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$file;
				if( file_exists($file) ){
					try{
						$message->attach(Swift_Attachment::fromPath($file)->setFilename(Utils::replace(basename($file))));
					}catch (Exception $e) {
						$event= $logHeader;
						$event.= $logger->dump();

						Utils::writeLog($logFile , $event );
					}
				}else{
                    $event= $logHeader;
                    $event.= "No existe el archivo: ".$file;
                    Utils::writeLog($logFile , $event );

                }
			}
		}

        
		$attachments = $this->getEmailAttachment();
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
				$event.="Failures: >> [";
                foreach( $failures as $failure ){
                    $event.= $failure."," ;
                }
				$event.="]";
				Utils::writeLog($logFile , $event );

                
			}

			$this->setCaFchenvio( date("Y-m-d H:i:s") );
			$this->save();
			$result = true;
		}catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			$event= $logHeader;
			$event.= $logger->dump();
			Utils::writeLog($logFile , $event );
		}


        if( $failures || $badAddresses ){

            $txt = "Ha ocurrido un error al enviar el mensaje a los siguientes destinatarios: ";

            if( $failures ){
                $txt.= " ".implode(",", $failures );
            }

            if( $badAddresses ){
                $txt.= " ".implode(",", $badAddresses );
            }
            
            $txt.= " \n>>>>>>> Mensaje Original".$this->getCaBody();
            $message = Swift_Message::newInstance( "Error al enviar mensaje" );
            $message->setFrom(array( "no-reply@coltrans.com.co" => "no-reply@coltrans.com.co" ));
            $message->addTo( $this->getCaFrom() );
            $message->addPart( $txt , 'text/plain', 'iso-8859-1');
            $mailer->send($message);            
           
        }
        
        return $result;
	}


    public function getDirectorioBase(){
        return EmailTable::FOLDER.DIRECTORY_SEPARATOR.$this->getCaIdemail().DIRECTORY_SEPARATOR;

    }

    public function getDirectorio(){
        return sfConfig::get("app_digitalFile_root").DIRECTORY_SEPARATOR.$this->getDirectorioBase();

    }

}