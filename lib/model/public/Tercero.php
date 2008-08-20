<?php

/**
 * Subclass for representing a row from the 'tb_terceros' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Tercero extends BaseTercero
{
	public function __toString(){
		return $this->getCaNombre();
	}
	
	public function getId(){
		return $this->getCaIdtercero();
	}
	
	public function getContacto(){
		return $this->getCaContacto();
	}
}
