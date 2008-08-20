<?php

/**
 * Subclass for representing a row from the 'tb_agentes' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Agente extends BaseAgente
{
	public function __toString(){
		return $this->getCaNombre();
	}
	
	
	
	public function getId(){
		return $this->getCaIdagente();		
	}
}
?>