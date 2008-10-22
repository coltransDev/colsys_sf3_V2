<?php

/**
 * Subclass for representing a row from the 'tb_pricfletes' table.
 *
 * 
 *
 * @package lib.model.pricing
 */ 
class PricFlete extends BasePricFlete
{
	public function getPricRecargos(){
		$c = new Criteria();		
		$c->add( PricRecargoPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto() );
		return PricRecargoPeer::doSelect( $c );
		
	}
	
	public function getPricRecargosxConcepto(){
		$c = new Criteria();
		$c->add( PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->getCaIdConcepto() );
		$c->add( PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->getCaIdTrayecto() );
		return PricRecargoxConceptoPeer::doSelect( $c );
		
	}
	
	/*
	* Retorna el estilo que se debe aplicar a las filas de acuerdo al 
	* estado que se encuentre
	* Author: Andres Botero
	*/
	public function getEstilo(){
		switch( $this->getCaEstado() ){
			case 1:
				return "yellow";
				break;
			case 2:
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
				$this->setCaEstado(1);
				break;
			case "pink":
				$this->setCaEstado(2);
				break;
			default:
				$this->setCaEstado(1);
				break;
		}
	}
}
