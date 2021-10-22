<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

function noCero($val, $dec = 2) {
    if (strlen($val) == 1 and floatval($val) == 0) {
        return "";
    } else if ($val <> 0) {
        if (floatval($val) == $val) {
            return number_format($val, $dec);
        }
    } else {
        return $val;
    }
}

if ($copia) {
    $liberacion = "   C O P I A   ";
} else {
    $liberacion = "O R I G I N A L";
}

$pdf = new PDF('P', 'mm', 'oficio');
$pdf->Open();
$pdf->AliasNbPages();
$pdf->setTopMargin(0);
$pdf->setLeftMargin(5);
$pdf->setRightMargin(5);
$pdf->setColtransHeader(false);

$pdf->SetAutoPageBreak(true, 0);

$page = 1;
$marg = 0;
$font_size = 9;

if (!$guiahija) {
    if ($documento->getCaKindRate() == "Valor Minimo") {
        $rate_charge = "M�nima";
        $total_charge = $documento->getCaRateCharge();
        $gran_total = $documento->getCaRateCharge();
        $super_total = $documento->getCaRateCharge() + $documento->getCaDueAgent() + $documento->getCaDueCarrier();
    } else {
        $rate_charge = $documento->getCaRateCharge();
        $total_charge = $documento->getCaWeightCharge() * $documento->getCaRateCharge();
        $gran_total = $documento->getCaWeightCharge() * $documento->getCaRateCharge();
        $super_total = ($documento->getCaWeightCharge() * $documento->getCaRateCharge()) + $documento->getCaDueAgent() + $documento->getCaDueCarrier();
    }
    $guias[] = array(
        "number_packages" => $documento->getCaNumberPackages(),
        "kind_packages" => $documento->getCaKindPackages(),
        "gross_weight" => $documento->getCaGrossWeight(),
        "gross_unit" => $documento->getCaGrossUnit(),
        "weight_charge" => $documento->getCaWeightCharge(),
        "weight_details" => $documento->getCaWeightDetails(),
        "charges_code" => $documento->getCaChargesCode(),
        "due_agent" => $documento->getCaDueAgent(),
        "due_carrier" => $documento->getCaDueCarrier(),
        "commodity_item" => $documento->getCaCommodityItem(),
        "rate_charge" => $rate_charge,
        "total_charge" => $total_charge,
        "gran_total" => $gran_total,
        "super_total" => $super_total,
        "delivery_goods" => $documento->getCaDeliveryGoods(),
        "other_charges" => $documento->getCaOtherCharges()
    );
    $prefijo = $documento->getInoAwbCarrierUno()->getCaPrefijo();
    $consecutivo = $documento->getCaConsecutivo();
    $logotipo = $documento->getInoAwbCarrierUno()->getCaPathLogo();
} else {
    $guias = json_decode(html_entity_decode($documento->getCaChildrens()), true);
    foreach ($guias as $key => $guia) {
        if ($guia["kind_rate"] == "As Agreed") {
            $guias[$key]["rate_charge"] = "";
            $guias[$key]["total_charge"] = strtoupper($guia["kind_rate"]);
            $guias[$key]["gran_total"] = strtoupper($guia["kind_rate"]);
            $guias[$key]["super_total"] = strtoupper($guia["kind_rate"]);
        } else if ($guia["kind_rate"] == "Valor Minimo") {
            $guias[$key]["rate_charge"] = "M�nima";
            $guias[$key]["total_charge"] = $guia["rate_charge"];
            $guias[$key]["gran_total"] = $guia["rate_charge"];
            $guias[$key]["super_total"] = $guia["rate_charge"] + $guia["due_agent"] + $guia["due_carrier"];
        } else {
            $guias[$key]["rate_charge"] = $guia["rate_charge"];
            $guias[$key]["total_charge"] = $guia["weight_charge"] * $guia["rate_charge"];
            $guias[$key]["gran_total"] = $guia["weight_charge"] * $guia["rate_charge"];
            $guias[$key]["super_total"] = ($guia["weight_charge"] * $guia["rate_charge"]) + $guia["due_agent"] + $guia["due_carrier"];
        }
    }
    $ref_array = explode(".", $documento->getInoMaster()->getCaReferencia());
    $prefijo = $ref_array[0];
    // $ref_array[3] = (($guiahija && count($guias)>1)?substr($ref_array[3],1,3):$ref_array[3]); // Si hay m�s de una gu�a hija, quita un cero al consecutivo
    $ref_array[3] = substr($ref_array[3], 1, 3); // Siempre quitar� un d�gito al consecutivo para la gu�a hija
    $consecutivo = $ref_array[1] . $ref_array[2] . $ref_array[3] . $ref_array[4];
    $logotipo = "/srv/www/digitalFile/formatos/logo_coltrans.jpg";
}
$ultimoActualido = ($documento->getUsuactualizado()) ? $documento->getUsuactualizado() : $documento->getUsucreado();

