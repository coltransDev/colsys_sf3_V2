<!--<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <style>
            .contentheading {
                border-bottom: 1px solid #E4E4E4;
                color: #1C3A56;
                font-size: 2.3em;
                margin: 0 0 14px;
                padding: 8px 0;
            }
            h2, .componentheading {
                color: #1C3A56;
                font-size: 2.2em;
                font-weight: lighter;
                line-height: 1.4em;
                margin: 0;
                padding: 6px 0;
            }
            .tableMap {
                border: 1px solid #E4E4E4;
                background-color: #fff;
                max-width: 70em;
            }
            .tableMap td {
                color: #888888;
                text-align: left;
                font-family: Verdana;
                font-size: 11px;
            }
            .tableMap th {
                color: #FFFFFF;
                text-align: center;
                font-family: Verdana;
                font-size: 12px;
                font-weight: bolder;
                background-color: #003DB8;
            }
            .destacado{
                color: #000000;
                font-family: Verdana;
                font-size: 11px;
                font-weight: bolder;
            }
            .rojo
            {
                color: #FF3333 ;
                font-family: Verdana;
            }
            .titulo{
                color: #000000;
                font-family: Verdana;
                font-size: 15px;
                font-weight: bolder;
            }
            .l11{
                font-size: 13px;
            }
        </style>
    </head>
    <body bgcolor="#EAEAEA">

        <br>
        <table class="tableMap measure_converter" width="90%" align="center" max-width="80em">

            <tr>
                <td>
                    <div style="float:left">
                        <a  style="margin-left: 5px;" href="http://www.colmas.com.co">
                            <img  border="0" src="https://www.colsys.com.co/images/logos/colmas.png" alt="Colmas LTDA.">   
                        </a>     
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding:20px"  >
                    <div style="text-align: justify;font-size: 12px">
                        <span class="l11">' . date("d") . ' de ' . Utils::mesLargo(date("m")) . ' de ' . date("Y") . '</span><br>
                        <p>Para <?=strtoupper($empresa->getCaNombre())?> es importante conocer su opini&oacute;n de nuestro servicio, para esto hemos dise&nacute;ado la siguiente encuesta con el fin de conocer el desempe&nacute;o de nuestro servicio en cada proceso; agradecemos su tiempo y sinceridad ya que su opini&oacute;n nos ayuda a mejorar diariamente y brindar un servicio de calidad para usted.</p>
                        <p style="text-align:center"><b>Los elogios nos incentivan, la critica asegura nuestro futuro!</b></p>
                        <p>Lo invitamos a ingresar al siguiente enlace:</p>
                        <br>
                        <div style="text-align:center">
                            <a href="https://www.colsys.com.co/formulario/servicios/id/<?php echo base64_encode($idformulario) ?>/co/<?php echo base64_encode($contacto) ?>">Encuesta de servicio</a>
                        </div>
                        <br>
                        <br>
                        <br>
                        <hr class ="hr">
                        <p><span style="color:#333333; font-size:9px">La información contenida en este correo electrónico y en todos sus archivos anexos, es confidencial y/o privilegiada y sólo puede ser utilizada por la(s) persona(s) a la(s) cual(es) está dirigida. Si usted no es el destinatario autorizado, cualquier modificación, retención, difusión, distribución o copia total o parcial de este mensaje y/o de la información contenida en el mismo y/o en sus archivos anexos está prohibida y son sancionadas por la ley. Si por error recibe este mensaje, de antemano le ofrecemos disculpas, y le solicitamos  borrarlo de inmediato, notificarle de su error a la persona que lo envió y abstenerse de divulgar su contenido y anexos</span></p>
                        <hr class ="hr">
                        <br>

                        <div style="text-align: center;">AGENCIA DE ADUANAS COLMAS LTDA Nivel 1.<br>
                            <a href="http://www.colmas.com.co/" target="_BLANK">www.colmas.com.co</a>
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
                            <table><tbody><tr><td><img src="http://www.colmas.com.co/templates/colmas/images/logo_colmas_transparente.png">
                                </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                            Encuesta de Servicio</div></b></font></td></tr></tbody></table>
                        </td></tr>
                    <tr><td><hr noshade size="1"></td></tr>
                    <tr>
                        <td style="padding:20px">
                            <div style="text-align: justify;font-size: 12px">
                                <p align="center">
                                    Para <?=  strtoupper($empresa->getCaNombre())?> es muy importante conocer su opinión sobre nuestro servicio,  para esto hemos dise?ado la siguiente encuesta con el fin de conocer nuestro desempe?o en cada proceso; agradecemos su tiempo y sinceridad ya que su opinión nos ayuda a mejorar diariamente y brindar un servicio de calidad para usted.
                                </p>
                                <p align="center" style="font-size: 16px;">    
                                    <b>LOS ELOGIOS NOS INCENTIVAN, LA CRÍTICA ASEGURA NUESTRO FUTURO!</b>
                                </p><br/>
                                <p align="center">
                                    <!--<button style ="display: inline-block; padding: 15px 25px; font-size: 18px; cursor: pointer; text-align: center; text-decoration: none; outline: none; color: #fff; background-color: #233061; border: none; border-radius: 15px; box-shadow: 0 9px #999;" onclick="window.open('https://172.16.1.27/formulario/servicios/id/<?php echo base64_encode($idformulario) ?>/co/<?php echo base64_encode($contacto) ?>')">ENCUESTA DE SERVICIO</button>-->
                                    <a href="https://www.colsys.com.co/formulario/indexExt5/id/<?php echo base64_encode($idformulario) ?>/co/<?php echo base64_encode($contacto) ?>/tipo/<?=$tipo?>" style ="display: inline-block; padding: 15px 25px; font-size: 18px; cursor: pointer; text-align: center; text-decoration: none; outline: none; color: #fff; background-color: #233061; border: none; border-radius: 15px; box-shadow: 0 9px #999;">ENCUESTA DE SERVICIO</a>
                                </p>
                                <table width="100%"><tr><td>
                                    <p align="justify">
                                        <img src="https://www.colsys.com.co/images/pdf/iso_colmas.jpg" width="80" height="90">
                                        <img src="https://www.colsys.com.co/images/pdf/basc.jpg" width="112" height="90">                                                                    

                                    </p>
                                    </td>
                                    </tr>
                                </table>
                            </div>
                            <p align="justify" style="font-size: 9px; border-width:1px;margin:12px 0 0;padding:4px 4px 12px;">                            
                                Usted ha recibido este mensaje por ser un cliente del grupo empresarial COLTRANS S.A.S, AGENCIA DE ADUANAS COLMAS S.A.S. NIVEL 1, COL OTM S.A.S., COLDEP&Oacute;SITOS LOGISTICA S.A.S. &oacute; COLDEP&Oacute;SITOS BODEGA NACIONAL S.A.S. La información contenida en este correo electrónico y en todos sus archivos anexos, es confidencial y/o privilegiada y sólo puede ser utilizada por la(s) persona(s) a la(s) cual(es) está dirigida. Si usted no es el destinatario autorizado, cualquier modificación, retención, difusión, distribución o copia total o parcial de este mensaje y/o de la información contenida en el mismo y/o en sus archivos anexos está prohibida y son sancionadas por la ley. Si por error recibe este mensaje, le ofrecemos disculpas, sírvase borrarlo de inmediato, notificarle de su error a la persona que lo envió y abstenerse de divulgar su contenido y anexos.
                            </p>
                        </td>
                    </tr>
                </table>
            </table>
        </table>    
    </body>
</html>