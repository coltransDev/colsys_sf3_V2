<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage clientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class confirmacionesOtmComponents extends sfComponents {
    /*
     * Muestra un campo que permite autocompletar el nombre del cliente usando JSON y el id lo guarda 
      en el atributo id.
     */

    public function executeFormConfirmacion() {
        

        $tipos = array('Zona Franca', 'Zona Aduanera', 'Depósito Aduanero', 'Depósito Privado', 'Industria Militar', 'Zona Franca Bogota SA');

        $this->bodegas = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->select("b.*")
                ->whereIn("b.ca_tipo", $tipos)
                ->addOrderBy("b.ca_tipo")
                ->addOrderBy("b.ca_nombre")
                ->execute();


        /*$this->fijos = Doctrine::getTable("Contacto")
                ->createQuery("c")
                ->addWhere("c.ca_idcliente = ?", $this->cliente->getCaIdcliente())
                ->addWhere("ca_fijo = ?", true)
                ->addWhere("ca_cargo != ?", 'Extrabajador')
                ->execute();*/
        
        $this->fijos = $this->reporte->getContacto('1');
        
        /* $this->fijos = array();
          foreach( $fijos as $fijo  ){
          $this->fijos[] = $fijo->getCaEmail();
          } */
        //$this->fijos = array_unique( $this->fijos );
    }

    public function executeComboConsignatario() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavascript('components/comboConsignatario');

        if ($this->idtercero) {
            $this->tercero = TerceroPeer::retrieveByPk($this->idtercero);
        }
    }

    public function executeComboNotify() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavascript('components/comboNotify');

        if ($this->idtercero) {
            $this->tercero = TerceroPeer::retrieveByPk($this->idtercero);
        }
    }

    public function executeNotClientes() {
        
    }

    public function executeNotPlanilla() {
        
    }

    public function executeUploadClientes() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("swfupload/swfupload", 'last');
        $response->addJavaScript("swfupload/js/handlers", 'last');
    }
}
?>