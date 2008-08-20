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
		$c->add( PricRecargoPeer::CA_IDCONCEPTO, $this->getCaIdConcepto() );
		$c->add( PricRecargoPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto() );
		return PricRecargoPeer::doSelect( $c );
		
	}
}
