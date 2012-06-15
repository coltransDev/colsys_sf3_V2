<?
$reporte = $sf_data->getRaw("reporte");

$cliente=$reporte->getCliente();
$repotm=$reporte->getRepOtm();        
        
$stretching=100;
$spacing=1.8;
//style="font-stretch:<?=$stretching %;letter-spacing:<?=$spacing mm;"
$spacing=2;

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Coltrans');
$pdf->SetMargins(1, 1, 1,true);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetFont('helvetica', '', 10);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

$pdf->AddPage('', '',true);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example
$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

// Multicell test
//$pdf->Ln(4);
//$pdf->MultiCell(55, 5, '2012', 0, 'L', 0, 1, 10, 20);

//$txt=sprintf ("%14s",$reporte->getContacto()->getCaIdcontacto());
//$txt=sprintf ("%14s",$reporte->getContacto());
$y=20;
$x=13;
$txt="2012";
$pdf->setFontSpacing(1.9);
$pdf->MultiCell(55, 10, $txt, 0, 'L', 0, 1, $x+1, $y-8);

$x=8;
$y=$y+32;

$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt=$cliente->getCaDigito();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);


$pdf->setFontSpacing(0);
//$txt=sprintf ("%30s %30s %30s %30s","Yepes","","Sandra", "Pepita" );
$txt="";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+42, $y);

$y=$y+8;
$txt=$cliente->getCaCompania();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$pdf->setFontSpacing($spacing);

$y=$y+10;

$txt="900451936";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt="8";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);

//$pdf->MultiCell(55, 5, "2012", 1, 'L', 1, 0, '', '', true);

$pdf->setFontSpacing(0);
$txt=sprintf ("%s %85s %12s","COLOTM S.A.S.", "035-12", "" );
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+65, $y);

$y=$y+9;
$pdf->setFontSpacing($spacing);

$txt="52823309";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt="8";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);

$pdf->setFontSpacing(0);
$txt=sprintf ("%30s %30s %30s %30s","Yepes","Leon","Sandra", "Lucia" );
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+42, $y);

$proveedor=$repotm->getIdsProveedor();
$transportador=$proveedor->getIds();
if(!$transportador)
    $transportador=new Ids ();


$y=$y+8;
$pdf->setFontSpacing($spacing);
$txt=$repotm->getCaIdtransportador();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt=$transportador->getCaDv();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);
//$reporte
$pdf->setFontSpacing(0);
$txt=$transportador->getCaNombre();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+65, $y);

//garantia
$pdf->setFontSpacing(0);
$y=$y+4;

$txt="1";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+23, $y);

$txt="2";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+50, $y);

$txt="";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+80, $y);


$txt=  number_format("1133400000");
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+130, $y);


$txt=  "2013";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+180, $y);

$txt=  "05";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+190, $y);

$txt=  "22";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+200, $y);

$y=$y+9;
//datos de la operacion
$txt="X";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+54, $y);

//$reporte = new Reporte();

$txt=$repotm->getOrigenimp()->getCaCiudad();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+83, $y);

//$reporte=new Reporte();
$y=$y+9;
//$aduana = ParametroTable::retrieveByCaso("CU111", null, $reporte->getCaOrigen() );

$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $reporte->getCaOrigen() );
$adu_ori=$c->fetchOne();
if($adu_ori)
    $txt=$adu_ori->getCaIdentificacion();
else
    $txt="";


$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+10, $y);


$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $reporte->getCaDestino() );
$des_ori=$c->fetchOne();
if($des_ori)
    $txt=$des_ori->getCaIdentificacion();
else
    $txt="";

$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+30, $y);


$txt=$repotm->getCaManifiesto();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+54, $y);


$fechaArribo = explode("-",$repotm->getCaFcharribo());
$txt=$fechaArribo[0]." ".$fechaArribo[1]." ".$fechaArribo[2];
$txt=sprintf ("%4s %5s %6s",$fechaArribo[0],$fechaArribo[1],$fechaArribo[2]);
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+102, $y);


$txt=$repotm->getCaDoctransporte();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+150, $y);

$fechaArribo = explode("-",$repotm->getCaFchdoctransporte());
$txt=sprintf ("%4s %5s %6s",$fechaArribo[0],$fechaArribo[1],$fechaArribo[2]);
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+180, $y);

$y=$y+9;

$txt=$reporte->getBodega()->getCaNombre();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt=$repotm->getCaValorfob();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+150, $y);

//$ciu_ori = ParametroTable::retrieveByCaso("CU111", null, $repotm->getOrigenimp() );
/*$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $repotm->getOrigenimp() );
$ciu_ori=$c->fetchOne();
if($ciu_ori)
    $txt=$ciu_ori->getCaIdentificacion();
else
    $txt="";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+170, $y);
*/
//retrieveByCaso( $casoUso, $valor1=null, $valor2=null, $id=null ){
//$reporte->getBodega()->getCaNombre()

$y=$y+9;


$txt=$repotm->getCaContenedor();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);


$y=$y+11;


$txt=$reporte->getCaMercanciaDesc();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);






// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example.pdf', 'I');

       exit;
?>
