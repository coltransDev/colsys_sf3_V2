<?php

class NotificarPrgmantenimientoTask extends sfDoctrineBaseTask {

    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'notificar-prgmantenimiento';
        $this->briefDescription = 'Informa mensualmente a los usuarios que se les realizará un mantenimiento';
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
        $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);

        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->loadConfiguration();

        sfContext::createInstance($this->configuration)->dispatch();

        sfContext::getInstance()->getController()->getPresentationFor('inventory', 'notificarPrgmantenimiento');
    }

}