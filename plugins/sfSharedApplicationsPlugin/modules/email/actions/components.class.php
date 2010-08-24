<?php

/**
 * general components.
 *
 * @package    colsys
 * @subpackage email
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class emailComponents extends sfComponents
{
	
	
	/*
	* Muestra un formulario standar para enviar un correo
	*/
	public function executeFormEmail(){
		$this->user = $this->getUser();		
	}
	

}
?>