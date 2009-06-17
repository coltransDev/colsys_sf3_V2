<?php

/**
 * Subclass for performing query and update operations on the 'tb_parametros' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class ParametroPeer extends BaseParametroPeer
{
	public static function retrieveByCaso( $casoUso, $valor1=null, $valor2=null, $id=null ){		
		$c = self::getCriteriaByCu( $casoUso, $valor1, $valor2, $id );
		return ParametroPeer::doSelect( $c );		
	}
	
	public static function getCriteriaByCu( $casoUso, $valor1=null, $valor2=null, $id=null ){
		$c=new Criteria();
		$c->add( ParametroPeer::CA_CASOUSO, $casoUso );
		if( $valor1 ){
			$c->add( ParametroPeer::CA_VALOR, "%".$valor1."%", Criteria::LIKE );
		}

		if( $valor2 ){
			$c->add( ParametroPeer::CA_VALOR2, "%".$valor2."%", Criteria::LIKE );
		}

		if( $id ){
			$c->add( ParametroPeer::CA_IDENTIFICACION, $id);
		}

		$c->addAscendingOrderByColumn( ParametroPeer::CA_IDENTIFICACION );
		return $c;
	}
}

?>