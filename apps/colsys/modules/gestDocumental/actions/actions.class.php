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
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
	}
	
	
	/*
	* Muestra un formulario que hace posible cargar un archivo
	* @author: Andres Botero 
	*/
	public function executeCargarArchivoForm(){
		$this->reporteId = $this->getRequestParameter( "reporteId" );
	}
		
	
	
	
	
}
?>