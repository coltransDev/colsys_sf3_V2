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

        $this->grupos = Doctrine::getTable("HdeskGroup")
                ->createQuery("g")
                ->select("g.ca_idgroup, g.ca_name")
                ->distinct()
                ->addOrderBy("g.ca_idgroup")
                ->where("g.ca_iddepartament=13")
                ->execute();
        
            
    }
    
    public function executeWidgetMultiGrupos() {
        
        $grupos = Doctrine::getTable("HdeskGroup")
                ->createQuery("g")
                ->select("g.ca_idgroup, g.ca_name")
                ->distinct()
                ->addOrderBy("g.ca_idgroup")
                ->where("g.ca_iddepartament=13")
                ->execute();
        
        $this->grupos = "[";
        $grtmp = "";
        foreach ($grupos as $grupo) {
            $grtmp.=($grtmp != "") ? "," : "";
            $grtmp.="['" . $grupo->getCaName() . "']";
        }
        $this->grupos.=$grtmp . "]";
        
        
    }
}
?>