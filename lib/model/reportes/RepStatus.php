<?php

/**
 * Subclass for representing a row from the 'tb_repstatus' table.
 *
 * 
 *
 * @package lib.model.sea
 */ 
class RepStatus extends BaseRepStatus
{
	/*
	* Retorna la etapa del status
	* @author: Andres Botero
	*/
	public function getEtapa(){
		$c=new Criteria();
		$c->add( ParametroPeer::CA_CASOUSO, "CU045" );
		$c->add( ParametroPeer::CA_IDENTIFICACION, $this->getCaEtapa() );		
		$modalidad = ParametroPeer::doSelectOne( $c );
		
		if( $modalidad ){
			return $modalidad->getCaValor();
		}else{
			return null;
		}	
	}
	
	public function getStatus(){		
		$resultado = "";	
		$reporte = $this->getReporte();	
		
		switch( $this->getCaEtapa () ){			
			
			/*case "Carga con Reserva":
				$resultado= "Nuestra oficina ha hecho reserva";
				if( $this->getCaFchreserva() ){
					$resultado.= " para el ".Utils::fechaMes($this->getCaFchreserva());
				}
				if( $this->getCaIdNave() ){
					if( $reporte->getCaTransporte()=="Aéreo" ){
						$resultado.=" en el vuelo ".$this->getCaIdNave();
					}else{
						$resultado.=" en la MN ".$this->getCaIdNave();
					}
					$resultado.=$this->getCaIdNave();
				}
				if( $this->getCaFchcierrereserva() ){
					$resultado.=" que tiene fecha de cierre: ".Utils::fechaMes($this->getCaFchcierrereserva());
				}
				if( $this->getCaFchsalida () ){
					$resultado.=", la fecha estimada de zarpe: " . Utils::fechaMes($this->getCaFchsalida ());
				}
				if( $this->getCaFchllegada() ){
				 	$resultado.= " y fecha estimada de arribo: ".Utils::fechaMes($this->getCaFchllegada());
				}
				$resultado.= $this->getCaStatus();
				break;*/
			case "Carga Embarcada":	
				if( strlen( $this->getCaStatus())>6  ){
					$resultado = $this->getCaStatus();
				}else{
					if( $reporte->getCaTransporte()=="Aéreo" ){
						$resultado = "Nuestra oficina nos informa que el vuelo " . $this->getCaIdnave () . " salió ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
					if( $reporte->getCaTransporte()=="Marítimo" ){						
						$resultado = "Nuestra oficina nos informa que la MN " . $this->getCaIdnave () . " zarpò ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
				}
				
				break;	
			case "ETA":	
				if( strlen( $this->getCaStatus())>6  ){
					$resultado = $this->getCaStatus();
				}else{
					if( $reporte->getCaTransporte()=="Aéreo" ){
						$resultado = "Nuestra oficina nos informa que el vuelo " . $this->getCaIdnave () . " salió ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
					if( $reporte->getCaTransporte()=="Marítimo" ){						
						$resultado = "Nuestra oficina nos informa que la MN " . $this->getCaIdnave () . " zarpò ";
						if( $this->getCaFchsalida () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchsalida ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						if( $this->getCaFchllegada() ) {
							$resultado.= ",la fecha estimada de arribo es el ".Utils::fechaMes($this->getCaFchllegada()).".";				
						}
					}
				}
				
				break;	
			case "Carga en Puerto de Destino":	
				if( strlen( $this->getCaStatus())>6  ){
					$resultado = $this->getCaStatus();
				}else{
					if( $reporte->getCaTransporte()=="Aéreo" ){
						$resultado = "Nuestra oficina nos informa que el vuelo " . $this->getCaIdnave () . " llegó ";
						if( $this->getCaFchllegada () ){
							$resultado.= " el " . Utils::fechaMes($this->getCaFchllegada ()) ; 
						}
						$resultado.= " con la orden en referencia a bordo ";
						
					}
					if( $reporte->getCaTransporte()=="Marítimo" ){						
						$resultado = $this->getCaStatus();
					}
				}
				
				break;		
						
			default:			
				$resultado = $this->getCaStatus();
				break;	
		}
		return $resultado;
	}
	
}

?>