<?php

/**
 * inocostos actions.
 *
 * @package    symfony
 * @subpackage inocostos
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inocostosActions extends sfActions
{
    const RUTINA = 15;


    public function getNivel( ){

        

        $this->nivel = -1;
		
		$this->nivel = $this->getUser()->getNivelAcceso( inocostosActions::RUTINA );



		if( $this->nivel==-1 ){
			$this->forward404();
		}
        return $this->nivel;
    }

    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        
    }


    /**
    *
    *
    * @param sfRequest $request A request object
    */
    public function executeFormComprobante(sfWebRequest $request)
    {
        $this->modo = $request->getParameter("modo");
        $this->nivel = $this->getNivel();

        $request->setParameter("tipo", "P");

        $this->forward("inocomprobantes", "formComprobante");


    }
}
