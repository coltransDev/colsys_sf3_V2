<?php
$data = $sf_data->getRaw("data");
$asunto = $sf_data->getRaw("asunto");
?>
<!--<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">
<? /* #################################### 
  2. Comunicaciones Noticolmas
  #################################### */ ?>
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasSmall.png">                                                    
                    <div style="font-family:tahoma,sans-serif;display:inline;color:#D99324;font-size: large;vertical-align: top">
                        <b><?= $asunto ?></b>
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
</html>-->

<!--<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
           
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                       <img src="http://www.coltrans.com.co/images/navidad/navidad_2017.jpg">                      
                        
                        <div >                                                        
                            <a href="http://www.coltrans.com.co/">www.coltrans.com.co<a><br/>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>-->

<!--COLTRANS-->
<!--<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coltrans/ColtransMed.png">
                        </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                    IMPLEMENTACIÓN FACTURA ELECTRÓNICA</div></b></font></td></tr></tbody></table>
                </td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <p align="justify">
                            Bogotá, D.C. <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                        
                        </p><br/>
                        <p align="center">
                            <b>APRECIADO CLIENTE</b>
                        </p><br/>
                        <p align="left">    
                            <b>REF.: IMPLEMENTACION FACTURA ELECTRÓNICA</b>
                        </p><br/>
                        <p align="justify">
                            Dando cumplimiento a lo dispuesto por la Dirección de Impuestos y Aduanas Nacionales DIAN; la Empresa Coltrans S.A.S Nit 800.024.075-8 inicia la implementación de la factura electrónica.<br/>
                            De igual manera estamos actualizando información para el cumplimiento de este proceso por lo cual solicitamos suministren los siguientes datos:<br/>
                            <br/>
                            RAZON SOCIAL<br/>
                            NIT<br/>
                            CORREO ELECTRONICO DONDE RECIBIRAN LAS FACTURAS ELECTRONICAS<br/>
                            NOMBRES - APELLIDOS- CARGO - TELEFONO FIJO Y CELULAR DE FUNCIONARIOS AUTORIZADOS PARA REVISAR, ACEPTAR O RECHAZAR LA FACTURA ELECTRONICA<br/>
                            <br/>
                            Es importante que la información suministrada se encuentre en actualización constante a fin de dar cumplimiento a la normatividad vigente que rige la facturación electrónica. <br/>
                            Cualquier información adicional o aclaración al respecto, con gusto será atendida en el correo electrónico:
                        </p><br/>
                        <p align="center">
                            <b>facturacionelectronica@coltrans.com.co</b>
                        </p>
                        <p align="justify">
                            Se solicita adjuntar Rut actualizado y certificado de cámara de comercio de fecha reciente.
                        </p>
                        <p align="justify">
                            Cordial saludo,
                        </p><br/><br/>
                        <p align="left">                            
                            <b>Juan Camilo Ortega Convers</b><br/>
                            <b>Gerente Financiero</b>
                        </p><br/>                        
                        <br/><br/>
                        <p align="justify">
                        <table width="100%"><tr><td>
                        <p align="justify">
                            
                            <img src="https://www.colsys.com.co/images/pdf/iso.jpg" width="80" height="80">
                            <img src="https://www.colsys.com.co/images/pdf/basc.jpg" width="92" height="80">
                            <img src="https://www.colsys.com.co/images/pdf/iata.jpg" width="80" height="60">
                            
                        </p>
                        </td><td>
                        <p align="right" style="font-size: 12px;">                                                       
                            <b>Bogotá D.C.</b><br/>
                            Carrera 98 No 25G-10 Int. 18<br/>
                            Centro Empresarial El Dorado<br/>
                            Pbx: (57-1) 742 5880<br/>                            
                            Cod. Postal: 110911<br/>
                            bogota@coltrans.com.co<br/>
                            www.coltrans.com.co<br/>
                            NIT: 800024075<br/>
                            Cod. DIAN 23<br/>
                        </p>
                        </td></tr></table>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>-->

