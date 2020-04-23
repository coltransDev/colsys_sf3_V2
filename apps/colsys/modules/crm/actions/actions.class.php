<?php

/**
 * crm actions.
 *
 * @package    symfony
 * @subpackage crm
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class crmActions extends sfActions {

    const RUTINA = 10;
    const RUTINA_CRM = 211;

    public function getNivel() {

        $this->nivel = $this->getUser()->getNivelAcceso(crmActions::RUTINA);
        return $this->nivel;
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCliente(sfWebRequest $request) {
        $this->idcliente = $request->getParameter("idcliente");
        $this->nivel = $this->getNivel();
    }

    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarCliente(sfWebRequest $request) {

        try {
            $nivel = $this->getNivel();

            $conn = Doctrine::getTable("Cliente")->getConnection();
            $conn->beginTransaction();

            if ($request->getParameter("idcliente")) {

                $ids = Doctrine::getTable("Ids")->find($request->getParameter("idcliente"));
                $this->forward404Unless($ids);

                $cliente = Doctrine::getTable("IdsCliente")->find($request->getParameter("idcliente"));
                if (!$cliente) {
                    $cliente = new IdsCliente();
                } else {
                    if ($nivel < 2 && $cliente->getCaVendedor() && $cliente->getCaVendedor() != $this->getUser()->getUserId()) {
                        throw new Exception("Esta tratando de modificar un cliente de otro comercial. Este cliente se encuentra actualmente asignado a " . $cliente->getCaVendedor());
                    }
                }

                $prov = Doctrine::getTable("IdsProveedor")->find($request->getParameter("idcliente"));
            } else {
                $ids = new Ids();
                $cliente = new IdsCliente();
                $prov = null;
            }

            if (!$prov) {
                if (!$request->getParameter("idcliente") || $this->getNivel() >= 4) {
                    $ids->setCaIdalterno($request->getParameter("idalterno"));
                    if ($request->getParameter("tipo_identificacion") == 1) {
                        $ids->setCaDv($request->getParameter("dv"));
                    }
                    $ids->setCaTipoidentificacion($request->getParameter("tipo_identificacion"));
                }
                $ids->setCaNombre(utf8_decode(strtoupper(preg_replace('/ +/', ' ', $request->getParameter("compania")))));
            }
            $ids->setCaWebsite($request->getParameter("website"));
            //$cliente->setCaCompania( strtoupper($request->getParameter("compania")) );
            $cliente->setCaSaludo(utf8_decode($request->getParameter("title")));
            $cliente->setCaPapellido(utf8_decode($request->getParameter("papellido")));
            $cliente->setCaSapellido(utf8_decode($request->getParameter("sapellido")));
            $cliente->setCaNombres(utf8_decode($request->getParameter("nombre")));
            $cliente->setCaSexo($request->getParameter("sexo"));
            $cliente->setCaCumpleanos($request->getParameter("cumpleanos"));
            $cliente->setCaEmail($request->getParameter("email"));

            if ($nivel >= 2) {
                if ($request->getParameter("vendedor")) {
                    $cliente->setCaVendedor($request->getParameter("vendedor"));
                } else {
                    $cliente->setCaVendedor(null);
                }
            } else {
                $cliente->setCaVendedor($this->getUser()->getUserId());
            }

            if ($request->getParameter("coordinador")) {
                $cliente->setCaCoordinador($request->getParameter("coordinador"));
            } else {
                $cliente->setCaCoordinador(null);
            }

            $idtrafico = $ids->getIdsTipoIdentificacion()->getCaIdtrafico();

            if ($idtrafico == "CO-057") {
                //Direccion
                $direccion = "";
                for ($i = 1; $i <= 10; $i++) {
                    ($i > 1) ? $direccion .= "|" : "";
                    $direccion .= $request->getParameter("dir_" . $i);
                }
                $cliente->setCaDireccion(utf8_decode($direccion));

                $cliente->setCaBloque($request->getParameter("bloque"));
                $cliente->setCaTorre($request->getParameter("torre"));
                $cliente->setCaInterior($request->getParameter("interior"));
                $cliente->setCaOficina($request->getParameter("oficina"));
                $cliente->setCaComplemento(utf8_decode($request->getParameter("complemento")));
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad")));
            } else {
                $cliente->setCaDireccion(utf8_decode($request->getParameter("dir_ot")));
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad_ot")));
            }


            $cliente->setCaTelefonos($request->getParameter("phone"));
            $cliente->setCaFax($request->getParameter("fax"));
            $cliente->setCaIdciudad($request->getParameter("idciudad"));
            $cliente->setCaSectoreco(utf8_decode($request->getParameter("sectoreco")));
            $cliente->setCaActividad(utf8_decode($request->getParameter("actividad")));
            $cliente->setCaFchacuerdoconf($request->getParameter("fchacuerdoconf"));
            $cliente->setCaZipcode($request->getParameter("zipcode"));

            if ($nivel >= 2) {
                if ($request->getParameter("status")) {
                    $cliente->setCaStatus(utf8_decode($request->getParameter("status")));
                } else {
                    $cliente->setCaStatus(null);
                }
            }

            $cliente->setCaCalificacion($request->getParameter("calificacion"));

            $cliente->setCaFchcotratoag($request->getParameter("fchcotratoag"));
            $cliente->setCaEntidad($request->getParameter("entidad"));
            $cliente->setCaPreferencias(utf8_decode($request->getParameter("preferencias")));
            if ($request->getParameter("leyinsolvencia")) {
                $cliente->setCaLeyinsolvencia(utf8_decode($request->getParameter("leyinsolvencia")));
            } else {
                $cliente->setCaLeyinsolvencia(null);
            }

            if ($request->getParameter("listaclinton")) {
                $cliente->setCaListaclinton(utf8_decode($request->getParameter("listaclinton")));
            } else {
                $cliente->setCaListaclinton(null);
            }

            if ($request->getParameter("comentario")) {
                $cliente->setCaComentario($request->getParameter("comentario"));
            } else {
                $cliente->setCaComentario(null);
            }

            if ($request->getParameter("global") == "on") {
                $cliente->setProperty('cuentaglobal', "|true");
            } else {
                $cliente->setProperty('cuentaglobal', "");
            }

            if ($request->getParameter("consolidar") == "on") {
                $cliente->setProperty('consolidar_comunicaciones', "|true");
            } else {
                $cliente->setProperty('consolidar_comunicaciones', "");
            }
            $cliente->setCaPropiedades(str_replace("|", "", $cliente->getCaPropiedades()));

            $ids->save($conn);
            $cliente->setCaIdgrupo($ids->getCaId());
            $cliente->setCaIdcliente($ids->getCaId());
            $cliente->setIds($ids);
            $cliente->save($conn);

            $this->responseArray = array("success" => true, "idcliente" => $ids->getCaId());
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosClienteFormPanel(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("idcliente"));
        $ids = Doctrine::getTable("Ids")->find($request->getParameter("idcliente"));
        $this->forward404Unless($ids);

        $data = array();
        $data["idcliente"] = $ids->getCaId();
        $data["compania"] = utf8_encode($ids->getCaNombre());
        $data["idalterno"] = $ids->getCaIdalterno();
        $data["tipo_identificacion"] = utf8_encode($ids->getCaTipoidentificacion());
        $data["idalterno_ant"] = $ids->getCaIdalterno();
        $data["tipo_identificacion_ant"] = $ids->getCaTipoidentificacion();
        $data["idtrafico"] = $ids->getIdsTipoIdentificacion()->getCaIdtrafico();
        $data["dv"] = $ids->getCaDv();
        $data["website"] = $ids->getCaWebsite();

        $cliente = Doctrine::getTable("Cliente")->find($request->getParameter("idcliente"));
        if ($cliente) {
            $data["vendedor"] = $cliente->getCaVendedor();
            $data["coordinador"] = $cliente->getCaCoordinador();

            $data["title"] = utf8_encode($cliente->getCaSaludo());
            $data["papellido"] = utf8_encode($cliente->getCaPapellido());
            $data["sapellido"] = utf8_encode($cliente->getCaSapellido());
            $data["nombre"] = utf8_encode($cliente->getCaNombres());
            $data["sexo"] = $cliente->getCaSexo();
            $data["cumpleanos"] = $cliente->getCaCumpleanos();
            $data["email"] = $cliente->getCaEmail();

            $data["sectoreco"] = utf8_encode($cliente->getCaSectoreco());
            $data["actividad"] = utf8_encode($cliente->getCaActividad());
            $data["status"] = $cliente->getCaStatus();
            $data["calificacion"] = $cliente->getCaCalificacion();
            $data["fchcotratoag"] = $cliente->getCaFchcotratoag();
            $data["entidad"] = utf8_encode($cliente->getCaEntidad());
            $data["comentario"] = utf8_encode($cliente->getCaComentario());
            $data["leyinsolvencia"] = utf8_encode($cliente->getCaLeyinsolvencia());
            $data["listaclinton"] = utf8_encode($cliente->getCaListaclinton());
            $data["fchacuerdoconf"] = $cliente->getCaFchacuerdoconf();

            if ($data["idtrafico"] == "CO-057") {
                $direccion = explode("|", $cliente->getCaDireccion());
                for ($i = 0; $i < count($direccion); $i++) {
                    $data["dir_" . ($i + 1)] = utf8_encode($direccion[$i]);
                }
                $data["bloque"] = $cliente->getCaBloque();
                $data["torre"] = $cliente->getCaTorre();
                $data["interior"] = $cliente->getCaInterior();
                $data["oficina"] = $cliente->getCaOficina();
                $data["complemento"] = utf8_encode($cliente->getCaComplemento());
            } else {
                $data["dir_ot"] = $cliente->getCaDireccion();
            }

            $data["localidad"] = utf8_encode($cliente->getCaLocalidad());
            $data["localidad_ot"] = utf8_encode($cliente->getCaLocalidad());

            $data["idciudad"] = $cliente->getCaIdciudad();
            $data["ciudad"] = utf8_encode($cliente->getCiudad()->getCaCiudad());
            $data["zipcode"] = $cliente->getCaZipcode();

            $data["phone"] = $cliente->getCaTelefonos();
            $data["fax"] = $cliente->getCaFax();

            $data["preferencias"] = utf8_encode($cliente->getCaPreferencias());
            $data["global"] = $cliente->getProperty("cuentaglobal");
            $data["consolidar"] = $cliente->getProperty("consolidar_comunicaciones");
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeVerCliente(sfWebRequest $request) {
        
    }

    public function executeIndexExt5(sfWebRequest $request) {
        $this->permisos = array();

        $user = $this->getUser();
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_CRM);

        $tipopermisos = $user->getAccesoTotalRutina(self::RUTINA_CRM);
        foreach ($tipopermisos as $index => $tp) {
            $this->permisos[$index] = in_array($tp, $permisosRutinas) ? true : false;
        }

        if ($request->getParameter("idcliente")) {
            $cliente = Doctrine::getTable("IdsCliente")->find($request->getParameter("idcliente"));
            if ($cliente) {
                $this->idcliente = $cliente->getCaIdcliente();
                $this->nombre = utf8_encode($cliente->getIds()->getCaNombre());
            }
        }
    }

    public function executePrincipalExt6(sfWebRequest $request) {
        
    }

    public function executeDatosCliente(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

        $cliente = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere('i.ca_id = ?', $idCliente)
                ->fetchOne();

        $con = Doctrine_Manager::getInstance()->connection();

        $empresas = Doctrine::getTable("Empresa")
                ->createQuery("e")
                ->select("e.ca_url")
                ->whereIn("e.ca_idempresa", array(1, 2, 8, 11))
                ->addWhere("e.ca_idsap is not null")
                ->orderBy("e.ca_coddian, e.ca_idsap")
                ->execute();

//        $idsCredito = Doctrine::getTable("IdsCredito")
//            ->createQuery("i")
//            ->addWhere('i.ca_id = ?', $idCliente)
//            ->addWhere('i.ca_tipo = ?', "C")
//            ->addOrderBy("i.ca_idempresa")
//            ->execute();
//        $beneficios = array();
//        foreach ($idsCredito as $credito) {
//            $dominio = explode(".", $credito->getEmpresa()->getCaUrl())[1];
//            $beneficios[$dominio] = array("cupo" => $credito->getCaCupo(), "dias" => $credito->getCaDias());
//        }
//        $idsEstadoSap = Doctrine::getTable("IdsEstadoSap")
//            ->createQuery("i")
//            ->addWhere('i.ca_id = ?', $idCliente)
//            ->addWhere('i.ca_tipo = ?', "C")
//            ->addOrderBy("i.ca_idempresa")
//            ->execute();
//        $estadoSap = array();
//        foreach ($idsEstadoSap as $estado) {
//            $dominio = explode(".", $estado->getEmpresa()->getCaUrl())[1];
//            $estadoSap[$dominio] = ($estado->getCaActivo()?"Activo":"Inactivo");
//        }

        $sql = "select ca_certificacion, ca_certificacion_otro, ca_implementacion_sistema, ca_implementacion_sistema_detalles from encuestas.tb_encuesta_visita ev "
                . "inner join public.tb_concliente cc on cc.ca_idcontacto = ev.ca_idcontacto "
                . "where ca_idcliente = '$idCliente' order by ca_fchvisita desc limit 1";
        $st = $con->execute($sql);
        $encuestaVisita = $st->fetch();

        $sql = "select * from vi_clientes where ca_idcliente = '$idCliente';";
        $st = $con->execute($sql);
        $vista = $st->fetch();

//        $sql = "select * from fun_estado_documentos($idCliente);";
//        $st = $con->execute($sql);
//        $funcion = $st->fetch();
//        $arraycumplimiento = explode("|", $funcion["fun_estado_documentos"]);
//        $coltrans_0170 = $arraycumplimiento[0];
//        $colmas_0170 = $arraycumplimiento[1];
//        $colotm_0170 = $arraycumplimiento[2];
//        $coldepositos_0170 = $arraycumplimiento[3];

        $data = array();
        if ($cliente) {
            $ids_datos = json_decode(utf8_encode($cliente->getCaDatos()));
            $data["nombre"] = utf8_encode($cliente->getCaNombre());
            $data["saludo_rl"] = utf8_encode($cliente->getIdsCliente()->getCaSaludo());
            $data["representa_legal"] = utf8_encode($cliente->getIdsCliente()->getRepresentanteLegal());
            $data["identificacion_rl"] = utf8_encode($cliente->getIdsCliente()->getIdRepresentanteLegal());
            $data["website"] = utf8_encode($cliente->getCaWebsite());
            $data["direccion"] = utf8_encode($cliente->getIdsCliente()->getDireccion());
            $data["telefonos"] = utf8_encode($cliente->getIdsCliente()->getCaTelefonos());
            $data["fax"] = utf8_encode($cliente->getIdsCliente()->getCaFax());
            $data["localidad"] = utf8_encode($cliente->getIdsCliente()->getCaLocalidad());
            $data["ciudad"] = utf8_encode($cliente->getIdsCliente()->getCiudad());
            $data["email"] = utf8_encode($cliente->getIdsCliente()->getCaEmail());
            $data["status"] = utf8_encode($cliente->getIdsCliente()->getCaStatus());
            $data["sector"] = utf8_encode($cliente->getIdsCliente()->getCaSectoreco());
            $data["vendedor"] = utf8_encode($cliente->getIdsCliente()->getCaVendedor());
            $data["coordinador"] = utf8_encode($cliente->getIdsCliente()->getCaCoordinador());
            $data["servCliente"] = utf8_encode(implode(",", $cliente->getIdsCliente()->getCoorServCliente()));
            $data["tipoNit"] = utf8_encode($cliente->getIdsCliente()->getCaTipo());
            $data["entidad"] = utf8_encode($cliente->getIdsCliente()->getCaEntidad());
            $data["lista_clinton"] = utf8_encode($cliente->getIdsCliente()->getCaListaclinton());
            $data["ultima_consulta"] = $cliente->getUltimaConsulta();
            $data["ley_insolvencia"] = utf8_encode($cliente->getIdsCliente()->getCaLeyinsolvencia());
            $data["comentario"] = utf8_encode($cliente->getIdsCliente()->getCaComentario());
            $data["circular"] = utf8_encode($vista["ca_fchcircular"]);
            $data["vencircular"] = utf8_encode($vista["ca_fchvencircular"]);
            $data["estado_circular"] = utf8_encode($vista["ca_stdcircular"]);
            $data["nivel_riesgo"] = utf8_encode($cliente->getIdsCliente()->getCaNvlriesgo());
            $data["auditorias"] = utf8_encode("<b>Creado:</b> " . $vista["ca_usucreado"] . " - " . $vista["ca_fchcreado"] . "&nbsp;&nbsp;&nbsp;" . "<b>Actualizado:</b> " . $vista["ca_usuactualizado"] . " - " . $vista["ca_fchactualizado"] . "&nbsp;&nbsp;&nbsp;" . "<b>Financiero:</b> " . $vista["ca_usufinanciero"] . " - " . $vista["ca_fchfinanciero"]);
            $data["forma_pago"] = $ids_datos->forma_pago;

            $data["identificacion"] = utf8_encode($cliente->getIdsTipoIdentificacion()->getCaNombre() . ": " . $cliente->getCaIdalterno() . " - " . $cliente->getCaDv());
            if ($cliente->getCaDv() == null) {
                $data["identificacion"] = utf8_encode($cliente->getIdsTipoIdentificacion()->getCaNombre() . ": " . $cliente->getCaIdalterno());
            }

            $data["certificaciones"] = "Sin Encuesta de Visita";
            $data["plan_implementa"] = "";
            $data["estm_implementa"] = "";
            if (count($encuestaVisita)) {
                $data["certificaciones"] = str_replace(",", ", ", utf8_encode($encuestaVisita["ca_certificacion"]));
                $data["certificaciones"] .= strlen($encuestaVisita["ca_certificacion_otro"]) ? ", " . utf8_encode($encuestaVisita["ca_certificacion_otro"]) : "";
                $data["plan_implementa"] = utf8_encode($encuestaVisita["ca_implementacion_sistema"]);
                $data["estm_implementa"] = utf8_encode($encuestaVisita["ca_implementacion_sistema_detalles"]);
            }
            $data["fechaconstitucion"] = $cliente->getIdsCliente()->getCaFchconstitucion();
            $data["tipo_persona"] = utf8_encode($cliente->getIdsCliente()->getTipoPersona() . " / " . $cliente->getIdsCliente()->getRegimen());
            $data["uap"] = ($cliente->getIdsCliente()->getCaUap()) ? utf8_encode("Sí") : "No";
            $data["altex"] = ($cliente->getIdsCliente()->getCaAltex()) ? utf8_encode("Sí") : "No";
            $data["oea"] = ($cliente->getIdsCliente()->getCaOea()) ? utf8_encode("Sí") : "No";
            $data["comerciante"] = ($cliente->getIdsCliente()->getCaComerciante()) ? utf8_encode("Sí") : "No";
            // $data["cuenta_global"] = (strpos($cliente->getIdsCliente()->getCaPropiedades(), 'cuentaglobal=true') !== false) ? utf8_encode("Sí") : "No";
            $data["consolidar"] = (strpos($cliente->getIdsCliente()->getCaPropiedades(), 'consolidar_comunicaciones=true') !== false) ? utf8_encode("Sí") : "No";

            $data["codigos_ciiu"] = implode(",", array($cliente->getIdsCliente()->getCaCiiuUno(), $cliente->getIdsCliente()->getCaCiiuDos(), $cliente->getIdsCliente()->getCaCiiuTrs(), $cliente->getIdsCliente()->getCaCiiuCtr()));
            $data["cod_ciiu_uno"] = $cliente->getIdsCliente()->getCaCiiuUno();
            $data["cod_ciiu_dos"] = $cliente->getIdsCliente()->getCaCiiuDos();
            $data["cod_ciiu_trs"] = $cliente->getIdsCliente()->getCaCiiuTrs();
            $data["cod_ciiu_ctr"] = $cliente->getIdsCliente()->getCaCiiuCtr();

            $situacion = array();
            $situacion[] = array("type" => "displayfield", "width" => 70, "value" => "Empresa");
            $situacion[] = array("type" => "displayfield", "width" => 60, "value" => "Estado");
            $situacion[] = array("type" => "displayfield", "width" => 90, "value" => "Fecha");
            $situacion[] = array("type" => "displayfield", "width" => 70, "value" => "Docs.0170");
            $situacion[] = array("type" => "displayfield", "width" => 100, "value" => utf8_encode("Cupo Cred. / # Días"));
            $situacion[] = array("type" => "displayfield", "width" => 120, "value" => "Observaciones");
            $situacion[] = array("type" => "displayfield", "width" => 60, "value" => "Estado SAP");

            $estadoSap = false;
            foreach ($empresas as $empresa) {
                $dominio = explode(".", $empresa->getCaUrl())[1];
                $observa = (trim($vista["ca_" . $dominio . "_obsv"])!='')?$vista["ca_" . $dominio . "_obsv"]:' ';
                $warning = "";
                if (strlen($observa) > 22) {
                    $warning = "&raquo;";
                }
                $situacion[] = array("type" => "displayfield", "width" => 70, "value" => ucfirst($dominio));
                $situacion[] = array("type" => "displayfield", "width" => 60, "value" => $vista["ca_" . $dominio . "_std"]);
                $situacion[] = array("type" => "displayfield", "width" => 90, "value" => substr($vista["ca_" . $dominio . "_fch"], 0, 16));
                $situacion[] = array("type" => "displayfield", "width" => 70, "value" => $vista["ca_" . $dominio . "_170"]);
                $situacion[] = array("type" => "displayfield", "width" => 100, "value" => number_format($vista["ca_" . $dominio . "_cupo"]).' / '.$vista["ca_" . $dominio . "_dias"], 0);
                $situacion[] = array("type" => "displayfield", "width" => 120, "value" => utf8_encode(substr($observa,0,22).$warning), "toolTip" => utf8_encode($observa));
                $situacion[] = array("type" => "displayfield", "width" => 60, "value" => $vista["ca_" . $dominio . "_sap"]);
                $estadoSap = $estadoSap || $vista["ca_" . $dominio . "_sap"];
            }

            $data["situacion"] = $situacion;
            $data["situa_col"] = 7;
            $data["estadoSap"] = $estadoSap;

            $data["actividad_economica"] = utf8_encode($vista["ca_actividad"]);
            $data["preferencias"] = utf8_encode($vista["ca_preferencias"]);
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosLibretaCliente(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

        $cliente = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere('i.ca_id = ?', $idCliente)
                ->fetchOne();

        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select * from vi_clientes where ca_idcliente =$idCliente;";
        $st = $con->execute($sql);
        $vista = $st->fetch();

//        $nombres = utf8_encode(implode(",", $vista["ca_confirmar"]));
        $nombres = explode(",", $vista["ca_confirmar"]);

        $data = array();
        if ($cliente) {
            foreach ($nombres as $nombre) {
                $data[]["email"] = utf8_encode($nombre);
            }
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    function realizarBusqueda($request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select i.ca_id from ids.tb_ids i where ca_idalterno like '%" . $request->getParameter("q") . "%'";
        $rs = $con->execute($sql);
        $ids = $rs->fetchAll(PDO::FETCH_COLUMN);

        if (!$ids) {
            $sql = "select i.ca_id from ids.tb_ids i where lower(ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%'";
            $rs = $con->execute($sql);
            $ids = $rs->fetchAll(PDO::FETCH_COLUMN);
        }

        if (!$ids) {
            $sql = "select i.ca_id from ids.tb_ids i inner "
                    . "join public.tb_clientes c on i.ca_id = c.ca_idcliente "
                    . "join control.tb_usuarios u on c.ca_vendedor = u.ca_login "
                    . "join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal "
                    . "where lower(s.ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%'";
            $rs = $con->execute($sql);
            $ids = $rs->fetchAll(PDO::FETCH_COLUMN);
        }

        if (!$ids) {
            $sql = "select i.ca_id from ids.tb_ids i inner "
                    . "join public.tb_clientes c on i.ca_id = c.ca_idcliente "
                    . "where lower(c.ca_vendedor) like '%" . strtolower($request->getParameter("q")) . "%'";
            $rs = $con->execute($sql);
            $ids = $rs->fetchAll(PDO::FETCH_COLUMN);
        }

        if (!$ids) {
            $sql = "select i.ca_id from ids.tb_ids i inner "
                    . "join public.tb_clientes c on i.ca_id = c.ca_idcliente "
                    . "where lower(c.ca_vendedor) like '%" . strtolower($request->getParameter("q")) . "%'";
            $rs = $con->execute($sql);
            $ids = $rs->fetchAll(PDO::FETCH_COLUMN);
        }

//        switch ($request->getParameter("buscarEn")):
//            case "misCliente":
//                $q->addWhere("ca_vendedor = ?", $this->user->getUserId());
//                break;
//        endswitch;

        $q = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->innerJoin("i.IdsCliente id");

        if (count($ids) > 0) {
            $q->whereIn('i.ca_id', $ids);
        }

        if ($request->getParameter("buscarEn") == "misCliente") {
            $q->addWhere("ca_vendedor = ?", $this->user->getUserId());
        }

        if ($request->getParameter("estado")) {
            switch ($request->getParameter("idEmpresa")) {
                case 1:
                    $field = "ca_colmas_std";
                    break;
                case 8:
                    $field = "ca_colotm_std";
                    break;
                case 11:
                    $field = "ca_coldepositos_std";
                    break;
                default:
                    $field = "ca_coltrans_std";
                    break;
            }
            $sql = "select ca_idcliente as ca_column from vi_clientes where $field in ('" . implode("','", $request->getParameter("estado")) . "')";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);

            if ($stmt) {
                $q->whereIn("ca_idcliente", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("circular")) {
            $sql = "select ca_idcliente as ca_column from vi_clientes where ca_stdcircular in ('" . implode("','", $request->getParameter("circular")) . "')";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);

            if ($stmt) {
                $q->whereIn("ca_idcliente", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("tipo")) {
            $sql = "select ca_idcliente as ca_column from tb_clientes where ca_tipo in ('" . implode("','", $request->getParameter("tipo")) . "')";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);

            if ($stmt) {
                $q->whereIn("ca_idcliente", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
        }
        if ($request->getParameter("idSucursal")) {
            $sql = "select ca_nombre from control.tb_sucursales where ca_idsucursal = '" . $request->getParameter("idSucursal") . "'";
            $con = Doctrine_Manager::getInstance()->connection();
            $stmt = $con->execute($sql);

            $q->innerJoin("id.Usuario vn");
            $q->innerJoin("vn.Sucursal sc");
            if ($stmt) {
                $q->whereIn("sc.ca_nombre", $stmt->fetchAll(PDO::FETCH_COLUMN));
            }
            // $q->addWhere("ca_idsucursal = ?", $request->getParameter("idSucursal"));
        }
        if ($request->getParameter("loginVendedor")) {
            $q->addWhere("ca_vendedor = ?", $request->getParameter("loginVendedor"));
        }
        if ($request->getParameter("nivel")) {
            $q->whereIn("ca_nvlriesgo", $request->getParameter("nivel"));
        }
        if ($request->getParameter("cumplimiento")) {
            $q->whereIn("ca_entidad", $request->getParameter("cumplimiento"));
        }
        if ($request->getParameter("fchinicial")) {
            $q->addWhere("ca_fchcreado >= ?", $request->getParameter("fchinicial"));
        }
        if ($request->getParameter("fchfinal")) {
            $q->addWhere("ca_fchcreado <= ?", $request->getParameter("fchfinal"));
        }

        $clientes = array();
        if (count($q->getDqlPart("where")) > 0) {
            if ($request->getParameter('action') == "datosBusqueda") {
                $clientes = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
            } else if ($request->getParameter('action') == "listarBusqueda") {
                $clientes = $q->execute();
            }
        }

        return $clientes;
    }

    function executeDatosBusqueda($request) {
        $data = array();
        $clientes = $this->realizarBusqueda($request);

        foreach ($clientes as $cliente) {
            $data[] = array("idcliente" => utf8_encode("" . $cliente['ca_id']),
                "nombre" => utf8_encode($cliente['ca_nombre']));
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $debug, "query" => $query);
        $this->setTemplate("responseTemplate");
    }

    function executeListarBusqueda($request) {
        $data = array();
        $clientes = $this->realizarBusqueda($request);

        foreach ($clientes as $cliente) {
            $cartaGarantia = $cliente->getIdsCliente()->getEstadoCartaGarantia();
            $estadoCliente = $cliente->getIdsCliente()->getEstadoCliente();

            $data[] = array("idcliente" => utf8_encode($cliente->getCaId()),
                "idalterno" => utf8_encode($cliente->getCaIdalterno()),
                "nombre" => htmlspecialchars(utf8_encode($cliente->getCaNombre())),
                "direccion" => htmlspecialchars(utf8_encode($cliente->getIdsCliente()->getDireccion())),
                "telefono" => utf8_encode($cliente->getIdsCliente()->getCaTelefonos()),
                "correo" => utf8_encode($cliente->getIdsCliente()->getCaEmail()),
                "fax" => utf8_encode($cliente->getIdsCliente()->getCaFax()),
                "ciudad" => utf8_encode($cliente->getIdsCliente()->getCiudad()->getCaCiudad()),
                "vendedor" => utf8_encode($cliente->getIdsCliente()->getCaVendedor()),
                "sucursal" => utf8_encode($cliente->getIdsCliente()->getUsuario()->getSucursal()->getCaNombre()),
                "coordinador" => $cliente->getIdsCliente()->getCaCoordinador(),
                "tipoPersona" => utf8_encode($cliente->getIdsCliente()->getTipoPersona()),
                "regimen" => utf8_encode($cliente->getIdsCliente()->getRegimen()),
                "circular0170_fch" => $cliente->getIdsCliente()->getCaFchcircular(),
                "circular0170_std" => $cliente->getIdsCliente()->getEstadoCircular(),
                "cartaGarantia_fch" => $cartaGarantia["firmado"],
                "cartaGarantia_vnc" => $cartaGarantia["vencimiento"],
                "cartaGarantia_std" => $cartaGarantia["estado"],
                "ultima_encuesta" => $cliente->getIdsCliente()->getFechaEncuesta(),
                "fecha_constitucion" => $cliente->getIdsCliente()->getCaFchconstitucion(),
                "fecha_acuerdo_conf" => $cliente->getIdsCliente()->getCaFchacuerdoconf(),
                "nivel_riesgo" => utf8_encode($cliente->getIdsCliente()->getCaNvlriesgo()),
                "listaOFAC" => utf8_encode($cliente->getIdsCliente()->getCaListaclinton()),
                "uap" => utf8_encode($cliente->getIdsCliente()->getCaUap() ? "Sí" : "No"),
                "altex" => utf8_encode($cliente->getIdsCliente()->getCaAltex() ? "Sí" : "No"),
                "oea" => utf8_encode($cliente->getIdsCliente()->getCaOea() ? "Sí" : "No"),
                "comerciante" => utf8_encode($cliente->getIdsCliente()->getCaComerciante() ? "Sí" : "No"),
                "coltrans_0170" => $estadoCliente[1],
                "colmas_0170" => $estadoCliente[2],
                "colotm_0170" => $estadoCliente[3],
                "coldepositos_0170" => $estadoCliente[4],
                "coltrans_std" => $estadoCliente[5],
                "coltrans_fch" => $estadoCliente[6],
                "colmas_std" => $estadoCliente[7],
                "colmas_fch" => $estadoCliente[8],
                "colotm_std" => $estadoCliente[9],
                "colotm_fch" => $estadoCliente[10],
                "coldepositos_std" => $estadoCliente[11],
                "coldepositos_fch" => $estadoCliente[12]
            );
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $debug, "query" => $query);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosContactos(sfWebRequest $request) {
        $cliente = Doctrine::getTable("IdsCliente")
                ->createQuery("i")
                ->addWhere('i.ca_idcliente = ?', $request->getParameter("idcliente"))
                ->fetchOne();

        $data = array();
        $contactos = $cliente->getContacto();
        foreach ($contactos as $contacto) {
            $data[] = array("idcontacto" => $contacto->getCaIdcontacto(),
                "nombre" => utf8_encode($contacto->getCaNombres() . " " . $contacto->getCaPapellido()),
                "cargo" => utf8_encode($contacto->getCaCargo()),
                "area" => utf8_encode($contacto->getCaDepartamento()),
                "telefono" => utf8_encode($contacto->getCaTelefonos()),
                "email" => utf8_encode($contacto->getCaEmail()),
                "observaciones" => utf8_encode($contacto->getCaObservaciones()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosContactosIds(sfWebRequest $request) {
        $contactos = Doctrine::getTable("IdsContacto")
                ->createQuery("i")
                ->addWhere('i.ca_idsucursal = ?', $request->getParameter("idsucursal"))
                ->execute();

        $sucursal = Doctrine::getTable("IdsSucursal")
                ->createQuery("i")
                ->addWhere('i.ca_idsucursal = ?', $request->getParameter("idsucursal"))
                ->fetchOne();

        $data = array();

        foreach ($contactos as $contacto) {

            $data[] = array("nombre" => utf8_encode($contacto->getCaNombres() . " " . $contacto->getCaPapellido()),
                //"codigo" => utf8_encode($contacto->getCaCodigoarea()),
                "codigo" => "(" . utf8_encode($sucursal->getCiudad()->getTrafico()->getCodigoarea()) . ") (" . utf8_encode($contacto->getCaCodigoarea()) . ")",
                "telefono" => utf8_encode($contacto->getCaTelefonos()),
                "email" => utf8_encode($contacto->getCaEmail()),
                "cargo" => utf8_encode($contacto->getCaCargo()),
                "impo_expo" => utf8_encode($contacto->getCaImpoexpo()),
                "transporte" => utf8_encode($contacto->getCaTransporte()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
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
                $data["cargo"] = utf8_encode($contacto->getCaCargo());
                $data["cargo_general"] = utf8_encode($contacto->getCaCargoGeneral());
                if ($contacto->getCaIdentificacionTipo() == 0) {
                    $data["identificacion_tipo"] = "";
                } else {
                    $data["identificacion_tipo"] = utf8_encode($contacto->getCaIdentificacionTipo());
                }
                $data["identificacion"] = utf8_encode($contacto->getCaIdentificacion());
                $data["departamento"] = utf8_encode($contacto->getCaDepartamento());
                $data["telefono"] = utf8_encode($contacto->getCaTelefonos());
                $data["celular"] = utf8_encode($contacto->getCaCelular());
                $data["idsucursal"] = utf8_encode($contacto->getCaIdsucursal());
                $cumpleanos = explode("-", utf8_encode($contacto->getCaCumpleanos()));
                $data["mes"] = $cumpleanos[0];
                $data["dia"] = $cumpleanos[1];
                $data["correo"] = utf8_encode($contacto->getCaEmail());
                $data["activo"] = ($contacto->getCaActivo()) ? true : false;
                $data["fijo"] = ($contacto->getCaFijo()) ? true : false;
                $data["factutronica"] = ($contacto->getCaFactElectronica()) ? true : false;
                $data["tipo"] = ($contacto->getCaTipo() === 1) ? $contacto->getCaTipo() : 0;
                $data["observaciones"] = utf8_encode($contacto->getCaObservaciones());
                $data["tipo_cliente"] = utf8_encode($contacto->getIdsSucursal()->getIds()->getIdsCliente()->getCaTipo());
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

    public function executeGuardarContacto(sfWebRequest $request) {
        $idContacto = $request->getParameter("idcontacto");
        $contacto_activo = $request->getParameter("activo");
        $contacto_fijo = $request->getParameter("fijo");
        $fact_electronica = $request->getParameter("factutronica");

        if ($idContacto) {
            $contacto = Doctrine::getTable("IdsContacto")
                    ->createQuery("i")
                    ->addWhere('i.ca_idcontacto = ?', $idContacto)
                    ->fetchOne();
        } else {
            $contacto = new IdsContacto();
        }

        $sucursal = Doctrine::getTable("IdsSucursal")
                ->createQuery("i")
                ->addWhere('i.ca_idsucursal = ?', $request->getParameter("idsucursal"))
                ->fetchOne();

        $conn = Doctrine::getTable("IdsContacto")->getConnection();
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
            if ($request->getParameter("cargo")) {
                $contacto->setCaCargo(utf8_decode($request->getParameter("cargo")));
            }
            if ($request->getParameter("cargo_general")) {
                $contacto->setCaCargoGeneral(utf8_decode($request->getParameter("cargo_general")));
            }
            if ($request->getParameter("departamento")) {
                $contacto->setCaDepartamento(utf8_decode($request->getParameter("departamento")));
            }
            if ($request->getParameter("mes") and $request->getParameter("dia")) {
                $contacto->setCaCumpleanos($request->getParameter("mes") . "-" . $request->getParameter("dia"));
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
            if ($request->getParameter("tipo") == 1) {
                $contacto->setCaTipo($request->getParameter("tipo"));
            } else {
                $contacto->setCaTipo(0);
            }
            if (isset($contacto_activo)) {
                $contacto->setCaActivo($contacto_activo);
            }
            if (isset($contacto_fijo)) {
                $contacto->setCaFijo($contacto_fijo);
            }
            if (isset($fact_electronica)) {
                $contacto->setCaFactElectronica($fact_electronica);
            }
            if ($request->getParameter("idsucursal")) {
                $contacto->setCaIdsucursal($request->getParameter("idsucursal"));
            }
            if ($request->getParameter("observaciones")) {
                $contacto->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
            }
            $contacto->setCaUsuactualizado($this->getUser()->getUserId());
            $contacto->setCaFchactualizado(date("Y-m-d H:i:s"));
            /* Lanza una consulta del Contacto en Infolaft - Listas Vinculantes */
