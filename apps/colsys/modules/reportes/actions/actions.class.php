<?php

/**
* Modulo de creacion de reportes Basado en el modulo de reportes de Carlos Lopez y
* solo que ademas permite crear reportes de exportaciones, adicionalmente entra el
* concepto de embarque.
*
* @package    colsys
* @subpackage reportes
* @author     Your name here
* @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
*/
class reportesActions extends sfActions
{
	/**
	* @author Andres Botero
	*/
	public function executeIndex()
	{	
		
	}	
	
	
	/**
	* @author Andres Botero
	*/
	public function executeVerReporte( $request )
	{	
		if( $request->getParameter( "id" ) ){
			$reporte = Doctrine::getTable("Reporte")->find($request->getParameter( "id" ));
		}

						
		$this->forward404Unless( $reporte );		
						
		$this->getUser()->log( "Consulta Reporte" );
				
		$this->logs = Doctrine::getTable("UsuarioLog")
                                ->createQuery("l")
                                ->where("l.ca_url like ? or l.ca_url like ?", array("/reportes/verReporte/id/".$reporte->getCaIdreporte()."%", "/reportes/verReporte?id=".$reporte->getCaIdreporte()."%" ))
                                ->addOrderBy("l.ca_fchevento")
                                ->execute();

		
		
		/* Marca como finalizada una tarea */
						
		$tareas = Doctrine::getTable("NotTarea")
                            ->createQuery("t")
                            ->innerJoin("t.NotTareaAsignacion a")
                            ->innerJoin("t.RepAsignacion r")
                            ->where("a.ca_login = ? ", $this->getUser()->getUserId())
                            ->addWhere("r.ca_idreporte = ? ", $reporte->getCaIdreporte() )
                            ->distinct()
                            ->execute();
		
		foreach( $tareas as $tarea ){
			if( $tarea && !$tarea->getCaFchterminada() ){
				$tarea->setCaFchterminada( date("Y-m-d H:i:s") );
				$tarea->setCaUsuterminada( $this->getUser()->getUserId() );				
				$tarea->save();
			}
		}
			
		
		
		if( $reporte->getCaIdtareaRext() ){
			$this->tarea = Doctrine::getTable("NotTarea")->find( $reporte->getCaIdtareaRext() );
		}else{
			$this->tarea = null;
		}
		
		$this->asignaciones = $reporte->getRepAsignacion();
		$this->reporte = $reporte;		
						
	}	
	
	/**
	* Envia una notificacion a los usuarios relacionados en el reporte	
	* @author Andres Botero
	*/

