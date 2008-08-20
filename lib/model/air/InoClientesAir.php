<?php

/**
 * Subclass for representing a row from the 'tb_inoclientes_air' table.
 *
 * 
 *
 * @package lib.model.air
 */ 
class InoClientesAir extends BaseInoClientesAir
{
	public function getInoIngresosAirs(){
		$c  = new Criteria();
		$c->add( InoIngresosAirPeer::CA_REFERENCIA , $this->getCaReferencia() );
		$c->add( InoIngresosAirPeer::CA_IDCLIENTE , $this->getCaIdCliente() );
		$c->add( InoIngresosAirPeer::CA_HAWB , $this->getCaHawb() );
		$inoingresos = InoIngresosAirPeer::doSelect( $c );
		return $inoingresos;
		
	}
}
