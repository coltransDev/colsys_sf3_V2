<?php

/**
 * homepage actions.
 *
 * @package    symfony
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homepageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

    const RUTINA_COLSYS = 99;
    const RUTINA_INTRANET = 99;

    public function getNivel() {

        $app =  sfContext::getInstance()->getConfiguration()->getApplication();
        //   return 5;
        switch( $app ){
            case "colsys":
                $rutina = homepageActions::RUTINA_COLSYS;
            break;
            case "intranet":
                $rutina = homepageActions::RUTINA_INTRANET;
            break;
        }

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        if (!$this->nivel) {
        $this->nivel = 0;
        }

        $this->forward404Unless($this->nivel != -1);

        return $this->nivel;
    }

    public function executeIndex(sfWebRequest $request)
    {
        // $this->forward('default', 'module');
        $this->user = sfContext::getInstance()->getUser();

    }
    public function executeEditarNoticia(sfWebRequest $request){

        

        $this->nivel = $this->getNivel();

        if( $this->nivel==0){
            	$this->forward("adminUsers", "noAccess");
        }

        $idnoticia = $request->getParameter("idnoticia");
        $this->noticia = Doctrine::getTable("Noticia")->find( $idnoticia );

        if( !$this->noticia ){
            $this->noticia = new Noticia();
        }

        $this->forward404Unless( $this->noticia );
        $this->idnoticia = $idnoticia;
        $response = sfContext::getInstance()->getResponse();

        //Utility Dependencies
        $response->addJavaScript("yui/yahoo-dom-event/yahoo-dom-event.js",'last');
        $response->addJavaScript("yui/element/element-min.js",'last');
        //Needed for Menus, Buttons and Overlays used in the Toolbar
        $response->addJavaScript("yui/container/container_core-min.js",'last');
        $response->addJavaScript("yui/menu/menu-min.js",'last');
        $response->addJavaScript("yui/button/button-min.js",'last');
        //Source file for Rich Text Editor
        $response->addJavaScript("yui/editor/editor-min.js",'last');
        $response->addJavaScript("yui/connection/connection-min.js",'last');
        $response->addJavaScript("yui/logger/logger-min.js",'last');
        $response->addJavaScript("yui-image-uploader26.js",'last');
        $response->addStyleSheet("yui/assets/skins/sam/skin.css",'last');
        }

    /**
    * Guarda los datos del formulario
    *
    * @param sfRequest $request A request object
    */
    public function executeGuardarNoticia(sfWebRequest $request){

        

        $idnoticia = $request->getParameter("idnoticia");

        if($idnoticia){
            $noticia = Doctrine::getTable("Noticia")->find($idnoticia);
            $this->forward404Unless( $noticia );
        }
        else{
            $noticia = new Noticia();
        }

        $noticia->setCaCategoria($request->getParameter("categoria"));
        $noticia->setCaAsunto($request->getParameter("title"));
        $noticia->setCaDetalle($request->getParameter("info"));
        $noticia->setCaFchpublicacion($request->getParameter("fchpublicacion"));
        $noticia->setCaFcharchivar($request->getParameter("fcharchivar"));
        $noticia->setCaFchcreado( date("Y-m-d H:i:s") );
        $noticia->setCaUsucreado( $this->getUser()->getUserId() );
        $noticia->setCaIcon($request->getParameter("icon"));

        $noticia->save();

        $this->idnoticia = $idnoticia;
    }
}