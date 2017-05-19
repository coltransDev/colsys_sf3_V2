<?php

/**
 * gestDocumental actions.
 *
 * @package    colsys
 * @subpackage gestDocumental
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gestDocumentalActions extends sfActions {

    
    
    const RUTINA_GESDOC = 209;
    /**
     * Executes index action
     *
     */
    public function executeIndex() {

    }

    /*
     * 
     * @author: Andres Botero
     */

    public function executeDataArchivos() {


        $folder = base64_decode($this->getRequestParameter("folder"));
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        if (!is_dir($directory)) {
            @mkdir($directory, 0777, true);
        }

        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
        $this->files = array();
        foreach ($archivos as $archivo) {
            if (substr($archivo, -3, 3) == ".gz") {
                $nombreArchivo = substr($archivo, 0, strlen($archivo) - 3);
            } else {
                $nombreArchivo = $archivo;
            }

            $this->files[] = array("idarchivo" => base64_encode(basename($archivo)),
                "name" => utf8_encode(basename($nombreArchivo)),
                "lastmod" => time()
            );
        }
    }

    /*
     * Sube un archivo a la carpeta especificada
     * @author: Andres Botero
     */

    public function executeSubirArchivo() {

        sfConfig::set('sf_web_debug', false);
        $folder = base64_decode($this->getRequestParameter("folder"));
        $this->referer = base64_decode($this->getRequestParameter("referer"));
        $this->nameFileType = $this->getRequestParameter("namefiletype");

        $template = ($this->getRequestParameter("template") != "") ? $this->getRequestParameter("template") : "responseTemplate";

        $this->forward404Unless($folder);
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
        //echo $directory;
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        chmod($directory, 0777);
        try {
            if (count($_FILES) > 0) {
                $filePrefix = $this->getRequestParameter("filePrefix");
                if ($filePrefix) {
                    $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
                    foreach ($archivos as $archivo) {
                        if (substr(basename($archivo), 0, strlen($filePrefix)) == $filePrefix) {
                            @unlink($archivo);
                        }
                    }
                }

                foreach ($_FILES as $nameFile => $uploadedFile) {
                    if ($uploadedFile['name'] == "")
                        continue;
                    if ($this->nameFileType == "static") {
                        $archivos = sfFinder::type('file')->name($nameFile . '--*')->maxDepth(0)->in($directory);
                        if (count($archivos) > 0) {
                            Unlink($archivos[0]);
                        }
                        $filePrefix = $nameFile . "--";
                    }

                    if ($filePrefix) {
                        $fileName = $filePrefix . "_" . $uploadedFile['name'];
                    } else {
                        $fileName = $uploadedFile['name'];
                    }
                    $fileName = preg_replace('/\s\s+/', ' ', $fileName);
                    $fileName = urlencode($fileName);
                    $fileName = str_replace("+", " ", $fileName);

                    if (move_uploaded_file($uploadedFile['tmp_name'], $directory . $fileName)) {
                        $this->responseArray = array("id" => base64_encode($fileName), "filename" => $fileName, "folder" => $folder, "success" => true);
                    } else {
                        $this->responseArray = array("error" => "No se pudo mover el archivo", "filename" => $fileName, "folder" => $folder, "success" => false);
                    }
                }
            } else {
                $this->responseArray = array("success" => false);
            }
        } catch (Exception $e) {
            $this->responseArray = array("error" => $e->getMessage(), "success" => false);
        }
        $this->setTemplate($template);
    }

    /*
     * Permite visualizar un archivo del panel
     * @author: Andres Botero
     */

    public function executeVerArchivo() {

        $this->archivo1="";
        if ($this->getRequestParameter("idarchivo")) {
            $archivo = base64_decode($this->getRequestParameter("idarchivo"));
            $this->forward404Unless($archivo);
            $folder = base64_decode($this->getRequestParameter("folder"));
            $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
            $this->archivo = $directory . $archivo;
        } else if ($this->getRequestParameter("id_archivo")) {
            $archivo = Doctrine::getTable("Archivos")->find($this->getRequestParameter("id_archivo"));
            $this->archivo = $archivo->getCaPath();
        }else if ($this->getRequestParameter("name")!="") {
            $this->archivo= base64_decode($this->getRequestParameter("name"));
        }
        
        if (!file_exists($this->archivo) && !file_exists($this->archivo . ".gz" )) {
            $this->archivo1=$this->archivo;
            $this->archivo1 = str_replace(" ", "_", $this->archivo1);
            if (!file_exists($this->archivo1) && !file_exists($this->archivo1 . ".gz" )) 
            {
                $info = pathinfo($this->archivo);
                $this->archivo1 =  basename($this->archivo,'.'.$info['extension']);
                $this->dir1 =  dirname($this->archivo);            
                $this->archivo1=$this->dir1."/".$this->archivo1."-P".".".$info['extension'];
                if ( !file_exists($this->archivo1)) {
                    $this->archivo=$this->archivo1;
                }
                if (!file_exists($this->archivo) && !file_exists($this->archivo . ".gz" ))
                {
                    $this->archivo = str_replace(" ", "_", $this->archivo);
                    if (!file_exists($this->archivo) && !file_exists($this->archivo . ".gz" ))
                    {
                        $this->forward404("No se encuentra el archivo especificado ".$this->archivo);
                    }
                }
            }
            else
            {
                $this->archivo=$this->archivo1;
            }            
        }

        if (file_exists($this->archivo . ".gz")) {
            $this->archivo.=".gz";
        }
        else if (file_exists($this->archivo1)) {
            $this->archivo=$this->archivo1;
        }
    }

    /*
     * Permite visualizar un archivo del panel
     * @author: Andres Botero
     */

    public function executeVerArchivoLibreClave() {

        $archivo = base64_decode($this->getRequestParameter("idarchivo"));

        $this->forward404Unless($archivo);

        $folder = base64_decode($this->getRequestParameter("folder"));
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        $this->archivo = $directory . $archivo;

        if (!file_exists($this->archivo) && !file_exists($this->archivo . ".gz")) {
            $this->forward404("No se encuentra el archivo especificado");
        }

        if (file_exists($this->archivo . ".gz")) {
            $this->archivo.=".gz";
        }
    }

    /*
     * Permite visualizar las 
     * @author: Andres Botero
     */

    public function executeVerImagen() {
        try {
            $archivo = base64_decode($this->getRequestParameter("idarchivo"));
            $tam_max = ($this->getRequestParameter("tam_max")) ? $this->getRequestParameter("tam_max") : 200;

            $this->forward404Unless($archivo);

            $folder = base64_decode($this->getRequestParameter("folder"));
            $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

            $this->archivo = $directory . $archivo;

            $image = imagecreatefromjpeg($this->archivo);

            if ($image === false) {
                echo "error";
                exit;
            }
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

                imagejpeg($img2);
                imagedestroy($img2);
            } else {
                imagejpeg($image);
                imagedestroy($image);
            }
        } catch (Exception $e) {
            print_r($e);
        }
        exit;
    }

    /*
     * Permite borrar el archivo
     * @author: Andres Botero
     */

    public function executeBorrarArchivo() {
        $id = $this->getRequestParameter("id");
        $archivo = base64_decode($this->getRequestParameter("idarchivo"));
        $this->forward404Unless($archivo);

        $folder = base64_decode($this->getRequestParameter("folder"));
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        if (file_exists($directory . $archivo)) {
            $this->responseArray = array("id" => $id, "success" => true);
            unlink($directory . $archivo);
        } else {
            $this->responseArray = array("id" => $id, "success" => false);
        }
        $this->setTemplate("responseTemplate");
    }

    /*
     * Muestra un formulario que hace posible cargar un archivo
     * @author: Andres Botero
     */

    public function executeCargarArchivoForm() {
        $this->reporteId = $this->getRequestParameter("reporteId");
    }

    /*
     * Permite subir una imagen desde el editor YUI
     */

    public function executeUploadImage($request) {
        $folder = $request->getParameter("folder");
        $idissue = $request->getParameter("idissue");
        $this->responseArray = array();
        if (isset($_FILES['image']['tmp_name'])) {
            $img = $_FILES['image']['tmp_name'];
            $ext = strtolower(substr($_FILES['image']['name'], -3, 3));
            $himage = fopen($img, "r");
            $image = fread($himage, filesize($img));
            fclose($himage);
            //if image can't be opened, either its not a valid format or even an image:
            if ($image === FALSE) {
                $this->responseArray["status"] = utf8_encode('Error Reading Uploaded File.');
            } else {
                // create a new random numeric name to avoid rewriting other images already on the server...
                $ran = rand();
                $ran2 = $ran . ".";
                $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

                if (!is_dir($directory)) {
                    @mkdir($directory, 0777, true);
                }
                $filename = $ran2 . $ext;
                // join path and name
                $path = $directory . $filename;
                // copy the image to the server, alert on fail
                $hout = fopen($path, "w");
                fwrite($hout, $image);
                fclose($hout);

                $urlpath = "/gestDocumental/verArchivo/folder/" . base64_encode($folder) . "/idarchivo/" . base64_encode($filename);
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

    public function executeDatosPanelDirectorios() {
        $folder = base64_decode($this->getRequestParameter("folder"));
        $digitalFile = sfConfig::get('app_digitalFile_root');
        $directory = $digitalFile . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

        if (!is_dir($directory)) {
            @mkdir($directory, 0777, true);
        }

        $dirs = glob($directory . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
        $data = array();
        foreach ($dirs as $dir) {
            $subdirs = glob($dir . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
            $data[] = array(
                'id' => str_replace($digitalFile, "", $dir),
                'text' => substr(strrchr($dir, DIRECTORY_SEPARATOR), 1),
                'loaded' => count($subdirs) == 0,
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
                        $fileNameMin = $tmp[0];
                        $name_tmp = $uploadedFile['tmp_name'];
                        $fileName = $uploadedFile['name'];
                        $tmp = explode(".", $fileName);
                        $fileNameMin = $tmp[0];
                        $name_tmp = $uploadedFile['tmp_name'];

                        if (Utils::isImage($fileName)) {
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
                            $fileName = $fileNameMin . "jpg";
                            $this->responseArray = array("success" => true, "filename" => $fileName, "folder" => $folder, "filebase" => base64_encode($folder . "/" . $fileNameMin . ".jpg"), "thumbnails" => $thumbnails, "dimension" => $dimVisual, "tipo" => "Image");
                        } else {
                            move_uploaded_file($uploadedFile['tmp_name'], $directory . $fileName);
                            $this->responseArray = array("success" => true, "filename" => $fileName, "folder" => $folder, "filebase" => base64_encode($folder . "/" . $fileName), "thumbnails" => $thumbnails, "tipo" => "File");
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

    public function executeMultipleUpload($request) {

        $respuesta = sfContext::getInstance()->getResponse();
        $respuesta->addJavascript("ext4/ext-all.js");
        $respuesta->addJavascript("ext4/ux/multiupload/swfobject.js");
    }

    function executeDatosSeries($request) {
        
        $user = $this->getUser();
        
        /*Accesos del usuario*/
        $permisosRutinas = $user->getControlAcceso(self::RUTINA_GESDOC);
        
        //print_r($permisosRutinas);
        //exit;
        $idpadre = ($request->getParameter("node") != "" && $request->getParameter("node") != "root") ? $request->getParameter("node") : "0";
        
        $series = Doctrine::getTable("Series")
                ->createQuery("s")
                ->select("s.*")
                ->where("s.ca_idpadre = ? ", $idpadre)
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();
        
        $tree = array("text" => "Gestion Documental",
            "leaf" => true,
            "id" => "1");

        foreach ($series as $s) {
            $subseries = Doctrine::getTable("Series")
                    ->createQuery("s")
                    ->select("s.*")
                    ->where("s.ca_idpadre = ? ", $s["ca_idsserie"])
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->execute();
            if (count($subseries) > 0) {
                $leaf = false;
            } else {
                $leaf = true;
            }
            if(in_array($s["ca_nombre"], $permisosRutinas) || $idpadre>0)
            {
                $childrens[] = array("text" => $s["ca_nombre"],
                    "leaf" => $leaf,
                    "id" => $s["ca_idsserie"],
                    "Consultar"=>((in_array("Consultar", $permisosRutinas))?true:false),
                    "Crear"=>((in_array("Crear", $permisosRutinas))?true:false),
                    "Editar"=>((in_array("Editar", $permisosRutinas))?true:false),
                    "Anular"=>((in_array("Anular", $permisosRutinas))?true:false)
                    );
            }
        }
        $tree["children"] = $childrens;
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }

    public function executeSubirArchivoTRD(sfWebRequest $request) {
        sfConfig::set('sf_web_debug', false);

        $iddocumental = $this->getRequestParameter("documento");
        $nombre = $this->getRequestParameter("nombre");
        $ref1 = $this->getRequestParameter("ref1");
        $ref2 = $this->getRequestParameter("ref2");
        $ref3 = $this->getRequestParameter("ref3");

        $tam_max = ($this->getRequestParameter("tam_max")) ? $this->getRequestParameter("tam_max") : "200";
        $dimVisual = ($this->getRequestParameter("tam_max_visual")) ? $this->getRequestParameter("tam_max_visual") : $tam_max;

        $tipDoc = Doctrine::getTable("TipoDocumental")->find($iddocumental);
        $this->forward404Unless($tipDoc);
        $folder = $tipDoc->getCaDirectorio();

        $this->referer = base64_decode($this->getRequestParameter("referer"));

        $template = ($this->getRequestParameter("template") != "") ? $this->getRequestParameter("template") : "responseTemplate";
        $path = "";
        if ($ref1)
            $path.=$ref1 . DIRECTORY_SEPARATOR;
        if ($ref2)
            $path.=$ref2 . DIRECTORY_SEPARATOR;
        if ($ref3)
            $path.=$ref3 . DIRECTORY_SEPARATOR;

        $directory = sfConfig::get('app_digitalFile_root') . date("Y") . DIRECTORY_SEPARATOR . $folder . $path;
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        chmod($directory, 0777);

        try {
            if (count($_FILES) > 0) {

                foreach ($_FILES as $nameFile => $uploadedFile) {

                    $fileName = $uploadedFile['name'];
                    $algo = false;
                    $mime = Utils::mimetype($uploadedFile['name']);

                    $size = $uploadedFile['size'];
                    $fileName = preg_replace('/\s\s+/', ' ', $fileName);
                    $fileName = urlencode($fileName);
                    $fileName = str_replace("+", " ", $fileName);

                    if (Utils::isImage($uploadedFile['name'])) {
                        $tmp = explode(".", $fileName);
                        $fileNameMin = $tmp[0];

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

                        $fileName=$fileNameMin . ".jpg";
                        $algo = true;
                    } else {
                        $existe=true;
                        $con=0;
                        while($existe)
                        {
                            $con++;
                            if(file_exists($directory . $fileName))
                            {
                                $info = pathinfo($directory.$fileName);
                                $fileName =  basename($directory.$fileName,'.'.$info['extension']);
                                $fileName=$fileName.$con.".".$info['extension'];
                            }
                            else
                                $existe=false;
                        }
                        if (move_uploaded_file($uploadedFile['tmp_name'], $directory . $fileName)) {

                            $algo = true;
                        } else {
                            $this->responseArray = array("error" => "No se pudo mover el archivo", "filename" => $fileName, "folder" => $folder, "success" => false);
                        }
                    }
                    $nombre = ($nombre != "") ? $nombre : $fileName;
                    if ($algo) {
                        $archivo = new Archivos();
                        $archivo->setCaIddocumental($iddocumental);
                        $archivo->setCaNombre($nombre);
                        $archivo->setCaMime($mime);
                        $archivo->setCaSize($size);
                        $archivo->setCaPath($directory . DIRECTORY_SEPARATOR . $fileName);
                        $archivo->setCaRef1($ref1);
                        $archivo->setCaRef2($ref2);
                        $archivo->setCaRef3($ref3);
                        $archivo->save();
                        $this->responseArray = array("id" => base64_encode($fileName), "file" => $fileName, "folder" => $folder, "success" => true);
                    }
                }
            } else {
                $this->responseArray = array("success" => false);
            }
        } catch (Exception $e) {
            $this->responseArray = array("error" => $e->getMessage(), "success" => false);
        }
        $this->setTemplate($template);
    }
    
    
    public function process_image($uploadedFile,$directory,$fileName) 
    {
        $tmp = explode(".", $fileName);
        $fileNameMin = $tmp[0];

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
        return $fileNameMin . ".jpg";
    }

    public function executeEditarArchivo(sfWebRequest $request) {
        $idarchivo = $this->getRequestParameter("idarchivo");
        $iddocumental = $this->getRequestParameter("documento");
        $nombre = $this->getRequestParameter("nombre");
        $ref = $this->getRequestParameter("ref");
        $depth1 = $this->getRequestParameter("depth1");
        $depth2 = $this->getRequestParameter("depth2");
        $ref1 = $this->getRequestParameter("ref1");
        $ref2 = $this->getRequestParameter("ref2");
        $ref3 = $this->getRequestParameter("ref3");

        try {
            $archivo = Doctrine::getTable("Archivos")->find($idarchivo);
            $this->forward404Unless($archivo);
            if (is_numeric($iddocumental))
                $archivo->setCaIddocumental($iddocumental);
            if ($nombre)
                $archivo->setCaNombre($nombre);

            switch ($depth1) {
                case "1":
                    $ref1 = "";
                    break;
                case "2":
                    $ref2 = "";
                    break;
                case "3":
                    $ref3 = "";
                    break;
            }
            switch ($depth2) {
                case "1":
                    $ref1 = $ref;
                    break;
                case "2":
                    $ref2 = $ref;
                    break;
                case "3":
                    $ref3 = $ref;
                    break;
            }

            if ($depth1 == "1" || $depth2 == "1")
                $archivo->setCaRef1($ref1);
            if ($depth1 == "2" || $depth2 == "2")
                $archivo->setCaRef2($ref2);
            if ($depth1 == "3" || $depth2 == "3")
                $archivo->setCaRef3($ref3);

            if ($depth1 == "" && $depth2 == "") {
                $archivo->setCaRef1($ref1);
                $archivo->setCaRef2($ref2);
            }
            $archivo->save();

            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $this->responseArray = array("error" => $e->getMessage(), "success" => false);
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDataFilesTree($request) {

        $node = ($request->getParameter("node") != "root" ) ? $request->getParameter("node") : "0";
        $idsserie = $this->getRequestParameter("idsserie");        
        $documento = $request->getParameter("documento");
        $nombre = $request->getParameter("nombre");
        $ref1 = $request->getParameter("ref1");
        $ref2 = $request->getParameter("ref2");
        $ref3 = $request->getParameter("ref3");

        if (!$nombre && !$documento && !$ref1 && !$ref2 && !$ref3)
            exit;

        $q = Doctrine::getTable("Archivos")
                ->createQuery("a")
                ->select("a.*,t.ca_documento,t.ca_idsserie")
                ->innerJoin("a.TipoDocumental t")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->where("a.ca_fcheliminado is NULL " )
                ->addWhere("ca_idsserie = ?", $idsserie)
                ->orderBy("ca_ref2 desc,ca_nombre");

        if ($nombre != "")
            $q->addWhere("ca_nombre = ?", $nombre);

        if ($documento != "")
            $q->addWhere("ca_iddocumental = ?", $documento);

        if ($ref1 != ""){
            if($idsserie != 10)
            $q->addWhere("ca_ref1 like ?", "%" . $ref1 . "%");
            else
                $q->addWhere("ca_ref1 = ?", $ref1);
        }

        if ($ref2 != "")
            $q->addWhere("ca_ref2 like ?", "%" . $ref2 . "%");

        if ($ref3 != "")
            $q->addWhere("ca_ref2 like ?", "%" . $ref3 . "%");

        $tipoDocs = $q->execute();
        //echo "<pre>";print_r($tipoDocs);echo "</pre>";
        $this->tipoDocs = array();
        foreach ($tipoDocs as $t) {
            $t["ca_ref2"] = utf8_encode($t["ca_ref2"]);
            if ($t["ca_fcheliminado"])
                continue;
            if ($t["ca_ref3"] != "")
                $this->tipoDocs[$t["ca_ref1"]][$t["ca_ref2"]][$t["ca_ref3"]][] = array("idarchivo" => $t["ca_idarchivo"], "documento" => utf8_encode($t["TipoDocumental"]["ca_documento"]), "iddocumental" => $t["ca_iddocumental"], "ref1" => $t["ca_ref1"], "ref2" => $t["ca_ref2"], "ref3" => $t["ca_ref3"], "nombre" => ($t["ca_nombre"] . (($t["ca_fcheliminado"] != "") ? " (Eliminado)" : "" )), "usucreado" => $t["ca_usucreado"], "fchcreado" => $t["ca_fchcreado"], "leaf" => true, "expanded" => true , "idsserie"=>$t["TipoDocumental"]["ca_idsserie"]);
            else if ($t["ca_ref2"] != "") {
                $this->tipoDocs[$t["ca_ref1"]][$t["ca_ref2"]][] = array("idarchivo" => $t["ca_idarchivo"], "documento" => utf8_encode($t["TipoDocumental"]["ca_documento"]), "iddocumental" => $t["ca_iddocumental"], "ref1" => $t["ca_ref1"], "ref2" => $t["ca_ref2"], "ref3" => $t["ca_ref3"], "nombre" => ($t["ca_nombre"] . (($t["ca_fcheliminado"] != "") ? " (Eliminado)" : "" )), "usucreado" => $t["ca_usucreado"], "fchcreado" => $t["ca_fchcreado"], "leaf" => true, "expanded" => true , "idsserie"=>$t["TipoDocumental"]["ca_idsserie"]);
            } else if ($t["ca_ref1"] != "") {
                $this->tipoDocs[$t["ca_ref1"]][] = array("idarchivo" => $t["ca_idarchivo"], "documento" => utf8_encode($t["TipoDocumental"]["ca_documento"]), "iddocumental" => $t["ca_iddocumental"], "ref1" => $t["ca_ref1"], "ref2" => $t["ca_ref2"], "ref3" => $t["ca_ref3"], "nombre" => ($t["ca_nombre"] . (($t["ca_fcheliminado"] != "") ? " (Eliminado)" : "" )), "usucreado" => $t["ca_usucreado"], "fchcreado" => $t["ca_fchcreado"], "leaf" => true, "expanded" => true, "idsserie"=>$t["TipoDocumental"]["ca_idsserie"]);
            }
        }

        $tree = $this->generateTree($this->tipoDocs);
        $this->responseArray = $tree;
        $this->setTemplate("responseTemplate");
    }

    public function generateTree($docs) {
        $childrens = $this->getChildrensFiles($docs);
        $tree = array("text" => "Gestion Documental",
            "leaf" => false,
            "id" => "0",
            "children" => $childrens);
        return $tree;
    }

    public function getChildrensFiles($docs) {
        $tipoDocs = array();
        foreach ($docs as $key => $t) {

            if (is_array($t)) {
                $childrens = $this->getChildrensFiles($t);
                if (count($childrens) > 0) {
                    if (!isset($t["idarchivo"]) && !isset($t["nombre"])) {
                        $tipoDocs[] = array("idarchivo" => $key, "nombre" => $key, "children" => $childrens , "idsserie"=>$t["idsserie"], "leaf" => false);
                    } else
                        $tipoDocs[] = array("idarchivo" => $t["idarchivo"], "documento" => $t["documento"], "iddocumental" => $t["iddocumental"], "ref1" => $t["ref1"], "ref2" => $t["ref2"], "ref3" => $t["ref3"], "nombre" => utf8_encode($t["nombre"]), "usucreado" => $t["usucreado"], "fchcreado" => $t["fchcreado"], "children" => $childrens, "idsserie"=>$t["idsserie"], "leaf" => false);
                }
                else {
                    $tipoDocs[] = array("idarchivo" => $t["idarchivo"], "documento" => $t["documento"], "iddocumental" => $t["iddocumental"], "ref1" => $t["ref1"], "ref2" => $t["ref2"], "ref3" => $t["ref3"], "nombre" => utf8_encode($t["nombre"]), "usucreado" => $t["usucreado"], "fchcreado" => $t["fchcreado"], "idsserie"=>$t["idsserie"], "leaf" => true);
                }
            }
        }
        return $tipoDocs;
    }

    public function executeEliminarArchivo(sfWebRequest $request) {
        $user = $this->getUser();
        $idarchivo = $request->getParameter("idarchivo");
        $observaciones = $request->getParameter("observaciones");
        $archivo = Doctrine::getTable("Archivos")->find($idarchivo);
        $archivo->setCaFcheliminado(date("Y-m-d H:i:s"));
        $archivo->setCaUsueliminado($user->getUserId());
        $archivo->setCaObservaciones($observaciones);
        $archivo->save();
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeBackRefer(sfWebRequest $request) {
        $this->back = $this->getRequest()->getCookie('back_refer');
        $this->getResponse()->setCookie('back_refer', "");
    }

    public function executeFormUploadExt4(sfWebRequest $request) {

        $this->getResponse()->setCookie('back_refer', (($this->getRequest()->getCookie('back_refer') != "") ? $this->getRequest()->getCookie('back_refer') : $request->getReferer()));
        $this->idsserie = ($this->getRequestParameter("idsserie") != "") ? $this->getRequestParameter("idsserie") : "2";

        $this->ref1 = str_replace("|", ".", $this->getRequestParameter("ref1"));
        $this->ref2 = str_replace("|", ".", $this->getRequestParameter("ref2"));
        $this->ref3 = str_replace("|", ".", $this->getRequestParameter("ref3"));
    }

    public function executeMailDocumentosF(sfWebRequest $request) {
        $folder1=$request->getParameter("folder");
        $debug=$request->getParameter("debug");

        try{
            ProjectConfiguration::registerZend();
            Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
            Zend_Loader::loadClass('Zend_Gdata_Gapps');
            $pass = 'cglti$col91';
            $mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
            $mail->selectFolder($folder1);
            
            foreach ($mail as $messageNum => $message) {
                //if ($message->hasFlag(Zend_Mail_Storage::FLAG_SEEN)) {
                //    continue;
                //}
                
                $from = $message->from;
                $part = $message;

                while ($part->isMultipart()) {
                    
                    for($i=1;$i<=2;$i++)
                    {
                        $part = $message->getPart($i);
                        if($debug=="true")
                        {
                            echo "<pre>";
            //                print_r($part);
                            echo "<pre>";
                        }
                        try{
                            if($part->getHeader('content-disposition'))
                            {
                                $arr=explode(";", $part->getHeader('content-disposition'));
                                if(trim($arr[0])=="attachment")
                                {
                                    $fileName=  str_replace("filename=", "", $arr[1]);
                                    $fileName=  trim(str_replace('"', '', $fileName));
                                    break;
                                }
                            }
                        }
                        catch(Exception $e)
                        {
                            continue;
                        }
                    }
                    try {
                        $path = $prepath ="";
                        $fileName = (strlen($fileName)>5)?$fileName:$part->getHeader('content-description');
                        $attachment = base64_decode($part->getContent());
                        $size = strlen($attachment);
                        //$directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR;
                        $mime = explode(";", $part->getHeader('content-type'));
                        $mime = $mime[0];
                        if($folder1=="DOCUMENTOS" || $folder1=="DOCUMENTOSAEREO" || $folder1=="DOCUMENTOSOTM" || $folder1=="DOCUMENTOSCLIENTES"|| $folder1=="DOCUMENTOSEXPO" || $folder1=="DOCUMENTOSADU")
                            $asunto = $message->subject;
                        else
                            $asunto = $fileName;

                        $ref = array();
                        $data = array();
                        $ref = explode("-",$asunto);
                        if($ref[1]!="cgar")
                        {
                            $ref[] = substr($asunto, 0, 13);
                            $ref[] = substr($asunto, 14, 4);
                            $ref[0] = str_replace(".", "", $ref[0]);
                            $ref[0] = substr($ref[0], 0, 3) . "." . substr($ref[0], 3, 2) . "." . substr($ref[0], 5, 2) . "." . substr($ref[0], 7, 4) . "." . substr($ref[0], 11, 2);
                            $data["ref1"] = $ref[0];
                        }
                        
                        if (isset($ref[1])) {
                            if ($ref[1] == "cost" || $ref[1] == "costos") {
                                $data["ref2"] = "costos";
                            } else if ($ref[1] == "pref" || $ref[1] == "libp") {
                                $data["ref2"] = "";
                            } else {
                                $sql = "select  ca_hbls from tb_inoclientes_sea 
                                where ca_referencia='" . $ref[0] . "' and UPPER(substring(ca_hbls from (char_length(ca_hbls)-3) ))= UPPER('" . $ref[1] . "') limit 1";
                                $con = Doctrine_Manager::getInstance()->connection();

                                $st = $con->execute($sql);
                                $resul = $st->fetchAll();
                                $data["ref2"] = $resul[0]["ca_hbls"];
                            }
                        }
                        
                        if ($ref[1] == "costos" || $ref[1] == "cost")
                        {
                            if($folder1=="DOCUMENTOSOTM")
                                $data["iddocumental"] = "27";
                            else
                                $data["iddocumental"] = "8";                            
                        }
                        else if ($ref[1] == "pref")
                            $data["iddocumental"] = "6";
                        else if ($ref[1] == "libp")
                            $data["iddocumental"] = "17";
                        else if ($ref[1] == "plar")
                            $data["iddocumental"] = "19";
                        else if ($ref[1] == "cert")
                            $data["iddocumental"] = "25";
                        else if ($ref[1] == "remi")
                            $data["iddocumental"] = "29";
                        else if ($ref[1] == "cgar")
                        {
                            $data["iddocumental"] = "30";
                            $prepath=date('Y'). DIRECTORY_SEPARATOR;
                            
                            $sql = "select  ca_id from ids.tb_ids 
                                where ca_idalterno='" . $ref[0] . "' limit 1";
                                $con = Doctrine_Manager::getInstance()->connection();
                                $st = $con->execute($sql);
                                $resul = $st->fetchAll();
                                $data["ref1"] = $resul[0]["ca_id"];
                                $data["ref1"] = $ref[0];
                                
                        /*      if($debug=="true")
                                {
                                    echo $sql."<pre>";
                                    print_r($data);
                                    echo "<pre>";
                                    //echo $asunto."<br>".$fileName;
                                }
                         */
                        }
                        else if ($ref[1] == "pqr")
                        {
                            if($folder1=="DOCUMENTOSCLIENTES")
                                $data["iddocumental"] = "52";
                            else if($folder1=="DOCUMENTOSEXPO")
                                $data["iddocumental"] = "50";
                            else if($folder1=="DOCUMENTOSADU")
                                $data["iddocumental"] = "51 ";
                        }
                        else if ($ref[1] == "ori")
                        {
                            if($folder1=="DOCUMENTOSEXPO")
                                $data["iddocumental"] = "49";
                            else if($folder1=="DOCUMENTOSADU")
                                $data["iddocumental"] = "46 ";
                        }
                        else if ($ref[1] == "tra")
                        {
                            if($folder1=="DOCUMENTOSEXPO")
                                $data["iddocumental"] = "48";
                            else if($folder1=="DOCUMENTOSADU")
                                $data["iddocumental"] = "47 ";
                            else if($folder1=="DOCUMENTOSOTM")
                                $data["iddocumental"] = "28 ";
                        }
                        else
                            $data["iddocumental"] = $request->getParameter("iddocumental");
                        
                        //print_r($data);
                        //exit;

                        if ($data["ref1"])
                            $path.=$data["ref1"] . DIRECTORY_SEPARATOR;
                        if ($data["ref2"])
                            $path.=$data["ref2"] . DIRECTORY_SEPARATOR;

                        $archivo = new Archivos();
                        $archivo->setCaIddocumental($data["iddocumental"]);
                        if($folder1=="DOCUMENTOS")
                            $archivo->setCaNombre($asunto);
                        else
                            $archivo->setCaNombre($fileName);
                        $archivo->setCaRef1($data["ref1"]);
                        $archivo->setCaRef2($data["ref2"]);
                        $archivo->setCaMime($mime);
                        $archivo->setCaSize($size);
                        $tipDoc = $archivo->getTipoDocumental();
                        $folder = $tipDoc->getCaDirectorio();
                        $directory = sfConfig::get('app_digitalFile_root') . date("Y") . DIRECTORY_SEPARATOR . $folder .$prepath. $path;

                        if (!is_dir($directory)) {
                            mkdir($directory, 0777, true);
                        }
                        chmod($directory, 0777);

                        $archivo->setCaPath($directory . $fileName);
                        $archivo->save();
                        $fh = fopen($directory . $fileName, 'w');
                        fwrite($fh, $attachment);
                        fclose($fh);
                    } catch (Excepcion $e) {
                        echo $e->getMessage();
                    }
                }
                $uniq_id = $mail->getUniqueId($messageNum);
                $messageId = $mail->getNumberByUniqueId($uniq_id);
                $mail->moveMessage($messageId, $folder1."P");
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            /*$data=array();
            $data["from"]="colsys@coltrans.com.co";
            $data["to"]="maquinche@coltrans.com.co";
            $data["subject"]="Error procesando correos $folder";
            $data["mensaje"]=$e->getMessage();
            Utils::sendEmail($data);
             */
        }
        exit;
    }
}
?>
