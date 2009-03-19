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
	 
	public static function getAccesos(){
		return array( "-1"=>"Sin acceso", 
						"0"=>"Consulta", 
						"1"=>"Modificación",
						"2"=>"Eliminación",
						"3"=>"Ejecución"
					);
	}
							
	
	public static function getConsecutivo(){
		$sql =  "SELECT nextval('control.tb_rutinas_id') as next";
		
		$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		
		$stmt = $con->prepare($sql);
		$stmt->execute();	 	
		$row = $stmt->fetch();
		
		return str_pad($row['next'], 10 ,"0",STR_PAD_LEFT );
	}
}
?>