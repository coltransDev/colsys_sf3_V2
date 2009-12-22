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
        

        $this->fala_detallesimp = Doctrine::getTable("FalaDeclaracionDts")
            -> createQuery("d")
            ->where ( "d.ca_referencia = ?", $this->fala_declaracion["d_ca_referencia"]  )
            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
            ->execute();

       
	}

    /*
	*
	*/
	public function executeMainPanel() {
		
	}

    

    /*
	*
	*/
	public function executeTopPanel() {
            
	}

    /*
	*
	*/
	public function executeSubPanel() {

	}

    /*
	*
	*/
	public function executePanelFacturacion() {
        $this->data = array();
        

        $this->referencia = $this->fala_declaracion["d_ca_referencia"];
        $this->data[] = array("numdocumento"=>"");
	}

    /*
	*
	*/
	public function executePanelNotas() {

	}
	
}
?>
