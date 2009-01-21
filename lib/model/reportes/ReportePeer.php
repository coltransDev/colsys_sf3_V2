<?php

/**
 * Subclass for performing query and update operations on the 'tb_reportes' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class ReportePeer extends BaseReportePeer
{
	/*
	* Retorna el siguiente consecutivo para los reportes
	* @author: Andres Botero
	*/
	public static function siguienteConsecutivo( $yy ){
		if( $yy ){
			$sql =  "SELECT fun_reportecon('".$yy."') as next";
			
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		
			$stmt = $con->prepareStatement($sql);
			$rs = $stmt->executeQuery();	 
			$rs->next();
			return $rs->getString('next');
		}
	}
	
	/*
	* Retorna los reportes en un rango de fechas de un cliente de acuerdo aun modo (impo, expo)
	* @author: Andres Botero
	*/
	public static function getReportesByDate( $modo , $fechaInicial, $fechaFinal,  $idCliente ){
		$c = new Criteria();		
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO );
		$c->addJoin( ClientePeer::CA_IDCLIENTE, ContactoPeer::CA_IDCLIENTE );	
		$c->add( ClientePeer::CA_IDGRUPO, $idCliente );
		$c->addDescendingOrderByColumn(ReportePeer::CA_FCHREPORTE);	
		$c->add( ReportePeer::CA_USUANULADO, null, Criteria::ISNULL );
		
		if( $modo=="maritimo" ){
			$c->add( ReportePeer::CA_TRANSPORTE, "Marítimo" );
		}
		
		if( $modo=="aereo" ){
			$c->add( ReportePeer::CA_TRANSPORTE, "Aéreo" );
		}
		
		if($modo=="expo" || $modo=="exportaciones" ){
			$c->add( ReportePeer::CA_IMPOEXPO, "Exportación" );
		}
		
		if($modo=="impo" || $modo=="importaciones" ){
			$c->add( ReportePeer::CA_IMPOEXPO, "Importación" );
		}
		
		$criterion = $c->getNewCriterion( ReportePeer::CA_FCHREPORTE ,$fechaInicial, Criteria::GREATER_EQUAL );								
		$criterion->addAnd($c->getNewCriterion( ReportePeer::CA_FCHREPORTE ,$fechaFinal, Criteria::LESS_EQUAL));			
		$c->add($criterion);					
		return ReportePeer::doSelect( $c );
	}
	
	/*
	* Retorna los reportes con estado distinto a carga entregada de acuerdo aun modo (impo, expo)
	* @author: Andres Botero
	*/
	public static function getReportesActivosImpoMaritimo( $idCliente , $criteria=false, $order="" ){
				
		$c = new Criteria();
		
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO, Criteria::LEFT_JOIN );	
		$c->addJoin( ReportePeer::CA_IDREPORTE, InoClientesSeaPeer::CA_IDREPORTE, Criteria::LEFT_JOIN );
		$c->addJoin( InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA, Criteria::LEFT_JOIN );			
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE, Criteria::LEFT_JOIN );
				
		$c->add( ClientePeer::CA_IDGRUPO, $idCliente );
						
		$c->add( ReportePeer::CA_TRANSPORTE, Constantes::MARITIMO );
		$c->add( ReportePeer::CA_IMPOEXPO, Constantes::IMPO );
		$c->addOr( ReportePeer::CA_IMPOEXPO, Constantes::TRIANGULACION );
								
		switch( $order ){
			case "orden":
				$c->addAscendingOrderByColumn(ReportePeer::CA_ORDEN_CLIE);	
				break;
			case "proveedor":
				$c->addJoin( ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO, Criteria::LEFT_JOIN );
				$c->addAscendingOrderByColumn(TerceroPeer::CA_NOMBRE);	
				$c->addAscendingOrderByColumn(ReportePeer::CA_ORDEN_CLIE);	
				break;
			default:
				$c->addDescendingOrderByColumn(ReportePeer::CA_FCHREPORTE);	
				break;
		}
						
		$c->add( ReportePeer::CA_USUANULADO, null, Criteria::ISNULL );
						
		$criterion = $c->getNewCriterion( ReportePeer::CA_FCHREPORTE, "2008-04-01", Criteria::GREATER_THAN ); // // Se acordo esta fecha para empezar a operar en esta modalidad		
		$criterion->addOr($c->getNewCriterion( ReportePeer::CA_FCHDESPACHO, "2008-04-01", Criteria::GREATER_THAN ));	
		$c->addAnd($criterion);						
				
		
				
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
				
		$criterion = $c->getNewCriterion( ReportePeer::CA_ETAPA_ACTUAL, null, Criteria::ISNULL );		
							
		$criterion->addOr($c->getNewCriterion( ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada", Criteria::NOT_EQUAL));
		$criterion->addOr($c->getNewCriterion( InoMaestraSeaPeer::CA_FCHCONFIRMACION, $fecha , Criteria::GREATER_EQUAL));
									
		$c->addAnd($criterion);		
		//$c->setLimit( 5 );		
		if( $criteria ){
			return $c;
		}else{			
			return ReportePeer::doSelect( $c );
		}
	}
	
	
	/*
	* Retorna los reportes con estado distinto a carga entregada de acuerdo aun modo (impo, expo)
	* @author: Andres Botero
	*/
	public static function getReportesActivosImpoAereo( $idCliente , $criteria=false, $order="" ){
				
		$c = new Criteria();
		
		$c->add( ClientePeer::CA_IDGRUPO, $idCliente );
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO, Criteria::LEFT_JOIN );	
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE, Criteria::LEFT_JOIN );
				
		
		$c->addJoin( ReportePeer::CA_CONSECUTIVO, InoClientesAirPeer::CA_IDREPORTE, Criteria::LEFT_JOIN );
		$c->addJoin( InoClientesAirPeer::CA_REFERENCIA, InoMaestraAirPeer::CA_REFERENCIA, Criteria::LEFT_JOIN );
		
		
		switch( $order ){
			case "orden":
				$c->addAscendingOrderByColumn(ReportePeer::CA_ORDEN_CLIE);	
				break;
			case "proveedor":
				$c->addJoin( ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO, Criteria::LEFT_JOIN );
				$c->addAscendingOrderByColumn(TerceroPeer::CA_NOMBRE);	
				$c->addAscendingOrderByColumn(ReportePeer::CA_ORDEN_CLIE);	
				break;
			default:
				$c->addDescendingOrderByColumn(ReportePeer::CA_FCHREPORTE);	
				break;
		}
				
		$c->add( ReportePeer::CA_USUANULADO, null, Criteria::ISNULL );
		
		$criterion = $c->getNewCriterion( ReportePeer::CA_FCHREPORTE, "2008-10-01", Criteria::GREATER_THAN ); // // Se acordo esta fecha para empezar a operar en esta modalidad			
		$criterion->addOr($c->getNewCriterion( ReportePeer::CA_FCHDESPACHO, "2008-10-01", Criteria::GREATER_THAN ));	
		$c->addAnd($criterion);					
				
		$c->add( ReportePeer::CA_TRANSPORTE, Constantes::AEREO );
		$c->add( ReportePeer::CA_IMPOEXPO, Constantes::IMPO );
		$c->addOr( ReportePeer::CA_IMPOEXPO, Constantes::TRIANGULACION );
						
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
			
		$criterion = $c->getNewCriterion( ReportePeer::CA_ETAPA_ACTUAL, null, Criteria::ISNULL );				
		$criterion->addOr($c->getNewCriterion( ReportePeer::CA_ETAPA_ACTUAL, "Carga en Aeropuerto de Destino", Criteria::NOT_EQUAL));			
		$criterion->addOr($c->getNewCriterion( InoMaestraAirPeer::CA_FCHLLEGADA, $fecha , Criteria::GREATER_EQUAL));
											
		$c->addAnd($criterion);
		if( $criteria ){
			return $c;
		}else{			
			return ReportePeer::doSelect( $c );
		}
	}
	
	
	/*
	* Retorna los reportes con estado distinto a carga entregada de acuerdo aun modo (impo, expo)
	* @author: Andres Botero
	*/
	public static function getReportesActivosExpo( $idCliente , $criteria=false, $order="" ){
				
		$c = new Criteria();
		return $c;	
		$c->add( ClientePeer::CA_IDGRUPO, $idCliente );
		$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO, Criteria::LEFT_JOIN );	
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE, Criteria::LEFT_JOIN );
				
		if( $modo=="aereo"){
			$c->addJoin( ReportePeer::CA_CONSECUTIVO, InoClientesAirPeer::CA_IDREPORTE, Criteria::LEFT_JOIN );
			$c->addJoin( InoClientesAirPeer::CA_REFERENCIA, InoMaestraAirPeer::CA_REFERENCIA, Criteria::LEFT_JOIN );
		}else{
			$c->addJoin( ReportePeer::CA_IDREPORTE, InoClientesSeaPeer::CA_IDREPORTE, Criteria::LEFT_JOIN );
			$c->addJoin( InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA, Criteria::LEFT_JOIN );
		}
		
		switch( $order ){
			case "orden":
				$c->addAscendingOrderByColumn(ReportePeer::CA_ORDEN_CLIE);	
				break;
			case "proveedor":
				$c->addJoin( ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO, Criteria::LEFT_JOIN );
				$c->addAscendingOrderByColumn(TerceroPeer::CA_NOMBRE);	
				$c->addAscendingOrderByColumn(ReportePeer::CA_ORDEN_CLIE);	
				break;
			default:
				$c->addDescendingOrderByColumn(ReportePeer::CA_FCHREPORTE);	
				break;
		}
				
		$c->add( ReportePeer::CA_USUANULADO, null, Criteria::ISNULL );
		if( $modo=="aereo"){
			$criterion = $c->getNewCriterion( ReportePeer::CA_FCHREPORTE, "2008-10-01", Criteria::GREATER_THAN ); // // Se acordo esta fecha para empezar a operar en esta modalidad			
			$criterion->addOr($c->getNewCriterion( ReportePeer::CA_FCHDESPACHO, "2008-10-01", Criteria::GREATER_THAN ));	
		$c->addAnd($criterion);					
		}else{
			$criterion = $c->getNewCriterion( ReportePeer::CA_FCHREPORTE, "2008-04-01", Criteria::GREATER_THAN ); // // Se acordo esta fecha para empezar a operar en esta modalidad		
			$criterion->addOr($c->getNewCriterion( ReportePeer::CA_FCHDESPACHO, "2008-04-01", Criteria::GREATER_THAN ));	
		$c->addAnd($criterion);						
		}
		
		
				
		if( $modo=="maritimo" ){
			$c->add( ReportePeer::CA_TRANSPORTE, "Marítimo" );
			$c->add( ReportePeer::CA_IMPOEXPO, "Importación" );
		}
		
		if( $modo=="aereo" ){
			$c->add( ReportePeer::CA_TRANSPORTE, "Aéreo" );
			$c->add( ReportePeer::CA_IMPOEXPO, "Importación" );
		}
		
		if($modo=="expo" || $modo=="exportaciones" ){
			$c->add( ReportePeer::CA_IMPOEXPO, "Exportación" );
		}
		
		if($modo=="impo" || $modo=="importaciones" ){
			$c->add( ReportePeer::CA_IMPOEXPO, "Importación" );
		}
		
		
		
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
				
		$criterion = $c->getNewCriterion( ReportePeer::CA_ETAPA_ACTUAL, null, Criteria::ISNULL );		
		if( $modo=="aereo" ){
			$criterion->addOr($c->getNewCriterion( ReportePeer::CA_ETAPA_ACTUAL, "Carga en Aeropuerto de Destino", Criteria::NOT_EQUAL));			
			$criterion->addOr($c->getNewCriterion( InoMaestraAirPeer::CA_FCHLLEGADA, $fecha , Criteria::GREATER_EQUAL));
			
		}else{						
			$criterion->addOr($c->getNewCriterion( ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada", Criteria::NOT_EQUAL));
			$criterion->addOr($c->getNewCriterion( InoMaestraSeaPeer::CA_FCHCONFIRMACION, $fecha , Criteria::GREATER_EQUAL));
		}			
									
		$c->addAnd($criterion);
		if( $criteria ){
			return $c;
		}else{			
			return ReportePeer::doSelect( $c );
		}
	}
	
	
	
	public static function retrieveByConsecutivo( $consecutivo ){
		$c = new Criteria();
		$c->add( ReportePeer::CA_CONSECUTIVO, $consecutivo );
		$reportes = ReportePeer::doSelect( $c );
		
		foreach(  $reportes as $reporte ){
			if( $reporte->esUltimaVersion() ){				
				return $reporte;
			}
		}
	
	}
	
	
}
?>