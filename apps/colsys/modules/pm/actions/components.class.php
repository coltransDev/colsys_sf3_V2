<?php

/**
 * pm components.
 *
 * @package    colsys
 * @subpackage pm
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pmComponents extends sfComponents
{
	/*
	* Muestra las referencias que el usuario ha buscado
	* @author: Andres Botero
	*/
	public function executeListaRespuestasTicket(){				

        $this->responses = Doctrine::getTable("HdeskResponse")
                           ->createQuery("r")
                           ->where("r.ca_idticket = ? ", $this->idticket )
                           ->addOrderBy("r.ca_createdat ASC")
                           ->addOrderBy("r.ca_idresponse ASC")
                           ->execute();
	}

    /*
	* PanelConsultaTickets
	* @author: Andres Botero
	*/
    public function executeMainPanel(){
        $departamentos = Doctrine::getTable("Departamento")
                         ->createQuery("d")
                         ->where("d.ca_inhelpdesk = ?", true)
                         ->execute();


		$this->departamentos = array();

		foreach( $departamentos as $departamento ){
			$this->departamentos[] = array("iddepartamento"=>$departamento->getCaIddepartamento(),
										 "nombre"=>$departamento->getCaNombre()
										);
		}
    }

    /*
	* Panel de tareas asignadas a los usuarios
	* @author: Andres Botero
	*/
    public function executePanelTareas(){
        
    }


    /*
	* Panel de tickets
	* @author: Andres Botero
	*/
    public function executePanelTickets(){
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
	* Panel de tickets
	* @author: Andres Botero
	*/
    public function executePanelProyectos(  ){

        if( !$this->project ){
            throw new Exception("project es requerido en PanelProyectos");
        }

        $this->numtickets = Doctrine::getTable("HdeskProject")
                  ->createQuery("p")
                  ->select("p.*, (SELECT COUNT(*) FROM HdeskTicket ta WHERE ta.ca_idproject = p.ca_idproject AND ta.ca_action ='Abierto') as ta, (SELECT COUNT(*) FROM HdeskTicket tc WHERE tc.ca_idproject = p.ca_idproject AND tc.ca_action ='Cerrado') as tc")
                  ->where("p.ca_idproject = ? ", $this->project->getCaIdproject() )
                  ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                  ->fetchOne();

    }


    /*
	* Panel que permite agregar y editar puntos de entrega a un proyecto
	* @author: Andres Botero
	*/
    public function executePanelMilestones( ){

    }


    /*
	* Panel que permite agregar y editar puntos de entrega a un proyecto
	* @author: Andres Botero
	*/
    public function executePanelDetalleTicket( ){
        $departamentos = Doctrine::getTable("Departamento")
                         ->createQuery("d")
                         ->where("d.ca_inhelpdesk = ?", true)
                         ->execute();


		$this->departamentos = array();

		foreach( $departamentos as $departamento ){
			$this->departamentos[] = array("iddepartamento"=>$departamento->getCaIddepartamento(),
										 "nombre"=>$departamento->getCaNombre()
										);
		}
    }

	
	
}
?>