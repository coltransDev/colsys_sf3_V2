<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage idgsistemas
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class idgsistemasComponents extends sfComponents {

    public function executeFormIndicadoresGestionPanel() {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last'); 
        
        $this->narea = $this->getRequestParameter("narea");
        $this->fechaInicial = $this->getRequestParameter("fechaInicial");
        $this->fechaFinal = $this->getRequestParameter("fechaFinal");
        $this->type_est = $this->getRequestParameter("type_est");
        $iddepartamento = $this->getRequestParameter("departamento");

        $user = sfContext::getInstance()->getUser();
        
        $usuario = Doctrine::getTable("Usuario")->find($user->getUserId());
        $depAdic = $usuario->getProperty("helpDesk");
        
        $departamentos = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->innerJoin("d.Usuario u")
                ->where("d.ca_inhelpdesk = ?", true)
                ->addWhere("u.ca_login = ?", $user->getUserId())
                ->orWhere("d.ca_nombre = ?", $depAdic)
                ->addOrderBy("d.ca_nombre ASC")
                ->execute();
        $this->departamentos = array();

        foreach ($departamentos as $departamento) {
            $this->departamentos[] = array("iddepartamento" => $departamento->getCaIddepartamento(),
                "nombre" => utf8_encode($departamento->getCaNombre())
            );
        }
        
        if($iddepartamento){
            $this->departamento = Doctrine::getTable("Departamento")->find($iddepartamento);
        }
    }
}
?>