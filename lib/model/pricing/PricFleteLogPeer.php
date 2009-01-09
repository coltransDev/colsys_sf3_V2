<?php

/**
 * Subclass for performing query and update operations on the 'log_pricfletes' table.
 *
 * 
 * 
 * @package lib.model.pricing
 */ 
class PricFleteLogPeer extends BasePricFleteLogPeer
{
	/*
	* Retorna el objeto PricFleteLog vigente hasta $fch
	*/
	public static function retrieveByFch( $idtrayecto, $idconcepto, $fch ){

		$c = new Criteria();
		$c->add( PricFleteLogPeer::CA_IDTRAYECTO, $idtrayecto );		
		$c->add( PricFleteLogPeer::CA_IDCONCEPTO, $idconcepto );		
		$c->add( PricFleteLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );			
		$c->addDescendingOrderByColumn( PricFleteLogPeer::CA_FCHCREADO );		
		return PricFleteLogPeer::doSelectOne( $c );
	}
}
?>