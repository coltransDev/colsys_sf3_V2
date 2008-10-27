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
		
		$this->opcion = $this->getRequestParameter( "opcion" );
		
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
	public function executeDatosGrillaPorTrafico(){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		$idciudad = $this->getRequestParameter( "idciudad" );
		
		$idciudaddestino = $this->getRequestParameter( "idciudaddestino" );
		
		$start = $this->getRequestParameter( "start" );
		$limit = $this->getRequestParameter( "limit" );
				
		$this->opcion = $this->getRequestParameter( "opcion" );

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
		
		if( $idciudaddestino ){			
			$c->add( TrayectoPeer::CA_DESTINO, $idciudaddestino );	
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
		
		$i=0;
		
		foreach( $trayectos as $trayecto ){
			$transportador = $trayecto->getTransportador();
				
			/*
			* Determina cuales conceptos deberian mostrarse de acuerdo al trafico
			* seleccionado.
			*/
			$trafico = TraficoPeer::retrieveByPk( $trayecto->getOrigen()->getCaIdTrafico() );
			
			$trayectoStr = strtoupper($trayecto->getOrigen()->getCaCiudad())."->".strtoupper($trayecto->getDestino()->getCaCiudad())." - ";
			
			$trayectoStr.=($transportador?($transportador->getCaSigla()?$transportador->getCaSigla():$transportador->getCaNombre()):"");
			
			$agente = $trayecto->getAgente();
			if( $agente ){
				$trayectoStr.=" [".$agente->getCaNombre()."] ";	
			}
			
			$trayectoStr.=" (TT ".$trayecto->getCaTiempotransito()." Freq. ".$trayecto->getCaFrecuencia().")";
			
			$trayectoStr = utf8_encode($trayectoStr);
		 	// En el modo de consulta los conceptos se muestran en filas seguidos de los recargos de lo contrario los conceptos se muestran en columnas.
				
			$pricConceptos = $trayecto->getPricFletes();
			
			//Se incluye una fila antes de los conceptos que contiene las observaciones de to
			$row = array (
				'idtrayecto' => $trayecto->getCaIdtrayecto(),
				'trayecto' =>$trayectoStr,
				'nconcepto' => "General",
				//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
				'inicio' => $trayecto->getCaFchinicio("d/m/Y"),
				'vencimiento' => $trayecto->getCaFchvencimiento("d/m/Y"),
				'moneda' => $trayecto->getCaIdMoneda(),
				'aplicacion' => $trayecto->getCaAplicacion(),				
				'_id' => $trayecto->getCaIdtrayecto()."-gen",
				'style' => '',
				'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto->getCaObservaciones())),
				'iditem'=>'',
				'tipo'=>"trayecto_obs",
				'neta'=>'',
				'minima'=>'',
				'minima'=>'',
				'orden'=>$i++
			);
			$data[] = $row;		
			
			// Se incluyen las filas de cada concepto y sus respectivos recargos		
			foreach( $this->conceptos as $concepto ){ 	
				$pricConcepto = PricFletePeer::retrieveByPk( $trayecto->getCaIdtrayecto() ,$concepto->getCaidConcepto() );			
				if( !$pricConcepto ){
					$pricConcepto = new PricFlete();
					$pricConcepto->setcaIdTrayecto($trayecto->getCaIdtrayecto());
					$pricConcepto->setcaIdConcepto($concepto->getCaidConcepto());
				}
				
				$row = array (
					'idtrayecto' => $trayecto->getCaIdtrayecto(),
					'trayecto' =>$trayectoStr,
					'nconcepto' => utf8_encode($pricConcepto->getConcepto()->getcaConcepto()),
					//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
					'inicio' => '',
					'vencimiento' => '',
					'moneda' => '', // consulta ? $trayecto->getCaIdMoneda()
					'aplicacion' => $trayecto->getCaAplicacion(),				
					'_id' => $trayecto->getCaIdtrayecto()."-".$pricConcepto->getCaIdConcepto(),
					'style' => $pricConcepto->getEstilo(),
					'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto->getCaObservaciones())),
					'iditem'=>$pricConcepto->getCaIdConcepto(),
					'tipo'=>"concepto",
					'neta'=>$pricConcepto->getCaVlrneto(),
					'minima'=>$pricConcepto->getCaVlrminimo(),
					'orden'=>$i++
					
				);
				$data[] = $row;	
									
				$pricRecargos = $pricConcepto->getPricRecargoxConceptos();
				
				foreach( $pricRecargos as $pricRecargo ){
					$tipoRecargo = $pricRecargo->getTipoRecargo();
										
					$row = array (
						'idtrayecto' => $trayecto->getCaIdtrayecto(),
						'trayecto' =>$trayectoStr,
						'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
						//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
						'inicio' => "",
						'vencimiento' => "",
						'moneda' => $pricRecargo->getCaIdMoneda(),
						'aplicacion' => "",				
						'_id' => $trayecto->getCaIdtrayecto()."-".$pricConcepto->getCaIdConcepto()."-".$pricRecargo->getCaIdrecargo(),
						'style' => '',
						'observaciones' => utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
						'iditem'=>$pricRecargo->getCaIdrecargo(),
						'idconcepto'=>$pricConcepto->getCaIdConcepto(),
						'tipo'=>"recargo",
						'neta'=>$pricRecargo->getCaVlrrecargo(),
						'minima'=>$pricRecargo->getCaVlrminimo(),
						'orden'=>$i++	
					);									
					$data[] = $row;						
				}				
			}	
			
			
			$pricRecargos = $trayecto->getRecargosGenerales();
			
			if( $this->opcion!="consulta" || count($pricRecargos)>0   ){
				
				//Se incluye una fila antes de los recargos generales del trayecto
				$row = array (
					'idtrayecto' => $trayecto->getCaIdtrayecto(),
					'trayecto' =>$trayectoStr,
					'nconcepto' => "Recargos generales del trayecto",
					//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
					'inicio' => '',
					'vencimiento' => '',
					'moneda' => '',
					'aplicacion' => $trayecto->getCaAplicacion(),				
					'_id' => $trayecto->getCaIdtrayecto()."-recgen",
					'style' => '',
					'observaciones' => '',
					'iditem'=>'9999',				
					'tipo'=>"concepto",
					'neta'=>'',
					'minima'=>'',
					'orden'=>$i++
				);
				$data[] = $row;	
			}			
				
			foreach( $pricRecargos as $pricRecargo ){
				$tipoRecargo = $pricRecargo->getTipoRecargo();
									
				$row = array (
					'idtrayecto' => $trayecto->getCaIdtrayecto(),
					'trayecto' =>$trayectoStr,
					'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
					//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
					'inicio' => "",
					'vencimiento' => "",
					'moneda' => $pricRecargo->getCaIdMoneda(),
					'aplicacion' => "",				
					'_id' => $trayecto->getCaIdtrayecto()."-9999-".$pricRecargo->getCaIdrecargo(),
					'style' => '',
					'observaciones' => utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
					'iditem'=>$pricRecargo->getCaIdrecargo(),
					'idconcepto'=>'9999',
					'tipo'=>"recargo",
					'neta'=>$pricRecargo->getCaVlrrecargo(),
					'minima'=>$pricRecargo->getCaVlrminimo(),
					'orden'=>$i++	
				);									
				$data[] = $row;						
			}
			
			
			
			
									
		}
		$this->data = $data;
	}


	/*
	* Observa los cambios realizados en grillaPorTraficos
	* @author: Andres Botero
	*/
	public function executeObserveGrillaPorTraficos(){

		$trayecto = TrayectoPeer::retrieveByPk( $this->getRequestParameter( "idtrayecto" ) );
		$this->forward404Unless( $trayecto );
		
		$tipo = $this->getRequestParameter("tipo");		
		$neta = $this->getRequestParameter("neta");
		$minima = $this->getRequestParameter("minima");
				
		if( $tipo=="trayecto_obs" ){			
			if( $this->getRequestParameter("inicio")){
				$trayecto->setCaFchinicio($this->getRequestParameter("inicio"));
			}
				
			if( $this->getRequestParameter("vencimiento")){
				$trayecto->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
			}
			if( $this->getRequestParameter("moneda") ){
				$trayecto->setCaIdMoneda($this->getRequestParameter("moneda"));
			}
	
			if( $this->getRequestParameter("observaciones")){
				$trayecto->setCaObservaciones($this->getRequestParameter("observaciones"));
			}
	
			if( $this->getRequestParameter("aplicacion")){
				$trayecto->setCaAplicacion($this->getRequestParameter("aplicacion"));
			}
			
			
			
			$trayecto->save();
		}
		
		if( $tipo=="concepto" ){			
			$idconcepto = $this->getRequestParameter("iditem");

			$flete  = PricFletePeer::retrieveByPk( $trayecto->getCaIdTrayecto(), $idconcepto );			
			if( !$flete ){
				$flete = new PricFlete();
				$flete->setCaIdtrayecto( $trayecto->getCaIdTrayecto() );
				$flete->setCaIdconcepto( $idconcepto );
			}
			
			if( $neta ){
				$flete->setCaVlrneto( $neta );
			} 
			
			if( $minima ){
				$flete->setCaVlrminimo( $minima );
			} 
			
			if( $this->getRequestParameter("style")!==null){
				$flete->setEstilo($this->getRequestParameter("style"));
			}
			$flete->save();
		}
		
		if( $tipo=="recargo" ){
			
			$idconcepto = $this->getRequestParameter("idconcepto");
			$idrecargo = $this->getRequestParameter("iditem");
			
			$pricRecargo = PricRecargoxConceptoPeer::retrieveByPk( $trayecto->getCaIdTrayecto() , $idconcepto , $idrecargo);
			
			if( !$pricRecargo ){
				$pricRecargo = new PricRecargoxConcepto();
				$pricRecargo->setCaIdtrayecto( $trayecto->getCaIdTrayecto() );
				$pricRecargo->setCaIdconcepto( $idconcepto );
				$pricRecargo->setCaIdrecargo( $idrecargo );
				
			}
			if( $neta ){
				$pricRecargo->setCaVlrrecargo( $neta );
			} 
			
			if( $minima ){
				$pricRecargo->setCaVlrminimo( $minima );
			} 		
			
			if( $this->getRequestParameter("moneda") ){
				$pricRecargo->setCaIdMoneda($this->getRequestParameter("moneda"));
			}	
					
			$pricRecargo->save();
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
		//$c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" );

		/*$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );
		$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );*/
		//$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		//$c->setLimit(30);
		$trayectos = TrayectoPeer::doSelect( $c );

		set_time_limit(0);

		foreach( $trayectos as $trayecto ){
				
			$fletes = $trayecto->getFletes();
				
			//		$trayecto->getOrigen();
			
			$ciudad = CiudadPeer::retrieveByPk( $trayecto->getCaOrigen() );
			$trafico = $ciudad->getTrafico();
				
			$conceptosStr = $trafico->getCaConceptos();
			//$conceptosStr="";
				
			//$recargosStr = $trafico->getCaRecargos();
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
			$conceptosArr = explode("|",$conceptosStr);
			$conceptosArr = array_unique($conceptosArr);
			$conceptosStr=implode("|",$conceptosArr);
			echo "<br />Conceptos -->".$conceptosStr."<br />";
			$trafico->setCaConceptos($conceptosStr);
			$trafico->save();
			
			
		/*	$c = new Criteria();
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
				
				
			
				
			$recargosArr = explode("|",$recargosStr);
			$recargosArr = array_unique($recargosArr);
			$recargosStr=implode("|",$recargosArr);
			echo "<br />Recargos -->".$recargosStr."<br />";
			$trafico->setCaRecargos($recargosStr);
			//$trafico->save();*/
				
				
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
		$idciudaddestino = $this->getRequestParameter( "idciudaddestino" );
		
		$idlinea = $this->getRequestParameter( "idlinea" );
		$idciudad = $this->getRequestParameter( "idciudad" );
		$this->opcion = $this->getRequestParameter( "opcion" );
		
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
		$this->idciudaddestino = $idciudaddestino;
		$this->idlinea = $idlinea;
		$this->linea = "";		
				
		$this->setLayout("ajax");
	}
	
	
	/*
	* Datos de los recargos para ser mostrados en un combobox
	*/
	public function executeDatosRecargos(){
	
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$tipo = utf8_decode($this->getRequestParameter("tipo"));
		
		$c = new Criteria();
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
		if( $tipo ){
			$c->add( TipoRecargoPeer::CA_TIPO, $tipo );
		}
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
	* @author: Andres Botero 
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
	* @author: Andres Botero 
	*/
	public function executeVerArchivo(){
		$this->archivo = PricArchivoPeer::retrieveByPk( $this->getRequestParameter("idarchivo") );
		$this->forward404Unless( $this->archivo );
		$this->getResponse()->addHttpMeta('content-type', $this->archivo->getCaTipo());
    	$this->getResponse()->addHttpMeta('content-length', $this->archivo->getCaTamano());		
	}
	
	/*
	* Permite borrar el archivo  
	* @author: Andres Botero 
	*/
	public function executeBorrarArchivo(){
		$this->archivo = PricArchivoPeer::retrieveByPk( $this->getRequestParameter("idarchivo") );
		$this->forward404Unless( $this->archivo );
		$this->archivo->delete(); 
		return sfView::NONE;
	}
	
	/*
	* Recargos generales de un pais 
	* @author: Andres Botero 
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
	* @author: Andres Botero 
	*/
	public function executeRecargosGeneralesData(){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		//$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		
		$c = new Criteria();
		$c->add( PricRecargosxCiudad::CA_IDTRAFICO, $idtrafico  );		
		$recargos = PricRecargosxCiudad::doSelect( $c );
		
		$this->data = array();
		foreach( $recargos as $recargo ){
			$row = array(
				'idtrafico'=>$idtrafico,
				'idciudad'=>$recargo->getCaIdciudad(),
				'ciudad'=>$recargo->getCiudad()->getCaCiudad(),
				'idrecargo'=>$recargo->getCaIdrecargo(),
				'recargo'=>$recargo->getTipoRecargo()->getCaRecargo(),
				'vlrrecargo'=>$recargo->getCaVlrrecargo(),
				'vlrminimo'=>$recargo->getCaVlrminimo(),
				'aplicacion'=>$recargo->getCaAplicacion(),
				'observaciones'=>$recargo->getCaObservaciones()								
			);
			$this->data[]= $row;
		}
					
		$this->transporte = $transporte;
		$this->modalidad = $modalidad;
		
		$this->setLayout("ajax");
	}
	
	/*
	* Guarda los cambios realizados en los recargos generales
	* @author: Andres Botero 
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
	* @author: Andres Botero 
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
	
	/*
	* Elimina una notificacion
	* @author: Andres Botero 
	*/
	public function executeEliminarNotificacion(){
		$notificacion = PricNotificacionPeer::retrieveByPk( $this->getRequestParameter("idnotificacion") );
		if( $notificacion ){
			$notificacion->delete();			
		}
		return sfView::NONE;
	}
	
	
	/*
	* Permite la administración y consulta de los trayectos (tiempos de transito 
	* y frecuencia) 
	* @author: Andres Botero
	*/
	public function executeAdminTrayectos( $request ){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		
			
		$opcion = $this->getRequestParameter( "opcion" );
		
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);		
		$this->idcomponent = "admtraf_".$this->trafico->getCaIdTrafico()."_".$transporte."_".$modalidad;
		
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		
		$this->titulo = "T.T. Freq. ".$this->trafico->getCaNombre()." ".$modalidad;
				
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );	
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );	
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		//$c->setLimit(20);
		$trayectos = TrayectoPeer::doSelect( $c );
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		$this->forward404Unless( $this->trafico );
		$this->conceptos = $this->trafico->getConceptos( $transporte, $modalidad );
				
		
					
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;					
		$this->linea = "";		
		$this->opcion = $opcion;
		
		
		$this->setLayout("ajax");
	}
	
	/*
	* Muestra los datos para la administración de trayectos
	*/
	public function executeDatosAdminTrayectos(){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );		
		$start = $this->getRequestParameter( "start" );
		$limit = $this->getRequestParameter( "limit" );
				
		$opcion = $this->getRequestParameter( "opcion" );
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
				

		$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );
		$this->total=TrayectoPeer::doCount( $c );
		if( $limit ){ 
			$c->setLimit( $limit );
		}
		if( $start ){
			$c->setOffset( $start );
		}	
		$trayectos = TrayectoPeer::doSelect( $c );
			

		$data=array();
		$transportador_id = null;
		foreach( $trayectos as $trayecto ){
			$transportador = $trayecto->getTransportador();
			
			$trafico = TraficoPeer::retrieveByPk( $trayecto->getOrigen()->getCaIdTrafico() );
			
			$trayectoStr = utf8_encode(strtoupper($trayecto->getOrigen()->getCaCiudad()))."->".utf8_encode(strtoupper($trayecto->getDestino()->getCaCiudad()));
			
			
			$row = array(
				'idtrayecto' => $trayecto->getCaIdtrayecto(),
				'trayecto' =>utf8_encode($trayectoStr),
				'origen'=>utf8_encode($trayecto->getOrigen()->getCaCiudad()),
				'destino'=>utf8_encode($trayecto->getDestino()->getCaCiudad()), 
				'linea'=> $transportador?utf8_encode($transportador->getCaNombre()):"",
				'ttransito'=>utf8_encode($trayecto->getCaTiempotransito()),
				'frecuencia'=>$trayecto->getCaFrecuencia()
			);
						
			
			$data[] = $row;						
			
			$pricConceptos = $trayecto->getPricFletes();			
		}
		
		$this->data = $data;
	}
	
	/*
	* Guarda los cambios realizados en la grilla de administración de trayectos (TT, Freq)
	*/
	public function executeObserveAdminTrayectos(){
		$idtrayecto = $this->getRequestParameter( "idtrayecto" );
		$trayecto = TrayectoPeer::retrieveByPk( $idtrayecto );
		$this->forward404Unless( $trayecto );		
		
		if( $this->getRequestParameter("ttransito") ){
			$trayecto->setCaTiempotransito( utf8_decode($this->getRequestParameter("ttransito")) );
		}		
		
		if( $this->getRequestParameter("frecuencia") ){
			$trayecto->setCaFrecuencia( utf8_decode($this->getRequestParameter("frecuencia")) );
		}		
		
		$trayecto->save();
		return sfView::NONE;
	}
	
	/*
	* Muestra los datos para la administración de cabotajes
	*/
	public function executeCabotajes(){
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
					
		$opcion = $this->getRequestParameter( "opcion" );
		
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);		
		$this->idcomponent = "cabotajes";
		
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		
		$this->titulo = "Cabotajes";
				
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );	
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );	
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		//$c->setLimit(20);
		$trayectos = TrayectoPeer::doSelect( $c );
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		$this->forward404Unless( $this->trafico );
		$this->conceptos = $this->trafico->getConceptos( $transporte, $modalidad );		
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;					
		$this->linea = "";		
		$this->opcion = $opcion;
				
		$this->setLayout("ajax");
	}
	
	
	/*
	* Retorna los datos para la grilla de los cabotajes
	*/
	public function executeDatosCabotajes(){
		$c = new Criteria();
		$cabotajes  = PricCabotajePeer::doSelect( $c );
		
		$this->data = array();
		foreach( $cabotajes as $cabotaje ){
			$transportador = $cabotaje->getTransportador();
			$row = array(
				'oid'=> $cabotaje->getOid(),
				'origen'=> $cabotaje->getOrigen()->getCaCiudad(), 
				'destino'=> $cabotaje->getDestino()->getCaCiudad(), 
				'idlinea'=> $cabotaje->getCaIdlinea(), 
				'linea'=> $transportador->getCaNombre(),
				'vlrkilo'=> $cabotaje->getCaVlrkilo(),
				'vlrminimo'=> $cabotaje->getCaVlrminimo(),
				'maxpeso'=> $cabotaje->getCaMaxpeso(),
				'dimensiones'=> $cabotaje->getCaDimensiones()
			);					
			$this->data[]=$row;
		} 		
	}	
	
}
?>