//            if ($request->getParameter("identificacion_tipo") and $request->getParameter("identificacion") and $this->getUser()->getIdtrafico() != "PE-051") {    // Realiza Consulta solo para Cargos Específicos marcados en Parámetros
//                $contacto->getNuevaConsulta("Id");
//            }

            $contacto->save();
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarGridLibretaCliente(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $correos = json_decode($request->getParameter("datos"));

//        $cliente = Doctrine::getTable("IdsCliente") 
//        ->createQuery("i")
//        ->addWhere('i.ca_idcliente = ?', $idcliente)
//        ->fetchOne();

        $cliente = Doctrine::getTable("IdsCliente")->find($idcliente);

        $cadena = array();
        foreach ($correos as $correo) {
            if ($correo->email != '')
                $cadena[] = $correo->email;
        }
        $correo = implode(",", $cadena);

        try {
            $cliente->setCaConfirmar($correo);
            $cliente->save();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosHistoricoClientes(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

        $auditorias = Doctrine::getTable("IdsAuditoria")
                ->createQuery("i")
                ->addWhere('i.ca_idcliente = ?', $idCliente)
                ->addOrderBy("i.ca_stamp DESC")
                ->execute();

        $data = array();
        $operaciones = array("I" => "Nuevo Registro", "U" => "Actualización", "D" => "Borrado");
        foreach ($auditorias as $auditoria) {
            $data[] = array("operacion" => utf8_encode($operaciones[$auditoria->getCaOperation()]),
                "fecha" => utf8_encode($auditoria->getCaStamp()),
                "usuario" => utf8_encode($auditoria->getCaUserid()),
                "tabla" => utf8_encode($auditoria->getCaTableName()),
                "campo" => utf8_encode(($auditoria->getCaFieldName() == "ca_listaclinton") ? "ca_listavinculante" : $auditoria->getCaFieldName()),
                "dato_anterior" => utf8_encode($auditoria->getCaValueOld()),
                "dato_nuevo" => utf8_encode($auditoria->getCaValueNew()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCambiosEstadoClientes(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select s.ca_idcliente, s.ca_estado, s.ca_fchestado, e.ca_nombre, a.ca_origen from ids.tb_clientes_estados s "
                . " inner join control.tb_empresas e on e.ca_idempresa = s.ca_idempresa"
                . " left  join public.vi_actividad_clientes a on a.ca_idcliente = s.ca_idcliente and a.ca_idempresa = s.ca_idempresa and a.ca_fchcreado = s.ca_fchestado"
                . " where s.ca_idcliente = $idCliente"
                . " ORDER BY s.ca_idempresa, s.ca_fchestado desc";

        $rs = $con->execute($sql);
        $estados = $rs->fetchAll();

        $tree = new JTree();
        $root = $tree->createNode(".");

        $tree->addFirst($root);
        foreach ($estados as $estado) {
            $uid = $root;
            $eje_raiz = array();
            $eje_raiz[] = utf8_encode($estado["ca_nombre"]);

            foreach ($eje_raiz as $eje) {
                $value = $eje;
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

            $record = array();
            $record["text"] = utf8_encode($estado["ca_estado"]);
            $record["fchestado"] = $estado["ca_fchestado"];
            $record["origen"] = utf8_encode($estado["ca_origen"]);
            $record["leaf"] = true;

            $nodo->setAttribute("children", $record);
        }

        $this->responseArray = $tree->getTreeNodes();
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosSeguimientoClientes(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

        $seguimientos = Doctrine::getTable("IdsEventos")
                ->createQuery("i")
                ->addWhere('i.ca_idcliente = ?', $idCliente)
                ->addOrderBy("i.ca_fchevento DESC")
                ->execute();

        $data = array();

        foreach ($seguimientos as $seguimiento) {
            $empresas = "";
            $arrayEmp = $seguimiento->getDatosJson("idempresas");            
            
            if($arrayEmp){                
                foreach($arrayEmp as $key => $val){
                    $empresa = Doctrine::getTable("Empresa")->find($val);
                    $empresas.= $empresa->getCaNombre()."<br>";
                }
            }
            
            $data[] = array("fecha" => utf8_encode($seguimiento->getCaFchevento()),
                "usuario" => utf8_encode($seguimiento->getCaUsuario()),
                "tipo" => utf8_encode($seguimiento->getCaTipo()),
                "empresas"=> utf8_encode($empresas),
                "asunto" => utf8_encode($seguimiento->getCaAsunto()),
                "detalle" => utf8_encode($seguimiento->getCaDetalle()),
                "compromisos" => utf8_encode($seguimiento->getCaCompromisos()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarSeguimiento(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");
        $idempresas = $request->getParameter("idempresas");
        $ids = Doctrine::getTable("Ids")->find($idCliente);

        $con = Doctrine::getTable("IdsEventos")->getConnection();
        try {
            $con->beginTransaction();
            $evento = new IdsEventos();
            $evento->setCaIdcliente($idCliente);
            $evento->setCaFchevento(date("Y-m-d H:i:s"));

            $caso = "CU262";
            $posicion = $request->getParameter("tipo");
            $datomod = ParametroTable::retrieveByCaso($caso, null, null, null);
            $tipo = utf8_encode($datomod[($posicion - 1)]->getCaValor());
            $evento->setCaTipo(utf8_decode($tipo));
            if ($request->getParameter("asunto") != "")
                $evento->setCaAsunto(utf8_decode($request->getParameter("asunto")));
            $evento->setCaDetalle(utf8_decode($request->getParameter("detalle")));
            $evento->setCaCompromisos(utf8_decode($request->getParameter("compromisos")));
            $evento->setCaFchcompromiso($request->getParameter("fecha"));
            $evento->setCaIdantecedente($request->getParameter("seguimiento_antecesor"));
            $evento->setCaUsuario($this->getUser()->getUserId());

            if($idempresas){
                $datos = array();
                $arrayEmp = array_map('intval', explode(',', $idempresas ));        
                $datos["idempresas"] = $arrayEmp;

                $evento->setCaDatos(json_encode($datos));
            }
            
            $evento->save();

            list($ano, $mes, $dia) = sscanf($evento->getCaFchcompromiso(), "%d-%d-%d");
            $fchVencimiento = date('Y-m-d H:i:s', mktime(23, 59, 59, $mes, $dia, $ano));
            $tarea = new NotTarea();
            $tarea->setCaUrl("/crm/indexExt5/idcliente/$idCliente");
            $tarea->setCaIdlistatarea(9);
            $tarea->setCaFchcreado($evento->getCaFchevento());
            $tarea->setCaFchvisible($evento->getCaFchcompromiso());
            $tarea->setCaFchvencimiento($fchVencimiento);
            $tarea->setCaUsucreado($this->getUser()->getUserId());
            $tarea->setCaTitulo($ids->getCaNombre(). " - ".utf8_decode($tipo). ' - '.$evento->getCaAsunto() . " - " . $evento->getCaFchevento());
            $tarea->setCaTexto($evento->getCaDetalle());
            $tarea->save();

            $asignacion = new NotTareaAsignacion();
            $asignacion->setCaIdtarea($tarea->getCaIdtarea());
            $asignacion->setCaLogin($tarea->getCaUsucreado());
            $asignacion->save();

            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarDatosCliente(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");
        if ($idCliente) {
            $cliente = Doctrine::getTable("IdsCliente")
                    ->createQuery("i")
                    ->addWhere('i.ca_idcliente = ?', $idCliente)
                    ->fetchOne();

            $data = array();
            if ($cliente) {
                $data["idalterno_id"] = utf8_encode($cliente->getIds()->getCaIdalterno());
                $data["dv_id"] = $cliente->getIds()->getCaDv();
                $data["dv_valido"] = $cliente->getIds()->getCaDv();
                $data["cliente"] = utf8_encode($cliente->getIds()->getCaNombre());
                $data["comercial"] = utf8_encode($cliente->getCaVendedor());
                $data["coord_aduana"] = utf8_encode($cliente->getCaCoordinador());
                $data["tipo_identificacion"] = utf8_encode($cliente->getIds()->getIdsTipoIdentificacion()->getCaTipoidentificacion());
                if ($cliente->getIds()->getIdsTipoIdentificacion()->getCaIdtrafico() == 'CO-057') {
                    $direccion = explode("|", utf8_encode($cliente->getCaDireccion()));
                    $data["direccion1"] = $direccion[0];
                    $data["direccion2"] = $direccion[1];
                    $data["direccion3"] = $direccion[2];
                    $data["direccion4"] = $direccion[3];
                    $data["direccion5"] = $direccion[4];
                    $data["direccion6"] = $direccion[5];
                    $data["direccion7"] = $direccion[6];
                    $data["direccion8"] = $direccion[7];
                    $data["direccion9"] = $direccion[8];
                    $data["direccion10"] = $direccion[9];
                    $data["oficina"] = utf8_encode($cliente->getCaOficina());
                    $data["torre"] = utf8_encode($cliente->getCaTorre());
                    $data["bloque"] = utf8_encode($cliente->getCaBloque());
                    $data["interior"] = utf8_encode($cliente->getCaInterior());
                    $data["complemento"] = utf8_encode($cliente->getCaComplemento());
                    $data["localidad"] = utf8_encode($cliente->getCaLocalidad());
                    $data["codigo_postal"] = utf8_encode($cliente->getCaZipcode());
                    $data["ciudad"] = utf8_encode($cliente->getCaIdciudad());
                    $data["telefono"] = utf8_encode($cliente->getCaTelefonos());
                    $data["fax"] = utf8_encode($cliente->getCaFax());
                    $data["e_mail"] = utf8_encode($cliente->getCaEmail());
                    $data["website"] = utf8_encode($cliente->getCaWebsite());
                } else {
                    $direccion = explode("|", utf8_encode($cliente->getCaDireccion()));
                    $data["direccion0"] = $direccion[0];
                    $data["localidad2"] = utf8_encode($cliente->getCaLocalidad());
                    $data["ciudad2"] = utf8_encode($cliente->getCaIdciudad());
                }
                $data["titulo"] = utf8_encode($cliente->getCaSaludo());
                $data["nombre"] = utf8_encode($cliente->getCaNombres());
                $data["apellido1"] = utf8_encode($cliente->getCaPapellido());
                $data["apellido2"] = utf8_encode($cliente->getCaSapellido());
                $data["genero"] = utf8_encode($cliente->getCaSexo());
                $data["cumpleanos"] = utf8_encode($cliente->getCaCumpleanos());
                $data["tpRepresentante"] = utf8_encode($cliente->getCaTipoidentificacionRl());
                $data["idRepresentante"] = utf8_encode($cliente->getCaNumidentificacionRl());
                $data["actividad"] = utf8_encode($cliente->getCaActividad());
                $data["sector_economico"] = utf8_encode($cliente->getCaSectoreco());
                $data["leyinsolvencia"] = utf8_encode($cliente->getCaLeyinsolvencia());
                $data["comentario"] = utf8_encode($cliente->getCaComentario());
                $data["contrato_agendamiento"] = utf8_encode($cliente->getCaFchcotratoag());
                $data["status"] = utf8_encode($cliente->getCaStatus());
                $data["calificacion"] = utf8_encode($cliente->getCaCalificacion());
                $data["entidad"] = utf8_encode($cliente->getCaEntidad());
                $data["confidencialidad"] = utf8_encode($cliente->getCaFchacuerdoconf());

                if (strpos($cliente->getCaPropiedades(), 'cuentaglobal=true') !== false) {
                    $data["cuenta_global"] = true;
                }
                if (strpos($cliente->getCaPropiedades(), 'consolidar_comunicaciones=true') !== false) {
                    $data["consolidar"] = true;
                }
                $data["preferencias"] = utf8_encode($cliente->getCaPreferencias());
            }
            $this->responseArray = array("success" => true, "data" => $data);
            $this->setTemplate("responseTemplate");
        } else {
            $data["idalterno_id"] = '';
            $this->responseArray = array("success" => true, "data" => $data);
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeGuardarDatosCliente(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");
        $idalterno_id = strtoupper($request->getParameter("idalterno_id"));
        $cliente_nuevo = false;
        if ($idCliente) {
            $cliente = Doctrine::getTable("IdsCliente")
                    ->createQuery("i")
                    ->addWhere('i.ca_idcliente = ?', $idCliente)
                    ->fetchOne();

            $ids = Doctrine::getTable("Ids")
                    ->createQuery("i")
                    ->addWhere('i.ca_id = ?', $idCliente)
                    ->fetchOne();
        } else {
            $ids = Doctrine::getTable("Ids")
                    ->createQuery("i")
                    ->addWhere('i.ca_idalterno = ?', $idalterno_id)
                    ->fetchOne();
            if (!$ids) {
                $ids = new Ids();
            }
            $cliente_nuevo = true;
            $cliente = new IdsCliente();
            $sucursal = new IdsSucursal();
            $cliente->setCaIdgrupo($idalterno_id);
        }
        
        $consulta_listas = false;
        $conn = Doctrine_Manager::getInstance()->connection();
        try {
            $conn->beginTransaction();
            
            if ($ids->getCaIdalterno() != $idalterno_id or $ids->getCaDv() != $request->getParameter("dv_id")) {
                $consulta_listas = true;
            }
            $ids->setCaIdalterno($idalterno_id);
            $ids->setCaTipoidentificacion($request->getParameter("tipo_identificacion"));
            $ids->setCaDv($request->getParameter("dv_id"));
            $ids->setCaWebsite($request->getParameter("website"));
            
            if ($ids->getCaNombre() != utf8_decode(strtoupper($request->getParameter("cliente")))) {
                $consulta_listas = true;
            }
            $ids->setCaNombre(utf8_decode(strtoupper($request->getParameter("cliente"))));

            $cliente->setCaVendedor(utf8_decode($request->getParameter("comercial")));
            $cliente->setCaCoordinador(utf8_decode($request->getParameter("coord_aduana")));

            $idtrafico = $ids->getIdsTipoIdentificacion()->getCaIdtrafico();

            if ($idtrafico == "CO-057") {
                //Direccion
                $direccion = "";
                for ($i = 1; $i <= 10; $i++) {
                    ($i > 1) ? $direccion .= "|" : "";
                    $direccion .= $request->getParameter("direccion" . $i);
                }
                
                if ($cliente->getCaDireccion() != utf8_decode($direccion)) {
                    $consulta_listas = true;
                }
                $cliente->setCaDireccion(utf8_decode($direccion));

                $cliente->setCaOficina($request->getParameter("oficina"));
                $cliente->setCaTorre($request->getParameter("torre"));
                $cliente->setCaBloque($request->getParameter("bloque"));
                $cliente->setCaInterior($request->getParameter("interior"));
                $cliente->setCaComplemento(utf8_decode($request->getParameter("complemento")));
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad")));
                $cliente->setCaIdciudad(utf8_decode($request->getParameter("ciudad")));
            } else {
                if ($cliente->getCaDireccion() != $request->getParameter("direccion0")) {
                    $consulta_listas = true;
                }
                $cliente->setCaDireccion(utf8_decode($request->getParameter("direccion0")));
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad2")));
                $cliente->setCaIdciudad(utf8_decode($request->getParameter("ciudad2")));
            }

            $cliente->setCaZipcode(utf8_decode($request->getParameter("codigo_postal")));
            $cliente->setCaTelefonos(utf8_decode($request->getParameter("telefono")));
            $cliente->setCaFax(utf8_decode($request->getParameter("fax")));
            $cliente->setCaEmail(utf8_decode($request->getParameter("e_mail")));
            $cliente->setCaWebsite(utf8_decode($request->getParameter("website")));
            $cliente->setCaSaludo(utf8_decode($request->getParameter("titulo")));
            $cliente->setCaNombres(utf8_decode($request->getParameter("nombre")));
            $cliente->setCaPapellido(utf8_decode($request->getParameter("apellido1")));
            $cliente->setCaSapellido(utf8_decode($request->getParameter("apellido2")));
            $cliente->setCaSexo(utf8_decode($request->getParameter("genero")));
            if ($request->getParameter("tpRepresentante"))
                $cliente->setCaTipoidentificacionRl($request->getParameter("tpRepresentante"));
            $cliente->setCaNumidentificacionRl($request->getParameter("idRepresentante"));
            $cliente->setCaCumpleanos(utf8_decode($request->getParameter("cumpleanos")));
            $cliente->setCaActividad(utf8_decode($request->getParameter("actividad")));
            $cliente->setCaSectoreco(utf8_decode($request->getParameter("sector_economico")));
            $cliente->setCaLeyinsolvencia(utf8_decode($request->getParameter("leyinsolvencia")));
            $cliente->setCaComentario(utf8_decode($request->getParameter("comentario")));

            if ($request->getParameter("contrato_agendamiento") != '') {
                $cliente->setCaFchcotratoag(utf8_decode($request->getParameter("contrato_agendamiento")));
            } else {
                $cliente->setCaFchcotratoag(null);
            }

            if ($request->getParameter("status")) {
                $cliente->setCaStatus(utf8_decode($request->getParameter("status")));
            } else {
                $cliente->setCaStatus(null);
            }
            $cliente->setCaCalificacion(utf8_decode($request->getParameter("calificacion")));
            $cliente->setCaEntidad(utf8_decode($request->getParameter("entidad")));
            if ($request->getParameter("confidencialidad") != '') {
                $cliente->setCaFchacuerdoconf(utf8_decode($request->getParameter("confidencialidad")));
            } else {
                $cliente->setCaFchacuerdoconf(null);
            }

            $propiedades = $cliente->getCaPropiedades();

            if (strpos($propiedades, 'cuentaglobal=true') !== false) {
                if (!$request->getParameter("cuenta_global")) {
                    $propiedades = str_replace('cuentaglobal=true', "", $propiedades);
                }
            } else {
                if ($request->getParameter("cuenta_global")) {
                    $propiedades .= ' cuentaglobal=true';
                }
            }

            if (strpos($propiedades, 'consolidar_comunicaciones=true') !== false) {
                if (!$request->getParameter("consolidar")) {
                    $propiedades = str_replace('consolidar_comunicaciones=true', "", $propiedades);
                }
            } else {
                if ($request->getParameter("consolidar")) {
                    $propiedades .= ' consolidar_comunicaciones=true';
                }
            }

            $cliente->setCaPropiedades(utf8_decode($propiedades));
            $cliente->setCaPreferencias(utf8_decode($request->getParameter("preferencias")));

            $ids->save($conn);
            $cliente->setCaIdgrupo($ids->getCaId());
            $cliente->setCaIdcliente($ids->getCaId());
            $cliente->setIds($ids);
            $cliente->save($conn);

            /* Lanza una consulta del Proveedor en Infolaft - Listas Vinculantes */
            if ($this->getUser()->getIdtrafico() != "PE-051" and $consulta_listas) {
                $ids->getNuevaConsulta("Id&Nombre");
            }

            if ($sucursal) { /* Crea la Sucursal Principal Automáticamente */
                $sucursal->setCaId($ids->getCaId());
                $sucursal->setCaNombre("Domicilio Principal");
                $sucursal->setCaPrincipal(true);
                $sucursal->setCaIdciudad($cliente->getCaIdciudad());
                $sucursal->setCaDireccion(trim($cliente->getDireccion()));
                $sucursal->setCaTelefonos($cliente->getCaTelefonos());
                $sucursal->setCaFax($cliente->getCaFax());
                $sucursal->save($conn);
            }

            /* Lanza una Consulta sobre el Representante Legal */
            if ($cliente_nuevo or $cliente->getCaNumidentificacionRl()!=$request->getParameter("idRepresentante") or $cliente->getCaNombres()!=utf8_decode($request->getParameter("nombre")) or $cliente->getCaPapellido()!=utf8_decode($request->getParameter("apellido1")) or $cliente->getCaSapellido()!=utf8_decode($request->getParameter("apellido2"))) {
                IdsRestrictivasTable::lanzarConsultaInfolaft($ids->getCaId(), $cliente->getCaNumidentificacionRl(), $cliente->getRepresentanteLegal(), "Id&Nombre");
            }

            $conn->commit();
            $this->responseArray = array("success" => true, "idcliente" => $ids->getCaId() . "", "nombreCliente" => utf8_encode($ids->getCaNombre()));
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

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
            if ($ids->getIdsCliente()->getCaUsucreado()) {
                $error = utf8_encode("El número de NIT ya se encuentra registrado como Cliente en CRM");
            } else {
                // $agente = ($ids->getIdsAgente())?true:false; /* Valida si se está creando un Agente como Cliente */
                $agente = Doctrine::getTable("Ids")
                        ->createQuery("i")
                        ->innerJoin("i.IdsAgente a")
                        ->addWhere('i.ca_idalterno = ?', $idalterno)
                        ->fetchOne();

                $data["tipo_identificacion"] = utf8_encode($ids->getIdsTipoIdentificacion()->getCaTipoidentificacion());
                $data["idalterno_id"] = utf8_encode($ids->getCaIdalterno());
                $data["dv_id"] = utf8_encode($ids->getCaDv());
                $data["cliente"] = utf8_encode($ids->getCaNombre());

                $sucPrincipal = $ids->getSucursalPrincipal();
                if ($sucPrincipal) {
                    if ($ids->getIdsTipoIdentificacion()->getCaIdtrafico() == 'CO-057') {
                        $data["complemento"] = utf8_encode($sucPrincipal->getCaDireccion());
                        $data["localidad"] = utf8_encode($sucPrincipal->getCaLocalidad());
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
            }
        }
        $data["dv_valido"] = Utils::calcularDV($idalterno);
        $this->responseArray = array("success" => true, "data" => $data, "error" => $error, "agente" => ($agente) ? true : false);

        $this->setTemplate("responseTemplate");
    }

    public function executeValidarDigitoVerificacion(sfWebRequest $request) {
        $idalterno = $request->getParameter("idalterno");
        $dv = $request->getParameter("dv");
        $dv_cal = Utils::calcularDV($idalterno);
        if ($idalterno) {
            if ($dv != $dv_cal) {
                $this->responseArray = array("success" => true, "data" => utf8_encode("El digito de verificación no corresponde con el número de NIT!"));
            } else {
                $this->responseArray = array("success" => true, "data" => "");
            }
        } else {
            $this->responseArray = array("success" => true, "data" => "");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosPorcentajeComision(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");
        try {
            $porcentajesComisiones = Doctrine::getTable("PorcentajesComisiones")
                    ->createQuery("i")
                    ->addWhere('i.ca_idcliente = ?', $idCliente)
                    ->addOrderBy("i.ca_inicio DESC")
                    ->execute();

            $data = array();

            foreach ($porcentajesComisiones as $porcentajeComision) {
                $data[] = array("inicio" => utf8_encode($porcentajeComision->getCaInicio()),
                    "fin" => utf8_encode($porcentajeComision->getCaFin()),
                    "porcentaje" => utf8_encode($porcentajeComision->getCaPorcentaje()),
                    "empresa" => utf8_encode($porcentajeComision->getCaEmpresa()),
                    "creacion" => utf8_encode($porcentajeComision->getCaUsucreado() . " - " . $porcentajeComision->getCaFchcreado()),
                    "ult_modificacion" => utf8_encode($porcentajeComision->getCaUsuactualizado() . " - " . $porcentajeComision->getCaFchactualizado()));
            }

            $this->responseArray = array("success" => true, "data" => $data);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarPorcentajeComision(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

        $fechaInicioNueva = date("Y-m-d", strtotime($request->getParameter("inicio")));
        $fechaFinNueva = date("Y-m-d", strtotime($request->getParameter("fin")));

        $porcentajeComisionBD = Doctrine::getTable("PorcentajesComisiones")
                ->createQuery("i")
                ->addWhere('i.ca_idcliente = ?', $idCliente)
                ->addWhere('i.ca_empresa = ?', $request->getParameter("empresa"))
                ->fetchOne();

        if ($porcentajeComisionBD) {
            $fechaInicioBD = date("Y-m-d", strtotime($porcentajeComisionBD->getCaInicio()));
            $fechaFinBD = date("Y-m-d", strtotime($porcentajeComisionBD->getCaFin()));

            //Caso 1
            if (($fechaInicioNueva <= $fechaInicioBD) && (($fechaFinNueva >= $fechaInicioBD) && ($fechaFinNueva <= $fechaFinBD))) {
                $fechaInicioBD = date('Y-m-d', strtotime("$fechaFinNueva + 1 day"));
                $porcentajeComisionBD->setCaInicio($fechaInicioBD);
                $porcentajeComisionBD->setCaFchactualizado(date("Y-m-d H:i:s"));
                $porcentajeComisionBD->setCaUsuactualizado($this->getUser()->getUserId());

                $porcentajeComisionBD->save();
            }

            //Caso 2
            if ((($fechaInicioNueva >= $fechaInicioBD) && ($fechaInicioNueva <= $fechaFinBD)) && ($fechaFinNueva >= $fechaFinBD)) {
                $fechaFinBD = date('Y-m-d', strtotime("$fechaInicioNueva - 1 day"));
                $porcentajeComisionBD->setCaFin($fechaFinBD);
                $porcentajeComisionBD->setCaFchactualizado(date("Y-m-d H:i:s"));
                $porcentajeComisionBD->setCaUsuactualizado($this->getUser()->getUserId());

                $porcentajeComisionBD->save();
            }

            //Caso 3
            if ((($fechaInicioNueva >= $fechaInicioBD) && ($fechaInicioNueva <= $fechaFinBD)) && (($fechaFinNueva >= $fechaInicioBD) && ($fechaFinNueva <= $fechaFinBD))) {
                $porcentajeComisionBD->setCaFin(date('Y-m-d', strtotime("$fechaInicioNueva - 1 day")));
                $porcentajeComisionBD->setCaFchactualizado(date("Y-m-d H:i:s"));
                $porcentajeComisionBD->setCaUsuactualizado($this->getUser()->getUserId());

                $porcentajeComisionBD->save();

                //Crear registro nuevo
                $porcentajeComisionNuevoBD = new PorcentajesComisiones();
                $porcentajeComisionNuevoBD->setCaIdcliente($idCliente);

                $porcentajeComisionNuevoBD->setCaFchcreado($porcentajeComisionBD->getCaFchcreado());
                $porcentajeComisionNuevoBD->setCaUsucreado($porcentajeComisionBD->getCaUsucreado());

                $porcentajeComisionNuevoBD->setCaFchactualizado(date("Y-m-d H:i:s"));
                $porcentajeComisionNuevoBD->setCaUsuactualizado($this->getUser()->getUserId());

                $porcentajeComisionNuevoBD->setCaInicio(date('Y-m-d', strtotime("$fechaFinNueva + 1 day")));
                $porcentajeComisionNuevoBD->setCaFin($fechaFinBD);
                $porcentajeComisionNuevoBD->setCaEmpresa($porcentajeComisionBD->getCaEmpresa());
                $porcentajeComisionNuevoBD->setCaPorcentaje($porcentajeComisionBD->getCaPorcentaje());

                $porcentajeComisionNuevoBD->save();
            }

            //Caso 4
            if (($fechaInicioNueva < $fechaInicioBD) && ($fechaFinNueva > $fechaFinBD)) {
                $porcentajeComisionBD->setCaFchactualizado(date("Y-m-d H:i:s"));
                $porcentajeComisionBD->setCaUsuactualizado($this->getUser()->getUserId());

                $porcentajeComisionBD->setCaInicio($request->getParameter("inicio"));
                $porcentajeComisionBD->setCaFin($request->getParameter("fin"));
                $porcentajeComisionBD->setCaPorcentaje($request->getParameter("porcentaje"));

                $porcentajeComisionBD->save();
                $this->responseArray = array("success" => true);
            } else {
                //Guardar registro nuevo
                $con = Doctrine::getTable("PorcentajesComisiones")->getConnection();
                try {
                    $con->beginTransaction();
                    $porcentajeComision = new PorcentajesComisiones();
                    $porcentajeComision->setCaIdcliente($idCliente);

                    $porcentajeComision->setCaFchcreado(date("Y-m-d H:i:s"));
                    $porcentajeComision->setCaUsucreado($this->getUser()->getUserId());

                    $porcentajeComision->setCaInicio($request->getParameter("inicio"));
                    $porcentajeComision->setCaFin($request->getParameter("fin"));
                    $porcentajeComision->setCaEmpresa($request->getParameter("empresa"));
                    $porcentajeComision->setCaPorcentaje($request->getParameter("porcentaje"));

                    $porcentajeComision->save();
                    $con->commit();
                    $this->responseArray = array("success" => true);
                } catch (Exception $e) {
                    $con->rollBack();
                    $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
                }
            }
        } else {
            //Guardar registro nuevo (otra empresa)
            $con = Doctrine::getTable("PorcentajesComisiones")->getConnection();
            try {
                $con->beginTransaction();
                $porcentajeComision = new PorcentajesComisiones();
                $porcentajeComision->setCaIdcliente($idCliente);

                $porcentajeComision->setCaFchcreado(date("Y-m-d H:i:s"));
                $porcentajeComision->setCaUsucreado($this->getUser()->getUserId());

                $porcentajeComision->setCaInicio($request->getParameter("inicio"));
                $porcentajeComision->setCaFin($request->getParameter("fin"));
                $porcentajeComision->setCaEmpresa($request->getParameter("empresa"));
                $porcentajeComision->setCaPorcentaje($request->getParameter("porcentaje"));

                $porcentajeComision->save();
                $con->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $con->rollBack();
                $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
            }
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeCargarDatosFichaTecnica(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $fichatecnica = Doctrine::getTable("FichaTecnica")
                ->createQuery("d")
                ->where("d.ca_idcliente = ?", $idcliente)
                ->fetchOne();
        if ($fichatecnica) {
            $nuevo = true;
            $documentacion = utf8_encode($fichatecnica->getCaDocumentacion());
            if (strpos($documentacion, "formGen", 0) === false) {
                $documentacion = strip_tags($documentacion);
                $documentacion = substr($documentacion, 2, strlen($documentacion));
                $documentacion = substr($documentacion, 0, strlen($documentacion) - 1);
                $documentacion = str_replace('":"', '¬', $documentacion);
                $chunks = array_chunk(preg_split('/(¬|",")/', $documentacion), 2);
                $documentacion = array_combine(array_column($chunks, 0), array_column($chunks, 1));
                $nuevo = false;
            }
            $transporte = utf8_encode($fichatecnica->getCaTransporteinternacional());
            $imprimir = true;
            $this->responseArray = array("success" => true, "documentacion" => $documentacion, "transporte" => $transporte, "imprimir" => $imprimir, "nuevo" => $nuevo);
        } else {
            $imprimir = false;
            $this->responseArray = array("success" => true, "imprimir" => $imprimir);
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeLiberarCliente(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

        $cliente = Doctrine::getTable("IdsCliente")->find($idCliente);

        try {
            $cliente->setCaVendedor(null);
            $cliente->save();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosCotizaciones(sfWebRequest $request) {

        $idcliente = $request->getParameter("idcliente");
        if ($idcliente) {
            $q = Doctrine_Query::create()
                    ->select("c.*, to_number(SUBSTR(c.ca_consecutivo, 1 , (POSITION('-' in c.ca_consecutivo)-1) ),'999999')")
                    ->from('Cotizacion c');
            $q->where("c.ca_consecutivo IS NOT NULL ");
            $q->orderBy("c.ca_empresa");
            $q->addOrderBy("EXTRACT(YEAR FROM c.ca_fchcreado) DESC  ");
            $q->addOrderBy("EXTRACT(MONTH FROM c.ca_fchcreado) DESC  ");
            $q->addOrderBy("to_number(SUBSTR(c.ca_consecutivo , 1 , (POSITION('-' in c.ca_consecutivo)-1) ),'999999')  desc");
            $q->addOrderBy("c.ca_version desc");

            $q->innerJoin("c.NotTarea tra");
            $q->innerJoin("c.Contacto con");
            $q->addWhere("con.ca_idcliente = ?", $idcliente);
            $q->limit(50);
            // echo $q->getSqlQuery();
            $cotizaciones = $q->execute();
        }

        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);
        foreach ($cotizaciones as $cotizacion) {
            $uid = $root;
            $eje_raiz = array();
            $eje_raiz[] = utf8_encode($cotizacion->getCaEmpresa());
            $eje_raiz[] = substr($cotizacion->getNotTarea()->getCaFchvisible(), 0, 4);
            $eje_raiz[] = Utils::mesLargo(substr($cotizacion->getNotTarea()->getCaFchvisible(), 5, 2));
            $eje_raiz[] = $cotizacion->getCaUsuario();

            foreach ($eje_raiz as $eje) {
                $value = $eje;
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
            foreach ($cotizacion->getCotProducto() as $producto) {
                $record = array();
                $record["text"] = $cotizacion->getCaConsecutivo();
                $record["version"] = $cotizacion->getCaVersion();
                $record["fchcotizacion"] = substr($cotizacion->getNotTarea()->getCaFchvisible(), 0, 10);
                $record["id_cotizacion"] = $cotizacion->getCaIdcotizacion();
                $record["impoexpo"] = utf8_encode($producto->getCaImpoexpo());
                $record["transporte"] = utf8_encode($producto->getCaTransporte());
                $record["modalidad"] = utf8_encode($producto->getCaModalidad());
                $record["origen"] = utf8_encode($producto->getOrigen()->getCaCiudad());
                $record["destino"] = utf8_encode($producto->getDestino()->getCaCiudad());
                $record["producto"] = utf8_encode($producto->getCaProducto());
                $record["etapa"] = utf8_encode($producto->getCaEtapa());
                $record["fchterminada"] = utf8_encode($producto->getNotTarea()->getCaFchterminada());
                $record["usuterminada"] = utf8_encode($producto->getNotTarea()->getCaUsuterminada());
                $record["cotizacion_link"] = true;

                $nodo->setAttribute("children", $record);
            }
        }

        $this->responseArray = $tree->getTreeNodes();
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosReportes(sfWebRequest $request) {

        $idcliente = $request->getParameter("idcliente");
        if ($idcliente) {
            $con = Doctrine_Manager::getInstance()->connection();

            $sql = "select *, EXTRACT(YEAR FROM ca_fchcreado) as ca_anno, EXTRACT(MONTH FROM ca_fchcreado) as ca_mes from vi_reportes2 where "
                    . "ca_idcliente = $idcliente "
                    . "order by "
                    . " EXTRACT(YEAR FROM ca_fchcreado) DESC, "
                    . " EXTRACT(MONTH FROM ca_fchcreado) DESC,"
                    . " ca_impoexpo, "
                    . " ca_transporte, "
                    . " to_number(SUBSTR(ca_consecutivo , 1 , (POSITION('-' in ca_consecutivo)-1) ),'999999')  desc, "
                    . " ca_version desc "
                    . "limit 50;";
            $reportes = $con->execute($sql);
        }
        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);
        $anno = $mes = $impoexpo = $transporte = null;
        foreach ($reportes as $reporte) {
            if ($anno != $reporte["ca_anno"] || $mes != $reporte["ca_mes"] || $impoexpo != $reporte["ca_impoexpo"] || $transporte != $reporte["ca_transporte"]) {
                $uid = $root;
                $eje_raiz = array();
                $eje_raiz[] = $reporte["ca_anno"];
                $eje_raiz[] = Utils::mesLargo($reporte["ca_mes"]);
                $eje_raiz[] = utf8_encode($reporte["ca_impoexpo"]);
                $eje_raiz[] = utf8_encode($reporte["ca_transporte"]);

                foreach ($eje_raiz as $eje) {
                    $value = $eje;
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

                $anno = $reporte["ca_anno"];
                $mes = $reporte["ca_mes"];
                $impoexpo = $reporte["ca_impoexpo"];
                $transporte = $reporte["ca_transporte"];
            }

            $record = array();
            $record["text"] = $reporte["ca_consecutivo"];
            $record["version"] = $reporte["ca_version"];
            $record["fchreporte"] = $reporte["ca_fchreporte"];
            $record["id_reporte"] = $reporte["ca_idreporte"];
            $record["modalidad"] = utf8_encode($reporte["ca_modalidad"]);
            $record["origen"] = utf8_encode($reporte["ca_ciuorigen"]);
            $record["destino"] = utf8_encode($reporte["ca_ciudestino"]);
            $record["orden_clie"] = utf8_encode($reporte["ca_orden_clie"]);
            $record["login"] = utf8_encode($reporte["ca_login"]);
            $record["colmas"] = utf8_encode($reporte["ca_colmas"]);
            $record["seguro"] = utf8_encode($reporte["ca_seguro"]);
            $record["continuacion"] = utf8_encode($reporte["ca_continuacion"]);
            $record["fchactualizado"] = utf8_encode($reporte["ca_fchactualizado"]);
            $record["usuactualizado"] = utf8_encode($reporte["ca_usuactualizado"]);
            $record["reporte_link"] = true;

            $nodo->setAttribute("children", $record);
        }

        $this->responseArray = $tree->getTreeNodes();
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosStatus(sfWebRequest $request) {
///////////////////////////////////////////////////////
        /* $num=5000;
          $k=0;
          $cont=0;
          $arr = array();

          for ($j = 1; $j < $num; $j++){
          $cont = 0;
          for ($i = 1; $i <= $j; $i++){
          if($j % $i == 0){
          $cont++;
          }
          }
          if ($cont == 2){
          $arr[$k] = $j;
          $k++;
          }
          }
          $j=1;
          for($i = 0; $i < $k; $i++){
          if(($arr[$i+1] - $arr[$i]) == 2){
          //                if ($j === 101){
          echo $j.". ".$arr[$i]. " ". $arr[$i+1]."\n";
          //                }
          $j++;
          }
          }
          exit(); */

///////////////////////////////////////////////////////

        $idcliente = $request->getParameter("idcliente");

        //$reporte = Doctrine::getTable("Reporte")->find($idreporte);
        //<tr><th>Proveedor</th><td>" . $reporte->getProveedoresStr() . "</td></tr>

        $status = Doctrine_Query::create()
                ->from("Reporte r")
                ->select("r.*, o.*, d.*, t.*")
                ->innerJoin("r.Contacto c")
                ->innerJoin("c.Cliente cl")
                ->innerJoin("r.Origen o")
                ->innerJoin("r.Destino d")
                ->innerJoin("o.Trafico to")
                ->leftJoin("r.TrackingEtapa t")
                ->addWhere("cl.ca_idcliente = ? ", $idcliente)
                ->addWhere("r.ca_usuanulado IS NULL ")
                ->limit(200)
                ->addOrderBy("ca_idreporte DESC")
                ->addOrderBy("ca_etapa_actual DESC");
        $resultados = $status->execute();

        $data = array();

//        echo $status->getSqlQuery();
//        exit();
        foreach ($resultados as $st) {
            $reporte = Doctrine::getTable("Reporte")->find($st["ca_idreporte"]);
            $data[] = array("fecha_rep" => $st["ca_fchreporte"],
                "reporte" => $st["ca_consecutivo"],
                "origen" => utf8_encode($st["ca_origen"]),
                "destino" => utf8_encode($st["ca_destino"]),
                "modalidad" => utf8_encode($st["ca_modalidad"]),
                "proveedor" => utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre()),
                "orden" => utf8_encode($st["ca_orden_clie"]),
                "etapa_actual" => utf8_encode($st["ca_etapa_actual"]));
        }
        try {
            $this->responseArray = array("success" => true, "root" => $data);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarControlFinanciero(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");

        $cliente = Doctrine::getTable("IdsCliente")->find($idcliente);

        $data = array();
        if ($cliente) {
            $ids = $cliente->getIds();
            $ids_datos = json_decode(utf8_encode($ids->getCaDatos()));
            $data = array("idcliente" => $cliente->getCaIdcliente(),
                "fchcircular" => $cliente->getCaFchcircular(),
                "fchvencircular" => $cliente->getCaFchvencircular(),
                "nvlriesgo" => utf8_encode($cliente->getCaNvlriesgo()),
                "leyinsolvencia" => utf8_encode($cliente->getCaLeyinsolvencia()),
                "comentario" => utf8_encode($cliente->getCaComentario()),
                "listaclinton" => utf8_encode($cliente->getCaListaclinton()),
                "tipo" => utf8_encode($cliente->getCaTipo()),
                "iso" => utf8_encode($cliente->getCaIso()),
                "iso_detalles" => utf8_encode($cliente->getCaIsoDetalles()),
                "basc" => utf8_encode($cliente->getCaBasc()),
                "otro_cert" => utf8_encode($cliente->getCaOtroCert()),
                "otro_detalles" => utf8_encode($cliente->getCaOtroDetalles()),
                "tipopersona" => utf8_encode($cliente->getCaTipopersona()),
                "sectoreconomico" => utf8_encode($cliente->getCaSector()),
                "fechaconstitucion" => utf8_encode($cliente->getCaFchconstitucion()),
                "regimen" => utf8_encode($cliente->getCaRegimen()),
                "uap" => utf8_encode($cliente->getCaUap()),
                "altex" => utf8_encode($cliente->getCaAltex()),
                "oea" => utf8_encode($cliente->getCaOea()),
                "comerciante" => utf8_encode($cliente->getCaComerciante()),
                "forma_pago" => $ids_datos->forma_pago,
                "cod_ciiu_uno" => $cliente->getCaCiiuUno(),
                "cod_ciiu_dos" => $cliente->getCaCiiuDos(),
                "cod_ciiu_trs" => $cliente->getCaCiiuTrs(),
                "cod_ciiu_ctr" => $cliente->getCaCiiuCtr()
            );
            $this->responseArray = array("success" => true, "data" => $data);
            $this->setTemplate("responseTemplate");
        } else {
            $this->responseArray = array("success" => true, "data" => "");
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeDatosControlFinanciero(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $tipopersona = $request->getParameter("tipo");
        $activostotales = $request->getParameter("activostotales");

        $fechconstitucion = $request->getParameter("fechconstitucion");
        $anioactual = date("Y");
        $minimo = Doctrine::getTable('Smlv')->find($anioactual);

        if ($minimo && $tipopersona != "ca_gran_contribuyente_uap") {
            if (($activostotales / $minimo->getCaSmlv()) < 500) {
                $tipopersona = "ca_perjuridica_activos";
            }
        }

        if ($tipopersona == "ca_gran_contribuyente_uap") {
            $tipopersona = "ca_gran_contribuyente";
        }

        if ($tipopersona == "ca_perjuridica" || $tipopersona == "ca_gran_contribuyente" || $tipopersona == "ca_perjuridica_activos") {
            $fechahaceunano = date("Y") - 1 . "-" . date("m") . "-" . date("d");
            if ($fechconstitucion) {
                if ($fechahaceunano < $fechconstitucion) {
                    $tipopersona = "ca_perjuridica_reciente";
                }
            }
        }

        //echo "tipopersina".$tipopersona;

        $data = array();
//        if ($tipopersona) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select distinct tpd.ca_idtipo as a, tpd.ca_tipo as ca_tipo, tpd.ca_equivalentea, ";
        $sql .= " dc.ca_fchdocumento as ca_fchdocumento, dc.ca_observaciones as ca_observaciones ";
        $sql .= " from tb_doccliente dc ";
        $sql .= " inner join ids.tb_documentosxconc dxc ON (dxc.ca_id = dc.ca_idtipo and dc.ca_idcliente = $idcliente) ";
        $sql .= "right join ids.tb_tipodocumentos tpd ON (tpd.ca_idtipo = dxc.ca_idtipo) ";
        $sql .= " where tpd.ca_equivalentea = 25 ";
        $sql .= "order by tpd.ca_idtipo";

        $rs = $con->execute($sql);
        $control_rs = $rs->fetchAll();
        foreach ($control_rs as $control) {
            $seleccionado = false;
            if ($control["ca_fchdocumento"]) {
                $seleccionado = true;
            }
            $data[] = array(
                "idtipo" => $control["a"],
                "iddocumento" => /* $control["ca_iddocumento"] */"",
                "empresa" => /* $control["ca_nombre"] */"",
                "documento" => utf8_encode($control["ca_tipo"]),
                "fch_vigencia" => /* $control["ca_fchvigencia"] */"",
                "fch_documento" => $control["ca_fchdocumento"],
                "seleccionado" => $seleccionado,
                "observaciones" => utf8_encode($control["ca_observaciones"])
            );
        }
//        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeActualizarControlFinanciero(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datosGrid = $request->getParameter("datosGrid");
        $datosGrid = json_decode($datosGrid);
        $datosGridFinanciera = $request->getParameter("datosGridFinanciera");
        $datosGridFinanciera = json_decode($datosGridFinanciera);
        $datos = json_decode($datos);
        $nuevo = false;
        $ids = array();

        $con = Doctrine_Manager::getInstance()->connection();

        $idcliente = $datos->idcliente;
        $conn = Doctrine::getTable("IdsCliente")->getConnection();
        $cliente = Doctrine::getTable('IdsCliente')->find($idcliente);

        if ($cliente) {
            $conn->beginTransaction();
            try {
                foreach ($datosGrid as $datoGrid) {
                    $documentosxConc = Doctrine::getTable("Documentosxconc")
                            ->createQuery("d")
                            ->addWhere("d.ca_idtipo = ?", $datoGrid->idtipo)
                            ->execute();
                    foreach ($documentosxConc as $documentoxConc) {
                        $doccliente = Doctrine::getTable("Doccliente")
                                ->createQuery("d")
                                ->addWhere("d.ca_idtipo = ?", $documentoxConc->getCaId())
                                ->addWhere("d.ca_idcliente = ?", $idcliente)
                                ->fetchOne();
                        if (!$doccliente) {
                            $doccliente = new Doccliente();
                            $doccliente->setCaIdcliente($idcliente);
                            $doccliente->setCaIdtipo($documentoxConc->getCaId());
                        }
                        if ($datoGrid->fch_documento) {
                            $doccliente->setCaFchdocumento($datoGrid->fch_documento);
                        }
                        if ($datoGrid->observaciones) {
                            $doccliente->setCaObservaciones(utf8_decode($datoGrid->observaciones));
                        }
                        $doccliente->save();
                        $ids[] = $datoGrid->id;
                        $borrado[] = $documentoxConc->getCaId();
                    }
                }

                if (!empty($borrado)) {
                    $sql = "delete from tb_doccliente where ca_idcliente = $idcliente and ca_idtipo not in (" . implode(",", $borrado) . ")";
                    $rs = $con->execute($sql);
                }

                if ($datos->fchcircular) {
                    $cliente->setCaFchcircular($datos->fchcircular);
                }
                if ($datos->fchvencircular) {
                    $cliente->setCaFchvencircular($datos->fchvencircular);
                } else {
                    $cliente->setCaFchvencircular(null);
                }
                if ($datos->nvlriesgo) {
                    $cliente->setCaNvlriesgo(utf8_decode($datos->nvlriesgo));
                }
                if ($datos->leyinsolvencia) {
                    $cliente->setCaLeyinsolvencia(utf8_decode($datos->leyinsolvencia));
                }
                if ($datos->comentario) {
                    $cliente->setCaComentario(utf8_decode($datos->comentario));
                }
                if ($datos->lista_clinton) {
                    $cliente->setCaListaclinton(utf8_decode($datos->lista_clinton));
                }
                if ($datos->iso) {
                    $cliente->setCaIso(utf8_decode($datos->iso));
                }
                if ($datos->iso_detalles) {
                    $cliente->setCaIsoDetalles(utf8_decode($datos->iso_detalles));
                }
                if ($datos->basc) {
                    $cliente->setCaBasc(utf8_decode($datos->basc));
                }
                if ($datos->otro_cert) {
                    $cliente->setCaOtroCert(utf8_decode($datos->otro_cert));
                }
                if ($datos->otro_detalles) {
                    $cliente->setCaOtroDetalles(utf8_decode($datos->otro_detalles));
                }
                if ($datos->tipopersona) {
                    $cliente->setCaTipopersona(utf8_decode($datos->tipopersona));
                }
                if ($datos->sectoreconomico) {
                    $cliente->setCaSector(utf8_decode($datos->sectoreconomico));
                }
                if ($datos->fechaconstitucion) {
                    $cliente->setCaFchconstitucion(utf8_decode($datos->fechaconstitucion));
                }
                if ($datos->regimen) {
                    $cliente->setCaRegimen($datos->regimen);
                }
                if (isset($datos->tipo)) {
                    if ($datos->tipo)
                        $cliente->setCaTipo(utf8_decode($datos->tipo));
                    else
                        $cliente->setCaTipo(null);
                }
                if (isset($datos->uap)) {
                    if ($datos->uap)
                        $cliente->setCaUap($datos->uap);
                    else
                        $cliente->setCaUap(false);
                }
                if (isset($datos->altex)) {
                    if ($datos->altex)
                        $cliente->setCaAltex($datos->altex);
                    else
                        $cliente->setCaAltex(false);
                }
                if (isset($datos->oea)) {
                    if ($datos->oea)
                        $cliente->setCaOea($datos->oea);
                    else
                        $cliente->setCaOea(false);
                }
                if (isset($datos->comerciante)) {
                    if ($datos->comerciante)
                        $cliente->setCaComerciante($datos->comerciante);
                    else
                        $cliente->setCaComerciante(false);
                }
                if ($datos->cod_ciiu_uno) {
                    $cliente->setCaCiiuUno($datos->cod_ciiu_uno);
                } else {
                    $cliente->setCaCiiuUno(null);
                }
                if ($datos->cod_ciiu_dos) {
                    $cliente->setCaCiiuDos($datos->cod_ciiu_dos);
                } else {
                    $cliente->setCaCiiuDos(null);
                }
                if ($datos->cod_ciiu_trs) {
                    $cliente->setCaCiiuTrs($datos->cod_ciiu_trs);
                } else {
                    $cliente->setCaCiiuTrs(null);
                }
                if ($datos->cod_ciiu_ctr) {
                    $cliente->setCaCiiuCtr($datos->cod_ciiu_ctr);
                } else {
                    $cliente->setCaCiiuCtr(null);
                }
                if ($datos->numempleados) {
                    $cliente->setCaMenosxempleados($datos->numempleados);
                }
                $cliente->setCaFchfinanciero(date("Y-m-d H:i:s"));
                $cliente->setCaUsufinanciero($this->getUser()->getUserId());

                $cliente->save();
                
                if ($datos->forma_pago) {
                    $ids = $cliente->getIds();
                    $ids_datos = json_decode($ids->getCaDatos());
                    $ids_datos->forma_pago = $datos->forma_pago;
                    $ids_datos = json_encode($ids_datos);
                    $ids->setCaDatos($ids_datos);
                    $ids->save();
                }
                $conn->commit();

                $conect = Doctrine::getTable("IdsBalance")->getConnection();
                $conect->beginTransaction();

                foreach ($datosGridFinanciera as $datoGridFinanciera) {
                    $idsbalance = Doctrine::getTable("IdsBalance")
                            ->createQuery("d")
                            ->where("d.ca_idcliente = ?", $idcliente)
                            ->addWhere("d.ca_anno = ?", $datoGridFinanciera->ca_anno)
                            ->fetchOne();

                    if ($idsbalance) {
                        if ($datoGridFinanciera->ca_activostotales) {
                            $idsbalance->setCaActivostotales($datoGridFinanciera->ca_activostotales);
                        }
                        if ($datoGridFinanciera->ca_activoscorrientes) {
                            $idsbalance->setCaActivoscorrientes($datoGridFinanciera->ca_activoscorrientes);
                        }
                        if ($datoGridFinanciera->ca_pasivostotales) {
                            $idsbalance->setCaPasivostotales($datoGridFinanciera->ca_pasivostotales);
                        }
                        if ($datoGridFinanciera->ca_pasivoscorrientes) {
                            $idsbalance->setCaPasivoscorrientes($datoGridFinanciera->ca_pasivoscorrientes);
                        }
                        if ($datoGridFinanciera->ca_inventarios) {
                            $idsbalance->setCaInventarios($datoGridFinanciera->ca_inventarios);
                        }
                        if ($datoGridFinanciera->ca_patrimonios) {
                            $idsbalance->setCaPatrimonios($datoGridFinanciera->ca_patrimonios);
                        }
                        if ($datoGridFinanciera->ca_utilidades) {
                            $idsbalance->setCaUtilidades($datoGridFinanciera->ca_utilidades);
                        }
                        if ($datoGridFinanciera->ca_ventas) {
                            $idsbalance->setCaVentas($datoGridFinanciera->ca_ventas);
                        }
                        $idsbalance->save();
                    }
                }
                $conect->commit();
                $this->responseArray = array("success" => true, "ids" => $ids);
            } catch (Exception $e) {
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executePermisosDuenoCuenta(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $cliente = Doctrine::getTable("IdsCliente")->find($idcliente);

        // Permisos propios del Representante de Ventas Dueño de la Cuenta
        $permisosDueno = array(1, 2, 3, 4, 6, 7, 9, 10, 11, 13, 14, 16, 17, 18);
        if ($cliente->getCaVendedor() == $this->getUser()->getUserId() or ( $cliente->getCaVendedor() == '' and UsuarioTable::getUsuariosxPerfilxUsuario('comercial', $this->getUser()->getUserId()))) {
            $user = $this->getUser();
            $permisosRutinas = $user->getControlAcceso(self::RUTINA_CRM);
            $tipopermisos = $user->getAccesoTotalRutina(self::RUTINA_CRM);

            $permisos = array();
            foreach ($tipopermisos as $index => $tp) {
                if (in_array($tp, $permisosRutinas) or in_array($index, $permisosDueno)) {
                    $permisos[$index] = true;
                } else {
                    $permisos[$index] = false;
                }
            }
        }

        $this->responseArray = array("success" => true, "permisos" => $permisos);
        $this->setTemplate("responseTemplate");
    }

    public function executeIntegracionContactos(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $con = Doctrine_Manager::getInstance()->connection();

//        // Ejecutar una sola vez!
//        $sql = "update ids.tb_contactos set ca_fax = ca_telefonos where ca_telefonos = 'Extrabajador' and ca_fax is null; "
//                . "update ids.tb_contactos set ca_fax = ca_telefonos where ca_telefonos = 'Extrabajador' and ca_fax != 'Extrabajador';"
//                . "update public.tb_concliente set ca_fax = ca_telefonos where ca_telefonos = 'Extrabajador' and ca_fax != 'Extrabajador';";
//        $q = Doctrine_Manager::getInstance()->connection();
//        $q->execute($sql);

        date_default_timezone_set('America/Bogota');
        set_time_limit(0);

        if ($idcliente) {
            $sql = "select ca_idcliente from public.tb_clientes where ca_idcliente = " . $idcliente;
        } else {
            $sql = "select ca_idcliente from public.vi_clientes where ca_coltrans_std = 'Activo' or ca_colmas_std = 'Activo' or ca_colotm_std = 'Activo' or ca_coldepositos_std = 'Activo' limit 500";
        }
        // die($sql);
        $st = $con->execute($sql);
        $ids = $st->fetchAll();
        $ids = array_column($ids, 'ca_idcliente');

        $q = Doctrine::getTable("IdsCliente")
                ->createQuery("c")
                ->whereIn("c.ca_idcliente", $ids);
        $x = 1;
        $comparativo = array();
        $clientes = $q->execute();

        foreach ($clientes as $cliente) {
            $fch_update = array();
            $fch_update[] = $cliente->getCaFchcreado();
            $fch_update[] = $cliente->getCaFchactualizado();

            $ids_contactos = Doctrine::getTable("IdsContacto")
                    ->createQuery("c")
                    ->select("c.ca_idcontacto, i.ca_id as ca_idcliente, c.ca_idsucursal, c.ca_papellido, c.ca_sapellido, c.ca_nombres, c.ca_saludo, c.ca_cargo, c.ca_departamento, c.ca_telefonos, c.ca_fax, c.ca_email, ca_fijo, c.ca_observaciones, c.ca_usucreado, c.ca_fchcreado, c.ca_usuactualizado, c.ca_fchactualizado, c.ca_usueliminado, c.ca_fcheliminado, c.ca_cumpleanos, c.ca_fijo, c.ca_tipo, c.ca_propiedades")
                    ->innerJoin("c.IdsSucursal s")
                    ->innerJoin("s.Ids i")
                    ->addWhere("i.ca_id = ?", $cliente->getCaIdcliente())
                    ->orderBy("c.ca_nombres, c.ca_papellido, c.ca_sapellido")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();

            $contactos = Doctrine::getTable("Contacto")
                    ->createQuery("c")
                    ->select("c.ca_idcontacto, c.ca_idcliente, c.ca_papellido, c.ca_sapellido, c.ca_nombres, c.ca_saludo, c.ca_cargo, c.ca_departamento, c.ca_telefonos, c.ca_fax, c.ca_email, ca_fijo, c.ca_observaciones, c.ca_usucreado, c.ca_fchcreado, c.ca_usuactualizado, c.ca_fchactualizado, c.ca_cumpleanos, c.ca_fijo, c.ca_tipo, c.ca_propiedades, c.ca_idscontacto")
                    ->addWhere("c.ca_idcliente = ?", $cliente->getCaIdcliente())
                    ->orderBy("c.ca_nombres, c.ca_papellido, c.ca_sapellido")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();

            $paralelo = $idcontacto_ok = array();
            foreach ($ids_contactos as $idscontacto) {
                $contacto_ids = array(
                    "idcontacto" => $idscontacto["c_ca_idcontacto"],
                    "idcliente" => $idscontacto["i_ca_idcliente"],
                    "papellido" => $idscontacto["c_ca_papellido"],
                    "sapellido" => $idscontacto["c_ca_sapellido"],
                    "nombres" => $idscontacto["c_ca_nombres"],
                    "saludo" => $idscontacto["c_ca_saludo"],
                    "cargo" => $idscontacto["c_ca_cargo"],
                    "departamento" => $idscontacto["c_ca_departamento"],
                    "telefonos" => $idscontacto["c_ca_telefonos"],
                    "fax" => $idscontacto["c_ca_fax"],
                    "email" => $idscontacto["c_ca_email"],
                    "fijo" => $idscontacto["c_ca_fijo"],
                    "cumpleanos" => $idscontacto["c_ca_cumpleanos"],
                    "observaciones" => $idscontacto["c_ca_observaciones"],
                    "usucreado" => $idscontacto["c_ca_usucreado"],
                    "fchcreado" => $idscontacto["c_ca_fchcreado"],
                    "usuactualizado" => $idscontacto["c_ca_usuactualizado"],
                    "fchactualizado" => $idscontacto["c_ca_fchactualizado"],
                    "usueliminado" => $idscontacto["c_ca_usueliminado"],
                    "fcheliminado" => $idscontacto["c_ca_fcheliminado"],
                    "propiedades" => $idscontacto["c_ca_propiedades"],
                    "tipo" => $idscontacto["c_ca_tipo"],
                    "idscontacto" => $idscontacto["c_ca_idcontacto"]
                );
                $contacto_old = array();
                foreach ($contactos as $contacto) {
                    if (trim($idscontacto["c_ca_nombres"]) == trim($contacto["c_ca_nombres"]) && trim($idscontacto["c_ca_papellido"]) == trim($contacto["c_ca_papellido"]) && trim($idscontacto["c_ca_sapellido"]) == trim($contacto["c_ca_sapellido"])) {
                        $idcontacto_ok[] = $contacto["c_ca_idcontacto"];
                        $contacto_old = array(
                            "idcontacto" => $contacto["c_ca_idcontacto"],
                            "idcliente" => $contacto["c_ca_idcliente"],
                            "papellido" => $contacto["c_ca_papellido"],
                            "sapellido" => $contacto["c_ca_sapellido"],
                            "nombres" => $contacto["c_ca_nombres"],
                            "saludo" => $contacto["c_ca_saludo"],
                            "cargo" => $contacto["c_ca_cargo"],
                            "departamento" => $contacto["c_ca_departamento"],
                            "telefonos" => $contacto["c_ca_telefonos"],
                            "fax" => $contacto["c_ca_fax"],
                            "email" => $contacto["c_ca_email"],
                            "fijo" => $contacto["c_ca_fijo"],
                            "cumpleanos" => $contacto["c_ca_cumpleanos"],
                            "observaciones" => $contacto["c_ca_observaciones"],
                            "usucreado" => $contacto["c_ca_usucreado"],
                            "fchcreado" => $contacto["c_ca_fchcreado"],
                            "usuactualizado" => $contacto["c_ca_usuactualizado"],
                            "fchactualizado" => $contacto["c_ca_fchactualizado"],
                            "usueliminado" => null,
                            "fcheliminado" => null,
                            "propiedades" => $contacto["c_ca_propiedades"],
                            "tipo" => $contacto["c_ca_tipo"],
                            "idscontacto" => $contacto["c_ca_idscontacto"]
                        );
                        break;
                    }
                }
                $paralelo[] = array(
                    "contacto_ids" => $contacto_ids,
                    "contacto_old" => $contacto_old
                );
            }
            foreach ($contactos as $contacto) {
                if (!in_array($contacto["c_ca_idcontacto"], $idcontacto_ok)) {
                    $contacto_old = array(
                        "idcontacto" => $contacto["c_ca_idcontacto"],
                        "idcliente" => $contacto["c_ca_idcliente"],
                        "papellido" => $contacto["c_ca_papellido"],
                        "sapellido" => $contacto["c_ca_sapellido"],
                        "nombres" => $contacto["c_ca_nombres"],
                        "saludo" => $contacto["c_ca_saludo"],
                        "cargo" => $contacto["c_ca_cargo"],
                        "departamento" => $contacto["c_ca_departamento"],
                        "telefonos" => $contacto["c_ca_telefonos"],
                        "fax" => $contacto["c_ca_fax"],
                        "email" => $contacto["c_ca_email"],
                        "fijo" => $contacto["c_ca_fijo"],
                        "cumpleanos" => $contacto["c_ca_cumpleanos"],
                        "observaciones" => $contacto["c_ca_observaciones"],
                        "usucreado" => $contacto["c_ca_usucreado"],
                        "fchcreado" => $contacto["c_ca_fchcreado"],
                        "usuactualizado" => $contacto["c_ca_usuactualizado"],
                        "fchactualizado" => $contacto["c_ca_fchactualizado"],
                        "usueliminado" => null,
                        "fcheliminado" => null,
                        "propiedades" => $contacto["c_ca_propiedades"],
                        "tipo" => $contacto["c_ca_tipo"],
                        "idscontacto" => $contacto["c_ca_idscontacto"]
                    );
                    $paralelo[] = array(
                        "contacto_ids" => array(),
                        "contacto_old" => $contacto_old
                    );
                }
            }
            $comparativo[] = array(
                "idcliente" => $cliente->getCaIdcliente(),
                "idalterno" => $cliente->getIds()->getCaIdalterno(),
                "nombre" => $cliente->getIds()->getCaNombre(),
                "contactos" => $paralelo
            );
        }
        $x = 0;
        echo "<body style=\"font-family: Arial, Helvetica, sans-serif;\">";
        echo "<table border=1>";
        foreach ($comparativo as $cliente) {
            echo "<tr>";
            echo "  <td> " . $x++ . " </td>";
            echo "  <td> " . $cliente["idcliente"] . " </td>";
            echo "  <td> " . $cliente["idalterno"] . " </td>";
            echo "  <td> " . $cliente["nombre"] . "</td>";
            echo "  <td></td>";
            echo "</tr>";
            $y = 1;
            $contactos = $cliente["contactos"];
            foreach ($contactos as $contacto) {
                $linea = "";
                $linea .= "<tr>";
                $linea .= "  <td style=\"vertical-align: text-top;\"> " . $y++ . " </td>";
                $linea .= "  <td></td>";
                $linea .= "  <td></td>";
                $linea .= "  <td>"
                        . "<table border=1 width=100%>";
                $linea .= "  <td>"
                        . "         <table border=1 width=750px>";
                $diferencias = array();
                $color = array("Ok", "#008000"); // Color Verde
                foreach ($contacto["contacto_ids"] as $key => $value) {
                    if (!in_array($key, array("idcontacto")) && $contacto["contacto_ids"][$key] != $contacto["contacto_old"][$key]) {
                        $color = array("Diferencia", "#FFFF00"); // Color Amarillo
                        $diferencias[] = $key;
                    }
                    $linea .= "<tr>";
                    $linea .= "  <td> " . $key . " </td>";
                    $linea .= "  <td> " . $value . " </td>";
                    $linea .= "</tr>";
                }
                if (count($contacto["contacto_ids"]) == 0 || count($contacto["contacto_old"]) == 0) {
                    $color = array("Error", "#FF0000"); // Color Rojo
                }
                $linea .= "      </table>";
                $linea .= "  </td>";

                $linea .= "  <td>"
                        . "         <table border=1 width=750px>";
                foreach ($contacto["contacto_old"] as $key => $value) {
                    $style = "";
                    if (!in_array($key, array("idcontacto")) && $contacto["contacto_ids"][$key] != $contacto["contacto_old"][$key]) {
                        $style = "style=\"background-color:" . $color[1] . ";\"";
                    }
                    $linea .= "<tr>";
                    $linea .= "  <td " . $style . "> " . $key . " </td>";
                    $linea .= "  <td " . $style . "> " . $value . " </td>";
                    $linea .= "</tr>";
                }
                $linea .= "      </table>";
                $linea .= "  </td>"
                        . "</table></td>";
                $linea .= "  <td style=\"background-color:" . $color[1] . ";\">" . $color[0] . "<br /><br />"
                        . "      <a href=\"/crm/pasarContactos/sentido/izquierda/idscontacto/" . $contacto["contacto_ids"]["idcontacto"] . "/cntcontacto/" . $contacto["contacto_old"]["idcontacto"] . "\">Izquierda =></a> <br /><br />"
                        . "      <a href=\"/crm/pasarContactos/sentido/derecha/idscontacto/" . $contacto["contacto_ids"]["idcontacto"] . "/cntcontacto/" . $contacto["contacto_old"]["idcontacto"] . "\">Derecha <=</a> <br /><br />"
                        . "      <a href=\"/crm/quitarContactos/idscontacto/" . ($contacto["contacto_ids"]["idcontacto"] ? $contacto["contacto_ids"]["idcontacto"] : 'null') . "/cntcontacto/" . ($contacto["contacto_old"]["idcontacto"] ? $contacto["contacto_old"]["idcontacto"] : 'null') . "\">Elimina [X]</a> <br /><br />"
                        . " </td>";
                $linea .= "</tr>";

                if (count($diferencias) && !array_diff($diferencias, array("idscontacto"))) {
                    $sql = "update public.tb_concliente set ca_idscontacto = " . $contacto["contacto_ids"]["idcontacto"] . " where ca_idcontacto = " . $contacto["contacto_old"]["idcontacto"];
                    $q = Doctrine_Manager::getInstance()->connection();
                    $q->execute($sql);
                } if (count($diferencias) && !array_diff($diferencias, array("usuactualizado", "fchactualizado"))) {
                    if (trim($contacto["contacto_ids"]["usuactualizado"]) == "" && trim($contacto["contacto_old"]["usuactualizado"]) != "") {
                        $sql = "update ids.tb_contactos set ca_usuactualizado = '" . $contacto["contacto_old"]["usuactualizado"] . "', "
                                . " ca_fchactualizado = '" . $contacto["contacto_old"]["fchactualizado"] . "'"
                                . " where ca_idcontacto = " . $contacto["contacto_ids"]["idcontacto"];
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);
                    } else if (trim($contacto["contacto_old"]["usuactualizado"]) == "" && trim($contacto["contacto_ids"]["usuactualizado"]) != "") {
                        $sql = "update public.tb_concliente set ca_usuactualizado = '" . $contacto["contacto_ids"]["usuactualizado"] . "', "
                                . " ca_fchactualizado = '" . $contacto["contacto_ids"]["fchactualizado"] . "'"
                                . " where ca_idcontacto = " . $contacto["contacto_old"]["idcontacto"];
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);
                    }
                } if (count($diferencias) && !array_diff($diferencias, array("usuactualizado", "fchactualizado", "idscontacto"))) {
                    if (trim($contacto["contacto_ids"]["usuactualizado"]) == "" && trim($contacto["contacto_old"]["usuactualizado"]) != "") {
                        $sql = "update ids.tb_contactos set ca_usuactualizado = '" . $contacto["contacto_old"]["usuactualizado"] . "', "
                                . " ca_fchactualizado = '" . $contacto["contacto_old"]["fchactualizado"] . "'"
                                . " where ca_idcontacto = " . $contacto["contacto_ids"]["idcontacto"];
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);

                        $sql = "update public.tb_concliente set ca_idscontacto = " . $contacto["contacto_ids"]["idcontacto"] . " where ca_idcontacto = " . $contacto["contacto_old"]["idcontacto"];
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);
                    } else if (trim($contacto["contacto_old"]["usuactualizado"]) == "" && trim($contacto["contacto_ids"]["usuactualizado"]) != "") {
                        $sql = "update public.tb_concliente set ca_usuactualizado = '" . $contacto["contacto_ids"]["usuactualizado"] . "', "
                                . " ca_fchactualizado = '" . $contacto["contacto_ids"]["fchactualizado"] . "', "
                                . " ca_idscontacto = " . $contacto["contacto_ids"]["idcontacto"]
                                . " where ca_idcontacto = " . $contacto["contacto_old"]["idcontacto"];
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);
                    }
                } else {
                    // if ($color[0] != "Ok") {
                        echo $linea;
                    // }
                }
            }
        }
        echo "</table>";
        exit;
    }

    public function executePasarContactos(sfWebRequest $request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $sentido = $request->getParameter("sentido");
        if ($request->getParameter("idscontacto") and $request->getParameter("idscontacto") != 'null')
            $idscontacto = Doctrine::getTable("IdsContacto")->find($request->getParameter("idscontacto"));
        if ($request->getParameter("cntcontacto") and $request->getParameter("cntcontacto") != 'null')
            $cntcontacto = Doctrine::getTable("Contacto")->find($request->getParameter("cntcontacto"));

        if ($idscontacto || $cntcontacto) {
            if ($sentido == "izquierda") {
                if (!$cntcontacto) {
                    $sql = "SELECT NEXTVAL('tb_concliente_id') as next";
                    $stmt = $con->execute($sql);
                    $row = $stmt->fetch();

                    $cntcontacto = new Contacto();
                    $cntcontacto->setCaIdcontacto($row['next']);
                    $cntcontacto->setCaIdcliente($idscontacto->getIdsSucursal()->getCaId());
                }
                $cntcontacto->stopBlaming();
                $cntcontacto->setCaPapellido($idscontacto->getCaPapellido());
                if (!$idscontacto->getCaSapellido()) {
                    $cntcontacto->setCaSapellido('');
                } else {
                    $cntcontacto->setCaSapellido($idscontacto->getCaSapellido());
                }

                $cntcontacto->setCaNombres($idscontacto->getCaNombres());
                $cntcontacto->setCaSaludo($idscontacto->getCaSaludo());
                $cntcontacto->setCaCargo($idscontacto->getCaCargo());
                $cntcontacto->setCaDepartamento($idscontacto->getCaDepartamento());
                $cntcontacto->setCaTelefonos($idscontacto->getCaTelefonos());
                if (!$idscontacto->getCaFax()) {
                    $cntcontacto->setCaFax('');
                } else {
                    $cntcontacto->setCaFax($idscontacto->getCaFax());
                }
                $cntcontacto->setCaEmail($idscontacto->getCaEmail());
                if ($idscontacto->getCaCumpleanos()) {
                    $cntcontacto->setCaCumpleanos($idscontacto->getCaCumpleanos());
                }
                $cntcontacto->setCaObservaciones($idscontacto->getCaObservaciones());
                $cntcontacto->setCaFijo($idscontacto->getCaFijo());
                $cntcontacto->setCaFchcreado($idscontacto->getCaFchcreado());
                $cntcontacto->setCaUsucreado($idscontacto->getCaUsucreado());
                $cntcontacto->setCaFchactualizado($idscontacto->getCaFchactualizado());
                $cntcontacto->setCaUsuactualizado($idscontacto->getCaUsuactualizado());
                $cntcontacto->setCaTipo($idscontacto->getCaTipo());
                $cntcontacto->setCaPropiedades($idscontacto->getCaPropiedades());
                $cntcontacto->setCaIdscontacto($idscontacto->getCaIdcontacto());
                $cntcontacto->save();
            } else if ($sentido == "derecha") {
                if (!$idscontacto) {
                    $sql = "SELECT NEXTVAL('ids.tb_contactos_id') as next";
                    $stmt = $con->execute($sql);
                    $row = $stmt->fetch();

                    $idscontacto = new IdsContacto();
                    $idscontacto->setCaIdcontacto($row['next']);
                    $idscontacto->setCaIdsucursal($cntcontacto->getIdsCliente()->getIds()->getSucursalPrincipal()->getCaIdsucursal());
                }
                $idscontacto->stopBlaming();
                $idscontacto->setCaPapellido($cntcontacto->getCaPapellido());
                $idscontacto->setCaSapellido($cntcontacto->getCaSapellido());
                $idscontacto->setCaNombres($cntcontacto->getCaNombres());
                $idscontacto->setCaSaludo($cntcontacto->getCaSaludo());
                $idscontacto->setCaCargo($cntcontacto->getCaCargo());
                if (!$idscontacto->getCaCargoGeneral()) {
                    $idscontacto->setCaCargoGeneral($cntcontacto->getCaCargo());
                }
                $idscontacto->setCaDepartamento($cntcontacto->getCaDepartamento());
                $idscontacto->setCaTelefonos($cntcontacto->getCaTelefonos());
                $idscontacto->setCaFax($cntcontacto->getCaFax());
                $idscontacto->setCaEmail($cntcontacto->getCaEmail());
                if ($cntcontacto->getCaCumpleanos()) {
                    $idscontacto->setCaCumpleanos($cntcontacto->getCaCumpleanos());
                }
                $idscontacto->setCaObservaciones($cntcontacto->getCaObservaciones());
                $idscontacto->setCaFijo($cntcontacto->getCaFijo());
                $idscontacto->setCaFchcreado($cntcontacto->getCaFchcreado());
                $idscontacto->setCaUsucreado($cntcontacto->getCaUsucreado());
                $idscontacto->setCaFchactualizado($cntcontacto->getCaFchactualizado());
                $idscontacto->setCaUsuactualizado($cntcontacto->getCaUsuactualizado());
                $idscontacto->setCaTipo($cntcontacto->getCaTipo());
                $idscontacto->setCaPropiedades($cntcontacto->getCaPropiedades());
                $idscontacto->save();
                if (!$cntcontacto->getCaIdscontacto()) {
                    $cntcontacto->stopBlaming();
                    $cntcontacto->setCaIdscontacto($idscontacto->getCaIdcontacto());
                    $cntcontacto->save();
                }
            }
        }

        exit;
    }

    public function executeQuitarContactos(sfWebRequest $request) {
        $con = Doctrine_Manager::getInstance()->connection();

        if ($request->getParameter("idscontacto") != 'null')
            $idscontacto = Doctrine::getTable("IdsContacto")->find($request->getParameter("idscontacto"));
        if ($request->getParameter("cntcontacto") != 'null')
            $cntcontacto = Doctrine::getTable("Contacto")->find($request->getParameter("cntcontacto"));

        if ($idscontacto || !$cntcontacto) {
            $idscontacto->delete();
        } else if (!$idscontacto || $cntcontacto) {
            $cntcontacto->delete();
        }
        exit;
    }

    public function executeValidacionContactos(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $con = Doctrine_Manager::getInstance()->connection();
        date_default_timezone_set('America/Bogota');


        if ($idcliente) {
            $sql = "select ca_idcliente from public.tb_clientes where ca_idcliente = " . $idcliente;
        } else {
            $sql = "select ca_idcliente from public.vi_clientes_std where ca_coltrans_std = 'Activo' or ca_colmas_std = 'Activo' or ca_colotm_std = 'Activo' or ca_coldepositos_std = 'Activo'";
        }
        // die($sql);
        $st = $con->execute($sql);
        $ids = $st->fetchAll();
        $ids = array_column($ids, 'ca_idcliente');

        $q = Doctrine::getTable("IdsCliente")
                ->createQuery("c")
                ->whereIn("c.ca_idcliente", $ids);
        $x = 1;
        $resumen = array();
        $clientes = $q->execute();
        echo "<table border=1>";
        foreach ($clientes as $cliente) {
            $fch_update = array();
            $fch_update[] = $cliente->getCaFchcreado();
            $fch_update[] = $cliente->getCaFchactualizado();

            $contactos = Doctrine::getTable("Contacto")
                    ->createQuery("c")
                    ->select("c.ca_idcontacto, c.ca_idcliente, c.ca_papellido, c.ca_sapellido, c.ca_nombres, c.ca_saludo, c.ca_cargo, c.ca_departamento, c.ca_telefonos, c.ca_fax, c.ca_email, c.ca_observaciones, c.ca_usucreado, c.ca_fchcreado, c.ca_usuactualizado, c.ca_fchactualizado, c.ca_cumpleanos, c.ca_fijo, c.ca_propiedades, c.ca_idscontacto")
                    ->addWhere("c.ca_idcliente = ?", $cliente->getCaIdcliente())
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();

            $suc = array();
            $sucursales = $cliente->getIds()->getIdsSucursal();
            foreach ($sucursales as $sucursal) {
                $suc[] = $sucursal->getCaIdsucursal();
                $fch_update[] = $sucursal->getCaFchcreado();
                $fch_update[] = $sucursal->getCaFchactualizado();
            }

            /*
              $sql = "select ca_idsucursal from ids.tb_sucursales where ca_id = " . $cliente->getCaIdcliente();
              $st = $con->execute($sql);
              $suc = $st->fetchAll();
              $suc = array_column($suc, 'ca_idsucursal');
             */
            $ids_contactos = Doctrine::getTable("IdsContacto")
                    ->createQuery("c")
                    ->select("c.ca_idcontacto, c.ca_idsucursal, c.ca_papellido, c.ca_sapellido, c.ca_nombres, c.ca_saludo, c.ca_cargo, c.ca_departamento, c.ca_telefonos, c.ca_fax, c.ca_email, c.ca_observaciones, c.ca_usucreado, c.ca_fchcreado, c.ca_usuactualizado, c.ca_fchactualizado, c.ca_usueliminado, c.ca_fcheliminado, c.ca_cumpleanos, c.ca_fijo, c.ca_propiedades")
                    ->whereIn("c.ca_idsucursal", $suc)
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
            /* INICIA LA COMPRACIÓN */
            $columnas = array("c_ca_nombres", "c_ca_papellido", "c_ca_sapellido", "c_ca_saludo", "c_ca_telefonos", "c_ca_fax", "c_ca_email", "c_ca_cargo", "c_ca_departamento", "c_ca_cumpleanos", "c_ca_observaciones", "c_ca_fijo");
            $auditors = array("c_ca_usucreado", "c_ca_fchcreado", "c_ca_usuactualizado", "c_ca_fchactualizado");
            if (!count($contactos) and count($ids_contactos)) {
                // $columnas[] = "c_ca_idscontacto";
                foreach ($ids_contactos as $j => $ids_cnt) {
                    $sql = "insert into public.tb_concliente(ca_idcliente, ";
                    foreach (array_merge($columnas, $auditors) as $columna) {
                        $sql .= substr($columna, 2) . ", ";
                    }
                    $sql .= "ca_idscontacto, ";
                    $sql = substr($sql, 0, strlen($sql) - 2) . ") values (" . $cliente->getCaIdcliente() . ", ";

                    foreach (array_merge($columnas, $auditors) as $columna) {
                        if ($columna == "c_ca_saludo" && !$ids_cnt[$columna]) {
                            $ids_cnt[$columna] = "Señor";
                        }
                        if ($columna == "c_ca_sapellido" && !$ids_cnt[$columna]) {
                            $ids_cnt[$columna] = ".";
                        }
                        if ($columna == "c_ca_fax" && !$ids_cnt[$columna]) {
                            $ids_cnt[$columna] = "No";
                        }
                        if ($columna == "c_ca_fijo") {
                            if ($ids_cnt[$columna] == "0") {
                                $ids_cnt[$columna] = "false";
                            } else {
                                $ids_cnt[$columna] = "true";
                            }
                        }
                        if ($ids_cnt[$columna]) {
                            $sql .= "'" . $ids_cnt[$columna] . "', ";
                        } else {
                            $sql .= "null, ";
                        }
                    }
                    $sql .= $ids_cnt["c_ca_idcontacto"] . ", ";
                    $sql = substr($sql, 0, strlen($sql) - 2) . ")";
                    // die($sql);
                    $q = Doctrine_Manager::getInstance()->connection();
                    $q->execute($sql);
                }
                continue;
            }
            foreach ($contactos as $i => $contacto) {
                $contactos[$i]["c_ca_color"] = "FFBF00";
                $fch_update[] = $contacto["c_ca_fchcreado"];
                $fch_update[] = $contacto["c_ca_fchactualizado"];
                foreach ($ids_contactos as $j => $ids_cnt) {
                    $diff = false;
                    $fch_update[] = $ids_cnt["c_ca_fchcreado"];
                    $fch_update[] = $ids_cnt["c_ca_fchactualizado"];
                    foreach ($columnas as $columna) {
                        if ($contacto[$columna] != $ids_cnt[$columna]) {
                            $diff = true;
                            break;
                        }
                    }
                    $add_uno = DateTime::createFromFormat('Y-m-d H:i:s', $contacto["c_ca_fchcreado"]);
                    $upd_uno = DateTime::createFromFormat('Y-m-d H:i:s', $contacto["c_ca_fchactualizado"]);
                    $add_dos = DateTime::createFromFormat('Y-m-d H:i:s', $ids_cnt["c_ca_fchcreado"]);
                    $upd_dos = DateTime::createFromFormat('Y-m-d H:i:s', $ids_cnt["c_ca_fchactualizado"]);

                    $rand = dechex(rand(0x666666, 0xFFFFFF));
                    if ($contacto["c_ca_idscontacto"] == $ids_cnt["c_ca_idcontacto"] && (in_array('Extrabajador', $contacto, true) or in_array('Extrabajador', $ids_cnt, true))) {
                        $rand = "33FFF6";
                        $contactos[$i]["c_ca_color"] = $ids_contactos[$j]["c_ca_color"] = $rand;

                        $usu = $fch = null;
                        if ($upd_uno && $upd_uno > $upd_dos) {
                            $usu = $contacto["c_ca_usuactualizado"];
                            $fch = $contacto["c_ca_fchactualizado"];
                        } else if ($upd_dos && $upd_dos > $upd_uno) {
                            $usu = $ids_cnt["c_ca_usuactualizado"];
                            $fch = $ids_cnt["c_ca_fchactualizado"];
                        }

                        if ($usu && $fch) {
                            $ids_contactos[$j]["c_ca_usueliminado"] = $usu;
                            $ids_contactos[$j]["c_ca_fcheliminado"] = $fch;
                            $q = Doctrine_Manager::getInstance()->connection();
                            $sql = "update public.tb_concliente set "
                                    . "ca_cargo = 'Extrabajador',"
                                    . "ca_departamento = 'Extrabajador',"
                                    . "ca_telefonos = 'Extrabajador',"
                                    . "ca_fax = 'Extrabajador',"
                                    . "ca_email = 'Extrabajador', "
                                    . "ca_fijo = false "
                                    . "where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
                            $q->execute($sql);

                            $sql = "update ids.tb_contactos set "
                                    . "ca_telefonos = 'Extrabajador', "
                                    . "ca_fax = 'Extrabajador', "
                                    . "ca_email = 'Extrabajador', "
                                    . "ca_cargo = 'Extrabajador', "
                                    . "ca_departamento = 'Extrabajador',"
                                    . "ca_fijo = false, "
                                    . "ca_usueliminado = '" . $usu . "', "
                                    . "ca_fcheliminado = '" . $fch . "' "
                                    . "where ca_idcontacto = " . $ids_cnt["c_ca_idcontacto"];
                            $q->execute($sql);
                        }
                    }
                    if (!$diff) { /* Si el contacto corresponde exactamente tanto en maestra vieja como en el IDS */
                        $contactos[$i]["c_ca_idscontacto"] = $ids_cnt["c_ca_idcontacto"];
                        $contactos[$i]["c_ca_color"] = $ids_contactos[$j]["c_ca_color"] = $rand;
                        $sql = "update public.tb_concliente set ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"] . " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);
//                        unset($contactos[$i]);
//                        unset($ids_contactos[$j]);
                        break;
                    } else if ($contactos[$i]["c_ca_email"] == $ids_contactos[$j]["c_ca_email"] && $contactos[$i]["c_ca_nombres"] == $ids_contactos[$j]["c_ca_nombres"] && $contactos[$i]["c_ca_papellido"] == $ids_contactos[$j]["c_ca_papellido"]) {
                        if (max(array($add_uno, $upd_uno)) > max(array($add_dos, $upd_dos))) {
                            $sql = "update ids.tb_contactos set ";
                            $contactos[$i]["c_ca_accion"] = "Baja";
                            foreach (array_merge($columnas, $auditors) as $col) {
                                $sql .= substr($col, 2) . " = '" . $contactos[$i][$col] . "', ";
                            }
                            $sql = substr($sql, 0, -2) . " where ca_idcontacto = " . $ids_cnt["c_ca_idcontacto"];
                        } else {
                            $sql = "update public.tb_concliente set ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"] . " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
//                            $q = Doctrine_Manager::getInstance()->connection();
//                            $q->execute($sql);

                            $sql = "update public.tb_concliente set ";
                            $ids_contactos[$j]["c_ca_accion"] = "Sube";
                            foreach (array_merge($columnas, $auditors) as $col) {
                                $sql .= substr($col, 2) . " = '" . $ids_contactos[$j][$col] . "', ";
                            }
                            $sql .= "ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"];
                            $sql .= " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
                        }
                        $sql = str_replace(", ca_fijo = ''", ", ca_fijo = FALSE", $sql);
                        $sql = str_replace(", ca_usucreado = ''", "", $sql);
                        $sql = str_replace(", ca_usuactualizado = ''", "", $sql);
                        $sql = str_replace(", ca_fchactualizado = ''", "", $sql);
//                        $q = Doctrine_Manager::getInstance()->connection();
//                        $q->execute($sql);

                        $contactos[$i]["c_ca_idscontacto"] = $ids_cnt["c_ca_idcontacto"];
                        $contactos[$i]["c_ca_color"] = $ids_contactos[$j]["c_ca_color"] = $rand;
                    } else if ($contactos[$i]["c_ca_nombres"] == $ids_contactos[$j]["c_ca_nombres"] && $contactos[$i]["c_ca_papellido"] == $ids_contactos[$j]["c_ca_papellido"] && $contactos[$i]["c_ca_saludo"] == $ids_contactos[$j]["c_ca_saludo"]) {
                        $add_uno = DateTime::createFromFormat('Y-m-d H:i:s', $contacto["c_ca_fchcreado"]);
                        $upd_uno = DateTime::createFromFormat('Y-m-d H:i:s', $contacto["c_ca_fchactualizado"]);
                        $add_dos = DateTime::createFromFormat('Y-m-d H:i:s', $ids_cnt["c_ca_fchcreado"]);
                        $upd_dos = DateTime::createFromFormat('Y-m-d H:i:s', $ids_cnt["c_ca_fchactualizado"]);

                        if (max(array($add_uno, $upd_uno)) > max(array($add_dos, $upd_dos))) {
                            $sql = "update ids.tb_contactos set ";
                            $contactos[$i]["c_ca_accion"] = "Baja";
                            foreach (array_merge($columnas, $auditors) as $col) {
                                $sql .= substr($col, 2) . " = '" . $contactos[$i][$col] . "', ";
                            }
                            $sql = substr($sql, 0, -2) . " where ca_idcontacto = " . $ids_cnt["c_ca_idcontacto"];
                        } else {
                            $sql = "update public.tb_concliente set ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"] . " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
//                            $q = Doctrine_Manager::getInstance()->connection();
//                            $q->execute($sql);

                            $sql = "update public.tb_concliente set ";
                            $ids_contactos[$j]["c_ca_accion"] = "Sube";
                            foreach (array_merge($columnas, $auditors) as $col) {
                                $sql .= substr($col, 2) . " = '" . $ids_contactos[$j][$col] . "', ";
                            }
                            $sql .= "ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"];
                            $sql .= " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
                        }
                        // echo $sql." <br /> <br />";
                        $sql = str_replace(", ca_fijo = ''", ", ca_fijo = FALSE", $sql);
                        $sql = str_replace(", ca_usucreado = ''", "", $sql);
                        $sql = str_replace(", ca_usuactualizado = ''", "", $sql);
                        $sql = str_replace(", ca_fchactualizado = ''", "", $sql);
//                        $q = Doctrine_Manager::getInstance()->connection();
//                        $q->execute($sql);

                        $contactos[$i]["c_ca_idscontacto"] = $ids_cnt["c_ca_idcontacto"];
                        $contactos[$i]["c_ca_color"] = $ids_contactos[$j]["c_ca_color"] = $rand;
                    } else if ($contactos[$i]["c_ca_telefonos"] == $ids_contactos[$j]["c_ca_telefonos"] && $contactos[$i]["c_ca_email"] == $ids_contactos[$j]["c_ca_email"] && strpos($contactos[$i]["c_ca_email"], '@') !== false) {
                        $add_uno = DateTime::createFromFormat('Y-m-d H:i:s', $contacto["c_ca_fchcreado"]);
                        $upd_uno = DateTime::createFromFormat('Y-m-d H:i:s', $contacto["c_ca_fchactualizado"]);
                        $add_dos = DateTime::createFromFormat('Y-m-d H:i:s', $ids_cnt["c_ca_fchcreado"]);
                        $upd_dos = DateTime::createFromFormat('Y-m-d H:i:s', $ids_cnt["c_ca_fchactualizado"]);

                        if (max(array($add_uno, $upd_uno)) > max(array($add_dos, $upd_dos))) {
                            $sql = "update ids.tb_contactos set ";
                            $contactos[$i]["c_ca_accion"] = "Baja";
                            foreach (array_merge($columnas, $auditors) as $col) {
                                $sql .= substr($col, 2) . " = '" . $contactos[$i][$col] . "', ";
                            }
                            $sql = substr($sql, 0, -2) . " where ca_idcontacto = " . $ids_cnt["c_ca_idcontacto"];
                        } else {
                            $sql = "update public.tb_concliente set ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"] . " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
//                            $q = Doctrine_Manager::getInstance()->connection();
//                            $q->execute($sql);

                            $sql = "update public.tb_concliente set ";
                            $ids_contactos[$j]["c_ca_accion"] = "Sube";
                            foreach (array_merge($columnas, $auditors) as $col) {
                                $sql .= substr($col, 2) . " = '" . $ids_contactos[$j][$col] . "', ";
                            }
                            $sql .= "ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"];
                            $sql .= " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
                        }
                        // echo $sql." <br /> <br />";
                        // $sql = "update public.tb_concliente set ca_idscontacto = " . $ids_cnt["c_ca_idcontacto"] . " where ca_idcontacto = " . $contacto["c_ca_idcontacto"] ;
                        $sql = str_replace(", ca_fijo = ''", ", ca_fijo = FALSE", $sql);
                        $sql = str_replace(", ca_usucreado = ''", "", $sql);
                        $sql = str_replace(", ca_usuactualizado = ''", "", $sql);
                        $sql = str_replace(", ca_fchactualizado = ''", "", $sql);
//                        $q = Doctrine_Manager::getInstance()->connection();
//                        $q->execute($sql);

                        $contactos[$i]["c_ca_idscontacto"] = $ids_cnt["c_ca_idcontacto"];
                        $contactos[$i]["c_ca_color"] = $ids_contactos[$j]["c_ca_color"] = $rand;
                    }
                    if (!$ids_contactos[$j]["c_ca_color"]) {
                        $ids_contactos[$j]["c_ca_color"] = "A5DF00";
                    }
                }
            }
            if (count($contactos) != 0 && count($suc) != 0 && count($ids_contactos) == 0) { /* Si el cliente no tiene contactos en el IDS */
                foreach ($contactos as $i => $contacto) {
                    if (!$contactos[$i]["c_ca_idscontacto"]) {
                        $sql = "select nextval('ids.tb_contactos_id') as ca_idcontacto";
                        $q = Doctrine_Manager::getInstance()->connection();
                        $st = $q->execute($sql);
                        $seq = $st->fetchAll();
                        $seq = array_column($seq, 'ca_idcontacto');

                        $sql = "insert into ids.tb_contactos (ca_idcontacto, ca_idsucursal, ";
                        foreach (array_merge($columnas, $auditors) as $col) {
                            $sql .= substr($col, 2) . ", ";
                        }
                        $sql = substr($sql, 0, -2) . ") values (" . $seq[0] . ", " . $suc[0] . ", ";

                        foreach (array_merge($columnas, $auditors) as $col) {
                            if ($col == "c_ca_fijo") {
                                if ($contactos[$i][$col]) {
                                    $sql .= "true, ";
                                } else {
                                    $sql .= "false, ";
                                }
                            } else {
                                $sql .= "'" . $contactos[$i][$col] . "', ";
                            }
                        }
                        $sql = substr($sql, 0, -2) . ")";
                        $sql = str_replace("''", "null", $sql);

                        // die($sql);
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);

                        $sql = "update public.tb_concliente set ca_idscontacto = " . $seq[0] . " where ca_idcontacto = " . $contacto["c_ca_idcontacto"];
                        $q = Doctrine_Manager::getInstance()->connection();
                        $q->execute($sql);
                    }
                }
                continue;
            }

            $today = $date = new DateTime(date('Y-m-d H:i:s'));
            $lastDate = DateTime::createFromFormat('Y-m-d H:i:s', max($fch_update));
            $intervalo = $today->diff($lastDate);
            $resumen[(($intervalo->y * 12) + $intervalo->m)] += 1;
            if (!$contactos && !$ids_contactos) {
                continue;
            }

//            if ($cliente->getCaIdcliente() == 1394) {
//                print_r($contactos);
//                print_r($ids_contactos);
//                die();
//            }

            echo "<tr>";
            echo "  <td> " . $x++ . " </td>";
            echo "  <td> " . $cliente->getCaIdcliente() . " </td>";
            echo "  <td> " . $cliente->getIds()->getCaIdalterno() . " </td>";
            echo "  <td> " . $cliente->getIds()->getCaNombre() . "</td>";
            echo "  <td> " . $lastDate->format("Y-m-d H:i:s") . "  </td>";
            echo "</tr>";
            echo "<tr>";
            echo "  <td> &nbsp; </td>";
            echo "  <td colspan=4 width=600> ";
            echo "   <table border=1 width='100%'>";
            $i = 1;
            if ($contactos) {
                foreach ($contactos as $contacto) {
                    echo "<tr>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $i++ . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_idcontacto"] . " </td>";
                    foreach ($columnas as $columna) {
                        echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto[$columna] . " </td>";
                    }
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_usucreado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_fchcreado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_usuactualizado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_fchactualizado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> &nbsp; </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> &nbsp; </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_idscontacto"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_accion"] . " </td>";
                    echo "</tr>";
                }
            }
            echo "<tr>";
            echo "  <td bgcolor='#FF0000' colspan=23></td>";
            echo "</tr>";
            $j = 1;
            if ($ids_contactos) {
                foreach ($ids_contactos as $contacto) {
                    echo "<tr>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $j++ . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_idcontacto"] . " </td>";
                    foreach ($columnas as $columna) {
                        echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto[$columna] . " </td>";
                    }
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_usucreado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_fchcreado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_usuactualizado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_fchactualizado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_usueliminado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_fcheliminado"] . " </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> &nbsp; </td>";
                    echo "  <td bgcolor='#" . $contacto["c_ca_color"] . "'> " . $contacto["c_ca_accion"] . " </td>";
                    echo "</tr>";
                }
            }
            echo "  </table>";
            echo " </td>";

            echo "</tr>";
        }
        echo "</table>";
        print_r($resumen);

        exit;
    }

}
