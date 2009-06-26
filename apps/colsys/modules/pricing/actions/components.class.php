<?php

/**
 * pricing components.
 *
 * @package    colsys
 * @subpackage pricing
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pricingComponents extends sfComponents
{ 
 	/*
	* Muestra un panel con noticias 
	*/
	public function executePanelNoticias(){
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		$this->opcion = "";
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		if( $this->nivel==0 ){
			$this->opcion = "consulta";
		}
		$c = new Criteria();
		$c->add( PricNotificacionPeer::CA_CADUCIDAD, date("Y-m-d"), Criteria::GREATER_EQUAL );
		$c->addAscendingOrderByColumn( PricNotificacionPeer::CA_FCHCREADO );
		$notificaciones = PricNotificacionPeer::doSelect( $c );
		
		$this->data=array();
		foreach( $notificaciones as $notificacion ){
			$row =  array(	"idnotificacion"=>$notificacion->getCaIdnotificacion(),
							"titulo"=>utf8_encode($notificacion->getCaTitulo()), 
							"mensaje"=>utf8_encode($notificacion->getCaMensaje()), 
							"caducidad"=>$notificacion->getCaCaducidad(),
							"fchcreado"=>$notificacion->getCaFchcreado(), 
							"usucreado"=>$notificacion->getCaUsucreado() );
			$this->data[] = $row;
		}
	}
	
	/*
	* Muestra un arbol con la información de los traficos donde el usuario 
	* puede seleccionar una ciudad
	* @author: Andres Botero 
	*/
	public function executePanelConsultaCiudades(){
		
	}
	
	
	/*
	* Muestra la informacion del panel de cargas nacionales
	* @author: Andres Botero 
	*/
	public function executePanelCargasNacionales(){
		
	}
	
	/*
	* Muestra información como deposito, liberacion o creditoen la parte 
	* superior del panel de recargos locales
	* puede seleccionar una ciudad
	* @author: Andres Botero 
	*/
	public function executePanelParametrosRecargosLocales(){
		
		$this->transporte = utf8_decode($this->getRequestParameter( "transporte" ));		
		$this->modalidad = $this->getRequestParameter( "modalidad" );
		$this->impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$this->idlinea = $this->getRequestParameter( "idlinea" );
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
		
		$this->parametros = ParametroPeer::retrieveByCaso("CU071");
		
	}
	
	/*
	* Permite colocar los valores de los recargos (Locales o en origen) por linea
	* @author: Andres Botero 
	*/
	public function executePanelRecargosLinea(){
	
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );
	
		$transporte = utf8_decode($this->getRequestParameter( "transporte" ));
		$idtrafico = $this->getRequestParameter( "idtrafico" );
		$idlinea = $this->getRequestParameter( "idlinea" );
		$modalidad = $this->getRequestParameter( "modalidad" );
		$impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		
		if( $idtrafico ){
			$this->trafico = TraficoPeer::retrieveByPk($idtrafico);	
						
			$tipo = Constantes::RECARGO_EN_ORIGEN;			
			
			if( $idtrafico != "99-999" ){
				$this->titulo = "Recargos x Linea»".substr( $impoexpo ,0 ,4 )."»".$modalidad."»".$this->trafico->getCaNombre();								
			}else{
				$this->titulo = "Recargos Locales";		
			}
		}else{
			$tipo = Constantes::RECARGO_LOCAL;	
			$idtrafico = "99-999"; 
			$this->titulo = "Recargos Locales";		
		}
				
		if( $this->opcion != "consulta" ){				
			$c = new Criteria();
			$c->add( TipoRecargoPeer::CA_TRANSPORTE, $transporte);	
			$c->add( TipoRecargoPeer::CA_TIPO , $tipo );
			$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
			$this->recargos = TipoRecargoPeer::doSelect( $c );
			
			$c = new Criteria();
			$c->add( ConceptoPeer::CA_TRANSPORTE, $transporte);	
			$c->add( ConceptoPeer::CA_MODALIDAD , $modalidad );
			$c->addAscendingOrderByColumn( ConceptoPeer::CA_CONCEPTO );
			$this->conceptos = ConceptoPeer::doSelect( $c );
			
			$c = new Criteria();
			
			if( $impoexpo==Constantes::IMPO ){			
				$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );		
			}else{
				$c->addJoin( TrayectoPeer::CA_DESTINO, CiudadPeer::CA_IDCIUDAD );			
			}
			$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );	
			if( $idtrafico != "99-999" ){ 	
				$c->add( CiudadPeer::CA_IDTRAFICO, $idtrafico );
			}
			$c->add( TrayectoPeer::CA_IMPOEXPO, $impoexpo );
			$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
			$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
			//$c->add( TrayectoPeer::CA_ACTIVO, true );
			$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );
			$c->setDistinct();	
			$this->lineas = TransportadorPeer::doSelect( $c );
						
			$this->aplicaciones = ParametroPeer::retrieveByCaso("CU064", null, $transporte );
		}
		
		$this->modalidad = $modalidad;
		$this->transporte = $transporte;
		$this->idtrafico = $idtrafico;
		$this->idlinea = $idlinea;
		$this->impoexpo = $impoexpo;	
		
	}
	
	
	/*
	* Muestra información como deposito, liberacion o creditoen la parte 
	* superior del panel de recargos locales
	* puede seleccionar una ciudad
	* @author: Andres Botero 
	*/
	public function executePanelPatiosRecargosLocales(){
		
		$this->transporte = utf8_decode($this->getRequestParameter( "transporte" ));		
		$this->modalidad = $this->getRequestParameter( "modalidad" );
		$this->impoexpo = utf8_decode($this->getRequestParameter( "impoexpo" ));
		$this->idlinea = $this->getRequestParameter( "idlinea" );
		$this->nivel = $this->getUser()->getNivelAcceso( pricingActions::RUTINA );	
	}
		
}
?>