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
		$ciudad->setCaIdCiudad("prueb�");
		$ciudad->setCaPuerto("prueb�");
		$ciudad->save();*/
		print_r ( $this->getRequestParameter ( "asd" ) );
		$ciudad = CiudadPeer::retrieveByPk ( "prueb�" );
		$ciudad->setCaPuerto ( $this->getRequestParameter ( "asd" ) );
		//$ciudad->setCaPuerto( utf8_encode("prueb�"));
	//$ciudad->save();
	//print_r( Utils::replace($ciudad->getCaIdCiudad()) );
	

	}
	
	public function executeSendEmail() {
		//exit("detenido");
		$c = new Criteria ( );
		/*$c->add ( EmailPeer::CA_FCHENVIO, "2009-03-26 14:58:01", Criteria::GREATER_THAN );
		$c->addAnd ( EmailPeer::CA_FCHENVIO, "2009-03-26 14:58:00", Criteria::LESS_THAN );
		
		$c->add(  EmailPeer::CA_ADDRESS, "%bsnmedical%", Criteria::NOT_LIKE  );
		$c->addAnd(  EmailPeer::CA_ADDRESS, "%willard%", Criteria::NOT_LIKE  );
		*/
		//$c->addAnd ( EmailPeer::CA_FCHENVIO, "2009-03-26 14:50:00", Criteria::LESS_THAN );		
		
		 
		
		//$c->add(EmailPeer::CA_TIPO, "Env�o de Avisos" );
		//$c->addOr(EmailPeer::CA_TIPO, "Env�o de Status" );
		
		$c->add( EmailPeer::CA_IDEMAIL, 240411);
		$c->addOr( EmailPeer::CA_IDEMAIL, 240610);
		$c->addOr( EmailPeer::CA_IDEMAIL, 240656);
		$c->addAscendingOrderByColumn ( EmailPeer::CA_FCHENVIO );
			
		$i = 0;
		$emails = EmailPeer::doSelect ( $c );
		foreach ( $emails as $email ) {
			//print_r( $email);
			echo "<strong>Enviando " . $i ++ . "</strong>	emailid: " . $email->getCaIdEmail () . " Fch: " . $email->getCaFchEnvio () . " <br />From: " . $email->getCaFrom () . "<br />";
				
			$addresses = explode(",",$email->getCaAddress());			
			/*foreach( $addresses as $key=>$address ){
				if( strpos( $address, "coltrans.com.co" )!=false ){
					unset( $addresses[$key] );
				}
			}*/
			$email->setCaAddress( implode(",", $addresses) );
						
			$ccs = explode(",",$email->getCaCC());
			
			/*
			foreach( $ccs as $key=>$address ){
				if( strpos( $address, "coltrans.com.co" )!=false ){
					unset( $addresses[$key] );
				}
			}*/
			$email->setCaCc( implode(",", $ccs) );
			
			
			echo "to: " . $email->getCaAddress () . "<br />";
			echo "CC: " . $email->getCaCC () . "<br />";
			echo "Subject" . $email->getCaSubject () . "<br />";
			
			if( !$email->getCaBodyHtml() ){
				$email->setCaBodyHtml( "Este mensaje se reenvia por problemas de visualizacion en env&acute;os anteriores <br />Si usted ya lo recibi&oacute; por favor haga caso omiso de este mensaje<br /><br />".$email->getCaBody() );
				
				$email->setCaBody("");
			}
			
			
			echo $email->send()."<br /><br />";
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
		$c->add ( ReportePeer::CA_IMPOEXPO, "Importaci�n" );
		$c->add ( ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada", Criteria::NOT_EQUAL );
		$c->add ( ReportePeer::CA_TRANSPORTE, "Mar�timo" );
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
		$c->add( EmailPeer::CA_TIPO , "Confirmaci�n" );
		$c->add( RepStatusPeer::CA_ETAPA, "Carga Embarcada");
		$c->add(ReportePeer::CA_TRANSPORTE , "A�reo" );
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
		$file = 'LTR0Qk4ybk1jcWMta0FiMngtVkVpMDcxU1VjWmJfcG05T05XWF91YW1qTmpia255b2ZLSUc0NHlZejU3eEpXaUx3MkJ3RGUzb1ZoQk8yT0hYaVVrZ080RXl0ZEVLeFF2eTAydTVCclRLNG5Bek5zVWxDMVNoNWIxUW9sRjc1dmdlV3ZmcGhoQnU1MDBSMFI0U3NHQzFSckpKa29RTGh0TXM5ZHhGQ2lnem5XRGVFeXFfWldPU25wVlNGNW9rQ3ZlMkl5aEoyT29vVk51RUotbEVFM21lX0VteVNYOWFHTHRHN1dZT1BMNFRjMDVhLVpycm1uMEZQNEFIcVRidFVVSUt6UEQzSXQtdHdNUDVFYVRNNUdINkVoQWZmbE9oMjdtMmdndjVwbldRVG8u';
		//header("Content-Type: application/octet-stream");
		//header("Content-Disposition: attachment; filename=archivo.tiff");
		echo base64_decode($file);
		
	}
	
	/*
	* Se pretende corregir un error donde se coloco el numero del consecutivo sin el a�o en el ino aereo
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
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importaci�n" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Mar�timo" ); 
		*/
		
		/*
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importaci�n" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "A�reo" ); 
		*/
		
		
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Exportaci�n" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "A�reo" ); 
		
		
		
		
		//$c->add( TrayectoPeer::CA_IMPOEXPO, "Importaci�n" );
		//$c->add( TrayectoPeer::CA_TRANSPORTE , "Mar�timo" ); 
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
				
				//Importaci�n de los recargos 
				
				
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
								$pricrecargo->setCaAplicacion( 'x Kg � 6 Dm�' );
							}
										
							if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
								//$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
								if( $trayecto->getCaTransporte()=="A�reo" ){
									$pricrecargo->setCaAplicacion( 'x HAWB' );
								}
								if( $trayecto->getCaTransporte()=="Mar�timo" ){
									$pricrecargo->setCaAplicacion( 'x HBL' );
								}
							}
							
							if( $recargo->getCaBaseunitario()=="N�mero de Piezas" ){
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
						$pricrecargo->setCaAplicacionMin( "x T/M�" );	
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
							$pricrecargo->setCaAplicacion( 'x Kg � 6 Dm�' );									
							
						}
									
						if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
							$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
							if( $trayecto->getCaTransporte()=="A�reo" ){
								$pricrecargo->setCaAplicacion( 'x HAWB' );
							}
							if( $trayecto->getCaTransporte()=="Mar�timo" ){
								$pricrecargo->setCaAplicacion( 'x HBL' );
							}
						}
						
						if( $recargo->getCaBaseunitario()=="N�mero de Piezas" ){
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
					$pricrecargo->setCaAplicacionMin( "x T/M�" );	
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
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Exportaci�n" );
		//$c->add( TrayectoPeer::CA_TRANSPORTE , "A�reo" );
 
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
		//$c->add(  RecargoFleteTrafPeer::CA_IMPOEXPO, "Importaci�n" );
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
						$pricrecargo->setCaAplicacion( 'x Kg � 6 Dm�' );									
						
					}
								
					if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
						$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
						if( $trayecto->getCaTransporte()=="A�reo" ){
							$pricrecargo->setCaAplicacion( 'x HAWB' );
						}
						if( $trayecto->getCaTransporte()=="Mar�timo" ){
							$pricrecargo->setCaAplicacion( 'x HBL' );
						}
					}
					
					if( $recargo->getCaBaseunitario()=="N�mero de Piezas" ){
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
				$fileObj->setCaImpoExpo("Importaci�n");
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
						$pricrecargo->setCaAplicacion( 'x Kg � 6 Dm�' );									
						
					}
								
					if( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
						$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );	
						if( $trayecto->getCaTransporte()=="A�reo" ){
							$pricrecargo->setCaAplicacion( 'x HAWB' );
						}
						if( $trayecto->getCaTransporte()=="Mar�timo" ){
							$pricrecargo->setCaAplicacion( 'x HBL' );
						}
					}
					
					if( $recargo->getCaBaseunitario()=="N�mero de Piezas" ){
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
				$pricrecargo->setCaAplicacionMin( "x T/M�" );	
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
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Exportaci�n" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "A�reo" );
		$c->add( TrayectoPeer::CA_MODALIDAD , "DIRECTO" );

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
			
			//$conceptosStr.="|22|23|24|25|26|27|28";
			$conceptosArr = explode("|",$conceptosStr);
			$conceptosArr = array_unique($conceptosArr);
			/*$conceptosStr=implode("|",$conceptosArr);
			echo "<br />Conceptos -->".$conceptosStr."<br />";*/
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
		
		exit("detenido");
		$c = new Criteria();
	
		
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importaci�n" );
		$c->add( TrayectoPeer::CA_TRANSPORTE , "Mar�timo" ); 
		$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		
		
		
		//$c->add( TrayectoPeer::CA_IMPOEXPO, "Importaci�n" );
		//$c->add( TrayectoPeer::CA_TRANSPORTE , "Mar�timo" ); 
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
		
		set_time_limit(0);
		
		$sql = "SELECT distinct ca_idcotizacion,  MIN(ca_fchenvio) as ca_fchenvio
from tb_cotizaciones INNER JOIN  tb_emails ON tb_cotizaciones.ca_idcotizacion = tb_emails.ca_idcaso 
WHERE tb_emails.ca_tipo = 'Env�o de cotizaci�n' AND ca_consecutivo IS NOT  NULL 
group by ca_idcotizacion";
		$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		
		$stmt = $con->prepare($sql);
		$stmt->execute();	 
		
		while($row= $stmt->fetch() ){
			//print_r( $row );
			$cotizacion = CotizacionPeer::retrieveByPk( $row['ca_idcotizacion']);
			$cotizacion->setCaFchpresentacion(  $row['ca_fchenvio']);
			//$cotizacion->save();
			
			echo "OK ".$cotizacion->getCaConsecutivo()."<br />";
		}
		return sfView::NONE;
	} 
	
	
	public function executeGenerarFuente(){
		require( "D:\\Desarrollo\\colsys_sf12\\lib\\vendor\\FPDF\\font\\makefont\\makefont.php" );
		MakeFont('D:\\Desarrollo\\sw\\ttf2pt1\\tahoma.ttf','D:\\Desarrollo\\sw\\ttf2pt1\\tahoma.afm','cp1252'); 
		MakeFont('D:\\Desarrollo\\sw\\ttf2pt1\\tahomabd.ttf','D:\\Desarrollo\\sw\\ttf2pt1\\tahomab.afm','cp1252');
		exit("detenido");
	}
	
	
	
	
	
	
	public function executeImportarHelpdesk(){
		
		exit("detenido");
		
		$c = new Criteria();
		//$c->add( ExoTicketPeer::STATUS, "Open" );
		
		$criterion = $c->getNewCriterion( ExoTicketPeer::OPENED, mktime(0,0,0,1,1,2009) , Criteria::GREATER_EQUAL );				
		$criterion->addOr($c->getNewCriterion( ExoTicketPeer::STATUS, "Open" ));			
		$c->add($criterion);
				
		
		//$c->setLimit( 10 );
		$tickets = ExoTicketPeer::doSelect( $c );
		
		foreach( $tickets as $ticket ){
			//echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";
			
			$hTicket = new HdeskTicket();
			if( $ticket->getAdminUser()=="backups" ){
				$hTicket->setCaLogin( "wjimenez" );
				$hTicket->setCaAssignedto( "thomaspeters" );
			}else{
				$hTicket->setCaLogin( strtolower($ticket->getAdminUser()) );
			}
			
			$hTicket->setCaOpened( date("Y-m-d h:i:s" ,$ticket->getOpened() ) );
			$hTicket->setCaTitle( utf8_decode($ticket->getTitle()) );
			$hTicket->setCaText( utf8_decode($ticket->getText()) );
			if( $ticket->getOwner() ){
				$hTicket->setCaAssignedto( $ticket->getOwner() );
			}
			
			if( $ticket->getStatus()=="Closed" ){
				$hTicket->setCaAction("Cerrado");
			}else{
				$hTicket->setCaAction("Abierto");
			}
			
			//echo utf8_decode($ticket->getGroup());
			
			$c = new Criteria();
			$c->add( HdeskGroupPeer::CA_NAME , utf8_decode($ticket->getGroup()) );
			$group =  HdeskGroupPeer::doSelectOne( $c );
			
			$hTicket->setCaIdgroup( $group->getCaIdgroup() );
			
			$hTicket->save();
			
			$responses = $ticket->getExoResponses();
			
			foreach( $responses as $response ){
				$hresponse = new HdeskResponse();
				$hresponse->setCaIdticket( $hTicket->getCaidticket() );
				if( $response->getSname()=="admin" ){
					$hresponse->setCaLogin( "falopez" );	
					
					
				}else{
					if( $response->getSname()=="backups"){
						$hresponse->setCaLogin("wjimenez");
					}else{				
						$hresponse->setCaLogin( strtolower($response->getSname()) );
					}
				}
				$hresponse->setCaText( utf8_decode($response->getComment()) );
				$hresponse->setCaCreatedat( date("Y-m-d H:i:s" ,$response->getPosted() ) );
				$hresponse->save();
				
			}
			
			/*$usuario = UsuarioPeer::retrieveByPk( strtolower($ticket->getAdminUser()) );
			if( !$usuario  && $ticket->getAdminUser()!= "backups"){
				//echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";
				echo $ticket->getId()." ".$ticket->getOpened()." No existe ". $ticket->getAdminUser()."<br />";
			}*/			
		}
		
		/*
		$c = new Criteria();
		$c->add( ExoResponsePeer::POSTED, mktime(0,0,0,1,1,2009) , Criteria::GREATER_EQUAL );
		$responses = ExoResponsePeer::doSelect( $c );
		
		foreach( $responses as $response ){
			//echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";
			
			$usuario = UsuarioPeer::retrieveByPk( strtolower($response->getSname()) );
			if( !$usuario  && $response->getSname()!= "backups"){
				//echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";
				echo $response->getId()." No existe ". $response->getSname()."<br />";
			}			
		}*/
		
		return sfView::NONE;
	}
	
	
	
	public function executeImportarHelpdeskRespuestas(){
		exit("detenido");	
		$c = new Criteria();
		$tickets = HdeskTicketPeer::doSelect( $c );
		
		foreach( $tickets as $ticket ){
			$text = str_replace("<br />", "<br>", $ticket->getCaText());
			
			echo $text;
			
			$ticket->setCaText( $text );
			$ticket->save();
			
			/*if( !$ticket->getCaResponseTime() ){
			
				$logins = array(  );
				
				$c = new Criteria();		
				$c->add( HdeskUserGroupPeer::CA_IDGROUP, $ticket->getCaIdgroup() );
				$c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
				$usuarios = HdeskUserGroupPeer::doSelect( $c );		
				foreach( $usuarios as $usuario ){
					$logins[]=$usuario->getCaLogin();
				}
				
				
				$c = new Criteria();
				$c->add( HdeskResponsePeer::CA_IDTICKET, $ticket->getcaIdticket() );
				$c->add( HdeskResponsePeer::CA_LOGIN, $logins, Criteria::IN );
				$c->addAscendingOrderByColumn( HdeskResponsePeer::CA_CREATEDAT );		
				
				$response = HdeskResponsePeer::doSelectOne( $c );
				
				if( $response ){
					$ticket->setCaResponsetime($response->getcaCreatedat());
					$ticket->save();
				}
			}*/
		}
		
		
		
		return sfView::NONE;
	}
	
	/*
	* Coloca la hora de respuesta en tb_tickets
	*/	
	public function executeFixRespuestas(){
		//exit("detenido");
		$c = new Criteria();
		$c->add( HdeskTicketPeer::CA_RESPONSETIME, null, Criteria::ISNULL );
		$tickets = HdeskTicketPeer::doSelect( $c );
		
		foreach( $tickets as $ticket ){			
			if( !$ticket->getCaResponseTime() ){
			
				$logins = array(  );
				
				$c = new Criteria();		
				$c->add( HdeskUserGroupPeer::CA_IDGROUP, $ticket->getCaIdgroup() );
				$c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
				$usuarios = HdeskUserGroupPeer::doSelect( $c );		
				foreach( $usuarios as $usuario ){
					$logins[]=$usuario->getCaLogin();
				}
				
				
				$c = new Criteria();
				$c->add( HdeskResponsePeer::CA_IDTICKET, $ticket->getcaIdticket() );
				$c->add( HdeskResponsePeer::CA_LOGIN, $logins, Criteria::IN );
				$c->addAscendingOrderByColumn( HdeskResponsePeer::CA_CREATEDAT );		
				
				$response = HdeskResponsePeer::doSelectOne( $c );
				
				if( $response ){
					$ticket->setCaResponsetime($response->getcaCreatedat());
					$ticket->save();
				}
			}
		}
		
		
		
		return sfView::NONE;
	}
	
	
	public function executePermisosColsys(){
		$c = new Criteria();		
		$usuarios = UsuarioPeer::doSelect( $c );
		
		foreach( $usuarios as $usuario ){
			$rutinas = explode("|", $usuario->getCaRutinas() );
			if( in_array("0200220000", $rutinas)  ){
				$rutinas[] = "0200240000";
			}
			
			//$rutinas[] = "0500600000";
			//$rutinas[] = "0500700000";
			
			$rutinas = array_unique( $rutinas );
			sort($rutinas); 
			$rutinasStr = implode("|", $rutinas );
			if( $rutinasStr ){
				$usuario->setCaRutinas( $rutinasStr );
			}else{
				$usuario->setCaRutinas( null );
			}
			echo $usuario->getCaLogin()." ".implode("|", $rutinas )." <br />";
			$usuario->save();				
			
		}		
	}
	
	public function executeMenusUsuario(){
		$usuario =  UsuarioPeer::retrieveByPk( $this->getRequestParameter("login"));
		$rutinas = explode("|", $usuario->getCaRutinas() );
		
		$c = new Criteria();
		$c->add( RutinaOldPeer::CA_RUTINA, $rutinas, Criteria::IN  );
		$c->addAscendingOrderByColumn( RutinaOldPeer::CA_GRUPO );
		$c->addAscendingOrderByColumn( RutinaOldPeer::CA_OPCION );
		$this->rutinas = RutinaOldPeer::doSelect( $c );			
	}
	
	
	public function executeFixMenus(){
		
		exit("OK");
		$c = new Criteria();
		$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
		$c->addAscendingOrderByColumn( RutinaPeer::CA_OPCION );
		
		$rutinas = RutinaPeer::doSelect( $c );
		$i=1;
		foreach( $rutinas as $rutina ){

			$sql = "UPDATE control.tb_rutinasnew SET ca_rutina='$i' WHERE ca_rutina='".$rutina->getCaRutina()."'";
			
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		
			$stmt = $con->prepare($sql);
			$stmt->execute();
			
			$i++;	
			
			
			
		}
		
	}
	
	
	public function executeMatchNits(){
		
		sfConfig::set('sf_web_debug', false) ;	
		set_time_limit(0);
		$path = "d:\\AlemaniaTotal.txt";
		
		$content = file_get_contents( $path ); 		
		$this->nits = explode( "\n", $content );
		
		$this->setLayout("none");
		
		
		
		
	}
	
	
	
	
	
	
	
	public function executeCopiarTrayectos(){
		$c = new Criteria();
		
		$c->addJoin(CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO );
		$c->addJoin(TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		$c->add( TrayectoPeer::CA_IMPOEXPO, "Importaci�n" );
		$c->add( TrayectoPeer::CA_TRANSPORTE, "Mar�timo" );
		$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
		$c->add( TrayectoPeer::CA_IDLINEA, 78 );
		
		
		$c->add( TraficoPeer::CA_IDGRUPO , 6 );
		$trayectos = TrayectoPeer::doSelect( $c );
		$lineas = array(20, 87 , 86, 18, 14 , 123, 16, 121, 17, 8 );
		$i = 1;
		foreach( $trayectos as $trayecto ){
			
			foreach( $lineas as $linea ){ 
			
				$c = new Criteria();
				$c->add( TrayectoPeer::CA_IMPOEXPO, "Importaci�n" );
				$c->add( TrayectoPeer::CA_TRANSPORTE, "Mar�timo" );
				$c->add( TrayectoPeer::CA_MODALIDAD, "FCL" );
				$c->add( TrayectoPeer::CA_ORIGEN, $trayecto->getCaOrigen() );
				$c->add( TrayectoPeer::CA_DESTINO, $trayecto->getCaDestino() );
				$c->add( TrayectoPeer::CA_IDLINEA, $linea );
				$tr =  TrayectoPeer::doSelectOne( $c );
				
				if( !$tr ){
						
					$trayectoNew = new Trayecto();
					$trayectoNew->setCaTransporte( "Mar�timo" );
					$trayectoNew->setCaImpoexpo( "Importaci�n" );
					$trayectoNew->setCaOrigen( $trayecto->getCaOrigen() );
					$trayectoNew->setCaDestino( $trayecto->getCaDestino() );
					$trayectoNew->setCaModalidad( "FCL" );
					$trayectoNew->setCaIdlinea( $linea );
					$trayectoNew->setCaIdagente( 0 );
					$trayectoNew->setCaFrecuencia( "-" );
					$trayectoNew->setCaTiempotransito( "-" );
					$trayectoNew->setCaFchcreado( time() );
					$trayectoNew->setCaIdtarifas( 1 );			
					$trayectoNew->save();
					
					$trayectoNew->setCaIdtarifas( $trayectoNew->getCaIdtrayecto() );
					$trayectoNew->save();
					echo "OK ".$linea." ".$trayecto->getOrigen()." ".$i++."<br />";
					
					
					
				}
			}
		}
		
		return sfView::NONE;
	}
	
	
	
	public function executeCircularColsys(){
		
		exit("detenido");
		$file =  sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."Circular_nuevos_costos_en_el_combustible.pdf";
		
		$txt = "Estimados se�ores:

De acuerdo con informaci�n de las l�neas navieras, adjunto nos permitimos enviar circular correspondiente a modificaciones en el Recargo por Combustible e implementaci�n del GRI (General Rate Increase) a partir del 1 de abril de 2009.

Cordialmente,

COLTRANS S.A.
Departamento Comercial
";
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( ContactoPeer::CA_IDCONTACTO  );
		$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );
		$c->addJoin( ClientePeer::CA_VENDEDOR, UsuarioPeer::CA_LOGIN );	
		$c->add(UsuarioPeer::CA_IDSUCURSAL, "BOG" );
		$c->add(ContactoPeer::CA_IDCONTACTO, 5718  , Criteria::GREATER_EQUAL );
		$c->addAnd(ContactoPeer::CA_IDCONTACTO, 7942 , Criteria::LESS_EQUAL );
		$c->add(ClientePeer::CA_STATUS, "Vetado", Criteria::NOT_EQUAL );
		
		//$c->setLimit(1);
		
		 
		$c->setDistinct();
		
		$contactos = ContactoPeer::doSelect( $c );
		$i=1;
		foreach( $contactos as $contacto ){
			if( $contacto->getCaEmail() ){
				echo  ($i++)." ".$contacto->getCaIdcontacto()." ".$contacto->getCaEmail()."<br />"; 
				
				$email = new Email();
				$email->setCaFrom("serclientebog@coltrans.com.co");
				$email->setCaFromname("Coltrans S.A. - Servicio al cliente");
				$email->setCaAddress($contacto->getCaEmail());
				//$email->setCaAddress("abotero@coltrans.com.co");
				$email->setCaSubject("Circular nuevos costos en el combustible y otros recargos a aplicar a partir 01 de Abril de 2009");
				$email->setCaBody($txt);
				$email->setCaBodyHtml(Utils::replace($txt) );
				$email->setCaAttachment( $file );
				$email->setCaTipo( "Circular combustible" );
				$email->setCaIdcaso( 0 );
				$email->setCaFchenvio( time() );
				$email->setCaUsuenvio( "Administrador" );
				//$email->save();
				//$email->send();
			}
		}		
		return sfView::NONE;
	}
	
	
	public function executeColocarLimitetiempo(){
		exit("detenido");
		$sql = "select * from pg_user";
		$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		while($row = $stmt->fetch() ){
			if( $row['usename']!="postgres" && $row['usename']!="Administrador" ){
				$sql = "ALTER ROLE \"".$row['usename']."\" SET statement_timeout=240000";
				//echo $row['usename']."<br />";
				echo $sql.";<br />";
			}
		}
		return sfView::NONE;
	}
	
	
	public function executeHorasCotizaciones(){

		sfConfig::set('sf_web_debug', false) ;	
		set_time_limit(0);
		$path = "d:\\horascotizaciones.csv";
		$i = 0;
		$content = file_get_contents( $path ); 		
		$rows = explode( "\n", $content );
		echo "OK ";
		foreach($rows as $row  ){
			$row = explode(";" ,$row);
			$c = new Criteria();
			$c->add( CotizacionPeer::CA_CONSECUTIVO, $row[0] );
			$cotizacion = CotizacionPeer::doSelectOne( $c );
			echo (++$i);
			//if( !$cotizacion->getCaFchpresentacion() ){
				if( trim($row[2]) ){
					echo " ".$row[0]." -".$row[2];				
					$cotizacion->setCaFchpresentacion($row[2]);
					$cotizacion->save();
				}
			/*}else{
				echo "fchpresentacion  ".$row[0]." ".$cotizacion->getCaFchpresentacion()." ".$row[2]; 
			}*/
			
			echo "<br />";
		
		}
		return sfView::NONE;
	}
	
	
	/*
	* Busca las cargas que estan abiertas que ya se les habian hecho confirmacion de llegada. 
	*/
	public function executeFixCargasEntregadas(){
		$c = new Criteria();
		$c->add( ReportePeer::CA_IMPOEXPO, "Importaci�n");
		$c->add( ReportePeer::CA_TRANSPORTE, "Mar�timo");		
		$c->add( ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada", Criteria::NOT_EQUAL);	
		$c->addAnd( ReportePeer::CA_ETAPA_ACTUAL, "", Criteria::NOT_EQUAL);	
		$c->addAnd( ReportePeer::CA_ETAPA_ACTUAL, null, Criteria::ISNOTNULL);
		$c->setLimit( 100 );		
		$reportes = ReportePeer::doSelect( $c );
				
		foreach( $reportes as $reporte ){
			if( $reporte->esUltimaVersion() ){ 
				echo $reporte->getCaConsecutivo()." ".$reporte->getCaEtapaActual()."<br />";
			}
		}
				
		return sfView::NONE;
	}
	
	
	public function executeFixEtapasTracking(){
		set_time_limit(0);
		$c = new Criteria();
		//$c->setLimit(2000);
		$c->add( RepStatusPeer::CA_IDETAPA, null, Criteria::ISNULL );
		$statusList = RepStatusPeer::doSelect( $c );
		
		$c = new Criteria();
		$etapasObj = TrackingEtapaPeer::doSelect( $c );
		
		$etapas = array();
				
		foreach( $etapasObj as $etapa){
			$etapas[$etapa->getCaImpoExpo()][$etapa->getCaTransporte()][trim($etapa->getCaEtapa())] = $etapa->getCaIdetapa();
		}
			
		foreach( $statusList as $status ){
			$reporte = $status->getReporte();
			
			if( $reporte->getCaImpoexpo()=="Triangulaci�n" ){			 
				$reporte->setCaImpoexpo("Importaci�n");
			}
			if( $status->getEtapa()=="Carga Entregada" ){
				$idetapa = "99999";
				//print_r( $status );
			}elseif( $status->getEtapa()=="Orden Anulada" ){
				$idetapa = "00000";
			}else{			
				if( $reporte->getCaImpoexpo()=="Importaci�n" ){
					$idetapa = $etapas[$reporte->getCaImpoexpo()][$reporte->getCaTransporte()][$status->getEtapa()]; 				
				}else{			
					$idetapa = $etapas[$reporte->getCaImpoexpo()][''][$status->getEtapa()]; 			
				}
			}			
			echo "###".$reporte->getCaConsecutivo()." ".$reporte->getCaImpoexpo()." ".$reporte->getCaTransporte()." ".$status->getEtapa()." ".$idetapa."<br />";		
			
			$status->setCaIdetapa( $idetapa );
			$status->save();
						
									
		}
			
	}
	
	/*
	Casos que paso olga lucia
	*/
	public function executeFixCasosTraficos(){
		sfConfig::set('sf_web_debug', false) ;	
		set_time_limit(0);
		$path = "d:\\cierres.csv";
		$i = 0;
		$content = file_get_contents( $path ); 		
		$rows = explode( "\n", $content );
		echo "OK ";
		foreach($rows as $row  ){
			//$row = explode(";" ,$row);
			
			$c = new Criteria();
			$c->add( ReportePeer::CA_CONSECUTIVO, trim($row) );
			$c->addDescendingOrderByColumn( ReportePeer::CA_VERSION );
			$reporte = ReportePeer::doSelectOne( $c );
			//echo (++$i);
			//if( !$cotizacion->getCaFchpresentacion() ){
			if( $reporte ){
						
				//$reporte->setCaEtapaActual("Carga Entregada");
				$reporte->setCaEtapaActual("Carga en Aeropuerto de Destino");
				$reporte->save();
				echo "<br />OK: ".$row."<br />";		
			}else{
				echo "Failure: ".$row."<br />";
			}
			/*}else{
				echo "fchpresentacion  ".$row[0]." ".$cotizacion->getCaFchpresentacion()." ".$row[2]; 
			}*/
			
			echo "<br />";
		
		}
		return sfView::NONE;
	}
	
	
	public function executeFixCargaTransitoDestino(){
		$c = new Criteria();
		$c->add(ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada");
		$c->add(ReportePeer::CA_CONSECUTIVO,'%-2009', Criteria::LIKE );
		$c->add(ReportePeer::CA_IMPOEXPO, "Importaci�n");
		//$c->setLimit(500);
		$reportes = ReportePeer::doSelect( $c );
		set_time_limit(0);
		foreach( $reportes as $reporte ){
			$status = $reporte->getUltimoStatus();
			if( $status ){
				if( $status->getCaEtapa()=="Carga en Tr�nsito a Destino" ){
					echo $reporte->getCaConsecutivo()." ".$reporte->getCaTransporte()."<br />";	
				}
			}
		}
	}
	
	
	/*
	* Copia los permisos del sistema anterior al nuevo sistema.
	*/
	public function executeCopiarPermisos(){
		exit("detenido");
		$c = new Criteria();
		$c->add( UsuarioPeer::CA_IDSUCURSAL, "BOG", Criteria::NOT_EQUAL );
		$c->add( UsuarioPeer::CA_ACTIVO, true );
		$usuarios = UsuarioPeer::doSelect( $c );
		set_time_limit(0);
		foreach( $usuarios as $usuario ){
		
			if( $usuario->getCaRutinas() ){
				echo "<br /> ".$usuario->getCaLogin()."<br />";
				//print_r( $rutinasStr );
				$rutinasArr = explode("|", $usuario->getCaRutinas() ); 	
				$c = new Criteria();
				$c->add( RutinaOldPeer::CA_RUTINA, $rutinasArr, Criteria::IN  );	
				$rutinas = RutinaOldPeer::doSelect( $c );
				if( $usuario->getCaDepartamento()!="Comercial"  && $usuario->getCaDepartamento()!="Servicio al Cliente"){
				
					$permisosArr = array(39, 38 );
					
					
					foreach( $permisosArr as $per ){
					
						$permiso =AccesoUsuarioPeer:: retrieveByPk( $per, $usuario->getCaLogin() );
							
						if( !$permiso ){
							$permiso = new AccesoUsuario();	
							$permiso->setCaLogin( $usuario->getCaLogin() );
							$permiso->setCaRutina( $per );							
							$permiso->setCaAcceso( 0 );		
							$permiso->save();						
						}
					}
				}
				/*
				foreach( $rutinas as $rutina ){
					$c = new Criteria();
					$c->add( RutinaPeer::CA_GRUPO, $rutina->getCaGrupo() );
					$c->add( RutinaPeer::CA_OPCION, $rutina->getCaOpcion() );
					$rutinasNewsObj = RutinaPeer::doSelect( $c );
					
					foreach( $rutinasNewsObj as $rutinaNew ){
						$permiso =AccesoUsuarioPeer:: retrieveByPk( $rutinaNew->getCaRutina(), $usuario->getCaLogin() );
						
						if( !$permiso ){
							$permiso = new AccesoUsuario();	
							$permiso->setCaLogin( $usuario->getCaLogin() );
							$permiso->setCaRutina( $rutinaNew->getCaRutina() );							
							$permiso->setCaAcceso( 0 );		
							$permiso->save();						
						}
					}
					
					
					
				}*/
				
			}
		}				
	}	
	
	
	/*
	* Copia los permisos del sistema anterior al nuevo sistema.
	*/
	public function executeFixPermisosMaestraClientesVentas(){
		exit("exit");
		$c = new Criteria();
		$c->add( UsuarioPeer::CA_IDSUCURSAL, "BOG", Criteria::NOT_EQUAL );
		$c->add( UsuarioPeer::CA_ACTIVO, true );
		$usuarios = UsuarioPeer::doSelect( $c );
		
		foreach( $usuarios as $usuario ){
			//echo $usuario->getCaDepartamento();
			if( $usuario->getCaDepartamento()=="Mar�timo"){
				$acceso = UsuarioGrupoPeer::retrieveByPk($usuario->getCaLogin(), "maritimo"	);
				/*
				$c = new Criteria();
				$c->add( AccesoUsuarioPeer::CA_LOGIN, $usuario->getCaLogin() );
				$c->add( AccesoUsuarioPeer::CA_ACCESO, 0 );
				$accesosUsuarios = AccesoUsuarioPeer::doSelect( $c );
				foreach( $accesosUsuarios as $accesosUsuario ){
					$accesosUsuario->delete();
				}*/
				
				//print_r( $accesosUsuario );
				
				if(!$acceso	){										
					echo $usuario->getCaLogin()."<br />";
										
					$acceso = new UsuarioGrupo();
					$acceso->setCaLogin($usuario->getCaLogin());
					$acceso->setCaGrupo("maritimo");
					$acceso->save();
				}
			}
		}	
		
		return sfView::NONE;			
	}	
	
	/******************************************************************
	*
	*  Estos procedimientos se usan para estandarizar el proceso del tracking
	*
	******************************************************************/
	/*
	* Aplica la plantilla de la etapa al status
	*/
	public function executeAplicarPlantilla(){
		exit();
		$c = new Criteria();
		//$c->add( RepStatusPeer::CA_STATUS, null, Criteria::ISNULL );
		$c->add( RepStatusPeer::CA_USUENVIO, 'ajsanchez' );		
		$statusList = RepStatusPeer::doSelect( $c );		
		
		foreach( $statusList as $status ){
			/*
			echo $status->getCaIdStatus()." -->".$status->getTxtStatus();
			echo "<br />--------<br />";
			echo "->".$status->getCaStatus();
			echo "<br /><br />";*/
			
			$resultado = $status->getTxtStatus();
			
			if( $status->getCaStatus() ){
				$resultado .= "\n".$status->getCaStatus();
			}
			echo $status->getCaIdStatus()." -->".$status->getCaStatus(  );
			echo "<br /><br />";
			if( $resultado ){
				$status->setCaStatus( $resultado );
				//$status->save();
			}
		}		
	}
	
	
	
	/*
	*  Este procedimiento crea un status para cada confirmacion de llegada
	* Ejecutado el 7 mayo a las 7:48PM ( CA_FCHCONFIRMADO 2009-01-01 - 2009-04-15 ) se crearon los status  125229 - 128323
	* Ejecutado 11 May a las 12:12 2009-04-16  ( CA_FCHCONFIRMADO 2009-04-16 - ... ) se crearon los status  128791 - 129545
	* Se borraron todos los status 	12 mayo 11:13
	* se crean todos x CrearStatusMaritimo
	*/
	public function executeCrearStatusConfirmaciones(){
		exit("detenido");
		set_time_limit( 0 );
		$c = new Criteria(); //CaFchconfirmado
		//$c->addJoin(  InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA );
		
		$c->add( InoMaestraSeaPeer::CA_FCHCONFIRMADO, '2009-04-16',  Criteria::GREATER_EQUAL);	
		//$c->addAnd( InoMaestraSeaPeer::CA_FCHCONFIRMADO, '2009-04-15', Criteria::LESS_EQUAL );
		$c->add( InoMaestraSeaPeer::CA_REFERENCIA, '4%', Criteria::LIKE);
		$c->addOr( InoMaestraSeaPeer::CA_REFERENCIA, '5%', Criteria::LIKE);
		//$c->setLimit( 100 );
		$c->addAscendingOrderByColumn( InoMaestraSeaPeer::CA_FCHCONFIRMADO );
		$referencias = InoMaestraSeaPeer::doSelect( $c );
		$file="d:\\logCrearStatusConfirmaciones.txt";
		$fp = fopen ($file, 'w+'); 
		foreach( $referencias as $referencia ){
			if( $referencia->getCaFchconfirmado( ) ){	
				$inoClientes = $referencia->getInoClientesSeas();
				$i = 0;
				foreach( $inoClientes as $inoCliente ){
					$reporte = $inoCliente->getReporte();
					
					echo "<br />".$referencia->getCaReferencia()." ";
					
					if( $reporte ){
						$status = new RepStatus();
						$status->setCaIdetapa("IMCOL");
						$status->setCaIdReporte( $reporte->getCaIdreporte() );
												
						$texto = "La MN ".($referencia->getCaMnLlegada(  ) ?$referencia->getCaMnLlegada(  ):$referencia->getCaMotonave())." arrib� a ".$referencia->getDestino()->getCaCiudad().", el dia ".Utils::fechaMes( $referencia->getCaFchconfirmacion() )." con la orden en referencia a bordo.\n". ucfirst($inoCliente->getCamensaje());
						
						echo "<br /> $i ".$texto;
						
						$status->setCaStatus( $texto );	
												
						$ultimostatus = $reporte->getUltimoStatus( );	
						if( $ultimostatus ){					
							$status->setCaPiezas( $ultimostatus->getCaPiezas() );
							$status->setCaPeso( $ultimostatus->getCaPeso() );
							$status->setCaVolumen( $ultimostatus->getCaVolumen() );
							$status->setCaFchsalida( $ultimostatus->getCaFchsalida() );
							$status->setCaFchcontinuacion( $ultimostatus->getCaFchcontinuacion() );
						}
						$status->setCaIdnave( ($referencia->getCaMnLlegada(  ) ?$referencia->getCaMnLlegada(  ):$referencia->getCaMotonave()) );
						
						$status->setCaFchllegada( $referencia->getCaFchconfirmacion() );
						
						$status->setCaFchenvio( $referencia->getCaFchconfirmado() );
						$status->setCausuenvio( $referencia->getCaUsuconfirmado() );
						$status->setCaFchStatus( $referencia->getCaFchconfirmado() );
						//$status->save();
						fwrite($fp, $referencia->getCaReferencia()."\r\n");
					}
				}
			}			
		}
		fclose ($fp); 		
	}
	
	/*
	*  Este procedimiento crea un status para cada confirmaci�n de maritimo. 
    * Ejecutado 11 May a las 12:19   ( CA_FCHENVIO, '2009-01-01' - ... ) se crearon los status  129549 - 133400
	* se borraron 129549 - 133400 12 mayo 11:13
	* Ejecutado 12 May a las 11:15AM   ( CA_FCHENVIO, '2009-01-01' - 2009-01-31) se crearon los status    133740 - 135577 -   excepto {134440, 133880}
	
	* Ejecutado 12 May a las 11:38AM   ( CA_FCHENVIO, '2009-02-01' - 2009-03-31) se crearon los status    135581 - 138741  excepto {138459, 136664, 136131 }   total 3154
	* Ejecutado 12 May a las 11:57AM   ( CA_FCHENVIO, '2009-04-01' - 2009-04-30) se crearon los status   138747  - 140472  excepto {140240, 139951, 138990, 138928 }   
	* Ejecutado 12 May a las 12:01PM   ( CA_FCHENVIO, '2009-05-01' - ...) se crearon los status   140479  - 141011  excepto { }   
	*/
	public function executeCrearStatusMaritimo(){
		exit("detenido");
		set_time_limit( 0 );
		$c = new Criteria(); //CaFchconfirmado
		//$c->addJoin(  InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA );
		
		$c->add( InoAvisosSeaPeer::CA_FCHENVIO, '2009-05-01',  Criteria::GREATER_EQUAL);	
		//$c->addAnd( InoAvisosSeaPeer::CA_FCHENVIO, '2009-04-30', Criteria::LESS_EQUAL );
		
		//$c->add( InoAvisosSeaPeer::CA_FCHENVIO, '2009-01-01',  Criteria::GREATER_EQUAL);	;
		
		/*$c->add( InoAvisosSeaPeer::CA_AVISO, '', Criteria::NOT_EQUAL );
		$c->addAnd( InoAvisosSeaPeer::CA_AVISO, '%Como requisito indispensable para efectuar el OTM necesitamos los siguientes documentos:%', Criteria::NOT_LIKE );
		*/
		
				
		//$c->setLimit( 100 );
		$c->addAscendingOrderByColumn( InoAvisosSeaPeer::CA_FCHENVIO );
		$avisos = InoAvisosSeaPeer::doSelect( $c );
		
		//echo "-----------> count avisos ".count( $avisos )." <-";
		$file="d:\\logCrearStatusMaritimo.txt";
		$fp = fopen ($file, 'w+'); 
		$i=0;
		foreach( $avisos as $aviso ){
			$inoCliente = $aviso->getInoClientesSea();
			if( $inoCliente ){	
				$reporte = $inoCliente->getReporte();
				$referencia = $inoCliente->getInoMaestraSea();
				if( $reporte ){																
					$texto = $aviso->getCaAviso();
					$email = $aviso->getEmail();
					if( $email && strpos($email->getCaSubject(), "Confirmaci�n de Llegada")!==false ){
						$texto = "La MN ".($referencia->getCaMnLlegada(  ) ?$referencia->getCaMnLlegada(  ):$referencia->getCaMotonave())." arrib� a ".$referencia->getDestino()->getCaCiudad().", el dia ".Utils::fechaMes( $referencia->getCaFchconfirmacion() )." con la orden en referencia a bordo.\n". ucfirst($inoCliente->getCamensaje());
												
						$idetapa = "IMCOL";
					}else{						
						if( strpos($texto, "Confirmamos cierre y finalizaci�n de los documentos del proceso de OTM")!==false ){
							$idetapa = "99999";
						}elseif( strpos($texto, "Confirmamos el cargue y despacho de la")!==false){
							$idetapa = "IMCMP";							
						}elseif( strpos($texto, "Informamos que los documentos correspondientes al tr�mite OTM")!==false){
							$idetapa = "IMPOD";								
						}else{
							$idetapa = "88888";
						}						
					}
										
					if( strlen($texto )>3){	
						echo "<br />  ".($i++)." ".$idetapa." ".$texto;
						$status = new RepStatus();						
						$status->setCaIdetapa($idetapa);
						$status->setCaIdReporte( $reporte->getCaIdreporte() );
						$status->setCaStatus( $texto );	
												
						$ultimostatus = $reporte->getUltimoStatus( );	
						if( $ultimostatus ){					
							$status->setCaPiezas( $ultimostatus->getCaPiezas() );
							$status->setCaPeso( $ultimostatus->getCaPeso() );
							$status->setCaVolumen( $ultimostatus->getCaVolumen() );
							$status->setCaFchsalida( $ultimostatus->getCaFchsalida() );
							$status->setCaFchcontinuacion( $ultimostatus->getCaFchcontinuacion() );
							if( $idetapa=="IMCOL" ){
								$status->setCaIdnave( ($referencia->getCaMnLlegada(  ) ?$referencia->getCaMnLlegada(  ):$referencia->getCaMotonave()) );
								$status->setCaFchllegada( $referencia->getCaFchconfirmacion() );
						
						
							}else{							
								$status->setCaIdnave( $ultimostatus->getCaIdnave() );						
								$status->setCaFchllegada( $ultimostatus->getCaFchllegada() );						
							}
						}
						
						$status->setCaIdemail( $aviso->getCaIdemail() );
						$status->setCaFchenvio( $aviso->getCaFchenvio() );
						$status->setCausuenvio( $aviso->getCaUsuenvio() );
						$status->setCaFchStatus( $aviso->getCaFchaviso() );
						$status->save();
						fwrite($fp, $aviso->getCaReferencia()." ".$status->getCaIdstatus()."\r\n");
					}						
				}
			}
		}
		fclose ($fp); 
	}
	
	/*
	*  Este procedimiento crea un status de cierre en cada uno de los reportes que ya 
	*  se confirmaron
	*/
	public function executeActFchStatus(){
		set_time_limit(0);
		exit();
		$c = new Criteria();
		$c->addJoin( ReportePeer::CA_IDREPORTE, RepStatusPeer::CA_IDREPORTE );
		$c->add( RepStatusPeer::CA_FCHENVIO, '2009-05-01', Criteria::GREATER_EQUAL );
		$c->addHaving( $c->getNewCriterion(RepStatusPeer::CA_FCHENVIO, RepStatusPeer::CA_FCHENVIO.'=max('.RepStatusPeer::CA_FCHENVIO.')', Criteria::CUSTOM ) );
				
		$c->addGroupByColumn(RepStatusPeer::CA_IDSTATUS);
		$c->addGroupByColumn(RepStatusPeer::CA_IDREPORTE);
		$c->addGroupByColumn(RepStatusPeer::CA_IDEMAIL);
		$c->addGroupByColumn(RepStatusPeer::CA_FCHSTATUS);
		$c->addGroupByColumn(RepStatusPeer::CA_STATUS);
		$c->addGroupByColumn(RepStatusPeer::CA_COMENTARIOS);
		$c->addGroupByColumn(RepStatusPeer::CA_ETAPA);
		$c->addGroupByColumn(RepStatusPeer::CA_FCHRECIBO);
		$c->addGroupByColumn(RepStatusPeer::CA_FCHENVIO);
		$c->addGroupByColumn(RepStatusPeer::CA_USUENVIO);
		$c->addGroupByColumn(RepStatusPeer::CA_INTRODUCCION);
		$c->addGroupByColumn(RepStatusPeer::CA_FCHSALIDA);
		$c->addGroupByColumn(RepStatusPeer::CA_FCHLLEGADA);
		$c->addGroupByColumn(RepStatusPeer::CA_FCHCONTINUACION);
		$c->addGroupByColumn(RepStatusPeer::CA_PIEZAS);
		$c->addGroupByColumn(RepStatusPeer::CA_PESO);
		$c->addGroupByColumn(RepStatusPeer::CA_VOLUMEN);
		$c->addGroupByColumn(RepStatusPeer::CA_DOCTRANSPORTE);
		$c->addGroupByColumn(RepStatusPeer::CA_DOCMASTER);
		$c->addGroupByColumn(RepStatusPeer::CA_IDNAVE);
		$c->addGroupByColumn(RepStatusPeer::CA_EQUIPOS);
		$c->addGroupByColumn(RepStatusPeer::CA_HORASALIDA);
		$c->addGroupByColumn(RepStatusPeer::CA_HORALLEGADA);
		$c->addGroupByColumn(RepStatusPeer::CA_IDETAPA);
		$c->addGroupByColumn(RepStatusPeer::CA_PROPIEDADES);
		$status = RepStatusPeer::doSelect( $c );
		
		foreach( $status as  $status ){
			$reporte = $status->getReporte();
			if( $status->getCaFchenvio() ){
				echo $reporte->getCaConsecutivo()." ult ".$reporte->getCaFchUltstatus()." ".$status->getCaFchenvio()."<br />";				
				$reporte->setCaFchUltstatus(  $status->getCaFchenvio() );
				$reporte->save();
			}						
		}						
	}
	
	
	/*
	*  coloca la etapa actual y la ultima actualizacion
	*/
	public function executeActualizarEtapa(){
		set_time_limit(0);
		$c = new Criteria();
		$c->add( ReportePeer::CA_IDETAPA , null, Criteria::ISNULL );
		$c->addAscendingOrderByColumn( ReportePeer::CA_IDREPORTE );
		//$c->setLimit(1000);
		$reportes = ReportePeer::doSelect( $c );
		foreach( $reportes as $reporte ){							
			if( $reporte->esUltimaVersion()  ){
				$ultimoStatus = $reporte->getUltimoStatus();		
				
				if( $ultimoStatus ){
					if( $reporte->getCaEtapaActual()=="Carga Entregada"){
						$reporte->setCaIdetapa( "99999" );
					}else{			
						$reporte->setCaIdetapa( $ultimoStatus->getCaIdetapa() );
					}
					$reporte->setCaFchultstatus( $ultimoStatus->getCaFchenvio() );
					$reporte->save();
				}else{
					if( $reporte->getCaEtapaActual()=="Carga Entregada" || $reporte->getCaEtapaActual()=="Carga en Aeropuerto de Destino" ){
						$reporte->setCaIdetapa( "99999" );
					}
					
					if( $reporte->getCaEtapaActual()=="Contacto con nuestro Agente" && 
						$reporte->getCaTransporte()=="A�reo" ){
						$reporte->setCaIdetapa( "IACAG" );
					}		
					
					if( $reporte->getCaEtapaActual()=="Contacto con nuestro Agente" && 
						$reporte->getCaTransporte()=="Mar�timo" ){
						$reporte->setCaIdetapa( "IMCAG" );
					}	
					$reporte->save();				
				}
								
				if( !$reporte->getCaUsuanulado()){
					echo $reporte->getcaConsecutivo()." ".$reporte->getCaIdetapa()." ".$reporte->getCaEtapaActual()."<br />";
				}
			}
		}
	}
	
	/******************************************************************
	*
	*  Crea sentencias SQL Para crear foreign key en todos los 
	*  campos usucreado usuactualizado
	*
	******************************************************************/
	public function executeCrearFKUsuarios(){
		$sql = "SELECT * FROM information_schema.columns 
where (column_name like 'ca_login%' ) and table_name like 'tb_%' and table_schema = 'public'";
		
		$con = Propel::getConnection(TasaAlaicoPeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()){
		
			$sql = "ALTER TABLE ".$row['table_name']."
  ADD CONSTRAINT fk_".$row['table_name']."_tbusuarios_".$row['column_name']." FOREIGN KEY (".$row['column_name'].")
      REFERENCES control.tb_usuarios (ca_login) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;";
			echo $sql."<br />";
		} 
		
		return sfView::NONE;
	}
	
	/*
	* Unifica dos opciones del programa en una sola y copia los permisos de la anterior en la nueva.
	*/
	public function executeUnificarPermisos(){
		
		$c = new Criteria();
		$c->addJoin( UsuarioPeer::CA_LOGIN, AccesoUsuarioPeer::CA_LOGIN );
		$c->addJoin( AccesoUsuarioPeer::CA_RUTINA, 40 );
		$usuarios = UsuarioPeer::doSelect( $c );
		
		foreach( $usuarios as $usuario ){
			$permiso =AccesoUsuarioPeer:: retrieveByPk( 43, $usuario->getCaLogin() );
										
			if( !$permiso ){
				$permiso = new AccesoUsuario();	
				$permiso->setCaLogin( $usuario->getCaLogin() );
				$permiso->setCaRutina( 43 );							
				$permiso->setCaAcceso( 0 );		
				echo $usuario->getCaLogin() ."<br />";
				$permiso->save();						
			}		
		}
		
		return sfView::NONE;
		
				
	}
	
	
	/*
	* Crea una tarea para cada ticket. 	
	*/
	public function executeAsignarTareaHelpdesk( $request ){
		exit();
		set_time_limit( 0 );
		$c = new Criteria();
		$c->add( HdeskTicketPeer::CA_IDTAREA, null, Criteria::ISNULL );
		$c->addAscendingOrderByColumn( HdeskTicketPeer::CA_IDTICKET );
		$tickets = HdeskTicketPeer::doSelect( $c );
		
		foreach( $tickets as $ticket ){
			
			$request->setParameter("id", $ticket->getCaIdticket() );
			$request->setParameter("format", "email" );
			$titulo = "Nuevo Ticket #".$ticket->getCaIdticket()." [".$ticket->getCaTitle()."]";		
				
			$texto = "Se ha creado un nuevo ticket \n\n<br /><br />" ;			
			$texto.= sfContext::getInstance()->getController()->getPresentationFor( 'helpdesk', 'verTicket');
			
			$grupo = $ticket->getHdeskGroup();
			
			$tarea = new NotTarea(); 
			$tarea->setCaUrl( "/helpdesk/verTicket?id=".$ticket->getCaIdticket() );
			$tarea->setCaIdlistatarea( 1 );
			$tarea->setCaFchcreado( $ticket->getCaOpened() );						
			$tarea->setCaFchvencimiento( strtotime( $ticket->getCaOpened() )+$grupo->getCaMaxresponsetime() );
			
			
			if( $ticket->getCaResponsetime() ){
				$tarea->setCaFchterminada( $ticket->getCaResponsetime() );
			}
			
			
			$tarea->setCaUsucreado( $ticket->getCaLogin() );
			$tarea->setCaTitulo( $titulo );		
			$tarea->setCaTexto( $texto );
			$tarea->save();
			
			$ticket->setCaIdtarea( $tarea->getCaIdtarea() );
			$ticket->save();
			
			if( $ticket->getCaAssignedTo() ){
				$tarea->setAsignaciones( array( $ticket->getCaAssignedTo() ) );		
			}else{
				$loginsAsignaciones = $ticket->getLoginsGroup();					
				$tarea->setAsignaciones( $loginsAsignaciones );	
			}
		}
		$this->setTemplate("blank");
		
		/**/
	}
	
	/*
	* Tareas de backup que ya se cumplieron
	*/
	public function executeQuitarTareasSrThomas(){
		
		exit();
		$c = new Criteria();
		$c->addJoin(NotTareaAsignacionPeer::CA_IDTAREA,  NotTareaPeer::CA_IDTAREA );
		$c->add( NotTareaAsignacionPeer::CA_LOGIN, 'tpeters' );
		$c->add( NotTareaPeer::CA_FCHTERMINADA, NULL , Criteria::ISNULL);
		$c->setDistinct();
		$tareas = NotTareaPeer::doSelect( $c );
		
		foreach( $tareas as $tarea ){
			echo $tarea->getCaIdtarea()."<br />";
			$tarea->setCaFchterminada( $tarea->getCaFchvencimiento() );
			$tarea->save();
		}		
		$this->setTemplate("blank");
	} 
	
	/*
	*
	*/	
	public function executeCrearTareasCotizaciones1erTrimestre(){
		exit();
		set_time_limit( 0 );
		$c = new Criteria();
		$c->add( CotizacionPeer::CA_CONSECUTIVO, '%2009', Criteria::LIKE );
		$c->add( CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, null, Criteria::ISNOTNULL);
		$c->add( CotizacionPeer::CA_USUANULADO, null, Criteria::ISNOTNULL);

		//$c->add( CotizacionPeer::CA_FCHCREADO, '2009-04-01', Criteria::GREATER_EQUAL );	
		
		$c->addAscendingOrderByColumn( CotizacionPeer::CA_IDCOTIZACION );				
		$cotizaciones = CotizacionPeer::doSelect( $c );
				
		foreach( $cotizaciones as $cotizacion ){	
			echo $cotizacion->getCaConsecutivo()."<br />";
			$tarea = $cotizacion->getTareaIDGEnvioOportuno( );	
			$tarea->delete();	
			/*if( $cotizacion->getCafchSolicitud() ){
				$fchCreado = $cotizacion->getCafchSolicitud()." ".$cotizacion->getCaHoraSolicitud();
			}else{
				$fchCreado = $cotizacion->getCaFchcreado( );
			}
			$tarea = $cotizacion->crearTareaIDGEnvioOportuno( $fchCreado );	
			if( $tarea ){
				if( $cotizacion->getCaFchpresentacion( ) ){
					$tarea->setCaFchterminada( $cotizacion->getCaFchpresentacion() );					
				}
				//else{
				//	$tarea->setCaFchterminada( $tarea->getCaFchvencimiento() );
				//}
				$tarea->save();
			} 	*/		
		}	
		
		$this->setTemplate("blank");
						
	}
		
}



?>

