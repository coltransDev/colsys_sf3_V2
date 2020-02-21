<?
$txtSucursal=array();
$txtSucursal["datos"][]= $sucursal->getCaNombre();
$dir= explode("  ", $sucursal->getCaDireccion());

foreach($dir as $d)
    $txtSucursal["datos"][]=$d;
$txtSucursal["datos"][]=$sucursal->getCaTelefono()?"Pbx: ".$sucursal->getCaTelefono():"";//"Pxb : (57 - 1) 4239300";
$txtSucursal["datos"][] = $sucursal->getCaCodpostal()?"Cod. Postal: ". $sucursal->getCaCodpostal():"";
if($sucursal->getCaEmail()!="")
    $txtSucursal["datos"][]= $sucursal->getCaEmail();//"Email: bogota@coltrans.com.co";
$txtSucursal["datos"][]=$empresa->getCaUrl();// "www.coltrans.com.co";
$txtSucursal["datos"][]="NIT: ".$empresa->getIds()->getCaIdalterno();// "800024075";
$txtSucursal["datos"][]=$empresa->getCaCoddian()?"Cod. DIAN ".$empresa->getCaCoddian():"";

if($sucursal->getCaIso()!="")
    $txtSucursal["imagenes"]["iso"]=$sucursal->getCaIso();
if($sucursal->getCaBasc()!="")
    $txtSucursal["imagenes"]["basc"]=$sucursal->getCaBasc();
if($sucursal->getCaIata()!="")
    $txtSucursal["imagenes"]["iata"]=$sucursal->getCaIata(); 

//echo "<pre>";print_r($txtSucursal);echo "</pre>";

ProjectConfiguration::registerPhpWord();

/*
$phpWord = new \PhpOffice\PhpWord\PhpWord();

$section = $phpWord->addSection();

$section->getSettings()->setPaperSize($value = 'Letter');
$section->getSettings()->setMarginLeft(900);
$section->getSettings()->setMarginRight(729);
$section->getSettings()->setMarginTop(528);
$section->getSettings()->setMarginBottom(380);

if($sucursal->getCaIdempresa()==1)
    $image = "Colmas.jpg";
else
    $image = "ColtransSA.jpg";

$directory = sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR;

$header = $section->addHeader();
$header->addImage($directory.$image,array('width' => 308, 'height' => 45, 'align' => 'left'));

$footer = $section->addFooter();
$phpWord->addFontStyle('rStyle', array('name' => 'Arial', 'bold'=>true, 'italic'=>false, 'size'=>10));
$phpWord->addFontStyle('rStyle1', array('name' => 'Arial', 'bold'=>false, 'italic'=>false, 'size'=>8));

$phpWord->addParagraphStyle('pStyle', array('align'=>'right', 'spaceAfter' => 100));
$phpWord->addParagraphStyle('pStyle1', array('align'=>'right', 'spaceBefore' => 0,'spaceAfter' => 0,'spacing' => 0));

$footer->addText($sucursal->getCaNombre(),  'rStyle', 'pStyle');
$table = $footer->addTable();
$table->addRow();

if(isset($txtSucursal["imagenes"]) && $txtSucursal["imagenes"]["iso"]){
    $table->addCell(1500)->addImage($directory.$txtSucursal["imagenes"]["iso"],array('width' => 80, 'height' => 87, 'align' => 'center'));
    $total+= 1500;
}

if(isset($txtSucursal["imagenes"]) && $txtSucursal["imagenes"]["basc"]){
    $table->addCell(1500)->addImage($directory.$txtSucursal["imagenes"]["basc"],array('width' => 80, 'height' => 67, 'align' => 'center'));
    $total+= 1500;
}

if(isset($txtSucursal["imagenes"]) && $txtSucursal["imagenes"]["iata"]){
    $table->addCell(1500)->addImage($directory.$txtSucursal["imagenes"]["iata"],array('width' => 80, 'height' => 57, 'align' => 'center'));
    $total+= 1500;
}

$totalData = 11700 - $total;
$cellData = $table->addCell($totalData);

for( $i=1 ; $i<count($txtSucursal["datos"]) ; $i++){
    if($txtSucursal["datos"][$i]=="")
        continue;
    $cellData->addText($txtSucursal["datos"][$i] , 'rStyle1', 'pStyle1');    
}
*/

