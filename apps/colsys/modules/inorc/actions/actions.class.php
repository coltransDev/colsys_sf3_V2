<?php

/**
 * inorc actions.
 *
 * @package    symfony
 * @subpackage inorc
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inorcActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    
    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormComprobante(sfWebRequest $request)
    {
        $idhouse = $request->getParameter("idhouse");
       
        $this->tipo = "R";
       
        if( $request->getParameter("idcomprobante") ){
            $this->comprobante = Doctrine::getTable("InoComprobante")->find($request->getParameter("idcomprobante"));
            $this->forward404Unless( $this->comprobante );
        }else{
            $this->comprobante = new InoComprobante();

        }

        $this->idhouse = $idhouse;
        
    }
}
