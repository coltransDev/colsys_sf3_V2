<?php

/**
 * pm components.
 *
 * @package    colsys
 * @subpackage tasks
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tasksComponents extends sfComponents
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
    public function executePanelTareas( ){
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

        $response->addJavaScript("extExtras/CheckColumn",'last');
        $response->addJavaScript("extExtras/GroupSummary",'last');
    }

    
    /*
    *  Editar una tarea, coloca asignaciones y alarmas
    */
    public function executeEditarTareaWindow( ){

    }
    
    /*
    *  Edita las propiedades de la tarea
    */
    public function executeEditarTareaPropiedadesPanel( ){

    }

    /*
    *  coloca asignaciones
    */
    public function executeEditarTareaAsignacionesPanel( ){

    }

    /*
    *  coloca alarmas
    */
    public function executeEditarTareaAlarmasPanel( ){

    }

    
  
	
	
}
?>