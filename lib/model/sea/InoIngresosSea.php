<?php

/**
 * Subclass for representing a row from the 'tb_inoingresos_sea' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class InoIngresosSea extends BaseInoIngresosSea
{
	public function getImagenFactura(){
		$directory = $this->getInoMaestraSea()->getDirectorio();
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