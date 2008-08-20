<?php

/**
 * Subclass for performing query and update operations on the 'tb_tasaalaico' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class TasaAlaicoPeer extends BaseTasaAlaicoPeer
{
	public static function getCurrent(){			
		return TasaAlaicoPeer::getByDate( date("Y-m-d") );
	}
	
	public static function getByDate( $date ){	
		$c = new Criteria();
		$c->add(TasaAlaicoPeer::CA_FECHAINICIAL, $date, Criteria::LESS_EQUAL);  
		$c->add(TasaAlaicoPeer::CA_FECHAFINAL, $date , Criteria::GREATER_EQUAL);  
			  
  	 	$alaico = TasaAlaicoPeer::doSelectOne( $c );			
		if( $alaico ){
			return $alaico;
		}else{
			return null;
		}	
	}
}
