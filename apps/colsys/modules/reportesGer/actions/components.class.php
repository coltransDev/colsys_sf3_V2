<?php

/**
 * reportesGer components.
 *
 * @package    colsys
 * @subpackage reportesGer
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesGerComponents extends sfComponents
{
	 /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executePanelConsulta( ){
        

    }



     /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executeReporteInoPanel( ){
        
    }

    /*
	* Lista de campos que se mostrarqan en el reporte
	* @author: Andres Botero
	*/
    public function executeListaCamposGridPanel( ){        
       $response = sfContext::getInstance()->getResponse();
       $response->addJavaScript("extExtras/CheckColumn",'last');

    }

    /*
	* Lista de campos que se mostrarqan en el reporte
	* @author: Andres Botero
	*/
    public function executeListaFiltrosGridPanel( ){

        

    }

    public function executeFiltrosEstadisticasTraficos()
    {
        $this->opcion=$this->getRequestParameter("opcion");
        $this->fechainicial=$this->getRequestParameter("fechaInicial");
        $this->fechafinal=$this->getRequestParameter("fechaFinal");        
        $this->idsucursal = $this->getRequestParameter("idsucursal");
        $this->sucursal = $this->getRequestParameter("sucursal");
    }
    
    public function executeFiltrosEstadisticasIndicadoresTT()
    {
        $this->opcion=$this->getRequestParameter("opcion");        
        $this->fechafinal=$this->getRequestParameter("fechaFinal");        
        $this->idpais_origen=$this->getRequestParameter("idpais_origen");
        $this->pais_origen=$this->getRequestParameter("pais_origen");
        
    }

    public function executeFiltrosReporteDesconsolidacion()
    {
        $this->fechainicial=$this->getRequestParameter("fechaInicial");
        $this->fechafinal=$this->getRequestParameter("fechaFinal");
        
        
    }
}
?>