<?php

class getTRMTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'getTRM';
    $this->briefDescription = 'Obtiene la tasa representativa del mercado del dia';
    $this->detailedDescription = <<<EOF
The [getTRM|INFO] task does things.
Call it with:

  [php symfony getTRM|INFO]
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

	//sfContext::createInstance($this->configuration)->dispatch();
	
	///--
	$fecha_actual	=	date("Y-m-d");
	
	$string	=strtolower(file_get_contents("http://www.banrep.gov.co/") );
	
	$initialTag='tasa de cambio';       
	$finalTag	='</div></td>';
	$trm	=Utils::getInformation($string, $initialTag, $finalTag)."chm";
	
	$initialTag='numeros">';
	$finalTag	="chm";
	
	$trm	=Utils::getInformation($trm, $initialTag, $finalTag);       
	$trm	=str_replace(",", "", $trm);      
	$trm 	= doubleval($trm);
	$string	=strtolower(file_get_contents("http://www.banrep.gov.co/") );
	$initialTag2="<p>indicadores -";
	$finalTag2	="</p>";
	$act	=Utils::getInformation($string, $initialTag2, $finalTag2);
	
	$mytrm	=	(float)$trm;
	   
	/* 0 es Domingo, 6 es Sabado */
	$num_day	=	date('w');             
	
	//TODO Obtener la TRM en un dia festivo	  
	if(substr($act,0,2)== date("d") || $num_day==0 || $num_day==6 ){       	       
		if ($trm){       		
			$trmObj	=	new TRM();
			$trmObj->setCaFecha( $fecha_actual );
			$trmObj->setCaPesos( $mytrm );			
			$trmObj->save();			
		}
	}
	
		
		
  }
}

?>