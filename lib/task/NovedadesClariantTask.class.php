<?php

class NovedadesClariantTask extends sfDoctrineBaseTask {

    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'novedadesClariant';
        $this->briefDescription = 'Genera Archivo Plano de Novedades a Clariant';
        $this->detailedDescription = <<<EOF
The [novedadesClariant|INFO] task does things.
Call it with:

  [php symfony novedadesClariant|INFO]
EOF;
        // add arguments here, like the following:
        //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
        // add options here, like the following:
        //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
    }

    protected function execute($arguments = array(), $options = array()) {
        $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);

        print_r( $configuration );
        //exit();
        
        sfContext::createInstance($configuration)->dispatch();
        
        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($configuration);
        $databaseManager->loadConfiguration();

        echo sfContext::getInstance()->getController()->getPresentationFor('clariant', 'generarArchivo');
    }

}