<?php

class IntegracionColsysSapReenvioTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'integracionColsysSapReenvio';
    $this->briefDescription = 'Lanza la Rutina que Transfiere los Datos desde Colsys a SAP BO';
    $this->detailedDescription = <<<EOF
The [integracionColsysSapReenvio|INFO] task does things.
Call it with:

  [php symfony integracionColsysSapreenvio|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true );
	
	// Borra las dos l?neas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();

	sfContext::createInstance($this->configuration)->dispatch();
        
        //sfContext::getInstance()->getRequest()->setParameter("idtransaccion", null);
	//echo sfContext::getInstance()->getController()->getPresentationFor( 'integraciones', 'enviarSap');
        
        //echo "REENVIO";
        sfContext::getInstance()->getRequest()->setParameter("reenvio", "si");
        echo sfContext::getInstance()->getRequest()->getParameter("reenvio");
	echo sfContext::getInstance()->getController()->getPresentationFor( 'integraciones', 'enviarSap');
  }
}