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
        $this->iddepartamento = $this->getRequestParameter("iddepartamento");
        $this->departamento = $this->getRequestParameter("departamento");
        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
        
        $this->action=$this->getContext()->getActionName ();
    }
    
    public function executeFiltrosEstadisticasIndicadoresTT()
    {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/Spinner.js", 'last');
        $response->addJavaScript("extExtras/SpinnerField.js", 'last');
        $response->addJavaScript("extExtras/NumberFieldMin.js", 'last');
        
        $response->addStyleSheet("extExtras/Spinner.css",'last');
        
        $this->opcion=$this->getRequestParameter("opcion");        
        $this->idcliente=$this->getRequestParameter("idcliente");
        $this->cliente=$this->getRequestParameter("Cliente");
        $this->fechainicial = $this->getRequestParameter("fechaInicial");
        $this->fechafinal = $this->getRequestParameter("fechaFinal");   
        $this->metalcl = $this->getRequestParameter("meta_lcl");   
        $this->metafcl = $this->getRequestParameter("meta_fcl");      
        $this->idpais_origen=$this->getRequestParameter("idpais_origen");
        $this->pais_origen=$this->getRequestParameter("pais_origen");
        $this->typeidg = $this->getRequestParameter("type_idg");        
    }

    public function executeFiltrosReporteDesconsolidacion()
    {
        $this->fechainicial=$this->getRequestParameter("fechaInicial");
        $this->fechafinal=$this->getRequestParameter("fechaFinal");        
    }
    
    public function executeFiltrosReporteRecibosCaja()
    {
        $this->fechainicial=$this->getRequestParameter("fechaInicial");
        $this->fechafinal=$this->getRequestParameter("fechaFinal");        
        $this->tipo=$this->getRequestParameter("tipo");
        $this->ntipo=$this->getRequestParameter("ntipo");
        $this->idsucursal = $this->getRequestParameter("idsucursal");
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->login = $this->getRequestParameter("login");
        $this->vendedor = $this->getRequestParameter("vendedor");
        
        //echo $this->tipo." ".$this->ntipo;
    }
    
    public function executeFormMenuImpresionblPanel(){
        
        $this->fechaInicial=$this->getRequestParameter("fechaInicial");
        $this->fechaFinal=$this->getRequestParameter("fechaFinal");
        
        $this->origen = $this->getRequestParameter("origen");
        $this->idorigen = $this->getRequestParameter("idorigen");
        
        $this->idagente = $this->getRequestParameter("idagente");
        $this->agente = $this->getRequestParameter("agente");
        
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->idSucursal = $this->getRequestParameter("idSucursal");
        
    }
    
    public function executeFormMenuEstadisticasExportaciones(){
        
        $this->fechaInicial=$this->getRequestParameter("fechaInicial");
        $this->fechaFinal=$this->getRequestParameter("fechaFinal");
        
        $this->origen = $this->getRequestParameter("origen");
        $this->idorigen = $this->getRequestParameter("idorigen");
        
        $this->idagente = $this->getRequestParameter("idagente");
        $this->agente = $this->getRequestParameter("agente");
        
        $this->sucursal = $this->getRequestParameter("sucursal");
        $this->idSucursal = $this->getRequestParameter("idSucursal");
        
    }
}
?>