<?

$reportes = $sf_data->getRaw("reportes");
$cols = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AB", "AC", "AD", "AE", "AF", "AG");

if($modo=="maritimo"){
    $ultimaCol = "V";
}else{
    $ultimaCol = "S";
}

if ($parametros) {
    $key = array_search($ultimaCol, $cols);
    $ultimaCol = $cols[$key + count($parametros)];
} else {

    $parametro = null;
}

//Verifica la cantidad de tráficos en el reporte
$traficos = array();
foreach($reportes as $reporte){
    if(!in_array(utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre()), $traficos))
        $traficos[] = utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre());    
}

error_reporting(E_ERROR);
require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
//$objPHPExcel = new sfPhpExcel();
$objPHPExcel = new PHPExcel();

// Set properties	
$objPHPExcel->getProperties()->setCreator("Colsys");
$objPHPExcel->getProperties()->setLastModifiedBy("Dpto de Traficos");
$objPHPExcel->getProperties()->setTitle("Cuadro de transito de cargas");
$objPHPExcel->getProperties()->setSubject("Cuadro de transito de cargas");
$objPHPExcel->getProperties()->setDescription("Cuadro de transito de cargas.");
$objPHPExcel->getProperties()->setKeywords("Cuadro de transito de cargas");
$objPHPExcel->getProperties()->setCategory(" ");


