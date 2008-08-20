<?php
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'colsys');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);


require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

/* Guarda en la base de datos el alaico. */
$con_bog = sfContext::getInstance()->getDatabaseManager()->getDatabase(TasaAlaicoPeer::DATABASE_NAME)->getConnection();


$actual=date("Y-m-d");
$sql	= "SELECT COUNT(*) as numreg FROM ".TasaAlaicoPeer::TABLE_NAME." WHERE ".TasaAlaicoPeer::CA_FECHAINICIAL." <= '".$actual."' AND ".TasaAlaicoPeer::CA_FECHAFINAL." >= '".$actual."'";	
$stmt	= $con_bog->prepareStatement($sql);
$rs 	= $stmt->executeQuery();	 
$rs->next( );
$tmp 	= $rs->getFloat('numreg');

if($tmp==0){
	//echo "asd";
	//Actualizacion de la tasa alaico
	$meses=array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agt", "Sep", "Oct", "Nov", "Dic");
	$string=file_get_contents("http://www.alaico.org/htm/home.php");

	
	$initialTag='<td height="18"><div align="center"><span class="style22">$';
	$finalTag="<br>";
	$alaico=Utils::getInformation($string, $initialTag, $finalTag);
	$alaico=str_replace(".", "", $alaico);
		
	$tasa_alaico	=	(float)$alaico;
		
	$initialTag='Vigente para:<br></span><span class="style22"><span class="style13"><span class="style13">';
	$finalTag="</span>";
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

	$day1=substr($vigencia, 4,2);
	$day2=substr($vigencia, 11,2);

	$f1=$year1."-".$month1."-".$day1;
	$f2=$year2."-".$month2."-".$day2;
	$alaico	=	new TasaAlaico();
	$alaico->setCaFechaInicial($f1);
	$alaico->setCaFechaFinal($f2);
	$alaico->setCaValortasa($tasa_alaico);
	//$alaico->setUltimaActualizacion(date("Y-m-d H:i:s"));
	$alaico->save();                
}
?>