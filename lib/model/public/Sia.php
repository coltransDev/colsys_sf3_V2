<?php

/**
 * Subclass for representing a row from the 'tb_sia' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Sia extends BaseSia
{
	public function __toString(){
		return $this->getCaNombre();
	}
	
	
	
	public function getId(){
		return $this->getCaIdsia();	
	}
}
?>