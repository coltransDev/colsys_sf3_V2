<?php

/**
 * Subclass for representing a row from the 'tb_cotproductos' table.
 *
 * 
 *
 * @package lib.model.public
 */ 
class CotProducto extends BaseCotProducto
{
	/*
	* Convierte automaticamente este objeto a string
	* Author: Andres Botero
	*/
	public function __toString(){
		$trayecto = "";
		$origen = $this->getOrigen();
		$destino = $this->getDestino();
		$escala = $this->getEscala();					
		
		$linea = $this->getTransportador();
			
		if( $linea ){
			$lineaStr = $linea->getCaNombre();
		}else{
			$lineaStr = "";
		}
		
		$trayecto = $this->getCaImpoExpo()." ".$this->getCaTransporte()." ".$this->getCaModalidad()." [".$origen->getCaCiudad()." - ".$origen->getTrafico()->getCaNombre()." » ";
		
		
		if( $escala ){
			$trayecto .= $escala->getCaCiudad()." - ".$escala->getTrafico()->getCaNombre()." » ";
		}
		
		$trayecto .= $destino->getCaCiudad()." - ".$destino->getTrafico()->getCaNombre()."]  ".$lineaStr." ".$this->getCaIdProducto();
		return $trayecto;
	}
	
	/*
	* Retorna el id del objeto
	* Author: Andres Botero
	*/
	public function getId(){
		return $this->getCaIdProducto();
	}
	/*
	* Retorna el objeto ciudad asociado al campo ca_origen
	* Author: Andres Botero
	*/
	public function getOrigen(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaOrigen() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
	/*
	* Retorna el objeto ciudad asociado al campo ca_destino
	* Author: Andres Botero
	*/
	public function getDestino(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaDestino() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
	/*
	* Retorna el objeto ciudad asociado al campo ca_escala
	* Author: Andres Botero
	*/
	public function getEscala(){
		$c = new Criteria();
		$c->add(  CiudadPeer::CA_IDCIUDAD, $this->getCaEscala() );
		return CiudadPeer::doSelectOne( $c );		
	}
	
	/*
	*alias para getCotOpciones
	* Author: Andres Botero
	*/
	public function getCotOpciones( $c=null ){
		return $this->getCotOpcions( $c );
	}
	
	/*
	* Retorna los recargos en origen generales del producto en una cadena de texto para facilitar la impresión
	*/
	public function getTextoRecargosGenerales(){		
		$recargos = $this->getRecargosGenerales();		
		$textoRecargos = '';		
		foreach( $recargos as $recargo ){	
			$tipoRecargo = $recargo->getTipoRecargo();		
			$textoRecargos.= $recargo->getTextoRecargo()."\n";			
			
		}	
		return $textoRecargos;
	}
	/*
	* Retorna los recargos en origen generales del producto
	*/
	public function getRecargosGenerales(){
		$c = new Criteria();		
		$c->add( CotRecargoPeer::CA_IDPRODUCTO, $this->getCaIdProducto() );
		$c->add( CotRecargoPeer::CA_IDOPCION, 999 );		
		return  CotRecargoPeer::doSelect( $c );		
	}
	
	/*
	* Retorna los seguimientos de la cotización
	*/
	public function getSeguimientos(){
		$c = new Criteria();
		$c->add( CotSeguimientoPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion() );
		$c->add( CotSeguimientoPeer::CA_IDPRODUCTO, $this->getCaIdproducto() );
		$c->addDescendingOrderByColumn( CotSeguimientoPeer::CA_FCHSEGUIMIENTO );
		
		return  CotSeguimientoPeer::doSelect( $c );		
	}
	
	/*
	* Retorna los seguimientos de la cotización
	*/
	public function getUltSeguimiento(){
		$c = new Criteria();
		$c->add( CotSeguimientoPeer::CA_IDCOTIZACION, $this->getCaIdcotizacion() );
		$c->add( CotSeguimientoPeer::CA_IDPRODUCTO, $this->getCaIdproducto() );
		$c->addDescendingOrderByColumn( CotSeguimientoPeer::CA_FCHSEGUIMIENTO );
		$c->setLimit(1);
		return  CotSeguimientoPeer::doSelectOne( $c );		
	}
	
	/*
	* 
	*/
	public function getEtapa(){
		$parametro = ParametroPeer::retrieveByCaso("CU074", $this->getCaEtapa() );
		
		if( $parametro ){
			return $parametro[0]->getCaValor2();
		}
	}
	
}
