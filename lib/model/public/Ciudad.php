<?php

/**
 * Subclass for representing a row from the 'tb_ciudades' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Ciudad extends BaseCiudad
{
	public function __toString(){
		return $this->getPaisCiudad();
	} 
	
	public function getid(){
		return $this->getCaIdciudad();
	}
	
	public function getPaisCiudad(){		
		$trafico = $this->getTrafico();
		$resultado = "";
		if( $trafico ){
			$resultado = $trafico->getCaNombre()." - ";
		}
		$resultado.= $this->getCaCiudad();
		return $resultado;
	}
	
	public function getCaTrafico(){		
		$trafico = $this->getTrafico();		
		if( $trafico ){
			return $trafico->getCaNombre();
		}
		
	}
}
