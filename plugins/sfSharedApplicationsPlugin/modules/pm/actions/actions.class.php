<?php

/**
 * pm actions.
 *
 * @package    colsys
 * @subpackage helpdesk
 * @author     Andrés Botero
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 *
 * Niveles de acceso
 * 0 Solo tickets puestos por el usuario.
 * 1 Tickets de su grupo o área unicamente.
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
        $ticket = Doctrine::getTable("HdeskTicket")->find($this->idticket);
        if($ticket)
            $this->idgroup = $ticket->getCaIdgroup();
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
                    (SELECT MIN(he.ca_estimated) FROM HdeskEstimations he WHERE he.ca_idticket = h.ca_idticket AND he.ca_idresponse IS NULL) as proxest, h.ca_datos")
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
        $q->addOrderBy("h.ca_assignedto DESC");
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
            $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserid());            
            $depAdic = $usuario->getProperty("helpDesk");
            if($depAdic){
                
                $d = Doctrine::getTable("Departamento")
                      ->createQuery("d");
                
                if(strpos($depAdic,"|"))
                    $d->orWhereIn("d.ca_nombre", explode("|",$depAdic));
                else
                    $d->orWhere("d.ca_nombre = ?", $depAdic);            

                $departamentos = $d->execute();
                
                foreach($departamentos as $d){                    
                    $deps[] = $d->getCaIddepartamento();                                        
                }
                $deps[] = $this->getUser()->getIddepartamento();
                $q->addWhere("(h.ca_login = '".$this->getUser()->getUserid()."' OR g.ca_iddepartament IN (".implode(",", $deps)."))");
                
            }else{
                $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento()));
            }
                
        }

        $q->distinct();
        $debug = $q->getSqlQuery();
        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        $resultsPerPage = $request->getParameter("limit");
        $currentPage = ($request->getParameter("start") / $resultsPerPage) + 1;
        $this->pager = new Doctrine_Pager(
            $q, $currentPage, $resultsPerPage
        );
        $tickets = $this->pager->execute();
        
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
            $tickets[$key]["s_ca_nombre"] = utf8_encode($tickets[$key]["s_ca_nombre"]);
            $tickets[$key]["status_name"] = isset($status[$tickets[$key]["h_ca_status"]]) ? utf8_encode($status[$tickets[$key]["h_ca_status"]]["nombre"]) : "";
            $tickets[$key]["status_color"] = isset($status[$tickets[$key]["h_ca_status"]]) ? $status[$tickets[$key]["h_ca_status"]]["color"] : "";
            $tickets[$key]["u_ca_extension"] = utf8_encode($tickets[$key]["u_ca_extension"]);
            $tickets[$key]["h_ca_datos"] = utf8_encode($tickets[$key]["h_ca_datos"]);
        }
        
        $this->responseArray = array("success" => true, "total" => $this->pager->getNumResults(), "total2" => $this->pager->getNumResults(), "root" => $tickets, "debug"=>$debug);
        
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
            if ($this->nivel > 0 && $this->app != "intranet") {
                $this->redirect("pm/index?idticket=" . $idticket);
            }else{
                $this->redirect("helpdesk/verTicket?id=" . $idticket);
            }            
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
                $texto = utf8_decode($request->getParameter("respuesta"));
                if($request->getParameter("check_tarifas")){
                    
                   /*
                   * Adjunta la tabla de tarifas a la respuesta del ticket
                   */
                   
                   $request->setParameter("idticket", $idticket);
                   $tarifasCotizadas = sfContext::getInstance()->getController()->getPresentationFor('pm','crearRespuestaTarifasHtml');                
                   $texto.=$tarifasCotizadas;                    
                }
                $respuesta->setCaText($texto);
            }            
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
            $email->setCaTipo("Notificación Rta");
            $email->setCaIdcaso($ticket->getCaIdticket());
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");

            $departamento = $ticket->getHdeskGroup()->getDepartamento()->getCaNombre();
            $subject = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?" Hallazgo Auditoría #":" Nueva respuesta Ticket #";
            $email->setCaSubject($departamento . $subject . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]");

            $request->setParameter("id", $ticket->getCaIdticket());
            $request->setParameter("format", "email");
            if ($idissue) {
                $texto = $txt;
                $texto .=sfContext::getInstance()->getController()->getPresentationFor('kbase', 'viewIssue');

                $texto = str_replace('src="/', 'src="https://www.colsys.com.co/', $texto);                
            } else {
                $texto = sfContext::getInstance()->getController()->getPresentationFor('pm', 'verTicket');
            }

            $email->setCaBodyhtml($texto);

            if ($ticket->getHdeskGroup()->getCaIddepartament()==4 and $ticket->getCaAssignedto()) {
                // Si el ticket es puesto por Auditoría, sobreescribe los destinatarios del mensaje
                // Si el ticket está asignado a algúnaHdeskUserGroup persona en particular, no copia a los demas del departamento
                $logins = array($ticket->getCaLogin(), $user->getCaLogin(), $ticket->getCaAssignedto());
                $usuarios = $ticket->getUsuarios();
                foreach ($usuarios as $usuario) {
                    $logins[] = $usuario->getCaLogin();
                }
            }
            foreach ($logins as $login) {
                if ($user->getCaLogin() != $login) {
                    $usuario = Doctrine::getTable("Usuario")->find($login);
                    $email->addTo($usuario->getCaEmail());
                }
            }

            $email->save($conn);
            
            /*
             * Cambia el status
             */
            if ($request->getParameter("status") !== null) {
                $ticket->setCaStatus(intval($request->getParameter("status")));
                $ticket->save($conn);
                $respuesta->setCaIdstatus(intval($request->getParameter("status")));
                $respuesta->save($conn);
            }

            $conn->commit();
            $request->setParameter("format", "");
            $texto = sfContext::getInstance()->getController()->getPresentationFor('pm', 'verRespuestas');

            $this->responseArray = array("success" => true, "idticket" => $ticket->getCaIdticket(), "info" => utf8_encode($texto));
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            Utils::writeLog($logFile, date('Y-m-d')."-".$e->getMessage());
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
        $notificar = true;
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

                    //Crea un nuevo status para saber que se cambio de área
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

            if ($request->getParameter("idempresa")) {
                $ticket->setCaIdempresa($request->getParameter("idempresa"));
            }

            if ($request->getParameter("idactivo") !== null) {
                if ($request->getParameter("idactivo")) {
                    $ticket->setCaIdactivo($request->getParameter("idactivo"));
                } else {
                    $ticket->setCaIdactivo(null);
                }
            }

            $ticket->save($conn);            
            
            if($request->getParameter("idmaster")){
                $ticket->setDocumento("INO", $request->getParameter("idmaster"));
                $ticket->setCaReportedby($user->getUserId());
            }
            
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

            //Datos para Area Tarifas de Tpte Internacional
            if(!$update){
                if($request->getParameter("area")==25){
                
                    $tarifa["idticket"] = $ticket->getCaIdticket();
                    $i=0;
                    while($request->getParameter("idorigen".$i) && $request->getParameter("idorigen".$i)!="" ){
                        $ciudad = Doctrine::getTable("Ciudad")->find($request->getParameter("idorigen".$i));
                        $trafico = $ciudad->getTrafico()->getCaNombre();
                        $tarifa["trayecto"]["ruta"][$i] = array("idorigen"=>$request->getParameter("idorigen".$i), "iddestino"=>$request->getParameter("iddestino".$i), "idtrayecto"=>$i);
                        $tarifa["trayecto"]["origen"]["trafico"][] = utf8_encode($trafico);
                        $tarifa["trayecto"]["origen"]["ciudad"][] = utf8_encode($request->getParameter("origen".$i));
                        $tarifa["trayecto"]["origen"]["transporte"][] = $request->getParameter("transori".$i);
                        $tarifa["trayecto"]["origen"]["exw"][] = $request->getParameter("exw".$i);
                        $tarifa["trayecto"]["origen"]["recogida"][] = utf8_encode($request->getParameter("recogida".$i));
                        $i++;
                    }

                    $j=0;
                    while($request->getParameter("iddestino".$j)!=""){
                        $tarifa["trayecto"]["destino"]["ciudad"][] = utf8_encode($request->getParameter("destino".$j));
                        $tarifa["trayecto"]["destino"]["transporte"][] = $request->getParameter("transdest".$j);
                        $j++;
                    }

                    if(!$request->getParameter("producto")){
                        $tarifa["producto"]["nombre"] = "Freight All Kind";
                    }else{
                        $tarifa["producto"]["nombre"] = utf8_encode($request->getParameter("producto"));
                    }

                    //Paneles de selección
                    $tarifa["checkbox"]["panel-carga-checkbox"] = $request->getParameter("panel-carga-checkbox");
                    $tarifa["checkbox"]["fcl-checkbox"] = $request->getParameter("fcl-checkbox");
                    $tarifa["checkbox"]["lcl-checkbox"] = $request->getParameter("lcl-checkbox");

                    // Carga peligrosa
                    if($request->getParameter("panel-carga-checkbox")=="on"){
                        $k=0;
                        while($request->getParameter("nclaseimo".$k)!=""){                    
                            $imos = ParametroTable::retrieveByCaso("CU270", null, null, $request->getParameter("nclaseimo".$k));
                            foreach($imos as $imo){
                                $tarifa["producto"]["nimo"][] = $imo->getCaValor2();
                                $tarifa["producto"]["imo"][] = utf8_encode($imo->getCaValor());
                            }
                            $tarifa["producto"]["unname"][]= $request->getParameter("unnumber".$k);
                            $k++;
                        }                    
                    }

                    //FCL
                    if($request->getParameter("fcl-checkbox")=="on"){                    
                        $l=0;
                        while($request->getParameter("nequipo".$l)!=""){                    
                            $tarifa["fcl"]["idequipo"][] = $request->getParameter("nequipo".$l);
                            $equipo = Doctrine::getTable("Concepto")->findOneBy("ca_idconcepto",$request->getParameter("nequipo".$l));
                            $tarifa["fcl"]["equipo"][] = utf8_encode($equipo->getCaConcepto());
                            $tarifa["fcl"]["cant"][] = $request->getParameter("cant".$l);
                            $tarifa["fcl"]["peso"][] = $request->getParameter("peso".$l);
                            $tarifa["fcl"]["frecuencia"][] = utf8_encode($request->getParameter("frec".$l));
                            $tarifa["fcl"]["temperatura"][] = $request->getParameter("temperatura".$l);
                            $tarifa["fcl"]["gauge"][] = $request->getParameter("gauge".$l);
                            if($request->getParameter("gauge".$l)=="out"){
                                $tarifa["fcl"]["dimensiones"][] = utf8_encode($request->getParameter("dimensiones".$l));
                                $tarifa["fcl"]["unidades"][] = utf8_encode($request->getParameter("unidimension".$l));
                            }else{
                                $tarifa["fcl"]["dimensiones"][] = "N/A";
                            }
                            $l++;
                        }                    
                    }

                    //LCL
                    if($request->getParameter("lcl-checkbox")=="on"){                    
                        $tarifa["lcl"]["tipo"] = $request->getParameter("tarifalcl");
                        $m=0;
                        while($request->getParameter("piezasLcl".$m)!=""){    
                            $tarifa["lcl"]["piezas-lcl"][] = $request->getParameter("piezasLcl".$m);
                            $tarifa["lcl"]["peso-lcl"][] = $request->getParameter("pesoLcl".$m);
                            $tarifa["lcl"]["dimensiones-lcl"][] = $request->getParameter("dimensionesLcl".$m);
                            $tarifa["lcl"]["unidades-lcl"][] = utf8_encode($request->getParameter("unidimensionLcl".$m));
                            $tarifa["lcl"]["embalaje"][] = $request->getParameter("embalaje".$m);
                            $m++;
                        }
                    }

                    $tarifa["generales"]["valor"] = $request->getParameter("tarifareq");
                    $tarifa["generales"]["moneda"] = $request->getParameter("ca_idmoneda_vlr");
                    $tarifa["generales"]["fchembarque"] = $request->getParameter("fchembarque");
                    $tarifa["generales"]["patio"] = utf8_encode($request->getParameter("patio"));
                    $tarifa["generales"]["observaciones"] = nl2br(utf8_encode($request->getParameter("observaciones")));

                    $tarifa["compania"]["tipo"] = $request->getParameter("cliente");
                    $tarifa["compania"]["id"] = $request->getParameter("idcliente");
                    $tarifa["compania"]["nombre"] = utf8_encode($request->getParameter("compania"));
                    $tarifa["compania"]["antiguo"] = utf8_encode($request->getParameter("compania2"));

                    $tarifa["norigen"] = $i;
                    $tarifa["ndestino"] = $j;
                    $tarifa["nimos"] = $k;
                    $tarifa["ncontenedores"] = $l;
                    $tarifa["npiezasLcl"] = $m;

                    if (isset($_FILES["archivo_tarifas"]) and $_FILES["archivo_tarifas"]["name"]) {

                        $archivo = $_FILES["archivo_tarifas"];
                        $directorio = $ticket->getDirectorio();

                        if (!is_dir($directorio)) {
                            mkdir($directorio, 0777, true);
                        }
                        move_uploaded_file($archivo["tmp_name"], $directorio . DIRECTORY_SEPARATOR . $archivo["name"]);
                    }

                    ksort($tarifa);                
                    $tarifa = array("solicitud"=>$tarifa);
                    $tarifasJson = json_encode($tarifa);                
                    $ticket->setCaDatos($tarifasJson);
                    $ticket->save($conn);  

                    $tarifas = json_decode($ticket->getCaDatos(),1);

                    /*
                     * Crea un PDF con las tarifas y se guarda en la carpeta del ticket
                     */  
                    $request->setParameter("idticket", $ticket->getCaIdticket());
                    $request->setParameter("tipo", "interno");                 
                    $detalleTarifa = sfContext::getInstance()->getController()->getPresentationFor('pm','crearTarifasHtml');                

                    /*Ticket 61064. Cambio asunto Transporte Internacional*/
                    $cliente = utf8_encode($request->getParameter("compania2"))?utf8_encode($request->getParameter("compania2")):utf8_encode($request->getParameter("compania"));
                    $login = Doctrine::getTable("Usuario")->find($user->getUserId());
                    /*Ticket 82733 Agregar al titulo de los Tickets Pricing el Pais Origen*/
                    $traorigen = utf8_decode($tarifa["solicitud"]["trayecto"]["origen"]["trafico"][0]);
                    $title = $login->getSucursal()->getCaNombre()." - ".$cliente. " - ".$traorigen;
                    
                    $ticket->setCaTitle($title);
                    $ticket->setCaText($detalleTarifa);
                    $ticket->save($conn);
                }
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
                    $lista = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?10:1;  // Lista para Tickets de Auditoría o Lista General
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
                    //Si es Auditoría, crea la tarea solo la persona reportada.
                    $loginsAsignaciones = array($ticket->getCaLogin());
                    $tarea->setAsignaciones($loginsAsignaciones, $conn);
                }else{
                    //Verifica las asignaciones de la tarea.
                    $loginsAsignaciones = $ticket->getLoginsGroup();
                    $tarea->setAsignaciones($loginsAsignaciones, $conn);
                }
            }
            
            if($request->getParameter("type")){
                $type = Doctrine::getTable("HdeskDepartamentClasification")->findBy("ca_clasification",$request->getParameter("type"))->getFirst();
                /*Cierre automático del ticket en caso que así este marcado el tipo*/
                if($type->getCaCierre()){
                    $request->setParameter("ticket",$ticket);                    
                    $request->setParameter("respuesta",utf8_encode("Ésta es una notificación automática, por favor no responder este ticket."));                    
                    
                    $suc = $this->executeCierreAutomatico($request);                    
                    $notificar = false;
                }
                /*Se ejecuta la acción que este asociada al tipo de ticket*/
                if($type->getCaDatos()){                    
                    eval("\$obj = Doctrine::getTable(".$type->getDatosJson('ca_modelo').")->find(\$request->getParameter(\$type->getDatosJson('ca_parametro')));");
                    eval("\$respuesta = \$obj->".$type->getDatosJson('ca_metodo')."();");
                }
            }
            
            if (!$update && $request->getParameter("actionTicket") != "Cerrado" && $notificar) {
                $tarea->notificar($conn);
            }
            if ($changeDepto == true) {
                $email = new Email();
                $email->setCaUsuenvio($this->getUser()->getUserId());
                $email->setCaTipo("Notificación");
                $email->setCaIdcaso($ticket->getCaIdticket());
                $email->setCaFrom("no-reply@coltrans.com.co");
                $email->setCaFromname("Colsys Notificaciones");
                $subject = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?"Hallazgo de Auditoría":"Ticket";
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
                $email->save($conn);
            }
            if($error){   
                $conn->rollback();
                $this->responseArray = array("success" => false, "idticket" => $ticket->getCaIdticket(), "errorInfo"=>$error["entregas"]);
            }else{                
                $conn->commit();
                $this->responseArray = array("success" => true, "idticket" => $ticket->getCaIdticket(), "change"=>$changeDepto, "txt"=>utf8_encode($txt));
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
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
     * Datos de las areas de acuerdo al departamento
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosStatus(sfWebRequest $request) {
        
        $idgrupo = $request->getParameter("idgrupo");
        $statusArray = array();

        if ($idgrupo) {
                $statuss = Doctrine::getTable("HdeskStatusGroup")
                        ->createQuery("sg")
                        ->select("sg.ca_idgroup, sg.ca_idstatus, p.ca_identificacion, p.ca_valor")
                        ->innerJoin("sg.Parametro p")
                        ->where("p.ca_casouso = 'CU110' AND sg.ca_idgroup = ?", $idgrupo)
                        ->addOrderBy("p.ca_valor")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

                foreach ($statuss as $s) {
                    $row = array("status" => $s["p_ca_identificacion"], "valor" => utf8_encode($s["p_ca_valor"]));
                $status[] = $row;
            }
        }

        $this->responseArray = array("root" => $status, "success" => true);
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
            $email->setCaTipo("Notificación");
            $email->setCaIdcaso($this->ticket->getCaIdticket());
            $email->setCaFrom("no-reply@coltrans.com.co");
            $email->setCaFromname("Colsys Notificaciones");

            $subject = ($this->ticket->getHdeskGroup()->getCaIddepartament()==4)?"Hallazgo de Auditoría":"Ticket";
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
     * Pagina de administración de proyectos
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
            $data["parent"] = $ticket->getCaParent();
            $data["idempresa"] = $ticket->getCaIdempresa();
            if($ticket->getCaIdempresa()){
                $empresa = Doctrine::getTable("Empresa")->find($ticket->getCaIdempresa());
                $data["empresa"] = utf8_encode($empresa->getCaNombre());
            }

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
     * Panel que muestra una grilla con los documentos afectados con un Ticket de Auditoría
     * @author: Carlos G. López M.
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
     * Guarda los cambios en los documentos del ticket de Auditoría
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
        
        if($this->getRequestParameter('tipo_documento') == 'INO' or $this->getRequestParameter('tipo_documento') == 'Contenedores'){
            $master = Doctrine::getTable("InoMaster")->findBy("ca_referencia", $this->getRequestParameter('documento'))->getFirst();

            if(is_object($master)){
                $auditDocuments->setCaObservaciones(utf8_decode($this->getRequestParameter('observaciones')).' <a href="/inoF2/indexExt5/idmaster/'.$master->getCaIdmaster().'" target="_blank">Ver Referencia</a>');
            }
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

        $records = explode(chr(10), $input); // Divide el archivo por los Saltos de Línea

        foreach ($records as $record) {       // Hace una primera lectura para verificar la estructura del archivo
            if (stristr($record, 'Documento/Referencia') === FALSE and strlen(trim($record)) != 0) {

                $fields = explode(chr($this->getRequestParameter('separador')), $record); // Divide el archivo en campos por el separador

                if (count($fields) != 5) {
                    $resultado = "¡El archivo tiene errores en su estructura, por tanto no se puede importar! ";
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
        $records = explode(chr(10), $input); // Divide el archivo por los Saltos de Línea
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
                    $row["text"] = utf8_encode("Se abrió el ticket");
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
        
        $folder1="COLSYS";
        
        $debug=$request->getParameter("debug");
        $msgerror="";
        
        {
            ProjectConfiguration::registerZend();
            Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
            Zend_Loader::loadClass('Zend_Gdata_Gapps');
            $pass = 'cglti$col91';
            $mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
            $mail->selectFolder($folder1);

            $logFile = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "colsyslog" . DIRECTORY_SEPARATOR . "tickets_error.log";
            echo "Numero de Emails:" . count($mail);

            foreach ($mail as $messageNum => $message) {
                try {
                    $from = $message->from;
                    $part = $message;
                    $sender = trim(utf8_encode($message->from));

                    preg_match('/<(.*?)>/s', $sender, $matches);
                    $from = $matches[1];
                    $ticket_regex = "/#[0-9]+/";

                    preg_match_all($ticket_regex, $message->subject, $matches_ticket);
                    $idticket = str_replace("#", "", $matches_ticket[0][0]);

                    $part = $message->getPart(1);
                    if (strtok($part->contentType, ';') == 'text/plain') {

                        $mess = $part->getContent();
                        $p = strpos($mess, "Colsys Notificaciones");
                        $q = 0;
                        if ($p == "") {
                            continue;
                        } else
                            $q = 130;

                        $mess = utf8_decode(quoted_printable_decode($mess));

                        if($p>=0){
                          $p=$p-$q;
                        }
                        $mess = substr($mess, 0, $p);
                        $mess.="<br><span style='font-size:9px'><b>response from google app-script</b></span>"; 
                        
                        echo $mess;                        
                        echo $idticket;
                        echo $from;
                        
                        $q = Doctrine::getTable("Usuario")->createQuery("u")
                            ->select("DISTINCT(u.ca_login) AS ca_login")        
                            ->where(" u.ca_activo = true AND u.ca_email = '{$from}'");                            
                        $user=$q->fetchOne();

                        if(!$user){   
                            Utils::writeLog($logFile, date()." - No se encontró el usuario  para el email ".$from. " del ticket ".$idticket);
                            continue;
                        }
                        echo "|".$user->getCaLogin();
                        $request->setParameter("idticket",$idticket);
                        $request->setParameter("respuesta",$mess);
                        $request->setParameter("iduser",$user->getCaLogin());
                        $this->executeGuardarRespuestaTicket($request);
                    }
                } catch (Exception $e) {
                    $msgerror.=$message->subject."/:".$e->getTraceAsString()."<br><br>";                    
                }
                
                
                $uniq_id = $mail->getUniqueId($messageNum);
                $messageId = $mail->getNumberByUniqueId($uniq_id);
                $mail->moveMessage($messageId, $folder1."P");
            }
            
            if($msgerror!=""){
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
                    . "Todas las respuestas, documentos y usuarios de los tickes mencionados se podr&aacute;n visualizar atrav&eacute;s de éste ticket.<br/>"
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
            $tarea->setCaTitulo("Programación de Entrega >> Ticket # ".$idticket." : ".utf8_decode($this->getRequestParameter('stage')));
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
                ->addWhere("e.ca_tipo = 'Notificación'")
                ->fetchOne();
        
        $this->responseArray = array("success" => false, "idemail"=>$email->ca_idemail);
                
        $this->setTemplate("responseTemplate");
    }   
    
    function executeTraerParametros($request){
        
        $this->data = array();
        
        $caso_uso = $request->getParameter("casouso");
        
        $datos = ParametroTable::retrieveByCaso($caso_uso);
        foreach ($datos as $dato) {
            $data[] = array("id" => utf8_encode($dato->getCaIdentificacion()), "name" => utf8_encode($dato->getCaValor()), "name2" => utf8_encode($dato->getCaValor2()), "caso_uso" => $dato->getCaCasouso());                                
        }
            
        $this->responseArray = array("success" => true, "root"=>$data);
        $this->setTemplate("responseTemplate");
    }
    
    function executeCrearTarifasHtml($request){
        
        $idticket = $request->getParameter("idticket");
        $this->ticket = Doctrine::getTable("HdeskTicket")->find($idticket); 
        $this->tarifas = json_decode(utf8_encode($this->ticket->getCaDatos()),1);
        
        $this->tipo = $request->getParameter("tipo");
        
        if($this->tipo == "interno")
            $this->setLayout("minimal");        
        else
            $this->setLayout("none");        
    }
    
    function executeGenerarTarifasPDF($request){
        
        $idticket = $request->getParameter("idticket");
        $tipo = $request->getParameter("tipo");
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);        
        
        $tarifa = json_decode($ticket->getCaDatos(),1);
        
        /*
        * Crea ticket en PDF de las tarifas para adjuntar
        */   
        ob_start();
        ini_set('display_errors', 'on');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Coltrans');
        $pdf->SetMargins(5, 10, 5,false);
        
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('helvetica', '', 9);
        $pdf->AddPage('', '',true);

        $request->setParameter("tarifas", $tarifa["solicitud"]);
        $request->setParameter("ticket", $ticket);
        $request->setParameter("tipo", $tipo);        
        $texto= sfContext::getInstance()->getController()->getPresentationFor('pm', 'crearTarifasHtml');
        $html= utf8_encode($texto);

        $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->lastPage();

        $directorio = $ticket->getDirectorio();
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if($tipo == "interno"){
            $filename = "Solicitud de Tarifas Ticket # ".$ticket->getCaIdticket();
            $pdf->Output($directorio . DIRECTORY_SEPARATOR .$filename.'.pdf', 'F');
        }else{
            $filename = "Solicitud Cotizacion Proveedor Ticket # ".$ticket->getCaIdticket().".pdf";
            $pdf->Output($filename, 'I'); // Lo muestra en el navegador
            $pdf->Output($directorio . DIRECTORY_SEPARATOR .$filename, 'F');
        }

        $this->setTemplate("responseTemplate");   
    }
    
    function executeVerSolicitudProveedor(){        
        
        $this->ticket = Doctrine::getTable("HdeskTicket")->find($this->getRequestParameter("idticket"));
        $data = json_decode($this->ticket->getCaDatos());
        
        for($i=0;$i<$data->solicitud->norigen;$i++){            
            $trayectos.=$data->solicitud->trayecto->origen->ciudad[$i]." - ".$data->solicitud->trayecto->destino->ciudad[$i]." | ";            
        }
        
        $this->asunto = "Solicitud Tarifas Transporte Internacional Ticket # ".$this->ticket->getCaIdticket()." => ".substr($trayectos,0,-3);        
        $this->setLayout("minimal");
    }
    
    /*
     * Envia al proveedor solicitud de tarifas vía Email
     */

    public function executeEnviarSolicitudEmail($request) {
        $ticket = Doctrine::getTable("HdeskTicket")->find($this->getRequestParameter("id"));

        $user = $this->getUser();
        //Crea el correo electronico
        $email = new Email();
        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("Hdesk Proveedor");
        $email->setCaIdcaso($this->getRequestParameter("id"));
        $email->setCaFrom($user->getEmail());
        $email->setCaFromname($user->getNombre());

        if ($this->getRequestParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }

        $email->setCaReplyto($user->getEmail());

        $recips = explode(",", $this->getRequestParameter("destinatario"));
        if (is_array($recips)) {
            foreach ($recips as $recip) {
                $recip = str_replace(" ", "", $recip);
                if ($recip) {
                    $email->addTo($recip);
                }
            }
        }
        
        $mensaje = ($this->getRequestParameter("mensaje") . "\n\n");
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());

        $email->addCc($this->getUser()->getEmail());        
        $email->setCaSubject($this->getRequestParameter("asunto"));
        
        $request->setParameter("idticket", $ticket->getCaIdticket());
        $request->setParameter("tipo", "externo");                 
        $detalleTarifa = sfContext::getInstance()->getController()->getPresentationFor('pm','crearTarifasHtml'); 
                
        $email->setCaBody($mensaje ."<br/>". $usuario->getFirma());
        $email->setCaBodyhtml(Utils::replace($mensaje) . $detalleTarifa. "<br/>". $usuario->getFirmaHTML());
        
        $attachments = $this->getRequestParameter("attachments");
        if ($attachments) {
           foreach ($attachments as $attachment) {
              $params = explode("_", $attachment);
              $idticket = $params[0];
              $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
              $this->forward404Unless($ticket);

              $file = base64_decode($params[1]);
              $directory = $ticket->getDirectorioBase();

              $name = $directory . DIRECTORY_SEPARATOR . $file;
              $email->AddAttachment($name);
           }
        }

        $email->save(); //guarda el cuerpo del mensaje    
        $this->idemail = $email->getCaIdemail();
        $respuesta = "Se ha generado solicitud de cotización al proveedor para la tarifa requerida. <a href='/email/verEmail?id=".$email->getCaIdemail()."' target='_blank'>Ver Email</a>";
        $request->setParameter("idticket", $ticket->getCaIdticket());
        $request->setParameter("respuesta", $respuesta);
        $request->setParameter("status", 11); // Solicitud del proveedor
        $suc = $this->executeGuardarRespuestaTicket($request);
        
        $this->setTemplate("enviarSolicitudEmail");
        $this->setLayout("minimal");
    }
    
    public function executeDatosRespuestaTarifa($request){
        
        $idticket = $request->getParameter("idticket");
        $borrar = $request->getParameter("borrar");
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        $id = $request->getParameter($id);
        
        $datos = json_decode(utf8_encode($ticket->getCaDatos()),1);        
        $datosTarifa = $datos["solicitud"];
        $trayectos = $datosTarifa["trayecto"];
        $ntrayectos = $datosTarifa["norigen"];
        
        for($i=0; $i<$ntrayectos;$i++){
            $modalidad = $trayectos["ruta"][$i]["modalidad"]?' - '.$trayectos["ruta"][$i]["modalidad"]:"";
            $linea = $trayectos["ruta"][$i]["linea"]?' - '.$trayectos["ruta"][$i]["linea"]:"";
            $trayectoStr[] = $trayectos["origen"]["ciudad"][$i] . " - " . $trayectos["destino"]["ciudad"][$i].$modalidad.$linea;
        }
        
        $array = ["id","tipo", "concepto", "trayecto", "moneda", "observaciones", "aplicacion"];
        
        if($datos["datos"] && (!isset($borrar)|| $borrar==="false")){
            $gArray = $datos["datos"];
            foreach($gArray as $key => $gridData){
                $row = array();
                foreach($gridData as $item => $value){
                    if(!in_array($item, $array)){
                        $row[$item] = intval($value);
                    }else
                        $row[$item] = $value;
                }
                $data[] = $row;
            }
        }else{            
            for($i=0;$i<count($trayectoStr);$i++){
                $row = array();
                $row["idticket"] = $idticket;
                $row["idtrayecto"] = $i;
                $row["trayecto"] = $trayectoStr[$i];
                $row["idconcepto"] = '999';
                $row["concepto"] = utf8_encode('Flete Marítimo');            
                $row["tipo"] = 'flete';                
                $data[] = $row;
            }
        }
        
        $this->responseArray = array("success" => true, "total" => count($data), "idticket" => $idticket, "root"=>$data);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosTrayecto() {
        
        $idtrayecto = $this->getRequestParameter("idtrayecto");
        $idticket = $this->getRequestParameter("idticket");
        
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        
        $datos = json_decode($ticket->getCaDatos(),1);
        
        if($idtrayecto!=null){
            $sql = "SELECT elem->>'idtrayecto' as idtrayecto, tori.ca_idtrafico as idtraorigen, tori.ca_nombre as traorigen, origen.ca_idciudad as ca_idorigen, origen.ca_ciudad as ca_ciuorigen, tdest.ca_idtrafico as idtradestino, tdest.ca_nombre as tradestino, destino.ca_idciudad as ca_iddestino, destino.ca_ciudad as ca_ciudestino,
                        elem->>'modalidad' as modalidad, elem->>'idlinea' as idlinea, elem->>'linea' as linea, elem->>'observaciones' as observaciones,elem->>'frecuencia' as frecuencia,
                        elem->>'ttransito' as ttransito,elem->>'ncontrato' as ncontrato, elem->>'cerradapor' as cerradapor,elem->>'vigenciaIni' as vigenciaini, elem->>'vigenciaEnd' as vigenciaend
                        /*, (json_array_elements(ca_datos::json->'trayecto')::json->'idorigen'):: text as ca_idorigen, json_array_elements(ca_datos::json->'trayecto')::json->'iddestino' as ca_iddestino */       
                FROM helpdesk.tb_tickets tk, jsonb_array_elements(tk.ca_datos->'solicitud'->'trayecto'->'ruta') AS elem
                        LEFT JOIN tb_ciudades origen ON origen.ca_idciudad = elem->>'idorigen'
                        LEFT JOIN tb_ciudades destino ON destino.ca_idciudad = elem->>'iddestino'
                        LEFT JOIN tb_traficos tori ON tori.ca_idtrafico = origen.ca_idtrafico
                        LEFT JOIN tb_traficos tdest ON tdest.ca_idtrafico = destino.ca_idtrafico
                WHERE ca_idticket =".$idticket."ORDER BY elem->>'idtrayecto'";
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $trayectos = $st->fetchAll();

            foreach($trayectos as $trayecto){
                if($trayecto["idtrayecto"]==$idtrayecto){
                    $data = array();
                    $data["idtrayecto"] = $idtrayecto;
                    $data["impoexpo"] = utf8_encode(Constantes::IMPO);
                    $data["transporte"] = utf8_encode(Constantes::MARITIMO);
                    $data["transporte"] = utf8_encode(Constantes::MARITIMO);
                    $data["tra_origen"] = $trayectos[$idtrayecto]["idtraorigen"];
                    $data["pais_origen"] = utf8_encode($trayectos[$idtrayecto]["traorigen"]);
                    $data["ciu_origen"] = $trayectos[$idtrayecto]["ca_idorigen"];
                    $data["ciudad_origen"] = utf8_encode($trayectos[$idtrayecto]["ca_ciuorigen"]);
                    $data["tra_destino"] = $trayectos[$idtrayecto]["idtradestino"];
                    $data["pais_destino"] = utf8_encode($trayectos[$idtrayecto]["tradestino"]);
                    $data["ciu_destino"] = $trayectos[$idtrayecto]["ca_iddestino"];
                    $data["ciudad_destino"] = utf8_encode($trayectos[$idtrayecto]["ca_ciudestino"]);
                    $data["modalidad"] = $trayectos[$idtrayecto]["modalidad"]?$trayectos[$idtrayecto]["modalidad"]:NULL;
                    $data["idlinea"] = $trayectos[$idtrayecto]["idlinea"]?$trayectos[$idtrayecto]["idlinea"]:NULL;
                    $data["linea"] = $trayectos[$idtrayecto]["linea"]?$trayectos[$idtrayecto]["linea"]:NULL;
                    $data["observaciones"] = $trayectos[$idtrayecto]["observaciones"]?$trayectos[$idtrayecto]["observaciones"]:NULL;
                    $data["frecuencia"] = $trayectos[$idtrayecto]["frecuencia"]?$trayectos[$idtrayecto]["frecuencia"]:NULL;
                    $data["ttransito"] = $trayectos[$idtrayecto]["ttransito"]?$trayectos[$idtrayecto]["ttransito"]:NULL;
                    $data["ncontrato"] = $trayectos[$idtrayecto]["ncontrato"]?$trayectos[$idtrayecto]["ncontrato"]:NULL;
                    $data["cerradapor"] = $trayectos[$idtrayecto]["cerradapor"]?$trayectos[$idtrayecto]["cerradapor"]:NULL;
                    $data["vigenciaIni"] = $trayectos[$idtrayecto]["vigenciaini"]?$trayectos[$idtrayecto]["vigenciaini"]:NULL;
                    $data["vigenciaEnd"] = $trayectos[$idtrayecto]["vigenciaend"]?$trayectos[$idtrayecto]["vigenciaend"]:NULL;
                }  else {
                    continue;
                }
            }
        }else{            
            $data = array();
            $data["idtrayecto"] = $datos["solicitud"]["norigen"];
            $data["impoexpo"] = utf8_encode(Constantes::IMPO);
            $data["transporte"] = utf8_encode(Constantes::MARITIMO);
            $data["transporte"] = utf8_encode(Constantes::MARITIMO);            
            $data["modalidad"] = $datos["solicitud"]["fcl"]?"FCL":"LCL";
        }
        
        if($data){
            $this->responseArray = array("data" => $data, "success" => true, "idtrayecto"=>$idtrayecto);
        }else{
            $this->responseArray = array("errorInfo" => "El trayecto no cargó los datos", "success" => false);
        }        

        $this->setTemplate("responseTemplate");
    }
    
    public function executeObtenerDatosTarifa($request) {
    
        $idticket = $request->getParameter("idticket");
        $tipo = $request->getParameter("tipo");
        
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);        
        $datos = json_decode(utf8_encode($ticket->getCaDatos()),1);
        $datosTarifa = $datos[$tipo];
        
        $conceptos = Doctrine::getTable("Concepto")
                        ->createQuery("c")
                        ->where("c.ca_transporte = ? AND c.ca_modalidad = ?", array(Constantes::MARITIMO, Constantes::FCL))
                        ->addOrderBy("c.ca_liminferior")
                        ->addOrderBy("c.ca_concepto")
                        ->execute();  
        
        $this->conceptos = array();
        foreach($conceptos as $concepto){
            $this->conceptos[] = array("idconcepto"=>$concepto->getCaIdconcepto(), "concepto"=>$concepto->getCaConcepto());
        }
        
        $this->conceptos[] = array("idconcepto"=>"tm3", "concepto"=>"T/M3");
        $this->conceptos[] = array("idconcepto"=>"minima", "concepto"=>"MINIMA");
        
        if($datosTarifa){
            $this->responseArray = array("data" => $datosTarifa, "idticket"=>$idticket, "success" => true, "errorInfo"=>null, "conceptos"=>$this->conceptos);
        }else{
            $this->responseArray = array("success" => false, "errorInfo"=>"Los datos no cargaron correctamente");
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeActualizarTrayecto($request) {
    
        $idtrayecto = $request->getParameter("idtrayecto");
        
        $idticket = $request->getParameter("idticket");
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);        
        $datos = json_decode(utf8_encode($ticket->getCaDatos()),1);
        
        $solicitud = $datos["solicitud"];
        $trayecto = $datos["solicitud"]["trayecto"];
        
        if(!$trayecto["ruta"][$idtrayecto]){
            $solicitud["norigen"]++;            
            $ruta[] = $trayecto["ruta"];
            $ruta["idtrayecto"] = $idtrayecto;
        }else{
            $ruta = $trayecto["ruta"][$idtrayecto];
        }
        
        $ruta["idorigen"] = $request->getParameter("idorigen");
        $ruta["iddestino"] = $request->getParameter("iddestino");
        $ruta["modalidad"] = $request->getParameter("modalidad");
        $ruta["idlinea"] = $request->getParameter("idlinea");
        $ruta["linea"] = utf8_encode($request->getParameter("linea"));
        $ruta["observaciones"] = utf8_encode($request->getParameter("observaciones"));
        $ruta["frecuencia"] = utf8_encode($request->getParameter("frecuencia"));
        $ruta["ttransito"] = utf8_encode($request->getParameter("ttransito"));
        $ruta["ncontrato"] = utf8_encode($request->getParameter("ncontrato"));
        $ruta["cerradapor"] = utf8_encode($request->getParameter("cerradapor"));
        $ruta["vigenciaIni"] = $request->getParameter("vigenciaIni");
        $ruta["vigenciaEnd"] = $request->getParameter("vigenciaEnd");
        
        $trayecto["ruta"][$idtrayecto] = $ruta;
        $trayecto["origen"]["ciudad"][$idtrayecto] = utf8_encode($request->getParameter("origen"));
        $trayecto["destino"]["ciudad"][$idtrayecto] = utf8_encode($request->getParameter("destino"));
        $solicitud["trayecto"] = $trayecto;        
        $datos["solicitud"] = $solicitud;
        
        $ticket->setCaDatos(json_encode($datos));
        $ticket->save();        
        
        if($datos){
            $this->responseArray = array("data" => $datos, "idticket"=>$idticket, "success" => true, "msg"=> "El trayecto ha sido actualizado éxitosamente");
        }else{
            $this->responseArray = array("success" => false);
        }
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarTarifasCotizacion($request) {
        
        $datos = utf8_decode($request->getParameter("datos"));
        $idticket = $request->getParameter("idticket");
        $chidden = json_decode($request->getParameter("chidden"),1);
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        
        $datosCot = json_decode(utf8_encode($datos), 1);
        $ids = array();
        
        foreach($datosCot as $orden => $cot){
            $idtrayecto = $cot["idtrayecto"];
            $conceptoName = $cot["concepto"];
            $aplicacion = $cot["aplicacion"];            
            $ids[] = $cot["id"];
            
            
            foreach($cot as $key=>$value){                
                if("equipo_" == substr($key,0,7)){  
                    if(!in_array($key, $chidden)){
                        $idcontenedor = substr($key,7,strlen($key));                    
                        if($idcontenedor=="tm3" || $idcontenedor=="minima"){                        
                            $equipos[$idcontenedor] = $idcontenedor=="tm3"?"T/M3":"MINIMA";
                            $equipo = $idcontenedor=="tm3"?"T/M3":"MINIMA";
                        }else{
                            $contenedor = Doctrine::getTable("Concepto")->findOneBy("ca_idconcepto", $idcontenedor);
                            $equipos[$idcontenedor] = $contenedor->getCaConcepto();
                            $equipo = $contenedor->getCaConcepto();
                        }
                        $idconcepto = $cot["tipo"]!="recargo"?"9999":$cot["ca_idconcepto"];                                    
                        $recargoLocal = $cot["sel"]?$cot["sel"]:NULL;
                        $conDestino = $cot["cd"]?$cot["cd"]:NULL;
                        $tipo = $recargoLocal?"Recargos Locales":($conDestino?"Condiciones en Destino":"Flete");                  
                        $cotizacion["trayectos"][$idtrayecto][$tipo][strval($orden)][$conceptoName][] = array("ca_idconcepto"=>$cot["idconcepto"], "ca_concepto"=>$conceptoName, "ca_idequipo"=>$idcontenedor,"ca_equipo"=>$equipo ,"ca_vlrrecargo"=>$value, "ca_moneda"=>$cot["moneda"], "recargoLocal"=>$recargoLocal, "conDestino"=>$conDestino, "order"=>  strval($orden), "aplicacion"=>  $aplicacion, "observaciones"=>$cot["observaciones"]);
                    }
                }                
            }
        }
        /*Datos que se cotizaron*/
        $cotizacion["equipos"] = $equipos;
        ksort($cotizacion);        
        $cotJson = json_decode(utf8_encode($datos), 1);        
        
        /*Datos que se solicitaron*/
        $datosTarifas = json_decode(utf8_encode($ticket->getCaDatos()),1);           
        $solicitud = $datosTarifas["solicitud"];
        
        $datosArray = array("solicitud"=>$solicitud, "cotizacion"=> $cotizacion, "datos"=>$cotJson);           
        $datosJson = json_encode($datosArray);
        
        $ticket->setCaDatos($datosJson);
        $ticket->save();
        
        if($cotizacion){
            $this->responseArray = array("success" => true, "data"=>$datosArray, "id" => implode(",", $ids));
        }else{
            $this->responseArray = array("errorInfo" => "La cotización no es válida", "success" => false);
        }
        $this->setTemplate("responseTemplate");       
        
    }
    
    function executeCrearRespuestaTarifasHtml($request){
        
        $idticket = $request->getParameter("idticket");
        $ticket = Doctrine::getTable("HdeskTicket")->find($idticket);
        
        $datosTarifas = json_decode(utf8_encode($ticket->getCaDatos()),1);        
        $this->solicitud = $datosTarifas["solicitud"];
        $this->cotizacion = $datosTarifas["cotizacion"];
        
        $this->ticket = $ticket;
        
        $this->setLayout("none");
    }
    
    function executeRecargarData($request){
        /*$data = '{"idticket":41139,"idtrayecto":0},
                "trayecto":"Barquisimeto » Cartagena",
                "idconcepto":999,
                "concepto":"Flete Marítimo",
                "tipo":"flete",
                "sel":false,
                "cd":false,                
                "T/M3":0,"MINIMA":0,
                "equipo_tm3":1500,
                "equipo_minima":1600,
                "moneda":"EUR",
                "id":"ext-record-71"
            },{
                "idreg":"0",
                "concepto":"Administracion de contenedores",
                "tipo":"recargo",
                "idtrayecto":0,
                "idconcepto":786,
                "idticket":41139,
                "trayecto":"Barquisimeto » Cartagena",
                "equipo_tm3":200,
                "equipo_minima":400,
                "moneda":"EUR",
                "id":"ext-record-518"
                    
            },
            {
                "idreg":"0",
                "concepto":"Desconsolidacion",
                "tipo":"recargo",
                "idtrayecto":0,
                "idconcepto":937,
                "idticket":41139,
                "trayecto":"Barquisimeto » Cartagena",
                "equipo_tm3":20,
                "equipo_minima":30,
                "sel":true,"moneda":"EUR",
                "id":"ext-record-519"                
            },{
                "idticket":41139,
                "idtrayecto":1,
                "trayecto":"Billund » Buenos Aires",
                "idconcepto":999,
                "concepto":"Flete Marítimo",
                "tipo":"flete",
                "sel":false,
                "cd":false,                        
                "T/M3":0,"MINIMA":0,
                "equipo_tm3":1600,
                "equipo_minima":1222,
                "moneda":"EUR",
                "id":"ext-record-72"
                    
            }';
        
        $arrayData = json_decode($data);
        
        /*for($i=0;$i<count($trayectoStr);$i++){
            $row = array();
            $row["idticket"] = $idticket;
            $row["idtrayecto"] = $i;
            $row["trayecto"] = utf8_encode($trayectoStr[$i]);
            $row["idconcepto"] = '999';
            $row["concepto"] = utf8_encode('Flete Marítimo');            
            $row["tipo"] = 'flete';
            $data[] = $row;
        }*/
        $this->responseArray = array("success" => true, "data"=>$arrayData);
        $this->setTemplate("responseTemplate");        
        
    }
    
    public function executeCierreMasivo($request) {
        
        $idgroup = 25;
        $iddepartament = 11;
        $idproject = 164;
        $type = 'Sin respuesta';
        $asignado = 'admartinez';
        $status = 1; 
        $respuesta = "Ticket cerrado por el Administrador. Ticket 63734. Cualquier información adicional por favor consultar con el Departamento de Pricing.";
        
        $fechalimite = '2018-12-07';
        $con = Doctrine_Manager::getInstance()->connection();
        
        try{
            $sql = "
                SELECT * 
                FROM ( 
                    SELECT date_part('month',tk.ca_opened) as mes,tk.ca_idticket, tk.ca_title, tk.ca_assignedto, to_char( tk.ca_opened, 'YYYY-MM-DD') as fechacreado, 
                        to_char( tk.ca_opened, 'HH24:MI:SS') as horacreado, to_char(MAX(rs.ca_createdat), 'YYYY-MM-DD') as ult_fch, to_char(MAX(rs.ca_createdat), 'HH24:MI:SS') as ult_hou, gr.ca_iddepartament, 
                        gr.ca_name, tk.ca_login, tk.ca_opened as ca_fchcreado, MAX(rs.ca_createdat) as fch_ultseg, tk.ca_percentage, s.ca_nombre, e.ca_nombre as empresa 
                    FROM helpdesk.tb_tickets tk 
                        LEFT JOIN helpdesk.tb_responses rs ON tk.ca_idticket=rs.ca_idticket 
                        LEFT OUTER JOIN helpdesk.tb_groups gr ON (tk.ca_idgroup = gr.ca_idgroup) 
                        INNER JOIN control.tb_usuarios u ON u.ca_login = tk.ca_login 
                        INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal 
                        INNER JOIN control.tb_empresas e ON s.ca_idempresa = e.ca_idempresa 
                        WHERE tk.ca_closedat IS NULL and ( gr.ca_idgroup = $idgroup ) 
                    GROUP BY tk.ca_opened, tk.ca_idticket, tk.ca_title, tk.ca_assignedto, fechacreado, horacreado, tk.ca_login, gr.ca_iddepartament, gr.ca_name, tk.ca_percentage, s.ca_nombre, e.ca_nombre
                    ORDER BY tk.ca_idticket ) as consulta 
                    WHERE ult_fch <= '2019-01-09' AND consulta.ca_iddepartament = $iddepartament AND ca_percentage<='100' AND consulta.fechacreado < '$fechalimite'";

            $st = $con->execute($sql);
            $datos = $st->fetchAll();
            $i=1;
            foreach ($datos as $d){
                $idticket = $d["ca_idticket"];
                $ticket = Doctrine::getTable("HdeskTicket")->find($d["ca_idticket"]);

                $ticket->setCaIdproject($idproject);
                $ticket->setCaType($type);
                $ticket->setCaAssignedto($asignado);
                $ticket->setCaStatus($status);
                $ticket->save($con);
                
                $request->setParameter("idticket", $idticket);
                $request->setParameter("respuesta", $respuesta);                    
                $suc = $this->executeGuardarRespuestaTicket($request);
                
                $request->setParameter("idticket", $idticket);                    
                $success = $this->executeCerrarTicket($request);

                echo $success."<br/>";
            }
            $con->commit();
        }catch(Exception $e){
            $con->rollback();
            echo $e->getMessage();
            exit();
        }
        
        $this->setTemplate("responseTemplate");    
    }
    
    
    public function executeCierreAutomatico($request) {
        
        $ticket = $request->getParameter("ticket");
        $ticket->save();
        $respuesta = $request->getParameter("respuesta");        
        
        $request->setParameter("idticket", $ticket->getCaIdticket());
        $request->setParameter("respuesta", $respuesta);                    
        $suc = $this->executeGuardarRespuestaTicket($request);

        $request->setParameter("idticket", $ticket->getCaIdticket());        
        $success = $this->executeCerrarTicket($request);        
    }
}