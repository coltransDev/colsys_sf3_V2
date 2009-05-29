<?php

class NotTarea extends BaseNotTarea
{
	/*
	* Crea las asignaciones a partir de un array de logins
	*/
	public function setAsignaciones( $loginsAsignaciones ){
		$loginsAsignaciones = array_unique( $loginsAsignaciones );
		$c = new Criteria();
		$c->add( NotTareaAsignacionPeer::CA_IDTAREA, $this->getCaIdtarea() );
		$asignaciones = NotTareaAsignacionPeer::doSelect( $c );
			
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
	
	/*
	* Crea notificaciones para los usuarios
	*/
	public function notificar( ){
		$c = new Criteria();
		$c->add( NotTareaAsignacionPeer::CA_IDTAREA, $this->getCaIdtarea() );
		$asignaciones = NotTareaAsignacionPeer::doSelect( $c );
					
		foreach( $asignaciones as $asignacion ){
				
			
			$notificacion = new Notificacion();
			$notificacion->setCaLogin( $asignacion->getCaLogin() );
			$notificacion->setCaUrl( $this->getCaUrl() );
			$notificacion->setCaFchcreado( time() );
			$notificacion->setCaUsucreado( $this->getCaUsucreado() );
						
			$notificacion->setCaTitulo( $this->getCaTitulo() );
			$texto = "Tiene una tarea pendiente con vencimiento en ".$this->getCaFchvencimiento()." \n\n<br /><br />" ;
			
			$texto .= $this->getCaTexto();
			
			
			$notificacion->setCaTexto( $texto );
			$notificacion->save();
		}	
	}
	
	/*
	* Tiempo restante para terminar la tarea
	*/
	public function getTiempoRestante( $festivos  ){
		//echo "<br /> <b>Ini. ".date("Y-m-d H:i:s")." <br />Ven. ".$this->getCaFchvencimiento()."</b><br />";
		return Utils::getHumanTime(Utils::diffTimeWorkingHours( $festivos, date("Y-m-d H:i:s"), $this->getCaFchvencimiento() ));
		
	}
	
	
	/*
	* Retorna la prioridad de acuerdo al numero
	*/
	public function getPrioridad( ){
		switch( $this->getCaPrioridad() ){
			case 0:
				return "Baja";
				break;
			case 1:
				return "Media";
				break;
			case 2:
				return "Alta";
				break;
			case 3:
				return "Critica";
				break;		
		}
		
	}
	
	
	
	
}
?>