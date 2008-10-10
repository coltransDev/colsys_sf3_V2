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
		
	}
	
	/*
	* 
	*/	
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
		$c = new Criteria();

		$c->addAlias('c_org', CiudadPeer::TABLE_NAME);
		$c->addAlias('c_dst', CiudadPeer::TABLE_NAME);
		$c->addAlias('concepto', ConceptoPeer::TABLE_NAME);
		$c->addAlias('equipo', ConceptoPeer::TABLE_NAME);
		
		$c->addSelectColumn(CotContinuacionPeer::CA_IDCOTIZACION );
		$c->addSelectColumn(CotContinuacionPeer::CA_TIPO );
		$c->addSelectColumn(CotContinuacionPeer::CA_MODALIDAD );
		$c->addSelectColumn(CotContinuacionPeer::CA_ORIGEN );
		$c->addSelectColumn("c_org.ca_ciudad");
		$c->addSelectColumn(CotContinuacionPeer::CA_DESTINO );
		$c->addSelectColumn("c_dst.ca_ciudad");
		$c->addSelectColumn(CotContinuacionPeer::CA_IDCONCEPTO );
		$c->addSelectColumn("concepto.ca_concepto");
		$c->addSelectColumn(CotContinuacionPeer::CA_IDEQUIPO );
		$c->addSelectColumn("equipo.ca_concepto");
		$c->addSelectColumn(CotContinuacionPeer::CA_VALOR_TAR );
		$c->addSelectColumn(CotContinuacionPeer::CA_VALOR_MIN );
		$c->addSelectColumn(CotContinuacionPeer::CA_IDMONEDA );
		$c->addSelectColumn(CotContinuacionPeer::CA_FRECUENCIA );
		$c->addSelectColumn(CotContinuacionPeer::CA_TIEMPOTRANSITO );
		$c->addSelectColumn(CotContinuacionPeer::CA_OBSERVACIONES );

		$c->addJoin( CotContinuacionPeer::CA_ORIGEN, "c_org.ca_idciudad", Criteria::LEFT_JOIN );
		$c->addJoin( CotContinuacionPeer::CA_DESTINO, "c_dst.ca_idciudad", Criteria::LEFT_JOIN );
		$c->addJoin( CotContinuacionPeer::CA_IDCONCEPTO, "concepto.ca_idconcepto", Criteria::LEFT_JOIN );
		$c->addJoin( CotContinuacionPeer::CA_IDEQUIPO, "equipo.ca_idconcepto", Criteria::LEFT_JOIN );

		$c->add( CotContinuacionPeer::CA_IDCOTIZACION , $id );
		
		$rs = CotContinuacionPeer::doSelectRS( $c );
		
		$this->contviajes = array();
		
   		while ( $rs->next() ) {
      		$this->contviajes[] = array('idcotizacion'=>$rs->getString(1),
      									'tipo'=>$rs->getString(2),
      									'modalidad'=>$rs->getString(3),
										'origen'=>$rs->getString(4),
										'ciuorigen'=>utf8_encode($rs->getString(5)),
      									'destino'=>$rs->getString(6),
      									'ciudestino'=>utf8_encode($rs->getString(7)),
      									'idconcepto'=>$rs->getString(8),
      									'concepto'=>$rs->getString(9),
      									'idequipo'=>$rs->getString(10),
      									'equipo'=>$rs->getString(11),
      									'valor_tar'=>$rs->getString(12),
      									'valor_min'=>$rs->getString(13),
      									'idmoneda'=>$rs->getString(14),
										'frecuencia'=>utf8_encode($rs->getString(15)),
										'ttransito'=>utf8_encode($rs->getString(16)),
										'observaciones'=>utf8_encode($rs->getString(17)),
      		);
		}		
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