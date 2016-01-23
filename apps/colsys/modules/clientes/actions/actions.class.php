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


        $contentPlain = sprintf($yml['email'], "https://www.coltrans.com.co" . $link, "http://www.coltrans.com.co");
        $contentHTML = sprintf(Utils::replace($yml['email']), "<a href='https://www.coltrans.com.co" . $link . "'>https://www.coltrans.com.co" . $link . "</a>", "<a href='http://www.coltrans.com.co'>http://www.coltrans.com.co</a>");
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
        $email->send();
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
     * Entrada Reporte de Mandatos Clientes
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

        $empresa = 'Coltrans';
        $stmt = StdClienteTable::vencimientoEstado($empresa, 'Activo', null);
        $fchestado = date('Y-m-d H:i:s');

        while ($row = $stmt->fetch()) {
            $stdcliente = new StdCliente();

            $stdcliente->setCaIdcliente($row["ca_idcliente"]);
            $stdcliente->setCaEmpresa($empresa);
            $stdcliente->setCaEstado('Potencial');
            $stdcliente->setCaFchestado($fchestado);

            $stdcliente->save();
        }

        $empresa = 'Colmas';
        $stmt = StdClienteTable::vencimientoEstado($empresa, 'Activo', null);

        while ($row = $stmt->fetch()) {
            $stdcliente = new StdCliente();

            $stdcliente->setCaIdcliente($row["ca_idcliente"]);
            $stdcliente->setCaEmpresa($empresa);
            $stdcliente->setCaEstado('Potencial');
            $stdcliente->setCaFchestado($fchestado);

            $stdcliente->save();
        }
        /*
          $idClientesSinBeneficio = array();
          $stmt = LibClienteTable::liberacionEstado(null);

          while($row = $stmt->fetch() ) {
          $idClientesSinBeneficio[] = $row["ca_idcliente"];
          }

          if ( count($idClientesSinBeneficio) > 0 ){
          Doctrine_Query::create()
          ->update()
          ->from("LibCliente l")
          ->set("l.ca_observaciones", "'Pierde Beneficios por Cambio de Estado. [Cupo: '||ca_cupo||' Días: '||ca_diascredito||']\n'||l.ca_observaciones" )
          ->set("ca_cupo", 0)
          ->set("ca_diascredito", 0)
          ->set("ca_usuactualizado", "'Administrador'")
          ->set("ca_fchactualizado", "'$fchestado'")
          ->whereIn("ca_idcliente", $idClientesSinBeneficio )
          ->addWhere("ca_diascredito != 0 OR ca_cupo != 0")
          ->execute();
          }
         */
        $sql = "delete from tb_libcliente where ca_idcliente in ";
        $sql.= "(";
        $sql.= "	select lb.ca_idcliente ";
        $sql.= "	from tb_libcliente lb  ";
        $sql.= "	       LEFT OUTER JOIN (select st.ca_idcliente, st.ca_estado from tb_stdcliente st INNER JOIN (select sc.ca_idcliente, max(sc.ca_fchestado) as ca_fchestado, sc.ca_empresa from tb_stdcliente sc where ca_empresa = 'Coltrans' group by ca_idcliente, ca_empresa) ul ON (st.ca_idcliente = ul.ca_idcliente and st.ca_fchestado = ul.ca_fchestado and st.ca_empresa = ul.ca_empresa)) as st1 ON (lb.ca_idcliente = st1.ca_idcliente) ";
        $sql.= "	       LEFT OUTER JOIN (select st.ca_idcliente, st.ca_estado from tb_stdcliente st INNER JOIN (select sc.ca_idcliente, max(sc.ca_fchestado) as ca_fchestado, sc.ca_empresa from tb_stdcliente sc where ca_empresa = 'Colmas' group by ca_idcliente, ca_empresa) ul ON (st.ca_idcliente = ul.ca_idcliente and st.ca_fchestado = ul.ca_fchestado and st.ca_empresa = ul.ca_empresa)) as st2 ON (lb.ca_idcliente = st2.ca_idcliente) ";
        $sql.= "	where st1.ca_estado = 'Potencial' and st2.ca_estado  = 'Potencial' and (lb.ca_fchgracia is null or lb.ca_fchgracia <= now())";
        $sql.= ")";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);

        $layout = $this->getRequestParameter("layout");
        if ($layout) {
            $this->setLayout($layout);
        }
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
        $empresas = array("Coltrans", "Colmas");

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
                            echo "aca";
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
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_1"]+= 1;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_2"]+= 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_3"]+= 0;
                } elseif ($fchReferencia->format('Y-m-d') <= $corte2) {
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_1"]+= 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_2"]+= 1;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_3"]+= 0;
                } else {
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_1"]+= 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_2"]+= 0;
                    $clientesActivos[$row["ca_sucursal"]][$row["ca_vendedor"]][$row["ca_idalterno"]]["ca_periodo_3"]+= 1;
                }
            }
        }

        foreach ($clientesActivos as $key_suc => $sucursal):
            foreach ($sucursal as $key_ven => $vendedor):
                foreach ($vendedor as $key_cli => $cliente):
                    $calificacion = "";
                    if ($cliente["ca_periodo_1"] > $cliente["ca_periodo_2"]) {
                        $calificacion.= "Caida";
                    } elseif ($cliente["ca_periodo_2"] > $cliente["ca_periodo_1"]) {
                        $calificacion.= "Incremento";
                    } elseif ($cliente["ca_periodo_1"] == 0 and $cliente["ca_periodo_2"] == 0) {
                        $calificacion.= "Sin Negocios";
                    } elseif ($cliente["ca_periodo_2"] == $cliente["ca_periodo_1"]) {
                        $calificacion.= "Estable";
                    }
                    $calificacion.= "/";
                    if ($cliente["ca_periodo_2"] > $cliente["ca_periodo_3"]) {
                        $calificacion.= "Caida";
                    } elseif ($cliente["ca_periodo_3"] > $cliente["ca_periodo_2"]) {
                        $calificacion.= "Incremento";
                    } elseif ($cliente["ca_periodo_2"] == 0 and $cliente["ca_periodo_3"] == 0) {
                        $calificacion.= "Sin Negocios";
                    } elseif ($cliente["ca_periodo_3"] == $cliente["ca_periodo_2"]) {
                        $calificacion.= "Estable";
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
                           Es necesario para <strong>COLTRANS S.A.S.</strong> y/o <strong>AGENCIA DE ADUANAS COLMAS S.A.S. NIVEL 1</strong> dar cumplimiento a la Circular 0170 expedida por la  DIAN el 10 de octubre de 2002 y la circular externa 100-000005 de junio 17 de 2014, expedida por al Superintendencia de Sociedades, siendo nuestra obligación como Agentes de Carga Internacional / Agentes de Aduana, crear un banco de datos de nuestros clientes que nos permita establecer un adecuado auto control y gestión del riesgo para la  'Prevención del lavado de Activos y Financiación del Terrorismo' en nuestras operaciones.<br /><br />
                           Por lo anterior, el Representante Comercial que atiende su cuenta, estará retirando de sus instalaciones los siguientes documentos:<br /><br />
                        </td>
                     </tr>
                     <tr>
                        <td style=\"text-align: justify\">
                           <ol>
                              <li>Formato de Identificación del cliente debidamente diligenciado y firmado en original  por el Representante Legal o la persona facultada según certificado de Cámara y Comercio.</li>
                              <li>Certificado y Cámara de Comercio en original con vigencia no superior a 30 días.</li>
                              <li>Copia del RUT (actualizado)</li>
                              <li>Información Financiera:
                                <ul>
                                  <li type=\"disc\">Balance General</li>
                                  <li type=\"disc\">Estado de Resultados</li>
                                  <li type=\"disc\">Estado de Cambios en el Capital</li>
                                  <li type=\"disc\">Estado de cambios en la situación financiera</li>
                                  <li type=\"disc\">Estado de flujo de efectivo</li>
                                  <li type=\"disc\">Notas a los Estados Financieros</li>
                                </ul>
                                Los Estados Financieros deben estar certificados y dictaminados por Representante Legal y Revisor Fiscal y/o Contador Público con fecha de corte a Dic. 31 del año inmediatamente anterior.<br />
                                Si la compañía se encuentra  recientemente constituida, deberá entregar un balance inicial. Si usted es persona natural, deberá entregar copia de la última Declaración de Renta.
                              </li>
                              <li>Fotocopia del Documento de identidad del Representante Legal o persona facultada según Cámara y Comercio que firma la Circular 0170.</li>
                              <li>Fotocopia del Documento de identidad del Contador y Revisor Fiscal (Si aplica) que certifican y dictaminan los Estados Financieros.</li>
                              <li>Certificado de vigencia y antecedentes disciplinarios expedida por la Junta Central de Contadores del Contador y del Revisor Fiscal (Si aplica).</li>
                           </ol>
                        </td>
                     </tr>
                     <tr>
                        <td style=\"text-align: justify\">
                           Está documentación debe ser actualizada cada año y reposará en nuestros archivos con un trato de <strong>ABSOLUTA RESERVA Y CONFIDENCIALIDAD.</strong> El incumplimiento de alguno de los puntos anteriores acarreará una sanción por parte de la DIAN.<br /><br />$renovacion_credito
                           <strong>IMPORTANTE:</strong><br />
                           En caso de no tener un Representante Comercial asignado, agradecemos enviar los mismos en original a la atención de Yeimy C. Garzón y/o Juan Camilo Ortega en la dirección : Cra 98 No 25G-10 INT 18.<br /><br />
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
                $email->addAttachment("ids/formatos/Circular_0170.xls");

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

                $email->setCaSubject("Clientes Activos con Vencimiento de Mandatos a : $inicio - $vendedor");

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

            $email->setCaSubject("¡Error en Informe sobre vencimiento Control de Mandatos!");
            $email->setCaBodyhtml("Caught exception: " . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "\n\n Se ha presentado un error en el proceso que envía correo con el reporte Control de Mandatos por vencer en Maestra de Clientes Activos de COLSYS. Agradecemos confirmar que el Departamento de Sistemas esté enterado de esta falla. Gracias!");
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
                        $msn_mem.= "</table>";
                        $msn_mem.= "<br / >Fin del Reporte.";
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
                    $msn_mem.= "<br />";
                    $msn_mem.= "<table width='90%' cellspacing='1' border='1'>";
                    $msn_mem.= "	<tr>";
                    for ($i = 0; $i < count($tit_mem); $i++) {
                        $msn_mem.= "	<th>" . $tit_mem[$i] . "</th>";
                    }
                    $msn_mem.= "	</tr>";
                }
                $msn_mem.= "	<tr>";
                for ($i = 0; $i < count($tit_mem); $i++) {
                    $msn_mem.= "	<td>" . $row[$tit_mem[$i]] . "</td>";
                }
                $msn_mem.= "	</tr>";
            }
            $msn_mem.= "</table>";
            $msn_mem.= "<br / >Fin del Reporte.";

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
        $query.= "		from tb_inoclientes_sea ic";
        $query.= "		INNER JOIN vi_clientes_reduc cl ON ic.ca_idcliente = cl.ca_idcliente";
        $query.= "		INNER JOIN tb_inoingresos_sea ii ON ic.ca_idinocliente = ii.ca_idinocliente ";
        $query.= "		INNER JOIN vi_usuarios u ON u.ca_login = ic.ca_usuliberado";
        $query.= "		where ic.ca_fchliberacion IS NOT NULL and ic.ca_fchliberacion BETWEEN '$fchinicial' and '$fchfinal'";
        $query.= "		and cl.ca_compania='$cliente'";
        $query.= "      order by ic.ca_fchliberacion DESC";

        $this->listado = $q->execute($query);
        $this->cliente = $cliente;
        $this->fchinicial = $fchinicial;
        $this->fchfinal = $fchfinal;
    }

    public function executeRc() {
        
    }

    public function executeProcesarRc(sfWebRequest $request) {
        try {
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
            $sucFac = array("1" => "BOG", "2" => "CLO", "3" => "MDE", "4" => "BAQ", "5" => "PEI", "7" => "PEI");
            $sqltmp = "";
            for ($i = 0; $i < count($lines); $i++) {
                $sql_update = "";
                $datos = explode(",", $lines[$i]);

                $suc_recibo = (int) str_replace("\"", "", $datos[1]);
                $suc_factura = (int) str_replace("\"", "", $datos[11]);

                $tipo_comp = str_replace("\"", "", $datos[10]);

                $nfact = (int) str_replace("\"", "", $datos[12]);
                $pre = str_replace("\"", "", $datos[0]) . ((int) str_replace("\"", "", $datos[1]));

                $nrecibo = (int) str_replace("\"", "", $datos[2]);
                $fecha_pago = Utils::parseDate((int) str_replace("\"", "", $datos[7]));
                $comienzo_log = "<b>linea</b>=" . $i . ":::<b>Factura</b>=" . $nfact . ":::<b>Recibo</b>=" . $nrecibo . " ::: ";
                if (count($datos) != 13) {
                    $resultado[$i] = $comienzo_log . "Existen cantidad de campos diferente a los establecidos<br>";
                    $estadisticas["formato_incorrecto"] ++;
                    continue;
                }
                //echo $sucRec[$suc_recibo].'-'.$sucFac[$suc_factura]."<br>";
                if ($suc_recibo != "15") {
                    if ($sucRec[$suc_recibo] != $sucFac[$suc_factura]) {
                        $resultado[$i] = $comienzo_log . "La sucursal registrada en el recibo es diferente a la de la factura (" . $suc_recibo . " :: " . $sucFac[$suc_factura] . ")";
                        $estadisticas["direfente_sucursal"] ++;
                        continue;
                    }
                }
                //echo $nfact."".$tipo_comp."<br>";
                if (!$nfact) {

                    $resultado[$i] = $comienzo_log . "No posee No Factura";
                    $estadisticas["sin_factura"] ++;
                    continue;
                }
                if (strcmp($tipo_comp, 'F') != 0) {
                    $resultado[$i] = $comienzo_log . "No posee No Factura " . $tipo_comp . " ";
                    $estadisticas["sin_factura"] ++;
                    continue;
                }

                if ($datos[2] == "" && $datos[7] == "") {
                    $resultado[$i] = $comienzo_log . "No posee No Recibo de caja ni fecha de pago";
                    $estadisticas["sin_recibo"] ++;
                    $estadisticas["sin_fecha"] ++;
                    continue;
                }
                if ($datos[2] == "") {
                    $resultado[$i] = $comienzo_log . "No posee No Recibo de caja";
                    $estadisticas["sin_recibo"] ++;
                }
                if ($datos[7] == "") {
                    $resultado[$i] = $comienzo_log . "No posee fecha de pago";
                    $estadisticas["sin_fecha"] ++;
                }

                $encontro = false;
                $actualizo = false;

                if ($suc_recibo == "15") {
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
                        from " . $tabla . " t,control.tb_usuarios u where (ca_factura ='" . $nfact . "' or ca_factura ='F" . $suc_factura . "-" . $nfact . "' or ca_factura ='F" . $suc_factura . " " . $nfact . "' or ca_factura ='f" . $suc_factura . "-" . $nfact . "' or ca_factura ='f" . $suc_factura . " " . $nfact . "' ) and t.ca_usucreado=u.ca_login and u.ca_idsucursal in ($sucursal) ";
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
                                $resultado[$i].=($resultado[$i] == "") ? $comienzo_log : "";
                                $resultado[$i].="-" . $tabla . ":: Recibo de caja ya cargado 'No se actualizo',";
                            }
                        }

                        if ($fecha_pago) {
                            if ($ref["ca_fchpago"] == "") {
                                $set.=($set != "") ? "," : "";
                                $set.=" ca_fchpago='" . $fecha_pago . "'";
                            } else {
                                $resultado[$i].=($resultado[$i] == "") ? $comienzo_log : "";
                                $resultado[$i].=$tabla . ":: Fecha de pago ya cargada 'No se actualizo',";
                            }
                        }

                        if ($set != "") {
                            foreach ($pk[$tabla] as $p) {
                                $where.= " and $p='" . $ref[$p] . "' ";
                            }
                            //$sql.=$where;
                            $sql_update.=$set . " where 1=1 $where;";
                            $st = $con->execute($sql_update);
                            $sqltmp.=$sql_update . "<br>";
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
                    $resultado[$i].=($resultado[$i] == "") ? $comienzo_log : "";
                    if (!$encontro) {
                        $resultado[$i].="FACTURA NO ENCONTRADA";
                        $estadisticas["no_encontrado"] ++;
                    }
                    if (!$actualizo) {
                        $resultado[$i].="Registro no actualizado";
                        $estadisticas["no_actualizado"] ++;
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
        } catch (Exception $e) {
            $this->responseArray = array("success" => "false", "errorInfo" => $e->getTraceAsString());
        }
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
        $mandatos = Doctrine::getTable("Mancliente")
                ->createQuery("m")
                ->addWhere("m.ca_idcliente = ?", $this->getRequestParameter("id"))
                ->execute();
        $data = array();

        foreach ($mandatos as $mandato) {
            $data[] = array("idcliente" => $mandato->getCaIdcliente(),
                "idciudad" => $mandato->getCaIdciudad(),
                "ciudad" => $mandato->getCiudad()->getCaCiudad(),
                "idtipo" => $mandato->getCaIdtipo(),
                "tipo" => $mandato->getMandatosTipo()->getCaTipo(),
                "clase" => $mandato->getMandatosTipo()->getCaClase(),
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

        $conn = Doctrine::getTable("Mancliente")->getConnection();
        $conn->beginTransaction();
        try {
            $mandatos = Doctrine::getTable("Mancliente")
                    ->createQuery("m")
                    ->addWhere("m.ca_idcliente = ?", $id)
                    ->addWhere("m.ca_idtipo = ?", $idtipo)
                    ->addWhere("m.ca_idciudad = ?", $idciudad)
                    ->fetchOne();
            if (!$mandatos) {
                $mandatos = new Mancliente();
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

        $conn = Doctrine::getTable("Mancliente")->getConnection();
        $conn->beginTransaction();
        try {
            $mandatos = Doctrine::getTable("Mancliente")
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
                $data[] = array("text" => $clase, "expanded" => false, "children" => $childrens);
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


        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

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
            if ($datos->fchvisita) {
                $encuestaVisita->setCaFchvisita($datos->fchvisita);
            }
            if ($datos->politica_seguridad_salud) {
                $encuestaVisita->setCaPoliticaSeguridadSalud($datos->politica_seguridad_salud);
            }
            if ($datos->mano_obra_infantil) {
                $encuestaVisita->setCaManoObraInfantil($datos->mano_obra_infantil);
            }
            if ($datos->peligros_riesgos_identificados) {
                $encuestaVisita->setCaPeligrosRiesgosIdentificados($datos->peligros_riesgos_identificados);
            }
            if ($datos->peligros_riesgos_identificar) {
                $encuestaVisita->setCaPeligrosRiesgosIdentificar($datos->peligros_riesgos_identificar);
            }
            if ($datos->riesgos_control) {
                $encuestaVisita->setCaRiesgosControl(utf8_decode($datos->riesgos_control));
            }
            if ($datos->requisitos_legales_conocimiento) {
                $encuestaVisita->setCaRequisitosLegalesConocimiento(utf8_decode($datos->requisitos_legales_conocimiento));
            }
            if ($datos->requisitos_legales_aplicacion) {
                $encuestaVisita->setCaRequisitosLegalesAplicacion(utf8_decode($datos->requisitos_legales_aplicacion));
            }
            if ($datos->requisitos_legales_detalles) {
                $encuestaVisita->setCaRequisitosLegalesDetalles(utf8_decode($datos->requisitos_legales_detalles));
            }
            if ($datos->pago_seguridad_social) {
                $encuestaVisita->setCaPagoSeguridadSocial(utf8_decode($datos->pago_seguridad_social));
            }
            if ($datos->panorama_riesgos) {
                $encuestaVisita->setCaPanoramaRiesgos($datos->panorama_riesgos);
            }
            if ($datos->respuesta_emergencias) {
                $encuestaVisita->setCaRespuestaEmergencias(utf8_decode($datos->respuesta_emergencias));
            }
            if ($datos->numero_personas) {
                $encuestaVisita->setCaNumeroPersonas($datos->numero_personas);
            }
            if ($datos->instalaciones_tipo) {
                $encuestaVisita->setCaInstalacionesTipo(utf8_decode($datos->instalaciones_tipo));
            }
            if ($datos->instalaciones_pertenencia) {
                $encuestaVisita->setCaInstalacionesPertenencia(utf8_decode($datos->instalaciones_pertenencia));
            }
            if ($datos->instalaciones_uso) {
                $encuestaVisita->setCaInstalacionesUso($datos->instalaciones_uso);
            }
            if ($datos->areas_sensibles) {
                $encuestaVisita->setCaAreasSensibles(utf8_decode($datos->areas_sensibles));
            }
            if ($datos->areas_autorizadas) {
                $encuestaVisita->setCaAreasAutorizadas($datos->areas_autorizadas);
            }
            if ($datos->sistema_seguridad) {
                $encuestaVisita->setCaSistemaSeguridad(utf8_decode($datos->sistema_seguridad));
            }
            if ($datos->manejo_mercancias) {
                $encuestaVisita->setCaManejoMercancias(utf8_decode($datos->manejo_mercancias));
            }
            if ($datos->certificacion) {
                $encuestaVisita->setCaCertificacion($datos->certificacion);
            }
            if ($datos->certificacion_detalles) {
                $encuestaVisita->setCaCertificacionDetalles(utf8_decode($datos->certificacion_detalles));
            }
            if ($datos->implementacion_plan) {
                $encuestaVisita->setCaImplementacionPlan($datos->implementacion_plan);
            }
            if ($datos->implementacion_plan_detalles) {
                $encuestaVisita->setCaImplementacionPlanDetalles($datos->implementacion_plan_detalles);
            }
            if ($datos->evaluacion_terceros) {
                $encuestaVisita->setCaEvaluacionTerceros(utf8_decode($datos->evaluacion_terceros));
            }
            if ($datos->evaluacion_personal) {
                $encuestaVisita->setCaEvaluacionPersonal(utf8_decode($datos->evaluacion_personal));
            }
            if ($datos->programas_capacitacion) {
                $encuestaVisita->setCaProgramasCapacitacion($datos->programas_capacitacion);
            }
            if ($datos->manejo_mercancias_proceso) {
                $encuestaVisita->setCaManejoMercanciasProceso(utf8_decode($datos->manejo_mercancias_proceso));
            }
            if ($datos->prevencion_lavado_activos) {
                $encuestaVisita->setCaPrevencionLavadoActivos($datos->prevencion_lavado_activos);
            }
            if ($datos->manejo_mercancias_zona) {
                $encuestaVisita->setCaManejoMercanciasZona(utf8_decode($datos->manejo_mercancias_zona));
            }
            if ($datos->manejo_mercancias_detalles) {
                $encuestaVisita->setCaManejoMercanciasDetalles($datos->manejo_mercancias_detalles);
            }
            if ($datos->control_empleados) {
                $encuestaVisita->setCaControlEmpleados(utf8_decode($datos->control_empleados));
            }
            if ($datos->control_empleados_detalles) {
                $encuestaVisita->setCaControlEmpleadosDetalles($datos->control_empleados_detalles);
            }
            if ($datos->control_visitantes) {
                $encuestaVisita->setCaControlVisitantes(utf8_decode($datos->control_visitantes));
            }
            if ($datos->control_visitantes_detalles) {
                $encuestaVisita->setCaControlVisitantesDetalles($datos->control_visitantes_detalles);
            }
            if ($datos->seguridad_informatica) {
                $encuestaVisita->setCaSeguridadInformatica(utf8_decode($datos->seguridad_informatica));
            }
            if ($datos->seguridad_informatica_detalles) {
                $encuestaVisita->setCaSeguridadInformaticaDetalles($datos->seguridad_informatica_detalles);
            }
            if ($datos->personal_calificado) {
                $encuestaVisita->setCaPersonalCalificado(utf8_decode($datos->personal_calificado));
            }
            if ($datos->observaciones) {
                $encuestaVisita->setCaObservaciones($datos->observaciones);
            }
            if ($datos->concepto_seguridad) {
                $encuestaVisita->setCaConceptoSeguridad($datos->concepto_seguridad);
            }
            if ($datos->recomienda_trabajar) {
                $encuestaVisita->setCaRecomiendaTrabajar($datos->recomienda_trabajar);
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

    public function executeControlFinancieroExt4(sfWebRequest $request) {
        
    }

    public function executeActualizarControlFinanciero(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datosGrid = $request->getParameter("datosGrid");
        $datosGrid = json_decode($datosGrid);
        $datos = json_decode($datos);
        $nuevo = false;
        $ids = array();
        $cliente = new IdsCliente();
        $idcliente = $datos->idcliente;
        $conn = Doctrine::getTable("IdsCliente")->getConnection();
        $cliente = Doctrine::getTable('IdsCliente')->find($idcliente);
        if ($cliente) {
            $conn->beginTransaction();
            try {
                foreach ($datosGrid as $datoGrid) {
                    $doccliente = new DocClientes();
                    $doccliente = Doctrine::getTable("DocClientes")
                            ->createQuery("d")
                            ->where("d.ca_idcliente = ?", $idcliente)
                            ->addWhere("d.ca_iddocumento = ?", $datoGrid->iddocumento)
                            ->fetchOne();

                    if (!$doccliente) {
                        $doccliente = new DocClientes();
                        if ($datoGrid->iddocumento) {
                            $doccliente->setCaIddocumento($datoGrid->iddocumento);
                        }
                        $doccliente->setCaIdcliente($idcliente);
                    }

                    if ($datoGrid->fch_documento) {
                        $doccliente->setCaFchdocumento($datoGrid->fch_documento);
                    }
                    if ($datoGrid->observaciones) {
                        $doccliente->setCaObservaciones(utf8_decode($datoGrid->observaciones));
                    }
                    if ($datoGrid->fch_vigencia) {
                        $doccliente->setCaFchvigencia($datoGrid->fch_vigencia);
                    }

                    $doccliente->save();
                    $ids[] = $datoGrid->id;
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
                if ($datos->tipo) {
                    $cliente->setCaTipo(utf8_decode($datos->tipo));
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

                $cliente->save();
                $conn->commit();
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
        $data = array();

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select * from control.tb_config_values c left join tb_doccliente d on  c.ca_idvalue = d.ca_iddocumento where  c.ca_idconfig = 254 order by c.ca_ident ASC";
        $rs = $con->execute($sql);
        $control_rs = $rs->fetchAll();
        foreach ($control_rs as $control) {
            $data[] = array("iddocumento" => $control["ca_idvalue"],
                "empresa" => $control["ca_value2"],
                "documento" => utf8_encode($control["ca_value"]),
                "fch_vigencia" => $control["ca_fchvigencia"],
                "fch_documento" => $control["ca_fchdocumento"],
                "observaciones" => utf8_encode($control["ca_observaciones"])
            );
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

}

?>