<?php
/**
* Modulo de creacion de reportes Basado en el modulo de reportes de Carlos Lopez y
* solo que ademas permite crear reportes de exportaciones, adicionalmente entra el
* concepto de embarque.
*
* @package    colsys
* @subpackage reportes
* @author     Your name here
* @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
*/
class reportesNegPlugActions extends sfActions
{    

    public function executeFilesOtm(sfWebRequest $request)
    {
        $this->idreporte = $request->getParameter("id");
        $this->forward404Unless($this->idreporte);

        $this->reporte = Doctrine::getTable("Reporte")->find($this->idreporte);
        $this->forward404Unless($this->reporte);
        
        $year=explode("-", $this->reporte->getCaConsecutivo());
        $this->year=$year[1];
        
        
        $this->folder = "reportes/".$this->year."/".$this->reporte->getCaConsecutivo()."/instrucciones/";
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR;

        if(!is_dir($directory)){
            @mkdir($directory, 0777, true);
        }
        //echo $directory;
        $archivos=sfFinder::type('file')->name('hbl--*')->maxDepth(0)->in($directory);        
        $this->hblold=(count($archivos)>0)?basename($archivos[0]):"";
        
        $archivos=sfFinder::type('file')->name('factura--*')->maxDepth(0)->in($directory);        
        $this->facturaold=(count($archivos)>0)?basename($archivos[0]):"";
        
        $archivos=sfFinder::type('file')->name('empaque--*')->maxDepth(0)->in($directory);        
        $this->empaqueold=(count($archivos)>0)?basename($archivos[0]):"";
        
        $archivos=sfFinder::type('file')->name('poliza--*')->maxDepth(0)->in($directory);        
        $this->polizaold=(count($archivos)>0)?basename($archivos[0]):"";
        
        $archivos=sfFinder::type('file')->name('invima--*')->maxDepth(0)->in($directory);        
        $this->invimaold=(count($archivos)>0)?basename($archivos[0]):"";
        
        
    }

    public function executeUploadFiles()
    {
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;
    }
    
    

    
}
?>
