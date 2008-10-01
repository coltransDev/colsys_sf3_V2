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

	/**
	* Pantalla de bienvenida para el modulo de Cotizaciones 
	* @author Carlos L�pez
	*/
	public function executeIndex()
	{	
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
				
		$c = new Criteria();		
		switch( $criterio ){
			case "mis_cotizaciones":
				$c->add( CotizacionPeer::CA_USUARIO, "%".$user->getUserId()."%", Criteria::LIKE );	
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
				$c->add( CotizacionPeer::CA_LOGIN, "lower(".CotizacionPeer::CA_LOGIN.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
			case "numero_de_cotizacion":
				$c->add( CotizacionPeer::CA_IDCOTIZACION, "lower(".CotizacionPeer::CA_IDCOTIZACION.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
		}	
		$c->add( CotizacionPeer::CA_USUANULADO, null, Criteria::ISNULL );
		$c->addDescendingOrderByColumn( CotizacionPeer::CA_IDCOTIZACION );	
		$c->setLimit( 200 );
		$this->cotizaciones = CotizacionPeer::doSelect( $c );	
	}

	/*
	* Si ocurre un error reenvia a la pagina original y muestra los mensajes 
	* de error
	* @author: Carlos G. L�pez M.
	*/
	public function handleErrorFormCotizacionGuardar()
	{
		$this->forward("cotizaciones", "formCotizacion");
	}

	/*
	* Permite crear y editar el encabezado de una cotizacion 
	* @author Carlos L�pez
	*/
	public function executeFormCotizacion(){
		if( $this->getRequestParameter("cotizacionId") ){
			$cotizacion = CotizacionPeer::retrieveByPk( $this->getRequestParameter("cotizacionId") );
			$this->forward404Unless( $cotizacion );
			
		}else{		
			$cotizacion = new Cotizacion();
		}
		$this->cotizacion=$cotizacion;

		$c = new Criteria();
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_NOMBRE );
		$criterion = $c->getNewCriterion( UsuarioPeer::CA_CARGO ,'Gerente Sucursal' );								
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_CARGO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Ventas%', Criteria::LIKE ));			
		$criterion->addOr($c->getNewCriterion( UsuarioPeer::CA_DEPARTAMENTO , '%Comercial%', Criteria::LIKE ));
		$c->add($criterion);
		$this->comerciales = UsuarioPeer::doSelect( $c );	
		
		$this->user = $this->getUser();
	}
	
	/*
	* Guarda los cambios realizados al Header de la Cotizaci�n  
	* @author Carlos G. L�pez M.
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
		$cotizacion->setCaFchCotizacion( $this->getRequestParameter( "fchCotizacion" ) );
		$cotizacion->setCaIdContacto( $this->getRequestParameter( "idconcliente" ) );
		$cotizacion->setCaAsunto( $this->getRequestParameter( "asunto" ) );
		$cotizacion->setCaSaludo( $this->getRequestParameter( "saludo" ) );
		$cotizacion->setCaEntrada( $this->getRequestParameter( "entrada" ) );
		$cotizacion->setCaDespedida( $this->getRequestParameter( "despedida" ) );
		$cotizacion->setCaAnexos( $this->getRequestParameter( "anexos" ) );
		$cotizacion->setCaUsuario( $this->getRequestParameter( "usuario" ) );
		$cotizacion->setCaFchSolicitud( $this->getRequestParameter( "fchSolicitud" ) );
		$cotizacion->setCaHoraSolicitud( $this->getRequestParameter( "horaSolicitud" ) );
		if( !$cotizacion->getCaIdCotizacion() ){ 
			$cotizacion->setCaFchcreado( time() );	
			$cotizacion->setCaUsucreado( $user_id );			
		}else{
			$cotizacion->setCaFchactualizado( time() );	
			$cotizacion->setCaUsuactualizado( $user_id );							
		}
		$cotizacion->save();
		exit;	
	}
	
	/*
	* Guarda los cambios realizados a Productos  
	* @author Carlos G. L�pez M.
	*/
	public function executeFormProductoGuardar(){
		$user_id = $this->getUser()->getUserId();

		if( $this->getRequestParameter("productoId") ){
			$producto = CotProductoPeer::retrieveByPk( $this->getRequestParameter("productoId") );
			$this->forward404Unless( $producto );
		}else{		
			$producto = new CotProducto();
			$producto->setCaIdcotizacion( $this->getRequestParameter("cotizacionId") );
		}

		$impoexpo = utf8_decode($this->getRequestParameter("impoexpo"));
		$transporte= utf8_decode($this->getRequestParameter("transporte"));
	
		$producto->setCaProducto( $this->getRequestParameter("producto") );
		$producto->setCaImpoexpo( $impoexpo );
		$producto->setCaTransporte( $transporte );
		$producto->setCaModalidad( $this->getRequestParameter("modalidad") );
		$producto->setCaIncoterms( $this->getRequestParameter("incoterms") );
		$producto->setCaOrigen( $this->getRequestParameter("ciu_origen") );
		$producto->setCaDestino( $this->getRequestParameter("ciu_destino") );
		$producto->setCaFrecuencia( $this->getRequestParameter("frecuencia") );
		$producto->setCaTiempotransito( $this->getRequestParameter("ttransito") );
		$producto->setCaObservaciones( $this->getRequestParameter("observaciones") );
		$producto->setCaImprimir( $this->getRequestParameter("imprimir") );
		if( !$producto->getCaIdProducto() ){ 
			$producto->setCaFchcreado( time() );	
			$producto->setCaUsucreado( $user_id );			
		}else{
			$producto->setCaFchactualizado( time() );	
			$producto->setCaUsuactualizado( $user_id );							
		}
		$producto->save();
		exit;
	}
	
	
	/*
	* Guarda los cambios realizados  
	* @author Carlos G. L�pez M.
	*/
	public function executeObserveEncabezadoCotizacion(){
		$user_id = $this->getUser()->getUserId();
		
		if( $this->getRequestParameter("cotizacionId") ){
			$cotizacion = CotizacionPeer::retrieveByPk( $this->getRequestParameter("cotizacionId") );
			$this->forward404Unless( $cotizacion );
		}else{		
			$cotizacion = new Cotizacion();
			$sig = CotizacionPeer::siguienteConsecutivo( date("Y") );			
			$cotizacion->setCaConsecutivo( $sig ); 
		}
		$cotizacion->setCaFchCotizacion( $this->getRequestParameter( "fchCotizacion" ) );
		$cotizacion->setCaIdContacto( $this->getRequestParameter( "idconcliente" ) );
		$cotizacion->setCaAsunto( $this->getRequestParameter( "asunto" ) );
		$cotizacion->setCaSaludo( $this->getRequestParameter( "saludo" ) );
		$cotizacion->setCaEntrada( $this->getRequestParameter( "entrada" ) );
		$cotizacion->setCaDespedida( $this->getRequestParameter( "despedida" ) );
		$cotizacion->setCaAnexos( $this->getRequestParameter( "anexos" ) );
		$cotizacion->setCaUsuario( $this->getRequestParameter( "login" ) );
		$cotizacion->setCaFchSolicitud( $this->getRequestParameter( "fchSolicitud" ) );
		$cotizacion->setCaHoraSolicitud( $this->getRequestParameter( "horaSolicitud" ) );
		if( !$cotizacion->getCaIdCotizacion() ){ 
			$cotizacion->setCaFchcreado( time() );	
			$cotizacion->setCaUsucreado( $user_id );			
		}else{
			$cotizacion->setCaFchactualizado( time() );	
			$cotizacion->setCaUsuactualizado( $user_id );							
		}
		$cotizacion->save();
		
		$this->redirect( "cotizaciones/consultaCotizacion?id=".$cotizacion->getCaidcotizacion()."&token=".md5(time()) );		
		exit;	
	}

	
	/**
	* Permite consultar una cotizacion ya creada y permite 
	* agregar nuevas  
	* @author Carlos G. L�pez M.
	*/
	public function executeConsultaCotizacion(){
		$id_cotizacion = $this->getRequestParameter("id");	
		$cotizacion = CotizacionPeer::retrieveByPk( $id_cotizacion );
		$this->forward404Unless( $cotizacion );					
		$this->editable = $this->getRequestParameter("editable");	
		$this->option = $this->getRequestParameter("option");
		$this->cotizacion = $cotizacion;
		
		$this->data = array();
				 
		$productos = $this->cotizacion->getCotProductos();
		
		foreach( $productos as $producto ){			
			$row = array("origen"=>utf8_encode($producto->getOrigen()),
						 "_is_leaf"=>true						
						);	
			$this->data[] = $row;			
		}
	}		


	/**
	* Permite actualizar en linea los cambios en los campos de productos 
	* de una cotizaci�n
	* @author Carlos G. L�pez M.
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

	/*
	* Datos de las modalidades seg�n sea el medio de transporte
	*/
	public function executeDatosModalidades(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));
		
		if ( $transport_parameter == 'Mar�timo')	{
			$transportes = ParametroPeer::retrieveByCaso( "CU051",null, $impoexpo_parameter);
		}else if ( $transport_parameter == 'A�reo')	{
			$transportes = ParametroPeer::retrieveByCaso( "CU052",null, $impoexpo_parameter);
		}else if ( $transport_parameter == 'Terrestre')	{
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
	* Carga el contendo de la tabla Tr�ficos y seg�n sea una Importaci�n o Exportaci�n
	*/
	public function executeDatosTraficos(){
		$impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));
		$lugar_parameter = $this->getRequestParameter("lugar");
		
		$c=new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );

		if (($impoexpo_parameter == 'Importaci�n' and $lugar_parameter == 'origen') or ($impoexpo_parameter == 'Exportaci�n' and $lugar_parameter == 'destino')) { 
			$c->add( TraficoPeer::CA_IDTRAFICO, 'CO-057', Criteria::NOT_EQUAL );
		} else {
			$c->add( TraficoPeer::CA_IDTRAFICO, 'CO-057', Criteria::EQUAL ); 
		}
		
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$traficos_rs = TraficoPeer::doSelect( $c );
		
		$this->traficos = array();
		
		foreach($traficos_rs as $trafico){
			$row = array("idtrafico"=>$trafico->getCaIdTrafico(),"trafico"=>utf8_encode($trafico->getCaNombre()));
			$this->traficos[]=$row;
		}
		$this->setLayout("ajax");

	}
	
	/*
	* Carga el contenido de la tabla Ciudades seg�n sea el Tr�fico seleccionado
	*/
	public function executeDatosCiudades(){
		$trafico_parameter = utf8_decode($this->getRequestParameter("trafico"));
		$lugar_parameter = utf8_decode($this->getRequestParameter("lugar"));
		
		$c=new Criteria();
		$c->add( CiudadPeer::CA_IDTRAFICO, $trafico_parameter, Criteria::EQUAL );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		$ciudades_rs = CiudadPeer::doSelect( $c );
		
		$this->ciudades = array();
		
		foreach($ciudades_rs as $ciudad){
			$row = array('idciudad'=>$ciudad->getCaIdCiudad(),"ciudad"=>utf8_encode($ciudad->getCaCiudad()));
			$this->ciudades[]=$row;
		}
		$this->setLayout("ajax");
	}
	
	/*
	* Genera un archivo PDF a partir de una cotizaci�n
	*/
	public function executeGenerarPDF(){
		$this->cotizacion =  CotizacionPeer::retrieveByPk( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->cotizacion );
		$this->usuario = $this->cotizacion->getUsuario();
		$this->contacto = $this->cotizacion->getContacto();
		$this->cliente = $this->contacto->getCliente();
		$this->filename=$this->getRequestParameter("filename");
	}
	
	
	/*
	* Envia una cotizaci�n por correo 	
	*/
	public function executeEnviarCotizacionEmail(){
		$this->cotizacion =  CotizacionPeer::retrieveByPk( $this->getRequestParameter("id") );
		$fileName = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."cotizacion".$this->getRequestParameter("id").".pdf" ;
		if(file_exists($fileName)){
			@unlink( $fileName );
		}	 		
		$this->getRequest()->setParameter('filename',$fileName); 
		sfContext::getInstance()->getController()->getPresentationFor( 'cotizaciones', 'generarPDF') ;
		$this->setLayout("ajax");
		
						
		$user = $this->getUser();
					
		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Env�o de cotizaci�n" ); 		
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
				
		$email->addCc( $this->getUser()->getEmail() );					
		$email->setCaSubject( $this->getRequestParameter("asunto") );		
		$email->setCaBody( $this->getRequestParameter("mensaje") );	
		$email->addAttachment( $fileName );
		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();	
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}
		@unlink( $fileName );
	}
	
	
}
?>
