<?php

/**
 * Subclass for representing a row from the 'tb_repexpo' table.
 *
 * 
 *
 * @package lib.model.reportes
 */ 
class RepExpo extends BaseRepExpo
{
	public function getTipoExpo(){
		$c=new Criteria();
		$c->add( ParametroPeer::CA_CASOUSO, "CU011" );
		$c->add( ParametroPeer::CA_IDENTIFICACION, $this->getCaTipoexpo() );		
		$modalidad = ParametroPeer::doSelectOne( $c );
		
		if( $modalidad ){
			return $modalidad->getCaValor();
		}else{
			return null;
		}
	}
	
	public function getSia(){
		return SiaPeer::retrieveByPk( $this->getCaIdsia() );
	}
	
	public function getTransportadorTerrestre( $con = null ){
		return TransportadorPeer::retrieveByPK($this->ca_idlineaterrestre, $con);
	}
}
?>