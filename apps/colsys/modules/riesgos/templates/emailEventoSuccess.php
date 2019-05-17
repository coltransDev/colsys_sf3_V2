<html>
    <body>
        <!-- GREY BORDER -->
        <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
                    <!-- WHITE BACKGROUND -->
                    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF"><tr><td>
                            <!-- MAIN CONTENT TABLE -->
                            <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <!-- LOGO -->
                                <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.colsys.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
                                                <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324">Nuevo evento: <?=strtoupper($proceso)?></font></td></tr></table></td></tr>
                                <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
                                <!-- INTRO -->
                                <tr>
                                    <td>&nbsp;</td><td>
                                        <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                            <b>Riesgo:</b><?=$nriesgo?><br/>
                                            <b>Evento:</b><?=$descripcion?><br/>
                                            <b>PA:</b><?=$evento->getCaPa()."<br/>"?>
                                            <b>Documento:</b><?=$evento->getCaDocumento()."<br/>"?>
                                            <b>Cliente:</b><?=$evento->getCliente()->getIds()->getCaNombre()."<br/>"?>
                                            <b>Sucursal:</b><?=$evento->getSucursal()->getCaNombre()."<br/>"?>
                                            <b>Pérdida:</b><?=$evento->getCaPerdidaTot()."<br/>"?>
                                        </div>
                                    </td><td width="50"><img src="https://www.colsys.com.co/images/spacer.gif" width="75" height="1" alt=""></td></tr>
                            </table></td></tr>
                    </table>
                </td></tr>
            <!-- COPYRIGHT -->
            <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666">&copy; Coltrans S.A. Colmas Ltda. Agencia de Aduanas Nivel 1</font></td></tr>
        </table>

        <img src="https://www.colsys.com.co/images/spacer.gif" style="width:1px; height:1px;"/></body>
</html>