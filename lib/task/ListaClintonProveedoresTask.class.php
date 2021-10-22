<?php

class ListaClintonProveedoresTask extends sfDoctrineBaseTask {

    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'listaClintonProveedores';
        $this->briefDescription = 'Genera Reporte de Similitudes encontradas en Clientes con Lista Clinton';
        $this->detailedDescription = <<<EOF
The [listaClinton|INFO] task does things.
Call it with:

  [php symfony listaClintonProveedores|INFO]
EOF;
        // add arguments here, like the following:
        //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
        // add options here, like the following:
        //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
    }

    protected function execute($arguments = array(), $options = array()) {
        $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true);

        sfContext::createInstance($configuration)->dispatch();


        // Borra las dos líneas siguientes si no utilizas una base de datos
        $databaseManager = new sfDatabaseManager($configuration);
        $databaseManager->loadConfiguration();

        echo sfContext::getInstance()->getController()->getPresentationFor('ids', 'emailListaClintonProveedores');
        


    }

}