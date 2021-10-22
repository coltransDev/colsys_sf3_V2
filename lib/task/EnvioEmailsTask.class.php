<?php

class EnvioEmailsTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'envio-emails';
    $this->briefDescription = 'Emails';
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
	
	echo sfContext::getInstance()->getController()->getPresentationFor( 'pruebas', 'EnvioEmails');
  }
}