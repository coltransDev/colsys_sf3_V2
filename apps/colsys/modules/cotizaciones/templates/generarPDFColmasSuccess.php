<?

$cotizacion = $sf_data->getRaw("cotizacion");
$notas = $sf_data->getRaw("notas");
$usuario = $cotizacion->getUsuario();
$contacto = $cotizacion->getContacto();
$cliente = $contacto->getCliente();
$empresa = Doctrine::getTable("Empresa")->find(1); // Localiza la empresa Colmas

$comodato = false;

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

$pdf = new PDF ( );
$pdf->Open();
$pdf->setIdempresa($empresa->getCaIdempresa());
$pdf->setColmasHeader(true);
$pdf->setColmasFooter(true);
$pdf->AliasNbPages();
$pdf->SetTopMargin(14);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
$pdf->SetAutoPageBreak(true, 28);
$pdf->AddPage();
$pdf->SetHeight(4);

switch ($cotizacion->getCaFuente()) {
    case "Arial":
        $font = 'Arial';
        break;
    case "Calibri":
        $pdf->AddFont('Calibri', '', 'calibri.php');
        $pdf->AddFont('Calibri', 'B', 'calibrib.php');
        $font = 'Calibri';
        break;
    default:
        $pdf->AddFont('Tahoma', '', 'tahoma.php');
        $pdf->AddFont('Tahoma', 'B', 'tahomab.php');
        $font = 'Tahoma';
        break;
}

$pdf->SetFont($font, '', 10);
$imprimirNotas = array();
$sucursal = $usuario->getSucursal();
$pdf->SetSucursal($sucursal->getCaIdsucursal());
//$pdf->SetLineRepeat("Señores: ".strtoupper($cliente->getCaCompania()."    ".$cotizacion->getCaFchcreado()));
$pdf->Ln(5);
list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf($cotizacion->getCaFchcreado(), "%d-%d-%d %d:%d:%d");

$pdf->Cell(0, 4, str_replace(' D.C.', '', $sucursal->getCaNombre()) . ', ' . $dia . ' de ' . $meses[$mes - 1] . ' de ' . $anno, 0, 1);

$pdf->Ln(8);
$pdf->Cell(0, 4, $contacto->getCaSaludo(), 0, 1);
$pdf->SetFont($font, '', 10);

$pdf->Cell(0, 4, strtoupper($contacto->getNombre()), 0, 1);
$cargo = null;
if ($contacto->getCaCargo() != '' and $contacto->getCaDepartamento() != '') {
    $cargo = $contacto->getCaCargo() . " - " . $contacto->getCaDepartamento();
} else if ($contacto->getCaCargo() != '' and $contacto->getCaDepartamento() == '') {
    $cargo = $contacto->getCaCargo();
} else if ($contacto->getCaCargo() == '' and $contacto->getCaDepartamento() != '') {
    $cargo = $contacto->getCaDepartamento();
}
if ($cargo != '') {
    $pdf->SetFont($font, '', 10);
    $pdf->Cell(0, 4, $cargo, 0, 1);
}

$pdf->SetFont($font, 'B', 10);
$pdf->Cell(0, 4, strtoupper($cliente->getCaCompania()), 0, 1);
$pdf->SetFont($font, '', 10);
$pdf->Cell(0, 4, strtoupper($cliente->getCiudad()->getCaCiudad()), 0, 1);

if ($cotizacion->getCaUsuanulado()) {
    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont($font, 'B', 68);
    $pdf->Write(5, 'A N U L A D O ');
    $pdf->SetTextColor(0, 0, 0);
}
$pdf->SetFont($font, '', 10);
$pdf->Ln(8);
$pdf->Cell(0, 4, 'Asunto : ' . $cotizacion->getCaAsunto() . " " . $cotizacion->getCaConsecutivo() . " (V-" . $cotizacion->getCaVersion() . ")", 0, 1);
//    $pdf->Cell(0, 0, 'Comunicación No. '.$rs->Value('ca_idcotizacion').'/'.$rs->Value('ca_usuario').str_pad(" ",7),0,0,'R');

$pdf->SetFont($font, '', 10);
$pdf->Ln(4);
$pdf->Cell(0, 4, $cotizacion->getCaSaludo(), 0, 1);
$pdf->Ln(2);
$pdf->MultiCell(0, 4, $cotizacion->getCaEntrada(), 0, 1);


// ======================== Aduanas ======================== //
// $aduanas = $cotizacion->getCotAduana();

$aduanas = Doctrine::getTable("CotAduana")
        ->createQuery("ca")
        ->where("ca.ca_idcotizacion = ?", $cotizacion->getCaIdcotizacion())
        ->innerJoin("ca.Costo c")
        ->addOrderBy("c.ca_impoexpo, c.ca_costo")
        ->execute();


$imprimirObservaciones = false;

