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
	
	
}
?>