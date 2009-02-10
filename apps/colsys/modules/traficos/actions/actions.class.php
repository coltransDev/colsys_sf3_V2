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
	/*
	* Muestra un formulario para seleccionar un rango de fechas y el cliente
	* author: Andres Botero
	*/
	public function executeIndex()
	{
		$this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );
	}
	
	/*
	* permite ver el estado de cada  carga asi como las notificaciones avisos, status etc
	* author: Andres Botero
	*/
	public function executeVerStatusCarga(){
		$this->idCliente = $this->getRequestParameter("idcliente");
				
		$this->modo = $this->getRequestParameter("modo");
		
		$this->ver = $this->getRequestParameter("ver");
		
		
		switch( $this->ver ){
			case "activos":	
				$this->forward404unless( $this->modo );
				$this->forward404unless( $this->idCliente );	
				$this->fechaInicial = $this->getRequestParameter("fechaInicial");
				$this->fechaFinal = $this->getRequestParameter("fechaFinal");	
								
				if( $this->modo=="maritimo" ){
					$this->reportes = ReportePeer::getReportesActivosImpoMaritimo( $this->idCliente );
				}
				if( $this->modo=="aereo" ){
					$this->reportes = ReportePeer::getReportesActivosImpoAereo( $this->idCliente );
				}
								
				if( $this->modo=="expo" ){				
					$this->reportes = ReportePeer::getReportesActivosExpo( $this->idCliente );
				}
				
				$this->cliente = ClientePeer::retrieveByPk($this->idCliente );
				break;
			
			case "reporte";
				
				$c = new Criteria();
				$c->add( ReportePeer::CA_CONSECUTIVO, "".$this->getRequestParameter("numreporte")."%" , Criteria::LIKE );				
		
				if( $this->modo=="maritimo" ){
					$c->add( ReportePeer::CA_TRANSPORTE, Constantes::MARITIMO );
					$c->add( ReportePeer::CA_IMPOEXPO, Constantes::IMPORTACION );
					$c->addOr( ReportePeer::CA_IMPOEXPO, Constantes::TRIANGULACION  );
				}
				
				if( $this->modo=="aereo" ){
					$c->add( ReportePeer::CA_TRANSPORTE, Constantes::AEREO );
					$c->add( ReportePeer::CA_IMPOEXPO, Constantes::IMPORTACION );
					$c->addOr( ReportePeer::CA_IMPOEXPO, Constantes::TRIANGULACION  );
				}
				
				if( $this->modo=="expo" || $this->modo=="exportaciones" ){
					$c->add( ReportePeer::CA_IMPOEXPO, Constantes::EXPORTACION );
				}												
				
				$c->addDescendingOrderByColumn(ReportePeer::CA_FCHDESPACHO );	
				$this->reportes = ReportePeer::doSelect( $c );
				
				
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

		$this->setLayout("popup");
		
		if( $this->reporte->getCaImpoExpo()=="Exportación" ){
			$this->etapas = ParametroPeer::retrieveByCaso( "CU045", null, "%".$this->reporte->getCaImpoExpo()."%" );
		}else{
			$this->etapas = ParametroPeer::retrieveByCaso( "CU045" , null, "%".$this->reporte->getCaTransporte()."%");
		}
				
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
		if( $this->reporte->getCaTransporte()=="Marítimo" ){
			$this->tipo_volumen = ParametroPeer::retrieveByCaso( "CU050" );	
		}
		if( $this->reporte->getCaTransporte()=="Aéreo" ){
			$this->tipo_volumen = ParametroPeer::retrieveByCaso( "CU058" );	
		}
		
		
		$this->cliente = $this->reporte->getCliente();
		$this->user = $this->getUser();
		//Busca los parametrus definidos en CU059 que sean tengan la propeiedad 
		$this->parametros = ParametroPeer::retrieveByCaso( "CU059", null , null, $this->cliente->getCaIdCliente() );
			
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
		$error = false;
		if( $this->getRequestParameter("etapa")=="ETA"){
			if(!$this->getRequestParameter("piezas")){
				$this->getRequest()->setError("piezas", "requerido");			
				$error=true;	
			}
		
			if(!$this->getRequestParameter("peso")){
				$this->getRequest()->setError("peso", "requerido");			
				$error=true;	
			}
			
			if(!$this->getRequestParameter("volumen")){
				$this->getRequest()->setError("volumen", "requerido");			
				$error=true;	
			}
			
			if(!$this->getRequestParameter("fchsalida")){
				$this->getRequest()->setError("fchsalida", "requerido");			
				$error=true;	
			}
			
			if(!$this->getRequestParameter("fchllegada")){
				$this->getRequest()->setError("fchllegada", "requerido");			
				$error=true;	
			}
			
			if(!$this->getRequestParameter("doctransporte")){
				$this->getRequest()->setError("doctransporte", "requerido");			
				$error=true;	
			}
			
			if(!$this->getRequestParameter("idnave")){
				$this->getRequest()->setError("idnave", "requerido");			
				$error=true;	
			}
		}else{
			
			if(!$this->getRequestParameter("fchrecibo")){
				$this->getRequest()->setError("fchrecibo", "requerido");			
				$error=true;	
			}
			
			if(!$this->getRequestParameter("horarecibo")){
				$this->getRequest()->setError("horarecibo", "requerido");			
				$error=true;	
			}
		}
		
		if( $error ){
			$this->handleErrorNuevoMensajeSubmit();
			return false;
		}
		//print_r($user);
		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		if( $this->getRequestParameter("etapa")=="ETA" ){
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
					
		if ( $reporte->getCaSeguro()=="Sí" ) {
			$email->addCc( "seguros@coltrans.com.co" ); 
		}
				
		$email->addCc( $this->getUser()->getEmail() );
					
		$email->setCaSubject( $this->getRequestParameter("asunto") );
		$attachments = $this->getRequestParameter( "attachments" );
		if( $attachments ){
			foreach( $attachments as $attachment){
				$email->AddAttachment( base64_decode( $attachment ) );
			}
		}
		
		if ($this->getRequestParameter("copiar_cont")){
			$recips = explode(",",$reporte->getCaContinuacionConf());			
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){					
					$email->addCc( $recip ); 
				}
			}	   
		}
			
		if ($this->getRequestParameter("copiar_adua")){
			$cordinador = $reporte->getCliente()->getCoordinador(); 	
		 
			if( $cordinador ){			
				$email->addCc( $cordinador->getCaEmail() );				
			}		  		   
		}

		$email->setCaBody("-");		
		$email->save(); 		
				
		$status = new RepStatus();
		$status->setCaIdReporte( $this->reporteId );
		$status->setCaFchStatus( date("Y-m-d H:i:s") );
		$status->setCaIntroduccion( Utils::replace( $this->getRequestParameter("introduccion") ) );
		$status->setCaIdEmail( $email->getCaIdemail() );
		$status->setCaStatus( $this->getRequestParameter("mensaje") );
		$status->setCaComentarios( $this->getRequestParameter("notas", '-') );
		$status->setCaEtapa( $this->getRequestParameter("etapa") );
		$status->setCaFchrecibo( $this->getRequestParameter("fchrecibo")." ".$this->getRequestParameter("horarecibo") );
		$status->setCaFchenvio( date("Y-m-d H:i:s") );
		$status->setCausuenvio( $user->getUserId() );
		
		
		$this->getRequest()->setParameter("id", $reporte->getCaIdreporte());
		$this->getRequest()->setParameter("emailid", $email->getCaIdemail());	
				
		
			
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
		
		if( $this->getRequestParameter("horasalida") ){	
			$status->setCaHorasalida( $this->getRequestParameter("horasalida") );
		}
		
		if( $this->getRequestParameter("horallegada") ){
			$status->setCaHorallegada( $this->getRequestParameter("horallegada") );
		}
			
		if( $this->getRequestParameter("fchcontinuacion") && $reporte->getCaContinuacion()!="N/A" ){
			$status->setCaFchcontinuacion( $this->getRequestParameter("fchcontinuacion") );
		}
		
	
		
		
		//borra los equipos viejos
		$repequipos = $reporte->getRepEquipos();
		foreach( $repequipos as $equipo ){
			$equipo->delete();
		}
		
		$equipos = $this->getRequestParameter("equipos");		
		if( $equipos ){			
			foreach( $equipos as $equipo ){
				if( $equipo['cant']!=0 ){
					$repequipo = new RepEquipo();
					$repequipo->setCaIdReporte( $reporte->getCaIdreporte() );
					$repequipo->setCaIdConcepto( $equipo['tipo'] );
					$repequipo->setCaCantidad( $equipo['cant'] );					
					$repequipo->save();
					if( $reporte->getcaImpoExpo()=="Exportación" ){
						$repequipo->setCaIdEquipo( $equipo['serial'] );
						
					}				
				}
			}			
		}
		
		$parametros = ParametroPeer::retrieveByCaso( "CU059", null , null, $reporte->getCliente()->getCaIdCliente() );
		
		foreach( $parametros as $parametro ){
			if( $this->getRequestParameter($parametro->getCaValor()) ){			
				$reporte->setProperty($parametro->getCaValor(), $this->getRequestParameter($parametro->getCaValor()));
			}
		}
		
		
		
		
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
	
	
	public function executeInformeTraficosFormato1(  ){
		
		
		$this->idCliente = $this->getRequestParameter("idcliente");

		$this->modo = $this->getRequestParameter("modo");
		$this->cliente = ClientePeer::retrieveByPk( $this->idCliente );
		$this->fechaInicial = $this->getRequestParameter("fechaInicial");
		$this->fechaFinal = $this->getRequestParameter("fechaFinal");
		$this->ver = $this->getRequestParameter("ver");
		
		$this->forward404Unless( $this->cliente );
		$this->forward404unless( $this->modo );
		
		switch( $this->ver ){
			case "activos":		
				$this->reportes = ReportePeer::getReportesActivos( $this->modo ,  $this->idCliente, false, "proveedor" );
				break;
			case "fecha";
				
				$this->reportes = ReportePeer::getReportesByDate( $this->modo , $this->fechaInicial, $this->fechaFinal,  $this->idCliente );
				break;
			default:
				$this->reportes = array();
				break;			
		}	
		
		$this->parametros = ParametroPeer::retrieveByCaso( "CU059", null , null, $this->idCliente );
		
		$this->filename = $this->getRequestParameter("filename");
		
		$this->setLayout("excel");
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
		
		$this->cliente = ClientePeer::retrieveByPk( $this->idCliente );
		
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
		$this->usuario = UsuarioPeer::retrieveByPk( $this->user->getUserId() );
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
			$this->getRequest()->setParameter('filename',$fileName);
			sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'informeTraficosFormato1');
			
			
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
				$email->addCc( $recip ); 
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
				
		$email->setCaBody( Utils::replace($this->getRequestParameter("mensaje"))) ;
			
		$email->save();
		$email->send();		
	}
	
	/***********************************************************************************
	* Plantillas para el correo de traficos 
	************************************************************************************/
		
	public function executeVerStatus(){
		
		$this->status = RepStatusPeer::retrieveByIdEmail( $this->getRequestParameter("emailid") );		
		$this->forward404Unless( $this->status );
		$this->reporte = $this->status->getReporte();
		$this->header = $this->getRequestParameter("header");
		
		$email = $this->status->getEmail();
		if( $email ){		
			$this->user = UsuarioPeer::retrieveByPk( $email->getCaUsuEnvio() );
		}
		$this->setLayout("email");		
		
		
			
		if( $this->reporte->getCaImpoExpo()=="Exportación" ){			
			if( $this->status->getCaEtapa()=="ETA"||$this->status->getCaEtapa()=="Carga Embarcada"|| $this->status->getCaEtapa()=="Carga con Reserva" ){
				$this->setTemplate("emailAvisoExpo");					
			}
		}else{
			if( $this->reporte->getCaTransporte()=="Marítimo" ){
				if( $this->status->getCaEtapa()=="ETA" ){
					$this->setTemplate("emailAvisoImpoMaritimo");		
				}
			}else{
				if( $this->status->getCaEtapa()=="Carga Embarcada"|| $this->status->getCaEtapa()=="Carga con Reserva"  || $this->status->getCaEtapa()=="Carga en Aeropuerto de Destino" ){
					$this->setTemplate("emailAvisoImpoAereo");		
				}
			}
		}	
				
	}
	
	
}
?>