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

        $link = "/tracking/login/activate/code/".$code;
        $config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."clientes".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."email.yml";
        $yml = sfYaml::load($config);


        $contentPlain = sprintf($yml['email'], "https://www.coltrans.com.co".$link, "http://www.coltrans.com.co");
        $contentHTML = sprintf(Utils::replace($yml['email']), "<a href='https://www.coltrans.com.co".$link."'>https://www.coltrans.com.co".$link."</a>", "<a href='http://www.coltrans.com.co'>http://www.coltrans.com.co</a>");
        ;

        $from = "serclientebog@coltrans.com.co";
        $fromName = "Coltrans S.A. - Servicio al cliente";
        //$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );
        //$to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido()=>$contacto->getCaEmail() );
        $to = array($contacto->getCaNombres()." ".$contacto->getCaPapellido() => $contacto->getCaEmail(), $this->getUser()->getNombre() => $this->getUser()->getEmail());
        //StaticEmail::sendEmail( "Activaci�n Clave Coltrans.com.co", array("plain"=>$contentPlain,"html"=>$contentHTML), $from, $fromName, $to );

        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaTipo("Activaci�n Tracking");
        $email->setCaFrom($from);
        $email->setCaReplyto($from);
        $email->setCaFromname($fromName);
        $email->addTo($contacto->getCaEmail());
        $email->addCc($this->getUser()->getEmail());
        $email->setCaSubject("Activaci�n Clave Coltrans.com.co");
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
     * Lista los Clientes con Estado Activo y que tinene m�s de 1 a�o sin reportar negocios
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
          ->set("l.ca_observaciones", "'Pierde Beneficios por Cambio de Estado. [Cupo: '||ca_cupo||' D�as: '||ca_diascredito||']\n'||l.ca_observaciones" )
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
        $sql.= "	where st1.ca_estado = 'Potencial' and st2.ca_estado  = 'Potencial' ";
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
        while ($row = $ante->fetch()) {      // Calcula el n�mero de Clientes Potenciales al inicio del periodo
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
            echo "<td>".$stdcliente['s_ca_idcliente']."</td>";
            echo "<td>".$stdcliente['s_ca_fchestado']."</td>";
            echo "<td>".$stdcliente['s_ca_estado']."</td>";
            echo "<td>".$stdcliente['s_ca_empresa']."</td>";
            echo "<td>".$mark."</td>";
            echo "</tr>";
        }
        echo "</table>";

        exit();
    }

    public function executeVerificaEstados($request) {
        // registro de control > 4622685

        set_time_limit(0);              // Estas rutina revisa todos los clientes y verifica si est�n adecuadamenten clasificados en su estado
        $empresas = array("Coltrans","Colmas");

        foreach($empresas as $empresa){
            $stmt = ClienteTable::estadoClientes(null, null, $empresa, null, null, null);
            list($year, $month, $day) = sscanf(date('Y-m-d'), "%d-%d-%d");
            $fch_ini = date('Y-m-d H:i:s', mktime( 0,  0,  0, $month, $day, $year-1));
            $fch_fin = date('Y-m-d H:i:s', mktime(23, 59, 59, $month, $day, $year));
            $clientes = array();
            while ($row = $stmt->fetch()) {
                $sb = ClienteTable::verificacionStdCliente($fch_ini, $fch_fin, $empresa, $row["ca_idcliente"]);
                while ($row1 = $sb->fetch()) {
                    $estado_cal = ($row1["ca_numnegocios"] == "" or $row1["ca_numnegocios"] == 0) ? "Potencial" : "Activo";
                    $resultado = ($row["ca_estado"]!=$estado_cal)?"Error":"OK";
                    /*
                    if ($row["ca_idcliente"] == 80089103){     // Ruptura de Control ver Variables
                        print_r($row);
                        print_r($row1);
                        echo "$fch_ini, $fch_fin | ";
                        echo $row["ca_estado"]." ".$estado_cal." ".$resultado." ".$empresa." ".$row1["ca_numnegocios"];

                        die();
                    }*/
                    if($row["ca_estado"]!="Vetado" and $resultado != "OK"){
                        if($row1["ca_fchnegocio"] != ""){
                            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($row1["ca_fchnegocio"], "%d-%d-%d %d:%d:%d");
                            if (($hor==0 and $min==0 and $seg==0) or ($hor==null and $min==null and $seg==null)) {
                                $hor=23; $min=59; $seg=59;
                            }
                            $fchnegocio = date("Y-m-d H:i:s", mktime($hor, $min, $seg, $mes, $dia, $ano));
                        }else if($row1["ca_fchnegocio"] == "" and $row["ca_estado"] == "Activo"){
                            $sc = ClienteTable::verificacionStdCliente(null, null, $row["ca_empresa"], $row["ca_idcliente"], "max");
                            while ($row2 = $sc->fetch()) {
                                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($row2["ca_fchnegocio"], "%d-%d-%d %d:%d:%d");
                                $fchnegocio = date("Y-m-d H:i:s", mktime(3, 0, 0, $mes, $dia+1, $ano+1));
                            }
                        }
                        $clientes[] = array($row["ca_idcliente"] => array($row["ca_empresa"], $row["ca_estado"], $row["ca_fchestado"], $row1["ca_numnegocios"], $fchnegocio, $estado_cal, $resultado));
                        $stdcliente = new StdCliente();
                        $stdcliente->setCaIdcliente($row["ca_idcliente"]);
                        $stdcliente->setCaEmpresa($row["ca_empresa"]);
                        $stdcliente->setCaEstado($estado_cal);
                        $stdcliente->setCaFchestado($fchnegocio);
                        $stdcliente->save();
                    }
                }
            }
            echo "<table border=1>";
            foreach($clientes as $cliente){
                foreach($cliente as $key => $campos){
                    if ($campos[6]!="OK"){
                        echo "<tr>";
                        echo "<td>$key</td>";
                        foreach($campos as $campo){
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
        $this->clientesSinVisita = array();
        // $this->clientesSinBeneficio = array();
        list($year, $month, $day) = sscanf($final, "%d-%d-%d");

        // Lista los Clientes a los cuales se les vence la Circular 0170 en el siguiente mes
        $stmt = ClienteTable::circularClientes($inicio, $final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesCircular[] = $row;

            // Si es el proceso Autom�tico que se ejecuta los 20 de cada mes, envia comunicaci�n al cliente
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
                foreach($contactos as $contacto){
                    if ($contacto->getCaFijo()){
                        $email->addTo($contacto->getCaEmail());
                    }

                }
                $email->setCaFrom($comercial->getCaEmail());
                $email->setCaFromname($comercial->getCaNombre());
                $email->setCaReplyto($comercial->getCaEmail());
                $email->addCc($comercial->getCaEmail());

                // $email->addCc("clopez@coltrans.com.co");    // Pruebas de envio controlado

                $sucursal_obj = $comercial->getSucursal();
                $direccion_suc = $sucursal_obj->getCaDireccion()." ".$sucursal_obj->getCaNombre();

                /*
                  reset($defaultEmail);
                  while (list ($clave, $val) = each ($defaultEmail)) {
                  $email->addCc( $val );
                  }
                  reset($ccEmails);
                  while (list ($clave, $val) = each ($ccEmails)) {
                  $email->addCc( $val );
                  }
                 */

                $email->setCaSubject("Vencimiento de Circular 0170 Coltrans S.A.");

                $mes_esp = array("01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
                $siguiente_mes = mktime(0, 0, 0, $month + 1, 5, $year);
                $siguiente_mes = $mes_esp[date("m", $siguiente_mes)]." ".date("d", $siguiente_mes)." de ".date("Y", $siguiente_mes);

                $bodyHtml = "Se�ores<br />";
                $bodyHtml.= "<b>".$cliente->getCaCompania()."</b><br />";
                $bodyHtml.= "La Ciudad<br /><br /><br />";
                $bodyHtml.= "<u><b>ASUNTO: DOCUMENTOS IDENTIFICACI�N CLIENTE<b></u><br /><br /><br />";
                $bodyHtml.= "Respetado Cliente:<br /><br />";
                $bodyHtml.= "En cumplimiento con la Circular No 0170 de la DIAN expedida el 10 de Octubre de 2002, es nuestra Obligaci�n como Agentes de Carga Internacional, crear un banco de datos de nuestros clientes para <b>Prevenci�n y Control de Lavado de Activos</b>, solicitamos su colaboraci�n con el diligenciamiento de la misma y enviarlo a la $direccion_suc con los documentos requeridos en la carta adjunta antes de <b>$siguiente_mes</b> o si lo prefiere puede contactarnos para que un funcionario recoja los documentos.<br /><br /><br />";
                $bodyHtml.= "Agradezco su colaboraci�n.<br /><br /><br />";
                $bodyHtml.= "<b>Recuerde que esta informaci�n se debe actualizar cada a�o.</b>";

                $email->setCaBodyhtml($bodyHtml);
                $email->addAttachment("Attachements/CARTA_CIRCULAR_184.doc");
                $email->addAttachment("Attachements/NUEVA_CIRC_ 170.xls");

                $email->save();
            }
        }

        // Lista los Clientes que hasta antes de iniciar el periodo solicitado, tienen vencida la Circular 0170
        $final = $inicio;
        $inicio = date('Y-m-d', mktime(0, 0, 0, $month, 0, $year - 5));
        $stmt = ClienteTable::circularClientes($inicio, $final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesVenCircular[] = $row;
        }

        // Lista los Clientes no tienen Circular 0170, sin importar la fecha
        $stmt = ClienteTable::clientesSinCircular($final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesSinCircular[] = $row;
        }

        // Lista los Clientes no tienen Encuesta de Visita
        $stmt = ClienteTable::clientesSinVisita($final, $sucursal, $vendedor);
        while ($row = $stmt->fetch()) {
            $this->clientesSinVisita[] = $row;
        }

        // Si es el proceso Autom�tico que se ejecuta los 20 de cada mes, verifica los Clientes que tienen m�s de 60 d�as
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
          ->set("l.ca_observaciones", "'Pierde Beneficios por Vencimiento de Circular 0170. [Cupo: '||ca_cupo||' D�as: '||ca_diascredito||']\n'||l.ca_observaciones" )
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

    public function executeReporteCircularEmail() {
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
    }

    public function executeReporteListaClinton() {
        $this->setLayout("email");
        try {               //  Controla cualquier error el la ejecuci�n de la rutina
            set_time_limit(0);
            echo "\n\nInicio el proceso : ".date("h:i:s A")."\n\n";

            $file = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."clinton.xml";
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
            echo "Temina Lectura de Archivo Plano desde la Pagina Web www.treas.gov : ".date("h:i:s A")."\n\n";

            echo "Inicia Seleccion de Registro para Colombia y Carga de tablas : ".date("h:i:s A")."\n\n";
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
                                if ($element->nodeName == 'Publish_Date') {  // Captura la Fecha de Publicaci�n del Archivo
                                    $ultimo = Doctrine::getTable("Parametro")->find(array("CU065", 1, "publishInformation"));
                                    if ($ultimo->getCaValor2() == $element->nodeValue) { // Compara con el Caso de Uso
                                        die('Finaliza sin Actualizaciones');
                                    } else {
                                        SdnTable::eliminarRegistros();    // Crea objeto Sdn solo para invocar m�todo que limpia las tablas
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
                                } else if ($element->nodeName == 'akaList') {       // Evalua el elemento por su lista de Hom�nimos
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
                                $campo = "setCa".ucfirst(strtolower($clave));

                                $sdnEntryObj->$campo($val);
                            }
                            $sdnEntryObj->save();

                            if (count($sdnIdList) != 0) {
                                while (list ($sub_id, $arreglo) = each($sdnIdList)) {
                                    $sdnIdListObj = new SdnId();
                                    $sdnIdListObj->setCaUid($id);
                                    $sdnIdListObj->setCaUidId($sub_id);
                                    while (list ($clave, $val) = each($arreglo)) {
                                        $campo = "setCa".ucfirst(strtolower($clave));
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
                                        $campo = "setCa".ucfirst(strtolower($clave));
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
                                        $campo = "setCa".ucfirst(strtolower($clave));
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


            echo "Termina Carga de tablas : ".date("h:i:s A")."\n\n";

            echo "Inicia comparativo con Maestra de Clientes: ".date("h:i:s A")."\n\n";
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
                        $email->setCaSubject("Verificaci�n Clientes en Lista Clinton - $ven_mem");
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
                            if ($empleado->getCaActivo()){
                                if ($empleado->getCaCargo() == "Jefe Dpto. Administrativo" and ($empleado->getCaSucursal() == "Barranquilla" or $empleado->getCaSucursal() == "Cali" or $empleado->getCaSucursal() == "Medell�n")) {
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
                    $msn_mem = "El sistema ha encontrado algunas similitudes en su listado de Clientes, comparado con la Lista Clinton del d�a $nueva_fecha. Favor hacer la respectivas verificaciones y tomar acci�n en caso de que un cliente haya sido reportado.";
                    $msn_mem.= "<br />";
                    $msn_mem.= "<table width='90%' cellspacing='1' border='1'>";
                    $msn_mem.= "	<tr>";
                    for ($i = 0; $i < count($tit_mem); $i++) {
                        $msn_mem.= "	<th>".$tit_mem[$i]."</th>";
                    }
                    $msn_mem.= "	</tr>";
                }
                $msn_mem.= "	<tr>";
                for ($i = 0; $i < count($tit_mem); $i++) {
                    $msn_mem.= "	<td>".$row[$tit_mem[$i]]."</td>";
                }
                $msn_mem.= "	</tr>";
            }
            $msn_mem.= "</table>";
            $msn_mem.= "<br / >Fin del Reporte.";

            reset($ccEmails);
            while (list ($clave, $val) = each($ccEmails)) {
                $email->addCc($val);
            }
            $email->setCaSubject("Verificaci�n Clientes en Lista Clinton - ".$ven_mem);
            $email->setCaBodyhtml($msn_mem);
            $email->save(); //guarda el cuerpo del mensaje

            if (isset($ultimo)) {
                $ultimo->setCaValor2($nueva_fecha);
                $ultimo->save();
            }
            echo "Finaliza comparativo con Maestra de Clientes: ".date("h:i:s A")."\n\n";
            echo "\n \n Fin del Proceso de Importaci�n \n\n";
        } catch (Exception $e) {

            echo $e->getMessage()."\n\n".$e->getTraceAsString();
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

            $email->setCaSubject("�Error en la Verificaci�n con Lista Clinton!");
            $email->setCaBodyhtml("Caught exception: ".$e->getMessage()."\n\n".$e->getTraceAsString()."\n\n Se ha presentado un error en el proceso que lee la informaci�n de Lista Clinton y la compara con la Maestra de Clientes Activos de COLSYS. Agradecemos confirmar que el Departamento de Sistemas est� enterado de esta falla. Gracias!");
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
        $query = "select ic.ca_referencia, ic.ca_idcliente, cl.ca_compania, ic.ca_fchliberacion, ic.ca_notaliberacion, ic.ca_fchliberado, ii.ca_factura, ii.ca_hbls, u.ca_nombre, u.ca_sucursal";
        $query.= "		from tb_inoclientes_sea ic";
        $query.= "		INNER JOIN vi_clientes_reduc cl ON ic.ca_idcliente = cl.ca_idcliente";
        $query.= "		INNER JOIN tb_inoingresos_sea ii ON ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hbls=ii.ca_hbls";
        $query.= "		INNER JOIN vi_usuarios u ON u.ca_login = ic.ca_usuliberado";
        $query.= "		where ic.ca_fchliberacion IS NOT NULL and ic.ca_fchliberacion BETWEEN '$fchinicial' and '$fchfinal'";
        $query.= "		and cl.ca_compania='$cliente'";
        $query.= "      order by ic.ca_fchliberacion DESC";

        $this->listado = $q->execute($query);
        $this->cliente = $cliente;
        $this->fchinicial = $fchinicial;
        $this->fchfinal = $fchfinal;
    }
    
    public function executeRc()
    {

    }

    public function executeProcesarRc(sfWebRequest $request)
    {
        try
        {
            $con = Doctrine_Manager::getInstance()->connection();
            $estadisticas=array();
            $folder="Rc";
            $file=sfConfig::get('app_digitalFile_root').$folder.DIRECTORY_SEPARATOR.$request->getParameter("archivo");
            
            chmod ( $file , 0777 );
            $lines = file($file);

            $resultado=array();
            $resultado1=array();
            $tipos=array("tb_inoingresos_sea","tb_inoingresos_air","tb_expo_ingresos","tb_brk_ingresos");
            $pk=array("tb_inoingresos_sea"=>  explode(",", "ca_referencia,ca_idcliente,ca_hbls,ca_factura"),
                "tb_inoingresos_air"=>explode(",", "ca_referencia,ca_idcliente,ca_hawb,ca_factura"),
                "tb_expo_ingresos"=>explode(",", "ca_referencia,ca_idcliente,ca_documento,ca_factura"),
                "tb_brk_ingresos"=>explode(",", "ca_referencia,ca_factura"));
            
            $sql_update="";
            $total=count($lines);
            
            $sucRec=array("1"=>"BOG","2"=>"MDE","3"=>"CLO","4"=>"BAQ","5"=>"DOLARES","6"=>"PEI","7"=>"BUN","8"=>"CTG","9"=>"BUC");
            $sucFacAssoc=array("BOG"=>"1","CLO"=>"2","MDE"=>"3","BAQ"=>"4","PEI"=>"5","BUN"=>"7","ABO"=>"1");
            $sucFac=array("1"=>"BOG","2"=>"CLO","3"=>"MDE","4"=>"BAQ","5"=>"PEI","7"=>"PEI");
            $sqltmp="";
            for($i=0;$i<count($lines);$i++)
            {                
                $sql_update="";
                $datos=explode(",", $lines[$i]);
                
                $suc_recibo= (int)str_replace("\"", "", $datos[1]);
                $suc_factura= (int)str_replace("\"", "", $datos[11]);
                
                $tipo_comp= (int)str_replace("\"", "", $datos[10]);
                
                $nfact= (int)str_replace("\"", "", $datos[12]);
                $pre=str_replace("\"", "", $datos[0]).((int)str_replace("\"", "", $datos[1]));
                
                $nrecibo= (int)str_replace("\"", "", $datos[2]);
                $fecha_pago=Utils::parseDate((int)str_replace("\"", "", $datos[7]));
                $comienzo_log="<b>linea</b>=".$i.":::<b>Factura</b>=".$nfact.":::<b>Recibo</b>=".$nrecibo." ::: ";
                if(count($datos)!=13)
                {
                    $resultado[$i]=$comienzo_log."Existen cantidad de campos diferente a los establecidos<br>";
                    $estadisticas["formato_incorrecto"]++;
                    continue;
                }                
                //echo $sucRec[$suc_recibo].'-'.$sucFac[$suc_factura]."<br>";
                if($sucRec[$suc_recibo]!=$sucFac[$suc_factura])
                {
                    $resultado[$i]=$comienzo_log."La sucursal registrada en el recibo es diferente a la de la factura";
                    $estadisticas["direfente_sucursal"]++;
                    continue;
                }
                
                if(!$nfact || $tipo_comp!="F")
                {
                    $resultado[$i]=$comienzo_log."No posee No Factura";
                    $estadisticas["sin_factura"]++;
                    continue;
                }
                if($datos[2]=="" && $datos[7]=="")
                {
                    $resultado[$i]=$comienzo_log."No posee No Recibo de caja ni fecha de pago";
                    $estadisticas["sin_recibo"]++;
                    $estadisticas["sin_fecha"]++;
                    continue;
                }
                if($datos[2]=="")
                {
                    $resultado[$i]=$comienzo_log."No posee No Recibo de caja";
                    $estadisticas["sin_recibo"]++;
                }
                if($datos[7]=="")
                {
                    $resultado[$i]=$comienzo_log."No posee fecha de pago";
                    $estadisticas["sin_fecha"]++;
                }

                $encontro=false;
                $actualizo=false;

                $sucursal=$sucRec[$suc_recibo];
                if($sucursal=="BOG" || $sucursal=="ABO")
                    $sucursal="'BOG','ABO'";
                else
                    $sucursal="'$sucursal'";
                
                
                foreach($tipos as $tabla)
                {
                    $sql="select t.*,u.ca_idsucursal from ".$tabla." t,control.tb_usuarios u where ca_factura ='".$nfact."' and t.ca_usucreado=u.ca_login and u.ca_idsucursal in ($sucursal) ";
                    //echo  $sql."<br>";
                    $st = $con->execute($sql);
                    $ref = $st->fetch();
                    
                    if($ref)
                    {
                        //echo "$i<br>";
                        $set="";
                        $sql_update="update ".$tabla." set ";
                        $where="";
                        if($nrecibo)
                        {
                            //if($ref["ca_reccaja"]=="" || $ref["ca_reccaja"]=="''"  )
                            {
                                $set=" ca_reccaja='".$pre." ".$nrecibo."'";
                            }
                            /*else
                            {
                                $resultado[$i].=($resultado[$i]=="")?$comienzo_log:"";
                                $resultado[$i].="-".$tabla.":: Recibo de caja ya cargado 'No se actualizo',";
                            }*/
                        }
                        
                        if($fecha_pago)
                        {
                            //if($ref["ca_fchpago"]=="")
                            {
                                $set.=($set!="")?",":"";
                                $set.=" ca_fchpago='".$fecha_pago."'";                                
                            }
                            /*else
                            {
                                $resultado[$i].=($resultado[$i]=="")?$comienzo_log:"";
                                $resultado[$i].=$tabla.":: Fecha de pago ya cargada 'No se actualizo',";
                            }*/
                        }
                        
                        if($set!="")
                        {
                            foreach($pk[$tabla] as $p)
                            {
                                $where.= " and $p='".$ref[$p]."' ";
                            }
                            //$sql.=$where;
                            $sql_update.=$set." where 1=1 $where;";
//                            $st = $con->execute($sql_update);
                            $sqltmp.=$sql_update."<br>";
                            $actualizo=true;
                        }
                        else
                        {
                            $actualizo=false;
                        }
                        
                        $encontro=true;
                    }
                    else
                    {
                        $resultado[$i].=($resultado[$i]=="")?$comienzo_log:"";
                        $resultado[$i].=$tabla.":: Registro NO ENCONTRADO --";
                    }
                }
                
                if(!$encontro || !$actualizo)
                {
                    $resultado[$i].=($resultado[$i]=="")?$comienzo_log:"";
                    if(!$encontro)
                    {
                        $resultado[$i].="factura no encontrada";
                        $estadisticas["no_encontrado"]++;
                    }
                    if(!$actualizo)
                    {
                        $resultado[$i].="Registro no actualizado";
                        $estadisticas["no_actualizado"]++;
                    }
                }
                else
                {
                    $estadisticas["actualizada"]++;
                }
            }
            $estadisticas["total"]=$total;
            //print_r($estadisticas);
            //echo $sqltmp;
            $this->responseArray=array("success"=>"true","resultado"=>  implode("<br>", $resultado),"estadisticas"=>$estadisticas,"sqlimpor"=>$sqltmp);
        }
        catch(Exception $e)
        {
            $this->responseArray=array("success"=>"false","errorInfo"=>$e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
}
?>