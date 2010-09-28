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
	* Panel de vista previa
	* @author: Andres Botero
	*/
    public function executePanelReading( ){

    }

    /*
	* Ventana que permite agregar un nuevo seguimiento
	* @author: Andres Botero
	*/
    public function executeNuevoSeguimientoWindow( ){

    }

    /*
	* Ventana que permite  editar las categorias
	* @author: Andres Botero
	*/
    public function executePanelCategoriaWindow( ){

    }


    /*
	* Panel que permite asignar un activo a un suario
	* @author: Andres Botero
	*/
    public function executePanelAsignaciones( ){

    }




}
?>