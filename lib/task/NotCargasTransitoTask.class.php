<?php

class NotCargasTransitoTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'notificacion-cargas-transito';
    $this->briefDescription = 'importacion';
    $this->detailedDescription = <<<EOF
The [Importacion de data desde open|INFO] task does things.
Call it with:

  [php symfony impo-data-open|INFO]
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

                $datosEnvio=array(
                    "CTG-0005"=>array("radicaciones3ctg@coltrans.com.co","radicaciones2ctg@coltrans.com.co","radicacionesctg@coltrans.com.co"),
                    "BAQ-0005"=>array("jcarenas@coltrans.com.co","ydmartinez@coltrans.com.co"),
                    "BUN-0002"=>array("radicaciones1bun@coltrans.com.co","operacionesbun@coltrans.com.co","radicacionesbun@coltrans.com.co","liberacionesbun@coltrans.com.co","tramitesbun@coltrans.com.co"),
                    "STA-0005"=>array("jcarenas@coltrans.com.co","ydmartinez@coltrans.com.co")
                    );

                foreach($datosEnvio as $ciudad=>$correos)
                {
                    sfContext::getInstance()->getRequest()->setParameter("idciudad", $ciudad);
                    $html=sfContext::getInstance()->getController()->getPresentationFor( 'confirmaciones', 'cargasTransito');

                    $email = new Email();
                    $email->setCaUsuenvio("Administrador");
                    $email->setCaTipo("Alerta Maritimo");
                    //$email->setCaIdcaso("");
                    $email->setCaFrom("colsys@coltrans.com.co");
                    $email->setCaFromname("Sistema de Alertas");

                    $email->setCaSubject( " ALERTA DE CARGAS ENTREGA EN LUGAR DE ARRIBO $ciudad" );

                    //$email->setCaReplyto($user->getCaEmail());
                    //$email->addTo("maquinche@coltrans.com.co");
                    //$email->addTo("jstellez@coltrans.com.co");
                    foreach($correos as $c)
                    {
                        $email->addTo($c);
                    }

                    $email->setCaBody("");
                    $email->setCaBodyhtml($html);

                    $email->save();
                }
                
        
  }
}