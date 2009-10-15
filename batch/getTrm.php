<?php
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'colsys');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
 
/* Guarda en la base de datos la tasa representativa del mercado. */
$con_bog = sfContext::getInstance()->getDatabaseManager()->getDatabase(TasaAlaicoPeer::DATABASE_NAME)->getConnection();

$fecha_actual	=	date("Y-m-d");

$sql	= "";
$stmt	= $con_bog->prepareStatement($sql);
$rs 	= $stmt->executeQuery();	 
$rs->next( );
print_r($rs);


if ( $tmp == 0 && date("G")>=6 ){	
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
		  
	if(substr($act,0,2)== date("d") || $num_day==0 || $num_day==6 ){       	       
		if ($trm){       		
			$trmObj	=	new TRM();
			$trmObj->setCaFecha( $fecha_actual );
			$trmObj->setCaPesos( $mytrm );			
			$trmObj->save();			
		}
	}
}
?>