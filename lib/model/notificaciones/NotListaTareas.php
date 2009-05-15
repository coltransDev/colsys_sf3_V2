<?php

class NotListaTareas extends BaseNotListaTareas
{
	/*
	* Lista de tareas pendientes
	*/
	public function getTareasPendientes(){
		$c = new Criteria();
		$c->addAscendingOrderByColumn( NotTareaPeer::CA_PRIORIDAD );
		$c->addAscendingOrderByColumn( NotTareaPeer::CA_FCHCREADO );
		$c->add( NotTareaPeer::CA_FCHTERMINADA, null, Criteria::ISNULL );
		return NotTareaPeer::doSelect( $c );	
		
	}
}
