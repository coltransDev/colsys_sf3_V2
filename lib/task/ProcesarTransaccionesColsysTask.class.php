<?php

class ProcesarTransaccionesColsysTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'procesarTransaccionesColsys';
    $this->briefDescription = 'Lanza la Rutina que genera los Json de las transacciones pendientes';
    $this->detailedDescription = <<<EOF
The [procesarTransaccionesColsys|INFO] task does things.
Call it with:

  [php symfony procesarTransaccionesColsys|INFO]
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
        
        sfContext::getInstance()->getRequest()->setParameter("idtipo", null);
        sfContext::getInstance()->getRequest()->setParameter("indice1", null);
	echo sfContext::getInstance()->getController()->getPresentationFor( 'integraciones', 'procesarTransacciones');
  }
}