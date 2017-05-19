<?php
class TiempoColaboradorTask extends sfDoctrineBaseTask {
 
    protected function configure() {
        $this->namespace = 'colsys';
        $this->name = 'tiempo-colaborador';
        $this->briefDescription = 'Verifica diariamente los colaboradores que cumplen 5,10,15,20,25,30 años en la compañía';
        $this->detailedDescription = <<<EOF
The [tiempo-colaborador|INFO] task does things.
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

/*
Fechas para verificación
 * 
"aramirez";     "2001-08-16"    Ago 12
"apsanchez";    "2006-08-16"    Ago 12   
"jipena";       "1991-09-02"    Ago 29
"pdominguez";   "1991-09-02"    Ago 29
"jtorres";      "2001-09-06"    Sep 02
"jjleon";       "2006-09-18"    Sep 14
"bgonzalez";    "2001-09-21"    Sep 17
"facorrea";     "2006-09-25"    Sep 21
"rmachado";     "1996-10-28"    Oct 24
"acsilva";      "2001-11-30"    Nov 26
"croman";       "1996-12-01"    Nov 27
"sycardenas";   "2006-12-18"    Dic 14
 * 
 *  */

?>
