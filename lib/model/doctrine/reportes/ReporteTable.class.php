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
	public static function getReportesActivos( $idCliente , $impoexpo, $transporte=null,  $query=false, $order="", $historial=false ){
        $q = Doctrine_Query::create()
                            ->from("Reporte r")
                            ->select("r.*, o.*, d.*, t.*")
                            ->innerJoin("r.Contacto c")
                            ->innerJoin("c.Cliente cl")
                            ->innerJoin("r.Origen o")
                            ->innerJoin("r.Destino d")
                            ->leftJoin("r.TrackingEtapa t")
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

		

		//TODO parametrizar
		if( $idCliente==860048626 ||$idCliente==830512518 ){ //Este cliente (Minipak) solicita especialmente que siempre la aparezcan todos los reportes del mes
			$fecha =  date("Y-m-")."01";
		}else{
			//Muestra los reportes con estado carga recogida de los ultimos 3 dias o 6 en caso de que sea lunes y 5 en caso de que sea martes
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

        if( $historial ){
            $fecha = date("Y-m-d", time()-86400*365);
        }

        $q->addWhere("r.ca_fchultstatus>=? OR (r.ca_idetapa!= ? AND r.ca_idetapa!= ?) OR r.ca_idetapa IS NULL", array($fecha, "99999", "00000"));
        
		$orderByETS =false;
        //TODO parametrizar
		
        
        
        
        $defaultOrder = false;
		switch( $order ){
			case "orden":
                $q->addOrderBy("r.ca_orden_clie");				
				break;
			default:                
                /*$q->leftJoin("r.Proveedor p ON r.ca_idproveedor=p.ca_idtercero");
                $q->addOrderBy("p.ca_nombre");*/
                $q->addOrderBy("r.ca_idproveedor");
                $q->addOrderBy("r.ca_orden_clie");
                $defaultOrder = true;
				break;

		}
        
        
		if( $query ){
			return $q;
		}else{
            $reps = $q->execute();
            
            $k=count($reps);
            $results = array();
            for( $i=0; $i<$k; $i++){
                if( $reps[$i]->esUltimaVersion() ){
                    $results[] = $reps[$i];
                }
            } 
            
            if( $defaultOrder && $idCliente!=860000615 ){
                $k=count($results);
                for( $i=1; $i<$k; $i++){                   
                    for( $j=0; $j<$k-1; $j++){
                       $prov1 = $results[$j]->getProveedoresStr();
                       $prov2 = $results[$j+1]->getProveedoresStr();
                       if( $prov1>$prov2 ){
                           $tmp = $results[$j];
                           $results[$j] = $results[$j+1];
                           $results[$j+1] = $tmp;
                       }
                    }                    
                }
            }
            
            //TODO parametrizar
            if( $idCliente==860000615 ){ //Este cliente (DISTRIBUIDORA CORDOBA) solicita que se ordene por nombre y luego por ETS
                $k=count($results);
                for( $i=1; $i<$k; $i++){                    
                    for( $j=0; $j<$k-1; $j++){
                       $prov1 = $results[$j]->getETS();
                       $prov2 = $results[$j+1]->getETS();
                       if( $prov1<$prov2 ){
                           $tmp = $results[$j];
                           $results[$j] = $results[$j+1];
                           $results[$j+1] = $tmp;
                       }
                    }                    
                }
                
                for( $i=1; $i<$k; $i++){
                    for( $j=0; $j<$k-1; $j++){                       
                       $prov1 = $results[$j]->getCaOrdenClie();
                       $prov2 = $results[$j+1]->getCaOrdenClie();
                       if( $prov1>$prov2 ){
                           $tmp = $results[$j];
                           $results[$j] = $results[$j+1];
                           $results[$j+1] = $tmp;
                       }
                       
                    }
                }                
                //Yo y mi bocota
            }
            
                        
			return $results;
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
