<?php

/**
 * Subclass for representing a row from the 'tb_inomaestra_air' table.
 *
 * 
 *
 * @package lib.model.air
 */ 
class InoMaestraAir extends BaseInoMaestraAir
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
	* Devuelve la ubicacion del directorio donde se encuentran los archivos de la referencia 
	*/
	public function getDirectorio(){
		return sfConfig::get("app_digitalFile_root").$this->getCaReferencia();
	}
}
