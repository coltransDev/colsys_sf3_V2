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
                        ->addWhere("e.ca_fchenvio IS NULL")
                        ->addWhere("e.ca_fchcreado <= ? ", date("Y-m-d H:i:s", time()-60))
                        ->addWhere("e.ca_fchcreado >= ? ", date("Y-m-d H:i:s", time()-86400*3)) // Deja de enviar despues de 3 dias de no haberlo podido enviar
                        ->addOrderBy("e.ca_fchcreado", "ASC")
                        ->limit(30)
                        ->execute();
    //$data = array();
    //Utils::sendEmail($data);
	foreach( $emails as $email ){
		try{
            $email->send();
            
        }catch(Exception $e){
            echo $e."<br />";
            
            $data = array();
            $data["mensaje"]="Id Email: ".$email->getCaIdemail() . "<br />".$e->getMessage(). "<br />".$e->getTraceAsString();
            Utils::sendEmail($data);            
        }
	}		
  }
}
?>
