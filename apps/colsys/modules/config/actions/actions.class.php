<?php

/**
 * config actions.
 *
 * @package    symfony
 * @subpackage config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class configActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $this->params = Doctrine::getTable("ColsysConfig")
                                ->createQuery("p")
                                ->addOrderBy("p.ca_param")
                                ->execute();
        
        
    }
    
    
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormParam(sfWebRequest $request) {
        
        if( $request->getParameter("idconfig") ){
            $config = Doctrine::getTable("ColsysConfig")->find( $request->getParameter("idconfig") );
            $this->forward404Unless($config);
        }else{
            $config = new ColsysConfig();
        }
       
        $this->form = new ParamForm();
        
        if( $request->isMethod("post") ){
            $bindValues = array();
            $bindValues["idconfig"] = $request->getParameter("idconfig");
            $bindValues["module"] = $request->getParameter("module");
            $bindValues["param"] = $request->getParameter("param");
            $bindValues["description"] = $request->getParameter("description");
            
            $this->form->bind( $bindValues );
            if( $this->form->isValid() ){
                $config->setCaModule( $request->getParameter("module") );
                $config->setCaParam( $request->getParameter("param") );
                $config->setCaDescription( $request->getParameter("description") );
                $config->save();                 
                $this->redirect("config/index");            
            }
        }
        $this->config = $config;
    }
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormValue(sfWebRequest $request) {
                
        if( $request->getParameter("idvalue") ){
            $value = Doctrine::getTable("ColsysConfigValue")->find( $request->getParameter("idvalue") );
            $this->forward404Unless($value);
        }else{
            $this->forward404Unless($request->getParameter("idconfig"));
            $config = Doctrine::getTable("ColsysConfig")->find( $request->getParameter("idconfig") );
            $this->forward404Unless($config);
            $value = new ColsysConfigValue();
            $value->setCaIdconfig( $request->getParameter("idconfig") );
        }
       
        $this->form = new ParamValueForm();
        
        if( $request->isMethod("post") ){
            $bindValues = array();
            $bindValues["idconfig"] = $request->getParameter("idconfig");
            $bindValues["idvalue"] = $request->getParameter("idvalue");
            $bindValues["ident"] = $request->getParameter("ident");
            $bindValues["value"] = $request->getParameter("value");
            $bindValues["value2"] = $request->getParameter("value2");
            
            $this->form->bind( $bindValues );
            if( $this->form->isValid() ){
                $value->setCaIdent( $request->getParameter("ident") );
                $value->setCaValue( $request->getParameter("value") );
                $value->setCaValue2( $request->getParameter("value2") );
                $value->save();                 
                $this->redirect("config/index");            
            }
        }
        $this->value = $value;
    }
    
    
}
