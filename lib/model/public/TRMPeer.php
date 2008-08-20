<?php
 
/**
 * Subclass for performing query and update operations on the 'tb_trms' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class TRMPeer extends BaseTRMPeer
{
	public static function getCurrent(){			
		return TRMPeer:: getByDate( date("Y-m-d") );
	}
	
	public static function getByDate( $date ){	
		$c = new Criteria();
		$c->add(TRMPeer::CA_FECHA, $date );  	  
  	 	$trm = TRMPeer::doSelectOne( $c );			
		if( $trm ){
			return $trm;
		}else{
			return null;
		}	
	}
}

?>