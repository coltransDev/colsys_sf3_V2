<?php

/**
 * Subclass for representing a row from the 'tb_falaheader' table.
 *
 * 
 *
 * @package lib.model.falabella
 */ 
class FalaHeader extends BaseFalaHeader
{
	
	public function getFalaShipmentInfo( PropelPDO $con = null ){
		return 	FalaShipmentInfoPeer::retrieveByPk( $this->getCaIdDoc() );
	}
	
	public function getIdDocNeto(){
		$doc_mem = $this->getCaIddoc();
		$pos_mem = strrpos($doc_mem,"-");
		$pos_mem = (($pos_mem===FALSE or $pos_mem<20)?strlen($doc_mem):$pos_mem-1);
		$doc_mem = substr($doc_mem,0,$pos_mem);
		return $doc_mem;
	}	
}
?>