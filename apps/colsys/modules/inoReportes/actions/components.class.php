<?php

/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * ino components.
 *
 * @package    colsys
 * @subpackage inoReportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inoReportesComponents extends sfComponents {
    
    /*
     * Formulario para realizar consultas en general
     */

    public function executeFormConsultaPanel() {
        
    }
    
    
    public function executeFiltrosListados()
    {
        $this->modalidad = $this->getRequestParameter("modalidad");
        $this->origen    = $this->getRequestParameter("origen");
        $this->idorigen  = $this->getRequestParameter("idorigen");
        $this->destino   = $this->getRequestParameter("destino");
        $this->iddestino = $this->getRequestParameter("iddestino");
        
        $this->etapa    = $this->getRequestParameter("etapa");
        $this->idetapa  = $this->getRequestParameter("idetapa");

        $this->noreporte    = $this->getRequestParameter("noreporte");
        $this->noreferencia  = $this->getRequestParameter("noreferencia");
        //echo $this->etapa;
        $this->fechaInicial = $this->getRequestParameter("fechaInicial");
        $this->fechaFinal = $this->getRequestParameter("fechaFinal");
        
        if($this->url=="")
            $this->url="otm/listaAprobacion";
        
        if($this->titulo=="")
            $this->titulo="Filtros";
    }
    
    
}

