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


        if ($this->nivel < 2) {
            $user = $this->getUser();
            $q->addWhere("s.ca_idsucursal = ? ", $user->getIdsucursal());
        }

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
            $row["mantenimiento"] = $activo->getCaMantenimiento();
            $row["idsucursal"] = $activo->getCaIdsucursal();
            $row["cantidad"] = $activo->getCaCantidad();
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
        $data["mantenimiento"] = $activo->getCaMantenimiento();
        $data["cantidad"] = $activo->getCaCantidad();


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

            if ($request->getParameter("mantenimiento")) {
                $activo->setCaMantenimiento($request->getParameter("mantenimiento"));
            } else {
                $activo->setCaMantenimiento(null);
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

        $this->nivel = $this->getNivel();
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless($idactivo);



        $seguimiento = new InvSeguimiento();
        $seguimiento->setCaIdactivo($idactivo);
        $seguimiento->setCaText(utf8_decode($request->getParameter("text")));
        $seguimiento->save();



        $texto = sfContext::getInstance()->getController()->getPresentationFor('inventory', 'verSeguimientos');

        $this->responseArray = array("success" => true, "idactivo" => $idactivo, "info" => utf8_encode($texto));
        $this->setTemplate("responseTemplate");
    }

    /**
     * Guarda un seguimiento a un activo
     *
     * @param sfRequest $request A request object
     */
    public function executeVerSeguimientos(sfWebRequest $request) {

        $this->nivel = $this->getNivel();
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless($idactivo);

        $this->seguimientos = Doctrine::getTable("InvSeguimiento")
                ->createQuery("s")
                ->addWhere("s.ca_idactivo = ? ", $idactivo)
                ->addOrderBy("s.ca_fchcreado ASC")
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

            $equipos[] = array("e_ca_identificador" => "", "orden" => "Z");
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
            $idactivo = $request->getParameter("idactivo");
            $this->forward404Unless($idactivo);
            $idequipo = $request->getParameter("idequipo");
            $this->forward404Unless($idequipo);
            
            $activo = Doctrine::getTable("InvActivo")->find( $idactivo );
            //Verifica que no hayan mas licencias asignadas que las registradas                          
            $q = Doctrine::getTable("InvAsignacionSoftware")
                    ->createQuery("a")                    
                    ->select("count(*) as assigned")
                    ->addWhere("a.ca_idactivo=?", $idactivo);
                    
            
            $asig = $q->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                    ->execute();
           
                        
            if ($activo->getCaCantidad() <= $asig ) {
                throw new Exception(" No hay mas licencias disponibles. Cantidad: " . $activo->getCaCantidad() . " Asignadas: " . $asig);
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

            $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idasignacion_software" => $asignacion->getCaIdasignacionSoftware());
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
        
    }

    public function executeInformeLicenciasResult($request) {
        $this->soOEM = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")                
                ->addWhere("LOWER(c.ca_name) NOT LIKE ?", '%dados de baja%')
                ->select("a.ca_so, count(*) as q")
                ->addWhere("a.ca_so IS NOT NULL  AND a.ca_so!='' AND a.ca_so!=?", "No tiene ")
                ->addGroupBy("a.ca_so")
                ->addOrderBy("a.ca_so")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        $this->ofOEM = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")                
                ->addWhere("LOWER(c.ca_name) NOT LIKE ?", '%dados de baja%')
                ->select("a.ca_office, count(*) as q")
                ->addWhere("a.ca_office IS NOT NULL  AND a.ca_office!='' AND a.ca_office!=?", "No tiene")
                ->addGroupBy("a.ca_office")
                ->addOrderBy("a.ca_office")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();


        $this->software = Doctrine::getTable("InvActivo")
                ->createQuery("a")
                ->innerJoin("a.InvCategory c")                      
                ->addWhere("LOWER(c.ca_name) NOT LIKE ?", '%dados de baja%')
                ->leftJoin("a.InvAsignacionSoftwareActivo as")
                ->select("a.ca_idactivo,c.ca_name,a.ca_modelo, a.ca_cantidad as q, count(as.ca_idactivo) as assigned")
                ->addWhere("c.ca_parameter=?", "Software")                
                ->addGroupBy("a.ca_idactivo, c.ca_name, a.ca_modelo, a.ca_cantidad")
                ->addOrderBy("c.ca_name, a.ca_idactivo, c.ca_name, a.ca_modelo, a.ca_cantidad")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
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
        if( $idcategory ){
            $cat = Doctrine::getTable("InvCategory")->find($idcategory);
            $this->param = $cat->getCaParameter();
            $q->addWhere("a.ca_idcategory = ?", $idcategory );
        }
        
        if( $idsucursal ){
            $q->addWhere("a.ca_idsucursal = ?", $idsucursal);
        }
        
        if( $so ){
            $q->addWhere("a.ca_so = ?", $so);
        }
        
        if( $office ){
            $q->addWhere("a.ca_office = ?", $office);
        }
        
        if( $idasignacion ){
            $q->innerJoin("a.InvAsignacionSoftware as");
            $q->addWhere("as.ca_idactivo = ? ", $idasignacion);
        }
        
        $this->nivel = $this->getNivel();
        if ($this->nivel < 2) {
            $user = $this->getUser();
            $q->addWhere("s.ca_idsucursal = ? ", $user->getIdsucursal());
        }
        
        $this->activos = $q->execute();
    }
    
    
    public function executeDatosPanelProductos($request) {
        $idcategory = $request->getParameter("idcategory");
        
        $productos = Doctrine::getTable("InvProducto")
                ->createQuery("p")             
                ->addWhere("p.ca_idcategoria = ?", $idcategory )
                ->addOrderBy("p.ca_nombre ASC")                
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        
        foreach( $productos as $key=>$val ){
            $productos[$key]["p_ca_nombre"] = utf8_encode( $productos[$key]["p_ca_nombre"] ); 
        }
        
        $productos[] = array("p_ca_nombre"=>"+", "orden"=>"Z");
        
        $this->responseArray = array("root" => $productos, "total" => count($productos), "success" => true);
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeGuardarPanelProductos($request) {
        $idcategory = $request->getParameter("idcategory");
        $idproducto = $request->getParameter("idproducto");
        
        try{
            $this->forward404Unless( $idcategory );
            if( $idproducto ){
                $prod = Doctrine::getTable("InvProducto")->find( $idproducto );
                $this->forward404Unless( $prod );
            }else{
                $prod = new InvProducto();   
                $prod->setCaIdcategoria( $idcategory );
            }
            
            $prod->setCaNombre( $request->getParameter("nombre") );
            $prod->save();
            $this->responseArray = array("success" => true, "idproducto"=>$prod->getCaIdproducto(), "id"=>$request->getParameter("id") );
        }catch( Exception $e ){
            $this->responseArray = array("success" => false, "errorInfo"=>$e->getMessage() );
        }
        $this->setTemplate("responseTemplate");
        
    }
    
    public function executeEliminarPanelProductos($request) {        
        
        try{
            $idproducto = $request->getParameter("idproducto");
            $this->forward404Unless( $idproducto );
            $prod = Doctrine::getTable("InvProducto")->find( $idproducto );
            $this->forward404Unless( $prod );
            $prod->delete();
            $this->responseArray = array("success" => true,  "id"=>$request->getParameter("id") );
        }catch( Exception $e ){
            $this->responseArray = array("success" => false, "errorInfo"=>$e->getMessage() );
        }
        $this->setTemplate("responseTemplate");    
    }
    
    
    public function executeDetalleActivo($request) {
        $idactivo = $request->getParameter("idactivo");
        $this->forward404Unless( $idactivo );
        $this->activo = Doctrine::getTable("InvActivo")->find( $idactivo );
        $this->forward404Unless( $this->activo );
        
        $cat = $this->activo->getInvCategory();
        
        $this->parameter =  $cat->getCaParameter();
        
        if( $this->parameter=="Hardware" ){        
            $q = Doctrine::getTable("InvActivo")
                    ->createQuery("a")
                    ->innerJoin("a.InvAsignacionSoftwareActivo so")  
                    ->innerJoin("a.InvCategory c")                
                    ->addWhere("LOWER(c.ca_name) NOT LIKE ?", '%dados de baja%')
                    ->addWhere("so.ca_idequipo = ? ", $idactivo )
                    ->addOrderBy("a.ca_identificador ASC");

            $this->asig = $q->execute();
        }
        
        if( $this->parameter=="Software" ){        
            
            $q = Doctrine::getTable("InvActivo")
                    ->createQuery("a")
                    ->innerJoin("a.InvAsignacionSoftware so")   
                    ->innerJoin("a.InvCategory c")                
                    ->addWhere("LOWER(c.ca_name) NOT LIKE ?", '%dados de baja%')
                    ->addWhere("so.ca_idactivo = ? ", $idactivo )
                    ->addOrderBy("a.ca_identificador ASC");
            
            $this->asig = $q->execute();
        }
        
    }
    
   
    
}

?>
