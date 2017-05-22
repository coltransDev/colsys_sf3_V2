<?
$proceso = $sf_data->getRaw("proceso");
$responsables = $sf_data->getRaw("responsables");
$pdf = new PDF ( 'P', 'mm', 'letter' );
$pdf->Open ();
$pdf->AliasNbPages ();
$pdf->setTopMargin(0);
$pdf->setLeftMargin ( 5 );
$pdf->setRightMargin ( 5 );
$pdf->setColtransHeader ( false );

$pdf->SetAutoPageBreak(true, 0);
$pdf->SetHeight ( 4 );
$pdf->AddPage ();

/*if( $reporte->getCaUsuanulado() ){
    $x=$pdf->GetX();
    $y=$pdf->GetY();
    $pdf->SetY( 50 );
    $pdf->SetTextColor(128,128,128);
    $pdf->SetFont("Arial",'B',84);
    $pdf->Write(5,'A N U L A D O');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetX( $x );
    $pdf->SetY( $y );
}*/

$pdf->SetFont ( 'Arial', '', 8 );
list ( $anno, $mes, $dia, $tiempo, $minuto, $segundo ) = sscanf ( date ( "Y-m-d" ), "%d-%d-%d %d:%d:%d" );

$pdf->SetWidths ( array (20, 180 ) );
$pdf->SetAligns ( array ("L", "C" ) );
$pdf->SetStyles ( array ("","B" ) );
$pdf->Row ( array ('','EVALUACION DE RIESGOS<br/>PROCESO: '.strtoupper($proceso->getCaNombre())) );

$pdf->SetWidths ( array (25, 25, 25, 25, 25, 25, 25, 25 ) );
$pdf->SetAligns ( array ("L", "C", "L", "C", "L", "C", "L", "C" ) );
$pdf->SetStyles ( array ("", "B", "", "B", "", "B", "", "B" ) );
$pdf->SetFills ( array (1, 0, 1, 0, 1, 0, 1, 0 ) );

$id_cotizacion = null;

//$pdf->Row ( array ('Reporte No.: ', $reporte->getCaConsecutivo (), 'Versión No.: ', $reporte->getCaVersion () . "/" . $reporte->numVersiones(), 'Fecha Reporte: ', Utils::fechaMes ( $reporte->getCaFchreporte () ), 'Cotización: ', $reporte->getCaIdcotizacion () ) );

$pdf->SetWidths ( array (200 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetFills ( array (0 ) );
$pdf->Row ( array ('Información General' ) );

$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

