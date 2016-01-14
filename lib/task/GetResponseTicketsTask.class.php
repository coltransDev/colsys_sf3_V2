<?php

class GetResponseTicketsTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'get-response-tickets';
    $this->briefDescription = 'captura los documentos de facura enviados por scanner';
    $this->detailedDescription = <<<EOF
The [responseTickets|INFO] task does things.
Call it with:

  [php symfony responseTickets|INFO]
EOF;

  }

protected function execute($arguments = array(), $options = array())
{
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true );
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();
	sfContext::createInstance($this->configuration)->dispatch();  
        
	echo sfContext::getInstance()->getController()->getPresentationFor( 'helpdesk', 'responseTickets');
  }
}