<!--COLMAS-->
<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasMed.png">
                        </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                            IMPLEMENTACIÓN OPERADOR ECONÓMICO AUTORIZADO (OEA)</div></b></font></td></tr></tbody></table>
                </td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <p align="justify">
                            <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                        
                        </p><br/>
                        <p align="center">
                            <b>APRECIADO CLIENTE</b>
                        </p><br/>
                        <p align="left">    
                            <b>REF.:  Implementación Operador Económico Autorizado (OEA)</b>
                        </p><br/>
                        <p align="justify">
                           Nos permitimos informar que en la AGENCIA DE ADUANAS COLMAS SAS NIVEL 1, nos encontramos aplicando para obtener la certificación de Operador Económico Autorizado que otorga la DIAN, por lo anterior requerimos del apoyo de nuestros asociados de negocio mediante el cumplimiento de requisitos de seguridad en la cadena de suministro. <br/>
                            <br/>
                            Anexo estamos enviamos circular informativa de nuestro proceso de implementación OEA, junto con la solicitud de los documentos que requerimos y que deben ser firmados por representante legal.<br/><br/>
                            Agradecemos él envió de esta documentación a más tardar el 20 de marzo de 2019.<br/>                            
                            Cualquier información adicional o aclaración al respecto, con gusto será atendida en el correo electrónico: <b>pizquierdo@coltrans.com.co</b><br/>
                        </p><br/>                        
                        <p align="justify">
                            Cordial saludo,
                        </p><br/><br/>
                        <p align="left">                            
                            <b>PATRICIA IZQUIERDO URREGO</b><br/>
                            <b>Auditora Nacional</b>
                        </p><br/>                        
                        <br/><br/>
                        <p align="justify">
                        <table width="100%"><tr><td>
                        <p align="justify">                            
                            <img src="https://www.colsys.com.co/images/pdf/iso_colmas.jpg" width="80" height="90">
                            <img src="https://www.colsys.com.co/images/pdf/basc.jpg" width="112" height="90">                            
                        </p>
                        </td><td>
                        <p align="right" style="font-size: 12px;">                                                       
                            <b>Bogotá D.C.</b><br/>
                            Carrera 98 No 25G-10 Int. 18<br/>
                            Centro Empresarial El Dorado<br/>
                            Pbx: (57-1) 742 5880<br/>                            
                            Cod. Postal: 110911<br/>
                            olga.mosquera@colmas.com.co<br/>
                            www.colmas.com.co<br/>
                            NIT: 830003960<br/>
                            Cod. DIAN 72<br/>
                        </p>
                        </td></tr></table>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>
                            
<!--COLOTM-->
<!--<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/colotm/logo_colotm.png">
                        </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                    CIRCULAR RECEPCIÓN FACTURACIÓN ELECTRONICA</div></b></font></td></tr></tbody></table>
                </td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <p align="justify">
                            <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                        
                        </p><br/>
                        <p align="center">
                            <b>APRECIADO CLIENTE</b>
                        </p><br/>
                        <p align="left">    
                            <b>REF.: IMPLEMENTACION FACTURA ELECTRÓNICA</b>
                        </p><br/>
                        <p align="justify">
                            Dando cumplimiento a lo dispuesto por la Dirección de Impuestos y Aduanas Nacionales DIAN; la Empresa COL OTM S.A.S Nit 900.451.936-8 inicia la implementación de la factura electrónica.<br/>
                            De igual manera estamos actualizando información para el cumplimiento de este proceso por lo cual solicitamos suministren los siguientes datos:<br/>
                            <br/>
                            RAZON SOCIAL<br/>
                            NIT<br/>
                            CORREO ELECTRONICO DONDE RECIBIRAN LAS FACTURAS ELECTRONICAS<br/>
                            NOMBRES - APELLIDOS- CARGO - TELEFONO FIJO Y CELULAR DE FUNCIONARIOS AUTORIZADOS PARA REVISAR, ACEPTAR O RECHAZAR LA FACTURA ELECTRONICA<br/>
                            <br/>
                            Es importante que la información suministrada se encuentre en actualización constante a fin de dar cumplimiento a la normatividad vigente que rige la facturación electrónica. <br/>
                            Cualquier información adicional o aclaración al respecto, con gusto será atendida en el correo electrónico:
                        </p><br/>
                        <p align="center">
                            <b>facturacionelectronica@coltrans.com.co</b>
                        </p>
                        <p align="justify">
                            Se solicita adjuntar Rut actualizado y certificado de cámara de comercio de fecha reciente.
                        </p>
                        <p align="justify">
                            Cordial saludo,
                        </p><br/><br/>
                        <p align="left">                            
                            <b>Sandra Lucia Yepes Leon</b><br/>
                            <b>Representante Legal</b>
                        </p><br/>                        
                        <br/><br/>                        
                        <table width="100%"><tr><td>
                        
                        </td><td>
                        <p align="right" style="font-size: 12px;">                                                       
                            <b>Bogotá D.C.</b><br/>
                            Carrera 106 15A-25 Lote 114D Mnz 16 Bodega 2<br/>
                            Zona Franca de Bogotá S.A.<br/>
                            Pbx: (57-1) 742 2360<br/>                            
                            Cod. Postal: 110911<br/>
                            gerencia@colotm.com<br/>
                            www.colotm.com<br/>
                            NIT: 900451936<br/>                            
                        </p>
                        </td></tr></table>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>-->
