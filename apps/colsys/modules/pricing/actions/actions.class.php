<?php

/**
 * pricing actions.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pricingActions extends sfActions {
    const RUTINA = "61";

    public function getNivel() {
        $this->nivel = $this->getUser()->getNivelAcceso(pricingActions::RUTINA);
        if ($this->nivel == -1) {
            $this->forward404();
        }
        return $this->nivel;
    }

    public function executeIndex() {
        $this->nivel = $this->getNivel();
        $this->opcion = "";
        if ($this->nivel == -1) {
            $this->forward404();
        }

        if ($this->nivel == 0) {
            $this->opcion = "consulta";
        }

        $this->modalidades_mar = ParametroTable::retrieveByCaso("CU051");
        $this->modalidades_aer = ParametroTable::retrieveByCaso("CU052");
        $this->modalidades_ter = ParametroTable::retrieveByCaso("CU053");

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/FileUploadField", 'last');
        $response->addJavaScript("extExtras/RowExpander", 'last');
        $response->addJavaScript("extExtras/CheckColumn", 'last');
        /* $response->addJavaScript("extExtras/LockingGridView",'last');
          $response->addJavaScript("extExtras/ColumnHeaderGroup",'last'); */
        $this->nivel = $this->getNivel();

        if ($this->nivel == -1) {
            $this->forward404();
        }
        $this->directory = sfConfig::get("app_digitalFile_pricing");
    }

    /*     * *******************************************************************
     * Acciones del PanelFletesPorTrayecto
     *
     * ******************************************************************* */
    /*
     * Muestra los trayectos
     */

    public function executeDatosPanelFletesPorTrayecto() {
        set_time_limit(90);       
        
        $this->nivel = $this->getNivel();

        $this->opcion = "";
        if ($this->nivel == -1) {
            $this->forward404();
        }

        if ($this->nivel == 0) {
            $this->opcion = "consulta";
        }

        if ($this->getRequestParameter("opcion") == "consulta") {
            $this->opcion = "consulta";
        }

        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $idtrafico = $this->getRequestParameter("idtrafico");
        $modalidad = $this->getRequestParameter("modalidad");
        $idlinea = $this->getRequestParameter("idlinea");
        $idciudad = $this->getRequestParameter("idciudad");
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $this->forward404Unless($impoexpo);

        $idciudad2 = $this->getRequestParameter("idciudad2");
        $start = $this->getRequestParameter("start");
        $limit = $this->getRequestParameter("limit");

        $this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);

        $this->forward404Unless($this->trafico);

        if ($this->getRequestParameter("fechacambio")) {
            $fechacambio = str_replace("|", "-", $this->getRequestParameter("fechacambio"));
            $timestamp = strtotime($fechacambio . " " . $this->getRequestParameter("horacambio"));
            $this->opcion = "consulta";
        } else {
            $timestamp = null;
        }

        if ($timestamp) {
            $fchcorte = date("Y-m-d H:i:s", $timestamp);
        } else {
            $fchcorte = date("Y-m-d H:i:s");
        }

        $q = Doctrine_Query::create()
                        ->select("t.ca_idtrayecto, p.ca_sigla, id.ca_nombre, t.ca_origen,
                              t.ca_destino, t.ca_idlinea, o.ca_ciudad, d.ca_ciudad,
                              ai.ca_nombre, a.ca_idagente, t.ca_transporte, t.ca_modalidad,
                              t.ca_impoexpo, t.ca_observaciones, t.ca_tiempotransito, t.ca_frecuencia, t.ca_netnet")
                        ->from("Trayecto t");
        $q->innerJoin("t.Origen o");
        $q->innerJoin("t.Destino d");
        $q->innerJoin("t.IdsProveedor p");
        $q->innerJoin("p.Ids id");
        $q->leftJoin("t.IdsAgente a");
        $q->leftJoin("a.Ids ai");
        $q->where("t.ca_impoexpo = ? ", $impoexpo);
        $q->addWhere("t.ca_transporte = ? ", $transporte);
        $q->addWhere("t.ca_modalidad = ? ", $modalidad);
        $q->addWhere("t.ca_activo = ? ", true);
        //$q->addWhere("p.ca_activo = ? ", true );
        $q->addWhere("(a.ca_activo = ? OR a.ca_activo IS NULL)", true);

        if ($impoexpo == Constantes::IMPO) {
            $q->addWhere("o.ca_idtrafico = ? ", $this->trafico->getCaIdtrafico());
        } else {
            $q->addWhere("d.ca_idtrafico = ? ", $this->trafico->getCaIdtrafico());
        }

        if ($impoexpo == Constantes::IMPO || $this->getRequestParameter("fechacambio")) { // La fecha de cambio permite que salga el historico de exportaciones
            if ($idciudad) {
                $q->addWhere("t.ca_origen = ? ", $idciudad);
            }
            if ($idciudad2) {
                $q->addWhere("t.ca_destino = ? ", $idciudad2);
            }
        } else {
            if ($idciudad) {
                $q->addWhere("t.ca_destino = ? ", $idciudad);
            }
            if ($idciudad2) {
                $q->addWhere("t.ca_origen = ? ", $idciudad2);
            }
        }

        if ($idlinea) {
            $q->addWhere("t.ca_idlinea = ? ", $idlinea);
        }

        $q->addOrderBy("id.ca_nombre ASC");
        if ($limit) {
            $q->limit($limit);
        }
        if ($start) {
            $q->offset($start);
        }
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);

        $trayectos = $q->execute();

        $data = array();
        $transportador_id = null;

        $i = 0;

        $ultCiudad = null;
        $ultLinea = null;
        //echo count( $trayectos );
        foreach ($trayectos as $trayecto) {
            //Por este campo se agrupan los conceptos
            $trayectoStr = strtoupper($trayecto["o_ca_ciudad"]) . "»" . strtoupper($trayecto["d_ca_ciudad"]) . " - ";

            $trayectoStr.=$trayecto["p_ca_sigla"] ? $trayecto["p_ca_sigla"] : $trayecto["id_ca_nombre"];

            if ($trayecto["ai_ca_nombre"]) {
                $trayectoStr.=" [" . $trayecto["ai_ca_nombre"] . "] ";
            }
            $trayectoStr.=" (TT " . $trayecto["t_ca_tiempotransito"] . " Freq. " . $trayecto["t_ca_frecuencia"] . ") " . $trayecto["t_ca_idtrayecto"];
            $trayectoStr = utf8_encode($trayectoStr);
            $trayectoStr = str_replace("&", "AND", $trayectoStr);

            $baseRow = array(
                'idtrayecto' => $trayecto["t_ca_idtrayecto"],
                'trayecto' => $trayectoStr,
                'origen' => $trayecto["t_ca_origen"],
                'destino' => $trayecto["t_ca_destino"],
                'idlinea' => $trayecto["t_ca_idlinea"]
            );

            $recargosGenerales = array();

            if ($timestamp) {
                $q = Doctrine_Query::create()->from("PricRecargoxConceptoBs r");
                $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxConceptoBs rh WHERE rh.ca_fchcreado<= ? AND
                         r.ca_idconcepto = rh.ca_idconcepto AND r.ca_idrecargo = rh.ca_idrecargo AND r.ca_idtrayecto = rh.ca_idtrayecto ORDER BY rh.ca_consecutivo DESC LIMIT 1 )", $fchcorte);
            } else {
                $q = Doctrine_Query::create()->from("PricRecargoxConcepto r");
            }
            $q->innerJoin("r.TipoRecargo t");
            $q->addWhere("r.ca_idtrayecto = ? AND r.ca_idconcepto = ?", array($trayecto["t_ca_idtrayecto"], '9999'));

            $q->addOrderBy("t.ca_recargo");
            $pricRecargosGen = $q->execute();

            if ($pricRecargosGen) {
                foreach ($pricRecargosGen as $pricRecargo) {
                    if ($pricRecargo->getCaFcheliminado()) {
                        continue;
                    }
                    $tipoRecargo = $pricRecargo->getTipoRecargo();
                    $sugerida = $pricRecargo->getCaVlrrecargo();
                    $minima = $pricRecargo->getCaVlrminimo();
                    $row = array(
                        'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                        'idconcepto' => '9999',
                        'equipo' => utf8_encode($pricRecargo->getEquipo() ? $pricRecargo->getEquipo()->getCaConcepto() : ""),
                        'idequipo' => $pricRecargo->getCaIdequipo(),
                        'inicio' => $pricRecargo->getCaFchinicio(),
                        'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                        'moneda' => $pricRecargo->getCaIdmoneda(),
                        'style' => '',
                        'observaciones' => utf8_encode(str_replace("\"", "'", $pricRecargo->getCaObservaciones())),
                        'iditem' => $pricRecargo->getCaIdrecargo(),
                        'tipo' => "recargo",
                        'sugerida' => $sugerida,
                        'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                        'minima' => $minima,
                        'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                        'consecutivo' => $pricRecargo->getCaConsecutivo(),
                        'actualizado' => $pricRecargo->getCaUsucreado() . " " . Utils::fechaMes($pricRecargo->getCaFchcreado())
                    );
                    $recargosGenerales[] = array_merge($baseRow, $row);
                }
            }

            if ($impoexpo == Constantes::IMPO) {
                $idciudad = $trayecto["t_ca_origen"];
            } else {
                $idciudad = $trayecto["t_ca_destino"];
            }

            if ($idciudad != $ultCiudad) { //Se evita calcular los recargos x ciudad si corresponden al anterior
                $ultCiudad = $idciudad;
                if ($timestamp) {
                    $q = Doctrine_Query::create()->from("PricRecargoxCiudadBs r");
                    $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxCiudadBs rh WHERE rh.ca_fchcreado<= ?
                            AND r.ca_idtrafico = rh.ca_idtrafico AND r.ca_idciudad = rh.ca_idciudad AND r.ca_modalidad = rh.ca_modalidad AND r.ca_impoexpo = rh.ca_impoexpo AND r.ca_idrecargo = rh.ca_idrecargo
                            ORDER BY rh.ca_consecutivo DESC LIMIT 1)", $fchcorte);
                } else {
                    $q = Doctrine_Query::create()->from("PricRecargoxCiudad r");
                }
                $q->innerJoin("r.TipoRecargo t");
                $q->addWhere("r.ca_idtrafico = ? AND (r.ca_idciudad = ? OR r.ca_idciudad = '999-9999') AND r.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($this->trafico->getCaIdtrafico(), $idciudad, $trayecto["t_ca_transporte"], $trayecto["t_ca_modalidad"], $trayecto["t_ca_impoexpo"]));
                $q->addOrderBy("t.ca_recargo");
                $pricRecargosxCiudad = $q->execute();
            }
            if ($pricRecargosxCiudad) {
                foreach ($pricRecargosxCiudad as $pricRecargo) {
                    if ($pricRecargo->getCaFcheliminado()) {
                        continue;
                    }
                    $tipoRecargo = $pricRecargo->getTipoRecargo();
                    $sugerida = $pricRecargo->getCaVlrrecargo();
                    $minima = $pricRecargo->getCaVlrminimo();
                    $row = array(
                        'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                        'idconcepto' => '9999',
                        'inicio' => $pricRecargo->getCaFchinicio(),
                        'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                        'moneda' => $pricRecargo->getCaIdmoneda(),
                        'style' => '',
                        'observaciones' => utf8_encode(str_replace("\"", "'", $pricRecargo->getCaObservaciones())),
                        'iditem' => $pricRecargo->getCaIdrecargo(),
                        'tipo' => "recargoxciudad",
                        'sugerida' => $sugerida,
                        'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                        'minima' => $minima,
                        'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                        'consecutivo' => $pricRecargo->getCaConsecutivo(),
                        'actualizado' => $pricRecargo->getCaUsucreado() . " " . Utils::fechaMes($pricRecargo->getCaFchcreado())
                    );
                    $recargosGenerales[] = array_merge($baseRow, $row);
                }
            }

            if ($trayecto["t_ca_idlinea"] != $ultLinea) { //Se evita calcular los recargos x ciudad si corresponden al anterior
                $ultLinea = $trayecto["t_ca_idlinea"];
                if ($timestamp) {
                    $q = Doctrine_Query::create()->from("PricRecargoxLineaBs r");
                    $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxLineaBs rh WHERE rh.ca_fchcreado<= ?
                            AND r.ca_idtrafico = rh.ca_idtrafico AND r.ca_idlinea = rh.ca_idlinea AND r.ca_modalidad = rh.ca_modalidad AND r.ca_impoexpo = rh.ca_impoexpo AND r.ca_idrecargo = rh.ca_idrecargo
                             ORDER BY rh.ca_consecutivo DESC LIMIT 1 )", $fchcorte);
                } else {
                    $q = Doctrine_Query::create()->from("PricRecargoxLinea r");
                }
                $q->innerJoin("r.TipoRecargo t");
                $q->addWhere("r.ca_idtrafico = ? AND r.ca_idlinea = ? AND r.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($this->trafico->getCaIdtrafico(), $trayecto["t_ca_idlinea"], $trayecto["t_ca_transporte"], $trayecto["t_ca_modalidad"], $trayecto["t_ca_impoexpo"]));

                $q->addOrderBy("t.ca_recargo");
                $PricRecargoxLinea = $q->execute();
            }
            if ($PricRecargoxLinea) {
                foreach ($PricRecargoxLinea as $pricRecargo) {
                    if ($pricRecargo->getCaFcheliminado()) {
                        continue;
                    }
                    $tipoRecargo = $pricRecargo->getTipoRecargo();
                    $sugerida = $pricRecargo->getCaVlrrecargo();
                    $minima = $pricRecargo->getCaVlrminimo();
                    $row = array(
                        'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                        'idconcepto' => '9999',
                        'inicio' => $pricRecargo->getCaFchinicio(),
                        'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                        'moneda' => $pricRecargo->getCaIdmoneda(),
                        'style' => '',
                        'observaciones' => utf8_encode(str_replace("\"", "'", $pricRecargo->getCaObservaciones())),
                        'iditem' => $pricRecargo->getCaIdrecargo(),
                        'tipo' => "recargoxciudad",
                        'sugerida' => $sugerida,
                        'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                        'minima' => $minima,
                        'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                        'consecutivo' => $pricRecargo->getCaConsecutivo(),
                        'actualizado' => $pricRecargo->getCaUsucreado() . " " . Utils::fechaMes($pricRecargo->getCaFchcreado())
                    );
                    $recargosGenerales[] = array_merge($baseRow, $row);
                }
            }
            //Fin recargos generales
            //Trae los conceptos hasta una fecha de corte
            if ($timestamp) {
                $q = Doctrine_Query::create()->from("PricFleteBs f");
                $q->addWhere("f.ca_fchcreado IN (SELECT fh.ca_fchcreado FROM PricFleteBs fh WHERE fh.ca_fchcreado<= ? AND f.ca_idconcepto = fh.ca_idconcepto AND f.ca_idtrayecto = fh.ca_idtrayecto
                                              ORDER BY fh.ca_consecutivo DESC LIMIT 1  )", $fchcorte);
            } else {
                $q = Doctrine_Query::create()->from("PricFlete f");
            }
            $q->innerJoin("f.Concepto c");
            $q->leftJoin("f.Equipo e");
            $q->addWhere("f.ca_idtrayecto = ?", $trayecto["t_ca_idtrayecto"]);
            //$q->addWhere("(f.ca_fcheliminado >= ? OR f.ca_fcheliminado IS NULL )", $fchcorte );            
            $q->addOrderBy("e.ca_concepto");
            $q->addOrderBy("c.ca_liminferior");
            $q->addOrderBy("c.ca_concepto");
            $pricConceptos = $q->execute();

            $groupStyle = array();
            foreach ($pricConceptos as $pricConcepto) {
                $groupStyle[] = $pricConcepto->getCaEstado();
            }

            $groupStyle = array_unique($groupStyle);
            //Se incluye una fila antes de los conceptos que contiene las observaciones del trayecto
            if ($timestamp) {
                $con = Doctrine_Manager::getInstance()->connection();
                $sql = "select ca_observaciones
					from pric.log_trayectos t
					WHERE
						t.ca_fchcreado<= '" . $fchcorte . "' and ca_idtrayecto=" . $trayecto["t_ca_idtrayecto"] . " limit 1";
                $st = $con->execute($sql);
                //recuperamos las tuplas de resultados
                $obs_tmp = $st->fetchAll();
                if (count($obs_tmp) > 0)
                    $observaciones = $obs_tmp[0]["ca_observaciones"];
                else
                    $observaciones=$trayecto["t_ca_observaciones"];
            }
            else {
                $observaciones = $trayecto["t_ca_observaciones"];
            }
            $row = array(
                'nconcepto' => "Observaciones",
                'inicio' => '',
                'vencimiento' => '',
                'moneda' => '',
                'aplicacion' => '',
                'style' => implode("|", $groupStyle),
                'observaciones' => utf8_encode(str_replace("\"", "'", $observaciones)),
                'iditem' => '',
                'tipo' => "trayecto_obs",
                'neta' => '',
                'minima' => '',
                'minima' => '',
                'orden' => '000',
                'netnet' => $trayecto["t_ca_netnet"]?"1":""
            );
            $data[] = array_merge($baseRow, $row);

            // Se incluyen las filas de cada concepto y sus respectivos recargos
            foreach ($pricConceptos as $pricConcepto) {

                if ($pricConcepto->getCaFcheliminado()) {
                    continue;
                }
                if ($this->opcion == "consulta" && $pricConcepto->getCaEstado() == 2) {//Las tarifas en mantenimiento no se muestran en consulta
                    $neta = 0;
                    $sugerida = 0;
                } else {
                    $neta = $pricConcepto->getCaVlrneto();
                    $sugerida = $pricConcepto->getCaVlrsugerido();
                }

                $row = array(
                    'consecutivo' => $pricConcepto->getCaConsecutivo(),
                    'nconcepto' => utf8_encode($pricConcepto->getConcepto()->getCaConcepto()),
                    'equipo' => utf8_encode($pricConcepto->getEquipo() ? $pricConcepto->getEquipo()->getCaConcepto() : ""),
                    'idequipo' => $pricConcepto->getCaIdequipo(),
                    'inicio' => $pricConcepto->getCaFchinicio(),
                    'vencimiento' => $pricConcepto->getCaFchvencimiento(),
                    'moneda' => $pricConcepto->getCaIdmoneda(),
                    'style' => $pricConcepto->getEstilo(),
                    'iditem' => $pricConcepto->getCaIdconcepto(),
                    'tipo' => "concepto",
                    'neta' => $neta,
                    'sugerida' => $sugerida,
                    'aplicacion' => utf8_encode($pricConcepto->getCaAplicacion()),
                    'consecutivo' => $pricConcepto->getCaConsecutivo(),
                    'orden' => str_pad($i, 3, "0", STR_PAD_LEFT),
                    'actualizado' => $pricConcepto->getCaUsucreado() . " " . Utils::fechaMes($pricConcepto->getCaFchcreado())
                );

                $data[] = array_merge($baseRow, $row);

                if ($timestamp) {
                    $q = Doctrine_Query::create()->from("PricRecargoxConceptoBs r");
                    $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxConceptoBs rh WHERE rh.ca_fchcreado<= ? AND
                             r.ca_idconcepto = rh.ca_idconcepto AND r.ca_idrecargo = rh.ca_idrecargo AND r.ca_idtrayecto = rh.ca_idtrayecto
                              ORDER BY rh.ca_consecutivo DESC LIMIT 1 )", $fchcorte);
                } else {
                    $q = Doctrine_Query::create()->from("PricRecargoxConcepto r");
                }
                $q->addOrderBy("t.ca_recargo");
                $q->innerJoin("r.TipoRecargo t");
                $q->addWhere("r.ca_idtrayecto = ? AND r.ca_idconcepto = ?", array($trayecto["t_ca_idtrayecto"], $pricConcepto->getCaIdconcepto()));

                if ($pricConcepto->getCaIdequipo()) {
                    $q->addWhere("r.ca_idequipo = ?", $pricConcepto->getCaIdequipo());
                } else {
                    $q->addWhere("r.ca_idequipo IS NULL");
                }

                $pricRecargos = $q->execute();

                if ($pricRecargos) {
                    foreach ($pricRecargos as $pricRecargo) {
                        if ($pricRecargo->getCaFcheliminado()) {
                            continue;
                        }
                        $tipoRecargo = $pricRecargo->getTipoRecargo();

                        if ($this->opcion == "consulta" && $pricConcepto->getCaEstado() == 2) {//Las tarifas en mantenimiento no se muestran en consulta
                            $sugerida = 0;
                            $minima = 0;
                        } else {
                            $sugerida = $pricRecargo->getCaVlrrecargo();
                            $minima = $pricRecargo->getCaVlrminimo();
                        }


                        $row = array(
                            'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                            'idconcepto' => $pricConcepto->getCaIdconcepto(),
                            'equipo' => utf8_encode($pricRecargo->getEquipo() ? $pricRecargo->getEquipo()->getCaConcepto() : ""),
                            'idequipo' => $pricRecargo->getCaIdequipo(),
                            'inicio' => $pricRecargo->getCaFchinicio(),
                            'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                            'moneda' => $pricRecargo->getCaIdmoneda(),
                            'style' => '',
                            'observaciones' => utf8_encode(str_replace("\"", "'", $pricRecargo->getCaObservaciones())),
                            'iditem' => $pricRecargo->getCaIdrecargo(),
                            'tipo' => "recargo",
                            'sugerida' => $sugerida,
                            'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                            'minima' => $minima,
                            'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                            'consecutivo' => $pricRecargo->getCaConsecutivo(),
                            'orden' => str_pad($i, 3, "0", STR_PAD_LEFT) . " " . utf8_encode($tipoRecargo->getCaRecargo()),
                            'actualizado' => $pricRecargo->getCaUsucreado() . " " . Utils::fechaMes($pricRecargo->getCaFchcreado())
                        );
                        $data[] = array_merge($baseRow, $row);
                    }
                }

                if ($this->opcion == "consulta" && count($recargosGenerales) > 0 && $trayecto["t_ca_transporte"] == Constantes::MARITIMO && $trayecto["t_ca_modalidad"] == "FCL") {
                    //En el caso maritimo se incluyen los recargos despues de cada concepto en el modo de consulta unicamente
                    foreach ($recargosGenerales as $rec) {
                        $rec['idconcepto'] = $pricConcepto->getCaIdconcepto();
                        $rec['orden'] = str_pad($i, 3, "0", STR_PAD_LEFT) . " " . $rec['nconcepto'];
                        $data[] = $rec;
                    }
                }
                $i++;
            }

            //$this->opcion!="consulta" se hace para que el usuario pueda
            // hacer click con el boton derecho y agregar un recargo general
            if ($this->opcion != "consulta" || ( count($recargosGenerales) > 0 )) {
                //Se incluye una fila antes de los recargos generales del trayecto
                $row = array(
                    'nconcepto' => "Recargos generales del trayecto",
                    'inicio' => '',
                    'vencimiento' => '',
                    'moneda' => '',
                    'aplicacion' => '',
                    'style' => '',
                    'observaciones' => '',
                    'iditem' => '9999',
                    'tipo' => "concepto",
                    'neta' => '',
                    'minima' => '',
                    'orden' => 'ZZZ'
                );
                $data[] = array_merge($baseRow, $row);
            }

            if ($this->opcion != "consulta" || ( count($recargosGenerales) > 0 && !($trayecto["t_ca_transporte"] == Constantes::MARITIMO && $trayecto["t_ca_modalidad"] == "FCL"))) {
                foreach ($recargosGenerales as $rec) {
                    $rec['orden'] = "ZZZ " . $rec['nconcepto'];
                    $data[] = $rec;
                }
            }
            $i++;
        }

        $this->responseArray = array(
            'success' => true,
            'total' => count($data),
            'data' => $data
        );
        $this->setTemplate("responseTemplate");
    }

    /*
     * Observa los cambios realizados en grillaPorTraficos
     * @author: Andres Botero
     */

    public function executeGuardarPanelFletesPorTrayecto() {
        $conn = Doctrine::getTable("PricFlete")->getConnection();
        $conn->beginTransaction();
        try {
            $this->nivel = $this->getNivel();

            if ($this->nivel <= 0) {
                $this->forward404();
            }

            $trayecto = Doctrine::getTable("Trayecto")->find($this->getRequestParameter("idtrayecto"));
            $this->forward404Unless($trayecto);

            $tipo = $this->getRequestParameter("tipo");
            $neta = $this->getRequestParameter("neta");
            $sugerida = $this->getRequestParameter("sugerida");
            $id = $this->getRequestParameter("id");
            $idequipo = $this->getRequestParameter("idequipo");
            $this->responseArray = array("id" => $id, "success" => true);
            $user = $this->getUser();

            if ($tipo == "trayecto_obs") {
                if ($this->getRequestParameter("observaciones") !== null) {
                    if ($this->getRequestParameter("observaciones")) {
                        $trayecto->setCaObservaciones($this->getRequestParameter("observaciones"));
                    } else {
                        $trayecto->setCaObservaciones(null);
                    }
                }
                $trayecto->save( $conn );
            }

            if ($tipo == "concepto") {
                $idconcepto = $this->getRequestParameter("iditem");
                $q = Doctrine::getTable("PricFlete")->createQuery()
                                ->addWhere("ca_idtrayecto = ?", $trayecto->getCaIdtrayecto())
                                ->addWhere("ca_idconcepto= ?", $idconcepto);
                if ($idequipo) {
                    $q->addWhere("ca_idequipo= ?", $idequipo);
                } else {
                    $q->addWhere("ca_idequipo IS NULL");
                }
                $flete = $q->fetchOne();

                if (!$flete) {
                    $flete = new PricFlete();
                    $flete->setCaIdtrayecto($trayecto->getCaIdtrayecto());
                    $flete->setCaIdconcepto($idconcepto);
                    if ($idequipo) {
                        $flete->setCaIdequipo($idequipo);
                    }
                    $flete->setCaVlrneto(0);
                }

                if ($neta !== null) {
                    $flete->setCaVlrneto($neta);
                }
                if ($sugerida !== null) {
                    $flete->setCaVlrsugerido($sugerida);
                }
                if ($this->getRequestParameter("style") !== null) {
                    if ($this->getRequestParameter("style")) {
                        $flete->setEstilo($this->getRequestParameter("style"));
                    } else {
                        $flete->setEstilo(null);
                    }
                }

                if ($this->getRequestParameter("inicio") !== null) {
                    if ($this->getRequestParameter("inicio")) {
                        $flete->setCaFchinicio($this->getRequestParameter("inicio"));
                    } else {
                        $flete->setCaFchinicio(null);
                    }
                }

                if ($this->getRequestParameter("vencimiento") !== null) {
                    if ($this->getRequestParameter("vencimiento")) {
                        $flete->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
                    } else {
                        $flete->setCaFchvencimiento(null);
                    }
                }

                if ($this->getRequestParameter("moneda")) {
                    $flete->setCaIdmoneda($this->getRequestParameter("moneda"));
                }

                if ($this->getRequestParameter("aplicacion") !== null) {
                    $flete->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
                }
                $user = $this->getUser();
                $flete->setCaUsucreado($user->getUserId());
                $flete->setCaFchcreado(date("Y-m-d H:i:s"));
                $flete->save( $conn );
                $this->responseArray["consecutivo"] = $flete->getCaConsecutivo();
                $this->responseArray["actualizado"] = $flete->getCaUsucreado() . " " . Utils::fechaMes($flete->getCaFchcreado());
            }

            if ($tipo == "recargo") {

                $minima = $this->getRequestParameter("minima");
                $idconcepto = $this->getRequestParameter("idconcepto");
                $idrecargo = $this->getRequestParameter("iditem");

                if ($idconcepto == '')
                    $idconcepto = 9999;
                if ($idconcepto != 9999) {

                    $q = Doctrine::getTable("PricFlete")->createQuery()
                                    ->addWhere("ca_idtrayecto = ?", $trayecto->getCaIdtrayecto())
                                    ->addWhere("ca_idconcepto = ?", $idconcepto);
                    if ($idequipo) {
                        $q->addWhere("ca_idequipo= ?", $idequipo);
                    } else {
                        $q->addWhere("ca_idequipo IS NULL");
                    }
                    $flete = $q->fetchOne();

                    if (!$flete) {
                        $flete = new PricFlete();
                        $flete->setCaIdtrayecto($trayecto->getCaIdtrayecto());
                        $flete->setCaIdconcepto($idconcepto);
                        $flete->setCaVlrneto(0);
                        $flete->save( $conn );
                    }
                }
                //$pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->find(array( $trayecto->getCaIdtrayecto() , $idconcepto , $idrecargo));

                $q = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                                ->addWhere("ca_idtrayecto = ?", $trayecto->getCaIdtrayecto())
                                ->addWhere("ca_idconcepto = ?", $idconcepto)
                                ->addWhere("ca_idrecargo = ?", $idrecargo);
                if ($idequipo) {
                    $q->addWhere("ca_idequipo= ?", $idequipo);
                } else {
                    $q->addWhere("ca_idequipo IS NULL");
                }
                $pricRecargo = $q->fetchOne();

                if (!$pricRecargo) {
                    $pricRecargo = new PricRecargoxConcepto();
                    $pricRecargo->setCaIdtrayecto($trayecto->getCaIdtrayecto());
                    $pricRecargo->setCaIdconcepto($idconcepto);

                    $pricRecargo->setCaIdrecargo($idrecargo);
                    $pricRecargo->setCaVlrrecargo(0);
                    //$pricRecargo->setCaVlrminimo( 0 );
                }

                if ($idequipo) {
                    $pricRecargo->setCaIdequipo($idequipo);
                }

                if ($sugerida !== null) {
                    $pricRecargo->setCaVlrrecargo($sugerida);
                }

                if ($minima !== null) {
                    if ($minima) {
                        $pricRecargo->setCaVlrminimo($minima);
                    } else {
                        $pricRecargo->setCaVlrminimo(null);
                    }
                }

                if ($this->getRequestParameter("moneda")) {
                    $pricRecargo->setCaIdmoneda($this->getRequestParameter("moneda"));
                }

                if ($this->getRequestParameter("inicio") !== null) {
                    if ($this->getRequestParameter("inicio")) {
                        $pricRecargo->setCaFchinicio($this->getRequestParameter("inicio"));
                    } else {
                        $pricRecargo->setCaFchinicio(null);
                    }
                }

                if ($this->getRequestParameter("vencimiento") !== null) {
                    if ($this->getRequestParameter("vencimiento")) {
                        $pricRecargo->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
                    } else {
                        $pricRecargo->setCaFchvencimiento(null);
                    }
                }

                if ($this->getRequestParameter("aplicacion") !== null) {
                    $pricRecargo->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
                }

                if ($this->getRequestParameter("aplicacion_min") !== null) {
                    $pricRecargo->setCaAplicacionMin(utf8_decode($this->getRequestParameter("aplicacion_min")));
                }

                if ($this->getRequestParameter("observaciones") !== null) {
                    $pricRecargo->setCaObservaciones($this->getRequestParameter("observaciones"));
                }

                $user = $this->getUser();
                $pricRecargo->setCaUsucreado($user->getUserId());
                $pricRecargo->setCaFchcreado(date("Y-m-d H:i:s"));
                $pricRecargo->save( $conn );
                $this->responseArray["consecutivo"] = $pricRecargo->getCaConsecutivo();
                $this->responseArray["actualizado"] = $pricRecargo->getCaUsucreado() . " " . Utils::fechaMes($pricRecargo->getCaFchcreado());
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarPanelFletesPorTrayecto() {
        $this->nivel = $this->getNivel();
        $conn = Doctrine::getTable("PricFlete")->getConnection();
        $conn->beginTransaction();
        try {
            if ($this->nivel <= 0) {
                $this->forward404();
            }

            $idtrayecto = $this->getRequestParameter("idtrayecto");
            $idconcepto = $this->getRequestParameter("idconcepto");
            $idrecargo = $this->getRequestParameter("idrecargo");
            $idequipo = $this->getRequestParameter("idequipo");
            $tipo = $this->getRequestParameter("tipo");
            $id = $this->getRequestParameter("id");

            $this->forward404unless($idtrayecto);
            $this->forward404unless($idconcepto);

            $this->responseArray = array("id" => $id, "success" => false);
            if ($tipo == "concepto") {
                $q = Doctrine::getTable("PricFlete")->createQuery()
                                ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                                ->addWhere("ca_idconcepto= ?", $idconcepto);
                if ($idequipo) {
                    $q->addWhere("ca_idequipo= ?", $idequipo);
                } else {
                    $q->addWhere("ca_idequipo IS NULL");
                }
                $pricFlete = $q->fetchOne();

                if ($pricFlete) {
                    //Borra todos los recargos del concepto
                    Doctrine_Query::create()
                            ->delete()
                            ->from("PricRecargoxConcepto r")
                            ->where("r.ca_idtrayecto = ? AND r.ca_idconcepto = ?", array($idtrayecto, $idconcepto))
                            ->execute();
                    $pricFlete->delete( $conn );
                    $this->responseArray["success"] = true;

                    $this->responseArray["idconcepto"] = $idconcepto;
                    $this->responseArray["idtrayecto"] = $idtrayecto;
                }else{
                    $this->responseArray = array("success" => false, "errorInfo" => "No se ha encontrado el recargo o ya se ha eliminado");
                }

            }

            if ($tipo == "recargo") {
                $this->forward404unless($idconcepto);
                //$pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->find(array($idtrayecto , $idconcepto , $idrecargo));
                $q = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                                ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                                ->addWhere("ca_idconcepto= ?", $idconcepto)
                                ->addWhere("ca_idrecargo= ?", $idrecargo);

                if ($idequipo) {
                    $q->addWhere("ca_idequipo= ?", $idequipo);
                } else {
                    $q->addWhere("ca_idequipo IS NULL");
                }
                $pricRecargo = $q->fetchOne();

                if ($pricRecargo) {
                    $pricRecargo->delete( $conn );
                    $this->responseArray["success"] = true;
                }else{
                    $this->responseArray = array("success" => false, "errorInfo" => "No se ha encontrado el recargo o ya se ha eliminado");
                }
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    /*     * *******************************************************************
     * Acciones del PanelRecargosPorCiudad
     *
     * ******************************************************************* */
    /*
     * Provee datos para los recargos por ciudad
     * @author: Andres Botero
     */

    public function executeDatosPanelRecargosPorCiudad() {
        $this->nivel = $this->getNivel();

        $this->opcion = "";
        if ($this->nivel == -1) {
            $this->forward404();
        }

        if ($this->nivel == 0) {
            $this->opcion = "consulta";
        }

        if ($this->getRequestParameter("opcion") == "consulta") {
            $this->opcion = "consulta";
        }

        if ($this->getRequestParameter("readOnly") == "true") {
            $this->opcion = "consulta";
        }
        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $idtrafico = $this->getRequestParameter("idtrafico");
        $modalidad = $this->getRequestParameter("modalidad");
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));

        $this->forward404Unless($transporte);
        $this->forward404Unless($modalidad);
        $this->forward404Unless($impoexpo);
        //$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );

        if (!$idtrafico) {
            $idtrafico = "99-999";
        }
        $q = Doctrine_Query::create()->from("PricRecargoxCiudad r");
        $q->innerJoin("r.TipoRecargo t");
        $q->where("r.ca_idtrafico = ? AND r.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($idtrafico, $transporte, $modalidad, $impoexpo));
        $q->addOrderBy("t.ca_recargo");
        $recargos = $q->execute();

        $this->data = array();
        $i = 0;
        foreach ($recargos as $recargo) {
            $row = array(
                'idtrafico' => $idtrafico,
                'consecutivo' => $recargo->getCaConsecutivo(),
                'idciudad' => $recargo->getCaIdciudad(),
                'ciudad' => utf8_encode($recargo->getCiudad()->getCaCiudad()),
                'idrecargo' => $recargo->getCaIdrecargo(),
                'recargo' => utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
                'inicio' => $recargo->getCaFchinicio(),
                'vencimiento' => $recargo->getCaFchvencimiento(),
                'vlrrecargo' => $recargo->getCaVlrrecargo(),
                'vlrminimo' => $recargo->getCaVlrminimo(),
                'aplicacion' => utf8_encode($recargo->getCaAplicacion()),
                'aplicacion_min' => utf8_encode($recargo->getCaAplicacionMin()),
                'idmoneda' => $recargo->getCaIdmoneda(),
                'observaciones' => utf8_encode($recargo->getCaObservaciones())
            );
            $this->data[] = $row;
        }
        //Si se llama de una cotizacion se mezcla con los recargos por naviera
        $idcotizacion = $this->getRequestParameter("idcotizacion");
        if ($idcotizacion) {
            $q = Doctrine_Query::create()->from("PricRecargoxLinea r");
            $q->innerJoin("r.TipoRecargo t");
            $q->addWhere("t.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($transporte, $modalidad, $impoexpo));
            $q->addWhere("r.ca_idlinea IN (SELECT DISTINCT p.ca_idlinea FROM CotProducto p WHERE p.ca_idcotizacion=? AND ca_idlinea IS NOT NULL)", $idcotizacion);
            $q->addWhere("t.ca_tipo = ?", Constantes::RECARGO_LOCAL);
            $q->addOrderBy("r.ca_idlinea");
            $q->addOrderBy("t.ca_recargo");
            $recargos = $q->execute();           
            foreach ($recargos as $recargo) {
                $row = array(
                    'idtrafico' => $idtrafico,
                    'idlinea' => $recargo->getCaIdlinea(),
                    'linea' => utf8_encode($recargo->getIdsProveedor()->getCaSigla() ? $recargo->getIdsProveedor()->getCaSigla() : $recargo->getIdsProveedor()->getIds()->getCaNombre()),
                    'idrecargo' => $recargo->getCaIdrecargo(),
                    'recargo' => utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
                    'idconcepto' => $recargo->getCaIdconcepto(),
                    'concepto' => utf8_encode($recargo->getConcepto()->getCaConcepto()),
                    'inicio' => $recargo->getCaFchinicio(),
                    'vencimiento' => $recargo->getCaFchvencimiento(),
                    'vlrrecargo' => $recargo->getCaVlrrecargo(),
                    'vlrminimo' => $recargo->getCaVlrminimo(),
                    'aplicacion' => utf8_encode($recargo->getCaAplicacion()),
                    'aplicacion_min' => utf8_encode($recargo->getCaAplicacionMin()),
                    'idmoneda' => $recargo->getCaIdmoneda(),
                    'observaciones' => utf8_encode(($recargo->getCaIdconcepto() != 9999 ? $recargo->getConcepto()->getCaConcepto() : "") . $recargo->getCaObservaciones())
                );
                $this->data[] = $row;
            }
        }

        if ($this->opcion != "consulta") {
            /*
             * Incluye una fila vacia que permite agregar datos
             */
            $row = array(
                'id' => $i++,
                'idtrafico' => $idtrafico,
                'idciudad' => $idtrafico == "99-999" ? '999-9999' : '',
                'ciudad' => '+',
                'idrecargo' => '',
                'recargo' => '',
                'vlrrecargo' => '',
                'vlrminimo' => '',
                'aplicacion' => '',
                'aplicacion_min' => '',
                'idmoneda' => '',
                'observaciones' => ''
            );
            $this->data[] = $row;
        }

        $this->responseArray = array(
            'success' => true,
            'total' => count($this->data),
            'data' => $this->data
        );
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios realizados en los recargos generales
     * @author: Andres Botero
     */

    public function executeGuardarPanelRecargosPorCiudad() {
        $this->nivel = $this->getNivel();
        $conn = Doctrine::getTable("PricRecargoxCiudad")->getConnection();
        $conn->beginTransaction();
        try{
            if ($this->nivel <= 0) {
                $this->forward404();
            }
            $delete = false;
            $consecutivo = $this->getRequestParameter("consecutivo");

            $idtrafico = $this->getRequestParameter("idtrafico");
            $idciudad = $this->getRequestParameter("idciudad");
            $idrecargo = $this->getRequestParameter("idrecargo");
            $modalidad = $this->getRequestParameter("modalidad");
            $impoexpo = $this->getRequestParameter("impoexpo");
            $transporte = $this->getRequestParameter("transporte");

            $this->forward404Unless($idtrafico);
            $this->forward404Unless($idciudad);
            $this->forward404Unless($modalidad);
            $this->forward404Unless($impoexpo);
            $this->forward404Unless($transporte);
            //print_r( array($idtrafico, $idciudad, $idrecargo , $modalidad, utf8_decode($impoexpo)) );
            $recargo = Doctrine::getTable("PricRecargoxCiudad")->find(array($idtrafico, $idciudad, $idrecargo, $modalidad, utf8_decode($impoexpo), utf8_decode($transporte)));
            if (!$recargo) {
                $recargo = new PricRecargoxCiudad();
                $recargo->setCaIdtrafico($idtrafico);
                $recargo->setCaIdciudad($idciudad);
                $recargo->setCaIdrecargo($idrecargo);
                $recargo->setCaModalidad($modalidad);
                $recargo->setCaImpoexpo(utf8_decode($impoexpo));
                $recargo->setCaTransporte(utf8_decode($transporte));
                $recargo->setCaVlrrecargo(0);
                $recargo->setCaVlrminimo(0);
                if ($consecutivo > 0)
                    $delete = true;
            }

            $user = $this->getUser();
            $recargo->setCaUsucreado($user->getUserId());
            $recargo->setCaFchcreado(date("Y-m-d H:i:s"));

            if ($this->getRequestParameter("inicio") !== null) {
                if ($this->getRequestParameter("inicio")) {
                    $recargo->setCaFchinicio($this->getRequestParameter("inicio"));
                } else {
                    $recargo->setCaFchinicio(null);
                }
            }

            if ($this->getRequestParameter("vencimiento") !== null) {
                if ($this->getRequestParameter("vencimiento")) {
                    $recargo->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
                } else {
                    $recargo->setCaFchvencimiento(null);
                }
            }

            if ($this->getRequestParameter("vlrrecargo") !== null) {
                $recargo->setCaVlrrecargo($this->getRequestParameter("vlrrecargo"));
            }

            if ($this->getRequestParameter("vlrminimo") !== null) {
                if ($this->getRequestParameter("vlrminimo")) {
                    $recargo->setCaVlrminimo($this->getRequestParameter("vlrminimo"));
                } else {
                    $recargo->setCaVlrminimo(null);
                }
            }

            if ($this->getRequestParameter("idmoneda")) {
                $recargo->setCaIdmoneda($this->getRequestParameter("idmoneda"));
            }

            if ($this->getRequestParameter("aplicacion") !== null) {
                $recargo->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
            }

            if ($this->getRequestParameter("aplicacion_min") !== null) {
                $recargo->setCaAplicacionMin(utf8_decode($this->getRequestParameter("aplicacion_min")));
            }

            if ($this->getRequestParameter("observaciones") !== null) {
                $recargo->setCaObservaciones(utf8_decode($this->getRequestParameter("observaciones")));
            }

            $recargo->save( $conn );
            $id = $this->getRequestParameter("id");

            if ($delete) {   //echo $consecutivo;
                $recargo = Doctrine::getTable("PricRecargoxCiudad")->findOneBy("ca_consecutivo", $consecutivo);
                if ($recargo) {
                    //  echo $recargo->getCaConsecutivo();
                    $recargo->delete( $conn );
                }
            }
            $this->responseArray = array("id" => $id, "success" => true);

            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
        $this->setTemplate("responseTemplate");
    }

    /*
     * Elimina un recargo general
     * @author: Andres Botero
     */

    public function executeEliminarPanelRecargosPorCiudad() {
        
        $conn = Doctrine::getTable("PricRecargoxCiudad")->getConnection();
        $conn->beginTransaction();
        try{

            $this->nivel = $this->getNivel();

            if ($this->nivel <= 0) {
                $this->forward404();
            }
            $idtrafico = $this->getRequestParameter("idtrafico");
            $idciudad = $this->getRequestParameter("idciudad");
            $idrecargo = $this->getRequestParameter("idrecargo");
            $modalidad = $this->getRequestParameter("modalidad");
            $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
            $transporte = utf8_decode($this->getRequestParameter("transporte"));
            $id = $this->getRequestParameter("id");

            $this->forward404Unless($idtrafico);
            $this->forward404Unless($idciudad);
            $this->forward404Unless($modalidad);
            $this->forward404Unless($impoexpo);
            $recargo = Doctrine::getTable("PricRecargoxCiudad")->find(array($idtrafico, $idciudad, $idrecargo, $modalidad, $impoexpo, $transporte));
            $this->responseArray = array("id" => $id, "success" => false);

            if ($recargo) {
                $recargo->delete( $conn );
                $this->responseArray["success"] = true;
            }else{
                $this->responseArray = array("success" => false, "errorInfo" => "No se ha encontrado el recargo o ya se ha eliminado");
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosEditorCiudades($request) {

        $idtrafico = $request->getParameter("idtrafico");

        $ciudades = Doctrine::getTable("Ciudad")
                        ->createQuery("c")
                        ->where("c.ca_idtrafico = ? ", $idtrafico)
                        ->addOrderBy("c.ca_ciudad")
                        ->execute();
        $data = array();
        $data[] = array("idciudad" => "999-9999",
            "ciudad" => "Todas las ciudades");
        foreach ($ciudades as $ciudad) {
            $data[] = array("idciudad" => $ciudad->getCaIdciudad(),
                "ciudad" => utf8_encode($ciudad->getCaCiudad()));
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    /*     * *******************************************************************
     * Recargos x linea
     *
     * ******************************************************************* */
    /*
     * Provee datos para los recargos por ciudad
     * @author: Andres Botero
     */

    public function executeDatosPanelRecargosPorLinea() {

        $this->nivel = $this->getNivel();

        $this->opcion = "";
        if ($this->nivel == -1) {
            $this->forward404();
        }

        if ($this->nivel == 0) {
            $this->opcion = "consulta";
        }

        if ($this->getRequestParameter("readOnly") == "true") {
            $this->opcion = "consulta";
        }

        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $idtrafico = $this->getRequestParameter("idtrafico");
        $modalidad = $this->getRequestParameter("modalidad");
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $idlinea = $this->getRequestParameter("idlinea");

        $this->forward404Unless($transporte);
        $this->forward404Unless($modalidad);
        $this->forward404Unless($impoexpo);
        //$this->trafico = TraficoPeer::retrieveByPk( $idtrafico );
        if (!$idtrafico) {
            $idtrafico = "99-999";
        }
        if ($idtrafico == "99-999") {
            $this->forward404Unless($idlinea);
        }
        if ($this->getRequestParameter("fechacambio")) {
            $fechacambio = str_replace("|", "-", $this->getRequestParameter("fechacambio"));
            $timestamp = strtotime($fechacambio . " " . $this->getRequestParameter("horacambio"));
            $this->opcion = "consulta";
        } else {
            $timestamp = null;
        }
        if ($timestamp) {
            $fchcorte = date("Y-m-d H:i:s", $timestamp);
        } else {
            $fchcorte = date("Y-m-d H:i:s");
        }
        
        if ($timestamp) {
            $q = Doctrine_Query::create()->from("PricRecargoxLineaBs r");
            $q->addWhere("r.ca_fchcreado IN (SELECT rh.ca_fchcreado FROM PricRecargoxLineaBs rh WHERE rh.ca_fchcreado<= ?
                    AND r.ca_idtrafico = rh.ca_idtrafico AND r.ca_idlinea = rh.ca_idlinea AND r.ca_modalidad = rh.ca_modalidad AND r.ca_impoexpo = rh.ca_impoexpo AND r.ca_idrecargo = rh.ca_idrecargo
                     ORDER BY rh.ca_consecutivo DESC LIMIT 1 )", $fchcorte);
        } else {
            $q = Doctrine_Query::create()->from("PricRecargoxLinea r");
        }

        //$q = Doctrine_Query::create()->from("PricRecargoxLinea r");
        $q->innerJoin("r.TipoRecargo t");
        $q->addWhere("r.ca_idtrafico = ? AND r.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?", array($idtrafico, $transporte, $modalidad, $impoexpo));
        if ($idtrafico == "99-999") {
            $q->addWhere("r.ca_idlinea = ?", $idlinea);
        }
        $q->addOrderBy("r.ca_idlinea");
        $q->addOrderBy("t.ca_recargo");
        $recargos = $q->execute();
        //echo $q->getSqlQuery();

        $this->data = array();
        $i = 0;

        foreach ($recargos as $recargo) {
            
            if ($recargo->getCaFcheliminado()) {
                continue;
            }
            $row = array(
                'id' => $i++,
                'consecutivo' => $recargo->getCaConsecutivo(),
                'idtrafico' => $idtrafico,
                'idlinea' => $recargo->getCaIdlinea(),
                'linea' => utf8_encode($recargo->getIdsProveedor()->getCaSigla()?$recargo->getIdsProveedor()->getCaSigla():$recargo->getIdsProveedor()->getIds()->getCaNombre()),
                'idrecargo' => $recargo->getCaIdrecargo(),
                'recargo' => utf8_encode($recargo->getTipoRecargo()->getCaRecargo()),
                'idconcepto' => $recargo->getCaIdconcepto(),
                'concepto' => $recargo->getCaIdconcepto() == 9999 ? "Aplica para todos" : utf8_encode($recargo->getConcepto()->getCaConcepto()),
                'inicio' => $recargo->getCaFchinicio(),
                'vencimiento' => $recargo->getCaFchvencimiento(),
                'vlrrecargo' => $recargo->getCaVlrrecargo(),
                'vlrminimo' => $recargo->getCaVlrminimo(),
                'aplicacion' => utf8_encode($recargo->getCaAplicacion()),
                'aplicacion_min' => utf8_encode($recargo->getCaAplicacionMin()),
                'idmoneda' => $recargo->getCaIdmoneda(),
                'observaciones' => utf8_encode($recargo->getCaObservaciones())
            );
            $this->data[] = $row;
        }


        if ($this->opcion != "consulta") {
            /*
             * Incluye una fila vacia que permite agregar datos
             */
            $row = array(
                'id' => $i++,
                'idtrafico' => $idtrafico,
                'idlinea' => $idlinea ? $idlinea : "",
                'linea' => '+',
                'idrecargo' => '',
                'recargo' => '',
                'vlrrecargo' => '',
                'vlrminimo' => '',
                'aplicacion' => '',
                'aplicacion_min' => '',
                'idmoneda' => '',
                'observaciones' => ''
            );
            $this->data[] = $row;
        }
        $this->responseArray = array(
            'success' => true,
            'total' => count($this->data),
            'data' => $this->data
        );
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios realizados en los recargos generales
     * @author: Andres Botero
     */

    public function executeGuardarPanelRecargosPorLinea() {
        $conn = Doctrine::getTable("PricRecargoxCiudad")->getConnection();
        $conn->beginTransaction();
        try{
            $this->nivel = $this->getNivel();
            if ($this->nivel <= 0) {
                $this->forward404();
            }

            $delete = false;
            $consecutivo = $this->getRequestParameter("consecutivo");
            $idtrafico = $this->getRequestParameter("idtrafico");
            $idlinea = $this->getRequestParameter("idlinea");
            $idrecargo = $this->getRequestParameter("idrecargo");
            $idconcepto = $this->getRequestParameter("idconcepto");
            $modalidad = $this->getRequestParameter("modalidad");
            $impoexpo = $this->getRequestParameter("impoexpo");
            $transporte = $this->getRequestParameter("transporte");
            //echo $impoexpo;


            if (!$idconcepto) {
                $idconcepto = 9999;
            }

            $this->forward404Unless($idtrafico);
            $this->forward404Unless($idlinea);
            $this->forward404Unless($modalidad);
            $this->forward404Unless($impoexpo);

            $recargo = Doctrine::getTable("PricRecargoxLinea")->find(array($idtrafico, $idlinea, $idrecargo, $idconcepto, $modalidad, utf8_decode($impoexpo), utf8_decode($transporte)));
            if (!$recargo) {

                $recargo = new PricRecargoxLinea();
                $recargo->setCaIdtrafico($idtrafico);
                $recargo->setCaIdlinea($idlinea);
                $recargo->setCaIdrecargo($idrecargo);
                $recargo->setCaModalidad($modalidad);
                $recargo->setCaTransporte(utf8_decode($transporte));
                $recargo->setCaImpoexpo(utf8_decode($impoexpo));
                $recargo->setCaVlrrecargo(0);
    //                        echo $consecutivo;
                if ($consecutivo > 0)
                    $delete = true;
            }
            $user = $this->getUser();
            $recargo->setCaUsucreado($user->getUserId());
            $recargo->setCaFchcreado(date("Y-m-d H:i:s"));


            if ($this->getRequestParameter("idconcepto")) {
                $recargo->setCaIdconcepto($this->getRequestParameter("idconcepto"));
            }

            if ($this->getRequestParameter("inicio") !== null) {
                if ($this->getRequestParameter("inicio")) {
                    $recargo->setCaFchinicio($this->getRequestParameter("inicio"));
                } else {
                    $recargo->setCaFchinicio(null);
                }
            }
            if ($this->getRequestParameter("vencimiento") !== null) {
                if ($this->getRequestParameter("vencimiento")) {
                    $recargo->setCaFchvencimiento($this->getRequestParameter("vencimiento"));
                } else {
                    $recargo->setCaFchvencimiento(null);
                }
            }
            if ($this->getRequestParameter("vlrrecargo") !== null) {
                $recargo->setCaVlrrecargo($this->getRequestParameter("vlrrecargo"));
            }

            if ($this->getRequestParameter("vlrminimo") !== null) {
                if ($this->getRequestParameter("vlrminimo")) {
                    $recargo->setCaVlrminimo($this->getRequestParameter("vlrminimo"));
                } else {
                    $recargo->setCaVlrminimo(null);
                }
            }

            if ($this->getRequestParameter("idmoneda")) {
                $recargo->setCaIdmoneda($this->getRequestParameter("idmoneda"));
            }

            if ($this->getRequestParameter("aplicacion") !== null) {
                $recargo->setCaAplicacion(utf8_decode($this->getRequestParameter("aplicacion")));
            }

            if ($this->getRequestParameter("aplicacion_min") !== null) {
                $recargo->setCaAplicacionMin(utf8_decode($this->getRequestParameter("aplicacion_min")));
            }

            if ($this->getRequestParameter("observaciones") !== null) {
                $recargo->setCaObservaciones(utf8_decode($this->getRequestParameter("observaciones")));
            }

            $recargo->save( $conn );
            $id = $this->getRequestParameter("id");

            if ($delete) {   //echo $consecutivo;
                $recargo = Doctrine::getTable("PricRecargoxLinea")->findOneBy("ca_consecutivo", $consecutivo);
                if ($recargo) {
                    //  echo $recargo->getCaConsecutivo();
                    $recargo->delete( $conn );
                }
            }
            $this->responseArray = array("id" => $id, "success" => true);
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    /*
     * Elimina un recargo general
     * @author: Andres Botero
     */

    public function executeEliminarPanelRecargosPorLinea() {
        $conn = Doctrine::getTable("PricRecargoxCiudad")->getConnection();
        $conn->beginTransaction();
        try{
            $this->nivel = $this->getNivel();

            if ($this->nivel <= 0) {
                $this->forward404();
            }

            $idtrafico = $this->getRequestParameter("idtrafico");
            $idlinea = $this->getRequestParameter("idlinea");
            $idrecargo = $this->getRequestParameter("idrecargo");
            $idconcepto = $this->getRequestParameter("idconcepto");
            $modalidad = $this->getRequestParameter("modalidad");
            $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
            $transporte = utf8_decode($this->getRequestParameter("transporte"));

            if (!$idconcepto) {
                $idconcepto = 9999;
            }

            $this->forward404Unless($idtrafico);
            $this->forward404Unless($idlinea);
            $this->forward404Unless($modalidad);
            $this->forward404Unless($impoexpo);
            $id = $this->getRequestParameter("id");
            $this->responseArray = array("id" => $id, "success" => true);
            $recargo = Doctrine::getTable("PricRecargoxLinea")->find(array($idtrafico, $idlinea, $idrecargo, $idconcepto, $modalidad, $impoexpo, $transporte));

            if ($recargo) {
                $recargo->delete( $conn );
                $this->responseArray["success"] = true;
            }else{
                $this->responseArray = array("success" => false, "errorInfo" => "No se ha encontrado el recargo o ya se ha eliminado");
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Retorna un objeto JSON con la información de todas las lineas
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosEditorLineas($request) {
        $idtrafico = utf8_decode($request->getParameter("idtrafico"));
        $impoexpo = utf8_decode($request->getParameter("impoexpo"));
        $transporte = utf8_decode($request->getParameter("transporte"));
        $modalidad = utf8_decode($request->getParameter("modalidad"));
        $query = utf8_decode($request->getParameter("query"));

        $q = Doctrine_Query::create()
                        ->select("p.ca_idproveedor, id.ca_nombre, p.ca_transporte ")
                        ->from("IdsProveedor p")
                        ->innerJoin("p.Ids id")
                        ->addOrderBy("id.ca_nombre");

        if ($transporte) {
            $q->where("p.ca_transporte = ?", $transporte);
        }

        if ($query) {
            $q->addWhere("id.ca_nombre like ?", $query . "%");
        }
        //$q->addWhere("p.ca_activo = ?", true );

        $q->fetchArray();
        $lineas = $q->execute();
        $q = Doctrine_Query::create()
                        ->select("p.ca_idproveedor, id.ca_nombre, p.ca_sigla")
                        ->from("IdsProveedor p")
                        ->innerJoin("p.Trayecto t")
                        ->innerJoin("p.Ids id")
                        ->where("t.ca_impoexpo = ?", $impoexpo)
                        ->addWhere("t.ca_transporte = ?", $transporte)
                        ->addWhere("t.ca_modalidad = ?", $modalidad)
                        ->addOrderBy("id.ca_nombre");

        if ($impoexpo == Constantes::IMPO) {
            $q->innerJoin("t.Origen c");
        } else {
            $q->innerJoin("t.Destino c");
        }

        if ($idtrafico != "99-999") {
            $q->addWhere("c.ca_idtrafico = ?", $idtrafico);
        }
        $q->distinct();
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $lineas = $q->execute();
        $this->lineas = array();
        foreach ($lineas as $linea) {
            $this->lineas[] = array("idlinea" => $linea['p_ca_idproveedor'],
                "linea" => utf8_encode($linea['p_ca_sigla']?$linea['p_ca_sigla']:$linea['id_ca_nombre']),
                "transporte" => utf8_encode($transporte),
            );
        }

        $this->responseArray = array("root" => $this->lineas, "total" => count($this->lineas), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Retorna un objeto JSON con la información de todas las conceptos
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosEditorConceptos($request) {

        $impoexpo = utf8_decode($request->getParameter("impoexpo"));
        $transporte = utf8_decode($request->getParameter("transporte"));
        $modalidad = utf8_decode($request->getParameter("modalidad"));

        $conceptos = Doctrine::getTable("Concepto")
                        ->createQuery("c")
                        ->select("c.ca_idconcepto, c.ca_concepto")
                        ->where("c.ca_transporte = ? AND c.ca_modalidad= ?", array($transporte, $modalidad))
                        ->addOrderBy("c.ca_concepto")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        $this->conceptos = array();
        $this->conceptos[] = array("idconcepto" => '9999', "concepto" => 'Aplica para todos');
        foreach ($conceptos as $concepto) {
            $this->conceptos[] = array("idconcepto" => $concepto['c_ca_idconcepto'],
                "concepto" => utf8_encode($concepto['c_ca_concepto'])
            );
        }
        $this->responseArray = array("root" => $this->conceptos, "total" => count($this->conceptos), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*     * *******************************************************************
     * Parametros recargos locales naviera
     *
     * ******************************************************************* */
    /*
     * Datos para los parametros de los recargos locales x naviera
     * @author: Andres Botero
     */

    public function executeDatosPanelRecargosLocalesParametros($request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel == -1) {
            $this->forward404();
        }
        $this->opcion = "";
        if ($this->getRequestParameter("readOnly") == "true") {
            $this->opcion = "consulta";
        }

        if ($this->nivel <= 0) {
            $this->opcion = "consulta";
        }		
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));

        
		
		$modalidad = utf8_decode($this->getRequestParameter( "modalidad" ));
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$idlinea = $this->getRequestParameter( "idlinea" );		
						
		$this->forward404Unless( $transporte );
		$this->forward404Unless( $modalidad );			
		$this->forward404Unless( $impoexpo );
		$this->forward404Unless( $idlinea );		
		//Se determina la identificacion del parametro para determinar en la vista que 
		//editor se va a usar
		$conceptos = array();
		$param = ParametroTable::retrieveByCaso("CU071");
		foreach( $param as $p ){
			$conceptos[ $p->getCaIdentificacion() ]=$p->getCaValor();
		}				
		$parametros = Doctrine::getTable("PricRecargoParametro")
                                ->createQuery("p")
                                ->where("p.ca_impoexpo = ? AND p.ca_transporte = ? AND p.ca_idlinea = ? and p.ca_modalidad = ? ", array($impoexpo, $transporte, $idlinea, $modalidad))
                                ->execute();					
		$data = array();
		$i=0;		
		foreach( $parametros as $parametro ){
			$row = array(
				'idconcepto'=>array_search($parametro->getCaConcepto(),$conceptos ),
				'concepto'=>utf8_encode($parametro->getCaConcepto()),
				'valor'=>utf8_encode($parametro->getCaValor()),
				'observaciones'=>utf8_encode($parametro->getCaObservaciones())						
			);
			$data[]= $row;
		}
		if( $this->opcion != "consulta" ){
			/*
			* Incluye una fila vacia que permite agregar datos
			*/
			$row = array(
				'concepto'=>'+',
				'valor'=>'',
				'observaciones'=>''					
			);
			$data[]= $row;
		}		
		$this->responseArray = array("total"=>count($data), "data"=>$data ,"success"=>true);	
		$this->setTemplate("responseTemplate");
	}	
	/*
	* Guarda los cambios de un parametro de los recargos locales
	* @author: Andres Botero
	*/
	public function executeGuardarPanelRecargosLocalesParametros( $request ){		
        $this->nivel = $this->getNivel();
        if ($this->nivel <= 0) {
            $this->forward404();
        }

        $idlinea = $this->getRequestParameter("idlinea");
        $modalidad = utf8_decode($this->getRequestParameter("modalidad"));
        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $concepto = utf8_decode($this->getRequestParameter("concepto"));

        $this->forward404Unless($transporte);
        $this->forward404Unless($idlinea);
        $this->forward404Unless($modalidad);
        $this->forward404Unless($impoexpo);
        $this->forward404Unless($concepto);

        $parametro = Doctrine::getTable("PricRecargoParametro")->find(array($idlinea, $transporte, $modalidad, $impoexpo, $concepto));

        if (!$parametro) {
            $parametro = new PricRecargoParametro();
            $parametro->setCaIdlinea($idlinea);
            $parametro->setCaImpoexpo($impoexpo);
            $parametro->setCaTransporte($transporte);
            $parametro->setCaModalidad($modalidad);
            $parametro->setCaConcepto($concepto);

            $parametro->setCaUsucreado($this->getUser()->getUserId());
            $parametro->setCaFchcreado(time());
        }
        if ($this->getRequestParameter("valor")) {
            $parametro->setCaValor(utf8_decode($this->getRequestParameter("valor")));
        }
        if ($this->getRequestParameter("observaciones") !== null) {
            $parametro->setCaObservaciones(utf8_decode($this->getRequestParameter("observaciones")));
        }
        $parametro->save();
        $id = $this->getRequestParameter("id");
        $this->responseArray = array("id" => $id, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Permite la administración y consulta de los trayectos (tiempos de transito
     * y frecuencia)
     * @author: Andres Botero
     */

    public function executeEliminarPanelRecargosLocalesParametros($request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }
        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $modalidad = utf8_decode($this->getRequestParameter("modalidad"));
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $idlinea = $this->getRequestParameter("idlinea");
        $concepto = utf8_decode($this->getRequestParameter("concepto"));

        $this->forward404Unless($transporte);
        $this->forward404Unless($modalidad);
        $this->forward404Unless($impoexpo);
        $this->forward404Unless($idlinea);
        $this->forward404Unless($concepto);

        $parametro = Doctrine::getTable("PricRecargoParametro")->find(array($idlinea, $transporte, $modalidad, $impoexpo, $concepto));
        $success = false;
        if ($parametro) {
            $parametro->delete();
            $success = true;
        }
        $id = $this->getRequestParameter("id");
        $this->responseArray = array("id" => $id, "success" => $success);
        $this->setTemplate("responseTemplate");
    }

    /*     * *******************************************************************
     * Patios recargos locales x naviera
     *
     * ******************************************************************* */

    public function executeDatosPanelRecargosLocalesPatios() {
        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $modalidad = utf8_decode($this->getRequestParameter("modalidad"));
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $idlinea = $this->getRequestParameter("idlinea");

        $this->nivel = $this->getNivel();

        if ($this->nivel == -1) {
            $this->forward404();
        }

        if ($this->getRequestParameter("readOnly") == "true") {
            $this->opcion = "consulta";
        }

        if ($this->nivel <= 0) {
            $this->opcion = "consulta";
        }

        $this->forward404Unless($transporte);
        $this->forward404Unless($modalidad);
        $this->forward404Unless($impoexpo);
        $this->forward404Unless($idlinea);

        $patiosLineas = Doctrine::getTable("PricPatioLinea")
                        ->createQuery("p")
                        ->where("p.ca_impoexpo = ? AND p.ca_transporte = ? AND p.ca_idlinea = ? and p.ca_modalidad = ? ", array($impoexpo, $transporte, $idlinea, $modalidad))
                        ->distinct()
                        ->execute();

        $patiosLineaArray = array();

        foreach ($patiosLineas as $pl) {
            $patiosLineaArray[$pl->getCaIdpatio()] = $pl->getCaObservaciones();
        }

        $patios = Doctrine::getTable("PricPatio")
                        ->createQuery("p")
                        ->innerJoin("p.Ciudad c")
                        ->addOrderBy("c.ca_ciudad")
                        ->addOrderBy("p.ca_nombre")
                        ->distinct()
                        ->execute();
        $data = array();
        $i = 0;
        foreach ($patios as $patio) {

            if (array_key_exists($patio->getCaIdpatio(), $patiosLineaArray)) {

                $sel = true;
                $observaciones = $patiosLineaArray[$patio->getCaIdpatio()];
            } else {
                $sel = false;
                $observaciones = "";
                if ($this->opcion == "consulta") {
                    continue;
                }
            }

            $row = array(
                'sel' => $sel,
                'idpatio' => $patio->getCaIdpatio(),
                'nombre' => utf8_encode($patio->getCaNombre()),
                'direccion' => utf8_encode($patio->getCaDireccion()),
                'ciudad' => utf8_encode($patio->getCiudad()->getCaCiudad()),
                'observaciones' => utf8_encode($observaciones)
            );
            $data[] = $row;
        }
        $this->responseArray = array("total" => count($data), "data" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*     * *******************************************************************
     * Administrador de trayectos, tiempos de transito y frecuencias
     *
     * ******************************************************************* */

    public function executeGuardarPanelRecargosLocalesPatios($request) {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }

        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $modalidad = utf8_decode($this->getRequestParameter("modalidad"));
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $idlinea = $this->getRequestParameter("idlinea");
        $patios = $this->getRequestParameter("patios");

        $this->forward404Unless($transporte);
        $this->forward404Unless($modalidad);
        $this->forward404Unless($impoexpo);
        $this->forward404Unless($idlinea);

        $this->nivel = $this->getNivel();

        if ($this->nivel < 1) {
            $this->forward404();
        }
        //Borra todo
        Doctrine_Query::create()
                ->delete()
                ->from("PricPatioLinea p")
                ->where("p.ca_impoexpo = ? AND p.ca_transporte = ? AND p.ca_idlinea = ? and p.ca_modalidad = ? ", array($impoexpo, $transporte, $idlinea, $modalidad))
                ->distinct()
                ->execute();
        if ($patios) {

            $patios = explode("|", $patios);
            foreach ($patios as $patio) {
                $idx = strpos($patio, ",");
                $idpatio = substr($patio, 0, $idx);
                $observaciones = substr($patio, $idx + 1);

                $patio = new PricPatioLinea();
                $patio->setCaIdpatio($idpatio);
                if ($observaciones) {
                    $patio->setCaObservaciones(utf8_encode($observaciones));
                } else {
                    $patio->setCaObservaciones(null);
                }
                $patio->setCaTransporte($transporte);
                $patio->setCaModalidad($modalidad);
                $patio->setCaImpoexpo($impoexpo);
                $patio->setCaIdlinea($idlinea);
                $patio->save();
            }
        }
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Permite la administración y consulta de los trayectos (tiempos de transito
     * y frecuencia)
     * @author: Andres Botero
     */
    /*
     * Muestra los datos para la administración de trayectos
     */

    public function executeDatosPanelTrayecto() {

        $this->nivel = $this->getNivel();

        $this->opcion = "";
        if ($this->nivel == -1) {
            $this->forward404();
        }

        if ($this->nivel == 0) {
            $this->opcion = "consulta";
        }

        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $idtrafico = $this->getRequestParameter("idtrafico");
        $modalidad = $this->getRequestParameter("modalidad");
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $start = $this->getRequestParameter("start");
        $limit = $this->getRequestParameter("limit");

        $this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);

        $q = Doctrine::getTable("Trayecto")
                        ->createQuery("t")
                        ->select("t.*, o.ca_idciudad, d.ca_idciudad, o.ca_ciudad, d.ca_ciudad, to.ca_nombre, td.ca_nombre, i.ca_nombre, p.ca_sigla, ag.ca_nombre")
                        ->where("t.ca_transporte = ? AND t.ca_modalidad = ? AND t.ca_impoexpo = ?", array($transporte, $modalidad, $impoexpo))
                        ->innerJoin("t.IdsProveedor p")
                        ->innerJoin("p.Ids i")
                        ->leftJoin("t.IdsAgente a")
                        ->leftJoin("a.Ids ag")
                        ->addOrderBy("i.ca_nombre");

        $q->innerJoin("t.Origen o");
        $q->innerJoin("o.Trafico to");
        $q->innerJoin("t.Destino d");
        $q->innerJoin("d.Trafico td");
        if ($impoexpo == Constantes::EXPO) {
            $q->addWhere("d.ca_idtrafico = ?", $idtrafico);
        } else {
            $q->addWhere("o.ca_idtrafico = ?", $idtrafico);
        }
        $trayectos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();
        $data = array();
        $transportador_id = null;
        foreach ($trayectos as $trayecto) {

            $row = array(
                'idtrayecto' => $trayecto["t_ca_idtrayecto"],
                'origen' => utf8_encode($trayecto["o_ca_ciudad"]),
                'destino' => utf8_encode($trayecto["d_ca_ciudad"]),
                'agente' => utf8_encode($trayecto["ag_ca_nombre"]),
                'linea' => utf8_encode(($trayecto["p_ca_sigla"]?$trayecto["p_ca_sigla"]." - ":"").$trayecto["i_ca_nombre"]),
                'idlinea' => $trayecto["t_ca_idlinea"],
                'ttransito' => utf8_encode($trayecto["t_ca_tiempotransito"]),
                'frecuencia' => $trayecto["t_ca_frecuencia"],
                'activo' => $trayecto["t_ca_activo"],
                'netnet' => $trayecto["t_ca_netnet"]
            );
            $data[] = $row;
        }
        $this->responseArray = array("total" => count($data), "data" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios realizados en la grilla de administración de trayectos (TT, Freq)
     */

    public function executeObserveAdminTrayectos() {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }

        $idtrayecto = $this->getRequestParameter("idtrayecto");
        $trayecto = Doctrine::getTable("Trayecto")->find($idtrayecto);
        $this->forward404Unless($trayecto);

        if ($this->getRequestParameter("ttransito")) {
            $trayecto->setCaTiempotransito(utf8_decode($this->getRequestParameter("ttransito")));
        }

        if ($this->getRequestParameter("frecuencia")) {
            $trayecto->setCaFrecuencia(utf8_decode($this->getRequestParameter("frecuencia")));
        }

        if ($this->getRequestParameter("activo") !== null) {

            if ($this->getRequestParameter("activo") == "true") {
                $trayecto->setCaActivo(true);
            } else {
                $trayecto->setCaActivo(false);
            }
        }

        if ($this->getRequestParameter("netnet") !== null) {

            if ($this->getRequestParameter("netnet") == "true") {
                $trayecto->setCaNetnet(true);
            } else {
                $trayecto->setCaNetnet(false);
            }
        }
        $trayecto->save();
        $id = $this->getRequestParameter("id");
        $this->responseArray = array("id" => $id, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*     * *******************************************************************
     * Seguros
     *
     * ******************************************************************* */

    public function executeGrillaSeguros() {

        $this->nivel = $this->getNivel();

        $this->opcion = "";
        if ($this->nivel == -1) {
            $this->forward404();
        }

        if ($this->nivel == 0) {
            $this->opcion = "consulta";
        }

        $this->transporte = utf8_decode($this->getRequestParameter("transporte"));
        $this->forward404Unless($this->transporte);

        $this->idcomponent = "seguros_" . $this->transporte;

        $grupos = Doctrine::getTable("TraficoGrupo")
                        ->createQuery("g")
                        ->addOrderBy("g.ca_descripcion")
                        ->execute();

        $this->data = array();
        foreach ($grupos as $grupo) {
            $row = array(
                'idgrupo' => $grupo->getCaIdgrupo(),
                'grupo' => utf8_encode($grupo->getCaDescripcion())
            );
            $seguro = Doctrine::getTable("PricSeguro")->find(array($grupo->getCaIdgrupo(), $this->transporte));
            if ($seguro) {
                $row['vlrprima'] = $seguro->getCaVlrprima();
                $row['vlrminima'] = $seguro->getCaVlrminima();
                $row['vlrobtencionpoliza'] = $seguro->getCaVlrobtencionpoliza();
                $row['idmoneda'] = $seguro->getCaIdmoneda();
                $row['idmonedaobtencion'] = $seguro->getCaIdmonedaobtencion();
                $row['observaciones'] = $seguro->getCaObservaciones();
            }
            $this->data[] = $row;
        }
        //print_r($this->data);
    }

    /*
     * Guarda los datos de los seguros
     */

    public function executeObserveGrillaSeguros() {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }
        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $idgrupo = utf8_decode($this->getRequestParameter("idgrupo"));
        $id = $this->getRequestParameter("id");
        $this->forward404Unless($transporte);
        $this->forward404Unless($idgrupo);

        $seguro = Doctrine::getTable("PricSeguro")->find(array($idgrupo, $transporte));
        if (!$seguro) {
            $seguro = new PricSeguro();
            $seguro->setCaIdGrupo($idgrupo);
            $seguro->setCaTransporte($transporte);
        }

        if ($this->getRequestParameter("vlrprima")) {
            $seguro->setCaVlrprima($this->getRequestParameter("vlrprima"));
        }

        if ($this->getRequestParameter("vlrminima")) {
            $seguro->setCaVlrminima($this->getRequestParameter("vlrminima"));
        }

        if ($this->getRequestParameter("vlrobtencionpoliza")) {
            $seguro->setCaVlrobtencionpoliza($this->getRequestParameter("vlrobtencionpoliza"));
        }

        if ($this->getRequestParameter("idmoneda")) {
            $seguro->setCaIdmoneda($this->getRequestParameter("idmoneda"));
        }
        if ($this->getRequestParameter("idmonedaobtencion")) {
            $seguro->setCaIdmonedaobtencion($this->getRequestParameter("idmonedaobtencion"));
        }

        if ($this->getRequestParameter("observaciones") !== null) {
            $seguro->setCaObservaciones($this->getRequestParameter("observaciones"));
        }
        $seguro->save();

        $this->responseArray = array("success" => true, "id" => $id);
        $this->setTemplate("responseTemplate");
    }

    /*     * *******************************************************************
     * Datos panelCiudades
     *
     * ******************************************************************* */
    /*
     * Muestra las ciudades y las devuelve en forma de arbol, el cliente
     * toma los datos y los coloca en un objeto Ext.tree.TreePanel
     * Los nodos de las ciudades y las lineas se cargan cuando el usuario
     * hace click sobre los iconos ciudad y lineas
     * @author: Andres Botero
     */

    public function executeDatosCiudades($request) {

        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));

        $node = $this->getRequestParameter("node");

        $this->nivel = $this->getNivel();

        if (substr($node, 0, 4) != "traf") {
            $modalidad = utf8_decode($this->getRequestParameter("modalidad"));
            if ($modalidad == Constantes::ADUANA) {
                $this->setTemplate("datosAduana");
            } else {
                $q = Doctrine_Query::create()
                                ->select("t.ca_modalidad, tg.ca_descripcion, tr.ca_nombre, tr.ca_idtrafico")
                                ->distinct()
                                ->from("Trayecto t");
                if ($impoexpo == Constantes::IMPO) {
                    $q->innerJoin("t.Origen c");
                } else {
                    $q->innerJoin("t.Destino c");
                }
                $q->innerJoin("c.Trafico tr");
                $q->innerJoin("tr.TraficoGrupo tg");

                $q->where("t.ca_impoexpo = ? ", $impoexpo);
                $q->addWhere("t.ca_transporte = ? ", $transporte);
                $q->addWhere("t.ca_activo = ? ", true);

                $q->addOrderBy("t.ca_modalidad ASC");
                $q->addOrderBy("tg.ca_descripcion ASC");
                $q->addOrderBy("tr.ca_nombre ASC");
                $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);

                $rows = $q->execute();
                $this->results = array();
                $modalidades = array();
                foreach ($rows as $row) {
                    $modalidad = $row["t_ca_modalidad"];
                    $grupo = $row["tg_ca_descripcion"];
                    $pais = $row["tr_ca_nombre"];
                    $idtrafico = $row["tr_ca_idtrafico"];
                    $this->results[$modalidad][$grupo][] = array("idtrafico" => $idtrafico, "pais" => $pais);
                    $modalidades[] = $modalidad;
                }

                $modalidades = array_unique($modalidades);
                //print_r($modalidades);
                $this->lineas = array();

                $q = Doctrine_Query::create()
                                ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, t.ca_modalidad")
                                ->distinct()
                                ->from("Trayecto t");
                if ($impoexpo == Constantes::IMPO) {
                    $q->innerJoin("t.Origen c");
                } else {
                    $q->innerJoin("t.Destino c");
                }
                $q->innerJoin("t.IdsProveedor p");
                $q->innerJoin("p.Ids id");
                $q->addWhere("t.ca_impoexpo = ? ", $impoexpo);
                $q->addWhere("t.ca_transporte = ? ", $transporte);
                //$q->addWhere("t.ca_modalidad = ? ", $modalidad );
                $q->addWhere("t.ca_activo = ? ", true);
                //$q->addWhere("p.ca_activo = ? ", true );
                $q->addOrderBy("id.ca_nombre ASC");
                $q->distinct();
                $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                $this->lineas = $q->execute();
            }
        } else {
            $opciones = explode("_", $node);
            $modalidad = $opciones[3];
            $idtrafico = $opciones[4];

            $this->trafico = Doctrine::getTable("Trafico")->find($idtrafico);
            $this->forward404Unless($this->trafico);
            $q = Doctrine_Query::create()
                            ->distinct()
                            ->from("Trayecto t");
            if ($impoexpo == Constantes::IMPO) {
                $q->select("c.ca_idciudad, c.ca_ciudad, t.ca_origen");
                $q->innerJoin("t.Origen c");
            } else {
                $q->select("c.ca_idciudad, c.ca_ciudad, t.ca_destino");
                $q->innerJoin("t.Destino c");
            }

            $q->where("c.ca_idtrafico = ? ", $idtrafico);
            $q->addWhere("t.ca_impoexpo = ? ", $impoexpo);
            $q->addWhere("t.ca_transporte = ? ", $transporte);
            $q->addWhere("t.ca_modalidad = ? ", $modalidad);
            $q->addWhere("t.ca_activo = ? ", true);
            $q->addOrderBy("c.ca_ciudad ASC");
            $q->distinct();
            $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            $this->ciudades = $q->execute();

            
            $q = Doctrine_Query::create()
                            ->distinct()
                            ->select("p.ca_idproveedor, p.ca_sigla, id.ca_nombre, t.ca_modalidad")
                            ->from("Trayecto t");
            if ($impoexpo == Constantes::IMPO) {
                $q->innerJoin("t.Origen c");
            } else {
                $q->innerJoin("t.Destino c");
            }
            $q->innerJoin("t.IdsProveedor p");
            $q->innerJoin("p.Ids id");

            $q->where("c.ca_idtrafico = ? ", $idtrafico);
            $q->addWhere("t.ca_impoexpo = ? ", $impoexpo);
            $q->addWhere("t.ca_transporte = ? ", $transporte);
            $q->addWhere("t.ca_modalidad = ? ", $modalidad);
            $q->addWhere("t.ca_activo = ? ", true);
            //$q->addWhere("p.ca_activo = ? ", true );
            $q->addOrderBy("id.ca_nombre ASC");
            $q->distinct();
            $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
            $this->lineas = $q->execute();

            $this->idtrafico = $idtrafico;
            $this->modalidad = $modalidad;
            $this->setTemplate("datosCiudadesTrayectos");
        }
//		print_r($this->lineas);
//		exit;
        $this->transporte = $transporte;
        $this->impoexpo = strtolower(substr($impoexpo, 0, 4));
    }

    /*     * *******************************************************************
     * Notificaciones
     *
     * ******************************************************************* */

    /*
     * Acciones del panel de notificaciones
     * @author: Andres Botero
     */

    public function executeGuardarNotificacion() {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }

        $titulo = $this->getRequestParameter("titulo");
        $mensaje = $this->getRequestParameter("mensaje");
        $caducidad = $this->getRequestParameter("caducidad");
        $id = $this->getRequestParameter("id");

        $user = $this->getUser();
        $notificacion = null;
        if ($this->getRequestParameter("idnotificacion")) {
            $notificacion = Doctrine::getTable("PricNotificacion")->find($this->getRequestParameter("idnotificacion"));
        }
        if (!$notificacion) {
            $notificacion = new PricNotificacion();
        }
        $notificacion->setCaTitulo(utf8_decode($titulo));
        $notificacion->setCaMensaje(utf8_decode($mensaje));
        $notificacion->setCaCaducidad($caducidad);
        $notificacion->setCaUsucreado($user->getUserId());

        $this->fchcreado = date("Y-m-d h:i:s", time());
        $notificacion->setCaFchcreado($this->fchcreado);
        $notificacion->save();
        $this->idnotificacion = $notificacion->getCaIdnotificacion();

        $this->responseArray = array("idnotificacion" => $this->idnotificacion,
            "fchcreado" => $this->fchcreado,
            "mensaje" => $mensaje,
            "titulo" => $titulo,
            "caducidad" => $caducidad,
            "usucreado" => $user->getUserId(),
            "success" => true,
            "id" => $id);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Elimina una notificacion
     * @author: Andres Botero
     */

    public function executeEliminarNotificacion() {
        $this->nivel = $this->getNivel();

        if ($this->nivel <= 0) {
            $this->forward404();
        }
        $notificacion = Doctrine::getTable("PricNotificacion")->find($this->getRequestParameter("idnotificacion"));
        $id = $this->getRequestParameter("id");
        $this->responseArray = array("id" => $id, "success" => false);
        if ($notificacion) {
            $notificacion->delete();
            $this->responseArray = array("id" => $id, "success" => true);
        }

        $this->setTemplate("responseTemplate");
    }

    /*
     * Tarifario Aduana
     */

    /*
     * Datos para el tarifario de Aduana que se cargan en el panel
     * @author: Andres Botero
     */

    public function executeDatosPanelCostosAduana() {
        $this->nivel = $this->getNivel();
        //Clientes Activos en colmas + Sus recargos
        $cl = Doctrine::getTable("Cliente")
                        ->createQuery("c")
                        ->select("c.ca_compania, c.ca_idcliente, e.ca_estado")
                        //->addFrom("(SELECT MAX(ca_fchestado) FROM StdCliente e2 WHERE e2.ca_empresa = e.ca_empresa AND e2.ca_estado = e.ca_estado ) std")
                        ->innerJoin("c.StdCliente e")
                        ->addWhere("e.ca_empresa = ?", Constantes::COLMAS)
                        //->addWhere("e.ca_estado = ?", "Activo")
                        //->addWhere("e.ca_fchestado = (SELECT MAX(e2.ca_fchestado) FROM StdCliente e2 WHERE e2.ca_empresa = e.ca_empresa AND e2.ca_estado = e.ca_estado )" )
                        ->addOrderBy("e.ca_idcliente ASC")
                        ->addOrderBy("e.ca_fchestado DESC")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        //->limit(50)
                        //->getSqlQuery();
                        ->execute();
        //echo $cl;

        $lastId = null;
        $clientes = array();
        foreach ($cl as $val) {
            if ($lastId != $val["c_ca_idcliente"]) {
                $lastId = $val["c_ca_idcliente"];
                if ($val["e_ca_estado"] == "Activo") {
                    $clientes[] = array("idcliente" => $val["c_ca_idcliente"], "compania" => $val["c_ca_compania"]);
                }
            }
        }

        $recs = Doctrine::getTable("PricRecargoCliente")
                        ->createQuery("r")
                        ->select("r.*")
                        //->limit(50)
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        $recargos = array();
        foreach ($recs as $rec) {
            $recargos[$rec["r_ca_idcliente"]][$rec["r_ca_idconcepto"]]["col1"] = $rec["r_ca_vlr1"];
            $recargos[$rec["r_ca_idcliente"]][$rec["r_ca_idconcepto"]]["col2"] = $rec["r_ca_vlr2"];
        }

        $datos = array();
        $k = 0;
        foreach ($clientes as $key => $val) {

            $datos[$k]["compania"] = utf8_encode($clientes[$key]["compania"]);
            $datos[$k]["idcliente"] = $clientes[$key]["idcliente"];
            if (isset($recargos[$clientes[$key]["idcliente"]])) {
                $recargos = $recargos[$clientes[$key]["idcliente"]];

                foreach ($recargos as $idconcepto => $cols) {
                    foreach ($cols as $col => $vlr) {
                        $datos[$k]["recargo_" . $idconcepto . "_" . $col] = $vlr;
                    }
                }
            }
            $k++;
        }
        $this->responseArray = array("root" => $datos, "total", count($datos));
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios del panelss
     * @author: Andres Botero
     */

    public function executeObservePanelCostosAduana() {
        $id = $this->getRequestParameter("id");
        $this->responseArray = array("id" => $id);
        $idcliente = $this->getRequestParameter("idcliente");
        //print_r( $_POST );
        foreach ($_POST as $key => $val) {
            if (substr($key, 0, 7) == "recargo") {

                $vals = explode("_", $key);
                $idconcepto = $vals[1];
                $col = $vals[2];

                $concepto = Doctrine::getTable("PricRecargoCliente")
                                ->createQuery("r")
                                ->where("r.ca_idconcepto = ?", $idconcepto)
                                ->addWhere("r.ca_idcliente = ?", $idcliente)
                                ->fetchOne();

                if (!$concepto) {
                    $concepto = new PricRecargoCliente();
                    $concepto->setCaIdcliente($idcliente);
                    $concepto->setCaIdconcepto($idconcepto);
                    $concepto->setCaIdmoneda("COP");
                }
                //exit();
                if ($col == "col1") {
                    //echo $col." ".$val;
                    $concepto->setCaVlr1($val);
                }

                if ($col == "col2") {
                    //echo $col." ".$val;
                    $concepto->setCaVlr2($val);
                }
                $concepto->save();
            }
        }
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda un trayecto
     * @author: Andres Botero
     */

    public function executePanelTrayectoGuardar($request) {

        $idtrayecto = $request->getParameter("idtrayecto");

        if ($idtrayecto) {
            $trayecto = Doctrine::getTable("Trayecto")->find($idtrayecto);
            $this->forward404Unless($trayecto);
        } else {
            $trayecto = new Trayecto();
        }

        $transporte = utf8_decode($this->getRequestParameter("transporte"));
        $impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
        $modalidad = utf8_decode($this->getRequestParameter("modalidad"));
        $idlinea = utf8_decode($this->getRequestParameter("idlinea"));
        $idagente = utf8_decode($this->getRequestParameter("idagente"));
        $origen = utf8_decode($this->getRequestParameter("idorigen"));
        $destino = utf8_decode($this->getRequestParameter("iddestino"));
        $observaciones = utf8_decode($this->getRequestParameter("observaciones"));
        $frecuencia = utf8_decode($this->getRequestParameter("frecuencia"));
        $ttransito = utf8_decode($this->getRequestParameter("ttransito"));
        $activo = utf8_decode($this->getRequestParameter("activo"));

        $trayecto->setCaImpoexpo($impoexpo);
        $trayecto->setCaTransporte($transporte);
        $trayecto->setCaModalidad($modalidad);
        $trayecto->setCaOrigen($origen);
        $trayecto->setCaDestino($destino);
        $trayecto->setCaIdlinea($idlinea);
        if ($idagente) {
            $trayecto->setCaIdagente($idagente);
        } else {
            $trayecto->setCaIdagente(null);
        }

        if ($observaciones) {
            $trayecto->setCaObservaciones($observaciones);
        } else {
            $trayecto->setCaObservaciones(null);
        }

        if ($ttransito) {
            $trayecto->setCaTiempotransito($ttransito);
        }
        if ($frecuencia) {
            $trayecto->setCaFrecuencia($frecuencia);
        }
        $trayecto->setCaActivo($activo == "on");
        $trayecto->save();
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*     * ***********************************************************************
     *  Acciones panel parametros
     *
     * *********************************************************************** */

    /**
     * Datos de los conceptos para usar en pricing cotizaciones etc.
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelParametrosConceptos(sfWebRequest $request) {
        $readOnly = $request->getParameter("readOnly");
        $nivel = $this->getNivel();

        $idccosto = $request->getParameter("idccosto");

        $q = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->select("c.*") //,
                        ->addWhere("c.ca_recargoorigen=true OR c.ca_recargolocal=true")
                        ->addOrderBy("c.ca_concepto");


        $conceptos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $k = 0;
        foreach ($conceptos as $key => $val) {
            $conceptos[$key]["c_ca_concepto"] = utf8_encode($conceptos[$key]["c_ca_concepto"]);
            $conceptos[$key]["orden"] = str_pad($k, 4, "0", STR_PAD_LEFT);
            $k++;


            $modalidadesConcepto = Doctrine_Query::create()
                            ->select("cm.ca_idmodalidad")
                            ->from("InoConceptoModalidad cm")
                            ->where("cm.ca_idconcepto = ? ", $conceptos[$key]["c_ca_idconcepto"])
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                            ->execute();
            $modalidades = array();

            foreach ($modalidadesConcepto as $modalidadConcepto) {
                $modalidades[] = $modalidadConcepto["ca_idmodalidad"];
            }
            $conceptos[$key]["modalidades"] = implode("|", $modalidades);
        }

        if ($readOnly == "false") {
            $conceptos[] = array("ca_idconcepto" => "", "ca_concepto" => "", "orden" => "Z");
        }
        $this->responseArray = array("totalCount" => count($conceptos), "root" => $conceptos);

        $this->setTemplate("responseTemplate");
    }

    /*
     * guarda el panel de conceptos
     * @param sfRequest $request A request object
     */

    public function executeGuardarPanelParametros(sfWebRequest $request) {
        $id = $request->getParameter("id");
        $this->responseArray = array("id" => $id, "success" => false);

        $modo = $request->getParameter("modo");

        $tipo = $request->getParameter("tipo");

        $idconcepto = $request->getParameter("idconcepto");

        if ($idconcepto) {
            $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
            $this->forward404Unless($concepto);
        } else {
            $concepto = new InoConcepto();
            $concepto->setCaTipo($request->getParameter("tipo"));
        }

        if ($request->getParameter("concepto") !== null) {
            $concepto->setCaConcepto(utf8_decode($request->getParameter("concepto")));
        }

        if ($request->getParameter("parametros") !== null) {
            $concepto->setCaParametros(utf8_decode($request->getParameter("parametros")));
        }

        if ($request->getParameter("recargoorigen") !== null) {
            if ($request->getParameter("recargoorigen") == "true") {
                $concepto->setCaRecargoorigen(true);
            } else {
                $concepto->setCaRecargoorigen(false);
            }
        }

        if ($request->getParameter("recargolocal") !== null) {
            if ($request->getParameter("recargolocal") == "true") {
                $concepto->setCaRecargolocal(true);
            } else {
                $concepto->setCaRecargolocal(false);
            }
        }

        if ($request->getParameter("observaciones") !== null) {
            if ($request->getParameter("observaciones")) {
                $concepto->setCaDetalles($request->getParameter("observaciones"));
            } else {
                $concepto->setCaDetalles(null);
            }
        }

        if ($concepto->getCaIdconcepto()) {
            if ($request->getParameter("modalidades") !== null) {
                Doctrine_Query::create()
                        ->delete()
                        ->from("InoConceptoModalidad cm")
                        ->where("cm.ca_idconcepto = ? ", $concepto->getCaIdconcepto())
                        ->execute();

                $modalidadesParam = explode("|", $request->getParameter("modalidades"));

                foreach ($modalidadesParam as $val) {
                    $cm = new InoConceptoModalidad();
                    $cm->setCaIdconcepto($concepto->getCaIdconcepto());
                    $cm->setCaIdmodalidad($val);
                    $cm->save();
                }
            }
        }
        $concepto->save();
        $this->responseArray["success"] = true;
        $this->responseArray["idconcepto"] = $concepto->getCaIdconcepto();
        $this->setTemplate("responseTemplate");
    }

    /*
     * guarda el panel de conceptos
     * @param sfRequest $request A request object
     */

    public function executeEliminarPanelParametros(sfWebRequest $request) {
        $id = $request->getParameter("id");
        $this->responseArray = array("id" => $id, "success" => false);
        $nivel = $this->getNivel();
        if ($nivel == 1) {
            $idconcepto = $request->getParameter("idconcepto");
            if ($idconcepto) {
                $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
                $this->forward404Unless($concepto);
                $concepto->delete();
                $this->responseArray["success"] = true;
            }
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de los conceptos para usar en pricing cotizaciones etc.
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosModalidadGrid(sfWebRequest $request) {
        $tipo = $request->getParameter("tipo");
        $readOnly = $request->getParameter("readOnly");
        $conceptos = array();
        if ($request->getParameter("modalidades")) {

            $modalidadesParam = explode("|", $request->getParameter("modalidades"));
            if (count($modalidadesParam) > 0) {
                $q = Doctrine::getTable("Modalidad")
                                ->createQuery("m")
                                ->select("m.ca_idmodalidad, m.ca_impoexpo, m.ca_transporte, m.ca_modalidad")
                                ->whereIn("m.ca_idmodalidad", $modalidadesParam)
                                ->addOrderBy("m.ca_impoexpo")
                                ->addOrderBy("m.ca_transporte")
                                ->addOrderBy("m.ca_modalidad");
                $modalidades = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
                $k = 0;
                foreach ($modalidades as $modalidad) {
                    $conceptos[] = array("idmodalidad" => $modalidad["ca_idmodalidad"], "modalidad" => utf8_encode($modalidad["ca_impoexpo"] . " " . $modalidad["ca_transporte"] . " " . $modalidad["ca_modalidad"]), "orden" => $k++);
                }
            }
        }
        $nivel = $this->getNivel();
        if ($readOnly == "false") {
            $conceptos[] = array("idmodalidad" => "", "modalidad" => "+", "orden" => "Z");
        }
        $this->responseArray = array("totalCount" => count($conceptos), "root" => $conceptos);

        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de los conceptos para usar en pricing cotizaciones etc.
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelTarifarioAduana(sfWebRequest $request) {
        $data = array();
        $conceptos = Doctrine::getTable("ConceptoAduana")
                        ->createQuery("c")
                        ->innerJoin("c.Costo")
                        ->execute();

        foreach ($conceptos as $concepto) {
            $data[] = array("consecutivo" => $concepto->getCaConsecutivo(),
                "idconcepto" => $concepto->getCaIdconcepto(),
                "concepto" => utf8_encode($concepto->getCosto()->getCaCosto()),
                "parametro" => $concepto->getCaParametro(),
                "valor" => $concepto->getCaValor(),
                "valorminimo" => $concepto->getCaValorminimo(),
                "aplicacion" => $concepto->getCaAplicacion(),
                "aplicacionminimo" => $concepto->getCaAplicacionminimo(),
                "fchini" => $concepto->getCaFchini(),
                "fchfin" => $concepto->getCaFchfin(),
                "observaciones" => $concepto->getCaObservaciones()
            );
        }

        $readOnly = $request->getParameter("readOnly");
        if ($readOnly != "true") {
            $data[] = array("idconcepto" => "", "concepto" => "+", "orden" => "Z");
        }
        $this->responseArray = array("totalCount" => count($data), "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosPanelTarifarioAduanaCliente(sfWebRequest $request) {
        $data = array();
        $data1 = array();
        $data2 = array();
        $conceptos = Doctrine::getTable("ConceptoAduanaCliente")
                        ->createQuery("c")
                        ->innerJoin("c.Costo")
                        ->where("c.ca_idcliente = ? ", $request->getParameter("idcliente"))
                        ->execute();

        foreach ($conceptos as $concepto) {
            $data1[] = array("consecutivo" => $concepto->getCaConsecutivo(),
                "idconcepto" => $concepto->getCaIdconcepto(),
                "concepto" => utf8_encode($concepto->getCosto()->getCaCosto()),
                "parametro" => $concepto->getCaParametro(),
                "valor" => $concepto->getCaValor(),
                "valorminimo" => $concepto->getCaValorminimo(),
                "aplicacion" => $concepto->getCaAplicacion(),
                "aplicacionminimo" => $concepto->getCaAplicacionminimo(),
                "fchini" => $concepto->getCaFchini(),
                "fchfin" => $concepto->getCaFchfin(),
                "observaciones" => $concepto->getCaObservaciones(),
                "tipo" => "2"
            );
        }

        $conceptos2 = Doctrine::getTable("ConceptoAduana")
                        ->createQuery("c")
                        ->innerJoin("c.Costo")
                        ->execute();

        foreach ($conceptos2 as $concepto) {
            $encontro = false;
            for ($k = 0; $k < count($data1); $k++) {
//                echo $data1[$k]["idconcepto"].":".$concepto->getCaIdconcepto()."---".$data1[$k]["parametro"].":".$concepto->getCaParametro()."<br>";
                if (trim($data1[$k]["idconcepto"]) == trim($concepto->getCaIdconcepto()) && trim($data1[$k]["parametro"]) == trim($concepto->getCaParametro())) {
                    $encontro = true;
                    break;
                }
            }
            if ($encontro == false) {
                $data2[] = array("consecutivo" => $concepto->getCaConsecutivo(),
                    "idconcepto" => $concepto->getCaIdconcepto(),
                    "concepto" => utf8_encode($concepto->getCosto()->getCaCosto()),
                    "parametro" => $concepto->getCaParametro(),
                    "valor" => $concepto->getCaValor(),
                    "valorminimo" => $concepto->getCaValorminimo(),
                    "aplicacion" => $concepto->getCaAplicacion(),
                    "aplicacionminimo" => $concepto->getCaAplicacionminimo(),
                    "fchini" => $concepto->getCaFchini(),
                    "fchfin" => $concepto->getCaFchfin(),
                    "observaciones" => $concepto->getCaObservaciones(),
                    "tipo" => "1"
                );
            }
        }
        $data = array_merge($data2, $data1);
        $readOnly = $request->getParameter("readOnly");
        if ($readOnly != "true") {
            $data[] = array("idconcepto" => "", "concepto" => "+", "orden" => "Z");
        }
        $this->responseArray = array("totalCount" => count($data), "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosParametros(sfWebRequest $request) {
        $data = array();
        $arrParametros = array();
        $parametros = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->where("c.ca_idconcepto = ? ", $request->getParameter("idconcepto"))
                        ->execute();

        foreach ($parametros as $parametro) {
//            echo $parametro->getCaParametros();
            $arrParametros = explode("|", $parametro->getCaParametros());
        }
        foreach ($arrParametros as $parametro) {
            $data[] = array("parametro" => $parametro);
        }
//        $this->responseArray["parametro"]=$data;
        $readOnly = $request->getParameter("readOnly");

        if ($readOnly == "false") {
            $data[] = array("parametro" => "+", "orden" => "Z");
        }
        $this->responseArray = array("root" => $data);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de los conceptos para usar en pricing cotizaciones etc.
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarPanelTarifarioAduana() {
//if($this->getRequestParameter( "consecutivo" )!=null && $this->getRequestParameter( "consecutivo" )>0 )
        $consecutivo = ($this->getRequestParameter("consecutivo") != null && $this->getRequestParameter("consecutivo") > 0 ) ? $this->getRequestParameter("consecutivo") : "0";
        $conceptoaduana = Doctrine::getTable("ConceptoAduana")->find($consecutivo);

        if (!$conceptoaduana) {
            $conceptoaduana = new ConceptoAduana();
        }

        $conceptoaduana->setCaParametro($this->getRequestParameter("parametro"));
        $conceptoaduana->setCaIdconcepto($this->getRequestParameter("idconcepto"));

        if ($this->getRequestParameter("valor")) {
            $conceptoaduana->setCaValor($this->getRequestParameter("valor"));
        }
        if ($this->getRequestParameter("valorminimo")) {
            $conceptoaduana->setCaValorminimo($this->getRequestParameter("valorminimo"));
        }

        if ($this->getRequestParameter("aplicacion")) {
            $conceptoaduana->setCaAplicacion($this->getRequestParameter("aplicacion"));
        }

        if ($this->getRequestParameter("aplicacionminimo")) {
            $conceptoaduana->setCaAplicacionminimo($this->getRequestParameter("aplicacionminimo"));
        }
        if ($this->getRequestParameter("fchini")) {
            $conceptoaduana->setCaFchini($this->getRequestParameter("fchini"));
        }
        if ($this->getRequestParameter("fchfin")) {
            $conceptoaduana->setCaFchfin($this->getRequestParameter("fchfin"));
        }
        if ($this->getRequestParameter("observaciones")) {
            $conceptoaduana->setCaObservaciones($this->getRequestParameter("observaciones"));
        }
        $conceptoaduana->save();

        $id = $this->getRequestParameter("id");

        $this->responseArray = array("id" => $id, "consecutivo" => $conceptoaduana->getCaConsecutivo(), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarPanelTarifarioAduanaCliente() {
//if($this->getRequestParameter( "consecutivo" )!=null && $this->getRequestParameter( "consecutivo" )>0 )
        $consecutivo = ($this->getRequestParameter("consecutivo") != null && $this->getRequestParameter("consecutivo") > 0 ) ? $this->getRequestParameter("consecutivo") : "0";
        $conceptoaduana = Doctrine::getTable("ConceptoAduanaCliente")->find($consecutivo);

        if (!$conceptoaduana) {
            $conceptoaduana = new ConceptoAduanaCliente();
        }
        $conceptoaduana->setCaParametro($this->getRequestParameter("parametro"));
        $conceptoaduana->setCaIdconcepto($this->getRequestParameter("idconcepto"));
        $conceptoaduana->setCaIdcliente($this->getRequestParameter("idcliente"));

        if ($this->getRequestParameter("valor")) {
            $conceptoaduana->setCaValor($this->getRequestParameter("valor"));
        }
        if ($this->getRequestParameter("valorminimo")) {
            $conceptoaduana->setCaValorminimo($this->getRequestParameter("valorminimo"));
        }

        if ($this->getRequestParameter("aplicacion")) {
            $conceptoaduana->setCaAplicacion($this->getRequestParameter("aplicacion"));
        }

        if ($this->getRequestParameter("aplicacionminimo")) {
            $conceptoaduana->setCaAplicacionminimo($this->getRequestParameter("aplicacionminimo"));
        }
        if ($this->getRequestParameter("fchini")) {
            $conceptoaduana->setCaFchini($this->getRequestParameter("fchini"));
        }
        if ($this->getRequestParameter("fchfin")) {
            $conceptoaduana->setCaFchfin($this->getRequestParameter("fchfin"));
        }
        if ($this->getRequestParameter("observaciones")) {
            $conceptoaduana->setCaObservaciones($this->getRequestParameter("observaciones"));
        }
        $conceptoaduana->save();

        $id = $this->getRequestParameter("id");
        $this->responseArray = array("id" => $id, "consecutivo" => $conceptoaduana->getCaConsecutivo(), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarPanelTarifarioAduana() {
        $id = $this->getRequestParameter("id");
        $consecutivo = $this->getRequestParameter("consecutivo");
        $conceptoaduana = Doctrine::getTable("ConceptoAduana")->find($consecutivo);

        if ($conceptoaduana) {
            $conceptoaduana->delete();
        }
        $this->responseArray = array("id" => $id, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarPanelTarifarioAduanaCliente() {
        $id = $this->getRequestParameter("id");
        $consecutivo = $this->getRequestParameter("consecutivo");
        $conceptoaduana = Doctrine::getTable("ConceptoAduanaCliente")->find($consecutivo);

        if ($conceptoaduana) {
            $conceptoaduana->delete();
        }
        $this->responseArray = array("id" => $id, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosAplicacion(sfWebRequest $request) {
        $this->aplicacion = ParametroTable::retrieveByCaso("CU082");
        $aplicaciones = array();
        foreach ($this->aplicacion as $aplicacion) {
            $aplicaciones[] = $aplicacion->getData();
        }
        $this->responseArray = array("totalCount" => count($aplicaciones), "root" => $aplicaciones);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosTrayecto() {
        $idtrayecto = $this->getRequestParameter("idtrayecto");
        $trayecto = Doctrine::getTable("Trayecto")->find($idtrayecto);
        if ($trayecto) {
            $data = array();
            $data["idtrayecto"] = $idtrayecto;
            $data["impoexpo"] = utf8_encode($trayecto->getCaImpoexpo());
            $data["transporte"] = utf8_encode($trayecto->getCaTransporte());
            $data["modalidad"] = $trayecto->getCaModalidad();
            $data["idlinea"] = $trayecto->getCaIdlinea();
            $data["linea"] = utf8_encode($trayecto->getIdsProveedor()->getCaSigla() ? $trayecto->getIdsProveedor()->getCaSigla() : $trayecto->getIdsProveedor()->getIds()->getCaNombre());

            $data["tra_origen"] = utf8_encode($trayecto->getOrigen()->getTrafico()->getCaIdtrafico());
            $data["pais_origen"] = utf8_encode($trayecto->getOrigen()->getTrafico()->getCaNombre());
            $data["ciu_origen"] = $trayecto->getCaOrigen();
            $data["ciudad_origen"] = utf8_encode($trayecto->getOrigen()->getCaCiudad());
            $data["tra_destino"] = utf8_encode($trayecto->getDestino()->getTrafico()->getCaIdtrafico());
            $data["pais_destino"] = utf8_encode($trayecto->getDestino()->getTrafico()->getCaNombre());
            $data["ciu_destino"] = $trayecto->getCaDestino();
            $data["ciudad_destino"] = utf8_encode($trayecto->getDestino()->getCaCiudad());
            $data["idagente"] = $trayecto->getCaIdagente();

            $idag = $trayecto->getIdsAgente();
            $ids = $idag->getIds();
            $data["agente"] = utf8_encode(/* $ids->getIdsSucursal()->getCiudad()->getCaCiudad() ." ". */$ids->getCaNombre());
            $data["observaciones"] = utf8_encode($trayecto->getCaObservaciones());
            $data["frecuencia"] = utf8_encode($trayecto->getCaFrecuencia());
            $data["ttransito"] = utf8_encode($trayecto->getCaTiempotransito());

            $this->responseArray = array("data" => $data, "success" => true);
        } else {
            $this->responseArray = array("success" => false);
        }
        $this->setTemplate("responseTemplate");
    }

}

?>
