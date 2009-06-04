<?php

/**
 * traficos actions.
 *
 * @package    colsys
 * @subpackage traficos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class traficosActions extends sfActions
{
	/**
	 * Redirige a la opcion
	 * author: Andres Botero
	 */
	public function executeIndex()
	{
		$this->forward( "traficos", "seleccionCliente" );
	}


	/*
	 * Muestra un formulario para seleccionar un rango de fechas y el cliente
	 * author: Andres Botero
	 */
	public function executeSeleccionCliente(){
		$this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );
	}

	/*
	 * permite ver el estado de cada  carga asi como las notificaciones avisos, status etc
	 * author: Andres Botero
	 */
	public function executeVerEstatusCarga(){
		$idCliente = $this->getRequestParameter("idcliente");
		$this->idCliente = $idCliente;
		
		$this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );
		$this->forward404unless( $this->idCliente );	
		$this->fechaInicial = $this->getRequestParameter("fechaInicial");
		$this->fechaFinal = $this->getRequestParameter("fechaFinal");
		$ver = $this->getRequestParameter("ver");
		$this->cliente = ClientePeer::retrieveByPk( $idCliente );
		
		switch( $ver ){
			case "activos":		
				$this->reportes = ReportePeer::getReportesActivos( $this->modo ,  $this->idCliente );
				break;
			case "fecha";
				
				$this->reportes = ReportePeer::getReportesByDate( $this->modo , $this->fechaInicial, $this->fechaFinal,  $this->idCliente );
				break;
			default:
				$this->reportes = array();
				break;			
		}	
		
					
	}

	/*
	 * Muestra el estado del reporte cuando un usuario hace click sobre el
	 * @author: Andres Botero
	 */
	public function executeInfoReporte(){
		$reporteId = $this->getRequestParameter("reporteId");
		$this->reporte = ReportePeer::retrieveByPk( $reporteId );
		$this->forward404Unless( $this->reporte );
	}


	/*
	 * Muestra un formario para agregar un nuevo status u aviso a un reporte
	 * @author: Andres Botero
	 */
	public function executeNuevoMensaje(){

		$this->tipo = $this->getRequestParameter("tipo"); //aviso status
		$this->forward404Unless( $this->tipo );
		$reporteId = $this->getRequestParameter("reporteId");
		$this->reporte = ReportePeer::retrieveByPk( $reporteId );
		$this->forward404Unless( $this->reporte );

		
		$this->etapas = ParametroPeer::retrieveByCaso( "CU045" , null, "%".$this->reporte->getCaImpoExpo()."%");
		$this->tipos = ParametroPeer::retrieveByCaso( "CU054", null, "%".$this->reporte->getCaImpoExpo()."%" );

		
		if( $this->reporte->getCaIdAgente() ){
			$c = new Criteria();
			$c->add( ContactoAgentePeer::CA_IDAGENTE , $this->reporte->getCaIdAgente() );
			$c->add( ContactoAgentePeer::CA_IMPOEXPO , $this->reporte->getCaImpoexpo() );
			$c->add( ContactoAgentePeer::CA_TRANSPORTE , $this->reporte->getCaTransporte() );
			$c->addAscendingOrderByColumn( ContactoAgentePeer::CA_NOMBRE );
			$this->contactosAg = ContactoAgentePeer::doSelect( $c );
		}
		$this->user = $this->getuser();
		$this->user->clearFiles();
		
		if( $this->reporte->getCaModalidad()=="FCL" ){
			$c = new Criteria();
			$c->add(ConceptoPeer::CA_MODALIDAD, "FCL" );
			$this->equipos = ConceptoPeer::doSelect( $c );
		}

		//Busca los archivos del reporte
		$this->files=$this->reporte->getFiles();
				
		$this->tipo_piezas = ParametroPeer::retrieveByCaso( "CU047" );	
		$this->tipo_pesos = ParametroPeer::retrieveByCaso( "CU049" );			
		$this->tipo_volumen = ParametroPeer::retrieveByCaso( "CU050" );	
		
		$this->user = $this->getUser();
	}

	/*
	 * Retoma el error producido en NuevoMensajeSubmit
	 * @author: Andres Botero
	 */
	public function handleErrorNuevoMensajeSubmit(){
		$this->forward("traficos", "nuevoMensaje");
	}

	/*
	 * Guarda el mensaje y actualiza el estatus
	 * @author: Andres Botero
	 */
	public function executeNuevoMensajeSubmit(){
		$this->reporteId = $this->getRequestParameter("reporteId");
		$reporte = ReportePeer::retrieveByPk( $this->reporteId );
		$this->forward404Unless( $reporte );
	

		$user = $this->getUser();
		
		/*
		* Validaciones
		*/
		
		
		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		if( $this->getRequestParameter("etapa")=="Carga Embarcada" ){

			$email->setCaTipo( "Envío de Avisos" ); 
		}		
		else{
			$email->setCaTipo( "Envío de Status" ); 	
		}
		$email->setCaIdcaso( $this->reporteId );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );
		
		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
		}

		$email->setCaReplyto( $user->getEmail() );
				
		$recips = $this->getRequestParameter("destinatarios");									
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addTo( $recip ); 
				}
			}	
		}
				
		$recips =  $this->getRequestParameter("cc") ;
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addCc( $recip ); 
				}
			}
		}
				
		$email->addCc( $this->getUser()->getEmail() );
					
		$email->setCaSubject( $this->getRequestParameter("asunto") );
		$attachments = $this->getRequestParameter( "attachments" );
		if( $attachments ){
			foreach( $attachments as $attachment){
				$email->AddAttachment( base64_decode( $attachment ) );
			}
		}
		
		$email->setCaBody("-");		
		$email->save(); 		
			
		
		$status = new RepStatus();
		$status->setCaIdReporte( $this->reporteId );
		$status->setCaFchStatus( date("Y-m-d H:i:s") );
		$status->setCaIntroduccion( $this->getRequestParameter("introduccion") );
		$status->setCaIdEmail( $email->getCaIdemail() );
		$status->setCaStatus( $this->getRequestParameter("mensaje") );
		$status->setCaComentarios( '-' );
		$status->setCaEtapa( $this->getRequestParameter("etapa") );
		$status->setCaFchrecibo( $this->getRequestParameter("fchrecibo")." ".$this->getRequestParameter("horarecibo") );
		$status->setCaFchenvio( date("Y-m-d H:i:s") );
		$status->setCausuenvio( $user->getUserId() );
		
		
		$this->getRequest()->setParameter("id", $reporte->getCaIdreporte());
		$this->getRequest()->setParameter("emailid", $email->getCaIdemail());	
				
		if( $this->getRequestParameter("etapa")=="Carga con Reserva" ){
			
			/*
			if( $this->getRequestParameter("fchreserva") && $this->getRequestParameter("etapa")=="Carga con Reserva"  ){
				$status->setCaFchreserva( $this->getRequestParameter("fchreserva") );
			}
			
			if( $this->getRequestParameter("fchcierrereserva") && $this->getRequestParameter("etapa")=="Carga con Reserva"  ){
				$status->setCaFchcierrereserva( $this->getRequestParameter("fchcierrereserva") );
			}*/
		}
			
		$piezas = $this->getRequestParameter("piezas")."|".$this->getRequestParameter("tipo_piezas");
		$peso = $this->getRequestParameter("peso")."|".$this->getRequestParameter("tipo_peso");
		$volumen = $this->getRequestParameter("volumen")."|".$this->getRequestParameter("tipo_volumen");
		
		if($this->getRequestParameter("piezas")){
			$status->setCaPiezas( $piezas );
		}
		
		if($this->getRequestParameter("peso")){
			$status->setCaPeso( $peso );
		}
		if($this->getRequestParameter("volumen")){
			$status->setCaVolumen( $volumen );
		}	
		
		if( $this->getRequestParameter("doctransporte") ){
			$status->setCaDoctransporte( $this->getRequestParameter("doctransporte") );
		}
		
		if( $this->getRequestParameter("docmaster") ){
			$status->setCaDocmaster( $this->getRequestParameter("docmaster") );
		}
		
		if( $this->getRequestParameter("idnave") ){
			$status->setCaIdnave( $this->getRequestParameter("idnave") );
		}
		
		if( $this->getRequestParameter("fchsalida") ){
			$status->setCaFchsalida( $this->getRequestParameter("fchsalida") );
		}
		if( $this->getRequestParameter("fchllegada") ){
			$status->setCaFchllegada( $this->getRequestParameter("fchllegada") );
		}
		if( $this->getRequestParameter("horallegada") ){
			$status->setCaHorasalida( $this->getRequestParameter("horallegada") );
		}
		
		if( $this->getRequestParameter("fchcontinuacion") && $reporte->getCaContinuacion()!="N/A" ){
			$status->setCaFchcontinuacion( $this->getRequestParameter("fchcontinuacion") );
		}
		
		
		
		$equipos = $this->getRequestParameter("equipos");	
		if( $equipos ){
			$equiposHtml="<table>";
			foreach( $equipos as $equipo ){
				if( $equipo['cant']!=0 ){
					$equiposHtml .= "<tr>";
					$equiposHtml.= " <td>".$equipo['tipo']."</td>";
					if( $reporte->getcaImpoExpo()=="Exportación" ){
						$equiposHtml.= " <td>".$equipo['serial']."</td>";
					}
					$equiposHtml.= " <td>".$equipo['cant']."</td>";
					$equiposHtml.= "</tr>";
				}
			}
			$equiposHtml.="</table>";
		}else{
			$equiposHtml="";
		}
		$status->setCaEquipos( $equiposHtml  );
		
		$reporte->save();
		
		if( $reporte->getCaImpoExpo()=="Exportación" ){ 	
			$repExpo = $reporte->getRepexpo();		
			if( $this->getRequestParameter("datosbl") ){
				$repExpo->setCaDatosBl( $this->getRequestParameter("datosbl") );
			}	
			$repExpo->save();	
		}			
					
		$status->save();
		
		
		$email->setCaBody(  sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'verStatus') );
		
				
		
				
		
		/*
		if( $this->tipo=="status" ){
			//Crea un nuevo aviso o estatus
			
		}

		if( $this->tipo=="aviso" ){
			$equipos = $this->getRequestParameter("equipos");	
			if( $equipos ){
				$equiposHtml="<table>";
				foreach( $equipos as $equipo ){
					if( $equipo['cant']!=0 ){
						$equiposHtml .= "<tr>";
						$equiposHtml.= " <td>".$equipo['tipo']."</td>";
						if( $reporte->getcaImpoExpo()=="Exportación" ){
							$equiposHtml.= " <td>".$equipo['serial']."</td>";
						}
						$equiposHtml.= " <td>".$equipo['cant']."</td>";
						$equiposHtml.= "</tr>";
					}
				}
				$equiposHtml.="</table>";
			}else{
				$equiposHtml="";
			}
						
			$piezas = $this->getRequestParameter("piezas")."|".$this->getRequestParameter("tipo_piezas");
			$peso = $this->getRequestParameter("peso")."|".$this->getRequestParameter("tipo_peso");
			$volumen = $this->getRequestParameter("volumen")."|".$this->getRequestParameter("tipo_volumen");
				
			$aviso = new RepAviso();
			$aviso->setCaIdReporte( $this->reporteId );
			$aviso->setCaIdEmail( $email->getCaIdemail() );
			$aviso->setCaIntroduccion( $this->getRequestParameter("introduccion") );
			if( $this->getRequestParameter("fchsalida") ){
				$aviso->setCaFchsalida( $this->getRequestParameter("fchsalida") );
			}
			if( $this->getRequestParameter("fchllegada") ){
				$aviso->setCaFchllegada( $this->getRequestParameter("fchllegada") );
			}
			$aviso->setCaHorasalida( $this->getRequestParameter("horallegada") );
			if( $reporte->getCaContinuacion()!="N/A" ){
				$aviso->setCaFchcontinuacion( $this->getRequestParameter("fchcontinuacion") );
			}
			$aviso->setCaPiezas( $piezas );
			$aviso->setCaPeso( $peso );
			$aviso->setCaVolumen( $volumen );
			if( $this->getRequestParameter("doctransporte") ){
				$aviso->setCaDoctransporte( $this->getRequestParameter("doctransporte") );
			}else{
				$aviso->setCaDoctransporte( "''" );
			}
			$aviso->setCaDocmaster( $this->getRequestParameter("docmaster") );
			$aviso->setCaIdnave( $this->getRequestParameter("idnave") );
			$aviso->setCaNotas( $this->getRequestParameter("mensaje") );
			$aviso->setCaEquipos( $equiposHtml  );
			$aviso->setCaEtapa( $this->getRequestParameter("etapa") );
			$aviso->setCaTipo( $this->getRequestParameter("tipoaviso") );			
			$aviso->setCaFchenvio( date("Y-m-d") );
			$aviso->setCausuenvio( $user->getUserId() );
			$aviso->save();
			
			if( $reporte->getCaImpoExpo()=="Exportación" ){
				$repExpo = $reporte->getRepexpo();
				$repExpo->getCaPiezas( $piezas );
				$repExpo->getCaPeso( $peso );
				$repExpo->getCaVolumen( $volumen );
				if( $this->getRequestParameter("datosbl") ){
					$repExpo->setCaDatosBl( $this->getRequestParameter("datosbl") );
				}	
				$repExpo->save();			
			}
			
			$this->getRequest()->setParameter("id", $reporte->getCaIdreporte());
			$this->getRequest()->setParameter("emailid", $aviso->getCaIdemail());			
			$email->setCaBody(  sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'verAviso') );
		}
		*/
		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();	
		$reporte->setCaEtapaActual( $this->getRequestParameter("etapa") );
		$reporte->save();
		
		return sfView::SUCCESS;

	}


	/*
	 * Genera un cuadro de excel con la informacion de los reportes, tal como la ve el usuario
	 * en verEstatusCarga
	 * @author: Andres Botero
	 */
	public function executeInformeTraficos(){
		
		
		
		
		$formato = $this->getRequestParameter("formato");
		switch( $formato ){
			/*case 2:
				$this->forward("traficos", "informeTraficosFormato2");
				break;*/
			default:
				$this->forward("traficos", "informeTraficosFormato1");
				break;
		}
	}
	
	
	
	/*
	 * Permite generar un informe en excel donde se muestran los estados de la carga en un primer formato
	 * @author: Andres Botero
	 */
	public function executeInformeTraficosFormato1( $fileName=null ){
		
		
		$idCliente = $this->getRequestParameter("idcliente");

		$modo = $this->getRequestParameter("modo");
		$cliente = ClientePeer::retrieveByPk( $idCliente );
		$fechaInicial = $this->getRequestParameter("fechaInicial");
		$fechaFinal = $this->getRequestParameter("fechaFinal");
		$ver = $this->getRequestParameter("ver");
		
		$this->forward404Unless( $cliente );
		$this->forward404unless( $modo );
		
		
		switch( $ver ){
			case "activos":		
				$reportes = ReportePeer::getReportesActivos( $modo ,  $idCliente );
				break;
			case "fecha";
				
				$reportes = ReportePeer::getReportesByDate( $modo , $fechaInicial, $fechaFinal,  $idCliente );
				break;
			default:
				$this->reportes = array();
				break;			
		}	
		
		$this->setLayout("excel");
		
		

		@require 'Spreadsheet/Excel/Writer.php';
		error_reporting(E_ERROR ^ E_NOTICE);

		
		// Send HTTP headers to tell the browser what's coming
		if(!$fileName){
			$xls = new Spreadsheet_Excel_Writer();
			$xls->send("status".$idCliente.".xls");
		}else{			
			$xls = new Spreadsheet_Excel_Writer( $fileName );			
		}
			 
		
		// Add a worksheet to the file, returning an object to add data to
		$sheet = $xls->addWorksheet($idCliente);
			
		$i=8;
		
		// Create a format object
		$headFormat = $xls->addFormat();
		// Set the font family - Helvetica works for OpenOffice calc too...
		$headFormat->setFontFamily('Helvetica');
		// Set the text to bold
		$headFormat->setBold();
		// Set the text size
		$headFormat->setSize('12');
		// Set the text color
		$headFormat->setColor('black');
		// Set the bottom border width to "thick"
		// Set the color of the bottom border
		$headFormat->setBottomColor('black');
		$headFormat->setMerge();
		$sheet->write(0,5,"TRANSITO DE MERCANCIAS VIA MARITIMA ".$cliente->getCaCompania() ,$headFormat);
		$sheet->write(2,0,Utils::fechaMes(date("Y-m-d")) ,$headFormat);
		
		/*
		 Titulos
		 */
		// Create a format object
		$titleFormat = $xls->addFormat();
		// Set the font family - Helvetica works for OpenOffice calc too...
		$titleFormat->setFontFamily('Helvetica');
		// Set the text to bold
		$titleFormat->setBold();
		// Set the text size
		$titleFormat->setSize('8');
		// Set the text color
		$titleFormat->setColor('black');
		// Set the bottom border width to "thick"
		$titleFormat->setBorder( 1 );
		// Set the color of the bottom border
		$titleFormat->setBottomColor('black');
			
		$sheet->write(0,8,"CONVENCIONES",$titleFormat);

		
		//Convenciones

		
		//Sin novedad
		$format1 = $xls->addFormat();
		$format1->setFontFamily('Helvetica');
		$format1->setBorder( 1 );
		$format1->setSize('8');
		$format1->setColor('black');
		$format1->setAlign('justify');
		$format1->setVAlign("top");
		$sheet->write(1,8," ",$format1);
		$sheet->write(1,9,"Sin novedad",$format1);

		//Carga entregada //verde
		$format2 = $xls->addFormat();
		$format2->setFontFamily('Helvetica');
		$format2->setSize('8');
		$xls->setCustomColor(14, 223, 255, 255);
		$format2->setFgColor(14);
		$format2->setBorder( 1 );
		$format2->setAlign('justify');
		$format2->setVAlign("top");
		$sheet->write(2,8," ",$format2);
		$sheet->write(2,9,"Nuevo Status",$format1);


		//formato carga embarcada //azul
		$format3 = $xls->addFormat();
		$format3->setFontFamily('Helvetica');
		$format3->setSize('8');
		$xls->setCustomColor(15, 174, 215, 255);
		$format3->setFgColor(15);
		$format3->setBorder( 1 );
		$format3->setAlign('justify');
		$format3->setVAlign("top");
		$sheet->write(3,8," ",$format3);
		$sheet->write(3,9,"Carga embarcada",$format1);

		//Formato anulado //rosado
		$format4 = $xls->addFormat();
		$format4->setFontFamily('Helvetica');
		$format4->setSize('8');
		$xls->setCustomColor(16, 255, 232, 232);
		$format4->setFgColor(16);
		$format4->setBorder( 1 );
		$format4->setAlign('justify');
		$format4->setVAlign("top");
		$sheet->write(4,8," ",$format4);
		$sheet->write(4,9,"Anulado",$format1);

		//Formato pend instrucciones //amarillo
		$format5 = $xls->addFormat();
		$format5->setFontFamily('Helvetica');
		$format5->setSize('8');
		$xls->setCustomColor(17, 255, 255, 187);
		$format5->setFgColor(17);
		$format5->setBorder( 1 );
		$format5->setAlign('justify');
		$format5->setVAlign("top");
		$sheet->write(5,8," ",$format5);
		$sheet->write(5,9,"Pendiente por instrucciones",$format1);
		
		
		//Carga entregada //naranja
		$format6 = $xls->addFormat();
		$format6->setFontFamily('Helvetica');
		$format6->setSize('8');
		$xls->setCustomColor(18, 255, 204, 102);
		$format6->setFgColor(18);
		$format6->setBorder( 1 );
		$format6->setAlign('justify');
		$format6->setVAlign("top");
		$sheet->write(6,8," ",$format6);
		$sheet->write(6,9,"Carga entregada",$format1);
		
		
		
			
		// Set the alignment to the special merge value
		//$titleFormat->setAlign('merge');
		$sheet->write($i,0,"FECHA ACT STATUS",$titleFormat);
		$sheet->write($i,1,"FECHA INICIO NEGOCIACION",$titleFormat);
		$sheet->write($i,2,"ORIGEN",$titleFormat);
		$sheet->write($i,3,"DESTINO",$titleFormat);
		$sheet->write($i,4,"No DE PEDIDO",$titleFormat);
		$sheet->write($i,5,"PROVEEDOR",$titleFormat);
		$sheet->write($i,6,"CONSIGNEE",$titleFormat);
		$sheet->write($i,7,"INCOTERMS",$titleFormat);
		$sheet->write($i,8,"Estimado de salida",$titleFormat);
		$sheet->write($i,9,"ETA",$titleFormat);
		$sheet->write($i,10,"PIEZAS",$titleFormat);
		$sheet->write($i,11,"PESO",$titleFormat);
		$sheet->write($i,12,"VOLUMEN",$titleFormat);
		$sheet->write($i,13,"COL REF.",$titleFormat);
		$sheet->write($i,14,"HBL",$titleFormat);
		$sheet->write($i,15,"STATUS / ACCIONES A TOMAR",$titleFormat);
		$i++;

		// The row height
		$sheet->setRow(0,25);

		// Set the column width
		$sheet->setColumn(0,2,15);
		$sheet->setColumn(2,2,25);
		$sheet->setColumn(3,3,25);
		$sheet->setColumn(4,4,15);
		$sheet->setColumn(5,5,40);
		$sheet->setColumn(6,6,40);
		$sheet->setColumn(7,8,10);
		$sheet->setColumn(9,9,10);
		$sheet->setColumn(10,10,7);
		$sheet->setColumn(11,11,7);
		$sheet->setColumn(12,12,7);
		$sheet->setColumn(13,13,20);
		$sheet->setColumn(14,14,30);
		$sheet->setColumn(15,15,100);
		
		
		foreach( $reportes as $reporte ){
			if( !$reporte->esUltimaVersion() ){
				continue;
			}
				
			$color = $reporte->getColorStatus();
			switch( $color ){
				case "yellow": //Pendiente de Coordinación
					$rowFormat = $format5;
					break;
				case "blue": //Carga Embarcada
					$rowFormat = $format3;
					break;
				case "green": //"Nuevo status"
					$rowFormat = $format2;
					break;
				case "orange": //"Carga entregada"
					$rowFormat = $format6;
					break;
				default:
					/*if( $fecha==date("Y-m-d")){//nuevo status
						$rowFormat = $format2;
						}
						else{*/
					$rowFormat = $format1; //sin novedad
					//}
					break;
			}
			
			$sheet->write($i,0, $reporte->getUltimaActualizacion(),$rowFormat);
			
			$sheet->write($i,1, $reporte->getCaFchReporte(),$rowFormat);
			$origen = $reporte->getOrigen();
			
			if( $origen ){			
				$sheet->write($i,2, $origen->getCaCiudad() ,$rowFormat);
			}
			$destino = $reporte->getDestino();
			if( $destino ){
				$sheet->write($i,3, $destino->getCaCiudad() ,$rowFormat);
			}
			
			$sheet->write($i,4, $reporte->getCaOrdenClie(),$rowFormat);
			$sheet->write($i,5, $reporte->getProveedor(),$rowFormat);
			$sheet->write($i,6, $reporte->getConsignatario()?$reporte->getConsignatario():" ",$rowFormat);
			$sheet->write($i,7, $reporte->getCaIncoterms(),$rowFormat);
	
			$sheet->write($i,8, $reporte->getETS("Y-m-d"), $rowFormat);
			$sheet->write($i,9, $reporte->getETA("Y-m-d"),$rowFormat);
				
			$sheet->write($i,10, $reporte->getPiezas(),$rowFormat);
			$sheet->write($i,11, $reporte->getPeso(),$rowFormat);
			$sheet->write($i,12, str_replace("M&sup3;","CBM",$reporte->getVolumen()) ,$rowFormat);
			$ref = $reporte->getNumReferencia()?"\n".$reporte->getNumReferencia():"";
			$sheet->write($i,13, $reporte->getCaConsecutivo().$ref ,$rowFormat);
			$sheet->write($i,14, $reporte->getDocTransporte(),$rowFormat);
			$sheet->write($i,15,str_replace("\r" , "",$reporte->getTextoStatus()."\n"),$rowFormat);
			$i++;
		}
		


		$xls->close();		
		return sfView::NONE;
		
	}

	/*
	 * Permite generar un informe en excel donde se muestran los estados de la carga en un primer formato
	 * @author: Andres Botero
	 */
	public function executeInformeTraficosFormato2( $fileName=null ){

		$idCliente = $this->getRequestParameter("idcliente");

		$fechaInicial = $this->getRequestParameter("fechaInicial");
		$fechaFinal = $this->getRequestParameter("fechaFinal");
		$modo = $this->getRequestParameter("modo");
		$cliente = ClientePeer::retrieveByPk( $idCliente );

		$this->forward404Unless( $cliente );
		$this->forward404unless( $modo );
		$this->forward404unless( $fechaInicial );
		$this->forward404unless( $fechaFinal );
		$reportes = ReportePeer::getReportesByDate( $modo , $fechaInicial, $fechaFinal,  $idCliente );
		$this->setLayout("none");
		@require 'Spreadsheet/Excel/Writer.php';
		error_reporting(E_ERROR ^ E_NOTICE);

		$xls = new Spreadsheet_Excel_Writer();

		// Send HTTP headers to tell the browser what's coming
		if(!$fileName){
			$xls = new Spreadsheet_Excel_Writer();
			$xls->send("status".$idCliente.".xls");
		}else{			
			$xls = new Spreadsheet_Excel_Writer( $fileName );			
		}
		// Add a worksheet to the file, returning an object to add data to
		$sheet = $xls->addWorksheet($idCliente);



		$i=7;

		// Create a format object
		$headFormat = $xls->addFormat();
		// Set the font family - Helvetica works for OpenOffice calc too...
		$headFormat->setFontFamily('Helvetica');
		// Set the text to bold
		$headFormat->setBold();
		// Set the text size
		$headFormat->setSize('12');
		// Set the text color
		$headFormat->setColor('black');
		// Set the bottom border width to "thick"

		// Set the color of the bottom border
		$headFormat->setBottomColor('black');
		$headFormat->setMerge();

		$sheet->write(0,5,"TRANSITO DE MERCANCIAS VIA MARITIMA ".$cliente->getCaCompania() ,$headFormat);
		$sheet->write(2,0,Utils::fechaMes(date("Y-m-d")) ,$headFormat);

		/*
		 Titulos
		 */
		// Create a format object
		$titleFormat = $xls->addFormat();
		// Set the font family - Helvetica works for OpenOffice calc too...
		$titleFormat->setFontFamily('Helvetica');
		// Set the text to bold
		$titleFormat->setBold();
		// Set the text size
		$titleFormat->setSize('8');
		// Set the text color
		$titleFormat->setColor('black');
		// Set the bottom border width to "thick"
		$titleFormat->setBottom(1);
		// Set the color of the bottom border
		$titleFormat->setBottomColor('black');

		$sheet->write(0,8,"CONVENCIONES",$titleFormat);

		//Convenciones

		//Sin novedad
		$format1 = $xls->addFormat();
		$format1->setFontFamily('Helvetica');
		$format1->setBorder( 1 );
		$format1->setSize('8');
		$format1->setColor('black');
		$format1->setAlign('justify');
		$format1->setVAlign("top");
		$sheet->write(1,8," ",$format1);
		$sheet->write(1,9,"Sin novedad",$format1);

		//Formato nuevo status //verde  //Por ahora que ya llego
		$format2 = $xls->addFormat();
		$format2->setFontFamily('Helvetica');
		$format2->setSize('8');
		$xls->setCustomColor(14, 223, 255, 255);
		$format2->setFgColor(14);
		$format2->setBorder( 1 );
		$format2->setAlign('justify');
		$format2->setVAlign("top");
		$sheet->write(2,8," ",$format2);
		$sheet->write(2,9,"Llegaron",$format1);

		//formato carga embarcada //azul
		$format3 = $xls->addFormat();
		$format3->setFontFamily('Helvetica');
		$format3->setSize('8');
		$xls->setCustomColor(15, 174, 215, 255);
		$format3->setFgColor(15);
		$format3->setBorder( 1 );
		$format3->setAlign('justify');
		$format3->setVAlign("top");
		$sheet->write(3,8," ",$format3);
		$sheet->write(3,9,"Carga embarcada",$format1);

		//Formato anulado //rosado
		$format4 = $xls->addFormat();
		$format4->setFontFamily('Helvetica');
		$format4->setSize('8');
		$xls->setCustomColor(16, 255, 232, 232);
		$format4->setFgColor(16);
		$format4->setBorder( 1 );
		$format4->setAlign('justify');
		$format4->setVAlign("top");
		$sheet->write(4,8," ",$format4);
		$sheet->write(4,9,"Anulado",$format1);

		//Formato pend instrucciones //amarillo
		$format5 = $xls->addFormat();
		$format5->setFontFamily('Helvetica');
		$format5->setSize('8');
		$xls->setCustomColor(17, 255, 255, 187);
		$format5->setFgColor(17);
		$format5->setBorder( 1 );
		$format5->setAlign('justify');
		$format5->setVAlign("top");
		$sheet->write(5,8," ",$format5);
		$sheet->write(5,9,"Pendiente por instrucciones",$format1);

		// Set the alignment to the special merge value
		//$titleFormat->setAlign('merge');

		$sheet->write($i,0,"Supplier",$titleFormat);
		$sheet->write($i,1,"PO",$titleFormat);
		$sheet->write($i,2,"Status",$titleFormat);
		$sheet->write($i,3,"HAWB/HBL",$titleFormat);
		$sheet->write($i,4,"Qty (kg)",$titleFormat);
		$sheet->write($i,5,"Terms",$titleFormat);
		$sheet->write($i,6,"Mode",$titleFormat);
		$sheet->write($i,7,"Origin",$titleFormat);
		$sheet->write($i,8,"Destino",$titleFormat);
		$sheet->write($i,9,"DISPATCH Estimated",$titleFormat);
		$sheet->write($i,10,"DISPATCH Real",$titleFormat);
		$sheet->write($i,11,"ARRIVAL Estimated",$titleFormat);
		$sheet->write($i,12,"ARRIVAL Real",$titleFormat);
		$sheet->write($i,13,"DIAS DE TRANSITO",$titleFormat);
		$sheet->write($i,14,"COL REF.",$titleFormat);

		$i++;

		// The row height
		$sheet->setRow(0,25);

		// Set the column width
		$sheet->setColumn(0,2,40);
		$sheet->setColumn(2,2,40);
		$sheet->setColumn(3,3,25);
		$sheet->setColumn(4,4,15);
		$sheet->setColumn(5,5,40);
		$sheet->setColumn(6,6,40);
		$sheet->setColumn(7,8,10);
		$sheet->setColumn(9,9,10);
		$sheet->setColumn(10,10,15);
		$sheet->setColumn(11,11,15);
		$sheet->setColumn(12,12,15);
		$sheet->setColumn(13,13,15);
		$sheet->setColumn(14,14,30);
		$sheet->setColumn(15,15,100);

		foreach( $reportes as $reporte ){
			if( !$reporte->esUltimaVersion() ){
				continue;
			}
				
			$fchEmbarque = $reporte->getFchEmbarque();
			$fchArribo = $reporte->getFcharribo();
				
			$etapa = $reporte->getCaEtapaActual();
			switch( $etapa ){
				case "Pendiente de Coordinación":
					$rowFormat = $format5;
					break;
				case "Carga Embarcada":
					$rowFormat = $format3;
					break;
				default:
					/*if( $fecha==date("Y-m-d")){//nuevo status
						$rowFormat = $format2;
						}
						else{*/
					$rowFormat = $format1; //sin novedad
					//}
					break;
			}
				
			if( $fchArribo ){
				$rowFormat = $format2;
			}
				
			$sheet->write($i,0, $reporte->getProveedor(),$rowFormat);
			$sheet->write($i,1, $reporte->getCaOrdenClie(),$rowFormat);
			$sheet->write($i,2, str_replace("\r" , "",$reporte->getTextoStatus()),$rowFormat);
			$sheet->write($i,3, $reporte->getDocTransporte() ,$rowFormat);
				
			$sheet->write($i,4, $reporte->getPiezas()."\n".$reporte->getPeso()."\n".$reporte->getVolumen(),$rowFormat);
			$sheet->write($i,5, $reporte->getCaIncoterms(),$rowFormat);
			$sheet->write($i,6, $reporte->getCaTransporte(),$rowFormat);
			$sheet->write($i,7, $reporte->getOrigen(),$rowFormat);
			$sheet->write($i,8, $reporte->getDestino(),$rowFormat);
			$sheet->write($i,9, $reporte->getETS("Y-m-d"), $rowFormat);
			$sheet->write($i,10, $fchEmbarque ,$rowFormat);
			$sheet->write($i,11, $reporte->getETA("Y-m-d"),$rowFormat);
			$sheet->write($i,12, $reporte->getFcharribo() ,$rowFormat);
			$diasTransito = "";
			if( $fchEmbarque && $fchArribo ){
				$diasTransito = Utils::numeroDeDias( $fchEmbarque, $fchArribo );
			}
			$sheet->write($i,13, $diasTransito ,$rowFormat);
			$ref = $reporte->getNumReferencia()?"\n".$reporte->getNumReferencia():"";
			$sheet->write($i,14, $reporte->getCaConsecutivo().$ref ,$rowFormat);

			$i++;
		}


		$xls->close();
		return sfView::NONE;
	}

	/*
	 * Permite al usuario determinar que archivos se van a enviar por correo
	 * @author: Andres Botero
	 */
	public function executeCorreoTraficos(){
		$idCliente = $this->getRequestParameter("idcliente");
		$this->idCliente = $idCliente;
		$this->fechaInicial = $this->getRequestParameter("fechaInicial");
		$this->fechaFinal = $this->getRequestParameter("fechaFinal");
		$this->modo = $this->getRequestParameter("modo");
		$this->ver = $this->getRequestParameter("ver");
		$this->forward404unless( $this->modo );
		$this->forward404unless( $this->idCliente );
		$this->forward404unless( $this->fechaInicial );
		$this->forward404unless( $this->fechaFinal );

		
		
		$ver = $this->getRequestParameter("ver");
		
		
		
		
		switch( $ver ){
			case "activos":					
				$this->reportes = ReportePeer::getReportesActivos( $this->modo , $this->idCliente );
				break;
			case"fecha";			
				$this->reportes = ReportePeer::getReportesByDate( $this->modo , $this->fechaInicial, $this->fechaFinal,  $this->idCliente );
				break;
			default:
				$this->reportes = array();
				break;			
		}	
		

		$this->user = $this->getUser();
	}

	
	/*
	 * Retoma el error en ErrorEnviarCorreoTraficos 
	 * @author: Andres Botero
	 */
	public function handleErrorEnviarCorreoTraficos(){
		$this->forward("traficos","correoTraficos");
	}
	
	/*
	 * Permite enviar un correo con la informacion de traficos, añade el cuadro de excel generado
	 * por executeInformeTraficos()
	 * @author: Andres Botero
	 */
	public function executeEnviarCorreoTraficos(){
		$idCliente = $this->getRequestParameter("idcliente");
		$this->idCliente = $idCliente;
		$this->fechaInicial = $this->getRequestParameter("fechaInicial");
		$this->fechaFinal = $this->getRequestParameter("fechaFinal");
		$this->modo = $this->getRequestParameter("modo");
		$this->ver = $this->getRequestParameter("ver");
		
		$cliente = ClientePeer::retrieveByPk( $idCliente );
		$adjuntar_excel = $this->getRequestParameter("adjuntar_excel");
		
		$this->forward404unless( $this->modo );
		$this->forward404unless( $this->idCliente );
		$this->forward404unless( $this->fechaInicial );
		$this->forward404unless( $this->fechaFinal );

		$this->getRequest()->setParameter("save", "true");
		
		if( $adjuntar_excel ){
			$fileName = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."status".$cliente->getCaIdCliente().".xls";			
			
			//Genera el archivo de excel
			$this->executeInformeTraficosFormato1($fileName );				
		}
		$user = $this->getUser();
		//Guarda el correo y lo envia
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Envío de cuadro" ); //Envío de Avisos
		$email->setCaIdcaso( '' );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );
		if( $adjuntar_excel ){		
			$email->AddAttachment( $fileName );
		}
		
		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
		}

		$email->setCaReplyto( $user->getEmail() );
		
		$recips = explode(",", $this->getRequestParameter("destinatario") );									
		
		foreach( $recips as $recip ){			
			$recip = str_replace(" ", "", $recip );			
			if( $recip ){
				$email->addTo( $recip ); 
			}
		}	
		
		$recips = explode(",", $this->getRequestParameter("cc") );
		foreach( $recips as $recip ){			
			$recip = str_replace(" ", "", $recip );			
			if( $recip ){
				$email->addCc( $cc ); 
			}
		}
		
		$email->addCc( $this->getUser()->getEmail() );
			
		$email->setCaSubject( $this->getRequestParameter("asunto") );
		$attachments = $this->getRequestParameter( "attachments" );
		if( $attachments ){
			foreach( $attachments as $attachment){
				$email->AddAttachment( base64_decode( $attachment ) );
			}
		}		
				
		$email->setCaBody( $this->getRequestParameter("mensaje") );
			
		$email->save();
		$email->send();		
	}
	
	/***********************************************************************************
	* Plantillas para el correo de traficos 
	************************************************************************************/
		
	public function executeVerStatus(){
		
		$this->status = RepStatusPeer::retrieveByPk( $this->getRequestParameter("id"), $this->getRequestParameter("emailid") );		
		$this->forward404Unless( $this->status );
		$this->reporte = $this->status->getReporte();
		$email = $this->status->getEmail();
		if( $email ){		
			$this->user = UsuarioPeer::retrieveByPk( $email->getCaUsuEnvio() );
		}
		$this->setLayout("email");		
		
		if( $this->status->getCaEtapa()=="Carga Embarcada"|| $this->status->getCaEtapa()=="Carga con Reserva" ){
			
			if( $this->reporte->getCaImpoExpo()=="Exportación" ){			
				$this->setTemplate("emailAvisoExpo");					
			}else{
				if( $this->reporte->getCaTransporte()=="Marítimo" ){
					$this->setTemplate("emailAvisoImpoMaritimo");		
				}else{
					$this->setTemplate("emailAvisoImpoAereo");		
				}
			}	
		}	
		
	}
	
}
?>