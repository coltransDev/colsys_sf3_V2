<?php

/**
 * general actions.
 *
 * @package    colsys
 * @subpackage general
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class generalActions extends sfActions
{
	/**
	* Toma el parametro trafico_id y muestra el cuadro de seleccuion de ciudades correspondiente
	*/
	public function executeSeleccionCiudad()
	{
		$this->setLayout("ajax");		
		$this->trafico_id = $this->getRequestparameter("trafico_id");		
	}
	
	public function executeSelectAgentes(){
		$this->setLayout("ajax");	
		
		$this->ciudad_id = $this->getRequestparameter("ciudad_id");		
		
		$this->selected = $this->getRequestparameter("selected");		
		$c = new Criteria();	
		if( $this->ciudad_id ){
			$c->add( AgentePeer::CA_IDCIUDAD, $this->ciudad_id );
			
			$criterion = $c->getNewCriterion( AgentePeer::CA_IDCIUDAD, $this->ciudad_id );	
			if( $this->selected ){							
				$criterion->addOr($c->getNewCriterion( AgentePeer::CA_IDAGENTE, $this->selected));			}
			$c->add($criterion);	
			
		}
		$c->addAscendingOrderByColumn( AgentePeer::CA_NOMBRE );
		$this->agentes = AgentePeer::doSelect( $c );
	}
	
	public function executeBuscarCotizacion(){
		$criterio=$this->getRequestParameter("criterio");
		$modalidad=$this->getRequestParameter("modalidad");
		
		if( $criterio || $modalidad=="Mis Cotizaciones" ){					
			$c=new Criteria();
			
			switch( $modalidad ){
				case "Mis Cotizaciones":					
					$c->add( CotizacionPeer::CA_USUCREADO, $this->getUser()->getUserId() );	
					break;	
				case "Nombre del Cliente":	
					$c->addJoin( CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO );
					$c->addJoin( ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );
					$c->add( ClientePeer::CA_COMPANIA , "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );
					$c->setDistinct();
					break;	
			}

			$c->addDescendingOrderByColumn( CotizacionPeer::CA_IDCOTIZACION  );
			$c->setLimit( 50 );						 
			$this->cotizaciones = CotizacionPeer::doSelect($c);
			$this->setTemplate("buscarCotizacionResult");
			
			
		}
	}
	
	
	public function executeFileViewer(){
		$idx = $this->getRequestParameter("idx"); 
		$this->name = $this->getUser()->getFile( $idx );
		
		$this->setLayout("none");
	}
	
	
	
	/*
	* 
	*/
	
	public function executeListaCotizacionesJSON(){
		$criterio =  $this->getRequestParameter("query");
		

				
		$c = new Criteria();
		$c->addSelectColumn( CotizacionPeer::CA_IDCOTIZACION );
		$c->addSelectColumn( CotProductoPeer::CA_IDPRODUCTO );
		$c->addSelectColumn( CotProductoPeer::CA_ORIGEN );
		$c->addSelectColumn( CotProductoPeer::CA_DESTINO );		
		$c->addSelectColumn( CotizacionPeer::CA_IDCONTACTO );
		$c->addSelectColumn(ClientePeer::CA_COMPANIA );
		$c->addSelectColumn(ContactoPeer::CA_NOMBRES );
		$c->addSelectColumn(ContactoPeer::CA_PAPELLIDO );
		$c->addSelectColumn(ContactoPeer::CA_SAPELLIDO );
		$c->addSelectColumn(ContactoPeer::CA_CARGO );
		$c->addSelectColumn(ClientePeer::CA_PREFERENCIAS );
		$c->addSelectColumn(ClientePeer::CA_CONFIRMAR );
		
		
		$c->setDistinct();
		$c->addJoin(  CotizacionPeer::CA_IDCOTIZACION, CotProductoPeer::CA_IDCOTIZACION );
		$c->addJoin(  CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO );
		$c->addJoin(  CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO );
		$c->addJoin(  ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );
		
	
		
		$criterion = $c->getNewCriterion( CotizacionPeer::CA_IDCOTIZACION , "lower(".CotizacionPeer::CA_IDCOTIZACION.") LIKE '".strtolower( $criterio )."%'", Criteria::CUSTOM );								
		$criterion->addOr($c->getNewCriterion(CotizacionPeer::CA_IDCOTIZACION , "lower(".CotizacionPeer::CA_ASUNTO.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM));			
		$c->add($criterion);
		
		$c->addAscendingOrderByColumn( CotizacionPeer::CA_IDCOTIZACION );
		$c->add( CotProductoPeer::CA_IMPOEXPO, "Exportación" );
		$c->setLimit(15);
		$rs = CotProductoPeer::doSelectRS( $c );
		
				
		$this->cotizaciones = array();
 
   		while ( $rs->next() ) {
			$origen = CiudadPeer::retrieveByPk( $rs->getString(3) );
			$destino = CiudadPeer::retrieveByPk( $rs->getString(4) );
      		$this->cotizaciones[] = array('ca_idcotizacion'=>$rs->getString(1),
                                      'ca_idproducto'=>utf8_encode($rs->getString(2)),
									  'ca_origen'=>utf8_encode($origen->getCaCiudad()),
									  'ca_idorigen'=>utf8_encode($rs->getString(3)),
									  
									  'ca_destino'=>utf8_encode($destino->getCaCiudad()),
									  'ca_iddestino'=>utf8_encode($rs->getString(4)),
									  'ca_idcontacto'=>utf8_encode($rs->getString(5)),								  
                                      'ca_compania'=>utf8_encode($rs->getString(6)),
									  'ca_nombres'=>utf8_encode($rs->getString(7)),
									  'ca_papellido'=>utf8_encode($rs->getString(8)),
									  'ca_sapellido'=>utf8_encode($rs->getString(9)),      
									  'ca_cargo'=>utf8_encode($rs->getString(10)), 
									  'ca_preferencias'=>utf8_encode($rs->getString(11)),                                  	  'ca_confirmar'=>utf8_encode($rs->getString(12))										 
                                 );
		}					
		$this->setLayout("none");
		
	}
	
	/*
	* Permite ver un email
	*/
	public function executeVerEmail( $request ){
		$this->email = EmailPeer::retrieveByPk($request->getParameter("id"));
		$this->forward404Unless( $this->email );		
		$this->user = UsuarioPeer::retrieveByPk( $this->email->getCaUsuEnvio() );
		
		$this->setLayout("popup");	
		
	}
	
	
}
?>