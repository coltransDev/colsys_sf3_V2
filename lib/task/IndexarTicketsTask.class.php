<?php
 
class IndexarTicketsTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'indexar-tickets';
    $this->briefDescription = 'Reindexa todos los tickets de la bd';
    $this->detailedDescription = <<<EOF
The [IndexarUsuarios|INFO] task does things.
Call it with:

  [php symfony IndexarUsuarios|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('intranet', 'cli', true );
	
	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();
    set_time_limit(0);

	/*$tickets=Doctrine::getTable('HdeskTicket')
                        ->createQuery("u")
                        ->addOrderBy("u.ca_idticket")
                        //->addWhere('ca_activo = ?', true)
                        ->execute();

    foreach($tickets as $ticket){
        echo $ticket->getCaIdticket()."\n";
        $ticket->updateLuceneIndex();
    }*/

    /*$index = HdeskTicketTable::getLuceneIndex();
    $index->optimize();*/



    $responses=Doctrine::getTable('HdeskResponse')
                        ->createQuery("u")
                        ->addOrderBy("u.ca_idresponse")
                        //->addWhere('ca_activo = ?', true)
                        ->execute();

    foreach($responses as $response){
        echo $response->getCaIdresponse()."\n";
        $response->updateLuceneIndex();
    }

    /*$index = HdeskResponseTable::getLuceneIndex();
    $index->optimize();*/
	
	
	
		
  }
}
?>