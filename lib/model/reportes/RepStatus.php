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

        /*
         * Si es un aviso y tiene carga embarcada no se aplica
         */
        if( $this->getCaIdetapa()=="IMETA" ){
            $c = new Criteria();
            $c->add( RepStatusPeer::CA_IDREPORTE, $this->getCaIdreporte());
            $c->add( RepStatusPeer::CA_IDETAPA, "IMCEM" );
            $count = RepStatusPeer::doCount($c);
        }else{
            $count=0;
        }

		if( $etapa && $count==0){
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
	
	public function getIntroAsunto(){
		$etapa = $this->getTrackingEtapa();
		$reporte = $this->getReporte();
		if( $etapa ){
			$asunto = $etapa->getIntroAsunto();			
		}else{
			$asunto = "";			
		}
		
		$asunto .= " Id.: ".$reporte->getCaConsecutivo()." ";	
		return $asunto;
	}
	
	public function getAsunto(){
		
		$reporte = $this->getReporte();
		
		$asunto = "";
				
		$origen = $reporte->getOrigen()->getCaCiudad();
		$destino = $reporte->getDestino()->getCaCiudad();
		$cliente = $reporte->getCliente();			
		
		if( $reporte->getCaImpoExpo()=="Importación" || $reporte->getCaImpoExpo()=="Triangulación" ){
			$proveedor = substr($reporte->getProveedoresStr(),0,130);					
			$asunto .= $proveedor." / ".$cliente." [".$origen." -> ".$destino."] ".$reporte->getCaOrdenClie();					
		}else{
			$consignatario = $reporte->getConsignatario();
			$asunto .= $consignatario." / ".$cliente." [".$origen." -> ".$destino."] ";	
		}
		return $asunto;
	}
	
	/*
	* Envia el status, generalemte se usa despues de guardar
	*/
	public function send(array $addresses=array(), array $cc=array(), array $attachments = array(),  $options=array()){
				
		$user = sfContext::getInstance()->getUser();
		
		$email = new Email();	
				
		$email->setCaUsuenvio( $user->getUserId() );
		
		$email->setCaTipo( "Envío de Status" ); 	
			
		$email->setCaIdcaso( $this->getCaIdreporte() );
		
		
		if(isset($options["from"]) && $options["from"] ){
			$email->setCaFrom( $options["from"] );
		}else{
			$email->setCaFrom( $user->getEmail() );
		}
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
			
			$repseguro = $reporte->getRepSeguro();
			if( $repseguro ){				
				$usuario = UsuarioPeer::retrieveByPk( $repseguro->getCaSeguroConf() );	
				if( $usuario ){
					$email->addCc( $usuario->getCaEmail() ); 						
				}						
			}			
		}
		
		if(isset($options["from"]) && $options["from"] ){
			$email->addCc( $options["from"] );
		}else{				
			$email->addCc( $user->getEmail() );
		}
		
		$asunto = $this->getIntroAsunto();
		if(isset($options["subject"]) && $options["subject"] ){
			$asunto.=  $options["subject"];
		}else{
			$asunto.= $this->getAsunto();
		}
						
		$email->setCaSubject( substr($asunto, 0, 250) );
				
		if( $attachments ){		
			$email->setCaAttachment( implode( "|", $attachments ) );
		}
		$etapa = $this->getTrackingEtapa();		
		if ( $reporte->getCaContinuacion() != 'N/A' ){
			if( ($etapa && $etapa->getCaDepartamento()!="OTM/DTA") || !$etapa ){
				$coordinador = UsuarioPeer::retrieveByPk( $reporte->getCaContinuacionConf() );
				if( $coordinador ){
					$email->addCc( $coordinador->getCaEmail() );
				}
			}
		}
			
		if ( $reporte->getCaColmas() == 'Sí'  ){
			$repaduana = $reporte->getRepAduana();				
			$coordinador = null;
			if( $repaduana ){
				$coordinador = UsuarioPeer::retrieveByPk($repaduana->getCaCoordinador());
				if( $coordinador ){		
					$email->addCc( $coordinador->getCaEmail() );										
				}	
			}
			
							  		   
		}
		
		sfContext::getInstance()->getRequest()->setParameter("idstatus", $this->getCaIdstatus());
		$email->setCaBodyHtml(  sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'verStatus') );				
		$email->save(); 									
		$this->setCaIdemail( $email->getCaIdemail() );
		$this->save();
		
		$email->send(); 	
		
	}
}

?>