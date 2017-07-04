<?php

/**
 * crm actions.
 *
 * @package    symfony
 * @subpackage crm
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class crmComponents extends sfComponents {

    /**
     * 
     *
     * 
     */
    public function executeClienteFormPanel() {
        $this->login = $this->getUser()->getUserId();

        if ($this->getUser()->getIdtrafico() == "PE-051") {
            $this->tipoIdentificacionId = 4;
        } else {
            $this->tipoIdentificacionId = 1;
        }
    }

    public function executeMainPanel() {
        
    }

}