    public function executeEnviarNotificacion( $request ){
        if( $request->getParameter( "idreporte" ) ){
			$reporte = Doctrine::getTable("Reporte")->find($request->getParameter( "idreporte" ));
		}

		$this->forward404Unless( $reporte );

        $grupos = array( );

        $usuarios  = $reporte->getUsuariosOperativos();

        if( $reporte->getCaImpoexpo()==Constantes::IMPO ||  $reporte->getCaImpoexpo()==Constantes::TRIANGULACION ){
            $grupos["operativo"] = array();
            foreach(  $usuarios as $usuario ){
                $grupos["operativo"][] = $usuario->getCaLogin();
            }
        }else{
            $grupos["exportaciones"] = array();
			foreach(  $usuarios as $usuario ){
				$grupos["exportaciones"][] = $usuario->getCaLogin();
			}
        }


        $grupos["vendedor"] = array( $reporte->getCaLogin() );

        
        if( $reporte->getCaColmas()=="Sí" ){
			$repAduana = $reporte->getRepAduana(); 
			if( $repAduana && $repAduana->getCaCoordinador() ){
				$grupos["colmas"] = array($repAduana->getCaCoordinador());
			}
		}
		
		if( $reporte->getCaSeguro()=="Sí" ){
			$repSeguro = $reporte->getRepSeguro(); 
			if( $repSeguro && $repSeguro->getCaSeguroConf() ){
				$grupos["seguros"] = array($repSeguro->getCaSeguroConf());
			}
		}
			
		if( $reporte->getCaContinuacion()!="N/A" ){
			
			if( $reporte->getCaContinuacionConf() ){
				$grupos["otm"] = array( $reporte->getCaContinuacionConf());
			}
		}

        //Crea la tarea para los usuarios seleccionados
        if ($request->isMethod('post')){		
            $notificar = $request->getParameter("notificar");
            //Reporte al exterior           
            if( $reporte->getCaIdtareaRext() ){
                $tarea = Doctrine::getTable("NotTarea")->find( $reporte->getCaIdtareaRext() );
                $tarea->delete();
            }

            if( $reporte->getCaImpoexpo()==Constantes::IMPO ||  $reporte->getCaImpoexpo()==Constantes::TRIANGULACION ){

                $tarea = new NotTarea();
                if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
                    $tarea->setCaUrl( "/colsys_php/traficos_sea.php?boton=Consultar&id=".$reporte->getCaIdreporte() );
                }else{
                    $tarea->setCaUrl( "/colsys_php/traficos_air.php?boton=Consultar&id=".$reporte->getCaIdreporte() );
                }

                $tarea->setCaIdlistatarea( 4 );
                $tarea->setCaFchcreado( date("Y-m-d H:i:s") );
                $festivos = Utils::getFestivos();
                $tarea->setCaFchvencimiento( date("Y-m-d H:i:s",Utils::addTimeWorkingHours( $festivos, date("Y-m-d H:i:s") , 57600))); // dos días habiles
                $tarea->setCaPrioridad( 1 );
                $tarea->setCaUsucreado( "Administrador" );

                $titulo = "Crear Reporte al Ext. RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";

                $tarea->setCaTitulo( $titulo );
                $tarea->setCaTexto( "Debe crear el reporte al exterior del reporte de negocio en referencia para cumplir esta tarea" );
                $tarea->save();

                if( isset($grupos["operativo"]) ){
                    $logins =  $grupos["operativo"];
                    $asignaciones = array();

                    foreach( $logins as $login ){
                        if( in_array($login, $notificar ) ){
                            $asignaciones[]=$login;
                        }
                    }
                    $tarea->setAsignaciones( $asignaciones );
                    $reporte->setCaIdtareaRext( $tarea->getCaIdtarea() );
                    $reporte->stopBlaming();
                    $reporte->save();
                }
            }
            //Ver reporte
            $asignacionesReporte = $reporte->getRepAsignacion();
            //Borra las tareas existentes
            foreach( $asignacionesReporte as $asignacion ){
                $asignacion->delete();
            }

            $tarea = new NotTarea();
            $tarea->setCaUrl( "/reportes/verReporte/id/".$reporte->getCaIdreporte() );
            $tarea->setCaIdlistatarea( 6 );
            $tarea->setCaFchcreado( date("Y-m-d H:i:s") );
            $festivos = Utils::getFestivos();
            $tarea->setCaFchvencimiento( Utils::addTimeWorkingHours( $festivos, date("Y-m-d H:i:s") , 57600)); // dos días habiles
            $tarea->setCaUsucreado( "Administrador" );
            $titulo = "Se ha creado el RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
            $tarea->setCaTitulo( $titulo );
            $tarea->setCaTexto( "Debe abrir el reporte haciendo click en el link para cumplir esta tarea" );
            
            foreach( $grupos as $key =>$logins ){
                if( $key=="operativo" ){
                    continue;
                }
                foreach( $logins as $login ){
                    if( in_array($login, $notificar ) ){
                        $newTarea = $tarea->copy();
                        $newTarea->save();
                        $newTarea->setAsignaciones( array($login) );
                        $asignaciones[] = $login;

                        $asignacion = new RepAsignacion();
                        $asignacion->setCaIdreporte( $reporte->getCaIdreporte() );
                        $asignacion->setCaIdtarea( $newTarea->getCaIdtarea() );
                        $asignacion->save();
                    }
                }
            }
            $this->asignaciones = $asignaciones;
            $this->setTemplate("enviarNotificacionResult");
        }        

        $this->grupos = $grupos;
        $this->reporte = $reporte;
    }

}

?>