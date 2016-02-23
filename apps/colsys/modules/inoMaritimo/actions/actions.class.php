<?php

/**
 * inoMaritimo actions.
 *
 * @package    symfony
 * @subpackage inoMaritimo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inoMaritimoActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    /**
     * Esta accion se eliminará cuando se haga la capacitación a nivel nacional del nuevo formulario
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCostos(sfWebRequest $request) {

        $user = $this->getUser();
        $this->forward("inoMaritimo", "formCostosNew");
    }

    /**
     * Esta accion permitirá la apertura de varias referencias
     *
     * @param sfRequest $request A request object
     */
    public function executeAperturaCasos(sfWebRequest $request) {
        $this->annos = array();
        for ($i = (date("Y")); $i >= (date("Y") - 5); $i--) {
            $this->annos[] = $i;
        }

        // "%" => "Todos los Meses", 
        $this->meses = array("01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");

        $con = Doctrine_Manager::getInstance()->connection();

        $usuarios_rs = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->innerJoin("u.Sucursal s")
                ->addWhere("u.ca_activo=true ")
                ->orderBy("u.ca_login")
                ->execute();
        $this->usuarios = array();
        $this->usuarios["%"] = "Usuarios (Todos)";
        foreach ($usuarios_rs as $usuario) {
            $this->usuarios[$usuario->getCaLogin()] = $usuario->getCaNombre();
        }

        $sql = "select DISTINCT ca_nombre as ca_sucursal from control.tb_sucursales where ca_idempresa = 2 order by ca_sucursal";
        $rs = $con->execute($sql);
        $sucursales_rs = $rs->fetchAll();
        $this->sucursales = array();
        foreach ($sucursales_rs as $sucursal) {
            $this->sucursales[$sucursal["ca_sucursal"]] = $sucursal["ca_sucursal"];
        }

        $sql = "select DISTINCT ca_identificacion as ca_sufijo from tb_parametros p, tb_traficos t where ca_casouso = 'CU010' and p.ca_valor = t.ca_idtrafico order by ca_identificacion";
        $rs = $con->execute($sql);
        $sufijos_rs = $rs->fetchAll();
        $this->sufijos = array();
        $this->sufijos["%"] = "Sufijos (Todos)";
        foreach ($sufijos_rs as $sufijo) {
            $this->sufijos[$sufijo["ca_sufijo"]] = $sufijo["ca_sufijo"];
        }

        $traficos_rs = Doctrine::getTable("Trafico")
                ->createQuery("t")
                ->orderBy("t.ca_nombre")
                ->execute();
        $this->traficos = array();
        $this->traficos["%"] = "Tráficos (Todos)";
        foreach ($traficos_rs as $trafico) {
            $this->traficos[$trafico->getCaNombre()] = $trafico->getCaNombre();
        }

        $this->estados = array("%" => "Todos los Casos", "Cerrado" => "Casos Cerrados", "Abierto" => "Casos Abiertos");
    }

    /**
     * Lista de referencias con opción de apertura
     *
     * @param sfRequest $request A request object
     */
    public function executeAperturaCasosList(sfWebRequest $request) {
        $this->anio = $request->getParameter("anio");
        $this->mes = $request->getParameter("mes");
        $this->sucursal = $request->getParameter("selSucursal");
        $this->sufijo = $request->getParameter("selSufijo");
        $this->trafico = $request->getParameter("selTrafico");
        $this->usuario = $request->getParameter("selUsuario");
        $this->casos = $request->getParameter("casos");

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn", 'last');
    }

    public function executeDatosPanelReferencias(sfWebRequest $request) {
        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        $sucursal = $request->getParameter("sucursal");
        $sufijo = $request->getParameter("sufijo");
        $trafico = $request->getParameter("trafico");
        $usuario = $request->getParameter("usuario");
        $casos = $request->getParameter("casos");

        $con = Doctrine_Manager::getInstance()->connection();
        //$sql = "select im.ca_ano, im.ca_mes, im.ca_referencia, im.ca_ciuorigen, im.ca_ciudestino, im.ca_modalidad, im.ca_nombre, im.ca_mbls, im.ca_usucerrado, im.ca_fchcerrado, cr.ca_usuabierto, cr.ca_fchabierto, im.ca_estado from vi_inomaestra_sea im "
        //   . "LEFT JOIN (select ca_referencia, max(ca_fchactualizado) as ca_fchabierto, max(ca_usuactualizado) as ca_usuabierto from tb_inomaestralog_sea where ca_fchcerrado IS NOT NULL and ca_usucerrado IS NOT NULL group by ca_referencia) cr ON cr.ca_referencia = im.ca_referencia";

        set_time_limit(0);
        $sql = "select substr(im.ca_referencia::text, 16, 2)::integer + 2000 AS ca_ano, substr(im.ca_referencia::text, 8, 2) AS ca_mes, im.ca_referencia, c1.ca_ciudad AS ca_ciuorigen, c2.ca_ciudad AS ca_ciudestino, "
                . "im.ca_modalidad, tr.ca_nombre as ca_sigla, im.ca_mbls, im.ca_usucerrado, im.ca_fchcerrado, cr.ca_usuabierto, cr.ca_fchabierto, CASE WHEN im.ca_usucerrado IS NOT NULL THEN 'Cerrado'::text ELSE 'Abierto'::text END AS ca_estado "
                . "from tb_inomaestra_sea im "
                . "   JOIN tb_ciudades c1 ON im.ca_origen::text = c1.ca_idciudad::text"
                . "   JOIN tb_ciudades c2 ON im.ca_destino::text = c2.ca_idciudad::text"
                . "   JOIN tb_traficos t1 ON c1.ca_idtrafico::text = t1.ca_idtrafico::text"
                . "   JOIN tb_traficos t2 ON c2.ca_idtrafico::text = t2.ca_idtrafico::text"
                . "   JOIN ids.tb_ids tr ON im.ca_idlinea = tr.ca_id"
                . "   LEFT JOIN (select ca_referencia, max(ca_fchactualizado) as ca_fchabierto, min(ca_usuactualizado) as ca_usuabierto from tb_inomaestralog_sea where ca_fchcerrado IS NOT NULL and ca_usucerrado IS NOT NULL group by ca_referencia) cr ON cr.ca_referencia = im.ca_referencia";

        $sub = "";
        if ($anio) {
            $sub.= "substr(im.ca_referencia::text, 16, 2)::integer + 2000 = '$anio' and ";
        }
        if ($mes != "%") {
            $sub.= "substr(im.ca_referencia::text, 8, 2) = '$mes' and ";
        }
        if ($sucursal != "Todas Las sucursales") {
            $sub.= "im.ca_referencia in ("
                    . "select DISTINCT ic.ca_referencia from tb_inoclientes_sea ic "
                    . "  inner join control.tb_usuarios us on us.ca_login = ic.ca_login "
                    . "  inner join control.tb_sucursales su on su.ca_idsucursal = us.ca_idsucursal "
                    . "  where su.ca_nombre = '" . utf8_decode($sucursal) . "'"
                    . ") and ";
        }
        if ($sufijo != "%") {
            $sub.= "substr(im.ca_referencia::text, 5, 2) = '" . str_pad($sufijo, 2, "0", STR_PAD_LEFT) . "' and ";
        }
        if ($trafico != "%") {
            $sub.= "t1.ca_nombre = '$trafico' and ";
        }
        if ($casos != "%") {
            if ($casos == "Abierto") {
                $sub.= "im.ca_usucerrado IS NULL and ";
            } elseif ($casos == "Cerrado") {
                $sub.= "im.ca_usucerrado IS NOT NULL and ";
            }
        }
        if ($usuario != "%") {
            $sub.= "(im.ca_usucerrado = '$usuario' or (cr.ca_usuabierto = '$usuario' and im.ca_usucerrado IS NULL)) and ";
        }
        if (strlen($sub) != 0) {
            $sub = substr($sub, 0, strlen($sub) - 5);
            $sql.= " where $sub";
        }

        $rs = $con->execute($sql);
        $referencias_rs = $rs->fetchAll();
        $referencias = array();
        foreach ($referencias_rs as $key => $referencia) {
            $referencias[$key]["ca_ano"] = $referencia["ca_ano"];
            $referencias[$key]["ca_mes"] = $referencia["ca_mes"];
            $referencias[$key]["ca_referencia"] = $referencia["ca_referencia"];
            $referencias[$key]["ca_ciuorigen"] = $referencia["ca_ciuorigen"];
            $referencias[$key]["ca_ciudestino"] = $referencia["ca_ciudestino"];
            $referencias[$key]["ca_modalidad"] = $referencia["ca_modalidad"];
            $referencias[$key]["ca_sigla"] = $referencia["ca_sigla"];
            $referencias[$key]["ca_mbls"] = $referencia["ca_mbls"];
            $referencias[$key]["ca_estado"] = $referencia["ca_estado"];
            if ($referencia["ca_estado"] == "Cerrado") {
                $referencias[$key]["ca_usucerrado"] = $referencia["ca_usucerrado"];
                $referencias[$key]["ca_fchcerrado"] = $referencia["ca_fchcerrado"];
            } else {
                $referencias[$key]["ca_usucerrado"] = "";
                $referencias[$key]["ca_fchcerrado"] = "";
            }
            if ($referencia["ca_estado"] == "Abierto") {
                $referencias[$key]["ca_usuabierto"] = $referencia["ca_usuabierto"];
                $referencias[$key]["ca_fchabierto"] = $referencia["ca_fchabierto"];
            } else {
                $referencias[$key]["ca_usuabierto"] = "";
                $referencias[$key]["ca_fchabierto"] = "";
            }
        }

        $this->responseArray = array("success" => true, "total" => count($referencias), "root" => $referencias);

        $this->setTemplate("responseTemplate");
    }

    public function executeObserveAbrirReferencias(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "update tb_inomaestra_sea set ca_usucerrado = null, ca_usuoperacion = '" . $this->getUser()->getUserId() . "', ca_fchcerrado = null, ca_observaciones = ca_observaciones || '\n' || '" . date("Y-m-d") . " " . $request->getParameter("observaciones") . "'  where ca_referencia = '" . $request->getParameter("referencia") . "' and ca_usucerrado IS NOT NULL and ca_fchcerrado IS NOT NULL";

        $st = $con->execute($sql);
        $referencia = $st->fetchAll();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormUtilidadesNew(sfWebRequest $request) {
        
    }

    /**
     * Executes datosPanelLiquidacionHouse action
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelLiquidacionHouse(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("numRef"));
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("numRef"));
        $this->forward404Unless($referencia);

        $this->utilidades = array();
        $utilidades = Doctrine::getTable("InoUtilidadliqSea")
                ->createQuery("u")
                ->innerJoin("u.InoClientesSea c")
                ->addWhere("c.ca_referencia = ?", $referencia->getCaReferencia())
                ->execute();

        $referencias = array();
        foreach ($utilidades as $key => $ut) {
            $referencias[$key]["ca_referencia"] = $referencia->getCaReferencia();
            $referencias[$key]["ca_idinocliente"] = $ut->getCaIdinocliente();
            $referencias[$key]["ca_idcliente"] = $ut->getInoClientesSea()->getCliente()->getCaIdalterno();
            $referencias[$key]["ca_cliente"] = $ut->getInoClientesSea()->getCliente()->getCaCompania();
            $referencias[$key]["ca_hbl"] = $ut->getInoClientesSea()->getCaHbls();
            $referencias[$key]["ca_prepaid_vlr"] = $ut->getCaPrepaidVlr();
            $referencias[$key]["ca_factura_vlr"] = $ut->getCaFacturaVlr();
            $referencias[$key]["ca_valor"] = $ut->getCaValor();
        }

        $this->responseArray = array("success" => true, "total" => count($referencias), "root" => $referencias);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes datosGridParametrosLiquida action
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridParametrosLiquida(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("numRef"));
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("numRef"));
        $this->forward404Unless($referencia);

        $this->utilidades = array();
        $parametros = Doctrine::getTable("InoUtilidadprmsSea")
                ->createQuery("p")
                ->addWhere("p.ca_referencia = ?", $referencia->getCaReferencia())
                ->execute();
        $referencias = array();
        foreach ($parametros as $key => $pr) {
            $referencias[$key]["ca_idparametro"] = $pr->getCaIdparametro();
            $referencias[$key]["ca_referencia"] = $pr->getCaReferencia();
            $referencias[$key]["ca_idcosto"] = $pr->getCaIdcosto();
            $referencias[$key]["ca_costo"] = utf8_encode($pr->getCosto()->getCaCosto());
            $referencias[$key]["ca_tipo"] = $pr->getCaTipo();
            $referencias[$key]["ca_aplicacion"] = $pr->getCaAplicacion();
            $referencias[$key]["ca_valor"] = $pr->getCaValor();
        }

        $this->responseArray = array("success" => true, "total" => count($referencias), "root" => $referencias);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes datosGridParametrosLiquida action
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosGridLiquidarReferencia(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("numRef"));
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("numRef"));
        $this->forward404Unless($referencia);

        $cbm_total = 0;
        $liquidacion = array();
        $inoclientes = $referencia->getInoClientesSea();
        foreach ($inoclientes as $inocliente) {
            $liquidacion[$inocliente->getCaHbls()]["idinocliente"] = $inocliente->getCaIdinocliente();
            $liquidacion[$inocliente->getCaHbls()]["cliente"] = $inocliente->getCliente()->getCaCompania();
            $cbm = ($inocliente->getCaPeso() >= 1000 and ( $inocliente->getCaVolumen() < round($inocliente->getCaPeso() / 1000, 2))) ? round($inocliente->getCaPeso() / 1000, 2) : $inocliente->getCaVolumen();
            $liquidacion[$inocliente->getCaHbls()]["cbm"] = $cbm;
            $cbm_total+= $cbm;
        }

        $parametros = Doctrine::getTable("InoUtilidadprmsSea")
                ->createQuery("p")
                ->addWhere("p.ca_referencia = ?", $referencia->getCaReferencia())
                ->execute();

        foreach ($parametros as $pr) {
            $valor = ($pr->getCaTipo() == "ING") ? $pr->getCaValor() : $pr->getCaValor() * -1;
            if ($pr->getCaAplicacion() == "Valor Fijo") {
                foreach ($liquidacion as $key => $hbl) {
                    $liquidacion[$key][$pr->getCaIdcosto()]["aplicacion"] = $pr->getCaAplicacion();
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicando"] = 0;
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicador"] = $valor;
                    $liquidacion[$key][$pr->getCaIdcosto()]["costo"] = utf8_encode($pr->getCosto()->getCaCosto());
                    $liquidacion[$key][$pr->getCaIdcosto()]["valor"] = $valor;
                }
            } else if ($pr->getCaAplicacion() == "Valor Unitario M3") {
                foreach ($liquidacion as $key => $hbl) {
                    $sub_valor = (round($valor * $liquidacion[$key]["cbm"], 2) < $valor) ? round($valor * $liquidacion[$key]["cbm"], 2) : $valor;
                    $liquidacion[$key][$pr->getCaIdcosto()]["aplicacion"] = $pr->getCaAplicacion();
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicando"] = $liquidacion[$key]["cbm"];
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicador"] = $valor;
                    $liquidacion[$key][$pr->getCaIdcosto()]["costo"] = utf8_encode($pr->getCosto()->getCaCosto());
                    $liquidacion[$key][$pr->getCaIdcosto()]["valor"] = $sub_valor;
                }
            } else if ($pr->getCaAplicacion() == "X Doc. Transporte") {
                $sub_valor = round($valor / count($liquidacion), 2);
                foreach ($liquidacion as $key => $hbl) {
                    $liquidacion[$key][$pr->getCaIdcosto()]["aplicacion"] = $pr->getCaAplicacion();
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicando"] = 1;
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicador"] = $sub_valor;
                    $liquidacion[$key][$pr->getCaIdcosto()]["costo"] = utf8_encode($pr->getCosto()->getCaCosto());
                    $liquidacion[$key][$pr->getCaIdcosto()]["valor"] = $sub_valor;
                }
            } else if ($pr->getCaAplicacion() == utf8_encode("X Metro Cúbico")) {
                $sub_valor = $valor / $cbm_total;
                foreach ($liquidacion as $key => $hbl) {
                    $liquidacion[$key][$pr->getCaIdcosto()]["aplicacion"] = $pr->getCaAplicacion();
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicando"] = $liquidacion[$key]["cbm"];
                    $liquidacion[$key][$pr->getCaIdcosto()]["multiplicador"] = $sub_valor;
                    $liquidacion[$key][$pr->getCaIdcosto()]["costo"] = utf8_encode($pr->getCosto()->getCaCosto());
                    $liquidacion[$key][$pr->getCaIdcosto()]["valor"] = round($sub_valor * $liquidacion[$key]["cbm"], 2);
                }
            }
        }
        $key = 0;
        $referencias = array();
        foreach ($liquidacion as $hbl => $items) {

            foreach ($items as $concepto => $item) {
                if ($concepto != "cliente" and $concepto != "cbm") {
                    $referencias[$key]["ca_idinocliente"] = $items["idinocliente"];
                    $referencias[$key]["ca_caso"] = utf8_encode($hbl . " - " . $items["cliente"] . " Cbm: " . $items["cbm"]);
                    $referencias[$key]["ca_costo"] = $item["costo"];
                    $referencias[$key]["ca_aplicacion"] = $item["aplicacion"];
                    $referencias[$key]["ca_multiplicando"] = round($item["multiplicando"], 2);
                    $referencias[$key]["ca_multiplicador"] = round($item["multiplicador"], 2);
                    $referencias[$key]["ca_valor"] = round($item["valor"], 2);
                    $key++;
                }
            }
        }
        $this->responseArray = array("success" => true, "total" => count($referencias), "root" => $referencias);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes guardarDatosLiquidacionHouse action
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarDatosLiquidacionHouse(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $liquidaciones = json_decode($datos);
        $errorInfo = "";
        $ids = array();
        foreach ($liquidaciones as $liquidacion) {
            $error = ""; {
                $utilidadliq = null;
                if ($liquidacion->idinocliente) {
                    $utilidadliq = Doctrine::getTable("InoUtilidadliqSea")
                            ->createQuery("p")
                            ->addWhere("p.ca_idinocliente = ?", $liquidacion->idinocliente)
                            ->fetchOne();
                }
                if (!$utilidadliq) {
                    $utilidadliq = new InoUtilidadliqSea();
                    $utilidadliq->setCaIdinocliente($liquidacion->idinocliente);
                }
                $utilidadliq->setCaPrepaidVlr($liquidacion->prepaid_vlr);
                $utilidadliq->setCaFacturaVlr($liquidacion->factura_vlr);
                $utilidadliq->setCaValor($liquidacion->valor);

                if ($error != "")
                    $errorInfo.="Error en item " . utf8_encode($liquidacion->hbl) . ": " . $error . " <br>";
                else {
                    $utilidadliq->save();
                    $ids[] = $liquidacion->id;
                    $ids_reg[] = $utilidadliq->getCaIdinocliente();
                }
            }
        }

        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes guardarDatosLiquidacionHouse action
     *
     * @param sfRequest $request A request object
     */
    public function executeAplicarLiquidacionHouse(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $liquidaciones = json_decode($datos);
        $errorInfo = "";
        $ids = array();
        foreach ($liquidaciones as $liquidacion) {
            $error = ""; {
                if ($liquidacion->idinocliente) {
                    $inoingreso = Doctrine::getTable("InoIngresosSea")
                            ->createQuery("i")
                            ->addWhere("i.ca_idinocliente = ?", $liquidacion->idinocliente)
                            ->orderBy("i.ca_fchfactura")
                            ->fetchOne();
                    if ($inoingreso) {
                        $trm = $inoingreso->getCaTcambio() != 1 ? $inoingreso->getCaTcambio() : $trm;
                        $valor = round($liquidacion->valor * $trm, 0);
                        if (!isset($ids[$liquidacion->idinocliente]["valor"])) {
                            $ids[$liquidacion->idinocliente]["valor"] = 0;
                        }
                        $ids[$liquidacion->idinocliente]["valor"]+= $valor;
                        if (!isset($ids[$liquidacion->idinocliente]["trm"])) {
                            $ids[$liquidacion->idinocliente]["trm"] = $trm;
                        }
                    }
                }
            }
        }
        foreach ($ids as $key => $valor) {
            $utilidadliq = Doctrine::getTable("InoUtilidadliqSea")
                    ->createQuery("u")
                    ->addWhere("u.ca_idinocliente = ?", $key)
                    ->fetchOne();
            $utilidadliq->setCaValor($utilidadliq->getCaFacturaVlr() + round($utilidadliq->getCaPrepaidVlr() * $valor["trm"], 0) + $valor["valor"]);
            $utilidadliq->save();
        }

        $this->responseArray = array("errorInfo" => $errorInfo, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes datosGridParametrosLiquida action
     *
     * @param sfRequest $request A request object
     */
    public function executeImportarDatosHouse(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("numRef"));
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("numRef"));
        $this->forward404Unless($referencia);

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "delete from tb_inoutilidadliq_sea where ca_idinocliente in (select ca_idinocliente from tb_inoclientes_sea where ca_referencia = '" . $request->getParameter("numRef") . "')";
        $st = $con->execute($sql);

        $deducciones = array();
        $aplicaciones = ParametroTable::retrieveByCaso("CU245");
        foreach ($aplicaciones as $aplicacion) {
            $deducciones[] = $aplicacion->getCaIdentificacion();
        }

        $errorInfo = "";
        $cbm_total = 0;
        $liquidacion = array();
        $inoclientes = $referencia->getInoClientesSea();
        foreach ($inoclientes as $inocliente) {
            $facturaVlr = 0;
            $sobreventaVlr = 0;
            $deduccionesVlr = 0;
            $inoingresos = $inocliente->getInoIngresosSea();
            foreach ($inoingresos as $inoingreso) {
                if (trim($inoingreso->getCaObservaciones()) != "Contenedores" and trim($inoingreso->getCaObservaciones()) != "Bodegajes") {
                    $inodeducciones = $inoingreso->getInoDeduccionesSea();
                    foreach ($inodeducciones as $inodeduccion) {
                        if (in_array($inodeduccion->getCaIddeduccion(), $deducciones)) {
                            $deduccionesVlr+= $inodeduccion->getCaValor();
                        }
                    }
                }
                $facturaVlr+= $inoingreso->getCaValor() - $deduccionesVlr;
            }
            $inoutilidades = Doctrine::getTable("InoUtilidadSea")
                    ->createQuery("c")
                    ->addWhere("c.ca_idinocliente = ?", $inocliente->getCaIdinocliente())
                    ->execute();

            foreach ($inoutilidades as $inoutilidad) {
                $inocosto = Doctrine::getTable("InoCostosSea")
                        ->createQuery("c")
                        ->addWhere("c.ca_idinocostos_sea = ?", $inoutilidad->getCaIdinocosto())
                        ->fetchOne();
                if ($inocosto->getCosto()->getCaCosto() == "OTM") {
                    $sobreventaVlr+= $inocosto->getCaVenta();
                }
            }
            $facturaVlr-= $sobreventaVlr;

            $utilidadliq = new InoUtilidadliqSea();
            $utilidadliq->setCaIdinocliente($inocliente->getCaIdinocliente());
            $utilidadliq->setCaPrepaidVlr(0);
            $utilidadliq->setCaFacturaVlr(round($facturaVlr, 0));
            $utilidadliq->setCaValor(0);
            $utilidadliq->save();
        }
        $this->responseArray = array("errorInfo" => $errorInfo, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes guardarDatosParametros action
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarDatosParametros(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $parametros = json_decode($datos);
        $errorInfo = "";
        $ids = array();
        foreach ($parametros as $parametro) {
            $error = ""; {
                $utilidadprm = null;
                if ($parametro->idparametro) {
                    $utilidadprm = Doctrine::getTable("InoUtilidadprmsSea")
                            ->createQuery("p")
                            ->addWhere("p.ca_idparametro = ?", $parametro->idparametro)
                            ->fetchOne();
                }
                if (!$utilidadprm) {
                    $utilidadprm = new InoUtilidadprmsSea();
                    $utilidadprm->setCaReferencia($parametro->referencia);
                }
                $utilidadprm->setCaIdcosto($parametro->idcosto);
                $utilidadprm->setCaTipo($parametro->tipo);
                $utilidadprm->setCaAplicacion($parametro->aplicacion);
                $utilidadprm->setCaValor($parametro->valor);

                if ($error != "")
                    $errorInfo.="Error en item " . utf8_encode($parametro->item) . ": " . $error . " <br>";
                else {
                    $utilidadprm->save();
                    $ids[] = $parametro->id;
                    $ids_reg[] = $utilidadprm->getCaReferencia();
                }
            }
        }

        $this->responseArray = array("errorInfo" => $errorInfo, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes eliminarDatosParametros action
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarDatosParametros(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $parametros = json_decode($datos);
        $errorInfo = "";
        $ids = array();
        foreach ($parametros as $parametro) {
            $error = ""; {
                if ($parametro->referencia and $parametro->idcosto and $parametro->tipo) {
                    $utilidadprm = Doctrine::getTable("InoUtilidadprmsSea")
                            ->createQuery("p")
                            ->addWhere("p.ca_referencia = ?", $parametro->referencia)
                            ->addWhere("p.ca_idcosto = ?", $parametro->idcosto)
                            ->addWhere("p.ca_tipo = ?", $parametro->tipo)
                            ->fetchOne();
                    if ($utilidadprm) {
                        $utilidadprm->delete();
                    }
                }
            }
        }

        $this->responseArray = array("errorInfo" => $errorInfo, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCostosNew(sfWebRequest $request) {

        $this->forward404Unless($request->getParameter("referencia"));
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("referencia"));
        $this->forward404Unless($referencia);
        $this->utilidades = array();

        $monedaLocal = $this->getUser()->getIdmoneda();

        $this->idinocosto = $request->getParameter("idinocosto");

        //echo $this->idinocosto;
        if ($this->idinocosto) {
            $inoCosto = Doctrine::getTable("InoCostosSea")->find($this->idinocosto);
            //echo $inoCosto->getCaFactura();
            $this->forward404Unless($inoCosto);

            $utilidades = Doctrine::getTable("InoUtilidadSea")
                    ->createQuery("u")
                    ->addWhere("u.ca_idinocosto = ?", $this->idinocosto)
                    ->execute();

            foreach ($utilidades as $ut) {
                $this->utilidades[$ut->getCaIdinocliente()] = $ut->getCaValor();
            }
        } else {
            $inoCosto = new InoCostosSea();
        }

        $this->inoClientes = Doctrine::getTable("InoClientesSea")
                ->createQuery("u")
                ->innerJoin("u.Cliente cl")
                ->addWhere("u.ca_referencia = ?", $referencia->getCaReferencia())
                ->addOrderBy("u.ca_hbls")
                ->execute();

        $this->form = new CostosNewForm();
        $this->form->setReferencia($referencia);
        $this->form->setInoClientes($this->inoClientes);
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();
            $bindValues["referencia"] = $request->getParameter("referencia");
            $bindValues["idcosto"] = intval($request->getParameter("idcosto"));
            $bindValues["idcosto_ant"] = intval($request->getParameter("idcosto_ant"));
            $bindValues["idmoneda"] = $request->getParameter("idmoneda");
            $bindValues["fchcreado"] = $request->getParameter("fchcreado");
            $bindValues["factura"] = $request->getParameter("factura");
            $bindValues["factura_ant"] = $request->getParameter("factura_ant");
            $bindValues["fchfactura"] = $request->getParameter("fchfactura");
            $bindValues["neto"] = $request->getParameter("neto");
            $bindValues["venta"] = $request->getParameter("venta");
            $bindValues["tcambio"] = $request->getParameter("tcambio");
            $bindValues["tcambio_usd"] = $request->getParameter("tcambio_usd");
            $bindValues["proveedor"] = $request->getParameter("proveedor");

            if ($bindValues["idmoneda"] == "USD" || $bindValues["idmoneda"] == $monedaLocal) {
                $bindValues["tcambio_usd"] = 1;
            }

            if ($bindValues["idmoneda"] == $monedaLocal) {
                $bindValues["tcambio"] = 1;
            }

            foreach ($this->inoClientes as $ic) {
                $bindValues["util_" . $ic->getCaIdinocliente()] = $request->getParameter("util_" . $ic->getCaIdinocliente());
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                $conn = Doctrine::getTable("Reporte")->getConnection();
                $conn->beginTransaction();
                try {
                    if ($bindValues["factura_ant"]) {
                        $utils = Doctrine::getTable("InoUtilidadSea")
                                ->createQuery("u")
                                ->addWhere("u.ca_idinocosto = ?", $this->idinocosto)
                                ->execute();
                        foreach ($utils as $u) {
                            $u->delete($conn);
                        }
                    }
                    $inoCosto->setCaReferencia($bindValues["referencia"]);
                    $inoCosto->setCaIdcosto($bindValues["idcosto"]);
                    $inoCosto->setCaIdmoneda($bindValues["idmoneda"]);
                    $inoCosto->setCaFactura($bindValues["factura"]);
                    $inoCosto->setCaFchfactura($bindValues["fchfactura"]);
                    $inoCosto->setCaNeto($bindValues["neto"]);
                    $inoCosto->setCaVenta($bindValues["venta"]);
                    $inoCosto->setCaTcambio($bindValues["tcambio"]);
                    $inoCosto->setCaTcambioUsd($bindValues["tcambio_usd"]);
                    $inoCosto->setCaProveedor($bindValues["proveedor"]);
                    $inoCosto->save($conn);

                    if (!$this->idinocosto)
                        $this->idinocosto = $inoCosto->getCaIdinocostosSea();


                    foreach ($bindValues as $key => $val) {
                        if (substr($key, 0, 4) == "util") {
                            if ($val) {
                                $oid = substr($key, 5);
                                $ic = Doctrine::getTable("InoClientesSea")
                                        ->createQuery("ic")
                                        ->addWhere("ic.ca_idinocliente = ? ", $oid)
                                        ->fetchOne();

                                $ut = new InoUtilidadSea();
                                //$ut->setCaReferencia($bindValues["referencia"]);
                                //$ut->setCaIdcliente($ic->getCaIdcliente());
                                //$ut->setCaHbls($ic->getCaHbls());
                                //$ut->setCaIdcosto($bindValues["idcosto"]);
                                //$ut->setCaFactura($bindValues["factura"]);
                                $ut->setCaValor($val);
                                $ut->setCaIdinocosto($this->idinocosto);
                                $ut->setCaIdinocliente($ic->getCaIdinocliente());
                                $ut->save($conn);
                            }
                        }
                    }
                    $conn->commit();
                    $this->redirect("/colsys_php/inosea.php?boton=Consultar&id=" . $referencia->getCaReferencia());
                } catch (Exception $e) {
                    throw $e;
                }
            }
        }

        $this->oid = $oid;
        $this->referencia = $referencia;

        $this->inoCosto = $inoCosto;

        $this->monedaLocal = $monedaLocal;
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeNumerosRadicacion(sfWebRequest $request) {
        //set_time_limit(0);
        //$file = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . "NumerosReservados.txt";
        $file = $_FILES['archivo']['tmp_name'];

        //echo $file;
        //exit;

        $f = fopen($file, 'r');
        $data = '';
        while (!feof($f))
            $data.=fread($f, 512);
        fclose($f);

        $cadena = substr($data, 1, strlen($data));
        $cadena = substr($cadena, 0, strlen($cadena) - 1);
        $numeros = explode(", ", $cadena);

        foreach ($numeros as $numero) {
            if ($numero) {
                $query = "insert into tb_dianreservados (ca_numero_resv) values ('" . trim($numero) . "'); ";

                // echo "<br />".$query."<br />";
                $q = Doctrine_Manager::getInstance()->connection();
                $stmt = $q->execute($query);
            }
        }
        unlink($file);
        //$this->forward("homepage", "index");
        $this->responseArray = array("errorInfo" => $errorInfo, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeImportarParametricas(sfWebRequest $request) {
        $DOM = new DOMDocument;

        $this->tablas = ParametroTable::retrieveByCaso("CU243");

        foreach ($this->tablas as $tabla) {
            $servicio = $tabla->getCaValor();
            $url = $tabla->getCaValor2();
            $eliminar = true;

            $homepage = file_get_contents($url);
            $DOM->loadHTML($homepage);

            $items = $DOM->getElementsByTagName('table');

            $q = Doctrine_Manager::getInstance()->connection();
            for ($i = 0; $i < $items->length; $i++) {
                if ($items->item($i)->getAttribute('class') == "EstiloTabla") {
                    $children = $items->item($i)->childNodes;
                    $skip = TRUE;
                    foreach ($children as $child) {
                        $elements = $child->childNodes;
                        $record = array();
                        foreach ($elements as $element) {
                            $record[] = utf8_decode($element->nodeValue);
                        }
                        if ($skip and $record[0] == "No." and $record[1] == "NIT" and $record[3] == "Ciudad") {
                            $skip = false;
                            continue;
                        }
                        if (!$skip) {
                            if ($eliminar) {    // Borra registros anteriores de la tabla
                                $query = "delete from tb_dianservicios where ca_tipo = '$servicio';";
                                $stmt = $q->execute($query);
                                $eliminar = false;
                            }
                            $dv = Utils::calcularDV($record[1]);
                            $nit = $record[1] . "-" . $dv;  // Agrega el DV al Nit
                            $razonsocial = addslashes($record[2]);
                            $query = "insert into tb_dianservicios (ca_idservicio, ca_identificacion, ca_razonsocial, ca_ciudad, ca_codigo, ca_tipo) values ($record[0], '$nit', '$razonsocial', '$record[3]', '$record[4]', '$servicio');";
                            $stmt = $q->execute($query);
                        }
                    }
                }
            }
        }
        $this->forward("homepage", "index");
    }

    /**
     * Pantalla de entrada para Gestion Documentos de Transporte
     *
     * @param sfRequest $request A request object
     */
    public function executeInoLiberacionSea(sfWebRequest $request) {
        $this->filtros = array("ca_referencia" => "Número de Referencia");
    }

    /**
     * Lista de Referencias para Gestion Documentos de Transporte
     *
     * @param sfRequest $request A request object
     */
    public function executeInoLiberacionSeaList(sfWebRequest $request) {
        $this->selFiltro = $request->getParameter("selFiltro");
        $this->cadena = $request->getParameter("cadena");
        $this->data = array();

        $referencias_rs = Doctrine::getTable("InoMaestraSea")
                ->createQuery("i")
                ->where("i.ca_referencia like '%$this->cadena%'")
                ->execute();
        foreach ($referencias_rs as $key => $referencia) {
            $row = array();
            $row["ca_referencia"] = $referencia->getCaReferencia();
            $row["ca_impoexpo"] = $referencia->getCaImpoexpo();
            $row["ca_traorigen"] = $referencia->getOrigen()->getTrafico()->getCaNombre();
            $row["ca_ciuorigen"] = $referencia->getOrigen()->getCaCiudad();
            $row["ca_tradestino"] = $referencia->getDestino()->getTrafico()->getCaNombre();
            $row["ca_ciudestino"] = $referencia->getDestino()->getCaCiudad();
            $row["ca_fchreferencia"] = $referencia->getCaFchreferencia();
            $row["ca_modalidad"] = $referencia->getCaModalidad();
            $this->data[] = $row;
        }
    }

    public function executeFormLiberacionSeaExt5(sfWebRequest $request) {

        $id = base64_decode($request->getParameter("id"));
        $referencia = Doctrine::getTable("InoMaestraSea")
                ->createQuery("i")
                ->where("i.ca_referencia like '$id'")
                ->fetchOne();

        $this->referencia = $referencia;
    }

    public function executeLiberarCarga(sfWebRequest $request) {
        $idinocliente = $request->getParameter("idinocliente");
        $estado_liberacion = $request->getParameter("estado_liberacion");
        $nota_liberacion = $request->getParameter("nota_liberacion");
        $fch_liberacion = $request->getParameter("fch_liberacion");
        $detalle_liberacion = $request->getParameter("detalle_liberacion");

        $clientesea = Doctrine::getTable("InoClientesSea")
                ->createQuery("d")
                ->where("d.ca_idinocliente = ?", $idinocliente)
                ->fetchOne();
        if ($estado_liberacion == '' || $nota_liberacion == '' || $fch_liberacion == '') {
            $this->responseArray = array("success" => false, 'errorInfo' => 'Error');
        } else {
            if ($clientesea) {
                $conn = Doctrine::getTable("InoClientesSea")->getConnection();
                $conn->beginTransaction();
                try {
                    $clientesea->setCaFchliberacion($fch_liberacion);
                    $clientesea->setCaNotaliberacion(utf8_decode($nota_liberacion));
                    $clientesea->setCaDetalleliberacion(utf8_decode($detalle_liberacion));
                    $clientesea->setCaEstadoliberacion($estado_liberacion);
                    $clientesea->setCaUsuliberado($this->getUser()->getUserId());
                    $clientesea->setCaFchliberado(date("Y-m-d H:i:s"));

                    $clientesea->save();
                    $conn->commit();
                    $this->responseArray = array("success" => true);
                } catch (Exception $e) {
                    $this->responseArray = array("success" => false);
                }
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeRevertirLiberarCarga(sfWebRequest $request) {
        $idinocliente = $request->getParameter("idinocliente");

        $clientesea = Doctrine::getTable("InoClientesSea")
                ->createQuery("d")
                ->where("d.ca_idinocliente = ?", $idinocliente)
                ->fetchOne();
        if ($clientesea) {
            $conn = Doctrine::getTable("InoClientesSea")->getConnection();
            $conn->beginTransaction();
            try {
                $clientesea->setCaFchliberacion(null);
                $clientesea->setCaNotaliberacion(null);
                $clientesea->setCaDetalleliberacion(null);
                $clientesea->setCaEstadoliberacion('Sin Liberar');
                $clientesea->setCaUsuliberado($this->getUser()->getUserId());
                $clientesea->setCaFchliberado(date("Y-m-d H:i:s"));

                $clientesea->save();
                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $this->responseArray = array("success" => false);
            }
        }

        $this->setTemplate("responseTemplate");
    }

}
