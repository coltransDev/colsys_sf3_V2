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
class IntegracionSoap {

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
     * @param int $companyIdSap
     * @param string $nit
     * @param string $tipo
     * @param string $json
     * @return array string
     */
    public function tipoSolicitud($companyIdSap, $nit, $tipo, $json) {

        $empresa = Doctrine::getTable("Empresa")->findOneBy("ca_idsap", $companyIdSap);
        $company = $empresa->getCaIdempresa();

        $params = array("nit" => $nit);
        $auth = $this->authenticate($params);

        if ($auth) {
            try {
                $data = json_decode($json);
                $idregistro = $companyIdSap.$data->IdRegistro;
                
                if($idregistro)                
                    $transaccion = Doctrine::getTable("IntTransaccionesIn")->findBy("ca_idregistro", $idregistro)->getFirst();
                
                if(!$transaccion){
                    $transaccion = new IntTransaccionesIn();
                    $transaccion->setCaTipo($tipo);
                    $transaccion->setCaCompania($companyIdSap);
                    $transaccion->setCaNit($nit);
                    $transaccion->setCaDatos($json);
                    $transaccion->setCaEstado(0); // En proceso
                    $transaccion->setCaIdregistro($idregistro);
                    $transaccion->setCaFchenvio(date("Y-m-d H:i:s"));
                    $transaccion->setCaUsucreado("Administrador");
                    $transaccion->setCaFchcreado(date("Y-m-d H:i:s"));
                    $transaccion->stopBlaming();
                    $transaccion->save();
                }else{
                    $transaccion->setCaDatos($json);
                    $transaccion->setCaFchenvio(date("Y-m-d H:i:s"));
                    $transaccion->save();
                }

                $idtransaccion = $transaccion->getCaIdtransaccion();

                switch ($tipo) {
                    case "1": // Factura Compra
                        $result = $this->facturasCompra($company, $json, $transaccion);
                        break;
                    case "2": // Cancelación de comprobantes
                        $result = $this->cancelacionComprobantes($company, $json, $transaccion);
                        break;
                    case "3": // Pagos Recibidos
                        $result = $this->pagosRecibidos($company, $json, $transaccion);
                        break;
                    case "4": // Activacion cliente
                        $result = $this->activacionCliente($company, $json, $transaccion);
                        break;
                    case "5": // Activacion conceptos
                        $result = $this->activacionConcepto($company, $json, $transaccion);
                        break;
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
     * facturasCompra method
     *     
     * @param int $company     
     * @param string $json
     * @param string $transaccion
     * @return array string
     */
    private function facturasCompra($company, $json, $transaccion) {

        $data = json_decode(utf8_decode($json));

        $codigo = $data->CodigoDoc;
        $serie = $data->SerieCode;
        $nrodocumento = $data->DocNum;
        $docentry = $data->DocEntry;
        $fchcomprobante = $data->TaxDate;
        $observaciones = $data->Comments;
        $fchcreado = $data->DocDate;
        $usucreado = $data->UsuCreado;
        $tcambio = $data->DocRate;
        $idmoneda = $data->DocCur;
        $vlrfactura = $data->VlrNeto;
        $vlrimpuestos = $data->VlrImpuestos;

        $nit = $data->NIT;

        $detalles = $data->Lineas;
        $mensajeError = "";

        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();

        try {
            if($nrodocumento !== ""){
                $ids = Doctrine::getTable("Ids")->findOneBy('ca_idalterno', array($nit));
                if (!$ids) {
                    $estado = 0;
                    $mensaje = 'No se encuentra el socio de negocio con id:'.$nit.', en nuestra base de datos!';
                    $success = "false";
                } else {
                    $tipoComprobante = Doctrine::getTable("InoTipoComprobante")->findByDql('ca_idempresa = ? AND ca_prefijo_sap = ? AND ca_comprobante = ?', array($company, $codigo, $serie))->getFirst();
                    if ($tipoComprobante) {
                        $comprobante = Doctrine::getTable("InoComprobante")->findByDql('ca_idtipo = ? AND ca_consecutivo = ? and ca_id = ? AND ca_usuanulado IS NULL', array($tipoComprobante->getCaIdtipo(), $nrodocumento, $ids->getCaId()))->getFirst();
                        if (!$comprobante) {
                            $comprobante = new InoComprobante();
                            $comprobante->setCaIdtipo($tipoComprobante->getCaIdtipo());
                            $comprobante->setCaConsecutivo($nrodocumento);
                            $comprobante->setCaFchcomprobante($fchcomprobante);
                            $comprobante->setCaId($ids->getCaId());
                            $comprobante->setCaObservaciones($observaciones . '| Idtransaccion=' . $transaccion->getCaIdtransaccion());
                            $comprobante->setCaTcambio($tcambio);
                            $comprobante->setCaEstado(5);
                            $comprobante->setCaIdmoneda($idmoneda);
                            $comprobante->setCaValor($vlrfactura);
                            $comprobante->setCaValor2($vlrfactura + $vlrimpuestos);                            
                            $comprobante->setCaUsucreado("sap");
                            $comprobante->setCaFchcreado(date("Y-m-d H:i:s"));
                            $comprobante->setCaDocentry($docentry);
                            $comprobante->stopBlaming();
                            $comprobante->save($conn);
                            $contador = 0;

                            foreach ($detalles as $dt) {
                                $inoMaster = Doctrine::getTable("InoMaster")->findOneBy("ca_referencia", $dt->PrjCode);
                                if (!$inoMaster) {
                                    $estado = 0;
                                    $mensajeError.= utf8_encode("No se encuentra la referencia: ".$dt->PrjCode."| ");
                                    $reenvio = "n";
                                    $success = "false";                                    
                                } else {
                                    if($inoMaster->getCaFchliquidado() == "" || $inoMaster->getCaFchliquidado() == null){

                                        $inodetalleF = new InoDetalle();
                                        $inodetalleF->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                                        $inodetalleF->setCaIdconcepto($dt->ItemCode);
                                        $inodetalleF->setCaIdmaster($inoMaster->getCaIdmaster());
                                        $inodetalleF->setCaId($comprobante->getCaId());
                                        $inodetalleF->setCaDb($codigo == "RC" ?$dt->VlrArticulo:0);
                                        $inodetalleF->setCaCr($codigo == "RC" ?0:$dt->VlrArticulo);
                                        $inodetalleF->setCaUsucreado("sap");
                                        $inodetalleF->setCaFchcreado(date("Y-m-d H:i:s"));
                                        $inodetalleF->stopBlaming();
                                        $inodetalleF->save($conn);

                                        $costo = new InoCosto();
                                        $costo->setCaIdmaster($inoMaster->getCaIdmaster());
                                        $costo->setCaIdcosto($dt->ItemCode);
                                        $costo->setCaFactura($comprobante->getCaConsecutivo());
                                        $costo->setCaFchfactura($comprobante->getCaFchcomprobante());
                                        $costo->setCaIdproveedor($comprobante->getCaId());
                                        $costo->setCaIdmoneda($comprobante->getCaIdmoneda());
                                        $costo->setCaTcambio($comprobante->getCaTcambio());
                                        $costo->setCaTcambioUsd(1);
                                        $costo->setCaNeto($codigo == "RC" ? $dt->VlrArticulo * -1 : $dt->VlrArticulo);
                                        $costo->setCaVenta($codigo == "RC" ? $dt->VlrArticulo * -1 * $comprobante->getCaTcambio() : $dt->VlrArticulo * $comprobante->getCaTcambio());
                                        $costo->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                                        $costo->setCaUsucreado("sap");
                                        $costo->setCaFchcreado(date("Y-m-d H:i:s"));
                                        $costo->stopBlaming();
                                        $costo->save($conn);

                                        $contador++;
                                    
                                    }else{                                        
                                        $mensajeError.= 'La referencia:' . $inoMaster->getCaReferencia() . ', ya se encuentra liquidada. Se debe abrir para registrar el comprobante.| ';
                                    }
                                }
                            }
                            /*Ticket 69466: Comprobante de ingreso ficticio para NC proveedores nacionales*/
                            if(strtolower($observaciones) == strtolower("ingreso") && $codigo == "RC"){
                                
                                if($comprobante->getInoTipoComprobante()->getCaIdempresa()=="2" || $comprobante->getInoTipoComprobante()->getCaIdempresa()=="8" ){
                                    
                                    $detalles= $comprobante->getInoDetalle();
                                    
                                    $data= array();                                        
                                    foreach($detalles as $d){
                                        $valor="0";
                                        $data[$d["ca_idmaster"]]["valor"]+=$valor;
                                        $data[$d["ca_idmaster"]]["concepto"]+=$d["ca_idconcepto"];
                                    }

                                    foreach($data as $ref=>$d){
                                        $house = Doctrine::getTable("InoHouse")->findBy("ca_idmaster",$ref)->getFirst();
                                        $comprobanteIngreso = new InoComprobante();
                                        $comprobanteIngreso->setCaIdtipo(98);
                                        $comprobanteIngreso->setCaConsecutivo("C-".$nrodocumento);
                                        $comprobanteIngreso->setCaFchcomprobante($fchcomprobante);
                                        $comprobanteIngreso->setCaId($ids->getCaId());
                                        $comprobanteIngreso->setCaObservaciones("Generado Automaticamente desde la NC ".$comprobante->getCaConsecutivo()."-".$comprobante->getCaIdmaster()." : ".$d["concepto"]);
                                        $comprobanteIngreso->setCaTcambio($tcambio);
                                        $comprobanteIngreso->setCaEstado(5);
                                        $comprobanteIngreso->setCaIdmoneda($idmoneda);
                                        $comprobanteIngreso->setCaValor(0);
                                        $comprobanteIngreso->setCaValor2(0);
                                        $comprobanteIngreso->setCaIdsucursal($comprobante->getCaIdsucursal());                                    
                                        $comprobanteIngreso->setCaFchgenero(date("Y-m-d H:i:s"));
                                        $comprobanteIngreso->setCaIdcomprobanteCruce($comprobante->getCaIdcomprobante());
                                        $comprobanteIngreso->setCaIdmaster($ref);
                                        $comprobanteIngreso->setCaIdhouse($house->getCaIdhouse());
                                        $comprobanteIngreso->setCaUsucreado("sap");
                                        $comprobanteIngreso->setCaFchcreado(date("Y-m-d H:i:s"));
                                        $comprobanteIngreso->setCaDocentry(null);
                                        $comprobanteIngreso->stopBlaming();
                                        $comprobanteIngreso->save($conn);
                                    }
                                }
                            }
                            
                            if($contador > 0){
                                $estado = 1;
                                $mensaje = 'El comprobante se ha creado satisfactoriamente! '.$mensajeError;
                                $reenvio = "n";
                                $success = true;
                            }else{
                                $estado = 0;
                                $mensaje = "Referencias no existen o estan liquidadas. ".$mensajeError;
                                $reenvio = "n";
                                $success = false;
                            }
                        } else {
                            $estado = 0;
                            $mensaje = 'El comprobante ya existe! Id comprobante: '. $comprobante->getCaIdcomprobante().'Id Tipo C:'. $tipoComprobante->getCaIdtipo().' Nro Doc:'. $nrodocumento.'-Id cliente:'. $ids->getCaId();
                            $reenvio = "n";
                            $success = "false";
                        }
                    } else {
                        $estado = 0;
                        $mensaje = 'El tipo de comprobante no existe! Compania=>' . $company . " Codigo=>" . $codigo . " Serie=>" . $serie;
                        $reenvio = "s";
                        $success = false;
                    }
                }
            }else{
                $estado = 0;
                $mensaje = 'El DocNum ha llegado vacio o no se ha podido codificar. DocNum:'.$nrodocumento;
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

        $respuesta = array("success:" => $success, "mensaje:" => utf8_encode($mensaje), "reenvio:" => $reenvio);

        $transaccion->setCaEstado($estado);
        $transaccion->setRespuesta(stripslashes(json_encode($respuesta)));
        $transaccion->save();

        $this->responseArray = $respuesta;
        
        return $this->responseArray;
    }

    /**
     * pagosRecibidos method
     *     
     * @param int $company     
     * @param string $json
     * @param string $transaccion
     * @return array string
     */
    private function pagosRecibidos($company, $json, $transaccion) {

        $data = json_decode($json);

        $referencia = $data->PrjCode;
        $nit = $data->NIT;
        $codigo = $data->CodigoDoc;
        $serie = $data->SerieCode;
        $nrodocumento = $data->DocNum;
        $docentry = $data->DocEntry;
        $docentrycruce = $data->DocEntryCruce;
        $valor = $data->VlrNeto;
        $fchcomprobante = $data->TaxDate;
        $tcambio = $data->DocRate;
        $idmoneda = $data->DocCur;
        $usucreado = $data->UsuCreado;
        $observaciones = $data->Comments;

        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = Doctrine::getTable("Ids")->findOneBy('ca_idalterno', array($nit));
            if ($ids) {
                if($serie){
                    $tipoComprobante = Doctrine::getTable("InoTipoComprobante")->findByDql('ca_idempresa = ? AND ca_prefijo_sap = ? AND ca_comprobante = ? AND ca_activo = ? AND ca_aplicacion = ?', array($company, $codigo, $serie, TRUE, 1))->getFirst();
                    if ($tipoComprobante) {
                        if ($docentrycruce) {
                            $docCruce = Doctrine::getTable("InoComprobante")
                                    ->createQuery("c")
                                    ->innerJoin("c.InoTipoComprobante tc")
                                    ->where("c.ca_docentry = ?", $docentrycruce)
                                    ->addWhere("tc.ca_idempresa = ?", $company)
                                    ->addWhere("tc.ca_tipo = 'F'")                                    
                                    ->fetchOne();

                            if ($docCruce) {
                                $validarReferencia = Doctrine::getTable("InoViComprobante")->findByDql("ca_referencia = ? AND ca_idcomprobante = ?", array($referencia, $docCruce->getCaIdcomprobante()))->getFirst();
                                if ($validarReferencia) {
                                    $comprobante = Doctrine::getTable("InoComprobante")->findByDql('ca_idtipo = ? AND ca_consecutivo = ? and ca_id = ?', array($tipoComprobante->getCaIdtipo(), $nrodocumento, $ids->getCaId()))->getFirst();                                    
                                    if (!$comprobante) {
                                        $comprobante = new InoComprobante();
                                        $comprobante->setCaIdtipo($tipoComprobante->getCaIdtipo());
                                        $comprobante->setCaConsecutivo($nrodocumento);
                                        $comprobante->setCaFchcomprobante($fchcomprobante);
                                        $comprobante->setCaId($ids->getCaId());
                                        $comprobante->setCaObservaciones($observaciones . "| Idtransaccion=" . $transaccion->getCaIdtransaccion());
                                        $comprobante->setCaTcambio($tcambio);
                                        $comprobante->setCaEstado("5");
                                        $comprobante->setCaIdmoneda($idmoneda);
                                        $comprobante->setCaValor($valor);
                                        $comprobante->setCaValor2($valor);                                    
                                        $comprobante->setCaUsucreado("sap");
                                        $comprobante->setCaFchcreado(date("Y-m-d H:i:s"));
                                        $comprobante->setCaDocentry($docentry);
                                        $comprobante->stopBlaming();
                                        $comprobante->save($conn);
                                    }

                                    $docCruce->setCaObservaciones($docCruce->getCaObservaciones()."|".$observaciones . "| IdtransaccionPR=" . $transaccion->getCaIdtransaccion());
                                    $docCruce->setCaIdcomprobanteCruce($comprobante->getCaIdcomprobante());
                                    $docCruce->setCaUsuactualizado("sap");
                                    $docCruce->setCaFchactualizado(date("Y-m-d H:i:s"));
                                    $docCruce->stopBlaming();
                                    $docCruce->save($conn);

                                    $estado = 1;
                                    $mensaje = 'El PAGO RECIBIDO se ha creado satisfactoriamente. Idcomprobante:'.$comprobante->getCaIdcomprobante().' IdcompCruce:'.$docCruce->getCaIdcomprobante();
                                    $reenvio = "n";
                                    $success = true;

                                } else {
                                    $estado = 0;
                                    $mensaje = 'El documento cruce no corresponde a la referencia asociada. DocEntryCruce:'.$docentrycruce.' Ref.:'.$referencia;
                                    $reenvio = "s";
                                    $success = false;
                                }
                            } else {
                                $estado = 0;
                                $mensaje = 'El docentrycruce enviado no se encuentra en nuestra base de datos:'.$docentrycruce;
                                $reenvio = "s";
                                $success = false;
                            }
                        } elseif ($tipoComprobante->getCaPrefijoSap() == "RA") { // Es Anticipo
                            if ($referencia != "") {
                                $master = Doctrine::getTable("InoMaster")->findBy("ca_referencia", $referencia)->getFirst();

                                if ($master) {

                                    $pago = new InoComprobante();
                                    $pago->setCaIdtipo($tipoComprobante->getCaIdtipo());
                                    $pago->setCaConsecutivo($nrodocumento);
                                    $pago->setCaFchcomprobante($fchcomprobante);
                                    $pago->setCaId($ids->getCaId());
                                    $pago->setCaObservaciones($observaciones . "| IdtransaccionRA=" . $transaccion->getCaIdtransaccion());
                                    $pago->setCaTcambio($tcambio);
                                    $pago->setCaEstado("5");
                                    $pago->setCaIdmoneda($idmoneda);
                                    $pago->setCaValor($valor);
                                    $pago->setCaValor2($valor);                                    
                                    $pago->setCaUsucreado("sap");
                                    $pago->setCaFchcreado(date("Y-m-d H:i:s"));
                                    $pago->setCaIdmaster($master->getCaIdmaster());
                                    $pago->setCaDocentry($docentry);
                                    $pago->stopBlaming();
                                    $pago->save($conn);

                                    $estado = 1;
                                    $mensaje = 'El comprobante de anticipo se ha creado satisfactoriamente. Idcomprobante:'.$pago->getCaIdcomprobante();
                                    $reenvio = "n";
                                    $success = true;
                                } else {
                                    $estado = 0;
                                    $mensaje = 'La referencia no existe . Ref.:'.$referencia;
                                    $reenvio = "s";
                                    $success = false;
                                }
                            } else {
                                $estado = 0;
                                $mensaje = 'Se debe enviar un numero de referencia valido. Ref.:'.$referencia;
                                $reenvio = "n";
                                $success = false;
                            }
                        }                       
                    } else {
                        $estado = 0;
                        $mensaje = 'El tipo de comprobante no existe!..'.$nit;
                        $reenvio = "s";
                        $success = false;
                    }
                }else{
                    $estado = 0;
                    $mensaje = 'La serie no existe. No se puede identificar el tipo de comprobante! DocEntryCruce:'.$docentrycruce;
                    $reenvio = "s";
                    $success = false;
                }
            } else {
                $estado = 0;
                $mensaje = 'No se encuentra el socio de negocio en nuestra base de datos. Nit.:'.$nit;
                $reenvio = "s";
                $success = false;
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            $estado = 0;
            $mensaje = "errorInfo: " . $e->getMessage();
            $reenvio = "s";
            $success = false;
        }

        $respuesta = array("success:" => $success, "mensaje:" => utf8_encode($mensaje), "reenvio:" => $reenvio);

        $transaccion->setCaEstado($estado);
        $transaccion->setRespuesta(stripslashes(json_encode($respuesta)));
        $transaccion->save();

        $this->responseArray = $respuesta;
        return $this->responseArray;
    }

    /**
     * cancelacionComprobantes method
     *     
     * @param int $company     
     * @param string $json
     * @param string $transaccion
     * @return array string
     */
    private function cancelacionComprobantes($company, $json, $transaccion) {
        $data = json_decode(utf8_encode($json));
        $docentry = $data->DocEntry;
        $idtipo = $data->CodigoDoc;
        $fchanulado = $data->TaxDate;
        $usuanulado = $data->UsuCreado;
        $observaciones = $data->Comments;
        
        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        $conn->beginTransaction();

        try {
            
            $comprobante = Doctrine::getTable("InoComprobante")
                ->createQuery("c")
                ->innerJoin("c.InoTipoComprobante tc")
                ->where("tc.ca_prefijo_sap = ? AND c.ca_docentry = ? AND tc.ca_idempresa = ?", array($idtipo, $docentry, $company))
                ->fetchOne();
            
            if($comprobante){                
                $anular = $comprobante->anular("sap",$observaciones,null, "sap");                
                $observaciones = $comprobante->eliminarVinculados($usuanulado,$observaciones,null, "sap");                
                
                if($anular === true){
                    $conn->commit();
                    $estado = 1;
                    $mensaje = 'El comprobante se ha anulado satisfactoriamente! Idcomprobante=>'. $comprobante->getCaIdcomprobante()." Observaciones: ".$observaciones;
                    $reenvio = "n";
                    $success = true;
                }else{
                    $estado = 0;
                    $mensaje = "Desde SAP. El comprobante no se puede anular, porque la referencia esta bloqueada";
                    $reenvio = "s";
                    $success = false;
                }
            }else{
                $conn->rollback();
                $estado = 0;
                $mensaje = 'El comprobante no existe. Docentry: '.$docentry." Compania: ".$company;
                $reenvio = "s";
                $success = false;
            }
        }catch(Exception $e){
            $conn->rollback();
            $estado = 0;
            $mensaje = "errorInfo: " . $e->getMessage();
            $reenvio = "s";
            $success = false;
            
        }
        
        $respuesta = array("success:" => $success, "mensaje:" => utf8_encode($mensaje), "reenvio:" => $reenvio);

        $transaccion->setCaEstado($estado);
        $transaccion->setRespuesta(stripslashes(json_encode($respuesta)));
        $transaccion->save();

        $this->responseArray = $respuesta;
        return $this->responseArray;
        
        
        return array("error");

    }

    /**
     * activacionCliente method
     *     
     * @param int $company     
     * @param string $json
     * @param string $transaccion
     * @return array string
     */
    private function activacionCliente($company, $json, $transaccion) {
        $data = json_decode($json);

        $idalterno = $data->CardCode;
        $tipo = $data->CardType;
        $grupoIds = $data->GroupCode;
        $fechaActivacion = $data->TaxDate;
        $usuarioActivacion = $data->UsuarioCreado;

        switch($grupoIds){
            case "145": // Agente
                $tipoIds = "A";
                break;
            case "144": // Empleados
                $tipoIds = "E";
                break;
            case "2": // Clientes
                $tipoIds = "C";
                break;
            default: // Proveedor
                $tipoIds = "P";
                break;
        }

        $conn = Doctrine::getTable("Ids")->getConnection();
        $conn->beginTransaction();

        try {

            $ids = Doctrine::getTable("Ids")->findOneBy('ca_idalterno' ,array($idalterno));
            if(!$ids){                
                $estado = 0;
                $mensaje = 'No se encontro el socio de negocio en nuestra base de datos!';
                $success = "false";
            } else {                
                $idsEstado = Doctrine::getTable("IdsEstadoSap")->find(array($ids->getCaId(),$tipoIds,$company));                

                if (!$idsEstado) {
                    $idsEstado = new IdsEstadoSap();
                    $idsEstado->setCaId($ids->getCaId());
                    $idsEstado->setCaTipo($tipoIds);
                    $idsEstado->setCaIdempresa($company);
                    $idsEstado->setCaUsucreado("sap");
                    $idsEstado->setCaFchcreado(date("Y-m-d H:i:s"));
                }

                $idsEstado->setCaActivo(true);
                $idsEstado->setCaFchsap($fechaActivacion);
                $idsEstado->setCaUsusap($usuarioActivacion);
                $idsEstado->stopBlaming();
                $idsEstado->save($conn);

                $mensaje = 'El socio de negocio con Id:'.$idsEstado->getCaId().' tipo '.$tipoIds.' se activo correctamente! IdempresaColsys=>'. $company;
                $estado = 1;
                $reenvio = "n";
                $success = true;

                $conn->commit();
            }
        } catch (Exception $e) {
            $conn->rollback();
            $estado = 0;
            $mensaje = "errorInfo: " . $e->getMessage();
            $reenvio = "s";
            $success = false;
        }

        $respuesta = array("success:" => $success, "mensaje:" => utf8_encode($mensaje), "reenvio:" => $reenvio);

        $transaccion->setCaEstado($estado);
        $transaccion->setRespuesta(stripslashes(json_encode($respuesta)));
        $transaccion->save();

        $this->responseArray = $respuesta;

        return $this->responseArray;
    }

    /**
     * activacionConcepto method
     *     
     * @param int $company     
     * @param string $json
     * @param string $transaccion
     * @return array string
     */
    private function activacionConcepto($company, $json, $transaccion) {
        $data = json_decode($json);

        $iditem = $data->ItemCode;
        $fechaActivacion = $data->Fecha;
        $usuarioActivacion = $data->UsuarioCreado;


        $conn = Doctrine::getTable("InoMaestraConceptos")->getConnection();
        $conn->beginTransaction();

        try {

            $inoConcepto = Doctrine::getTable("InoMaestraConceptos")->findByDql('ca_idconcepto = ? ', array($iditem))->getFirst();

            if ($inoConcepto) {
                
                $estadoConceptos = Doctrine::getTable("InoEstadosConceptosSap")->findByDql('ca_idconcepto = ? AND ca_idempresa = ?', array($iditem, $company))->getFirst();
                
                if(count($estadoConceptos)>1){
                    $estadoConceptos->setCaActivo(true);
                }else{
                    $estadoConceptos =  new InoEstadosConceptosSap();
                    $estadoConceptos->setCaIdconcepto($iditem);
                    $estadoConceptos->setCaIdempresa($company);
                    $estadoConceptos->setCaActivo(true);
                }
                
                $estadoConceptos->setCaUsusap($usuarioActivacion);
                $estadoConceptos->setCaFchsap($fechaActivacion);
                $estadoConceptos->setCaUsucreado($usuarioActivacion);
                $estadoConceptos->setCaFchcreado($fechaActivacion);
                $estadoConceptos->stopBlaming();
                $estadoConceptos->save($conn);

                $mensaje = 'El concepto se activo correctamente!. Idconcepto=>'. $estadoConceptos->getCaIdconcepto();
                $estado = 1;
                $reenvio = "n";
                $success = true;
                
                $conn->commit();
            } else {
                $mensaje = 'El concepto no existe!';
                $estado = 0;
                $reenvio = "s";
                $success = true;
            }
            
        } catch (Exception $e) {
            $conn->rollback();
            $estado = 0;
            $mensaje = "errorInfo: " . $e->getMessage();
            $reenvio = "s";
            $success = false;
        }

        $respuesta = array("success:" => $success, "mensaje:" => utf8_encode($mensaje), "reenvio:" => $reenvio);

        $transaccion->setCaEstado($estado);
        $transaccion->setRespuesta(stripslashes(json_encode($respuesta)));
        $transaccion->save();


        $this->responseArray = $respuesta;

        return $this->responseArray;
    }
}
?>