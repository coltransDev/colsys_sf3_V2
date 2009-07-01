<?php

class CotSeguimiento extends BaseCotSeguimiento
{
	public function getEtapa(){
		$parametro = ParametroPeer::retrieveByCaso("CU074", $this->getCaEtapa() );
		
		if( $parametro ){
			return $parametro[0]->getCaValor2();
		}
	}
}
?>