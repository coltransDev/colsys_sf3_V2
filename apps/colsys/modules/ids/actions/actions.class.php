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
	const RUTINA_OTROSPROV = "80";
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
		if( $this->modo=="transp" ){
			$this->nivel = $this->getUser()->getNivelAcceso( idsActions::RUTINA_TRANPORTADORES );
		}
		if( $this->modo=="prov" ){
			$this->nivel = $this->getUser()->getNivelAcceso( idsActions::RUTINA_OTROSPROV );
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
	}

    /**
	 * Permite seleccionar el modo de operacion del programa
	 * @author: Andres Botero
	 */
	public function executeSeleccionModo()
	{
		$this->nivelAgentes = $this->getUser()->getNivelAcceso( idsActions::RUTINA_AGENTES );
		$this->nivelTransportadores = $this->getUser()->getNivelAcceso( idsActions::RUTINA_TRANPORTADORES );
		$this->nivelOtrosproveedores = $this->getUser()->getNivelAcceso( idsActions::RUTINA_OTROSPROV );
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
		}
		//$c->add( CotizacionPeer::CA_USUANULADO, null, Criteria::ISNULL );
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
            
            $this->form->bind( $bindValues );
			if( $this->form->isValid() ){
                
                $ids->setCaTipoidentificacion( $bindValues["tipo_identificacion"]);

                if( $bindValues["id"] ){
                    $ids->setCaId( $bindValues["id"]);
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

                /*
                * Guardar Sucursal
                */
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
                
                $this->redirect("ids/verIds?id=".$ids->getCaId() );

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

		$sucursal = IdsSucursalPeer::retrieveByPk( $request->getParameter("idsucursal") );

        if( $sucursal ){
            $ids = $sucursal->getIds();
        }else{
            $ids = IdsPeer::retrieveByPk( $request->getParameter("id") );
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
                $documento->setCaFchinicio( $request->getParameter("inicio"));
                $documento->setCaFchvencimiento( $request->getParameter("vencimiento"));
                //$documento->setCaFax( $request->getParameter("fax"));

                $documento->save();

                $this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids->getCaId() );
			}
		}
        $this->documento = $documento;
        $this->ids = $ids;
    }
}
?>