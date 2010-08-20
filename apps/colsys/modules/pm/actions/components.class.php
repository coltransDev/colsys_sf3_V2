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

        $response->addJavaScript("extExtras/CheckColumn",'last');
        $response->addJavaScript("extExtras/GroupSummary",'last');
    }



    /*
	* Panel de tickets
	* @author: Andres Botero
	*/
    public function executePanelProyectos(  ){
    
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
    public function executeAsignarMilestoneWindow( ){

    }

    /*
	* Muestra una ventana para editar el ticket
	* @author: Andres Botero
	*/
    public function executeEditarTicketWindow( ){
        


    }


    /*
	* Formulario con lo datos del ticket
	* @author: Andres Botero
	*/
    public function executeEditarTicketPropiedadesPanel( ){
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


		$this->iddepartamento = $this->getUser()->getIddepartamento();

        $user = sfContext::getInstance()->getUser();

        $usersGroup = Doctrine::getTable("HdeskUserGroup")
                         ->createQuery("d")
                         ->where("d.ca_login = ?", $user->getUserId())
                         ->execute();
        $this->grupos = array();
        foreach( $usersGroup as $usersGroup ){
            $this->grupos[] = $usersGroup->getCaIdgroup();
        }
    }


    /*
	* Panel que muestra un panel dividido en dos partes, una con datos y otra con vista previa.
	* @author: Andres Botero
	*/
    public function executePanelReading( ){

    }

    /*
	* Ventana donde se crea una nueva respuesta
	* @author: Andres Botero
	*/
    public function executeNuevaRespuestaWindow( ){
        $parametros = ParametroTable::retrieveByCaso("CU088");

        $this->data = array();
        foreach($parametros as $parametro){
            $this->data[]=array("texto"=>  utf8_encode($parametro->getCaValor()));
        }
    }


    /*
	* Muestra los ultimos eventos dentro del programa
	* @author: Andres Botero
	*/
    public function executePanelEventos( ){



        


    }

    /*
	* Cronograma de trabajo de un miembro del equipo
	* @author: Andres Botero
	*/
    public function executePanelCalendar( ){

    }

	
	
}
?>