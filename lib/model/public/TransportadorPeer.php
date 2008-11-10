<?php

/**
 * Subclass for performing query and update operations on the 'tb_transporlineas' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class TransportadorPeer extends BaseTransportadorPeer
{
	public static function retrieveByTransporte( $caTransporte, $filter="" ){
		$c = new Criteria();
		$c->add( TransportadorPeer::CA_TRANSPORTE, $caTransporte );
		if( $filter ){
			$c->add( TransportadorPeer::CA_NOMBRE, "lower(".TransportadorPeer::CA_NOMBRE.") LIKE '".strtolower($filter)."%'", Criteria::CUSTOM  );
		}
		$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );		
		return TransportadorPeer::doSelect( $c );
	}
}
