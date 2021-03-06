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
     *
     */

    public function executePanelReferencias() {

        $this->fala_headers = Doctrine::getTable("FalaHeaderAdu")
                        ->createQuery("d")
                        ->select("d.ca_iddoc, d.ca_referencia, d.ca_reqd_delivery, d.ca_procesado, i.ca_embarque")
                        ->addWhere("d.ca_fcharchivado is null")
                        ->leftJoin("d.FalaInstructionAdu i")
                        ->addOrderBy("d.ca_iddoc")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
    }

    /*
     * Accion por defecto
     */

    public function executePanelDeclaracion() {

        $this->referencia = $this->fala_declaracion["d_ca_referencia"];

        $this->fala_detallesimp = Doctrine::getTable("FalaDeclaracionDts")
                        ->createQuery("d")
                        ->where("d.ca_referencia = ?", $this->referencia)
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
    }

    /*
     *
     */

    public function executeMainPanel() {
        $this->header = Doctrine::getTable("FalaHeaderAdu")
                        ->createQuery("d")
                        ->select("d.ca_iddoc, d.ca_referencia, d.ca_reqd_delivery")
                        ->where("d.ca_iddoc = ? ", $this->fala_header->getCaIddoc())
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
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

        $this->referencia = $this->fala_declaracion["d_ca_referencia"];

        $this->data = Doctrine::getTable("FalaFacturacionAdu")
                        ->createQuery("d")
                        ->select("d.*")
                        ->where("d.ca_referencia = ?", $this->referencia)
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        $this->data[] = array("ca_numdocumento" => "", "orden" => "Z");
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
        $this->referencia = $this->fala_declaracion["d_ca_referencia"];

        $this->data = Doctrine::getTable("FalaNotaCab")
                        ->createQuery("d")
                        ->select("d.*")
                        ->where("d.ca_referencia = ?", $this->referencia)
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        $this->data[] = array("ca_numdocumento" => "", "orden" => "Z");
    }

    /*
     *
     */

    public function executePanelNotasDet() {
        $this->referencia = $this->fala_declaracion["d_ca_referencia"];

        $this->data = Doctrine::getTable("FalaNotaDet")
                        ->createQuery("d")
                        ->select("d.*")
                        ->where("d.ca_referencia = ?", $this->referencia)
                        ->addWhere("d.ca_numdocumento = ?", $this->numdocumento)
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        $this->data[] = array("ca_numdocumento" => "", "orden" => "Z");

        $this->conceptos = ParametroTable::retrieveByCaso("CU080");
    }

}

?>
