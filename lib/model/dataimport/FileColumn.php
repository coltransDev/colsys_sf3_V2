<?php

/**
 * Subclass for representing a row from the 'tb_filecolumns' table.
 *
 * 
 *
 * @package lib.model.dataimport
 */ 
class FileColumn extends BaseFileColumn
{
	public function getColumnasRegistros(){
		$c = new Criteria();
		$c->add( FileColumnPeer::CA_IDREGISTRO, $this->getCaIdColumna() );
		$c->addAscendingOrderByColumn(FileColumnPeer::CA_IDCOLUMNA);
		return FileColumnPeer::doSelect( $c );
		
	}
}