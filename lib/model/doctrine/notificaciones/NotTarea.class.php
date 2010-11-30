<?php

/**
 * NotTarea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class NotTarea extends BaseNotTarea
{
    /*
	* Crea las asignaciones a partir de un array de logins
	*/
	public function setAsignaciones( $loginsAsignaciones ){
		$loginsAsignaciones = array_unique( $loginsAsignaciones );
		
        $asignaciones = Doctrine::getTable("NotTareaAsignacion")
                        ->createQuery("a")
                        ->where("a.ca_idtarea = ?", $this->getCaIdtarea() )
                        ->execute();

		foreach( $asignaciones as $asignacion ){
			$asignacion->delete();
		}

		foreach( $loginsAsignaciones as $loginsAsignacion ){
			$asignacion = new NotTareaAsignacion();
			$asignacion->setCaIdtarea( $this->getCaIdtarea() );
			$asignacion->setCaLogin( $loginsAsignacion );
			$asignacion->save();
		}
	}

	/*
	* Crea notificaciones para los usuarios
	*/
	public function notificar( ){

		$lista = Doctrine::getTable("NotListaTareas")->find( $this->getCaIdlistatarea());

		$asignaciones = Doctrine::getTable("NotTareaAsignacion")
                        ->createQuery("a")
                        ->where("a.ca_idtarea = ?", $this->getCaIdtarea() )
                        ->execute();

		$email = new Email();		
		$email->setCaUsuenvio( $this->getCaUsucreado() );
		$email->setCaTipo( "Notificación Tareas" );
		$email->setCaIdcaso( $this->getCaIdtarea() );
		$email->setCaFrom( "no-reply@coltrans.com.co" );
		$email->setCaFromname( "Colsys Notificaciones" );

        if( $this->getCaNotificar() ){            
            $email->addTo( $this->getCaNotificar() );
        }

        $usuariosAsignacion = array();
        foreach( $asignaciones as $asignacion ){
            $usuario = Doctrine::getTable("Usuario")->find( $asignacion->getCaLogin() );
            if( !$this->getCaNotificar() ){
                $email->addTo( $usuario->getCaEmail() );
            }

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

		$notificacion = new Notificacion();
		$notificacion->setCaIdtarea( $this->getCaIdtarea() );
		$notificacion->setCaIdemail( $email->getCaIdemail() );
		$notificacion->save();
	}

	/*
	* Tiempo restante para terminar la tarea
	*/
	public function getTiempoRestante( $festivos  ){
		//echo "<br /> <b>Ini. ".date("Y-m-d H:i:s")." <br />Ven. ".$this->getCaFchvencimiento()."</b><br />";
		return TimeUtils::getHumanTime(TimeUtils::calcDiff( $festivos, time(), strtotime($this->getCaFchvencimiento()) ));
	}

	/*
	* Tiempo restante para terminar la tarea
	*/
	public function getTiempo( $festivos  ){
		return TimeUtils::getHumanTime(TimeUtils::calcDiff( $festivos, strtotime($this->getCaFchcreado()), strtotime($this->getCaFchterminada()) ));
	}

    /*
    public function getTiempoRestante( $festivos  ){
		//echo "<br /> <b>Ini. ".date("Y-m-d H:i:s")." <br />Ven. ".$this->getCaFchvencimiento()."</b><br />";
        return Utils::getHumanTime(TimeUtils::calcDiff( $festivos, time(), strtotime($this->getCaFchvencimiento()) ));
	}
	public function getTiempo( $festivos  ){
		return Utils::getHumanTime(TimeUtils::calcDiff( $festivos, $this->getCaFchcreado(), $this->getCaFchvencimiento() ));
	}
     */



	/*
	* Tiempo restante para terminar la tarea
	*/
	public function setTiempo( $festivos, $seconds  ){
		$fecha = TimeUtils::addTimeWorkingHours( $festivos, $this->getCaFchcreado( ) , $seconds );
		$this->setCaFchvencimiento( date("Y-m-d H:i:s",$fecha) );		
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
		$asignaciones = Doctrine::getTable("NotTareaAsignacion")
                        ->createQuery("a")
                        ->where("a.ca_idtarea = ?", $this->getCaIdtarea() )
                        ->execute();

		$loginsAsignaciones = array();
		foreach( $asignaciones as $asignacion ){
			$loginsAsignaciones[]=$asignacion->getCaLogin();
		}

		$c = new Criteria();
		$c->add( UsuarioPeer::CA_LOGIN, $loginsAsignaciones, Criteria::IN );

        return Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->whereIn("u.ca_login ", $this->getCaIdtarea() )
                        ->execute();

		return UsuarioPeer::doSelect( $c );


	}

}