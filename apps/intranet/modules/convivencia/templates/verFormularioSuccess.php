<?
$formulario = $sf_data->getRaw("formulario");
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
                                    <tr><td colspan="3"><table><tr><td width="135"><img src="<?= $logo ?>" width="178" height="30" alt="COLSYS"></td>
                                                    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324">Comit&eacute; de Convivencia: Reporte de Quejas</font></td></tr></table></td></tr>
                                    <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
                                    <!-- INTRO -->
                                    <tr>
                                        <td>&nbsp;</td><td>
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Formulario # <?=$formulario->getCaId() ?></b></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fecha </b> <?=Utils::fechaMes($formulario->getCaFchcreado()) ?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Reportado por:</b> <?=$formulario->getUsuCreado()->getCaNombre()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Cargo:</b> <?=$formulario->getUsuCreado()->getCaCargo()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Sucursal:</b> <?=$formulario->getUsuCreado()->getSucursal()->getCaNombre()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Extensi&oacute;n:</b> <?=$formulario->getUsuCreado()->getCaExtension()?></font><br /><br />
                                            
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Denunciando a:</b> <?=$formulario->getUsuario()->getCaNombre()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Cargo:</b> <?=$formulario->getUsuario()->getCaCargo()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Sucursal:</b> <?=$formulario->getUsuario()->getSucursal()->getCaNombre()?></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Extension:</b> <?=$formulario->getUsuario()->getCaExtension()?></font><br />
                                            
                                            <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                            <?=$formulario->getCaDetalle()?>
                                            </div>                                        
                                        </td>                                        
                                        <td width="50"><img src="https://www.colsys.com.co/images/spacer.gif" width="75" height="1" alt=""></td></tr>
                                    <tr><td>&nbsp;</td><td colspan="2"><p>Declaro que los hechos narrados anteriormente son verdaderos, que mi voluntad no ha sido manipulada para realizar el presente reclamo, que estoy dispuesto(a) a sostener estas declaraciones delante del Comit&eacute; en la fecha que ustedes dispongan para esto, que asistir&eacute; las reuniones a las que sea citado y que estoy dispuesto(a) adem&aacute;s a escuchar las recomendaciones que el Comit&eacute; llegare a manifestar respecto al caso comentado.</p></td></tr>
                                    
                                    <?
                                    if( count($files)>0 ){
                                    ?>
                                    <tr><td>&nbsp;</td><td colspan="2"><hr noshade size="1"></td></tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <img src="https://www.colsys.com.co/images/spacer.gif" width="1" height="1" alt="">
                                            <p><font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Archivos</b></font><br>

                                            <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">

                                                    <ul style="margin-top: 0;">
                                                    <?
                                                    foreach( $files as $file ){
                                                        ?>
                                                           <li>

                                                               <a style="text-decoration:none;color:#0000FF;" href="<?=url_for("/intranet/gestDocumental/verArchivo?folder=".base64_encode($formulario->getDirectorioBase())."&idarchivo=".base64_encode(basename($file)))?>" target="_blank">
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
                                </table>
                            </td></tr>
                    </table>
                </td></tr>
            <!-- COPYRIGHT -->
            <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666">&copy; Coltrans S.A. Colmas Ltda. Agencia de Aduanas Nivel 1</font></td></tr>
        </table>

        <img src="https://www.colsys.com.co/images/spacer.gif" style="width:1px; height:1px;"/>
    </body>
</html>