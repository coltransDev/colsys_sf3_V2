<?php

/**
 * homepage actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class adminUsersComponents extends sfComponents {
    /**
     * Componente que muestra las fechas de cumpleaños en la página principal
     *
     *
     */
    public function executeLoginInformation() {

        $this->user = sfContext::getInstance()->getUser();
        
        
    }


    public function executeDirectorio() {
        $this->idsucursal = $this->getUser()->getSucursal();

        
    }
    
    public function executeGridUsuarios() {
        
    }

}

