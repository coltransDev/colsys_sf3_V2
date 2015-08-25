<?
$proveedor = $sf_data->getRaw("proveedor");
$sucursalProv = $sf_data->getRaw("sucursalProv");
$textos = $sf_data->getRaw("textos");

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

$pdf = new PDF ( );
$pdf->Open();
$pdf->setIdempresa(2);
$pdf->setColtransHeader(true);
$pdf->setColtransFooter(true);
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);

$pdf->AddFont('Tahoma', '', 'tahoma.php');
$pdf->AddFont('Tahoma', 'B', 'tahomab.php');
$font = 'Tahoma';

$pdf->SetFont($font, '', 10);

//Define la sucursal de la plantilla
$pdf->SetSucursal($sucursal->getCaIdsucursal());

// Define el pie de página de la plantilla
$txtSucursal=array();
$txtSucursal["datos"][]= $sucursal->getCaNombre();
$dir= explode("  ", $sucursal->getCaDireccion());
foreach($dir as $d)
    $txtSucursal["datos"][]=$d;
$txtSucursal["datos"][]="Pbx: ".$sucursal->getCaTelefono();//"Pxb : (57 - 1) 4239300";
$txtSucursal["datos"][]="Fax: ".$sucursal->getCaFax();//"Pxb : (57 - 1) 4239300";
$txtSucursal["datos"][] = "Cod. Postal: ". $sucursal->getCaCodpostal();
if($sucursal->getCaEmail()!="")
    $txtSucursal["datos"][]= $sucursal->getCaEmail();//"Email: bogota@coltrans.com.co";
$txtSucursal["datos"][]=$empresa->getCaUrl();// "www.coltrans.com.co";
$txtSucursal["datos"][]="NIT: ".$empresa->getCaId();// "800024075";
$txtSucursal["datos"][]="Cod. DIAN ".$empresa->getCaCoddian();

if($sucursal->getCaIso()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaIso();
if($sucursal->getCaBasc()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaBasc();
if($sucursal->getCaIata()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaIata();


$pdf->SetFooterSucursal($txtSucursal);
$pdf->Ln(5);

//Encabezado del documento
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date('Y-m-d'), "%d-%d-%d %d:%d:%d");
$pdf->Cell(0, 4, str_replace(' D.C.', '', $sucursal->getCaNombre()) . ', ' . $dia . ' de ' . $meses[$mes - 1] . ' de ' . $anno, 0, 1);

$pdf->Ln(8);
$pdf->Cell(0, 4, "Señores", 0, 1);
$pdf->SetFont($font, 'B', 10);
$pdf->Cell(0, 4, strtoupper($proveedor->getIds()->getCaNombre()), 0, 1);
$pdf->SetFont($font, '', 10);
$pdf->Cell(0, 4, $sucursalProv->getCaDireccion(), 0, 1);
$pdf->Cell(0, 4, "Tel.:".$sucursalProv->getCaTelefonos(), 0, 1);
$pdf->SetFont($font, 'B', 10);

if($contactos){
    if(count($contactos)==1)
        foreach($contactos as $contacto)
            $pdf->Cell(0, 4, "Atn.:".$contacto["nombre"], 0, 1);        
    else{
        $pdf->Cell(0, 4, "Atn.:",0,1);
        foreach($contactos as $contacto){
            $pdf->Cell(2);
            $pdf->Cell(0, 4, $contacto["nombre"], 0, 1);
        }
    }
}
$pdf->SetFont($font, '', 10);
$pdf->Cell(0, 4, $sucursalProv->getCiudad()->getCaCiudad(), 0, 1);
$pdf->Ln(8);

$pdf->SetFont($font, 'B', 10);
$pdf->Cell(0, 4, "Ref.: Evaluación de Proveedores");
$pdf->Ln(10);

//Cuerpo del documento
$pdf->SetFont($font, '', 10);
$pdf->Cell(0, 4, $textos['saludoComunicado'], 0, 1);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, $textos['entradaComunicado'], 0, 'J', 0);
$pdf->Ln(10);

//Datos de la evaluación

$pdf->SetWidths ( array (180 ) );
$pdf->SetAligns ( array ("C" ) );
$pdf->SetStyles ( array ("B" ) );
$pdf->Row ( array ('EVALUACION '.$ano.' - PERIODO '. $periodo ) );

$pdf->SetFont($font, '', 8);
$pdf->SetWidths ( array (75, 25, 30, 50) );
$pdf->SetAligns ( array ("C", "C", "C", "C") );
$pdf->SetStyles ( array ("B", "B", "B", "B" ) );
$pdf->SetFills ( array (1, 1, 1, 1) );
$pdf->Row ( array ("CRITERIO","PONDERACIÓN","CALIFICACIÓN","OBSERVACIONES"));

foreach($evaluaciones as $evaluacion){
    $pdf->SetFont($font, '', 8);
    $pdf->SetWidths ( array (180 ) );
    $pdf->SetAligns ( array ("C" ) );
    $pdf->SetStyles ( array ("B" ) );
    $pdf->SetFills ( array (1) );        
    if($evaluacion->getCaTipo()=="desempeno_impo")        
        $pdf->Row ( array ('IMPORTACIÓN' ));
    else if($evaluacion->getCaTipo()=="desempeno_expo")
        $pdf->Row ( array ('EXPORTACIÓN'));    
    
    $evaluacionesxCriterio = $evaluacion->getIdsEvaluacionxCriterio();
        
    foreach($evaluacionesxCriterio as $criterio){        
        
        $pdf->SetWidths ( array (75, 25, 30, 50) );
        $pdf->SetAligns ( array ("L", "R", "R", "L") );
        $pdf->SetStyles ( array ("", "", "", "" ) );
        $pdf->SetFills ( array (0, 0, 0, 0) );        
        $pdf->Row ( array ($criterio->getIdsCriterio()->getCaCriterio(),$criterio->getCaPonderacion()."%",$criterio->getCaValor(),$criterio->getCaObservaciones()));
        
        $sumaP+=$criterio->getCaPonderacion();
        $sumaV+=$criterio->getCaValor();
        $i+=1;
    }
    $pdf->SetX("70");
    $y = $pdf->GetY();
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetFont($font, 'B', 10);
    $pdf->Cell(0, 6,"RESULTADO", 0, 1);
    
    $pdf->SetXY("105",$y);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetFont($font, 'B', 10);
    $pdf->Cell(0, 6,$sumaP."%", 0, 1);
    
    $resultado = round(($sumaV/$i),2);
    $pdf->SetXY("140",$y);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetFont($font, 'B', 10);
    $pdf->Cell(0, 6,$resultado, 0, 1);
    
    if($resultado <= 7.5)
        $incumple+=1;
    
    $sumaP = 0;
    $sumaV = 0;
    $i=0;
}

if($incumple>=1){
    $pdf->SetTextColor(0);
    $pdf->Ln(5);
    $pdf->SetFont($font, '', 10);
    $pdf->MultiCell(0, 4, $textos['final_incumple'], 0, 'J', 0);
    $pdf->Ln(2);
}else{
    $pdf->SetTextColor(0);
    $pdf->Ln(5);
    $pdf->SetFont($font, '', 10);
    $pdf->MultiCell(0, 4, $textos['final_cumple'], 0, 'J', 0);
    $pdf->Ln(2); 
}
    

$pdf->SetTextColor(0);
$pdf->Ln(5);
$pdf->SetFont($font, '', 10);
$pdf->MultiCell(0, 4, $textos['salidaComunicado'], 0, 'J', 0);
$pdf->Ln(2);

$pdf->Output($filename);

if (!$filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>