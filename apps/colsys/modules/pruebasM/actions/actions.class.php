<?php

/** * pruebas actions.
 *
 * @package    colsys
 * @subpackage pruebas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pruebasMActions extends sfActions {


    public function executeRedimensionarImagen($request) {
        $users = Doctrine::getTable("Usuario")->createQuery("u")->execute();
        foreach ($users as $user) {

            if ($user->getCaActivo()) {
                $username = $user->getCaLogin();

                //indicamos el directorio donde se van a colgar las imï¿½genes
                $imagen = 'E:\\Desarrollo\\digitalFile\\Usuarios\\' . $username . '\\foto120x150.jpg';
                $nombre_imagen_asociada = 'foto60x80.jpg';
                $directorio = 'E:\\Desarrollo\\digitalFile\\Usuarios\\' . $username . '\\';
                //establecemos los lï¿½mites de ancho y alto
                $nuevo_ancho = 60;
                $nuevo_alto = 80;

                //Recojo informaciï¿½n de la imï¿½gen
                $info_imagen = getimagesize($imagen);
                $alto = $info_imagen[1];
                $ancho = $info_imagen[0];
                $tipo_imagen = $info_imagen[2];

                //Determino las nuevas medidas en funciï¿½n de los lï¿½mites
                if ($ancho > $nuevo_ancho OR $alto > $nuevo_alto) {
                    if (($alto - $nuevo_alto) > ($ancho - $nuevo_ancho)) {
                        $nuevo_ancho = round($ancho * $nuevo_alto / $alto, 0);
                        echo 'primer if';
                    } else {
                        $nuevo_alto = round($alto * $nuevo_ancho / $ancho, 0);
                        echo 'segundo if';
                    }
                } else { //si la imagen es mï¿½s pequeï¿½a que los lï¿½mites la dejo igual.
                    $nuevo_alto = $alto;
                    $nuevo_ancho = $ancho;
                    echo 'tercer if';
                }

                $imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                $imagen_vieja = imagecreatefromjpeg($imagen);
                //cambio de tamaï¿½o?
                imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
                if (!imagejpeg($imagen_nueva, $directorio . $nombre_imagen_asociada)) {
                    echo "error";
                };
                //rename($directorio . "foto.jpg", $directorio . "foto120x150.jpg");

                $this->setTemplate("blank");
            }
        }//return true; //si todo ha ido bien devuelve true
    }

    
    

    public function executeEmailRefMaritimo() {
        $this->setLayout("email");
    }

    public function executeEmailRefxNotificar(sfWebRequest $request) {

        if ($request->isMethod('post')) {
            $refs = $request->getParameter("referencia");
            foreach ($refs as $r) {
                $master = Doctrine::getTable("InoMaestraSea")->find($r);
                //echo $master->getCaReferencia();
                $nevios = $master->getProperty("nenvios") + 1;
                $master->setProperty("nenvios", $nevios);
                $master->save();
            }
        }


        $databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases.yml');
        $dsn = explode("=", $databaseConf ['all']['doctrine']['param']['dsn']);
        $host = $dsn[count($dsn) - 1];
        $con = Doctrine_Manager::connection(new PDO("pgsql:dbname=Coltrans;host={$host}", 'Administrador', 'V9p0%rRc9$'));

        $fecha = Utils::addDate(date("Y-m-d"), 0, -2);
        $fecha1 = Utils::addDate(date("Y-m-d"), 0, -3);
        $sql = "SELECT r.ca_idreporte,r.ca_consecutivo,r.ca_version,r.ca_versiones,r.ca_fchllegada,r.ca_fchsalida,ca_ciuorigen,ca_ciudestino,ca_login,ca_nombre_cli,r.ca_usucreado,r.ca_fchcreado,
                (EXTRACT(EPOCH FROM age(date(r.ca_fchllegada),date(r.ca_fchsalida) ) )/86400 ) dtransito,
                (EXTRACT(EPOCH FROM age('now()',date(r.ca_fchsalida) ) )/86400) dtransitoactual
            from vi_reportes2 r
            where r.ca_fchcreado>'" . $fecha . "' and ca_consecutivo not in(
            select ca_consecutivo from tb_reportes r,tb_inoclientes_sea ic where r.ca_fchcreado>'" . $fecha1 . "' and r.ca_idreporte=ic.ca_idreporte
            )
            and ca_impoexpo='Importaciï¿½n' and ca_transporte='Marï¿½timo'
            and r.ca_tiporep<>4 and r.ca_fchllegada is not null
            /*and ( SELECT max(rr.ca_version) AS max
                FROM tb_reportes rr
               WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text)=r.ca_version
               and r.ca_fchllegada>now()*/
            order by r.ca_fchllegada,r.ca_consecutivo , r.ca_version desc ";
        //echo $sql;
        $st = $con->execute(utf8_encode($sql));
        $reportes = $st->fetchAll();
        $nrep = "0";
        $this->reportes = array();
        foreach ($reportes as $k => $r) {
            //echo $nrep."--".$r["ca_consecutivo"]."<br>";
            if ($r["ca_versiones"] == $r["ca_version"] && Utils::compararFechas(date("Y-m-d"), $r["ca_fchllegada"]) <= 0) {
//                if($r["ca_fchllegada"])
//                    echo $r["ca_consecutivo"]."::::".date("Y-m-d") ."::::::::". $r["ca_fchllegada"]."::::::::".Utils::compararFechas(date("Y-m-d"),$r["ca_fchllegada"])."<br>";
                $r["%transito"] = round((($r["dtransitoactual"] / $r["dtransito"])) * 100);
                $this->reportes[] = $r;
            }
            $nrep = $r["ca_consecutivo"];
        }
        //print_r($this->reportes);

        $sql = "select m.ca_referencia,m.ca_fchreferencia,m.ca_fchcreado,m.ca_provisional,m.ca_modalidad,m.ca_motonave,m.ca_fchembarque,
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

        $this->refBloqueadas = array();
        $this->refRechazadas = array();
        $this->refSinMuisca = array();
        $this->refSinAceptar = array();
        foreach ($this->referencias as $ref) {
            if (trim($ref["ca_provisional"]) == "1") {
                $nenvios = 0;
                /* $prop=explode(" ", $ref["ca_propiedades"]);
                  foreach( $prop as $p)
                  {

                  }
                 * 
                 */
                $array = sfToolkit::stringToArray($ref["ca_propiedades"]);

                $ref["nenvios"] = $array["nenvios"];
                $ref["ttransito"] = $ref["dtransito"];
                $ref["%transito"] = (($ref["dtransitoactual"] / $ref["dtransito"])) * 100;
                $ref["ttransitoctual"] = $ref["dtransitoactual"];

                $ref["tantecedentes"] = $ref["dantecedentes"];
                $ref["%antecedentes"] = (($ref["dantecedentesactual"] / $ref["dantecedentes"])) * 100;
                $ref["tantecedentesctual"] = $ref["dantecedentesactual"];

                if ($ref["ca_estado"] == "R")
                    $this->refRechazadas[] = $ref;
                else if ($ref["ca_estado"] == "E")
                    $this->refSinAceptar[] = $ref;
                else
                    $this->refBloqueadas[] = $ref;
            }
        }
        //$this->setLayout("email");
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
        foreach ($emails as $email) {
            try {
                $email->setCaSubject(date("Y-m-d H:i:s"));
                $email->send1();
            } catch (Exception $e) {
                echo $e . "<br />";

                $data = array();
                $data["mensaje"] = "Id Email: " . $email->getCaIdemail() . "<br />" . $e->getMessage() . "<br />" . $e->getTraceAsString();
                Utils::sendEmail($data);
            }
        }
        exit;
    }

    public function executeWs(sfWebRequest $request) {
        ProjectConfiguration::registerZend();
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');

        //$client = Zend_Gdata_ClientLogin::getHttpClient("maquinche", "80166236", Zend_Gdata_Gapps::AUTH_SERVICE_NAME);
        //$gdata = new Zend_Gdata_Gapps($client, 'coltrans.co');
        //$gdata->updateUser("colsys", "cglti$col9110");
        $email = "maquinche@coltrans.co";
        $password = "80166236";
        $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, Zend_Gdata_Gapps::AUTH_SERVICE_NAME);
        $gdata = new Zend_Gdata_Gapps($client, 'coltrans.co');

        $data = $gdata->retrievePageOfUsers($startUsername = null);
        echo "<table border=1><tr> <td>UserName</td>
            <td>name</td>
            <td>LastName</td>
            <td>Suspended</td>
            <td>admin</td>
            <td>changePasswordAtNextLogin</td>
            <td>agreedToTerms</td>
            </tr>";
        foreach ($data as $user) {
            echo "<tr> <td>" . $user->login->userName . "</td>
            <td>" . $user->name->givenName . "</td>
            <td>" . $user->name->familyName . "</td>
            <td>" . ($user->login->suspended ? 'Yes' : 'No') . "</td>
            <td>" . ($user->login->admin ? 'Yes' : 'No') . "</td>
            <td>" . ($user->login->changePasswordAtNextLogin ? 'Yes' : 'No') . "</td>
            <td>" . ($user->login->agreedToTerms ? 'Yes' : 'No') . "</td>";
        }
        echo "</table>";

        exit;
    }

    public function executeMail() {

        /* $ref="42050111623-99192013-11-22-111136.pdf";        
          $ref[0] =  substr($ref[0], 0,3).".".substr($ref[0], 3,2).".".substr($ref[0], 5,2).".".substr($ref[0], 7,3).".".substr($ref[0], 10,1);

          exit; */
        ProjectConfiguration::registerZend();
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');
        $pass = 'cglti$col91';
        $mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
        /* $mail = new Zend_Mail_Storage_Pop3(array('host'     => 'imap.gmail.com',
          'user'     => 'colsys@coltrans.com.co',
          'password' => $pass)); */

        //$folder = $mail->getFolders()->FACTURAS;
        //echo $forlder->countMessages()."-";
        $mail->selectFolder("FACTURAS");
        //$mail->selectFolder("MAURICIO");
        //echo $mail->countMessages();

        foreach ($mail as $messageNum => $message) {
            if ($message->hasFlag(Zend_Mail_Storage::FLAG_SEEN)) {
                continue;
            }

            $from = $message->from;
            /*             * *********************************** */
            $part = $message;

            while ($part->isMultipart()) {
                $part = $message->getPart(1);
                try {
                    $fileName = $part->getHeader('content-description');
                    $attachment = base64_decode($part->getContent());
                    $size = strlen($attachment);
                    //$directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR;
                    $mime = explode(";", $part->getHeader('content-type'));
                    $mime = $mime[0];
                    $asunto = substr($fileName, 0, strlen($fileName) - 21);
                    $ref = array();
                    $ref[] = substr($asunto, 0, 11);
                    $ref[] = substr($asunto, 12, 4);
                    $data = array();

                    $ref[0] = str_replace(".", "", $ref[0]);
                    $ref[0] = substr($ref[0], 0, 3) . "." . substr($ref[0], 3, 2) . "." . substr($ref[0], 5, 2) . "." . substr($ref[0], 7, 3) . "." . substr($ref[0], 10, 1);

                    $data["ref1"] = $ref[0];
                    if (isset($ref[1])) {
                        $sql = "select  ca_hbls from tb_inoclientes_sea 
                        where ca_referencia='" . $ref[0] . "' and UPPER(substring(ca_hbls from (char_length(ca_hbls)-3) ))= UPPER('" . $ref[1] . "') limit 1";
                        $con = Doctrine_Manager::getInstance()->connection();

                        $st = $con->execute($sql);
                        $resul = $st->fetchAll();
                        $data["ref2"] = $resul[0]["ca_hbls"];
                    }
                    $data["iddocumental"] = "7";

                    if ($data["ref1"])
                        $path.=$data["ref1"] . DIRECTORY_SEPARATOR;
                    if ($data["ref2"])
                        $path.=$data["ref2"] . DIRECTORY_SEPARATOR;

                    $archivo = new Archivos();
                    $archivo->setCaIddocumental($data["iddocumental"]);
                    $archivo->setCaNombre($fileName);
                    $archivo->setCaRef1($data["ref1"]);
                    $archivo->setCaRef2($data["ref2"]);
                    $archivo->setCaMime($mime);
                    $archivo->setCaSize($size);
                    $tipDoc = $archivo->getTipoDocumental();
                    $folder = $tipDoc->getCaDirectorio();
                    $directory = sfConfig::get('app_digitalFile_root') . date("Y") . DIRECTORY_SEPARATOR . $folder . $path;
                    $archivo->setCaPath($directory . $fileName);
                    $archivo->save();
                    $fh = fopen($directory . $fileName, 'w');
                    fwrite($fh, $attachment);
                    fclose($fh);
                    //print_r($data);
                    //echo $directory.$fileName;
                } catch (Excepcion $e) {
                    
                }
            }


            /*             * *********************************** */

//            $mail->setFlags($messageNum,array(Zend_Mail_Storage::FLAG_SEEN));
            //echo "<pre>";print_r($message->getHeaders());echo "</pre>";
            //$from=$request->getParameter("from");
            //$from=$request->getParameter("from");

            /* $part = $message;            
              while ($part->isMultipart()) {
              $part = $message->getPart(1);
              $fileName = $part->getHeader('content-description');
              $attachment = base64_decode($part->getContent());
              $directory = sfConfig::get('app_digitalFile_root').date("Y").DIRECTORY_SEPARATOR;
              $fh = fopen($directory.$fileName, 'w');
              fwrite($fh, $attachment);
              fclose($fh);
              exit;
              } */
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


        /* echo $mail->countMessages();
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
          } */
        //$mail->
        exit;
    }

    public function executeCalendar(sfWebRequest $request) {
        ProjectConfiguration::registerZend();
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');


        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
                $user="maquincher@coltrans.com.co";
          $pass="80166236";
          $keypass="528a6254afc2a026066fceb0b89e4094";
          $mailpass="pHaonZJtaWc=";

        $usuario = new Usuario();
        $pass = $usuario->getDecrypt($mailpass, $keypass);
        //echo $pass;

        $user = "maquinche@coltrans.com.co";
        $pass = "80166236";

        // Create an authenticated HTTP client
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);

        // Create an instance of the Calendar service
        $service = new Zend_Gdata_Calendar($client);




        try {
            $listFeed = $service->getCalendarListFeed();
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
            /* echo "<pre>";
              print_r($event);
              echo "</pre>"; */
            $eventURL = $event->link;

            try {
                $event = $service->getCalendarEventEntry($eventURL);
            } catch (Zend_Gdata_App_Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        echo "</ul>";

        /* $event= $service->newEventEntry();

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

    public function executeColsysNotification(sfWebRequest $request) {
        $subject = "Nueva respuesta Ticket #3341 [EQUIPO LENTO]";
        $resp = "prueba:" . date("Y-m-d");
        $from = "maquinche@coltrans.com.co";
        $from = "maquinche@coltrans.com.co";
        //$string = '"Joe Smith" <jsmith@example.com>, kjones@aol.com; someoneelse@nowhere.com mjane@gmail.com';
        $email_regex = "/[^0-9< ][A-z0-9_]+([.][A-z0-9_]+)*@[A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}/";
        preg_match_all($email_regex, $from, $matches);
        $emails = $matches[0];
        echo ($emails[0]);
        exit;

        try {
            $id = 0;
            $subject = str_replace("Re: ", "", $subject);

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

            if ($email) {
                //$conn = Doctrine::getTable("HdeskResponse")->getConnection();
                //$conn->beginTransaction();
                try {

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


                    $respuesta->save();


                    $logins = array($ticket->getCaLogin());
                    if ($ticket->getCaAssignedto()) {
                        $logins[] = $ticket->getCaAssignedto();
                    } else {
                        $usuarios = Doctrine::getTable("HdeskUserGroup")
                                ->createQuery("h")
                                ->innerJoin("h.Usuario u")
                                ->addWhere("h.ca_idgroup = ? ", $ticket->getCaIdgroup())
                                ->addWhere("u.ca_activo = ? ", true)
                                ->addOrderBy("h.ca_login")
                                ->execute();
                        foreach ($usuarios as $usuario) {
                            $logins[] = $usuario->getCaLogin();
                        }
                    }


                    $email1 = new Email();
                    $email1->setCaUsuenvio($this->getUser()->getUserId());
                    $email1->setCaTipo("Notificaciï¿½n");
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

                    $email1->save();


                    //$conn->commit();
                    //$request->setParameter("format", "");
                    //$texto = sfContext::getInstance()->getController()->getPresentationFor('pm', 'verRespuestas');
                    //$this->responseArray = array("success" => true, "idticket" => $ticket->getCaIdticket(), "info" => utf8_encode($texto));
                } catch (Exception $e) {
                    //$conn->rollback();
                    print_r($e);
                    //$this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
                }
            } else {
                $id = $subject;
                echo $subject . ":" . $respuesta . ":" . $from;
                exit;
            }
            return $id;
        } catch (Exception $e) {
            print_r($e);
            //echo "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"];//." u:".$usuario."-nu:".$newUsuario;
        }
        //exit;
    }

    public function executeExt4(sfWebRequest $request) {
        $tipo = $request->getParameter("tipo");
        switch ($tipo) {
            case "grid":
                $this->setTemplate("gridExt4");
                break;
            case "multiupload":
                $this->setTemplate("multipleUploadExt4");
                break;
            case "formUpload":
                $this->getResponse()->setCookie('back_refer', (($this->getRequest()->getCookie('back_refer') != "") ? $this->getRequest()->getCookie('back_refer') : $request->getReferer()));
                $this->idsserie = ($this->getRequestParameter("idsserie") != "") ? $this->getRequestParameter("idsserie") : "2";

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

                $this->years = array();

                for ($i = 0; $i < 5; $i++) {
                    $this->years[] = array("year" => date('Y') - $i);
                }

                $this->meses = array();
                //$this->meses[]=array("id" => "%","valor" => "Todos los Meses");
                for ($i = 1; $i <= 12; $i++) {
                    $this->meses[] = array("id" => $i, "valor" => Utils::mesLargo($i));
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
                
                
                $ciudades = Doctrine::getTable('Ciudad')->createQuery('c')
                        ->where('c.ca_idtrafico = ?', 'CO-057')
                        ->addOrderBy('c.ca_ciudad ASC')
                        ->execute();

        
                $this->ciudadDestino = array();
                foreach ($ciudades as $c) {
                    $this->ciudadDestino[] = array("valor" => utf8_encode($c->getCaCiudad()),
                        "id" => $c->getCaIdciudad()
                    );
                }
                
                $this->criterios = array(
                    array("id"=>"ca_ano","valor"=>"Aï¿½o"),
                    array("id"=>"ca_mes","valor"=>"Mes"),
                    array("id"=>"ca_sucursal","valor"=>"Sucursal"),
                    array("id"=>"ca_traorigen","valor"=>"Trï¿½fico"),
                    array("id"=>"ca_vendedor","valor"=>"Vendedor"),
                    array("id"=>"ca_compania","valor"=>"Clientes"),
                    array("id"=>"ca_estado","valor"=>"Estado"),
                    array("id"=>"ca_ciudestino","valor"=>"Puerto/Destino"),
                    array("id"=>"ca_nomlinea","valor"=>"Naviera")                    
                );            


                $this->setTemplate("reporteador");
                break;
        }
    }

    public function executeDatosVendedores(sfWebRequest $request) {
        $sucursal = utf8_decode($request->getParameter("sucursal"));

        $contactos = UsuarioTable::getUsuariosxPerfil('comercial', null, $sucursal);
        $c1 = array();
        foreach ($contactos as $c) {
            $c1[] = array("id" => $c->getCaLogin(), "valor" => utf8_encode($c->getCaNombre()));
        }
        $this->responseArray = array("root" => $c1, "total" => count($this->c1), "success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeSubirArchivo(sfWebRequest $request) {
        sfConfig::set('sf_web_debug', false);

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
        $this->referer = base64_decode($this->getRequestParameter("referer")); // para que sera???
        //$this->nameFileType=$this->getRequestParameter("namefiletype");

        $template = ($this->getRequestParameter("template") != "") ? $this->getRequestParameter("template") : "responseTemplate";
        $path = "";
        if ($ref1)
            $path.=$ref1 . DIRECTORY_SEPARATOR;
        if ($ref2)
            $path.=$ref2 . DIRECTORY_SEPARATOR;
        if ($ref3)
            $path.=$ref3 . DIRECTORY_SEPARATOR;
//		$this->forward404Unless($folder);
        $directory = sfConfig::get('app_digitalFile_root') . date("Y") . DIRECTORY_SEPARATOR . $folder . $path;
        //echo $directory;
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        chmod($directory, 0777);
        //print_r($_FILES);
        //error_reporting(E_ALL);
        try {
            if (count($_FILES) > 0) {

                $filePrefix = $this->getRequestParameter("filePrefix");
                if ($filePrefix) {
                    $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
                    foreach ($archivos as $archivo) {
                        if (substr(basename($archivo), 0, strlen($filePrefix)) == $filePrefix) {
                            @unlink($archivo);
                        }
                    }
                }

                foreach ($_FILES as $nameFile => $uploadedFile) {
                    //if($uploadedFile['name']=="")
                    //    continue;                    

                    if ($filePrefix) {
                        $fileName = $filePrefix . "_" . $uploadedFile['name'];
                    } else {
                        $fileName = $uploadedFile['name'];
                    }

                    $mime = $uploadedFile['type'];
                    $size = $uploadedFile['size'];
                    $fileName = preg_replace('/\s\s+/', ' ', $fileName);
                    $fileName = urlencode($fileName);
                    $fileName = str_replace("+", " ", $fileName);
                    $nombre = ($nombre != "") ? $nombre : $fileName;
                    if (move_uploaded_file($uploadedFile['tmp_name'], $directory . $fileName)) {

                        $archivo = new Archivos();
                        $archivo->setCaIddocumental($iddocumental);
                        $archivo->setCaNombre($nombre);
                        $archivo->setCaMime($mime);
                        $archivo->setCaSize($size);
                        $archivo->setCaPath($directory . DIRECTORY_SEPARATOR . $fileName);
                        $archivo->setCaRef1($ref1);
                        $archivo->setCaRef2($ref2);
                        $archivo->setCaRef3($ref3);
                        $archivo->save();
                        $this->responseArray = array("id" => base64_encode($fileName), "file" => $fileName, "folder" => $folder, "success" => true);
                    } else {
                        $this->responseArray = array("error" => "No se pudo mover el archivo", "filename" => $fileName, "folder" => $folder, "success" => false);
                    }
                }
            } else {
                $this->responseArray = array("success" => false);
            }
        } catch (Exception $e) {
            $this->responseArray = array("error" => $e->getMessage(), "success" => false);
        }

        $this->setTemplate($template);
    }

    public function executeEliminarArchivo(sfWebRequest $request) {
        $user = $this->getUser();
        $idarchivo = $request->getParameter("idarchivo");
        $observaciones = $request->getParameter("observaciones");
        $archivo = Doctrine::getTable("Archivos")->find($idarchivo);
        $archivo->setCaFcheliminado(date("Y-m-d H:i:s"));
        $archivo->setCaUsueliminado($user->getUserId());
        $archivo->setCaObservaciones();
        $archivo->save();
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeBackRefer(sfWebRequest $request) {
        $this->back = $this->getRequest()->getCookie('back_refer');
        $this->getResponse()->setCookie('back_refer', "");
    }

    public function executeGappSH(sfWebRequest $request) {

        
         $apiKey="AIzaSyDRs0Hn1L-HPi1xrOqxENrJ1vzsvjobuvM";
         echo  $apiKey;
        // exit;
        
        
        ProjectConfiguration::registerZend();
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_Gapps');
        Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
        Zend_loader::loadClass('Zend_Gdata_Query');
        //$pass='cglti$col91';
        //$mail = new Zend_Mail_Storage_Imap(array('host' => 'imap.gmail.com', 'user' => "colsys@coltrans.com.co", 'password' => $pass, 'ssl' => 'SSL'));
        //$domain = "example.com";

        $pass = 'Cris1035.';
        //$pass = '80166236';
        $user = "maquinche@coltrans.com.co";
        
        
        
        
$email = 'maquinche@coltrans.com.co';
$passwd = '80166236';



$spreadsheetKey = "1mABUDZDOkrsQ_chAq9pgUe2a2uZ0zt6KDd_XbyUXL9c"; //PRUEBA
        //$spreadsheetKey = "0AvsPc4VeV6fjdHloOFZ6LWxJaDJRWkxLaU5IZjMzYWc"; //TRM
        //$spreadsheetKey = "0AjxlblsZLJ8tdE4tRWRjWVFOV1BvX3RKb3ZxekpNdlE"; //trm copy
        //$spreadsheetKey = "1N5iDWW2VKSbzGq2vPPbjCYywfB1GUZmm0gOhhTpL3sQ";//arauco


        
        
        
        $service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
        $spreadsheetService = new Zend_Gdata_Spreadsheets($client);
        //$feed = $spreadsheetService->getSpreadsheetFeed();
        $spreadsheetKey = "1-rI5Jb8PqlBvZJ9u7SGyVUE-8KYj5L24IUduO_faeTw"; //PRUEBA
        //$spreadsheetKey = "0AvsPc4VeV6fjdHloOFZ6LWxJaDJRWkxLaU5IZjMzYWc"; //TRM
        //$spreadsheetKey = "0AjxlblsZLJ8tdE4tRWRjWVFOV1BvX3RKb3ZxekpNdlE"; //trm copy
        //$spreadsheetKey = "1N5iDWW2VKSbzGq2vPPbjCYywfB1GUZmm0gOhhTpL3sQ";//arauco
        $worksheetId = "1";

try{

        $feed = $spreadsheetService->getSpreadsheetFeed();
}  catch (Exception $e)    
{
    print_r($e->getMessage());
}


        
            /*$query = new Zend_Gdata_Spreadsheets_DocumentQuery();
    $query->setSpreadsheetKey($spreadsheetKey);
    $feed = $spreadsheetService->getWorksheetFeed($query);
    print_r($feed);*/

        /*$record = array();

        //$record[0]="A";
        $record["fecha"] = "1/1/2015";
        $record["trm30"] = "4";
        $record["trm"] = "2";
        $record["euro"] = "3";
        //$record[5]="F";


        $insertedListEntry = $spreadsheetService->insertRow($record, $spreadsheetKey, $worksheetId);
*/

        //$feed = $spreadsheetService->getSpreadsheetFeed();
        /* $spreads=$spreadsheetService->getSpreadsheets();

          foreach($spreads as $s) {
          echo $s->title."<br>";
          } */
        //print_r($spread);
        /*
          $query = new Zend_Gdata_Spreadsheets_CellQuery();
          $query->setSpreadsheetKey($spreadsheetKey);
          $query->setWorksheetId($worksheetId);
          $query->setSpreadsheetQuery('fecha=6/11/2014');
          $cellFeed = $spreadsheetService->getCellFeed($query);

          foreach($cellFeed as $cellEntry) {
          $row = $cellEntry->cell->getRow();
          $col = $cellEntry->cell->getColumn();
          $val = $cellEntry->cell->getText();
          echo "$row, $col = $val\n";
          }
         */
        // FUNCIONO
          /*$query = new Zend_Gdata_Spreadsheets_ListQuery();
          $query->setSpreadsheetKey($spreadsheetKey);
          $query->setWorksheetId($worksheetId);
          $listFeed = $spreadsheetService->getListFeed($query);

          $rowData = $listFeed->entries[0]->getCustom();
          foreach($rowData as $customEntry) {
          echo $customEntry->getColumnName() . " = " . $customEntry->getText()."<br>";
          }
         */
        /* $query = new Zend_Gdata_Spreadsheets_DocumentQuery();
          $query->setSpreadsheetKey($spreadsheetKey);
          $feed = $spreadSheetService->getWorksheetFeed($query);
          $entries = $feed->entries[0]->getContentsAsRows();
          echo "<hr><h3>Example 1: Get cell data</h3>";
          echo var_export($entries, true);
         * 
         */


        /* $query = new Zend_Gdata_Spreadsheets_ListQuery();
          $query->setSpreadsheetKey($spreadsheetKey);
          $query->setWorksheetId($worksheetId);
          $listFeed = $spreadsheetService->getListFeed($query);
         */

        /* $query = new Zend_Gdata_Spreadsheets_CellQuery();
          $query->setSpreadsheetKey($spreadsheetKey);
          $query->setWorksheetId($worksheetId);
          $cell = $spreadsheetService->getCellFeed($query);

          foreach($cell as $cellEntry) {
          $row = $cellEntry->cell->getRow();
          $col = $cellEntry->cell->getColumn();
          $val = $cellEntry->cell->getText();
          echo "$row, $col = $val\n";
          } */

        exit;
    }
    
    
    
    
    public function executeGappSH1(sfWebRequest $request) {
        echo date("T-m-d H:i:s");
        exit;
        require_once(sfConfig::get('sf_lib_dir') . '/vendor/Swift/lib/swift_init.php'); # needed due to symfony autoloader
        
            $transport = Swift_SmtpTransport::newInstance("smtp-relay.gmail.com", "25",null);
            
            $transport->setUsername("maquinche@coltrans.com.co")
                    ->setPassword("Cris1035.");
            

            //$transport->setLocalDomain("www.colsys.com.co");
            
            
            Swift_Preferences::getInstance()->setCharset('iso-8859-1');

        $mailer = Swift_Mailer::newInstance($transport);

        $logger = new Swift_Plugins_Loggers_ArrayLogger();
        $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
        
        
            
            
            $message = Swift_Mailer::newInstance($transport);
             //$message = Swift_Message::newInstance("Error al enviar mensaje");
            $message->setFrom(array(trim("maquinche@coltrans.com.co") => "Mauricio Quinche"));
            $message->setSender(trim("maquinche@coltrans.com.co"));
            $message->setReturnPath(trim($this->getCaFrom()));
            
            $message->addTo("maquinche@coltrans.com.co");
            $message->addPart($txt, 'text/plain', 'iso-8859-1');
            $mailer->send($message);
            //$transport->setLocalDomain(sfConfig::get("app_smtp_ip"));
        

        exit;
    }
    
    
    public function executeXls(sfWebRequest $request) {
        //exit("dd");
        //session_start();
        
        $d=json_encode($this->getUser()->getAttribute("xls3"));
        print_r($d);
        //print_r($_SESSION);
        //print_r($this->getUser()->getAttribute('celdas'));
    }
    
    public function executeActualizarTabla(sfWebRequest $request) {
        
        $usuarios = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("ca_donante, ca_enfermedad, ca_alergico")
                ->orderBy("ca_login")
                ->execute();
        
        foreach($usuarios as $usuario){
            //echo $usuario->getCaLogin()."<br/>";
            $brigadas = new UsuBrigadas();
            $brigadas->setCaLogin($usuario->getCaLogin());
            $brigadas->setCaDonante($usuario->getCaDonante());
            $brigadas->setCaEnfermedad($usuario->getCaEnfermedad());
            $brigadas->setCaAlergico($usuario->getCaAlergico());
            $brigadas->save();
            
            echo $brigadas->getCaLogin()."<br/>";
        }
        
        $this->setTemplate("blank");
    }
  
    public function executeWse(sfWebRequest $request) {
        
        /*$wsdl_uri = "https://10.192.1.62/ws/users/usersWS?wsdl";
            $soap = new Zend_Soap_Server($wsdl_uri); 
            $options = array('encoding'=>'ISO-8859-1');
            $soap->setOptions($options);
            $soap->setClass('UserSoap');
            $soap->handle();
         * 
         */
        ProjectConfiguration::registerZend();
        /*    $client = new Zend_Soap_Client( "https://10.192.1.62/ws/colsys/contactsWS?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));        
            $result = $client->actualiza(
                array(
                    a=>"2014",
                    t=>$tipoComprobante->getCaTipo(),
                    nt=>$tipoComprobante->getCaComprobante(),
                    c=>$consecutivo,
                    d=>$tipoComprobante->getCaIdempresa()));
         * 
         */
        
        $client = new Zend_Soap_Client( "https://172.16.1.13/ws/colsys/contactsWS", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
        $result = $client->math_add(2,5);
        //print_r($result);
        /*$client = new Zend_Soap_Client( "https://www.colsys.com.co/ws/colsys/contactsWS?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
        $result = $client->viewReporte("415412");
         */ exit;
//        colsys/contactsWS
    }
    
    
public function executeFixComprobantes(sfWebRequest $request) {
    
        //$conEscritura = Doctrine_Manager::getInstance()->connection();

        /*$sql = "select * from tb_repgastos where ca_idrecargo=61";
        $st = $con->execute($sql);
        $rep = $st->fetchAll();*/
    
    
    

        $con = Doctrine_Manager::getInstance()->getConnection('slave');
        $con->beginTransaction();        
        
        $sql="SELECT * from ino.tb_comprobantes where ca_usuanulado is not null";
        $st = $con->execute($sql);
        $this->resul = $st->fetchAll();
        //echo count($this->resul);
        //echo "<pre>";print_r($this->resul);echo "</pre>";
        foreach ($this->resul as $r)
        {
            //$sql = "update ino.tb_comprobantes set ca_fchanulado=null, ca_usuanulado=null , ca_propiedades=null";
            //$st = $conEscritura->execute($sql);
            //$rep = $st->fetchAll();
            //echo "<pre>";print_r($r);echo "</pre>";
            $c = Doctrine::getTable("InoComprobante")->find($r["ca_idcomprobante"]);
            
            if($c)
            {
                $c->stopBlaming();
                $c->setCaUsuanulado($r["ca_usuanulado"]);
                $c->setCaFchanulado($r["ca_fchanulado"]);
                $c->save();
            }
            //echo $r["ca_propiedades"]."<br>-------<br>";
            //echo $c->getCaPropiedades();
            //echo $c->getCaUsuactualizado();
            //exit;
        }
        echo "finalizo";
        
        
        /*$sql="SELECT brk.DOIIDXXX, brk.DOISFIDX, brk.ADMIDXXX, brk.REGFECXX, brk.REGHORXX, p.PIECIUXX, brk.LINIDXXX, brk.CLIIDXXX, brk.DOCVENXX,
brk.USRID2XX, p.PIENOMXX, q.docpedxx, items.ITECANXX, items.LIMPBRXX, items.ITENOCXX, dep.DAADESXX, brk.DGEFMCXX, modal.MODDESXX
FROM TECOLSYSXX.SIAI0200 AS brk
	INNER JOIN TECOLSYSXX.SIAI0202 AS h ON (brk.DOIIDXXX = h.DOIIDXXX AND brk.DOISFIDX = h.DOISFIDX AND brk.ADMIDXXX = h.ADMIDXXX)
	INNER JOIN TECOLSYSXX.SIAI0125 AS p ON h.PIEIDXXX = p.PIEIDXXX
	INNER JOIN TECOLSYSXX.sys00121 AS q ON (brk.DOIIDXXX = q.docidxxx AND brk.DOISFIDX = q.docsufxx AND brk.ADMIDXXX = q.sucidxxx)
	INNER JOIN TECOLSYSXX.SIAI0205 AS items ON (brk.DOIIDXXX = items.DOIIDXXX AND brk.DOISFIDX = items.DOISFIDX AND brk.ADMIDXXX = items.ADMIDXXX)
	INNER JOIN TECOLSYSXX.SIAI0110 AS dep ON brk.DAAIDXXX = dep.DAAIDXXX
	INNER JOIN TECOLSYSXX.SIAI0203 AS sub ON (items.SUBIDXXX = sub.SUBIDXXX AND brk.DOIIDXXX = sub.DOIIDXXX AND brk.DOISFIDX = sub.DOISFIDX AND brk.ADMIDXXX = sub.ADMIDXXX)
	INNER JOIN TECOLSYSXX.SIAI0121 AS modal ON sub.MODIDXXX = modal.MODIDXXX
WHERE brk.DOIIDXXX = '21010050425' AND brk.DOISFIDX = '001'";
        
        $sql="SELECT brk.DOIIDXXX, brk.DOISFIDX, brk.ADMIDXXX, brk.REGFECXX, brk.REGHORXX, p.PIECIUXX, brk.LINIDXXX, brk.CLIIDXXX, brk.DOCVENXX,
brk.USRID2XX, p.PIENOMXX, q.docpedxx, items.ITECANXX, items.LIMPBRXX, items.ITENOCXX, dep.DAADESXX, brk.DGEFMCXX, modal.MODDESXX
FROM TECOLSYSXX.SIAI0200 AS brk	
WHERE brk.DOIIDXXX = '21010050425' AND brk.DOISFIDX = '001'";
        $st = $con->execute($sql);
        $this->resul = $st->fetchAll();
         * 
         */
        //echo "<pre>";print_r($this->resul);echo "</pre>";
        
        
        exit;
} 


 public function executeWscoldepositos(sfWebRequest $request) {
        
     ProjectConfiguration::registerZend();
            $client = new Zend_Soap_Client("http://wms.coldepositos.com.co/suite/webservices/conceptosfacturacion.php?wsdl", array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 ));
            $result = $client->ConsultarProveedor(
                array(
                    punto=>"CZF1",
                    proveedor=>"LAVASECOMODERNOLTD",
                    //proveedor=>"",
                    identificacion=>"",
                    fecha_inicial=>"2014-08-01",
                    fecha_final=>"2016-08-31"
                ));
            
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            
            exit;
//        colsys/contactsWS
    }
    
   
    public function executeFilelogpostfix(sfWebRequest $request) {
        $file = "/home/mail/mail";

        $reportes = array();
        $lines = file($file);
        //echo count($lines);
        $data=array();
        for ($i = 0; $i < count($lines); $i++) {
            $lines[$i]=str_replace(array("<",">","  "), array("",""," "), $lines[$i]);
            $arrData=  explode(" ", $lines[$i]);
            //echo "<pre>";print_r($arrData);echo "</pre>";
            if($i>800 && $i<1000)
            {
                //echo $lines[$i]."<br>";
                //echo "<pre>";print_r($arrData);echo "</pre>";
            }
            
            /*if( $arrData[4]!="colsys-n2")
            {
                //echo "<pre>";print_r($arrData);echo "</pre>";
                $data[$arrData[0].$arrData[2]][$arrData[6]][]=$arrData;
            }*/

            if(strlen($arrData[5])>10 && $arrData[5]!="statistics:")
            {
                $data[$arrData[0].$arrData[1]][$arrData[5]][]=$arrData;
            }
         
        }
        foreach($data as $f=>$d)
        {
            foreach($d as $k=>$d1)
                $send[$f][$d1[2][6]]++;
        }
        echo "<pre>";print_r($data);echo "</pre>";
        //echo count($data);
        foreach($data as $k=>$d)
            echo $k.":".count($d)."<br>";
        
        //print_r($send);
        
        //foreach($send as $k=>$d)
            //$g=sort($send[$k]);
            
        echo "<pre>";print_r($send);echo "</pre>";
        exit;
    }
    
    
    public function executeActualizaClientesContable(sfWebRequest $request) {
  
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        
        
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
        
        //$directory = "/home/maquinche/Desarrollo/INO 2016/clientes coltrans1.xls";
        $directory = "/srv/www/terceroscoldepolog.xls";
        //echo PHPEXCEL_ROOT;
        $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
        //exit;
        $hojas=array();
        foreach($objPHPExcel->getSheetNames() as $s)
        {
            $hojas[]=array("name"=>$s);
        }
        
//        print_r($hojas);
        $ws = $objPHPExcel->getSheetByName("Sheet2");
        
        $posicion=array();
        $posicion['nit']=0;
        $posicion['tarifareteiva']=35;
        $posicion['porcreteiva']=36;
        $posicion['formapago']=41;
        $posicion['tipo']=43;
        
        $array = $ws->toArray();
        //echo "<pre>";print_r($array[1]);echo "</pre>";
        //exit;
        //foreach( $array as $pos=>$row ){
        /*count($array)*/
        $begin=0; 
        $end=count($array)-1;
        
        $formasPago=array("1"=>"1305050100","20"=>"2335950000","30"=>"1305100100");
        $clasificacionCl=array("1"=>"G","3"=>"C","4"=>"S","6"=>"E");
        for(  $pos=$begin;$pos<$end; $pos++){
            
                $row=$array[$pos];
                
                if($pos==0 /*|| ($row[$posicion['tipo']]!="1" */ )
                {
                    continue;
                }
                
                //($pos==4)
                {
                    //echo "<pre>";print_r($row);echo "</pre>";
                    $viCliente = Doctrine::getTable("Cliente")->findOneBy("ca_idalterno",$row[0]);
                    if($viCliente)
                    {
                        echo $pos ."->".$viCliente->getCaIdcliente()." ".$viCliente->getCaCompania()."-------";

                        $cliente=Doctrine::getTable("IdsCliente")->find( $viCliente->getCaIdcliente() );
                        if($cliente)
                        {
                            /*echo $posicion['tipo']."-".$clasificacionCl[$posicion['tipo']]."<br>";
                            
                            echo $formasPago[$posicion['formapago']]."<br>";
                            
                            echo $formasPago[$posicion['tarifareteiva']]."<br>";
                            
                            echo $formasPago[$posicion['porcreteiva']]."<br>";*/

                            //echo "<pre>";print_r($row);echo "</pre>";
                            //echo $cliente->getProperty("regimen_contributivo")."--".$cliente->getProperty("cuenta_forma_pago_coltrans")."::::::::";
                            $cliente->setProperty("regimen_contributivo",$clasificacionCl[$row[$posicion['tipo']]]);
                            $cliente->setProperty("cuenta_forma_pago_11",$formasPago[$row[$posicion['formapago']]]);
                            $cliente->setProperty("reteiva_11",$row[$posicion['tarifareteiva']]);
                            $cliente->setProperty("porcreteiva_11",$row[$posicion['porcreteiva']]);
                            $cliente->stopBlaming();
                            $cliente->save();
                            //echo $cliente->getProperty("regimen_contributivo")."--".$cliente->getProperty("cuenta_forma_pago_coltrans")."<br><br>";
                           // echo "<br>";
                            echo "Si Importado: ".$row[0]."(".$viCliente->getCaIdcliente().")"."<br>";
                            //exit;
                        }                        
                    }
                    else
                    {
                        echo "No Importado: ".$row[0]."<br>";
                    }
                }
                
                //$vicliente = Doctrine::getTable("IdsCliente")->find( $request->getParameter("idcliente") );
                //ca_idalterno: string(20)
                
        }

        $array = $ws->toArray();
        exit;
        
    }
    
    
    public function executeActualizaGrupoSocios(sfWebRequest $request) {
  
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        
        
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';
        
        //$directory = "/home/maquinche/Desarrollo/INO 2016/clientes coltrans1.xls";
        $directory = "/srv/www/clasificacionproveedores.xls";
        //echo PHPEXCEL_ROOT;
        $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
        //exit;
        $hojas=array();
        foreach($objPHPExcel->getSheetNames() as $s)
        {
            $hojas[]=array("name"=>$s);
        }
        
//        print_r($hojas);
        //$ws = $objPHPExcel->getSheetByName("ProveedoresColtrans");
        $ws = $objPHPExcel->getSheetByName("ProveedoresColmas");
        
        
        $posicion=array();
        $posicion['nit']=0;
        $posicion['grupo']=2;
        
        $array = $ws->toArray();
        //echo "<pre>";print_r($array[1]);echo "</pre>";
        //exit;
        //foreach( $array as $pos=>$row ){
        /*count($array)*/
        $begin=0; 
        $end=count($array)-1;

        for(  $pos=$begin;$pos<$end; $pos++){
                $row=$array[$pos];
                
                if($pos==0 || $row[$posicion['grupo']]==""  )
                {
                    continue;
                }
                
                //($pos==4)
                {
                    //echo "<pre>";print_r($row);echo "</pre>";
                    $ids = Doctrine::getTable("Ids")->findOneBy("ca_idalterno",substr($row[0],1, strlen($row[0])-1) );
                    if($ids)
                    {
                        //echo $pos ."->".$viCliente->getCaIdcliente()." ".$viCliente->getCaCompania()."-------";
                        $idsproveedor=$ids->getIdsProveedor();//Doctrine::getTable("IdsCliente")->find( $viCliente->getCaIdcliente() );
                        if($idsproveedor)
                        {
                            /*echo $posicion['tipo']."-".$clasificacionCl[$posicion['tipo']]."<br>";
                            
                            echo $formasPago[$posicion['formapago']]."<br>";
                            
                            echo $formasPago[$posicion['tarifareteiva']]."<br>";
                            
                            echo $formasPago[$posicion['porcreteiva']]."<br>";*/

                            //echo "<pre>";prinxt_r($row);echo "</pre>";
                            //echo $cliente->getProperty("regimen_contributivo")."--".$cliente->getProperty("cuenta_forma_pago_coltrans")."::::::::";
                            $idsproveedor->setCaIdclasificacion($row[$posicion['grupo']]);
                            $idsproveedor->stopBlaming();
                            $idsproveedor->save();
                            //echo $cliente->getProperty("regimen_contributivo")."--".$cliente->getProperty("cuenta_forma_pago_coltrans")."<br><br>";
                           // echo "<br>";
                            echo "Si Importado: ".$row[0]."(".$idsproveedor->getCaIdproveedor().")"."<br>";
                            //exit;
                        }                        
                    }
                    else
                    {
                        echo "No Importado: ".$row[0]."-".$row[2]."<br>";
                    }
                }
                
                //$vicliente = Doctrine::getTable("IdsCliente")->find( $request->getParameter("idcliente") );
                //ca_idalterno: string(20)
                
        }

        $array = $ws->toArray();
        exit;
        
    }
    
    public function executeActualizaSucursalPrincipalCliente(sfWebRequest $request) {
  
            //$clientes = Doctrine::getTable("IdsCliente")->find( $request->getParameter("idcliente") );
            
            $q = Doctrine::getTable("Cliente")
                ->createQuery("c")
                ->where("ca_idcliente NOT IN (SELECT s.ca_id FROM IdsSucursal s WHERE c.ca_idcliente=s.ca_id AND s.ca_principal=true)" );
                //->limit(100);
                
            
            $clientes=$q->execute();
            //echo $q->getSqlQuery();
            //exit;
            
            
            //if($sucursal)
             //   echo $sucursal->getCaId();
            //echo count($clientes);
            //exit;
            
            foreach ($clientes as $c)
            {
                
                //echo $c->getCaIdcliente()."**".$c->getCaDireccion()."*****".($c->getDireccion())."<br>";
                /*$sucursal = Doctrine::getTable("IdsSucursal")
                        >createQuery("s")
                        ->where("ca_id =? AND ca_principal=true", array($c->getCaIdcliente()))
                        ->fetchOne();
                */
                $sucursal = Doctrine::getTable("IdsSucursal")
                    ->createQuery("s")
                    ->select("*")
                    ->where("ca_id =? AND ca_principal=true", array($c->getCaIdcliente()))                    
                    ->fetchOne();
                
                echo $c->getCaCompania()."-";
                if($sucursal)
                {
                    echo $sucursal->getCaId();
                    $sucursal->setCaDireccion($c->getDireccion());
                    $sucursal->setCaTelefonos($c->getCaTelefonos());
                    $sucursal->setCaFax($c->getCaFax());
                    $sucursal->setCaIdciudad($c->getCaIdciudad());
                    $sucursal->save();                    
                }
                else {
                    echo  "NO EXISTE";
                    $sucursal=new IdsSucursal();
                    $sucursal->setCaId($c->getCaIdcliente());
                    $sucursal->setCaPrincipal(true);
                    $sucursal->setCaDireccion($c->getDireccion());
                    $sucursal->setCaTelefonos($c->getCaTelefonos());
                    $sucursal->setCaFax($c->getCaFax());
                    $sucursal->setCaIdciudad($c->getCaIdciudad());
                    $sucursal->save();
                    
                }
                echo "<br>";
                
            }
            exit;
            
        /*
        select * 
        from vi_clientes_reduc c
        --inner join ids.tb_sucursales s ON c.ca_idcliente = s.ca_id   and ca_principal=true
        where ca_idcliente not in (select ca_id  from ids.tb_sucursales s where c.ca_idcliente = s.ca_id   and ca_principal=true)             
         */
    }
    
    
    
    public function executeAjusteContable(sfWebRequest $request) {

        
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';


        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';

        //$directory = "/home/maquinche/Desarrollo/INO 2016/clientes coltrans1.xls";
        //$directory = "/srv/www/ajustescoltrans2017.xls";
        $directory = "/srv/www/ajustes2017-2018.xls";
        //echo PHPEXCEL_ROOT;
        $objPHPExcel = PHPExcel_IOFactory::load($directory.$fileName);
        
        $conn = Doctrine_Manager::getInstance()->getConnection('master');
        
        $comprobante = new InoComprobante();
        $conn = $comprobante->getTable()->getConnection();
        $conn->beginTransaction();
        
        $comprobante=null;
        //try
        {
            
            
            $hojas=array();
            foreach($objPHPExcel->getSheetNames() as $s)
            {
                $hojas[]=array("name"=>$s);
            }

            print_r($hojas);
            //exit;
            $ws = $objPHPExcel->getSheetByName("cierrecoltrans2017");

            $posicion=array();
            $posicion['referencia']=0;
            $posicion['nit']=1;
            $posicion['valor']=2;
            $posicion['tipoc']=3;
            $posicion['notipoc']=4;
            $posicion['modulo']=5;
            $posicion['naturaleza']=6;            
            $posicion['cuenta1']=7;
            $posicion['cuenta2']=8;
            $posicion['concepto']=9;
            
            $idtipo=array("L10"=>27,"L68"=>28,"L70"=>29,"L65"=>30,"L30"=>26);//L OTM
            //$fechaComp=date("Y-m-d");
            $fechaComp="2017-12-31";

            $nmovimientos=25;

            $array = $ws->toArray();
            //echo "<pre>";print_r($array[1]);echo "</pre>";
            //exit;
            //foreach( $array as $pos=>$row ){
            /*count($array)*/
            $begin=0; 
            $end=count($array);

            $contador=0;
            $total=0;
            $lastdbcr="";
            $idcomprobante=$consecutivo=0;
            $comprobante=null;
            $idterceroComp="800024075";
            for(  $pos=$begin;$pos<$end; $pos++){

                    $row=$array[$pos];
                    $idtipoComprobante=$idtipo[$row[$posicion['tipoc']].$row[$posicion['notipoc']]];
                    
                    if($pos==0 /*|| ($row[$posicion['tipo']]!="1" */ )
                    {
                        continue;
                    }

                    if($contador==$nmovimientos)
                     {
                        
                        $comprobante->setCaConsecutivo($consecutivo);
                        $comprobante->setCaFchcomprobante($fechaComp);
                        $comprobante->setCaValor($total);
                        $comprobante->setCaValor2($total);
                        $comprobante->setCaUsugenero("Administrador");
                        $comprobante->setCaFchgenero($fechaComp);
                        $comprobante->setCaPlazo(0);        
                        $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
                        $comprobante->save($conn);
                        
                        $comproSiigo->setTotalDbCont($total);
                        $comproSiigo->setTotalCrCont($total);
                        $comproSiigo->save($conn);
                        
                        $comprobante=null;

                        //$this->crearComprobante($conn,$idcomprobante,$total);
                         echo "<br>TOTAL:".$total."<br>";
                         $total=$contador=0;
                     }
                     if( ($lastdbcr!="" && $lastdbcr!=$row[$posicion['naturaleza']]) ||  ($lastidtipoComprobante!="" && $lastidtipoComprobante != $idtipoComprobante))
                     {
                        if($total>0)
                        {
                         echo "<br>TOTAL:".$contador."<br>";
                        $comprobante->setCaConsecutivo($consecutivo);
                        $comprobante->setCaFchcomprobante(date("Y-m-d"));
                        $comprobante->setCaValor($total);
                        $comprobante->setCaValor2($total);
                        $comprobante->setCaUsugenero("Administrador");
                        $comprobante->setCaFchgenero($fechaComp);
                        $comprobante->setCaPlazo(0);        
                        $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
                        $comprobante->save($conn);
                        
                        $comproSiigo->setTotalDbCont($total);
                        $comproSiigo->setTotalCrCont($total);
                        $comproSiigo->save($conn);
                        }
                        $comprobante=null;
                         //$this->crearComprobante($conn,$idcomprobante,$total);
                         
                         $total=$contador=0;
                     }

                    $contador++;
                    //echo $contador.":";
                    //echo str_replace(",","",$row[$posicion['valor']]);
                    $valoru=str_replace(",","",$row[$posicion['valor']]);
                    $total+= $valoru;
                    
                    if($comprobante==null)
                    {
                        $comprobante=null;
                        $comprobante = new InoComprobante();
                        $comprobante->setCaIdtipo($idtipoComprobante);
                        //echo "comprobante:".$row[$posicion['tipoc']].$row[$posicion['notipoc']];
                        //exit;
                        
                        $tipoComprobante = $comprobante->getInoTipoComprobante();
                        echo "consecutivo : $idtipoComprobante --".$tipoComprobante->getCaNumeracionActual()."<br>";
                        $consecutivo=  intval($tipoComprobante->getCaNumeracionActual())+1;
                        $tipoComprobante->setCaNumeracionActual($consecutivo);
                        $tipoComprobante->save($conn);

                        $comprobante->setCaId($idterceroComp);
                        $comprobante->setCaIdmoneda("COP");
                        $comprobante->setCaTcambio(1);
                        $comprobante->save($conn);

                        $idcomprobante= $comprobante->getCaIdcomprobante();
                        $tipoComprobante = $comprobante->getInoTipoComprobante();
                        
                        
                        $comproSiigo = new SiigoComprobante();                
                        $comproSiigo->setIdUnegCont($idcomprobante);
                        $comproSiigo->setCdDocCont($tipoComprobante->getCaTipo());
                        $comproSiigo->setNuDocsopCont($tipoComprobante->getCaComprobante());
                        $comproSiigo->setNuCont($consecutivo);

                        $comproSiigo->setTpDocSopCont($tipoComprobante->getCaTipo());
                        $comproSiigo->setFechaCont($fechaComp);
                        //$comproSiigo->setFechaCont("2014-02-15");
                        $comproSiigo->setIdtpoIdapbCont("C");

                        $comproSiigo->setNitApbCont($comprobante->getIds()->getCaIdalterno());
                        $dv=($comprobante->getIds()->getCaDv()!="" && $comprobante->getIds()->getCaDv()!=null)?$comprobante->getIds()->getCaDv():"0";
                        $comproSiigo->setDvApbCont($dv);

                        
                        $comproSiigo->setIdSucCont("0");                        
                        $comproSiigo->setIndIncorpCont("2");
                        $comproSiigo->setCodaltUnegCont('1');
                        $comproSiigo->setCodaltEmpreCont('4');
                        //$comproSiigo->setCdErrsiigoCont();
                        $comproSiigo->setIndAnulCont("N");
                        //$comproSiigo->setArchivo();
                        //$comproSiigo->setErrorArchivo();
                        $comproSiigo->save($conn);
                    }

                    $lastdbcr=$row[$posicion['naturaleza']];
                    $lastidtipoComprobante=$idtipo[$row[$posicion['tipoc']].$row[$posicion['notipoc']]];
                    echo "<br>";
                    $valoru=str_replace(",","",$row[$posicion['valor']]);
                    
                    $nat=$row[$posicion['naturaleza']];
                    /*if($nat=="C")
                        $nat="D";
                    else
                        $nat="C";
                    */
                    $valor=$valoru;
                    $cc="0001";
                    $scc="001";
                    $nit=$row[$posicion['nit']];
                    $referencia=$row[$posicion['referencia']];
                    $nconcepto=$row[$posicion['concepto']];
                    
                    $detComproSiigo=new SiigoDetComprobante();
                    $detComproSiigo->setIdUnegMovcont($comproSiigo->getIdUnegCont());
                    $detComproSiigo->setCodDoccontMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setNumTipDoccontMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumDoccontMovcont($consecutivo);
                    
                    
                    $detComproSiigo->setCtaMovcont($row[$posicion['cuenta1']]);
                    $detComproSiigo->setTpIdepcteMovcont("CC");
                    $detComproSiigo->setSucMovcont("0");
                    $detComproSiigo->setIdentPcteMovcont($nit);//nit            
                    $detComproSiigo->setDescripMovcont($nconcepto);//nombre concepto
                    
                    $detComproSiigo->setValorMovcont($valor);//valor
                    $detComproSiigo->setNatuMovcont($nat);//naturaleza C o D
                    
                    $detComproSiigo->setVlBaseMovcont(0);//valor Base
                    $detComproSiigo->setIdCcMovcont("0001");//centro de costo
                    $detComproSiigo->setIdBodegaMovcont("0001");
                    //$detComproSiigo->setCodalInvMovcont("0010001000007");
                    $detComproSiigo->setCodalInvMovcont("0");
                    $detComproSiigo->setCantInvMovcont("1");
                    $detComproSiigo->setCodaltDepMovcont("0");
                    $detComproSiigo->setCodaltBodMovcont("0");
                    $detComproSiigo->setCodaltUbiMovcont("0");
                    $detComproSiigo->setCodaltCcMovcont($cc);
                    $detComproSiigo->setIdAreaMovcont("0");
                    $detComproSiigo->setCodaltSccMovcont($scc);//??
                    $detComproSiigo->setTpIdterMovcont("CC");
                    $detComproSiigo->setIdentTerMovcont($nit);//nit
                    $detComproSiigo->setTipConCarMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setComConCarMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumConCarMovcont($consecutivo);
                    $detComproSiigo->setVctConCarMovcont(1);
                    
                    $fchDocCruce=$fechaComp;
                    //$detComproSiigo->setFecConMovcont(date("Y-m-d"));
                    $detComproSiigo->setFecConMovcont($fchDocCruce);

                    $detComproSiigo->setNomTercMovcont("SIIGONECT");//
                    $detComproSiigo->setConceptoNomMovcont(0);
                    $detComproSiigo->setVariableAcumMovcont(0);
                    $detComproSiigo->setNroquinAcumMovcont(0);
                    $detComproSiigo->setTipModMovhbMovcont($row[$posicion['modulo']]);
                    $detComproSiigo->setRefMasMovhbMovcont( $referencia);
                    $detComproSiigo->setNroBlhMovhbMovcont($referencia);
                    $detComproSiigo->save($conn);
                    
                    
                    
                    //mov2
                    //$nat=$row[$posicion['cuenta']];
                    if($nat=="C")
                        $nat="D";
                    else
                        $nat="C";
                    
                    $valor=$valoru;
                    $cc="0001";
                    $scc="001";
                    $nit=$row[$posicion['nit']];
                    $referencia=$row[$posicion['referencia']];
                    
                    
                              
                    $detComproSiigo=new SiigoDetComprobante();
                    $detComproSiigo->setIdUnegMovcont($comproSiigo->getIdUnegCont());
                    $detComproSiigo->setCodDoccontMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setNumTipDoccontMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumDoccontMovcont($consecutivo);
                    
                    $detComproSiigo->setCtaMovcont($row[$posicion['cuenta2']]);
                    $detComproSiigo->setTpIdepcteMovcont("CC");
                    $detComproSiigo->setSucMovcont("0");
                    $detComproSiigo->setIdentPcteMovcont($nit);//nit            
                    $detComproSiigo->setDescripMovcont($nconcepto);//nombre concepto

                    $detComproSiigo->setValorMovcont($valor);//valor
                    $detComproSiigo->setNatuMovcont($nat);//naturaleza C o D
                    
                    $detComproSiigo->setVlBaseMovcont(0);//valor Base
                    $detComproSiigo->setIdCcMovcont("0001");//centro de costo
                    $detComproSiigo->setIdBodegaMovcont("0001");
                    //$detComproSiigo->setCodalInvMovcont("0010001000007");
                    $detComproSiigo->setCodalInvMovcont("0");
                    $detComproSiigo->setCantInvMovcont("1");
                    $detComproSiigo->setCodaltDepMovcont("0");
                    $detComproSiigo->setCodaltBodMovcont("0");
                    $detComproSiigo->setCodaltUbiMovcont("0");
                    $detComproSiigo->setCodaltCcMovcont($cc);
                    $detComproSiigo->setIdAreaMovcont("0");
                    $detComproSiigo->setCodaltSccMovcont($scc);//??
                    $detComproSiigo->setTpIdterMovcont("CC");
                    $detComproSiigo->setIdentTerMovcont($nit);//nit
                    $detComproSiigo->setTipConCarMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setComConCarMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumConCarMovcont($consecutivo);
                    $detComproSiigo->setVctConCarMovcont(1);
                    
                    $fchDocCruce=$fechaComp;
                    //$detComproSiigo->setFecConMovcont(date("Y-m-d"));
                    $detComproSiigo->setFecConMovcont($fchDocCruce);

                    $detComproSiigo->setNomTercMovcont("SIIGONECT");//
                    $detComproSiigo->setConceptoNomMovcont(0);
                    $detComproSiigo->setVariableAcumMovcont(0);
                    $detComproSiigo->setNroquinAcumMovcont(0);
                    $detComproSiigo->setTipModMovhbMovcont($row[$posicion['modulo']]);
                    $detComproSiigo->setRefMasMovhbMovcont( $referencia);
                    $detComproSiigo->setNroBlhMovhbMovcont($referencia);
                    $detComproSiigo->save($conn);
            }
            if($total>0)
            {
                $comprobante->setCaConsecutivo($consecutivo);
                $comprobante->setCaFchcomprobante($fechaComp);
                $comprobante->setCaValor($total);
                $comprobante->setCaValor2($total);
                $comprobante->setCaUsugenero("Administrador");
                $comprobante->setCaFchgenero($fechaComp);
                $comprobante->setCaPlazo(0);
                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
                $comprobante->save($conn);
                
                $comproSiigo->setTotalDbCont($total);
                $comproSiigo->setTotalCrCont($total);
                $comproSiigo->save($conn);
                
                $comprobante=null;
                //$this->crearComprobante($conn,$idcomprobante,$total);
                echo "<br>TOTAL:".$total."<br>";
            }
        
            $conn->commit();
        }
        /*catch(Exceptio $e)
        {
            print_r($e->getMessage());
            $conn->rollback();
        }*/
        //$array = $ws->toArray();
        //echo "<pre>";print_r($array);echo "</pre>";
        exit;
        
    }
    
    public function crearComprobante(&$conn , $valor,$idtipo='26')
    {
        
        
  
        $tipoComprobante = $comprobante->getInoTipoComprobante();
        $consecutivo=  intval($tipoComprobante->getCaNumeracionActual())+1;
        $tipoComprobante->setCaNumeracionActual($consecutivo);
        $tipoComprobante->save($conn);

        
        $comprobante->setCaConsecutivo($consecutivo);
        $comprobante->setCaFchcomprobante(date("Y-m-d"));
        $comprobante->setCaValor($valor);
        $comprobante->setCaValor2($valor);
        $comprobante->setCaUsugenero("Administrador");
        $comprobante->setCaFchgenero(date("Y-m-d H:i:s"));
        $comprobante->setCaPlazo(0);        
        $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
        $comprobante->save($conn);
        
        
        
        
        $comproSiigo = new SiigoComprobante();                
        $comproSiigo->setIdUnegCont($idcomprobante);
        $comproSiigo->setCdDocCont($tipoComprobante->getCaTipo());
        $comproSiigo->setNuDocsopCont($tipoComprobante->getCaComprobante());
        $comproSiigo->setNuCont($consecutivo);
        
        $comproSiigo->setTpDocSopCont($tipoComprobante->getCaTipo());
        $comproSiigo->setFechaCont(date("Y-m-d"));
        //$comproSiigo->setFechaCont("2014-02-15");
        $comproSiigo->setIdtpoIdapbCont("C");

        $comproSiigo->setNitApbCont($comprobante->getIds()->getCaIdalterno());
        $dv=($comprobante->getIds()->getCaDv()!="" && $comprobante->getIds()->getCaDv()!=null)?$comprobante->getIds()->getCaDv():"0";
        $comproSiigo->setDvApbCont($dv);
        //$comproSiigo->setNitApbCont($house->getCliente()->getCaIdalterno());
        //$comproSiigo->setDvApbCont($house->getCliente()->getCaDigito());        
        $comproSiigo->setIdSucCont("0");
        $comproSiigo->setTotalDbCont($valor);
        $comproSiigo->setTotalCrCont($valor);
        $comproSiigo->setIndIncorpCont("2");
        $comproSiigo->setCodaltUnegCont('1');
        $comproSiigo->setCodaltEmpreCont('4');
        //$comproSiigo->setCdErrsiigoCont();
        $comproSiigo->setIndAnulCont("N");
        //$comproSiigo->setArchivo();
        //$comproSiigo->setErrorArchivo();
        $comproSiigo->save($conn);
        
        //return
        
    }
    
    
    public function executeWsUsers(sfWebRequest $request) {
        
        //phpinfo();
        //exit;
        ProjectConfiguration::registerZend();   
        
        $config = sfConfig::get("app_soap_adminUsers");
            $wsdl_uri = $config["wsdl_uri"];
            
            
           
            $client = new Zend_Soap_Client( $wsdl_uri, array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2, "login"=>"maquinche", "password"=>"kjdhfkjgfhfdskjgh" ));
            $usuario = Doctrine::getTable("Usuario")->find("abotero");
           
            //$usuario->setCaExtension("111");
            $usuario->setCaTeloficina("222");
            //$error =  $client->updateUser( sfConfig::get("app_soap_secret"),serialize($usuario) );            
            $error =  $client->getUsers();            
            
            print_r($error);
        
        
        /*$config = sfConfig::get("app_soap_adminUsers");
            $wsdl_uri = $config["wsdl_uri"];*/
/*        $endpoint = new SOAPClient($wsdl_uri,
        array(
          'stream_context' => stream_context_create(
            array(
              'ssl' => array(
                'verify_peer' => false, 
                'verify_peer_name' => false
              )
            )
          )
        )
      );
        $result =  $endpoint->getUsers(  );            
            print_r($result);
 */
        
/*        $opts = array(
    'http'=>array(
        'user_agent' => 'PHPSoapClient'
        )
    );

$context = stream_context_create($opts);
$client = new SoapClient($wsdl_uri,
                         array('stream_context' => $context,
                               'cache_wsdl' => WSDL_CACHE_NONE));

$result = $client->getUsers();
                                print_r($result);*/
            exit;
    }
    
    public function executeWsOpen(sfWebRequest $request) {
            
        ProjectConfiguration::registerZend();   
        
        $config = sfConfig::get("app_soap_open");
        $wsdl_uri = $config["wsdl_uri"];
           
        $client = new Zend_Soap_Client( $wsdl_uri, array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 , 'login'=>'alramirez', 'password'=>"super0911"));            
            
        $error =  $client->verListadoDeclaraciones( 890300225, 'CO9116/17' );            
            
        echo "<pre>";print_r(unserialize($error));echo "</pre>";
        exit;
        //$this->setTemplate("responseTemplate");
    }
    
    
    public function executeDatosWgRowWidget(sfWebRequest $request) {
        
        $companies= array();
        
        $companies[]=array("id"=> 1,
        "name"=> "Roodel",
        "phone"=> "602-736-2835",
        "price"=> 59.47,
        "change"=> 1.23,
        "lastChange"=> "10/8",
        "industry"=> "Manufacturing",
        "desc"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
        "pctChange"=> 2.11,
            "orders"=> array(array(
            "id"=>1,
            "companyId"=> 1,
            "productCode"=> "96f570a8-5218-46b3-8e71-0551bcc5ecb4",
            "quantity"=> 83,
            "date"=> "2015-10-07",
            "shipped"=> true
            ))
            );
        
        $this->responseArray = array("root" => $companies, "total" => count($companies)+1, "success" => true);
        $this->setTemplate("responseTemplate");
    }
    /*
     * var companiesListJSONArray = [{
        "id": 1,
        "name": "Roodel",
        "phone": "602-736-2835",
        "price": 59.47,
        "change": 1.23,
        "lastChange": "10/8",
        "industry": "Manufacturing",
        "desc": "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
        "pctChange": 2.11,
        "orders": [{
            "id": 1,
            "companyId": 1,
            "productCode": "96f570a8-5218-46b3-8e71-0551bcc5ecb4",
            "quantity": 83,
            "date": "2015-10-07",
            "shipped": true
        }]
    }, {
        "id": 2,
        "name": "Voomm",
        "phone": "662-254-4213",
        "price": 41.31,
        "change": 2.64,
        "lastChange": "10/18",
        "industry": "Services",
        "desc": "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
        "pctChange": 6.83,
        "orders": [{
            "id": 2,
            "companyId": 2,
            "productCode": "af7e56bf-09a9-4ff4-9b02-f5e6715e053b",
            "quantity": 14,
            "date": "2015-10-11",
            "shipped": false
        }]
    }];
     */
    
    public function executeWsSap(sfWebRequest $request) {
           
        ProjectConfiguration::registerZend();  
       
        $config = sfConfig::get("app_soap_sap");
        $wsdl_uri = "https://190.85.222.204/ws/sap/IntegracionSapWS?wsdl";
        //$wsdl_uri = "https://www.colsys.com.co/ws/sap/IntegracionSapWS?wsdl";       
       
        $client = new Zend_Soap_Client($wsdl_uri, array('encoding'=>'ISO-8859-1', 'soap_version'=>SOAP_1_2 , 'login'=>'seidor', 'password'=>'=Ye7zdT5u8$SDt#V',
            'stream_context' => stream_context_create(
                array(
                  'ssl' => array(
                    'verify_peer' => false, 
                    'verify_peer_name' => false
                  )
                )
              )
            ));
       
        /* JSON FACTURAS DE COMPRA NACIONALES
       
        $json = '
         * {
            "CodigoDoc": "P",
            "SerieCode":"1",
            "DocNum": "8604",
            "DocEntry": "85496532",
            "TaxDate": "2017-07-18",
            "NIT":"249",
            "Comments": "Prueba desde WS",
            "DocDate": "2017-07-18",
            "UsuCreado": "colsys",
            "DocRate":"1954",
            "DocCur": "USD",
            "VlrNeto": "5285",
            "VlrImpuestos": "52",
            "Lineas":[
              {
                "PrjCode":"720.80.06.0034.17",
                "ItemCode":"33",
                "VlrArticulo":"5000"

              },
              {
                "PrjCode1":"720.80.06.0033.17",
                "ItemCode":"33",
                "VlrArticulo":"285"
              }
            ]
          }';

        */
       
        $jsonFC = '{"CodigoDoc": "P","SerieCode":"1","DocNum": "8604","DocEntry": "85496532","TaxDate": "2017-07-18","NIT":"249","Comments": "Prueba desde WS","DocDate": "2017-07-18","UsuCreado": "colsys","DocRate":"1954","DocCur": "USD","VlrNeto": "5285","VlrImpuestos": "52","Lineas":[{"PrjCode":"720.80.06.0034.17","ItemCode":"33","VlrArticulo":"5000"},{"PrjCode1":"720.80.06.0033.17","ItemCode":"33","VlrArticulo":"285"}]}';
       
        /* JSON PAGOS RECIBIDOS
        
       
        $json = '{
            "PrjCode": "720.80.06.0034.17",
            "NIT": "249",
            "CodigoDoc": "R",
            "SerieCode":"1",
            "DocNum": "8604",
            "DocEntry": "85496540",
            "DocEntryCruce": "85496532",
            "VlrNeto": "5285",
            "TaxDate": "2017-08-17",
            "DocRate": "1",
            "DocCur": "COP",
            "UsuCreado": "falopez",
            "Comments": "Pruebas desde Colsys"
          }';
        */
       
        //$jsonPR = '{"PrjCode": "720.50.05.0002.17","NIT": "249","CodigoDoc": "R","SerieCode":"1","DocNum": "8604","DocEntry": "85496560","DocEntryCruce": "85496540","VlrNeto": "5285","TaxDate": "2017-08-17","DocRate": "1","DocCur": "COP","UsuCreado": "falopez","Comments": "Pruebas desde Colsys"}';
       
        /* JSON CANCELACION COMPROBANTES*/
        /*
        {
            "DocEntry":"85496560",
            "TaxDate": "2017-08-16",
            "UsuCreado": "falopez",
            "Comments": "Anulado de ejemplo"
        }
        */
        $jsonCC = '{"TaxDate": "2017-10-02T00:00:00", "Comments": "Basado en Fact.proveedores 10032.", "DocEntry": "119", "CodigoDoc": "C", "UsuCreado": "manager"}';
       
        /* JSON ACTIVACION CLIENTE*/
        /*
        {
            "NIT":"830003960",
            "TaxDate": "2017-08-16",
            "UsuCreado": "falopez"
        }
        */
        $jsonac = '{"NIT":"830003960","Fecha": "2017-08-16","UsuCreado": "falopez"}';
       
        /* JSON ACTIVACION DE SOCIO DE NEGOCIO*/
        /*
        {
            "ItemCode":"33",
            "TaxDate": "2017-08-16",
            "UsuCreado": "falopez"
        }
        */
        $jsonaa = '{"TaxDate": "2017-10-26T00:00:00", "CardCode": "72820273000137", "CardType": "P", "GroupCode": "102", "UsuarioCreado": "sporjuela"}';
       
        //$jsonsap = '{"Fecha": "2017-09-19T00:00:00-05:00", "ItemCode": "112", "UsuarioCreado": "manager"}';
        //$jsonsap = '{"TaxDate": "2017-10-04T00:00:00", "Comments": "Basado en Notas de crï¿½dito acreedores 10005.", "DocEntry": "10", "CodigoDoc": "RC", "UsuCreado": "manager"}';
        $jsonPR = '{"NIT": "P830134156", "DocCur": "COP", "DocNum": "2943", "Lineas": [{"PrjCode": "300.10.12.0001.17", "ItemCode": "75", "VlrArticulo": "66000", "VlrImpuesto": "12540"}], "DocDate": "2017-12-12", "DocRate": "1", "TaxDate": "2017-12-12", "VlrNeto": "78540", "Comments": "", "DocEntry": "167", "CodigoDoc": "C", "SerieCode": "1", "UsuCreado": "farevalo", "VlrImpuestos": "12540"}';
        //$jsonsap = '{"NIT": "E1007309417", "DocCur": "COP", "DocNum": "10024", "Lineas": [{"PrjCode": "", "ItemCode": "1", "VlrArticulo": "6789"}], "DocDate": "2017-09-19T00:00:00", "DocRate": "1", "TaxDate": "2017-09-19T00:00:00", "VlrNeto": "7128.45", "Comments": "", "DocEntry": "88", "CodigoDoc": "P", "SerieCode": "1", "UsuCreado": null, "VlrImpuestos": "0"}';
        //               
        $result =  $client->tipoSolicitud( 1, '9011', '1', $jsonPR); // FACTURAS DE COMPRA NACIONAL
        //$result =  $client->tipoSolicitud( 1, '9011', '3', $jsonPR); // PAGOS RECIBIDOS
        
        $jsonanulacion='{"TaxDate": "2017-11-07T00:00:00", "Comments": "", "DocEntry": "10014", "CodigoDoc": "R", "UsuCreado": "manager"}';
        //$result =  $client->tipoSolicitud( 1, '9011', '2', $jsonanulacion); // CANCELACION DE COMPROBANTES
        //$result =  $client->tipoSolicitud( 1, '9011', '4', $jsonaa); // ACTIVACION DE SOCIO DE NEGOCIO
        //$result =  $client->tipoSolicitud( 2, '9011', '5', $jsonsap); // ACTIVACION DE ARTICULO
        print_r($result);
        exit;
    }
    
    function executeActivacionCliente(sfWebRequest $request)
    {
        $data = json_decode('{"NIT":"830003960","Fecha": "2017-08-16","UsuCreado": "falopez"}');
                
        $nit = $data->NIT;
        $fechaActivacion = $data->Fecha;
        $usuarioActivacion = $data->UsuCreado;
        $company=2;

        
        //$conn = Doctrine::getTable("Ids")->getConnection();
        //$conn->beginTransaction();
        
        //try {
            
            
            $ids = Doctrine::getTable("Ids")->findOneBy('ca_idalterno' ,array($nit));
            //$idsEstado =$ids->getIdsEstadoSap();
            //echo "<br>".$idsEstado->count();
            $idsEstado = Doctrine::getTable("IdsEstadoSap")->find(array($ids->getCaId(),"C",$company));
            //echo "<br>".$idsEstado->count();
            //return array($idsEstado->count());
            if (!$idsEstado){
                $idsEstado= new IdsEstadoSap();
                $idsEstado->setCaId($nit);
                $idsEstado->setCaTipo("C");
                $idsEstado->setCaIdempresa($company);                
                $idsEstado->setCaUsucreado("Administrador");
                $idsEstado->setCaFchcreado(date("Y-m-d H:i:s"));
            }
                
            $idsEstado->setCaActivo(true);
            $idsEstado->setCaFchsap($fechaActivacion);
            $idsEstado->setCaUsusap($usuarioActivacion);
            $idsEstado->stopBlaming();
            $idsEstado->save(); 
            echo "aaa";

            $mensaje = 'El cliente se activo correctamente!';
            $estado = 1;
            $success = true;
               
        /*} catch (Exception $e) {                
            //$conn->rollback();
            $estado = 0;
            $mensaje = "errorInfo: ".$e->getMessage();
            $success = false;        
        }*/
        
        /*$transaccion->setCaEstado($estado);
        $transaccion->setRespuesta(utf8_encode($mensaje));
        $transaccion->save($conn);*/
        //$conn->commit(); 
        //exit;
        $this->responseArray = array("success" => $success, "mensaje" => utf8_encode($mensaje));
    $this->setTemplate("blank");    
        //$mensajereturn $this->responseArray;   
    }
    
    public function executeGenerarFactura(sfWebRequest $request) {
        $idcomprobante = $request->getParameter("idcomprobante");
        $ncomprobante = $request->getParameter("ncomprobante");
        $errorInfo= $info = "";
        $ids = array();

        $inoDetalle = new InoDetalle();
        $conn = $inoDetalle->getTable()->getConnection();

        $conn->beginTransaction();        
        $house=null;
        $total=0;
        $impuestos=array();
        $retfte=array();
        $autoret=0;
        
        $comprobantesSiigo = Doctrine::getTable("SiigoComprobante")
            ->createQuery("d")
            ->where("d.ind_incorp_cont!=? and (cd_errsiigo_cont != ? or cd_errsiigo_cont IS null ) AND cd_errsiigo_cont=?", array("+5","26","960"))
            //->where("d.cd_errsiigo_cont=?", array("27"))
            //->where("id_uneg_cont=?",array("56267"))
            ->limit(1)
            ->execute();
        
        foreach($comprobantesSiigo as $k=>$c)
        {
            echo $k." :: ".$c->getIdUnegCont() ." :: ".$c->getCdErrsiigoCont()."<br>";
        }
//        exit;
        
        //try
        foreach($comprobantesSiigo as $k=>$c)
        {
            $idcomprobante=$c->getIdUnegCont();
            $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
            $tipoComprobante = $comprobante->getInoTipoComprobante();
            $consecutivo=$comprobante->getCaConsecutivo();
            if(trim($ncomprobante)!="")
            {
                $consecutivo=  $ncomprobante;
            }
            else{
                /*$consecutivo=  intval($tipoComprobante->getCaNumeracionActual())+1;
                $tipoComprobante->setCaNumeracionActual($consecutivo);
                $tipoComprobante->save($conn);*/
            }
            
            $regContributivo=$comprobante->getIds()->getIdsCliente()->getProperty('regimen_contributivo');

            $house = Doctrine::getTable("InoHouse")->find($comprobante->getCaIdhouse());
            
            $q = Doctrine::getTable("InoDetalle")
                    ->createQuery("det")
                    ->where("det.ca_idcomprobante = ? AND det.ca_idcuenta is not null",$idcomprobante  )                    
                    ->delete()
                    ->execute();
            
            
            $q = Doctrine::getTable("SiigoComprobante")
                    ->createQuery("sc")
                    ->where("sc.id_uneg_cont=?",$idcomprobante  )                    
                    ->delete()
                    ->execute();

            $movs = Doctrine::getTable("InoDetalle")
                ->createQuery("det")
                ->select("det.*,s.*,tcomp.ca_ctarteica,cric.ca_rteica")
                ->innerJoin("det.InoComprobante comp")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')
                ->leftJoin("tcomp.Ctarteica cric WITH tcomp.ca_idempresa=cric.ca_idempresa ")
                ->addWhere("det.ca_idconcepto IS NOT NULL")
                ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
                ->addOrderBy("s.ca_pt DESC")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
            
            echo "<pre>";print_r($movs);echo "</pre>";
            foreach ($movs as $m) {
                $autoret1=$rteica1=$reteiva1=0;
                if($tipoComprobante->getCaTipo()=="C")
                    "";
                else
                    $valortmp=($m["det_ca_cr"]*$comprobante->getCaTcambio());

                if($m["s_ca_idconceptosiigo"]>0)
                {                   
                    if($m["s_ca_iva"]=="S")
                    {
                        $ctaiva = $tipoComprobante->getCaCtaiva();//ParametroTable::retrieveByCaso("CU232",$tipoComprobante->getCaCtaiva());
                        if($ctaiva!="")
                        {
                            $valoriva=round($valortmp * ($m["s_ca_porciva"]/100));
                            $impuestos[$ctaiva]+=$valoriva;
                            echo "<br>IVA :".$valoriva;
                            if($regContributivo=="G" )//gran contribuyente 
                            {
                                $ctarteiva = $tipoComprobante->getCaCtarteiva();//ParametroTable::retrieveByCaso("CU232",$tipoComprobante->getCaCtaiva());
                                if($ctarteiva!="")
                                {
                                    //echo "1634($ctarteiva)-";
                                    $impuestos[$ctarteiva] += round(  ($valoriva * 15)/100);
                                     $reteiva1=$impuestos[$ctarteiva];
                                     echo "<br>RTEIVA :".$reteiva1;
                                }
                            }
                        }
                    }
                    if($m["s_ca_autoret"]=="S" && $valortmp>=($m["s_ca_basear"]*$comprobante->getCaTcambio()))
                    {
                        echo "<br>AUTORETE";
                        $autoret1=round($valortmp * (4/100));
                        $autoret+=round($autoret1);
                    }
                    //RETEICA
                    
                    if($regContributivo=="G" && $m["s_ca_pt"]=="P")//gran contribuyente e ingresos propios
                    {
                        
                        $rteica1=round($valortmp * ($m["cric_ca_rteica"]/100));
                        if($rteica1>0)
                        {
                            echo "<br>RTEICA :".$rteica1;
                            $impuestos[$m["tcomp_ca_ctarteica"]]+=$rteica1;
                        }
                    }                    
                }                
                $total+=($valortmp+$rteica1);
            }

            $totalsinimpuestos=$total;
            
            
            foreach($impuestos as $cuenta=>$s)
            {
                $inoDetalle = new InoDetalle();
                $inoDetalle->setCaIdcomprobante( $idcomprobante );                
                if($tipoComprobante->getCaTipo()=="C")
                {
                    $inoDetalle->setCaDb( $s );
                    $total+=$s;
                }
                else
                {
                    if( substr($cuenta,0,1)=="2")
                    {
                        $inoDetalle->setCaCr( $s );
                        $total+=$s;
                    }
                    else if( substr($cuenta,0,1)=="1")
                    {
                        $inoDetalle->setCaDb( $s );
                        $total-=$s;
                    }
                }
                $inoDetalle->setCaIdcuenta( $cuenta );            
                $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                $inoDetalle->save( $conn );                
            }

            
            //cuenta cruce
            $inoDetalle = new InoDetalle();
            $inoDetalle->setCaIdcomprobante( $idcomprobante );
            if($tipoComprobante->getCaTipo()=="C")
            {
                echo "<br>CRUCE C:".$total;
                $inoDetalle->setCaCr( ($total-$rteica1) );
            }
            else
            {
                echo "<br>CRUCE D:".$total/$comprobante->getCaTcambio();
                $inoDetalle->setCaDb( ($total-$rteica1)/$comprobante->getCaTcambio() );
            }

            switch($tipoComprobante->getCaIdempresa())
            {
                case 2:
                    $cuenta_pago="cuenta_forma_pago_coltrans";
                    break;
                case 8:
                    $cuenta_pago="cuenta_forma_pago_colotm";
                    break;
                default :
                    $cuenta_pago="cuenta_forma_pago_".$tipoComprobante->getCaIdempresa();
            }
            $inoDetalle->setCaIdcuenta( $comprobante->getIds()->getIdsCliente()->getProperty($cuenta_pago) );
            $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
            $inoDetalle->save( $conn );
            
            
            if($autoret>0)
            {
                echo "<br>AUTORTE :".$autoret;
                $q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."1");
                
                if($q1[0])
                {
                    $inoDetalle = new InoDetalle();
                    $inoDetalle->setCaIdcomprobante( $idcomprobante );                
                    $inoDetalle->setCaDb( $autoret );                    
                    $inoDetalle->setCaIdcuenta( $q1[0]->getCaValor() );
                    $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                    $inoDetalle->save( $conn );                    
                }
                
                $q1 = ParametroTable::retrieveByCaso("CU251",null,null,$tipoComprobante->getCaIdempresa()."2");                
                if($q1[0])
                {
                    $inoDetalle = new InoDetalle();
                    $inoDetalle->setCaIdcomprobante( $idcomprobante );
                    $inoDetalle->setCaCr( $autoret );
                    $inoDetalle->setCaIdcuenta( $q1[0]->getCaValor() );
                    $inoDetalle->setCaId( $comprobante->getIds()->getCaId() );
                    $inoDetalle->save( $conn );                
                }                
                $total+=$autoret;                
            }
            
            $comprobante->setCaValor($total/$comprobante->getCaTcambio());
            $comprobante->setCaValor2(($total+$reteiva1)/$comprobante->getCaTcambio());
            //$comprobante->setCaUsugenero($this->getUser()->getUserId());
            //$comprobante->setCaFchgenero(date("Y-m-d H:i:s"));
            //$comprobante->setCaPlazo($dcredito);

            //$comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            //if($tipoComprobante->getCaTipo()=="C")
//                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            $comprobante->stopBlaming();
            $comprobante->save($conn);

            /***********TABLAS SIIGO**************/
            if($tipoComprobante->getCaTipo()=="F")
            {
            //CABECERA COMPROBANTE
                $comproSiigo = new SiigoComprobante();                
                $comproSiigo->setIdUnegCont($idcomprobante);
                $comproSiigo->setCdDocCont("F");
                $comproSiigo->setNuDocsopCont($tipoComprobante->getCaComprobante());
                $comproSiigo->setNuCont($consecutivo);        
                $comproSiigo->setTpDocSopCont($tipoComprobante->getCaTipo());
                $comproSiigo->setFechaCont($comprobante->getCaFchcomprobante());
                //$comproSiigo->setFechaCont("2014-02-15");
                $comproSiigo->setIdtpoIdapbCont("C");

                $comproSiigo->setNitApbCont($comprobante->getIds()->getCaIdalterno());
                $dv=($comprobante->getIds()->getCaDv()!="" && $comprobante->getIds()->getCaDv()!=null)?$comprobante->getIds()->getCaDv():"0";
                $comproSiigo->setDvApbCont($dv);
                //$comproSiigo->setNitApbCont($house->getCliente()->getCaIdalterno());
                //$comproSiigo->setDvApbCont($house->getCliente()->getCaDigito());        
                $comproSiigo->setIdSucCont("0");
                //$comproSiigo->setTotalDbCont($total*$comprobante->getCaTcambio());
                //$comproSiigo->setTotalCrCont($total*$comprobante->getCaTcambio());
                //$comproSiigo->setTotalDbCont($total);
                //$comproSiigo->setTotalCrCont($total);
                $comproSiigo->setTotalDbCont($comprobante->getCaValor2());
                $comproSiigo->setTotalCrCont($comprobante->getCaValor2());
                
                $comproSiigo->setIndIncorpCont("2");
                $comproSiigo->setCodaltUnegCont('1');
                $comproSiigo->setCodaltEmpreCont('4');
                //$comproSiigo->setCdErrsiigoCont();
                $comproSiigo->setIndAnulCont("N");
                //$comproSiigo->setArchivo();
                //$comproSiigo->setErrorArchivo();
                $comproSiigo->save($conn);

                $q = Doctrine::getTable("InoDetalle")
                    ->createQuery("det")
                    ->select("det.*,s.*,ids.ca_nombre , ids.ca_idalterno ,  ids.ca_dv")            
                    ->innerJoin("det.InoComprobante comp")
                    ->innerJoin("comp.Ids ids")
                    ->innerJoin("comp.InoTipoComprobante tcomp")
                    //->innerJoin("tcomp.InoCentroCosto ccosto")
                    ->leftJoin('det.InoConSiigo s WITH tcomp.ca_idempresa=s.ca_idempresa ')            
                    ->addWhere("det.ca_idcomprobante = ? ",$idcomprobante  )
                    ->addOrderBy("s.ca_pt DESC")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                $movs=$q->execute();
                /*echo "<pre>";print_r($movs);echo "</pre>";
                $conn->rollback();
                exit;*/

                if($comprobante->getCaIdccosto()=="")
                {
                    $ccosto = Doctrine::getTable("InoCentroCosto")
                                  ->createQuery("c")
                                  ->addWhere("c.ca_impoexpo = ?", $comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo())
                                  ->addWhere("c.ca_transporte = ?", $comprobante->getInoHouse()->getInoMaster()->getCaTransporte())
                                  ->addWhere("c.ca_idsucursal = ?", $comprobante->getInoTipoComprobante()->getCaIdsucursal())                                  
                                  ->fetchOne();
                }
                else
                {
                    $ccosto = Doctrine::getTable("InoCentroCosto")->find($comprobante->getCaIdccosto());
                }

                foreach ($movs as $m) {
                    if($m["det_ca_idcuenta"]!="")
                    {
                        $cuenta=$m["det_ca_idcuenta"];
                        $cc="0001";
                        $scc="001";
                        $nconcepto="Proceso Automatico Siigoconect";
                    }
                    else
                    {
                        $cuenta=$m["s_ca_cuenta"];
                        $cc=  "000".$m["s_ca_cc"];
                        $scc="00".$m["s_ca_scc"];
                        $nconcepto=$m["s_ca_descripcion"];
                    }
		    if($nconcepto=="")
                        $nconcepto="Proceso Automatico Siigoconect";

                    $detComproSiigo=new SiigoDetComprobante();
                    $detComproSiigo->setIdUnegMovcont($comproSiigo->getIdUnegCont());
                    $detComproSiigo->setCodDoccontMovcont("F");
                    $detComproSiigo->setNumTipDoccontMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumDoccontMovcont($consecutivo);
                    $detComproSiigo->setCtaMovcont($cuenta);
                    $detComproSiigo->setTpIdepcteMovcont("CC");
                    $detComproSiigo->setSucMovcont("0");
                    $detComproSiigo->setIdentPcteMovcont($m["ids_ca_idalterno"]);//nit            
                    $detComproSiigo->setDescripMovcont($nconcepto);//nombre concepto
                    if($m["det_ca_cr"]>0)
                    {
                        $valor=$m["det_ca_cr"];
                        $nat="C";
                    }
                    else
                    {
                        $valor=$m["det_ca_db"];
                        $nat="D";
                    }
                    $detComproSiigo->setValorMovcont(round($valor*$comprobante->getCaTcambio(),2) );//valor
                    $detComproSiigo->setNatuMovcont($nat);//naturaleza C o D
                    $detComproSiigo->setVlBaseMovcont(0);//valor Base
                    $detComproSiigo->setIdCcMovcont("0001");//centro de costo
                    $detComproSiigo->setIdBodegaMovcont("0001");
                    $detComproSiigo->setCodalInvMovcont("0");
                    $detComproSiigo->setCantInvMovcont("1");
                    $detComproSiigo->setCodaltDepMovcont("0");
                    $detComproSiigo->setCodaltBodMovcont("0");
                    $detComproSiigo->setCodaltUbiMovcont("0");
                    $detComproSiigo->setCodaltCcMovcont($cc);
                    $detComproSiigo->setIdAreaMovcont("0");
                    $detComproSiigo->setCodaltSccMovcont($scc);//??
                    $detComproSiigo->setTpIdterMovcont("CC");
                    $detComproSiigo->setIdentTerMovcont($m["ids_ca_idalterno"]);//nit
                    $detComproSiigo->setTipConCarMovcont($tipoComprobante->getCaTipo());
                    $detComproSiigo->setComConCarMovcont($tipoComprobante->getCaComprobante());
                    $detComproSiigo->setNumConCarMovcont($consecutivo);
                    $detComproSiigo->setVctConCarMovcont(1);
                    if($tipoComprobante->getCaTipo()=="F")
                    {  
                        $fechComprobante=Utils::parseDate(($comprobante->getCaFchcomprobante()=="")?date("Y-m-d"):$comprobante->getCaFchcomprobante(), "Y-m-d");
                        if( !$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito() ||$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="" || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()<0 || $comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito()=="0" )
                        {
                            $dcredito=0;
                            $fchDocCruce=$comprobante->getCaFchcomprobante();
                        }
                        else
                            $dcredito=$comprobante->getIds()->getIdsCliente()->getLibCliente()->getCaDiascredito();
                        
                        if($dcredito>0)
                            $fchDocCruce=Utils::agregarDias($fechComprobante, $dcredito,  "Y-m-d");
                        else
                            $fchDocCruce=$comprobante->getCaFchcomprobante();
                    }
                    else
                    {
                        $fchDocCruce=$comprobante->getCaFchcomprobante();
                        $dcredito=0;
                    }
                    
                    if($fchDocCruce=="1999-12-30")
                    {
                        $fchDocCruce=$comprobante->getCaFchcomprobante();
                        $dcredito=0;
                    }
                    $detComproSiigo->setFecConMovcont($fchDocCruce);

                    $detComproSiigo->setNomTercMovcont("SIIGONECT");//
                    $detComproSiigo->setConceptoNomMovcont(0);
                    $detComproSiigo->setVariableAcumMovcont(0);
                    $detComproSiigo->setNroquinAcumMovcont(0);
                    $detComproSiigo->setTipModMovhbMovcont($ccosto->getCaTipmodsiigo());
                    $detComproSiigo->setRefMasMovhbMovcont( str_replace(".", "",  ($house)?$house->getInoMaster()->getCaReferencia() : ""  ));
                    $detComproSiigo->setNroBlhMovhbMovcont(  ($house)?$house->getCaDoctransporte():"" );
                    //try{
                        $detComproSiigo->save($conn);
                    /*}catch(Exception $e)
                    {13393
                        echo "<pre>";
                        print_r($m);13393
                        print_r($e->getTraceAsString());
                        echo "</pre>";
                        //$conn->rollback();
                    }*/
                }
            }
            //$autoret
            /*************************/

            /*$comprobante->setCaConsecutivo($consecutivo);
            $comprobante->setCaFchcomprobante(date("Y-m-d"));
            $comprobante->setCaValor($total/$comprobante->getCaTcambio());
            $comprobante->setCaValor2($total/$comprobante->getCaTcambio());
            //$comprobante->setCaUsugenero($this->getUser()->getUserId());
            //$comprobante->setCaFchgenero(date("Y-m-d H:i:s"));
            //$comprobante->setCaPlazo($dcredito);

            //$comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            //if($tipoComprobante->getCaTipo()=="C")
//                $comprobante->setCaEstado(InoComprobante::TRANSFERIDO);
            $comprobante->stopBlaming();
            $comprobante->save($conn);*/
            $conn->commit();

            if($tipoComprobante->getCaTipo()=="F")
            {

                try{
//                    $this->EnviarSiigoConect($idcomprobante);
                }catch(Exception $e) 
                {
                    
                }
            }
            
            
            $success=true;
        }
        /*catch(Exception $e)
        {
            $errorInfo=$e->getMessage();
            $conn->rollback();
            $success=false;
        }*/
        
        $this->responseArray = array("errorInfo" => $errorInfo,"info" => $info, "id" => implode(",", $ids), "idreg" => implode(",", $ids_reg), "success" => $success,"consecutivo"=>$consecutivo ,"indincor"=>$indincor,"wsdl"=>$result );
        $this->setTemplate("responseTemplate");
    
        
        
    }
    
    

    public function executeImportarEstadoSN(sfWebRequest $request) {

        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';


        //$tipo="C";
        /*
          $param=array("tipo"=>"C","file"=>"/srv/www/estadoclientesColtrans.xls","idempresa"=>"2");
          $param=array("tipo"=>"C","file"=>"/srv/www/estadoclientesColmas.xls","idempresa"=>"1");
          $param=array("tipo"=>"C","file"=>"/srv/www/estadoclientesColotm.xls","idempresa"=>"8");
          $param=array("tipo"=>"C","file"=>"/srv/www/estadoclientesColdepositos.xls","idempresa"=>"11");
         * 
         */

        /* $directory = "/home/maquinche/Desarrollo/clientesColtrans.xls";
          $directory = "/srv/www/estadoclientesColtrans.xls";
          $directory = "/srv/www/estadoclientesColmas.xls";
          $directory = "/srv/www/estadoclientesColdepositos.xls"; */

        /*
          $params = array();
          $params[]=array("tipo"=>"P","file"=>"/srv/www/estadoproveedoresColtrans.xls","idempresa"=>"2");
          $params[]=array("tipo"=>"P","file"=>"/srv/www/estadoproveedoresColmas.xls","idempresa"=>"1");
          $params[]=array("tipo"=>"P","file"=>"/srv/www/estadoproveedoresColotm.xls","idempresa"=>"8");
          $params[]=array("tipo"=>"P","file"=>"/srv/www/estadoproveedoresColdepositos.xls","idempresa"=>"11");
         */

        $params = array();
        //$params[]=array("tipo"=>"C","file"=>"/srv/www/clientesColtrans2.xls","idempresa"=>"2");
//        $params[]=array("tipo"=>"C","file"=>"/srv/www/estadoclientesColmas.xls","idempresa"=>"1");
//        $params[]=array("tipo"=>"C","file"=>"/srv/www/clientesColotm.xls","idempresa"=>"8");
//        $params[]=array("tipo"=>"C","file"=>"/srv/www/estadoclientesColdepositos.xls","idempresa"=>"11");
//        $params[]=array("tipo"=>"P","file"=>"/srv/www/proveedoresColtrans.xls","idempresa"=>"2");
//        $params[]=array("tipo"=>"P","file"=>"/srv/www/estadoproveedoresColmas.xls","idempresa"=>"1");
        //$params[]=array("tipo"=>"P","file"=>"/srv/www/proveedoresColotm.xls","idempresa"=>"8");
//        $params[]=array("tipo"=>"P","file"=>"/srv/www/estadoproveedoresColdepositos.xls","idempresa"=>"11");
        //$params[]=array("tipo"=>"C","file"=>"/srv/www/clientes11.xls","idempresa"=>"11");
        //$params[]=array("tipo"=>"C","file"=>"/srv/www/clientes12.xls","idempresa"=>"12");
           $params[]=array("tipo"=>"P","file"=>"/srv/www/proveedores11.xls","idempresa"=>"11");
           $params[]=array("tipo"=>"P","file"=>"/srv/www/proveedores12.xls","idempresa"=>"12");

        //$params[] = array("tipo" => "A", "file" => "/srv/www/estadoagentesColtrans.xls", "idempresa" => "2");

        foreach ($params as $param) {
            echo "<div>$param</div>";
            //echo PHPEXCEL_ROOT;
            $objPHPExcel = PHPExcel_IOFactory::load($param["file"]);
            //exit;
            $hojas = array();
            foreach ($objPHPExcel->getSheetNames() as $s) {
                $hojas[] = array("name" => $s);
            }

            //        print_r($hojas);
            $ws = $objPHPExcel->getSheetByName("SOCIOS DE NEGOCIOS");

            $posicion = array();
            $posicion['nit'] = 0;

            $array = $ws->toArray();
            //echo "<pre>";print_r($array[1]);echo "</pre>";
            //exit;
            //foreach( $array as $pos=>$row ){
            /* count($array) */
            $begin = 0;
            $end = count($array) - 1;
            echo "cantidad:" . $end . "<br>";
            $noencontrados = $encontrados = 0;
            for ($pos = $begin; $pos < $end; $pos++) {

                $row = $array[$pos];

                if ($pos < 2 /* || ($row[$posicion['tipo']]!="1" */) {
                    continue;
                }
                $nit = trim($row[0]);
                //echo $nit;
                if ($param["tipo"] == "C") {
                    $ff=1;
                    $ids = Doctrine::getTable("Cliente")->findOneBy("ca_idalterno", $nit);
                    if(!$ids)
                    {
                        $ids = Doctrine::getTable("Ids")
                            ->createQuery("i")
                            //->innerJoin("i.IdsProveedor p")
                            ->where("i.ca_idalterno = ?", array($nit))
                            ->fetchOne();
                        if($ids)
                        {
                            $ff=2;
                            echo "<span style='color: red'>Se creo encontro en IDS 1: " . $row[0]." ".$row[2]."</span><br>" ;
                            continue;
                        }
                        else
                        {
                            if($row[1]!="")
                            {
                                $nit = trim($row[1]);
                                $ff=1;
                                $ids = Doctrine::getTable("Cliente")->findOneBy("ca_idalterno", $nit);
                                if(!$ids)
                                {
                                
                                    $ids = Doctrine::getTable("Ids")
                                        ->createQuery("i")
                                        //->innerJoin("i.IdsProveedor p")
                                        ->where("i.ca_idalterno = ?", array($nit))
                                        ->fetchOne();

                                    if($ids)
                                    {
                                        $ff=2;
                                        echo "<span style='color: red'>Se creo encontro en IDS 2: " . $row[0]." ".$row[2]."</span><br>" ;
                                        continue;
                                    }
                                }
                            }                        
                        }
                    }
                    else
                    {
                        $ids->stopBlaming();
                        $ids->save();
                    }
                } else if ($param["tipo"] == "P") {
                    $ids = Doctrine::getTable("Ids")
                            ->createQuery("i")
                            //->innerJoin("i.IdsProveedor p")
                            ->where("i.ca_idalterno = ?", array($nit))
                            ->fetchOne();
                    if($ids)
                    {
                        $idsProveedor=$ids->getIdsProveedor();
                    
                        if(!$idsProveedor)
                        {
                            echo "<span style='color: red'>Se creo registro de Proveedor: " . $row[0]." ".$row[2]."</span><br>" ;
                            $idsProveedor=new IdsProveedor();

                            $idsProveedor->setCaIdproveedor($ids->getCaId());
                            $idsProveedor->setCaTipo("TRI");
                            $idsProveedor->setCaActivoImpo(false);
                            $idsProveedor->setCaActivoExpo(false);
                            $idsProveedor->stopBlaming();
                            $idsProveedor->save();
                        }
                        
                    }else
                    {
                        if($row[1]!="")
                        {
                            $nit = trim($row[1]);

                            $ids = Doctrine::getTable("Ids")
                                ->createQuery("i")
                                //->innerJoin("i.IdsProveedor p")
                                ->where("i.ca_idalterno = ?", array($nit))
                                ->fetchOne();
                            if($ids)
                            {
                                $idsProveedor=$ids->getIdsProveedor();

                                if(!$idsProveedor)
                                {
                                    echo "<span style='color: red'>Se creo registro de Proveedor: " . $row[0]." ".$row[2]."</span><br>" ;
                                    $idsProveedor=new IdsProveedor();

                                    $idsProveedor->setCaIdproveedor($ids->getCaId());
                                    $idsProveedor->setCaTipo("TRI");
                                    $idsProveedor->setCaActivoImpo(false);
                                    $idsProveedor->setCaActivoExpo(false);
                                    $idsProveedor->stopBlaming();
                                    $idsProveedor->save();
                                }

                            }
                        }
                    }
                    //$ids = Doctrine::getTable("Ids")->findOneBy("ca_idalterno",$nit);
                    
                } else if ($param["tipo"] == "A") {
                    preg_match('/^[a-zA-Z0-9]+$/', $nit, $matches);
                    $ids = Doctrine::getTable("Ids")
                            ->createQuery("i")
                            ->innerJoin("i.IdsAgente p")
                            ->where("regexp_replace(i.ca_idalterno, '[^a-zA-Z0-9]+', '','g') = ?", array($matches[0]))
                            ->fetchOne();

                    //$ids = Doctrine::getTable("Ids")->findOneBy("ca_idalterno",$nit);
                    
                }
                
                if ($ids) {
                    if ($param["tipo"] == "C") {
                        if($ff==1)
                        {
                            $msj = $pos . "->" . $ids->getCaIdcliente() . " " . $ids->getCaCompania() . "-------<br>";
                            $ca_id = $ids->getCaIdcliente();
                        }
                        else
                        {
                            $ca_id = $ids->getCaId();
                            $msj = $pos . "->" . $ca_id . " " . $ids->getCaNombre() . "-------<br>";                        
                        }
                    } else if ($param["tipo"] == "P") {
                        $ca_id = $ids->getCaId();
                        $msj = $pos . "->" . $ca_id . " " . $ids->getCaNombre() . "-------<br>";                        
                    } else if ($param["tipo"] == "A") {
                        $ca_id = $ids->getCaId();
                        $msj = $pos . "->" . $ca_id . " " . $ids->getCaNombre() . "-------<br>";
                    }
                    
                    
                    $encontrados++;
                    //echo $msj;
                    $estados = Doctrine::getTable("IdsEstadoSap")
                            ->createQuery("e")
                            ->where("e.ca_id = ?", $ca_id)
                            ->addWhere("e.ca_tipo = ?", $param["tipo"])
                            ->addWhere("e.ca_idempresa = ?", $param["idempresa"])
                            ->fetchOne();
                    if (!$estados) {
                        $estados = new IdsEstadoSap();
                        $estados->setCaId($ca_id);
                        $estados->setCaTipo($param["tipo"]);
                        $estados->setCaIdempresa($param["idempresa"]);
                    }
                    $estados->setCaActivo(true);
                    $estados->save();
                    
                    /*$trans= new IntTransaccionesOut();
                    $trans->setCaIdtipo(2);
                    $trans->setCaIndice1($ca_id);
                    $trans->setCaIndice2($param["idempresa"]);
                    $trans->setCaEstado("A");
                    $trans->save();*/
                    
                    
                } else {
                    $noencontrados++;
                    echo "No Importado: " . $row[0]." ".$row[2] . "<br>";
                }
            }
            echo "--------------------------------------------------------<br><br>";
            echo "NO ENCONTRADOS:" . $noencontrados . "<br>";
            echo "ENCONTRADOS:" . $encontrados . "<br>";
            echo "--------------------------------------------------------<br><br>";
        }

        //$array = $ws->toArray();
        exit;
    }

    public function executeActualizarIdsSN(sfWebRequest $request) {

        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';


        $param = array("tipo" => "A", "file" => "/srv/www/PlantillaAgentesySucursales.xls", "idempresa" => "2");

        //echo PHPEXCEL_ROOT;
        $objPHPExcel = PHPExcel_IOFactory::load($param["file"]);
        //exit;
        $hojas = array();
        foreach ($objPHPExcel->getSheetNames() as $s) {
            $hojas[] = array("name" => $s);
        }

//        print_r($hojas);
        $ws = $objPHPExcel->getSheetByName("Agentes y Sucursales");

        $posicion = array();
        $posicion['ca_id'] = 0;

        $array = $ws->toArray();
        //echo "<pre>";print_r($array[1]);echo "</pre>";
        //exit;
        //foreach( $array as $pos=>$row ){
        /* count($array) */
        $begin = 0;
        $end = count($array) - 1;
        echo "cantidad:" . $end . "<br>";
        
        
        $noencontrados = $encontrados = $noprocesado = 0;
        for ($pos = $begin; $pos < $end; $pos++) {

            $row = $array[$pos];

            if ($pos < 2 /* || ($row[$posicion['tipo']]!="1" */) {
                continue;
            }

            $id = $row[0];
            // echo $id;
            
            $ids = Doctrine::getTable("Ids")->find($id);

            if ($ids) {
                $tipoId = substr($row[3], 0, strpos($row[3], "(")-1);
                $idsTipoId = Doctrine::getTable("IdsTipoIdentificacion")
                            ->createQuery("t")
                            ->where("t.ca_nombre = ?", $tipoId)
                            ->addWhere("t.ca_idtrafico = ?", $row[4])
                            ->fetchOne();
                
                if ( trim($row[1]) <> "" && strlen(trim($row[1])) <= 20) {
                    $msj = $pos . "->" . $ids->getCaIdalterno() . " " . $ids->getCaNombre() . " -> " . $row[1] . " TipoId " . $row[3];
                    
                    if (!$idsTipoId && !$ids->getCaTipoidentificacion()) {
                        $tipoId = null;
                    } else if (!$idsTipoId && $ids->getCaTipoidentificacion() == 3) {
                        $tipoId = null;
                    } else if ((!$idsTipoId || $idsTipoId->getCaTipoidentificacion() == 3) && (!$ids->getCaTipoidentificacion() || $ids->getCaTipoidentificacion() == 3)) {
                        $tipoId = null;
                    } else if ($idsTipoId && $idsTipoId->getCaTipoidentificacion() != 3 && (!$ids->getCaTipoidentificacion() || $ids->getCaTipoidentificacion() == 3)) {
                        $tipoId = $idsTipoId->getCaTipoidentificacion();
                    } else if ((!$idsTipoId || $idsTipoId->getCaTipoidentificacion() == 3) && $ids->getCaTipoidentificacion() && $ids->getCaTipoidentificacion() != 3) {
                        $tipoId = $ids->getCaTipoidentificacion();
                    } else if ($idsTipoId->getCaTipoidentificacion() == $ids->getCaTipoidentificacion()) {
                        $tipoId = $idsTipoId->getCaTipoidentificacion();
                    } else {
                        $tipoId = null;
                    }
                    
                    // Actualiza el IDALTERNO
                    $ids->setCaIdalterno(trim($row[1]));
                    $ids->setCaTipoidentificacion($tipoId);
                    $ids->save();
                    $msj.= " | Nuevo Tipo de Identificacion " . $tipoId . "<br>";
                    
                    $encontrados++;
                    echo $msj;
                } else {
                    $msj = "No procesados : " . $pos . "->" . $ids->getCaIdalterno() . " " . $ids->getCaNombre() . " -> " . $row[1] . "<br>";
                    $noprocesado++;
                    echo $msj;
                }
            } else {
                $noencontrados++;
                echo "No Importado: " . $row[0] . "<br>";
            }
        }
        echo "--------------------------------------------------------<br><br>";
        echo "NO ENCONTRADOS:" . $noencontrados . "<br>";
        echo "ENCONTRADOS:" . $encontrados . "<br>";
        echo "NO PROCESADOS:" . $noprocesado . "<br>";
        echo "--------------------------------------------------------<br><br>";


        //$array = $ws->toArray();
        exit;
    }

    public function executeCondicionesCredito(sfWebRequest $request) {
        $libCliente = Doctrine::getTable("LibCliente")
                ->createQuery("l")
                ->execute();
        $empresas = array(1, 2, 8, 11, 12);
        
        foreach ($libCliente as $condicion) {
            foreach ($empresas as $empresa) {
                $idsCredito = new IdsCredito();
                $idsCredito->setCaId($condicion->getCaIdcliente());
                $idsCredito->setCaCupo($condicion->getCaCupo());
                $idsCredito->setCaDias($condicion->getCaDiascredito());
                $idsCredito->setCaTipo("C");
                $idsCredito->setCaIdempresa($empresa);
                $idsCredito->setCaObservaciones($condicion->getCaObservaciones());
                $idsCredito->setCaUsucreado($condicion->getCaUsucreado());
                $idsCredito->setCaFchcreado($condicion->getCaFchcreado());
                $idsCredito->save();
            }
        }
        exit;
    }
    
    public function executeReferenciasCostos(sfWebRequest $request) {
        
        //echo $request->getParameter("idmaster");
        
        $master = Doctrine::getTable("InoMaster")
                ->createQuery("c")
                ->select("*")
                ->where("ca_idmaster = ?", $request->getParameter("idmaster"))
                ->fetchOne();
        
        $clientes = array();
        $datos = array();
        
                
        //Lineas        
        $lineas = Doctrine::getTable("InoHouse")
                ->createQuery("h")
                ->select("*")
                ->where("ca_idmaster = ?", $master->getCaIdmaster())
                ->execute();        
        
        
        $costos = Doctrine::getTable("InoCosto")
                ->createQuery("c")
                ->select("*")
                ->leftJoin("c.InoHouse h")
                ->where("ca_idmaster = ?", $master->getCaIdmaster())
                ->execute();
            
        
        foreach($costos as $costo){
            $idcliente = $costo->getCaIdhouse()?$costo->getInoHouse()->getCaIdcliente():null;
            if($idcliente){
                $ct[$idcliente]+=$costo->getCaNeto();
                }else{
                $ct["General"]+=$costo->getCaNeto();
                }
            }
            
            
        $tot_costo = array_sum($ct);
        
        foreach($lineas as $linea){            
            $peso[$linea->getCaIdcliente()]+= $master->getCaTransporte()=="Marï¿½timo"?$linea->getCaVolumen():$linea->getCaPeso();;
            if(!in_array($linea->getCaIdcliente(), $clientes))
                $clientes[] = $linea->getCaIdcliente();
        }
        $tot_peso = array_sum($peso);
        
        foreach($lineas as $linea){            
            $distribucion[$linea->getCaIdcliente()] = $peso[$linea->getCaIdcliente()]/$tot_peso;
        }
        
        $tot_distribucion = array_sum($distribucion);
        
        /*if(array_sum($distribucion)!=100){
            $diff = 100 -array_sum($distribucion);
            $distribucion[0]+= $diff;
        }*/
        
        foreach($clientes as $cliente){            
            $ctxCliente[$cliente]+= ($ct[$cliente]+$ct["General"])*$distribucion[$cliente];
        }
        
        $tot_costos = array_sum($ctxCliente);
        
        foreach($lineas as $linea){  
            //echo $ctxCliente[$linea->getCaIdcliente()]."<br/>";
            //echo $tot_costos;
            //if(!in_array($linea->getCaIdcliente(), $clientes)){            
                $datos["Lineas"][] = array("CardCode"=>"C".$linea->getCliente()->getCaIdalterno(), "PorcParticipa"=>round($ctxCliente[$linea->getCaIdcliente()]/$tot_costos*100,2));
                //$clientes[] = $linea->getCaIdcliente();
            //}
        }
        
        $tot_costos = array_sum($costoxCliente);
       
        
        
        echo "<b>Idmaster</b>:".$master->getCaIdmaster()."<br/>";
        echo "<b>Referencia:</b>".$master->getCaReferencia()."<br/>";
        
        echo "<b>Peso:</b>";
        echo "<pre>";print_r($peso)."</pre><br><br>";
        echo "<i>Total peso:</i>".$tot_peso."<br/><br/>";
        
        echo "<b>Clientes:</b>";
        echo "<pre>";print_r($clientes)."</pre><br><br>";
       
        echo "<b>Distribuciï¿½n x Peso:</b>";
        echo "<pre>";print_r($distribucion)."</pre><br/><br/>";
        
        echo "<i>Total distribucion:</i>". $tot_distribucion."<br/><br/>";
        
        echo "<b>Costos x Cliente:</b><br/>";
        echo "<pre>";print_r($ct)."</pre><br/><br/>";
        echo "<i>Total costos:</i>". $tot_costo."<br/><br/>";
        
        echo "<b>Costo x Cliente + Prorateo de Costo General:</b>";
        echo "<pre>";print_r($ctxCliente)."</pre><br/><br/>";
        
        echo "<b>Datos</b>";
        echo "<pre>";print_r($datos)."</pre><br/><br/>";
        
        
        
        $this->setTemplate("responseTemplate");
    }
    
    public function executeActualizarCostos(sfWebRequest $request) {
        
        $con1 = Doctrine_Manager::getInstance()->getConnection('master');
        $sql1="SELECT d.ca_idmaster, d.ca_idconcepto, c.ca_consecutivo, c.ca_fchcomprobante, c.ca_id, c.ca_idmoneda, c.ca_tcambio, d.ca_cr, c.ca_idcomprobante, d.ca_idhouse
            FROM ino.tb_detalles d
                    INNER JOIN ino.tb_comprobantes c ON d.ca_idcomprobante = c.ca_idcomprobante
            WHERE d.ca_idcomprobante = 57088";
        $st = $con1->execute($sql1);
        $detalles = $st->fetchAll();
        
        echo "<pre>";print_r($detalles);echo "<pre>";

        foreach($detalles as $detalle){
            $idhouse = $detalle["ca_idhouse"]?$detalle["ca_idhouse"]:'null';
            $neto = $detalle["ca_cr"]*-1;
            $venta = round($detalle["ca_cr"]*$detalle["ca_tcambio"]*-1, 2, PHP_ROUND_HALF_UP);
            $con2 = Doctrine_Manager::getInstance()->getConnection('master');
            $sql2="INSERT INTO ino.tb_costos (ca_idmaster, ca_idcosto, ca_factura, ca_fchfactura, ca_idproveedor, ca_idmoneda, ca_tcambio, ca_tcambio_usd, ca_neto, ca_venta, ca_idcomprobante, ca_idhouse, ca_fchcreado, ca_usucreado) "
                    . "VALUES (".$detalle["ca_idmaster"].",".$detalle["ca_idconcepto"].",'".$detalle["ca_consecutivo"]."','".$detalle["ca_fchcomprobante"]."',".$detalle["ca_id"].",'".$detalle["ca_idmoneda"]."',".$detalle["ca_tcambio"].",1,".$neto.",".$venta.",".$detalle["ca_idcomprobante"].",".$idhouse.",'".date("Y-m-d H:i:s")."','sap')";
            echo $sql2;
            $st = $con2->execute($sql2);
        }
        $this->setTemplate("responseTemplate");
    }
    
    public function executeDatosGridHouse(sfWebRequest $request) {
        $idmaster = $request->getParameter("idmaster");
        $this->forward404Unless($idmaster);
        $inoHouses = Doctrine::getTable("InoHouse")
                ->createQuery("c")
                ->select("c.*, cl.*")
                //->innerJoin("c.Ids cl")
                ->innerJoin("c.Cliente cl")
                ->where("c.ca_idmaster = ?", $idmaster)
                ->addOrderBy("cl.ca_compania")
                ->execute();

        $data = array();
        foreach ($inoHouses as $inoHouse) {
            $row = array();
            $row["idmaster"] = $inoHouse->getCaIdmaster();
            $row["idhouse"] = $inoHouse->getCaIdhouse();
            $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());
            $row["fchdoctransporte"] = $inoHouse->getCaFchdoctransporte();
            $row["numorden"] = utf8_encode($inoHouse->getCaNumorden());
            $row["idcliente"] = $inoHouse->getCliente()->getCaIdcliente();
            $row["cliente"] = utf8_encode($inoHouse->getCliente()->getCaCompania());
            $row["vendedor"] = $inoHouse->getCaVendedor();
            $row["idreporte"] = $inoHouse->getCaIdreporte();
            $row["reporte"] = $inoHouse->getReporte()->getCaConsecutivo();
            $row["numpiezas"] = $inoHouse->getCaNumpiezas() . " " . utf8_encode($inoHouse->getCaMpiezas());
            //$totales["numpiezas"] +=$inoHouse->getCaNumpiezas();
            $row["peso"] = $inoHouse->getCaPeso();
            //$totales["peso"] +=$inoHouse->getCaPeso();
            $row["volumen"] = $inoHouse->getCaVolumen();
            //$totales["volumen"] +=$inoHouse->getCaVolumen();
            $row["idtercero"] = $inoHouse->getCaIdtercero();
            $row["tercero"] = utf8_encode($inoHouse->getTercero()->getCaNombre());
            $row["bodega"] = $inoHouse->getCaIdbodega();
            $bodega = Doctrine::getTable("Bodega")->find($inoHouse->getCaIdbodega());
            if ($bodega) {
                $row["nombrebodega"] = utf8_encode($bodega->getCaNombre());
            }
            $comprobantes = $inoHouse->getInoComprobante();
            if (count($comprobantes) < 1) {
                $row["color"] = "pink";
            }
            $row["planilla"] = $datos["planilla"];
            $row["url"] = $inoHouse->getVendedor()->getImagenUrl('60x80');
            $row["global"] = $inoHouse->getCliente()->getProperty("cuentaglobal");
            $row["comunicaciones"] = $inoHouse->getCliente()->getProperty("consolidar_comunicaciones");

            $inoHouseSea = $inoHouse->getInoHouseSea();
            
            $datosMuisca = json_decode(utf8_encode($inoHouseSea->getCaDatosmuisca()), true);
            
            echo "<pre>";print_r($datosMuisca);echo "</pre>";

            $row["continuacion"] = $inoHouseSea->getCaContinuacion();
            $row["destinofinal"] = $inoHouseSea->getCaContinuacionDest();
            $row["datos"] = $datos;
            $row["datosMuisca"] = $datosMuisca;
            $row["dispocarga"] = $datosMuisca["dispocarga"];
            //print_r($datos);
            //exit;
            $inoEquipos = Doctrine::getTable("InoEquipo")
                    ->createQuery("e")
                    ->select("e.* ")
                    ->where("e.ca_idmaster = ?", $idmaster)
                    ->addOrderBy("e.ca_idequipo")
                    ->execute();
            $equipos = array();
            foreach ($inoEquipos as $e) {
                $piezas = "";
                $kilos = "";
                if ($datos["equipos"]) {
                    foreach ($datos["equipos"] as $de) {
                        if ($de["idconcepto"] == $e->getCaIdconcepto()) {
                            $piezas = $de["piezas"];
                            $kilos = $de["kilos"];
                            continue;
                        }
                    }
                }
                $equipos[] = array("sel" => true, "idequipo" => $e->getCaIdequipo(), "idconcepto" => $e->getConcepto()->getCaIdconcepto(), "concepto" => $e->getConcepto()->getCaConcepto(), "serial" => $e->getCaSerial(), "numprecinto" => $e->getCaNumprecinto(), "piezas" => $piezas, "kilos" => $kilos);
            }
            $row["equipos"] = $equipos;
            $data[] = $row;
        }

        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data), "ncomprobantes" => count($comprobantes));

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosReporteCarga(sfWebRequest $request) {

        $data = array();
        $reporte = Doctrine::getTable("Reporte")->find($request->getParameter("idreporte"));

        $prov = $reporte->getProveedores();
        if (count($prov) > 0) {
            $data["idproveedor"] = $prov[0]->getCaIdtercero();
            $data["proveedor"] = $prov[0]->getCaNombre();
        }

        $data["origen"] = $reporte->getDocTransporte();
        $data["impoexpo"] = utf8_encode($reporte->getCaImpoexpo());
        $data["transporte"] = utf8_encode($reporte->getCaTransporte());
        $data["modalidad"] = $reporte->getCaModalidad();
        $data["origen"] = $reporte->getCaOrigen();
        $data["destino"] = $reporte->getCaDestino();
        $data["idlinea"] = $reporte->getCaIdlinea();
        $data["linea"] = utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());
        $data["idagente"] = $reporte->getCaIdagente();
        $data["ca_fchsalida"] = $reporte->getEts();
        $data["ca_fchllegada"] = $reporte->getEta();
        $data["ca_master"] = $reporte->getCaDocmaster();
        $repstatus = $reporte->getUltimoStatus();

        if ($repstatus) {
            $data["ca_peso"] = $repstatus->getCaPeso();
            $data["ca_piezas"] = $repstatus->getCaPiezas();
            $data["ca_volumen"] = $repstatus->getCaVolumen();
            $data["ca_docmaster"] = $repstatus->getCaDocmaster();
        }

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeEnvioMasivoSN(sfWebRequest $request) {

        $idempresa=1;
        $tipoCl='E';
        $tipoTr=5;

        
        
        $usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.Cargo c")                    
                    ->where("c.ca_ventas = true AND ca_activo = true")
                    ->execute();
        
        foreach($usuarios as $u)
        {
            echo $u->getCaLogin()." : ".$u->getCaCargo()."<br>";
            $trans= new IntTransaccionesOut();
            $trans->setCaIdtipo($tipoTr);
            //$trans->setCaIndice1($e->getCaId());
            $trans->setCaIndice1($u->getCaLogin());
            //$trans->setCaIndice2($e->getEmpresa()->getCaIdsap());
            $trans->setCaIndice2("4");
            $trans->setCaEstado("A");
            $trans->save();
        }
        //echo count($estados);
        exit;
        
    }
    
    
    public function executeDatosPie( sfWebRequest $request  ){

        set_time_limit(3000);
        ini_set('max_execution_time', 3000);
        
        
        $festivos = TimeUtils::getFestivos(date("Y"));

        $festivos1=array_merge($festivos,$this->getFestivos());

        try{

        $datos=array();
        $tipo = $request->getParameter("tipo");
        $fecha1 = $request->getParameter("fecha1");
        $fecha2 = $request->getParameter("fecha2");
        
        $eta1 = $request->getParameter("eta1");
        $eta2 = $request->getParameter("eta2");
        
        $q = Doctrine::getTable("AduFalaDetControl")
                            ->createQuery("c")                
                            ->select("c.*,f.ca_fecha,f.ca_muelle,m.ca_datos,m.ca_fchdespcarga,m.ca_fchfacturacion")
                            ->innerJoin("c.AduFalaCabControl f")
                            ->innerJoin("c.InoMaestraAdu m")
                             //->where("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) )
                            ->addOrderBy( "c.ca_id_fal_det_control " )
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        
        if($fecha1!="" && $fecha2!="")
        {
            $q->addWhere("ca_fchlevante BETWEEN ? AND ?  ",  array($fecha1,$fecha2) );
        }
        
        if($eta1!="" && $eta2!="")
        {
            $q->addWhere("f.ca_fecha BETWEEN ? AND ?  ",  array($eta1,$eta2) );
        }

        $debug=$q->getSqlQuery();
        $datos=$q->execute();
        $festivos = TimeUtils::getFestivos(date("Y"));
        $sum_diashab=0;
        $prom_diashab=0;
        $sum_diaseta=0;
        $prom_diaseta=0;
        $consolidadosnc=array();
        $diasetax=array();
        
        $tra = ParametroTable::retrieveByCaso("CU249");
        foreach ($tra as $t)
        {
            $transportador[$t->getCaIdentificacion()]=$t->getCaValor();
        }
        
        $demorasDocNew["tipo"]["Bl"]=0;
        $demorasDocNew["tipo"]["Factura"]=0;
        $demorasDocNew["tipo"]["Flete"]=0;
        $demorasDocNew["tipo"]["OC"]=0;
        $demorasDocNew["tipo"]["Otro"]=0;
        $demorasDocNew["total"]=0;
        $totalprobbl=0;
        foreach($datos as $k=>$c)
        {
            $datosJson= json_decode($datos[$k]["c_ca_datos"]);
            $datosJsonMaster= json_decode($datos[$k]["m_ca_datos"]);

            $lineaP=($datosJson->linea)?$datosJson->linea:substr($c["c_ca_carpeta"],12,3);

            $muelleP=($datosJson->terminal!="")?str_replace(' ', '', $datosJson->terminal):$datos[$k]["f_ca_muelle"];

            $datos[$k]["problemabl"]=(($datosJson->problemasbl!="")?$datosJson->problemasbl:"Ok");            
            $datos[$k]["problemafactura"]=(($datosJson->problemasfactura!="")?$datosJson->problemasfactura:"Ok");
            
            $datos[$k]["descripcionmindemora"]=$datosJson->descripcionmindemora;
            $datos[$k]["naviera"]=$datosJson->naviera;
            
            
            $this->tmp = ParametroTable::retrieveByCaso("CU247", null,null,$c["c_ca_lognet"]);
            $datos[$k]["c_ca_lognet"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            $this->tmp = ParametroTable::retrieveByCaso("CU248", null,null,$c["c_ca_blimpresion"]);
            $datos[$k]["c_ca_blimpresion"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
               
            $this->tmp = ParametroTable::retrieveByCaso("CU249", null,null,$c["c_ca_transportador"]);
            $datos[$k]["c_ca_transportador"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            $this->tmp = ParametroTable::retrieveByCaso("CU250", null,null,$c["c_ca_tipocarga"]);
            $datos[$k]["c_ca_tipocarga"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
            
            $datosJson->provetiquetado=trim($datosJson->provetiquetado);            
       
            $datos[$k]["linea"]=$lineaP;
            $datos[$k]["muelle"]=$muelleP;
            $datos[$k]["razondemora"]=utf8_encode($datosJson->razondemora);
            
            if($c["f_ca_fecha"]!="")
            {
                if($c["c_ca_fchrecepcion"]!="")
                    $datos[$k]["demoradocs"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchrecepcion"]));
                    
                $datos[$k]["diasbl"]=$c["c_ca_inspeccion"];
                
                
                if($c["c_ca_fchdescripciones"]!="" || $c["c_ca_fchrecepcion"]!="")
                {
                    $fechatmp="";                    
                    switch(Utils::compararFechas($c["c_ca_fchdescripciones"], $c["c_ca_fchrecepcion"]))
                    {
                        case "0":
                        case "1":
                            $fechatmp=$c["c_ca_fchdescripciones"];
                        break;
                        case "-1":
                            $fechatmp=$c["c_ca_fchrecepcion"];
                        break;
                    }

                    if(Utils::compararFechas($fechatmp,$c["f_ca_fecha"])==1)
                    {
                        $datos[$k]["atiempo"]= "No";
                    }
                    else
                        $datos[$k]["atiempo"]= "Si";

                    $datos[$k]["demoradescmin"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchdescripciones"]));
                    if(Utils::compararFechas($c["c_ca_fchdescripciones"],$c["f_ca_fecha"])==1)
                    {
                        $datos[$k]["atiempodm"]= "No";
                        $indicador["descripciones"]["nocumple"]++;
                        $indicador["descripciones"]["muelle"][$muelleP]["nocumple"]++;
                        $indicador["descripciones"]["linea"][$lineaP]["nocumple"]++;
                    }
                    else
                        $datos[$k]["atiempodm"]= "Si";

                    $indicador["descripciones"]["linea"][$lineaP ]["total"]++;
                    $indicador["descripciones"]["muelle"][$muelleP]["total"]++;
                }
                
                if($c["c_ca_fchlevante"]!="")
                {
                    $datos[$k]["diasnaleta"]=TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchlevante"]);
                    $sum_diaseta+=$datos[$k]["diasnaleta"];
                    $diasetax["linea"][$c["c_ca_consolidado"]]["total"]++;                    
                    $diasetax["linea"][$c["c_ca_consolidado"]]["suma"]+=$datos[$k]["diasnaleta"];
                    $diasetax["muelle"][$muelleP]["total"]++;
                    $diasetax["muelle"][$muelleP]["suma"]+=$datos[$k]["diasnaleta"];
                    
                    $no_diaseta++;

                    if(Utils::compararFechas($c["c_ca_fchconsinv"],$fechatmp)==1)
                    {
                        $fechatmp=$c["c_ca_fchconsinv"];
                    }

                    $datos[$k]["diasnalhab"]=(TimeUtils::workDiff($festivos,$fechatmp,$c["c_ca_fchlevante"]));
                    $sum_diashab+=$datos[$k]["diasnalhab"];
                    $no_diashab++;
                    
                    $datos[$k]["demBl"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchbl"]));
                    $datos[$k]["demFactura"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchfactura"]));
                    $datos[$k]["demFlete"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$c["c_ca_fchcertfletes"]));
                    
                    $dem=array("Bl"=>$datos[$k]["demBl"],"Factura"=>$datos[$k]["demFactura"],"Flete"=>$datos[$k]["demFlete"]);
                    
                    
                    $datos[$k]["numerodoc"]="";
                    if($datosJson->demoraoc=="SI")
                    {
                        $datos[$k]["demTipoDoc"]="OC";
                        $datos[$k]["demTipoDoc1"]="OC";
                        $datos[$k]["diasdemora"]="N/A";
                    }
                    else if($datosJson->demoraotrodoc!="" && $datosJson->demoraotrodoc!="N/A")
                    {
                        $datos[$k]["demTipoDoc"]="Otro";
                        $datos[$k]["demTipoDoc1"]=$datosJson->demoraotrodoc;
                        $datos[$k]["diasdemora"]=$datos[$k]["demFlete"]=floor(TimeUtils::dateDiff($c["f_ca_fecha"],$datosJson->fchdemoraotrodoc));;
                    }
                    else
                    {
                        
                        arsort($dem);
                        /*echo "<pre>";
                        print_r($dem);
                        echo "</pre>";*/
                        //if(count($dem)>-1)
                        foreach($dem as $key=>$d)
                        {
                          //$d=$dem[count($dem)-1];
                        //echo $key."==".$d."<br>";
                            if($d>0)
                            {
                                //echo $key."<br>";
                                $datos[$k]["demTipoDoc"]=$key;
                                $datos[$k]["demTipoDoc1"]=$key;
                                $datos[$k]["diasdemora"]=$d;
                                switch($key)
                                {
                                    case "Bl":
                                        $tdoc=$datos[$k]["c_ca_bl"];
                                    break;
                                    case "Factura":
                                        $tdoc=$datos[$k]["c_ca_factura"];
                                    break;
                                    case "Flete":
                                        $tdoc=$datos[$k]["c_ca_certfletes"];
                                    break;
                                }
                                $datos[$k]["numerodoc"]=$tdoc;
                                break;
                            }
                            else
                            {
                                $datos[$k]["demTipoDoc"]="OK";
                                $datos[$k]["demTipoDoc1"]="OK";
                                $datos[$k]["diasdemora"]=0;
                            }                            
                        }
                    }
                    if( $datos[$k]["demTipoDoc"]!="OK")
                    {
                        
                        $demorasDocNew["tipo"][$datos[$k]["demTipoDoc"]]++ ;
                        $demorasDocNew["total"]++;
                    }
                }
                
                if($c["m_ca_fchdespcarga"]!="" && $c["m_ca_fchfacturacion"]!="" )
                {
                    $datos[$k]["diaspromfact"]=(TimeUtils::workDiff($festivos1,$c["m_ca_fchdespcarga"],$c["m_ca_fchfacturacion"]));                    
                    $diasetax["promfact"][$c["c_ca_referencia"]]["total"]="1";
                    $diasetax["promfact"][$c["c_ca_referencia"]]["suma"]=$datos[$k]["diaspromfact"];
                }
                
                if($datosJson->provetiquetado!="" && $datosJson->provetiquetado!="N/A" )
                {
                    $datos[$k]["etiqueta"]="S";
                    $datos[$k]["provetiqueta"]= utf8_encode($datosJson->provetiquetado);
                    $datos[$k]["fechaetiqueta1"]=$datosJson->fchetiqueta1;
                    $datos[$k]["fechaetiqueta2"]=$datosJson->fchetiqueta2;
                    $datos[$k]["diasetiqueta"]=floor(TimeUtils::dateDiff($datosJson->fchetiqueta1,$datosJson->fchetiqueta2));
                    
                    $diasetax["provetiqueta"][$datos[$k]["provetiqueta"]]["total"]++;
                    $diasetax["provetiqueta"][$datos[$k]["provetiqueta"]]["suma"]+=$datos[$k]["diasetiqueta"];
                }
                else
                    $datos[$k]["etiqueta"]="N";
                }
            if(!$consolidados[$datos[$k]["c_ca_consolidado"]])
            {
                $consolidados[$datos[$k]["c_ca_consolidado"]]="nocumple";
                //$consolidadosnc[]=$datos[$k]["c_ca_consolidado"];                
            }            
            
            $indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]]["valor"] = $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]?$indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]:0;
            $containers[$muelleP][$datos[$k]["c_ca_consolidado"]] = $containers[$muelleP][$datos[$k]["c_ca_consolidado"]]?$containers[$muelleP][$datos[$k]["c_ca_consolidado"]]:"nocumple";
            
            if( $datos[$k]["c_ca_preinspeccion"]=="true" || $datos[$k]["c_ca_preinspeccion"]=="1" || $datos[$k]["c_ca_inspeccion"]=="true" || $datos[$k]["c_ca_inspeccion"]=="1")
            {
                if($datos[$k]["diasnalhab"]>4)
                {
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]][$datos[$k]["f_ca_muelle"]]=1;
                }
                else
                {
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]][$muelleP]=1;
                    $consolidados[$datos[$k]["c_ca_consolidado"]]="cumple";
                    $containers[$muelleP][$datos[$k]["c_ca_consolidado"]] = "cumple";
                }
            }
            else{
                if($datos[$k]["diasnalhab"]>2)
                {
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    //$indicador["nacionalizacion"]["nocumple"][$datos[$k]["c_ca_consolidado"]][$datos[$k]["f_ca_muelle"]]=1;
                }
                else
                {
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]]["valor"]++;
                    $indicador["nacionalizacion"]["cumple"][$datos[$k]["c_ca_consolidado"]][$muelleP]=1;
                    $consolidados[$datos[$k]["c_ca_consolidado"]]="cumple";
                    $containers[$muelleP][$datos[$k]["c_ca_consolidado"]] = "cumple";
                }
            }

            $cumplimiento = array_count_values($consolidados);
            
            foreach ($containers as $mue =>$val) {             
                $count_values[$mue] = array_count_values($val);                
            }            
            
            if($datos[$k]["demoradocs"]>1)
            {
                $indicador["documentos"]["nocumple"]++;
                $indicador["documentos"]["muelle"][$muelleP]["nocumple"]++;
            }
            $indicador["documentos"]["muelle"][$muelleP]["total"]++;
            
            if($datos[$k]["diasbl"])
            {
                $datos[$k]["demorabl"]="Si";
                $indicador["demorabl"]["nocumple"]++;
                $indicador["demorabl"]["muelle"][$muelleP]["nocumple"]++;
                
                $indicador["demorabl2"][$muelleP]["nocumple"][$datos[$k]["c_ca_bl"]]=1;
                
            }
            else
            {
                $datos[$k]["demorabl"]="No";
                $indicador["demorabl2"][$muelleP]["cumple"][$datos[$k]["c_ca_bl"]]=1;
            }
            
            $indicador["demorabl2"][$muelleP]["total"][$datos[$k]["c_ca_bl"]]=1;
            
            $indicador["demorabl"]["muelle"][$muelleP]["total"]++;
            
            $indicador["contenedor"][$muelleP][$c["c_ca_contenedor"]]++;
            //$indicador["contenedor"]["total"]++;
            $indicador["contenedor"][($c["c_ca_preinspeccion"]==true?"Si":"No")][$c["c_ca_contenedor"]]++;
            if($c["c_ca_inspeccion"]==true)
                $indicador["bls"][$c["c_ca_bl"]]++;
            $indicador["tipocontenedor"][$muelleP][$c["c_ca_tipocontenedor"]][$c["c_ca_contenedor"]][]=1;
            
            $problemabl[$datos[$k]["problemabl"]]++;
            $problemafactura[$datos[$k]["problemafactura"]]++;
            
            $transp[utf8_encode($transportador[$c["c_ca_transportador"]])][$c["c_ca_contenedor"]]++;
            if(!in_array($c["c_ca_referencia"],$bls_declara))
            {
                $bls_declara[]=$c["c_ca_referencia"];
                $declara["fisico"]+=$datosJsonMaster->nfisico;            
                $declara["automatico"]+=$datosJsonMaster->nautomatico;
            }
            
            $this->tmp = ParametroTable::retrieveByCaso("CU249", null,null,$c["c_ca_transportador"]);
            $datos[$k]["c_ca_transportador"]=(!$this->tmp[0]->getCaValor2()?$this->tmp[0]->getCaValor():$this->tmp[0]->getCaValor2());
                            
            $indicador["total"]++;
        }
        
        //print_r($bls_declara);
        //exit;
        
        foreach($consolidados as $k=>$c)
        {
            if($c=="cumple")
                continue;
            $consolidadosnc[]=$k;
        }        
        
        foreach($datos as $k=>$c)
        {
            if(in_array($datos[$k]["c_ca_consolidado"], $consolidadosnc))
            {
                $datos[$k]["consnal"]=1;                
            }
            else
                $datos[$k]["consnal"]=0;
        }
            
                
        $prom_diashab=$sum_diashab/$no_diashab;
        $prom_diaseta=$sum_diaseta/$no_diaseta;
        
        $sum["prom_diashab"]["total"]=$prom_diashab;
        $sum["prom_diashab"]["sum_diashab"]=$sum_diashab;
        $sum["prom_diashab"]["no_diashab"]=$no_diashab;
                
        $sum["prom_diaseta"]["total"]=$prom_diaseta;
        $sum["prom_diaseta"]["sum_diaseta"]=$sum_diaseta;
        $sum["prom_diaseta"]["no_diaseta"]=$no_diaseta;
        
        $documentos[]=array("indicador"=>"CARPETAS CON DEMORA","total"=>$indicador["documentos"]["nocumple"]);
        $documentos[]=array("indicador"=>"CARPETAS CONFORME","total"=> ($indicador["total"]-$indicador["documentos"]["nocumple"]));
        
        foreach($indicador["documentos"]["muelle"] as $key =>$d)
        {
            $encabezados["carpetas"]+=$d["total"];
            $documentosgrid[]=array("terminal"=>$key,"total_carpeta"=>$d["total"],"total_demora"=>  (is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ),"tipo"=>"documentos");
        }

        $descripciones[]=array("indicador"=>"MERCANCIA CON DEMORA","total"=>$indicador["descripciones"]["nocumple"]);
        $descripciones[]=array("indicador"=>"MERCANCIA CONFORME","total"=> ($indicador["total"]-$indicador["descripciones"]["nocumple"]));
        
        
        /*foreach($indicador["descripciones"]["muelle"] as $k =>$d)
        {
            $descripcionesgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>$d["nocumple"],"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }*/
        foreach($indicador["descripciones"]["linea"] as $k =>$d)
        {
            $descripcionesgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>(is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }
        
        /*$nacionalizacion[]=array("indicador"=>"CONS CON DEMORA","total"=>count($indicador["nacionalizacion"]["nocumple"]));
        $nacionalizacion[]=array("indicador"=>"CONS CONFORME","total"=> count($indicador["nacionalizacion"]["cumple"]));*/
        $nacionalizacion[]=array("indicador"=>"CONS CON DEMORA","total"=>$cumplimiento["nocumple"]);
        $nacionalizacion[]=array("indicador"=>"CONS CONFORME","total"=> $cumplimiento["cumple"]);
        $nal_puertos=array();
        foreach($indicador["nacionalizacion"] as $k =>$cons)
        {
            foreach($cons as $c)
            {
                foreach($c as $p=>$d)
                {
                    if($p=="valor")
                        continue;
                    $nal_puertos[$p][$k]++;
                }
            }
        }

        foreach($nal_puertos as $k =>$d)
        {
            $nacionalizaciongrid[]=array("terminal"=>$k,"total_carpeta"=>($count_values[$k]["cumple"]+$count_values[$k]["nocumple"]),"total_demora"=>(is_null($count_values[$k]["nocumple"])?"0":$count_values[$k]["nocumple"]),"por_demora"=>round( ($count_values[$k]["nocumple"]*100)/($count_values[$k]["cumple"]+$count_values[$k]["nocumple"]),2 ));
        }        
            
        $contenedores=array();
        
        foreach($transp as $k=>$t)
        {
            $totalContenedores+=count($t);
        }
        foreach($transp as $k=>$t)
        {
            $transporte[]=array("indicador"=>$k,"total"=>count($t));
            $transportegrid[]=array("transportador"=>$k,"no_contprov"=>count($t),"por_contprov"=>round( ( (count($t)/$totalContenedores)*100),1));
        }
        
        $totaldeclaraciones=$declara["fisico"]+$declara["automatico"];
        foreach($declara as $k=>$t)
        {
            $declaraciones[]=array("indicador"=>$k,"total"=>$t);
            $declaracionesgrid[]=array("tipo"=>$k,"no_contdecla"=>$t,"por_contdecla"=>round( ( ($t/$totaldeclaraciones)*100),1));
        }
        
        foreach($indicador["tipocontenedor"] as $puert=>$conte)
        {
            $contenedoresA[$puert]=count($indicador["contenedor"][$puert]);
            $teusA[$puert]=count($indicador["tipocontenedor"][$puert]);
        }
        
        //print_r(array_merge(array("tipo"=>"Contenedores"),$contenedoresA));
        //exit;
        $contenedores[]= array_merge(array("tipo"=>"Contenedores"),$contenedoresA);
        $contenedores[]= array_merge(array("tipo"=>"Teus"),$teusA);
        /*$contenedores[]=array("tipo"=>"Contenedores","SPRBUN"=>count($indicador["contenedor"]["SPRBUN"]),"TCBUEN"=>count($indicador["contenedor"]["TCBUEN"]));
        $contenedores[]=array("tipo"=>"Teus","SPRBUN"=>
                (count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2)),
                "TCBUEN"=>(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2)));
        */
        
        foreach($indicador["tipocontenedor"] as $puert=>$conte)
        {
            $totalteus+=( count($conte["20"]) +(count($conte["40"]) *2));
            $totalconte+=count($indicador["contenedor"][$puert]);
        }
        
        
        foreach($indicador["tipocontenedor"] as $puert=>$conte)
        {
            $contenedoresgrid[]=array(
            "terminal"=>$puert,
            "contenedor"=>count($indicador["contenedor"][$puert]),
            "por_contenedor"=>round((count($indicador["contenedor"][$puert])*100)/$totalconte),
            "teus"=>(count($conte["20"])+(count($conte["40"])*2)),
            "por_teus"=>round((( count($conte["20"]) +( count($conte["40"])*2))*100)/$totalteus)
            );
            
        }
        /*$contenedoresgrid[]=array(
                "terminal"=>'SPRBUN',
                "contenedor"=>count($indicador["contenedor"]["SPRBUN"]),
                "por_contenedor"=>round((count($indicador["contenedor"]["SPRBUN"])*100)/(count($indicador["contenedor"]["SPRBUN"])+count($indicador["contenedor"]["TCBUEN"]))),
                "teus"=>$totalteus,
                "por_teus"=>round(((count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2))*100)/((count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))+(count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2))))
            );
        $contenedoresgrid[]=array(
            "terminal"=>'TCBUEN',
            "contenedor"=>count($indicador["contenedor"]["TCBUEN"]),
            "por_contenedor"=>round((count($indicador["contenedor"]["TCBUEN"])*100)/(count($indicador["contenedor"]["SPRBUN"])+count($indicador["contenedor"]["TCBUEN"]))),
            "teus"=>(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2)),
            "por_teus"=>round((( count($indicador["tipocontenedor"]["TCBUEN"]["20"]) +( count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))*100)/$totalteus)
            );
        */
        //print_r($demorasDocNew);
        foreach($demorasDocNew["tipo"] as $k=>$dd)
        {
            if($k=="OK")
                continue;
            $demoras[] = array("tipo" => $k, "demora" => $dd);
            
            $demorasgrid[] = array(
            "demora" => $k,
            "cantidad" => $dd,
            "por_contenedor" => round(($dd/$demorasDocNew["total"])*100,1)
            );
        }
        
        
        foreach($indicador["descripciones"]["linea"] as $k =>$d)
        {
            $demoraslinea[] = array("tipo" => $k, "linea" => $d["nocumple"]);
            //$descripcionesgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>(is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }
       
        foreach($diasetax["muelle"] as $k =>$d)
        {
            
            //$diasetax["muelle"][$datosJson["linea"]]["suma"]+=$datos[$k]["diasnaleta"];
            $etalevante[] = array("tipo" => $k, "terminal" => is_null($d["suma"]/$d["total"])?"0":round($d["suma"]/$d["total"],2));
            $etalevantegrid[]=array("terminal"=>$k,"dias"=>(is_null($d["suma"]/$d["total"])?"0":round($d["suma"]/$d["total"],2)));
        }
         
        foreach($diasetax["linea"] as $k =>$d)
        {
            $etalevantelinea[] = array("tipo" => $k, "linea" => (is_null($d["suma"]/$d["total"])?"0": round($d["suma"]/$d["total"],2) ));
            $etalevantelineagrid[]=array("linea"=>$k,"dias"=>(is_null($d["suma"]/$d["total"])? "0" : round($d["suma"]/$d["total"],2) ));
            //$descripcionesgrid[]=array("terminal"=>$k,"total_carpeta"=>$d["total"],"total_demora"=>(is_null($d["nocumple"])?"0":$d["nocumple"]),"por_demora"=>round( ($d["nocumple"]*100)/$d["total"],2 ));
        }
        //print_r($diasetax["provetiqueta"]);
        
        foreach($diasetax["provetiqueta"] as $k =>$d)
        {
            $etiquetaProv[] = array("tipo" => $k, "proveedor" => (is_null($d["suma"]/$d["total"])?"0": round($d["suma"]/$d["total"],2) ));
        }
        
        
        /*foreach($diasetax["provetiqueta"] as $k =>$d)
        {
            $etiquetaProv[] = array("tipo" => $k, "proveedor" => (is_null($d["suma"]/$d["total"])?"0": round($d["suma"]/$d["total"],2) ));
        }*/
        
        
        foreach($diasetax["promfact"] as $k =>$d)
        {
            $suma += $d["suma"];
        }
        $encabezados["diaspromfact"]=round($suma/count($diasetax["promfact"]),2) ;
        
        //print_r($problemabl);
        //exit;
        foreach($problemabl as $k =>$d)
        {
            $problemasbl[] = array("tipo" => $k, "problema" => $d );
            $problemasblgrid[]=array("problema"=>$k,"cantidad"=>$d,"por"=>round( ($d/$encabezados["carpetas"])*100,2 ));            
        }
        
        foreach($problemafactura as $k =>$d)
        {
            $problemasfactura[] = array("tipo" => $k, "problema" => $d);
            $problemasfacturagrid[]=array("problema"=>$k,"cantidad"=>$d,"por"=>round( ($d/$encabezados["carpetas"])*100,2 ));
        }

        $totalbl=0;
        $totaldemorabl=0;
        foreach($indicador["demorabl2"] as $k =>$d)
        {
            $totalbl+=count($d["total"]);
            $totaldemorabl+=count($d["nocumple"]);
            $blsgrid[]=array("terminal"=>$k,"total_carpeta"=>count($d["total"]),"total_demora"=>(is_null(count($d["nocumple"]))?"0":count($d["nocumple"])),"por_demora"=>round( (count($d["nocumple"])*100)/(count($d["cumple"])+count($d["nocumple"])),2 ));
        }
        
        $bls[]=array("indicador"=>"BL CON INSPECCION","total"=>$totaldemorabl);
        $bls[]=array("indicador"=>"BL AUTOMATICA","total"=> $totalbl);
        
        
        $encabezados["bls"]=$totalbl;
        //$encabezados["carpetas"]=0;
        $encabezados["contenedores"]=count($indicador["contenedor"]["SPRBUN"])+count($indicador["contenedor"]["TCBUEN"]);
        
        $encabezados["teus"]=(count($indicador["tipocontenedor"]["TCBUEN"]["20"])+(count($indicador["tipocontenedor"]["TCBUEN"]["40"])*2))+(count($indicador["tipocontenedor"]["SPRBUN"]["20"])+(count($indicador["tipocontenedor"]["SPRBUN"]["40"])*2));
        
        $htmlencabezado='<table align="center">'
                . '<tr >'
                . '     <td class="x-column-header x-column-header-inner">1. Total Contenedores manejados</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["contenedores"].'</td>'
                . '</tr>'
                . '<tr >'
                . '     <td class="x-column-header x-column-header-inner">2. Total Contenedores con inspecci&oacute;n previa.</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.count($indicador["contenedor"]["Si"]).'</td>'
                . '</tr>'
                . '<tr >'
                . '     <td class="x-column-header x-column-header-inner">3. Total de Teus</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$totalteus.'</td>'
                . '</tr>'
                
                . '<tr >'
                . '     <td class="x-column-header x-column-header-inner">4. Total Bls</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["bls"].'</td>'
                . '</tr>'
                
                . '<tr >'
                . '     <td class="x-column-header x-column-header-inner">5. Total Bls Aforo DIAN</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner"><a href="javascript:datosBl()">'.( (count($indicador["bls"])>0)? count($indicador["bls"]):"0").'</a></td>'
                . '</tr>'
                . '<tr>'                
                . '     <td class="x-column-header x-column-header-inner">6. Total Carpetas</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["carpetas"].'</td>'                
                . '</tr>'
                . '<tr>'                
                . '     <td class="x-column-header x-column-header-inner">7. Promedio ETA-LEVANTE</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_diaseta"]["total"],2).'</td>'
                . '</tr>'
                . '<tr>'                
                . '     <td class="x-column-header x-column-header-inner">8. Promedio dias de Facturacion</td>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["diaspromfact"].'</td>'                
                . '</tr>'
                . '</table>';
                
                /*. '     <th class="x-column-header x-column-header-inner">Contenedores Recono.</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.count($indicador["contenedor"]["Si"]).'</td>'
                . '     <th class="x-column-header x-column-header-inner">Cantidad BL</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["bls"].'</td>'
                . '</tr>'
                . '<tr>'
                . '     <th class="x-column-header x-column-header-inner">Total Teus</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$totalteus.'</td>'
                . '     <th class="x-column-header x-column-header-inner">Bl`s manejados</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$totalbl.'</td>'
                . '     <th class="x-column-header x-column-header-inner">Bl`s  inspeccionados</th>'
                
                . '     <td class="x-grid-cell x-grid-cell-inner"><a href="javascript:datosBl()">'.(isset($indicador["bls"]["Si"])?$indicador["bls"]["Si"]:"0").'</a></td>'
                . '</tr>'
                . '<tr>'
                . '     <th class="x-column-header x-column-header-inner">Total Teus</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$totalteus.'</td>'
                . '     <th class="x-column-header x-column-header-inner">Total Carpetas</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["carpetas"].'</td>'
                . '     <th class="x-column-header x-column-header-inner">Cantidad Teus</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.$encabezados["teus"].'</td>'
                . '</tr>'
                . '<tr>'
                . '     <th class="x-column-header x-column-header-inner">Promedio Dias Habiles</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_diashab"]["total"],2).'</td>'
                . '     <th class="x-column-header x-column-header-inner">Promedio Dias Eta</th>'
                . '     <td class="x-grid-cell x-grid-cell-inner">'.round($sum["prom_diaseta"]["total"],2).'</td>'
                . '</tr>'
                . '</table>';*/
        }
        catch(Exception $e)
        {
            $errorInfo=$e->getMessage();
        }
        $this->responseArray = array("success" => true,"sum"=>$sum, "datos" => $datos,"encabezados"=>$htmlencabezado,"indicador"=>$indicador, 
            "consolidados"=>$consolidados,"documentos"=>$documentos,"documentosgrid"=>$documentosgrid , 
            "descripciones"=>$descripciones,"descripcionesgrid"=>$descripcionesgrid,"nacionalizacion"=>$nacionalizacion,"nacionalizaciongrid"=>$nacionalizaciongrid,
            "contenedores"=>$contenedores,"contenedoresgrid"=>$contenedoresgrid,
            "demoras" => $demoras, "demorasgrid" => $demorasgrid, "demoraslinea" => $demoraslinea,
            "etalevante"=>$etalevante,"etalevantegrid"=>$etalevantegrid,
            "etalevantelinea"=>$etalevantelinea,"etalevantelineagrid"=>$etalevantelineagrid,
            "problemasbl"=>$problemasbl,"problemasblgrid"=>$problemasblgrid,
            "problemasfactura"=>$problemasfactura,"problemasfacturagrid"=>$problemasfacturagrid,
            "etiquetaProv"=>$etiquetaProv,            
            "transporte" => $transporte, "transportegrid" => $transportegrid,
            "declaraciones" => $declaraciones, "declaracionesgrid" => $declaracionesgrid,
        
        "bls"=>$bls,"blsgrid"=>$blsgrid, "total" => count($datos),"prom_diashab"=>$prom_diashab,"prom_diaseta"=>$prom_diaseta,"debug"=>$debug,"error"=>$errorInfo);
        //$this->responseArray = array("success" => true, "indicador"=>$indicador, "muelles"=>$count_values, "consolidados"=>$consolidados,"containers"=>$containers,"nacionalizaciongrid"=>$nacionalizaciongrid);
        /*echo "<pre>";
        print_r($this->responseArray);
        echo "</pre>";*/
        $this->setTemplate("responseTemplate");
    }
    
    public function executeImportarSNE(sfWebRequest $request) {
        $usuarios = Doctrine::getTable("Usuario")
            ->createQuery("u")
            ->innerJoin("u.Sucursal s ")
            ->addWhere("u.ca_activo=true")
            ->addOrderBy("u.ca_login")
            //limit->limit(1)
            ->execute();
        
        echo count($usuarios);
        foreach($usuarios as $u)
        {
            if($u->getCargo()->getCaVentas()===true || $u->getCaDepartamento()=="Comercial")
            {
                echo $u->getCaNombre()."<br>";
                $trans= new IntTransaccionesOut();
                $trans->setCaIdtipo(5);
                $trans->setCaIndice1($u->getCaLogin());
                $trans->setCaIndice2(4);
                $trans->setCaEstado("A");
                $trans->save();
            }
        }
        exit;
        
    }
    
    
    
    public function executeImportarSN(sfWebRequest $request) {

        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';


        $params = array();
        //$params[]=array("tipo"=>"P","file"=>"/srv/www/proveedores.xls","idempresa"=>"4","idtipo"=>3);
        $params[]=array("tipo"=>"C","file"=>"/srv/www/clientes.xls","idempresa"=>"4","idtipo"=>2);

        foreach ($params as $param) {
            echo "<div>$param</div>";
            //echo PHPEXCEL_ROOT;
            $objPHPExcel = PHPExcel_IOFactory::load($param["file"]);
            //exit;
            $hojas = array();
            foreach ($objPHPExcel->getSheetNames() as $s) {
                $hojas[] = array("name" => $s);
            }

            //        print_r($hojas);
            $ws = $objPHPExcel->getSheetByName("SOCIOS DE NEGOCIOS");

            $posicion = array();
            $posicion['nit'] = 0;

            $array = $ws->toArray();
            //echo "<pre>";print_r($array);echo "</pre>";
            //exit;
            //foreach( $array as $pos=>$row ){
            /* count($array) */
            $begin = 0;
            $end = count($array) - 1;
            echo "cantidad:" . $end . "<br>";
            $noencontrados = $encontrados = 0;
            for ($pos = $begin; $pos < $end; $pos++) {

                $row = $array[$pos];
                //print_r($row);

                if ($pos < 2 /* || ($row[$posicion['tipo']]!="1" */) {
                    continue;
                }
                $nit = trim($row[0]);
                $ids = Doctrine::getTable("Ids")->findOneBy('ca_idalterno' ,array($nit));
            
                if(!$ids)
                {
                    echo "Tipo {$param['tipo']} No encontrado: ".$nit."<br>";
                    continue;
                }
                $idsEstado = Doctrine::getTable("IdsEstadoSap")->find(array($nit,$param["tipo"],"4"));
            
                if (!$idsEstado){
                    $idsEstado= new IdsEstadoSap();
                    $idsEstado->setCaId($nit);
                    $idsEstado->setCaTipo($param["tipo"]);
                    $idsEstado->setCaIdempresa($param["idempresa"]);                
                    $idsEstado->setCaUsucreado("Administrador");
                    $idsEstado->setCaFchcreado(date("Y-m-d H:i:s"));
                }

                $idsEstado->setCaActivo(true);
                $idsEstado->setCaFchsap(date("Y-m-d"));
                $idsEstado->setCaUsusap("Administrador");
                $idsEstado->stopBlaming();
                $idsEstado->save();
                
                $trans= new IntTransaccionesOut();
                $trans->setCaIdtipo($param["idtipo"]);
                $trans->setCaIndice1($nit);
                $trans->setCaIndice2(4);
                $trans->setCaEstado("A");
                $trans->save();
                //echo "aaa";

                $mensaje = 'El SN se activo correctamente!';
                $estado = 1;
                $success = true;
            
            }
            echo "--------------------------------------------------------<br><br>";
            echo "NO ENCONTRADOS:" . $noencontrados . "<br>";
            echo "ENCONTRADOS:" . $encontrados . "<br>";
            echo "--------------------------------------------------------<br><br>";
        }

        //$array = $ws->toArray();
        exit;
    }
    
    
    public function executeImportarSNList(sfWebRequest $request) {

        

        $proveedores= array(
            '901016877',
            '900841486',
            '860079024',
            '835000149',
            '800249687',
            '800215775',
            '800199898',
            '800186891',
            '800172330',
            '800084048',
            '800024075',
            '860502609',
            '900451936',
            '830077546'
        );
        
        $clientes= array(
            '900622755',
            '900482687',
            '900204182',
            '900129117',
            '900017447',
            '891401711',
            '860514346',
            '860508470',
            '860049210',
            '860006965',
            '830080641',
            '800026212',
            '811031676',
            '830036539',
            '900469065',
            '901332041',
            '901336857',
            '860007759',
            '805029605'
        );

        $params = array();
        $params[]=array("tipo"=>"P","list"=>$proveedores,"idempresasap"=>"4" ,"tipotr"=>"3");
        $params[]=array("tipo"=>"C","list"=>$clientes,"idempresasap"=>"4","tipotr"=>"2" );

        foreach ($params as $param) {
        
            foreach ($param["list"] as $k=>$a) {
                
                $nit = $a;
                //echo $nit."<br>";
                
                $ids = Doctrine::getTable("Ids")->findOneBy("ca_idalterno",$nit );
                    if($ids)
                    {
                        echo $k ."->".$ids->getCaId()."-------<br>";
                    }
                
                
                
                //echo $e->getCaId()." : ".$e->getCaTipo()." : ".$e->getEmpresa()->getCaIdsap()."<br>";
                $trans= new IntTransaccionesOut();
                $trans->setCaIdtipo($param["tipotr"]);
                $trans->setCaIndice1($ids->getCaId());
                $trans->setCaIndice2($param["idempresasap"]);
                $trans->setCaEstado("A");
                $trans->save();
                
                
                //$idsEstado->save(); 
                echo "aaa";

                $mensaje = 'El cliente se activo correctamente!';
                $estado = 1;
                $success = true;
            
            }
            /*echo "--------------------------------------------------------<br><br>";
            echo "NO ENCONTRADOS:" . $noencontrados . "<br>";
            echo "ENCONTRADOS:" . $encontrados . "<br>";
            echo "--------------------------------------------------------<br><br>";*/
        }

        //$array = $ws->toArray();
        exit;
    }
    
    public function executePruebaMsgAnulado(sfWebRequest $request) {
        
        $msg="sdkfjdslkfjds ï¿½lf";
        $mensaje_cancelado = strpos(trim($msg),"Document is already cancelled - Object reference not set to an instance of an object");                            
        if($mensaje_cancelado===false)
            echo "1";
        else
            echo "2";
        echo $mensaje_cancelado;
        exit;
    }
    
    
    
    public function executeFixFacturas(sfWebRequest $request) {
  
        $con = Doctrine_Manager::getInstance()->getConnection('master');

        $sql="Select m.ca_referencia,m.ca_fchliquidado,m.ca_fchcerrado,c.ca_consecutivo,c.ca_idmoneda,mc.ca_concepto_esp,c.ca_fchcomprobante,c.ca_tcambio,
            c.ca_usugenero,t.ca_tipo,d.* 
                from ino.tb_comprobantes c
                inner join ino.tb_detalles d ON c.ca_idcomprobante=d.ca_idcomprobante
                inner join ino.tb_master m on m.ca_idmaster = d.ca_idmaster
                inner join ino.tb_maestra_conceptos mc ON d.ca_idconcepto=mc.ca_idconcepto
                inner join ino.tb_tipos_comprobante t ON c.ca_idtipo=t.ca_idtipo AND t.ca_tipo in ('P','D') AND t.ca_aplicacion=1
                where c.ca_estado=5 and c.ca_docentry is not null
                ";
        

        $st = $con->execute($sql);
        $datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        $this->estadisticas= array();
        $this->noexiste=$nocoincide=  array();
        $this->estadisticas[count($datos)];
        $this->estadisticas["cerradas"]=0;
        foreach($datos as $d)
        {
            $sql="Select *
                from ino.tb_costos c                
                where c.ca_idmaster='{$d["ca_idmaster"]}' and c.ca_idcosto='{$d["ca_idconcepto"]}' and c.ca_factura='{$d["ca_consecutivo"]}' ";
        

                $st = $con->execute($sql);
                $dattmp = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                $valor=($d["ca_cr"]-$d["ca_db"]);
                $nreg=count($dattmp);
                if($nreg>0)
                {
                    
                    if($valor!=$dattmp[0]["ca_neto"])
                    {
                        $estadisticas["valordiferente"]++;
                        $nocoincide[]=array(
                            "ca_idmaster"=>$d["ca_idmaster"],
                            "ca_referencia"=>$d["v"],
                            "ca_consecutivo"=>$d["ca_consecutivo"],
                            "ca_idconcepto"=>$d["ca_idconcepto"],
                            "valor"=>$valor,                            
                            "ca_fchanulado"=>$d["ca_fchanulado"],
                            "ca_fchcerrado"=>$d["ca_fchcerrado"]
                        );
                        //echo "<br>No COINCIDE {$d["ca_idmaster"]} {$d["ca_referencia"]}- No Comp:{$d["ca_consecutivo"]}  Concepto:{$d["ca_idconcepto"]} {$d["ca_cr"]}!={$dattmp[0]["ca_neto"]}  Anulado:{$dattmp[0]["ca_fchanulado"]} " ;
                        //echo " resul:".$d["ca_cr"]-$d["ca_db"]."<br>";
                        /*echo "<pre>";
                        print_r($d);
                        print_r($dattmp[0]);
                        echo "</pre>";*/
                    }
                }
                else
                {
                    /*if($d["ca_fchcerrado"]!="")
                    {
                        $estadisticas["cerrado"]++;
                        echo "<span style='background:red'>";
                    }*/
                    $this->estadisticas["referencias"][$d["ca_referencia"]]="1";
                    if($d["ca_fchcerrado"]!="")
                        $this->estadisticas["cerradas"]++;
                    $this->noexiste[]= array(
                        "ca_idmaster"=>$d["ca_idmaster"],
                        "ca_referencia"=>$d["ca_referencia"],
                        "ca_consecutivo"=>$d["ca_consecutivo"],
                        "ca_idconcepto"=>$d["ca_idconcepto"],
                        "valor"=>$valor." ".$d["ca_idmoneda"],
                        "ca_fchanulado"=>$d["ca_fchanulado"],
                        "ca_fchcerrado"=>$d["ca_fchcerrado"],
                        "ca_concepto_esp"=>$d["ca_concepto_esp"],
                        "ca_idmoneda"=>$d["ca_idmoneda"],
                    );

                    $idhouse = $d["ca_idhouse"]?$d["ca_idhouse"]:'null';
                    //Factura
                    $datos=Array();
                    $datos["fix"]=1;
                    $datos["fchfix"]=date("Y-m-d");
                    if($d["ca_tipo"]=="P")
                    {
                        $sql2="INSERT INTO ino.tb_costos "
                            . "(ca_idmaster, ca_idcosto, ca_factura, ca_fchfactura, ca_idproveedor, ca_idmoneda, ca_tcambio, ca_tcambio_usd, "
                                . "ca_neto, ca_venta, ca_idcomprobante, ca_idhouse, ca_fchcreado, ca_usucreado,ca_datos) "
                            . "VALUES (".$d["ca_idmaster"].",".$d["ca_idconcepto"].",'".$d["ca_consecutivo"]."',"
                            . "'".$d["ca_fchcomprobante"]."',".$d["ca_id"].",'".$d["ca_idmoneda"]."',".$d["ca_tcambio"].",1,".$d["ca_cr"].","
                            . "".round($d["ca_cr"]*$d["ca_tcambio"], 2, PHP_ROUND_HALF_UP).",".$d["ca_idcomprobante"].",".$idhouse.","
                            . "'".date("Y-m-d H:i:s")."','".$d["ca_usucreado"]."','". json_encode($datos)."')";
                    }
                    else if($d["ca_tipo"]=="D")
                    {
                    //NC
                        $neto = $d["ca_db"]*-1;
                        $venta = round($d["ca_db"]*$d["ca_tcambio"]*-1, 2, PHP_ROUND_HALF_UP);
                        
                        $sql2="INSERT INTO ino.tb_costos "
                                . "(ca_idmaster, ca_idcosto, ca_factura, ca_fchfactura, ca_idproveedor, ca_idmoneda, ca_tcambio, ca_tcambio_usd, "
                                . "ca_neto, ca_venta, ca_idcomprobante, ca_idhouse, ca_fchcreado, ca_usucreado,ca_datos) "
                                . "VALUES (".$d["ca_idmaster"].",".$d["ca_idconcepto"].",'".$d["ca_consecutivo"]."',"
                                . "'".$d["ca_fchcomprobante"]."',".$d["ca_id"].",'".$d["ca_idmoneda"]."',"
                                . "".$d["ca_tcambio"].",1,".$neto.",".$venta.","
                                . "".$d["ca_idcomprobante"].",".$idhouse.",'".$d["ca_fchcreado"]."','".$d["ca_usucreado"]."','". json_encode($datos)."')";
                    }
                }
        }
    }
    
    public function executeFixFacturasEliminadas(sfWebRequest $request) {
  
        $con = Doctrine_Manager::getInstance()->getConnection('master');

        $sql="Select m.ca_referencia,m.ca_fchliquidado,m.ca_fchcerrado,c.ca_consecutivo,c.ca_idmoneda,mc.ca_concepto_esp,c.ca_fchcomprobante,c.ca_tcambio,
            c.ca_idcomprobante,c.ca_fchanulado,
            c.ca_usugenero,t.ca_tipo,d.* 
                from ino.tb_comprobantes c
                inner join ino.tb_detalles d ON c.ca_idcomprobante=d.ca_idcomprobante
                inner join ino.tb_master m on m.ca_idmaster = d.ca_idmaster
                inner join ino.tb_maestra_conceptos mc ON d.ca_idconcepto=mc.ca_idconcepto
                inner join ino.tb_tipos_comprobante t ON c.ca_idtipo=t.ca_idtipo AND t.ca_tipo in ('P','D') AND t.ca_aplicacion=1
                where c.ca_estado=8 and c.ca_docentry is not null
                ";
        

        $st = $con->execute($sql);
        $datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        $this->estadisticas= array();
        $this->existe=$this->noexiste=$nocoincide=  array();
        $this->estadisticas[count($datos)];
        $this->estadisticas["cerradas"]=0;
        foreach($datos as $d)
        {
            $sql="Select *
                from ino.tb_costos c                
                where c.ca_idmaster='{$d["ca_idmaster"]}' and c.ca_idcosto='{$d["ca_idconcepto"]}' and c.ca_factura='{$d["ca_consecutivo"]}' ";
        

                $st = $con->execute($sql);
                $dattmp = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                $valor=($d["ca_cr"]-$d["ca_db"]);
                $nreg=count($dattmp);
                if($nreg>0)
                {
                    
                    if($dattmp[0]["ca_fchanulado"]=="")
                    {
                        $this->existe[]= array(
                            "ca_idcomprobante"=>$d["ca_idcomprobante"],
                            "ca_idmaster"=>$d["ca_idmaster"],
                            "ca_referencia"=>$d["ca_referencia"],
                            "ca_consecutivo"=>$d["ca_consecutivo"],
                            "ca_idconcepto"=>$d["ca_idconcepto"],
                            "valor"=>$valor." ".$d["ca_idmoneda"],
                            "ca_fchanulado"=>$d["ca_fchanulado"],
                            "ca_fchcerrado"=>$d["ca_fchcerrado"],
                            "ca_concepto_esp"=>$d["ca_concepto_esp"],
                            "ca_idmoneda"=>$d["ca_idmoneda"]
                        );
                    }
                }
                else
                {
                    /*if($d["ca_fchcerrado"]!="")
                    {
                        $estadisticas["cerrado"]++;
                        echo "<span style='background:red'>";
                    }*/
                    $this->estadisticas["referencias"][$d["ca_referencia"]]="1";
                    if($d["ca_fchcerrado"]!="")
                        $this->estadisticas["cerradas"]++;
                    $this->noexiste[]= array(
                        "ca_idmaster"=>$d["ca_idmaster"],
                        "ca_referencia"=>$d["ca_referencia"],
                        "ca_consecutivo"=>$d["ca_consecutivo"],
                        "ca_idconcepto"=>$d["ca_idconcepto"],
                        "valor"=>$valor." ".$d["ca_idmoneda"],
                        "ca_fchanulado"=>$d["ca_fchanulado"],
                        "ca_fchcerrado"=>$d["ca_fchcerrado"],
                        "ca_concepto_esp"=>$d["ca_concepto_esp"],
                        "ca_idmoneda"=>$d["ca_idmoneda"],
                    );
                    
                    
                    
                    $idhouse = $d["ca_idhouse"]?$d["ca_idhouse"]:'null';
                    //Factura
                    $datos=Array();
                    $datos["fix"]=1;
                    $datos["fchfix"]=date("Y-m-d");
                    /*if($d["ca_tipo"]=="P")
                    {
                    
                        $sql2="INSERT INTO ino.tb_costos "
                            . "(ca_idmaster, ca_idcosto, ca_factura, ca_fchfactura, ca_idproveedor, ca_idmoneda, ca_tcambio, ca_tcambio_usd, "
                                . "ca_neto, ca_venta, ca_idcomprobante, ca_idhouse, ca_fchcreado, ca_usucreado,ca_datos) "
                            . "VALUES (".$d["ca_idmaster"].",".$d["ca_idconcepto"].",'".$d["ca_consecutivo"]."',"
                            . "'".$d["ca_fchcomprobante"]."',".$d["ca_id"].",'".$d["ca_idmoneda"]."',".$d["ca_tcambio"].",1,".$d["ca_cr"].","
                            . "".round($d["ca_cr"]*$d["ca_tcambio"], 2, PHP_ROUND_HALF_UP).",".$d["ca_idcomprobante"].",".$idhouse.","
                            . "'".date("Y-m-d H:i:s")."','".$d["ca_usucreado"]."','". json_encode($datos)."')";
                        //$sql2="FACTURA :".$sql2;
                    }
                    else if($d["ca_tipo"]=="D")
                    {
                    //NC
                        $neto = $d["ca_db"]*-1;
                        $venta = round($d["ca_db"]*$d["ca_tcambio"]*-1, 2, PHP_ROUND_HALF_UP);
                        
                        $sql2="INSERT INTO ino.tb_costos "
                                . "(ca_idmaster, ca_idcosto, ca_factura, ca_fchfactura, ca_idproveedor, ca_idmoneda, ca_tcambio, ca_tcambio_usd, "
                                . "ca_neto, ca_venta, ca_idcomprobante, ca_idhouse, ca_fchcreado, ca_usucreado,ca_datos) "
                                . "VALUES (".$d["ca_idmaster"].",".$d["ca_idconcepto"].",'".$d["ca_consecutivo"]."',"
                                . "'".$d["ca_fchcomprobante"]."',".$d["ca_id"].",'".$d["ca_idmoneda"]."',"
                                . "".$d["ca_tcambio"].",1,".$neto.",".$venta.","
                                . "".$d["ca_idcomprobante"].",".$idhouse.",'".$d["ca_fchcreado"]."','".$d["ca_usucreado"]."','". json_encode($datos)."')";
                        //$sql2="NOTA CREDITO:".$sql2;
                        
                    }*/
                    //echo $sql2."<br>";
                    //$st = $con->execute($sql2);
                    
                    
                    /*echo "<pre>";
                        print_r($d);                        
                    echo "</pre>";*/
                    //print_r($d);
                    
                    //if($d["ca_usugenero"])
                    //$usucreado
                    //exit;
                    //$st = $con->execute($sql2);
                    
                    //echo "<br> No existe {$d["ca_idmaster"]} {$d["ca_referencia"]}- No Comp:{$d["ca_consecutivo"]}  Concepto:{$d["ca_idconcepto"]} <br>" ;
                    
                    /*if($d["ca_fchcerrado"]!="")
                    {
                        echo "</span>";
                    }*/
                }
        }
        
        echo "<pre>";
        print_r($this->existe);
        echo "</pre>";
        exit;               
        
        //$this->setTemplate("");
    }
    
  public function executeFixComprobanteComisiones(sfWebRequest $request) {
      
    /*echo "opcion deshabilitada";
    exit;*/
    echo "<pre>";

      $con = Doctrine_Manager::getInstance()->getConnection('master');

        /*$sql="select m.ca_idmaster,m.ca_referencia,h.ca_idhouse,h.ca_idcliente,h.ca_idcliente,
                array_to_string(ARRAY( SELECT ca_consecutivo FROM ino.vi_comprobantes WHERE ca_usuanulado is null and ca_idmaster=m.ca_idmaster AND ca_idhouse=h.ca_idhouse AND ca_idtipo IN(12)),',' ) as rccaja,
                array_to_string(ARRAY( (SELECT (com.ca_consecutivo||'|'||det.ca_cr||'|'||com.ca_idcomprobante) FROM ino.tb_comprobantes com,ino.tb_detalles det WHERE com.ca_usuanulado is null and com.ca_idcomprobante=det.ca_idcomprobante and det.ca_idmaster=m.ca_idmaster AND det.ca_idhouse=h.ca_idhouse AND com.ca_idtipo IN(11) and det.ca_cr !=0 )),',' ) comision 
            from ino.tb_master m            
            inner join ino.tb_house h on m.ca_idmaster=h.ca_idmaster
            where ca_impoexpo='INTERNO' and m.ca_fchreferencia>'2018-01-01'            
        ";
        

        $st = $con->execute($sql);
        $datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        echo "<pre>";
        foreach($datos as $d)
        {
            $c=explode(",",$d["comision"]);
            foreach($c as $g)
            {
                $j=explode("|",$g);
                if($j[0]==1532)
                {
                    print_r($d);
                 //   echo $j[0]."<br>";
                }
            }
            
            //print_r(j);
        }
        echo "<pre>";*/
      
      
   
      $sql="select * 
	FROM ino.tb_comprobantes c	
	--left join ino.tb_detalles d ON c.ca_idcomprobante=d.ca_idcomprobante
	where c.ca_usucreado='Administrador' and c.ca_idtipo=12  	";

        $st = $con->execute($sql);
        $rec = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

        foreach($rec as $r)
        {
            $sql="select c.* 
            FROM ino.tb_comprobantes c
            inner join ino.tb_tipos_comprobante t On t.ca_idtipo=c.ca_idtipo
            where c.ca_idhouse=".$r["ca_idhouse"]." and t.ca_tipo='F' and ca_idcomprobante_cruce is null and ca_estado=5";
            $st = $con->execute($sql);
            $fact = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

            foreach($fact as $f)
            {
                $sql="update ino.tb_comprobantes set ca_idcomprobante_cruce=".$r["ca_idcomprobante"]." 
                where ca_idcomprobante=".$f["ca_idcomprobante"]." ";
                $st1 = $con->execute($sql);
                echo "<br>$sql";
            }
        }
echo "</pre>";

exit;

  /*    
      
      //////CREAR COMPROBANTES DE COMISION NUEVO MODULO
      $sql="select c.*,d.*,m.ca_fchcreado as m_ca_fchcreado,m.ca_usucreado as m_ca_usucreado
          from ino.tb_comprobantes c
          inner join ino.tb_detalles d ON c.ca_idcomprobante=d.ca_idcomprobante
          inner join ino.tb_house h ON d.ca_idhouse=h.ca_idhouse
          inner join ino.tb_master m ON h.ca_idmaster=m.ca_idmaster
          where
          c.ca_idtipo=11 and c.ca_fchcreado>='2018-01-01' and c.ca_consecutivo::integer > 1740
        ";

        $st = $con->execute($sql);
        $datos = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        
        $fchliq="";
        foreach($datos as $d)
        {
            //echo $d["ca_idhouse"]."-".$d["ca_valor2"]."-".$d["ca_cr"]."-".$d["ca_usucreado"]."-".$d["ca_fchcreado"];
            if($fchliq=="")
                $fchliq=$d["ca_fchcreado"];
            $comision = new InoComision();
            $comision->setCaIdhouse($d["ca_idhouse"]);
            $comision->setCaValor($d["ca_valor2"]);
            $comision->setCaComision($d["ca_cr"]);
            $comision->setCaVendedor($d["ca_usucreado"]);
            
            $comision->setCaUsucreado($d["m_ca_usucreado"]);
            $comision->setCaFchcreado($d["m_ca_fchcreado"]);
            $comision->setCaUsuliquidado($d["ca_usucreado"]);
            $comision->setCaFchliquidado($fchliq);
            $comision->setCaConsecutivo("-".$d["ca_consecutivo"]);
            $comision->stopBlaming();
            $comision->save();
            print_r($d);
            
        }
        echo "</pre>";
      exit;
   * 
   */
    }
    
    
    public function executeFixCompCollect(sfWebRequest $request) 
    {
        exit;
        $consecutivos = array('10013360-1');
        $q = Doctrine::getTable("InoComprobante")
                ->createQuery("comp")                
                ->select("*")
                ->innerJoin("comp.InoTipoComprobante tcomp")
                ->where("ca_consecutivo=? ",$consecutivos);
        $comps=$q->execute();
        
        foreach($comps as $c)
        {
            $comprobante=$c;
            $datosjson=json_decode(utf8_encode($comprobante->getCaDatos()));

            if($comprobante->getInoTipoComprobante()->getCaIdempresa()=="2" || $comprobante->getInoTipoComprobante()->getCaIdempresa()=="8" ){
                $con1 = Doctrine_Manager::getInstance()->getConnection('master');
                $sql1="SELECT d.ca_idmaster, d.ca_idconcepto, d.ca_cr,d.ca_db,d.ca_idhouse
                    FROM ino.tb_detalles d
                            INNER JOIN ino.tb_comprobantes c ON d.ca_idcomprobante = c.ca_idcomprobante
                    WHERE d.ca_idcomprobante =".$comprobante->getCaIdcomprobante();
                echo $sql1;
                $st = $con1->execute($sql1);
                $detalles = $st->fetchAll();

                $detalles= $comprobante->getInoDetalle();
                $data= array();
                foreach($detalles as $d){
                    $valor=($d["ca_cr"]>0)?$d["ca_cr"]:$d["ca_db"];
                    $data[$d["ca_idmaster"]]["valor"]+=$valor;
                    $data[$d["ca_idmaster"]]["concepto"]=$d["ca_idconcepto"];
                    $data[$d["ca_idmaster"]]["idhouse"]=$d["ca_idhouse"];
                }
                //print_r($data);
                //exit;
                foreach($data as $ref=>$d)
                {
                    $sql1="INSERT INTO ino.tb_comprobantes 
                            (
                                ca_idtipo, ca_consecutivo, ca_fchcomprobante, ca_id, 
                                ca_observaciones ,
                                ca_fchcreado, ca_usucreado, ca_tcambio, ca_estado,
                                ca_valor, ca_idmoneda, ca_valor2, ca_idsucursal,
                                ca_fchgenero, ca_usugenero, ca_idmaster,
                                ca_idhouse,
                                ca_idcomprobante_cruce
                            )
                            values(
                                '99','C-".$comprobante->getCaConsecutivo()."','".$comprobante->getCaFchcomprobante()."','".$comprobante->getCaId()."',
                                'Generado Automaticamente desde la NC ".$comprobante->getCaConsecutivo()."-".$comprobante->getCaIdmaster()." : ".$d["concepto"]."',
                                '".$comprobante->getCaFchcreado()."','".$comprobante->getCaUsucreado()."','".$comprobante->getCaTcambio()."','5',
                                '".$d["valor"]."', '".$comprobante->getCaIdmoneda()."', '".$d["valor"]."', '".$comprobante->getCaIdsucursal()."',
                                '".date("Y-m-d H:i:s")."', '".$comprobante->getCaUsugenero()."', '".$ref."',
                                '".$d["idhouse"]."', '".$comprobante->getCaIdcomprobante()."'
                            )";

                    $st = $con1->execute($sql1);
                }
                $comprobante->eliminarCostos("Administrador");
            }
        }
        exit;
    }
    
    
    
    public function executeFixConcliente(sfWebRequest $request) {
      
echo "Inicio::".date("H:i:s")."<br>";
    echo "<pre>";

      $con = Doctrine_Manager::getInstance()->getConnection('master');

echo "<br><br>RN<br><br>";
      
      //RN
   
      $sql="select r.ca_idreporte,r.ca_idconcliente,r.ca_datos,c.ca_idscontacto,r.ca_datos
	FROM tb_reportes r
        inner join tb_concliente c ON c.ca_idcontacto=r.ca_idconcliente	";
	//limit 10";

        $st = $con->execute($sql);
        $rec = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

        foreach($rec as $r)
        {
            $datos=json_decode(utf8_encode($r["ca_datos"]),true);
            
            $datos["ca_idconcliente"]=$r["ca_idconcliente"];
            //print_r($datos);
            $sql="update tb_reportes set ca_idconcliente=".$r["ca_idscontacto"]." and ca_datos='". json_encode($datos)."' where ca_idreporte=".$r["ca_idreporte"]." ";
                //$st1 = $con->execute($sql);
                echo "<br>$sql";
            
        }
        
        //Cotizaciones
   
        
        echo "<br><br>Cotizaciones<br><br>";
      $sql="select cot.ca_idcotizacion,cot.ca_idcontacto,cot.ca_datos,c.ca_idscontacto,cot.ca_datos
	FROM tb_cotizaciones cot
        inner join tb_concliente c ON c.ca_idcontacto=cot.ca_idcontacto	        	";
	//limit 10";

        $st = $con->execute($sql);
        $rec = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

        foreach($rec as $r)
        {
            $datos=json_decode(utf8_encode($r["ca_datos"]),true);
            
            $datos["ca_idcontacto"]=$r["ca_idcontacto"];
            //print_r($datos);
            $sql="update tb_cotizaciones set ca_idcontacto=".$r["ca_idscontacto"]." and ca_datos='". json_encode($datos)."' where ca_idcotizacion=".$r["ca_idcotizacion"]." ";
                //$st1 = $con->execute($sql);
            echo "<br>$sql";
        }
        
        
               //Encuesta Visita
   
        
        echo "<br><br>Encuesta Visita<br><br>";
        
      $sql="select e.ca_idencuesta,e.ca_idcontacto,e.ca_datos,c.ca_idscontacto
	FROM  encuestas.tb_encuesta_visita e
        inner join tb_concliente c ON c.ca_idcontacto=e.ca_idcontacto	        	";
	//limit 10";

        $st = $con->execute($sql);
        $rec = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

        foreach($rec as $r)
        {
            $datos= Array();
            //$datos=json_decode(utf8_encode($r["ca_datos"]),true);
            
            $datos["ca_idcontacto"]=$r["ca_idcontacto"];
            //print_r($datos);
            $sql="update encuestas.tb_encuesta_visita set ca_idcontacto=".$r["ca_idscontacto"]." and ca_datos='". json_encode($datos)."' where ca_idencuesta=".$r["ca_idencuesta"]." ";
                //$st1 = $con->execute($sql);
            echo "<br>$sql";
        }
        
        
                 //Trackin Usuarios
   
        
        echo "<br><br>Encuesta Visita<br><br>";
        
      $sql="select t.ca_id,t.ca_idcontacto,t.ca_datos,c.ca_idscontacto
	FROM  tb_tracking_users t
        inner join tb_concliente c ON c.ca_idcontacto=t.ca_idcontacto	        	";
	//limit 10";

        $st = $con->execute($sql);
        $rec = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);

        foreach($rec as $r)
        {
            $datos= Array();
            //$datos=json_decode(utf8_encode($r["ca_datos"]),true);
            
            $datos["ca_idcontacto"]=$r["ca_idcontacto"];
            //print_r($datos);
            $sql="update tb_tracking_users set ca_idcontacto=".$r["ca_idscontacto"]." and ca_datos='". json_encode($datos)."' where ca_id=".$r["ca_id"]." ";
                //$st1 = $con->execute($sql);
            echo "<br>$sql";
        }

        
        
        /*ALTER TABLE comunicaciones.tb_envios DROP CONSTRAINT fk_tb_envios_ca_idcontacto; */
