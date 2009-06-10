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
			$reporte = ReportePeer::retrieveByPk($request->getParameter( "id" ));
			
		}		
		$this->forward404Unless( $reporte );		
		
		$this->asignaciones = $reporte->getRepasignacions();
		$this->ultimoReporte = 80037;
					
		if( $reporte->getCaIdreporte()>$this->ultimoReporte  ){ // El ultimo reporte antes de empezar a controlar las impresiones										
				/*
				* Usuarios de traficos 
				* A estos usuarios se les debe crear una tarea para que envien el Rep al exterior 
				*/
				
				$c = new Criteria();				
				if( $reporte->getCaImpoExpo()==Constantes::IMPO ){			
					if( $reporte->getCaTransporte()==Constantes::MARITIMO ){		
						$c->add( UsuarioPeer::CA_DEPARTAMENTO, "Tr�ficos" );				
					}else{
						$c->add( UsuarioPeer::CA_DEPARTAMENTO, "A�reo" );					
					}
				}else{
					$c->add( UsuarioPeer::CA_DEPARTAMENTO, "Exportaciones" );				
				}								
				$c->add( UsuarioPeer::CA_IDSUCURSAL, $this->getUser()->getSucursal()->getCaIdSucursal() );
				$c->add( UsuarioPeer::CA_ACTIVO, true );
				$usuarios  = UsuarioPeer::doSelect( $c );
				$grupos["traficos"] = array();
				foreach(  $usuarios as $usuario ){			
					$grupos["traficos"][] = $usuario->getCaLogin();
				}
			
			
			
			
			
			
			
			
			
			if( count($this->asignaciones)==0 ){
				
				$tarea = new NotTarea(); 
				$tarea->setCaUrl( "/reportes/verReporte/id/".$reporte->getCaIdreporte() );
				$tarea->setCaIdlistatarea( 6 );
				$tarea->setCaFchcreado( time() );		
				$festivos = Utils::getFestivos();	
				$tarea->setCaFchvencimiento( Utils::addTimeWorkingHours( $festivos, date("Y-m-d H:i:s") , 57600)); // dos d�as habiles
				$tarea->setCaUsucreado( "Administrador" );
				$tarea->setCaTitulo( "Reporte ".$reporte->getCaConsecutivo() );		
				$tarea->setCaTexto( "Prueba" );
				
				
				
				$grupos["vendedor"] = array( $reporte->getCaLogin() );			
												
				if( $reporte->getCaColmas()=="S�" ){
					$repAduana = $reporte->getRepAduana(); 
					if( $repAduana && $repAduana->getCaCoordinador() ){
						$grupos["colmas"] = array($repAduana->getCaCoordinador());	
					}
				}
				
				if( $reporte->getCaSeguro()=="S�" ){
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
				
				$this->asignaciones = array(); 
				foreach( $grupos as $logins ){ 			
					$newTarea = $tarea->copy();
					$newTarea->save();
					$newTarea->setAsignaciones( $logins );		
									
					$asignacion = new RepAsignacion();
					$asignacion->setCaIdreporte( $reporte->getCaIdreporte() );			
					$asignacion->setCaIdtarea( $newTarea->getCaIdtarea() );
					$asignacion->save();
					$this->asignaciones[] = $asignacion;
					$newTarea->notificar();				
								
				}
			}
			
			/* Marca como finalizada una tarea */
			
			$c = new Criteria();
			$c->addJoin( NotTareaPeer::CA_IDTAREA, NotTareaAsignacionPeer::CA_IDTAREA );
			$c->addJoin( NotTareaPeer::CA_IDTAREA, RepAsignacionPeer::CA_IDTAREA );
			$c->add( NotTareaAsignacionPeer::CA_LOGIN, $this->getUser()->getUserId() );
			$c->add( RepAsignacionPeer::CA_IDREPORTE, $reporte->getCaIdreporte() );		
			$c->setDistinct();
			
			$tareas = NotTareaPeer::doSelect( $c );
			
			foreach( $tareas as $tarea ){
				if( $tarea && !$tarea->getCaFchterminada() ){
					$tarea->setCaFchterminada( time() );
					$tarea->setCaUsuterminada( $this->getUser()->getUserId() );				
					$tarea->save();
				}
			}		
		}
		$this->reporte = $reporte;
		
		
		
		
		
	}	
}

?>