<?php
 
class ReenvioComprobantesTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'reenvio-comprobantes';
    $this->briefDescription = 'Envia emails retrasados por errores';
    $this->detailedDescription = <<<EOF
The [reenvioComprobantes|INFO] task does things.
Call it with:

  [php symfony reenvioComprobantes|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }


  
  protected function execute($arguments = array(), $options = array()) {
        $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);

        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->loadConfiguration();

        sfContext::createInstance($this->configuration)->dispatch();
        //sfContext::getInstance()->getRequest()->setParameter('login', 'Administrador');
echo "INICIO";
        echo sfContext::getInstance()->getController()->getPresentationFor('inoF', 'reenvioSiigoConect');
echo "FIN";
    }
  
  
}
?>
