<?php

class VencimientoEstadoTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'vencimientoEstado';
    $this->briefDescription = 'Cambia de Estado Clientes Activos y que tiene más de 1 año sin reportar negocios';
    $this->detailedDescription = <<<EOF
The [vencimientoEstado|INFO] task does things.
Call it with:

  [php symfony vencimientoEstado|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
        $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);
    
        sfContext::createInstance($configuration)->dispatch();
		
	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($configuration);
	$databaseManager->loadConfiguration();

	echo sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'vencimientoEstado');

  }
}