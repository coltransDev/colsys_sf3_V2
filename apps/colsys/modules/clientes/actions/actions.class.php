<?php

/**
 * clientes actions.
 *
 * @package    colsys
 * @subpackage clientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clientesActions extends sfActions {
    /*
     * Muestra el formulario donde estan los contactos
     *
     */

    public function executeClavesTracking() {
        $this->cliente = Doctrine::getTable("Cliente")->find($this->getRequestParameter("id"));
        $this->forward404Unless($this->cliente);
    }

    /*
     * Envia un email generando un nuevo codigo de activacion
     * y desactiva la cuenta para que el usuario la active de nuevo
     */

    public function executeActivarClave() {
        $contacto = Doctrine::getTable("Contacto")->find($this->getRequestParameter("contacto"));
        $this->forward404Unless($contacto);
        $user = $contacto->getTrackingUser();

        //Genera un codigo de activacion
        $email = $contacto->getCaEmail();

        if (!$user) {
            $user = new TrackingUser();
            $user->setCaEmail($email);
            $code = $user->generateActivationCode();
        } else {
            $code = $user->getCaActivationCode();
        }

        $user->setCaActivated(false);

        $user->setCaIdcontacto($contacto->getCaIdcontacto());

        $user->save();

        $link = "/tracking/login/activate/code/" . $code;
        $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "clientes" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "email.yml";
        $yml = sfYaml::load($config);


        $contentPlain = sprintf($yml['email'], "https://www.colsys.com.co" . $link, "http://www.colsys.com.co");
        $contentHTML = sprintf(Utils::replace($yml['email']), "<a href='https://www.colsys.com.co" . $link . "'>https://www.colsys.com.co" . $link . "</a>", "<a href='http://www.colsys.com.co'>http://www.colsys.com.co</a>");
        ;

        $from = "serclientebog@coltrans.com.co";
        $fromName = "Coltrans S.A.S. - Servicio al cliente";
        //$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );
        //$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );
        $to = array($contacto->getCaNombres() . " " . $contacto->getCaPapellido() => $contacto->getCaEmail(), $this->getUser()->getNombre() => $this->getUser()->getEmail());
        //StaticEmail::sendEmail( "Activación Clave Coltrans.com.co", array("plain"=>$contentPlain,"html"=>$contentHTML), $from, $fromName, $to );

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaTipo("Activación Tracking");
        $email->setCaFrom($from);
        $email->setCaReplyto($from);
        $email->setCaFromname($fromName);
        $email->addTo($contacto->getCaEmail());
        $email->addCc($this->getUser()->getEmail());
        $email->setCaSubject("Activación Clave Coltrans.com.co");
        $email->setCaBodyhtml($contentHTML);
        $email->setCaBody($contentPlain);
        $email->save();
        //$email->send();
    }

    /*
     * Entrada Reporte de Estados Clientes
     */

    public function executeListaEstados() {
        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("DISTINCT s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
    }

    /*
     * Entrada Reporte Clientes sin Seguimiento
     */

    public function executeListaSeguimiento() {
        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("DISTINCT s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        $this->vendedores = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_login, u.ca_nombre")
                ->orderBy("u.ca_nombre")
                ->where("u.ca_departamento='Comercial' and u.ca_activo=true")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
    }

    /*
     * Entrada Reporte de Carta de Garantía Clientes
     */

    public function executeListaCartaGarantia() {
        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("DISTINCT s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
    }

    /*
     * Entrada Reporte de Documentos de Aduana Clientes
     */

    public function executeListaControlMandatos() {
        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("DISTINCT s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
    }

    /*
     * Entrada Reporte de Circular 170 Clientes
     */

    public function executeListaCircular() {
        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("DISTINCT s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
    }

    /*
     * Lista los Clientes con Estado Activo y que tinene más de 1 año sin reportar negocios
     */

    public function executeVencimientoEstado() {
        set_time_limit(0);

        $fchestado = date('Y-m-d H:i:s');
        $empresas = array("Coltrans", "Colmas", "Colotm", "Coldepósitos");

        foreach ($empresas as $empresa) {
            $stmt = StdClienteTable::vencimientoEstado($empresa, 'Activo', null);

            while ($row = $stmt->fetch()) {
                $stdcliente = new StdCliente();

                $stdcliente->setCaIdcliente($row["ca_idcliente"]);
                $stdcliente->setCaEmpresa($empresa);
                $stdcliente->setCaEstado('Potencial');
                $stdcliente->setCaFchestado($fchestado);

                $stdcliente->save();
            }
        }

        $sql = "delete from tb_libcliente where ca_idcliente in ("
                . "select lb.ca_idcliente "
                . "	from tb_libcliente lb, public.fun_estado_clientes(lb.ca_idcliente) as est "
                . "	where ca_coltrans_std = 'Potencial'"
                . "         and ca_colmas_std = 'Potencial'"
                . "         and ca_colotm_std = 'Potencial'"
                . "         and ca_coldepositos_std = 'Potencial'"
                . "         and (lb.ca_fchgracia is null or lb.ca_fchgracia <= now())"
                . ")";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);

        $layout = $this->getRequestParameter("layout");
        if ($layout) {
            $this->setLayout($layout);
        }
    }

    public function executeDatosEmpresas(sfWebRequest $request) {
        $empresas = Doctrine::getTable("Empresa")
                ->createQuery("d")
                ->execute();
        $data = array();
        foreach ($empresas as $empresa) {
            $data[] = array(
                "id" => $empresa->getCaIdempresa(),
                "name" => utf8_encode($empresa->getCaNombre())
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeReporteEstados() {
        set_time_limit(0);
        $inicio = $this->getRequestParameter("fchStart");
        $final = $this->getRequestParameter("fchEnd");
        $empresa = $this->getRequestParameter("empresa");
        $estado = $this->getRequestParameter("estado");
        $sucursal = $this->getRequestParameter("sucursal");
        $simulacion = $this->getRequestParameter("simulacion");

        $this->clientesEstados = array();

        list($year, $month, $day) = sscanf($inicio, "%d-%d-%d");
        $inicio = date('Y-m-d h:i:s', mktime(0, 0, 0, $month, $day, $year));
        // Para efectos de la simulacion recalcula la fecha inicial del periodo donde se analiza el estado anterior.
        $inisim = ($simulacion == 'sin') ? null : (($simulacion == 'uno') ? date('Y-m-d h:i:s', mktime(0, 0, 0, $month, $day, $year - 1)) : date('Y-m-d h:i:s', mktime(0, 0, 0, $month, $day, $year - 2)));
        $ultimo = date('Y-m-d h:i:s', mktime(23, 59, 59, $month, $day - 1, $year));

        list($year, $month, $day) = sscanf($final, "%d-%d-%d");
        $final = date('Y-m-d h:i:s', mktime(23, 59, 59, $month, $day, $year));

        $stmt = ClienteTable::estadoClientes($inicio, $final, $empresa, null, $estado, $sucursal);
        $ante = ClienteTable::estadoClientes($inisim, $ultimo, $empresa, null, "Potencial", $sucursal);

        while ($row = $stmt->fetch()) {
            $anterior = array();
            $negocios = array();
            $actual = $row;

            list($year, $month, $day, $hour, $mins, $secn) = sscanf($row["ca_fchestado"], "%d-%d-%d %d:%d:%d");

            $sb = ClienteTable::estadoClientes(null, date('Y-m-d H:i:s', mktime($hour, $mins, $secn - 1, $month, $day, $year)), $empresa, $row["ca_idcliente"], null, null);
            while ($row1 = $sb->fetch()) {
                $anterior = array('ca_fchestado_ant' => $row1["ca_fchestado"],
                    'ca_estado_ant' => $row1["ca_estado"]
                );
            }

            $sb = ClienteTable::negociosClientes($inicio, $final, $empresa, $row["ca_idcliente"]);
            while ($row2 = $sb->fetch()) {
                $negocios = $row2;
            }
            if (count($anterior) == 0) {
                $anterior = array('ca_fchestado_ant' => null, 'ca_estado_ant' => null);
            }
            $this->clientesEstados[] = array_merge($actual, $anterior, $negocios);
        }
        $i = 0;
        while ($row = $ante->fetch()) {      // Calcula el número de Clientes Potenciales al inicio del periodo
            $i++;
        }
        $this->empresa = $empresa;
        $this->poblacion = $i;
        $this->inicio = $inicio;
        $this->final = $final;

        $layout = $this->getRequestParameter("layout");
        if ($layout) {
            $this->setLayout($layout);
        }
    }

    public function executeValidaEstados($request) {
        set_time_limit(0);              // Estas rutina busca y elimina los registros adicionales de un mismo estado para cada cliente

        $stdclientes = Doctrine::getTable("StdCliente")
                ->createQuery("s")
                ->addOrderBy("s.ca_empresa")
                ->addOrderBy("s.ca_idcliente")
                ->addOrderBy("s.ca_fchestado")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                // ->getSqlQuery();
                ->execute();
        // echo $stdclientes;


        $old_id = null;
        $old_std = null;
        $old_fch = null;
        $old_emp = null;

        echo "<table>";
        foreach ($stdclientes as $stdcliente) {
            if ($stdcliente['s_ca_empresa'] == $old_emp and $stdcliente['s_ca_idcliente'] == $old_id and $stdcliente['s_ca_estado'] == $old_std) {
                $mark = "*";
                $clienteStd = Doctrine::getTable("StdCliente")
                        ->createQuery("s")
                        ->where("s.ca_idcliente = ?", $stdcliente['s_ca_idcliente'])
                        ->andWhere("s.ca_estado = ?", $stdcliente['s_ca_estado'])
                        ->andWhere("s.ca_fchestado = ?", $stdcliente['s_ca_fchestado'])
                        ->andWhere("s.ca_empresa = ?", $stdcliente['s_ca_empresa'])
                        // ->getSqlQuery();
                        ->fetchOne();

                if ($clienteStd) {
                    // $clienteStd->setCaEmpresa($stdcliente['s_ca_empresa']." *");
                    // $clienteStd->delete();
                }
            } else {
                $mark = "";
            }
            $old_id = $stdcliente['s_ca_idcliente'];
            $old_std = $stdcliente['s_ca_estado'];
            $old_fch = $stdcliente['s_ca_fchestado'];
            $old_emp = $stdcliente['s_ca_empresa'];
            echo "<tr>";
            echo "<td>" . $stdcliente['s_ca_idcliente'] . "</td>";
            echo "<td>" . $stdcliente['s_ca_fchestado'] . "</td>";
            echo "<td>" . $stdcliente['s_ca_estado'] . "</td>";
            echo "<td>" . $stdcliente['s_ca_empresa'] . "</td>";
            echo "<td>" . $mark . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        exit();
    }

    public function executeVerificaEstados($request) {
        // registro de control > 4622685

        set_time_limit(0);              // Estas rutina revisa todos los clientes y verifica si están adecuadamenten clasificados en su estado
        $empresas = array("Coltrans", "Colmas", "Colotm", "Coldepósitos");

        foreach ($empresas as $empresa) {
            $stmt = ClienteTable::estadoClientes(null, null, $empresa, null, null, null);
            list($year, $month, $day) = sscanf(date('Y-m-d'), "%d-%d-%d");
            $fch_ini = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year - 1));
            $fch_fin = date('Y-m-d H:i:s', mktime(23, 59, 59, $month, $day, $year));
            $clientes = array();
            while ($row = $stmt->fetch()) {
                $sb = ClienteTable::verificacionStdCliente($fch_ini, $fch_fin, $empresa, $row["ca_idcliente"]);
                while ($row1 = $sb->fetch()) {
                    $estado_cal = ($row1["ca_numnegocios"] == "" or $row1["ca_numnegocios"] == 0 or $row1["ca_numnegocios"] == NULL) ? "Potencial" : "Activo";
                    $resultado = ($row["ca_estado"] != $estado_cal) ? "Error" : "OK";
                    if ($row["ca_estado"] != "Vetado" and $resultado != "OK") {
                        if ($row1["ca_fchnegocio"] != "") {
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($row1["ca_fchnegocio"], "%d-%d-%d %d:%d:%d");
                            if (($hor == 0 and $min == 0 and $seg == 0) or ( $hor == null and $min == null and $seg == null)) {
                                $hor = 23;
                                $min = 59;
                                $seg = 59;
                            }
                            $fchnegocio = date("Y-m-d H:i:s", mktime($hor, $min, $seg, $mes, $dia, $ano));
                        } else if ($row1["ca_fchnegocio"] == "" and $row["ca_estado"] == "Activo") {
                            $sc = ClienteTable::verificacionStdCliente(null, null, $row["ca_empresa"], $row["ca_idcliente"], "max");
                            while ($row2 = $sc->fetch()) {
                                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($row2["ca_fchnegocio"], "%d-%d-%d %d:%d:%d");
                                $fchnegocio = date("Y-m-d H:i:s", mktime(3, 0, 0, $mes, $dia + 1, $ano + 1));
                            }
                        }
                        $clientes[] = array($row["ca_idcliente"] => array($row["ca_empresa"], $row["ca_estado"], $row["ca_fchestado"], $row1["ca_numnegocios"], $fchnegocio, $estado_cal, $resultado));

                        if ($row["ca_estado"] != "Vetado" and $resultado != "OK") {
                            Doctrine::getTable("StdCliente")                    // Elimina cualquier estado posterior al 
                                    ->createQuery("s")
                                    ->delete()
                                    ->where("s.ca_idcliente = ? ", $row["ca_idcliente"])
                                    ->andWhere("s.ca_empresa = ? ", $row["ca_empresa"])
                                    ->andWhere("s.ca_fchestado > ? ", $fchnegocio)
                                    ->execute();
                        }

                        $estado = Doctrine::getTable("StdCliente")              // Valida si ya existe el estado en la base de datos.
                                ->createQuery("s")
                                ->where("s.ca_idcliente = ? ", $row["ca_idcliente"])
                                ->andWhere("s.ca_empresa = ? ", $row["ca_empresa"])
                                ->andWhere("s.ca_estado = ? ", $estado_cal)
                                ->andWhere("s.ca_fchestado = ? ", $fchnegocio)
                                ->fetchOne();
                        if (!$estado) {
                            $stdcliente = new StdCliente();
                            $stdcliente->setCaIdcliente($row["ca_idcliente"]);
                            $stdcliente->setCaEmpresa($row["ca_empresa"]);
                            $stdcliente->setCaEstado($estado_cal);
                            $stdcliente->setCaFchestado($fchnegocio);
                            $stdcliente->save();
                        }
                    }
                }
            }
            echo "<table border=1>";
            foreach ($clientes as $cliente) {
                foreach ($cliente as $key => $campos) {
                    if ($campos[6] != "OK") {
                        echo "<tr>";
                        echo "<td>$key</td>";
                        foreach ($campos as $campo) {
                            echo "<td>$campo</td>";
                        }
                        echo "</tr>";
                    }
                }
            }
            echo "</table>";
        }
        exit();
    }

    public function executeReporteCartaGarantia($request) {
        set_time_limit(0);
        $inicio = $this->getRequestParameter("fchStart");
        $final = $this->getRequestParameter("fchEnd");
        $sucursal = $this->getRequestParameter("sucursal");
        $vendedor = $this->getRequestParameter("vendedor");

        $this->inicio = $inicio;
        $this->final = $final;
        $this->clientesCartaGarantia = array();
        list($year, $month, $day) = sscanf($final, "%d-%d-%d");

        // Lista los Clientes a los cuales se les vence la Carta de Garantía en el siguiente mes
        $stmt = ClienteTable::cartaGarantiaClientes($inicio, $final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesCartaGarantia[] = $row;
        }

        $layout = $this->getRequestParameter("layout");
        if ($layout) {
            $this->setLayout($layout);
        }
    }

    public function executeReporteControlMandatos($request) {
        set_time_limit(0);
        $inicio = $this->getRequestParameter("fchStart");
        $final = $this->getRequestParameter("fchEnd");
        $sucursal = $this->getRequestParameter("sucursal");
        $vendedor = $this->getRequestParameter("vendedor");

        $this->inicio = $inicio;
        $this->final = $final;
        $this->clientesControlMandatos = array();
        list($year, $month, $day) = sscanf($final, "%d-%d-%d");

        // Lista los Clientes a los cuales se les vence la Carta de Garantía en el siguiente mes
        $stmt = ClienteTable::controlMandatosClientes($inicio, $final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesControlMandatos[] = $row;
        }

        $layout = $this->getRequestParameter("layout");
        if ($layout) {
            $this->setLayout($layout);
        }
    }

    public function executeReporteSeguimiento($request) {
        set_time_limit(0);
        $inicio = $this->getRequestParameter("fchStart");
        $final = $this->getRequestParameter("fchEnd");
        $sucursal = $this->getRequestParameter("sucursal");
        $vendedor = $this->getRequestParameter("vendedor");
        $reporte = $this->getRequestParameter("reporte");
        $layout = $this->getRequestParameter("layout");

        list($year, $month, $day) = sscanf($final, "%d-%d-%d");

        $clientesActivos = array();
        $this->reporte = $reporte;
        if ($reporte == "Potenciales") {
            // Lista los Clientes Potenciales a los cuales no se les ha hecho seguimiento reciente
            $this->clientesSinSeguimiento = array();
            $stmt = ClienteTable::actividadEnClientes($inicio, $final, $sucursal, $vendedor);
            while ($row = $stmt->fetch()) {
                $this->clientesSinSeguimiento[] = $row;
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU113", 0, 'CorteUno'));
            $this->corte_uno = date("Y-m-d", mktime(0, 0, 0, $month - $parametro->getCaValor2(), $day, $year));
            $parametro = Doctrine::getTable("Parametro")->find(array("CU113", 1, 'CorteDos'));
            $this->corte_dos = date("Y-m-d", mktime(0, 0, 0, $month - $parametro->getCaValor2(), $day, $year));
            if (count($this->clientesSinSeguimiento) != 0) {
                if (php_sapi_name() == 'cli') {
                    $this->clientesLiberados = ClienteTable::liberarClientesSinSeguimiento($this->corte_uno, $this->corte_dos, $this->clientesSinSeguimiento);
                }
            }
        } elseif ($reporte == "Activos") {
            // Lista los Clientes Activos y clasifica su comportamiento en los ultimos tres periodos
            $this->fechas = $this->clientesActivos = array();
            $datetime1 = new DateTime($inicio);
            $datetime2 = new DateTime($final);
            $months = (isset($months)) ? $months : 1;

            if ($datetime1->format('Y') != $datetime2->format('Y')) {
                $inicio = date("Y-m-d", mktime(0, 0, 0, $month + 1, 1, $year - 3));
                $corte1 = date("Y-m-d", mktime(0, 0, 0, $month + 1, 1, $year - 2));
                $corte2 = date("Y-m-d", mktime(0, 0, 0, $month + 1, 1, $year - 1));
            } elseif ($datetime1->format('Y-m') == $datetime2->format('Y-m')) {
                $inicio = date("Y-m-d", mktime(0, 0, 0, $month - 2, 1, $year));
                $corte1 = date("Y-m-d", mktime(0, 0, 0, $month - 1, 1, $year));
                $corte2 = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
            } else {
                $inicio = date("Y-m-d", mktime(0, 0, 0, $month - ($months * 3), 1, $year));
                $corte1 = date("Y-m-d", mktime(0, 0, 0, $month - ($months * 2), 1, $year));
                $corte2 = date("Y-m-d", mktime(0, 0, 0, $month - ($months * 1), 1, $year));
            }
            $stmt = ClienteTable::negociosEnClientes($inicio, $final, $sucursal, $vendedor);
            while ($row = $stmt->fetch()) {
                $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_digito"] = $row["ca_digito"];
                $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_compania"] = $row["ca_compania"];
                $fchReferencia = new DateTime($row["ca_fchreferencia"]);

                if ($fchReferencia->format('Y-m-d') <= $corte1) {
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_1"] += 1;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_2"] += 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_3"] += 0;
                } elseif ($fchReferencia->format('Y-m-d') <= $corte2) {
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_1"] += 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_2"] += 1;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_3"] += 0;
                } else {
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_1"] += 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_2"] += 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_3"] += 1;
                }
            }
        }

        foreach ($clientesActivos as $key_suc => $sucursal):
            foreach ($sucursal as $key_ven => $vendedor):
                foreach ($vendedor as $key_cli => $cliente):
                    $calificacion = "";
                    if ($cliente["ca_periodo_1"] > $cliente["ca_periodo_2"]) {
                        $calificacion .= "Caida";
                    } elseif ($cliente["ca_periodo_2"] > $cliente["ca_periodo_1"]) {
                        $calificacion .= "Incremento";
                    } elseif ($cliente["ca_periodo_1"] == 0 and $cliente["ca_periodo_2"] == 0) {
                        $calificacion .= "Sin Negocios";
                    } elseif ($cliente["ca_periodo_2"] == $cliente["ca_periodo_1"]) {
                        $calificacion .= "Estable";
                    }
                    $calificacion .= "/";
                    if ($cliente["ca_periodo_2"] > $cliente["ca_periodo_3"]) {
                        $calificacion .= "Caida";
                    } elseif ($cliente["ca_periodo_3"] > $cliente["ca_periodo_2"]) {
                        $calificacion .= "Incremento";
                    } elseif ($cliente["ca_periodo_2"] == 0 and $cliente["ca_periodo_3"] == 0) {
                        $calificacion .= "Sin Negocios";
                    } elseif ($cliente["ca_periodo_3"] == $cliente["ca_periodo_2"]) {
                        $calificacion .= "Estable";
                    }
                    $clientesActivos[$key_suc][$key_ven][$key_cli]["ca_calificacion"] = $calificacion;
                endforeach;
            endforeach;
        endforeach;

        foreach ($clientesActivos as $key_suc => $sucursal):
            foreach ($sucursal as $key_ven => $vendedor):
                foreach ($vendedor as $key_cli => $cliente):
                    $this->clientesActivos[$key_suc][$key_ven][$cliente["ca_calificacion"]][$key_cli]["ca_digito"] = $cliente["ca_digito"];
                    $this->clientesActivos[$key_suc][$key_ven][$cliente["ca_calificacion"]][$key_cli]["ca_compania"] = $cliente["ca_compania"];
                    $this->clientesActivos[$key_suc][$key_ven][$cliente["ca_calificacion"]][$key_cli]["ca_periodo_1"] = $cliente["ca_periodo_1"];
                    $this->clientesActivos[$key_suc][$key_ven][$cliente["ca_calificacion"]][$key_cli]["ca_periodo_2"] = $cliente["ca_periodo_2"];
                    $this->clientesActivos[$key_suc][$key_ven][$cliente["ca_calificacion"]][$key_cli]["ca_periodo_3"] = $cliente["ca_periodo_3"];
                endforeach;
            endforeach;
        endforeach;

        $this->inicio = $inicio;
        $this->final = $final;
        $this->fechas[0] = $inicio;
        $date = new DateTime($corte1);
        $date->modify('-1 day');
        $this->fechas[1] = $date->format('Y-m-d');

        $this->fechas[2] = $corte1;
        $date = new DateTime($corte2);
        $date->modify('-1 day');
        $this->fechas[3] = $date->format('Y-m-d');

        $this->fechas[4] = $corte2;
        $this->fechas[5] = $final;

        if ($layout) {
            $this->setLayout($layout);
        }
    }

    public function executeReporteCircular($request) {
        set_time_limit(0);
        $inicio = $this->getRequestParameter("fchStart");
        $final = $this->getRequestParameter("fchEnd");
        $sucursal = $this->getRequestParameter("sucursal");
        $vendedor = $this->getRequestParameter("vendedor");

        $this->inicio = $inicio;
        $this->final = $final;
        $this->clientesCircular = array();
        $this->clientesVenCircular = array();
        $this->clientesSinCircular = array();
        $this->clientesVenVisita = array();
        $this->clientesSinVisita = array();
        // $this->clientesSinBeneficio = array();
        list($year, $month, $day) = sscanf($final, "%d-%d-%d");

        // Lista los Clientes a los cuales se les vence la Circular 0170 en el siguiente mes
        $stmt = ClienteTable::circularClientes($inicio, $final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesCircular[] = $row;

            // Si es el proceso Automático que se ejecuta los 20 de cada mes, envia comunicación al cliente
            // informando que su Circular 0170 se va a vencer el siguiente mes.

            if (sfContext::getInstance()->getConfiguration()->getEnvironment() == "cli") {

                $cliente = Doctrine::getTable("Cliente")->find($row["ca_idcliente"]);

                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaTipo("ComunicacionCircular");
                $email->setCaIdcaso("9999");

                // $email->setCaFchenvio(date("Y-m-d H:i:s")); // Hay que quitar cuando salga de seguimiento la rutina

                $comercial = $cliente->getUsuario();

                $contactos = $cliente->getContacto();
                foreach ($contactos as $contacto) {
                    if ($contacto->getCaFijo()) {
                        $email->addTo($contacto->getCaEmail());
                    }
                }
                $email->setCaFrom($comercial->getCaEmail());
                $email->setCaFromname($comercial->getCaNombre());
                $email->setCaReplyto($comercial->getCaEmail());
                $email->addCc($comercial->getCaEmail());
                $coordinador = Doctrine::getTable("Usuario")       // Compia el mensaje a las personas de la sucursal con el perfil control alertas
                        ->createQuery("u")
                        ->where("u.ca_login = ? ", $cliente->getCaCoordinador())
                        ->fetchOne();
                if ($coordinador) {
                    $email->addCc($coordinador->getCaEmail());
                }

                $sucursal_obj = $comercial->getSucursal();
                $direccion_suc = $sucursal_obj->getCaDireccion() . " " . $sucursal_obj->getCaNombre();

                $email->setCaSubject("Vencimiento de Circular 0170 Coltrans S.A.S. " . $cliente->getCaCompania());

                $mes_esp = array("01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
                $siguiente_mes = mktime(0, 0, 0, $month + 1, 5, $year);
                $siguiente_mes = $mes_esp[date("m", $siguiente_mes)] . " " . date("d", $siguiente_mes) . " de " . date("Y", $siguiente_mes);

                $con_credito = $cliente->getLibCliente()->getCaDiascredito();
                $renovacion_credito = ($con_credito) ? "Así mismo solicitamos diligenciar y adjuntar (con firma en original), el formulario de solicitud de crédito el cual permitirá renovar las condiciones crediticias que su compañía tiene con nuestro grupo empresarial.<br /><br />" : "";

                $bodyHtml = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                  <table style=\"width: 100%\">
                     <tr>
                        <td style=\"text-align: center; font-weight: bold\">
                           DOCUMENTOS IDENTIFICACIÓN CLIENTES
                        </td>
                     </tr>
                     <tr>
                        <td style=\"text-align: left\">
                           Apreciado Cliente:<br />
                        </td>
                     </tr>
                     <tr>
                        <td style=\"text-align: justify\">
                           Es necesario para <strong>COLTRANS S.A.S.</strong> y/o <strong>AGENCIA DE ADUANAS COLMAS S.A.S. NIVEL 1</strong> dar cumplimiento a la Circular 0170 de 2002, resolución 8571 de 2010 expedidas por la DIAN y a la circular externa 100-000005 de junio 17 de 2014, expedida por la Superintendencia de Sociedades, siendo nuestra obligación como Agentes de Carga Internacional / Agentes de Aduana, crear un banco de datos de nuestros clientes que nos permita establecer un adecuado auto control y gestión del riesgo para la 'Prevención del lavado de Activos y Financiación del Terrorismo' en nuestras operaciones.<br /><br />
                           Por lo anterior, el Representante Comercial que atiende su cuenta, estará retirando de sus instalaciones los siguientes documentos:<br /><br />
                        </td>
                     </tr>
                     <tr>
                        <td style=\"text-align: justify\"><center>
                          <table style=\"width: 800px;\" border=1px>
                            <tr>
                              <td style=\"text-align: center; font-weight: bold\">SI ES CLIENTE DE COLTRANS</td>
                              <td style=\"text-align: center; font-weight: bold\">SI ES CLIENTE DE COLMAS</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Formato de conocimiento de cliente -Circular 170, debidamente diligenciado y firmado en original por el Representante Legal o la persona facultada según certificado de existencia y representación legal.</td>
                              <td style=\"text-align: justify\">Formato de conocimiento de cliente -Circular 170, debidamente diligenciado y firmado en original por el Representante Legal o la persona facultada según certificado de existencia y representación legal.</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Certificado de existencia y representación legal en original con vigencia no superior a 30 días.</td>
                              <td style=\"text-align: justify\">Certificado de existencia y representación legal en original con vigencia no superior a 30 días.</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Fotocopia del RUT Completo, con fecha de expedición del año en el que se actualizan los documentos.</td>
                              <td style=\"text-align: justify\">Fotocopia del RUT Completo, con fecha de expedición del año en el que se actualizan los documentos.</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Fotocopia C.C. Representante Legal</td>
                              <td style=\"text-align: justify\">Fotocopia C.C. Representante Legal</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Balance General</td>
                              <td style=\"text-align: justify\">Balance General</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Estado de Resultados</td>
                              <td style=\"text-align: justify\">Estado de Resultados</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Notas a los Estados Financieros</td>
                              <td style=\"text-align: justify\">Notas a los Estados Financieros</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Fotocopia de la T.P. o C.C. del Contador</td>
                              <td style=\"text-align: justify\">Certificado de EE.FF emitido por Contador público</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Fotocopia de la T.P. o C.C. del Revisor Fiscal (si aplica*)</td>
                              <td style=\"text-align: justify\">Dictamen de EE.FF emitido por Revisor fiscal (si aplica*)</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Fotocopia del certificado ISO</td>
                              <td style=\"text-align: justify\">Fotocopia de la T.P. o C.C. del Contador</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Fotocopia del certificado BASC</td>
                              <td style=\"text-align: justify\">Fotocopia de la T.P. o C.C. del Revisor Fiscal (si aplica*)</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\">Check list documentos entregados, debidamente firmado</td>
                              <td style=\"text-align: justify\">Fotocopia del certificado ISO</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\"></td>
                              <td style=\"text-align: justify\">Fotocopia del certificado BASC</td>
                            </tr>
                            <tr>
                              <td style=\"text-align: justify\"></td>
                              <td style=\"text-align: justify\">Check list documentos entregados, debidamente firmado</td>
                            </tr>
                          </table></center>
                        </td>
                     </tr>
                     <tr>
                        <td style=\"text-align: justify\">
                           * Empresas que cuenten con más de 5.000 SMMLV de activos están obligados a tener revisor fiscal.<br /><br />
                           Si usted es Grancontribuyente, UAP, ALTEX, Agente Diplomático, Entidad del estado, Entidades territoriales, entidad descentralizada, entidad vigilada por la Superfinanciera, esta exceptuado de presentar el balance general, estado de resultados, notas a los estados financieros, certificación de los estados financieros del contador y/o revisor, fotocopia de la cédula del contador y/o revisor y sus respectivos antecedentes.<br /><br />
                           Los Estados Financieros deben estar certificados y dictaminados por Representante Legal y Revisor Fiscal y/o Contador Público con fecha de corte a Dic. 31 del año inmediatamente anterior. Si la compañía se encuentra recientemente constituida, deberá entregar un balance inicial. Si usted es persona natural, deberá entregar copia de la última Declaración de Renta.<br /><br />
                           Está documentación debe ser actualizada mínimo anualmente y reposará en nuestros archivos con un trato de <strong>ABSOLUTA RESERVA Y CONFIDENCIALIDAD.</strong> El incumplimiento de alguno de los puntos anteriores acarreará una sanción por parte de la DIAN.<br /><br />$renovacion_credito
                           <strong>IMPORTANTE:</strong><br />
                           En caso de no tener un Representante Comercial asignado, agradecemos enviar los mismos en original a la atención de Fanny Gutiérrez en la dirección: Cra. 98 No 25G-10 INT 18.<br /><br />
                           Si usted es cliente de Coltrans y Colmas, debe remitir un solo paquete de documentos acogiéndose con la relación de documentos de Colmas.<br /><br />
                           Cordialmente,<br /><br /><br />
                           <strong>
                              DEPARTAMENTO  COMERCIAL<br />
                              COLTRANS S.A.S./<br />
                              AGENCIA DE ADUANAS COLMAS S.A.S. NIVEL 1
                           </strong>
                        </td>
                     </tr>
                  </table>";

                $email->setCaBodyhtml($bodyHtml);
                if ($con_credito) {
                    $email->addAttachment("ids/formatos/Solicitud_de_Credito.xls");
                }
                $email->addAttachment("ids/formatos/Formato_conocimiento_de_cliente.xls");

                $email->save();
            }
        }

        // Lista los Clientes que hasta antes de iniciar el periodo solicitado, tienen vencida la Circular 0170
        $final = $inicio;
        $inicio = date('Y-m-d', mktime(0, 0, 0, $month, 0, 1900)); //$year - 5
        $stmt = ClienteTable::circularClientes($inicio, $final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesVenCircular[] = $row;
        }

        // Lista los Clientes no tienen Circular 0170, sin importar la fecha
        $stmt = ClienteTable::clientesSinCircular($final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesSinCircular[] = $row;
        }

        // Lista los Clientes con Encuesta de Visita vencida
        $stmt = ClienteTable::clientesEncVisita($final, $sucursal, $vendedor, "Ven");
        while ($row = $stmt->fetch()) {
            $this->clientesVenVisita[] = $row;
        }

        // Lista los Clientes no tienen Encuesta de Visita
        $stmt = ClienteTable::clientesEncVisita($final, $sucursal, $vendedor, "Sin");
        while ($row = $stmt->fetch()) {
            $this->clientesSinVisita[] = $row;
        }

        // Si es el proceso Automático que se ejecuta los 20 de cada mes, verifica los Clientes que tienen más de 60 días
        // con la Circular 0170 vencida y retira beneficios de Cupo y Tiempo de C?edito.
        /*
          if( sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli" ){
          $idClientesSinBeneficio = array();
          $inicio = date('Y-m-d',mktime(0,0,0,$month-1,0,$year-5));
          $final = date('Y-m-d',mktime(0,0,0,$month-1,0,$year));
          $fchmotivo = date('Y-m-d H:i:s');

          $stmt = ClienteTable::pierdenBeneficios( $final, $sucursal, $vendedor );
          while($row = $stmt->fetch() ) {
          $this->clientesSinBeneficio[] = $row;
          $idClientesSinBeneficio[] = $row["ca_idcliente"];
          }

          if ( count($idClientesSinBeneficio) > 0 ){
          Doctrine_Query::create()
          ->update()
          ->from("LibCliente l")
          ->set("l.ca_observaciones", "'Pierde Beneficios por Vencimiento de Circular 0170. [Cupo: '||ca_cupo||' Días: '||ca_diascredito||']\n'||l.ca_observaciones" )
          ->set("ca_cupo", 0)
          ->set("ca_diascredito", 0)
          ->set("ca_usuactualizado", "'Administrador'")
          ->set("ca_fchactualizado", "'".date("Y-m-d H:i:s")."'")
          ->whereIn("ca_idcliente", $idClientesSinBeneficio )
          ->addWhere("ca_diascredito != 0 OR ca_cupo != 0")
          ->execute();
          }

          }
         */

        $layout = $this->getRequestParameter("layout");
        if ($layout) {
            $this->setLayout($layout);
        }
    }

    public function executeReporteEstadosEmail() {
        $empresas = array("Coltrans", "Colmas", "Colotm", "Coldepósitos");

        foreach ($empresas as $empresa) {
            $parametro = Doctrine::getTable("Parametro")->find(array("CU066", 1, "defaultEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $defaultEmail = explode(",", $parametro->getCaValor2());
                } else {
                    $defaultEmail = array($parametro->getCaValor2());
                }
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU066", 2, "ccEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                } else {
                    $ccEmails = array($parametro->getCaValor2());
                }
            }
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("EstadosClientes");
            $email->setCaIdcaso("1");
            $email->setCaFrom("admin@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");
            $email->setCaReplyto("admin@coltrans.com.co");

            while (list ($clave, $val) = each($defaultEmail)) {
                $email->addTo($val);
            }

            while (list ($clave, $val) = each($ccEmails)) {
                $email->addCc($val);
            }

            $inicio = $this->getRequestParameter("fchStart");
            $final = $this->getRequestParameter("fchEnd");
            $empresa = $this->getRequestParameter("empresa");

            $this->getRequest()->setParameter("fchStart", $inicio);
            $this->getRequest()->setParameter("fchEnd", $final);
            $this->getRequest()->setParameter("empresa", $empresa);
            $this->getRequest()->setParameter("layout", "email");

            $email->setCaSubject("Cliente con cambio de Estado, periodo:$inicio a $final en $empresa");
            $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('clientes', 'reporteEstados'));

            $email->save();
        }
    }

    public function executeReporteCartaGarantiaEmail() {
        try {               //  Controla cualquier error el la ejecución de la rutina
            $parametro = Doctrine::getTable("Parametro")->find(array("CU106", 1, "defaultEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $defaultEmail = explode(",", $parametro->getCaValor2());
                } else {
                    $defaultEmail = array($parametro->getCaValor2());
                }
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU106", 2, "ccEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                } else {
                    $ccEmails = array($parametro->getCaValor2());
                }
            }

            $comerciales = UsuarioTable::getComerciales();
            foreach ($comerciales as $comercial) {

                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaTipo("CartaGarantiClientes");
                $email->setCaIdcaso("1");
                $email->setCaFrom("admin@coltrans.com.co");
                $email->setCaFromname("Administrador Sistema Colsys");
                $email->setCaReplyto("admin@coltrans.com.co");

                // $email->setCaFchenvio(date("Y-m-d H:i:s"));  // Hay que quitar cuando salga de seguimiento la rutina

                $email->addTo($comercial->getCaEmail());
                reset($defaultEmail);
                while (list ($clave, $val) = each($defaultEmail)) {
                    $email->addCc($val);
                }
                reset($ccEmails);
                while (list ($clave, $val) = each($ccEmails)) {
                    $email->addCc($val);
                }
                //$email->setCaAddress("alramirez@coltrans.com.co");    // Pruebas de envio controlado

                $inicio = $this->getRequestParameter("fchStart");
                $final = $this->getRequestParameter("fchEnd");
                $sucursal = $comercial->getCaSucursal();
                $vendedor = $comercial->getCaLogin();

                $this->getRequest()->setParameter("fchStart", $inicio);
                $this->getRequest()->setParameter("fchEnd", $final);
                $this->getRequest()->setParameter("sucursal", $sucursal);
                $this->getRequest()->setParameter("vendedor", $vendedor);

                $this->getRequest()->setParameter("layout", "email");

                $email->setCaSubject("Clientes Activos con Vencimiento de Carta de Garantía a : $inicio - $vendedor");

                $bodyHtml = sfContext::getInstance()->getController()->getPresentationFor('clientes', 'reporteCartaGarantia');
                if (strpos($bodyHtml, 'Reporte sin Registros') === false) {
                    $email->setCaBodyhtml($bodyHtml);
                    $email->save();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\n\n" . $e->getTraceAsString();
            $usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.UsuarioPerfil p")
                    ->where("p.ca_perfil = ? ", "sistemas")
                    ->execute();
            /* $parametro = Doctrine::getTable("Parametro")->find(array("CU065",3,"ccEmails"));
              if (stripos($parametro->getCaValor2(), ',') !== false) {
              $ccEmails = explode(",", $parametro->getCaValor2());
              }else {
              $ccEmails = array($parametro->getCaValor2());
              } */

            //Crea el correo electronico
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("CartaGarantia");
            $email->setCaIdcaso("1");
            $email->setCaFrom("admin@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");
            $email->setCaReplyto("admin@coltrans.com.co");

            foreach ($usuarios as $usuario) {
                $email->addTo($usuario->getCaEmail());
            }
            /* reset($ccEmails);
              while (list ($clave, $val) = each ($ccEmails)) {
              $email->addTo( $val );
              } */

            $email->setCaSubject("¡Error en Informe sobre vencimiento Carta de Garantía!");
            $email->setCaBodyhtml("Caught exception: " . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "\n\n Se ha presentado un error en el proceso que envía correo con el reporte Cartas de Garantía por vencer en Maestra de Clientes Activos de COLSYS. Agradecemos confirmar que el Departamento de Sistemas esté enterado de esta falla. Gracias!");
            $email->save(); //guarda el cuerpo del mensaje
        }
    }

    public function executeReporteControlMandatosEmail() {
        try {               //  Controla cualquier error el la ejecución de la rutina
            $defaultEmail = array();
            $usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->where("u.ca_cargo = ? ", "Jefe Nacional de Operaciones")
                    ->execute();
            foreach ($usuarios as $usuario) {
                $defaultEmail[] = $usuario->getCaEmail();
            }

            $comerciales = UsuarioTable::getComerciales();
            foreach ($comerciales as $comercial) {

                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaTipo("ControlMandatos");
                $email->setCaIdcaso("1");
                $email->setCaFrom("admin@coltrans.com.co");
                $email->setCaFromname("Administrador Sistema Colsys");
                $email->setCaReplyto("admin@coltrans.com.co");

                // $email->setCaFchenvio(date("Y-m-d H:i:s"));  // Hay que quitar cuando salga de seguimiento la rutina

                $email->addTo($comercial->getCaEmail());
                $ccEmails = array();
                $usuarios = Doctrine::getTable("Usuario")       // Compia el mensaje a las personas de la sucursal con el perfil control alertas
                        ->createQuery("u")
                        ->innerJoin("u.UsuarioPerfil p")
                        ->innerJoin("u.Sucursal s")
                        ->where("s.ca_nombre = ? ", $comercial->getSucursal()->getCaNombre())
                        ->addWhere("p.ca_perfil = ? ", "control-alertas-aduana-colsys")
                        ->execute();
                foreach ($usuarios as $usuario) {
                    $ccEmails[] = $usuario->getCaEmail();
                }

                reset($defaultEmail);
                while (list ($clave, $val) = each($defaultEmail)) {
                    $email->addCc($val);
                }
                reset($ccEmails);
                while (list ($clave, $val) = each($ccEmails)) {
                    $email->addCc($val);
                }
                //$email->setCaAddress("alramirez@coltrans.com.co");    // Pruebas de envio controlado

                $inicio = $this->getRequestParameter("fchStart");
                $final = $this->getRequestParameter("fchEnd");
                $sucursal = $comercial->getCaSucursal();
                $vendedor = $comercial->getCaLogin();

                $this->getRequest()->setParameter("fchStart", $inicio);
                $this->getRequest()->setParameter("fchEnd", $final);
                $this->getRequest()->setParameter("sucursal", $sucursal);
                $this->getRequest()->setParameter("vendedor", $vendedor);

                $this->getRequest()->setParameter("layout", "email");

                $email->setCaSubject("Clientes Activos con Vencimiento de Documentos de Aduana a : $inicio - $vendedor");

                $bodyHtml = sfContext::getInstance()->getController()->getPresentationFor('clientes', 'reporteControlMandatos');
                if (strpos($bodyHtml, 'Reporte sin Registros') === false) {
                    $email->setCaBodyhtml($bodyHtml);
                    $email->save();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\n\n" . $e->getTraceAsString();
            $usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.UsuarioPerfil p")
                    ->where("p.ca_perfil = ? ", "sistemas")
                    ->execute();

            //Crea el correo electronico
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("ControlMandatos");
            $email->setCaIdcaso("1");
            $email->setCaFrom("admin@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");
            $email->setCaReplyto("admin@coltrans.com.co");

            foreach ($usuarios as $usuario) {
                $email->addTo($usuario->getCaEmail());
            }
            /* reset($ccEmails);
              while (list ($clave, $val) = each ($ccEmails)) {
              $email->addTo( $val );
              } */

            $email->setCaSubject("¡Error en Informe sobre vencimiento Control de Documentos de Aduana!");
            $email->setCaBodyhtml("Caught exception: " . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "\n\n Se ha presentado un error en el proceso que envía correo con el reporte Control de Documentos de Aduana por vencer en Maestra de Clientes Activos de COLSYS. Agradecemos confirmar que el Departamento de Sistemas esté enterado de esta falla. Gracias!");
            $email->save(); //guarda el cuerpo del mensaje
        }
    }

    public function executeReporteClientesEmail() {
        try {               //  Controla cualquier error el la ejecución de la rutina
            $parametro = Doctrine::getTable("Parametro")->find(array("CU112", 1, "defaultEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $defaultEmail = explode(",", $parametro->getCaValor2());
                } else {
                    $defaultEmail = array($parametro->getCaValor2());
                }
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU112", 2, "ccEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                } else {
                    $ccEmails = array($parametro->getCaValor2());
                }
            }

            $comerciales = UsuarioTable::getComerciales();
            foreach ($comerciales as $comercial) {

                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaIdcaso("1");
                $email->setCaFrom("admin@coltrans.com.co");
                $email->setCaFromname("Administrador Sistema Colsys");
                $email->setCaReplyto("admin@coltrans.com.co");

                // $email->setCaFchenvio(date("Y-m-d H:i:s"));  // Hay que quitar cuando salga de seguimiento la rutina

                $email->addTo($comercial->getCaEmail());
                reset($defaultEmail);
                while (list ($clave, $val) = each($defaultEmail)) {
                    $email->addCc($val);
                }
                reset($ccEmails);
                while (list ($clave, $val) = each($ccEmails)) {
                    $email->addCc($val);
                }
                $jefe_inmediato = $comercial->getManager();
                if ($jefe_inmediato and $jefe_inmediato->getCaCargo() != 'Presidente' and $jefe_inmediato->getCaCargo() != 'Gerente General') {
                    if (stristr($email->getCaCc(), $jefe_inmediato->getCaEmail()) === false) {
                        $email->addCc($jefe_inmediato->getCaEmail());    // Copia al Jefe Inmediato
                    }
                }
                // $email->addCc("clopez@coltrans.com.co");    // Pruebas de envio controlado

                $inicio = $this->getRequestParameter("fchStart");
                $final = $this->getRequestParameter("fchEnd");
                $reporte = $this->getRequestParameter("reporte");
                $sucursal = $comercial->getCaSucursal();
                $vendedor = $comercial->getCaLogin();

                $this->getRequest()->setParameter("fchStart", $inicio);
                $this->getRequest()->setParameter("fchEnd", $final);
                $this->getRequest()->setParameter("sucursal", $sucursal);
                $this->getRequest()->setParameter("vendedor", $vendedor);
                $this->getRequest()->setParameter("reporte", $reporte);

                $this->getRequest()->setParameter("layout", "email");
                if ($this->getRequestParameter("reporte") == "Potenciales") {
                    $email->setCaTipo("SeguiCliPotenciales");
                    $email->setCaSubject("Seguimientos a Clientes Potenciales, periodo: $inicio - $final / $vendedor");
                    $bodyHtml = sfContext::getInstance()->getController()->getPresentationFor('clientes', 'reporteSeguimiento');
                } elseif ($this->getRequestParameter("reporte") == "Activos") {
                    $email->setCaTipo("ComportaCliActivos");
                    $email->setCaSubject("Comportamiento de Clientes Activos, periodo: $inicio - $final / $vendedor");
                    $bodyHtml = sfContext::getInstance()->getController()->getPresentationFor('clientes', 'reporteSeguimiento');
                }

                if (strpos($bodyHtml, 'Reporte sin Registros') === false) {
                    $email->setCaBodyhtml($bodyHtml);
                    $email->save();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\n\n" . $e->getTraceAsString();
            $usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.UsuarioPerfil p")
                    ->where("p.ca_perfil = ? ", "sistemas")
                    ->execute();
            /* $parametro = Doctrine::getTable("Parametro")->find(array("CU065",3,"ccEmails"));
              if (stripos($parametro->getCaValor2(), ',') !== false) {
              $ccEmails = explode(",", $parametro->getCaValor2());
              }else {
              $ccEmails = array($parametro->getCaValor2());
              } */

            //Crea el correo electronico
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaIdcaso("1");
            $email->setCaFrom("admin@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");
            $email->setCaReplyto("admin@coltrans.com.co");

            if ($this->getRequestParameter("reporte") == "Potenciales") {
                $email->setCaTipo("SeguimientoClientesPotenciales");
                $email->setCaSubject("¡Error en Informe sobre Seguimiento en Clientes Potenciales!");
            } elseif ($this->getRequestParameter("reporte") == "Activos") {
                $email->setCaTipo("ComportamientoClientesActivos");
                $email->setCaSubject("¡Error en Informe sobre Comportamiento de Clientes Activos!");
            }

            foreach ($usuarios as $usuario) {
                $email->addTo($usuario->getCaEmail());
            }
            /* reset($ccEmails);
              while (list ($clave, $val) = each ($ccEmails)) {
              $email->addTo( $val );
              } */

            $email->setCaBodyhtml("Caught exception: " . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "\n\n Se ha presentado un error en el proceso que envía correo con el reporte Seguimiento en Clientes Potenciales de COLSYS. Agradecemos confirmar que el Departamento de Sistemas esté enterado de esta falla. Gracias!");
            $email->save(); //guarda el cuerpo del mensaje
        }
    }

    public function executeReporteCircularEmail() {
        try {               //  Controla cualquier error el la ejecución de la rutina
            $parametro = Doctrine::getTable("Parametro")->find(array("CU067", 1, "defaultEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $defaultEmail = explode(",", $parametro->getCaValor2());
                } else {
                    $defaultEmail = array($parametro->getCaValor2());
                }
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU067", 2, "ccEmails"));
            if ($parametro) {
                if (stripos($parametro->getCaValor2(), ',') !== false) {
                    $ccEmails = explode(",", $parametro->getCaValor2());
                } else {
                    $ccEmails = array($parametro->getCaValor2());
                }
            }

            $comerciales = UsuarioTable::getComerciales();
            foreach ($comerciales as $comercial) {

                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaTipo("CircularClientes");
                $email->setCaIdcaso("8888");
                $email->setCaFrom("admin@coltrans.com.co");
                $email->setCaFromname("Administrador Sistema Colsys");
                $email->setCaReplyto("admin@coltrans.com.co");

                // $email->setCaFchenvio(date("Y-m-d H:i:s"));  // Hay que quitar cuando salga de seguimiento la rutina

                $email->addTo($comercial->getCaEmail());
                reset($defaultEmail);
                while (list ($clave, $val) = each($defaultEmail)) {
                    $email->addCc($val);
                }
                reset($ccEmails);
                while (list ($clave, $val) = each($ccEmails)) {
                    $email->addCc($val);
                }
                $usuarios = Doctrine::getTable("Usuario")       // Compia el mensaje a las personas de la sucursal con el perfil control alertas
                        ->createQuery("u")
                        ->innerJoin("u.UsuarioPerfil p")
                        ->innerJoin("u.Sucursal s")
                        ->where("s.ca_nombre = ? ", $comercial->getSucursal()->getCaNombre())
                        ->addWhere("p.ca_perfil in ('control-alertas-clientes-colsys', 'control-alertas-aduana-colsys')")
                        ->execute();
                foreach ($usuarios as $usuario) {
                    $email->addCc($usuario->getCaEmail());
                }
                // $email->addCc("clopez@coltrans.com.co");    // Pruebas de envio controlado

                $inicio = $this->getRequestParameter("fchStart");
                $final = $this->getRequestParameter("fchEnd");
                $sucursal = $comercial->getCaSucursal();
                $vendedor = $comercial->getCaLogin();

                $this->getRequest()->setParameter("fchStart", $inicio);
                $this->getRequest()->setParameter("fchEnd", $final);
                $this->getRequest()->setParameter("sucursal", $sucursal);
                $this->getRequest()->setParameter("vendedor", $vendedor);

                $this->getRequest()->setParameter("layout", "email");

                $email->setCaSubject("Clientes Activos con Vencimiento de Circular 170 a : $inicio - $vendedor");
                $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('clientes', 'reporteCircular'));

                $email->save();
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\n\n" . $e->getTraceAsString();
            $usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.UsuarioPerfil p")
                    ->where("p.ca_perfil = ? ", "sistemas")
                    ->execute();
            /* $parametro = Doctrine::getTable("Parametro")->find(array("CU065",3,"ccEmails"));
              if (stripos($parametro->getCaValor2(), ',') !== false) {
              $ccEmails = explode(",", $parametro->getCaValor2());
              }else {
              $ccEmails = array($parametro->getCaValor2());
              } */

            //Crea el correo electronico
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("Circular0170");
            $email->setCaIdcaso("1");
            $email->setCaFrom("admin@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");
            $email->setCaReplyto("admin@coltrans.com.co");

            foreach ($usuarios as $usuario) {
                $email->addTo($usuario->getCaEmail());
            }
            /* reset($ccEmails);
              while (list ($clave, $val) = each ($ccEmails)) {
              $email->addTo( $val );
              } */

            $email->setCaSubject("¡Error en Informe sobre vencimiento Circular0170!");
            $email->setCaBodyhtml("Caught exception: " . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "\n\n Se ha presentado un error en el proceso que envía correo con el reporte Circular 0170 por vencer en Maestra de Clientes Activos de COLSYS. Agradecemos confirmar que el Departamento de Sistemas esté enterado de esta falla. Gracias!");
            $email->save(); //guarda el cuerpo del mensaje
        }
    }

    public function executeReporteListaClinton() {
        $this->setLayout("email");
        try {               //  Controla cualquier error el la ejecución de la rutina
            set_time_limit(0);
            echo "\n\nInicio el proceso : " . date("h:i:s A") . "\n\n";

            $file = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . "clinton.xml";
            sfConfig::set("sf_web_debug", false);

            // $url = "http://www.treas.gov/offices/enforcement/ofac/sdn/sdn.xml";
            $url = "http://www.treasury.gov/ofac/downloads/sdn.xml";        // A partir 15 de diciembre /2010
            unlink($file);

            $handleLocal = fopen($file, 'x');
            //Descarga el archivo
            $handle = fopen($url, 'r');
            if ($handle === false) {
                throw "No se puede leer la url ($url)";
            }
            while (!feof($handle)) {
                $data = fgets($handle, 512);
                if (fwrite($handleLocal, $data) === FALSE) {
                    throw "No se puede escribir al archivo ($nombre_archivo)";
                }
            }
            fclose($handle);
            echo "Temina Lectura de Archivo Plano desde la Pagina Web www.treas.gov : " . date("h:i:s A") . "\n\n";

            echo "Inicia Seleccion de Registro para Colombia y Carga de tablas : " . date("h:i:s A") . "\n\n";
            /* Extrae los datos y los coloca */

            $doc = new DOMDocument();
            $doc->load($file);
            foreach ($doc->childNodes as $sdnEntryTag) {
                if ($sdnEntryTag->nodeName != '#text') {
                    foreach ($sdnEntryTag->childNodes as $item) {
                        $colombia = false;        // Bandera para determinar si el elemento tiene que ver con Colombia
                        $nuevo = false;
                        if ($item->nodeName == 'publshInformation') {
                            foreach ($item->childNodes as $element) {
                                if ($element->nodeName == 'Publish_Date') {  // Captura la Fecha de Publicación del Archivo
                                    // $ultimo = Doctrine::getTable("Parametro")->find(array("CU065", 1, "publishInformation"));
                                    $ultimo = Doctrine::getTable("ColsysConfigValue")
                                            ->createQuery("v")
                                            ->innerJoin("v.ColsysConfig c")
                                            ->where("c.ca_param = ? ", "CU065")
                                            ->addWhere("v.ca_value = ? ", "publishInformation")
                                            ->fetchOne();
                                    if ($ultimo->getCaValue2() == $element->nodeValue) { // Compara con el Caso de Uso
                                        die('Finaliza sin Actualizaciones');
                                    } else {
                                        SdnTable::eliminarRegistros();    // Crea objeto Sdn solo para invocar método que limpia las tablas
                                        $nueva_fecha = $element->nodeValue;
                                    }
                                }
                            }
                        }
                        if ($item->nodeName == 'sdnEntry') {
                            $nuevo = true;
                            $sdnEntry = array();       // Inicializa el arreglo
                            $sdnIdList = array();
                            $sdnAkaList = array();
                            $sdnAddressList = array();
                            foreach ($item->childNodes as $element) {
                                if ($element->nodeName == 'uid') {     // Toma el uid del registro a evaluar
                                    $sdnEntry['uid'] = $element->nodeValue;
                                } else if ($element->nodeName == 'firstName') {  // Evalua por el Apellidos de la Persona o Nombre de Empresa
                                    $sdnEntry[$element->nodeName] = $element->nodeValue;
                                } else if ($element->nodeName == 'lastName') {  // Evalua por el Apellidos de la Persona o Nombre de Empresa
                                    $sdnEntry[$element->nodeName] = $element->nodeValue;
                                } else if ($element->nodeName == 'title') {
                                    $sdnEntry[$element->nodeName] = $element->nodeValue;
                                } else if ($element->nodeName == 'sdnType') {
                                    $sdnEntry[$element->nodeName] = $element->nodeValue;
                                } else if ($element->nodeName == 'remarks') {
                                    $sdnEntry[$element->nodeName] = $element->nodeValue;
                                } else if ($element->nodeName == 'idList') {       // Evalua el elemento por su lista de Identificaciones
                                    foreach ($element->childNodes as $subelement) {
                                        if ($subelement->hasChildNodes()) {
                                            foreach ($subelement->childNodes as $sub2element) {
                                                if ($sub2element->nodeName == 'uid') {
                                                    $uid = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'idType') {
                                                    $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'idNumber') {
                                                    $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'idCountry') {
                                                    $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    $colombia = ($sub2element->nodeValue == 'Colombia') ? true : $colombia;
                                                } else if ($sub2element->nodeName == 'issueDate') {
                                                    $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'expirationDate') {
                                                    $sdnIdList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                } else if ($element->nodeName == 'akaList') {       // Evalua el elemento por su lista de Homónimos
                                    foreach ($element->childNodes as $subelement) {
                                        if ($subelement->hasChildNodes()) {
                                            foreach ($subelement->childNodes as $sub2element) {
                                                if ($sub2element->nodeName == 'uid') {
                                                    $uid = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'type') {
                                                    $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'category') {
                                                    $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'lastName') {
                                                    $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'firstName') {
                                                    $sdnAkaList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                } else if ($element->nodeName == 'addressList') {  // Evalua el elemento por su lista de Direcciones
                                    foreach ($element->childNodes as $subelement) {
                                        if ($subelement->hasChildNodes()) {
                                            foreach ($subelement->childNodes as $sub2element) {
                                                if ($sub2element->nodeName == 'uid') {
                                                    $uid = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'address1') {
                                                    $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'address2') {
                                                    $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'address3') {
                                                    $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'city') {
                                                    $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'stateOrProvince') {
                                                    $sdnAddressList[$uid]['state'] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'postalCode') {
                                                    $sdnAddressList[$uid]['postal'] = $sub2element->nodeValue;
                                                } else if ($sub2element->nodeName == 'country') {
                                                    $sdnAddressList[$uid][$sub2element->nodeName] = $sub2element->nodeValue;
                                                    $colombia = ($sub2element->nodeValue == 'Colombia') ? true : $colombia;
                                                }
                                            }
                                        }
                                    }
                                } else if ($element->nodeName == 'nationalityList') {  // Evalua el elemento por su lista de Direcciones
                                    foreach ($element->childNodes as $subelement) {
                                        if ($subelement->hasChildNodes()) {
                                            foreach ($subelement->childNodes as $sub2element) {
                                                if ($sub2element->nodeName == 'country') {
                                                    $colombia = ($sub2element->nodeValue == 'Colombia') ? true : $colombia;
                                                }
                                            }
                                        }
                                    }
                                } else if ($element->nodeName == 'citizenshipList') {  // Evalua el elemento por su lista de Direcciones
                                    foreach ($element->childNodes as $subelement) {
                                        if ($subelement->hasChildNodes()) {
                                            foreach ($subelement->childNodes as $sub2element) {
                                                if ($sub2element->nodeName == 'country') {
                                                    $colombia = ($sub2element->nodeValue == 'Colombia') ? true : $colombia;
                                                }
                                            }
                                        }
                                    }
                                } else if ($element->nodeName == 'dateOfBirthList') {  // No hace Nada
                                    foreach ($element->childNodes as $subelement) {
                                        if ($subelement->hasChildNodes()) {
                                            foreach ($subelement->childNodes as $sub2element) {
                                                
                                            }
                                        }
                                    }
                                } else if ($element->nodeName == 'placeOfBirthList') {  // Evalua el elemento por su lista de Direcciones
                                    foreach ($element->childNodes as $subelement) {
                                        if ($subelement->hasChildNodes()) {
                                            foreach ($subelement->childNodes as $sub2element) {
                                                if ($sub2element->nodeName == 'placeOfBirth') {
                                                    $colombia = (strpos($sub2element->nodeValue, 'Colombia') !== false) ? true : $colombia;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if ($nuevo and $colombia) {
                            $id = $sdnEntry['uid'];
                            $sdnEntryObj = new Sdn();
                            while (list ($clave, $val) = each($sdnEntry)) {
                                $campo = "setCa" . ucfirst(strtolower($clave));

                                $sdnEntryObj->$campo($val);
                            }
                            $sdnEntryObj->save();

                            if (count($sdnIdList) != 0) {
                                while (list ($sub_id, $arreglo) = each($sdnIdList)) {
                                    $sdnIdListObj = new SdnId();
                                    $sdnIdListObj->setCaUid($id);
                                    $sdnIdListObj->setCaUidId($sub_id);
                                    while (list ($clave, $val) = each($arreglo)) {
                                        $campo = "setCa" . ucfirst(strtolower($clave));
                                        $val = ($campo == "setCaIdnumber" ? substr($val, 0, 40) : $val);
                                        $sdnIdListObj->$campo($val);
                                    }
                                    $sdnIdListObj->save();
                                }
                            }
                            if (count($sdnAkaList) != 0) {
                                while (list ($sub_id, $arreglo) = each($sdnAkaList)) {
                                    $sdnAkaListObj = new SdnAka();
                                    $sdnAkaListObj->setCaUid($id);
                                    $sdnAkaListObj->setCaUidAka($sub_id);
                                    while (list ($clave, $val) = each($arreglo)) {
                                        $campo = "setCa" . ucfirst(strtolower($clave));
                                        $sdnAkaListObj->$campo($val);
                                    }
                                    $sdnAkaListObj->save();
                                }
                            }
                            if (count($sdnAddressList) != 0) {
                                while (list ($sub_id, $arreglo) = each($sdnAddressList)) {
                                    $sdnAddressListObj = new SdnAddress();
                                    $sdnAddressListObj->setCaUid($id);
                                    $sdnAddressListObj->setCaUidAddress($sub_id);
                                    while (list ($clave, $val) = each($arreglo)) {
                                        $campo = "setCa" . ucfirst(strtolower($clave));
                                        $sdnAddressListObj->$campo($val);
                                    }
                                    $sdnAddressListObj->save();
                                }
                            }
                            $nuevo = false;
                        }
                    }
                } else {
                    print_r($sdnEntryTag);
                }
            }


            echo "Termina Carga de tablas : " . date("h:i:s A") . "\n\n";

            echo "Inicia comparativo con Maestra de Clientes: " . date("h:i:s A") . "\n\n";
            $stmt = SdnTable::evaluaClientes();
            $ven_mem = null;
            $msn_mem = '';
            $tit_mem = array("ca_idcliente", "ca_compania", "ca_nombres", "ca_papellido", "ca_sapellido", "ca_vendedor", "sdnm_uid", "sdnm_firstname", "sdnm_lastname", "sdnm_title", "sdnm_sdntype", "sdnm_remarks", "sdid_uid_id", "sdid_idtype", "sdid_idnumber", "sdid_idcountry", "sdid_issuedate", "sdid_expirationdate", "sdal_uid_aka", "sdal_type", "sdal_category", "sdal_firstname", "sdal_lastname", "sdak_uid_aka", "sdak_type", "sdak_category", "sdak_firstname", "sdak_lastname");

            $parametro = Doctrine::getTable("Parametro")->find(array("CU065", 2, "defaultEmails"));
            if (stripos($parametro->getCaValor2(), ',') !== false) {
                $defaultEmail = explode(",", $parametro->getCaValor2());
            } else {
                $defaultEmail = array($parametro->getCaValor2());
            }
            $parametro = Doctrine::getTable("Parametro")->find(array("CU065", 3, "ccEmails"));
            if (stripos($parametro->getCaValor2(), ',') !== false) {
                $ccEmails = explode(",", $parametro->getCaValor2());
            } else {
                $ccEmails = array($parametro->getCaValor2());
            }

            $x = 0;
            while ($row = $stmt->fetch()) {
                if ($row["ca_vendedor"] !== $ven_mem) {
                    if ($msn_mem != '') {
                        $msn_mem .= "</table>";
                        $msn_mem .= "<br / >Fin del Reporte.";
                        reset($ccEmails);
                        while (list ($clave, $val) = each($ccEmails)) {
                            $email->addCc($val);
                        }
                        $email->setCaSubject("Verificación Clientes en Lista OFAC - $ven_mem");
                        $email->setCaBodyhtml($msn_mem);
                        $email->save(); //guarda el cuerpo del mensaje
                    }
                    if ($row["ca_vendedor"] != '') {
                        $user = Doctrine::getTable("Usuario")->find($row["ca_vendedor"]);
                    } else {
                        $user = new Usuario();
                    }

                    //Crea el correo electronico
                    $email = new Email();
                    $email->setCaUsuenvio("Administrador");
                    $email->setCaTipo("SDNList Compair");
                    $email->setCaIdcaso("1");
                    $email->setCaFrom("admin@coltrans.com.co");
                    $email->setCaFromname("Administrador Sistema Colsys");
                    $email->setCaReplyto("admin@coltrans.com.co");

                    if (!$user->getCaEmail()) {
                        while (list ($clave, $val) = each($defaultEmail)) {
                            $email->addTo($val);
                        }
                    } else {
                        $email->addTo($user->getCaEmail());
                        $sucursal = $user->getSucursal();
                        $empleados = $sucursal->getUsuario();
                        foreach ($empleados as $empleado) {
                            if ($empleado->getCaActivo()) {
                                if ($empleado->getCaCargo() == "Jefe Dpto. Administrativo" and ( $empleado->getCaSucursal() == "Barranquilla" or $empleado->getCaSucursal() == "Cali" or $empleado->getCaSucursal() == "Medellín")) {
                                    $email->addCc($user->getCaEmail());
                                } else if ($empleado->getCaCargo() == "Asistente Dpto. Administrativo" and $empleado->getCaSucursal() == "Bucaramanga") {
                                    $email->addCc($user->getCaEmail());
                                } else if ($empleado->getCaCargo() == "Gerente Regional" and $empleado->getCaSucursal() == "Pereira") {
                                    $email->addCc($user->getCaEmail());
                                }
                            }
                        }
                        $email->addCc($val);
                    }
                    $ven_mem = $row["ca_vendedor"];
                    $msn_mem = "El sistema ha encontrado algunas similitudes en su listado de Clientes, comparado con la Lista OFAC del día $nueva_fecha. Favor hacer la respectivas verificaciones y tomar acción en caso de que un cliente haya sido reportado.";
                    $msn_mem .= "<br />";
                    $msn_mem .= "<table width='90%' cellspacing='1' border='1'>";
                    $msn_mem .= "	<tr>";
                    for ($i = 0; $i < count($tit_mem); $i++) {
                        $msn_mem .= "	<th>" . $tit_mem[$i] . "</th>";
                    }
                    $msn_mem .= "	</tr>";
                }
                $msn_mem .= "	<tr>";
                for ($i = 0; $i < count($tit_mem); $i++) {
                    $msn_mem .= "	<td>" . $row[$tit_mem[$i]] . "</td>";
                }
                $msn_mem .= "	</tr>";
            }
            $msn_mem .= "</table>";
            $msn_mem .= "<br / >Fin del Reporte.";

            reset($ccEmails);
            while (list ($clave, $val) = each($ccEmails)) {
                $email->addCc($val);
            }
            $email->setCaSubject("Verificación Clientes en Lista OFAC - " . $ven_mem);
            $email->setCaBodyhtml($msn_mem);
            $email->save(); //guarda el cuerpo del mensaje

            if (isset($ultimo)) {
                $ultimo->setCaValue2($nueva_fecha);
                $ultimo->save();
            }
            echo "Finaliza comparativo con Maestra de Clientes: " . date("h:i:s A") . "\n\n";
            echo "\n \n Fin del Proceso de Importación \n\n";
        } catch (Exception $e) {

            echo $e->getMessage() . "\n\n" . $e->getTraceAsString();
            $usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.UsuarioPerfil p")
                    ->where("p.ca_perfil = ? ", "sistemas")
                    ->addWhere("u.ca_activo = ?", true)
                    ->execute();
            /* $parametro = Doctrine::getTable("Parametro")->find(array("CU065",3,"ccEmails"));
              if (stripos($parametro->getCaValor2(), ',') !== false) {
              $ccEmails = explode(",", $parametro->getCaValor2());
              }else {
              $ccEmails = array($parametro->getCaValor2());
              } */

            //Crea el correo electronico
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("SDNList Compair");
            $email->setCaIdcaso("1");
            $email->setCaFrom("admin@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");
            $email->setCaReplyto("admin@coltrans.com.co");

            foreach ($usuarios as $usuario) {
                $email->addTo($usuario->getCaEmail());
            }
            /* reset($ccEmails);
              while (list ($clave, $val) = each ($ccEmails)) {
              $email->addTo( $val );
              } */

            $email->setCaSubject("¡Error en la Verificación con Lista OFAC!");
            $email->setCaBodyhtml("Caught exception: " . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "\n\n Se ha presentado un error en el proceso que lee la información de Lista OFAC y la compara con la Maestra de Clientes Activos de COLSYS. Agradecemos confirmar que el Departamento de Sistemas esté enterado de esta falla. Gracias!");
            $email->save(); //guarda el cuerpo del mensaje
        }
    }

    public function executeListadoLiberaciones() {

        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->select("s.ca_nombre")
                ->addOrderBy("s.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
    }

    public function executeReporteLiberaciones(sfWebRequest $request) {

        $fchinicial = $this->getRequestParameter("fchStart");

        $fchfinal = $this->getRequestParameter("fchEnd");

        $this->idCliente = $this->getRequestParameter("idcliente");
        $this->cliente = Doctrine::getTable("Cliente")->find($this->idCliente);
        $cliente = $this->cliente;


        $this->forward404unless($this->cliente);


        $q = Doctrine_Manager::getInstance()->connection();
        $query = "select ic.ca_referencia, ic.ca_idcliente, cl.ca_idalterno, cl.ca_compania, ic.ca_fchliberacion, ic.ca_notaliberacion, ic.ca_fchliberado, ii.ca_factura, ic.ca_hbls, u.ca_nombre, u.ca_sucursal";
        $query .= "		from tb_inoclientes_sea ic";
        $query .= "		INNER JOIN vi_clientes_reduc cl ON ic.ca_idcliente = cl.ca_idcliente";
        $query .= "		INNER JOIN tb_inoingresos_sea ii ON ic.ca_idinocliente = ii.ca_idinocliente ";
        $query .= "		INNER JOIN vi_usuarios u ON u.ca_login = ic.ca_usuliberado";
        $query .= "		where ic.ca_fchliberacion IS NOT NULL and ic.ca_fchliberacion BETWEEN '$fchinicial' and '$fchfinal'";
        $query .= "		and cl.ca_compania='$cliente'";
        $query .= "      order by ic.ca_fchliberacion DESC";

        $this->listado = $q->execute($query);
        $this->cliente = $cliente;
        $this->fchinicial = $fchinicial;
        $this->fchfinal = $fchfinal;
    }

    public function executeRc() {
        
    }

    public function executeProcesarRc(sfWebRequest $request) {
//        try 
        {
            $con = Doctrine_Manager::getInstance()->connection();
            $estadisticas = array();
            $folder = "Rc";
            $file = sfConfig::get('app_digitalFile_root') . $folder . DIRECTORY_SEPARATOR . $request->getParameter("archivo");

            chmod($file, 0777);
            $lines = file($file);
            $resultado = array();
            $resultado1 = array();
            $tipos = array("tb_inoingresos_sea", "tb_inoingresos_air", "tb_expo_ingresos", "tb_brk_ingresos");
            $pk = array("tb_inoingresos_sea" => explode(",", "ca_idinoingreso"),
                "tb_inoingresos_air" => explode(",", "ca_referencia,ca_idcliente,ca_hawb,ca_factura"),
                "tb_expo_ingresos" => explode(",", "ca_referencia,ca_idcliente,ca_documento,ca_factura"),
                "tb_brk_ingresos" => explode(",", "ca_referencia,ca_factura"));

            $sql_update = "";
            $total = count($lines);

            $sucRec = array("1" => "BOG", "2" => "MDE", "3" => "CLO", "4" => "BAQ", "5" => "DOLARES", "6" => "PEI", "7" => "BUN", "8" => "CTG", "9" => "BUC");
            $sucFacAssoc = array("BOG" => "1", "CLO" => "2", "MDE" => "3", "BAQ" => "4", "PEI" => "5", "BUN" => "7", "ABO" => "1");
            $sucFac = array("1" => "BOG", "2" => "CLO", "3" => "MDE", "4" => "BAQ", "5" => "PEI", "6" => "BOG", "8" => "MDE", "9" => "CLO", "10" => "BAQ");
            $sqltmp = "";
            for ($i = 0; $i < count($lines); $i++) {
                $sql_update = "";
                $datos = explode(",", $lines[$i]);

                $suc_recibo = (int) str_replace("\"", "", $datos[1]);
                //$suc_factura = (int) str_replace("\"", "", $datos[11]);
                $suc_factura = (int) str_replace("\"", "", $datos[10]);

                //$tipo_comp = str_replace("\"", "", $datos[10]);
                $tipo_comp = str_replace("\"", "", $datos[9]);

                //$nfact = (int) str_replace("\"", "", $datos[12]);
                $nfact = (int) str_replace("\"", "", $datos[11]);

                $pre = str_replace("\"", "", $datos[0]) . ((int) str_replace("\"", "", $datos[1]));

                $nrecibo = (int) str_replace("\"", "", $datos[2]);
                $fecha_pago = Utils::parseDate((int) str_replace("\"", "", $datos[6]));

                //$valor_pago = (float) str_replace("\"", "", $datos[9]);
                $valor_pago = (float) str_replace("\"", "", $datos[8]);

                $comienzo_log = "<b>linea</b>=" . $i . ":::<b>Factura</b>=" . $nfact . ":::<b>Recibo</b>=" . $nrecibo . " ::: ";
                if (count($datos) != 12) {
                    $resultado[$i] = $comienzo_log . "Existen cantidad de campos diferente a los establecidos<br>";
                    $estadisticas["formato_incorrecto"] ++;
                    continue;
                }
                //echo $sucRec[$suc_recibo].'-'.$sucFac[$suc_factura]."<br>";
                if (($suc_recibo != "15" && $suc_recibo != "5" ) && ($suc_factura < 6)) {
                    if ($sucRec[$suc_recibo] != $sucFac[$suc_factura]) {
                        $resultado[$i] = $comienzo_log . "La sucursal registrada en el recibo es diferente a la de la factura (" . $suc_recibo . " :: " . $sucFac[$suc_factura] . ")";
                        $estadisticas["direfente_sucursal"] ++;
                        continue;
                    }
                }
                //echo $nfact."".$tipo_comp."<br>";
                if (!$nfact) {

                    $resultado[$i] = $comienzo_log . "No posee No Factura " . $nfact;
                    $estadisticas["sin_factura"] ++;
                    continue;
                }
                if (strcmp($tipo_comp, 'F') != 0) {
                    $resultado[$i] = $comienzo_log . "No posee No Factura " . $tipo_comp . " ";
                    $estadisticas["sin_factura"] ++;
                    continue;
                }

                //if ($datos[2] == "" && $datos[7] == "") {
                if ($datos[2] == "" && $datos[6] == "") {
                    $resultado[$i] = $comienzo_log . "No posee No Recibo de caja ni fecha de pago";
                    $estadisticas["sin_recibo"] ++;
                    $estadisticas["sin_fecha"] ++;
                    continue;
                }
                if ($datos[2] == "") {
                    $resultado[$i] = $comienzo_log . "No posee No Recibo de caja";
                    $estadisticas["sin_recibo"] ++;
                }
                //if ($datos[7] == "") {
                if ($datos[6] == "") {
                    $resultado[$i] = $comienzo_log . "No posee fecha de pago";
                    $estadisticas["sin_fecha"] ++;
                }

                $encontro = false;
                $actualizo = false;

                if ($suc_recibo == "15" || $suc_recibo == "5") {
                    $sucursal = $this->getUser()->getIdSucursal();
                    //echo "RECIBO L15".$suc_recibo;
                } else
                    $sucursal = $sucRec[$suc_recibo];

                if ($sucursal == "BOG" || $sucursal == "ABO" || $sucursal == "OBO")
                    $sucursal = "'BOG','ABO','OBO'";
                else if ($sucursal == "CLO" || $sucursal == "ACL" || $sucursal == "OCL")
                    $sucursal = "'CLO','ACL','OCL'";
                else
                    $sucursal = "'$sucursal'";

                foreach ($tipos as $tabla) {
                    //$sql="select t.*,u.ca_idsucursal from ".$tabla." t,control.tb_usuarios u where (ca_factura ='".$nfact."' or ca_factura ='F".$suc_factura."-".$nfact."' ) and t.ca_usucreado=u.ca_login and u.ca_idsucursal in ($sucursal) ";
                    $sql = "select t.*,u.ca_idsucursal 
                        from " . $tabla . " t,control.tb_usuarios u "
                            . "where t.ca_fchcreado > '" . Utils::addDate(date("Y-m-d"), 0, 0, -1) . "' and (ca_factura ='" . $nfact . "' or ca_factura ='F" . $suc_factura . "-" . $nfact . "' or ca_factura ='F" . $suc_factura . " " . $nfact . "' or ca_factura ='f" . $suc_factura . "-" . $nfact . "' or ca_factura ='f" . $suc_factura . " " . $nfact . "' ) and t.ca_usucreado=u.ca_login and u.ca_idsucursal in ($sucursal) ";
                    //echo  $sql."<br>";
                    $st = $con->execute($sql);
                    $ref = $st->fetch();

                    if ($ref) {
                        $set = "";
                        $sql_update = "update " . $tabla . " set ";
                        $where = "";
                        if ($nrecibo) {
                            if ($ref["ca_reccaja"] == "" || $ref["ca_reccaja"] == "''") {
                                $set = " ca_reccaja='" . $pre . " " . $nrecibo . "'";
                            } else {
                                $resultado[$i] .= ($resultado[$i] == "") ? $comienzo_log : "";
                                $resultado[$i] .= "-" . $tabla . ":: Recibo de caja ya cargado 'No se actualizo',";
                            }
                        }

                        if ($fecha_pago) {
                            if ($ref["ca_fchpago"] == "") {
                                $set .= ($set != "") ? "," : "";
                                $set .= " ca_fchpago='" . $fecha_pago . "'";
                            } else {
                                $resultado[$i] .= ($resultado[$i] == "") ? $comienzo_log : "";
                                $resultado[$i] .= $tabla . ":: Fecha de pago ya cargada 'No se actualizo',";
                            }
                        }

                        if ($set != "") {
                            foreach ($pk[$tabla] as $p) {
                                $where .= " and $p='" . $ref[$p] . "' ";
                            }
                            //$sql.=$where;
                            $sql_update .= $set . " where 1=1 $where;";
                            $st = $con->execute($sql_update);
                            $sqltmp .= $sql_update . "<br>";
                            $actualizo = true;
                        } else {
                            $actualizo = false;
                        }

                        $encontro = true;
                    }
                    /* else
                      {
                      $resultado[$i].=($resultado[$i]=="")?$comienzo_log:"";
                      $resultado[$i].=$tabla.":: factura NO ENCONTRADA --";
                      } */
                }

                if (!$encontro || !$actualizo) {

                    $sql = "select t.*,u.ca_idsucursal 
                        from " . $tabla . " t,control.tb_usuarios u where (ca_factura ='" . $nfact . "' or ca_factura ='F" . $suc_factura . "-" . $nfact . "' or ca_factura ='F" . $suc_factura . " " . $nfact . "' or ca_factura ='f" . $suc_factura . "-" . $nfact . "' or ca_factura ='f" . $suc_factura . " " . $nfact . "' ) and t.ca_usucreado=u.ca_login and u.ca_idsucursal in ($sucursal) ";
                    $sql = "select                         
                        *
                        from ino.tb_comprobantes c
                        inner join ino.tb_house h ON c.ca_idhouse = h.ca_idhouse
                        inner join ino.tb_master m ON m.ca_idmaster = h.ca_idmaster
                        inner join ino.tb_tipos_comprobante t ON c.ca_idtipo = t.ca_idtipo
                        where ( t.ca_tipo||t.ca_comprobante||'-'||ca_consecutivo =UPPER('F{$suc_factura}-{$nfact}') or t.ca_tipo||t.ca_comprobante||' '||ca_consecutivo =UPPER('F{$suc_factura} {$nfact}') ) ";
                    //and t.ca_idsucursal in (".$sucursal.") ";
                    $st = $con->execute($sql);
                    $ref = $st->fetch();


                    if ($ref) {
                        if ($ref["ca_idcomprobante_cruce"] != "") {
                            $resultado[$i] .= "- ino.Comprobantes:: Recibo de caja ya cargado 'No se actualizo',";
                        } else {
                            //$sql_update.=$set . " where 1=1 $where;";

                            $patron = '/(2\d\d).(\d\d).(\d\d).(\d\d\d\d).(\d\d)/';
                            if (preg_match($patron, $ref["ca_doctransporte"])) {
                                $resultado[$i] .= "-" . $tabla . ":: Referencia con aduana, no se importa por este medio,";
                            } else {
                                continue;
                                $comprobante = Doctrine::getTable("InoComprobante")
                                        ->createQuery("s")
                                        ->select("*")
                                        ->where("ca_idtipo = ? AND ca_consecutivo=? AND ca_idhouse=?", array("12", $pre . " " . $nrecibo, $ref["ca_idhouse"]))
                                        ->fetchOne();

                                if (!$comprobante) {
                                    $comprobante = new InoComprobante();
                                    $comprobante->setCaIdtipo(12);
                                    $comprobante->setCaConsecutivo($pre . " " . $nrecibo);
                                    $comprobante->setCaFchcomprobante($fecha_pago);
                                    $comprobante->setCaIdhouse($ref["ca_idhouse"]);
                                    $comprobante->setCaObservaciones("Ingresado por el proceso de importar RC");
                                    $comprobante->setCaTcambio("1");
                                    $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
                                    $comprobante->setCaId($ref["ca_id"]);
                                    $comprobante->setCaValor($valor_pago);
                                    $comprobante->setCaIdmoneda("COP");
                                    $comprobante->setCaTcambioUsd("1");
                                    $comprobante->setCaValor2($valor_pago);
                                    $comprobante->save();
                                    //echo $comprobante->getCaIdcomprobante();

                                    $comprobante1 = Doctrine::getTable("InoComprobante")->find($ref["ca_idcomprobante"]);
                                    $comprobante1->setCaIdcomprobanteCruce($comprobante->getCaIdcomprobante());
                                    $comprobante1->stopBlaming();
                                    $comprobante1->save();
                                    //$st = $con->execute("insert into ino.tb_comprobantes (ca_idtipo,ca_consecutivo,ca_fchcomprobante,ca_id,ca_idhouse,ca_observaciones)");
                                    $estadisticas["actualizada"] ++;
                                    $resultado[$i] = $comienzo_log . " REGISTRO IMPORTADO";
                                    $encontro = true;
                                    $actualizo = true;
                                } else {
                                    $comprobante1 = Doctrine::getTable("InoComprobante")->find($ref["ca_idcomprobante"]);
                                    $comprobante1->setCaIdcomprobanteCruce($comprobante->getCaIdcomprobante());
                                    $comprobante1->stopBlaming();
                                    $comprobante1->save();

                                    $resultado[$i] .= ($resultado[$i] == "") ? $comienzo_log : "";
                                    $resultado[$i] .= "InoComprobantes:: Rc de caja existe en colsys  'No se actualizo',";
                                }
                            }
                        }
                    }

                    if (!$encontro || !$actualizo) {
                        $resultado[$i] .= ($resultado[$i] == "") ? $comienzo_log : "";
                        if (!$encontro) {
                            $resultado[$i] .= "FACTURA NO ENCONTRADA";
                            $estadisticas["no_encontrado"] ++;
                        }
                        if (!$actualizo) {
                            $resultado[$i] .= "Registro no actualizado";
                            $estadisticas["no_actualizado"] ++;
                        }
                    } else {
                        $estadisticas["actualizada"] ++;
                        $resultado[$i] = $comienzo_log . " REGISTRO IMPORTADO";
                    }
                } else {
                    $estadisticas["actualizada"] ++;
                    $resultado[$i] = $comienzo_log . " REGISTRO IMPORTADO";
                }
            }
            $estadisticas["total"] = $total;
            //print_r($estadisticas);
            //echo $sqltmp;
            $this->responseArray = array("success" => "true", "resultado" => implode("<br>", $resultado), "estadisticas" => $estadisticas, "sqlimpor" => $sqltmp);
        }/* catch (Exception $e) {
          $this->responseArray = array("success" => "false", "errorInfo" => $e->getTraceAsString());
          } */
        $this->setTemplate("responseTemplate");
    }

    public function executeCancelarSuscripcion(sfWebRequest $request) {

        $idcontacto = $this->getRequestParameter("idcontacto");
        $idcliente = $this->getRequestParameter("idcliente");
        $this->aceptacion = $this->getRequestParameter("aceptacion");
        $comentarios = $this->getRequestParameter("comentarios");
        $masiva = $this->getRequestParameter("masiva");

        $this->contacto = Doctrine::getTable("Contacto")->find($idcontacto);

        if ($idcliente == $this->contacto->getCaIdcliente()) {
            $this->cliente = Doctrine::getTable("Cliente")->find($this->contacto->getCaIdcliente());
            if ($this->aceptacion) {
                if ($this->contacto) {
                    $email = new Email();
                    $email->setCaUsuenvio("Administrador");
                    $email->setCaTipo("Not. Masivas");
                    $email->setCaFrom($this->contacto->getCaEmail());
                    $email->setCaReplyto($this->contacto->getCaEmail());
                    $email->setCaFromname($this->contacto->getCaNombres() . " " . $this->contacto->getCaPapellido() . " " . $this->contacto->getCaSapellido());
                    $email->addTo($this->cliente->getUsuario()->getCaEmail());
                    //$email->addTo('alramirez@coltrans.com.co');
                    $email->addCc('alramirez@coltrans.com.co');
                    $email->setCaSubject("Solicitud Desactivación Comunicaciones Masivas");
                    sfContext::getInstance()->getRequest()->setParameter("idcontacto", $idcontacto);
                    sfContext::getInstance()->getRequest()->setParameter("idcliente", $this->contacto->getCaIdcliente());
                    sfContext::getInstance()->getRequest()->setParameter("comentarios", $comentarios);
                    sfContext::getInstance()->getRequest()->setParameter("masiva", $masiva);

                    $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('clientes', 'emailCancelarSuscripcion'));
                    $email->save();

                    if ($masiva) {
                        $this->contacto->setProperty("masivas", $email->getCaIdemail());
                        $this->contacto->save();
                    }
                }
            }
        }

        $this->setLayout('formulario');
    }

    public function executeEmailCancelarSuscripcion(sfWebRequest $request) {

        $idcontacto = $request->getParameter("idcontacto");
        $idcliente = $request->getParameter("idcliente");
        $this->comentarios = $this->getRequestParameter("comentarios");
        $this->masiva = $this->getRequestParameter("masiva");

        $this->contacto = Doctrine::getTable("Contacto")->find($idcontacto);
        $this->cliente = Doctrine::getTable("Cliente")->find($idcliente);

        $this->setLayout("none");
    }

    /*
     * Maestra de Mandatos y Poderes por Cliente
     *
     */

    public function executeMandatosyPoderesExt4(sfWebRequest $request) {
        $this->id = $this->getRequestParameter("id");
    }

    public function executeDatosMandatosyPoderes(sfWebRequest $request) {
        $mandatos = Doctrine::getTable("ManCliente")
                ->createQuery("m")
                ->addWhere("m.ca_idcliente = ?", $this->getRequestParameter("id"))
                ->execute();
        $data = array();

        foreach ($mandatos as $mandato) {
            $data[] = array("idcliente" => $mandato->getCaIdcliente(),
                "idciudad" => $mandato->getCaIdciudad(),
                "ciudad" => utf8_encode($mandato->getCiudad()->getCaCiudad()),
                "idtipo" => $mandato->getCaIdtipo(),
                "tipo" => utf8_encode($mandato->getMandatosTipo()->getCaTipo()),
                "clase" => utf8_encode($mandato->getMandatosTipo()->getCaClase()),
                "fchradicado" => $mandato->getCaFchradicado(),
                "fchvencimiento" => $mandato->getCaFchvencimiento(),
                "idarchivo" => $mandato->getCaIdarchivo(),
                "nombre" => $mandato->getArchivos()->getCaNombre(),
                "observaciones" => $mandato->getCaObservaciones()
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarMandatosyPoderes(sfWebRequest $request) {
        $id = $this->getRequestParameter("id");
        $idtipo = $this->getRequestParameter("idtipo");
        $idciudad = $this->getRequestParameter("idciudad");
        $fchradicado = $this->getRequestParameter("fchradicado");
        $fchvencimiento = $this->getRequestParameter("fchvencimiento");
        $observaciones = $this->getRequestParameter("observaciones");

        $conn = Doctrine::getTable("ManCliente")->getConnection();
        $conn->beginTransaction();
        try {
            $mandatos = Doctrine::getTable("ManCliente")
                    ->createQuery("m")
                    ->addWhere("m.ca_idcliente = ?", $id)
                    ->addWhere("m.ca_idtipo = ?", $idtipo)
                    ->addWhere("m.ca_idciudad = ?", $idciudad)
                    ->fetchOne();
            if (!$mandatos) {
                $mandatos = new ManCliente();
                $mandatos->setCaIdcliente($id);
                $mandatos->setCaIdtipo($idtipo);
                $mandatos->setCaIdciudad($idciudad);
            }
            $mandatos->setCaFchradicado($fchradicado);
            $mandatos->setCaFchvencimiento($fchvencimiento);
            $mandatos->setCaObservaciones($observaciones);
            $mandatos->save();

            $conn->commit();
            $this->responseArray = array("success" => "true");
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarMandatosyPoderes(sfWebRequest $request) {
        $id = $this->getRequestParameter("id");
        $idtipo = $this->getRequestParameter("idtipo");
        $idciudad = $this->getRequestParameter("idciudad");

        $conn = Doctrine::getTable("ManCliente")->getConnection();
        $conn->beginTransaction();
        try {
            $mandatos = Doctrine::getTable("ManCliente")
                    ->createQuery("m")
                    ->addWhere("m.ca_idcliente = ?", $id)
                    ->addWhere("m.ca_idtipo = ?", $idtipo)
                    ->addWhere("m.ca_idciudad = ?", $idciudad)
                    ->fetchOne();
            if ($mandatos) {
                $mandatos->delete();
                $conn->commit();
            }
            $this->responseArray = array("success" => "true");
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosMandatosTipo(sfWebRequest $request) {
        $tipos = Doctrine::getTable("MandatosTipo")
                ->createQuery("m")
                ->addOrderBy("m.ca_clase, m.ca_tipo")
                ->fetchArray();
        //->getSqlQuery();
        foreach ($tipos as $key => $tipo) {
            $data[] = array("idtipo" => $tipo["ca_idtipo"],
                "tipo" => utf8_encode($tipo["ca_tipo"]),
                "clase" => utf8_encode($tipo["ca_clase"])
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarMandatosTipo(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $ids = $ids_reg = array();

        $conn = Doctrine::getTable("MandatosTipo")->getConnection();
        $conn->beginTransaction();
        try {
            foreach ($datos as $dato) {
                if (!$dato->idtipo) {
                    $mandatoTipo = new MandatosTipo();
                } else {
                    $mandatoTipo = Doctrine::getTable("MandatosTipo")
                            ->createQuery("m")
                            ->addWhere("m.ca_idtipo = ?", $dato->idtipo)
                            ->fetchOne();
                }
                if ($dato->tipo) {
                    $mandatoTipo->setCaTipo(utf8_decode($dato->tipo));
                }
                if ($dato->clase) {
                    $mandatoTipo->setCaClase(utf8_decode($dato->clase));
                }
                $mandatoTipo->save();
                $ids[] = $dato->id;
                $ids_reg[] = $mandatoTipo->getCaIdtipo();
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids, "ids_reg" => $ids_reg);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarMandatosTipo(sfWebRequest $request) {
        $idtipo = $request->getParameter("idtipo");

        $conn = Doctrine::getTable("MandatosTipo")->getConnection();
        $mandatoTipo = Doctrine::getTable('MandatosTipo')->find($idtipo);
        $conn->beginTransaction();
        if ($mandatoTipo) {
            try {
                $mandatoTipo->delete();

                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
            }
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeTreeMandatosTipos(sfWebRequest $request) {
        $tipos = Doctrine::getTable("MandatosTipo")
                ->createQuery("m")
                ->addOrderBy("m.ca_clase, m.ca_tipo")
                ->execute();
        $data = array();

        $childrens = array();
        $clase = null;
        $uno = true;
        foreach ($tipos as $tipo) {
            if ($uno) {
                $clase = $tipo->getCaClase();
                $uno = false;
            }
            if ($clase != $tipo->getCaClase()) {
                $data[] = array("text" => utf8_encode($clase), "expanded" => false, "children" => $childrens);
                $clase = $tipo->getCaClase();
                $childrens = array();
            }
            $childrens[] = array("text" => utf8_encode($tipo->getCaTipo()),
                "children" => array("idtipo" => $tipo->getCaIdtipo()),
                "qtip" => $tipo->getCaIdtipo(),
                "leaf" => true
            );
        }
        if ($clase) {
            $data[] = array("text" => $clase, "expanded" => false, "children" => $childrens);
        }

        $this->responseArray = array("text" => "Tipo documento", "expanded" => true, "children" => $data);

        $this->setTemplate("responseTemplate");
    }

    public function executeEncuestaVisitaExt4(sfWebRequest $request) {
        
    }

    public function executeParamDocsExt4(sfWebRequest $request) {
        
    }

    public function executeActualizarParamDocs(sfWebRequest $request) {
        $grid = json_decode($request->getParameter("datosGrid"));
        $conn = Doctrine::getTable("Documentosxconc")->getConnection();
        $conn->beginTransaction();

        try {
            $ids = array();
            foreach ($grid as $registro) {

                $documento = Doctrine::getTable("Documentosxconc")
                        ->createQuery("d")
                        ->addWhere("d.ca_id = ?", $registro->ca_id)
                        ->fetchOne();
                if ($documento) {
                    $documento->setCaIdtipo($registro->ca_idtipo);
                    $documento->setCaTipo($registro->ca_tipo);
                    $documento->setCaIdempresa($registro->ca_idempresa);
                    $documento->setCaPerjuridica($registro->ca_perjuridica);
                    $documento->setCaPerjuridicaReciente($registro->ca_perjuridica_reciente);
                    $documento->setCaPerjuridicaActivos($registro->ca_perjuridica_activos);
                    $documento->setCaGranContribuyente($registro->ca_gran_contribuyente);
                    $documento->setCaPersonaNatural($registro->ca_persona_natural);
                    $documento->setCaPersonaNaturalComerciante($registro->ca_persona_natural_comerciante);
                    $documento->setCaPerjuridicaCincomil($registro->ca_perjuridica_5000);
                    $documento->save();
                    $ids[] = $registro->id;
                }
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "ids" => $ids);
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosParamDocs(sfWebRequest $request) {
        $idempresa = $request->getParameter("idempresa");

        $documentos = Doctrine::getTable("Documentosxconc")
                ->createQuery("d")
                ->select("d.*, p.ca_tipo as ca_documento")
                ->innerJoin("d.IdsTipoDocumento p ON p.ca_idtipo = d.ca_idtipo")
                ->addWhere("d.ca_idempresa = ? ", $idempresa)
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();

        $data = array();
        foreach ($documentos as $documento) {
            $data[] = array(
                'ca_id' => $documento['ca_id'],
                'ca_idtipo' => $documento['ca_idtipo'],
                'ca_tipo' => $documento['ca_tipo'],
                'ca_idempresa' => $documento['ca_idempresa'],
                'ca_perjuridica' => $documento['ca_perjuridica'],
                'ca_perjuridica_reciente' => $documento['ca_perjuridica_reciente'],
                'ca_perjuridica_activos' => $documento['ca_perjuridica_activos'],
                'ca_gran_contribuyente' => $documento['ca_gran_contribuyente'],
                'ca_persona_natural' => $documento['ca_persona_natural'],
                'ca_persona_natural_comerciante' => $documento['ca_persona_natural_comerciante'],
                'ca_perjuridica_5000' => $documento['ca_perjuridica_cincomil'],
                'ca_documento' => utf8_encode($documento['ca_documento'])
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosEncuestaVisita(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");

        $data = array();

        $con = Doctrine_Manager::getInstance()->connection();

        $sql = "select * from tb_concliente c inner join encuestas.tb_encuesta_visita v on (c.ca_idcontacto = v.ca_idcontacto)
                where ca_idcliente = " . $idcliente . " and v.ca_usuanulado is null";

        $rs = $con->execute($sql);
        $encuestas_rs = $rs->fetchAll();
        foreach ($encuestas_rs as $encuesta) {
            $data[] = array("idencuesta" => $encuesta["ca_idencuesta"],
                "idcontacto" => $encuesta["ca_idcontacto"],
                "idsucursal" => $encuesta["ca_idsucursal"],
                "idcliente" => utf8_encode($encuesta["ca_idcliente"]),
                "contacto" => utf8_encode($encuesta["ca_nombres"] . " " . $encuesta["ca_papellido"] . " " . $encuesta["ca_sapellido"]),
                "fchvisita" => utf8_encode($encuesta["ca_fchvisita"]),
                "instalaciones_tipo" => utf8_encode($encuesta["ca_instalaciones_tipo"]),
                "instalaciones_otro" => utf8_encode($encuesta["ca_instalaciones_otro"]),
                "instalaciones_pertenencia" => utf8_encode($encuesta["ca_instalaciones_pertenencia"]),
                "instalaciones_uso" => utf8_encode($encuesta["ca_instalaciones_uso"]),
                "instalaciones_vivienda" => utf8_encode($encuesta["ca_instalaciones_vivienda"]),
                "instalaciones_condiciones" => utf8_encode($encuesta["ca_instalaciones_condiciones"]),
                "sistema_seguridad" => utf8_encode($encuesta["ca_sistema_seguridad"]),
                "sistema_seguridad_otro" => utf8_encode($encuesta["ca_sistema_seguridad_otro"]),
                "manejo_mercancias" => utf8_encode($encuesta["ca_manejo_mercancias"]),
                "manejo_mercancias_zona" => utf8_encode($encuesta["ca_manejo_mercancias_zona"]),
                "manejo_mercancias_detalles" => utf8_encode($encuesta["ca_manejo_mercancias_detalles"]),
                "manejo_mercancias_procedimiento" => utf8_encode($encuesta["ca_manejo_mercancias_procedimiento"]),
                "areas_sensibles" => utf8_encode($encuesta["ca_areas_sensibles"]),
                "control_empleados" => utf8_encode($encuesta["ca_control_empleados"]),
                "control_visitantes" => utf8_encode($encuesta["ca_control_visitantes"]),
                "prevencion_lavado_activos" => utf8_encode($encuesta["ca_prevencion_lavado_activos"]),
                "certificaciones" => utf8_encode($encuesta["ca_certificacion"]),
                "certificaciones_otro" => utf8_encode($encuesta["ca_certificacion_otro"]),
                "implementacion_sistema" => utf8_encode($encuesta["ca_implementacion_sistema"]),
                "implementacion_sistema_detalles" => utf8_encode($encuesta["ca_implementacion_sistema_detalles"]),
                "recomienda_trabajar" => utf8_encode($encuesta["ca_recomienda_trabajar"]),
                "observaciones" => utf8_encode($encuesta["ca_observaciones"]),
                "concepto_seguridad" => utf8_encode($encuesta["ca_concepto_seguridad"])
            );
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosEncuestaVisitaById(sfWebRequest $request) {
        $idencuesta = $request->getParameter("idencuesta");
        if ($idencuesta) {
            $con = Doctrine_Manager::getInstance()->connection();

            $sql = "select * from tb_concliente c inner join encuestas.tb_encuesta_visita v on (c.ca_idcontacto = v.ca_idcontacto)
                where v.ca_idencuesta = " . $idencuesta . " and v.ca_usuanulado is null";

            $rs = $con->execute($sql);
            $encuestas_rs = $rs->fetchAll();
            foreach ($encuestas_rs as $encuesta) {
                $data = array("idencuesta" => $encuesta["ca_idencuesta"],
                    "idcontacto" => $encuesta["ca_idcontacto"],
                    "idcliente" => utf8_encode($encuesta["ca_idcliente"]),
                    "contacto" => utf8_encode($encuesta["ca_nombres"] . " " . $encuesta["ca_papellido"] . " " . $encuesta["ca_sapellido"]),
                    "fchvisita" => utf8_encode($encuesta["ca_fchvisita"]),
                    "politica_seguridad_salud" => utf8_encode($encuesta["ca_politica_seguridad_salud"]),
                    "mano_obra_infantil" => utf8_encode($encuesta["ca_mano_obra_infantil"]),
                    "peligros_riesgos_identificados" => utf8_encode($encuesta["ca_peligros_riesgos_identificados"]),
                    "peligros_riesgos_identificar" => utf8_encode($encuesta["ca_peligros_riesgos_identificar"]),
                    "riesgos_control" => utf8_encode($encuesta["ca_riesgos_control"]),
                    "requisitos_legales_conocimiento" => utf8_encode($encuesta["ca_requisitos_legales_conocimiento"]),
                    "requisitos_legales_aplicacion" => utf8_encode($encuesta["ca_requisitos_legales_aplicacion"]),
                    "requisitos_legales_detalles" => utf8_encode($encuesta["ca_requisitos_legales_detalles"]),
                    "pago_seguridad_social" => utf8_encode($encuesta["ca_pago_seguridad_social"]),
                    "panorama_riesgos" => utf8_encode($encuesta["ca_panorama_riesgos"]),
                    "respuesta_emergencias" => utf8_encode($encuesta["ca_respuesta_emergencias"]),
                    "numero_personas" => utf8_encode($encuesta["ca_numero_personas"]),
                    "instalaciones_tipo" => utf8_encode($encuesta["ca_instalaciones_tipo"]),
                    "instalaciones_pertenencia" => utf8_encode($encuesta["ca_instalaciones_pertenencia"]),
                    "instalaciones_uso" => utf8_encode($encuesta["ca_instalaciones_uso"]),
                    "areas_sensibles" => utf8_encode($encuesta["ca_areas_sensibles"]),
                    "areas_autorizadas" => utf8_encode($encuesta["ca_areas_autorizadas"]),
                    "sistema_seguridad" => utf8_encode($encuesta["ca_sistema_seguridad"]),
                    "manejo_mercancias" => utf8_encode($encuesta["ca_manejo_mercancias"]),
                    "certificacion" => utf8_encode($encuesta["ca_certificacion"]),
                    "certificacion_detalles" => utf8_encode($encuesta["ca_certificacion_detalles"]),
                    "implementacion_plan" => utf8_encode($encuesta["ca_implementacion_plan"]),
                    "implementacion_plan_detalles" => utf8_encode($encuesta["ca_implementacion_plan_detalles"]),
                    "evaluacion_terceros" => utf8_encode($encuesta["ca_evaluacion_terceros"]),
                    "evaluacion_personal" => utf8_encode($encuesta["ca_evaluacion_personal"]),
                    "programas_capacitacion" => utf8_encode($encuesta["ca_programas_capacitacion"]),
                    "manejo_mercancias_proceso" => utf8_encode($encuesta["ca_manejo_mercancias_proceso"]),
                    "prevencion_lavado_activos" => utf8_encode($encuesta["ca_prevencion_lavado_activos"]),
                    "manejo_mercancias_zona" => utf8_encode($encuesta["ca_manejo_mercancias_zona"]),
                    "manejo_mercancias_detalles" => utf8_encode($encuesta["ca_manejo_mercancias_detalles"]),
                    "control_empleados" => utf8_encode($encuesta["ca_control_empleados"]),
                    "control_empleados_detalles" => utf8_encode($encuesta["ca_control_empleados_detalles"]),
                    "control_visitantes" => utf8_encode($encuesta["ca_control_visitantes"]),
                    "control_visitantes_detalles" => utf8_encode($encuesta["ca_control_visitantes_detalles"]),
                    "seguridad_informatica" => utf8_encode($encuesta["ca_seguridad_informatica"]),
                    "seguridad_informatica_detalles" => utf8_encode($encuesta["ca_seguridad_informatica_detalles"]),
                    "personal_calificado" => utf8_encode($encuesta["ca_personal_calificado"]),
                    "observaciones" => utf8_encode($encuesta["ca_observaciones"]),
                    "concepto_seguridad" => utf8_encode($encuesta["ca_concepto_seguridad"]),
                    "recomienda_trabajar" => utf8_encode($encuesta["ca_recomienda_trabajar"])
                );
            }

            $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "data" => $data, "total" => count($data));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeAnularEncuestaVisita(sfWebRequest $request) {
        $idencuesta = $request->getParameter("idencuesta");
        $encuestaVisita = new EncuestaVisita();
        $conn = Doctrine::getTable("EncuestaVisita")->getConnection();
        $encuestaVisita = Doctrine::getTable('EncuestaVisita')->find($idencuesta);
        $conn->beginTransaction();
        try {
            $encuestaVisita->setCaUsuanulado($this->getUser()->getUserId());
            $encuestaVisita->setCaFchanulado(date("Y-m-d H:i:s"));
            $encuestaVisita->save();
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarEncuestaVisita(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $nuevo = false;
        $conn = Doctrine::getTable("EncuestaVisita")->getConnection();
        $conn->beginTransaction();
        try {
            $encuestaVisita = new EncuestaVisita();

            if ($datos->idcontacto) {
                $encuestaVisita->setCaIdcontacto($datos->idcontacto);
            }
            if ($datos->idsucursal) {
                $encuestaVisita->setCaIdsucursal($datos->idsucursal);
            }
            if ($datos->fchvisita) {
                $encuestaVisita->setCaFchvisita($datos->fchvisita);
            }
            if ($datos->instalaciones_tipo) {
                $encuestaVisita->setCaInstalacionesTipo(utf8_decode($datos->instalaciones_tipo));
            }
            if ($datos->instalaciones_otro) {
                $encuestaVisita->setCaInstalacionesOtro(utf8_decode($datos->instalaciones_otro));
            }
            if ($datos->instalaciones_pertenencia) {
                $encuestaVisita->setCaInstalacionesPertenencia($datos->instalaciones_pertenencia);
            }
            if ($datos->instalaciones_uso) {
                $encuestaVisita->setCaInstalacionesUso($datos->instalaciones_uso);
            }
            if ($datos->instalaciones_vivienda) {
                $encuestaVisita->setCaInstalacionesVivienda($datos->instalaciones_vivienda);
            }
            if ($datos->instalaciones_condiciones) {
                $encuestaVisita->setCaInstalacionesCondiciones($datos->instalaciones_condiciones);
            }
            if ($datos->sistema_seguridad) {
                $encuestaVisita->setCaSistemaSeguridad(utf8_decode($datos->sistema_seguridad));
            }
            if ($datos->sistema_seguridad_otro) {
                $encuestaVisita->setCaSistemaSeguridadOtro(utf8_decode($datos->sistema_seguridad_otro));
            }
            if ($datos->manejo_mercancias) {
                $encuestaVisita->setCaManejoMercancias($datos->manejo_mercancias);
            }
            if ($datos->manejo_mercancias_zona) {
                $encuestaVisita->setCaManejoMercanciasZona($datos->manejo_mercancias_zona);
            }
            if ($datos->manejo_mercancias_detalles) {
                $encuestaVisita->setCaManejoMercanciasDetalles(utf8_decode($datos->manejo_mercancias_detalles));
            }
            if ($datos->manejo_mercancias_procedimiento) {
                $encuestaVisita->setCaManejoMercanciasProcedimiento(utf8_decode($datos->manejo_mercancias_procedimiento));
            }
            if ($datos->areas_sensibles) {
                $encuestaVisita->setCaAreasSensibles($datos->areas_sensibles);
            }
            if ($datos->control_empleados) {
                $encuestaVisita->setCaControlEmpleados($datos->control_empleados);
            }
            if ($datos->control_visitantes) {
                $encuestaVisita->setCaControlVisitantes($datos->control_visitantes);
            }
            if ($datos->prevencion_lavado_activos) {
                $encuestaVisita->setCaPrevencionLavadoActivos($datos->prevencion_lavado_activos);
            }
            if ($datos->certificacion) {
                $encuestaVisita->setCaCertificacion($datos->certificacion);
            }
            if ($datos->certificacion_otro) {
                $encuestaVisita->setCaCertificacionOtro($datos->certificacion_otro);
            }
            if ($datos->implementacion_sistema) {
                $encuestaVisita->setCaImplementacionSistema($datos->implementacion_sistema);
            }
            if ($datos->implementacion_sistema_detalles) {
                $encuestaVisita->setCaImplementacionSistemaDetalles(utf8_decode($datos->implementacion_sistema_detalles));
            }
            if ($datos->recomienda_trabajar) {
                $encuestaVisita->setCaRecomiendaTrabajar($datos->recomienda_trabajar);
            }
            if ($datos->observaciones) {
                $encuestaVisita->setCaObservaciones(utf8_decode($datos->observaciones));
            }
            if ($datos->concepto_seguridad) {
                $encuestaVisita->setCaConceptoSeguridad(utf8_decode($datos->concepto_seguridad));
            }
            $encuestaVisita->save();
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeImprimirEncuestaVisita(sfWebRequest $request) {
        $idencuesta = $request->getParameter("id");
        if ($idencuesta) {
            $this->encuestaVisita = Doctrine::getTable('EncuestaVisita')->find($idencuesta);
            $sql = "select ca_coltrans_std, ca_coltrans_fch, ca_colmas_std, ca_colmas_fch, ca_colotm_std, ca_colotm_fch, ca_coldepositos_std, ca_coldepositos_fch "
                    . "from vi_clientes where ca_idcliente = " . $this->encuestaVisita->getContacto()->getCaIdcliente();

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->estados = $st->fetchAll()[0];
        } else {
            $this->encuestaVisita = new EncuestaVisita();
        }
    }

    public function executeControlFinancieroExt4(sfWebRequest $request) {
        
    }

    public function executeActualizarControlFinanciero(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datosGrid = $request->getParameter("datosGrid");
        $datosGrid = json_decode($datosGrid);
        $datosGridFinanciera = $request->getParameter("datosGridFinanciera");
        $datosGridFinanciera = json_decode($datosGridFinanciera);
        $datos = json_decode($datos);
        $nuevo = false;
        $ids = array();

        $con = Doctrine_Manager::getInstance()->connection();

        $idcliente = $datos->idcliente;
        $conn = Doctrine::getTable("IdsCliente")->getConnection();
        $cliente = Doctrine::getTable('IdsCliente')->find($idcliente);

        if ($cliente) {
            $conn->beginTransaction();
            try {
                foreach ($datosGrid as $datoGrid) {
                    $documentosxConc = Doctrine::getTable("Documentosxconc")
                            ->createQuery("d")
                            ->addWhere("d.ca_idtipo = ?", $datoGrid->idtipo)
                            ->execute();
                    foreach ($documentosxConc as $documentoxConc) {
                        $doccliente = Doctrine::getTable("Doccliente")
                                ->createQuery("d")
                                ->addWhere("d.ca_idtipo = ?", $documentoxConc->getCaId())
                                ->addWhere("d.ca_idcliente = ?", $idcliente)
                                ->fetchOne();
                        if (!$doccliente) {
                            $doccliente = new Doccliente();
                            $doccliente->setCaIdcliente($idcliente);
                            $doccliente->setCaIdtipo($documentoxConc->getCaId());
                        }
                        if ($datoGrid->fch_documento) {
                            $doccliente->setCaFchdocumento($datoGrid->fch_documento);
                        }
                        if ($datoGrid->observaciones) {
                            $doccliente->setCaObservaciones(utf8_decode($datoGrid->observaciones));
                        }
                        $doccliente->save();
                        $ids[] = $datoGrid->id;
                        $borrado[] = $documentoxConc->getCaId();
                    }
                }

                if (!empty($borrado)) {
                    $sql = "delete from tb_doccliente where ca_idcliente = $idcliente and ca_idtipo not in (" . implode(",", $borrado) . ")";
                    $rs = $con->execute($sql);
                }

                if ($datos->fchcircular) {
                    $cliente->setCaFchcircular($datos->fchcircular);
                }
                if ($datos->nvlriesgo) {
                    $cliente->setCaNvlriesgo(utf8_decode($datos->nvlriesgo));
                }
                if ($datos->leyinsolvencia) {
                    $cliente->setCaLeyinsolvencia(utf8_decode($datos->leyinsolvencia));
                }
                if ($datos->comentario) {
                    $cliente->setCaComentario(utf8_decode($datos->comentario));
                }
                if ($datos->listaclinton) {
                    $cliente->setCaListaclinton(utf8_decode($datos->listaclinton));
                }
                if ($datos->iso) {
                    $cliente->setCaIso(utf8_decode($datos->iso));
                }
                if ($datos->iso_detalles) {
                    $cliente->setCaIsoDetalles(utf8_decode($datos->iso_detalles));
                }
                if ($datos->basc) {
                    $cliente->setCaBasc(utf8_decode($datos->basc));
                }
                if ($datos->otro_cert) {
                    $cliente->setCaOtroCert(utf8_decode($datos->otro_cert));
                }
                if ($datos->otro_detalles) {
                    $cliente->setCaOtroDetalles(utf8_decode($datos->otro_detalles));
                }
                if ($datos->tipopersona) {
                    $cliente->setCaTipopersona(utf8_decode($datos->tipopersona));
                }
                if ($datos->sectoreconomico) {
                    $cliente->setCaSector(utf8_decode($datos->sectoreconomico));
                }
                if ($datos->fechaconstitucion) {
                    $cliente->setCaFchconstitucion(utf8_decode($datos->fechaconstitucion));
                }
                if ($datos->regimen) {
                    $cliente->setCaRegimen($datos->regimen);
                }
                if ($datos->uap) {
                    $cliente->setCaUap($datos->uap);
                }
                if ($datos->altex) {
                    $cliente->setCaAltex($datos->altex);
                }
                if ($datos->comerciante) {
                    $cliente->setCaComerciante($datos->comerciante);
                }
                if ($datos->cod_ciiu_uno) {
                    $cliente->setCaCiiuUno($datos->cod_ciiu_uno);
                }
                if ($datos->cod_ciiu_dos) {
                    $cliente->setCaCiiuDos($datos->cod_ciiu_dos);
                }
                if ($datos->cod_ciiu_trs) {
                    $cliente->setCaCiiuTrs($datos->cod_ciiu_trs);
                }
                if ($datos->cod_ciiu_ctr) {
                    $cliente->setCaCiiuCtr($datos->cod_ciiu_ctr);
                }
                if ($datos->numempleados) {
                    $cliente->setCaMenosxempleados($datos->numempleados);
                }
                $cliente->setCaFchfinanciero(date("Y-m-d H:i:s"));
                $cliente->setCaUsufinanciero($this->getUser()->getUserId());

                $cliente->save();
                $conn->commit();

                $conect = Doctrine::getTable("Blccliente")->getConnection();
                $conect->beginTransaction();

                foreach ($datosGridFinanciera as $datoGridFinanciera) {
                    $blccliente = Doctrine::getTable("Blccliente")
                            ->createQuery("d")
                            ->where("d.ca_idcliente = ?", $idcliente)
                            ->addWhere("d.ca_anno = ?", $datoGridFinanciera->ca_anno)
                            ->fetchOne();

                    if ($blccliente) {
                        if ($datoGridFinanciera->ca_activostotales) {
                            $blccliente->setCaActivostotales($datoGridFinanciera->ca_activostotales);
                        }
                        if ($datoGridFinanciera->ca_activoscorrientes) {
                            $blccliente->setCaActivoscorrientes($datoGridFinanciera->ca_activoscorrientes);
                        }
                        if ($datoGridFinanciera->ca_pasivostotales) {
                            $blccliente->setCaPasivostotales($datoGridFinanciera->ca_pasivostotales);
                        }
                        if ($datoGridFinanciera->ca_pasivoscorrientes) {
                            $blccliente->setCaPasivoscorrientes($datoGridFinanciera->ca_pasivoscorrientes);
                        }
                        if ($datoGridFinanciera->ca_inventarios) {
                            $blccliente->setCaInventarios($datoGridFinanciera->ca_inventarios);
                        }
                        if ($datoGridFinanciera->ca_patrimonios) {
                            $blccliente->setCaPatrimonios($datoGridFinanciera->ca_patrimonios);
                        }
                        if ($datoGridFinanciera->ca_utilidades) {
                            $blccliente->setCaUtilidades($datoGridFinanciera->ca_utilidades);
                        }
                        if ($datoGridFinanciera->ca_ventas) {
                            $blccliente->setCaVentas($datoGridFinanciera->ca_ventas);
                        }
                        $blccliente->save();
                    }
                }
                $conect->commit();
                $this->responseArray = array("success" => true, "ids" => $ids);
            } catch (Exception $e) {
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosControlFinanciero(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $tipopersona = $request->getParameter("tipo");
        $activostotales = $request->getParameter("activostotales");

        $fechconstitucion = $request->getParameter("fechconstitucion");
        $anioactual = date("Y");
        $minimo = Doctrine::getTable('Smlv')->find($anioactual);

        if ($minimo && $tipopersona != "ca_gran_contribuyente_uap") {
            if (($activostotales / $minimo->getCaSmlv()) < 500) {
                $tipopersona = "ca_perjuridica_activos";
            }
        }

        if ($tipopersona == "ca_gran_contribuyente_uap") {
            $tipopersona = "ca_gran_contribuyente";
        }

        if ($tipopersona == "ca_perjuridica" || $tipopersona == "ca_gran_contribuyente" || $tipopersona == "ca_perjuridica_activos") {
            $fechahaceunano = date("Y") - 1 . "-" . date("m") . "-" . date("d");
            if ($fechconstitucion) {
                if ($fechahaceunano < $fechconstitucion) {
                    $tipopersona = "ca_perjuridica_reciente";
                }
            }
        }

        $data = array();
        if ($tipopersona) {
            $con = Doctrine_Manager::getInstance()->connection();
            $sql = "select distinct tpd.ca_idtipo as a, tpd.ca_tipo as ca_tipo, tpd.ca_equivalentea, ";
            $sql .= " dc.ca_fchdocumento as ca_fchdocumento, dc.ca_observaciones as ca_observaciones ";
            $sql .= " from tb_doccliente dc ";
            $sql .= " inner join ids.tb_documentosxconc dxc ON (dxc.ca_id = dc.ca_idtipo and dc.ca_idcliente = $idcliente) ";
            $sql .= "right join ids.tb_tipodocumentos tpd ON (tpd.ca_idtipo = dxc.ca_idtipo) ";
            $sql .= " where tpd.ca_equivalentea = 25 ";
            $sql .= "order by tpd.ca_idtipo";

            $rs = $con->execute($sql);
            $control_rs = $rs->fetchAll();
            foreach ($control_rs as $control) {
                $seleccionado = false;
                if ($control["ca_fchdocumento"]) {
                    $seleccionado = true;
                }
                $data[] = array(
                    "idtipo" => $control["a"],
                    "iddocumento" => /* $control["ca_iddocumento"] */"",
                    "empresa" => /* $control["ca_nombre"] */"",
                    "documento" => utf8_encode($control["ca_tipo"]),
                    "fch_vigencia" => /* $control["ca_fchvigencia"] */"",
                    "fch_documento" => $control["ca_fchdocumento"],
                    "seleccionado" => $seleccionado,
                    "observaciones" => utf8_encode($control["ca_observaciones"])
                );
            }
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeAgaduanaAutorizadoExt4(sfWebRequest $request) {
        
    }

    public function executeDatosAgaduanaAutorizado(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $data = array();
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select ca_idcliente, ca_idagaduana, ca_nombre, ca_iddocumento, ca_fchvigencia, ca_fchautorizacion from tb_aducliente a inner join ids.tb_ids i on (i.ca_id = a.ca_idagaduana) where a.ca_idcliente= " . $idcliente . " and ca_usuanulado is null";
        $rs = $con->execute($sql);
        $aduclientes = $rs->fetchAll();

        foreach ($aduclientes as $aducliente) {
            $data[] = array("idcliente" => $aducliente["ca_idcliente"],
                "id_agente" => $aducliente["ca_idagaduana"],
                "nombre_agente" => utf8_encode($aducliente["ca_nombre"]),
                "fecha_vigencia" => $aducliente["ca_fchvigencia"],
                "fecha_autorizacion" => $aducliente["ca_fchautorizacion"],
                "iddocumento" => utf8_encode($aducliente["ca_iddocumento"]));
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeAnularAgaduanaAutorizado(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $id_agente = $request->getParameter("id_agente");

        $conn = Doctrine::getTable("IdsCliente")->getConnection();
        $conn->beginTransaction();

        $aducliente = new AduCliente();
        $aducliente = Doctrine::getTable("AduCliente")
                ->createQuery("d")
                ->where("d.ca_idagaduana = ?", $id_agente)
                ->addWhere("d.ca_idcliente = ?", $idcliente)
                ->fetchOne();
        if ($aducliente) {
            $aducliente->setCaUsuanulado($this->getUser()->getUserId());
            $aducliente->setCaFchanulado(date("Y-m-d H:i:s"));
            $aducliente->save();
            $conn->commit();
        }
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarAgaduanaAutorizado(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $ids = array();
        $idclientes = array();

        $conn = Doctrine::getTable("AduCliente")->getConnection();
        $conn->beginTransaction();
        try {
            foreach ($datos as $dato) {
                $agente = Doctrine::getTable('Ids')->find($dato->id_agente);
                if ($agente) {
                    $aducliente = Doctrine::getTable("AduCliente")
                            ->createQuery("d")
                            ->where("d.ca_idagaduana = ?", $dato->id_agente)
                            ->addWhere("d.ca_idcliente = ?", $idcliente)
                            ->addWhere("d.ca_fchanulado IS NULL")
                            ->fetchOne();

                    if (!$aducliente) {
                        $aducliente = new AduCliente();
                        $aducliente->setCaIdcliente($idcliente);
                        $aducliente->setCaIdagaduana($dato->id_agente);
                    }
                    $aducliente->setCaFchvigencia($dato->fecha_vigencia);
                    $aducliente->setCaFchautorizacion($dato->fecha_autorizacion);
                    $aducliente->save();
                    $idclientes[] = $aducliente->getCaIdcliente();
                }
                $ids[] = $dato->id;
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "id" => $ids, "idclientes" => $idclientes);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeActualizarDocumentoAgaduana(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $id_agente = $request->getParameter("id_agente");
        $idarchivo = $request->getParameter("idarchivo");

        if ($id_agente && $idcliente && $idarchivo) {
            $aducliente = Doctrine::getTable("AduCliente")
                    ->createQuery("d")
                    ->where("d.ca_idagaduana = ?", $id_agente)
                    ->addWhere("d.ca_idcliente = ?", $idcliente)
                    ->fetchOne();

            if ($aducliente) {
                $aducliente->setCaIddocumento($idarchivo);
                $aducliente->save();
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeFichaTecnicaExt4(sfWebRequest $request) {
        
    }

    public function executeDatosFichaTecnica(sfWebRequest $request) {
        
    }

    public function executeDatosTransporteFichaTecnica(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $fichatecnica = new FichaTecnica();
        $fichatecnica = Doctrine::getTable("FichaTecnica")
                ->createQuery("d")
                ->where("d.ca_idcliente = ?", $idcliente)
                ->fetchOne();

        $this->responseArray = array("success" => true, "root" => json_decode(utf8_encode($fichatecnica->getCaTransporteinternacional())));
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosContactosFichaTecnica(sfWebrequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $fichatecnica = new FichaTecnica();
        $fichatecnica = Doctrine::getTable("FichaTecnica")
                ->createQuery("d")
                ->where("d.ca_idcliente = ?", $idcliente)
                ->fetchOne();

        $this->responseArray = array("success" => true, "root" => json_decode(utf8_encode($fichatecnica->getCaContactos())));
        $this->setTemplate("responseTemplate");
    }

    public function executeActualizarFichaTecnica(sfWebRequest $request) {
        $datos = $request->getParameter("datos");

        $datosGrilla = $request->getParameter("datosGrid");
        $datosGridCO = $request->getParameter("datosGridCO");
        $idcliente = $request->getParameter("idcliente");
        $conn = Doctrine::getTable("FichaTecnica")->getConnection();
        $conn->beginTransaction();
        try {
            $fichatecnica = new FichaTecnica();
            $fichatecnica = Doctrine::getTable("FichaTecnica")
                    ->createQuery("d")
                    ->where("d.ca_idcliente = ?", $idcliente)
                    ->fetchOne();
            if (!$fichatecnica) {
                $fichatecnica = new FichaTecnica();
                $fichatecnica->setCaIdcliente($idcliente);
            }
            $fichatecnica->setCaTransporteinternacional(utf8_decode($datosGrilla));
            $fichatecnica->setCaContactos(utf8_decode($datosGridCO));
            $fichatecnica->setCaDocumentacion(utf8_decode($datos));
            $fichatecnica->save();
            $conn->commit();
            $this->responseArray = array("success" => true, "f" => $datos->fchvencimientoRCE);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->responseArray = array("success" => true);

        $this->setTemplate("responseTemplate");
    }

    public function executeFichaTecnicaPdf(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $conn = Doctrine::getTable("FichaTecnica")->getConnection();
        $this->fichatecnica = Doctrine::getTable("FichaTecnica")
                ->createQuery("d")
                ->where("d.ca_idcliente = ?", $idcliente)
                ->fetchOne();

        $this->setTemplate("fichaTecnicaPdf");
    }

    public function executeGuardarDatosFinancieros(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $anno = $request->getParameter("anno");
        $activostotales = $request->getParameter("activostotales");
        $activoscorrientes = $request->getParameter("activoscorrientes");
        $pasivostotales = $request->getParameter("pasivostotales");
        $pasivoscorrientes = $request->getParameter("pasivoscorrientes");
        $inventarios = $request->getParameter("inventarios");
        $patrimonios = $request->getParameter("patrimonios");
        $utilidades = $request->getParameter("utilidades");
        $ventas = $request->getParameter("ventas");

        $conn = Doctrine::getTable("BlcCliente")->getConnection();
        $conn->beginTransaction();

        try {
            $blccliente = Doctrine::getTable("BlcCliente")
                    ->createQuery("d")
                    ->where("d.ca_idcliente = ?", $idcliente)
                    ->addWhere("d.ca_anno = ?", $anno)
                    ->fetchOne();

            if (!$blccliente) {
                $blccliente = new BlcCliente();
                $blccliente->setCaIdcliente($idcliente);
                $blccliente->setCaAnno($anno);
            }
            $blccliente->setCaActivostotales($activostotales);
            $blccliente->setCaActivoscorrientes($activoscorrientes);
            $blccliente->setCaPasivostotales($pasivostotales);
            $blccliente->setCaPasivoscorrientes($pasivoscorrientes);
            $blccliente->setCaInventarios($inventarios);
            $blccliente->setCaPatrimonios($patrimonios);
            $blccliente->setCaUtilidades($utilidades);
            $blccliente->setCaVentas($ventas);
            $blccliente->save();

            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeAnularInfoFinanciera(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");
        $anno = $request->getParameter("anno");
        $conn = Doctrine::getTable("BlcCliente")->getConnection();
        $conn->beginTransaction();

        try {
            $blccliente = Doctrine::getTable("BlcCliente")
                    ->createQuery("d")
                    ->where("d.ca_idcliente = ?", $idcliente)
                    ->addWhere("d.ca_anno = ?", $anno)
                    ->fetchOne();

            if ($blccliente) {
                $blccliente->delete();
            }
            $conn->commit();
            $this->responseArray = array("success" => true);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosInfoFinanciera(sfWebRequest $request) {
        $idcliente = $request->getParameter("idcliente");

        $blcclientes = Doctrine::getTable("BlcCliente")
                ->createQuery("d")
                ->where("d.ca_idcliente = ?", $idcliente)
                ->execute();

        $aniopasado = date("Y") - 1;
        $anioantepasado = date("Y") - 2;

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select  sum(ca_utilidad)+sum(ca_sobreventa) as ca_ino
                from vi_repgerencia_sea
                where ca_idcliente = " . $idcliente . "  and ca_ano in ('" . $aniopasado . "','" . $anioantepasado . "')";

        $rs = $con->execute($sql);
        $maritimo = $rs->fetch();

        $sql = "select  sum(ca_utilidad) as ca_ino
                from vi_repgerencia_air
                where ca_idcliente = " . $idcliente . "  and ca_ano in ('" . $aniopasado . "','" . $anioantepasado . "')";

        $rs = $con->execute($sql);
        $aereo = $rs->fetch();

        $anioactual = date("Y");

        $minimol = Doctrine::getTable("Smlv")
                ->createQuery("d")
                ->where("d.ca_anno = ?", $anioactual)
                ->fetchOne();

        $minimo = ($minimol) ? $minimol->getCaSmlv() : 0;

        $data = array();
        foreach ($blcclientes as $blccliente) {
            if ($minimo) {
                $ca_actsmmlv = ($blccliente->getCaActivostotales() / $minimo );
                $ca_actsmmlv = round($ca_actsmmlv, 2);
            }
            if ($blccliente->getCaPasivoscorrientes() != 0) {
                $ca_indliquidez = ($blccliente->getCaActivoscorrientes() / $blccliente->getCaPasivoscorrientes());
                $ca_indliquidez = round($ca_indliquidez, 2);
            } else {
                $ca_indliquidez = "Imposible Calcular";
            }
            if ($blccliente->getCaActivostotales() != 0) {
                $ca_indendeudamiento = ($blccliente->getCaPasivostotales() / $blccliente->getCaActivostotales());
                $ca_indendeudamiento = round($ca_indendeudamiento, 2);
            } else {
                $ca_indendeudamiento = "Imposible Calcular";
            }
            if ($blccliente->getCaPasivoscorrientes() != 0) {
                $ca_pbaacida = ($blccliente->getCaActivoscorrientes() - $blccliente->getCaInventarios()) / $blccliente->getCaPasivoscorrientes();
                $ca_pbaacida = round($ca_pbaacida, 2);
            } else {
                $ca_pbaacida = "Imposible Calcular";
            }

            $data[] = array(
                "ca_activostotales" => /* number_format( */$blccliente->getCaActivostotales()/* , 0, '', '.') */,
                "ca_activoscorrientes" => utf8_encode($blccliente->getCaActivoscorrientes()),
                "ca_pasivostotales" => utf8_encode($blccliente->getCaPasivostotales()),
                "ca_pasivoscorrientes" => utf8_encode($blccliente->getCaPasivoscorrientes()),
                "ca_inventarios" => utf8_encode($blccliente->getCaInventarios()),
                "ca_patrimonios" => utf8_encode($blccliente->getCaPatrimonios()),
                "ca_utilidades" => utf8_encode($blccliente->getCaUtilidades()),
                "ca_actsmmlv" => $ca_actsmmlv,
                "ca_indliquidez" => $ca_indliquidez,
                "ca_indendeudamiento" => $ca_indendeudamiento,
                "ca_pbaacida" => $ca_pbaacida,
                "ca_ino" => ($aereo["ca_ino"] + $maritimo["ca_ino"]),
                "ca_anno" => utf8_encode($blccliente->getCaAnno()),
                "ca_ventas" => utf8_encode($blccliente->getCaVentas()));
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeVerificarFobAduana(sfWebRequest $request) {

        $q = Doctrine::getTable("InoMaestraAdu")
                ->createQuery("m")
                ->select("m.ca_referencia,c.ca_idalterno as idalterno, c.ca_compania as compania,((SELECT bc.ca_activostotales FROM BlcCliente bc WHERE m.ca_idcliente=bc.ca_idcliente ORDER BY bc.ca_anno DESC LIMIT 1)*1000) as activos")
                ->innerJoin("m.Cliente c")
                //->leftJoin("c.BlcCliente bc INDEXBY bc.ca_anno")
                ->where("m.ca_fchcerrado = ? ", date("Y-m-d"));
        //->where("m.ca_fchcerrado > ? ", "2016-11-30");
        //    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        //echo $q->getSqlQuery();
        $refs = $q->execute();
        //echo "<pre>";print_r($refs);echo "</pre>";

        if (count($refs) > 0) {
            $con1 = Doctrine_Manager::getInstance()->getConnection('opencomex');

            $datos = "<div>A continuacion se relacionan los clientes y Do que fueron hallados.(valor Fob superior a los activos Totales)</div><table border=1><tr><td>Do</td><td>Cliente</td><td>Valor Activos</td><td>Valor Fob</td>";
            $c = false;
            foreach ($refs as $r) {
                $this->do = $r->getCaReferencia();
                $do = substr($this->do, 0, 3) . substr($this->do, 4, 2) . substr($this->do, 7, 2) . substr($this->do, 11, 3) . substr($this->do, 16, 1);
                $sql = "Select
                    distinct(brk.DOIIDXXX)    as ca_referencia,             
                    brk.DOISFIDX    as ca_version,
                     
                    brk.TCATASAX as tcambio
                    ,   
                    (brk.TCATASAX*(select sum(items1.LIMFOBXX) from COLMASXX.SIAI0205 AS items1 where brk.DOIIDXXX = items1.DOIIDXXX and brk.DOISFIDX=items1.DOISFIDX )) as valorfob
                FROM COLMASXX.SIAI0200 AS brk        
                WHERE            
                 brk.DOISFIDX='001' and  brk.DOIIDXXX = '$do'";
//                echo $sql."<br>";
                $st = $con1->execute($sql);
                $this->resul = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                //echo "$do :: Activos:".$r->activos." --------- Fob:".$this->resul[0]["valorfob"]."<br>";
                //echo "<pre>";print_r($this->resul);echo "</pre>";
                if ($r->activos != "" && $this->resul[0]["valorfob"] > $r->activos) {
                    $datos .= "<tr><td>$do</td><td>{$r->idalterno}-{$r->compania}</td><td style='text-align:right'>" . number_format($r->activos) . "</td><td style='text-align:right'>" . number_format($this->resul[0]["valorfob"], 2) . "</td>";
                    $c = true;
                }
                //$datos[]=array("")echo "<div style='color:red'>".$do."</div><br>";
            }
            $datos .= "</table>";

            if ($c) {
                $email = new Email();
                $email->setCaUsuenvio("Administrador");
                $email->setCaTipo("NotificacionFOB-Do");
                $email->setCaIdcaso("1");
                $email->setCaFrom("colsys@coltrans.com.co");
                $email->setCaFromname("Administrador Sistema Colsys");

                $email->addTo("maquinche@coltrans.com.co");
                $email->addTo("fegutierrez@coltrans.com.co");
                $email->addTo("lasalazar@coltrans.com.co");

                $email->setCaSubject("Notificacion de Valores Fob superiores a Activos de Clientes " . date("Y-m-d"));
                //$email->setCaSubject("Notificacion de Valores Fob superiores a Activos de Clientes (2016-12-01 a 2016-12-14)");
                $email->setCaBodyhtml($datos);
                $email->save(); //guarda el cuerpo del mensaje
            }
        } else {
            $datos = "<div>No se encontraron datos para el dia de hoy</div>";
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("NotificacionFOB-Do");
            $email->setCaIdcaso("1");
            $email->setCaFrom("colsys@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");

            $email->addTo("maquinche@coltrans.com.co");
            $email->addTo("fegutierrez@coltrans.com.co");

            $email->setCaSubject("Notificacion de Valores Fob superiores a Activos de Clientes " . date("Y-m-d"));
            //$email->setCaSubject("Notificacion de Valores Fob superiores a Activos de Clientes (2016-12-01 a 2016-12-14)");
            $email->setCaBodyhtml($datos);
            $email->save(); //guarda el cuerpo del mensaje
        }
        exit;
    }

}

?>