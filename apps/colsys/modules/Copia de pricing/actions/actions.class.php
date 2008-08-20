<?php

/**
 * pricing actions.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pricingActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
		$this->subModMar = ParametroPeer::retrieveByCaso( "CU051");
		$this->subModAer = ParametroPeer::retrieveByCaso( "CU052");
		$this->subModTer = ParametroPeer::retrieveByCaso( "CU053");		
		
		$c = new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$this->traficos = TraficoPeer::doSelect( $c );
	}
	
	/*
	* Muestra una grilla en la que se pueden agregar, editar tarifas
	*/
	public function executePricingManagement(){
		
		$transporte = $this->getRequestParameter( "transporte" );
		
		$idtrafico = $this->getRequestParameter( "trafico_id" );
		
		$idtrafico ="DE-049";
		$transporte = "Marítimo";
		switch($transporte){
			case "Aéreo":
				$modalidad = $this->getRequestParameter( "modalidad_aer" );
				break;
			case "Marítimo":
				$modalidad = $this->getRequestParameter( "modalidad_mar" );
				break;
			case "Terrestre":
				$modalidad = $this->getRequestParameter( "modalidad_ter" );
				break;
		}
		
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );		
		$trayectos = TrayectoPeer::doSelect( $c );	
		
		
				
			
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		$conceptosArr = explode("|",$this->trafico->getCaConceptos());
		
		$c=new Criteria();		
		$c->add( ConceptoPeer::CA_TRANSPORTE, $transporte );
		$c->add( ConceptoPeer::CA_MODALIDAD, $modalidad );
		$c->add( ConceptoPeer::CA_IDCONCEPTO, $conceptosArr, Criteria::IN );
		$c->addAscendingOrderByColumn( ConceptoPeer::CA_IDCONCEPTO );			
		$this->conceptos = ConceptoPeer::doSelect( $c );
			
		//Select para las monedas
		$c=new Criteria();
		$c->addAscendingOrderByColumn( MonedaPeer::CA_IDMONEDA );
		$this->monedas = MonedaPeer::doSelect( $c );
		
		
		
		$data=array();
		
		
		
		foreach( $trayectos as $trayecto ){
			/*
			* Determina cuales conceptos deberian mostrarse de acuerdo al trafico 
			* seleccionado.		
			*/
			
			
			$trafico = TraficoPeer::retrieveByPk( $trayecto->getOrigen()->getCaIdTrafico() );
			/*
			* De la misma manera que con los conceptos se sacan los recargos
			*/
			
			$recargosArr = explode("|",$trafico->getCaRecargos());
	
			$c = new Criteria();
			$c->add( TipoRecargoPeer::CA_IDRECARGO, $recargosArr , Criteria::IN );
			$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
			$recargos = TipoRecargoPeer::doSelect( $c );
				
			
			$transportador = $trayecto->getTransportador();		
			$row = array (
				'idtrayecto' => $trayecto->getCaIdtrayecto(),
				'linea' => $transportador?$transportador->getCaNombre():"",
				'origen' => $trayecto->getOrigen()->__toString(),
				'destino' => $trayecto->getDestino()->__toString(),
				'inicio' => $trayecto->getCaFchinicio("d/m/Y"),
				'vencimiento' => $trayecto->getCaFchvencimiento("d/m/Y"),
				'moneda' => $trayecto->getCaIdMoneda(),
				'_id' => $trayecto->getCaIdtrayecto(),
				'_parent' => null,
				'_level' => 1,				
				'_is_leaf' => count($recargos)==0,
			);		
			
									 
			$pricFletes = $trayecto->getPricFletes();
	
			foreach( $pricFletes as $flete ){
				$row["concepto_".$flete->getCaIdconcepto()]=$flete->getCavlrneto();				
			}				
			$data[] = $row;
			
			
			/*
			}
			 $recargos = $flete->getPricRecargos();
				foreach( $recargos as $recargo){
					?>
					,recargo_<?=$flete->getCaIdconcepto()?>_<?=$recargo->getCaidrecargo()?>: <?=$recargo->getCaVlrrecargo()?>	
					<?
				}
			 */ 
			foreach( $recargos as $recargo){
				$data[]= array (
					'linea' => $recargo->getCaRecargo(),					
					'_id' => $trayecto->getCaIdtrayecto().$recargo->getCaidrecargo(),
					'_parent' => $trayecto->getCaIdtrayecto(),
					'_level' => 2,				
					'_is_leaf' => true,
				  );				
			}		
			
				
		}
		
		
		$this->data = $data;
		
		
	}
	
	/*
	* Observa los cambios realizados en el pricingManagement
	*/
	public function executeObservePricingManagement(){
		
		$trayecto = TrayectoPeer::retrieveByPk( $this->getRequestParameter( "id" ) );
		$this->forward404Unless( $trayecto );
		if( $this->getRequestParameter("inicio")){
			$trayecto->setCaFchinicio($this->getRequestParameter("inicio"));
		}	
		if( $this->getRequestParameter("vencimiento")){
			$trayecto->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
		}	
		if( $this->getRequestParameter("moneda")){
			$trayecto->setCaIdMoneda($this->getRequestParameter("moneda"));
		}	
		$trayecto->save();	
		print_r( $_POST );
		// Las columnas vienen en parametros de la forma concepto_{$id}
		foreach( $_POST as $key=>$value ){
			if( substr( $key, 0,8 )=="concepto" && $value ){	
				$flete_id = substr( $key, 9, 10 );
				$flete  = PricFletePeer::retrieveByPk( $trayecto->getCaIdTrayecto(), $flete_id );
				//print_r( $flete );
				if( !$flete ){
					$flete = new PricFlete();					
				}
								
				$flete->setCaIdtrayecto( $trayecto->getCaIdTrayecto() );
				$flete->setCaIdconcepto( $flete_id );
				$index = strpos($value,"/");  
				
				
				if( $index===false){
					$flete->setCaVlrneto( $value );
				}else{
					$neto = substr( $value, 0, $index );
					$minimo= substr( $value , $index+1, 10);
					$flete->setCaVlrneto( $neto );
					$flete->setCaVlrminimo( $minimo );
				}
				
				
				$flete->save();						
			}
			
			if( substr( $key, 0,7 )=="recargo" && $value ){
				$concepto_id = substr( $key, 8, 10 );	
				$index = strpos( $concepto_id , "_");				
				$recargo_id = substr($concepto_id, $index+1, 5);
				$concepto_id = substr($concepto_id, 0,$index );				
				$recargo = PricRecargoPeer::retrieveByPk( $trayecto->getCaIdTrayecto(), $concepto_id , $recargo_id);
				if( !$recargo ){
					$recargo = new PricRecargo();
					$recargo->setCaIdtrayecto( $trayecto->getCaIdTrayecto() );
					$recargo->setCaIdconcepto( $concepto_id );					
					$recargo->setCaIdrecargo( $recargo_id );											
				}	
				
				$index = strpos($value,"/");  
				
				
				if( $index===false){
					$recargo->setCaVlrrecargo( $value );
				}else{
					$neto = substr( $value, 0, $index );
					$minimo= substr( $value , $index+1, 10);
					$recargo->setCaVlrrecargo( $neto );
					$recargo->setCaVlrminimo( $minimo );
				}
							
				
				$recargo->save( );				
			}			
		}
		return sfView::NONE;
	}
	
	public function executeParametrizarConceptos(){
		$c = new Criteria();
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
		//$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		//$c->setLimit(10);
		$trayectos = TrayectoPeer::doSelect( $c );
		
		set_time_limit(0);
		
		foreach( $trayectos as $trayecto ){
			$transportador = $trayecto->getTransportador();	
			$fletes = $trayecto->getFletes();
			
	//		$trayecto->getOrigen();
			echo $ciudad."<br />";
			$ciudad = CiudadPeer::retrieveByPk( $trayecto->getCaOrigen() );
			$trafico = $ciudad->getTrafico();
			
			$conceptosStr = $trafico->getCaConceptos();
			//$conceptosStr="";
			
			$recargosStr = $trafico->getCaRecargos();
			//$recargosStr="";
			
			foreach($fletes as $flete ){
				//echo $flete->getCaIdConcepto()."<br />";
				if( $flete->getCaIdConcepto()==9999){
					continue;
				}
				
				if(strlen($conceptosStr)!=0){
					$conceptosStr.="|";
				}
				
				$conceptosStr.=$flete->getCaIdConcepto();
				
				$recargos = $flete->getRecargoFletes();
				
				foreach( $recargos as $recargo ){
					if(strlen($recargosStr)!=0){
						$recargosStr.="|";
					}
					$tipoRec = $recargo->getTipoRecargo();	
					echo "->".$tipoRec->getcaRecargo();				
					$recargosStr.= $tipoRec->getCaIdrecargo();									
				}					
			}
			/*
			$conceptosArr = explode("|",$conceptosStr);
			$conceptosArr = array_unique($conceptosArr);
			$conceptosStr=implode("|",$conceptosArr);		
			echo "<br />-->".$conceptosStr."<br />";
			$trafico->setCaConceptos($conceptosStr);
			$trafico->save();*/
			
			$recargosArr = explode("|",$recargosStr);
			$recargosArr = array_unique($recargosArr);
			$recargosStr=implode("|",$recargosArr);		
			echo "<br />-->".$recargosStr."<br />";
			$trafico->setCaRecargos($recargosStr);
			//$trafico->save();
			
			
		}		
	}
	
	
	public function executeTreeData(){
		
	}
	
	
}
?>