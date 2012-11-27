<?php

class CambioClaveColsysTask extends sfDoctrineBaseTask {

    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'cambio-clave-colsys';
        $this->briefDescription = 'Obliga al usuario de las sucursales a cambiar su clave cada 120 días';
        $this->detailedDescription = <<<EOF
The [notificaciones-encuestas|INFO] task does things.
Call it with:

  [php symfony verificacionEstados|INFO]
EOF;
        // add arguments here, like the following:
        //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
        // add options here, like the following:
        //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
    }

    protected function execute($arguments = array(), $options = array()) {
        $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);

        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($configuration);
        $databaseManager->loadConfiguration();

        sfContext::createInstance($configuration)->dispatch();

        sfContext::getInstance()->getController()->getPresentationFor('adminUsers', 'cambioClaveColsys');
    }

}