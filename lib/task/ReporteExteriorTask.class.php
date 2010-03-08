<?php
 
class ReporteExteriorTask extends sfDoctrineBaseTask
{
	protected function configure()
	{
	$this->namespace        = 'colsys';
	$this->name             = 'reporteExterior';
	$this->briefDescription = 'Genera una tarea para que se cree el reporte al exterior';
	$this->detailedDescription = <<<EOF
The [reporteExterior|INFO] task does things.
Call it with:

[php symfony reporteExterior|INFO]
EOF;
		// add arguments here, like the following:
		//$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
		// add options here, like the following:
		//$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  	}

	protected function execute($arguments = array(), $options = array()){
		$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true );
					
		$databaseManager = new sfDatabaseManager($configuration);
		$databaseManager->loadConfiguration();
		
		
		$c = new Criteria();
		//$c->add( ReportePeer::CA_IDTAREA_REXT, null, Criteria::ISNULL);
		$c->add( ReportePeer::CA_IMPOEXPO, Constantes::IMPO );	
		$c->add( ReportePeer::CA_FCHCREADO, '2009-06-04' , Criteria::GREATER_EQUAL);	
		//$c->add( ReportePeer::CA_CONSECUTIVO, '8146-2009');		
		
			
		
		$reportes = ReportePeer::doSelect( $c );
				
		foreach( $reportes as $reporte ){
			
			if( $reporte->esUltimaVersion() && !$reporte->getEsAG() && !$reporte->getCaUsuanulado() ){							
				if( !$reporte->getCaIdTareaRext() && !$reporte->getReporteExterior()  ){
					
					if( $reporte->getCaImpoExpo()==Constantes::IMPO ){			
						$tarea = new NotTarea(); 						
						if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
							$tarea->setCaUrl( "/colsys_php/traficos_sea.php?boton=Consultar&id=".$reporte->getCaIdreporte() );
						}else{
							$tarea->setCaUrl( "/colsys_php/traficos_air.php?boton=Consultar&id=".$reporte->getCaIdreporte() );
						}
						
						$tarea->setCaIdlistatarea( 4 );
						$tarea->setCaFchcreado( date("Y-m-d H:i:s") );
						$tarea->setTiempo( TimeUtils::getFestivos(), 57600); // dos días habiles
						$tarea->setCaPrioridad( 1 );
						$tarea->setCaUsucreado( "Administrador" );
						$tarea->setCaTitulo( "Crear Reporte al Ext. RN ".$reporte->getCaConsecutivo() );		
						$tarea->setCaTexto( "" );									
						$tarea->save();
						
						$vendedor = UsuarioPeer::retrieveByPk( $reporte->getCaLogin() );
						
						/*
						* Asigna la tarea a los usuarios de traficos
						*/
						$c = new Criteria();								
						if( $reporte->getCaTransporte()==Constantes::MARITIMO ){		
							$c->add( UsuarioPeer::CA_DEPARTAMENTO, "Tráficos" );				
						}else{
							$c->add( UsuarioPeer::CA_DEPARTAMENTO, "Aéreo" );					
						}												
						$c->add( UsuarioPeer::CA_IDSUCURSAL, $vendedor->getCaIdSucursal() );
						$c->add( UsuarioPeer::CA_ACTIVO, true );
						$usuarios  = UsuarioPeer::doSelect( $c );
						
						$logins = array();
						foreach(  $usuarios as $usuario ){			
							$logins[] = $usuario->getCaLogin();
						}
						$logins = array("abotero");
						$tarea->setAsignaciones( $logins );	
						//$tarea->notificar();			
						
						$reporte->setCaIdtareaRext( $tarea->getCaIdtarea() );
						$reporte->save();
						
					}						
				}
			}else{
				echo $reporte->getCaConsecutivo()."\n";		
				if( $reporte->getCaIdTareaRext() ){
					$tarea = NotTareaPeer::retrieveByPk( $reporte->getCaIdTareaRext() );
					if( $tarea ){
						$tarea->delete();
					}
				}
			}
		}		
	}
}
?>