<?php

/**
 * kbase components.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class inventoryComponents extends sfComponents
{
	const RUTINA = "38";
    const RUTINAINV = "94";
   
    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executePanelCategorias( ){

    }

    /*
	* Panel que muestra el listado de activos x categoria
	* @author: Andres Botero
	*/
    public function executePanelActivos( ){

        
        //echo $this->editable;

        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');

        $response->addJavaScript("extExtras/GridFilters",'last');
        $response->addJavaScript("extExtras/menu/ListMenu",'last');
        $response->addJavaScript("extExtras/menu/RangeMenu",'last');
        $response->addJavaScript("extExtras/filters/Filter",'last');
        $response->addJavaScript("extExtras/filters/StringFilter",'last');
        $response->addJavaScript("extExtras/filters/DateFilter",'last');
        $response->addJavaScript("extExtras/filters/ListFilter",'last');
        $response->addJavaScript("extExtras/filters/NumericFilter",'last');
        $response->addJavaScript("extExtras/filters/BooleanFilter",'last');

        $response->addStyleSheet("extExtras/GridFilters",'last');
        $response->addStyleSheet("extExtras/RangeMenu",'last');

        
    }

    /*
	* Ventana para agregar o editar un activo
	* @author: Andres Botero
	*/
    public function executeEditarActivoWindow( ){
        
    }
    
   
    /*
	* Editar propiedades basicas
	* @author: Andres Botero
	*/
    public function executeEditarActivoPropiedadesPanel( ){
        
    }
    
    /*
	* Editar propiedades basicas
	* @author: Andres Botero
	*/
    public function executeEditarActivoSoftwarePropiedadesPanel( ){
        
    }
    
    
    /*
	* Editar propiedades basicas
	* @author: Andres Botero
	*/
    public function executeEditarActivoHardwarePropiedadesPanel( ){
        $this->so_types = ParametroTable::retrieveByCaso("CU095");
        $this->office_types = ParametroTable::retrieveByCaso("CU096");
    }
    
    

    /*
	* Panel de vista previa
	* @author: Andres Botero
	*/
    public function executePanelReading( ){
        $this->nivel = $this->getUser()->getNivelAcceso( inventoryActions::RUTINA );

        $this->editable = "false";

    }

    /*
	* Ventana que permite agregar un nuevo seguimiento
	* @author: Andres Botero
	*/
    public function executeNuevoSeguimientoWindow( ){
        
        $q = Doctrine::getTable("InvMantenimientoEtapas")
                ->createQuery("e");
        
        $etapas = $q->execute();
        
        $this->etapas = $etapas;
        
    }
    
    public function executeNuevaAnotacionWindow(){
        
    }

    /*
	* Ventana que permite  editar las categorias
	* @author: Andres Botero
	*/
    public function executePanelCategoriaWindow( ){
        $this->nivel = $this->getUser()->getNivelAcceso( inventoryActions::RUTINA );

        

        if($this->nivel>=1){
            $idcategory = $this->getRequestParameter("idcategory");

            $categoria = Doctrine::getTable("InvCategory")->find($idcategory);
            if(!$categoria){
                $categoria = new InvCategory();
            }
            
            
        }
        
        $this->parameters = ParametroTable::retrieveByCaso("CU099");

    }


    /*
	* Panel que permite asignar un activo a un suario
	* @author: Andres Botero
	*/
    public function executePanelAsignaciones( ){

    }
    
    /*
	* Panel que permite asignar un software a un equipo
	* @author: Andres Botero
	*/
    public function executePanelAsignacionesSoftware( ){

    }
    
    
    /*
	* Panel que permite asignar un software a un equipo
	* @author: Andres Botero
	*/
    public function executeWidgetEquipo( ){

    }
    
    /*
	* Panel que permite asignar un software a un equipo
	* @author: Andres Botero
	*/
    public function executeWidgetProducto( ){

    }

    /*
	* Panel agregar nuevas marcas para software
	* @author: Andres Botero
	*/
    public function executePanelProductos( ){

    }



}
?>