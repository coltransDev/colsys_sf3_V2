<?php 

class NotListaTareas extends BaseNotListaTareas
{
	/*
	* Lista de tareas pendientes
	*/
	public function getTareasPendientes( $user=null ){
		$c = new Criteria();
		$c->add( NotTareaPeer::CA_IDLISTATAREA, $this->getCaidlistatarea() );
		$c->addAscendingOrderByColumn( NotTareaPeer::CA_PRIORIDAD );
		$c->addAscendingOrderByColumn( NotTareaPeer::CA_FCHVENCIMIENTO );
	
		if( $user ){			
			$c->addJoin( NotTareaPeer::CA_IDTAREA, NotTareaAsignacionPeer::CA_IDTAREA );
			$c->add( NotTareaAsignacionPeer::CA_LOGIN, $user );	
			$c->setDistinct();
		}
		
		$c->add( NotTareaPeer::CA_FCHTERMINADA, null, Criteria::ISNULL );
		return NotTareaPeer::doSelect( $c );	
		
	}
}
?>