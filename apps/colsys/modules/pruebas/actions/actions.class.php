<?php

/** * pruebas actions.
 *
 * @package    colsys
 * @subpackage pruebas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pruebasActions extends sfActions {

    public function executeEncoding() {
        //$sql =  "SET NAMES  'LATIN1'";
        $sql = "SHOW CLIENT_ENCODING";

        $con = Propel::getConnection(EmailPeer::DATABASE_NAME);

        $stmt = $con->prepareStatement($sql);
        $rs = $stmt->executeQuery();
        $rs->next();
        echo $rs->getString('client_encoding');

        /*
         * ciudad = new Ciudad();
         * ciudad->setCaCiudad( "ASD" );
         * ciudad->setCaIdTrafico("99-999");
         * ciudad->setCaIdCiudad("pruebá");
         * ciudad->setCaPuerto("pruebá");
         * ciudad->save(); */
        print_r($this->getRequestParameter("asd"));
        $ciudad = CiudadPeer::retrieveByPk("pruebá");
        $ciudad->setCaPuerto($this->getRequestParameter("asd"));
        //$ciudad->setCaPuerto( utf8_encode("pruebá"));
        //$ciudad->save();
        //print_r( Utils::replace($ciudad->getCaIdCiudad()) );
    }

    public function executeSendEmail() {
        //exit("detenido");
        set_time_limit(0);
        $c = new Criteria ( );
        /* $c->add ( EmailPeer::CA_FCHENVIO, "2009-07-15 13:10:01", Criteria::GREATER_THAN );
         * c->addAnd ( EmailPeer::CA_FCHENVIO, "2009-07-15 17:50:01", Criteria::LESS_THAN );
         * c->add( EmailPeer::CA_TIPO,  'Envío de Status'); */

        //$c->add(  EmailPeer::CA_ADDRESS, "%bsnmedical%", Criteria::NOT_LIKE  );
        //$c->addAnd(  EmailPeer::CA_ADDRESS, "%willard%", Criteria::NOT_LIKE  );
        //$c->addAnd ( EmailPeer::CA_FCHENVIO, "2009-03-26 14:50:00", Criteria::LESS_THAN );
        //$c->add(EmailPeer::CA_TIPO, "Envío de Avisos" );
        //$c->addOr(EmailPeer::CA_TIPO, "Envío de Status" );

        $c->add(EmailPeer::CA_IDEMAIL, 265437);
        /* $c->addOr( EmailPeer::CA_IDEMAIL, 240610);
         * c->addOr( EmailPeer::CA_IDEMAIL, 240656); */
        //$c->add(  EmailPeer::CA_FCHENVIO , null, Criteria::ISNULL );
        $c->addAscendingOrderByColumn(EmailPeer::CA_FCHENVIO);
        $c->setLimit(5);

        $i = 0;
        $emails = EmailPeer::doSelect($c);




        foreach ($emails as $email) {
            //print_r( $email);
            echo "<b>Enviando " . $i++ . "</b>	emailid: " . $email->getCaIdEmail() . " Fch: " . $email->getCaFchEnvio() . " <br />From: " . $email->getCaFrom() . "<br />";

            /* $addresses = explode(",",$email->getCaAddress());
             * oreach( $addresses as $key=>$address ){
             * f( strpos( $address, "coltrans.com.co" )!=false ){
             * nset( $addresses[$key] );
             }
             }
             * email->setCaAddress( implode(",", $addresses) );
             */

            /* $ccs = explode(",",$email->getCaCC());
             * oreach( $ccs as $key=>$address ){
             * f( strpos( $address, "coltrans.com.co" )!=false ){
             * nset( $addresses[$key] );
             }
             }
             * email->setCaCc( implode(",", $ccs) );
             */


            echo "To: " . $email->getCaAddress() . "<br />";
            echo "CC: " . $email->getCaCC() . "<br />";
            echo "Subject" . $email->getCaSubject() . "<br />";

            if (!$email->getCaBodyHtml()) {
                /* "Este mensaje se reenvia por problemas de visualizacion en env&acute;os anteriores <br />Si usted ya lo recibi&oacute; por favor haga caso omiso de este mensaje<br /><br />". */
                $email->setCaBodyHtml($email->getCaBody());
                $email->setCaBody("");
            }


            echo $email->send() ? "OK" : "NO" . "<br /><br />";
        }

        return sfView::NONE;
    }

    public function executeSendStatus() {
        exit("detenido");
        //esto no sirve
        $status = RepStatusPeer::retrieveByPk(158756);
        $status->send();
    }

    public function executeCambiaTipoStatus() {
        $c = new Criteria ( );
        $avisos = RepAvisoPeer::doSelect($c);

        foreach ($avisos as $aviso) {
            $email = EmailPeer::retrieveByPk($aviso->getcaIdEmail());
            if ($email) {
                echo $email->getCatipo();
                $aviso->setCaTipo($email->getCatipo());
                $aviso->save();
            }
        }
        return sfView::NONE;
    }

    public function executeActualizarEstadoReportes() {
        set_time_limit(0);
        $c = new Criteria ( );
        $c->add(ReportePeer::CA_FCHDESPACHO, "2008-04-01", Criteria::GREATER_EQUAL);
        $c->add(ReportePeer::CA_IMPOEXPO, "Importación");
        $c->add(ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada", Criteria::NOT_EQUAL);
        $c->add(ReportePeer::CA_TRANSPORTE, "Marítimo");
        $c->addAscendingOrderByColumn(ReportePeer::CA_FCHREPORTE);
        $reportes = ReportePeer::doSelect($c);
        set_time_limit(0);
        foreach ($reportes as $reporte) {
            $inoclientesSea = $reporte->getInoClientesSea();
            if ($inoclientesSea) {
                $statusOTM = $inoclientesSea->getUltimoStatusOTM();
                if ($statusOTM) {
                    echo "otm<br>";
                    $reporte->setCaEtapaActual("Carga Entregada");
                    $reporte->save();
                } else {
                    $refSea = $inoclientesSea->getInoMaestraSea();
                    if ($refSea->getCaFchconfirmado()) {

                        if ($reporte->getCaContinuacion() != "N/A") {
                            echo "en transito terrestre <br>";
                            $reporte->setCaEtapaActual("Carga en Transito Terrestre");
                        } else {
                            echo "llego<br>";
                            $reporte->setCaEtapaActual("Carga Entregada");
                        }
                        $reporte->save();
                    }
                }
            }
        }
    }

    /*
     * Convertir avisos x status
     */

    public function executeCambiarAvisos() {
        set_time_limit(0);
        $c = new Criteria();
        //$c->setLimit(5000);
        $c->add(RepAvisoPeer::CA_FCHENVIO, "2008-01-01", Criteria::GREATER_EQUAL);
        $avisos = RepAvisoPeer::doSelect($c);
        foreach ($avisos as $aviso) {
            $status = new RepStatus();
            $status->setCaIdReporte($aviso->getCaIdReporte());
            $status->setCaIdEmail($aviso->getCaIdEmail());
            $status->setCafchsalida($aviso->getCafchsalida());
            $status->setCafchllegada($aviso->getCafchllegada());
            $status->setCafchcontinuacion($aviso->getCafchcontinuacion());
            $status->setCaPiezas($aviso->getCaPiezas());
            $status->setCaPeso($aviso->getCaPeso());
            $status->setCaVolumen($aviso->getCaVolumen());
            $status->setCaDoctransporte($aviso->getCaDoctransporte());
            $status->setCadocmaster($aviso->getCadocmaster());
            $status->setCaidnave($aviso->getCaidnave());
            $status->setCaComentarios($aviso->getCanotas());
            $status->setCaequipos($aviso->getCaequipos());
            $status->setCafchenvio($aviso->getCafchenvio("Y-m-d H:i:s"));
            $status->setCaUsuenvio($aviso->getCaUsuenvio());
            $status->setCaHoraSalida($aviso->getCaHoraSalida());
            $status->setCaEtapa("Carga Embarcada");
            $status->setCastatus($aviso->getStatus());
            $status->setCafchstatus($aviso->getCafchenvio("Y-m-d H:i:s"));
            $status->setCafchrecibo($aviso->getCafchenvio("Y-m-d H:i:s"));

            $status->save();
            $aviso->delete();
            echo $status->getCaIdReporte() . " " . $aviso->getStatus() . "<br /><br />";
        }
    }

    /*
     * in comentarios
     */

    public function executeCorregirAvisosAereo() {
        $c = new Criteria();
        $c->addJoin(RepStatusPeer::CA_IDEMAIL, EmailPeer::CA_IDEMAIL);
        $c->addJoin(RepStatusPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
        $c->add(EmailPeer::CA_TIPO, "Confirmación");
        $c->add(RepStatusPeer::CA_ETAPA, "Carga Embarcada");
        $c->add(ReportePeer::CA_TRANSPORTE, "Aéreo");
        set_time_limit(0);
        $statuss = RepStatusPeer::doSelect($c);
        foreach ($statuss as $status) {
            echo $status->getCaIdEmail() . "<br />";
            $status->setCaEtapa("Carga en Puerto de Destino");
            $status->save();
            $reporte = $status->getReporte();
            $reporte->setCaEtapaActual("Carga en Puerto de Destino");
            $reporte->save();
        }
    }

    /*
     * Analizar texto para colocar fecha de salida info reserva
     */

    public function executeFixReservas() {
        $c = new Criteria();
        $c->add(RepStatusPeer::CA_FCHENVIO, '2008-04-01', Criteria::GREATER_EQUAL);
        $c->add(RepStatusPeer::CA_FCHENVIO, '2008-06-30', Criteria::LESS_EQUAL);
        $c->add(RepStatusPeer::CA_STATUS, RepStatusPeer::CA_STATUS . " like '%reserva%'", Criteria::CUSTOM);
        $statuss = RepStatusPeer::doSelect($c);

        $i = 0;
        foreach ($statuss as $status) {


            //Ubica ETS
            if (!$status->getCaFchSalida()) {

                //

                $pos = strripos($status->getCaStatus(), "zarpe");
                if ($pos!==false) {
                    $diaStr = "";


                    if ($status->getCaIdEmail() == 13737) {
                        continue;
                    }

                    /*
                     * str = substr( $status->getCaStatus(), $pos+6, 30 );
                     * pos2 = stripos($str, "mayo");
                     * f( $pos2!==false ){
                     * mes = "05";
                     * diaStr = trim(substr($str, $pos2-6, 2));
                     * f($pos2>2 && is_numeric ( $diaStr )){
                     * f( strlen($diaStr)==1){
                     * diaStr="0".$diaStr;
                     }
                     * fechaSalida = "2008-".$mes."-".$diaStr;
                     * cho $status->getCaIdEmail()." ";
                     * cho $status->getCaStatus()."<br />";
                     * cho "<b>".$fechaSalida."</b><br /><br />";
                     * /$status->setCaFchSalida( $fechaSalida );
                     * /$status->save();
                     * i++;
                     * else{
                     * diaStr = trim(substr($str, $pos2+6, 2));
                     * f(is_numeric ( $diaStr )){
                     * f( strlen($diaStr)==1){
                     * diaStr="0".$diaStr;
                     }
                     * fechaSalida = "2008-".$mes."-".$diaStr;
                     * cho $status->getCaIdEmail()." ";
                     * cho $status->getCaStatus()."<br />";
                     * cho "<b> 2-> ".$fechaSalida."</b><br /><br />";
                     * /$status->setCaFchSalida( $fechaSalida );
                     * /$status->save();
                     * cho "<b>".$fechaSalida."</b><br /><br />";
                     * i++;
                     }
                     }
                     }
                     */
                    /* $pos2 = stripos($str, "junio");
                     * f( $pos2!==false ){
                     * mes = "06";
                     * diaStr = trim(substr($str, $pos2-6, 2));
                     * f($pos2>3 && is_numeric ( $diaStr )){
                     * cho $diaStr;
                     * f( strlen($diaStr)==1){
                     * diaStr="0".$diaStr;
                     }
                     * fechaSalida = "2008-".$mes."-".$diaStr;
                     * cho $status->getCaStatus()."<br />";
                     * cho "<b>".$fechaSalida."</b><br /><br />";
                     * status->setCaFchSalida( $fechaSalida );
                     * status->save();
                     * i++;
                     * else{
                     * diaStr = trim(substr($str, $pos2+6, 2));
                     * f(is_numeric ( $diaStr )){
                     * f( strlen($diaStr)==1){
                     * diaStr="0".$diaStr;
                     }
                     * fechaSalida = "2008-".$mes."-".$diaStr;
                     * /echo $status->getCaStatus()."<br />";
                     * cho "<b> 2-> ".$fechaSalida."</b><br /><br />";
                     * status->setCaFchSalida( $fechaSalida );
                     * status->save();
                     * cho "<b>".$fechaSalida."</b><br /><br />";
                     * i++;
                     }
                     }
                     }
                     */
                    /* $pos2 = stripos($str, "/");
                     * f( $pos2!==false ){
                     * cho $status->getCaStatus()."<br />";
                     * diaStr = trim(substr($str, $pos2-2, 2));
                     * mesStr = trim(substr($str, $pos2+1, 2));
                     * f( is_numeric ( $diaStr ) && is_numeric($mesStr) && $mesStr<=6 ){
                     * cho $diaStr;
                     * f( strlen($diaStr)==1){
                     * diaStr="0".$diaStr;
                     }
                     * f( strlen($mesStr)==1){
                     * mesStr="0".$mesStr;
                     }
                     * fechaSalida = "2008-".$mesStr."-".$diaStr;
                     * cho "<b>".$fechaSalida."</b><br /><br />";
                     * /$status->setCaFchSalida( $fechaSalida );
                     * /$status->save();
                     * i++;
                     }
                     } */
                }
            }
        }
        echo "->" . $i;
        return sfView::NONE;
    }

    public function executeDecodeFile() {
        $file = 'LTR0Qk4ybk1jcWMta0FiMngtVkVpMDcxU1VjWmJfcG05T05XWF91YW1qTmpia255b2ZLSUc0NHlZejU3eEpXaUx3MkJ3RGUzb1ZoQk8yT0hYaVVrZ080RXl0ZEVLeFF2eTAydTVCclRLNG5Bek5zVWxDMVNoNWIxUW9sRjc1dmdlV3ZmcGhoQnU1MDBSMFI0U3NHQzFSckpKa29RTGh0TXM5ZHhGQ2lnem5XRGVFeXFfWldPU25wVlNGNW9rQ3ZlMkl5aEoyT29vVk51RUotbEVFM21lX0VteVNYOWFHTHRHN1dZT1BMNFRjMDVhLVpycm1uMEZQNEFIcVRidFVVSUt6UEQzSXQtdHdNUDVFYVRNNUdINkVoQWZmbE9oMjdtMmdndjVwbldRVG8u';
        //header("Content-Type: application/octet-stream");
        //header("Content-Disposition: attachment; filename=archivo.tiff");
        echo base64_decode($file);
    }

    /*
     * Se pretende corregir un error donde se coloco el numero del consecutivo sin el año en el ino aereo
     */

    public function executeFixReportesAereo() {
        $c = new Criteria();
        //$c->setLimit(10);
        $c->add(InoClientesAirPeer::CA_IDREPORTE, NULL, Criteria::ISNOTNULL);
        $c->addAnd(InoClientesAirPeer::CA_IDREPORTE, "%-%", Criteria::NOT_LIKE);
        //$c->add(InoClientesAirPeer::CA_REFERENCIA, "%8", Criteria::LIKE );

        set_time_limit(0);
        $inoairs = InoClientesAirPeer::doSelect($c);

        foreach ($inoairs as $inoair) {
            echo $inoair->getCaReferencia() . " " . $inoair->getCaIdReporte();

            $c = new Criteria();
            $c->add(ReportePeer::CA_CONSECUTIVO, $inoair->getCaIdReporte() . "-%", Criteria::LIKE);
            $c->addJoin(ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO);
            $c->add(ContactoPeer::CA_IDCLIENTE, $inoair->getCaIdCliente());
            $reporte = reportePeer::doSelectOne($c);
            if ($reporte) {
                $inoair->setCaIdReporte($reporte->getCaConsecutivo());
                $inoair->save();
                echo "<b> OK</b>" . $reporte->getCaConsecutivo();
            } else {
                $c = new Criteria();
                $c->add(ReportePeer::CA_IDREPORTE, $inoair->getCaIdReporte());
                $c->addJoin(ReportePeer::CA_IDCONCLIENTE, ContactoPeer::CA_IDCONTACTO);
                $c->add(ContactoPeer::CA_IDCLIENTE, $inoair->getCaIdCliente());
                $reporte = reportePeer::doSelectOne($c);
                if ($reporte) {
                    $inoair->setCaIdReporte($reporte->getCaConsecutivo());
                    $inoair->save();
                    echo "<b> OK2</b> " . $reporte->getCaConsecutivo();
                } else {
                    $inoair->setCaIdReporte(null);
                    $inoair->save();
                }
            }



            echo "<br />";
        }
    }

    /*
     * Coloca el consecutivo de acuerdo a la fecha de creado
     */

    public function executeAsignarConsecutivoCotizaciones() {

        set_time_limit(0);

        $c = new Criteria();
        $c->add(CotizacionPeer::CA_CONSECUTIVO, null, Criteria::ISNULL);
        $c->addAscendingOrderByColumn(CotizacionPeer::CA_FCHCREADO);
        $cotizaciones = CotizacionPeer::doSelect($c);
        $c->setLimit(8000);
        foreach ($cotizaciones as $cotizacion) {
            $sig = CotizacionPeer::siguienteConsecutivo($cotizacion->getCaFchCreado("Y"));
            $cotizacion->setCaConsecutivo($sig);
            $cotizacion->save();
        }
    }

    /*
     * Importa el tarifario anterior dentro del nuevo taarifario
     */

    public function executeImportarTarifario() {
        sfConfig::set('sf_web_debug', false);

        $porBL = array("POR BL", "POR BL ", "Por B/l", "Por BL", "Por Bl");

        $porHbl = array("Por HBL");

        $porCtnr = array("POR CNTR", "POR CONTENEDOR", "Por contenedor", "Por contenedor", "Por Cntr");

        $porEmbarque = array("Por embarque", "Por embarque\n", "Por Embarque");

        $porTm3 = array("Por T/M3", "POR T/M3", "T/M3", "T/M3\n", "T/M3 ", "por T/M3", "POR T/M3",);


        $c = new Criteria();
        //$c->add( TrayectoPeer::CA_IDTRAYECTO, 1294, Criteria::NOT_EQUAL );
        //$c->addAnd( TrayectoPeer::CA_IDTRAYECTO, 1297, Criteria::NOT_EQUAL );
        /*
         * c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
         * c->add( TrayectoPeer::CA_TRANSPORTE , "Marítimo" );
         */

        /*
         * c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
         * c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" );
         */


        $c->add(TrayectoPeer::CA_IMPOEXPO, "Exportación");
        $c->add(TrayectoPeer::CA_TRANSPORTE, "Aéreo");




        //$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
        //$c->add( TrayectoPeer::CA_TRANSPORTE , "Marítimo" );
        //$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );
        //$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );
        //$c->add( TrayectoPeer::CA_MODALIDAD, "FCL" );
        //$c->add( TrayectoPeer::CA_IDTRAYECTO, 3705 );
        //$c->setLimit(30);
        $trayectos = TrayectoPeer::doSelect($c);
        set_time_limit(0);

        foreach ($trayectos as $trayecto) {
            if ($trayecto->getCaIdtarifas()!=$trayecto->getCaIdTrayecto()) {
                $trayecto2 = trayectoPeer::retrieveByPk($trayecto->getCaIdtarifas());

                $fletes = $trayecto2->getFletes();
            } else {
                $fletes = $trayecto->getFletes();
            }


            foreach ($fletes as $flete) {
                $pricflete = new PricFlete();
                $pricflete->setCaIdTrayecto($trayecto->getCaIdTrayecto());
                $pricflete->setCaIdConcepto($flete->getCaIdConcepto());
                $pricflete->setCaVlrneto($flete->getCaVlrneto());
                $pricflete->setCaVlrsugerido($flete->getCaVlrminimo());
                $pricflete->setCaFchinicio($flete->getCaFchinicio());
                $pricflete->setCaFchvencimiento($flete->getCaFchvencimiento());
                $pricflete->setCaIdmoneda($flete->getCaIdmoneda());
                if ($flete->getCaSugerida()=="*") {
                    $pricflete->setCaEstado(1);
                }
                if ($flete->getCaMantenimiento()=="*") {
                    $pricflete->setCaEstado(2);
                }
                $pricflete->save();
                //echo "asd1";
                if ($trayecto->getCaModalidad()=="LCL" && $flete->getCaFleteminimo() > 0 && ( $flete->getCaVlrminimo()!=$flete->getCaFleteminimo() || $flete->getCaFleteminimo()!=0 )) {
                    $pricflete = PricFletePeer::retrieveByPk($trayecto->getCaIdTrayecto(), 88);
                    if (!$pricflete) {
                        $pricflete = new PricFlete();
                        $pricflete->setCaIdTrayecto($trayecto->getCaIdTrayecto());
                        $pricflete->setCaIdConcepto(88);
                    }
                    $pricflete->setCaVlrneto($flete->getCaFleteminimo());
                    $pricflete->setCaVlrsugerido($flete->getCaFleteminimo());
                    $pricflete->setCaFchinicio($flete->getCaFchinicio());
                    $pricflete->setCaFchvencimiento($flete->getCaFchvencimiento());
                    $pricflete->setCaIdmoneda($flete->getCaIdmoneda());
                    if ($flete->getCaSugerida()=="*") {
                        $pricflete->setCaEstado(1);
                    }
                    if ($flete->getCaMantenimiento()=="*") {
                        $pricflete->setCaEstado(2);
                    }
                    $pricflete->save();
                    //echo "asd2";
                }

                //Importación de los recargos


                $c = new Criteria();
                //$c->setLimit(500);
                $c->add(RecargoFletePeer::CA_IDCONCEPTO, $flete->getCaIdConcepto());

                if ($trayecto->getCaIdtarifas()!=$trayecto->getCaIdTrayecto()) {
                    $c->add(RecargoFletePeer::CA_IDTRAYECTO, $trayecto2->getCaIdtrayecto());
                } else {
                    $c->add(RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto());
                }


                $recargos = RecargoFletePeer::doSelect($c);
                foreach ($recargos as $recargo) {

                    $pricrecargo = PricRecargoxConceptoPeer::retrieveByPk($trayecto->getCaIdtrayecto(), $recargo->getCaIdConcepto(), $recargo->getCaIdRecargo());
                    if (!$pricrecargo) {
                        $pricrecargo = new PricRecargoxConcepto();
                        $pricrecargo->setCaIdTrayecto($trayecto->getCaIdtrayecto());
                        $pricrecargo->setCaIdConcepto($recargo->getCaIdConcepto());
                        $pricrecargo->setCaIdRecargo($recargo->getCaIdRecargo());
                    }

                    if ($recargo->getCaVlrfijo()&& $recargo->getCaVlrfijo()!=0) {
                        $pricrecargo->setCaVlrrecargo($recargo->getCaVlrfijo());
                        //echo "-> fijo ".$recargo->getCaVlrfijo()."<br />";
                    } else {
                        if ($recargo->getCaPorcentaje() && $recargo->getCaPorcentaje()!=0) {
                            echo "-> % " . $recargo->getCaPorcentaje() . " " . $recargo->getCaBasePorcentaje() . "<br />";
                            $pricrecargo->setCaVlrrecargo($recargo->getCaPorcentaje());

                            //if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
                            $pricrecargo->setCaAplicacion('% Sobre Flete');
                            //}
                        } else {
                            echo "-> Unit " . $recargo->getCaVlrunitario() . " " . $recargo->getCaBaseunitario() . "<br />";
                            $pricrecargo->setCaVlrrecargo($recargo->getCaVlrunitario());

                            if ($recargo->getCaBaseunitario()=='Unidades Peso/Volumen') {
                                echo " OK <br />";
                                $pricrecargo->setCaAplicacion('x Kg ó 6 Dm³');
                            }

                            if ($recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs') {
                                //$trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );
                                if ($trayecto->getCaTransporte()=="Aéreo") {
                                    $pricrecargo->setCaAplicacion('x HAWB');
                                }
                                if ($trayecto->getCaTransporte()=="Marítimo") {
                                    $pricrecargo->setCaAplicacion('x HBL');
                                }
                            }

                            if ($recargo->getCaBaseunitario()=="Número de Piezas") {
                                $pricrecargo->setCaAplicacion("x Pieza");
                            }
                        }
                    }
                    $pricrecargo->setCaFchinicio($recargo->getCaFchinicio());
                    $pricrecargo->setCaFchvencimiento($recargo->getCaFchvencimiento());

                    $pricrecargo->setCaVlrminimo($recargo->getCaRecargominimo());
                    $pricrecargo->setCaIdmoneda($recargo->getCaIdmoneda());

                    if (in_array($recargo->getCaObservaciones(), $porHbl)) {
                        $pricrecargo->setCaAplicacionMin("x HBL");
                    } elseif (in_array($recargo->getCaObservaciones(), $porCtnr)) {
                        $pricrecargo->setCaAplicacionMin("x Contenedor");
                    } elseif (in_array($recargo->getCaObservaciones(), $porEmbarque)) {
                        $pricrecargo->setCaAplicacionMin("x Embarque");
                    } elseif (in_array($recargo->getCaObservaciones(), $porTm3)) {
                        $pricrecargo->setCaAplicacionMin("x T/M³");
                    } else {
                        $pricrecargo->setCaObservaciones($recargo->getCaObservaciones());
                    }

                    if ($recargo->getCaUsuActualizado()) {
                        $pricrecargo->setCaUsucreado($recargo->getCaUsuactualizado());
                        $pricrecargo->setCaFchcreado($recargo->getCaFchactualizado());
                    } elseif ($recargo->getCaUsucreado()) {
                        $pricrecargo->setCaUsucreado($recargo->getCaUsucreado());
                        $pricrecargo->setCaFchcreado($recargo->getCaFchcreado());
                    }

                    if (!$pricrecargo->getCaUsucreado()) {
                        $pricrecargo->setCaUsucreado("Administrador");
                    }

                    if (!$pricrecargo->getCaFchcreado()) {
                        $pricrecargo->setCaFchcreado(date("Y-m-d"));
                    }

                    $pricrecargo->save();
                }
                //----------------------
            }


            // Recargos generales
            $c = new Criteria();
            //$c->setLimit(500);
            $c->add(RecargoFletePeer::CA_IDCONCEPTO, '9999');
            if ($trayecto->getCaIdtarifas()!=$trayecto->getCaIdTrayecto()) {
                $c->add(RecargoFletePeer::CA_IDTRAYECTO, $trayecto2->getCaIdtrayecto());
            } else {
                $c->add(RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto());
            }

            //$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() );
            $recargos = RecargoFletePeer::doSelect($c);
            foreach ($recargos as $recargo) {

                $pricrecargo = PricRecargoxConceptoPeer::retrieveByPk($trayecto->getCaIdtrayecto(), $recargo->getCaIdConcepto(), $recargo->getCaIdRecargo());
                if (!$pricrecargo) {
                    $pricrecargo = new PricRecargoxConcepto();
                    $pricrecargo->setCaIdTrayecto($trayecto->getCaIdtrayecto());
                    $pricrecargo->setCaIdConcepto($recargo->getCaIdConcepto());
                    $pricrecargo->setCaIdRecargo($recargo->getCaIdRecargo());
                }

                if ($recargo->getCaVlrfijo() && $recargo->getCaVlrfijo()!=0) {
                    $pricrecargo->setCaVlrrecargo($recargo->getCaVlrfijo());
                    echo "-> fijo " . $recargo->getCaVlrfijo() . "<br />";
                } else {
                    if ($recargo->getCaPorcentaje() && $recargo->getCaPorcentaje()!=0) {
                        echo "-> % " . $recargo->getCaPorcentaje() . " " . $recargo->getCaBasePorcentaje() . "<br />";
                        $pricrecargo->setCaVlrrecargo($recargo->getCaPorcentaje());

                        //if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
                        $pricrecargo->setCaAplicacion('% Sobre Flete');
                        //}
                    } else {
                        echo "-> Unit " . $recargo->getCaVlrunitario() . " " . $recargo->getCaBaseunitario() . "<br />";
                        $pricrecargo->setCaVlrrecargo($recargo->getCaVlrunitario());

                        if ($recargo->getCaBaseunitario()=='Unidades Peso/Volumen') {
                            echo " OK <br />";
                            $pricrecargo->setCaAplicacion('x Kg ó 6 Dm³');
                        }

                        if ($recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs') {
                            $trayecto = TrayectoPeer::retrieveByPk($recargo->getCaIdTrayecto());
                            if ($trayecto->getCaTransporte()=="Aéreo") {
                                $pricrecargo->setCaAplicacion('x HAWB');
                            }
                            if ($trayecto->getCaTransporte()=="Marítimo") {
                                $pricrecargo->setCaAplicacion('x HBL');
                            }
                        }

                        if ($recargo->getCaBaseunitario()=="Número de Piezas") {
                            $pricrecargo->setCaAplicacion("x Pieza");
                        }
                    }
                }
                $pricrecargo->setCaFchinicio($recargo->getCaFchinicio());
                $pricrecargo->setCaFchvencimiento($recargo->getCaFchvencimiento());

                $pricrecargo->setCaVlrminimo($recargo->getCaRecargominimo());
                $pricrecargo->setCaIdmoneda($recargo->getCaIdmoneda());



                if (in_array($recargo->getCaObservaciones(), $porHbl)) {
                    $pricrecargo->setCaAplicacionMin("x HBL");
                } elseif (in_array($recargo->getCaObservaciones(), $porCtnr)) {
                    $pricrecargo->setCaAplicacionMin("x Contenedor");
                } elseif (in_array($recargo->getCaObservaciones(), $porEmbarque)) {
                    $pricrecargo->setCaAplicacionMin("x Embarque");
                } elseif (in_array($recargo->getCaObservaciones(), $porTm3)) {
                    $pricrecargo->setCaAplicacionMin("x T/M³");
                } else {
                    $pricrecargo->setCaObservaciones($recargo->getCaObservaciones());
                }


                if ($recargo->getCaUsuActualizado()) {
                    $pricrecargo->setCaUsucreado($recargo->getCaUsuactualizado());
                    $pricrecargo->setCaFchcreado($recargo->getCaFchactualizado());
                } elseif ($recargo->getCaUsucreado()) {
                    $pricrecargo->setCaUsucreado($recargo->getCaUsucreado());
                    $pricrecargo->setCaFchcreado($recargo->getCaFchcreado());
                }

                if (!$pricrecargo->getCaUsucreado()) {
                    $pricrecargo->setCaUsucreado("Administrador");
                }

                if (!$pricrecargo->getCaFchcreado()) {
                    $pricrecargo->setCaFchcreado(date("Y-m-d"));
                }

                $pricrecargo->save();
            }
        }
    }

    /*
     * Importa el tarifario anterior dentro del nuevo tarifario
     */

    public function executeImportarNotasTarifario() {
        sfConfig::set('sf_web_debug', false);
        exit("Ejecutar solo una vez");
        $c = new Criteria();
        $c->add(TrayectoPeer::CA_IMPOEXPO, "Exportación");
        //$c->add( TrayectoPeer::CA_TRANSPORTE , "Aéreo" );

        $c->addJoin(TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD);

        //$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );
        //$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
        //$c->setLimit(30);
        $trayectos = TrayectoPeer::doSelect($c);
        set_time_limit(0);

        foreach ($trayectos as $trayecto) {
            echo "*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-<br />";
            $fletes = $trayecto->getFletes();
            $notas = array();
            $str = "";
            foreach ($fletes as $flete) {
                //print_r( $flete );
                //echo $flete->getCaobservaciones()."<br />";
                if ($flete->getCaobservaciones()) {

                    $notas[] = $flete->getCaobservaciones();
                }
            }

            /* if( count($notas )>0 && count($fletes)!=count($notas ) ){
             * cho count($fletes)." ".count($notas )."<br />";
             * cho  $trayecto->getCaIdTrayecto()." diferencia entre los comentarios repetidos <br />";
             } */

            $notas = array_unique($notas);

            print_r($notas);

            if ($trayecto->getCaObservaciones()) {
                $str.= $trayecto->getCaObservaciones() . "\n";
            }
            $str.=implode("\n", $notas);
            echo Utils::replace($str) . "<br />-->---------->--------<br />";
            $trayecto->setCaObservaciones($str);
            $trayecto->save();
        }
    }

    /*
     * Importa el tarifario anterior dentro del nuevo tarifario
     */

    public function executeImportarTarifarioRecargosGrales() {
        set_time_limit(0);

        sfConfig::set('sf_web_debug', false);

        $c = new Criteria();
        //$c->add(  RecargoFleteTrafPeer:: );
        //$c->setLimit(10);
        //$c->add(  RecargoFleteTrafPeer::CA_IMPOEXPO, "Importación" );
        $recargos = RecargoFleteTrafPeer::doSelect($c);
        $i = 0;

        foreach ($recargos as $recargo) {

            echo (++$i) . " " . $recargo->getCaIdTrafico() . " " . $recargo->getCaIdCiudad() . " " . $recargo->getCaIdRecargo() . " " . $recargo->getCaModalidad() . "<br />";

            $pricrecargo = PricRecargosxCiudadPeer::retrieveByPk($recargo->getCaIdTrafico(), $recargo->getCaIdCiudad(), $recargo->getCaIdRecargo(), $recargo->getCaModalidad(), $recargo->getCaImpoexpo());
            if (!$pricrecargo) {
                $pricrecargo = new PricRecargosxCiudad();
                $pricrecargo->setCaIdTrafico($recargo->getCaIdTrafico());
                $pricrecargo->setCaIdCiudad($recargo->getCaIdCiudad());
                $pricrecargo->setCaIdRecargo($recargo->getCaIdRecargo());
                $pricrecargo->setCaModalidad($recargo->getCaModalidad());
                $pricrecargo->setCaImpoexpo($recargo->getCaImpoexpo());
            }

            if ($recargo->getCaVlrfijo() && $recargo->getCaVlrfijo()!=0) {
                $pricrecargo->setCaVlrrecargo($recargo->getCaVlrfijo());
                //echo "-> fijo ".$recargo->getCaVlrfijo()."<br />";
            } else {
                if ($recargo->getCaPorcentaje() && $recargo->getCaPorcentaje()!=0) {
                    echo "-> % " . $recargo->getCaPorcentaje() . " " . $recargo->getCaBasePorcentaje() . "<br />";
                    $pricrecargo->setCaVlrrecargo($recargo->getCaPorcentaje());

                    //if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
                    $pricrecargo->setCaAplicacion('% Sobre Flete');
                    //}
                } else {
                    echo "-> Unit " . $recargo->getCaVlrunitario() . " " . $recargo->getCaBaseunitario() . "<br />";
                    $pricrecargo->setCaVlrrecargo($recargo->getCaVlrunitario());

                    if ($recargo->getCaBaseunitario()=='Unidades Peso/Volumen') {
                        echo " OK <br />";
                        $pricrecargo->setCaAplicacion('x Kg ó 6 Dm³');
                    }

                    if ($recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs') {
                        $trayecto = TrayectoPeer::retrieveByPk($recargo->getCaIdTrayecto());
                        if ($trayecto->getCaTransporte()=="Aéreo") {
                            $pricrecargo->setCaAplicacion('x HAWB');
                        }
                        if ($trayecto->getCaTransporte()=="Marítimo") {
                            $pricrecargo->setCaAplicacion('x HBL');
                        }
                    }

                    if ($recargo->getCaBaseunitario()=="Número de Piezas") {
                        $pricrecargo->setCaAplicacion("x Pieza");
                    }
                }
            }

            $pricrecargo->setCaFchinicio($recargo->getCaFchinicio());
            $pricrecargo->setCaFchvencimiento($recargo->getCaFchvencimiento());

            $pricrecargo->setCaVlrminimo($recargo->getCaRecargominimo());
            $pricrecargo->setCaIdmoneda($recargo->getCaIdmoneda());
            $pricrecargo->setCaObservaciones($recargo->getCaObservaciones());

            if (!$pricrecargo->getCaUsucreado()) {
                $pricrecargo->setCaUsucreado("Administrador");
            }

            if (!$pricrecargo->getCaFchcreado()) {
                $pricrecargo->setCaFchcreado(date("Y-m-d"));
            }

            $pricrecargo->save();
        }
    }

    /*
     *
     */

    public function executeImportarArchivos() {
        $c = new Criteria();
        $traficos = TraficoPeer::doSelect($c);
        $dir = "d:\\links\\";
        foreach ($traficos as $trafico) {
            echo $trafico->getCaNombre() . "<br />";
            $links = explode("|", $trafico->getCalink());
            foreach ($links as $link) {
                echo "<br />---->" . $link;
                $path = $dir . $link;


                $fileObj = new PricArchivo();

                $fileObj->setCaNombre($link);
                $fileObj->setCaIdTrafico($trafico->getCaIdtrafico());

                $fileObj->setCaTamano($size);
                $fileObj->setCaTipo(Utils::mimetype($link));
                $fileObj->setCaTransporte($transporte);
                $fileObj->setCaModalidad("FCL");
                $fileObj->setCaImpoExpo("Importación");
                $fp = fopen($path, "r");
                $data = fread($fp, $size);
                fclose($fp);
                $fileObj->setCaDatos($data);
                $fileObj->setCaFchcreado(time());
                $user = $this->getUser();
                $fileObj->setCaUsucreado("Administrador");
                //$fileObj->save();
            }
        }

        //$path  = "";
    }

    /*
     * Importa el tarifario anterior dentro del nuevo tarifario
     */

    /*
     * ublic function executeImportarTarifarioRecargos(){
     * et_time_limit(0);
     * xit("Este no");
     * c = new Criteria();
     * /$c->setLimit(500);
     * c->add( RecargoFletePeer::CA_IDCONCEPTO, '9999' );
     * /$c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto() );
     * recargos = RecargoFletePeer::doSelect( $c );
     * fConfig::set('sf_web_debug', false) ;
     * oreach( $recargos as $recargo ){
     * trayecto = RecargoFletePeer::retrieveByPk( $recargo->getCaIdtrayecto() );
     * pricrecargo = PricRecargoxConceptoPeer::retrieveByPk( $recargo->getCaIdTrayecto(), $recargo->getCaIdConcepto(), $recargo->getCaIdRecargo() );
     * f( !$pricrecargo ){
     * pricrecargo = new PricRecargoxConcepto();
     * pricrecargo->setCaIdTrayecto( $recargo->getCaIdTrayecto() );
     * pricrecargo->setCaIdConcepto( $recargo->getCaIdConcepto() );
     * pricrecargo->setCaIdRecargo( $recargo->getCaIdRecargo() );
     }
     * f( $recargo->getCaVlrfijo() ){
     * pricrecargo->setCaVlrrecargo( $recargo->getCaVlrfijo() );
     * /echo "-> fijo ".$recargo->getCaVlrfijo()."<br />";
     * else{
     * f( $recargo->getCaPorcentaje() ){
     * cho "-> % ".$recargo->getCaPorcentaje()." ".$recargo->getCaBasePorcentaje()."<br />";
     * pricrecargo->setCaVlrrecargo( $recargo->getCaPorcentaje() );
     * /if( $recargo->getCaBasePorcentaje()=='Sobre Flete' ){
     * pricrecargo->setCaAplicacion( '% Sobre Flete' );
     * /}
     * else{
     * cho "-> Unit ".$recargo->getCaVlrunitario()." ".$recargo->getCaBaseunitario()."<br />";
     * pricrecargo->setCaVlrrecargo( $recargo->getCaVlrunitario() );
     * f( $recargo->getCaBaseunitario()=='Unidades Peso/Volumen' ){
     * cho " OK <br />";
     * pricrecargo->setCaAplicacion( 'x Kg ó 6 Dm³' );
     }
     * f( $recargo->getCaBaseunitario()=='Cantidad de BLs/AWBs' ){
     * trayecto = TrayectoPeer::retrieveByPk( $recargo->getCaIdTrayecto() );
     * f( $trayecto->getCaTransporte()=="Aéreo" ){
     * pricrecargo->setCaAplicacion( 'x HAWB' );
     }
     * f( $trayecto->getCaTransporte()=="Marítimo" ){
     * pricrecargo->setCaAplicacion( 'x HBL' );
     }
     }
     * f( $recargo->getCaBaseunitario()=="Número de Piezas" ){
     * pricrecargo->setCaAplicacion( "x Pieza" );
     }
     }
     }
     * pricrecargo->setCaFchinicio( $recargo->getCaFchinicio() );
     * pricrecargo->setCaFchvencimiento( $recargo->getCaFchvencimiento() );
     * pricrecargo->setCaVlrminimo( $recargo->getCaRecargominimo() );
     * pricrecargo->setCaIdmoneda( $recargo->getCaIdmoneda() );
     * porBL = array( "POR BL", "POR BL ", "Por B/l", "Por BL", "Por Bl" );
     * porHbl = array( "Por HBL" );
     * porCtnr  = array( "POR CNTR" , "POR CONTENEDOR", "Por contenedor", "Por contenedor", "Por Cntr");
     * porEmbarque = array( "Por embarque", "Por embarque\n", "Por Embarque" );
     * porTm3 = array( "Por T/M3", "POR T/M3", "T/M3", "T/M3\n", "T/M3 ", "por T/M3", "POR T/M3",);
     * f(in_array($recargo->getCaObservaciones(), $porHbl )){
     * pricrecargo->setCaAplicacionMin( "x HBL" );
     * elseif(in_array($recargo->getCaObservaciones(), $porCtnr )){
     * pricrecargo->setCaAplicacionMin( "x Contenedor" );
     * elseif(in_array($recargo->getCaObservaciones(), $porEmbarque )){
     * pricrecargo->setCaAplicacionMin( "x Embarque" );
     * elseif(in_array($recargo->getCaObservaciones(), $porTm3 )){
     * pricrecargo->setCaAplicacionMin( "x T/M³" );
     }
     * lse{
     * pricrecargo->setCaObservaciones( $recargo->getCaObservaciones() );
     }
     * f( $recargo->getCaUsuActualizado() ){
     * pricrecargo->setCaUsucreado($recargo->getCaUsuactualizado());
     * pricrecargo->setCaFchcreado($recargo->getCaFchactualizado());
     * elseif( $recargo->getCaUsucreado() ){
     * pricrecargo->setCaUsucreado($recargo->getCaUsucreado());
     * pricrecargo->setCaFchcreado($recargo->getCaFchcreado());
     }
     * f( !$pricrecargo->getCaUsucreado() ){
     * pricrecargo->setCaUsucreado("Administrador");
     }
     * f( !$pricrecargo->getCaFchcreado() ){
     * pricrecargo->setCaFchcreado(date("Y-m-d"));
     }
     * pricrecargo->save();
     }
     }
     */







    /*
     * Esta funcion se va a borrar
     */

    public function executeParametrizarConceptos() {
        $c = new Criteria();
        $c->add(TrayectoPeer::CA_IMPOEXPO, "Exportación");
        $c->add(TrayectoPeer::CA_TRANSPORTE, "Aéreo");
        $c->add(TrayectoPeer::CA_MODALIDAD, "DIRECTO");

        /* $c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );
         * c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" ); */
        //$c->add( TrayectoPeer::CA_MODALIDAD, "LCL" );
        //$c->setLimit(30);
        $trayectos = TrayectoPeer::doSelect($c);

        set_time_limit(0);

        foreach ($trayectos as $trayecto) {

            $fletes = $trayecto->getFletes();

            //		$trayecto->getOrigen();

            $ciudad = CiudadPeer::retrieveByPk($trayecto->getCaOrigen());
            $trafico = $ciudad->getTrafico();

            $conceptosStr = $trafico->getCaConceptos();
            //$conceptosStr="";
            //$recargosStr = $trafico->getCaRecargos();
            //$recargosStr="";

            foreach ($fletes as $flete) {
                //echo $flete->getCaIdConcepto()."<br />";
                /* if( $flete->getCaIdConcepto()==9999){
                 * ontinue;
                 } */

                if (strlen($conceptosStr)!=0) {
                    $conceptosStr.="|";
                }

                $conceptosStr.=$flete->getCaIdConcepto();
            }

            //$conceptosStr.="|22|23|24|25|26|27|28";
            $conceptosArr = explode("|", $conceptosStr);
            $conceptosArr = array_unique($conceptosArr);
            /* $conceptosStr=implode("|",$conceptosArr);
             * cho "<br />Conceptos -->".$conceptosStr."<br />"; */
            $trafico->setCaConceptos($conceptosStr);
            $trafico->save();


            /* $c = new Criteria();
             * c->add( RecargoFletePeer::CA_IDTRAYECTO, $trayecto->getCaIdTrayecto() );
             * recargos = RecargoFletePeer::doSelect($c);
             * oreach( $recargos as $recargo ){
             * f(strlen($recargosStr)!=0){
             * recargosStr.="|";
             }
             * tipoRec = $recargo->getTipoRecargo();
             * cho "->".$tipoRec->getCaRecargo();
             * recargosStr.= $tipoRec->getCaIdrecargo();
             }
             * recargosArr = explode("|",$recargosStr);
             * recargosArr = array_unique($recargosArr);
             * recargosStr=implode("|",$recargosArr);
             * cho "<br />Recargos -->".$recargosStr."<br />";
             * trafico->setCaRecargos($recargosStr);
             * /$trafico->save(); */
        }
    }

    /*
     * Incluye los conceptos basico en todos los traficos
     * 88 9  //tm3 minimo
     * 1  minimo aereo
     * 133 134 coloadins
     */

    public function executeIncluirConceptosTrafico() {
        $c = new Criteria();
        $traficos = TraficoPeer::doSelect($c);
        print_r($traficos);
        foreach ($traficos as $trafico) {
            $conceptosStr = $trafico->getCaConceptos();
            if ($conceptosStr) {
                $conceptosArr = explode("|", $conceptosStr);
            } else {
                $conceptosArr = array();
            }
            $conceptosArr[] = 88;
            $conceptosArr[] = 9;
            $conceptosArr[] = 1;
            $conceptosArr[] = 133;
            $conceptosArr[] = 134;
            $conceptosArr = array_unique($conceptosArr);
            $conceptosStr = implode("|", $conceptosArr);

            echo "->" . $trafico . " " . $conceptosStr . "<br />";
            $trafico->setCaConceptos($conceptosStr);
            $trafico->save();
        }
    }

    /*
     * TRM
     */

    public function executeGetTRM() {

        /* Guarda en la base de datos la tasa representativa del mercado. */
        $fecha_actual = date("Y-m-d");

        $string = strtolower(file_get_contents("http://www.banrep.gov.co/"));

        $initialTag = 'tasa de cambio';
        $finalTag = '</div></td>';
        $trm = Utils::getInformation($string, $initialTag, $finalTag) . "chm";

        $initialTag = 'numeros">';
        $finalTag = "chm";

        $trm = Utils::getInformation($trm, $initialTag, $finalTag);
        $trm = str_replace(",", "", $trm);
        $trm = doubleval($trm);

        $initialTag2 = "<p>indicadores -";
        $finalTag2 = "</p>";
        $act = Utils::getInformation($string, $initialTag2, $finalTag2);

        $mytrm = (float) $trm;

        /* 0 es Domingo, 6 es Sabado */
        $num_day = date('w');
        if (substr($act, 0, 2)== date("d") || $num_day==0 || $num_day==6) {
            if ($trm) {
                $trmObj = new TRM();
                $trmObj->setCaFecha($fecha_actual);
                $trmObj->setCaPesos($mytrm);
                $trmObj->save();
            }
        }
    }

    /*
     * TRM
     */

    public function executeGetAlaico() {


        $actual = date("Y-m-d");
        $sql = "SELECT COUNT(*) as numreg FROM " . TasaAlaicoPeer::TABLE_NAME . " WHERE " . TasaAlaicoPeer::CA_FECHAINICIAL . " <= '" . $actual . "' AND " . TasaAlaicoPeer::CA_FECHAFINAL . " >= '" . $actual . "'";

        $con = Propel::getConnection(TasaAlaicoPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();

        $tmp = $row['numreg'];

        if ($tmp==0) {
            //echo "asd";
            //Actualizacion de la tasa alaico
            $meses = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Agt", "Sep", "Oct", "Nov", "Dic");
            $string = file_get_contents("http://www.alaico.org/2008/ALAICOJHON/htdocs//modules/mastop_publish/?tac=TasaAlaico");

            $initialTag = '<span class="Apple-style-span" style="font-weight: bold; font-size: 24px; color: #000080; font-family: tahoma; background-color: #ffffff">$ ';
            $finalTag = "</span";
            $alaico = Utils::getInformation($string, $initialTag, $finalTag);

            $alaico = str_replace(".", "", $alaico);
            $tasa_alaico = (float) $alaico;



            $initialTag = '<font face="verdana,geneva" size="3"><b><font color="#000080" style="background-color: #ffffff">';
            $finalTag = "</font";
            $vigencia = Utils::getInformation($string, $initialTag, $finalTag);

            $month1 = array_search(substr($vigencia, 0, 3), $meses) + 1;
            if ($month1 < 10) {
                $month1 = "0" . $month1;
            }


            $month2 = array_search(substr($vigencia, 7, 3), $meses) + 1;
            if ($month2 < 10) {
                $month2 = "0" . $month2;
            }

            $year1 = date("Y");
            $year2 = date("Y");
            if ($month1=="12" && $month2=="01") {
                $year2++;
            }


            $day1 = Utils::getInformation(substr($vigencia, 2, 5), ".", "a");
            $day2 = substr($vigencia, 6, 30);
            $day2 = substr($day2, strpos($day2, ".") + 1, 30);

            $day1 = str_pad($day1, 2, "0", STR_PAD_LEFT);
            $day2 = str_pad($day2, 2, "0", STR_PAD_LEFT);

            $f1 = $year1 . "-" . $month1 . "-" . $day1;
            $f2 = $year2 . "-" . $month2 . "-" . $day2;


            $alaico = new TasaAlaico();
            $alaico->setCaFechaInicial($f1);
            $alaico->setCaFechaFinal($f2);
            $alaico->setCaValortasa($tasa_alaico);
            //$alaico->setUltimaActualizacion(date("Y-m-d H:i:s"));
            $alaico->save();
        }
    }

    /*
     * Unifica los recargos LCL en recargos generales del trayecto
     */

    public function executeFixTarifarioLCL() {

        exit("detenido");
        $c = new Criteria();


        $c->add(TrayectoPeer::CA_IMPOEXPO, "Importación");
        $c->add(TrayectoPeer::CA_TRANSPORTE, "Marítimo");
        $c->add(TrayectoPeer::CA_MODALIDAD, "LCL");



        //$c->add( TrayectoPeer::CA_IMPOEXPO, "Importación" );
        //$c->add( TrayectoPeer::CA_TRANSPORTE , "Marítimo" );
        //$c->addJoin( TrayectoPeer::CA_ORIGEN , CiudadPeer::CA_IDCIUDAD );
        //$c->add( CiudadPeer::CA_IDTRAFICO, "DE-049" );
        //
        //$c->add( TrayectoPeer::CA_IDTRAYECTO, 3705 );
        //$c->setLimit(30);
        $trayectos = TrayectoPeer::doSelect($c);
        set_time_limit(0);

        foreach ($trayectos as $trayecto) {

            $c = new Criteria();
            $c->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto());
            $recs = PricRecargoxConceptoPeer::doSelect($c);
            if (count($recs) > 0) {
                $idRecargos = array();
                foreach ($recs as $recargo) {
                    $idRecargos[] = $recargo->getCaIdrecargo();
                }

                foreach ($idRecargos as $idRecargo) {
                    if ($idRecargo==9999) {
                        continue;
                    }
                    $c = new Criteria();
                    $c->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $trayecto->getCaIdtrayecto());
                    $c->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $idRecargo);
                    $recargos = PricRecargoxConceptoPeer::doSelect($c);

                    echo count($recargos) . "<br />";
                    for ($i = 0; $i < count($recargos); $i++) {
                        if ($i==0) {

                            $vlrRecargo = $recargos[$i]->getCaVlrrecargo();
                            $vlrMinimo = $recargos[$i]->getCaVlrminimo();
                        } else {
                            echo "asasd";
                            if ($vlrRecargo!=$recargos[$i]->getCaVlrrecargo() && $vlrMinimo != $recargo[$i]->getCaVlrminimo()) {
                                echo "aca no se pudo<br /> " . $recargo->getCaIdTrayecto();
                            } else {
                                echo "OK " . $recargo->getCaIdTrayecto();
                            }
                        }

                        /*
                         * f($i==0){
                         * recargos[$i]->setCaIdConcepto(9999);
                         * recargos[$i]->save();
                         * else{
                         } */
                    }
                }
            }
        }
    }

    /*
     * Coloca la fecha de presentacion de acuerdo a los envios por email
     */

    public function executeFixCotFchpresentacion() {
        exit();
        set_time_limit(0);

        $sql = "select ca_consecutivo, notificaciones.tb_tareas.ca_idtarea, min(ca_fchenvio) as ca_fchenvio from tb_cotizaciones inner join notificaciones.tb_tareas on ca_idg_envio_oportuno = ca_idtarea
	inner join notificaciones.tb_notificaciones on 	notificaciones.tb_tareas.ca_idtarea = notificaciones.tb_notificaciones.ca_idtarea
	inner join tb_emails on	tb_emails.ca_idemail = tb_notificaciones.ca_idemail 
where ca_consecutivo like '%2009'  and ca_fchterminada is null and tb_emails.ca_fchenvio is not null 

group by ca_consecutivo,  notificaciones.tb_tareas.ca_idtarea";
        $con = Propel::getConnection(NotTareaPeer::DATABASE_NAME);

        $stmt = $con->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            //print_r( $row );
            $tarea = NotTareaPeer::retrieveByPk($row['ca_idtarea']);
            $tarea->setCaFchterminada($row['ca_fchenvio']);
            //$tarea->save();

            echo "OK " . $row['ca_consecutivo'] . "<br />";
        }
        return sfView::NONE;
    }

    public function executeGenerarFuente() {
        require( "D:\\Desarrollo\\colsys_sf12\\lib\\vendor\\FPDF\\font\\makefont\\makefont.php" );
        MakeFont('D:\\Desarrollo\\sw\\ttf2pt1\\tahoma.ttf', 'D:\\Desarrollo\\sw\\ttf2pt1\\tahoma.afm', 'cp1252');
        MakeFont('D:\\Desarrollo\\sw\\ttf2pt1\\tahomabd.ttf', 'D:\\Desarrollo\\sw\\ttf2pt1\\tahomab.afm', 'cp1252');
        exit("detenido");
    }

    public function executeImportarHelpdesk() {

        exit("detenido");

        $c = new Criteria();
        //$c->add( ExoTicketPeer::STATUS, "Open" );

        $criterion = $c->getNewCriterion(ExoTicketPeer::OPENED, mktime(0, 0, 0, 1, 1, 2009), Criteria::GREATER_EQUAL);
        $criterion->addOr($c->getNewCriterion(ExoTicketPeer::STATUS, "Open"));
        $c->add($criterion);


        //$c->setLimit( 10 );
        $tickets = ExoTicketPeer::doSelect($c);

        foreach ($tickets as $ticket) {
            //echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";

            $hTicket = new HdeskTicket();
            if ($ticket->getAdminUser()=="backups") {
                $hTicket->setCaLogin("wjimenez");
                $hTicket->setCaAssignedto("thomaspeters");
            } else {
                $hTicket->setCaLogin(strtolower($ticket->getAdminUser()));
            }

            $hTicket->setCaOpened(date("Y-m-d h:i:s", $ticket->getOpened()));
            $hTicket->setCaTitle(utf8_decode($ticket->getTitle()));
            $hTicket->setCaText(utf8_decode($ticket->getText()));
            if ($ticket->getOwner()) {
                $hTicket->setCaAssignedto($ticket->getOwner());
            }

            if ($ticket->getStatus()=="Closed") {
                $hTicket->setCaAction("Cerrado");
            } else {
                $hTicket->setCaAction("Abierto");
            }

            //echo utf8_decode($ticket->getGroup());

            $c = new Criteria();
            $c->add(HdeskGroupPeer::CA_NAME, utf8_decode($ticket->getGroup()));
            $group = HdeskGroupPeer::doSelectOne($c);

            $hTicket->setCaIdgroup($group->getCaIdgroup());

            $hTicket->save();

            $responses = $ticket->getExoResponses();

            foreach ($responses as $response) {
                $hresponse = new HdeskResponse();
                $hresponse->setCaIdticket($hTicket->getCaidticket());
                if ($response->getSname()=="admin") {
                    $hresponse->setCaLogin("falopez");
                } else {
                    if ($response->getSname()=="backups") {
                        $hresponse->setCaLogin("wjimenez");
                    } else {
                        $hresponse->setCaLogin(strtolower($response->getSname()));
                    }
                }
                $hresponse->setCaText(utf8_decode($response->getComment()));
                $hresponse->setCaCreatedat(date("Y-m-d H:i:s", $response->getPosted()));
                $hresponse->save();
            }

            /* $usuario = UsuarioPeer::retrieveByPk( strtolower($ticket->getAdminUser()) );
             * f( !$usuario  && $ticket->getAdminUser()!= "backups"){
             * /echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";
             * cho $ticket->getId()." ".$ticket->getOpened()." No existe ". $ticket->getAdminUser()."<br />";
             } */
        }

        /*
         * c = new Criteria();
         * c->add( ExoResponsePeer::POSTED, mktime(0,0,0,1,1,2009) , Criteria::GREATER_EQUAL );
         * responses = ExoResponsePeer::doSelect( $c );
         * oreach( $responses as $response ){
         * /echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";
         * usuario = UsuarioPeer::retrieveByPk( strtolower($response->getSname()) );
         * f( !$usuario  && $response->getSname()!= "backups"){
         * /echo strtolower($ticket->getAdminUser())." ".utf8_decode($ticket->getTitle())."<br />";
         * cho $response->getId()." No existe ". $response->getSname()."<br />";
         }
         } */

        return sfView::NONE;
    }

    public function executeImportarHelpdeskRespuestas() {
        exit("detenido");
        $c = new Criteria();
        $tickets = HdeskTicketPeer::doSelect($c);

        foreach ($tickets as $ticket) {
            $text = str_replace("<br />", "<br>", $ticket->getCaText());

            echo $text;

            $ticket->setCaText($text);
            $ticket->save();

            /* if( !$ticket->getCaResponseTime() ){
             * logins = array(  );
             * c = new Criteria();
             * c->add( HdeskUserGroupPeer::CA_IDGROUP, $ticket->getCaIdgroup() );
             * c->addAscendingOrderByColumn( HdeskUserGroupPeer::CA_LOGIN);
             * usuarios = HdeskUserGroupPeer::doSelect( $c );
             * oreach( $usuarios as $usuario ){
             * logins[]=$usuario->getCaLogin();
             }
             * c = new Criteria();
             * c->add( HdeskResponsePeer::CA_IDTICKET, $ticket->getcaIdticket() );
             * c->add( HdeskResponsePeer::CA_LOGIN, $logins, Criteria::IN );
             * c->addAscendingOrderByColumn( HdeskResponsePeer::CA_CREATEDAT );
             * response = HdeskResponsePeer::doSelectOne( $c );
             * f( $response ){
             * ticket->setCaResponsetime($response->getcaCreatedat());
             * ticket->save();
             }
             } */
        }



        return sfView::NONE;
    }

    /*
     * Coloca la hora de respuesta en tb_tickets
     */

    public function executeFixRespuestas() {
        //exit("detenido");
        $c = new Criteria();
        $c->add(HdeskTicketPeer::CA_RESPONSETIME, null, Criteria::ISNULL);
        $tickets = HdeskTicketPeer::doSelect($c);

        foreach ($tickets as $ticket) {
            if (!$ticket->getCaResponseTime()) {

                $logins = array();

                $c = new Criteria();
                $c->add(HdeskUserGroupPeer::CA_IDGROUP, $ticket->getCaIdgroup());
                $c->addAscendingOrderByColumn(HdeskUserGroupPeer::CA_LOGIN);
                $usuarios = HdeskUserGroupPeer::doSelect($c);
                foreach ($usuarios as $usuario) {
                    $logins[] = $usuario->getCaLogin();
                }


                $c = new Criteria();
                $c->add(HdeskResponsePeer::CA_IDTICKET, $ticket->getcaIdticket());
                $c->add(HdeskResponsePeer::CA_LOGIN, $logins, Criteria::IN);
                $c->addAscendingOrderByColumn(HdeskResponsePeer::CA_CREATEDAT);

                $response = HdeskResponsePeer::doSelectOne($c);

                if ($response) {
                    $ticket->setCaResponsetime($response->getcaCreatedat());
                    $ticket->save();
                }
            }
        }



        return sfView::NONE;
    }

    public function executePermisosColsys() {
        $c = new Criteria();
        $usuarios = UsuarioPeer::doSelect($c);

        foreach ($usuarios as $usuario) {
            $rutinas = explode("|", $usuario->getCaRutinas());
            if (in_array("0200220000", $rutinas)) {
                $rutinas[] = "0200240000";
            }

            //$rutinas[] = "0500600000";
            //$rutinas[] = "0500700000";

            $rutinas = array_unique($rutinas);
            sort($rutinas);
            $rutinasStr = implode("|", $rutinas);
            if ($rutinasStr) {
                $usuario->setCaRutinas($rutinasStr);
            } else {
                $usuario->setCaRutinas(null);
            }
            echo $usuario->getCaLogin() . " " . implode("|", $rutinas) . " <br />";
            $usuario->save();
        }
    }

    public function executeMenusUsuario() {
        $usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter("login"));
        $rutinas = explode("|", $usuario->getCaRutinas());

        $c = new Criteria();
        $c->add(RutinaOldPeer::CA_RUTINA, $rutinas, Criteria::IN);
        $c->addAscendingOrderByColumn(RutinaOldPeer::CA_GRUPO);
        $c->addAscendingOrderByColumn(RutinaOldPeer::CA_OPCION);
        $this->rutinas = RutinaOldPeer::doSelect($c);
    }

    public function executeFixMenus() {

        exit("OK");
        $c = new Criteria();
        $c->addAscendingOrderByColumn(RutinaPeer::CA_GRUPO);
        $c->addAscendingOrderByColumn(RutinaPeer::CA_OPCION);

        $rutinas = RutinaPeer::doSelect($c);
        $i = 1;
        foreach ($rutinas as $rutina) {

            $sql = "UPDATE control.tb_rutinasnew SET ca_rutina='$i' WHERE ca_rutina='" . $rutina->getCaRutina() . "'";

            $con = Propel::getConnection(ReportePeer::DATABASE_NAME);

            $stmt = $con->prepare($sql);
            $stmt->execute();

            $i++;
        }
    }

    public function executeMatchNits() {

        sfConfig::set('sf_web_debug', false);
        set_time_limit(0);
        $path = "d:\\AlemaniaTotal.txt";

        $content = file_get_contents($path);
        $this->nits = explode("\n", $content);

        $this->setLayout("none");
    }

    public function executeCopiarTrayectos() {
        $c = new Criteria();

        $c->addJoin(CiudadPeer::CA_IDTRAFICO, TraficoPeer::CA_IDTRAFICO);
        $c->addJoin(TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD);
        $c->add(TrayectoPeer::CA_IMPOEXPO, "Importación");
        $c->add(TrayectoPeer::CA_TRANSPORTE, "Marítimo");
        $c->add(TrayectoPeer::CA_MODALIDAD, "LCL");
        $c->add(TrayectoPeer::CA_IDLINEA, 78);


        $c->add(TraficoPeer::CA_IDGRUPO, 6);
        $trayectos = TrayectoPeer::doSelect($c);
        $lineas = array(20, 87, 86, 18, 14, 123, 16, 121, 17, 8);
        $i = 1;
        foreach ($trayectos as $trayecto) {

            foreach ($lineas as $linea) {

                $c = new Criteria();
                $c->add(TrayectoPeer::CA_IMPOEXPO, "Importación");
                $c->add(TrayectoPeer::CA_TRANSPORTE, "Marítimo");
                $c->add(TrayectoPeer::CA_MODALIDAD, "FCL");
                $c->add(TrayectoPeer::CA_ORIGEN, $trayecto->getCaOrigen());
                $c->add(TrayectoPeer::CA_DESTINO, $trayecto->getCaDestino());
                $c->add(TrayectoPeer::CA_IDLINEA, $linea);
                $tr = TrayectoPeer::doSelectOne($c);

                if (!$tr) {

                    $trayectoNew = new Trayecto();
                    $trayectoNew->setCaTransporte("Marítimo");
                    $trayectoNew->setCaImpoexpo("Importación");
                    $trayectoNew->setCaOrigen($trayecto->getCaOrigen());
                    $trayectoNew->setCaDestino($trayecto->getCaDestino());
                    $trayectoNew->setCaModalidad("FCL");
                    $trayectoNew->setCaIdlinea($linea);
                    $trayectoNew->setCaIdagente(0);
                    $trayectoNew->setCaFrecuencia("-");
                    $trayectoNew->setCaTiempotransito("-");
                    $trayectoNew->setCaFchcreado(time());
                    $trayectoNew->setCaIdtarifas(1);
                    $trayectoNew->save();

                    $trayectoNew->setCaIdtarifas($trayectoNew->getCaIdtrayecto());
                    $trayectoNew->save();
                    echo "OK " . $linea . " " . $trayecto->getOrigen() . " " . $i++ . "<br />";
                }
            }
        }

        return sfView::NONE;
    }

    public function executeCircularColsys() {

        exit("detenido");
        $file = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . "Circular_nuevos_costos_en_el_combustible.pdf";

        $txt = "Estimados señores:

De acuerdo con información de las líneas navieras, adjunto nos permitimos enviar circular correspondiente a modificaciones en el Recargo por Combustible e implementación del GRI (General Rate Increase) a partir del 1 de abril de 2009.

Cordialmente,

COLTRANS S.A.
Departamento Comercial
";

        $c = new Criteria();
        $c->addAscendingOrderByColumn(ContactoPeer::CA_IDCONTACTO);
        $c->addJoin(ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);
        $c->addJoin(ClientePeer::CA_VENDEDOR, UsuarioPeer::CA_LOGIN);
        $c->add(UsuarioPeer::CA_IDSUCURSAL, "BOG");
        $c->add(ContactoPeer::CA_IDCONTACTO, 5718, Criteria::GREATER_EQUAL);
        $c->addAnd(ContactoPeer::CA_IDCONTACTO, 7942, Criteria::LESS_EQUAL);
        $c->add(ClientePeer::CA_STATUS, "Vetado", Criteria::NOT_EQUAL);

        //$c->setLimit(1);


        $c->setDistinct();

        $contactos = ContactoPeer::doSelect($c);
        $i = 1;
        foreach ($contactos as $contacto) {
            if ($contacto->getCaEmail()) {
                echo ($i++) . " " . $contacto->getCaIdcontacto() . " " . $contacto->getCaEmail() . "<br />";

                $email = new Email();
                $email->setCaFrom("serclientebog@coltrans.com.co");
                $email->setCaFromname("Coltrans S.A. - Servicio al cliente");
                $email->setCaAddress($contacto->getCaEmail());
                //$email->setCaAddress("abotero@coltrans.com.co");
                $email->setCaSubject("Circular nuevos costos en el combustible y otros recargos a aplicar a partir 01 de Abril de 2009");
                $email->setCaBody($txt);
                $email->setCaBodyHtml(Utils::replace($txt));
                $email->setCaAttachment($file);
                $email->setCaTipo("Circular combustible");
                $email->setCaIdcaso(0);
                $email->setCaUsuenvio("Administrador");
                //$email->save();
                //$email->send();
            }
        }
        return sfView::NONE;
    }

    public function executeColocarLimitetiempo() {
        exit("detenido");
        $sql = "select * from pg_user";
        $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            if ($row['usename']!="postgres" && $row['usename']!="Administrador") {
                $sql = "ALTER ROLE \"" . $row['usename'] . "\" SET statement_timeout=240000";
                //echo $row['usename']."<br />";
                echo $sql . ";<br />";
            }
        }
        return sfView::NONE;
    }

    public function executeEliminarUsuarios() {
        exit("detenido");
        $sql = "select * from pg_user";
        $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            if ($row['usename']!="postgres" && $row['usename']!="Administrador") {
                $sql = "DROP ROLE \"" . $row['usename'] . "\" ";
                //echo $row['usename']."<br />";
                echo $sql . ";<br />";
            }
        }
        return sfView::NONE;
    }

    public function executeHorasCotizaciones() {

        sfConfig::set('sf_web_debug', false);
        set_time_limit(0);
        $path = "d:\\horascotizaciones.csv";
        $i = 0;
        $content = file_get_contents($path);
        $rows = explode("\n", $content);
        echo "OK ";
        foreach ($rows as $row) {
            $row = explode(";", $row);
            $c = new Criteria();
            $c->add(CotizacionPeer::CA_CONSECUTIVO, $row[0]);
            $cotizacion = CotizacionPeer::doSelectOne($c);
            echo (++$i);
            //if( !$cotizacion->getCaFchpresentacion() ){
            if (trim($row[2])) {
                echo " " . $row[0] . " -" . $row[2];
                $cotizacion->setCaFchpresentacion($row[2]);
                $cotizacion->save();
            }
            /* }else{
             * cho "fchpresentacion  ".$row[0]." ".$cotizacion->getCaFchpresentacion()." ".$row[2];
             } */

            echo "<br />";
        }
        return sfView::NONE;
    }

    /*
     * Busca las cargas que estan abiertas que ya se les habian hecho confirmacion de llegada.
     */

    public function executeFixCargasEntregadas() {
        $c = new Criteria();
        $c->add(ReportePeer::CA_IMPOEXPO, "Importación");
        $c->add(ReportePeer::CA_TRANSPORTE, "Marítimo");
        $c->add(ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada", Criteria::NOT_EQUAL);
        $c->addAnd(ReportePeer::CA_ETAPA_ACTUAL, "", Criteria::NOT_EQUAL);
        $c->addAnd(ReportePeer::CA_ETAPA_ACTUAL, null, Criteria::ISNOTNULL);
        $c->setLimit(100);
        $reportes = ReportePeer::doSelect($c);

        foreach ($reportes as $reporte) {
            if ($reporte->esUltimaVersion()) {
                echo $reporte->getCaConsecutivo() . " " . $reporte->getCaEtapaActual() . "<br />";
            }
        }

        return sfView::NONE;
    }

    public function executeFixEtapasTracking() {
        set_time_limit(0);
        $c = new Criteria();
        //$c->setLimit(2000);
        $c->add(RepStatusPeer::CA_IDETAPA, null, Criteria::ISNULL);
        $statusList = RepStatusPeer::doSelect($c);

        $c = new Criteria();
        $etapasObj = TrackingEtapaPeer::doSelect($c);

        $etapas = array();

        foreach ($etapasObj as $etapa) {
            $etapas[$etapa->getCaImpoExpo()][$etapa->getCaTransporte()][trim($etapa->getCaEtapa())] = $etapa->getCaIdetapa();
        }

        foreach ($statusList as $status) {
            $reporte = $status->getReporte();

            if ($reporte->getCaImpoexpo()=="Triangulación") {
                $reporte->setCaImpoexpo("Importación");
            }
            if ($status->getEtapa()=="Carga Entregada") {
                $idetapa = "99999";
                //print_r( $status );
            } elseif ($status->getEtapa()=="Orden Anulada") {
                $idetapa = "00000";
            } else {
                if ($reporte->getCaImpoexpo()=="Importación") {
                    $idetapa = $etapas[$reporte->getCaImpoexpo()][$reporte->getCaTransporte()][$status->getEtapa()];
                } else {
                    $idetapa = $etapas[$reporte->getCaImpoexpo()][''][$status->getEtapa()];
                }
            }
            echo "###" . $reporte->getCaConsecutivo() . " " . $reporte->getCaImpoexpo() . " " . $reporte->getCaTransporte() . " " . $status->getEtapa() . " " . $idetapa . "<br />";

            $status->setCaIdetapa($idetapa);
            $status->save();
        }
    }

    /*
     * asos que paso olga lucia
     */

    public function executeFixCasosTraficos() {
        sfConfig::set('sf_web_debug', false);
        set_time_limit(0);
        $path = "d:\\cierres.csv";
        $i = 0;
        $content = file_get_contents($path);
        $rows = explode("\n", $content);
        echo "OK ";
        foreach ($rows as $row) {
            //$row = explode(";" ,$row);

            $c = new Criteria();
            $c->add(ReportePeer::CA_CONSECUTIVO, trim($row));
            $c->addDescendingOrderByColumn(ReportePeer::CA_VERSION);
            $reporte = ReportePeer::doSelectOne($c);
            //echo (++$i);
            //if( !$cotizacion->getCaFchpresentacion() ){
            if ($reporte) {

                //$reporte->setCaEtapaActual("Carga Entregada");
                $reporte->setCaEtapaActual("Carga en Aeropuerto de Destino");
                $reporte->save();
                echo "<br />OK: " . $row . "<br />";
            } else {
                echo "Failure: " . $row . "<br />";
            }
            /* }else{
             * cho "fchpresentacion  ".$row[0]." ".$cotizacion->getCaFchpresentacion()." ".$row[2];
             } */

            echo "<br />";
        }
        return sfView::NONE;
    }

    public function executeFixCargaTransitoDestino() {
        $c = new Criteria();
        $c->add(ReportePeer::CA_ETAPA_ACTUAL, "Carga Entregada");
        $c->add(ReportePeer::CA_CONSECUTIVO, '%-2009', Criteria::LIKE);
        $c->add(ReportePeer::CA_IMPOEXPO, "Importación");
        //$c->setLimit(500);
        $reportes = ReportePeer::doSelect($c);
        set_time_limit(0);
        foreach ($reportes as $reporte) {
            $status = $reporte->getUltimoStatus();
            if ($status) {
                if ($status->getCaEtapa()=="Carga en Tránsito a Destino") {
                    echo $reporte->getCaConsecutivo() . " " . $reporte->getCaTransporte() . "<br />";
                }
            }
        }
    }

    /*
     * Copia los permisos del sistema anterior al nuevo sistema.
     */

    public function executeCopiarPermisos() {
        exit("detenido");
        $c = new Criteria();
        $c->add(UsuarioPeer::CA_IDSUCURSAL, "BOG", Criteria::NOT_EQUAL);
        $c->add(UsuarioPeer::CA_ACTIVO, true);
        $usuarios = UsuarioPeer::doSelect($c);
        set_time_limit(0);
        foreach ($usuarios as $usuario) {

            if ($usuario->getCaRutinas()) {
                echo "<br /> " . $usuario->getCaLogin() . "<br />";
                //print_r( $rutinasStr );
                $rutinasArr = explode("|", $usuario->getCaRutinas());
                $c = new Criteria();
                $c->add(RutinaOldPeer::CA_RUTINA, $rutinasArr, Criteria::IN);
                $rutinas = RutinaOldPeer::doSelect($c);
                if ($usuario->getCaDepartamento()!="Comercial" && $usuario->getCaDepartamento()!="Servicio al Cliente") {

                    $permisosArr = array(39, 38);


                    foreach ($permisosArr as $per) {

                        $permiso = AccesoUsuarioPeer:: retrieveByPk($per, $usuario->getCaLogin());

                        if (!$permiso) {
                            $permiso = new AccesoUsuario();
                            $permiso->setCaLogin($usuario->getCaLogin());
                            $permiso->setCaRutina($per);
                            $permiso->setCaAcceso(0);
                            $permiso->save();
                        }
                    }
                }
                /*
                 * oreach( $rutinas as $rutina ){
                 * c = new Criteria();
                 * c->add( RutinaPeer::CA_GRUPO, $rutina->getCaGrupo() );
                 * c->add( RutinaPeer::CA_OPCION, $rutina->getCaOpcion() );
                 * rutinasNewsObj = RutinaPeer::doSelect( $c );
                 * oreach( $rutinasNewsObj as $rutinaNew ){
                 * permiso =AccesoUsuarioPeer:: retrieveByPk( $rutinaNew->getCaRutina(), $usuario->getCaLogin() );
                 * f( !$permiso ){
                 * permiso = new AccesoUsuario();
                 * permiso->setCaLogin( $usuario->getCaLogin() );
                 * permiso->setCaRutina( $rutinaNew->getCaRutina() );
                 * permiso->setCaAcceso( 0 );
                 * permiso->save();
                 }
                 }
                 } */
            }
        }
    }

    /*
     * Copia los permisos de las opciones de menu repetidas y coloca un nivel de acceso 0 en la que era de consulta
     */

    public function executeCopiarPermisosPerfiles() {
        exit("detenido");
        $c = new Criteria();
        //$c->add( UsuarioPeer::CA_IDSUCURSAL, "BOG", Criteria::NOT_EQUAL );
        $c->add(UsuarioPeer::CA_ACTIVO, true);
        $usuarios = UsuarioPeer::doSelect($c);
        set_time_limit(0);

        foreach ($usuarios as $usuario) {
            $acceso = AccesoUsuarioPeer::retrieveByPk(3, $usuario->getCaLogin());
            if ($acceso) {
                $newAcceso = AccesoUsuarioPeer::retrieveByPk(2, $usuario->getCaLogin());

                echo $usuario->getCaLogin() . "<br />";
                if (!$newAcceso) {
                    $newAcceso = new AccesoUsuario();
                    $newAcceso->setCaLogin($usuario->getCaLogin());
                    $newAcceso->setCaRutina(2);
                    $newAcceso->setCaAcceso(0);
                    $newAcceso->save();
                }
            }
        }
        $this->setTemplate("blank");
    }

    /*
     * Copia los permisos del sistema anterior al nuevo sistema.
     */

    public function executeFixPermisosMaestraClientesVentas() {
        exit("exit");
        $c = new Criteria();
        $c->add(UsuarioPeer::CA_IDSUCURSAL, "BOG", Criteria::NOT_EQUAL);
        $c->add(UsuarioPeer::CA_ACTIVO, true);
        $usuarios = UsuarioPeer::doSelect($c);

        foreach ($usuarios as $usuario) {
            //echo $usuario->getCaDepartamento();
            if ($usuario->getCaDepartamento()=="Marítimo") {
                $acceso = UsuarioGrupoPeer::retrieveByPk($usuario->getCaLogin(), "maritimo");
                /*
                 * c = new Criteria();
                 * c->add( AccesoUsuarioPeer::CA_LOGIN, $usuario->getCaLogin() );
                 * c->add( AccesoUsuarioPeer::CA_ACCESO, 0 );
                 * accesosUsuarios = AccesoUsuarioPeer::doSelect( $c );
                 * oreach( $accesosUsuarios as $accesosUsuario ){
                 * accesosUsuario->delete();
                 } */

                //print_r( $accesosUsuario );

                if (!$acceso) {
                    echo $usuario->getCaLogin() . "<br />";

                    $acceso = new UsuarioGrupo();
                    $acceso->setCaLogin($usuario->getCaLogin());
                    $acceso->setCaGrupo("maritimo");
                    $acceso->save();
                }
            }
        }

        return sfView::NONE;
    }

    /******************************************************************
 *
     *  Estos procedimientos se usan para estandarizar el proceso del tracking
     *
	***************************************************************** */
    /*
     * Aplica la plantilla de la etapa al status
     */

    public function executeAplicarPlantilla() {
        exit();
        $c = new Criteria();
        //$c->add( RepStatusPeer::CA_STATUS, null, Criteria::ISNULL );
        $c->add(RepStatusPeer::CA_USUENVIO, 'ajsanchez');
        $statusList = RepStatusPeer::doSelect($c);

        foreach ($statusList as $status) {
            /*
             * cho $status->getCaIdStatus()." -->".$status->getTxtStatus();
             * cho "<br />--------<br />";
             * cho "->".$status->getCaStatus();
             * cho "<br /><br />"; */

            $resultado = $status->getTxtStatus();

            if ($status->getCaStatus()) {
                $resultado .= "\n" . $status->getCaStatus();
            }
            echo $status->getCaIdStatus() . " -->" . $status->getCaStatus();
            echo "<br /><br />";
            if ($resultado) {
                $status->setCaStatus($resultado);
                //$status->save();
            }
        }
    }

    /*
     *  Este procedimiento crea un status para cada confirmacion de llegada
     * Ejecutado el 7 mayo a las 7:48PM ( CA_FCHCONFIRMADO 2009-01-01 - 2009-04-15 ) se crearon los status  125229 - 128323
     * Ejecutado 11 May a las 12:12 2009-04-16  ( CA_FCHCONFIRMADO 2009-04-16 - ... ) se crearon los status  128791 - 129545
     * Se borraron todos los status 	12 mayo 11:13
     * se crean todos x CrearStatusMaritimo
     */

    public function executeCrearStatusConfirmaciones() {
        exit("detenido no usar");
        set_time_limit(0);
        $c = new Criteria(); //CaFchconfirmado
        //$c->addJoin(  InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA );

        $c->add(InoMaestraSeaPeer::CA_FCHCONFIRMADO, '2008-12-01', Criteria::GREATER_EQUAL);
        $c->addAnd(InoMaestraSeaPeer::CA_FCHCONFIRMADO, '2008-12-31', Criteria::LESS_EQUAL);
        $c->add(InoMaestraSeaPeer::CA_REFERENCIA, '4%', Criteria::LIKE);
        $c->addOr(InoMaestraSeaPeer::CA_REFERENCIA, '5%', Criteria::LIKE);
        //$c->setLimit( 100 );
        $c->addAscendingOrderByColumn(InoMaestraSeaPeer::CA_FCHCONFIRMADO);
        $referencias = InoMaestraSeaPeer::doSelect($c);
        $file = "d:\\logCrearStatusConfirmaciones.txt";
        $fp = fopen($file, 'w+');
        foreach ($referencias as $referencia) {
            if ($referencia->getCaFchconfirmado()) {
                $inoClientes = $referencia->getInoClientesSeas();
                $i = 0;
                foreach ($inoClientes as $inoCliente) {
                    $reporte = $inoCliente->getReporte();

                    echo "<br />" . $referencia->getCaReferencia() . " ";

                    if ($reporte) {
                        $status = new RepStatus();
                        $status->setCaIdetapa("IMCOL");
                        $status->setCaIdReporte($reporte->getCaIdreporte());

                        $texto = "La MN " . ($referencia->getCaMnLlegada() ? $referencia->getCaMnLlegada() : $referencia->getCaMotonave()) . " arribó a " . $referencia->getDestino()->getCaCiudad() . ", el dia " . Utils::fechaMes($referencia->getCaFchconfirmacion()) . " con la orden en referencia a bordo.\n" . ucfirst($inoCliente->getCamensaje());

                        echo "<br /> $i " . $texto;

                        $status->setCaStatus($texto);

                        $ultimostatus = $reporte->getUltimoStatus();
                        if ($ultimostatus) {
                            $status->setCaPiezas($ultimostatus->getCaPiezas());
                            $status->setCaPeso($ultimostatus->getCaPeso());
                            $status->setCaVolumen($ultimostatus->getCaVolumen());
                            $status->setCaFchsalida($ultimostatus->getCaFchsalida());
                            $status->setCaFchcontinuacion($ultimostatus->getCaFchcontinuacion());
                        }
                        $status->setCaIdnave(($referencia->getCaMnLlegada() ? $referencia->getCaMnLlegada() : $referencia->getCaMotonave()));

                        $status->setCaFchllegada($referencia->getCaFchconfirmacion());

                        $status->setCaFchenvio($referencia->getCaFchconfirmado());
                        $status->setCausuenvio($referencia->getCaUsuconfirmado());
                        $status->setCaFchStatus($referencia->getCaFchconfirmado());
                        // No ejecutar
                        //$status->save();
                        fwrite($fp, $referencia->getCaReferencia() . "\r\n");
                    }
                }
            }
        }
        fclose($fp);
    }

    /*
     *  Este procedimiento crea un status para cada confirmación de maritimo.
     * Ejecutado 11 May a las 12:19   ( CA_FCHENVIO, '2009-01-01' - ... ) se crearon los status  129549 - 133400
     * se borraron 129549 - 133400 12 mayo 11:13
     * Ejecutado 12 May a las 11:15AM   ( CA_FCHENVIO, '2009-01-01' - 2009-01-31) se crearon los status    133740 - 135577 -   excepto {134440, 133880}
     * Ejecutado 12 May 09 a las 11:38AM   ( CA_FCHENVIO, '2009-02-01' - 2009-03-31) se crearon los status    135581 - 138741  excepto {138459, 136664, 136131 }   total 3154
     * Ejecutado 12 May  09 a las 11:57AM   ( CA_FCHENVIO, '2009-04-01' - 2009-04-30) se crearon los status   138747  - 140472  excepto {140240, 139951, 138990, 138928 }
     * Ejecutado 12 May  09 a las 12:01PM   ( CA_FCHENVIO, '2009-05-01' - ...) se crearon los status   140479  - 141011  excepto { }
     * Ejecutado 3 jul 09  a las 15:21PM   ( CA_FCHENVIO, ..., '2008-12-31 ) ( CA_REFERENCIA, '%9', Criteria::LIKE ) se crearon los status   156250  - 156282  excepto { }
     * Ejecutado 7 jul 09  a las 12:14PM   ( CA_FCHENVIO, 2009-07-01, .. ) ( CA_REFERENCIA, '%9', Criteria::LIKE ) se crearon los status   157128- 157131  excepto { }   Enviados por jjleon por el modulo viejo
     */

    public function executeCrearStatusMaritimo() {
        exit("detenido");
        set_time_limit(0);
        $c = new Criteria(); //CaFchconfirmado
        //$c->addJoin(  InoClientesSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA );

        $c->add(InoAvisosSeaPeer::CA_FCHENVIO, '2009-07-01', Criteria::GREATER_EQUAL);
        //$c->addAnd( InoAvisosSeaPeer::CA_FCHENVIO, '2009-07-01', Criteria::LESS_EQUAL );
        $c->addAnd(InoAvisosSeaPeer::CA_REFERENCIA, '%9', Criteria::LIKE);

        //$c->add( InoAvisosSeaPeer::CA_FCHENVIO, '2009-01-01',  Criteria::GREATER_EQUAL);	;

        /* $c->add( InoAvisosSeaPeer::CA_AVISO, '', Criteria::NOT_EQUAL );
         * c->addAnd( InoAvisosSeaPeer::CA_AVISO, '%Como requisito indispensable para efectuar el OTM necesitamos los siguientes documentos:%', Criteria::NOT_LIKE );
         */


        //$c->setLimit( 100 );
        $c->addAscendingOrderByColumn(InoAvisosSeaPeer::CA_FCHENVIO);
        $avisos = InoAvisosSeaPeer::doSelect($c);

        //echo "-----------> count avisos ".count( $avisos )." <-";
        $file = "d:\\logCrearStatusMaritimo.txt";
        $fp = fopen($file, 'w+');
        $i = 0;
        foreach ($avisos as $aviso) {
            $inoCliente = $aviso->getInoClientesSea();
            if ($inoCliente) {
                $reporte = $inoCliente->getReporte();
                $referencia = $inoCliente->getInoMaestraSea();
                if ($reporte) {
                    $texto = $aviso->getCaAviso();
                    $email = $aviso->getEmail();
                    if ($email && strpos($email->getCaSubject(), "Confirmación de Llegada")!==false) {
                        $texto = "La MN " . ($referencia->getCaMnLlegada() ? $referencia->getCaMnLlegada() : $referencia->getCaMotonave()) . " arribó a " . $referencia->getDestino()->getCaCiudad() . ", el dia " . Utils::fechaMes($referencia->getCaFchconfirmacion()) . " con la orden en referencia a bordo.\n" . ucfirst($inoCliente->getCamensaje());

                        $idetapa = "IMCOL";
                    } else {
                        break;
                        if (strpos($texto, "Confirmamos cierre y finalización de los documentos del proceso de OTM")!==false) {
                            $idetapa = "99999";
                        } elseif (strpos($texto, "Confirmamos el cargue y despacho de la")!==false) {
                            $idetapa = "IMCMP";
                        } elseif (strpos($texto, "Informamos que los documentos correspondientes al trámite OTM")!==false) {
                            $idetapa = "IMPOD";
                        } else {
                            $idetapa = "88888";
                        }
                    }

                    if (strlen($texto) > 3) {
                        echo "<br />  " . ($i++) . " " . $idetapa . " " . $texto;
                        $status = new RepStatus();
                        $status->setCaIdetapa($idetapa);
                        $status->setCaIdReporte($reporte->getCaIdreporte());
                        $status->setCaStatus($texto);

                        $ultimostatus = $reporte->getUltimoStatus();
                        if ($ultimostatus) {
                            $status->setCaPiezas($ultimostatus->getCaPiezas());
                            $status->setCaPeso($ultimostatus->getCaPeso());
                            $status->setCaVolumen($ultimostatus->getCaVolumen());
                            $status->setCaFchsalida($ultimostatus->getCaFchsalida());
                            $status->setCaFchcontinuacion($ultimostatus->getCaFchcontinuacion());
                            if ($idetapa=="IMCOL") {
                                $status->setCaIdnave(($referencia->getCaMnLlegada() ? $referencia->getCaMnLlegada() : $referencia->getCaMotonave()));
                                $status->setCaFchllegada($referencia->getCaFchconfirmacion());
                            } else {
                                $status->setCaIdnave($ultimostatus->getCaIdnave());
                                $status->setCaFchllegada($ultimostatus->getCaFchllegada());
                            }
                        }

                        $status->setCaIdemail($aviso->getCaIdemail());
                        $status->setCaFchenvio($aviso->getCaFchenvio());
                        $status->setCausuenvio($aviso->getCaUsuenvio());
                        $status->setCaFchStatus($aviso->getCaFchaviso());
                        $status->save();
                        fwrite($fp, $aviso->getCaReferencia() . " " . $status->getCaIdstatus() . "\r\n");
                    }
                }
            }
        }
        fclose($fp);
    }

    /*
     *  Este procedimiento crea un status de cierre en cada uno de los reportes que ya
     *  se confirmaron
     */

    public function executeActFchStatus() {
        set_time_limit(0);
        exit();
        $c = new Criteria();
        $c->addJoin(ReportePeer::CA_IDREPORTE, RepStatusPeer::CA_IDREPORTE);
        $c->add(RepStatusPeer::CA_FCHENVIO, '2009-05-01', Criteria::GREATER_EQUAL);
        $c->addHaving($c->getNewCriterion(RepStatusPeer::CA_FCHENVIO, RepStatusPeer::CA_FCHENVIO . '=max(' . RepStatusPeer::CA_FCHENVIO . ')', Criteria::CUSTOM));

        $c->addGroupByColumn(RepStatusPeer::CA_IDSTATUS);
        $c->addGroupByColumn(RepStatusPeer::CA_IDREPORTE);
        $c->addGroupByColumn(RepStatusPeer::CA_IDEMAIL);
        $c->addGroupByColumn(RepStatusPeer::CA_FCHSTATUS);
        $c->addGroupByColumn(RepStatusPeer::CA_STATUS);
        $c->addGroupByColumn(RepStatusPeer::CA_COMENTARIOS);
        $c->addGroupByColumn(RepStatusPeer::CA_ETAPA);
        $c->addGroupByColumn(RepStatusPeer::CA_FCHRECIBO);
        $c->addGroupByColumn(RepStatusPeer::CA_FCHENVIO);
        $c->addGroupByColumn(RepStatusPeer::CA_USUENVIO);
        $c->addGroupByColumn(RepStatusPeer::CA_INTRODUCCION);
        $c->addGroupByColumn(RepStatusPeer::CA_FCHSALIDA);
        $c->addGroupByColumn(RepStatusPeer::CA_FCHLLEGADA);
        $c->addGroupByColumn(RepStatusPeer::CA_FCHCONTINUACION);
        $c->addGroupByColumn(RepStatusPeer::CA_PIEZAS);
        $c->addGroupByColumn(RepStatusPeer::CA_PESO);
        $c->addGroupByColumn(RepStatusPeer::CA_VOLUMEN);
        $c->addGroupByColumn(RepStatusPeer::CA_DOCTRANSPORTE);
        $c->addGroupByColumn(RepStatusPeer::CA_DOCMASTER);
        $c->addGroupByColumn(RepStatusPeer::CA_IDNAVE);
        $c->addGroupByColumn(RepStatusPeer::CA_EQUIPOS);
        $c->addGroupByColumn(RepStatusPeer::CA_HORASALIDA);
        $c->addGroupByColumn(RepStatusPeer::CA_HORALLEGADA);
        $c->addGroupByColumn(RepStatusPeer::CA_IDETAPA);
        $c->addGroupByColumn(RepStatusPeer::CA_PROPIEDADES);
        $status = RepStatusPeer::doSelect($c);

        foreach ($status as $status) {
            $reporte = $status->getReporte();
            if ($status->getCaFchenvio()) {
                echo $reporte->getCaConsecutivo() . " ult " . $reporte->getCaFchUltstatus() . " " . $status->getCaFchenvio() . "<br />";
                $reporte->setCaFchUltstatus($status->getCaFchenvio());
                $reporte->save();
            }
        }
    }

    /*
     *  coloca la etapa actual y la ultima actualizacion
     */

    public function executeActualizarEtapa() {
        set_time_limit(0);
        $c = new Criteria();
        $c->add(ReportePeer::CA_IDETAPA, null, Criteria::ISNULL);
        $c->addAscendingOrderByColumn(ReportePeer::CA_IDREPORTE);
        //$c->setLimit(1000);
        $reportes = ReportePeer::doSelect($c);
        foreach ($reportes as $reporte) {
            if ($reporte->esUltimaVersion()) {
                $ultimoStatus = $reporte->getUltimoStatus();

                if ($ultimoStatus) {
                    if ($reporte->getCaEtapaActual()=="Carga Entregada") {
                        $reporte->setCaIdetapa("99999");
                    } else {
                        $reporte->setCaIdetapa($ultimoStatus->getCaIdetapa());
                    }
                    $reporte->setCaFchultstatus($ultimoStatus->getCaFchenvio());
                    $reporte->save();
                } else {
                    if ($reporte->getCaEtapaActual()=="Carga Entregada" || $reporte->getCaEtapaActual()=="Carga en Aeropuerto de Destino") {
                        $reporte->setCaIdetapa("99999");
                    }

                    if ($reporte->getCaEtapaActual()=="Contacto con nuestro Agente" &&
                            $reporte->getCaTransporte()=="Aéreo") {
                        $reporte->setCaIdetapa("IACAG");
                    }

                    if ($reporte->getCaEtapaActual()=="Contacto con nuestro Agente" &&
                            $reporte->getCaTransporte()=="Marítimo") {
                        $reporte->setCaIdetapa("IMCAG");
                    }
                    $reporte->save();
                }

                if (!$reporte->getCaUsuanulado()) {
                    echo $reporte->getcaConsecutivo() . " " . $reporte->getCaIdetapa() . " " . $reporte->getCaEtapaActual() . "<br />";
                }
            }
        }
    }

    /******************************************************************
 *
     *  Crea sentencias SQL Para crear foreign key en todos los
     *  campos usucreado usuactualizado
     *
	***************************************************************** */

    public function executeCrearFKUsuarios() {
        $sql = "SELECT * FROM information_schema.columns
where (column_name like 'ca_login%' ) and table_name like 'tb_%' and table_schema = 'public'";

        $con = Propel::getConnection(TasaAlaicoPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {

            $sql = "ALTER TABLE " . $row['table_name'] . "
  ADD CONSTRAINT fk_" . $row['table_name'] . "_tbusuarios_" . $row['column_name'] . " FOREIGN KEY (" . $row['column_name'] . ")
      REFERENCES control.tb_usuarios (ca_login) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION;";
            echo $sql . "<br />";
        }

        return sfView::NONE;
    }

    /*
     * Unifica dos opciones del programa en una sola y copia los permisos de la anterior en la nueva.
     */

    public function executeUnificarPermisos() {

        $c = new Criteria();
        $c->addJoin(UsuarioPeer::CA_LOGIN, AccesoUsuarioPeer::CA_LOGIN);
        $c->addJoin(AccesoUsuarioPeer::CA_RUTINA, 40);
        $usuarios = UsuarioPeer::doSelect($c);

        foreach ($usuarios as $usuario) {
            $permiso = AccesoUsuarioPeer:: retrieveByPk(43, $usuario->getCaLogin());

            if (!$permiso) {
                $permiso = new AccesoUsuario();
                $permiso->setCaLogin($usuario->getCaLogin());
                $permiso->setCaRutina(43);
                $permiso->setCaAcceso(0);
                echo $usuario->getCaLogin() . "<br />";
                $permiso->save();
            }
        }

        return sfView::NONE;
    }

    /*
     * Crea una tarea para cada ticket.
     */

    public function executeAsignarTareaHelpdesk($request ) {
        exit();
        set_time_limit(0);
        $c = new Criteria();
        $c->add(HdeskTicketPeer::CA_IDTAREA, null, Criteria::ISNULL);
        $c->addAscendingOrderByColumn(HdeskTicketPeer::CA_IDTICKET);
        $tickets = HdeskTicketPeer::doSelect($c);

        foreach ($tickets as $ticket) {

            $request->setParameter("id", $ticket->getCaIdticket());
            $request->setParameter("format", "email");
            $titulo = "Nuevo Ticket #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]";

            $texto = "Se ha creado un nuevo ticket \n\n<br /><br />";
            $texto.= sfContext::getInstance()->getController()->getPresentationFor('helpdesk', 'verTicket');

            $grupo = $ticket->getHdeskGroup();

            $tarea = new NotTarea();
            $tarea->setCaUrl("/helpdesk/verTicket?id=" . $ticket->getCaIdticket());
            $tarea->setCaIdlistatarea(1);
            $tarea->setCaFchcreado($ticket->getCaOpened());
            $tarea->setTiempo(TimeUtils::getFestivos(), $grupo->getCaMaxresponsetime());

            if ($ticket->getCaResponsetime()) {
                $tarea->setCaFchterminada($ticket->getCaResponsetime());
            }

            $tarea->setCaUsucreado($ticket->getCaLogin());
            $tarea->setCaTitulo($titulo);
            $tarea->setCaTexto($texto);
            $tarea->save();

            $ticket->setCaIdtarea($tarea->getCaIdtarea());
            $ticket->save();

            if ($ticket->getCaAssignedTo()) {
                $tarea->setAsignaciones(array($ticket->getCaAssignedTo()));
            } else {
                $loginsAsignaciones = $ticket->getLoginsGroup();
                $tarea->setAsignaciones($loginsAsignaciones);
            }
        }
        $this->setTemplate("blank");

        /**/
    }

    /*
     * Tareas de backup que ya se cumplieron
     */

    public function executeQuitarTareasSrThomas() {

        exit();
        $c = new Criteria();
        $c->addJoin(NotTareaAsignacionPeer::CA_IDTAREA, NotTareaPeer::CA_IDTAREA);
        $c->add(NotTareaAsignacionPeer::CA_LOGIN, 'tpeters');
        $c->add(NotTareaPeer::CA_FCHTERMINADA, NULL, Criteria::ISNULL);
        $c->setDistinct();
        $tareas = NotTareaPeer::doSelect($c);

        foreach ($tareas as $tarea) {
            echo $tarea->getCaIdtarea() . "<br />";
            $tarea->setCaFchterminada($tarea->getCaFchvencimiento());
            $tarea->save();
        }
        $this->setTemplate("blank");
    }

    /*
     *
     */

    public function executeCrearTareasCotizaciones1erTrimestre() {
        exit();
        set_time_limit(0);
        $c = new Criteria();
        $c->add(CotizacionPeer::CA_CONSECUTIVO, '%2009', Criteria::LIKE);
        $c->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, null, Criteria::ISNOTNULL);
        $c->add(CotizacionPeer::CA_USUANULADO, null, Criteria::ISNOTNULL);

        //$c->add( CotizacionPeer::CA_FCHCREADO, '2009-04-01', Criteria::GREATER_EQUAL );

        $c->addAscendingOrderByColumn(CotizacionPeer::CA_IDCOTIZACION);
        $cotizaciones = CotizacionPeer::doSelect($c);

        foreach ($cotizaciones as $cotizacion) {
            echo $cotizacion->getCaConsecutivo() . "<br />";
            $tarea = $cotizacion->getTareaIDGEnvioOportuno();
            $tarea->delete();
            /* if( $cotizacion->getCafchSolicitud() ){
             * fchCreado = $cotizacion->getCafchSolicitud()." ".$cotizacion->getCaHoraSolicitud();
             * else{
             * fchCreado = $cotizacion->getCaFchcreado( );
             }
             * tarea = $cotizacion->crearTareaIDGEnvioOportuno( $fchCreado );
             * f( $tarea ){
             * f( $cotizacion->getCaFchpresentacion( ) ){
             * tarea->setCaFchterminada( $cotizacion->getCaFchpresentacion() );
             }
             * /else{
             * /	$tarea->setCaFchterminada( $tarea->getCaFchvencimiento() );
             * /}
             * tarea->save();
             } */
        }

        $this->setTemplate("blank");
    }

    /*
     * ista de los permisos de los usuarios
     */

    public function executeListaOpciones() {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(RutinaPeer::CA_GRUPO);
        $this->opciones = RutinaPeer::doSelect($c);
    }

    /*
     * ctualiza la etapa en las cotizaciones
     */

    public function executeActEtapaCotizaciones() {
        set_time_limit(0);
        $c = new Criteria();
        $c->add(CotProductoPeer::CA_ESTADO, null, Criteria::ISNOTNULL);
        $c->add(CotProductoPeer::CA_ETAPA, null, Criteria::ISNULL);
        $productos = CotProductoPeer::doSelect($c);

        foreach ($productos as $producto) {

            switch ($producto->getCaEstado()) {
                case "En seguimiento  ":
                    $etapa = "SEG";
                    break;
                case "Negocio asignado":
                    $etapa = "APR";
                    break;
                case "No aprobada     ":
                    $etapa = "NAP";
                    break;
            }

            if ($etapa!="SEG") {

                $cotizacion = $producto->getCotizacion();
                $seguimiento = new CotSeguimiento();
                $seguimiento->setCaIdcotizacion($producto->getCaIdcotizacion());
                $seguimiento->setCaIdproducto($producto->getCaIdproducto());
                $seguimiento->setCaLogin($cotizacion->getCausuario());
                $seguimiento->setCaFchseguimiento(time());
                if ($producto->getCaMotivonoaprobado()) {
                    $seguimiento->setCaSeguimiento($producto->getCaMotivonoaprobado());
                }



                $seguimiento->setCaEtapa($etapa);
                $seguimiento->save();
            }
            $producto->setCaEtapa($etapa);
            $producto->save();
        }

        $this->setTemplate("blank");
    }

    public function executeFixFchconfirmacion() {
        $sql = "select * from tb_repstatus inner join tb_inoavisos_sea on tb_repstatus.ca_idemail = tb_inoavisos_sea.ca_idemail
	inner join tb_inomaestra_sea on tb_inoavisos_sea.ca_referencia = tb_inomaestra_sea.ca_referencia

where tb_repstatus.ca_fchllegada is null and ca_idetapa='IMCPD' 
ORDER BY ca_fchstatus ";


        $con = Propel::getConnection(ReportePeer::DATABASE_NAME);

        $stmt = $con->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            $status = RepStatusPeer::retrieveByPk($row['ca_idstatus']);
            $status->setCaFchllegada($row['ca_fchconfirmacion']);
            $status->save();


            echo "OK " . $row['ca_idstatus'] . " fchllegada " . $row['ca_fchllegada'] . " " . " fchconfirmacion " . $row['ca_fchconfirmacion'] . "<br />";
        }

        $this->setTemplate("blank");
    }

    public function executeCopiarPermisosGrupo() {

        $c = new Criteria();
        $c->addDescendingOrderByColumn(AccesoGrupoPeer::CA_ACCESO);
        $accesosGrupo = AccesoGrupoPeer::doSelect($c);

        foreach ($accesosGrupo as $accesoGrupo) {

            $c = new Criteria();
            $c->add(UsuarioGrupoPeer::CA_GRUPO, $accesoGrupo->getCaGrupo());
            $usuarios = UsuarioGrupoPeer::doSelect($c);

            foreach ($usuarios as $usuario) {
                $accesoUsuario = AccesoUsuarioPeer::retrieveByPk($accesoGrupo->getCaRutina(), $usuario->getcaLogin());
                if (!$accesoUsuario) {
                    $accesoUsuario = new AccesoUsuario();
                    $accesoUsuario->setCaLogin($usuario->getcaLogin());
                    $accesoUsuario->setCaRutina($accesoGrupo->getCaRutina());
                    $accesoUsuario->setCaAcceso($accesoGrupo->getCaAcceso());
                    $accesoUsuario->save();

                    echo "Grupo:  " . $accesoGrupo->getCaGrupo() . " Rutina " . $accesoGrupo->getCaRutina() . " " . $accesoGrupo->getCaAcceso() . " " . $usuario->getcaLogin() . "<br />";
                }
            }
            //$accesoGrupo->delete();
        }
    }

    public function executeFixTareasReportes() {
        exit("OK");

        $sql = "select * from notificaciones.tb_tareas left join  tb_reportes on ca_idtarea = ca_idseguimiento where ca_idlistatarea = 3 and ca_idreporte is null";


        $con = Propel::getConnection(ReportePeer::DATABASE_NAME);

        $stmt = $con->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            /* $status = RepStatusPeer::retrieveByPk( $row['ca_idtarea'] );
             * status->setCaFchllegada($row['ca_fchconfirmacion']);
             * status->save();
             */

            $consreporte = substr($row['ca_titulo'], strpos($row['ca_titulo'], "RN") + 2, 9);
            $reporte = ReportePeer::retrieveByConsecutivo($consreporte);
            if (!$reporte->getCaidseguimiento()) {
                echo "OK " . $row['ca_idtarea'] . " " . $consreporte . " " . $row['ca_titulo'] . "<br />";
                $reporte->setCaIdseguimiento($row['ca_idtarea']);
                $reporte->save();
            } else {
                echo "NO " . $row['ca_idtarea'] . " " . $consreporte . " " . $row['ca_titulo'] . "<br />";
                $tarea = NotTareaPeer::retrieveByPk($row['ca_idtarea']);
                //$tarea->delete();
            }
        }

        $this->setTemplate("blank");
    }

    public function executeFixApellidoContactos() {
        exit();
        $c = new Criteria();
        $c->add(ContactoAgentePeer::CA_APELLIDO, null, Criteria::ISNULL);
        //$c->add( ContactoAgentePeer::CA_IMPOEXPO, '%Importación%', Criteria::LIKE );
        $c->addAscendingOrderByColumn(CA_TRANSPORTE); //ca_impoexpo like '%Importación%' and ca_apellido is null
        $contactos = ContactoAgentePeer::doSelect($c);

        foreach ($contactos as $contacto) {
            $nombreComp = $contacto->getCaNombre();

            $array = explode(" ", trim($nombreComp));
            if (count($array) ==2) {
                $nombre = ucfirst(trim($array[1]));
                $apellido = ucfirst(trim($array[0]));

                $contacto->setCaNombre($nombre);
                $contacto->setCaApellido($apellido);
                //$contacto->save();
                echo "<b>OK </b>" . $nombreComp . " <b>Nombre:</b> $nombre <b>Apellido:</b> $apellido<br />";
            } else {
                $agente = $contacto->getAgente();
                echo str_replace("|", " ", $contacto->getCaTransporte()) . " " . $agente . " " . $nombreComp . "<br />";
            }
        }
    }

    public function executeImportarTransportistas($request ) {
        exit("Ya importados");
        $c = new Criteria();
        $c->addAscendingOrderByColumn(TransportistaPeer::CA_NOMBRE);
        $transportistas = TransportistaPeer::doSelect($c);

        $j = 228;
        foreach ($transportistas as $transportista) {

            $lineas = $transportista->getTransportadors();

            $id = null;
            foreach ($lineas as $linea) {

                if ($linea->getCaNombre()==$transportista->getCaNombre()) {
                    $id = $linea->getCaidlinea();
                }
            }

            if (!$id) {
                $id = $j;
                $j++;
            }

            echo $id . " " . $transportista->getCaNombre() . "<br />";

            $ids = new Ids();
            $ids->setCaId($id);
            $ids->setCaIdgrupo($id);



            $ids->setCaIdalterno($transportista->getCaIdTransportista());

            $ids->setCaTipoidentificacion(1);
            $ids->setCaDv($transportista->getCaDigito());
            $ids->setCaNombre($transportista->getCaNombre());

            if ($transportista->getCaWebsite()) {
                $ids->setCaWebsite($transportista->getCaWebsite());
            }

            $ids->save();


            $idgrupo = $j;
            $nomGrupo = $transportista->getCaNombre();

            $proveedor = new IdsProveedor();
            $proveedor->setCaTipo("TRI");
            $proveedor->setCaIdproveedor($ids->getCaId());
            $proveedor->setCaCritico(false);
            $proveedor->setCaControladoporsig(false);
            $proveedor->save();

            $sucursal = new IdsSucursal();
            $sucursal->setCaId($ids->getcaId());
            $sucursal->setCaIdciudad($transportista->getcaIdciudad());
            $sucursal->setCaDireccion($transportista->getCaDireccion());
            $sucursal->setCaTelefonos($transportista->getCaTelefonos());
            $sucursal->setCaFax($transportista->getCaFax());
            $sucursal->setCaPrincipal(true);
            $sucursal->save();

            $transContactos = $transportista->getTransContactos();
            foreach ($transContactos as $transContacto) {
                $contacto = new IdsContacto();
                $nombres = explode(" ", $transContacto->getCaNombre());

                if (count($nombres)==2) {
                    $nombre = $nombres[0];
                    $apellido = $nombres[1];
                } elseif (count($nombres)==3) {
                    $nombre = $nombres[0] . " " . $nombres[1];
                    $apellido = $nombres[2];
                } else {
                    $nombre = $transContacto->getCaNombre();
                    $apellido = "";
                }

                $contacto->setCaNombres(ucwords($nombre));
                $contacto->setCaPapellido(ucwords($apellido));
                $contacto->setCaIdsucursal($sucursal->getcaIdsucursal());
                $contacto->setCaActivo(true);
                $contacto->setCaEmail($transContacto->getCaEmail());
                $contacto->setCaTelefonos($transContacto->getCaTelefonos());
                $contacto->setCaFax($transContacto->getCaFax());
                $contacto->setCaObservaciones($transContacto->getCaObservaciones());
                $contacto->save();
            }

            $idGrupo = $ids->getCaId();
            foreach ($lineas as $linea) {

                if ($linea->getCaNombre()!=$transportista->getCaNombre()) {
                    $id = $linea->getCaidlinea();

                    $ids = new Ids();
                    $ids->setCaId($linea->getCaIdlinea());
                    $ids->setCaNombre($linea->getCaNombre());
                    $ids->setCaTipoidentificacion(3);

                    $ids->setCaIdgrupo($idGrupo);

                    $ids->save();

                    echo " Grupo: " . $idGrupo . " " . $linea->getCaNombre() . " <br>";

                    $proveedor = new IdsProveedor();
                    $proveedor->setCaTipo("TRI");
                    $proveedor->setCaIdproveedor($ids->getCaId());
                    $proveedor->setCaCritico(false);
                    $proveedor->setCaControladoporsig(false);
                    $proveedor->setCaSigla($linea->getCaSigla());
                    $proveedor->setCaTransporte($linea->getCaTransporte());
                    $proveedor->save();
                }
            }
        }


        $this->setTemplate("blank");
    }

    public function executeFixIdAgentes() {

        $i = 282;

        $c = new Criteria();
        $c->addAscendingOrderByColumn(AgentePeer::CA_NOMBRE);
        //$c->add( AgentePeer::CA_IDAGENTE, 400056103 );
        $agentes = AgentePeer::doSelect($c);
        foreach ($agentes as $agente) {
            $sql = "UPDATE tb_agentes SET ca_idagente='" . $i . "' WHERE ca_idagente='" . $agente->getCaIdagente() . "'";
            echo $sql . ";<br />";
            $i++;
        }
        $this->setTemplate("blank");
    }

    public function executeImportarAgentes() {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(AgentePeer::CA_NOMBRE);
        //$c->add( AgentePeer::CA_IDAGENTE, 400056103 );
        $agentes = AgentePeer::doSelect($c);

        //$i = 280;

        foreach ($agentes as $agente) {
            $ids = new Ids();

            $i = $agente->getCaIdagente();

            //$ids->setCaId( $agente->getCaIdagente() );
            $ids->setCaId($i);

            $ids->setCaTipoidentificacion(3);
            $ids->setCaDv(null);
            $ids->setCaNombre($agente->getCaNombre());

            if ($agente->getCaWebsite()) {
                $ids->setCaWebsite($agente->getCaWebsite());
            }


            $ids->setCaIdgrupo($ids->getCaId());

            $ids->setCaFchcreado($agente->getCaFchcreado());
            $ids->setCaUsucreado($agente->getCaUsucreado());
            $ids->setCaFchactualizado($agente->getCaFchactualizado());
            $ids->setCaUsuactualizado($agente->getCaUsuactualizado());
            $ids->save();
            $idsAgente = new IdsAgente();
            $idsAgente->setCaTipo($agente->getCaTipo());
            $idsAgente->setCaIdagente($ids->getCaId());
            if ($agente->getCaActivo()) {
                $idsAgente->setCaActivo(true);
            } else {
                $idsAgente->setCaActivo(false);
            }
            $idsAgente->save();


            $ult = null;

            $c = new Criteria();
            $c->addAscendingOrderByColumn(ContactoAgentePeer::CA_IDCIUDAD);
            $transContactos = $agente->getContactoAgentes($c);


            if (count($transContactos)==0) {
                $sucursal = new IdsSucursal();
                $sucursal->setCaId($ids->getCaId());
                $sucursal->setCaIdciudad($agente->getCaIdciudad());
                $sucursal->setCaPrincipal(true);
                $sucursal->setCaDireccion($agente->getCaDireccion());
                $sucursal->setCaTelefonos($agente->getCaTelefonos());
                $sucursal->setCaFax($agente->getCaFax());
                $sucursal->setCaZipcode($agente->getCaZipcode());
                $sucursal->save();
            }

            foreach ($transContactos as $transContacto) {

                if ($ult!=$transContacto->getCaIdciudad()) {
                    $ult = $transContacto->getCaIdciudad();
                    $sucursal = new IdsSucursal();
                    $sucursal->setCaId($ids->getcaId());
                    $sucursal->setCaIdciudad($transContacto->getCaIdciudad());

                    if ($transContacto->getCaIdciudad()==$agente->getCaIdciudad()) {
                        $sucursal->setCaPrincipal(true);

                        $sucursal->setCaDireccion($agente->getCaDireccion());
                        $sucursal->setCaTelefonos($agente->getCaTelefonos());
                        $sucursal->setCaFax($agente->getCaFax());
                        $sucursal->setCaZipcode($agente->getCaZipcode());
                    } else {
                        $sucursal->setCaPrincipal(false);
                        $sucursal->setCaDireccion($transContacto->getCaDireccion());
                        $sucursal->setCaTelefonos($transContacto->getCaTelefonos());
                        $sucursal->setCaFax($transContacto->getCaFax());
                    }
                    $sucursal->save();
                }

                $contacto = new IdsContacto();

                $contacto->setCaIdcontacto($transContacto->getCaIdcontacto());
                $contacto->setCaNombres(ucwords($transContacto->getCaNombre()));
                $contacto->setCaPapellido(ucwords($transContacto->getCaApellido()));
                $contacto->setCaIdsucursal($sucursal->getcaIdsucursal());
                if ($transContacto->getCaActivo()) {
                    $contacto->setCaActivo(true);
                } else {
                    $contacto->setCaActivo(false);
                }

                if ($transContacto->getCaSugerido()) {
                    $contacto->setCaSugerido(true);
                } else {
                    $contacto->setCaSugerido(false);
                }
                $contacto->setCaEmail($transContacto->getCaEmail());
                $contacto->setCaTelefonos($transContacto->getCaTelefonos());
                $contacto->setCaFax($transContacto->getCaFax());
                $contacto->setCaDireccion($transContacto->getCaDireccion());
                $contacto->setCaObservaciones($transContacto->getCaDetalle());
                $contacto->setCaCargo($transContacto->getCaCargo());
                $contacto->setCaImpoexpo($transContacto->getCaImpoexpo());
                $contacto->setCaTransporte($transContacto->getCaTransporte());


                $contacto->setCaFchcreado($transContacto->getCaFchcreado());
                $contacto->setCaUsucreado($transContacto->getCaUsucreado());
                $contacto->setCaFchactualizado($transContacto->getCaFchactualizado());
                $contacto->setCaUsuactualizado($transContacto->getCaUsuactualizado());

                $contacto->save();
            }
        }
        $this->setTemplate("blank");
    }

    public function executeFixContactoCotizaciones() {
        set_time_limit(0);
        /* $idContactos = array();
         * c = new Criteria();
         * contactosAg = ContactoAgentePeer::doSelect($c);
         * oreach( $contactosAg as $contacto ){
         * idContactos[$contacto->getCaIdcontacto()] = $contacto->getCaId
         } */
        $c = new Criteria();
        $c->addDescendingOrderByColumn(CotizacionPeer::CA_IDCOTIZACION);
        $c->add(CotizacionPeer::CA_DATOSAG, null, Criteria::ISNOTNULL);
        $c->addJoin(CotizacionPeer::CA_IDCOTIZACION, CotContactoAgPeer::CA_IDCOTIZACION, Criteria::LEFT_JOIN);
        $c->add(CotContactoAgPeer::CA_IDCOTIZACION, null, Criteria::ISNULL);
        //32307

        $cotizaciones = CotizacionPeer::doSelect($c);

        foreach ($cotizaciones as $cotizacion) {
            $datosAg = array_unique(explode("|", $cotizacion->getCaDatosag()));
            //print_r( $datosAg );
            foreach ($datosAg as $ag) {
                echo $cotizacion->getCaIdcotizacion() . " " . $ag . "<br />";
                $cont = CotContactoAgPeer::retrieveByPk($cotizacion->getCaIdcontacto(), $ag);
                if (!$cont) {
                    $cont = new CotContactoAg();
                }
                $cont->setCaIdCotizacion($cotizacion->getCaIdcotizacion());
                $cont->setCaIdContacto($ag);
                try {
                    $cont->save();
                } catch (Exception $e) {
                    echo "-->" . $e . "<br />";
                }
            }
        }
        $this->setTemplate("blank");
    }

    public function executeFixIdcontactoAgentes() {
        $c = new Criteria();

        $c->addAscendingOrderByColumn(ContactoAgentePeer::CA_IDCONTACTO . "");
        $c->addAscendingOrderByColumn(ContactoAgentePeer::CA_IDAGENTE);
        $c->addAscendingOrderByColumn(ContactoAgentePeer::CA_NOMBRE);
        $contactos = ContactoAgentePeer::doSelect($c);
        $i = 118;
        foreach ($contactos as $contacto) {
            $sql = "UPDATE tb_contactos SET ca_idcontacto='" . $i . "' WHERE ca_idcontacto='" . $contacto->getCaIdcontacto() . "'";
            echo $sql . ";<br />";
            $i++;
        }
        $this->setTemplate("blank");
    }

    /*
     * Borra tareas pendientes de reportes anulados o cerrados
     */

    public function executeFixTareasPendientes() {
        $this->setTemplate("blank");
        /*
         * c = new Criteria();
         * c->addJoin(  ReportePeer::CA_IDSEGUIMIENTO, NotTareaPeer::CA_IDTAREA );
         * c->add( ReportePeer::CA_FCHANULADO, null , Criteria::ISNOTNULL );
         * c->add( NotTareaPeer::CA_FCHVENCIMIENTO, null , Criteria::ISNOTNULL );
         * tareas = NotTareaPeer::doSelect( $c );
         * oreach( $tareas as  $tarea ){
         * cho $tarea->getCaTitulo()."<br />";
         * tarea->setCaFchterminada(time());
         * tarea->save();
         } */

        $c = new Criteria();
        $c->addJoin(ReportePeer::CA_IDSEGUIMIENTO, NotTareaPeer::CA_IDTAREA);
        $c->add(ReportePeer::CA_IDETAPA, "99999");
        $c->add(NotTareaPeer::CA_FCHVENCIMIENTO, null, Criteria::ISNOTNULL);

        $tareas = NotTareaPeer::doSelect($c);

        foreach ($tareas as $tarea) {
            echo $tarea->getCaTitulo() . "<br />";
            $tarea->setCaFchterminada(time());
            $tarea->save();
        }
    }

    public function executeDelDotSvn() {


        echo "/home/abotero/Desarrollo/colsys_sf3.orig";
        /*
         * files = sfFinder::type('dir')->in('/home/abotero/Desarrollo/colsys_sf3.orig');;
         * oreach ($files as $file){
         * f( is_dir($file."/.svn") ){
         * /echo shell_exec("rm -rf ".$file."/.svn")."<br />";
         * cho "rm -rf ".$file."/.svn<br />";
         }
         } */
        //$this->setTemplate("blank");
    }

    /*
     *  Se modifico el programa de tal manera que idopcion fuera la llave primaria
     */

    public function executeFixCotOpciones() {

        exit();
        $sql = "SELECT DISTINCT ca_idcotizacion, ca_idopcion FROM tb_cotopciones
WHERE ca_idopcion In
(SELECT ca_idopcion FROM tb_cotopciones As asd
GROUP BY ca_idopcion HAVING Count(*) > 1 )
ORDER BY ca_idopcion ";
        $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $lastIdopcion = null;

        $this->setTemplate("blank");

        while ($row = $stmt->fetch()) {
            $idcotizacion = $row['ca_idcotizacion'];
            $idopcion = $row['ca_idopcion'];



            if ($lastIdopcion != $idopcion) {
                $lastIdopcion = $idopcion;
            } else {


                echo $idcotizacion . " " . $idopcion . "<br />";

                $sql = "SELECT nextval('tb_cotopciones_id') as next";
                $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);

                $stmt2 = $con->prepare($sql);
                $stmt2->execute();

                $row2 = $stmt2->fetch();

                $nextval = $row2["next"];

                $sql = "UPDATE tb_cotopciones SET ca_idopcion= $nextval WHERE ca_idcotizacion = $idcotizacion AND ca_idopcion = $idopcion";
                $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
                $stmt2 = $con->prepare($sql);
                $stmt2->execute();


                $sql = "UPDATE tb_cotrecargos SET ca_idopcion= $nextval WHERE ca_idcotizacion = $idcotizacion AND ca_idopcion = $idopcion";
                $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
                $stmt2 = $con->prepare($sql);
                $stmt2->execute();
            }
        }
    }

    /*
     *  Se modifico el programa de tal manera que idopcion fuera la llave primaria
     */

    public function executeFixCotProductos() {

        exit();
        $sql = "SELECT DISTINCT ca_idcotizacion, ca_idproducto  FROM tb_cotproductos
WHERE ca_idproducto In
(SELECT ca_idproducto FROM tb_cotproductos As asd
GROUP BY ca_idproducto HAVING Count(*) > 1 )
ORDER BY ca_idproducto";
        $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $lastIdproducto = null;

        $this->setTemplate("blank");

        while ($row = $stmt->fetch()) {
            $idcotizacion = $row['ca_idcotizacion'];
            $idproducto = $row['ca_idproducto'];



            if ($lastIdproducto != $idproducto) {
                $lastIdproducto = $idproducto;
            } else {


                echo $idcotizacion . " " . $idproducto . "<br />";

                $sql = "SELECT nextval('tb_cotproductos_id') as next";
                $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);

                $stmt2 = $con->prepare($sql);
                $stmt2->execute();

                $row2 = $stmt2->fetch();

                $nextval = $row2["next"];

                $sql = "UPDATE tb_cotproductos SET ca_idproducto= $nextval WHERE ca_idcotizacion = $idcotizacion AND ca_idproducto = $idproducto";
                $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
                $stmt2 = $con->prepare($sql);
                $stmt2->execute();


                $sql = "UPDATE tb_cotrecargos SET ca_idproducto= $nextval WHERE ca_idcotizacion = $idcotizacion AND ca_idproducto = $idproducto";
                $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
                $stmt2 = $con->prepare($sql);
                $stmt2->execute();
            }
        }
    }

    /*
     * Se perdieron unos datos por la actualización de uno datos
     */

    public function executeFixEtapaReportes() {
        exit("Quedo OK");
        $sql = "SELECT * from tb_repstatus WHERE ca_fchenvio>='2009-09-07'";
        $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $lastIdopcion = null;

        $this->setTemplate("blank");
        $i = 0;
        while ($row = $stmt->fetch()) {
            echo $i . " " . $row['ca_idetapa'] . " " . $row['ca_idstatus'] . "<br />";

            $etapa = $row['ca_idetapa'];

            $sql = "UPDATE tb_repstatus SET ca_idetapa = '88888' WHERE ca_idstatus='" . $row['ca_idstatus'] . "'";
            $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
            //echo $sql;
            $stmt2 = $con->prepare($sql);
            $stmt2->execute();

            $sql = "UPDATE tb_repstatus SET ca_idetapa = '" . $etapa . "' WHERE ca_idstatus='" . $row['ca_idstatus'] . "'";
            $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);

            $stmt2 = $con->prepare($sql);
            $stmt2->execute();



            $i++;
        }
    }

    public function executeImportArchivosTarifario() {

        $c = new Criteria();
        $archivos = PricArchivoPeer::doSelect($c);

        foreach ($archivos as $archivo) {
            $folder = "Tarifario" . DIRECTORY_SEPARATOR . substr($archivo->getCaImpoexpo(), 0, 1) . "_" . substr($archivo->getCaTransporte(), 0, 1) . "_" . $archivo->getCaModalidad() . "_" . $archivo->getCaIdtrafico();
            $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }
            $filename = $directory . $archivo->getCaNombre();

            echo $filename . "<br />";

            $fp = $archivo->getCaDatos();
            if ($fp !== null) {
                file_put_contents($filename, $fp);
            }
        }

        $this->setTemplate("blank");
    }

    public function executeImportArchivosCotizaciones() {

        $c = new Criteria();
        //$c->setLimit(10);
        $archivos = CotArchivoPeer::doSelect($c);

        foreach ($archivos as $archivo) {
            $cotizacion = $archivo->getCotizacion();
            $folder = "Cotizaciones" . DIRECTORY_SEPARATOR . "Coltrans" . DIRECTORY_SEPARATOR . $cotizacion->getCaConsecutivo();
            $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

            $filename = $directory . $archivo->getCaNombre();

            echo $filename . "<br />";
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }


            $fp = $archivo->getCaDatos();
            if ($fp !== null) {
                file_put_contents($filename, $fp);
            }
        }

        $this->setTemplate("blank");
    }

    public function executeFixTarifarioFcheliminado() {
        $sql = "SELECT ca_fchcreado, ca_fcheliminado, ca_idconcepto, ca_recargo,  * FROM log_pricrecargosxconcepto INNER JOIN tb_tiporecargo ON log_pricrecargosxconcepto.ca_idrecargo = tb_tiporecargo.ca_idrecargo
where ca_idtrayecto::text||ca_idconcepto::text||log_pricrecargosxconcepto.ca_idrecargo::text not in
 ( SELECT ca_idtrayecto::text||ca_idconcepto::text||ca_idrecargo::text FROM tb_pricrecargosxconcepto )
AND ca_idtrayecto <=4636
ORDER BY ca_idtrayecto,ca_idconcepto,log_pricrecargosxconcepto.ca_idrecargo, ca_consecutivo ASC ";
        $this->setTemplate("blank");


        $con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);

        $stmt = $con->prepare($sql);
        $stmt->execute();


        $lastRow['ca_idtrayecto'] = null;
        $lastRow['ca_idconcepto'] = null;
        $lastRow['ca_idrecargo'] = null;
        $lastRow['ca_fcheliminado'] = null;
        $lastRow['ca_consecutivo'] = null;


        $i = 0;
        while ($row = $stmt->fetch()) {
            if (($lastRow['ca_idtrayecto'] != $row['ca_idtrayecto']
                    || $lastRow['ca_idconcepto'] != $row['ca_idconcepto']
                    || $lastRow['ca_idrecargo'] != $row['ca_idrecargo'] )
                    && ! $lastRow['ca_fcheliminado'] && $lastRow['ca_consecutivo']
            ) {

                echo $lastRow['ca_idtrayecto'] . " " . $lastRow['ca_idconcepto'] . " " . $lastRow['ca_idrecargo'] . " " . $lastRow['ca_consecutivo'] . " " . $lastRow['ca_fcheliminado'] . "<br />";


                $sql = "UPDATE log_pricrecargosxconcepto SET ca_fcheliminado = '2009-02-23' WHERE ca_consecutivo = '" . $lastRow['ca_consecutivo'] . "'";
                //echo $sql."<br ><br >";

                $con2 = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
                $stmt2 = $con2->prepare($sql);
                $stmt2->execute();
            }

            $lastRow = $row;

            $i++;
        }
    }

    public function executeImportarTipoRecargo() {

        $recargos = Doctrine::getTable("TipoRecargo")
                ->createQuery("t")
                ->addOrderBy("t.ca_idrecargo")
                ->execute();

        Doctrine::getTable("InoConceptoModalidad")->createQuery("m")->delete()->execute();
        foreach ($recargos as $recargo) {
            $inoConcepto = Doctrine::getTable("InoConcepto")->find($recargo->getCaIdrecargo());

            if (!$inoConcepto) {
                $inoConcepto = new InoConcepto();
                $inoConcepto->setCaIdconcepto($recargo->getCaIdrecargo());
            }

            $inoConcepto->setCaConcepto($recargo->getCaRecargo());
            $inoConcepto->setCaTipo($recargo->getCaTipo());
            $inoConcepto->setCaIncoterms($recargo->getCaIncoterms());
            $inoConcepto->save();


            $impoexpoParam = explode("|", $recargo->getCaImpoexpo());

            foreach ($impoexpoParam as $impoexpo) {
                $modalidades = Doctrine::getTable("Modalidad")
                        ->createQuery("m")
                        ->where("m.ca_impoexpo = ? ", $impoexpo)
                        ->addWhere("m.ca_transporte = ? ", $recargo->getCaTransporte())
                        ->addWhere("m.ca_modalidad IS NOT NULL ")
                        ->addWhere("m.ca_modalidad != ? ", "ADUANA")
                        ->execute();

                foreach ($modalidades as $modalidad) {
                    $conceptoModalidad = new InoConceptoModalidad();
                    $conceptoModalidad->setCaIdconcepto($inoConcepto->getCaIdconcepto());
                    $conceptoModalidad->setCaIdmodalidad($modalidad->getCaIdmodalidad());
                    $conceptoModalidad->save();
                }
            }
        }




        $this->setTemplate("blank");
    }

    public function executeImportarCostos() {

        $costos = Doctrine::getTable("Costo")
                ->createQuery("t")
                ->addOrderBy("t.ca_idcosto")
                ->execute();

        //Doctrine::getTable("InoConceptoModalidad")->createQuery("m")->delete()->execute();
        foreach ($costos as $costo) {
            $inoConcepto = Doctrine::getTable("InoConcepto")->find($costo->getCaIdcosto());

            if (!$inoConcepto) {
                $inoConcepto = new InoConcepto();
                $inoConcepto->setCaIdconcepto($costo->getCaIdcosto());
            }

            $inoConcepto->setCaConcepto($costo->getCaCosto());
            $inoConcepto->setCaCosto(true);


            $inoConcepto->setCaTipo("Costo");
            //$inoConcepto->setCaIncoterms( $costo->getCaIncoterms() );

            $inoConcepto->save();

            $impoexpo = $costo->getCaImpoexpo();
            $transporte = $costo->getCaTransporte();
            $mod = $costo->getCaModalidad();


            if ($impoexpo=="Importacion" && $transporte=="Aéreo" && $mod=="Consolidado") {
                $impoexpo = "Importación";
                $mod = "CONSOLIDADO";
            }

            if ($impoexpo=="Importacion" && $transporte=="Aéreo" && $mod=="Guia Directa") {
                $impoexpo = "Importación";
                $mod = "DIRECTO";
            }

            if ($impoexpo=="Exportacion" && $transporte=="Aereo" && $mod=="Consolidado") {
                $impoexpo = "Exportación";
                $transporte = "Aéreo";
                $mod = "CONSOLIDADO";
            }

            if ($impoexpo=="Exportacion" && $transporte=="Maritimo" && $mod=="Consolidado") {
                $impoexpo = "Exportación";
                $transporte = "Marítimo";
                $mod = "LCL";
            }

            if ($impoexpo=="Exportacion" && $transporte=="Terrestre" && $mod=="Consolidado") {
                $impoexpo = "Exportación";
                $mod = "LCL";
            }

            if ($impoexpo=="Aduanas" && $transporte=="Marítimo" && $mod=="Consolidado") {
                $impoexpo = "Importación";
                $transporte = "Marítimo";
                $mod = "ADUANA";
            }

            $q = Doctrine::getTable("Modalidad")
                    ->createQuery("m")
                    ->where("m.ca_impoexpo = ? ", $impoexpo)
                    ->addWhere("m.ca_transporte = ? ", $transporte);

            if ($mod) {
                $q->addWhere("m.ca_modalidad = ? ", $mod);
            } else {
                $q->addWhere("m.ca_modalidad IS NULL");
            }


            $modalidad = $q->fetchOne();


            if ($modalidad) {
                $conceptoModalidad = new InoConceptoModalidad();
                $conceptoModalidad->setCaIdconcepto($inoConcepto->getCaIdconcepto());
                $conceptoModalidad->setCaIdmodalidad($modalidad->getCaIdmodalidad());
                if ($costo->getCaComisionable()=="Sí") {
                    $conceptoModalidad->setCaComisionable(true);
                } else {
                    $conceptoModalidad->setCaComisionable(false);
                }
                $conceptoModalidad->save();
            } else {
                echo "ERROR ---> " . $impoexpo . " " . $transporte . " " . $mod . "<br />";
            }




            /*
             * impoexpoParam = explode("|", $recargo->getCaImpoexpo() );
             * oreach( $impoexpoParam as $impoexpo){
             * modalidades = Doctrine::getTable("Modalidad")
             * >createQuery("m")
             * >where("m.ca_impoexpo = ? ", $impoexpo )
             * >addWhere("m.ca_transporte = ? ", $recargo->getCaTransporte() )
             * >addWhere("m.ca_modalidad IS NOT NULL ")
             * >addWhere("m.ca_modalidad != ? ", "ADUANA")
             * >execute();
             * oreach( $modalidades as $modalidad ){
             * conceptoModalidad = new InoConceptoModalidad();
             * conceptoModalidad->setCaIdconcepto( $inoConcepto->getCaIdconcepto() );
             * conceptoModalidad->setCaIdmodalidad( $modalidad->getCaIdmodalidad() );
             * conceptoModalidad->save();
             }
             } */
        }

        $this->setTemplate("blank");
    }

    public function executeBuscarRecargosRepetidos() {
        $q = Doctrine_Manager::getInstance()->connection();

        $sql = "SELECT DISTINCT ca_idconcepto,ca_concepto FROM ino.tb_conceptos
                WHERE ca_concepto In
                (SELECT ca_concepto FROM ino.tb_conceptos AS TMP
                where ca_recargolocal=true
                GROUP BY ca_concepto HAVING Count(*) > 1 )
                AND ca_recargolocal=true
                ORDER BY ca_concepto, ca_idconcepto  ";
        $stmt = $q->execute($sql);

        $lastConcepto = null;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if ($lastConcepto!=$row['ca_concepto']) {
                $lastConcepto = $row['ca_concepto'];
                $idconceptoOrigen = $row['ca_idconcepto'];
            }
            $idconceptoDestino = $row['ca_idconcepto'];
            echo $row['ca_idconcepto'] . " " . $row['ca_concepto'] . "<br />";

            if ($idconceptoOrigen!=$idconceptoDestino) {
                echo "Se unificara: " . $idconceptoOrigen . " con " . $idconceptoDestino . "<br />";

                /* $recargoOrigen = Doctrine::getTable("InoConcepto")->find($idconceptoOrigen);
                 * recargoDestino = Doctrine::getTable("InoConcepto")->find($idconceptoDestino);
                 * f( $recargoDestino->getCaRecargolocal() ){
                 * recargoOrigen->setCaRecargolocal(true);
                 }
                 * f( $recargoDestino->getCaRecargoorigen() ){
                 * recargoOrigen->setCaRecargoorigen(true);
                 } */

                //$recargoOrigen->save();





                $sql = "UPDATE  tb_repgastos SET ca_idrecargo = $idconceptoOrigen WHERE ca_idrecargo=$idconceptoDestino;";
                echo $sql . "<br />";
                //$stmt = $q->execute($sql);

                $sql = "UPDATE  tb_cotrecargos SET ca_idrecargo = $idconceptoOrigen WHERE ca_idrecargo=$idconceptoDestino;";
                echo $sql . "<br />";
                //$stmt = $q->execute($sql);

                $sql = "UPDATE  bs_pricrecargosxciudad SET ca_idrecargo = $idconceptoOrigen WHERE ca_idrecargo=$idconceptoDestino;";
                echo $sql . "<br />";
                //$stmt = $q->execute($sql);

                $sql = "UPDATE  bs_pricrecargosxconcepto SET ca_idrecargo = $idconceptoOrigen WHERE ca_idrecargo=$idconceptoDestino;";
                echo $sql . "<br />";
                //$stmt = $q->execute($sql);

                $sql = "UPDATE  bs_pricrecargosxlinea SET ca_idrecargo = $idconceptoOrigen WHERE ca_idrecargo=$idconceptoDestino;";
                echo $sql . "<br />";
                //$stmt = $q->execute($sql);

                $sql = "UPDATE  ino.tb_conceptos_modalidades SET ca_idconcepto = $idconceptoOrigen WHERE ca_idconcepto=$idconceptoDestino;";
                echo $sql . "<br />";
                //$stmt = $q->execute($sql);

                $sql = "DELETE FROM  ino.tb_conceptos  WHERE ca_idconcepto=$idconceptoDestino;";
                echo $sql . "<br />";
                //$stmt = $q->execute($sql);
                //echo " <b>OK</b> <br />";
                //break;
            }
        }

        $this->setTemplate("blank");
    }

    public function executeAnalizarCorreos() {


        $dir = "/home/abotero/Desktop/CORREOS";

        $dstDir = "/home/abotero/Desktop/CORREOS/BAD";
        if ($handle = opendir($dir)) {
            //echo "Directory handle: $handle\n";
            echo "Files:\n";
            $i = 0;
            /* This is the correct way to loop over the directory. */
            while (false !== ( $file = readdir($handle))) {


                $fileContent = strtolower(file_get_contents($dir . "/" . $file));
                if ($i++ < 5) {
                    echo $fileContent;
                }
                if (strpos($fileContent, strtolower("Produced By Microsoft MimeOLE"))!==false) {
                    echo "$file<br />";
                    rename($dir . "/" . $file, $dstDir . "/" . $file);
                }
            }

            closedir($handle);
        }


        $this->setTemplate("blank");
    }

    public function executeImportarFotos() {

        $dir = "E:\\Desarrollo\\htdocs\\colsys_sf3\\web\\intranet\\images\\pictures";
        $dstDir = "E:\\Desarrollo\\digitalFile\\Usuarios";

        if ($handle = opendir($dir)) {
            //echo "Directory handle: $handle\n";
            echo "Files:\n";

            $i = 0;
            /* This is the correct way to loop over the directory. */
            while (false !== ( $file = readdir($handle))) {
                if ($file =="." || $file=="..") {
                    continue;
                }
                $newfile = substr($file, 3, strpos($file, "_o") - 3);
                //echo $file." " .$newfile."<br />";
                //echo  $dstDir."\\".$newfile."\\foto.jpg <br />";
                //mkdir($dstDir."/".$newfile."/");
                echo $dir . "\\" . $file . "<br />";
                rename($dir . "\\" . $file, $dstDir . "\\" . $newfile . "\\foto.jpg");
            }
            closedir($handle);
        }
        $this->setTemplate("blank");
    }

    /* * Inicia la sesion y verifica a los grupos a los que pertenece
     *  el usuario el el directorio LDAP
     */

    public function executeImportarLDAP( $request ) {

        $users = Doctrine::getTable("Usuario")->createQuery("u")->limit("3")->execute();
        foreach($users as $user ){
            $username = $user->getCaLogin();
            
            $gruposArray = array();
            $ldap_server = sfConfig::get("app_ldap_host");
            $auth_user = "cn=" . sfConfig::get("app_ldap_user") . ",o=coltrans_bog";
            $passwd = sfConfig::get("app_ldap_passwd");

            if ($connect = ldap_connect($ldap_server)) {


                if ($bind = ldap_bind($connect, $auth_user, $passwd)) {
                    //Determina la pertenecia a los grupos en el serv. LDAP

                    $sr = ldap_search($connect, "o=coltrans_bog", "(&(cn=" . $username . "))");
                    //$info = ldap_get_entries($connect, $sr);

                    $entry = ldap_first_entry($connect, $sr);

                    $attrs = ldap_get_attributes($connect, $entry);

                    //echo $attrs["count"] . " attributes held for this entry:<p>";

                    for ($i=0; $i < $attrs["count"]; $i++) {
                        echo "<b>".$attrs[$i] . "</b><br />";

                        $values = ldap_get_values_len($connect, $entry, $attrs[$i]);

                        //echo $values["count"] . " entry.<br />";

                        for ($j=0; $j < $values["count"]; $j++) {
                            echo $values[$j] . "<br />";

                        }                       
                    }

                    /*
                    $sr = ldap_search($connect, "o=coltrans_bog", "(&(objectClass=Person))");
                    $info = ldap_get_entries($connect, $sr);
                    $person = $info[0];


                    print_r($info);*/
                    echo "<br /><br /><br /><br />";
                }
            }
            
        }
        $this->setTemplate("blank");
    }
    public function executeImportarExcel($request){
        //$users = Doctrine::getTable("Usuario")->createQuery("u")->execute();
        
        //foreach($users as $user ){
            //$username = $user->getCaLogin();
            $file="C:\\Users\\alramirez\\Desktop\\ldap.csv";
            $content=file_get_contents($file);
            $lines=explode("\n",$content);
            foreach($lines as $line){
                //echo $line.'<br />';
                $dato=explode(";",$line);
                if( $dato[0] && $dato[0]!="dn"){
                    $user = Doctrine::getTable("Usuario")->find( $dato[0] );
                    if( !$user ){
                        $user = new Usuario();
                        $user->setCaLogin($dato[0]);
                    }
                    //echo $username."<br />";
                    echo $dato[0]." ->".$dato[16]."<-<br />";
                    $user->setCaTiposangre($dato[1]);
                    $user->setCa_Telfamiliar($dato[2]);
                    $user->setCa_Nombrefamiliar($dato[3]);
                    $user->setCa_Movil($dato[4]);
                    $user->setCa_Telparticular($dato[5]);
                    $user->setCa_Direccion($dato[6]);
                    $user->setCa_Nombres($dato[7]);
                    $user->setCa_Apellidos($dato[8]);
                    if( $dato[9] ){
                        $user->setCa_Manager($dato[9]);
                    }else{
                        $user->setCa_Manager(null);
                    }
                    $user->setCa_TelOficina($dato[10]);
                    $user->setCa_Nombre($dato[11]);
                    $user->setCa_Cargo($dato[12]);
                    if( $dato[13] ){
                        $user->setCa_Departamento($dato[13]);
                    }
                    $user->setCa_Sucursal($dato[14]);
                    $user->setCa_Extension($dato[15]);
                    $user->setCa_Idsucursal(trim($dato[16]));
                    $user->setCa_Cumpleanos($dato[17]);
                    $user->setCa_Empresa($dato[18]);
                    $user->setCa_Fchingreso($dato[19]);
                    $user->setCa_Email($dato[20]);
                    $user->setCa_Authmethod($dato[21]);
                    //$user->setCa_Activo($dato[22]);
                    $user->setCa_Activo(true);
                    $user->setCa_Forcechange(false);

                    $user->save();
                }
            }
                //echo 'Los datos no coinciden'.'<br />';
            
            $this->setTemplate("blank");
        //}
    }

    public function executeImportarExcel1($request){
        //$users = Doctrine::getTable("Usuario")->createQuery("u")->execute();

        //foreach($users as $user ){
            //$username = $user->getCaLogin();
            $file="C:\\Users\\alramirez\\Desktop\\ldap.csv";
            $content=file_get_contents($file);
            $lines=explode("\n",$content);
            foreach($lines as $line){
                //echo $line.'<br />';
                $dato=explode(";",$line);
                if( $dato[0] && $dato[0]!="dn"){
                    $user = Doctrine::getTable("Usuario")->find( $dato[0] );
                    if( !$user ){
                        $user = new Usuario();
                        $user->setCaLogin($dato[0]);
                    }
                    //echo $username."<br />";
                    echo $dato[0]." ->".$dato[1]."<-".$dato[2]."<-<br />";
                    $user->setCaCargo($dato[1]);
                    if( $dato[2] ){
                        $user->setCaDepartamento(trim($dato[2]));
                    }
                    $user->save();
                }
            }
                //echo 'Los datos no coinciden'.'<br />';

            $this->setTemplate("blank");
        //}
    }


    public function executeRedimensionarImagen($request)
     {
       $users = Doctrine::getTable("Usuario")->createQuery("u")->execute();
       foreach($users as $user ){
              
           if($user->getCaActivo()){
               $username = $user->getCaLogin();

               //indicamos el directorio donde se van a colgar las imágenes
               $imagen = 'E:\\Desarrollo\\digitalFile\\Usuarios\\'.$username.'\\foto120x150.jpg' ;
               $nombre_imagen_asociada = 'foto60x80.jpg';
               $directorio = 'E:\\Desarrollo\\digitalFile\\Usuarios\\'.$username.'\\';
               //establecemos los límites de ancho y alto
               $nuevo_ancho = 60 ;
               $nuevo_alto = 80 ;

               //Recojo información de la imágen
               $info_imagen = getimagesize($imagen);
               $alto = $info_imagen[1];
               $ancho = $info_imagen[0];
               $tipo_imagen = $info_imagen[2];

               //Determino las nuevas medidas en función de los límites
               if($ancho > $nuevo_ancho OR $alto > $nuevo_alto)
               {
                 if(($alto - $nuevo_alto) > ($ancho - $nuevo_ancho))
                 {
                   $nuevo_ancho = round($ancho * $nuevo_alto / $alto,0) ;
                   echo 'primer if';
                 }
                 else
                 {
                   $nuevo_alto = round($alto * $nuevo_ancho / $ancho,0);
                   echo 'segundo if';
                 }
               }
               else //si la imagen es más pequeña que los límites la dejo igual.
               {
                 $nuevo_alto = $alto;
                 $nuevo_ancho = $ancho;
                 echo 'tercer if';
               }

                 $imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                 $imagen_vieja = imagecreatefromjpeg($imagen);
                 //cambio de tamaño?
                 imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
                 if (!imagejpeg($imagen_nueva, $directorio . $nombre_imagen_asociada)) {
                     echo "error";
                 };
                 //rename($directorio . "foto.jpg", $directorio . "foto120x150.jpg");

               $this->setTemplate("blank");
           }
       }//return true; //si todo ha ido bien devuelve true
       }
       public function executeIndexar($request){

           $this->usuarios=Doctrine::getTable('Usuario')
                        ->createQuery("u")
                        ->addWhere('ca_activo = ?', true)
                        ->execute();

           foreach($usuarios as $usuario){




           }
       }
}
?>
