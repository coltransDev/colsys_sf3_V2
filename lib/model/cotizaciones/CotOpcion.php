<?php

/**
 * Subclass for representing a row from the 'tb_cotopciones' table.
 *
 * 
 * 
 * @package lib.model.cotizaciones
 */ 
class CotOpcion extends BaseCotOpcion
{
	/*
	* Retorna un resumen del texto que aparecera en los recargos
	*/
	public function getTextoRecargos(){
		$textoRecargos = '';		
		$recargos = $this->getCotRecargos( );
		foreach( $recargos as $recargo ){	
			$tipoRecargo = $recargo->getTipoRecargo();
			if ( $recargo->getCaIdopcion() != 999 or $recargo->getCaIdconcepto() != 9999 and $tipoRecargo->getCatipo() == 'Recargo en Origen'){					
				$textoRecargos.= $recargo->getTextoRecargo()."\n";			
			}
		}	
		return $textoRecargos;
	}
	
	/*
	* Retorna el valor que se coloco en la oferta en texto
	*/
	public function getTextoFlete(){
		
		/*$producto = $this->getCotProducto();
		$aflete = explode('|',$this->getCaOferta());	
		
		@$apl_mem = ((strlen($aflete[2])!=0)?" ".$aflete[2]:"");
		$min_mem = (($producto->getCaTransporte()=='Aéreo')?' x HAWB':' x HBL');
		return @$this->getCaIdmoneda()." ".$aflete[0].$apl_mem.((@$aflete[1]!=0)?" / Min. ".$this->getCaIdmoneda().$aflete[1].$min_mem:"");*/
		
		$texto = $this->getCaIdmoneda()." ".Utils::formatNumber($this->getCaValorTar())." ".$this->getCaAplicaTar();
		if( $this->getCaValorMin()!=0 && $this->getCaValorMin() ){
			$texto .= " / Min. ".Utils::formatNumber($this->getCaValorMin())." ".$this->getCaAplicaMin();
		}
		return $texto;
		
	}
		
	
}
?>