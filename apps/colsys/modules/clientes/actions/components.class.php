<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage clientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clientesComponents extends sfComponents
{
	/*
	* Muestra un campo que permite autocompletar el nombre del cliente usando JSON y el id lo guarda 
	 en el atributo id.
	*/
	public function executeComboContactosClientes()
	{
		$response = sfContext::getInstance()->getResponse();

		$response->addJavascript('components/comboContactoClientes');		
		if( !isset( $this->id )){
			$this->id = "idcontacto";
		}
		if($this->idcontacto){
			$this->contacto = ContactoPeer::retrieveByPk( $this->idcontacto );
		}		

	}
	
	
	
	public function executeComboConsignatario()
	{
		$response = sfContext::getInstance()->getResponse();
		$response->addJavascript('components/comboConsignatario');		
		
		if($this->idtercero){
			$this->tercero = TerceroPeer::retrieveByPk( $this->idtercero );
		} 
	}
	
	public function executeComboNotify()
	{
		$response = sfContext::getInstance()->getResponse();
		$response->addJavascript('components/comboNotify');		
		
		if($this->idtercero){
			$this->tercero = TerceroPeer::retrieveByPk( $this->idtercero );
		} 
	}
}
?>