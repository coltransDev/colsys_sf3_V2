<?php

class CartaGarantiaClientesTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'cartaGarantiaClientes';
    $this->briefDescription = 'Genera Reporte Mensual de los Clientes que se les vence su Carta de Garantía';
    $this->detailedDescription = <<<EOF
The [cartaGarantiaClientes|INFO] task does things.
Call it with:

  [php symfony cartaGarantiaClientes|INFO]
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
		
	$inicio = mktime(0, 0, 0, date('m')+1, 1, date('Y'));
	$final = mktime(0, 0, 0, date('m')+2, 0, date('Y'));

	sfContext::getInstance()->getRequest()->setParameter("fchStart", date('Y-m-d',$inicio));
	sfContext::getInstance()->getRequest()->setParameter("fchEnd", date('Y-m-d',$final));
	echo sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'reporteCartaGarantiaEmail');
  }
}