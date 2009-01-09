<?php

/**
 * Subclass for representing a row from the 'log_pricfletes' table.
 *
 * 
 *
 * @package lib.model.pricing
 */ 
class PricFleteLog extends BasePricFleteLog
{
	public function getPricRecargoxConceptos( $fch ){	
		//Se buscan los distintos recargos
		$c = new Criteria();
		$c->addSelectColumn( PricRecargoxConceptoLogPeer::CA_IDRECARGO );
		$c->add( PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->getCaIdConcepto() );
		$c->add( PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->getCaIdTrayecto() );
		$c->add( PricRecargoxConceptoLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
		$c->setDistinct();
		$stmt = PricRecargoxConceptoLogPeer::doSelectStmt( $c );
		
		$resultados = array();
		while( $row = $stmt->fetch(PDO::FETCH_NUM) ){		
			$idrecargo = $row[0]; 
			//Se sacan el ultimo recargo 
			$c = new Criteria();
			$c->add( PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->getCaIdConcepto() );
			$c->add( PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->getCaIdTrayecto() );
			$c->add( PricRecargoxConceptoLogPeer::CA_IDRECARGO, $idrecargo );
			$c->add( PricRecargoxConceptoLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
			$c->addDescendingOrderByColumn( PricRecargoxConceptoLogPeer::CA_FCHCREADO );		
			$resultados[] = PricRecargoxConceptoLogPeer::doSelectOne( $c );
		}		
		return $resultados;	
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
}
?>