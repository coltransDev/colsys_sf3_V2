<?php

/**
 * Subclass for representing a row from the 'tb_cotizaciones' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Cotizacion extends BaseCotizacion
{	
	public function getId(){
		return $this->getCaIdcotizacion();
	}	
	
	/*
	* Retorna el objeto cliente asociado al contacto de la cotizacion 
	* @author Carlos G. López M.
	*/
	public function getCliente(){
		$c = new Criteria();
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );
		$c->add( ContactoPeer::CA_IDCONTACTO, $this->getCaIdcontacto() );
		$c->setDistinct();
		return ClientePeer::doSelectOne($c);		
	}
	
	
	/*
	* Retorna los recargos locales de la cotización
	* @author Andres Botero
	*/
	public function getRecargosLocales(){	
		$tipo = Constantes::RECARGO_LOCAL;
		$c = new Criteria();		
		$c->addJoin( CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO, Criteria::LEFT_JOIN );		
		$c->add( CotRecargoPeer::CA_IDCOTIZACION , $this->getCaIdcotizacion() );
		$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
		$c->setDistinct();
		$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_TRANSPORTE );
		$c->addAscendingOrderByColumn( CotRecargoPeer::CA_MODALIDAD );
		
		return CotRecargoPeer::doSelect($c);		
	}
}
?>