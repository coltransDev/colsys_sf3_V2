<?php
 
class NotificacionesTask extends sfPropelBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'notificaciones';
    $this->briefDescription = 'Genera Reporte Mensual de los Clientes que se les vence su Circular 170';
    $this->detailedDescription = <<<EOF
The [circularClientes|INFO] task does things.
Call it with:

  [php symfony circularClientes|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    //$this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'batch', true );
	
	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();
	
	
	$c = new Criteria();
	$c->add( NotificacionPeer::CA_IDEMAIL, null, Criteria::ISNULL);
	$notificaciones = NotificacionPeer::doSelect( $c );
	
	foreach( $notificaciones as $notificacion ){
		
		$usuario = UsuarioPeer::retrieveByPk( $notificacion->getCaLogin() );
	
		$email = new Email();		
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $usuario->getCalogin() );
		$email->setCaTipo( "Notificación" ); 		
		$email->setCaIdcaso( $notificacion->getcaIdnotificacion() );
		$email->setCaFrom( "no-reply@coltrans.com.co" );
		$email->setCaFromname( "Colsys Notificaciones" );
		$email->addTo( $usuario->getCaEmail() ); 
						
		$mensaje = $notificacion->getCaTexto();
						
		$email->setCaSubject( $notificacion->getCaTitulo() );				
		$email->setCaBodyhtml( $mensaje );		
		$email->save();
		$email->send();
		$notificacion->setCaIdemail( $email->getCaidemail() );
		$notificacion->save();
	}	
	
	
		
  }
}
?>