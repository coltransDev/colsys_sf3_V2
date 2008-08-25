<?php

/**
 * Subclass for representing a row from the 'tb_pricfletes' table.
 *
 * 
 *
 * @package lib.model.pricing
 */ 
class PricFlete extends BasePricFlete
{
	public function getPricRecargos(){
		$c = new Criteria();		
		$c->add( PricRecargoPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto() );
		return PricRecargoPeer::doSelect( $c );
		
	}
	
	public function getPricRecargosxConcepto(){
		$c = new Criteria();
		$c->add( PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->getCaIdConcepto() );
		$c->add( PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->getCaIdTrayecto() );
		return PricRecargoxConceptoPeer::doSelect( $c );
		
	}
}
