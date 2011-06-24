<?php

class SubastasTask extends sfDoctrineBaseTask {

    protected function configure() {
        $this->namespace = 'intranet';
        $this->name = 'subastas';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [alertasExpo|INFO] task does things.
Call it with:

  [php symfony alertasExpo|INFO]
EOF;
        // add arguments here, like the following:
        //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
        // add options here, like the following:
        //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
    }

    protected function execute($arguments = array(), $options = array()) {
        $this->configuration = ProjectConfiguration::getApplicationConfiguration('intranet', 'cli', true);

        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->loadConfiguration();
        
        sfContext::createInstance($this->configuration)->dispatch();
        sfContext::getInstance()->getController()->getPresentationFor( 'subastas', 'cerrarSubastas');
        
    }

}