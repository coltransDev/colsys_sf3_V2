<?php
class CumpleanosColaboradoresTask extends sfDoctrineBaseTask {
 
    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'cumpleanos';
        $this->briefDescription = 'Notifica diaramente los cumpleaños de los colaboradores COLTRANS, COLMAS Y COL OTM';
        $this->detailedDescription = <<<EOF
The [cumpleanos|INFO] task does things.
Call it with:

  [php symfony birthdayEmail|INFO]
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
        sfContext::getInstance()->getRequest()->setParameter('login', 'Administrador');
        echo sfContext::getInstance()->getController()->getPresentationFor('adminUsers', 'birthdayEmail');
    }
}

?>
