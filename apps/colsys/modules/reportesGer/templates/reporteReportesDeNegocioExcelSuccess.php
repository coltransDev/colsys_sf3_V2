<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ERROR);
$spreadsheet = $sf_data->getRaw('spreadsheet');

$titulos = array();
foreach ($columns as $key => $column) {
    $titulos[] = utf8_decode(utf8_decode($column["text"]));
}
$cols = Utils::spreadsheet_cols(count($titulos));

// Initialize the Excel document
$objPHPExcel = new sfPhpExcel();

// Set some meta data relative to the document
$objPHPExcel->getProperties()->setCreator($user);
$objPHPExcel->getProperties()->setLastModifiedBy($user);
$objPHPExcel->getProperties()->setTitle($title);
$objPHPExcel->getProperties()->setSubject($subject);
$objPHPExcel->getProperties()->setDescription($description);
$objPHPExcel->getProperties()->setKeywords($title);
$objPHPExcel->getProperties()->setCategory(" ");

// Set the active excel sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle($title);

$i = 1;     // Zona de Titulos
foreach ($titulos as $key => $titulo) {
    $objPHPExcel->getActiveSheet()->setCellValue($cols[$key] . $i, utf8_encode($titulo));
    $objPHPExcel->getActiveSheet()->duplicateStyleArray(
            array(
        'font' => array('color' => array('argb' => PHPExcel_Style_Color::COLOR_WHITE)),
        'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('argb' => "FF808080")),
        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
            ), $cols[$key] . $i
    );
}

$x = 2;     // Zona de Contenido
foreach ($spreadsheet as $row) {
    $y = 0;
    foreach ($columns as $key => $column) {
        $objPHPExcel->getActiveSheet()->getStyle($cols[$y] . $x)->getFont()->setName('Arial');
        $objPHPExcel->getActiveSheet()->getStyle($cols[$y] . $x)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle($cols[$y] . $x)->getFont()->setBold(false);
        $objPHPExcel->getActiveSheet()->getColumnDimension($cols[$y])->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getStyle($cols[$y] . $x)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
        $objPHPExcel->getActiveSheet()->setCellValue($cols[$y] . $x, utf8_encode($row[$column["dataIndex"]]));
        $y++;
    }
    $x++;
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
// Send HTTP headers to tell the browser what's coming

$name = str_replace(" ", "_", $title)."_".date("Ymd");
$filename = null;
if (!$filename) {
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$name.xls\"");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Pragma: public");
}
$objWriter->save(str_replace('.php', '.xls', $filename));

if (!$filename) {
   exit;
}
?>