$phpWord = new PHPWord();

$section = $phpWord->createSection();

//$section->getSettings()->setPaperSize($value = 'Letter');
$section->getSettings()->setMarginLeft(900);
$section->getSettings()->setMarginRight(729);
$section->getSettings()->setMarginTop(528);
$section->getSettings()->setMarginBottom(380);

$header = $section->createHeader();

/*if($sucursal->getCaIdempresa()==1)
    $image = "Colmas.jpg";
else
    $image = "ColtransSA.jpg";*/

if($empresa->getCaLogo()){
    $image = $empresa->getCaLogo();
    $directory = sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR;
    $header->addImage($directory.$image, array('width' => 308, 'height' => 45, 'align' => 'left'));
}

/*
if($sucursal->getCaIdempresa()==1)
    $image = "Colmas.jpg";
else
    $image = "ColtransSA.jpg";

$header = $section->createHeader();
$header->addImage($directory.$image,array('width' => 308, 'height' => 45, 'align' => 'left')); 
 */

$footer = $section->createFooter();
$phpWord->addFontStyle('rStyle', array('name' => 'Arial', 'bold'=>true, 'italic'=>false, 'size'=>10));
$phpWord->addFontStyle('rStyle1', array('name' => 'Arial', 'bold'=>false, 'italic'=>false, 'size'=>8));

$phpWord->addParagraphStyle('pStyle', array('align'=>'right', 'spaceAfter' => 100));
$phpWord->addParagraphStyle('pStyle1', array('align'=>'right', 'spaceBefore' => 0,'spaceAfter' => 0,'spacing' => 0));

$footer->addText($sucursal->getCaNombre(),  'rStyle', 'pStyle');
$footer->addText($sucursal->getEmpresa()->getCaNombre(),  'rStyle', 'pStyle');
$table = $footer->addTable();
$table->addRow();

if(isset($txtSucursal["imagenes"]) && $txtSucursal["imagenes"]["iso"]){
    $table->addCell(1500)->addImage($directory.$txtSucursal["imagenes"]["iso"],array('width' => 80, 'height' => 87, 'align' => 'center'));
    $total+= 1500;
}

if(isset($txtSucursal["imagenes"]) && $txtSucursal["imagenes"]["basc"]){
    $table->addCell(1500)->addImage($directory.$txtSucursal["imagenes"]["basc"],array('width' => 80, 'height' => 67, 'align' => 'center'));
    $total+= 1500;
}

if(isset($txtSucursal["imagenes"]) && $txtSucursal["imagenes"]["iata"]){
    $table->addCell(1500)->addImage($directory.$txtSucursal["imagenes"]["iata"],array('width' => 80, 'height' => 57, 'align' => 'center'));
    $total+= 1500;
}

$totalData = 11700 - $total;
$cellData = $table->addCell($totalData);

for( $i=1 ; $i<count($txtSucursal["datos"]) ; $i++){
    if($txtSucursal["datos"][$i]=="")
        continue;
    $cellData->addText($txtSucursal["datos"][$i] , 'rStyle1', 'pStyle1');    
}
// Saving the document as OOXML file...
$filename = 'Plantilla'.$sucursal->getEmpresa()->getCaNombre().$sucursal->getCaNombre().'2015.docx';

header('Content-type: application/vnd.ms-word');
header('Content-Disposition: attachment; filename="' . $filename  .'"');
header('Cache-Control: max-age=0');


$objWriter = PHPWord_IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');

exit;
?>