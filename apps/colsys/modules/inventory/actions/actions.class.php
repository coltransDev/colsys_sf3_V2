<?php

/**
 * inventory actions.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inventoryActions extends sfActions {
    const RUTINA = "94";

    public function getNivel() {
        $this->nivel = $this->getUser()->getNivelAcceso(inventoryActions::RUTINA);
        if ($this->nivel == -1) {
            $this->forward404();
        }        
        return $this->nivel;
    }

    /**
     * Muestra un listado de la base de datos
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        $this->nivel = $this->getNivel(self::RUTINA);


        $q = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->addWhere("s.ca_idempresa = ?", 2)
                ->addOrderBy("s.ca_nombre");

        
        $this->user = $this->getUser();

        $this->sucursales = $q->execute();
    }

    /*
     * 
     */
    public function executeDatosPanelCategorias($request) {
        $idsucursal = $request->getParameter("idsucursal");
        $q = Doctrine::getTable("InvCategory")
                ->createQuery("c")
                ->addOrderBy("c.ca_parent")
                ->addOrderBy("c.ca_order")
                ->addOrderBy("c.ca_name");

        $idcategoria = intval($request->getParameter("node")) ? intval($request->getParameter("node")) : intval($request->getParameter("idcategoria"));
        if ($idcategoria) {
            $q->addWhere("c.ca_parent = ?", $idcategoria);
            $this->parent = Doctrine::getTable("InvCategory")->find($idcategoria);
        } else {
            $q->addWhere("c.ca_parent IS NULL");
            $this->parent = null;
        }



        $this->categorias = $q->execute();

        $this->idsucursal = $idsucursal;
    }

    /*
     *
     */

    public function executeDatosPanelActivos($request) {

        $idcategory = $request->getParameter("idcategory");
        $this->forward404Unless($idcategory);
        $idsucursal = $request->getParameter("idsucursal");
        $this->forward404Unless($idsucursal);

        $q = Doctrine::getTable("InvActivo")
                ->createQuery("a");

        $mostrarBajas = $request->getParameter("mostrarBajas");

        if ($mostrarBajas == "true") {
            $q->addWhere("a.ca_fchbaja IS NOT NULL");
        } else {
            $q->addWhere("a.ca_fchbaja IS NULL");
        }
        $q->addWhere("a.ca_idcategory = ?", $idcategory);
        $q->addWhere("a.ca_idsucursal = ?", $idsucursal);
        //$q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(500);
        $activos = $q->execute();
        $result = array();
        foreach ($activos as $activo) {
            
            $row = array();
            $row["idactivo"] = utf8_encode($activo->getCaIdactivo());
            $row["idcategory"] = utf8_encode($activo->getCaIdcategory());
            $row["identificador"] = utf8_encode($activo->getCaIdentificador());
            $row["marca"] = utf8_encode($activo->getCaMarca());
            $row["modelo"] = utf8_encode($activo->getCaModelo());
            $row["version"] = utf8_encode($activo->getCaVersion());
            $row["procesador"] = utf8_encode($activo->getCaProcesador());
            $row["memoria"] = utf8_encode($activo->getCaMemoria());
            $row["disco"] = utf8_encode($activo->getCaDisco());
            $row["optica"] = utf8_encode($activo->getCaOptica());
            $row["serial"] = utf8_encode($activo->getCaSerial());
            $row["noinventario"] = utf8_encode($activo->getCaNoinventario());

            $row["fchcompra"] = utf8_encode($activo->getCaFchcompra());
            $row["observaciones"] = utf8_encode($activo->getCaObservaciones());
            $row["contrato"] = utf8_encode($activo->getCaContrato());
            $row["folder"] = utf8_encode(base64_encode($activo->getDirectorioBase()));
            $row["ipaddress"] = utf8_encode($activo->getCaIpaddress());

            $row["proveedor"] = utf8_encode($activo->getCaProveedor());
            $row["factura"] = utf8_encode($activo->getCaFactura());
            $row["reposicion"] = $activo->getCaReposicion() ? utf8_encode(round($activo->getCaReposicion(), 2)) : "";
            $row["so"] = utf8_encode($activo->getCaSo());
            $row["so_serial"] = utf8_encode($activo->getCaSoSerial());
            $row["so_office"] = utf8_encode($activo->getCaOffice());
            $row["so_office_serial"] = utf8_encode($activo->getCaOfficeSerial());
            $row["prgmantenimiento"] = $activo->getCaPrgmantenimiento();
            $row["idsucursal"] = $activo->getCaIdsucursal();
            $row["cantidad"] = $activo->getCaCantidad();
            $row["detalle"] = utf8_encode($activo->getCaDetalle());
            if ($activo->getCaAsignadoa()) {
                $row["asignadoa"] = utf8_encode($activo->getCaAsignadoa());
                $row["asignadoaNombre"] = utf8_encode($activo->getUsuario()->getCaNombre());
                $row["ubicacion"] = utf8_encode($activo->getUsuario()->getCaDepartamento());
                $row["empresa"] = utf8_encode($activo->getUsuario()->getSucursal()->getEmpresa()->getCaNombre());
            }
            $result[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $result);

        $this->setTemplate("responseTemplate");
    }

    /*
     *
     */

    public function executeDatosActivo($request) {
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless($idactivo);

        $copy = $request->getParameter("copy");

        $activo = Doctrine::getTable("InvActivo")->find($idactivo);
        $this->forward404Unless($activo);


        $data = array();
        $data["idcategory"] = $activo->getCaIdcategory();
        $data["marca"] = utf8_encode($activo->getCaMarca());
        $data["modelo"] = utf8_encode($activo->getCaModelo());
        $data["version"] = utf8_encode($activo->getCaVersion());
        $data["ipaddress"] = utf8_encode($activo->getCaIpaddress());
        $data["procesador"] = utf8_encode($activo->getCaProcesador());
        $data["memoria"] = utf8_encode($activo->getCaMemoria());
        $data["disco"] = utf8_encode($activo->getCaDisco());
        $data["optica"] = utf8_encode($activo->getCaOptica());
        $data["so"] = utf8_encode($activo->getCaSo());
        $data["office"] = utf8_encode($activo->getCaOffice());
        $data["ubicacion"] = utf8_encode($activo->getCaUbicacion());
        $data["empresa"] = utf8_encode($activo->getCaEmpresa());
        $data["proveedor"] = utf8_encode($activo->getCaProveedor());
        $data["factura"] = utf8_encode($activo->getCaFactura());
        $data["fchcompra"] = utf8_encode($activo->getCaFchcompra());
        $data["reposicion"] = $activo->getCaReposicion() ? utf8_encode(round($activo->getCaReposicion(), 2)) : "";
        $data["contrato"] = utf8_encode($activo->getCaContrato());
        $data["observaciones"] = utf8_encode($activo->getCaObservaciones());
        $data["software"] = utf8_encode($activo->getCaSoftware());
        $data["prgmantenimiento"] = $activo->getCaPrgmantenimiento();
        $data["cantidad"] = $activo->getCaCantidad();
        $data["detalle"] = utf8_encode($activo->getCaDetalle());
        $data["fchbaja"] = $activo->getCaFchbaja();
        if (!$copy) {
            $data["idactivo"] = $activo->getCaIdactivo();
            $data["identificador"] = $activo->getCaIdentificador();
            $data["noinventario"] = $activo->getCaNoinventario();
            $data["serial"] = $activo->getCaSerial();
            $data["so_serial"] = utf8_encode($activo->getCaSoSerial());
            $data["office_serial"] = utf8_encode($activo->getCaOfficeSerial());
            $data["asignadoa"] = utf8_encode($activo->getCaAsignadoa());
            $data["asignadoaNombre"] = utf8_encode($activo->getUsuario()->getCaNombre());
        } else {
            $data["asignadoa"] = "";
            $data["asignadoaNombre"] = "";
        }

        $this->responseArray = array("success" => true, "data" => $data);



        $this->setTemplate("responseTemplate");
    }

    /*
     *
     */

    public function executeFormActivoGuardar($request) {

        try {
            $nivel = $this->getNivel(self::RUTINA);

            if ($nivel < 0) {
                $this->forward404();
            }


            $identificador = null;
            $idactivo = $request->getParameter("idactivo");
            if ($idactivo) {
                $activo = Doctrine::getTable("InvActivo")->find($idactivo);
                $this->forward404Unless($activo);
            } else {
                $activo = new InvActivo();
                $activo->setCaIdsucursal($request->getParameter("idsucursal"));

                $activo->setCaIdcategory($request->getParameter("idcategory"));
                $cat = Doctrine::getTable("InvCategory")->find($request->getParameter("idcategory"));

                $prefijo = $cat->getPrefijo($request->getParameter("idsucursal"));
                if (($prefijo && !$prefijo->getCaAutonumeric()) || !$prefijo) {
                    if ($request->getParameter("identificador")) {
                        $activo->setCaIdentificador(utf8_decode(strtoupper($request->getParameter("identificador"))));
                    } else {
                        $activo->setCaIdentificador(null);
                    }
                } else {

                    $pre = $prefijo->getCaPrefix() . "-";
                    $value = Doctrine::getTable("InvActivo")
                            ->createQuery("a")
                            ->select("a.ca_identificador")
                            ->addWhere("a.ca_identificador LIKE ?", $pre . "%")
                            ->addOrderBy("a.ca_identificador DESC")
                            ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                            ->execute();



                    if ($value) {
                        $value = str_replace($pre, "", $value);
                        $identificador = $prefijo->getCaPrefix() . "-" . str_pad(intval($value) + 1, $prefijo->getCaPadlength(), "0", STR_PAD_LEFT);
                    } else {
                        $identificador = $prefijo->getCaPrefix() . "-" . str_pad("1", $prefijo->getCaPadlength(), "0", STR_PAD_LEFT);
                    }
                    $activo->setCaIdentificador($identificador);
                }
            }

            $activo->setCaNoinventario(strtoupper($request->getParameter("noinventario")));
            $activo->setCaSerial($request->getParameter("serial"));
            $activo->setCaMarca(utf8_decode($request->getParameter("marca")));
            $activo->setCaModelo(utf8_decode($request->getParameter("modelo")));
            $activo->setCaVersion(utf8_decode($request->getParameter("version")));
            $activo->setCaIpaddress($request->getParameter("ipaddress"));
            $activo->setCaProcesador(utf8_decode($request->getParameter("procesador")));
            $activo->setCaMemoria(utf8_decode($request->getParameter("memoria")));
            $activo->setCaDisco(utf8_decode($request->getParameter("disco")));
            $activo->setCaOptica(utf8_decode($request->getParameter("optica")));
            $activo->setCaSo(utf8_decode($request->getParameter("so")));
            $activo->setCaSoSerial(utf8_decode($request->getParameter("so_serial")));
            $activo->setCaOffice(utf8_decode($request->getParameter("office")));
            $activo->setCaOfficeSerial(utf8_decode($request->getParameter("office_serial")));
            $activo->setCaUbicacion(utf8_decode($request->getParameter("ubicacion")));
            $activo->setCaEmpresa(utf8_decode($request->getParameter("empresa")));
            $activo->setCaProveedor(utf8_decode($request->getParameter("proveedor")));
            $activo->setCaFactura(utf8_decode($request->getParameter("factura")));
            $activo->setCaSoftware(utf8_decode($request->getParameter("software")));
            if ($request->getParameter("asignadoa")) {
                $activo->setCaAsignadoa($request->getParameter("asignadoa"));
            }

            if ($request->getParameter("fchcompra")) {
                $activo->setCaFchcompra($request->getParameter("fchcompra"));
            } else {
                $activo->setCaFchcompra(null);
            }

            if ($request->getParameter("fchbaja")) {
                $activo->setCaFchbaja($request->getParameter("fchbaja"));
            } else {
                $activo->setCaFchbaja(null);
            }

            if (floatval($request->getParameter("reposicion"))) {
                $activo->setCaReposicion(floatval($request->getParameter("reposicion")));
            } else {
                $activo->setCaReposicion(null);
            }

            if ($request->getParameter("contrato")) {
                $activo->setCaContrato(utf8_decode($request->getParameter("contrato")));
            } else {
                $activo->setCaContrato(null);
            }

            if ($request->getParameter("observaciones")) {
                $activo->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
            } else {
                $activo->setCaObservaciones(null);
            }

            if ($request->getParameter("prgmantenimiento")) {
                $activo->setCaPrgmantenimiento($request->getParameter("prgmantenimiento"));
            } else {
                $activo->setCaPrgmantenimiento(null);
            }

            if ($request->getParameter("detalle")) {
                $activo->setCaDetalle(utf8_decode($request->getParameter("detalle")));
            } else {
                $activo->setCaDetalle(null);
            }

            if ($request->getParameter("cantidad")) {
                $activo->setCaCantidad($request->getParameter("cantidad"));

                if ($idactivo) {

                    //Verifica que no hayan mas licencias asignadas que las registradas                          
                    $asig = Doctrine::getTable("InvActivo")
                            ->createQuery("a")
                            ->innerJoin("a.InvCategory c")
                            ->leftJoin("a.InvAsignacionSoftware as")
                            ->select("a.ca_cantidad as q, count(*) as assigned")
                            ->addWhere("a.ca_idactivo=?", $idactivo)
                            ->addGroupBy("a.ca_cantidad")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();
                    if ($asig) {
                        if ($request->getParameter("cantidad") < $asig[0]["a_assigned"]) {
                            throw new Exception(" La cantidad de licencias ha sobrepasada el numero de licencias asignadas. Asignadas: " . $asig[0]["a_assigned"]);
                        }
                    }
                }
            } else {
                $activo->setCaCantidad(null);
            }



            $activo->save();
            $this->responseArray = array("success" => true, "idactivo" => $activo->getCaIdactivo(), "identificador" => $identificador);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarActivo(sfWebRequest $request) {
        $idactivo = $request->getParameter("idactivo");

        if ($idactivo) {
            $activo = Doctrine::getTable("InvActivo")->find($idactivo);
            $this->forward404Unless($activo);

            try {
                $activo->delete();
                $this->responseArray = array("success" => true, "id" => $request->getParameter("id"));
            } catch (Exception $e) {
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        } else {
            $this->responseArray = array("success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    /**
     * Guarda un seguimiento a un activo
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarSeguimiento(sfWebRequest $request) {

        //$this->nivel = $this->getNivel();
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless($idactivo);
        $this->user = $this->getUser();
        
        $chkmantenimiento = $request->getParameter( "chkmantenimiento-checkbox" );
        $chkseguimiento = $request->getParameter( "chkseguimiento-checkbox" );
        $fchMantenimiento = Utils::parseDate($request->getParameter("fchMantenimiento"));
        $textMantenimiento = $request->getParameter("text_mantenimiento");
        $textSeguimiento = $request->getParameter("text_seguimiento");
        
        $usuarios = UsuarioTable::getCoordinadoresMantenimiento();
        foreach( $usuarios as $usuario ){
				$logins[]=$usuario->getCaLogin();
        }
        
        $q = Doctrine::getTable("InvMantenimientoEtapas")
                ->createQuery("e");
        $etapas = $q->execute();
        $result = array();
        
        $this->etapas = $etapas;
        
        if($chkmantenimiento&&$chkmantenimiento=='on'){

            $mantenimiento = new InvMantenimiento();
            $mantenimiento->setCaIdactivo($idactivo);
            $mantenimiento->setCaFchmantenimiento($fchMantenimiento);
            $mantenimiento->setCaObservaciones(utf8_decode($textMantenimiento));
            $mantenimiento->save();
            
            $idman = $mantenimiento->getCaIdmantenimiento();
            
            $this->idman = $idman;
            
            $activo = Doctrine::getTable("InvActivo")->find($idactivo);
            $activo->setCaPrgmantenimiento(Utils::addDate( $fchMantenimiento, 0,0,1));
            $activo->save();
            
            $idsucursal = $activo->getCaIdsucursal();
            
            $contetapas = 0;
            foreach($etapas as $etapa){
                $contetapas++;
            }
                for( $i=1; $i<=$contetapas; $i++ ){
                    $idetapa = $request->getParameter($i); 
                    if($idetapa){
                        $labores = new InvMantenimientoLabores();
                        $labores->setCaIdetapa($i);
                        $labores->setCaIdmantenimiento($idman);
                        $labores->save();
                    }
                }
            $mantenimiento = Doctrine::getTable("InvMantenimiento")->find($idman);
        
            //Env�a email informando mantenimiento al usuario que tiene asignado el equipo

            $email = new Email();		
            $email->setCaUsuenvio($this->getUser()->getUserId());
            $email->setCaTipo("Mantenimiento"); 		
            $email->setCaIdcaso( $idman );
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");

            $email->setCaSubject( "Mantenimiento Preventivo Activo # ".$mantenimiento->getInvActivo()->getCaIdentificador());				
            $texto = "Se ha realizado un nuevo mantenimiento \n\n<br /><br />" ;					
            $request->setParameter("format", "email" );	
            $request->setParameter("idman", $idman );	
            $texto.= sfContext::getInstance()->getController()->getPresentationFor( 'inventory', 'emailMantenimiento');

            $email->setCaBodyhtml( $texto );
            $email->addTo($mantenimiento->getInvActivo()->getUsuario()->getCaEmail());

            foreach( $logins as $login ){
                $usuario = Doctrine::getTable("Usuario")->find( $login );
                $email->addCc( $usuario->getCaEmail() );
            }

            $this->setLayout("none");

            $email->save();

            $texto = sfContext::getInstance()->getController()->getPresentationFor('inventory', 'verSeguimientos');

            $this->responseArray = array("success" => true, "idactivo" => $idactivo, "info" => utf8_encode($texto));
            $this->setTemplate("responseTemplate");
     
        }elseif($chkseguimiento&&$chkseguimiento=='on'){
            
            $respuesta = $request->getParameter("respuesta");
            $idman = $request->getParameter("idman");
            
            $mantenimiento = Doctrine::getTable("InvMantenimiento")->find($idman);
            
            $seguimiento = new InvSeguimiento();
            $seguimiento->setCaIdactivo($idactivo);
            $seguimiento->setCaText(utf8_decode($textSeguimiento));
            $seguimiento->save();
            
            if($respuesta=="no"){
                //$this->redirect("intranet");
                $email = new Email();		
                $email->setCaUsuenvio($this->getUser()->getUserId());
                $email->setCaTipo("Rta. Mantenimiento"); 		
                $email->setCaIdcaso( $idman );
                $email->setCaFrom("no-reply@coltrans.com.co");
                $email->setCaFromname("Colsys Notificaciones");

                $email->setCaSubject( "Respuesta Mantenimiento Preventivo Activo # ".$mantenimiento->getInvActivo()->getCaIdentificador());				
                $texto = "Se dado una respuesta al mantenimiento en referencia \n\n<br /><br />" ;					
                $request->setParameter("format", "email" );	
                $request->setParameter("idactivo", $idactivo );
                $request->setParameter("idman", $idman );	
                $request->setParameter("respuesta", "no" );	
                $texto.= sfContext::getInstance()->getController()->getPresentationFor( 'inventory', 'emailMantenimiento');

                $email->setCaBodyhtml( $texto );
                $email->addTo($mantenimiento->getUsuario()->getManager()->getCaEmail());

                foreach( $logins as $login ){
                    $usuario = Doctrine::getTable("Usuario")->find( $login );
                    $email->addCc( $usuario->getCaEmail() );
                }

                $this->setLayout("none");

                $email->save();
                $this->redirect("homepage");
            }
            
        }
    }

    /**
     * Guarda un seguimiento a un activo
     *
     * @param sfRequest $request A request object
     */
    public function executeVerSeguimientos(sfWebRequest $request) {

        //$this->nivel = $this->getNivel();
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless($idactivo);

        $this->seguimientos = Doctrine::getTable("InvSeguimiento")
                ->createQuery("s")
                ->addWhere("s.ca_idactivo = ? ", $idactivo)
                ->addOrderBy("s.ca_fchcreado ASC")
                ->execute();
        
        $this->mantenimientos = Doctrine::getTable("InvMantenimiento")
                ->createQuery("m")
                ->addWhere("m.ca_idactivo = ? ", $idactivo)
                ->addOrderBy("m.ca_fchcreado ASC")
                ->execute();
    }
    
    public function executeEmailMantenimiento(sfWebRequest $request) {

        //$this->nivel = $this->getNivel();
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless($idactivo);
        $respuesta = $request->getParameter("respuesta");
        $idman = $request->getParameter("idman");
        
        $user = $this->getUser();
        $this->user = $user;
        $this->usuario = Doctrine::getTable("Usuario")->find($user);
        
        $this->respuesta = $respuesta;
        $this->idactivo = $idactivo;
        
        $this->mantenimientos = Doctrine::getTable("InvMantenimiento")
                ->createQuery("m")
                ->addWhere("m.ca_idactivo = ? ", $idactivo)
                ->addOrderBy("m.ca_fchcreado DESC")
                ->execute();
        
    }

    /*
     *
     */

    public function executePanelCategoriaGuardar($request) {
        $idcategory = $request->getParameter("idcategory");
        $idsucursal = $request->getParameter("idsucursal");
        $this->forward404Unless($idsucursal);
        try {
            $ususucursal = $this->getUser()->getIdSucursal();

            if ($idcategory) {
                $categoria = Doctrine::getTable("InvCategory")->find($idcategory);
                $this->forward404Unless($categoria);
            } else {
                $categoria = new InvCategory();
                $main = $request->getParameter("main");
                $categoria->setCaMain($main == "on");
                $categoria->setCaParameter($request->getParameter("parameter"));
            }

            $categoria->setCaName(utf8_decode(trim(ucwords(strtolower($request->getParameter("name"))))));
            if ($request->getParameter("parent")) {
                $categoria->setCaParent(utf8_decode($request->getParameter("parent")));
            } else {
                $categoria->setCaParent(null);
            }
            $categoria->save();
            $idcategory = $categoria->getCaIdcategory();

            if ($request->getParameter("prefix")) {


                $prefijo = Doctrine::getTable("InvPrefijo")->find(array($idcategory, $idsucursal));
                if (!$prefijo) {
                    $prefijo = new InvPrefijo();
                    $prefijo->setCaIdcategory($idcategory);
                    $prefijo->setCaIdsucursal($idsucursal);
                }

                $autonumeric = $request->getParameter("autonumeric");
                $prefijo->setCaAutonumeric($autonumeric == "on");
                $prefix = strtoupper(str_replace(" ", "", str_replace("-", "", $request->getParameter("prefix"))));
                $prefijo->setCaPrefix($prefix);
                $prefijo->save();
            }

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    /*
     *
     */

    public function executeEliminarCategoria($request) {
        $idcategory = $request->getParameter("idcategory");

        if ($idcategory) {
            $categoria = Doctrine::getTable("InvCategory")->find($idcategory);
            $this->forward404Unless($categoria);

            try {
                $categoria->delete();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        } else {
            $this->responseArray = array("success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    /*
     *
     */

    public function executeCambiarCategoria($request) {
        $idactivo = $request->getParameter("idactivo");
        $idcategory = $request->getParameter("idcategory");

        if ($idactivo) {
            $activo = Doctrine::getTable("InvActivo")->find($idactivo);
            $this->forward404Unless($activo);

            try {
                $activo->setCaIdcategory($idcategory);
                $activo->stopBlaming();
                $activo->save();
                $this->responseArray = array("success" => true, "id" => $request->getParameter("id"));
            } catch (Exception $e) {
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        } else {
            $this->responseArray = array("success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    /*
     *
     */

    public function executeDatosPanelAsignaciones($request) {
        $idactivo = $request->getParameter("idactivo");
        $idcategory = $request->getParameter("idcategory");

        if ($idactivo) {
            $asignaciones = Doctrine::getTable("InvAsignacion")
                    ->createQuery("a")
                    ->addWhere("a.ca_idactivo = ? ", $idactivo)
                    ->execute();


            $data = array();

            foreach ($asignaciones as $asignacion) {
                $row = array();
                $row["idactivo"] = $asignacion->getCaIdactivo();
                $row["login"] = $asignacion->getCaLogin();
                $row["fchasignacion"] = $asignacion->getCaFchasignacion();

                $data[] = $row;
            }

            $this->responseArray = array("success" => true, "root" => $data);
        } else {
            $this->responseArray = array("success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    /*
     * 
     */

    public function executeDatosPanelAsignacionesSoftware($request) {
        $idactivo = $request->getParameter("idactivo");


        if ($idactivo) {
            $equipos = Doctrine::getTable("InvAsignacionSoftware")
                    ->createQuery("a")
                    ->select("e.ca_identificador, a.ca_idasignacion_software,  a.ca_idactivo, a.ca_idequipo, u.ca_nombre,s.ca_nombre")
                    ->innerJoin("a.Equipo e")
                    ->leftJoin("e.Usuario u")
                    ->leftJoin("u.Sucursal s")
                    ->addWhere("a.ca_idactivo = ? ", $idactivo)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();

            $i = 0;
            foreach ($equipos as $key => $val) {
                $equipos[$key]["s_ca_nombre"] = utf8_encode($equipos[$key]["s_ca_nombre"]);
                $equipos[$key]["u_ca_nombre"] = utf8_encode($equipos[$key]["u_ca_nombre"]);
                $equipos[$key]["orden"] = $i++;
            }
            if( $request->getParameter("readOnly")!="true" ){
                $equipos[] = array("e_ca_identificador" => "", "orden" => "Z");
            }
            
            $this->responseArray = array("success" => true, "root" => $equipos);
        } else {
            $this->responseArray = array("success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    /*
     * 
     */

    public function executeGuardarPanelAsignacionesSoftware($request) {
        try {
            $flash = "";
            $idactivo = $request->getParameter("idactivo");
            $this->forward404Unless($idactivo);
            $idequipo = $request->getParameter("idequipo");
            $this->forward404Unless($idequipo);

            $activo = Doctrine::getTable("InvActivo")->find($idactivo);
            //Verifica que no hayan mas licencias asignadas que las registradas                          
            $q = Doctrine::getTable("InvAsignacionSoftware")
                    ->createQuery("a")
                    
                    ->select("count(*) as assigned")
                    ->addWhere("a.ca_idactivo=?", $idactivo)                    
                    ->leftJoin("a.Equipo ac")
                    ->addWhere("ac.ca_fchbaja IS NULL");


            $asig = $q->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                    ->execute();


            if ($activo->getCaCantidad() <= $asig) {
                $flash = "Alerta: No hay mas licencias disponibles. Cantidad: " . $activo->getCaCantidad() . " Asignadas: " . $asig;
            }


            if ($request->getParameter("idasignacion_software")) {
                $asignacion = Doctrine::getTable("InvAsignacionSoftware")->find($request->getParameter("idasignacion_software"));
                $this->forward404Unless($asignacion);
            } else {
                $asignacion = new InvAsignacionSoftware();
                $asignacion->setCaIdactivo($idactivo);
            }
            $asignacion->setCaIdequipo($idequipo);
            $asignacion->save();

            $this->responseArray = array("success" => true, "flash"=>$flash, "id" => $request->getParameter("id"), "idasignacion_software" => $asignacion->getCaIdasignacionSoftware());
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    /*
     * 
     */

    public function executeEliminarPanelAsignacionSoftware($request) {
        try {


            $this->forward404Unless($request->getParameter("idasignacion_software"));
            $asignacion = Doctrine::getTable("InvAsignacionSoftware")->find($request->getParameter("idasignacion_software"));
            $this->forward404Unless($asignacion);

            $asignacion->delete();

            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"));
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }


        $this->setTemplate("responseTemplate");
    }

    /*
     * 
     */

    public function executeDatosWidgetEquipo($request) {
        $query = "%" . strtoupper($request->getParameter("query")) . "%";

        $equipos = Doctrine_Query::create()
                ->select("a.ca_identificador, a.ca_idactivo, u.ca_nombre,s.ca_nombre")
                ->from("InvActivo a")
                ->innerJoin("a.InvCategory c")
                ->leftJoin("a.Usuario u")
                ->leftJoin("u.Sucursal s")
                ->addWhere("UPPER(a.ca_identificador) LIKE ? OR UPPER(u.ca_nombre) LIKE ? ", array($query, $query))
                ->addWhere("c.ca_parameter = ?", "Hardware")
                ->addOrderBy("a.ca_identificador")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($equipos as $key => $val) {
            $equipos[$key]["s_ca_nombre"] = utf8_encode($equipos[$key]["s_ca_nombre"]);
            $equipos[$key]["u_ca_nombre"] = utf8_encode($equipos[$key]["u_ca_nombre"]);
        }
        $this->responseArray = array("root" => $equipos, "total" => count($equipos), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * 
     */

    public function executeDatosWidgetProducto($request) {
        $idcategoria = $request->getParameter("idcategory");

        $productos = Doctrine_Query::create()
                ->select("p.ca_nombre, p.ca_idproducto")
                ->from("InvProducto p")
                ->addWhere("p.ca_idcategoria = ?", $idcategoria)
                ->addOrderBy("p.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        foreach ($productos as $key => $val) {
            $productos[$key]["p_ca_nombre"] = utf8_encode($productos[$key]["p_ca_nombre"]);
        }
        $this->responseArray = array("root" => $productos, "total" => count($productos), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Informes
     */

    public function executeInformes($request) {
        
    }

    public function executeInformeLicencias($request) {
        $q = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->addWhere("s.ca_idempresa = ?", 2)
                ->addOrderBy("s.ca_nombre");

        $this->nivel = $this->getNivel();
        if ($this->nivel < 2) {
            $user = $this->getUser();
            $q->addWhere("s.ca_idsucursal = ? ", $user->getIdsucursal());
        }

        $this->sucursales = $q->execute();
    }

    public function executeInformeLicenciasResult($request) {

        $idsucursal = $request->getParameter("idsucursal");
        
        $q = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")
                ->addWhere("a.ca_fchbaja IS NULL")
                ->select("a.ca_so, count(*) as q")
                ->addWhere("a.ca_so IS NOT NULL  AND a.ca_so!='' AND a.ca_so!=?", "No tiene ")
                ->addGroupBy("a.ca_so")
                ->addOrderBy("a.ca_so");

        $sucursal = null;
        if ($idsucursal) {
            $q->addWhere("a.ca_idsucursal = ?", $idsucursal);
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal);   
        }

        $this->soOEM = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        $q = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")
                ->addWhere("a.ca_fchbaja IS NULL")
                ->select("a.ca_office, count(*) as q")
                ->addWhere("a.ca_office IS NOT NULL  AND a.ca_office!='' AND a.ca_office!=?", "No tiene")
                ->addGroupBy("a.ca_office")
                ->addOrderBy("a.ca_office");
        
        if ($idsucursal) {
            $q->addWhere("a.ca_idsucursal = ?", $idsucursal);
        }

        $this->ofOEM = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();


        $q = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")                
                ->leftJoin("a.InvAsignacionSoftwareActivo as")
                ->leftJoin("as.Equipo ac")
                                              
                ->select("a.ca_idactivo, c.ca_name,a.ca_modelo, a.ca_cantidad as q, count(as.ca_idactivo) as assigned, (SELECT count(*) FROM InvActivo aa INNER JOIN  aa.InvAsignacionSoftwareActivo aas INNER JOIN aas.Equipo acc WHERE aa.ca_idactivo=a.ca_idactivo AND aa.ca_fchbaja IS NULL AND acc.ca_fchbaja IS NULL ) as q2  ")
                ->addWhere("c.ca_parameter=?", "Software")
                ->addWhere("a.ca_fchbaja IS NULL")
                ->addWhere("ac.ca_fchbaja IS NULL")
                ->addGroupBy("a.ca_idactivo, c.ca_name, a.ca_modelo, a.ca_cantidad")
                ->addOrderBy("c.ca_name, a.ca_modelo");
        
        if ($idsucursal) {
            $q->addWhere("ac.ca_idsucursal = ?", array( $idsucursal ));
            
        }
        //echo $q->getSqlQuery();
        
        $this->software = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        
        $this->idsucursal = $idsucursal;
        $this->sucursal = $sucursal;
    }

    /*
     * Listados de activos
     */

    public function executeInformeListadoActivos($request) {
        $q = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->addWhere("s.ca_idempresa = ?", 2)
                ->addOrderBy("s.ca_nombre");

        $this->nivel = $this->getNivel();
        if ($this->nivel < 2) {
            $user = $this->getUser();
            $q->addWhere("s.ca_idsucursal = ? ", $user->getIdsucursal());
        }

        $this->sucursales = $q->execute();

        
        $this->cats = Doctrine::getTable("InvCategory")
                ->createQuery("c")
                ->addOrderBy("c.ca_parent")
                ->addOrderBy("c.ca_order")
                ->execute();
    }

    public function executeInformeListadoActivosResult($request) {
        $idsucursal = $request->getParameter("idsucursal");
        $idcategory = $request->getParameter("idcategory");
        $idasignacion = $request->getParameter("idasignacion");
        $so = $request->getParameter("so");
        $office = $request->getParameter("office");
        $bajasChkbox = $request->getParameter("bajasChkbox");
        $fchbajainicio = $request->getParameter("fchbajainicio");
        $fchbajafinal = $request->getParameter("fchbajafinal");

        $q = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")
                ->leftJoin("c.Parent p")
                ->leftJoin("a.Usuario u")
                ->leftJoin("a.Sucursal s")
                ->addOrderBy("c.ca_name ASC")
                ->addOrderBy("a.ca_identificador ASC");

        //Dependiendo del parametro se muestran otras columnas en el informe
        $this->param = $request->getParameter("param");
        if ($idcategory) {
            $cat = Doctrine::getTable("InvCategory")->find($idcategory);
            $this->param = $cat->getCaParameter();
            $q->addWhere("a.ca_idcategory = ?", $idcategory);
        }
        $sucursal = null;
        if ($idsucursal) {
            $q->addWhere("a.ca_idsucursal = ?", $idsucursal);
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal);            
        }

        if ($so) {
            $q->addWhere("REPLACE(a.ca_so, '.', '_') = ?", $so);
        }

        if ($office) {
            $q->addWhere("REPLACE(a.ca_office, '.', '_') = ?", $office);
        }



        if ($idasignacion) {
            $q->innerJoin("a.InvAsignacionSoftware as");
            $q->addWhere("as.ca_idactivo = ? ", $idasignacion);
        }

        $this->nivel = $this->getNivel();
        if ($this->nivel < 2) {
            $user = $this->getUser();
            $q->addWhere("s.ca_idsucursal = ? ", $user->getIdsucursal());
        }

        if ($bajasChkbox) {

            if ($fchbajainicio) {
                $q->addWhere("a.ca_fchbaja >= ? ", $fchbajainicio);
            }

            if ($fchbajafinal) {
                $q->addWhere("a.ca_fchbaja <= ? ", $fchbajafinal);
            }
        }else{
            $q->addWhere("a.ca_fchbaja IS NULL");
        }

        $this->activos = $q->execute();
        $this->bajasChkbox = $bajasChkbox;
        
        
        $this->sucursal = $sucursal;
        $this->idcategory = $idcategory;
        $this->idasignacion = $idasignacion;
        $this->so = $so;
        $this->office = $office;
        
        $this->fchbajainicio = $fchbajainicio;
        $this->fchbajafinal = $fchbajafinal;
        
        
    }
    
    public function executeInformeListadoMantenimientos($request) {
        
        $q = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->addWhere("s.ca_idempresa = ?", 2)
                ->addOrderBy("s.ca_nombre");

        $this->nivel = $this->getNivel();
        if ($this->nivel < 2) {
            $user = $this->getUser();
            $q->addWhere("s.ca_idsucursal = ? ", $user->getIdsucursal());
        }

        $this->sucursales = $q->execute();
    }
    
    public function executeInformeListadoMantenimientosResult($request) {
        
        $idsucursal = $request->getParameter("idsucursal");
        $mes = $request->getParameter("mes");
        
        $criterio = $request->getParameter("criterio");
                
        $q = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                //->select("*,EXTRACT(MONTH FROM a.ca_prgmantenimiento)")
                ->innerJoin("a.InvCategory c")
                ->addWhere("a.ca_fchbaja IS NULL");
        
        $sucursal = null;
        if ($idsucursal) {
            $q->addWhere("a.ca_idsucursal = ?", $idsucursal);
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal);
            
        }
            $q->addWhere("c.ca_parameter IN ('Hardware','Dispositivo')");
        
        //$mes = null;
        //$fechames = Utils::fechaMes($activo->getCaPrgmantenimiento());
        if($mes){
            $q->addWhere("EXTRACT(MONTH FROM a.ca_prgmantenimiento) = ?", $mes);
        }
            
        if($criterio=="mes"){
            $q->addOrderBy("EXTRACT (MONTH FROM a.ca_prgmantenimiento)");
        }
            $q->addOrderBy("c.ca_idcategory");
            $q->addOrderBy("a.ca_prgmantenimiento");
        
        $this->activos = $q->execute();
        $result = array();
        
        $q = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")
                ->addWhere("a.ca_fchbaja IS NULL");
        $sucursal = null;
        if ($idsucursal) {
            $q->addWhere("a.ca_idsucursal = ?", $idsucursal);
            $sucursal = Doctrine::getTable("Sucursal")->find($idsucursal);
            
        }
            $q->addWhere("c.ca_parameter IN ('Hardware','Dispositivo')");
            //$q->addOrderBy("c.ca_idcategory");
            $q->addOrderBy("c.ca_parent DESC");
            $q->addOrderBy("c.ca_name");
            
        
        $this->resumenes = $q->execute();
        $result = array();
        
        
        
        $this->criterio = $criterio;
        $this->sucursal = $sucursal;
        $this->mes = $mes;
        
        
    }

    public function executeDatosPanelProductos($request) {
        $idcategory = $request->getParameter("idcategory");

        $productos = Doctrine::getTable("InvProducto")
                ->createQuery("p")
                ->addWhere("p.ca_idcategoria = ?", $idcategory)
                ->addOrderBy("p.ca_nombre ASC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($productos as $key => $val) {
            $productos[$key]["p_ca_nombre"] = utf8_encode($productos[$key]["p_ca_nombre"]);
        }

        $productos[] = array("p_ca_nombre" => "+", "orden" => "Z");

        $this->responseArray = array("root" => $productos, "total" => count($productos), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarPanelProductos($request) {
        $idcategory = $request->getParameter("idcategory");
        $idproducto = $request->getParameter("idproducto");

        try {
            $this->forward404Unless($idcategory);
            if ($idproducto) {
                $prod = Doctrine::getTable("InvProducto")->find($idproducto);
                $this->forward404Unless($prod);
            } else {
                $prod = new InvProducto();
                $prod->setCaIdcategoria($idcategory);
            }

            $prod->setCaNombre($request->getParameter("nombre"));
            $prod->save();
            $this->responseArray = array("success" => true, "idproducto" => $prod->getCaIdproducto(), "id" => $request->getParameter("id"));
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarPanelProductos($request) {

        try {
            $idproducto = $request->getParameter("idproducto");
            $this->forward404Unless($idproducto);
            $prod = Doctrine::getTable("InvProducto")->find($idproducto);
            $this->forward404Unless($prod);
            $prod->delete();
            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"));
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDetalleActivo($request) {
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless($idactivo);
        $this->activo = Doctrine::getTable("InvActivo")->find($idactivo);
        $this->forward404Unless($this->activo);

        $cat = $this->activo->getInvCategory();

        $this->parameter = $cat->getCaParameter();

        if ($this->parameter == "Hardware") {
            $q = Doctrine::getTable("InvActivo")
                    ->createQuery("a")
                    ->innerJoin("a.InvAsignacionSoftwareActivo so")
                    ->innerJoin("a.InvCategory c")
                    ->addWhere("a.ca_fchbaja IS NULL")
                    ->addWhere("so.ca_idequipo = ? ", $idactivo)
                    ->addOrderBy("a.ca_identificador ASC");

            $this->asig = $q->execute();
        }

        if ($this->parameter == "Software") {

            $q = Doctrine::getTable("InvActivo")
                    ->createQuery("a")
                    ->innerJoin("a.InvAsignacionSoftware so")
                    ->innerJoin("a.InvCategory c")
                    ->addWhere("a.ca_fchbaja IS NULL")
                    ->addWhere("so.ca_idactivo = ? ", $idactivo)
                    ->addOrderBy("a.ca_identificador ASC");

            $this->asig = $q->execute();
        }
    }
    
    public function executeNotificarPrgmantenimiento(sfWebRequest $request) {

        $this->setLayout("email");

        $hoy = date("Y-m-d");
        $mesprg = (int) date('m', strtotime($hoy));
        $anoprg = date('Y', strtotime($hoy));
        $mesLargo = Utils::mesLargo($mesprg);

        $activos = Doctrine::getTable("InvActivo")
                        ->createQuery("a")
                        ->addWhere("EXTRACT(MONTH FROM a.ca_prgmantenimiento) = ?", $mesprg)
                        ->addWhere("EXTRACT(YEAR FROM a.ca_prgmantenimiento) = ?", $anoprg)
                        ->execute();

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaTipo("Prg. Mantenimiento");
        $email->setCaIdcaso($mesprg.$anoprg);
        $email->setCaFrom("no-reply@coltrans.com.co");
        $email->setCaFromname("Colsys Notificaciones");

        foreach ($activos as $activo) {
            $email->addTo($activo->getUsuario()->getCaEmail());
        }

        $email->setCaSubject("Programaci�n de Mantenimiento: ".$mesLargo." de ".$anoprg);
        $contenido = sfContext::getInstance()->getController()->getPresentationFor('inventory', 'emailPrgmantenimiento');
        $email->setCaBodyhtml($contenido);
        $email->save( $conn );
        $email->send();
        
    }
    public function executeEmailPrgmantenimiento(sfWebRequest $request) {

        $this->setLayout("email");
        
        $hoy = date("Y-m-d");
        $mesprg = (int) date('m', strtotime($hoy));
        $this->anoprg = date('Y', strtotime($hoy));;
        $this->mesLargo = Utils::mesLargo($mesprg);
        
        $this->activos = Doctrine::getTable("InvActivo")
                        ->createQuery("a")
                        ->addWhere("EXTRACT(MONTH FROM a.ca_prgmantenimiento) = ?", $mesprg)
                        ->addWhere("EXTRACT(YEAR FROM a.ca_prgmantenimiento) = ?", $this->anoprg)
                        ->orderBy("a.ca_prgmantenimiento ASC")
                        ->execute();
        
        $q = Doctrine::getTable("InvMantenimientoEtapas")
                ->createQuery("e");
        $etapas = $q->execute();
        $result = array();
        
        $this->etapas = $etapas;
        
    }
}

?>