<?php

/**
 * pm actions.
 *
 * @package    colsys
 * @subpackage helpdesk
 * @author     Andr�s Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 *
 * Niveles de acceso
 * 0 Solo tickets puestos por el usuario.
 * 1 Tickets de su grupo o �rea unicamente.
 * 2 Acceso a los tickets de su departamento.
 * 3 Acceso a todo.
 */
class pmActions extends sfActions {
    const RUTINA = "89";
    const HELPDESK = "39";

    public function getNivel() {
        $this->nivel = $this->getUser()->getNivelAcceso(pmActions::RUTINA);
        if (!$this->nivel || $this->nivel< 0 ) {
            $this->nivel = 0;
        }
        
        $this->app = sfContext::getInstance()->getConfiguration()->getApplication();
        if ($this->app == "intranet") {
            $this->nivel = $this->getUser()->getNivelAcceso(pmActions::HELPDESK);
            if (!$this->nivel || $this->nivel< 0) {
                $this->nivel = 0;
            }
        }

        $this->forward404Unless($this->nivel != -1);
        //return 0;
        return $this->nivel;
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        $this->nivel = $this->getNivel();
        //echo $this->nivel;
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/RowExpander", 'last');
        $response->addJavaScript("extExtras/SliderTip", 'last');
        $response->addStylesheet("extExtras/slider", 'last');
        $response->addJavaScript("extExtras/StarColumn", 'last');        
        $response->addJavaScript("extExtras/Spinner.js", 'last');
        $response->addJavaScript("extExtras/SpinnerField.js", 'last');
        $response->addJavaScript("extExtras/NumberFieldMin.js", 'last');
        
        $response->addStyleSheet("extExtras/Spinner.css",'last');

        $this->idticket = $request->getParameter("idticket");
    }

    /**
     * Datos del ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelTickets(sfWebRequest $request) {
        $nivel = $this->getNivel();
        $opcion = $request->getParameter("opcion");
        $criterio = $request->getParameter("criterio");
        $groupby = $request->getParameter("groupby");

        $this->forward404Unless($request->getParameter("idgroup") || $request->getParameter("idproject") || $request->getParameter("option"));

        $q = Doctrine_Query::create()
                ->select("h.ca_starred, h.*, g.ca_name, u.ca_nombre, u.ca_extension, s.ca_nombre, m.ca_due,
                    m.ca_title, p.ca_name, tar.ca_fchterminada, tar.ca_fchvencimiento,
                    (SELECT MAX(rr.ca_createdat) FROM HdeskResponse rr WHERE rr.ca_idticket = h.ca_idticket ) as ultseg,
                    (SELECT MAX(t.ca_fchvencimiento) FROM HdeskResponse rr2 , NotTarea t WHERE rr2.ca_idtarea=t.ca_idtarea AND rr2.ca_idticket = h.ca_idticket ) as proxseg,
                    (SELECT MIN(he.ca_estimated) FROM HdeskEstimations he WHERE he.ca_idticket = h.ca_idticket AND he.ca_idresponse IS NULL) as proxest")
                ->from('HdeskTicket h');
        $q->innerJoin("h.HdeskGroup g");
        $q->leftJoin("h.HdeskTicketUser hu  ");
        $q->leftJoin("h.HdeskProject p");
        $q->leftJoin("h.HdeskMilestone m");
        $q->leftJoin("h.NotTarea tar");
        $q->leftJoin("h.Usuario u");
        $q->leftJoin("u.Sucursal s");

        if ($request->getParameter("iddepartament")) {

            $q->addWhere("g.ca_iddepartament = ? ", $request->getParameter("iddepartament"));
        }

        if ($request->getParameter("idgroup")) {
            $q->addWhere("h.ca_idgroup = ? ", $request->getParameter("idgroup"));
        }

        if ($request->getParameter("criterio")) {
            $criterio = $request->getParameter("criterio");
            $q->where("(h.ca_title like ?  or r.ca_text like ?) ", array("%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%"));
        }

        if ($request->getParameter("idproject")) {
            $q->addWhere("h.ca_idproject = ? ", $request->getParameter("idproject"));
        }

        if ($request->getParameter("priority")) {
            $q->addWhere("h.ca_priority = ? ", $request->getParameter("priority"));
        }

        if ($request->getParameter("actionTicket")) {
            if ($request->getParameter("actionTicket") == "Cerrado") {
                $q->addWhere("h.ca_closedat IS NOT NULL");
            } elseif ($request->getParameter("actionTicket") == "Abierto") {
                $q->addWhere("h.ca_closedat IS NULL");
            }
        }

        if ($request->getParameter("type")) {
            $q->addWhere("h.ca_type = ? ", $request->getParameter("type"));
        }


        if ($request->getParameter("assignedTo")) {
            $q->addWhere("h.ca_assignedto = ? OR h.ca_assignedto IS NULL", $request->getParameter("assignedTo"));
        }

        if ($request->getParameter("reportedBy")) {

            $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($request->getParameter("reportedBy"), $request->getParameter("reportedBy")));
        }


        if ($request->getParameter("option") == "misTickets") {
            $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid()));
            $q->addWhere("h.ca_closedat IS NULL");
        }

        $q->addOrderBy("h.ca_idgroup ASC");
        $q->addOrderBy("h.ca_idproject ASC");
        $q->addOrderBy("h.ca_idticket DESC");
        $q->addOrderBy("h.ca_closedat");
        $q->addOrderBy("h.ca_opened ASC");


        /*
         * Aplica restricciones de acuerdo al nivel de acceso.
         */

