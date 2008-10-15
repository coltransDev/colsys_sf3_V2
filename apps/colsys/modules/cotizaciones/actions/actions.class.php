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
	* @author Carlos López
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
				$c->add( CotizacionPeer::CA_USUARIO, "lower(".CotizacionPeer::CA_USUARIO.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
			case "numero_de_cotizacion":
				$c->add( CotizacionPeer::CA_IDCOTIZACION, "lower(".CotizacionPeer::CA_IDCOTIZACION.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
			case "sucursal":
				$c->addJoin( CotizacionPeer::CA_USUARIO , UsuarioPeer::CA_LOGIN );
				$c->add( UsuarioPeer::CA_SUCURSAL, "lower(".UsuarioPeer::CA_SUCURSAL.") LIKE '%".strtolower( $cadena )."%'", Criteria::CUSTOM );	
				break;	
		}	
		$c->add( CotizacionPeer::CA_USUANULADO, null, Criteria::ISNULL );
		$c->addDescendingOrderByColumn( CotizacionPeer::CA_IDCOTIZACION );	
		$c->setLimit( 200 );
		$this->cotizaciones = CotizacionPeer::doSelect( $c );	
	}


	/*
	* Permite ver una cotización en formato PDF
	*/
	public function executeVerCotizacion(){
		$this->cotizacion =  CotizacionPeer::retrieveByPk( $this->getRequestParameter("id") );
		$this->forward404Unless( $this->cotizacion );		
	}
	
	
	/*
	* Si ocurre un error reenvia a la pagina original y muestra los mensajes 
	* de error
	* @author: Carlos G. López M.
	*/
	public function handleErrorFormCotizacionGuardar()
	{
		$this->forward("cotizaciones", "formCotizacion");
	}

	/*
	* Permite crear y editar el encabezado de una cotizacion 
	* @author Carlos López
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
				
		$cotizacion->setCaIdContacto( $this->getRequestParameter( "idconcliente" ) );
		$cotizacion->setCaAsunto( utf8_encode($this->getRequestParameter( "asunto" )) );
		$cotizacion->setCaSaludo( utf8_decode($this->getRequestParameter( "saludo" )) );
		$cotizacion->setCaEntrada( utf8_decode($this->getRequestParameter( "entrada" )) );
		$cotizacion->setCaDespedida( utf8_decode($this->getRequestParameter( "despedida" )) );
		$cotizacion->setCaAnexos( utf8_decode($this->getRequestParameter( "anexos" )) );
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
	
		$producto->setCaProducto( $this->getRequestParameter("producto") );
		$producto->setCaImpoexpo( $impoexpo );
		$producto->setCaTransporte( $transporte );
		$producto->setCaModalidad( $this->getRequestParameter("modalidad") );
		$producto->setCaIncoterms( $this->getRequestParameter("incoterms") );
		$producto->setCaOrigen( $this->getRequestParameter("ciu_origen") );
		if( $this->getRequestParameter("ciu_escala") ){ 
			$producto->setCaEscala( $this->getRequestParameter("ciu_escala") );
		}		
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
	* Guarda los cambios realizados a Recargos  
	* @author Carlos G. López M.
	*/
	public function executeFormRecargoGuardar(){
		$user_id = $this->getUser()->getUserId();
		$update = true;
		if( $this->getRequestParameter("productoId") ){			// Se trata de un Recargo en Origen
			
		}else{													// Se trata de un recargo local
			$idproducto = '99';
			$idopcion = '999';
			$idconcepto = '9999';
			
			$recargo = CotRecargoPeer::retrieveByPk( $this->getRequestParameter("cotizacionId"), $idproducto, $idopcion, $idconcepto, $this->getRequestParameter("idrecargo"), $this->getRequestParameter("modalidad") );
			
			if( !$recargo ){
				$update = false;
				$recargo = new CotRecargo();
				$recargo->setCaIdCotizacion( $this->getRequestParameter("cotizacionId") );
				$recargo->setCaIdProducto( $idproducto );
				$recargo->setCaIdOpcion( $idopcion );
				$recargo->setCaIdConcepto( $idconcepto );
				$recargo->setCaModalidad( $this->getRequestParameter("modalidad") );
			}
		}

		if( $this->getRequestParameter("idrecargo") ){
			$recargo->setCaIdRecargo( $this->getRequestParameter("idrecargo") );
		}
		
		if( $this->getRequestParameter("tiporecargo") ){
			$recargo->setCaTipo( $this->getRequestParameter("tiporecargo") );
		}
		
		if( $this->getRequestParameter("valor_tar") ){
			$recargo->setCaValorTar( $this->getRequestParameter("valor_tar") );
		}
		
		if( $this->getRequestParameter("aplica_tar") ){
			$recargo->setCaAplicaTar( $this->getRequestParameter("aplica_tar") );
		}
		
		if( $this->getRequestParameter("valor_min") ){
			$recargo->setCaValorMin( $this->getRequestParameter("valor_min") );
		}
		
		if( $this->getRequestParameter("aplica_min") ){
			$recargo->setCaAplicaMin( $this->getRequestParameter("aplica_min") );
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
		return sfView::NONE;
	}

	
	/*
	* Guarda los cambios realizados a Continuación de Viaje  
	* @author Carlos G. López M.
	*/
	public function executeFormContViajeGuardar(){
		$user_id = $this->getUser()->getUserId();
		$update = true;

		$c = new Criteria();
		$c->add( CotContinuacionPeer::CA_IDCOTIZACION , $this->getRequestParameter("cotizacionId") );
		$c->add( CotContinuacionPeer::CA_TIPO , $this->getRequestParameter("tipo") );
		$c->add( CotContinuacionPeer::CA_MODALIDAD , $this->getRequestParameter("modalidad") );
		$c->add( CotContinuacionPeer::CA_ORIGEN , $this->getRequestParameter("origen") );
		$c->add( CotContinuacionPeer::CA_DESTINO, $this->getRequestParameter("destino") );
		$c->add( CotContinuacionPeer::CA_IDCONCEPTO, $this->getRequestParameter("idconcepto") );
		$c->add( CotContinuacionPeer::CA_IDEQUIPO, $this->getRequestParameter("idequipo") );
		
		$continuacion = CotContinuacionPeer::doSelectOne( $c );

		if ( !$continuacion ) {
				$update = false;
				$continuacion = new CotContinuacion();
				$continuacion->setCaIdCotizacion( $this->getRequestParameter("cotizacionId") );
				$continuacion->setCaTipo( $this->getRequestParameter("otmdta") );
				$continuacion->setCaModalidad( $this->getRequestParameter("modalidad") );
				$continuacion->setCaOrigen( $this->getRequestParameter("idciu_origen") );
				$continuacion->setCaDestino( $this->getRequestParameter("idciu_destino") );
				$continuacion->setCaIdConcepto( $this->getRequestParameter("idconceptoOtmDta") );
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
		
		if( $this->getRequestParameter("frecuencia") ){
			$continuacion->setCaFrecuencia( $this->getRequestParameter("frecuencia") );
		}
		
		if( $this->getRequestParameter("ttransito") ){
			$continuacion->setCaTiempoTransito( $this->getRequestParameter("ttransito") );
		}
		
		if( $this->getRequestParameter("observaciones") ){
			$continuacion->setCaObservaciones( $this->getRequestParameter("observaciones") );
		}
		
		if( !$update ){ 
			$continuacion->setCaFchcreado( time() );
			$continuacion->setCaUsucreado( $user_id );
		}else{
			$continuacion->setCaFchactualizado( time() );
			$continuacion->setCaUsuactualizado( $user_id );		
		}

		$continuacion->save();
		return sfView::NONE;
	}
	
	
	/*
	* Guarda los cambios realizados en la Plantilla Seguros  
	* @author Carlos G. López M.
	*/
	public function executeObserveSegurosManagement(){
		$user_id = $this->getUser()->getUserId();

		if( $this->getRequestParameter( "oid" ) ) {
			$c = new Criteria();
			$c->add( CotSeguroPeer::OID , $this->getRequestParameter("oid") );
			$seguro = CotSeguroPeer::doSelectOne( $c );
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

		if( !$this->getRequestParameter( "oid" ) ){ 
			$seguro->setCaFchcreado( time() );	
			$seguro->setCaUsucreado( $user_id );			
		}else{
			$seguro->setCaFchactualizado( time() );	
			$seguro->setCaUsuactualizado( $user_id );							
		}
		
		$seguro->save();
		return sfView::NONE;
	}
	
	/**
	* Permite consultar una cotizacion ya creada y permite 
	* agregar nuevas  
	* @author Carlos G. López M.
	*/
	public function executeConsultaCotizacion(){
		
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/myRowExpander",'last');
		$response->addJavaScript("extExtras/NumberFieldMin",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');
	
		if( !is_null($this->getRequestParameter("id")) ) {
			$id_cotizacion = $this->getRequestParameter("id");	
			$cotizacion = CotizacionPeer::retrieveByPk( $id_cotizacion );
			$this->forward404Unless( $cotizacion );					
			$this->editable = $this->getRequestParameter("editable");	
			$this->option = $this->getRequestParameter("option");
			$this->cotizacion = $cotizacion;
		}else {
			$user = $this->getUser()->getUserId();
			$this->cotizacion = new Cotizacion();
			$this->cotizacion->setCaFchCotizacion(date("Y-m-d"));
			$this->cotizacion->setCaAsunto("COTIZACION");
			$this->cotizacion->setCaSaludo("Respetados Señores:");
			$this->cotizacion->setCaEntrada("Nos  complace  saludarlos,  nos permitimos presentar oferta para el transporte internacional de mercancía no peligrosa ni extradimensionada así :");
			$this->cotizacion->setCaDespedida("Esperamos que esta cotización sea de su conveniencia y quedamos a su entera disposición para atender cualquier inquietud adicional.");
			$this->cotizacion->setCaAnexos("Notas importantes para sus importaciones y/o exportaciones.");
			$this->cotizacion->setCaUsuario($user);
		}
		
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
		$aplicar_tar = $this->getRequestParameter("aplicar_tar");
		$aplicar_min = $this->getRequestParameter("aplicar_min");
		$observaciones = $this->getRequestParameter("detalles");
		
		$tipo = $this->getRequestParameter("tipo");
			
		if( $tipo=="concepto" ){
			$iditem = $this->getRequestParameter("iditem");
			
			if( !$idopcion ){						
				$opcion = new CotOpcion();
				$opcion->setCaIdCotizacion( $idcotizacion );
				$opcion->setCaIdProducto( $idproducto );
				$opcion->setCaFchcreado( time() );
				$opcion->setCaUsucreado( $this->getUser()->getUserId() );	
				
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
			if( $valor_tar ){
				$opcion->setCaValorTar( $valor_tar );
			}
			
			if( $valor_min ){
				$opcion->setCaValorMin( $valor_min );
			}
			
			if( $aplicar_tar ){
				$opcion->setCaAplicarTar( $aplicar_tar );
			}
			
			if( $aplicar_min ){
				$opcion->setCaAplicarMin( $aplicar_min );
			}
			if( $observaciones ){
				$opcion->setCaObservaciones( $observaciones );
			}	
			$opcion->save();
			echo "adasdasdadasdasd";			
		}
		if( $tipo=="recargo" ){
			$iditem = $this->getRequestParameter("iditem");			
			$idconcepto = $this->getRequestParameter("idconcepto");			
			$modalidad = $this->getRequestParameter("modalidad");
					
			$opcion = CotRecargoPeer::retrieveByPk( $idcotizacion, $idproducto, $idopcion, $idconcepto, $iditem, $modalidad );
									
			if( !$opcion ){			
				$opcion = new CotRecargo();			
				$opcion->setCaFchcreado( time() );
				$opcion->setCaUsucreado( $this->getUser()->getUserId() );			
				$opcion->setCaIdCotizacion( $idcotizacion );
				$opcion->setCaIdProducto( $idproducto );	
				$opcion->setCaIdOpcion( $idopcion );	
				$opcion->setCaIdConcepto( $idconcepto );
				$opcion->setCaIdRecargo( $iditem );
				$opcion->setCaModalidad( $modalidad );
				$opcion->setCaValorTar( 0 );
				$opcion->setCaValorMin( 0 );
			}else{
				$opcion->setCaFchactualizado( time() );
				$opcion->setCaUsuactualizado( $this->getUser()->getUserId() );		
			}		
				
			$opcion->setCaTipo( "$" ); //FIX-ME
			if( $idmoneda ){	
				$opcion->setCaIdMoneda( $idmoneda );
			}
			if( $valor_tar ){
				$opcion->setCaValorTar( $valor_tar );
			}
			
			if( $valor_min ){
				$opcion->setCaValorMin( $valor_min );
			}
			
			if( $aplicar_tar ){
				$opcion->setCaAplicarTar( $aplicar_tar );
			}
			
			if( $aplicar_min ){
				$opcion->setCaAplicarMin( $aplicar_min );
			}	
			
			if( $observaciones ){
				$opcion->setCaObservaciones( $observaciones );
			}									
			$opcion->save();	
		}
		
		return sfView::NONE;
	}
	/*
	* Datos de las modalidades según sea el medio de transporte
	*/
	public function executeDatosModalidades(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));
		
		if ( $transport_parameter == 'Marítimo')	{
			$transportes = ParametroPeer::retrieveByCaso( "CU051",null, $impoexpo_parameter);
		}else if ( $transport_parameter == 'Aéreo')	{
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
		
		$rs = ConceptoPeer::doSelectRS( $c );

		$this->conceptos = array();
		
		while ( $rs->next() ) {
			$row = array('idconcepto'=>$rs->getString(1), 'concepto'=>utf8_encode($rs->getString(2)));
			$this->conceptos[]=$row;
		}

		$this->setLayout("ajax");
	}

	/*
	* Formas de Aplicación de una Tarifa o un Recargo
	*/
	public function executeDatosAplicacion(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$aplic = array("Aéreo" => array("x Kg ó 6 Dm³", "x Lb ó 166 Pul³", "x HAWB", "Sobre Flete"), "Marítimo" => array("x T/M³", "x Contenedor", "x HBL", "x Pieza", "Sobre Flete"));

		$this->aplicaciones = array();

		while (list ($clave, $val) = each ($aplic[$transport_parameter])) {
			$row = array("aplicacion"=>$val);
			$this->aplicaciones[]=$row;
		}
		$this->setLayout("ajax");
	}
		
	
	/*
	* Genera un archivo PDF a partir de una cotización
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
	* Envia una cotización por correo 	
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
		foreach( $cotProductos as $producto ){
			$origen = $producto->getOrigen();
			$destino = $producto->getDestino();
			$escala = $producto->getEscala();					
			$trayecto = " [".utf8_encode( $origen->getCaCiudad() )." - ".utf8_encode($origen->getTrafico()->getCaNombre()." » ");
			
			if( $escala ){
				$trayecto .= utf8_encode($escala->getCaCiudad())." - ".utf8_encode($escala->getTrafico()->getCaNombre()." » ");
			}
			
			$trayecto .= utf8_encode($destino->getCaCiudad())." - ".utf8_encode($destino->getTrafico()->getCaNombre())."] ";
			
			//Se envian las opciones existentes
			$c = new Criteria();
			$c->add( CotOpcionPeer::CA_IDPRODUCTO, $producto->getCaIdProducto() );
			$opciones = $producto->getCotOpciones( $c );
			foreach( $opciones as $opcion ){
				$concepto = $opcion->getConcepto();
				$this->productos[] = array('id'=>"",
						 'trayecto'=>$trayecto,
						 'idopcion'=>$opcion->getCaIdOpcion(),
						 'iditem'=>$opcion->getCaIdConcepto(),
						 'item'=>$concepto->getCaConcepto(),
						 'idproducto'=>$producto->getCaIdProducto(),
						 'producto'=>$producto->getCaProducto(),
						 'idcotizacion'=>$producto->getCaIdCotizacion(),		 							
						 
						 'tra_origen'=>$origen->getCaIdTrafico(),
						 'tra_origen_value'=>$origen->getTrafico()->getCaNombre(),
						 'ciu_origen'=>$origen->getCaIdCiudad(),
						 'ciu_origen_value'=>$origen->getCaCiudad(),
						 'tra_destino'=>$destino->getCaIdTrafico(),
						 'tra_destino_value'=>$destino->getTrafico()->getCaNombre(),
						 'ciu_destino'=>$destino->getCaIdCiudad(),
						 'ciu_destino_value'=>$destino->getCaCiudad(),
						 'tra_escala'=>$escala?$escala->getCaIdTrafico():"",
						 'tra_escala_value'=>$escala?$escala->getTrafico()->getCaNombre():"",
						 'ciu_escala'=>$escala?$escala->getCaIdCiudad():"",
						 'ciu_escala_value'=>$escala?$escala->getCaCiudad():"",
						 
						 'valor_tar'=>$opcion->getCaValorTar(),
						 'aplica_tar'=>$opcion->getCaAplicaTar(),
						 'valor_min'=>$opcion->getCaValorMin(),
						 'aplica_min'=>$opcion->getCaAplicaMin(),
						 'idmoneda'=>$opcion->getCaIdmoneda(),
						 'detalles'=>$opcion->getCaObservaciones(),
						 'transporte'=>utf8_encode($producto->getCaTransporte()),
						 'modalidad'=>utf8_encode($producto->getCaModalidad()),
						 'impoexpo'=>utf8_encode($producto->getCaImpoexpo()),
						 'incoterms'=>utf8_encode($producto->getCaIncoterms()),
						 'frecuencia'=>utf8_encode($producto->getCaFrecuencia()),
						 'ttransito'=>utf8_encode($producto->getCaTiempotransito()),
						 'imprimir'=>utf8_encode($producto->getCaImprimir()),
						 'observaciones'=>utf8_encode($producto->getCaObservaciones()),
						 'tipo'=>"concepto"
					);
					 				 
				 //Se muestran los recargos 
				$recargos = $opcion->getCotRecargos();
				foreach( $recargos as $recargo ){
					$tipoRecargo = $recargo->getTipoRecargo();
					$this->productos[] = array('id'=>"",
						 'trayecto'=>$trayecto,
						 'idopcion'=>$opcion->getCaIdOpcion(),
						 'iditem'=>$tipoRecargo->getCaIdRecargo(),
						 'item'=>$tipoRecargo->getCaRecargo() ,
						 'idproducto'=>$producto->getCaIdProducto(),
						 'producto'=>$producto->getCaProducto(),
						 'idcotizacion'=>$producto->getCaIdCotizacion(),
						 
						 'tra_origen'=>$origen->getCaIdTrafico(),
						 'tra_origen_value'=>$origen->getTrafico()->getCaNombre(),
						 'ciu_origen'=>$origen->getCaIdCiudad(),
						 'ciu_origen_value'=>$origen->getCaCiudad(),
						 'tra_destino'=>$destino->getCaIdTrafico(),
						 'tra_destino_value'=>$destino->getTrafico()->getCaNombre(),
						 'ciu_destino'=>$destino->getCaIdCiudad(),
						 'ciu_destino_value'=>$destino->getCaCiudad(),
						 'tra_escala'=>$escala?$escala->getCaIdTrafico():"",
						 'tra_escala_value'=>$escala?$escala->getTrafico()->getCaNombre():"",
						 'ciu_escala'=>$escala?$escala->getCaIdCiudad():"",
						 'ciu_escala_value'=>$escala?$escala->getCaCiudad():"",
						 	 
						 'idconcepto'=>$recargo->getCaIdConcepto(),
						 'valor_tar'=>$recargo->getCaValorTar(),
						 'aplica_tar'=>$recargo->getCaAplicaTar(),
						 'valor_min'=>$recargo->getCaValorMin(),
						 'aplica_min'=>$recargo->getCaAplicaMin(),
						 'idmoneda'=>$recargo->getCaIdmoneda(),
						 'detalles'=>$recargo->getCaObservaciones(),
						 
						 'transporte'=>utf8_encode($producto->getCaTransporte()),
						 'modalidad'=>utf8_encode($producto->getCaModalidad()),
						 'impoexpo'=>utf8_encode($producto->getCaImpoexpo()),
						 'incoterms'=>utf8_encode($producto->getCaIncoterms()),
						 'frecuencia'=>utf8_encode($producto->getCaFrecuencia()),
						 'ttransito'=>utf8_encode($producto->getCaTiempotransito()),
						 'imprimir'=>utf8_encode($producto->getCaImprimir()),
						 'observaciones'=>utf8_encode($producto->getCaObservaciones()),
						 'tipo'=>"recargo"
					);
				}
				 
			}
			
			
			//Se envia una fila vacia por cada grupo para agregar una nueva opción  
			$row = array('id'=>"",
						 'trayecto'=>$trayecto,						 
						 'iditem'=>"",
						 'item'=>"",
						 'idproducto'=>$producto->getCaIdProducto(),
						 'producto'=>$producto->getCaProducto(),
						 'idcotizacion'=>$producto->getCaIdCotizacion(),
						 
  					  	 'tra_origen'=>$origen->getCaIdTrafico(),
						 'tra_origen_value'=>$origen->getTrafico()->getCaNombre(),
						 'ciu_origen'=>$origen->getCaIdCiudad(),
						 'ciu_origen_value'=>$origen->getCaCiudad(),
						 'tra_destino'=>$destino->getCaIdTrafico(),
						 'tra_destino_value'=>$destino->getTrafico()->getCaNombre(),
						 'ciu_destino'=>$destino->getCaIdCiudad(),
						 'ciu_destino_value'=>$destino->getCaCiudad(),
						 'tra_escala'=>$escala?$escala->getCaIdTrafico():"",
						 'tra_escala_value'=>$escala?$escala->getTrafico()->getCaNombre():"",
						 'ciu_escala'=>$escala?$escala->getCaIdCiudad():"",
						 'ciu_escala_value'=>$escala?$escala->getCaCiudad():"",	
						 
						 'valor_tar'=>"",
						 'aplica_tar'=>"",
						 'valor_min'=>"",
						 'aplica_min'=>"",
						 'idmoneda'=>"",
						 'detalles'=>"",
						 'transporte'=>utf8_encode($producto->getCaTransporte()),
						 'modalidad'=>utf8_encode($producto->getCaModalidad()),
						 					 
						 'impoexpo'=>utf8_encode($producto->getCaImpoexpo()),
						 'incoterms'=>utf8_encode($producto->getCaIncoterms()),
						 'frecuencia'=>utf8_encode($producto->getCaFrecuencia()),
						 'ttransito'=>utf8_encode($producto->getCaTiempotransito()),
						 'imprimir'=>utf8_encode($producto->getCaImprimir()),
						 'observaciones'=>utf8_encode($producto->getCaObservaciones()),
						 'tipo'=>'concepto'
						); 
			$this->productos[] = $row; 
		}	
	}
	
	
	/*
	* Copia una cotización existente en una nueva 
	*/
	public function executeCopiarCotizacion(){
		$cotizacion = CotizacionPeer::retrieveByPk($this->getRequestParameter("idcotizacion"));
		$this->forward404Unless($cotizacion);
		
		$newCotizacion = $cotizacion->copy( false ); //La copia recursiva se hace paso a paso por que las llaves son naturales 
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
			$newContinuacion->setCaTipo( $continuacion->getCaTipo() );
			$newContinuacion->setCaOrigen( $continuacion->getCaOrigen() );
			$newContinuacion->setCaDestino( $continuacion->getCaDestino() );
			$newContinuacion->setCaIdconcepto( $continuacion->getCaIdconcepto() );
			$newContinuacion->save();			
		}
		
		
		$this->redirect("cotizaciones/consultaCotizacion?id=".$newCotizacion->getCaIdCotizacion());				
	}
}
?>
