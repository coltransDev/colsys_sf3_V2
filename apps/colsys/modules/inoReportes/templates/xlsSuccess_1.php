<?



//Verifica la cantidad de tráficos en el reporte

$objPHPExcel = new sfPhpExcel();

// Set properties	
$objPHPExcel->getProperties()->setCreator("Colsys");
$objPHPExcel->getProperties()->setLastModifiedBy("Dpto de Traficos");
$objPHPExcel->getProperties()->setTitle("Cuadro de transito de cargas");
$objPHPExcel->getProperties()->setSubject("Cuadro de transito de cargas");
$objPHPExcel->getProperties()->setDescription("Cuadro de transito de cargas.");
$objPHPExcel->getProperties()->setKeywords("Cuadro de transito de cargas");
$objPHPExcel->getProperties()->setCategory(" ");

$style=  array();
$style["fill"]["type"]=PHPExcel_Style_Fill::FILL_PATTERN_LIGHTGRID;
//$style["fill"]["rotation"]=-90;
//$style["fill"]["startcolor"]=array("rgb"=>"FF0000");
//$style["fill"]["endcolor"]=array("rgb"=>"0000FF");
$style["fill"]["color"]=array("rgb"=>"00FF00");


//$style["font"]
$style["font"]["name"]='Verdana';
$style["font"]["bold"]=true;
$style["font"]["italic"]=true;
$style["font"]["underline"]=PHPExcel_Style_Font::UNDERLINE_DOUBLE;
//$style["font"]["strike"]=true;
$style["font"]["color"]=array("rgb"=>"FFFFFF");
$style["font"]["size"]=13;



$border=array('style'=>PHPExcel_Style_Border::BORDER_DOUBLE,'color'=>array("rgb"=>"FF0000"));

//$style["allborders"]=$border;
$style["borders"]["left"]=$border;
/*$style["borders"]["right"]=
$style["borders"]["top"]=
$style["borders"]["bottom"]=
$style["borders"]["diagonal"]=
$style["borders"]["vertical"]=
$style["borders"]["horizontal"]=
$style["borders"]["diagonaldirection"]=
$style["borders"]["outline"]=*/



$style["alignment"]["horizontal"]=PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
$style["alignment"]["vertical"]=PHPExcel_Style_Alignment::VERTICAL_BOTTOM;
$style["alignment"]["rotation"]=90;
$style["alignment"]["wrap"]=true;



$style["numberformat"]["code"]=PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE;
//$style["protection"]["locked"]=PHPExcel_Style_Protection::PROTECTION_PROTECTED;
//$style["protection"]["hidden"]=PHPExcel_Style_Protection::PROTECTION_PROTECTED;


$style_titulo["fill"]["type"]=PHPExcel_Style_Fill::FILL_PATTERN_LIGHTGRID;
$style_titulo["fill"]["color"]=array("rgb"=>"FF0000");
$style_titulo["font"]["name"]='Verdana';
$style_titulo["font"]["bold"]=true;
$style_titulo["font"]["color"]=array("rgb"=>"FFFFFF");
$style_titulo["font"]["size"]=14;





$celdas[]=array("data"=>array(array("value"=>"Titulo","colspan"=>3)),"style"=>$style_titulo);

$celdas[]=array("data"=>array(array("value"=>"RowSpan","rowspan"=>5),array("value"=>"1.1"),array("value"=>"1.2")),"style"=>$style);
$celdas[]=array("data"=>array(array("value"=>"RowSpan"),array("value"=>"2.1"),array("value"=>"2.2")));
$celdas[]=array("data"=>array(array("value"=>"RowSpan"),array("value"=>"3.1"),array("value"=>"3.2")));
$celdas[]=array("data"=>array(array("value"=>"RowSpan"),array("value"=>"4.1"),array("value"=>"4.2")));
$celdas[]=array("data"=>array(array("value"=>"RowSpan"),array("value"=>"5.1"),array("value"=>"5.2","style"=>$style)));



$data[]=array("title"=>"Prueba","data"=>$_SESSION["xls"],"row_ini"=>2,"col_ini"=>2);

$data[]=array("title"=>"2013","data"=>$celdas,"row_ini"=>2,"col_ini"=>2);
$data[]=array("title"=>"2014","data"=>$celdas,"row_ini"=>3,"col_ini"=>3);
$col_ini=  isset($sheet["col_ini"])?$sheet["col_ini"]:0;
            

//mergeCellsByColumnAndRow


$objPHPExcel->setData($data);

$objPHPExcel->printData();
//$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(2, 2, 3, 2);
//exit("aa");
// Create a first sheet, representing sales data


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//Remove last sheet
//$objPHPExcel->removeSheetByIndex(count($traficos));

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
// Send HTTP headers to tell the browser what's coming

//if (!$filename) {
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"1.xls\"");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Pragma: public");
//}
$objWriter->save();

//if (!$filename) {
    exit;
//}
    
    
    //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//        $objWriter->save('php://output');
//        exit();
?>