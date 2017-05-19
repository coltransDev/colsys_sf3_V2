<html>
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
                            <a href="https://www.colsys.com.co/formulario/servicios/id/<?php echo base64_encode($idformulario) ?>/co/<?php echo base64_encode($contacto) ?>">Encuesta de servicio</a>
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
</html>