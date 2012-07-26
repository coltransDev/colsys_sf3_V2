<?
$reporte = $sf_data->getRaw("reporte");

$cliente=$reporte->getCliente("continuacion");
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
//$y=20;
$y=46;
$x=8;
$txt="2012";
$pdf->setFontSpacing(1.9);
$pdf->MultiCell(55, 10, $txt, 0, 'L', 0, 1, $x+1, $y-8);


$x=4;
/*$y=$y+16;
//casillas 5 - 6
$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt=$cliente->getCaDigito();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);


$y=$y+8;
//casillas 11
$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

*/


//$y=$y+8;
$y=$y+29;

$txt=$cliente->getCaIdalterno();//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt=$cliente->getCaDigito();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);

$pdf->setFontSpacing(0);
//$txt=sprintf ("%30s %30s %30s %30s","Yepes","","Sandra", "Pepita" );
$txt="";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+42, $y);

$y=$y+8;
$txt=utf8_encode($cliente->getCaCompania());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$pdf->setFontSpacing($spacing);

$y=$y+10;

$txt="900451936";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt="8";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);

//$pdf->MultiCell(55, 5, "2012", 1, 'L', 1, 0, '', '', true);

$pdf->setFontSpacing(0);
$txt=sprintf ("%s %85s %12s","COL OTM S.A.S.", "035-12", "645" );
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+65, $y);

$y=$y+9;
$pdf->setFontSpacing($spacing);

$representante["cedula"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"73569889":"1111746520";
$representante["nombre1"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"Carlos":"Felix";
$representante["nombre2"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"Alfonso":"Andres";
$representante["apellido1"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?utf8_encode("Bolaño"):"Reyes";
$representante["apellido2"]=($reporte->getOrigen()->getCaCiudad()=="Cartagena")?"Melendez":"";

$txt=$representante["cedula"];//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt="";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);

$pdf->setFontSpacing(0);
$txt=sprintf ("%30s %30s %30s %30s",$representante["apellido1"],$representante["apellido2"],$representante["nombre1"],$representante["nombre2"] );
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+42, $y);

$proveedor=$repotm->getIdsProveedor();
$transportador=$proveedor->getIds();
if(!$transportador)
    $transportador=new Ids ();


$y=$y+8;
$pdf->setFontSpacing($spacing);
$txt=$repotm->getIdsProveedor()->getIds()->getCaIdalterno();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt=$transportador->getCaDv();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+56, $y);
//$reporte
$pdf->setFontSpacing(0);
$txt=$transportador->getCaNombre();
//$txt="INTERANDINA DE TRANSPORTES S.A. INANTRA";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+65, $y);

switch($repotm->getIdsProveedor()->getIds()->getCaIdalterno())
{
    case "890904488"://TDM TRANSPORTE S.A.
        $txt="053";
        break;
    case "800238072":
        $txt="314";
        break;
    case "860016819"://PROVEEDOR Y SERCARGA S.A
        $txt="051";
        break;
    default:
        $txt="146";
}

//$txt="146";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+193, $y);

//garantia
$pdf->setFontSpacing(0);
$y=$y+4;

$txt="1";//sprintf ("%s %13s ",$cliente->getCaIdalterno(),$cliente->getCaDigito());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+23, $y);

$txt="2";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+50, $y);

$txt="31 DL 011 420";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+80, $y);

//casilla 42
$txt=  number_format("1133400000");
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+130, $y);

//casilla 48
$txt=  "2013";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+180, $y);

$txt=  "05";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+190, $y);

$txt=  "22";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+200, $y);

$y=$y+9;
//datos de la operacion
//casilla 44
$txt="X";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+20, $y);
//casilla 46
$txt="X";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+50, $y);

//$reporte = new Reporte();

$txt=$repotm->getOrigenimp()->getCaCiudad();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+83, $y);

//$reporte=new Reporte();
$y=$y+9;
//$aduana = ParametroTable::retrieveByCaso("CU111", null, $reporte->getCaOrigen() );

//casilla 50
$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $reporte->getCaOrigen() );
$adu_ori=$c->fetchOne();
if($adu_ori)
    $txt=$adu_ori->getCaIdentificacion();
else
    $txt="";


$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+10, $y);

//casilla 51
$c = ParametroTable::retrieveQueryByCaso( "CU111", null, $reporte->getCaDestino() );
$des_ori=$c->fetchOne();
if($des_ori)
    $txt=$des_ori->getCaIdentificacion();
else
    $txt="";

$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+30, $y);

//casilla 52
$txt=$repotm->getCaManifiesto();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+54, $y);

//casilla 53
$fechaArribo = explode("-",$repotm->getCaFcharribo());
$txt=$fechaArribo[0]." ".$fechaArribo[1]." ".$fechaArribo[2];
$txt=sprintf ("%4s %5s %6s",$fechaArribo[0],$fechaArribo[1],$fechaArribo[2]);
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+102, $y);

//casilla 54
$txt=$repotm->getCaHbls();
$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+145, $y);
$pdf->SetFont('helvetica', '', 10);
//casilla 55
$fechaArribo = explode("-",$repotm->getCaFchdoctransporte());
$txt=sprintf ("%4s %5s %6s",$fechaArribo[0],$fechaArribo[1],$fechaArribo[2]);
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+180, $y);


//casilla 55
$txt1=utf8_encode($reporte->getBodega()->getCaNombre()."/".$reporte->getBodega()->getCaTipo());
$tam=  strlen($txt1);
if($tam>75)
{
    $y=$y+5;
    $txt=  substr($txt1, 0,75)."\n".substr($txt1, 75,$tam-75);
    $pdf->SetFont('helvetica', '', 8);
}else
{
    $y=$y+9;
    $txt=$txt1;
}

$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);
$pdf->SetFont('helvetica', '', 10);
/*if($reporte->getBodega()->getCaTipo()=="Zona Franca Bogota SA")
    $txt="13907";
else
    $txt="";
*/
$txt=$reporte->getBodega()->getCaCodDian();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+130, $y);

//casilla 58
$txt=$repotm->getCaValorfob();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+150, $y);



//casilla 59
$txt=$repotm->getOrigenimp()->getTrafico()->getCaCodDian();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+178, $y);

//casilla 60
$txt=$repotm->getCaNumpiezas();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+190, $y);


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

if($reporte->getCaModalidad()=="LCL")
    $txt="CARGA SUELTA";
else
    $txt=$repotm->getCaContenedor();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);

$txt="S";
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+54, $y);


$txt=$repotm->getCaPeso();
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x+150, $y);


$y=$y+11;

if($reporte->getCaModalidad()=="LCL")
    $txt1="LCL/LCL";
else
    $txt1="FCL/FCL";

$txt=  utf8_encode($txt1."\nDice Contener:\n".utf8_encode($reporte->getCaMercanciaDesc())." \nDTM:".$repotm->getConsecutivoDtm());
$pdf->MultiCell(500, 10, $txt, 0, 'L', 0, 1, $x, $y);






// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example.pdf', 'I');

       exit;
?>
