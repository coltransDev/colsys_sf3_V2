<?php
/**
 */
class CotizacionTable extends Doctrine_Table
{
    /*
	* Retorna el siguiente consecutivo para los reportes
	* @author: Andres Botero
	*/
	public static function siguienteConsecutivo( $yy , $company){
		if( $yy ){
            $sql =  "SELECT fun_cotizacioncon('".$yy."','".$company."') as next";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($sql);
			$row = $stmt->fetch();
			return $row['next'];
		}
	}

}