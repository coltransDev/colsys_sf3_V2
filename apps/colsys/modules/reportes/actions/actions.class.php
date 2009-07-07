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
						
		$this->getUser()->log( "Consulta Reporte" );
		
		$c = new Criteria();
		$c->add( UsuarioLogPeer::CA_URL, "/reportes/verReporte/id/".$reporte->getCaIdreporte()."%", Criteria::LIKE );
		$c->addOr( UsuarioLogPeer::CA_URL, "/reportes/verReporte?id=".$reporte->getCaIdreporte()."%", Criteria::LIKE );
		$c->addDescendingOrderByColumn( UsuarioLogPeer::CA_FCHEVENTO );
		$this->logs = UsuarioLogPeer::doSelect( $c );	
		
		
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
			
		$this->reporte = $reporte;						
	}	
	
	/**
	* Envia una notificacion a los usuarios relacionados en el reporte	
	* @author Andres Botero
	*/
	public function executeEnviarNotificacion( $request ){
		
		if( $request->getParameter( "idreporte" ) ){
			$reporte = ReportePeer::retrieveByPk($request->getParameter( "idreporte" ));
			
		}		
		$this->forward404Unless( $reporte );		
		
		
		
		$usuarios  = $reporte->getUsuariosOperativos();
		
		$this->gruposCrearReporte = array();
		if( $reporte->getCaImpoExpo()==Constantes::IMPO ){		
			
			
			
			if( !$reporte->getReporteExterior()  ){
				if( $reporte->getCaIdTareaRext() ){
					$tarea = NotTareaPeer::retrieveByPk( $reporte->getCaIdTareaRext() );
					$tarea->delete();
				}
				$tarea = new NotTarea(); 						
				if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
					$tarea->setCaUrl( "/colsys_php/traficos_sea.php?boton=Consultar&id=".$reporte->getCaIdreporte() );
				}else{
					$tarea->setCaUrl( "/colsys_php/traficos_air.php?boton=Consultar&id=".$reporte->getCaIdreporte() );
				}
				
				$tarea->setCaIdlistatarea( 4 );
				$tarea->setCaFchcreado( time() );		
				$festivos = Utils::getFestivos();	
				$tarea->setCaFchvencimiento( Utils::addTimeWorkingHours( $festivos, date("Y-m-d H:i:s") , 57600)); // dos días habiles
				$tarea->setCaPrioridad( 1 );
				$tarea->setCaUsucreado( "Administrador" );
				
				$titulo = "Crear Reporte al Ext. RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
				
				
				$tarea->setCaTitulo( $titulo );		
				$tarea->setCaTexto( "Debe crear el reporte al exterior del reporte de negocio en referencia para cumplir esta tarea" );									
				$tarea->save();
				
				$vendedor = UsuarioPeer::retrieveByPk( $reporte->getCaLogin() );
				
				/*
				* Asigna la tarea a los usuarios de traficos
				*/
							
				$logins = array();
				foreach(  $usuarios as $usuario ){			
					$logins[] = $usuario->getCaLogin();
				}
				//$logins = array("abotero");
				$tarea->setAsignaciones( $logins );	
				$tarea->notificar();			
				
				$reporte->setCaIdtareaRext( $tarea->getCaIdtarea() );
				$reporte->save();
				$this->gruposCrearReporte = $logins;
			}
		}else{
			/*
			* Usuarios de traficos 
			* A estos usuarios se les debe crear una tarea para que envien el Rep al exterior 
			*/
					
			
			$grupos["exportaciones"] = array();
			foreach(  $usuarios as $usuario ){			
				$grupos["exportaciones"][] = $usuario->getCaLogin();
			}
		}
		
		
		$asignaciones = $reporte->getRepasignacions();		
		
		foreach( $asignaciones as $asignacion ){
			$asignacion->delete();
		}
		
		
			
		$tarea = new NotTarea(); 
		$tarea->setCaUrl( "/reportes/verReporte/id/".$reporte->getCaIdreporte() );
		$tarea->setCaIdlistatarea( 6 );
		$tarea->setCaFchcreado( time() );		
		$festivos = Utils::getFestivos();	
		$tarea->setCaFchvencimiento( Utils::addTimeWorkingHours( $festivos, date("Y-m-d H:i:s") , 57600)); // dos días habiles
		$tarea->setCaUsucreado( "Administrador" );
		$titulo = "Se ha creado el RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
		$tarea->setCaTitulo( $titulo );		
		$tarea->setCaTexto( "Debe abrir el reporte haciendo click en el link para cumplir esta tarea" );
		
		
		
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
		
		$this->asignaciones = array(); 
		foreach( $grupos as $logins ){ 			
			$newTarea = $tarea->copy();
			$newTarea->save();
			$newTarea->setAsignaciones( $logins );		
					
			$this->asignaciones[] = $logins;
				
						
		}
		
		$this->gruposVerReporte = $grupos;		
		$this->reporte = $reporte;		
	}
}

?>