<?php

/** 
 * pruebas actions.
 *
 * @package    colsys
 * @subpackage pruebas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pruebasActions extends sfActions {
	/*
	* 1. Match exacto
	*/
	public function executeMatch() {
		set_time_limit ( 0 );
		$c = new Criteria ( );
		$c->add ( InoClientesAirPeer::CA_IDREPORTE, 0 );
		$c->addDescendingOrderByColumn ( InoClientesAirPeer::CA_REFERENCIA );
		$c->setLimit ( 100 );
		
		$inos = InoClientesAirPeer::doSelect ( $c );
		
		foreach ( $inos as $ino ) {
			echo "<strong>Ref:</strong>" . $ino->getCaReferencia () . " <strong>AWB:</strong>" . $ino->getCaHawb () . "<br />";
			
			$c = new Criteria ( );
			$c->addJoin ( RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
			$c->addJoin ( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO );
			$c->add ( RepAvisoPeer::CA_DOCTRANSPORTE, $ino->getCaHawb () );
			$c->add ( ContactoPeer::CA_IDCLIENTE, $ino->getCaIdcliente () );
			$c->add ( ReportePeer::CA_TRANSPORTE, "A%", Criteria::LIKE );
			$c->setDistinct ();
			$reps = ReportePeer::doSelect ( $c );
			foreach ( $reps as $rep ) {
				if (count ( $rep ) == 1) {
					$ino->setCaIdReporte ( $rep->getCaIdReporte () );
					$ino->save ();
					echo "<h3>OK</h3>";
				}
				echo "<br />";
			}
		
		}
		return sfView::NONE;
	}
	
	/*
	* 2. Match por similitud
	*/
	public function executeMatchSimil() {
		set_time_limit ( 0 );
		$c = new Criteria ( );
		$c->add ( InoClientesAirPeer::CA_IDREPORTE, 0 );
		$c->addDescendingOrderByColumn ( InoClientesAirPeer::CA_REFERENCIA );
		$c->setLimit ( 200 );
		
		$inos = InoClientesAirPeer::doSelect ( $c );
		
		foreach ( $inos as $ino ) {
			echo "<strong>Ref:</strong>" . $ino->getCaReferencia () . " <strong>AWB:</strong>" . $ino->getCaHawb () . "<br />";
			
			$c = new Criteria ( );
			$c->addJoin ( RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
			$c->addJoin ( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO );
			$fecha = Utils::addDays ( $ino->getCaFchCreado (), - 15 );
			
			$c->add ( ReportePeer::CA_FCHREPORTE, $fecha, Criteria::GREATER_EQUAL );
			$c->addAnd ( ReportePeer::CA_FCHREPORTE, $ino->getCaFchCreado (), Criteria::LESS_EQUAL );
			$c->add ( ContactoPeer::CA_IDCLIENTE, $ino->getCaIdcliente () );
			$c->add ( ReportePeer::CA_TRANSPORTE, "A%", Criteria::LIKE );
			$c->setDistinct ();
			$reps = ReportePeer::doSelect ( $c );
			foreach ( $reps as $rep ) {
				echo $rep->getCaIdreporte () . " <strong>cons:</strong> " . $rep->getCaConsecutivo () . " v" . $rep->getCaVersion () . "<br />";
				$avisos = $rep->getRepAvisos ();
				foreach ( $avisos as $aviso ) {
					echo " <strong>doc:</strong> " . $aviso->getCaDocTransporte () . " Fch Salida" . $aviso->getCaFchSalida ();
				}
				
				if (count ( $rep ) == 1) {
					$ino->setCaIdReporte ( $rep->getCaIdReporte () );
					//	$ino->save();
					echo "<h3>OK</h3>";
				}
				//print_r($rep);
				echo "<br />";
			}
		
		}
		return sfView::NONE;
	}
	
	/*
	* 2. Match por Levenshtein
	*/
	public function executeMatchLev() {
		set_time_limit ( 0 );
		$c = new Criteria ( );
		$c->add ( InoClientesAirPeer::CA_IDREPORTE, 0 );
		$c->addDescendingOrderByColumn ( InoClientesAirPeer::CA_REFERENCIA );
		$c->setLimit ( 100 );
		
		$inos = InoClientesAirPeer::doSelect ( $c );
		
		foreach ( $inos as $ino ) {
			echo "<strong>Ref:</strong>" . $ino->getCaReferencia () . " <strong>AWB:</strong>" . $ino->getCaHawb () . "<br />";
			
			$c = new Criteria ( );
			$c->addJoin ( RepAvisoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
			$c->addJoin ( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO );
			$fecha = Utils::addDays ( $ino->getCaFchCreado (), - 30 );
			
			$c->add ( ReportePeer::CA_FCHREPORTE, $fecha, Criteria::GREATER_EQUAL );
			$c->addAnd ( ReportePeer::CA_FCHREPORTE, $ino->getCaFchCreado (), Criteria::LESS_EQUAL );
			$c->add ( ContactoPeer::CA_IDCLIENTE, $ino->getCaIdcliente () );
			$c->add ( ReportePeer::CA_TRANSPORTE, "A%", Criteria::LIKE );
			$c->setDistinct ();
			$reps = ReportePeer::doSelect ( $c );
			$obj = null;
			$obj2 = null;
			foreach ( $reps as $rep ) {
				
				$avisos = $rep->getRepAvisos ();
				$masCorta = 99999999;
				$obj = null;
				$obj2 = null;
				foreach ( $avisos as $aviso ) {
					
					$lev = levenshtein ( $aviso->getCaDocTransporte (), $ino->getCaHawb () );
					if ($lev < $masCorta) {
						$masCorta = $lev;
						$obj = $rep;
						$obj2 = $aviso;
					}
				
				}
				
			/*
				if( count($reps)==1 ){
					$ino->setCaIdReporte( $rep->getCaIdReporte() ); 
				//	$ino->save();
					echo "<h3>OK</h3>";
				}*/
			//print_r($rep);
			//echo "<br />";
			}
			if ($obj) {
				$rep = $obj;
				$aviso = $obj2;
				echo $rep->getCaIdreporte () . " <strong>cons:</strong> " . $rep->getCaConsecutivo () . " v" . $rep->getCaVersion ();
				echo " <strong>doc:</strong> " . $aviso->getCaDocTransporte () . " ";
				echo "<h3>OK</h3>";
			}
			echo "<br />";
		
		}
		return sfView::NONE;
	}
	
	/**
	 * Executes index action
	 *
	 */
	public function executeLdap() {
		// La secuencia básica para trabajar con LDAP es conectar, autentificarse,
		// buscar, interpretar el resultado de la búsqueda y cerrar la conexión.
		

		echo "<h3>Prueba de consulta LDAP</h3>";
		
		$auth_user = "cn=abotero,o=coltrans_bog";
		$password = "abotero";
		$ldap_server = "10.192.1.5";
		echo $auth_user . "->";
		if ($connect = ldap_connect ( $ldap_server )) {
			echo "connection ($ldap_server): ";
			if ($bind = ldap_bind ( $connect, $auth_user, $password )) {
				echo "true <BR>";
				ldap_close ( $connect );
			} //if bound to ldap
		} //if connected to ldap
	}
	
	public function executeEncoding() {
		//$sql =  "SET NAMES  'LATIN1'";
		$sql = "SHOW CLIENT_ENCODING";
		
		$con = Propel::getConnection ( EmailPeer::DATABASE_NAME );
		
		$stmt = $con->prepareStatement ( $sql );
		$rs = $stmt->executeQuery ();
		$rs->next ();
		echo $rs->getString ( 'client_encoding' );
		
		/*
		$ciudad = new Ciudad();
		$ciudad->setCaCiudad( "ASD" );
		$ciudad->setCaIdTrafico("99-999");
		$ciudad->setCaIdCiudad("pruebá");
		$ciudad->setCaPuerto("pruebá");
		$ciudad->save();*/
		print_r ( $this->getRequestParameter ( "asd" ) );
		$ciudad = CiudadPeer::retrieveByPk ( "pruebá" );
		$ciudad->setCaPuerto ( $this->getRequestParameter ( "asd" ) );
		//$ciudad->setCaPuerto( utf8_encode("pruebá"));
	//$ciudad->save();
	//print_r( Utils::replace($ciudad->getCaIdCiudad()) );
	

	}
	
	public function executeSendEmail() {
		
		$c = new Criteria ( );
		//$c->add ( EmailPeer::CA_FCHENVIO, "2008-07-04 10:00:00", Criteria::GREATER_THAN );
		//$c->addAnd ( EmailPeer::CA_FCHENVIO, "2008-07-04 10:25:00", Criteria::LESS_THAN );
		$c->add( EmailPeer::CA_IDEMAIL, 116511);
		$c->addAscendingOrderByColumn ( EmailPeer::CA_FCHENVIO );
		
		$i = 0;
		$emails = EmailPeer::doSelect ( $c );
		foreach ( $emails as $email ) {
			echo "<strong>Enviando " . $i ++ . "</strong>	emailid: " . $email->getCaIdEmail () . " Fch: " . $email->getCaFchEnvio () . " <br />From: " . $email->getCaFrom () . "<br />";
			echo "CC: " . $email->getCaCC () . "<br />";
			echo "Subject" . $email->getCaSubject () . "<br />";
			//echo $email->send()."<br /><br />";
		}
		
		return sfView::NONE;
	
	}
	
	public function executeCambiaTipoStatus() {
		$c = new Criteria ( );		
		$avisos = RepAvisoPeer::doSelect ( $c );
		
		foreach ( $avisos as $aviso ) {
			$email = EmailPeer::retrieveByPk ( $aviso->getcaIdEmail () );
			if ($email) {
				echo $email->getCatipo ();
				$aviso->setCaTipo ( $email->getCatipo () );
				$aviso->save ();
			}
		}
		return sfView::NONE;
	}
	
	public function executeActualizarEstadoReportes() {
		set_time_limit(0);
		$c = new Criteria ( );
		$c->add ( ReportePeer::CA_FCHDESPACHO, "2008-04-01", Criteria::GREATER_EQUAL );
		$c->add ( ReportePeer::CA_IMPOEXPO, "Importación" );
		$c->add ( ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada", Criteria::NOT_EQUAL );
		$c->add ( ReportePeer::CA_TRANSPORTE, "Marítimo" );
		$c->addAscendingOrderByColumn ( ReportePeer::CA_FCHREPORTE );
		$reportes = ReportePeer::doSelect ( $c );
		set_time_limit ( 0 );
		foreach ( $reportes as $reporte ) {
			$inoclientesSea = $reporte->getInoClientesSea ();
			if ($inoclientesSea) {
				$statusOTM = $inoclientesSea->getUltimoStatusOTM ();
				if ($statusOTM) {
					echo "otm<br>";
					$reporte->setCaEtapaActual ( "Carga Entregada" );
					$reporte->save ();
				} else {
					$refSea = $inoclientesSea->getInoMaestraSea ();
					if ($refSea->getCaFchconfirmado ()) {
						
						if ($reporte->getCaContinuacion () != "N/A") {
							echo "en transito terrestre <br>";
							$reporte->setCaEtapaActual ( "Carga en Transito Terrestre" );
						} else {
							echo "llego<br>";
							$reporte->setCaEtapaActual ( "Carga Entregada" );
						}
						$reporte->save ();
					}
				}
			}
		}
	}
	
	/*
	* Convertir avisos x status 
	*/	
	public function executeCambiarAvisos(){
		set_time_limit(0);
		$c = new Criteria();
		//$c->setLimit(5000);
		$c->add ( RepAvisoPeer::CA_FCHENVIO, "2008-01-01", Criteria::GREATER_EQUAL );
		$avisos = RepAvisoPeer::doSelect( $c );
		foreach( $avisos as $aviso ){
			$status = new RepStatus();
			$status->setCaIdReporte( $aviso->getCaIdReporte() );
			$status->setCaIdEmail( $aviso->getCaIdEmail() );
			$status->setCafchsalida( $aviso->getCafchsalida() );
			$status->setCafchllegada( $aviso->getCafchllegada() );	
			$status->setCafchcontinuacion( $aviso->getCafchcontinuacion() );
			$status->setCaPiezas( $aviso->getCaPiezas() );
			$status->setCaPeso( $aviso->getCaPeso() );
			$status->setCaVolumen( $aviso->getCaVolumen() );
			$status->setCaDoctransporte( $aviso->getCaDoctransporte() );
			$status->setCadocmaster( $aviso->getCadocmaster() );
			$status->setCaidnave( $aviso->getCaidnave() );
			$status->setCaComentarios( $aviso->getCanotas() );
			$status->setCaequipos( $aviso->getCaequipos() );
			$status->setCafchenvio( $aviso->getCafchenvio("Y-m-d H:i:s") );
			$status->setCaUsuenvio( $aviso->getCaUsuenvio() );
			$status->setCaHoraSalida( $aviso->getCaHoraSalida() );
			$status->setCaEtapa( "Carga Embarcada" );
			$status->setCastatus( $aviso->getStatus() );
			$status->setCafchstatus( $aviso->getCafchenvio("Y-m-d H:i:s") );
			$status->setCafchrecibo( $aviso->getCafchenvio("Y-m-d H:i:s") );
			
			$status->save();
			$aviso->delete();
			echo $status->getCaIdReporte()." ".$aviso->getStatus() ."<br /><br />";
				
		}
		
	}	
	
	
	/*
	sin comentarios
	*/
	
	public function executeCorregirAvisosAereo(){
		$c = new Criteria();
		$c->addJoin( RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL );
		$c->addJoin( RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE );
		$c->add( EmailPeer::CA_TIPO , "Confirmación" );
		$c->add( RepStatusPeer::CA_ETAPA, "Carga Embarcada");
		$c->add(ReportePeer::CA_TRANSPORTE , "Aéreo" );
		set_time_limit(0);
		$statuss = RepStatusPeer::doSelect($c);
		foreach( $statuss as $status ){
			 echo $status->getCaIdEmail()."<br />";		
			 $status->setCaEtapa( "Carga en Puerto de Destino" );	
			 $status->save();
			 $reporte = $status->getReporte();
			 $reporte->setCaEtapaActual( "Carga en Puerto de Destino" );
			 $reporte->save();
		}
	}	
  
		
	
	/*
	* Analizar texto para colocar fecha de salida info reserva 
	*/
	public function executeFixReservas(){
		$c = new Criteria();		
		$c->add( RepStatusPeer::CA_FCHENVIO, '2008-04-01', Criteria::GREATER_EQUAL );
		$c->add( RepStatusPeer::CA_FCHENVIO, '2008-06-30', Criteria::LESS_EQUAL );
		$c->add( RepStatusPeer::CA_STATUS, RepStatusPeer::CA_STATUS." like '%reserva%'", Criteria::CUSTOM );
		$statuss = RepStatusPeer::doSelect( $c );
		
		$i = 0;
		foreach ( $statuss as $status ){
			
			
			//Ubica ETS
			if ( !$status->getCaFchSalida() ){
				
				//
				
				$pos = strripos ($status->getCaStatus(), "zarpe");
				if( $pos!==false ){
					$diaStr="";
					
					
					if( $status->getCaIdEmail() == 13737   ){
						continue;
					}
					
					/*
					$str = substr( $status->getCaStatus(), $pos+6, 30 );
					
					
					
					$pos2 = stripos($str, "mayo");
					
					if( $pos2!==false ){
						
						$mes = "05";					
						
						$diaStr = trim(substr($str, $pos2-6, 2));	
									
						if($pos2>2 && is_numeric ( $diaStr )){									
							if( strlen($diaStr)==1){
								$diaStr="0".$diaStr;
							}
							
							
							$fechaSalida = "2008-".$mes."-".$diaStr;
							echo $status->getCaIdEmail()." ";
							echo $status->getCaStatus()."<br />";
							echo "<strong>".$fechaSalida."</strong><br /><br />";
							//$status->setCaFchSalida( $fechaSalida );
							//$status->save();
							$i++;				
						}else{
							$diaStr = trim(substr($str, $pos2+6, 2));	
							if(is_numeric ( $diaStr )){		
								
								if( strlen($diaStr)==1){
									$diaStr="0".$diaStr;
								}
								$fechaSalida = "2008-".$mes."-".$diaStr;
								
								
								echo $status->getCaIdEmail()." ";
								echo $status->getCaStatus()."<br />";
								echo "<strong> 2-> ".$fechaSalida."</strong><br /><br />";
								
								//$status->setCaFchSalida( $fechaSalida );
								//$status->save();
								echo "<strong>".$fechaSalida."</strong><br /><br />";	
								$i++;			
							}
						}						
					}
					*/
					/*$pos2 = stripos($str, "junio");
					if( $pos2!==false ){
						$mes = "06";					
						
						$diaStr = trim(substr($str, $pos2-6, 2));	
									
						if($pos2>3 && is_numeric ( $diaStr )){									
							echo $diaStr;
							if( strlen($diaStr)==1){
								$diaStr="0".$diaStr;
							}							
							
							$fechaSalida = "2008-".$mes."-".$diaStr;
							echo $status->getCaStatus()."<br />";
							echo "<strong>".$fechaSalida."</strong><br /><br />";
							$status->setCaFchSalida( $fechaSalida );
							$status->save();
							$i++;				
						}else{
							$diaStr = trim(substr($str, $pos2+6, 2));	
							if(is_numeric ( $diaStr )){		
								
								if( strlen($diaStr)==1){
									$diaStr="0".$diaStr;
								}
								$fechaSalida = "2008-".$mes."-".$diaStr;
								
								//echo $status->getCaStatus()."<br />";
								echo "<strong> 2-> ".$fechaSalida."</strong><br /><br />";
								
								$status->setCaFchSalida( $fechaSalida );
								$status->save();
								echo "<strong>".$fechaSalida."</strong><br /><br />";	
								$i++;			
							}
						}						
					}
					*/
					/*$pos2 = stripos($str, "/");
					if( $pos2!==false ){
									
						echo $status->getCaStatus()."<br />";
						$diaStr = trim(substr($str, $pos2-2, 2));	
						
						$mesStr = trim(substr($str, $pos2+1, 2));	
						
						if( is_numeric ( $diaStr ) && is_numeric($mesStr) && $mesStr<=6 ){									
							echo $diaStr;
							if( strlen($diaStr)==1){
								$diaStr="0".$diaStr;
							}
							
							if( strlen($mesStr)==1){
								$mesStr="0".$mesStr;
							}
														
							
							$fechaSalida = "2008-".$mesStr."-".$diaStr;
							
							echo "<strong>".$fechaSalida."</strong><br /><br />";
							//$status->setCaFchSalida( $fechaSalida );
							//$status->save();
							$i++;				
						}					
					}*/
					
					
					
				}
							
				
			}
			
			
		}
		echo "->".$i;
		return sfView::NONE;
		
		
		
		
	}
	
	
	public function executeDecodeFile(){
		$file = 'SUkqAKhlAAD/////////////////87G0XRHZHRHRdEfI6I+R2R8jsj5HZHRdEdl0R8jojouiPkdG

AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=archivo.tiff");
		echo base64_decode($file);
		
	}
	
	
}
?>
