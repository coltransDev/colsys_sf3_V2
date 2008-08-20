<?php

/**
 * Subclass for representing a row from the 'tb_cotrecargos' table.
 *
 *  
 *
 * @package lib.model.cotizaciones
 */ 
class CotRecargo extends BaseCotRecargo
{
	/*
	* Retorna un resumen del texto que aparecera en los recargos
	*/
	public function getTextoRecargo(){	
		$tipoRecargo = $this->getTipoRecargo();
		$textoRecargos = "» ".$tipoRecargo->getCaRecargo()." ".(($this->getCaTipo()=='%')?$this->getCaTipo():$this->getCaIdmoneda())." ".Utils::formatNumber($this->getCaValorTar(),3)." ".$this->getCaAplicaTar().(($this->getCaValorMin()!=0)?" /Mín.".$this->getCaIdmoneda()." ".Utils::formatNumber($this->getCaValorMin(),3)." ".$this->getCaAplicaMin():"").((strlen($this->getCaObservaciones()))?" ".$this->getCaObservaciones():'');			
			
		return $textoRecargos;
	}
	
	
	
} 
?>