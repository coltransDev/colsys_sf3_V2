<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
class InactivarProveedoresTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'inactivar-proveedores';
    $this->briefDescription = 'Inactiva los proveedores vencidos';
    $this->detailedDescription = <<<EOF
The [alertas-documentos|INFO] task does things.
Call it with:

  [php symfony alertas-documentos|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true );

	// Borra las dos l?neas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();
    sfContext::createInstance($this->configuration)->dispatch();
    sfContext::getInstance()->getRequest()->setParameter("modo", "prov");
    sfContext::getInstance()->getRequest()->setParameter("layout", "email");
	echo sfContext::getInstance()->getController()->getPresentationFor( 'ids', 'inactivarProveedores');

  }
}
?>