if ($bond) {
    $pages[] = array("footer" => "ORIGINAL 3 (FOR SHIPPER)", "pos_y" => 88, "back" => true);
    $pages[] = array("footer" => "COPY 9 (FOR AGENT)", "pos_y" => 92, "back" => false);
    $pages[] = array("footer" => "ORIGINAL 1 (FOR ISSUING CARRIER)", "pos_y" => 78, "back" => true);
    $pages[] = array("footer" => "ORIGINAL 2 (FOR CONSIGNEE)", "pos_y" => 80, "back" => true);
    $pages[] = array("footer" => "COPY 4 (DELIVERY RECEIPT)", "pos_y" => 80, "back" => true);
    $pages[] = array("footer" => "COPY 5 (FOR AIRPORT OF DESTINATION)", "pos_y" => 76, "back" => false);
    $pages[] = array("footer" => "COPY 6 (FOR THIRD CARRIER)", "pos_y" => 80, "back" => false);
    $pages[] = array("footer" => "COPY 7 (SECOND CARRIER)", "pos_y" => 84, "back" => false);
    $pages[] = array("footer" => "COPY 8 (FOR FIRST CARRIER)", "pos_y" => 80, "back" => false);
} else {
    $pages[] = array("footer" => "ORIGINAL 3 (FOR SHIPPER)", "pos_y" => 88, "back" => null);
}


