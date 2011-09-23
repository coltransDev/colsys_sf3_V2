<?php

/**
 * Modulo preliquidador de costos de transporte y aduana, basado en tarifario.
 *
 *
 *
 * @package    colsys
 * @subpackage Preliquidador
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class preliquidadorActions extends sfActions {

    /**
     * @author Carlos Gilberto López M.
     */
    public function executeIndex() {
        return $this->forward('preliquidador', 'principal');
    }

    /*
     * Pantalla principal del Preliquidador
     */

    public function executePrincipal() {
    }

    public function executeCalculaLiquidacion(sfWebRequest $request) {
        $response = sfContext::getInstance()->getResponse();

        $this->opcion = $request->getParameter("opcion");

        $this->impoexpo = $request->getParameter("impoexpo");
        $this->transporte = $request->getParameter("transporte");
        $this->modalidad = $request->getParameter("modalidad");

        $this->idconcepto = $request->getParameter("idconcepto");
        $this->idConcepto = $request->getParameter("idConcepto");
        $this->idorigen = $request->getParameter("idorigen");
        $this->idOrigen = $request->getParameter("idOrigen");
        $this->iddestino = $request->getParameter("iddestino");
        $this->idDestino = $request->getParameter("idDestino");
        $this->idlinea = $request->getParameter("idlinea");
        $this->linea = $request->getParameter("linea");

        $this->piezas = $request->getParameter("piezas");
        $this->pallets = $request->getParameter("pallets");
        $this->cantidad = $request->getParameter("cantidad");
        $this->cantidadDocs = $request->getParameter("cantidadDocs");
        $this->cantidadWH = $request->getParameter("cantidadWH");
        $this->vlrAsegurado = $request->getParameter("vlrAsegurado");

        $this->responseArray = array();

        if ($this->opcion) {
            $q = Doctrine::getTable("Trayecto")
                            ->createQuery("t")
                            ->where("ca_modalidad = ? AND ca_impoexpo = ? AND ca_transporte = ? AND ca_origen = ? AND ca_destino = ?", array( $this->modalidad, $this->impoexpo, $this->transporte, $this->idorigen, $this->iddestino) );
            if ($this->idlinea) {
                $q->addWhere( "t.ca_idlinea = ?", $this->idlinea );
            }
            $q->addWhere( "t.ca_activo = ?", TRUE );

            $trayectos = $q->execute();
            foreach ($trayectos as $trayecto){
                $idag = $trayecto->getIdsAgente();
                $ids = $idag->getIds();
                $baseRow = array(
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

                $s = Doctrine::getTable("PricFlete")->createQuery()
                                ->addWhere("ca_idtrayecto = ?", $trayecto->getCaIdtrayecto())
                                ->addWhere("ca_idconcepto = ?", $this->idconcepto);
                if ($idequipo) {
                    $s->addWhere("ca_idequipo= ?", $idequipo);
                } else {
                    $s->addWhere("ca_idequipo IS NULL");
                }
                $fletes = $s->execute();

                $row = $baseRow;
                $array_fletes = array();
                foreach ($fletes as $flete){
                    $array_fletes[] =
                    array(
                        "concepto" => $flete->getConcepto()->getCaConcepto(),
                        "liminferior" => $flete->getConcepto()->getCaLiminferior(),
                        "vlrneto" => $flete->getCaVlrneto(),
                        "vlrsugerido" => $flete->getCaVlrsugerido(),
                        "idmoneda" => $flete->getCaIdmoneda(),
                        "aplicacion" => $flete->getCaAplicacion(),
                        "fchinicio" => $flete->getCaFchinicio(),
                        "fchvencimiento" => $flete->getCaFchvencimiento()
                    );
                }
                $row['fletes'] = $array_fletes;

                $s = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                                ->addWhere("ca_idtrayecto = ?", $trayecto->getCaIdtrayecto())
                                ->addWhere("ca_idconcepto = ? or ca_idconcepto = ?", array($this->idconcepto,9999) );
                if ($idequipo) {
                    $s->addWhere("ca_idequipo= ?", $idequipo);
                } else {
                    $s->addWhere("ca_idequipo IS NULL");
                }
                $recargos = $s->execute();

                $array_recargos = array();
                foreach ($recargos as $recargo){
                    $array_recargos[] =
                    array(
                        "recargo" => $recargo->getTipoRecargo()->getCaRecargo(),
                        "vlrrecargo" => $recargo->getCaVlrrecargo(),
                        "aplicacion" => $recargo->getCaAplicacion(),
                        "vlrminimo" => $recargo->getCaVlrminimo(),
                        "aplicacionmin" => $recargo->getCaAplicacionMin(),
                        "observaciones" => $recargo->getCaObservaciones(),
                        "idmoneda" => $recargo->getCaIdmoneda(),
                        "fchinicio" => $recargo->getCaFchinicio(),
                        "fchvencimiento" => $recargo->getCaFchvencimiento()
                    );
                }

                $s = Doctrine::getTable("PricRecargoxCiudad")->createQuery()
                                ->addWhere("ca_idtrafico = ?", $trayecto->getOrigen()->getTrafico()->getCaIdtrafico() )
                                ->addWhere("ca_idciudad = ? OR ca_idciudad = ?", array($trayecto->getOrigen()->getCaIdciudad(), '999-9999') )
                                ->addWhere("ca_modalidad = ? AND ca_impoexpo = ? AND ca_transporte = ?", array($this->modalidad, $this->impoexpo, $this->transporte) );
                $recargos = $s->execute();

                foreach ($recargos as $recargo){
                    $array_recargos[] =
                    array(
                        "recargo" => $recargo->getTipoRecargo()->getCaRecargo(),
                        "vlrrecargo" => $recargo->getCaVlrrecargo(),
                        "aplicacion" => $recargo->getCaAplicacion(),
                        "vlrminimo" => $recargo->getCaVlrminimo(),
                        "aplicacionmin" => $recargo->getCaAplicacionMin(),
                        "observaciones" => $recargo->getCaObservaciones(),
                        "idmoneda" => $recargo->getCaIdmoneda(),
                        "fchinicio" => $recargo->getCaFchinicio(),
                        "fchvencimiento" => $recargo->getCaFchvencimiento()
                    );
                }

                $s = Doctrine::getTable("PricRecargoxLinea")->createQuery()
                                ->addWhere("ca_idtrafico = ? AND ca_idlinea = ?", array($trayecto->getOrigen()->getTrafico()->getCaIdtrafico(),$trayecto->getCaIdlinea()) )
                                ->addWhere("ca_idconcepto = ? OR ca_idconcepto = ?", array($this->idconcepto,9999) )
                                ->addWhere("ca_modalidad = ? AND ca_impoexpo = ? AND ca_transporte = ?", array($this->modalidad, $this->impoexpo, $this->transporte) );
                $recargos = $s->execute();

                foreach ($recargos as $recargo){
                    $array_recargos[] =
                    array(
                        "recargo" => $recargo->getTipoRecargo()->getCaRecargo(),
                        "vlrrecargo" => $recargo->getCaVlrrecargo(),
                        "aplicacion" => $recargo->getCaAplicacion(),
                        "vlrminimo" => $recargo->getCaVlrminimo(),
                        "aplicacionmin" => $recargo->getCaAplicacionMin(),
                        "observaciones" => $recargo->getCaObservaciones(),
                        "idmoneda" => $recargo->getCaIdmoneda(),
                        "fchinicio" => $recargo->getCaFchinicio(),
                        "fchvencimiento" => $recargo->getCaFchvencimiento()
                    );
                }

                $row['recargos'] = $array_recargos;

                $s = Doctrine::getTable("PricRecargoxCiudad")->createQuery()
                                ->addWhere("ca_idtrafico = ? AND ca_idciudad = ?", array('99-999', '999-9999') )
                                ->addWhere("ca_modalidad = ? AND ca_impoexpo = ? AND ca_transporte = ?", array($this->modalidad, $this->impoexpo, $this->transporte) );
                $recargos = $s->execute();

                $array_locales = array();
                foreach ($recargos as $recargo){
                    $array_locales[] =
                    array(
                        "recargo" => $recargo->getTipoRecargo()->getCaRecargo(),
                        "vlrrecargo" => $recargo->getCaVlrrecargo(),
                        "aplicacion" => $recargo->getCaAplicacion(),
                        "vlrminimo" => $recargo->getCaVlrminimo(),
                        "aplicacionmin" => $recargo->getCaAplicacionMin(),
                        "observaciones" => $recargo->getCaObservaciones(),
                        "idmoneda" => $recargo->getCaIdmoneda(),
                        "fchinicio" => $recargo->getCaFchinicio(),
                        "fchvencimiento" => $recargo->getCaFchvencimiento()
                    );
                }

                $row['locales'] = $array_locales;


                $idgrupo = $trayecto->getOrigen()->getTrafico()->getCaIdgrupo();

                $s = Doctrine::getTable("PricSeguro")->createQuery()
                                ->addWhere("ca_idgrupo = ?", $idgrupo )
                                ->addWhere("ca_transporte = ?", $this->transporte );
                $seguros = $s->execute();

                $array_seguros = array();
                foreach ($seguros as $seguro){
                    $array_seguros[] =
                    array(
                        "vlrprima" => $seguro->getCaVlrprima(),
                        "idmoneda" => $seguro->getCaIdmoneda(),
                        "vlrobtencionpoliza" => $seguro->getCaVlrobtencionpoliza(),
                        "idmonedaobtencion" => $seguro->getCaIdmonedaobtencion(),
                        "observaciones" => $seguro->getCaObservaciones());
                }

                $row['seguros'] = $array_seguros;

                $this->responseArray[] = $row;
            }
        }
    }

}

?>