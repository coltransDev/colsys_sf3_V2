<?php

/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * ino components.
 *
 * @package    colsys
 * @subpackage ino
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inoComponents extends sfComponents {
    /*
     * Este panel contiene todos los tabs de la aplicación.
     */

    public function executeMainPanel() {
        
    }

    /*
     * Formulario para ingresar los datos del master
     */

    public function executeFormMasterPanel() {
        
    }

    /*
     * Formulario para ingresar los datos del house
     */

    public function executeFormHousePanel() {

    }

    /*
     * Grid que muestra los house de la referencia
     */

    public function executeGridHousePanel() {
        
    }

    /*
     * Grid que muestra las facturas de la referencia
     */

    public function executeGridFacturacionPanel() {
        
    }

    /*
     * Ventana para editar encabezado factura
     */
    public function executeGridFacturacionWindow() {

    }

    /*
     * Ventana para editar encabezado factura
     */
    public function executeGridFacturacionFormPanel() {
        $q = Doctrine::getTable("InoTipoComprobante")
                        ->createQuery("t")
                        ->select("t.ca_idtipo, t.ca_tipo, t.ca_comprobante, t.ca_titulo, e.ca_sigla")
                        //->innerJoin("t.IdsSucursal s")
                        //->innerJoin("s.Ids i")
                        //->innerJoin("s.Empresa e")
                        ->addWhere("t.ca_tipo = ?", "F")
                        ->addOrderBy("t.ca_tipo, t.ca_comprobante");
        

        if (isset($this->empresa) && $this->empresa ) {
            //$q->addWhere("e.ca_sigla = ?", $this->empresa);
        }
                
        $tipos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();
        
        $tiposArray = array();
        foreach ($tipos as $tipo) {
            $tipoStr = "";
            if (!isset($this->empresa)) {
                //$tipoStr .= $tipo["e_ca_sigla"] . " » ";
            }
            $tipoStr .= $tipo["t_ca_tipo"] . "-" . str_pad($tipo["t_ca_comprobante"], 2, "0", STR_PAD_LEFT) . " " . $tipo["t_ca_titulo"];
            $tiposArray[] = array("idtipo" => $tipo["t_ca_idtipo"], "tipo" => utf8_encode($tipoStr));
        }

        $this->tipos = array("root" => $tiposArray, "total" => count($tiposArray));


        
        $inoHouses = Doctrine::getTable("InoHouse")
                             ->createQuery("c")
                             ->select("c.*, cl.*")
                             //->innerJoin("c.Ids cl")
                             ->innerJoin("c.Cliente cl")
                             ->leftJoin( "c.InoComprobante comp" )
                             ->leftJoin( "comp.InoTipoComprobante tcomp" )
                             ->where("c.ca_idmaster = ?", $this->referencia->getCaIdmaster())
                             ->addOrderBy( "cl.ca_compania" )
                             ->execute();
                            

        $data = array();

        foreach( $inoHouses as $inoHouse ){
            $row = array();
            $row["idmaster"] = $inoHouse->getCaIdmaster();
            $row["idhouse"] = $inoHouse->getCaIdhouse();
            $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
            $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
            $row["value"] =  utf8_encode($inoHouse->getCaDoctransporte())." ".utf8_encode($inoHouse->getCliente()->getCaCompania());
            $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
            $data[] = $row;
        }

        $this->inoHouses = array("root" => $data, "total" => count($data));
    }

    /*
     * Grid que muestra las facturas de compra de la referencia
     */

    public function executeGridCostosPanel() {
        
    }

    /*
     * Grid que muestra las facturas de compra de la referencia
     */
    

    public function executeEditCostosWindow() {
        $this->conceptos = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->select("ca_idconcepto,ca_concepto, cc.ca_idccosto, cc.ca_centro, cc.ca_subcentro, cc.ca_nombre")
                        ->innerJoin("c.InoParametroFacturacion p")
                        ->innerJoin("p.InoCentroCosto cc")
                        //->innerJoin("cc.CentroCosto cp")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m")
                        //->addWhere("c.ca_tipo = ? ", Constantes::RECARGO_LOCAL )
                        ->addWhere("p.ca_idcuenta IS NOT NULL")
                        //->addWhere("m.ca_impoexpo LIKE ? ", $impoexpo )
                        //->addWhere("m.ca_transporte LIKE ? ", $this->reporte->getCaTransporte() )
                        ->addOrderBy("c.ca_concepto")
                        ->distinct()
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
    }
    
    
    
    /*
     * Cuadro de eventos de auditoria
     */
    public function executeGridDeduccionesPanel() {

    }
    
    
    
    /*
     * Cuadro de eventos de auditoria
     */

    public function executeGridAuditoriaPanel() {

    }

    /*
     * Ventana para editar un evento
     */

    public function executeEditAuditoriaWindow() {
        
    }

    public function executePanelFiltro(sfWebRequest $request)
	{
        $this->criterio = $request->getParameter("criterio");
        $this->cadena = $request->getParameter("cadena");
        $this->field = $request->getParameter("field");

    }

}

