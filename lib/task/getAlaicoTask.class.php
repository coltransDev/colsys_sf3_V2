<?php

class getAlaicoTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'colsys';
    $this->name             = 'getAlaico';
    $this->briefDescription = 'Obtiene la tasa alaico de la semana';
    $this->detailedDescription = <<<EOF
The [getAlaico|INFO] task does things.
Call it with:

  [php symfony getAlaico|INFO]
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
	$actual=date("Y-m-d");
	$sql	= "SELECT COUNT(*) as numreg FROM ".TasaAlaicoPeer::TABLE_NAME." WHERE ".TasaAlaicoPeer::CA_FECHAINICIAL." <= '".$actual."' AND ".TasaAlaicoPeer::CA_FECHAFINAL." >= '".$actual."'";
	
	$con = Propel::getConnection(TasaAlaicoPeer::DATABASE_NAME);
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(); 
			
	$tmp=$row['numreg'];
	
	if($tmp==0){
		//echo "asd";
		//Actualizacion de la tasa alaico
		$meses=array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agt", "Sep", "Oct", "Nov", "Dic");
		$string=file_get_contents("http://www.alaico.org/2008/ALAICOJHON/htdocs//modules/mastop_publish/?tac=TasaAlaico");
				
		$initialTag='<span class="Apple-style-span" style="font-weight: bold; font-size: 24px; color: #000080; font-family: tahoma; background-color: #ffffff">$ ';
		$finalTag="</span";
		$alaico=Utils::getInformation($string, $initialTag, $finalTag);
					
		$alaico=str_replace(".", "", $alaico);				
		$tasa_alaico	=	(float)$alaico;
		
		
			
		$initialTag='<font face="verdana,geneva" size="3"><strong><font color="#000080" style="background-color: #ffffff">';
		$finalTag="</font";
		$vigencia=Utils::getInformation($string, $initialTag, $finalTag);
					
		$month1=array_search(substr($vigencia, 0,3 ), $meses )+1;
		if($month1<10){
				$month1="0".$month1;
		}
		
	
		$month2=array_search(substr($vigencia, 7,3 ), $meses )+1;
		if($month2<10){
				$month2="0".$month2;
		}
		
		$year1=date("Y");
		$year2=date("Y");
		if($month1=="12" && $month2=="01" ){
				$year2++;
		}
			
		
		$day1=Utils::getInformation(substr($vigencia, 2,5), ".", "a");			
		$day2=substr($vigencia, 6,30);
		$day2=substr($day2, strpos($day2,".")+1,30);
		
		$day1 = str_pad($day1,2, "0", STR_PAD_LEFT);
		$day2 = str_pad($day2,2, "0", STR_PAD_LEFT);
		
		$f1=$year1."-".$month1."-".$day1;
		$f2=$year2."-".$month2."-".$day2;
		
		
		$alaico	=	new TasaAlaico();
		$alaico->setCaFechaInicial($f1);
		$alaico->setCaFechaFinal($f2);
		$alaico->setCaValortasa($tasa_alaico);
		//$alaico->setUltimaActualizacion(date("Y-m-d H:i:s"));
		$alaico->save();                
	}
	
		
		
  }
}

?>