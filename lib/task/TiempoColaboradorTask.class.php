<?php
class TiempoColaboradorTask extends sfDoctrineBaseTask {
 
    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'tiempo-colaborador';
        $this->briefDescription = 'Verifica diariamente los colaboradores que cumplen 5,10,15,20,25,30 años en la compañía';
        $this->detailedDescription = <<<EOF
The [notificar-tiempo-colaborador|INFO] task does things.
Call it with:

  [php symfony tiempoColaborador|INFO]
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

        echo sfContext::getInstance()->getController()->getPresentationFor('adminUsers', 'tiempoColaborador');
    }
}

?>
