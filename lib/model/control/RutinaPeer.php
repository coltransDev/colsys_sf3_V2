<?php

/**
 * Subclass for performing query and update operations on the 'control.tb_rutinas' table.
 *
 * 
 *
 * @package lib.model.control
 */ 
class RutinaPeer extends BaseRutinaPeer
{
	public static function getConsecutivo(){
		$sql =  "SELECT nextval('control.tb_rutinas_id') as next";
		
		$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
	
		$stmt = $con->prepareStatement($sql);
		$rs = $stmt->executeQuery();	 
		$rs->next();
		return str_pad($rs->getString('next'), 10 ,"0",STR_PAD_LEFT );
	}
}
