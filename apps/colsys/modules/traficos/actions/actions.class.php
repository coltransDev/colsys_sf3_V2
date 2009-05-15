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
	}
	

	/*
	 * Plantillas para el correo de traficos 
	 * @author: Andres Botero
	 */	
	public function executeVerStatus(){
		
		$this->status = RepStatusPeer::retrieveByPk( $this->getRequestParameter("idstatus") );		
		$this->forward404Unless( $this->status );
		$this->reporte = $this->status->getReporte();
			
		$this->setTemplate("emailDefaultStatus");	
			
		$etapa = $this->status->getTrackingEtapa();
				
		if( $etapa ){			
			if( $etapa->getCaTemplate() ){			
				$this->setTemplate($etapa->getCaTemplate());							
			}				
		} 
		
		$this->user = UsuarioPeer::retrieveByPk( $this->status->getCaUsuenvio() );
				
		$this->setLayout("email");		
		/*			
		if( $this->reporte->getCaImpoExpo()=="Exportación" ){			
			if( $this->status->getCaEtapa()=="ETA"||$this->status->getCaEtapa()=="Carga Embarcada"|| $this->status->getCaEtapa()=="Carga con Reserva" ){
				$this->setTemplate("emailAvisoExpo");					
			}
		}else{
			if( $this->reporte->getCaTransporte()=="Marítimo" ){
				if( $this->status->getCaEtapa()=="ETA" ){
					$this->setTemplate("emailAvisoImpoMaritimo");		
				}
			}else{
				if( $this->status->getCaEtapa()=="Carga Embarcada"|| $this->status->getCaEtapa()=="Carga con Reserva"  || $this->status->getCaEtapa()=="Carga en Aeropuerto de Destino" ){
					$this->setTemplate("emailAvisoImpoAereo");		
				}
			}
		}	*/
				
	}
	
	/*
	* Muestra un resumen de los status enviados al cliente
	*/
	public function executeVerHistorialStatus( $request ){
		$this->forward404Unless( $this->getRequestParameter("idreporte") );
		$this->reporte = ReportePeer::retrieveByPk( $this->getRequestParameter("idreporte") );		
		$this->forward404Unless( $this->reporte );
		$this->setLayout("popup");
	}

	/*
	 * Muestra el estado del reporte cuando un usuario hace click sobre el
	 * @author: Andres Botero
	 */
	public function executeListaReportes( $request ){
		
		$this->impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$this->transporte = utf8_decode($this->getRequestParameter("transporte"));
		$this->forward404Unless( $this->impoexpo );
		$this->forward404Unless( $this->transporte );
		
		$query = $this->getRequestParameter("query");
		$this->forward404Unless( $query );
		$data = array();
		$reportes = array();
		
		if( $query=="reporte" ){
			$c = new Criteria();
			$c->add( ReportePeer::CA_CONSECUTIVO, $this->getRequestParameter("param")  );
			$c->addDescendingOrderByColumn( ReportePeer::CA_VERSION );
			$c->setLimit( 1 );
			$reporteQuery = ReportePeer::doSelectOne( $c );			
			//Se incluyen todos los reportes del cliente  
			$idcliente = $reporteQuery->getCliente()->getCaIdcliente();
			$query = "cliente"; 
		}else{
			$idcliente = $this->getRequestParameter("param");
		}		
		
		
		switch( $query ){
			case "cliente":				
						
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
				break;	
			case "referencia":				
				$c = new Criteria();
				$c->add( InoClientesSeaPeer::CA_REFERENCIA, $this->getRequestParameter("param") );		
				$inoClientes = InoClientesSeaPeer::doSelect( $c );
				$reportes = array();
				foreach( $inoClientes as $inoCliente ){
					$reportes[] = $inoCliente->getReporte(); 
				}
				break;						
		}
		
		if( isset( $reporteQuery ) ){
			$reportes[] = $reporteQuery;
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
	
	/*
	 * Muestra el historial de los status de un reporte
	 * @author: Andres Botero
	 */
	public function executeHistorialStatus(){
		
		$consecutivo = utf8_decode($this->getRequestParameter("reporte"));		
		$this->forward404Unless( $consecutivo );	
		
		$c = new Criteria();
		$c->addJoin( RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
		$c->add( ReportePeer::CA_CONSECUTIVO, $consecutivo );	
		$statusList = RepStatusPeer::doSelect( $c );
		
		$data = array();
		foreach( $statusList as $status ){
			$data[] = array( "idemail"=>$status->getCaIdemail(),
							"status"=>utf8_encode($status->getStatus()),
							"fchstatus"=>$status->getCaFchstatus(),
							"etapa"=>utf8_encode($status->getCaEtapa())
							 );
		}	
				
		$this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);					
		$this->setLayout("ajax");
		$this->setTemplate( "responseTemplate" );	
			
	}
	
	
	/*
	* Muestra el listado de reportes sobre un campo de autocompletar 
	* @author: Andres Botero
	*/
	public function executeListaReportesJSON( $request ){
		$query = $request->getParameter( "query" );
		$c = new Criteria();	
		$c->add( ReportePeer::CA_CONSECUTIVO, $query."%", Criteria::LIKE );
		$c->addAscendingOrderByColumn( ReportePeer::CA_CONSECUTIVO );
		$c->setDistinct();	
		$c->setLimit(50);		
		$reportes = ReportePeer::doSelect( $c );
		
		$data = array();
		foreach( $reportes as $reporte ){
			$data[] = array( "consecutivo"=>$reporte->getCaConsecutivo() );
		}
		
		$this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);					
		$this->setLayout("ajax");
		$this->setTemplate( "responseTemplate" );		
		
	}
	
	/*
	* Muestra el listado de referencias sobre un campo de autocompletar 
	* @author: Andres Botero
	*/
	public function executeListaReferenciasJSON( $request ){
		$query = $request->getParameter( "query" );
		$c = new Criteria();	
		$c->add( InoMaestraSeaPeer::CA_REFERENCIA, $query."%", Criteria::LIKE );	
		$c->setLimit(50);	
		$referencias = InoMaestraSeaPeer::doSelect( $c );
		
		$data = array();
		foreach( $referencias as $referencia ){
			$data[] = array( "referencia"=>$referencia->getCaReferencia() );
		}
		
		$this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);					
		$this->setLayout("ajax");
		$this->setTemplate( "responseTemplate" );		
		
	}
	
	
	
	
}
?>