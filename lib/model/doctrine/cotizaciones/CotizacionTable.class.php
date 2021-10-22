<?php
/**
 */
class CotizacionTable extends Doctrine_Table
{
    /*
	* Retorna el siguiente consecutivo para los reportes
	* @author: Andres Botero
	*/
	public static function siguienteConsecutivo( $yy ){
		if( $yy ){
            
            $sql =  "SELECT fun_cotizacioncon('".$yy."') as next";
            $q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($sql);
			$row = $stmt->fetch();
			return $row['next'];
		}
	}

}