foreach ($guias as $key => $guia) {
    foreach ($pages as $page) {
        $guia_numero = $prefijo . " " . $consecutivo . (($guiahija && count($guias) > 1) ? chr(65 + $key) : "");

        $pdf->AddPage();
        /* HEADER */

        if ($plantilla) {
            $pdf->Image('/srv/www/digitalFile/formatos/AWB0001.jpg', 0, -8, 221, 337);
            $marg = -5;
        } else {
            $marg = 0;
        }
        
        $ciudad = Doctrine::getTable("Ciudad")->findOneBy("ca_ciudad", $ultimoActualido->getSucursal()->getCaNombre());
        $pdf->SetFont('Arial', 'B', $font_size + 5);
        $pdf->SetXY(18, 30 + $marg);
        $pdf->MultiCell(100, 4, $prefijo, 0, 1);
        $pdf->SetXY(27, 30 + $marg);
        $pdf->MultiCell(100, 4, substr($ciudad->getCaIdciudad(), 0, 3), 0, 1);
        $pdf->SetXY(40, 30 + $marg);
        $pdf->MultiCell(100, 4, $consecutivo, 0, 1);
        $pdf->SetXY(155, 30 + $marg);
        $pdf->MultiCell(100, 4, $guia_numero, 0, 1);

        $pdf->SetFont('Arial', '', $font_size);
        $pdf->SetXY(18, 38 + $marg);
        if ($reporte->getCaModalidad() == "DIRECTO" or $guiahija) {
            $shipper = html_entity_decode($reporte->getContacto()->getCliente()->getCaCompania()) . "\n";
            $shipper .= "Nit: " . number_format($reporte->getContacto()->getCliente()->getCaIdalterno(), 0) . "-" . $reporte->getContacto()->getCliente()->getCaDigito() . "\n";
            $shipper .= trim($reporte->getContacto()->getCliente()->getDireccion()) . "\n";
            $shipper .= "Tels.: " . $reporte->getContacto()->getCliente()->getCaTelefonos() . "\n";
            $shipper .= $reporte->getContacto()->getCliente()->getCiudad()->getCaCiudad() . ", " . $reporte->getContacto()->getCliente()->getCiudad()->getTrafico()->getCaNombre() . " " . $reporte->getContacto()->getCliente()->getCaZipcode();
        } else {
            $shipper = strtoupper($empresa->getCaNombre()) . "\n";
            $shipper .= "Nit: " . number_format($empresa->getIds()->getCaIdalterno(), 0) . "-" . $empresa->getIds()->getCaDv() . "\n";
            $shipper .= $ultimoActualido->getSucursal()->getCaDireccion() . " ";
            $shipper .= "Tels.: " . $ultimoActualido->getSucursal()->getCaTelefono() . "\n";
            $shipper .= $ultimoActualido->getSucursal()->getCaNombre() . "-COLOMBIA";
        }
        $pdf->MultiCell(100, 4, $shipper, 0, 1);

        if ($documento->getInoAwbCarrierUno()->getCaPathLogo()) {
            $pdf->Image($logotipo, 136, $marg + 38, 75, 20);
        }

        $pdf->SetXY(18, 62 + $marg);
        $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignarmaster());
        if ($reporte->getCaModalidad() == "CONSOLIDADO" and $tercero and ! $guiahija) {
            $id = "";
            if ($tercero->getCaIdentificacion()) {
                $tipo = Doctrine::getTable("IdsTipoIdentificacion")
                        ->createQuery("t")
                        ->leftJoin("t.Trafico tt")
                        ->addOrderBy("t.ca_tipoidentificacion")
                        ->addwhere("t.ca_idtrafico = ?", $tercero->getCiudad()->getCaIdtrafico())
                        ->limit(1)
                        ->fetchOne();
                if ($tipo) {
                    $id .= " " . $tipo->getCaNombre() . ": ";
                } else {
                    $id .= "Id: ";
                }
                $id .= $tercero->getCaIdentificacion();
            }
            $consignee = $tercero->getCaNombre() . $id . "\n";
            $consignee .= $tercero->getCaDireccion() . "\n";
            $consignee .= "Cnt.: " . $tercero->getCaContacto() . "\n";
            $consignee .= "Tels.: " . $tercero->getCaTelefonos() . "\n";
            $consignee .= $tercero->getCiudad()->getCaCiudad() . ", " . $tercero->getCiudad()->getTrafico()->getCaNombre();
        } else if ($reporte->getCaModalidad() == "CONSOLIDADO" and $reporte->getIdsAgente() and ! $guiahija) {
            $agente = $reporte->getIdsAgente();
            $sucursalag = $reporte->getIdsSucursal();
            if (!$sucursalag)
                $sucursalag = new $sucursalag();
            $id_agente = ($agente->getIds()->getIdsTipoIdentificacion()->getCaIdtrafico() ? " " . trim($agente->getIds()->getIdsTipoIdentificacion()->getCaNombre() . ":" . $agente->getIds()->getCaIdalterno()) : "");
            $consignee = $agente->getIds()->getCaNombre() . $id_agente . "\n";
            $consignee .= $sucursalag->getCaDireccion() . "\n";
            $consignee .= "Tels.: " . $sucursalag->getCaTelefonos() . "\n";
            $consignee .= $sucursalag->getCiudad()->getCaCiudad() . ", " . $sucursalag->getCiudad()->getTrafico()->getCaNombre();
        } else {
            $id = "";
            if ($consignatario && $consignatario->getCaIdentificacion()) {
                $tipo = Doctrine::getTable("IdsTipoIdentificacion")
                        ->createQuery("t")
                        ->leftJoin("t.Trafico tt")
                        ->addOrderBy("t.ca_tipoidentificacion")
                        ->addwhere("t.ca_idtrafico = ?", $consignatario->getCiudad()->getCaIdtrafico())
                        ->limit(1)
                        ->fetchOne();
                if ($tipo) {
                    $id .= " " . $tipo->getCaNombre() . ": ";
                } else {
                    $id .= "Id: ";
                }
                $id .= $consignatario->getCaIdentificacion();
            }
            $consignee = $consignatario->getCaNombre() . $id . "\n";
            $consignee .= $consignatario->getCaDireccion() . "\n";
            $consignee .= "Cnt.: " . $consignatario->getCaContacto() . "\n";
            $consignee .= "Tels.: " . $consignatario->getCaTelefonos() . "\n";
            $consignee .= $consignatario->getCiudad()->getCaCiudad() . ", " . $consignatario->getCiudad()->getTrafico()->getCaNombre();
        }
        $pdf->MultiCell(100, 4, html_entity_decode($consignee), 0, 1);

        $pdf->SetXY(18, 87 + $marg);
        $agent = strtoupper($empresa->getCaNombre()) . "\n";
        $agent .= $ultimoActualido->getSucursal()->getCaDireccion() . " ";
        $agent .= "Tels.: " . $ultimoActualido->getSucursal()->getCaTelefono() . "\n";
        $agent .= $ultimoActualido->getSucursal()->getCaNombre() . "-COLOMBIA";
        $pdf->MultiCell(100, 4, $agent, 0, 1);

        $pdf->SetXY(113, 90 + $marg);

        $accountingInfo = $documento->getCaAccountingInfo();
        if ($reporte->getCaModalidad() == "DIRECTO") {
            $accountingInfo = str_replace("HAWB", "REF", $accountingInfo);
        } else if ($reporte->getCaModalidad() == "CONSOLIDADO" and $guiahija) {
            $accountingInfo = str_replace("HAWB", "MAWB", $accountingInfo);
            $accountingInfo = str_replace($documento->getInoMaster()->getCaReferencia(), $documento->getInoAwbCarrierUno()->getCaPrefijo() . " " . $documento->getCaConsecutivo(), $accountingInfo);
        } else if ($guiahija) {
            $ref_array = explode(".", $documento->getInoMaster()->getCaReferencia());
            $prefijo = $ref_array[0];
            $ref_array[3] = substr($ref_array[3], 1, 3); // Siempre quitar� un d�gito al consecutivo para la gu�a hija
            $consecutivo = $ref_array[1] . $ref_array[2] . $ref_array[3] . $ref_array[4];
            $accountingInfo = str_replace($documento->getInoMaster()->getCaReferencia(), $prefijo . " " . $consecutivo, $accountingInfo);
        }

        $pdf->MultiCell(100, 4, $accountingInfo, 0, 1);

        if ($config[strtolower($reporte->getUsuario()->getCaIdsucursal()) . '_iata_code']) {
            $iata_code = $config[strtolower($reporte->getUsuario()->getCaIdsucursal()) . '_iata_code'];
        } else {
            $iata_code = $config['agent_iata_code'];
        }
        $pdf->Text(19, 108 + $marg, $iata_code);
        $pdf->Text(66, 108 + $marg, $documento->getInoAwbCarrierUno()->getCaAccount());
        $pdf->Text(19, 116 + $marg, $documento->getCaAirportDeparture());
        $pdf->Text(19, 124 + $marg, $documento->getCaIddestinoUno());
        $pdf->Text(29, 124 + $marg, $documento->getInoAwbCarrierUno()->getCaCarrier());
        $pdf->Text(77, 124 + $marg, $documento->getCaIddestinoDos());
        $pdf->Text(87, 124 + $marg, $documento->getInoAwbCarrierDos()->getCaCodigo());
        $pdf->Text(95, 124 + $marg, $documento->getCaIddestinoTrs());
        $pdf->Text(107, 124 + $marg, $documento->getInoAwbCarrierTrs()->getCaCodigo());

        $tarifas = $reporte->getRepTarifa();
        $currency = array();
        foreach ($tarifas as $tarifa) {
            if (!in_array($tarifa->getCaCobrarIdm(), $currency)) {
                $currency[] = $tarifa->getCaCobrarIdm();
            }
        }
        $pdf->Text(115, 124 + $marg, $currency[0]);
        $pdf->Text(124, 124 + $marg, $guia['charges_code']);
        if ($guia['charges_code'] == "PP") {
            $x1 = 30;
            $x2 = 65;
            $ct = "PREPAID";
            $pdf->Text(129, 124 + $marg, substr($guia['charges_code'], 0, 1));
            $pdf->Text(140, 124 + $marg, substr($guia['charges_code'], 0, 1));
        } else {
            $x1 = 65;
            $x2 = 30;
            $ct = "COLLECT";
            $pdf->Text(135, 124 + $marg, substr($guia['charges_code'], 0, 1));
            $pdf->Text(145, 124 + $marg, substr($guia['charges_code'], 0, 1));
        }
        $pdf->Text(160, 124 + $marg, $config['value_carriage']);
        $pdf->Text(190, 124 + $marg, $config['value_customs']);

        $pdf->Text(19, 133 + $marg, $documento->getCaAirportDestination());
        $pdf->Text(124, 133 + $marg, $config['amount_insurance']);

        $marg += ($plantilla) ? 4 : 0;
        $pdf->SetXY(18, 135 + $marg);
        $pdf->MultiCell(190, 4, $documento->getCaHandingInfo(), 0, 1);

        $tot_packages = 0;
        $tot_gross = 0;
        $tot_net = 0;
        $tot_measurement = 0;

        /* BODY */

        $pdf->Text(23, 180 + $marg, number_format($guia['number_packages'], 0));
        $pdf->Text(34, 180 + $marg, noCero($guia['gross_weight']));
        $pdf->Text(47, 180 + $marg, substr($guia['gross_unit'], 0, 1));
        $pdf->SetXY(56, 176 + $marg);
        $pdf->MultiCell(20, 4, $guia['commodity_item'], 0, 1);
        $pdf->Text(80, 176 + $marg, $guia['weight_details']);
        $pdf->Text(83, 180 + $marg, noCero($guia['weight_charge']));
        $pdf->Text(105, 180 + $marg, noCero($guia['rate_charge']));
        $pdf->Text(130, 180 + $marg, noCero($guia['total_charge']));
        $pdf->SetXY(150, 170 + $marg);
        $pdf->MultiCell(60, 4, $guia['delivery_goods'], 0, 1);

        $pdf->Text(23, 213 + $marg, noCero($guia['number_packages'], 0));
        $pdf->Text(34, 213 + $marg, noCero($guia['gross_weight']));
        $pdf->Text(130, 213 + $marg, noCero($guia['gran_total']));


        /* FOOTER */

        $pdf->Text($x1, 225 + $marg, noCero($guia['gran_total']));
        $pdf->Text($x2, 225 + $marg, $ct);
        $pdf->Text($x1, 250 + $marg, noCero($guia['due_agent']));
        $pdf->Text($x1, 258 + $marg, noCero($guia['due_carrier']));
        $pdf->Text($x1, 275 + $marg, noCero($guia['super_total']));

        $pdf->SetXY(93, 226 + $marg);
        $pdf->MultiCell(120, 4, $guia['other_charges'], 0, 1);

        $pdf->SetXY(93, 255 + $marg);
        $pdf->MultiCell(120, 4, $documento->getCaShipperCertifies(), 0, 1);

        $pdf->SetXY(93, 275 + $marg);
        $executed_on = $ultimoActualido->getSucursal()->getCaNombre() . "-COLOMBIA ";
        $executed_on .= date("F d \of Y", strtotime($documento->getCaFchdoctransporte())) . "/" . $ultimoActualido->getCaNombre() . "/";
        $executed_on .= strtoupper($documento->getUsuliquidado()->getCaNombre());
        $pdf->MultiCell(150, 4, $executed_on, 0, 1);

        $pdf->SetFont('Arial', 'B', $font_size + 5);
        $pdf->SetXY(155, 292 + $marg);
        $pdf->MultiCell(100, 4, $guia_numero, 0, 1);

        $pdf->SetFont('Arial', 'B', $font_size + 2);
        $pdf->SetXY($page["pos_y"], 298 + $marg);
        $pdf->MultiCell(100, 4, $page["footer"], 0, 1);

        if (!is_null($page["back"])) {
            $pdf->AddPage();
            if ($page["back"]) {
                $pdf->Image('/srv/www/digitalFile/formatos/AWBBACK.jpg', 0, -8, 221, 337);
            }
        }
    }
}

$filename = str_replace(".", "", $documento->getInoMaster()->getCaReferencia()) . '.pdf';
$pdf->Output($filename, "I");
if ($filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>