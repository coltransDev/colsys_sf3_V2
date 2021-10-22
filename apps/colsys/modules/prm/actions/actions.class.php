<?php

/**
 * prm actions.
 *
 * @package    symfony
 * @subpackage prm
 * @author     Carlos G. Lopez M.
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class prmActions extends sfActions {

    const RUTINA_PRM = 225;

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward('prm', 'indexExt5');
    }

    public function executeIndexExt5(sfWebRequest $request) {
        $this->permisos = array();

        $user = $this->getUser();
        $this->login = $user->getUserId();
        $this->idsucursal = $user->getIdSucursal();
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_PRM);

        $tipopermisos = $user->getAccesoTotalRutina(self::RUTINA_PRM);
        foreach ($tipopermisos as $index => $tp) {
            $this->permisos[$index] = in_array($tp, $permisosRutinas) ? true : false;
        }

        if ($request->getParameter("idproveedor")) {
            $proveedor = Doctrine::getTable("IdsProveedor")->find($request->getParameter("idproveedor"));
            if ($proveedor) {
                $this->idproveedor = $proveedor->getCaIdproveedor();
                $this->nombre = utf8_encode($proveedor->getIds()->getCaNombre());
            }
        }
    }

    public function executeCriteriosEvaluacionExt5() {
        
    }

    public function executeCargarPermisos(sfWebRequest $request) {
        $permisos = array();

        $user = $this->getUser();
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_PRM);

        $tipopermisos = $user->getAccesoTotalRutina(self::RUTINA_PRM);
        foreach ($tipopermisos as $index => $tp) {
            $permisos[$index] = in_array($tp, $permisosRutinas) ? true : false;
        }

        $this->responseArray = array("success" => true, "permisos" => $permisos);
        $this->setTemplate("responseTemplate");
    }

    function realizarBusqueda($request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select i.ca_id from ids.tb_ids i where ca_idalterno like '%" . $request->getParameter("q") . "%' or ca_datos->>'idRepresentante' like '%" . $request->getParameter("q") . "%'";
        $rs = $con->execute($sql);
        $ids = $rs->fetchAll(PDO::FETCH_COLUMN);

        if (!$ids) {
            $sql = "select i.ca_id from ids.tb_ids i where lower(ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%' "
                    . "or lower(ca_datos->>'nombre') like '%" . strtolower($request->getParameter("q")) . "%' "
                    . "or lower(ca_datos->>'papellido') like '%" . strtolower($request->getParameter("q")) . "%' "
                    . "or lower(ca_datos->>'sapellido') like '%" . strtolower($request->getParameter("q")) . "%' ";
            $rs = $con->execute($sql);
            $ids = $rs->fetchAll(PDO::FETCH_COLUMN);
        }

        $q = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->innerJoin("i.IdsProveedor id");

        if (count($ids) > 0) {
            $q->whereIn('i.ca_id', $ids);
        }
        if ($request->getParameter("estado")) {
            $query = "where ";
            $estados = $request->getParameter("estado");
            $estado = array_pop($estados);
            if (!$estados) {
                $query .= ($estado == "Aprobado") ? "ca_fchaprobado is not null" : "ca_fchaprobado is null";
                $sql = "select ca_idproveedor as ca_column from ids.tb_proveedores $query";
                $con = Doctrine_Manager::getInstance()->connection();
                $stmt = $con->execute($sql);

                if ($stmt) {
                    $q->whereIn("ca_idproveedor", $stmt->fetchAll(PDO::FETCH_COLUMN));
                }
            }
        }
        if ($request->getParameter("impoexpo")) {
            $query = "where ";
            $impoexpo = $request->getParameter("impoexpo");
            if (in_array("Importacion", $impoexpo)) {
                $query .= "ca_activo_impo IS TRUE and ";
            }
            if (in_array("Exportacion", $impoexpo)) {
                $query .= "ca_activo_expo IS TRUE and ";
            }
            $query = substr($query, 0, -5);
            $sql = "select ca_idproveedor as ca_column from ids.tb_proveedores $query";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);

            if ($stmt) {
                $q->whereIn("ca_idproveedor", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("transporte")) {
            $query = "where ";
            $transporte = $request->getParameter("transporte");
            if (in_array("Aereo", $transporte)) {
                $query .= "ca_transporte LIKE '%Aéreo%' and ";
            }
            if (in_array("Maritimo", $transporte)) {
                $query .= "ca_transporte LIKE '%Marítimo%' and ";
            }
            if (in_array("Terrestre", $transporte)) {
                $query .= "ca_transporte LIKE '%Terrestre%' and ";
            }
            $query = substr($query, 0, -5);
            $sql = "select ca_idproveedor as ca_column from ids.tb_proveedores $query";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);

            if ($stmt) {
                $q->whereIn("ca_idproveedor", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("idEmpresa")) {
            $query = "where ";
            $idEmpresa = $request->getParameter("idEmpresa");
            if ($idEmpresa == 2) {
                $query .= "ca_empresa like '%Coltrans%'";
            } else if ($idEmpresa == 1) {
                $query .= "ca_empresa like '%Colmas%'";
            } else if ($idEmpresa == 8) {
                $query .= "ca_empresa like '%COLOTM%'";
            } else if ($idEmpresa == 11) {
                $query .= "ca_empresa like '%Coldepositos Log%'";
            } else if ($idEmpresa == 12) {
                $query .= "ca_empresa like '%Coldepositos BN%'";
            }
            $sql = "select ca_idproveedor as ca_column from ids.tb_proveedores $query";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);
            if ($stmt) {
                $q->whereIn("ca_idproveedor", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("idSucursal")) {
            $sql = "select ca_idproveedor as ca_column from ids.tb_proveedores prv "
                    . "inner join control.tb_usuarios usr on prv.ca_ususolicitud = usr.ca_login "
                    . "where usr.ca_idsucursal = '" . $request->getParameter("idSucursal") . "'";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);
            if ($stmt) {
                $q->whereIn("ca_idproveedor", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("jefeEncargado")) {
            $sql = "select ca_idproveedor as ca_column from ids.tb_proveedores where ca_jefecuenta = '" . $request->getParameter("jefeEncargado") . "'";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);
            if ($stmt) {
                $q->whereIn("ca_idproveedor", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("nivel")) {
            $nvlriesgo = array();
            foreach ($request->getParameter("nivel") as $nivel) {
                $nvlriesgo[] = utf8_decode($nivel);
            }
            $q->whereIn("ca_nvlriesgo", $nvlriesgo);
        }
        if ($request->getParameter("reportado")) {
            $q->addWhere("ca_datos->>'vinculantes' = ?", $request->getParameter("reportado"));
        }
        if ($request->getParameter("clasificacion")) {
            $q->addWhere("ca_idclasificacion = ?", $request->getParameter("clasificacion"));
        }
        if ($request->getParameter("excepcion")) {
            if (in_array('Esporï¿½dico', $request->getParameter("excepcion"))) {
                $q->addWhere("ca_esporadico IS TRUE");
            }
            if (in_array('De Tercero', $request->getParameter("excepcion"))) {
                $q->addWhere("ca_tercero IS TRUE");
            }
        }

        $proveedores = array();
        if (count($q->getDqlPart("where")) > 0) {
            if ($request->getParameter('action') == "datosBusqueda") {
                $proveedores = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
            } else if ($request->getParameter('action') == "listarBusqueda") {
                $proveedores = $q->execute();
            }
        }

        return $proveedores;
    }

    function executeDatosBusqueda($request) {
        $data = array();
        $proveedores = $this->realizarBusqueda($request);

        foreach ($proveedores as $proveedor) {
            $data[] = array("idproveedor" => utf8_encode("" . $proveedor['ca_id']),
                "nombre" => utf8_encode($proveedor['ca_nombre']));
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $debug, "query" => $query);
        $this->setTemplate("responseTemplate");
    }

    function executeListarBusqueda($request) {
        $data = array();
        $proveedores = $this->realizarBusqueda($request);
        $con = Doctrine_Manager::getInstance()->connection();

        foreach ($proveedores as $proveedor) {
            if ($request->getParameter("idEmpresa") && $request->getParameter("cumple") && $proveedor->getIdsProveedor()->getCaCumpleEmpresa($request->getParameter("idEmpresa")) != $request->getParameter("cumple")) {
                continue;
            }
            $sectoreco = null;
            if (is_int($proveedor->getCaSectoreco())) {
                $parametros = ParametroTable::retrieveByCaso("CU257", null, null, $proveedor->getCaSectoreco());
                foreach ($parametros as $parametro) {
                    $sectoreco = $parametro->getCaValor();
                }
            } else {
                $sectoreco = $proveedor->getCaSectoreco();
            }

            $q = Doctrine::getTable("IdsTipo")
                    ->createQuery("t")
                    ->addWhere("t.ca_aplicacion = ?", "Proveedores")
                    ->whereIn("t.ca_tipo", explode("|", $proveedor->getIdsProveedor()->getCaTipo()))
                    ->addOrderBy("t.ca_nombre");
            $tipos = $q->execute();
            $nomtipo = array();
            foreach ($tipos as $tipo) {
                $nomtipo[] = utf8_encode($tipo->getCaNombre());
            }
            $sql = "select emp.ca_idempresa, translate(replace(replace(emp.ca_nombre,'Coldepósitos ',''), ' S.A.S.', ''),' í', '_i') as ca_nombre, est.ca_activo"
                    . " from control.tb_empresas emp "
                    . " left join ids.tb_estados_sap est on est.ca_idempresa = emp.ca_idempresa and est.ca_tipo = 'P' and est.ca_id = " . $proveedor->getCaId()
                    . "     where ca_idsap is not null "
                    . " order by ca_idsap";
            $st = $con->execute($sql);
            $estados = $st->fetchAll();
            $datos = json_decode(utf8_encode(($proveedor->getCaDatos())));
            $tipo_id = Doctrine::getTable("IdsTipoIdentificacion")->find($datos->tpRepresentante);
            $grupo = $proveedor->getIdsGrupo() ? $proveedor->getIdsGrupo() : "";
            $representa_legal = $datos->nombre . " " . $datos->papellido . " " . $datos->sapellido;
            $identificacion_rl = $tipo_id ? $tipo_id->getCaNombre() . " " . $datos->idRepresentante : "";

            $record = array("idproveedor" => utf8_encode($proveedor->getCaId()),
                "idalterno" => utf8_encode($proveedor->getCaIdalterno()),
                "nombre" => htmlspecialchars(utf8_encode($proveedor->getCaNombre())),
                "sigla" => utf8_encode($proveedor->getIdsProveedor()->getCaSigla()),
                "grupo" => utf8_encode($grupo),
                "direccion" => htmlspecialchars(utf8_encode($proveedor->getSucursalPrincipal() ? $proveedor->getSucursalPrincipal()->getCaDireccion() : "")),
                "ciudad" => utf8_encode($proveedor->getSucursalPrincipal() ? $proveedor->getSucursalPrincipal()->getCiudad()->getCaCiudad() : ""),
                "telefono" => utf8_encode($proveedor->getSucursalPrincipal() ? $proveedor->getSucursalPrincipal()->getCaTelefonos() : ""),
                "website" => utf8_encode($proveedor->getCaWebsite()),
                "solicitante" => utf8_encode($proveedor->getIdsProveedor()->getUsuario()->getCaNombre()),
                "nomjefecuenta" => utf8_encode($proveedor->getIdsProveedor()->getJefe()->getCaNombre()),
                "aprobacion" => $proveedor->getIdsProveedor()->getCaUsuaprobado() . ' ' . $proveedor->getIdsProveedor()->getCaFchaprobado(),
                "empresa" => utf8_encode(str_replace("|", ", ", $proveedor->getIdsProveedor()->getCaEmpresa())),
                "representa_legal" => $representa_legal,
                "identificacion_rl" => $identificacion_rl,
                "nomtipo" => implode(" - ", $nomtipo),
                "transporte" => utf8_encode($proveedor->getIdsProveedor()->getCaTransporte()),
                "activo_impo" => utf8_encode($proveedor->getIdsProveedor()->getCaActivoImpo() ? "Sí" : "No"),
                "activo_expo" => utf8_encode($proveedor->getIdsProveedor()->getCaActivoExpo() ? "Sí" : "No"),
                "critico" => utf8_encode($proveedor->getIdsProveedor()->getCaCritico() ? "Sí" : "No"),
                "esporadico" => utf8_encode($proveedor->getIdsProveedor()->getCaEsporadico() ? "Sí" : "No"),
                "detercero" => utf8_encode($proveedor->getIdsProveedor()->getCaTercero() ? "Sí" : "No"),
                "fchvencimiento" => $proveedor->getIdsProveedor()->getCaFchvencimiento(),
                "nvlriesgo" => utf8_encode($proveedor->getIdsProveedor()->getCaNvlriesgo()),
                "basc" => utf8_encode($datos->basc ? "Sí" : "No"),
                "oea" => utf8_encode($datos->oea ? "Sí" : "No"),
                "vomil" => utf8_encode($datos->vomil ? "Sí" : "No"),
                "ctpat" => utf8_encode($datos->ctpat ? "Sí" : "No"),
                "vinculantes" => utf8_decode($datos->vinculantes),
                "vincumentario" => utf8_decode($datos->vincumentario),
                "fchcircular" => $proveedor->getIdsProveedor()->getCaFchcircular(),
                "fchvencircular" => $proveedor->getIdsProveedor()->getCaFchvencircular(),
                "sectoreco" => $sectoreco,
                "coltrans_cumple" => $proveedor->getIdsProveedor()->getCaCumpleEmpresa(2),
                "colmas_cumple" => $proveedor->getIdsProveedor()->getCaCumpleEmpresa(1),
                "colotm_cumple" => $proveedor->getIdsProveedor()->getCaCumpleEmpresa(8),
                "coldlg_cumple" => $proveedor->getIdsProveedor()->getCaCumpleEmpresa(11),
                "coldbn_cumple" => $proveedor->getIdsProveedor()->getCaCumpleEmpresa(12),
                "clasificacion" => utf8_encode($proveedor->getIdsProveedor()->getMaestraClasificacion()->getRoute()),
                "estado" => $proveedor->getIdsProveedor()->getCaActivo() ? "Activo" : ($proveedor->getIdsProveedor()->getCaVetado() ? "Vetado" : "Inactivo"),
                "observaciones" => utf8_encode($proveedor->getIdsProveedor()->getCaObservaciones()),
                "auditorias" => utf8_encode("<b>Creado:</b> " . $proveedor->getIdsProveedor()->getCaUsucreado() . " - " . $proveedor->getIdsProveedor()->getCaFchcreado() . "&nbsp;&nbsp;&nbsp;" . "<b>Actualizado:</b> " . $proveedor->getIdsProveedor()->getCaUsuactualizado() . " - " . $proveedor->getIdsProveedor()->getCaFchactualizado()),
                "actividad" => utf8_encode($proveedor->getCaActividad()),
                "sucursal" => utf8_encode($proveedor->getIdsProveedor()->getUsuario()->getSucursal()->getCaNombre())
            );
            foreach ($estados as $estado) {
                if ($estado["ca_activo"] == 't') {
                    $record[utf8_encode($estado["ca_nombre"]) . "_sap"] = "Activo";
                } else if ($estado["ca_activo"] == 'f') {
                    $record[utf8_encode($estado["ca_nombre"]) . "_sap"] = "Activo";
                } else {
                    $record[utf8_encode($estado["ca_nombre"]) . "_sap"] = "Sin";
                }
            }
            $data[] = $record;
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $debug, "query" => $query);
        $this->setTemplate("responseTemplate");
    }

    function executeDatosProveedor($request) {
        $idproveedor = $request->getParameter("idproveedor");
        $accion = $request->getParameter("accion");
        $data = array();
        $prov = Doctrine::getTable("IdsProveedor")->find($idproveedor);

        if ($prov) {
            $con = Doctrine_Manager::getInstance()->connection();
            $sql = "select em.ca_idempresa, em.ca_nombre as ca_empresa, es.ca_activo, cr.ca_cupo, cr.ca_dias "
                    . "from control.tb_empresas em "
                    . " left join ids.tb_estados_sap es on es.ca_idempresa = em.ca_idempresa and es.ca_tipo = 'P' and es.ca_id = $idproveedor "
                    . " left join ids.tb_creditos cr on cr.ca_idempresa = em.ca_idempresa and cr.ca_tipo = 'P' and cr.ca_id = $idproveedor "
                    . "where em.ca_idsap is not null "
                    . " order by em.ca_idsap";
            $st = $con->execute($sql);
            $idreq = $st->fetchAll();
            $estados = array();
            foreach ($idreq as $req) {
                $estados[] = array(
                    "idempresa" => $req["ca_idempresa"],
                    "empresa" => utf8_encode($req["ca_empresa"]),
                    "estado_sap" => $req["ca_activo"] ? "Activo" : "Inactivo",
                    "cupo" => $req["ca_cupo"] != 0 ? $req["ca_cupo"] : 0,
                    "dias" => $req["ca_dias"] != 0 ? $req["ca_dias"] : 0
                );
            }

            $idalterno = "";
            $grupo = $prov->getMaestraClasificacion();
            $route_grupo = $grupo->getRoute();

            $q = Doctrine::getTable("IdsTipo")
                    ->createQuery("t")
                    ->addWhere("t.ca_aplicacion = ?", "Proveedores")
                    ->whereIn("t.ca_tipo", explode("|", $prov->getCaTipo()))
                    ->addOrderBy("t.ca_nombre");
            $tipos = $q->execute();
            $nomtipo = array();
            foreach ($tipos as $tipo) {
                $nomtipo[] = utf8_encode($tipo->getCaNombre());
            }
            $ppal = $prov->getIds()->getSucursalPrincipal();
            if (!$ppal) {
                $ppal = new IdsSucursal();
            }
            if ($accion == "showing") {
                $sectoreco = null;
                $parametros = ParametroTable::retrieveByCaso("CU257", null, null, $prov->getIds()->getCaSectoreco());
                $solicitante = Doctrine::getTable("Usuario")->find($prov->getCaUsusolicitud());
                foreach ($parametros as $parametro) {
                    $sectoreco = $parametro->getCaValor();
                }
                foreach ($estados as $key => $estado) {
                    $estado["circular"] = utf8_encode($prov->getCaCumpleEmpresa($estado["idempresa"]));
                    $estados[$key] = $estado;
                }

                $datos = json_decode(utf8_encode(($prov->getIds()->getCaDatos())));
                $tipo_id = Doctrine::getTable("IdsTipoIdentificacion")->find($datos->tpRepresentante);
                $grupo = $prov->getIds()->getIdsGrupo() ? $prov->getIds()->getIdsGrupo() : "";
                $representa_legal = $datos->nombre . " " . $datos->papellido . " " . $datos->sapellido;
                $identificacion_rl = $tipo_id ? $tipo_id->getCaNombre() . " " . $datos->idRepresentante : "";
                $data = array(
                    "idproveedor" => $prov->getCaIdproveedor(),
                    "idalterno" => $prov->getIds()->getIdsTipoIdentificacion()->getCaNombre() . ": " . $prov->getIds()->getCaIdalterno() . (trim($prov->getIds()->getCaDv()) != "" ? "-" . $prov->getIds()->getCaDv() : ""),
                    "tipo" => utf8_encode($prov->getCaTipo()),
                    "nomtipo" => implode(" - ", $nomtipo),
                    "sigla" => utf8_encode($prov->getCaSigla()),
                    "grupo" => utf8_encode($grupo),
                    "representa_legal" => $representa_legal,
                    "identificacion_rl" => $identificacion_rl,
                    "titulo_rl" => $datos->titulo,
                    "fchaprobado" => $prov->getCaFchaprobado(),
                    "usuaprobado" => $prov->getCaUsuaprobado(),
                    "ususolicitante" => $solicitante ? utf8_encode($solicitante->getCaNombre()) : "",
                    "direccion" => utf8_encode($ppal->getCaDireccion()),
                    "ciudad" => utf8_encode($ppal->getCiudad()->getCaCiudad()),
                    "telefonos" => utf8_encode($ppal->getCaTelefonos()),
                    "aprobacion" => $prov->getCaUsuaprobado() . ' ' . $prov->getCaFchaprobado(),
                    "empresa" => utf8_encode(str_replace("|", ", ", $prov->getCaEmpresa())),
                    "transporte" => utf8_encode(str_replace("|", ", ", $prov->getCaTransporte())),
                    "idclasificacion" => $prov->getCaIdclasificacion(),
                    "route_grupo" => utf8_encode($route_grupo),
                    "jefecuenta" => utf8_encode($prov->getCaJefecuenta()),
                    "nomjefecuenta" => utf8_encode($prov->getJefe()->getCaNombre()),
                    "activo_impo" => utf8_encode($prov->getCaActivoImpo() ? "Sí" : "No"),
                    "activo_expo" => utf8_encode($prov->getCaActivoExpo() ? "Sí" : "No"),
                    "esporadico" => utf8_encode($prov->getCaEsporadico() ? "Sí" : "No"),
                    "detercero" => utf8_encode($prov->getCaTercero() ? "Sí" : "No"),
                    "fchvencimiento" => $prov->getCaFchvencimiento(),
                    "critico" => utf8_encode($prov->getCaCritico() ? "Sí" : "No"),
                    "controladoporsig" => utf8_encode($prov->getCaControladoporsig() ? "Sí" : "No"),
                    "contrato_comodato" => utf8_encode($prov->getCaContratoComodato() ? "Sí" : "No"),
                    "basc" => utf8_encode($datos->basc ? "Sí" : "No"),
                    "oea" => utf8_encode($datos->oea ? "Sí" : "No"),
                    "vomil" => utf8_encode($datos->vomil ? "Sí" : "No"),
                    "ctpat" => utf8_encode($datos->ctpat ? "Sí" : "No"),
                    "vinculantes" => utf8_decode($datos->vinculantes),
                    "vincumentario" => utf8_decode($datos->vincumentario),
                    "fchcircular" => $prov->getCaFchcircular(),
                    "fchvencircular" => $prov->getCaFchvencircular(),
                    "nvlriesgo" => utf8_encode($prov->getCaNvlriesgo()),
                    "estadoCircular" => $prov->getEstadoCircular(),
                    "website" => $prov->getIds()->getCaWebsite(),
                    "sectoreco" => utf8_encode($sectoreco),
                    "estado" => $prov->getCaActivo() ? "Activo" : ($prov->getCaVetado() ? "Vetado" : "Inactivo"),
                    "observaciones" => utf8_encode($prov->getCaObservaciones()),
                    "fchcreado" => $prov->getCaFchaprobado(),
                    "usucreado" => $prov->getCaUsuaprobado(),
                    "fchactualizado" => $prov->getCaFchaprobado(),
                    "usuactualizado" => $prov->getCaUsuaprobado(),
                    "auditorias" => utf8_encode("<b>Creado:</b> " . $prov->getCaUsucreado() . " - " . $prov->getCaFchcreado() . "&nbsp;&nbsp;&nbsp;" . "<b>Actualizado:</b> " . $prov->getCaUsuactualizado() . " - " . $prov->getCaFchactualizado() . "&nbsp;&nbsp;&nbsp;" . "<b>Financiero:</b> " . $prov->getCaUsufinanciero() . " - " . $prov->getCaFchfinanciero()),
                    "prov_estados" => $estados
                );
            } else {
                $impoexpo = array();
                if ($prov->getCaActivoImpo()) {
                    $impoexpo[] = utf8_encode("Importación");
                }
                if ($prov->getCaActivoExpo()) {
                    $impoexpo[] = utf8_encode("Exportación");
                }
                $transporte = explode("|", utf8_encode($prov->getCaTransporte()));
                $empresa = explode("|", utf8_encode($prov->getCaEmpresa()));
                $datos = json_decode(utf8_encode(($prov->getIds()->getCaDatos())));
                $data = array(
                    "idproveedor" => $prov->getCaIdproveedor(),
                    "tipo_identificacion" => $prov->getIds()->getCaTipoidentificacion(),
                    "dv_id" => $prov->getIds()->getCaDv(),
                    "idalterno_id" => $prov->getIds()->getCaIdalterno(),
                    "proveedor" => utf8_encode($prov->getIds()->getCaNombre()),
                    "idgrupo" => $prov->getIds()->getIdsGrupo() ? $prov->getIds()->getCaIdgrupo() : null,
                    "grupo" => $prov->getIds()->getIdsGrupo() ? utf8_encode($prov->getIds()->getIdsGrupo()->getCaNombre()) : null,
                    "sigla" => utf8_encode($prov->getCaSigla()),
                    "jefecuenta" => $prov->getCaJefecuenta(),
                    "aprobado" => $prov->getCaFchaprobado(),
                    "solicitante" => $prov->getCaUsusolicitud(),
                    "direccion" => utf8_encode($ppal->getCaDireccion()),
                    "ciudad" => $ppal->getCaIdciudad(),
                    "telefono" => $ppal->getCaTelefonos(),
                    "codigo_postal" => $ppal->getCaZipcode(),
                    "website" => $ppal->getIds()->getCaWebsite(),
                    "titulo" => $datos->titulo,
                    "apellido1" => $datos->papellido,
                    "apellido2" => $datos->sapellido,
                    "nombre" => $datos->nombre,
                    "genero" => $datos->genero,
                    "tpRepresentante" => $datos->tpRepresentante,
                    "idRepresentante" => $datos->idRepresentante,
                    "tipo" => $prov->getCaTipo(),
                    "tipo_proveedor" => implode(" - ", $nomtipo),
                    "sectoreco" => utf8_encode($prov->getIds()->getCaSectoreco()),
                    "idclasificacion" => $prov->getCaIdclasificacion(),
                    "controladoporsig" => utf8_encode($prov->getCaControladoporsig() ? "Sí" : "No"),
                    "estado" => $prov->getCaActivo() ? "Activo" : ($prov->getCaVetado() ? "Vetado" : "Inactivo"),
                    "impoexpo" => $impoexpo,
                    "transporte" => $transporte,
                    "empresa" => $empresa,
                    "observaciones" => utf8_encode($prov->getCaObservaciones())
                );
            }
        }

        $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    function executeGuardarProveedor($request) {
        $id = $request->getParameter("idproveedor");
        $impoexpo = $request->getParameter("impoexpo");
        $consulta_listas = false;
        $proveedor_nuevo = false;
        $consulta_rl = false;
        $empresa = implode("|", $request->getParameter("empresa"));
        $transporte = implode("|", $request->getParameter("transporte"));
        try {
            $conn = Doctrine_Manager::getInstance()->connection();
            $conn->beginTransaction();

            if ($id) {
                $ids = Doctrine::getTable("Ids")->find($id);
                $prov = Doctrine::getTable("IdsProveedor")->find($id);
            }
            if (!$ids) {
                $ids = new Ids();
            }
            if ($ids->getCaIdalterno() != $request->getParameter("idalterno_id") or $ids->getCaDv() != $request->getParameter("dv_id")) {
                $consulta_listas = true;
            }
            if ($ids->getCaNombre() != utf8_decode(strtoupper($request->getParameter("proveedor")))) {
                $consulta_listas = true;
            }
            if ($request->getParameter("idalterno_id")) {
                $ids->setCaIdalterno(trim($request->getParameter("idalterno_id")));
            }
            if (trim($request->getParameter("dv_id")) != "") {
                $ids->setCaDv($request->getParameter("dv_id"));
            }
            if ($request->getParameter("tipo_identificacion")) {
                $ids->setCaTipoidentificacion($request->getParameter("tipo_identificacion"));
            }
            if ($request->getParameter("proveedor")) {
                $ids->setCaNombre(strtoupper(utf8_decode($request->getParameter("proveedor"))));
            }
            if ($request->getParameter("website")) {
                $ids->setCaWebsite(strtolower($request->getParameter("website")));
            }
            if ($request->getParameter("sectoreco")) {
                $ids->setCaSectoreco(utf8_decode($request->getParameter("sectoreco")));
            }
            if ($request->getParameter("actividad")) {
                $ids->setCaActividad($request->getParameter("actividad"));
            }
            if ($request->getParameter("idgrupo")) {
                $ids->setCaIdgrupo($request->getParameter("idgrupo"));
            }
            # Almacena los Datos del Representante Legar en IDS ca_datos
            $datos = json_decode(utf8_encode(($ids->getCaDatos())));
            if ($datos->idRepresentante != $request->getParameter("idRepresentante") or $datos->nombre != $request->getParameter("nombre") or $datos->papellido != $request->getParameter("apellido1") or $datos->sapellido != $request->getParameter("apellido2")) {
                $consulta_rl = true;
            }
            if ($request->getParameter("titulo")) {
                $datos->titulo = $request->getParameter("titulo");
            }
            if ($request->getParameter("apellido1")) {
                $datos->papellido = $request->getParameter("apellido1");
            }
            if ($request->getParameter("apellido2")) {
                $datos->sapellido = $request->getParameter("apellido2");
            }
            if ($request->getParameter("nombre")) {
                $datos->nombre = $request->getParameter("nombre");
            }
            if ($request->getParameter("genero")) {
                $datos->genero = $request->getParameter("genero");
            }
            if ($request->getParameter("tpRepresentante")) {
                $datos->tpRepresentante = $request->getParameter("tpRepresentante");
            }
            if ($request->getParameter("idRepresentante")) {
                $datos->idRepresentante = $request->getParameter("idRepresentante");
            }
            $ids->setCaDatos(json_encode($datos));
            $ids->save();

            if (!$prov) {
                $prov = new IdsProveedor();
                $prov->setCaIdproveedor($ids->getCaId());
                $proveedor_nuevo = true;
            }
            if ($request->getParameter("tipo")) {
                $prov->setCaTipo($request->getParameter("tipo"));
            }
            if (!$prov->getCaTipo()) { /* FIX-ME: Este campo está en desuso */
                $prov->setCaTipo("TRN");
            }
            if ($request->getParameter("jefecuenta")) {
                $prov->setCaJefecuenta($request->getParameter("jefecuenta"));
            }
            if ($request->getParameter("solicitante")) {
                $prov->setCaUsusolicitud($request->getParameter("solicitante"));
            }
            if ($request->getParameter("sigla")) {
                $prov->setCaSigla(strtoupper(utf8_decode($request->getParameter("sigla"))));
            }
            if ($transporte) {
                $prov->setCaTransporte(utf8_decode($transporte));
            }
            if ($empresa) {
                $prov->setCaEmpresa($empresa);
            }
            if (in_array(utf8_encode(Constantes::IMPO), $impoexpo)) {
                $prov->setCaActivoImpo(TRUE);
            } else {
                $prov->setCaActivoImpo(FALSE);
            }
            if (in_array(utf8_encode(Constantes::EXPO), $impoexpo)) {
                $prov->setCaActivoExpo(TRUE);
            } else {
                $prov->setCaActivoExpo(FALSE);
            }
            if ($request->getParameter("estado")) {
                if ($request->getParameter("estado") == "Activo") {
                    $prov->setCaActivo(true);
                    $prov->setCaVetado(false);
                } else if ($request->getParameter("estado") == "Vetado") {
                    $prov->setCaActivo(false);
                    $prov->setCaVetado(true);
                } else {
                    $prov->setCaActivo(false);
                    $prov->setCaVetado(false);
                }
            }
            if ($request->getParameter("idclasificacion")) {
                $prov->setCaIdclasificacion($request->getParameter("idclasificacion"));
            }
            if ($request->getParameter("controladoporsig")) {
                $prov->setCaControladoporsig($request->getParameter("controladoporsig"));
            }
            if ($request->getParameter("observaciones")) {
                $prov->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
            }
            $prov->save();

            $suc = $ids->getSucursalPrincipal();
            if (!$suc) {
                $suc = new IdsSucursal();
                $suc->setCaId($ids->getCaId());
                $suc->setCaPrincipal(TRUE);
                $suc->setCaNombre("Domicilio Principal");
            }
