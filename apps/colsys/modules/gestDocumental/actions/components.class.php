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
	* Muestra un panel con los archivos seleccionados 
	*/
	public function executePanelArchivos(){
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
		
		if(!isset( $this->id )){
			$this->id="";
		}
		
		if(!isset( $this->readOnly )){
			$this->readOnly=false;
		}
       

        
	}
	
	
}
?>