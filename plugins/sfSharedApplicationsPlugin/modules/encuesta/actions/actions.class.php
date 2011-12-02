<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class encuestaActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
        
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("jquery/rating/jquerywave.js", 'last');
        $response->addJavaScript("jquery/rating/rating.js", 'last');        
        //$response->addJavaScript("jquery/rating/rating.css", 'last');        
        $response->addStylesheet("../js/jquery/rating/rating.css");        
    }
}

?>