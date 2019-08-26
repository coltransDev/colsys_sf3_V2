<?php

/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

function num2letras($num, $fem = true, $dec = true) {

    $num = (int) $num;
    $matuni[2] = "dos";
    $matuni[3] = "tres";
    $matuni[4] = "cuatro";
    $matuni[5] = "cinco";
    $matuni[6] = "seis";
    $matuni[7] = "siete";
    $matuni[8] = "ocho";
    $matuni[9] = "nueve";
    $matuni[10] = "diez";
    $matuni[11] = "once";
    $matuni[12] = "doce";
    $matuni[13] = "trece";
    $matuni[14] = "catorce";
    $matuni[15] = "quince";
    $matuni[16] = "dieciseis";
    $matuni[17] = "diecisiete";
    $matuni[18] = "dieciocho";
    $matuni[19] = "diecinueve";
    $matuni[20] = "veinte";
    $matunisub[2] = "dos";
    $matunisub[3] = "tres";
    $matunisub[4] = "cuatro";
    $matunisub[5] = "quin";
    $matunisub[6] = "seis";
    $matunisub[7] = "sete";
    $matunisub[8] = "ocho";
    $matunisub[9] = "nove";

    $matdec[2] = "veint";
    $matdec[3] = "treinta";
    $matdec[4] = "cuarenta";
    $matdec[5] = "cincuenta";
    $matdec[6] = "sesenta";
    $matdec[7] = "setenta";
    $matdec[8] = "ochenta";
    $matdec[9] = "noventa";
    $matsub[3] = 'mill';
    $matsub[5] = 'bill';
    $matsub[7] = 'mill';
    $matsub[9] = 'trill';
    $matsub[11] = 'mill';
    $matsub[13] = 'bill';
    $matsub[15] = 'mill';
    $matmil[4] = 'millones';
    $matmil[6] = 'billones';
    $matmil[7] = 'de billones';
    $matmil[8] = 'millones de billones';
    $matmil[10] = 'trillones';
    $matmil[11] = 'de trillones';
    $matmil[12] = 'millones de trillones';
    $matmil[13] = 'de trillones';
    $matmil[14] = 'billones de trillones';
    $matmil[15] = 'de billones de trillones';
    $matmil[16] = 'millones de billones de trillones';

    $num = trim((string) @$num);
    if ($num[0] == '-') {
        $neg = 'menos ';
        $num = substr($num, 1);
    } else
        $neg = '';
    while ($num[0] == '0')
        $num = substr($num, 1);
    if ($num[0] < '1' or $num[0] > 9)
        $num = '0' . $num;
    $zeros = true;
    $punt = false;
    $ent = '';
    $fra = '';
    for ($c = 0; $c < strlen($num); $c++) {
        $n = $num[$c];
        if (!(strpos(".,'''", $n) === false)) {
            if ($punt)
                break;
            else {
                $punt = true;
                continue;
            }
        } elseif (!(strpos('0123456789', $n) === false)) {
            if ($punt) {
                if ($n != '0')
                    $zeros = false;
                $fra .= $n;
            } else
                $ent .= $n;
        } else
            break;
    }
    $ent = '     ' . $ent;
    if ($dec and $fra and ! $zeros) {
        $fin = ' coma';
        for ($n = 0; $n < strlen($fra); $n++) {
            if (($s = $fra[$n]) == '0')
                $fin .= ' cero';
            elseif ($s == '1')
                $fin .= $fem ? ' una' : ' un';
            else
                $fin .= ' ' . $matuni[$s];
        }
    } else
        $fin = '';
    if ((int) $ent === 0)
        return 'Cero ' . $fin;
    $tex = '';
    $sub = 0;
    $mils = 0;
    $neutro = false;
    while (($num = substr($ent, -3)) != '   ') {
        $ent = substr($ent, 0, -3);
        if (++$sub < 3 and $fem) {
            $matuni[1] = 'una';
            $subcent = 'as';
        } else {
            $matuni[1] = $neutro ? 'un' : 'uno';
            $subcent = 'os';
        }
        $t = '';
        $n2 = substr($num, 1);
        if ($n2 == '00') {
            
        } elseif ($n2 < 21)
            $t = ' ' . $matuni[(int) $n2];
        elseif ($n2 < 30) {
            $n3 = $num[2];
            if ($n3 != 0)
                $t = 'i' . $matuni[$n3];
            $n2 = $num[1];
            $t = ' ' . $matdec[$n2] . $t;
        }else {
            $n3 = $num[2];
            if ($n3 != 0)
                $t = ' y ' . $matuni[$n3];
            $n2 = $num[1];
            $t = ' ' . $matdec[$n2] . $t;
        }
        $n = $num[0];
        if ($n == 1) {
            $t = ' ciento' . $t;
        } elseif ($n == 5) {
            $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
        } elseif ($n != 0) {
            $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
        }
        if ($sub == 1) {
            
        } elseif (!isset($matsub[$sub])) {
            if ($num == 1) {
                $t = ' mil';
            } elseif ($num > 1) {
                $t .= ' mil';
            }
        } elseif ($num == 1) {
            $t .= ' ' . $matsub[$sub] . 'ón';
        } elseif ($num > 1) {
            $t .= ' ' . $matsub[$sub] . 'ones';
        }
        if ($num == '000')
            $mils ++;
        elseif ($mils != 0) {
            if (isset($matmil[$sub]))
                $t .= ' ' . $matmil[$sub];
            $mils = 0;
        }
        $neutro = true;
        $tex = $t . $tex;
    }
    $tex = $neg . substr($tex, 1) . $fin;
    return ucfirst($tex);
}

