<?php

class NotificacionesVencimientosTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'notificaciones-vencimientos';
    $this->briefDescription = 'Envia notificaciones a los proveedores sobre el vencimiento de los documentos.';
    $this->detailedDescription = <<<EOF
The [alertaSeguimientos|INFO] task does things.
Call it with:

  [php symfony alertaSeguimientos|INFO]
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

	sfContext::createInstance($this->configuration)->dispatch();	
	
	echo sfContext::getInstance()->getController()->getPresentationFor( 'ids', 'notificacionDocumentosVencidos');
  }
}