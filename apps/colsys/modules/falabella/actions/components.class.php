<?php

/**
 * falabella actions.
 *
 * @package    colsys
 * @subpackage falabella
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class falabellaComponents extends sfComponents {

	/*
	* Accion por defecto
	*/
	public function executePanelDetalles() {
		//$this->details = $this->fala_header->getFalaDetail();

        $this->details = Doctrine::getTable("FalaDetail")
                                   ->createQuery("d")
                                   ->select("d.*")
                                   ->where("d.ca_iddoc = ? ", $this->fala_header->getCaIddoc())
                                   ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                   ->execute();
	}

	
}
?>
