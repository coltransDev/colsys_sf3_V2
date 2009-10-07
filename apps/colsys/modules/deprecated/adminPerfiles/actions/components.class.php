<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage adminPerfiles
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class adminPerfilesComponents extends sfComponents
{	
	
	public function executeFormPermisos()
	{
		$c = new Criteria();
		$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
		$this->opciones = RutinaPeer::doSelect( $c );	
		
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( RutinaNivelPeer::CA_RUTINA );
		$c->addAscendingOrderByColumn( RutinaNivelPeer::CA_NIVEL );
		$rutinasNivel = RutinaNivelPeer::doSelect( $c );
		$this->rutinasNivel = array();
		foreach( $rutinasNivel as $rutinaNivel ){
			$this->rutinasNivel[ $rutinaNivel->getcaRutina() ][] = array("nivel"=>$rutinaNivel->getCaNivel(),
																		 "valor"=>$rutinaNivel->getCaValor()
																		);
		}
		
		
		
		if( !isset( $this->accesosPerfil ) ){
			$this->accesosPerfil = null;
		}
	}
}
?>