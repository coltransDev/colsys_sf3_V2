<?php

/**
 * homepage actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homepageActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    

    public function executeIndex(sfWebRequest $request) {
        // $this->forward('default', 'module');
        $this->user = sfContext::getInstance()->getUser();
    }
    public function executeVideos(sfWebRequest $request) {
        // $this->forward('default', 'module');
        
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("flowplayer/flowplayer-3.2.6.min.js",'last');        
        
        
        $this->user = sfContext::getInstance()->getUser();
        
    }

}