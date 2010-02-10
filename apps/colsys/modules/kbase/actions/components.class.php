<?php

/**
 * kbase components.
 *
 * @package    colsys
 * @subpackage kbase
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class kbaseComponents extends sfActions
{
	const RUTINA = "38";

    /*
    *  Genera los tooltips para una categoria determinada de acuerdo al id
    *  de cada campo
    */
    public function executeTooltipById(){
        $this->issues = Doctrine::getTable("KBTooltip")
                            ->createQuery("t")
                            ->select("t.ca_idcategory, t.ca_title, t.ca_info, t.ca_field_id")
                            ->where("t.ca_idcategory = ?", $this->idcategory)
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();
    }


    /*
    *  Añade eventos a los campos para crear los tooltips
    */
    public function executeTooltipCreator(){

    }
    /*
    *  Crea una ventana para que el usuario ingrese un nuevo tooltip
    */
    public function executeTooltipWindow(){
        
    }	
}
?>