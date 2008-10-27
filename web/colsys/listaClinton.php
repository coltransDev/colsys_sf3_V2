<?php
require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

// Borra las dos líneas siguientes si no utilizas una base de datos
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->loadConfiguration();


/*

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

*/

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
			$colombia = false;								// Bandera para determinar si el elemento tiene que ver con Colombia
			$nuevo = false;
			if ( $item->nodeName == 'sdnEntry' )
			{
				$nuevo = true;
				$sdnEntry = array();							// Inicializa el arreglo
				$sdnIdList = array();
				$sdnAkaList = array();
				$sdnAddressList = array();
				foreach( $item->childNodes as $element ){

					if ( $element->nodeName == 'uid' ){					// Toma el uid del registro a evaluar
						$sdnEntry['uid'] = $element->nodeValue;
					}else if ( $element->nodeName == 'firstName' ){		// Evalua por el Apellidos de la Persona o Nombre de Empresa
						$sdnEntry[$element->nodeName] = $element->nodeValue;
					}else if ( $element->nodeName == 'lastName' ){		// Evalua por el Apellidos de la Persona o Nombre de Empresa
						$sdnEntry[$element->nodeName] = $element->nodeValue;
					}else if ( $element->nodeName == 'title' ){
						$sdnEntry[$element->nodeName] = $element->nodeValue;
					}else if ( $element->nodeName == 'sdnType' ){
						$sdnEntry[$element->nodeName] = $element->nodeValue;
					}else if ( $element->nodeName == 'remarks' ){
						$sdnEntry[$element->nodeName] = $element->nodeValue;
						
					}else if ( $element->nodeName == 'idList' ){       // Evalua el elemento por su lista de Identificaciones
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'uid' ){
										 $uid = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'idType' ){
										 $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue; 
									}else if ( $sub2element->nodeName == 'idNumber' ){
										 $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue; 
									}else if ( $sub2element->nodeName == 'idCountry' ){
										 $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue; 
										 $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
									}else if ( $sub2element->nodeName == 'issueDate' ){
										 $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue; 
									}else if ( $sub2element->nodeName == 'expirationDate' ){
										 $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
									}
								}
							}						
						}
					}else if ( $element->nodeName == 'akaList' ){       // Evalua el elemento por su lista de Homónimos
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'uid' ){
										 $uid = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'type' ){
										 $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue; 
									}else if ( $sub2element->nodeName == 'category' ){
										 $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue; 
									}else if ( $sub2element->nodeName == 'lastName' ){
										 $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'firstName' ){
										 $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
									}
								}
							}
						}
					}else if ( $element->nodeName == 'addressList' ){  // Evalua el elemento por su lista de Direcciones
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'uid' ){
										 $uid = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'address1' ){
										 $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'address2' ){
										 $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'address3' ){
										 $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'city' ){
										 $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'stateOrProvince' ){
										 $sdnAddressList[$uid]['state'] = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'postalCode' ){
										 $sdnAddressList[$uid]['postal'] = $sub2element->nodeValue;
									}else if ( $sub2element->nodeName == 'country' ){
										 $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
										 $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
									}
								}
							}						
						}
					}else if ( $element->nodeName == 'nationalityList' ){  // Evalua el elemento por su lista de Direcciones
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'country' ){
										 $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
									}
								}
							}						
						}
					}else if ( $element->nodeName == 'citizenshipList' ){  // Evalua el elemento por su lista de Direcciones
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'country' ){
										 $colombia = ($sub2element->nodeValue == 'Colombia')?true:$colombia;
									}
								}
							}						
						}
					}else if ( $element->nodeName == 'dateOfBirthList' ){  // No hace Nada
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
								}
							}						
						}
					}else if ( $element->nodeName == 'placeOfBirthList' ){  // Evalua el elemento por su lista de Direcciones
						foreach( $element->childNodes as $subelement ){
							if ( $subelement->hasChildNodes() ){
								foreach( $subelement->childNodes as $sub2element ){
									if ( $sub2element->nodeName == 'placeOfBirth' ){
										 $colombia = (strpos($sub2element->nodeValue, 'Colombia') !== false)?true:$colombia;
									}
								}
							}						
						}
					}
						
				}
			}
			if ($nuevo and $colombia) {
				$id = $sdnEntry['uid'];
				$sdnEntryObj = new Sdn();
				while (list ($clave, $val) = each ($sdnEntry)) {
					$campo = "setCa".ucwords($clave);
					$sdnEntryObj->$campo($val);
				}
				$sdnEntryObj->save();

				if (count($sdnIdList) != 0){
					while (list ($sub_id, $arreglo) = each ($sdnIdList)) {
						$sdnIdListObj = new SdnId();
						$sdnIdListObj->setCaUid($id);
						$sdnIdListObj->setCaUidId($sub_id);
						while (list ($clave, $val) = each ($arreglo)) {
							$campo = "setCa".ucwords($clave);
							$sdnIdListObj->$campo($val);
						}
						$sdnIdListObj->save();
					}
				}
				if (count($sdnAkaList) != 0){
					while (list ($sub_id, $arreglo) = each ($sdnAkaList)) {
						$sdnAkaListObj = new SdnAka();
						$sdnAkaListObj->setCaUid($id);
						$sdnAkaListObj->setCaUidAka($sub_id);
						while (list ($clave, $val) = each ($arreglo)) {
							$campo = "setCa".ucwords($clave);
							$sdnAkaListObj->$campo($val);
						}
						$sdnAkaListObj->save();
					}
				}
				if (count($sdnAddressList) != 0){
					while (list ($sub_id, $arreglo) = each ($sdnAddressList)) {
						$sdnAddressListObj = new SdnAddress();
						$sdnAddressListObj->setCaUid($id);
						$sdnAddressListObj->setCaUidAddress($sub_id);
						while (list ($clave, $val) = each ($arreglo)) {
							$campo = "setCa".ucwords($clave);
							$sdnAddressListObj->$campo($val);
						}
						$sdnAddressListObj->save();
					}
				}
				$nuevo = false; 
			}
		}
	}	
	else{
		print_r($sdnEntryTag);
	}
	echo "<br /><br />Fin del Proceso de Importación<br />";
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
