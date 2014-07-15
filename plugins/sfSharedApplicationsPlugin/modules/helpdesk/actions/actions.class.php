<?php

/**
 * helpdesk actions.
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
class helpdeskActions extends sfActions {

    const RUTINA = "39";

    public function preExecute() {
        $this->app = sfContext::getInstance()->getConfiguration()->getApplication();
        if ($this->app == "intranet") {
            $this->setLayout("layout1col");
            $response = sfContext::getInstance()->getResponse();
            $response->addJavaScript("blog", 'last');
        }
        parent::preExecute();
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {


        $this->user = $this->getUser();

        $this->nivel = $this->getUser()->getNivelAcceso(helpdeskActions::RUTINA);
        //echo $this->getUser()->getUserId()." ".$this->nivel;
        if (!$this->nivel) {
            $this->nivel = 0;
        }
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeListaTickets(sfWebRequest $request) {

        $nivel = $this->getUser()->getNivelAcceso(helpdeskActions::RUTINA);
        $opcion = $request->getParameter("opcion");
        $criterio = $request->getParameter("criterio");
        $groupby = $request->getParameter("groupby");

        $q = Doctrine_Query::create()
                ->select("h.*")
                ->from('HdeskTicket h');
        $q->innerJoin("h.HdeskGroup g");
        $q->leftJoin("h.HdeskTicketUser hu  ");
        switch ($opcion) {
            case "numero":
                if (intval($criterio)) {
                    $ticket = Doctrine::getTable("HdeskTicket")->find(intval($criterio));
                    if ($ticket) {
                        $this->redirect("helpdesk/verTicket?id=" . $ticket->getCaIdticket());
                    }
                }
                break;
            case "criterio":
                $q->innerJoin("h.HdeskResponse r");
                $q->where("(h.ca_title like ?  or r.ca_text like ?) ", array("%" . strtolower($criterio) . "%", "%" . strtolower($criterio) . "%"));
                $q->addOrderBy("h.ca_idgroup");
                $q->addOrderBy("h.ca_idproject");
                $q->addOrderBy("h.ca_closedat DESC");
                $q->addOrderBy("h.ca_opened");
                break;
            case "personalizada":

                if ($request->getParameter("departamento")) {

                    $q->addWhere("g.ca_iddepartament = ? ", $request->getParameter("departamento"));
                }

                if ($request->getParameter("area")) {
                    $q->addWhere("h.ca_idgroup = ? ", $request->getParameter("area"));
                }

                if ($request->getParameter("project")) {
                    $q->addWhere("h.ca_idproject = ? ", $request->getParameter("project"));
                }

                if ($request->getParameter("priority")) {
                    $q->addWhere("h.ca_priority = ? ", $request->getParameter("priority"));
                }


                if ($request->getParameter("actionTicket")) {
                    if ($request->getParameter("actionTicket") == "Cerrado") {
                        $q->addWhere("h.ca_closedat IS NOT NULL");
                    } else {
                        $q->addWhere("h.ca_closedat IS NULL");
                    }
                }

                if ($request->getParameter("type")) {
                    $q->addWhere("h.ca_type = ? ", $request->getParameter("type"));
                }


                if ($request->getParameter("assignedto")) {
                    $q->addWhere("h.ca_assignedto = ? ", $request->getParameter("assignedto"));
                }

                if ($request->getParameter("reportedby")) {

                    $q->addWhere("(h.ca_login = ? or hu.ca_login = ?)", array($request->getParameter("reportedby"), $request->getParameter("reportedby")));
                }


                $q->addOrderBy("h.ca_idgroup ASC");
                if ($groupby == "project") {
                    $q->addOrderBy("h.ca_idproject ASC");
                }
                $q->addOrderBy("h.ca_closedat DESC");
                $q->addOrderBy("h.ca_opened ASC");

                break;

            case "group":

                $q->innerJoin("g.HdeskUserGroup ugg ");
                $q->addWhere("( ugg.ca_login = ?)", $this->getUser()->getUserid());

                if ($request->getParameter("assigned")) {
                    if ($request->getParameter("assigned") == "true") {
                        $q->addWhere("h.ca_assignedto IS NOT NULL");
                    } else {
                        $q->addWhere("h.ca_assignedto IS NULL");
                    }
                }
                $q->addWhere("h.ca_closedat IS NULL");
                $q->addOrderBy("h.ca_idgroup");

                if ($groupby == "project") {
                    $q->addOrderBy("h.ca_idproject DESC");
                }
                $q->addOrderBy("h.ca_opened DESC");
                break;
        }

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
            case 2:
                $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento()));
                break;
        }


        $q->distinct();
        //exit($q->getSql());
        $this->tickets = $q->execute();

        $this->groupby = $groupby;

        $this->nivel = $this->getUser()->getNivelAcceso(helpdeskActions::RUTINA);
    }

    /**
     * Vista previa de un ticket y permite adicionar respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeVerTicket(sfWebRequest $request) {

        $this->nivel = $this->getUser()->getNivelAcceso(helpdeskActions::RUTINA);
        $this->iddepartamento = $this->getUser()->getIddepartamento();

        $idticket = $request->getParameter("id");

        if (!$this->nivel) {
            $this->nivel = 0;
        }

        if ($this->nivel > 0 && $this->app != "intranet") {
            $this->redirect("pm/index?idticket=" . $idticket);
        }


        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);
        $this->forward404Unless($this->ticket);

        if ($request->getParameter("format") == "email") {
            $this->setTemplate("verTicketEmail");
            $this->setLayout("none");
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

        $directorio = $this->ticket->getDirectorioBase();

        $this->usuarios = Doctrine::getTable("Usuario")->createQuery("u")
                ->innerJoin("u.HdeskTicketUser ug")
                ->where("ug.ca_idticket = ?", $this->ticket->getCaIdticket())
                ->addOrderBy("u.ca_nombre")
                ->execute();
        
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $directorio . DIRECTORY_SEPARATOR;
        
        if (!is_dir($directorio)) {
            @mkdir($directorio, 0777, true);
        }
        chmod($directorio, 0777);

        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
        
        $filenames = array();
        
        foreach ($archivos as $archivo) {
            $file = explode("/", $archivo);
            $filenames[]["file"] = $file[count($file) - 1];
        }
        $this->folder = $directorio;
        $this->filenames = $filenames;
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarRespuestaTicket(sfWebRequest $request) {

        $this->nivel = $this->getUser()->getNivelAcceso(helpdeskActions::RUTINA);
        $idticket = $request->getParameter("idticket");
        $ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);
        $this->forward404Unless($ticket);



        $user = $this->getUser();

        $respuesta = new HdeskResponse();
        $respuesta->setCaIdticket($request->getParameter("idticket"));
        $respuesta->setCaText(utf8_decode($request->getParameter("comentario")));
        $respuesta->setCaLogin($user->getUserId());
        $respuesta->setCaCreatedat(date("Y-m-d H:i:s"));
        $respuesta->save();

        $logins = array($ticket->getCaLogin());
        if ($ticket->getCaAssignedto()) {
            $logins[] = $ticket->getCaAssignedto();
        } else {
            $usuarios = Doctrine::getTable("HdeskUserGroup")
                    ->createQuery("h")
                    ->where("h.ca_idgroup = ? ", $ticket->getCaIdgroup())
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



        if ($ticket->getCaAssignedto() == $this->getUser()->getUserId() || in_array($this->getUser()->getUserId(), $logins)) {
            $tarea = $ticket->getTareaIdg();
            if ($tarea) {
                if (!$tarea->getCaFchterminada()) {
                    $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                    $tarea->setCaUsuterminada($this->getUser()->getUserId());
                    $tarea->save();
                }
            }
        }

        $email = new Email();
        $email->setCaUsuenvio($this->getUser()->getUserId());
        $email->setCaTipo("Notificación");
        $email->setCaIdcaso($ticket->getCaIdticket());
        $email->setCaFrom("no-reply@coltrans.com.co");
        $email->setCaFromname("Colsys Notificaciones");


        $email->setCaSubject("Nueva respuesta Ticket #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]");

        $texto = "Se ha creado una respuesta \n\n<br /><br />";
        $request->setParameter("id", $ticket->getCaIdticket());
        $request->setParameter("format", "email");
        $texto.= sfContext::getInstance()->getController()->getPresentationFor('pm', 'verTicket');

        $email->setCaBodyhtml($texto);

        foreach ($logins as $login) {

            if ($this->getUser()->getUserId() != $login) {
                $usuario = Doctrine::getTable("Usuario")->find($login);
                $email->addTo($usuario->getCaEmail());
            }
        }

        $this->setLayout("none");

        $email->save();
        //$email->send();

        $this->ticket = $ticket;
    }

    /**
     * Adjunta un archivo a un ticket
     *
     * @param sfRequest $request A request object
     */
    public function executeVerArchivo(sfWebRequest $request) {
        $this->nivel = $this->getUser()->getNivelAcceso(helpdeskActions::RUTINA);
        $this->iddepartamento = $this->getUser()->getIddepartamento();


        if (!$this->nivel) {
            $this->nivel = 0;
        }
        $idticket = $request->getParameter("id");
        $this->ticket = HdeskTicketTable::retrieveIdTicket($idticket, $this->nivel);
        $this->forward404Unless($this->ticket);

        $directory = $this->ticket->getDirectorio();

        $filename = base64_decode($request->getParameter("file"));
        $this->file = $directory . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($this->file)) {
            $this->forward404();
        }
    }
}
?>