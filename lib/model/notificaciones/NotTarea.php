<?php

class NotTarea extends BaseNotTarea
{
	public function setAsignaciones( $loginsAsignaciones ){
		$asignaciones = $this->getNotTareaAsignacions();
			
		foreach( $asignaciones as $asignacion ){
			$asignacion->delete();
		}
		
		foreach( $loginsAsignaciones as $loginsAsignacion ){
			$asignacion = new NotTareaAsignacion();
			$asignacion->setCaIdTarea( $this->getCaIdtarea() );
			$asignacion->setCaLogin( $loginsAsignacion );
			$asignacion->save();
		}
	}	
}
?>