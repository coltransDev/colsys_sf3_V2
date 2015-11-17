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
        
        $user = $this->getUser();
        
 
        $id= base64_decode($request->getParameter("id"));
        $this->archivo = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$id;

        $pos1=stripos($this->archivo, ".pdf");

        $file2="";
        if ($pos1 !== false) {
            $file2=str_replace(".pdf", "-P.pdf", $this->archivo);
        }
        if(file_exists($file2) || file_exists($file2.".gz"))
        {
            $this->archivo=$file2;
        }
        if(!file_exists($this->archivo) && !file_exists($this->archivo.".gz") && !file_exists($file2)){
            $this->archivo = str_replace(" ", "_", $this->archivo );
            if(!file_exists($this->archivo) && !file_exists($this->archivo.".gz")){        

                if(strpos($id, "reportes/")!==false){
                    $array = explode("/", $id);
                    $folderRep = substr($array[1], -4, 4 ); 
                    $id = $array[0]."/".$folderRep."/".$array[1]."/".$array[2];                        
                    $this->archivo = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$id;                        


                    if(!file_exists($this->archivo) && !file_exists($this->archivo.".gz")  && !file_exists($file2)  ){
                        $this->forward404("No se encuentra el archivo especificado . ".$id);
                    }                
                }else{
                    $this->forward404("No se encuentra el archivo especificado : ".$id);
                }
            }
        }

        if( file_exists($this->archivo.".gz")){
            $this->archivo.=".gz";
        }
        else if( file_exists($file2)){
            $this->archivo=$file2;
        }
        
        


	}
    
    
    /*
	* 
	*/
	public function executeReenviar( $request ){
        
        $this->forward404Unless( $request->getParameter("id") );
        $email = Doctrine::getTable("Email")->find( $request->getParameter("id") );
		$this->forward404Unless( $email );
        
        if( !$email->getCaFchenvio() ){
            $this->mensaje = "No se puede reenviar una cotizacion en cola de envío";
            $this->email = $email;
            return sfView::ERROR;
        }
        
        $dias = 10;
        if( $email->getCaFchenvio()<=date("Y-m-d H:i:s", time()-86400*$dias) ){
            $this->mensaje = "No se puede reenviar un email enviado hace mas de ".$dias." días";
            $this->email = $email;
            return sfView::ERROR;
        }    
        
        $minutos = 10;
        if( $email->getCaFchenvio()<=date("Y-m-d H:i:s") && $email->getCaFchenvio()>=date("Y-m-d H:i:s", time()-$minutos*60 ) ){
            $this->mensaje = "Debe esperar por lo menos  ".$minutos." minutos para poder reenviar este email";
            $this->email = $email;
            return sfView::ERROR;
        }    
        
        $newemail = $email->copy( false );
        $newemail->setCaFchenvio(null);
        $newemail->save();
        
        $this->redirect( "email/verEmail?id=".$newemail->getCaIdemail() );

	}
    
    
	
}