//            if ($suc->getCaDireccion() != $request->getParameter("direccion") or $suc->getCaIdciudad() != $request->getParameter("ciudad")) {
//                $consulta_listas = true;
//            }
            if ($request->getParameter("direccion")) {
                $suc->setCaDireccion($request->getParameter("direccion"));
            }
            if ($request->getParameter("telefono")) {
                $suc->setCaTelefonos($request->getParameter("telefono"));
            }
            if ($request->getParameter("fax")) {
                $suc->setCaFax($request->getParameter("fax"));
            } else {
                $suc->setCaFax("-");
            }
            if ($request->getParameter("ciudad")) {
                $suc->setCaIdciudad($request->getParameter("ciudad"));
            }
            if ($request->getParameter("codigo_postal")) {
                $suc->setCaZipcode($request->getParameter("codigo_postal"));
            }
            $suc->save();

            /* Lanza una consulta del Proveedor en Infolaft - Listas Vinculantes */
            if ($this->getUser()->getIdtrafico() != "PE-051" and $consulta_listas) {
                $ids->getNuevaConsulta("Id&Nombre");
            }

            /* Lanza una Consulta sobre el Representante Legal */
            if ($proveedor_nuevo or $consulta_rl) {
                IdsRestrictivasTable::lanzarConsultaInfolaft($ids->getCaId(), $datos->idRepresentante, $datos->nombre . " " . $datos->papellido . " " . $datos->sapellido, "Id&Nombre");
            }

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    function executeInformeProveedores($request) {
        $data = array();
        $q = Doctrine::getTable("IdsProveedor")
                ->createQuery("p")
                ->leftJoin("p.Ids i")
                ->leftJoin("i.IdsSucursal s")
                ->leftJoin("s.Ciudad c")
                ->leftJoin("p.IdsTipo t")
                ->addWhere("p.ca_activo = true")
                ->addOrderBy("t.ca_nombre ASC");
        $proveedores = $q->execute();

        $con = Doctrine_Manager::getInstance()->connection();
        foreach ($proveedores as $proveedor) {
//            $polzvencimiento = null;
//            $doc = $proveedor->getIds()->getDocumento( 4 );
//            if( $doc ){
//                if( $doc->getCaFchvencimiento() ){
//                    $polzvencimiento = $doc->getCaFchvencimiento();
//                }else{
//                     $polzvencimiento = "Sin vencimiento";
//                }
//            }else{
//                 $polzvencimiento = "Sin Poliza";
//            }
//            
//            $bascvencimiento = null;
//            $doc = $proveedor->getIds()->getDocumento( 7 );
//            if( $doc ){
//                if( $doc->getCaFchvencimiento() ){
//                    $bascvencimiento = $doc->getCaFchvencimiento();
//                }else{
//                     $bascvencimiento = "Sin vencimiento";
//                }
//            }else{
//                 $bascvencimiento = "Sin BASC";
//            }
//            
//            $eeffvencimiento = null;
//            $doc = $proveedor->getIds()->getDocumento( 23 );
//            if( $doc ){
//                if( $doc->getCaFchvencimiento() ){
//                    $eeffvencimiento = $doc->getCaFchvencimiento();
//                }else{
//                     $eeffvencimiento = "Sin vencimiento";
//                }
//            }else{
//                 $eeffvencimiento = "Sin Est.Financieros";
//            }
//            
//            $risgvencimiento = null;
//            $doc = $proveedor->getIds()->getDocumento( 45 );
//            if( $doc ){
//                if( $doc->getCaFchvencimiento() ){
//                    $risgvencimiento = $doc->getCaFchvencimiento();
//                }else{
//                     $risgvencimiento = "Sin vencimiento";
//                }
//            }else{
//                 $risgvencimiento = "Sin Calif.Riesgo";
//            }
//            $ciudades = null;
//            foreach( $proveedor->getIds()->getIdsSucursal() as $sucursal ){
//                $ciudades.= utf8_encode($sucursal->getCiudad()->getCaCiudad()).", ";
//            }
            $anios = array();
            foreach (range(date("Y") - 2, date("Y")) as $anio) {
                $anios[] = $anio;
            }
            $evaluaciones = Doctrine::getTable("IdsEvaluacion")
                    ->createQuery("e")
                    ->where("e.ca_id=?", $proveedor->getIds()->getCaId())
                    ->whereIn("e.ca_ano", $anios)
                    ->addOrderBy("e.ca_ano, e.ca_periodo")
                    ->execute();

            $ponderaciones = array();
            foreach ($evaluaciones as $evaluacion) {
                $ponderaciones[$evaluacion->getCaAno()][$evaluacion->getCaPeriodo()] = $evaluacion->getPonderacion();
            }

            $record = array("idproveedor" => utf8_encode($proveedor->getIds()->getCaId()),
                "idalterno" => utf8_encode($proveedor->getIds()->getCaIdalterno()),
                "nombre" => htmlspecialchars(utf8_encode($proveedor->getIds()->getCaNombre())),
                "nomjefecuenta" => utf8_encode($proveedor->getJefe()->getCaNombre()),
                "sucursal" => utf8_encode($proveedor->getJefe()->getCaSucursal()),
                "empresas" => utf8_encode(str_replace("|", ", ", $proveedor->getCaEmpresa())),
                "estado" => $proveedor->getCaActivo() ? "Activo" : ($proveedor->getCaVetado() ? "Vetado" : "Inactivo"),
                "critico" => utf8_encode($proveedor->getCaCritico() ? "Sí" : "No"),
                "fchaprobado" => $proveedor->getCaFchaprobado(),
                "usuaprobado" => $proveedor->getCaUsuaprobado(),
//                "activo_impo" => utf8_encode($proveedor->getCaActivoImpo() ? "Sí" : "No"),
//                "activo_expo" => utf8_encode($proveedor->getCaActivoExpo() ? "Sí" : "No"),
//                "fchcircular" => $proveedor->getCaFchcircular(),
//                "fchvencircular" => $proveedor->getCaFchvencircular(),
//                "nvlriesgo" => utf8_encode($proveedor->getCaNvlriesgo()),
//                "polzvencimiento" => $polzvencimiento,
//                "bascvencimiento" => $bascvencimiento,
//                "eeffvencimiento" => $eeffvencimiento,
//                "risgvencimiento" => $risgvencimiento,
//                "ciudades" => $ciudades,
            );
            foreach ($anios as $key => $anio) {
                foreach (range(1, 2) as $periodo) {
                    $record["eva_" . str_pad($key, 2, "0", STR_PAD_LEFT) . "_" . str_pad($periodo, 2, "0", STR_PAD_LEFT)] = $ponderaciones[$anio][$periodo];
                }
            }
            $data[] = $record;
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $debug, "query" => $query);
        $this->setTemplate("responseTemplate");
    }

    function executeDocumentosProveedores($request) {
        $fchvencimiento = $request->getParameter("fchvencimiento");
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select ca_id, max(ca_iddocumento::int) as ca_iddocumento from ids.tb_documentos where ca_fchvencimiento <= '$fchvencimiento' group by ca_id, ca_idtipo";
        
        $st = $con->execute($sql);
        $iddoc = $st->fetchAll();
        $iddoc = array_column($iddoc, 'ca_iddocumento');

        $data = array();
        $reqs = array();
        $q = Doctrine::getTable("IdsDocumento")
            ->createQuery("d")
            ->whereIn("d.ca_iddocumento", $iddoc);

        $documentos = $q->execute();
        foreach ($documentos as $documento) {
            $data[] = array(
                "iddocumento" => $documento->getCaIddocumento(),
                "idproveedor" => $documento->getCaId(),
                "idalterno" => $documento->getIds()->getCaIdalterno(),
                "nombre" => htmlspecialchars(utf8_encode($documento->getIds()->getCaNombre())),
                "nomjefecuenta" => utf8_encode($documento->getIds()->getIdsProveedor()->getJefe()->getCaNombre()),
                "sucursal" => utf8_encode($documento->getIds()->getIdsProveedor()->getUsuario()->getSucursal()->getCaNombre()),
                "tipo" => utf8_encode($documento->getIdsTipoDocumento()->getCaTipo()),
                "fchinicio" => $documento->getCaFchinicio(),
                "fchvencimiento" => $documento->getCaFchvencimiento(),
                "ubicacion" => utf8_encode($documento->getCaUbicacion()),
                "observaciones" => utf8_encode($documento->getCaObservaciones()),
                "fchcreado" => $documento->getCaFchcreado(),
                "usucreado" => $documento->getCaUsucreado()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $debug, "query" => $query);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeValidarNITExistente(sfWebRequest $request) {
        $idalterno = $request->getParameter("idalterno");
        $ids = Doctrine::getTable("Ids")
                ->createQuery("i")
                // ->innerJoin("i.IdsCliente c")
                ->addWhere('i.ca_idalterno = ?', $idalterno)
                ->fetchOne();

        $error = null;
        $data = null;
        $agente = array();
        if ($ids) {
            if ($ids->getIdsProveedor()) {
                $error = utf8_encode("El número de NIT ya se encuentra registrado como Proveedor en la maestra!");
            } else {
                // $agente = ($ids->getIdsAgente())?true:false; /* Valida si se está creando un Agente como Proveedor */
                $agente = Doctrine::getTable("Ids")
                        ->createQuery("i")
                        ->innerJoin("i.IdsAgente a")
                        ->addWhere('i.ca_idalterno = ?', $idalterno)
                        ->fetchOne();

                $data["idproveedor"] = $ids->getCaId();
                $data["tipo_identificacion"] = utf8_encode($ids->getIdsTipoIdentificacion()->getCaTipoidentificacion());
                $data["idalterno_id"] = utf8_encode($ids->getCaIdalterno());
                $data["dv_id"] = utf8_encode($ids->getCaDv());
                $data["proveedor"] = utf8_encode($ids->getCaNombre());

                $sucPrincipal = $ids->getSucursalPrincipal();
                if ($sucPrincipal) {
                    if ($ids->getIdsTipoIdentificacion()->getCaIdtrafico() == 'CO-057') {
                        $data["direccion"] = utf8_encode($sucPrincipal->getCaDireccion());
                        $data["codigo_postal"] = utf8_encode($sucPrincipal->getCaZipcode());
                        $data["ciudad"] = utf8_encode($sucPrincipal->getCaIdciudad());
                        $data["telefono"] = utf8_encode($sucPrincipal->getCaTelefonos());
                        $data["fax"] = utf8_encode($sucPrincipal->getCaFax());
                    } else {
                        $data["direccion0"] = utf8_encode($sucPrincipal->getCaDireccion());
                        $data["localidad2"] = utf8_encode($sucPrincipal->getCaLocalidad());
                        $data["ciudad2"] = utf8_encode($sucPrincipal->getCaIdciudad());
                    }
                }

                $datos = json_decode(utf8_encode(($ids->getCaDatos())));
                if ($datos->tpRepresentante) {
                    $data["titulo"] = $datos->titulo;
                    $data["nombre"] = $datos->nombre;
                    $data["apellido1"] = $datos->papellido;
                    $data["apellido2"] = $datos->sapellido;
                    $data["tpRepresentante"] = $datos->tpRepresentante;
                    $data["idRepresentante"] = $datos->idRepresentante;
                    $data["genero"] = $datos->genero;
                } else if ($ids->getIdsCliente() && $ids->getIdsCliente()->getCaTipoidentificacionRl()) {
                    $data["titulo"] = utf8_encode($ids->getIdsCliente()->getCaSaludo());
                    $data["nombre"] = utf8_encode($ids->getIdsCliente()->getCaNombres());
                    $data["apellido1"] = utf8_encode($ids->getIdsCliente()->getCaPapellido());
                    $data["apellido2"] = utf8_encode($ids->getIdsCliente()->getCaSapellido());
                    $data["tpRepresentante"] = utf8_encode($ids->getIdsCliente()->getCaTipoidentificacionRl());
                    $data["idRepresentante"] = utf8_encode($ids->getIdsCliente()->getCaNumidentificacionRl());
                    $data["genero"] = utf8_encode($ids->getIdsCliente()->getCaSexo() == "M" ? "Masculino" : "Femenino");
                }
            }
        }
        $data["dv_valido"] = Utils::calcularDV($idalterno);
        $this->responseArray = array("success" => true, "data" => $data, "error" => $error, "agente" => ($agente) ? true : false);

        $this->setTemplate("responseTemplate");
    }

    function executeAprobarProveedor($request) {
        $id = $request->getParameter("idproveedor");
        $conn = Doctrine::getTable("IdsProveedor")->getConnection();
        try {
            $conn->beginTransaction();

            $prov = Doctrine::getTable("IdsProveedor")->find($id);
            if ($prov) {
                $prov->setCaUsuaprobado($this->getUser()->getUserId());
                $prov->setCaFchaprobado(date("Y-m-d"));
            }
            $prov->save();

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarContacto(sfWebRequest $request) {
        $idContacto = $request->getParameter("idcontacto");
        if ($idContacto) {
            $contacto = Doctrine::getTable("IdsContacto")
                    ->createQuery("i")
                    // ->addWhere('i.ca_idcliente = ?', $idCliente)
                    ->addWhere('i.ca_idcontacto = ?', $idContacto)
                    ->fetchOne();
            $data = array();
            if ($contacto) {
                $data["saludo"] = utf8_encode($contacto->getCaSaludo());
                $data["nombres"] = utf8_encode($contacto->getCaNombres());
                $data["primer_apellido"] = utf8_encode($contacto->getCaPapellido());
                $data["segundo_apellido"] = utf8_encode($contacto->getCaSapellido());
                $data["cargo_general"] = utf8_encode($contacto->getCaCargo());
                $data["visibilidad"] = utf8_encode($contacto->getCaVisibilidad());
                $data["departamento"] = utf8_encode($contacto->getCaDepartamento());
                $data["telefono"] = utf8_encode($contacto->getCaTelefonos());
                $data["celular"] = utf8_encode($contacto->getCaCelular());
                $data["correo"] = $contacto->getCaEmail();
                $data["idsucursal"] = $contacto->getCaIdsucursal();
                $data["codigoarea"] = $contacto->getCaCodigoarea();
                $data["impoexpo"] = explode("|", utf8_encode($contacto->getCaImpoexpo()));
                $data["transporte"] = explode("|", utf8_encode($contacto->getCaTransporte()));
                $data["activo"] = $contacto->getCaActivo();
                $data["sugerido"] = $contacto->getCaSugerido();
                $data["factutronica"] = $contacto->getCaFactElectronica();
                $data["notificar_vencimientos"] = $contacto->getCaNotificarVencimientos();
                $data["observaciones"] = utf8_encode($contacto->getCaObservaciones());
            }

            $caso = "CU265";
            $cargodef = ParametroTable::retrieveByCaso($caso, $contacto->getCaCargoGeneral(), null, null);
            $mostrar = ($cargodef[0]->getCaValor2());

            $this->responseArray = array("success" => true, "data" => $data, "mostrar" => $mostrar);
            $this->setTemplate("responseTemplate");
        } else {
            $idCliente = $request->getParameter("idcliente");
            $ids = Doctrine::getTable("Ids")
                    ->createQuery("i")
                    ->addWhere('i.ca_id = ?', $idCliente)
                    ->fetchOne();
            $data["tipo_cliente"] = $ids->getIdsCliente()->getCaTipo();

            $this->responseArray = array("success" => true, "data" => $data);
            $this->setTemplate("responseTemplate");
        }
    }

    function executeDocumentosProveedor($request) {
        $con = Doctrine_Manager::getInstance()->connection();
        if ($request->getParameter("tipo") && $request->getParameter("tipo") == 'historico') {
            $sql = "select ca_iddocumento from ids.tb_documentos where ca_id = " . $request->getParameter("idproveedor");
        } else {
            $sql = "select max(ca_iddocumento::int) as ca_iddocumento from ids.tb_documentos where ca_id = " . $request->getParameter("idproveedor") . " group by ca_idtipo";
        }
        $st = $con->execute($sql);
        $iddoc = $st->fetchAll();
        $iddoc = array_column($iddoc, 'ca_iddocumento');
        $idsproveedor = Doctrine::getTable("IdsProveedor")->find($request->getParameter("idproveedor"));

        $data = array();
        $reqs = array();
        $q = Doctrine::getTable("IdsDocumento")
            ->createQuery("d")
            ->whereIn("d.ca_iddocumento", $iddoc);
        
        if ($request->getParameter("tipo") && $request->getParameter("tipo") == 'historico') {
            $q->addOrderBy("date_part('YEAR', d.ca_fchinicio) DESC, d.ca_idtipo, d.ca_iddocumento ");
        } else {
            $q->addOrderBy("d.ca_idtipo, d.ca_iddocumento ");
        }
        $documentos = $q->execute();
        foreach ($documentos as $documento) {
            if (!count($reqs)) {
                $sql = "select ca_idtipo from ids.tb_documentosxtipo where ca_tipo = '" . $idsproveedor->getCaTipo() . "'";
                $st = $con->execute($sql);
                $idreq = $st->fetchAll();
                $idreq = array_column($idreq, 'ca_idtipo');
            }
            $requerido = in_array($documento->getCaIdtipo(), $idreq) ? "Documentos Requeridos" : "Otros Documentos";
            $data[] = array(
                "anio" => substr($documento->getCaFchinicio(), 0, 4),
                "iddocumento" => $documento->getCaIddocumento(),
                "idtipo" => $documento->getCaIdtipo(),
                "tipo" => utf8_encode($documento->getIdsTipoDocumento()->getCaTipo()),
                "clase" => $requerido,
                "ubicacion" => utf8_encode($documento->getCaUbicacion()),
                "fchinicio" => $documento->getCaFchinicio(),
                "fchvencimiento" => $documento->getCaFchvencimiento(),
                "observaciones" => utf8_encode($documento->getCaObservaciones()),
                "fchcreado" => $documento->getCaFchcreado(),
                "usucreado" => $documento->getCaUsucreado()
            );
        }
        if (count($faltantes)) {
            $sql = "select t.ca_idtipo, t.ca_tipo, d.ca_solo_si_aplica from ids.tb_tipodocumentos t "
                    . "left join ids.tb_documentosxtipo d on d.ca_idtipo = t.ca_idtipo and d.ca_tipo = '" . $idsproveedor->getCaTipo() . "' "
                    . "where t.ca_idtipo in ( " . implode(",", $faltantes) . " )";
            $st = $con->execute($sql);
            $idreq = $st->fetchAll();
            foreach ($idreq as $req) {
                $data[] = array(
                    "iddocumento" => null,
                    "idtipo" => $req["ca_idtipo"],
                    "tipo" => utf8_encode($req["ca_tipo"]),
                    "clase" => "Documentos Requeridos",
                    "ubicacion" => null,
                    "fchinicio" => null,
                    "fchvencimiento" => null,
                    "observaciones" => utf8_encode(($req["ca_solo_si_aplica"]) ? "Este documento debe subirse en caso que aplique para este proveedor" : "Este documento es requerido y no se ha subido al sistema."),
                    "fchcreado" => null,
                    "usucreado" => null
                );
            }
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCriteriosEvaluacion(sfWebRequest $request) {
        $tipoCriterio = array("desempeno" => "Desempeño", "seleccion" => "Selección");
        $q = Doctrine::getTable("IdsCriterio")
                ->createQuery("i")
                ->orderBy("i.ca_tipo, i.ca_tipocriterio");
        $criterios = $q->execute();
        
        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);

        foreach ($criterios as $criterio) {
            $uid = $root;
            $tipo = utf8_encode($criterio->getIdsTipo()->getCaNombre() . ' (' . $criterio->getCaTipo() . ')');
            $node_uid = $tree->findValue($uid, $tipo);
            if (!$node_uid) {
                $nodo = $tree->createNode($tipo);
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
                $nodo = $tree->getNode($uid);
                $nodo->setAttribute("idtipo", $criterio->getCaTipo());
                $nodo->setAttribute("expanded", FALSE);
            } else {
                $uid = $node_uid;
            }
            $value = utf8_encode($tipoCriterio[$criterio->getCaTipocriterio()]);
            $node_uid = $tree->findValue($uid, $value);
            if (!$node_uid) {
                $nodo = $tree->createNode($value);
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
            } else {
                $uid = $node_uid;
            }

            $nodo = $tree->getNode($uid);
            $evento_sc["text"] = utf8_encode($criterio->getCaCriterio());
            $evento_sc["idcriterio"] = $criterio->getCaIdcriterio();
            $evento_sc["ponderacion"] = utf8_encode($criterio->getCaPonderacion());
            $evento_sc["activo"] = utf8_encode($criterio->getCaActivo()?"Sí":"No");
            $evento_sc["leaf"] = true;

            $nodo->setAttribute("children", $evento_sc);
        }
        $data = $tree->getTreeNodes();
//        print_r($data);
        $this->responseArray = array("success" => true, "children" => $data["children"], "total" => count($data));
        $this->setTemplate("responseTemplate");
        
    }

    public function executeGridCriteriosEval(sfWebRequest $request) {
        $tipo = $request->getParameter("tipo");

        $q = Doctrine::getTable("IdsCriterio")
                ->createQuery("i")
                ->addWhere('i.ca_activo = TRUE')
                ->addWhere('i.ca_tipo = ?', $tipo)
                ->addWhere('i.ca_tipocriterio = ?', $request->getParameter("tipocriterio"));

        if ($request->getParameter("impoexpo")) {
            $q->addWhere('i.ca_impoexpo = ?', utf8_decode($request->getParameter("impoexpo")));
        }

        if ($request->getParameter("transporte")) {
            $q->addWhere('i.ca_transporte = ?', utf8_decode($request->getParameter("transporte")));
        }
        $criterios = $q->execute();

        $data = array();
        foreach ($criterios as $criterio) {
            $row = array(
                "idcriterio" => $criterio->getCaIdcriterio(),
                "criterio" => utf8_encode($criterio->getCaCriterio()),
                "ponderacion" => $criterio->getCaPonderacion(),
                "impoexpo" => utf8_encode($criterio->getCaImpoexpo()),
                "transporte" => utf8_encode($criterio->getCaTransporte())
            );
            $data[] = $row;
        }
        $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    function executeEvaluacionesProveedor($request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select max(ca_iddocumento::int) as ca_iddocumento from ids.tb_documentos where ca_id = " . $request->getParameter("idproveedor") . " group by ca_idtipo";
        $st = $con->execute($sql);
        $iddoc = $st->fetchAll();
        $iddoc = array_column($iddoc, 'ca_iddocumento');

        $data = array();
        $reqs = array();
        $evaluaciones = Doctrine::getTable("IdsEvaluacion")
                ->createQuery("e")
                ->whereIn("e.ca_id", $request->getParameter("idproveedor"))
                ->addWhere("e.ca_ano > ?", date("Y") - 5)
                ->addOrderBy("e.ca_ano desc, e.ca_periodo desc, e.ca_fchevaluacion desc")
                ->execute();

        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);

        foreach ($evaluaciones as $evaluacion) {
            $uid = $root;
            $node_uid = $tree->findValue($uid, $evaluacion->getCaAno());
            if (!$node_uid) {
                $nodo = $tree->createNode($evaluacion->getCaAno());
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
            } else {
                $uid = $node_uid;
            }

            $value = "Periodo # " . (!$evaluacion->getCaPeriodo() ? 1 : $evaluacion->getCaPeriodo());
            $node_uid = $tree->findValue($uid, $value);
            if (!$node_uid) {
                $nodo = $tree->createNode($value);
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
            } else {
                $uid = $node_uid;
            }
            $children = array();
            foreach ($evaluacion->getIdsEvaluacionxCriterio() as $criterio) {
                $children[] = array(
                    "text" => utf8_encode($criterio->getIdsCriterio()->getCaCriterio()),
                    "ponderacion" => $criterio->getCaPonderacion(),
                    "calificacion" => $criterio->getCaValor(),
                    "observaciones" => utf8_encode($criterio->getCaObservaciones()),
                    "leaf" => true
                );
            }

            $nodo = $tree->getNode($uid);
            $evaluacion_sc["text"] = $evaluacion->getCaFchevaluacion();
            $evaluacion_sc["tipo"] = utf8_encode($evaluacion->getCaTipo());
            $evaluacion_sc["concepto"] = utf8_encode($evaluacion->getCaConcepto());
            $evaluacion_sc["idevaluacion"] = $evaluacion->getCaIdevaluacion();
            $evaluacion_sc["leaf"] = count($children) ? false : true;

            $calificacion = 0;
            foreach ($children as $child) {
                $calificacion += $child["calificacion"] * $child["ponderacion"] / 100;
            }
            $evaluacion_sc["ponderacion"] = array_sum(array_column($children, 'ponderacion'));
            $evaluacion_sc["calificacion"] = round($calificacion, 1);

            $evaluacion_sc["children"] = $children;
            $nodo->setAttribute("children", $evaluacion_sc);
        }
        $data = $tree->getTreeNodes();
        // print_r($data);
        $this->responseArray = array("success" => true, "children" => $data["children"], "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarEvaluacion(sfWebRequest $request) {
        $id = $request->getParameter("idproveedor");
        $eval = json_decode($request->getParameter("eval"));
        $data = json_decode($request->getParameter("data"));

        $conn = Doctrine::getTable("IdsProveedor")->getConnection();
        try {
            $conn->beginTransaction();

            $idsEvaluacion = new IdsEvaluacion();
            $idsEvaluacion->setCaId($id);
            $idsEvaluacion->setCaTipo($eval->tipocriterio);
            $idsEvaluacion->setCaConcepto($eval->impoexpo);
            $defAno = date("Y");
            if (date("Y-m-d") >= date('Y') . "-04-01" && date("Y-m-d") <= date('Y') . "-09-01") {
                $defPeriodo = 1;
            } else if (date("Y-m-d") >= date('Y') . "-09-01" && date("Y-m-d") <= date('Y') . "-12-31") {
                $defPeriodo = 2;
            } else {
                $defPeriodo = 2;
                if (date('Y') . "-01-01" <= date("Y-m-d")) {
                    $defAno--;
                }
            }
            $idsEvaluacion->setCaAno($defAno);
            $idsEvaluacion->setCaPeriodo($defPeriodo);
            $idsEvaluacion->setCaFchevaluacion(date("Y-m-d"));
            $idsEvaluacion->save();
            foreach ($data as $rec) {
                $evaluacionxcriterio = new IdsEvaluacionxCriterio();
                $evaluacionxcriterio->setCaIdcriterio($rec->idcriterio);
                $evaluacionxcriterio->setCaPonderacion($rec->ponderacion);
                $evaluacionxcriterio->setCaValor($rec->calificacion);
                $evaluacionxcriterio->setIdsEvaluacion($idsEvaluacion);
                if ($rec->observaciones) {
                    $evaluacionxcriterio->setCaObservaciones(utf8_decode($rec->observaciones));
                } else {
                    $evaluacionxcriterio->setCaObservaciones(null);
                }
                $evaluacionxcriterio->save();
            }
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarEvaluacion(sfWebRequest $request) {
        $idevaluacion = $request->getParameter("idevaluacion");
        $evaluacion = Doctrine::getTable("IdsEvaluacion")->find($idevaluacion);
        $con = Doctrine::getTable("IdsEvaluacion")->getConnection();
        try {
            $con->beginTransaction();
            if ($evaluacion) {
                $evaluacion->delete();
            }
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    function executeEventosProveedor($request) {
        $tipoCriterio = array("desempeno" => "Desempeño", "seleccion" => "Selección");
        $eventos = Doctrine::getTable("IdsEvento")
                ->createQuery("e")
                ->innerJoin("e.IdsCriterio c")
                ->addWhere('e.ca_id = ?', $request->getParameter("idproveedor"))
                ->addOrderBy("date_part('year', e.ca_fchcreado) desc, c.ca_tipocriterio, e.ca_idcriterio, e.ca_idevento DESC")
                ->execute();
        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);

        foreach ($eventos as $evento) {
            $uid = $root;
            $anio = substr($evento->getCaFchcreado(), 0, 4);
            $node_uid = $tree->findValue($uid, $anio);
            if (!$node_uid) {
                $nodo = $tree->createNode($anio);
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
                $nodo = $tree->getNode($uid);
                $nodo->setAttribute("expanded", FALSE);
            } else {
                $uid = $node_uid;
            }
            $value = utf8_encode($tipoCriterio[$evento->getIdsCriterio()->getCaTipocriterio()]);
            $node_uid = $tree->findValue($uid, $value);
            if (!$node_uid) {
                $nodo = $tree->createNode($value);
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
            } else {
                $uid = $node_uid;
            }
            $value = utf8_encode($evento->getIdsCriterio()->getCaCriterio());
            $node_uid = $tree->findValue($uid, $value);
            if (!$node_uid) {
                $nodo = $tree->createNode($value);
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
            } else {
                $uid = $node_uid;
            }

            $nodo = $tree->getNode($uid);
            $evento_sc["text"] = $evento->getCaFchcreado() . " - " . $evento->getCaUsucreado();
            $evento_sc["idevento"] = $evento->getCaIdevento();
            $evento_sc["evento"] = utf8_encode($evento->getCaEvento());
            $evento_sc["idproveedor"] = $evento->getCaId();
            $evento_sc["idcriterio"] = $evento->getCaIdcriterio();
            $evento_sc["referencia"] = utf8_encode($evento->getCaReferencia());
            $evento_sc["leaf"] = true;

            $nodo->setAttribute("children", $evento_sc);
        }
        $data = $tree->getTreeNodes();
//        print_r($data);
        $this->responseArray = array("success" => true, "children" => $data["children"], "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosUnEvento(sfWebRequest $request) {
        $idEvento = $request->getParameter("idevento");

        if ($idEvento) {
            $evento = Doctrine::getTable("IdsEvento")
                    ->createQuery("e")
                    ->addWhere('e.ca_idevento = ?', $idEvento)
                    ->fetchOne();
        } else {
            $evento = new IdsEvento();
        }

        $data = array();
        if ($evento) {
            $data["idevento"] = $evento->getCaIdevento();
            $data["evento"] = utf8_encode($evento->getCaEvento());
            $data["idproveedor"] = $evento->getCaId();
            $data["referencia"] = $evento->getCaReferencia();
            $data["idcriterio"] = $evento->getCaIdcriterio();
            $data["auditorias"] = utf8_encode("<b>Creado:</b> " . $evento->getCaUsucreado() . " - " . $evento->getCaFchcreado());
        }
        $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarEvento(sfWebRequest $request) {
        $idproveedor = $request->getParameter("idproveedor");
        $idevento = $request->getParameter("idevento");

        if ($idevento) {
            $evento = Doctrine::getTable("IdsEvento")->find($idevento);
        }

        if (!$evento) {
            $evento = new IdsEvento();
            $evento->setCaIdproveedor($idproveedor);
        }

        $con = Doctrine::getTable("IdsEvento")->getConnection();
        try {
            $con->beginTransaction();
            if ($request->getParameter("idcriterio") != null) {
                $evento->setCaIdcriterio($request->getParameter("idcriterio"));
            }
            if ($request->getParameter("evento") != null) {
                $evento->setCaEvento(utf8_decode($request->getParameter("evento")));
            }
            if ($request->getParameter("referencia") != null) {
                $evento->setCaReferencia($request->getParameter("referencia"));
            }
            $evento->save();
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarEvento(sfWebRequest $request) {
        $idevento = $request->getParameter("idevento");
        $evento = Doctrine::getTable("IdsEvento")->find($idevento);
        $con = Doctrine::getTable("IdsEvento")->getConnection();
        try {
            $con->beginTransaction();
            if ($evento) {
                $evento->delete();
            }
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosUnCriterio(sfWebRequest $request) {
        $idCriterio = $request->getParameter("idcriterio");

        if ($idCriterio) {
            $criterio = Doctrine::getTable("IdsCriterio")
                    ->createQuery("e")
                    ->addWhere('e.ca_idcriterio = ?', $idCriterio)
                    ->fetchOne();
        } else {
            $criterio = new IdsCriterio();
        }

        $data = array();
        if ($criterio) {
            $data["idcriterio"] = $criterio->getCaIdcriterio();
            $data["tipo"] = $criterio->getCaTipo();
            $data["criterio"] = utf8_encode($criterio->getCaCriterio());
            $data["tipocriterio"] = $criterio->getCaTipocriterio();
            $data["ponderacion"] = $criterio->getCaPonderacion();
            $data["activo"] = $criterio->getCaActivo();
            $data["auditorias"] = utf8_encode("<b>Creado:</b> " . $criterio->getCaUsucreado() . " - " . $criterio->getCaFchcreado() . "&nbsp;&nbsp;&nbsp;" . "<b>Actualizado:</b> " . $criterio->getCaUsuactualizado() . " - " . $criterio->getCaFchactualizado());
        }
        $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarCriterio(sfWebRequest $request) {
        $idcriterio = $request->getParameter("idcriterio");

        if ($idcriterio) {
            $criterio = Doctrine::getTable("IdsCriterio")->find($idcriterio);
        }

        if (!$criterio) {
            $criterio = new IdsCriterio();
        }

        $con = Doctrine::getTable("IdsCriterio")->getConnection();
        try {
            $con->beginTransaction();
            if ($request->getParameter("tipo") != null) {
                $criterio->setCaTipo($request->getParameter("tipo"));
            }
            if ($request->getParameter("criterio") != null) {
                $criterio->setCaCriterio(utf8_decode($request->getParameter("criterio")));
            }
            if ($request->getParameter("tipocriterio") != null) {
                $criterio->setCaTipocriterio($request->getParameter("tipocriterio"));
            }
            if ($request->getParameter("ponderacion") != null) {
                $criterio->setCaPonderacion($request->getParameter("ponderacion"));
            }
            if ($request->getParameter("activo") != null) {
                $criterio->setCaActivo($request->getParameter("activo"));
            }
            $criterio->save();
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarCriterio(sfWebRequest $request) {
        $idcriterio = $request->getParameter("idcriterio");
        $criterio = Doctrine::getTable("IdsCriterio")->find($idcriterio);
        $con = Doctrine::getTable("IdsCriterio")->getConnection();
        try {
            $con->beginTransaction();
            if ($criterio) {
                $criterio->delete();
            }
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosUnTipoIds(sfWebRequest $request) {
        $idtipo = $request->getParameter("idtipo");

        if ($idtipo) {
            $tipo = Doctrine::getTable("IdsTipo")
                    ->createQuery("t")
                    ->addWhere('t.ca_tipo = ?', $idtipo)
                    ->fetchOne();
        } else {
            $tipo = new IdsTipo();
        }

        $data = array();
        if ($tipo) {
            $data["idtipo"] = $tipo->getCaTipo();
            $data["nombre"] = utf8_encode($tipo->getCaNombre());
            $data["aplicacion"] = utf8_encode($tipo->getCaAplicacion());
        }
        $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarTipoIds(sfWebRequest $request) {
        $idtipo = $request->getParameter("idtipo");

        if ($idtipo) {
            $tipo = Doctrine::getTable("IdsTipo")->find($idtipo);
        }

        if (!$tipo) {
            $tipo = new IdsTipo();
        }

        $con = Doctrine::getTable("IdsTipo")->getConnection();
        try {
            $con->beginTransaction();
            if ($request->getParameter("idtipo") != null) {
                $tipo->setCaTipo($request->getParameter("idtipo"));
            }
            if ($request->getParameter("nombre") != null) {
                $tipo->setCaNombre(utf8_decode($request->getParameter("nombre")));
            }
            if ($request->getParameter("aplicacion") != null) {
                $tipo->setCaAplicacion($request->getParameter("aplicacion"));
            }
            $tipo->save();
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarTipoIds(sfWebRequest $request) {
        $idtipo = $request->getParameter("idtipo");
        $tipo = Doctrine::getTable("IdsTipo")->find($idtipo);
        $con = Doctrine::getTable("IdsTipo")->getConnection();
        try {
            $con->beginTransaction();
            if ($tipo) {
                $tipo->delete();
            }
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarContacto(sfWebRequest $request) {
        $idContacto = $request->getParameter("idcontacto");
        $impoexpo = implode("|", $request->getParameter("impoexpo"));
        $transporte = implode("|", $request->getParameter("transporte"));
        $activo = $request->getParameter("activo");
        $sugerido = $request->getParameter("sugerido");
        $fact_electronica = $request->getParameter("factutronica");
        $notificarVencimientos = $request->getParameter("notificar_vencimientos");

        if ($idContacto) {
            $contacto = Doctrine::getTable("IdsContacto")
                    ->createQuery("i")
                    ->addWhere('i.ca_idcontacto = ?', $idContacto)
                    ->fetchOne();
        } else {
            $contacto = new IdsContacto();
        }

        $conn = Doctrine::getTable("Contacto")->getConnection();
        try {
            $conn->beginTransaction();
            if ($request->getParameter("saludo")) {
                $contacto->setCaSaludo(utf8_decode($request->getParameter("saludo")));
            }
            if ($request->getParameter("nombres")) {
                $contacto->setCaNombres(utf8_decode($request->getParameter("nombres")));
            }
            if ($request->getParameter("primer_apellido")) {
                $contacto->setCaPapellido(utf8_decode($request->getParameter("primer_apellido")));
            }
            if ($request->getParameter("segundo_apellido")) {
                $contacto->setCaSapellido(utf8_decode($request->getParameter("segundo_apellido")));
            }
            if ($request->getParameter("identificacion_tipo")) {
                $contacto->setCaIdentificacionTipo(utf8_decode($request->getParameter("identificacion_tipo")));
            }
            if ($request->getParameter("identificacion")) {
                $contacto->setCaIdentificacion($request->getParameter("identificacion"));
            }
            if ($request->getParameter("cargo_general")) {
                $contacto->setCaCargo(utf8_decode($request->getParameter("cargo_general")));
            }
            if ($request->getParameter("visibilidad")) {
                $contacto->setCaVisibilidad(utf8_decode($request->getParameter("visibilidad")));
            }
            if ($request->getParameter("departamento")) {
                $contacto->setCaDepartamento(utf8_decode($request->getParameter("departamento")));
            }
            if ($request->getParameter("telefono")) {
                $contacto->setCaTelefonos(utf8_decode($request->getParameter("telefono")));
            }
            if ($request->getParameter("celular")) {
                $contacto->setCaCelular(utf8_decode($request->getParameter("celular")));
            }
            if ($request->getParameter("correo")) {
                $contacto->setCaEmail(utf8_decode($request->getParameter("correo")));
            }
            if ($request->getParameter("idsucursal")) {
                $contacto->setCaIdsucursal($request->getParameter("idsucursal"));
            }
            if ($request->getParameter("codigoarea")) {
                $contacto->setCaCodigoarea($request->getParameter("codigoarea"));
            }
            if (isset($impoexpo)) {
                $contacto->setCaImpoexpo(utf8_decode($impoexpo));
            }
            if (isset($transporte)) {
                $contacto->setCaTransporte(utf8_decode($transporte));
            }
            if (isset($activo)) {
                $contacto->setCaActivo($activo);
            }
            if (isset($sugerido)) {
                $contacto->setCaSugerido($sugerido);
            }
            if (isset($fact_electronica)) {
                $contacto->setCaFactElectronica($fact_electronica);
            }
            if (isset($notificarVencimientos)) {
                $contacto->setCaNotificarVencimientos($notificarVencimientos);
            }
            if ($request->getParameter("observaciones")) {
                $contacto->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
            }

            $contacto->save();
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDocumento(sfWebRequest $request) {
        $idDocumento = $request->getParameter("iddocumento");

        if ($idDocumento) {
            $documento = Doctrine::getTable("IdsDocumento")
                    ->createQuery("d")
                    ->addWhere('d.ca_iddocumento = ?', $idDocumento)
                    ->fetchOne();
        } else {
            $documento = new IdsDocumento();
        }

        $data = array();
        if ($documento) {
            $data["idtipo"] = $documento->getCaIdtipo();
            $data["fchinicio"] = $documento->getCaFchinicio();
            $data["fchvencimiento"] = $documento->getCaFchvencimiento();
            $data["observaciones"] = utf8_encode($documento->getCaObservaciones());
            $data["auditorias"] = utf8_encode("<b>Creado:</b> " . $documento->getCaUsucreado() . " - " . $documento->getCaFchcreado());
        }
        $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosEvaluacion(sfWebRequest $request) {
        $proveedor = Doctrine::getTable("IdsProveedor")
                ->createQuery("i")
                ->addWhere('i.ca_idproveedor = ?', $request->getParameter("idproveedor"))
                ->fetchOne();

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select distinct cr.ca_tipo, cr.ca_tipocriterio, cr.ca_impoexpo, cr.ca_transporte "
                . "from ids.tb_criterios cr where cr.ca_tipo = '" . $proveedor->getCaTipo() . "' "
                . "and cr.ca_activo order by cr.ca_tipo, cr.ca_tipocriterio, cr.ca_impoexpo, cr.ca_transporte ";
        $st = $con->execute($sql);
        $evals = $st->fetchAll();

        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);

        $criterios = array("desempeno" => "Desempeño", "seleccion" => "Selección");
        foreach ($evals as $eval) {
            $uid = $root;
            $value = utf8_encode($criterios[$eval["ca_tipocriterio"]]);
            $evaluacion_sc["tipocriterio"] = $value;
            $node_uid = $tree->findValue($uid, $value);
            if (!$node_uid) {
                $nodo = $tree->createNode($value);
                $tree->addChild($uid, $nodo);
                $uid = $nodo;
            } else {
                $uid = $node_uid;
            }

            $value = utf8_encode($eval["ca_impoexpo"]);
            if ($value) {
                $evaluacion_sc["impoexpo"] = $value;
                $node_uid = $tree->findValue($uid, $value);
                if (!$node_uid) {
                    $nodo = $tree->createNode($value);
                    $tree->addChild($uid, $nodo);
                    $uid = $nodo;
                } else {
                    $uid = $node_uid;
                }
            }

            $value = utf8_encode($eval["ca_transporte"]);
            if ($value) { // && strpos($proveedor->getCaTransporte(), $eval["ca_transporte"]) !== false
                $evaluacion_sc["transporte"] = $value;
                $node_uid = $tree->findValue($uid, $value);
                if (!$node_uid) {
                    $nodo = $tree->createNode($value);
                    $tree->addChild($uid, $nodo);
                    $uid = $nodo;
                } else {
                    $uid = $node_uid;
                }
            }
            $nodo = $tree->getNode($uid);
            $nodo->setAttribute("tipo", $proveedor->getCaTipo());
            $nodo->setAttribute("tipocriterio", $eval["ca_tipocriterio"]);
            $nodo->setAttribute("impoexpo", utf8_encode($eval["ca_impoexpo"]));
            $nodo->setAttribute("transporte", utf8_encode($eval["ca_transporte"]));
            $nodo->setAttribute("collapsed", true);
            $nodo->setAttribute("leaf", true);
        }
        $data = $tree->getTreeNodes();

        $this->responseArray = array("success" => true, "children" => $data["children"]);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarDocumento(sfWebRequest $request) {
        $idDocumento = $request->getParameter("iddocumento");
        $idProveedor = $request->getParameter("idproveedor");

        if (!$idDocumento && $idProveedor) {
            $documento = new IdsDocumento();
            $documento->setCaId($idProveedor);
            $documento->setCaIdtipo($request->getParameter("idtipo"));
        } else {
            $documento = Doctrine::getTable("IdsDocumento")->find($idDocumento);
        }

        $conn = Doctrine::getTable("IdsDocumento")->getConnection();
        try {
            $conn->beginTransaction();

            if ($request->getParameter("fchinicio")) {
                $documento->setCaFchinicio($request->getParameter("fchinicio"));
            }

            if ($request->getParameter("observaciones")) {
                $documento->setCaObservaciones($request->getParameter("observaciones"));
            }

            if ($request->getParameter("fchvencimiento") !== null) {
                if ($request->getParameter("fchvencimiento")) {
                    $documento->setCaFchvencimiento($request->getParameter("fchvencimiento"));
                } else {
                    $documento->setCaFchvencimiento(null);
                }
            }
            $documento->save();

            if ($_FILES["archivo"]) {
                $directorio = $documento->getDirectorio();

                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $directorio . DIRECTORY_SEPARATOR . $_FILES["archivo"]["name"])) {
                    $documento->setCaUbicacion($_FILES["archivo"]["name"]);
                    $documento->save();
                }
            }

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarDocumento(sfWebRequest $request) {
        $idDocumento = $request->getParameter("iddocumento");

        $documento = Doctrine::getTable("IdsDocumento")->find($idDocumento);
        $conn = Doctrine::getTable("IdsDocumento")->getConnection();
        try {
            $conn->beginTransaction();
            if ($documento) {
                $documento->delete();
            }

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosEntidadesBancarias(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select ca_idvalue, ca_value from control.tb_config_values where ca_idconfig = 251 and lower(ca_value) like '%" . strtolower($request->getParameter("q")) . "%' ";
        $rs = $con->execute($sql);
        $entidades = $rs->fetchAll();

        $data = array();
        foreach ($entidades as $entidad) {
            $data[] = array(
                "idvalue" => $entidad["ca_idvalue"],
                "value" => utf8_encode($entidad["ca_value"])
            );
        }

        $this->responseArray = array("root" => $data, "total" => count($data), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosBancos(sfWebRequest $request) {
        $ids = $request->getParameter("ids");
        try {
            $bancos = Doctrine::getTable("IdsBanco")
                    ->createQuery("i")
                    ->addWhere('i.ca_id = ?', $ids)
                    ->addOrderBy("i.ca_codigo_entidad")
                    ->execute();

            $data = array();

            foreach ($bancos as $banco) {
                $data[] = array(
                    "ids" => utf8_encode($banco->getCaId()),
                    "idbanco" => utf8_encode($banco->getCaIdbanco()),
                    "codigo_entidad" => utf8_encode($banco->getCaCodigoEntidad()),
                    "id_entidad" => utf8_encode($banco->getEntidad()->getCaIdent()),
                    "nombre_entidad" => utf8_encode($banco->getEntidad()->getCaValue()),
                    "tipo_cuenta" => utf8_encode($banco->getCaTipoCuenta()),
                    "numero_cuenta" => utf8_encode($banco->getCaNumeroCuenta()),
                    "observaciones" => utf8_encode($banco->getCaObservaciones()),
                    "creacion" => utf8_encode($banco->getCaUsucreado() . " - " . $banco->getCaFchcreado()),
                    "ult_modificacion" => utf8_encode($banco->getCaUsuactualizado() . " - " . $banco->getCaFchactualizado()));
            }

            $this->responseArray = array("success" => true, "data" => $data);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosUnBanco(sfWebRequest $request) {
        $idbanco = $request->getParameter("idbanco");

        $banco = Doctrine::getTable("IdsBanco")->find($idbanco);
        $data = array();

        if ($banco) {
            $data["idbanco"] = $banco->getCaIdbanco();
            $data["codigo_entidad"] = $banco->getCaCodigoEntidad();
            $data["tipo_cuenta"] = $banco->getCaTipoCuenta();
            $data["numero_cuenta"] = $banco->getCaNumeroCuenta();
            $data["observaciones"] = utf8_encode($banco->getCaObservaciones());
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarBanco(sfWebRequest $request) {
        $ids = $request->getParameter("ids");
        $idbanco = $request->getParameter("idbanco");
        $idEmpresa = $request->getParameter("idempresa");

        if ($idbanco) {
            $banco = Doctrine::getTable("IdsBanco")->find($idbanco);

            if (!$banco) {
                $banco = Doctrine::getTable("IdsBanco")
                        ->createQuery("i")
                        ->addWhere('i.ca_id = ?', $ids)
                        ->addWhere('i.ca_idempresa = ?', $idEmpresa)
                        ->fetchOne();
            }
        }
        if (!$banco) {
            $banco = new IdsBanco();
            $banco->setCaId($ids);
        }

        $con = Doctrine::getTable("IdsBanco")->getConnection();
        try {
            $con->beginTransaction();
            if ($request->getParameter("codigo_entidad") != null) {
                $banco->setCaCodigoEntidad($request->getParameter("codigo_entidad"));
            }
            if ($request->getParameter("numero_cuenta") != null) {
                $banco->setCaNumeroCuenta($request->getParameter("numero_cuenta"));
            }
            if ($request->getParameter("tipo_cuenta") != null) {
                $banco->setCaTipoCuenta($request->getParameter("tipo_cuenta"));
            }
            if ($request->getParameter("observaciones")) {
                $banco->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
            }
            $banco->save();
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarBanco(sfWebRequest $request) {
        $idbanco = $request->getParameter("idbanco");
        $banco = Doctrine::getTable("IdsBanco")->find($idbanco);
        $con = Doctrine::getTable("IdsBanco")->getConnection();
        try {
            $con->beginTransaction();
            if ($banco) {
                $banco->delete();
            }
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeCargarControlFinanciero(sfWebRequest $request) {
        $id = $request->getParameter("idproveedor");

        $prov = Doctrine::getTable("IdsProveedor")->find($id);
        $data = array();
        if ($prov) {
            $ids = $prov->getIds();
            $ids_datos = json_decode(utf8_encode($ids->getCaDatos()));
            $data = array("idproveedor" => $prov->getCaIdproveedor(),
                "esporadico" => utf8_encode($prov->getCaEsporadico() ? "Sí" : "No"),
                "tercero" => utf8_encode($prov->getCaTercero() ? "Sí" : "No"),
                "fchvencimiento" => $prov->getCaFchvencimiento(),
                "critico" => utf8_encode($prov->getCaCritico() ? "Sí" : "No"),
                "tipopersona" => $ids->getCaTipopersona(),
                "regimen" => $ids->getCaRegimen(),
                "sectoreco" => utf8_encode($ids->getCaSectoreco()),
                "actividad" => utf8_encode($ids->getCaActividad()),
                "fchcircular" => $prov->getCaFchcircular(),
                "fchvencircular" => $prov->getCaFchvencircular(),
                "nvlriesgo" => utf8_encode($prov->getCaNvlriesgo()),
                "codigo_postal" => $ids->getSucursalPrincipal()->getCaZipcode(),
                "fechaconstitucion" => $ids_datos->fechaconstitucion,
                "matricula_mercantil" => $ids_datos->matricula_mercantil,
                "forma_pago" => $ids_datos->forma_pago,
                "cod_ciiu_uno" => $ids_datos->cod_ciiu_uno,
                "cod_ciiu_dos" => $ids_datos->cod_ciiu_dos,
                "cod_ciiu_trs" => $ids_datos->cod_ciiu_trs,
                "cod_ciiu_ctr" => $ids_datos->cod_ciiu_ctr,
                "basc" => $ids_datos->basc,
                "oea" => $ids_datos->oea,
                "vomil" => $ids_datos->vomil,
                "ctpat" => $ids_datos->ctpat,
                "vinculantes" => utf8_encode($ids_datos->vinculantes),
                "vincumentario" => utf8_encode($ids_datos->vincumentario),
                "responsabilidades" => implode(",", $ids_datos->responsabilidades),
                "idclasificacion" => $prov->getCaIdclasificacion()
            );
            $this->responseArray = array("success" => true, "data" => $data);
        } else {
            $this->responseArray = array("success" => true, "data" => "");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarControlFinanciero(sfWebRequest $request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $idproveedor = $request->getParameter("idproveedor");
        $conn = Doctrine::getTable("IdsProveedor")->getConnection();
        $proveedor = Doctrine::getTable('IdsProveedor')->find($idproveedor);

        if ($proveedor) {
            $conn->beginTransaction();
            try {
                if ($request->getParameter("esporadico")) {
                    $proveedor->setCaEsporadico($request->getParameter("esporadico") == "No" ? false : true);
                }
                if ($request->getParameter("tercero")) {
                    $proveedor->setCaTercero($request->getParameter("tercero") == "No" ? false : true);
                }
                if (($proveedor->getCaEsporadico() || $proveedor->getCaTercero()) && $request->getParameter("fchvencimiento")) {
                    $proveedor->setCaFchvencimiento($request->getParameter("fchvencimiento"));
                } else {
                    $proveedor->setCaFchvencimiento(null);
                }
                if ($request->getParameter("critico")) {
                    $proveedor->setCaCritico($request->getParameter("critico") == "No" ? false : true);
                }
                if ($request->getParameter("fchcircular")) {
                    $proveedor->setCaFchcircular($request->getParameter("fchcircular"));
                }
                if ($request->getParameter("fchvencircular")) {
                    $proveedor->setCaFchvencircular($request->getParameter("fchvencircular"));
                } else {
                    $proveedor->setCaFchvencircular(null);
                }
                if ($request->getParameter("nvlriesgo")) {
                    $proveedor->setCaNvlriesgo(utf8_decode($request->getParameter("nvlriesgo")));
                }
                $proveedor->setCaFchfinanciero(date("Y-m-d H:i:s"));
                $proveedor->setCaUsufinanciero($this->getUser()->getUserId());
                $proveedor->save();

                $ids = $proveedor->getIds();
                $ids_datos = json_decode(utf8_encode($ids->getCaDatos()));
                if ($request->getParameter("tipopersona")) {
                    $ids->setCaTipopersona($request->getParameter("tipopersona"));
                }
                if ($request->getParameter("regimen")) {
                    $ids->setCaRegimen($request->getParameter("regimen"));
                }
                if ($request->getParameter("sectoreco")) {
                    $ids->setCaSectoreco($request->getParameter("sectoreco"));
                }
                if ($request->getParameter("actividad")) {
                    $ids->setCaActividad($request->getParameter("actividad"));
                }
                if ($request->getParameter("fechaconstitucion")) {
                    $ids_datos->fechaconstitucion = $request->getParameter("fechaconstitucion");
                }
                if ($request->getParameter("matricula_mercantil")) {
                    $ids_datos->matricula_mercantil = $request->getParameter("matricula_mercantil");
                }
                if ($request->getParameter("forma_pago")) {
                    $ids_datos->forma_pago = $request->getParameter("forma_pago");
                }
                if ($request->getParameter("cod_ciiu_uno")) {
                    $ids_datos->cod_ciiu_uno = $request->getParameter("cod_ciiu_uno");
                }
                if ($request->getParameter("cod_ciiu_dos")) {
                    $ids_datos->cod_ciiu_dos = $request->getParameter("cod_ciiu_dos");
                }
                if ($request->getParameter("cod_ciiu_trs")) {
                    $ids_datos->cod_ciiu_trs = $request->getParameter("cod_ciiu_trs");
                }
                if ($request->getParameter("cod_ciiu_ctr")) {
                    $ids_datos->cod_ciiu_ctr = $request->getParameter("cod_ciiu_ctr");
                }
                if ($request->getParameter("basc")) {
                    $ids_datos->basc = true;
                } else {
                    $ids_datos->basc = false;
                }
                if ($request->getParameter("oea")) {
                    $ids_datos->oea = true;
                } else {
                    $ids_datos->oea = false;
                }
                if ($request->getParameter("vomil")) {
                    $ids_datos->vomil = true;
                } else {
                    $ids_datos->vomil = false;
                }
                if ($request->getParameter("ctpat")) {
                    $ids_datos->ctpat = true;
                } else {
                    $ids_datos->ctpat = false;
                }
                if ($request->getParameter("vinculantes")) {
                    $ids_datos->vinculantes = utf8_encode($request->getParameter("vinculantes"));
                }
                if ($request->getParameter("vincumentario")) {
                    $ids_datos->vincumentario = utf8_encode($request->getParameter("vincumentario"));
                }
                if ($request->getParameter("respons")) {
                    $ids_datos->responsabilidades = explode(",", $request->getParameter("respons"));
                }
                $ids_datos = json_encode($ids_datos);
                $ids->setCaDatos($ids_datos);
                $ids->save();

                $sucursal = $ids->getSucursalPrincipal();
                if ($sucursal) {
                    $sucursal->setCaZipcode($request->getParameter("codigo_postal"));
                    $sucursal->save();
                }

                $conn->commit();
                $this->responseArray = array("success" => true, "idproveedor" => $idproveedor);
            } catch (Exception $e) {
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarClasifica(sfWebRequest $request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $idproveedor = $request->getParameter("idproveedor");
        $conn = Doctrine::getTable("IdsProveedor")->getConnection();
        $proveedor = Doctrine::getTable('IdsProveedor')->find($idproveedor);

        if ($proveedor) {
            $conn->beginTransaction();
            try {
                if ($request->getParameter("idclasificacion")) {
                    $proveedor->setCaIdclasificacion($request->getParameter("idclasificacion"));
                    $proveedor->save();
                }

                $conn->commit();
                $this->responseArray = array("success" => true, "idproveedor" => $idproveedor);
            } catch (Exception $e) {
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
            }
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Genera la transacción para que se envíe el Proveedor a SAP
     *
     * @param sfRequest $request A request object
     */
    public function executeEnviarSocioNegocios(sfWebRequest $request) {
        $idproveedor = $request->getParameter("idproveedor");
        $proveedor = Doctrine::getTable('IdsProveedor')->find($idproveedor);
                            
        if ($proveedor->getCaCumpleEmpresa(2) == "Cumple") {    // Coltrans
            $trans= new IntTransaccionesOut();
            $trans->setCaIdtipo(3);
            $trans->setCaIndice1($proveedor->getCaIdproveedor());
            $trans->setCaIndice2(1);
            $trans->setCaEstado("A");
            $trans->save();
        }
        if ($proveedor->getCaCumpleEmpresa(1) == "Cumple") {    // Colmas
            $trans= new IntTransaccionesOut();
            $trans->setCaIdtipo(3);
            $trans->setCaIndice1($proveedor->getCaIdproveedor());
            $trans->setCaIndice2(4);
            $trans->setCaEstado("A");
            $trans->save();
        }
        if ($proveedor->getCaCumpleEmpresa(8) == "Cumple") {    // Colotm
            $trans= new IntTransaccionesOut();
            $trans->setCaIdtipo(3);
            $trans->setCaIndice1($proveedor->getCaIdproveedor());
            $trans->setCaIndice2(2);
            $trans->setCaEstado("A");
            $trans->save();
        }
        if ($proveedor->getCaCumpleEmpresa(11) == "Cumple") {    // Coldepositos Logística
            $trans= new IntTransaccionesOut();
            $trans->setCaIdtipo(3);
            $trans->setCaIndice1($proveedor->getCaIdproveedor());
            $trans->setCaIndice2(3);
            $trans->setCaEstado("A");
            $trans->save();
        }
        if ($proveedor->getCaCumpleEmpresa(12) == "Cumple") {    // Coldepositos Bodega Nacional
            $trans= new IntTransaccionesOut();
            $trans->setCaIdtipo(3);
            $trans->setCaIndice1($proveedor->getCaIdproveedor());
            $trans->setCaIndice2(5);
            $trans->setCaEstado("A");
            $trans->save();
        }
    
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }
}
