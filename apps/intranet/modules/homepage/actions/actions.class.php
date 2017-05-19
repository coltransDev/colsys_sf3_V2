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
    
    const RUTINA_CONTROL = "159";

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        // $this->forward('default', 'module');
        $this->user = sfContext::getInstance()->getUser();        
        $this->idempresa = $this->getUser()->getIdempresa();
    }

    public function executeVideos(sfWebRequest $request) {
        
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("flowplayer/flowplayer-3.2.6.min.js",'last');        

        $idvideo = $request->getParameter('id');

        $video = Doctrine::getTable("IntranetVideo")->find($idvideo);
        
        if($video){
            $this->video = $video;
        }        
        $this->user = sfContext::getInstance()->getUser();
    }

    public function executeTomarControl($request) {

        $this->nivel = $this->getUser()->getNivelAcceso(homepageActions::RUTINA_CONTROL);
        if ($this->nivel < 3) {
            $this->forward404();
        }

        $this->form = new CambioUsuarioForm();

        if ($request->isMethod('post')) {

            $this->form->bind(
                array('username' => $request->getParameter('username'))
            );

            if ($this->form->isValid()) {

                $username = $request->getParameter('username');
                $user = Doctrine::getTable("Usuario")->find($username);
                if ($user->getCaAuthmethod() == "ldap") {
                    $this->getUser()->signInLDAP($username);
                } else {
                    $this->getUser()->signInAlternative($username);
                }

                $this->getUser()->buildMenu();

                $this->forward("homepage", "index");
            }
        }
    }
}