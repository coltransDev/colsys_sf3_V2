<?

//use_helper("MimeType");

$ticket = $sf_data->getRaw("ticket");


$ticket = $sf_data->getRaw("ticket");
?>
<html>
    <body>
    <style type="text/css" >

        img.img{
            border: 0px;
        }



        a.link:link {
           text-decoration:none;
           color:#0000FF;
        }
        a.link:active {
           text-decoration:none;
           color:#0000FF;
        }
        a.link:visited {
           text-decoration: none;
           color: #062A7D;
        }

        .entry {
            border-bottom: 1px solid #DDDDDD;
            clear:both;
            padding: 0 0 10px;
        }


        .entry-even {
            background-color:#F6F6F6;
            border-color:#CCCCCC;
            border-style:dotted;
            border-width:1px ;
            margin:12px 0 0;
            padding:12px 12px 24px;
            font-size: 12px;
            font-family: arial, helvetica, sans-serif;

        }

        .entry-odd {
            background-color:#FFFFFF;
            border-color:#CCCCCC;
            border-style:dotted;
            border-width:1px ;
            margin:12px 0 0;
            padding:12px 12px 24px;
            font-size: 12px;
            font-family: arial, helvetica, sans-serif;

        }

        .entry-yellow {
            background-color:#FFFFCC;
            border-color:#CCCCCC;
            border-style:dotted;
            border-width:1px ;
            margin:12px 0 0;
            padding:12px 12px 24px;
            font-size: 12px;
            font-family: arial, helvetica, sans-serif;

        }
        .entry-date{
            float: right;
            color: #0464BB;
        }
    </style>
        <!-- GREY BORDER -->
        <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
                    <!-- WHITE BACKGROUND -->
                    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF"><tr><td>
                                <!-- MAIN CONTENT TABLE -->
                                <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                    <!-- LOGO -->
                                    <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.coltrans.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
                                                    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324">Sistema de tickets</font></td></tr></table></td></tr>
                                    <tr><td width="25"><img src="https://www.coltrans.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
                                    <!-- INTRO -->
                                    <tr>
                                        <td>&nbsp;</td><td>
                                            
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Ticket # <?=$ticket->getCaIdticket().": ".$ticket->getCaTitle() ?></b></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>&Aacute;rea:</b> <?=$ticket->getHdeskGroup()?$ticket->getHdeskGroup()->getCaName():""?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Reportado por:</b> <?=$ticket->getUsuario()?$ticket->getUsuario()->getCaNombre():$ticket->getCaLogin()?> <?=$ticket->getCaReportedby()?" por ".$ticket->getCaReportedby():""?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fecha </b> <?=Utils::fechaMes($ticket->getCaOpened()) ?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Asignado a:</b> <?=$ticket->getAssignedTo()?$ticket->getAssignedTo():"Sin asignar"?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Tipo:</b> <?=$ticket->getCaType()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Prioridad:</b> <?=$ticket->getCaPriority()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Porcentaje:</b> <?=$ticket->getCaPercentage()?>%</font><br />
                                            
                                            <div class="entry-even">
                                            <?=$ticket->getCaText()?>
                                            </div>
                                        </td><td width="50"><img src="https://www.coltrans.com.co/images/spacer.gif" width="75" height="1" alt=""></td></tr>
                                    <tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <img src="https://www.coltrans.com.co/images/spacer.gif" width="1" height="1" alt="">
                                            <p><font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Respuestas</b></font><br>

                                            <?
                                            include_component("pm", "listaRespuestasTicket", array("idticket"=>$ticket->getCaIdticket(), "opener"=>"", "format"=>$format) );
                                            ?>
                                            
                                         </td>
                                    </tr>
                                    <?
                                    if( count($usuarios)>0 ){
                                    ?>
                                    <tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <img src="https://www.coltrans.com.co/images/spacer.gif" width="1" height="1" alt="">
                                            <p><font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Usuarios</b></font><br>

                                            <div class="entry-even">
                                              
                                                    <ul style="margin-top: 0;">
                                                    <?
                                                    

                                                    $i=0;
                                                    foreach( $usuarios as $usuario ){
                                                        ?>
                                                           <li><?=$usuario->getCaNombre()?></li>
                                                        <?


                                                    }
                                                    ?>
                                                    </ul>
                                            </div>
                                         </td>
                                    </tr>
                                    <?
                                    }
                                    if( count($files)>0 ){
                                    ?>
                                    <tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <img src="https://www.coltrans.com.co/images/spacer.gif" width="1" height="1" alt="">
                                            <p><font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Archivos</b></font><br>

                                            <div class="entry-even">

                                                    <ul style="margin-top: 0;">
                                                    <?
                                                    
    
                                                    foreach( $files as $file ){
                                                        ?>
                                                           <li>
                                                        
                                                           <a class="link" href="https://www.coltrans.com.co<?=url_for("gestDocumental/verArchivo?folder=".base64_encode($ticket->getDirectorioBase())."&idarchivo=".base64_encode(basename($file)))?>">
                                                                <b><?=basename($file)?></b>
                                                            </a>

                                                           </li>
                                                        <?


                                                    }
                                                    ?>
                                                    </ul>
                                            </div>
                                         </td>
                                    </tr>
                                    <?
                                    }
                                    ?>
                                    <tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>




                                    <tr><td>&nbsp;</td><td>
                                            <font size="1" face="arial, helvetica, sans-serif" color="#000000"> Si los links no estan funcionando, copie y pegue esta dirección en el navegador:<br>https://www.coltrans.com.co<?=url_for("/pm/verTicket?id=".$ticket->getCaIdticket())?> <br><br> Gracias por utilizar el sistema de tickets!<br><br>Coltrans S.A. - Colmas Ltda. Agencia de Aduanas Nivel 1<br>
                                                <a href="https://www.coltrans.com.co/">http://www.coltrans.com.co/</a>
                                            </font>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td></tr>
                    </table>
                </td></tr>
            <!-- COPYRIGHT -->
            <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666">&copy; Coltrans S.A. Colmas Ltda. Agencia de Aduanas Nivel 1</font></td></tr>
        </table>

        <img src="https://www.coltrans.com.co/images/spacer.gif" style="width:1px; height:1px;"/></body>
</html>