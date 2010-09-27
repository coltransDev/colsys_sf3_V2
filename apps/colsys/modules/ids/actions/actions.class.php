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

    const RUTINA_AGENTES = "8";
	const RUTINA_PROV = "81";
    /*
     * Retorna el nivel de acceso de acuerdo al modo
     */
    public function getNivel( ){
        $this->modo = $this->getRequestParameter("modo");
        
        $this->nivel = -1;
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
        return $this->nivel;
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

        $this->traficos = Doctrine::getTable('Trafico')->createQuery('t')
                            ->where('t.ca_idtrafico != ?', '99-999')
                            ->addOrderBy('t.ca_nombre ASC')
                            ->execute();

        $ciudades = Doctrine::getTable('Ciudad')->createQuery('c')
                            ->where('c.ca_idciudad != ?', '999-9999')
                            ->addOrderBy('c.ca_idtrafico ASC')
                            ->addOrderBy('c.ca_ciudad ASC')
                            ->execute();
       
		$result = array();
		foreach( $ciudades as $ciudad ){
			$result[ $ciudad->getCaIdtrafico() ][] = array("idciudad"=>$ciudad->getCaIdciudad(),
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
        
        $q = Doctrine_Query::create()->from('Ids i');

        switch( $this->modo ){
            case "agentes":
                $q->innerJoin( "i.IdsAgente ag" );
                break;
            case "prov":
                 $q->innerJoin( "i.IdsProveedor prov" );
                break;
        }

        switch( $criterio ){
			case "nombre":
                $q->where('i.ca_nombre like ?', '%'.strtoupper($cadena).'%');				
				break;
            case "id":				
                $q->where('i.ca_idalterno like ?', strtoupper($cadena).'%');
				break;
            case "ciudad":
                $idtrafico = $request->getParameter("idtrafico");
                $idciudad = $request->getParameter("idciudad");
                $q->innerJoin("i.IdsSucursal s");
                $q->innerJoin("s.Ciudad c");
                $q->innerJoin("c.Trafico t");
				
                if( $idtrafico ){                    
                    $q->where('t.ca_idtrafico = ?', $idtrafico);
                }
                if( $idciudad ){                    
                    $q->where('c.ca_idciudad = ?', $idciudad);
                }
				break;
		}

        $q->addOrderBy("i.ca_nombre");
        $q->limit(200);

        // Defining initial variables
        $currentPage = $this->getRequestParameter('page', 1);
        $resultsPerPage = 30;

        // Creating pager object
        $this->pager = new Doctrine_Pager(
              $q,
              $currentPage, 
              $resultsPerPage
        );

        $this->idsList = $this->pager->execute();
		if( $this->pager->getResultsInPage()==1 && $this->pager->getPage()==1 ){
            $ids = $this->idsList;
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

        $this->ids = Doctrine::getTable('Ids')->find($request->getParameter("id"));
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
            $ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));           
        }

        if( !$ids ){
            $ids = new Ids();
        }
        
        if ($request->isMethod('post')){		
		
			$bindValues = array();

            $bindValues["tipo_identificacion"] = $request->getParameter("tipo_identificacion");
            $bindValues["id"] = $request->getParameter("id");
            $bindValues["idalterno"] = $request->getParameter("idalterno");
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
                $bindValues["esporadico"] = $request->getParameter("esporadico");
                $bindValues["aprobado"] = $request->getParameter("aprobado");
                $bindValues["activo_impo"] = $request->getParameter("activo_impo");
                $bindValues["activo_expo"] = $request->getParameter("activo_expo");
                $bindValues["empresa"] = $request->getParameter("empresa");

               
                if( $bindValues["tipo_proveedor"]=="TRI" || $bindValues["tipo_proveedor"]=="TRN" ){
                    $bindValues["sigla"] = $request->getParameter("sigla");
                    $bindValues["transporte"] = $request->getParameter("transporte");
                }

            }
            
            if( $this->modo=="agentes" ){
                $bindValues["tipo"] = $request->getParameter("tipo");
                $bindValues["activo"] = $request->getParameter("activo");
            }

            $this->form->bind( $bindValues );
            
			if( $this->form->isValid() ){

                if( $bindValues["tipo_identificacion"] ){                    
                    $ids->setCaTipoidentificacion( intval($bindValues["tipo_identificacion"]));
                }

                if( $bindValues["idalterno"] ){
                    $ids->setCaIdalterno( $bindValues["idalterno"]);
                }
                

                if( $bindValues["dv"] ){
                    $ids->setCaDv( intval($bindValues["dv"]));
                }
                
                $ids->setCaNombre($bindValues["nombre"]);
                $ids->setCaWebsite($bindValues["website"]);
                                              
                $ids->save();

                //exit( $ids->getCaId() );
                if( $bindValues["idgrupo"] ){
                    $ids->setCaIdgrupo( intval($bindValues["idgrupo"]));
                }else{
                    $ids->setCaIdgrupo( intval($ids->getCaId()) );
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

                    if( $bindValues["activo_impo"] ){
                        $proveedor->setCaActivoImpo( true );
                    }else{
                        $proveedor->setCaActivoImpo( false );
                    }

                    if( $bindValues["activo_expo"] ){
                        $proveedor->setCaActivoExpo( true );
                    }else{
                        $proveedor->setCaActivoExpo( false );
                    }
                    
                   

                    if( $bindValues["empresa"] ){
                        $proveedor->setCaEmpresa($bindValues["empresa"]);
                    }else{
                        $proveedor->setCaEmpresa(null);
                    }
                    
                    if( $bindValues["tipo_proveedor"]=="TRI" || $bindValues["tipo_proveedor"]=="TRN" ){
                        $proveedor->setCaSigla($bindValues["sigla"] );
                        if( $bindValues["transporte"] ){
                            $proveedor->setCaTransporte( $bindValues["transporte"] );
                        }else{
                            $proveedor->setCaTransporte( null );
                        }
                    }                   
                    
                    if( $this->nivel>=5 ){
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

                         if( $bindValues["esporadico"] ){
                            $proveedor->setCaEsporadico( true );
                        }else{
                            $proveedor->setCaEsporadico( false );
                        }

                        if( $bindValues["aprobado"] ){
                            
                            $proveedor->setCaFchaprobado( $bindValues["aprobado"] );
                            $proveedor->setCaUsuaprobado( $this->getUser()->getUserId() );
                            
                        }else{
                            $proveedor->setCaFchaprobado( null );
                            $proveedor->setCaUsuaprobado( null );

                        }
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
                   
                    if( $bindValues["activo"] ){
                        $agente->setCaActivo( true );
                    }else{
                        $agente->setCaActivo( false );
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
	* Comprueba si existe un ID en la BD
	*
	* @param sfRequest $request A request object
	*/

    public function executeComprobarId(sfWebRequest $request){
        $idalterno = $request->getParameter("idalterno");
        $tipo_identificacion = $request->getParameter("tipo_identificacion");        
        $id = Doctrine::getTable("Ids")
                  ->createQuery("id")
                  ->where("id.ca_idalterno = ? AND id.ca_tipoidentificacion = ? ", array($idalterno, $tipo_identificacion))
                  ->fetchOne();
        $this->responseArray = array();
        if( $id ){
            $this->responseArray["id"] = $id->getCaId();
        }else{
            $this->responseArray["id"] = false;
        }
        $this->setTemplate("responseTemplate");
    }

    /**
	* Muestra el formulario de creación y edicion de contactos
	*
	* @param sfRequest $request A request object
	*/

    public function executeFormContactosIds(sfWebRequest $request){
        $this->nivel = $this->getNivel();
        
		if( $this->nivel<3 ){
			$this->forward404();
		}
        $this->modo = $request->getParameter("modo");
		
		$this->contacto = Doctrine::getTable("IdsContacto")->find( $request->getParameter("idcontacto") );

        if( $this->contacto ){
            $this->sucursal = $this->contacto->getIdsSucursal();
        }else{
            $this->sucursal = Doctrine::getTable("IdsSucursal")->find( $request->getParameter("idsucursal") );
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
            $bindValues["otro_cargo"] = $request->getParameter("otro_cargo");
			$bindValues["sugerido"] = $request->getParameter("sugerido");
			$bindValues["activo"] = $request->getParameter("activo");
			$bindValues["detalles"] = $request->getParameter("detalles");

			$bindValues["impoexpo"] =  $request->getParameter("impoexpo");
			$bindValues["transporte"] = $request->getParameter("transporte");
            $bindValues["visibilidad"] = $request->getParameter("visibilidad");
            $bindValues["codigoarea"] = $request->getParameter("codigoarea");
			$this->form->bind( $bindValues );
			if( $this->form->isValid() ){
				if( $bindValues["idcontacto"] ){
                    $contacto = Doctrine::getTable("IdsContacto")->find($bindValues["idcontacto"]);
				}else{					
					$contacto = new IdsContacto();
					$contacto->setCaIdsucursal( $this->sucursal->getCaIdsucursal() );					
				}

				$contacto->setCaNombres( ucwords(strtolower( trim($bindValues["nombre"]))));
				$contacto->setCaPapellido( ucwords(strtolower( trim($bindValues["apellido"]))));
				//$contacto->setCaDireccion( trim($bindValues["direccion"]) );
				//$contacto->setCaIdciudad( $bindValues["idciudad"] );
				$contacto->setCaTelefonos( $bindValues["telefonos"] );
				$contacto->setCaFax( $bindValues["fax"] );
				$contacto->setCaEmail( $bindValues["email"] );
				$contacto->setCaImpoexpo( implode("|",$bindValues["impoexpo"]) );
				$contacto->setCaTransporte( implode("|",$bindValues["transporte"]) );
                if( $bindValues["cargo"] ){
                    $contacto->setCaCargo( $bindValues["cargo"] );
                }else{
                    $contacto->setCaCargo( $bindValues["otro_cargo"] );
                }
                if( $bindValues["codigoarea"] && $this->sucursal->getCiudad()->getCodigoarea() ){
                    $contacto->setCaCodigoarea( $bindValues["codigoarea"] );
                }else{
                    $contacto->setCaCodigoarea( null );
                }
				$contacto->setCaObservaciones( $bindValues["detalles"] );
                $contacto->setCaVisibilidad( intval($bindValues["visibilidad"]) );
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

        $contacto = Doctrine::getTable("IdsContacto")->find($request->getParameter("idcontacto"));
        $this->forward404Unless( $contacto );
        $this->sucursal = $contacto->getIdsSucursal();
        $contacto->setCaFcheliminado(date("Y-m-d H:i:s"));        
        $contacto->setCaUsueliminado($this->getUser()->getUserId());
        $contacto->save();
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
            $sucursal = Doctrine::getTable("IdsSucursal")->find($request->getParameter("idsucursal"));
            $ids = $sucursal->getIds();
        }else{
            $ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
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
        
		if( $this->nivel<=0 ){
			$this->forward404();
		}
        $this->modo = $request->getParameter("modo");

        $documento = Doctrine::getTable("IdsDocumento")->find( $request->getParameter("iddocumento") );

        if( $documento ){
            $ids = $documento->getIds();
        }else{
            $ids = Doctrine::getTable("Ids")->find( $request->getParameter("id") );            
        }              
		$this->forward404Unless( $ids );

		$this->form = new NuevoDocumentoForm();
        
		if ($request->isMethod('post')){
			$bindValues = array();

			$bindValues["id"] = $request->getParameter("id");
			$bindValues["idtipo"] = $request->getParameter("idtipo");
            if( $request->getParameter("inicio") ){
                $bindValues["inicio"] = Utils::parseDate($request->getParameter("inicio"));                
            }

            if( $request->getParameter("vencimiento") ){
                $bindValues["vencimiento"] = Utils::parseDate($request->getParameter("vencimiento"));
            }

            $bindFiles["archivo"] = $_FILES["archivo"];

			$this->form->bind( $bindValues, $bindFiles );
            
			if( $this->form->isValid() ){
                

                if( !$documento ){
                    $documento = new IdsDocumento();
                    $documento->setCaId( $ids->getCaId() );
                }

                $documento->setCaIdtipo( $request->getParameter("idtipo"));

                if( $request->getParameter("inicio") ){
                    $documento->setCaFchinicio( Utils::parseDate($request->getParameter("inicio")));
                }

                if( $request->getParameter("vencimiento")!==null ){
                    if( $request->getParameter("vencimiento") ){
                        $documento->setCaFchvencimiento( Utils::parseDate($request->getParameter("vencimiento")));
                    }else{
                         $documento->setCaFchvencimiento( null );
                    }
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
        $documento = Doctrine::getTable("IdsDocumento")->find( $request->getParameter("iddocumento") );
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

        if( $request->getParameter("idevaluacion") ){
            $evaluacion = Doctrine::getTable("IdsEvaluacion")->find( $request->getParameter("idevaluacion") );
            $this->ids = $evaluacion->getIds();
            $this->tipo = $evaluacion->getCaTipo();
            $this->proveedor = $evaluacion->getIds()->getIdsProveedor();
            //Solo permite editar evaluaciones con un privilegio alto
            if( $this->nivel<6 ){
                $this->forward404();
            }
        }else{
            $this->ids = Doctrine::getTable("Ids")->find( $request->getParameter("id") );
            $evaluacion = new IdsEvaluacion();
            $this->tipo = $request->getParameter("tipo");
            $this->proveedor = Doctrine::getTable("IdsProveedor")->find( $request->getParameter("id") );

        }

        if( $this->nivel<=3 &&  $this->tipo=="seleccion" ){
            $this->forward404();
        }
        
        $this->modo = $request->getParameter("modo");
		$this->forward404Unless( $this->ids );
        
        $q = Doctrine::getTable("IdsCriterio")->createQuery("c");
        if( $request->getParameter("idevaluacion") ){
            $q->innerJoin("c.IdsEvaluacionxCriterio ec");
            $q->addWhere("ec.ca_idevaluacion = ?", $request->getParameter("idevaluacion"));
        }else{            
            switch( $this->tipo ){
                case "reevaluacion":
                    $q->where("c.ca_tipocriterio = ?", "desempeno");
                    break;
                case "reevaluacion_impo":
                    $q->where("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                case "reevaluacion_expo":
                    $q->where("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::EXPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                case "desempeno_impo":
                    $q->where("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                case "desempeno_expo":
                    $q->where("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::EXPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                default:
                    $q->where("c.ca_tipocriterio = ?", $this->tipo);
                    break;
            }            

            if( $this->modo=="prov" ){
                $q->addWhere("c.ca_tipo = ? or c.ca_tipo IS NULL", $this->proveedor->getCaTipo());
                if( $this->proveedor->getCaTipo() ){

                }
            }else{
                if( $this->modo=="agentes" ){
                    $q->addWhere("c.ca_tipo = ? or c.ca_tipo IS NULL", "AGE" );
                }
            }
        }
        $q->addWhere("c.ca_activo = ?", true );
        $this->criterios = $q->execute();

        
        $this->form = new NuevaEvaluacionForm();
        $this->form->setCriterios( $this->criterios );
        $this->form->configure();
        
        if ($request->isMethod('post')){

            $bindValues = array();
            
			$bindValues["fchevaluacion"] = $request->getParameter("fchevaluacion");
			$bindValues["concepto"] = $request->getParameter("concepto");
			$bindValues["tipo"] = $request->getParameter("tipo");
            $bindValues["ano"] = $request->getParameter("ano");
            foreach( $this->criterios as $criterio ){
                $bindValues["ponderacion_".$criterio->getCaIdcriterio() ] = $request->getParameter("ponderacion_".$criterio->getCaIdcriterio());
                $bindValues["calificacion_".$criterio->getCaIdcriterio() ] = $request->getParameter("calificacion_".$criterio->getCaIdcriterio());
                $bindValues["observaciones_".$criterio->getCaIdcriterio() ] = $request->getParameter("observaciones_".$criterio->getCaIdcriterio());
            }
            
			$this->form->bind( $bindValues);
			if( $this->form->isValid() ){              
                
                $evaluacion->setCaId( $this->ids->getCaId() );
                $evaluacion->setCaFchevaluacion( Utils::parseDate( $request->getParameter('fchevaluacion' )) );
                $evaluacion->setCaAno( $request->getParameter('ano') );
                $evaluacion->setCaConcepto( $request->getParameter('concepto') );

                $evaluacion->setCaTipo( $request->getParameter('tipo') );
                $evaluacion->save();

                $evaluacionxCriterios = $evaluacion->getIdsEvaluacionxCriterio();
                foreach( $evaluacionxCriterios as $evaluacionxCriterio ){
                    $evaluacionxCriterio->delete();
                }

                $criterios = $request->getParameter("idcriterio");

                foreach( $criterios as $idcriterio ){
                    $evaluacionxcriterio = new IdsEvaluacionxCriterio();
                    $evaluacionxcriterio->setCaIdcriterio( $idcriterio );
                    $evaluacionxcriterio->setCaPonderacion( trim($request->getParameter("ponderacion_".$idcriterio)) );                    
                    $evaluacionxcriterio->setCaValor( trim($request->getParameter("calificacion_".$idcriterio)) );
                    $evaluacionxcriterio->setCaIdevaluacion(  $evaluacion->getCaIdevaluacion() );
                    if( $request->getParameter("observaciones_".$idcriterio) ){
                        $evaluacionxcriterio->setCaObservaciones( $request->getParameter("observaciones_".$idcriterio) );
                    }else{
                        $evaluacionxcriterio->setCaObservaciones( null );
                    }
                    $evaluacionxcriterio->save();
                }

                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->ids->getCaId() );
                
            }
        }

        $this->evaluacion = $evaluacion;

        $this->evaluacionxCriterios = array();
        $evaluacionxCriterios = $evaluacion->getIdsEvaluacionxCriterio();
        foreach( $evaluacionxCriterios as $evaluacionxCriterio ){
            $this->evaluacionxCriterios[$evaluacionxCriterio->getCaIdcriterio()]= $evaluacionxCriterio;
        }

    }


    /*
    * Muestra una evaluacion
    *
    * @param sfRequest $request A request object
    */
    public function executeVerEvaluacion(sfWebRequest $request){
        $this->evaluacion = Doctrine::getTable("IdsEvaluacion")->find($request->getParameter("idevaluacion"));

        $this->forward404Unless( $this->evaluacion );

        $this->ids = $this->evaluacion->getIds();
        $this->modo=$request->getParameter("modo");
        
        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();



    }

    /*
    * Elimina una evaluacion
    *
    * @param sfRequest $request A request object
    */
    public function executeEliminarEvaluacion(sfWebRequest $request){



        $this->modo=$request->getParameter("modo");
        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();

        if( $this->nivel<6 ){
            $this->forward404();
        }


        $evaluacion = Doctrine::getTable("IdsEvaluacion")->find($request->getParameter("idevaluacion"));

        $ids = $evaluacion->getIds();
        $this->forward404Unless( $evaluacion );


        $evaluacionxCriterios = $evaluacion->getIdsEvaluacionxCriterio();
        foreach( $evaluacionxCriterios as $evaluacionxCriterio ){
            $evaluacionxCriterio->delete();
        }

        $evaluacion->delete();

        $this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids->getCaId() );







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

        if( $request->getParameter("idevento") ){
            $evento = Doctrine::getTable("IdsEvento")->find( $request->getParameter("idevento") );
            $this->forward404Unless($evento);
            
        }else{
            $evento = new IdsEvento();
        }

        $q = Doctrine::getTable("IdsCriterio")->createQuery("c")->select("c.*");

        $this->idreporte=$request->getParameter("idreporte");
        if( $this->modo ){ //Esta ingresando desde la maestra de proveedores
            
            if( $request->getParameter("idevento") ){
                $this->ids = $evento->getIds();
                $q->addWhere("c.ca_impoexpo = ?", $evento->getIdsCriterio()->getCaImpoexpo());
            }else{
                $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
                $q->addWhere("c.ca_impoexpo = ?", $request->getParameter("impoexpo"));
            }

            $this->form->setTipo($this->ids->getIdsProveedor()->getCaTipo());
            $this->url = "/ids/verIds?modo=".$this->modo."&id=".$this->ids->getCaId();
            $numreferencia = "";            
            $q->where("c.ca_tipocriterio = ?", "desempeno");
            
            $q->addWhere("c.ca_transporte = ?", $this->ids->getIdsProveedor()->getCaTransporte());
            
            
        }else{
          
            if( $this->idreporte ){ // Esta ingresando desde el reporte
                $this->reporte = Doctrine::getTable("Reporte")->find( $this->idreporte );
                $this->forward404Unless( $this->reporte );
                $this->agente = $this->reporte->getIdsAgente();
                $this->url = "/colsys_php/reportenegocio.php?boton=Consultar&id=".$this->idreporte;

                $numreferencia = $this->reporte->getCaConsecutivo();

                $q->where("c.ca_tipocriterio = ?", "desempeno");
                $q->addWhere("c.ca_tipo = ?", "AGE" );
            }else{// Esta ingresando desde la referencia
                $numreferencia = str_replace("_",".",$request->getParameter("referencia"));
                $this->forward404Unless(  $numreferencia );
                
               

                if( substr($numreferencia,0,1)=="4" || substr($numreferencia,0,1)=="5" ){
                    $referencia = Doctrine::getTable("InoMaestraSea")->find($numreferencia);
                    $linea = $referencia->getCaIdlinea();              

                    $this->url = "/colsys_php/inosea.php?boton=Consultar&id=".$numreferencia;

                    $q->where("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", Constantes::MARITIMO);
                }

                if( substr($numreferencia,0,1)=="1"  ){
                    $referencia = Doctrine::getTable("InoMaestraAir")->find($numreferencia);

                    $linea = $referencia->getCaIdlinea();                    

                    $this->url = "/Coltrans/InoAir/ConsultaReferenciaAction.do?referencia=".$numreferencia;

                    $q->where("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", Constantes::AEREO);
                }
                
                $q->addWhere("c.ca_tipo = ? or c.ca_tipo IS NULL", "TRI");

                $this->form->setIdproveedor($linea);


                $this->numreferencia = $numreferencia;
            }

            $this->eventos = Doctrine::getTable("IdsEvento")
                              ->createQuery("e")
                              ->select("e.*")
                              ->where("e.ca_referencia=?",$numreferencia)
                              ->addOrderBy("e.ca_fchcreado ASC")
                              ->execute();
        }
        $q->addWhere("c.ca_activo = ?", true );
        $criterios = $q->execute();
        $this->form->setCriterios($criterios);
        $this->form->configure();
        

        if ($request->isMethod('post')){

			$bindValues = array();
            $bindValues["id"] = $request->getParameter("id");
            $bindValues["tipo_evento"] = $request->getParameter("tipo_evento");
            $bindValues["evento"] = $request->getParameter("evento");           
            
            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                
                $evento->setCaId( $bindValues["id"] );
                $evento->setCaEvento( $bindValues["evento"] );
                if( $numreferencia ){
                    $evento->setCaReferencia( $numreferencia );
                }
                $evento->setCaIdcriterio( $bindValues["tipo_evento"] );
                $evento->save();
                
                $this->redirect($this->url);

                
            }

        }

        $this->evento = $evento;

    }



     /*
    * Permite agregar lineas de transporte
    *
    * @param sfRequest $request A request object
    */
   

    /*
    * Permite agregar lineas de transporte
    *
    * @param sfRequest $request A request object
    */
    public function executeListadoProveedoresAprobados(sfWebRequest $request){
       $this->proveedores = Doctrine::getTable("IdsProveedor")
                             ->createQuery("p")
                             ->innerJoin("p.Ids i")
                             ->innerJoin("i.IdsSucursal s")
                             ->innerJoin("s.Ciudad c")
                             ->innerJoin("p.IdsTipo t")
                             ->where("p.ca_fchaprobado IS NOT NULL")
                             ->addWhere("p.ca_controladoporsig = true")
                             ->addOrderBy("t.ca_nombre ASC")
                             ->addOrderBy("p.ca_transporte ASC")
                             ->addOrderBy("i.ca_nombre ASC")                             
                             ->execute();      
    }
	
    public function executeListadoProveedoresInactivos(sfWebRequest $request){
		$this->proveedores = Doctrine::getTable("IdsProveedor")
                             ->createQuery("p")
							 ->innerJoin("p.Ids i")
                             ->innerJoin("i.IdsSucursal s")
                             ->innerJoin("s.Ciudad c")
                             ->innerJoin("p.IdsTipo t")
                             ->where("p.ca_fchaprobado IS NOT NULL")
                             ->addWhere("p.ca_activo_impo = false OR p.ca_activo_expo=false")
							 ->addOrderBy("i.ca_nombre ASC")
                             ->execute();
    }
    
    /*
    * Permite agregar grupos a una cabeza de grupo
    *
    * @param sfRequest $request A request object
    */
    public function executeFormGrupos(sfWebRequest $request){
        $this->modo=$request->getParameter("modo");
        $this->form = new NuevoGrupoForm();
        $this->form->setModo( $this->modo );
        $this->form->configure();
        $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));

       if ($request->isMethod('post')){
			$bindValues = array();
            $bindValues["idgrupo"] = $request->getParameter("idgrupo");
            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                $idsGrupo = Doctrine::getTable("Ids")->find($request->getParameter("idgrupo"));
                $idsGrupo->setCaIdgrupo($this->ids->getCaId());
                $idsGrupo->save();
                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->ids->getCaId() );
            }
        }
    }


    /*
    * Permite eliminar la pertenecia a un grupo
    *
    * @param sfRequest $request A request object
    */
    public function executeEliminarGrupo(sfWebRequest $request){
        $this->modo=$request->getParameter("modo");       
        $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));

        $idsGrupo = Doctrine::getTable("Ids")->find($request->getParameter("idgrupo"));
        $idsGrupo->setCaIdgrupo($idsGrupo->getCaId());
        $idsGrupo->save();
        $this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->ids->getCaId() );
    }

    /*
    * Envia alertas sobre los vencimientos de los documentos 
    *
    * @param sfRequest $request A request object
    */

    public function executeAlertasDocumentos(sfWebRequest $request){
       $this->modo=$request->getParameter("modo");  
       $this->fecha = date("Y-m-d", time()+86400*16);
       echo$this->fecha ;
       $q = Doctrine::getTable("IdsDocumento")
                               ->createQuery("d")
                               ->select("i.ca_id, d.ca_iddocumento, d.ca_fchvencimiento, t.ca_tipo, i.ca_nombre")
                               ->innerJoin("d.Ids i")
                               ->innerJoin("d.IdsTipoDocumento t")
                               ->where("d.ca_fchvencimiento<=?", $this->fecha )
                               ->addWhere("d.ca_iddocumento IN (SELECT dd.ca_iddocumento FROM IdsDocumento dd WHERE dd.ca_idtipo=d.ca_idtipo AND dd.ca_id=d.ca_id ORDER BY dd.ca_fchvencimiento DESC LIMIT 1)")

                               ->addOrderBy("d.ca_fchvencimiento ASC")
                               ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
       if( $this->modo=="prov" ){
            $q->innerJoin("i.IdsProveedor p");
            $q->addWhere("p.ca_controladoporsig = ?", true);
            $this->titulo = "Documentos de proveedores controlados por SIG";
       }

       if( $request->getParameter("layout") ){
            $this->setLayout($request->getParameter("layout"));
       }
       /* echo $q->getSqlQuery();
        exit();*/

       $this->documentos = $q->execute();
    }

    public function executeAlertasDocumentosEmail(sfWebRequest $request){

        
        $this->modo=$request->getParameter("modo");

        $usuarios = Doctrine::getTable("Usuario")
                          ->createQuery("u")
                          ->innerJoin("u.UsuarioPerfil p")
                          ->where("p.ca_perfil = ? ", "asistente-de-pricing")
                          ->addWhere("u.ca_activo = ?", true)
                          ->execute();

        $contentHTML = sfContext::getInstance()->getController()->getPresentationFor( 'ids', 'alertasDocumentos');
        
        $email = new Email();
        $email->setCaUsuenvio( "Administrador" );
        $email->setCaTipo( "Not. Vencimiento" );
        $email->setCaFrom( "no-reply@coltrans.com.co" );
        $email->setCaReplyto( "no-reply@coltrans.com.co" );
        $email->setCaFromname( "Colsys" );
        foreach( $usuarios as $usuario ){
            $email->addTo( $usuario->getCaEmail() );
        }
        $email->setCaSubject( "Vencimiento de documentos" );
        $email->setCaBodyhtml( $contentHTML );

        $email->save();        
        $email->send();       

        return sfView::NONE;
    }



    public function executeVerificarListaClinton(sfWebRequest $request){
        $id = $request->getParameter("id");

        $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
        $this->forward404Unless( $this->ids );
        $this->modo = $request->getParameter("modo");

        $q = Doctrine_Manager::getInstance()->connection();

        
        $query = "select * from tb_parametros where ca_casouso = 'CU065' and ca_identificacion = 1";
        $stmt = $q->execute($query);
        $row =  $stmt->fetch();
        $this->fechaActualizacion = $row["ca_valor2"];
        



        $query = "select 	cl.ca_idalterno, cl.ca_nombre, sdnm.*, sdid.*, sdal.* "; //, sdak.*
        $query.= "		from (select * from ids.tb_ids where ca_id = $id) cl ";
        $query.= "		LEFT OUTER JOIN tb_sdn sdnm ";
        $query.= "		ON ( fun_similarpercent(cl.ca_nombre, textcat(case when nullvalue(sdnm.ca_firstname) then '' else sdnm.ca_firstname end, case when nullvalue(sdnm.ca_lastname) then '' else sdnm.ca_lastname end)) >90 ) ";
        $query.= "		LEFT OUTER JOIN tb_sdnid sdid ";
        $query.= "		ON ( fun_similarpercent(cl.ca_idalterno::text, sdid.ca_idnumber) >90 ) ";
        $query.= "		LEFT OUTER JOIN tb_sdnaka sdal ";
        $query.= "		ON ( fun_similarpercent(cl.ca_nombre, textcat(case when nullvalue(sdal.ca_firstname) then '' else sdal.ca_firstname end, case when nullvalue(sdal.ca_lastname) then '' else sdal.ca_lastname end)) >90 ) ";
        //$query.= "		LEFT OUTER JOIN tb_sdnaka sdak ";
        //$query.= "		ON ( fun_similarpercent(cl.ca_nombres||' '||cl.ca_papellido||' '||cl.ca_sapellido, textcat(case when nullvalue(sdak.ca_firstname) then '' else sdak.ca_firstname end, case when nullvalue(sdak.ca_lastname) then '' else sdak.ca_lastname end)) >90 ) ";
        //$query.= "		LEFT OUTER JOIN tb_ciudades ciu ";
        //$query.= "		ON (cl.ca_idciudad = ciu.ca_idciudad) ";
        //$query.= "		where NOT nullvalue(sdnm.ca_uid) or NOT nullvalue(sdid.ca_uid) or NOT nullvalue(sdak.ca_uid) ";
        $query.= "     order by cl.ca_nombre";

        $stmt = $q->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        @$stmt->execute();
        $this->stmt = $stmt;


        

        


        

    }



}
?>