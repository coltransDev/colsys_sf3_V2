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
		$this->modalidades_mar = ParametroPeer::retrieveByCaso( "CU051" );
		$this->modalidades_aer = ParametroPeer::retrieveByCaso( "CU052" );
		$this->modalidades_ter = ParametroPeer::retrieveByCaso( "CU053" );
		
		
	}

	/*
	 * Muestra una grilla en la que se pueden agregar, editar tarifas
	 */
	public function executePricingManagement(){
		
		/*		
		$transporte = $this->getRequestParameter( "transporte" );
		$idtrafico = $this->getRequestParameter( "trafico_id" );

		//$idtrafico ="DE-049";
		//$transporte = "Marítimo";

		switch($transporte){
			case "Aéreo":
				$modalidad = $this->getRequestParameter( "modalidad_aer" );
				$this->linea = $this->getRequestParameter( "idaerolinea" );
				break;
			case "Marítimo":
				$modalidad = $this->getRequestParameter( "modalidad_mar" );
				$this->linea = $this->getRequestParameter( "idnaviera" );
				break;
		} 

		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );		
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		//$c->setLimit(20);
		$trayectos = TrayectoPeer::doSelect( $c );
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		$conceptosArr = explode("|",$this->trafico->getCaConceptos());
		
		$c=new Criteria();
		$c->add( ConceptoPeer::CA_TRANSPORTE, $transporte );
		$c->add( ConceptoPeer::CA_MODALIDAD, $modalidad );
		$c->add( ConceptoPeer::CA_IDCONCEPTO, $conceptosArr, Criteria::IN );
		$c->addAscendingOrderByColumn( ConceptoPeer::CA_IDCONCEPTO );
		$this->conceptos = ConceptoPeer::doSelect( $c );
			
		

		//En el caso de los recargos aéreo los recargos son generales y se colocan en las columnas
		if( $transporte=="Aéreo"){
			$recargosArr = explode("|",$this->trafico->getCaRecargos());
			$c = new Criteria();
			$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
			$c->add( TipoRecargoPeer::CA_IDRECARGO, $recargosArr, Criteria::IN );
			$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_IDRECARGO );
			$this->recargos = TipoRecargoPeer::doSelect( $c );
				
		}else{
			$this->recargos=array();
		}*/

		//$this->aplicaciones = ParametroPeer::retrieveByCaso( "CU060", null, $transporte );

		/*	
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);
		*/
		
		//Select para las monedas
		
		
	}

	/*
	 * Muestra los trayectos
	 */
	public function executePagerData(){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		$idciudad = $this->getRequestParameter( "idciudad" );

		$start = $this->getRequestParameter( "start" );
		$limit = $this->getRequestParameter( "limit" );
		
		//$idtrafico ="DE-049";
		//$idtrafico ="US-001";
		//$transporte = "Marítimo";
		//$modalidad = "FCL";
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		$conceptosArr = explode("|",$this->trafico->getCaConceptos());
					
		$this->conceptos = $this->trafico->getConceptos( $transporte, $modalidad );

		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
		
		if( $idciudad ){
			$c->add( TrayectoPeer::CA_ORIGEN, $idciudad );	
		}
		if( $idlinea ){
			$c->add( TrayectoPeer::CA_IDLINEA, $idlinea );	
		}

		$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );
		$this->total=TrayectoPeer::doCount( $c );

		$c->setLimit( $limit );
		$c->setOffset( $start );
		$trayectos = TrayectoPeer::doSelect( $c );
			

		$data=array();
		$transportador_id = null;
		foreach( $trayectos as $trayecto ){
			$transportador = $trayecto->getTransportador();
				
			/*
			 * Determina cuales conceptos deberian mostrarse de acuerdo al trafico
			 * seleccionado.
			 */
			$trafico = TraficoPeer::retrieveByPk( $trayecto->getOrigen()->getCaIdTrafico() );
			
			$row = array (
				'idtrayecto' => $trayecto->getCaIdtrayecto(),
				'trayecto' =>utf8_encode(strtoupper($trayecto->getOrigen()->getCaCiudad()))."->".utf8_encode(strtoupper($trayecto->getDestino()->getCaCiudad()))." - ".($transportador?utf8_encode($transportador->getCaNombre()):""),
				'nconcepto' => "FLETE",
			//	'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
				'inicio' => $trayecto->getCaFchinicio("d/m/Y"),
				'vencimiento' => $trayecto->getCaFchvencimiento("d/m/Y"),
				'moneda' => $trayecto->getCaIdMoneda(),
				'aplicacion' => $trayecto->getCaAplicacion(),				
				'_id' => $trayecto->getCaIdtrayecto(),
			
				'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto->getCaObservaciones()))
			);
			
			$pricFletes = $trayecto->getPricFletes();			
			
			foreach( $pricFletes as $flete ){
				$val = $flete->getCavlrneto();
				if( $flete->getCaVlrminimo() ){
					$val.="/".$flete->getCaVlrminimo();
				}					
				$row["concepto_".$flete->getCaIdconcepto()]=$val;				
			}
				
			$recAr=array();
				
			$data[] = $row;				
			
			
			/*
			 * De la misma manera que con los conceptos se sacan los recargos
			 */
			$pricRecargos = $trayecto->getPricRecargos( );
			
			foreach( $pricRecargos as $pricRecargo ){
				$tipoRecargo = $pricRecargo->getTipoRecargo();
				
				$row = array ( 
					'idtrayecto' => $trayecto->getCaIdtrayecto(),
					'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo().($tipoRecargo->getCaAplicacion()?" (".$tipoRecargo->getCaAplicacion().")":"") ),										
					'_id' => $trayecto->getCaIdtrayecto().$tipoRecargo->getCaidrecargo(),					
					'recargo_id' => $tipoRecargo->getCaIdrecargo(),
					'trayecto' =>utf8_encode(strtoupper($trayecto->getOrigen()->getCaCiudad()))."->".utf8_encode(strtoupper($trayecto->getDestino()->getCaCiudad()))." - ".($transportador?utf8_encode($transportador->getCaNombre()):"")
				    
				);
				
				$pricRecargo = PricRecargoPeer::retrieveByPk($trayecto->getCaIdtrayecto(), $tipoRecargo->getCaIdRecargo());
				if( $pricRecargo ){
					if( $pricRecargo->getCaIdmoneda() ){
						$row["moneda"]=$pricRecargo->getCaIdmoneda();
					}
					
					if( $pricRecargo->getCaObservaciones() ){
						$row["observaciones"]=utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones()));
					}	
				}				
				 
				foreach( $this->conceptos as $concepto ){
					//echo "----> ".$recAr[$concepto->getCaIdConcepto()][$recargo->getCaIdrecargo()]['moneda'];
					$pricRecargoxConcepto = PricRecargoxConceptoPeer::retrieveByPk($trayecto->getCaIdtrayecto(), $concepto->getCaidConcepto(), $tipoRecargo->getCaIdRecargo());		
							
					if($pricRecargoxConcepto){
						$val = $pricRecargoxConcepto->getCaVlrrecargo();
						if( $pricRecargoxConcepto->getCaVlrminimo() ){
							$val.="/".$pricRecargoxConcepto->getCaVlrminimo();
						}
						$row['concepto_'.$concepto->getCaIdconcepto()] = $val;
					}
										
					
					/*if( isset($recAr[$concepto->getCaIdConcepto()][$tipoRecargo->getCaIdrecargo()]) ){
						$row['concepto_'.$concepto->getCaIdconcepto()]=$recAr[$concepto->getCaIdConcepto()][$tipoRecargo->getCaIdrecargo()]['valor'];
						//$row['moneda']=$recAr[$concepto->getCaIdConcepto()][$tipoRecargo->getCaIdrecargo()]['moneda'];
					}*/
				}
				$data[]=$row;
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

		$recargo_id = $this->getRequestParameter("recargo_id");

		if( $this->getRequestParameter("inicio")){
			$trayecto->setCaFchinicio($this->getRequestParameter("inicio"));
		}
		if( $this->getRequestParameter("vencimiento")){
			$trayecto->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
		}
		if( $this->getRequestParameter("moneda") && !$recargo_id ){
			$trayecto->setCaIdMoneda($this->getRequestParameter("moneda"));
		}

		if( $this->getRequestParameter("observaciones")){
			$trayecto->setCaObservaciones($this->getRequestParameter("observaciones"));
		}

		if( $this->getRequestParameter("aplicacion")){
			$trayecto->setCaAplicacion($this->getRequestParameter("aplicacion"));
		}

		$trayecto->save();
		print_r( $_POST );

		// Las columnas vienen en parametros de la forma concepto_{$id}
		foreach( $_POST as $key=>$value ){
			if( substr( $key, 0,8 )=="concepto" && $value && !$recargo_id ){//se envió un concepto
				$concepto_id = substr( $key, 9, 10 );
				$flete  = PricFletePeer::retrieveByPk( $trayecto->getCaIdTrayecto(), $concepto_id );
				//print_r( $flete );
				if( !$flete ){
					$flete = new PricFlete();
				}

				$flete->setCaIdtrayecto( $trayecto->getCaIdTrayecto() );
				$flete->setCaIdconcepto( $concepto_id );
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
			
			if( $recargo_id ){
				$pricRecargo = PricRecargoPeer::retrieveByPk( $trayecto->getCaIdTrayecto() , $recargo_id);
				
				if( !$pricRecargo ){
					$pricRecargo = new PricRecargo();
					$pricRecargo->setCaIdTrayecto( $trayecto->getCaIdTrayecto() );
					$pricRecargo->setCaIdRecargo( $recargo_id );					
				}
						
				if( $key=="moneda" && $value  ){					
					$pricRecargo->setCaIdmoneda( $value );
				}
						
				if( $key=="observaciones" && $value  ){
					$pricRecargo->setCaObservaciones( $value );					
				}
				$pricRecargo->save();
							
				//se envió un recargo de un concepto
				if( substr( $key, 0,8 )=="concepto"  && $value ){
					$concepto_id = substr( $key, 9, 10 );
					$recargo = PricRecargoxConceptoPeer::retrieveByPk( $trayecto->getCaIdTrayecto(), $concepto_id , $recargo_id);
					if( !$recargo ){
						$recargo = new PricRecargoxConcepto();
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
					$recargo->save();
				}
			}
		}
		
		return sfView::NONE;
	}
	
	
	/*	
	* Lista todos los traficos
	* */
	public function executeListarTraficos(){
		$c = new Criteria();
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$this->traficos = TraficoPeer::doSelect( $c );		
	}
	
	/*
	* Permite consultar los distintos traficos y editar, cargar archivos, Parametrizar conceptos y recargos  
	*/
	public function executeDetallesTrafico(){
		$this->trafico = TraficoPeer::retrieveByPK($this->getRequestParameter("id_trafico"));
		$this->forward404Unless($this->trafico);
		

	}
	
	

	/*
	 * Esta funcion se va a borrar
	 */
	public function executeParametrizarConceptos(){
		$c = new Criteria();
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" );

		$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );
		$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );
		//$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		//$c->setLimit(30);
		$trayectos = TrayectoPeer::doSelect( $c );

		set_time_limit(0);

		foreach( $trayectos as $trayecto ){
				
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
				/*if( $flete->getCaIdConcepto()==9999){
					continue;
					}*/

				if(strlen($conceptosStr)!=0){
					$conceptosStr.="|";
				}

				$conceptosStr.=$flete->getCaIdConcepto();
			}
				
			$c = new Criteria();
			$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdTrayecto() );
			$recargos = RecargoFletePeer::doSelect($c);

			foreach( $recargos as $recargo ){
				if(strlen($recargosStr)!=0){
					$recargosStr.="|";
				}
				$tipoRec = $recargo->getTipoRecargo();
				echo "->".$tipoRec->getCaRecargo();
				$recargosStr.= $tipoRec->getCaIdrecargo();
			}
				
				
			$conceptosArr = explode("|",$conceptosStr);
			$conceptosArr = array_unique($conceptosArr);
			$conceptosStr=implode("|",$conceptosArr);
			echo "<br />Conceptos -->".$conceptosStr."<br />";
			$trafico->setCaConceptos($conceptosStr);
			//$trafico->save();
				
			$recargosArr = explode("|",$recargosStr);
			$recargosArr = array_unique($recargosArr);
			$recargosStr=implode("|",$recargosArr);
			echo "<br />Recargos -->".$recargosStr."<br />";
			$trafico->setCaRecargos($recargosStr);
			//$trafico->save();
				
				
		}
	}

	/*
	* Muestra las ciudades y las devuelve en forma de arbol, el cliente 
	* toma los datos y los coloca en un objeto Ext.tree.TreePanel
	* @author: Andres Botero
	*/
	public function executeDatosCiudades( $request ){
		
		$this->transporte = $this->getRequestParameter("transporte");
		$this->modalidad = $this->getRequestParameter("modalidad");
		$c = new Criteria();
		$c->addAscendingOrderByColumn( TraficoGrupoPeer::CA_DESCRIPCION );
		$this->grupos = TraficoGrupoPeer::doSelect( $c );
		
		$this->setLayout("ajax");
		
	}
	
	/*
	* Esta acción se ejecuta cuando un usuario hace click sobre la hoja del arbol 
	* seleccionando un pais, esta accion devuelve una grilla donde se colocan
	* los valores de los conceptos 
	* @author: Andres Botero
	*/
	public function executeGrillaPorTrafico( $request ){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "trafico_id" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		
		$idciudad = $this->getRequestParameter( "idciudad" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		
		//$idtrafico ="DE-049";
		//$transporte = "Marítimo";
		/*	
		switch($transporte){
			case "Aéreo":
				//$modalidad = $this->getRequestParameter( "modalidad_aer" );
				$this->linea = $this->getRequestParameter( "idaerolinea" );
				break;
			case "Marítimo":
				//$modalidad = $this->getRequestParameter( "modalidad_mar" );
				$this->linea = $this->getRequestParameter( "idnaviera" );
				break;
		} */

		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		if( $idciudad ){
			$c->add( TrayectoPeer::CA_ORIGEN, $idciudad );	
		}
		if( $idlinea ){
			$c->add( TrayectoPeer::CA_IDLINEA, $idlinea );	
		}
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );	
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );	
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		//$c->setLimit(20);
		$trayectos = TrayectoPeer::doSelect( $c );
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		$this->forward404Unless( $this->trafico );
		$this->conceptos = $this->trafico->getConceptos( $transporte, $modalidad );
		
		
		//print_r( $this->conceptos );
			
		//$this->aplicaciones = ParametroPeer::retrieveByCaso( "CU060", null, $transporte );
					
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);	
		$this->idciudad = $idciudad;
		$this->idlinea = $idlinea;
		$this->linea = "";		
		
		//$this->setLayout("ajax");
	}
	
	
	/*
	* Datos de los recargos para ser mostrados en un combobox
	*/
	public function executeDatosRecargos(){
		$c = new Criteria();
		//$c->add( TipoRecargoPeer::CA );
		$c->setLimit(3);
		$recargos = TipoRecargoPeer::doSelect( $c );
		$this->recargos = array();
		foreach( $recargos as $recargo ){
			$row = array("idrecargo"=>$recargo->getCaIdRecargo(),
						 "recargo"=>$recargo->getCaRecargo()	
						);
			$this->recargos[]=$row;
			
		}
		
		$this->setLayout("ajax");
	}
	

}
?>