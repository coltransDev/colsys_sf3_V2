<!--<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="#EAEAEA">
        <br>
        <table style="border: 1px solid #E4E4E4; background-color: #fff; max-width: 70em;" width="90%" align="center" max-width="80em">
            <tr>
                <td>
                    <div style="float:left">
                        <img style="height: auto;  max-width: 230px; width: 100%;" border="0" src="https://www.colsys.com.co/images/pdf/<?=$empresa->getCaLogo()?>" > 
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding:20px"  >
                    <div style="text-align: justify;font-size: 12px">
                        <p>Para <?=  strtoupper($empresa->getCaNombre())?> es importante conocer lo que más le gusta de nuestro servicio de Agenciamiento de Carga, queremos que nos brinde la oportunidad de trabajar en esos  aspectos que podemos mejorar.</p>
                        <p style="text-align:center"><b>Los elogios nos incentivan, la critica asegura nuestro futuro!</b></p>
                        <p>Lo invitamos a ingresar al siguiente enlace:</p><br/>
                        <div style="text-align:center; font-size: 15px;">
                            <a href="https://172.16.1.27/formulario/servicios/id/<?php echo base64_encode($idformulario) ?>/co/<?php echo base64_encode($contacto) ?>">Encuesta de servicio</a>
                        </div><br/><br/><br/>
                        <hr>
                        <p><span style="color:#333333; font-size:9px">La información contenida en este correo electrónico y en todos sus archivos anexos, es confidencial y/o privilegiada y sólo puede ser utilizada por la(s) persona(s) a la(s) cual(es) está dirigida. Si usted no es el destinatario autorizado, cualquier modificación, retención, difusión, distribución o copia total o parcial de este mensaje y/o de la información contenida en el mismo y/o en sus archivos anexos está prohibida y son sancionadas por la ley. Si por error recibe este mensaje, de antemano le ofrecemos disculpas, y le solicitamos  borrarlo de inmediato, notificarle de su error a la persona que lo envió y abstenerse de divulgar su contenido y anexos</span></p>
                        <hr><br/>
                        <div style="text-align: center;"><?=strtoupper($empresa->getCaNombre())?><br>
                            <a href="http://<?=$empresa->getCaUrl()?>" target="_BLANK"><?=$empresa->getCaUrl()?></a>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>-->

<html>
    <body>
        <!-- GREY BORDER -->
        <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
            <!-- WHITE BACKGROUND -->
            <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF"><tr><td>
                <!-- MAIN CONTENT TABLE -->                
                <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
                    <tr><td colspan="5">
                            <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coltrans/ColtransMed.png">
                                </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                            Encuesta de Servicio</div></b></font></td></tr></tbody></table>
                        </td></tr>
                    <tr><td><hr noshade size="1"></td></tr>
                    <tr>
                        <td style="padding:20px">
                            <div style="text-align: justify;font-size: 12px">
                                <p align="center">
                                    Para <?=  strtoupper($empresa->getCaNombre())?> es importante conocer lo que más le gusta de nuestro servicio de Agenciamiento de Carga, queremos que nos brinde la oportunidad de trabajar en esos aspectos que podemos mejorar.
                                </p>
                                <p align="center" style="font-size: 16px;">    
                                    <b>LOS ELOGIOS NOS INCENTIVAN, LA CRÍTICA ASEGURA NUESTRO FUTURO!</b>
                                </p><br/>
                                <p align="center">
                                    <!--<button style ="display: inline-block; padding: 15px 25px; font-size: 18px; cursor: pointer; text-align: center; text-decoration: none; outline: none; color: #fff; background-color: #233061; border: none; border-radius: 15px; box-shadow: 0 9px #999;" onclick="window.open('https://172.16.1.27/formulario/servicios/id/<?php echo base64_encode($idformulario) ?>/co/<?php echo base64_encode($contacto) ?>')">ENCUESTA DE SERVICIO</button>-->
                                    <a href="https://www.colsys.com.co/formulario/servicios/id/<?php echo base64_encode($idformulario) ?>/co/<?php echo base64_encode($contacto) ?>" style ="display: inline-block; padding: 15px 25px; font-size: 18px; cursor: pointer; text-align: center; text-decoration: none; outline: none; color: #fff; background-color: #233061; border: none; border-radius: 15px; box-shadow: 0 9px #999;">ENCUESTA DE SERVICIO</a>
                                </p>
                                <p align="justify">
                                    <table width="100%"><tr><td>
                                        <p align="justify">                                
                                            <img src="https://www.colsys.com.co/images/pdf/iso.jpg" width="80" height="110">
                                            <img src="https://www.colsys.com.co/images/pdf/basc.jpg" width="112" height="110">
                                            <img style=" vertical-align:  top;" src="https://www.colsys.com.co/images/pdf/iata.jpg" width="80" height="60">
                                        </p>
                                            </td></tr></table>
                                </p>
                            </div>
                            <div style="text-align: justify; font-size: 9px; border-width:1px;margin:12px 0 0;padding:4px 4px 12px;">
                                Usted ha recibido este mensaje por ser un cliente del grupo empresarial COLTRANS S.A.S, AGENCIA DE ADUANAS COLMAS LTDA Nivel 1 , COL OTM y COLDEP&Oacute;SITOS.<br/>
                                La información contenida en este correo electrónico y en todos sus archivos anexos, es confidencial y/o privilegiada y sólo puede ser utilizada por la(s) persona(s) a la(s) cual(es) está dirigida.<br /> 
                                Si usted no es el destinatario autorizado, cualquier modificación, retención, difusión, distribución o copia total o parcial de este mensaje y/o de la información contenida en el mismo y/o en sus <br />
                                archivos anexos está prohibida y son sancionadas por la ley. Si por error recibe este mensaje, le ofrecemos disculpas, sírvase borrarlo de inmediato, notificarle de su error a la persona que lo <br />
                                envió y abstenerse de divulgar su contenido y anexos.
                            </div>
                        </td>
                    </tr>
                </table>
            </table>
        </table>    
    </body>
</html>