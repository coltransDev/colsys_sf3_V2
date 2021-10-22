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
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true );
	
	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();



    $q = Doctrine::getTable("NotTarea")->createQuery("t");
    $q->select("t.*");
    $q->leftJoin("t.Notificacion n");    
    $q->addWhere("t.ca_fchvisible <= ?", date("Y-m-d H:i:s"));
    $q->addWhere("t.ca_idlistatarea != ? ", 11);
    $q->addWhere("t.ca_fchterminada IS NULL");
    $q->addWhere("n.ca_idemail IS NULL");
    $q->distinct();

    $tareas = $q->execute();
	
	foreach( $tareas as $tarea ){
		$tarea->notificar();
	}	
		
  }
}
?>