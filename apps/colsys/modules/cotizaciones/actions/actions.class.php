<?php

/**
 * cotizaciones actions.
 *
 * @package    colsys
 * @subpackage cotizaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */ 
class cotizacionesActions extends sfActions
{
	
	const RUTINA = "12";
	/*************************************************************************
	* OPCIONES GENERALES
	*
	**************************************************************************/
	
	/**
	* Pantalla de bienvenida para el modulo de Cotizaciones 
	* @author Carlos López
	*/
	public function executeIndex()
	{	
		$c = new Criteria();
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_NOMBRE );
		$criterion = $c->getNewCriterion( UsuarioPeer::CA_CARGO ,'Gerente Sucursal' );								
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_CARGO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Comercial%', Criteria::LIKE ));
		$c->add($criterion);
		$this->comerciales = UsuarioPeer::doSelect( $c );	
		
		
		$this->nivel = $this->getUser()->getNivelAcceso( cotizacionesActions::RUTINA );
		
		if( $this->nivel==-1 ){
			$this->forward404();
		}	
		
	}
		
	/*
	* Muestra los resultados de la busqueda del reporte de negocios 
	* @author Andres Botero
	*/	
	public function executeBusquedaCotizacion()
	{
		$user = $this->getUser();
		$criterio = $this->getRequestParameter("criterio");
		$cadena = $this->getRequestParameter("cadena");
		$login = $this->getRequestParameter("login");
		
				
		$c = new Criteria();	
		$c->add( CotizacionPeer::CA_CONSECUTIVO, null, Criteria::ISNOTNULL );	
		switch( $criterio ){
			case "mis_cotizaciones":				
				$c->add( CotizacionPeer::CA_USUARIO, "%".$user->getUserId()."%", Criteria::LIKE );	
				break;	
			case "consecutivo":
				$c->add( CotizacionPeer::CA_CONSECUTIVO, "%".$cadena."%", Criteria::LIKE );	
				break;	
			case "nombre_del_cliente":
				$c->addJoin( CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO );	
				$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );	
				$c->add( ClientePeer::CA_COMPANIA , "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );
				$c->setDistinct();
				break;
			case "nombre_del_contacto":
				$c->addJoin( CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO );	
				$c->add( ContactoPeer::CA_NOMBRES , "lower(".ContactoPeer::CA_NOMBRES."||' '||".ContactoPeer::CA_PAPELLIDO."||' '||".ContactoPeer::CA_SAPELLIDO.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );
				$c->setDistinct();
				break;
			case "asunto":
				$c->add( CotizacionPeer::CA_ASUNTO, "lower(".CotizacionPeer::CA_ASUNTO.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
			case "vendedor":	
				$c->add( CotizacionPeer::CA_USUARIO, $login );						
				break;	
			case "numero_de_cotizacion":
				$c->add( CotizacionPeer::CA_IDCOTIZACION, "lower(".CotizacionPeer::CA_IDCOTIZACION.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
			case "sucursal":
				$c->addJoin( CotizacionPeer::CA_USUARIO , UsuarioPeer::CA_LOGIN );
				$c->addJoin( UsuarioPeer::CA_IDSUCURSAL , SucursalPeer::CA_IDSUCURSAL );
				$c->add( SucursalPeer::CA_NOMBRE, "lower(".SucursalPeer::CA_NOMBRE.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
		}	
		//$c->add( CotizacionPeer::CA_USUANULADO, null, Criteria::ISNULL );
		$c->addDescendingOrderByColumn( CotizacionPeer::CA_IDCOTIZACION );	
		$c->setLimit( 200 );
		
		$this->pager = new sfPropelPager('Cotizacion', 30);		
		$this->pager->setCriteria($c);	
		$this->pager->setPage($this->getRequestParameter('page', 1));			
		$this->pager->init();
		
		
		if( count($this->pager->getResults())==1 && count($this->pager->getLinks())==1  ){
			$cotizaciones = $this->pager->getResults();
			$this->redirect("cotizaciones/consultaCotizacion?id=".$cotizaciones[0]->getCaIdCotizacion());
		}
		$this->criterio = $criterio;
		$this->cadena = $cadena;
		$this->login = $login;
				
	}

	/**
	* Permite consultar una cotizacion ya creada y permite 
	* agregar nuevas  
	* @author Carlos G. López M., Andres Botero
	*/
	public function executeConsultaCotizacion(){
		
		$response = sfContext::getInstance()->getResponse();		
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/myRowExpander",'last');		
		$response->addJavaScript("extExtras/CheckColumn",'last');
			
		if( !is_null($this->getRequestParameter("id")) ) {
			$id_cotizacion = $this->getRequestParameter("id");	
			$cotizacion = CotizacionPeer::retrieveByPk( $id_cotizacion );
			$this->forward404Unless( $cotizacion );					
			$this->editable = $this->getRequestParameter("editable");	
			$this->option = $this->getRequestParameter("option");
			/*
			$c = new Criteria();
			$c->add(EmailPeer::CA_TIPO, "Envío de cotización");
			$c->add(EmailPeer::CA_IDCASO,$cotizacion->getCaIdCotizacion()); 
			$c->addAscendingOrderByColumn(EmailPeer::CA_FCHENVIO);
			$emails = EmailPeer::doSelect( $c );
			
			if( count($emails)>0 ){
			
			}*/
			
			
			$this->tarea = $cotizacion->getTareaIDGEnvioOportuno();
			if( $this->tarea && $this->tarea->getCafchterminada() ){
				$this->redirect("cotizaciones/verCotizacion?id=".$cotizacion->getCaIdCotizacion());
			}
			
						
			if($cotizacion->getCaUsuanulado()){
				$this->redirect("cotizaciones/verCotizacion?id=".$cotizacion->getCaIdCotizacion());
			}
			
			$this->cotizacion = $cotizacion;			
		}else {			
			$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
			$textos = sfYaml::load($config);			
			$user = $this->getUser()->getUserId();
			$this->cotizacion = new Cotizacion();			
			$this->cotizacion->setCaAsunto($textos['asunto']);
			$this->cotizacion->setCaSaludo($textos['saludo']);
			$this->cotizacion->setCaEntrada( $textos['entrada'] );
			$this->cotizacion->setCaDespedida( $textos['despedida'] );
			$this->cotizacion->setCaAnexos( $textos['anexos'] );
			$this->cotizacion->setCaUsuario($user);
			
			$this->tarea = $this->cotizacion->getTareaIDGEnvioOportuno();
			
			
		}
		$this->user = $this->getUser();
		$this->nivel = $this->getUser()->getNivelAcceso( cotizacionesActions::RUTINA );
		if( $this->nivel==-1 ){
			$this->forward404();
		}	
	}		

	/*
	* Guarda los cambios realizados al Header de la Cotización  
	* @author Carlos G. López M.
	*/
	public function executeFormCotizacionGuardar(){
		$user_id = $this->getUser()->getUserId();
				
		if( $this->getRequestParameter("cotizacionId") ){
			$cotizacion = CotizacionPeer::retrieveByPk( $this->getRequestParameter("cotizacionId") );
			$this->forward404Unless( $cotizacion );
		}else{		
			$cotizacion = new Cotizacion();
			$sig = CotizacionPeer::siguienteConsecutivo( date("Y") );			
			$cotizacion->setCaConsecutivo( $sig ); 			
		}
		if( $this->getRequestParameter( "empresa" ) ){
			$cotizacion->setCaEmpresa( $this->getRequestParameter( "empresa" ) );		
		}
			
		
		if( $this->getRequestParameter( "vendedor" ) ){
			$cotizacion->setCaUsuario( $this->getRequestParameter( "vendedor" ) );
		}else{
		
			if( $this->getUser()->getIddepartamento()==5 ){ // Si es comercial le coloca la cotizacion
				$cotizacion->setCaUsuario( $this->getUser()->getUserid() );		
				
			}elseif(!$cotizacion->getCaUsuario() || $cotizacion->getCaIdcontacto()!=$this->getRequestParameter( "idconcliente" ) ){
				$contacto = ContactoPeer::retrieveByPk( $this->getRequestParameter( "idconcliente" ) );
				$vendedor = $contacto->getCliente()->getCaVendedor();
				if(!$vendedor){
					$vendedor = "Comercial";
				}
				$cotizacion->setCaUsuario( $vendedor );			
			}
		}
		
		
		$cotizacion->setCaIdContacto( $this->getRequestParameter( "idconcliente" ) );
		$cotizacion->setCaAsunto( utf8_decode($this->getRequestParameter( "asunto" )) );
		$cotizacion->setCaSaludo( utf8_decode($this->getRequestParameter( "saludo" )) );
		$cotizacion->setCaEntrada( utf8_decode($this->getRequestParameter( "entrada" )) );
		$cotizacion->setCaDespedida( utf8_decode($this->getRequestParameter( "despedida" )) );
		$cotizacion->setCaAnexos( utf8_decode($this->getRequestParameter( "anexos" )) );
		
		if( $this->getRequestParameter( "fuente" ) ){
			$cotizacion->setCaFuente( $this->getRequestParameter( "fuente" ) );
		}
						
		
		
		if( !$cotizacion->getCaIdCotizacion() ){ 
			$cotizacion->setCaFchcreado( time() );	
			$cotizacion->setCaUsucreado( $user_id );			
		}else{
			$cotizacion->setCaFchactualizado( time() );	
			$cotizacion->setCaUsuactualizado( $user_id );							
		}
		$cotizacion->save();	
		
		if( $this->getRequestParameter( "fchSolicitud" ) ){
			$cotizacion->crearTareaIDGEnvioOportuno( $this->getRequestParameter( "fchSolicitud" )." ".$this->getRequestParameter( "horaSolicitud" ));
			//$cotizacion->setCaFchSolicitud( $this->getRequestParameter( "fchSolicitud" ) );
			//$cotizacion->setCaHoraSolicitud( $this->getRequestParameter( "horaSolicitud" ) );
		}
		
		
		if( $this->getRequestParameter( "fchPresentacion" ) ){
			$cotizacion->setFchpresentacion( $this->getRequestParameter( "fchPresentacion" )." ".$this->getRequestParameter( "horaPresentacion" ) );			
			
		}
		
		if( $this->getRequestParameter( "observaciones_idg" )!==null ){
			$tarea = $cotizacion->getTareaIDGEnvioOportuno();
			$tarea->setCaObservaciones( $this->getRequestParameter( "observaciones_idg" ) );
			$tarea->save();
		}
						
		if( !$this->getRequestParameter("cotizacionId") ){
			$tarea = $cotizacion->getTareaIDGEnvioOportuno(); //Crea la tarea si no existe
			//$tarea->notificar();
		}
		
		
		
		
			
		$this->options = array();
		$this->options['idcotizacion']=$cotizacion->getCaIdcotizacion();		
		$this->options['success']=true;
		$this->setLayout("ajax");
	}
	
	
	/*
	* Anula una cotizacion 
	* @author Andres Botero
	*/
	
	public function executeAnularCotizacion(){
		$cotizacion = CotizacionPeer::retrieveByPk( $this->getRequestParameter("idcotizacion") );
		$this->forward404Unless($cotizacion);
		$cotizacion->setCaFchanulado(time());
		$cotizacion->setCaUsuanulado($this->getUser()->getUserId());
		$cotizacion->save();
		
		$tarea = $cotizacion->getTareaIDGEnvioOportuno(); 
		if( $tarea ){
			$tarea->delete();
		}
		
		$this->redirect("cotizaciones/consultaCotizacion?id=".$cotizacion->getCaIdCotizacion());	
	}
	
	/*
	* Guarda los agentes del directorio de agentes 
	* @author Andres Botero
	*/
	public function executeGuardarAgentes(){
		$cotizacion = CotizacionPeer::retrieveByPk( $this->getRequestParameter("idcotizacion") );
		$this->forward404Unless($cotizacion);
		$datosag = $this->getRequestParameter( "datosag" );
		$this->forward404Unless($datosag!==null);
		if( $datosag ){
			$cotizacion->setCaDatosAg( $datosag );
		}else{			
			$cotizacion->setCaDatosAg( null );	
		}
		$cotizacion->save();
		$this->responseArray = array("success"=>true);	
		$this->setTemplate("responseTemplate");		
		$this->setLayout("ajax");
	}
	
	/*
	* Lista de agentes para la grilla
	* @author Andres Botero
	*/
	public function executeDatosAgentes(){
		
		
		$cotizacion = CotizacionPeer::retrieveByPk( $this->getRequestParameter("idcotizacion") );
		$this->forward404Unless( $cotizacion );
		
		
		$mostrarTodos = $this->getRequestParameter("mostrarTodos");
		
		$productos = $cotizacion->getCotProductos();
		
		$lejanoOriente = false;
		if( $mostrarTodos ){
			$paises = array();
			foreach( $productos as $producto ){								
				if( $producto->getCaImpoexpo() == Constantes::IMPO ){
					$paises[] = $producto->getOrigen()->getCaIdtrafico();
					
					//Esto es debido a que China y Hong Kong estan separado y no se 
					//pueden unir por que se dañan los consecutivos de marítimo.
					if( $producto->getOrigen()->getCaIdtrafico()=="CN-086" ){
						$paises[] = "HK-852";
					}
					
					if( $producto->getOrigen()->getCaIdtrafico()=="HK-852" ){
						$paises[] = "CN-086";
					}
					
					$trafico = $producto->getOrigen()->getTrafico();
					if( $trafico->getCaIdgrupo()==6 ){
						$lejanoOriente = true;
					}
															
				}else{
					$paises[] = $producto->getDestino()->getCaIdtrafico();
				}
			}
			$paises=array_unique($paises);
		}else{
			$ciudades = array();
			
			foreach( $productos as $producto ){				
				if( $producto->getCaImpoexpo() == Constantes::IMPO ){
					$ciudades[] = $producto->getCaOrigen();
				}else{
					$ciudades[] = $producto->getCaDestino();
				}
			}
			$ciudades=array_unique($ciudades);
		}
				
		$datosag  = explode("|",$cotizacion->getCaDatosag());
		
		$c = new Criteria();	
		$c->addJoin( ContactoAgentePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE );
		if( $mostrarTodos ){
			$c->addJoin( ContactoAgentePeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );
			$criterion = $c->getNewCriterion( CiudadPeer::CA_IDTRAFICO, $paises, Criteria::IN );
					
		}else{		
			$criterion = $c->getNewCriterion( ContactoAgentePeer::CA_IDCIUDAD, $ciudades, Criteria::IN );
		}								
		$criterion->addOr($c->getNewCriterion( ContactoAgentePeer::CA_IDCONTACTO, $datosag, Criteria::IN ));	
					
		$c->add($criterion);	
			
		$c->add( ContactoAgentePeer::CA_ACTIVO, true );	
		$c->add( AgentePeer::CA_ACTIVO, true );	
		$contactos = ContactoAgentePeer::doSelect( $c );
		
		/*
		* Muestra todos los contactos de ASW 
		*/
		
		if( $lejanoOriente ){		
			$c = new Criteria();
			$c->addJoin( ContactoAgentePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE );	
			$c->addJoin( AgentePeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );		
			$c->addJoin( CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO );
			$c->add( TraficoPeer::CA_IDGRUPO, 6 );
			$c->add( AgentePeer::CA_NOMBRE, "AIR SEA WORLDWIDE%" ,Criteria::LIKE );
			$c->add( ContactoAgentePeer::CA_ACTIVO, true );	
			$c->add( AgentePeer::CA_ACTIVO, true );				
			$contactosAg = ContactoAgentePeer::doSelect( $c );
			$contactos = array_merge( $contactos, $contactosAg );
			
			
		}
		
				
		$agentes = array();
		
   		foreach ( $contactos as $contacto ) {
			$agente = $contacto->getAgente();
			$ciudad = $contacto->getCiudad();
			
			if( in_array( $contacto->getCaIdContacto(),  $datosag ) ){
				$sel = true;
			}else{
				$sel = false;
			}
			
      		$agentes[] = array( 'sel'=>$sel,
									'idcontacto'=>$contacto->getCaIdContacto(),
      								 'contacto'=>utf8_encode($contacto->getCaNombre()),
									 'agente'=>utf8_encode($agente->getCaNombre()." » ".$ciudad->getTrafico()->getCaNombre()),
									 'cargo'=>utf8_encode($contacto->getCaCargo()),
									 'telefonos'=>$contacto->getCaTelefonos(),
									 'operacion'=>utf8_encode(str_replace("|", " ", $contacto->getCaTransporte())),
									 'ciudad'=>utf8_encode($ciudad->getCaCiudad()),
									  'sugerido'=>$contacto->getCaSugerido()
      		);		
		}
		
		$this->responseArray = array("agentes"=>$agentes, "total"=>count($this->agentes), "success"=>true);
		$this->setTemplate("responseTemplate");
		$this->setLayout("ajax");
		
	}		
		
	/*
	* Permite ver una cotización en formato PDF
	* @author Andres Botero
	*/
	public function executeVerCotizacion(){
		$this->cotizacion =  CotizacionPeer::retrieveByPk( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->cotizacion );
		$c = new Criteria();
		$c->add(EmailPeer::CA_TIPO, "Envío de cotización");
		$c->add(EmailPeer::CA_IDCASO,$this->cotizacion->getCaIdCotizacion()); 
		$c->addAscendingOrderByColumn(EmailPeer::CA_FCHENVIO);
		$this->emails = EmailPeer::doSelect( $c );
		
		$config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."textos.yml";
		$textos = sfYaml::load($config);	
		$this->asunto = sprintf( $textos['asuntoEmail'], $this->cotizacion->getCaConsecutivo() );
		$this->mensaje = sprintf( $textos['mensajeEmail'], $this->cotizacion->getContacto()->getNombre(), $this->cotizacion->getCaConsecutivo() );
		
		$this->tarea = $this->cotizacion->getTareaIDGEnvioOportuno(); 
				
	}
	/*
	* Genera un archivo PDF a partir de una cotización
	* @author Andres Botero
	*/
	public function executeGenerarPDF(){
	
		
		$this->cotizacion =  CotizacionPeer::retrieveByPk( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->cotizacion );
		$this->usuario = $this->cotizacion->getUsuario();
		$this->contacto = $this->cotizacion->getContacto();
		$this->cliente = $this->contacto->getCliente();
		$this->filename=$this->getRequestParameter("filename");
		$this->notas = sfYaml::load(sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."cotizaciones".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."notas.yml");
		
		$grupos = array();
		$c = new Criteria();
		$c->add(CotProductoPeer::CA_IDCOTIZACION, $this->cotizacion->getCaIdcotizacion() );
		$c->addSelectColumn(CotProductoPeer::CA_TRANSPORTE );
		$c->addSelectColumn(CotProductoPeer::CA_MODALIDAD );		
		$c->setDistinct();
		$stmt = CotProductoPeer::doSelectStmt( $c );
		
		while ( $row = $stmt->fetch(PDO::FETCH_NUM) ) {
			$grupos[$row[0]][]=$row[1];
			$grupos[$row[0]] = array_unique( $grupos[$row[0]] );	
		}
		
		$this->grupos = $grupos;
	}
	
	
	/*
	* Envia una cotización por correo 	
	*/
	public function executeEnviarCotizacionEmail(){
		$this->cotizacion =  CotizacionPeer::retrieveByPk( $this->getRequestParameter("id") );
										
		$user = $this->getUser();
					
		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Envío de cotización" ); 		
		$email->setCaIdcaso( $this->getRequestParameter("id") );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );
		
		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
		}

		$email->setCaReplyto( $user->getEmail() );
				
		$recips = explode(",",$this->getRequestParameter("destinatario"));									
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addTo( $recip ); 
				}
			}	
		}
				
		$recips =  explode(",",$this->getRequestParameter("cc")) ;
		if( is_array($recips) ){
			foreach( $recips as $recip ){			
				$recip = str_replace(" ", "", $recip );			
				if( $recip ){
					$email->addCc( $recip ); 
				}
			}
		}
		//$mensaje = utf8_decode($this->getRequestParameter("mensaje")."\n\n");
		$mensaje = ($this->getRequestParameter("mensaje")."\n\n");
		$usuario = UsuarioPeer::retrieveByPk( $this->getUser()->getUserId() );		
				
		$email->addCc( $this->getUser()->getEmail() );					
		//$email->setCaSubject( utf8_decode($this->getRequestParameter("asunto")) );		
		$email->setCaSubject( ($this->getRequestParameter("asunto")) );		
		$email->setCaBody( $mensaje.$usuario->getFirma() );
		$email->setCaBodyhtml( Utils::replace($mensaje).$usuario->getFirmaHTML() );		
		$email->save();
		$incluirPDF = $this->getRequestParameter("incluirPDF");
		if( $incluirPDF ){
			$fileName = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."cotizacion".$this->cotizacion->getCaConsecutivo().".pdf" ;
			if(file_exists($fileName)){
				@unlink( $fileName );
			}				
			$this->getRequest()->setParameter('filename',$fileName); 
			sfContext::getInstance()->getController()->getPresentationFor( 'cotizaciones', 'generarPDF') ;	
			$fileSize = filesize($fileName);			
			$fp = fopen($fileName, "r");
			$data = fread( $fp , $fileSize);
			fclose( $fp );

		
			
			$attachment = new EmailAttachment();
			$attachment->setCaIdemail( $email->getCaIdemail() );
			$attachment->setCaContent( $data );			
			$attachment->setCaFilesize( $fileSize );
			$attachment->setCaHeaderFile( basename($fileName) );
			$attachment->save();
			@unlink( $fileName );
		}
		
		$attachments = $this->getRequestParameter("attachments");
		
		$archivos = $this->cotizacion->getCotArchivos();				
		foreach($archivos as $archivo ){	
			if( $attachments && in_array($archivo->getCaIdArchivo(),$attachments )){
				$fp = $archivo->getCaDatos();
				if ($fp !== null) {						
					$attachment = new EmailAttachment();
					$attachment->setCaIdemail( $email->getCaIdemail() );
					$attachment->setCaContent( stream_get_contents($fp) );			
					$attachment->setCaFilesize( $archivo->getCaTamano() );
					$attachment->setCaHeaderFile( $archivo->getCaNombre() );
					$attachment->save();
				}
				fclose($fp);
			}
		}
  
		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();	
		if(!$this->error){
			$tarea  = $this->cotizacion->getTareaIDGEnvioOportuno();
					
			$observaciones_idg = $this->getRequestParameter("observaciones_idg");
			
			if( $observaciones_idg!==null ){
				$tarea->setCaObservaciones( $observaciones_idg );		
			}
			if( $tarea ){			
				if( !$tarea->getCaFchterminada() ){
					$tarea->setCaFchterminada( time() );									
				}			
			}
			$tarea->save();
		}		
	}
	
	
	/*
	* Copia una cotización existente en una nueva 
	* @author: Andres Botero
	*/
	public function executeCopiarCotizacion(){
		$cotizacion = CotizacionPeer::retrieveByPk($this->getRequestParameter("idcotizacion"));
		$this->forward404Unless($cotizacion);
		
		$newCotizacion = $cotizacion->copy( false ); //La copia recursiva se hace paso a paso por que las llaves son naturales 
		$user = $this->getUser();		
		$sig = CotizacionPeer::siguienteConsecutivo( date("Y") );			
		$newCotizacion->setCaConsecutivo( $sig ); 
		//$newCotizacion->setCaFchpresentacion(null);
		$newCotizacion->setCaIdgEnvioOportuno(null);
		$newCotizacion->setCaFchpresentacion(null);
		$newCotizacion->setCaHorasolicitud(null);
		$newCotizacion->setCaFchsolicitud(null);		
		$newCotizacion->setCaFchcreado( time() );
		$newCotizacion->setCaUsucreado( $user->getUserId() );
		$newCotizacion->setCaFchactualizado( null );
		$newCotizacion->setCaUsuactualizado( null );
		
	
		$newCotizacion->save();
		
		$productos = $cotizacion->getCotProductos();
		foreach( $productos as $producto ){
			$newProducto = $producto->copy( false );
			$newProducto->setCaIdCotizacion( $newCotizacion->getCaIdCotizacion() );			
			$newProducto->save();
						
			$opciones = $producto->getCotOpciones();
			foreach( $opciones as $opcion ){				
				$newOpcion = $opcion->copy( false );
				$newOpcion->setCaIdCotizacion( $newCotizacion->getCaIdCotizacion() );
				$newOpcion->setCaIdProducto( $newProducto->getCaIdProducto() );
				$newOpcion->save();
				
				$recargos = $opcion->getCotRecargos( );
				foreach( $recargos as $recargo ){	
					$newRecargo = $recargo->copy( false );
					$newRecargo->setCaIdCotizacion( $newCotizacion->getCaIdCotizacion() );
					$newRecargo->setCaIdProducto( $newProducto->getCaIdProducto() );
					$newRecargo->setCaIdOpcion( $newOpcion->getCaIdOpcion() );
					$newRecargo->setCaIdConcepto( $recargo->getCaIdConcepto() );
					$newRecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
					$newRecargo->setCaModalidad( $recargo->getCaModalidad() );
					$newRecargo->save();
				}			
			}	
			
			$recargos = $producto->getRecargosGenerales();		
						
			
			foreach( $recargos as $recargo ){	
				
				$newRecargo = $recargo->copy( false );
				$newRecargo->setCaIdCotizacion( $newCotizacion->getCaIdCotizacion() );
				$newRecargo->setCaIdProducto(  $newProducto->getCaIdProducto() );
				$newRecargo->setCaIdOpcion( $recargo->getCaIdOpcion() );
				$newRecargo->setCaIdConcepto( $recargo->getCaIdConcepto() );
				$newRecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
				$newRecargo->setCaModalidad( $recargo->getCaModalidad() );
				$newRecargo->save();
				
				
			}
			
		}
		
		$recargos = $cotizacion->getRecargosLocales();
		foreach( $recargos as $recargo ){	
			$newRecargo = $recargo->copy( false );
			$newRecargo->setCaIdCotizacion( $newCotizacion->getCaIdCotizacion() );
			$newRecargo->setCaIdProducto( $recargo->getCaIdProducto() );
			$newRecargo->setCaIdOpcion( $recargo->getCaIdOpcion() );
			$newRecargo->setCaIdConcepto( $recargo->getCaIdConcepto() );
			$newRecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
			$newRecargo->setCaModalidad( $recargo->getCaModalidad() );
			$newRecargo->save();
		}	
		
			
			
		$seguros = $cotizacion->getCotSeguros();
		foreach( $seguros as $seguro ){	
			$newSeguro = $seguro->copy( false );
			$newSeguro->setCaIdCotizacion( $newCotizacion->getCaIdCotizacion() );
			$newSeguro->save();
		}
		
		$continuaciones = $cotizacion->getCotContinuacions();
		foreach( $continuaciones as $continuacion ){	
			$newContinuacion = $continuacion->copy( false );			
			$newContinuacion->setCaIdCotizacion( $newCotizacion->getCaIdCotizacion() );			
			$newContinuacion->save();	
					
		}
				
		$this->redirect("cotizaciones/consultaCotizacion?id=".$newCotizacion->getCaIdCotizacion());				
	}
	
	/*************************************************************************
	* GRILLA PRODUCTOS (TRAYECTOS)
	*
	**************************************************************************/
		
	/*
	* Guarda los cambios realizados a Productos  
	* @author Carlos G. López M.
	*/
	public function executeFormProductoGuardar(){
		$user_id = $this->getUser()->getUserId();

		if( $this->getRequestParameter("idproducto") ){
			$producto = CotProductoPeer::retrieveByPk( $this->getRequestParameter("idproducto"), $this->getRequestParameter("cotizacionId") );
			$this->forward404Unless( $producto );
		}else{		
			$producto = new CotProducto();
			$producto->setCaIdcotizacion( $this->getRequestParameter("cotizacionId") );
		}

		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$transporte= utf8_decode($this->getRequestParameter("transporte"));
	
		$producto->setCaProducto( utf8_decode($this->getRequestParameter("producto")) );
		$producto->setCaImpoexpo( $impoexpo );
		$producto->setCaTransporte( $transporte );
		$producto->setCaModalidad( $this->getRequestParameter("modalidad") );
		$producto->setCaIncoterms( $this->getRequestParameter("incoterms") );
		$producto->setCaOrigen( $this->getRequestParameter("ciu_origen") );
		if( $this->getRequestParameter("ciu_escala") ){ 
			$producto->setCaEscala( $this->getRequestParameter("ciu_escala") );
		}		
		$producto->setCaDestino( $this->getRequestParameter("ciu_destino") );
		$producto->setCaFrecuencia( utf8_decode($this->getRequestParameter("frecuencia")) );
		$producto->setCaTiempotransito( utf8_decode($this->getRequestParameter("ttransito")) );
		$producto->setCaObservaciones( utf8_decode($this->getRequestParameter("observaciones")) );
		$producto->setCaImprimir( $this->getRequestParameter("imprimir") );
		if( !$producto->getCaIdProducto() ){ 
			$producto->setCaFchcreado( time() );	
			$producto->setCaUsucreado( $user_id );			
		}else{
			$producto->setCaFchactualizado( time() );	
			$producto->setCaUsuactualizado( $user_id );							
		}
		
		if( $this->getRequestParameter("idlinea") ){ 
			$producto->setCaIdlinea( $this->getRequestParameter("idlinea") );
		}
		
		$producto->setCaPostularLinea( $this->getRequestParameter("postular_linea") );
		
		
		$producto->save();
		return sfView::NONE;
	}
	
	
	
	
	/**
	* Permite actualizar en linea los cambios en los campos de productos 
	* de una cotización
	* @author Carlos G. López M.
	*/
	public function executeObserveProductos(){
		$producto = CotProductoPeer::retrieveByPk( $this->getrequestparameter("cotizacionId"), $this->getrequestparameter("productoId") );
		$this->forward404Unless($producto);	
		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$transporte= utf8_decode($this->getRequestParameter("transporte"));

		if( $this->getRequestParameter("impoexpo") ){
			$producto->setCaImpoexpo( $impoexpo );

		}else if($this->getRequestParameter("incoterms")) {
			$producto->setCaIncoterms( $this->getRequestParameter("incoterms") );

		}else if($this->getRequestParameter("transporte")) {
			$producto->setCaTransporte( $transporte );

		}else if($this->getRequestParameter("modalidad")) {
			$producto->setCaModalidad( $this->getRequestParameter("modalidad") );
		}
		$producto->save();	
		return sfView::NONE;
	}
	
	/**
	* Permite actualizar en linea los cambios en los campos de opciones y
	* recargos en origen de una cotización
	* @author Andres Botero
	*/
	public function executeObserveItemsOpciones(){
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		$idproducto = $this->getRequestParameter("idproducto");
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		$idopcion = $this->getRequestParameter("idopcion");
		$idmoneda = $this->getRequestParameter("idmoneda");
		$valor_tar = $this->getRequestParameter("valor_tar");
		$valor_min = $this->getRequestParameter("valor_min");
		$aplica_tar = utf8_decode($this->getRequestParameter("aplica_tar"));
		$aplica_min = utf8_decode($this->getRequestParameter("aplica_min"));
		$observaciones = utf8_decode($this->getRequestParameter("detalles"));
		$consecutivo = $this->getRequestParameter("consecutivo"); //Consecutivo tarifario
		
		$tipo = $this->getRequestParameter("tipo");
		$id = $this->getRequestParameter("id");
		$parent = $this->getRequestParameter("parent");
		
		$this->responseArray = array("id"=>$id);
			
		if( $tipo=="concepto" && $this->getRequestParameter("iditem")!=9999 ){
			$iditem = $this->getRequestParameter("iditem");
			
			if( !$idopcion ){						
				$opcion = new CotOpcion();
				$opcion->setCaIdCotizacion( $idcotizacion );
				$opcion->setCaIdProducto( $idproducto );
				$opcion->setCaFchcreado( time() );
				$opcion->setCaUsucreado( $this->getUser()->getUserId() );
				$opcion->setCaValorTar( 0 );
				$opcion->setCaValorMin( 0 );	
				
			}else{		
				$opcion = CotOpcionPeer::retrieveByPk( $idopcion, $idcotizacion, $idproducto );
				$this->forward404Unless( $opcion );					
				$opcion->setCaFchactualizado( time() );
				$opcion->setCaUsuactualizado( $this->getUser()->getUserId() );		
			}			
			
			if( $iditem ){	
				$opcion->setCaIdConcepto( $iditem );
			}				
			
			if( $idmoneda ){	
				$opcion->setCaIdMoneda( $idmoneda );
			}
			if( $valor_tar!==null ){
				$opcion->setCaValorTar( $valor_tar );
			}
			
			if( $valor_min!==null ){
				$opcion->setCaValorMin( $valor_min );
			}
			
			if( $aplica_tar ){
				$opcion->setCaAplicaTar( $aplica_tar );
			}
			
			if( $aplica_min ){
				$opcion->setCaAplicaMin( $aplica_min );
			}
			
			if( $observaciones!==null ){
				$opcion->setCaObservaciones( $observaciones );				
			}	
			
			if( $consecutivo ){
				$opcion->setCaConsecutivo( $consecutivo );
			}
			$opcion->save();			
			$this->responseArray["idopcion"]=$opcion->getCaIdopcion();
			$_SESSION['idopcion_'.$id] = $opcion->getCaIdopcion();
			
		}
		if( $tipo=="recargo" ){
			
			$iditem = $this->getRequestParameter("iditem");			
			$idconcepto = $this->getRequestParameter("idconcepto");			
			$modalidad = $this->getRequestParameter("modalidad");
			
			if( $idconcepto==9999 ){
				$idopcion = 999;	
			}else{
				if( !$idopcion ){
					/*
					* Se hace una peticion AJAX, se actualiza el campo idopcion del concepto, pero 
					* como es asincronica idopcion en el recargo ya se ha enviado vacio, 
					* luego se guarda en una variable de sesio n para saber a que concepto pertenece.
					* Solo aplica cuando se esta creando un concepto nuevo.
					*/					
					if(!isset($_SESSION['idopcion_'.$parent])){ //es posible que llegue primero el recargo que el concepto.
						sleep(10); 
					}
					$idopcion = $_SESSION['idopcion_'.$parent]; 					
				}
			}
			$this->responseArray["idopcion"]=$idopcion;
					
			$recargo = CotRecargoPeer::retrieveByPk( $idcotizacion, $idproducto, $idopcion, $idconcepto, $iditem, $modalidad );
						
			if( !$recargo ){			
				$recargo = new CotRecargo();			
				$recargo->setCaFchcreado( time() );
				$recargo->setCaUsucreado( $this->getUser()->getUserId() );			
				$recargo->setCaIdCotizacion( $idcotizacion );
				$recargo->setCaIdProducto( $idproducto );					
				$recargo->setCaIdConcepto( $idconcepto );
				$recargo->setCaIdOpcion( $idopcion );	
				$recargo->setCaIdRecargo( $iditem );
				$recargo->setCaModalidad( $modalidad );
				$recargo->setCaValorTar( 0 );
				$recargo->setCaValorMin( 0 );
			}else{
				$recargo->setCaFchactualizado( time() );
				$recargo->setCaUsuactualizado( $this->getUser()->getUserId() );		
			}		
				
			$recargo->setCaTipo( "$" ); //FIX-ME
			if( $idmoneda ){	
				$recargo->setCaIdMoneda( $idmoneda );
			}
			if( $valor_tar!==null ){
				$recargo->setCaValorTar( $valor_tar );
			}
			
			if( $valor_min!==null ){
				$recargo->setCaValorMin( $valor_min );
			}
			
			if( $aplica_tar ){
				$recargo->setCaAplicaTar( $aplica_tar );
			}
			
			if( $aplica_min ){
				$recargo->setCaAplicaMin( $aplica_min );
			}	
			
			if( $observaciones!==null ){
				if( $observaciones ){
					$recargo->setCaObservaciones( $observaciones );
				}else{
					$recargo->setCaObservaciones( null );				
				}
			}	
			
			if( $consecutivo ){
				$recargo->setCaConsecutivo( $consecutivo );
			}								
			$recargo->save();	
		}
		$this->setTemplate("responseTemplate");	
		$this->setLayout("ajax");
	}
	
	/*
	* Muestra los datos de la grilla de prooductos del componente grillaProductos
	*/
	public function executeGrillaProductosData(){
		$id = $this->getRequestParameter("idcotizacion");
		$c = new Criteria();		
		$c->add( CotProductoPeer::CA_IDCOTIZACION , $id );
		$c->addAscendingOrderByColumn( CotProductoPeer::CA_IDPRODUCTO );
		$cotProductos = CotProductoPeer::doSelect($c);
				
		$this->productos = array();
		
		$i=1000;		
		foreach( $cotProductos as $producto ){
			$j=0;
			$origen = $producto->getOrigen();
			$destino = $producto->getDestino();
			$escala = $producto->getEscala();					
			
			$linea = $producto->getTransportador();
				
			if( $linea ){
				$lineaStr = $linea->getCaNombre();
			}else{
				$lineaStr = "";
			}
			
			$trayecto = utf8_encode($producto->getCaImpoExpo())." ".utf8_encode($producto->getCaTransporte())." ".utf8_encode($producto->getCaModalidad())." [".utf8_encode( $origen->getCaCiudad() )." - ".utf8_encode($origen->getTrafico()->getCaNombre()." » ");
			
			if( $escala ){
				$trayecto .= utf8_encode($escala->getCaCiudad())." - ".utf8_encode($escala->getTrafico()->getCaNombre()." » ");
			}
			
			$trayecto .= utf8_encode($destino->getCaCiudad())." - ".utf8_encode($destino->getTrafico()->getCaNombre())."]  ".$lineaStr." ".$producto->getCaIdproducto();
						
			//Se envian las opciones existentes
			$c = new Criteria();
			$c->add( CotOpcionPeer::CA_IDPRODUCTO, $producto->getCaIdProducto() );
			$opciones = $producto->getCotOpciones( $c );
			
			
			
			$baseRow = array(
		 					 'trayecto'=>$trayecto,
							 'idproducto'=>$producto->getCaIdProducto(),
							 'producto'=>utf8_encode($producto->getCaProducto()),
							 'idcotizacion'=>$producto->getCaIdCotizacion(),
							 'tra_origen'=>$origen->getCaIdTrafico(),
							 'tra_origen_value'=>utf8_encode($origen->getTrafico()->getCaNombre()),
							 'ciu_origen'=>$origen->getCaIdCiudad(),
							 'ciu_origen_value'=>utf8_encode($origen->getCaCiudad()),
							 'tra_destino'=>$destino->getCaIdTrafico(),
							 'tra_destino_value'=>utf8_encode($destino->getTrafico()->getCaNombre()),
							 'ciu_destino'=>$destino->getCaIdCiudad(),
							 'ciu_destino_value'=>utf8_encode($destino->getCaCiudad()),
							 'tra_escala'=>$escala?$escala->getCaIdTrafico():"",
							 'tra_escala_value'=>$escala?utf8_encode($escala->getTrafico()->getCaNombre()):"",
							 'ciu_escala'=>$escala?$escala->getCaIdCiudad():"",
							 'ciu_escala_value'=>$escala?utf8_encode($escala->getCaCiudad()):"",
							 'transporte'=>utf8_encode($producto->getCaTransporte()),
							 'modalidad'=>utf8_encode($producto->getCaModalidad()),
							 'impoexpo'=>utf8_encode($producto->getCaImpoexpo()),
							 'incoterms'=>utf8_encode($producto->getCaIncoterms()),
							 'frecuencia'=>utf8_encode($producto->getCaFrecuencia()),
							 'ttransito'=>utf8_encode($producto->getCaTiempotransito()),
							 'imprimir'=>utf8_encode($producto->getCaImprimir()),
							 'observaciones'=>utf8_encode($producto->getCaObservaciones()),
							 'idlinea'=>$producto->getCaIdlinea(),
							 'linea'=>utf8_encode($lineaStr),
							 'postular_linea'=>	$producto->getCaPostularLinea(),
							 'id'=>$i
							 
						);
						
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();
				$row = $baseRow;
				$row['idopcion']=$opcion->getCaIdOpcion();
				$row['iditem']=$opcion->getCaIdConcepto();
				$row['item']=utf8_encode($concepto->getCaConcepto());
				$row['valor_tar']=$opcion->getCaValorTar();
				$row['aplica_tar']=utf8_encode($opcion->getCaAplicaTar());
				$row['valor_min']=$opcion->getCaValorMin();
				$row['aplica_min']=utf8_encode($opcion->getCaAplicaMin());
				$row['idmoneda']=$opcion->getCaIdmoneda();
				$row['detalles']=utf8_encode($opcion->getCaObservaciones());
				$row['tipo']="concepto";
				$row['id']+=$j++;
				$row['orden']=$row['id'];
				$row['parent']=$row['id'];
				
				$parent = $row['id'];		
				$this->productos[] = $row;
				 //Se muestran los recargos 
				$recargos = $opcion->getCotRecargos();

				foreach( $recargos as $recargo ){
					$tipoRecargo = $recargo->getTipoRecargo();
					
					$row = $baseRow;
					$row['idopcion']=$opcion->getCaIdOpcion();
					$row['iditem']=$tipoRecargo->getCaIdRecargo();
					$row['item']=utf8_encode($tipoRecargo->getCaRecargo());
					$row['idconcepto']=$recargo->getCaIdConcepto();
					$row['valor_tar']=$recargo->getCaValorTar();
					$row['aplica_tar']=utf8_encode($recargo->getCaAplicaTar());
					$row['valor_min']=$recargo->getCaValorMin();
					$row['aplica_min']=utf8_encode($recargo->getCaAplicaMin());
					$row['idmoneda']=$recargo->getCaIdmoneda();
					$row['detalles']=utf8_encode($recargo->getCaObservaciones());
					$row['tipo']="recargo";		
					$row['id']+=$j++;	
					$row['parent']=$parent;	
					$row['orden']=$parent."-".$row['id'];
					$this->productos[] = $row;				
				}	
				$j+=20;			 
			}
			
			$recargos = $producto->getRecargosGenerales();		
			
			if( count($recargos)>0 ){
				$row = $baseRow;
				$row['idopcion']=999;
				$row['iditem']=9999;
				$row['item']="Recargos Generales del trayecto";
				$row['idconcepto']=9999;
				$row['valor_tar']='';
				$row['aplica_tar']='';
				$row['valor_min']='';
				$row['aplica_min']='';
				$row['idmoneda']='';
				$row['detalles']='';
				$row['tipo']="concepto";
				$row['id']+=$j++;	
				$row['orden']=$row['id'];						
				$parent = $row['id'];		
				$this->productos[] = $row;									
			}
				
			foreach( $recargos as $recargo ){
				$tipoRecargo = $recargo->getTipoRecargo();				
					
				$row = $baseRow;
				$row['idopcion']=$recargo->getCaIdOpcion();
				$row['iditem']=$tipoRecargo->getCaIdRecargo();
				$row['item']=utf8_encode($tipoRecargo->getCaRecargo());
				$row['idconcepto']=$recargo->getCaIdConcepto();
				$row['valor_tar']=$recargo->getCaValorTar();
				$row['aplica_tar']=utf8_encode($recargo->getCaAplicaTar());
				$row['valor_min']=$recargo->getCaValorMin();
				$row['aplica_min']=utf8_encode($recargo->getCaAplicaMin());
				$row['idmoneda']=$recargo->getCaIdmoneda();
				$row['detalles']=utf8_encode($recargo->getCaObservaciones());
				$row['tipo']="recargo";			
				$row['id']+=$j++;	
				$row['parent']=$parent;	
				$row['orden']=$parent."-".$row['id'];
				$this->productos[] = $row;					
			}
			$j+=20;
			//Se envia una fila vacia por cada grupo para agregar una nueva opción  
			$row = $baseRow;
			$row['idopcion']="";
			$row['iditem']="";
			$row['item']="+";
			$row['idconcepto']="";
			$row['valor_tar']="";
			$row['aplica_tar']="";
			$row['valor_min']="";
			$row['aplica_min']="";
			$row['idmoneda']="";
			$row['detalles']="";
			$row['tipo']="concepto";	
			$row['id']+=$j++;	
			$row['orden']="9999-9999";					
			$j+=20;
			$this->productos[] = $row;
			$i+=1000;
		}	
	}
	
	/*
	* Permite eliminar un producto 
	* @author: Andres Botero
	*/
	public function executeEliminarProducto(){
		$idproducto = $this->getRequestParameter("idproducto");
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		if( $idproducto && $idcotizacion ){
			$producto = CotProductoPeer::retrieveByPk($idproducto, $idcotizacion);
			if( $producto ){
				$opciones = $producto->getCotOpcions();
				foreach( $opciones as $opcion ){							
					if( $opcion ){
						$recargos = $opcion->getCotRecargos();
						foreach( $recargos as $recargo ){
							$recargo->delete();				
						}
						$opcion->delete();
					}
				}
				
				$recGenerales = $producto->getRecargosGenerales();
				foreach( $recGenerales as $recargo ){
					$recargo->delete();				
				}				
				$producto->delete(); 
				
				
			}			
			
		}
		return sfView::NONE;	
	}
	
	
	/*
	* Permite eliminar un item dentro de la cotizacion  
	* @author: Andres Botero
	*/
	public function executeEliminarItemsOpciones(){
		$tipo = $this->getRequestParameter("tipo");
		$idconcepto = $this->getRequestParameter("idconcepto");
		$idrecargo = $this->getRequestParameter("idrecargo");
		$idopcion = $this->getRequestParameter("idopcion");
		$idproducto = $this->getRequestParameter("idproducto");
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		$modalidad = $this->getRequestParameter("modalidad");
		if( $idopcion && $idcotizacion && $idproducto  ){				
			if( $tipo=="concepto" ){
				if( $idopcion==999 ){
					$c = new Criteria();
					$c->add( CotRecargoPeer::CA_IDCOTIZACION, $idcotizacion );
					$c->add( CotRecargoPeer::CA_IDPRODUCTO, $idproducto );
					$c->add( CotRecargoPeer::CA_IDOPCION, $idopcion );
					$c->add( CotRecargoPeer::CA_IDCONCEPTO, 9999 );
					$c->add( CotRecargoPeer::CA_MODALIDAD, $modalidad );
					$recargos = CotRecargoPeer::doSelect( $c );
					foreach( $recargos as $recargo ){
						$recargo->delete();
					}
				}else{
					$opcion = CotOpcionPeer::retrieveByPk($idopcion, $idcotizacion, $idproducto );
					if( $opcion ){
						$recargos = $opcion->getCotRecargos();
						foreach( $recargos as $recargo ){
							$recargo->delete();				
						}
						$opcion->delete();
					}
				}
			}
			
			if( $tipo=="recargo" &&  $idconcepto && $idrecargo ){
				
				$recargo = CotRecargoPeer::retrieveByPk( $idcotizacion, $idproducto, $idopcion, $idconcepto, $idrecargo, $modalidad );
				
				if( $recargo ){					
					$recargo->delete();
				}
			}
		}
		return sfView::NONE;		
	}
	
	/*************************************************************************
	* RECARGOS LOCALES
	*
	**************************************************************************/
	
		
	/*
	* Guarda los cambios realizados a Recargos locales  
	* @author Carlos G. López M., Andres Botero
	*/
	public function executeFormRecargoGuardar(){
		$user_id = $this->getUser()->getUserId();
		$update = true;
		
		$id = $this->getRequestParameter("id");
														
		$idproducto = '99';
		$idopcion = '999';
		$idconcepto = '9999';
		
		$recargo = CotRecargoPeer::retrieveByPk( $this->getRequestParameter("idcotizacion"), $idproducto, $idopcion, $idconcepto, $this->getRequestParameter("idrecargo"), $this->getRequestParameter("modalidad") );
		
		if( !$recargo ){
			$update = false;
			$recargo = new CotRecargo();
			$recargo->setCaIdCotizacion( $this->getRequestParameter("idcotizacion") );
			$recargo->setCaIdProducto( $idproducto );
			$recargo->setCaIdOpcion( $idopcion );
			$recargo->setCaIdConcepto( $idconcepto );
			$recargo->setCaModalidad( $this->getRequestParameter("modalidad") );
			$recargo->setCaValorTar( 0 );
			$recargo->setCaValorMin( 0 );
		}
		

		if( $this->getRequestParameter("idrecargo") ){
			$recargo->setCaIdRecargo( $this->getRequestParameter("idrecargo") );
		}
		$recargo->setCaTipo( "$" ); //FIX-ME
		/*if( $this->getRequestParameter("tiporecargo") ){
			$recargo->setCaTipo( $this->getRequestParameter("tiporecargo") );
		}*/
		
		if( $this->getRequestParameter("valor_tar")!==null ){
			$recargo->setCaValorTar( $this->getRequestParameter("valor_tar") );
		}
		
		if( $this->getRequestParameter("aplica_tar") ){
			$recargo->setCaAplicaTar( utf8_decode($this->getRequestParameter("aplica_tar")) );
		}
		
		if( $this->getRequestParameter("valor_min")!==null ){
			$recargo->setCaValorMin( $this->getRequestParameter("valor_min") );
		}
		
		if( $this->getRequestParameter("aplica_min") ){
			$recargo->setCaAplicaMin( utf8_decode($this->getRequestParameter("aplica_min")) );
		}
		
		if( $this->getRequestParameter("idmoneda") ){
			$recargo->setCaIdMoneda( $this->getRequestParameter("idmoneda") );
		}
		
		if( $this->getRequestParameter("observaciones") ){
			$recargo->setCaObservaciones( $this->getRequestParameter("observaciones") );
		}
		
		if( !$update ){ 
			$recargo->setCaFchcreado( time() );	
			$recargo->setCaUsucreado( $user_id );			
		}else{
			$recargo->setCaFchactualizado( time() );	
			$recargo->setCaUsuactualizado( $user_id );							
		}

		$recargo->save();
		
		$this->responseArray = array("id"=>$id);
		$this->setTemplate("responseTemplate");
		$this->setLayout("ajax");	
	}
	
	/*
	* Muestra los datos de los recargos locales
	* @author Andres Botero
	*/
	public function executeDatosGrillaRecargos(){
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		$this->forward404unless( $idcotizacion );
		$tipo = Constantes::RECARGO_LOCAL;
		
		/*
		* Es necesario determinar cuales son los grupos que se deben mostrar de acuerdo 
		* a los trayectos que hay en la cotización
		*/
		$grupos = array();
		$c = new Criteria();
		$c->add(CotProductoPeer::CA_IDCOTIZACION, $idcotizacion );
		$c->addSelectColumn(CotProductoPeer::CA_TRANSPORTE );
		$c->addSelectColumn(CotProductoPeer::CA_MODALIDAD );		
		$c->setDistinct();
		$stmt = CotProductoPeer::doSelectStmt( $c );
		
		while ( $row = $stmt->fetch(PDO::FETCH_NUM) ) {
			$grupos[$row[0]][]=$row[1];
			$grupos[$row[0]] = array_unique( $grupos[$row[0]] );	
		}
		
		
		/*
		* Incluye grupos para los recargos que ya se han creado
		*/
		$c = new Criteria();		
		$c->addJoin( CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO, Criteria::LEFT_JOIN );		
		$c->add( CotRecargoPeer::CA_IDCOTIZACION , $idcotizacion );
		$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
		
		$c->addSelectColumn( TipoRecargoPeer::CA_TRANSPORTE );
		$c->addSelectColumn( CotRecargoPeer::CA_MODALIDAD );
		$c->setDistinct();
		$stmt = CotRecargoPeer::doSelectStmt( $c );
		
		
		while ( $row = $stmt->fetch(PDO::FETCH_NUM) ) {
			$grupos[$row[0]][]=$row[1];
			$grupos[$row[0]] = array_unique( $grupos[$row[0]] );			
		}
		
		//Recargos de OTM-DTA
		
		$tipo = Constantes::RECARGO_OTM_DTA;
		$c = new Criteria();				
		$c->add( CotContinuacionPeer::CA_IDCOTIZACION , $idcotizacion );				
		$c->addSelectColumn( CotContinuacionPeer::CA_TIPO );		
		$c->setDistinct();
		$stmt = CotContinuacionPeer::doSelectStmt( $c );
		
		
		while ( $row = $stmt->fetch(PDO::FETCH_NUM) ) {
			$grupos[Constantes::TERRESTRE][]=$row[0];
			$grupos[Constantes::TERRESTRE] = array_unique( $grupos[Constantes::TERRESTRE] );			
		}
		
		$this->recargos=array();
		
		$id=100;	
		
		foreach( $grupos as $transporte=>$modalidades ){
			
			foreach( $modalidades as $modalidad  ){
				
				
				$agrupamiento = utf8_encode($transporte." ".$modalidad);
				
				$c = new Criteria();		
				$c->addJoin( CotRecargoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO, Criteria::LEFT_JOIN );		
				$c->add( CotRecargoPeer::CA_IDCOTIZACION , $idcotizacion );
				$c->add( CotRecargoPeer::CA_MODALIDAD , $modalidad );
				$c->add( TipoRecargoPeer::CA_TIPO , Constantes::RECARGO_LOCAL );
				$c->addOr( TipoRecargoPeer::CA_TIPO , Constantes::RECARGO_OTM_DTA );
				$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte );
				
				$c->addAscendingOrderbyColumn( TipoRecargoPeer::CA_TRANSPORTE );
				$c->addAscendingOrderbyColumn( TipoRecargoPeer::CA_RECARGO );
				
				$recargos = CotRecargoPeer::doSelect( $c );
				$j=0;
				foreach( $recargos as $recargo ){
							 
					$tipoRecargo = $recargo->getTipoRecargo();
					$this->recargos[] = array( 'id'=>$id+($j++),
												'idcotizacion'=>$idcotizacion,
												'agrupamiento'=>$agrupamiento,
												'transporte'=>utf8_encode($transporte),
												'idrecargo'=>$recargo->getCaIdrecargo(),
												
												'recargo'=>utf8_encode($tipoRecargo->getCaRecargo()),      
												'valor_tar'=>$recargo->getCaValorTar(),
												'aplica_tar'=>utf8_encode($recargo->getCaAplicaTar()),
												'valor_min'=>$recargo->getCaValorMin(),
												'aplica_min'=>utf8_encode($recargo->getCaAplicaMin()),
												'idmoneda'=>$recargo->getCaIdMoneda(),
												'modalidad'=>$modalidad,
												'observaciones'=>utf8_encode($recargo->getCaObservaciones()));
				} 	
				
				/*
				* Crea una fila vacia para agregar productos en cada trayecto
				*/
				$this->recargos[] = array( 'id'=>$id+($j++),
											'idcotizacion'=>$idcotizacion,
											'agrupamiento'=>$agrupamiento,
											'transporte'=>utf8_encode($transporte),
											'idrecargo'=>'',
											
											'recargo'=>'+',      
											'valor_tar'=>'',
											'aplica_tar'=>'',
											'valor_min'=>'',
											'aplica_min'=>'',
											'idmoneda'=>'',
											'modalidad'=>utf8_encode($modalidad),
											'observaciones'=>''

											);
				$id+=100;	
			}
			
			
		}				
	}
	
	/*
	* Permite eliminar un recargo local dentro de la cotización  
	* @author: Andres Botero
	*/
	public function executeEliminarRecargo(){
		
		$idconcepto = 9999;
		$idrecargo = $this->getRequestParameter("idrecargo");
		$idopcion = 999;
		$idproducto = 99;
		$idcotizacion = $this->getRequestParameter("idcotizacion");
		$modalidad = $this->getRequestParameter("modalidad");
		
		if( $idrecargo  ){				
			$recargo = CotRecargoPeer::retrieveByPk( $idcotizacion, $idproducto, $idopcion, $idconcepto, $idrecargo, $modalidad );
			
			if( $recargo ){
				$recargo->delete();
			}
			
		}
		return sfView::NONE;		
	}
	/*************************************************************************
	* CONTINUACION DE VIAJE 
	*
	**************************************************************************/
	
	/*
	* Guarda los cambios realizados a Continuación de Viaje  
	* @author Carlos G. López M.
	*/
	public function executeFormContViajeGuardar(){
		$user_id = $this->getUser()->getUserId();
		$update = true;
		$continuacion=null;
		if( $this->getRequestParameter("idcontinuacion") ){
			$continuacion = CotContinuacionPeer::retrieveByPk( $this->getRequestParameter("idcontinuacion") );		
		}
		if ( !$continuacion ) {
				$update = false;
				$continuacion = new CotContinuacion();
				$continuacion->setCaIdCotizacion( $this->getRequestParameter("cotizacionId") );
		}
		
		if( $this->getRequestParameter("tipo") ){
			$continuacion->setCaTipo( $this->getRequestParameter("tipo") );
		}
		
		if( $this->getRequestParameter("modalidad") ){
			$continuacion->setCaModalidad( $this->getRequestParameter("modalidad") );
		}
		
		if( $this->getRequestParameter("origen") ){
			$continuacion->setCaOrigen( $this->getRequestParameter("origen") );
		}
		
		if( $this->getRequestParameter("destino") ){
			$continuacion->setCaDestino( $this->getRequestParameter("destino") );
		}
		
		if( $this->getRequestParameter("idconcepto") ){
			$continuacion->setCaIdConcepto( $this->getRequestParameter("idconcepto") );
		}
		
		if( $this->getRequestParameter("idequipo") ){
			$continuacion->setCaIdEquipo( $this->getRequestParameter("idequipo") );
		}
				
		if( $this->getRequestParameter("valor_tar") ){
			$continuacion->setCaValorTar( $this->getRequestParameter("valor_tar") );
		}

		if( $this->getRequestParameter("valor_min") ){
			$continuacion->setCaValorMin( $this->getRequestParameter("valor_min") );
		}
		
		if( $this->getRequestParameter("idmoneda") ){
			$continuacion->setCaIdMoneda( $this->getRequestParameter("idmoneda") );
		}
		
		if( $this->getRequestParameter("frecuencia")!==null ){
			$continuacion->setCaFrecuencia( utf8_decode($this->getRequestParameter("frecuencia")) );
		}
		
		if( $this->getRequestParameter("ttransito")!==null ){
			$continuacion->setCaTiempoTransito( utf8_decode($this->getRequestParameter("ttransito")) );
		}
		
		if( $this->getRequestParameter("observaciones")!==null ){
			if( $this->getRequestParameter("observaciones") ){
				$continuacion->setCaObservaciones( utf8_decode($this->getRequestParameter("observaciones")) );
			}else{
				$continuacion->setCaObservaciones( null );
			}
		}
		
		if( !$update ){ 
			$continuacion->setCaFchcreado( time() );
			$continuacion->setCaUsucreado( $user_id );
		}else{
			$continuacion->setCaFchactualizado( time() );
			$continuacion->setCaUsuactualizado( $user_id );		
		}

		$continuacion->save();
		
		$this->responseArray = array( "id"=>$this->getRequestParameter("id"), "idcontinuacion"=>$continuacion->getCaIdcontinuacion() );		
		$this->setTemplate("responseTemplate");
		$this->setLayout("ajax");				
	}
	
	
	public function executeEliminarContViaje(){
	
		$continuacion = CotContinuacionPeer::retrieveByPk( $this->getRequestParameter("idcontinuacion") );	
		$this->forward404Unless( $continuacion );
		
		$continuacion->delete();		
				
		$this->responseArray = array("id"=>$this->getRequestParameter("id"));
		$this->setTemplate("responseTemplate");
		$this->setLayout("ajax");	
	}
	
	
	/*
	* Devuelve los datos para la grilla de OTM/DTA 
	*/
	public function executeDatosContinuacionViaje(){
		
		$id = $this->getRequestParameter("idcotizacion");
		$c = new Criteria();

		$c->addAlias('c_org', CiudadPeer::TABLE_NAME);
		$c->addAlias('c_dst', CiudadPeer::TABLE_NAME);
		$c->addAlias('concepto', ConceptoPeer::TABLE_NAME);
		$c->addAlias('equipo', ConceptoPeer::TABLE_NAME);
		
		$c->addSelectColumn(CotContinuacionPeer::CA_IDCOTIZACION );
		$c->addSelectColumn(CotContinuacionPeer::CA_TIPO );
		$c->addSelectColumn(CotContinuacionPeer::CA_MODALIDAD );
		$c->addSelectColumn(CotContinuacionPeer::CA_ORIGEN );
		$c->addSelectColumn("c_org.ca_ciudad");
		$c->addSelectColumn(CotContinuacionPeer::CA_DESTINO );
		$c->addSelectColumn("c_dst.ca_ciudad");
		$c->addSelectColumn(CotContinuacionPeer::CA_IDCONCEPTO );
		$c->addSelectColumn("concepto.ca_concepto");
		$c->addSelectColumn(CotContinuacionPeer::CA_IDEQUIPO );
		$c->addSelectColumn("equipo.ca_concepto");
		$c->addSelectColumn(CotContinuacionPeer::CA_VALOR_TAR );
		$c->addSelectColumn(CotContinuacionPeer::CA_VALOR_MIN );
		$c->addSelectColumn(CotContinuacionPeer::CA_IDMONEDA );
		$c->addSelectColumn(CotContinuacionPeer::CA_FRECUENCIA );
		$c->addSelectColumn(CotContinuacionPeer::CA_TIEMPOTRANSITO );
		$c->addSelectColumn(CotContinuacionPeer::CA_OBSERVACIONES );
		$c->addSelectColumn(CotContinuacionPeer::CA_IDCONTINUACION );
		$c->addJoin( CotContinuacionPeer::CA_ORIGEN, "c_org.ca_idciudad", Criteria::LEFT_JOIN );
		$c->addJoin( CotContinuacionPeer::CA_DESTINO, "c_dst.ca_idciudad", Criteria::LEFT_JOIN );
		$c->addJoin( CotContinuacionPeer::CA_IDCONCEPTO, "concepto.ca_idconcepto", Criteria::LEFT_JOIN );
		$c->addJoin( CotContinuacionPeer::CA_IDEQUIPO, "equipo.ca_idconcepto", Criteria::LEFT_JOIN );

		$c->add( CotContinuacionPeer::CA_IDCOTIZACION , $id );
		$c->addAscendingOrderByColumn(CotContinuacionPeer::CA_TIPO );
		$c->addAscendingOrderByColumn(CotContinuacionPeer::CA_MODALIDAD );
		
		
		$stmt = CotContinuacionPeer::doSelectStmt( $c );
		
		$this->contviajes = array();
		$i=0;
		
		$tipo = null;
		
   		while ( $row = $stmt->fetch(PDO::FETCH_NUM) ) {
			
      		$this->contviajes[] = array('idcotizacion'=>$row[0],
      									'tipo'=>$row[1],
      									'modalidad'=>$row[2],
										'origen'=>$row[3],
										'ciuorigen'=>$row[4],
      									'destino'=>$row[5],
      									'ciudestino'=>utf8_encode($row[6]),
      									'idconcepto'=>$row[7],
      									'concepto'=>$row[8],
      									'idequipo'=>$row[9],
      									'equipo'=>$row[10],
      									'valor_tar'=>$row[11],
      									'valor_min'=>$row[12],
      									'idmoneda'=>$row[13],
										'frecuencia'=>utf8_encode($row[14]),
										'ttransito'=>utf8_encode($row[15]),
										'observaciones'=>utf8_encode($row[16]),
										'id'=>utf8_encode($row[17]),
										'orden'=>$i++
      		);
		}	
		
		$this->contviajes[] = array('idcotizacion'=>$id,
      									'tipo'=>"OTM",
      									'modalidad'=>'+',
										'origen'=>'',
										'ciuorigen'=>'',
      									'destino'=>'',
      									'ciudestino'=>'',
      									'idconcepto'=>'',
      									'concepto'=>'',
      									'idequipo'=>'',
      									'equipo'=>'',
      									'valor_tar'=>'',
      									'valor_min'=>'',
      									'idmoneda'=>'COP',
										'frecuencia'=>'',
										'ttransito'=>'',
										'observaciones'=>'',
										'oid'=>'',
										'orden'=>9999+$i++,
      			);
				
		$this->contviajes[] = array('idcotizacion'=>$id,
      									'tipo'=>"DTA",
      									'modalidad'=>'+',
										'origen'=>'',
										'ciuorigen'=>'',
      									'destino'=>'',
      									'ciudestino'=>'',
      									'idconcepto'=>'',
      									'concepto'=>'',
      									'idequipo'=>'',
      									'equipo'=>'',
      									'valor_tar'=>'',
      									'valor_min'=>'',
      									'idmoneda'=>'COP',
										'frecuencia'=>'',
										'ttransito'=>'',
										'observaciones'=>'',
										'oid'=>'',
										'orden'=>9999+$i++,
      			);		
		
			
	}
	
	
	/*************************************************************************
	* GRILLA SEGUROS
	*
	**************************************************************************/
	
	/*
	* Guarda los cambios realizados en la Plantilla Seguros  
	* @author Carlos G. López M.
	*/
	public function executeObserveSegurosManagement(){
		$user_id = $this->getUser()->getUserId();
		$id = $this->getRequestParameter( "id" );
		if( $this->getRequestParameter( "oid" ) ) {
			
			$seguro = CotSeguroPeer::retrieveByPk( $this->getRequestParameter("oid")  );
			$this->forward404Unless( $seguro );
		}else{
			$seguro = new CotSeguro();
			$seguro->setCaIdcotizacion( $this->getRequestParameter("cotizacionId") );	
		}

		if( $this->getRequestParameter("prima_tip") ){
			$seguro->setCaPrimaTip($this->getRequestParameter("prima_tip"));
		}

		if( $this->getRequestParameter("prima_vlr") ){
			$seguro->setCaPrimaVlr($this->getRequestParameter("prima_vlr"));
		}

		if( $this->getRequestParameter("prima_min") ){
			$seguro->setCaPrimaMin($this->getRequestParameter("prima_min"));
		}
		
		if( $this->getRequestParameter("obtencion") ){
			$seguro->setCaObtencion($this->getRequestParameter("obtencion"));
		}
		
		if( $this->getRequestParameter("idmoneda") ){
			$seguro->setCaIdMoneda($this->getRequestParameter("idmoneda"));
		}

		if( $this->getRequestParameter("observaciones")){
			$seguro->setCaObservaciones($this->getRequestParameter("observaciones"));
		}
		
		if( $this->getRequestParameter("transporte")){
			$seguro->setCaTransporte(utf8_decode($this->getRequestParameter("transporte")));
		}

		if( !$this->getRequestParameter( "oid" ) ){ 
			$seguro->setCaFchcreado( time() );	
			$seguro->setCaUsucreado( $user_id );			
		}else{
			$seguro->setCaFchactualizado( time() );	
			$seguro->setCaUsuactualizado( $user_id );							
		}
		
		$seguro->save();
		$this->responseArray = array("id"=>$id);
		$this->setTemplate("responseTemplate");
		$this->setLayout("ajax");	
	}
	
	public function executeEliminarGrillaSeguros(){
		$user_id = $this->getUser()->getUserId();
		$id = $this->getRequestParameter( "id" );
		if( $this->getRequestParameter( "oid" ) ) {			
			$seguro = CotSeguroPeer::retrieveByPk( $this->getRequestParameter( "oid" ) );
			if( $seguro ){
				$seguro->delete();
				$this->responseArray = array("id"=>$id);
			}
		}
		
		$this->setTemplate("responseTemplate");
		$this->setLayout("ajax");
	}
	
	
	/*
	* Muestra las tarifas de seguros de acuerdo a los productos cotizados 
	*/	
	public function executeTarifarioSeguros(){

		$idcotizacion = $this->getRequestParameter("idcotizacion");		
		$this->idcomponent = "seguros_".$idcotizacion;
		$cotizacion = CotizacionPeer::retrieveByPk( $idcotizacion );
		$productos = $cotizacion->getCotProductos();
		
		$this->data = array();
		foreach(  $productos as $producto ){
			$origen = $producto->getOrigen();
			$destino = $producto->getDestino();
			if( $producto->getCaImpoExpo()==Constantes::IMPO ){
				$grupo = $origen->getTrafico()->getTraficoGrupo(); 
			}else{
				$grupo = $destino->getTrafico()->getTraficoGrupo();
			}
			
			$seguro = PricSeguroPeer::retrieveByPk( $grupo->getCaIdGrupo(), $producto->getCaTransporte() );
			if( $seguro ){
				$row = array(			 
					'idgrupo'=>$grupo->getCaIdGrupo(),
					'grupo'=>utf8_encode($grupo->getCaDescripcion()),
					'trayecto'=>utf8_encode($origen->getCaCiudad()."»".$destino->getCaCiudad()),
					'producto'=>utf8_encode($producto->getCaProducto())
				);
			
							
			
				$row['vlrprima']=$seguro->getCaVlrprima();
				$row['vlrminima']=$seguro->getCaVlrminima();
				$row['vlrobtencionpoliza']=$seguro->getCaVlrobtencionpoliza();
				$row['idmoneda']=$seguro->getCaIdmoneda();
				$row['observaciones']=$seguro->getCaObservaciones();
				$row['transporte']=utf8_encode($seguro->getCaTransporte());
				$this->data[] = $row;
			}
			
		}
			
		$this->setLayout("ajax");
		
	}
	
	/*************************************************************************
	* Administración de archivos adjuntos
	*
	**************************************************************************/	
	
	/*
	* Guarda un archivo en la base de datos
	*/	
	public function executeDataArchivosCotizacion(){						
		$idcotizacion = $this->getRequestParameter( "idcotizacion" );
		$this->forward404Unless( $idcotizacion );
		
		$c = new Criteria();
		$c->add( CotArchivoPeer::CA_IDCOTIZACION, $idcotizacion );
		$cotArchivos = CotArchivoPeer::doSelect( $c );
		
		$this->files = array();
		foreach($cotArchivos as $archivo ){
			$this->files[]=array("idarchivo"=>$archivo->getCaIdarchivo(),
							"name"=>utf8_encode($archivo->getCaNombre()),
							"lastmod"=>$archivo->getCaFchcreado()
					);
		}		
	}
			
	/*
	* Guarda un archivo en la base de datos
	*/	
	public function executeAdjuntarArchivo( $request ){						
		sfConfig::set('sf_web_debug', false) ;				
		$idcotizacion = $this->getRequestParameter( "idcotizacion" );
		$this->forward404Unless( $idcotizacion );
		
		if ( count( $_FILES )>0 ){		 	
			foreach ( $_FILES as $uploadedFile){
				
				$fileName  = $uploadedFile['name'];
				$fileSize  = $uploadedFile['size'];
				$fileType  = $uploadedFile['type'];				
				$path = $uploadedFile['tmp_name'];		
				
				$fileObj = new CotArchivo();
				$fileObj->setCaTamano($fileSize);
				$fileObj->setCaNombre($fileName);
				$fileObj->setCaIdCotizacion($idcotizacion);	
				$fileObj->setCaTipo($fileType);
				
				$fp = fopen($path, "r");
				$data = fread( $fp , $fileSize);
				fclose( $fp );
				$fileObj->setCaDatos($data);
				$fileObj->setCaFchcreado(time());
				$user = $this->getUser();
				$fileObj->setCaUsucreado($user->getUserid());
				$fileObj->save();	
				$id = $fileObj->getCaIdArchivo();
				
				$this->responseArray = array("id"=>$id, "filename"=>$fileName, "success"=>true);				
			
		  	}
		}else{
			$this->responseArray = array("success"=>false);
		}
		$this->setLayout("ajax");
		$this->setTemplate("responseTemplate");
	}
	
	/*
	* Elimina un archivo de la base de datos
	*/	
	public function executeEliminarArchivo(){
		$id = $this->getRequestParameter( "id" );
		$idarchivo = $this->getRequestParameter( "idarchivo" );
		
		$this->forward404Unless( $id );
		$cotArchivo = CotArchivoPeer::retrieveByPk( $idarchivo );
		$cotArchivo->delete();					
		$this->responseArray = array("id"=>$id);	
		$this->setTemplate("responseTemplate");
	}
	
	
	/*
	* Permite visualizar un archivo del panel 
	* @author: Andres Botero 
	*/
	public function executeVerArchivo(){
		$this->archivo = CotArchivoPeer::retrieveByPk( $this->getRequestParameter("idarchivo") );
		$this->forward404Unless( $this->archivo );
		
		session_cache_limiter('public'); 
		
	}
	
	/*************************************************************************
	* OTROS
	*
	**************************************************************************/
	/*
	* Datos de las modalidades según sea el medio de transporte
	*/
	public function executeDatosModalidades(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));
		
		if ( $transport_parameter == Constantes::MARITIMO)	{
			$transportes = ParametroPeer::retrieveByCaso( "CU051",null, $impoexpo_parameter);
		}else if ( $transport_parameter == Constantes::AEREO )	{
			$transportes = ParametroPeer::retrieveByCaso( "CU052",null, $impoexpo_parameter);
		}else if ( $transport_parameter ==  Constantes::TERRESTRE )	{
			$transportes = ParametroPeer::retrieveByCaso( "CU053",null, $impoexpo_parameter);
		}
		$this->modalidades = array();
		
		foreach($transportes as $transporte){
			$row = array("modalidad"=>$transporte->getCaValor());
			$this->modalidades[]=$row;
		}
		$this->setLayout("ajax");
	}

	/*
	* Datos de los conceptos según sea el medio de transporte y la modalidad
	*/
	public function executeDatosConceptos(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$modalidad_parameter = utf8_decode($this->getRequestParameter("modalidad"));
		
		
		$c = new Criteria();
		
		$c->addSelectColumn(ConceptoPeer::CA_IDCONCEPTO );
		$c->addSelectColumn(ConceptoPeer::CA_CONCEPTO );
		
		$c->add( ConceptoPeer::CA_TRANSPORTE, $transport_parameter );
		$c->add( ConceptoPeer::CA_MODALIDAD, $modalidad_parameter );
		
		$stmt = ConceptoPeer::doSelectStmt( $c );

		$this->conceptos = array();
		
		while ( $result = $stmt->fetch(PDO::FETCH_NUM) ) {
			$row = array('idconcepto'=>$result[0], 'concepto'=>utf8_encode($result[1]));
			$this->conceptos[]=$row;
		}

		$this->setLayout("ajax");
	}
	
	
	/*
	* Indice de ayuda
	*/
	public function executeAyuda(){
	
	}
}
?>