<?php

/**
 * gincomex actions.
 *
 * @package    colsys
 * @subpackage gincomex
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class gincomexActions extends sfActions {
    /*
     * Accion por defecto
     */

    public function executeIndex() {
        return $this->forward('gincomex', 'cargarOrdenes');
    }

    /*
     * Lista los Ordenes de Pedido de gincomex
     */

    public function executeList() {
        /*
        $this->gincomex_notifys = Doctrine::getTable("Gincomex")
                        ->createQuery("c")
                        ->where("c.ca_usuarchivado IS NULL")
                        ->andWhere("c.ca_usuanulado IS NULL")
                        ->addOrderBy("c.ca_idgincomex desc")
                        //->getSqlQuery();
                        ->execute();
         * 
         */
    }

    /*
     * Carga en la Tabla Gincomex Maestra, con la información de cabecera de ordenes
     */

    public function executeCargarOrdenes() {
        ProjectConfiguration::registerZend();
        //$client = new Zend_Soap_Client( $wsdl_uri, array('encoding'=>'ISO-8859-1'));

        $params = sfConfig::get('app_soap_gincomex');
        $url = $params['url'];
        $pass = $params['pass'];

        try {
            $client = new Zend_Soap_Client(null, array('location' => "$url",
                        'uri' => "http://tempuri.org",
                        'encoding' => 'UTF-8',
                        'soap_version' => SOAP_1_2,
                        // 'style' => SOAP_DOCUMENT,
                    ));

            $result = $client->nuevasOrdenes(array('clave' => $pass));
            
            // print_r($client);
            // die();

            // print_r($result);
            
            die("Client fault".$client->fault);

            if (!$ordenes) {
                // throw new Exception($ordenes);
            }


            if ($client->fault) {
                // Error si la función estuvo mal llamada, modifique aca si desea ver
                // el mensaje de error de otra forma
                // echo '<h2>FALLA (Error en la llamada de la función correspondiente)</h2><pre>'; print_r($result); echo '</pre>';
            } else {
                // Descomente la siguiente línea si desea observar el retorno SOAP-XML de la función
                // echo '<h2>SALIDA RETORNADA</h2><pre>'.htmlspecialchars($client->request, ENT_QUOTES).'</pre>';
            }

            /*
              foreach ($ordenes as $orden){
              echo $orden->cliente;
              echo "<br />";
              }
             */
            exit();
        } catch (SoapFault $soapFault) {
            var_dump($soapFault);
            //echo "Exception: ".$e->getMessage();
        } catch (Exception $soapFault) {
            echo "Exception: " . $soapFault->getMessage();
        }

        $this->forward('gincomex', 'list');
    }

    /*
     * Carga en la Tabla ClarEmbarque, con la información de las cartas de instrucción
     */

    public function executeLoadLetters() {
        set_time_limit(270);
        $directory = sfConfig::get('app_gincomex_output');
        $processed = "processed";
        $separador = ";";

        $files = sfFinder::type('file')->name('Cartas*.csv')->maxDepth(0)->in($directory);

        foreach ($files as $file) {
            $handle = fopen($file, "r");
            $input = fread($handle, filesize($file));
            $input = str_replace(chr(13), "", str_replace(chr(34), "", $input));

            $records = explode(chr(10), $input); // Divide el archivo por los Saltos de Línea
            $docCompra = null;

            foreach ($records as $record) {       // Hace una primera lectura para verificar la estructura del archivo
                if (strpos($record, 'Nr. documento carta instrucció') === FALSE) {
                    $fields = explode($separador, $record); // Divide el archivo en campos por el separador

                    if (strlen($record) == 0) {
                        break;
                    } else if (count($fields) != 15) {
                        print_r($fields);
                        echo "¡El archivo tiene errores en su estructura, por tanto no se puede importar! ";
                        exit;
                    } else if ($fields[0] == '') {
                        continue;
                    }

                    list($dia, $mes, $ano) = sscanf($fields[0], "%d.%d.%d");
                    $fecha = date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano));
                    $cantidad = str_replace(",", ".", str_replace(".", "", $fields[7]));

                    $clarEmbarque = new ClarEmbarque();
                    $clarEmbarque->setCaFecha($fecha);
                    $clarEmbarque->setCaDocumentoNro($fields[1]);
                    $clarEmbarque->setCaNumeroDo($fields[2]);
                    $clarEmbarque->setCaDoctransporte($fields[3]);
                    $clarEmbarque->setCaOrden($fields[4]);
                    $clarEmbarque->setCaPosicion($fields[5]);
                    $clarEmbarque->setCaProducto($fields[6]);
                    $clarEmbarque->setCaCantidad($cantidad);
                    $clarEmbarque->setCaUnidadMed($fields[8]);
                    $clarEmbarque->setCaEta($fields[9]);
                    $clarEmbarque->setCaEmbalaje($fields[10]);
                    $clarEmbarque->setCaTransporte($fields[11]);
                    $clarEmbarque->setCaTexto($fields[12]);
                    $clarEmbarque->setCaPln($fields[13]);
                    $clarEmbarque->setCaAgenteAdu($fields[14]);
                    $clarEmbarque->save();
                }
            }
            rename($file, $directory . DIRECTORY_SEPARATOR . $processed . DIRECTORY_SEPARATOR . basename($file));
        }

        $this->forward('gincomex', 'list');
    }

    /*
     * Permite ver los detalles de las Ordenes y editar los datos para generar el archivo de salida
     */

    public function executeProcesarOrden() {

        $this->gincomex = Doctrine::getTable("gincomex")
                        ->createQuery("d")
                        ->where("d.ca_idgincomex = ?", $this->getRequestParameter('idgincomex'))
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn", 'last');
        $response->addJavaScript("extExtras/LockingGridView", 'last');
        $response->addStylesheet("extExtras/LockingGridView", 'last');
    }

    /*
     * Guarda los cambios en el encabezado del documento
     */

    public function executeObserveGincomex() {
        $gincomex = Doctrine::getTable("Gincomex")->find($this->getRequestParameter('idgincomex'));
        $this->forward404Unless($gincomex);

        $this->responseArray = array("id" => $this->getRequestParameter('id'), "success" => false);

        if ($this->getRequestParameter('reporte') !== null) {
            $gincomex->setCaConsecutivo($this->getRequestParameter('reporte'));
        }

        $gincomex->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios en el detalle del documento
     */

    public function executeObserveDetail() {
        $clardetail = Doctrine::getTable("ClarDetail")
                        ->createQuery("d")
                        ->where("d.ca_iddetail = ?", $this->getRequestParameter('iddetail'))
                        ->addWhere("d.ca_idgincomex = ?", $this->getRequestParameter('idgincomex'))
                        // ->getSqlQuery();
                        ->fetchOne();

        $this->forward404Unless($clardetail);

        $this->responseArray = array("id" => $this->getRequestParameter('id'), "success" => false);

        if ($this->getRequestParameter('posicion') !== null) {
            $clardetail->setCaPosicion($this->getRequestParameter('posicion'));
        }

        if ($this->getRequestParameter('material') !== null) {
            $clardetail->setCaMaterial($this->getRequestParameter('material'));
        }

        if ($this->getRequestParameter('descripcion') !== null) {
            $clardetail->setCaDescripcion($this->getRequestParameter('descripcion'));
        }

        if ($this->getRequestParameter('despacho') !== null) {
            $clardetail->setCaDespacho($this->getRequestParameter('despacho'));
        }

        if ($this->getRequestParameter('unidad') !== null) {
            $clardetail->setCaUnidad($this->getRequestParameter('unidad'));
        }

        $clardetail->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Elimina la Orden para nuevamente ser procesada
     */

    public function executeArchivarOrden() {
        $gincomex = Doctrine::getTable("gincomex")->find($this->getRequestParameter('idgincomex'));
        $this->forward404Unless($gincomex);

        $this->responseArray = array("id" => $this->getRequestParameter('id'), "success" => false);

        $gincomex->setCaFchanulado(date("d M Y H:i:s"));
        $gincomex->setCaUsuanulado($this->getUser()->getUserId());
        $gincomex->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios en el detalle del documento
     */

    public function executeEliminarDetail() {
        if ($this->getRequestParameter('posicion') == null) {
            $clardetail = Doctrine::getTable("ClarDetail")->find(array($this->getRequestParameter('iddetail'), $this->getRequestParameter('idgincomex')));
        } else {
            $clardetail = Doctrine::getTable("ClarDetail")->find(array($this->getRequestParameter('iddetail'), $this->getRequestParameter('idgincomex'), $this->getRequestParameter('posicion')));
        }
        $this->forward404Unless($clardetail);

        $this->responseArray = array("id" => $this->getRequestParameter('id'), "success" => false);

        $clardetail->delete();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Genera el archivo para envio
     */

    public function executeGenerarArchivo() {

        $gincomexs = Doctrine::getTable("Gincomex")
                        ->createQuery("c")
                        ->where("c.ca_usuarchivado IS NULL")
                        ->andWhere("c.ca_usuanulado IS NULL")
                        ->addOrderBy("c.ca_idgincomex desc")
                        ->execute();

        $salida = "";
        set_time_limit(0);
        foreach ($gincomexs as $gincomex) {
            $clarDetails = $gincomex->getClarDetail();
            $reporte = $gincomex->getCaConsecutivo();
            foreach ($clarDetails as $clarDetail) {
                $reportes = Doctrine::getTable("Reporte")
                                ->createQuery("rp")
                                ->where("rp.ca_consecutivo = ?", $reporte)
                                ->andWhere("rp.ca_usuanulado IS NULL")
                                ->addOrderBy("rp.ca_consecutivo desc")
                                ->execute();

                $dep_estimate = null;
                $arr_estimate = null;
                $dep_confirm = null;
                $arr_confirm = null;
                $motonave = null;
                $doctranspor = null;

                foreach ($reportes as $reporte) {
                    if (!$reporte->esUltimaVersion()) {
                        continue;
                    }
                    $repStatus = $reporte->getRepStatus();

                    foreach ($repStatus as $status) {
                        if ($status->getCaIdnave()) {
                            $motonave = trim($status->getCaIdnave());
                        }
                        if ($status->getCaDoctransporte()) {
                            $doctranspor = $status->getCaDoctransporte();
                        }
                        if ($status->getCaFchsalida()) {
                            $dep_estimate = $status->getCaFchsalida();
                        }
                        if ($status->getCaFchllegada()) {
                            $arr_estimate = $status->getCaFchllegada();
                        }
                        if ($reporte->getCaTransporte() == "Aéreo") {
                            if ($status->getCaIdetapa() == "IACCR") {
                                $dep_confirm = $status->getCaFchsalida();
                            } elseif ($status->getCaIdetapa() == "IACAD") {
                                $arr_confirm = $status->getCaFchllegada();
                            }
                        } elseif ($reporte->getCaTransporte() == "Marítimo") {
                            if ($status->getCaIdetapa() == "IMETA") {
                                $dep_confirm = $status->getCaFchsalida();
                            } elseif ($status->getCaIdetapa() == "IMCPD") {
                                $arr_confirm = $status->getCaFchllegada();
                            }
                        }
                    }
                }

                // Realiza la verificación de las 4 Notificaciones
                if ($dep_estimate != null) {
                    $notify = Doctrine::getTable("ClarNotify") // Estimación de Zarpe
                                    ->createQuery("n")
                                    ->where("n.ca_iddetail = ?", $clarDetail->getCaIddetail())
                                    ->andWhere("n.ca_clave = 'SD'")
                                    ->andWhere("n.ca_texto  = 'PREV ARRIBO PTO/CO'")
                                    // ->getSqlQuery();
                                    ->fetchOne();
                    if ($notify) {
                        if ($notify->getCaFecha() != $dep_estimate) {
                            $notify->setCaFecha($dep_estimate);
                            $notify->setCaFchreportado(NULL);
                            $notify->setCaUsureportado(NULL);
                            $notify->save();
                        }
                    } else {
                        $notify = new ClarNotify();
                        $notify->setCaIddetail($clarDetail->getCaIddetail());
                        $notify->setCaClave("SD");
                        $notify->setCaFecha($dep_estimate);
                        $notify->setCaTexto("PREV ARRIBO PTO/CO");
                        $notify->save();
                    }
                }

                if ($arr_estimate != null) {
                    $notify = Doctrine::getTable("ClarNotify") // Estimación de Arribo
                                    ->createQuery("n")
                                    ->where("n.ca_iddetail = ?", $clarDetail->getCaIddetail())
                                    ->andWhere("n.ca_clave = ?", "SD")
                                    ->andWhere("n.ca_texto != ?", "PREV ARRIBO PTO/CO")
                                    ->fetchOne();
                    if ($notify) {
                        if ($notify->getCaFecha() != $arr_estimate or $notify->getCaTexto() != "PREV " . substr($motonave, 0, 12) . "/CO") {
                            $notify->setCaFecha($arr_estimate);
                            $notify->setCaTexto("PREV " . substr($motonave, 0, 12) . "/CO");
                            $notify->setCaFchreportado(NULL);
                            $notify->setCaUsureportado(NULL);
                            $notify->save();
                        }
                    } else {
                        $notify = new ClarNotify();
                        $notify->setCaIddetail($clarDetail->getCaIddetail());
                        $notify->setCaClave("SD");
                        $notify->setCaFecha($arr_estimate);
                        $notify->setCaTexto("PREV " . substr($motonave, 0, 12) . "/CO");
                        $notify->save();
                    }
                }

                if ($dep_confirm != null) {
                    $notify = Doctrine::getTable("ClarNotify") // Confirmación de Zarpe
                                    ->createQuery("n")
                                    ->where("n.ca_iddetail = ?", $clarDetail->getCaIddetail())
                                    ->andWhere("n.ca_clave = ?", "LA")
                                    ->fetchOne();

                    if ($gincomex->getCaDoctransporte() != $doctranspor) {   // Actualiza Cabecera con No. Doc.Transporte
                        $gincomex->setCaDoctransporte($doctranspor);
                        $gincomex->save();
                    }

                    $doctranspor = str_replace(" ", "", $doctranspor);
                    if (strlen($doctranspor) < 8) {
                        $len_doc = strlen($doctranspor);
                        $sob_doc = 8 - strlen($doctranspor);
                    } else {
                        $len_doc = 8;
                        $sob_doc = 0;
                    }

                    $motonave = str_replace(" ", "", $motonave);
                    if (strlen($motonave) < 8) {
                        $len_mot = strlen($motonave);
                        $sob_mot = 8 - strlen($motonave);
                    } else {
                        $len_mot = 8;
                        $sob_mot = 0;
                    }

                    $cadena = substr($motonave, 0, $len_mot + $sob_doc) . "-" . substr($doctranspor, -$len_doc - $sob_mot) . "/CO";

                    if ($notify) {
                        if ($notify->getCaFecha() != $dep_confirm or $notify->getCaTexto() != $cadena) {
                            $notify->setCaFecha($dep_confirm);
                            $notify->setCaTexto($cadena);
                            $notify->setCaFchreportado(NULL);
                            $notify->setCaUsureportado(NULL);
                            $notify->save();
                        }
                    } else {
                        $notify = new ClarNotify();
                        $notify->setCaIddetail($clarDetail->getCaIddetail());
                        $notify->setCaClave("LA");
                        $notify->setCaFecha($dep_confirm);
                        $notify->setCaTexto($cadena);
                        $notify->save();
                    }
                }

                if ($arr_confirm != null) {
                    $notify = Doctrine::getTable("ClarNotify") // Confirmación de Arribo
                                    ->createQuery("n")
                                    ->where("n.ca_iddetail = ?", $clarDetail->getCaIddetail())
                                    ->andWhere("n.ca_clave = ?", "AD")
                                    ->fetchOne();
                    if ($notify) {
                        if ($notify->getCaFecha() != $arr_confirm) {
                            $notify->setCaFecha($arr_confirm);
                            $notify->setCaTexto("CONF ARRIBO PTO/CO");
                            $notify->setCaFchreportado(NULL);
                            $notify->setCaUsureportado(NULL);
                            $notify->save();
                        }
                    } else {
                        $notify = new ClarNotify();
                        $notify->setCaIddetail($clarDetail->getCaIddetail());
                        $notify->setCaClave("AD");
                        $notify->setCaFecha($arr_confirm);
                        $notify->setCaTexto("CONF ARRIBO PTO/CO");
                        $notify->save();
                    }
                }

                $notifies = Doctrine::getTable("ClarNotify") // Confirmación de Arribo
                                ->createQuery("n")
                                ->where("n.ca_iddetail = ?", $clarDetail->getCaIddetail())
                                ->execute();

                foreach ($notifies as $notify) {
                    if (!$notify->getCaUsureportado() and !$notify->getCaFchreportado()) {
                        $salida.= str_pad($gincomex->getCaOrden(), 10, "0", STR_PAD_LEFT) . "|";  // 1
                        $salida.= str_pad($clarDetail->getCaPosicion(), 5, "0", STR_PAD_LEFT) . "|";  // 2
                        $salida.= str_pad($notify->getCaClave(), 2, " ", STR_PAD_LEFT) . "|";  // 3
                        $fch_evento = Utils::transformDate($notify->getCaFecha(), $format = "m.d.Y"); // 4
                        $salida.= str_pad($fch_evento, 10, " ") . "|"; // 4
                        $salida.= str_pad(number_format($clarDetail->getCaDespacho(), 3, ",", "."), 15, "0", STR_PAD_LEFT) . "|";  // 5
                        $salida.= str_pad($notify->getCaTexto(), 20, " ") . "|";  // 6
                        $salida.= "\r\n";

                        $notify->setCaFchreportado(date("d M Y H:i:s"));
                        $notify->setCaUsureportado($this->getUser()->getUserId());
                        $notify->save();
                    }
                }
            }
        }
        $this->salida = $salida;

        $directory = sfConfig::get('app_gincomex_output');
        $filename = $directory . DIRECTORY_SEPARATOR . 'COL' . date('YmdHis') . '.txt';
        $handle = fopen($filename, 'w');

        if (fwrite($handle, $salida) === FALSE) {
            echo "No se puede escribir al archivo {filename}";
            exit;
        }
        $this->redirect("gincomex/list");
    }

    /*
     * Func...
     */

    public function executeNuevoMensaje() {

    }

    public function executeEnviarEmail() {

        $this->setLayout("ajax");

        $directory = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR;
        $filename1 = $directory . DIRECTORY_SEPARATOR . 'notificacion.txt';
        @unlink($filename1);

        $this->executeGenerarArchivo();

        $user = $this->getUser();

        //Crea el correo electronico
        $email = new Email();
        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Fal Shipping Inst.");
        $email->setCaIdcaso('1');
        $email->setCaFrom($user->getEmail());
        $email->setCaFromname($user->getNombre());

        if ($this->getRequestParameter("readreceipt")) {
            $email->setCaReadReceipt($this->getRequestParameter("readreceipt"));
        }

        $email->setCaReplyto($user->getEmail());

        $recips = explode(",", $this->getRequestParameter("destinatario"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addTo($recip);
                }
            }
        }

        $recips = explode(",", $this->getRequestParameter("cc"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addCc($recip);
                }
            }
        }

        $email->addCc($this->getUser()->getEmail());
        $email->setCaSubject($this->getRequestParameter("asunto"));
        $email->setCaBody($this->getRequestParameter("mensaje"));

        //**
        $email->AddAttachment($filename1);
        $email->AddAttachment($filename2);
        $email->AddAttachment($filename3);

        $email->save(); //guarda el cuerpo del mensaje
        /*$this->error = $email->send();
        if ($this->error) {
            $this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
        }*/
    }

    /*
     * Panel de facturacion
     */

    public function executeObservePanelFacturacion(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $idgincomex = base64_decode($request->getParameter("idgincomex"));
        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("ClarFacturacion")->find(array($idgincomex, $numdocumento));
        if (!$factura) {
            $factura = new ClarFacturacion();
            $factura->setCaIdgincomex($idgincomex);
            $factura->setCaNumdocumento($numdocumento);
        }
        if ($this->getRequestParameter('emision_fch')) {
            $factura->setCaEmisionFch($this->getRequestParameter('emision_fch'));
        }
        if ($this->getRequestParameter('vencimiento_fch')) {
            $factura->setCaVencimientoFch($this->getRequestParameter('vencimiento_fch'));
        }
        if ($this->getRequestParameter('moneda')) {
            $factura->setCaMoneda($this->getRequestParameter('moneda'));
        }
        if ($this->getRequestParameter('tipo_cambio')) {
            $factura->setCaTipoCambio($this->getRequestParameter('tipo_cambio'));
        }
        if ($this->getRequestParameter('afecto_vlr')) {
            $factura->setCaAfectoVlr($this->getRequestParameter('afecto_vlr'));
        }
        if ($this->getRequestParameter('iva_vlr')) {
            $factura->setCaIvaVlr($this->getRequestParameter('iva_vlr'));
        }
        if ($this->getRequestParameter('exento_vlr')) {
            $factura->setCaExentoVlr($this->getRequestParameter('exento_vlr'));
        }
        $factura->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarFactura(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $idgincomex = base64_decode($request->getParameter("idgincomex"));
        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("ClarFacturacion")->find(array($idgincomex, $numdocumento));
        if ($factura) {
            $factura->delete();
        }
        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    /*
     * Panel de Notas
     */

    public function executeObservePanelNotasCab(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $idgincomex = base64_decode($request->getParameter("idgincomex"));
        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("ClarNotaCab")->find(array($idgincomex, $numdocumento));
        if (!$factura) {
            $factura = new ClarNotaCab();
            $factura->setCaIdgincomex($idgincomex);
            $factura->setCaNumdocumento($numdocumento);
        }
        if ($this->getRequestParameter('emision_fch')) {
            $factura->setCaEmisionFch($this->getRequestParameter('emision_fch'));
        }
        if ($this->getRequestParameter('vlrdocumento')) {
            $factura->setCaVlrdocumento($this->getRequestParameter('vlrdocumento'));
        }
        if ($this->getRequestParameter('tipo_cambio')) {
            $factura->setCaTipoCambio($this->getRequestParameter('tipo_cambio'));
        }
        $factura->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeNotaCab(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $idgincomex = base64_decode($request->getParameter("idgincomex"));
        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("ClarNotaCab")->find(array($idgincomex, $numdocumento));
        if ($factura) {
            $factura->delete();
        }

        $this->responseArray["success"] = true;

        $this->setTemplate("responseTemplate");
    }

    public function executePanelNotasDetData(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $idgincomex = base64_decode($request->getParameter("idgincomex"));
        $numdocumento = $request->getParameter("numdocumento");
        $facturas = array();
        if ($numdocumento) {
            $facturas = Doctrine::getTable("ClarNotaDet")
                            ->createQuery("d")
                            ->select("d.*")
                            ->where("d.ca_idgincomex = ? AND d.ca_numdocumento = ?", array($idgincomex, $numdocumento))
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                            ->execute();

            $facturas[] = array("d_ca_concepto" => "", "d_ca_numdocumento" => $numdocumento, "orden" => "Z");
        }
        $this->responseArray["root"] = $facturas;
        $this->responseArray["success"] = true;

        $this->setTemplate("responseTemplate");
    }

    public function executeObservePanelNotasDet(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $idgincomex = base64_decode($request->getParameter("idgincomex"));
        $numdocumento = $request->getParameter("numdocumento");
        $idconcepto = $request->getParameter("idconcepto");
        $detalle = Doctrine::getTable("ClarNotaDet")->find(array($idgincomex, $numdocumento, $idconcepto));

        if (!$detalle) {
            $detalle = new ClarNotaDet();
            $detalle->setCaIdgincomex($idgincomex);
            $detalle->setCaNumdocumento($numdocumento);
            $detalle->setCaIdconcepto($idconcepto);
        }

        if ($this->getRequestParameter('nit_ter')) {
            $detalle->setCaNitTer($this->getRequestParameter('nit_ter'));
        }
        if ($this->getRequestParameter('tipo')) {
            $detalle->setCaTipo($this->getRequestParameter('tipo'));
        }
        if ($this->getRequestParameter('factura_ter')) {
            $detalle->setCaFacturaTer($this->getRequestParameter('factura_ter'));
        }
        if ($this->getRequestParameter('factura_fch')) {
            $detalle->setCaFacturaFch($this->getRequestParameter('factura_fch'));
        }
        if ($this->getRequestParameter('factura_vlr')) {
            $detalle->setCaFacturaVlr($this->getRequestParameter('factura_vlr'));
        }
        if ($this->getRequestParameter('factura_iva')) {
            $detalle->setCaFacturaIva($this->getRequestParameter('factura_iva'));
        }
        $detalle->save();

        $this->responseArray["idconcepto"] = $detalle->getCaIdconcepto();
        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarPanelNotasDet(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));

        $idgincomex = base64_decode($request->getParameter("idgincomex"));
        $numdocumento = $request->getParameter("numdocumento");
        $idconcepto = $request->getParameter("idconcepto");

        $detalle = Doctrine::getTable("ClarNotaDet")->find(array($idgincomex, $numdocumento, $idconcepto));
        if ($detalle) {
            $detalle->delete();
        }

        $this->responseArray["success"] = true;

        $this->setTemplate("responseTemplate");
    }

    /*
     * Genera el archivo plano para Gincomex con datos del Prorrateo de Facturación
     */

    public function executeFacturacion() {
        $stmt = ClarFacturacionTable::prorrateoFacturacion();
        $directory = "/home/gincomex/IN";

        $salida.= "B/L,AWB\t";
        $salida.= "Doc.compra\t";
        $salida.= "Itm\t";
        $salida.= "Txt producto\t";
        $salida.= "Ctd.pedida\t";
        $salida.= "Ing.Propios\t";
        $salida.= "Ing.Terceros\t";
        $salida.= "UMP\t";
        $salida.= "\r\n";

        $ing_pro = null;
        $ing_ter = null;
        $imp_tot = false;
        $tot_can = $sub_can = 0;
        $tot_pro = $sub_pro = 0;
        $tot_ter = $sub_ter = 0;
        while ($row = $stmt->fetch()) {
            if ($ing_pro != $row["ca_numfactura"] or $ing_ter != $row["ca_numnota"]) {
                if ($imp_tot) {
                    $imp_tot = true;
                    $salida.= "\t\t\t";
                    $salida.= "Sub total :\t";
                    $salida.= $sub_can . "\t";
                    $salida.= $sub_pro . "\t";
                    $salida.= $sub_ter . "\t";
                    $salida.= "\t\r\n";
                    $tot_can+= $sub_can;
                    $tot_pro+= $sub_pro;
                    $tot_ter+= $sub_ter;
                    $sub_can = $sub_pro = $sub_ter = 0;
                }
                $salida.= "\t\t\t\t\t";
                $salida.= "Factura : " . $row["ca_numfactura"] . "\t";
                $salida.= "Nota No.: " . $row["ca_numnota"] . "\t";
                $salida.= "\t\r\n";
                $ing_pro = $row["ca_numfactura"];
                $ing_ter = $row["ca_numnota"];
            }

            $salida.= $row["ca_doctransporte"] . "\t";
            $salida.= $row["ca_orden"] . "\t";
            $salida.= $row["ca_posicion"] . "\t";
            $salida.= $row["ca_descripcion"] . "\t";
            $salida.= $row["ca_despacho"] . "\t";

            $factor = $row["ca_despacho"] / $row["ca_cantidad_tot"];
            $sub_can+=$row["ca_despacho"];
            $sub_pro+=round($row["ca_ingresos_prop"] * $factor, 0);
            $sub_ter+=round($row["ca_ingresos_terc"] * $factor, 0);

            $salida.= round($row["ca_ingresos_prop"] * $factor, 0) . "\t";
            $salida.= round($row["ca_ingresos_terc"] * $factor, 0) . "\t";
            $salida.= $row["ca_unidad"] . "\t";
            $salida.= "\r\n";
            $imp_tot = true;

            $gincomex = Doctrine::getTable("Gincomex")
                            ->createQuery("c")
                            ->where("c.ca_orden = ?", $row["ca_orden"])
                            ->fetchOne();

            $gincomex->setCaFchreportado(date("d M Y H:i:s"));
            $gincomex->setCaUsureportado($this->getUser()->getUserId());
            $gincomex->save();
        }

        $salida.= "\t\t\t";
        $salida.= "Sub total :\t";
        $salida.= $sub_can . "\t";
        $salida.= $sub_pro . "\t";
        $salida.= $sub_ter . "\t";
        $salida.= "\t\r\n";

        $tot_can+= $sub_can;
        $tot_pro+= $sub_pro;
        $tot_ter+= $sub_ter;

        $salida.= "\t\t\t";
        $salida.= "Total :\t";
        $salida.= $tot_can . "\t";
        $salida.= $tot_pro . "\t";
        $salida.= $tot_ter . "\t";
        $salida.= "\t\r\n";

        $filename = $directory . DIRECTORY_SEPARATOR . 'FAC' . date('YmdHis') . '.txt';
        $handle = fopen($filename, 'w');

        if (fwrite($handle, $salida) === FALSE) {
            echo "No se puede escribir al archivo {filename}";
            exit;
        }
        $this->redirect("gincomex/list");
    }

}

?>
