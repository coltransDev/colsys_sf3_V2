<?

$cols = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P");

error_reporting(E_ERROR);

$objPHPExcel = new sfPhpExcel();

// Set properties	
$objPHPExcel->getProperties()->setCreator("Colsys");
$objPHPExcel->getProperties()->setLastModifiedBy("Departamento de Exportaciones");
$objPHPExcel->getProperties()->setTitle("Cuadro de Novedades en Facturación");
$objPHPExcel->getProperties()->setSubject("Cuadro de Novedades en Facturación");
$objPHPExcel->getProperties()->setDescription("Cuadro de Novedades en Facturación");
$objPHPExcel->getProperties()->setKeywords("Cuadro de Novedades en Facturación");
$objPHPExcel->getProperties()->setCategory(" ");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->mergeCells('C1:P1');
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setCellValue('C1', utf8_encode('REPORTE DE FACTURACIÓN PERIODO ' . $fchInicial . ' - ' . $fchFinal));
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
        array('alignment' => array(
         'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
         ),
        ), 'C1');

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

$i = 2;     // Zona de Titulos
foreach ($titulos as $key => $titulo) {
   $objPHPExcel->getActiveSheet()->setCellValue($cols[$key] . $i, utf8_encode($titulo));
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
           ), $cols[$key] . $i
   );
}

$i = 3;     // Zona de Contenido
foreach ($novedades as $novedad) {
   foreach ($novedad as $key => $pos) {
      $objPHPExcel->getActiveSheet()->getStyle($cols[$key] . $i)->getFont()->setName('Candara');
      $objPHPExcel->getActiveSheet()->getStyle($cols[$key] . $i)->getFont()->setSize(10);
      $objPHPExcel->getActiveSheet()->getStyle($cols[$key] . $i)->getFont()->setBold(false);
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
      $objPHPExcel->getActiveSheet()->getStyle($cols[$key] . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
      $objPHPExcel->getActiveSheet()->setCellValue($cols[$key] . $i, utf8_encode($pos));
   }
   $i++;
}


foreach ($cols as $col) {
   $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
}

// Set page orientation and size

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);

// Rename sheet

$objPHPExcel->getActiveSheet()->setTitle('Status');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
// Send HTTP headers to tell the browser what's coming

$name = "ClariantExpo" . date(YmdHis);
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
