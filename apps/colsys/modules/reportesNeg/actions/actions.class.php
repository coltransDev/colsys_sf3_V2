<?php

/**
* Modulo de creacion de reportes Basado en el modulo de reportes de Carlos Lopez y
* solo que ademas permite crear reportes de exportaciones, adicionalmente entra el
* concepto de embarque.
*
* @package    colsys
* @subpackage reportes
* @author     Your name here
* @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
*/
class reportesNegActions extends sfActions
{
    const RUTINA = 18;

    public function getNivel( ){
        
        return 2;
		$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );
         
		if( $this->nivel==-1 ){
			$this->forward404();
		}
        return $this->nivel;
        
    }

	/**
	* Pantalla de bienvenida para el modulo de reportes 
	* @author Andres Botero
	*/
	public function executeIndex()
	{	
		/*$this->modo = $this->getRequestParameter("modo");
		$this->forward404Unless( $this->modo );*/
	}
	
	
	
	/*
	* Muestra los resultados de la busqueda del reporte de negocios 
	* @author Andres Botero
	*/	
	public function executeBusquedaReporte()
	{
		$this->modo = $this->getRequestParameter("modo");					
		$this->forward404Unless( $this->modo );
		
		$criterio = $this->getRequestParameter("criterio");
		$cadena = $this->getRequestParameter("cadena");


        $q = Doctrine::getTable("Reporte")
                       ->createQuery("r")
                       ->distinct()
                       ->limit(200)
                       ->addOrderBy("r.ca_consecutivo");

		switch( $criterio ){
			case "numero_de_reporte":
                $q->addWhere("r.ca_consecutivo like ?", $cadena."%");
				break;	
			case "cliente":
                $q->innerJoin("r.Contacto con");
                $q->innerJoin("con.Cliente cl");
                $q->addWhere("UPPER(cl.ca_compania) LIKE ?",strtoupper( $cadena )."%");
				break;					
		}	
		
		switch( $this->modo ){
			case "expo":
                $q->addWhere("r.ca_impoexpo = ?", Constantes::EXPO);
				break;	
			case "impo":
				$q->addWhere("r.ca_impoexpo = ?", Constantes::IMPO);
				break;	
			default:
				exit;	
								
		}		
		
		$this->reportes = $q->execute();
	}

    /**
	* Permite consultar un reporte de negocio ya creado y permite
	* agregar nuevas
	* @author Andres Botero
	*/
	public function executeConsultaReporte(){

		$reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $reporte );

        if( $reporte->getCaUsuanulado() ){
            $this->redirect( "reportesNeg/verReporte?id=".$reporte->getCaIdreporte() );
        }
		$this->reporte = $reporte;
        

        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');
        



	}


	/*
	* Permite ver una cotización en formato PDF
	*/
	public function executeVerReporte(){

        
        
		$this->reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->reporte );
        $this->user = $this->getUser();
		
	}
    
	/*
	* Permite crear y editar el encabezado de un reporte de negocios 
	* @author Andres Botero
    * @param sfRequest $request A request object
    */
    public function executeFormReporte(sfWebRequest $request){           

        $this->nivel = $this->getNivel();
        
        $this->origen = $request->getParameter("origen");
        $this->destino = $request->getParameter("destino");
        $this->idconcliente = $request->getParameter("idconcliente");
        $this->ca_idconcliente = $request->getParameter("ca_idconcliente");
        
		if( $this->getRequestParameter("id") ){
			$reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
			$this->forward404Unless( $reporte );
			
		}else{		
			$reporte = new Reporte();
		}

        $form = new ReporteForm();
        $this->modalidadesAduana = array();
        $modalidadesAduana = Doctrine::getTable("Modalidad")
                                             ->createQuery("m")
                                             ->select("m.ca_idmodalidad")
                                             ->where("m.ca_modalidad = ? OR m.ca_modalidad = ?", array("NACIONALIZACION", "ADUANA"))
                                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                             ->execute();
        foreach( $modalidadesAduana as $row ){
            $this->modalidadesAduana[]=$row["m_ca_idmodalidad"];
        }

        $this->bodegas = Doctrine::getTable("Bodega")
                                             ->createQuery("b")
                                             ->select("b.*")
                                             ->addOrderBy("b.ca_tipo ASC")
                                             ->addOrderBy("b.ca_nombre ASC")
                                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                             ->execute();

        foreach( $this->bodegas as $key=>$val ){
            $this->bodegas[$key]["b_ca_tipo"] = utf8_encode($this->bodegas[$key]["b_ca_tipo"]);
            $this->bodegas[$key]["b_ca_transporte"] = utf8_encode($this->bodegas[$key]["b_ca_transporte"]);
            $this->bodegas[$key]["b_ca_nombre"] = utf8_encode($this->bodegas[$key]["b_ca_nombre"]);
        }

        $formAduana = new RepAduanaForm();
        $formSeguro = new RepSeguroForm();
        $formExpo = new RepExpoForm();

        $country_reporte = $request->getParameter("country_reporte");
        $this->ca_traorigen = $country_reporte["ca_origen"];
        $this->ca_tradestino = $country_reporte["ca_destino"];

        $bindValues = $request->getParameter("reporte");
        $this->ca_origen = $bindValues["ca_origen"];
        $this->ca_destino = $bindValues["ca_destino"];
        $this->contactos = array();

        for( $i=0; $i<ReporteForm::NUM_CC; $i++ ){
            if( isset( $bindValues["contactos_".$i] )){
                $bindValues["contactos_".$i] = trim($bindValues["contactos_".$i]);
                $this->contactos[] = $bindValues["contactos_".$i];
            }
        }


        if( $request->getParameter("idproveedor") ){
            $proveedores = $request->getParameter("idproveedor");
            $orden_prov = $request->getParameter("orden_prov");
            $incoterms = $request->getParameter("incoterms");

            foreach( $proveedores as $key=>$val){ //Despues de agregar y elimianr proveedores esto evita un error
                if( !$val ){
                    unset($proveedores[$key]);
                    unset($orden_prov[$key]);
                    unset($incoterms[$key]);
                }
            }
            $this->idproveedor = implode("|", $proveedores );
            $bindValues["ca_idproveedor"] = $this->idproveedor;
            $this->orden_prov = implode("|", $orden_prov );           
            
            $bindValues["ca_orden_prov"] = $this->orden_prov;
            $this->incoterms = implode("|", $incoterms );
            $bindValues["ca_incoterms"] = $this->incoterms;
        }else{
            $this->idproveedor = "";
            $this->orden_prov = "";
            $this->incoterms = "";
        }

        $this->idconsignatario = $request->getParameter("idconsignatario");
        $bindValues["ca_idconsignatario"] = $this->idconsignatario;
        $this->idnotify = $request->getParameter("idnotify");
        $this->idrepresentante = $request->getParameter("idrepresentante");
        $this->idmaster = $request->getParameter("idmaster");
        $this->ca_notify = $request->getParameter("repnotify");

        $this->seguro_conf = $request->getParameter("seguro_conf");

        $this->idcotizacion =  isset($bindValues["ca_idcotizacion"])?$bindValues["ca_idcotizacion"]:null;

        if ($request->isMethod('post')){                    
            
            /**********************************************
            * Validaciones los datos
            ***********************************************/

            //TODO Hacer referencia a la tabla modalidades
            //print_r( $bindValues );
            $modalidad = Doctrine::getTable("Modalidad")->find($bindValues["ca_modalidad"]);
            $bindValues["ca_modalidad"] = $modalidad->getCaModalidad();
            $bindValues["ca_transporte"] = $modalidad->getCaTransporte();
            $bindValues["ca_impoexpo"] = $modalidad->getCaImpoexpo();
            
            if( $bindValues["ca_impoexpo"] ){
                $reporte->setCaImpoexpo( $bindValues["ca_impoexpo"] );
            }

            if( $bindValues["ca_transporte"] ){
                $reporte->setCaTransporte( $bindValues["ca_transporte"] );
            }

            if( $bindValues["ca_modalidad"] ){
                $reporte->setCaModalidad( $bindValues["ca_modalidad"] );
            }

            $soloAduana = $reporte->esSoloAduana();

            if( $soloAduana ){
                $bindValues["ca_idagente"] = null;
                $bindValues["ca_colmas"]="Sí";
                $bindValues["ca_continuacion"]="N/A";
            }
            
            $bindValues["ca_idconcliente"] = $request->getParameter("ca_idconcliente");
            
            $form->bind( $bindValues );

            //Coloca el Rep. Comercial
            if( $this->nivel<2 ){
                $cliente = $reporte->getCliente();
                $bindValues["ca_login"] = $cliente->getCaVendedor();
            }

            if( $bindValues["ca_colmas"]=="Sí" ){
                $bindValuesAduana = $request->getParameter( $formAduana->getName() );

                $formAduana->bind( $bindValuesAduana );

                if( $formAduana->isValid() ){
                    $aduanaValido = true;
                }else{
                    $aduanaValido = false;
                }
            }else{
                $aduanaValido = true;
            }

            if( $bindValues["ca_seguro"]=="Sí" ){
                $bindValuesSeguro = $request->getParameter( $formSeguro->getName() );
                $formSeguro->bind( $bindValuesSeguro );

                if( $formSeguro->isValid() ){
                    $seguroValido = true;
                }else{
                    $seguroValido = false;
                }
            }else{
                $seguroValido = true;
            }
            
            if( $bindValues["ca_impoexpo"]==Constantes::EXPO ){
                $bindValuesExpo = $request->getParameter( $formExpo->getName() );
                $formExpo->bind( $bindValuesExpo );

                if( $formExpo->isValid() ){
                    $expoValido = true;
                }else{
                    $expoValido = false;
                }
            }else{
                $expoValido = true;
            }

			if( $form->isValid() && $aduanaValido && $seguroValido && $expoValido ){
                /**********************************************
                * Guarda los datos
                ***********************************************/
                $opcion = $request->getParameter("opcion");
                
                switch( $opcion ){
                    case 1:
                        if( !$reporte->getCaIdreporte() ){
                            $reporte->setCaFchreporte( date("Y-m-d") );
                            $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
                            $reporte->setCaVersion( 1 );
                        }
                        break;
                    case 2:
                        $reporte = $reporte->copiar(2);                        
                        break;
                    case 3:
                        $reporte = $reporte->copiar(1);
                        break;
                }
                

                if( $this->ca_idconcliente ){
                    $reporte->setCaIdconcliente( $this->ca_idconcliente );
                }
                
                if( $bindValues["ca_idlinea"]!==null ){
                    $reporte->setCaIdlinea( $bindValues["ca_idlinea"] );
                }

                if( $bindValues["ca_origen"] ){
                    $reporte->setCaOrigen( $bindValues["ca_origen"] );
                }

                if( $bindValues["ca_destino"] ){
                    $reporte->setCaDestino( $bindValues["ca_destino"] );
                }

                if( $bindValues["ca_orden_clie"] ){
                    $reporte->setCaOrdenClie( $bindValues["ca_orden_clie"] );
                }

                if( $bindValues["ca_fchdespacho"] ){
                    $reporte->setCaFchdespacho( $bindValues["ca_fchdespacho"] );
                }
                
                if( $bindValues["ca_login"] ){
                    $reporte->setCaLogin( $bindValues["ca_login"] );
                }
                
                if( $bindValues["ca_mercancia_desc"] ){
                    $reporte->setCaMercanciaDesc( $bindValues["ca_mercancia_desc"] );
                }

                if( isset($bindValues["ca_mcia_peligrosa"]) ){
                    $reporte->setCaMciaPeligrosa( true );
                }else{
                    $reporte->setCaMciaPeligrosa( false );
                }
                
                if( $bindValues["ca_preferencias_clie"]!==null ){
                    $reporte->setCaPreferenciasClie( $bindValues["ca_preferencias_clie"] );
                }

                if( $bindValues["ca_instrucciones"]!==null ){
                    $reporte->setCaInstrucciones( $bindValues["ca_instrucciones"] );
                }

                for( $i=0; $i<ReporteForm::NUM_CC; $i++ ){
                    if( isset( $bindValues["contactos_".$i] ) && isset( $bindValues["confirmar_".$i] ) && $bindValues["confirmar_".$i] ){
                        $contactos[] = $bindValues["contactos_".$i];
                    }
                }
                
                if( count( $contactos )>0 ){
                    $reporte->setCaConfirmarClie( implode(",",$contactos) );

                }

                /*
                * Datos de proveedores y consignatarios
                */
                if( $bindValues["ca_impoexpo"]==Constantes::IMPO ){
                    if( $this->idproveedor ){
                        $reporte->setCaIdproveedor( $this->idproveedor );
                    }else{
                        $reporte->setCaIdproveedor( null );
                    }
                    
                    if( $this->orden_prov ){
                        $reporte->setCaOrdenProv( $this->orden_prov );
                    }else{
                        $reporte->setCaOrdenProv( null );
                    }

                    if( $this->incoterms ){
                        $reporte->setCaIncoterms( $this->incoterms );
                    }else{
                        $reporte->setCaIncoterms( null );
                    }


                    $reporte->setCaNotify( $this->ca_notify );


                }else{
                    $reporte->setCaIdproveedor( null );
                    $reporte->setCaOrdenProv( null );
                    $reporte->setCaIncoterms( $bindValues["ca_incoterms"] );
                    $reporte->setCaNotify( null );
                }

                if( $this->idconsignatario ){
                    $reporte->setCaIdconsignatario( $this->idconsignatario );
                }else{
                    $reporte->setCaIdconsignatario( null );
                }

                if( $this->idmaster ){
                    $reporte->setCaIdmaster( $this->idmaster );
                }else{
                    $reporte->setCaIdmaster( null );
                }

                if( $this->idnotify ){
                    $reporte->setCaIdnotify( $this->idnotify );
                }else{
                    $reporte->setCaIdnotify( null );
                }

                if( $this->idrepresentante ){
                    $reporte->setCaIdrepresentante( $this->idrepresentante );
                }else{
                    $reporte->setCaIdrepresentante( null );
                }


                if( $bindValues["ca_informar_noti"] ){
                    $reporte->setCaInformarNoti( $bindValues["ca_informar_noti"] );
                }else{
                    $reporte->setCaInformarNoti( null );
                }
                
                if( $bindValues["ca_informar_cons"] ){
                    $reporte->setCaInformarCons( $bindValues["ca_informar_cons"] );
                }else{
                    $reporte->setCaInformarCons( null );
                }
                
                if( $bindValues["ca_informar_repr"] ){
                    $reporte->setCaInformarRepr( $bindValues["ca_informar_repr"] );
                }else{
                    $reporte->setCaInformarRepr( null );
                }
                
                if( $bindValues["ca_informar_mast"] ){
                    $reporte->setCaInformarMast( $bindValues["ca_informar_mast"] );
                }else{
                    $reporte->setCaInformarMast( null );
                }


                if( $bindValues["ca_idcotizacion"] ){
                    $reporte->setCaIdcotizacion( $bindValues["ca_idcotizacion"] );                
                }else{
                    $reporte->setCaIdcotizacion( null );                
                }


                if( $bindValues["ca_idproducto"] ){
                    $reporte->setCaIdproducto( $bindValues["ca_idproducto"] );
                }else{
                    $reporte->setCaIdproducto( null );
                }

                
                
                if( $bindValues["ca_colmas"]=="Sí" ){
                    $reporte->setCaColmas( "Sí" );
                    
                }else{
                    $reporte->setCaColmas( "No" );
                }
                

                if( $bindValues["ca_seguro"]!==null ){
                    $reporte->setCaSeguro( $bindValues["ca_seguro"] );
                }

                //Continuacion
                $reporte->setCaContinuacion( $bindValues["ca_continuacion"] );
                $reporte->setCaContinuacionDest( $bindValues["ca_continuacion_dest"] );
                $reporte->setCaContinuacionConf( $bindValues["ca_continuacion_conf"] );

                //Corte de documentos
                if( $bindValues["ca_impoexpo"]==Constantes::EXPO ){
                    $reporte->setCaIdconsignar( $bindValues["ca_idconsignar_expo"] );
                    $reporte->setCaIdconsignarmaster( $bindValues["ca_idconsignarmaster"] );
                }else{
                    $reporte->setCaIdconsignar( $bindValues["ca_idconsignar_impo"] );
                    $reporte->setCaIdbodega( $bindValues["ca_idbodega"] );
                    $reporte->setCaMastersame( $bindValues["ca_mastersame"] );
                }

                $reporte->setCaLiberacion( 0 );
                $reporte->setCaTiempocredito( 0 );
                if( $opcion!=1 ){ //Al copiar el reporte ya se coloco el usuario y la fecha
                    $reporte->stopBlaming();
                }
                $reporte->save();
                $repaduana = Doctrine::getTable("RepAduana")->find( $reporte->getCaIdreporte() );
                if( $bindValues["ca_colmas"]=="Sí" ){                    
                    if( !$repaduana ){
                        $repaduana = new RepAduana();
                        $repaduana->setCaIdreporte( $reporte->getCaIdreporte() );
                    }                    
                    $repaduana->setCaInstrucciones( $bindValuesAduana["ca_instrucciones"] );
                    if( $reporte->getCaImpoexpo()!=Constantes::EXPO ){
                        $repaduana->setCaTransnacarga( $bindValuesAduana["ca_transnacarga"] );
                        $repaduana->setCaCoordinador( $bindValuesAduana["ca_coordinador"] );
                    }else{
                        $repaduana->setCaTransnacarga( null );
                    }
                    $repaduana->setCaTransnatipo( $bindValuesAduana["ca_transnatipo"] );
                    $repaduana->save();

                }else{
                    if( $repaduana ){
                        $repaduana->delete();
                    }
                }


                $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte() );
                if( $bindValues["ca_seguro"]=="Sí"  ){
                    if( !$repseguro ){
                        $repseguro = new RepSeguro();
                        $repseguro->setCaIdreporte( $reporte->getCaIdreporte() );
                    }
                    $repseguro->setCaVlrasegurado( $bindValuesSeguro["ca_vlrasegurado"] );
                    $repseguro->setCaIdmonedaVlr( $bindValuesSeguro["ca_idmoneda_vlr"] );
                    $repseguro->setCaPrimaventa( $bindValuesSeguro["ca_primaventa"] );
                    $repseguro->setCaMinimaventa( $bindValuesSeguro["ca_minimaventa"] );
                    $repseguro->setCaIdmonedaVta( $bindValuesSeguro["ca_idmoneda_vta"] );
                    $repseguro->setCaObtencionpoliza( $bindValuesSeguro["ca_obtencionpoliza"] );
                    $repseguro->setCaIdmonedaPol( $bindValuesSeguro["ca_idmoneda_pol"] );
                    $repseguro->setCaSeguroConf( $bindValuesSeguro["ca_seguro_conf"] );
                    $repseguro->save();

                }else{
                    if( $repseguro ){
                        $repseguro->delete();
                    }
                }

                $repexpo = Doctrine::getTable("RepExpo")->find( $reporte->getCaIdreporte() );
                if( $bindValues["ca_impoexpo"]==Constantes::EXPO ){
                    if( !$repexpo ){
                        $repexpo = new RepExpo();
                        $repexpo->setCaIdreporte( $reporte->getCaIdreporte() );
                    }
                    
                    $repexpo->setCaPiezas( $bindValuesExpo["ca_piezas"]."|".$bindValuesExpo["tipo_piezas"] );
                    $repexpo->setCaPeso( $bindValuesExpo["ca_peso"] );
                    $repexpo->setCaVolumen( $bindValuesExpo["ca_volumen"] );
                    $repexpo->setCaDimensiones( $bindValuesExpo["ca_dimensiones"] );
                    if( $bindValuesExpo["ca_valorcarga"] ){
                        $repexpo->setCaValorcarga( $bindValuesExpo["ca_valorcarga"] );
                    }else{
                        $repexpo->setCaValorcarga( null );
                    }
                    $repexpo->setCaIdsia( $bindValuesExpo["ca_idsia"] );
                    if( $bindValuesExpo["ca_emisionbl"] ){
                        $repexpo->setCaEmisionbl( $bindValuesExpo["ca_emisionbl"] );
                    }else{
                        $repexpo->setCaEmisionbl( null );
                    }

                    if( $bindValuesExpo["ca_numbl"] ){
                        $repexpo->setCaNumbl( $bindValuesExpo["ca_numbl"] );
                    }else{
                        $repexpo->setCaNumbl( null );
                    }
                    $repexpo->setCaTipoexpo( $bindValuesExpo["ca_tipoexpo"] );
                    $repexpo->setCaMotonave( $bindValuesExpo["ca_motonave"] );
                    $repexpo->setCaAnticipo( $bindValuesExpo["ca_anticipo"] );
                    $repexpo->save();                  
                    
                    
                }else{
                    if( $repexpo ){
                        $repexpo->delete();
                    }
                }

                $this->redirect("reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte());
            }
        }

        $this->traficos = Doctrine::getTable('Trafico')->createQuery('t')
                            ->select("t.ca_idtrafico, t.ca_nombre")
                            ->where('t.ca_idtrafico != ?', '99-999')
                            ->addOrderBy('t.ca_nombre ASC')
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                            ->execute();
        
        foreach($this->traficos as $key=>$val){
			$this->traficos[$key]["ca_nombre"] = utf8_encode( $this->traficos[$key]["ca_nombre"] );
		}
        
        $this->reporte=$reporte;
        $this->form = $form;
        $this->formAduana = $formAduana;
        $this->formSeguro = $formSeguro;
        $this->formExpo = $formExpo;
        
        
		/*
			
		$c=new Criteria();
		$c->addAscendingOrderByColumn(AgentePeer::CA_NOMBRE);
		$this->agentes = AgentePeer::doSelect( $c );
		
		$c=new Criteria();
		$c->addAscendingOrderByColumn( SiaPeer::CA_NOMBRE );
		$this->sias = SiaPeer::doSelect( $c );
				
		$this->incoterms =  ParametroPeer::retrieveByCaso( "CU021" );
				
		$this->modalidades = ParametroPeer::retrieveByCaso( "CU011" );		
		
		
		$this->consignar = ParametroPeer::retrieveByCaso( "CU055" );
		$this->consignarMaster = ParametroPeer::retrieveByCaso( "CU048" );	
		
			
		
		$this->subModMar = ParametroPeer::retrieveByCaso( "CU051", null, $reporteNegocio->getCaImpoexpo() );
		$this->subModAer = ParametroPeer::retrieveByCaso( "CU052", null, $reporteNegocio->getCaImpoexpo() );
		$this->subModTer = ParametroPeer::retrieveByCaso( "CU053", null, $reporteNegocio->getCaImpoexpo() );
		
					
		$c = new Criteria();
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_NOMBRE );
		$criterion = $c->getNewCriterion( UsuarioPeer::CA_CARGO ,'Gerente Sucursal' );								
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_CARGO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Comercial%', Criteria::LIKE ));
		$c->add($criterion);
		$this->comerciales = UsuarioPeer::doSelect( $c );	
			
			
			
						
		$c = new Criteria();
		$this->monedas = MonedaPeer::doSelect($c);
			
			
						
		$this->user = $this->getUser();									
		*/
		
/*		 */


        
	}

    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executePanelConceptosData(sfWebRequest $request){
        $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
	    $this->forward404Unless( $reporte );

        $conceptos = array();

        $baseRow = array(
	 					 'idreporte'=>$reporte->getCaIdreporte()
						);

        $tarifas = Doctrine::getTable("RepTarifa")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->execute();


        foreach( $tarifas as $tarifa ){
            $row = $baseRow;
            $row["iditem"] = $tarifa->getCaIdconcepto();
            $row["item"] = utf8_encode($tarifa->getConcepto()->getCaConcepto());
            $row["cantidad"] = $tarifa->getCaCantidad();
            $row["neta_tar"] = $tarifa->getCaNetaTar();
            $row["neta_min"] = $tarifa->getCaNetaMin();
            $row["neta_idm"] = $tarifa->getCaNetaIdm();
            $row["reportar_tar"] = $tarifa->getCaReportarTar();
            $row["reportar_min"] = $tarifa->getCaReportarMin();
            $row["reportar_idm"] = $tarifa->getCaReportarIdm();
            $row["cobrar_tar"] = $tarifa->getCaCobrarTar();
            $row["cobrar_min"] = $tarifa->getCaCobrarMin();
            $row["cobrar_idm"] = $tarifa->getCaCobrarIdm();
            $row["observaciones"] = $tarifa->getCaObservaciones();
            $row['tipo']="concepto";
            $row['orden']=$tarifa->getConcepto()->getCaConcepto();
            $conceptos[] = $row;

            $recargos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", $tarifa->getCaIdconcepto() )
                             ->execute();
            foreach( $recargos as $recargo ){
                $row = $baseRow;
                $row["iditem"] = $recargo->getCaIdrecargo();
                $row["idconcepto"] = $tarifa->getCaIdconcepto();
                $row["item"] = utf8_encode($recargo->getTipoRecargo()->getCaRecargo());
                $row["tipo_app"] = $recargo->getCaTipo();
                $row["aplicacion"] = $recargo->getCaAplicacion();
                $row["neta_tar"] = $recargo->getCaNetaTar();
                $row["neta_min"] = $recargo->getCaNetaMin();                
                $row["reportar_tar"] = $recargo->getCaReportarTar();
                $row["reportar_min"] = $recargo->getCaReportarMin();                
                $row["cobrar_tar"] = $recargo->getCaCobrarTar();
                $row["cobrar_min"] = $recargo->getCaCobrarMin();
                $row["cobrar_idm"] = $recargo->getCaIdmoneda();
                $row["observaciones"] = $recargo->getCaDetalles();
                $row['tipo']="recargo";
                $row['orden']=$tarifa->getConcepto()->getCaConcepto()."-".$recargo->getTipoRecargo()->getCaRecargo();
                $conceptos[] = $row;
            }
        }

        $recargos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->innerJoin("t.TipoRecargo tr")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", 9999 )
                             ->addWhere("tr.ca_tipo = ?", Constantes::RECARGO_EN_ORIGEN )
                             ->execute();

        if( count($recargos)>0){

            $row = $baseRow;
            $row["iditem"] = 9999;

            $row["item"] = "Recargo general del trayecto";
            $row['tipo']="concepto";
            $row['orden']="Y";
            $conceptos[] = $row;

            foreach( $recargos as $recargo ){
                $row = $baseRow;
                $row["iditem"] = $recargo->getCaIdrecargo();
                $row["idconcepto"] = 9999;
                $row["item"] = utf8_encode($recargo->getTipoRecargo()->getCaRecargo());
                $row["tipo_app"] = $recargo->getCaTipo();
                $row["aplicacion"] = $recargo->getCaAplicacion();
                $row["neta_tar"] = $recargo->getCaNetaTar();
                $row["neta_min"] = $recargo->getCaNetaMin();
                $row["reportar_tar"] = $recargo->getCaReportarTar();
                $row["reportar_min"] = $recargo->getCaReportarMin();
                $row["cobrar_tar"] = $recargo->getCaCobrarTar();
                $row["cobrar_min"] = $recargo->getCaCobrarMin();
                $row["cobrar_idm"] = $recargo->getCaIdmoneda();
                $row["observaciones"] = $recargo->getCaDetalles();
                $row['tipo']="recargo";
                $row['orden']="Y-".$recargo->getTipoRecargo()->getCaRecargo();
                $conceptos[] = $row;
            }
        }

        $row = $baseRow;		
        $row['iditem']="";
        $row['item']="+";       
        $row['tipo']="concepto";
        $row['orden']="Z";
        $conceptos[] = $row;



        $this->responseArray=array("items"=>$conceptos, "total"=>count($conceptos), "success"=>true);
        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeObservePanelConceptoFletes(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);


        $tipo = $request->getParameter("tipo");

        if( $tipo=="concepto" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepTarifa")->find(array($idreporte, $idconcepto));
            if( !$tarifa ){
                $tarifa = new RepTarifa();
                $tarifa->setCaIdreporte( $idreporte );
                $tarifa->setCaIdconcepto( $idconcepto );
            }


            if( $request->getParameter("cantidad")!==null ){
                $tarifa->setCaCantidad( $request->getParameter("cantidad") );
            }

            if( $request->getParameter("neta_tar")!==null ){
                $tarifa->setCaNetaTar( $request->getParameter("neta_tar") );
            }
            if( $request->getParameter("neta_min")!==null ){
                $tarifa->setCaNetaMin( $request->getParameter("neta_min") );
            }

            if( $request->getParameter("neta_idm")!==null ){
                $tarifa->setCaNetaIdm( $request->getParameter("neta_idm") );
            }


            if( $request->getParameter("reportar_tar")!==null ){
                $tarifa->setCaReportarTar( $request->getParameter("reportar_tar") );
            }

            if( $request->getParameter("reportar_min")!==null ){
                $tarifa->setCaReportarMin( $request->getParameter("reportar_min") );
            }

            if( $request->getParameter("reportar_idm")!==null ){
                $tarifa->setCaReportarIdm( $request->getParameter("reportar_idm") );
            }

            if( $request->getParameter("cobrar_tar")!==null ){
                $tarifa->setCaCobrarTar( $request->getParameter("cobrar_tar") );
            }

            if( $request->getParameter("cobrar_min")!==null ){
                $tarifa->setCaCobrarMin( $request->getParameter("cobrar_min") );
            }

            if( $request->getParameter("cobrar_idm")!==null ){
                $tarifa->setCaCobrarIdm( $request->getParameter("cobrar_idm") );
            }

            if( $request->getParameter("observaciones")!==null ){
                if( $request->getParameter("observaciones") ){
                    $tarifa->setCaObservaciones( $request->getParameter("observaciones") );
                }else{
                    $tarifa->setCaObservaciones( null );
                }
            }

            $tarifa->save();
            $this->responseArray["success"]=true;
        }


        if( $tipo=="recargo" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("idconcepto");
            $idrecargo = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepGasto")->find(array($idreporte, $idconcepto, $idrecargo ));
            if( !$tarifa ){
                $tarifa = new RepGasto();
                $tarifa->setCaIdreporte( $idreporte );
                $tarifa->setCaIdconcepto( $idconcepto );
                $tarifa->setCaIdrecargo( $idrecargo );
            }

            if( $request->getParameter("aplicacion")!==null ){
                $tarifa->setCaAplicacion( $request->getParameter("aplicacion") );
            }

            if( $request->getParameter("tipo_app")!==null ){
                $tarifa->setCaTipo( $request->getParameter("tipo_app") );
            }
            
            if( $request->getParameter("neta_tar")!==null ){
                $tarifa->setCaNetaTar( $request->getParameter("neta_tar") );
            }else{
                $tarifa->setCaNetaTar( 0 ); //[TODO] permitir null
            }


            if( $request->getParameter("neta_min")!==null ){
                $tarifa->setCaNetaMin( $request->getParameter("neta_min") );
            }else{
                $tarifa->setCaNetaMin( 0 ); //[TODO] permitir null
            }


            if( $request->getParameter("reportar_tar")!==null ){
                $tarifa->setCaReportarTar( $request->getParameter("reportar_tar") );
            }else{
                $tarifa->setCaReportarTar( 0 ); //[TODO] permitir null
            }

            if( $request->getParameter("reportar_min")!==null ){
                $tarifa->setCaReportarMin( $request->getParameter("reportar_min") );
            }else{
                $tarifa->setCaReportarMin( 0 ); //[TODO] permitir null
            }
            

            if( $request->getParameter("cobrar_tar")!==null ){
                $tarifa->setCaCobrarTar( $request->getParameter("cobrar_tar") );
            }

            if( $request->getParameter("cobrar_min")!==null ){
                $tarifa->setCaCobrarMin( $request->getParameter("cobrar_min") );
            }

            if( $request->getParameter("cobrar_idm")!==null ){
                $tarifa->setCaIdmoneda( $request->getParameter("cobrar_idm") );
            }

            if( $request->getParameter("observaciones")!==null ){
                if( $request->getParameter("observaciones") ){
                    $tarifa->setCaDetalles( $request->getParameter("observaciones") );
                }else{
                    $tarifa->setCaDetalles( null );
                }
            }

            $tarifa->save();
            $this->responseArray["success"]=true;
        }

        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeEliminarPanelConceptosFletes(sfWebRequest $request){

        $tipo = $request->getParameter("tipo");

        if( $tipo=="concepto" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("idconcepto");
            $tarifa = Doctrine::getTable("RepTarifa")->find(array($idreporte, $idconcepto));


            $gastos = Doctrine_Query::create()
                                ->select("g.*")
                                ->from("RepGasto g")
                                ->innerJoin("g.TipoRecargo t")
                                ->where("g.ca_idreporte = ? AND g.ca_idconcepto = ?", array($idreporte, $idconcepto))
                                ->addWhere("t.ca_tipo = ?", Constantes::RECARGO_EN_ORIGEN)                                
                                ->execute();

            foreach( $gastos as $gasto ){
                $gasto->delete();
            }

            if( $tarifa ){               

                $tarifa->delete();
            }
        }


        if( $tipo=="recargo" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("idconcepto");
            $idrecargo = $request->getParameter("idrecargo");
            $tarifa = Doctrine::getTable("RepGasto")->find(array($idreporte, $idconcepto, $idrecargo ));

            if( $tarifa ){
                $tarifa->delete();
            }
        }

        $this->setTemplate("responseTemplate");

        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>true);

    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executePanelRecargosData(sfWebRequest $request){
        $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
	    $this->forward404Unless( $reporte );

        $conceptos = array();

        $baseRow = array(
	 					 'idreporte'=>$reporte->getCaIdreporte()
						);



        $recargos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->innerJoin("t.TipoRecargo tr")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", 9999 )
                             ->addWhere("tr.ca_tipo = ?", Constantes::RECARGO_LOCAL )
                             ->execute();

        
            
        foreach( $recargos as $recargo ){
            $row = $baseRow;
            $row["iditem"] = $recargo->getCaIdrecargo();
            $row["idconcepto"] = 9999;
            $row["item"] = utf8_encode($recargo->getTipoRecargo()->getCaRecargo());
            $row["tipo_app"] = $recargo->getCaTipo();
            $row["aplicacion"] = $recargo->getCaAplicacion();
            $row["neta_tar"] = $recargo->getCaNetaTar();
            $row["neta_min"] = $recargo->getCaNetaMin();
            $row["reportar_tar"] = $recargo->getCaReportarTar();
            $row["reportar_min"] = $recargo->getCaReportarMin();
            $row["cobrar_tar"] = $recargo->getCaCobrarTar();
            $row["cobrar_min"] = $recargo->getCaCobrarMin();
            $row["cobrar_idm"] = $recargo->getCaIdmoneda();
            $row["observaciones"] = $recargo->getCaDetalles();
            $row['tipo']="recargo";
            $row['orden']="Y-".$recargo->getTipoRecargo()->getCaRecargo();
            $conceptos[] = $row;
        }
        

        $row = $baseRow;
        $row['iditem']="";
        $row['item']="+";
        $row['tipo']="recargo";
        $row['orden']="Z";
        $conceptos[] = $row;



        $this->responseArray=array("items"=>$conceptos, "total"=>count($conceptos), "success"=>true);
        $this->setTemplate("responseTemplate");
        

    }
    

    /*
    * Datos para el panel de recargos de aduana
    * @param sfRequest $request A request object
    */
    public function executePanelRecargosAduanaData(sfWebRequest $request){

        $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
	    $this->forward404Unless( $reporte );

        $conceptos = array();

        $baseRow = array(
	 					 'idreporte'=>$reporte->getCaIdreporte()
						);



        $recargos = Doctrine::getTable("RepCosto")
                             ->createQuery("t")
                             //->innerJoin("t.Costo c")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             //->addWhere("t.ca_idconcepto = ?", 9999 )
                             //->addWhere("tr.ca_tipo = ?", Constantes::RECARGO_LOCAL )
                             ->execute();



        foreach( $recargos as $recargo ){
            $row = $baseRow;
            $row["iditem"] = $recargo->getCaIdcosto();           
            $row["item"] = utf8_encode($recargo->getCosto()->getCaCosto());
            $row["tipo_app"] = $recargo->getCaTipo();           
            $row["vlrcosto"] = $recargo->getCaVlrcosto();
            $row["mincosto"] = $recargo->getCaMincosto();
            $row["netcosto"] = $recargo->getCaNetcosto();
            $row["idmoneda"] = $recargo->getCaIdmoneda();
            $row["observaciones"] = $recargo->getCaDetalles();
            $row['tipo']="costo";
            $row['orden']="Y-".$recargo->getCosto()->getCaCosto();
            $conceptos[] = $row;
        }

        $row = $baseRow;
        $row['iditem']="";
        $row['item']="+";
        $row['tipo']="costo";
        $row['orden']="Z";
        $conceptos[] = $row;
        $this->responseArray=array("items"=>$conceptos, "total"=>count($conceptos), "success"=>true);
        $this->setTemplate("responseTemplate");
    }



    /*
    * Guarda para el panel de recargos de aduana
     *
    * @param sfRequest $request A request object
    */
    public function executeObservePanelRecargosAduana(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);


        $tipo = $request->getParameter("tipo");



        if( $tipo=="costo" ){
            $idreporte = $request->getParameter("idreporte");            
            $idcosto = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepCosto")->find(array($idreporte, $idcosto ));
            if( !$tarifa ){
                $tarifa = new RepCosto();
                $tarifa->setCaIdreporte( $idreporte );
                $tarifa->setCaIdcosto( $idcosto );
               
            }

            

            if( $request->getParameter("tipo_app")!==null ){
                $tarifa->setCaTipo( $request->getParameter("tipo_app") );
            }

            if( $request->getParameter("vlrcosto")!==null ){
                $tarifa->setCaVlrcosto( $request->getParameter("vlrcosto") );
            }

            if( $request->getParameter("mincosto")!==null ){
                $tarifa->setCaMincosto( $request->getParameter("mincosto") );
            }

            if( $request->getParameter("netcosto")!==null ){
                $tarifa->setCaNetcosto( $request->getParameter("netcosto") );
            }

            

            if( $request->getParameter("idmoneda")!==null ){
                $tarifa->setCaIdmoneda( $request->getParameter("idmoneda") );
            }

            if( $request->getParameter("observaciones")!==null ){

                if( $request->getParameter("observaciones") ){
                    $tarifa->setCaDetalles( $request->getParameter("observaciones") );
                }else{
                    $tarifa->setCaDetalles( null );
                }
            }

            $tarifa->save();
            $this->responseArray["success"]=true;
        }

        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeEliminarRecargosAduana(sfWebRequest $request){

        $tipo = $request->getParameter("tipo");

        if( $tipo=="costo" ){
            $idreporte = $request->getParameter("idreporte");
            $idcosto = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepCosto")->find(array($idreporte, $idcosto));
            
            if( $tarifa ){
                $tarifa->delete();
            }
        }

        $this->setTemplate("responseTemplate");

        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>true);

    }




















	
	
	
	
	
	/**
	* Genera un archivo PDF con el reporte de negocio
	* @author Andres Botero
	*/
	public function executeGenerarPDF( $request ){
		$this->forward404Unless( $request->getParameter("id") );
        $this->reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
		$this->forward404Unless($this->reporte);
		$this->filename = $this->getrequestparameter("filename");
	}
	
	/*
	* Anula un reporte 
	* @author: Andres Botero 
	*/
	public function executeAnularReporte( $request ){
        $this->forward404Unless( $request->getParameter("id") );
        $this->forward404Unless( trim($request->getParameter("motivo")) );
		$reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
		$this->forward404Unless($reporte);

		$user = $this->getUser();
		$reporte->setCaUsuanulado( $user->getUserId() );
		$reporte->setCaFchanulado( date("Y-m-d H:i:s") );
        $reporte->setCaDetanulado( trim($request->getParameter("motivo")));
		$reporte->save();

        $this->responseArray = array("success"=>true);
        $this->setTemplate("responseTemplate");
	}

    /*
	* Revive un reporte anulado
	* @author: Andres Botero
	*/
	public function executeRevivirReporte( $request ){
        $this->forward404Unless( $request->getParameter("id") );        
		$reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
		$this->forward404Unless($reporte);

		$user = $this->getUser();
		$reporte->setCaUsuanulado( null );
		$reporte->setCaFchanulado( null );
        $reporte->setCaDetanulado( "Revivido por: ".$user->getUserId()." ".date("Y-m-d H:i:s") );
		$reporte->save();

        $this->redirect( "reportesNeg/verReporte?id=".$reporte->getCaIdreporte() );
	}
	
	
	
	/*
	* Envia un reporte por correo 	
	*/
	public function executeEnviarReporteEmail(){
		$this->reporteNegocio =  Doctrine::getTable("Reporte")->find( $this->getRequestParameter("reporteId") );
		$fileName = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."reporte".$this->getRequestParameter("reporteId").".pdf" ;
		if(file_exists($fileName)){
			@unlink( $fileName );
		}	 		
		$this->getRequest()->setParameter('filename',$fileName); 
		sfContext::getInstance()->getController()->getPresentationFor( 'reportesNeg', 'generarPDF') ;
		$this->setLayout("ajax");
		
						
		$user = $this->getUser();
					
		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Envío de reportes" ); 		
		$email->setCaIdcaso( $this->getRequestParameter("reporteId") );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );
		
		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
		}

		$email->setCaReplyto( $user->getEmail() );
				
		$recips = explode(",",$this->getRequestParameter("destinatario"));									
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addTo( $recip ); 
				}
			}	
		}
				
		$recips =  explode(",",$this->getRequestParameter("cc")) ;
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addCc( $recip ); 
				}
			}
		}
				
		$email->addCc( $this->getUser()->getEmail() );					
		$email->setCaSubject( $this->getRequestParameter("asunto") );		
		$email->setCaBody( $this->getRequestParameter("mensaje") );	
		$email->addAttachment( $fileName );
		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();	
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}
		@unlink( $fileName );		
	}
	
	
	
	

}

?>