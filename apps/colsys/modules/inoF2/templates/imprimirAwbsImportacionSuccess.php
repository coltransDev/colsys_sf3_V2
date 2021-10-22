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

if ($documento->getCaKindRate() == "Valor Minimo") {
    $rate_charge = "Mínima";
    $total_charge = $documento->getCaRateCharge();
    $gran_total = $documento->getCaRateCharge();
    $super_total = $documento->getCaRateCharge() + $documento->getCaDueAgent() + $documento->getCaDueCarrier();
} else if ($documento->getCaKindRate() == "Valor Unitario") {
    $rate_charge = $documento->getCaRateCharge();
    $total_charge = $documento->getCaWeightCharge() * $documento->getCaRateCharge();
    $gran_total = $documento->getCaWeightCharge() * $documento->getCaRateCharge();
    $super_total = ($documento->getCaWeightCharge() * $documento->getCaRateCharge()) + $documento->getCaDueAgent() + $documento->getCaDueCarrier();
} else {
    $rate_charge  = "AS AGREED";
    $total_charge = "AS AGREED";
    $gran_total   = "AS AGREED";
    $super_total  = "AS AGREED";
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
$prefijo = substr($documento->getInoHouse()->getCaDoctransporte(),0,3);
$consecutivo = $documento->getCaConsecutivo();
$logotipo = $documento->getInoAwbCarrierUno()->getCaPathLogo();
$ultimoActualido = ($documento->getUsuactualizado()) ? $documento->getUsuactualizado() : $documento->getUsucreado();
$impo_data = json_decode(html_entity_decode($documento->getCaChildrens()), true);
$font_size = $impo_data["font_size"];

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
        
        $ciudad = Doctrine::getTable("Ciudad")->find($documento->getInoMaster()->getCaOrigen());
        $pdf->SetFont('Arial', 'B', $font_size + 5);
        $pdf->SetXY(17, 30 + $marg);
        $pdf->MultiCell(100, 4, $prefijo, 0, 1);
        $pdf->SetXY(28, 30 + $marg);
        $pdf->MultiCell(100, 4, substr($ciudad->getCaIdciudad(), 0, 3), 0, 1);
        $pdf->SetXY(40, 30 + $marg);
        $pdf->MultiCell(100, 4, $consecutivo, 0, 1);
        $pdf->SetXY(155, 30 + $marg);
        $pdf->MultiCell(100, 4, $guia_numero, 0, 1);

        $pdf->SetFont('Arial', '', $font_size);
        $pdf->SetXY(18, 38 + $marg);
        
        $proveedores = $reporte->getProveedores();
        foreach ($proveedores as $tercero) {
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
            $shipper = html_entity_decode($tercero->getCaNombre()) . $id . "\n";
            $shipper .= $tercero->getCaDireccion() . "\n";
            $shipper .= "Cnt.: " . $tercero->getCaContacto() . "\n";
            $shipper .= "Tels.: " . $tercero->getCaTelefonos() . "\n";
            $shipper .= $tercero->getCiudad()->getCaCiudad() . ", " . $tercero->getCiudad()->getTrafico()->getCaNombre();
            break;
        }
        
        $pdf->MultiCell(95, 4, $shipper, 0, 1);

        $pdf->SetXY(135, 42 + $marg);
        $agente = $reporte->getIdsAgente();
        $agent = html_entity_decode($agente->getIds()->getCaNombre());
        $pdf->MultiCell(95, 4, $agent, 0, 1);

        $consignee = '';
        $pdf->SetXY(18, 62 + $marg);

        if( $reporte->getCaIdbodega() && $reporte->getCaIdbodega()!= 111 && $reporte->getCaIdbodega()!=1 ){ //Coltrans
            $bodega = Doctrine::getTable("Bodega")->find( $reporte->getCaIdbodega() );
            if($bodega->getCaTipo()=="Entrega en Lugar de Arribo")
                $consignee = $bodega->getCaNombre();
            else
                $consignee = $bodega->getCaTipo()." ".$bodega->getCaNombre()." Nit.".$bodega->getCaIdentificacion()." ".$bodega->getCaDireccion();
        } else if($reporte->getCaIdbodega()==1 && (trim($reporte->getCaContinuacion())!= "N/A" && trim($reporte->getCaContinuacion())!="") ) {
            if ($reporte->getCaIdconsignatario()) {
                $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignatario());
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
                $consignee = html_entity_decode($tercero->getCaNombre()) . $id . "\n";
                $consignee .= $tercero->getCaDireccion() . "\n";
                $consignee .= "Cnt.: " . $tercero->getCaContacto() . "\n";
                $consignee .= "Tels.: " . $tercero->getCaTelefonos() . "\n";
                $consignee .= $tercero->getCiudad()->getCaCiudad() . ", " . $tercero->getCiudad()->getTrafico()->getCaNombre();
            } else {
                $consignee = html_entity_decode($reporte->getContacto()->getCliente()->getCaCompania()) . "\n";
                $consignee .= "Nit: " . number_format($reporte->getContacto()->getCliente()->getCaIdalterno(), 0) . "-" . $reporte->getContacto()->getCliente()->getCaDigito() . "\n";
                $consignee .= trim($reporte->getContacto()->getCliente()->getDireccion()) . "\n";
                $consignee .= "Tels.: " . $reporte->getContacto()->getCliente()->getCaTelefonos() . "\n";
                $consignee .= $reporte->getContacto()->getCliente()->getCiudad()->getCaCiudad() . ", " . $reporte->getContacto()->getCliente()->getCiudad()->getTrafico()->getCaNombre() . " " . $reporte->getContacto()->getCliente()->getCaZipcode();
            }
        }
        $pdf->MultiCell(95, 4, html_entity_decode($consignee), 0, 1);
        $pdf->SetXY(18, 90 + $marg);
        $pdf->MultiCell(100, 4, $agent, 0, 1);

        $pdf->SetXY(113, 90 + $marg);
        $accountingInfo = $documento->getCaAccountingInfo();
        if ($reporte->getCaModalidad() == "DIRECTO") {
            $accountingInfo = str_replace("HAWB", "REF", $accountingInfo);
        } else if ($reporte->getCaModalidad() == "CONSOLIDADO") {
            $accountingInfo = str_replace("HAWB", "MAWB", $accountingInfo);
            $accountingInfo = str_replace($documento->getInoMaster()->getCaReferencia(), $documento->getInoAwbCarrierUno()->getCaPrefijo() . " " . $documento->getCaConsecutivo(), $accountingInfo);
        }

        $pdf->MultiCell(100, 4, $accountingInfo, 0, 1);

        $pdf->Text(19, 108 + $marg, $impo_data["agent_iata_code"]);
        $pdf->Text(19, 117 + $marg, $documento->getCaAirportDeparture());
        $pdf->Text(19, 125 + $marg, $documento->getCaIddestinoUno());
        $pdf->Text(29, 125 + $marg, $documento->getInoAwbCarrierUno()->getCaCarrier());
        $pdf->Text(77, 125 + $marg, $documento->getCaIddestinoDos());
        $pdf->Text(87, 125 + $marg, $documento->getInoAwbCarrierDos()->getCaCodigo());
        $pdf->Text(95, 125 + $marg, $documento->getCaIddestinoTrs());
        $pdf->Text(107, 125 + $marg, $documento->getInoAwbCarrierTrs()->getCaCodigo());
        $pdf->Text(114, 125 + $marg, $impo_data["currency"]);
        $pdf->Text(124, 125 + $marg, $guia['charges_code']);
        if ($guia['charges_code'] == "PP") {
            $x1 = 30;
            $x2 = 65;
            $ct = "PREPAID";
            $pdf->Text(129, 125 + $marg, substr($guia['charges_code'], 0, 1));
            $pdf->Text(140, 125 + $marg, substr($guia['charges_code'], 0, 1));
        } else {
            $x1 = 65;
            $x2 = 30;
            $ct = "COLLECT";
            $pdf->Text(135, 125 + $marg, substr($guia['charges_code'], 0, 1));
            $pdf->Text(145, 125 + $marg, substr($guia['charges_code'], 0, 1));
        }
        $pdf->Text(160, 125 + $marg, $config['value_carriage']);
        $pdf->Text(190, 125 + $marg, $config['value_customs']);

        $pdf->Text(19,  134 + $marg, $documento->getCaAirportDestination());
        $pdf->Text(65,  134 + $marg, $impo_data["flight_date_a"]);
        $pdf->Text(89,  134 + $marg, $impo_data["flight_date_b"]);
        $pdf->Text(113, 134 + $marg, $impo_data["amount_insurance"]);

        $marg += ($plantilla) ? 4 : 0;
        $pdf->SetXY(18, 135 + $marg);
        $pdf->MultiCell(190, 4, $documento->getCaHandingInfo(), 0, 1);

        $tot_packages = 0;
        $tot_gross = 0;
        $tot_net = 0;
        $tot_measurement = 0;

        /* BODY */

        $pdf->Text(23, 161 + $marg, number_format($guia['number_packages'], 0));
        $pdf->Text(34, 161 + $marg, noCero($guia['gross_weight']));
        $pdf->Text(47, 161 + $marg, substr($guia['gross_unit'], 0, 1));
        $pdf->SetXY(56, 158 + $marg);
        $pdf->MultiCell(20, 4, $guia['commodity_item'], 0, 1);
        $pdf->Text(80, 165 + $marg, $guia['weight_details']);
        $pdf->Text(83, 161 + $marg, noCero($guia['weight_charge']));
        $pdf->Text(100, 161 + $marg, noCero($guia['rate_charge']));
        $pdf->Text(130, 161 + $marg, noCero($guia['total_charge']));
        
        if ($impo_data["orientacion"] == "Vertical") {
            $pdf->SetXY(152, 158 + $marg);
            $pdf->MultiCell(60, 4, $guia['delivery_goods'], 0, 1);
        } else {
            $pdf->SetXY(74, 162 + $marg);
            $pdf->MultiCell(140, 4, $guia['delivery_goods'], 0, 1);
        }

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

        $pdf->SetXY(92, 252 + $marg);
        $pdf->MultiCell(120, 4, $documento->getCaShipperCertifies(), 0, 1);

        $pdf->SetXY(95, 279 + $marg);
        $pdf->MultiCell(120, 4, date("Y-m-d"), 0, 1);
        $pdf->SetXY(115, 279 + $marg);
        $pdf->MultiCell(150, 4, $agent, 0, 1);

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