<?php 

/**
 * exportaciones actions.
 *
 * @package    colsys
 * @subpackage exportaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class exportacionesActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex($request)
	{					
			$this->transporte=$request->getParameter('transporte');            
	}
	
	
} 
?>