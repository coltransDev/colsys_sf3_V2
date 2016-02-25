<?php
$pdf = new PDF ( 'P', 'mm', 'oficio' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( false );

$pdf->SetAutoPageBreak(true, 0);

$items = $documento->getExpoDocItems();
$count = count($items);
$page  = 1;
while (true) {
    $pdf->AddPage ();
    if ($plantilla){
        $pdf->Image( '/srv/www/digitalFile/formatos/HBL0001.jpg', -5,-10,221,337 );
    }

    $pdf->SetFont ( 'Arial', '', 9 );
    $pdf->SetXY(10, 13);
    $shipper = $reporte->getContacto()->getCliente()->getCaCompania()."\n";
    $shipper.= $reporte->getContacto()->getCliente()->getDireccion()."\n";
    $shipper.= $reporte->getContacto()->getCliente()->getCiudad()->getCaCiudad().", ".$reporte->getContacto()->getCliente()->getCiudad()->getTrafico()->getCaNombre()." ".$reporte->getContacto()->getCliente()->getCaZipcode();
    $pdf->MultiCell(100, 4, $shipper, 0, 1);

    $pdf->SetXY(10, 42);
    $consignee = $consignatario->getCaNombre()."\n";
    $consignee.= $consignatario->getCaDireccion()."\n";
    $consignee.= $consignatario->getCiudad()->getCaCiudad().", ".$consignatario->getCiudad()->getTrafico()->getCaNombre()."\n";
    $consignee.= $consignatario->getCaIdentificacion();
    $pdf->MultiCell(100, 4, $consignee, 0, 1);
    
    $pdf->SetXY(10, 68);
    if ($notify) {
        $notified = $notify->getCaNombre()."\n";
        $notified.= $notify->getCaDireccion()."\n";
        $notified.= $notify->getCiudad()->getCaCiudad().", ".$notify->getCiudad()->getTrafico()->getCaNombre()."\n";
        $notified.= $notify->getCaIdentificacion()."\n";
        $pdf->MultiCell(100, 4, $notified, 0, 1);
    } else {
        $pdf->MultiCell(100, 4, $consignee, 0, 1);
    }

    $pdf->Text(150, 20, $documento->getInoMaestraExpo()->getCaReferencia());

    $pdf->Text(10, 107, $documento->getCaOceanVessel());
    $pdf->Text(60, 107, $referencia->getOrigen()->getCaCiudad().", ".$referencia->getOrigen()->getTrafico()->getCaNombre());
    $pdf->Text(10, 118, $discharge->getCaCiudad().", ".$discharge->getTrafico()->getCaNombre());
    $pdf->Text(60, 118, $referencia->getDestino()->getCaCiudad().", ".$referencia->getDestino()->getTrafico()->getCaNombre());
    
    $pdf->Text(140, 118, "Page: ".($page++)." / {nb}");

    $pdf->SetFont ( 'Arial', '', $documento->getCaFontSize());

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
            $marksNumbers.= $item->getCaContainerNumber()."\n";
        }
        if ($item->getCaSeals()){
            $marksNumbers.= $item->getCaSeals()."\n";
        }
        if ($item->getCaMarksNumbers()){
            $marksNumbers.= $item->getCaMarksNumbers()."\n";
        }

        $pdf->MultiCell(50, 4, $marksNumbers, 0, 1);
        $sameY = $pdf->getY();
        $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;

        $pdf->SetXY(45, $ejeY);
        $descriptionGoods = "";
        if ($item->getCaNumberPackages()){
            $descriptionGoods.= "Packages: ".$item->getCaNumberPackages()." ".$item->getCaKindPackages();
            $tot_packages+= $item->getCaNumberPackages();
        }
        $descriptionGoods.= "\n".$item->getCaDescriptionGoods();

        $pdf->MultiCell(110, 4, $descriptionGoods, 0, 1);

        $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;

        if ($item->getCaGrossWeight()){
            $grossWeight = $item->getCaGrossWeight()." ".$item->getCaGrossUnit();
            if ($item->getCaNetWeight()){
                $grossWeight.= "\nNET :".$item->getCaNetWeight()." ".$item->getCaNetUnit();
                $tot_net+= $item->getCaNetWeight();
            }
            $pdf->SetXY(160, $ejeY);
            $pdf->MultiCell(30, 4, $grossWeight, 0, 1);
            $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;
            $tot_gross+= $item->getCaGrossWeight();
        }

        if ($item->getCaMeasurementWeight()){
            $measurementWeight = $item->getCaMeasurementWeight()." ".$item->getCaMeasurementUnit();
            $pdf->SetXY(190, $ejeY);
            $pdf->MultiCell(30, 4, $measurementWeight, 0, 1);
            $nextY = ($pdf->getY()>$nextY)?$pdf->getY():$nextY;
            $tot_measurement+= $item->getCaMeasurementWeight();
        }
        if ($nextY < 200){
            $ejeY = $nextY + 2;
        }else{
            break;
        }
    }
    if ($borrador) {
        $pdf->SetTextColor(200, 200, 200);
        $pdf->SetFont('Arial', 'B', 68);
        $pdf->Rotate(45);
        $pdf->Write(150, 'BORRADOR');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Rotate(0);
    }

    $pdf->SetFont ( 'Arial', '', 9 );
    $pdf->Text(10, 210, $documento->getCaTerminosTransporte());
    $pdf->Text(35, 210, "Packages Total: ".$tot_packages);
    $pdf->Text(70, 210, "Net Total : ".$tot_net);
    $pdf->Text(100, 210, "Gross Total : ".$tot_gross);
    $pdf->Text(135, 210, "Measurement Total : ".$tot_measurement);
    $pdf->Text(175, 210, $documento->getCaLiberacion());

    $pdf->SetXY(15, 233);
    $pdf->MultiCell(60, 4, $documento->getCaDeclarationInterest(), 0, 1);
    $pdf->SetXY(140, 233);
    $pdf->MultiCell(70, 4, $documento->getCaDeclaredValue(), 0, 1);

    $pdf->SetFont ( 'Arial', '', 9 );
    $pdf->Text(20, 278, $documento->getCaFreightAmount());
    $pdf->Text(90, 278, $documento->getCaFreightPayable());
    $pdf->Text(135, 278, str_replace(' D.C.', '', $usuario->getSucursal()->getcaNombre()) . ', ' . Utils::fechaLarga($documento->getCaFchdoctransporte()));


    $pdf->Text(90, 287, $documento->getCaNumberOriginal());

    $pdf->SetFont ( 'Arial', '', 9 );
    $pdf->SetXY(15, 290);
    $pdf->MultiCell(120, 4, $documento->getCaDeliveryGoods(), 0, 1);
    
    if(!$count){
        break;
    }
}

$filename = str_replace(".","",$documento->getInoMaestraExpo()->getCaReferencia()).'.pdf';
$pdf->Output ( $filename, "I" );
if( $filename ){ //Para evitar que salga la barra de depuracion
    exit();
}
?>