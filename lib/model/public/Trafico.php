<?php

/**
 * Subclass for representing a row from the 'tb_traficos' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Trafico extends BaseTrafico
{
	public function __toString(){
		return $this->getCaNombre();
	} 
	
	public function getId(){
		return $this->getCaIdtrafico();
	}
		
	public function getConceptos( $transporte, $modalidad ){
		$conceptosArr = explode("|",$this->getCaConceptos());
		$c=new Criteria();
		$c->add( ConceptoPeer::CA_TRANSPORTE, $transporte );
		$c->add( ConceptoPeer::CA_MODALIDAD, $modalidad );
		$c->add( ConceptoPeer::CA_IDCONCEPTO, $conceptosArr, Criteria::IN );
		$c->addAscendingOrderByColumn( ConceptoPeer::CA_LIMINFERIOR );
		return ConceptoPeer::doSelect( $c );		
	}
	
	public function getTipoRecargos( $transporte ){
		$recargosArr = explode("|",$this->getCaRecargos());
		$c = new Criteria();
		$c->add( TipoRecargoPeer::CA_IDRECARGO, $recargosArr , Criteria::IN );
		$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
		return TipoRecargoPeer::doSelect( $c );
	}
	

}
