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
//                switch ($tipo) {
//                    case "1": // Factura Compra
//                        $result = $this->facturasCompra($company, $json, $transaccion);
//                        break;
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
//                }
                $result = '{"json":"ok"}';
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
}
?>