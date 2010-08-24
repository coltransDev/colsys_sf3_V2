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

        $app =  sfContext::getInstance()->getConfiguration()->getApplication();       
		$this->opciones = Doctrine::getTable("Rutina")
                                    ->createQuery("r")
                                    ->addWhere("r.ca_aplicacion = ?", $app)
                                    ->addOrderBy("r.ca_grupo")
                                    ->execute();
		
        $rutinasNivel = Doctrine::getTable("RutinaNivel")
                                    ->createQuery("r")
                                    ->addOrderBy("r.ca_rutina")
                                    ->addOrderBy("r.ca_nivel")
                                    ->execute();

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