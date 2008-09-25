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
		$c->addSelectColumn(CotProductoPeer::CA_IDPRODUCTO );
		$c->addSelectColumn(CotProductoPeer::CA_PRODUCTO );
		$c->addSelectColumn(CotProductoPeer::CA_IMPOEXPO );
		$c->addSelectColumn(CotProductoPeer::CA_TRANSPORTE );
		$c->addSelectColumn(CotProductoPeer::CA_MODALIDAD );
		$c->addSelectColumn(CotProductoPeer::CA_INCOTERMS );
		$c->addSelectColumn(CotProductoPeer::CA_ORIGEN );
		$c->addSelectColumn(CotProductoPeer::CA_DESTINO );
		$c->addSelectColumn(CotProductoPeer::CA_FRECUENCIA );
		$c->addSelectColumn(CotProductoPeer::CA_TIEMPOTRANSITO );
		$c->addSelectColumn(CotProductoPeer::CA_OBSERVACIONES );
		$c->addSelectColumn(CotProductoPeer::CA_IMPRIMIR );
		$c->setDistinct();
		$c->add( CotProductoPeer::CA_IDCOTIZACION , $id );
		
		$rs = CotProductoPeer::doSelectRS( $c );
		
		$this->productos = array();
		
   		while ( $rs->next() ) {
      		$this->productos[] = array(	'trayecto'=>$rs->getString(7)." ".$rs->getString(8),
      									'idproducto'=>$rs->getString(1),
										'producto'=>$rs->getString(2),
										'impoexpo'=>utf8_encode($rs->getString(3)),
										'transporte'=>utf8_encode($rs->getString(4)),
										'modalidad'=>$rs->getString(5),
										'incoterms'=>$rs->getString(6),      		
										'origen'=>$rs->getString(7),
										'destino'=>$rs->getString(8),
										'frecuencia'=>$rs->getString(9),
										'ttransito'=>$rs->getString(10),
										'observaciones'=>$rs->getString(11),
										'imprimir'=>$rs->getString(12)
      		);
		}		
	}
}
?>