<?php

/**
 * Subclass for performing query and update operations on the 'control.tb_usuarios' table.
 *
 * 
 *
 * @package lib.model.control
 */ 
class UsuarioPeer extends BaseUsuarioPeer
{

	public static function getComerciales(){
		$c = new Criteria();
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_NOMBRE );
		$criterion = $c->getNewCriterion( UsuarioPeer::CA_CARGO ,'Gerente Sucursal' );								
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_CARGO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Comercial%', Criteria::LIKE ));
		$c->add($criterion);
		return UsuarioPeer::doSelect( $c );	
	}
}
