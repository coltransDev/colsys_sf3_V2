<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage clientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clientesComponents extends sfComponents {
    /*
     * Muestra un campo que permite autocompletar el nombre del cliente usando JSON y el id lo guarda 
      en el atributo id.
     */

    public function executeComboContactosClientes() {
        $response = sfContext::getInstance()->getResponse();

        $response->addJavascript('components/comboContactoClientes');
        if (!isset($this->id)) {
            $this->id = "idcontacto";
        }
        if ($this->idcontacto) {
            $this->contacto = ContactoPeer::retrieveByPk($this->idcontacto);
        }
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

    public function executeGridMandatosyPoderes(sfWebRequest $request) {
        $this->id = $request->getParameter("id");
        $this->idsserie = ($this->getRequestParameter("idsserie") != "") ? $this->getRequestParameter("idsserie") : "10";

        $cliente = Doctrine::getTable("Cliente")->find($this->id);
        $this->nombre_cliente = $cliente->getIds()->getCaNombre();

        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select ca_idciudad, ca_ciudad from tb_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Aéreo','Marítimo','Ambos')"
                . " order by ca_ciudad";
        $rs = $con->execute($sql);
        $ciudades_rs = $rs->fetchAll();
        $this->ciudades = array();
        foreach ($ciudades_rs as $ciudad) {
            $this->ciudades[] = array("idciudad" => $ciudad["ca_idciudad"], "ciudad" => utf8_encode($ciudad["ca_ciudad"]));
        }
    }

    public function executeGridTiposMandatos(sfWebRequest $request) {
        $parametrosClase = ParametroTable::retrieveByCaso("CU254");

        $this->clases = array();
        foreach ($parametrosClase as $parametroClase) {
            $this->clases[] = array("clase" => utf8_encode($parametroClase->getCaValor()));
        }
    }
    
    public function executeFormSubirArchivos(sfWebRequest $request) {
        $this->id = $request->getParameter("id");
        $this->idsserie = ($this->getRequestParameter("idsserie") != "") ? $this->getRequestParameter("idsserie") : "10";
    }

}

?>