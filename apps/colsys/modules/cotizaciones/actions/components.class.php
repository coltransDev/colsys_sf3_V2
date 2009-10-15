<?php

/**
 * clientes components.
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
	* Muestra los Productos de una Cotizacion y un formulario para agregar un nuevo registro, tambien 
	* permite editar un campo haciendo doble click en el.
	* @author: Carlos G. L�pez M.
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
	public function executeGrillaProductos(){
		$this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );
	}
	
	/*
	* Permite crear recargos locales
	* @author: Carlos Lopez, Andres Botero
	*/
	public function executeGrillaRecargos(){
		$id = $this->cotizacion->getCaIdcotizacion();
		$tipo = $this->tipo;
		
		$this->aplicacionesAereo = ParametroTable::retrieveByCaso("CU064", null, Constantes::AEREO );
		$this->aplicacionesMaritimo = ParametroTable::retrieveByCaso("CU064", null, Constantes::MARITIMO );

		$this->recargosMaritimo = Doctrine::getTable("TipoRecargo")
                                  ->createQuery("t")
                                  ->where("t.ca_transporte = ? and t.ca_tipo = ?", array(Constantes::MARITIMO, $tipo ))
                                  ->addOrderBy("t.ca_recargo ASC")
                                  ->execute();

        $this->recargosTerrestreOTM = Doctrine::getTable("TipoRecargo")
                                  ->createQuery("t")
                                  ->where("t.ca_transporte = ? and t.ca_tipo = ?", array(Constantes::TERRESTRE, Constantes::RECARGO_OTM_DTA ))
                                  ->addOrderBy("t.ca_recargo ASC")
                                  ->execute();
						
		$this->recargosAereo = Doctrine::getTable("TipoRecargo")
                                  ->createQuery("t")
                                  ->where("t.ca_transporte = ? and t.ca_tipo = ?", array(Constantes::AEREO, $tipo ))
                                  ->addOrderBy("t.ca_recargo ASC")
                                  ->execute();


					
	}

	/*
	* 
	*/	
	public function executeGrillaContViajes(){
		$id = $this->cotizacion->getCaIdcotizacion();
		
	}
	
	/*
	* 
	*/	
	public function executeGrillaSeguros(){
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
										'observaciones'=>utf8_encode($seguro->getCaObservaciones()),
										'transporte'=>utf8_encode($seguro->getCaTransporte())
      		);
		}
	}
	
	/*
	* 
	*/	
	public function executeGrillaAgentes(){
		
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/CheckColumn",'last');
				
		
			
	}

    /*
	*
	* */
	/*public function executeComboProductos(){
		$id = $this->cotizacion->getCaIdcotizacion();
		$c = new Criteria();
		$c->addSelectColumn(CotProductoPeer::CA_PRODUCTO );
		$c->setDistinct();
		$c->add( CotProductoPeer::CA_IDCOTIZACION , $id );

		$rs = CotProductoPeer::doSelectRS( $c );

		$this->productos = array();

   		while ( $rs->next() ) {
      		$this->productos = array('ca_producto'=>$rs->getString(1),
      		);
		}
	}*/
}
?>