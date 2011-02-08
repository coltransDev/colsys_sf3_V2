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
        //echo print_r($archivos);

        $filenames = array();

        $fileTypes = $this->filetypes;
        


        foreach ($archivos as $archivo) {            
            $file=explode("/", $archivo);
            $filenames[]["file"] = $file[count($file)-1];
        }        

        $this->folder = $folder;
        $this->filenames = $filenames;
        
    }

}
