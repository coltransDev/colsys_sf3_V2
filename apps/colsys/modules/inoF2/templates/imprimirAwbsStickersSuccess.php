<?php
$pdf = new PDF ( 'P', 'mm', 'sticker' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( false );

$pdf->SetAutoPageBreak(true, 0);

foreach ($stickers as $key => $sticker){
    if (!$lines || $lines > 211){
        $lines = 23;
        $switch_col = false;
        $pdf->AddPage ();
    }
    if ($switch_col){
        $cols_add = 140;
        $switch_col = false;
    }else{
        $cols_add = 0;
        $switch_col = true;
    }
    $pdf->SetFont ( 'Arial', 'B', 30 );
    $pdf->SetXY(10 + $cols_add, 30 + $lines);
    $pdf->MultiCell(100, 4, $sticker["guia_numero"], 0, 1);
    $pdf->SetXY(85 + $cols_add, 30 + $lines);
    $pdf->MultiCell(100, 4, $sticker["destination"], 0, 1);
    $pdf->SetXY(117 + $cols_add, 30 + $lines);
    $pdf->MultiCell(100, 4, $sticker["mawb_pieces"], 0, 1);

    $pdf->SetFont ( 'Arial', 'B', 24 );
    $pdf->SetXY(45 + $cols_add, 55 + $lines);
    $pdf->MultiCell(100, 4, $sticker["guia_hija"], 0, 1);
    $pdf->SetXY(117 + $cols_add, 55 + $lines);
    $pdf->MultiCell(100, 4, $sticker["numero_stickers"], 0, 1);
    
    if ($lines >= 23 && !$switch_col){
        $lines+= 94;
    }
}

$filename = "stickers.pdf";
$pdf->Output ( $filename, "I" );
if( $filename ){ //Para evitar que salga la barra de depuracion
    exit();
}
?>
