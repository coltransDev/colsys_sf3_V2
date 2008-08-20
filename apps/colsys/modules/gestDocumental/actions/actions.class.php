<?php

/**
 * gestDocumental actions.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */ 
class gestDocumentalActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
		$this->forward('default', 'module');
	}
	
	/*
	* Muestra un formulario que hace posible cargar un archivo
	* @author: Andres Botero 
	*/
	public function executeCargarArchivoForm(){
		$this->reporteId = $this->getRequestParameter( "reporteId" );
	}
		
	/*
	* Ejecuta la accion de cargar el archivo en el iframe, en la forma CargarArchivoForm
	* author: Andres Botero
	*/
	public function executeCargarArchivo(){
		
		//toma el valor del id del reporte, la referencia u otro objeto que se desee guardar
		// y determina el directorio
		$reporteId = $this->getRequestParameter( "reporteId" );
		if( $reporteId ){
			$reporte = ReportePeer::retrieveBypk( $reporteId );
			$this->forward404Unless( $reporte );			
			
			$directory = $reporte->getDirectorio();
			
			$this->reporteId = $reporteId;
			$this->setTemplate( "cargarArchivoReporte" );
		}				
		
						
		if( !is_dir($directory) ){			
			@mkdir($directory, 0777);			
		}	
		//Determina el nombre del archivo
		
		/*
		$tipo = $this->getRequestParameter("tipo");		
		if( $tipo == "FACT"){		
			$dir = $directory.DIRECTORY_SEPARATOR."FACT".DIRECTORY_SEPARATOR;
			if( !is_dir($dir) ){
				@mkdir($dir, 0777);
			}
			
			
			$destPath = $dir.str_replace("/","",$this->factura).strtolower(substr($this->getRequest()->getFileName('file'),-4,4));			
				
		}else{
			
		} 
		*/
		
		$destPath = $directory.DIRECTORY_SEPARATOR.$this->getRequest()->getFileName('file'); 
		//mueve el archivo
		$this->getRequest()->moveFile('file', $destPath  );		
		  		
	}
	
	/*
	* Permite ver el contenido de un archivo
	* author: Andres Botero
	*/	
	public function executeFileViewer(){
		$idx = $this->getRequestParameter("idx"); 
		$this->name = $this->getUser()->getFile( $idx );
		$this->setLayout("none");
	}
	/*
	* Permite eliminar un archivo de acuerdo al indice
	* author: Andres Botero
	*/
	public function executeEliminarArchivo(){		
		$idx = $this->getRequestParameter("idx"); 
		$name = $this->getUser()->getFile( $idx );	
		unlink( $name );
		return sfView::NONE;		
	}
}
?>