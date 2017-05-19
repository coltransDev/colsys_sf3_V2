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
                    <!--<img src="http://www.coltrans.com.co/logosoficiales/colmas/ColmasMed.png" align="right">-->
                <!--</td></tr>
            <tr><td><hr noshade size="1"></td></tr>
            <tr>
                <td style="padding:20px">
                    <div style="text-align: justify;font-size: 12px">
                        <p>Estimados proveedores<br /><br />
                            Con el fin de incluir en nuestro sistema &eacute;sta informaci&oacute;n y dar cumplimiento a reglamentaciones internas BASC/ISO, agradecemos nos puedan enviar los siguientes documentos por este medio:<br /><br />1. Estados Financieros a&ntilde;o 2016 de su compa&ntilde;&iacute;a.<br /><br />
                            Agradecemos su apoyo y quedamos atentos a su importante colaboraci&oacute;n<br /><br />
                        </p>
                        <div>
                            Pricing &amp; Procurement<br />
                            <strong>COLTRANS S.A.S</strong><br />
                            Cra 98 No. 25G-10 Int 18<br />
                            C&oacute;digo postal: 110911<br />
                            Tel: 4239300 Ext. 526<br />
                            Bogot&aacute; D.C. Colombia<br />
                            <a style="color: #1155cc;" href="mailto:tdiaz@coltrans.com.co" target="_blank">tdiaz@coltrans.com.co</a><br />
                            <a style="color: #1155cc;" href="http://www.coltrans.com.co/" target="_blank">www.coltrans.com.co</a></div>
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