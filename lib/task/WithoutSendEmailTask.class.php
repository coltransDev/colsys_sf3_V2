<?php
 
class WithoutSendEmailTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'without-send-email';
    $this->briefDescription = 'Envia listado con emails que llevan más de un día sin despacharse';
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
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'cli', true );
    
    
	
	// Borra las dos líneas siguientes si no utilizas una base de datos
	$databaseManager = new sfDatabaseManager($this->configuration);
	$databaseManager->loadConfiguration();
    sfContext::createInstance($this->configuration)->dispatch();
    sfContext::getInstance()->getRequest()->setParameter("layout", "email");
		
	$listado = Doctrine::getTable("Email")
                        ->createQuery("e")
                        ->select('*')
                        ->addWhere("e.ca_fchenvio IS NULL")
                        ->addWhere("e.ca_fchcreado <= ? ", date("Y-m-d H:i:s", time()-18300))
                        ->execute();
	
    if(count($listado)>0){
            
            $email = new Email();		
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo( "Error Email" );
            $email->setCaFrom( "nagios@correo.colsys.coltrans.com.co" );
            $email->setCaFromname( "Colsys Notificaciones" );
            $email->setCaSubject(date("Y-m-d").": Correos sin despachar");
            $email->addTo("admin@coltrans.com.co");

            $texto = "Los siguientes correos no han sido despachados \n\n<br /><br />" ;            
            
            $texto .= "<table border='0'><tr><th>Enviado Por:</th> <th>Tipo</th> <th>Asunto</th> <th>Fch. Creado</th></tr>";
            foreach( $listado as $lista ){
                $texto .= "<tr><td>".$lista->getCaUsuenvio()."</td> <td>".$lista->getCaTipo()."</td> <td>".$lista->getCaSubject()."</td> <td>".$lista->getCaFchcreado()."</td></tr>";
            }
            $texto .= "</table>";
            
            $email->setCaBodyhtml($texto);            
            $email->save();
            //$email->send();
	}		
  }
}
?>