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
		return $this->getCaEtapa();
	}
	
	public function getClass(){
		
		$etapa = $this->getCaEtapa();
		if(  $this->getCaFchstatus("Y-m-d")==date("Y-m-d") && $this!="Carga Embarcada" && $etapa!="ETA" && $etapa!="Orden Anulada" && $etapa!="Carga en Aeropuerto de Destino"){			
			$etapa = "nuevo";			
		}
		
		switch( $etapa ){				
			case "Pendiente de Instrucciones":
				$class = "yellow";
				break;
			case "Carga Embarcada":
				$class = "blue";
				break;
			case "ETA":
				$class = "blue";
				break;
			
			case "Carga en Tránsito a Destino":
				$class = "blue";
				break;	
			case "Orden Anulada":
				$class = "pink";
				break;
			case "nuevo":
				$class = "green";
				break;	
			case "Carga Entregada":
				$class = "orange";
				break;		
			case "Carga en Aeropuerto de Destino":
				$class = "orange";
				break;	
			case "Cierre de Documentos":
				$class = "orange";
				break;	
			case "Carga en Transito Terrestre":
				$class = "purple";
				break;			
			case "Cierre de Documentos":
				$class = "orange";
				break;	
			case "Carga en Transito Terrestre":
				$class = "purple";
				break;	
			default:				
				$class = "";
				break;
		 
		}
		return $class;
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
					if( $reporte->getCaTransporte()=="Marítimo" ){						
						$resultado = $this->getCaStatus();
					}
				}
				
				break;	
			case "Carga en Aeropuerto de Destino":	
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
					
				}
				
				break;			
						
			default:			
				$resultado = $this->getCaStatus();
				break;	
		}
		return $resultado;
	}
	
	
	
	/*
	* Envia el status, generalemte se usa despues de guardar
	*/
	public function send(){
		echo "----->".$this->getCaIdstatus();			
	}
}

?>