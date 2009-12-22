<?php

/**
 * falabellaAdu actions.
 *
 * @package    colsys
 * @subpackage falabellaAdu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class falabellaAduComponents extends sfComponents {

	/*
	* Accion por defecto
	*/
	public function executePanelDetalles() {
		//$this->details = $this->fala_header->getFalaDetail();

            $this->details = Doctrine::getTable("FalaDetailAdu")
                                   ->createQuery("d")
                                   ->select("d.*")
                                   ->where("d.ca_iddoc = ? ", $this->fala_header->getCaIddoc())
                                   ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                   ->execute();
            $this->unidades = ParametroTable::retrieveByCaso("CU078");
	}

	/*
	* Accion por defecto
	*/
	public function executePanelDeclaracion() {

	}

    /*
	*
	*/
	public function executeMainPanel() {
		
	}

    /*
	*
	*/
	public function executeSubPanel() {
        
	}

    /*
	*
	*/
	public function executeTopPanel() {
            
	}
	
}
?>
