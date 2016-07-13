<?php
function noCero($val){
    if (strlen($val) == 1 and floatval($val) == 0){
        return "";
    }else if ($val <> 0){
        if (floatval($val) == $val){
            return number_format ( $val, 2 );
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

$pdf = new PDF ( 'P', 'mm', 'oficio' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( false );

$pdf->SetAutoPageBreak(true, 0);

$page  = 1;
$marg  = 0;
$font_size = 9;

if (!$guiahija){
    $guias[] = array(
        "rate_charge" => $documento->getCaRateCharge(),
        "total_charge" => $documento->getCaWeightCharge() * $documento->getCaRateCharge(),
        "gran_total" => $documento->getCaWeightCharge() * $documento->getCaRateCharge(),
        "super_total" => ($documento->getCaWeightCharge() * $documento->getCaRateCharge()) + $documento->getCaDueAgent() + $documento->getCaDueCarrier(),
        "delivery_goods" => $documento->getCaDeliveryGoods(),
        "other_charges" => $documento->getCaOtherCharges()
    );
    $prefijo = $documento->getExpoCarrierUno()->getCaPrefijo();
    $consecutivo = $documento->getCaConsecutivo();
    $logotipo = $documento->getExpoCarrierUno()->getCaPathLogo();
}else{
    $guias = json_decode(html_entity_decode($documento->getCaChildrens()), true);
    foreach ($guias as $key => $guia){
        if ($guia["kind_rate"] == "As Agreed"){
            $guias[$key]["rate_charge"] = "";
            $guias[$key]["total_charge"] = strtoupper($guia["kind_rate"]);
            $guias[$key]["gran_total"] = strtoupper($guia["kind_rate"]);
            $guias[$key]["super_total"] = strtoupper($guia["kind_rate"]);
        }else if ($guia["kind_rate"] == "Valor Minimo"){
            $guias[$key]["rate_charge"] = "Mínima";
            $guias[$key]["total_charge"] = $guia["rate_charge"];
            $guias[$key]["gran_total"] = $guia["rate_charge"];
            $guias[$key]["super_total"] = $guia["rate_charge"] + $documento->getCaDueAgent() + $documento->getCaDueCarrier();
        }else {
            $guias[$key]["rate_charge"] = $documento->getCaRateCharge();
            $guias[$key]["total_charge"] = $documento->getCaWeightCharge() * $documento->getCaRateCharge();
            $guias[$key]["gran_total"] = $documento->getCaWeightCharge() * $documento->getCaRateCharge();
            $guias[$key]["super_total"] = ($documento->getCaWeightCharge() * $documento->getCaRateCharge()) + $documento->getCaDueAgent() + $documento->getCaDueCarrier();
        }
    }
    $ref_array = explode(".", $documento->getInoMaestraExpo()->getCaReferencia());
    $prefijo = $ref_array[0];
    $consecutivo = $ref_array[1].$ref_array[2].$ref_array[3].$ref_array[4];
    $logotipo = "/srv/www/digitalFile/formatos/logo_coltrans.jpg";
}

foreach ($guias as $key => $guia){
    $guia_numero = $prefijo. " " .$consecutivo. (($guiahija)?" ".($key+1):"");

    $pdf->AddPage ();
    /* HEADER */
    
    if ($plantilla){
        $pdf->Image( '/srv/www/digitalFile/formatos/AWB0001.jpg', 0, -8,221,337 );
        $marg = -5;
    } else {
        $marg = 0;
    }

    $pdf->SetFont ( 'Arial', 'B', $font_size + 5 );
    $pdf->SetXY(18, 30 + $marg);
    $pdf->MultiCell(100, 4, $prefijo, 0, 1);
    $pdf->SetXY(40, 30 + $marg);
    $pdf->MultiCell(100, 4, $consecutivo, 0, 1);
    $pdf->SetXY(155, 30 + $marg);
    $pdf->MultiCell(100, 4, $guia_numero, 0, 1);

    $pdf->SetFont ( 'Arial', '', $font_size );
    $pdf->SetXY(18, 40 + $marg);
    if ($documento->getInoMaestraExpo()->getCaModalidad() == "Directo" or $guiahija){
        $shipper = $reporte->getContacto()->getCliente()->getCaCompania()."\n";
        $shipper.= "Nit: ". number_format($reporte->getContacto()->getCliente()->getCaIdalterno(), 0)."-".$reporte->getContacto()->getCliente()->getCaDigito()."\n";
        $shipper.= $reporte->getContacto()->getCliente()->getDireccion()."\n";
        $shipper.= "Tels.: ". $reporte->getContacto()->getCliente()->getCaTelefonos()."\n";
        $shipper.= $reporte->getContacto()->getCliente()->getCiudad()->getCaCiudad().", ".$reporte->getContacto()->getCliente()->getCiudad()->getTrafico()->getCaNombre()." ".$reporte->getContacto()->getCliente()->getCaZipcode();
    } else {
        $shipper = strtoupper($empresa->getCaNombre())."\n";
        $shipper.= "Nit: ". number_format($empresa->getIds()->getCaIdalterno(), 0)."-".$empresa->getIds()->getCaDv()."\n";
        $shipper.= $reporte->getUsuario()->getSucursal()->getCaDireccion()."\n";
        $shipper.= "Tels.: ". $reporte->getUsuario()->getSucursal()->getCaTelefono()."\n";
        $shipper.= $reporte->getUsuario()->getSucursal()->getCaNombre()."-COLOMBIA";
    }
    $pdf->MultiCell(100, 4, $shipper, 0, 1);

    if ($documento->getExpoCarrierUno()->getCaPathLogo()) {
        $pdf->Image($logotipo, 136, $marg+38, 75, 20 );
    }

    $pdf->SetXY(18, 68 + $marg);
    $consignee = $consignatario->getCaNombre()."\n";
    $consignee.= $consignatario->getCaDireccion()."\n";
    $consignee.= "Tels.: ". $consignatario->getCaTelefonos()."\n";
    $consignee.= $consignatario->getCiudad()->getCaCiudad().", ".$consignatario->getCiudad()->getTrafico()->getCaNombre();
    $pdf->MultiCell(100, 4, $consignee, 0, 1);

    $pdf->SetXY(18, 88 + $marg);
    $agent = strtoupper($empresa->getCaNombre())."\n";
    $agent.= $reporte->getUsuario()->getSucursal()->getCaDireccion()."\n";
    $agent.= "Tels.: ". $reporte->getUsuario()->getSucursal()->getCaTelefono()."\n";
    $agent.= $reporte->getUsuario()->getSucursal()->getCaNombre()."-COLOMBIA";
    $pdf->MultiCell(100, 4, $agent, 0, 1);

    $pdf->SetXY(113, 90 + $marg);
    $pdf->MultiCell(100, 4, $documento->getCaAccountingInfo(), 0, 1);

    $pdf->Text( 19, 111 + $marg, $config['agent_iata_code']);
    $pdf->Text( 66, 111 + $marg, $documento->getExpoCarrierUno()->getCaAccount());
    $pdf->Text( 19, 119 + $marg, $documento->getCaAirportDeparture());
    $pdf->Text( 19, 127 + $marg, $documento->getCaIddestinoUno());
    $pdf->Text( 29, 127 + $marg, $documento->getExpoCarrierUno()->getCaCarrier());
    $pdf->Text( 77, 127 + $marg, $documento->getCaIddestinoDos());
    $pdf->Text( 87, 127 + $marg, $documento->getExpoCarrierDos()->getCaCodigo());
    $pdf->Text( 95, 127 + $marg, $documento->getCaIddestinoTrs());
    $pdf->Text(107, 127 + $marg, $documento->getExpoCarrierTrs()->getCaCodigo());

    $tarifas = $reporte->getRepTarifa();
    $currency= array();
    foreach($tarifas as $tarifa){
        if(!in_array($tarifa->getCaCobrarIdm(), $currency)){
           $currency[] = $tarifa->getCaCobrarIdm();
        }
    }
    $pdf->Text(115, 127 + $marg, $currency[0]);
    $pdf->Text(124, 127 + $marg, $documento->getCaChargesCode());
    if ($documento->getCaChargesCode() == "PP"){
        $x1 = 30; $x2 = 65; $ct = "PREPAID";
        $pdf->Text(129, 127 + $marg, substr($documento->getCaChargesCode(), 0, 1));
        $pdf->Text(140, 127 + $marg, substr($documento->getCaChargesCode(), 0, 1));
    }else{
        $x1 = 65; $x2 = 30; $ct = "COLLECT";
        $pdf->Text(135, 127 + $marg, substr($documento->getCaChargesCode(), 0, 1));
        $pdf->Text(145, 127 + $marg, substr($documento->getCaChargesCode(), 0, 1));
    }
    $pdf->Text(160, 127 + $marg, $config['value_carriage']);
    $pdf->Text(190, 127 + $marg, $config['value_customs']);

    $pdf->Text( 18, 136 + $marg, $documento->getCaAirportDestination());
    $pdf->Text(124, 136 + $marg, $config['amount_insurance']);

    $pdf->SetXY(18, 140 + $marg);
    $pdf->MultiCell(100, 4, $documento->getCaHandingInfo(), 0, 1);

    $tot_packages = 0;
    $tot_gross = 0;
    $tot_net = 0;
    $tot_measurement = 0;

    /* BODY */

    $pdf->Text( 21, 185 + $marg, $documento->getCaNumberPackages());
    $pdf->Text( 34, 185 + $marg, $documento->getCaGrossWeight());
    $pdf->Text( 47, 185 + $marg, substr($documento->getCaGrossUnit(),0,1));
    $pdf->Text( 80, 180 + $marg, $documento->getCaWeightDetails());
    $pdf->Text( 83, 185 + $marg, noCero($documento->getCaWeightCharge()));
    $pdf->Text(105, 185 + $marg, noCero($guia['rate_charge']));
    $pdf->Text(130, 185 + $marg, noCero($guia['total_charge']));
    $pdf->SetXY(150, 175 + $marg);
    $pdf->MultiCell( 60, 4, $guia['delivery_goods'], 0, 1);

    $pdf->Text( 21, 219 + $marg, noCero($documento->getCaNumberPackages()));
    $pdf->Text( 34, 219 + $marg, noCero($documento->getCaGrossWeight()));
    $pdf->Text(135, 219 + $marg, noCero($guia['gran_total']));


    /* FOOTER */

    $pdf->Text( $x1, 226 + $marg, noCero($guia['gran_total']));
    $pdf->Text( $x2, 225 + $marg, $ct);
    $pdf->Text( $x1, 252 + $marg, noCero($documento->getCaDueAgent()));
    $pdf->Text( $x1, 262 + $marg, noCero($documento->getCaDueCarrier()));
    $pdf->Text( $x1, 279 + $marg, noCero($guia['super_total']));

    $pdf->SetXY( 93, 226 + $marg);
    $pdf->MultiCell( 120, 4, $guia['other_charges'], 0, 1);

    $pdf->SetXY( 93, 255 + $marg);
    $pdf->MultiCell( 120, 4, $documento->getCaShipperCertifies(), 0, 1);

    $pdf->SetXY( 93, 280 + $marg);
    $ultimoActualido = ($documento->getCaUsuactualizado())?$documento->getCaUsuactualizado():$documento->getCaUsucreado();
    $executed_on = date("F d \of Y", strtotime($documento->getCaFchdoctransporte()))." - ";
    $executed_on.= strtoupper($reporte->getUsuario()->getSucursal()->getCaNombre())."-COLOMBIA/$ultimoActualido/";
    $executed_on.= strtoupper($documento->getUsuliquidado()->getCaNombre());
    $pdf->MultiCell( 150, 4, $executed_on, 0, 1);

    $pdf->SetFont ( 'Arial', 'B', $font_size + 5 );
    $pdf->SetXY(155, 292 + $marg);
    $pdf->MultiCell(100, 4, $guia_numero, 0, 1);
}

$filename = str_replace(".","",$documento->getInoMaestraExpo()->getCaReferencia()).'.pdf';
$pdf->Output ( $filename, "I" );
if( $filename ){ //Para evitar que salga la barra de depuracion
    exit();
}
?>