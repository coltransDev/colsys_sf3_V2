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

        $sql = "select ca_idciudad, ca_ciudad from tb_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('A�reo','Mar�timo','Ambos')"
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

    public function executeFormAgaduanaAutorizado(sfWebRequest $request) {
        $this->idcliente = $request->getParameter("idcliente");
        $cliente = Doctrine::getTable("IdsCliente")->find($this->idcliente);
        $this->razonSocial = utf8_encode($cliente->getIds()->getCaNombre());
    }

    public function executeFormSubirArchivoAgente(sfWebRequest $request) {
        $this->id = $request->getParameter("id");
        $this->idsserie = ($this->getRequestParameter("idsserie") != "") ? $this->getRequestParameter("idsserie") : "11";
    }

    public function executeFormEncuestaVisita(sfWebRequest $request) {
        $this->idcliente = $request->getParameter("idcliente");

        $cliente = Doctrine::getTable("Cliente")->find($this->idcliente);
        $contactos = $cliente->getContacto();

        $this->concliente = array();
        foreach ($contactos as $contacto) {
            $this->concliente[] = array("idcontacto" => $contacto->getCaIdcontacto(),
                "nombre" => utf8_encode(strtoupper($contacto->getNombre())));
        }
    }

    public function executeFormControlFinanciero(sfWebRequest $request) {
        $this->idcliente = $request->getParameter("idcliente");
        $cliente = Doctrine::getTable("IdsCliente")->find($this->idcliente);
        $this->razonSocial = utf8_encode($cliente->getIds()->getCaNombre());
        $anioactual = date("Y");
        $minimo = Doctrine::getTable("Smlv")
                ->createQuery("d")
                ->where("d.ca_anno = ?", $anioactual)
                ->fetchOne();

        $this->minimo = $minimo->getCaSmlv();

        $aniopasado = date("Y") - 1;
        $anioantepasado = date("Y") - 2;
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select  sum(ca_utilidad)+sum(ca_sobreventa) as ca_ino
                from vi_repgerencia_sea
                where ca_idcliente = " . $cliente->getCaIdcliente() . "  and ca_ano in ('" . $aniopasado . "','" . $anioantepasado . "')";

        $rs = $con->execute($sql);
        $maritimo = $rs->fetch();

        $sql = "select  sum(ca_utilidad) as ca_ino
                from vi_repgerencia_air
                where ca_idcliente = " . $cliente->getCaIdcliente() . "  and ca_ano in ('" . $aniopasado . "','" . $anioantepasado . "')";

        $rs = $con->execute($sql);
        $aereo = $rs->fetch();

        $this->data = array("idcliente" => $cliente->getCaIdcliente(),
            "fchcircular" => $cliente->getCaFchcircular(),
            "nvlriesgo" => utf8_encode($cliente->getCaNvlriesgo()),
            "leyinsolvencia" => utf8_encode($cliente->getCaLeyinsolvencia()),
            "comentario" => utf8_encode($cliente->getCaComentario()),
            "listaclinton" => utf8_encode($cliente->getCaListaclinton()),
            "tipo" => utf8_encode($cliente->getCaTipo()),
            "iso" => utf8_encode($cliente->getCaIso()),
            "iso_detalles" => utf8_encode($cliente->getCaIsoDetalles()),
            "basc" => utf8_encode($cliente->getCaBasc()),
            "otro_cert" => utf8_encode($cliente->getCaOtroCert()),
            "otro_detalles" => utf8_encode($cliente->getCaOtroDetalles()),
            "tipopersona" => utf8_encode($cliente->getCaTipopersona()),
            "sectoreconomico" => utf8_encode($cliente->getCaSector()),
            "fechaconstitucion" => utf8_encode($cliente->getCaFchconstitucion()),
            "grancontribuyente" => utf8_encode($cliente->getCaGrancontribuyente()),
            "uap" => utf8_encode($cliente->getCaUap()),
            "activostotales" => utf8_encode($cliente->getCaActivostotales()),
            "activoscorrientes" => utf8_encode($cliente->getCaActivoscorrientes()),
            "pasivostotales" => utf8_encode($cliente->getCaPasivostotales()),
            "pasivoscorrientes" => utf8_encode($cliente->getCaPasivoscorrientes()),
            "inventarios" => utf8_encode($cliente->getCaInventarios()),
            "patrimonios" => utf8_encode($cliente->getCaPatrimonios()),
            "utilidades" => utf8_encode($cliente->getCaUtilidades()),
            "ino" => ($aereo["ca_ino"] + $maritimo["ca_ino"]),
            "ventas" => utf8_encode($cliente->getCaVentas()));

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select cv.* from control.tb_config_values cv inner join control.tb_config cf on cf.ca_idconfig = cv.ca_idconfig where ca_param = 'CU257'";
        $rs = $con->execute($sql);
        $sectoresfinancieros_rs = $rs->fetchAll();
        $this->sectorfinanciero = array();
        foreach ($sectoresfinancieros_rs as $sector) {
            $this->sectorfinanciero[] = array("sector" => utf8_encode($sector["ca_value"]), "id" => utf8_encode($sector["ca_ident"]));
        }

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select cv.* from control.tb_config_values cv inner join control.tb_config cf on cf.ca_idconfig = cv.ca_idconfig where ca_param = 'CU227' order by ca_ident";
        $rs = $con->execute($sql);
        $tipopersona_rs = $rs->fetchAll();
        $this->tipopersona = array();
        foreach ($tipopersona_rs as $persona) {
            $this->tipopersona[] = array("tipo" => utf8_encode($persona["ca_value"]), "id" => utf8_encode($persona["ca_ident"]));
        }
    }

    public function executeFormFichaTecnica(sfWebRequest $request) {
        $this->idcliente = $request->getParameter("idcliente");
        $fichatecnica = Doctrine::getTable("FichaTecnica")
                ->createQuery("d")
                ->where("d.ca_idcliente = ?", $this->idcliente)
                ->fetchOne();
        if ($fichatecnica) {
            $this->documentacion = $fichatecnica->getCaDocumentacion();
            $this->transporte = $fichatecnica->getCaTransporteinternacional();
        }
    }

}

?>