<!--COLDEPOSITOS LOGISTICA-->
<!--<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coldepositos/ColdepositosMed.jpg">
                        </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                    CIRCULAR RECEPCIÓN FACTURACIÓN ELECTRONICA</div></b></font></td></tr></tbody></table>
                </td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <p align="justify">
                            <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                        
                        </p><br/>
                        <p align="center">
                            <b>APRECIADO CLIENTE</b>
                        </p><br/>
                        <p align="left">    
                            <b>REF.: IMPLEMENTACION FACTURA ELECTRÓNICA</b>
                        </p><br/>
                        <p align="justify">
                            Dando cumplimiento a lo dispuesto por la Dirección de Impuestos y Aduanas Nacionales DIAN; la Empresa COLDEPOSITOS LOGISTICA S.A.S Nit 900.841.486-9 inicia la implementación de la factura electrónica.<br/>
                            De igual manera estamos actualizando información para el cumplimiento de este proceso por lo cual solicitamos suministren los siguientes datos:<br/>
                            <br/>
                            RAZON SOCIAL<br/>
                            NIT<br/>
                            CORREO ELECTRONICO DONDE RECIBIRAN LAS FACTURAS ELECTRONICAS<br/>
                            NOMBRES - APELLIDOS- CARGO - TELEFONO FIJO Y CELULAR DE FUNCIONARIOS AUTORIZADOS PARA REVISAR, ACEPTAR O RECHAZAR LA FACTURA ELECTRONICA<br/>
                            <br/>
                            Es importante que la información suministrada se encuentre en actualización constante a fin de dar cumplimiento a la normatividad vigente que rige la facturación electrónica. <br/>
                            Cualquier información adicional o aclaración al respecto, con gusto será atendida en el correo electrónico:
                        </p><br/>
                        <p align="center">
                            <b>facturacionelectronica@coltrans.com.co</b>
                        </p>
                        <p align="justify">
                            Se solicita adjuntar Rut actualizado y certificado de cámara de comercio de fecha reciente.
                        </p>
                        <p align="justify">
                            Cordial saludo,
                        </p><br/><br/>
                        <p align="left">                            
                            <b>Claudia Medina Flórez</b><br/>
                            <b>Representante Legal</b>
                        </p><br/>                        
                        <br/><br/>
                        <table width="100%"><tr><td>
                        
                        </td><td>
                        <p align="right" style="font-size: 12px;">                                                       
                            <b>Bogotá D.C.</b><br/>
                            Carrera 106 15A-25 Lote 114D Mnz 16 Bodega 2<br/>
                            Zona Franca de Bogotá S.A.<br/>
                            Pbx: (57-1) 742 2360<br/>                            
                            Cod. Postal: 110911<br/>
                            servicioalcliente@coldepositos.com.co<br/>
                            www.coldepositos.com.co<br/>
                            NIT: 900841486<br/>                            
                        </p>
                        </td></tr></table>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>-->

