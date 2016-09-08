<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel.php';
include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';

error_reporting(E_ERROR);
$spreadsheet = $sf_data->getRaw('spreadsheet');

$titulos = array();
foreach ($columns as $key => $column) {
    $titulos[] = utf8_decode(utf8_decode($column["text"]));
}
$cols = Utils::spreadsheet_cols(count($titulos));

// Initialize the Excel document
$objPHPExcel = new PHPExcel();

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
    // Redirect output to a client?s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$name.'.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}
if (!$filename) {
   exit;
}
?>