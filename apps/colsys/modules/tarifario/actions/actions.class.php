<?php

/**
 * pricing actions.
 *
 * @package    colsys
 * @subpackage tarifario
 * @author     Mauricio Quinche
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tarifarioActions extends sfActions {

    public function executeIndex() {
        $this->forward('tarifario', 'indexExt7');
    }

    public function executeIndexExt7(sfWebRequest $request) {
//        $this->setLayout("none");
        // $this->permisos = array();
        // $user = $this->getUser();
        // $this->login = $user->getUserId();
        // $this->idsucursal = $user->getIdSucursal();
        // $permisosRutinas = $user->getControlAcceso(self::RUTINA_PRM);
    }

    public function executeCargarPermisos(sfWebRequest $request) {
        $permisos = array();

        $user = $this->getUser();
//        $permisosRutinas = $user->getControlAcceso(self::RUTINA_PRM);
//
//        $tipopermisos = $user->getAccesoTotalRutina(self::RUTINA_PRM);
//        foreach ($tipopermisos as $index => $tp) {
//            $permisos[$index] = in_array($tp, $permisosRutinas) ? true : false;
//        }
        $permisos[] = true;

        $this->responseArray = array("success" => true, "permisos" => $permisos);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Datos el Grid de Consulta de Tarifas
     *
     */

    public function executeConsultaResultado(sfWebRequest $request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $q = Doctrine::getTable("Trayecto")
                ->createQuery("t");
        //->where("ca_modalidad = ? AND ca_impoexpo = ? AND ca_transporte = ? AND ca_origen = ? AND ca_destino = ?", array($this->modalidad, $this->impoexpo, $this->transporte, $this->idorigen, $this->iddestino));
        //->limit(10);

        if ($datos->idorigen) {
            $q->addWhere("t.ca_origen = ?", $datos->idorigen);
        }
        if ($datos->iddestino) {
            $q->addWhere("t.ca_destino = ?", $datos->iddestino);
        }
//        if ($this->idlinea) {
//            $q->addWhere("t.ca_idlinea = ?", $this->idlinea);
//        }
        $q->addWhere("t.ca_activo = ?", TRUE);

        $filtros = array();
        $trayectos = $q->execute();
        foreach ($trayectos as $trayecto) {
            $ids = $trayecto->getIdsAgente()->getIds();
            $row = array(
                "idtrayecto" => $trayecto->getCaIdtrayecto(),
                "impoexpo" => utf8_encode($trayecto->getCaImpoexpo()),
                "transporte" => utf8_encode($trayecto->getCaTransporte()),
                "modalidad" => $trayecto->getCaModalidad(),
                "idlinea" => $trayecto->getCaIdlinea(),
                "linea" => utf8_encode($trayecto->getIdsProveedor()->getCaSigla() ? $trayecto->getIdsProveedor()->getCaSigla() : $trayecto->getIdsProveedor()->getIds()->getCaNombre()),
                "tra_origen" => utf8_encode($trayecto->getOrigen()->getTrafico()->getCaIdtrafico()),
                "pais_origen" => utf8_encode($trayecto->getOrigen()->getTrafico()->getCaNombre()),
                "ciu_origen" => $trayecto->getCaOrigen(),
                "ciudad_origen" => utf8_encode($trayecto->getOrigen()->getCaCiudad()),
                "tra_destino" => utf8_encode($trayecto->getDestino()->getTrafico()->getCaIdtrafico()),
                "pais_destino" => utf8_encode($trayecto->getDestino()->getTrafico()->getCaNombre()),
                "ciu_destino" => $trayecto->getCaDestino(),
                "ciudad_destino" => utf8_encode($trayecto->getDestino()->getCaCiudad()),
                "idagente" => $trayecto->getCaIdagente(),
                "agente" => utf8_encode($ids->getCaNombre()),
                "observaciones" => utf8_encode($trayecto->getCaObservaciones()),
                "frecuencia" => utf8_encode($trayecto->getCaFrecuencia()),
                "ttransito" => utf8_encode($trayecto->getCaTiempotransito())
            );
            $data[] = $row;
            if (!in_array(utf8_encode($trayecto->getCaTransporte()), $filtros["transporte"])) {
                $filtros["transporte"][] = utf8_encode($trayecto->getCaTransporte());
            }
            if (!in_array(utf8_encode($trayecto->getCaImpoexpo()), $filtros["impoexpo"])) {
                $filtros["impoexpo"][] = utf8_encode($trayecto->getCaImpoexpo());
            }
            if (!in_array(utf8_encode($trayecto->getCaModalidad()), $filtros["modalidad"])) {
                $filtros["modalidad"][] = utf8_encode($trayecto->getCaModalidad());
            }
            if (!in_array($trayecto->getCaIdlinea(), $filtros["idlinea"])) {
                $filtros["linea"][] = array('idlinea' => $trayecto->getCaIdlinea(), 'linea' => utf8_encode($trayecto->getIdsProveedor()->getCaSigla() ? $trayecto->getIdsProveedor()->getCaSigla() : $trayecto->getIdsProveedor()->getIds()->getCaNombre()));
            }
        }
        $sql = "select distinct ca_concepto from public.tb_conceptos c where ";
        if (count($filtros["transporte"])) {
            $sql .= "c.ca_transporte in ('" . utf8_decode(implode("','", $filtros["transporte"])) . "') and ";
        }
        if (count($filtros["modalidad"])) {
            $sql .= "c.ca_modalidad in ('" . utf8_decode(implode("','", $filtros["modalidad"])) . "') and ";
        }
        $sql .= "true order by ca_concepto";

        $stmt = $con->execute($sql);
        $filtros["concepto"] = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($filtros["concepto"] as $key => $value) {
            $filtros["concepto"][$key] = array('concepto' => utf8_encode($value));
        }

        $this->responseArray = array("success" => true, "root" => $data, "filtros" => $filtros, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    /*
     * Datos el Grid de Consulta de Tarifas
     *
     */

    public function executeConsultaTarifas(sfWebRequest $request) {
        $con = Doctrine_Manager::getInstance()->connection();
        $idtrayecto = $request->getParameter("idtrayecto");

        $q = Doctrine_Query::create()->from("PricFlete f");
        $q->innerJoin("f.Concepto c");
        $q->leftJoin("f.Equipo e");
        $q->addWhere("f.ca_idtrayecto = ?", $idtrayecto);

        $q->addOrderBy("e.ca_concepto");
        $q->addOrderBy("c.ca_liminferior");
        $q->addOrderBy("c.ca_concepto");
        $pricConceptos = $q->execute();
        $trayecto = null;

        $data = array();
        foreach ($pricConceptos as $pricConcepto) {
            if (!$trayecto) {
                $trayecto = $pricConcepto->getTrayecto();
            }
            if ($pricConcepto->getCaFcheliminado() != "" && Utils::compararFechas($pricConcepto->getCaFcheliminado(), $fchcorte) == -1) {
                continue;
            }
            if ($pricConcepto->getCaEstado() == 2) {    //Las tarifas en mantenimiento no se muestran en consulta
                $neta = 0;
                $sugerida = 0;
            } else {
                $neta = $pricConcepto->getCaVlrneto();
                $sugerida = $pricConcepto->getCaVlrsugerido();
            }

            $precision = $pricConcepto->getCaIdmoneda() == "COP" ? 0 : 2;
            $tarifario = $recargos = $aplica = array();
            $tarifario[] = array(
                "nconcepto" => "Flete",
                'neta_tar' => number_format($neta, $precision, '.', ','),
                'moneda' => $pricConcepto->getCaIdmoneda(),
                'sugerida_tar' => number_format($sugerida, $precision, '.', ','),
                'aplicacion' => utf8_encode($pricConcepto->getCaAplicacion()),
                'minima_tar' => number_format(0, $precision, '.', ','),
                'aplicacion_min' => '',
                'inicio' => $pricConcepto->getCaFchinicio(),
                'vencimiento' => $pricConcepto->getCaFchvencimiento(),
                'observaciones' => '',
                'id_aplica' => hash('md5', $pricConcepto->getCaAplicacion()),
                'sel' => true
            );
            if (!$aplica[hash('md5', $pricConcepto->getCaAplicacion())]) {
                $aplica[hash('md5', $pricConcepto->getCaAplicacion())] = utf8_encode($pricConcepto->getCaAplicacion());
            }

            $q = Doctrine_Query::create()->from("PricRecargoxConcepto r");
            $q->addOrderBy("t.ca_recargo");
            $q->innerJoin("r.TipoRecargo t");
            $q->addWhere("r.ca_idtrayecto = ?", $idtrayecto);
            $q->whereIn("r.ca_idconcepto", array($pricConcepto->getCaIdconcepto(), 9999));

            if ($pricConcepto->getCaIdequipo()) {
                $q->addWhere("r.ca_idequipo = ?", $pricConcepto->getCaIdequipo());
            } else {
                $q->addWhere("r.ca_idequipo IS NULL");
            }

            $pricRecargos = $q->execute();
            if ($pricRecargos) {
                foreach ($pricRecargos as $pricRecargo) {
                    if ($pricRecargo->getCaFcheliminado() != "" && Utils::compararFechas($pricRecargo->getCaFcheliminado(), $fchcorte) == -1) {
                        continue;
                    }
                    $tipoRecargo = $pricRecargo->getTipoRecargo();

                    if ($this->opcion == "consulta" && $pricConcepto->getCaEstado() == 2) {//Las tarifas en mantenimiento no se muestran en consulta
                        $neta = 0;
                        $sugerida = 0;
                        $minima = 0;
                    } else {
                        $neta = 0;
                        $sugerida = $pricRecargo->getCaVlrrecargo();
                        $minima = $pricRecargo->getCaVlrminimo();
                    }
                    $tarifario[] = array(
                        'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                        'neta_tar' => number_format($neta, $precision, '.', ','),
                        'moneda' => $pricRecargo->getCaIdmoneda(),
                        'sugerida_tar' => number_format($sugerida, $precision, '.', ','),
                        'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                        'minima_tar' => number_format($minima, $precision, '.', ','),
                        'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                        'inicio' => $pricRecargo->getCaFchinicio(),
                        'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                        'observaciones' => utf8_encode(str_replace("\"", "'", $pricRecargo->getCaObservaciones())),
                        'id_aplica' => hash('md5', $pricRecargo->getCaAplicacion()),
                        'sel' => true
                    );
                    if (!$aplica[hash('md5', $pricRecargo->getCaAplicacion())]) {
                        $aplica[hash('md5', $pricRecargo->getCaAplicacion())] = utf8_encode($pricRecargo->getCaAplicacion());
                    }
                }
            }
            $row = array(
                'consecutivo' => $pricConcepto->getCaConsecutivo(),
                'idconcepto' => $pricConcepto->getCaIdconcepto(),
                'nconcepto' => utf8_encode($pricConcepto->getConcepto()->getCaConcepto()),
                'tarifario' => $tarifario,
                'aplicaciones' => $aplica
            );
            $data[] = $row;
        }

        $q = Doctrine_Query::create()->from("PricRecargoxCiudad r");
        $q->innerJoin("r.TipoRecargo t");
        $q->addWhere("r.ca_idtrafico = ? AND (r.ca_idciudad = ? OR r.ca_idciudad = '999-9999') AND r.ca_transporte= ? AND r.ca_modalidad= ? AND r.ca_impoexpo = ?",
                array($trayecto->getOrigen()->getCaIdtrafico(), $trayecto->getCaOrigen(), $trayecto->getCaTransporte(), $trayecto->getCaModalidad(), $trayecto->getCaImpoexpo()));
        $q->addOrderBy("t.ca_recargo");
        $pricRecargosxCiudad = $q->execute();
        $aplica = array();

        if ($pricRecargosxCiudad) {
            foreach ($pricRecargosxCiudad as $pricRecargo) {
                if ($pricRecargo->getCaFcheliminado() != "") {
                    if (!$timestamp)
                        continue;
                    else if (Utils::compararFechas($pricRecargo->getCaFcheliminado(), $fchcorte) == -1)
                        continue;
                }
                $tipoRecargo = $pricRecargo->getTipoRecargo();
                $sugerida = $pricRecargo->getCaVlrrecargo();
                $minima = $pricRecargo->getCaVlrminimo();
                $neta = 0;
                $recargos[] = array(
                    'nconcepto' => utf8_encode($tipoRecargo->getCaRecargo()),
                    'neta_tar' => number_format($neta, $precision, '.', ','),
                    'moneda' => $pricRecargo->getCaIdmoneda(),
                    'sugerida_tar' => number_format($sugerida, $precision, '.', ','),
                    'aplicacion' => utf8_encode($pricRecargo->getCaAplicacion()),
                    'minima_tar' => number_format($minima, $precision, '.', ','),
                    'aplicacion_min' => utf8_encode($pricRecargo->getCaAplicacionMin()),
                    'inicio' => $pricRecargo->getCaFchinicio(),
                    'vencimiento' => $pricRecargo->getCaFchvencimiento(),
                    'observaciones' => utf8_encode(str_replace("\"", "'", $pricRecargo->getCaObservaciones())),
                    'id_aplica' => hash('md5', $pricRecargo->getCaAplicacion()),
                    'sel' => true
                );
                if (!$aplica[hash('md5', $pricRecargo->getCaAplicacion())]) {
                    $aplica[hash('md5', $pricRecargo->getCaAplicacion())] = utf8_encode($pricRecargo->getCaAplicacion());
                }
            }
        }

        if (count($recargos)) {
            $row = array(
                'consecutivo' => '9999',
                'idconcepto' => $pricConcepto->getCaIdconcepto(),
                'nconcepto' => 'Recargos Generales del Trayecto',
                'tarifario' => $recargos,
                'aplicaciones' => $aplica
            );
            $data[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

}

?>
