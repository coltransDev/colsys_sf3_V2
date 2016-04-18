<?php
 
$data = $sf_data->getRaw("data");
$asunto = $sf_data->getRaw("asunto");
?>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">
    <? /*#################################### 
     2. Comunicaciones Noticolmas 
     ####################################*/ ?>
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasSmall.png">                                                    
                    <div style="font-family:tahoma,sans-serif;display:inline;color:#D99324;font-size: large;vertical-align: top">
                        <b><?=$asunto?></b>
                    </div>
                </td></tr>
            <tr><td ><br><br><hr noshade size="1"></td></tr>
            <?
            foreach ($data as $d) {
                ?>
                <tr>
                    <td style="text-align: justify;" ><br>                                                
                        <div style="padding-bottom: 20px; color:#0000ff;">
                            <b><?= $d["title"] ?></b>
                        </div><br>
                        <?
                        if ($d["image"] != "") {
                            ?>
                            <img src="<?= $d["image"] ?>" width="300" height="151" 
                                 style="border: 1px solid #ccc;float: left;padding: 0px 20px 10px 0px;background-image:url(http://../images/bg_newsitem.png);background-color:rgb(240,240,240);border-width:1px;
                                                             border-style:solid;border-color:rgb(238,238,238) rgb(238,238,238) rgb(221,221,221);clear:both;color:rgb(51,51,51);
                                                             line-height:1.5;border-top-right-radius:6px;border-top-left-radius:6px;border-bottom-right-radius:6px;
                                                             border-bottom-left-radius:6px;background-repeat:repeat no-repeat" alt="">
                                 <?
                        }
                            ?>
                        <div style="vertical-align: middle ;font-family:tahoma,sans-serif;display:inline;text-align: justify">
                            <?= $d["content"] ?>
                        </div>
                    </td>
                </tr>
                <tr><td ><br><br><hr noshade size="1"></td></tr>
                <?
            }
            ?>
        </table>    
    </body>
</html>

<!--<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <img src="http://www.coltrans.com.co/images/logos/coltrans/coltrans-web.png">
                    <img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasMed.png" align="right">
                </td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <!--<span class="l11"><?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?></span><br>-->
                        <!--<br/>
                        <p align="center"><em>Tienen el gusto de invitarlos a la conferencia:</em></p>
                        <p align="center">&nbsp;</p>
                        <p align="center"><span style="color: #1f3864;"><span><em><strong>Nueva Regulaci&oacute;n Aduanera.</strong></em></span></span></p>
                        <p align="center">&nbsp;</p>
                        <p align="center"><em>Conozca los cambios sustanciales que presenta el Estatuto Aduanero Colombiano Decreto 390 del 7 de marzo de 2016.</em></p>
                        <p>&nbsp;</p>
                        <p align="center"><a name="_GoBack"></a> <span style="color: #2f5496;"><span><em>Conferencista </em></span></span><span style="color: #2f5496;"><span><em><strong>Dra. SANDRA CRISTINA MORA SOTO </strong></em></span></span></p>
                        <p>&nbsp;</p>
                        <p align="justify"><span style="font-family: 'Times New Roman', serif;"><span><span style="font-family: Calibri, serif;"><span><em>Abogada de la</em></span></span><span style="color: #000000;"><span style="font-family: Calibri, serif;"><span><span lang="es-ES"><em>&nbsp;Universidad de Medell&iacute;n. </em></span></span></span></span><span style="color: #222222;"><span style="font-family: Calibri, serif;"><span><span lang="es-ES"><em>Especialista en Derecho Comercial de la Universidad Pontificia Bolivariana. </em></span></span></span></span><span style="color: #222222;"><span style="font-family: Calibri, serif;"><span><span lang="es-ES"><em><strong>Especialista en Negociaci&oacute;n y Relaciones internacionales de la Universidad de los Andes. </strong></em></span></span></span></span><span style="color: #222222;"><span style="font-family: Calibri, serif;"><span><span lang="es-ES"><em>Particip&oacute; en la comisi&oacute;n redactora del Decreto 2685 de 1999 (Estatuto Aduanero).Coautora del Libro &ldquo;</em></span></span></span></span><span style="color: #222222;"><span style="font-family: Calibri, serif;"><span><span lang="es-ES"><em><strong>Nuevo Estatuto Aduanero 2002</strong></em></span></span></span></span><span style="color: #222222;"><span style="font-family: Calibri, serif;"><span><span lang="es-ES"><em>&rdquo; publicado por la C&aacute;mara de Comercio de Bogot&aacute;. Docente en diferentes Universidades del pa&iacute;s. </em></span></span></span></span></span></span></p>
                        <p lang="es-ES" align="justify">&nbsp;</p>
                        <p align="justify"><span style="color: #222222;"><span><span lang="es-ES"><em>Experiencia en el sector p&uacute;blico con 13 a&ntilde;os de servicio en la administraci&oacute;n aduanera colombiana, en la que se&nbsp;desempe&ntilde;&oacute; como: Subdirectora de Comercio Exterior, Subdirectora T&eacute;cnica Aduanera y Subdirectora Jur&iacute;dica Aduanera de la DIAN. Igualmente estuvo encargada en varias ocasiones de la Direcci&oacute;n de Aduanas.&nbsp;&nbsp;Tambi&eacute;n&nbsp;prest&oacute; sus servicios en el proyecto MUISCA (Modelo &Uacute;nico de Ingresos, Servicios y Control Automatizado) que desarroll&oacute; la DIAN para la sistematizaci&oacute;n integral de sus procesos aduaneros, tributarios y cambiarios, as&iacute; como&nbsp;en la Defensor&iacute;a del Contribuyente y Usuario Aduanero. Experiencia en el sector privado como consultora de la firma&nbsp;Pardo &amp; Asociados en materia de comercio exterior y aduanas. Particip&oacute; en las mesas de trabajo y discusi&oacute;n con la DIAN de la nueva regulaci&oacute;n aduanera&nbsp;&nbsp; que recoge el </em></span></span></span><span style="color: #222222;"><span><span lang="es-ES"><em><strong>Decreto 390 de 2016</strong></em></span></span></span><span style="color: #222222;"><span><span lang="es-ES"><em>.&nbsp;&nbsp;</em></span></span></span></p>
                        <p align="justify">&nbsp;</p>
                        <p align="justify">&nbsp;</p>
                        <p><span><em>Lugar: Compensar Avenida 68 No. 49 A &ndash; 47 </em></span></p>
                        <p><span><em>Sal&oacute;n Gran Auditorio 1.2 y 1.3 </em></span></p>
                        <p><span><em>Fecha: Marzo 29 de 2016</em></span></p>
                        <p><span><em>Hora: 08:00 a.m. a 12:00 m</em></span></p>
                        <p><span><em>Favor confirmar su asistencia al 4239300 ext. 225  o haga click <a href="https://www.coltrans.com.co<?=url_for("comunicaciones/confirmarAsistencia?idenvio=".$idenvio."&idcontacto=".$idcontacto."&idcliente=".$idcliente)?>">aquí</a></em></span></p>                                                                                                
                        <p><span><em>Bogot&aacute;.&nbsp;</em></span></p>
                        <!--<div style="float:left">
                            GRUPO COLTRANS SAS<br>
                            <a href="http://www.coltrans.com.co/">www.coltrans.com.co<a><br/>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>-->