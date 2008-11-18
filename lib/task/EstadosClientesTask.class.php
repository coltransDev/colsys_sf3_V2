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
    $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
    sfContext::createInstance($configuration)->dispatch();

	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($configuration);
	$databaseManager->loadConfiguration();
	
	$inicio  = mktime(0, 0, 0, date("m")-3  , 1, date("Y"));
	$final = mktime(0, 0, 0, date("m"), -1,   date("Y"));

	set_time_limit(0);
  	
	echo "Inicio-> ".date('m-d-Y',$inicio);
	echo "Final->".date('m-d-Y',$final);
	
	$c = new Criteria();
	//$c->add(ClienteStd::CA_FCHESTADO, date('m-d-Y',$inicio),  )
	
	//$c->addDescendingOrderByColumn(self::CREATED_AT);
	
  }
}