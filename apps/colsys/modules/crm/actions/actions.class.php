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
                $ids->setCaNombre(utf8_decode(strtoupper($request->getParameter("compania"))));
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
                    $cliente->setCaStatus($request->getParameter("status"));
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

    public function executeIndexExt5() {

        $this->permisos = array();

        $user = $this->getUser();
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_CRM);

        $tipopermisos = $user->getAccesoTotalRutina(self::RUTINA_CRM);
        foreach ($tipopermisos as $index => $tp) {
            $this->permisos[$index] = in_array($tp, $permisosRutinas) ? true : false;
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

//        $encuestaVisita = Doctrine::getTable("EncuestaVisita")
//                ->createQuery("e")
//                ->innerJoin("e.Contacto c")
//                ->addWhere("c.ca_idcliente = ?", $idCliente)
//                ->orderBy("e.ca_fchvisita DESC")
//                ->limit(1)
//                ->fetchOne();

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select ca_certificacion, ca_certificacion_otro, ca_implementacion_sistema, ca_implementacion_sistema_detalles from encuestas.tb_encuesta_visita ev "
                . "inner join public.tb_concliente cc on cc.ca_idcontacto = ev.ca_idcontacto "
                . "where ca_idcliente = '$idCliente' order by ca_fchvisita desc limit 1";
        $st = $con->execute($sql);
        $encuestaVisita = $st->fetch();

        $sql = "select * from vi_clientes where ca_idcliente = '$idCliente';";
        $st = $con->execute($sql);
        $vista = $st->fetch();

        $sql = "select * from fun_estado_documentos($idCliente);";
        $st = $con->execute($sql);
        $funcion = $st->fetch();
        $arraycumplimiento = explode("|", $funcion["fun_estado_documentos"]);
        $coltrans = $arraycumplimiento[0];
        $colmas = $arraycumplimiento[1];
        $colotm = $arraycumplimiento[2];
        $coldepositos = $arraycumplimiento[3];

        $data = array();
        if ($cliente) {
            $data["nombre"] = utf8_encode($cliente->getCaNombre());
            $data["website"] = utf8_encode($cliente->getCaWebsite());
            $complemento = ((utf8_encode($cliente->getIdsCliente()->getCaOficina()) != '') ? " Oficina : " . utf8_encode($cliente->getIdsCliente()->getCaOficina()) : "") . ((utf8_encode($cliente->getIdsCliente()->getCaTorre()) != '') ? " Torre : " . (utf8_encode($cliente->getIdsCliente()->getCaTorre()) != '') : "") . (((utf8_encode($cliente->getIdsCliente()->getCaInterior()) != '') != '') ? " Interior : " . utf8_encode($cliente->getIdsCliente()->getCaInterior()) : "") . ((utf8_encode($cliente->getIdsCliente()->getCaComplemento()) != '') ? " - " . utf8_encode($cliente->getIdsCliente()->getCaComplemento()) : "");
            $data["direccion"] = utf8_encode(str_replace("|", " ", $cliente->getIdsCliente()->getCaDireccion())) . $complemento;
            $data["telefonos"] = utf8_encode($cliente->getIdsCliente()->getCaTelefonos());
            $data["fax"] = utf8_encode($cliente->getIdsCliente()->getCaFax());
            $data["localidad"] = utf8_encode($cliente->getIdsCliente()->getCaLocalidad());
            $data["ciudad"] = utf8_encode($cliente->getIdsCliente()->getCiudad());
            $data["email"] = utf8_encode($cliente->getIdsCliente()->getCaEmail());
            $data["status"] = utf8_encode($cliente->getIdsCliente()->getCaStatus());
//            $data["calificacion"] = utf8_encode($cliente->getIdsCliente()->getCaCalificacion());
            $data["sector"] = utf8_encode($cliente->getIdsCliente()->getCaSectoreco());
            $data["vendedor"] = utf8_encode($cliente->getIdsCliente()->getCaVendedor());
            $data["coordinador"] = utf8_encode($cliente->getIdsCliente()->getCaCoordinador());
            $data["tipoNit"] = utf8_encode($cliente->getIdsCliente()->getCaTipo());
            $data["entidad"] = utf8_encode($cliente->getIdsCliente()->getCaEntidad());
            $data["circular"] = utf8_encode($vista["ca_fchcircular"]);
            $data["estado_circular"] = utf8_encode($vista["ca_stdcircular"]);
            $data["nivel_riesgo"] = utf8_encode($vista["ca_nvlriesgo"]);
            $data["lista_clinton"] = utf8_encode($vista["ca_listaclinton"]);
            $data["comentario"] = utf8_encode($vista["ca_comentario"]);
            $data["ultima_consulta"] = $cliente->getUltimaConsulta();
//            $data["acuerdo_conf"] = utf8_encode($vista["ca_fchacuerdoconf"]);
//            $data["contrato_agenc"] = utf8_encode($vista["ca_fchcotratoag"]);
//            $data["estado_contrato"] = utf8_encode($vista["ca_stdcotratoag"]);
//            $data["super_sociedades"] = utf8_encode($vista["ca_leyinsolvencia"]);
//            $data["iso"] = utf8_encode($vista["ca_iso"] . " " . $vista["ca_iso_detalles"]);
//            $data["basc"] = utf8_encode($vista["ca_basc"]);
//            $data["otra"] = utf8_encode($vista["ca_otro_cert"]);
//            $data["otra_detalles"] = utf8_encode($vista["ca_otro_detalles"]);
            $data["auditorias"] = utf8_encode("<b>Creado:</b> " . $vista["ca_usucreado"] . " - " . $vista["ca_fchcreado"] . "&nbsp;&nbsp;&nbsp;" . "<b>Actualizado:</b> " . $vista["ca_usuactualizado"] . " - " . $vista["ca_fchactualizado"] . "&nbsp;&nbsp;&nbsp;" . "<b>Financiero:</b> " . $vista["ca_usufinanciero"] . " - " . $vista["ca_fchfinanciero"]);

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
            $data["tipo_persona"] = utf8_encode($cliente->getIdsCliente()->getTipoPersona());
            $data["regimen"] = utf8_encode($cliente->getIdsCliente()->getRegimen());
            $data["uap"] = ($cliente->getIdsCliente()->getCaUap()) ? utf8_encode("Sí") : "No";
            $data["altex"] = ($cliente->getIdsCliente()->getCaAltex()) ? utf8_encode("Sí") : "No";
            $data["comerciante"] = ($cliente->getIdsCliente()->getCaComerciante()) ? utf8_encode("Sí") : "No";

            $data["codigos_ciiu"] = implode(",", array($cliente->getIdsCliente()->getCaCiiuUno(), $cliente->getIdsCliente()->getCaCiiuDos(), $cliente->getIdsCliente()->getCaCiiuTrs(), $cliente->getIdsCliente()->getCaCiiuCtr()));
            $data["cod_ciiu_uno"] = $cliente->getIdsCliente()->getCaCiiuUno();
            $data["cod_ciiu_dos"] = $cliente->getIdsCliente()->getCaCiiuDos();
            $data["cod_ciiu_trs"] = $cliente->getIdsCliente()->getCaCiiuTrs();
            $data["cod_ciiu_ctr"] = $cliente->getIdsCliente()->getCaCiiuCtr();
            $data["coltrans_fecha"] = substr($vista["ca_coltrans_fch"], 0, -3);
            $data["coltrans_estado"] = $vista["ca_coltrans_std"];
            $data["colmas_fecha"] = substr($vista["ca_colmas_fch"], 0, -3);
            $data["colmas_estado"] = $vista["ca_colmas_std"];
            $data["colotm_fecha"] = substr($vista["ca_colotm_fch"], 0, -3);
            $data["colotm_estado"] = $vista["ca_colotm_std"];
            $data["coldepositos_fecha"] = substr($vista["ca_coldepositos_fch"], 0, -3);
            $data["coldepositos_estado"] = $vista["ca_coldepositos_std"];
            $data["coltrans"] = utf8_encode($coltrans);
            $data["colmas"] = utf8_encode($colmas);
            $data["colotm"] = utf8_encode($colotm);
            $data["coldepositos"] = utf8_encode($coldepositos);
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

    public function executeDatosSucursales(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        if ($idcliente) {
            $sucursales = Doctrine::getTable("IdsSucursal")
                    ->createQuery("i")
                    ->addWhere("i.ca_id = ? and i.ca_usueliminado is null", $idcliente)
                    ->execute();

            $tree = new JTree();
            $root = $tree->createNode(".");
            $tree->addFirst($root);
            $ciudad = null;
            $i = null;
            foreach ($sucursales as $sucursal) {
                $suc_ciudad = utf8_encode($sucursal->getCiudad()->getCaCiudad());
                if ($ciudad != $suc_ciudad) {
                    $i = 0;
                    $uid = $root;
                    $eje_raiz = array();
                    $eje_raiz[] = $suc_ciudad;

                    foreach ($eje_raiz as $eje) {
                        $node_uid = $tree->findValue($uid, $eje);

                        if (!$node_uid) {
                            $nodo = $tree->createNode($eje);
                            $tree->addChild($uid, $nodo);
                            $uid = $nodo;
                        } else {
                            $uid = $node_uid;
                        }
                    }
                    $nodo = $tree->getNode($uid);
                    $nodo->setAttribute("expanded", true);

                    $ciudad = $suc_ciudad;
                }
                $sede_nodo = $tree->createNode(utf8_encode($sucursal->getCaDireccion()));
                $tree->getNode($sede_nodo)->setAttribute("idsucursal", $sucursal->getCaIdsucursal());
                $tree->getNode($sede_nodo)->setAttribute("nombre", utf8_encode($sucursal->getCaNombre()));
                $tree->getNode($sede_nodo)->setAttribute("ciudad", $sucursal->getCaIdciudad());
                $tree->getNode($sede_nodo)->setAttribute("direccion", utf8_encode($sucursal->getCaDireccion()));
                $tree->getNode($sede_nodo)->setAttribute("ciudad_destino", $sucursal->getCaIdciudaddes());
                $tree->getNode($sede_nodo)->setAttribute("telefonos", $sucursal->getCaTelefonos());
                $tree->getNode($sede_nodo)->setAttribute("fax", $sucursal->getCaFax());
                $tree->getNode($sede_nodo)->setAttribute("expanded", true);

                $tree->addChild($uid, $sede_nodo);
                foreach ($sucursal->getIdsContacto() as $contacto) {
                    list($mes, $dia) = sscanf($contacto->getCaCumpleanos(), "%d-%d");
                    $contacto_nodo = $tree->createNode(utf8_encode($contacto->getCaSaludo() . " " . $contacto->getNombre() . " (" . $contacto->getCargo() . ")"));
                    $tree->getNode($contacto_nodo)->setAttribute("idcontacto", $contacto->getCaIdcontacto());
                    $tree->getNode($contacto_nodo)->setAttribute("idsucursal", $contacto->getCaIdsucursal());
                    $tree->getNode($contacto_nodo)->setAttribute("saludo", utf8_encode($contacto->getCaSaludo()));
                    $tree->getNode($contacto_nodo)->setAttribute("nombres", utf8_encode($contacto->getCaNombres()));
                    $tree->getNode($contacto_nodo)->setAttribute("primer_apellido", utf8_encode($contacto->getCaPapellido()));
                    $tree->getNode($contacto_nodo)->setAttribute("segundo_apellido", utf8_encode($contacto->getCaSapellido()));
                    $tree->getNode($contacto_nodo)->setAttribute("identificacion", utf8_encode($contacto->getCaIdentificacion()));
                    $tree->getNode($contacto_nodo)->setAttribute("identificacion_tipo", utf8_encode($contacto->getCaIdentificacionTipo()));
                    $tree->getNode($contacto_nodo)->setAttribute("cargo", utf8_encode($contacto->getCaCargo()));
                    $tree->getNode($contacto_nodo)->setAttribute("cargo_general", utf8_encode($contacto->getCaCargoGeneral()));
                    $tree->getNode($contacto_nodo)->setAttribute("departamento", utf8_encode($contacto->getDepartamento()));
                    $tree->getNode($contacto_nodo)->setAttribute("mes", $mes);
                    $tree->getNode($contacto_nodo)->setAttribute("dia", $dia);
                    $tree->getNode($contacto_nodo)->setAttribute("tipo", utf8_encode($contacto->getCaTipo()));
                    $tree->getNode($contacto_nodo)->setAttribute("telefono", utf8_encode($contacto->getCaTelefonos()));
                    $tree->getNode($contacto_nodo)->setAttribute("celular", utf8_encode($contacto->getCaCelular()));
                    $tree->getNode($contacto_nodo)->setAttribute("correo", utf8_encode($contacto->getCaEmail()));
                    $tree->getNode($contacto_nodo)->setAttribute("celular", utf8_encode($contacto->getCaCelular()));
                    $tree->getNode($contacto_nodo)->setAttribute("cumpleanos", utf8_encode($contacto->getCaCumpleanos()));
                    $tree->getNode($contacto_nodo)->setAttribute("fijo", utf8_encode($contacto->getCaFijo()));
                    $tree->getNode($contacto_nodo)->setAttribute("observaciones", utf8_encode($contacto->getCaObservaciones()));

                    $tree->getNode($contacto_nodo)->setAttribute("leaf", true);
                    $tree->addChild($sede_nodo, $contacto_nodo);
                }
            }
        }
        $this->responseArray = $tree->getTreeNodes();
        $this->setTemplate("responseTemplate");
    }

    public function generateTree($sucursales) {
        $childrens = $this->getChildrensFiles($sucursales);
        $tree = array("text" => "Sucursales",
            "leaf" => false,
            "id" => "0",
            "children" => $childrens);
        return $tree;
    }

    public function getChildrensFiles($sucursales) {
        $data = array();
        $i = 1;
        foreach ($sucursales as $sucursal) {
            $children = array();
            // $children[] = array("text" => utf8_encode($sucursal->getCaTelefonos()), "leaf" => true);
            // $children[] = array("text" => utf8_encode($sucursal->getCaDireccion()), "leaf" => true);
            $children[] = array("text" => "Sede " . $i++, "leaf" => true);
            $data[] = array("text" => utf8_encode($sucursal->getCiudad()->getCaCiudad()), "idsucursal" => $sucursal->getCaIdsucursal(), "sucursal" => true, "children" => $children, "leaf" => false);
        }
        return $data;
    }

    function executeDatosBusqueda($request) {
        $data = array();

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select i.ca_id from ids.tb_ids i where ca_idalterno like '%" . $request->getParameter("q") . "%'";
        $rs = $con->execute($sql);
        $ids = $rs->fetchAll(PDO::FETCH_COLUMN);

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
            $sql = "select i.ca_id from ids.tb_ids i where lower(ca_nombre) like '%" . strtolower($request->getParameter("q")) . "%'";
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

        $q = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->innerJoin("i.IdsCliente id")
                ->whereIn('i.ca_id', $ids);

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
        $clientes = $q->execute();

        foreach ($clientes as $cliente) {
            $data[] = array("idcliente" => utf8_encode("" . $cliente->getCaId()),
                "nombre" => utf8_encode($cliente->getCaNombre()));
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "debug" => $debug);
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

    public function executeCargarDatosSucursal(sfWebRequest $request) {
        $idSucursal = $request->getParameter("idsucursal");
        //print_r($idSucursal);
        //exit;
        $sucursal = Doctrine::getTable("IdsSucursal")
                ->createQuery("i")
                ->addWhere('i.ca_idsucursal = ?', $idSucursal)
                ->fetchOne();

        $data = array();
        if ($sucursal) {
            $data["ciudad"] = utf8_encode($sucursal->getCiudad()->getCaIdciudad());
            $data["direccion"] = utf8_encode($sucursal->getCaDireccion());
            $data["telefonos"] = utf8_encode($sucursal->getCaTelefonos());
            $data["fax"] = utf8_encode($sucursal->getCaFax());
            $data["ciudad_destino"] = utf8_encode($sucursal->getCaIdciudaddes());
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarSucursal(sfWebRequest $request) {
        $idSucursal = $request->getParameter("idsucursal");
        $idCliente = $request->getParameter("idcliente");

        if ($idSucursal) {
            $sucursal = Doctrine::getTable("IdsSucursal")
                    ->createQuery("i")
                    ->addWhere('i.ca_idsucursal = ?', $idSucursal)
                    ->fetchOne();
        } else {
            $sucursal = new IdsSucursal();
            $sucursal->setCaId($idCliente);
        }

        $conn = Doctrine::getTable("IdsSucursal")->getConnection();
        try {
            $conn->beginTransaction();

            $sucursal->setCaIdciudad($request->getParameter("ciudad"));
            $sucursal->setCaDireccion($request->getParameter("direccion"));
            $sucursal->setCaTelefonos($request->getParameter("telefonos"));
            $sucursal->setCaFax($request->getParameter("fax"));

            $sucursal->save();
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarSucursal(sfWebRequest $request) {
        $idSucursal = $request->getParameter("idsucursal");

        $sucursal = Doctrine::getTable("IdsSucursal")->find($idSucursal);
//        $this->forward404Unless($sucursal);

        try {
            $sucursal->setCaUsuactualizado($this->getUser()->getUserId());
            $sucursal->setCaUsueliminado($this->getUser()->getUserId());
            $sucursal->setCaFchactualizado(date("Y-m-d H:i:s"));
            $sucursal->setCaFcheliminado(date("Y-m-d H:i:s"));
            $sucursal->save();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
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
                if ($contacto->getCaFijo()) {
                    $data["not"] = true;
                } else {
                    $data["not"] = false;
                }
                if (utf8_encode($contacto->getCaTipo()) == 1) {
                    $data["tipo"] = utf8_encode($contacto->getCaTipo());
                } else {
                    $data["tipo"] = "";
                }
                $data["observaciones"] = utf8_encode($contacto->getCaObservaciones());
            }

            $caso = "CU265";
            $cargodef = ParametroTable::retrieveByCaso($caso, $contacto->getCaCargoGeneral(), null, null);
            $mostrar = ($cargodef[0]->getCaValor2());

            $this->responseArray = array("success" => true, "data" => $data, "mostrar" => $mostrar);
            $this->setTemplate("responseTemplate");
        } else {
            $this->responseArray = array("success" => true, "data" => $data);
            $this->setTemplate("responseTemplate");
        }
    }

    public function executeGuardarContacto(sfWebRequest $request) {
        $idContacto = $request->getParameter("idcontacto");
        
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

        $concliente = Doctrine::getTable("Contacto")
                ->createQuery("c")
                ->addWhere('c.ca_idcliente = ?', $sucursal->getCaId())
                ->addWhere('trim(lower(c.ca_nombres)) = ?', trim(strtolower($request->getParameter("nombres"))))
                ->addWhere('trim(lower(c.ca_papellido)) = ?', trim(strtolower($request->getParameter("primer_apellido"))))
                ->fetchOne();
        if (!$concliente){
            $concliente = new Contacto();
            $concliente->setCaIdcliente($sucursal->getCaId());
        }

        $conn = Doctrine::getTable("Contacto")->getConnection();
        try {
            $conn->beginTransaction();
            if ($request->getParameter("saludo")) {
                $contacto->setCaSaludo(utf8_decode($request->getParameter("saludo")));
                $concliente->setCaSaludo(utf8_decode($request->getParameter("saludo")));
            }
            if ($request->getParameter("nombres")) {
                $contacto->setCaNombres(utf8_decode($request->getParameter("nombres")));
                $concliente->setCaNombres(utf8_decode($request->getParameter("nombres")));
            }
            if ($request->getParameter("primer_apellido")) {
                $contacto->setCaPapellido(utf8_decode($request->getParameter("primer_apellido")));
                $concliente->setCaPapellido(utf8_decode($request->getParameter("primer_apellido")));
            }
            if ($request->getParameter("segundo_apellido")) {
                $contacto->setCaSapellido(utf8_decode($request->getParameter("segundo_apellido")));
                $concliente->setCaSapellido(utf8_decode($request->getParameter("segundo_apellido")));
            }else{
                $concliente->setCaSapellido('');
            }
            if ($request->getParameter("identificacion_tipo")) {
                $contacto->setCaIdentificacionTipo(utf8_decode($request->getParameter("identificacion_tipo")));
            }
            if ($request->getParameter("identificacion")) {
                $contacto->setCaIdentificacion($request->getParameter("identificacion"));
            }
            if ($request->getParameter("cargo")) {
                $contacto->setCaCargo(utf8_decode($request->getParameter("cargo")));
                $concliente->setCaCargo(utf8_decode($request->getParameter("cargo")));
            }
            if ($request->getParameter("cargo_general")) {
                $contacto->setCaCargoGeneral(utf8_decode($request->getParameter("cargo_general")));
            }
            if ($request->getParameter("departamento")) {
                $contacto->setCaDepartamento(utf8_decode($request->getParameter("departamento")));
                $concliente->setCaDepartamento(utf8_decode($request->getParameter("departamento")));
            }
            if ($request->getParameter("mes") and $request->getParameter("dia")) {
                $contacto->setCaCumpleanos($request->getParameter("mes") . "-" . $request->getParameter("dia"));
            }
            if ($request->getParameter("telefono")) {
                $contacto->setCaTelefonos(utf8_decode($request->getParameter("telefono")));
                $concliente->setCaTelefonos(utf8_decode($request->getParameter("telefono")));
                $concliente->setCaFax('');
            }
            if ($request->getParameter("celular")) {
                $contacto->setCaCelular(utf8_decode($request->getParameter("celular")));
            }
            if ($request->getParameter("correo")) {
                $contacto->setCaEmail(utf8_decode($request->getParameter("correo")));
                $concliente->setCaEmail(utf8_decode($request->getParameter("correo")));
            }
            if ($request->getParameter("tipo") === 1) {
                $contacto->setCaTipo($request->getParameter("tipo"));
            } else {
                $contacto->setCaTipo(0);
            }
            if ($request->getParameter("idsucursal")) {
                $contacto->setCaIdsucursal($request->getParameter("idsucursal"));
            }
            if ($request->getParameter("fijo")) {
                $contacto->setCaFijo(true);
                $concliente->setCaFijo(true);
            } else {
                $contacto->setCaFijo(false);
                $concliente->setCaFijo(false);
            }
            if ($request->getParameter("observaciones")) {
                $contacto->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
                $concliente->setCaObservaciones(utf8_decode($request->getParameter("observaciones")));
            }
            $contacto->setCaUsuactualizado($this->getUser()->getUserId());
            $contacto->setCaFchactualizado(date("Y-m-d H:i:s"));
            $contacto->getConsultaListas("DOCUMENTO");

            $contacto->save();
            $concliente->save();
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarContacto(sfWebRequest $request) {
        $idContacto = $request->getParameter("idcontacto");

        $contacto = Doctrine::getTable("Contacto")->find($idContacto);

        try {
            $contacto->setCaCargo("Extrabajador");
            $contacto->setCaDepartamento("Extrabajador");
            $contacto->save();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
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
//        print_r($idCliente);
//        exit;

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
                "campo" => utf8_encode($auditoria->getCaFieldName()),
                "dato_anterior" => utf8_encode($auditoria->getCaValueOld()),
                "dato_nuevo" => utf8_encode($auditoria->getCaValueNew()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
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
            $data[] = array("fecha" => utf8_encode($seguimiento->getCaFchevento()),
                "tipo" => utf8_encode($seguimiento->getCaTipo()),
                "asunto" => utf8_encode($seguimiento->getCaAsunto()),
                "detalle" => utf8_encode($seguimiento->getCaDetalle()),
                "compromisos" => utf8_encode($seguimiento->getCaCompromisos()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarSeguimiento(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");

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
                $evento->setCaAsunto($request->getParameter("asunto"));
            $evento->setCaDetalle($request->getParameter("detalle"));
            $evento->setCaCompromisos($request->getParameter("compromisos"));
            $evento->setCaFchcompromiso($request->getParameter("fecha"));
            $evento->setCaIdantecedente($request->getParameter("seguimiento_antecesor"));
            $evento->setCaUsuario($this->getUser()->getUserId());

            $evento->save();
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
                $data["tipo_identificacion"] = utf8_encode($cliente->getIds()->getIdsTipoIdentificacion()->getCaTipoidentificacion());
                $data["idalterno_id"] = utf8_encode($cliente->getIds()->getCaIdalterno());
                $data["dv_id"] = utf8_encode($cliente->getIds()->getCaDv());
                $data["cliente"] = utf8_encode($cliente->getIds()->getCaNombre());
                $data["comercial"] = utf8_encode($cliente->getCaVendedor());
                $data["coord_aduana"] = utf8_encode($cliente->getCaCoordinador());
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
                $data["titulo"] = utf8_encode($cliente->getCaSaludo());
                $data["nombre"] = utf8_encode($cliente->getCaNombres());
                $data["apellido1"] = utf8_encode($cliente->getCaPapellido());
                $data["apellido2"] = utf8_encode($cliente->getCaSapellido());
                $data["genero"] = utf8_encode($cliente->getCaSexo());
                $data["cumpleanos"] = utf8_encode($cliente->getCaCumpleanos());
                $data["idRepresentante"] = utf8_encode($cliente->getCaNumidentificacionRl());
                $data["actividad"] = utf8_encode($cliente->getCaActividad());
                $data["sector_economico"] = utf8_encode($cliente->getCaSectoreco());
                $data["leyinsolvencia"] = utf8_encode($cliente->getCaLeyinsolvencia());
                $data["comentario"] = utf8_encode($cliente->getCaComentario());
                $data["contrato_agendamiento"] = utf8_encode($cliente->getCaFchcotratoag());
                $data["lista_Ofac"] = utf8_encode($cliente->getCaListaclinton());
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
            $cliente = new IdsCliente();
            $ids = new Ids();
            $cliente->setCaIdgrupo($request->getParameter("idalterno_id"));
        }

        $conn = Doctrine::getTable("IdsCliente")->getConnection();
        try {
            $conn->beginTransaction();

            $ids->setCaIdalterno($request->getParameter("idalterno_id"));
            $ids->setCaTipoidentificacion($request->getParameter("tipo_identificacion"));
            $ids->setCaDv($request->getParameter("dv_id"));
            $ids->setCaWebsite($request->getParameter("website"));
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
                $cliente->setCaDireccion(utf8_decode($direccion));

                $cliente->setCaOficina($request->getParameter("oficina"));
                $cliente->setCaTorre($request->getParameter("torre"));
                $cliente->setCaBloque($request->getParameter("bloque"));
                $cliente->setCaInterior($request->getParameter("interior"));
                $cliente->setCaComplemento(utf8_decode($request->getParameter("complemento")));
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad")));
            } else {
                $cliente->setCaDireccion(utf8_decode($request->getParameter("dir_ot")));
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad_ot")));
            }

            $cliente->setCaZipcode(utf8_decode($request->getParameter("codigo_postal")));
            $cliente->setCaIdciudad(utf8_decode($request->getParameter("ciudad")));
            $cliente->setCaTelefonos(utf8_decode($request->getParameter("telefono")));
            $cliente->setCaFax(utf8_decode($request->getParameter("fax")));
            $cliente->setCaEmail(utf8_decode($request->getParameter("e_mail")));
            $cliente->setCaWebsite(utf8_decode($request->getParameter("website")));
            $cliente->setCaSaludo(utf8_decode($request->getParameter("titulo")));
            $cliente->setCaNombres(utf8_decode($request->getParameter("nombre")));
            $cliente->setCaPapellido(utf8_decode($request->getParameter("apellido1")));
            $cliente->setCaSapellido(utf8_decode($request->getParameter("apellido2")));
            $cliente->setCaSexo(utf8_decode($request->getParameter("genero")));
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

            $cliente->setCaListaclinton(utf8_decode($request->getParameter("lista_Ofac")));
            $cliente->setCaStatus(utf8_decode($request->getParameter("status")));
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

            //$cliente->save();

            $ids->save($conn);
            $cliente->setCaIdgrupo($ids->getCaId());
            $cliente->setCaIdcliente($ids->getCaId());
            $cliente->setIds($ids);
            $cliente->save($conn);

            $ids->getConsultaListas("DOCUMENTO");

            $conn->commit();
            $this->responseArray = array("success" => true, "idcliente" => $ids->getCaId() . "", "nombreCliente" => utf8_encode($ids->getCaNombre()));
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeValidarNITExistente(sfWebRequest $request) {
        $ids = Doctrine::getTable("Ids")
                ->createQuery("i")
                ->addWhere('i.ca_idalterno = ?', $request->getParameter("idalterno"))
                ->fetchOne();

        if ($ids) {
            $this->responseArray = array("success" => true, "data" => utf8_encode("El número de NIT ya se encuentra registrado en la base de datos."));
        } else {
            $this->responseArray = array("success" => true, "data" => "");
        }
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

    public function executeDatosBeneficioCredito(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");
        try {
            $beneficiosCredito = Doctrine::getTable("IdsCredito")
                    ->createQuery("i")
                    ->addWhere('i.ca_id = ?', $idCliente)
                    ->addOrderBy("i.ca_idempresa")
                    ->execute();

            $data = array();

            foreach ($beneficiosCredito as $beneficioCredito) {
                $data[] = array(
                    "idempresa" => utf8_encode($beneficioCredito->getCaIdempresa()),
                    "empresa" => utf8_encode($beneficioCredito->getEmpresa()->getCaNombre()),
                    "cupo" => utf8_encode($beneficioCredito->getCaCupo()),
                    "dias" => utf8_encode($beneficioCredito->getCaDias()),
                    "observaciones" => utf8_encode($beneficioCredito->getCaObservaciones()),
                    "creacion" => utf8_encode($beneficioCredito->getCaUsucreado() . " - " . $beneficioCredito->getCaFchcreado()),
                    "ult_modificacion" => utf8_encode($beneficioCredito->getCaUsuactualizado() . " - " . $beneficioCredito->getCaFchactualizado()));
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

    public function executeGuardarBeneficioCredito(sfWebRequest $request) {
        $idCliente = $request->getParameter("idcliente");
        $idEmpresa = $request->getParameter("idempresa");

        $beneficioCredito = Doctrine::getTable("IdsCredito")
                ->createQuery("i")
                ->addWhere('i.ca_id = ?', $idCliente)
                ->addWhere('i.ca_idempresa = ?', $idEmpresa)
                ->fetchOne();

        if (!$beneficioCredito) {
            $beneficioCredito = new IdsCredito();
            $beneficioCredito->setCaId($idCliente);
            $beneficioCredito->setCaIdempresa($idEmpresa);
        }

        $con = Doctrine::getTable("IdsCredito")->getConnection();
        try {
            $con->beginTransaction();
            if ($request->getParameter("cupo")) {
                $beneficioCredito->setCaCupo($request->getParameter("cupo"));
            }
            if ($request->getParameter("dias")) {
                $beneficioCredito->setCaDias($request->getParameter("dias"));
            }
            if ($request->getParameter("observaciones")) {
                $beneficioCredito->setCaObservaciones($request->getParameter("observaciones"));
            }
            $beneficioCredito->save();
            $con->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $con->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_decode($e->getMessage()));
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
            $documentacion = json_decode(utf8_encode($fichatecnica->getCaDocumentacion()));
            $transporte = $fichatecnica->getCaTransporteinternacional();
            $imprimir = true;
            $this->responseArray = array("success" => true, "documentacion" => $documentacion, "transporte" => utf8_encode($transporte), "imprimir" => $imprimir);
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
            $data = array("idcliente" => $cliente->getCaIdcliente(),
                "fchcircular" => $cliente->getCaFchcircular(),
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
                "comerciante" => utf8_encode($cliente->getCaComerciante()),
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

    public function executePermisosDuenoCuenta(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $cliente = Doctrine::getTable("IdsCliente")->find($idcliente);

        // Permisos propios del Representante de Ventas Dueño de la Cuenta
        $permisosDueno = array(1, 2, 3, 4, 6, 7, 9, 10, 11, 13, 14, 16, 17, 18);
        if ($cliente->getCaVendedor() == $this->getUser()->getUserId()) {
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

}
