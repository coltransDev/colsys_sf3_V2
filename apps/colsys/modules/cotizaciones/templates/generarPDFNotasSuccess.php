<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


$imprimirNotas = $sf_data->getRaw("imprimirNotas");

//print_r( $imprimirNotas );


$pdf = new PDF (  );
$pdf->Open ();
$pdf->setIdempresa($idempresa);
if (in_array($idempresa, array(1, 11))){
    $pdf->setColmasHeader(true);
    $pdf->setColmasFooter(true);
}else if (in_array($idempresa, array(2, 7, 8))){
    $pdf->setColtransHeader ( true );
    $pdf->setColtransFooter ( true );
}
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);


switch( $cotizacion->getCaFuente()){
	case "Arial":
		$font = 'Arial';

		break;
	case "Calibri":
		$pdf->AddFont('Calibri','','calibri.php');
		$pdf->AddFont('Calibri','B','calibrib.php');
		$font = 'Calibri';
		break;
	default:
		$pdf->AddFont('Tahoma','','tahoma.php');
		$pdf->AddFont('Tahoma','B','tahomab.php');
		$font = 'Tahoma';
		break;

}

$pdf->SetFont($font,'',10);



$imprimirNotas = array_unique( $imprimirNotas );

$nuevaPagina = false;

foreach($imprimirNotas as $val ) {
	if($nuevaPagina){
   		$pdf->AddPage();
		$nuevaPagina=true;
	}

	//Hace que el titulo tenga por lo menos 2 renglones
	if( $pdf->GetY()>$pdf->PageBreakTrigger-15 ){
		$pdf->AddPage();
	}else{
		$pdf->Ln(2);
	}

	$pdf->SetFont($font,'B',9);
	$pdf->MultiCell(0, 4, $notas[$val."Titulo"], 0,'C',0);
	$pdf->Ln(1);
	$pdf->SetFont($font,'',8);
	$pdf->MultiCell(0, 4, $notas[$val], 0,'J',0);
}





$pdf->Output ( $filename);
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}

?>