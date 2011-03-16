<?php
 
/**
 * menu actions.
 *
 * @package    colsys
 * @subpackage menu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class menuComponents extends sfComponents
{
	/**
	* Show menubar
	*
	*/
	public function executeMenubar()
	{
		$usuarioActivo = $this->getUser()->getClienteActivo();
		$cliente = Doctrine::getTable("Cliente")->find( $usuarioActivo );
		if( $cliente ){
			$this->nombre = $cliente->getCaCompania(); 
		}else{
			$this->nombre = "";
		}
		
		$this->showMenu = $this->getUser()->isAuthenticated();
		
	}
}
?>