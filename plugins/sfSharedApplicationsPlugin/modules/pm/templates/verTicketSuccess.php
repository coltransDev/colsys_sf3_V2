<?

$ticket = $sf_data->getRaw("ticket");
?>
<html>
    <body>
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

                                            <? $es_auditoria = ($ticket->getHdeskGroup()->getCaIddepartament()==4)?TRUE:FALSE; ?>
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Ticket # <?=$ticket->getCaIdticket().": ".$ticket->getCaTitle() ?></b></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b><?=($es_auditoria)?"Proceso:":"&Aacute;rea:";?></b> <?=$ticket->getHdeskGroup()?$ticket->getHdeskGroup()->getCaName():""?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Reportado por:</b> <?=$ticket->getUsuario()?$ticket->getUsuario()->getCaNombre():$ticket->getCaLogin()?> <?=$ticket->getCaReportedby()?" por ".$ticket->getCaReportedby():""?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Sucursal:</b> <?=$ticket->getUsuario()->getSucursal()->getCaNombre()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Extensi&oacute;n:</b> <?=$ticket->getUsuario()->getCaExtension()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fecha </b> <?=Utils::fechaMes($ticket->getCaOpened()) ?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Asignado a:</b> <?=$ticket->getAssignedTo()?$ticket->getAssignedTo():"Sin asignar"?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b><?=($es_auditoria)?"Hallazgo:":"Tipo:";?></b> <?=$ticket->getCaType()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Prioridad:</b> <?=$ticket->getCaPriority()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Porcentaje:</b> <?=$ticket->getCaPercentage()?>%</font><br />
                                            <?
                                            if ($es_auditoria){
                                                ?>
                                                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Empresa:</b> <?=$ticket->getEmpresa()->getCaNombre()?></font><br />
                                                <?
                                            }
                                            ?>

                                            <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
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

                                            <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">

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

                                            <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">

                                                    <ul style="margin-top: 0;">
                                                    <?
                                                    foreach( $files as $file ){
                                                        ?>
                                                           <li>

                                                           <a style="text-decoration:none;color:#0000FF;" href="https://www.coltrans.com.co<?=url_for("gestDocumental/verArchivo?folder=".base64_encode($ticket->getDirectorioBase())."&idarchivo=".base64_encode(basename($file)))?>">
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
                                            <?
                                                if($empresa!='TPLogistics')
                                                    if($ticket->getUsuario()->getSucursal()->getEmpresa()->getCaIdempresa()==4)
                                                        $url = "http://www.coltrans.com.co/intranet/helpdesk/verTicket?id=".$ticket->getCaIdticket();
                                                    else
                                                        $url = "https://www.coltrans.com.co".url_for("/pm/verTicket?id=".$ticket->getCaIdticket());
                                                else
                                                    $url = 'https://www.tplogistics.com.pe'.url_for("/pm/verTicket?id=".$ticket->getCaIdticket());
                                            ?>
                                            <font size="1" face="arial, helvetica, sans-serif" color="#000000"> Si los links no estan funcionando, copie y pegue esta dirección en el navegador:<br><a target="_blank" href="<?=$url?>"><?=$url?>/</a> <br><br> Gracias por utilizar el sistema de tickets!<br><br>Colsys - Grupo Empresarial Coltrans<br>
                                            
                                            </font>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td></tr>
                    </table>
                </td></tr>
            <!-- COPYRIGHT -->
            <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666">&copy; Grupo Empresarial Coltrans</font></td></tr>
        </table>

        <img src="https://www.coltrans.com.co/images/spacer.gif" style="width:1px; height:1px;"/></body>
</html>