// Create a first sheet, representing sales data
for ($j=0; $j<count($traficos); $j++)  {
    
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($j);
    
    //Rename sheet
    $objPHPExcel->getActiveSheet()->setTitle($traficos[$j]);

    if ($modo == "maritimo") {
        $objPHPExcel->getActiveSheet()->setCellValue('B2', utf8_encode('TRANSITO DE CARGA VIA MARÍTIMA ' . $cliente->getCaCompania()));
    } else {
        $objPHPExcel->getActiveSheet()->setCellValue('B2', utf8_encode('TRANSITO DE CARGA VIA AÉREA ' . $cliente->getCaCompania()));
    }
    $objPHPExcel->getActiveSheet()->setCellValue('A2', Utils::fechaMes(date("Y-m-d")));
    $objPHPExcel->getActiveSheet()->getStyle('A2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

    $objPHPExcel->getActiveSheet()->mergeCells('A1:' . $ultimaCol . '1');
    // Merge cells		
    $objPHPExcel->getActiveSheet()->mergeCells('B2:' . $ultimaCol . '2');

    $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setName('Candara');
    $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);
    $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

    $objPHPExcel->getActiveSheet()->duplicateStyleArray(
            array(
        'font' => array(
            'color' => array('argb' => PHPExcel_Style_Color::COLOR_WHITE)
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('argb' => "FF808080")
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
            ), 'A2:' . $ultimaCol . '2'
    );


    $i = 3;

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, 'Proovedor');
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, 'Origen');
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, 'Destino');
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, 'Incoterms');
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, 'ETS');
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, 'ETA');
    if ($modo == "maritimo") {
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, utf8_encode('Continuación'));
    }
    if ($modo == "maritimo") {
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, 'Motonave');
    } else {
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, 'Orden');
        $objPHPExcel->getActiveSheet()->mergeCells('G' . $i . ":I" . $i);
    }
    $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, 'Orden');
    $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, 'Producto');
    $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, 'Piezas');
    $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, 'Peso');
    $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, 'Volumen');
    if ($modo == "maritimo") {
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, 'Tipo de contenedor');
    } else {
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, 'Aerolinea');
    }
    if ($modo == "maritimo") {
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, 'HBL');
    } else {
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, 'HAWB');
    }

    $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, 'Consignatario');
    $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, 'Status');
    $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, 'Actualizado');
    $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, 'Ref. ');
    if($modo=="maritimo"){
    $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, 'Bandera');
    $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, 'Reg. Aduanero');
    $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, 'Fch. R. Aduanero');
    }

    if ($parametros) {
        $idx = 1;
        foreach ($parametros as $parametro) {
            $col = $cols[$key + $idx];
            $objPHPExcel->getActiveSheet()->setCellValue($col . $i, utf8_encode($parametro->getCaValor2()));
            $idx++;
        }
    }
    $col = $cols[$key + $idx];
    $objPHPExcel->getActiveSheet()->setCellValue('BA' . $i, 'Modalidad');
    $idx++;
    $col = $cols[$key + $idx];
    $objPHPExcel->getActiveSheet()->setCellValue('BB' . $i, 'Trafico');


    $i++;
    $idEquipo = false;
    
    foreach ($reportes as $reporte) {
    
        if($objPHPExcel->getActiveSheet() === $objPHPExcel->getSheetByName(utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre()))){
            $objPHPExcel->getSheetByName(utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre()));
        if (!$reporte->esUltimaVersion()) {
            continue;
        }

        if (!$reporte->getCaIdetapa()) {
            continue;
        }

        $color = $reporte->getColorStatus();
        switch ($color) {
            case "yellow": //Pendiente de Coordinación
                $color = "FFFFCC";
                break;
            case "blue": //Carga Embarcada
                $color = "CCFFFF";
                break;
            case "green": //"Nuevo status"
                $color = "CCFFCC";
                break;
            case "orange": //"Carga entregada"
                $color = "FFCC99";
                break;
            case "pink": //"Orden Anulada"
                $color = "FFCCCC";
                break;
            case "purple": //"Carga en transito de destino"
                $color = "9999CC";
                break;
            default:
                $color = "FFFFFF"; //sin novedad
                //}
                break;
        }

        $proveedoresStr = "";
        $proveedores = $reporte->getProveedores();
        foreach ($proveedores as $proveedor) {
            $proveedoresStr .= (count($proveedores) > 1 ? "* " : "") . $proveedor->getCaNombre() . "\n";
        }

        $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode($proveedoresStr));

        $origen = $reporte->getOrigen();
        if ($origen) {
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, utf8_encode($origen->getCaCiudad()));
        }

        $destino = $reporte->getDestino();
        if ($destino) {
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, utf8_encode($destino->getCaCiudad()));
        }

        $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, utf8_encode(substr($reporte->getIncotermsStr(), 0, 3)));
        $ets = Utils::parseDate($reporte->getETS(), "d/m/y");
        if ($ets) {
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $ets);
        }

        $eta = Utils::parseDate($reporte->getETA(), "d/m/y");
        if ($eta) {
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $eta);
        }
        if ($modo == "maritimo") {
            if ($reporte->getCaContinuacion() != "N/A") {
                $fchCont = Utils::parseDate($reporte->getFchLlegadaCont(), "d/m/y");
                if ($fchCont) {
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $fchCont);
                }
            } else {
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, utf8_encode("N/A"));
            }
        }

        if ($modo == "maritimo") {
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, utf8_encode($reporte->getIdNave()));
        } else {
            //Las combine mientras arreglo el cuadro para aereo	
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, utf8_encode($reporte->getCaOrdenClie()));
            $objPHPExcel->getActiveSheet()->mergeCells('G' . $i . ":I" . $i);
        }

        $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, utf8_encode($reporte->getCaOrdenClie()));
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, utf8_encode($reporte->getCaMercanciaDesc()));
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, utf8_encode($reporte->getPiezas()));

        $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, utf8_encode($reporte->getPeso()));
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, utf8_encode(str_replace("M&sup3;", "CBM", $reporte->getVolumen())));

        if ($modo == "maritimo") {
            // N tipo contenedor
            if ($reporte->getCaModalidad() == "LCL") {
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, utf8_encode("N/A"));
            } else {
                $equiposStr = "";
                $repequipos = $reporte->getRepEquipos();
                foreach ($repequipos as $equipo) {
                    $equiposStr.= number_format($equipo->getCaCantidad(),0) . "x" . $equipo->getConcepto()->getCaConcepto();
                    if ($equipo->getCaIdequipo()) {
                        $idEquipo = true;
                        $equiposStr.= " #".$equipo->getCaIdequipo();
                    }
                    $equiposStr.= "\n";
                }
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, utf8_encode($equiposStr));
            }
        } else {
            $transporte = $reporte->getIdsProveedor();
            if ($transporte) {
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, utf8_encode($transporte->getIds()->getCaNombre()));
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, utf8_encode(" " . $reporte->getDocTransporte()));

        $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, utf8_encode($reporte->getConsignedTo()));

        $txtStatus = str_replace("\r", "", strip_tags($reporte->getTextoStatus()));
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, utf8_encode($txtStatus));

        $ref = $reporte->getNumReferencia() ? " " . $reporte->getNumReferencia() : "";

        $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, Utils::parseDate($reporte->getFchUltimoStatus(), "d/m/y") . $ref);
        $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $reporte->getCaConsecutivo() . $ref);

        $inoClientesSea = $reporte->getInoClientesSea();

        if($inoClientesSea){
            $inoMaestraSea = $inoClientesSea->getInoMaestraSea();
            $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $inoMaestraSea->getCaBandera());
            $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $inoMaestraSea->getCaRegistroadu()." ");
            $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $inoMaestraSea->getCaFchregistroadu());
        }

        if ($parametros) {
            $idx = 1;
            foreach ($parametros as $parametro) {

                $valor = explode(":", $parametro->getCaValor());
                $name = $valor[0];
                $type = $valor[1];

                $col = $cols[$key + $idx];

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $reporte->getProperty($name));
                $idx++;
            }
        }

        //$col = $cols[$key + $idx];
        $objPHPExcel->getActiveSheet()->setCellValue('BA' . $i, $reporte->getCaModalidad());
        $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setVisible(false);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(20);
        //$idx++1
        //$col = $cols[$key + $idx];
        $objPHPExcel->getActiveSheet()->setCellValue('BB' . $i, $reporte->getOrigen()->getTrafico()->getCaNombre());
        $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setVisible(false);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(20);


        $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('I' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getFont()->setSize(8);
        $objPHPExcel->getActiveSheet()->getStyle('N' . $i)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('P' . $i)->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle('Q' . $i)->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle('Q' . $i)->getFont()->setSize(8);

        $objPHPExcel->getActiveSheet()->getStyle('S' . $i)->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle('U' . $i)->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->duplicateStyleArray(
                array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => $color)
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => "C0C0C0")
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => "C0C0C0")
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => "C0C0C0")
                )
            ),
                ), 'A' . $i . ':' . $ultimaCol . $i
        );


        $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('Q' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //Calcula el alto estimado de la columna de acuerdo a la longitud del texto. 
        $lenFactor = intval(strlen( $txtStatus ) / 60);
        $height = 14*$lenFactor;    
        //echo strlen( $txtStatus ) ." ".$lenFactor." ".$height."<br />";    
        if( $height<70 ){
            $height=70;
        }
        $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight($height);
        }else{
            $i=3;
        }
        $i++;
    }


    $objPHPExcel->getActiveSheet()->duplicateStyleArray(
            array(
        'font' => array(
            'bold' => true
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startcolor' => array(
                'argb' => 'FFA0A0A0'
            ),
            'endcolor' => array(
                'argb' => 'FFFFFFFF'
            )
        )
            ), 'A3:' . $ultimaCol . '3'
    );


    $objPHPExcel->getActiveSheet()->duplicateStyleArray(
            array(
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
            ), 'A' . $i . ':' . $ultimaCol . $i
    );

    // Set column widths
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(21);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
    if ($modo == "maritimo") {
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
        //$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    } else {
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(0.1);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(0.1);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    }

    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
    if ($idEquipo){
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(40);
    }else{
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    }
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(21);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(45);

    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(13);
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(13);
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(13);


    // Convenciones		

    $lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();

    $i = $lastRow + 3;

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode("Convenciones"));
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $i++;

    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->getStartColor()->setRGB('CCFFCC');
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode("Nuevo status"));
    $i++;

    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->getStartColor()->setRGB('FFFFCC');
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode("Pendiente de Coordinación"));
    $i++;

    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->getStartColor()->setRGB('CCFFFF');
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode("Carga Embarcada"));
    $i++;

    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->getStartColor()->setRGB('FFCC99');
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode("Carga entregada"));
    $i++;
    
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->getStartColor()->setRGB('9999CC');
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode("Carga en tránsito terrestre"));
    $i++;

    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getFill()->getStartColor()->setRGB('FFCCCC');
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, utf8_encode("Orden Anulada"));

    // Add a hyperlink to the sheet		
    $objPHPExcel->getActiveSheet()->setCellValue('A' . ($i + 2), 'http://' . sfConfig::get("app_branding_url"));
    $objPHPExcel->getActiveSheet()->getCell('A' . ($i + 2))->getHyperlink()->setUrl('http://' . sfConfig::get("app_branding_url"));
    $objPHPExcel->getActiveSheet()->getCell('A' . ($i + 2))->getHyperlink()->setTooltip(utf8_encode('Mayor información'));
    $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

    $objPHPExcel->getActiveSheet()->mergeCells('A' . ($i + 2) . ":B" . ($i + 2));

    // Add a drawing to the worksheet

    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo');
    $objDrawing->setDescription('Logo');
    $objDrawing->setPath(sfConfig::get("sf_web_dir") . '/images/branding/' . sfConfig::get("app_branding_template") . '/logo316x60.png');
    $objDrawing->setCoordinates('A1');
    $objDrawing->setHeight(36);
    $objDrawing->getShadow()->setVisible(true);
    $objDrawing->setOffsetY(5);

    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(38);

    // Set page orientation and size

    $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);

}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//Remove last sheet
$objPHPExcel->removeSheetByIndex(count($traficos));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// Send HTTP headers to tell the browser what's coming
//echo $filename;
//exit;
if (!$filename) {
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"" . $cliente->getCaCompania() . ".xls\"");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Pragma: public");
$objWriter->save('php://output');    
}
else
{
$objWriter->save(str_replace('.php', '.xls', $filename));
/*
 * 
 */
/*header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0*/

}
if (!$filename) {
    exit;
}
?>