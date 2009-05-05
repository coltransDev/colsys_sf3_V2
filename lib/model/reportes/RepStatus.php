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
		/*
		$etapa = $this->getCaEtapa();
		if(  $this->getCaFchstatus("Y-m-d")==date("Y-m-d") && $this!="Carga Embarcada" && $etapa!="ETA" && $etapa!="Orden Anulada" && $etapa!="Carga en Aeropuerto de Destino"){			
			$etapa = "nuevo";			
		}
		
		switch( $etapa ){				
			case "Pendiente de Instrucciones":
				$class = "yellow";
				break;
			case "Carga Embarcada":
				$class = "blue";
				break;
			case "ETA":
				$class = "blue";
				break;
			
			case "Carga en Tránsito a Destino":
				$class = "blue";
				break;	
			case "Orden Anulada":
				$class = "pink";
				break;
			case "nuevo":
				$class = "green";
				break;	
			case "Carga Entregada":
				$class = "orange";
				break;		
			case "Carga en Aeropuerto de Destino":
				$class = "orange";
				break;	
			case "Cierre de Documentos":
				$class = "orange";
				break;	
			case "Carga en Transito Terrestre":
				$class = "purple";
				break;			
			case "Cierre de Documentos":
				$class = "orange";
				break;	
			case "Carga en Transito Terrestre":
				$class = "purple";
				break;	
			default:				
				$class = "";
				break;
		 
		}
		return $class;*/
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
	* Retorna el texto del status de acuaerdo a la plantilla
	*/	
	public function getStatus(){		
		$resultado = "";	
		$reporte = $this->getReporte();	
		$etapa = $this->getTrackingEtapa();
			
		$txt = "";	
		if( $etapa ){
			$template = $etapa->getCaMessage();
			if( $template ){
				$txt = $this->applyTemplate( $template )."\n\n";
			}		
			
		}		
		return $txt."".$this->getCaStatus();
		/*
		switch( $this->getCaIdEtapa () ){
			case "IMCPD":				
				$txt = "La MN ".$this->getCaIdnave(). " arribó a ".$reporte->getDestino()->getCaCiudad().", el dia ".Utils::fechaMes( $this->getCaFchllegada() )." con la orden en referencia a bordo.";	
				
				
				
				if( $this->getCaStatus() ){
					$txt .="\n".ucfirst($this->getCaStatus());	
				}
				return $txt;	
				break;
		}*/
		
		/*
		switch( $this->getCaEtapa () ){			
						
			case "Carga Embarcada":	
				if( strlen( $this->getCaStatus())>6  ){
					$resultado = $this->getCaStatus();
				}else{
					if( $reporte->getCaTransporte()=="Aéreo" ){
						$resultado = "Nuestra oficina nos informa que el vuelo " . $this->getCaIdnave () . " salió ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
					if( $reporte->getCaTransporte()=="Marítimo" ){						
						$resultado = "Nuestra oficina nos informa que la MN " . $this->getCaIdnave () . " zarpò ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
				}
				
				break;	
			case "ETA":	
				if( strlen( $this->getCaStatus())>6  ){
					$resultado = $this->getCaStatus();
				}else{
					if( $reporte->getCaTransporte()=="Aéreo" ){
						$resultado = "Nuestra oficina nos informa que el vuelo " . $this->getCaIdnave () . " salió ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
					if( $reporte->getCaTransporte()=="Marítimo" ){						
						$resultado = "Nuestra oficina nos informa que la MN " . $this->getCaIdnave () . " zarpò ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
				}
				
				break;	
			case "Carga en Puerto de Destino":	
				if( strlen( $this->getCaStatus())>6  ){
					$resultado = $this->getCaStatus();
				}else{					
					if( $reporte->getCaTransporte()=="Marítimo" ){						
						$resultado = $this->getCaStatus();
					}
				}
				
				break;	
			case "Carga en Aeropuerto de Destino":	
				if( strlen( $this->getCaStatus())>6  ){
					$resultado = $this->getCaStatus();
				}else{
					if( $reporte->getCaTransporte()=="Aéreo" ){
						$resultado = "Nuestra oficina nos informa que el vuelo " . $this->getCaIdnave () . " llegó ";
						if( $this->getCaFchllegada () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchllegada ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						
					}
					
				}
				
				break;			
						
			default:			
				$resultado = $this->getCaStatus();
				break;	
		}
		return $resultado;*/
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
			case "":
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
			$proveedor = $reporte->getProveedoresStr();					
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
			$recips = explode(",",$reporte->getCaContinuacionConf());			
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){					
					$email->addCc( $recip ); 
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