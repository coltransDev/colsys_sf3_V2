<?php

class TrackingEtapa extends BaseTrackingEtapa
{
	public function getIntroAsunto(){
		switch( $this->getCaIdetapa() ){
			case "IMCPD":
				$asunto = "Confirmación de Llegada";
				break;				
			case "IMCOL":
				$asunto = "Confirmación de Llegada OTM";
				break;	
			case "IACAD":
				$asunto = "Confirmación de Llegada";
				break;		
			case "IMETA":
				$asunto = "Aviso";
				break;		
			case "99999":
				$asunto = "Cierre";
				break;	
			default: 
				if( $this->getCaDepartamento()=="OTM/DTA" ){
					$asunto = "Status OTM";
				}else{
					$asunto = "Status";
				}
				break;
		} 
		
		return $asunto;
	}
}
?>