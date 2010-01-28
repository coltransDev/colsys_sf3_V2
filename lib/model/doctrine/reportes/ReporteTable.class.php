<?php
/**
 */
class ReporteTable extends Doctrine_Table
{
    /*
	* Retorna el siguiente consecutivo para los reportes
	* @author: Andres Botero
	*/
	public static function siguienteConsecutivo( $yy ){
		if( $yy ){
			$sql =  "SELECT fun_reportecon('".$yy."') as next";
			$q = Doctrine_Manager::getInstance()->connection();
            $stmt = $q->execute($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['next'];
		}
	}

	
	/*
	* Retorna los reportes con estado distinto a carga entregada de acuerdo aun modo (impo, expo)
	* @author: Andres Botero
	*/
	public static function getReportesActivos( $idCliente , $impoexpo, $transporte=null,  $query=false, $order="" ){
        $q = Doctrine_Query::create()
                            ->from("Reporte r")
                            ->select("r.*")
                            ->innerJoin("r.Contacto c")
                            ->innerJoin("c.Cliente cl")
                            ->where("cl.ca_idgrupo = ? OR cl.ca_idcliente = ? ", array($idCliente, $idCliente))
                            ->addWhere("r.ca_usuanulado IS NULL");


        if( $impoexpo==Constantes::IMPO ){
            $q->addWhere("r.ca_impoexpo = ? OR r.ca_impoexpo = ?", array(Constantes::IMPO, Constantes::TRIANGULACION));
        }else{
            $q->addWhere("r.ca_impoexpo = ? ", $impoexpo );
        }

        if( $transporte  ){
            $q->addWhere("r.ca_transporte = ? ", $transporte );
        }

		
		switch( $order ){
			case "orden":
                $q->addOrderBy("r.ca_orden_clie");				
				break;
			default:                
                $q->leftJoin("r.Proveedor p ON r.ca_idproveedor=p.ca_idtercero");
                $q->addOrderBy("p.ca_nombre");
                $q->addOrderBy("r.ca_orden_clie");
				break;

		}

		//TODO parametrizar
		if( $idCliente==860048626 ||$idCliente==830512518 ){ //Este cliente (Minipak) solicita especialmente que siempre la aparezcan todos los reportes del mes
			$fecha =  date("Y-m-")."01";
		}else{
			//Muetra los reportes con estado carga recogida de los ultimos 3 dias o 6 en caso de que sea lunes y 5 en caso de que sea martes
			$today = date( "N" );

			if( $today==1 ){
				$add = -7;

			}elseif( $today ==2 ){
				$add = -6;
			}else{
				$add = -5;
			}
			$fecha = Utils::addDays( date("Y-m-d"), $add );
		}

        $q->addWhere("r.ca_fchultstatus>=? OR r.ca_idetapa!= ? OR r.ca_idetapa IS NULL", array($fecha, "99999"));
		
		if( $query ){
			return $q;
		}else{
			return $q->execute();
		}
	}


	


	public static function retrieveByConsecutivo( $consecutivo ){

        $reporte = Doctrine::getTable("Reporte")
                            ->createQuery("r")
                            ->where("r.ca_consecutivo = ?", $consecutivo )
                            ->addWhere("r.ca_fchanulado IS NULL")
                            ->addOrderBy("r.ca_version DESC")
                            ->limit(1)
                            ->fetchOne();
		
		return $reporte;
		
	}
	
}