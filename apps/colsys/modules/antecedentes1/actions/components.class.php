<?php

/**
 * antecedentes actions.
 *
 * @package    symfony
 * @subpackage antecedentes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class antecedentesComponents extends sfComponents {
   //private $filetypes = array("MBL", "HBL");

   /**
    *
    */
   public function executePanelReportesAntecedentes() {
      
   }

   public function executePanelReportesOTMAntecedentes() {
      
   }

   public function executePanelEntregaAntecedentes() {
      
   }

   /**
    *
    */
   public function executePanelMasterAntecedentes() {
      
   }

   public function executePanelMasterOTMAntecedentes() {
      
   }

   /**
    *
    */
   public function executeGridDropZone() {
      
   }

   /**
    *
    */
   public function executeListaReportesMaster() {
      $this->reportes = Doctrine::getTable("Reporte")
              ->createQuery("r")
              ->addWhere("r.ca_master = ? ", $this->master)
              ->execute();
   }

   /**
    *
    */
   public function executeWidgetReporteAntecedentes() {
      
   }

   /**
    *
    */
   public function executeWidgetHBLAntecedentes() {
      
   }

   /**
    *
    */
   public function executeFileManager() {
      $this->edit = (($this->getRequestParameter("format") == "" && $this->format == "") ? true : false);
      
      $referencia = ArchivosTable::getReferenciaAntigua($this->ref->getCaReferencia());

      $folder = "Referencias" . DIRECTORY_SEPARATOR . $referencia;
      
      $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

      if (!is_dir($directory)) {
         @mkdir($directory, 0777, true);
      }
      chmod($directory, 0777);

      $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
      //echo print_r($archivos);

      $filenames = array();

      $fileTypes = $this->filetypes;

      foreach ($archivos as $archivo) {
         $file = explode("/", $archivo);
         $filenames[]["file"] = $file[count($file) - 1];
      }

      $this->folder = $folder;
      $this->filenames = $filenames;
   }

}
