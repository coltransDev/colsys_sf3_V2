<?php
/**
 */
class InoComprobanteTable extends Doctrine_Table
{
    /*
	* Retorna el siguiente consecutivo para los comprobante
	* @author: Andres Botero
	*/
	public static function siguienteConsecutivo( $idtipo ){        
		if( $idtipo ){
			$sql =  "SELECT max(ca_consecutivo) as next FROM ino.tb_comprobantes WHERE ca_idtipo = ".$idtipo;
			$q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($sql);            
            $row = $stmt->fetch();
            
            if( $row['next'] ){
                return $row['next']+1;
            }else{
                $tipo = Doctrine::getTable("InoTipoComprobante")->find($idtipo);
                return $tipo->getCaNumeracionInicial();
            }
		}
	}

}