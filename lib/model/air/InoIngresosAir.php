<?php

/**
 * Subclass for representing a row from the 'tb_inoingresos_air' table.
 *
 * 
 *
 * @package lib.model.air
 */ 
class InoIngresosAir extends BaseInoIngresosAir
{
	public function getImagenFactura(){
		$directory = $this->getInoMaestraAir()->getDirectorio();
		$directory.=DIRECTORY_SEPARATOR."FACT".DIRECTORY_SEPARATOR;
		$file = $directory.str_replace("/","",$this->getCaFactura()).".pdf";
		
		if( file_exists($file) ){
			return $file;
		}else{
			return null;
		}
	}
}
?>