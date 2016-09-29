<?php

/**
 * cotseguimientos actions.
 *
 * @package    colsys
 * @subpackage cotseguimientos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class cotseguimientosActions extends sfActions {

    const RUTINA = 19;
    const RUTINA_AUDITORIA = 95;

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex($request) {
        $this->nivel = $this->getUser()->getNivelAcceso(cotseguimientosActions::RUTINA);
        $this->vendedor = $this->getUser()->getUserId();
        if ($this->nivel == -1) {
            //	$this->forward404();
        }
        if ($this->nivel == "1") {
            $origenes = Doctrine::getTable("TraficoUsers")
                    ->createQuery("tu")
                    ->select("tu.*")
                    ->where("tu.ca_login=? and tu.ca_impo=true", array($this->getUser()->getUserId()))
                    ->execute();

            $this->pais_origen = "";
            if ($origenes) {
                foreach ($origenes as $origen) {
                    $this->pais_origen.=($this->pais_origen != "") ? "," . $origen->getCaIdtrafico() : $origen->getCaIdtrafico();
                }
            }
            if ($this->pais_origen == "") {
                $this->pais_origen = "CO-057";
            }

            $destinos = Doctrine::getTable("TraficoUsers")
                    ->createQuery("tu")
                    ->select("tu.*")
                    ->where("tu.ca_login=? and tu.ca_expo=true", array($this->getUser()->getUserId()))
                    ->execute();

            $this->pais_destino = "";
            if ($destinos) {
                foreach ($destinos as $destino) {
                    $this->pais_destino.=($this->pais_destino != "") ? "," . $destino->getCaIdtrafico() : $destino->getCaIdtrafico();
                }
            }
            if ($this->pais_destino == "") {
                $this->pais_destino = "CO-057";
            }
        }

        $this->usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.*")
                ->innerJoin("u.Cotizacion")
                ->distinct()
                ->orderBy("u.ca_nombre")
                ->execute();

        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->orderBy("s.ca_nombre")
                ->where("s.ca_idempresa=2")
                ->execute();
        $this->estados = ParametroTable::retrieveByCaso("CU074");
    }

    /**
     * Muestra las estadisticas por sucurrsal o por usuario
     *
     * @param sfRequest $request A request object
     */
    public function executeEstadisticas($request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/RowExpander", 'last');

        $fechaInicial = Utils::parseDate($request->getParameter("fechaInicial"));
        $fechaFinal = Utils::parseDate($request->getParameter("fechaFinal"));

        $origen = $request->getParameter("origen");
        $destino = $request->getParameter("destino");

        $this->nivel = $this->getUser()->getNivelAcceso(cotseguimientosActions::RUTINA);

        $checkboxVendedor = false;
        $checkboxSucursal = false;

        if ($this->nivel == "2") {
            $checkboxVendedor = $request->getParameter("checkboxVendedor");
            $checkboxSucursal = $request->getParameter("checkboxSucursal");
        } else if ($this->nivel == "0") {
            $checkboxVendedor = true;
            $checkboxSucursal = false;
        }

        $this->login = $request->getParameter("login");
        //$this->login="bdelatorre";
        $this->usuario = Doctrine::getTable("Usuario")->find($this->login);

        $q = Doctrine_Query::create()
                ->from("CotProducto p")
                ->innerJoin("p.Cotizacion c")
                ->innerJoin("p.Origen o")
                ->innerJoin("o.Trafico t")
                ->innerJoin("p.Origen d")
                ->innerJoin("d.Trafico td")
                ->innerJoin("c.Usuario u")
                ->leftJoin("p.CotSeguimiento s")
                ->addWhere("c.ca_fchcreado BETWEEN ? AND ? AND p.ca_etapa IS NOT NULL", array($fechaInicial, $fechaFinal));

        if ($checkboxVendedor) {
            $q->addWhere("c.ca_usuario = ?", $this->login);
        }

        if ($checkboxSucursal) {
            $this->sucursal = $request->getParameter("sucursal_est");
            $q->addWhere("u.ca_idsucursal = ?", $this->sucursal);
        } else {
            $this->sucursal = "";
        }

        if ($origen) {
            $q->addWhere("t.ca_idtrafico = ?", $origen);
            $origen1 = Doctrine::getTable("Trafico")->findBy("ca_idtrafico", $origen);
            if ($origen1)
                $this->origen = $origen1[0]->getCaNombre();
        }
        if ($destino) {
            $q->addWhere("td.ca_idtrafico = ?", $destino);
            $destino1 = Doctrine::getTable("Trafico")->findBy("ca_idtrafico", $destino);
            if ($destino1)
                $this->destino = $destino1[0]->getCaNombre();
        }

        $cotizaciones = $q->select("p.ca_idcotizacion")
                ->distinct()
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        $this->numcotizaciones = count($cotizaciones);

        $segNA = ParametroTable::retrieveByCaso("CU087");
//         print_r($segNA);
        /*        foreach( $segNA as $estado ){
          $this->estados[$estado->getCaValor()]=$estado->getCaValor2();
          }
          exit;
         *
         */
        if (count($segNA) > 0) {
            $case = "CASE";
            foreach ($segNA as $s) {
                $case .=" WHEN s.ca_seguimiento='" . $s->getCaValor() . "' and p.ca_etapa='NAP' THEN '" . $s->getCaValor() . "' ";
            }
            $case.=" ELSE ''
                END";
        }
//                    ELSE 'other'
//       END

        $this->rows = $q->select("COUNT(p.ca_idproducto) as count, count(s.ca_idproducto) as conseg, p.ca_etapa,(" . $case . ") as seguimiento")
                ->addGroupBy("p.ca_etapa")
                ->addGroupBy("seguimiento")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        //print_r($this->rows);
        //exit;
        $q = Doctrine_Query::create()
                ->select("COUNT(c.ca_idcotizacion) as count, count(s.ca_idcotizacion) as conseg, c.ca_etapa")
                ->from("Cotizacion c")
                ->innerJoin("c.Usuario u")
                ->leftJoin("c.CotProducto p")
                ->leftJoin("c.CotSeguimiento s")
                ->addGroupBy("c.ca_etapa")
                ->addGroupBy("s.ca_fchseguimiento")
                ->addWhere("c.ca_fchcreado BETWEEN ? AND ? AND c.ca_etapa IS NOT NULL", array($fechaInicial, $fechaFinal))
                ->addWhere("p.ca_idproducto IS NULL");
        //->orderBy("c.ca_etapa");

        if ($checkboxVendedor) {
            $q->addWhere("c.ca_usuario = ?", $this->login);
        }

        if ($checkboxSucursal) {
            $this->sucursal = $request->getParameter("sucursal_est");
            $q->addWhere("u.ca_idsucursal = ?", $this->sucursal);
        } else {
            $this->sucursal = "";
        }

        $this->rows2 = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $this->fechaInicial = $fechaInicial;
        $this->fechaFinal = $fechaFinal;

        $estados = ParametroTable::retrieveByCaso("CU074");
        $this->estados = array();

        foreach ($estados as $estado) {
            $this->estados[$estado->getCaValor()] = $estado->getCaValor2();
        }
    }

    public function executeVerSeguimiento($request) {
        $this->cotizacion = Doctrine::gettable("Cotizacion")->find($request->getParameter("idcotizacion"));
        $this->forward404Unless($this->cotizacion);
        $this->productos = $this->cotizacion->getCotProductos();
    }

    public function executeFormSeguimiento($request) {
        $this->cotizacion = Doctrine::gettable("Cotizacion")->find($request->getParameter("idcotizacion"));
        $this->forward404Unless($this->cotizacion);

        if ($request->getParameter("idproducto")) {
            $this->producto = Doctrine::gettable("CotProducto")->find($request->getParameter("idproducto"));
            $this->forward404Unless($this->producto);
            $this->seguimientos = $this->producto->getSeguimientos();
        } else {
            $this->seguimientos = $this->cotizacion->getSeguimientos();
        }

        $this->form = new SeguimientoForm();

        if ($request->isMethod('post')) {
            $bindValues = array();
            $bindValues["seguimiento"] = $request->getParameter("seguimiento");
            $bindValues["etapa"] = $request->getParameter("etapa");
            $bindValues["prog_seguimiento"] = $request->getParameter("prog_seguimiento");
            if ($request->getParameter("prog_seguimiento")) {
                $bindValues["fchseguimiento"] = $request->getParameter("fchseguimiento");
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {
                $this->executeGuardarSeguimiento($request);
                return sfView::SUCCESS;
            }
        }
    }

    public function executeGuardarSeguimiento($request) {
        $cotizacion = Doctrine::gettable("Cotizacion")->find($request->getParameter("idcotizacion"));
        $this->forward404Unless($cotizacion);

        if ($request->getParameter("idproducto")) {
            $producto = Doctrine::gettable("CotProducto")->find($request->getParameter("idproducto"));
            $this->forward404Unless($producto);

            if ($producto->getCaIdtarea()) {
                $tarea = Doctrine::gettable("NotTarea")->find($producto->getCaIdtarea());
                $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                $tarea->save();
                $texto = "Borra Seguimiento Id:" . $tarea->getCaIdtarea();
            }
        } else {
            if ($cotizacion->getCaIdtarea()) {
                $tarea = Doctrine::gettable("NotTarea")->find($cotizacion->getCaIdtarea());
                $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                $tarea->save();
                $texto = "Borra Seguimiento Id:" . $tarea->getCaIdtarea();
            }
        }

        $seguimiento = new CotSeguimiento();
        if ($request->getParameter("idproducto")) {
            $seguimiento->setCaIdproducto($request->getParameter("idproducto"));
            $producto->setCaEtapa($request->getParameter("etapa"));
            $producto->save();
        } else {
            $seguimiento->setCaIdcotizacion($request->getParameter("idcotizacion"));
            $cotizacion->setCaEtapa($request->getParameter("etapa"));
            $cotizacion->save();
        }
        $seguimiento->setCaLogin($this->getUser()->getUserId());
        $seguimiento->setCaFchseguimiento(date("Y-m-d H:i:s"));
        $seguimiento->setCaSeguimiento($request->getParameter("seguimiento") . ". " . $texto);
        $seguimiento->setCaEtapa($request->getParameter("etapa"));
        $seguimiento->save();

        if ($request->getParameter("prog_seguimiento")) {
            $titulo = "Seguimiento Cotización " . $cotizacion->getCaConsecutivo() . " " . $cotizacion->getCliente()->getCaCompania() . "";
            $texto = "Ha programado un seguimiento para una cotización, por favor haga click en el link para realizar esta tarea";
            $tarea = new NotTarea();
            $tarea->setCaUrl("/cotseguimientos/verSeguimiento/idcotizacion/" . $cotizacion->getCaIdcotizacion());
            $tarea->setCaIdlistatarea(7);
            $tarea->setCaFchvencimiento($request->getParameter("fchseguimiento") . " 23:59:59");
            $tarea->setCaFchvisible($request->getParameter("fchseguimiento") . " 00:00:00");
            $tarea->setCaUsucreado($this->getUser()->getUserId());
            $tarea->setCaTitulo($titulo);
            $tarea->setCaTexto($texto);
            $tarea->save();
            $loginsAsignaciones = array($this->getUser()->getUserId(), $cotizacion->getCaUsuario());
            $loginsAsignaciones = array_unique($loginsAsignaciones);
            $tarea->setAsignaciones($loginsAsignaciones);

            if ($request->getParameter("idproducto")) {
                $producto->setCaIdtarea($tarea->getCaIdtarea());
                $producto->save();
            } else {
                $cotizacion->setCaIdtarea($tarea->getCaIdtarea());
                $cotizacion->save();
            }
        }
        $this->redirect("cotseguimientos/verSeguimiento?idcotizacion=" . $cotizacion->getCaIdcotizacion());
    }

    public function executeAprobarSeguimiento($param) {

        $seg = new CotSeguimiento();
        $seg->aprobarSeguimiento($param);
    }

    public function executeAprobarSeguimientos($request) {

        $idproductos = $request->getParameter("idproducto");
        $etapa = $request->getParameter("etapa");
        $seguimientos = $request->getParameter("seguimiento");
        $fchseguimientos = $request->getParameter("fchseguimiento");
        $j = 0;

        for ($i = 0; $i < count($idproductos); $i++) {
            $param = array();
            $param["idproducto"] = $idproductos[$i];
            $param["etapa"] = $etapa[$i];
            if ($seguimientos[$i] != "")
                $param["seguimiento"] = $seguimientos[$i];
            else
                $param["seguimiento"] = "";
            if ($fchseguimientos[$i] != "")
                $param["fchseguimiento"] = $fchseguimientos[$i];
            else
                $param["fchseguimiento"] = "";

            $param["user"] = $this->getUser()->getUserId();
            $this->executeAprobarSeguimiento($param);
        }

        $idcotizaciones = $request->getParameter("idcotizacioncot");

        $etapa = $request->getParameter("etapacot");
        $seguimientos = $request->getParameter("seguimientocot");
        $fchseguimientos = $request->getParameter("fchseguimientocot");
        $j = 0;
        for ($i = 0; $i < count($idcotizaciones); $i++) {
            $param = array();
            $param["idcotizacion"] = $idcotizaciones[$i];
            $param["etapa"] = $etapa[$i];
            if ($seguimientos[$i] != "")
                $param["seguimiento"] = $seguimientos[$i];
            else
                $param["seguimiento"] = "";
            $param["user"] = $this->getUser()->getUserId();

            if ($etapa[$i] == "SEG") {
                $param["fchseguimiento"] = $fchseguimientos[$j++];
            }
            $this->executeAprobarSeguimiento($param);
        }

        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeReporteSeguimientosEmail($request) {
        $mes = date("m");
        $ano = date("Y");
        $ultimo_dia = mktime(0, 0, 0, $mes, 0, $ano);
        $last_day = date("Y-m-d", $ultimo_dia);
        $first_day = date("Y-m-01", $ultimo_dia);

        $seguimientos = Doctrine_Query::create()
                ->select("cli.ca_compania,p.ca_idproducto,c.ca_consecutivo,p.ca_transporte,o.ca_ciudad,d.ca_ciudad,c.ca_usuario,u.ca_email")
                ->from("CotProducto p")
                ->innerJoin("p.Origen o")
                ->innerJoin("p.Destino d")
                ->innerJoin("p.Cotizacion c")
                ->innerJoin("c.Contacto con")
                ->innerJoin("con.Cliente cli ON cli.ca_idcliente=con.ca_idcliente")
                ->innerJoin("c.Usuario u")
                ->leftJoin("p.CotSeguimiento s")
                ->addWhere("c.ca_usuanulado is null")
                ->addWhere("c.ca_fchcreado BETWEEN ? AND ? AND p.ca_etapa IS NOT NULL", array($first_day, $last_day))
                ->addWhere("(s.ca_etapa<>'NAP' and s.ca_etapa<>'APR' or s.ca_etapa is null)")
                ->orderBy("c.ca_usuario")
                ->addOrderBy("c.ca_consecutivo DESC")
                ->addOrderBy("p.ca_idproducto ")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        $this->emails = array();
        foreach ($seguimientos as $seguimiento) {
            if (!isset($this->emails[$seguimiento["c_ca_usuario"]])) {
                $this->emails[$seguimiento["c_ca_usuario"]]["html"] = "<tr bgcolor='#EAEAEA'><td colspan='4'>Usuario : " . $seguimiento["c_ca_usuario"] . "</td></tr><tr bgcolor='#EAEAEA' ><td>Cotizaci&oacute;n</td><td>Cliente</td><td>Transporte</td><td>Trayecto</td></tr>";
                $this->emails[$seguimiento["c_ca_usuario"]]["email"] = $seguimiento["u_ca_email"];
            }
            $this->emails[$seguimiento["c_ca_usuario"]]["html"].="<tr><td>" . $seguimiento["c_ca_consecutivo"] . "</td><td>" . $seguimiento["cli_ca_compania"] . "</td><td>" . $seguimiento["p_ca_transporte"] . "</td><td>" . $seguimiento["o_ca_ciudad"] . "-" . $seguimiento["d_ca_ciudad"] . "::" . $seguimiento["p_ca_idproducto"] . "</td></tr>";
        }
        $keys = array_keys($this->emails);

        foreach ($keys as $key) {
            $this->emails[$key]["html"] = "<table width='90%' cellspacing='1' border='1'>" . $this->emails[$key]["html"] . "</table>";
            $email = new Email();
            $email->setCaUsuenvio("Administrador");
            $email->setCaTipo("SDNList Compair");
            $email->setCaIdcaso("1");
            $email->setCaFrom("admin@coltrans.com.co");
            $email->setCaFromname("Administrador Sistema Colsys");
            $email->setCaReplyto("admin@coltrans.com.co");
            $email->setCaCc("maquinche@coltrans.com.co");
            $email->setCaSubject("Seguimientos de Cotizaciones de $first_day a $last_day");
            $email->setCaBodyhtml($this->emails[$key]["html"]);
            $email->addTo($this->emails[$key]["email"]);
            //$email->addTo( "maquinche@coltrans.com.co" );
            $email->save(); //guarda el cuerpo del mensaje
            //$email->send(); //envia el mensaje de correo
            //break;
        }
    }

    public function executeBusquedaAuditoria($request) {
        $this->nivel = $this->getUser()->getNivelAcceso(cotseguimientosActions::RUTINA_AUDITORIA);

        if ($this->nivel <= -1) {
            $this->forward404();
        }
        $this->vendedor = $this->getUser()->getUserId();
        $this->usuarios = UsuarioTable::getComerciales();

        $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")
                ->where("s.ca_idempresa=2")
                ->orderBy("s.ca_nombre")
                ->where("s.ca_idempresa=2")
                ->execute();

        $this->sucursal = $this->getUser()->getIdsucursal();

        $this->estados = ParametroTable::retrieveByCaso("CU074");
        
        $this->motivos = ParametroTable::retrieveByCaso("CU260");
        
        //$this->motivos = array();
        /*foreach ($motivos as $motivo) {
            $this->motivos[$motivo->getCaValor()] = $motivo->getCaValor();
        }*/
        
    }

    public function executeAuditoria($request) {
        $this->fechaInicial = Utils::parseDate($request->getParameter("fechaInicial"));
        $this->fechaFinal = Utils::parseDate($request->getParameter("fechaFinal"));
        $this->empresa = $request->getParameter("empresa");
        $checkboxVendedor = $request->getParameter("checkboxVendedor");

        $checkboxSucursal = $request->getParameter("checkboxSucursal");
        $idsucursal = $request->getParameter("sucursal_est");
        $cliente = $request->getParameter("cliente");
        
        $idpais = $request->getParameter("idpais");
        $pais = $request->getParameter("pais");
        
        $idciudad = $request->getParameter("idciudad");
        $ciudad = $request->getParameter("ciudad");
        
        
        $idmodalidad = $request->getParameter("idmodalidad");
        $idimpoexpo = $request->getParameter("idimpoexpo");
        $idtransporte = $request->getParameter("idtransporte");        

        if ($checkboxSucursal && $idsucursal) {
            $this->sucursal = Doctrine::getTable("Sucursal")->find($idsucursal)->getCaNombre();
        }

        $sql = "select c.ca_idcotizacion as ca_cotizacion_id, c.ca_consecutivo, c.ca_version, ids.ca_nombre as ca_compania, cc.ca_nombres, cc.ca_papellido, cc.ca_sapellido, c.ca_fchcreado, c.ca_etapa, c.ca_empresa, p.ca_idproducto, p.ca_etapa, o.ca_ciudad as ca_origen, d.ca_ciudad as ca_destino, u.ca_nombre as ca_usuario, s.ca_nombre as ca_sucursal, seg.*, seg2.* ";
        $sql.= " from tb_cotizaciones c ";
        $sql.= "    LEFT JOIN tb_cotproductos p ON c.ca_idcotizacion = p.ca_idcotizacion";
        $sql.= "    LEFT JOIN tb_ciudades o ON p.ca_origen = o.ca_idciudad ";
        $sql.= "    LEFT JOIN tb_traficos t ON t.ca_idtrafico = o.ca_idtrafico ";
        $sql.= "    LEFT JOIN tb_ciudades d ON p.ca_destino = d.ca_idciudad ";
        $sql.= "    LEFT JOIN (select ct0.ca_idseguimiento as ca_idseguimiento_cot, ca_idcotizacion, ca_fchseguimiento as ca_fchseguimiento_cot, ca_seguimiento as ca_seguimiento_cot, ca_etapa as ca_etapa_cot from tb_cotseguimientos ct0 RIGHT JOIN (select max(ca_idseguimiento) as ca_idseguimiento from tb_cotseguimientos ct group by ca_idcotizacion) ct1 ON ct0.ca_idseguimiento = ct1.ca_idseguimiento) seg ON c.ca_idcotizacion = seg.ca_idcotizacion";
        $sql.= "    LEFT JOIN (select ct0.ca_idseguimiento as ca_idseguimiento_pro, ca_idproducto, ca_fchseguimiento as ca_fchseguimiento_pro, ca_seguimiento as ca_seguimiento_pro, ca_etapa as ca_etapa_pro from tb_cotseguimientos ct0 RIGHT JOIN (select max(ca_idseguimiento) as ca_idseguimiento from tb_cotseguimientos ct group by ca_idproducto) ct1 ON ct0.ca_idseguimiento = ct1.ca_idseguimiento) seg2 ON p.ca_idproducto = seg2.ca_idproducto";
        $sql.= "    INNER JOIN tb_concliente cc ON c.ca_idcontacto = cc.ca_idcontacto";
        $sql.= "    INNER JOIN ids.tb_ids ids ON cc.ca_idcliente = ids.ca_id";
        $sql.= "    INNER JOIN control.tb_usuarios u ON c.ca_usuario = u.ca_login";
        $sql.= "    INNER JOIN control.tb_sucursales s ON u.ca_idsucursal = s.ca_idsucursal";
        $sql.= " where c.ca_fchanulado is null and c.ca_empresa = '" . $this->empresa . "'";
        $sql.= "    and c.ca_fchcreado BETWEEN '" . $this->fechaInicial . "' AND '" . $this->fechaFinal . "'";

        if ($idsucursal) {
            $sql.= " and u.ca_idsucursal = '" . $idsucursal . "'";
        }

        if ($cliente) {
            $sql.= " and lower(ids.ca_nombre) like '%".strtolower($cliente)."%'";
        }
        
        $login = $request->getParameter("login");
        if ($login) {
            $this->usuario = Doctrine::getTable("Usuario")->find($login);
            $sql.= " and u.ca_login = '" . $this->usuario->getCaLogin() . "'";
        }

        $est = $request->getParameter("est");
        if ($est) {
            if ($est == "SIN") {
                $sql.= " and seg.ca_idseguimiento_cot IS NULL AND seg2.ca_idseguimiento_pro IS NULL";
            } else {
                $sql.= " and (c.ca_etapa = '$est' OR p.ca_etapa = '$est')";
            }
        }
        
        $mot = $request->getParameter("mot");
        if ($mot) {            
                $sql.= " and seg2.ca_seguimiento_pro='$mot'";
            
        }
        
        if ($idpais) {            
            $sql.= " and t.ca_idtrafico = '$idpais'";            
        }
        
        if ($idciudad) {            
            $sql.= " and o.ca_idciudad = '$idciudad'";
        }
        
        
        if ($idmodalidad) {            
            $sql.= " and p.ca_modalidad = '$idmodalidad'";            
        }
        if ($idimpoexpo) {            
            $sql.= " and p.ca_impoexpo= '$idimpoexpo'";
        }
        if ($idtransporte) {            
            $sql.= " and p.ca_transporte= '$idtransporte'";
        }
        
        
        //and seg2.ca_seguimiento_pro='Tarifa NO competitiva'

        $sql.= " order by c.ca_consecutivo DESC, c.ca_version DESC, seg.ca_fchseguimiento_cot DESC";
        // die($sql);

        /*$databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases_replica.yml');
        $dsn = explode(";", $databaseConf ['prod']['doctrine']['param']['dsn']);        
        $dsn0= explode("=", $dsn[0]);
        $dsn1= explode("=", $dsn[1]);        
        $userName = $databaseConf ['prod']['doctrine']['param']['username'];
        $userPass = $databaseConf ['prod']['doctrine']['param']['password'];
        $database = $dsn0[1];
        $host = $dsn1[1];        
        //$con = Doctrine_Manager::connection(new PDO("pgsql:dbname={$database};host={$host}", $userName, $userPass));*/
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);

        $this->cotizaciones = $st->fetchAll();
        /*$con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $this->cotizaciones = $st->fetchAll();
        */
        $this->est = $est;

        $estados = ParametroTable::retrieveByCaso("CU074");
        $this->estados = array();
        foreach ($estados as $e) {
            $this->estados[$e->getCaValor()] = $e->getCaValor2();
        }
    }

}

?>
