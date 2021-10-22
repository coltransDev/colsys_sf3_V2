<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

/**
 * Description of myClass
 *
 * @author alramirez
 */
class IntegracionTr {

    /**
     * authenticate method
     *
     * @param array $params     
     * @return string
     */
    private function authenticate($params = array()) {

        $nit = $params["nit"];

        $login = $_SERVER["PHP_AUTH_USER"] ? $_SERVER["PHP_AUTH_USER"] : $_SERVER["HTTP_LOGIN"];
        $password = $_SERVER["PHP_AUTH_PW"] ? $_SERVER["PHP_AUTH_PW"] : $_SERVER["HTTP_PASSWORD"];
        
        if (!empty($login) && !empty($password)) {

            $query = "SELECT ca_id
                      FROM ids.tb_accesos_ws
                      WHERE
                        ca_id = $nit
                        AND ca_login = '" . $login . "'
                        AND ca_password = '" . $password . "'
                        AND ca_activo = TRUE
                      LIMIT 1";

            $con = Doctrine_Manager::getInstance()->getConnection('master');
            $st = $con->execute($query);
            $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

            //add your own auth code here. I have it check against a database table and return a value if found.            
            if ($this->resul) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * tipoSolicitud method
     *          
     * @param string $nit
     * @param string $tipo
     * @param string $json
     * @return array string
     */
    public function tipoSolicitud($nit, $tipo, $json) {

        //$empresa = Doctrine::getTable("Empresa")->findOneBy("ca_idsap", $companyIdSap);
        //$company = $empresa->getCaIdempresa();        
        $params = array("nit" => $nit);
        $auth = $this->authenticate($params);

        if ($auth) {
            try {
                $data = json_decode($json);
                
                
                
                
                
//                $idregistro = $companyIdSap.$data->IdRegistro;
//                
//                if($idregistro)                
//                    $transaccion = Doctrine::getTable("IntTransaccionesIn")->findBy("ca_idregistro", $idregistro)->getFirst();
//                
//                if(!$transaccion){
//                    $transaccion = new IntTransaccionesIn();
//                    $transaccion->setCaTipo($tipo);
//                    $transaccion->setCaCompania($companyIdSap);
//                    $transaccion->setCaNit($nit);
//                    $transaccion->setCaDatos($json);
//                    $transaccion->setCaEstado(0); // En proceso
//                    $transaccion->setCaIdregistro($idregistro);
//                    $transaccion->setCaFchenvio(date("Y-m-d H:i:s"));
//                    $transaccion->setCaUsucreado("Administrador");
//                    $transaccion->setCaFchcreado(date("Y-m-d H:i:s"));
//                    $transaccion->stopBlaming();
//                    $transaccion->save();
//                }else{
//                    $transaccion->setCaDatos($json);
//                    $transaccion->setCaFchenvio(date("Y-m-d H:i:s"));
//                    $transaccion->save();
//                }
//
//                $idtransaccion = $transaccion->getCaIdtransaccion();
//
                switch ($tipo) {
                    case "1": // Factura Compra
                        $result = $this->eventos($json);
                        break;
//                    case "2": // Cancelación de comprobantes
//                        $result = $this->cancelacionComprobantes($company, $json, $transaccion);
//                        break;
//                    case "3": // Pagos Recibidos
//                        $result = $this->pagosRecibidos($company, $json, $transaccion);
//                        break;
//                    case "4": // Activacion cliente
//                        $result = $this->activacionCliente($company, $json, $transaccion);
//                        break;
//                    case "5": // Activacion conceptos
//                        $result = $this->activacionConcepto($company, $json, $transaccion);
//                        break;
                }
                return $result;
            } catch (Exception $e) {
                return array("mensaje:" => "Remote: " . $e->getMessage() . " server:" . $_SERVER["SERVER_ADDR"], "reenvio:" => "s"); //." u:".$usuario."-nu:".$newUsuario;
            }
        } else {
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("Ws");
            $email->setCaIdcaso($nit);
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");

            $email->setCaSubject("Fallo autenticación Nit #" . $nit);
            $texto = "Log de eventos.<br/>" . print_r($_REQUEST) . "<br/>" . print_r($_SERVER);
            $log = json_encode($_SERVER);
            $log .= "<br/>" . json_encode($_REQUEST);
            $email->setCaBodyhtml($log);
            $email->addTo("alramirez@coltrans.com.co");
            $email->addTo("colsys@coltrans.com.co");
            $email->save();
            //$email->send();

            $login = $_SERVER["PHP_AUTH_USER"] ? $_SERVER["PHP_AUTH_USER"] : $_SERVER["HTTP_LOGIN"];
            $password = $_SERVER["PHP_AUTH_PW"] ? $_SERVER["PHP_AUTH_PW"] : $_SERVER["HTTP_PASSWORD"];

            return array("mensaje:" => "Falló Autenticación: Login=>" . $login . " Password=>" . $password . " Header=>" . json_encode($_SERVER), "reenvio" => "s");
        }
    }
    
    /**
     * eventos method
     * 
     * @param string $json
     */
    private function eventos($json) {
        
        $data = json_decode(utf8_decode($json));
        
        $referencia = $data->Referencia;
        $idevento = $data->Idevento;
        $nombreEvento = $data->NombreEvento;
        $descripcion = $data->Descripcion;
        $fchevento = $data->Fchevento;
        $nrodocumento = $data->NroDocumento;
        $pdf_base64 = $data->Pdf;
        $iddocumental = 49;
        
        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();
        
        try {
            
            $ino = Doctrine::getTable("InoMaestraAdu")->find($referencia);
            
            if($ino){
                
                $evento = new ExpoTracking();                
                $evento->setCaIdevento($idevento);
                $evento->setCaFchevento($fchevento);
                $evento->setCaReferencia($referencia);
                $evento->setDatosJson("nombreEvento", $nombreEvento);
                $evento->setDatosJson("descripcion", $descripcion);
                $evento->setDatosJson("nrodocumento", $nrodocumento);
                $evento->setDatosJson("pdf", $pdf_base64);
                $evento->setDatosJson("json", $json);
                $evento->setCaUsuario("tramitex");
                $evento->setCaRealizado(true);
                $evento->save($conn);
                
                $result = $this->crearPdf64($referencia, $pdf_base64, $iddocumental, $nrodocumento, $conn);
                
                if($result["success"]){
                    $estado = 1;
                    $mensaje = 'El evento se ha creado satisfactoriamente para la referencia: '.$referencia.'! Idevento=>'.$evento->getCaIdevento();
                    $reenvio = "n";
                    $success = true;
                    $responseFile = $result;                    
                }else{
                    $estado = 0;
                    $mensaje = $result["error"].' : '.$referencia.'! Idevento=>'.$evento->getCaIdevento();
                    $reenvio = "n";
                    $success = false;
                    $responseFile = $result;
                }
            }else{                
                $estado = 0;
                $mensaje = "Referencia: ".$referencia." no existe en nuestra base de datos";
                $reenvio = "n";
                $success = false;                
            }
            
            if($estado !== 0)
                $conn->commit();
            else
                $conn->rollback();
            
        } catch (Exception $e) {
            $conn->rollback();
            $estado = 0;
            $mensaje = "errorInfo: " . $e->getMessage();
            $reenvio = "s";
            $success = "false";
        }

        $respuesta = array("success:" => $success, "mensaje:" => utf8_encode($mensaje), "reenvio:" => $reenvio, "directory:"=>$directory, "size:"=>$size, "response:"=>$response);

        $this->responseArray = $respuesta;
        
        return $this->responseArray;
    }
    
    private function crearPdf64($referencia, $pdf_base64, $iddocumental, $nrodocumento, $conn){
        
        try{
        //Decode pdf content
            $pdf_decoded = base64_decode ($pdf_base64);
            $f = finfo_open();
            $mime = finfo_buffer($f, $pdf_decoded, FILEINFO_MIME_TYPE);                
            $size =  strlen(base64_decode($pdf_base64));

            $tipDoc = Doctrine::getTable("TipoDocumental")->find($iddocumental);
            $folder = $tipDoc->getCaDirectorio();

            $ref1 = $referencia;
            $ref2 = "Colmas";                
            $fileName = $nrodocumento;

            $path = "";

            if ($ref1)
                $path .= $ref1 . DIRECTORY_SEPARATOR;
            if ($ref2)
                $path .= $ref2 . DIRECTORY_SEPARATOR;

            $directory = sfConfig::get('app_digitalFile_root') . date("Y") . DIRECTORY_SEPARATOR . $folder . $path;

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }
            chmod($directory, 0777);                

            $ruta = $directory.DIRECTORY_SEPARATOR.$fileName.".pdf";                
            file_put_contents($ruta, $pdf_decoded);

            $archivo = new Archivos();
            $archivo->setCaIddocumental($iddocumental);
            $archivo->setCaNombre($fileName.".pdf");
            $archivo->setCaMime($mime);
            $archivo->setCaSize($size);
            $archivo->setCaPath($ruta);
            $archivo->setCaRef1($ref1);
            $archivo->setCaRef2($ref2);                                
            $archivo->setCaUsucreado("tramitex");
            $archivo->setCaFchcreado(date("Y-m-d H:i:s"));
            $archivo->stopBlaming();
            $archivo->save($conn);
        
            return array("id" => base64_encode($fileName), "file" => $fileName, "folder" => $folder, "success" => true);                                
                
        }catch(Exception $e){
            
            return array("error" => "No se pudo mover el archivo: " + $e->getMessage(), "filename" => $fileName, "folder" => $folder, "success" => false);
            
        }
    }
}
?>