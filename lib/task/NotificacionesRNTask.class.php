<?php
 
class NotificacionesRnTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'notificaciones_rn';
    $this->briefDescription = 'Envia notificaciones via email';
    $this->detailedDescription = <<<EOF
The [Notificaciones de RN|INFO] task does things.
Call it with:

  [php symfony notiRn|INFO]
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
    $q = Doctrine::getTable("NotTarea")
            ->createQuery("t")
            ->select("t.*")
            ->leftJoin("t.Notificacion n")    
            ->where("t.ca_idlistatarea = ? ", 11)            
            ->addWhere("t.ca_fchvencimiento <= ?", date("Y-m-d H:i:s"))
            ->addWhere("t.ca_fchterminada IS NULL")
            ->addWhere("n.ca_idemail IS NULL")
            ->distinct();

    $tareas = $q->execute();

	foreach( $tareas as $tarea ){        
		$tarea->notificar();
	}
  }
}
?>