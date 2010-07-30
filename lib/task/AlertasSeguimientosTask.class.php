<?php

class AlertaSeguimientosTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'alertasSeguimientos';
    $this->briefDescription = 'Genera Reporte Mensual de las Cotizaciones que estan en seguimiento';
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
	
	// Borra las dos l�neas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();

	sfContext::createInstance($this->configuration)->dispatch();	
	
	echo sfContext::getInstance()->getController()->getPresentationFor( 'cotseguimientos', 'reporteSeguimientosEmail');
  }
}