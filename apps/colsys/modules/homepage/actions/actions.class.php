<?php

/**
 * homepage actions.
 *
 * @package    colsys
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class homepageActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
	
		

		
		$response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("homepage",'last');
		
		
		
	}
}
