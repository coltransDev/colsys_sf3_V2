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
        $this->via = $request->getParameter("via");
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

    public function executeDatosCarriers(sfWebRequest $request) {
        $query = strtolower($this->getRequestParameter("query"));
        $data = array();
        if ($query) {
            $carriers = Doctrine::getTable("ExpoCarrier")
                ->createQuery("c")
                ->addWhere("lower(c.ca_carrier) like '%$query%'")
                //->getSQLQuery();
                ->execute();
            
            foreach ($carriers as $carrier) {
                $data[] = array("idcarrier" => $carrier->getCaIdcarrier(), "carrier" => utf8_encode($carrier->getCaCarrier()));
            }
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeValoresPorDefecto(sfWebRequest $request) {
        $referencia = Doctrine::getTable("InoMaestraExpo")->find($request->getParameter("referencia"));
        $this->forward404Unless($referencia);
        
        $consecutivo = $referencia->getCaConsecutivo();

        $reporte = Doctrine::getTable("Reporte")
                ->createQuery("r")
                ->where("r.ca_consecutivo = ?", $consecutivo)
                ->addWhere("r.ca_fchanulado IS NULL")
                ->addOrderBy("r.ca_version DESC")
                ->limit(1)
                ->fetchOne();
        
        $data = array();
        if( $request->getParameter("idconfig") ){
            $config = Doctrine::getTable("ColsysConfig")->find( $request->getParameter("idconfig") );
            $this->forward404Unless($config);
            
            $values = $config->getColsysConfigValue();
            foreach ($values as $value) {
                $data[$value->getCaValue2()] = utf8_encode($value->getCaValue());
            }
        }
        if($reporte->getCaModalidad() == "DIRECTO"){
            $data['nature_quantity'] = utf8_encode($reporte->getCaMercanciaDesc());
        }
        
        $con = Doctrine_Manager::connection();
        $sql = "select ca_fecha,ca_pesos,ca_euro from tb_trms t order by ca_fecha desc limit 1";
        $trm = $con->fetchArray($sql);
        
        $data['accounting_info'] = "T.C.$ ".number_format($trm[1], 2)."\nHAWB: ".$request->getParameter("referencia");
        $this->responseArray = array("success" => true, "data" => $data);

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

    public function executeDatosAwbsTransporte(sfWebRequest $request) {
        $referencia = $this->getRequestParameter("id");
        $documentos = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("e")
                ->addWhere("e.ca_referencia = ?", $referencia)
                ->execute();
        $data = array();

        foreach ($documentos as $documento) {
            $data[] = array("iddoctransporte" => $documento->getCaIddoctransporte(),
                "referencia" => $documento->getCaReferencia(),
                "iddestino_uno" => $documento->getCaIddestinoUno(),
                "idcarrier_uno" => $documento->getCaIdcarrierUno(),
                "carrier_uno" => $documento->getExpoCarrierUno()->getCaCarrier(),
                "iddestino_dos" => $documento->getCaIddestinoDos(),
                "idcarrier_dos" => $documento->getCaIdcarrierDos(),
                "carrier_dos" => $documento->getExpoCarrierDos()->getCaCarrier(),
                "iddestino_trs" => $documento->getCaIddestinoTrs(),
                "idcarrier_trs" => $documento->getCaIdcarrierTrs(),
                "carrier_trs" => $documento->getExpoCarrierTrs()->getCaCarrier(),
                "consecutivo" => $documento->getCaConsecutivo(),
                "fchdoctransporte" => $documento->getCaFchdoctransporte(),
                "charges_code" => $documento->getCaChargesCode(),
                "airport_departure" => $documento->getCaAirportDeparture(),
                "airport_destination" => $documento->getCaAirportDestination(),
                "accounting_info" => utf8_encode($documento->getCaAccountingInfo()),
                "handing_info" => utf8_encode($documento->getCaHandingInfo()),
                "number_packages" => $documento->getCaNumberPackages(),
                "kind_packages" => $documento->getCaKindPackages(),
                "gross_weight" => $documento->getCaGrossWeight(),
                "gross_unit" => $documento->getCaGrossUnit(),
                "weight_charge" => $documento->getCaWeightCharge(),
                "weight_details" => $documento->getCaWeightDetails(),
                "kind_rate" => $documento->getCaKindRate(),
                "rate_charge" => $documento->getCaRateCharge(),
                "due_agent" => $documento->getCaDueAgent(),
                "due_carrier" => $documento->getCaDueCarrier(),
                "commodity_item" => $documento->getCaCommodityItem(),
                "delivery_goods" => $documento->getCaDeliveryGoods(),
                "other_charges" => $documento->getCaOtherCharges(),
                "shipper_certifies" => $documento->getCaShipperCertifies(),
                "childrens" => $documento->getCaChildrens(),
                "fchliquidado" => $documento->getCaFchliquidado(),
                "usuliquidado" => $documento->getCaUsuliquidado()
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
        $this->items = Doctrine::getTable("ExpoDocItems")
                ->createQuery("d")
                ->addWhere("d.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->orderBy("d.ca_item_number")
                ->execute();
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
        $this->copia = ($this->getRequestParameter("copia")=='true')?true:false;
    }

    public function executeImprimirAwbsTransporte(sfWebRequest $request) {
        $this->documento = Doctrine::getTable("ExpoAwbtransporte")
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
        $this->empresa = Doctrine::getTable("Empresa")->find(2); // Localiza la empresa Coltrans
        
        $config = Doctrine::getTable("ColsysConfig")->find( 260 );
        $values = $config->getColsysConfigValue();
        $this->config = array();
        foreach ($values as $value) {
            $this->config[$value->getCaValue2()] = utf8_encode($value->getCaValue());
        }
        
        $this->consignatario = Doctrine::getTable("Tercero")->find($this->reporte->getCaIdconsignatario());
        $this->notify = Doctrine::getTable("Tercero")->find($this->reporte->getCaIdnotify());
        $this->usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $this->borrador = ($this->getRequestParameter("borrador")=='true')?true:false;
        $this->plantilla = ($this->getRequestParameter("plantilla")=='true')?true:false;
        $this->copia = ($this->getRequestParameter("copia")=='true')?true:false;
        $this->guiahija = ($this->getRequestParameter("guiahija")=='true')?true:false;
    }

    public function executeImprimirAwbsStickers(sfWebRequest $request) {
        $documento = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("e")
                ->addWhere("e.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->fetchOne();
        $referencia = $documento->getInoMaestraExpo();
        $this->stickers = array();
        
        $prefijo = $documento->getExpoCarrierUno()->getCaPrefijo();
        $consecutivo = $documento->getCaConsecutivo();
        if ($documento->getCaIddestinoTrs()){
            $destination = $documento->getCaIddestinoTrs();
        }elseif ($documento->getCaIddestinoDos()){
            $destination = $documento->getCaIddestinoDos();
        }else{
            $destination = $documento->getCaIddestinoUno();
        }
        
        $guia_numero = $prefijo. " " .$consecutivo. (($guiahija && count($guias)>1)?chr(65+$key):"");
        $mawb_pieces = $documento->getCaNumberPackages();
        
        if ($documento->getCaChildrens()){
            $guias = json_decode(html_entity_decode($documento->getCaChildrens()), true);
            foreach ($guias as $key => $guia){
                $ref_array = explode(".", $documento->getInoMaestraExpo()->getCaReferencia());
                $prefijo = $ref_array[0];
                // $ref_array[3] = ((count($guias)>1)?substr($ref_array[3],1,3):$ref_array[3]); // Si hay más de una guía hija, quita un cero al consecutivo
                $ref_array[3] = substr($ref_array[3],1,3); // Siempre quitará un dígito al consecutivo para la guía hija
                $consecutivo = $ref_array[1].$ref_array[2].$ref_array[3].$ref_array[4];
                $guia_hija = $prefijo. " " .$consecutivo. ((count($guias)>1)?chr(65+$key):"");

                $numero_stickers = $guia['number_packages'];
                for($i=0; $i< $numero_stickers; $i++){
                    $this->stickers[] = array(
                        "guia_numero" => $guia_numero,
                        "destination" => $destination,
                        "mawb_pieces" => $mawb_pieces,
                        "guia_hija" => $guia_hija,
                        "numero_stickers" => $numero_stickers
                    );
                }
            }
        }else {
            for($i=0; $i< $mawb_pieces; $i++){
                $this->stickers[] = array(
                    "guia_numero" => $guia_numero,
                    "destination" => $destination,
                    "mawb_pieces" => $mawb_pieces,
                    "guia_hija" => "",
                    "numero_stickers" => ""
                );
            }
        }
    }

    public function executeDatosItemsDocs(sfWebRequest $request) {
        $items = Doctrine::getTable("ExpoDocItems")
                ->createQuery("d")
                ->addWhere("d.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->orderBy("d.ca_item_number")
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
                "seals" => utf8_encode($item->getCaSeals()),
                "marks_numbers" => utf8_encode($item->getCaMarksNumbers()),
                "description_goods" => utf8_encode($item->getCaDescriptionGoods()),
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

    public function executeGuardarAwbsTransporte(sfWebRequest $request) {
        $referencia = $request->getParameter("id");
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if (!$datos->iddoctransporte) {
                $expoAwbtransporte = new ExpoAwbtransporte();
                $expoAwbtransporte->setCaReferencia($referencia);
            } else {
                $expoAwbtransporte = Doctrine::getTable("ExpoAwbtransporte")
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
                $expoAwbtransporte->setCaConsecutivo($datos->consecutivo);
            }

            if ($datos->fchdoctransporte) {
                $expoAwbtransporte->setCaFchdoctransporte($datos->fchdoctransporte);
            }
            if ($datos->iddestino_uno) {
                $expoAwbtransporte->setCaIddestinoUno($datos->iddestino_uno);
            }
            if ($datos->idcarrier_uno) {
                $expoAwbtransporte->setCaIdcarrierUno($datos->idcarrier_uno);
            }
            if ($datos->iddestino_dos) {
                $expoAwbtransporte->setCaIddestinoDos($datos->iddestino_dos);
            }
            if ($datos->idcarrier_dos) {
                $expoAwbtransporte->setCaIdcarrierDos($datos->idcarrier_dos);
            }
            if ($datos->iddestino_trs) {
                $expoAwbtransporte->setCaIddestinoTrs($datos->iddestino_trs);
            }
            if ($datos->idcarrier_trs) {
                $expoAwbtransporte->setCaIdcarrierTrs($datos->idcarrier_trs);
            }
            if ($datos->charges_code) {
                $expoAwbtransporte->setCaChargesCode($datos->charges_code);
            }
            if ($datos->airport_departure) {
                $expoAwbtransporte->setCaAirportDeparture($datos->airport_departure);
            }
            if ($datos->airport_destination) {
                $expoAwbtransporte->setCaAirportDestination($datos->airport_destination);
            }
            if ($datos->accounting_info) {
                $expoAwbtransporte->setCaAccountingInfo(utf8_decode($datos->accounting_info));
            }
            if ($datos->handing_info) {
                $expoAwbtransporte->setCaHandingInfo(utf8_decode($datos->handing_info));
            }
            if ($datos->shipper_certifies) {
                $expoAwbtransporte->setCaShipperCertifies(utf8_decode($datos->shipper_certifies));
            }
            $expoAwbtransporte->save();
            $conn->commit();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosHawbs(sfWebRequest $request) {
        $id = $request->getParameter("id");
        
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select ca_childrens from tb_expo_awbtransporte where ca_iddoctransporte = '$id' limit 1";
        $rs = $con->execute($sql);
        $expoHawbs = $rs->fetch();
        $datos = ($expoHawbs['ca_childrens'])?json_decode($expoHawbs['ca_childrens']):array();
        
        $this->responseArray = array("success" => true, "root" => $datos, "total" => count($datos));
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarHawbs(sfWebRequest $request) {
        $id = $request->getParameter("id");
        
        $documento = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("e")
                ->addWhere("e.ca_iddoctransporte = ?", $this->getRequestParameter("id"))
                ->fetchOne();
        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if ($documento){
                $documento->setCaChildrens($request->getParameter("datos"));
                $documento->save();
                $conn->commit();
            }
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeValidarGuiaNumero(sfWebRequest $request) {
        $referencia = $request->getParameter("ref");
        $consecutivo = $request->getParameter("datos");
        
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select ca_referencia from tb_expo_awbtransporte where ca_consecutivo = '$consecutivo' limit 1";
        $rs = $con->execute($sql);
        $expoAwbtransporte = $rs->fetch();
        
        if (!$expoAwbtransporte['ca_referencia']){
            $this->responseArray = array("success" => true, "valid" => true);
        }else{
            $this->responseArray = array("success" => true, "valid" => false, "errorInfo" => utf8_encode("Número de guía usado en Referencia ".$expoAwbtransporte['ca_referencia']));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarDocsTransporte(sfWebRequest $request) {
        $iddoctransporte = $request->getParameter("id");
        $conn = Doctrine::getTable("ExpoDoctransporte")->getConnection();
        $conn->beginTransaction();
        try {
            $expoDoctransporte = Doctrine::getTable("ExpoDoctransporte")
                    ->createQuery("d")
                    ->addWhere("d.ca_iddoctransporte = ?", $iddoctransporte)
                    ->fetchOne();
            if ($expoDoctransporte) {
                $expoDoctransporte->delete();
            }
            $conn->commit();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
        
    }

    public function executeEliminarAwbsTransporte(sfWebRequest $request) {
        $iddoctransporte = $request->getParameter("id");
        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            $expoDoctransporte = Doctrine::getTable("ExpoAwbtransporte")
                    ->createQuery("d")
                    ->addWhere("d.ca_iddoctransporte = ?", $iddoctransporte)
                    ->fetchOne();
            if ($expoDoctransporte) {
                $expoDoctransporte->delete();
            }
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
                $item->setCaContainerNumber(utf8_decode($datos->container_number));
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
                $item->setCaSeals(utf8_decode($datos->seals));
            }
            if ($datos->marks_numbers) {
                $item->setCaMarksNumbers(utf8_decode($datos->marks_numbers));
            }
            if (isset($datos->description_goods)) {
                $item->setCaDescriptionGoods(utf8_decode($datos->description_goods));
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

    public function executeGuardarLiquidDocs(sfWebRequest $request) {
        $referencia = $request->getParameter("id");
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);

        $conn = Doctrine::getTable("ExpoAwbtransporte")->getConnection();
        $conn->beginTransaction();
        try {
            if ($datos->iddoctransporte) {
                $expoAwbtransporte = Doctrine::getTable("ExpoAwbtransporte")
                        ->createQuery("d")
                        ->addWhere("d.ca_iddoctransporte = ?", $datos->iddoctransporte)
                        ->fetchOne();
            }
            if (isset($datos->number_packages)) {
                $expoAwbtransporte->setCaNumberPackages($datos->number_packages);
            }
            if (isset($datos->kind_packages)) {
                $expoAwbtransporte->setCaKindPackages($datos->kind_packages);
            }
            if ($datos->gross_weight or $datos->gross_weight == 0) {
                $expoAwbtransporte->setCaGrossWeight($datos->gross_weight);
            }
            if ($datos->gross_unit) {
                $expoAwbtransporte->setCaGrossUnit($datos->gross_unit);
            }
            if ($datos->weight_details) {
                $expoAwbtransporte->setCaWeightDetails($datos->weight_details);
            }
            if ($datos->weight_charge or $datos->weight_charge == 0) {
                $expoAwbtransporte->setCaWeightCharge($datos->weight_charge);
            }
            if ($datos->kind_rate) {
                $expoAwbtransporte->setCaKindRate($datos->kind_rate);
            }
            if ($datos->rate_charge or $datos->rate_charge == 0) {
                $expoAwbtransporte->setCaRateCharge($datos->rate_charge);
            }
            if ($datos->due_agent or $datos->due_agent == 0) {
                $expoAwbtransporte->setCaDueAgent($datos->due_agent);
            }
            if ($datos->due_carrier or $datos->due_carrier == 0) {
                $expoAwbtransporte->setCaDueCarrier($datos->due_carrier);
            }
            if ($datos->delivery_goods) {
                $expoAwbtransporte->setCaDeliveryGoods($datos->delivery_goods);
            }
            if ($datos->commodity_item) {
                $expoAwbtransporte->setCaCommodityItem($datos->commodity_item);
            }
            if ($datos->other_charges) {
                $expoAwbtransporte->setCaOtherCharges($datos->other_charges);
            }
            $expoAwbtransporte->setCaUsuliquidado($this->getUser()->getUserId());
            $expoAwbtransporte->setCaFchliquidado(date("Y-m-d H:i:s"));
            $expoAwbtransporte->save();

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
