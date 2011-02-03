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

    private $filetypes = array("MBL", "HBL");
    
    /**
     *
     */
    public function executePanelReportesAntecedentes() {



    }

    /**
     *
     */
    public function executePanelMasterAntecedentes() {

        
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
                          ->addWhere("r.ca_master = ? ", $this->master )
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
        $folder = "Referencias" . DIRECTORY_SEPARATOR . $this->ref->getCaReferencia();
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        if (!is_dir($directory)) {
            @mkdir($directory, DEFAULT_PRIVILEGES, true);
        }


        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);

        $filenames = array();

        $fileTypes = $this->filetypes;
        
        foreach ($fileTypes as $fileType) {

            foreach ($archivos as $archivo) {
                if (substr(basename($archivo), 0, strlen($fileType)) == $fileType) {
                    $filenames[$fileType]["file"] = str_replace(sfConfig::get('app_digitalFile_root'), "", $archivo);
                }
            }
        }

        $this->folder = $folder;
        $this->filenames = $filenames;
        
    }

}
