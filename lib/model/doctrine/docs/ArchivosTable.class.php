<?php

class ArchivosTable extends Doctrine_Table
{
    
    
        public static function subirArchivos($attachments,$data){
        
        

//        $logFile = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR . "docs_error.log";


        $path="";
        if($data["ref1"] )
            $path.=$data["ref1"].DIRECTORY_SEPARATOR;
        if($data["ref2"])
            $path.=$data["ref2"].DIRECTORY_SEPARATOR;
        if($data["ref3"])
            $path.=$data["ref3"].DIRECTORY_SEPARATOR;

        try{
            foreach ($attachments as $file) {
                $fileName  = $file['name'] ;
                $mime = $file['type'];
                $size = $file['size'];
                $fileName = preg_replace('/\s\s+/', ' ', $fileName);
                $fileName=urlencode($fileName);
                $fileName = str_replace("+", " ", $fileName);
                $nombre = ($nombre!="")?$nombre:$fileName;
                $archivo = new Archivos();
                $archivo->setCaIddocumental($data["iddocumental"]);
                $archivo->setCaNombre($nombre);
                $archivo->setCaRef1($data["ref1"]);
                $archivo->setCaRef2($data["ref2"]);
                $archivo->setCaRef3($data["ref3"]);
                $archivo->setCaUsucreado($data["user"]);
                $archivo->setCaFchcreado(date("Y-m-d H:i:s"));
                $archivo->setAttachment($file);                
                if(!$archivo->guardar())
                {
                    $result = false;
                    $event = date("Y-m-d H:i:s")."Referencia:".$data["ref1"]."=>error al guardar";
                    Utils::writeLog($logFile, $event);
                    throw ($event);
                }
                else
                    $result=true;
                
            }
        }catch(Excepcion $e)
        {
            $result = false;
            $event = date("Y-m-d H:i:s")."Referencia:".$data["ref1"]."=>".$e."error";
            Utils::writeLog($logFile, $event);
            throw ($event);
        }        
        return $result;
    }
    
    public function subirDocumento($attachments,$data){
        
        $logFile = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR . "docs_error.log";
        
        $tipDoc = Doctrine::getTable("TipoDocumental")->find($data['iddocumental']);
        if(!$tipDoc)
            $this->forward404Unless($tipDoc);
        
        $folder = $tipDoc->getCaDirectorio();        
        if(!$folder)
            $this->forward404Unless($folder);
        
        $path="";
        if($data['ref1'])
            $path.=$data['ref1'].DIRECTORY_SEPARATOR;
        if($data['ref2'])
            $path.=str_replace("/","-",$data['ref2']).DIRECTORY_SEPARATOR;
        if($data['ref3'])
            $path.=str_replace("/","-",$data['ref3']).DIRECTORY_SEPARATOR;

        $directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR.$folder.$path;

        if(!is_dir($directory)){
            mkdir($directory, 0777, true);            
        }
        
        chmod ( $directory , 0777 );
        $result = array();
        
             
        try{
            if($attachments){                
                $fileName  = $attachments['name'] ;                
                $mime = $attachments['type'];
                $size = $attachments['size'];
                $fileName = preg_replace('/\s\s+/', ' ', $fileName);
                $fileName=urlencode($fileName);
                $fileName = str_replace("+", " ", $fileName);            
                $nombre = ($nombre!="")?$nombre:$fileName;
                
                if(move_uploaded_file($attachments['tmp_name'],$directory.$fileName )){
                    $archivo = new Archivos();                        
                    $archivo->setCaIddocumental($data['iddocumental']);
                    $archivo->setCaNombre($attachments['name']);
                    $archivo->setCaMime($mime);
                    $archivo->setCaSize($size);
                    $archivo->setCaPath($directory.DIRECTORY_SEPARATOR.$fileName);
                    $archivo->setCaRef1($data['ref1']);
                    $archivo->setCaRef2($data['ref2']);
                    $archivo->setCaRef3($data['ref3']);
                    $archivo->save();
                    
                    $result["estado"] = true;
                    $result["directory"] = $folder.$path;
                    $event = date("Y-m-d H:i:s")."Referencia:".$data['ref1']."=>El archivo se subió correctamente";
                    Utils::writeLog($logFile, $event);
                }else{
                    $result["estado"] = false;
                    $event = date("Y-m-d H:i:s")."Referencia:".$data['ref1']."=>No se pudo mover el archivo";
                    Utils::writeLog($logFile, $event);                    
                }
            }else{
                $result["estado"] = false;
                $event = date("Y-m-d H:i:s")."Referencia:".$data['ref1']."=>No existe archivo";
                Utils::writeLog($logFile, $event);
            }
        }catch(Exception $e){
            $result["estado"] = false;
            $event = date("Y-m-d H:i:s")."Referencia:".$data['ref1']."=>".$e."error";
            Utils::writeLog($logFile, $event);
        }
        return $result;
    }
    
    public static function getArchivosActivos($data = array()){
        
        if($data["ref1"] || $data["ref2"]){
            
            $archivos = Doctrine::getTable("Archivos")
                    ->createQuery("a")
                    ->addWhere("a.ca_ref1 = ?",$data["ref1"])
                    ->addWhere("a.ca_ref2 = ?",$data["ref2"])
                    ->addWhere("a.ca_usueliminado IS NULL")
                    ->execute();
            return $archivos;            
        }else{
            return false;
        }
    }
    
    public static function getReferenciaAntigua($refNueva){
        
        if(strlen($refNueva)==17){
            $tempRef = explode(".",$refNueva);
            $refOld = $tempRef[0].".".$tempRef[1].".".$tempRef[2].".".substr($tempRef[3],1,3).".".substr($tempRef[4],1,1);
            return $refOld;
        }else{
            return false;
        }
    }
}