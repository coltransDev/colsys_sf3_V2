<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage traficos
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class traficosComponents extends sfComponents
{
	/*
	* Muestra la informacion de un reporte desde aca se pueden actualizar status y 
	* avisos
	*/		
	public function executeInfoReporte(){		
		$this->modo = $this->getRequestParameter("modo");
	} 
	
	
	/*
	* Muestra las referencias que el usuario ha buscado
	* @author: Andres Botero
	*/
	public function executeVerArchivosReporte(){				
		$this->files=$this->reporte->getFiles();					
		$this->user = $this->getUser();				
		
	}
	
	/*
	* Muestra una lista de todos los status, esta se incluye en los status del cliente y en la accion verHistorialStatus
	*/
	public function executeListaStatus( ){			
		if( !isset( $this->linkEmail ) ){
			$this->linkEmail = false;
		}	
				
		$c = new Criteria();
		if(  isset($this->endDate)  ){
			$c->add( RepStatusPeer::CA_FCHENVIO , $this->endDate, Criteria::LESS_EQUAL );
		}
		
		$c->addDescendingOrderByColumn( RepStatusPeer::CA_FCHENVIO );
		$this->statusList = $this->reporte->getRepstatuss( $c );
		
	}
	
	
	/*
	* Muestra una lista de todos los status, esta se incluye en los status del cliente y en la accion verHistorialStatus
	*/
	public function executeHistorialStatus( ){			
		$c = new Criteria();
		$c->addDescendingOrderByColumn( RepStatusPeer::CA_FCHENVIO );
		$this->statusList = $this->reporte->getRepstatuss( $c );	
	}
	
}
?>