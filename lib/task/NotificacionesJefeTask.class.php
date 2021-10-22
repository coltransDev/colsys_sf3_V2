<?php
 
class NotificacionesJefeTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'notificaciones-jefe';
    $this->briefDescription = 'Envia notificaciones via email';
    $this->detailedDescription = <<<EOF
The [notificaciones-jefe|INFO] task does things.
Call it with:

  [php symfony colsys:notificaciones-jefe|INFO]
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
    $q->leftJoin("t.NotListaTareas l");
    $q->addWhere("l.ca_notificar_superior = ?", true);
    $q->addWhere("t.ca_fchcreado >= ?", "2011-01-01");
    $q->addWhere("t.ca_fchvisible <= ?", date("Y-m-d H:i:s"));
    $q->addWhere("t.ca_fchvencimiento <= ?", date("Y-m-d H:i:s") );
    $q->addWhere("t.ca_fchterminada IS NULL");
    $q->addWhere("t.ca_idtarea NOT IN (SELECT ca_idtarea FROM Notificacion WHERE ca_tipo=2)");
    $q->distinct();    
    $tareas = $q->execute();	
	foreach( $tareas as $tarea ){
		$tarea->notificar(null, 2);
	}	
		
  }
}
?>