foreach ($aduanas as $aduana) {
    if ($aduana->getCaObservaciones()) {
        $imprimirObservaciones[$aduana->getCosto()->getCaTransporte()] = true;
        break;
    }
}

if (count($aduanas) > 0) {

    $imprimirNotas[] = "aduana";
    //Control impresión
    $pdf->beginGroup();

    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 9);
    $pdf->Cell(0, 4, 'COSTOS DE NACIONALIZACION', 0, 1, 'L', 0);
    $pdf->SetFont($font, '', 9);
    $i = 1;
    $linea = "";

    foreach ($aduanas as $aduana) {
        if ($linea != $aduana->getCosto()->getCaTransporte()){
            if ($aduana->getCosto()->getCaTransporte() == Constantes::MARITIMO) {
                $nacionalizacion = "Nacionalización en Puerto";
            } else if ($aduana->getCosto()->getCaTransporte() == Constantes::AEREO) {
                $nacionalizacion = "Nacionalización Aéreo/OTM";
            }
            $pdf->Ln(4);
            $pdf->SetFont($font, '', 9);
            $pdf->Cell(0, 4, $nacionalizacion, 0, 1, 'L', 0);
            $pdf->Ln(2);
            $pdf->SetFont($font, '', 7);

            $titu_mem = array('Concepto', 'Valor', 'Mínima', 'Vigencia');
            if ($imprimirObservaciones[$aduana->getCosto()->getCaTransporte()]) {
                array_push($titu_mem, 'Observaciones');
                $width_mem = array(30, 35, 35, 35, 35); // = 170
            } else {
                $width_mem = array(50, 40, 40, 40);  // = 170
            }
            $pdf->SetWidths($width_mem);
            $pdf->SetAligns(array_fill(0, count($width_mem), "C"));
            $pdf->SetStyles(array_fill(0, count($width_mem), "B"));
            $pdf->SetFills(array_fill(0, count($width_mem), 1));
            $pdf->Row($titu_mem);
            $linea = $aduana->getCosto()->getCaTransporte();
        }
        $pdf->SetAligns(array_fill(0, count($width_mem), "L"));
        $pdf->SetStyles(array_fill(0, count($width_mem), ""));
        $pdf->SetFills(array_fill(0, count($width_mem), 0));
        $row = array(
            $aduana->getCosto()->getCaCosto(),
            ($aduana->getCaValor() != 0) ? ($aduana->getCaValor() . (($aduana->getCaAplicacion()) ? "\n" . $aduana->getCaAplicacion() : "")) : "",
            ($aduana->getCaValorminimo() != 0) ? ($aduana->getCaValorminimo() . (($aduana->getCaAplicacionminimo()) ? "\n" . $aduana->getCaAplicacionminimo() : "")) : "",
            ($aduana->getCaFchini() != "" || $aduana->getCaFchfin() != "") ? $aduana->getCaFchini() . " Hasta " . $aduana->getCaFchfin() : ""
        );
        if ($imprimirObservaciones) {
            array_push($row, $aduana->getCaObservaciones());
        }
        $pdf->Row($row);
    }
    $pdf->flushGroup();
}

$pdf->SetFont($font, '', 10);
//Hace que el titulo tenga por lo menos 2 renglones
if ($pdf->GetY() > $pdf->PageBreakTrigger - 15) {
    $pdf->AddPage();
} else {
    $pdf->Ln(4);
}
$pdf->MultiCell(0, 4, $cotizacion->getCaDespedida(), 0, 1);

$pdf->beginGroup();
$pdf->Ln(4);
$pdf->MultiCell(0, 4, 'Cordialmente,', 0, 1);


$pdf->Ln(10);
$pdf->SetFont($font, 'B', 10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaNombre()), 0, 1);
$pdf->SetFont($font, '', 10);
$pdf->MultiCell(0, 4, strtoupper($usuario->getCaCargo()), 0, 1);
$pdf->MultiCell(0, 4, strtoupper($empresa->getCaNombre()), 0, 1);
$pdf->MultiCell(0, 4, $sucursal->getCaDireccion(), 0, 1);
$pdf->MultiCell(0, 4, "Tel.:" . $sucursal->getCaTelefono() . " " . $usuario->getCaExtension(), 0, 1);
$pdf->MultiCell(0, 4, "Fax :" . $sucursal->getCaFax(), 0, 1);

$pdf->MultiCell(0, 4, $sucursal->getCaNombre() . " - " . $empresa->getTrafico()->getCaNombre(), 0, 1);
$pdf->MultiCell(0, 4, $usuario->getCaEmail(), 0, 1);
$pdf->MultiCell(0, 4, $empresa->getCaUrl(), 0, 1);

if ($cotizacion->getCaAnexos() != '' && $empresa->getCaIdempresa() == 1) {
    $pdf->Ln(6);
    $pdf->MultiCell(0, 4, "Anexo: " . $cotizacion->getCaAnexos(), 0, 1);
}
$pdf->flushGroup();

$pdf->Output($filename);

if (!$filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>
