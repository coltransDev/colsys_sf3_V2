<?php

/**
 * Subclass for representing a row from the 'tb_faladetails' table.
 *
 * 
 *
 * @package lib.model.falabella
 */
class FalaDetail extends BaseFalaDetail
{
	public function getSkuNeto(){
		$sku_mem = $this->getCaSku();
		$pos_mem = strpos($sku_mem,"-");
		$pos_mem = (($pos_mem===FALSE)?strlen($sku_mem):$pos_mem-1);
		$sku_mem = substr($sku_mem,0,$pos_mem);
		return $sku_mem;
	}	
	
}