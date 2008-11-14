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
}
?>