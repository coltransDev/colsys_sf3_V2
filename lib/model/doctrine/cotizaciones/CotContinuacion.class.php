<?php

/**
 * CotContinuacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class CotContinuacion extends BaseCotContinuacion
{
    /*
	* Retorna el objeto ciudad asociado al campo ca_origen
	* Author: Andres Botero
	*/
	public function getOrigen(){
		return Doctrine::getTable("Ciudad")->find($this->getCaOrigen());
	}

	/*
	* Retorna el objeto ciudad asociado al campo ca_destino
	* Author: Andres Botero
	*/
	public function getDestino(){
        return Doctrine::getTable("Ciudad")->find($this->getCaDestino());
	}

	public function getEquipo(){
        $concepto = Doctrine::getTable("Concepto")->find($this->getCaIdequipo());
		if( $concepto ){
			return $concepto->getCaConcepto();
		}
	}

	public function getTexto(){

		$concepto = $this->getConcepto();
		$equipo = $this->getEquipo();

		if( $concepto->getCaConcepto()!=$equipo && $equipo ){
			$str= $concepto->getCaConcepto()." en ".$equipo;
		}else{
			$str= $concepto->getCaConcepto();
		}
		return $str;
	}

	public function getTextoTarifa(){
		$str = $this->getCaIdmoneda()." ".Utils::formatNumber($this->getCaValorTar());
		if( $this->getCaValorMin() ){
			$str .= " /Min. ". $this->getCaIdmoneda()." ".Utils::formatNumber($this->getCaValorMin());
		}
		return $str;
	}
}