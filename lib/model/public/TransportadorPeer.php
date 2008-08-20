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
	public static function retrieveByTransporte( $caTransporte ){
		$c = new Criteria();
		$c->add( TransportadorPeer::CA_TRANSPORTE, $caTransporte );
		$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );		
		return TransportadorPeer::doSelect( $c );
	}
}
