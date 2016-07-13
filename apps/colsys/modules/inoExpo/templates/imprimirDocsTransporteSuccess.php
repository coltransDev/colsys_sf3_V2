<?php
$liberaciones = array();
if ($documento->getCaLiberacion() == "EXPRESS RELEASE") {
    $liberacion = "EXPRESS RELEASE";
}else if ($documento->getCaLiberacion() == "TELEX RELEASE"){
    $liberacion = " TELEX RELEASE ";
}else if ($documento->getCaLiberacion() == "ORIGINAL Y COPIA"){ 
    if ($copia) {
        $liberacion = "   C O P I A   ";
    } else {
        $liberacion = "O R I G I N A L";
    }
}

$pdf = new PDF ( 'P', 'mm', 'oficio' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( false );

$pdf->SetAutoPageBreak(true, 0);

$count = count($items);
$page  = 1;
$marg  = 0;
$font_size = ($documento->getCaFontSize())?$documento->getCaFontSize():9;

cabecera($pdf, $marg, $page, $plantilla, $reporte, $consignatario, $notify, $documento, $referencia, $discharge, $font_size, $liberacion, $borrador);

$tot_packages = 0;
$tot_gross = 0;
$tot_net = 0;
$tot_measurement = 0;

$nextY = 0;
$ejeY = $sameY = 130;

foreach ($items as $key => $item){
    $count--;
    if($item->getCaSameGoods()){
        $ejeY = $sameY + 2;
    }

    $pdf->SetXY(10, $ejeY);
    $marksNumbers = "";
    if ($item->getCaContainerNumber()){
        $marksNumbers.= $item->getCaContainerNumber();
    }
    if ($item->getCaSeals()){
        $marksNumbers.= ((strlen($marksNumbers)!=0)?"\n":"").$item->getCaSeals();
    }
    if ($item->getCaMarksNumbers()){
        $marksNumbers.= ((strlen($marksNumbers)!=0)?"\n":"").$item->getCaMarksNumbers();
    }
    if ($item->getCaNumberPackages()){
        $marksNumbers.= ((strlen($marksNumbers)!=0)?"\n":"")."Pks: ".$item->getCaNumberPackages()." ".$item->getCaKindPackages();
        $tot_packages+= $item->getCaNumberPackages();
    }
    if ($item->getCaNetWeight()){
        $marksNumbers.= ((strlen($marksNumbers)!=0)?"\n":"")."Net.:".$item->getCaNetWeight()." ".$item->getCaNetUnit();
        $tot_net+= $item->getCaNetWeight();
    }
    $segmentos = array();
    $pos = strpos($marksNumbers, "첻reak�");
    if ($pos === false){
        $pdf->MultiCell(50, 4, $marksNumbers, 0, 1);
    }else{
        $segmentos = explode("첻reak�", $marksNumbers);
        $segmento = array_shift($segmentos);
        $pdf->MultiCell(50, 4, $segmento, 0, 1);
    }
    
    $sameY = $pdf->getY();
    $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;

    $pdf->SetXY(45, $ejeY);
    $descriptionGoods = $item->getCaDescriptionGoods();
    $pos = strpos($descriptionGoods, "첻reak�");
    if ($pos === false){
        $pdf->MultiCell(110, 4, $descriptionGoods, 0, 1);
    }else{
        $descriptionGoods = str_replace("첻reak�", "", $descriptionGoods);
        $part_1 = substr($descriptionGoods, 0, $pos - 1);
        $part_2 = substr($descriptionGoods, $pos+1, strlen($descriptionGoods));
        $pdf->MultiCell(110, 4, $part_1, 0, 1);
        $pdf->SetXY(100, $ejeY);
        $pdf->MultiCell(110, 4, $part_2, 0, 1);
    }

    $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;
    if ($item->getCaGrossWeight()){
        $grossWeight = $item->getCaGrossWeight()." ".$item->getCaGrossUnit();
        $pdf->SetXY(155, $ejeY);
        $pdf->MultiCell(40, 4, $grossWeight, 0, 1);
        $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;
        $tot_gross+= $item->getCaGrossWeight();
    }
    if ($item->getCaMeasurementWeight()){
        $measurementWeight = $item->getCaMeasurementWeight()." ".$item->getCaMeasurementUnit();
        $pdf->SetXY(190, $ejeY);
        $pdf->MultiCell(40, 4, $measurementWeight, 0, 1);
        $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;
        $tot_measurement+= $item->getCaMeasurementWeight();
    }
    if (count($segmentos) <> 0){
        foreach($segmentos as $segmento){
            if(trim($segmento) != ""){
                piedehoja($pdf, $marg, $documento, $usuario, $font_size, $tot_packages, $tot_net, $tot_gross, $tot_measurement);
                cabecera($pdf, $marg, $page, $plantilla, $reporte, $consignatario, $notify, $documento, $referencia, $discharge, $font_size, $liberacion, $borrador);
                $pdf->SetXY(10, $ejeY = 130);
                $pdf->MultiCell(50, 4, $segmento, 0, 1);
                // $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;
                $nextY = $pdf->getY();
                continue;
            }
        }
    }
    if ($nextY < 200){
        $ejeY = $nextY + 2;
    //}else{
        // piedehoja($pdf, $marg, $documento, $usuario, $font_size, $tot_packages, $tot_net, $tot_gross, $tot_measurement);
        // cabecera($pdf, $marg, $page, $plantilla, $reporte, $consignatario, $notify, $documento, $referencia, $discharge, $font_size, $liberacion, $borrador);
    }
}
piedehoja($pdf, $marg, $documento, $usuario, $font_size, $tot_packages, $tot_net, $tot_gross, $tot_measurement);


$filename = str_replace(".","",$documento->getInoMaestraExpo()->getCaReferencia()).'.pdf';
$pdf->Output ( $filename, "I" );
if( $filename ){ //Para evitar que salga la barra de depuracion
    exit();
}


function cabecera(&$pdf, &$marg, &$page, $plantilla, $reporte, $consignatario, $notify, $documento, $referencia, $discharge, $font_size, $liberacion, $borrador){
    $pdf->AddPage ();
    if ($plantilla){
        $pdf->Image( '/srv/www/digitalFile/formatos/HBL0001.jpg', -5,-10,221,337 );
    } else {
        $marg = 8;
    }

    $pdf->SetFont ( 'Arial', '', $font_size );
    $pdf->SetXY(10, 13 + $marg);
    $shipper = $reporte->getContacto()->getCliente()->getCaCompania()."\n";
    $shipper.= $reporte->getContacto()->getCliente()->getDireccion()."\n";
    $shipper.= $reporte->getContacto()->getCliente()->getCiudad()->getCaCiudad().", ".$reporte->getContacto()->getCliente()->getCiudad()->getTrafico()->getCaNombre()." ".$reporte->getContacto()->getCliente()->getCaZipcode();
    $pdf->MultiCell(100, 4, $shipper, 0, 1);

    $pdf->SetXY(10, 42 + $marg);
    $consignee = $consignatario->getCaNombre()."\n";
    $consignee.= $consignatario->getCaDireccion()."\n";
    $consignee.= $consignatario->getCiudad()->getCaCiudad().", ".$consignatario->getCiudad()->getTrafico()->getCaNombre()."\n";
    $consignee.= $consignatario->getCaIdentificacion();
    $pdf->MultiCell(100, 4, $consignee, 0, 1);

    $pdf->SetXY(10, 68 + $marg);
    if ($notify) {
        $notified = $notify->getCaNombre()."\n";
        $notified.= $notify->getCaDireccion()."\n";
        $notified.= $notify->getCiudad()->getCaCiudad().", ".$notify->getCiudad()->getTrafico()->getCaNombre()."\n";
        $notified.= $notify->getCaIdentificacion()."\n";
        $pdf->MultiCell(100, 4, $notified, 0, 1);
    } else {
        $pdf->MultiCell(100, 4, $consignee, 0, 1);
    }

    if ($borrador) {
        $pdf->SetXY( 5, 160);
        $pdf->SetTextColor(200, 200, 200);
        $pdf->SetFont('Arial', 'B', 68);
        $pdf->Rotate(45);
        $pdf->Write(150, 'BORRADOR');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Rotate(0);
        $pdf->SetXY(30,  20);
    }

    $pdf->SetFont ( 'Arial', '', $font_size );
    $pdf->Text(150, 20 + $marg, $documento->getInoMaestraExpo()->getCaReferencia());

    $pdf->Text(10, 107 + $marg, $documento->getCaOceanVessel());
    $pdf->Text(60, 107 + $marg, $referencia->getOrigen()->getCaCiudad().", ".$referencia->getOrigen()->getTrafico()->getCaNombre());
    $pdf->Text(10, 118 + $marg, $discharge->getCaCiudad().", ".$discharge->getTrafico()->getCaNombre());
    $pdf->Text(60, 118 + $marg, $referencia->getDestino()->getCaCiudad().", ".$referencia->getDestino()->getTrafico()->getCaNombre());

    $pdf->Text(137, 113 + $marg, $liberacion);
    $pdf->Text(140, 118 + $marg, "Page: ".($page++)." / {nb}");

    $pdf->SetFont ( 'Arial', '', $font_size);
    
}

function piedehoja(&$pdf, &$marg, $documento, $usuario, $font_size, $tot_packages, $tot_net, $tot_gross, $tot_measurement){
    $pdf->SetFont ( 'Arial', '', $font_size );
    $pdf->Text( 10, 211 + $marg, $documento->getCaTerminosTransporte());
    $pdf->Text( 40, 211 + $marg, "Packages Total: ".$tot_packages);
    $pdf->Text( 85, 211 + $marg, "Net Total : ".$tot_net);
    $pdf->Text(125, 211 + $marg, "Gross Total : ".$tot_gross);
    $pdf->Text(165, 211 + $marg, "Measurement Total : ".$tot_measurement);

    $pdf->SetXY(15, 233 + $marg);
    $pdf->MultiCell(60, 4, $documento->getCaDeclarationInterest(), 0, 1);
    $pdf->SetXY(140, 233 + $marg);
    $pdf->MultiCell(70, 4, $documento->getCaDeclaredValue(), 0, 1);

    $pdf->SetFont ( 'Arial', '', $font_size );
    $pdf->Text(20, 278, $documento->getCaFreightAmount());
    $pdf->Text(90, 278, $documento->getCaFreightPayable());
    $pdf->Text(135, 278, str_replace(' D.C.', '', $usuario->getSucursal()->getcaNombre()) . ', ' . Utils::fechaLarga($documento->getCaFchdoctransporte()));


    $pdf->Text(90, 287, $documento->getCaNumberOriginal());

    $pdf->SetFont ( 'Arial', '', $font_size );
    $pdf->SetXY(15, 290);
    $pdf->MultiCell(120, 4, $documento->getCaDeliveryGoods(), 0, 1);
}
?>