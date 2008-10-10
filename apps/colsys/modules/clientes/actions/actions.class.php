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
	
	
}
?>