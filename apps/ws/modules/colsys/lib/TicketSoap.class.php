<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

/**
 * Description of TicketSoap
 *
 * @author maquinche
 */
class TicketSoap {
    /**
     * ResponseTicket method
     *
     * @param string $key_secret
     * @param string $subject
     * @param string $message
     * @param string $from
     * @return string
     */
    public function responseTicket( $key_secret, $subject, $message,$from ) {
        
        if( $key_secret!=sfConfig::get("app_soap_secret") ){
            return "Remote: La clave no concuerda";     
        }
        $resp=$message;        

        //$email_regex = "/[^0-9< ][A-z0-9._%+-]+([.][A-z0-9_]+)*@[A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}/";
        //$email_regex ="\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b";
        $email_regex ="/[^0-9< ][A-z0-9._%+-]+([.][A-z0-9_]+)*@[A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}/";
        
        preg_match_all($email_regex, $from, $matches);
        $from = $matches[0][0];   
        /*$t="";
        foreach($matches as $m)
        {
            foreach($m as $f)
                $t.= ("|".$f);
        }
        return $t;*/
        $idticket=0;

        try{
            $id=0;
            
            $user = Doctrine::getTable("Usuario")
                            ->createQuery("u")
                            ->select("u.ca_login")
                            ->where("u.ca_email = ? ", $from)
                            ->addWhere("u.ca_activo = true ")
                            ->limit(1)
                            ->fetchOne();

            //$ticket_regex = "/[^#A-záéíóúÁÉÍÓÚüÜñÑ ][A-z0-9]*/";
            $ticket_regex = "/#[0-9]+/";
            
            preg_match_all($ticket_regex, $subject, $matches_ticket);
            $idticket=  str_replace("#","",$matches_ticket[0][0]);

            if($idticket>0)
            {
                $conn = Doctrine::getTable("HdeskResponse")->getConnection();
                $conn->beginTransaction();
                try{                    
                    $ticket = Doctrine_Query::create()->from("HdeskTicket h")->where("h.ca_idticket = ?", $idticket)->fetchOne();
                    $respuesta = new HdeskResponse();
                    $respuesta->setCaIdticket($idticket);
                    $respuesta->setCaText($resp);
                    $respuesta->setCaLogin($user->getCaLogin());
                    $respuesta->setCaCreatedat(date("Y-m-d H:i:s"));
                    $respuesta->save( $conn );                    
                    $logins = array($ticket->getCaLogin());
                    if ($ticket->getCaAssignedto()) {
                        $logins[] = $ticket->getCaAssignedto();
                    } else {
                        $usuarios = Doctrine::getTable("HdeskUserGroup")
                                        ->createQuery("h")
                                        ->innerJoin("h.Usuario u")        
                                        ->addWhere("h.ca_idgroup = ? ", $ticket->getCaIdgroup())  
                                        ->addWhere("u.ca_activo = ? ", true )  
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

                    if ($ticket->getCaAssignedto() == $user->getCaLogin() || in_array($user->getCaLogin(), $logins)) {
                        $tarea = $ticket->getTareaIdg();
                        if ($tarea) {
                            if (!$tarea->getCaFchterminada()) {
                                $tarea->setCaFchterminada(date("Y-m-d H:i:s"));
                                $tarea->setCaObservaciones("form google app-script");
                                $tarea->setCaUsuterminada($user->getCaLogin());
                                $tarea->save( $conn );
                            }
                        }
                    }
                    
                    

                    $email1 = new Email();
                    $email1->setCaUsuenvio($user->getCaLogin());
                    $email1->setCaTipo("Notificación");
                    $email1->setCaIdcaso($ticket->getCaIdticket());
                    $email1->setCaFrom("no-reply@coltrans.com.co");
                    $email1->setCaFromname("Colsys Notificaciones");

                    $email1->setCaSubject("Nueva respuesta Ticket #" . $ticket->getCaIdticket() . " [" . $ticket->getCaTitle() . "]");

                    $usuariosTicket = Doctrine::getTable("Usuario")->createQuery("u")
                        ->innerJoin("u.HdeskTicketUser ug")
                        ->addWhere("ug.ca_idticket = ?", $ticket->getCaIdticket())
                        ->addWhere("u.ca_activo = ?", true)
                        ->addOrderBy("u.ca_nombre")
                        ->execute();
                    
                    $texto = $this->viewTicket($ticket,$usuariosTicket);                    
                    $email1->setCaBodyhtml($texto);                    
                    foreach ($logins as $login) {
                        if ($user->getCaLogin() != $login) {
                            $usuario = Doctrine::getTable("Usuario")->find($login);
                            $email1->addTo($usuario->getCaEmail());
                        }
                    }                    
                    $email1->save($conn );
                    $conn->commit();                    
                    return "success";
                }catch(Exception $e){
                    /*$myfile = fopen("/srv/www/digitalFile/2014/newfile.txt", "w") or die("Unable to open file!");
                    $txt = "John Doe\n";
                    fwrite($myfile, $txt);
                    $txt = "Jane Doe\n";
                    fwrite($myfile, $txt);
                    fclose($myfile);*/
                    $conn->rollback();
                    return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"]." ticket:".$idticket;
                }
            }
            else
            {
                /*$myfile = fopen("/srv/www/digitalFile/2014/newfile.txt", "w") or die("Unable to open file!");
                $txt = "John Doe\n";
                fwrite($myfile, $txt);
                $txt = "Jane Doe\n";
                fwrite($myfile, $txt);
                fclose($myfile);*/
               return "ticket no encontrado ".$subject;
            }            
        }
        catch (Exception $e)
        {
            /*$myfile = fopen("/srv/www/digitalFile/2014/newfile.txt", "w") or die("Unable to open file!");
            $txt = "John Doe\n";
            fwrite($myfile, $txt);
            $txt = "Jane Doe\n";
            fwrite($myfile, $txt);
            fclose($myfile);*/
            return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"]." ticket:".$idticket;
        } 
    }

     public function viewTicket( $ticket , $usuarios ) {
         $htmlVT='<html><body>
                <style type="text/css" >
                    img.img{border: 0px;}
                    a.link:link {text-decoration:none;color:#0000FF;}
                    a.link:active {text-decoration:none;color:#0000FF;}
                    a.link:visited {text-decoration: none;color: #062A7D;}
                    .entry {border-bottom: 1px solid #DDDDDD;clear:both;padding: 0 0 10px;}
                    .entry-even {background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px ;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;}
                    .entry-odd {background-color:#FFFFFF;border-color:#CCCCCC;border-style:dotted;border-width:1px ;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;}
                    .entry-yellow {background-color:#FFFFCC;border-color:#CCCCCC;border-style:dotted;border-width:1px ;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;}
                    .entry-date{float: right;color: #0464BB;}
                </style>                    
                    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
                                <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF"><tr><td>
                                            <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                                <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.colsys.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
                                                                <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324">Sistema de tickets</font></td></tr></table></td></tr>
                                                <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
                                                <tr>
                                                    <td>&nbsp;</td><td>
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Ticket # '.$ticket->getCaIdticket().": ".$ticket->getCaTitle() .'</b></font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>&Aacute;rea:</b> '.($ticket->getHdeskGroup()?$ticket->getHdeskGroup()->getCaName():"").'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Reportado por:</b> '.($ticket->getUsuario()?$ticket->getUsuario()->getCaNombre():$ticket->getCaLogin()). ($ticket->getCaReportedby()?" por ".$ticket->getCaReportedby():"").'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Sucursal:</b> '.$ticket->getUsuario()->getSucursal()->getCaNombre().'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Extensi&oacute;n:</b> '.$ticket->getUsuario()->getCaExtension().'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fecha </b> '.Utils::fechaMes($ticket->getCaOpened()) .'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Asignado a:</b> '.($ticket->getAssignedTo()?$ticket->getAssignedTo():"Sin asignar").'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Tipo:</b> '.$ticket->getCaType().'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Prioridad:</b> '.$ticket->getCaPriority().'</font><br />
                                                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Porcentaje:</b> '.$ticket->getCaPercentage().'%</font><br />
                                                        <div class="entry-even">
                                                        '.$ticket->getCaText().'
                                                        </div>
                                                    </td><td width="50"><img src="https://www.colsys.com.co/images/spacer.gif" width="75" height="1" alt=""></td></tr>
                                                <tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <img src="https://www.colsys.com.co/images/spacer.gif" width="1" height="1" alt="">
                                                        <p><font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Respuestas</b></font><br>
                                                        <div class="commentlist">';

        $responses = Doctrine::getTable("HdeskResponse")
                           ->createQuery("r")
                           ->where("r.ca_idticket = ? ", $ticket->getCaIdticket() )
                           ->addWhere("r.ca_responseto IS NULL " )
                           ->addOrderBy("r.ca_createdat ASC")
                           ->addOrderBy("r.ca_idresponse ASC")
                           ->execute();
        $idLastResponse = Doctrine::getTable("HdeskResponse")
                           ->createQuery("r")
                           ->select("r.ca_idresponse")
                           ->where("r.ca_idticket = ? ", $ticket->getCaIdticket() )
                           ->addOrderBy("r.ca_createdat DESC")
                           ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                           ->execute();
        
        $i=0;
        foreach( $responses as $response ){
            if( $idLastResponse==$response->getCaIdresponse() ){
                $class = "yellow";
            }else{
                $class = $i%2==0?"even":"odd";
            }
                 
                $htmlVT.='<div class="entry-'.$class.'">
                <div class="entry-date">'.Utils::fechaMes($response->getCaCreatedat()).'</div>
                <b>'.($response->getUsuario()?$response->getUsuario()->getCaNombre():$response->getCaLogin()).'</b><br />';
                
                $tarea = $response->getNotTarea();
                if( $tarea && $tarea->getCaFchvencimiento() ){                
                    $htmlVT.='<b>Seguimiento programado:</b> '.Utils::fechaMes(Utils::parseDate($tarea->getCaFchvencimiento(), "Y-m-d")).'<br />';
                }
                $htmlVT.=str_replace("\n","<br />",$response->getCaText());

                $subResponses = $response->getResponse();        
                foreach( $subResponses as $subResponse ){
                    if( $idLastResponse==$subResponse->getCaIdresponse() ){
                        $class = "yellow";
                    }else{
                        $class = $i%2!=0?"even":"odd";
                    }
                
                    $htmlVT.='<div class="entry-'.$class.'">
                        <div class="entry-date">'.Utils::fechaMes($subResponse->getCaCreatedat()).'</div>
                        <b>'.($subResponse->getUsuario()?$subResponse->getUsuario()->getCaNombre():$subResponse->getCaLogin()).'</b>
                        <br /><br />
                        '.str_replace("\n","<br />",$subResponse->getCaText()).'
                    </div>
                    <br />';
                }
            $htmlVT.='</div>';            
            $i++;
        }
                $htmlVT.='</div>';
         
                                                        $htmlVT.='
                                                     </td>
                                                </tr>';
                                                
                                            if( count($usuarios)>0 ){
                                                $htmlVT.='
                                                <tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <img src="https://www.colsys.com.co/images/spacer.gif" width="1" height="1" alt="">
                                                        <p><font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Usuarios</b></font><br>
                                                        <div class="entry-even">
                                                                <ul style="margin-top: 0;">';
                                                                $i=0;
                                                                foreach( $usuarios as $usuario ){                                                                 
                                                                 $htmlVT.='      <li>'.$usuario->getCaNombre().'</li>';
                                                                }
                                                                $htmlVT.='</ul>
                                                        </div>
                                                     </td>
                                                </tr>';                                                
                                                }
                                                
                                                $htmlVT.='<tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>
                                                <tr><td>&nbsp;</td><td>
                                                        <font size="1" face="arial, helvetica, sans-serif" color="#000000"> Si los links no estan funcionando, copie y pegue esta dirección en el navegador:<br>https://www.colsys.com.co<?=url_for("/pm/verTicket?id='.$ticket->getCaIdticket().' <br><br> Gracias por utilizar el sistema de tickets!<br><br>Coltrans S.A. - Colmas Ltda. Agencia de Aduanas Nivel 1<br>
                                                            <a href="https://www.colsys.com.co/">http://www.coltrans.com.co/</a>
                                                        </font>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td></tr>
                                </table>
                            </td></tr>                        
                        <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666">&copy; Coltrans S.A. Colmas Ltda. Agencia de Aduanas Nivel 1</font></td></tr>
                    </table>
                    <img src="https://www.colsys.com.co/images/spacer.gif" style="width:1px; height:1px;"/></body>
            </html>';
        return $htmlVT;
     }
}

?>
