<?

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
$cotizacion = $sf_data->getRaw("cotizacion");
$notas = $sf_data->getRaw("notas");
$usuario = $cotizacion->getUsuario();
$contacto = $cotizacion->getContacto();
$cliente = $contacto->getCliente();
$empresa = Doctrine::getTable("Empresa")->find(1); // Localiza la empresa Colmas

$sucursal =  Doctrine::getTable("Sucursal")
        ->createQuery("s")                
        ->where("ca_nombre = ? and ca_idempresa= 1" , $usuario->getSucursal()->getcaNombre() )
        ->fetchOne();

$comodato = false;

$meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

$pdf = new PDF ( );
$pdf->Open();
$pdf->setIdempresa(1);
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
$pdf->SetSucursal($sucursal->getCaIdsucursal());

$txtSucursal=array();
$txtSucursal["datos"][]= $sucursal->getCaNombre();
$txtSucursal["datos"][]= $sucursal->getEmpresa()->getCaNombre();
$dir= explode("  ", $sucursal->getCaDireccion());

foreach($dir as $d)
    $txtSucursal["datos"][]=$d;

$txtSucursal["datos"][]="Pbx: ".$sucursal->getCaTelefono();//"Pxb : (57 - 1) 4239300";
$txtSucursal["datos"][] = "Cod. Postal: ". $sucursal->getCaCodpostal();
if($sucursal->getCaEmail()!="")
    $txtSucursal["datos"][]= $sucursal->getCaEmail();//"Email: bogota@colmas.com.co";
$txtSucursal["datos"][]= $empresa->getCaUrl();// "www.colmas.com.co";
$txtSucursal["datos"][]="NIT: ".$empresa->getCaId();// "830003960";
$txtSucursal["datos"][]="Cod. DIAN ".$empresa->getCaCoddian();

