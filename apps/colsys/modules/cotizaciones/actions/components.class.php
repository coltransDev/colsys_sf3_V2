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
class cotizacionesComponents extends sfComponents
{


    /*
     * Panel principal superior
     */
    public function executeMainPanel()
	{
        $this->user = $this->getUser();
    }

    /*
     * Panel principal inferior
     */
    public function executeSubPanel()
	{

    }


    /*
     * Panel principal inferior
     */
    public function executePanelTrayectoWindow()
	{

    }


    public function executePanelTrayectoForm()
	{

    }

	/*
	* Muestra los Productos de una Cotizacion y un formulario para agregar un nuevo registro, tambien
	* permite editar un campo haciendo doble click en el.
	* @author: Carlos G. López M.
	*/
	public function executeRelacionDeProductos()
	{
		$this->productos = $this->cotizacion->getCotProductos();
		$this->editable = $this->getRequestParameter("editable");
	}



	/*
	* Grilla que muestra los trayectos y sus respectivos conceptos
	* @author: Andres Botero
	*/
	public function executePanelProductos(){
		$this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );

        if(!isset($this->modo)){
            $this->modo = "";
        }

	}

        public function executePanelProductosotm(){
		$this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );

        if(!isset($this->modo)){
            $this->modo = "";
        }

	}

	/*
	* Permite crear recargos locales
	* @author: Andres Botero
	*/
	public function executePanelRecargosCotizacion(){
		$id = $this->cotizacion->getCaIdcotizacion();
		$tipo = $this->tipo;

		$this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );
        $this->parametros = ParametroTable::retrieveByCaso("CU071");
		$this->recargosMaritimo = Doctrine::getTable("InoConcepto")
                                  ->createQuery("c")
                                 ->innerJoin("c.InoConceptoModalidad cm")
                                 ->innerJoin("cm.Modalidad m")
                                 ->addWhere("m.ca_impoexpo like ? ", "%".Constantes::IMPO."%" )
                                 ->addWhere("m.ca_transporte = ? ", Constantes::MARITIMO )
                                 ->addWhere("c.ca_recargolocal = ? ", true )
                                 ->addWhere("c.ca_usueliminado IS NULL" )
                                 ->distinct()
                                 ->addOrderBy( "c.ca_concepto" )
                                 ->execute();

        $this->recargosAereo = Doctrine::getTable("InoConcepto")
                                  ->createQuery("c")
                                 ->innerJoin("c.InoConceptoModalidad cm")
                                 ->innerJoin("cm.Modalidad m")
                                 ->addWhere("m.ca_impoexpo like ? ", "%".Constantes::IMPO."%" )
                                 ->addWhere("m.ca_transporte = ? ", Constantes::AEREO )
                                 ->addWhere("c.ca_recargolocal = ? ", true )
                                 ->addWhere("c.ca_usueliminado IS NULL" )
                                 ->distinct()
                                 ->addOrderBy( "c.ca_concepto" )
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
	public function executePanelContViajes(){
		$id = $this->cotizacion->getCaIdcotizacion();

	}

	/*
	*
	*/
	public function executePanelSeguros(){
		$id = $this->cotizacion->getCaIdcotizacion();


		$seguros = Doctrine::getTable("CotSeguro")
                ->createQuery("s")
                ->where("s.ca_idcotizacion = ? ", $id)
                ->execute();

		$this->seguros = array();

   		foreach( $seguros as $seguro ){
      		$this->seguros[] = array('oid'=>$seguro->getCaIdseguro() ,
      									'idcotizacion'=>$seguro->getCaIdcotizacion(),
      									'prima_tip'=>$seguro->getCaPrimaTip(),
      									'prima_vlr'=>$seguro->getCaPrimaVlr(),
      									'prima_min'=>$seguro->getCaPrimaMin(),
      									'obtencion'=>$seguro->getCaObtencion(),
      									'idmoneda'=>$seguro->getCaIdmoneda(),
                                        'idmonedaobtencion'=>$seguro->getCaIdmonedaobtencion(),
										'observaciones'=>utf8_encode($seguro->getCaObservaciones()),
										'transporte'=>utf8_encode($seguro->getCaTransporte())
      		);
		}
	}

	/*
	*
	*/
	public function executePanelAgentes(){
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/CheckColumn",'last');
	}

    /*
	*  Cotizaciones de Colmas
	* */


    /*
	* Grilla que muestra los trayectos y sus respectivos conceptos
	* @author: Andres Botero
	*/
	public function executePanelTransporteAduana(){
		$this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );

        if(!isset($this->modo)){
            $this->modo = "";
        }

	}

    public function executePanelTarifarioAduana()
    {
        $this->aplicaciones = ParametroTable::retrieveByCaso("CU082");
    }

    public function executeGridPanelContinuacionWindow()
    {
        
    }

    /*
     * Ventana para crear un nuevo trayecto
     */
    public function executeFormTrayectoAduanaWindow()
	{

    }

    public function executeFormFiltrosPanel()
	{

    }

    public function executeChart()
	{

    }
}
?>