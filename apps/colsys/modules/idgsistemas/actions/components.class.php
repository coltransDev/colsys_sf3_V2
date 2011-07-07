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


        $this->grupos = Doctrine::getTable("HdeskGroup")
                ->createQuery("g")
                ->select("g.ca_idgroup, g.ca_name")
                ->distinct()
                ->addOrderBy("g.ca_idgroup")
                ->where("g.ca_iddepartament=13")
                ->execute();
        
            
    }
}
?>