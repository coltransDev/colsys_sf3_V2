<?php

/**
 * Subclass for representing a row from the 'tb_repavisos' table.
 *
 * 
 *
 * @package lib.model.sea
 */
class RepAviso extends BaseRepAviso {
	/*
	* Retorna la etapa del aviso
	* @author: Andres Botero
	*/
	public function getEtapa() {
		$c = new Criteria ( );
		$c->add ( ParametroPeer::CA_CASOUSO, "CU045" );
		$c->add ( ParametroPeer::CA_IDENTIFICACION, $this->getCaEtapa () );
		$modalidad = ParametroPeer::doSelectOne ( $c );
		
		if ($modalidad) {
			return $modalidad->getCaValor ();
		} else {
			return null;
		}
	}
	
	public function getStatus() {
		$resultado = "";		
		switch( $this->getCaTipo () ){			
			
			case "Status":
				$resultado= "Nuestra oficina ha hecho reserva para ".$this->getCaFchsalida ()." en la MN ".$this->getCaIdnave ()." , fecha estimada de zarpe: " . $this->getCaFchsalida () . " y fecha estimada de arribo: ".$this->getCaFchllegada();
				
				break;
			case "Confirmación de salida":	
				$resultado = "Nuestra oficina nos informa que la MN " . $this->getCaIdnave () . " zarpò el " . Utils::fechaMes($this->getCaFchsalida ()) . " con la orden en referencia a bordo ";
				if( $this->getCaFchllegada() ) {
					$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
				}
				
				
				break;
			default:			
				if( $this->getcaIdnave () ){
					$resultado.= "MN " . $this->getcaIdnave () ." ";
				}			
				$resultado .= "ETS " . Utils::fechaMes($this->getCaFchsalida ()) . "  ";
				if( $this->getCaFchllegada() ) {
					$resultado.= ",ETA ".Utils::fechaMes($this->getCaFchllegada()).".";				
				}
				break;	
		}
		return $resultado;
	}
}
?>