<!--COLDEPOSITOS BODEGA NACIONAL-->
<!--<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body bgcolor="">    
        <table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:tahoma,sans-serif;color: #222">
            <tr><td colspan="5">
                    <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coldepositos/ColdepositosMedBN.png">
                        </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                    CIRCULAR RECEPCIÓN FACTURACIÓN ELECTRONICA</div></b></font></td></tr></tbody></table>
                </td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <p align="justify">
                            <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                        
                        </p><br/>
                        <p align="center">
                            <b>APRECIADO CLIENTE</b>
                        </p><br/>
                        <p align="left">    
                            <b>REF.: IMPLEMENTACION FACTURA ELECTRÓNICA</b>
                        </p><br/>
                        <p align="justify">
                            Dando cumplimiento a lo dispuesto por la Dirección de Impuestos y Aduanas Nacionales DIAN; la Empresa Coldepositos Bodega Nacional SAS Nit 901.016.877-0 inicia la implementación de la factura electrónica.<br/>
                            De igual manera estamos actualizando información para el cumplimiento de este proceso por lo cual solicitamos suministren los siguientes datos:<br/>
                            <br/>
                            RAZON SOCIAL<br/>
                            NIT<br/>
                            CORREO ELECTRONICO DONDE RECIBIRAN LAS FACTURAS ELECTRONICAS<br/>
                            NOMBRES - APELLIDOS- CARGO - TELEFONO FIJO Y CELULAR DE FUNCIONARIOS AUTORIZADOS PARA REVISAR, ACEPTAR O RECHAZAR LA FACTURA ELECTRONICA<br/>
                            <br/>
                            Es importante que la información suministrada se encuentre en actualización constante a fin de dar cumplimiento a la normatividad vigente que rige la facturación electrónica. <br/>
                            Cualquier información adicional o aclaración al respecto, con gusto será atendida en el correo electrónico:
                        </p><br/>
                        <p align="center">
                            <b>facturacionelectronica@coltrans.com.co</b>
                        </p>
                        <p align="justify">
                            Se solicita adjuntar Rut actualizado y certificado de cámara de comercio de fecha reciente.
                        </p>
                        <p align="justify">
                            Cordial saludo,
                        </p><br/><br/>
                        <p align="left">                            
                            <b>Claudia Medina Flórez</b><br/>
                            <b>Representante Legal</b>
                        </p><br/>                        
                        <br/><br/>
                        <table width="100%"><tr><td>
                        
                        </td><td>
                        <p align="right" style="font-size: 12px;">                                                       
                            <b>Bogotá D.C.</b><br/>
                            Carrera 98 No 25G-10 Int. 18<br/>
                            Centro Empresarial El Dorado<br/>
                            Pbx: (57-1) 742 5880<br/>                            
                            Cod. Postal: 110911<br/>
                            servicioalcliente@coldepositos.com.co<br/>
                            www.coldepositos.com.co<br/>
                            NIT: 901016877<br/>
                        </p>
                        </td></tr></table>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>-->
<!--<html>
    <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <div dir="ltr">
            <div class="gmail_quote">
                <div>
                    <table width="80%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1">
                        <tbody><tr><td>
                            <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF">
                                <tbody><tr>
                                    <td colspan="5">
                                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                            <tbody><tr><td colspan="3">
                                                    <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coltrans/ColtransSmall.png">
                                                        </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                                                    &nbsp;Circular Coltrans</div></b></font></td></tr></tbody></table>
                                                    </td></tr>
                                                <tr><td colspan="5"><br><table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:arial,sans-serif"><tbody><tr><td colspan="4">
                                                                        <br><hr noshade size="1"></td></tr><tr><td width="25"></td><td width="110"></td></tr></tbody></table></tr>


                                                <tr>
                                                     <td colspan="5"><br>
                                                     <div style="display:inline;" align="right">
<?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>
                                                                        </div><br/><br/><br/>

                                                        <div style="font-family:tahoma,sans-serif;display:inline">                                                            
                                                            Apreciados proveedores de compras de bienes y/o servicios, adjunto encontrarán circular sobre el tema en asunto para poder dar tramite a sus facturas de venta de bienes y/o servicios.<br/>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="5"><br><table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:arial,sans-serif"><tbody><tr><td colspan="4">
                                                                        <br><hr noshade size="1"></td></tr><tr><td width="25"></td><td width="110"></td></tr></tbody></table></tr>
                                                <tr>                                            
                                                    <td colspan="5">

                                                        <div style="font-family:tahoma,sans-serif;display:inline">                                                    
                                                            DEPARTAMENTO CONTABLE<br>
                                                            COLTRANS S.A.S<br>
                                                            Bogotá - Colombia.<br>
                                                            Cra. 98 No. 25G 10 Int. 18<br>
                                                            Phone: 571 742 5880<br>                                                            
                                                            Código Postal: 110911<br>
                                                            www.coltrans.com.co<br>                                                    
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody></table></td></tr></tbody></table></td></tr></tbody></table>            
                </div>
            </div>
        </div>
        <br /><br />
        <div style="text-align: justify; font-size: 9px; border-width:1px;margin:12px 0 0;padding:4px 4px 12px;">
            Usted ha recibido este mensaje por ser un cliente del grupo empresarial COLTRANS S.A.S, AGENCIA DE ADUANAS COLMAS LTDA Nivel 1 , COL OTM y Coldep&oacute;sitos.<br/>
        La información contenida en este correo electrónico y en todos sus archivos anexos, es confidencial y/o privilegiada y sólo puede ser utilizada por la(s) persona(s) a la(s) cual(es) está dirigida.<br /> 
        Si usted no es el destinatario autorizado, cualquier modificación, retención, difusión, distribución o copia total o parcial de este mensaje y/o de la información contenida en el mismo y/o en sus <br />
        archivos anexos está prohibida y son sancionadas por la ley. Si por error recibe este mensaje, le ofrecemos disculpas, sírvase borrarlo de inmediato, notificarle de su error a la persona que lo <br />
        envió y abstenerse de divulgar su contenido y anexos.
        </div>
    </head>
