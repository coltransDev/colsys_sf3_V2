<?php

/**
 * general components.
 *
 * @package    colsys
 * @subpackage general
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class generalComponents extends sfComponents
{
	/*
	* Muestra un cuadro de seleccion con las ciudades disponibles disponibles.
	*/
	public function executeSeleccionCiudad()
	{
		if( !$this->fieldName ){
			$this->fieldName="idCiudad";
		}
		
		
		if( !$this->selected ){
			$this->selected="";
		}
		
	
		$trafico_id = $this->trafico_id;		
		$c = new Criteria();
		$c->add( CiudadPeer::CA_IDTRAFICO, $this->trafico_id );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		$this->ciudades = CiudadPeer::doSelect( $c );			
	}
	
	
	/*
	* Muestra un cuadro de seleccion con los traficos disponibles, cuando se actualiza cambia la ciudad
	* por medio de AJAX
	*/
	public function executeSeleccionTrafico(){
		
		if( !$this->fieldName ){
			$this->fieldName="idTrafico";
		}
		
		if( !$this->selected ){
			$this->selected="";
		}
		
		$c = new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$this->traficos = TraficoPeer::doSelect( $c );
	}
	
	/*
	* Muestra una seleccion de las cotizaciones a partir del numero
	*/
	public function executeComboCotizaciones(){
		$response = sfContext::getInstance()->getResponse();
		$response->addJavascript('components/comboCotizaciones');
		$this->selected="";
	}
	
	/*
	* Muestra un formulario standar para enviar un correo
	*/
	public function executeFormEmail(){
		$this->user = $this->getUser();
		
	}
	
}
?>