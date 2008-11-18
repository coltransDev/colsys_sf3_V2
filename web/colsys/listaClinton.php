<?php
require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

// Borra las dos líneas siguientes si no utilizas una base de datos
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->loadConfiguration();

set_time_limit(0);

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

/*Extrae los datos y los coloca*/
/*
$doc = new DOMDocument();

$doc->load( $file );		

foreach( $doc->childNodes as $sdnEntryTag ){
	if ( $sdnEntryTag->nodeName != '#text' )
	{
		foreach( $sdnEntryTag->childNodes as $item ){
			$colombia = false;								// Bandera para determinar si el elemento tiene que ver con Colombia
			$nuevo = false;
			if ( $item->nodeName == 'publshInformation' )
			{	
				foreach( $item->childNodes as $element ){
					if ( $element->nodeName == 'Publish_Date' ){		// Captura la Fecha de Publicación del Archivo
						$ultimo = ParametroPeer::retrieveByPK("CU065",1,"publishInformation");
						if ($ultimo->getCaValor2() == $element->nodeValue){ // Compara con el Caso de Uso
							die('Finaliza sin Actualizaciones');							
						}else{							
							SdnPeer::eliminarRegistros();				// Crea objeto Sdn solo para invocar método que limpia las tablas
							$nueva_fecha = $element->nodeValue;
						} 
					}
				}
			}
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
}

*/

$rs = SdnPeer::evaluaClientes();
$ven_mem = null;
$msn_mem = '';
$tit_mem = array("ca_idcliente","ca_compania","ca_nombres","ca_papellido","ca_sapellido","ca_vendedor", "sdnm_uid","sdnm_firstname","sdnm_lastname","sdnm_title","sdnm_sdntype","sdnm_remarks","sdid_uid_id","sdid_idtype","sdid_idnumber","sdid_idcountry","sdid_issuedate","sdid_expirationdate","sdal_uid_aka","sdal_type","sdal_category","sdal_firstname","sdal_lastname","sdak_uid_aka","sdak_type","sdak_category","sdak_firstname","sdak_lastname");


$parametro = ParametroPeer::retrieveByPK("CU065",2,"defaultEmails");
if (stripos($parametro->getCaValor2(), ',') !== false) {
	$defaultEmail = explode(",", $parametro->getCaValor2());
}else{
	$defaultEmail = array($parametro->getCaValor2());
}
$parametro = ParametroPeer::retrieveByPK("CU065",3,"ccEmails");
if (stripos($parametro->getCaValor2(), ',') !== false) {
	$ccEmails = explode(",", $parametro->getCaValor2());
}else{
	$ccEmails = array($parametro->getCaValor2());
}

$x = 0;
$nueva_fecha = '2008-01-01';
while($rs->next()) {
	if ($rs->getString("ca_vendedor") !== $ven_mem) {
		if ($msn_mem != ''){
			$msn_mem.= "</table>";
			echo "Body Mail: <br />".$msn_mem."<br />"."<br />";
			while (list ($clave, $val) = each ($ccEmails)) {
				$email->addCc( $val );
			}
			$email->setCaSubject( "Verificación Clientes en Lista Clinton" );		
			$email->setCaBody( $msn_mem );
			//$email->save(); //guarda el cuerpo del mensaje	
		}
		if ($rs->getString("ca_vendedor") != '') {
			$user = UsuarioPeer::retrieveByPk($rs->getString("ca_vendedor"));	
		}else{
			$user = new Usuario();
		}

		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( "Administrador" );
		$email->setCaTipo( "SDNList Compair" ); 		
		$email->setCaIdcaso( "1" );
		$email->setCaFrom( "admin@coltrans.com.co" );
		$email->setCaFromname( "Administrador Sistema Colsys" );
		$email->setCaReplyto( "admin@coltrans.com.co" );

		if ( !$user->getCaEmail() ){
			while (list ($clave, $val) = each ($defaultEmail)) {
				$email->addTo( $val );
			}
		}
		$ven_mem = $rs->getString("ca_vendedor");
		$msn_mem = "El sistema ha encontrado algunas similitudes en su listado de Clientes, comparado con la Lista Clinton del día $nueva_fecha. Favor hacer la respectivas verificaciones y tomar acción en caso de que un cliente haya sido reportado.";
		$msn_mem.= "<br />";
		$msn_mem.= "<table width='90%' cellspacing='1' border='1'>"; 
		$msn_mem.= "	<tr>";
		for($i=0; $i<count($tit_mem); $i++) {
			$msn_mem.= "	<th>".$tit_mem[$i]."</th>";
		}
		$msn_mem.= "	</tr>";
	}
	$msn_mem.= "	<tr>";
	for($i=0; $i<count($tit_mem); $i++) {
		$msn_mem.= "	<td>".$rs->getString($tit_mem[$i])."</td>";
	}
	$msn_mem.= "	</tr>";
}
$msn_mem.= "</table>";
echo $msn_mem."<br />"."<br />";

$email->setCaSubject( "Verificación Clientes en Lista Clinton" );		
$email->setCaBody( $msn_mem );
//$email->save(); //guarda el cuerpo del mensaje	

/*
if (isset($ultimo)){
	$ultimo->setCaValor2($nueva_fecha);
	$ultimo->save();
}
*/
echo "<br /><br />Fin del Proceso de Importación<br />";