</html>-->

<!--<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
    <div dir="ltr">
        <div class="gmail_quote">
            <div>
                <table width="80%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1">
                    <tbody><tr><td>
                                <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF">
                                    <tbody><tr>
                                            <td colspan="5">
                                                <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                                    <tbody><tr><td colspan="3">
                                                                <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coltrans/ColtransSmall.png">
                                                                            </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                                                                                        &nbsp;Circular Clientes</div></b></font></td></tr></tbody></table>
                                                            </td></tr>
                                                        <tr><td colspan="5"><br><table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:arial,sans-serif"><tbody><tr><td colspan="4">
                                                                                <br><hr noshade size="1"></td></tr><tr><td width="25"></td><td width="110"></td></tr></tbody></table></tr>


                                                        <tr>
                                                            <td colspan="5"><br>
                                                                <div style="display:inline;" align="right">
                                                                    <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                     
                                                                </div><br/><br/><br/>

                                                                <div style="font-family:tahoma,sans-serif;display:inline">                   
                                                                    <p>Estimado Cliente:</p>

                                                                    <p>Solicitamos su colaboraci&oacute;n con la expedici&oacute;n de los certificados de retenci&oacute;n en la fuente de IVA, ICA y RENTA correspondientes al periodo y/o bimestres del a&ntilde;o 2017, practicados a nombre de alguna de las siguientes compa&ntilde;&iacute;as:</p>                                                            
                                                                    <p>&nbsp;</p>
                                                                    <p>COLTRANS SAS con NIT 800.024.075-8</p>
                                                                    <p>COLDEPOSITOS LOG&Iacute;STICA SAS con NIT: 900.841.486-9</p>
                                                                    <p>AGENCIA DE ADUANAS COLMAS SAS NIVEL 1 con NIT: 830.003.960-0</p>
                                                                    <p>COL OTM SAS con NIT 900.451.936-8</p>
                                                                    <p>COLDEPOSITOS BODEGA NACIONAL SAS con NIT: 901.016.877-9</p>                                                            
                                                                    <p>Dicho certificado debe ser expedido seg&uacute;n art&iacute;culo 30 del decreto 2634 del 17 de diciembre del 2012.</p>
                                                                    <p>&nbsp;</p>
                                                                    <p>Por favor entregar estos certificados a la persona que presente esta carta y sello de la compa&ntilde;&iacute;a, o remitir al correo electr&oacute;nico <a href="mailto:eshilarion@coltrans.com.co">eshilarion@coltrans.com.co</a>.&nbsp;</p>
                                                                    <p>Gracias por su valiosa colaboraci&oacute;n.</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr><td colspan="5"><br><table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:arial,sans-serif"><tbody><tr><td colspan="4">
                                                                                <br><hr noshade size="1"></td></tr><tr><td width="25"></td><td width="110"></td></tr></tbody></table></tr>
                                                        <tr>                                            
                                                            <td colspan="5">

                                                                <div style="font-family:tahoma,sans-serif;display:inline">                                                    
                                                                    DEPARTAMENTO CONTABLE<br>
                                                                    COLTRANS S.A.S<br>
                                                                    Bogotá - Colombia.<br>
                                                                    Cra. 98 No. 25G 10 Int. 18<br>
                                                                    Phone: 571 742 5880<br>                                                                    
                                                                    Código Postal: 110911<br>
                                                                    www.coltrans.com.co<br>                                                    
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody></table></td></tr></tbody></table></td></tr></tbody></table>            
            </div>
        </div>
    </div>
    <br /><br />
    <div style="text-align: justify; font-size: 9px; border-width:1px;margin:12px 0 0;padding:4px 4px 12px;">
        Usted ha recibido este mensaje por ser un cliente del grupo empresarial COLTRANS S.A.S, AGENCIA DE ADUANAS COLMAS LTDA Nivel 1 , COL OTM y Coldep&oacute;sitos.<br/>
        La información contenida en este correo electrónico y en todos sus archivos anexos, es confidencial y/o privilegiada y sólo puede ser utilizada por la(s) persona(s) a la(s) cual(es) está dirigida.<br /> 
        Si usted no es el destinatario autorizado, cualquier modificación, retención, difusión, distribución o copia total o parcial de este mensaje y/o de la información contenida en el mismo y/o en sus <br />
        archivos anexos está prohibida y son sancionadas por la ley. Si por error recibe este mensaje, le ofrecemos disculpas, sírvase borrarlo de inmediato, notificarle de su error a la persona que lo <br />
        envió y abstenerse de divulgar su contenido y anexos.
    </div>
    </head>
