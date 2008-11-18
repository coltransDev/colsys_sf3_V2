<?php

/**
 * gestDocumental components.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gestDocumentalComponents extends sfComponents
{
	/*
	* Muestra las referencias que el usuario ha buscado
	* @author: Andres Botero
	*/
	public function executeVerArchivosReporte(){				
		$this->files=$this->reporte->getFiles();					
		$this->user = $this->getUser();		
		$this->user->clearFiles();				
	}
	
	/*
	* Muestra un panel con los archivos seleccionados 
	*/
	public function executePanelArchivos(){
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
		
		if(!isset( $this->id )){
			$this->id="";
		}				
	}
	
	
}
?>