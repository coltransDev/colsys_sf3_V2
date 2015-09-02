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
        
        if (!$nivel || $nivel<0) {
            $nivel = 0;
        }
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
                $q->addWhere("h.ca_idticket = ?", intval($criterio));
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
                break;
        //exit($q->getSql());
        $this->tickets = $q->execute();


        $idticket = $request->getParameter("id");

        if (!$this->nivel) {
            $this->nivel = 0;
        }
                if ($groupby == "project") {

                $q->addWhere("(h.ca_login = ? OR uggg.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getUserid()));
                break;
            case 2:
                $q->addWhere("(h.ca_login = ? OR g.ca_iddepartament = ? or hu.ca_login = ?)", array($this->getUser()->getUserid(), $this->getUser()->getIddepartamento(), $this->getUser()->getUserid()));


        $this->usuarios = Doctrine::getTable("Usuario")->createQuery("u")
        }


        $q->distinct();

        $idticket = $request->getParameter("idticket");


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
        $this->groupby = $groupby;

        $this->nivel = $nivel;
        
    }

    /**
     * Vista previa de un ticket y permite adicionar respuestas
     *
     * @param sfRequest $request A request object
     */
    public function executeVerTicket(sfWebRequest $request) {

        $this->nivel = $this->getUser()->getNivelAcceso(helpdeskActions::RUTINA);
        
        //echo "189".$this->nivel;
        $this->iddepartamento = $this->getUser()->getIddepartamento();
    public function executeResponseTickets(sfWebRequest $request) {
        //$folder1=$request->getParameter("folder");
        $folder1="COLSYS";
        $debug=$request->getParameter("debug");
        //exit;
        //try
        {
            ProjectConfiguration::registerZend();
            Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
            Zend_Loader::loadClass('Zend_Gdata_Gapps');
            $pass = 'cglti$col91';
            $mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
            $mail->selectFolder($folder1);
            
            foreach ($mail as $messageNum => $message) {
                if ($message->hasFlag(Zend_Mail_Storage::FLAG_SEEN)) {
                    continue;
                }
              
                $from = $message->from;
                $part = $message;
                

                $sender = trim(utf8_encode($message->from));
                preg_match('/<(.*?)>/s', $sender, $matches);
                $from =$matches[1];
//                echo $sender_mail;
                
                $ticket_regex = "/#[0-9]+/";
            
                preg_match_all($ticket_regex, $message->subject, $matches_ticket);
                $idticket=  str_replace("#","",$matches_ticket[0][0]);
                //echo $idticket;
                //echo $message->getPart(2)->getContent();
                //exit;

                while ($part->isMultipart()) {
                    try{
                        for($i=1;$i<=1;$i++)
                        {

                            $part = $message->getPart($i);
                            //if($debug=="true")
                            {
                                //echo "<br><b>{$i}</b><br>";
                                //echo "<pre>";
                                //print_r($part->getContent());
                                //echo "<pre>";
                                $mess=$part->getContent();

                                $p=strpos($mess, "Colsys Notificaciones");


                                if($p>=0)
                                {
                                  $p=$p-130;
                                }
                                $mess = substr($mess, 0, $p);//message.substring(p + 1, message); //now get the address  
                                $mess.="<br><span style='font-size:9px'><b>response from google app-script</b></span>"; 

                                $request->setParameter("idticket",$idticket);
                                $request->setParameter("comentario",$mess);

                                $user = Doctrine::getTable("Usuario")
                                ->createQuery("u")
                                ->select("u.ca_login")
                                ->where("u.ca_email = ? ", $from)
                                ->addWhere("u.ca_activo = true ")
                                ->limit(1)
                                ->fetchOne();


                                $request->setParameter("idticket",$idticket);
                                $request->setParameter("comentario",$mess);
                                $request->setParameter("iduser",$user->getCaLogin());

                                $this->executeGuardarRespuestaTicket($request);




                            }

                        }
                    }  catch (Exception $e)
                            {
                                
                                Utils::sendEmail(
                                    array(
                                        "from"=>"colsys@coltrans.com.co",
                                        "to"=>"admin@coltrans.com.co",
                                        "subject"=>"Error en tickets email",
                                        "body"=>"Error en tickets",
                                        "mensaje"=> "Se presento el siguiente error al tratar de dar respuesta al ticket: {$idticket} ". $e->getTraceAsString()
                                    )
                                );
                            }
                    
                }
                $uniq_id = $mail->getUniqueId($messageNum);
                $messageId = $mail->getNumberByUniqueId($uniq_id);
                $mail->moveMessage($messageId, $folder1."P");

            }
        }
        /*catch(Exception $e)
        {
            echo $e->getMessage();
           
        }*/
        exit;
    }    
}
?>
