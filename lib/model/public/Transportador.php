<?php

/**
 * Subclass for representing a row from the 'tb_transporlineas' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Transportador extends BaseTransportador
{
	public function __toString(){
		return $this->getCaNombre();
	}
	
	public function getId(){
		return $this->getCaIdlinea();
	}
	
}
?>