<?php

/**
 * Subclass for performing query and update operations on the 'tb_cotizaciones' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class CotizacionPeer extends BaseCotizacionPeer
{
	/*
	* Retorna el siguiente consecutivo para los reportes
	* @author: Andres Botero
	*/
	public static function siguienteConsecutivo( $yy ){
		if( $yy ){
			$sql =  "SELECT fun_cotizacioncon('".$yy."') as next";			
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);		
			$stmt = $con->prepare($sql);
			$stmt->execute();	 
			$row = $stmt->fetch();
			return $row['next'];
		}
	}
}