        switch ($nivel) {
            case 0:
                $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid()));
                break;
            case 1:
                $q->innerJoin("g.HdeskUserGroup uggg ");

                $q->addWhere("(h.ca_login = ? OR uggg.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid()));
                break;
        }

        if ($nivel == 2 || $nivel == 3) {
            $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento()));
        }


        $q->distinct();
        //exit($q->getSqlQuery());
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        //$q->limit(400);
        $tickets = $q->execute();
        
        
        
        $parametros = ParametroTable::retrieveByCaso("CU110");
        $status = array();
        foreach ($parametros as $p) {
            $status[$p->getCaIdentificacion()] = array("nombre" => utf8_encode($p->getCaValor()), "color" => $p->getCaValor2());
        }


        foreach ($tickets as $key => $val) {
            $tickets[$key]["h_ca_action"] = $tickets[$key]["h_ca_closedat"] ? "Cerrado" : "Abierto";
            $tickets[$key]["g_ca_name"] = utf8_encode($tickets[$key]["g_ca_name"]);
            $tickets[$key]["h_ca_reportedby"] = utf8_encode($tickets[$key]["h_ca_reportedby"]);
            $tickets[$key]["h_ca_type"] = utf8_encode($tickets[$key]["h_ca_type"]);
            $tickets[$key]["milestone"] = utf8_encode($tickets[$key]["m_ca_title"] . " " . Utils::fechaMes($tickets[$key]["m_ca_due"]));
            $tickets[$key]["h_ca_title"] = utf8_encode(str_replace('"', "'", $tickets[$key]["h_ca_title"]));
            $tickets[$key]["h_ca_text"] = utf8_encode(str_replace("</style", "</style2", str_replace("<style", "<style2", str_replace('"', "'", $tickets[$key]["h_ca_text"]))));
            $tickets[$key]["p_ca_name"] = $tickets[$key]["p_ca_name"] ? utf8_encode(str_replace('"', "'", $tickets[$key]["p_ca_name"])) : "Sin proyecto";
            $tickets[$key]["folder"] = base64_encode(HdeskProject::FOLDER . DIRECTORY_SEPARATOR . $tickets[$key]["h_ca_idticket"]);
            $tickets[$key]["contact"] = utf8_encode($tickets[$key]["s_ca_nombre"] . " " . $tickets[$key]["u_ca_extension"]);
            $tickets[$key]["u_ca_nombre"] = utf8_encode($tickets[$key]["u_ca_nombre"]);
	    $tickets[$key]["u_ca_extension"] = utf8_encode($tickets[$key]["u_ca_extension"]);
            $tickets[$key]["s_ca_nombre"] = utf8_encode($tickets[$key]["s_ca_nombre"]);
            $tickets[$key]["status_name"] = isset($status[$tickets[$key]["h_ca_status"]]) ? utf8_encode($status[$tickets[$key]["h_ca_status"]]["nombre"]) : "";
            $tickets[$key]["status_color"] = isset($status[$tickets[$key]["h_ca_status"]]) ? $status[$tickets[$key]["h_ca_status"]]["color"] : "";
        }

	//echo "<pre>";print_r($tickets);echo "</pre>";
        
        $this->responseArray = array("success" => true, "total" => count($tickets), "root" => $tickets);

        $this->setTemplate("responseTemplate");
    }

    /**
     * Vista previa de un ticket y permite adicionar respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeVerTicket(sfWebRequest $request) {

	$this->nivel = $this->getNivel();
            
        $this->iddepartamento = $this->getUser()->getIddepartamento();
        $this->empresa=sfConfig::get('app_branding_name');
        
        $idticket = $request->getParameter("id");
        $this->format = $request->getParameter("format");
        if($this->format == "email")
            $this->ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        else
            $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);
        
        if(!$this->ticket)
            $this->redirect("pm/noAccess");

        if ($request->getParameter("format") == "email") {
            $this->setLayout("none");
        } else {
            $this->redirect("pm/index?idticket=" . $idticket);
        }


        $this->loginsGrupo = array();
        $usuarios = Doctrine::getTable("HdeskUserGroup")->createQuery("ug")
                ->where("ug.ca_idgroup = ?", $this->ticket->getCaIdgroup())
                ->addOrderBy("ug.ca_login")
                ->execute();
        foreach ($usuarios as $usuario) {
            $this->loginsGrupo[] = $usuario->getCaLogin();
        }


        $this->user = $this->getUser();
       
        $directorio = $this->ticket->getDirectorio();

        $this->files = sfFinder::type('file')->maxDepth(0)->in($directorio);
        $this->childrens = $this->ticket->getChildren();
        $this->entregas = $this->ticket->getHdeskEstimations();

        $this->usuarios = Doctrine::getTable("Usuario")->createQuery("u")
                ->innerJoin("u.HdeskTicketUser ug")
                ->addWhere("ug.ca_idticket = ?", $this->ticket->getCaIdticket())
                ->addWhere("u.ca_activo = ?", true)
                ->addOrderBy("u.ca_nombre")
                ->execute();


        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/RowExpander", 'last');
        $response->addJavaScript("extExtras/SliderTip", 'last');
        $response->addStylesheet("extExtras/slider", 'last');
    }

    /**
     * Formulario para crear un n uevo ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeCrearTicket(sfWebRequest $request) {

        $this->nivel = $this->getNivel();        
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();

        $idticket = $request->getParameter("id");
        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);


        if (!$this->ticket) {
            $this->ticket = new HdeskTicket();
        }

        $departamentos = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->where("d.ca_inhelpdesk = ?", true)
                ->andWhereIn("d.ca_idempresa", $grupoEmp)                
                ->execute();

        $this->departamentos = array();

        foreach ($departamentos as $departamento) {
            $this->departamentos[] = array("iddepartamento" => $departamento->getCaIddepartamento(),
                "nombre" => $departamento->getCaNombre()
            );
        }


        $this->iddepartamento = $this->getUser()->getIddepartamento();

        $usersGroup = Doctrine::getTable("HdeskUserGroup")
                ->createQuery("d")
                ->where("d.ca_login = ?", $this->getUser()->getUserId())
                ->execute();
        $this->grupos = array();
        foreach ($usersGroup as $usersGroup) {
            $this->grupos[] = $usersGroup->getCaIdgroup();
        }

        $this->user = $this->getuser();
    }

    /**
     * Coloca una estrella al ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeStarTicket(sfWebRequest $request) {
        $conn = Doctrine::getTable("HdeskResponse")->getConnection();
        $conn->beginTransaction();
        try {
            $this->nivel = $this->getNivel();
            $idticket = $request->getParameter("idticket");
            $this->forward404Unless($this->nivel > 0);
            $ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);
            $this->forward404Unless($ticket);

            $status = $request->getParameter("status");
            $ticket->setCaStarred($status);
            $ticket->save($conn);
            $this->responseArray = array("success" => true, "idticket" => $idticket);
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Guarda un seguimiento a un ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarRespuestaTicket(sfWebRequest $request) {
        $conn = Doctrine::getTable("HdeskResponse")->getConnection();
        $conn->beginTransaction();
        try {
            $user=null;
            $logFile = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR."colsyslog".DIRECTORY_SEPARATOR. "tickets_error.log";
            if($request->getParameter("iduser"))
            {            
                $user = Doctrine::getTable("Usuario")->find($request->getParameter("iduser"));
                //echo $user->getNivelAcceso(helpdeskActions::RUTINA);
            }
            else
            {
                $user = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
            }
            $this->nivel = $user->getNivelAcceso(pmActions::RUTINA);
            $idticket = $request->getParameter("idticket");
            $ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel,$user);
            $this->forward404Unless($ticket);

            $idissue = $request->getParameter("idissue");

            

            //$user = $this->getUser();

            $respuesta = new HdeskResponse();
            $respuesta->setCaIdticket($request->getParameter("idticket"));

            $idresponse = $request->getParameter("idresponse");

            if ($idresponse) {
                $respuesta->setCaResponseto($idresponse);
            }

            if ($idissue) {
                $issue = Doctrine::getTable("KBIssue")->find($idissue);
                $this->forward404Unless($issue);
                $respuesta->setCaIdissue($idissue);
                $url = "https://www.colsys.com.co/kbase/viewIssue/idissue/" . $idissue;
                $txt = "Adjunto encontrara una soluci&oacute;n al problema reportado.\n<br />";
                $txt .= "Tambien es posible verlo desde el siguiente vinculo: <br />";
                $txt .= "<b><a href='$url'>$url</a></b> <br /> <br />";


                $respuesta->setCaText(utf8_decode($txt));
            } else {
                $respuesta->setCaText(utf8_decode($request->getParameter("respuesta")));
            }
            //$respuesta->setCaLogin($user->getUserId());
            $respuesta->setCaLogin($user->getCaLogin());
            
            $respuesta->setCaCreatedat(date("Y-m-d H:i:s"));
            $respuesta->save($conn);
            
            /*
             * Finaliza la Tarea de entrega programada y la marca para IDG.
             */
            if($request->getParameter("stage_id")){
                $estimation = Doctrine::getTable("HdeskEstimations")->find($request->getParameter("stage_id")); 
                if(!$estimation->getCaIdresponse()){
                    $estimation->setCaIdresponse($respuesta->getCaIdresponse());                
                    $estimation->save($conn);
                }
                $tarea = $estimation->getTareaIdg();
                if ($tarea) {
                    if (!$tarea->getCaFchterminada()) {
                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                        //$tarea->setCaObservaciones(utf8_decode($request->getParameter("motivo")));
                        $tarea->setCaUsuterminada($user->getCaLogin());
                        $tarea->save($conn);
                    }
                }
                $ticket->getActualizarPorcentaje();
            }

            $logins = array($ticket->getCaLogin());
            $loginsDepartamento = array($ticket->getCaLogin());
            $usuarios = Doctrine::getTable("HdeskUserGroup")
                    ->createQuery("h")
                    ->select("h.ca_login")
                    ->innerJoin("h.Usuario u")
                    ->innerJoin("u.Departamento d")
                    ->addWhere("d.ca_iddepartamento = ? ", $user->getDepartamento()->getCaIddepartamento())
                    //->addWhere("h.ca_idgroup = ? ", $ticket->getCaIdgroup())  
                    ->addWhere("u.ca_activo = ? ", true)
                    ->addOrderBy("h.ca_login")
                    ->distinct()
                    ->execute();
            foreach ($usuarios as $usuario) {
                $loginsDepartamento[] = $usuario->getCaLogin();
            }

            if ($ticket->getCaAssignedto()) {
                $logins[] = $ticket->getCaAssignedto();
            } else {
                $usuarios = Doctrine::getTable("HdeskUserGroup")
                        ->createQuery("h")
                        ->innerJoin("h.Usuario u")
                        ->innerJoin("u.Departamento d")
                        //->addWhere("d.ca_iddepartamento = ? ", $this->getUser()->getIddepartamento())  
                        ->addWhere("h.ca_idgroup = ? ", $ticket->getCaIdgroup())
                        ->addWhere("u.ca_activo = ? ", true)
                        ->addOrderBy("h.ca_login")
                        ->execute();
                foreach ($usuarios as $usuario) {
                    $logins[] = $usuario->getCaLogin();
                }
            }

            $usuarios = $ticket->getUsuarios();
            foreach ($usuarios as $usuario) {
                $logins[] = $usuario->getCaLogin();
            }

            if ($ticket->getCaAssignedto() == $user->getCaLogin() || in_array($user->getCaLogin(), $logins) || in_array($user->getCaLogin(), $loginsDepartamento)) {
                $tarea = $ticket->getTareaIdg();
                if ($tarea) {
                    if (!$tarea->getCaFchterminada()) {
                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                        $tarea->setCaObservaciones(utf8_decode($request->getParameter("motivo")));
                        $tarea->setCaUsuterminada($user->getCaLogin());
                        $tarea->save($conn);
                    }
                }
            }

            /*
             * Termina seguimientos previos
             */
            if ($idresponse) {
                $res = Doctrine::getTable("HDeskResponse")->find($idresponse);
                if ($res->getCaIdtarea()) {
                    $tarea = $res->getNotTarea();
                    if ($tarea && !$tarea->getCaFchterminada()) {
                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                        $tarea->save($conn);
                    }
                }
            }

            /*
             * Crea un seguimiento
             */
            if ($request->getParameter("fchseguimiento")) {
                $titulo = "Seg. Ticket #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]";
                $texto = "<b>Seguimiento:</b> \n<br />";
                $texto .= $respuesta->getCaText();
                /*
                 * Se crea la tarea para los miembros del grupo.
                 */
                $tarea = new NotTarea();
                $tarea->setCaUrl("/pm/index?idticket=" . $ticket->getCaIdticket());
                $tarea->setCaIdlistatarea(5);
                $tarea->setCaFchcreado(date("Y-m-d H:i:s"));

                $tarea->setCaFchvisible($request->getParameter("fchseguimiento") . " 00:00:00");
                $tarea->setCaFchvencimiento($request->getParameter("fchseguimiento") . " 23:59:59");

                $tarea->setCaUsucreado($user->getCaLogin());
                $tarea->setCaTitulo($titulo);
                $tarea->setCaTexto($texto);
                $tarea->save($conn);

                $tarea->setAsignaciones(array($user->getCaLogin()));

                $respuesta->setCaIdtarea($tarea->getCaIdtarea());
                $respuesta->save($conn);
            }


            $email = new Email();
            $email->setCaUsuenvio($user->getCaLogin());
            $email->setCaTipo("Notificaci�n");
            $email->setCaIdcaso($ticket->getCaIdticket());
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");

            $departamento = $ticket->getHdeskGroup()->getDepartamento()->getCaNombre();
            $subject = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?" Hallazgo Auditor�a #":" Nueva respuesta Ticket #";
            $email->setCaSubject($departamento . $subject . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]");

            $request->setParameter("id", $ticket->getCaIdticket());
            $request->setParameter("format", "email");
            if ($idissue) {
                $texto = $txt;
                $texto .=sfContext::getInstance()->getController()->getPresentationFor('kbase', 'viewIssue');

                $texto = str_replace('src="/', 'src="https://www.colsys.com.co/', $texto);
                //$texto = str_replace('src="/', 'src="https://localhost/',  $texto);
            } else {
                $texto = sfContext::getInstance()->getController()->getPresentationFor('pm', 'verTicket');
            }

            $email->setCaBodyhtml($texto);

            if ($ticket->getHdeskGroup()->getCaIddepartament()==4 and $ticket->getCaAssignedto()) {
                // Si el ticket es puesto por Auditor�a, sobreescribe los destinatarios del mensaje
                // Si el ticket est� asignado a alg�naHdeskUserGroup persona en particular, no copia a los demas del departamento
                $logins = array($ticket->getCaLogin(), $user->getCaLogin(), $ticket->getCaAssignedto());
            }
            foreach ($logins as $login) {
                if ($user->getCaLogin() != $login) {
                    $usuario = Doctrine::getTable("Usuario")->find($login);
                    $email->addTo($usuario->getCaEmail());
                }
            }

            $email->save($conn);
            //$email->send();
            //$this->ticket = $ticket;


            /*
             * Cambia el status
             */
            if ($request->getParameter("status") !== null) {
                $ticket->setCaStatus(intval($request->getParameter("status")));
                $ticket->save($conn);
            }

            $conn->commit();
            $request->setParameter("format", "");
            $texto = sfContext::getInstance()->getController()->getPresentationFor('pm', 'verRespuestas');

            $this->responseArray = array("success" => true, "idticket" => $ticket->getCaIdticket(), "info" => utf8_encode($texto));
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            Utils::writeLog($logFile, date()."-".$msgerror);
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Respuestas de un ticket en formato HTML
     *
     * @param sfRequest $request A request object
     */
    public function executeVerRespuestas(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("idticket"));
        $ticket = Doctrine::getTable("HdeskTicket")->find($request->getParameter("idticket"));
        $this->forward404Unless($ticket);
        $this->ticket = $ticket;
        $this->childrens = $this->ticket->getChildren();

        $this->opener = $request->getParameter("opener");
        $this->format = $request->getParameter("format");
    }

    /**
     * Guarda los datos de un ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeFormTicketGuardar(sfWebRequest $request) {
        $txt = "";
        $update = false;
        $user = $this->getUser();

        $conn = Doctrine::getTable("HdeskTicket")->getConnection();
        $conn->beginTransaction();
        try {
            $changeDepto = false;
            if ($request->getParameter("idticket")) {
                $ticket = Doctrine::getTable("HdeskTicket")->find($request->getParameter("idticket"));
                $update = true;                
                if ($request->getParameter("area") != $ticket->getCaIdgroup()) { //Cuando cambia el area notifica.
                    $tarea = $ticket->getNotTarea();
                    /* if ($tarea) {
                      $tarea->delete(); //Antes se eliminaba, ahora no para que conserve los datos del IDG.
                      } */

                    //Crea un nuevo status para saber que se cambio de �rea
                    $area1 = Doctrine::getTable("HdeskGroup")->find($ticket->getCaIdgroup());
                    $area2 = Doctrine::getTable("HdeskGroup")->find($request->getParameter("area"));
                    $txt = "Se cambio de " . $area1->getCaName() . " a " . $area2->getCaName();
                    $respuesta = new HdeskResponse();
                    $respuesta->setCaIdticket($request->getParameter("idticket"));
                    $respuesta->setCaText($txt);
                    $respuesta->setCaLogin($user->getUserId());
                    $respuesta->setCaCreatedat(date("Y-m-d H:i:s"));
                    $respuesta->save($conn);
                    $changeDepto = true;
                    //$update = false;
                }
            } else {
                $ticket = new HdeskTicket();
                $ticket->setCaLogin($user->getUserId());
                $ticket->setCaOpened(date("Y-m-d H:i:s"));
            }

            $ticket->setCaIdgroup($request->getParameter("area"));
            if ($request->getParameter("project")) {
                $ticket->setCaIdproject($request->getParameter("project"));
            }

            $ticket->setCaTitle(($request->getParameter("title")));
            $ticket->setCaText(($request->getParameter("text")));

            if ($request->getParameter("actionTicket") == "Cerrado") {
                
                $entregas = $ticket->getHdeskEstimations('modo');
                
                if(count($entregas)>0){
                    $error["entregas"] = "El ticket ".$ticket->getCaIdticket()." tiene entregas pendientes por ejecutar";
                }else{
                    $ticket->setCaClosedat(date("Y-m-d H:i:s"));
                    $ticket->setCaClosedby($this->getUser()->getUserId());
                }
            } else {
                $ticket->setCaClosedat(null);
                $ticket->setCaClosedby(null);
            }

            if ($request->getParameter("type")) {
                $ticket->setCaType($request->getParameter("type"));
            }

            if ($request->getParameter("priority")) {
                $ticket->setCaPriority($request->getParameter("priority"));
            }

            if ($request->getParameter("assignedto")) {
                $ticket->setCaAssignedto($request->getParameter("assignedto"));
            }

            if ($request->getParameter("status") !== null) {
                $ticket->setCaStatus(intval($request->getParameter("status")));
            }

            if ($request->getParameter("reportedby")) {
                $ticket->setCaLogin($request->getParameter("reportedby"));
            }

            if ($request->getParameter("reportedthrough")) {
                $ticket->setCaReportedby($request->getParameter("reportedthrough"));
            }

            if ($request->getParameter("idactivo") !== null) {
                if ($request->getParameter("idactivo")) {
                    $ticket->setCaIdactivo($request->getParameter("idactivo"));
                } else {
                    $ticket->setCaIdactivo(null);
                }
            }

            $ticket->save($conn);
            
            if ($request->getParameter("actionTicket") == "Cerrado") {
                $ticket->cerrarSeguimientos($conn);

                if ($request->getParameter("type") != "Invalido") {
                    $ticket->crearEvaluacion($conn);
                }
            }
            
            if (isset($_FILES["archivo"]) and $_FILES["archivo"]["name"]) {

                $archivo = $_FILES["archivo"];
                $directorio = $ticket->getDirectorio();

                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }
                move_uploaded_file($archivo["tmp_name"], $directorio . DIRECTORY_SEPARATOR . $archivo["name"]);
            }

            if (!$update) {
                $request->setParameter("id", $ticket->getCaIdticket());
                $request->setParameter("format", "email");
                $grupo = $ticket->getHdeskGroup();
                
                $tipo = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?"Hallazgo":"Ticket";
                $titulo = $grupo->getDepartamento()->getCaNombre()." Nuevo $tipo #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]";

                $texto = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?"Se ha reportado un nuevo hallazgo \n\n<br /><br />":"Se ha creado un nuevo ticket \n\n<br /><br />";
                $texto.= sfContext::getInstance()->getController()->getPresentationFor('pm', 'verTicket');

                /*
                 * Se crea la tarea para los miembros del grupo.
                 */
                $tarea = $ticket->getTareaIdg();
                if (!$tarea || !$tarea->getCaIdtarea()) {
                    $lista = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?10:1;  // Lista para Tickets de Auditor�a o Lista General
                    $tarea = new NotTarea();
                    $tarea->setCaUrl("/pm/verTicket?id=" . $ticket->getCaIdticket());
                    $tarea->setCaIdlistatarea($lista);
                    $tarea->setCaFchcreado(date("Y-m-d H:i:s"));

                    $tarea->setTiempo(TimeUtils::getFestivos(), $grupo->getCaMaxresponsetime());

                    $tarea->setCaUsucreado($this->getUser()->getUserId());
                    $tarea->setCaTitulo($titulo);
                    $tarea->setCaTexto($texto);
                    $tarea->save($conn);
                }

                $ticket->setCaIdtarea($tarea->getCaIdtarea());
                $ticket->save($conn);
            } else {
                $tarea = $ticket->getNotTarea();
            }

            if ($tarea) {
                if ($ticket->getHdeskGroup()->getCaIddepartament()==4 and $ticket->getCaAssignedto()){
                    //Si es Auditor�a, crea la tarea solo la persona reportada.
                    $loginsAsignaciones = array($ticket->getCaLogin());
                    $tarea->setAsignaciones($loginsAsignaciones, $conn);
                }else{
                    //Verifica las asignaciones de la tarea.
                    $loginsAsignaciones = $ticket->getLoginsGroup();
                    $tarea->setAsignaciones($loginsAsignaciones, $conn);
                }
            }

            if (!$update && $request->getParameter("actionTicket") != "Cerrado") {
                $tarea->notificar($conn);
            }
            if ($changeDepto == true) {
                $email = new Email();
                $email->setCaUsuenvio($this->getUser()->getUserId());
                $email->setCaTipo("Notificaci�n");
                $email->setCaIdcaso($ticket->getCaIdticket());
                $email->setCaFrom("no-reply@coltrans.com.co");
                $email->setCaFromname("Colsys Notificaciones");
                $subject = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?"Hallazgo de Auditor�a":"Ticket";
                $email->setCaSubject($txt . " el $subject #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]");
                $texto = $txt . "";
                $request->setParameter("id", $ticket->getCaIdticket());
                $request->setParameter("format", "email");
                $texto.= sfContext::getInstance()->getController()->getPresentationFor('pm', 'verTicket');

                $email->setCaBodyhtml($texto);

                $usuarios = $ticket->getLoginsGroup();

                //echo count($usuarios);
                foreach ($usuarios as $usuario) {
                    if ($this->getUser()->getUserId() != $usuario) {
                        $usuariotmp = Doctrine::getTable("Usuario")->find($usuario);
                        $email->addTo($usuariotmp->getCaEmail());
                    }
                }
                $email->save();
            }
            if($error){
                $this->responseArray = array("success" => false, "idticket" => $ticket->getCaIdticket(), "errorInfo"=>$error["entregas"]);
            }else{
                $conn->commit();
                $this->responseArray = array("success" => true, "idticket" => $ticket->getCaIdticket(), "change"=>$changeDepto, "txt"=>utf8_encode($txt));
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
        $this->setLayout("none");
    }

    /**
     * Toma asignacion de un ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeTomarAsignacion(sfWebRequest $request) {
        if ($request->getParameter("idticket")) {
            $ticket = Doctrine::getTable("HdeskTicket")->find($request->getParameter("idticket"));
            $ticket->setCaAssignedto($this->getUser()->getUserId());
            $ticket->save();
            $tarea = $ticket->getNotTarea();
            if ($tarea) {
                $tarea->setAsignaciones(array($this->getUser()->getUserId()));
            }

            $this->responseArray = array("success" => true, "idticket" => $ticket->getCaIdticket(), "assignedto" => $this->getUser()->getUserId());
        } else {
            $this->responseArray = array("success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    /**
     * Toma asignacion de un ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeCerrarTicket(sfWebRequest $request) {
        try {
            if ($request->getParameter("idticket")) {
                
                $ticket = Doctrine::getTable("HdeskTicket")->find($request->getParameter("idticket"));
                
                $entregas = $ticket->getHdeskEstimations('modo');
                
                if(count($entregas)>0)
                   $this->responseArray = array("idticket" => $request->getParameter("idticket"), "success" => false); 
                else{
                    $ticket->setCaClosedat(date("Y-m-d H:i:s"));
                    $ticket->setCaClosedby($this->getUser()->getUserId());

                    $ticket->setCaPercentage(100);
                    $ticket->save();

                    //Solo por compatibilidad
                    $tarea = $ticket->getTareaSeguimiento();
                    if ($tarea) {
                        $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                        $tarea->setCaUsuterminada($this->getUser()->getUserId());
                        $tarea->save();
                    }

                    $ticket->cerrarSeguimientos();
                    $ticket->crearEvaluacion();
                    $this->responseArray = array("success" => true, "idticket" => $request->getParameter("idticket"));
                }
            }
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo");
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeNuevoSeguimiento(sfWebRequest $request) {
        $this->ticket = null;
        if ($request->getParameter("id")) {
            $this->ticket = Doctrine::getTable("HdeskTicket")->find($request->getParameter("id"));
        }

        $this->forward404Unless($this->ticket);

        $seguimiento = $request->getParameter("seguimiento");

        if ($seguimiento) {
            $titulo = "Seguimiento Ticket # " . $this->ticket->getCaIdticket() . " [" . $this->ticket->getCaTitle() . "]";

            $texto = "Usted ha programado un seguimiento para el ticket # " . $this->ticket->getCaIdticket() . " [" . $this->ticket->getCaTitle() . "]";
            $tarea = $this->ticket->getTareaSeguimiento();
            if (!$tarea) {
                $tarea = new NotTarea();
                $tarea->setCaUsucreado($this->getUser()->getUserId());
                $tarea->setCaFchcreado(date("Y-m-d H:i:s"));
            }
            $tarea->setCaUrl("/pm/verTicket?id=" . $this->ticket->getCaIdticket());
            $tarea->setCaIdlistatarea(5);


            $fchvisible = $request->getParameter("fchvisible");
            if ($fchvisible) {
                $fchvisible = Utils::parseDate($fchvisible);
                $tarea->setCaFchvisible($fchvisible . " 00:00:00");
            }

            $seguimiento = Utils::parseDate($seguimiento);
            $tarea->setCaFchvencimiento($seguimiento . " 23:59:59");

            $tarea->setCaTitulo($titulo);
            $tarea->setCaTexto($texto);
            $tarea->save();

            $tarea->setAsignaciones(array($this->getUser()->getUserId()));
            $this->ticket->setCaIdseguimiento($tarea->getCaIdtarea());
            $this->ticket->save();
            $this->redirect("pm/verTicket?id=" . $this->ticket->getCaIdticket());
        }
    }

    public function executeEliminarSeguimiento(sfWebRequest $request) {
        $this->ticket = null;
        if ($request->getParameter("id")) {
            $this->ticket = Doctrine::getTable("HdeskTicket")->find($request->getParameter("id"));
        }

        $this->forward404Unless($this->ticket);

        $tarea = $this->ticket->getTareaSeguimiento();
        if ($tarea) {
            $tarea->delete();
        }
        $this->redirect("pm/verTicket?id=" . $this->ticket->getCaIdticket());
    }

    /**
     * Datos de las areas de acuerdo al departamento
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosAreas(sfWebRequest $request) {
        $departamento = $request->getParameter("departamento");
        $gruposArray = array();

        if ($departamento) {
            $q = Doctrine::getTable("HdeskGroup")
                    ->createQuery("g")
                    ->where("g.ca_iddepartament = ?", $departamento)
                    ->addWhere("g.ca_activo = ?", TRUE)                    
                    ->addOrderBy("g.ca_name");
                    
            if($departamento!=$this->getUser()->getIddepartamento())
                $q->addWhere("g.ca_interno = ?",FALSE);
            
            $grupos = $q->execute();

            foreach ($grupos as $grupo) {
                $gruposArray[] = array("idgrupo" => $grupo->getCaIdgroup(), "nombre" => utf8_encode($grupo->getCaName()));
            }
        }

        $this->responseArray = array("grupos" => $gruposArray, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de las areas de acuerdo al grupos
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosProyectos(sfWebRequest $request) {
        $idgrupo = $request->getParameter("idgrupo");
        $proyectosArray = array();

        if ($idgrupo) {
            $proyectos = Doctrine::getTable("HdeskProject")
                    ->createQuery("p")
                    ->where("p.ca_idgroup = ? and p.ca_active=true", $idgrupo)
                    ->addOrderBy("p.ca_name")
                    ->execute();

            foreach ($proyectos as $proyecto) {
                $proyectosArray[] = array("idproyecto" => $proyecto->getCaIdproject(), "nombre" => utf8_encode($proyecto->getCaName()));
            }
        }

        $this->responseArray = array("proyectos" => $proyectosArray, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos del ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosMilestones(sfWebRequest $request) {
        $nivel = $this->getNivel();

        $this->forward404Unless($request->getParameter("idproject"));

        $project = Doctrine::getTable("HdeskProject")->find($request->getParameter("idproject"));

        $this->forward404Unless($project);

        $q = Doctrine_Query::create()
                ->select("h.ca_idmilestone, h.ca_title")
                ->from('HdeskMilestone h')
                ->addWhere("h.ca_idproject = ?", $request->getParameter("idproject"))
                ->addOrderBy("h.ca_due ASC")
                ->addOrderBy("h.ca_title ASC");




        //$q->distinct();
        //exit($q->getSql());
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(120);
        $milestones = $q->execute();
        $i = 0;
        foreach ($milestones as $key => $val) {
            $milestones[$key]["h_ca_title"] = utf8_encode($milestones[$key]["h_ca_title"]);
        }


        $this->responseArray = array("success" => true, "root" => $milestones);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de los usuarios de acuerdo al grupos
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosAsignaciones(sfWebRequest $request) {
        $idgrupo = $request->getParameter("idgrupo");
        $usuariosArray = array();

        if ($idgrupo) {
            $usuarios = Doctrine::getTable("HdeskUserGroup")
                    ->createQuery("g")
                    ->where("g.ca_idgroup = ?", $idgrupo)
                    ->addOrderBy("g.ca_login")
                    ->execute();
            foreach ($usuarios as $usuario) {
                $usuariosArray[] = array("login" => $usuario->getCaLogin());
            }
        }

        $this->responseArray = array("usuarios" => $usuariosArray, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de los usuarios de acuerdo al grupos
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosUsuarios(sfWebRequest $request) {

        $usuariosArray = array();
        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("g")
                ->where("g.ca_activo = ?", true)
                ->addOrderBy("g.ca_login")
                ->execute();
        foreach ($usuarios as $usuario) {
            $usuariosArray[] = array("login" => $usuario->getCaLogin(), "nombre" => utf8_encode($usuario->getCaNombre()));
        }


        $this->responseArray = array("usuarios" => $usuariosArray, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de las areas de acuerdo al departamento
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosClasificacion(sfWebRequest $request) {
        $departamento = $request->getParameter("departamento");
        $data = array();

        if ($departamento) {
            $clasificaciones = Doctrine::getTable("HdeskDepartamentClasification")
                    ->createQuery("c")
                    ->where("c.ca_iddepartament = ?", $departamento)
                    ->addOrderBy("c.ca_order")
                    ->execute();

            foreach ($clasificaciones as $clasificacion) {
                $data[] = array("iddepartamento" => $departamento, "clasification" => utf8_encode($clasificacion->getCaClasification()));
            }
        }

        $this->responseArray = array("root" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeAgregarUsuario(sfWebRequest $request) {
        $this->nivel = $this->getNivel();
        $this->iddepartamento = $this->getUser()->getIddepartamento();

        $this->nivel = $this->getNivel();

        $idticket = $request->getParameter("idticket");
        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);
        $this->forward404Unless($this->ticket);

        $bindValues = array();
        $bindValues["ca_login"] = $request->getParameter("login");
        $bindValues["ca_idticket"] = $request->getParameter("idticket");

        $usuarioTicket = Doctrine::getTable("HdeskTicketUser")->find(array($this->ticket->getCaIdticket(), $bindValues["ca_login"]));
        if (!$usuarioTicket) {
            $usuarioTicket = new HdeskTicketUser();
            $usuarioTicket->setCaLogin($bindValues["ca_login"]);
            $usuarioTicket->setCaIdticket($this->ticket->getCaIdticket());
            $usuarioTicket->save();

            $email = new Email();
            $email->setCaUsuenvio($this->getUser()->getUserId());
            $email->setCaTipo("Notificaci�n");
            $email->setCaIdcaso($this->ticket->getCaIdticket());
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");

            $subject = ($this->ticket->getHdeskGroup()->getCaIddepartament()==4)?"Hallazgo de Auditor�a":"Ticket";
            $email->setCaSubject("Ha sido involucrado en el $subject #" . $this->ticket->getCaIdticket() . " [" . $this->ticket->getCaTitle() . "]");

            $texto = "Ha sido involucrado en el Ticket \n\n<br /><br />";
            $request->setParameter("id", $this->ticket->getCaIdticket());
            $request->setParameter("format", "email");
            $texto.= sfContext::getInstance()->getController()->getPresentationFor('pm', 'verTicket');

            $email->setCaBodyhtml($texto);
            $usuario = Doctrine::getTable("Usuario")->find($bindValues["ca_login"]);
            $email->addTo($usuario->getCaEmail());
            $email->save();
        }


        $this->responseArray = array("success" => true, "idticket" => $this->ticket->getCaIdticket());
        $this->setTemplate("responseTemplate");
    }

    /**
     * Agrega un usuario a un ticket para copiarle las comunicaciones o escritbir respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarUsuario(sfWebRequest $request) {

        $this->nivel = $this->getNivel();

        if (!$this->nivel) {
            $this->nivel = 0;
        }
        $idticket = $request->getParameter("idticket");
        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);


        $usuario = Doctrine::getTable("HdeskTicketUser")->createQuery("ug")
                ->where("ug.ca_idticket = ?", $this->ticket->getCaIdticket())
                ->addWhere("ug.ca_login = ?", $request->getParameter("login"))
                ->fetchOne();
        if ($usuario) {
            $usuario->delete();
            $this->responseArray = array("success" => true, "idticket" => $this->ticket->getCaIdticket(), "id" => $request->getParameter("id"));
        } else {
            $this->responseArray = array("success" => false);
        }


        $this->setTemplate("responseTemplate");
    }

    /**
     * Retorna todas las tareas en formato json
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelTareas(sfWebRequest $request) {

        $this->nivel = $this->getNivel();

        $idticket = $request->getParameter("idticket");
        $this->forward404Unless($idticket);
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        $this->forward404Unless($ticket);



        $tareas = Doctrine::getTable("HdeskTask")
                ->createQuery("t")
                ->where("t.ca_idticket = ?", $ticket->getCaIdticket())
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();

        foreach ($tareas as $key => $val) {
            $tareas[$key]["t_ca_task"] = utf8_encode($tareas[$key]["t_ca_task"]);
        }

        $tareas[] = array("t_ca_task" => "", "orden" => "Z");

        $this->responseArray = array("success" => true, "root" => $tareas);

        $this->setTemplate("responseTemplate");
    }

    /**
     * guarda una tarea del panel de tareas
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarPanelTareas(sfWebRequest $request) {
        $idtask = $request->getParameter("idtask");
        if ($idtask) {
            $task = Doctrine::getTable("HdeskTask")->find($idtask);
        } else {
            $task = new HdeskTask();
            $task->setCaIdticket($request->getParameter("idticket"));
        }
        $task->setCaTask($request->getParameter("task"));
        $task->save();
        $this->responseArray = array("success" => true, "id" => $request->getParameter("id"), "idtask" => $task->getCaIdtask());

        $this->setTemplate("responseTemplate");
    }

    /**
     * Pagina de administraci�n de proyectos
     *
     * @param sfRequest $request A request object
     */
    public function executeListaProyectos(sfWebRequest $request) {
        $this->projects = Doctrine::getTable("HdeskProject")
                ->createQuery("p")
                ->select("p.ca_idproject, p.ca_name, (SELECT COUNT(*) FROM HdeskTicket ta WHERE ta.ca_idproject = p.ca_idproject AND ta.ca_action ='Abierto') as ta, (SELECT COUNT(*) FROM HdeskTicket tc WHERE tc.ca_idproject = p.ca_idproject AND tc.ca_action ='Cerrado') as tc")
                ->addOrderBy("p.ca_name")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
    }

    /**
     * Detalles del proyecto
     *
     * @param sfRequest $request A request object
     */
    public function executeDetalleProyecto(sfWebRequest $request) {
        $this->forward404Unless($request->getParameter("id"));
        $this->project = Doctrine::getTable("HdeskProject")->find($request->getParameter("id"));
        $this->forward404Unless($this->project);
    }

    /**
     * Datos para la bbarra de progreso del panel
     *
     * @param sfRequest $request A request object
     */
    public function executeEstadoPanelProyectos(sfWebRequest $request) {
        $this->responseArray = array("success" => true);

        $this->forward404Unless($request->getParameter("idproject"));

        $numtickets = Doctrine::getTable("HdeskProject")
                ->createQuery("p")
                ->select("p.*, (SELECT COUNT(*) FROM HdeskTicket ta WHERE ta.ca_idproject = p.ca_idproject AND ta.ca_action ='Abierto') as ta, (SELECT COUNT(*) FROM HdeskTicket tc WHERE tc.ca_idproject = p.ca_idproject AND tc.ca_action ='Cerrado') as tc")
                ->where("p.ca_idproject = ? ", $request->getParameter("idproject"))
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->fetchOne();


        if ($numtickets["p_tc"] + $numtickets["p_ta"] > 0) {
            $porcentaje = $numtickets["p_tc"] / ($numtickets["p_tc"] + $numtickets["p_ta"]);
        } else {
            $porcentaje = 0;
        }
        $this->responseArray["progress"] = $porcentaje;
        $this->responseArray["text"] = $numtickets["p_ta"] . " tickets abiertos/ " . $numtickets["p_tc"] . " tickets cerrados " . (round($porcentaje * 100, 1)) . "% Terminado";
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos del ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelMilestones(sfWebRequest $request) {
        $nivel = $this->getNivel();

        $this->forward404Unless($request->getParameter("idproject"));

        $project = Doctrine::getTable("HdeskProject")->find($request->getParameter("idproject"));

        $this->forward404Unless($project);

        $q = Doctrine_Query::create()
                ->select("h.*")
                ->from('HdeskMilestone h')
                ->addWhere("h.ca_idproject = ?", $request->getParameter("idproject"))
                ->addOrderBy("h.ca_due ASC")
                ->addOrderBy("h.ca_title ASC");




        $q->distinct();
        //exit($q->getSql());
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $q->limit(120);
        $milestones = $q->execute();
        $i = 0;
        foreach ($milestones as $key => $val) {
            $milestones[$key]["h_ca_title"] = utf8_encode($milestones[$key]["h_ca_title"]);
            $milestones[$key]["h_ca_text"] = utf8_encode($milestones[$key]["h_ca_text"]);
            $milestones[$key]["orden"] = $i++;
        }

        if ($project->getCaManager() == $this->getUser()->getUserId()) {
            $milestones[] = array("h_ca_title" => "", "orden" => "Z");
        }


        $this->responseArray = array("success" => true, "root" => $milestones);



        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos del ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarPanelMilestones(sfWebRequest $request) {
        $this->responseArray = array("success" => true, "id" => $request->getParameter("id"));

        if ($request->getParameter("idmilestone")) {
            $milestone = Doctrine::getTable("HdeskMilestone")->find($request->getParameter("idmilestone"));
            $this->forward404Unless($milestone);
        } else {
            $milestone = new HdeskMilestone();
            $milestone->setCaIdproject($request->getParameter("idproject"));
        }

        if ($request->getParameter("title")) {
            $milestone->setCaTitle($request->getParameter("title"));
        }

        if ($request->getParameter("text")) {
            $milestone->setCaText($request->getParameter("text"));
        }

        if ($request->getParameter("due")) {
            $milestone->setCaDue(substr($request->getParameter("due"), 0, 10));
        }

        if ($request->getParameter("end")) {
            $milestone->setCaEnd(substr($request->getParameter("end"), 0, 10));
        }

        $milestone->save();

        $this->responseArray["idmilestone"] = $milestone->getCaIdmilestone();

        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos del ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeEliminarPanelMilestones(sfWebRequest $request) {
        $this->responseArray = array("success" => false, "id" => $request->getParameter("id"));


        $this->forward404Unless($request->getParameter("idmilestone"));

        $milestone = Doctrine::getTable("HdeskMilestone")->find($request->getParameter("idmilestone"));

        if ($milestone) {
            $milestone->delete();
            $this->responseArray["success"] = true;
        }

        $this->setTemplate("responseTemplate");
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executeDatosPanelConsulta() {
        $this->user = $this->getUser();

        $usuario = Doctrine::getTable("Usuario")->find($this->user);
        $depAdic = $usuario->getProperty("helpDesk");

        $q = Doctrine::getTable("Departamento")
                ->createQuery("d")
                ->innerJoin("d.Usuario u")
                ->where("d.ca_inhelpdesk = ?", true)
                ->addWhere("u.ca_login = ?", $this->user)
                //->orWhere("d.ca_nombre = ?", $depAdic)
                ->addOrderBy("d.ca_nombre ASC");
        
        if($depAdic){
            if(strpos($depAdic,"|"))
                $q->orWhereIn("d.ca_nombre", explode("|",$depAdic));
            else
                $q->orWhere("d.ca_nombre = ?", $depAdic);            
        }
        
        $this->departamentos = $q->execute();
    }

    /*
     * Asigna un milestone a un ticket
     * @author: Andres Botero
     */

    public function executeAsignarMilestone($request) {

        $this->forward404Unless($request->getParameter("idmilestone"));
        $this->forward404Unless($request->getParameter("idticket"));

        $idmilestone = $request->getParameter("idmilestone");
        $idticket = $request->getParameter("idticket");

        $milestone = Doctrine::getTable("HdeskMilestone")->find($idmilestone);
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);

        $this->forward404Unless($milestone);
        $this->forward404Unless($ticket);

        $ticket->setCaIdmilestone($milestone->getCaIdmilestone());
        $ticket->save();


        $this->responseArray = array("success" => true,
            "id" => $request->getParameter("id"),
            "idmilestone" => $milestone->getCaIdmilestone(),
            "milestone" => $milestone->getCaTitle() . " " . Utils::fechaMes($milestone->getCaDue()),
            "due" => $milestone->getCaDue(),
            "due_timestamp" => strtotime($milestone->getCaDue())
        );
        $this->setTemplate("responseTemplate");
    }

    /*
     * Asigna un milestone a un ticket
     * @author: Andres Botero
     */

    public function executeActualizarPorcentajeTicket($request) {

        $this->forward404Unless($request->getParameter("idticket"));
        $this->forward404Unless($request->getParameter("percentage") !== null);
        $idticket = $request->getParameter("idticket");

        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        $this->forward404Unless($ticket);

        $ticket->setCaPercentage($request->getParameter("percentage"));
        $ticket->save();

        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executeDatosTicket($request) {

        $this->nivel = $this->getNivel();
        
        $this->forward404Unless($request->getParameter("idticket"));
        $idticket = $request->getParameter("idticket");
        $ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);

        if($ticket){

            $data = array();    
            $group = $ticket->getHdeskGroup();

            $data["iddepartament"] = $group->getCaIddepartament();
            $data["departamento"] = utf8_encode($group->getDepartamento()->getCaNombre());
            $data["idticket"] = $ticket->getCaIdticket();
            $data["title"] = utf8_encode($ticket->getCaTitle());
            $data["text"] = utf8_encode($ticket->getCaText());
            $data["idgroup"] = $ticket->getCaIdgroup();
            $data["group"] = utf8_encode($group->getCaName());
            $data["idproject"] = $ticket->getCaIdproject();
            $data["project"] = utf8_encode($ticket->getHdeskProject()->getCaName());
            $data["loginName"] = utf8_encode($ticket->getReportedBy()->getCaNombre());
            $data["login"] = $ticket->getCaLogin();
            $data["priority"] = $ticket->getCaPriority();
            $data["opened"] = $ticket->getCaOpened();
            $data["type"] = utf8_encode($ticket->getCaType());
            $data["assignedto"] = $ticket->getCaAssignedto();
            $data["action"] = $ticket->getCaAction();
            $data["status"] = $ticket->getCaStatus();
            $data["idactivo"] = $ticket->getCaIdactivo();
            $data["idempresa"] = $ticket->getCaIdempresa();
            $data["activo"] = $ticket->getInvActivo()->getCaIdentificador();
            //$data["estimated"] = $ticket->getCaEstimated();
            $data["parent"] = $ticket->getCaParent();

            $parametros = ParametroTable::retrieveByCaso("CU110");

            $status = array();
            foreach ($parametros as $p) {
                $status[$p->getCaIdentificacion()] = array("nombre" => $p->getCaValor(), "color" => $p->getCaValor2());
            }
            $data["status_name"] = isset($status[$ticket->getCaStatus()]) ? utf8_encode($status[$ticket->getCaStatus()]["nombre"]) : "";


            $data["percentage"] = $ticket->getCaPercentage();
            $data["folder"] = base64_encode($ticket->getDirectorioBase());
            $data["contact"] = utf8_encode($ticket->getUsuario() ? $ticket->getUsuario()->getSucursal()->getCaNombre() . " " . $ticket->getUsuario()->getCaExtension() : "");

            $tarea = $ticket->getNotTarea();
            if ($tarea) {
                $data["respuesta"] = $tarea->getCaFchterminada();
                $data["vencimiento"] = $tarea->getCaFchvencimiento();
            }

            $nivel = $this->getNivel();

            $data["readOnly"] = $ticket->getReadonly($nivel);
            ;

            $this->responseArray = array("success" => true, "data" => $data);
            
        } else
            $this->responseArray = array("success" => false, "nivel" =>$this->getNivel(), "login"=>$this->getUser()->getUserid());
        
        $this->setTemplate("responseTemplate");
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executeDatosUsuarioTicket($request) {

        $this->forward404Unless($request->getParameter("idticket"));
        $idticket = $request->getParameter("idticket");


        $usuarios = Doctrine::getTable("Usuario")->createQuery("u")
                ->innerJoin("u.HdeskTicketUser ug")
                ->where("ug.ca_idticket = ?", $idticket)
                ->addWhere("u.ca_activo = ?", true)
                ->addOrderBy("u.ca_nombre")
                ->execute();

        $data = array();

        foreach ($usuarios as $usuario) {
            $row = array();
            $row["login"] = $usuario->getCaLogin();
            $row["name"] = utf8_encode($usuario->getCaNombre());
            $row["icon"] = $usuario->getImagenUrl("60x80");
            $data[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Panel que muestra una grilla con los documentos afectados con un Ticket de Auditor�a
     * @author: Carlos G. L�pez M.
     */

    public function executeDatosDocumentosTicket($request) {

        $this->forward404Unless($request->getParameter("idticket"));
        $idticket = $request->getParameter("idticket");
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        $this->forward404Unless($ticket);

        $documentos = $ticket->getHdeskAuditDocuments();

        $data = array();

        foreach ($documentos as $documento) {
            $row = array();
            $row["idticket"] = $idticket;
            $row["idauditdocs"] = $documento->getCaIdauditdocs();
            $row["tipo_documento"] = utf8_encode($documento->getCaTipoDoc());
            $row["documento"] = $documento->getCaNumeroDoc();
            $row["recuperacion"] = $documento->getCaRecuperacion();
            $row["perdida"] = $documento->getCaPerdida();
            $row["observaciones"] = utf8_encode($documento->getCaObservaciones());
            $data[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Guarda los cambios en los documentos del ticket de Auditor�a
     */

    public function executeObserveDocuments() {
        $idticket = $this->getRequestParameter('idticket');
        if (!$this->getRequestParameter('idauditdocs')) {
            $auditDocuments = new HdeskAuditDocuments();
            $auditDocuments->setCaIdticket($idticket);
        } else {
            $auditDocuments = Doctrine::getTable("HdeskAuditDocuments")->find($this->getRequestParameter('idauditdocs'));
        }

        $this->responseArray = array("id" => $this->getRequestParameter('id'), "success" => false);

        if ($this->getRequestParameter('tipo_documento') !== null) {
            $auditDocuments->setCaTipoDoc(utf8_decode($this->getRequestParameter('tipo_documento')));
        }

        if ($this->getRequestParameter('documento') !== null) {
            $auditDocuments->setCaNumeroDoc($this->getRequestParameter('documento'));
        }

        if ($this->getRequestParameter('recuperacion') !== null) {
            $auditDocuments->setCaRecuperacion($this->getRequestParameter('recuperacion'));
        }

        if ($this->getRequestParameter('perdida') !== null) {
            $auditDocuments->setCaPerdida($this->getRequestParameter('perdida'));
        }

        if ($this->getRequestParameter('observaciones') !== null) {
            $auditDocuments->setCaObservaciones(utf8_decode($this->getRequestParameter('observaciones')));
        }

        $auditDocuments->save();

        $this->responseArray["success"] = true;
        $this->setTemplate("responseTemplate");
    }

    public function executeProcesarArchivoDocs(sfWebRequest $request) {
        $idticket = $this->getRequestParameter('idticket');
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);

        $folder = "tmp";
        $file = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $request->getParameter("archivo");

        $handle = fopen($file, "r");
        $input = fread($handle, filesize($file));
        $input = str_replace(chr(13), "", str_replace(chr(34), "", $input));

        $records = explode(chr(10), $input); // Divide el archivo por los Saltos de L�nea

        foreach ($records as $record) {       // Hace una primera lectura para verificar la estructura del archivo
            if (stristr($record, 'Documento/Referencia') === FALSE and strlen(trim($record)) != 0) {

                $fields = explode(chr($this->getRequestParameter('separador')), $record); // Divide el archivo en campos por el separador

                if (count($fields) != 5) {
                    $resultado = "�El archivo tiene errores en su estructura, por tanto no se puede importar! ";
                    $this->responseArray = array("success" => false, "resultado" => $resultado);
                    $this->setTemplate("responseTemplate");
                }
            } else if (stristr($record, 'ca_iddoc') !== FALSE) {

                $nameFields = explode(chr($this->getRequestParameter('separador')), $record); // Toma los nombres de los campos
            }
        }

        //Elimina los documentos anteriores
        $auditDocuments = $ticket->getHdeskAuditDocuments();
        foreach ($auditDocuments as $auditDocument) {
            $auditDocument->delete();
        }

        $documentos = array();
        $records = explode(chr(10), $input); // Divide el archivo por los Saltos de L�nea
        foreach ($records as $record) {
            if (stristr($record, 'Documento/Referencia') === FALSE and strlen(trim($record)) != 0) {

                $fields = explode(",", $record); // Divide el archivo en campos por el separador

                $auditDocuments = new HdeskAuditDocuments();
                $auditDocuments->setCaIdticket($idticket);
                $auditDocuments->setCaTipoDoc($fields[0]);
                $auditDocuments->setCaNumeroDoc($fields[1]);
                $auditDocuments->setCaRecuperacion($fields[2]);
                $auditDocuments->setCaPerdida($fields[3]);
                $auditDocuments->setCaObservaciones($fields[4]);
                $auditDocuments->save();

                $row = array();
                $row["idticket"] = $idticket;
                $row["idauditdocs"] = $auditDocuments->getCaIdauditdocs();
                $row["tipo_documento"] = utf8_encode($auditDocuments->getCaTipoDoc());
                $row["documento"] = $auditDocuments->getCaNumeroDoc();
                $row["recuperacion"] = $auditDocuments->getCaRecuperacion();
                $row["perdida"] = $auditDocuments->getCaPerdida();
                $row["observaciones"] = utf8_encode($auditDocuments->getCaObservaciones());
                $documentos[] = $row;
            }
        }
        unlink($file);
        $this->responseArray = array("success" => true, "documentos" => $documentos, "resultado" => $resultado);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executeCalendar($request) {
        
    }

    /*
     * Panel que muestra un arbol con opciones de busqueda
     * @author: Andres Botero
     */

    public function executeDatosPanelCalendar($request) {


        $q = Doctrine::getTable("HdeskMilestone")
                ->createQuery("m");

        $milestones = $q->execute();

        $data = array();
        foreach ($milestones as $milestone) {
            $row = array();
            $row["idmilestone"] = $milestone->getCaIdmilestone();
            $row["title"] = $milestone->getCaTitle();
            $data[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    /*
     *
     *
     * @author: Andres Botero
     */

    public function executeDatosPanelBusquedaTicket($request) {
        $data = array();

        $nivel = $this->getUser()->getNivelAcceso(self::RUTINA);

        try {
            $option = $request->getParameter("option");
            $query = $request->getParameter("query");
            Doctrine::getTable("HdeskGroup")
                    ->setAttribute(Doctrine_Core::ATTR_QUERY_LIMIT, Doctrine_Core::LIMIT_ROWS);

            $q = Doctrine_Query::create()
                    ->select("r.ca_text, t.ca_text, t.ca_idticket, t.ca_title, r.ca_createdat, r.ca_login, g.ca_name, d.ca_nombre")
                    ->from("HdeskGroup g")
                    ->leftJoin("g.Departamento d")
                    ->leftJoin("g.HdeskTicket t")
                    ->leftJoin("t.HdeskResponse r")                    
                    //->limit(100)
                    ->distinct()
                    ->orderBy("r.ca_createdat DESC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

            switch ($option) {
                case "idticket":
                    $q->addWhere("t.ca_idticket = ?", intval($query));
                    break;
                case "texto":
                    $q->addWhere("(LOWER(t.ca_title) LIKE ? OR LOWER(t.ca_text) LIKE ? OR LOWER(r.ca_text) LIKE ?)", array("%" . strtolower($query) . "%", "%" . strtolower($query) . "%", "%" . strtolower($query) . "%"));
                    break;
                case "documento":
                    $q->leftJoin("t.HdeskAuditDocuments ad");
                    $q->addWhere("(LOWER(ad.ca_numero_doc) LIKE ? OR LOWER(ad.ca_observaciones) LIKE ?)", array("%" . strtolower($query) . "%", "%" . strtolower($query) . "%"));
                    break;
                case "index":
                    if (substr($query, 0, 1) == "=") {
                        $newQuery = substr($query, 1);
                    } else {
                        $queryarray = explode(' ', $query);

                        foreach ($queryarray as $key => $value) {
                            if (strlen($queryarray[$key]) >= 3) {

                                $queryarray[$key].='*';
                            }
                        }
                        $newQuery = implode(' and ', $queryarray);
                    }
                    $pks = Doctrine::getTable("HdeskTicket")->getPksForLuceneQuery($newQuery);

                    $pksResponses = Doctrine::getTable("HdeskResponse")->getPksForLuceneQuery($newQuery);

                    if (!empty($pks) && !empty($pksResponses)) {
                        //$q->addWhere('(t.ca_idticket IN ? OR r.ca_idresponse IN ?)', array($pks, $pksResponses));

                        $q->orWhereIn('r.ca_idresponse', $pksResponses);
                        $q->orwhereIn('t.ca_idticket', $pks);
                    } elseif (!empty($pks)) {
                        $q->whereIn('t.ca_idticket', $pks);
                    } elseif (!empty($pksResponses)) {
                        $q->whereIn('r.ca_idresponse', $pksResponses);
                    } else {
                        $q->where('t.ca_idticket', -1);
                    }
                    $q->limit(500);

                    break;
                case "reportedBy":
                    $q->innerJoin("t.Usuario u");
                    $q->addWhere("(LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_login) LIKE ?)", array("%" . strtolower($query) . "%", "%" . strtolower($query) . "%"));
                    break;
                default:
                    //$q->addWhere("g.ca_iddepartament = 13"); //Eventos de sistemas
                    $q->limit(200);
                    break;
            }


            /*
             * Aplica restricciones de acuerdo al nivel de acceso.
             */
             switch ($nivel) {
            case 0:
                    $q->leftJoin("t.HdeskTicketUser hu  ");
                $q->addWhere("(t.ca_login = ? or hu.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid()));
                break;
            case 1:
                $q->leftJoin("g.HdeskUserGroup uggg ");
                $q->leftJoin("t.HdeskTicketUser hu  ");
                $q->addWhere("(t.ca_login = ? OR uggg.ca_login = ? OR hu.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid(), $this->getUser()->getUserid()));
                break;
            case 2:
                $q->leftJoin("t.HdeskTicketUser hu  ");
                $q->addWhere("(t.ca_login = ? OR g.ca_iddepartament = ? OR hu.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento(), $this->getUser()->getUserid()));
                break;
        }


            $q->addOrderBy("t.ca_idticket DESC");

            $results = $q->execute();


            $lastDate = null;
            $lastIdticket = false;
            foreach ($results as $result) {

                $row = array();
                $row["idticket"] = $result["t_ca_idticket"];
                $row["text"] = utf8_encode($result["r_ca_text"]);


                if ($option == "texto" && (strpos(strtolower($result["r_ca_text"]), strtolower($query)) === false && (strpos(strtolower($result["t_ca_title"]), strtolower($query)) === false && strpos(strtolower($result["t_ca_text"]), strtolower($query)) === false) )) {
                    continue;
                }

                if ($option == "texto" && $lastIdticket == $result["t_ca_idticket"] && (strpos(strtolower($result["t_ca_title"]), strtolower($query)) !== false || strpos(strtolower($result["t_ca_text"]), strtolower($query)) !== false)) {
                    continue;
                } else {
                    if ($query) {
                        if (strpos(strtolower($result["t_ca_title"]), strtolower($query)) !== false) {
                            $row["text"] = utf8_encode($result["t_ca_title"]);
                        }

                        if (strpos(strtolower($result["t_ca_text"]), strtolower($query)) !== false) {
                            $row["text"] = utf8_encode($result["t_ca_text"]);
                        }
                    }
                }

                $row["title"] = utf8_encode($result["t_ca_title"]);

                if ($query && ($option == "texto" || $option == "index")) { //Resalta la busqueda
                    if (strpos(strtolower($row["text"]), strtolower($query)) !== false) {
                        $origText = substr($row["text"], stripos($row["text"], $query), strlen($query));
                        $row["text"] = str_ireplace($origText, "<span style='background-color: #88AAEE'>" . $origText . "</span>", $row["text"]);
                    }
                    if (strpos(strtolower($row["title"]), strtolower($query)) !== false) {
                        $origText = substr($row["title"], stripos($row["title"], $query), strlen($query));
                        $row["title"] = str_ireplace($origText, "<span style='background-color: #88AAEE'>" . $origText . "</span>", $row["title"]);
                    }
                }


                $row["idticket"] = $result["t_ca_idticket"];
                $row["fchevento"] = $result["r_ca_createdat"];

                $row["login"] = $result["r_ca_login"];
                $row["group"] = utf8_encode($result["g_ca_name"]);
                $row["department"] = utf8_encode($result["d_ca_nombre"]);

                $data[] = $row;

                $lastDate = $result["r_ca_createdat"];
                $lastIdticket = $row["idticket"];
            }

            //Muestra eventos abrio y cerro ticket
            if (!$query) {

                $q = Doctrine::getTable("HdeskTicket")
                        ->createQuery("t")
                        ->innerJoin("t.HdeskGroup g")
                        ->select("t.ca_idticket, t.ca_title, t.ca_opened, t.ca_login, g.ca_name")
                        ->orderBy("t.ca_opened DESC")
                        ->addWhere("g.ca_iddepartament = 13")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR);

                if ($lastDate) {
                    $time = strtotime($lastDate);
                    $lastDate = date("Y-m-d H:i:s", $time - 86400);
                    $q->addWhere("t.ca_opened>=?", $lastDate);
                }

                $results = $q->execute();

                foreach ($results as $result) {
                    $row = array();
                    $row["idticket"] = $result["t_ca_idticket"];
                    $row["text"] = utf8_encode("Se abri� el ticket");
                    $row["fchevento"] = $result["t_ca_opened"];
                    $row["title"] = utf8_encode($result["t_ca_title"]);
                    $row["login"] = $result["t_ca_login"];
                    $row["group"] = utf8_encode($result["g_ca_name"]);
                    $row["color"] = "yellow";
                    $data[] = $row;
                }
            }
            $this->responseArray = array("success" => true, "root" => $data);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    
    
    public function executeResponseTickets(sfWebRequest $request) {
        //$folder1=$request->getParameter("folder");
        $folder1="COLSYS";
        //$folder1="MAURICIO";
        $debug=$request->getParameter("debug");
        $msgerror="";
        //exit;
        //try
        {
            ProjectConfiguration::registerZend();
            Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
            Zend_Loader::loadClass('Zend_Gdata_Gapps');
            $pass = 'cglti$col91';
            $mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
            $mail->selectFolder($folder1);
            //$logFile = sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR . "tickets_error.log";
            $logFile = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR."colsyslog".DIRECTORY_SEPARATOR. "tickets_error.log";
            echo "Numero de Emails:".count($mail);            
            
            foreach ($mail as $messageNum => $message) {
                //if ($message->hasFlag(Zend_Mail_Storage::FLAG_SEEN)) {
                    //continue;
                //}
                
                //getEncoding
              
                try {
                    
                
                    $from = $message->from;
                    $part = $message;


                    $sender = trim(utf8_encode($message->from));
                    preg_match('/<(.*?)>/s', $sender, $matches);
                    $from =$matches[1];
    //                echo $sender_mail;

                    $ticket_regex = "/#[0-9]+/";

                    preg_match_all($ticket_regex, $message->subject, $matches_ticket);
                    $idticket=  str_replace("#","",$matches_ticket[0][0]);                

                    $part = $message->getPart(1);
                    //echo $part->contentType;
                    if (strtok($part->contentType, ';') == 'text/plain')
                    {
                        
                        $mess=$part->getContent();


                        /*if (base64_decode($mess, true)) {
                            //echo "451";
                            $mess=  base64_decode($mess);
                        }  */                      
                        $p=strpos($mess, "Colsys Notificaciones");
                        $q=0;                        
                        if($p=="")
                        {                            
                            continue;
                        }
                        else
                            $q=130;

                        $mess= utf8_decode(quoted_printable_decode($mess));



                        if($p>=0)
                        {
                          $p=$p-$q;
                        }
                        $mess = substr($mess, 0, $p);//message.substring(p + 1, message); //now get the address  
                        $mess.="<br><span style='font-size:9px'><b>response from google app-script</b></span>"; 


                        echo $mess;
                        
                        //$request->setParameter("idticket",$idticket);
                        //$request->setParameter("comentario",$mess);

                        /*$user = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->select("u.ca_login")
                        ->where("u.ca_email = ? ", $from)
                        ->addWhere("u.ca_activo = true ")
                        ->limit(1)
                        ->fetchOne();*/
                        echo $idticket;
                        echo $from;
                        
                        $q = Doctrine::getTable("Usuario")->createQuery("u")
                            ->select("DISTINCT(u.ca_login) AS ca_login")        
                            ->where("u.ca_email = '{$from}'" );
                            //->addOrderBy("u.ca_nombre");
                            //echo $q->getSqlQuery();
                            
                        $user=$q->fetchOne();

                        if(!$user){   
                            Utils::writeLog($logFile, date('Y-m-d H:i:s')." - No se encontr� el usuario  para el email ".$from. " del ticket ".$idticket);
                            continue;
                            //exit;
                        }
                        //echo $idticket."---".$mess."---".$user->getCaLogin()."<br>";
                        $request->setParameter("idticket",$idticket);
                        $request->setParameter("respuesta",$mess);
                        $request->setParameter("iduser",$user->getCaLogin());
                        $this->executeGuardarRespuestaTicket($request);
                        
                    }
                } catch (Exception $e) {
                    
                    
                    /*$uniq_id = $mail->getUniqueId($messageNum);
                    $messageId = $mail->getNumberByUniqueId($uniq_id);
                    $mail->moveMessage($messageId, $folder1."P");       */
                    $msgerror.=$message->subject."/:".$e->getTraceAsString()."<br><br>";
                    
                }
                
                
                $uniq_id = $mail->getUniqueId($messageNum);
                $messageId = $mail->getNumberByUniqueId($uniq_id);
                $mail->moveMessage($messageId, $folder1."P");
            }
            /*foreach ($mail as $messageNum => $message) {
                $uniq_id = $mail->getUniqueId($messageNum);
                $messageId = $mail->getNumberByUniqueId($uniq_id);
                $mail->moveMessage($messageId, $folder1."P");   
            }*/
            
            if($msgerror!="")
            {
                Utils::sendEmail(
                    array(
                        "from"=>"colsys@coltrans.com.co",
                        "to"=>"admin@coltrans.com.co",
                        "subject"=>"Error en tickets email",
                        "body"=>"Error en tickets",
                        "mensaje"=> $msgerror
                    )
                );
                Utils::writeLog($logFile, date()." - ". $msgerror);
            }
        }
        /*catch(Exception $e)
        {
            echo $e->getMessage();
           
        }*/
        exit;
    }
    
    
    
    
    

    public function executeNoAccess(sfWebRequest $request) {
         
    }
    
    public function executeUnificarTickets(sfWebRequest $request){
        
        $kk = count(explode("|", $request->getParameter("ticketval")));
        $tickets = array_unique(explode("|", $request->getParameter("ticketval")));        
        $idticketPpal = $request->getParameter("idticket");
        $ticketPpal = Doctrine::getTable("HdeskTicket")->find($idticketPpal);
        
        $usuariosPpal = $ticketPpal->getUsuarios();        
        foreach($usuariosPpal as $usuario){
            $loginsPpal[] = $usuario->getCaLogin();
        }
        
        $conn = Doctrine::getTable("HdeskTicket")->getConnection();
        $conn->beginTransaction();
        
        try{
            for ($i = 0; $i < $kk; $i++) {
                if (!isset($tickets[$i]))
                    continue;
                $idticket = $tickets[$i];
                
                if ($idticket != $idticketPpal) {
                    
                    $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
                    $ticket->setCaParent($idticketPpal);
                    $ticket->save($conn);
                    
                    $respuesta = "El Ticket # ".$idticket." se ha unificado con el Ticket Principal # ".$idticketPpal.".<br/>"
                            . "A partir de &eacute;ste momento el presente ticket queda cerrado y todo los asuntos se manejar&aacute;n con el ticket principal.<br/>"
                            . "Los documentos, tareas y usuarios involucrados en el presente ticket se adicionar&aacute;n al Ticket Principal";
                    
                    $request->setParameter("idticket", $idticket);
                    $request->setParameter("respuesta", $respuesta);                    
                    $success = $this->executeGuardarRespuestaTicket($request);
                    
                    $detalleTk = $ticket->getCaText();
                    $detalleSec = $detalleSec."<br/>----------------------------------------------------------------------<br/><b>Ticket # ".$ticket->getCaIdticket()."</b><br/>".$detalleTk."<br/>";
                    
                    $logins = array($ticket->getCaLogin());
                    $usuarios = $ticket->getUsuarios();
                    
                    foreach ($usuarios as $usuario) {
                        $logins[] = $usuario->getCaLogin();
                    }
                    
                    foreach($logins as $login){
                        $request->setParameter("idticket", $idticketPpal);
                        $request->setParameter("login", $login); 
                        $success = $this->executeAgregarUsuario($request);                        
                    }
                    
                    $files=$ticket->getFiles();            
                    $directory = $ticketPpal->getDirectorio();
                    if($files){
                        foreach ($files as $f){
                            $newname = $directory . DIRECTORY_SEPARATOR . basename($f);
                            copy($f, $newname);
                        }
                    }
                    
                    $entregas = $ticket->getHdeskEstimations();
            
                    foreach($entregas as $entrega){
                        $entrega->setCaIdticket($idticketPpal);
                        $entrega->save($conn);
                    }
                    
                    $request->setParameter("idticket", $idticket);                    
                    $success = $this->executeCerrarTicket($request);
                }
            }
            
            $detalleTkPpal = $ticketPpal->getCaText();
            $ticketPpal->setCaText($detalleTkPpal."<br/>".$detalleSec);
            $ticketPpal->save($conn);
            
            $respuestaPpal = "El Ticket # ".$idticketPpal." se ha sido designado como Ticket Principal y manejar&aacute; los asuntos de (el/los) ticket(s) # ".$request->getParameter("ticketval")."<br/>"
                    . "Todas las respuestas, documentos y usuarios de los tickes mencionados se podr&aacute;n visualizar atrav&eacute;s de �ste ticket.<br/>"
                    . "Cualquier duda o informaci&ocute;n adicional por favor notificarla sobre &eacute;ste ticket.<br/>";  

            $request->setParameter("idticket", $idticketPpal);
            $request->setParameter("respuesta", $respuestaPpal);                    
            $success = $this->executeGuardarRespuestaTicket($request); 
            
            $this->responseArray = array("success" => true, "idticket" => $idticket, "sel"=>$success);        
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeAgendarEntregas($request){
        
        $kk = count(explode("|", $request->getParameter("ticketval")));
        $tickets = array_unique(explode("|", $request->getParameter("ticketval")));
        $respuesta = $request->getParameter("respuesta");
        $dias = $request->getParameter("dias");
        
        $data = array();
        $row = array();
        
        for ($i = 0; $i < $kk; $i++) {
            if (!isset($tickets[$i]))
                continue;
            $idticket = $tickets[$i];
            if ($idticket) {
                $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
                $entregas = $ticket->getHdeskEstimations();
                
                if(count($entregas)>0){
                    foreach($entregas as $entrega){
                        if(!$entrega->getCaIdresponse()){
                            $fchentregaIni = $entrega->getCaEstimated();
                            $fchentregaFin = Utils::addDays($fchentregaIni, $dias);

                            $entrega->setCaEstimated($fchentregaFin);
                            $entrega->save();
                        }
                    }
                    $request->setParameter("idticket", $idticket);
                    $request->setParameter("respuesta", $respuesta);
                    $request->setParameter("fchentrega", $fchentregaFin);

                    $success = $this->executeGuardarRespuestaTicket($request);                
                }else{
                    $row[] = $idticket;
                }
            }
        }
        $data = $row;
        $this->responseArray = array("success" => true, "idticket" => $idticket, "sel"=>$success, "data"=>$data);        
        $this->setTemplate("responseTemplate");
    }
                
    public function executeDatosEntregasTicket($request){
        
        $idticket = $request->getParameter("idticket");
        $modo = $request->getParameter("modo");
        $mostrarEntregas = $request->getParameter("mostrarEntregas");
        $idgroup = $request->getParameter("idgroup");
        
        if($idticket){
            $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
            $this->forward404Unless($ticket);

            $entregas = $ticket->getHdeskEstimations($modo);
            
        }else{
            
            $q = Doctrine::getTable("HdeskEstimations")
                    ->createQuery("he")
                    ->select("he.*, (SELECT r.ca_createdat FROM HdeskResponse r where r.ca_idresponse = he.ca_idresponse) as ca_createdat)")
                    ->innerJoin("he.HdeskTicket h");
            
            if($mostrarEntregas=="true"){
                $q->addWhere("he.ca_idresponse IS NOT NULL");                
            }else{
                $q->addWhere("he.ca_idresponse IS NULL");                
            }
            
            if($idgroup){
                $q->addWhere("h.ca_idgroup = ?", $idgroup);
            }
            $q->orderBy("he.ca_estimated");            
            $entregas = $q->execute(); 
        }
        
        if($entregas){
            $data = array();
            foreach ($entregas as $entrega) {
                $row = array();
                $row["idticket"] = $idticket?$idticket:$entrega->getHdeskTicket()->getCaIdticket();
                $row["title"] = $entrega->getHdeskTicket()->getCaTitle()?utf8_encode($entrega->getHdeskTicket()->getCaTitle()):"";
                $row["assignedto"] = $entrega->getHdeskTicket()->getCaAssignedto()?$entrega->getHdeskTicket()->getCaAssignedto():"";
                $row["login"] = $entrega->getHdeskTicket()->getCaLogin()?$entrega->getHdeskTicket()->getCaLogin():"";
                $row["opened"] = $entrega->getHdeskTicket()->getCaOpened()?$entrega->getHdeskTicket()->getCaOpened():""; 
                $row["idstage"] = $entrega->getCaIdstage();
                $row["stage"] = utf8_encode($entrega->getCaStage());
                $row["detail"] = utf8_encode($entrega->getCaDetail());
                $row["estimated"] = $entrega->getCaEstimated();
                $row["delivery"] = null;

                if($entrega->getCaIdresponse()){                    
                    $row["delivery"] = $entrega->getHdeskResponse()->getCaCreatedat();  
                }

                $data[] = $row;
            }
        }
        
        //echo "<pre>".print_r($data)."</pre>";

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarEntregas() {
        $this->forward404Unless($this->getRequestParameter('idticket'));
        $idticket = $this->getRequestParameter('idticket');
        
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        
        $conn = Doctrine::getTable("HdeskEstimations")->getConnection();
        $conn->beginTransaction();
        try {
            if (!$this->getRequestParameter('idstage')) {
                $entregas = new HdeskEstimations();
                $entregas->setCaIdticket($idticket);
            } else {
                $entregas = Doctrine::getTable("HdeskEstimations")->find($this->getRequestParameter('idstage'));
            }

            $row = array();

            if ($this->getRequestParameter('stage') !== null) {
                $entregas->setCaStage(utf8_decode($this->getRequestParameter('stage')));
                $row["stage"] = utf8_encode($this->getRequestParameter('stage'));
            }

            if ($this->getRequestParameter('detail') !== null) {
                $entregas->setCaDetail(utf8_decode($this->getRequestParameter('detail')));
                $row["detail"] = utf8_encode($this->getRequestParameter('detail'));
            }

            if ($this->getRequestParameter('estimated') !== null) {
                $entregas->setCaEstimated($this->getRequestParameter('estimated'));
                $row["estimated"] = $this->getRequestParameter('estimated');
            }

            $entregas->save($conn); 
            $ticket->getActualizarPorcentaje();
            
            /*
            * Se crea la tarea para el usuario
            */
            $tarea = new NotTarea();
            $tarea->setCaUrl("/pm/index?idticket=" . $ticket->getCaIdticket());
            $tarea->setCaIdlistatarea(14);
            $tarea->setCaFchcreado(date("Y-m-d H:i:s"));

            $tarea->setCaFchvisible($this->getRequestParameter('estimated'));
            $seguimiento = Utils::parseDate($this->getRequestParameter('estimated'));
            $tarea->setCaFchvencimiento($seguimiento . " 23:59:59");            

            $tarea->setCaUsucreado($this->getUser()->getUserId());
            $tarea->setCaTitulo("Programaci�n de Entrega >> Ticket # ".$idticket." : ".utf8_decode($this->getRequestParameter('stage')));
            $tarea->setCaTexto(utf8_decode($this->getRequestParameter('detail')));
            $tarea->save($conn);

            $tarea->setAsignaciones(array($this->getUser()->getUserId()));

            $entregas->setCaIdtarea($tarea->getCaIdtarea());
            $entregas->save($conn);
            
            $this->responseArray = array( "idstage" =>$entregas->getCaIdstage(), "id" =>$this->getRequestParameter('id'), "success" => true, "data" => $row);
            $conn->commit();
            
        } catch (Exception $e) {
            $conn->rollback();            
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }
    
    function executeVerEmailTicket($request){
        
        $idticket = $request->getParameter("idticket");
        $this->forward404Unless($idticket);
        
        $email = Doctrine::getTable("HdeskTicket")
                ->createQuery("h")
                ->select("MAX(ca_idemail) as ca_idemail")
                ->leftJoin("h.Email e")
                ->where("h.ca_idticket = ?", $idticket)
                ->addWhere("e.ca_tipo = 'Notificaci�n'")
                ->fetchOne();
        
        $this->responseArray = array("success" => false, "idemail"=>$email->ca_idemail);
                
        $this->setTemplate("responseTemplate");
    }   
}
