<?php

/**
 * Subclass for representing a row from the 'tb_inoclientes_sea' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class InoClientesSea extends BaseInoClientesSea
{
	var $continuacion = null;
	/*
	* Retorna los objetos InoIngresosSea asociados al reporte
	* @author Andres Botero
	*/
	public function getInoIngresosSeas(){
		$c  = new Criteria();
		$c->add( InoIngresosSeaPeer::CA_REFERENCIA , $this->getCaReferencia() );
		$c->add( InoIngresosSeaPeer::CA_IDCLIENTE , $this->getCaIdCliente() );
		$c->add( InoIngresosSeaPeer::CA_HBLS , $this->getCaHbls() );
		$inoingresos = InoIngresosSeaPeer::doSelect( $c );
		return $inoingresos;
		
	}
	
	/*
	* Retorna un objeto InoAvisosSea con el ultimo estatus enviado
	* @author Andres Botero
	*/
	public function getUltimoStatusOTM(){
		$c = new Criteria();
		$c->addDescendingOrderByColumn( InoAvisosSeaPeer::CA_FCHAVISO );
		$c->add( InoAvisosSeaPeer::CA_REFERENCIA, $this->getCaReferencia() );
		$c->add( InoAvisosSeaPeer::CA_IDCLIENTE, $this->getCaIdCliente() );
		$c->add( InoAvisosSeaPeer::CA_HBLS, $this->getCaHbls() );
		return InoAvisosSeaPeer::doSelectOne( $c );		
	}
	
	/*
	* Retorna todos los avisos enviados con esta referencia 
	*/
	public function getStatuss(){
		$c = new Criteria();		
		$c->addDescendingOrderByColumn( InoAvisosSeaPeer::CA_FCHAVISO );
		$c->add( InoAvisosSeaPeer::CA_REFERENCIA, $this->getCaReferencia() );
		$c->add( InoAvisosSeaPeer::CA_IDCLIENTE, $this->getCaIdCliente() );
		$c->add( InoAvisosSeaPeer::CA_HBLS, $this->getCaHbls() );		
		return InoAvisosSeaPeer::doSelect( $c );		
	}
	
	
	/*
	* Retorna el estado actual de la referencia 
	* author: Andres Botero
	*/
	public function getStatus(){
		$refSea = $this->getInoMaestraSea();
		if( $refSea->getCaFchconfirmado( ) ){						
			$texto = "La MN ".($refSea->getCaMnLlegada(  ) ?$refSea->getCaMnLlegada(  ):$refSea->getCaMotonave())." arribó a ".$refSea->getDestino()->getCaCiudad().", el dia ".Utils::fechaMes( $refSea->getCaFchconfirmacion() )." con la orden en referencia a bordo.\n". ucfirst($refSea->getCaMensaje()." ".$this->getCamensaje());			
			return $texto;
			
		}	
	}
	
	/*
	* Retorna la ciudad de continuación de viaje
	* author: Andres Botero
	*/
	public function getContinuacion(){
		if( $this->continuacion ){
			return $this->continuacion;
		}else{
			if( $this->getCaContinuacionDest() ){
				$this->continuacion = CiudadPeer::retrieveByPk( $this->getCaContinuacionDest() );
				return $this->continuacion;
			}
		}
		return null;
	}
	
	
	
}
?>