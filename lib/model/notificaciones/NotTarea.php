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
		
		$lista = $this->getNotListaTareas();
		
		$c = new Criteria();
		$c->add( NotTareaAsignacionPeer::CA_IDTAREA, $this->getCaIdtarea() );
		$asignaciones = NotTareaAsignacionPeer::doSelect( $c );
		
		$email = new Email();		
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $this->getCaUsucreado() );
		$email->setCaTipo( "Notificación Tareas" ); 		
		$email->setCaIdcaso( $this->getCaIdtarea() );
		$email->setCaFrom( "no-reply@coltrans.com.co" );
		$email->setCaFromname( "Colsys Notificaciones" );
		
		$usuariosAsignacion = array();
		foreach( $asignaciones as $asignacion ){
			$usuario = UsuarioPeer::retrieveByPk( $asignacion->getCaLogin() );					
			$email->addTo( $usuario->getCaEmail() ); 
			
			$usuariosAsignacion[] = $usuario;
		}
								
		$email->setCaSubject( $this->getCaTitulo() );				
				
		$texto = "Tiene una tarea pendiente con vencimiento en ".Utils::fechaMes($this->getCaFchvencimiento("Y-m-d"))." ".$this->getCaFchvencimiento("H:i:s")." \n\n<br /><br />" ;			
		$texto .= "<a href='https://www.coltrans.com.co/notificaciones/realizarTarea/id/".$this->getCaIdtarea()."'>Haga click aca para realizarla </a> \n\n<br /><br />" ;		
		$texto .= "Descripción de la tarea: <br /><b>".$lista->getCaNombre()."</b><br /> ".$lista->getCaDescripcion()." \n\n<br /><br />" ;	
				
		$texto .= "Asignación de la tarea: <br /><br /><table border='0'><tr><th>Nombre</th> <th>Correo electronico</th></tr>";	
		foreach( $usuariosAsignacion as $usuario ){		
			$texto .= "<tr><td>".$usuario->getCaNombre()."</td> <td>".$usuario->getCaEmail()."</td></tr>";	
		}
		$texto .= "</table>";	
		
			
		
		
		
		
		$texto .= $this->getCaTexto();
				
		$email->setCaBodyhtml( $texto );		
		$email->save();
		$email->send();		
	}
	
	/*
	* Tiempo restante para terminar la tarea
	*/
	public function getTiempoRestante( $festivos  ){
		//echo "<br /> <b>Ini. ".date("Y-m-d H:i:s")." <br />Ven. ".$this->getCaFchvencimiento()."</b><br />";
		return Utils::getHumanTime(Utils::diffTimeWorkingHours( $festivos, date("Y-m-d H:i:s"), $this->getCaFchvencimiento() ));
	}
	
	/*
	* Tiempo restante para terminar la tarea
	*/
	public function getTiempo( $festivos  ){		
		return Utils::getHumanTime(Utils::diffTimeWorkingHours( $festivos, $this->getCaFchcreado(), $this->getCaFchvencimiento() ));
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
	
	public function getUsuarios(){
		$c = new Criteria();
		$c->add( NotTareaAsignacionPeer::CA_IDTAREA, $this->getCaIdtarea() );
		$asignaciones = NotTareaAsignacionPeer::doSelect( $c );
		
		$loginsAsignaciones = array();
		foreach( $asignaciones as $asignacion ){
			$loginsAsignaciones[]=$asignacion->getCaLogin();
		}
		
		$c = new Criteria();
		$c->add( UsuarioPeer::CA_LOGIN, $loginsAsignaciones, Criteria::IN );
		return UsuarioPeer::doSelect( $c );
		
		
	}
	
	
	
	
}
?>