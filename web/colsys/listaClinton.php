<?php
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
define('SF_APP',         'colsys');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

$con_bog = sfContext::getInstance()->getDatabaseManager()->getDatabase(ClientePeer::DATABASE_NAME)->getConnection();



$file = "../../data/downloads/clinton.xml";
/*
$url = "http://www.treas.gov/offices/enforcement/ofac/sdn/sdn.xml";


unlink($file);
$handleLocal = fopen($file, 'x');
//Descarga el archivo
set_time_limit(0);

$handle = fopen($url, 'r');
while (!feof($handle))
{
	$data = fgets($handle, 512);
	
	
	if (fwrite($handleLocal, $data) === FALSE) {
    	echo "No se puede escribir al archivo ($nombre_archivo)";
        exit;
	}
	
	echo "<br>";
}
fclose($handle); 
exit;*/
//fclose($handleHandle); 
/*Extrae los datos y los coloca*/

$doc = new DOMDocument();
// echo $file;
$doc->load( $file );		

//echo file_get_contents( $file );

//print_r($doc);
	
foreach( $doc->childNodes as $sdnEntryTag ){
	if ( $sdnEntryTag->nodeName != '#text' )
	{
		foreach( $sdnEntryTag->childNodes as $item ){
			if ( $item->nodeName == 'sdnEntry' )
			{
				$nombres = "";
				$apelllidos = "";
				$paises = array();
				$tipos_id = array();
				$identidades = array();
				$nacionalidades = array();
				foreach( $item->childNodes as $element ){
					if ( $element->nodeName == 'firstName' ){		// Evalua por el Nombre de la Persona
						$nombres = $element->nodeValue;
					}else if ( $element->nodeName == 'lastName' ){		// Evalua por el Apellidos de la Persona o Nombre de Empresa
						$apelllidos = $element->nodeValue;
					}else if ( $element->nodeName == 'addressList' ){ // Evalua por el Pais de la Empresa
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'country' ){
										array_push( $paises,  $sub2element->nodeValue );
									}
								}
							}						
						}
					}else if ( $element->nodeName == 'idList' ){  // Evalua por el Nit o CC y nacionalidad de la Persona Natural
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'idType' ){
										array_push( $tipos_id,  $sub2element->nodeValue );
									}else if ( $sub2element->nodeName == 'idNumber' ){
										array_push( $identidades,  $sub2element->nodeValue );
									}else if ( $sub2element->nodeName == 'idCountry' ){
										array_push( $nacionalidades,  $sub2element->nodeValue );
									}
								}
							}						
						}
					}
				}

				if ( in_array('Colombia', $paises) or in_array('Colombia', $nacionalidades) ){
					while (list ($clave, $val) = each ($identidades)) {
						$id = $digito = null;
						sscanf($val, '%[0-9]-%[0-9]', $id, $digito);
						$c = new Criteria();
						if ( strlen($id) != 0) {
							$criterion = $c->getNewCriterion( ClientePeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE." = '$id'" , Criteria::CUSTOM );
							$criterion->addOr($c->getNewCriterion( ClientePeer::CA_COMPANIA, ClientePeer::CA_COMPANIA." LIKE '".addslashes(str_replace(' ','%',strtoupper($nombres." ".$apelllidos)))."'" , Criteria::CUSTOM ));
						}else {
							$criterion = $c->getNewCriterion( ClientePeer::CA_COMPANIA, ClientePeer::CA_COMPANIA." LIKE '".addslashes(str_replace(' ','%',strtoupper($nombres." ".$apelllidos)))."'" , Criteria::CUSTOM );
						}

						$c->add($criterion);		
						$clientes = ClientePeer::doSelect( $c, $con_bog );

						if (count($clientes) != 0) {
							echo "->".$id."<br />";
							echo "->".strtoupper($nombres." ".$apelllidos)."<br />";
							print_r( $clientes );
							echo "<br />";
							echo "******************************** <br />";
							echo "<br />";
						}
					}
/*
					echo $nombres."<br />";
					echo $apelllidos."<br />";
					print_r($paises);
					echo "<br />";
					print_r($tipos_id);
					echo "<br />";
					print_r($identidades);
					echo "<br />";
					print_r($nacionalidades);
*/
				}

			}
		}
	}	
	else{
		print_r($sdnEntryTag);
	}
}



 
/* Guarda en la base de datos la tasa representativa del mercado. */

//$con_bog = sfContext::getInstance()->getDatabaseManager()->getDatabase("propel")->getConnection();





/*
<?php
##IP_CHECK##
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

*/
