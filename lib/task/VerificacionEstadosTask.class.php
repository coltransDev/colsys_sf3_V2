<?php

class VerificacionEstadosTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'verificacionEstados';
    $this->briefDescription = 'Revisa el la calificación Estado de los Clientes entre Activo y Potencial';
    $this->detailedDescription = <<<EOF
The [verificacionEstados|INFO] task does things.
Call it with:

  [php symfony verificacionEstados|INFO]
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
		
	echo sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'verificaEstados');
  }
}