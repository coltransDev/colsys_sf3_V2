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
	* Retorna el estilo que se debe aplicar a las filas de acuerdoa al estado que se encuentre
	* Author: Andres Botero
	*/
	public function getEstilo(){
		switch( $this->getCaEstado() ){
			case 2:
				return "yellow";
				break;
			case 3:
				return "pink";
				break;
			default:
				return "";
				break;
		}
	}
	
	/*
	* Coloca el estilo que se debe aplicar a las filas de acuerdoa al estado que se encuentre
	* Author: Andres Botero
	*/
	public function setEstilo( $estilo ){
		switch( $estilo ){
			case "yellow":				
				$this->setCaEstado(2);
				break;
			case "pink":
				$this->setCaEstado(3);
				break;
			default:
				$this->setCaEstado(1);
				break;
		}
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
