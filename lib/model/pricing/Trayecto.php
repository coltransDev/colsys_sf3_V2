<?php

/**
 * Subclass for representing a row from the 'tb_trayectos' table.
 *
 * 
 *
 * @package lib.model.pricing
 */ 
class Trayecto extends BaseTrayecto
{
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
	* Retorna los recargos generales del trayecto
	* @author Andres Botero
	*/
	public function getRecargosGenerales( $fch=null ){
		if( !$fch ){ 
			$c = new Criteria();
			$c->add( PricRecargoxConceptoPeer::CA_IDCONCEPTO, '9999' ); 
			$c->add( PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->getCaIdtrayecto() ); 
			return PricRecargoxConceptoPeer::doSelect( $c );	
		}else{
			$c = new Criteria();
			$c->addSelectColumn( PricRecargoxConceptoLogPeer::CA_IDRECARGO );
			$c->add( PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, '9999' );
			$c->add( PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->getCaIdTrayecto() );
			$c->add( PricRecargoxConceptoLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
			$c->setDistinct();
			$stmt = PricRecargoxConceptoLogPeer::doSelectStmt( $c );
			$resultados = array();
			while( $row = $stmt->fetch(PDO::FETCH_NUM) ){		
				$idrecargo = $row[0]; 
				//Se sacan el ultimo recargo 
				$c = new Criteria();
				$c->add( PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, '9999' );
				$c->add( PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->getCaIdTrayecto() );
				$c->add( PricRecargoxConceptoLogPeer::CA_IDRECARGO, $idrecargo );
				$c->add( PricRecargoxConceptoLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
				$c->addDescendingOrderByColumn( PricRecargoxConceptoLogPeer::CA_FCHCREADO );		
				$resultados[] = PricRecargoxConceptoLogPeer::doSelectOne( $c );
			}		
			return $resultados;	
		}
	}
	
	/*
	* Retorna los recargos x ciudad
	* @author Andres Botero
	*/
	public function getRecargosxCiudad( $fch=null ){
		
		$c = new Criteria();
		if( $this->getCaImpoExpo()==Constantes::IMPO ){
			$ciudad = $this->getOrigen();
		}
		
		if( $this->getCaImpoExpo()==Constantes::EXPO ){
			$ciudad = $this->getDestino();
		}
		
		if( !$fch ){ 		
			$c->add( PricRecargosxCiudadPeer::CA_IDTRAFICO, $ciudad->getCaIdTrafico() );			
			$c->add( PricRecargosxCiudadPeer::CA_IDCIUDAD, $ciudad->getCaIdciudad() );
			$c->addOr( PricRecargosxCiudadPeer::CA_IDCIUDAD, '999-9999' );
			$c->add( PricRecargosxCiudadPeer::CA_MODALIDAD, $this->getCaModalidad() );
			$c->add( PricRecargosxCiudadPeer::CA_IMPOEXPO, $this->getCaImpoExpo() );		
			return PricRecargosxCiudadPeer::doSelect( $c );	
		}else{
			$c = new Criteria();
			$c->addSelectColumn( PricRecargosxCiudadLogPeer::CA_IDRECARGO );
			$c->add( PricRecargosxCiudadLogPeer::CA_IDTRAFICO, $ciudad->getCaIdTrafico() );			
			$c->add( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $ciudad->getCaIdciudad() );
			$c->addOr( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, '999-9999' );
			$c->add( PricRecargosxCiudadLogPeer::CA_MODALIDAD, $this->getCaModalidad() );
			$c->add( PricRecargosxCiudadLogPeer::CA_IMPOEXPO, $this->getCaImpoExpo() );
			$c->add( PricRecargosxCiudadLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
			$c->setDistinct();			
			$stmt = PricRecargosxCiudadLogPeer::doSelectStmt( $c );
			$resultados = array();
			while( $row = $stmt->fetch(PDO::FETCH_NUM) ){		
				$idrecargo = $row[0]; 
				//Se sacan el ultimo recargo 
				$c = new Criteria();
				$c->add( PricRecargosxCiudadLogPeer::CA_IDTRAFICO, $ciudad->getCaIdTrafico() );			
				$c->add( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $ciudad->getCaIdciudad() );
				$c->addOr( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, '999-9999' );
				$c->add( PricRecargosxCiudadLogPeer::CA_MODALIDAD, $this->getCaModalidad() );
				$c->add( PricRecargosxCiudadLogPeer::CA_IMPOEXPO, $this->getCaImpoExpo() );
				$c->add( PricRecargosxCiudadLogPeer::CA_IDRECARGO, $idrecargo );
				$c->add( PricRecargosxCiudadLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
				$c->addDescendingOrderByColumn( PricRecargosxCiudadLogPeer::CA_FCHCREADO );		
				$resultados[] = PricRecargosxCiudadLogPeer::doSelectOne( $c );
			}		
			return $resultados;		
		}
	}
	
	/*
	* Retorna los recargos x línea
	* @author Andres Botero
	*/
	public function getRecargosxLinea( $fch=null ){
		
		$c = new Criteria();
		
		if( $this->getCaImpoExpo()==Constantes::IMPO ){
			$ciudad = $this->getOrigen();
		}
		
		if( $this->getCaImpoExpo()==Constantes::EXPO ){
			$ciudad = $this->getDestino();
		}
				
		if( !$fch ){ 		
			$c->add( PricRecargosxLineaPeer::CA_IDTRAFICO, $ciudad->getCaIdTrafico() );			
			$c->add( PricRecargosxLineaPeer::CA_IDLINEA, $this->getCaIdlinea() );			
			$c->add( PricRecargosxLineaPeer::CA_MODALIDAD, $this->getCaModalidad() );
			$c->add( PricRecargosxLineaPeer::CA_IMPOEXPO, $this->getCaImpoExpo() );		
			return PricRecargosxLineaPeer::doSelect( $c );	
		}else{
			/*$c = new Criteria();
			$c->addSelectColumn( PricRecargosxCiudadLogPeer::CA_IDRECARGO );
			$c->add( PricRecargosxCiudadLogPeer::CA_IDTRAFICO, $ciudad->getCaIdTrafico() );			
			$c->add( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $ciudad->getCaIdciudad() );
			$c->addOr( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, '999-9999' );
			$c->add( PricRecargosxCiudadLogPeer::CA_MODALIDAD, $this->getCaModalidad() );
			$c->add( PricRecargosxCiudadLogPeer::CA_IMPOEXPO, $this->getCaImpoExpo() );
			$c->add( PricRecargosxCiudadLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
			$c->setDistinct();			
			$stmt = PricRecargosxCiudadLogPeer::doSelectStmt( $c );
			$resultados = array();
			while( $row = $stmt->fetch(PDO::FETCH_NUM) ){		
				$idrecargo = $row[0]; 
				//Se sacan el ultimo recargo 
				$c = new Criteria();
				$c->add( PricRecargosxCiudadLogPeer::CA_IDTRAFICO, $ciudad->getCaIdTrafico() );			
				$c->add( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $ciudad->getCaIdciudad() );
				$c->addOr( PricRecargosxCiudadLogPeer::CA_IDCIUDAD, '999-9999' );
				$c->add( PricRecargosxCiudadLogPeer::CA_MODALIDAD, $this->getCaModalidad() );
				$c->add( PricRecargosxCiudadLogPeer::CA_IMPOEXPO, $this->getCaImpoExpo() );
				$c->add( PricRecargosxCiudadLogPeer::CA_IDRECARGO, $idrecargo );
				$c->add( PricRecargosxCiudadLogPeer::CA_FCHCREADO, $fch, Criteria::LESS_EQUAL );
				$c->addDescendingOrderByColumn( PricRecargosxCiudadLogPeer::CA_FCHCREADO );		
				$resultados[] = PricRecargosxCiudadLogPeer::doSelectOne( $c );
			}		
			return $resultados;	*/	
		}
	} 
}
