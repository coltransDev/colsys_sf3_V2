<?php 

/**
 * maritimo actions.
 *
 * @package    colsys
 * @subpackage maritimo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class maritimoActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{					
		$response = sfContext::getInstance()->getResponse();		
		$response->addJavaScript("extExtras/RowExpander",'last');
		
		$reportes = ReportePeer::getReportesActivosImpoMaritimo( $this->getUser()->getClienteActivo() );
		
		$this->data=array();
		
		foreach( $reportes as $reporte ){
			if( !$reporte->esUltimaVersion() ){
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
			
			$historial = $reporte->getHistorialStatus();
			
			
			if( count($historial)>0 ){			
				$ultimo = array_pop($historial);
				reset($historial);			
				$actualizado = date( "Y-m-d" , key($historial) );
				$status = $ultimo['status'];
			}else{
				$actualizado = "";
				$status = "";
			}
			
			$this->data[] = array(
								"consecutivo"=>$reporte->getCaConsecutivo(),
								"origen"=>$origenStr,
								"destino"=>$destinoStr,
								"ETS"=>$reporte->getETS(),
								"ETA"=>$reporte->getETA(),
								"orden"=>$reporte->getCaOrdenClie(),
								"proveedor"=>$reporte->getTercero()->getCaNombre(),
								"status"=>$status,
								"actualizado"=>$actualizado,								
								"style"=>$reporte->getColorStatus()
								

							);
			
		}
		
		
				
	}
	
	
	/*
	* Muestra detalles de la referencia
	*/
	
	public function executeDetailsRep(){
	
	
		/*$referencia =  $this->getRequestParameter("referencia");		
		$this->forward404Unless( $referencia );
		
		$c = new Criteria();
		$c->add( InoClientesSeaPeer::CA_REFERENCIA, $referencia );
		$c->add( InoClientesSeaPeer::CA_IDCLIENTE, $this->getUser()->getClienteActivo() );
		$this->referenciasCliente = InoClientesSeaPeer::doSelect( $c );		*/
		
		$this->user = $this->getUser();

	}
} 
?>