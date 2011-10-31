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

		
        $cliente = Doctrine::getTable("Cliente")->find( $idCliente );
        if( !$cliente ){
            $cliente = new Cliente();
        }
        
        $cierre_status_mes_completo = $cliente->getProperty("cierre_status_mes_completo");		
        
		if($cierre_status_mes_completo ){ 
			$fecha =  date("Y-m-")."01";
		}else{                       
            $dias_cierre_status = $cliente->getProperty("dias_cierre_status");
            if( $dias_cierre_status ){            
                $numDays = $dias_cierre_status;  
            }else{
                $numDays = 5;  
            }            
                       
            $today = date( "N" );

			if( $today==1 ){
				$add = ($numDays*-1)-2;

			}elseif( $today ==2 ){
				$add = ($numDays*-1)-1;
			}else{
				$add = ($numDays*-1);
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
            
            $orden_status_x_ets = $cliente->getProperty("orden_status_x_ets");
            
            if( $defaultOrder && !$orden_status_x_ets  ){ 
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
                        
            if($orden_status_x_ets ){ //Se ordena por orden y luego por ETS                
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
