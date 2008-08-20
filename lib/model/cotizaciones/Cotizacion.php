<?php

/**
 * Subclass for representing a row from the 'tb_cotizaciones' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class Cotizacion extends BaseCotizacion
{
	public function getId(){
		return $this->getCaIdcotizacion();
	}	
	
}
?>