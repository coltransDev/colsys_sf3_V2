<?php
 
class DelayedEmailTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'delayed-email';
    $this->briefDescription = 'Envia emails retrasados por errores';
    $this->detailedDescription = <<<EOF
The [circularClientes|INFO] task does things.
Call it with:

  [php symfony circularClientes|INFO]
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
		
					
	$emails = Doctrine::getTable("Email")
                        ->createQuery("e")
                        ->where("e.ca_fchenvio IS NULL")
                        ->execute();
		
	foreach( $emails as $email ){
		try{
            $email->send();
        }catch(Exception $e){
            echo $e."<br />";
        }
	}		
  }
}
?>