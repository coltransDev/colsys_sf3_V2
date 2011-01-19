<?php

/**
 * TrackingEtapa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
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
            case "IMETT":
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