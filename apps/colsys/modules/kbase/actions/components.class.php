<?php

/**
 * kbase components.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class kbaseComponents extends sfComponents
{
	const RUTINA = "38";

    /*
    *  Genera los tooltips para una categoria determinada de acuerdo al id
    *  de cada campo
    */
    public function executeTooltipById(){
        $this->issues = Doctrine::getTable("KBTooltip")
                            ->createQuery("t")
                            ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                            ->where("t.ca_idcategory = ?", $this->idcategory)
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();
    }


    /*
    *  Añade eventos a los campos para crear los tooltips
    */
    public function executeTooltipCreator(){

    }
    /*
    *  Crea una ventana para que el usuario ingrese un nuevo tooltip
    */
    public function executeTooltipWindow(){
        
    }



    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executePanelCategorias( ){

    }

    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executePanelIssues( ){
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
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executePanelReading( ){

    }


    /*
	* Panel que muestra un arbol con opciones de busqueda
	* @author: Andres Botero
	*/
    public function executePanelCategoriaWindow( ){

    }




}
?>