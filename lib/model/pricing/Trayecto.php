<?php

/**
 * Subclass for representing a row from the 'tb_trayectos' table.
 *
 * 
 *
 * @package lib.model.pricing
 */ 
class Trayecto extends BaseTrayecto
{
	/*
	* Retorna el objeto ciudad asociado al campo ca_origen
	* Author: Andres Botero
	*/
	public function getOrigen(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaOrigen() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
	
	/*
	* Retorna el objeto ciudad asociado al campo ca_destino
	* Author: Andres Botero
	*/
	public function getDestino(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaDestino() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
		
	
	
	
	/*
	* Retorna los recargos generales del trayecto
	* @author Andres Botero
	*/
	public function getRecargosGenerales(){
		$c = new Criteria();
		$c->add( PricRecargoxConceptoPeer::CA_IDCONCEPTO, '9999' ); 
		$c->add( PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto() ); 
		return PricRecargoxConceptoPeer::doSelect( $c );

		
	}
	 
}
