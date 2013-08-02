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
        $this->monedaLocal = $this->getUser()->getIdmoneda();
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

        $this->modo = $this->getRequestParameter("modo");
        
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
        
    }

    /*
     * Grid que muestra las facturas de compra de la referencia
     */

    public function executeGridCostosPanel() {
        $this->monedaLocal = $this->getUser()->getIdmoneda();
    }
    
    public function executeGridCostosPanel_1() {
        $this->monedaLocal = $this->getUser()->getIdmoneda();
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
    
           

    public function executePanelFiltro(sfWebRequest $request)
	{
        $this->criterio = $request->getParameter("criterio");
        $this->cadena = $request->getParameter("cadena");
        $this->field = $request->getParameter("field");

    }
    
    public function executeBalanceReferencia(sfWebRequest $request){
        $this->monedaLocal = $this->getUser()->getIdmoneda();

    }
    
    
    /*
     * Formulario para ingresar los datos del house
     */

    public function executeFormEquiposPanel() {
        $q = Doctrine_Query::create()
                ->select("c.ca_idconcepto, c.ca_concepto, c.ca_transporte, c.ca_modalidad, c.ca_liminferior")
                ->from("Concepto c")                
                ->addWhere( "c.ca_transporte=?", Constantes::MARITIMO )
                ->addWhere( "c.ca_modalidad=?", Constantes::FCL )
                ->addOrderBy("c.ca_liminferior")        
                ->addOrderBy("c.ca_concepto");

        $q->fetchArray();

        $conceptos = $q->execute();

        $this->data = array();
        foreach ($conceptos as $concepto) {
            $this->data[] = array("idconcepto" => $concepto['ca_idconcepto'],
                "concepto" => utf8_encode($concepto['ca_concepto']),
                "transporte" => utf8_encode($concepto['ca_transporte']),
                "modalidad" => utf8_encode($concepto['ca_modalidad'])
            );
        }   
    }

    /*
     * Grid que muestra los house de la referencia
     */

    public function executeGridEquiposPanel() {
             
        
    }
    
    
    /*
     * Grid que muestra los house de la referencia
     */

    public function executeFormCostosDiscriminadosPanel() {        
       $costos = Doctrine::getTable("Costo")
                        ->createQuery("c")
                        ->select("c.ca_idcosto, c.ca_costo")
                        ->addWhere("c.ca_impoexpo = ? ", $this->modo->getCaImpoexpo())
                        ->addWhere("c.ca_transporte = ? ", $this->modo->getCaTransporte())
                        //->addWhere("c.ca_modalidad = ? ", $this->referencia?$this->referencia->getCaModalidad():"")
                        ->addOrderBy("c.ca_costo")
                        ->execute();
        $this->data=array();
        foreach( $costos as $c ){
            $this->data[] = array(
                "idconcepto"=>$c->getCaIdcosto(),
                "concepto"=>utf8_encode($c->getCaCosto()),
                "transporte"=>utf8_encode($c->getCaTransporte()),
                "impoexpo"=>utf8_encode($c->getCaImpoexpo())
            );
        }
        
        $this->monedaLocal = $this->getUser()->getIdmoneda();
        
        $q = Doctrine::getTable("InoTipoComprobante")
                        ->createQuery("t")
                        ->select("t.ca_idtipo, t.ca_tipo, t.ca_comprobante, t.ca_titulo, e.ca_sigla")
                        //->innerJoin("t.IdsSucursal s")
                        //->innerJoin("s.Ids i")
                        //->innerJoin("s.Empresa e")
                        ->addWhere("t.ca_tipo = ?", "P")
                        ->addOrderBy("t.ca_tipo, t.ca_comprobante");
        
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
        
        
    }
    
    
    /*
     * Grid que muestra los house de la referencia
     */

    public function executeFormCostosDiscriminadosGridPanel() {               
        
        $this->monedaLocal = $this->getUser()->getIdmoneda();
        
    }
    
    /*
     * Grid que muestra las facturas de compra de la referencia
     */

    public function executeGridCostosDiscriminadosPanel() {
        
    }
}

