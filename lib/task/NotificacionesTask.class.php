<?php
 
class NotificacionesTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'notificaciones';
    $this->briefDescription = 'Envia notificaciones via email';
    $this->detailedDescription = <<<EOF
The [circularClientes|INFO] task does things.
Call it with:

  [php symfony circularClientes|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'batch', true );
	
	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();
	
	$c = new Criteria();	
	$c->addJoin( NotTareaPeer::CA_IDTAREA, NotificacionPeer::CA_IDTAREA, Criteria::LEFT_JOIN );	
	$c->add( NotTareaPeer::CA_FCHCREADO, '2009-09-10 00:00:00', Criteria::GREATER_EQUAL );
	$c->add( NotTareaPeer::CA_FCHVISIBLE, date("Y-m-d H:i:s"), Criteria::LESS_EQUAL );	
	$c->add( NotTareaPeer::CA_FCHTERMINADA, null, Criteria::ISNULL );
	$c->add( NotificacionPeer::CA_IDEMAIL, null, Criteria::ISNULL );	
	$c->setDistinct();					
	$tareas = NotTareaPeer::doSelect( $c );
	
	foreach( $tareas as $tarea ){
		$tarea->notificar();
	}
	
	
	
		
  }
}
?>