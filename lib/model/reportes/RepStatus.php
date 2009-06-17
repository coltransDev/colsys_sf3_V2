<?php

/**
 * Subclass for representing a row from the 'tb_repstatus' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class RepStatus extends BaseRepStatus
{
	var $bodega = null;
	/*
	* Agrega una nueva propiedad en la columna ca_propiedades, según CU059 
	* @author: Andres Botero
	*/	
	public function setProperty( $param, $value ){
		$array = sfToolkit::stringToArray( $this->getCaPropiedades() );	
		$array[$param]=$value;
		$str = "";
				
		foreach( $array as $key=>$value ){
			if(strlen($str)>0){
				$str.=" ";
			}
			$str.=$key."=".$value;
		}
		$this->setCaPropiedades( $str );
	}
	
	/*
	* Retorna una propiedad
	* @author: Andres Botero
	*/	
	public function getProperty( $param ){
		$array = sfToolkit::stringToArray( $this->getCaPropiedades() );			
		return isset($array[$param])?$array[$param]:null;
	}
	
	
	/*
	* Retorna la etapa del status
	* @author: Andres Botero
	*/
	public function getEtapa(){
		return $this->getCaEtapa();
	}
	
	public function getClass(){
		$etapa = $this->getTrackingEtapa();		
		if( $etapa ){
			return $etapa->getCaClass();
		}		
	}
	
	
	/*
	* Aplica la plantilla al status 
	*/
	private function applyTemplate( $template ){
		
		$result = "";
		
		$tpl = explode(" ", $template );
			
		foreach( $tpl as $t ){
			if( $result ){
				$result.=" ";
			}
			
			if( substr($t,0,1)=="{" && substr($t,strlen($t)-1)=="}" ){
				$evalExpr = substr($t,1,strlen($t)-2);
				$evalExprArray = explode("_",$evalExpr);				
				$str = "";
				foreach( $evalExprArray as $eval ){					
					$str .= "->get".ucfirst($eval)."()";					
				}
				eval("\$result .= \$this".$str.";");				
			}else{				
				$result.=$t;
			}
		}
		
		
		return $result;		
	}
	
	/*
	* 
	*/
	public function getTxtStatus(  ){			
		$etapa = $this->getTrackingEtapa();			
		$txt = "";	
		if( $etapa ){
			$template = $etapa->getCaMessage();
			if( $template ){
				$txt = $this->applyTemplate( $template )."\n\n";
			}					
		}
		return $txt;		
	}
	
	/*
	* Aplica el texto al status
	*/
	public function setStatus( $status ){		
		
		$txt = $this->getTxtStatus();			
		if( $txt ){
			$txt.="\n";
		}
				
		$this->setCaStatus( $txt.$status );
				
	}
	
	/*
	* Retorna el texto del status de acuaerdo a la plantilla
	*/	
	public function getStatus(){				
		if( $this->getCaStatus() ){
			return $this->getCaStatus();
		}else{
			return $this->getTxtStatus();
		}
		
	}
	
	/*
	* Envia el status, generalemte se usa despues de guardar
	*/
	public function getBodega(){
		if( !$this->bodega ){			
			$idbodega = $this->getProperty("idbodega");
			if( $idbodega ){
				$this->bodega = BodegaPeer::retrieveByPk( $idbodega );			
			}
		}
		
		return $this->bodega;
	}
	
	
	/*
	* Envia el status, generalemte se usa despues de guardar
	*/
	public function send(array $addresses=array(), array $cc=array(), array $attachments = array(),  $options=array()){
				
		$user = sfContext::getInstance()->getUser();
		
		$email = new Email();	
		
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		
		$email->setCaTipo( "Envío de Status" ); 	
		
		
		$email->setCaIdcaso( $this->getCaIdreporte() );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );
		
		if( isset( $options['readreceipt'] ) && $options['readreceipt'] ){
			$email->setCaReadReceipt( true );
		}

		$email->setCaReplyto( $user->getEmail() );
				
		
		foreach( $addresses as $recip ){			
			$recip = str_replace(" ", "", $recip );			
			if( $recip ){
				$email->addTo( $recip ); 
			}
		}			
								
		
		foreach( $cc as $recip ){			
			$recip = str_replace(" ", "", $recip );			
			if( $recip ){
				$email->addCc( $recip ); 
			}
		}
		
		$reporte = $this->getReporte();
					
		if ( $reporte->getCaSeguro()=="Sí" ) {
			$email->addCc( "seguros@coltrans.com.co" ); 
		}
				
		$email->addCc( $user->getEmail() );
		
		
		$etapa = $this->getTrackingEtapa();
		
		switch( $this->getCaIdetapa() ){
			case "IMCPD":
				$asunto = "Confirmación de Llegada ";
				break;				
			case "IMCOL":
				$asunto = "Confirmación de Llegada OTM ";
				break;	
			case "IACAD":
				$asunto = "Confirmación de Llegada ";
				break;		
			case "IMETA":
				$asunto = "Aviso ";
				break;		
			case "99999":
				$asunto = "Cierre";
				break;	
			default: 
				if( $etapa && $etapa->getCaDepartamento()=="OTM/DTA" ){
					$asunto = "Status OTM ";
				}else{
					$asunto = "Status ";
				}
				break;
		} 
		
		if( $this->getCaIdetapa()=="IMCPD" ){		
			
		}else{
			
		}
		
		$origen = $reporte->getOrigen()->getCaCiudad();
		$destino = $reporte->getDestino()->getCaCiudad();
		$cliente = $reporte->getCliente();	
		if( $reporte->getCaImpoExpo()=="Importación" || $reporte->getCaImpoExpo()=="Triangulación" ){
			$proveedor = substr($reporte->getProveedoresStr(),0,130);					
			$asunto .= $proveedor." / ".$cliente." [".$origen." -> ".$destino."] Id.: ".$reporte->getCaConsecutivo();					
		}else{
			$consignatario = $reporte->getConsignatario();
			$asunto .= $consignatario." / ".$cliente." [".$origen." -> ".$destino."] Id.: ".$reporte->getCaConsecutivo();	
		}
				
		$email->setCaSubject( $asunto );
				
		if( $attachments ){		
			$email->setCaAttachment( implode( "|", $attachments ) );
		}
				
		if ( $reporte->getCaContinuacion() != 'N/A' ){
			if( ($etapa && $etapa->getCaDepartamento()!="OTM/DTA") || !$etapa ){
				$recips = explode(",",$reporte->getCaContinuacionConf());			
				foreach( $recips as $recip ){			
					$recip = str_replace(" ", "", $recip );			
					if( $recip ){					
						$email->addCc( $recip ); 
					}
				}	   
			}
		}
			
		if ( $reporte->getCaColmas() == 'Sí'  ){
			$cordinador = $reporte->getCliente()->getCoordinador(); 			 
			if( $cordinador ){			
				$email->addCc( $cordinador->getCaEmail() );				
			}		  		   
		}
		
		sfContext::getInstance()->getRequest()->setParameter("idstatus", $this->getCaIdstatus());
		$email->setCaBodyHtml(  sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'verStatus') );
		$email->setCaAddress("abotero@coltrans.com.co");
		$email->setCaCc("");
		$email->save(); 
		$email->send(); 	
		$this->setCaIdemail( $email->getCaIdemail() );
		$this->save();
	}
}

?>