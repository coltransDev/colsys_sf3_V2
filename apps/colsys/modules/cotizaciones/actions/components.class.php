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
	* 
	* */
	public function executeComboProductos(){
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
	}
	
	/*
	* Grilla que muestra los trayectos y sus respectivos conceptos
	* @author: Andres Botero
	*/
	public function executeGrillaProductos(){
		$this->aplicacionesAereo = ParametroPeer::retrieveByCaso("CU064", null, "Aéreo" );
		$this->aplicacionesMaritimo = ParametroPeer::retrieveByCaso("CU064", null, "Marítimo" );	
	}
	
	/*
	* Permite crear recargos locales
	* @author: Carlos Lopez, Andres Botero
	*/
	public function executeGrillaRecargos(){
		$id = $this->cotizacion->getCaIdcotizacion();
		$tipo = $this->tipo;
		
		$this->aplicacionesAereo = ParametroPeer::retrieveByCaso("CU064", null, "Aéreo" );
		$this->aplicacionesMaritimo = ParametroPeer::retrieveByCaso("CU064", null, "Marítimo" );
		
		$c = new Criteria();
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, 'Marítimo');	
		$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
		$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
		$this->recargosMaritimo = TipoRecargoPeer::doSelect( $c );
		
		$c = new Criteria();
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, 'Aéreo');	
		$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
		$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
		$this->recargosAereo = TipoRecargoPeer::doSelect( $c );
		
		
		$c = new Criteria();
		$c->addSelectColumn(CotRecargoPeer::CA_IDCOTIZACION );
		$c->addSelectColumn(CotRecargoPeer::CA_IDPRODUCTO );
		$c->addSelectColumn(CotRecargoPeer::CA_IDOPCION );
		$c->addSelectColumn(CotRecargoPeer::CA_IDCONCEPTO );
		$c->addSelectColumn(CotRecargoPeer::CA_IDRECARGO );
		$c->addSelectColumn(TipoRecargoPeer::CA_RECARGO );
		$c->addSelectColumn(CotRecargoPeer::CA_TIPO );
		$c->addSelectColumn(CotRecargoPeer::CA_VALOR_TAR );
		$c->addSelectColumn(CotRecargoPeer::CA_APLICA_TAR );
		$c->addSelectColumn(CotRecargoPeer::CA_VALOR_MIN );
		$c->addSelectColumn(CotRecargoPeer::CA_APLICA_MIN );
		$c->addSelectColumn(CotRecargoPeer::CA_IDMONEDA );
		$c->addSelectColumn(CotRecargoPeer::CA_MODALIDAD );
		$c->addSelectColumn(CotRecargoPeer::CA_OBSERVACIONES );
		$c->addSelectColumn(TipoRecargoPeer::CA_IMPOEXPO );
		$c->addSelectColumn(TipoRecargoPeer::CA_TRANSPORTE );
		
		$c->addJoin( CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO, Criteria::LEFT_JOIN );

		$c->add( CotRecargoPeer::CA_IDCOTIZACION , $id );
		$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
		
		$rs = CotRecargoPeer::doSelectRS( $c );
		
		$this->recargos = array();
		
   		while ( $rs->next() ) {
      		$this->recargos[] = array( 'idcotizacion'=>$rs->getString(1),
      									'idproducto'=>$rs->getString(2),
      									'idopcion'=>$rs->getString(3),
      									'idconcepto'=>$rs->getString(4),
      									'idrecargo'=>$rs->getString(5),
      									'agrupamiento'=>utf8_encode($rs->getString(15))." ".utf8_encode($rs->getString(16))." ".utf8_encode($rs->getString(13)),
      									'recargo'=>utf8_encode($rs->getString(6)),
      									'tipo'=>$rs->getString(7),
      									'valor_tar'=>$rs->getString(8),
      									'aplica_tar'=>$rs->getString(9),
      									'valor_min'=>$rs->getString(10),
      									'aplica_min'=>$rs->getString(11),
      									'idmoneda'=>$rs->getString(12),
      									'modalidad'=>$rs->getString(13),
										'observaciones'=>utf8_encode($rs->getString(14))
      		);
		}		
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
		
		$c = new Criteria();
		$c->addSelectColumn(CotSeguroPeer::OID );
		$c->addSelectColumn(CotSeguroPeer::CA_IDCOTIZACION );
		$c->addSelectColumn(CotSeguroPeer::CA_PRIMA_TIP );
		$c->addSelectColumn(CotSeguroPeer::CA_PRIMA_VLR );
		$c->addSelectColumn(CotSeguroPeer::CA_PRIMA_MIN );
		$c->addSelectColumn(CotSeguroPeer::CA_OBTENCION );
		$c->addSelectColumn(CotSeguroPeer::CA_IDMONEDA );
		$c->addSelectColumn(CotSeguroPeer::CA_OBSERVACIONES );
		
		$c->add( CotSeguroPeer::CA_IDCOTIZACION , $id );
		
		$rs = CotSeguroPeer::doSelectRS( $c );
		
		$this->seguros = array();
		
   		while ( $rs->next() ) {
      		$this->seguros[] = array('oid'=>$rs->getString(1),
      									'idcotizacion'=>$rs->getString(2),
      									'prima_tip'=>$rs->getString(3),
      									'prima_vlr'=>$rs->getString(4),
      									'prima_min'=>$rs->getString(5),
      									'obtencion'=>$rs->getString(6),
      									'idmoneda'=>$rs->getString(7),
										'observaciones'=>utf8_encode($rs->getString(8))
      		);
		}
	}
	
	/*
	* 
	*/	
	public function executeVentanaTarifario(){
			
	}
	
}
?>