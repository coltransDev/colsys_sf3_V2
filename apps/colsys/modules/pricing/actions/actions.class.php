<?php

/**
 * pricing actions.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
//$this->redirect("/users/logout");

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
		

		$this->modalidades_mar = ParametroTable::retrieveByCaso( "CU051" );
		$this->modalidades_aer = ParametroTable::retrieveByCaso( "CU052" );
		$this->modalidades_ter = ParametroTable::retrieveByCaso( "CU053" );
		

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
		
		$this->directory = sfConfig::get("app_digitalFile_pricing");
	}	
	
	/*********************************************************************
	* Recargos x Concepto
	*
	*********************************************************************/
	
	/*
	* Esta acción se ejecuta cuando un usuario hace click sobre la hoja del arbol 
	* seleccionando un pais, esta accion devuelve una grilla donde se colocan
	* los valores de los conceptos.
    *
    * Retorna un Panel que se coloca en el tab panel principal.
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

        if( $this->getRequestParameter( "opcion" )=="consulta" ){
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
        
        if( $this->getRequestParameter( "fechacambio" ) ){
            $fechacambio = str_replace("|","-", $this->getRequestParameter( "fechacambio" ) );
            $this->timestamp = strtotime($fechacambio." ".$this->getRequestParameter( "horacambio" ));
            $this->opcion = "consulta";
        }else{
            $this->timestamp = null;
        }
        
		if( $idtrafico ){
			$this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);
					
			$this->forward404Unless( $this->trafico );
				
			$this->idcomponent .= "_".$this->trafico->getCaIdtrafico()."_".$transporte."_".$modalidad;
			
			$this->titulo .= "»".substr($this->impoexpo,0,4)."»".$this->trafico->getCaNombre();
						
			if( $idciudad ){	
				$ciudad = Doctrine::getTable("Ciudad")->find( $idciudad );
				$this->titulo .= "»".$ciudad->getCaCiudad();
				$this->idcomponent.= "_ciudad_".$idciudad;
			}
			
			if( $idciudad2 ){	
				$ciudad = Doctrine::getTable("Ciudad")->find( $idciudad2 );
				$this->titulo .= "»".$ciudad->getCaCiudad();
				$this->idcomponent.= "_ciudad2_".$idciudad2;
			}
			
			if( $idlinea ){			
				
				$linea = Doctrine::getTable("IdsProveedor")->find( $idlinea );

                if( $linea->getCaSigla() ){
                    $this->titulo .= "»".$linea->getCaSigla();
                }else{
                    $id = $linea->getIds();
                    $this->titulo .= "»".$id->getCaNombre();
                }
				$this->idcomponent.= "_linea_".$idlinea;
			}			
			
		}
			
		if( $this->timestamp  ){					
			$fchcorte = date( "Y-m-d H:i:s", $this->timestamp );					
			$this->titulo .= "»".$fchcorte;//." - ".$fchregistro;
			$this->idcomponent.= "_".$this->timestamp;			
		}

        
        //exit( $fchcorte );
		//$this->aplicaciones = ParametroTable::retrieveByCaso( "CU060", null, $transporte );
		
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;		
		$this->idciudad = $idciudad;
		$this->idciudad2 = $idciudad2;
		$this->idlinea = $idlinea;
		$this->linea = "";		
		
		//Datos para el combo recargos		
		$tipo = Constantes::RECARGO_EN_ORIGEN;
		$this->recargos = Doctrine::getTable("TipoRecargo")
                                    ->createQuery("t")
                                    ->where("t.ca_tipo = ? AND t.ca_transporte = ?",array($tipo, $transporte))
                                    ->addOrderBy("t.ca_recargo")
                                    ->execute();
        $this->conceptos = Doctrine::getTable("Concepto")
                                    ->createQuery("c")
                                    ->where(" c.ca_transporte = ? AND c.ca_modalidad = ?",array($transporte, $modalidad))
                                    ->addOrderBy("c.ca_liminferior")
                                    ->addOrderBy("c.ca_concepto")
                                    ->execute();

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

        if( $this->getRequestParameter( "opcion" )=="consulta" ){
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
				
		$this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);
        
        $this->forward404Unless($this->trafico);

		//Busqueda historica
		$timestamp = $this->getRequestParameter("timestamp");
		
		if( $timestamp ){
			$fchcorte = date( "Y-m-d H:i:s", $timestamp );			
		}else{
			$fchcorte = date( "Y-m-d H:i:s" );
		}

        $q = Doctrine_Query::create()
                    ->select("t.ca_idtrayecto, p.ca_sigla, id.ca_nombre, t.ca_origen, 
                              t.ca_destino, t.ca_idlinea, o.ca_ciudad, d.ca_ciudad,
                              ai.ca_nombre, a.ca_idagente, t.ca_transporte, t.ca_modalidad,
                              t.ca_impoexpo, t.ca_observaciones, t.ca_tiempotransito, t.ca_frecuencia")
                    ->from("Trayecto t");
        $q->innerJoin( "t.Origen o" );
        $q->innerJoin( "t.Destino d" );
        $q->innerJoin( "t.IdsProveedor p" );
        $q->innerJoin( "p.Ids id" );
        $q->leftJoin( "t.IdsAgente a" );
        $q->leftJoin( "a.Ids ai" );
        $q->where("t.ca_impoexpo = ? ", $impoexpo );
        $q->addWhere("t.ca_transporte = ? ", $transporte );
        $q->addWhere("t.ca_modalidad = ? ", $modalidad );
        $q->addWhere("t.ca_activo = ? ", true );
        $q->addWhere("p.ca_activo = ? ", true );
        $q->addWhere("(a.ca_activo = ? OR a.ca_activo IS NULL)", true );

        if( $impoexpo==Constantes::IMPO ){
            $q->addWhere("o.ca_idtrafico = ? ", $this->trafico->getCaIdtrafico() );
        }else{
            $q->addWhere("d.ca_idtrafico = ? ", $this->trafico->getCaIdtrafico() );
        }

        

        if( $impoexpo==Constantes::IMPO ){
            if( $idciudad ){
                $q->addWhere("t.ca_origen = ? ", $idciudad );
            }
            if( $idciudad2 ){
                $q->addWhere("t.ca_destino = ? ", $idciudad2 );
            }
        }else{
            if( $idciudad ){
                $q->addWhere("t.ca_destino = ? ", $idciudad );
            }
            if( $idciudad2 ){
                $q->addWhere("t.ca_origen = ? ", $idciudad2 );
            }
        }
        
		if( $idlinea ){
            $q->addWhere("t.ca_idlinea = ? ", $idlinea );
		}

        $q->addOrderBy("id.ca_nombre ASC");
        if( $limit ){
            $q->limit( $limit );
        }
        if( $start ){
            $q->offset( $start );
        }
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $trayectos = $q->execute();

		$data=array();
		$transportador_id = null;
		
		$i=0;


        $ultCiudad = null;
        $ultLinea = null;

		foreach( $trayectos as $trayecto ){
            //Por este campo se agrupan los conceptos
			$trayectoStr = strtoupper($trayecto["o_ca_ciudad"])."»".strtoupper($trayecto["d_ca_ciudad"])." - ";
			
			$trayectoStr.=$trayecto["p_ca_sigla"]?$trayecto["p_ca_sigla"]:$trayecto["id_ca_nombre"];

			if( $trayecto["ai_ca_nombre"] ){
				$trayectoStr.=" [".$trayecto["ai_ca_nombre"]."] ";
			}            
			$trayectoStr.=" (TT ".$trayecto["t_ca_tiempotransito"]." Freq. ".$trayecto["t_ca_frecuencia"].") ".$trayecto["t_ca_idtrayecto"];			
			$trayectoStr = utf8_encode($trayectoStr);
           

            $baseRow = array (
					'idtrayecto' => $trayecto["t_ca_idtrayecto"],
					'trayecto' =>$trayectoStr,					
					'origen' => $trayecto["t_ca_origen"],
                    'destino' => $trayecto["t_ca_destino"],
                    'idlinea' => $trayecto["t_ca_idlinea"]					

				);

            $recargosGenerales = array();


            if( $timestamp ){
                $q = Doctrine_Query::create()->from("PricRecargoxConceptoBs r");
                $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxConceptoBs rh WHERE rh.ca_fchcreado<= ? AND
                         r.ca_idconcepto = rh.ca_idconcepto AND r.ca_idrecargo = rh.ca_idrecargo AND r.ca_idtrayecto = rh.ca_idtrayecto ORDER BY rh.ca_consecutivo DESC LIMIT 1 )", $fchcorte );
            }else{
                 $q = Doctrine_Query::create()->from("PricRecargoxConcepto r");
            }
            $q->innerJoin("r.TipoRecargo t");
            $q->addWhere("r.ca_idtrayecto = ? AND r.ca_idconcepto = ?", array($trayecto["t_ca_idtrayecto"],'9999'));
            
            $q->addOrderBy("t.ca_recargo");
            $pricRecargosGen = $q->execute();

            if( $pricRecargosGen ){
                foreach( $pricRecargosGen as $pricRecargo ){
                    if( $pricRecargo->getCaFcheliminado() ){
                        continue;
                    }
                    $tipoRecargo = $pricRecargo->getTipoRecargo();
                    $sugerida=$pricRecargo->getCaVlrrecargo();
                    $minima=$pricRecargo->getCaVlrminimo();
                    $row = array (
                        'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                        'idconcepto'=>'9999',
                        'inicio' => $pricRecargo->getCaFchinicio(),
                        'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                        'moneda' => $pricRecargo->getCaIdmoneda(),
                        'style' => '',
                        'observaciones' =>  utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
                        'iditem'=>$pricRecargo->getCaIdrecargo(),
                        'tipo'=>"recargo",
                        'sugerida'=>$sugerida,
                        'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                        'minima'=>$minima,
                        'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                        'consecutivo' => $pricRecargo->getCaConsecutivo(),
                        'actualizado'=>$pricRecargo->getCaUsucreado()." ".Utils::fechaMes($pricRecargo->getCaFchcreado())

                    );
                    $recargosGenerales[] = array_merge($baseRow, $row);
                }
            }

            if( $impoexpo==Constantes::IMPO ){
                $idciudad = $trayecto["t_ca_origen"];
            }else{
                $idciudad = $trayecto["t_ca_destino"];
            }


            if( $idciudad!=$ultCiudad ){ //Se evita calcular los recargos x ciudad si corresponden al anterior
                $ultCiudad = $idciudad;
                if( $timestamp ){
                    $q = Doctrine_Query::create()->from("PricRecargoxCiudadBs r");
                    $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxCiudadBs rh WHERE rh.ca_fchcreado<= ?
                            AND r.ca_idtrafico = rh.ca_idtrafico AND r.ca_idciudad = rh.ca_idciudad AND r.ca_modalidad = rh.ca_modalidad AND r.ca_impoexpo = rh.ca_impoexpo AND r.ca_idrecargo = rh.ca_idrecargo
                            ORDER BY rh.ca_consecutivo DESC LIMIT 1)", $fchcorte );
                }else{
                    $q = Doctrine_Query::create()->from("PricRecargoxCiudad r");
                }
                $q->innerJoin("r.TipoRecargo t");
                $q->addWhere("r.ca_idtrafico = ? AND (r.ca_idciudad = ? OR r.ca_idciudad = '999-9999') AND t.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($this->trafico->getCaIdtrafico(), $idciudad , $trayecto["t_ca_transporte"], $trayecto["t_ca_modalidad"], $trayecto["t_ca_impoexpo"]));
                $q->addOrderBy("t.ca_recargo");
                $pricRecargosxCiudad = $q->execute();
            }
            if( $pricRecargosxCiudad ){
                foreach( $pricRecargosxCiudad as $pricRecargo ){
                    if( $pricRecargo->getCaFcheliminado() ){
                        continue;
                    }
                    $tipoRecargo = $pricRecargo->getTipoRecargo();
                    $sugerida=$pricRecargo->getCaVlrrecargo();
                    $minima=$pricRecargo->getCaVlrminimo();
                    $row = array (
                        'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                        'idconcepto'=>'9999',
                        'inicio' => $pricRecargo->getCaFchinicio(),
                        'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                        'moneda' => $pricRecargo->getCaIdmoneda(),
                        'style' => '',
                        'observaciones' =>  utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
                        'iditem'=>$pricRecargo->getCaIdrecargo(),
                        'tipo'=>"recargoxciudad",
                        'sugerida'=>$sugerida,
                        'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                        'minima'=>$minima,
                        'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                        'consecutivo' => $pricRecargo->getCaConsecutivo(),
                        'actualizado'=>$pricRecargo->getCaUsucreado()." ".Utils::fechaMes($pricRecargo->getCaFchcreado())

                    );
                    $recargosGenerales[] = array_merge($baseRow, $row);
                }
            }

            if( $trayecto["t_ca_idlinea"]!=$ultLinea ){ //Se evita calcular los recargos x ciudad si corresponden al anterior
                $ultLinea = $trayecto["t_ca_idlinea"];
                if( $timestamp ){
                    $q = Doctrine_Query::create()->from("PricRecargoxLineaBs r");
                    $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxLineaBs rh WHERE rh.ca_fchcreado<= ?
                            AND r.ca_idtrafico = rh.ca_idtrafico AND r.ca_idlinea = rh.ca_idlinea AND r.ca_modalidad = rh.ca_modalidad AND r.ca_impoexpo = rh.ca_impoexpo AND r.ca_idrecargo = rh.ca_idrecargo
                             ORDER BY rh.ca_consecutivo DESC LIMIT 1 )", $fchcorte );
                }else{
                    $q = Doctrine_Query::create()->from("PricRecargoxLinea r");

                }
                $q->innerJoin("r.TipoRecargo t");
                $q->addWhere("r.ca_idtrafico = ? AND r.ca_idlinea = ? AND t.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($this->trafico->getCaIdtrafico(), $trayecto["t_ca_idlinea"], $trayecto["t_ca_transporte"], $trayecto["t_ca_modalidad"], $trayecto["t_ca_impoexpo"]));
                
                
                $q->addOrderBy("t.ca_recargo");
                $PricRecargoxLinea = $q->execute();
            }
            if( $PricRecargoxLinea ){
                foreach( $PricRecargoxLinea as $pricRecargo ){
                    if( $pricRecargo->getCaFcheliminado() ){
                        continue;
                    }
                    $tipoRecargo = $pricRecargo->getTipoRecargo();
                    $sugerida=$pricRecargo->getCaVlrrecargo();
                    $minima=$pricRecargo->getCaVlrminimo();
                    $row = array (
                        'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                        'idconcepto'=>'9999',
                        'inicio' => $pricRecargo->getCaFchinicio(),
                        'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                        'moneda' => $pricRecargo->getCaIdmoneda(),
                        'style' => '',
                        'observaciones' =>  utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
                        'iditem'=>$pricRecargo->getCaIdrecargo(),
                        'tipo'=>"recargoxciudad",
                        'sugerida'=>$sugerida,
                        'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                        'minima'=>$minima,
                        'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                        'consecutivo' => $pricRecargo->getCaConsecutivo(),
                        'actualizado'=>$pricRecargo->getCaUsucreado()." ".Utils::fechaMes($pricRecargo->getCaFchcreado())

                    );
                    $recargosGenerales[] = array_merge($baseRow, $row);
                }
            }            
            //Fin recargos generales


             //Trae los conceptos hasta una fecha de corte
            if( $timestamp ){
                $q = Doctrine_Query::create()->from("PricFleteBs f");
                $q->addWhere("f.ca_fchcreado IN (SELECT fh.ca_fchcreado FROM PricFleteBs fh WHERE fh.ca_fchcreado<= ? AND f.ca_idconcepto = fh.ca_idconcepto AND f.ca_idtrayecto = fh.ca_idtrayecto
                                              ORDER BY fh.ca_consecutivo DESC LIMIT 1  )", $fchcorte );

            }else{
                $q = Doctrine_Query::create()->from("PricFlete f");
            }
            $q->innerJoin("f.Concepto c");
            $q->addWhere("f.ca_idtrayecto = ?", $trayecto["t_ca_idtrayecto"]);
            //$q->addWhere("(f.ca_fcheliminado >= ? OR f.ca_fcheliminado IS NULL )", $fchcorte );
           
            $q->addOrderBy("c.ca_liminferior");
            $q->addOrderBy("c.ca_concepto");
            $pricConceptos = $q->execute();

            $groupStyle = array();
            foreach( $pricConceptos as $pricConcepto ){
                $groupStyle[] = $pricConcepto->getCaEstado();
            }

            $groupStyle = array_unique($groupStyle);
            //Se incluye una fila antes de los conceptos que contiene las observaciones del trayecto
            $row = array (
				'nconcepto' => "Observaciones",				
				'inicio' => '',
				'vencimiento' => '',
				'moneda' => '',
				'aplicacion' => '',
				'style' => implode("|", $groupStyle),
				'observaciones' => utf8_encode(str_replace("\"", "'",$trayecto["t_ca_observaciones"])),
				'iditem'=>'',
				'tipo'=>"trayecto_obs",
				'neta'=>'',
				'minima'=>'',
				'minima'=>'',
				'orden'=>'000'
			);
			$data[] = array_merge($baseRow, $row);


           
            // Se incluyen las filas de cada concepto y sus respectivos recargos
			foreach( $pricConceptos as $pricConcepto ){

                if( $pricConcepto->getCaFcheliminado() ){
                    continue;
                }

				if( $this->opcion=="consulta" && $pricConcepto->getCaEstado()==2){//Las tarifas en mantenimiento no se muestran en consulta
					$neta=0;
					$sugerida=0;
				}else{
					$neta=$pricConcepto->getCaVlrneto();
					$sugerida=$pricConcepto->getCaVlrsugerido();
				}

				$row = array (					
					'nconcepto' => utf8_encode($pricConcepto->getConcepto()->getCaConcepto()),                    
					'inicio' => $pricConcepto->getCaFchinicio(),
					'vencimiento' => $pricConcepto->getCaFchvencimiento(),
					'moneda' => $pricConcepto->getCaIdmoneda(),
					'style' => $pricConcepto->getEstilo(),					
					'iditem'=>$pricConcepto->getCaIdconcepto(),
					'tipo'=>"concepto",
					'neta'=>$neta,
					'sugerida'=>$sugerida,
					'aplicacion' => utf8_encode($pricConcepto->getCaAplicacion()),
					'consecutivo' => $pricConcepto->getCaConsecutivo(),
					'orden'=>str_pad($i, 3, "0", STR_PAD_LEFT),
                    'actualizado'=>$pricConcepto->getCaUsucreado()." ".Utils::fechaMes($pricConcepto->getCaFchcreado())

				);

				$data[] = array_merge($baseRow, $row);

                if( $timestamp ){
                    $q = Doctrine_Query::create()->from("PricRecargoxConceptoBs r");
                    $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxConceptoBs rh WHERE rh.ca_fchcreado<= ? AND
                             r.ca_idconcepto = rh.ca_idconcepto AND r.ca_idrecargo = rh.ca_idrecargo AND r.ca_idtrayecto = rh.ca_idtrayecto
                              ORDER BY rh.ca_consecutivo DESC LIMIT 1 )", $fchcorte );
                }else{
                    $q = Doctrine_Query::create()->from("PricRecargoxConcepto r");
                }
                $q->addOrderBy("t.ca_recargo");
                $q->innerJoin("r.TipoRecargo t");
                $q->addWhere("r.ca_idtrayecto = ? AND r.ca_idconcepto = ?", array($trayecto["t_ca_idtrayecto"],$pricConcepto->getCaIdconcepto()));
                $pricRecargos = $q->execute();
                
				if( $pricRecargos ){
					foreach( $pricRecargos as $pricRecargo ){
                        if( $pricRecargo->getCaFcheliminado() ){
                            continue;
                        }
						$tipoRecargo = $pricRecargo->getTipoRecargo();

						if( $this->opcion=="consulta" && $pricConcepto->getCaEstado()==2){//Las tarifas en mantenimiento no se muestran en consulta

							$sugerida=0;
							$minima=0;
						}else{
							$sugerida=$pricRecargo->getCaVlrrecargo();
							$minima=$pricRecargo->getCaVlrminimo();
						}
                        $row = array (
                            'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                            'idconcepto'=>$pricConcepto->getCaIdconcepto(),
                            'inicio' => $pricRecargo->getCaFchinicio(),
                            'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                            'moneda' => $pricRecargo->getCaIdmoneda(),
                            'style' => '',
                            'observaciones' =>  utf8_encode(str_replace("\"", "'",$pricRecargo->getCaObservaciones())),
                            'iditem'=>$pricRecargo->getCaIdrecargo(),
                            'tipo'=>"recargo",
                            'sugerida'=>$sugerida,
							'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
							'minima'=>$minima,
							'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
							'consecutivo' => $pricRecargo->getCaConsecutivo(),
                            'orden'=>str_pad($i, 3, "0", STR_PAD_LEFT)." ".utf8_encode($tipoRecargo->getCaRecargo()),
                            'actualizado'=>$pricRecargo->getCaUsucreado()." ".Utils::fechaMes($pricRecargo->getCaFchcreado())
                        );
                        $data[] = array_merge($baseRow, $row);							
					}
				}

                if(  $this->opcion=="consulta" && count($recargosGenerales)>0 && $trayecto["t_ca_transporte"]==Constantes::MARITIMO && $trayecto["t_ca_modalidad"]=="FCL" ){
					//En el caso maritimo se incluyen los recargos despues de cada concepto en el modo de consulta unicamente
					foreach( $recargosGenerales as $rec ){
                        $rec['idconcepto']=$pricConcepto->getCaIdconcepto();
						$rec['orden']=str_pad($i, 3, "0", STR_PAD_LEFT)." ".$rec['nconcepto'];
						$data[] = $rec;
					}
				}
                $i++;
            }


			//$this->opcion!="consulta" se hace para que el usuario pueda 
			// hacer click con el boton derecho y agregar un recargo general 
			if( $this->opcion!="consulta" || ( count($recargosGenerales)>0  ) ){ 
				
				//Se incluye una fila antes de los recargos generales del trayecto
				$row = array (					
					'nconcepto' => "Recargos generales del trayecto",					
					'inicio' => '',
					'vencimiento' => '',
					'moneda' => '',
					'aplicacion' => '',									
					'style' => '',
					'observaciones' => '',
					'iditem'=>'9999',				
					'tipo'=>"concepto",
					'neta'=>'',
					'minima'=>'',
					'orden'=>'ZZZ'
				);
				$data[] = array_merge($baseRow, $row);		
                
			}			
			
			if( $this->opcion!="consulta" || ( count($recargosGenerales)>0 && !($trayecto["t_ca_transporte"]==Constantes::MARITIMO && $trayecto["t_ca_modalidad"]=="FCL")) ){
				foreach( $recargosGenerales as $rec ){	
					$rec['orden']="ZZZ ".$rec['nconcepto'];
					$data[] = $rec;	
				}	
			}

            $i++;
								
		}
        
		$this->responseArray = array(
            'success' => true,
            'total' => count( $data ),
            'data' => $data
        );
        $this->setTemplate("responseTemplate");
		
	}


	/*
	* Observa los cambios realizados en grillaPorTraficos
	* @author: Andres Botero
	*/
	public function executeObserveGrillaPorTraficos(){

        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}

		$trayecto = Doctrine::getTable("Trayecto")->find( $this->getRequestParameter( "idtrayecto" ) );
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

			$flete  = Doctrine::getTable("PricFlete")->find(array($trayecto->getCaIdtrayecto(), $idconcepto ));
			if( !$flete ){
				$flete = new PricFlete();
				$flete->setCaIdtrayecto( $trayecto->getCaIdtrayecto() );
				$flete->setCaIdconcepto( $idconcepto );
				$flete->setCaVlrneto( 0 );				
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
			

            if( $this->getRequestParameter("inicio")!==null ){
				if( $this->getRequestParameter("inicio") ){
					$flete->setCaFchinicio($this->getRequestParameter("inicio"));
				}else{
					$flete->setCaFchinicio( null );
				}
			}

			if( $this->getRequestParameter("vencimiento")!==null ){
				if( $this->getRequestParameter("vencimiento") ){
					$flete->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
				}else{
					$flete->setCaFchvencimiento( null );
				}
			}


			if( $this->getRequestParameter("moneda") ){
				$flete->setCaIdmoneda($this->getRequestParameter("moneda"));
			}
			
			if( $this->getRequestParameter("aplicacion")!==null ){
				$flete->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
			}			

            $user = $this->getUser();
            $flete->setCaUsucreado( $user->getUserId() );
            $flete->setCaFchcreado( date("Y-m-d H:i:s") );
			$flete->save();
		}
		
		if( $tipo=="recargo" ){
			$minima = $this->getRequestParameter("minima");
			$idconcepto = $this->getRequestParameter("idconcepto");
			$idrecargo = $this->getRequestParameter("iditem");
			if( $idconcepto!=9999 ){
				$flete  = Doctrine::getTable("PricFlete")->find(array( $trayecto->getCaIdtrayecto(), $idconcepto ));
				if( !$flete ){
					$flete = new PricFlete();
					$flete->setCaIdtrayecto( $trayecto->getCaIdtrayecto() );
					$flete->setCaIdconcepto( $idconcepto );
					$flete->setCaVlrneto( 0 );					
					$flete->save();
				}
			}
			
			$pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->find(array( $trayecto->getCaIdtrayecto() , $idconcepto , $idrecargo));
			
			if( !$pricRecargo ){
				$pricRecargo = new PricRecargoxConcepto();
				$pricRecargo->setCaIdtrayecto( $trayecto->getCaIdtrayecto() );
				$pricRecargo->setCaIdconcepto( $idconcepto );
				$pricRecargo->setCaIdrecargo( $idrecargo );
				$pricRecargo->setCaVlrrecargo( 0 );
				$pricRecargo->setCaVlrminimo( 0 );								
				
			}
			if( $sugerida!==null ){
				$pricRecargo->setCaVlrrecargo( $sugerida );
			}
			
			if( $minima!==null ){
                if( $minima ){
                    $pricRecargo->setCaVlrminimo( $minima );
                }else{
                    $pricRecargo->setCaVlrminimo( null );
                }
			}		
			
			if( $this->getRequestParameter("moneda") ){
				$pricRecargo->setCaIdmoneda($this->getRequestParameter("moneda"));
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

            $user = $this->getUser();
            $pricRecargo->setCaUsucreado( $user->getUserId() );
            $pricRecargo->setCaFchcreado( date("Y-m-d H:i:s") );
			$pricRecargo->save();
		}
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");			
	}
	
	public function executeEliminarRecargoGrillaPorTraficos(){
		
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}

        $idtrayecto = $this->getRequestParameter("idtrayecto");
		$idconcepto = $this->getRequestParameter("idconcepto");
		$idrecargo = $this->getRequestParameter("idrecargo");
        $tipo = $this->getRequestParameter("tipo");
		$id = $this->getRequestParameter("id");

        $this->forward404unless($idtrayecto);
        $this->forward404unless($idconcepto);

        $this->responseArray = array("id"=>$id, "success"=>false);
        if( $tipo=="concepto" ){

            $pricFlete = Doctrine::getTable("PricFlete")->find(array($idtrayecto , $idconcepto ));

            if( $pricFlete ){
                //Borra todos los recargos del concepto
                Doctrine_Query::create()
                                ->delete()
                                ->from("PricRecargoxConcepto r")
                                ->where("r.ca_idtrayecto = ? AND r.ca_idconcepto = ?", array( $idtrayecto , $idconcepto ))
                                ->execute();
                $pricFlete->delete();
                
                $this->responseArray["idconcepto"]=$idconcepto;
                $this->responseArray["idtrayecto"]=$idtrayecto;
            }
            $this->responseArray["success"]=true;
        }

        if( $tipo=="recargo" ){
            $this->forward404unless($idconcepto);
            $pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->find(array($idtrayecto , $idconcepto , $idrecargo));
            if( $pricRecargo ){
                $pricRecargo->delete();
            }
            $this->responseArray["success"]=true;
        }
		
		
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

        if( $this->getRequestParameter( "opcion" )=="consulta" ){
            $this->opcion = "consulta";
        }
        
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		
		if( $idtrafico ){
			$this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);
			
			if( $this->opcion != "consulta" ){	
				
				$this->ciudades = Doctrine::getTable("Ciudad")
                                  ->createQuery("c")
                                  ->where("c.ca_idtrafico = ? ", $idtrafico)
                                  ->addOrderBy("c.ca_ciudad")
                                  ->execute();
			}			
			$tipo = Constantes::RECARGO_EN_ORIGEN;
			
			$this->idcomponent = $this->trafico->getCaIdtrafico()."_".$transporte."_".$modalidad;
					
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
			$this->recargos = Doctrine::getTable("TipoRecargo")
                              ->createQuery("t")
                              ->where("t.ca_transporte = ? AND t.ca_tipo= ?", array($transporte, $tipo))
                              ->addOrderBy("t.ca_recargo")
                              ->execute();
			
		}			
		
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

        if( $this->getRequestParameter( "opcion" )=="consulta" ){
            $this->opcion = "consulta";
        }
		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$modalidad = $this->getRequestParameter( "modalidad" );		
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		
				
		//$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
		
        if( !$idtrafico ){
			$idtrafico = "99-999"; 
		}

		$q = Doctrine_Query::create()->from("PricRecargoxCiudad r");
        $q->innerJoin("r.TipoRecargo t");
        $q->where("r.ca_idtrafico = ? AND t.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($idtrafico, $transporte , $modalidad, $impoexpo));
        $q->addOrderBy("t.ca_recargo");
        $recargos = $q->execute();

        
		
		$this->data = array();
		$i=0;
		foreach( $recargos as $recargo ){
			$row = array(
				'id'=>$i++,
				'idtrafico'=>$idtrafico,
				'idciudad'=>$recargo->getCaIdciudad(),
				'ciudad'=>utf8_encode($recargo->getCiudad()->getCaCiudad()),
				'idrecargo'=>$recargo->getCaIdrecargo(),
				'recargo'=>utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
                'inicio' => $recargo->getCaFchinicio(),
                'vencimiento' => $recargo->getCaFchvencimiento(),
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
					
		$this->responseArray = array(
            'success' => true,
            'total' => count($this->data),
            'data' => $this->data
        );
        $this->setTemplate("responseTemplate");

		
		
	}
	
	/*
	* Guarda los cambios realizados en los recargos generales
	* @author: Andres Botero 
	*/
	public function executeObserveRecargosGenerales(){
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}
        
		$idtrafico = $this->getRequestParameter("idtrafico");
		$idciudad = $this->getRequestParameter("idciudad");		
		$idrecargo = $this->getRequestParameter("idrecargo");
		$modalidad = $this->getRequestParameter("modalidad");
		$impoexpo = $this->getRequestParameter("impoexpo");

		$this->forward404Unless( $idtrafico );
		$this->forward404Unless( $idciudad );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		//print_r( array($idtrafico, $idciudad, $idrecargo , $modalidad, utf8_decode($impoexpo)) );
		$recargo = Doctrine::getTable("PricRecargoxCiudad")->find(array($idtrafico, $idciudad, $idrecargo , $modalidad, utf8_decode($impoexpo)));
		if( !$recargo ){
			$recargo = new PricRecargoxCiudad();
			$recargo->setCaIdtrafico( $idtrafico );
			$recargo->setCaIdciudad( $idciudad );
			$recargo->setCaIdrecargo( $idrecargo );
			$recargo->setCaModalidad( $modalidad );
			$recargo->setCaImpoexpo( utf8_decode($impoexpo) );
			$recargo->setCaVlrrecargo( 0 );
			$recargo->setCaVlrminimo( 0 );			
		}

        $user = $this->getUser();
		$recargo->setCaUsucreado( $user->getUserId() );
		$recargo->setCaFchcreado( date("Y-m-d H:i:s") );

        if( $this->getRequestParameter("inicio")!==null ){
            if( $this->getRequestParameter("inicio") ){
                $recargo->setCaFchinicio($this->getRequestParameter("inicio"));
            }else{
                $recargo->setCaFchinicio( null );
            }
        }

        if( $this->getRequestParameter("vencimiento")!==null ){
            if( $this->getRequestParameter("vencimiento") ){
                $recargo->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
            }else{
                $recargo->setCaFchvencimiento( null );
            }
        }
						
		if( $this->getRequestParameter("vlrrecargo")!==null ){
			$recargo->setCaVlrrecargo( $this->getRequestParameter("vlrrecargo") );
		}
		
		if( $this->getRequestParameter("vlrminimo")!==null ){
            if( $this->getRequestParameter("vlrminimo") ){
                $recargo->setCaVlrminimo( $this->getRequestParameter("vlrminimo") );
            }else{
                $recargo->setCaVlrminimo( null );
            }
		}		
		
		if( $this->getRequestParameter("idmoneda") ){
			$recargo->setCaIdmoneda($this->getRequestParameter("idmoneda"));
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
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}

        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}
		$idtrafico = $this->getRequestParameter("idtrafico");
		$idciudad = $this->getRequestParameter("idciudad");		
		$idrecargo = $this->getRequestParameter("idrecargo");
		$modalidad = $this->getRequestParameter("modalidad");
		$impoexpo = $this->getRequestParameter("impoexpo");
        $id = $this->getRequestParameter("id");
		
		$this->forward404Unless( $idtrafico );
		$this->forward404Unless( $idciudad );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );		
		$recargo = Doctrine::getTable("PricRecargoxCiudad")->find( array($idtrafico, $idciudad, $idrecargo , $modalidad, $impoexpo) );
		$this->responseArray = array("id"=>$id, "success"=>false);
		
		if( $recargo ){
			$recargo->delete();
            $this->responseArray["success"]=true;
		}	
		
			
		$this->setTemplate("responseTemplate");	
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
			$this->linea = Doctrine::getTable("IdsProveedor")->find( $idlinea );
		}
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
			
		
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
		$this->idlinea = $idlinea;
		$this->impoexpo = $impoexpo;
				
		
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


        $q = Doctrine_Query::create()->from("PricRecargoxLinea r");
        $q->innerJoin("r.TipoRecargo t");
        $q->where("r.ca_idtrafico = ? AND t.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($idtrafico, $transporte, $modalidad, $impoexpo));
        if( $idtrafico=="99-999" ){
            $q->addWhere("r.ca_idlinea = ?", $idlinea);
        }
        $q->addOrderBy("t.ca_recargo");
        $recargos = $q->execute();
		
		$this->data = array();
		$i=0;
		
		foreach( $recargos as $recargo ){
			$row = array(
				'id'=>$i++,
				'idtrafico'=>$idtrafico,
				'idlinea'=>$recargo->getCaIdlinea(),
				'linea'=>$recargo->getIdsProveedor()->getIds()->getCaNombre(),
				'idrecargo'=>$recargo->getCaIdrecargo(),
				'recargo'=>utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
				'idconcepto'=>$recargo->getCaIdconcepto(),
				'concepto'=>$recargo->getCaIdconcepto()==9999?"Aplica para todos":utf8_encode($recargo->getConcepto()->getCaConcepto()),
                'inicio' => $recargo->getCaFchinicio(),
                'vencimiento' => $recargo->getCaFchvencimiento(),
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
					


         $this->responseArray = array(
            'success' => true,
            'total' => count($this->data),
            'data' => $this->data
        );
        $this->setTemplate("responseTemplate");
		
		
	}
	
	
	/*
	* Guarda los cambios realizados en los recargos generales
	* @author: Andres Botero 
	*/
	public function executeObserveRecargosPorLinea(){
		
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}

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
		
		$recargo = Doctrine::getTable("PricRecargoxLinea")->find( array($idtrafico, $idlinea, $idrecargo, $idconcepto , $modalidad, utf8_decode($impoexpo)) );
		if( !$recargo ){
			
			$recargo = new PricRecargoxLinea();
			$recargo->setCaIdtrafico( $idtrafico );
			$recargo->setCaIdlinea( $idlinea );
			$recargo->setCaIdrecargo( $idrecargo );
			$recargo->setCaModalidad( $modalidad );
			$recargo->setCaImpoexpo( utf8_decode($impoexpo) );
			$recargo->setCaVlrrecargo( 0 );
			$recargo->setCaVlrminimo( 0 );			
		}
		$user = $this->getUser();
		$recargo->setCaUsucreado( $user->getUserId() );
		$recargo->setCaFchcreado( date("Y-m-d H:i:s") );
		
		
		if( $this->getRequestParameter("idconcepto") ){
			$recargo->setCaIdconcepto( $this->getRequestParameter("idconcepto") );
		}

        if( $this->getRequestParameter("inicio")!==null ){
            if( $this->getRequestParameter("inicio") ){
                $recargo->setCaFchinicio($this->getRequestParameter("inicio"));
            }else{
                $recargo->setCaFchinicio( null );
            }
        }

        if( $this->getRequestParameter("vencimiento")!==null ){
            if( $this->getRequestParameter("vencimiento") ){
                $recargo->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
            }else{
                $recargo->setCaFchvencimiento( null );
            }
        }
					
		if( $this->getRequestParameter("vlrrecargo")!==null ){
			$recargo->setCaVlrrecargo( $this->getRequestParameter("vlrrecargo") );
		}
		
		if( $this->getRequestParameter("vlrminimo")!==null ){
            if( $this->getRequestParameter("vlrminimo") ){
                $recargo->setCaVlrminimo( $this->getRequestParameter("vlrminimo") );
            }else{
                $recargo->setCaVlrminimo( null );
            }
		}		
		
		if( $this->getRequestParameter("idmoneda") ){
			$recargo->setCaIdmoneda($this->getRequestParameter("idmoneda"));
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
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}

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
		$id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>true);
		$recargo = Doctrine::getTable("PricRecargoxLinea")->find( array($idtrafico, $idlinea, $idrecargo, $idconcepto , $modalidad, $impoexpo) );
				
		
		if( $recargo ){
			$recargo->delete();
            $this->responseArray["success"]=true;
		}	
		
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
		$param = ParametroTable::retrieveByCaso("CU071");
		foreach( $param as $p ){
			$conceptos[ $p->getCaIdentificacion() ]=$p->getCaValor();
		}
		
				
				
		$parametros = Doctrine::getTable("PricRecargoParametro")
                                ->createQuery("p")
                                ->where("p.ca_impoexpo = ? AND p.ca_transporte = ? AND p.ca_idlinea = ? and p.ca_modalidad = ? ", array($impoexpo, $transporte, $idlinea, $modalidad))
                                ->execute();
					
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
				
	}
	
	/*
	* Guarda los cambios de un parametro de los recargos locales
	* @author: Andres Botero
	*/
	public function executeObserveRecargosParametros( $request ){
		
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}

		$idlinea = $this->getRequestParameter("idlinea");		
		
		$modalidad = $this->getRequestParameter("modalidad");
		$transporte = $this->getRequestParameter("transporte");
		$impoexpo = $this->getRequestParameter("impoexpo");
		$concepto = utf8_decode($this->getRequestParameter("concepto"));
								
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $idlinea );
		$this->forward404Unless( $modalidad );
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $concepto );
		
		$parametro = Doctrine::getTable("PricRecargoParametro")->find(array($idlinea, $transporte, $modalidad,$impoexpo, $concepto));
		
	
				
		if( !$parametro ){			
			$parametro = new PricRecargoParametro();	
			$parametro->setCaIdlinea( $idlinea );
			$parametro->setCaImpoexpo( $impoexpo );
			$parametro->setCaTransporte( $transporte );
			$parametro->setCaModalidad( $modalidad );	
			$parametro->setCaConcepto( $concepto );
						
			$parametro->setCaUsucreado( $this->getUser()->getUserId() );
			$parametro->setCaFchcreado( time() );			
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
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}
		$transporte = $this->getRequestParameter( "transporte" );		
		$modalidad = $this->getRequestParameter( "modalidad" );				
		$impoexpo = $this->getRequestParameter( "impoexpo" );
		$idlinea = $this->getRequestParameter( "idlinea" );	
		$concepto = utf8_decode($this->getRequestParameter( "concepto" ));
		
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $idlinea );
		$this->forward404Unless( $concepto );
		
		$parametro = Doctrine::getTable("PricRecargoParametro")->find(array($idlinea, $transporte, $modalidad,$impoexpo, $concepto) );
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
		
        $patiosLineas = Doctrine::getTable("PricPatioLinea")
                                ->createQuery("p")
                                ->where("p.ca_impoexpo = ? AND p.ca_transporte = ? AND p.ca_idlinea = ? and p.ca_modalidad = ? ", array($impoexpo, $transporte, $idlinea, $modalidad))
                                ->distinct()
                                ->execute();

		
		$patiosLineaArray = array(); 
		
		foreach( $patiosLineas as $pl ){
			$patiosLineaArray[ $pl->getCaIdpatio() ] = $pl->getCaObservaciones();
		}
		
		$patios = Doctrine::getTable("PricPatio")
                                ->createQuery("p")
                                ->innerJoin("p.Ciudad c")
                                ->addOrderBy("c.ca_ciudad")
                                ->addOrderBy("p.ca_nombre")
                                ->distinct()
                                ->execute();
					
		$data = array();
		$i=0;
		
		foreach( $patios as $patio ){
			
			if( array_key_exists( $patio->getCaIdpatio(), $patiosLineaArray) ){
				
				$sel = true;
				$observaciones = $patiosLineaArray[$patio->getCaIdpatio()];
			}else{
				$sel = false;
				$observaciones = "";
                if( $this->nivel==0 ){
                    continue;
                }
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
			
		
	}	
	
	
	/*********************************************************************
	* Administrador de trayectos, tiempos de transito y frecuencias
	*	
	*********************************************************************/
	public function executeObserveRecargosLocalesPatios( $request ){
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}

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
        Doctrine_Query::create()
                        ->delete()
                        ->from("PricPatioLinea p")
                        ->where("p.ca_impoexpo = ? AND p.ca_transporte = ? AND p.ca_idlinea = ? and p.ca_modalidad = ? ", array($impoexpo, $transporte, $idlinea, $modalidad))
                        ->distinct()
                        ->execute();
		
		
		
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
		
		
		
		$this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);
        $this->forward404Unless( $this->trafico );
		$this->idcomponent = "admtraf_".$this->trafico->getCaIdtrafico()."_".$transporte."_".$modalidad;
		
		$this->titulo = "T.T. Freq. ".$this->trafico->getCaNombre()." ".$modalidad." ".substr($impoexpo,0,4);
		
		
				
		$this->impoexpo = $impoexpo;			
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;					
		$this->linea = "";		
		
		
		
		
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
				
		
		
		$this->trafico = Doctrine::getTable("Trafico")->find( $idtrafico );


        $q = Doctrine::getTable("Trayecto")
                               ->createQuery("t")
                               ->select("t.*")
                               ->where("c.ca_idtrafico = ? AND t.ca_transporte = ? AND t.ca_modalidad = ? AND t.ca_impoexpo = ?", array($idtrafico, $transporte, $modalidad, $impoexpo))
                               ->innerJoin("t.IdsProveedor p")
                               ->innerJoin("p.Ids i")
                               ->addOrderBy("i.ca_nombre");
        
        if( $impoexpo==Constantes::EXPO ){
            $q->innerJoin("t.Destino c");
        }else{
            $q->innerJoin("t.Origen c");
        }       
		$trayectos = $q->execute();

		
			

		$data=array();
		$transportador_id = null;
		foreach( $trayectos as $trayecto ){
			$transportador = $trayecto->getIdsProveedor()->getIds()->getCaNombre();
			
			$trayectoStr = utf8_encode(strtoupper($trayecto->getOrigen()->getCaCiudad()))."»".utf8_encode(strtoupper($trayecto->getDestino()->getCaCiudad()));
			
			
			$row = array(
				'idtrayecto' => $trayecto->getCaIdtrayecto(),
				'trayecto' =>utf8_encode($trayectoStr),
				'origen'=>utf8_encode($trayecto->getOrigen()->getCaCiudad()),
				'destino'=>utf8_encode($trayecto->getDestino()->getCaCiudad()), 
				'linea'=> $transportador?utf8_encode($transportador):"",
				'ttransito'=>utf8_encode($trayecto->getCaTiempotransito()),
				'frecuencia'=>$trayecto->getCaFrecuencia(),
				'activo'=>$trayecto->getCaActivo()
			);						
			$data[] = $row;			
		}
		
		 

        $this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);	
		$this->setTemplate("responseTemplate");
	}
	
	/*
	* Guarda los cambios realizados en la grilla de administración de trayectos (TT, Freq)
	*/
	public function executeObserveAdminTrayectos(){
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}
        
		$idtrayecto = $this->getRequestParameter( "idtrayecto" );
		$trayecto = Doctrine::getTable("Trayecto")->find( $idtrayecto );
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
		
        $id = $this->getRequestParameter("id");
		$this->responseArray = array("id"=>$id, "success"=>true);	
		$this->setTemplate("responseTemplate");	

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
			
		$grupos = Doctrine::getTable("TraficoGrupo")
                            ->createQuery("g")
                            ->addOrderBy("g.ca_descripcion")
                            ->execute();
		
		$this->data = array();
		foreach( $grupos as $grupo ){
			$row = array(
						'idgrupo'=>$grupo->getCaIdgrupo(),
						'grupo'=>utf8_encode($grupo->getCaDescripcion())
					);
			$seguro = Doctrine::getTable("PricSeguro")->find( array($grupo->getCaIdgrupo(), $this->transporte) );
			if( $seguro ){
				$row['vlrprima']=$seguro->getCaVlrprima();
				$row['vlrminima']=$seguro->getCaVlrminima();
				$row['vlrobtencionpoliza']=$seguro->getCaVlrobtencionpoliza();
				$row['idmoneda']=$seguro->getCaIdmoneda();
				$row['observaciones']=$seguro->getCaObservaciones();
				
			}
			$this->data[] = $row;		
		}		
		
	}
	
	/*
	* Guarda los datos de los seguros
	*/
	public function executeObserveGrillaSeguros(){
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}
        
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$idgrupo = utf8_decode($this->getRequestParameter("idgrupo"));
        $id = $this->getRequestParameter("id");
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $idgrupo );
		
		$seguro = Doctrine::getTable("PricSeguro")->find( array($idgrupo, $transporte ) );
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
		
		if( $this->getRequestParameter("observaciones")!==null ){
			$seguro->setCaObservaciones( $this->getRequestParameter("observaciones") );
		}		
		$seguro->save();
        
		$this->responseArray = array("success"=>true, "id"=>$id);
		$this->setTemplate("responseTemplate");
		
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
	
		
		$idtrafico = $this->getRequestParameter("idtrafico");
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$transporte = utf8_decode($this->getRequestParameter("transporte"));	
		$modalidad = utf8_decode($this->getRequestParameter("modalidad"));	
				
		$this->impoexpo = $impoexpo;
		$this->forward404Unless( $this->impoexpo );
				
		$modalidad = $this->getRequestParameter( "modalidad" );					
		$idtrafico = $this->getRequestParameter( "idtrafico" );
			
		$this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);
		$this->forward404Unless( $this->trafico );
			
		$this->idcomponent = substr_replace("=", "", base64_encode(substr($this->impoexpo,0,1)."_".$this->trafico->getCaIdtrafico()."_".$transporte."_".$modalidad));
						
		$this->forward404Unless( $idtrafico );

        $this->folder = "Tarifario".DIRECTORY_SEPARATOR.substr($this->impoexpo,0,1)."_".substr($transporte,0,1)."_".$modalidad."_".$this->trafico->getCaIdtrafico();
        
		$this->impoexpo = utf8_encode($impoexpo);
		$this->transporte = utf8_encode($transporte);
		$this->modalidad = $modalidad;
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

            $q = Doctrine_Query::create()
                                 ->select("t.ca_modalidad, tg.ca_descripcion, tr.ca_nombre, tr.ca_idtrafico")
                                 ->distinct()
                                 ->from("Trayecto t");
			if( $impoexpo==Constantes::IMPO ){
                $q->innerJoin( "t.Origen c" );
			}else{
                $q->innerJoin( "t.Destino c" );
			}
            $q->innerJoin( "c.Trafico tr" );
            $q->innerJoin( "tr.TraficoGrupo tg" );

            $q->where("t.ca_impoexpo = ? ", $impoexpo );
            $q->addWhere("t.ca_transporte = ? ", $transporte );
            $q->addWhere("t.ca_activo = ? ", true );

            $q->addOrderBy("t.ca_modalidad ASC");
            $q->addOrderBy("tg.ca_descripcion ASC");
            $q->addOrderBy("tr.ca_nombre ASC");
			$q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
			
			$rows = $q->execute();
            
			$this->results = array();
			$modalidades = array();
			foreach($rows as $row ){
				$modalidad = $row["t_ca_modalidad"];
				$grupo = $row["tg_ca_descripcion"];
				$pais = $row["tr_ca_nombre"];
				$idtrafico = $row["tr_ca_idtrafico"];
                
				
				$this->results[$modalidad][$grupo][]=array("idtrafico"=>$idtrafico, "pais"=>$pais);
				$modalidades[]=$modalidad;
			}


            $modalidades = array_unique( $modalidades );
			$this->lineas = array();

            $q = Doctrine_Query::create()
                              ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, t.ca_modalidad")
                             ->distinct()
                             ->from("Trayecto t");
            if( $impoexpo==Constantes::IMPO ){                
                $q->innerJoin( "t.Origen c" );
            }else{                
                $q->innerJoin( "t.Destino c" );
            }
            $q->innerJoin( "t.IdsProveedor p" );
            $q->innerJoin( "p.Ids id" );
            $q->addWhere("t.ca_impoexpo = ? ", $impoexpo );
            $q->addWhere("t.ca_transporte = ? ", $transporte );
            //$q->addWhere("t.ca_modalidad = ? ", $modalidad );
            $q->addWhere("t.ca_activo = ? ", true );
            $q->addWhere("p.ca_activo = ? ", true );
            $q->addOrderBy("id.ca_nombre ASC");
            $q->distinct();
            $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            $this->lineas = $q->execute();

		}else{

			$opciones = explode("_", $node);			
			$modalidad = $opciones[2];
			$idtrafico = $opciones[3];
		
            $q = Doctrine_Query::create()                                 
                                 ->distinct()
                                 ->from("Trayecto t");
			if( $impoexpo==Constantes::IMPO ){
                $q->select("c.ca_idciudad, c.ca_ciudad, t.ca_origen");
                $q->innerJoin( "t.Origen c" );
			}else{               
                $q->select("c.ca_idciudad, c.ca_ciudad, t.ca_destino");
                $q->innerJoin( "t.Destino c" );
			}
            
            $q->where("c.ca_idtrafico = ? ", $idtrafico );
            $q->addWhere("t.ca_impoexpo = ? ", $impoexpo );
            $q->addWhere("t.ca_transporte = ? ", $transporte );
            $q->addWhere("t.ca_modalidad = ? ", $modalidad );            
            $q->addWhere("t.ca_activo = ? ", true );
            $q->addOrderBy("c.ca_ciudad ASC");
            $q->distinct();
			$q->setHydrationMode(Doctrine::HYDRATE_SCALAR);			
			$this->ciudades = $q->execute();

            

            $q = Doctrine_Query::create()
                                 ->distinct()
                                 ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, t.ca_modalidad")
                                 ->from("Trayecto t");
            if( $impoexpo==Constantes::IMPO ){               
                $q->innerJoin( "t.Origen c" );
			}else{               
                $q->innerJoin( "t.Destino c" );
			}
            $q->innerJoin( "t.IdsProveedor p" );
            $q->innerJoin( "p.Ids id" );

            $q->where("c.ca_idtrafico = ? ", $idtrafico );
            $q->addWhere("t.ca_impoexpo = ? ", $impoexpo );
            $q->addWhere("t.ca_transporte = ? ", $transporte );
            $q->addWhere("t.ca_modalidad = ? ", $modalidad );
            $q->addWhere("t.ca_activo = ? ", true );
            $q->addWhere("p.ca_activo = ? ", true );
            $q->addOrderBy("id.ca_nombre ASC");
            $q->distinct();
            $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
			$this->lineas = $q->execute();
			$this->idtrafico=$idtrafico;
			$this->modalidad=$modalidad;			
			
			$this->setTemplate("datosCiudadesTrayectos");
			
		}
		$this->transporte = $transporte;
		$this->impoexpo = strtolower(substr( $impoexpo,0 ,4 ));				
		
		
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
        $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}
        
		$titulo=$this->getRequestParameter("titulo");
		$mensaje=$this->getRequestParameter("mensaje");
		$caducidad=$this->getRequestParameter("caducidad");
        $id=$this->getRequestParameter("id");
		
		$user = $this->getUser();
		$notificacion = null;
		if( $this->getRequestParameter("idnotificacion") ){
			$notificacion = Doctrine::getTable("PricNotificacion")->find( $this->getRequestParameter("idnotificacion") );
		}
		if( !$notificacion ){
			$notificacion = new PricNotificacion();
		}
		$notificacion->setCaTitulo(utf8_decode($titulo));
		$notificacion->setCaMensaje(utf8_decode($mensaje));
		$notificacion->setCaCaducidad($caducidad);
		$notificacion->setCaUsucreado($user->getUserId());
		
		$this->fchcreado = date("Y-m-d h:i:s", time());
		$notificacion->setCaFchcreado( $this->fchcreado );
		$notificacion->save();
		$this->idnotificacion = $notificacion->getCaIdnotificacion();
		
		$this->responseArray = array("idnotificacion"=>$this->idnotificacion, 
									"fchcreado"=>$this->fchcreado,
									"mensaje"=>$mensaje,
									"titulo"=>$titulo,
									"caducidad"=>$caducidad, 
									"usucreado"=>$user->getUserId(),
									"success"=>true,
                                    "id"=>$id);
		$this->setTemplate("responseTemplate");
		
			
	}
	
	/*
	* Elimina una notificacion
	* @author: Andres Botero 
	*/
	public function executeEliminarNotificacion(){
         $this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );

        if( $this->nivel<=0 ){
			$this->forward404();
		}
		$notificacion = Doctrine::getTable("PricNotificacion")->find( $this->getRequestParameter("idnotificacion") );
		$id=$this->getRequestParameter("id");
        $this->responseArray = array("id"=>$id, "success"=>false);
        if( $notificacion ){
			$notificacion->delete();
             $this->responseArray = array("id"=>$id, "success"=>true);
		}

		$this->setTemplate("responseTemplate");
	}
	
	
				
	
}
?>
