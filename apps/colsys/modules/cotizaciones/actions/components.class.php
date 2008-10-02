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
	
	public function executeGrillaProductos(){
		$id = $this->cotizacion->getCaIdcotizacion();
		$c = new Criteria();

		$c->addAlias('c_org', CiudadPeer::TABLE_NAME);
		$c->addAlias('c_dst', CiudadPeer::TABLE_NAME);
		$c->addAlias('t_org', TraficoPeer::TABLE_NAME);
		$c->addAlias('t_dst', TraficoPeer::TABLE_NAME);
		
		$c->addSelectColumn(CotProductoPeer::CA_IDCOTIZACION );
		$c->addSelectColumn(CotProductoPeer::CA_IDPRODUCTO );
		$c->addSelectColumn(CotProductoPeer::CA_PRODUCTO );
		$c->addSelectColumn(CotProductoPeer::CA_IMPOEXPO );
		$c->addSelectColumn(CotProductoPeer::CA_TRANSPORTE );
		$c->addSelectColumn(CotProductoPeer::CA_MODALIDAD );
		$c->addSelectColumn(CotProductoPeer::CA_INCOTERMS );
		$c->addSelectColumn(CotProductoPeer::CA_ORIGEN );
		$c->addSelectColumn("c_org.ca_ciudad");
		$c->addSelectColumn("t_org.ca_nombre");
		$c->addSelectColumn(CotProductoPeer::CA_DESTINO );
		$c->addSelectColumn("c_dst.ca_ciudad");
		$c->addSelectColumn("t_dst.ca_nombre");
		$c->addSelectColumn(CotProductoPeer::CA_FRECUENCIA );
		$c->addSelectColumn(CotProductoPeer::CA_TIEMPOTRANSITO );
		$c->addSelectColumn(CotProductoPeer::CA_OBSERVACIONES );
		$c->addSelectColumn(CotProductoPeer::CA_IMPRIMIR );
		
		$c->addJoin( CotProductoPeer::CA_ORIGEN, "c_org.ca_idciudad", Criteria::LEFT_JOIN );
		$c->addJoin( CotProductoPeer::CA_DESTINO, "c_dst.ca_idciudad", Criteria::LEFT_JOIN );

		$c->addJoin( "c_org.ca_idtrafico", "t_org.ca_idtrafico", Criteria::LEFT_JOIN );
		$c->addJoin( "c_dst.ca_idtrafico", "t_dst.ca_idtrafico", Criteria::LEFT_JOIN );
		
		$c->setDistinct();
		$c->add( CotProductoPeer::CA_IDCOTIZACION , $id );
		
		$rs = CotProductoPeer::doSelectRS( $c );
		
		$this->productos = array();
		
   		while ( $rs->next() ) {
      		$this->productos[] = array(	'idcotizacion'=>$rs->getString(1),
      									'idproducto'=>$rs->getString(2),
										'producto'=>$rs->getString(3),
      									'trayecto'=>utf8_encode($rs->getString(5))." [".utf8_encode($rs->getString(10))." - ".utf8_encode($rs->getString(9)." » ").utf8_encode($rs->getString(12))." - ".utf8_encode($rs->getString(13))."] ",
      									'impoexpo'=>utf8_encode($rs->getString(4)),
										'transporte'=>utf8_encode($rs->getString(5)),
										'modalidad'=>$rs->getString(6),
										'incoterms'=>$rs->getString(7),      		
										'origen'=>$rs->getString(8),
										'ciuorigen'=>$rs->getString(9),
      									'traorigen'=>$rs->getString(10),
      									'destino'=>$rs->getString(11),
      									'ciudestino'=>$rs->getString(12),
      									'tradestino'=>$rs->getString(13),
										'frecuencia'=>$rs->getString(14),
										'ttransito'=>$rs->getString(15),
										'observaciones'=>$rs->getString(16),
										'imprimir'=>$rs->getString(17)
      		);
		}		
	}

	public function executeGrillaRecargos(){
		$id = $this->cotizacion->getCaIdcotizacion();
		$tipo = $this->tipo;
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
		$c->add( CotRecargoPeer::CA_TIPO , $tipo );
		
		$rs = CotRecargoPeer::doSelectRS( $c );
		
		$this->recargos = array();
		
   		while ( $rs->next() ) {
      		$this->recargos[] = array( 'idcotizacion'=>$rs->getString(1),
      									'idproducto'=>$rs->getString(2),
      									'idopcion'=>$rs->getString(3),
      									'idconcepto'=>$rs->getString(4),
      									'idrecargo'=>$rs->getString(5),
      									'agrupamiento'=>utf8_encode($rs->getString(15))." ".utf8_encode($rs->getString(16))." ".utf8_encode($rs->getString(13)),
      									'recargo'=>$rs->getString(6),
      									'tipo'=>$rs->getString(7),
      									'valor_tar'=>$rs->getString(8),
      									'aplica_tar'=>$rs->getString(9),
      									'valor_min'=>$rs->getString(10),
      									'aplica_min'=>$rs->getString(11),
      									'idmoneda'=>$rs->getString(12),
      									'modalidad'=>$rs->getString(13),
										'observaciones'=>$rs->getString(14)
      		);
		}		
	}
	
}
?>