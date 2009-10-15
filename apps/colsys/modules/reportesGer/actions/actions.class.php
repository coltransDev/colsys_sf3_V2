<?php

/**
 * reportesGer actions.
 *
 * @package    colsys
 * @subpackage reportesGer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class reportesGerActions extends sfActions
{
	/**
	* Muestra un menu donde el usuario puede seleccionar las comisiones que desa sacar 
	*
	* @param sfRequest $request A request object
	*/
	public function executeReporteComisionesVendedor(sfWebRequest $request)
	{
		$this->userid = $this->getUser()->getUserId();	
	}
}
?>