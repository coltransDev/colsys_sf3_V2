<?php

/**
 * InoMasterSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class InoMasterSea extends BaseInoMasterSea {

    public function getArchivoXml($NumEnvio) {
        $user = sfContext::getInstance()->getUser();
        $conn = Doctrine_Manager::getInstance()->connection();
        try {
            $inoMaster = $this->getInoMaster();
            $parametros = ParametroTable::retrieveByCaso("CU073", null, null, null);

            $conn->beginTransaction();
            if ($this->getCaDatosmuisca()) {
                $master = json_decode(utf8_encode($this->getCaDatosmuisca()));

                $dianReservado = Doctrine::getTable("DianReservado")->find($master->iddocactual);

                if (!$dianReservado or $master->ca_numenvio != $NumEnvio) {
                    if (!$master->fchtrans) {
                        $event = "Error - Hay una incosistencia en informaci�n de Master para Muisca.";
                        throw new Exception($event);
                    }
                    $master->iddocactual = $iddocactual;
                    $master->numenvio = $NumEnvio;
                    $master->fchenvio = date("Y-m-d H:i:s");
                    $master->usuenvio = $user->getUserId();
                    $iddocactual = DianReservadoTable::retrieveLastAvailable($master->numenvio, $master->fchtrans);
                } else {
                    $iddocactual = $dianReservado->getCaNumeroResv();
                }

                if (!$iddocactual) {
                    $event = "Error - No hay n�meros de reserva disponibles.";
                    throw new Exception($event);
                }
            } else {
                $event = "Error - No hay informaci�n para Muisca.";
                throw new Exception($event);
            }

            // "Create" the document.
            $xml = new DOMDocument("1.0", "ISO-8859-1");

            // Se Crear el elemento mas
            $xml_mas = $xml->createElement("mas");
            $xml_mas->setAttributeNS("http://www.w3.org/2001/XMLSchema-instance", "xsi:noNamespaceSchemaLocation", "../xsd/1166.xsd");

            // Se Crear el elemento Cab
            $xml_cab = $xml->createElement("Cab");

            // Se Crear el elemento pal66
            $xml_pal66 = $xml->createElement("pal66");

            $FecEnvio = time();
            $ValorTotal = 0;
            $vlrfob = 0;
            $vlrflete = 0;
            $CantReg = 0;

            $xml_NumEnvio = $xml->createElement("NumEnvio", $NumEnvio);

            // Registra atributos del Elemento pal66
            if ($master->codconcepto == 3 or $master->codconcepto == 4) {
                $xml_pal66->setAttribute("ftra", $master->fchtrans);
            }
            $xml_pal66->setAttribute("ideDoc", $iddocactual);
            if ($master->iddocanterior != "") {
                $xml_pal66->setAttribute("nfan", $master->iddocanterior);
            }
            $ValorTotal += $master->tipodocviaje;  /* �Porqu� suma un capo TipoDocViaje? */
            $CantReg += 1;
            $xml_pal66->setAttribute("tdv", $master->tipodocviaje);
            $xml_pal66->setAttribute("cope", ($inoMaster->getCaImpoexpo() == "Importaci�n") ? 1 : (($inoMaster->getCaImpoexpo() == "Exportaci�n") ? 2 : 0));
            $xml_pal66->setAttribute("calo", 1);
            $xml_pal66->setAttribute("cres", 3);
            $xml_pal66->setAttribute("cadm", $master->codadministracion);
            $xml_pal66->setAttribute("dica", $master->dispocarga);

            $arribo_array = array();
            foreach ($parametros as $parametro) {
                if ($parametro["ca_identificacion"] == 9 and $parametro["ca_valor"] == $inoMaster->getCaDestino()) {
                    $arribo_array = explode("|", $parametro["ca_valor2"]);
                    break;
                }
            }
            $xml_pal66->setAttribute("cdde", $arribo_array[0]);
            $xml_pal66->setAttribute("ccd", $arribo_array[1]);
            $xml_pal66->setAttribute("cpa", $arribo_array[2]);

            if ($master->dispocarga != "21" and strlen($master->coddeposito) != 0) {
                $xml_pal66->setAttribute("cdep", $master->coddeposito);
            }

            $xml_pal66->setAttribute("ndv", $inoMaster->getCaMaster());
            $xml_pal66->setAttribute("fdv", $inoMaster->getCaFchmaster());

            $xml_pal66->setAttribute("cdhi", count($inoMaster->getInoHouse()));

            $mod_trans = "";
            foreach ($parametros as $parametro) {
                if ($parametro["ca_identificacion"] == 3 and $parametro["ca_valor"] == 'Mar�timo') {
                    $mod_trans = $parametro["ca_valor2"];
                    break;
                }
            }
            $xml_pal66->setAttribute("mtr", $mod_trans);

            if ($master->iddoctrasbordo != "") {
                $xml_pal66->setAttribute("ftrb", $master->iddoctrasbordo);
            }

            // =========================== Proveedor de Transporte ===========================
            $ids = Doctrine::getTable("Ids")
                    ->createQuery("i")
                    ->addWhere("i.ca_idalterno = ?", $master->idtransportista)
                    ->fetchOne();

            $xml_pal66->setAttribute("doc1", 31);
            $xml_pal66->setAttribute("nid1", $ids->getCaIdalterno());
            $xml_pal66->setAttribute("dv1", $ids->getCaDv());

            // =========================== Remitente = Agente en el Exterior ===========================
            $inoHouses = $inoMaster->getInoHouse();
            foreach ($inoHouses as $inoHouse) {      // Toma el Agente de uno de los reportes
                $agente = $inoHouse->getReporte()->getIdsAgente()->getIds();
                break;
            }
            $xml_pal66->setAttribute("doc2", 43);
            $xml_pal66->setAttribute("raz2", utf8_encode($agente->getCaNombre()));

            // =========================== Consignatario ===========================
            $xml_pal66->setAttribute("doc3", 31);
            $xml_pal66->setAttribute("nid3", 800024075);
            $xml_pal66->setAttribute("dv3", 8);

            $xml_pal66->setAttribute("dir3", "CRA 98 NO 25 G 10 INT 18");
            $xml_pal66->setAttribute("cde3", "11");
            $xml_pal66->setAttribute("ccd3", "001");

            // =========================== Caracter�sticas de la Operaci�n ===========================
            $xml_pal66->setAttribute("cond", $master->idcondiciones);
            $xml_pal66->setAttribute("rtr", $master->responsabilidad);
            $xml_pal66->setAttribute("tneg", $master->tiponegociacion);
            $xml_pal66->setAttribute("tcar", $master->tipocarga);
            $xml_pal66->setAttribute("pre", $master->precursores);

            $num_equipos = 0;       // Calcula el n�mero de equipos de la referencia
            $equipos = $inoMaster->getInoEquipo();
            foreach ($equipos as $equipo) {
                if ($equipo->getCaIdconcepto() != 9) {
                    $num_equipos++;
                }
            }
            $xml_pal66->setAttribute("ntc", $num_equipos);

            // =========================== Elementos Hijos ===========================
            $ntb = 0;  // N�mero Total Bultos
            $tpb = 0;  // Total Peso Bruto
            $unidades_carga = array();

            foreach ($inoHouses as $inoHouse) {      // Lee todos los Houses de la Referencia
                $inoHouseSea = $inoHouse->getInoHouseSea();
                // Se Crear el elemento hijo
                $xml_hijo = $xml->createElement("hijo");
                $hijo = json_decode(utf8_encode($inoHouseSea->getCaDatosmuisca()));

                $dianReservado = Doctrine::getTable("DianReservado")->find($hijo->iddocactual);

                if (!$dianReservado or $hijo->ca_numenvio != $NumEnvio) {
                    if (!$hijo->fchtrans) {
                        $event = "Error - Hay una incosistencia en informaci�n para Muisca en House: " . $inoHouse->getCaDoctransporte();
                        throw new Exception($event);
                    }
                    $hijo->iddocactual = $iddocactual;
                    $hijo->numenvio = $NumEnvio;
                    $inoHouseSea->setCaDatosmuisca(json_encode($hijo));
                    $inoHouseSea->save();
                    $iddocactual = DianReservadoTable::retrieveLastAvailable($hijo->numenvio, $hijo->fchtrans);
                } else {
                    $iddocactual = $dianReservado->getCaNumeroResv();
                }

                if (!$iddocactual) {
                    $event = "Error - No hay n�meros de reserva disponibles.";
                    throw new Exception($event);
                }
                if ($hijo->iddocanterior != "") {
                    $xml_hijo->setAttribute("hnfa", $hijo->iddocanterior);
                }

                $xml_hijo->setAttribute("hdca", $hijo->dispocarga);
                $destino = (!$inoHouseSea->getCaContinuacion()) ? $inoMaster->getCaDestino() : $inoHouseSea->getCaContinuacionDest();
                $destino = (strlen($hijo->iddestino) != 0) ? $hijo->iddestino : $destino;

                $arribo_array = array();
                foreach ($parametros as $parametro) {
                    if ($parametro["ca_identificacion"] == 9 and $parametro["ca_valor"] == $destino) {
                        $arribo_array = explode("|", $parametro["ca_valor2"]);
                        break;
                    }
                }
                $xml_hijo->setAttribute("hdpt", $arribo_array[0]);
                $xml_hijo->setAttribute("hciu", $arribo_array[1]);
                if ($inoHouseSea->getCaContinuacion() != "TRANSBORDO") {
                    $xml_hijo->setAttribute("hpa", $arribo_array[2]);
                    if ($hijo->dispocarga != "21") {
                        $xml_hijo->setAttribute("hdep", $hijo->coddeposito);
                    }
                } else {
                    $transbordo = Doctrine::getTable("Ciudad")->find($destino);
                    $xml_hijo->setAttribute("hpa", substr($transbordo->getCaIdtrafico(), 0, 2));
                }
                $xml_hijo->setAttribute("tdv2", $hijo->tipodocviaje);
                $xml_hijo->setAttribute("hijo", $inoHouse->getCaDoctransporte());
                $xml_hijo->setAttribute("hfe", $inoHouse->getCaFchdoctransporte());

                $reporte = $inoHouse->getReporte()->getRepUltVersion();

                // =========================== Remitente ===========================
                $xml_hijo->setAttribute("hdo2", 43);
                if ($reporte->getProveedores()) {
                    $xml_hijo->setAttribute("hrs2", utf8_encode($reporte->getProveedoresStr(false)));
                } else {
                    $xml_hijo->setAttribute("hrs2", utf8_encode($reporte->getIdsAgente()->getCaNombre()));
                }

                // =========================== Destinatario ===========================

                if ($inoHouseSea->getCaContinuacion() and ! $reporte->getBodega()->getCaIdentificacion()) {
                    $event = "Error - En Identificaci�n de la Bodega, cuando hay continuaci�n de viaje, House: " . $inoHouse->getCaDoctransporte();
                    throw new Exception($event);
                } else if ($inoHouseSea->getCaContinuacion() == "DTA" and $reporte->getBodega()->getCaIdentificacion()) {
                    $nit = explode("-", $reporte->getBodega()->getCaIdentificacion());
                    $xml_hijo->setAttribute("hdo3", 31);
                    $xml_hijo->setAttribute("hni3", $nit[0]);
                    $xml_hijo->setAttribute("hdv3", $nit[1]);
                } else if ($inoHouseSea->getCaContinuacion() == "OTM") {
                    if ($reporte->getBodega()->getCaIdentificacion()) {
                        $nit = explode("-", $reporte->getBodega()->getCaIdentificacion());
                        $xml_hijo->setAttribute("hdo3", 31);
                        $xml_hijo->setAttribute("hni3", $nit[0]);
                        $xml_hijo->setAttribute("hdv3", $nit[1]);
                    } else {
                        if ($reporte->getConsignatario()) {
                            // Debe trae la informaci�n del Operador Multimodal de la Tabla Transportistas.
                            $cadena = str_replace(array(",", "."), "", $reporte->getConsignatario()->getCaIdentificacion());
                            $nit = substr($cadena, strpos($cadena, "Nit") + 3);
                            $nit = explode("-", $nit);
                        } else {
                            $event = "Error - En Identificaci�n del Consignatario cuando hay un OTM, House: " . $inoHouse->getCaDoctransporte();
                            throw new Exception($event);
                        }

                        if (!$hijo->sinidentificacion) {
                            $xml_hijo->setAttribute("hdo3", 31);
                            $xml_hijo->setAttribute("hni3", $nit[0]);
                            $xml_hijo->setAttribute("hdv3", $nit[1]);

                            $arribo_array = array();
                            foreach ($parametros as $parametro) {
                                if ($parametro["ca_identificacion"] == 9 and $parametro["ca_valor"] == $reporte->getConsignatario()->getCaIdciudad()) {
                                    $arribo_array = explode("|", $parametro["ca_valor2"]);
                                    break;
                                }
                            }
                            if (strlen($arribo_array[0]) != 0) {
                                $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                            }
                            if (strlen($arribo_array[1]) != 0) {
                                $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                            }
                        } else {
                            $xml_hijo->setAttribute("hdo3", 43);
                            $xml_hijo->setAttribute("hrs3", utf8_encode($reporte->getConsignatario()->getCaNombre()));
                            $xml_hijo->setAttribute("hdir", utf8_encode(substr($reporte->getConsignatario()->getCaDireccion(), 0, 48)));

                            $arribo_array = array();
                            foreach ($parametros as $parametro) {
                                if ($parametro["ca_identificacion"] == 9 and $parametro["ca_valor"] == $reporte->getConsignatario()->getCaIdciudad()) {
                                    $arribo_array = explode("|", $parametro["ca_valor2"]);
                                    break;
                                }
                            }
                            if (strlen($arribo_array[0]) != 0) {
                                $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                            }
                            if (strlen($arribo_array[1]) != 0) {
                                $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                            }
                        }
                    }
                } else if ($reporte->getConsignatario()) {
                    if (!$hijo->sinidentificacion) {        // Trae la informaci�n del Consignatario del Reporte de Negocios
                        $cadena = str_replace(array(",", "."), "", $reporte->getConsignatario()->getCaIdentificacion());
                        $idconsignatario = substr($cadena, strpos($cadena, "Nit") + 3);
                        $idconsignatario = explode("-", $nit);

                        $xml_hijo->setAttribute("hdo3", 31);
                        $idconsignatario = explode("-", str_replace(array(",", "."), "", $reporte->getConsignatario()->getCaIdentificacion()));
                        $xml_hijo->setAttribute("hni3", $idconsignatario[0]);
                        $xml_hijo->setAttribute("hdv3", $idconsignatario[1]);

                        $arribo_array = array();
                        $cu->MoveFirst();
                        while (!$cu->Eof()) {
                            if ($cu->Value('ca_identificacion') == 9 and $cu->Value('ca_valor') == $reporte->getConsignatario()->getCaIdciudad()) {
                                $arribo_array = explode("|", $parametro["ca_valor2"]);
                                break;
                            }
                            $cu->MoveNext();
                        }
                        if (strlen($arribo_array[0]) != 0) {
                            $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                        }
                        if (strlen($arribo_array[1]) != 0) {
                            $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                        }
                    } else {
                        $xml_hijo->setAttribute("hdo3", 43);
                        $xml_hijo->setAttribute("hrs3", utf8_encode($reporte->getConsignatario()->getCaNombre()));
                        $xml_hijo->setAttribute("hdir", utf8_encode(substr($reporte->getConsignatario()->getCaDireccion(), 0, 48)));

                        $arribo_array = array();
                        foreach ($parametros as $parametro) {
                            if ($parametro["ca_identificacion"] == 9 and $parametro["ca_valor"] == $reporte->getConsignatario()->getCaIdciudad()) {
                                $arribo_array = explode("|", $parametro["ca_valor2"]);
                                break;
                            }
                        }
                        if (strlen($arribo_array[0]) != 0) {
                            $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                        }
                        if (strlen($arribo_array[1]) != 0) {
                            $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                        }
                    }
                } else {
                    if (!$hijo->sinidentificacion) {        // Trae la informaci�n del Cliente del Reporte de Negocios
                        $xml_hijo->setAttribute("hdo3", 31);
                        $xml_hijo->setAttribute("hni3", $reporte->getCliente()->getIds()->getCaIdalterno());
                        $xml_hijo->setAttribute("hdv3", $reporte->getCliente()->getIds()->getCaDv());

                        $arribo_array = array();
                        foreach ($parametros as $parametro) {
                            if ($parametro["ca_identificacion"] == 9 and $parametro["ca_valor"] == $reporte->getCliente()->getCaIdciudad()) {
                                $arribo_array = explode("|", $parametro["ca_valor2"]);
                                break;
                            }
                        }
                        if (strlen($arribo_array[0]) != 0) {
                            $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                        }
                        if (strlen($arribo_array[1]) != 0) {
                            $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                        }
                    } else {
                        $xml_hijo->setAttribute("hdo3", 43);
                        $xml_hijo->setAttribute("hrs3", utf8_encode($reporte->getCliente()->getIds()->getCaNombre()));
                        $xml_hijo->setAttribute("hdir", utf8_encode(substr($reporte->getCliente()->getCaDireccion(), 0, 48)));

                        $arribo_array = array();
                        foreach ($parametros as $parametro) {
                            if ($parametro["ca_identificacion"] == 9 and $parametro["ca_valor"] == $reporte->getCliente()->getCaIdciudad()) {
                                $arribo_array = explode("|", $parametro["ca_valor2"]);
                                break;
                            }
                        }
                        if (strlen($arribo_array[0]) != 0) {
                            $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                        }
                        if (strlen($arribo_array[1]) != 0) {
                            $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                        }
                    }
                }

                // =========================== Carga Peligrosa ===========================
                // =========================== Informaci�n de la Carga ===========================
                $xml_hijo->setAttribute("hcon", $hijo->idcondiciones);
                $xml_hijo->setAttribute("hrt", $hijo->responsabilidad);
                $xml_hijo->setAttribute("htn", $hijo->tiponegociacion);
                $xml_hijo->setAttribute("htc", $hijo->tipocarga);
                $xml_hijo->setAttribute("hpre", $hijo->precursores);

                $xml_hijo->setAttribute("hmon", $hijo->vlrfob);
                $xml_hijo->setAttribute("hvf", $hijo->vlrflete);

                $vlrfob += $hijo->vlrfob;
                $vlrflete += $hijo->vlrflete;

                $datos_carga = json_decode($inoHouseSea->getCaDatos());
                $contenedores = $datos_carga->equipos;

                if ($hijo->tipocarga == 2) {
                    $num_cont = count($contenedores);
                    $xml_hijo->setAttribute("htco", $num_cont);
                } else {
                    $xml_hijo->setAttribute("htco", 0);
                }

                $xml_hijo->setAttribute("htb", $inoHouse->getCaNumpiezas());
                $xml_hijo->setAttribute("htpb", round($inoHouse->getCaPeso(), 2));
                $xml_hijo->setAttribute("htvo", 0);
                $ntb += $inoHouse->getCaNumpiezas();  // N�mero Total Bultos
                $tpb += round($inoHouse->getCaPeso(), 2);  // Total Peso Bruto

                $xml_hijo->setAttribute("hcpe", substr($reporte->getOrigen()->getCaIdtrafico(), 0, 2));
                $xml_hijo->setAttribute("hcle", substr($reporte->getOrigen()->getCaIdtrafico(), 0, 2) . substr($reporte->getCaOrigen(), 0, 3));
                $xml_hijo->setAttribute("ideDoc", $hijo->iddocactual);

                $grp = 0;
                $sub_ps = 0;
                $sub_pz = 0;
                $sub_cn = 0;

                $array_cont = array();
                foreach ($inoMaster->getInoEquipo() as $equipo) {
                    $first = true;
                    foreach ($contenedores as $contenedor) {
                        if ($equipo->getCaIdequipo() != $contenedor->idequipo) {
                            continue;
                        }
                        if ($first) {
                            // Se Crear el elemento h167
                            $xml_h167 = $xml->createElement("h167");

                            if ($hijo->iddocanterior != "") {
                                $xml_h167->setAttribute("fa67", $hijo->iddocanterior);
                            }
                            $xml_h167->setAttribute("cont", $hijo->tipocarga);
                            $xml_h167->setAttribute("tun", 2);
                            $xml_h167->setAttribute("idu", str_replace("-", "", $contenedor->idequipo));

                            $tipoContenedor = Doctrine::getTable("Concepto")->find($contenedor->idconcepto);
                            if ($tipoContenedor) {
                                $tam_equipo = (strpos($tipoContenedor->getCaConcepto(), 'High Cube') !== false) ? 2 : (($tipoContenedor->getCaLiminferior() == 20) ? 1 : (($tipoContenedor->getCaLiminferior() == 40) ? 3 : 4));
                                $xml_h167->setAttribute("tam", $tam_equipo);
                                $tip_equipo = (strpos($contenedor->concepto, 'Flat Rack') !== false) ? 2 : ((strpos($contenedor->concepto, 'Open Top') !== false) ? 3 : ((strpos($contenedor->concepto, 'Collapsible') !== false) ? 4 : ((strpos($contenedor->concepto, 'Platform') !== false) ? 5 : ((strpos($contenedor->concepto, 'Tank') !== false) ? 6 : ((strpos($contenedor->concepto, 'Reefer') !== false) ? 8 : 1)))));
                                $xml_h167->setAttribute("teq", $tip_equipo);
                                $xml_h167->setAttribute("npr", $contenedor->numprecinto);
                            } else {
                                $event = "Error - En la Definici�n del Tipo de Contenedor.";
                                throw new Exception($event);
                            }
                            $first = false;
                        }

                        $grp++;
                        $sub_ps += $contenedor->kilos;
                        $sub_pz += $contenedor->piezas;
                        $sub_cn += 1;

                        // Se Crear el elemento h267
                        $xml_h267 = $xml->createElement("h267");
                        $xml_h267->setAttribute("grp", $grp);
                        $xml_h267->setAttribute("bul", $contenedor->piezas);
                        $xml_h267->setAttribute("peso", $contenedor->kilos);

                        // Se Crear el elemento item
                        $sql = "select (string_to_array(ca_piezas,'|'))[2] as ca_embalaje, ca_mercancia_desc, ca_mcia_peligrosa, pr.ca_valor2 as ca_codembalaje from tb_repstatus rs "
                                . "     LEFT OUTER JOIN tb_reportes rp ON (rp.ca_fchanulado is null and rs.ca_idreporte = rp.ca_idreporte) "
                                . "     LEFT OUTER JOIN tb_parametros pr ON (pr.ca_casouso = 'CU047' and (string_to_array(ca_piezas,'|'))[2] = pr.ca_valor) "
                                . "where rp.ca_consecutivo = '" . $reporte->getCaConsecutivo() . "' and ca_idemail is not null order by ca_idemail DESC limit 1 ";
                        $repstatus = $conn->execute($sql);
                        foreach ($repstatus as $status) {
                            $mercancia_peli = ($status["ca_mcia_peligrosa"]) ? "S" : "N";
                            $mercancia_desc = (strlen($hijo->mercancia_desc) != 0) ? $hijo->mercancia_desc : $status["ca_mercancia_desc"];
                            $mercancia_desc = substr($mercancia_desc, 0, 200);
                        }
                        $xml_item = $xml->createElement("item");
                        $item = 1;
                        $xml_item->setAttribute("item", $item);
                        $xml_item->setAttribute("cemb", ($status["ca_codembalaje"] == "" ? "PK" : $status["ca_codembalaje"]));
                        $xml_item->setAttribute("idg", $mercancia_desc);
                        $xml_item->setAttribute("mpel", $mercancia_peli);
                        $xml_h267->appendChild($xml_item);
                        $xml_h167->appendChild($xml_h267);

                        $array_cont[] = str_replace("-", "", $contenedor->serial);
                    }
                    // Se Crear el elemento contenedor
                    if ($master->tipodocviaje == 10) {
                        foreach ($array_cont as $cont) {
                            $xml_contenedor = $xml->createElement("contenedor");
                            $xml_contenedor->setAttribute("contp", $cont);
                            $xml_h167->appendChild($xml_contenedor);
                        }
                    }
                }
                $xml_h167->setAttribute("vpb", $sub_ps);
                $xml_h167->setAttribute("nbul", $sub_pz);
                $xml_h167->setAttribute("vol1", 0);
                $xml_h167->setAttribute("nreg", $sub_cn);
                $xml_hijo->appendChild($xml_h167);

                $xml_pal66->appendChild($xml_hijo);
            }

            $grp = 0;
            $sub_ps = 0;
            $sub_pz = 0;
            $sub_cn = 0;

            $array_cont = array();
            foreach ($inoMaster->getInoEquipo() as $equipo) { // Lee todos los Houses de la Referencia
                // Se Crear el elemento h167
                $xml_h167 = $xml->createElement("h167");

                if ($hijo->iddocanterior != "") {
                    $xml_h167->setAttribute("fa67", $master->iddocanterior);
                }
                $xml_h167->setAttribute("cont", $master->tipocarga);
                $xml_h167->setAttribute("tun", 2);
                $xml_h167->setAttribute("idu", str_replace("-", "", $contenedor->serial));

                $tipoContenedor = Doctrine::getTable("Concepto")->find($contenedor->idconcepto);
                if ($tipoContenedor) {
                    $tam_equipo = (strpos($tipoContenedor->getCaConcepto(), 'High Cube') !== false) ? 2 : (($tipoContenedor->getCaLiminferior() == 20) ? 1 : (($tipoContenedor->getCaLiminferior() == 40) ? 3 : 4));
                    $xml_h167->setAttribute("tam", $tam_equipo);
                    $tip_equipo = (strpos($contenedor->concepto, 'Flat Rack') !== false) ? 2 : ((strpos($contenedor->concepto, 'Open Top') !== false) ? 3 : ((strpos($contenedor->concepto, 'Collapsible') !== false) ? 4 : ((strpos($contenedor->concepto, 'Platform') !== false) ? 5 : ((strpos($contenedor->concepto, 'Tank') !== false) ? 6 : ((strpos($contenedor->concepto, 'Reefer') !== false) ? 8 : 1)))));
                    $xml_h167->setAttribute("teq", $tip_equipo);
                    $xml_h167->setAttribute("npr", $contenedor->numprecinto);
                } else {
                    $event = "Error - En la Definici�n del Tipo de Contenedor.";
                    throw new Exception($event);
                }

                foreach ($inoHouses as $inoHouse) {      // Lee todos los Houses de la Referencia
                    $reporte = $inoHouse->getReporte()->getRepUltVersion();
                    $inoHouseSea = $inoHouse->getInoHouseSea();
                    $datos_carga = json_decode($inoHouseSea->getCaDatos());
                    $hijo = json_decode($inoHouseSea->getCaDatosmuisca());
                    $contenedores = $datos_carga->equipos;
                    foreach ($contenedores as $contenedor) {
                        if ($equipo->getCaIdequipo() != $contenedor->idequipo) {
                            continue;
                        }

                        $grp++;
                        $sub_ps += $contenedor->kilos;
                        $sub_pz += $contenedor->piezas;
                        $sub_cn += 1;

                        // Se Crear el elemento h267
                        $xml_h267 = $xml->createElement("h267");
                        $xml_h267->setAttribute("grp", $grp);
                        $xml_h267->setAttribute("bul", $contenedor->piezas);
                        $xml_h267->setAttribute("peso", $contenedor->kilos);

                        // Se Crear el elemento item
                        $sql = "select (string_to_array(ca_piezas,'|'))[2] as ca_embalaje, ca_mercancia_desc, ca_mcia_peligrosa, pr.ca_valor2 as ca_codembalaje from tb_repstatus rs "
                                . "     LEFT OUTER JOIN tb_reportes rp ON (rp.ca_fchanulado is null and rs.ca_idreporte = rp.ca_idreporte) "
                                . "     LEFT OUTER JOIN tb_parametros pr ON (pr.ca_casouso = 'CU047' and (string_to_array(ca_piezas,'|'))[2] = pr.ca_valor) "
                                . "where rp.ca_consecutivo = '" . $reporte->getCaConsecutivo() . "' and ca_idemail is not null order by ca_idemail DESC limit 1 ";
                        $repstatus = $conn->execute($sql);
                        foreach ($repstatus as $status) {
                            $mercancia_peli = ($reporte->getCaMciaPeligrosa()) ? "S" : "N";
                            $mercancia_desc = (strlen($hijo->mercancia_desc) != 0) ? $hijo->mercancia_desc : $status["ca_mercancia_desc"];
                            $mercancia_desc = substr($mercancia_desc, 0, 200);
                        }

                        $xml_item = $xml->createElement("item");
                        $item = 1;
                        $xml_item->setAttribute("item", $item);
                        $xml_item->setAttribute("cemb", ($status["ca_codembalaje"] == "" ? "PK" : $status["ca_codembalaje"]));
                        $xml_item->setAttribute("idg", $mercancia_desc);
                        $xml_item->setAttribute("mpel", $mercancia_peli);
                        $xml_h267->appendChild($xml_item);
                        $xml_h167->appendChild($xml_h267);
                    }
                }
                $xml_h167->setAttribute("vpb", $sub_ps);
                $xml_h167->setAttribute("nbul", $sub_pz);
                $xml_h167->setAttribute("nreg", $sub_cn);

                $xml_pal66->appendChild($xml_h167);
            }
            $xml_pal66->setAttribute("cmon", $vlrfob);      // Valor FOB USD
            $xml_pal66->setAttribute("vfle", $vlrflete);  // Valor Fletes USD
            $xml_pal66->setAttribute("ntb", $ntb);
            $xml_pal66->setAttribute("tpb", $tpb);

            $xml_pal66->setAttribute("pemb", substr($inoMaster->getOrigen()->getCaIdtrafico(), 0, 2));
            $xml_pal66->setAttribute("lemb", substr($inoMaster->getOrigen()->getCaIdtrafico(), 0, 2) . substr($inoMaster->getCaOrigen(), 0, 3));
            $xml_pal66->setAttribute("cpt", $master->codconcepto);

            // Sub Elementos del Cab
            $xml_Ano = $xml->createElement("Ano", substr($master->fchtrans, 0, 4));
            $xml_CodCpt = $xml->createElement("CodCpt", $master->codconcepto);
            $xml_Formato = $xml->createElement("Formato", "1166");
            $xml_Version = $xml->createElement("Version", "7");
            $xml_FecEnvio = $xml->createElement("FecEnvio", date("Y-m-d", $FecEnvio) . "T" . date("H:i:s", $FecEnvio));
            $xml_FecInicial = $xml->createElement("FecInicial", $master->fchinicial);
            $xml_FecFinal = $xml->createElement("FecFinal", $master->fchfinal);
            $xml_ValorTotal = $xml->createElement("ValorTotal", $ValorTotal);
            $xml_CantReg = $xml->createElement("CantReg", $CantReg);

            // Adiciona Elementos a Cab
            $xml_cab->appendChild($xml_Ano);
            $xml_cab->appendChild($xml_CodCpt);
            $xml_cab->appendChild($xml_Formato);
            $xml_cab->appendChild($xml_Version);
            $xml_cab->appendChild($xml_NumEnvio);
            $xml_cab->appendChild($xml_FecEnvio);
            $xml_cab->appendChild($xml_FecInicial);
            $xml_cab->appendChild($xml_FecFinal);
            $xml_cab->appendChild($xml_ValorTotal);
            $xml_cab->appendChild($xml_CantReg);

            $xml_mas->appendChild($xml_cab);
            $xml_mas->appendChild($xml_pal66);
            $xml->appendChild($xml_mas);

            /* AL final Actualiza el Json de DianMaestra */
            $this->setCaDatosmuisca(json_encode($master));
            $this->save();

            // Valida contra el Esquema
            if (!$xml->schemaValidate('./xsd/1166.xsd')) {
                $errors = libxml_get_errors();
                $event = null;
                foreach ($errors as $error) {
                    $event .= display_xml_error($error, $xml) . "<br />";
                }
                if ($event) {
                    throw new Exception($event);
                }
            }
        } catch (Exception $e) {
            $conn->rollBack();
            return array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        return array("success" => true, "Ano" => $xml_Ano->nodeValue, "CodCpt" => $xml_CodCpt->nodeValue, "Formato" => $xml_Formato->nodeValue, "NumEnvio" => $xml_NumEnvio->nodeValue, "outXML" => $xml->saveXML());
    }

}