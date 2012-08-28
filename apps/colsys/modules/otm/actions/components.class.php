<?php

/**
 * homepage components.
 *
 * @package    colsys
 * @subpackage notificaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class otmComponents  extends sfComponents
{
	/**
	* Muestra las novedades de colsys
	*	
	*/
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
        
    }
}
?>