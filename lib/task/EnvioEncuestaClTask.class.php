<?php

class EnvioEncuestaClTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'envio-encuesta-clientes';
    $this->briefDescription = 'envio';
    $this->detailedDescription = <<<EOF
The [Cierre de reportes|INFO] task does things.
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
	sfContext::getInstance()->getRequest()->setParameter("id", 25);
        //sfContext::getInstance()->getRequest()->setParameter("tipoenvio", "encuesta");
	echo sfContext::getInstance()->getController()->getPresentationFor( 'formulario', 'envioEmailsColmas');
  }
}

