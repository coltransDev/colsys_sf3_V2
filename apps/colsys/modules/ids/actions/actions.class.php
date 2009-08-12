<?php
 
/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class idsActions extends sfActions
{

    const RUTINA_AGENTES = "78";
	const RUTINA_TRANPORTADORES = "79";
	const RUTINA_PROV = "80";
    /*
     * Retorna el nivel de acceso de acuerdo al modo
     */
    private function getNivel( ){
        $this->modo = $this->getRequestParameter("modo");
		if( !$this->modo ){
			$this->forward( "ids", "seleccionModo" );
		}

		if( $this->modo=="agentes" ){
			$this->nivel = $this->getUser()->getNivelAcceso( idsActions::RUTINA_AGENTES );			
		}
		
		if( $this->modo=="prov" ){
			$this->nivel = $this->getUser()->getNivelAcceso( idsActions::RUTINA_PROV );
		}

		if( $this->nivel==-1 ){
			$this->forward404();
		}
    }
	/**
	* Muestra la pagina inicial del modulo, le permite al usuario hacer busquedas.
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();


        $c = new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$this->traficos = TraficoPeer::doSelect( $c );

		$c = new Criteria();
		$c->add( CiudadPeer::CA_IDCIUDAD, '999-9999', Criteria::NOT_EQUAL );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_IDTRAFICO );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		$ciudades = CiudadPeer::doSelect( $c );

		$result = array();
		foreach( $ciudades as $ciudad ){
			$result[ $ciudad->getCaidtrafico() ][] = array("idciudad"=>$ciudad->getCaIdciudad(),
															"ciudad"=>utf8_encode($ciudad->getCaCiudad())
													 );
		}

		$this->ciudades = json_encode($result);
	}

    /**
	 * Permite seleccionar el modo de operacion del programa
	 * @author: Andres Botero
	 */
	public function executeSeleccionModo()
	{
		$this->nivelAgentes = $this->getUser()->getNivelAcceso( idsActions::RUTINA_AGENTES );		
		$this->nivelProveedores = $this->getUser()->getNivelAcceso( idsActions::RUTINA_PROV );
	}

    /**
	* Permite realizar busquedas en la tabla de proveedores
	*
	* @param sfRequest $request A request object
	*/
	public function executeBusqueda(sfWebRequest $request)
	{
        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();
        $criterio = $request->getParameter("criterio");
        $cadena = $request->getParameter("cadena");

        $c = new Criteria();

		switch( $criterio ){
			case "nombre":
				$c->add( IdsPeer::CA_NOMBRE, "%". strtoupper($cadena)."%", Criteria::LIKE );
				break;
            case "id":
				$c->add( IdsPeer::CA_ID, $cadena );
				break;
            case "ciudad":
                $idtrafico = $request->getParameter("idtrafico");
                $idciudad = $request->getParameter("idciudad");
                
				$c->addJoin( IdsPeer::CA_ID, IdsSucursalPeer::CA_ID );
                $c->addJoin( IdsSucursalPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );
                if( $idtrafico ){
                    $c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
                }
                if( $idciudad ){
                    $c->add( CiudadPeer::CA_IDCIUDAD, $idciudad );
                }
				break;
		}


		switch( $this->modo ){
            case "agentes":
                $c->addJoin( IdsPeer::CA_ID, IdsAgentePeer::CA_IDAGENTE );
                break;
            case "prov":
                $c->addJoin( IdsPeer::CA_ID, IdsProveedorPeer::CA_IDPROVEEDOR );
                break;
        }
		$c->addAscendingOrderByColumn( IdsPeer::CA_NOMBRE );
		$c->setLimit( 200 );

		$this->pager = new sfPropelPager('Ids', 30);
		$this->pager->setCriteria($c);
		$this->pager->setPage($this->getRequestParameter('page', 1));
		$this->pager->init();


		if( count($this->pager->getResults())==1 && count($this->pager->getLinks())==1  ){
			$ids = $this->pager->getResults();
			$this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids[0]->getCaId());
		}
		$this->criterio = $criterio;
		$this->cadena = $cadena;
	}


    /**
	* Muestra el formulario de creación y edicion de proveedores
	*
	* @param sfRequest $request A request object
	*/
	public function executeVerIds(sfWebRequest $request)
	{
        $this->nivel = $this->getNivel();
        $this->modo = $request->getParameter("modo");
        $this->forward404Unless($request->getParameter("id"));
        $this->ids = IdsPeer::retrieveByPK($request->getParameter("id"));
        $this->forward404Unless($this->ids);

       

        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("tabpane/tabpane",'last');
        $response->addStylesheet("tabpane/luna/tab",'last');
    }

    /**
	* Muestra el formulario de creación y edicion de proveedores
	*
	* @param sfRequest $request A request object
	*/
	public function executeFormIds(sfWebRequest $request)
	{
        $this->nivel = $this->getNivel();
        $this->modo = $request->getParameter("modo");
        $this->form = new NuevoIdsForm();

        $formSucursal = new NuevaSucursalForm();
        $this->form->mergeForm($formSucursal);

        if( $this->modo=="prov" ){
            $this->formProveedor = new NuevoProveedorForm();
            $this->form->mergeForm($this->formProveedor);
        }

        if( $this->modo=="agentes" ){
            $this->formAgente = new NuevoAgenteForm();
            $this->form->mergeForm($this->formAgente);
        }

        $ids = null;

        if( $request->getParameter("id") ){
            $ids = IdsPeer::retrieveByPK($request->getParameter("id"));
        }

        if( !$ids ){
            $ids = new Ids();
        }
        
        if ($request->isMethod('post')){		
		
			$bindValues = array();

            $bindValues["tipo_identificacion"] = $request->getParameter("tipo_identificacion");
            $bindValues["id"] = $request->getParameter("id");
            $bindValues["dv"] = $request->getParameter("dv");
            $bindValues["nombre"] = strtoupper($request->getParameter("nombre"));
            $bindValues["website"] = $request->getParameter("website");
            $bindValues["idgrupo"] = $request->getParameter("idgrupo");
            
            $bindValues["direccion"] = $request->getParameter("direccion");
            $bindValues["telefonos"] = $request->getParameter("telefonos");
            $bindValues["fax"] = $request->getParameter("fax");
            $bindValues["idciudad"] = $request->getParameter("idciudad");

            if( $this->modo=="prov" ){
                $bindValues["tipo_proveedor"] = $request->getParameter("tipo_proveedor");
                $bindValues["controladoporsig"] = $request->getParameter("controladoporsig");
                $bindValues["critico"] = $request->getParameter("critico");
                $bindValues["aprobado"] = $request->getParameter("aprobado");
            }
            
            if( $this->modo=="agentes" ){
                $bindValues["tipo"] = $request->getParameter("tipo");
                $bindValues["activo"] = $request->getParameter("activo");
            }

            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                
                $ids->setCaTipoidentificacion( $bindValues["tipo_identificacion"]);

                if( $bindValues["id"] ){
                    $ids->setCaId( $bindValues["id"]);
                }else{
                    $ids->setId();
                }

                if( $bindValues["dv"] ){
                    $ids->setCaDv( $bindValues["dv"]);
                }
                
                $ids->setCaNombre($bindValues["nombre"]);
                $ids->setCaWebsite($bindValues["website"]);
                                              
                $ids->save();

                if( $bindValues["idgrupo"] ){
                    $ids->setCaIdgrupo( $bindValues["idgrupo"]);
                }else{
                    $ids->setCaIdgrupo( $ids->getCaId() );
                }
                $ids->save();


                // Guarda el proveedor
                if( isset($this->formProveedor) ){
                    $proveedor = $ids->getIdsProveedor();
                    if( !$proveedor ){
                        $proveedor = new IdsProveedor();
                        $proveedor->setCaIdproveedor($ids->getCaId());
                    }

                    $proveedor->setCaTipo( $bindValues["tipo_proveedor"] );
                    if( $bindValues["controladoporsig"] ){
                        $proveedor->setCaControladoporsig( true );
                    }else{
                        $proveedor->setCaControladoporsig( false );                        
                    }

                    if( $bindValues["critico"] ){
                        $proveedor->setCaCritico( true );
                    }else{
                        $proveedor->setCaCritico( false );
                    }

                    if( $bindValues["aprobado"] ){
                        if( !$proveedor->getCaFchaprobado() ){
                            $proveedor->setCaFchaprobado( time() );
                            $proveedor->setCaUsuaprobado( $this->getUser()->getUserId() );
                        }
                    }else{
                        $proveedor->setCaFchaprobado( null );
                        $proveedor->setCaUsuaprobado( null );

                    }

                    $proveedor->save();
                }


                if( isset($this->formAgente) ){
                    $agente = $ids->getIdsAgente();
                    if( !$agente ){
                        $agente = new IdsAgente();
                        $agente->setCaIdagente($ids->getCaId());
                    }

                    $agente->setCaTipo( $bindValues["tipo"] );
                    if( $bindValues["activo"]!==null ){
                        $agente->setCaActivo();
                    }
                    
                    $agente->save();
                }
                
                // Guardar Sucursal
                $sucursal = $ids->getSucursalPrincipal();
                if( !$sucursal ){
                    $sucursal = new IdsSucursal();
                    $sucursal->setCaPrincipal( true );
                }
                
                $sucursal->setCaId( $ids->getCaId());
                $sucursal->setCaDireccion( $request->getParameter("direccion"));
                $sucursal->setCaTelefonos( $request->getParameter("telefonos"));
                $sucursal->setCaIdciudad( $request->getParameter("idciudad"));
                $sucursal->setCaFax( $request->getParameter("fax"));
                
                $sucursal->save();
                
                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids->getCaId() );

            }
        }

        $this->ids = $ids;
	}

    /**
	* Muestra el formulario de creación y edicion de contactos
	*
	* @param sfRequest $request A request object
	*/

    public function executeFormContactosIds(sfWebRequest $request){
        $this->nivel = $this->getNivel();
        /*
		if( $this->nivel<=0 ){
			$this->forward404();
		}*/
        $this->modo = $request->getParameter("modo");
		
		$this->contacto = IdsContactoPeer::retrieveByPk( $request->getParameter("idcontacto") );

        if( $this->contacto ){
            $this->sucursal = $this->contacto->getIdsSucursal();
        }else{
            $this->sucursal = IdsSucursalPeer::retrieveByPk( $request->getParameter("idsucursal") );
        }
		$this->forward404Unless( $this->sucursal );

		$this->form = new NuevoContactoForm();

		if ($request->isMethod('post')){
			$bindValues = array();

			$bindValues["idcontacto"] = $request->getParameter("idcontacto");
			$bindValues["idsucursal"] = $request->getParameter("idsucursal");
			$bindValues["nombre"] = trim($request->getParameter("nombre"));
			$bindValues["apellido"] = trim($request->getParameter("apellido"));
			//$bindValues["direccion"] = $request->getParameter("direccion");
			//$bindValues["idciudad"] = $request->getParameter("idciudad");
			$bindValues["telefonos"] = $request->getParameter("telefonos");
			$bindValues["fax"] = $request->getParameter("fax");
			$bindValues["email"] = trim($request->getParameter("email"));
			$bindValues["cargo"] = $request->getParameter("cargo");
			$bindValues["sugerido"] = $request->getParameter("sugerido");
			$bindValues["activo"] = $request->getParameter("activo");
			$bindValues["detalles"] = $request->getParameter("detalles");

			$bindValues["impoexpo"] =  $request->getParameter("impoexpo");
			$bindValues["transporte"] = $request->getParameter("transporte");
			$this->form->bind( $bindValues );
			if( $this->form->isValid() ){
				if( $bindValues["idcontacto"] ){
					$contacto = IdsContactoPeer::retrieveByPk( $bindValues["idcontacto"] );					
				}else{					
					$contacto = new IdsContacto();
					$contacto->setCaIdsucursal( $this->sucursal->getCaIdsucursal() );					
				}

				$contacto->setCaNombres( ucfirst( trim($bindValues["nombre"]) ));
				$contacto->setCaPapellido( ucfirst( trim($bindValues["apellido"]) ));
				//$contacto->setCaDireccion( trim($bindValues["direccion"]) );
				//$contacto->setCaIdciudad( $bindValues["idciudad"] );
				$contacto->setCaTelefonos( $bindValues["telefonos"] );
				$contacto->setCaFax( $bindValues["fax"] );
				$contacto->setCaEmail( $bindValues["email"] );
				$contacto->setCaImpoexpo( implode("|",$bindValues["impoexpo"]) );
				$contacto->setCaTransporte( implode("|",$bindValues["transporte"]) );
				$contacto->setCaCargo( $bindValues["cargo"] );
				$contacto->setCaObservaciones( $bindValues["detalles"] );
				if( $bindValues["sugerido"] ){
					$contacto->setCaSugerido( true );
				}else{
					$contacto->setCaSugerido( false );
				}

				if( $bindValues["activo"] ){
					$contacto->setCaActivo( true );
				}else{
					$contacto->setCaActivo( false );
				}
				$contacto->save();

				$this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->sucursal->getCaId() );


			}
		}
    }

    /**
	* Elimina un contacto de una sucursal
	*
	* @param sfRequest $request A request object
	*/
    public function executeEliminarContactoIds(sfWebRequest $request){
        $this->nivel = $this->getNivel();

		/*if( $this->nivel<=0 ){
			$this->forward404();
		}*/

        $this->modo = $request->getParameter("modo");

        $contacto = IdsContactoPeer::retrieveByPk( $request->getParameter("idcontacto") );
        $this->forward404Unless( $contacto );
        $this->sucursal = $contacto->getIdsSucursal();
        $contacto->delete();
        $this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->sucursal->getCaId() );

    }

    /**
	* Muestra el formulario de creación y edicion de sucursales
	*
	* @param sfRequest $request A request object
	*/
    public function executeFormSucursalIds(sfWebRequest $request){
        $this->nivel = $this->getNivel();
        /*
		if( $this->nivel<=0 ){
			$this->forward404();
		}*/
        $this->modo = $request->getParameter("modo");
        if( $request->getParameter("idsucursal") ){
            $sucursal = IdsSucursalPeer::retrieveByPk( $request->getParameter("idsucursal") );
            $ids = $sucursal->getIds();
        }else{
            $ids = IdsPeer::retrieveByPk( $request->getParameter("id") );
            $sucursal=null;
        }

        
		$this->forward404Unless( $ids );

		$this->form = new NuevaSucursalForm();

		if ($request->isMethod('post')){
			$bindValues = array();
            
			$bindValues["direccion"] = $request->getParameter("direccion");
			$bindValues["idciudad"] = $request->getParameter("idciudad");
			$bindValues["telefonos"] = $request->getParameter("telefonos");
			$bindValues["fax"] = $request->getParameter("fax");
			
           			
			$this->form->bind( $bindValues );
			if( $this->form->isValid() ){


                if( !$sucursal ){
                    $sucursal = new IdsSucursal();
                    $sucursal->setCaPrincipal( false );
                }

                $sucursal->setCaId( $ids->getCaId());
                $sucursal->setCaDireccion( $request->getParameter("direccion"));
                $sucursal->setCaTelefonos( $request->getParameter("telefonos"));
                $sucursal->setCaIdciudad( $request->getParameter("idciudad"));
                $sucursal->setCaFax( $request->getParameter("fax"));

                $sucursal->save();

                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids->getCaId() );
			}
		}
        $this->sucursal = $sucursal;
        $this->ids = $ids;

    }


    /*
     * Manejo de documentos
     *
     * @param sfRequest $request A request object
     */
    public function executeFormDocumentos(sfWebRequest $request){
         $this->nivel = $this->getNivel();
        /*
		if( $this->nivel<=0 ){
			$this->forward404();
		}*/
        $this->modo = $request->getParameter("modo");

        $documento = IdsDocumentoPeer::retrieveByPk( $request->getParameter("iddocumento") );

        if( $documento ){
            $ids = $documento->getIds();
        }else{
            $ids = IdsPeer::retrieveByPk( $request->getParameter("id") );
        }              
		$this->forward404Unless( $ids );

		$this->form = new NuevoDocumentoForm();
        
		if ($request->isMethod('post')){
			$bindValues = array();

			$bindValues["id"] = $request->getParameter("id");
			$bindValues["idtipo"] = $request->getParameter("idtipo");
			$bindValues["inicio"] = $request->getParameter("inicio");
			$bindValues["vencimiento"] = $request->getParameter("vencimiento");

            $bindFiles["archivo"] = $_FILES["archivo"];

			$this->form->bind( $bindValues, $bindFiles );
            
			if( $this->form->isValid() ){
                

                if( !$documento ){
                    $documento = new IdsDocumento();
                    $documento->setCaId( $ids->getCaId() );
                }

                $documento->setCaIdtipo( $request->getParameter("idtipo"));

                if( $request->getParameter("inicio") ){
                    $documento->setCaFchinicio( $request->getParameter("inicio"));
                }

                if( $request->getParameter("vencimiento") ){
                    $documento->setCaFchvencimiento( $request->getParameter("vencimiento"));
                }
                $documento->save();

                if( $bindFiles["archivo"] ){
                    $directorio = $documento->getDirectorio();
                    
                    if( !is_dir($directorio) ){
                        mkdir($directorio, 0777, true);
                    }
                    print_r( $bindFiles["archivo"] );
                    move_uploaded_file( $bindFiles["archivo"]["tmp_name"], $directorio.DIRECTORY_SEPARATOR. $bindFiles["archivo"]["name"]);
                    $documento->setCaUbicacion( $bindFiles["archivo"]["name"] );
                    $documento->save();                   
                }                
                

                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids->getCaId() );
			}
		}
        $this->documento = $documento;
        $this->ids = $ids;
    }

    /*
    * Visualiza documentos
    *
    * @param sfRequest $request A request object
    */
    public function executeVerDocumento(sfWebRequest $request){
        $documento = IdsDocumentoPeer::retrieveByPk( $request->getParameter("iddocumento") );
		$this->forward404Unless( $documento);
        $this->file = $documento->getArchivo();
    }


    /*
    * Visualiza documentos
    *
    * @param sfRequest $request A request object
    */
    public function executeFormEvaluacion(sfWebRequest $request){
        $this->nivel = $this->getNivel();

        $this->ids = IdsPeer::retrieveByPk( $request->getParameter("id") );
        $this->modo = $request->getParameter("modo");

        $this->tipo = $request->getParameter("tipo");

		$this->forward404Unless( $this->ids );
        
        $this->proveedor = IdsProveedorPeer::retrieveByPk( $request->getParameter("id") );

        $c = new Criteria();
        $c->add(IdsCriterioPeer::CA_TIPOCRITERIO, $this->tipo );
        if( $this->proveedor ){
            $c->add(IdsCriterioPeer::CA_TIPO, $this->proveedor->getCaTipo() );
        }
        $this->criterios = IdsCriterioPeer::doSelect( $c );

        $this->form = new NuevaEvaluacionForm();
        $this->form->setCriterios( $this->criterios );
        $this->form->configure();
        
        if ($request->isMethod('post')){


            $bindValues = array();

			$bindValues["fchevaluacion"] = $request->getParameter("fchevaluacion");
			$bindValues["concepto"] = $request->getParameter("concepto");
			$bindValues["tipo"] = $request->getParameter("tipo");
            foreach( $this->criterios as $criterio ){
                $bindValues["ponderacion_".$criterio->getCaidcriterio() ] = $request->getParameter("ponderacion_".$criterio->getCaidcriterio());
                $bindValues["calificacion_".$criterio->getCaidcriterio() ] = $request->getParameter("calificacion_".$criterio->getCaidcriterio());
                $bindValues["observaciones_".$criterio->getCaidcriterio() ] = $request->getParameter("observaciones_".$criterio->getCaidcriterio());
            }
            
			$this->form->bind( $bindValues);
			if( $this->form->isValid() ){              
                $evaluacion = new IdsEvaluacion();
                $evaluacion->setCaId( $this->ids->getCaId() );
                $evaluacion->setCaFchevaluacion( Utils::parseDate( $request->getParameter('fchevaluacion' )) );
                $evaluacion->setCaConcepto( $request->getParameter('concepto') );
                $evaluacion->setCaTipo( $request->getParameter('tipo') );
                $evaluacion->save();

                $criterios = $request->getParameter("idcriterio");

                foreach( $criterios as $idcriterio ){
                    $evaluacionxcriterio = new IdsEvaluacionxCriterio();
                    $evaluacionxcriterio->setCaIdCriterio( $idcriterio );                    
                    $evaluacionxcriterio->setCaPonderacion( trim($request->getParameter("ponderacion_".$idcriterio)) );                    
                    $evaluacionxcriterio->setCaValor( trim($request->getParameter("calificacion_".$idcriterio)) );
                    $evaluacionxcriterio->setCaIdEvaluacion(  $evaluacion->getCaIdevaluacion() );
                    if( $request->getParameter("observaciones_".$idcriterio) ){
                        $evaluacionxcriterio->setCaObservaciones( $request->getParameter("observaciones_".$idcriterio) );
                    }
                    $evaluacionxcriterio->save();
                }

                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->ids->getCaId() );
                
            }
        }

    }


    /*
    * Muestra una evaluacion
    *
    * @param sfRequest $request A request object
    */
    public function executeVerEvaluacion(sfWebRequest $request){
        $this->evaluacion = IdsEvaluacionPeer::retrieveByPK( $request->getParameter("idevaluacion"));
        $this->forward404Unless( $this->evaluacion );

        $this->ids = $this->evaluacion->getIds();
        $this->modo=$request->getParameter("modo");

    }

    

    /*
    * Permite registrar eventos por referencia
    *
    * @param sfRequest $request A request object
    */
    public function executeFormEventos(sfWebRequest $request){
        //Se debe verificar que la referencia exista y determinar el proveedor.

        $this->modo=$request->getParameter("modo");
        $this->form = new NuevoEventoForm();

        if( $this->modo ){ //Esta ingresando desde la maestra de proveedores
            $this->ids = IdsPeer::retrieveByPk( $request->getParameter("id") );
            $this->url = "/ids/verIds?modo=".$this->modo."&id=".$request->getParameter("id");
            $numreferencia = "";
        }else{ // Esta ingresando desde la referencia
            $numreferencia = str_replace("_",".",$request->getParameter("referencia"));
            $this->forward404Unless(  $numreferencia );

            $idproveedores = array();

            if( substr($numreferencia,0,1)=="4" || substr($numreferencia,0,1)=="5" ){
                $referencia = InoMaestraSeaPeer::retrieveByPk( $numreferencia );
                $linea = $referencia->getCaidlinea();

                $idproveedores[] = $linea;

                $this->url = "/colsys_php/inosea.php?boton=Consultar&id=".$numreferencia;
            }

            if( substr($numreferencia,0,1)=="1"  ){
                $referencia = InoMaestraAirPeer::retrieveByPk( $numreferencia );
                $linea = $referencia->getCaidlinea();

                $idproveedores[] = $linea;

                $this->url = "/Coltrans/InoAir/ConsultaReferenciaAction.do?referencia=".$numreferencia;
            }
            $this->form->setIdproveedores($idproveedores);

            $this->numreferencia = $numreferencia;
        }

        $this->form->configure();
        

        if ($request->isMethod('post')){

			$bindValues = array();
            $bindValues["id"] = $request->getParameter("id");
            $bindValues["tipo_evento"] = $request->getParameter("tipo_evento");
            $bindValues["evento"] = $request->getParameter("evento");           
            
            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                $evento = new IdsEvento();
                $evento->setCaId( $bindValues["id"] );
                $evento->setCaEvento( $bindValues["evento"] );
                if( $numreferencia ){
                    $evento->setCaReferencia( $numreferencia );
                }
                $evento->setCaTipo( $bindValues["tipo_evento"] );
                $evento->save();
                
                $this->redirect($this->url);

                
            }

        }

    }


     /*
    * Permite agregar lineas de transporte
    *
    * @param sfRequest $request A request object
    */
    public function executeFormTransportista(sfWebRequest $request){
        $this->nivel = $this->getNivel();

        $this->ids = IdsPeer::retrieveByPk( $request->getParameter("id") );
       
        $transportista = TransportadorPeer::retrieveByPk( $request->getParameter("idlinea") );
        
        if( $transportista ){
            $proveedor = $transportista->getIdsProveedor();
            $this->forward404Unless($proveedor->getCaTipo()=="TRI");
            $this->ids = $proveedor->getIds();
        }else{
            $this->ids = IdsPeer::retrieveByPk( $request->getParameter("id") );

            $transportista = new Transportador();
            $transportista->setCaIdtransportista( $this->ids->getCaId() );
        }
        $this->forward404Unless( $this->ids );

        $this->modo = $request->getParameter("modo");

		

        $this->form = new NuevoTransportistaForm();

        if ($request->isMethod('post')){
            $bindValues = array();
            $bindValues["nombre"] = $request->getParameter("nombre");
            $bindValues["sigla"] = $request->getParameter("sigla");
            $bindValues["transporte"] = $request->getParameter("transporte");

            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                $transportista->setCaNombre( $bindValues["nombre"] );
                $transportista->setCaSigla( $bindValues["sigla"] );
                $transportista->setCaTransporte( $bindValues["transporte"] );
                $transportista->save();

                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->ids->getCaId() );
            }
        }

        $this->transportista  = $transportista;
    }

     /*
    * Permite agregar lineas de transporte
    *
    * @param sfRequest $request A request object
    */
    public function executeListadoProveedoresAprobados(sfWebRequest $request){
        $c = new Criteria();
        $c->addJoin( IdsProveedorPeer::CA_IDPROVEEDOR, IdsPeer::CA_ID );
        $c->addAscendingOrderByColumn(IdsPeer::CA_NOMBRE );
        $c->add( IdsProveedorPeer::CA_FCHAPROBADO, null, Criteria::ISNOTNULL );
        $c->add( IdsProveedorPeer::CA_CONTROLADOPORSIG, true );
        $this->proveedores = IdsProveedorPeer::doSelect( $c );
    }

}
?>