echo "</pre>";


echo "Fin::".date("H:i:s")."<br>";
exit;
    }
    
    
    
    public function executeVerPermisos(sfWebRequest $request) 
    {
        
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        
        $perfiles = Doctrine::getTable("Perfil")
            ->createQuery("p")
            ->addWhere("p.ca_aplicacion = ?  AND UPPER(p.ca_departamento) = ?", array($app,"ADUANAS") )
            ->addOrderBy("p.ca_departamento")
            ->addOrderBy("p.ca_nombre")
            ->execute();
        
        $this->data= $this->accesosUsuario = array();
        foreach($perfiles as $p)
        {
            //$p =new Perfil();
            $this->data[$p->getCaNombre()]=array("departamento"=>$p->getCaDepartamento(),"descripcion"=>$p->getCaDescripcion(), "perfil"=>$p->getCaPerfil());
            
            
            $accesos = $p->getAccesoPerfil();
            
            foreach ($accesos as $acceso) {
                if($acceso->getCaAcceso()>-1)
                //$master = Doctrine::getTable("InoMaestraSea")->find($r);
                    $nivel = Doctrine::getTable("RutinaNivel")->find(array($acceso->getCaRutina(),$acceso->getCaAcceso()) );  
                    $nv="Con acceso";
                    if($nivel){
                        $nv=$nivel->getCaValor();
                        $nd=$nivel->getCaDescripcion();
                    }
                    
                    
                    
                    
                    
                    $this->data[$p->getCaNombre()]["accesos"][]= array(
                            "rutina"=>$acceso->getRutina()->getCaOpcion(),
                            "descripcion"=>$acceso->getRutina()->getCaDescripcion(),
                            "idrutina"=>$acceso->getCaRutina(),
                            "idnivel"=>$acceso->getCaAcceso(),
                            "nivel"=>$nv,
                            "niveldescripcion"=>$nd
                            );
                    
                    
            }

            $usuarios = $p->getUsuarioPerfil();

            foreach ($usuarios as $usuario) {
                if($usuario->getUsuario()->getCaActivo()==true){
                    $this->data[$p->getCaNombre()]["usuarios"][]= array("usuario"=>$usuario->getUsuario()->getCaLogin(),"nombre"=>$usuario->getUsuario()->getCaNombre(),"sucursal"=>$usuario->getUsuario()->getCaSucursal(),"departamento"=>$usuario->getUsuario()->getCaDepartamento(), "cargo"=>$usuario->getUsuario()->getCaCargo());   
                }
                $app = sfContext::getInstance()->getConfiguration()->getApplication();
                $accesos = Doctrine::getTable("AccesoUsuario")
                        ->createQuery("a")
                        ->innerJoin("a.Rutina r")                        
                        ->where("a.ca_login= ? ", $usuario->getCaLogin())
                        ->addWhere("r.ca_aplicacion = ?", $app)
                        ->execute();
                $this->accesos = array();
                foreach ($accesos as $acceso) {
                    $nivel = Doctrine::getTable("RutinaNivel")->findByDql("ca_rutina = ? AND ca_nivel = ?", array($acceso->getCaRutina(), $acceso->getCaAcceso()))->getFirst();
                    $this->accesosUsuario[$usuario->getUsuario()->getCaLogin()][$acceso->getRutina()->getCaOpcion()] = $nivel?$nivel->getCaValor():($acceso->getCaAcceso()==0?"Con acceso":"Otros permisos");//$acceso->getCaAcceso();
//                    echo $acceso->getCaRutina()." - ".$acceso->getCaAcceso()."-".$acceso->getRutina()->getCaOpcion();
                    //echo "<pre>";print_r($this->accesos);echo "</pre>";
                    //exit;
                }

//                $accesos = Doctrine::getTable("AccesoPerfil")
//                                ->createQuery("a")
//                                ->innerJoin("a.UsuarioPerfil up")
//                                ->innerJoin("a.Rutina r")
//                                ->where("up.ca_login= ? ", $usuario->getCaLogin())
//                                ->addWhere("r.ca_aplicacion = ?", $app)
//                                ->addOrderBy("a.ca_acceso")
//                                ->execute();
//
//                $this->accesosPerfil = array();
//                foreach ($accesos as $acceso) {
//                    $perfil = $acceso->getPerfil();
//                    $this->accesosPerfil[$acceso->getCaRutina()]['nivel'] = $acceso->getCaAcceso();
//                    $this->accesosPerfil[$acceso->getCaRutina()]['perfil'] = $perfil->getCaNombre();
//                }
//                echo "<pre>";print_r($this->accesos);echo "</pre>";
                
//                echo "<pre>";
//                print_r($this->accesosPerfil);
//                echo "</pre>";
            }
        }

        /*echo "<pre>";
        print_r($this->accesosPerfil);
        echo "</pre>";*/
  
         
        
    }
  
    public function executeCodigoPostal(sfWebRequest $request) 
    {
        
        
        
    //   visor.codigopostal.gov.co/RestService472/CodigoPostal/EntryOrdinary
    //{"token":"2822df05-78df-46b8-b32f-adba274177a0","departamento":"Bogota, D.C.","municipio":"Bogota D.C.","dvp":"11001000","direccion":"Carrera 98 No 25G - 10"}

        
        /*
         $request = new HttpRequest();
$request->setUrl('http://visor.codigopostal.gov.co/RestService472/CodigoPostal/EntryOrdinary');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'postman-token' => 'd12adb9a-afbf-b7a1-4426-d09aee6c9bd3',
  'cache-control' => 'no-cache',
  'content-type' => 'application/json'
));

$request->setBody('{"token":"2822df05-78df-46b8-b32f-adba274177a0","departamento":"Bogota, D.C.","municipio":"Bogota D.C.","dvp":"11001000","direccion":"Carrera 98 No 25G - 10"}
          ');

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
         */
        
        $sql="select c.ca_zipcode, s.ca_zipcode,c.ca_compania, c.ca_idcliente,ca_idalterno,c.ca_digito,c.ca_direccion,s.ca_direccion,s.ca_idciudad,
            ci.ca_ciudad,ci.*,c.ca_idcliente,s.ca_idsucursal
            from vi_clientes_reduc c
            inner join ids.tb_sucursales s ON c.ca_idcliente = s.ca_id and s.ca_principal =true 
            inner join tb_ciudades ci ON s.ca_idciudad = ci.ca_idciudad  and ca_idtrafico='CO-057' and s.ca_idciudad='CLO-0002' 
            where c.ca_zipcode is null 
            limit 200";        
        

        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $clientes = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
        foreach($clientes as $c)
        {
            echo "<pre>";print_r($c);echo "</pre>";
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://visor.codigopostal.gov.co/RestService472/CodigoPostal/EntryOrdinary",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\"token\":\"ad22594a-276f-4c91-ae4f-cafc0f22757d\",\"departamento\":\"Valle Del Cauca\",\"municipio\":\"".$c["ca_ciudad"]."\",\"dvp\":\"76890000\",\"direccion\":\"".$c["ca_direccion"]."\"}",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 298b9ae0-5cf0-2563-0e1d-30d0d803c155"
              ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              //echo $response;
              $cp=json_decode($response);
              echo $cp->cp;
              if($cp->cp=="")
                $cp->cp="000000";
              {
                $con2 = Doctrine_Manager::getInstance()->getConnection('master');
                    $sql2="UPDATE ids.tb_sucursales SET ca_zipcode='".$cp->cp."' WHERE ca_idsucursal='".$c["ca_idsucursal"]."'  ";        
                    $con2 = Doctrine_Manager::getInstance()->getConnection('master');
                    $st = $con2->execute($sql2);
                    echo  $sql2;
                    $sql2="UPDATE tb_clientes SET ca_zipcode='".$cp->cp."' WHERE ca_idcliente='".$c["ca_idcliente"]."'";
                    echo  $sql2;
                    $st = $con2->execute($sql2);
              }
            }
        }


        exit;
    }
    
    
    
     public function executeImportarPlantillaTarifario(sfWebRequest $request) {

        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/String.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Reader/Excel5.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/Shared/OLERead.php';
        //include sfConfig::get('app_sourceCode_lib').'vendor/phpexcel1.8/Classes/PHPExcel/Autoloader.php';
        require_once sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel.php';
        include sfConfig::get('app_sourceCode_lib') . 'vendor/phpexcel1.8/Classes/PHPExcel/IOFactory.php';


        $params = array();
        //$params[]=array("tipo"=>"P","file"=>"/srv/www/proveedores.xls","idempresa"=>"4","idtipo"=>3);
        //$params[]=array("tipo"=>"MSC","file"=>"/srv/www/tarifariomsc.xls");
        //$params[]=array("tipo"=>"Sunway","file"=>"/srv/www/tarifariosunway.xls");
        
        $file = $_FILES['archivo']['tmp_name'];

      
        

        $con1 = Doctrine_Manager::getInstance()->getConnection('master');
        
        
        /*echo $request->getParameter("tipo");
        echo "<pre>";print_r($_REQUEST);echo "</pre>";
        exit;*/
        $param["tipo"]= $request->getParameter("tipo");
        $nocontrato=$request->getParameter("nocontrato");
        $creartrayecto=$request->getParameter("creartrayecto");
        $delrecxconcepto=$request->getParameter("delrecxconcepto");
        $delrecxgeneral=$request->getParameter("delrecxgeneral");
            
            
        $opciones=array("nocontrato"=>$nocontrato,"creartrayecto"=>$creartrayecto,"delrecxconcepto"=>$delrecxconcepto,"delrecxgeneral"=>$delrecxgeneral);
        //print_r($param["tipo"]);
        //foreach ($params as $param) {
            
            $objPHPExcel = PHPExcel_IOFactory::load($file);
           
            $hojas = array();
           
            
            switch($param["tipo"])
            {
                case "MSC":
                    $resultado=$this->tarifasMSC($con1,$objPHPExcel,$opciones);
                    
                    break;
                case "Sunway":
                    $resultado=$this->tarifasSunway($con1,$objPHPExcel,$opciones);
                    
                    break;
                case "Qatar":                    
                    
                    $resultado=$this->tarifasQatar($con1,$objPHPExcel,$opciones);
                    break;
                case "Copa":                    
                    
                    $resultado=$this->tarifasCopa($con1,$objPHPExcel,$opciones);
                    break;
            }

        //}

        $this->responseArray = array( "success" => true, "data" => utf8_encode($resultado));
        $this->setTemplate("responseTemplate");
    }
    
    
    private function tarifasQatar($con1,$objPHPExcel,$opciones)
    {
        $hojas=array("BOG-0001"=>"BOG GCR");
        $data = array();
        $resultado="";
        
        foreach($hojas as $idciudad2=>$hoja)
        {
            $ws = $objPHPExcel->getSheetByName($hoja);
            //echo $hoja;
            $array = $ws->toArray();
            //echo "<pre>";print_r($array);echo "</pre>";
            
            $i=0;
            
            while($array[$i][0]!="Fechas")
            {                    
                $i++;
                if($i=="100")
                {
                    $resultado.= "<p>No se encontro la celda con las fechas de ".$hoja."</p>";
                    break;
                }
            }
            
            $fecha1=$array[$i][1];
            $fecha2=$array[$i][2];
            
            
            // ------------------------------------------------------------------
            // 
            // Observaciones
            // -------------------------------------------------------------------
            
            
                
            $observaciones="";
            while($array[$i][0]!="General Conditions:")
            {                    
                $i++;
                if($i=="500")
                {
                    $resultado.= "No se encontro la celda con las General Surcharges de ".$hoja;

                    break;
                }
            }
            $i++;

            while($array[$i][0]!="")
            {       
                $observaciones.="<br>".$array[$i][0];                
                $i++;
            }
            
            //print_r($observaciones);
                

            // ------------------------------------------------------------------
            // 
            // General SURCHAGES
            // -------------------------------------------------------------------

            $recargos=array();
            while($array[$i][0]!="recargo")
            {                    
                $i++;
                if($i=="500")
                {
                    $resultado.= "No se encontro la celda con las General Surcharges de ".$hoja;

                    break;
                }
            }
            $i++;

            while($array[$i][0]!="")
            {       
                $sql="select  c.ca_idrecargo,c.ca_recargo 
                    from tb_tiporecargo c
                        where c.ca_recargo='".utf8_decode($array[$i][0])."' order by 1 DESC ";

                $st = $con1->execute($sql);
                $recargo = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);                
                if(count($recargo)>0)
                {
                    
                    if(strtoupper($array[$i][4])!=strtoupper("todos"))
                    {
                        
                        if(substr($array[$i][4], 0,1).substr($array[$i][4], -1)=="()")
                        {
                            $cities = explode(",",substr($array[$i][4], 1,(strlen($array[$i][4])-2)) );
                            $array[$i][8]="-";
                        }                        
                        else
                        {
                            $cities = explode(",",$array[$i][4] );
                            $array[$i][8]="+";
                        }
                        
                        $ciudades=array();

                        foreach($cities as $c)
                        {
                            //echo"<br>Ciudad=".$c."   ";
                            $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                            where fun_similarpercent('".$c."',c.ca_ciudad )>50";
                            $st = $con1->execute($sql);
                            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                            if(count($ciu_simil)>0)
                            {
                                $ciudades[]=$ciu_simil[0]["ca_idciudad"];
                            }
                        }
                    }
                    else
                    {
                        $ciudades="todos";
                    }                            
                            
                    $recargos["general"][]=array($recargo[0]["ca_idrecargo"],$array[$i][0],$array[$i][1],$array[$i][2],$array[$i][3],$ciudades,$array[$i][5],$array[$i][6],$array[$i][7],$array[$i][8]);
                }
                $i++;
            }
            
            //print_r($recargos);
            //exit;
            $i=0;            
            
            while(strtoupper($array[$i][0])!=strtoupper("Destination"))
            {                    
                $i++;
                if($i=="100")
                {
                    $resultado.= "<p>No se encontro la celda con las fechas de ".$hoja."</p>";
                    break;
                }
            }            
            $i++;
            
            while(trim($array[$i][0])!="General Conditions:")
            { 
                if($i=="200")
                {
                    $resultado.= "<p>No se encontro la celda con las fechas de ".$hoja."</p>";
                    break;
                }
            
                //echo $array[$i][0];
                $c=trim($array[$i][0]);
                $resultado.="<p> Ciudad=".$c." </p>  ";
                $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                where fun_similarpercent('".$c."',c.ca_ciudad )>50";
                ///$resultado.= $sql;
                
                $st = $con1->execute($sql);
                $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                //echo count($ciu_simil);
                if(count($ciu_simil)>0)
                {
                    $resultado.= "<p>----------------------</p>";
                    $resultado.= "<p>".$ciu_simil[0]["ca_idciudad"]."..".$ciu_simil[0]["ca_ciudad"]."..".$ciu_simil[0]["ca_idtrafico"]."</p>&nbsp;&nbsp;<br>\r \n\t&nbsp;&nbsp;";
                    
                    $fletes=array(
                        "22"=>$array[$i][2],//-minimo
                        "23"=>$array[$i][3],//-45
                        "24"=>$array[$i][4],//+45
                        "25"=>$array[$i][5],//+100
                        "26"=>$array[$i][6],//+300
                        "27"=>$array[$i][7],//+500
                        "28"=>$array[$i][8]//+ 1000
                    );
                    
                    $sugerida=array(
                        "22"=>"+10",//-minimo
                        "23"=>"*1.05",//-45
                        "24"=>"*1.05",//+45
                        "25"=>"*1.05",//+100
                        "26"=>"*1.05",//+300
                        "27"=>"*1.05",//+500
                        "28"=>"*1.05"//+ 1000
                    );
                    
                    $aplicacion=array(
                        "22"=>"x Embarque",//-minimo
                        "23"=>"x Kg ó 6 Dm³",//-45
                        "24"=>"x Kg ó 6 Dm³",//+45
                        "25"=>"x Kg ó 6 Dm³",//+100
                        "26"=>"x Kg ó 6 Dm³",//+300
                        "27"=>"x Kg ó 6 Dm³",//+500
                        "28"=>"x Kg ó 6 Dm³"//+ 1000                            
                    );
                    
                    
                    //$recargos=array();
                    
                    //$parametros["sugerida"]="1.05";
                    $parametros["sugerida"]=$sugerida;
                    $parametros["aplicacion"]=$aplicacion;
                    
                    $parametros["modo"]=Constantes::EXPO;
                    $parametros["transporte"]=Constantes::AEREO;
                    $parametros["modalidad"]=Constantes::DIRECTO;
                    $parametros["origen"]=$idciudad2;
                    $parametros["destino"]=$ciu_simil[0]["ca_idciudad"];
                    $parametros["fletes"]=$fletes;
                    $parametros["recargos"]=$recargos;
                    $parametros["fecha1"]=$fecha1;
                    $parametros["fecha2"]=$fecha2;
                    $parametros["idlinea"]="16273";//qatar
                    $parametros["nocontrato"]=$opciones["nocontrato"];
                    $parametros["creartrayecto"]=$opciones["creartrayecto"];
                    $parametros["delrecxconcepto"]=$opciones["delrecxconcepto"];
                    $parametros["delrecxgeneral"]=$opciones["delrecxgeneral"];
                    $parametros["observaciones"]=$observaciones."<br>".$array[$i][9];
                    
                    
                    $resultado.=$this->insercionFletes1($parametros);

                }
                else{
                    $resultado.= "<p style='color: #FF0000'>Ciudad no encontrada $c</p>\n";
                }
                $i++;
            }
            
            return $resultado;
            
        }
        
    }
    
    private function tarifasCopa($con1,$objPHPExcel,$opciones)
    {
        $sheets = $objPHPExcel->getSheetNames();
        
        foreach($sheets as $s)
        {
            $sql="select c.*,fun_similarpercent('".$s."',c.ca_ciudad ) from tb_ciudades c
                where fun_similarpercent('".$s."',c.ca_ciudad )>70";                
            $st = $con1->execute($sql);
            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC); 
            if(count($ciu_simil)>0)
            {                           
                $hojas[$ciu_simil[0]["ca_idciudad"]]=$s;
            }
        }        
        //$hojas=array("BOG-0001"=>"Bogota");
        $data = array();
        $resultado="";
        
        foreach($hojas as $idciudad2=>$hoja)
        {
            
            $ws = $objPHPExcel->getSheetByName($hoja);
            //echo $hoja;
            $array = $ws->toArray();
            
            $i=0;
            
            while($array[$i][0]!="Fechas")
            {                    
                $i++;
                if($i=="100")
                {
                    $resultado.= "<p>No se encontro la celda con las fechas de ".$hoja."</p>";
                    break;
                }
            }
            
            $fecha1=$array[$i][1];
            $fecha2=$array[$i][2];
            
            
            // ------------------------------------------------------------------
            // 
            // Observaciones
            // -------------------------------------------------------------------
            
            
                
            $observaciones="";
            while($array[$i][0]!="Observaciones")
            {                    
                $i++;
                if($i=="500")
                {
                    $resultado.= "No se encontro la celda con las Observaciones ".$hoja;
                    break;
                }
            }
            $i++;

            while($array[$i][0]!="")
            {       
                $observaciones.="<br>".$array[$i][0];                
                $i++;
            }
            
            
            //print_r($observaciones);
                

            // ------------------------------------------------------------------
            // 
            // General SURCHAGES
            // -------------------------------------------------------------------

            $recargos=array();
            while($array[$i][0]!="recargo")
            {                    
                $i++;
                if($i=="500")
                {
                    $resultado.= "No se encontro la celda con las General Surcharges de ".$hoja;

                    break;
                }
            }
            $i++;

            while($array[$i][0]!="")
            {       
                $sql="select  c.ca_idrecargo,c.ca_recargo 
                    from tb_tiporecargo c
                        where c.ca_recargo='".utf8_decode($array[$i][0])."' order by 1 DESC ";

                $st = $con1->execute($sql);
                $recargo = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);                
                if(count($recargo)>0)
                {
                    
                    if(strtoupper($array[$i][4])!=strtoupper("todos"))
                    {
                        
                        if(substr($array[$i][4], 0,1).substr($array[$i][4], -1)=="()")
                        {
                            $cities = explode(",",substr($array[$i][4], 1,(strlen($array[$i][4])-2)) );
                            $array[$i][8]="-";
                        }                        
                        else
                        {
                            $cities = explode(",",$array[$i][4] );
                            $array[$i][8]="+";
                        }
                        
                        $ciudades=array();

                        foreach($cities as $c)
                        {
                            //echo"<br>Ciudad=".$c."   ";
                            $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                            where fun_similarpercent('".$c."',c.ca_ciudad )>50";
                            $st = $con1->execute($sql);
                            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                            if(count($ciu_simil)>0)
                            {
                                $ciudades[]=$ciu_simil[0]["ca_idciudad"];
                            }
                        }
                    }
                    else
                    {
                        $ciudades="todos";
                    }                            
                            
                    $recargos["general"][]=array($recargo[0]["ca_idrecargo"],$array[$i][0],$array[$i][1],$array[$i][2],$array[$i][3],$ciudades,$array[$i][5],$array[$i][6],$array[$i][7],$array[$i][8]);
                }                    
                $i++;
            }
            
            //print_r($recargos);
            //exit;
            $i=1;  
            
            
            
           
            
            while(strtoupper($array[$i][0])!=strtoupper("Destination"))
            {    
                $i++;
                if($i=="200")
                {
                    $resultado.= "<p>No se encontro la celda con las fechas de ".$hoja."</p>";
                    break;
                }
            }            
            $i++;
            $i++;
            
            
            while(trim($array[$i][0])!="")
            { 
                
                if($i=="200")
                {
                    $resultado.= "<p>No se encontro la celda con las fechas de ".$hoja."</p>";
                    break;
                }
            
                
                $c=trim($array[$i][0]);
                if(strlen($c)>2)
                {

                    $resultado.="<p> Ciudad=".$c." </p>  ";
                    $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                    where fun_similarpercent('".$c."',c.ca_ciudad )>50";
                    ///$resultado.= $sql;

                    $st = $con1->execute($sql);
                    $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                    //echo count($ciu_simil);
                    if(count($ciu_simil)>0)
                    {

                        $resultado.= "<p>----------------------</p>";
                        $resultado.= "<p>".$ciu_simil[0]["ca_idciudad"]."..".$ciu_simil[0]["ca_ciudad"]."..".$ciu_simil[0]["ca_idtrafico"]."</p>&nbsp;&nbsp;<br>\r \n\t&nbsp;&nbsp;";

                        
                        $fletes=array(
                            "22"=>$array[$i][7],
                            "248"=>$array[$i][8],//-100
                            "25"=>$array[$i][9],//+100
                            "26"=>$array[$i][10],//+300
                            "27"=>$array[$i][11]//,+500
                            
                         );
                        
                        $sugerida=array(
                            "22"=>"+10",
                            "248"=>"*1.05",//-100
                            "25"=>"*1.05",//+100
                            "26"=>"*1.05",//+300
                            "27"=>"*1.05"
                         );
                        
                        $aplicacion=array(
                            "22"=>"x Embarque",
                            "248"=>"x Kg ó 6 Dm³",
                            "25"=>"x Kg ó 6 Dm³",
                            "26"=>"x Kg ó 6 Dm³",
                            "27"=>"x Kg ó 6 Dm³"
                         );
                        

                        //$recargos=array();
                        //$parametros["sugerida"]="x1.05";
                        $parametros["sugerida"]=$sugerida;
                        $parametros["aplicacion"]=$aplicacion;

                        $parametros["modo"]=Constantes::EXPO;
                        $parametros["transporte"]=Constantes::AEREO;
                        $parametros["modalidad"]=Constantes::DIRECTO;
                        $parametros["origen"]=$idciudad2;
                        $parametros["destino"]=$ciu_simil[0]["ca_idciudad"];
                        $parametros["fletes"]=$fletes;
                        $parametros["recargos"]=$recargos;
                        $parametros["fecha1"]=$fecha1;
                        $parametros["fecha2"]=$fecha2;
                        $parametros["idlinea"]="860025338";//copa
                        
            
                        $parametros["nocontrato"]=$opciones["nocontrato"];
                        $parametros["creartrayecto"]=$opciones["creartrayecto"];
                        $parametros["delrecxconcepto"]=$opciones["delrecxconcepto"];
                        $parametros["delrecxgeneral"]=$opciones["delrecxgeneral"];
                        $parametros["observaciones"]=$observaciones."<br>".$array[$i][12]."<br> ROUTE: ".$array[$i][3]." <br> COLLECT CHARGES:".$array[$i][2]."<br>PESO MAXIMO:".$array[$i][6];
                        

                        $resultado.=$this->insercionFletes1($parametros);

                    }
                    else{
                        $resultado.= "<p style='color: #FF0000'>Ciudad no encontrada $c</p>\n";
                    }
                }
                $i++;
            }
            
            return $resultado;
            
        }
        
    }
    
    private function tarifasSunway($con1,$objPHPExcel,$opciones)
    {
        $hojas=array("BUN-0002"=>"COBUN","CTG-0005"=>"COBAQ CTG SMR","BAQ-0005"=>"COBAQ CTG SMR","STA-0005"=>"COBAQ CTG SMR");
        $data = array();
        $resultado="";
        
        
        //print_r($objPHPExcel->getSheetNames());
        //exit;
        foreach($hojas as $idciudad2=>$hoja)
        {
            $ws = $objPHPExcel->getSheetByName($hoja);
            $array = $ws->toArray();
            //echo "<pre>";print_r($array);echo "</pre>";
            $i=1;
            
            
            $parametros["modo"]="Importación";
            $parametros["transporte"]="Marítimo";
            $parametros["modalidad"]="FCL";            
            $parametros["destino"]=$idciudad2;
                                            
            if($opciones["nocontrato"]!="")
                $parametros["nocontrato"]=$opciones["nocontrato"];
            $parametros["creartrayecto"]=$opciones["creartrayecto"];
            $parametros["delrecxconcepto"]=$opciones["delrecxconcepto"];
            $parametros["delrecxgeneral"]=$opciones["delrecxgeneral"];
            
            while($array[$i][2]!="")
            {
                if($i=="500")
                {
                    $resultado.="No se encontro la celda con las Other Surcharges de ".$hoja."<br>";

                    break;
                }
                while(strtoupper($array[$i][0])!="CARRIER")
                {
                    if($i=="500")
                    {
                        $resultado.="No se encontro la celda con las Carrier de ".$hoja."<br>";

                        break;
                    }
                    $i++;
                }

                //echo $array[$i][0];
                $i++;
                $resultado.=$array[$i][0];
                $cadena=$array[$i][0];
                //echo $cadena;
                $prov = Doctrine::getTable('Ids')
                    ->createQuery('i')
                    ->innerJoin("i.IdsProveedor prov")
                    ->addWhere(' prov.ca_sigla like ?', array('%' . strtoupper($cadena) . '%'))
                    ->innerJoin("i.IdsSucursal s")
                    ->innerJoin("s.Ciudad c")
                    ->innerJoin("c.Trafico t")
                    //->addWhere('t.ca_idtrafico = ?', 'CN-086')
                    ->fetchOne();
                if($prov)
                {
                    $resultado.= $cadena." ".$prov->getCaId()."<br>";
                    while(strtoupper($array[$i][2])!="POL")
                    {
                        
                        if($i=="300" || $array[$i][2]=="")
                        {
                            $resultado.= "Fin de archivo o No se encontro la celda con las POL de ".$hoja."<br>";

                            break;
                        }
                        $resultado.= $array[$i][2]."<br>";
                        $cities = explode(",",$array[$i][2] );
                        //print_r($cities);
                        if(count($cities)==1)
                        {
                            $cities = explode("/",$array[$i][2] );
                            //print_r($cities);
                        }
                        //echo "<br>----------------------------------------<br> count=".count($cities);
                        foreach($cities as $c)
                        {
                            $c=trim($c);
                            $resultado.="<p> Ciudad=".$c." </p>  ";
                            $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                            where fun_similarpercent('".$c."',c.ca_ciudad )>50";
                            //$resultado.= $sql;
                            $st = $con1->execute($sql);
                            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                            if(count($ciu_simil)>0)
                            {
                                $resultado.= "<p>----------------------</p>";
                                $resultado.= "<p>".$ciu_simil[0]["ca_idciudad"]."..".$ciu_simil[0]["ca_ciudad"]."..".$ciu_simil[0]["ca_idtrafico"]."</p>";
                        
                                
                                //$valorNeto=array("",$array[$i][3],$array[$i][4],$array[$i][5],$array[$i][6]);
                                if($array[$i][7]!="")
                                    $fecha1=$array[$i][7];
                                if($array[$i][8]!="")
                                    $fecha2=$array[$i][8];
                                $resultado.= $fecha1. " : ".$fecha2;
                                $recargos=array();
                             
                                
                                $fletes=array(
                                    "10"=>$array[$i][3],//20
                                    "15"=>$array[$i][4],//40
                                    "21"=>$array[$i][5],//40HC
                                    "54"=>$array[$i][6]//NOR
                                );
                                
                                $parametros["idlinea"]=$prov->getCaId();
                                $parametros["origen"]=$ciu_simil[0]["ca_idciudad"];
                                $parametros["pais_origen"]=$ciu_simil[0]["ca_idtrafico"];                                
                                //$parametros["fletes"]=$valorNeto;
                                $parametros["fletes"]=$fletes;                                
                                $parametros["recargos"]=$recargos;
                                $parametros["fecha1"]=$fecha1;
                                $parametros["fecha2"]=$fecha2;
                                $resultado.=$this->insercionFletes1($parametros);
                             
                            }
                            else{
                                $resultado.= "<p style='color: #FF0000'>Ciudad no encontrada $c</p>";
                            }
                        }                        
                        $i++;
                        $resultado.= $array[$i][2];
                        //exit;
                    }
                    $i--;
                    
                }
                else
                    $resultado.= "<p>No Encontrado: {$cadena}</p>";
                    
                
                 $i++;
            }
        }
        return $resultado;
    }
    
    private function tarifasMSC($con1,$objPHPExcel,$opciones)
    {
        $resultado="";
        $hojas=array("BUN-0002"=>"BUN","CTG-0005"=>"CTG");

            $data = array();
            
            
            foreach($hojas as $idciudad2=>$hoja)
            {
                
                $parametros["modo"]="Importación";
                $parametros["transporte"]="Marítimo";
                $parametros["modalidad"]="FCL";
                $parametros["idlinea"]="18";
                $parametros["origen"]=$ciu_simil[0]["ca_idciudad"];
                $parametros["destino"]=$idciudad2;
                $parametros["fecha1"]=$fecha1;
                $parametros["fecha2"]=$fecha2;                                
                $parametros["nocontrato"]=$opciones["nocontrato"];
                $parametros["creartrayecto"]=$opciones["creartrayecto"];                
                $parametros["delrecxconcepto"]=$opciones["delrecxconcepto"];
                $parametros["delrecxgeneral"]=$opciones["delrecxgeneral"];
                
                                
                
                $ws = $objPHPExcel->getSheetByName($hoja);
                $array = $ws->toArray();
               
                $resultado.="<div>". $fecha."</div>"; 

                $fechas= split(" ",$array[2][0]);
                //print_r($fechas);

                $resultado.="<br>".$fechas[2]."<br>";
                //$fecha1= Utils::parseDate($fechas[2], "d/m/Y");

                list(   $day,$month,$year ) = sscanf($fechas[2], "%d/%d/%d");
                $fecha1=date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));


                list(   $day,$month,$year ) = sscanf($fechas[4], "%d/%d/%d");
                $fecha2=date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));

                $resultado.= $fecha1." :: ".$fecha2;

                
                $parametros["modo"]="Importación";
                $parametros["transporte"]="Marítimo";
                $parametros["modalidad"]="FCL";
                $parametros["idlinea"]="18";
                $parametros["origen"]=$ciu_simil[0]["ca_idciudad"];
                $parametros["destino"]=$idciudad2;
                $parametros["fecha1"]=$fecha1;
                $parametros["fecha2"]=$fecha2;                                
                $parametros["nocontrato"]=$nocontrato;
                $parametros["creartrayecto"]=$creartrayecto;
                $polGrouping=array();
                //Tarifas contenedores 20,40,hc
                
                
                // ******************************************************************
                // * 
                // * OTHER SURCHAGES
                // *****************************************************************
                $i=6;
                while($array[$i][0]!="Other Surcharges")
                {
                    $i++;
                    if($i=="100")
                    {
                        $resultado.= "No se encontro la celda con las Other Surcharges de ".$hoja;
                        
                        break;
                    }
                }
                $i++;
                $recargos=array();
                
                while($array[$i][0]!="")
                {
                    $sql="select fun_similarpercent('".$array[$i][0]."',ca_recargo ) , c.ca_idrecargo,c.ca_recargo 
                        from tb_tiporecargo c
                            where fun_similarpercent('".$array[$i][0]."',c.ca_recargo )>80 order by 1 DESC ";

                    $st = $con1->execute($sql);
                    $recargo = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                    if(count($recargo)>0)
                    {
                        $recxcon=array(
                                    "10"=>$array[$i][1],//-minimo
                                    "15"=>$array[$i][2],//-45
                                    "21"=>$array[$i][3]
                                );
                        $recargos["concepto"][$recargo[0]["ca_idrecargo"]]=$recxcon;
                        //$recargos["general"][]=array($recargo[0]["ca_idrecargo"],$array[$i][0],$array[$i][1],$array[$i][2],$array[$i][3],$ciudades,$array[$i][5],$array[$i][6],$array[$i][7],$array[$i][8]);
                        
                    }                    
                    $i++;
                }
                
                
                // ------------------------------------------------------------------
                // 
                // General SURCHAGES
                // -------------------------------------------------------------------
                
                while($array[$i][0]!="General Surcharges")
                {                    
                    $i++;
                    if($i=="100")
                    {
                        $resultado.= "No se encontro la celda con las General Surcharges de ".$hoja;
                       
                        break;
                    }
                }
                $i++;
                
                while($array[$i][0]!="")
                {       
                    $sql="select  c.ca_idrecargo,c.ca_recargo 
                        from tb_tiporecargo c
                            where c.ca_recargo='".utf8_decode($array[$i][0])."' order by 1 DESC ";

                    $st = $con1->execute($sql);
                    $recargo = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                    //print_r($recargo);
                    if(count($recargo)>0)
                    {
                        //echo $recargo[0]["ca_idrecargo"]."  :::::::::  ";
                        $recargos["linea"][$recargo[0]["ca_idrecargo"]]=$array[$i][1];
                    }                    
                    $i++;
                }
                
                //$resultado.= "<pre>";print_r($recargos);echo "</pre>";
                
               
                
                //exit;

                $i=6;
                while($array[$i][0]!="")
                {
                    //echo $array[$i][0];
                    //if(strpos($array[$i][0], "/"))
                    {
                        $cities = explode("/",$array[$i][0] );
                        //echo "<br>----------------------------------------<br> count=".count($cities);
                        foreach($cities as $c)
                        {
                            //echo"<br>Ciudad=".$c."   ";
                            $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                            where fun_similarpercent('".$c."',c.ca_ciudad )>50";

                            $st = $con1->execute($sql);
                            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                            if(count($ciu_simil)>0)
                            {
                                $resultado.= "<br>----------------------<br>";
                                $resultado.= $ciu_simil[0]["ca_idciudad"]."..".$ciu_simil[0]["ca_ciudad"]."..".$ciu_simil[0]["ca_idtrafico"]."<br>";
                                

                                //---------------------------------------------------------------------------------------------
                                // * Insercion de tarifas de fltes
                                // * 
                                //-------------------------------------------------------------------------------

                                $data[$hoja][$ciu_simil[0]["ca_ciudad"]]=$array[$i];
                                
                                
                                
                                $fletes=array(
                                    "10"=>$array[$i][1],//-minimo
                                    "15"=>$array[$i][2],//-45
                                    "21"=>$array[$i][3]
                                );
                                
                                
                                
                                $parametros["origen"]=$ciu_simil[0]["ca_idciudad"];
                                $parametros["pais_origen"]=$ciu_simil[0]["ca_idtrafico"];
                                //$parametros["fletes"]=$array[$i];
                                $parametros["fletes"]=$fletes;
                                $parametros["recargos"]=$recargos;
                                $resultado.=$this->insercionFletes1($parametros);
                                
                                //print_r($parametros);
                                
                                //$resultado.=$this->insercionFletes($array[$i],$recargos,$fecha1,$fecha2,"18",$nocontrato,$creartrayecto);
                                  //**********+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                                 //* FIN Insercion de tarifas de fltes
                                // * 
                                // ---------------------------------------------------------------------------------------




                            }
                            else{
                                $resultado.= "<p style='color: #FF0000'>Ciudad no encontrada $c</p>";

                                $sql="select t.*,fun_similarpercent('".$c."',t.ca_nombre ) from tb_traficos t
                                    where fun_similarpercent('".$c."',t.ca_nombre )>50";

                                $st = $con1->execute($sql);
                                $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                                if(count($ciu_simil)>0)
                                {
                                    $resultado.= $ciu_simil[0]["ca_idtrafico"]."..".$ciu_simil[0]["ca_nombre"];
                                    
                                }
                                else{
                                    $resultado.= "<p style='color: #FF0000'>Pais no encontrado $c</p>";
                                }                                
                                $polGrouping[]=$array[$i][0];
                                $valGrouping[]=array($array[$i][0],$array[$i][1],$array[$i][2],$array[$i][3]);
                            }

                        }

                    }
                    $resultado.= "<p></p>";
                    $i++;
                }
                
            //echo $resultado;
            //exit;

                
                // ------------------------------------------------------------------
                //
                // POL Grouping
                // -------------------------------------------------------------------
                
                
                $resultado.= $i;
                while($array[$i][0]!="POL Grouping")
                {
                    $resultado.= $i;
                    $i++;
                    if($i=="100")
                    {
                        $resultado.= "<p>No se encontro la celda con las POL Grouping de ".$hoja."</p>";
                        exit;
                        break;
                    }
                    //exit;
                    //while($array[$i][0]!="")
                    //{
                    //    echo "<pre>";print_r($array[$i]);echo "</pre>";
                    //    $i++;
                    //}
                }
                //echo "<br>POL Grouping<br>";
                $resultado.= "<p style='color: #FFFF00'>POL Grouping</p>";
                //print_r($polGrouping);
                while($array[$i][0]!="")
                {
                    $clave = array_search($array[$i][0], $polGrouping); // $clave = 2;
                    if (in_array($array[$i][0], $polGrouping)) {
                        $resultado.= "<br>Existe:".$array[$i][0];
                        
                        $cities = explode(",",$array[$i][1] );
                        if(count($cities)==1)
                        {
                            $cities = explode("/",$array[$i][1] );
                        }
                        //echo "<br>----------------------------------------<br> count=".count($cities);
                        foreach($cities as $c)
                        {
                            $c=trim($c);
                            //echo"<br>Ciudad=".$c."   ";
                            $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                            where fun_similarpercent('".$c."',c.ca_ciudad )>50";

                            $st = $con1->execute($sql);
                            $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                            if(count($ciu_simil)>0)
                            {
                                $resultado.= "<p>----------------------</p>";
                                $resultado.= "<p>".$ciu_simil[0]["ca_idciudad"]."..".$ciu_simil[0]["ca_ciudad"]."..".$ciu_simil[0]["ca_idtrafico"]."</p>";
                        
                                $data[$hoja][$ciu_simil[0]["ca_ciudad"]]=$valGrouping[$clave];
                                
                                /*$parametros["origen"]=$ciu_simil[0]["ca_idciudad"];
                                $parametros["fletes"]=$valGrouping[$clave];
                                $parametros["recargos"]=$recargos;
                                $resultado.=$this->insercionFletes1($parametros);*/
                                
                                
                                $fletes=array(
                                    "10"=>$valGrouping[$clave][1],//-minimo
                                    "15"=>$valGrouping[$clave][2],//-45
                                    "21"=>$valGrouping[$clave][3]
                                );
                                
                                
                                
                                $parametros["origen"]=$ciu_simil[0]["ca_idciudad"];
                                //$parametros["fletes"]=$array[$i];
                                $parametros["fletes"]=$fletes;
                                $parametros["recargos"]=$recargos;
                                $resultado.=$this->insercionFletes1($parametros);
                                
                                
                                
                                
                                //$resultado.=$this->insercionFletes($ciu_simil[0]["ca_idciudad"],$idciudad2,$valGrouping[$clave],$recargos,$fecha1,$fecha2,"18",$nocontrato,$creartrayecto);
                            }
                            else{
                                $resultado.= "<p style='color: #FF0000'>Ciudad no encontrada $c</p>";
                            }
                        }
                    }
                    else
                    {
                        $resultado.= "<p style='color: #FF0000'>POL no existe {$array[$i][0]}</p>";
                        
                    }
                    
                    //echo "<pre>";print_r($array[$i]);echo "</pre>";
                    $i++;
                }
                //$polGrouping;
                
            }

           
            $hojas=array("CNPRC");
            $hojas=array("CNPRC","SPRC");
            $i=1;
            foreach($hojas as $hoja)
            {
                $resultado.= "<p style='color: #FFFF00;font:18px'>PESTAÑA DE $hoja</p>";
                $ws = $objPHPExcel->getSheetByName($hoja);
                $array = $ws->toArray();
                //echo $i;
                
                //echo "<pre>";print_r($array);echo "</pre>";
                //exit;
                $cont=count($array);
                $i=0;
                
                while($array[$i][0]!="Fechas")
                {                    
                    $i++;
                    if($i=="100")
                    {
                        $resultado.= "<p>No se encontro la celda con las fechas de ".$hoja."</p>";
                        break;
                    }
                }
                //$i++;
                                    
                $fecha1=$array[$i][1];
                $fecha2=$array[$i][2];
                
                
                $resultado.= "<p>Fechas Pestaña:".$fecha1. " : ".$fecha2."</p>" ;
                while($array[$i][0]!="Origins")
                {                    
                    $i++;
                }
                
                //echo count($array[$i]);
                $titulos=$array[$i];
                foreach($array[$i] as $pos=>$arr)
                {
                    if($arr=="via  (Rates to be added on top of)")
                        break;
                }
                //echo $pos."<br>";
                //echo "<pre>";print_r($data);echo "</pre>";
                
                while($array[$i][0]!="")
                {
                    //print_r($array[$i][0]);
                    $c=$array[$i][0];
                    
                    $sql="select c.*,fun_similarpercent('".$c."',c.ca_ciudad ) from tb_ciudades c
                            where fun_similarpercent('".$c."',c.ca_ciudad )>50";

                    $st = $con1->execute($sql);
                    $ciu_simil = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                    if(count($ciu_simil)>0)
                    {
                        $resultado.= "<p>----------------------</p>";
                        $resultado.= "<p>".$ciu_simil[0]["ca_idciudad"]."..".$ciu_simil[0]["ca_ciudad"]."..".$ciu_simil[0]["ca_idtrafico"]."</p>";
                        //echo "<br>  desde:".$array[$i][$pos]."<br>";
                        
                         $sql="select c.*,fun_similarpercent('".$array[$i][$pos]."',c.ca_ciudad ) from tb_ciudades c
                            where fun_similarpercent('".$array[$i][$pos]."',c.ca_ciudad )>50";

                        $st = $con1->execute($sql);
                        $ciu_simil2 = $st->fetchAll(Doctrine_Core::FETCH_ASSOC);
                        if(count($ciu_simil2)>0)
                        {
                            /*echo "20: ".$array[$i][$pos+1]." + ".$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][1]." = ".($array[$i][$pos+1]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][1])."<br>";
                            echo "40: ".$array[$i][$pos+2]." + ".$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][2]." = ".($array[$i][$pos+2]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][2])."<br>";
                            echo "HC: ".$array[$i][$pos+3]." + ".$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][3]." = ".($array[$i][$pos+3]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][3])."<br>";
                            */
                            
                            
                            /*$valGrouping=array($array[$i][$pos],
                                ($array[$i][$pos+1]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][1]),
                                ($array[$i][$pos+2]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][2]),
                                ($array[$i][$pos+3]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][3]));
                             * 
                             */
                            
                            $fletes=array(
                                    "10"=>($array[$i][$pos+1]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][1]),//-minimo
                                    "15"=>($array[$i][$pos+2]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][2]),//-45
                                    "21"=>($array[$i][$pos+3]+$data["BUN"][$ciu_simil2[0]["ca_ciudad"]][3])
                                );
                            
                            $parametros["origen"]=$ciu_simil[0]["ca_idciudad"];
                            $parametros["destino"]="BUN-0002";
                            //$parametros["fletes"]=$valGrouping[$clave];
                            $parametros["fletes"]=$fletes;
                            $parametros["recargos"]=$recargos;
                            $resultado.=$this->insercionFletes1($parametros);
                            
                            $parametros["destino"]="CTG-0005";
                            $resultado.=$this->insercionFletes1($parametros);
                            
                            //$resultado.=$this->insercionFletes($ciu_simil[0]["ca_idciudad"],"BUN-0002", $valGrouping,$recargos,$fecha1,$fecha2,"18",$nocontrato,$creartrayecto);
                            //$resultado.=$this->insercionFletes($ciu_simil[0]["ca_idciudad"],"CTG-0005", $valGrouping,$recargos,$fecha1,$fecha2,"18",$nocontrato,$creartrayecto);
                        }
                        else
                        {
                            $resultado.= "<p><span style='color: #FF0000'>Ciudad no encontrada de Origen :. ".$array[$i][$pos]."</p>";
                        }
                        
                        
            
                    }
                    else{
                        $resultado.= "<sp style='color: #FF0000'>Ciudad  no encontrada $c</p>";
                    }
                    $resultado.= "<p></p>";
                    $i++;
                }
            }
 
            return $resultado;
        
    }
    private function insercionFletes($idciudad,$idciudad2,$valorNeto,$recargos,$fecha1,$fecha2,$idlinea=18,$nocontrato,$creartrayecto) 
    {
        $resultado="";
        $impoexpo   ="Importación";   
        $transporte ="Marítimo";
        $modalidad  ="FCL";
        //$idciudad   =$ciu_simil[0]["ca_idciudad"];
        //$idciudad2  ="BUN-0002";
        //$idlinea    = $idlinea;

        $q= Doctrine_Query::create()
            ->select("t.ca_idtrayecto")
            ->from("Trayecto t")
            ->leftJoin("t.IdsAgente a")
            ->leftJoin("a.Ids ai")                                
            ->where("t.ca_impoexpo = ? ", $impoexpo)
            ->addWhere("t.ca_transporte = ? ", $transporte)
            ->addWhere("t.ca_modalidad = ? ", $modalidad)
            ->addWhere("t.ca_activo = ? ", true)        
            ->addWhere("(a.ca_activo = ? OR a.ca_activo IS NULL)", true)
            ->addWhere("t.ca_origen = ? ", $idciudad)
            ->addWhere("t.ca_destino = ? ", $idciudad2)
            ->addWhere("t.ca_idlinea = ? ", $idlinea);
        
        if($nocontrato!="")
            $q->addWhere("t.ca_ncontrato = ? ", $nocontrato);

        $trayecto =$q->fetchOne();

        $resultado.= "<p>Origen : ".$idciudad. " -- destino : ".$idciudad2."</p>";
        $idtrayecto="";
        if($trayecto)
        {
            $idtrayecto=$trayecto->getCaIdtrayecto();
            $resultado.= " ::Id Trayecto=".$trayecto->getCaIdtrayecto()."<br>";
        }
        else if($creartrayecto=="on")
        {
            $trayecto = new Trayecto();
            $trayecto->setCaOrigen($idciudad);
            $trayecto->setCaDestino($idciudad2);
            $trayecto->setCaIdlinea($idlinea);
            $trayecto->setCaTransporte($transporte);
            $trayecto->setCaImpoexpo($impoexpo);
            $trayecto->setCaModalidad($modalidad);
            $trayecto->save();
            $idtrayecto=$trayecto->getCaIdtrayecto();
            $resultado.= "<p style='color: #FF0000'>Trayecto Creado</p>";
        }
        else
        {
           $resultado.= "<p style='color: #FF0000'>Trayecto no encontrado</p>";
        }

        $titulos=array("20","40","HC");
        if($idtrayecto!="")
        {
            $items=array("10","15","21");
            foreach($items as $k=>$it)
            {
                if(!is_numeric($valorNeto[$k+1]))
                    continue;
                //----------------FLETES---------------------------
                $q = Doctrine::getTable("PricFlete")->createQuery()
                        ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                        ->addWhere("ca_idconcepto= ?", $it)
                        ->addWhere("ca_idequipo IS NULL");
                $flete = $q->fetchOne();

                if (!$flete) {
                    $flete = new PricFlete();
                    $flete->setCaIdtrayecto($idtrayecto);
                    $flete->setCaIdconcepto($it);                               
                    $flete->setCaVlrneto(0);
                    $flete->setCaIdequipo(null);
                }

                $flete->setCaVlrneto($valorNeto[$k+1]);
                $flete->setCaFchinicio($fecha1);                            
                $flete->setCaFchvencimiento($fecha2);                            
                $flete->setCaIdmoneda("USD");

                $user = $this->getUser();
                $flete->setCaUsucreado($user->getUserId());
                $flete->setCaFchcreado(date("Y-m-d H:i:s"));
                $flete->save(  );
                $resultado.= "<p>Tarifa de Fletes Actualizada para ".$titulos[$k]." = ".$valorNeto[$k+1]."</p>";
                
                //----------------FLETES---------------------------
                
                
                //----------------RECARGOS---------------------------
                
                foreach($recargos["concepto"] as $idrecargo=>$r)
                {                
                    $pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                        ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                        ->addWhere("ca_idconcepto = ?", $it)
                        ->addWhere("ca_idrecargo = ?", $idrecargo)
                        ->addWhere("ca_idequipo IS NULL")
                        ->fetchOne();
                    
                   // echo "idtrayecto: $idtrayecto,  concepto: $it, recargo:$idrecargo,  valor:".$pricRecargo->getCaVlrrecargo().",  valor2: ".$r[$k+1]."<br>";
                    if (!$pricRecargo) {
                        $pricRecargo = new PricRecargoxConcepto();
                        $pricRecargo->setCaIdtrayecto($idtrayecto);
                        $pricRecargo->setCaIdconcepto($it);
                        $pricRecargo->setCaIdrecargo($idrecargo);
                        $pricRecargo->setCaIdmoneda("USD");
                        $pricRecargo->setCaAplicacion("x Contenedor");
                                                
                    }
                    
                    $pricRecargo->setCaFchinicio($fecha1);
                    $pricRecargo->setCaFchvencimiento($fecha2);
                    $pricRecargo->setCaVlrrecargo($r[$k+1]);
                    $pricRecargo->save();
                    
                    $resultado.= "<p>Recargo de Concepto Actualizada para ".$titulos[$k]." = ".$r[$k+1]."</p>";
                }
                                
                
                
                //----------------RECARGOS---------------------------

            }
            
            foreach($recargos["general"] as $idrecargo=>$r)
                {                
                    $pricLinea = Doctrine::getTable("PricRecargoxLinea")->createQuery()
                        ->addWhere("ca_idlinea = ?", $idlinea)
                        ->addWhere("ca_idconcepto = ?", "9999")
                        ->addWhere("ca_idrecargo = ?", $idrecargo)
                        ->addWhere("ca_idtrafico = ? ", "CN-086")
                        ->addWhere("ca_modalidad = ? ", "FCL")
                        ->fetchOne();
                    
                   // echo "idtrayecto: $idtrayecto,  concepto: $it, recargo:$idrecargo,  valor:".$pricRecargo->getCaVlrrecargo().",  valor2: ".$r[$k+1]."<br>";
                    if (!$pricLinea) {
                        $pricLinea = new PricRecargoxLinea();
                        $pricLinea->setCaIdLinea($idlinea);
                        $pricLinea->setCaIdconcepto("9999");
                        $pricLinea->setCaIdrecargo($idrecargo);
                        $pricLinea->setCaIdtrafico("CN-086");
                        $pricLinea->setCaIdmoneda("USD");
                        $pricLinea->setCaAplicacion("x Contenedor");
                                                
                    }
                    
                    $pricLinea->setCaFchinicio($fecha1);
                    $pricLinea->setCaFchvencimiento($fecha2);
                    $pricLinea->setCaVlrrecargo($r[1]);
                    $pricLinea->save();
                    
                    $resultado.= "<p>Recargo de Concepto Actualizada para ".$titulos[$k]." = ".$r[1] . " Fe: ".$fecha1. "-".$fecha2."</p>";
                }
        }
        return $resultado;
    }
  
    
    private function insercionFletes1($parametros) 
    {
        
        
        $idtrafico=$parametros["pais_origen"];
        $idciudad=$parametros["origen"];
        $idciudad2=$parametros["destino"];
        $fletes=$parametros["fletes"];
        
        $recargos=$parametros["recargos"];
        $fecha1=$parametros["fecha1"];
        $fecha2=$parametros["fecha2"];
        $idlinea=$parametros["idlinea"];
        $nocontrato=$parametros["nocontrato"];
        $creartrayecto=$parametros["creartrayecto"];
        $delrecxconcepto=$parametros["delrecxconcepto"];
        $delrecxgeneral=$parametros["delrecxgeneral"];
        
        
        $resultado="";
        $impoexpo   =$parametros["modo"];
        $transporte =$parametros["transporte"];
        $modalidad  =$parametros["modalidad"];
        //$fletes  =$parametros["fletes"];
        
        $observaciones  =$parametros["observaciones"];
        
        $sugerida=$parametros["sugerida"];
        $aplicacion=$parametros["aplicacion"];
        
        //$idciudad   =$ciu_simil[0]["ca_idciudad"];
        //$idciudad2  ="BUN-0002";
        //$idlinea    = $idlinea;

        $q= Doctrine_Query::create()
            ->select("t.ca_idtrayecto")
            ->from("Trayecto t")
            ->leftJoin("t.IdsAgente a")
            ->leftJoin("a.Ids ai")
            ->where("t.ca_impoexpo = ? ", $impoexpo)
            ->addWhere("t.ca_transporte = ? ", $transporte)
            ->addWhere("t.ca_modalidad = ? ", $modalidad)
            ->addWhere("t.ca_activo = ? ", true)        
            ->addWhere("(a.ca_activo = ? OR a.ca_activo IS NULL)", true)
            ->addWhere("t.ca_origen = ? ", $idciudad)
            ->addWhere("t.ca_destino = ? ", $idciudad2)
            ->addWhere("t.ca_idlinea = ? ", $idlinea);
        
        if($nocontrato!="")
            $q->addWhere("t.ca_ncontrato = ? ", $nocontrato);

        $trayecto =$q->fetchOne();

        $resultado.= "<p>Origen : ".$idciudad. " -- destino : ".$idciudad2."</p>";
        $idtrayecto="";
        if($trayecto)
        {
            $idtrayecto=$trayecto->getCaIdtrayecto();
            $resultado.= " ::Id Trayecto=".$trayecto->getCaIdtrayecto()."<br>";
        }
        else if($creartrayecto=="on")
        {
            $trayecto = new Trayecto();
            $trayecto->setCaOrigen($idciudad);
            $trayecto->setCaDestino($idciudad2);
            $trayecto->setCaIdlinea($idlinea);
            $trayecto->setCaTransporte($transporte);
            $trayecto->setCaImpoexpo($impoexpo);
            $trayecto->setCaModalidad($modalidad);
            $trayecto->save();
            $idtrayecto=$trayecto->getCaIdtrayecto();
            $resultado.= "<p style='color: #FF0000'>Trayecto Creado</p>";
        }
        else
        {
           $resultado.= "<p style='color: #FF0000'>Trayecto no encontrado</p>";
        }

        //$titulos=array("20","40","HC");
        if($idtrayecto!="")
        {
            if($observaciones!="")
            {
                $trayecto->setCaObservaciones($observaciones);
                $trayecto->save();
            }
            //$items=array("10","15","21");
            
            
            $minima="";
            foreach($fletes as $idconcepto=>$valor)
            {
                
                if($idconcepto=="minima")
                {
                    $minima=$valor;
                    continue;
                }
                if($idconcepto=="observaciones")
                {
                    $observaciones=$valor;
                    continue;
                }
                
                if(!is_numeric($valor))
                    continue;
                //----------------FLETES------v---------------------
                $q = Doctrine::getTable("PricFlete")->createQuery()
                        ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                        ->addWhere("ca_idconcepto= ?", $idconcepto)
                        ->addWhere("ca_idequipo IS NULL");
                $flete = $q->fetchOne();

                if (!$flete) {
                    $flete = new PricFlete();
                    $flete->setCaIdtrayecto($idtrayecto);
                    $flete->setCaIdconcepto($idconcepto);                               
                    $flete->setCaVlrneto(0);
                    $flete->setCaIdequipo(null);
                }
                
                

                $flete->setCaVlrneto($valor);
                $flete->setCaFchinicio($fecha1);                            
                $flete->setCaFchvencimiento($fecha2);                            
                $flete->setCaIdmoneda("USD");
                
                
                $dato="";
                if(isset($sugerida[$idconcepto])!="")
                {
                    if($sugerida[$idconcepto]!="")
                    {                        
                        eval("\$dato= \$valor".$sugerida[$idconcepto].";");
                        //echo $valor." ::".$sugerida[$idconcepto]."::".$dato. " **********";
                        $flete->setCaVlrsugerido($dato);
                    }
                }                
                
                if($aplicacion!="")
                {
                    $flete->setCaAplicacion($aplicacion[$idconcepto]);
                }
                

                $user = $this->getUser();
                $flete->setCaUsucreado($user->getUserId());
                $flete->setCaFchcreado(date("Y-m-d H:i:s"));
                $flete->save(  );
                $resultado.= "<p>Tarifa de Fletes Actualizada para ".$idconcepto." = ".$valor."</p>";
                
                //----------------FLETES---------------------------
                
                
                //----------------RECARGOS---------------------------
                
                
                if($delrecxconcepto=="on")
                {
                    $pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                    ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                    ->addWhere("ca_idconcepto = ?", $idconcepto)                        
                    ->addWhere("ca_idequipo IS NULL")
                    ->delete()
                    ->execute();
                }
                
                foreach($recargos["concepto"] as $idrecargo=>$r)
                {
                    $pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                        ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                        ->addWhere("ca_idconcepto = ?", $idconcepto)
                        ->addWhere("ca_idrecargo = ?", $idrecargo)
                        ->addWhere("ca_idequipo IS NULL")
                        ->fetchOne();
                    
                   // echo "idtrayecto: $idtrayecto,  concepto: $it, recargo:$idrecargo,  valor:".$pricRecargo->getCaVlrrecargo().",  valor2: ".$r[$k+1]."<br>";
                    if (!$pricRecargo) {
                        $pricRecargo = new PricRecargoxConcepto();
                        $pricRecargo->setCaIdtrayecto($idtrayecto);
                        $pricRecargo->setCaIdconcepto($idconcepto);
                        $pricRecargo->setCaIdrecargo($idrecargo);
                        $pricRecargo->setCaIdmoneda("USD");
                        $pricRecargo->setCaAplicacion("x Contenedor");
                    }
                    
                    $pricRecargo->setCaFchinicio($fecha1);
                    $pricRecargo->setCaFchvencimiento($fecha2);
                    $pricRecargo->setCaVlrrecargo($r[$idconcepto]);
                    $pricRecargo->save();
                    
                    $resultado.= "<p>Recargo de Concepto Actualizada para ".$titulos[$k]." = ".$r[$k+1]."</p>";
                }
                                
                //----------------RECARGOS---------------------------

            }
            
            //------------------------------RECARGOS GENERALES DE TRAYECTO----------------------------
            
            
            if($delrecxgeneral=="on")
            {
                $pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                ->addWhere("ca_idconcepto = ?", 9999)                
                ->addWhere("ca_idequipo IS NULL")                        
                ->delete()
                ->execute();
                
            }
            
            foreach($recargos["general"] as $r)
            {
                //echo "<pre>";print_r($r);echo "</pre>";
                $idrecargo=$r[0];
                
                $enable=0;
                if(strtoupper($r[5])==strtoupper("todos"))
                {
                    $enable=1;
                }else if(count($r[5])>0)
                {
                    if($impoexpo==Constantes::EXPO)
                    {                        
                        if($r[9]=="-")
                        {
                            if(in_array($idciudad2,$r[5]))
                            {
                       //         echo "6346EXCLUIDOS C $idciudad2 encontrada pero no incluido recargo$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;";
                                $enable=0;
                            }
                            else
                            {
                     //           echo "6352EXCLUIDOS C$idciudad2 NO encontrada se incluye el recargo$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;";
                                $enable=1;
                            }
                        }
                        else {
                            if(in_array($idciudad2,$r[5]))
                            {                                
                        //        echo "6359INCLUIDOS C$idciudad2 NO encontrada se incluye el recargo$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;";
                                $enable=1;                                
                            }else
                            {
                        //        echo "6363INCLUIDOS C$idciudad2 encontrada pero no incluido recargo$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;$nbsp;";
                                $enable=0;
                            }
                        }
                        /*print_r($r[5]);
                        echo "::".$idciudad2.":::";
                        if(in_array($idciudad2,$r[5]))
                        {
                            echo "ciudad encontrado:::";
                            if($r[9]=="-")
                                $enable=0;
                            else
                                $enable=1;
                            echo "::enable=$enable";
                        }
                        else
                        {
                            if($r[9]=="-")
                                $enable=1;
                            else
                                $enable=0;
                            
                            echo "CIUDAD NO ENCONTRADO:::";
                        }*/
                    }
                    else
                    {
                        
                        if(in_array($idciudad,$r[5]))
                        {
                            echo "Regcargo encontrado ''''{$r[9]}'''':::";
                            if($r[9]=="-")
                                $enable=0;
                            else
                                $enable=1;
                            echo "::enable=$enable";
                        }                            
                    }
                    //echo "<p>enable1:$enable &nbsp;'{$r[9]}'::::::<br></p>";
                    /*if($r[9]=="-")
                    {
                        if($enable)
                            $enable=0;
                        else
                            $enable=1;
                    }*/
                }
                
                //echo "<p>enable2:$enable:::::::::::<br></p>";
                
                if($enable==1)
                {
                    
                    
                    
                    $pricRecargo = Doctrine::getTable("PricRecargoxConcepto")->createQuery()
                        ->addWhere("ca_idtrayecto = ?", $idtrayecto)
                        ->addWhere("ca_idconcepto = ?", 9999)
                        ->addWhere("ca_idrecargo = ?", $idrecargo)
                        ->addWhere("ca_idequipo IS NULL")
                        ->fetchOne();

                   // echo "idtrayecto: $idtrayecto,  concepto: $it, recargo:$idrecargo,  valor:".$pricRecargo->getCaVlrrecargo().",  valor2: ".$r[$k+1]."<br>";
                    if (!$pricRecargo) {
                        $pricRecargo = new PricRecargoxConcepto();
                        $pricRecargo->setCaIdtrayecto($idtrayecto);
                        $pricRecargo->setCaIdconcepto(9999);
                        $pricRecargo->setCaIdrecargo($idrecargo);
                        $pricRecargo->setCaIdmoneda("USD");                        
                    }

                    $pricRecargo->setCaFchinicio($r[7]);
                    $pricRecargo->setCaFchvencimiento($r[8]);
                    $pricRecargo->setCaVlrrecargo($r[3]);
                    $pricRecargo->setCaAplicacion(utf8_decode($r[2]));
                    $pricRecargo->setCaObservaciones($r[6]);
                    $pricRecargo->setCaVlrminimo($r[4]);
                    $pricRecargo->save();

                    $resultado.= "<p>Recargo general Actualizada para ".$r[1]." = ".$r[3]."</p>";
                }
            }
            
            
            // ---------------------------RECARGOS X LINEA-------------------------------------
            foreach($recargos["linea"] as $idrecargo=>$r)
            {
                /*if($idciudad=="KOS-0034")
                {
                    echo $idrecargo. " = ".$r;
                    //print_r($r);                        
                }*/
                
                $pricLinea = Doctrine::getTable("PricRecargoxLinea")->createQuery()
                    ->addWhere("ca_idlinea = ?", $idlinea)
                    ->addWhere("ca_idconcepto = ?", "9999")
                    ->addWhere("ca_idrecargo = ?", $idrecargo)
                    ->addWhere("ca_idtrafico = ? ", $idtrafico)
                    ->addWhere("ca_modalidad = ? ", $modalidad)
                    ->fetchOne();

               // echo "idtrayecto: $idtrayecto,  concepto: $it, recargo:$idrecargo,  valor:".$pricRecargo->getCaVlrrecargo().",  valor2: ".$r[$k+1]."<br>";
                if (!$pricLinea) {
                    $pricLinea = new PricRecargoxLinea();
                    $pricLinea->setCaIdLinea($idlinea);
                    $pricLinea->setCaIdconcepto("9999");
                    $pricLinea->setCaIdrecargo($idrecargo);
                    $pricLinea->setCaIdtrafico($idtrafico);
                    $pricLinea->setCaIdmoneda("USD");                    
                    $pricLinea->setCaAplicacion("x Contenedor");
                    $pricLinea->setCaModalidad($modalidad);

                }

                $pricLinea->setCaFchinicio($fecha1);
                $pricLinea->setCaFchvencimiento($fecha2);
                $pricLinea->setCaVlrrecargo($r);
                $pricLinea->save();

                $resultado.= "<p>Recargo de Linea Actualizado para ".$idrecargo." = ".$r . " Fe: ".$fecha1. "-".$fecha2."  Pais:  ".$idtrafico."  </p>";
            }
        }
        return $resultado;
    }
    
    
    
    
    public function executeImprFacturasList(sfWebRequest $request) {    
        
        $facturas=array('301478',	'301484',	'301490',	'301507',	'301514',	'301517',	'301520',	'301524',	'301546',	'301527',	'301535',	'301597',	'301812',	'301836',	'302076',	'301922',	'301915',	'302154',	'302169',	'302165',	'302372',	'302549',	'302611',	'302655',	'302649',	'302648',	'302851',	'302495',	'302994',	'303041',	'302953',	'303101',	'303010',	'302941',	'303136',	'303034',	'303150',	'303190',	'303153',	'302961',	'303143',	'302951',	'303089',	'303203',	'302906',	'303279',	'303354',	'303357',	'303361',	'303358',	'303363',	'303359',	'303364',	'303366',	'303406',	'303411',	'303427',	'303464',	'303465',	'303466',	'303468',	'303469',	'303581',	'303527',	'303566',	'303636',	'303594',	'303578',	'303742',	'303791',	'303799',	'303620',	'303824',	'303844',	'303843',	'303846',	'303814',	'303869',	'303769',	'303874',	'303881',	'303886',	'303887',	'303840',	'303893',	'303894',	'303816',	'303822',	'303200',	'303933',	'303827',	'303945',	'303952',	'302641',	'304013',	'304063',	'304093',	'304095',	'304019',	'304110',	'303997',	'304135',	'304088',	'303330',	'304214',	'304229',	'304261',	'304265',	'304276',	'304319',	'304327',	'304335',	'304333',	'304337',	'304339',	'303848',	'304345',	'304346',	'304347',	'304274',	'304376',	'301407',	'304467',	'304492',	'304497',	'304509',	'304546',	'304526',	'304554',	'302437',	'304581',	'304587',	'304603',	'304631',	'302189',	'304697',	'304596',	'304545',	'304757',	'304672',	'304789',	'304807',	'305007',	'305006',	'305053',	'305054',	'303823',	'304016',	'304017',	'304023',	'304038',	'304052',	'305101',	'305134',	'304997',	'305173',	'305180',	'304963',	'304541',	'305125',	'304577',	'304555',	'304504',	'305143',	'304120',	'304123',	'304272',	'305267',	'304282',	'304308',	'304507',	'305284',	'304331',	'305291',	'304334',	'304338',	'305186',	'305197',	'304661',	'304719',	'304729',	'304738',	'305324',	'304503',	'305038',	'305123',	'305357',	'305372',	'305361',	'305217',	'305237',	'305298',	'305149',	'305250',	'305301',	'305379',	'305332',	'305355',	'305409',	'305403',	'305440',	'305382',	'304281',	'305473',	'305317',	'305533',	'305393',	'305402',	'302244',	'305460',	'305541',	'305501',	'305535',	'305639',	'305549',	'305498',	'305584',	'305486',	'305565',	'305752',	'305692',	'305698',	'300854',	'305569',	'305835',	'305860',	'305910',	'305606',	'305632',	'305983',	'305672',	'305995',	'306045',	'305773',	'305779',	'305864',	'306118',	'306128',	'306130',	'306131',	'305878',	'306132',	'306137',	'306140',	'306141',	'306142',	'306144',	'306145',	'306129',	'306151',	'306148',	'306136',	'306149',	'306154',	'306155',	'306067',	'306198',	'306108',	'306201',	'306204',	'305896',	'306216',	'306171',	'306231',	'306115',	'304176',	'306104',	'306292',	'305842',	'306056',	'306390',	'306147',	'306152',	'306119',	'306122',	'305855',	'305856',	'306484',	'306523',	'306501',	'306488',	'306493',	'306499',	'306520',	'306521',	'306502',	'306516',	'306525',	'306528',	'306532',	'306533',	'306542',	'306591',	'306538',	'306623',	'306605',	'306625',	'306581',	'306629',	'306460',	'306453',	'306632',	'302636',	'306648',	'306647',	'306167',	'306716',	'306239',	'306279',	'306278',	'306628',	'306830',	'306717',	'306926',	'306813',	'306720',	'306928',	'306848',	'306908',	'306904',	'306650',	'306972',	'306834',	'306721',	'307013',	'306957',	'307027',	'307030',	'306886',	'306935',	'306915',	'306156',	'306212',	'307087',	'307153',	'307217',	'307239',	'307097',	'307055',	'307064',	'307229',	'307278',	'306783',	'307280',	'306833',	'307290',	'307241',	'307296',	'307308',	'307304',	'307303',	'307277',	'307234',	'307226',	'307276',	'307356',	'307252',	'307361',	'307354',	'307385',	'307343',	'307194',	'307449',	'307450',	'307505',	'307506',	'307507',	'307508',	'307509',	'307510',	'307512',	'307513',	'307514',	'307515',	'307516',	'307517',	'307518',	'307519',	'307520',	'307570',	'307281',	'307597',	'307602',	'307606',	'307610',	'307613',	'307617',	'307622',	'307626',	'307632',	'307639',	'307648',	'307603',	'307654',	'307734',	'307677',	'307767',	'307794',	'307834',	'307748',	'307848',	'307803',	'307892',	'307883',	'307891',	'307902',	'307754',	'307895',	'307624',	'307893',	'308103',	'308078',	'308174',	'307909',	'307908',	'308062',	'308099',	'308102',	'308128',	'308251',	'308272',	'308025',	'308118',	'308359',	'308343',	'308225',	'308500',	'308661',	'308441',	'308446',	'308541',	'308449',	'308452',	'308675',	'308678',	'308546',	'308806',	'308852',	'308804',	'308840',	'308834',	'307633',	'308649',	'308480',	'308784',	'308950',	'308947',	'309004',	'309223',	'309231',	'309139',	'309144',	'309148',	'309151',	'309251',	'309297',	'309188',	'309301',	'309191',	'309311',	'309229',	'309210',	'309211',	'309302',	'309241',	'309340',	'309368',	'309376',	'309378',	'309383',	'309372',	'309461',	'309217',	'309233',	'309665',	'309568',	'307752',	'309713',	'309729',	'309809',	'309643',	'309660',	'309669',	'309696',	'309855',	'309532',	'309492',	'309667',	'309763',	'309795',	'309915',	'309926',	'309920',	'309967',	'310028',	'309941',	'309984',	'309996',	'310034',	'310097',	'310096',	'309708',	'310019',	'310075',	'310104',	'310177',	'306587',	'310186',	'310187',	'310267',	'310273',	'310295',	'310117',	'310316',	'310215',	'310424',	'310427',	'310380',	'310417',	'310511',	'310184',	'310169',	'310600',	'310330',	'310585',	'310676',	'310706',	'310708',	'310709',	'310710',	'310711',	'310352',	'310736',	'310721',	'310741',	'310777',	'310801',	'310856',	'310901',	'310909',	'310930',	'310719',	'311057',	'310987',	'311046',	'310993',	'311043',	'311005',	'311020',	'311044',	'310804',	'311112',	'311219',	'311283',	'311236',	'311284',	'311288',	'311291',	'309209',	'311323',	'311273',	'311349',	'311352',	'311415',	'311319',	'311431',	'311424',	'311440',	'311444',	'311241',	'311435',	'311456',	'311496',	'311497',	'311042',	'311362',	'311832',	'311925',	'311816',	'311937',	'311899',	'312021',	'312011',	'312019',	'312104',	'312001',	'311989',	'311994',	'312060',	'306863',	'312179',	'312180',	'312195',	'312197',	'312233',	'312238',	'312240',	'312242',	'312243',	'312244',	'312247',	'312355',	'312360',	'312402',	'312430',	'312437',	'312281',	'312404',	'312471',	'312472',	'312474',	'312516',	'312540',	'312543',	'312544',	'312357',	'312604',	'312747',	'312748',	'312750',	'312758',	'312692',	'312915',	'312918',	'312891',	'313100',	'313127',	'313129',	'313132',	'313179',	'313184',	'313209',	'313280',	'313321',	'310737',	'310950',	'311492',	'311908',	'312190',	'312459',	'312682',	'312782',	'312796',	'312830',	'312852',	'312929',	'313009',	'313254',	'313323',	'312724',	'312438',	'311262',	'313484',	'313486',	'313487',	'313488',	'313490',	'313491',	'313493',	'313495',	'313497',	'313658',	'313665',	'313684',	'313687',	'313697',	'313705',	'313712',	'313719',	'313732',	'313742',	'312130',	'313747',	'311370',	'313761',	'313768',	'313777',	'313770',	'313654',	'313642',	'313228',	'312643',	'313839',	'313661',	'313640',	'313625',	'313621',	'313593',	'313844',	'313752',	'313865',	'313731',	'313864',	'313870',	'313877',	'313909',	'313907',	'313916',	'313896',	'313804',	'313807',	'313808',	'313905',	'313892',	'313613',	'313675',	'313763',	'313677',	'313685',	'313691',	'313698',	'313782',	'313875',	'313781',	'313764',	'313822',	'313787',	'313769',	'313806',	'314039',	'314042',	'314043',	'313498',	'313835',	'312545',	'313874',	'313873',	'313878',	'313880',	'313866',	'313888',	'313894',	'313969',	'313974',	'313947',	'313939',	'313942',	'314094',	'314057',	'314056',	'314110',	'314146',	'314236',	'314286',	'314116',	'314216',	'314297',	'314335',	'314341',	'314139',	'314255',	'314352',	'314268',	'314164',	'314169',	'314240',	'314241',	'314245',	'314125',	'310588',	'314425',	'314046',	'314049',	'314308',	'314497',	'314500',	'314546',	'314578',	'314630',	'314655',	'314670',	'314695',	'314657',	'314711',	'314394',	'314384',	'314763',	'314773',	'314799',	'314803',	'314808',	'314813',	'314837',	'314846',	'314801',	'314856',	'314862',	'314867',	'314872',	'314873',	'314882',	'314887',	'314888',	'314892',	'314902',	'314798',	'314961',	'314972',	'314978',	'314984',	'314971',	'315004',	'315007',	'315013',	'314982',	'314991',	'315012',	'314990',	'315085',	'315092',	'315112',	'315113',	'315132',	'315154',	'315155',	'315164',	'314849',	'315212',	'315273',	'315330',	'315342',	'315344',	'314740',	'314816',	'315407',	'315258',	'315394',	'314824',	'315440',	'315368',	'315371',	'315373',	'315134',	'315446',	'315454',	'315424',	'315413',	'315402',	'315377',	'315471',	'315338',	'315380',	'315355',	'315510',	'315521',	'315522',	'314035',	'315765',	'315786',	'315783',	'315769',	'315840',	'315453',	'315738',	'315854',	'315850',	'315860',	'315794',	'315862',	'315863',	'315693',	'315864',	'315878',	'315923',	'315928',	'315931',	'315924',	'315779',	'316058',	'316098',	'316106',	'316112',	'315815',	'316024',	'316059',	'314508',	'316027',	'316175',	'316195',	'316236',	'316078',	'315949',	'315944',	'315977',	'315519',	'315520',	'316140',	'316141',	'316353',	'316154',	'316165',	'316171',	'316178',	'316218',	'316435',	'315772',	'316229',	'316557',	'316561',	'316559',	'316575',	'316572',	'316512',	'316506',	'316616',	'316628',	'316571',	'316646',	'316578',	'316320',	'316943',	'316411',	'316753',	'316780',	'316790',	'316987',	'317017',	'316890',	'316883',	'317096',	'317097',	'317098',	'317103',	'317157',	'317163',	'317139',	'317215',	'317144',	'317150',	'317261',	'317296',	'317298',	'317302',	'317300',	'317290',	'317314',	'317317',	'317332',	'317339',	'317343',	'317301',	'317291',	'317299',	'317398',	'317532',	'317602',	'317535',	'317624',	'317638',	'317644',	'317650',	'317653',	'317660',	'317665',	'317669',	'317694',	'317704',	'317705',	'317706',	'317708',	'317709',	'317711',	'317712',	'317715',	'317717',	'317718',	'317719',	'317721',	'317726',	'317730',	'317732',	'317735',	'317736',	'317737',	'317741',	'317742',	'317744',	'317725',	'317274',	'317779',	'317282',	'317723',	'317807',	'317767',	'317615',	'317752',	'317869',	'317870',	'317872',	'317936',	'317961',	'317968',	'317972',	'317998',	'317995',	'318059',	'318186',	'318229',
            '317996',	'317980',	'318194',	'318012',	'317898',	'316193',	'318011',	'318223',	'318211',	'318048',	'318033',	'318296',	'318297',	'317979',	'318311',	'318464',	'318465',	'318499',	'318498',	'318509',	'318518',	'318611',	'318613',	'318614',	'318627',	'318654',	'318248',	'318243',	'318475',	'318538',	'318486',	'318537',	'318532',	'318533',	'318470',	'318630',	'318675',	'318664',	'317695',	'317698',	'318641',	'318594',	'318517',	'318601',	'318755',	'318671',	'318669',	'318505',	'318323',	'318853',	'318891',	'318975',	'318984',	'319029',	'318903',	'319018',	'319030',	'319024',	'319075',	'319207',	'319215',	'319236',	'319237',	'319240',	'319242',	'319244',	'319107',	'319246',	'319225',	'319250',	'319177',	'319134',	'318749',	'319180',	'319249',	'316672',	'319185',	'318989',	'319214',	'319314',	'319252',	'319253',	'319670',	'319702',	'319707',	'319723',	'319757',	'319755',	'319764',	'319765',	'319767',	'319773',	'319780',	'319869',	'319891',	'319895',	'319889',	'319893',	'319904',	'319787',	'319911',	'319951',	'319834',	'319864',	'320035',	'320036',	'320089',	'320127',	'319739',	'320238',	'320248',	'320254',	'320253',	'320310',	'320316',	'320318',	'320181',	'320383',	'320183',	'320471',	'320473',	'320479',	'320526',	'320563',	'320537',	'320549',	'320676',	'320784',	'318670',	'320695',	'320731',	'314101',	'320927',	'320955',	'320966',	'320967',	'320889',	'320973',	'320976',	'320977',	'318756',	'318758',	'320979',	'321033',	'321097',	'321123',	'321060',	'321149',	'321029',	'320984',	'319808',	'321167',	'321200',	'321207',	'320039',	'320208',	'320228',	'321243',	'320522',	'320528',	'321248',	'320533',	'320541',	'321253',	'320550',	'320597',	'321250',	'320789',	'320808',	'320986',	'321067',	'321069',	'321076',	'321078',	'321054',	'321075',	'321086',	'321087',	'321242',	'321061',	'321089',	'321144',	'321168',	'321318',	'321154',	'321160',	'321333',	'321334',	'321335',	'320303',	'321454',	'321458',	'321455',	'321463',	'321466',	'321467',	'321471',	'321470',	'321473',	'321431',	'314333',	'321448',	'321503',	'321509',	'321515',	'321519',	'321173',	'321524',	'321526',	'321527',	'321540',	'321561',	'321563',	'321567',	'321572',	'321576',	'321579',	'321582',	'321387',	'321541',	'321568',	'321627',	'321649',	'321753',	'321794',	'321456',	'321823',	'321829',	'321836',	'321849',	'321593',	'321614',	'321629',	'321873',	'321581',	'321935',	'321961',	'321965',	'321957',	'321587',	'321964',	'321977',	'322028',	'322052',	'322067',	'322155',	'322237',	'322274',	'322284',	'322314',	'322353',	'322374',	'322375',	'322311',	'322305',	'321989',	'321990',	'322079',	'322584',	'322622',	'322621',	'322664',	'322580',	'322652',	'322644',	'322677',	'322709',	'322749',	'322750',	'322792',	'322905',	'322933',	'322967',	'322809',	'322810',	'322978',	'322812',	'322817',	'322821',	'322823',	'322816',	'322815',	'322948',	'322950',	'322951',	'322966',	'323073',	'322654',	'323134',	'323146',	'323150',	'323167',	'323182',	'323107',	'323163',	'323061',	'323187',	'323189',	'323196',	'323198',	'323200',	'323205',	'323207',	'323341',	'323347',	'323361',	'323363',	'323358',	'323385',	'323392',	'323397',	'323393',	'323408',	'323414',	'323382',	'323383',	'323248',	'323520',	'323581',	'323666',	'323690',	'323764',	'323256',	'323320',	'323434',	'323494',	'323585',	'323705',	'323784',	'322307',	'323719',	'323785',	'323863',	'323844',	'323900',	'323902',	'323926',	'323965',	'323968',	'323972',	'323978',	'324043',	'323672',	'324075',	'323964',	'324076',	'324078',	'324103',	'324109',	'324110',	'324037',	'323969',	'323967',	'323922',	'323927',	'323931',	'323932',	'323934',	'323952',	'324161',	'324203',	'324142',	'324166',	'324209',	'324244',	'324263',	'324174',	'324068',	'323030',	'324341',	'324447',	'324416',	'324432',	'324392',	'324493',	'324497',	'324420',	'324569',	'324573',	'324574',	'324577',	'324576',	'324539',	'324527',	'323880',	'324737',	'324743',	'324747',	'324754',	'324764',	'324774',	'324824',	'324849',	'324853',	'324876',	'324897',	'324768',	'324953',	'324971',	'321504',	'324962',	'325013',	'324941',	'324986',	'325034',	'324998',	'325000',	'325096',	'325091',	'325093',	'325177',	'325191',	'325060',	'324373',	'325275',	'325294',	'325297',	'325326',	'325024',	'325014',	'325078',	'325080',	'325012',	'325381',	'325375',	'325400',	'325325',	'325446',	'325372',	'325458',	'325462',	'325639',	'325687',	'325457',	'325702',	'325701',	'325706',	'325512',	'325403',	'325731',	'325736',	'325707',	'315717',	'325714',	'325724',	'325708',	'325725',	'325703',	'325679',	'325682',	'325692',	'325699',	'325796',	'325799',	'325800',	'325801',	'325827',	'325755',	'325698',	'325908',	'325914',	'325917',	'325888',	'325889',	'325893',	'325892',	'325881',	'326046',	'325986',	'326069',	'326078',	'326079',	'326066',	'326141',	'326142',	'326163',	'326165',	'326167',	'326305',	'326063',	'326342',	'326348',	'326386',	'326397',	'326401',	'326390',	'326429',	'326440',	'326458',	'326080',	'326500',	'326322',	'326433',	'326501',	'326513',	'326491',	'326480',	'326525',	'326359',	'326561',	'326516',	'326508',	'321608',	'326617',	'326624',	'326687',	'326697',	'326616',	'326712',	'326720',	'326729',	'326793',	'326787',	'326640',	'326829',	'326830',	'326735',	'314831',	'326845',	'326849',	'326859',	'326826',	'326890',	'326922',	'326923',	'326926',	'326929',	'326843',	'326833',	'326976',	'327029',	'327261',	'327264',	'327269',	'327291',	'327284',	'327306',	'327355',	'327389',	'327437',	'327479',	'327492',	'327514',	'327313',	'327513',	'327606',	'327711',	'327733',	'327752',	'327756',	'328032',	'328092',	'328099',	'328130',	'328138',	'328157',	'328158',	'328163',	'328164',	'328165',	'328200',	'328202',	'328273',	'328206',	'328358',	'327186',	'328282',	'328526',	'328532',	'328538',	'328481',	'328211',	'328258',	'328141',	'328621',	'327789',	'328618',	'328626',	'328628',	'328627',	'328490',	'328498',	'328556',	'328486',	'328591',	'328613',	'328800',	'328802',	'328804',	'328806',	'328808',	'328821',	'328830',	'328833',	'328835',	'328842',	'328845',	'328856',	'328966',	'328981',	'329025',	'329038',	'329007',	'325085',	'328945',	'329044',	'329081',	'329100',	'329096',	'329008',	'329132',	'329002',	'329030',	'328838',	'329138',	'327382',	'329140',	'329143',	'329121',	'329112',	'329150',	'329107',	'329153',	'329012',	'329156',	'329162',	'328973',	'328946',	'328968',	'328969',	'328971',	'328972',	'328975',	'329222',	'329239',	'329251',	'328738',	'329064',	'329283',	'329117',	'329282',	'329141',	'329316',	'329409',	'329161',	'329412',	'327156',	'329381',	'329399',	'329401',	'329489',	'329471',	'329466',	'329467',	'329540',	'329639',	'329504',	'329292',	'329814',	'329886',	'329890',	'329865',	'329427',	'329958',	'330029',	'330052',	'330066',	'330071',	'330075',	'330081',	'329923',	'330119',	'330140',	'330168',	'330208',	'330196',	'330225',	'330282',	'330335',	'329810',	'330362',	'330319',	'330231',	'330406',	'330462',	'330325',	'330470',	'330471',	'330446',	'330452',	'330466',	'330355',	'330410',	'330680',	'330712',	'330702',	'330736',	'330748',	'330616',	'330693',	'330726',	'330646',	'330723',	'330735',	'330357',	'330829',	'330812',	'330713',	'330863',	'330823',	'330762',	'330879',	'330899',	'330923',	'330976',	'331006',	'331007',	'331060',	'331136',	'331145',	'331150',	'331103',	'331126',	'331185',	'331187',	'331189',	'331062',	'331063',	'331061',	'331065',	'331125',	'331127',	'331130',	'331396',	'331079',	'331082',	'331412',	'330874',	'331435',	'331436',	'331439',	'331495',	'331115',	'331313',	'331327',	'331692',	'331713',	'331734',	'331781',	'331817',	'331527',	'331821',	'331826',	'331822',	'331824',	'331825',	'331847',	'331807',	'331887',	'331894',	'331823',	'331857',	'331989',	'331858',	'331895',	'332043',	'332044',	'332104',	'332089',	'331984',	'331938',	'331981',	'332175',	'332222',	'332254',	'332350',	'332381',	'332234',	'332243',	'332339',	'332439',	'332531',	'332547',	'332548',	'332563',	'332628',	'332627',	'332655',	'332658',	'332685',	'332709',	'332710',	'332750',	'332569',	'332654',	'332790',	'332794',	'332877',	'332474',	'332822',	'332926',	'332933',	'332932',	'332979',	'332987',	'332868',	'332871',	'332849',	'332865',	'333005',	'333046',	'333045',	'333056',	'332828',	'333061',	'333064',	'333033',	'333081',	'333042',	'333083',	'333088',	'332881',	'332879',	'332880',	'332954',	'333118',	'333119',	'333120',	'333122',	'333101',	'333124',	'333129',	'333134',	'332907',	'333188',	'333209',	'333184',	'333239',	'333248',	'333265',	'333262',	'333272',	'333274',	'333281',	'333283',	'333288',	'333291',	'333243',	'333329',	'333226',	'333357',	'333365',	'333401',	'333430',	'333433',	'333436',	'333440',	'333441',	'333443',	'333444',	'333448',	'333677',	'333679',	'333684',	'333346',	'333453',	'333452',	'333711',	'333730',	'333790',	'333817',	'333823',	'333735',	'333836',	'333851',	'333685',	'333422',	'333734',	'333731',	'333923',	'333924',	'333931',	'333935',	'333936',	'333937',	'333940',	'334052',	'334060',	'334061',	'334064',	'334069',	'334098',	'334112',	'334123',	'334119',	'334155',	'334159',	'334113',	'334104',	'334044',	'334038',	'334022',	'334255',	'334242',	'334189',	'334589',	'334662',	'334552',	'334556',	'334656',	'334666',	'334629',	'334612',	'334551',	'334691',	'334694',	'334206',	'334399',	'334782',	'334660',	'334667',	'334682',	'334685',	'334544',	'334684',	'334808',	'334978',	'334919',	'334913',	'335016',	'334830',	'334837',	'334988',	'335021',	'335024',	'335090',	'334950',	'335112',	'335272',	'335275',	'335277',	'335287',	'334827',	'335354',	'335398',	'335426',	'335438',	'335441',	'335414',	'335484',	'335636',	'335635',	'335633',	'335678',	'335694',	'335689',	'335706',	'335730',	'335739',	'335807',	'335835',	'335528',	'335871',	'335833',	'335587',	'335507',	'335849',	'335909',	'335852',	'335882',	'335843',	'335837',	'335733',	'336020',	'336049',	'336111',	'336154',	'336187',	'336192',	'336197',	'336237',	'336259',	'336274',	'336172',	'336285',	'336301',	'336210',	'336444',	'336476',	'336484',	'336487',	'336504',	'336523',	'336336',
            '336586',	'336209',	'336282',	'336676',	'336776',	'336804',	'336812',	'336837',	'336839',	'336905',	'336898',	'336886',	'336942',	'336943',	'337060',	'337061',	'337070',	'337076',	'337078',	'337108',	'333896',	'336057',	'337246',	'336510',	'336799',	'336817',	'337265',	'337391',	'335632',	'337198',	'337268',	'337316',	'337267',	'337290',	'336953',	'337291',	'337307',	'336951',	'336841',	'337226',	'337481',	'337326',	'336761',	'336940',	'336938',	'337301',	'337528',	'337419',	'337420',	'337546',	'336949',	'337081',	'337585',	'337637',	'337639',	'337642',	'337643',	'337644',	'337648',	'337647',	'337717',	'337726',	'337766',	'337781',	'337792',	'337814',	'337912',	'335977',	'335978',	'337894',	'337893',	'337827',	'337850',	'337452',	'337835',	'337840',	'337842',	'337973',	'337994',	'337992',	'337696',	'337740',	'338016',	'337951',	'338282',	'337808',	'337956',	'337950',	'338345',	'338377',	'338256',	'338498',	'338509',	'338532',	'338545',	'338541',	'338557',	'338583',	'338590',	'338038',	'338602',	'338523',	'338700',	'338624',	'338703',	'338619',	'338681',	'338597',	'338714',	'338753',	'338644',	'338663',	'338793',	'338745',	'338740',	'338647',	'338649',	'338650',	'338723',	'338847',	'338738',	'338848',	'338930',	'338252',	'338999',	'339028',	'338940',	'339099',	'339116',	'339133',	'339138',	'339153',	'339222',	'339242',	'339255',	'339302',	'339273',	'339274',	'339348',	'339293',	'339347',	'338794',	'339265',	'339259',	'338756',	'338792',	'338949',	'339186',	'339202',	'338988',	'339316',	'339388',	'339389',	'339390',	'339396',	'339411',	'339413',	'339419',	'339425',	'339441',	'339386',	'339455',	'339475',	'339244',	'338280',	'339542',	'339642',	'339500',	'339601',	'339602',	'339603',	'339604',	'339582',	'339490',	'339611',	'339492',	'339612',	'339614',	'339678',	'339659',	'339713',	'339501',	'339800',	'339824',	'339842',	'339857',	'339870',	'339876',	'339973',	'339976',	'339978',	'339986',	'339995',	'339997',	'340004',	'340019',	'340020',	'340035',	'340037',	'340046',	'339596',	'339993',	'340003',	'340051',	'339658',	'339923',	'336586',	'336209',	'336282',	'336676',	'336776',	'336804',	'336812',	'336837',	'336839',	'336905',	'336898',	'336886',	'336942',	'336943',	'337060',	'337061',	'337070',	'337076',	'337078',	'337108',	'333896',	'336057',	'337246',	'336510',	'336799',	'336817',	'337265',	'337391',	'335632',	'337198',	'337268',	'337316',	'337267',	'337290',	'336953',	'337291',	'337307',	'336951',	'336841',	'337226',	'337481',	'337326',	'336761',	'336940',	'336938',	'337301',	'337528',	'337419',	'337420',	'337546',	'336949',	'337081',	'337585',	'337637',	'337639',	'337642',	'337643',	'337644',	'337648',	'337647',	'337717',	'337726',	'337766',	'337781',	'337792',	'337814',	'337912',	'335977',	'335978',	'337894',	'337893',	'337827',	'337850',	'337452',	'337835',	'337840',	'337842',	'337973',	'337994',	'337992',	'337696',	'337740',	'338016',	'337951',	'338282',	'337808',	'337956',	'337950',	'338345',	'338377',	'338256',	'338498',	'338509',	'338532',	'338545',	'338541',	'338557',	'338583',	'338590',	'338038',	'338602',	'338523',	'338700',	'338624',	'338703',	'338619',	'338681',	'338597',	'338714',	'338753',	'338644',	'338663',	'338793',	'338745',	'338740',	'338647',	'338649',	'338650',	'338723',	'338847',	'338738',	'338848',	'338930',	'338252',	'338999',	'339028',	'338940',	'339099',	'339116',	'339133',	'339138',	'339153',	'339222',	'339242',	'339255',	'339302',	'339273',	'339274',	'339348',	'339293',	'339347',	'338794',	'339265',	'339259',	'338756',	'338792',	'338949',	'339186',	'339202',	'338988',	'339316',	'339388',	'339389',	'339390',	'339396',	'339411',	'339413',	'339419',	'339425',	'339441',	'339386',	'339455',	'339475',	'339244',	'338280',	'339542',	'339642',	'339500',	'339601',	'339602',	'339603',	'339604',	'339582',	'339490',	'339611',	'339492',	'339612',	'339614',	'339678',	'339659',	'339713',	'339501',	'339800',	'339824',	'339842',	'339857',	'339870',	'339876',	'339973',	'339976',	'339978',	'339986',	'339995',	'339997',	'340004',	'340019',	'340020',	'340035',	'340037',	'340046',	'339596',	'339993',	'340003',	'340051',	'339658',	'339923',
            '339924',	'340075',	'340076',	'340043',	'340091',	'340102',	'340105',	'340107',	'340096',	'339905',	'339918',	'340145',	'340161',	'340162',	'340200',	'340238',	'340258',	'340287',	'340322',	'340331',	'340337',	'340349',	'340204',	'340223',	'340199',	'340304',	'340305',	'340454',	'340449',	'340393',	'340267',	'340381',	'340503',	'340374',	'340117',	'340482',	'338906',	'340386',	'340573',	'340594',	'339513',	'340667',	'340561',	'340723',	'340751',	'340753',	'340392',	'340830',	'340832',	'340834',	'340696',	'340821',	'340819',	'340740',	'340818',	'340840',	'340823',	'338251',	'339508',	'340888',	'340890',	'340917',	'340974',	'340975',	'340976',	'340977',	'341005',	'341045',	'341057',	'341081',	'341086',	'341121',	'341199',	'341204',	'341178',	'341165',	'341356',	'341283',	'341524',	'341526',	'341287',	'341289',	'341309',	'341306',	'340278',	'341700',	'341708',	'340253',	'341719',	'341740',	'341752',	'341755',	'341779',	'341785',	'341794',	'341820',	'341879',	'341893',	'341352',	'341935',	'341942',	'341951',	'341807',	'341391',	'341816',	'341748',	'341714',	'341818',	'341989',	'341908',	'341904',	'342041',	'341923',	'341924',	'341745',	'341917',	'342063',	'342064',	'342065',	'342066',	'342144',	'342178',	'342262',	'341824',	'342312',	'341878',	'341880',	'341877',	'342276',	'342365',	'342209',	'342459',	'342398',	'342477',	'342460',	'342511',	'342400',	'342401',	'342391',	'342402',	'342260',	'342320',	'342646',	'342665',	'342671',	'342680',	'342687',	'342689',	'342717',	'342767',	'342362',	'342780',	'342782',	'342515',	'342773',	'342702',	'342827',	'342808',	'342684',	'342857',	'342799',	'342788',	'342812',	'342705',	'342806',	'342809',	'342978',	'342981',	'342723',	'342736',	'343208',	'343216',	'343221',	'343087',	'343083',	'343175',	'343267',	'343312',	'343289',	'343324',	'343238',	'343483',	'343565',	'343064',	'343608',	'343619',	'343697',	'343468',	'343469',	'343788',	'343847',	'343850',	'343854',	'343865',	'343866',	'343867',	'344035',	'344042',	'344134',	'344139',	'344149',	'344154',	'344160',	'344164',	'344057',	'344122',	'344417',	'344594',	'344549',	'344419',	'344628',	'344630',	'344800',	'344489',	'344827',	'344949',	'344886',	'344273',	'344994',	'345001',	'343003',	'345015',	'344928',	'345040',	'345041',	'344946',	'344597',	'344599',	'344600',	'344844',	'344990',	'344723',	'345206',	'344591',	'344598',	'344601',	'344609',	'344699',	'344872',	'345618',	'345168',	'345830',	'345831',	'345815',	'345818',	'345835',	'344080',	'345635',	'345266',	'345646',	'346028',	'345582',	'345599',	'345588',	'345890',	'345935',	'345974',	'345984',	'345980',	'345988',	'345872',	'345900',	'345921',	'346074',	'346079',	'346081',	'346082',	'346085',	'346115',	'346122',	'345871',	'345880',	'346146',	'346154',	'346168',	'346182',	'346193',	'346194',	'346196',	'346209',	'346195',	'346216',	'346220',	'346224',	'346248',	'346250',	'346259',	'345823',	'346117',	'346296',	'346157',	'346327',	'346326',	'346411',	'346423',	'346593',	'346598',	'346441',	'346561',	'346642',	'346361',	'346479',	'346477',	'346488',	'346494',	'346660',	'346681',	'346694',	'346743',	'346446',	'345172',	'346830',	'347016',	'347059',	'347002',	'346967',	'347137',	'347182',	'347186',	'347190',	'343837',	'347300',	'347370',	'347395',	'347420',	'347434',	'347474',	'344925',	'347302',	'347367',	'347366',	'347360',	'347346',	'347527',	'347537',	'347427',	'347526',	'347530',	'347507',	'347509',	'347510',	'347534',	'347549',	'347558',	'347573',	'347565',	'347653',	'347813',	'347820',	'347824',	'347833',	'347789',	'347750',	'347850',	'348141',	'348177',	'348024',	'348034',	'348249',	'348224',	'348230',	'348229',	'348178',	'348209',	'348456',	'348529',	'348395',	'348385',	'348351',	'348478',	'348544',	'348616',	'348666',	'348703',	'348739',	'348787',	'348788',	'348613',	'348811',	'348843',	'348837',	'348840',	'348832',	'348838',	'348790',	'348829',	'348910',	'348912',	'348913',	'348917',	'348937',	'348938',	'348939',	'348945',	'348833',	'349040',	'349004',	'349183',	'349037',	'349292',	'349296',	'349035',	'349300',	'349317',	'349338',	'349341',	'349049',	'348914',	'349391',	'349392',	'349393',	'349395',	'349402',	'349479',	'349597',	'349606',	'349609',	'349358',	'349355',	'349357',	'349561',	'349524',	'349456',	'349656',	'349680',	'349714',	'349353',	'349722',	'349853',	'349854',	'349968',	'349971',	'349939',	'349921',	'349984',	'350034',	'349969',	'350035',	'350081',	'350136',	'350211',	'350084',	'350157',	'350123',	'350215',	'350216',	'350219',	'350107',	'350249',	'350253',	'350252',	'350303',	'350407',	'350422',	'350433',	'350437',	'350475',	'350427',	'350461',	'350496',	'350515',	'350466',	'350823',	'350933',	'350963',	'350966',	'350978',	'351101',	'351110',	'351112',	'351111',	'351113',	'350777',	'350778',	'350779',	'351180',	'350922',	'351227',	'351236',	'351033',	'351237',	'351280',	'351291',	'351294',	'351297',	'351317',	'351487',	'351572',	'351484',	'351560',	'351781',	'351805',	'351835',	'351857',	'351860',	'351801',	'352086',	'352097',	'352143',	'352151',	'352140',	'351956',	'352182',	'352180',	'352175',	'352301',	'351842',	'351837',	'351823',	'351799',	'351770',	'352046',	'352124',	'352080',	'352312',	'352313',	'352369',	'352446',	'352480',	'352515',	'352424',	'352488',	'352586',	'352483',	'352225',	'352599',	'352541',	'352650',	'352649',	'352660',	'352664',	'352661',	'352679',	'352723',	'352843',	'352875',	'352889',	'352893',	'352894',	'352898',	'352899',	'352900',	'352915',	'352768',	'352770',	'352795',	'352858',	'352903',	'352830',	'353035',	'353055',	'353056',	'353057',	'353065',	'353130',	'353137',	'353072',	'353362',	'353426',	'353441',	'353450',	'353433',	'353508',	'353536',	'353602',	'353688',	'353695',	'353665',	'353802',	'353933',	'353938',	'353839',	'353807',	'354042',	'353844',	'354059',	'354036',	'353804',	'354085',	'353917',	'353945',	'353951',	'354039',	'353962',	'354217',	'354236',	'354173',	'352912',	'354362',	'354273',	'354311',	'352231',	'354180',	'354291',	'354403',	'353596',	'353601',	'353603',	'353644',	'354301',	'354300',	'354297',	'354299',	'354303',	'354295',	'354233',	'354225',	'354218',	'354350',	'354213',	'354360',	'354519',	'354196',	'354424',	'354409',	'354434',	'354269',	'354279',	'354283',	'354290',	'354287',	'354294',	'354690',	'354703',	'354714',	'354486',	'354798',	'354736',	'354819',	'354822',	'354823',	'354824',	'354846',	'354855',	'354765',	'354791',	'354793',	'354843',	'354371',	'354327',	'354876',	'354901',	'354921',	'354935',	'354936',	'354879',	'354938',	'355022',	'355024',	'354695',	'354698',	'353806',	'353805',	'353803',	'354904',	'354905',	'354657',	'355231',	'355269',	'355306',	'355158',	'355166',	'355172',	'355176',	'355203',	'355320',	'355325',	'355326',	'355396',	'355328',	'355411',	'355421',	'355426',	'355431',	'355510',	'355372',	'355439',	'355475',	'355479',	'355525',	'355487',	'355533',	'355583',	'355276',	'355457',	'355279',	'355589',	'355591',	'355318',	'355316',	'355789',	'355793',	'355873',	'355912',	'355915',	'355861',	'355863',	'355866',	'356059',	'356068',	'356226',	'356225',	'356358',	'356240',	'356359',	'355984',	'355985',	'356399',	'356401',	'356403',	'356457',	'356479',	'356525',	'356544',	'356355',	'356519',	'356534',	'356585',	'356596',	'356522',	'356579',	'356532',	'356356',	'356546',	'356583',	'356393',	'356663',	'356664',	'356671',	'356640',	'356635',	'356630',	'356643',	'356658',	'356810',	'356820',	'356882',	'356462',	'356940',	'357095',	'357109',	'357112',	'355202',	'357142',	'357038',	'357042',	'356627',	'357162',	'356889',	'356873',	'357199',	'356881',	'357208',	'357057',	'357146',	'357159',	'357059',	'357203',	'357206',	'357209',	'357237',	'357238',	'357239',	'357240',	'357287',	'357289',	'357429',	'357456',	'357486',	'357471',	'357293',	'357601',	'357437',	'357668',	'357672',	'357691',	'357700',	'357659',	'357678',	'357670',	'357792',	'357839',	'357842',	'357844',	'357883',	'357743',	'357862',	'357927',	'357753',	'357746',	'357926',	'357821',	'357834',	'357846',	'357893',	'357816',	'357868',	'358062',	'358079',	'358085',	'358125',	'358131',	'358308',	'358309',	'358310',	'355611',	'358359',	'358344',	'358391',	'358378',	'358385',	'358282',	'358286',	'358380',	'358420',	'358349',	'358352',	'358443',	'358450',	'358361',	'358362',	'358366',	'358365',	'358367',	'358348',	'358453',	'358561',	'358578',	'358587',	'358598',	'358618',	'358444',	'358613',	'358542',	'358730',	'358822',	'358847',	'358859',	'358862',	'358865',	'358868',	'358869',	'358870',	'358861',	'358891',	'358826',	'358848',	'358743',	'358999',	'359020',	'359026',	'359028',	'359061',	'359070',	'359064',	'359200',	'359268',	'359276',	'359155',	'359157',	'359204',	'359300',	'359171',	'359068',	'359415',	'359095',	'359416',	'359062',	'359075',	'359091',	'359417',	'359148',	'359497',	'359509',	'359402',	'359499',	'359374',	'359308',	'359850',	'359853',	'359354',	'359965',	'360057',	'360037',	'360068',	'360076',	'360080',	'360003',	'360073',	'360078',	'360178',	'360199',	'360263',	'360269',	'360355',	'360301',	'360201',	'360206',	'360328',	'360598',	'360602',	'360333',	'360599',	'360186',	'360192',	'360608',	'360609',	'360610',	'360327',	'360326',	'360719',	'360720',	'360734',	'359186',	'360324',	'360325',	'360717',	'360724',	'360731',	'360683',	'360896',	'360897',	'360900',	'361030',	'361121',	'361163',	'361192',	'361240',	'361280',	'361026',	'361306',	'361164',	'361321',	'361352',	'361400',	'361409',	'361410',	'361333',	'361412',	'361413',	'361414',	'361415',	'361416',	'361417',	'361420',	'361439',	'361502',	'361562',	'361566',	'361576',	'361591',	'361652',	'361656',	'361319',	'361672',	'361650',	'361646',	'361570',	'361651',	'361706',	'361740',	'361813',	'361859',	'361955',	'361665',	'362099',	'362100',	'362102',	'362105',	'362106',	'362109',	'362035',	'362045',	'362118',	'362119',	'362120',	'362178',	'361824',	'362242',	'362245',	'362258',	'362262',	'362263',	'362264',	'362269',	'361418',	'362342',	'362271',	'362251',	'362339'
        );  
        $i=0;
        $group=1;
        foreach($facturas as $f)
        {
            if($i==101)
            {
                $facttmp= substr($facttmp, 0,-1);
                
                echo "<a href='/inocomprobantes/generarComprobantePDF/id/[{$facttmp}]/tipo/P' target='_blank'>Facturas Pesos".($group)."</a>
                &nbsp;&nbsp;&nbsp;
                <a href='/inocomprobantes/generarComprobantePDF/id/[{$facttmp}]/tipo/EP' target='_blank'>Facturas Pesos Y Moneda Extrajera".($group)."</a>
                    &nbsp;&nbsp;&nbsp;
                <a href='/inocomprobantes/generarComprobantePDF/id/[{$facttmp}]/tipo/E' target='_blank'> Moneda Extrajera".($group)."</a>
                <br>";
                $facttmp="";
                $i=0;
                $group++;
            }
            
            $facttmp.=$f.",";
            $i++;
        }
        if($facttmp!="")
        {
            $facttmp= substr($facttmp, 0,-1);
            echo "<a href='/inocomprobantes/generarComprobantePDF/id/[{$facttmp}]' target='_blank'>Facturas ".($group++)."</a><br>";
        }
        exit;
    }
    
    
  
  
  
}
?>