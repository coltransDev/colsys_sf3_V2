<?php

/**
 * gincomex actions.
 *
 * @package    colsys
 * @subpackage gincomex
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class gincomexComponents extends sfComponents {

    /*
    *
    */
    public function executeMainPanel()
    {
    }


    /*
    * Accion por defecto
    */
    public function executePanelDetalles() {

        $this->idgincomex = $this->gincomex[0]["d_ca_idgincomex"];

        $this->details = Doctrine::getTable("ClarDetail")
                               ->createQuery("d")
                               ->select("d.*")
                               ->where("d.ca_idgincomex = ? ", $this->idgincomex)
                               ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                               ->execute();
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

        $this->idgincomex = $this->gincomex[0]["d_ca_idgincomex"];

        $this->data = Doctrine::getTable("ClarFacturacion")
                                ->createQuery("d")
                                ->select("d.*")
                                ->where("d.ca_idgincomex = ?", $this->idgincomex)
                                ->setHydrationMode(Doctrine::HYDRATE_SCALAR )
                                ->execute();
        $this->data[] = array("ca_numdocumento"=>"", "orden"=>"Z");

    }


    /*
    *
    */
    public function executePanelNotas() {

    }


    /*
    *
    */
    public function executePanelNotasCab() {

        $this->idgincomex = $this->gincomex[0]["d_ca_idgincomex"];

        $this->data = Doctrine::getTable("ClarNotaCab")
                                ->createQuery("d")
                                ->select("d.*")
                                ->where("d.ca_idgincomex = ?", $this->idgincomex)
                                ->setHydrationMode(Doctrine::HYDRATE_SCALAR )
                                ->execute();
        $this->data[] = array("ca_numdocumento"=>"", "orden"=>"Z");
        
    }

    /*
	*
	*/
	public function executePanelNotasDet() {
	
		$this->idgincomex = $this->gincomex[0]["d_ca_idgincomex"];

		$this->data = Doctrine::getTable("ClarNotaDet")
								->createQuery("d")
								->select("d.*")
								->where("d.ca_idgincomex = ?", $this->idgincomex)
								->addWhere("d.ca_numdocumento = ?", $this->numdocumento)
								->setHydrationMode(Doctrine::HYDRATE_SCALAR )
								->execute();
		$this->data[] = array("ca_numdocumento"=>"", "orden"=>"Z");

		$this->conceptos = ParametroTable::retrieveByCaso("CU080");

	}
	
}
?>
