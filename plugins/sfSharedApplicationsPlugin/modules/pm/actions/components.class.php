<?php

/**
 * pm components.
 *
 * @package    colsys
 * @subpackage pm
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pmComponents extends sfComponents {
    /*
     * Muestra las referencias que el usuario ha buscado
     * @author: Andres Botero
     */

    public function executeListaRespuestasTicket() {

        $this->ticket = Doctrine::getTable("HdeskTicket")->find($this->idticket);

        $this->responses = Doctrine::getTable("HdeskResponse")
                ->createQuery("r")
                ->where("r.ca_idticket = ? ", $this->idticket)
                ->addWhere("r.ca_responseto IS NULL ")
                ->addOrderBy("r.ca_createdat ASC")
                ->addOrderBy("r.ca_idresponse ASC")
                ->execute();

        $this->idLastResponse = Doctrine::getTable("HdeskResponse")
                ->createQuery("r")
                ->select("r.ca_idresponse")
                ->where("r.ca_idticket = ? ", $this->idticket)
                ->addOrderBy("r.ca_createdat DESC")
                ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                ->execute();

        $parametros = ParametroTable::retrieveByCaso("CU110");
        $status = array();
        foreach ($parametros as $p) {
            $status[$p->getCaIdentificacion()] = array("nombre" => utf8_encode($p->getCaValor()), "color" => $p->getCaValor2());
        }

        $this->status_name = isset($status[$this->ticket->getCaStatus()]) ? utf8_encode($status[$this->ticket->getCaStatus()]["nombre"]) : "";
    }

    /*
     * PanelConsultaTickets
     * @author: Andres Botero
     */
    public function executeMainPanel(){
        
        $usuario = Doctrine::getTable("Sucursal")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $departamentos = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->where("d.ca_inhelpdesk = ?", true)
                ->andWhereIn("d.ca_idempresa", $grupoEmp)
                ->execute();

        $this->departamentos = array();
        foreach ($departamentos as $departamento) {
            $this->departamentos[] = array("iddepartamento" => $departamento->getCaIddepartamento(),
                "nombre" => $departamento->getCaNombre()
            );
        }
    }
    /*
     * Panel de tareas asignadas a los usuarios
     * @author: Andres Botero
     */

    public function executePanelTareas() {
        
    }

    /*
     * Panel de tickets
     * @author: Andres Botero
     */

    public function executePanelTickets() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/RowExpander", 'last');

        $response->addJavaScript("extExtras/GridFilters", 'last');
        $response->addJavaScript("extExtras/menu/ListMenu", 'last');
        $response->addJavaScript("extExtras/menu/RangeMenu", 'last');
        $response->addJavaScript("extExtras/filters/Filter", 'last');
        $response->addJavaScript("extExtras/filters/StringFilter", 'last');
        $response->addJavaScript("extExtras/filters/DateFilter", 'last');
        $response->addJavaScript("extExtras/filters/ListFilter", 'last');
        $response->addJavaScript("extExtras/filters/NumericFilter", 'last');
        $response->addJavaScript("extExtras/filters/BooleanFilter", 'last');

        $response->addStyleSheet("extExtras/GridFilters", 'last');
        $response->addStyleSheet("extExtras/RangeMenu", 'last');

        $response->addJavaScript("extExtras/CheckColumn", 'last');
        $response->addJavaScript("extExtras/StatusBar", 'last');
        $response->addJavaScript("extExtras/GroupSummary", 'last');
    }

    /*
     * Panel de tickets
     * @author: Andres Botero
     */

    public function executePanelProyectos() {
        
    }

    /*
     * Panel que permite agregar y editar puntos de entrega a un proyecto
     * @author: Andres Botero
     */

    public function executePanelMilestones() {
        
    }

    /*
     * Panel que permite agregar y editar puntos de entrega a un proyecto
     * @author: Andres Botero
     */

    public function executePanelDetalleTicket() {
        
        $usuario = Doctrine::getTable("Sucursal")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();

        $departamentos = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->where("d.ca_inhelpdesk = ?", true)
                ->andWhereIn("d.ca_idempresa", $grupoEmp)
                ->execute();

        $this->departamentos = array();

        foreach ($departamentos as $departamento) {
            $this->departamentos[] = array("iddepartamento" => $departamento->getCaIddepartamento(),
                "nombre" => $departamento->getCaNombre()
            );
        }
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executePanelConsulta() {
        
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executeAsignarMilestoneWindow() {
        
    }

    /*
     * Muestra una ventana para editar el ticket
     * @author: Andres Botero
     */

    public function executeEditarTicketWindow() {
        
    }

    /*
     * Muestra un tabpanel con los datos de los tickets
     * @author: Andres Botero
     */

    public function executePanelPreviewTicket() {
        
    }

    /*
     * Formulario con lo datos del ticket
     * @author: Andres Botero
     */

    public function executeEditarTicketPropiedadesPanel() {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/FileUploadField", 'last');

        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $this->grupoEmp = $usuario->getGrupoEmpresarial();

        $departamentos = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->where("d.ca_inhelpdesk = ?", true)
                ->leftJoin("d.Empresa e")
                ->orderBy("e.ca_nombre, d.ca_nombre")
                //->andWhereIn("d.ca_idempresa", $grupoEmp)
                ->execute();
        $this->departamentos = array();

        foreach ($departamentos as $departamento) {
            $this->departamentos[] = array( "iddepartamento" => $departamento->getCaIddepartamento(),
                                            "nombre" => utf8_encode($departamento->getCaNombre()), 
                                            "idempresa"=>$departamento->getCaIdempresa(),
                                            "empresa"=>utf8_encode($departamento->getEmpresa()->getCaNombre())
            );
        }

        $this->iddepartamento = $this->getUser()->getIddepartamento();

        $user = sfContext::getInstance()->getUser();

        $usersGroup = Doctrine::getTable("HdeskUserGroup")
                ->createQuery("d")
                ->where("d.ca_login = ?", $user->getUserId())
                ->execute();
        $this->grupos = array();

        foreach ($usersGroup as $usersGroup) {
            $this->grupos[] = $usersGroup->getCaIdgroup();
        }

        $this->reportedThroughtParams = ParametroTable::retrieveByCaso("CU094");

        $this->status = array();

        $params = ParametroTable::retrieveByCaso("CU110");
        foreach ($params as $p) {
            $row = array("status" => utf8_encode($p->getCaIdentificacion()), "valor" => $p->getCaValor());
            $this->status[] = $row;
        }

        $this->empresas = array();

        $empresas = Doctrine::getTable('Empresa')->findAll();
        foreach ($empresas as $e) {
            if ($e->getCaIdempresa()) {
                $row = array("idempresa" => $e->getCaIdempresa(), "nombre" => utf8_encode($e->getCaNombre()));
                $this->empresas[] = $row;
            }
        }
    }

    /*
     * Panel que muestra un panel dividido en dos partes, una con datos y otra con vista previa.
     * @author: Andres Botero
     */

    public function executePanelReading() {
        
    }

    /*
     * Panel que muestra una grilla para incorporar documentos asociados a un caso de auditoría.
     * @author: Carlos G. López M.
     */

    public function executePanelDocumentos() {

        $this->tipos = array();
        $params = ParametroTable::retrieveByCaso("CU054");
        foreach ($params as $p) {
            $row = array("tipo" => $p->getCaIdentificacion(), "valor" => utf8_encode($p->getCaValor()));
            $this->tipos[] = $row;
        }
    }

    /*
     * Ventana donde se crea una nueva respuesta
     * @author: Andres Botero
     */

    public function executeNuevaRespuestaWindow() {
        $parametros = ParametroTable::retrieveByCaso("CU088");

        $this->data = array();
        foreach ($parametros as $parametro) {
            $this->data[] = array("texto" => utf8_encode($parametro->getCaValor()));
        }

        $this->status = array();
        $params = ParametroTable::retrieveByCaso("CU110");
        foreach ($params as $p) {
            $row = array("status" => $p->getCaIdentificacion(), "valor" => utf8_encode($p->getCaValor()));
            $this->status[] = $row;
        }
    }

    /*
     * Muestra los ultimos eventos dentro del programa o muestra
     * los resultados de las busquedas
     * @author: Andres Botero
     */

    public function executePanelBusquedaTicket() {
        
    }

    /*
     * Cronograma de trabajo de un miembro del equipo
     * @author: Andres Botero
     */

    public function executePanelCalendar() {
        
    }

    /*
     * Busqueda de tickets
     * @author: Andres Botero
     */

    public function executeBusquedaTicketWindow() {
        
    }

    /*
     * 
     * @author: Andres Botero
     */

    public function executeWidgetBusquedaTicket() {
        
    }

    /*
     * Actualiza el porcentaje a un ticket
     * @author: Andres Botero
     */

    public function executePorcentajeTicketWindow() {
        
    }

    /*
     * 
     * @author: Andres Botero
     */

    public function executePanelTicketsActivos() {
        
    }

    /*
     * Muestra las referencias que el usuario ha buscado
     * @author: Andres Botero
     */

    public function executeWidgetAsignaciones() {
        
    }

    public function executeWidgetGrupos() {
        $this->grupos = Doctrine::getTable("HdeskGroup")
                ->createQuery("g")
                ->select("g.ca_idgroup, g.ca_name")
                ->distinct()
                ->addOrderBy("g.ca_idgroup")
                ->where("g.ca_iddepartament=13")
                ->execute();
    }

    public function executeWidgetDepartamentos() {

        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();

        $departamentos = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->where("d.ca_inhelpdesk = ?", true)
                ->andWhereIn("d.ca_idempresa", $grupoEmp)
                ->execute();


        $this->departamentos = array();

        foreach ($departamentos as $departamento) {
            $this->departamentos[] = array("iddepartamento" => $departamento->getCaIddepartamento(),
                "nombre" => $departamento->getCaNombre()
            );
        }
    }
}
?>