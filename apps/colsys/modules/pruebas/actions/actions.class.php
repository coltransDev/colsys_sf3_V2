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
		exit("detenido");
		$c = new Criteria ( );
		$c->add ( EmailPeer::CA_FCHENVIO, "2008-12-01 10:30:00", Criteria::GREATER_THAN );
		$c->addAnd ( EmailPeer::CA_FCHENVIO, "2008-12-01 11:00:00", Criteria::LESS_THAN );
		//$c->add( EmailPeer::CA_IDEMAIL, 134180);
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
	
	/*
	* Se pretende corregir un error donde se coloco el numero del consecutivo sin el año en el ino aereo
	*/
	
	public function executeFixReportesAereo(){
		$c = new Criteria();
		//$c->setLimit(10);
		$c->add(InoClientesAirPeer::CA_IDREPORTE, NULL, Criteria::ISNOTNULL );
		$c->addAnd(InoClientesAirPeer::CA_IDREPORTE, "%-%", Criteria::NOT_LIKE );
		//$c->add(InoClientesAirPeer::CA_REFERENCIA, "%8", Criteria::LIKE );
		
		set_time_limit(0);
		$inoairs  = InoClientesAirPeer::doSelect( $c );
		
		foreach( $inoairs as $inoair ){
			echo $inoair->getCaReferencia()." ".$inoair->getCaIdReporte();
			
			$c = new Criteria();
			$c->add( ReportePeer::CA_CONSECUTIVO,  $inoair->getCaIdReporte()."-%", Criteria::LIKE  );
			$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO );
			$c->add( ContactoPeer::CA_IDCLIENTE,  $inoair->getCaIdCliente() );
			$reporte = reportePeer::doSelectOne( $c );
			if( $reporte ){
				$inoair->setCaIdReporte( $reporte->getCaConsecutivo() );
				$inoair->save();
				echo "<strong> OK</strong>".$reporte->getCaConsecutivo();
			}else{
				$c = new Criteria();
				$c->add( ReportePeer::CA_IDREPORTE,  $inoair->getCaIdReporte() );
				$c->addJoin( ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO );
				$c->add( ContactoPeer::CA_IDCLIENTE,  $inoair->getCaIdCliente() );
				$reporte = reportePeer::doSelectOne( $c );
				if( $reporte ){
					$inoair->setCaIdReporte( $reporte->getCaConsecutivo() );
					$inoair->save();
					echo "<strong> OK2</strong> ".$reporte->getCaConsecutivo();
				}else{
					$inoair->setCaIdReporte( null );
					$inoair->save();
				}
			}
			
			
			
			echo "<br />";	
		}
		
	}
	
	
	/*
	* Coloca el consecutivo de acuerdo a la fecha de creado
	*/
	public function executeAsignarConsecutivoCotizaciones(){
		
		set_time_limit(0);
		
		$c = new Criteria();
		$c->add( CotizacionPeer::CA_CONSECUTIVO, null, Criteria::ISNULL);
		$c->addAscendingOrderByColumn(CotizacionPeer::CA_FCHCREADO);
		$cotizaciones  = CotizacionPeer::doSelect( $c );
		$c->setLimit(8000);
		foreach( $cotizaciones as $cotizacion ){
			$sig = CotizacionPeer::siguienteConsecutivo($cotizacion->getCaFchCreado("Y"));
			$cotizacion->setCaConsecutivo( $sig );
			$cotizacion->save();			
		}
	}
	
	/*
	* Importa el tarifario anterior dentro del nuevo taarifario
	*/
	public function executeImportarTarifario(){
		sfConfig::set('sf_web_debug', false) ;	
		
		$porBL = array( "POR BL", "POR BL ", "Por B/l", "Por BL", "Por Bl" );
				
		$porHbl = array( "Por HBL" );
		
		$porCtnr  = array( "POR CNTR" , "POR CONTENEDOR", "Por contenedor", "Por contenedor", "Por Cntr");
		
		$porEmbarque = array( "Por embarque", "Por embarque\n", "Por Embarque" );
		
		$porTm3 = array( "Por T/M3", "POR T/M3", "T/M3", "T/M3\n", "T/M3 ", "por T/M3", "POR T/M3",);
		
		
		$c = new Criteria();
		//$c->add( TrayectoPeer::CA_IDTRAYECTO, 1294, Criteria::NOT_EQUAL );
		//$c->addAnd( TrayectoPeer::CA_IDTRAYECTO, 1297, Criteria::NOT_EQUAL );
		/*
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Marítimo" ); 
		*/
		
		/*
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" ); 
		*/
		
		
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Exportación" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" ); 
		
		
		
		
		//$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
		//$c->add( TrayectoPeer::CA_TRANSPORTE , "Marítimo" ); 
		//$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );				
		
		//$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );
		//$c->add( TrayectoPeer::CA_MODALIDAD, "FCL" );
		//$c->add( TrayectoPeer::CA_IDTRAYECTO, 3705 );
		
		//$c->setLimit(30);
		$trayectos = TrayectoPeer::doSelect( $c );	
		set_time_limit(0); 
		
		foreach( $trayectos as $trayecto ){	
			if( $trayecto->getCaIdtarifas()!=$trayecto->getCaIdTrayecto() ){
				$trayecto2 = trayectoPeer::retrieveByPk( $trayecto->getCaIdtarifas() );		
				
				$fletes = $trayecto2->getFletes();
			}else{
				$fletes = $trayecto->getFletes();				
			}			
			
			
			foreach( $fletes as $flete ){
				$pricflete = new PricFlete();
				$pricflete->setCaIdTrayecto( $trayecto->getCaIdTrayecto() );
				$pricflete->setCaIdConcepto( $flete->getCaIdConcepto() );
				$pricflete->setCaVlrneto( $flete->getCaVlrneto() );
				$pricflete->setCaVlrsugerido( $flete->getCaVlrminimo() );
				$pricflete->setCaFchinicio( $flete->getCaFchinicio() );
				$pricflete->setCaFchvencimiento( $flete->getCaFchvencimiento() );
				$pricflete->setCaIdmoneda( $flete->getCaIdmoneda() );				
				if( $flete->getCaSugerida()=="*" ){
					$pricflete->setCaEstado( 1 );
				}
				if( $flete->getCaMantenimiento()=="*" ){
					$pricflete->setCaEstado( 2 );
				}							
				$pricflete->save();
				//echo "asd1";
				if( $trayecto->getCaModalidad()=="LCL" && $flete->getCaFleteminimo()>0 && ($flete->getCaVlrminimo()!=$flete->getCaFleteminimo() || $flete->getCaFleteminimo()!=0 ) ){	
					$pricflete = PricFletePeer::retrieveByPk( $trayecto->getCaIdTrayecto(), 88 );
					if(!$pricflete){
						$pricflete = new PricFlete();
						$pricflete->setCaIdTrayecto( $trayecto->getCaIdTrayecto() );
						$pricflete->setCaIdConcepto( 88 );
					}
					$pricflete->setCaVlrneto( $flete->getCaFleteminimo() );
					$pricflete->setCaVlrsugerido( $flete->getCaFleteminimo() );
					$pricflete->setCaFchinicio( $flete->getCaFchinicio() );
					$pricflete->setCaFchvencimiento( $flete->getCaFchvencimiento() );
					$pricflete->setCaIdmoneda( $flete->getCaIdmoneda() );				
					if( $flete->getCaSugerida()=="*" ){
						$pricflete->setCaEstado( 1 );
					}
					if( $flete->getCaMantenimiento()=="*" ){
						$pricflete->setCaEstado( 2 );
					}				
					$pricflete->save();	
					//echo "asd2";
				}
				
				//Importación de los recargos 
				
				
				$c = new Criteria();
				//$c->setLimit(500);
				$c->add( RecargoFletePeer::CA_IDCONCEPTO, $flete->getCaIdConcepto() ); 
				
				if( $trayecto->getCaIdtarifas()!=$trayecto->getCaIdTrayecto() ){				
					$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto2->getCaIdtrayecto() ); 
				}else{
					$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() ); 
				}					
				
				
				$recargos = RecargoFletePeer::doSelect( $c );				
				foreach( $recargos as $recargo ){
												
					$pricrecargo = PricRecargoxConceptoPeer::retrieveByPk( $trayecto->getCaIdtrayecto(), $recargo->getCaIdConcepto(), $recargo->getCaIdRecargo() ); 	
					if( !$pricrecargo ){
						$pricrecargo = new PricRecargoxConcepto();
						$pricrecargo->setCaIdTrayecto( $trayecto->getCaIdtrayecto() );
						$pricrecargo->setCaIdConcepto( $recargo->getCaIdConcepto() );
						$pricrecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
					}
																			
					if( $recargo->getCaVlrfijo()&& $recargo->getCaVlrfijo()!=0 ){
						$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrfijo() );											
						//echo "-> fijo ".$recargo->getCaVlrfijo()."<br />";	
					}else{
						if( $recargo->getCaPorcentaje() && $recargo->getCaPorcentaje()!=0 ){
							echo "-> % ".$recargo->getCaPorcentaje()." ".$recargo->getCaBasePorcentaje()."<br />";	
							$pricrecargo->setCaVlrrecargo( $recargo->getCaPorcentaje() );
												
							//if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
								$pricrecargo->setCaAplicacion( '% Sobre Flete' );
							//}
												
						}else{
							echo "-> Unit ".$recargo->getCaVlrunitario()." ".$recargo->getCaBaseunitario()."<br />";	
							$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrunitario() );
							
							if( $recargo->getCaBaseunitario()=='Unidades Peso/Volumen' ){						
								echo " OK <br />";
								$pricrecargo->setCaAplicacion( 'x Kg ó 6 Dm³' );									
								
							}
										
							if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
								//$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
								if( $trayecto->getCaTransporte()=="Aéreo" ){
									$pricrecargo->setCaAplicacion( 'x HAWB' );
								}
								if( $trayecto->getCaTransporte()=="Marítimo" ){
									$pricrecargo->setCaAplicacion( 'x HBL' );
								}
							}
							
							if( $recargo->getCaBaseunitario()=="Número de Piezas" ){
								$pricrecargo->setCaAplicacion( "x Pieza" );
								
							}					
						}
					}
					$pricrecargo->setCaFchinicio( $recargo->getCaFchinicio() );
					$pricrecargo->setCaFchvencimiento( $recargo->getCaFchvencimiento() );
								
					$pricrecargo->setCaVlrminimo( $recargo->getCaRecargominimo() );
					$pricrecargo->setCaIdmoneda( $recargo->getCaIdmoneda() );
										
					if(in_array($recargo->getCaObservaciones(), $porHbl )){
						$pricrecargo->setCaAplicacionMin( "x HBL" );
					}elseif(in_array($recargo->getCaObservaciones(), $porCtnr )){
						$pricrecargo->setCaAplicacionMin( "x Contenedor" );
					}elseif(in_array($recargo->getCaObservaciones(), $porEmbarque )){
						$pricrecargo->setCaAplicacionMin( "x Embarque" );				
					}elseif(in_array($recargo->getCaObservaciones(), $porTm3 )){
						$pricrecargo->setCaAplicacionMin( "x T/M³" );	
					}
					else{				
						$pricrecargo->setCaObservaciones( $recargo->getCaObservaciones() );						
					}
					
					if( $recargo->getCaUsuActualizado() ){
						$pricrecargo->setCaUsucreado($recargo->getCaUsuactualizado());
						$pricrecargo->setCaFchcreado($recargo->getCaFchactualizado());
					}elseif( $recargo->getCaUsucreado() ){
						$pricrecargo->setCaUsucreado($recargo->getCaUsucreado());
						$pricrecargo->setCaFchcreado($recargo->getCaFchcreado());
					}
					
					if( !$pricrecargo->getCaUsucreado() ){
						$pricrecargo->setCaUsucreado("Administrador");
					}
					
					if( !$pricrecargo->getCaFchcreado() ){
						$pricrecargo->setCaFchcreado(date("Y-m-d"));
					} 
									
					$pricrecargo->save();
				}
				
				//----------------------
				
			}	
			
			
			// Recargos generales 
			$c = new Criteria();
			//$c->setLimit(500);
			$c->add( RecargoFletePeer::CA_IDCONCEPTO, '9999' ); 
			if( $trayecto->getCaIdtarifas()!=$trayecto->getCaIdTrayecto() ){				
				$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto2->getCaIdtrayecto() ); 
			}else{
				$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() ); 
			}
			
			//$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() ); 
			$recargos = RecargoFletePeer::doSelect( $c );			
			foreach( $recargos as $recargo ){
										
				$pricrecargo = PricRecargoxConceptoPeer::retrieveByPk( $trayecto->getCaIdtrayecto(), $recargo->getCaIdConcepto(), $recargo->getCaIdRecargo() ); 	
				if( !$pricrecargo ){
					$pricrecargo = new PricRecargoxConcepto();
					$pricrecargo->setCaIdTrayecto( $trayecto->getCaIdtrayecto() );
					$pricrecargo->setCaIdConcepto( $recargo->getCaIdConcepto() );
					$pricrecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
				}
																		
				if( $recargo->getCaVlrfijo() && $recargo->getCaVlrfijo()!=0 ){
					$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrfijo() );											
					echo "-> fijo ".$recargo->getCaVlrfijo()."<br />";	
				}else{
					if( $recargo->getCaPorcentaje() && $recargo->getCaPorcentaje()!=0){
						echo "-> % ".$recargo->getCaPorcentaje()." ".$recargo->getCaBasePorcentaje()."<br />";	
						$pricrecargo->setCaVlrrecargo( $recargo->getCaPorcentaje() );
											
						//if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
							$pricrecargo->setCaAplicacion( '% Sobre Flete' );
						//}
											
					}else{
						echo "-> Unit ".$recargo->getCaVlrunitario()." ".$recargo->getCaBaseunitario()."<br />";	
						$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrunitario() );
						
						if( $recargo->getCaBaseunitario()=='Unidades Peso/Volumen' ){						
							echo " OK <br />";
							$pricrecargo->setCaAplicacion( 'x Kg ó 6 Dm³' );									
							
						}
									
						if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
							$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
							if( $trayecto->getCaTransporte()=="Aéreo" ){
								$pricrecargo->setCaAplicacion( 'x HAWB' );
							}
							if( $trayecto->getCaTransporte()=="Marítimo" ){
								$pricrecargo->setCaAplicacion( 'x HBL' );
							}
						}
						
						if( $recargo->getCaBaseunitario()=="Número de Piezas" ){
							$pricrecargo->setCaAplicacion( "x Pieza" );
							
						}					
					}
				}
				$pricrecargo->setCaFchinicio( $recargo->getCaFchinicio() );
				$pricrecargo->setCaFchvencimiento( $recargo->getCaFchvencimiento() );
							
				$pricrecargo->setCaVlrminimo( $recargo->getCaRecargominimo() );
				$pricrecargo->setCaIdmoneda( $recargo->getCaIdmoneda() );
				
			
				
				if(in_array($recargo->getCaObservaciones(), $porHbl )){
					$pricrecargo->setCaAplicacionMin( "x HBL" );
				}elseif(in_array($recargo->getCaObservaciones(), $porCtnr )){
					$pricrecargo->setCaAplicacionMin( "x Contenedor" );
				}elseif(in_array($recargo->getCaObservaciones(), $porEmbarque )){
					$pricrecargo->setCaAplicacionMin( "x Embarque" );				
				}elseif(in_array($recargo->getCaObservaciones(), $porTm3 )){
					$pricrecargo->setCaAplicacionMin( "x T/M³" );	
				}
				else{				
					$pricrecargo->setCaObservaciones( $recargo->getCaObservaciones() );						
				}
				
				
				if( $recargo->getCaUsuActualizado() ){
					$pricrecargo->setCaUsucreado($recargo->getCaUsuactualizado());
					$pricrecargo->setCaFchcreado($recargo->getCaFchactualizado());
				}elseif( $recargo->getCaUsucreado() ){
					$pricrecargo->setCaUsucreado($recargo->getCaUsucreado());
					$pricrecargo->setCaFchcreado($recargo->getCaFchcreado());
				}
				
				if( !$pricrecargo->getCaUsucreado() ){
					$pricrecargo->setCaUsucreado("Administrador");
				}
				
				if( !$pricrecargo->getCaFchcreado() ){
					$pricrecargo->setCaFchcreado(date("Y-m-d"));
				} 
								
				$pricrecargo->save();
			}	
		}		
	}
	
	/*
	* Importa el tarifario anterior dentro del nuevo tarifario
	*/	
	public function executeImportarNotasTarifario(){
		sfConfig::set('sf_web_debug', false) ;	
		exit("Ejecutar solo una vez");
		$c = new Criteria();
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Exportación" );
		//$c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" );
 
		$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );
	
		//$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );
		//$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		//$c->setLimit(30);
		$trayectos = TrayectoPeer::doSelect( $c );	
		set_time_limit(0); 
		
		foreach( $trayectos as $trayecto ){	
			echo "*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-<br />"			;
			$fletes = $trayecto->getFletes();
			$notas = array();	
			$str = "";
			foreach( $fletes as $flete ){
				//print_r( $flete );
				//echo $flete->getCaobservaciones()."<br />";
				if( $flete->getCaobservaciones() ){
					
					$notas[] = $flete->getCaobservaciones();			
				}				
				
			}
			
			/*if( count($notas )>0 && count($fletes)!=count($notas ) ){
				echo count($fletes)." ".count($notas )."<br />";
				echo  $trayecto->getCaIdTrayecto()." diferencia entre los comentarios repetidos <br />";
			}*/
			
			$notas = array_unique( $notas );
			
			print_r( $notas );
			
			if( $trayecto->getCaObservaciones()  ){
				$str.= $trayecto->getCaObservaciones()."\n";
			}
			$str.=implode("\n" , $notas );
			echo Utils::replace( $str )."<br />-->---------->--------<br />";
			$trayecto->setCaObservaciones( $str );			
			$trayecto->save( );			
		}	
	}
	
	
	/*
	* Importa el tarifario anterior dentro del nuevo tarifario
	*/
	public function executeImportarTarifarioRecargosGrales(){
		set_time_limit(0); 		
		
		sfConfig::set('sf_web_debug', false) ;	
		
		$c = new Criteria();
		//$c->add(  RecargoFleteTrafPeer:: );
		//$c->setLimit(10);
		//$c->add(  RecargoFleteTrafPeer::CA_IMPOEXPO, "Importación" );
		$recargos = RecargoFleteTrafPeer::doSelect( $c );
		$i=0;
				
		foreach( $recargos as $recargo ){
			
			echo (++$i)." ".$recargo->getCaIdTrafico()." ".$recargo->getCaIdCiudad()." ".$recargo->getCaIdRecargo()." ".$recargo->getCaModalidad()."<br />";
		
			$pricrecargo = PricRecargosxCiudadPeer::retrieveByPk( $recargo->getCaIdTrafico(), $recargo->getCaIdCiudad(), $recargo->getCaIdRecargo(), $recargo->getCaModalidad(), $recargo->getCaImpoexpo() ); 	
			if( !$pricrecargo ){
				$pricrecargo = new PricRecargosxCiudad();
				$pricrecargo->setCaIdTrafico( $recargo->getCaIdTrafico() );
				$pricrecargo->setCaIdCiudad( $recargo->getCaIdCiudad() );
				$pricrecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
				$pricrecargo->setCaModalidad( $recargo->getCaModalidad() );
				$pricrecargo->setCaImpoexpo( $recargo->getCaImpoexpo() );
			}												
					
			if( $recargo->getCaVlrfijo() && $recargo->getCaVlrfijo()!=0 ){
				$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrfijo() );											
				//echo "-> fijo ".$recargo->getCaVlrfijo()."<br />";	
			}else{
				if( $recargo->getCaPorcentaje() && $recargo->getCaPorcentaje()!=0 ){
					echo "-> % ".$recargo->getCaPorcentaje()." ".$recargo->getCaBasePorcentaje()."<br />";	
					$pricrecargo->setCaVlrrecargo( $recargo->getCaPorcentaje() );
										
					//if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
						$pricrecargo->setCaAplicacion( '% Sobre Flete' );
					//}
										
				}else{
					echo "-> Unit ".$recargo->getCaVlrunitario()." ".$recargo->getCaBaseunitario()."<br />";	
					$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrunitario() );
					
					if( $recargo->getCaBaseunitario()=='Unidades Peso/Volumen' ){						
						echo " OK <br />";
						$pricrecargo->setCaAplicacion( 'x Kg ó 6 Dm³' );									
						
					}
								
					if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
						$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
						if( $trayecto->getCaTransporte()=="Aéreo" ){
							$pricrecargo->setCaAplicacion( 'x HAWB' );
						}
						if( $trayecto->getCaTransporte()=="Marítimo" ){
							$pricrecargo->setCaAplicacion( 'x HBL' );
						}
					}
					
					if( $recargo->getCaBaseunitario()=="Número de Piezas" ){
						$pricrecargo->setCaAplicacion( "x Pieza" );
						
					}				
				}
			}
			
			$pricrecargo->setCaFchinicio( $recargo->getCaFchinicio() );
			$pricrecargo->setCaFchvencimiento( $recargo->getCaFchvencimiento() );
						
			$pricrecargo->setCaVlrminimo( $recargo->getCaRecargominimo() );
			$pricrecargo->setCaIdmoneda( $recargo->getCaIdmoneda() );
			$pricrecargo->setCaObservaciones( $recargo->getCaObservaciones() );	
			
			if( !$pricrecargo->getCaUsucreado() ){
				$pricrecargo->setCaUsucreado("Administrador");
			}
			
			if( !$pricrecargo->getCaFchcreado() ){
				$pricrecargo->setCaFchcreado(date("Y-m-d"));
			} 
						
			$pricrecargo->save();
		}	
	}
	
	
	/*
	*
	*/	
	public function executeImportarArchivos(){
		$c = new Criteria();
		$traficos = TraficoPeer::doSelect( $c );
		$dir = "d:\\links\\";
		foreach( $traficos as $trafico ){
			echo $trafico->getCaNombre()."<br />";
			$links = explode("|", $trafico->getCalink());
			foreach( $links as $link ){
				echo "<br />---->".$link;
				$path = $dir.$link;
				
				
				$fileObj = new PricArchivo();
				
				$fileObj->setCaNombre($link);
				$fileObj->setCaIdTrafico($trafico->getCaIdtrafico());	
				
				$fileObj->setCaTamano($size);
				$fileObj->setCaTipo(Utils::mimetype($link));
				$fileObj->setCaTransporte($transporte);
				$fileObj->setCaModalidad("FCL");
				$fileObj->setCaImpoExpo("Importación");
				$fp = fopen($path, "r");
				$data = fread( $fp , $size);
				fclose( $fp );
				$fileObj->setCaDatos($data);
				$fileObj->setCaFchcreado(time());
				$user = $this->getUser();
				$fileObj->setCaUsucreado("Administrador");
				//$fileObj->save();
				
			}
		}
		
		//$path  = "";
	
		
		
	
	}
	
	
	/*
	* Importa el tarifario anterior dentro del nuevo tarifario
	*/
	
	/*
	public function executeImportarTarifarioRecargos(){
		set_time_limit(0); 		
		exit("Este no");
		$c = new Criteria();
		//$c->setLimit(500);
		$c->add( RecargoFletePeer::CA_IDCONCEPTO, '9999' ); 
		//$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() ); 
		$recargos = RecargoFletePeer::doSelect( $c );
		
		sfConfig::set('sf_web_debug', false) ;	
		
		foreach( $recargos as $recargo ){
			$trayecto = RecargoFletePeer::retrieveByPk( $recargo->getCaIdtrayecto() );
						
			$pricrecargo = PricRecargoxConceptoPeer::retrieveByPk( $recargo->getCaIdTrayecto(), $recargo->getCaIdConcepto(), $recargo->getCaIdRecargo() ); 	
			if( !$pricrecargo ){
				$pricrecargo = new PricRecargoxConcepto();
				$pricrecargo->setCaIdTrayecto( $recargo->getCaIdTrayecto() );
				$pricrecargo->setCaIdConcepto( $recargo->getCaIdConcepto() );
				$pricrecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
			}
																	
			if( $recargo->getCaVlrfijo() ){
				$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrfijo() );											
				//echo "-> fijo ".$recargo->getCaVlrfijo()."<br />";	
			}else{
				if( $recargo->getCaPorcentaje() ){
					echo "-> % ".$recargo->getCaPorcentaje()." ".$recargo->getCaBasePorcentaje()."<br />";	
					$pricrecargo->setCaVlrrecargo( $recargo->getCaPorcentaje() );
										
					//if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
						$pricrecargo->setCaAplicacion( '% Sobre Flete' );
					//}
										
				}else{
					echo "-> Unit ".$recargo->getCaVlrunitario()." ".$recargo->getCaBaseunitario()."<br />";	
					$pricrecargo->setCaVlrrecargo( $recargo->getCaVlrunitario() );
					
					if( $recargo->getCaBaseunitario()=='Unidades Peso/Volumen' ){						
						echo " OK <br />";
						$pricrecargo->setCaAplicacion( 'x Kg ó 6 Dm³' );									
						
					}
								
					if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
						$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
						if( $trayecto->getCaTransporte()=="Aéreo" ){
							$pricrecargo->setCaAplicacion( 'x HAWB' );
						}
						if( $trayecto->getCaTransporte()=="Marítimo" ){
							$pricrecargo->setCaAplicacion( 'x HBL' );
						}
					}
					
					if( $recargo->getCaBaseunitario()=="Número de Piezas" ){
						$pricrecargo->setCaAplicacion( "x Pieza" );
						
					}					
				}
			}
			$pricrecargo->setCaFchinicio( $recargo->getCaFchinicio() );
			$pricrecargo->setCaFchvencimiento( $recargo->getCaFchvencimiento() );
						
			$pricrecargo->setCaVlrminimo( $recargo->getCaRecargominimo() );
			$pricrecargo->setCaIdmoneda( $recargo->getCaIdmoneda() );
			
			$porBL = array( "POR BL", "POR BL ", "Por B/l", "Por BL", "Por Bl" );
		
			$porHbl = array( "Por HBL" );
			
			$porCtnr  = array( "POR CNTR" , "POR CONTENEDOR", "Por contenedor", "Por contenedor", "Por Cntr");
			
			$porEmbarque = array( "Por embarque", "Por embarque\n", "Por Embarque" );
			
			$porTm3 = array( "Por T/M3", "POR T/M3", "T/M3", "T/M3\n", "T/M3 ", "por T/M3", "POR T/M3",);
			
			if(in_array($recargo->getCaObservaciones(), $porHbl )){
				$pricrecargo->setCaAplicacionMin( "x HBL" );
			}elseif(in_array($recargo->getCaObservaciones(), $porCtnr )){
				$pricrecargo->setCaAplicacionMin( "x Contenedor" );
			}elseif(in_array($recargo->getCaObservaciones(), $porEmbarque )){
				$pricrecargo->setCaAplicacionMin( "x Embarque" );				
			}elseif(in_array($recargo->getCaObservaciones(), $porTm3 )){
				$pricrecargo->setCaAplicacionMin( "x T/M³" );	
			}
			else{				
				$pricrecargo->setCaObservaciones( $recargo->getCaObservaciones() );						
			}
			
			
			if( $recargo->getCaUsuActualizado() ){
				$pricrecargo->setCaUsucreado($recargo->getCaUsuactualizado());
				$pricrecargo->setCaFchcreado($recargo->getCaFchactualizado());
			}elseif( $recargo->getCaUsucreado() ){
				$pricrecargo->setCaUsucreado($recargo->getCaUsucreado());
				$pricrecargo->setCaFchcreado($recargo->getCaFchcreado());
			}
			
			if( !$pricrecargo->getCaUsucreado() ){
				$pricrecargo->setCaUsucreado("Administrador");
			}
			
			if( !$pricrecargo->getCaFchcreado() ){
				$pricrecargo->setCaFchcreado(date("Y-m-d"));
			} 
							
			$pricrecargo->save();
		}
		
	}
	*/
	
		
	
	
	
	
		
	/*
	* Esta funcion se va a borrar
	*/
	public function executeParametrizarConceptos(){
		$c = new Criteria();
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Exportación" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" );

		/*$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );
		$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );*/
		//$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		//$c->setLimit(30);
		$trayectos = TrayectoPeer::doSelect( $c );

		set_time_limit(0);

		foreach( $trayectos as $trayecto ){
				
			$fletes = $trayecto->getFletes();
				
			//		$trayecto->getOrigen();
			
			$ciudad = CiudadPeer::retrieveByPk( $trayecto->getCaOrigen() );
			$trafico = $ciudad->getTrafico();
				
			$conceptosStr = $trafico->getCaConceptos();
			//$conceptosStr="";
				
			//$recargosStr = $trafico->getCaRecargos();
			//$recargosStr="";
				
			foreach($fletes as $flete ){
				//echo $flete->getCaIdConcepto()."<br />";
				/*if( $flete->getCaIdConcepto()==9999){
					continue;
					}*/

				if(strlen($conceptosStr)!=0){
					$conceptosStr.="|";
				}

				$conceptosStr.=$flete->getCaIdConcepto();
			}
			$conceptosArr = explode("|",$conceptosStr);
			$conceptosArr = array_unique($conceptosArr);
			$conceptosStr=implode("|",$conceptosArr);
			echo "<br />Conceptos -->".$conceptosStr."<br />";
			$trafico->setCaConceptos($conceptosStr);
			$trafico->save();
			
			
		/*	$c = new Criteria();
			$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdTrayecto() );
			$recargos = RecargoFletePeer::doSelect($c);

			foreach( $recargos as $recargo ){
				if(strlen($recargosStr)!=0){
					$recargosStr.="|";
				}
				$tipoRec = $recargo->getTipoRecargo();
				echo "->".$tipoRec->getCaRecargo();
				$recargosStr.= $tipoRec->getCaIdrecargo();
			}
				
				
			
				
			$recargosArr = explode("|",$recargosStr);
			$recargosArr = array_unique($recargosArr);
			$recargosStr=implode("|",$recargosArr);
			echo "<br />Recargos -->".$recargosStr."<br />";
			$trafico->setCaRecargos($recargosStr);
			//$trafico->save();*/
				
				
		}
	}
	
	/*
	* Incluye los conceptos basico en todos los traficos 
	* 88 9  //tm3 minimo 
	* 1  minimo aereo 
	* 133 134 coloadins
	*/
	public function executeIncluirConceptosTrafico(){
		$c = new Criteria();
		$traficos = TraficoPeer::doSelect( $c );
		print_r( $traficos );		
		foreach( $traficos as $trafico){
			$conceptosStr = $trafico->getCaConceptos();
			if( $conceptosStr ){
				$conceptosArr = explode("|",$conceptosStr);
			}else{
				$conceptosArr = array();
			}
			$conceptosArr[]=88;
			$conceptosArr[]=9;
			$conceptosArr[]=1;
			$conceptosArr[]=133;
			$conceptosArr[]=134;
			$conceptosArr = array_unique($conceptosArr);
			$conceptosStr=implode("|",$conceptosArr);
			
			echo "->".$trafico." ".$conceptosStr."<br />";
			$trafico->setCaConceptos($conceptosStr);
			$trafico->save();
		}
	}
	
	/*
	* TRM 
	*/
	public function executeGetTRM(){
		
		/* Guarda en la base de datos la tasa representativa del mercado. */			
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
	
	/*
	* TRM 
	*/
	public function executeGetAlaico(){
		
		
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
	
	
	/*
	* Unifica los recargos LCL en recargos generales del trayecto
	*/
	public function executeFixTarifarioLCL(){
		
		exit();
		$c = new Criteria();
	
		
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Marítimo" ); 
		$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		
		
		
		//$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
		//$c->add( TrayectoPeer::CA_TRANSPORTE , "Marítimo" ); 
		//$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );				
		
		//$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );
		//
		//$c->add( TrayectoPeer::CA_IDTRAYECTO, 3705 );
		
		//$c->setLimit(30);
		$trayectos = TrayectoPeer::doSelect( $c );	
		set_time_limit(0); 
		
		foreach( $trayectos as $trayecto ){	
						
			$c = new Criteria();
			$c->add( PricRecargoxConceptoPeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() );
			$recs = PricRecargoxConceptoPeer::doSelect( $c );
			if( count($recs)>0 ){
				$idRecargos = array();							
				foreach( $recs as $recargo ){
					$idRecargos[]=$recargo->getCaIdrecargo();	
				}
				
				foreach( $idRecargos as $idRecargo ){
					if( $idRecargo==9999){
						continue;
					}
					$c = new Criteria();
					$c->add( PricRecargoxConceptoPeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() );
					$c->add( PricRecargoxConceptoPeer::CA_IDRECARGO, $idRecargo );
					$recargos = PricRecargoxConceptoPeer::doSelect( $c );
					
					echo count($recargos)."<br />";
					for( $i=0; $i<count($recargos); $i++ ){
						if($i==0){
							
							$vlrRecargo = $recargos[$i]->getCaVlrrecargo();
							$vlrMinimo = $recargos[$i]->getCaVlrminimo();
						}else{
							echo "asasd";
							if( $vlrRecargo!=$recargos[$i]->getCaVlrrecargo() && $vlrMinimo != $recargo[$i]->getCaVlrminimo() ){
								echo "aca no se pudo<br /> ".$recargo->getCaIdTrayecto();
							}else{
								echo "OK ".$recargo->getCaIdTrayecto();
							}
						}
						
						/*
						if($i==0){
							$recargos[$i]->setCaIdConcepto(9999);
							$recargos[$i]->save();
						}else{
							
						}*/
					}
				}
				
			}	
		}	
	}
	
	/*
	* Coloca la fecha de presentacion de acuerdo a los envios por email
	*/
	public function executeFixCotFchpresentacion(){
		$sql = "SELECT ca_idcotizacion, ca_fchenvio 
from tb_cotizaciones INNER JOIN  tb_emails ON tb_cotizaciones.ca_idcotizacion = tb_emails.ca_idcaso 
WHERE tb_emails.ca_tipo = 'Envío de cotización' AND ca_consecutivo IS NOT  NULL AND tb_emails.ca_fchenvio = (SELECT MIN(ca_fchenvio) from tb_emails a WHERE a.ca_idemail=tb_emails.ca_idemail )";
		$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		
		$stmt = $con->prepare($sql);
		$stmt->execute();	 
		
		while($row= $stmt->fetch() ){
			//print_r( $row );
			$cotizacion = CotizacionPeer::retrieveByPk( $row['ca_idcotizacion']);
			$cotizacion->setCaFchpresentacion(  $row['ca_fchenvio']);
			$cotizacion->save();
			
			echo "OK ".$cotizacion->getCaConsecutivo();
		}
	
	} 
}
?>
