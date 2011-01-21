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

}
