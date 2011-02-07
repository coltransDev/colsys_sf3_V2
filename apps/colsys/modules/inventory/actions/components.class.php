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
        $this->so_types = ParametroTable::retrieveByCaso("CU095");
        $this->office_types = ParametroTable::retrieveByCaso("CU096");


        /*$sucursales = Doctrine::getTable("Sucursal")
                                ->createQuery("s")
                                ->select("s.ca_nombre")
                                ->addOrderBy("s.ca_nombre")
                                ->addWhere("s.ca_idempresa = ?",  2)
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->distinct()
                                ->execute();*/

        $departamentos = Doctrine::getTable("Departamento")
                                ->createQuery("d")
                                ->select("d.ca_nombre")
                                ->addOrderBy("d.ca_nombre")
                                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                                ->execute();

        $this->ubicaciones = array();

        /*foreach( $sucursales as $sucursal ){
            $this->ubicaciones[] = $sucursal["ca_nombre"];
        }*/
        foreach( $departamentos as $departamento ){
            $this->ubicaciones[] = $departamento["ca_nombre"];
        }



    }

    /*
	* Panel de vista previa
	* @author: Andres Botero
	*/
    public function executePanelReading( ){
        $this->nivel = $this->getUser()->getNivelAcceso( inventoryActions::RUTINAINV );

        $this->editable = "false";

        if($this->nivel==1){

            $ususucursal = $this->getUser()->getIdSucursal();
            $categorias=Doctrine::getTable("InvCategory")->findBy("ca_parametro", $ususucursal);
            $id_cate="";
            foreach($categorias as $categoria)
            {
                $this->id_cate.=$categoria->getCaIdcategory().",";
            }
        }
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
        $this->nivel = $this->getUser()->getNivelAcceso( inventoryActions::RUTINAINV );

        $this->editable = "false";

        if($this->nivel>=1){
            $idcategory = $this->getRequestParameter("idcategory");

            $categoria = Doctrine::getTable("InvCategory")->find($idcategory);
            if(!$categoria)
                $categoria = new InvCategory();
            $sucursal = $categoria->getCaParametro();
            $ususucursal = $this->getUser()->getIdSucursal();
            //echo $ususucursal;
            if($sucursal==$ususucursal){
                $this->editable = "true";
            } 
        }

    }


    /*
	* Panel que permite asignar un activo a un suario
	* @author: Andres Botero
	*/
    public function executePanelAsignaciones( ){

    }




}
?>