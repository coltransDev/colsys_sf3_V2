<?php

/**
 * wrapper actions. 
 *
 * @package    colsys
 * @subpackage wrapper
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class wrapperActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
		chdir("C:\\Desarrollo\\Apache2\\htdocs.ssl\\");
		$this->path="entrada.php";		
	}
}
?>