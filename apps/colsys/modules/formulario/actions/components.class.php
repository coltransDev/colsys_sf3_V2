<?php

/**
 * formulario actions.
 *
 * @package    colsys
 * @subpackage formulario
 * @author     Andrea Ramírez
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class formularioComponents extends sfComponents {
    /*
     *   Carga el Registro de la Cabecera
     */
    public function executeFormMenuEstadisticas($request) {

        $response = sfContext::getInstance()->getResponse();
        $response->removeStylesheet("formulario_home.css");
        
        try {
            error_reporting(E_ALL);
            $servicios = Doctrine::getTable("Opcion")->createQuery("o")
                    ->select("o.ca_texto, o.ca_id")
                    ->leftJoin("o.Pregunta p")
                    ->leftJoin("p.Bloque b")
                    ->leftJoin("b.Formulario f")
                    ->where("f.ca_id = ?", $this->idFormulario)
                    ->addWhere("p.ca_activo = ?", '1')
                    ->addWhere("b.ca_tipo != ?", '0')
                    ->execute();

            $this->servicios = array();
            foreach ($servicios as $servicio) {
                $this->servicios[] = array("idservicio" => $servicio->getCaId(), "nombre" => utf8_encode($servicio->getCaTexto()));
            }
            
            $preguntas = Doctrine::getTable("Pregunta")->createQuery("p")
                    ->select("p.ca_id, p.ca_texto")
                    ->leftJoin("p.Bloque b")
                    ->leftJoin("b.Formulario f")
                    ->where("f.ca_id = ?", $this->idFormulario)
                    ->addWhere("p.ca_activo = ?", '1')
                    ->addWhere("b.ca_tipo != ?", '1')
                    ->addOrderBy("p.ca_texto")                    
                    ->execute();

            $this->preguntas = array();
            foreach ($preguntas as $pregunta) {                
                $this->preguntas[] = array("idpregunta" => $pregunta->getCaId(), "nombre" => utf8_encode($pregunta->getCaTexto()));
            }
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public function executeReportePorServicio($request) {
        
    }

    public function executeReportePorSucursal($request) {
        
    }

    public function executeReporteEncuestas($request) {
        
    }
    
    public function executeReportePorSucursalServicio($request) {
        
    }
    
    public function executeReportePorNumSucursalServicio($request) {
        
    }
    
    public function executeReportePorPregunta($request) {
        
    }
    
    public function executeNuevoSeguimientoWindow( ){
        
    }
}
?>
