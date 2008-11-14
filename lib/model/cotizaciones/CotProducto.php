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
	public function getCotOpciones(){
		return $this->getCotOpcions();
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
}
