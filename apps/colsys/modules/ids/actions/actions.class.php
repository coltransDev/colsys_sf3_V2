<?php

/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class idsActions extends sfActions {
    const RUTINA_AGENTES = "8";
    const RUTINA_PROV = "81";
    const RUTINA_CLIENTES = "10";
    /*
     * Retorna el nivel de acceso de acuerdo al modo
     */

    public function getNivel() {
        $this->modo = $this->getRequestParameter("modo");

        $this->nivel = -1;
        if (!$this->modo) {
            $this->forward("ids", "seleccionModo");
        }
        
        if ($this->modo == "agentes") {            
            $this->nivel = $this->getUser()->getNivelAcceso(idsActions::RUTINA_AGENTES);
        }

        if ($this->modo == "prov") {
            $this->nivel = $this->getUser()->getNivelAcceso(idsActions::RUTINA_PROV);
        }
        if ($this->modo == "clientes") {
            $this->nivel = $this->getUser()->getNivelAcceso(idsActions::RUTINA_CLIENTES);
        }


        if ($this->nivel == -1) {
            $this->forward404();
        }        
        return $this->nivel;
    }

    /**
     * Muestra la pagina inicial del modulo, le permite al usuario hacer busquedas.
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

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
        foreach ($ciudades as $ciudad) {
            $result[$ciudad->getCaIdtrafico()][] = array("idciudad" => $ciudad->getCaIdciudad(),
                "ciudad" => utf8_encode($ciudad->getCaCiudad())
            );
        }

        $this->ciudades = json_encode($result);
    }

    /**
     * Permite seleccionar el modo de operacion del programa
     * @author: Andres Botero
     */
    public function executeSeleccionModo() {
        $this->nivelAgentes = $this->getUser()->getNivelAcceso(idsActions::RUTINA_AGENTES);
        $this->nivelProveedores = $this->getUser()->getNivelAcceso(idsActions::RUTINA_PROV);
    }

    /**
     * Permite realizar busquedas en la tabla de proveedores
     *
     * @param sfRequest $request A request object
     */
    public function executeBusqueda(sfWebRequest $request) {
        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();
        $criterio = $request->getParameter("criterio");
        $cadena = $request->getParameter("cadena");

        $q = Doctrine_Query::create()->from('Ids i');

        switch ($this->modo) {
            case "agentes":
                $q->innerJoin("i.IdsAgente ag");
                if ($this->nivel < 2) {
                    $q->addWhere('ag.ca_activo = ?', true);
                }
                break;
            case "prov":
                $q->innerJoin("i.IdsProveedor prov");
                break;
        }

        switch ($criterio) {
            case "nombre":
                if ($this->modo == "prov") {
                    $q->addWhere('i.ca_nombre like ? OR prov.ca_sigla like ?', array('%' . strtoupper($cadena) . '%', '%' . strtoupper($cadena) . '%'));
                } else {
                    $q->addWhere('i.ca_nombre like ?', '%' . strtoupper($cadena) . '%');
                }

                break;
            case "id":
                $q->addWhere('i.ca_idalterno like ?', strtoupper($cadena) . '%');
                break;
            case "ciudad":
                $idtrafico = $request->getParameter("idtrafico");
                $idciudad = $request->getParameter("idciudad");
                $q->innerJoin("i.IdsSucursal s");
                $q->innerJoin("s.Ciudad c");
                $q->innerJoin("c.Trafico t");

                if ($idtrafico) {
                    $q->addWhere('t.ca_idtrafico = ?', $idtrafico);
                }
                if ($idciudad) {
                    $q->addWhere('c.ca_idciudad = ?', $idciudad);
                }
                $q->addWhere("s.ca_fcheliminado IS NULL");
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
        if ($this->pager->getResultsInPage() == 1 && $this->pager->getPage() == 1) {
            $ids = $this->idsList;
            $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $ids[0]->getCaId());
        }
        $this->criterio = $criterio;
        $this->cadena = $cadena;
    }

    /**
     * Muestra el formulario de creación y edicion de proveedores
     *
     * @param sfRequest $request A request object
     */
    public function executeVerIds(sfWebRequest $request) {
        $this->nivel = $this->getNivel();
        $this->modo = $request->getParameter("modo");
        $this->forward404Unless($request->getParameter("id"));

        $this->ids = Doctrine::getTable('Ids')->find($request->getParameter("id"));
        $this->forward404Unless($this->ids);


        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("tabpane/tabpane", 'last');
        $response->addStylesheet("tabpane/luna/tab", 'last');
    }

    /**
     * Muestra el formulario de creación y edicion de proveedores
     *
     * @param sfRequest $request A request object
     */
    public function executeFormIds(sfWebRequest $request) {
        $this->nivel = $this->getNivel();
        $this->modo = $request->getParameter("modo");
        $this->form = new NuevoIdsForm();
        
        $this->idtrafico = $this->getUser()->getIdtrafico();        
        
        $formSucursal = new NuevaSucursalForm();
        $this->form->mergeForm($formSucursal);

        if ($this->modo == "prov") {
            $this->formProveedor = new NuevoProveedorForm();
            $this->form->mergeForm($this->formProveedor);
        }

        if ($this->modo == "agentes") {
            $this->formAgente = new NuevoAgenteForm();
            $this->form->mergeForm($this->formAgente);
        }

        $ids = null;

        if ($request->getParameter("id")) {
            $ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
        }

        if (!$ids) {
            $ids = new Ids();
        }

        if ($request->isMethod('post')) {

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

            if ($this->modo == "prov") {
                $bindValues["tipo_proveedor"] = $request->getParameter("tipo_proveedor");
                $bindValues["controladoporsig"] = $request->getParameter("controladoporsig");
                $bindValues["critico"] = $request->getParameter("critico");
                $bindValues["aprobado"] = $request->getParameter("aprobado");
                $bindValues["fchvencimiento"] = $request->getParameter("fchvencimiento");
                $bindValues["activo_impo"] = $request->getParameter("activo_impo");
                $bindValues["activo_expo"] = $request->getParameter("activo_expo");
                $bindValues["vetado"] = $request->getParameter("vetado");
                $bindValues["contrato_comodato"] = $request->getParameter("contrato_comodato");
                $bindValues["empresa"] = $request->getParameter("empresa");
                $bindValues["ant_legales"] = $request->getParameter("ant_legales");
                $bindValues["ant_penales"] = $request->getParameter("ant_penales");
                $bindValues["ant_financieros"] = $request->getParameter("ant_financieros");
                $bindValues["jefecuenta"] = $request->getParameter("jefecuenta");

                if ($bindValues["tipo_proveedor"] == "TRI" || $bindValues["tipo_proveedor"] == "TRN") {
                    $bindValues["sigla"] = $request->getParameter("sigla");
                    $bindValues["transporte"] = $request->getParameter("transporte");
                }
            }

            if ($this->modo == "agentes") {
                $bindValues["tipo"] = $request->getParameter("tipo");
                $bindValues["activo"] = $request->getParameter("activo");
                $bindValues["tplogistics"] = $request->getParameter("tplogistics");
                $bindValues["infosec"] = $request->getParameter("infosec");
            }

            $this->form->bind($bindValues);

            if ($this->form->isValid()) {

                if ($bindValues["tipo_identificacion"]) {
                    $ids->setCaTipoidentificacion(intval($bindValues["tipo_identificacion"]));
                }

                if ($bindValues["idalterno"]) {
                    $ids->setCaIdalterno($bindValues["idalterno"]);
                }


                if ($bindValues["dv"]) {
                    $ids->setCaDv(intval($bindValues["dv"]));
                }

                $ids->setCaNombre($bindValues["nombre"]);
                $ids->setCaWebsite($bindValues["website"]);

                $ids->save();

                //exit( $ids->getCaId() );
                if ($bindValues["idgrupo"]) {
                    $ids->setCaIdgrupo(intval($bindValues["idgrupo"]));
                } else {
                    $ids->setCaIdgrupo(intval($ids->getCaId()));
                }
                $ids->save();


                // Guarda el proveedor
                $nuevo = 0;
                
                if (isset($this->formProveedor)) {
                    $proveedor = $ids->getIdsProveedor();
                    if (!$proveedor) {
                        $proveedor = new IdsProveedor();
                        $proveedor->setCaIdproveedor($ids->getCaId());
                        $nuevo = 1;
                    }

                    $proveedor->setCaTipo($bindValues["tipo_proveedor"]);

                    if ($bindValues["activo_impo"]) {
                        $proveedor->setCaActivoImpo(true);
                    } else {
                        $proveedor->setCaActivoImpo(false);
                    }

                    if ($bindValues["activo_expo"]) {
                        $proveedor->setCaActivoExpo(true);
                    } else {
                        $proveedor->setCaActivoExpo(false);
                    }
                    
                    if ($bindValues["vetado"]) {
                        $proveedor->setCaVetado(true);
                    } else {
                        $proveedor->setCaVetado(false);
                    }
                    
                    if ($bindValues["contrato_comodato"]) {
                        $proveedor->setCaContratoComodato(true);
                    } else {
                        $proveedor->setCaContratoComodato(false);
                    }
                   
                    if ($bindValues["empresa"]) {
                        $proveedor->setCaEmpresa($bindValues["empresa"]);
                    } else {
                        $proveedor->setCaEmpresa(null);
                    }
                    
                    if ($bindValues["ant_legales"]) {
                        $proveedor->setCaAntlegales($bindValues["ant_legales"]);
                    } else {
                        $proveedor->setCaAntlegales(null);
                    }
                    
                    if ($bindValues["ant_penales"]) {
                        $proveedor->setCaAntpenales($bindValues["ant_penales"]);
                    } else {
                        $proveedor->setCaAntpenales(null);
                    }
                    
                    if ($bindValues["ant_financieros"]) {
                        $proveedor->setCaAntfinancieros($bindValues["ant_financieros"]);
                    } else {
                        $proveedor->setCaAntfinancieros(null);
                    }
                    
                    if ($bindValues["jefecuenta"]) {
                        $proveedor->setCaJefecuenta($bindValues["jefecuenta"]);
                    }else {
                        $proveedor->setCaJefecuenta(null);
                    }

                    if ($bindValues["tipo_proveedor"] == "TRI" || $bindValues["tipo_proveedor"] == "TRN") {
                        $proveedor->setCaSigla($bindValues["sigla"]);
                        if ($bindValues["transporte"]) {
                            $proveedor->setCaTransporte($bindValues["transporte"]);
                        } else {
                            $proveedor->setCaTransporte(null);
                        }
                    }

                    if ($this->nivel >= 5) {
                        if ($bindValues["controladoporsig"]) {
                            $proveedor->setCaControladoporsig($bindValues["controladoporsig"]);
                        } else {
                            $proveedor->setCaControladoporsig(0);
                        }
                        
                        if ($bindValues["fchvencimiento"]) {
                            $proveedor->setCaFchvencimiento($bindValues["fchvencimiento"]);
                            if($bindValues["fchvencimiento"]<date('Y-m-d')){
                                $proveedor->setCaActivoImpo(false);
                                $proveedor->setCaActivoExpo(false);
                            }
                        } else {
                            $proveedor->setCaFchvencimiento(null);
                        }

                        if ($bindValues["critico"]) {
                            $proveedor->setCaCritico(true);
                        } else {
                            $proveedor->setCaCritico(false);
                        }

                        /* if ($bindValues["esporadico"]) {
                          $proveedor->setCaEsporadico(true);
                          } else {
                          $proveedor->setCaEsporadico(false);
                          } */


                        /*if ($bindValues["aprobado"]) {
                            if ($bindValues["aprobado"] != $proveedor->getCaFchaprobado()) {
                                $proveedor->setCaFchaprobado($bindValues["aprobado"]);
                                $proveedor->setCaUsuaprobado($this->getUser()->getUserId());
                            }
                        } else {
                            $proveedor->setCaFchaprobado(null);
                            $proveedor->setCaUsuaprobado(null);
                        }*/
                    }

                    $proveedor->save();
                    $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
                    
                    if($nuevo>0){
                        if($proveedor->getCaJefecuenta()){
                            $email = new Email();
                            $email->setCaUsuenvio($this->getUser()->getUserId());
                            $email->setCaTipo("Not. Aprobación");
                            $email->setCaFrom($usuario->getCaEmail());
                            $email->setCaReplyto($usuario->getCaEmail());
                            $email->setCaFromname($usuario->getCaNombre());
                            $email->setCaAddress($proveedor->getUsuario()->getCaEmail());
                            $email->addCC($usuario->getCaEmail());
                            $email->setCaSubject("Aprobacion Proveedor - ".$proveedor->getIds()->getCaNombre());
                            sfContext::getInstance()->getRequest()->setParameter("nombre", $proveedor->getIds()->getCaNombre());
                            sfContext::getInstance()->getRequest()->setParameter("id", $proveedor->getIds()->getCaId());
                            
                            $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('ids', 'emailAprobacion'));
                            $email->save();
                        }
                    }
                }


                if (isset($this->formAgente)) {
                    $agente = $ids->getIdsAgente();
                    if (!$agente) {
                        $agente = new IdsAgente();
                        $agente->setCaIdagente($ids->getCaId());
                    }

                    $agente->setCaTipo($bindValues["tipo"]);



                    if ($bindValues["activo"]) {

                        if ($agente->setCaActivo() == false) {
                            $this->getUser()->log("Cambio Agente Activo: " . $bindValues["nombre"] . " pasa a activo");
                        }
                        $agente->setCaActivo(true);
                    } else {
                        if ($agente->setCaActivo() == true) {
                            $this->getUser()->log("Cambio Agente Activo: " . $bindValues["nombre"] . " pasa a inactivo");
                        }
                        $agente->setCaActivo(false);
                    }

                    if ($bindValues["tplogistics"]) {
                        $agente->setCaTplogistics(true);
                    } else {
                        $agente->setCaTplogistics(false);
                    }
                    if ($bindValues["infosec"]) {
                        $agente->setCaInfosec($bindValues["infosec"]);
                    }



                    $agente->save();
                    Utils::deleteCache();
                }

                // Guardar Sucursal
                $sucursal = $ids->getSucursalPrincipal();
                if (!$sucursal) {
                    $sucursal = new IdsSucursal();
                    $sucursal->setCaPrincipal(true);
                }

                $sucursal->setCaId($ids->getCaId());
                $sucursal->setCaDireccion($request->getParameter("direccion"));
                $sucursal->setCaTelefonos($request->getParameter("telefonos"));
                $sucursal->setCaIdciudad($request->getParameter("idciudad"));
                $sucursal->setCaFax($request->getParameter("fax"));

                $sucursal->save();

                $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $ids->getCaId());
            }
        }

        $this->ids = $ids;
    }

    /**
     * Comprueba si existe un ID en la BD
     *
     * @param sfRequest $request A request object
     */
    public function executeComprobarId(sfWebRequest $request) {
        $idalterno = $request->getParameter("idalterno");
        
        $tipo_identificacion = $request->getParameter("tipo_identificacion");
        $id = Doctrine::getTable("Ids")
                ->createQuery("id")
                ->where("id.ca_idalterno = ? ", array($idalterno))
                ->fetchOne();
        $this->responseArray = array();
        if ($id) {
            $this->responseArray["id"] = $id->getCaId();
        } else {
            $this->responseArray["id"] = false;
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Muestra el formulario de creación y edicion de contactos
     *
     * @param sfRequest $request A request object
     */
    public function executeFormContactosIds(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel < 3) {
            $this->forward404();
        }
        $this->modo = $request->getParameter("modo");

        $this->contacto = Doctrine::getTable("IdsContacto")->find($request->getParameter("idcontacto"));

        if ($this->contacto) {
            $this->sucursal = $this->contacto->getIdsSucursal();
        } else {
            $this->sucursal = Doctrine::getTable("IdsSucursal")->find($request->getParameter("idsucursal"));
        }
        $this->forward404Unless($this->sucursal);

        $this->form = new NuevoContactoForm();

        if ($request->isMethod('post')) {
            $bindValues = array();

            $bindValues["idcontacto"] = $request->getParameter("idcontacto");
            $bindValues["identificacion"] = $request->getParameter("identificacion");
            $bindValues["idsucursal"] = $request->getParameter("idsucursal");
            $bindValues["nombre"] = trim($request->getParameter("nombre"));
            $bindValues["apellido"] = trim($request->getParameter("apellido"));
            //$bindValues["direccion"] = $request->getParameter("direccion");
            //$bindValues["idciudad"] = $request->getParameter("idciudad");
            $bindValues["telefonos"] = $request->getParameter("telefonos");
            $bindValues["fax"] = $request->getParameter("fax");
            $bindValues["celular"] = $request->getParameter("celular");
            $bindValues["skype"] = $request->getParameter("skype");
            $bindValues["email"] = trim($request->getParameter("email"));
            $bindValues["cargo"] = $request->getParameter("cargo");
            $bindValues["otro_cargo"] = $request->getParameter("otro_cargo");
            $bindValues["sugerido"] = $request->getParameter("sugerido");
            $bindValues["activo"] = $request->getParameter("activo");
            $bindValues["detalles"] = $request->getParameter("detalles");

            $bindValues["impoexpo"] = $request->getParameter("impoexpo");
            $bindValues["transporte"] = $request->getParameter("transporte");
            $bindValues["visibilidad"] = $request->getParameter("visibilidad");
            $bindValues["codigoarea"] = $request->getParameter("codigoarea");
            $bindValues["notificar_vencimientos"] = $request->getParameter("notificar_vencimientos");
            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                if ($bindValues["idcontacto"]) {
                    $contacto = Doctrine::getTable("IdsContacto")->find($bindValues["idcontacto"]);
                } else {
                    $contacto = new IdsContacto();
                    $contacto->setCaIdsucursal($this->sucursal->getCaIdsucursal());
                }
                
                if($bindValues["identificacion"]){
                    $contacto->setCaIdentificacion($bindValues["identificacion"]);
                }

                $contacto->setCaNombres(ucwords(strtolower(trim($bindValues["nombre"]))));
                $contacto->setCaPapellido(ucwords(strtolower(trim($bindValues["apellido"]))));
                //$contacto->setCaDireccion( trim($bindValues["direccion"]) );
                //$contacto->setCaIdciudad( $bindValues["idciudad"] );
                $contacto->setCaTelefonos($bindValues["telefonos"]);
                $contacto->setCaFax($bindValues["fax"]);
                if ($bindValues["celular"]) {
                    $contacto->setCaCelular($bindValues["celular"]);
                }else{
                    $contacto->setCaCelular(null);
                }
                
                if ($bindValues["skype"]) {
                    $contacto->setCaSkype($bindValues["skype"]);
                }else{
                    $contacto->setCaSkype(null);
                }
                
                $contacto->setCaEmail($bindValues["email"]);
                $contacto->setCaImpoexpo(implode("|", $bindValues["impoexpo"]));
                $contacto->setCaTransporte(implode("|", $bindValues["transporte"]));
                if ($bindValues["cargo"]) {
                    $contacto->setCaCargo($bindValues["cargo"]);
                } else {
                    $contacto->setCaCargo($bindValues["otro_cargo"]);
                }
                if ($bindValues["codigoarea"] && $this->sucursal->getCiudad()->getCodigoarea()) {
                    $contacto->setCaCodigoarea($bindValues["codigoarea"]);
                } else {
                    $contacto->setCaCodigoarea(null);
                }
                $contacto->setCaObservaciones($bindValues["detalles"]);
                $contacto->setCaVisibilidad(intval($bindValues["visibilidad"]));
                if ($bindValues["sugerido"]) {
                    $contacto->setCaSugerido(true);
                } else {
                    $contacto->setCaSugerido(false);
                }

                if ($bindValues["activo"]) {
                    $contacto->setCaActivo(true);
                } else {
                    $contacto->setCaActivo(false);
                }

                if ($bindValues["notificar_vencimientos"]) {
                    $contacto->setCaNotificarVencimientos(true);
                } else {
                    $contacto->setCaNotificarVencimientos(false);
                }
                $contacto->save();

                $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $this->sucursal->getCaId());
            }
        }
    }

    /**
     * Deshabilita una sucursal con sus contactos
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarSucursalIds(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        /* if( $this->nivel<=0 ){
          $this->forward404();
          } */

        $this->modo = $request->getParameter("modo");

        $sucursal = Doctrine::getTable("IdsSucursal")->find($request->getParameter("idsucursal"));
        $this->forward404Unless($sucursal);
        
        $sucursal->setCaFcheliminado(date("Y-m-d H:i:s"));
        $sucursal->setCaUsueliminado($this->getUser()->getUserId());
        $sucursal->save();
        
        $contactos = $sucursal->getContactos();
        
        if($contactos){
            foreach($contactos as $contacto){
                $contacto->setCaFcheliminado(date("Y-m-d H:i:s"));
                $contacto->setCaUsueliminado($this->getUser()->getUserId());
                $contacto->save();
            }
        }
        $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $sucursal->getCaId());
    }
    
    /**
     * Elimina un contacto de una sucursal
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarContactoIds(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        /* if( $this->nivel<=0 ){
          $this->forward404();
          } */

        $this->modo = $request->getParameter("modo");

        $contacto = Doctrine::getTable("IdsContacto")->find($request->getParameter("idcontacto"));
        $this->forward404Unless($contacto);
        $this->sucursal = $contacto->getIdsSucursal();
        $contacto->setCaFcheliminado(date("Y-m-d H:i:s"));
        $contacto->setCaUsueliminado($this->getUser()->getUserId());
        $contacto->save();
        $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $this->sucursal->getCaId());
    }

    /*
      Permite cambiar un contacto de una sucursal a otra
     *
     * @param sfRequest $request A request object
     */

    public function executeFormTransladarContacto(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        /* if( $this->nivel<=0 ){
          $this->forward404();
          } */

        $this->modo = $request->getParameter("modo");

        $this->contacto = Doctrine::getTable("IdsContacto")->find($request->getParameter("idcontacto"));
        $this->forward404Unless($this->contacto);
        $this->sucursal = $this->contacto->getIdsSucursal();
        $idant = $this->sucursal->getCaIdsucursal();
        $this->sucursales = Doctrine::getTable("IdsSucursal")
                ->createQuery("s")
                ->addWhere("s.ca_id = ?" , $this->sucursal->getCaId())
                ->execute();


        if ($request->isMethod('post')) {
            $this->contacto->setCaIdsucursal( $request->getParameter("idsucursal") );
            $this->contacto->save();
            $this->getUser()->log("ids: Translado de sucursal ".$this->contacto->getNombre()." de ".$idant." a ".$request->getParameter("idsucursal"));
            $this->redirect("ids/verIds?modo=".$this->modo."&id=".$this->sucursal->getCaId());
        }
    }

    /**
     * Muestra el formulario de creación y edicion de sucursales
     *
     * @param sfRequest $request A request object
     */
    public function executeFormSucursalIds(sfWebRequest $request) {
        $this->nivel = $this->getNivel();
        /*
          if( $this->nivel<=0 ){
          $this->forward404();
          } */
        $this->modo = $request->getParameter("modo");
        if ($request->getParameter("idsucursal")) {
            $sucursal = Doctrine::getTable("IdsSucursal")->find($request->getParameter("idsucursal"));
            $ids = $sucursal->getIds();
        } else {
            $ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
            $sucursal = null;
        }


        $this->forward404Unless($ids);

        $this->form = new NuevaSucursalForm();

        if ($request->isMethod('post')) {
            $bindValues = array();

            $bindValues["direccion"] = $request->getParameter("direccion");
            $bindValues["idciudad"] = $request->getParameter("idciudad");
            $bindValues["telefonos"] = $request->getParameter("telefonos");
            $bindValues["fax"] = $request->getParameter("fax");


            $this->form->bind($bindValues);
            if ($this->form->isValid()) {


                if (!$sucursal) {
                    $sucursal = new IdsSucursal();
                    $sucursal->setCaPrincipal(false);
                }

                $sucursal->setCaId($ids->getCaId());
                $sucursal->setCaDireccion($request->getParameter("direccion"));
                $sucursal->setCaTelefonos($request->getParameter("telefonos"));
                $sucursal->setCaIdciudad($request->getParameter("idciudad"));
                $sucursal->setCaFax($request->getParameter("fax"));

                $sucursal->save();

                $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $ids->getCaId());
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

    public function executeFormDocumentos(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }
        $this->modo = $request->getParameter("modo");

        $documento = Doctrine::getTable("IdsDocumento")->find($request->getParameter("iddocumento"));

        if ($documento) {
            $ids = $documento->getIds();
        } else {
            $ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
        }
        $this->forward404Unless($ids);

        $this->form = new NuevoDocumentoForm();

        if ($request->isMethod('post')) {
            $bindValues = array();

            $bindValues["id"] = $request->getParameter("id");
            $bindValues["idtipo"] = $request->getParameter("idtipo");
            $bindValues["observaciones"] = $request->getParameter("observaciones");
            if ($request->getParameter("inicio")) {
                $bindValues["inicio"] = Utils::parseDate($request->getParameter("inicio"));
            }

            if ($request->getParameter("vencimiento")) {
                $bindValues["vencimiento"] = Utils::parseDate($request->getParameter("vencimiento"));
            }

            $bindFiles["archivo"] = $_FILES["archivo"];

            $this->form->bind($bindValues, $bindFiles);

            if ($this->form->isValid()) {


                if (!$documento) {
                    $documento = new IdsDocumento();
                    $documento->setCaId($ids->getCaId());
                }

                $documento->setCaIdtipo($request->getParameter("idtipo"));

                if ($request->getParameter("inicio")) {
                    $documento->setCaFchinicio(Utils::parseDate($request->getParameter("inicio")));
                }
                
                if ($request->getParameter("observaciones")) {
                    $documento->setCaObservaciones($request->getParameter("observaciones"));
                }
                
                if ($request->getParameter("vencimiento") !== null) {
                    if ($request->getParameter("vencimiento")) {
                        $documento->setCaFchvencimiento(Utils::parseDate($request->getParameter("vencimiento")));
                    } else {
                        $documento->setCaFchvencimiento(null);
                    }
                }

                $documento->save();

                if ($bindFiles["archivo"]) {
                    $directorio = $documento->getDirectorio();

                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0777, true);
                    }

                    if(move_uploaded_file($bindFiles["archivo"]["tmp_name"], $directorio . DIRECTORY_SEPARATOR . $bindFiles["archivo"]["name"])){;
                        $documento->setCaUbicacion($bindFiles["archivo"]["name"]);
                        $documento->save();
                    }
                }
                


                $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $ids->getCaId());
            }
        }
        $this->documento = $documento;
        $this->ids = $ids;
        
        $this->idtipodocumento = $request->getParameter("idtipodocumento");
    }
    
    
    /*
     * Manejo de documentos
     *
     * @param sfRequest $request A request object
     */

    public function executeEliminarDocumentos(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel < 3) {
            $this->forward404();
        }
        $this->modo = $request->getParameter("modo");

        $this->forward404Unless( $request->getParameter("iddocumento") );
        $documento = Doctrine::getTable("IdsDocumento")->find($request->getParameter("iddocumento"));
        $this->forward404Unless($documento);        
        $ids = $documento->getIds();        
        $this->forward404Unless($ids);
        
        $documento->delete();
        $imagen = $documento->getArchivo();
        $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $ids->getCaId());
        

        
    }
    
    

    /*
     * Visualiza documentos
     *
     * @param sfRequest $request A request object
     */

    public function executeVerDocumento(sfWebRequest $request) {
        $documento = Doctrine::getTable("IdsDocumento")->find($request->getParameter("iddocumento"));
        $this->forward404Unless($documento);
        $this->file = $documento->getArchivo();
    }

    /*
     * Visualiza documentos
     *
     * @param sfRequest $request A request object
     */

    public function executeFormEvaluacion(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        if ($request->getParameter("idevaluacion")) {
            $evaluacion = Doctrine::getTable("IdsEvaluacion")->find($request->getParameter("idevaluacion"));
            $this->ids = $evaluacion->getIds();
            $this->tipo = $evaluacion->getCaTipo();
            $this->proveedor = $evaluacion->getIds()->getIdsProveedor();
            //Solo permite editar evaluaciones con un privilegio alto
            if ($this->nivel < 6) {
                $this->forward404();
            }
        } else {
            $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
            $evaluacion = new IdsEvaluacion();
            $this->tipo = $request->getParameter("tipo");
            $this->proveedor = Doctrine::getTable("IdsProveedor")->find($request->getParameter("id"));
        }
        
        $defAno = date("Y");
        //echo date("Y-m-d")."  -----  entre ".date('Y')."-02-01"."    ".date('Y')."-07-01" ;
        if (date("Y-m-d") >= date('Y') . "-04-01" && date("Y-m-d") <= date('Y') . "-09-01") {
            $defPeriodo = 1;
        }else if (date("Y-m-d") >= date('Y') . "-09-01" && date("Y-m-d") <= date('Y') . "-12-31") {
            $defPeriodo = 2;
        } else {
            $defPeriodo = 2;
            if (date('Y') . "-01-01" <= date("Y-m-d")) {
                $defAno--;
            }
        }
        //echo $defPeriodo." ".$defAno;
        if ($request->getParameter("idevaluacion") && ($evaluacion->getCaPeriodo()!=$defPeriodo || $evaluacion->getCaAno()!=$defAno ) ) {
            $this->error = "No puede editar una evaluación de un periodo anterior";
        //    exit();
            return sfView::ERROR;
        }
        
        $this->defAno = $defAno;
        $this->defPeriodo = $defPeriodo;
              
        $this->modo = $request->getParameter("modo");
        $this->forward404Unless($this->ids);

        $q = Doctrine::getTable("IdsCriterio")->createQuery("c");
        if ($request->getParameter("idevaluacion")) {
            $q->innerJoin("c.IdsEvaluacionxCriterio ec");
            $q->addWhere("ec.ca_idevaluacion = ?", $request->getParameter("idevaluacion"));
        } else {            
            switch ($this->tipo) {
                case "reevaluacion":
                    $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                    break;
                case "reevaluacion_impo":
                    $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                case "reevaluacion_expo":
                    $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::EXPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                case "desempeno_impo":
                    $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                case "desempeno_expo":
                    $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", Constantes::EXPO);
                    $q->addWhere("c.ca_transporte = ?", $this->proveedor->getCaTransporte());
                    break;
                default:
                    $q->addWhere("c.ca_tipocriterio = ?", $this->tipo);
                    break;
            }

            if ($this->modo == "prov") {
                $q->addWhere("c.ca_tipo = ? or c.ca_tipo IS NULL", $this->proveedor->getCaTipo());
                if ($this->proveedor->getCaTipo()) {
                    
                }
            } else {
                if ($this->modo == "agentes") {
                    $q->addWhere("c.ca_tipo = ? or c.ca_tipo IS NULL", "AGE");
                }
            }
        }
        $q->addWhere("c.ca_activo = ?", true);
        $this->criterios = $q->execute();


        $this->form = new NuevaEvaluacionForm();
        $this->form->setCriterios($this->criterios);
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();

            //$bindValues["fchevaluacion"] = $request->getParameter("fchevaluacion");
            $bindValues["concepto"] = $request->getParameter("concepto");
            $bindValues["tipo"] = $request->getParameter("tipo");
            $bindValues["ano"] = $request->getParameter("ano");
            $bindValues["periodo"] = $request->getParameter("periodo");
            foreach ($this->criterios as $criterio) {
                $bindValues["ponderacion_" . $criterio->getCaIdcriterio()] = $request->getParameter("ponderacion_" . $criterio->getCaIdcriterio());
                $bindValues["calificacion_" . $criterio->getCaIdcriterio()] = $request->getParameter("calificacion_" . $criterio->getCaIdcriterio());
                $bindValues["observaciones_" . $criterio->getCaIdcriterio()] = $request->getParameter("observaciones_" . $criterio->getCaIdcriterio());
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {

                $evaluacion->setCaId($this->ids->getCaId());
                $evaluacion->setCaFchevaluacion(date("Y-m-d"));
                $evaluacion->setCaAno($request->getParameter('ano'));
                $evaluacion->setCaPeriodo($request->getParameter('periodo'));
                $evaluacion->setCaConcepto($request->getParameter('concepto'));

                $evaluacion->setCaTipo($request->getParameter('tipo'));
                $evaluacion->save();

                $evaluacionxCriterios = $evaluacion->getIdsEvaluacionxCriterio();
                foreach ($evaluacionxCriterios as $evaluacionxCriterio) {
                    $evaluacionxCriterio->delete();
                }

                $criterios = $request->getParameter("idcriterio");

                foreach ($criterios as $idcriterio) {
                    $evaluacionxcriterio = new IdsEvaluacionxCriterio();
                    $evaluacionxcriterio->setCaIdcriterio($idcriterio);
                    $evaluacionxcriterio->setCaPonderacion(trim($request->getParameter("ponderacion_" . $idcriterio)));
                    $evaluacionxcriterio->setCaValor(trim($request->getParameter("calificacion_" . $idcriterio)));
                    $evaluacionxcriterio->setCaIdevaluacion($evaluacion->getCaIdevaluacion());
                    if ($request->getParameter("observaciones_" . $idcriterio)) {
                        $evaluacionxcriterio->setCaObservaciones($request->getParameter("observaciones_" . $idcriterio));
                    } else {
                        $evaluacionxcriterio->setCaObservaciones(null);
                    }
                    $evaluacionxcriterio->save();
                }

                $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $this->ids->getCaId());
            }
        }

        $this->evaluacion = $evaluacion;

        $this->evaluacionxCriterios = array();
        $evaluacionxCriterios = $evaluacion->getIdsEvaluacionxCriterio();
        foreach ($evaluacionxCriterios as $evaluacionxCriterio) {
            $this->evaluacionxCriterios[$evaluacionxCriterio->getCaIdcriterio()] = $evaluacionxCriterio;
        }
    }

    /*
     * Muestra una evaluacion
     *
     * @param sfRequest $request A request object
     */

    public function executeVerEvaluacion(sfWebRequest $request) {
        $this->evaluacion = Doctrine::getTable("IdsEvaluacion")->find($request->getParameter("idevaluacion"));

        $this->forward404Unless($this->evaluacion);

        $this->ids = $this->evaluacion->getIds();
        $this->modo = $request->getParameter("modo");

        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();
    }

    /*
     * Elimina una evaluacion
     *
     * @param sfRequest $request A request object
     */

    public function executeEliminarEvaluacion(sfWebRequest $request) {



        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();

        if ($this->nivel < 6) {
            $this->forward404();
        }
        
        
        

        $evaluacion = Doctrine::getTable("IdsEvaluacion")->find($request->getParameter("idevaluacion"));

        $ids = $evaluacion->getIds();
        $this->forward404Unless($evaluacion);
        
        
        $defAno = date("Y");
        //echo date("Y-m-d")."  -----  entre ".date('Y')."-02-01"."    ".date('Y')."-07-01" ;
        if (date("Y-m-d") >= date('Y') . "-04-01" && date("Y-m-d") <= date('Y') . "-09-01") {
            $defPeriodo = 1;
        } else {
            $defPeriodo = 2;
                        
            //if (date('Y') . "-01-01" <= date("Y-m-d")) {
            if (date("Y-m-d") < date('Y') . "-04-01") {
                $defAno--;
            }
        }
        //echo $defPeriodo." ".$defAno;
        if ($request->getParameter("idevaluacion") && ($evaluacion->getCaPeriodo()!=$defPeriodo || $evaluacion->getCaAno()!=$defAno ) ) {
            $this->error = "No puede editar una evaluación de un periodo anterior";
        //    exit();
            return sfView::ERROR;
        }

        $evaluacionxCriterios = $evaluacion->getIdsEvaluacionxCriterio();
        foreach ($evaluacionxCriterios as $evaluacionxCriterio) {
            $evaluacionxCriterio->delete();
        }

        $evaluacion->delete();

        $this->getUser()->log("Elimina evaluación: " . $evaluacion->getCaIdevaluacion() . " id prov:" . $ids->getCaId() . " " . $ids->getCaNombre());

        $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $ids->getCaId());
    }

    /*
     * Permite registrar eventos por referencia
     *
     * @param sfRequest $request A request object
     */

    public function executeFormEventos(sfWebRequest $request) {
        //Se debe verificar que la referencia exista y determinar el proveedor.

        $this->modo = $request->getParameter("modo");
        $this->form = new NuevoEventoForm();

        if ($request->getParameter("idevento")) {
            $evento = Doctrine::getTable("IdsEvento")->find($request->getParameter("idevento"));
            $this->forward404Unless($evento);
        } else {
            $evento = new IdsEvento();
        }

        $q = Doctrine::getTable("IdsCriterio")->createQuery("c")->select("c.*");

        $this->idreporte = $request->getParameter("idreporte");
        if ($this->modo) { //Esta ingresando desde la maestra de proveedores o agentes
            if ($request->getParameter("idevento")) {
                $this->ids = $evento->getIds();
                if ($this->modo == "prov") {

                    if ($this->ids->getIdsProveedor()->getCaTipo() == "TRI") {
                        $q->addWhere("c.ca_impoexpo = ?", $evento->getIdsCriterio()->getCaImpoexpo());
                    }
                }
            } else {
                $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
                if ($this->modo == "prov") {
                    if ($this->ids->getIdsProveedor()->getCaTipo() == "TRI") {
                        $q->addWhere("c.ca_impoexpo = ?", $request->getParameter("impoexpo"));
                    }
                }
            }
            if ($this->modo == "prov") {
                $this->form->setTipo($this->ids->getIdsProveedor()->getCaTipo());
                if ($this->ids->getIdsProveedor()->getCaTipo() == "TRI") {
                    $q->addWhere("c.ca_transporte = ?", $this->ids->getIdsProveedor()->getCaTransporte());
                }
                $q->addWhere("c.ca_tipo = ?", $this->ids->getIdsProveedor()->getCaTipo());
            } else {
                $this->form->setTipo("AGE");
                $q->addWhere("c.ca_tipo = ?", "AGE");
            }


            $this->url = "/ids/verIds?modo=" . $this->modo . "&id=" . $this->ids->getCaId();
            $numreferencia = "";
        } else {

            if ($this->idreporte) { // Esta ingresando desde el reporte
                $this->reporte = Doctrine::getTable("Reporte")->find($this->idreporte);
                $this->forward404Unless($this->reporte);
                $this->agente = $this->reporte->getIdsAgente();
                $this->url = "/colsys_php/reportenegocio.php?boton=Consultar&id=" . $this->idreporte;

                $numreferencia = $this->reporte->getCaConsecutivo();


                $q->addWhere("c.ca_tipo = ?", "AGE");
            } else {// Esta ingresando desde la referencia
                $numreferencia = str_replace("_", ".", $request->getParameter("referencia"));
                $this->forward404Unless($numreferencia);



                if (substr($numreferencia, 0, 1) == "4" || substr($numreferencia, 0, 1) == "5") {
                    $referencia = Doctrine::getTable("InoMaestraSea")->find($numreferencia);
                    $linea = $referencia->getCaIdlinea();

                    $this->url = "/colsys_php/inosea.php?boton=Consultar&id=" . $numreferencia;


                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", Constantes::MARITIMO);
                }

                if (substr($numreferencia, 0, 1) == "1") {
                    $referencia = Doctrine::getTable("InoMaestraAir")->find($numreferencia);

                    $linea = $referencia->getCaIdlinea();

                    $this->url = "/Coltrans/InoAir/ConsultaReferenciaAction.do?referencia=" . $numreferencia;


                    $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                    $q->addWhere("c.ca_transporte = ?", Constantes::AEREO);
                }


                if (substr($numreferencia, 0, 1) == "3") {
                    $referencia = Doctrine::getTable("InoMaestraExpo")->find($numreferencia);
                    $this->forward404Unless($referencia);

                    $linea = array();
                    if ($referencia->getCaVia() == "Aereo" || $referencia->getCaVia() == "Aereo/Terrestre") {
                        $refAereo = Doctrine::getTable("InoMaestraExpoAir")->find($numreferencia);
                        $this->forward404Unless($refAereo);
                        $linea[] = $refAereo->getCaIdaerolinea();
                        $q->addWhere("c.ca_transporte = ?", Constantes::AEREO);
                    }

                    if ($referencia->getCaVia() == "Maritimo" || $referencia->getCaVia() == "Maritimo/Terrestre") {
                        $refMaritimo = Doctrine::getTable("InoMaestraExpoSea")->find($numreferencia);
                        $this->forward404Unless($refMaritimo);
                        $linea[] = $refMaritimo->getCaIdnaviera();
                        $q->addWhere("c.ca_transporte = ?", Constantes::MARITIMO);
                    }
                    
                    if ($referencia->getCaVia() == "Terrestre" || $referencia->getCaVia() == "Maritimo/Terrestre") {
                        $refTerrestre = Doctrine::getTable("InoMaestraExpoTer")->find($numreferencia);
                        $this->forward404Unless($refTerrestre);
                        $linea[] = $refTerrestre->getCaIdtransportador();
                        $q->addWhere("c.ca_transporte = ?", Constantes::TERRESTRE);
                    }




                    $this->url = "/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=" . $numreferencia;


                    $q->addWhere("c.ca_impoexpo = ?", Constantes::EXPO);
                    //
                }

                $q->addWhere("c.ca_tipo = ? or c.ca_tipo IS NULL", "TRI");

                $this->form->setIdproveedor($linea);


                $this->numreferencia = $numreferencia;
            }

            $this->eventos = Doctrine::getTable("IdsEvento")
                    ->createQuery("e")
                    ->select("e.*")
                    ->where("e.ca_referencia=?", $numreferencia)
                    ->addOrderBy("e.ca_fchcreado ASC")
                    ->execute();
        }
        $q->addWhere("c.ca_activo = ?", true);
        $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
        $criterios = $q->execute();
        $this->form->setCriterios($criterios);
        $this->form->configure();


        if ($request->isMethod('post')) {

            $bindValues = array();
            $bindValues["id"] = $request->getParameter("id");
            $bindValues["tipo_evento"] = $request->getParameter("tipo_evento");
            $bindValues["evento"] = $request->getParameter("evento");
            $bindValues["referencia"] = $request->getParameter("referencia");

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {

                $evento->setCaId($bindValues["id"]);
                $evento->setCaEvento($bindValues["evento"]);
                if ($numreferencia) {
                    $evento->setCaReferencia($numreferencia);
                }else if($bindValues["referencia"]){
                    $evento->setCaReferencia($bindValues["referencia"]);
                }
                $evento->setCaIdcriterio($bindValues["tipo_evento"]);
                $evento->save();
                
                if ($this->modo == "prov") {
                    $usuarios = Doctrine::getTable("Usuario")
                            ->createQuery("u")
                            ->innerJoin("u.UsuarioPerfil p")
                            ->where("p.ca_perfil = ? ", "administracion-de-proveedores")
                            ->addWhere("u.ca_activo = ?", true)
                            ->execute();

                    $email = new Email();
                    $email->setCaUsuenvio($evento->getCaUsucreado());
                    $email->setCaTipo("Eventos");
                    $email->setCaFrom($evento->getUsuCreado()->getCaEmail());
                    $email->setCaReplyto($evento->getUsuCreado()->getCaEmail());
                    $email->setCaFromname($evento->getUsuCreado()->getCaNombre());
                    foreach ($usuarios as $usuario) {
                        $email->addTo($usuario->getCaEmail());
                    }              
                    $email->setCaSubject("Evento reportado: ".$evento->getIds()->getCaNombre());
                    $request->setParameter("format", "email");
                    $request->setParameter("evento", $evento->getCaEvento());
                    $request->setParameter("compania", $evento->getIds()->getCaNombre());
                    $request->setParameter("criterio", $evento->getIdsCriterio()->getCaTipocriterio());
                    $request->setParameter("documento", $evento->getCaReferencia());

                    $mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'ids', 'emailEventos');
                    $email->setCaBodyhtml($mensaje);
                    $email->save();             
                }

                $this->redirect($this->url);
            }
        }

        $this->evento = $evento;
    }

    public function executeFormEventosNew(sfWebRequest $request) {
        //Se debe verificar que la referencia exista y determinar el proveedor.

        $this->modo = $request->getParameter("modo");
        $this->form = new NuevoEventoForm();

        if ($request->getParameter("idevento")) {
            $evento = Doctrine::getTable("IdsEvento")->find($request->getParameter("idevento"));
            $this->forward404Unless($evento);
        } else {
            $evento = new IdsEvento();
        }

        $q = Doctrine::getTable("IdsCriterio")->createQuery("c")->select("c.*");

        $this->idreporte = $request->getParameter("idreporte");
        if ($this->modo) { //Esta ingresando desde la maestra de proveedores
            if ($request->getParameter("idevento")) {
                $this->ids = $evento->getIds();
                $q->addWhere("c.ca_impoexpo = ?", $evento->getIdsCriterio()->getCaImpoexpo());
            } else {
                $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
                $q->addWhere("c.ca_impoexpo = ?", $request->getParameter("impoexpo"));
            }

            $this->form->setTipo($this->ids->getIdsProveedor()->getCaTipo());
            $this->url = "/ids/verIds?modo=" . $this->modo . "&id=" . $this->ids->getCaId();
            $numreferencia = "";
            $q->addWhere("c.ca_tipocriterio = ?", "desempeno");

            $q->addWhere("c.ca_transporte = ?", $this->ids->getIdsProveedor()->getCaTransporte());
        } else {

            if ($this->idreporte) { // Esta ingresando desde el reporte
                $this->reporte = Doctrine::getTable("Reporte")->find($this->idreporte);
                $this->forward404Unless($this->reporte);
                $this->agente = $this->reporte->getIdsAgente();
                $this->url = "/reportesNeg/consultaReporte/id/" . $this->idreporte . "/mpoexpo/" . $this->reporte->getCaImpoexpo() . "/modo/" . $this->reporte->getCaTransporte();

                $numreferencia = $this->reporte->getCaConsecutivo();

                $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                $q->addWhere("c.ca_tipo = ?", "AGE");
            } else {// Esta ingresando desde la referencia
                $numreferencia = str_replace("_", ".", $request->getParameter("referencia"));                
                $this->forward404Unless($numreferencia);
                
                if(!is_numeric($numreferencia))
                {                
                    if (substr($numreferencia, 0, 1) == "4" || substr($numreferencia, 0, 1) == "5") {
                        $referencia = Doctrine::getTable("InoMaestraSea")->find($numreferencia);
                        $linea = $referencia->getCaIdlinea();

                        $this->url = "/colsys_php/inosea.php?boton=Consultar&id=" . $numreferencia;

                        $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                        $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                        $q->addWhere("c.ca_transporte = ?", Constantes::MARITIMO);
                    }
                    else if (substr($numreferencia, 0, 1) == "1") 
                    {                    
                        $referencia = Doctrine::getTable("InoMaestraAir")->find($numreferencia);

                        $linea = $referencia->getCaIdlinea();

                        $this->url = "/Coltrans/InoAir/ConsultaReferenciaAction.do?referencia=" . $numreferencia;

                        $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                        $q->addWhere("c.ca_impoexpo = ?", Constantes::IMPO);
                        $q->addWhere("c.ca_transporte = ?", Constantes::AEREO);
                    }

                    $q->addWhere("c.ca_tipo = ? or c.ca_tipo IS NULL", "TRI");

                    $this->form->setIdproveedor($linea);


                    $this->numreferencia = $numreferencia;
                }
                else
                {
                    
                    
                    $referencia = Doctrine::getTable("InoMaster")->find($numreferencia);
                    
                    $modoRef = Doctrine::getTable("Modo")
                                  ->createQuery("m")
                                  ->addWhere("m.ca_impoexpo = ?", $referencia->getCaImpoexpo())
                                  ->addWhere("m.ca_transporte = ?", $referencia->getCaTransporte())
                                  ->fetchOne();
                
                    $idmodo = $modoRef->getCaIdmodo();
                    
                    $linea = $referencia->getCaIdagente();

                    $this->url = "/ino/verReferencia?modo=".$idmodo."&idmaster=". $numreferencia;

                    $q->addWhere("c.ca_tipocriterio = ?", "desempeno");
                    $q->addWhere("c.ca_impoexpo = ?", $referencia->getCaImpoexpo());
                    $q->addWhere("c.ca_transporte = ?", $referencia->getCaTransporte());
                    
                    $this->form->setIdproveedor($linea);


                    $this->numreferencia = $numreferencia;
                }
            }

            $this->eventos = Doctrine::getTable("IdsEvento")
                    ->createQuery("e")
                    ->select("e.*")
                    ->where("e.ca_referencia=?", $numreferencia)
                    ->addOrderBy("e.ca_fchcreado ASC")
                    ->execute();
        }
        $q->addWhere("c.ca_activo = ?", true);
        $criterios = $q->execute();
        $this->form->setCriterios($criterios);
        $this->form->configure();


        if ($request->isMethod('post')) {

            $bindValues = array();
            $bindValues["id"] = $request->getParameter("id");
            $bindValues["tipo_evento"] = $request->getParameter("tipo_evento");
            $bindValues["evento"] = $request->getParameter("evento");            

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {

                $evento->setCaId($bindValues["id"]);
                $evento->setCaEvento($bindValues["evento"]);
                if ($numreferencia) {
                    $evento->setCaReferencia($numreferencia);
                }
                $evento->setCaIdcriterio($bindValues["tipo_evento"]);
                $evento->save();
                
                $usuarios = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->innerJoin("u.UsuarioPerfil p")
                        ->where("p.ca_perfil = ? ", "asistente-de-pricing")
                        ->addWhere("u.ca_activo = ?", true)
                        ->execute();

                $email = new Email();
                $email->setCaUsuenvio($evento->getCaUsucreado());
                $email->setCaTipo("Eventos");
                $email->setCaFrom($evento->getUsuCreado()->getCaEmail());
                $email->setCaReplyto($evento->getUsuCreado()->getCaEmail());
                $email->setCaFromname($evento->getUsuCreado()->getCaNombre());
                foreach ($usuarios as $usuario) {
                    $email->addTo($usuario->getCaEmail());
                }              
                $email->setCaSubject("Evento reportado: ".$evento->getIds()->getCaNombre());
                $request->setParameter("format", "email");
                $request->setParameter("evento", $evento->getCaEvento());
                $request->setParameter("compania", $evento->getIds()->getCaNombre());
                $request->setParameter("criterio", $evento->getIdsCriterio()->getCaTipocriterio());
                $request->setParameter("documento", $evento->getCaReferencia());

                $mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'ids', 'emailEventos');
                $email->setCaBodyhtml($mensaje);
                $email->save();                

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

    public function executeListadoProveedoresAprobados(sfWebRequest $request) {
        $q= Doctrine::getTable("IdsProveedor")
           ->createQuery("p")
           ->leftJoin("p.Ids i")
           ->leftJoin("i.IdsSucursal s")
           ->leftJoin("s.Ciudad c")
           ->leftJoin("p.IdsTipo t")                

           ->addOrderBy("t.ca_nombre ASC")
           ->addOrderBy("p.ca_transporte ASC")
           ->addOrderBy("i.ca_nombre ASC");
         
         $this->critico= $request->getParameter("critico");
         $this->type= $request->getParameter("type");
         $this->iddoc= $request->getParameter("iddoc");
         
         if( $this->type){
             $q->addWhere("p.ca_fchaprobado IS NOT NULL");
             $q->addWhere("p.ca_controladoporsig = ?",$this->type);
             if($this->iddoc){
                 $q->leftJoin("i.IdsDocumento id");
                 $q->addWhere("id.ca_idtipo = ?", $this->iddoc);
             }
         }elseif( $this->critico){
             $q->addWhere("p.ca_critico = true");
             $q->addWhere("p.ca_activo_impo = ? OR p.ca_activo_expo = ?", array("true","true"));
         }else{
             $q->addWhere("p.ca_fchaprobado IS NULL");
             //$q->addWhere("p.ca_activo_impo = ? OR p.ca_activo_expo = ?", array("true","true"));
         }
         $q->addWhere("p.ca_activo_impo = true OR p.ca_activo_expo=true");
         $this->proveedores = $q->execute();
    }

    public function executeListadoProveedoresInactivos(sfWebRequest $request) {
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

    public function executeFormGrupos(sfWebRequest $request) {
        $this->modo = $request->getParameter("modo");
        $this->form = new NuevoGrupoForm();
        $this->form->setModo($this->modo);
        $this->form->configure();
        $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));

        if ($request->isMethod('post')) {
            $bindValues = array();
            $bindValues["idgrupo"] = $request->getParameter("idgrupo");
            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                $idsGrupo = Doctrine::getTable("Ids")->find($request->getParameter("idgrupo"));
                $idsGrupo->setCaIdgrupo($this->ids->getCaId());
                $idsGrupo->save();
                $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $this->ids->getCaId());
            }
        }
    }

    /*
     * Permite eliminar la pertenecia a un grupo
     *
     * @param sfRequest $request A request object
     */

    public function executeEliminarGrupo(sfWebRequest $request) {
        $this->modo = $request->getParameter("modo");
        $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));

        $idsGrupo = Doctrine::getTable("Ids")->find($request->getParameter("idgrupo"));
        $idsGrupo->setCaIdgrupo($idsGrupo->getCaId());
        $idsGrupo->save();
        $this->redirect("ids/verIds?modo=" . $this->modo . "&id=" . $this->ids->getCaId());
    }

    /*
     * Envia alertas sobre los vencimientos de los documentos
     *
     * @param sfRequest $request A request object
     */

    public function executeAlertasDocumentos(sfWebRequest $request) {
        $this->modo = $request->getParameter("modo");
        $this->fecha = date("Y-m-d", time() + 86400 * 16);
        //echo$this->fecha ;
        $q = Doctrine::getTable("IdsDocumento")
                ->createQuery("d")
                ->select("i.ca_id, d.ca_iddocumento, d.ca_fchvencimiento, t.ca_tipo, i.ca_nombre")
                ->innerJoin("d.Ids i")
                ->innerJoin("d.IdsTipoDocumento t")
                ->where("d.ca_fchvencimiento<=?", $this->fecha)
                ->addWhere("d.ca_iddocumento IN (SELECT dd.ca_iddocumento FROM IdsDocumento dd WHERE dd.ca_idtipo=d.ca_idtipo AND dd.ca_id=d.ca_id AND dd.ca_fchvencimiento IS NOT NULL ORDER BY dd.ca_fchvencimiento DESC LIMIT 1)")
                ->addOrderBy("d.ca_fchvencimiento ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if ($this->modo == "prov") {
            $q->innerJoin("i.IdsProveedor p");
            $q->addWhere("p.ca_controladoporsig = ?", 5);
            $q->addWhere("p.ca_activo_impo = ? OR p.ca_activo_expo = ?", array("true","true"));
            $this->titulo = "Documentos de proveedores controlados por SIG";
        }

        if ($request->getParameter("layout")) {
            $this->setLayout($request->getParameter("layout"));
        }
        /* echo $q->getSqlQuery();
          exit(); */

        $this->documentos = $q->execute();
    }
    
    public function executeAlertasDocumentosEmail(sfWebRequest $request) {


        $this->modo = $request->getParameter("modo");

        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->innerJoin("u.UsuarioPerfil p")
                ->where("p.ca_perfil = ? ", "asistente-de-pricing")
                ->addWhere("u.ca_activo = ?", true)
                ->execute();

        $contentHTML = sfContext::getInstance()->getController()->getPresentationFor('ids', 'alertasDocumentos');

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaTipo("Not. Vencimiento");
        $email->setCaFrom("no-reply@coltrans.com.co");
        $email->setCaReplyto("no-reply@coltrans.com.co");
        $email->setCaFromname("Colsys");
        foreach ($usuarios as $usuario) {
            $email->addTo($usuario->getCaEmail());
        }
        $email->setCaSubject("Vencimiento de documentos");
        $email->setCaBodyhtml($contentHTML);

        $email->save();
        //$email->send();

        return sfView::NONE;
    }
    
    public function executeInactivarProveedores(sfWebRequest $request) {
        
        $this->modo = $request->getParameter("modo");
        $this->fecha = date("Y-m-d");
        //echo$this->fecha ;
        $q = Doctrine::getTable("IdsProveedor")
                ->createQuery("p")
                ->where("p.ca_fchvencimiento<?", $this->fecha)
                ->addOrderBy("p.ca_fchvencimiento ASC");
        
        $vencidos = $q->execute();
        
        if($vencidos){
            foreach($vencidos as $vencido){
                $vencido->setCaActivoImpo(false);
                $vencido->setCaActivoExpo(false);
                $vencido->save();
            }
        }
        
        if ($request->getParameter("layout")) {
            $this->setLayout($request->getParameter("layout"));
        }
    }

    public function executeVerificarListaClinton(sfWebRequest $request) {
        $id = $request->getParameter("id");

        if ($id) {
            $this->ids = Doctrine::getTable("Ids")->find($request->getParameter("id"));
            $this->forward404Unless($this->ids);
        }
        $this->modo = $request->getParameter("modo");

        $q = Doctrine_Manager::getInstance()->connection();


        if ($request->getParameter("layout")) {
            $this->setLayout($request->getParameter("layout"));
        }

        $query = "select * from tb_parametros where ca_casouso = 'CU065' and ca_identificacion = 1";
        $stmt = $q->execute($query);
        $row = $stmt->fetch();
        $this->fechaActualizacion = $row["ca_valor2"];
        $cond = "";
        if ($id) {
            $from = "select * from ids.tb_ids where ca_id = $id";
        } else {
            $from = "select * from ids.tb_ids ids inner join ids.tb_proveedores p on p.ca_idproveedor = ids.ca_id  where ca_controladoporsig= true";
        }

        $query = "select 	cl.ca_idalterno, cl.ca_nombre, sdnm.*, sdid.*, sdal.* "; //, sdak.*
        $query.= "		from ( $from ) cl ";
        $query.= "		LEFT OUTER JOIN tb_sdn sdnm ";
        $query.= "		ON ( fun_similarpercent(cl.ca_nombre, textcat(case when sdnm.ca_firstname IS NULL then '' else sdnm.ca_firstname end, case when sdnm.ca_lastname IS NULL then '' else sdnm.ca_lastname end)) >90 ) ";
        $query.= "		LEFT OUTER JOIN tb_sdnid sdid ";
        $query.= "		ON ( fun_similarpercent(cl.ca_idalterno::text, sdid.ca_idnumber) >90 ) ";
        $query.= "		LEFT OUTER JOIN tb_sdnaka sdal ";
        $query.= "		ON ( fun_similarpercent(cl.ca_nombre, textcat(case when sdal.ca_firstname  IS NULL then '' else sdal.ca_firstname end, case when sdal.ca_lastname  IS NULL then '' else sdal.ca_lastname end)) >90 ) ";
        //$query.= "		LEFT OUTER JOIN tb_sdnaka sdak ";
        //$query.= "		ON ( fun_similarpercent(cl.ca_nombres||' '||cl.ca_papellido||' '||cl.ca_sapellido, textcat(case when nullvalue(sdak.ca_firstname) then '' else sdak.ca_firstname end, case when nullvalue(sdak.ca_lastname) then '' else sdak.ca_lastname end)) >90 ) ";
        //$query.= "		LEFT OUTER JOIN tb_ciudades ciu ";
        //$query.= "		ON (cl.ca_idciudad = ciu.ca_idciudad) ";
        //$query.= "		where NOT nullvalue(sdnm.ca_uid) or NOT nullvalue(sdid.ca_uid) or NOT nullvalue(sdak.ca_uid) ";
        $query.= "     order by cl.ca_nombre";

        $stmt = $q->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        @$stmt->execute();
        $this->stmt = $stmt;

        $this->id = $id;
    }

    /**
     * Envia un email a las personas de pricing con las coincidencia de la lista clinton
     *
     * @param sfRequest $request A request object
     */
    public function executeEmailListaClintonProveedores(sfWebRequest $request) {

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaTipo("Not. Lista OFAC");
        $email->setCaFrom("no-reply@coltrans.com.co");
        $email->setCaReplyto("no-reply@coltrans.com.co");
        $email->setCaFromname("Colsys");
        //$email->addTo("abotero@coltrans.com.co");


        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->innerJoin("u.UsuarioPerfil p")
                ->where("p.ca_perfil = ? ", "asistente-de-pricing")
                ->addWhere("u.ca_activo = ?", true)
                ->execute();
        foreach ($usuarios as $usuario) {
            $email->addTo($usuario->getCaEmail());
        }

        $email->setCaSubject("Verificación Lista OFAC");
        $request->setParameter("modo", "prov");
        $request->setParameter("layout", "email");
        $contentHTML = sfContext::getInstance()->getController()->getPresentationFor('ids', 'verificarListaClinton');
        $email->setCaBodyhtml($contentHTML);

        $email->save();
        //$email->send();


        return sfView::NONE;
    }

    /**
     * Muestra el formulario de creación y edicion de proveedores
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarAgente(sfWebRequest $request) {

        $conn = Doctrine::getTable("IdsAgente")->getConnection();
        $conn->beginTransaction();
        try {
            $nivel = $this->getNivel();
            $modo = $request->getParameter("modo");
            if ($nivel >= 3) {
                if ($modo == "agentes") {
                    $id = $request->getParameter("id");
                    $this->forward404Unless($id);
                    $agente = Doctrine::getTable("IdsAgente")->find($id);
                    $this->forward404Unless($agente);
                    $ids = $agente->getIds();
                    $agente->delete($conn);
                    $ids->delete($conn);
                    $conn->commit();
                    Utils::deleteCache();

                    $this->getUser()->log("Elimina agente: " . $ids->getCaId() . " " . $ids->getCaNombre());
                    $this->responseArray = array("success" => true);
                } else {
                    throw new Exception("No implementado");
                }
            } else {
                throw new Exception("Nivel de privilegios no adecuado");
            }
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    /**
     * Muestra los documentos que le corresponden a cada proveedor.
     *
     * @param sfRequest $request A request object
     */
    public function executeDocumentosPorTipo(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel < 0) {
            $this->forward404();
        }

        $this->modo = $request->getParameter("modo");

        $this->forward404Unless($this->modo);

        $q = Doctrine::getTable("IdsTipo")
                ->createQuery("t")
                ->addOrderBy("t.ca_nombre");

        if ($this->modo == "prov") {
            $q->addWhere("t.ca_aplicacion = ? ", "Proveedores");
        }


        $this->tipos = $q->execute();
    }

    /**
     * Formulario qeu agrega los documentos que le corresponden a cada proveedor.
     *
     * @param sfRequest $request A request object
     */
    public function executeFormDocumentosPorTipo(sfWebRequest $request) {

        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }

        $this->form = new NuevoDocumentoPorTipoForm();
        $this->form->configure();
        if ($request->getParameter("iddocumentosxtipo")) {
            $docPorTipo = Doctrine::getTable("IdsDocumentoPorTipo")->find($request->getParameter("iddocumentosxtipo"));
            $this->forward404Unless($docPorTipo);
        } else {
            $docPorTipo = new IdsDocumentoPorTipo();
        }

        $this->modo = $request->getParameter("modo");
        $this->forward404Unless($this->modo);

        if ($request->isMethod('post')) {
            $bindValues = array();
            $bindValues["tipo"] = $request->getParameter("tipo");
            $bindValues["idtipo"] = $request->getParameter("idtipo");
            $bindValues["controladoporsig"] = $request->getParameter("controladoporsig");
            $bindValues["solo_si_aplica"] = $request->getParameter("solo_si_aplica");
            if ($bindValues["tipo"] == "TRI" || $bindValues["tipo"] == "TRN") {
                $bindValues["transporte"] = $request->getParameter("transporte");
                $bindValues["impoexpo"] = $request->getParameter("impoexpo");
            } else {
                $bindValues["transporte"] = null;
                $bindValues["impoexpo"] = null;
            }

            if (!$bindValues["transporte"]) {
                $bindValues["transporte"] = "N/A";
            }

            if (!$bindValues["impoexpo"]) {
                $bindValues["impoexpo"] = "N/A";
            }


            $this->form->bind($bindValues);
            if ($this->form->isValid()) {

                $docPorTipo->setCaIdtipo($bindValues["idtipo"]);
                $docPorTipo->setCaTipo($bindValues["tipo"]);
                $docPorTipo->setCaTransporte($bindValues["transporte"]);
                $docPorTipo->setCaControladoxsig($bindValues["controladoporsig"]);
                $docPorTipo->setCaImpoexpo($bindValues["impoexpo"]);
                if( $bindValues["solo_si_aplica"] ){
                    $docPorTipo->setCaSoloSiAplica(true);                
                }else{
                    $docPorTipo->setCaSoloSiAplica(false);                
                }
                $docPorTipo->save();
                $this->redirect("ids/documentosPorTipo?modo=" . $this->modo);
            }
        }



        $this->docPortipo = $docPorTipo;

        $this->tipo = $request->getParameter("tipo");
        $this->forward404Unless($this->tipo);
    }

    /**
     * Elimina los documentos que le corresponden a cada proveedor.
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarDocumentosPorTipo(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }


        $this->modo = $request->getParameter("modo");
        $this->forward404Unless($this->modo);

        $this->forward404Unless($request->getParameter("iddocumentosxtipo"));
        $docPorTipo = Doctrine::getTable("IdsDocumentoPorTipo")->find($request->getParameter("iddocumentosxtipo"));
        $this->forward404Unless($docPorTipo);
        $docPorTipo->delete();


        $this->redirect("ids/documentosPorTipo?modo=" . $this->modo);
    }

    /*
     * Envia alertas sobre los vencimientos de los documentos
     *
     * @param sfRequest $request A request object
     */

    public function executeNotificacionDocumentosVencidos(sfWebRequest $request) {
        $this->modo = $request->getParameter("modo");
        $this->fecha = date("Y-m-d", time() + 86400 * 30);
        //echo$this->fecha ;
        $q = Doctrine::getTable("IdsDocumento")
                ->createQuery("d")
                ->select("d.*, i.*, t.*")
                ->innerJoin("d.Ids i")
                ->innerJoin("d.IdsTipoDocumento t")
                ->innerJoin("t.IdsDocumentoPorTipo dxt")
                ->addWhere("d.ca_fchvencimiento<=?", $this->fecha)
                ->addWhere("dxt.ca_controladoxsig=?", true)
                ->addWhere("d.ca_iddocumento IN (SELECT dd.ca_iddocumento FROM IdsDocumento dd WHERE dd.ca_idtipo=d.ca_idtipo AND dd.ca_id=d.ca_id ORDER BY dd.ca_fchvencimiento DESC LIMIT 1)")
                ->addOrderBy("i.ca_nombre ASC")
                ->addOrderBy("d.ca_fchvencimiento ASC");

        
        $q->innerJoin("i.IdsProveedor p");
        $q->select("d.*, i.*, p.*");
        $q->addWhere("p.ca_controladoporsig = ?", 5);
        $this->titulo = "Documentos de proveedores controlados por SIG";
                
        if ($request->getParameter("layout")) {
            $this->setLayout($request->getParameter("layout"));
        }
       
        $documentos = $q->execute();

        $resultados = array();
        $resultadosVisita = array();

        //Se agrupan los documentos por ID
        foreach ($documentos as $documento) {

            if($documento->getCaIdtipo() != 9){ // Documento Visita de Proveedores
                if (!isset($resultados[$documento->getCaId()])) {
                    $resultados[$documento->getCaId()] = array();
                    $resultados[$documento->getCaId()]["ids"] = $documento->getIds();
                    $resultados[$documento->getCaId()]["docs"] = array();
                }

                $resultados[$documento->getCaId()]["docs"][] = $documento;
            }else{
                if (!isset($resultadosVisita[$documento->getCaId()])) {
                    $resultadosVisita[$documento->getCaId()] = array();
                    $resultadosVisita[$documento->getCaId()]["ids"] = $documento->getIds();
                    $resultadosVisita[$documento->getCaId()]["nombre"] = $documento->getIds()->getCaNombre();
                    $resultadosVisita[$documento->getCaId()]["docs"] = array();
                    $resultadosVisita[$documento->getCaId()]["jefe"] = $documento->getIds()->getIdsProveedor()->getCaJefecuenta();
                }

                $resultadosVisita[$documento->getCaId()]["docs"][] = $documento;
            }
        }

        //Se genera el correo y luego se despacha a cada contacto.
        foreach ($resultados as $resultado) {

            $email = new Email();

            $ids = $resultado["ids"];
            $contactos = Doctrine::getTable("IdsContacto")
                    ->createQuery("c")
                    ->innerJoin("c.IdsSucursal s")
                    ->addWhere("s.ca_id = ?", $ids->getCaId())
                    ->addWhere("c.ca_notificar_vencimientos = ?", true)
                    ->addWhere("c.ca_fcheliminado IS NULL")
                    ->addWhere("c.ca_email IS NOT NULL")
                    ->execute();
            if (count($contactos) == 0) {
                continue;
            }

            foreach ($contactos as $contacto) {
                $email->addTo($contacto->getCaEmail());
            }
            
            $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->innerJoin("u.UsuarioPerfil p")
                ->where("p.ca_perfil = ? ", "asistente-de-pricing")
                ->addWhere("u.ca_activo = ?", true)
                ->execute();
            
            $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "ids" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
            $textos = sfYaml::load($config);

            $txt = "";
            
            $documentos = $resultado["docs"];
            foreach ($documentos as $documento) {
                //echo $documento->getCaId()." ".$documento->getIds()->getCaNombre()." ".$documento->getIdsTipoDocumento()->getCaTipo()."<br />";
                if ($documento->getCaFchvencimiento() <= date("Y-m-d")) {
                    $venc = "Venció";
                } else {
                    $venc = "Vence";
                }
                $txt.=" - " . $documento->getIdsTipoDocumento()->getCaTipo() . " " . $venc . " " . Utils::fechaMes($documento->getCaFchvencimiento()) . "\n";
            }


            $msg = sprintf($textos['mensajeEmail'], $txt);

            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("Visita");
            $email->setCaIdcaso($documento->getCaId());
            $email->setCaFrom("pricing@coltrans.com.co");
            $email->setCaFromname("Pricing & Procurement Coltrans S.A.");
            $email->setCaSubject($textos['asuntoEmail']);
            $email->setCaReplyto("pricing@coltrans.com.co");
            foreach($usuarios as $usuario){
                $email->addCc($usuario->getCaEmail());
            }
            $email->setCaBody($msg);
            $email->setCaBodyhtml(Utils::replace($msg));

            $email->save(); //guarda el cuerpo del mensaje
            
        }
        
        foreach ($resultadosVisita as $resultadoVisita) {

            $idJefe = $resultadoVisita["jefe"];
            
            if (!$idJefe) {
                continue;
            }
            
            $q = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->addWhere("u.ca_login = ?", $idJefe)
                    ->addWhere("u.ca_activo IS TRUE");
            
            $emailJefe = $q->fetchOne();

            $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "ids" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
            $textos = sfYaml::load($config);

            $txt = "";

            $documentos = $resultadoVisita["docs"];
            foreach ($documentos as $documento) {
                if ($documento->getCaFchvencimiento() <= date("Y-m-d")) {
                    $venc = "Venció";
                } else {
                    $venc = "Vence";
                }
                $txt.=" - " . $documento->getIdsTipoDocumento()->getCaTipo() . " " . $venc . " " . Utils::fechaMes($documento->getCaFchvencimiento()) . "\n";
            }
            

            $msg = sprintf($textos['mensajeEmail'], $txt);
            
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("Sol. DocInternos");
            $email->setCaIdcaso($documento->getCaId());
            $email->setCaFrom("pricing@coltrans.com.co");
            $email->setCaFromname("Pricing & Procurement Coltrans S.A.");
            $email->setCaSubject($textos['asuntoEmail']."-".$resultadoVisita["nombre"]);
            $email->setCaReplyto("pricing@coltrans.com.co");
            
            $email->addTo($emailJefe->getCaEmail());
            $email->setCaBody($msg);
            $email->setCaBodyhtml(Utils::replace($msg));

            $email->save(); //guarda el cuerpo del mensaje
            //$email->send();
        }
        return sfView::NONE;
    }

    /*
      Muestra el historal de mensajes enviados sobre los vencimientos de los documentos
     *
     * @param sfRequest $request A request object
     */

    public function executeHistorialMensajes(sfWebRequest $request) {

        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }

        $this->forward404Unless($request->getParameter("id"));

        $this->emails = Doctrine::getTable("Email")
                ->createQuery("e")
                ->addWhere("e.ca_tipo = ? ", "Sol. documentos")
                ->addWhere("e.ca_idcaso = ? ", $request->getParameter("id"))
                ->execute();

        $this->id = $request->getParameter("id");
        $this->modo = $request->getParameter("modo");
    }
    
    
     /*
     *  Lista los criterios de evaluació n para su posterior edición.
     *
     * @param sfRequest $request A request object
     */

    public function executeListadoCriteriosEval(sfWebRequest $request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel < 2) {
            $this->forward404();
        }
        $this->nivel = 6;
        
        $q =Doctrine::getTable("IdsCriterio")
                ->createQuery("c")
                ->innerJoin("c.IdsTipo t") 
                ->addWhere("c.ca_activo=?", true)
                ->addWhere("c.ca_tipo != ?", "AGE")  
                ->addOrderBy("t.ca_nombre, c.ca_tipocriterio, c.ca_impoexpo, c.ca_transporte");                
        
        $this->criterios = $q->execute();
        
        
    }
    
    /*
     *  Lista los criterios de evaluació n para su posterior edición.
     *
     * @param sfRequest $request A request object
     */

    public function executeFormCriterios(sfWebRequest $request) {
        
        
        $this->nivel = $this->getNivel();
        $this->nivel = 6;
        
        if ($this->nivel < 6) {
            $this->forward404();
        }
        
        
        
        $this->modo = $request->getParameter("modo");
        
        $tipoprov = $request->getParameter("tipoprov");   
        $this->tipoProv = Doctrine::getTable("IdsTipo")->find($tipoprov);
        $this->forward404unless( $this->tipoProv );
        
        $tipo = $request->getParameter("tipo");
        $impoexpo = $request->getParameter("impoexpo");
        $transporte = $request->getParameter("transporte");

        $q = Doctrine::getTable("IdsCriterio")->createQuery("c");
        $q->addWhere("c.ca_tipocriterio = ?", $tipo );
        $q->addWhere("c.ca_tipo = ?", $tipoprov );
        if( $impoexpo ){
            $q->addWhere("c.ca_impoexpo = ?", $impoexpo);
        }else{
            $q->addWhere("c.ca_impoexpo IS NULL");
        }
        
        if( $transporte ){
            $q->addWhere("c.ca_transporte = ?", $transporte);
        }else{
            $q->addWhere("c.ca_transporte IS NULL");
        }
        
        $q->addWhere("c.ca_activo = ?", true);
        $this->criterios = $q->execute();


        $this->form = new CriteriosForm();
        $this->form->setCriterios($this->criterios);
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();
            
            $bindValues["impoexpo"] = $request->getParameter("impoexpo");
            $bindValues["transporte"] = $request->getParameter("transporte");
            $bindValues["tipoprov"] = $request->getParameter("tipoprov");
            $bindValues["tipo"] = $request->getParameter("tipo");
            foreach ($this->criterios as $criterio) {
                $bindValues["ponderacion_" . $criterio->getCaIdcriterio()] = $request->getParameter("ponderacion_" . $criterio->getCaIdcriterio());
                
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                $criterios = $request->getParameter("idcriterio");
                foreach ($criterios as $idcriterio) {
                    $crit = Doctrine::getTable("IdsCriterio")->find( $idcriterio );                    
                    $pond = trim($request->getParameter("ponderacion_" . $idcriterio));
                    $crit->setCaPonderacion( $pond ); 
                    /*if( $pond==0 ){
                        $crit->setCaActivo( false ); 
                    }*/
                    $crit->save();
                }

                $this->redirect("ids/listadoCriteriosEval?modo=" . $this->modo);
            }
        }
                
        
        $this->tipo = $tipo;
        $this->tipoprov = $tipoprov;
        $this->transporte = $transporte;
        $this->impoexpo = $impoexpo;
    }
    
    
    /*
     *  Lista los criterios de evaluació n para su posterior edición.
     *
     * @param sfRequest $request A request object
     */

    public function executeFormNuevoCriterio(sfWebRequest $request) {
        
        
        $this->nivel = $this->getNivel();
        $this->nivel = 6;
        
        if ($this->nivel < 6) {
            $this->forward404();
        }
        
        
        $modo = $request->getParameter("modo");
        
        $tipoprov = $request->getParameter("tipoprov");   
        $this->tipoProv = Doctrine::getTable("IdsTipo")->find($tipoprov);
        $this->forward404unless( $this->tipoProv );
        
        $this->form = new NuevoCriterioForm();
        $this->form->setCriterios($this->criterios);
        $this->form->configure();

        if ($request->isMethod('post')) {
            
            $bindValues = array();
            
            $bindValues["tipoprov"] = $request->getParameter("tipoprov");
            $bindValues["tipo_eval"] = $request->getParameter("tipo_eval");
            $bindValues["nombre"] = $request->getParameter("nombre");
           

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {            
                $criterio = new IdsCriterio( $bindValues["tipoprov"] );
                $criterio->setCaTipo( $bindValues["tipoprov"] );
                $criterio->setCaTipocriterio( $bindValues["tipo_eval"] );
                $criterio->setCaCriterio( $bindValues["nombre"] );
                $criterio->setCaActivo( true );
                $criterio->setCaPonderacion( 0 );
                $criterio->save();
                
                $this->redirect("ids/listadoCriteriosEval?modo=".$modo);
            }
        }
        $this->modo = $modo;
    }
    
    
    /*
     *  Lista los criterios de evaluació n para su posterior edición.
     *
     * @param sfRequest $request A request object
     */

    public function executeDesactivarCriterio(sfWebRequest $request) {
        
        
        $this->nivel = $this->getNivel();
        $this->nivel = 6;
        
        if ($this->nivel < 6) {
            $this->forward404();
        }
        
        
        $modo = $request->getParameter("modo");
        
        $idcriterio = $request->getParameter("idcriterio");  
        $this->forward404unless( $idcriterio );
        $criterio = Doctrine::getTable("IdsCriterio")->find($idcriterio);
        $this->forward404unless( $criterio );
        $criterio->setCaActivo( false );
        $criterio->save();
        $this->redirect("ids/listadoCriteriosEval?modo=".$modo);
        
    }
    
    public function executeListadoAgentes(sfWebRequest $request) {
        
        $estado = $request->getParameter("estado");
         
        $q= Doctrine::getTable("Ids")
                ->createQuery("i")
                ->innerJoin("i.IdsAgente ag")
                ->innerJoin("i.IdsSucursal sc")
                ->innerJoin("sc.Ciudad c")
                ->innerJoin("c.Trafico t");
        
        if($estado=="actoficial" || $estado == "actnoficial"){
            $q->addWhere("ag.ca_activo = ?",true);
        }else if($estado=="inactivo"){
            $q->addWhere("ag.ca_activo = ?",false);
        }
        
        if($estado=="actoficial"){
            $q->addWhere("ag.ca_tipo = ?","Oficial");
        }else if($estado=="actnoficial"){
            $q->addWhere("ag.ca_tipo = ?","No Oficial");
        }
                
        if($estado=="tplogistics"){
            $q->addWhere("ag.ca_tplogistics = ?",true);
        }        
        
        $q->addOrderBy("t.ca_nombre ASC");
        $q->addOrderBy("i.ca_nombre ASC");
                
        $this->agentes = $q->execute();
        $this->estado = $estado;
    }
    
    public function executeAprobarProveedor(sfWebRequest $request) {
        
        $id = $request->getParameter("id");

        if ($id) {
            $this->proveedor = Doctrine::getTable("IdsProveedor")->find($id);
            $this->forward404Unless($this->proveedor);
        }
        
        $jefeCta = $this->proveedor->getCaJefecuenta();
        $user = $this->getUser()->getUserId();
        $this->usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        
        if($jefeCta == $user){
            $this->proveedor->setCaFchaprobado(date('Y-m-d'));
            $this->proveedor->setCaUsuaprobado($this->getUser()->getUserId());
            $this->proveedor->save();
            $this->respuesta = "Aprobado";
        }else{
            $this->respuesta = "Denegado";
        }
    }
    
    public function executeEmailAprobacion(sfWebRequest $request){
        
        //$this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));        
        $this->setLayout("none");
        
        $this->nombre = $request->getParameter("nombre");
        $this->id = $request->getParameter("id");
        
        
    }
    
    public function executeEmailEventos(sfWebRequest $request){
        
        $this->setLayout("email");
        
        $this->compania = $request->getParameter("compania");
        $this->evento = $request->getParameter("evento");
        $this->criterio = $request->getParameter("criterio");
        $this->documento = $request->getParameter("documento");
    }
    
    public function executeGenerarPDFComunicadoProveedores(sfWebRequest $request){
        
        $this->proveedor = Doctrine::getTable("IdsProveedor")->find($this->getRequestParameter("idproveedor"));        
        $this->forward404Unless($this->proveedor);
        
        $this->ano = $this->getRequestParameter("ano");
        $this->periodo = $this->getRequestParameter("periodo");
        
        $this->filename = $this->getRequestParameter("filename");
        $this->textos = sfYaml::load(sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "ids" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml");

        $this->empresa = Doctrine::getTable("Empresa")->find(2);
        $this->sucursal =  Doctrine::getTable("Sucursal")
                ->createQuery("s")                
                ->where("ca_nombre = 'Bogotá D.C.' and ca_idempresa=2" )
                ->fetchOne();
        
        $this->sucursalProv = Doctrine::getTable("IdsSucursal")
                ->createQuery("s")
                ->where("ca_id = ?", $this->proveedor->getCaIdproveedor())
                ->andWhere("ca_principal = ?", true)
                ->fetchOne();
        
        $contactos = Doctrine::getTable("IdsContacto")
                ->createQuery("c")
                ->where("ca_idsucursal = ?", $this->sucursalProv->getCaIdsucursal())
                ->andWhere("ca_fcheliminado IS NULL")
                ->andWhere("ca_notificar_vencimientos = ?", true)
                ->execute();
        
        $this->contactos = array();
        
        foreach($contactos as $contacto){
            $this->contactos[$contacto->getCaIdcontacto()]["nombre"] = $contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido();
            $this->contactos[$contacto->getCaIdcontacto()]["email"] = $contacto->getCaEmail();            
        }
        
        $this->evaluaciones = Doctrine::getTable("IdsEvaluacion")
                             ->createQuery("e")
                             ->where("e.ca_id=?",$this->proveedor->getCaIdproveedor())
                             ->addWhere("e.ca_ano=?",$this->ano)
                             ->addWhere("e.ca_periodo=?",$this->periodo)
                             ->addOrderBy("e.ca_fchevaluacion")
                             ->execute();
        
        $this->setTemplate("generarPDFComunicadoProveedores");
    }
    
    
    public function executeEnviarComunicadoEmail(sfWebRequest $request){
        
        $this->proveedor = Doctrine::getTable("IdsProveedor")->find($this->getRequestParameter("id"));

        $user = $this->getUser();
        //Crea el correo electronico
        $email = new Email();
        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Envío de Evaluación");
        $email->setCaIdcaso($this->getRequestParameter("id"));
        $email->setCaFrom($user->getEmail());
        $email->setCaFromname($user->getNombre());

        if ($this->getRequestParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }

        $email->setCaReplyto($user->getEmail());

        $recips = explode(",", $this->getRequestParameter("destinatario"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addTo($recip);
                }
            }
        }

        $recips = explode(",", $this->getRequestParameter("cc"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addCc($recip);
                }
            }
        }
        $mensaje = ($this->getRequestParameter("mensaje") . "\n\n");
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());

        $email->addCc($this->getUser()->getEmail());
        
        $email->setCaSubject(($this->getRequestParameter("asunto")));
        $email->setCaBody($mensaje . $usuario->getFirma());
        $email->setCaBodyhtml(Utils::replace($mensaje) . $usuario->getFirmaHTML());

        $email->save(); //guarda el cuerpo del mensaje
       
        
        $directory = $email->getDirectorio();
        if (!is_dir($directory)) {
            @mkdir($directory, 0777, true);
        }

        $fileName = "proveedor" . $this->proveedor->getCaIdproveedor() . ".pdf";
        if (file_exists($fileName)) {
            @unlink($fileName);
        }

        $this->getRequest()->setParameter('filename', $directory . $fileName);
        $this->getRequest()->setParameter('idproveedor', $this->proveedor->getCaIdproveedor());
        sfContext::getInstance()->getController()->getPresentationFor('ids', 'generarPDFComunicadoProveedores');

        $email->addAttachment($email->getDirectorioBase() . $fileName);
        $email->save();
        
        $this->setTemplate("enviarComunicadoEmail");
    }
    
    public function executeVerComunicado() {
        
        $this->proveedor = Doctrine::getTable("IdsProveedor")->find($this->getRequestParameter("id"));
        $this->forward404Unless($this->proveedor);
        
        $this->modo = $this->getRequestParameter("modo");
        $this->ano = $this->getRequestParameter("ano");
        $this->periodo = $this->getRequestParameter("periodo");
        
        $this->textos = sfYaml::load(sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "ids" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml");        
        
        $this->sucursalProv = Doctrine::getTable("IdsSucursal")
                ->createQuery("s")
                ->where("ca_id = ?", $this->proveedor->getCaIdproveedor())
                ->andWhere("ca_principal = ?", true)
                ->fetchOne();
        
        $contactos = Doctrine::getTable("IdsContacto")
                ->createQuery("c")
                ->where("ca_idsucursal = ?", $this->sucursalProv->getCaIdsucursal())
                ->andWhere("ca_fcheliminado IS NULL")
                ->andWhere("ca_notificar_vencimientos = ?", true)
                ->execute();
        
        $this->contactos = "";
        
        foreach($contactos as $contacto){            
            $this->contactos.= $contacto->getCaEmail().",";            
        }
        
        $this->emails = Doctrine::getTable("Email")
                ->createQuery("e")
                ->where("e.ca_tipo = ? AND e.ca_idcaso = ?", array("Envío de Evaluación", $this->proveedor->getCaIdproveedor()))
                ->addOrderBy("e.ca_fchenvio")
                ->execute();
    }
}
?>