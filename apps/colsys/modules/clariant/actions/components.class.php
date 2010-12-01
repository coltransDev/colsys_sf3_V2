<?php

/**
 * clariant actions.
 *
 * @package    colsys
 * @subpackage clariant
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class clariantComponents extends sfComponents {

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

        $this->idclariant = $this->clariant[0]["d_ca_idclariant"];

        $this->details = Doctrine::getTable("ClarDetail")
                               ->createQuery("d")
                               ->select("d.*")
                               ->where("d.ca_idclariant = ? ", $this->idclariant)
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

        $this->idclariant = $this->clariant[0]["d_ca_idclariant"];

        $this->data = Doctrine::getTable("ClarFacturacion")
                                ->createQuery("d")
                                ->select("d.*")
                                ->where("d.ca_idclariant = ?", $this->idclariant)
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

        $this->idclariant = $this->clariant[0]["d_ca_idclariant"];

        $this->data = Doctrine::getTable("ClarNotaCab")
                                ->createQuery("d")
                                ->select("d.*")
                                ->where("d.ca_idclariant = ?", $this->idclariant)
                                ->setHydrationMode(Doctrine::HYDRATE_SCALAR )
                                ->execute();
        $this->data[] = array("ca_numdocumento"=>"", "orden"=>"Z");
        
    }

    /*
	*
	*/
	public function executePanelNotasDet() {
	
		$this->idclariant = $this->clariant[0]["d_ca_idclariant"];

		$this->data = Doctrine::getTable("ClarNotaDet")
								->createQuery("d")
								->select("d.*")
								->where("d.ca_idclariant = ?", $this->idclariant)
								->addWhere("d.ca_numdocumento = ?", $this->numdocumento)
								->setHydrationMode(Doctrine::HYDRATE_SCALAR )
								->execute();
		$this->data[] = array("ca_numdocumento"=>"", "orden"=>"Z");

		$this->conceptos = ParametroTable::retrieveByCaso("CU080");

	}
	
}
?>
