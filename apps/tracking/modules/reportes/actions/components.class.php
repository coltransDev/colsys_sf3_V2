<?php

/**
 * reportes Components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesComponents extends sfComponents
{
    /**
    * Muestra las respuestas de los reportes
    *
    */
	public function executeListaRespuestas()
	{
		$c = new Criteria();	
		$c->add( RepStatusRespuestaPeer::CA_IDEMAIL, $this->idemail );	
		$c->add( RepStatusRespuestaPeer::CA_IDREPORTE, $this->idreporte );	
		$c->addAscendingOrderByColumn( RepStatusRespuestaPeer::CA_FCHCREADO );				
		$this->respuestas = RepStatusRespuestaPeer::doSelect( $c );
	}
	
	/**
    * Muestra la lista de reportes activos de acuerdo a la modalidad
    *
    */
	public function executeListaReportes(){
		$response = sfContext::getInstance()->getResponse();		
		$response->addJavaScript("extExtras/RowExpander",'last');
		
		if( $this->impoexpo==Constantes::IMPO ){	
			if( $this->transporte==Constantes::MARITIMO ){
				$reportes = ReportePeer::getReportesActivosImpoMaritimo( $this->getUser()->getClienteActivo() );
			}
			if( $this->transporte==Constantes::AEREO ){
				$reportes = ReportePeer::getReportesActivosImpoAereo( $this->getUser()->getClienteActivo() );
			}
		}
		
		if( $this->impoexpo==Constantes::EXPO ){				
			$reportes = ReportePeer::getReportesActivosExpo( $this->getUser()->getClienteActivo() );
		}
			
				
		
		
		$this->data=array();
		
		foreach( $reportes as $reporte ){
			if( !$reporte->getCaEtapaActual() ){
				continue;
			}
	
			if( !$reporte->esUltimaVersion() ){
				continue;
			}
			
			$status = $reporte->getUltimoStatus();
			
			if( $reporte->getCaEtapaActual() == "Cierre de Documentos" && strtotime($status->getCaFchstatus("Y-m-d") )<=strtotime(date("Y-m-d"), time()-604800 )  ){	
				$reporte->setCaEtapaActual("Carga Entregada");
				$reporte->save();
				continue;
			}
			
			
			$class= $reporte->getColorStatus();
			
			$origen = $reporte->getOrigen();
			if( $origen ){
				$origenStr = $origen->getCaCiudad();
			}else{
				$origenStr="";
			}		
			
			$destino = $reporte->getDestino();
			if( $destino ){
				$destinoStr = $destino->getCaCiudad();
			}else{
				$destinoStr="";
			}
				
			
			
		
			$actualizado = $reporte->getFchUltimoStatus("Y-m-d" );
			$status = $reporte->getTextoStatus();
						
			$proveedoresStr ="";
			$proveedores = $reporte->getProveedores();
			foreach( $proveedores as $proveedor ){
				if( $proveedoresStr ){
					$proveedoresStr.=" - ";					
				}
				$proveedoresStr.= $proveedor->getCaNombre();					
			}
			
			$this->data[] = array(
								"consecutivo"=>$reporte->getCaConsecutivo(),
								"origen"=>utf8_encode($origenStr),
								"destino"=>utf8_encode($destinoStr),
								"ETS"=>$reporte->getETS(),
								"ETA"=>$reporte->getETA(),
								"orden"=>utf8_encode($reporte->getCaOrdenClie()),
								"proveedor"=>utf8_encode( $proveedoresStr ),
								"status"=>utf8_encode($status),
								"actualizado"=>$actualizado,								
								"style"=>$reporte->getColorStatus()
							);
		}	
	}
	
		
}


?>