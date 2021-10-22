<?php
 
class IndexarUsuariosTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'intranet';
    $this->name             = 'indexar-usuarios';
    $this->briefDescription = 'Reindexa todos los usuarios de la bd';
    $this->detailedDescription = <<<EOF
The [IndexarUsuarios|INFO] task does things.
Call it with:

  [php symfony IndexarUsuarios|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('intranet', 'cli', true );
	
	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();
	
	$usuarios=Doctrine::getTable('Usuario')
                        ->createQuery("u")
                        ->addWhere('ca_activo = ?', true)
                        ->execute();

    foreach($usuarios as $usuario){
        echo $usuario->getCaLogin()."\n";
        //try{
            $usuario->updateLuceneIndex();
        //}catch( Exception $e ){
        //    echo $e->getMessage();
        //}
    }
  }
}
?>