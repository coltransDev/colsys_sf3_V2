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

            $filePrefix = $this->getRequestParameter("filePrefix");
            if( $filePrefix ){
                $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
                foreach($archivos as $archivo ){
                    if( substr(basename($archivo),0, strlen($filePrefix))==$filePrefix ){
                        @unlink($archivo);
                    }
                }
            }

			foreach ( $_FILES as $uploadedFile){
                if( $filePrefix ){
                    $fileName  = $filePrefix."_".$uploadedFile['name'] ;
                }else{
				$fileName  = $uploadedFile['name'] ;
                }

                
                if(move_uploaded_file($uploadedFile['tmp_name'],$directory.$fileName )){
                    $this->responseArray = array("id"=>base64_encode($fileName), "filename"=>$fileName, "folder"=>$folder, "success"=>true);
                }else{
                    $this->responseArray = array("error"=>"No se pudo mover el archivo", "success"=>false);
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

    	//session_cache_limiter('public');
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
     * Permite subir una imagen desde el editor YUI
     */
    public function executeUploadImage( $request ){
        $folder = $request->getParameter("folder");
        $idissue = $request->getParameter("idissue");
        //header("content-type: text/html"); // the return type must be text/html
        //if file has been sent successfully:
        $this->responseArray = array();
        if (isset($_FILES['image']['tmp_name'])) {
            // open the file
            $img = $_FILES['image']['tmp_name'];
            $ext = strtolower(substr($_FILES['image']['name'],-3, 3));
            $himage = fopen ( $img, "r"); // read the temporary file into a buffer
            $image = fread ( $himage, filesize($img) );
            fclose($himage);
            //if image can't be opened, either its not a valid format or even an image:
            if ($image === FALSE) {
                $this->responseArray["status"] = utf8_encode('Error Reading Uploaded File.');
            }else{
                // create a new random numeric name to avoid rewriting other images already on the server...
                $ran = rand ();
                $ran2 = $ran.".";

                $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

                if(!is_dir($directory)){
                    @mkdir($directory, 0777, true);
                }

                $filename = $ran2.$ext;
                // join path and name
                $path = $directory . $filename;
                // copy the image to the server, alert on fail
                $hout=fopen($path,"w");
                fwrite($hout,$image);
                fclose($hout);
                //you'll need to modify the path here to reflect your own server.

                $urlpath = "/gestDocumental/verArchivo/folder/".base64_encode($folder)."/idarchivo/".base64_encode($filename);
                $this->responseArray["status"] = 'UPLOADED';
                $this->responseArray["image_url"] = $urlpath;
            }
        } else {
             $this->responseArray["status"] = utf8_encode('No file was submitted');
        }





        $this->setTemplate("responseTemplate");
    }

     /*
	*
	* @author: Andres Botero
	*/
	public function executeDatosPanelDirectorios(){


        $folder = base64_decode($this->getRequestParameter("folder"));
        $digitalFile = sfConfig::get('app_digitalFile_root');
        $directory = $digitalFile.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

        if(!is_dir($directory)){
            @mkdir($directory, 0777, true);
}
        /*
        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
        $this->files = array();
        foreach($archivos as $archivo ){
			$this->files[]=array("idarchivo"=>base64_encode(basename($archivo)),
							"name"=>utf8_encode(basename($archivo)),
                            "lastmod"=>time()
					);
		}*/
        //echo $directory;

        $dirs = glob($directory . DIRECTORY_SEPARATOR. '*', GLOB_ONLYDIR);
		$data=array();
		foreach($dirs as $dir){
			$subdirs = glob($dir. DIRECTORY_SEPARATOR. '*', GLOB_ONLYDIR);
			$data[] = array(
				'id' => str_replace($digitalFile, "", $dir),
				'text' => substr(strrchr($dir,DIRECTORY_SEPARATOR),1),
				'loaded' => count($subdirs)==0,
				'expanded' => false
			);
		}

        print json_encode($data);


    }




}
?>