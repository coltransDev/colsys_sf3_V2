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
	
	public function getTexto(){
		
		$concepto = $this->getConcepto();
		$equipo = $this->getEquipo();
		
		if( $concepto->getCaConcepto()!=$equipo ){
			$str= $concepto->getCaConcepto()." en ".$equipo;			
		}else{
			$str= $concepto->getCaConcepto();			
		}
		return $str;		
	}
	
	public function getTextoTarifa(){
		$str = $this->getCaIdMoneda()." ".Utils::formatNumber($this->getCaValorTar());
		if( $this->getCaValorMin() ){
			$str .= " /Min. ". $this->getCaIdMoneda()." ".Utils::formatNumber($this->getCaValorMin());
		}
		return $str;
	}
	
	
	public function delOid(PropelPDO $con = null){		
		if( ($k = array_search(CotContinuacionPeer::OID, $this->modifiedColumns))!==null ){
			unset($this->modifiedColumns[$k]);	
		}						
	}
}
