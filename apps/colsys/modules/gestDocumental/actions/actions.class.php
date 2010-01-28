<?php

/**
 * gestDocumental actions.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */ 
class gestDocumentalActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
	}

    /*
	* Sube un archivo a la carpeta especificada
	* @author: Andres Botero
	*/
	public function executeDataArchivos(){


        $folder = base64_decode($this->getRequestParameter("folder"));
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;
        
        if(!is_dir($directory)){
            @mkdir($directory, 0777, true);
        }

        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
        $this->files = array();
        foreach($archivos as $archivo ){
			$this->files[]=array("idarchivo"=>base64_encode(basename($archivo)),
							"name"=>utf8_encode(basename($archivo)),
                            "lastmod"=>time()
					);
		}
       
    }

    /*
	* Sube un archivo a la carpeta especificada
	* @author: Andres Botero
	*/
	public function executeSubirArchivo(){

		sfConfig::set('sf_web_debug', false) ;
		$folder = base64_decode($this->getRequestParameter("folder"));
		$this->forward404Unless($folder);
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;
       
        if(!is_dir($directory)){
            mkdir($directory, 0777, true);
           
        }        
		if ( count( $_FILES )>0 ){
			foreach ( $_FILES as $uploadedFile){

				$fileName  = $uploadedFile['name'] ;
				

                if(move_uploaded_file($uploadedFile['tmp_name'],$directory.$fileName )){
                    $this->responseArray = array("id"=>base64_encode($fileName), "filename"=>$fileName, "success"=>true);
                }
		  	}
		}else{
			$this->responseArray = array("success"=>false);
		}
		
		$this->setTemplate("responseTemplate");
	}

	/*
	* Permite visualizar un archivo del panel
	* @author: Andres Botero
	*/
	public function executeVerArchivo(){

        $archivo = base64_decode( $this->getRequestParameter("idarchivo") );
        $this->forward404Unless( $archivo );

        $folder = base64_decode($this->getRequestParameter("folder"));
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

        $this->archivo = $directory.$archivo;
        
        if(!file_exists($this->archivo)){
            $this->forward404("No se encuentra el archivo especificado");
        }
		
    	session_cache_limiter('public');
	}

	/*
	* Permite borrar el archivo
	* @author: Andres Botero
	*/
	public function executeBorrarArchivo(){
		$id = $this->getRequestParameter("id");
		$archivo = base64_decode( $this->getRequestParameter("idarchivo") );
        $this->forward404Unless( $archivo );

        $folder = base64_decode($this->getRequestParameter("folder"));
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

        if( file_exists($directory.$archivo) ){
            $this->responseArray = array("id"=>$id, "success"=>true);
            unlink($directory.$archivo);

        }else{
            $this->responseArray = array("id"=>$id, "success"=>false);
        }
		
		
		$this->setTemplate("responseTemplate");
	}

	
	/*
	* Muestra un formulario que hace posible cargar un archivo
	* @author: Andres Botero 
	*/
	public function executeCargarArchivoForm(){
		$this->reporteId = $this->getRequestParameter( "reporteId" );
	}



    /*
	*Conector ckfinder
	* @author: Andres Botero
	*/
	public function executeCkFinderConnector(){
        
        define("CKFINDER_LIB", sfConfig::get("sf_lib_dir").DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR
                              ."ckfinder".DIRECTORY_SEPARATOR );
        
		require(CKFINDER_LIB."connector".DIRECTORY_SEPARATOR
                              ."php".DIRECTORY_SEPARATOR."connector.php");

        return sfView::NONE;
	}
	
	
	
	
}
?>