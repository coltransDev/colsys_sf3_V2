<?php

class GetDocumentosOtmTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'get-documentos-otm';
    $this->briefDescription = 'captura los documentos de facura enviados por scanner';
    $this->detailedDescription = <<<EOF
The [documentosF|INFO] task does things.
Call it with:

  [php symfony documentos F|INFO]
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
    
    
    sfContext::getInstance()->getRequest()->setParameter("folder", "DOCUMENTOSOTM");
    sfContext::getInstance()->getRequest()->setParameter("iddocumental", "28");
	echo sfContext::getInstance()->getController()->getPresentationFor( 'gestDocumental', 'mailDocumentosF');    
    
  }
}