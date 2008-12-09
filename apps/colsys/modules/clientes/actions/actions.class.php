<?php

/**
 * clientes actions.
 *
 * @package    colsys
 * @subpackage clientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clientesActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeBusquedaClientes()
	{	
		$this->formName  = $this->getRequestparameter("formName");	
		$criterio = $this->getRequestparameter("criterio");
		$opcion = $this->getRequestparameter("opcion");
		$this->modo = $this->getRequestparameter("modo");
		
		if( $criterio ){			
			
			if( $opcion == "cliente"){
				$c = new Criteria();			
				$modalidad = $this->getRequestparameter("modalidad");			
				switch( $modalidad ){
					case "tercero":
						$c->add( ClientePeer::CA_COMPANIA , "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );
						break;
					case "contacto":	
						
						$criterion = $c->getNewCriterion( ClientePeer::CA_PAPELLIDO , "lower(".ClientePeer::CA_PAPELLIDO.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );								
						$criterion->addOr($c->getNewCriterion( ClientePeer::CA_SAPELLIDO , "lower(".ClientePeer::CA_PAPELLIDO.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM ));					
						$criterion->addOr($c->getNewCriterion( ClientePeer::CA_NOMBRES, "lower(".ClientePeer::CA_NOMBRES.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM ));
						$c->add($criterion);				
						break;
						
					case "id":	
						$c->add( ClientePeer::CA_IDCLIENTE , "lower(".ClientePeer::CA_IDCLIENTE.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );
						break;
				}
				
				$c->addAscendingorderByColumn( ClientePeer::CA_COMPANIA );			
				$c->setLimit(80);
				$this->clientes	= ClientePeer::doSelect( $c );
				
				$this->setTemplate("busquedaContactosResult");		
				
			}elseif($opcion == "consignatario" ||  $opcion=="notify" ){
				$c = new Criteria();			
				$modalidad = $this->getRequestparameter("modalidad");			
				switch( $modalidad ){
					case "tercero":
						$c->add( TerceroPeer::CA_NOMBRE , "lower(".TerceroPeer::CA_NOMBRE.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );
						break;
					case "contacto":	
						
						$c->add( TerceroPeer::CA_CONTACTO , "lower(".TerceroPeer::CA_CONTACTO.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );
						break;			
						break;
						
					case "id":	
						$c->add( TerceroPeer::CA_IDTERCERO , "lower(".TerceroPeer::CA_IDTERCERO.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );
						break;
				}
				if( $opcion == "consignatario" ){
					$c->add( TerceroPeer::CA_TIPO , "Consignatario");
				}
				if( $opcion == "notify" ){
					$c->add( TerceroPeer::CA_TIPO , "Notify");
				}
				$c->addAscendingorderByColumn( TerceroPeer::CA_NOMBRE );			
				$c->setLimit(80);				
				$this->terceros	= TerceroPeer::doSelect( $c );
				$this->setTemplate("busquedaTerceroResult");
			}				
												
		}	
		$this->opcion = $opcion;
	}
	
	public function executeAgregarTercero(){
		$this->tipo=$this->getRequestParameter("tipo");		
		$this->formName  = $this->getRequestparameter("formName");
		
		$id = $this->getRequestParameter("id");
		if( !$id ){
			$this->tercero = new Tercero();
		}else{
			$this->tercero = TerceroPeer::retrieveByPk( $id );
		}
		
		$c = new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$c->addJoin( TraficoPeer::CA_IDTRAFICO, CiudadPeer::CA_IDTRAFICO );	
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );		
		$this->ciudades = CiudadPeer::doSelect( $c );
	}
	
	/*
	* Permite guardar un tercero
	* @author: Andres Botero
	*/
	public function executeGuardarTercero(){
		$this->tipo=$this->getRequestParameter("tipo");		
		$this->forward404unless($this->tipo);
		//echo "->".$this->getRequestParameter("nombre");
		print_r( $_POST );
		//$this->forward404unless($this->getRequestParameter("nombre"));
		if($this->getRequestParameter("nombre")){
			$id = $this->getRequestParameter("id");
			if( !$id ){
				$tercero = new Tercero();
			}else{
				$tercero = TerceroPeer::retrieveByPk( $id );
			}				
			$tercero->setCaNombre( $this->getRequestParameter("nombre") );
			$tercero->setCaDireccion( $this->getRequestParameter("direccion") );
			$tercero->setCaTelefonos( $this->getRequestParameter("telefono") );
			$tercero->setCaFax( $this->getRequestParameter("fax") );
			$tercero->setCaEmail( $this->getRequestParameter("email") );
			$tercero->setCaContacto( $this->getRequestParameter("contacto") );
			$tercero->setCaIdciudad( $this->getRequestParameter("ciudad") );
			$tercero->setCaIdentificacion( $this->getRequestParameter("identificacion") );
			$tercero->setCaVendedor( " " );
			if( $this->tipo=="consignatario" ){
				$tercero->setCaTipo( "Consignatario" );
			}
			
			if( $this->tipo=="notify" ){
				$tercero->setCaTipo( "Notify" );
			}
			
			$tercero->save();					
		}
		exit;
	}
	
	/*
	* Si ocurre un error reenvia a la pagina original y muestra los mensajes 
	* de error
	* @author: Andres Botero
	*/
	public function handleErrorAgregarTercero()
	{
		return sfView::SUCCESS;
	}
	
	
	/*
	* Muestra el formulario donde estan los contactos 
	* 
	*/
	
	public function executeClavesTracking(){
		$this->cliente = ClientePeer::retrieveByPk( $this->getRequestParameter("id"));
		$this->forward404Unless( $this->cliente );
	}
	
	/*
	* Envia un email generando un nuevo codigo de activacion 
	* y desactiva la cuenta para que el usuario la active de nuevo
	*/
	public function executeActivarClave(){
		
		$contacto = ContactoPeer::retrieveByPk( $this->getRequestParameter("contacto") );
		$this->forward404Unless( $contacto );		
		$user = $contacto->getTrackingUser();
		
		//Genera un codigo de activacion
		$email = $contacto->getCaEmail();
		
		if(!$user){
			$user = new TrackingUser();
			$user->setCaEmail( $email );
			$code = $user->generateActivationCode();
		}else{
			$code = $user->getCaActivationCode();
		}
		
		$user->setCaActivated( false );								
		
		$user->setCaIdcontacto( $contacto->getCaIdcontacto() );
		
		$user->save();
		
		$link = "/tracking/login/activate/code/".$code ;					
		$content = Utils::replace(" Apreciado/a ".Utils::replace($contacto->getCaNombres()." ".$contacto->getCaPapellido())."\n
		Gracias por utilizar el servicio de tracking and tracing de Coltrans S.A., hemos enviado este correo para activar la clave de su cuenta, por favor haga click en el enlace que se encuentra a continuación: \n");
		
		$content .= "<a href='https://www.coltrans.com.co".$link."'>Haga click aca para activar su cuenta</a>";
		$content .= Utils::replace("\n						
		Si desea conocer más de este servicio por favor comuníquese con nuestro departamento de servicio al cliente\n
		Cordialmente 
		\n\n
		Coltrans S.A.					
		");	
		$user = $this->getUser();		
		$from = "serclientebog@coltrans.com.co";
		$fromName = "Coltrans S.A., Servicio al cliente";
		
		$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail(), $user->getNombre()=>$user->getEmail()); //$contacto->getCaEmail()
			//,																													
		Utils::sendEmail( "CORREO DE ACTIVACION", $content, $from, $fromName, $to );		
		
		
	}
	
	
	/*
	* 
	*/
	
	public function executeListaContactosClientesJSON(){
		$criterio =  $this->getRequestParameter("query");
		$c = new Criteria();
		$c->addSelectColumn(ContactoPeer::CA_IDCONTACTO );
		$c->addSelectColumn(ClientePeer::CA_COMPANIA );
		$c->addSelectColumn(ContactoPeer::CA_NOMBRES );
		$c->addSelectColumn(ContactoPeer::CA_PAPELLIDO );
		$c->addSelectColumn(ContactoPeer::CA_SAPELLIDO );
		$c->addSelectColumn(ContactoPeer::CA_CARGO );
		$c->addSelectColumn(ClientePeer::CA_PREFERENCIAS );
		$c->addSelectColumn(ClientePeer::CA_CONFIRMAR );
		$c->addSelectColumn(ClientePeer::CA_VENDEDOR );
		$c->addSelectColumn(UsuarioPeer::CA_NOMBRE );
		
		$c->addJoin( ClientePeer::CA_IDCLIENTE, ContactoPeer::CA_IDCLIENTE );
		$c->addJoin( UsuarioPeer::CA_LOGIN, ClientePeer::CA_VENDEDOR );

		$c->add( ClientePeer::CA_COMPANIA , "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );	
		
		$c->addAscendingOrderByColumn( ClientePeer::CA_COMPANIA );
		$c->addAscendingOrderByColumn( ContactoPeer::CA_NOMBRES );
		$c->setLimit(40);
		$rs = ClientePeer::doSelectRS( $c );
		
		$this->clientes = array();
 
   		while ( $rs->next() ) {
      		$this->clientes[] = array('ca_idcontacto'=>$rs->getString(1),
                                      'ca_compania'=>utf8_encode($rs->getString(2)),
									  'ca_nombres'=>utf8_encode($rs->getString(3)),
									  'ca_papellido'=>utf8_encode($rs->getString(4)),
									  'ca_sapellido'=>utf8_encode($rs->getString(5)),      
									  'ca_cargo'=>utf8_encode($rs->getString(6)), 
									  'ca_preferencias'=>utf8_encode($rs->getString(7)),
									  'ca_confirmar'=>utf8_encode($rs->getString(8)),
									  'ca_vendedor'=>utf8_encode($rs->getString(9)),
									  'ca_nombre'=>utf8_encode($rs->getString(10)),
                                 );
		}					
		$this->setLayout("none");
	}
	
	
	/*
	* 
	*/
	
	public function executeListaClientesJSON(){
		$criterio =  $this->getRequestParameter("query");
		$c = new Criteria();
		$c->addSelectColumn(ClientePeer::CA_IDCLIENTE );
		$c->addSelectColumn(ClientePeer::CA_COMPANIA );		
		$c->addSelectColumn(ClientePeer::CA_PREFERENCIAS );
		$c->addSelectColumn(ClientePeer::CA_CONFIRMAR );
		
		$c->setDistinct();			
		$c->add( ClientePeer::CA_COMPANIA , "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );	
		
		$c->addAscendingOrderByColumn( ClientePeer::CA_COMPANIA );		
		$c->setLimit(40);
		$rs = ClientePeer::doSelectRS( $c );
		
		$this->clientes = array();
 
   		while ( $rs->next() ) {
      		$this->clientes[] = array('ca_idcliente'=>$rs->getString(1),
                                      'ca_compania'=>utf8_encode($rs->getString(2)),
									  'ca_preferencias'=>utf8_encode($rs->getString(3)),
									  'ca_confirmar'=>utf8_encode($rs->getString(4)),
                                 );
		}					
		$this->setLayout("none");
	}
	
	
	public function executeListaConsignatariosJSON(){
		$criterio =  $this->getRequestParameter("query");
		$c = new Criteria();
		$c->addSelectColumn(TerceroPeer::CA_IDTERCERO );
		$c->addSelectColumn(TerceroPeer::CA_NOMBRE );		
		$c->addSelectColumn(CiudadPeer::CA_CIUDAD );
		$c->addSelectColumn(TraficoPeer::CA_NOMBRE );	
		
		$c->setDistinct();
		$c->addJoin(  TerceroPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );
		$c->addJoin(  CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO );
		
		$c->add( TerceroPeer::CA_TIPO, "Consignatario" );
					
		$c->add( TerceroPeer::CA_NOMBRE , "lower(".TerceroPeer::CA_NOMBRE.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );	
		
		
		$c->addAscendingOrderByColumn( TerceroPeer::CA_NOMBRE );
		
		$c->setLimit(40);
		$rs = TerceroPeer::doSelectRS( $c );
		
		$this->terceros = array();
 
   		while ( $rs->next() ) {
      		$this->terceros[] = array('ca_idtercero'=>$rs->getString(1),
                                      'ca_nombre'=>utf8_encode($rs->getString(2)),
									  'ca_ciudad'=>utf8_encode($rs->getString(3)),
									  'ca_pais'=>utf8_encode($rs->getString(4))		                              
                                 );
		}					
		$this->setLayout("none");
		$this->setTemplate("listaTercerosJSON");
	}
	
	public function executeListaNotifyJSON(){
		$criterio =  $this->getRequestParameter("query");
		$c = new Criteria();
		$c->addSelectColumn(TerceroPeer::CA_IDTERCERO );
		$c->addSelectColumn(TerceroPeer::CA_NOMBRE );		
		$c->addSelectColumn(CiudadPeer::CA_CIUDAD );
		$c->addSelectColumn(TraficoPeer::CA_NOMBRE );	
		
		$c->setDistinct();
		$c->addJoin(  TerceroPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD );
		$c->addJoin(  CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO );
		
		$c->add( TerceroPeer::CA_TIPO, "Notify" );
					
		$c->add( TerceroPeer::CA_NOMBRE , "lower(".TerceroPeer::CA_NOMBRE.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );	
		
		
		$c->addAscendingOrderByColumn( TerceroPeer::CA_NOMBRE );
		
		$c->setLimit(40);
		$rs = TerceroPeer::doSelectRS( $c );
		
		$this->terceros = array();
 
   		while ( $rs->next() ) {
      		$this->terceros[] = array('ca_idtercero'=>$rs->getString(1),
                                      'ca_nombre'=>utf8_encode($rs->getString(2)),
									  'ca_ciudad'=>utf8_encode($rs->getString(3)),
									  'ca_pais'=>utf8_encode($rs->getString(4))		                              
                                 );
		}					
		$this->setLayout("none");
		$this->setTemplate("listaTercerosJSON");
	}
	
	/*
	* Entrada Reporte de Estados Clientes
	*/
	public function executeListaEstados() {
		$c = new Criteria();
		$c->addSelectColumn( SucursalPeer::CA_NOMBRE );
		$c->addAscendingOrderByColumn( SucursalPeer::CA_NOMBRE );

		$rs = SucursalPeer::doSelectRS( $c );

		$this->sucursales = array(null => "Todas las Sucursales");

   		while ( $rs->next() ) {
   				$this->sucursales = array_merge($this->sucursales, array($rs->getString(1) => $rs->getString(1)));
		}
	}
	
	/*
	* Entrada Reporte de Circular 170 Clientes
	*/
	public function executeListaCircular() {
		$c = new Criteria();
		$c->addSelectColumn( SucursalPeer::CA_NOMBRE );
		$c->addAscendingOrderByColumn( SucursalPeer::CA_NOMBRE );

		$rs = SucursalPeer::doSelectRS( $c );

		$this->sucursales = array(null => "Todas las Sucursales");

   		while ( $rs->next() ) {
   				$this->sucursales = array_merge($this->sucursales, array($rs->getString(1) => $rs->getString(1)));
		}
	}
	
	public function executeReporteEstados(){
		$anterior = array();
		$facturar = array();
		set_time_limit(0);
		$inicio =  $this->getRequestParameter("fchStart");
		$final =  $this->getRequestParameter("fchEnd");
		$empresa =  $this->getRequestParameter("empresa");
		$estado =  $this->getRequestParameter("estado");
		$sucursal =  $this->getRequestParameter("sucursal");
		
		$this->clientesEstados = array();
		
		$rs = ClientePeer::estadoClientes($inicio, $final, $empresa, null, $estado, $sucursal);
		while($rs->next()) {
			$actual = array('ca_idcliente'=>$rs->getString("ca_idcliente"),
							'ca_compania'=>$rs->getString("ca_compania"),
                            'ca_fchestado'=>$rs->getString("ca_fchestado"),
                            'ca_estado'=>$rs->getString("ca_estado"),
                            'ca_empresa'=>$rs->getString("ca_empresa"),
							'ca_vendedor'=>$rs->getString("ca_vendedor"),
							'ca_sucursal'=>$rs->getString("ca_sucursal")
                           );
			
			list($year, $month, $day) = sscanf($rs->getString("ca_fchestado"), "%d-%d-%d");
			
			$sb = ClientePeer::estadoClientes(null, date('Y-m-d',mktime(0,0,0,$month,$day-1,$year)), $empresa, $rs->getString("ca_idcliente"), null, null);
			while($sb->next()) {
				$anterior = array('ca_fchestado_ant'=>$sb->getString("ca_fchestado"),
	                              'ca_estado_ant'=>$sb->getString("ca_estado")
	                             );
			}

			$sb = ClientePeer::facturacionClientes($inicio, $final, $empresa, $rs->getString("ca_idcliente"));
			while($sb->next()) {
				$facturar = array('ca_fchfactura'=>$sb->getString("ca_fchfactura"),
	                              'ca_valor'=>$sb->getString("ca_valor")
	                             );
			}
			if (count($anterior)==0){
				$anterior = array('ca_fchestado_ant'=>null, 'ca_estado_ant'=>null);
			}
			$this->clientesEstados[] = array_merge($actual, $anterior, $facturar);

		}
		$this->inicio = $inicio;
		$this->final = $final;
	}
	
	public function executeReporteCircular(){
		set_time_limit(0);
		$inicio =  $this->getRequestParameter("fchStart");
		$final =  $this->getRequestParameter("fchEnd");
		$sucursal =  $this->getRequestParameter("sucursal");
		
		$this->clientesCircular = array();
		
		$rs = ClientePeer::circularClientes( $inicio, $final, $sucursal );
		while($rs->next()) {
			$this->clientesCircular[] = array('ca_idcliente'=>$rs->getString("ca_idcliente"),
											'ca_digito'=>$rs->getString("ca_digito"),
											'ca_compania'=>$rs->getString("ca_compania"),
											'ca_direccion'=>$rs->getString("ca_direccion"),
											'ca_oficina'=>$rs->getString("ca_oficina"),
											'ca_torre'=>$rs->getString("ca_torre"),
											'ca_bloque'=>$rs->getString("ca_bloque"),
											'ca_interior'=>$rs->getString("ca_interior"),
											'ca_complemento'=>$rs->getString("ca_complemento"),
											'ca_telefonos'=>$rs->getString("ca_telefonos"),
											'ca_fax'=>$rs->getString("ca_fax"),
											'ca_ciudad'=>$rs->getString("ca_ciudad"),
											'ca_fchcircular'=>$rs->getString("ca_fchcircular"),
											'ca_vnccircular'=>$rs->getString("ca_vnccircular"),
				                            'ca_vendedor'=>$rs->getString("ca_vendedor"),
				                            'ca_nombre'=>$rs->getString("ca_nombre"),
				                            'ca_sucursal'=>$rs->getString("ca_sucursal")
				                            );
		}
		$this->inicio = $inicio;
		$this->final = $final;
	}
	
	public function executeReporteEstadosEmail(){
		$parametro = ParametroPeer::retrieveByPK("CU066",1,"defaultEmails");
		if ($parametro) {
			if (stripos($parametro->getCaValor2(), ',') !== false) {
				$defaultEmail = explode(",", $parametro->getCaValor2());
			}else{
				$defaultEmail = array($parametro->getCaValor2());
			}
		}
		$parametro = ParametroPeer::retrieveByPK("CU066",2,"ccEmails");
		if ($parametro) {
			if (stripos($parametro->getCaValor2(), ',') !== false) {
				$ccEmails = explode(",", $parametro->getCaValor2());
			}else{
				$ccEmails = array($parametro->getCaValor2());
			}
		}
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( "Administrador" );
		$email->setCaTipo( "EstadosClientes" ); 		
		$email->setCaIdcaso( "1" );
		$email->setCaFrom( "admin@coltrans.com.co" );
		$email->setCaFromname( "Administrador Sistema Colsys" );
		$email->setCaReplyto( "admin@coltrans.com.co" );

		while (list ($clave, $val) = each ($defaultEmail)) {
			$email->addTo( $val );
		}
		
		while (list ($clave, $val) = each ($ccEmails)) {
			$email->addCc( $val );
		}

		$inicio =  $this->getRequestParameter("fchStart");
		$final =  $this->getRequestParameter("fchEnd");
		$empresa =  $this->getRequestParameter("empresa");
		
		$this->getRequest()->setParameter("fchStart", $inicio);
		$this->getRequest()->setParameter("fchEnd", $final);
		$this->getRequest()->setParameter("empresa", $empresa);
		
		$email->setCaSubject( "Cliente con cambio de Estado, periodo:$inicio a $final en $empresa" );
		$email->setCaBody(  sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'reporteEstados') );
		
		$email->save();
		$email->send();
	}

	public function executeReporteCircularEmail(){
		$parametro = ParametroPeer::retrieveByPK("CU067",1,"defaultEmails");
		if ($parametro) {
			if (stripos($parametro->getCaValor2(), ',') !== false) {
				$defaultEmail = explode(",", $parametro->getCaValor2());
			}else{
				$defaultEmail = array($parametro->getCaValor2());
			}
		}
		$parametro = ParametroPeer::retrieveByPK("CU067",2,"ccEmails");
		if ($parametro) {
			if (stripos($parametro->getCaValor2(), ',') !== false) {
				$ccEmails = explode(",", $parametro->getCaValor2());
			}else{
				$ccEmails = array($parametro->getCaValor2());
			}
		}
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( "Administrador" );
		$email->setCaTipo( "CircularClientes" ); 		
		$email->setCaIdcaso( "1" );
		$email->setCaFrom( "admin@coltrans.com.co" );
		$email->setCaFromname( "Administrador Sistema Colsys" );
		$email->setCaReplyto( "admin@coltrans.com.co" );

		while (list ($clave, $val) = each ($defaultEmail)) {
			$email->addTo( $val );
		}
		
		while (list ($clave, $val) = each ($ccEmails)) {
			$email->addCc( $val );
		}

		$inicio =  $this->getRequestParameter("fchStart");
		$final =  $this->getRequestParameter("fchEnd");
		$sucursal =  $this->getRequestParameter("sucursal");
		
		$this->getRequest()->setParameter("fchStart", $inicio);
		$this->getRequest()->setParameter("fchEnd", $final);
		$this->getRequest()->setParameter("sucursal", $sucursal);
		
		$email->setCaSubject( "Cliente con Vencimiento de Circular 170 a : $inicio" );
		$email->setCaBody(  sfContext::getInstance()->getController()->getPresentationFor( 'clientes', 'reporteCircular') );
		
		$email->save();
		$email->send();
	}

	public function executeReporteListaClinton(){
		echo "\n\nInicio el proceso : ".date("h:i:s A")."\n\n";
		
		$file =  sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."clinton.xml";
		sfConfig::set("sf_web_debug", false);
		
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
		}
		fclose($handle);
		echo "Temina Lectura de Archivo Plano desde la Pagina Web www.treas.gov : ".date("h:i:s A")."\n\n";
		
		echo "Inicia Seleccion de Registro para Colombia y Carga de tablas : ".date("h:i:s A")."\n\n";
		/*Extrae los datos y los coloca*/
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
		echo "Termina Carga de tablas : ".date("h:i:s A")."\n\n";
		
		echo "Inicia comparativo con Maestra de Clientes: ".date("h:i:s A")."\n\n";
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
		while($rs->next()) {
			if ($rs->getString("ca_vendedor") !== $ven_mem) {
				if ($msn_mem != ''){
					$msn_mem.= "</table>";
					echo "Body Mail: \n".$msn_mem."\n\n";
					while (list ($clave, $val) = each ($ccEmails)) {
						$email->addCc( $val );
					}
					$email->setCaSubject( "Verificación Clientes en Lista Clinton" );		
					$email->setCaBody( $msn_mem );
					//$email->save(); //guarda el cuerpo del mensaje
					//$email->send(); //envia el mensaje de correo	
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
		echo $msn_mem."\n\n";
		
		$email->setCaSubject( "Verificación Clientes en Lista Clinton" );		
		$email->setCaBody( $msn_mem );
		//$email->save(); //guarda el cuerpo del mensaje
		//$email->send(); //envia el mensaje de correo	
		
		if (isset($ultimo)){
			$ultimo->setCaValor2($nueva_fecha);
			$ultimo->save();
		}
		echo "Finaliza comparativo con Maestra de Clientes: ".date("h:i:s A")."\n\n";
		echo "\n \n Fin del Proceso de Importación \n\n";
	}
}
?>