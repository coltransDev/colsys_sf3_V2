<?php

/**
 * Subclass for representing a row from the 'tb_brk_evento' table.
 *
 * 
 *
 * @package lib.model.aduana
 */ 
class AduanaEvento extends BaseAduanaEvento
{
	public function getEvento(){
		
		$c=new Criteria();
		$c->add( ParametroPeer::CA_CASOUSO, "CU037" );
		$c->add( ParametroPeer::CA_IDENTIFICACION, $this->getCaIdevento() );		
		$evento = ParametroPeer::doSelectOne( $c );
		if( $evento ){
			return $evento->getCaValor();
		}
		
		
	}
}
?>