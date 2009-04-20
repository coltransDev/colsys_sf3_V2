<?php

/**
 * Subclass for performing query and update operations on the 'tb_inoclientes_sea' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class InoClientesSeaPeer extends BaseInoClientesSeaPeer
{
	public static function retrieveByOID( $oid, PropelPDO $con = null ){
		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
		$criteria->add(InoClientesSeaPeer::OID, $oid );
		
		$v = InoClientesSeaPeer::doSelectOne($criteria, $con);
		
		return $v;

	}
}
?>