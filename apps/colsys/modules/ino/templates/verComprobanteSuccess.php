<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



$pdf = new PDF (  );
$pdf->Open ();
$pdf->setColtransHeader ( false );
$pdf->setColtransFooter ( false );
$pdf->AliasNbPages();
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);

$font = 'Courier';

$pdf->SetFont($font,'',6);

$x=$pdf->GetX();
$y=$pdf->GetY();



$marginHeader = 120;
$space = 2;

$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "CR 98 No 25G-10 ",0,1, "L");
$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "PBX: ",0,1, "L");
$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "FAX: ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "Apartado Aéreo 151596: ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "E-mail: bogota@coltrans.com.co ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "BOGOTA      , Colombia ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "Nit. 800.024.075-8 ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "No somos grandes contribuyentes ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "Agentes de retención de IVA con ",0,1, "L");

$y+=$space;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "transacciones con el régimen simplificado.",0,1, "L");


$y+=6;
$pdf->SetXY($x+$marginHeader,$y);
$pdf->Cell(0, 4, "FACTURA DE VENTA NO ". str_pad($comprobante->getCaConsecutivo(), 14, "0", STR_PAD_LEFT),0,1, "L");


$pdf->Image(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'ColtransSA.jpg', 18, 12, 63, 10, 'JPG');

$y+=6;


//Encabezado
$pdf->Rect($x,$y,175,20);
$pdf->line($x+100,$y+10,$x+175,$y+10);
$pdf->line($x+100,$y,$x+100,$y+20);
$pdf->line($x+130,$y,$x+130,$y+20);
$pdf->line($x+145,$y,$x+145,$y+10);


$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, "FECHA FACTURA"  ,0,1, "L");

$pdf->SetXY($x+133,$y);
$pdf->Cell(0, 4, "PLAZO"  ,0,1, "L");

$pdf->SetXY($x+147,$y);
$pdf->Cell(0, 4, "FECHA DE VENCIMIENTO"  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "SEÑORES: ". $comprobante->getIds()->getCaNombre() ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "ATENCION: "  ,0,1, "L");

//[TODO] REEMPLAZAR POR LOS VALORES
$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, "2009/10/08"  ,0,1, "L");
$pdf->SetXY($x+135,$y);
$pdf->Cell(0, 4, "30"  ,0,1, "L");
$pdf->SetXY($x+152,$y);
$pdf->Cell(0, 4, "2009/11/08 "  ,0,1, "L");

$y+=6;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "DIRECCIÓN: "  ,0,1, "L");



$pdf->SetXY($x+105,$y);
$pdf->Cell(0, 4, "TASA DE CAMBIO "  ,0,1, "L");
$pdf->SetXY($x+148,$y);
$pdf->Cell(0, 4, "No. REF."  ,0,1, "L");


$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "CIUDAD: "  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "TELEFONO: "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "NIT: "  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "VENDEDOR: "  ,0,1, "L");


$pdf->SetXY($x+110,$y);
$pdf->Cell(0, 4, "1,927.31 "  ,0,1, "L");
$pdf->SetXY($x+143,$y);
$pdf->Cell(0, 4, "420-55-10-011-9 "  ,0,1, "L");

$y+=8;

$pdf->Rect($x,$y,175,23);
$y+=$space;

$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "BIENES TRANS. : "  ,0,1, "L");
$pdf->SetXY($x+135,$y);
$pdf->Cell(0, 4, "SERVICIO : "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "DETALLE  : "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "BL Hijo  : "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Nave  : "  ,0,1, "L");

$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "Piezas  : "  ,0,1, "L");

$pdf->SetXY($x+90,$y);
$pdf->Cell(0, 4, "Peso  : "  ,0,1, "L");

$pdf->SetXY($x+120,$y);
$pdf->Cell(0, 4, "CMB  : "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Trayecto  : "  ,0,1, "L");

$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "Para embarques marítimos, la factura debe ser liquidada a la TRM del día de pago mas $30 siempre y cuando esta nos sea inferior"  ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "a la tasa de emisión de esta factura.  También puede consultar la tasa de cambio para pago de sus facturas, llamando a nuestro"  ,0,1, "L");
$y+=$space;
$pdf->SetXY($x+10,$y);
$pdf->Cell(0, 4, "PBX 4239300 Opción 1."  ,0,1, "L");


//Detalles
$y+=10;

$pdf->Rect($x,$y,175,150);

$pdf->line($x,$y+6,$x+175,$y+6);
$pdf->line($x,$y+6,$x+175,$y+6);

$pdf->line($x+20,$y,$x+20,$y+125);
$pdf->line($x+125,$y,$x+125,$y+125);
$pdf->line($x+150,$y,$x+150,$y+125);

$pdf->line($x,$y+125,$x+175,$y+125);
$pdf->line($x,$y+135,$x+175,$y+135);

$y+=1;

$pdf->SetXY($x+5,$y);
$pdf->Cell(0, 4, "CÓDIGO"  ,0,1, "L");
$pdf->SetXY($x+60,$y);
$pdf->Cell(0, 4, "D E S C R I P C I Ó N"  ,0,1, "L");
$pdf->SetXY($x+130,$y);
$pdf->Cell(0, 4, "VALOR DOLAR"  ,0,1, "L");
$pdf->SetXY($x+155,$y);
$pdf->Cell(0, 4, "VALOR PESOS"  ,0,1, "L");


$y+=$space;
$pdf->Output ( $filename );
if( !$filename ){ //Para evitar que salga la barra de depuracion
	exit();
}


?>





