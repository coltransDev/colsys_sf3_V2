<?php

/**
 * traficos actions.
 *
 * @package    colsys
 * @subpackage traficos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class traficosActions extends sfActions
{	
	/*
	 * permite ver el estado de cada  carga asi como las notificaciones avisos, status etc
	 * author: Andres Botero
	 */
	public function executeIndex( $request ){
		$this->idCliente = $request->getParameter("idcliente");
				
		$this->impoexpo = $request->getParameter("impoexpo");
		$this->transporte = $request->getParameter("transporte");
		
		
		/*$this->ver = $this->getRequestParameter("ver");
		
		$this->reportes = array();*/
		
		/*
		switch( $this->ver ){
			case "activos":	
				$this->forward404unless( $this->modo );
				$this->forward404unless( $this->idCliente );	
				$this->fechaInicial = $this->getRequestParameter("fechaInicial");
				$this->fechaFinal = $this->getRequestParameter("fechaFinal");	
				$this->reportes = ReportePeer::getReportesActivos( $this->modo ,  $this->idCliente );
				$this->cliente = ClientePeer::retrieveByPk($this->idCliente );
				break;
			case "fecha";
				$this->forward404unless( $this->modo );
				$this->forward404unless( $this->idCliente );	
				$this->fechaInicial = $this->getRequestParameter("fechaInicial");
				$this->fechaFinal = $this->getRequestParameter("fechaFinal");				
				$this->reportes = ReportePeer::getReportesByDate( $this->modo , $this->fechaInicial, $this->fechaFinal,  $this->idCliente );
				$this->cliente = ClientePeer::retrieveByPk( $this->idCliente );
				break;
			case "reporte";
				
				$c = new Criteria();
				$c->add( ReportePeer::CA_CONSECUTIVO, "".$this->getRequestParameter("numreporte")."%" , Criteria::LIKE );
				
				if( $this->modo=="maritimo" ){
					$c->add( ReportePeer::CA_TRANSPORTE, "Marítimo" );
					$c->add( ReportePeer::CA_IMPOEXPO, "Importación" );
					$c->addOr( ReportePeer::CA_IMPOEXPO, "Triangulación" );
				}
				
				if( $this->modo=="aereo" ){
					$c->add( ReportePeer::CA_TRANSPORTE, "Aéreo" );
					$c->add( ReportePeer::CA_IMPOEXPO, "Importación" );
				}
				
				if( $this->modo=="expo" || $this->modo=="exportaciones" ){
					$c->add( ReportePeer::CA_IMPOEXPO, "Exportación" );
				}
				
				if( $this->modo=="impo" || $this->modo=="importaciones" ){
					$c->add( ReportePeer::CA_IMPOEXPO, "Importación" );
				}
								
				
				$c->addDescendingOrderByColumn(ReportePeer::CA_FCHDESPACHO );	
				$this->reportes = ReportePeer::doSelect( $c );
				
				
				break;
			default:
				$this->reportes = array();
				break;			
		}	
		*/
		
					
	}

	/*
	 * Muestra el estado del reporte cuando un usuario hace click sobre el
	 * @author: Andres Botero
	 */
	public function executeListaReportes(){
		
		$this->impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$this->transporte = utf8_decode($this->getRequestParameter("transporte"));
		$this->forward404Unless( $this->impoexpo );
		$this->forward404Unless( $this->transporte );
		
		$idcliente = $this->getRequestParameter("param");
		$data = array();
		
		$reportes=array();
		if( $this->impoexpo==Constantes::IMPO ){	
			if( $this->transporte==Constantes::MARITIMO ){
				$reportes = ReportePeer::getReportesActivosImpoMaritimo( $idcliente );
			}
			if( $this->transporte==Constantes::AEREO ){
				$reportes = ReportePeer::getReportesActivosImpoAereo($idcliente );
			}
		}
		
		
		if( $this->impoexpo==Constantes::EXPO ){				
			$reportes = ReportePeer::getReportesActivosExpo( $idcliente );
		}
		
		foreach( $reportes as $reporte ){			
			$status = $reporte->getUltimoStatus();
			$proveedoresStr = $reporte->getProveedoresStr();
			$data[]=array(
				"reporte"=>$reporte->getCaConsecutivo(),
				"class"=>$status?utf8_encode($status->getClass()):"",
				"origen"=>utf8_encode($reporte->getOrigen()->getCaCiudad()),
				"destino"=>utf8_encode($reporte->getDestino()->getCaCiudad()),
				"proveedor"=>utf8_encode($proveedoresStr),
				//"cliente"=>utf8_encode($reporte->getCliente()),
				"transporte"=>utf8_encode($reporte->getCaTransporte()),
				"modalidad"=>utf8_encode($reporte->getCaModalidad()),
				"lastUpdate"=>$status?$status->getCaFchStatus("Y-m-d" ):"",
				"status"=>$status?utf8_encode($status->getStatus()):"",
				"etapa"=>$status?utf8_encode($status->getEtapa()):"",				
				"ets"=>$status?utf8_encode($status->getCaFchsalida()):"",
				"eta"=>$status?utf8_encode($status->getCaFchllegada()):"",
				"doctransporte"=>$status?utf8_encode($status->getCaDoctransporte()):"",
				"idnave"=>$status?utf8_encode($status->getCaIdnave()):"",
				"piezas"=>$status?utf8_encode(str_replace("|", " ", $status->getCaPiezas() )):"",
				"peso"=>$status?utf8_encode(str_replace("|", " ",$status->getCaPeso())):"",
				"volumen"=>$status?utf8_encode(str_replace("|", " ",$status->getCaVolumen())):"",												
			);			
		}
		
		
		$this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);	
				
		$this->setLayout("ajax");
		$this->setTemplate( "responseTemplate" );	
	}
	
}
?>