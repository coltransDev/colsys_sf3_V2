<?php

/**
 * confirmaciones actions.
 *
 * @package    colsys
 * @subpackage confirmaciones
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class confirmacionesActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->modo = $request->getParameter("modo");
    }

    /**
     * Resultados de la busqueda
     *
     * @param sfRequest $request A request object
     */
    public function executeBusqueda(sfWebRequest $request) {
        $criterio = $request->getParameter("criterio");
        $this->modo = $request->getParameter("modo");
        $cadena = $request->getParameter("cadena");

        if (!$cadena) {
            $this->redirect("confirmaciones/index?modo=" . $this->modo);
        }

        $q = Doctrine::getTable("InoMaestraSea")
                ->createQuery("m")
                ->select("m.*")
                ->innerJoin("m.InoClientesSea c")
                ->addOrderBy("m.ca_fchreferencia DESC")
                ->distinct()
                ->limit(200);


        switch ($criterio) {
            case "referencia":
                $cadena = str_replace("-", ".", $cadena);
                $q->addWhere("m.ca_referencia like ? ", "%" . $cadena . "%");
                break;
            case "reporte":

                $q->innerJoin("c.Reporte r");
                $q->addWhere("r.ca_consecutivo like ? ", "%" . $cadena . "%");
                break;
            case "blmaster":
                $q->addWhere("m.ca_mbls like ? ", "%" . $cadena . "%");
                break;
            case "motonave":
                $q->addWhere("m.ca_motonave like ? OR m.ca_mnllegada like ? ", array("%" . $cadena . "%", "%" . $cadena . "%"));
                break;
            case "hbl":
                $q->addWhere("c.ca_hbls like ?", "%" . $cadena . "%");
                break;
            case "cliente":
                $q->innerJoin("c.Cliente cl");
                $q->addWhere("UPPER(cl.ca_compania) like ? ", strtoupper($cadena) . "%");
                break;
            case "idcliente":
                $q->innerJoin("c.Cliente cl");
                $q->addWhere("cl.ca_idcliente = ? ", $cadena);
                break;
            case "contenedor":
                $q->innerJoin("c.InoMaestraSea mm");
                $q->innerJoin("mm.InoEquiposSea e");
                $q->addWhere("e.ca_idequipo like ? ", "%" . $cadena . "%");
                break;
        }

        if ($this->modo == "otm") {
            $q->addWhere("c.ca_continuacion != ? ", 'N/A');
        }


        // Defining initial variables
        $currentPage = $this->getRequestParameter('page', 1);
        $resultsPerPage = 30;

        // Creating pager object
        $this->pager = new Doctrine_Pager(
                $q, $currentPage, $resultsPerPage
        );

        $this->referencias = $this->pager->execute();
        if ($this->pager->getResultsInPage() == 1 && $this->pager->getPage() == 1) {
            $referencias = $this->referencias;
            $this->redirect("confirmaciones/consulta?referencia=" . str_replace(".", "-", $referencias[0]->getCaReferencia()) . "&modo=" . $this->modo);
            //$this->redirect("ids/verIds?modo=".$this->modo."&id=".$ids[0]->getCaId());
        }
        $this->criterio = $criterio;
        $this->cadena = str_replace(".", "-", $cadena);
    }

    /**
     * Muestra  el formulario
     *
     * @param sfRequest $request A request object
     */
    public function executeConsulta(sfWebRequest $request) {

        $referenciaParam = str_replace("-", ".", $request->getParameter("referencia"));
        $this->referencia = Doctrine::getTable("InoMaestraSea")->find($referenciaParam);
        $this->forward404Unless($this->referencia);

        $this->origen = $this->referencia->getOrigen();
        $this->destino = $this->referencia->getDestino();
        $this->linea = $this->referencia->getIdsProveedor();
        $this->modo = $request->getParameter("modo");
        $this->coordinadores = array();

        $parametros = ParametroTable::retrieveByCaso("CU046");
        foreach ($parametros as $parametro) {
            $valor = explode("|", $parametro->getCaValor());
            $this->coordinadores[$valor[0]] = $valor[1];
        }

        $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "confirmaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
        $this->textos = sfYaml::load($config);

        /*
         * Etapas 
         */

        if ($this->modo == "otm") {
            $departamento = "OTM/DTA";
        } else {
            $departamento = "Mar�timo";
        }

        $this->etapas = Doctrine::getTable("TrackingEtapa")
                ->createQuery("t")
                ->where("t.ca_departamento = ?", $departamento)
                ->addOrderBy("t.ca_orden")
                ->execute();

        if ($this->modo != "otm") {

            /*
             * Confirmaciones de llegada de puerto
             */
            $this->confirmaciones = Doctrine::getTable("Email")
                    ->createQuery("e")
                    ->select("e.*")
                    ->where("e.ca_subject like ?", '%' . $this->referencia->getCaReferencia() . '%')
                    ->addWhere("e.ca_tipo = ? OR e.ca_tipo = ? OR e.ca_tipo = ? OR e.ca_tipo = ?", array('Not.Llegada', 'Not.Desconsolidaci�n', 'Not.Planilla', 'Not.DIAN 1207'))
                    ->addOrderBy("e.ca_fchenvio DESC")
                    ->execute();
        }

        $q = Doctrine::getTable("InoClientesSea")
                ->createQuery("c")
                ->select("c.*")
                ->innerJoin("c.Cliente cl")
                ->where("c.ca_referencia = ?", $this->referencia->getCaReferencia())
                ->addOrderBy("cl.ca_compania");
        if ($this->modo == "otm") {
            $q->addWhere("c.ca_continuacion != ?", 'N/A');
        }
//      echo $q->getSqlQuery();
        $this->inoClientes = $q->execute();
    }

    /**
     * Crea el status
     *
     * @param sfRequest $request A request object
     */
    public function executeCrearStatus(sfWebRequest $request) {
        $referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("referencia"));
        $this->forward404Unless($referencia);
        $user = sfContext::getInstance()->getUser();
        $ca_referencia = $referencia->getCaReferencia();
        $modo = $request->getParameter("modo");
        $tipo_msg = $request->getParameter("tipo_msg");
        $tipo_fact = $request->getParameter("tipo_fact");
        $oids = $request->getParameter("oid");

        $config = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . "confirmaciones" . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "textos.yml";
        $text = sfYaml::load($config);

        $inoClientes = array();

        if (( $modo == "conf" && $tipo_msg == "Conf") || ($modo == "puerto" && $tipo_msg == "Puerto")) {
            if ($request->getParameter("fchconfirmacion")) {
                $fchconfirmacion = Utils::parseDate($request->getParameter("fchconfirmacion"));
                $referencia->setCaFchconfirmacion($fchconfirmacion);
                if ($referencia->getCaFcharribo() != $fchconfirmacion){
                    $observaciones = $referencia->getCaObservaciones().chr(13).date("m/d/Y")." Se actualiz� la Fecha de Arribo de ".$referencia->getCaFcharribo()." por $fchconfirmacion seg�n confirmaci�n de llegada.";
                    $referencia->setCaFcharribo($fchconfirmacion);
                    $referencia->setCaObservaciones($observaciones);
                }
            }
            $referencia->setCaHoraconfirmacion($request->getParameter("horaconfirmacion"));
            $referencia->setCaRegistroadu($request->getParameter("registroadu"));
            if ($request->getParameter("fchregistroadu")) {
                $referencia->setCaFchregistroadu(Utils::parseDate($request->getParameter("fchregistroadu")));
            }
            $referencia->setCaRegistrocap($request->getParameter("registrocap"));
            $referencia->setCaBandera($request->getParameter("bandera"));
            $referencia->setCaMensaje($request->getParameter("email_body"));
            if ($request->getParameter("fchdesconsolidacion")) {
                $referencia->setCaFchdesconsolidacion(Utils::parseDate($request->getParameter("fchdesconsolidacion")));
            }
            $referencia->setCaMnllegada($request->getParameter("mnllegada"));
            $referencia->setCaFchconfirmado(date("Y-m-d H:i:s"));
            $referencia->setCaUsuconfirmado($this->getUser()->getUserId());
            if ($request->getParameter("idmuelle"))
                $referencia->setCaMuelle($request->getParameter("idmuelle"));
            else
                $referencia->setCaMuelle(null);
            if ($request->getParameter("fchsyga")) {
                $referencia->setCaFchfinmuisca(Utils::parseDate($request->getParameter("fchsyga")));
            }
            $referencia->save();
        } else if ($modo == "puerto" && $tipo_msg == "Desc") {
            if ($request->getParameter("ca_fchvaciado") || $request->getParameter("ca_horavaciado")) {
                if ($request->getParameter("fchdesconsolidacion")) {
                    $referencia->setCaFchdesconsolidacion(Utils::parseDate($request->getParameter("fchdesconsolidacion")));
                }
                $referencia->setCaFchvaciado(Utils::parseDate($request->getParameter("ca_fchvaciado")));
                $referencia->setCaHoravaciado($request->getParameter("ca_horavaciado"));
                if ($request->getParameter("fchsyga")) {
                    $referencia->setCaFchfinmuisca(Utils::parseDate($request->getParameter("fchsyga")));
                }
                $referencia->save();
            }
        } else if ($modo == "puerto" && $tipo_msg == "Planilla") {
            $email_body_planilla = "Se reportan los siguientes n�meros de planilla as�:<br>";
            $email_body_planilla.="<table style='border: 1px solid black; border-collapse:collapse;'><tr><th style='border: 1px solid black;'>Cliente</th><th style='border: 1px solid black;'>HBL</th><th style='border: 1px solid black;'>Planilla Envio</th></tr>";
            foreach ($oids as $oid) {

                $idcliente = $this->getRequestParameter("idcliente_" . $oid);
                $hbls = $this->getRequestParameter("hbls_" . $oid);
                $inoCliente = Doctrine::getTable("InoClientesSea")->find($hbls);

                if ($inoCliente->getCaContinuacion() != "N/A") {
                    continue;
                }

                $cliente = $inoCliente->getCliente();
                if ($this->getRequestParameter("idplanilla_" . $oid)) {
                    $inoCliente->setCaPlanilla($this->getRequestParameter("idplanilla_" . $oid));
                    $inoCliente->save();
                    $email_body_planilla.= "<tr><td style='border: 1px solid black;'>" . $cliente->getCaCompania() . "</td><td style='border: 1px solid black;'>" . $hbls . "</td><td style='border: 1px solid black;'>Planilla # " . $inoCliente->getCaPlanilla() . "</td></tr>";
                }
            }
        }
        /*
         * Attachments Principal. V�lido para toda la referencia.
         */
        $i=0;
        if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            $attachment = $_FILES['attachment'];
        } else {
            $attachment = null;
        }

        if ($attachment) {
            $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR;
            $subdirectory = date("Y") . DIRECTORY_SEPARATOR . "Referencias/" . $ca_referencia . "/";
            $fileName = preg_replace('/\s\s+/', ' ', $attachment['name']);
            $fileName=urlencode($fileName);
            $fileName = str_replace("+", " ", $fileName);
            $attachments[] = $subdirectory . $fileName;

            $data = array();
            $data["iddocumental"] = 3;
            $data["ref1"] = $ca_referencia;
        }
        /*
         * Notificaci�n Puerto
         */

        if ($modo == "puerto") {

            $sql = "SELECT distinct(ca_email) ca_email FROM control.tb_usuarios WHERE ca_login in (SELECT DISTINCT ca_usucreado as ca_usuario FROM tb_inoclientes_sea where ca_referencia = '" . $ca_referencia . "' 
                        UNION SELECT DISTINCT ca_usuactualizado as ca_usuario FROM tb_inoclientes_sea WHERE ca_referencia = '" . $ca_referencia . "'
                        UNION SELECT DISTINCT ca_usumuisca as ca_usuario FROM tb_inomaestra_sea WHERE ca_referencia = '" . $ca_referencia . "' 
                        UNION SELECT DISTINCT d.ca_usucreado as ca_usuario FROM tb_dianclientes d INNER JOIN tb_inoclientes_sea ics ON d.ca_idinocliente = ics.ca_idinocliente WHERE ics.ca_referencia = '" . $ca_referencia . "'
                        UNION SELECT DISTINCT d.ca_usuactualizado as ca_usuario FROM tb_dianclientes d INNER JOIN tb_inoclientes_sea ics ON d.ca_idinocliente = ics.ca_idinocliente WHERE ics.ca_referencia = '" . $ca_referencia . "'
                        UNION SELECT DISTINCT ca_usucreado as ca_usuario FROM tb_inomaestra_sea WHERE ca_referencia = '" . $ca_referencia . "'
                        UNION (Select distinct(ca_login) from control.tb_usuarios where ca_idsucursal in (
                                select ca_idsucursal from control.tb_usuarios where ca_login in (
                                    select ca_vendedor from vi_clientes_reduc where ca_idcliente in (
                                        select ca_idcliente from tb_inoclientes_sea where ca_referencia='" . $ca_referencia . "' ) and ca_propiedades like 'cuentaglobal=true%')) 
                    and ca_departamento = 'Cuentas Globales'))";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
            $destinatarios = array();
            foreach ($this->resul as $r) {
                $destinatarios[] = $r["ca_email"];
            }

            switch ($tipo_msg) {
                case ("Puerto"):
                    $tipo = "Llegada";
                    $title = "Confirmaci�n de Llegada";
                    $intro = $request->getParameter("intro_body");
                    $body = $request->getParameter("email_body");
                    break;
                case ("Planilla"):
                    $tipo = "Planilla";
                    $title = "Informaci�n de Planilla";
                    $intro= $request->getParameter("intro_body_planilla");
                    $email_body = $request->getParameter("email_body");
                    $email_body_planilla.="<tr><td colspan='3' style='align:left; border: 1px solid black;'><b>$email_body</b></td></tr>";
                    $email_body_planilla.= "</table>";
                    $body = $email_body_planilla;
                    $iddocumental = 3;
                    break;
                case ("Desc"):
                    $tipo = "Desconsolidaci�n";
                    $title = "Informaci�n de Desconsolidaci�n";
                    $intro = $request->getParameter("intro_body_desc");
                    $body = $request->getParameter("email_body");
                    $otm = true;
                    $where = " and sc.ca_nombre in (
                                select distinct(s.ca_nombre)
                                from tb_inoclientes_sea  c
                                    inner join tb_reportes r on r.ca_idreporte=c.ca_idreporte
                                    inner join control.tb_usuarios u on r.ca_usucreado=u.ca_login
                                    inner join control.tb_sucursales s on s.ca_idsucursal=u.ca_idsucursal
                                where c.ca_referencia='" . $ca_referencia . "' and c.ca_continuacion <>'N/A')";
                    break;
                case ("1207"):
                    $tipo = "DIAN 1207";
                    $title = "Formulario DIAN 1207";
                    $intro = $request->getParameter("intro_body_1207");
                    $body = $request->getParameter("email_body");
                    $otm = true;

                    $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
                    $sucursal = $usuario->getSucursal()->getCaNombre();
                    $where = " OR sc.ca_nombre = '" . $referencia->getDestino()->getCaCiudad() . "' and e.ca_idempresa = 8";

                    $data["iddocumental"] = 11;
                    $destinatarios = array();
                    break;
            }

            if ($otm) {
                $sql2 = "SELECT DISTINCT u.ca_email
                        FROM control.tb_usuarios u
                        JOIN control.tb_sucursales sc on sc.ca_idsucursal=u.ca_idsucursal
                        JOIN control.tb_empresas e on sc.ca_idempresa=e.ca_idempresa
                        JOIN control.tb_usuarios_perfil up on up.ca_login = u.ca_login
                        WHERE up.ca_perfil = 'cordinador-de-otm' and u.ca_activo = true";

                $sql2 = $sql2 . $where;

                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql2);
                $this->resul = $st->fetchAll();
                foreach ($this->resul as $r) {
                    $destinatarios[] = $r["ca_email"];
                }
            }

            if ($attachment) {
                $success = ArchivosTable::subirDocumento($_FILES['attachment'], $data);

                if ($success != true) {
                    echo "<script>alert('No se pudo mover el archivo')
                        history.back();
                        </script>";
                    exit;
                } 
            }

            $email = new Email();
            $email->setCaUsuenvio($user->getUserId());
            $email->setCaTipo("Not." . $tipo);
            $email->setCaIdcaso(null);
            $email->setCaFrom($user->getEmail());
            $email->setCaFromname($user->getNombre());
            $email->setCaReplyto($user->getEmail());

            foreach ($destinatarios as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addTo($recip);
                }
            }

            $email->addCC($user->getEmail());

            $asunto = "Notificaci�n de " . $tipo . " desde el Puerto de " . $referencia->getDestino()->getCaCiudad() . " Ref.: " . $referencia->getCaReferencia();
            $email->setCaSubject(substr($asunto, 0, 250));

            if ($attachments) {
                $email->setCaAttachment(implode("|", $attachments));
            }

            sfContext::getInstance()->getRequest()->setParameter("referencia", $referencia->getCaReferencia());
            sfContext::getInstance()->getRequest()->setParameter("tipo", $tipo_msg);
            sfContext::getInstance()->getRequest()->setParameter("titulo", $title);
            sfContext::getInstance()->getRequest()->setParameter("intro_body", $intro);
            sfContext::getInstance()->getRequest()->setParameter("email_body", $body);

            if ($tipo_msg == "Desc") {
                sfContext::getInstance()->getRequest()->setParameter("fchsyga", $request->getParameter("fchsyga"));
            }
            $modo = $request->getParameter("modo");
            $email->setCaBodyhtml(sfContext::getInstance()->getController()->getPresentationFor('confirmaciones', 'emailConfirmacion'));
            $email->save();

            $this->modo = $modo;
            $this->ca_referencia = $ca_referencia;
        } else {
            foreach ($oids as $oid) {
                $idcliente = $this->getRequestParameter("idcliente_" . $oid);
                $idinocliente = $this->getRequestParameter("idinocliente_".$oid);
                $hbls = $this->getRequestParameter("hbls_" . $oid);
                
                //Archivos que se seleccionan desde el listado de Gesti�n Documental
                $attachments = array();
                
                $files = $this->getRequestParameter("files_" . $oid);   
                foreach ($files as $archivo) {
                    $name = str_replace(sfConfig::get('app_digitalFile_root'),"",$archivo);
                    $attachments[] = $name;
                }
                
                //Archivo que se adjunta a toda la referencia
                if($i==0){ // S�lo pregunta por �ste archivo la primera vez
                    if ($attachment) {
                        $success = ArchivosTable::subirDocumento($_FILES['attachment'], $data);
                        if ($success != true) {                        
                            echo "<script>alert('El archivo seleccionado en la opci�n General para toda la referencia no se ha subido correctamente')
                                history.back();
                                </script>";
                            exit;
                        } else {
                            $attachments[] = date("Y").DIRECTORY_SEPARATOR."Referencias".DIRECTORY_SEPARATOR.$data["ref1"].DIRECTORY_SEPARATOR.$fileName;
                            $i++;
                        }
                    }
                }else{
                    $attachments[] = date("Y").DIRECTORY_SEPARATOR."Referencias".DIRECTORY_SEPARATOR.$data["ref1"].DIRECTORY_SEPARATOR.$fileName;
                }

                //Archivo que se adjunta en cada HBL
                if (is_uploaded_file($_FILES['attachment_' . $oid]['tmp_name'])) {
                    $attachment2 = $_FILES['attachment_' . $oid];
                } else {
                    $attachment2 = null;
                }

                if ($attachment2) {
                    $fileName2 = preg_replace('/\s\s+/', ' ', $attachment2['name']);
                    $fileName2 = urlencode($fileName2);
                    $fileName2 = str_replace("+", " ", $fileName2);
                    $data = array();
                    $data["iddocumental"] = 3;
                    $data["ref1"] = $ca_referencia;
                    $data["ref2"] = $hbls;
                    if ($tipo_msg == "Fact") {
                        $data["iddocumental"] = 7;
                    }
                    
                    $success = ArchivosTable::subirDocumento($attachment2, $data);
                    if ($success != true) {
                        echo "<script>alert('error');
                            history.back();
                            </script>";
                        exit;
                    }else{
                        $ref2 = str_replace("/","-",$data['ref2']);
                        $attachments[] = date("Y").DIRECTORY_SEPARATOR."Referencias".DIRECTORY_SEPARATOR.$data["ref1"].DIRECTORY_SEPARATOR.$ref2.DIRECTORY_SEPARATOR.$fileName2;
                    }
                }

                $options = array();
                $inoCliente = Doctrine::getTable("InoClientesSea")->find($hbls);
                //exit($idinocliente);
                $reporte = $inoCliente->getReporte();
                
                if ($tipo_msg == "not_planilla" && trim($inoCliente->getCaContinuacion()) != "N/A") {
                    continue;
                }
                
                $status = new RepStatus();
                $status->setCaIdreporte($reporte->getCaIdreporte());
                $status->setCaFchstatus(date("Y-m-d H:i:s"));
                $status->setCaComentarios($this->getRequestParameter("notas"));
                $status->setCaFchenvio(date("Y-m-d H:i:s"));
                $status->setCaUsuenvio($this->getUser()->getUserId());

                if ($request->getParameter("observaciones_idg")) {
                   $status->setCaObservacionesIdg($request->getParameter("observaciones_idg"));
                }
                
                if ($request->getParameter("fchrecibido_" . $oid)) {
                    $horaRecibo = $request->getParameter("horarecibido_" . $oid);
                    $status->setCaFchrecibo(Utils::parseDate($request->getParameter("fchrecibido_" . $oid), "Y-m-d") . " " . $horaRecibo);
                }

                $ultimostatus = $reporte->getUltimoStatus();

                if ($ultimostatus) {
                    $status->setCaPiezas($ultimostatus->getCaPiezas());
                    $status->setCaPeso($ultimostatus->getCaPeso());
                    $status->setCaVolumen($ultimostatus->getCaVolumen());
                    $status->setCaIdnave($ultimostatus->getCaIdnave());
                    $status->setCaFchsalida($ultimostatus->getCaFchsalida());
                    $status->setCaFchllegada($ultimostatus->getCaFchllegada());
                    $status->setCaFchcontinuacion($ultimostatus->getCaFchcontinuacion());
                    $status->setCaDoctransporte($ultimostatus->getCaDoctransporte());
                }

                if (substr($referencia->getCaReferencia(), 0, 1) == "7") {
                    $status->setCaPiezas($inoCliente->getCaNumpiezas());
                    $status->setCaPeso($inoCliente->getCaPeso());
                    $status->setCaVolumen($inoCliente->getCaVolumen());
                    $status->setCaFchsalida($referencia->getCaFchembarque());
                    $status->setCaFchllegada($referencia->getCaFcharribo());
                    $status->setCaIdnave($referencia->getCaMotonave());
                    $status->setCaDoctransporte($inoCliente->getCaHbls());
                }

                switch ($modo) {
                    case "conf":
                    case "puerto":
                        switch ($tipo_msg) {
                            case "Conf":
                                $status->setCaIdetapa("IMCPD");
                                $status->setCaFchllegada($referencia->getCaFchconfirmacion());
                                break;
                            case "Desc":
                                $status->setCaIdetapa("IMDES");
                                //$options["subject"]="Notificaci�n de Desconsolidaci�n";
                                break;
                            default:
                                $status->setCaIdetapa("88888");
                                break;
                        }

                        if ($referencia->getCaMnllegada()) {
                            $status->setCaIdnave($referencia->getCaMnllegada());
                        } else {
                            $status->setCaIdnave($referencia->getCaMotonave());
                        }
                        if ($request->getParameter("mod_fcharribo")) {
                            $referencia->setCaFcharribo($request->getParameter("fcharribo"));
                            $referencia->save();
                            $status->setCaFchllegada($request->getParameter("fcharribo"));
                        }
                        break;
                    case "otm":
                        $etapa = $this->getRequestParameter("tipo_" . $oid);

                        if ($etapa == "IMCOL" || $this->getRequestParameter("modfchllegada_" . $oid)) {
                            $status->setCaFchcontinuacion(Utils::parseDate($this->getRequestParameter("fchllegada_" . $oid)));
                        }
                        if ($etapa == "IMCOL") {
                            $idbodega = $this->getRequestParameter("bodega_" . $oid);
                            $status->setProperty("idbodega", $idbodega);
                        }
                        if ($etapa == "99999") {
                            $fchplanilla = $this->getRequestParameter("fchplanilla_" . $oid);
                            $status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));
                        }
                        $status->setCaIdetapa($etapa);
                        break;
                    default:
                        $status->setCaIdetapa("88888");
                        break;
                }

                if ($tipo_msg == "Conf" || $tipo_msg == "Puerto") {
                    $status->setCaIntroduccion($this->getRequestParameter("intro_body"));
                    $status->setStatus($this->getRequestParameter("mensaje_" . $oid));
                } else if ($tipo_msg == "Cont") {
                    $options["subject"] = "Divisi�n de Contenedores Id.: " . $reporte->getCaConsecutivo()." ";
                    $status->setCaIntroduccion($this->getRequestParameter("status_intro_cont"));
                    $mensaje = $this->getRequestParameter("status_body_cont") . "\n";
                    if ($this->getRequestParameter("mensaje_" . $oid)) {
                        $mensaje .= "\n" . $this->getRequestParameter("mensaje_" . $oid);
                    }
                    $status->setStatus($mensaje);
                } else {
                    $status->setCaIntroduccion($this->getRequestParameter("status_body_intro"));
                    $mensaje = $this->getRequestParameter("status_body");
                    if ($tipo_msg == "not_planilla")
                        $mensaje.= "<br />Planilla No: <b>" . $inoCliente->getCaPlanilla() . "</b>";
                    if ($this->getRequestParameter("mensaje_" . $oid)) {
                        $mensaje .= "\n" . $this->getRequestParameter("mensaje_" . $oid);
                    }
                    if ($tipo_msg == "Fact"){
                        switch($tipo_fact){
                            case "fletes":
                                $options["subject"] = "Factura de Fletes Id.: " . $reporte->getCaConsecutivo()." ";
                                break;
                            case "otm":
                                $options["subject"] = "Factura de OTM Id.: " . $reporte->getCaConsecutivo()." ";
                                break;
                            case "cont":
                                $options["subject"] = "Factura de Contenedores Id.: " . $reporte->getCaConsecutivo()." ";
                                break;
                        }
                    }
                    $status->setStatus($mensaje);
                }

                $destinatarios = array();

                $checkbox = $request->getParameter("em_" . $oid);
                if ($checkbox) {
                    foreach ($checkbox as $check) {
                        $destinatarios[] = $request->getParameter("ar_" . $oid . "_" . $check);
                    }
                }

                $status->save();
                $status->send($destinatarios, array(), $attachments, $options);

                $this->status = $status;
                $this->modo = $modo;
                $this->referencia = $referencia;
            }
        }
    }

    public function executeEmailConfirmacion($request) {
        $this->referencia = Doctrine::getTable("InoMaestraSea")->find($request->getParameter("referencia"));
        $this->forward404Unless($this->referencia);
        $this->usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());

        $this->tipo = $request->getParameter("tipo");
        $this->titulo = $request->getParameter("titulo");
        $this->intro_body = $request->getParameter("intro_body");
        $this->email_body = $request->getParameter("email_body");
        $this->fchsyga = $request->getParameter("fchsyga");
        //echo $this->usuario->getCaLogin();
        $this->setLayout("email");
    }

    public function executeIdgConfirmacion($request) {
        $fecha = $request->getParameter("fecha");
        $hora = $request->getParameter("hora");
        $justifica = $request->getParameter("justifica");

        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($fecha." ".$hora, "%d-%d-%d %d:%d:%d");
        $inicio = mktime($hor, $min, $seg, $mes, $dia, $ano);
        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s"), "%d-%d-%d %d:%d:%d");
        $final = mktime($hor, $min, $seg, $mes, $dia, $ano);

        $festivos = TimeUtils::getFestivos(date("Y"));
        $diff = TimeUtils::calcDiff($festivos, $inicio, $final); // Retorna la diferencia en segundos entre dos fechas, horas h�biles excluyendo fines de semana y festivos
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $idgMax = IdgTable::getUnIndicador(RepStatus::IDG_CONF_LLEGADA, date("Y-m-d"), $usuario->getCaIdsucursal());
        $horas = intval($idgMax->getCaLim1());
        $minutos = 60 * ($idgMax->getCaLim1()-intval($idgMax->getCaLim1()));
        $idgMax = ($horas * 60 * 60) + ($minutos * 60);
        
        if ($diff > $idgMax and strlen($justifica)==0){
            $this->responseArray = array("success" => true, "cumplio" => "No");
        }else if ($diff > $idgMax and strlen($justifica)!=0){
            $this->responseArray = array("success" => true, "cumplio" => "Justifico");
        }else{
            $this->responseArray = array("success" => true, "cumplio" => "Si");
        }
        $this->setTemplate("responseTemplate");
    }

}

?>