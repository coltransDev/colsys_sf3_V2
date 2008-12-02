<?php

class EstadosClientesTask extends sfPropelBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'estadosClientes';
    $this->briefDescription = 'Genera Reporte Trimestral de los Clientes que han cambiado su estado durante el periodo';
    $this->detailedDescription = <<<EOF
The [estadosClientes|INFO] task does things.
Call it with:

  [php symfony estadosClientes|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'batch', true);
    
    sfContext::createInstance($configuration)->dispatch();

	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($configuration);
	$databaseManager->loadConfiguration();

	// $user = sfContext::getInstance()->getUser();
	
	$inicio  = mktime(0, 0, 0, date("m")-3, 1, date("Y"));
	$final = mktime(0, 0, 0, date("m"), -1, date("Y"));

	$empresa =  "Coltrans";
	sfContext::getInstance()->getRequest()->setParameter("fchStart", date('m-d-Y',$inicio));
	sfContext::getInstance()->getRequest()->setParameter("fchEnd", date('m-d-Y',$final));
	sfContext::getInstance()->getRequest()->setParameter("empresa", $empresa);
	echo sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'reporteEstadosEmail');	

	$empresa =  "Colmas";
	sfContext::getInstance()->getRequest()->setParameter("empresa", $empresa);
	echo sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'reporteEstadosEmail');	
	
  }
}
