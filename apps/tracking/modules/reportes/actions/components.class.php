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
        $this->respuestas = Doctrine::getTable( "RepStatusRespuesta" )
                ->createQuery("r")
                ->addWhere("r.ca_idstatus=?", $this->idstatus)
                ->addOrderBy("ca_fchcreado")
                ->execute();
		
        
	}
	
	/**
    * Muestra la lista de reportes activos de acuerdo a la modalidad
    *
    */
	public function executeListaReportes(){
		$response = sfContext::getInstance()->getResponse();		
		$response->addJavaScript("extExtras/RowExpander",'last');
        $historial = sfContext::getInstance()->getRequest()->getParameter("historial");
        $this->idclienteActivo = $this->getUser()->getClienteActivo();

        //echo $this->transporte;
		$reportes = ReporteTable::getReportesActivos( $this->getUser()->getClienteActivo(), $this->impoexpo, $this->transporte, false, "", $historial );
        //echo count($reportes);
		
		$this->historial = $historial;
		$this->data=array();
		
		foreach( $reportes as $reporte ){
			if( !$reporte->getCaIdetapa() ){
				continue;
			}
	
			if( !$reporte->esUltimaVersion() ){
				continue;
			}
			
			$status = $reporte->getUltimoStatus();
			
			
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
			
						
			$proveedoresStr ="";
			$proveedores = $reporte->getProveedores();
			if( $proveedores ){
				foreach( $proveedores as $proveedor ){
					if( $proveedoresStr ){
						$proveedoresStr.=" - ";					
					}
					$proveedoresStr.= $proveedor->getCaNombre();					
				}
			}
			
			$this->data[] = array(
								"consecutivo"=>$reporte->getCaConsecutivo(),
								"origen"=>utf8_encode($origenStr),
								"destino"=>utf8_encode($destinoStr),
								"ETS"=>$status?$status->getCaFchsalida():"" ,
								"ETA"=>$status?$status->getCaFchllegada():"",
								"orden"=>utf8_encode($reporte->getCaOrdenClie()),
								"proveedor"=>utf8_encode( $proveedoresStr ),
								"status"=>$status?utf8_encode($status->getstatus()):"",
								"actualizado"=>$actualizado,								
								"style"=>$reporte->getColorStatus()
							);
		}	
	}
	
		
}


?>