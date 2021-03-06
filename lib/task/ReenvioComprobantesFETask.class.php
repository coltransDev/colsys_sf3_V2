<?php
 
class ReenvioComprobantesFETask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'reenvio-comprobantes-fe';
    $this->briefDescription = 'Re-Envia comprobantes a operador';
    $this->detailedDescription = <<<EOF
The [reenvioComprobantes|INFO] task does things.
Call it with:

  [php symfony reenvioComprobantesFE|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }


  
  protected function execute($arguments = array(), $options = array()) {
        $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);

        // Borra las dos l?neas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->loadConfiguration();

        sfContext::createInstance($this->configuration)->dispatch();
        //sfContext::getInstance()->getRequest()->setParameter('login', 'Administrador');
echo "INICIO";
        echo sfContext::getInstance()->getController()->getPresentationFor('integraciones', 'getDocumentsFEAll');
echo "FIN";
    }
  
  
}
?>
