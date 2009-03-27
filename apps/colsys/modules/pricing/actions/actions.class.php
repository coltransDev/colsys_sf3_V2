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

	const RUTINA = "61";
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{		
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		

		$this->modalidades_mar = ParametroPeer::retrieveByCaso( "CU051" );
		$this->modalidades_aer = ParametroPeer::retrieveByCaso( "CU052" );
		$this->modalidades_ter = ParametroPeer::retrieveByCaso( "CU053" );	
		

		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/myRowExpander",'last');
		$response->addJavaScript("extExtras/NumberFieldMin",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');	
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		if( $this->nivel==-1 ){
			$this->forward404();
		}	
	}	
	
	/*********************************************************************
	* Grilla por traficos 
	*
	*********************************************************************/
	
	/*
	* Esta acción se ejecuta cuando un usuario hace click sobre la hoja del arbol 
	* seleccionando un pais, esta accion devuelve una grilla donde se colocan
	* los valores de los conceptos 
	* @author: Andres Botero
	*/
	public function executeGrillaPorTrafico( $request ){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$this->impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$this->forward404Unless( $this->impoexpo );
				
		$modalidad = $this->getRequestParameter( "modalidad" );
				
		$idlinea = $this->getRequestParameter( "idlinea" );						
		$idtrafico = $this->getRequestParameter( "idtrafico" );		
		$idciudad = $this->getRequestParameter( "idciudad" );
		
		$idciudad2 = $this->getRequestParameter( "idciudad2" );
					
		
		
		$this->titulo = $modalidad;
		$this->idcomponent = substr($this->impoexpo,0,1);
		
		$this->timestamp = $this->getRequestParameter( "timestamp" );
		$this->timestamp2 = $this->getRequestParameter( "timestamp2" );
			
		if( $idtrafico ){
			$this->trafico = TraficoPeer::retrieveByPk($idtrafico);	
					
			$this->forward404Unless( $this->trafico );
				
			$this->idcomponent .= "_".$this->trafico->getCaIdTrafico()."_".$transporte."_".$modalidad;
			
			$this->titulo .= "»".substr($this->impoexpo,0,4)."»".$this->trafico->getCaNombre();
						
			if( $idciudad ){			
				
				$ciudad = CiudadPeer::retrieveByPk( $idciudad );
				$this->titulo .= "»".$ciudad->getCaCiudad();
				$this->idcomponent.= "_ciudad_".$idciudad;
							
			}
			
			if( $idciudad2 ){	
				
				$ciudad = CiudadPeer::retrieveByPk( $idciudad2 );
				$this->titulo .= "»".$ciudad->getCaCiudad();
				$this->idcomponent.= "_ciudad2_".$idciudad2;
			}
			
			if( $idlinea ){			
				
				$linea = TransportadorPeer::retrieveByPk( $idlinea );
				$this->titulo .= "»".($linea->getCaSigla()?$linea->getCaSigla():$linea->getCaNombre());
				$this->idcomponent.= "_linea_".$idlinea;
			}
			
			$this->conceptos = $this->trafico->getConceptos( $transporte, $modalidad );
			//print_r( $this->conceptos );
			$this->setLayout("ajax");
		}
			
		if( $this->timestamp  ){					
			$fchcorte = date( "Y-m-d H:i:s", $this->timestamp );					
			$this->titulo .= "»".$fchcorte;//." - ".$fchregistro;
			$this->idcomponent.= "_".$this->timestamp;			
		}			
		//$this->aplicaciones = ParametroPeer::retrieveByCaso( "CU060", null, $transporte );
		$this->impoexpo = utf8_encode($this->impoexpo);			
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;		
		$this->idciudad = $idciudad;
		$this->idciudad2 = $idciudad2;
		$this->idlinea = $idlinea;
		$this->linea = "";		
		
		//Datos para el combo recargos		
		$tipo = Constantes::RECARGO_EN_ORIGEN;
		
		$c = new Criteria();
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
		if( $tipo ){
			$c->add( TipoRecargoPeer::CA_TIPO, $tipo );
		}
		$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
		//$c->setLimit(3);
		$this->recargos = TipoRecargoPeer::doSelect( $c );				
	}
	
	/*
	* Muestra los trayectos
	*/
	public function executeDatosGrillaPorTrafico(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
	
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		$idciudad = $this->getRequestParameter( "idciudad" );
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$this->forward404Unless( $impoexpo );
		
		$idciudad2 = $this->getRequestParameter( "idciudad2" );
		
		$start = $this->getRequestParameter( "start" );
		$limit = $this->getRequestParameter( "limit" );
				
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		
		if( $this->trafico ){				
			//$conceptosArr = explode("|",$this->trafico->getCaConceptos());
			$this->conceptos = $this->trafico->getConceptos( $transporte, $modalidad );
		}
		
		//Busqueda historica
		$timestamp = $this->getRequestParameter("timestamp");
		
		if( $timestamp ){
			$fchcorte = date( "Y-m-d H:i:s", $timestamp );			
		}else{
			$fchcorte = null;
		}
		
		$c = new Criteria();		
		if( $impoexpo==Constantes::IMPO ){
			$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		}else{
			$c->addJoin( TrayectoPeer::CA_DESTINO, CiudadPeer::CA_IDCIUDAD );
		}	
		$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );
		if( $this->trafico ){
			$c->add( CiudadPeer::CA_IDTRAFICO, $this->trafico->getCaIdTrafico() );
		}	
		$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
		$c->add( TrayectoPeer::CA_ACTIVO, true );
		
		if( $this->trafico ){
			if( $impoexpo==Constantes::IMPO ){
				if( $idciudad ){
					$c->add( TrayectoPeer::CA_ORIGEN, $idciudad );	
				}		
				if( $idciudad2 ){			
					$c->add( TrayectoPeer::CA_DESTINO, $idciudad2 );	
				}
			}else{
				if( $idciudad ){
					$c->add( TrayectoPeer::CA_DESTINO, $idciudad );	
				}		
				if( $idciudad2 ){			
					$c->add( TrayectoPeer::CA_ORIGEN, $idciudad2 );	
				}
			}
		}
		
		if( $idlinea ){			
			$c->add( TrayectoPeer::CA_IDLINEA, $idlinea );	
		}

		$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );
		
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
			if( $impoexpo==Constantes::IMPO ){
				$idtraficoConcepto =  $trayecto->getOrigen()->getCaIdTrafico();
			}else{
				$idtraficoConcepto =  $trayecto->getDestino()->getCaIdTrafico();
			}
			$trafico = TraficoPeer::retrieveByPk( $idtraficoConcepto );
			
			$trayectoStr = strtoupper($trayecto->getOrigen()->getCaCiudad())."»".strtoupper($trayecto->getDestino()->getCaCiudad())." - ";
			
			$trayectoStr.=($transportador?($transportador->getCaSigla()?$transportador->getCaSigla():$transportador->getCaNombre()):"");
			
			$agente = $trayecto->getAgente();
			if( $agente ){
				$trayectoStr.=" [".$agente->getCaNombre()."] ";	
			}
			
			$trayectoStr.=" (TT ".$trayecto->getCaTiempotransito()." Freq. ".$trayecto->getCaFrecuencia().") ".$trayecto->getCaidTrayecto();
			
			$trayectoStr = utf8_encode($trayectoStr);
		 	
			//----------
			//Se determinan los recargos generales x ciudad		
			
			$pricRecargosxCiudad = $trayecto->getRecargosxCiudad( $fchcorte );	
			$pricRecargosxLinea = $trayecto->getRecargosxLinea( $fchcorte );		
			$pricRecargos = $trayecto->getRecargosGenerales( $fchcorte );
			
			$recargosGenerales = array(); 		
			if( $pricRecargos ){
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
						'style' => '',
						'observaciones' => utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
						'iditem'=>$pricRecargo->getCaIdrecargo(),
						'idconcepto'=>'9999',
						'tipo'=>"recargo",
						'sugerida'=>$pricRecargo->getCaVlrrecargo(),
						'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
						'minima'=>$pricRecargo->getCaVlrminimo(),
						'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
						'consecutivo' => $pricRecargo->getCaConsecutivo()
						
					);									
					$recargosGenerales[] = $row;						
				}
			}
			if( $pricRecargosxCiudad ){
				foreach( $pricRecargosxCiudad as $pricRecargo ){
					$tipoRecargo = $pricRecargo->getTipoRecargo();
										
					$row = array (
						'idtrayecto' => $trayecto->getCaIdtrayecto(),
						'trayecto' =>$trayectoStr,
						'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
						//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
						'inicio' => "",
						'vencimiento' => "",
						'moneda' => $pricRecargo->getCaIdMoneda(),									
						
						'style' => '',
						'observaciones' => utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
						'iditem'=>$pricRecargo->getCaIdrecargo(),
						'idconcepto'=>'9999',
						'tipo'=>"recargoxciudad",
						'sugerida'=>$pricRecargo->getCaVlrrecargo(),
						'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
						'minima'=>$pricRecargo->getCaVlrminimo(),
						'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
						'consecutivo' => $pricRecargo->getCaConsecutivo()
						
					);									
					$recargosGenerales[] = $row;						
				}	
			}	//Fin recargos generales
			
			if( $pricRecargosxLinea ){
				foreach( $pricRecargosxLinea as $pricRecargo ){
					$tipoRecargo = $pricRecargo->getTipoRecargo();
										
					$row = array (
						'idtrayecto' => $trayecto->getCaIdtrayecto(),
						'trayecto' =>$trayectoStr,
						'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
						//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
						'inicio' => "",
						'vencimiento' => "",
						'moneda' => $pricRecargo->getCaIdMoneda(),									
						
						'style' => '',
						'observaciones' => utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
						'iditem'=>$pricRecargo->getCaIdrecargo(),
						'idconcepto'=>'9999',
						'tipo'=>"recargoxciudad",
						'sugerida'=>$pricRecargo->getCaVlrrecargo(),
						'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
						'minima'=>$pricRecargo->getCaVlrminimo(),
						'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
						'consecutivo' => $pricRecargo->getCaConsecutivo()
						
					);									
					$recargosGenerales[] = $row;						
				}	
			}	//Fin recargos generales
			
			
									
			//Se incluye una fila antes de los conceptos que contiene las observaciones de to
			$row = array (
				'idtrayecto' => $trayecto->getCaIdtrayecto(),
				'trayecto' =>$trayectoStr,
				'nconcepto' => "Observaciones",
				//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
				'inicio' => '',
				'vencimiento' => '',
				'moneda' => '',
				'aplicacion' => '',				
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
			
			
			if( !$this->trafico ){		
				//La consulta se hace de una modalidad completa y toca determinar los conceptos de cada trafico
				if( $impoexpo==Constantes::IMPO ){
					$trafico =  $trayecto->getOrigen()->getTrafico();
				}else{
					$trafico =  $trayecto->getDestino()->getTrafico();
				}			
				
				//$conceptosArr = explode("|",$this->trafico->getCaConceptos());
				$this->conceptos = $trafico->getConceptos( $transporte, $modalidad );
				
			}
						
			// Se incluyen las filas de cada concepto y sus respectivos recargos		
			foreach( $this->conceptos as $concepto ){ 	
				if(!$fchcorte){
					$pricConcepto = PricFletePeer::retrieveByPk( $trayecto->getCaIdtrayecto() ,$concepto->getCaidConcepto() );	
				}else{
					$pricConcepto = PricFleteLogPeer::retrieveByFch( $trayecto->getCaIdtrayecto() ,$concepto->getCaidConcepto(), $fchcorte );	
				}
					
				if( !$pricConcepto ){
					if( $this->opcion=="consulta"){
						continue;
					}
					//----------
					if(!$fchcorte){
						$pricConcepto = new PricFlete();						
					}else{
						$pricConcepto = new PricFleteLog();						
					}
					$pricConcepto->setCaIdTrayecto($trayecto->getCaIdtrayecto());
					$pricConcepto->setCaIdConcepto($concepto->getCaidConcepto());
					
				}
				
				if( $this->opcion=="consulta" && $pricConcepto->getCaEstado()==2){//Las tarifas en mantenimiento no se muestran en consulta
					$neta=0;
					$sugerida=0;
				}else{
					$neta=$pricConcepto->getCaVlrneto();
					$sugerida=$pricConcepto->getCaVlrsugerido();
				}
				
				$row = array (
					'idtrayecto' => $trayecto->getCaIdtrayecto(),
					'trayecto' =>$trayectoStr,
					'nconcepto' => utf8_encode($pricConcepto->getConcepto()->getcaConcepto()),
					//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
					'inicio' => $pricConcepto->getCaFchinicio("Y-m-d"),
					'vencimiento' => $pricConcepto->getCaFchvencimiento("Y-m-d"),
					'moneda' => $pricConcepto->getCaIdMoneda(),
					'_id' => $trayecto->getCaIdtrayecto()."-".$pricConcepto->getCaIdConcepto(),
					'style' => $pricConcepto->getEstilo(),
					'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto->getCaObservaciones())),
					'iditem'=>$pricConcepto->getCaIdConcepto(),
					'tipo'=>"concepto",		
					'neta'=>$neta,
					'sugerida'=>$sugerida,							
					'aplicacion' => utf8_encode($pricConcepto->getCaAplicacion()),	
					'consecutivo' => $pricConcepto->getCaConsecutivo(),					
					'orden'=>$i++
					
				);
				$data[] = $row;	
				//----------
				if(!$fchcorte){					
					$pricRecargos = $pricConcepto->getPricRecargoxConceptos();
				}else{
					$pricRecargos = $pricConcepto->getPricRecargoxConceptos( $fchcorte );
				}
				
				if( $pricRecargos ){
					foreach( $pricRecargos as $pricRecargo ){
						$tipoRecargo = $pricRecargo->getTipoRecargo();
						
						if( $this->opcion=="consulta" && $pricConcepto->getCaEstado()==2){//Las tarifas en mantenimiento no se muestran en consulta
							
							$sugerida=0;
							$minima=0;
						}else{							
							$sugerida=$pricRecargo->getCaVlrrecargo();
							$minima=$pricRecargo->getCaVlrminimo();
						}
											
						$row = array (
							'idtrayecto' => $trayecto->getCaIdtrayecto(),
							'trayecto' =>$trayectoStr,
							'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
							//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
							'inicio' => $pricRecargo->getCaFchinicio("Y-m-d"),
							'vencimiento' => $pricRecargo->getCaFchvencimiento("Y-m-d"),
							'moneda' => $pricRecargo->getCaIdMoneda(),
									
							'_id' => $trayecto->getCaIdtrayecto()."-".$pricConcepto->getCaIdConcepto()."-".$pricRecargo->getCaIdrecargo(),
							'style' => '',
							'observaciones' => utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
							'iditem'=>$pricRecargo->getCaIdrecargo(),
							'idconcepto'=>$pricConcepto->getCaIdConcepto(),
							'tipo'=>"recargo",
							'sugerida'=>$sugerida,
							'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),		
							'minima'=>$minima,
							'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
							'consecutivo' => $pricRecargo->getCaConsecutivo(),
							'orden'=>$i++	
						);									
						$data[] = $row;						
					}
				}
				
				if( $this->opcion=="consulta" &&  count($recargosGenerales)>0 && $trayecto->getCaTransporte()==Constantes::MARITIMO && $trayecto->getCaModalidad()=="FCL" ){
					//En el caso maritimo se incluyen los recargos despues de cada concepto en el modo de consulta unicamente
					foreach( $recargosGenerales as $rec ){	
						$rec['orden']=$i++;				
						$data[] = $rec;						
					}	
				}				
			}	
			
			//----------
						
			
			
			//$this->opcion!="consulta" se hace para que el usuario pueda 
			// hacer click con el boton derecho y agregar un recargo general 
			if( $this->opcion!="consulta" || ( count($recargosGenerales)>0 && !($trayecto->getCatransporte()==Constantes::MARITIMO && $trayecto->getCaModalidad()=="FCL") ) ){ 
				
				//Se incluye una fila antes de los recargos generales del trayecto
				$row = array (
					'idtrayecto' => $trayecto->getCaIdtrayecto(),
					'trayecto' =>$trayectoStr,
					'nconcepto' => "Recargos generales del trayecto",
					//'destino' => utf8_encode($trayecto->getDestino()->getCaCiudad()),
					'inicio' => '',
					'vencimiento' => '',
					'moneda' => '',
					'aplicacion' => '',				
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
			
			if( $this->opcion!="consulta" || ( count($recargosGenerales)>0 && !($trayecto->getCatransporte()==Constantes::MARITIMO && $trayecto->getCaModalidad()=="FCL")) ){ 
				foreach( $recargosGenerales as $rec ){	
					$rec['orden']=$i++;				
					$data[] = $rec;	
				}	
			}
								
		}
		
		$this->data = $data;
		
		//$this->responseArray = array("success"=>true);	
		//$this->setTemplate("responseTemplate");		
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
		$sugerida = $this->getRequestParameter("sugerida");
		$id = $this->getRequestParameter("id");
		
		$user=$this->getUser();
		
		if( $tipo=="trayecto_obs" ){									
			if( $this->getRequestParameter("observaciones")!==null){	
				if( $this->getRequestParameter("observaciones") ){			
					$trayecto->setCaObservaciones($this->getRequestParameter("observaciones"));				
				}else{
					$trayecto->setCaObservaciones(null);				
				}				
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
				$flete->setCaVlrneto( 0 );
				$flete->setCaFchcreado( time() );
			}
			
			if( $neta!==null ){
				$flete->setCaVlrneto( $neta );
			} 
			
			if( $sugerida!==null ){
				$flete->setCaVlrsugerido( $sugerida );
			}
			
			
			if( $this->getRequestParameter("style")!==null){
				if( $this->getRequestParameter("style") ){
					$flete->setEstilo($this->getRequestParameter("style"));			
				}else{
					$flete->setEstilo(null);					
				}
			}
			
			if( $this->getRequestParameter("inicio")){
				$flete->setCaFchinicio($this->getRequestParameter("inicio"));
			}
				
			if( $this->getRequestParameter("vencimiento")){
				$flete->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
			}
			if( $this->getRequestParameter("moneda") ){
				$flete->setCaIdMoneda($this->getRequestParameter("moneda"));
			}
			
			if( $this->getRequestParameter("aplicacion")){
				$flete->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
			}
			
			$flete->setCaUsucreado( $user->getUserId() ); // La hora la actualiza el trigger
			$flete->save();
		}
		
		if( $tipo=="recargo" ){
			$minima = $this->getRequestParameter("minima");
			$idconcepto = $this->getRequestParameter("idconcepto");
			$idrecargo = $this->getRequestParameter("iditem");
			if( $idconcepto!=9999 ){
				$flete  = PricFletePeer::retrieveByPk( $trayecto->getCaIdTrayecto(), $idconcepto );			
				if( !$flete ){
					$flete = new PricFlete();
					$flete->setCaIdtrayecto( $trayecto->getCaIdTrayecto() );
					$flete->setCaIdconcepto( $idconcepto );
					$flete->setCaVlrneto( 0 );
					$flete->setCaUsucreado( $user->getUserId() );
					$flete->setCaFchcreado( time() );
					$flete->save();
				}
			}
			
			$pricRecargo = PricRecargoxConceptoPeer::retrieveByPk( $trayecto->getCaIdTrayecto() , $idconcepto , $idrecargo);
			
			if( !$pricRecargo ){
				$pricRecargo = new PricRecargoxConcepto();
				$pricRecargo->setCaIdtrayecto( $trayecto->getCaIdTrayecto() );
				$pricRecargo->setCaIdconcepto( $idconcepto );
				$pricRecargo->setCaIdrecargo( $idrecargo );
				$pricRecargo->setCaVlrrecargo( 0 );
				$pricRecargo->setCaVlrminimo( 0 );				
				$pricRecargo->setCaFchcreado( time() );
				
			}
			if( $sugerida!==null ){
				$pricRecargo->setCaVlrrecargo( $sugerida );
			}
			
			if( $minima!==null ){
				$pricRecargo->setCaVlrminimo( $minima );
			}		
			
			if( $this->getRequestParameter("moneda") ){
				$pricRecargo->setCaIdMoneda($this->getRequestParameter("moneda"));
			}	
			
			if( $this->getRequestParameter("inicio")!==null ){
				if( $this->getRequestParameter("inicio") ){
					$pricRecargo->setCaFchinicio($this->getRequestParameter("inicio"));
				}else{
					$pricRecargo->setCaFchinicio( null );
				}
			}
				
			if( $this->getRequestParameter("vencimiento")!==null ){
				if( $this->getRequestParameter("vencimiento") ){ 
					$pricRecargo->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
				}else{
					$pricRecargo->setCaFchvencimiento( null );
				}
			}
			
			if( $this->getRequestParameter("aplicacion")!==null){
				$pricRecargo->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
			}
			
			if( $this->getRequestParameter("aplicacion_min")!==null){
				$pricRecargo->setCaAplicacionMin(utf8_decode($this->getRequestParameter("aplicacion_min")));
			}
			
			if( $this->getRequestParameter("observaciones")!==null){
				$pricRecargo->setCaObservaciones($this->getRequestParameter("observaciones"));
			}
			$pricRecargo->setCaUsucreado( $user->getUserId() );			
			$pricRecargo->save();
		}
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");			
	}
	
	public function executeEliminarRecargoGrillaPorTraficos(){
		$idtrayecto = $this->getRequestParameter("idtrayecto");
		$idconcepto = $this->getRequestParameter("idconcepto");
		$idrecargo = $this->getRequestParameter("idrecargo");
		$id = $this->getRequestParameter("id");
		$pricRecargo = PricRecargoxConceptoPeer::retrieveByPk( $idtrayecto , $idconcepto , $idrecargo);
		if( $pricRecargo ){
			$pricRecargo->delete();
		}
		$this->responseArray = array("id"=>$id, "success"=>true);
		
		$this->setTemplate("responseTemplate");
	}
	
	/*********************************************************************
	* Recargos generales
	*	
	*********************************************************************/
	
	
	/*
	* Recargos generales de un pais ó los recargos locales de un
	* transporte y una modalidad 
	* @author: Andres Botero 
	*/
	public function executeRecargosGenerales(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		
		if( $idtrafico ){
			$this->trafico = TraficoPeer::retrieveByPk($idtrafico);	
			
			if( $this->opcion != "consulta" ){	
				$c = new Criteria();
				$c->add(CiudadPeer::CA_IDTRAFICO, $idtrafico );
				$c->addAscendingOrderByColumn(CiudadPeer::CA_CIUDAD);
				$this->ciudades = CiudadPeer::doSelect( $c );
			}			
			$tipo = Constantes::RECARGO_EN_ORIGEN;
			
			$this->idcomponent = $this->trafico->getCaIdTrafico()."_".$transporte."_".$modalidad;		
					
		}else{
			$tipo = Constantes::RECARGO_LOCAL;	
			$idtrafico = "99-999"; 
			$this->idcomponent = "recargoslocales-".$transporte."_".$modalidad;		
		}
		
				
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
		$this->impoexpo = $impoexpo;		
		
		if( $this->opcion != "consulta" ){				
			$c = new Criteria();
			$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte);	
			$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
			$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
			$this->recargos = TipoRecargoPeer::doSelect( $c );
			
			$this->aplicaciones = ParametroPeer::retrieveByCaso("CU064", null, $transporte );
		}			
		$this->setLayout("ajax");
	}
	
	/*
	* Provee datos para los recargos por ciudad
	* @author: Andres Botero 
	*/
	public function executeRecargosGeneralesData(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );		
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		
				
		//$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
			
		
		
		$c = new Criteria();
		$c->addJoin( PricRecargosxCiudadPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO  );	
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte  );	
		$c->add( PricRecargosxCiudadPeer::CA_IDTRAFICO, $idtrafico  );	
		$c->add( PricRecargosxCiudadPeer::CA_MODALIDAD, $modalidad  );	
		$recargos = PricRecargosxCiudadPeer::doSelect( $c );
				
		if( !$idtrafico ){
			$idtrafico = "99-999"; 
		}
		
		$this->data = array();
		$i=0;
		foreach( $recargos as $recargo ){
			$row = array(
				'id'=>$i++,
				'idtrafico'=>$idtrafico,
				'idciudad'=>$recargo->getCaIdciudad(),
				'ciudad'=>$recargo->getCiudad()->getCaCiudad(),
				'idrecargo'=>$recargo->getCaIdrecargo(),
				'recargo'=>utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
				'vlrrecargo'=>$recargo->getCaVlrrecargo(),
				'vlrminimo'=>$recargo->getCaVlrminimo(),
				'aplicacion'=>utf8_encode($recargo->getCaAplicacion()),
				'aplicacion_min'=>utf8_encode($recargo->getCaAplicacionMin()),
				'idmoneda'=>$recargo->getCaIdmoneda(),
				'observaciones'=>utf8_encode($recargo->getCaObservaciones())								
			);
			$this->data[]= $row;
		}
		
		
		if( $this->opcion!="consulta" ){
			/*
			* Incluye una fila vacia que permite agregar datos
			*/
			$row = array(
				'id'=>$i++,
				'idtrafico'=>$idtrafico,
				'idciudad'=>$idtrafico=="99-999"?'999-9999':'',
				'ciudad'=>'+',
				'idrecargo'=>'',
				'recargo'=>'',
				'vlrrecargo'=>'',
				'vlrminimo'=>'',
				'aplicacion'=>'',
				'aplicacion_min'=>'',
				'idmoneda'=>'',
				'observaciones'=>''								
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
		
		$idtrafico = $this->getRequestParameter("idtrafico");
		$idciudad = $this->getRequestParameter("idciudad");		
		$idrecargo = $this->getRequestParameter("idrecargo");
		$modalidad = $this->getRequestParameter("modalidad");
		$impoexpo = $this->getRequestParameter("impoexpo");
		
		$this->forward404Unless( $idtrafico );
		$this->forward404Unless( $idciudad );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		
		$recargo = PricRecargosxCiudadPeer::retrieveByPk($idtrafico, $idciudad, $idrecargo , $modalidad, utf8_decode($impoexpo));
		if( !$recargo ){
			$recargo = new PricRecargosxCiudad();
			$recargo->setCaIdTrafico( $idtrafico );
			$recargo->setCaIdCiudad( $idciudad );
			$recargo->setCaIdRecargo( $idrecargo );
			$recargo->setCaModalidad( $modalidad );
			$recargo->setCaImpoexpo( utf8_decode($impoexpo) );
			$recargo->setCaVlrrecargo( 0 );
			$recargo->setCaVlrminimo( 0 );			
		}
		$user = $this->getUser();
		$recargo->setCaUsucreado( $user->getUserId() );
		$recargo->setCaFchcreado( time() );
		
					
		if( $this->getRequestParameter("vlrrecargo") ){
			$recargo->setCaVlrrecargo( $this->getRequestParameter("vlrrecargo") );
		}
		
		if( $this->getRequestParameter("vlrminimo") ){
			$recargo->setCaVlrminimo( $this->getRequestParameter("vlrminimo") );
		}		
		
		if( $this->getRequestParameter("idmoneda") ){
			$recargo->setCaIdMoneda($this->getRequestParameter("idmoneda"));
		}	
		
		if( $this->getRequestParameter("aplicacion")!==null){
			$recargo->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
		}
		
		if( $this->getRequestParameter("aplicacion_min")!==null){
			$recargo->setCaAplicacionMin(utf8_decode($this->getRequestParameter("aplicacion_min")));
		}
		
		if( $this->getRequestParameter("observaciones")!==null){
			$recargo->setCaObservaciones(utf8_decode($this->getRequestParameter("observaciones")));
		}
								
		$recargo->save();	
		$id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");		
	}
	
	/*
	* Elimina un recargo general
	* @author: Andres Botero 
	*/
	public function executeEliminarRecargosGenerales(){
		$idtrafico = $this->getRequestParameter("idtrafico");
		$idciudad = $this->getRequestParameter("idciudad");		
		$idrecargo = $this->getRequestParameter("idrecargo");
		$modalidad = $this->getRequestParameter("modalidad");
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		
		$this->forward404Unless( $idtrafico );
		$this->forward404Unless( $idciudad );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		
		$recargo = PricRecargosxCiudadPeer::retrieveByPk($idtrafico, $idciudad, $idrecargo , $modalidad, $impoexpo);
				
		$this->responseArray = array();
		if( $recargo ){
			$recargo->delete();		
		}	
		$id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");	
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
	
	
	/*********************************************************************
	* Recargos x linea
	*	
	*********************************************************************/
	
	
	/*
	* Recargos x linea de un pais 
	* @author: Andres Botero 
	*/
	public function executeRecargosPorLinea(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		
		
		if( $idtrafico=="99-999" ){
			$this->forward404Unless( $idlinea );
		}
		
		if( $idlinea ){
			$this->linea = TransportadorPeer::retrieveByPk( $idlinea );
		}
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
			
		
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
		$this->idlinea = $idlinea;
		$this->impoexpo = $impoexpo;
				
		$this->setLayout("ajax");
	}
	
		
	/*
	* Provee datos para los recargos por ciudad
	* @author: Andres Botero 
	*/
	public function executeRecargosPorLineaData(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );				
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		$idlinea = $this->getRequestParameter( "idlinea" );		
						
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		
				
		//$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		
		
		if( !$idtrafico ){
			$idtrafico = "99-999"; 
		}
		
		
		if( $idtrafico=="99-999" ){
			$this->forward404Unless( $idlinea );
		}
		
		
		$c = new Criteria();
		$c->addJoin( PricRecargosxLineaPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO  );	
		$c->add( PricRecargosxLineaPeer::CA_IMPOEXPO, $impoexpo  );		
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte  );	
		$c->add( PricRecargosxLineaPeer::CA_IDTRAFICO, $idtrafico  );			
		$c->add( PricRecargosxLineaPeer::CA_MODALIDAD, $modalidad  );
		
		if( $idtrafico=="99-999" ){
			$c->add( PricRecargosxLineaPeer::CA_IDLINEA, $idlinea  );
		}
		
			
		$recargos = PricRecargosxLineaPeer::doSelect( $c );
				
		
		
		$this->data = array();
		$i=0;
		
		foreach( $recargos as $recargo ){
			$row = array(
				'id'=>$i++,
				'idtrafico'=>$idtrafico,
				'idlinea'=>$recargo->getCaIdlinea(),
				'linea'=>$recargo->getTransportador()->getCaNombre(),
				'idrecargo'=>$recargo->getCaIdrecargo(),
				'recargo'=>utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
				'idconcepto'=>$recargo->getCaIdconcepto(),
				'concepto'=>$recargo->getCaIdconcepto()==9999?"Recargo General":utf8_encode($recargo->getConcepto()->getCaConcepto()),
				'vlrrecargo'=>$recargo->getCaVlrrecargo(),
				'vlrminimo'=>$recargo->getCaVlrminimo(),
				'aplicacion'=>utf8_encode($recargo->getCaAplicacion()),
				'aplicacion_min'=>utf8_encode($recargo->getCaAplicacionMin()),
				'idmoneda'=>$recargo->getCaIdmoneda(),
				'observaciones'=>utf8_encode($recargo->getCaObservaciones())								
			);
			$this->data[]= $row;
		}
		
		
		if( $this->opcion!="consulta" ){
			/*
			* Incluye una fila vacia que permite agregar datos
			*/
			$row = array(
				'id'=>$i++,
				'idtrafico'=>$idtrafico,
				'idlinea'=>$idlinea?$idlinea:"",
				'linea'=>'+',
				'idrecargo'=>'',
				'recargo'=>'',
				'vlrrecargo'=>'',
				'vlrminimo'=>'',
				'aplicacion'=>'',
				'aplicacion_min'=>'',
				'idmoneda'=>'',
				'observaciones'=>''								
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
	public function executeObserveRecargosPorLinea(){
		
		$idtrafico = $this->getRequestParameter("idtrafico");
		$idlinea = $this->getRequestParameter("idlinea");		
		$idrecargo = $this->getRequestParameter("idrecargo");
		$idconcepto = $this->getRequestParameter("idconcepto");
		$modalidad = $this->getRequestParameter("modalidad");
		$impoexpo = $this->getRequestParameter("impoexpo");
		//echo $impoexpo;
		
		if( !$idconcepto ){
			$idconcepto = 9999;
		}
		
		$this->forward404Unless( $idtrafico );
		$this->forward404Unless( $idlinea );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		
		$recargo = PricRecargosxLineaPeer::retrieveByPk($idtrafico, $idlinea, $idrecargo, $idconcepto , $modalidad, utf8_decode($impoexpo));
		if( !$recargo ){
			
			$recargo = new PricRecargosxLinea();
			$recargo->setCaIdTrafico( $idtrafico );
			$recargo->setCaIdlinea( $idlinea );
			$recargo->setCaIdRecargo( $idrecargo );
			$recargo->setCaModalidad( $modalidad );
			$recargo->setCaImpoexpo( utf8_decode($impoexpo) );
			$recargo->setCaVlrrecargo( 0 );
			$recargo->setCaVlrminimo( 0 );			
		}
		$user = $this->getUser();
		$recargo->setCaUsucreado( $user->getUserId() );
		$recargo->setCaFchcreado( time() );
		
		
		if( $this->getRequestParameter("idconcepto") ){
			$recargo->setCaIdconcepto( $this->getRequestParameter("idconcepto") );
		}
		
					
		if( $this->getRequestParameter("vlrrecargo") ){
			$recargo->setCaVlrrecargo( $this->getRequestParameter("vlrrecargo") );
		}
		
		if( $this->getRequestParameter("vlrminimo") ){
			$recargo->setCaVlrminimo( $this->getRequestParameter("vlrminimo") );
		}		
		
		if( $this->getRequestParameter("idmoneda") ){
			$recargo->setCaIdMoneda($this->getRequestParameter("idmoneda"));
		}	
		
		if( $this->getRequestParameter("aplicacion")!==null){
			$recargo->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
		}
		
		if( $this->getRequestParameter("aplicacion_min")!==null){
			$recargo->setCaAplicacionMin(utf8_decode($this->getRequestParameter("aplicacion_min")));
		}
		
		if( $this->getRequestParameter("observaciones")!==null){
			$recargo->setCaObservaciones(utf8_decode($this->getRequestParameter("observaciones")));
		}
								
		$recargo->save();	
		$id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");		
	}
	
	
	/*
	* Elimina un recargo general
	* @author: Andres Botero 
	*/
	public function executeEliminarRecargosPorLinea(){
		$idtrafico = $this->getRequestParameter("idtrafico");
		$idlinea = $this->getRequestParameter("idlinea");		
		$idrecargo = $this->getRequestParameter("idrecargo");
		$idconcepto = $this->getRequestParameter("idconcepto");
		$modalidad = $this->getRequestParameter("modalidad");
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		
		
		if( !$idconcepto ){
			$idconcepto = 9999;
		}
		
		$this->forward404Unless( $idtrafico );
		$this->forward404Unless( $idlinea );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		
		$recargo = PricRecargosxLineaPeer::retrieveByPk($idtrafico, $idlinea, $idrecargo, $idconcepto , $modalidad, $impoexpo);
				
		$this->responseArray = array();
		if( $recargo ){
			$recargo->delete();		
		}	
		$id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");	
	}
	
	
	/*********************************************************************
	* Parametros recargos locales naviera
	*	
	*********************************************************************/
	
	
	/*
	* Datos para los parametros de los recargos locales x naviera
	* @author: Andres Botero
	*/
	public function executeRecargosPorLineaParametrosData( $request ){
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
			
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		
		$modalidad = $this->getRequestParameter( "modalidad" );				
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		$idlinea = $this->getRequestParameter( "idlinea" );		
						
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $idlinea );
				
		
		//Se determina la identificacion del parametro para determinar en la vista que 
		//editor se va a usar
		$conceptos = array();
		$param = ParametroPeer::retrieveByCaso("CU071");
		foreach( $param as $p ){
			$conceptos[ $p->getCaIdentificacion() ]=$p->getCaValor();
		}
		
		
		$c = new Criteria();			
		$c->add( PricRecargoParametroPeer::CA_IMPOEXPO, $impoexpo  );		
		$c->add( PricRecargoParametroPeer::CA_TRANSPORTE, $transporte  );	
		$c->add( PricRecargoParametroPeer::CA_IDLINEA, $idlinea  );			
		$c->add( PricRecargoParametroPeer::CA_MODALIDAD, $modalidad  );
				
		$parametros = PricRecargoParametroPeer::doSelect( $c );
					
		$data = array();
		$i=0;
		
		foreach( $parametros as $parametro ){
			$row = array(
				'idconcepto'=>array_search($parametro->getCaConcepto(),$conceptos ),
				'concepto'=>utf8_encode($parametro->getCaConcepto()),
				'valor'=>utf8_encode($parametro->getCaValor()),
				'observaciones'=>utf8_encode($parametro->getCaObservaciones())						
			);
			$data[]= $row;
		}
		
		
		if( $this->nivel>0 ){
			/*
			* Incluye una fila vacia que permite agregar datos
			*/
			$row = array(
				'concepto'=>'+',
				'valor'=>'',
				'observaciones'=>''					
			);
			$data[]= $row;
		}
		
		$this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");		
	}
	
	/*
	* Guarda los cambios de un parametro de los recargos locales
	* @author: Andres Botero
	*/
	public function executeObserveRecargosParametros( $request ){
		
		$idlinea = $this->getRequestParameter("idlinea");		
		
		$modalidad = $this->getRequestParameter("modalidad");
		$transporte = $this->getRequestParameter("transporte");
		$impoexpo = $this->getRequestParameter("impoexpo");
		//echo $impoexpo;
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $idlinea );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		
		$parametro = PricRecargoParametroPeer::retrieveByPk($idlinea, $transporte, $modalidad,utf8_decode($impoexpo));
		if( !$parametro ){
			
			$parametro = new PricRecargoParametro();	
			$parametro->setCaIdlinea( $idlinea );
			$parametro->setCaImpoexpo( $impoexpo );
			$parametro->setCaTransporte( $transporte );
			$parametro->setCaModalidad( $modalidad );				
			$parametro->setCaUsucreado( $this->getUser()->getUserId() );
			$parametro->setCaFchcreado( time() );			
		}
		
		if( $this->getRequestParameter("concepto") ){
			$parametro->setCaConcepto( utf8_decode($this->getRequestParameter("concepto") ) );
		}
					
		if( $this->getRequestParameter("valor") ){
			$parametro->setCaValor( utf8_decode($this->getRequestParameter("valor")) );
		}
		
		if( $this->getRequestParameter("observaciones")!==null ){
			$parametro->setCaObservaciones( utf8_decode($this->getRequestParameter("observaciones")) );
		}		
						
		$parametro->save();	
		$id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");	
	}
	
	/*
	* Permite la administración y consulta de los trayectos (tiempos de transito 
	* y frecuencia) 
	* @author: Andres Botero
	*/
	public function executeEliminarParametroRecargos( $request ){
		$transporte = $this->getRequestParameter( "transporte" );		
		$modalidad = $this->getRequestParameter( "modalidad" );				
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		$idlinea = $this->getRequestParameter( "idlinea" );		
						
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $idlinea );
		
		$parametro = PricRecargoParametroPeer::retrieveByPk($idlinea, $transporte, $modalidad,$impoexpo);
		$success = false;
		if( $parametro ){
			$parametro->delete();
			$success = true;
		}
		
		
		$id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>$success);	
		$this->setTemplate("responseTemplate");	
	}
	
	
	/*********************************************************************
	* Patios recargos locales x naviera
	*	
	*********************************************************************/
	public function executeRecargosLocalesPatiosData(){
		$transporte = $this->getRequestParameter( "transporte" );		
		$modalidad = $this->getRequestParameter( "modalidad" );				
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		$idlinea = $this->getRequestParameter( "idlinea" );		
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
			
		if( $this->nivel==-1 ){
			$this->forward404();
		}
								
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $idlinea );
		
		
		$c = new Criteria();
			
		$c->add( PricPatioLineaPeer::CA_IDLINEA, $idlinea  );
		$c->add( PricPatioLineaPeer::CA_IMPOEXPO, $impoexpo  );
		$c->add( PricPatioLineaPeer::CA_TRANSPORTE, $transporte  );
		$c->add( PricPatioLineaPeer::CA_MODALIDAD, $modalidad  );
		$patiosLineas = PricPatioLineaPeer::doSelect( $c );
		
		$patiosLineaArray = array(); 
		
		foreach( $patiosLineas as $pl ){
			$patiosLineaArray[ $pl->getCaIdpatio() ] = $pl->getCaObservaciones();
		}
				
		
				
		$c = new Criteria();			
		if( $this->nivel==0 ){
			$c->addJoin( PricPatioPeer::CA_IDPATIO, PricPatioLineaPeer::CA_IDPATIO );			
		}	
		$c->addJoin( PricPatioPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );		
		$c->addAscendingOrderByColumn( PricPatioPeer::CA_NOMBRE );		
		$patios = PricPatioPeer::doSelect( $c );
					
		$data = array();
		$i=0;
		
		foreach( $patios as $patio ){
			
			if( array_key_exists( $patio->getCaIdpatio(), $patiosLineaArray) ){
				
				$sel = true;
				$observaciones = $patiosLineaArray[$patio->getCaIdpatio()];
			}else{
				$sel = false;
				$observaciones = "";
			}
		
			$row = array(
				'sel'=>$sel,
				'idpatio'=>$patio->getCaIdpatio(),
				'nombre'=>utf8_encode($patio->getCaNombre()),
				'direccion'=>utf8_encode($patio->getCaDireccion()),
				'ciudad'=>utf8_encode( $patio->getCiudad()->getCaCiudad() ),
				'observaciones'=>utf8_encode($observaciones)						
			);
			$data[]= $row;
		}
				
		
		$this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");	
		
	}	
	
	
	/*********************************************************************
	* Administrador de trayectos, tiempos de transito y frecuencias
	*	
	*********************************************************************/
	public function executeObserveRecargosLocalesPatios( $request ){
		$transporte = $this->getRequestParameter( "transporte" );		
		$modalidad = $this->getRequestParameter( "modalidad" );				
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		$idlinea = $this->getRequestParameter( "idlinea" );		
		$patios = $this->getRequestParameter( "patios" );		
						
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $idlinea );
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
			
		if( $this->nivel<1 ){
			$this->forward404();
		}
		
		//Borra todo
		$c = new Criteria();
		$c->add( PricPatioLineaPeer::CA_IDLINEA, $idlinea  );
		$c->add( PricPatioLineaPeer::CA_IMPOEXPO, $impoexpo  );
		$c->add( PricPatioLineaPeer::CA_TRANSPORTE, $transporte  );
		$c->add( PricPatioLineaPeer::CA_MODALIDAD, $modalidad  );
		$patiosObj = PricPatioLineaPeer::doSelect( $c );
		
		foreach( $patiosObj as $patioObj ){
			$patioObj->delete();
		}
		
		
		
		if( $patios ){
		
			$patios = explode("|", $patios );
			foreach( $patios as $patio ){
				$idx = strpos( $patio , "," );	
				$idpatio = substr( $patio, 0, $idx );
				$observaciones = substr( $patio, $idx+1 );
				
				$patio = new PricPatioLinea();
				$patio->setCaIdpatio( $idpatio );
				if( $observaciones ){
					$patio->setCaObservaciones( $observaciones );
				}else{
					$patio->setCaObservaciones( null );	
				}
				$patio->setCaTransporte( $transporte );
				$patio->setCaModalidad( $modalidad );
				$patio->setCaImpoexpo( $impoexpo );
				$patio->setCaIdlinea( $idlinea );
				$patio->save();
			}		
		}
				
		$this->setLayout("ajax");		
		$this->responseArray = array("success"=>true);	
		$this->setTemplate("responseTemplate");	
								
	}
		 
	/*
	* Permite la administración y consulta de los trayectos (tiempos de transito 
	* y frecuencia) 
	* @author: Andres Botero
	*/
	public function executeAdminTrayectos( $request ){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		
		
		$this->forward404Unless( $modalidad );	
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $idtrafico );	
		$this->forward404Unless( $transporte );	
		
		
		
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);		
		$this->idcomponent = "admtraf_".$this->trafico->getCaIdTrafico()."_".$transporte."_".$modalidad;
		
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		
		$this->titulo = "T.T. Freq. ".$this->trafico->getCaNombre()." ".$modalidad." ".substr($impoexpo,0,4);
				
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );	
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );	
		$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );	
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		//$c->setLimit(20);
		$trayectos = TrayectoPeer::doSelect( $c );
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		$this->forward404Unless( $this->trafico );
		$this->conceptos = $this->trafico->getConceptos( $transporte, $modalidad );
				
		
		$this->impoexpo = $impoexpo;			
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;					
		$this->linea = "";		
		
		
		
		$this->setLayout("ajax");
	}
	
	/*
	* Muestra los datos para la administración de trayectos
	*/
	public function executeDatosAdminTrayectos(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );	
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));	
		$start = $this->getRequestParameter( "start" );
		$limit = $this->getRequestParameter( "limit" );
				
		
		
		$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		
		$c = new Criteria();
		if( $impoexpo == Constantes::EXPO){
			$c->addJoin( TrayectoPeer::CA_DESTINO, CiudadPeer::CA_IDCIUDAD );
		}else{
			$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		}
		$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );
		$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
		$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );
				

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
			
			$trayectoStr = utf8_encode(strtoupper($trayecto->getOrigen()->getCaCiudad()))."»".utf8_encode(strtoupper($trayecto->getDestino()->getCaCiudad()));
			
			
			$row = array(
				'idtrayecto' => $trayecto->getCaIdtrayecto(),
				'trayecto' =>utf8_encode($trayectoStr),
				'origen'=>utf8_encode($trayecto->getOrigen()->getCaCiudad()),
				'destino'=>utf8_encode($trayecto->getDestino()->getCaCiudad()), 
				'linea'=> $transportador?utf8_encode($transportador->getCaNombre()):"",
				'ttransito'=>utf8_encode($trayecto->getCaTiempotransito()),
				'frecuencia'=>$trayecto->getCaFrecuencia(),
				'activo'=>$trayecto->getCaActivo()
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
		
		if( $this->getRequestParameter("activo")!==null ){
			
			if( $this->getRequestParameter("activo")=="true" ){
				$trayecto->setCaActivo( true );
			}else{
				$trayecto->setCaActivo( false );
				
			}
		}	
		
		$trayecto->save();
		return sfView::NONE;
	}
	
	/*********************************************************************
	* Seguros
	*	
	*********************************************************************/
	public function executeGrillaSeguros(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		
		$this->transporte = utf8_decode($this->getRequestParameter("transporte"));
		$this->forward404Unless( $this->transporte );
		
		$this->idcomponent = "seguros_".$this->transporte;
		$c = new Criteria();		
		$c->addAscendingorderByColumn( TraficoGrupoPeer::CA_DESCRIPCION );		
		$grupos = TraficoGrupoPeer::doSelect( $c );
		
		$this->data = array();
		foreach( $grupos as $grupo ){
			$row = array(
						'idgrupo'=>$grupo->getCaIdGrupo(),
						'grupo'=>utf8_encode($grupo->getCaDescripcion())
					);
			$seguro = PricSeguroPeer::retrieveByPk( $grupo->getCaIdGrupo(), $this->transporte );				
			if( $seguro ){
				$row['vlrprima']=$seguro->getCaVlrprima();
				$row['vlrminima']=$seguro->getCaVlrminima();
				$row['vlrobtencionpoliza']=$seguro->getCaVlrobtencionpoliza();
				$row['idmoneda']=$seguro->getCaIdmoneda();
				$row['observaciones']=$seguro->getCaObservaciones();
				
			}
			$this->data[] = $row;		
		}		
		$this->setLayout("ajax");
	}
	
	/*
	* Guarda los datos de los seguros
	*/
	public function executeObserveGrillaSeguros(){
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$idgrupo = utf8_decode($this->getRequestParameter("idgrupo"));
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $idgrupo );
		
		$seguro = PricSeguroPeer::retrieveByPk( $idgrupo, $transporte );
		if(!$seguro){
			$seguro = new PricSeguro();
			$seguro->setCaIdGrupo( $idgrupo );
			$seguro->setCaTransporte( $transporte );			
		}
		
		if( $this->getRequestParameter("vlrprima") ){
			$seguro->setCaVlrprima( $this->getRequestParameter("vlrprima") );
		}
		
		if( $this->getRequestParameter("vlrminima") ){
			$seguro->setCaVlrminima( $this->getRequestParameter("vlrminima") );
		}
				
		if( $this->getRequestParameter("vlrobtencionpoliza") ){
			$seguro->setCaVlrobtencionpoliza( $this->getRequestParameter("vlrobtencionpoliza") );
		}
		
		if( $this->getRequestParameter("idmoneda") ){
			$seguro->setCaIdmoneda( $this->getRequestParameter("idmoneda") );
		}
		
		if( $this->getRequestParameter("observaciones") ){
			$seguro->setCaObservaciones( $this->getRequestParameter("observaciones") );
		}		
		$seguro->save();
		return sfView::NONE;
		
	}
		
	/*********************************************************************
	* Administrador de archivos
	*	
	*********************************************************************/
	
	/*
	* Genera la pestaña donde se muestran los archivos 
	* @author: Andres Botero 
	*/
	public function executeArchivosPais(){
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
	
		$this->setLayout("ajax");
		$idtrafico = $this->getRequestParameter("idtrafico");
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$transporte = utf8_decode($this->getRequestParameter("transporte"));	
		$modalidad = utf8_decode($this->getRequestParameter("modalidad"));	
				
		$this->impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$this->forward404Unless( $this->impoexpo );
				
		$modalidad = $this->getRequestParameter( "modalidad" );					
		$idtrafico = $this->getRequestParameter( "idtrafico" );
			
		$this->trafico = TraficoPeer::retrieveByPk($idtrafico);	
		$this->forward404Unless( $this->trafico );
			
		$this->idcomponent = substr($this->impoexpo,0,1)."_".$this->trafico->getCaIdTrafico()."_".$transporte."_".$modalidad;
						
		$this->forward404Unless( $idtrafico );
		
		
		$this->impoexpo = utf8_encode($impoexpo);
		$this->transporte = utf8_encode($transporte);
		$this->modalidad = $modalidad;
	}
	//Datos para el administrador de archivos
	public function executeDataArchivosPais(){
		$this->setLayout("ajax");
		$idtrafico = $this->getRequestParameter("idtrafico");
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$transporte = utf8_decode($this->getRequestParameter("transporte"));	
		$modalidad = utf8_decode($this->getRequestParameter("modalidad"));	
		
		$c = new Criteria();
		$c->add(PricArchivoPeer::CA_IDTRAFICO, $idtrafico );
		$c->add(PricArchivoPeer::CA_TRANSPORTE, $transporte );
		$c->add(PricArchivoPeer::CA_IMPOEXPO, $impoexpo );
		$c->add(PricArchivoPeer::CA_MODALIDAD, $modalidad );		
		$c->addSelectColumn( PricArchivoPeer::CA_IDARCHIVO );
		$c->addSelectColumn( PricArchivoPeer::CA_NOMBRE );
		$c->addSelectColumn( PricArchivoPeer::CA_TAMANO );
		$c->addSelectColumn( PricArchivoPeer::CA_DESCRIPCION );
		$c->addSelectColumn( PricArchivoPeer::CA_FCHCREADO );
		$c->addSelectColumn( PricArchivoPeer::CA_USUCREADO );
		$stmt = PricArchivoPeer::doSelectStmt( $c );
		
		$this->files = array();
		
		while ( $row = $stmt->fetch(PDO::FETCH_NUM) ) {
      		$this->files[] = array('idarchivo'=>$row[0],
							   	  'name'=>utf8_encode($row[1]),
								  'size'=>utf8_encode($row[2]),
								  'descripcion'=>utf8_encode($row[3]),
								  'lastmod'=>utf8_encode($row[4]),      
								  'usucreado'=>utf8_encode($row[5])
							 );
		}	
		
	}
		
	/*
	* Procesa el archivo que se ha subido en la accion ArchivosPais 
	* @author: Andres Botero 
	*/
	public function executeSubirArchivo(){
		
		sfConfig::set('sf_web_debug', false) ;	
		$idtrafico = $this->getRequestParameter("idtrafico");	
		$transporte = utf8_decode($this->getRequestParameter("transporte"));	
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));	
		$modalidad = utf8_decode($this->getRequestParameter("modalidad"));	
			
		$this->forward404Unless($idtrafico);	
			
		if ( count( $_FILES )>0 ){		 	
			foreach ( $_FILES as $uploadedFile){
				
				$fileName  = $uploadedFile['name'];
				$fileSize  = $uploadedFile['size'];
				$fileType  = $uploadedFile['type'];				
				$path = $uploadedFile['tmp_name'];		
				
				$fileObj = new PricArchivo();
				$fileObj->setCaTamano($fileSize);
				$fileObj->setCaNombre($fileName);				
				$fileObj->setCaTipo($fileType);
				$fileObj->setCaIdTrafico($idtrafico);
				$fileObj->setCaTransporte($transporte);
				$fileObj->setCaModalidad($modalidad);
				$fileObj->setCaImpoExpo($impoexpo);
				$fp = fopen($path, "r");
				$data = fread( $fp , $fileSize);
				fclose( $fp );
				$fileObj->setCaDatos($data);
				$fileObj->setCaFchcreado(time());
				$user = $this->getUser();
				$fileObj->setCaUsucreado($user->getUserid());
				$fileObj->save();	
				$id = $fileObj->getCaIdArchivo();
				
				$this->responseArray = array("id"=>$fileObj->getCaIdArchivo(), "filename"=>$fileName, "success"=>true);				
			
		  	}
		}else{
			$this->responseArray = array("success"=>false);
		}
		$this->setLayout("ajax");		
		$this->setTemplate("responseTemplate");				
	}	
	
	/*
	* Permite visualizar un archivo del panel 
	* @author: Andres Botero 
	*/
	public function executeVerArchivo(){
		$this->archivo = PricArchivoPeer::retrieveByPk( $this->getRequestParameter("idarchivo") );
		$this->forward404Unless( $this->archivo );				
    	session_cache_limiter('public'); 
	}
	
	/*
	* Permite borrar el archivo  
	* @author: Andres Botero 
	*/
	public function executeBorrarArchivo(){
		$id = $this->getRequestParameter("id");
		$this->archivo = PricArchivoPeer::retrieveByPk( $this->getRequestParameter("idarchivo") );
		$this->forward404Unless( $this->archivo );
		$this->archivo->delete(); 
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");		
	}
	
	/*
	* Muestra las ciudades y las devuelve en forma de arbol, el cliente 
	* toma los datos y los coloca en un objeto Ext.tree.TreePanel
	* Los nodos de las ciudades y las lineas se cargan cuando el usuario
	* hace click sobre los iconos ciudad y lineas 
	* @author: Andres Botero
	*/
	
	public function executeDatosCiudades( $request ){
				
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		
		$node = $this->getRequestParameter("node");
		
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		if(substr($node,0,4)!="impo" && substr($node,0,4)!="expo"){ 	
			$c = new Criteria();
			$c->setDistinct();
			if( $impoexpo==Constantes::IMPO ){
				$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
			}else{
				$c->addJoin( TrayectoPeer::CA_DESTINO, CiudadPeer::CA_IDCIUDAD );
			}
			$c->addJoin( CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO );
			$c->addJoin( TraficoPeer::CA_IDGRUPO, TraficoGrupoPeer::CA_IDGRUPO );		
			$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );
			$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );			
			$c->add( TrayectoPeer::CA_ACTIVO, true );
			$c->addSelectColumn( TrayectoPeer::CA_MODALIDAD );	
			$c->addSelectColumn( TraficoGrupoPeer::CA_DESCRIPCION );		
			$c->addSelectColumn( TraficoPeer::CA_NOMBRE );		
			$c->addSelectColumn( TraficoPeer::CA_IDTRAFICO );		
			$c->addAscendingOrderByColumn( TrayectoPeer::CA_MODALIDAD );	
			$c->addAscendingOrderByColumn( TraficoGrupoPeer::CA_DESCRIPCION );		
			$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
			
			$stmt = TraficoPeer::doSelectStmt( $c );			
			$this->results = array();
			$modalidades = array();
			while($row = $stmt->fetch(PDO::FETCH_NUM)){
				$modalidad = $row[0];
				$grupo = $row[1];
				$pais = $row[2];
				$idtrafico = $row[3];
				
				$this->results[$modalidad][$grupo][]=array("idtrafico"=>$idtrafico, "pais"=>$pais);
				$modalidades[]=$modalidad;
			}
			
			$modalidades = array_unique( $modalidades );
			$this->lineas = array();
			
			foreach( $modalidades as $modalidad ){
				$c = new Criteria();			
				if( $impoexpo==Constantes::IMPO ){
					$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );		
				}else{
					$c->addJoin( TrayectoPeer::CA_DESTINO, CiudadPeer::CA_IDCIUDAD );			
				}
				$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );		
				
				$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );
				$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
				$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );			
				$c->add( TrayectoPeer::CA_ACTIVO, true );
				$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );
				$c->setDistinct();	
				$this->lineas[$modalidad] = TransportadorPeer::doSelect( $c );
			}
		}else{

			$opciones = explode("_", $node);			
			$modalidad = $opciones[2];
			$idtrafico = $opciones[3];
			
			$c = new Criteria();
			if( $impoexpo==Constantes::IMPO ){
				$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );		
			}else{
				$c->addJoin( TrayectoPeer::CA_DESTINO, CiudadPeer::CA_IDCIUDAD );			
			}
			$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
			$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );
			$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
			$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
			$c->add( TrayectoPeer::CA_ACTIVO, true );
			$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );	 
			$c->setDistinct();	
			$this->ciudades = CiudadPeer::doSelect( $c );
			
			
			$c = new Criteria();
			
			if( $impoexpo==Constantes::IMPO ){
				$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );		
			}else{
				$c->addJoin( TrayectoPeer::CA_DESTINO, CiudadPeer::CA_IDCIUDAD );			
			}
			$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );		
			$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
			$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );
			$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
			$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
			$c->add( TrayectoPeer::CA_ACTIVO, true );
			$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );
			$c->setDistinct();	
			$this->lineas = TransportadorPeer::doSelect( $c );
			
			$this->idtrafico=$idtrafico;
			$this->modalidad=$modalidad;			
			
			$this->setTemplate("datosCiudadesTrayectos");
			
		}
		$this->transporte = $transporte;
		$this->impoexpo = strtolower(substr( $impoexpo,0 ,4 ));				
		$this->setLayout("ajax");
		
	}
	
	/*
	Primera versión
	*/
	public function executeDatosCiudadesBck( $request ){
		
		$this->transporte = $this->getRequestParameter("transporte");
		$this->impoexpo = $this->getRequestParameter("impoexpo");
		if( $this->transporte=="Marítimo"){
			$this->modalidades = ParametroPeer::retrieveByCaso("CU051", null,$this->impoexpo );
		}
		if( $this->transporte=="Aéreo"){
			$this->modalidades = ParametroPeer::retrieveByCaso("CU052", null,$this->impoexpo );
		}
		if( $this->transporte=="Terrestre"){
			$this->modalidades = ParametroPeer::retrieveByCaso("CU053", null,$this->impoexpo );
		}
		
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( TraficoGrupoPeer::CA_DESCRIPCION );
		$this->grupos = TraficoGrupoPeer::doSelect( $c );
		
		$this->setLayout("ajax");
		
	}
	
	/*********************************************************************
	* Notificaciones
	*	
	*********************************************************************/
		
	/*
	* Acciones del panel de notificaciones
	* @author: Andres Botero 
	*/
	public function executeGuardarNotificacion(){
		$titulo=$this->getRequestParameter("titulo");
		$mensaje=$this->getRequestParameter("mensaje");
		$caducidad=$this->getRequestParameter("caducidad");
		
		$user = $this->getUser();
		$notificacion = null;
		if( $this->getRequestParameter("idnotificacion") ){
			$notificacion = PricNotificacionPeer::retrieveByPk( $this->getRequestParameter("idnotificacion") );			
		}
		if( !$notificacion ){
			$notificacion = new PricNotificacion();
		}
		$notificacion->setCaTitulo($titulo);
		$notificacion->setCaMensaje($mensaje);
		$notificacion->setCaCaducidad($caducidad);
		$notificacion->setCaUsucreado($user->getUserId());
		
		$this->fchcreado = date("Y-m-d h:i:s", time());
		$notificacion->setCaFchcreado( $this->fchcreado );
		$notificacion->save();
		$this->idnotificacion = $notificacion->getCaIdNotificacion();	
		
		$this->responseArray = array("idnotificacion"=>$this->idnotificacion, 
									"fchcreado"=>$this->fchcreado,
									"mensaje"=>$mensaje,
									"titulo"=>$titulo,
									"caducidad"=>$caducidad, 
									"usucreado"=>$user->getUserId(),
									"success"=>true);	
		$this->setTemplate("responseTemplate");
		$this->setLayout("ajax");
			
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
	
	/*********************************************************************
	* Control de cambios	 
	*	
	*********************************************************************/
	
	/*
	* Determina todas las fechas en que se realizaron cambios
	* @author: Andres Botero 
	*/
	public function executeHistorialCambiosBusqueda(){
		$idtrayecto = $this->getRequestParameter("idtrayecto");
		$this->forward404Unless($idtrayecto);
		
		$trayecto = TrayectoPeer::retrieveByPK($idtrayecto); 
		if( $trayecto->getCaImpoexpo()==Constantes::IMPO ){
			$idciudad = $trayecto->getCaOrigen();			
		}else{
			$idciudad = $trayecto->getCaDestino();			
		}
		
		$hoy = date("Y-m-d");
		$ayer = date("Y-m-d", time()-86400);
		
		$this->data = array();
				
		$sql = "SELECT ca_fchcreado, ca_usucreado FROM log_pricfletes WHERE ca_idtrayecto = ".$idtrayecto." 
			UNION 
		SELECT ca_fchcreado, ca_usucreado FROM log_pricrecargosxconcepto WHERE ca_idtrayecto = ".$idtrayecto." 
			UNION 
		SELECT ca_fchcreado, ca_usucreado FROM log_pricrecargosxciudad WHERE ca_idciudad = '".$idciudad."' OR ca_idciudad = '999-9999'
		ORDER BY ca_fchcreado DESC LIMIT 200";
		
		$con = Propel::getConnection(PricFleteLogPeer::DATABASE_NAME);
		
		$stmt = $con->prepare($sql);
		$stmt->execute();	 
		while($row = $stmt->fetch()){									
			$timestamp = strtotime( $row['ca_fchcreado'] )+1;
			
			if( date("Y-m-d", $timestamp )==$hoy ){
				$fecha="Hoy";
			}elseif( date("Y-m-d", $timestamp )==$ayer ){
				$fecha="Ayer";
			}else{
				$fecha=date("Y-m-d",$timestamp);
			}
		
			$this->data[] =  array("idtrayecto" =>  $idtrayecto,								
								"timestamp" => $timestamp,								
								"fchcreado" => $fecha,
								"horacreado" => date("h:i:s A", $timestamp ),
								"usucreado" => $row['ca_usucreado']
						  );	
		}
						
	}
	
	/*
	* Muestra el tarifario de acuerdo a la hora seleccionada
	* @author: Andres Botero 
	*/
	public function executeHistorialCambios( $request ){
		$idtrayecto = $this->getRequestParameter("idtrayecto");		
		$trayecto = TrayectoPeer::retrieveByPk( $idtrayecto );
		$this->forward404Unless( $trayecto );
		
		$timestamp = $this->getRequestParameter("timestamp");
		$this->forward404Unless( $timestamp );
		$timestamp2 = $this->getRequestParameter("timestamp2");
		$this->forward404Unless( $timestamp2 );
		
			
		$request->setParameter( "timestamp", $timestamp );
		$request->setParameter( "timestamp2", $timestamp2 );
		
		$request->setParameter( "transporte", utf8_encode($trayecto->getCaTransporte()) );
		$request->setParameter( "impoexpo", utf8_encode($trayecto->getCaImpoexpo() ));		
		$request->setParameter( "modalidad", $trayecto->getCaModalidad() );
		$request->setParameter( "idlinea", $trayecto->getCaIdlinea() );	
		$request->setParameter( "opcion", "consulta" );	
		
		if( $trayecto->getCaImpoexpo()==Constantes::IMPO ){
			$origen = $trayecto->getOrigen();
			$request->setParameter( "idtrafico", $origen->getCaIdtrafico() );
			$request->setParameter( "idciudad", $trayecto->getCaOrigen() );
			$request->setParameter( "idciudad2", $trayecto->getCaDestino() );			
		}else{
			$destino = $trayecto->getDestino();
			$request->setParameter( "idtrafico", $destino->getCaIdtrafico() );
			$request->setParameter( "idciudad", $trayecto->getCaDestino() );
			$request->setParameter( "idciudad2", $trayecto->getCaOrigen() );
		}
		$this->forward("pricing", "grillaPorTrafico");
								
	}
	
	/*********************************************************************
	* Otros
	*	
	*********************************************************************/		
	
	/*
	* Datos de los conceptos para ser mostrados en un combobox
	*/	
	public function executeDatosConceptos(){
		
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$modalidad = utf8_decode($this->getRequestParameter("modalidad"));
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$tipo = utf8_decode($this->getRequestParameter("tipo"));
		$modo = $this->getRequestParameter("modo");
		
		$this->forward404Unless( $transporte );
		
		if( $modo=="recargos" ){				
			$c = new Criteria();
			$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
			$c->add( TipoRecargoPeer::CA_TIPO, $tipo );		
			$c->add( TipoRecargoPeer::CA_IMPOEXPO, "%".$impoexpo."%", Criteria::LIKE );		
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
			
			$this->conceptos[] = array("idconcepto"=>9999,
								 "concepto"=>utf8_encode("Recargos generales del trayecto")	
								);
			
		}	
		$this->setLayout("ajax");
	}
	
	
				
	
}
?>
