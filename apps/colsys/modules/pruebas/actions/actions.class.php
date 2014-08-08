<?php

/** * pruebas actions.
 *
 * @package    colsys
 * @subpackage pruebas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pruebasActions extends sfActions {

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
            if ($row['usename'] != "postgres" && $row['usename'] != "Administrador") {
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
            if ($row['usename'] != "postgres" && $row['usename'] != "Administrador") {
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

            if ($reporte->getCaImpoexpo() == "Triangulación") {
                $reporte->setCaImpoexpo("Importación");
            }
            if ($status->getEtapa() == "Carga Entregada") {
                $idetapa = "99999";
                //print_r( $status );
            } elseif ($status->getEtapa() == "Orden Anulada") {
                $idetapa = "00000";
            } else {
                if ($reporte->getCaImpoexpo() == "Importación") {
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
                if ($status->getCaEtapa() == "Carga en Tránsito a Destino") {
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
                if ($usuario->getCaDepartamento() != "Comercial" && $usuario->getCaDepartamento() != "Servicio al Cliente") {

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
            if ($usuario->getCaDepartamento() == "Marítimo") {
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

    /*     * ****************************************************************
     *
     *  Estos procedimientos se usan para estandarizar el proceso del tracking
     *
     * **************************************************************** */
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
                    if ($email && strpos($email->getCaSubject(), "Confirmación de Llegada") !== false) {
                        $texto = "La MN " . ($referencia->getCaMnLlegada() ? $referencia->getCaMnLlegada() : $referencia->getCaMotonave()) . " arribó a " . $referencia->getDestino()->getCaCiudad() . ", el dia " . Utils::fechaMes($referencia->getCaFchconfirmacion()) . " con la orden en referencia a bordo.\n" . ucfirst($inoCliente->getCamensaje());

                        $idetapa = "IMCOL";
                    } else {
                        break;
                        if (strpos($texto, "Confirmamos cierre y finalización de los documentos del proceso de OTM") !== false) {
                            $idetapa = "99999";
                        } elseif (strpos($texto, "Confirmamos el cargue y despacho de la") !== false) {
                            $idetapa = "IMCMP";
                        } elseif (strpos($texto, "Informamos que los documentos correspondientes al trámite OTM") !== false) {
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
                            if ($idetapa == "IMCOL") {
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
                    if ($reporte->getCaEtapaActual() == "Carga Entregada") {
                        $reporte->setCaIdetapa("99999");
                    } else {
                        $reporte->setCaIdetapa($ultimoStatus->getCaIdetapa());
                    }
                    $reporte->setCaFchultstatus($ultimoStatus->getCaFchenvio());
                    $reporte->save();
                } else {
                    if ($reporte->getCaEtapaActual() == "Carga Entregada" || $reporte->getCaEtapaActual() == "Carga en Aeropuerto de Destino") {
                        $reporte->setCaIdetapa("99999");
                    }

                    if ($reporte->getCaEtapaActual() == "Contacto con nuestro Agente" &&
                            $reporte->getCaTransporte() == "Aéreo") {
                        $reporte->setCaIdetapa("IACAG");
                    }

                    if ($reporte->getCaEtapaActual() == "Contacto con nuestro Agente" &&
                            $reporte->getCaTransporte() == "Marítimo") {
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

    /*     * ****************************************************************
     *
     *  Crea sentencias SQL Para crear foreign key en todos los
     *  campos usucreado usuactualizado
     *
     * **************************************************************** */

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

    public function executeAsignarTareaHelpdesk($request) {
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

            if ($etapa != "SEG") {

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
            if (count($array) == 2) {
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

    public function executeImportarTransportistas($request) {
        exit("Ya importados");
        $c = new Criteria();
        $c->addAscendingOrderByColumn(TransportistaPeer::CA_NOMBRE);
        $transportistas = TransportistaPeer::doSelect($c);

        $j = 228;
        foreach ($transportistas as $transportista) {

            $lineas = $transportista->getTransportadors();

            $id = null;
            foreach ($lineas as $linea) {

                if ($linea->getCaNombre() == $transportista->getCaNombre()) {
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

                if (count($nombres) == 2) {
                    $nombre = $nombres[0];
                    $apellido = $nombres[1];
                } elseif (count($nombres) == 3) {
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

                if ($linea->getCaNombre() != $transportista->getCaNombre()) {
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


            if (count($transContactos) == 0) {
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

                if ($ult != $transContacto->getCaIdciudad()) {
                    $ult = $transContacto->getCaIdciudad();
                    $sucursal = new IdsSucursal();
                    $sucursal->setCaId($ids->getcaId());
                    $sucursal->setCaIdciudad($transContacto->getCaIdciudad());

                    if ($transContacto->getCaIdciudad() == $agente->getCaIdciudad()) {
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

    public function executeFixOtmReporte() {

        /* $reportes = Doctrine::getTable("RepGasto")
          ->createQuery("r")
          ->where("ca_idrecargo=61")
          ->execute();
          echo count($reportes);

         */
        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select * from tb_repgastos where ca_idrecargo=61";
        $st = $con->execute($sql);
        $rep = $st->fetchAll();


        foreach ($rep as $r) {
            
        }
        //echo count($rep);

        exit();
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
                    && !$lastRow['ca_fcheliminado'] && $lastRow['ca_consecutivo']
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


            if ($impoexpo == "Importacion" && $transporte == "Aéreo" && $mod == "Consolidado") {
                $impoexpo = "Importación";
                $mod = "CONSOLIDADO";
            }

            if ($impoexpo == "Importacion" && $transporte == "Aéreo" && $mod == "Guia Directa") {
                $impoexpo = "Importación";
                $mod = "DIRECTO";
            }

            if ($impoexpo == "Exportacion" && $transporte == "Aereo" && $mod == "Consolidado") {
                $impoexpo = "Exportación";
                $transporte = "Aéreo";
                $mod = "CONSOLIDADO";
            }

            if ($impoexpo == "Exportacion" && $transporte == "Maritimo" && $mod == "Consolidado") {
                $impoexpo = "Exportación";
                $transporte = "Marítimo";
                $mod = "LCL";
            }

            if ($impoexpo == "Exportacion" && $transporte == "Terrestre" && $mod == "Consolidado") {
                $impoexpo = "Exportación";
                $mod = "LCL";
            }

            if ($impoexpo == "Aduanas" && $transporte == "Marítimo" && $mod == "Consolidado") {
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
                if ($costo->getCaComisionable() == "Sí") {
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

            if ($lastConcepto != $row['ca_concepto']) {
                $lastConcepto = $row['ca_concepto'];
                $idconceptoOrigen = $row['ca_idconcepto'];
            }
            $idconceptoDestino = $row['ca_idconcepto'];
            echo $row['ca_idconcepto'] . " " . $row['ca_concepto'] . "<br />";

            if ($idconceptoOrigen != $idconceptoDestino) {
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
                if (strpos($fileContent, strtolower("Produced By Microsoft MimeOLE")) !== false) {
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
                if ($file == "." || $file == "..") {
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

    /*     * Inicia la sesion y verifica a los grupos a los que pertenece
     *  el usuario el el directorio LDAP
     */

    public function executeImportarLDAP($request) {

        $users = Doctrine::getTable("Usuario")->createQuery("u")->limit("3")->execute();
        foreach ($users as $user) {
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

                    for ($i = 0; $i < $attrs["count"]; $i++) {
                        echo "<b>" . $attrs[$i] . "</b><br />";

                        $values = ldap_get_values_len($connect, $entry, $attrs[$i]);

                        //echo $values["count"] . " entry.<br />";

                        for ($j = 0; $j < $values["count"]; $j++) {
                            echo $values[$j] . "<br />";
                        }
                    }

                    /*
                      $sr = ldap_search($connect, "o=coltrans_bog", "(&(objectClass=Person))");
                      $info = ldap_get_entries($connect, $sr);
                      $person = $info[0];


                      print_r($info); */
                    echo "<br /><br /><br /><br />";
                }
            }
        }
        $this->setTemplate("blank");
    }

    public function executeImportarExcel($request) {
        //$users = Doctrine::getTable("Usuario")->createQuery("u")->execute();
        //foreach($users as $user ){
        //$username = $user->getCaLogin();
        $file = "C:\\Users\\alramirez\\Desktop\\ldap.csv";
        $content = file_get_contents($file);
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            //echo $line.'<br />';
            $dato = explode(";", $line);
            if ($dato[0] && $dato[0] != "dn") {
                $user = Doctrine::getTable("Usuario")->find($dato[0]);
                if (!$user) {
                    $user = new Usuario();
                    $user->setCaLogin($dato[0]);
                }
                //echo $username."<br />";
                echo $dato[0] . " ->" . $dato[16] . "<-<br />";
                $user->setCaTiposangre($dato[1]);
                $user->setCa_Telfamiliar($dato[2]);
                $user->setCa_Nombrefamiliar($dato[3]);
                $user->setCa_Movil($dato[4]);
                $user->setCa_Telparticular($dato[5]);
                $user->setCa_Direccion($dato[6]);
                $user->setCa_Nombres($dato[7]);
                $user->setCa_Apellidos($dato[8]);
                if ($dato[9]) {
                    $user->setCa_Manager($dato[9]);
                } else {
                    $user->setCa_Manager(null);
                }
                $user->setCa_TelOficina($dato[10]);
                $user->setCa_Nombre($dato[11]);
                $user->setCa_Cargo($dato[12]);
                if ($dato[13]) {
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

    public function executeImportarExcel1($request) {
        //$users = Doctrine::getTable("Usuario")->createQuery("u")->execute();
        //foreach($users as $user ){
        //$username = $user->getCaLogin();
        $file = "C:\\Users\\alramirez\\Desktop\\ldap.csv";
        $content = file_get_contents($file);
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            //echo $line.'<br />';
            $dato = explode(";", $line);
            if ($dato[0] && $dato[0] != "dn") {
                $user = Doctrine::getTable("Usuario")->find($dato[0]);
                if (!$user) {
                    $user = new Usuario();
                    $user->setCaLogin($dato[0]);
                }
                //echo $username."<br />";
                echo $dato[0] . " ->" . $dato[1] . "<-" . $dato[2] . "<-<br />";
                $user->setCaCargo($dato[1]);
                if ($dato[2]) {
                    $user->setCaDepartamento(trim($dato[2]));
                }
                $user->save();
            }
        }
        //echo 'Los datos no coinciden'.'<br />';

        $this->setTemplate("blank");
        //}
    }

    public function executeRedimensionarImagen($request) {
        $users = Doctrine::getTable("Usuario")->createQuery("u")->execute();
        foreach ($users as $user) {

            if ($user->getCaActivo()) {
                $username = $user->getCaLogin();

                //indicamos el directorio donde se van a colgar las imágenes
                $imagen = 'E:\\Desarrollo\\digitalFile\\Usuarios\\' . $username . '\\foto120x150.jpg';
                $nombre_imagen_asociada = 'foto60x80.jpg';
                $directorio = 'E:\\Desarrollo\\digitalFile\\Usuarios\\' . $username . '\\';
                //establecemos los límites de ancho y alto
                $nuevo_ancho = 60;
                $nuevo_alto = 80;

                //Recojo información de la imágen
                $info_imagen = getimagesize($imagen);
                $alto = $info_imagen[1];
                $ancho = $info_imagen[0];
                $tipo_imagen = $info_imagen[2];

                //Determino las nuevas medidas en función de los límites
                if ($ancho > $nuevo_ancho OR $alto > $nuevo_alto) {
                    if (($alto - $nuevo_alto) > ($ancho - $nuevo_ancho)) {
                        $nuevo_ancho = round($ancho * $nuevo_alto / $alto, 0);
                        echo 'primer if';
                    } else {
                        $nuevo_alto = round($alto * $nuevo_ancho / $ancho, 0);
                        echo 'segundo if';
                    }
                } else { //si la imagen es más pequeña que los límites la dejo igual.
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

    public function executeIndexar($request) {

        $this->usuarios = Doctrine::getTable('Usuario')
                ->createQuery("u")
                ->addWhere('ca_activo = ?', true)
                ->execute();

        foreach ($usuarios as $usuario) {
            
        }
    }

    public function executeRevisarCorreos($request) {

        set_time_limit(0);
        $emails = Doctrine::getTable('Email')
                ->createQuery("e")
                ->addWhere('e.ca_tipo = ? OR e.ca_tipo = ?', array('Rep.MarítimoExterior', 'Rep.AéreoExterior'))
                ->addWhere('ca_fchenvio >= ? AND ca_fchenvio <=?', array("2010-10-03 00:00:00", "2010-10-04 15:00:00"))
                //->addWhere("e.ca_idemail = 520403")
                ->execute();

        echo count($emails);
        $i = 0;
        foreach ($emails as $email) {
            $flag = false;

            //echo "<b>Enviando " . $i++ . "</b>	emailid: " . $email->getCaIdemail() . " Fch: " . $email->getCaFchenvio() . " <br />From: " . $email->getCaFrom() . "<br />";
            $email->send();
        }

        $this->setTemplate("blank");
    }

    public function executeGearmanTest() {
        $this->setTemplate("blank");


        // client connecting to default server
        $client = sfGearmanClient::getInstance();

        // this blocks until a worker do the job and return result
        $result = sfGearmanClient::getInstance()->task('reverse1', 'Hello!');
    }
    public function executeEmailRefMaritimo() {
         $this->setLayout("email");
    }
    
    public function executeEmailRefxNotificar(sfWebRequest $request) {

        if ($request->isMethod('post')) {
            $refs=$request->getParameter("referencia");
            foreach($refs as $r)
            {
                $master = Doctrine::getTable("InoMaestraSea")->find( $r );
                //echo $master->getCaReferencia();
                $nevios = $master->getProperty("nenvios")+1;
                $master->setProperty("nenvios", $nevios);
                $master->save();
            }
        }


        $databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases.yml');
        $dsn      = explode("=",$databaseConf ['all']['doctrine']['param']['dsn']);        
        $host = $dsn[count($dsn)-1];
        $con = Doctrine_Manager::connection(new PDO("pgsql:dbname=Coltrans;host={$host}", 'Administrador', 'V9p0%rRc9$'));
        
        $fecha=  Utils::addDate(date("Y-m-d"), 0, -2);
        $fecha1=  Utils::addDate(date("Y-m-d"), 0, -3);
        $sql="SELECT r.ca_idreporte,r.ca_consecutivo,r.ca_version,r.ca_versiones,r.ca_fchllegada,r.ca_fchsalida,ca_ciuorigen,ca_ciudestino,ca_login,ca_nombre_cli,r.ca_usucreado,r.ca_fchcreado,
                (EXTRACT(EPOCH FROM age(date(r.ca_fchllegada),date(r.ca_fchsalida) ) )/86400 ) dtransito,
                (EXTRACT(EPOCH FROM age('now()',date(r.ca_fchsalida) ) )/86400) dtransitoactual                
            from vi_reportes2 r
            where r.ca_fchcreado>'".$fecha."' and ca_consecutivo not in(
            select ca_consecutivo from tb_reportes r,tb_inoclientes_sea ic where r.ca_fchcreado>'".$fecha1."' and r.ca_idreporte=ic.ca_idreporte
            )
            and ca_impoexpo='Importación' and ca_transporte='Marítimo'
            and r.ca_tiporep<>4 and r.ca_fchllegada is not null
            /*and ( SELECT max(rr.ca_version) AS max
                FROM tb_reportes rr
               WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text)=r.ca_version
               and r.ca_fchllegada>now()*/
            order by r.ca_fchllegada,r.ca_consecutivo , r.ca_version desc ";
        //echo $sql;
        $st = $con->execute(utf8_encode($sql));
        $reportes = $st->fetchAll();
        $nrep="0";
        $this->reportes=array();
        foreach($reportes as $k=>$r )
        {
            //echo $nrep."--".$r["ca_consecutivo"]."<br>";
            if($r["ca_versiones"]==$r["ca_version"] && Utils::compararFechas(date("Y-m-d"),$r["ca_fchllegada"])<=0 )
            {
//                if($r["ca_fchllegada"])
//                    echo $r["ca_consecutivo"]."::::".date("Y-m-d") ."::::::::". $r["ca_fchllegada"]."::::::::".Utils::compararFechas(date("Y-m-d"),$r["ca_fchllegada"])."<br>";
                $r["%transito"]=round((($r["dtransitoactual"]/$r["dtransito"]))*100);
                $this->reportes[]=$r;
            }
            $nrep=$r["ca_consecutivo"];
        }        
        //print_r($this->reportes);
        
        $sql="select m.ca_referencia,m.ca_fchreferencia,m.ca_fchcreado,m.ca_provisional,m.ca_modalidad,m.ca_motonave,m.ca_fchembarque,
                m.ca_fcharribo,m.ca_usucreado,ori.ca_ciudad as ca_ciu_origen,des.ca_ciudad as ca_ciu_destino,u.ca_idsucursal,
                m.ca_fchmuisca
                ,m.ca_estado,m.ca_impoexpo
                ,(EXTRACT(EPOCH FROM age('now()',date(m.ca_fchcreado) ) )/86400 ) dantecedentesactual                
                ,(select ca_dias from tb_entrega_antecedentes ea where ori.ca_idtrafico=ea.ca_idtrafico order by ca_idciudad limit 1) dantecedentes
                ,((EXTRACT(EPOCH FROM age('now()',m.ca_fchembarque) ) )/86400 ) dtransitoactual
                ,((EXTRACT(EPOCH FROM age(date(m.ca_fcharribo),date(m.ca_fchembarque)) ) )/86400 ) dtransito,
                m.ca_fchenvio,m.ca_propiedades
                from tb_inomaestra_sea m
                JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                JOIN control.tb_usuarios u ON u.ca_login = m.ca_usucreado
                where m.ca_fchcreado>='2011-03-01'
                 and m.ca_provisional = true
                order by m.ca_referencia";
        

        //echo $sql;
        $st = $con->execute(utf8_encode($sql));
            
        $this->referencias = $st->fetchAll();
        
        $this->refBloqueadas=array();
        $this->refRechazadas=array();
        $this->refSinMuisca=array();
        $this->refSinAceptar=array();
        foreach($this->referencias as $ref)
        {
            if( trim($ref["ca_provisional"])=="1" )
            {
                $nenvios=0;
                /*$prop=explode(" ", $ref["ca_propiedades"]);
                foreach( $prop as $p)
                {
                    
                }
                 * 
                 */
                $array = sfToolkit::stringToArray( $ref["ca_propiedades"] );
                
                $ref["nenvios"]=$array["nenvios"];
                $ref["ttransito"]=$ref["dtransito"];
                $ref["%transito"]=(($ref["dtransitoactual"]/$ref["dtransito"]))*100;
                $ref["ttransitoctual"]=$ref["dtransitoactual"];
                
                $ref["tantecedentes"]=$ref["dantecedentes"];
                $ref["%antecedentes"]=(($ref["dantecedentesactual"]/$ref["dantecedentes"]))*100;
                $ref["tantecedentesctual"]=$ref["dantecedentesactual"];
                
                if( $ref["ca_estado"]=="R" )
                    $this->refRechazadas[]=$ref;
                else if( $ref["ca_estado"]=="E" )
                    $this->refSinAceptar[]=$ref;
                else 
                    $this->refBloqueadas[]=$ref;
            }
        }
        //$this->setLayout("email");
    }

    public function executeEnvioEmails() {
        $this->setLayout("email");
        //$this->getRequest()->setParameter('tipo',"INSTRUCCIONES");
        //$this->getRequest()->setParameter('mensaje',$request->getParameter("mensaje"));
        //$this->getRequest()->setParameter('html',$html);
        //$request->setParameter("format", "email");
//        $html="<div><caption>A continuacion encontrara el listado de Referencias por Desbloquear y el Libro de referencias</caption></div>";
/*        $html="<div><caption>A continuacion encontrara el listado de Referencias </caption></div>";
        //$html.= sfContext::getInstance()->getController()->getPresentationFor( 'pruebas', 'emailRefMaritimo');
        $html.= sfContext::getInstance()->getController()->getPresentationFor( 'pruebas', 'emailRefxNotificar');
        $email = new Email();
        $asunto = "Circular Informativa";
        $emailFrom = "no-reply@coltrans.com.co";
        
        $email->setCaUsuenvio("maquinche");
                $email->setCaFrom($emailFrom);
                $email->setCaFromname("COLTRANS S.A.S.");
                $email->setCaSubject($asunto);
                $email->setCaAddress("maquinche@coltrans.com.co");
                //$email->setCaAddress("bbetancourt@coltrans.com.co");
                //$email->setCaAddress("maquinche@hotmail.com");
                //$email->setCaAddress("gbedoya@coltrans.com.co");
                //$email->setCaAddress("maquinche@coltrans.com.co");
                //$email->addTo("drearam51@gmail.com");
                //$email->addTo("nconsuegra@coltrans.com.co");
                //$email->addTo("cjmontero@coltrans.com.co");
                //$email->addTo("parteaga@coltrans.com.co");
                //$email->addTo("GW_VENTASBOG@coltrans.com.co");
                //$email->addTo("maquincher@hotmail.com");
                $email->setCaBodyhtml($html);
                //$email->setCaBodyhtml($html);
                $email->setCaTipo("Comunicado");
                //$email->send();
                //echo "sdsdf";
                $email->save();
        echo $html;
        exit;
  */
        //exit;
        error_reporting(E_ALL);
        $filecontrol = $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "pruebas" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "control.txt";

        if (file_exists($filecontrol)) {
            $inicio = file_get_contents($filecontrol);
        }
        if (!$inicio)
            $inicio = 0;

//        $inicio = 53;
        $con = Doctrine_Manager::getInstance()->connection();

        $nreg = 120;
/*
        $sql = "select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std  from vi_clientes c
            inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' )  and 
            c.ca_idcliente in 
                (select h.ca_idcliente from tb_inomaestra_sea m  
                inner join tb_inoclientes_sea h on m.ca_referencia=h.ca_referencia
                where m.ca_origen ='MIA-0305' and m.ca_destino='CTG-0005')        
            order by 2,3 limit $nreg offset $inicio";
*/      
        $sql = "select c.ca_idcliente,c.ca_compania, con.ca_email,ca_coltrans_std,ca_colmas_std  from vi_clientes c
            inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' )          
            order by 2,3 limit $nreg offset $inicio";

/*        
        $sql = "select c.ca_idcliente,c.ca_compania, con.ca_email
            from vi_clientes_reduc c
            inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
            order by 2,3 limit $nreg offset $inicio";
*/        
/*        $sql="select i.ca_nombre,c.* from ids.tb_ids i
inner join ids.tb_proveedores p on p.ca_idproveedor=i.ca_id
inner join ids.tb_sucursales s on s.ca_id=i.ca_id
inner join ids.tb_contactos c on c.ca_idsucursal=s.ca_idsucursal
where c.ca_email like '%@%'
order by 2,3 limit $nreg offset $inicio";*/
//        echo $sql;
        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        //echo count($clientes);
        //if($clientes) {

            /* $html='
              <html>
              <head>
              <title></title>
              <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
              <style>
              .contentheading {
              border-bottom: 1px solid #E4E4E4;
              color: #1C3A56;
              font-size: 2.3em;
              margin: 0 0 14px;
              padding: 8px 0;
              }
              template.css (línea 211)
              h2, .componentheading {
              color: #1C3A56;
              font-size: 2.2em;
              font-weight: lighter;
              line-height: 1.4em;
              margin: 0;
              padding: 6px 0;
              }
              .tableMap {
              border: 1px solid #E4E4E4;
              background-color: #fff;
              }
              .tableMap td {
              color: #888888;
              text-align: left;
              font-family: Verdana;
              font-size: 11px;
              }
              .tableMap th {
              color: #FFFFFF;
              text-align: center;
              font-family: Verdana;
              font-size: 12px;
              font-weight: bolder;
              background-color: #003DB8;
              }
              .destacado{
              color: #000000;
              font-family: Verdana;
              font-size: 11px;
              font-weight: bolder;
              }
              .rojo
              {
              color: #FF3333 ;
              font-family: Verdana;
              }

              </style>
              </head>
              <body bgcolor="#5599BB">
              <table class="tableMap measure_converter" width="50%" align="center">
              <tr>
              <td>
              <img src="http://www.coltrans.com.co/templates/coltrans/images/logo_coltrans.png" />
              </td>
              </tr>
              <tr>
              <td style="padding:20px"  >
              <div style="text-align: center;font-size: 15px">


              Este mes t    enemos una oferta que no podr&aacute; desaprovechar<br>
              <span class="rojo" >
              Pregunte por nuestra oferta especial desde Viracopos Brasil para +500 kgl<br>
              Vuelo diario a Bogota
              </span>
              <br><br><br>

              <img src="https://www.coltrans.com.co/images/noticias/estatua-y-bandera-de-brasil.jpg"><br><br>

              Sin compromiso recibirá la información que necesita YA MISMO


              <br><br>
              GEIMAR A. BEDOYA<br>
              Representante Comercial<br>
              COLTRANS S.A.S<br>
              Movil: 3124783288<br>
              Email: gbedoya@coltrans.com.co<br>
              Cr. 98 No. 25G &mdash; 10 Int.18 <br>
              Bogot&aacute;  D. C.   Colombia<br>
              PBX    57 1  &mdash;  423  9300<br>
              Fax 57 1  &mdash;  423  9323<br>
              <a href="http://www.coltrans.com.co/">www.coltrans.com.co<a><br>

              </td>
              </tr>
              </table>
              </body>
              </html>
              ';
             */
        
            $html1='
              <html>
              <head>
              <title></title>
              <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
              <style>
              .contentheading {
              border-bottom: 1px solid #E4E4E4;
              color: #1C3A56;
              font-size: 2.3em;
              margin: 0 0 14px;
              padding: 8px 0;
              }
              template.css (línea 211)
              h2, .componentheading {
              color: #1C3A56;
              font-size: 2.2em;
              font-weight: lighter;
              line-height: 1.4em;
              margin: 0;
              padding: 6px 0;
              }
              .tableMap {
              border: 1px solid #E4E4E4;
              background-color: #fff;
              }
              .tableMap td {
              color: #888888;
              text-align: left;
              font-family: Verdana;
              font-size: 11px;
              }
              .tableMap th {
              color: #FFFFFF;
              text-align: center;
              font-family: Verdana;
              font-size: 12px;
              font-weight: bolder;
              background-color: #003DB8;
              }
              .destacado{
              color: #000000;
              font-family: Verdana;
              font-size: 11px;
              font-weight: bolder;
              }
              .rojo
              {
              color: #FF3333 ;
              font-family: Verdana;
              }
              .titulo{
              color: #000000;
              font-family: Verdana;
              font-size: 15px;
              font-weight: bolder;
              }
              .l11{
              font-size: 11px;
              }
              </style>
              </head>
              
              <body bgcolor="#EAEAEA">
              <table class="tableMap measure_converter" width="70%" align="center">
              <tr>
              <td>              
              [div_coltrans] [div_colmas]
              </td>
              </tr>
              <tr>
              <td style="padding:20px"  >
              <div style="text-align: justify;font-size: 12px">
              <span class="l11">Bogot&aacute;, 24 Abril de 2014</span><br>
              <br>
              Apreciado Cliente, Queremos informarle que nuestras lineas telef&oacute;nicas presentan daños por parte de nuestro proveedor de servicios. Esperamos contar lo antes posible de nuevo con el servicio y agradecemos su comprensi&oacute;n.<br><br>
              Esperamos nos puedan contactar por medio de correo electr&oacute;nico y/o telef&oacute;nos celulares.
              <br><br><br> 
              A continuaci&oacute;n relacionamos nuestros n&uacute;meros celulares de contacto
         <table>     
<tbody>
<tr style="height:15pt" height="20">
    <td style="height:15pt;width:163pt" height="20" width="217">JEFE DPTO.&nbsp;</td>
    <td style="border-left-style:none;width:100pt" width="133">DPTO.&nbsp;</td><td style="border-left-style:none;width:60pt" width="80">CELULAR&nbsp;</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">SANDRA YANIRA CARDENAS</td>
    <td style="border-top-style:none;border-left-style:none">ADUANA</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3112155538</td>
</tr>

<tr style="height:15pt" height="20">
<td style="height:15pt;border-top-style:none" height="20">ADUANA</td>
<td style="border-top-style:none;border-left-style:none">ADUANA</td>
<td style="border-top-style:none;border-left-style:none" align="right">3102566741</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">CELUFIJO ADUANA</td>
    <td style="border-top-style:none;border-left-style:none">ADUANA</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3115140250</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">ADRIANA VEGA</td>
    <td style="border-top-style:none;border-left-style:none">ADUANA</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3105729373</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">JUAN CARLOS ALVAREZ</td>
    <td style="border-top-style:none;border-left-style:none">ADUANA</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3105636997</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">OLGA MOSQUERA</td>
    <td style="border-top-style:none;border-left-style:none">ADUANA</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3105656946</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">SUGEILA OLIVELLA</td>
    <td style="border-top-style:none;border-left-style:none">ADUANA</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3105720625</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">BORIS MANTILLA</td>
    <td style="border-top-style:none;border-left-style:none">AEREO</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3102566748</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">AEREO</td>
    <td style="border-top-style:none;border-left-style:none">AEREO</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3132621514</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">BRUNO BETANCOURT</td>
    <td style="border-top-style:none;border-left-style:none">PRICING</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3208659536</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">JEANNETTE RODRIGUEZ</td>
    <td style="border-top-style:none;border-left-style:none">CARTERA</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3112179821</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">MAGDA PULIDO</td>
    <td style="border-top-style:none;border-left-style:none">GER COMER</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3104781892</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">EXPORTACIONES</td>
    <td style="border-top-style:none;border-left-style:none">EXPO</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3132940638</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">YESID GUERRERO</td>
    <td style="border-top-style:none;border-left-style:none">EXPO</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3105656953</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">JUAN CAMILO ORTEGA</td>
    <td style="border-top-style:none;border-left-style:none">FINANCIERO</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3144446136</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">SANDRA YEPES</td>
    <td style="border-top-style:none;border-left-style:none">otm</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3102566740</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">OTM</td>
    <td style="border-top-style:none;border-left-style:none">OTM</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3112870864</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">PATRICIA ARTEAGA</td>
    <td style="border-top-style:none;border-left-style:none">MARITIMO</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3132940620</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">CONTENEDORES</td>
    <td style="border-top-style:none;border-left-style:none">MARITIMO</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3143582689</td>
</tr>


<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">OLGA VIASUS SERV.CLIENTE</td>
    <td style="border-top-style:none;border-left-style:none">S. CLIENTE</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3102124201</td>
</tr>

<tr style="height:15pt" height="20">
    <td style="height:15pt;border-top-style:none" height="20">CELUFIJO S. CLIENTE</td>
    <td style="border-top-style:none;border-left-style:none">S. CLIENTE</td>
    <td style="border-top-style:none;border-left-style:none" align="right">3102124199</td>
</tr>

<tr style="height:15pt" height="20"><td style="height:15pt;border-top-style:none" height="20">FLOR ALBA LOPEZ</td><td style="border-top-style:none;border-left-style:none">SISTEMAS</td><td style="border-top-style:none;border-left-style:none" align="right">

3138512614</td></tr><tr style="height:15pt" height="20"><td style="height:15pt;border-top-style:none" height="20">KATHERINE CAMACHO</td><td style="border-top-style:none;border-left-style:none">TALENTO HUMANO</td><td style="border-top-style:none;border-left-style:none" align="right">

3208659557</td></tr></tbody>
</table>
<br><br><br>

              [div_firma_coltrans] [div_firma_colmas]
              </td>
              </tr>
              </table>
              </body>
              </html>';
             
            /*$html1 = '
            <html>
              <head>
                <title></title>
                <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
                <style>
                        .contentheading {
                            border-bottom: 1px solid #E4E4E4;
                            color: #1C3A56;
                            font-size: 2.3em;
                            margin: 0 0 14px;
                            padding: 8px 0;
                        }                        
                        h2, .componentheading {
                            color: #1C3A56;
                            font-size: 2.2em;
                            font-weight: lighter;
                            line-height: 1.4em;
                            margin: 0;
                            padding: 6px 0;
                        }
                        .tableMap {
                            border: 1px solid #E4E4E4;
                            background-color: #fff;
                        }
                        .tableMap td {
                            color: #888888;
                            text-align: left;
                            font-family: Verdana;
                            font-size: 11px;
                        }
                        .tableMap th {
                            color: #FFFFFF;
                            text-align: center;
                            font-family: Verdana;
                            font-size: 12px;
                            font-weight: bolder;
                            background-color: #003DB8;
                        }
                        .destacado{
                            color: #000000;
                            font-family: Verdana;
                            font-size: 11px;
                            font-weight: bolder;
                        }
                        .rojo
                        {
                            color: #FF3333 ;
                            font-family: Verdana;
                        }
                        .titulo{
                            color: #000000;
                            font-family: Verdana;
                            font-size: 15px;
                            font-weight: bolder;
                        }
                        .l11{                
                            font-size: 13px;
                        }
                        </style>
              </head>
              <body bgcolor="">
              <!--<table class="tableMap measure_converter" width="100%" align="center; border:none !important;">
              <td style="text-align:center">
                Si no puede visualizar correctamente el siguiente mensaje de click <a href="http://www.coltrans.com.co/es/component/content/article/1/82">AQUI</a>
                </td>
                </table>-->
                <br>
                  <table class="tableMap measure_converter" width="800" align="center">
                <tr>
                    <td width="100%">
                    <table  width="100%">
                        <tr>
                            <td width="33%" align="left"><img src="http://www.coltrans.com.co/images/logos/coltrans/coltrans-web.png"/></td>
                            <td width="33%" align="center" ><img src="http://www.coltrans.com.co/images/logos/colmas/colmas.png" /></td>
                            <td width="33%" align="right"><img src="http://www.coltrans.com.co/images/logos/LOGO200.jpg" ></td>
                        </tr>
                    </table>                        
                    </td>
                  </tr>
                    <tr>
                        <td style="padding:20px"  >
                        
            <div style="text-align: justify;font-size: 12px">
            <span class="l11"> '.date("d").' de '.(Utils::mesLargo(date("m"))).' de '.date('Y').'</span><br>
            <br>
            <div style="text-align: center;font-size: 18px">
                <b>CIRCULAR INFORMATIVA</b>
            </div>
            <br>
             Estimado Socio de Negocio
            <br><br>

            <p class="l11">
            En virtud de lo estipulado en la Ley 1581 de 2012, por la cual se dictan disposiciones generales para la protección de datos personales, y teniendo en cuenta el Decreto 1377 de Junio 27 de 2013, que la reglamenta, solicitamos su autorizaci&oacute;n para que  COLTRANS S.A.S/ COLMAS LTDA/ COLOTM S.A.S pueda continuar realizando el tratamiento de la informaci&oacute;n contenida en nuestras bases de datos.<br><br>
            Si en el t&eacute;rmino de treinta (30) d&iacute;as h&aacute;biles despu&eacute;s de recibir este comunicado, usted como asociado de negocios no nos contacta para solicitar la supresi&oacute;n de sus datos personales en los t&eacute;rminos del mencionado decreto,  COLTRANS / COLMAS / COLOTM continuar&aacute; realizando el tratamiento de la informaci&oacute;n contenida en nuestras bases de datos, para las finalidades expuestas en nuestra pol&iacute;tica de privacidad, sin perjuicio de la facultad que tiene el titular de ejercer su derecho a pedir la eliminaci&oacute;n de sus datos personales en cualquier momento.<br><br>
            Para cualquier inquietud al respecto por favor contactarnos a nuestro correo: <br><b>sercliente-bog@coltrans.com.co</b>
</p>
            <br><br>
            Cordialmente,
            <br><br>
            <div style="float:left">GRUPO COLTRANS SAS<br>
            <a href="http://www.coltrans.com.co/">www.coltrans.com.co<a><br> </div>
                        </td>
                    </tr>
                  </table>
              </body>
            </html>';
             * */
             

/*
        //plantilla colmas
            $html1 = '
            <html >
                <body link="blue" style="margin-bottom: 1px; font-weight: normal; font-style: normal; margin-left: 4px; margin-top: 4px; font-family: Tahoma; line-height: normal; margin-right: 4px; font-size: 10pt; font-variant: normal" vlink="purple" lang="ES">
                  <p style="margin-top: 0; margin-bottom: 0">

                  <div class="Section1">
                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                      &#160;      </p>
                    <div align="center">
                      <table cellpadding="0" class="MsoNormalTable" style="border-right: #cfcfd1 1pt solid; border-bottom: #cfcfd1 1pt solid; border-top: #cfcfd1 1pt solid; width: 517.5pt; border-left: #cfcfd1 1pt solid" border="1" width="690" cellspacing="0">
                        <tr>
                          <td style="padding-top: 15pt; padding-right: 15pt; border-right: medium none; border-top: medium none; border-bottom: medium none; padding-left: 15pt; padding-bottom: 15pt; border-left: medium none">
                            <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                      <br>                            
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-top: 0pt; padding-right: 0cm; border-right: medium none; border-top: medium none; border-bottom: #fabb00 1.5pt solid; padding-left: 0cm; padding-bottom: 0pt; border-left: medium none">
                                        <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                          </p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td >
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-left: 0cm; padding-bottom: 15pt; padding-right: 0cm; padding-top: 0cm">
                                        <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                          <SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"22pt"\'><span style="color: #00469b; font-family: Arial,sans-serif; font-size: 22pt">Colmas Agencia de Aduanas</span></SPAN>
                                        </p>
                                        <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                          <SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"22pt"\'><span style="color: #00469b; font-family: Arial,sans-serif; font-size: 22pt">16&#160;a&#241;os de experiencia<br style="color: #00469b; font-family: Arial,sans-serif; font-size: 22pt">para un servicio sin competencia<o style="color: #00469b; font-size: 22pt; font-family: Arial,sans-serif" p="#DEFAULT"></o style="color: #00469b; font-size: 22pt; font-family: Arial,sans-serif"></span></SPAN>                          </p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-left: 0cm; padding-bottom: 7.5pt; padding-right: 0cm; padding-top: 0cm">
                                        <img id="Imagen_x0020_1" src="http://www.coltrans.com.co/images/IMAGE1.jpeg" height="296" border="0" alt="" width="650">
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt; background-attachment: scroll; background-color: #cfcfd1; background-position: null; background-repeat: repeat; background-image: null" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-top: 15pt; padding-right: 15pt; padding-left: 15pt; width: 236.25pt; padding-bottom: 15pt" width="315">
                                        <p class="MsoNormal" style="line-height: 15pt; margin-top: 0; margin-bottom: 0">
                                          <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">Nuestros </span></SPAN><b><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="font-family: Arial,sans-serif; color: #00469b">m&#225;s de&#160;16 a&#241;os de experiencia</span></SPAN></b><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&#160;nacionalizando mercanc&#237;as&#160;en </span></SPAN><b><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="font-family: Arial,sans-serif; color: #00469b">Colombia</span></SPAN></b><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&nbsp;son&#44; sin duda&#44; la clave para ofrecerle un </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">servicio l&#237;der en el mercado</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">. Sin olvidar que cubrimos todo el proceso desde origen a destino con </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">recursos propios</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&#44; lo que garantiza a nuestros clientes<o style="font-family: Arial,sans-serif; font-size: 10pt" p="#DEFAULT"></o style="font-family: Arial,sans-serif; font-size: 10pt"></span></SPAN>                          </p>
                                      </td>
                                      <td style="padding-top: 15pt; padding-right: 15pt; padding-left: 15pt; width: 236.25pt; padding-bottom: 15pt" width="315">
                                        <p class="MsoNormal" style="line-height: 15pt; margin-top: 0; margin-bottom: 0">
                                          <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">eficiencia&#44; transparencia y seguridad en todo&#160;sus procesos. Y es que la </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">especial realidad aduanera</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&nbsp;de Colombia nos obliga a ser expertos&#160;&#32;para realizar nuestros objetivos con todas las </span></SPAN><b><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="font-family: Arial,sans-serif; color: #00469b">garant&#237;as de&#32;&#233;xito</span></SPAN></b><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">.<o style="font-family: Arial,sans-serif; font-size: 10pt" p="#DEFAULT"></o style="font-family: Arial,sans-serif; font-size: 10pt"></span></SPAN>                          </p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="">
                                  <table cellpadding="0" class="MsoNormalTable" style="" border="0" width="650" cellspacing="0">
                                      <tr style="display:none">
                                          <td width="50%" >
                                              <img id="Imagen_x0020_2" src="http://www.coltrans.com.co/images/IMAGE2.jpeg" style="width: 325px; height: 248px" height="248" border="0"  width="325">
                                          </td>
                                          <td width="50%" >
                                              <img id="Imagen_x0020_3" src="http://www.coltrans.com.co/images/IMAGE3.jpeg" style="width: 325px; height: 248px" height="248" border="0"  width="325">
                                          </td>
                                      </tr>
                                      <tr><td colspan=2><img id="Imagen_x0020_200" src="http://www.coltrans.com.co/randomimages/banner4.jpg"  style="width: 650px; height: 120px" width="650" height="120" border="0"   ></td></tr>
                                  </table>
                                  <table cellpadding="0" class="MsoNormalTable" style="background-color: #cfcfd1;" border="0" width="650" cellspacing="0">  
                                    <tr>
                                      <td  width="50%" style="vertical-align: top">   

                                          <table cellpadding="0" class="MsoNormalTable" border="0" width="325" cellspacing="0">
                                            <tr style="height: 52.5pt">
                                              <td style="padding-top: 0cm; padding-right: 0cm; padding-left: 0cm; padding-bottom: 0cm; height: 52.5pt">
                                                <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                                  <b><font face="Arial,sans-serif" color="#00469b">
                                                          <span style="font-family: Arial,sans-serif; color: #00469b">
                                                              Recursos propios para
                                                          </span>
                                                          <span style="font-family: Arial,sans-serif; color: #00469b">
                                                              <br style="color: #00469b; font-family: Arial,sans-serif; font-weight: bold">
                                                          </span><span style="font-family: Arial,sans-serif">un servicio especializado</span><span style="font-family: Arial,sans-serif; color: #00469b"><o style="color: #00469b; font-family: Arial,sans-serif; font-weight: bold" p="#DEFAULT"></o style="color: #00469b; font-family: Arial,sans-serif; font-weight: bold"></span></font></b></p>
                                              </td>
                                            </tr>
                                            <tr style="height: 45pt">
                                              <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm; height: 45pt">
                                                <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                  <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">. </span></SPAN><b><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="font-family: Arial,sans-serif; color: #00469b">Agente de aduanas&#160;</span></SPAN></b><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&nbsp;gesti&#243;n y equipo experto en </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">tramitaci&#243;n aduanera</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&#160;en </span></SPAN><b><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="font-family: Arial,sans-serif; color: #00469b">Colombia</span></SPAN></b>                                      </p>
                                                <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                  &#160;                                      </p>
                                                <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                  &#160;                                      </p>
                                                <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                  <b><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">. Alianzas Estrategicas para Bodegaje&#44; almacenamiento y </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="font-family: Arial,sans-serif; color: #00469b">log&#237;stica</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&#44; repacking&#44; embalaje&#44; control de inventarios y Distribuci&#243;n Nacional<o style="font-size: 10pt; font-family: Arial,sans-serif; font-weight: bold" p="#DEFAULT"></o style="font-size: 10pt; font-family: Arial,sans-serif; font-weight: bold"></span><span style="font-size: 10pt; font-family: Arial,sans-serif"></span></SPAN></b>                                      </p>
                                              </td>
                                            </tr>
                                            <tr style="height: 45pt">
                                              <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm; height: 45pt">
                                                <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                  <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">. Coordinaci&#243;n en toda la cadena de suministro con un </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">&#250;nico proveedor</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif"><o style="font-family: Arial,sans-serif; font-size: 10pt" p="#DEFAULT"></o style="font-family: Arial,sans-serif; font-size: 10pt"></span></SPAN>                                      </p>
                                              </td>
                                            </tr>
                                            <tr style="height: 48.75pt">
                                              <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm; height: 48.75pt">
                                              <br>                                        
                                                <table cellpadding="0" class="MsoNormalTable"  border="0" width="100%" cellspacing="0">
                                                  <tr style="height: 52.5pt">
                                                    <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm;">
                                                        <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">.&#160;Sucursales en los </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">principales centros neur&#225;lgicos del pa&#237;s</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">: Pereira&#44; Barranquilla&#44; Cartagena&#44; Bucaramanga&#44; Medell&#237;n&#44; Cali y Buenaventura<o style="font-family: Arial,sans-serif; font-size: 10pt" p="#DEFAULT"></o style="font-family: Arial,sans-serif; font-size: 10pt"></span></SPAN>

                                                    </td>
                                                  </tr>

                                                </table>
                                              </td>
                                            </tr>
                                          </table>

                                      </td>
                                      <td  width="50%" style="vertical-align: top">


                                              <table cellpadding="0" class="MsoNormalTable"  border="0" width="325" cellspacing="0">
                                                <tr style="height: 52.5pt">
                                                  <td style="padding-top: 0cm; padding-right: 0cm; padding-left: 0cm; padding-bottom: 0cm; height: 52.5pt">
                                                    <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                                      <b><font face="Arial,sans-serif" color="#00469b"><span style="font-family: Arial,sans-serif; color: #00469b">Una gran gama de</span><span style="font-family: Arial,sans-serif; color: #00469b"><br style="color: #00469b; font-family: Arial,sans-serif; font-weight: bold"></span><span style="font-family: Arial,sans-serif">servicios con valor a&#241;adido</span><span style="font-family: Arial,sans-serif; color: #00469b"><o style="color: #00469b; font-family: Arial,sans-serif; font-weight: bold" p="#DEFAULT"></o style="color: #00469b; font-family: Arial,sans-serif; font-weight: bold"></span></font></b>                                      </p>
                                                  </td>
                                                </tr>
                                                <tr style="height: 45pt">
                                                  <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm; height: 45pt">
                                                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                      <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">.&#160;16</span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">&nbsp;a&#241;os de experiencia</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&nbsp;en el pa&#237;s y asesoramiento t&#233;cnico en </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">Comercio Exterior</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif"><o style="font-family: Arial,sans-serif; font-size: 10pt" p="#DEFAULT"></o style="font-family: Arial,sans-serif; font-size: 10pt"></span></SPAN>                                      </p>
                                                  </td>
                                                </tr>
                                                <tr style="height: 45pt">
                                                  <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm; height: 45pt">
                                                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                      <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">.Agencia de Aduana Nivel 1</span></SPAN>                                      </p>
                                                  </td>
                                                </tr>
                                                <tr style="height: 45pt">
                                                  <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm; height: 45pt">
                                                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                      <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">. </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">Proyectos especiales&#44;</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">&nbsp;gesti&#243;n documental y Track &amp; Trace online<o style="font-family: Arial,sans-serif; font-size: 10pt" p="#DEFAULT"></o style="font-family: Arial,sans-serif; font-size: 10pt"></span></SPAN>                                      </p>
                                                  </td>
                                                </tr>
                                                <tr style="height: 45pt">
                                                  <td style="padding-top: 0cm; padding-right: 7.5pt; padding-left: 7.5pt; padding-bottom: 0cm; height: 45pt">
                                                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                      <SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">. Sede central en </span></SPAN><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"10pt"\'><span style="color: #00469b">Bogot&#225;</span></SPAN><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif"><o style="font-family: Arial,sans-serif; font-size: 10pt" p="#DEFAULT"></o style="font-family: Arial,sans-serif; font-size: 10pt"></span></SPAN>                                      </p>
                                                  </td>
                                                </tr>
                                              </table>
                                      </td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                  </table>
                                </td>
                              </tr>
                              <tr style="height: 150pt">
                                <td style="padding-top: 0cm; padding-right: 0cm; padding-left: 0cm; padding-bottom: 0cm; height: 150pt">
                                  <div align="center">
                                    <table cellpadding="0" class="MsoNormalTable" style="border-right: #fabb00 1.5pt solid; border-bottom: #fabb00 1.5pt solid; border-top: #fabb00 1.5pt solid; width: 412.5pt; border-left: #fabb00 1.5pt solid" border="1" width="550" cellspacing="0">
                                      <tr>
                                        <td style="padding-top: 3.75pt; padding-right: 3.75pt; border-right: medium none; border-top: medium none; border-bottom: medium none; padding-left: 3.75pt; padding-bottom: 3.75pt; border-left: medium none">
                                          <div style="padding-top: 0cm; padding-right: 0cm; border-right: medium none; border-top: medium none; border-bottom: #cfcfd1 1pt solid; padding-left: 0cm; padding-bottom: 8pt; border-left: medium none">
                                            <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                              <b><font face="Arial,sans-serif"><span style="font-family: Arial,sans-serif">&#161;Estamos a su disposici&#243;n&#33;</span></font></b><font face="Arial,sans-serif"><span style="font-family: Arial,sans-serif"><o style="font-family: Arial,sans-serif" p="#DEFAULT"></o style="font-family: Arial,sans-serif"></span></font>                              </p>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="padding-top: 7.5pt; padding-right: 7.5pt; border-right: medium none; border-top: medium none; border-bottom: medium none; padding-left: 7.5pt; padding-bottom: 7.5pt; border-left: medium none">
                                          <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0; line-height: 18pt" align="center">
                                            <b><SPAN STYLE=\'FONT-SIZE:"14pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 14pt; font-family: Arial,sans-serif">4239300 ext 196 </span></SPAN></b><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"14pt"\'><a href="http://www.colmas.com.co"><span style="text-decoration: none; color: #00469b">www.colmas.com.co</span></a></SPAN>                            </p>
                                          <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0; line-height: 18pt" align="center">
                                            <SPAN STYLE=\'COLOR:"#000000" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"14pt"\'><span style="text-decoration: none; color: #00469b"><a href="mailto:gbedoya@coltrans.com.co">gbedoya@coltrans.com.co</a></span></SPAN>                            </p>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650">
                                    <tr>
                                      <td style="padding-left: 0.75pt; padding-bottom: 7.5pt; padding-right: 0.75pt; padding-top: 7.5pt">
                                        <p style="margin-left: 0cm; margin-top: 0; text-align: center; margin-bottom: 0; margin-right: 0cm" align="center">
                                          <b><SPAN STYLE=\'COLOR:"#00469b" ;FONT-FAMILY:"Arial,sans-serif" ;FONT-SIZE:"16pt"\'><span style="color: #00469b; font-family: Arial,sans-serif; font-size: 16pt">Colmas &amp; Coltrans S.A.S</span></SPAN></b>                          </p>
                                        <p style="text-align: center; margin-top: 0; margin-bottom: 0" align="center">
                                          <b><SPAN STYLE=\'FONT-SIZE:"10pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 10pt; font-family: Arial,sans-serif">Log&iacute;stica integral&#160;<o style="font-size: 10pt; font-family: Arial,sans-serif; font-weight: bold" p="#DEFAULT"></o style="font-size: 10pt; font-family: Arial,sans-serif; font-weight: bold"></span></SPAN></b>                          </p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650">
                                    <tr>
                                      <td style="padding-left: 0.75pt; padding-bottom: 0.75pt; padding-right: 0.75pt; padding-top: 1.5pt">
                                        <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                          <SPAN STYLE=\'FONT-SIZE:"8pt" ;FONT-FAMILY:"Arial,sans-serif"\'><span style="font-size: 8pt; font-family: Arial,sans-serif"><br style="font-family: Arial,sans-serif; font-size: 8pt">
                                          Cra 98&#35;25G-10 Int 18 Fontibon.&#160;</span></SPAN>                          </p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                      <o p="#DEFAULT">
                      &#160;</o>      </p>
                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                      <o p="#DEFAULT">
                      </o>
                      &#160;      </p>
                  </div>    
                  <div>
                    <p style="margin-top: 0; margin-bottom: 0">
                      Home Page: www.coltrans.com.co<br><br><br>
                    </p>
                  </div>
                </body>
            </html>';


        //plantilla coltrans
            $html1 = '
            <html >
                <body link="blue" style="margin-bottom: 1px; font-weight: normal; font-style: normal; margin-left: 4px; margin-top: 4px; font-family: Tahoma; line-height: normal; margin-right: 4px; font-size: 10pt; font-variant: normal" vlink="purple" lang="ES">
                  <p style="margin-top: 0; margin-bottom: 0">

                  <div class="Section1">
                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                      &#160;      </p>
                    <div align="center">
                      <table cellpadding="0" class="MsoNormalTable" style="border-right: #cfcfd1 1pt solid; border-bottom: #cfcfd1 1pt solid; border-top: #cfcfd1 1pt solid; width: 517.5pt; border-left: #cfcfd1 1pt solid" border="1" width="690" cellspacing="0">
                        <tr>
                          <td style="padding-top: 15pt; padding-right: 15pt; border-right: medium none; border-top: medium none; border-bottom: medium none; padding-left: 15pt; padding-bottom: 15pt; border-left: medium none">
                            <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
              <br>                            
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-top: 0pt; padding-right: 0cm; border-right: medium none; border-top: medium none; border-bottom: #fabb00 1.5pt solid; padding-left: 0cm; padding-bottom: 0pt; border-left: medium none">
                                        <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                          </p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td >
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-left: 0cm; padding-bottom: 15pt; padding-right: 0cm; padding-top: 0cm">
                                        <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                          <span style="color: #00469b; font-family: Arial,sans-serif; font-size: 22pt"><b>COLTRANS S.A.S</b><br>Log&iacute;stica Integral desde 1988</span>
                                        </p>
                                        <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                        <span style="color: #00469b; font-family: Arial,sans-serif; font-size: 22pt">24 a&ntilde;os de experiencia<br>para un servicio sin competencia</span>

                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding-left: 0cm; padding-bottom: 7.5pt; padding-right: 0cm; padding-top: 0cm">
                                        <img id="Imagen_x0020_1" src="http://www.coltrans.com.co/images/IMAGE1.jpeg" height="296" border="0" alt="" width="650">
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt; background-attachment: scroll; background-color: #cfcfd1; background-position: null; background-repeat: repeat; background-image: null" border="0" width="650" cellspacing="0">
                                    <tr>
                                      <td style="padding: 15pt;  width: 236.25pt;vertical-align: super;text-align: justify;" width="315">
                                        <p class="MsoNormal" style="line-height: 15pt; margin-top: 0; margin-bottom: 0">
                                          <SPAN STYLE=\'FONT-SIZE:12px; font-family: Arial,sans-serif; "\'>Nuestros <b>m&aacute;s de 23 años de experiencia</b> transportando mercanc&iacute;as a <b>Colombia</b> son, sin duda, la clave para ofrecerle un servicio l&iacute;der en el mercado. Sin olvidar que cubrimos todo el proceso desde origen a destino, lo que garantiza a nuestro clientes:</SPAN>                          </p>
                                      </td>
                                      <td style="padding: 15pt;  width: 236.25pt;vertical-align: super;text-align: justify;" width="315">
                                        <p class="MsoNormal" style="line-height: 15pt; margin-top: 0; margin-bottom: 0">
                                          <SPAN STYLE=\'FONT-SIZE:12px ;font-family: Arial,sans-serif;\'>Eficiencia, transparencia y seguridad en todo el trayecto. Y es que la realidad aduanera y log&iacute;stica de Colombia nos obliga a ser expertos para realizar un transporte con todas las <b>garant&iacute;as de &eacute;xito<b>.</SPAN></p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="">
                                  <table cellpadding="0" class="MsoNormalTable" style="" border="0" width="650" cellspacing="0">                        
                                      <tr><td colspan=2><img id="Imagen_x0020_200" src="http://www.coltrans.com.co/randomimages/banner4.jpg"  style="width: 650px; height: 120px" width="650" height="120" border="0"   ></td></tr>
                                  </table>
                                  <table cellpadding="0" class="MsoNormalTable" style="background-color: #cfcfd1;" border="0" width="650" cellspacing="0">  
                                    <tr>
                                      <td  width="50%" style="vertical-align: top">
                                          <table cellpadding="0" class="MsoNormalTable" border="0" width="325" cellspacing="0">
                                            <tr style="height: 52.5pt">
                                              <td style="padding-top: 0cm; padding-right: 0cm; padding-left: 0cm; padding-bottom: 0cm; height: 52.5pt">
                                                <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                                  <b>
                                                      <span style="font-family: Arial,sans-serif; color: #00469b">
                                                          Recursos propios para <br> un servicio especializado
                                                      </span>
                                                  </b>
                                                 </p>
                                              </td>
                                            </tr>
                                            <tr style="height: 45pt">
                                              <td style="padding: 0 7.5pt;text-align: justify; height: 45pt">
                                                  <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif"> Agente de aduanas propio, gesti&oacute;n y equipo experto en Agenciamiento Aduanero</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif"> Transporte multimodal y cobertura completa</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Consolidados A&eacute;reos y mar&iacute;timos.</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif"><b>FCL</b>,<b>LCL</b>, Break Bulk, servicio puerta-puerta, distribuci&oacute;n local en destino y recogidas en origen.</span></li></p>                                    
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Proyectos especiales, Mercanc&iacute;a peligrosa, carga pesada y dimensiones especiales</span></li></p>                                    
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Alianzas estrategicas con Dep&oacute;sitos aduaneros y Zonas Francas</span></li>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Coordinaci&oacute;n en toda la cadena de suministro con un &uacute;nico proveedor.</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Coordinaci&oacute;n de exportaciones aereas y maritimas.</span></li></p>
                                                  </p>
                                              </td>
                                            </tr>                              
                                          </table>
                                      </td>
                                      <td  width="50%" style="vertical-align: top">
                                              <table cellpadding="0" class="MsoNormalTable"  border="0" width="325" cellspacing="0">
                                                <tr style="height: 52.5pt">
                                                  <td style="padding-top: 0cm; padding-right: 0cm; padding-left: 0cm; padding-bottom: 0cm; height: 52.5pt">
                                                    <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                                      <b>
                                                          <span style="font-family: Arial,sans-serif; color: #00469b">
                                                              Una gran gama de<br>servicios con valor a&ntilde;adido
                                                          </span>
                                                      </b>
                                                  </p>
                                                  </td>
                                                </tr>
                                                <tr style="height: 45pt">
                                                  <td style="padding: 0 7.5pt;text-align: justify; height: 45pt">
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">M&aacute;s de 23 a&ntilde;os de experiencia en el pais y asesoramiento t&eacute;cnico en Comercio Exterior</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Licencia IATA y seguro de transporte</span></li></p>                                    
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Certificaci&oacute;n de calidad ISO 9001 y BASC</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Socios Globales con una misma identidad de calidad</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Proyectos especiales, gesti&oacute;n documental y Tracking & Tracing online</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Sede central en Bogot&aacute;</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Sucursales comerciales en los principales centros neur&aacute;lgicos del pais: Medell&iacute;n, Cali, Barranquilla, Pereira, Bucaramanga, Cartagena  y Buenaventura</span></li></p>
                                                      <br>
                                                      <li><span style="font-size: 10pt; font-family: Arial,sans-serif">Sucursales internacionalesen Miami y Lima</span></li></p>
                                                  </td>
                                                </tr>
                                              </table>
                                      </td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                  </table>
                                </td>
                              </tr>
                              <tr style="height: 150pt">
                                <td style="padding-top: 0cm; padding-right: 0cm; padding-left: 0cm; padding-bottom: 0cm; height: 150pt">
                                  <div align="center">
                                    <table cellpadding="0" class="MsoNormalTable" style="border-right: #fabb00 1.5pt solid; border-bottom: #fabb00 1.5pt solid; border-top: #fabb00 1.5pt solid; width: 412.5pt; border-left: #fabb00 1.5pt solid" border="1" width="550" cellspacing="0">
                                      <tr>
                                        <td style="padding-top: 3.75pt; padding-right: 3.75pt; border-right: medium none; border-top: medium none; border-bottom: medium none; padding-left: 3.75pt; padding-bottom: 3.75pt; border-left: medium none">
                                          <div style="padding-top: 0cm; padding-right: 0cm; border-right: medium none; border-top: medium none; border-bottom: #cfcfd1 1pt solid; padding-left: 0cm; padding-bottom: 8pt; border-left: medium none">
                                            <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0" align="center">
                                              <b><span style="font-family: Arial,sans-serif;font-size:14px"><b>¡Estamos a su disposici&oacute;n!<br>Nos gustaria visitarle el dia y hora que usted <br>estime mas conveniente</b></span></b>
                                            </p>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="padding-top: 7.5pt; padding-right: 7.5pt; border-right: medium none; border-top: medium none; border-bottom: medium none; padding-left: 7.5pt; padding-bottom: 7.5pt; border-left: medium none">
                                          <p class="MsoNormal" style="margin-top: 0; text-align: center; margin-bottom: 0; line-height: 18pt" align="center">
                                            <b><span style="font-size: 14pt; font-family: Arial,sans-serif">4239300 ext 196 <br> Geimar Bedoya</span></b>
                                            <br><a href="http://www.coltrans.com.co"><span style="text-decoration: none; color: #00469b">www.coltrans.com.co</span></a></p>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-left: 0cm; padding-bottom: 0cm; padding-right: 0cm; padding-top: 0cm">
                                  <table cellpadding="0" class="MsoNormalTable" style="width: 487.5pt" border="0" width="650">
                                    <tr>
                                      <td style="padding-left: 0.75pt; padding-bottom: 7.5pt; padding-right: 0.75pt; padding-top: 7.5pt">
                                        <p style="margin-left: 0cm; margin-top: 0; text-align: center; margin-bottom: 0; margin-right: 0cm" align="center">
                                          <b><span style="color: #00469b; font-family: Arial,sans-serif; font-size: 16pt">Coltrans S.A.S<br>Log&iacute;stica Integral<br>Su carga en movimiento<br>Colmas Ltda.<br>Agencia de Aduana Nivel 1</span></b></p>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                      <o p="#DEFAULT">
                      &#160;</o>      </p>
              ¬      <p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
                      <o p="#DEFAULT">
                      </o>
                      &#160;</p>
                  </div>
                </body>
              </html>';
*/
/*            $html1 ='
              <html>
                <head>
                  <title></title>
                  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
                  <style>
                          .contentheading {
                              border-bottom: 1px solid #E4E4E4;
                              color: #1C3A56;
                              font-size: 2.3em;
                              margin: 0 0 14px;
                              padding: 8px 0;
                          }
                          template.css (línea 211)
                          h2, .componentheading {
                              color: #1C3A56;
                              font-size: 2.2em;
                              font-weight: lighter;
                              line-height: 1.4em;
                              margin: 0;
                              padding: 6px 0;
                          }
                          .tableMap {
                              border: 1px solid #E4E4E4;
                              background-color: #fff;
                          }
                          .tableMap td {
                              color: #888888;
                              text-align: left;
                              font-family: Verdana;
                              font-size: 11px;
                          }
                          .tableMap th {
                              color: #FFFFFF;
                              text-align: center;
                              font-family: Verdana;
                              font-size: 12px;
                              font-weight: bolder;
                              background-color: #003DB8;
                          }
                          .destacado{
                              color: #000000;
                              font-family: Verdana;
                              font-size: 11px;
                              font-weight: bolder;
                          }
                          .rojo
                          {
                              color: #FF3333 ;
                              font-family: Verdana;
                          }
                          .titulo{
                              color: #000000;
                              font-family: Verdana;
                              font-size: 15px;
                              font-weight: bolder;
                          }
                          .l11{                
                              font-size: 13px;
                          }
                          </style>
                </head>
                <body bgcolor="#EAEAEA">

                  <br>
                    <table class="tableMap measure_converter" width="50%" align="center">
                    <tr>
                    <td style="text-align:center">
                  Si no puede visualizar correctamente el siguiente mensaje de click <a href="http://www.coltrans.com.co/es/component/content/article/1/75">AQUI</a>
                  </td>
                  </tr>
                  <tr>
                      <td>
                          <div style="float:left"><img src="http://www.coltrans.com.co/templates/coltrans/images/logo_coltrans.png" /> </div>
                      </td>
                    </tr>
                    <tr>
                          <td style="padding:20px"  >
              <div style="text-align: justify;font-size: 12px">
              <span class="l11">' . date("d") . ' de ' . Utils::mesLargo(date("m")) . ' de ' . date("Y") . '</span><br>
              <br>
               Estimado cliente: Queremos brindarle una informaci&oacute;n que puede resultarle importante
              <br><br>
              <br><br>
              <div align="center"><img src="https://www.coltrans.com.co/images/publicidad/envioitalia.jpg" border="0" /></div>
              <br>
              <div style="text-align:center">Si deseas recibir mas informaci&oacute;n o tienes inquietudes,<br>Por favor contacta a tu asesor comercial o 
              <br>a Natalie Consuegra Jefe de tr&aacute;fico de Italia<br>4239300 ext 231</div>
              <br>
              <br><br>
              <div style="float:left">COLTRANS S.A.S<br>
                  <a href="http://www.coltrans.com.co/">www.coltrans.com.co<a><br> </div>
                          </div>
                          </td>
                      </tr>
                    </table>
                </body>
              </html>';
*/
            
            $email = new Email();

                        
            $conteo = 0;
            $emails_Control = "";
            $asunto = "Comunicado Grupo Coltrans ";
            $emailFrom = "sercliente-bog@coltrans.com.co";
            $tipo_email="Comunicado";
            $fromName="Coltrans SAS";

            $div_coltrans="<div style='float: left'><img src='http://www.coltrans.com.co/images/logos/coltrans/coltrans-web.png'/></div>";
            $div_colmas="<div style='float: right'><img src='http://www.coltrans.com.co/images/logos/colmas/colmas.png'/></div>";
            
            $div_firma_coltrans="<div style='float: left'>COLTRANS S.A.S<br>
              Cr. 98 No. 25G &mdash; 10 Int.18 <br>
              Bogot&aacute;  D. C.   Colombia<br>
              PBX    57 1  &mdash;  423  9300<br>
              Fax 57 1  &mdash;  423  9323<br>
              <a href='http://www.coltrans.com.co/'>www.coltrans.com.co<a><br>
              </div>";
        
            $div_firma_colmas="<div style='float: right'>COLMAS LTDA<br>
              Cr. 98 No. 25G &mdash; 10 Int.18 <br>
              Bogot&aacute;  D. C.   Colombia<br>
              PBX    57 1  &mdash;  423  9300<br>
              Fax 57 1  &mdash;  423  9323<br>
              <a href='http://www.colmas.com.co/'>www.colmas.com.co<a><br>
              </div>";
            
            

            $keys=array("[div_coltrans]","[div_colmas]","[div_firma_coltrans]","[div_firma_colmas]");
            if(count($clientes)>0)
            {
                foreach ($clientes as $cliente) {
                    $data=  array();
                    //if($cliente["ca_coltrans_std"]!="Activo")
                    //    continue;
                  //  try {
                        $data[0]=($cliente["ca_coltrans_std"]=="Activo")?$div_coltrans:"";
                        $data[1]=($cliente["ca_colmas_std"]=="Activo")?$div_colmas:"";
                        
                        $data[2]=($cliente["ca_coltrans_std"]=="Activo")?$div_firma_coltrans:"";
                        $data[3]=($cliente["ca_colmas_std"]=="Activo")?$div_firma_colmas:"";
                        
                        $html1=str_replace($keys,$data,$html1);
                        //echo $html;
                        //exit;
                        $conteo++;
                        $email = new Email();
                        $email->setCaUsuenvio("Administrador");
                        $email->setCaFrom($emailFrom);
                        $email->setCaFromname($fromName);
                        $email->setCaSubject($asunto);
                        $email->setCaAddress($cliente["ca_email"]);
                        //$email->setCaAddress("maquinche@coltrans.com.co");
                    	//$email->setCaAttachment( "tmp/tracking_colmas.pdf" );
                        $email->setCaBodyhtml($html1);
                        $email->setCaTipo($tipo_email);
                        $email->send();
                        $email->save();
                        $emails_Control.=$cliente["ca_email"] . "<br>";
                    //} catch (Exception $e) {
                    //    $emails_Control.="No se pudo enviar " . $cliente["ca_email"] . ": porque : " . $e->getMessage() . "<br>";
                    //}
                    echo $cliente["ca_email"]."<br>";
                }
                
                file_put_contents($filecontrol, $inicio + $nreg);
                
                $email->setCaUsuenvio("Administrador");
                $email->setCaFrom($emailFrom);
                $email->setCaFromname($fromName);
                $email->setCaSubject($asunto);
                $email->setCaAddress("maquinche@coltrans.com.co");
                $email->setCaBodyhtml($html1 . "emails:<br>". $emails_Control);
                //$email->setCaAttachment( "tmp/tracking_colmas.pdf" );
                //$email->setCaBodyhtml($html);
                $email->setCaTipo($tipo_email);
                $email->send();
                
                 
            }
             
            
            
              /*  $email->setCaUsuenvio("Administrador");
                $email->setCaFrom($emailFrom);
                $email->setCaFromname($fromName);
                $email->setCaSubject($asunto);
                $email->setCaAddress("maquinche@coltrans.com.co");
//                $email->addTo("falopez@coltrans.com.co");
                $email->setCaBodyhtml($html1 . "emails:<br>". $emails_Control);
                //$email->setCaAttachment( "tmp/tracking_colmas.pdf" );
                //$email->setCaBodyhtml($html);
                $email->setCaTipo($tipo_email);
                //$email->save();
                $email->send();
                */
                echo $html1;
                exit;
        //}
    }
    public function executeEnvioEmails1() {
        
    
        $emails = Doctrine::getTable("Email")
                            ->createQuery("e")
                            ->addWhere("e.ca_idemail=1299445")                            
                            ->limit(15)
                            ->execute();
        //1299445
        //$data = array();
        //Utils::sendEmail($data);
        foreach( $emails as $email ){
            try{        
                $email->setCaSubject(date("Y-m-d H:i:s"));
                $email->send1();

            }catch(Exception $e){
                echo $e."<br />";

                $data = array();
                $data["mensaje"]="Id Email: ".$email->getCaIdemail() . "<br />".$e->getMessage(). "<br />".$e->getTraceAsString();
                Utils::sendEmail($data);            
            }
        }
        exit;
    }
    
    
     public function executeWs(sfWebRequest $request){
        ProjectConfiguration::registerZend();   
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');
        
        //$client = Zend_Gdata_ClientLogin::getHttpClient("maquinche", "80166236", Zend_Gdata_Gapps::AUTH_SERVICE_NAME);
        //$gdata = new Zend_Gdata_Gapps($client, 'coltrans.co');
        //$gdata->updateUser("colsys", "cglti$col9110");
        $email="maquinche@coltrans.co";
        $password="80166236";
        $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, Zend_Gdata_Gapps::AUTH_SERVICE_NAME);
        $gdata = new Zend_Gdata_Gapps($client, 'coltrans.co');

        $data=$gdata->retrievePageOfUsers($startUsername=null);
        echo "<table border=1><tr> <td>UserName</td>
            <td>name</td>
            <td>LastName</td>
            <td>Suspended</td>
            <td>admin</td>
            <td>changePasswordAtNextLogin</td>
            <td>agreedToTerms</td>
            </tr>";
        foreach($data as $user)
        {
            echo "<tr> <td>".$user->login->userName."</td>
            <td>".$user->name->givenName."</td>
            <td>".$user->name->familyName."</td>
            <td>".($user->login->suspended ? 'Yes' : 'No')."</td>
            <td>".($user->login->admin ? 'Yes' : 'No')."</td>
            <td>".($user->login->changePasswordAtNextLogin ? 'Yes' : 'No')."</td>
            <td>".($user->login->agreedToTerms ? 'Yes' : 'No')."</td>";            
        }
        echo "</table>";

        exit;
    }
    
    
    public function executeMail()
    {
        
        /*$ref="42050111623-99192013-11-22-111136.pdf";        
        $ref[0] =  substr($ref[0], 0,3).".".substr($ref[0], 3,2).".".substr($ref[0], 5,2).".".substr($ref[0], 7,3).".".substr($ref[0], 10,1);
        
        exit;*/
        ProjectConfiguration::registerZend();   
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');
        $pass='cglti$col91';
        $mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
        /*$mail = new Zend_Mail_Storage_Pop3(array('host'     => 'imap.gmail.com',
                                         'user'     => 'colsys@coltrans.com.co',
                                         'password' => $pass));*/
        
        //$folder = $mail->getFolders()->FACTURAS;
        //echo $forlder->countMessages()."-";
        $mail->selectFolder("FACTURAS");
        //$mail->selectFolder("MAURICIO");
        //echo $mail->countMessages();
        
        foreach ($mail as $messageNum => $message)
        {
            if ($message->hasFlag(Zend_Mail_Storage::FLAG_SEEN)) {
                continue;
            }

            $from=$message->from ;            
            /**************************************/
            $part = $message;

            while ($part->isMultipart()) {
                $part = $message->getPart(1);
                try{
                    $fileName = $part->getHeader('content-description');
                    $attachment = base64_decode($part->getContent());
                    $size = strlen($attachment);
                    //$directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR;
                    $mime = explode(";", $part->getHeader('content-type'));
                    $mime=$mime[0];
                    $asunto=substr($fileName,0,strlen($fileName)-21);
                    $ref=array();
                    $ref[]=substr($asunto, 0,11);
                    $ref[]=substr($asunto, 12,4);
                    $data=array();
                    
                    $ref[0] =  str_replace(".", "", $ref[0]);
                    $ref[0] =  substr($ref[0], 0,3).".".substr($ref[0], 3,2).".".substr($ref[0], 5,2).".".substr($ref[0], 7,3).".".substr($ref[0], 10,1);
                    
                    $data["ref1"]=$ref[0];
                    if(isset($ref[1]))
                    {
                        $sql="select  ca_hbls from tb_inoclientes_sea 
                        where ca_referencia='".$ref[0]."' and UPPER(substring(ca_hbls from (char_length(ca_hbls)-3) ))= UPPER('".$ref[1]."') limit 1";
                        $con = Doctrine_Manager::getInstance()->connection();

                        $st = $con->execute($sql);
                        $resul = $st->fetchAll();
                        $data["ref2"]=$resul[0]["ca_hbls"];
                    }
                    $data["iddocumental"]="7";

                    if($data["ref1"])
                        $path.=$data["ref1"].DIRECTORY_SEPARATOR;
                    if($data["ref2"])
                        $path.=$data["ref2"].DIRECTORY_SEPARATOR;

                    $archivo = new Archivos();
                    $archivo->setCaIddocumental($data["iddocumental"]);
                    $archivo->setCaNombre($fileName);
                    $archivo->setCaRef1($data["ref1"]);
                    $archivo->setCaRef2($data["ref2"]);
                    $archivo->setCaMime($mime);
                    $archivo->setCaSize($size);
                    $tipDoc = $archivo->getTipoDocumental();
                    $folder = $tipDoc->getCaDirectorio();
                    $directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR.$folder.$path;
                    $archivo->setCaPath($directory.$fileName);
                    $archivo->save();
                    $fh = fopen($directory.$fileName, 'w');
                    fwrite($fh, $attachment);
                    fclose($fh);
                    //print_r($data);
                    //echo $directory.$fileName;
                }
                catch(Excepcion $e)
                {
                    
                }                
            }
            
            
            /**************************************/
            
//            $mail->setFlags($messageNum,array(Zend_Mail_Storage::FLAG_SEEN));
            
    
            //echo "<pre>";print_r($message->getHeaders());echo "</pre>";
            
            //$from=$request->getParameter("from");
            
            //$from=$request->getParameter("from");
            
            /*$part = $message;            
            while ($part->isMultipart()) {
                $part = $message->getPart(1);            
                $fileName = $part->getHeader('content-description');
                $attachment = base64_decode($part->getContent());
                $directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR;
                $fh = fopen($directory.$fileName, 'w');
                fwrite($fh, $attachment);             
                fclose($fh);                
                exit;
            }*/
        }
        //echo htmlspecialchars($folder);
        
      /*      $folders = new RecursiveIteratorIterator($mail->getFolders(),
                                             RecursiveIteratorIterator::SELF_FIRST);
    echo '<select name="folder">';
    foreach ($folders as $localName => $folder) {
        $localName = str_pad('', $folders->getDepth(), '-', STR_PAD_LEFT) .
                     $localName;
        echo '<option';
        if (!$folder->isSelectable()) {
            echo ' disabled="disabled"';
        }
        echo ' value="' . htmlspecialchars($folder) . '">'
            . htmlspecialchars($localName) . '</option>';
    }
    echo '</select>';
        */
        
        
        /*echo $mail->countMessages();
        foreach ($mail as $message)
        {
            if($message->isMultipart())
            {
               $part = $message->getPart(2);
            

            // Get the attacment file name
            //$fileName = $part->getHeader('content-description');

            // Get the attachement and decode
                //$attachment = base64_decode($part->getContent());
               //$part->
                
                 //   echo  $attachment;
                
            }
            // Save the attachment
            //$fh = fopen($fileName, 'w');

            //fwrite($fh, $attachment);

            //fclose($fh);
        }*/
        //$mail->
        exit;
        
    }
    
    public function executeCalendar(sfWebRequest $request){
        ProjectConfiguration::registerZend();   
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');
        
        
        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
/*        $user="soporte-sistemas@coltrans.com.co";
        $pass="80166236";
        $keypass="528a6254afc2a026066fceb0b89e4094";
        $mailpass="pHaonZJtaWc=";
 * 
 */
        $usuario=new Usuario();
        $pass=$usuario->getDecrypt($mailpass, $keypass);
        echo $pass;
        

        // Create an authenticated HTTP client
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);

        // Create an instance of the Calendar service
        $service = new Zend_Gdata_Calendar($client);
        
        
        
        
        try {
            $listFeed= $service->getCalendarListFeed();
        } catch (Zend_Gdata_App_Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
        echo "<h1>Calendar List Feed</h1>";
        echo "<ul>";
        foreach ($listFeed as $calendar) {
            echo "<li>" . $calendar->title .
                 " (Event Feed: " . $calendar->id . ")</li>";
        }
        echo "</ul>";
        
        $query = $service->newEventQuery();
        $query->setUser('default');
        // Set to $query->setVisibility('private-magicCookieValue') if using
        // MagicCookie auth
        $query->setVisibility('private');
        $query->setProjection('full');
        $query->setOrderby('starttime');
        $query->setFutureevents('true');

        // Retrieve the event list from the calendar server
        try {
            $eventFeed = $service->getCalendarEventFeed($query);
        } catch (Zend_Gdata_App_Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        // Iterate through the list of events, outputting them as an HTML list
        echo "<ul>";
        foreach ($eventFeed as $event) {
            echo "<li>" . $event->title . " (Event ID: " . $event->id . ")</li>";
            /*echo "<pre>";
            print_r($event);
            echo "</pre>";*/
                $eventURL = $event->link;
     
            try {
                $event = $service->getCalendarEventEntry($eventURL);
            } catch (Zend_Gdata_App_Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        echo "</ul>";
        
        /*$event= $service->newEventEntry();
 
        // Populate the event with the desired information
        // Note that each attribute is crated as an instance of a matching class
        $event->title = $service->newTitle("My Event");
        $event->where = array($service->newWhere("Mountain View, California"));
        $event->content =
            $service->newContent(" This is my awesome event. RSVP required.");

        // Set the date using RFC 3339 format.
        $startDate = "2013-03-14";
        $startTime = "14:00";
        $endDate = "2013-03-14";
        $endTime = "16:00";
        $tzOffset = "-05";

        $when = $service->newWhen();
        $when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
        $when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
        $event->when = array($when);

        // Upload the event to the calendar server
        // A copy of the event as it is recorded on the server is returned
        $newEvent = $service->insertEvent($event);
         * */
        exit;
    }
    
    public function executeColsysNotification(sfWebRequest $request)
    {
        $subject="Nueva respuesta Ticket #3341 [EQUIPO LENTO]";
        $resp="prueba:".date("Y-m-d");
        $from="maquinche@coltrans.com.co";
        $from = "maquinche@coltrans.com.co";
        //$string = '"Joe Smith" <jsmith@example.com>, kjones@aol.com; someoneelse@nowhere.com mjane@gmail.com';
        $email_regex = "/[^0-9< ][A-z0-9_]+([.][A-z0-9_]+)*@[A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}/";
        preg_match_all($email_regex, $from, $matches);
        $emails = $matches[0];
        echo ($emails[0]);
        exit;
        
        try{
            $id=0;
            $subject=  str_replace("Re: ", "", $subject);
            
            $user = Doctrine::getTable("Usuario")
                            ->createQuery("u")
                            ->select("u.ca_login")
                            ->where("u.ca_email = ? ", $from)
                            ->limit(1)
                            ->fetchOne();
            
            $email = Doctrine::getTable("Email")
                            ->createQuery("e")
                            ->select("e.ca_idcaso")
                            ->where("e.ca_subject = ? ", $subject)
                            ->limit(1)
                            ->fetchOne();

            if($email)
            {
                //$conn = Doctrine::getTable("HdeskResponse")->getConnection();
                //$conn->beginTransaction();
                try{

                    $idticket = $email->getCaIdcaso();                    
                    
                    $ticket = Doctrine_Query::create()->from("HdeskTicket h")->where("h.ca_idticket = ?", $idticket)->fetchOne();

                    error_reporting(E_ALL);
                    $respuesta = new HdeskResponse();
                    //echo $subject.":".$respuesta.":".$from.":2:".$email->getCaIdemail();
                    //exit;
                    $respuesta->setCaIdticket($idticket);

                    $respuesta->setCaText(utf8_decode($resp));

                    $respuesta->setCaLogin($user->getCaLogin());
                    //echo $user->getCaLogin().":".$respuesta.":".$idticket;
                    $respuesta->setCaCreatedat(date("Y-m-d H:i:s"));
                    
                    
                    $respuesta->save(  );

                    
                    $logins = array($ticket->getCaLogin());
                    if ($ticket->getCaAssignedto()) {
                        $logins[] = $ticket->getCaAssignedto();
                    } else {
                        $usuarios = Doctrine::getTable("HdeskUserGroup")
                                        ->createQuery("h")
                                        ->innerJoin("h.Usuario u")        
                                        ->addWhere("h.ca_idgroup = ? ", $ticket->getCaIdgroup())  
                                        ->addWhere("u.ca_activo = ? ", true )  
                                        ->addOrderBy("h.ca_login")
                                        ->execute();
                        foreach ($usuarios as $usuario) {
                            $logins[] = $usuario->getCaLogin();
                        }
                    }


                    $email1 = new Email();
                    $email1->setCaUsuenvio($this->getUser()->getUserId());
                    $email1->setCaTipo("Notificación");
                    $email1->setCaIdcaso($ticket->getCaIdticket());
                    $email1->setCaFrom("no-reply@coltrans.com.co");
                    $email1->setCaFromname("Colsys Notificaciones");


                    $email1->setCaSubject("Nueva respuesta Ticket #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]");


                    $request->setParameter("id", $ticket->getCaIdticket());
                    $request->setParameter("format", "email");

                    $texto = sfContext::getInstance()->getController()->getPresentationFor('pm', 'verTicket');

                    $email1->setCaBodyhtml($texto);

                    foreach ($logins as $login) {
                        if ($this->getUser()->getUserId() != $login) {
                            $usuario = Doctrine::getTable("Usuario")->find($login);
                            $email->addTo($usuario->getCaEmail());
                        }
                    }

                    $email1->save( );


                    //$conn->commit();
                    //$request->setParameter("format", "");
                    //$texto = sfContext::getInstance()->getController()->getPresentationFor('pm', 'verRespuestas');

                    //$this->responseArray = array("success" => true, "idticket" => $ticket->getCaIdticket(), "info" => utf8_encode($texto));
                }catch(Exception $e){
                    //$conn->rollback();
                    print_r($e);
                    //$this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
                }
            }
            else
            {
                $id=$subject;
                echo $subject.":".$respuesta.":".$from;
        exit;
            }
            return $id;
        }
        catch (Exception $e)
        {
            print_r($e);
            //echo "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"];//." u:".$usuario."-nu:".$newUsuario;
        }
        //exit;
    }
  

    public function executeExt4(sfWebRequest $request)
    {
        $tipo=$request->getParameter("tipo");        
        switch ($tipo)
        {
            case "grid":
                $this->setTemplate("gridExt4");
                break;
            case "multiupload":
                $this->setTemplate("multipleUploadExt4");
                break;
            case "formUpload":                
                $this->getResponse()->setCookie('back_refer', (($this->getRequest()->getCookie('back_refer')!="")?$this->getRequest()->getCookie('back_refer'): $request->getReferer()));
                $this->idsserie = ($this->getRequestParameter("idsserie")!="")?$this->getRequestParameter("idsserie"):"2";
                
                $this->ref1 = str_replace("|", ".", $this->getRequestParameter("ref1"));
                $this->ref2 = str_replace("|", ".", $this->getRequestParameter("ref2"));
                $this->ref3 = str_replace("|", ".", $this->getRequestParameter("ref3"));
                
/*                $this->serie = ($this->getRequestParameter("serie")!="")?$this->getRequestParameter("serie"):"44";
                $this->subserie = ($this->getRequestParameter("subserie")!="")?$this->getRequestParameter("subserie"):"2";
                
                
                $this->ref1 = str_replace("|", ".", $this->getRequestParameter("ref1"));
                $this->ref2 = str_replace("|", ".", $this->getRequestParameter("ref2"));
                $this->ref3 = str_replace("|", ".", $this->getRequestParameter("ref3"));
                
                $tipoDocs = Doctrine::getTable("TipoDocumental")
                            ->createQuery("t")
                            ->select("*")                            
                            ->where("t.ca_serie = ? AND t.ca_subserie=?", array($this->serie,$this->subserie) )
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                            ->execute();
                $this->tipoDocs=array();
                foreach($tipoDocs as $t)
                {
                    $this->tipoDocs[]=array("id"=>$t["ca_iddocumental"],"name"=>$t["ca_documento"]);                    
                }
                
*/
                
                $this->setTemplate("formUploadExt4");
                break;
            case "reporteador" :
                
                $this->years=array();
                
                for ( $i=0; $i<5; $i++ )
                {
                    $this->years[] = array("year" => date('Y')-$i);
                }
                
                $this->meses = array();
                //$this->meses[]=array("id" => "%","valor" => "Todos los Meses");
                for ( $i=1; $i<=12; $i++ )
                {
                    $this->meses[] = array("id" => $i,"valor" => Utils::mesLargo($i));
                }
                
                //select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal
                $this->sucursales = array();
                
                $sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("s.ca_nombre")
                ->distinct()
                //->select("s.ca_idsucursal,s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

                foreach ($sucursales as $sucursal) {
                    $this->sucursales[] = array("id" => utf8_encode($sucursal["s_ca_nombre"]), "valor" => utf8_encode($sucursal["s_ca_nombre"]));
                }
                
                
                
                $traficos = Doctrine::getTable('Trafico')->createQuery('t')
                        ->where('t.ca_idtrafico != ?', '99-999')
                        ->addOrderBy('t.ca_nombre ASC')
                        ->execute();

                $this->traficos = array();
                foreach ($traficos as $trafico) {
                    $this->traficos[] = array("nombre" => utf8_encode($trafico->getCaNombre()),
                        "idtrafico" => $trafico->getCaIdtrafico()
                    );
                }
                
                
                /*$ciudades = Doctrine::getTable('Ciudad')->createQuery('c')
                ->innerJoin('c.Trafico t')                        
                ->where("c.ca_idtrafico=?","CO-057")
                ->addOrderBy('c.ca_ciudad ASC')
                ->addOrderBy('t.ca_nombre ASC')
                ->execute();
                
                $this->ciudades = array();
                foreach ($ciudades as $ciudad) {
                    $this->ciudades[] = array("ciudad" => utf8_encode($ciudad->getCaCiudad()),
                        "idciudad" => $ciudad->getCaIdtrafico()
                    );
                }*/
                

                $this->setTemplate("reporteador");
                break;
        }
    }

    public function executeDatosVendedores(sfWebRequest $request)
    {
        $sucursal=  utf8_decode($request->getParameter("sucursal"));
        
        $contactos = UsuarioTable::getUsuariosxPerfil('comercial',null,$sucursal);
        $c1=array();
        foreach($contactos as $c)
        {
            $c1[]=array("id"=>$c->getCaLogin(),"valor"=>utf8_encode($c->getCaNombre()));
        }
        $this->responseArray = array("root" => $c1, "total" => count($this->c1), "success" => true);
        $this->setTemplate("responseTemplate");
        
    }

     public function executeSubirArchivo(sfWebRequest $request)
     {
        sfConfig::set('sf_web_debug', false) ;
        
        $idarchivo = base64_decode($this->getRequestParameter("idarchivo"));
        
        $iddocumental = $this->getRequestParameter("documento");
        $nombre = $this->getRequestParameter("nombre");
        $ref1 = $this->getRequestParameter("ref1");
        $ref2 = $this->getRequestParameter("ref2");
        $ref3 = $this->getRequestParameter("ref3");
        
//		$folder = base64_decode($this->getRequestParameter("folder"));
        $tipDoc = Doctrine::getTable("TipoDocumental")->find($iddocumental);
        $this->forward404Unless($tipDoc);
        $folder = $tipDoc->getCaDirectorio();
        $this->referer=base64_decode($this->getRequestParameter("referer"));// para que sera???
        //$this->nameFileType=$this->getRequestParameter("namefiletype");
        
        $template = ($this->getRequestParameter("template")!="")?$this->getRequestParameter("template"):"responseTemplate";
        $path="";
        if($ref1)
            $path.=$ref1.DIRECTORY_SEPARATOR;
        if($ref2)
            $path.=$ref2.DIRECTORY_SEPARATOR;
        if($ref3)
            $path.=$ref3.DIRECTORY_SEPARATOR;
//		$this->forward404Unless($folder);
        $directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR.$folder.$path;
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
                    //if($uploadedFile['name']=="")
                    //    continue;                    
                    
                    if( $filePrefix ){
                        $fileName  = $filePrefix."_".$uploadedFile['name'] ;
                    }else{
                        $fileName  = $uploadedFile['name'] ;
                    }

                    $mime = $uploadedFile['type'];
                    $size = $uploadedFile['size'];
                    $fileName = preg_replace('/\s\s+/', ' ', $fileName);
                    $fileName=urlencode($fileName);
                    $fileName = str_replace("+", " ", $fileName);                    
                    $nombre = ($nombre!="")?$nombre:$fileName;
                    if(move_uploaded_file($uploadedFile['tmp_name'],$directory.$fileName )){
                        
                        $archivo = new Archivos();                        
                        $archivo->setCaIddocumental($iddocumental);
                        $archivo->setCaNombre($nombre);
                        $archivo->setCaMime($mime);
                        $archivo->setCaSize($size);
                        $archivo->setCaPath($directory.DIRECTORY_SEPARATOR.$fileName);
                        $archivo->setCaRef1($ref1);
                        $archivo->setCaRef2($ref2);
                        $archivo->setCaRef3($ref3);
                        $archivo->save();                        
                        $this->responseArray = array("id"=>base64_encode($fileName), "file"=>$fileName, "folder"=>$folder, "success"=>true);
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
     
     
     public function executeEliminarArchivo(sfWebRequest $request)
     {
         $user = $this->getUser();            
         $idarchivo=$request->getParameter("idarchivo");
         $observaciones=$request->getParameter("observaciones");
         $archivo = Doctrine::getTable("Archivos")->find($idarchivo);
         $archivo->setCaFcheliminado( date("Y-m-d H:i:s") );
         $archivo->setCaUsueliminado($user->getUserId());
         $archivo->setCaObservaciones(  );
         $archivo->save();
         $this->responseArray = array("success"=>true);
         $this->setTemplate("responseTemplate");
         
     }
     
     public function executeBackRefer(sfWebRequest $request)
     {  
         $this->back=$this->getRequest()->getCookie('back_refer');
         $this->getResponse()->setCookie('back_refer',"");         
         
     }
     
     
     
     public function executeGappSH(sfWebRequest $request)
     {  
         echo phpinfo();
         exit;
        ProjectConfiguration::registerZend();   
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');
        Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
        //$pass='cglti$col91';
        //$mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
          
         
         
        $pass='80166236';
        $user="maquinche@coltrans.com.co";
        $service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
        $spreadsheetService = new Zend_Gdata_Spreadsheets($client);
        //$feed = $spreadsheetService->getSpreadsheetFeed();
        $spreadsheetKey="1-rI5Jb8PqlBvZJ9u7SGyVUE-8KYj5L24IUduO_faeTw";
        $worksheetId="Sheet1";
        
        //$feed = $spreadsheetService->getSpreadsheetFeed();
        /*$spreads=$spreadsheetService->getSpreadsheets();
        
        foreach($spreads as $s) {
            echo $s->title."<br>";
        }*/
        //print_r($spread);

        /*$query = new Zend_Gdata_Spreadsheets_ListQuery();
        $query->setSpreadsheetKey($spreadsheetKey);
        $query->setWorksheetId($worksheetId);
        $listFeed = $spreadsheetService->getListFeed($query);
        */
        
        $query = new Zend_Gdata_Spreadsheets_CellQuery();
        $query->setSpreadsheetKey($spreadsheetKey);
        //$query->setWorksheetId($worksheetId);
        $cell = $spreadsheetService->getCellEntry($query);
        
        foreach($cell as $cellEntry) {
            $row = $cellEntry->cell->getRow();
            $col = $cellEntry->cell->getColumn();
            $val = $cellEntry->cell->getText();
            echo "$row, $col = $val\n";
        }
        
         exit;
     }
    
}

?>