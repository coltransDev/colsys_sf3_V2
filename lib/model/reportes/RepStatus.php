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
	/*
	* Retorna la etapa del status
	* @author: Andres Botero
	*/
	public function getEtapa(){
		return $this->getCaEtapa();
	}
	
	public function getClass(){
		
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
		return $class;
	}
	
	public function getStatus(){		
		$resultado = "";	
		$reporte = $this->getReporte();	
		
		switch( $this->getCaIdEtapa () ){
			case "IMCPD":				
				$txt = "La MN ".$this->getCaIdnave(). " arribó en ".$reporte->getDestino()->getCaCiudad().", el dia ".Utils::fechaMes( $this->getCaFchllegada() )." con la orden en referencia a bordo.";	
				
				if( $this->getCaStatus() ){
					$txt .="\n".ucfirst($this->getCaStatus());	
				}
				return $txt;	
				break;
		}
		
		
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
		return $resultado;
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
		
		if( $this->getCaIdetapa()=="IMCPD" ){		
			$inoCliente = $reporte->getInoClientesSea();		
			$subject = "Confirmación de Llegada Ref:".$inoCliente->getCaReferencia()."/".$reporte->getCaConsecutivo()." Buque:".$this->getCaIdnave();
		}else{
			$subject = "Status ".$reporte->getCaConsecutivo().". Buque:".$this->getCaIdnave();
		}
		
		
		$email->setCaSubject( $subject );
		
		
		
		
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
		
		$email->save(); 
		$email->send(); 	
		$this->setCaIdemail( $email->getCaIdemail() );
		$this->save();
	}
}

?>