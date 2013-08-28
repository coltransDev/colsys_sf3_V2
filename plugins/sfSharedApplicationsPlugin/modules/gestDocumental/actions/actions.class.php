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
	* 
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
            if( substr($archivo, -3,3)==".gz"){
                $nombreArchivo = substr($archivo,0, strlen($archivo)-3);
            }else{
                $nombreArchivo = $archivo;
            }
            
			$this->files[]=array("idarchivo"=>base64_encode(basename($archivo)),
							"name"=>utf8_encode(basename($nombreArchivo)),
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
        $this->referer=base64_decode($this->getRequestParameter("referer"));
        $this->nameFileType=$this->getRequestParameter("namefiletype");
        
        $template = ($this->getRequestParameter("template")!="")?$this->getRequestParameter("template"):"responseTemplate";
        
		$this->forward404Unless($folder);
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;
        //echo $directory;
        if(!is_dir($directory)){
            mkdir($directory, 0777, true);
        }
        chmod ( $directory , 0777 );
        //print_r($_FILES);
        //error_reporting(E_ALL);
        try
        {
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

                foreach ( $_FILES as $nameFile =>$uploadedFile){
                    if($uploadedFile['name']=="")
                        continue;
                    if($this->nameFileType=="static")
                    {            
                        $archivos=sfFinder::type('file')->name($nameFile.'--*')->maxDepth(0)->in($directory);        
                        if(count($archivos)>0)
                        {
                            Unlink($archivos[0]);
                        }
                                                
                        $filePrefix=$nameFile."--";
                        //$fileName  = $uploadedFile['name'] ;
                    }
                    
                    if( $filePrefix ){
                        $fileName  = $filePrefix."_".$uploadedFile['name'] ;
                    }else{
                        $fileName  = $uploadedFile['name'] ;
                    }
                    $fileName = preg_replace('/\s\s+/', ' ', $fileName);
                    $fileName=urlencode($fileName);
                    
                    //echo $directory.$fileName;
                    error_reporting(E_ALL);
                    if(move_uploaded_file($uploadedFile['tmp_name'],$directory.$fileName )){
                        $this->responseArray = array("id"=>base64_encode($fileName), "filename"=>$fileName, "folder"=>$folder, "success"=>true);
                    }else{
                        $this->responseArray = array("error"=>"No se pudo mover el archivo","filename"=>$fileName, "folder"=>$folder, "success"=>false);
                    }
                }
            }else{
                $this->responseArray = array("success"=>false);
            }
        }
        catch(Exception $e)
        {
            $this->responseArray = array("error"=>$e->getMessage(), "success"=>false);
        }

		$this->setTemplate($template);
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

        if(!file_exists($this->archivo) && !file_exists($this->archivo.".gz") ){
            $this->forward404("No se encuentra el archivo especificado");
        }

        if( file_exists($this->archivo.".gz") ){
            $this->archivo.=".gz";
        }

    	//session_cache_limiter('public');
	}
    
    /*
	* Permite visualizar un archivo del panel
	* @author: Andres Botero
	*/
    public function executeVerArchivoLibreClave(){

        $archivo = base64_decode( $this->getRequestParameter("idarchivo") );

        $this->forward404Unless( $archivo );

        $folder = base64_decode($this->getRequestParameter("folder"));
        $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

        $this->archivo = $directory.$archivo;


        if(!file_exists($this->archivo) && !file_exists($this->archivo.".gz")){
            $this->forward404("No se encuentra el archivo especificado");
        }
        
        if( file_exists($this->archivo.".gz") ){
            $this->archivo.=".gz";
        }

    	//session_cache_limiter('public');
	}
    
    /*
	* Permite visualizar las 
	* @author: Andres Botero
	*/
	public function executeVerImagen(){
//         echo "hgfhgf";
//        exit;
        //sfConfig::set('sf_web_debug', false) ;
        try
        {
            $archivo = base64_decode( $this->getRequestParameter("idarchivo") );
            $tam_max = ($this->getRequestParameter("tam_max"))?$this->getRequestParameter("tam_max"):200;

            $this->forward404Unless( $archivo );

            $folder = base64_decode($this->getRequestParameter("folder"));
            $directory = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR;

            $this->archivo = $directory.$archivo;
            
    $image = imagecreatefromjpeg($this->archivo);

    if ($image === false) {
        echo "error";
        exit;
    }
            $w = imagesx($image);
            $h = imagesy($image);
            //$tam_max=200;
            if($w>$tam_max || $h>$tam_max)
            {
                $control=($h>=$w);                    
                if($control)
                {
                    $porcen=$tam_max/$h;
                }
                else {
                    $porcen=$tam_max/$w;
                }
                $new_w= $w * $porcen;
                $new_h= $h * $porcen;

                $im2 = ImageCreateTrueColor($new_w, $new_h);
                imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                
                //imagejpeg($img2,NULL,80); 
                imagejpeg($img2);
                imagedestroy($img2);
            }
            else
            {
                //imagejpeg($image,NULL,80);
                imagejpeg($image);
                imagedestroy($image);
                //$this->im=$image;
            }
//imagejpeg($im,NULL,80);
//header ('Content-type: image/jpeg');
//imagejpeg($im, NULL, 80);

        }
        catch(Exception $e)
        {
            print_r($e);
        }
exit;
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

    
    public function open_image($file) {
        //detect type and process accordinally
        global $type;
        $size = getimagesize($file);
        switch ($size["mime"]) {
            case "image/jpeg":
                $im = imagecreatefromjpeg($file); //jpeg file
                break;
            case "image/gif":
                $im = imagecreatefromgif($file); //gif file
                break;
            case "image/png":
                $im = imagecreatefrompng($file); //png file
                break;
            default:
                $im = false;
                break;
        }
        return $im;
    }

    public function executeUploadImages($request) {
        sfConfig::set('sf_web_debug', false);
        $folder = base64_decode($this->getRequestParameter("folder"));
        $thumbnails = $this->getRequestParameter("thumbnails");
        //$dimension = $this->getRequestParameter("dimension");
        $tam_max = ($this->getRequestParameter("tam_max")) ? $this->getRequestParameter("tam_max") : "200";
        $dimVisual = ($this->getRequestParameter("tam_max_visual")) ? $this->getRequestParameter("tam_max_visual") : $tam_max;
        
        $this->forward404Unless($folder);
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
        //error_reporting(E_ALL);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        chmod($directory, 0777);
        //echo count($_FILES);
        try {
            if (count($_FILES) > 0) {


                foreach ($_FILES as $uploadedFile) {
                    try {

                        $fileName = $uploadedFile['name'];
                        $tmp = explode(".", $fileName);
                        $fileNameMin = $tmp[0];

                        $name_tmp = $uploadedFile['tmp_name'];

                        $image = $this->open_image($uploadedFile['tmp_name']);

                        $w = imagesx($image);
                        $h = imagesy($image);                        
                        if ($w > $tam_max || $h > $tam_max) {
                            $control = ($h >= $w);
                            if ($control) {
                                $porcen = $tam_max / $h;
                            } else {
                                $porcen = $tam_max / $w;
                            }
                            
                            $new_w = $w * $porcen;
                            $new_h = $h * $porcen;
                            
                            $im2 = ImageCreateTrueColor($new_w, $new_h);
                            imagecopyResampled($im2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                            $w = imagesx($im2);
                            $h = imagesy($im2);
                            
                            imagejpeg($im2, $directory . $fileNameMin . ".jpg", 80);                            
                        } else {
                            imagejpeg($image, $directory . $fileNameMin . ".jpg", 80);
                        }
                        //exit(0);
                        $this->responseArray = array("success" => true, "filename" => $fileNameMin . ".jpg", "folder" => $folder, "filebase" => base64_encode($folder . "/" . $fileNameMin . ".jpg"), "thumbnails" => $thumbnails, "dimension" => $dimVisual);
                    } catch (Exception $e) {
                        $this->responseArray = array("error" => $e->getMessage(), "filename" => $fileName, "folder" => $folder, "success" => false);
                    }
                }
            } else {
                $this->responseArray = array("success" => false);
            }
        } catch (Exception $e) {
            $this->responseArray = array("error" => $e->getMessage(), "success" => false);
        }

        $this->setTemplate("responseTemplate");
    }
    
    public function executeUploadFiles($request) {
        sfConfig::set('sf_web_debug', false);
        $folder = base64_decode($this->getRequestParameter("folder"));
        $thumbnails = $this->getRequestParameter("thumbnails");
        //$dimension = $this->getRequestParameter("dimension");
        $tam_max = ($this->getRequestParameter("tam_max")) ? $this->getRequestParameter("tam_max") : "200";
        $dimVisual = ($this->getRequestParameter("tam_max_visual")) ? $this->getRequestParameter("tam_max_visual") : $tam_max;
        
        $this->forward404Unless($folder);
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
        error_reporting(E_ALL);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        chmod($directory, 0777);
        
        try {
            if (count($_FILES) > 0) {

                foreach ($_FILES as $uploadedFile) {
                    try {
                        
                        //$tmp = explode(".", $fileName);
                        
                        $fileNameMin = $tmp[0];

                        $name_tmp = $uploadedFile['tmp_name'];
                        
                        $fileName = $uploadedFile['name'];
                        
                        $tmp = explode(".", $fileName);
                        $fileNameMin = $tmp[0];

                        $name_tmp = $uploadedFile['tmp_name'];
                        
                        //echo $fileName."<br>";
                        //echo (string)Utils::isImage($fileName);
                        //exit;
                        if(Utils::isImage($fileName))
                        {
                            $image = $this->open_image($uploadedFile['tmp_name']);

                            $w = imagesx($image);
                            $h = imagesy($image);                        
                            if ($w > $tam_max || $h > $tam_max) {
                                $control = ($h >= $w);
                                if ($control) {
                                    $porcen = $tam_max / $h;
                                } else {
                                    $porcen = $tam_max / $w;
                                }

                                $new_w = $w * $porcen;
                                $new_h = $h * $porcen;

                                $im2 = ImageCreateTrueColor($new_w, $new_h);
                                imagecopyResampled($im2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                                $w = imagesx($im2);
                                $h = imagesy($im2);

                                imagejpeg($im2, $directory . $fileNameMin . ".jpg", 80);                            
                            } else {
                                imagejpeg($image, $directory . $fileNameMin . ".jpg", 80);
                            }
                             $fileName=$fileNameMin."jpg";
                             $this->responseArray = array("success" => true, "filename" => $fileName, "folder" => $folder, "filebase" => base64_encode($folder . "/" . $fileNameMin . ".jpg"), "thumbnails" => $thumbnails, "dimension" => $dimVisual,"tipo" => "Image");
                        }
                        else
                        {
                            move_uploaded_file($uploadedFile['tmp_name'],$directory.$fileName );
                            $this->responseArray = array("success" => true, "filename" => $fileName, "folder" => $folder, "filebase" => base64_encode($folder . "/" . $fileName ), "thumbnails" => $thumbnails, "tipo" => "File");
                        }
                        
                    } catch (Exception $e) {
                        $this->responseArray = array("error" => $e->getMessage(), "filename" => $fileName, "folder" => $folder, "success" => false);
                    }
                }
            } else {
                $this->responseArray = array("success" => false);
            }
        } catch (Exception $e) {
            $this->responseArray = array("error" => $e->getMessage(), "success" => false);
        }

        $this->setTemplate("responseTemplate");
    }
}
?>