<?php

/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

/**
 * cotizaciones components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class cotizacionesComponents extends sfComponents {
       
    /*
     * Panel principal inferior
     */

    public function executePanelTrayectoWindow() {

    }

    public function executePanelTrayectoForm() {

    }

    /*
     * Muestra los Productos de una Cotizacion y un formulario para agregar un nuevo registro, tambien
     * permite editar un campo haciendo doble click en el.
     * @author: Carlos G. López M.
     */

    public function executeRelacionDeProductos() {
        $this->productos = $this->cotizacion->getCotProductos();
        $this->editable = $this->getRequestParameter("editable");
    }

    /*
     * Grilla que muestra los trayectos y sus respectivos conceptos
     * @author: Andres Botero
     */

    public function executePanelProductos() {
        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO);
        $this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);

        if (!isset($this->modo)) {
            $this->modo = "";
        }
    }

    public function executePanelProductosotm() {
        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO);
        $this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);

        if (!isset($this->modo)) {
            $this->modo = "";
        }
    }

    /*
     * Permite crear recargos locales
     * @author: Andres Botero
     */

    public function executePanelRecargosCotizacion() {
        $id = $this->cotizacion->getCaIdcotizacion();
        $tipo = $this->tipo;

        $this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO);
        $this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO);
        $this->parametros = ParametroTable::retrieveByCaso("CU071");
        $this->recargosMaritimo = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m")
                        ->addWhere("m.ca_impoexpo like ? ", "%" . Constantes::IMPO . "%")
                        ->addWhere("m.ca_transporte = ? ", Constantes::MARITIMO)
                        ->addWhere("c.ca_recargolocal = ? ", true)
                        ->addWhere("c.ca_usueliminado IS NULL")
                        ->distinct()
                        ->addOrderBy("c.ca_concepto")
                        ->execute();

        $this->recargosAereo = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m")
                        ->addWhere("m.ca_impoexpo like ? ", "%" . Constantes::IMPO . "%")
                        ->addWhere("m.ca_transporte = ? ", Constantes::AEREO)
                        ->addWhere("c.ca_recargolocal = ? ", true)
                        ->addWhere("c.ca_usueliminado IS NULL")
                        ->distinct()
                        ->addOrderBy("c.ca_concepto")
                        ->execute();

        $this->recargosTerrestreOTM = Doctrine::getTable("InoConcepto")
                        ->createQuery("c")
                        ->innerJoin("c.InoConceptoModalidad cm")
                        ->innerJoin("cm.Modalidad m")
                        ->addWhere("m.ca_transporte = ? ", Constantes::TERRESTRE )
                        ->addWhere("c.ca_recargootmdta = ? ", true )
                        ->addWhere("c.ca_usueliminado IS NULL" )
                        ->distinct()
                        ->addOrderBy( "c.ca_concepto" )
                        ->execute();

        if(!isset($this->modo)){
            $this->modo = "";
        }
    }

   
    /*
     *
     */

    public function executePanelSeguros() {
        $id = $this->cotizacion->getCaIdcotizacion();


        $seguros = Doctrine::getTable("CotSeguro")
                        ->createQuery("s")
                        ->where("s.ca_idcotizacion = ? ", $id)
                        ->execute();

        $this->seguros = array();

        foreach ($seguros as $seguro) {
            $this->seguros[] = array('oid' => $seguro->getCaIdseguro(),
                'idcotizacion' => $seguro->getCaIdcotizacion(),
                'prima_tip' => $seguro->getCaPrimaTip(),
                'prima_vlr' => $seguro->getCaPrimaVlr(),
                'prima_min' => $seguro->getCaPrimaMin(),
                'obtencion' => $seguro->getCaObtencion(),
                'idmoneda' => $seguro->getCaIdmoneda(),
                'idmonedaobtencion' => $seguro->getCaIdmonedaobtencion(),
                'observaciones' => utf8_encode($seguro->getCaObservaciones()),
                'transporte' => utf8_encode($seguro->getCaTransporte())
            );
        }
        
        if (!isset($this->modo)) {
            $this->modo = "";
        }
    }

    public function executePanelAduanas() {
        $id = $this->cotizacion->getCaIdcotizacion();

        $aduanas = Doctrine::getTable("CotAduana")
                        ->createQuery("s")
                        ->where("s.ca_idcotizacion = ? ", $id)
                        ->execute();

        $this->aplicaciones = ParametroTable::retrieveByCaso("CU228");
        $this->aduanas = array();

        foreach ($aduanas as $aduana) {
            if ($this->impoexpo == "Exportacion") {
                $transportes = utf8_encode(($aduana->getCosto()->getCaTransporte()==Constantes::MARITIMO)?"Nacionalización en Puerto":(($aduana->getCosto()->getCaTransporte()==Constantes::AEREO)?"Nacionalización Aéreo/OTM":""));
            } else {
                $transportes = utf8_encode($aduana->getCosto()->getCaTransporte());
            }
            $this->aduanas[] = array('oid' => $aduana->getCaIdaduana(),
                'idcotizacion' => $aduana->getCaIdcotizacion(),
                'transporte' => utf8_encode($aduana->getCosto()->getCaTransporte()),
                'transportes' => $transportes,
                'idconcepto' => $aduana->getCaIdconcepto(),
                'concepto' => utf8_encode($aduana->getCosto()->getCaCosto()),
                'valor' => $aduana->getCaValor(),
                'valorminimo' => $aduana->getCaValorminimo(),
                'aplicacion' => utf8_encode($aduana->getCaAplicacion()),
                'aplicacionminimo' => utf8_encode($aduana->getCaAplicacionminimo()),
                'parametro' => utf8_encode($aduana->getCaParametro()),
                'fchini' => $aduana->getCaFchini(),
                'fchfin' => $aduana->getCaFchfin(),
                'observaciones' => utf8_encode($aduana->getCaObservaciones()),
            );
        }
        
        if (!isset($this->modo)) {
            $this->modo = "";
        }
    }

    public function executePanelDepositos() {
        $id = $this->cotizacion->getCaIdcotizacion();

        $depositos = Doctrine::getTable("CotDeposito")
                        ->createQuery("s")
                        ->where("s.ca_idcotizacion = ? ", $id)
                        ->execute();
        
        $sql = "select distinct ca_parametro from pric.tb_conceptodeposito";
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $this->parametros = $st->fetchAll();
            
        $this->aplicaciones = ParametroTable::retrieveByCaso("CU246");
        $this->depositos = array();

        foreach ($depositos as $deposito) {
            $this->depositos[] = array('oid' => $deposito->getCaIddeposito(),
                'idcotizacion' => $deposito->getCaIdcotizacion(),
                'idconcepto' => $deposito->getCaIdconcepto(),
                'transporte' => utf8_encode($deposito->getCosto()->getCaTransporte()),
                'parametros' => utf8_encode($deposito->getCosto()->getCaParametros()),
                'concepto' => utf8_encode($deposito->getCosto()->getCaCosto()),
                'valor' => $deposito->getCaValor(),
                'valorminimo' => $deposito->getCaValorminimo(),
                'aplicacion' => utf8_encode($deposito->getCaAplicacion()),
                'aplicacionminimo' => utf8_encode($deposito->getCaAplicacionminimo()),
                'parametro' => utf8_encode($deposito->getCaParametro()),
                'fchini' => $deposito->getCaFchini(),
                'fchfin' => $deposito->getCaFchfin(),
                'observaciones' => utf8_encode($deposito->getCaObservaciones())
            );
        }
        
        if (!isset($this->modo)) {
            $this->modo = "";
        }
    }
    
    /*
     *
     */

    public function executePanelAgentes() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn", 'last');
    }


    public function executeFormCotizacionPanel() {
        
    }

    /*
     * Panel principal inferior
     */

    public function executeSubPanel() {

    }

    public function executeFormEncabezadoPanel() {
        
    }

    public function executeFieldsEncabezado() {
        $this->nivel = $this->getUser()->getNivelAcceso(cotizacionesActions::RUTINA);
        $this->sucursal=$this->getUser()->getIdsucursal();
        $this->medios = ParametroTable::retrieveByCaso("CU244");        
    }

    public function executeChart() {

    }

}

?>
