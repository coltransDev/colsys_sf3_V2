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


    public function getNivel( ){

        /*
        $this->nivel = -1;
		$this->nivel = $this->getUser()->getNivelAcceso( idsActions::RUTINA_AGENTES );
         
		if( $this->nivel==-1 ){
			$this->forward404();
		}
        return $this->nivel;
         */
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
		
	/*
	* Permite crear y editar el encabezado de un reporte de negocios 
	* @author Andres Botero
    * @param sfRequest $request A request object
    */
    public function executeFormReporte(sfWebRequest $request){           

        $this->nivel = $this->getNivel();

        $form = new NuevoReporteForm( );

        

        $this->origen = $request->getParameter("origen");
        $this->destino = $request->getParameter("destino");
		
		if( $this->getRequestParameter("id") ){
			$reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
			$this->forward404Unless( $reporte );
			
		}else{		
			$reporte = new Reporte();
		}


        if ($request->isMethod('post')){
            $bindValues = $request->getParameter("reporte");
            //print_r( $bindValues );
            //exit();
            if( !$reporte->getCaIdreporte() ){
                $bindValues["ca_fchreporte"] = date("Y-m-d");
                $bindValues["ca_login"] = "abotero";
                $bindValues["ca_consecutivo"] = ReporteTable::siguienteConsecutivo(date("Y"));
                $bindValues["ca_version"] = 1;               
            }
            $form->bind( $bindValues );

			if( $form->isValid() ){
               
                $reporte  = $form->save();

                
                $this->redirect("reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte());



            }
        }
		
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
			
			
		$this->aerolineas = TransportadorPeer::retrieveByTransporte( "Aéreo" );							
		$this->navieras = TransportadorPeer::retrieveByTransporte( "Marítimo" );		
		$this->transportadores = TransportadorPeer::retrieveByTransporte( "Terrestre" );	
						
		$c = new Criteria();
		$this->monedas = MonedaPeer::doSelect($c);
			
		$c = new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$c->addJoin( TraficoPeer::CA_IDTRAFICO, CiudadPeer::CA_IDTRAFICO );	
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );		
		$this->ciudades = CiudadPeer::doSelect( $c );	
						
		$this->user = $this->getUser();									
		*/
		
/*		$cotProducto = $reporteNegocio->getCotProducto();		
	
		if( $cotProducto ){	
			$this->id_producto = $cotProducto->getId();
			$this->id_cotizacion = $cotProducto->getCaIdcotizacion();
		
		}else{	
			$this->id_producto = null;
			$this->id_cotizacion = null;
		} */


        $this->reporte=$reporte;
        
        $this->form = $form;
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
            }

            if( $request->getParameter("neta_min")!==null ){
                $tarifa->setCaNetaMin( $request->getParameter("neta_min") );
            }

            if( $request->getParameter("reportar_tar")!==null ){
                $tarifa->setCaReportarTar( $request->getParameter("reportar_tar") );
            }

            if( $request->getParameter("reportar_min")!==null ){
                $tarifa->setCaReportarMin( $request->getParameter("reportar_min") );
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
	* Copia un reporte en otro nuevo creando una nueva version o un
	* nuevo consecutivo
	* @author Andres Botero
	*/
	public function executeLiquidarReporte(){
        $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
	    $this->forward404Unless( $reporte );
        
        $this->reporte=$reporte;
    }

	/*
	* Copia un reporte en otro nuevo creando una nueva version o un 
	* nuevo consecutivo 
	* @author Andres Botero
	*/
	public function executeCopiarReporte(){	
		$this->modo = $this->getRequestParameter("modo");					
		$this->forward404Unless( $this->modo );
				
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("reporteId") );
		$this->forward404Unless( $reporteNegocio );
		$reporteNegocioOld = $reporteNegocio;
		$reporteNegocio = $reporteNegocioOld->copy( false ); 
		
		$user_id = $this->getUser()->getUserId();
				
		if( $this->getRequestParameter('option')=="nuevaVersion" ){	
			$reporteNegocio->setCaConsecutivo( $reporteNegocioOld->getCaConsecutivo() ); 				
			$reporteNegocio->setCaVersion( $reporteNegocioOld->getCaVersion()+1 );	
						
			$reporteNegocio->setCaFchactualizado( date("Y-m-d H:i:s") );	
			$reporteNegocio->setCaUsuactualizado( $user_id  );
			
		}else{
			$sig = ReportePeer::siguienteConsecutivo( date("Y") );		
			$reporteNegocio->setCaConsecutivo( $sig ); 
			$reporteNegocio->setCaVersion( 1 );
			$reporteNegocio->setCaFchreporte( date("Y-m-d H:i:s") ); 
			
			$reporteNegocio->setCaFchcreado( date("Y-m-d H:i:s") );	
			$reporteNegocio->setCaUsucreado( $user_id );			
	
			$reporteNegocio->setCaFchactualizado( null );	
			$reporteNegocio->setCaUsuactualizado( null);	
			
			$reporteNegocio->setCaIdetapa( null );		
			$reporteNegocio->setCaFchultstatus( null );		
		}
		
		
		
		$reporteNegocio->save();					
		
				
		//Copia los conceptos				
		$conceptos = $reporteNegocioOld->getRepTarifas( );				
		foreach( $conceptos as $concepto ){
			$newConcepto = $concepto->copy();
			$newConcepto->setCaIdconcepto( $concepto->getCaIdconcepto() );
			$newConcepto->setCaIdreporte( $reporteNegocio->getCaIdreporte() );
			$newConcepto->save();
		}
		
		//Copia los gastos				
		$gastos = $reporteNegocioOld->getRecargos( );	
		foreach($gastos as $gasto ){
			$newGasto = $gasto->copy();
			$newGasto->setCaIdconcepto( $gasto->getCaIdconcepto() );
			$newGasto->setCaIdrecargo( $gasto->getCaIdrecargo() );
			$newGasto->setCaIdreporte( $reporteNegocio->getCaIdreporte() );
			$newGasto->save();
		}
		
		$costos = $reporteNegocioOld->getCostos( );
		foreach($costos as $costo ){
			$newCosto = $costo->copy();			
			$newCosto->setCaIdcosto( $costo->getCaIdcosto() );
			$newCosto->setCaIdreporte( $reporteNegocio->getCaIdreporte() );
			$newCosto->save();
		}
		
		if( $reporteNegocio->getCaImpoexpo()=="Exportación" ){
			$repExpo = $reporteNegocioOld->getRepExpo();
			$repExpoNew = $repExpo->copy();
			$repExpoNew->setCaidreporte( $reporteNegocio->getCaIdreporte() );
			$repExpoNew->save();
		}
		
		if( $reporteNegocio->getCaColmas()=="Sí" ){				
			$repAduana = $reporteNegocioOld->getRepAduana();
			$repAduanaNew = $repAduana->copy();
			$repAduanaNew->setCaidreporte( $reporteNegocio->getCaIdreporte() );
			$repAduanaNew->save();
		}
		
		if( $reporteNegocio->getCaSeguro() =="Sí" ){				
			$repSeguro = $reporteNegocioOld->getRepSeguro();
			$repSeguroNew = $repSeguro->copy();
			$repSeguroNew->setCaidreporte( $reporteNegocio->getCaIdreporte() );
			$repSeguroNew->save();
		}
		
		$this->redirect( "reportesNeg/consultaReporte?modo=".$this->modo."&reporteId=".$reporteNegocio->getCaIdreporte()."&token=".md5(time()) );
		
	}
	
	/*
	* Si ocurre un error reenvia a la pagina original y muestra los mensajes 
	* de error
	* @author: Andres Botero
	*/
	public function handleErrorFormReporteGuardar()
	{
		$this->forward("reportesNeg", "formReporte");
	}
	
	/*
	* Guarda los cambios realizados  
	* @author Andres Botero
	*/
	public function executeFormReporteGuardar(){
		
		$this->modo = $this->getRequestParameter("modo");					
		$this->forward404Unless( $this->modo );
		
		if( $this->getRequestParameter("reporteId") ){
			$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("reporteId") );
			$this->forward404Unless( $reporteNegocio );
			
		}else{		
			$reporteNegocio = new Reporte();
			$sig = ReportePeer::siguienteConsecutivo( date("Y") );			
			$reporteNegocio->setCaConsecutivo( $sig ); 
			$reporteNegocio->setCaVersion( 1 ); 			
		}
		
		if( $this->getRequestParameter( "idconcliente") ){				
			$user_id = $this->getUser()->getUserId();
						
			$reporteNegocio->setCaFchreporte( date("Y-m-d H:i:s") );  
							
			$reporteNegocio->setCaIdcotizacion( $this->getRequestParameter( "idcotizacion"  ) ); 
			
			if( $this->modo=="expo" ){
				$reporteNegocio->setCaImpoExpo( "Exportación" );  				  
			}else{
				$reporteNegocio->setCaImpoExpo( "Importación" ); 
			}

			$reporteNegocio->setCaOrdenClie( $this->getRequestParameter( "orden_clie" ) ); 
			if( $this->modo=="expo" ){
				//el proveedor no existe en exportaciones
				$reporteNegocio->setCaIdproveedor( null );
				$reporteNegocio->setCaOrdenProv( "''" );
				$reporteNegocio->setCaIdrepresentante( 0 ); 
				$reporteNegocio->setCaInformarRepr( '' );	
				$reporteNegocio->setCaInformarCons( '' );
				$reporteNegocio->setCaInformarNoti( '' );	
				$reporteNegocio->setCaNotify( '' );
				$reporteNegocio->setCaLiberacion( '' );		
				$reporteNegocio->setCaTiempoCredito( '-' );
				$reporteNegocio->setCaContinuacion( 'N/A' );						
			}
			
			
			
			//Cliente Coltrans  
			//Agente			
			$reporteNegocio->setCaIdconsignar( $this->getRequestParameter( "idconsignar" ) );
			$reporteNegocio->setCaIdconsignarmaster( $this->getRequestParameter( "idconsignarmaster" ) );
			$reporteNegocio->setCaMasterSame( false );	
			
			
			$idconcliente = $this->getRequestParameter( "idconcliente" );
			
			$contacto = ContactoPeer::retrieveByPk( $idconcliente );
			
			$cliente = $contacto->getCliente();						
			
			//Colocar lista de correo			
			$contactos = $this->getRequestParameter( "contactos" );
			$confirmar = $this->getRequestParameter( "confirmar" );
			$reporteNegocio->setCaConfirmarClie("");
			
			if( is_array($contactos) && is_array($confirmar) ){
				for($i=0; $i<count($contactos); $i++){		
					if(in_array($i,$confirmar)){	
						$reporteNegocio->addConfirmarClie( $contactos[$i] );
					}
				}
			}
			
			if( is_array($contactos) ){
				$cliente->setCaConfirmar( implode(",", $contactos) );					
				$cliente->save();
			}

			
			
			
			if( $idconcliente ){
				$reporteNegocio->setCaIdConcliente( $idconcliente );  			  
			}
			
			$fchDespacho = $this->getRequestParameter( "fchDespacho" );
			if( $fchDespacho ){
				$reporteNegocio->setCaFchDespacho( $fchDespacho );  			  
			}
			
			$mercancia_desc = $this->getRequestParameter( "mercancia_desc" );
			if( $mercancia_desc ){
				$reporteNegocio->setCaMercanciaDesc( $mercancia_desc );  
			}
			
			$ca_origen = $this->getRequestParameter( "idCiudadOrigen" );
			if( $ca_origen ){
				$reporteNegocio->setCaOrigen( $ca_origen );  				
			}
			
			$ca_destino = $this->getRequestParameter( "idCiudad" );
			if( $ca_destino ){
				$reporteNegocio->setCaDestino( $ca_destino );  
			}
								
			$ca_transporte = $this->getRequestParameter( "transporte" );
			if( $ca_transporte ){
				$reporteNegocio->setCaTransporte( $ca_transporte );  
			}
			
			$ca_incoterms = $this->getRequestParameter( "incoterms" );
			if( $ca_incoterms ){
				$reporteNegocio->setCaIncoterms( $ca_incoterms );  
			}
									
			/*$ca_idsia = $this->getRequestParameter( "sia" );
			if( $ca_idsia ){
				$reporteNegocio->setCaIdsia( $ca_idsia );  
			}*/
												
			if( !$reporteNegocio->getCaIdreporte() ){
				$reporteNegocio->setCaFchcreado( date("Y-m-d H:i:s") );	
				$reporteNegocio->setCaUsucreado( $user_id );			
			}else{
				$reporteNegocio->setCaFchactualizado( date("Y-m-d H:i:s") );	
				$reporteNegocio->setCaUsuactualizado( $user_id );							
			}
			
			/*
			$ca_tipoexpo = $this->getRequestParameter( "modalidad" );
			if( $ca_tipoexpo ){
				$reporteNegocio->setCaTipoExpo( $ca_tipoexpo );  
			}
			*/
			
			$ca_idconsignatario = $this->getRequestParameter( "idconsignatario" );
			if( $ca_idconsignatario ){
				$reporteNegocio->setCaIdConsignatario( $ca_idconsignatario );  
			}
			
			$ca_idnotify = $this->getRequestParameter( "idnotify" );
			if( $ca_idnotify ){
				$reporteNegocio->setCaIdnotify( $ca_idnotify );  
			}else{
				$reporteNegocio->setCaIdnotify( 0 );					
			}
			
				
			$ca_login = $this->getRequestParameter( "login" );
			if( $ca_login ){
				$reporteNegocio->setCaLogin( $ca_login );  
			}else{
				$cliente = $reporteNegocio->getCliente();
				if( $cliente->getCaVendedor() ){
					$reporteNegocio->setCaLogin( $cliente->getCaVendedor() );  
				}else{
					$reporteNegocio->setCaLogin( "Comercial" );  
				}
				
			}
					
			$ca_preferencias_clie = $this->getRequestParameter( "preferencias_clie" );
			if( $ca_preferencias_clie !== null ){
				$reporteNegocio->setCaPreferenciasClie( $ca_preferencias_clie );  
			}
			
			$ca_idagente = $this->getRequestParameter( "agente" );
			if( $ca_idagente ){
				$reporteNegocio->setCaIdagente( $ca_idagente );  
			}else{
				$reporteNegocio->setCaIdagente( null );  
			}
			
			
			$ca_instrucciones = $this->getRequestParameter( "instrucciones_agente" );			
			
			if( $ca_instrucciones !== null ){
				$reporteNegocio->setCaInstrucciones( $ca_instrucciones );  
			}
									
			if( $reporteNegocio->getCaTransporte() == "Marítimo"  ){
				$idlinea = $this->getRequestParameter( "idnaviera" );
				$reporteNegocio->setCaIdlinea( $idlinea );
				
				$reporteNegocio->setCaModalidad( $this->getRequestParameter( "modalidad_mar" ) );					
			}
			
			if( $reporteNegocio->getCaTransporte() == "Aéreo"  ){
				$idlinea = $this->getRequestParameter( "idaerolinea" );
				$reporteNegocio->setCaIdlinea( $idlinea );	
				$reporteNegocio->setCaModalidad( $this->getRequestParameter( "modalidad_aer" ) );		
			}
			
			if( $reporteNegocio->getCaTransporte() == "Terrestre"  ){
				$idlineaterrestre = $this->getRequestParameter( "idlineaterrestre" );
				
				$reporteNegocio->setCaIdlinea( $idlineaterrestre );
				$reporteNegocio->setCaModalidad( $this->getRequestParameter( "modalidad_ter" ) );
			}
			
						
			
			$colmas = $this->getRequestParameter( "colmas" );
			if( $colmas=="No" ){
				$reporteNegocio->setCaColmas( "No" ); 
			}else{
				$reporteNegocio->setCaColmas( "Sí" ); 
			}	
			
			$seguro = $this->getRequestParameter( "seguro" );
			if( $seguro=="No" ){
				$reporteNegocio->setCaSeguro( "No" ); 
			}else{
				$reporteNegocio->setCaSeguro( "Sí" ); 
			}						
			
					
			$reporteNegocio->save();	
						
			/**********************************************************************
			* Guarda los datos de aduana en caso de un reporte de exportaciones
			***********************************************************************/
			if( $reporteNegocio->getCaImpoexpo() =="Exportación" ){
				$repExpo = $reporteNegocio->getRepExpo();
				$repExpo->setCaidreporte( $reporteNegocio->getCaIdreporte() );
				if( $this->getRequestParameter( "peso" )!==null ){
					$repExpo->setCaPeso( $this->getRequestParameter( "peso" )."|".$this->getRequestParameter( "tipo_peso" ) );	
				}
				
				if( $this->getRequestParameter( "volumen" )!==null ){
					$repExpo->setCaVolumen( $this->getRequestParameter( "volumen" )."|".$this->getRequestParameter( "tipo_volumen" ) );	
				}	
				
				
						
				if( $this->getRequestParameter( "piezas" )!==null ){
					$repExpo->setCaPiezas( $this->getRequestParameter( "piezas" )."|".$this->getRequestParameter( "tipo_piezas" ) );	
				}				
			
				$repExpo->setCaDimensiones( $this->getRequestParameter( "dimensiones" ) );	
				
				if( $this->getRequestParameter( "valorCarga" )!==null ){
					$repExpo->setCaValorcarga( $this->getRequestParameter( "valorCarga" ));	
				}
				
				if( $this->getRequestParameter( "anticipo" )!==null ){
					$repExpo->setCaAnticipo( $this->getRequestParameter( "anticipo" ));	
				}
				
				if( $this->getRequestParameter( "tipoexpo" )!==null ){
					$repExpo->setCaTipoexpo( $this->getRequestParameter( "tipoexpo" ) );	
				}
				
				if( $this->getRequestParameter( "sia" )!==null ){
					$repExpo->setCaIdsia( $this->getRequestParameter( "sia" ) );	
				}
				
				/*
				if( $reporteNegocio->getCaTransporte() == "Aereo/Terrestre" || $reporteNegocio->getCaTransporte() == "Maritimo/Terrestre"  || $reporteNegocio->getCaTransporte() == "Terrestre"  ){
					$idlineaterrestre = $this->getRequestParameter( "idlineaterrestre" );
					$repExpo->setCaIdlineaterrestre( $idlineaterrestre );				
				}else{
					$repExpo->setCaIdlineaterrestre( null );
				}*/
				
				if( $this->getRequestParameter( "motonave" )!==null ){
					$repExpo->setCaMotonave( $this->getRequestParameter( "motonave" ) );	
				}
				
				if( $this->getRequestParameter( "emisionbl" )!==null ){
					$repExpo->setCaEmisionbl( $this->getRequestParameter( "emisionbl" ) );	
				}
				
				
				if( $this->getRequestParameter( "numbl" )!==null ){
					$repExpo->setCaNumbl( $this->getRequestParameter( "numbl" ) );	
				}
				
				$repExpo->save();				
			}else{
				$repExpo = $reportesNegocio->getRepExpo();
				if( $repExpo ){
					$repExpo->delete();
				}
			}
			
								
			/**********************************************************************
			* Guarda los datos de aduana en caso de que seleccione Colmas Si
			***********************************************************************/	
			if( $colmas=="No" ){
				//En caso de que el registro exista lo elimina
				$repAduana = RepAduanaPeer::retrieveByPk( $reporteNegocio->getCaIdreporte() );
				if( $repAduana ){
					$repAduana->delete();
				}
			}else{
				
				$repAduana = RepAduanaPeer::retrieveByPk( $reporteNegocio->getCaIdreporte() );
				if( !$repAduana ){
					$repAduana = new RepAduana();
					$repAduana->setCaIdReporte( $reporteNegocio->getCaIdreporte()  );
				}
				
				if( $this->getRequestparameter("instrucciones")!==null ){
					$repAduana->setCaInstrucciones( $this->getRequestparameter("instrucciones") );
				}
				
				if( $this->getRequestparameter("transnacarga")=="No" ){
					$repAduana->setCaTransnacarga( "No" );
				}else{
					$repAduana->setCaTransnacarga( "Sí" );
				}
				
								
				
				
				if( $this->getRequestparameter("transnatipo") ){
					$repAduana->setCaTransnatipo( $this->getRequestparameter("transnatipo") );
				}
				//busca coordinador
				$repAduana->setCaCoordinador(null);
				$repAduana->save();
			}
			
			
			/**********************************************************************
			* Guarda los datos de aduana en caso de que seleccione Colmas Si
			***********************************************************************/	
			
			if( $seguro=="No" ){				
				$repSeguro = RepSeguroPeer::retrieveByPk( $reporteNegocio->getCaIdreporte() ); 				 				if( $repSeguro ){
					$repSeguro->delete();
				}				
			}else{									
				$repSeguro = RepSeguroPeer::retrieveByPk( $reporteNegocio->getCaIdreporte() );
				if( !$repSeguro ){
					$repSeguro = new RepSeguro();
					$repSeguro->setCaIdReporte( $reporteNegocio->getCaIdreporte()  );
				}
								
				$repSeguro->setCaVlrasegurado( $this->getRequestparameter("vlrasegurado") );
				$repSeguro->setCaIdmonedaVlr( $this->getRequestparameter("idmoneda_vlr") );				
				$repSeguro->setCaPrimaventa( $this->getRequestparameter("primaventa") );		
				$repSeguro->setCaMinimaventa( $this->getRequestparameter("minimaventa") );	
				$repSeguro->setCaIdmonedaVta( $this->getRequestparameter("idmoneda_vta") );		
				$repSeguro->setCaObtencionPoliza(  $this->getRequestparameter("obtencionpoliza") );	
				$repSeguro->setCaIdmonedaPol( $this->getRequestparameter("idmoneda_pol") );	
				$repSeguro->setCaSeguroConf( "spena" );			
				$repSeguro->save();
			}
			
			$this->redirect( "reportesNeg/consultaReporte?modo=".$this->modo."&reporteId=".$reporteNegocio->getCaIdreporte()."&token=".md5(time()) );
					
		}		
		
		exit;	
	}
	
	
	/**
	* Permite consultar un reporte de negocio ya creado y permite 
	* agregar nuevas  
	* @author Andres Botero
	*/
	public function executeConsultaReporte(){
		
		$reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $reporte );
		
		$this->reporte = $reporte;
		
		
	  
	}		
	
	
	/*
	* Permite ver una cotización en formato PDF
	*/
	public function executeVerReporte(){
		
        /*header("Location: /reportes/verReporte?id=".$this->getRequestParameter("reporteId"));
        exit();
        $this->modo = $this->getRequestParameter("modo");
		$this->reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("reporteId") );
		$this->forward404Unless( $this->reporteNegocio );	
		*/
		
			
	}
	
	/**
	* Genera un archivo PDF con el reporte de negocio
	* @author Andres Botero
	*/
	public function executeGenerarPDF(){
		$this->reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($this->reporteNegocio);	
		$this->filename = $this->getrequestparameter("filename");	
	}
	
	/*
	* Anula un reporte 
	* @author: Andres Botero 
	*/
	public function executeAnularReporte(){
		$this->reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($this->reporteNegocio);	
		$modo=$this->getrequestparameter("modo");
		$user = $this->getuser();
		$this->reporteNegocio->setCaUsuanulado( $user->getUserId() );
		$this->reporteNegocio->setCaFchanulado( time() );
		$this->reporteNegocio->save();
        
		$this->redirect( "reportesNeg/index?modo=".$modo );
		
	}
	
	/****************************************************************************
	*  Manejo de recargos
	****************************************************************************/
	
	/*
	* Envia al formulario en caso de que ocurra un error
	* @author: Andres Botero
	*/
	public function handleErrorGuardarRecargo(){
		$this->opcion = $this->getRequestParameter("opcion");
		$this->reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->tipo = $this->getRequestParameter("tipo");
		
		return sfView::SUCCESS;
	}
	
	/*
	* Inserta un nuevo recargo 
	* @author: Andres Botero
	*/
	public function executeGuardarRecargo(){
		
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);				
		
		$this->tipo = $this->getRequestParameter("tipo");	
				
		$oid = $this->getRequestParameter("oid");
		
		if( $oid ){
			$gasto = RepGastoPeer::retrieveByPk( $oid );
			$this->forward404Unless( $gasto );
		}else{
			$gasto = new RepGasto();
			$gasto->setCaIdReporte( $reporteNegocio->getCaIdreporte() );
		}
		
		$conceptoId = $this->getRequestParameter("concepto_id");
		$recargoId = $this->getRequestParameter("idrecargo");			
		$conceptoId = $this->getRequestParameter("idconcepto");
		
		//En caso de que ya se haya creado un recargo del mismo tipo muestra error. 
		$c = new Criteria();
		$c->add( RepGastoPeer::CA_IDREPORTE, $reporteNegocio->getCaIdreporte() );
		$c->add( RepGastoPeer::CA_IDCONCEPTO, $conceptoId );		
		$c->add( RepGastoPeer::CA_IDRECARGO, $recargoId );
		$count = RepGastoPeer::doCount( $c );			
		if( $count>0 ){
			$this->getRequest()->setError("idrecargo", "El recargo ya existe");
		}else{		
			$gasto->setCaIdconcepto( $conceptoId );
			$gasto->setCaIdrecargo( $recargoId );
			$gasto->setCaIdconcepto( $conceptoId  );
					
			$gasto->setCaNetaTar(  $this->getRequestParameter("neta_tar") );
			$gasto->setCaNetaMin(  $this->getRequestParameter("neta_min") );
			$gasto->setCaReportarTar(  $this->getRequestParameter("reportar_tar") );
			$gasto->setCaReportarMin(  $this->getRequestParameter("reportar_min") );	
			$gasto->setCaCobrarTar(  $this->getRequestParameter("cobrar_tar") );
			$gasto->setCaCobrarMin(  $this->getRequestParameter("cobrar_min") );
			$gasto->setCaIdmoneda(  $this->getRequestParameter("id_moneda") );
			$gasto->setCaAplicacion(  $this->getRequestParameter("aplicacion") );
			$gasto->setCaTipo(  $this->getRequestParameter("ca_tipo") );
			
			
			if( $this->getRequestParameter("detalle") ){	
				$gasto->setCaDetalles(  $this->getRequestParameter("detalle") );				
			}else{
				$gasto->setCaDetalles(  '' );					
			}	
			$gasto->save();			
		}
		
		$this->opcion = $this->getRequestParameter("opcion");
		$this->reporteNegocio = $reporteNegocio;
		$this->setLayout("ajax");			
	}
	
	/*
	* Guardar los cambios cuando un usuario hace click sobre un recargo y modifica un dato
	* author: Andres Botero
	*/
	public function executeObserveRecargos(){
		$oid = $this->getRequestParameter("oid");
		
		$gasto = RepGastoPeer::retrieveByPk( $oid );
		$this->forward404Unless( $gasto );
		
		
		$ca_tipo =  $this->getRequestParameter("ca_tipo");
		if( $ca_tipo ){
			$gasto->setCaTipo( $ca_tipo );
		}
		
		$neta_tar =  $this->getRequestParameter("neta_tar");
		if( $neta_tar!==null ){
			$gasto->setCaNetaTar( $neta_tar );
		}
		
		$neta_min =  $this->getRequestParameter("neta_min");
		if( $neta_min!==null ){
			$gasto->setCaNetaMin( $neta_min );
		}
		
		$reportar_tar =  $this->getRequestParameter("reportar_tar");
		if( $reportar_tar!==null ){
			$gasto->setCaReportarTar( $reportar_tar );
		}
		
		$reportar_min =  $this->getRequestParameter("reportar_min");
		if( $reportar_min!==null ){
			$gasto->setCaReportarMin( $reportar_min );
		}
		
		$cobrar_tar =  $this->getRequestParameter("cobrar_tar");
		if( $cobrar_tar!==null ){
			$gasto->setCaCobrarTar( $cobrar_tar );
		}
						
		$cobrar_min =  $this->getRequestParameter("cobrar_min");
		if( $cobrar_min!==null ){
			$gasto->setCaCobrarMin( $cobrar_min );
		}	
		
		$id_moneda =  $this->getRequestParameter("id_moneda");
		if( $id_moneda ){
			$gasto->setCaIdmoneda( $id_moneda );
		}
		
		$aplicacion =  $this->getRequestParameter("aplicacion");
		if( $aplicacion ){
			$gasto->setCaAplicacion( $aplicacion );
		}	
		
		$observaciones =  $this->getRequestParameter("observaciones");
		
		if( $observaciones!==null ){			
			$gasto->setCaDetalles( $observaciones );
		}	
				
		$gasto->save();			
		
		return sfViwew::NONE;						
	}
	
	
	/*
	* Elimina un recargo
	* author: Andres Botero
	*/
	public function executeEliminarRecargo(){
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);		
		
		$oid = $this->getRequestParameter("oid");		
		$gasto = RepGastoPeer::retrieveByPk( $oid );
		$this->forward404Unless( $gasto );
		$gasto->delete();
		
		
		$this->reporteNegocio = $reporteNegocio;		
		$this->opcion = $this->getRequestParameter("opcion");		
		$this->tipo = $this->getRequestParameter("tipo");		
		$this->setLayout("ajax");	
		$this->setTemplate("guardarRecargo");
		
	}
	
	/****************************************************************************
	*  Manejo de costos
	****************************************************************************/
	
	/*
	* Envia al formulario en caso de que ocurra un error
	* @author: Andres Botero
	*/
	public function handleErrorGuardarCosto(){
		
		$this->reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->tipo = $this->getRequestParameter("tipo");		
		return sfView::SUCCESS;
	}
	/*
	* Inserta un nuevo costo 
	* @author: Andres Botero
	*/
	public function executeGuardarCosto(){
			
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);				
		
		$this->tipo = $this->getRequestParameter("tipo");	
			
		$user_id = $this->getUser()->getUserId();
				
		$oid = $this->getRequestParameter("oid");				
		if( $oid ){
			$costo = RepCostoPeer::retrieveByPk( $oid );
			$this->forward404Unless( $costo );
		}else{
			$costo = new RepCosto();
			$costo->setCaIdReporte( $reporteNegocio->getCaIdreporte() );
			
			$costo->setCaFchcreado( date("Y-m-d") );	
			$costo->setCaUsucreado( $user_id );	
		}
		$costoId = $this->getRequestParameter("idcosto");
					
		$c = new Criteria();
		$c->add( RepCostoPeer::CA_IDREPORTE, $reporteNegocio->getCaIdreporte() );
		$c->add( RepCostoPeer::CA_IDCOSTO, $costoId );		
		$count  = RepCostoPeer::doCount( $c );
		
		
		
		if( $count ){	
			$this->getRequest()->setError("idcosto", "El costo ya existe");
		}else{
			$costo->setCaIdcosto( $costoId );	
			$costo->setCaTipo(  $this->getRequestParameter("catipo") );		
			$costo->setCaNetcosto( $this->getRequestParameter("netcosto") );				
			$costo->setCaVlrcosto(  $this->getRequestParameter("vlrcosto") );
			$costo->setCaMincosto(  $this->getRequestParameter("mincosto") );		
			$costo->setCaIdMoneda(  $this->getRequestParameter("id_moneda") );
			$costo->setCaDetalles(  $this->getRequestParameter("observaciones") );		
			$costo->save();	
		}
		$this->reporteNegocio = $reporteNegocio;
		$this->setLayout("ajax");			
	}
	
	/*
	* Guardar los cambios cuando un usuario hace click sobre un costo y modifica un dato
	* author: Andres Botero
	*/
	public function executeObserveCostos(){
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);				
		
		$this->tipo = $this->getRequestParameter("tipo");	
				
		$user_id = $this->getUser()->getUserId();
				
		$oid = $this->getRequestParameter("oid");				
		if( $oid ){
			$costo = RepCostoPeer::retrieveByPk( $oid );
			$this->forward404Unless( $costo );
									
			if( $this->getRequestParameter("catipo") ){	
				$costo->setCaTipo(  $this->getRequestParameter("catipo") );		
			}
			
			if( $this->getRequestParameter("netcosto")!==null ){
				$costo->setCaNetcosto( $this->getRequestParameter("netcosto") );				
			}
			
			if( $this->getRequestParameter("vlrcosto")!==null ){
				$costo->setCaVlrcosto(  $this->getRequestParameter("vlrcosto") );
			}
			
			if( $this->getRequestParameter("mincosto")!==null ){
				$costo->setCaMincosto(  $this->getRequestParameter("mincosto") );		
			}
			
			if( $this->getRequestParameter("id_moneda") ){
				$costo->setCaIdMoneda(  $this->getRequestParameter("id_moneda") );
			}
			
			if(  $this->getRequestParameter("observaciones")!==null ){
				$costo->setCaDetalles(  $this->getRequestParameter("observaciones") );		
			}
			$costo->setCaFchactualizado( date("Y-m-d H:i:s") );	
			$costo->setCaUsuactualizado( $user_id );	
			$costo->save();	
		}
		$this->reporteNegocio = $reporteNegocio;
		$this->setLayout("ajax");	
		
		return sfView::NONE;		
	}
	
	/*
	* Elimina un recargo
	* author: Andres Botero
	*/
	public function executeEliminarCosto(){
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);		
		
		$oid = $this->getRequestParameter("oid");		
		$costo = RepCostoPeer::retrieveByPk( $oid );
		$this->forward404Unless( $costo );
		$costo->delete();		

					
		$this->reporteNegocio = $reporteNegocio;		
		$this->opcion = $this->getRequestParameter("opcion");		
		$this->tipo = $this->getRequestParameter("tipo");		
		$this->setLayout("ajax");	
		$this->setTemplate("guardarCosto");		
	}
	
	/******************************************************************
	*  Manejo de conceptos
	*******************************************************************/
	
	/*
	* Envia al formulario en caso de que ocurra un error
	* @author: Andres Botero
	*/
	public function handleErrorGuardarConcepto(){
		
		$this->reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		return sfView::SUCCESS;
	}
	
	/*
	* Inserta un nuevo concepto 
	* @author: Andres Botero
	*/
	public function executeGuardarConcepto(){	
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);	
		
		$via = $reporteNegocio->getCaTransporte();
		
		$idconcepto = $this->getRequestParameter("idconcepto");
		
		$c = new Criteria();
		$c->add( RepTarifaPeer::CA_IDREPORTE, $reporteNegocio->getCaIdreporte() );
		$c->add( RepTarifaPeer::CA_IDCONCEPTO, $idconcepto );		
		$count = RepTarifaPeer::doCount( $c );
		
		
		if( $count ){	
			$this->getRequest()->setError("idconcepto", "El costo ya existe");
		}else{			
			$concepto = new RepTarifa();
			$concepto->setCaIdConcepto( $idconcepto );
			$concepto->setCaIdReporte( $reporteNegocio->getCaIdreporte() );
			$concepto->setCaCantidad( $this->getRequestParameter("cantidad") );				
			$concepto->setCaNetaTar(  $this->getRequestParameter("neta_tar") );
			$concepto->setCaNetaMin(  $this->getRequestParameter("neta_min") );
			$concepto->setCaNetaIdm(  $this->getRequestParameter("neta_idm") );				
				
			$concepto->setCaReportarTar(  $this->getRequestParameter("reportar_tar") );
			$concepto->setCaReportarMin(  $this->getRequestParameter("reportar_min") );
			$concepto->setCaReportaridm(  $this->getRequestParameter("reportar_idm") );
			$concepto->setCaCobrarTar(  $this->getRequestParameter("cobrar_tar") );
			$concepto->setCaCobrarMin(  $this->getRequestParameter("cobrar_min") );
			$concepto->setCaCobraridm(  $this->getRequestParameter("cobrar_idm") );
			
			$user = $this->getUser();
			$concepto->setCaUsucreado( $user->getUserId() );
			$concepto->setCaFchcreado( date("Y-m-d H:i:s") );
			$concepto->save();		
			
		}
		$this->reporteNegocio = $reporteNegocio;
		$this->setLayout("ajax");	
	}
	
	public function executeObserveConceptos(){
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);	
		
		$via = $reporteNegocio->getCaTransporte();
		
		
		$concepto = RepTarifaPeer::retrieveByPk( $this->getRequestParameter("oid") );
		$this->forward404Unless($concepto);	
		if( $this->getRequestParameter("cantidad") ){
			$concepto->setCaCantidad( $this->getRequestParameter("cantidad") );				
		}
		if( $this->getRequestParameter("neta_tar")!==null ){
			$concepto->setCaNetaTar(  $this->getRequestParameter("neta_tar") );
		}
		if( $this->getRequestParameter("neta_min")!==null ){
			$concepto->setCaNetaMin(  $this->getRequestParameter("neta_min") );
		}

		if( $this->getRequestParameter("neta_idm") ){
			$concepto->setCaNetaIdm(  $this->getRequestParameter("neta_idm") );				
		}
							
		if( $this->getRequestParameter("reportar_tar")!==null ){			
			$concepto->setCaReportarTar(  $this->getRequestParameter("reportar_tar") );
		}
		if( $this->getRequestParameter("reportar_min")!==null ){
			$concepto->setCaReportarMin(  $this->getRequestParameter("reportar_min") );
		}
		if( $this->getRequestParameter("reportar_idm") ){
			$concepto->setCaReportaridm(  $this->getRequestParameter("reportar_idm") );
		}
		if( $this->getRequestParameter("cobrar_tar")!==null ){
			$concepto->setCaCobrarTar(  $this->getRequestParameter("cobrar_tar") );
		}
		if( $this->getRequestParameter("cobrar_min")!==null ){
			$concepto->setCaCobrarMin(  $this->getRequestParameter("cobrar_min") );
		}
		if( $this->getRequestParameter("cobrar_idm") ){ 
			$concepto->setCaCobraridm(  $this->getRequestParameter("cobrar_idm") );
		}
		
		if( $this->getRequestParameter("observaciones")!==null ){
			$concepto->setCaObservaciones(  $this->getRequestParameter("observaciones") );
		}
		
		$user = $this->getUser();
		$concepto->setCaUsuactualizado( $user->getuserId() );
		$concepto->setCaFchactualizado( date("Y-m-d H:i:s") );
		
		$concepto->save();	
		
		return sfView::NONE;	
	}
	
	/*
	* Elimina un concepto
	* author: Andres Botero
	*/
	public function executeEliminarConcepto(){
		$reporteNegocio = Doctrine::getTable("Reporte")->find( $this->getrequestparameter("reporteId") );
		$this->forward404Unless($reporteNegocio);		
		
		$oid = $this->getRequestParameter("oid");
		
		$via = $reporteNegocio->getCaTransporte();		
		
		$concepto = RepTarifaPeer::retrieveByPk( $this->getRequestParameter("oid") );		
		
		$this->forward404Unless($concepto);
		$concepto->delete();		
		
		$this->reporteNegocio = $reporteNegocio;		
		
		$this->setLayout("ajax");	
		$this->setTemplate("guardarConcepto");		
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