<?php

/**
 * indicadores actions.
 *
 * @package    colsys
 * @subpackage indicadores
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class indicadoresComponents extends sfComponents {

    
    /*
    *
    */
    public function executeHtmlResumen()
    {
        $indicador = Doctrine::getTable("Idg")->find($this->getRequestParameter("idg"));
        $datos = array();
        
        $datos["sucursal"] = $this->getRequestParameter("sucursal");
        $datos["origen"] = $this->getRequestParameter("origen");
        $datos["cliente"] = $this->getRequestParameter("cliente");
        $datos["usuario"] = $this->getRequestParameter("usuario");
               
        $this->title = $indicador->getTitle($datos);
        $this->subtitle = $indicador->getSubTitle($this->getRequestParameter("ano"), $this->getRequestParameter("mes"));
    }
}
?>