if($sucursal->getCaIso()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaIso();
if($sucursal->getCaBasc()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaBasc();
if($sucursal->getCaIata()!="")
    $txtSucursal["imagenes"][]=$sucursal->getCaIata();

$pdf->SetFooterSucursal($txtSucursal);
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
        ->leftJoin("c.ConceptoAduana a ON c.ca_idcosto = a.ca_idconcepto")
        ->addOrderBy("c.ca_transporte, a.ca_consecutivo")
        ->execute();

$imprimirObservaciones = false;

foreach ($aduanas as $aduana) {
    if (trim($aduana->getCaObservaciones()) != "") {
        $imprimirObservaciones[$aduana->getCosto()->getCaTransporte()] = true;
    }
}

if (count($aduanas) > 0) {

    $imprimirNotas[] = "aduanaImpo";

    $pdf->Ln(4);
    $pdf->SetFont($font, 'B', 9);
    $pdf->Cell(0, 4, 'COSTOS DE NACIONALIZACION', 0, 1, 'L', 0);
    $pdf->SetFont($font, '', 9);
    $i = 1;
    $linea = "";
    $vigencia = array();

    foreach ($aduanas as $aduana) {
        $pdf->beginGroup();
        if ($linea != $aduana->getCosto()->getCaTransporte()){
            //Control impresión
            if ($aduana->getCosto()->getCaTransporte() == Constantes::MARITIMO) {
                $nacionalizacion = "Nacionalización en Puerto";
            } else if ($aduana->getCosto()->getCaTransporte() == Constantes::AEREO) {
                $nacionalizacion = "Nacionalización Aéreo/OTM";
            }
            $pdf->Ln(2);
            $pdf->SetFont($font, '', 9);
            $pdf->Cell(0, 4, $nacionalizacion, 0, 1, 'L', 0);
            $pdf->Ln(3);
            $pdf->SetFont($font, '', 7);

            $titu_mem = array('Concepto', 'Valor');
            if ($imprimirObservaciones[$aduana->getCosto()->getCaTransporte()]) {
                array_push($titu_mem, 'Observaciones');
                $width_mem = array(35, 65, 70); // = 170
            } else {
                $width_mem = array(40, 130);  // = 170
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
		
        $valor = "";
        if ($aduana->getCaValor() > 0 and $aduana->getCaValor() < 1) {
                $valor.= Utils::formatNumber($aduana->getCaValor())." %";
        }else if ($aduana->getCaValor() >= 1) {
                $valor.= "$ ".Utils::formatNumber($aduana->getCaValor());
        }
        if ($aduana->getCaAplicacion()){
                $valor.= " " . $aduana->getCaAplicacion();
        }
        if ($aduana->getCaValorminimo()){
            $valor.= " Mínimo :";
            if ($aduana->getCaValorminimo() > 0 and $aduana->getCaValorminimo() < 1) {
                    $valor.= Utils::formatNumber($aduana->getCaValorminimo())." %";
            }else if ($aduana->getCaValorminimo() >= 1) {
                    $valor.= "$ ".Utils::formatNumber($aduana->getCaValorminimo());
            }
            if ($aduana->getCaAplicacionminimo()){
                    $valor.= " " . $aduana->getCaAplicacionminimo();
            }
        }
		
        $row = array(
            $aduana->getCosto()->getCaCosto(),
            $valor
        );
        if ($imprimirObservaciones) {
            array_push($row, $aduana->getCaObservaciones());
        }
        $pdf->Row($row);
        $pdf->flushGroup();
    }
}

// ========================== Notas Importantes ========================== //
$pdf->beginGroup();
$pdf->SetFont($font, 'B', 8);
$pdf->Ln(3);
$pdf->MultiCell(0, 4, "Nota Importante: Favor  entregar  póliza  de  seguro de  transporte   indicando  tasa  (porcentaje  liquidado)  por  exigencia  de  la  DIAN.", 0, 'J', 0);
$pdf->Ln(2);
$pdf->flushGroup();


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
$pdf->MultiCell(0, 4, "Tel.:" . $sucursal->getCaTelefono() . " Ext.:" . $usuario->getCaExtension(), 0, 1);
$pdf->MultiCell(0, 4, "Cod. Postal :" . $sucursal->getCaCodpostal(), 0, 1);

$pdf->MultiCell(0, 4, $sucursal->getCaNombre() . " - " . $empresa->getTrafico()->getCaNombre(), 0, 1);
$pdf->MultiCell(0, 4, $usuario->getCaEmail(), 0, 1);
$pdf->MultiCell(0, 4, $empresa->getCaUrl(), 0, 1);

if ($cotizacion->getCaAnexos() != '' && $empresa->getCaIdempresa() == 1) {
    $pdf->Ln(6);
    $pdf->MultiCell(0, 4, "Anexo: " . $cotizacion->getCaAnexos(), 0, 1);
}
$pdf->flushGroup();

// ======================== Notas ======================== //
//if( $empresa->getCaIdempresa()==2 ){
//if( $empresa->getCaIdempresa() )
//if( $empresa->getCaIdempresa()==2 || $empresa->getCaIdempresa()==1 ) {
$imprimirNotas = array_unique($imprimirNotas);

$nuevaPagina = false;

foreach ($imprimirNotas as $val) {
    if (!$nuevaPagina) {
        $pdf->AddPage();
        $nuevaPagina = true;
    }

    //Hace que el titulo tenga por lo menos 2 renglones
    if ($pdf->GetY() > $pdf->PageBreakTrigger - 15) {
        $pdf->AddPage();
    } else {
        $pdf->Ln(2);
    }

    $pdf->SetFont($font, 'B', 9);
    $pdf->MultiCell(0, 4, $notas[$val . "Titulo"], 0, 'C', 0);
    $pdf->Ln(1);
    $pdf->SetFont($font, '', 8);
    $pdf->MultiCell(0, 4, $notas[$val], 0, 'J', 0);
}

$pdf->Output($filename);

if (!$filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>