</html>-->


<!--<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
        <div dir="ltr">
            <div class="gmail_quote">
                <div>                    
                    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF">
                        <tbody><tr>
                        <td colspan="5">
                        <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tbody><tr><td colspan="3">
                            <table><tbody><tr><td><img src="http://www.coltrans.com.co/logosoficiales/coltrans/ColtransSmall.png">
                            </td><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b><div style="font-family:tahoma,sans-serif;display:inline">
                            &nbsp;Circular Proveedores</div></b></font></td></tr></tbody></table>
                            </td></tr>
                            <tr><td colspan="5"><br><table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:arial,sans-serif"><tbody><tr><td colspan="4">
                            <br><hr noshade size="1"></td></tr><tr><td width="25"></td><td width="110"></td></tr></tbody></table></tr>
                        <tr>
                            <td colspan="5"><br>
                                <div style="display:inline;" align="right">
                                    <?= date("d") ?> de <?= Utils::mesLargo(date("m")) ?> de <?= date("Y") ?>                                                                     
                                </div><br/><br/><br/>

                                <div style="font-family:tahoma,sans-serif;display:inline">                   
                                    <p>Estimados Proveedores<br /><br />
                                        Con el fin de incluir en nuestro sistema &eacute;sta informaci&oacute;n y dar cumplimiento a reglamentaciones internas BASC/ISO, agradecemos nos puedan enviar los siguientes documentos por este medio:<br /><br />
                                        1. Estados Financieros con corte a Diciembre 2017 de su compa&ntilde;&iacute;a.<br /><br />
                                        Agradecemos su apoyo y quedamos atentos a su importante colaboraci&oacute;n<br /><br />
                                        NOTA: En el caso de ya haber enviado está documentación a Coltrans, por favor hacer caso omiso a este mensaje.<br /><br /><br />

                                        Pricing &amp; Procurement<br />
                                        COLTRANS S.A.S<br />
                                        Cra 98 No. 25G-10 Int 18<br />
                                        C&oacute;digo postal: 110911<br />
                                        Tel: 4239300 Ext. 526<br />
                                        Bogot&aacute; D.C. Colombia<br />
                                        www.coltrans.com.co
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr><td colspan="5"><br><table width="100%" border="0" cellspacing="5" cellpadding="0" style="font-family:arial,sans-serif"><tbody><tr><td colspan="4">
                                                <br><hr noshade size="1"></td></tr><tr><td width="25"></td><td width="110"></td></tr></tbody></table></tr>

                    </tbody></table></td></tr></tbody></table>          
                </div>
            </div>
        </div>
        <br /><br />
        <div style="text-align: justify; font-size: 9px; border-width:1px;margin:12px 0 0;padding:4px 4px 12px;">
            Usted ha recibido este mensaje por ser un cliente y/o proveedor del grupo empresarial COLTRANS S.A.S, AGENCIA DE ADUANAS COLMAS LTDA Nivel 1 , COL OTM y Coldep&oacute;sitos.<br/>
            La información contenida en este correo electrónico y en todos sus archivos anexos, es confidencial y/o privilegiada y sólo puede ser utilizada por la(s) persona(s) a la(s) cual(es) está dirigida.<br /> 
            Si usted no es el destinatario autorizado, cualquier modificación, retención, difusión, distribución o copia total o parcial de este mensaje y/o de la información contenida en el mismo y/o en sus <br />
            archivos anexos está prohibida y son sancionadas por la ley. Si por error recibe este mensaje, le ofrecemos disculpas, sírvase borrarlo de inmediato, notificarle de su error a la persona que lo <br />
            envió y abstenerse de divulgar su contenido y anexos.
        </div>
    </head>
</html>-->