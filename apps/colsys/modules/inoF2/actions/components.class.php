<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inoF2Components extends sfComponents
{
    
   public function executeMainPanel() {        
        $this->monedaLocal = $this->getUser()->getIdmoneda();
        $referencia = Doctrine::getTable("InoMaster")->find(12176);
        
    }
    
    public function executeGridFacturacion() {
        
    }
    
    public function executeGridHouse() {
        
    }
	
    public function executeGridCostos() {
        
    }
    
    public function executeFormBusqueda() {
        
    }
    
    public function executeFormMaster() {
        
    }
}
?>
