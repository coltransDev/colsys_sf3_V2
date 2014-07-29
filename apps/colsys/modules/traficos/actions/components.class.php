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
		
		if( $this->reporte->getCaImpoexpo()==Constantes::IMPO || $this->reporte->getCaImpoexpo()==Constantes::TRIANGULACION  ){
			//Reportes al exterior			
			if( $this->reporte->getCaTransporte()==Constantes::MARITIMO ){
				$tipo = 'Rep.MarítimoExterior';
			}else{
				$tipo = 'Rep.AéreoExterior';
			}
			
			$this->reportesExt = $this->reporte->getReporteExterior();
            
            /*Muestra información adicional para generacion de IDG*/
            $parametros = ParametroTable::retrieveByCaso("CU103", null, null, $this->reporte->getCliente()->getCaIdgrupo() );
            $this->enableparam = false;
            if(count($parametros)>0){
                $this->enableparam = true;
            }
            $this->parametros = $parametros;
       }        
    } 
	
	
	/*
	* Muestra las referencias que el usuario ha buscado
	* @author: Andres Botero
	*/
	public function executeVerArchivosReporte(){
            $this->files=$this->reporte->getFiles(array(),array('*.jpeg*','*.jpg*','*.png*','*.gif*','*.JPEG*','*.JPG*','*.PNG*','*.GIF*'));
            $this->archivos=$this->reporte->getFilesGestDoc();
            $this->user = $this->getUser();
	}
	
	/*
	* Muestra una lista de todos los status, esta se incluye en los status del cliente y en la accion verHistorialStatus
	*/
	public function executeListaStatus( ){			
		if( !isset( $this->linkEmail ) ){
			$this->linkEmail = false;
		}	
				
		$this->statusList = $this->reporte->getRepstatus();
		
	}
	
	
	/*
	* Muestra una lista de todos los status, esta se incluye en los status del cliente y en la accion verHistorialStatus
	*/
	public function executeHistorialStatus( ){					
		$this->statusList = $this->reporte->getRepStatus();
	}

    public function executeUploadClientes()
	{
             
    }
    
    
}
?>