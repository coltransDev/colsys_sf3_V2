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

	/***********************************************************************************
	* Pagina inicial y consulta de reportes
	************************************************************************************/
	
	/**
	 * Muestra un formulario para seleccionar un rango de fechas y el cliente
	 * @author: Andres Botero
	 */
	public function executeIndex()
	{
		$this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );
	}


	/*
	 * permite ver el estado de cada  carga asi como las notificaciones avisos, status etc
	 * @author: Andres Botero
	 */
	public function executeListaStatus(){
		$this->idCliente = $this->getRequestParameter("idcliente");
				
		$this->modo = $this->getRequestParameter("modo");
		$this->forward404unless( $this->modo );
		
		
			
		if( $this->getRequestParameter("reporte") ){
			$consecutivo = $this->getRequestParameter("reporte");
			
			if( !$consecutivo ){
				$this->redirect( "traficos/index?modo=".$this->modo );	
			}
			
			$reporte = ReportePeer::retrieveByConsecutivo( $consecutivo );	
			$this->forward404Unless( $reporte ); 		
			
			if( $this->modo=="maritimo" && $reporte->getCaTransporte()!=Constantes::MARITIMO ){
				$this->forward404();
			}
			
			if( $this->modo=="aereo" && $reporte->getCaTransporte()!=Constantes::AEREO ){
				$this->forward404();
			}
			
			if( $this->modo=="expo" && $reporte->getCaTransporte()!=Constantes::EXPO ){
				$this->forward404();
			}
			
			$this->cliente = $reporte->getCliente(); 			
			$this->idreporte = $reporte->getCaIdreporte();
			$this->getRequest()->setParameter("idcliente", $this->cliente->getCaIdcliente() ); // Para el submenu
			
		}else{		
			if( !$this->idCliente ){
				$this->redirect( "traficos/index?modo=".$this->modo );	
			}
			$this->cliente = ClientePeer::retrieveByPk( $this->idCliente );			
			$this->forward404unless( $this->cliente );	
			$this->idreporte = null;
			$reporte = null;
		}
			
				
		switch( $this->modo ){
			case "aereo":
				$this->reportes = ReportePeer::getReportesActivosImpoAereo( $this->cliente->getCaIdcliente() );
				break;
			case "maritimo":
				$this->reportes = ReportePeer::getReportesActivosImpoMaritimo( $this->cliente->getCaIdcliente() );
				break;
			case "expo":
				$this->reportes = ReportePeer::getReportesActivosExpo( $this->cliente->getCaIdcliente() );
				break;	
		}							
		
		
		/*
		* En caso que no se encuentre entre los activos
		*/
		if( $reporte ){
			$flag = false;
			foreach( $this->reportes as $rep ){
				if( $reporte->getCaIdreporte()==$rep->getCaIdreporte() ){
					$flag=true;
				}	
			}		
			if( !$flag ){
				$this->reportes[] = $reporte;
			}
		}					
		$this->getUser()->clearFiles();	
	}
	

	
	/***********************************************************************************
	* Creación de status
	************************************************************************************/
	
	/*
	 * Muestra un formario para agregar un nuevo status u aviso a un reporte
	 * @author: Andres Botero
	 */
	public function executeNuevoStatus( $request ){
						
		$this->form = new NuevoStatusForm();
		
		$idreporte = $this->getRequestParameter("idreporte");
		$this->forward404Unless( $idreporte );
		$this->reporte = ReportePeer::retrieveByPk( $idreporte );
		$this->forward404Unless( $this->reporte );
				
		if ($request->isMethod('post')){		
		
			$bindValues = array();
			
			for( $i=0; $i<NuevoStatusForm::NUM_CC ; $i++ ){
				$bindValues["cc_".$i] = $request->getParameter("cc_".$i);
			}
			
			$this->form->bind( $bindValues ); 
			if( $this->form->isValid() ){	
				//Se valido correctamente			
				//$this->redirect("homepage/index");
				echo "OK";	
			}
				
		}else{
			
			//Etapas			
			$c = new Criteria();
			$c->add( TrackingEtapaPeer::CA_IMPOEXPO, $this->reporte->getCaImpoexpo() );		
			$c->addOr( TrackingEtapaPeer::CA_IMPOEXPO, null, Criteria::ISNULL );			
			if( $this->reporte->getCaImpoexpo()==Constantes::IMPO ){
				$c->add( TrackingEtapaPeer::CA_TRANSPORTE, $this->reporte->getCaTransporte() );	
				$c->addOr( TrackingEtapaPeer::CA_TRANSPORTE, null, Criteria::ISNULL );		
			}
			$c->addAscendingOrderByColumn( TrackingEtapaPeer::CA_ORDEN );				
			
			$this->form->setCriteriaIdEtapa( $c );		
			
			
			// Tipos de piezas			
			$this->form->setCriteriaPiezas( ParametroPeer::getCriteriaByCu( "CU047" ) );	
			$this->form->setCriteriaPeso( ParametroPeer::getCriteriaByCu( "CU049" ) );	
			
			if( $this->reporte->getCaTransporte()==Constantes::MARITIMO){
				$this->form->setCriteriaVolumen( ParametroPeer::getCriteriaByCu( "CU050" ) );	
				
			}
			
			if( $this->reporte->getCaTransporte()==Constantes::AEREO ){
				$this->form->setCriteriaVolumen( ParametroPeer::getCriteriaByCu( "CU058" ) );		
			}		
			
			$this->form->configure();	
		}
		
		/*
		
		$this->tipo = $this->getRequestParameter("tipo"); //aviso status
		
		
		
		$c = new Criteria();	
		if( $this->reporte->getCaImpoExpo()==Constantes::TRIANGULACION ){	
			$c->add( TrackingEtapaPeer::CA_IMPOEXPO, Constantes::IMPO );
		}else{
			$c->add( TrackingEtapaPeer::CA_IMPOEXPO, $this->reporte->getCaImpoExpo() );
		}	
		$c->addOr( TrackingEtapaPeer::CA_IMPOEXPO, null, Criteria::ISNULL );
		
		if( $this->reporte->getCaImpoExpo()==Constantes::IMPO||$this->reporte->getCaImpoExpo()==Constantes::TRIANGULACION ){
			$c->add( TrackingEtapaPeer::CA_TRANSPORTE, $this->reporte->getCaTransporte() );
			$c->addOr( TrackingEtapaPeer::CA_TRANSPORTE, null, Criteria::ISNULL );			
		}
		$c->addAscendingOrderByColumn( TrackingEtapaPeer::CA_ORDEN );
		$this->etapas = TrackingEtapaPeer::doSelect( $c );
		
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
		
		
		
		$c = new Criteria();
		$c->addJoin( ParametroPeer::CA_IDENTIFICACION, ClientePeer::CA_IDGRUPO );
		$c->add( ClientePeer::CA_IDGRUPO, $this->cliente->getCaIdCliente() );
		$c->add( ParametroPeer::CA_CASOUSO, "CU059" );		
		$c->setDistinct();
		$this->parametros = ParametroPeer::doSelect( $c );
				
		*/
		
		
			
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
		
		if( $this->getRequestParameter("etapa")=="IAETA"|| $this->getRequestParameter("etapa")=="IMETA" || $this->getRequestParameter("etapa")=="EEETA" ){
			
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
		}
		
				
		
		if(!$this->getRequestParameter("fchrecibo")){
			$this->getRequest()->setError("fchrecibo", "requerido");			
			$error=true;	
		}
		
		if(!$this->getRequestParameter("horarecibo")){
			$this->getRequest()->setError("horarecibo", "requerido");			
			$error=true;	
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
		
		$email->setCaTipo( "Envío de Status" ); 	
				
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
			$coordinador = null;	
			if( $reporte->getCaContinuacionConf() ){					
				$coordinador = UsuarioPeer::retrieveByPk($reporte->getCaContinuacionConf());
			}
			if( $coordinador ){						
				$email->addCc( $coordinador->getCaEmail() );				
			}	  
		}
			
		if ($this->getRequestParameter("copiar_adua")){
							
		 	$repaduana = $reporte->getRepAduana();				
			$coordinador = null;
			if( $repaduana ){					
				$coordinador = UsuarioPeer::retrieveByPk($repaduana->getCaCoordinador());
			}
			if( $coordinador ){						
				$email->addCc( $coordinador->getCaEmail() );				
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
		$status->setCaIdEtapa( $this->getRequestParameter("etapa") );
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
		
		$c = new Criteria();
		$c->addJoin( ParametroPeer::CA_IDENTIFICACION, ClientePeer::CA_IDGRUPO );
		$c->add( ClientePeer::CA_IDGRUPO, $reporte->getCliente()->getCaIdCliente() );
		$c->add( ParametroPeer::CA_CASOUSO, "CU059" );		
		$c->setDistinct();		
		$parametros = ParametroPeer::doSelect( $c );
				
		
		foreach( $parametros as $parametro ){
			$valor = explode(":",$parametro->getCaValor());
			$name = $valor[0];
			$type = $valor[1];						
			if( $this->getRequestParameter($name ) ){		
					
				$reporte->setProperty($name, $this->getRequestParameter($name));
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
		
		
		return sfView::SUCCESS;

	}
	
	
	/***********************************************************************************
	* Generación de cuadro en excel y correo electronico
	************************************************************************************/

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
		
		
		
		$this->forward404Unless( $this->cliente );
		$this->forward404unless( $this->modo );
			
		switch( $this->modo ){
			case "aereo":
				$this->reportes = ReportePeer::getReportesActivosImpoAereo( $this->idCliente );
				break;
			case "maritimo":
				$this->reportes = ReportePeer::getReportesActivosImpoMaritimo( $this->idCliente );
				break;
			case "expo":
				$this->reportes = ReportePeer::getReportesActivosExpo( $this->idCliente );
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
		$this->modo = $this->getRequestParameter("modo");
		
		$this->consecutivo = $this->getRequestParameter("reporte");
		$this->forward404unless( $this->modo );
		$this->forward404unless( $this->idCliente );
		
		
		$this->cliente = ClientePeer::retrieveByPk( $this->idCliente );
		
		switch( $this->modo ){
			case "aereo":
				$this->reportes = ReportePeer::getReportesActivosImpoAereo( $this->idCliente );
				break;
			case "maritimo":
				$this->reportes = ReportePeer::getReportesActivosImpoMaritimo( $this->idCliente );
				break;
			case "expo":
				$this->reportes = ReportePeer::getReportesActivosExpo( $this->idCliente );
				break;	
		}		
		

		$this->user = $this->getUser();
		
		$this->usuario = UsuarioPeer::retrieveByPk( $this->user->getUserId() );
		
		$this->user->clearFiles();
	}
			
	/*
	 * Permite enviar un correo con la informacion de traficos, añade el cuadro de excel generado
	 * por executeInformeTraficos()
	 * @author: Andres Botero
	 */
	public function executeEnviarCorreoTraficos(){
		
		$idCliente = $this->getRequestParameter("idcliente");
		$this->idCliente = $idCliente;		
		$this->modo = $this->getRequestParameter("modo");
		
		$this->consecutivo = $this->getRequestParameter("reporte");
		
		$cliente = ClientePeer::retrieveByPk( $idCliente );
		$adjuntar_excel = $this->getRequestParameter("adjuntar_excel");
		
		$this->forward404unless( $this->modo );
		$this->forward404unless( $this->idCliente );
		

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
		$email->setCaIdcaso( null );
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
				
		$email->setCaBody( $this->getRequestParameter("mensaje")) ;
		
		$email->setCaBodyHtml( Utils::replace($this->getRequestParameter("mensaje"))) ;
			
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
		
		$etapa = $this->status->getTrackingEtapa( );
		$etapaStr = $etapa?$etapa->getCaEtapa():"";
		
		if( $this->reporte->getCaImpoExpo()=="Exportación" ){			
			if( $etapaStr=="ETA"||$etapaStr=="Carga Embarcada"|| $etapaStr=="Carga con Reserva" ){
				$this->setTemplate("emailAvisoExpo");					
			}
		}else{
			if( $this->reporte->getCaTransporte()=="Marítimo" ){
				if( $etapaStr=="ETA" ){
					$this->setTemplate("emailAvisoImpoMaritimo");		
				}
			}else{
				if( $etapaStr=="Carga Embarcada"|| $etapaStr=="Carga con Reserva"  || $etapaStr=="Carga en Aeropuerto de Destino" ){
					$this->setTemplate("emailAvisoImpoAereo");		
				}
			}
		}	
				
	}
	
	/***********************************************************************************
	* Funciones para manejar los archivos del reporte 
	************************************************************************************/
	
	/*
	* Ejecuta la accion de cargar el archivo en el iframe, en la forma CargarArchivoForm
	* author: Andres Botero
	*/
	public function executeCargarArchivo( $request ){
		
		//toma el valor del id del reporte, la referencia u otro objeto que se desee guardar
		// y determina el directorio
		
		
		$idreporte = $this->getRequestParameter( "idreporte" );
		if( $idreporte ){
			$reporte = ReportePeer::retrieveBypk( $idreporte );
			$this->forward404Unless( $reporte );			
			
			$directory = $reporte->getDirectorio();
			
			$this->idreporte = $idreporte;
			
						
			if( !is_dir($directory) ){			
				@mkdir($directory, 0777);			
			}	
					
			$destPath = $directory.DIRECTORY_SEPARATOR.$_FILES['file']['name']; 
			//mueve el archivo
			move_uploaded_file($_FILES['file']['tmp_name'], $destPath);
			
			$this->setLayout("none");		
		}		
		  		
	}
	/*
	* Ejecuta la accion de cargar el archivo en el iframe, en la forma CargarArchivoForm
	* author: Andres Botero
	*/
	
	public function executeListaArchivosReporte( $request ){
		$idreporte = $this->getRequestParameter( "idreporte" );
		$this->forward404Unless( $idreporte );
		$this->reporte = ReportePeer::retrieveBypk( $idreporte );
		$this->forward404Unless( $this->reporte );
		$this->getUser()->clearFiles();	
	}
	
	
	/*
	* Permite eliminar un archivo de acuerdo al indice
	* author: Andres Botero
	*/
	public function executeEliminarArchivosReporte(){		
		$idx = $this->getRequestParameter("idxArchivo"); 
		$name = $this->getUser()->getFile( $idx );	
		unlink( $name );
		return sfView::NONE;		
	}
	
	
	/***********************************************************************************
	* 
	************************************************************************************/
	
	
}
?>