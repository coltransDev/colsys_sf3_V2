<?php

/**
 * Subclass for representing a row from the 'tb_cotcontinuacion' table.
 *
 * 
 *
 * @package lib.model.cotizaciones
 */ 
class CotContinuacion extends BaseCotContinuacion
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
	
	public function getEquipo(){
		$concepto = ConceptoPeer::retrieveByPk( $this->getCaIdEquipo() );
		if( $concepto ){
			return $concepto->getCaConcepto();
		}
	}
}
