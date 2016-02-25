<?php

/**
 * inoExpo actions.
 *
 * @package    symfony
 * @subpackage inoExpo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inoExpoActions extends sfActions {

    /**
     * Pantalla de entrada para Gestion Documentos de Transporte
     *
     * @param sfRequest $request A request object
     */
    public function executeGestionDocsTransporte(sfWebRequest $request) {
        $this->filtros = array("ca_referencia" => "Número de Referencia");
    }

    /**
     * Lista de Referencias para Gestion Documentos de Transporte
     *
     * @param sfRequest $request A request object
     */
    public function executeGestionDocsTransporteList(sfWebRequest $request) {
        $this->selFiltro = $request->getParameter("selFiltro");
        $this->cadena = $request->getParameter("cadena");
        $this->data = array();

        $referencias_rs = Doctrine::getTable("InoMaestraExpo")
                ->createQuery("i")
                ->where("i.ca_referencia like '%$this->cadena%'")
                //->getSqlQuery();
                ->execute();
        foreach ($referencias_rs as $key => $referencia) {
            $row = array();
            $row["ca_referencia"] = $referencia->getCaReferencia();
            $row["ca_compania"] = $referencia->getCliente()->getCaCompania();
            $row["ca_traorigen"] = $referencia->getOrigen()->getTrafico()->getCaNombre();
            $row["ca_ciuorigen"] = $referencia->getOrigen()->getCaCiudad();
            $row["ca_tradestino"] = $referencia->getDestino()->getTrafico()->getCaNombre();
            $row["ca_ciudestino"] = $referencia->getDestino()->getCaCiudad();
            $row["ca_fchreferencia"] = $referencia->getCaFchreferencia();
            $row["ca_via"] = $referencia->getCaVia();
            $this->data[] = $row;
        }
    }

    /**
     * Definicion de los Documentos de Transporte
     *
     * @param sfRequest $request A request object
     */
    public function executeDefinicionDocsTransporteExt4(sfWebRequest $request) {
        
    }

    /**
     * Definicion de los Documentos de Transporte
     *
     * @param sfRequest $request A request object
     */
    public function executeNumerosDocsTransporteExt4(sfWebRequest $request) {
        
    }

    public function executeDatosPortDischarge(sfWebRequest $request) {
        $query = strtolower($this->getRequestParameter("query"));
        $data = array();
        if ($query) {
            $con = Doctrine_Manager::getInstance()->connection();

            $sql = "select c.ca_idciudad, c.ca_ciudad, t.ca_nombre as ca_trafico from tb_ciudades c"
                    . " inner join tb_traficos t on t.ca_idtrafico = c.ca_idtrafico"
                    . " where lower(c.ca_ciudad) like '%$query%'"
                    . " order by t.ca_nombre, c.ca_ciudad";

            $rs = $con->execute($sql);
            $ciudades_rs = $rs->fetchAll();
            foreach ($ciudades_rs as $ciudad) {
                $data[] = array("idciudad" => $ciudad["ca_idciudad"], "ciudad" => utf8_encode($ciudad["ca_ciudad"]), "trafico" => utf8_encode(strtoupper($ciudad["ca_trafico"])));
            }
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosDocsTransporte(sfWebRequest $request) {
        $referencia = $this->getRequestParameter("id");
        $documentos = Doctrine::getTable("ExpoDoctransporte")
                ->createQuery("e")
                ->addWhere("e.ca_referencia = ?", $referencia)
                ->execute();
        $data = array();

        foreach ($documentos as $documento) {
            $data[] = array("iddoctransporte" => $documento->getCaIddoctransporte(),
                "referencia" => $documento->getCaReferencia(),
                "traorigen" => utf8_encode($documento->getInoMaestraExpo()->getOrigen()->getTrafico()->getCaNombre()),
                "ciuorigen" => utf8_encode($documento->getInoMaestraExpo()->getOrigen()->getCaCiudad()),
                "tradestino" => utf8_encode($documento->getInoMaestraExpo()->getDestino()->getTrafico()->getCaNombre()),
                "ciudestino" => utf8_encode($documento->getInoMaestraExpo()->getDestino()->getCaCiudad()),
                "consecutivo" => $documento->getCaConsecutivo(),
                "fchdoctransporte" => $documento->getCaFchdoctransporte(),
                "port_discharge" => utf8_encode($documento->getCaPortDischarge()),
                "terminos_transporte" => $documento->getCaTerminosTransporte(),
                "liberacion" => $documento->getCaLiberacion(),
                "ocean_vessel" => utf8_encode($documento->getCaOceanVessel()),
                "declaration_interest" => utf8_encode($documento->getCaDeclarationInterest()),
                "declared_value" => utf8_encode($documento->getCaDeclaredValue()),
                "freight_amount" => utf8_encode($documento->getCaFreightAmount()),
                "freight_payable" => utf8_encode($documento->getCaFreightPayable()),
                "number_original" => utf8_encode($documento->getCaNumberOriginal()),
                "delivery_goods" => utf8_encode($documento->getCaDeliveryGoods()),
                "font_size" => $documento->getCaFontSize()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosNumsDocsTransporte(sfWebRequest $request) {
        $numeros = Doctrine::getTable("ExpoDocNumbers")
                ->createQuery("n")
                ->orderBy("ca_consecutivo")
                ->execute();
        $data = array();

        foreach ($numeros as $numero) {
            $data[] = array("consecutivo" => $numero->getCaConsecutivo(),
                "referencia" => utf8_encode($numero->getCaReferencia()),
                "observaciones" => utf8_encode($numero->getCaObservaciones()),
                "fchcreado" => $numero->getCaFchcreado(),
                "usucreado" => $numero->getCaUsucreado(),
                "fchimpreso" => $numero->getCaFchimpreso(),
                "usuimpreso" => $numero->getCaUsuimpreso(),
                "fchremitido" => $numero->getCaFchremitido(),
                "usuremitido" => $numero->getCaUsuremitido(),
                "fchanulado" => $numero->getCaFchanulado(),
                "usuanulado" => $numero->getCaUsuanulado()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeConsecutivosDisponibles(sfWebRequest $request) {
        $consecutivo = $this->getRequestParameter("consecutivo");
        $con = Doctrine_Manager::getInstance()->connection();
        
        $filtro = "(ca_referencia is null and ca_fchimpreso is null and ca_fchanulado is null)";
        if($consecutivo){
            $filtro.= " or ca_consecutivo = $consecutivo";
        }
        $sql = "select c.ca_consecutivo from tb_expo_doc_numbers c where $filtro order by c.ca_consecutivo";

        $rs = $con->execute($sql);
        $consecutivos_rs = $rs->fetchAll();
        foreach ($consecutivos_rs as $consecutivo) {
            $data[] = array("consecutivo" => $consecutivo["ca_consecutivo"]);
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeRegistrarNumsDocsTransporte(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoDocNumbers")->getConnection();
        $conn->beginTransaction();
        try {
            for ($i = $datos->inicio; $i <= $datos->final; $i++) {
                $expoDocNumbers = new ExpoDocNumbers();
                $expoDocNumbers->setCaConsecutivo($i);
                $expoDocNumbers->save();
            }
            $conn->commit();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeRemitirNumsDocsTransporte(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoDocNumbers")->getConnection();
        $conn->beginTransaction();
        try {
            for ($i = $datos->inicio; $i <= $datos->final; $i++) {
                $expoDocNumbers = Doctrine::getTable('ExpoDocNumbers')->find($i);
                if ($expoDocNumbers) {
                    $expoDocNumbers->setCaObservaciones(utf8_decode($datos->observaciones));
                    $expoDocNumbers->setCaUsuremitido($this->getUser()->getUserId());
                    $expoDocNumbers->setCaFchremitido(date("Y-m-d H:i:s"));
                    $expoDocNumbers->save();
                }
            }
            $conn->commit();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeAnularNumsDocsTransporte(sfWebRequest $request) {
        $consecutivo = $request->getParameter("consecutivo");

        $conn = Doctrine::getTable("ExpoDocNumbers")->getConnection();
        $expoDocNumbers = Doctrine::getTable('ExpoDocNumbers')->find($consecutivo);
        $conn->beginTransaction();
        if ($expoDocNumbers) {
            try {
                $expoDocNumbers->setCaUsuanulado($this->getUser()->getUserId());
                $expoDocNumbers->setCaFchanulado(date("Y-m-d H:i:s"));
                $expoDocNumbers->save();

                $conn->commit();
                $this->responseArray = array("success" => "true");
            } catch (Exception $e) {
                $conn->rollback();
                $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeImprimirDocsTransporte(sfWebRequest $request) {
        $this->documento = Doctrine::getTable("ExpoDoctransporte")
                ->createQuery("e")
                ->addWhere("e.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->fetchOne();
        $this->referencia = $this->documento->getInoMaestraExpo();

        $consecutivo = $this->referencia->getCaConsecutivo();

        $this->reporte = Doctrine::getTable("Reporte")
                ->createQuery("r")
                ->where("r.ca_consecutivo = ?", $consecutivo)
                ->addWhere("r.ca_fchanulado IS NULL")
                ->addOrderBy("r.ca_version DESC")
                ->limit(1)
                ->fetchOne();

        $this->consignatario = Doctrine::getTable("Tercero")->find($this->reporte->getCaIdconsignatario());
        $this->notify = Doctrine::getTable("Tercero")->find($this->reporte->getCaIdnotify());
        $this->discharge = Doctrine::getTable("Ciudad")->find($this->documento->getCaPortDischarge());
        $this->usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $this->borrador = ($this->getRequestParameter("borrador")=='true')?true:false;
        $this->plantilla = ($this->getRequestParameter("plantilla")=='true')?true:false;
    }

    public function executeDatosItemsDocs(sfWebRequest $request) {
        $items = Doctrine::getTable("ExpoDocItems")
                ->createQuery("i")
                ->addWhere("i.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->execute();
        $data = array();

        foreach ($items as $item) {
            $data[] = array("iddoctransporte" => $item->getCaIddoctransporte(),
                "item_number" => $item->getCaItemNumber(),
                "container_number" => $item->getCaContainerNumber(),
                "number_packages" => $item->getCaNumberPackages(),
                "kind_packages" => $item->getCaKindPackages(),
                "gross_weight" => $item->getCaGrossWeight(),
                "gross_unit" => $item->getCaGrossUnit(),
                "net_weight" => $item->getCaNetWeight(),
                "net_unit" => $item->getCaNetUnit(),
                "measurement_weight" => $item->getCaMeasurementWeight(),
                "measurement_unit" => $item->getCaMeasurementUnit(),
                "seals" => $item->getCaSeals(),
                "marks_numbers" => $item->getCaMarksNumbers(),
                "description_goods" => $item->getCaDescriptionGoods(),
                "same_goods" => $item->getCaSameGoods()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarDocsTransporte(sfWebRequest $request) {
        $referencia = $request->getParameter("id");
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoDoctransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if (!$datos->iddoctransporte) {
                $expoDoctransporte = new ExpoDoctransporte();
                $expoDoctransporte->setCaReferencia($referencia);
            } else {
                $expoDoctransporte = Doctrine::getTable("ExpoDoctransporte")
                        ->createQuery("d")
                        ->addWhere("d.ca_iddoctransporte = ?", $datos->iddoctransporte)
                        ->fetchOne();
            }

            if ($datos->consecutivo) {
                $expoDocNumbers = Doctrine::getTable('ExpoDocNumbers')->find($datos->consecutivo);
                if ($expoDocNumbers) {
                    $expoDocNumbers->setCaReferencia($referencia);
                    $expoDocNumbers->save();
                }
                $expoDoctransporte->setCaConsecutivo($datos->consecutivo);
            }

            if ($datos->fchdoctransporte) {
                $expoDoctransporte->setCaFchdoctransporte($datos->fchdoctransporte);
            }
            if ($datos->port_discharge) {
                $expoDoctransporte->setCaPortDischarge($datos->port_discharge);
            }
            if ($datos->terminos_transporte) {
                $expoDoctransporte->setCaTerminosTransporte($datos->terminos_transporte);
            }
            if ($datos->liberacion) {
                $expoDoctransporte->setCaLiberacion($datos->liberacion);
            }
            if ($datos->ocean_vessel) {
                $expoDoctransporte->setCaOceanVessel(utf8_decode($datos->ocean_vessel));
            }
            if ($datos->declaration_interest) {
                $expoDoctransporte->setCaDeclarationInterest(utf8_decode($datos->declaration_interest));
            }
            if ($datos->declared_value) {
                $expoDoctransporte->setCaDeclaredValue(utf8_decode($datos->declared_value));
            }
            if ($datos->freight_amount) {
                $expoDoctransporte->setCaFreightAmount(utf8_decode($datos->freight_amount));
            }
            if ($datos->freight_payable) {
                $expoDoctransporte->setCaFreightPayable(utf8_decode($datos->freight_payable));
            }
            if ($datos->number_original) {
                $expoDoctransporte->setCaNumberOriginal($datos->number_original);
            }
            if ($datos->delivery_goods) {
                $expoDoctransporte->setCaDeliveryGoods(utf8_decode($datos->delivery_goods));
            }
            if ($datos->font_size) {
                $expoDoctransporte->setCaFontSize($datos->font_size);
            }
            $expoDoctransporte->save();
            $conn->commit();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarItemsDocs(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoDocItems")->getConnection();
        $conn->beginTransaction();
        try {

            if (!$datos->item_number) {
                $item = new ExpoDocItems();
                $item->setCaIddoctransporte($datos->iddoctransporte);
            } else {
                $item = Doctrine::getTable("ExpoDocItems")
                        ->createQuery("i")
                        ->addWhere("i.ca_iddoctransporte = ?", $datos->iddoctransporte)
                        ->addWhere("i.ca_item_number = ?", $datos->item_number)
                        ->fetchOne();
            }
            if ($datos->container_number) {
                $item->setCaContainerNumber($datos->container_number);
            }
            if (isset($datos->number_packages)) {
                $item->setCaNumberPackages($datos->number_packages);
            }
            if (isset($datos->kind_packages)) {
                $item->setCaKindPackages($datos->kind_packages);
            }
            if ($datos->gross_weight) {
                $item->setCaGrossWeight($datos->gross_weight);
            }
            if ($datos->gross_unit) {
                $item->setCaGrossUnit($datos->gross_unit);
            }
            if ($datos->net_weight) {
                $item->setCaNetWeight($datos->net_weight);
            }
            if ($datos->net_unit) {
                $item->setCaNetUnit($datos->net_unit);
            }
            if ($datos->measurement_weight) {
                $item->setCaMeasurementWeight($datos->measurement_weight);
            }
            if ($datos->measurement_unit) {
                $item->setCaMeasurementUnit($datos->measurement_unit);
            }
            if ($datos->seals) {
                $item->setCaSeals($datos->seals);
            }
            if ($datos->marks_numbers) {
                $item->setCaMarksNumbers($datos->marks_numbers);
            }
            if (isset($datos->description_goods)) {
                $item->setCaDescriptionGoods($datos->description_goods);
            }
            if ($datos->same_goods) {
                $item->setCaSameGoods($datos->same_goods);
            }
            $item->save();

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    /**
     * Abre, cierra o liquida un caso de exportaciones
     *
     * @param sfRequest $request A request object
     */
    public function executeLiquidarCerrarReferencia(sfWebRequest $request) {
        $noReferencia = $request->getParameter("referencia");
        $this->forward404Unless($noReferencia);

        $referencia = Doctrine::getTable("InoMaestraExpo")->find($noReferencia);
        $this->forward404Unless($referencia);

        if ($referencia->getCaFchliquidado()) {
            if ($referencia->getCaFchcerrado()) {
                $referencia->setCaFchcerrado(null);
                $referencia->setCaUsucerrado(null);
                $referencia->save();
            } else {

                $numIngresos = Doctrine::getTable("InoIngresosExpo")
                        ->createQuery("i")
                        ->select("count(*)")
                        ->where("i.ca_referencia = ?", $referencia->getCaReferencia())
                        ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                        ->execute();

                if ($numIngresos == 0) {
                    $this->mensaje = "No puede cerrar un caso sin facturas de cliente";
                    $this->referencia = $referencia;
                    return sfView::ERROR;
                }

                $numCostos = Doctrine::getTable("InoCostoExpo")
                        ->createQuery("i")
                        ->select("count(*)")
                        ->where("i.ca_referencia = ?", $referencia->getCaReferencia())
                        ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                        ->execute();

                if ($numCostos == 0) {
                    $this->mensaje = "No puede cerrar un caso sin facturas de costos";
                    $this->referencia = $referencia;
                    return sfView::ERROR;
                }

                $referencia->setCaFchcerrado(date("Y-m-d H:i:s"));
                $referencia->setCaUsucerrado($this->getUser()->getUserId());
                $referencia->save();
            }
        } else {
            $this->mensaje = "No puede cerrar un caso sin liquidarlo";
            $this->referencia = $referencia;
            return sfView::ERROR;
        }

        $this->redirect("/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=" . $referencia->getCaReferencia());
    }

    public function executeFormAlerta(sfWebRequest $request) {
        $noReferencia = $request->getParameter("referencia");
        $this->forward404Unless($noReferencia);

        $referencia = Doctrine::getTable("InoMaestraExpo")->find($noReferencia);
        $this->forward404Unless($referencia);

        if ($request->getParameter("idalerta")) {
            $expoAlerta = Doctrine::getTable("ExpoAlerta")->find($request->getParameter("idalerta"));
            $this->forward404Unless($expoAlerta);
        } else {
            $expoAlerta = new ExpoAlerta();
        }

        $this->form = new AlertaForm();
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();

            $bindValues["referencia"] = $request->getParameter("referencia");
            $bindValues["fchrecordatorio"] = $request->getParameter("fchrecordatorio");
            $bindValues["fchvencimiento"] = $request->getParameter("fchvencimiento");
            $bindValues["cuerpoalerta"] = $request->getParameter("cuerpoalerta");
            $bindValues["notificar"] = $request->getParameter("notificar");
            $bindValues["notificar_jefe"] = $request->getParameter("notificar_jefe");
            $bindValues["copiarChkbox"] = $request->getParameter("copiarChkbox");

            $this->form->bind($bindValues);

            if ($this->form->isValid()) {
                $expoAlerta->setCaReferencia($bindValues["referencia"]);
                $expoAlerta->setCaFchrecordatorio($bindValues["fchrecordatorio"]);
                $expoAlerta->setCaFchvencimiento($bindValues["fchvencimiento"]);
                $expoAlerta->setCaCuerpoalerta($bindValues["cuerpoalerta"]);

                if ($bindValues["copiarChkbox"]) {
                    $expoAlerta->setCaNotificar($bindValues["notificar"]);
                    $expoAlerta->setCaNotificarJefe($bindValues["notificar_jefe"]);
                } else {
                    $expoAlerta->setCaNotificar(null);
                }

                $expoAlerta->save();

                $this->redirect("/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=" . $referencia->getCaReferencia());
            }
        }

        $this->referencia = $referencia;
        $this->expoAlerta = $expoAlerta;
    }

}