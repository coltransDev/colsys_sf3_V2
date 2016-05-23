<?php
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

$pdf->AddPage ();
if ($plantilla){
    $pdf->Image( '/srv/www/digitalFile/formatos/AWB0001.jpg', -5, -8,221,337 );
} else {
    $marg = 20;
}

/* HEADER */

$pdf->SetFont ( 'Arial', 'B', $font_size + 5 );
$pdf->SetXY(13, 25 + $marg);
$pdf->MultiCell(100, 4, $documento->getExpoCarrierUno()->getCaPrefijo(), 0, 1);
$pdf->SetXY(35, 25 + $marg);
$pdf->MultiCell(100, 4, $documento->getCaConsecutivo(), 0, 1);
$pdf->SetXY(150, 25 + $marg);
$pdf->MultiCell(100, 4, $documento->getExpoCarrierUno()->getCaPrefijo(). " " .$documento->getCaConsecutivo(), 0, 1);

$pdf->SetFont ( 'Arial', '', $font_size );
$pdf->SetXY(13, 35 + $marg);
$shipper = strtoupper($empresa->getCaNombre())."\n";
$shipper.= "Nit: ". number_format($empresa->getIds()->getCaIdalterno(), 0)."-".$empresa->getIds()->getCaDv()."\n";
$shipper.= $reporte->getUsuario()->getSucursal()->getCaDireccion()."\n";
$shipper.= "Tels.: ". $reporte->getUsuario()->getSucursal()->getCaTelefono()."\n";
$shipper.= strtoupper($reporte->getUsuario()->getSucursal()->getCaNombre())."-COLOMBIA";
$pdf->MultiCell(100, 4, $shipper, 0, 1);

if ($documento->getExpoCarrierUno()->getCaPathLogo()) {
    $pdf->Image($documento->getExpoCarrierUno()->getCaPathLogo(), 132, 33, 75, 20 );
}

$pdf->SetXY(13, 68 + $marg);
$consignee = $consignatario->getCaNombre()."\n";
$consignee.= $consignatario->getCaDireccion()."\n";
$consignee.= $consignatario->getCaTelefonos()."\n";
$consignee.= $consignatario->getCiudad()->getCaCiudad().", ".$consignatario->getCiudad()->getTrafico()->getCaNombre();
$pdf->MultiCell(100, 4, $consignee, 0, 1);

$pdf->SetXY(13, 88 + $marg);
$agent = strtoupper($empresa->getCaNombre())."\n";
$agent.= $reporte->getUsuario()->getSucursal()->getCaDireccion()."\n";
$agent.= "Tels.: ". $reporte->getUsuario()->getSucursal()->getCaTelefono()."\n";
$agent.= strtoupper($reporte->getUsuario()->getSucursal()->getCaNombre())."-COLOMBIA";
$pdf->MultiCell(100, 4, $agent, 0, 1);

$pdf->SetXY(108, 88 + $marg);
$pdf->MultiCell(100, 4, $documento->getCaAccountingInfo(), 0, 1);

$pdf->Text( 14, 111 + $marg, $config['agent_iata_code']);
$pdf->Text( 61, 111 + $marg, $documento->getExpoCarrierUno()->getCaAccount());
$pdf->Text( 14, 119 + $marg, $documento->getCaAirportDeparture());
$pdf->Text( 14, 128 + $marg, $documento->getCaIddestinoUno());
$pdf->Text( 24, 128 + $marg, $documento->getExpoCarrierUno()->getCaCarrier());
$pdf->Text( 72, 128 + $marg, $documento->getCaIddestinoDos());
$pdf->Text( 82, 128 + $marg, $documento->getExpoCarrierDos()->getCaCodigo());
$pdf->Text( 90, 128 + $marg, $documento->getCaIddestinoTrs());
$pdf->Text(102, 128 + $marg, $documento->getExpoCarrierTrs()->getCaCodigo());

