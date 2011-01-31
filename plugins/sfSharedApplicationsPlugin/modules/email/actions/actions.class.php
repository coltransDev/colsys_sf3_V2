<?php

/**
 * email actions.
 *
 * @package    symfony
 * @subpackage email
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class emailActions extends sfActions
{ 


    /*
	* Permite ver un email
    * @param sfRequest $request A request object
	*/
	public function executeVerEmail(sfWebRequest $request){
		$this->email = Doctrine::getTable("Email")->find($request->getParameter("id") );
		$this->forward404Unless( $this->email );
		$this->user = Doctrine::getTable("Usuario")->find( $this->email->getCaUsuenvio() );
		$this->setLayout("popup");
	}


    /*
	* Permite ver un email
	*/
	public function executeVerAttachment( $request ){
        $id= base64_decode($request->getParameter("id"));
		$this->archivo = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$id;
       
        if(!file_exists($this->archivo)){
            $this->forward404("No se encuentra el archivo especificado");
        }


	}
	
}
