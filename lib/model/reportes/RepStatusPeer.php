<?php

/**
 * Subclass for performing query and update operations on the 'tb_repstatus' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class RepStatusPeer extends BaseRepStatusPeer
{
	public static function retrieveByIdEmail( $emailId ){
		$c = new Criteria();
		$c->add( RepStatusPeer::CA_IDEMAIL, $emailId);
		return RepStatusPeer::doSelectOne( $c );
	}
}
