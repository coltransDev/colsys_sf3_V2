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
		
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/myRowExpander",'last');
		$response->addJavaScript("extExtras/NumberFieldMin",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');
		
	 
		
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
		
		
		$opcion = $this->getRequestParameter( "opcion" );
		
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
			
			$trayectoStr = utf8_encode(strtoupper($trayecto->getOrigen()->getCaCiudad()))."->".utf8_encode(strtoupper($trayecto->getDestino()->getCaCiudad()))." - ".($transportador?utf8_encode($transportador->getCaSigla()?$transportador->getCaSigla():$transportador->getCaNombre()):"")." (TT ".utf8_encode($trayecto->getCaTiempotransito())." Freq. ".$trayecto->getCaFrecuencia().")";
			
			if( $opcion=="consulta" ){ // En el modo de consulta los conceptos se muestran en filas seguidos de los recargos de lo contrario los conceptos se muestran en columnas.
				
				$pricConceptos = $trayecto->getPricFletes();
				
				foreach( $pricConceptos as $pricConcepto ){
										
					$row = array (
						'idtrayecto' => $trayecto->getCaIdtrayecto(),
						'trayecto' =>$trayectoStr,
						'nconcepto' => $pricConcepto->getConcepto()->getcaConcepto(),
						//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
						'inicio' => $trayecto->getCaFchinicio("d/m/Y"),
						'vencimiento' => $trayecto->getCaFchvencimiento("d/m/Y"),
						'moneda' => $trayecto->getCaIdMoneda(),
						'aplicacion' => $trayecto->getCaAplicacion(),				
						'_id' => $trayecto->getCaIdtrayecto()."-".$pricConcepto->getCaIdConcepto(),
						'style' => $trayecto->getEstilo(),
						'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto->getCaObservaciones())),
						'tipo'=>"concepto",
						'neta'=>$pricConcepto->getCaVlrneto(),
						'minima'=>$pricConcepto->getCaVlrminimo()
						
					);
					$data[] = $row;	
										
					$pricRecargos = $pricConcepto->getPricRecargoxConceptos();
					
					foreach( $pricRecargos as $pricRecargo ){
						$tipoRecargo = $pricRecargo->getTipoRecargo();
											
						$row = array (
							'idtrayecto' => $trayecto->getCaIdtrayecto(),
							'trayecto' =>$trayectoStr,
							'nconcepto' => $tipoRecargo->getCaRecargo(),
							//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
							'inicio' => "",
							'vencimiento' => "",
							'moneda' => $trayecto->getCaIdMoneda(),
							'aplicacion' => "",				
							'_id' => $trayecto->getCaIdtrayecto()."-".$pricRecargo->getCaIdrecargo(),
							'style' => $trayecto->getEstilo(),
							'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto->getCaObservaciones())),
							'tipo'=>"recargo",
							'neta'=>$pricRecargo->getCaVlrrecargo(),
							'minima'=>$pricRecargo->getCaVlrminimo()	
						);
						
						$data[] = $row;	
					}
					
				}
				
				//print_r( $data );		
				
				
							
			}else{ // los conceptos se muestran en columnas.
						
				
				$row = array (
					'idtrayecto' => $trayecto->getCaIdtrayecto(),
					'trayecto' =>$trayectoStr,
					'nconcepto' => "FLETE",
				//	'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
					'inicio' => $trayecto->getCaFchinicio("d/m/Y"),
					'vencimiento' => $trayecto->getCaFchvencimiento("d/m/Y"),
					'moneda' => $trayecto->getCaIdMoneda(),
					'aplicacion' => $trayecto->getCaAplicacion(),				
					'_id' => $trayecto->getCaIdtrayecto(),
					'style' => $trayecto->getEstilo(),
					'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto->getCaObservaciones())),
					'tipo'=>"concepto"		
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
						'trayecto' =>$trayectoStr,
						'tipo'=>"recargo"	
						
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
											
						$pricRecargoxConcepto = PricRecargoxConceptoPeer::retrieveByPk($trayecto->getCaIdtrayecto(), $concepto->getCaidConcepto(), $tipoRecargo->getCaIdRecargo());		
								
						if($pricRecargoxConcepto){
							$val = $pricRecargoxConcepto->getCaVlrrecargo();
							if( $pricRecargoxConcepto->getCaVlrminimo() ){
								$val.="/".$pricRecargoxConcepto->getCaVlrminimo();
							}
							$row['concepto_'.$concepto->getCaIdconcepto()] = $val;
						}
						
					}
					$data[]=$row;
				}	
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
		
		if( $this->getRequestParameter("style")!==null){
			$trayecto->setEstilo($this->getRequestParameter("style"));
		}
		
		$trayecto->save();
		
		//print_r( $_POST );

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
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		
		$idciudad = $this->getRequestParameter( "idciudad" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		$idciudad = $this->getRequestParameter( "idciudad" );
		$opcion = $this->getRequestParameter( "opcion" );
		
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);		
		$this->idcomponent = $this->trafico->getCaIdTrafico()."_".$transporte."_".$modalidad;
		
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		
		if( !$idciudad && !$idlinea ){
			$this->titulo = $this->trafico->getCaNombre();
		}
		
		if( $idciudad ){			
			$c->add( TrayectoPeer::CA_ORIGEN, $idciudad );	
			$ciudad = CiudadPeer::retrieveByPk( $idciudad );
			$this->titulo = $ciudad->getCaCiudad();
			$this->idcomponent.= "_ciudad_".$idciudad;
		}
		
		if( $idlinea ){			
			$c->add( TrayectoPeer::CA_IDLINEA, $idlinea );	
			$linea = TransportadorPeer::retrieveByPk( $idlinea );
			$this->titulo = ($linea->getCaSigla()?$linea->getCaSigla():$linea->getCaNombre())." ".$this->trafico->getCaNombre();
			$this->idcomponent.= "_linea_".$idlinea;
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
		
		$this->idciudad = $idciudad;
		$this->idlinea = $idlinea;
		$this->linea = "";		
		
		
		if( $opcion=="consulta" ){
			$this->setTemplate("grillaPorTraficoConsulta");
		}
		$this->setLayout("ajax");
	}
	
	
	/*
	* Datos de los recargos para ser mostrados en un combobox
	*/
	public function executeDatosRecargos(){
	
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		
		$c = new Criteria();
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
		$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
		//$c->setLimit(3);
		$recargos = TipoRecargoPeer::doSelect( $c );
		$this->recargos = array();
		foreach( $recargos as $recargo ){
			$row = array("idrecargo"=>$recargo->getCaIdRecargo(),
						 "recargo"=>utf8_encode($recargo->getCaRecargo())	
						);
			$this->recargos[]=$row;
			
		}
		
		$this->setLayout("ajax");
	}
	
	/*
	* Datos de los conceptos para ser mostrados en un combobox
	*/
	public function executeDatosConceptos(){
		
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$modalidad = utf8_decode($this->getRequestParameter("modalidad"));
		$tipo = utf8_decode($this->getRequestParameter("tipo"));
		$modo = $this->getRequestParameter("modo");
		
		$this->forward404Unless( $transporte );
		
		if( $modo=="recargos" ){				
			$c = new Criteria();
			$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
			$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
			//$c->setLimit(3);
			$recargos = TipoRecargoPeer::doSelect( $c );
			$this->conceptos = array();
			foreach( $recargos as $recargo ){
				$row = array("idconcepto"=>$recargo->getCaIdRecargo(),
							 "concepto"=>utf8_encode($recargo->getCaRecargo())	
							);
				$this->conceptos[]=$row;
				
			}
		}else{
			$this->forward404Unless( $modalidad );
			$c = new Criteria();
			$c->add( ConceptoPeer::CA_TRANSPORTE, $transporte );
			$c->add( ConceptoPeer::CA_MODALIDAD, $modalidad );
			$c->addAscendingOrderByColumn( ConceptoPeer::CA_CONCEPTO );
			//$c->setLimit(3);
			$conceptos = ConceptoPeer::doSelect( $c );
			$this->conceptos = array();
			foreach( $conceptos as $concepto ){
				$row = array("idconcepto"=>$concepto->getCaIdConcepto(),
							 "concepto"=>utf8_encode($concepto->getCaConcepto())	
							);
				$this->conceptos[]=$row;
				
			}
		}		
		
		
		$this->setLayout("ajax");
	}
	 
	
	
	/*
	* Genera la pestaña donde se muestran los archivos 
	* @author: Andres Botero 
	*/
	public function executeArchivosPaisDatos(){
		$this->setLayout("ajax");
		$idtrafico = $this->getRequestParameter("idtrafico");
		$transporte = utf8_decode($this->getRequestParameter("transporte"));	
		$this->forward404Unless( $idtrafico );
		
		$c = new Criteria();
		$c->add(PricArchivoPeer::CA_IDTRAFICO, $idtrafico );
		$c->add(PricArchivoPeer::CA_TRANSPORTE, $transporte );		
		$c->addSelectColumn( PricArchivoPeer::CA_IDARCHIVO );
		$c->addSelectColumn( PricArchivoPeer::CA_NOMBRE );
		$c->addSelectColumn( PricArchivoPeer::CA_TAMANO );
		$c->addSelectColumn( PricArchivoPeer::CA_DESCRIPCION );
		$c->addSelectColumn( PricArchivoPeer::CA_FCHCREADO );
		$c->addSelectColumn( PricArchivoPeer::CA_USUCREADO );
		$rs= PricArchivoPeer::doSelectRS( $c );
		
		$this->data = array();
		
		while ( $rs->next() ) {
      		$this->data[] = array('idarchivo'=>$rs->getString(1),
							   	  'name'=>utf8_encode($rs->getString(2)),
								  'size'=>utf8_encode($rs->getString(3)),
								  'descripcion'=>utf8_encode($rs->getString(4)),
								  'lastmod'=>utf8_encode($rs->getString(5)),      
								  'usucreado'=>utf8_encode($rs->getString(6))
							 );
		}	
		
	} 
	
	/*
	* Procesa el archivo que se ha subido en la accion ArchivosPais 
	*/
	public function executeSubirArchivo(){
		$idtrafico = $this->getRequestParameter("idtrafico");	
		$transporte = $this->getRequestParameter("transporte");		
		$this->forward404Unless($idtrafico);			

		$fileName = $this->getRequest()->getFileName('file');
 		$path = $this->getRequest()->getFilePath('file');
		$size = $this->getRequest()->getFileSize('file');
		$type = $this->getRequest()->getFileType('file');
		
		$fileObj = new PricArchivo();
		$fileObj->setCaTamano($size);
		$fileObj->setCaNombre($fileName);
		$fileObj->setCaIdTrafico($idtrafico);	
		$fileObj->setCaTipo($type);
		$fileObj->setCaTransporte($transporte);
		$fp = fopen($path, "r");
		$data = fread( $fp , $size);
		fclose( $fp );
    	$fileObj->setCaDatos($data);
		$fileObj->setCaFchcreado(time());
		$user = $this->getUser();
		$fileObj->setCaUsucreado($user->getUserid());
		$fileObj->save();	

		
		echo "{success:true, file:'".$fileName."', id:".$fileObj->getCaIdArchivo()."}";
		exit();		
	}	
	
	/*
	* Permite visualizar un archivo del panel 
	*/
	public function executeVerArchivo(){
		$this->archivo = PricArchivoPeer::retrieveByPk( $this->getRequestParameter("idarchivo") );
		$this->forward404Unless( $this->archivo );
		$this->getResponse()->addHttpMeta('content-type', $this->archivo->getCaTipo());
    	$this->getResponse()->addHttpMeta('content-length', $this->archivo->getCaTamano());		
	}
	
	/*
	* Permite borrar el archivo  
	*/
	public function executeBorrarArchivo(){
		$this->archivo = PricArchivoPeer::retrieveByPk( $this->getRequestParameter("idarchivo") );
		$this->forward404Unless( $this->archivo );
		$this->archivo->delete(); 
		return sfView::NONE;
	}
	
	/*
	* Recargos generales de un pais 
	*/
	public function executeRecargosGenerales(){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);		
		$this->idcomponent = $this->trafico->getCaIdTrafico()."_".$transporte."_".$modalidad;				
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
			
		$c = new Criteria();
		$c->addJoin( PricRecargosxCiudadPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );		
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );				 
		$c->setDistinct();	
		$recargosCiudad = PricRecargosxCiudadPeer::doSelect( $c );
		$this->recargosArray=array();
		foreach( $recargosCiudad as $rec ){
			$this->recargosArray[]=$rec->getCaIdRecargo(); 	
		}		
		$this->setLayout("ajax");
	}
	
	/*
	* Provee datos para los recargos por ciudad
	*/
	public function executeRecargosGeneralesData(){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
			
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );		
		$c->add( CiudadPeer::CA_IDTRAFICO, $this->trafico->getCaIdTrafico() );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );	 
		$c->setDistinct();	
		$ciudades = CiudadPeer::doSelect( $c );
		
		$this->data = array();
				
		foreach( $ciudades as $ciudad ){
			$row = array("idciudad"=>$ciudad->getCaIdCiudad(),
						 "ciudad"=>utf8_encode($ciudad->getCaCiudad()));
			
			$c = new Criteria();				
			$c->add( PricRecargosxCiudadPeer::CA_IDCIUDAD, $ciudad->getCaIdCiudad());				
			$recargosCiudad = PricRecargosxCiudadPeer::doSelect( $c );			 
			foreach( $recargosCiudad as $recargoCiudad){
				$row["recargo_".$recargoCiudad->getCaIdRecargo()]=$recargoCiudad->getCaVlrrecargo();
				if( $recargoCiudad->getCaVlrminimo() ){
					$row["recargo_".$recargoCiudad->getCaIdRecargo()].="/".$recargoCiudad->getCaVlrminimo();
				}
			}	
						 	
			$this->data[]= $row;
		}		
		$this->transporte = $transporte;
		$this->modalidad = $modalidad;
		
		$this->setLayout("ajax");
	}
	
	/*
	* Guarda los cambios realizados en los recargos generales
	*/
	public function executeObserveRecargosGenerales(){
		
		$idciudad = $this->getRequestParameter("idciudad");
		$this->forward404Unless( $idciudad );
		//print_r( $_POST  );
		foreach( $_POST as $key=>$value ){
			if( substr( $key, 0,7 )=="recargo" && $value ){
				$idrecargo = substr($key, 8,10);
			
				$recargo = PricRecargosxCiudadPeer::retrieveByPk( $idciudad, $idrecargo );
				if( !$recargo ){
					$recargo = new PricRecargosxCiudad();
					$recargo->setCaIdCiudad( $idciudad );
					$recargo->setCaIdRecargo( $idrecargo );
				}	
				
				$index = strpos($value,"/");
				
				if( $index===false){
					$recargo->setCaVlrrecargo( $value );
				}else{
					$vlr = substr( $value, 0, $index );
					$minimo= substr( $value , $index+1, 10);					
					$recargo->setCaVlrrecargo( $vlr );
					$recargo->setCaVlrminimo( $minimo );
				}						
				$recargo->save();
			}	
		}
		return sfView::NONE;	
	}
		
	/*
	* Acciones del panel de notificaciones
	*/
	public function executeGuardarNotificacion(){
		$titulo=$this->getRequestParameter("titulo");
		$mensaje=$this->getRequestParameter("mensaje");
		$caducidad=$this->getRequestParameter("caducidad");
		
		$user = $this->getUser();
		
		$notificacion = new PricNotificacion();
		$notificacion->setCaTitulo($titulo);
		$notificacion->setCaMensaje($mensaje);
		$notificacion->setCaCaducidad($caducidad);
		$notificacion->setCaUsucreado($user->getUserId());
		$this->usucreado = $user->getUserId();	
		$this->fchcreado = date("Y-m-d H:i:s", time());
		$notificacion->setCaFchcreado( $this->fchcreado );
		$notificacion->save();
		$this->idnotificacion = $notificacion->getCaIdNotificacion();		
	}
	
}
?>