$pdf = new PDF ( );
$pdf->Open();
$pdf->setColtransHeader(false);
$pdf->setColtransFooter(false);
$pdf->setIdempresa(8);
$pdf->AliasNbPages();
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(12);
//$pdf->SetAutoPageBreak(true, 27);


$comprobantes = $sf_data->getRaw("comprobantes");
$transacciones = $sf_data->getRaw("transacciones");




foreach ($comprobantes as $comprobante) {
    $tipo = $comprobante->getInoTipoComprobante();
    $sucursal = $tipo->getSucursal();
    $ids = $sucursal->getEmpresa()->getIds();

    $inoCliente = $comprobante->getInoHouse();
    $inoMaestra = $inoCliente->getInoMaster();
    $regContributivo = $comprobante->getIds()->getIdsCliente()->getProperty('regimen_contributivo');


    $pdf->AddPage();
    $pdf->SetHeight(4);


    $x = $pdf->GetX();
    $y = $pdf->GetY();

    if ($comprobante->getCaEstado() == 0) {

        $pdf->SetTextColor(224, 224, 224);
        $pdf->SetFont("Arial", 'B', 85);
        $pdf->Rotate(45, 250, 90);
        $pdf->Write(15, 'BORRADOR');
        $pdf->Rotate(0);
        $pdf->SetTextColor(0, 0, 0);
    } else if ($comprobante->getCaEstado() == 8) {
        $pdf->SetTextColor(224, 224, 224);
        $pdf->SetFont("Arial", 'B', 85);
        $pdf->Rotate(45, 250, 90);
        $pdf->Write(15, 'ANULADO');
        $pdf->Rotate(0);
        $pdf->SetTextColor(0, 0, 0);
    }


    $font = 'Courier';

    $pdf->SetFont($font, '', 6);


    $pdf->SetX($x);
    $pdf->SetY($y);



    $marginHeader = 120;
    $space = 2;


    


    //$pdf->SetXY($x + $marginHeader, $y);
    

    $dir = explode("  ", $sucursal->getCaDireccion());

    foreach ($dir as $d) {
        $y+=$space;
        $pdf->SetXY($x + $marginHeader, $y);
        //$pdf->Cell(0, 4, $d, 0, 1, "L");
    }

    

    $y+=$space;
    //$pdf->SetXY($x + $marginHeader, $y);
    //$pdf->Cell(0, 4, $sucursal->getCaNombre() . ", " . $sucursal->getEmpresa()->getTrafico()->getCaNombre(), 0, 1, "L");


    

    $y+=12;
    $y+=5;
    $pdf->SetXY($x + $marginHeader-20, $y);
    $pdf->Cell(0, 4, strtoupper($tipo->getCaTitulo()) . " " , 0, 1, "L");
    $pdf->SetXY($x + $marginHeader, $y);
    $pdf->Cell(0, 4, $comprobante->getCaConsecutivo(), 0, 1, "C");

    $pdf->Image(sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $sucursal->getEmpresa()->getCaLogo(), 18, 12, 70, 15, 'JPG');

    $pdf->SetXY($x + 5, $y);
    $pdf->Cell(0, 4, $sucursal->getEmpresa()->getCaNombre(), 0, 1, "L");
    $pdf->SetXY($x + 60, $y);
    $pdf->Cell(0, 4, "Nit. " . Utils::formatNumber($ids->getCaIdalterno(), 0, "", ".") . "-" . $ids->getCaDv(), 0, 1, "L");
    $y+=$space;
    
    $y+=5;
    //$y+=12;


    //$pdf->Rect($x, $y, 175, 17);
    $pdf->line($x, $y , $x, $y + 20);
    $pdf->line($x+175, $y , $x+175, $y + 20);
    $pdf->line($x, $y , $x+175, $y );
    
    
    $pdf->line($x, $y + 10, $x + 175, $y + 10);
    $pdf->line($x + 130, $y + 10, $x + 130, $y + 20);

    $pdf->SetXY($x + 5, $y);
    $pdf->Cell(0, 4, "RECIBIMOS DE: " . $comprobante->getIds()->getCaNombre(), 0, 1, "L");

    $pdf->SetXY($x + 90, $y);
    $pdf->Cell(0, 4, "NIT :" . $comprobante->getIds()->getCaIdalterno(), 0, 1, "L");
    $cuenta = $cabecera[$comprobante->getCaIdcomprobante()]["det_ca_idcuenta"];
    $pdf->SetXY($x + 115, $y);
    $pdf->Cell(0, 4, "Cta :" . $cuenta, 0, 1, "L");

    $pdf->SetXY($x + 145, $y);
    $pdf->Cell(0, 4, "FECHA   :" . Utils::parseDate($comprobante->getCaFchcomprobante(), "Y/m/d"), 0, 1, "L");

    $y+=$space;

    if ($comprobante->getCaIdsucursal() == "") {
        $suc_cli = $comprobante->getIds()->getIdsCliente();
        $direccion = $suc_cli->getDireccion();
    } else {
        $suc_cli = Doctrine::getTable("IdsSucursal")->find($comprobante->getCaIdsucursal());
        //$suc_cli=$comprobante->getIds()->getSucursalPrincipal();
        $direccion = $suc_cli->getCaDireccion();
    }
    //$suc_cli=$comprobante->getIds()->getIdsCliente();
    //$direccion=$suc_cli->getDireccion();
    $pdf->SetXY($x + 5, $y);
    $pdf->Cell(0, 4, "DIRECCIÓN: " . utf8_decode($direccion), 0, 1, "L");

    $pdf->SetXY($x + 115, $y);
    $pdf->Cell(0, 4, "VENDEDOR: " . $comprobante->getIds()->getIdsCliente()->getCaVendedor(), 0, 1, "L");

    $pdf->SetXY($x + 145, $y);
    
    $ccosto = Doctrine::getTable("InoCentroCosto")->find($cabecera[$comprobante->getCaIdcomprobante()]["det_ca_idccosto"]);
    if ($ccosto)
        $pdf->Cell(0, 4, "C.Costo  : " . $ccosto->getCaCentro(). "-". $ccosto->getCaIdccosto(), 0, 1, "L");
    else
        $pdf->Cell(0, 4, "C.Costo  : " . " ", 0, 1, "L");

    $y+=$space;
    $pdf->SetXY($x + 5, $y);
    $pdf->Cell(0, 4, "CIUDAD: " . $suc_cli->getCiudad()->getCaCiudad(), 0, 1, "L");
    

    $y+=8;

    //$pdf->Rect($x,$y,175,5);
    //$y+=$space;

    $pdf->SetXY($x + 5, $y);
    $val = $cabecera[$comprobante->getCaIdcomprobante()]["det_ca_db"];
    
    $pdf->Cell(0, 4, "LA SUMA DE  : " . strtoupper(num2letras(round($val), false)) . " M/CTE", 0, 1, "L");

    $pdf->SetXY($x + 150, $y);
    $pdf->Cell(0, 4, $val , 0, 1, "L");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $y+=8;

    $pdf->Rect($x, $y, 175, 100);

    $pdf->line($x, $y + 6, $x + 175, $y + 6);

    $pdf->line($x + 130, $y, $x + 130, $y + 100);


    $pdf->line($x, $y + 100, $x + 175, $y + 100);

    $y+=1;


    $pdf->SetXY($x + 20, $y);
    $pdf->Cell(0, 4, "P o r   C o n c e p t o   d e  :", 0, 1, "L");
    $pdf->SetXY($x + 145, $y);
    $pdf->Cell(0, 4, "V a l or", 0, 1, "L");
    $pdf->SetXY($x + 130, $y);


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Imprime Transacciones

    $lastIngresoPropio = null;
    $impuestos = array();
    $totales = array();

    $k = 5;
    $y+= (2 * $space);
    //$totales = $subtotales = $impuestos["iva"] = $impuestos["reteiva"] = $impuestos["reteica"] = 0;
    $neto = 0;
    foreach ($transacciones[$comprobante->getCaIdcomprobante()] as $t) {

        $y+=$space;

        $pdf->SetXY($x + 5, $y);
        $pdf->Cell(0, 4, $t["det_ca_idcuenta"]."  ".$t["det_ca_observaciones"], 0, 1, "L");
        
        $pdf->SetXY($x + 150, $y);
        if ($t["det_ca_db"] != 0 ){
            $pdf->Cell(0, 4, $t["det_ca_db"], 0, 1, "L");
            $neto += $t["det_ca_db"];
        }
        else{
            $pdf->Cell(0, 4, $t["det_ca_cr"]." CR", 0, 1, "L");
            $neto -= $t["det_ca_cr"];
        }
    }

    $pdf->line($x+130, $y + 6, $x + 175, $y + 6);
    
    $k+=$space;
    $pdf->SetXY($x + 111, $y + $k);
    $pdf->Cell(0, 4, "Neto  :", 0, 1, "L");
    $pdf->SetXY($x, $y + $k);
    $pdf->Cell(172, 4, number_format($neto, 2, ",", "."), 0, 1, "R");
    $k+=$space;
    
   

   

    $pdf->line($x, $y + 91, $x , $y + 105);
    $pdf->line($x+60, $y + 91, $x+60 , $y + 105);
    $pdf->line($x+175, $y + 91, $x+175 , $y + 105);
    $pdf->line($x, $y + 105, $x + 175, $y + 105);
    $y += 50 * $space;
    $pdf->SetXY($x +25, $y );
    $pdf->Cell(172, 4, "Elaboró", 0, 1, "L");
    $pdf->SetXY($x +70, $y );
    $pdf->Cell(172, 4, "Firma y Sello ".$sucursal->getEmpresa()->getCaNombre(), 0, 1, "L");
}

$pdf->Output($filename);
if (!$filename) { //Para evitar que salga la barra de depuracion
    exit();
}
?>