$tarifas = $reporte->getRepTarifa();
$currency= array();
foreach($tarifas as $tarifa){
    if(!in_array($tarifa->getCaCobrarIdm(), $currency)){
       $currency[] = $tarifa->getCaCobrarIdm();
    }
}
$pdf->Text(110, 128 + $marg, $currency[0]);
$pdf->Text(119, 128 + $marg, $documento->getCaChargesCode());
if ($documento->getCaChargesCode() == "PP"){
    $x1 = 25; $x2 = 60; $ct = "PREPAID";
    $pdf->Text(125, 128 + $marg, substr($documento->getCaChargesCode(), 0, 1));
    $pdf->Text(135, 128 + $marg, substr($documento->getCaChargesCode(), 0, 1));
}else{
    $x1 = 60; $x2 = 25; $ct = "COLLECT";
    $pdf->Text(130, 128 + $marg, substr($documento->getCaChargesCode(), 0, 1));
    $pdf->Text(140, 128 + $marg, substr($documento->getCaChargesCode(), 0, 1));
}
$pdf->Text(155, 128 + $marg, $config['value_carriage']);
$pdf->Text(185, 128 + $marg, $config['value_customs']);

$pdf->Text( 14, 137 + $marg, $documento->getCaAirportDestination());
$pdf->Text(119, 137 + $marg, $config['amount_insurance']);

$pdf->SetXY(13, 142 + $marg);
$pdf->MultiCell(100, 4, $documento->getCaHandingInfo(), 0, 1);

$tot_packages = 0;
$tot_gross = 0;
$tot_net = 0;
$tot_measurement = 0;

/* BODY */

$pdf->Text( 16, 185 + $marg, $documento->getCaNumberPackages());
$pdf->Text( 32, 185 + $marg, $documento->getCaGrossWeight());
$pdf->Text( 42, 185 + $marg, substr($documento->getCaGrossUnit(),0,1));
$pdf->Text( 75, 180 + $marg, $documento->getCaWeightDetails());
$pdf->Text( 78, 185 + $marg, $documento->getCaWeightCharge());
$pdf->Text(100, 185 + $marg, $documento->getCaRateCharge());
$sub_total = $documento->getCaWeightCharge() * $documento->getCaRateCharge();
$pdf->Text(130, 185 + $marg, $sub_total);
$pdf->SetXY(148, 175 + $marg);
$pdf->MultiCell( 60, 4, $documento->getCaDeliveryGoods(), 0, 1);

$pdf->Text( 16, 225 + $marg, $documento->getCaNumberPackages());
$pdf->Text( 32, 225 + $marg, $documento->getCaGrossWeight());
$pdf->Text(130, 225 + $marg, $sub_total);


/* FOOTER */

$gran_total = $sub_total + $documento->getCaDueAgent() + $documento->getCaDueCarrier();
$pdf->Text( $x1, 235 + $marg, $sub_total);
$pdf->Text( $x2, 235 + $marg, $ct);
$pdf->Text( $x1, 262 + $marg, $documento->getCaDueAgent());
$pdf->Text( $x1, 272 + $marg, $documento->getCaDueCarrier());
$pdf->Text( $x1, 290 + $marg, $gran_total);

$pdf->SetXY( 88, 235 + $marg);
$pdf->MultiCell( 120, 4, $documento->getCaOtherCharges(), 0, 1);

$pdf->SetXY( 88, 265 + $marg);
$pdf->MultiCell( 120, 4, $documento->getCaShipperCertifies(), 0, 1);

$pdf->SetXY( 88, 292 + $marg);
$executed_on = date("F d \of Y", strtotime($documento->getCaFchdoctransporte()))." - ";
$executed_on.= strtoupper($reporte->getUsuario()->getSucursal()->getCaNombre())."-COLOMBIA/CD/";
$executed_on.= strtoupper($documento->getUsuliquidado()->getCaNombre());
$pdf->MultiCell( 150, 4, $executed_on, 0, 1);

$filename = str_replace(".","",$documento->getInoMaestraExpo()->getCaReferencia()).'.pdf';
$pdf->Output ( $filename, "I" );
if( $filename ){ //Para evitar que salga la barra de depuracion
    exit();
}
?>