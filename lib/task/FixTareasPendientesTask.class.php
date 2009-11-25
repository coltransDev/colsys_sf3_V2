<?php
/* 
 *  This file is part of the Colsys Project.
 *
 *  Esta tarea elimina las tareas pendientes despues de que se cierra el caso.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 *
 */




class FixTareasPendientesTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'fix-tareas-pendientes';
    $this->briefDescription = 'Envia emails retrasados por errores';
    $this->detailedDescription = <<<EOF
The [fix-tareas-pendientes|INFO] task does things.
Call it with:

  [php symfony fix-tareas-pendientes|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true );

	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();

    $etapas = array("99999", "IMETA");
    $tareas = Doctrine::getTable("NotTarea")
                        ->createQuery("t")
                        ->select("t.*")
                        ->innerJoin("t.Reporte r")
                        ->whereIn("r.ca_idetapa ", $etapas )
                        ->addWhere("t.ca_fchvencimiento IS NOT NULL")
                        ->execute();

    foreach( $tareas as  $tarea ){        
        $tarea->setCaFchterminada( date("Y-m-d H:i:s") );
        $tarea->save();
    }


  }
}
?>