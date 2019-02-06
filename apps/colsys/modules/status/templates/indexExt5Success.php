<?
$permisos = $sf_data->getRaw("permisos");
$inoMaster = $sf_data->getRaw("inoMaster");
$modulo = $sf_data->getRaw("modulo");

//echo json_encode($permisos);


//{"maritimo":{"llegada":{"valor":true,"detalle":"Confirmaci\u00f3n de Llegada","texto":"Respetado cliente buenos d\u00edas, confirmamos la llegada de su carga con la siguiente informaci\u00f3n.\n"},"status":{"valor":true,"detalle":"Status","texto":""},"ffletes":{"valor":true,"detalle":"Factura de Fletes","texto":"Adjunto enviamos la Factura  de la importaci\u00f3n mar\u00edtima  en referencia, la cual es soporte de certificaci\u00f3n de fletes ante la DIAN.\/n Cualquier informaci\u00f3n adicional con gusto ser\u00e1 suministrada.\n"},"fotm":{"valor":true,"detalle":"Factura de Otm","texto":"Adjunto enviamos la Factura de tr\u00e1mite OTM.\n"},"fcontenedores":{"valor":true,"detalle":"Factura de Contenedores","texto":"Adjunto enviamos la Factura de Contenedores.\n"},"desconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n","texto":"Nos complace informar que hemos terminado nuestro proceso de desconsolidaci\u00f3n y que la carga del asunto, se encuentra disponible para pasar a la siguiente fase dentro de su proceso de importaci\u00f3n.\n"},"planilla":{"valor":true,"detalle":"Notificaci\u00f3n de Planilla","texto":"Nos permitimos informar el n\u00famero de planilla de env\u00edo asignado por la DIAN - Muisca,  con el fin de que prosiga su proceso de nacionalizaci\u00f3n.\n"},"contenedores":{"valor":true,"detalle":"Contenedores","texto":""},"pllegada":{"valor":true,"detalle":"Llegada Puerto","texto":"Buenos d\u00edas: \/n Puerto notifica la llegada a puerto de la(s) carga(s) con el siguiente registro:\n"},"pdesconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n Puerto","texto":""},"pplanilla":{"valor":true,"detalle":"Planilla Puerto","texto":""},"dian":{"valor":true,"detalle":"DIAN 1207","texto":""},"otm":{"valor":true,"detalle":"Status Otm","texto":""}},"otm":{"llegada":{"valor":true,"detalle":"Confirmaci\u00f3n de Llegada","texto":"Respetado cliente buenos d\u00edas, confirmamos la llegada de su carga con la siguiente informaci\u00f3n.\n"},"status":{"valor":true,"detalle":"Status","texto":""},"ffletes":{"valor":true,"detalle":"Factura de Fletes","texto":"Adjunto enviamos la Factura  de la importaci\u00f3n mar\u00edtima  en referencia, la cual es soporte de certificaci\u00f3n de fletes ante la DIAN.\/n Cualquier informaci\u00f3n adicional con gusto ser\u00e1 suministrada.\n"},"fotm":{"valor":true,"detalle":"Factura de Otm","texto":"Adjunto enviamos la Factura de tr\u00e1mite OTM.\n"},"fcontenedores":{"valor":true,"detalle":"Factura de Contenedores","texto":"Adjunto enviamos la Factura de Contenedores.\n"},"desconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n","texto":"Nos complace informar que hemos terminado nuestro proceso de desconsolidaci\u00f3n y que la carga del asunto, se encuentra disponible para pasar a la siguiente fase dentro de su proceso de importaci\u00f3n.\n"},"planilla":{"valor":true,"detalle":"Notificaci\u00f3n de Planilla","texto":"Nos permitimos informar el n\u00famero de planilla de env\u00edo asignado por la DIAN - Muisca,  con el fin de que prosiga su proceso de nacionalizaci\u00f3n.\n"},"contenedores":{"valor":true,"detalle":"Contenedores","texto":""},"pllegada":{"valor":true,"detalle":"Llegada Puerto","texto":"Buenos d\u00edas: \/n Puerto notifica la llegada a puerto de la(s) carga(s) con el siguiente registro:\n"},"pdesconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n Puerto","texto":""},"pplanilla":{"valor":true,"detalle":"Planilla Puerto","texto":""},"dian":{"valor":true,"detalle":"DIAN 1207","texto":""},"otm":{"valor":true,"detalle":"Status Otm","texto":""}}}
//echo json_encode($permisos);
//print_r($permisos);
?>
<style>

    [id^="grid-fotos-"] .x-panel-body{
        background: white;
        font: 11px Arial, Helvetica, sans-serif;
    }
    [id^="grid-fotos-"] .thumb{
        background: #dddddd;
        padding: 3px;
        padding-bottom: 0;
    }

    .x-quirks [id^="grid-fotos-"] .thumb {
        padding-bottom: 3px;
    }

    [id^="grid-fotos-"] .thumb img{
        height: 60px;
        width: 80px;
    }
    [id^="grid-fotos-"] .thumb-wrap{
        float: left;
        margin: 4px;
        margin-right: 0;
        padding: 5px;
    }
    [id^="grid-fotos-"] .thumb-wrap span {

        display: block;
        overflow: hidden;
        text-align: center;
        width: 86px; /* for ie to ensure that the text is centered */
    }

    [id^="grid-fotos-"] .x-item-over{
        border:1px solid #dddddd;
        background: #efefef url(over.gif) repeat-x left top;
        padding: 4px;
    }

    [id^="grid-fotos-"] .x-item-selected{
        background: #eff5fb url(selected.gif) no-repeat right bottom;
        border:1px solid #99bbe8;
        padding: 4px;
    }
    [id^="grid-fotos-"] .x-item-selected .thumb{
        background:transparent;
    }

    [id^="grid-fotos-"] .loading-indicator {
        font-size:11px;
        background-image:url('../../resources/themes/images/default/grid/loading.gif');
        background-repeat: no-repeat;
        background-position: left;
        padding-left:20px;
        margin:10px;
    }

    .x-view-selector {
        position:absolute;
        left:0;
        top:0;
        width:0;
        border:1px dotted;
        opacity: .5;
        -moz-opacity: .5;
        filter:alpha(opacity=50);
        zoom:1;
        background-color:#c3daf9;
        border-color:#3399bb;
    }
    .ext-strict .ext-ie .x-tree .x-panel-bwrap{
        position:relative;
        overflow:hidden;
    }
    .x-editable {
        color: #000;
    }

    /*    .global .x-tool-global{
            background-image: url("/images/CG30.png") !important;
            width: 35px;
            height: 35px;        
            position: absolute;
            top: 0;
            left: -90px;
    
            background-repeat: no-repeat;        
        }
        
        .com .x-tool-com{
            background-image: url("/images/consolidate.png") !important;
            width: 35px;
            height: 35px;        
            position: absolute;
            top: 0;
            left: -60px;
    
            background-repeat: no-repeat;        
        }  */

    .text-wrapper {
        position: relative;
        overflow: visible;
        background-color: #5097CA;
        border-radius: 3px;
        width: 100%;


        word-wrap: break-word;
        white-space: pre-wrap;
        /* CSS3 */
        /*white-space: -moz-pre-wrap; /* Firefox */
        /*white-space: -pre-wrap;     /* Opera <7 */
        /*white-space: -o-pre-wrap;   /* Opera 7 */
        /*word-wrap: break-word;      /* IE */
    }
    .text-wrapper .news-icon {
        width: 35px;
        height: 35px;
        margin-top: 15px;
        position: absolute;
        top: 0;
        left: 0;

        background-repeat: no-repeat;
        background-size: contain;
    }

    .text-wrapper .global {
        width: 35px;
        height: 35px;
        margin-top: 15px;
        position: absolute;
        top: 0;
        left: 0;

        background-repeat: no-repeat;
        background-size: contain;
    }

    .news {
        background-image: url("/js/Colsys/Status/resources/icons/news-icon.png") !important;
    }

    .global {
        background-image: url("/images/CG30.png") !important;
    }

    .forum {
        background-image: url("/js/Colsys/Status/resources/icons/forum-icon.png") !important;
    }

    .x-ie8 & {
        background-image: url("/js/Colsys/Status/resources/icons/forum-icon-small.png") !important;
    }


    .text-wrapper .news-data {
        background-color: #ffffff;
        margin: 0 0 8px 10px;
        padding: 15px;
        border-radius: 3px;

        -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.25);
        -moz-box-shadow:    0px 1px 1px 0px rgba(0, 0, 0, 0.25);
        box-shadow:         0px 1px 1px 0px rgba(0, 0, 0, 0.25);
    }

    [id^="header-panel-"].x-autocontainer-innerCt {
        background-color: #5097CA;
        border-radius: 3px;
    }

    [id^="header-panel-"].x-autocontainer-outerCt {
        width: 100%;
    }

        
        

    /*.prueba {
        background-color: #ffffff;
        margin: 0 0 8px 55px;
        width: 95%;
        padding: 15px;
        border-radius: 3px;
        
        //margin-right: 20px;
        //padding: 0px;
        //overflow: visible;

        -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.25);
        -moz-box-shadow:    0px 1px 1px 0px rgba(0, 0, 0, 0.25);
        box-shadow:         0px 1px 1px 0px rgba(0, 0, 0, 0.25);
        
        //background-color: #ffffff;
        min-height: 20px;
        overflow: hidden;
        font-weight: 400;
        //margin-top: 20px;
    }*/

    .text-wrapper .news-content {
        margin-left: 50px;
    }

    .text-wrapper .news-author {
        text-transform: uppercase;
    }

    .text-wrapper .news-paragraph {
        background-color: #ffffff;
        min-height: 20px;
        overflow: hidden;
        font-weight: 400;
        margin-top: 20px;
    }

    .text-wrapper .news-picture {
        width: 35px;
        height: 35px;
        background-color:#ececec;
        float: left;
        border-radius: 3px;
        overflow: hidden;
        -webkit-box-sizing: border-box;
    }

    .text-wrapper .news-picture img {
        width: 35px;
    }

    /*    .text-wrapper .news-toggle {
            text-align: right;
            margin-top: 15px;
        }
        .text-wrapper .news-toggle span {
                color: #2e6eaf;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                width: 100px;
                display: inline-block;
            }
    
        .text-wrapper .news-toggle img {
                height: 14px;
                vertical-align: middle;
                margin: 0 5px 0 5px;
            }*/

    .app-dashboard {
        background-image: url(/js/Colsys/Status/resources/images/square.gif);
    }

    .app-dashboard1 {
        background-image: url(/js/Colsys/Status/resources/images/square2.gif);
    }
    /*.company-news-grid {
    
        margin: 20px 0 0 20px;
    }
        .company-news-grid .x-grid-row-expanded .x-grid-row .news-data {
            margin-bottom: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
    
        .company-news-grid .x-grid-body {
            text-transform: none;
        }
    
        .company-news-grid .x-toolbar-default {
            background-color: #ececec;
        }
    
        .company-news-grid .x-grid-item {
            border: 0px !important;
            border-bottom: 0px;
            background-color: transparent;
        }
    
        .company-news-grid .x-grid-item:last-child {
            margin-bottom: 15px;
        }
    
        .company-news-grid .x-grid-cell-inner {
            margin-right: 20px;
            padding: 0px;
            overflow: visible;
        }
    
        .company-news-grid .x-grid-view {
            background-color: #ececec;
            background-image: url("/js/Colsys/Status/resources/icons/icon-line-bg.png");
            background-size: 9px 9px;
            background-repeat: repeat-y;
            background-position: 37px 20px;
        }
        
        .company-news-grid .x-grid-view:before {
            content: '';
            background-color: #ececec;
            width: 50px;
            height: 20px;
            position: absolute;
        }
    
        .company-news-grid .x-grid-with-row-lines {
            border-top: none;
        }
    
        .company-news-grid .x-grid-row {
            background-color: transparent;
            outline: none;
        }
    
        .company-news-grid .x-grid-item-selected > tbody > .x-grid-row, .x-grid-item-over > tbody > .x-grid-row {
            outline: none;
        }
    
        .company-news-grid .x-grid-item.x-grid-item-over {
            background-color: none;
            border: none;
        }
    
        .company-news-grid .x-grid-item-container {
             border-top: 0px;
        }
    
        .company-news-grid .x-grid-rowbody {
            padding-left: 0;
            padding-top: 0;
            margin-right: 5px;
        }
        .company-news-grid .x-grid-rowbody .news-data {
                padding-top: 5px;
                margin-bottom: 3px;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
            }
        .company-news-grid .x-grid-rowbody .news-paragraph {
                margin-left: 50px;
                margin-top: 0;
            }
        
    
        
        .company-news-grid .x-grid-item-focused .news-content {
                z-index: 1;
                position: relative;
            }
        .company-news-grid .x-grid-item-focused .news-content:before {
                content: "";
                position: absolute;
                z-index: -1;
                top: -1px;
                right: -1px;
                bottom: -5px;
                left: -5px;
    
                
            }
        .company-news-grid .x-grid-item-focused .x-grid-cell-inner:before {
                display: none;
            }
    */


    .news-picture {
        width: 35px;
        height: 35px;
        background-color: #ececec;
        float: left;
        border-radius: 3px;
        overflow: hidden;
    }

    .news-picture img {
        width: 35px;
    }


    /*    .exec-news-icon {
            background-image: url("/js/Colsys/Status/resources/icons/news.png");
        }
        .exec-news-icon .x-ie8 & {
                background-image: url("/js/Colsys/Status/resources/icons/news-small.png");
            }*/

    .news-title {
        font-size: 20px;
        line-height: 20px;
        color: #3e4752;
        margin-bottom: 5px;
    }

    .news-small {
        font-size: 11px;
        color: #878ea2;


    }

    .news-small img {
        vertical-align: top;
        margin: 0 5px 0 10px;
        height: 12px;
    }

    /*    .news-toggle {
            text-align: right;
            margin-top: 15px;
        }
        .news-toggle span {
            color: #2e6eaf;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            width: 100px;
            display: inline-block;
    
        }
    
        .news-toggle img {
            height: 14px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }*/

    .news-paragraph {
        background-color: #ffffff;
        min-height: 20px;
        overflow: hidden;
        font-weight: 400;
        margin-top: 20px;
    }

    /*    .news-data {
            background-color:#ffffff;
            margin: 0 0 8px 55px;
            padding: 15px;
            border-radius: 3px;
    
            -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.25);
            -moz-box-shadow:    0px 1px 1px 0px rgba(0, 0, 0, 0.25);
            box-shadow:         0px 1px 1px 0px rgba(0, 0, 0, 0.25);
        }*/

    /*    .grid-small .x-toolbar-default {
            background-color: #fff;
        }
    
        .grid-small .x-grid-item {
            border: 0px !important;
            border-bottom: 0px;
            background-color: transparent;
        }
    
        .grid-small .x-grid-item:last-child {
            margin-bottom: 15px;
        }
    
        .grid-small .x-grid-cell-inner {
            margin-right: 20px;
            padding: 0px;
            overflow: visible;
        }
    
        .grid-small .x-grid-view {
            background-color: #fff;
            background-image:  none;        
            background-repeat: no-repeat;        
        }
        
        .grid-small .x-grid-view:before {
            content: '';
            background-color: #fff;
            width: 50px;
            height: 20px;
            position: absolute;
        }
    
        .grid-small .x-grid-with-row-lines {
            border-top: 1px;
        }
    
        .grid-small .x-grid-row {
            background-color: transparent;
            outline: none;
        }
    
        .grid-small .x-grid-item-selected > tbody > .x-grid-row, .x-grid-item-over > tbody > .x-grid-row {
            outline: none;
        }
    
        .grid-small .x-grid-item.x-grid-item-over {
            background-color: none;
            border: 1px;
        }
    
        .grid-small .x-grid-item-container {
             border-top: 1px;
        }
    
        .grid-small .x-grid-rowbody {
            padding-left: 0;
            padding-top: 0;
            margin-right: 5px;
        }
        .grid-small .x-grid-rowbody .news-data {
                padding-top: 5px;
                margin-bottom: 3px;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
            }
        .grid-small .x-grid-rowbody .news-paragraph {
                margin-left: 50px;
                margin-top: 0;
            }
        
    
        
        .grid-small .x-grid-item-focused .news-content {
                z-index: 1;
                position: relative;
            }
        .grid-small .x-grid-item-focused .news-content:before {
                content: "";
                position: absolute;
                z-index: -1;
                top: -1px;
                right: -1px;
                bottom: -5px;
                left: -5px;
    
                
            }
        .grid-small .x-grid-item-focused .x-grid-cell-inner:before {
                display: none;
            }
    
    */

</style>
<!--<script  src="/js/ckeditor/ckeditor.js" ></script>-->
<script src="https://use.fontawesome.com/c696ddcd4e.js"></script>

<script>
    
    var permisosC = Ext.decode('<?= json_encode($permisos) ?>');
    //var permisosC = Ext.decode('{"maritimo":{"llegada":{"valor":true,"detalle":"Confirmaci\u00f3n de Llegada","texto":"Respetado cliente buenos d\u00edas: \\nConfirmamos la llegada de su carga con la siguiente informaci\u00f3n.\\n","textotm":{"COL-0000":"Como requisito indispensable para efectuar el OTM necesitamos los siguientes documentos:\\n- HBL original\\n- Copia Factura Comercial con T\u00e9rmino de Negociaci\u00f3n\\n- Copia Lista de Empaque\\n- Copia P\u00f3liza de Seguro\\n- Certificaci\u00f3n posici\u00f3n arancelaria y\/o registro de importaci\u00f3n\\n- Valor CIF de la mercanc\u00eda\\n\\nSi su mercanc\u00eda requiere tramite Invima favor enviar original del certificado del proveedor de mercanc\u00eda apta para el consumo humano + el registro de importaci\u00f3n.\\n\\nSi los documentos ya han sido enviados, favor omitir este mensaje.\\n\\nCualquier informaci\u00f3n adicional respecto al OTM favor contactar a Sandra Yepes Sucursal Bogot\u00e1 Tel: (57 1) 4 239 300 - Ext 127 \u00f3 al correo syepes@coltrans.com.co","BAQ-0005":"Como requisito indispensable para efectuar el OTM necesitamos los siguientes documentos:\\n- HBL original\\n- Copia Factura Comercial con T\u00e9rmino de Negociaci\u00f3n\\n- Copia Lista de Empaque\\n- Copia P\u00f3liza de Seguro\\n- Certificaci\u00f3n posici\u00f3n arancelaria y\/o registro de importaci\u00f3n\\n- Valor CIF de la mercanc\u00eda\\n\\nSi su mercanc\u00eda requiere tramite Invima favor enviar original del certificado del proveedor de mercanc\u00eda apta para el consumo humano + el registro de importaci\u00f3n.\\n\\nSi los documentos ya han sido enviados, favor omitir este mensaje.\\n\\nCualquier informaci\u00f3n adicional respecto al OTM favor contactar a ","BOG-0001":"Como requisito indispensable para efectuar el OTM necesitamos los siguientes documentos:\\n- HBL original\\n- Copia Factura Comercial con T\u00e9rmino de Negociaci\u00f3n\\n- Copia Lista de Empaque\\n- Copia P\u00f3liza de Seguro\\n- Certificaci\u00f3n posici\u00f3n arancelaria y\/o registro de importaci\u00f3n\\n- Valor CIF de la mercanc\u00eda\\n\\nSi su mercanc\u00eda requiere tramite Invima favor enviar original del certificado del proveedor de mercanc\u00eda apta para el consumo humano + el registro de importaci\u00f3n.\\n\\nSi los documentos ya han sido enviados, favor omitir este mensaje.\\n\\nCualquier informaci\u00f3n adicional respecto al OTM favor contactar a Sandra Yepes Ext 127, Diana Vargas Ext. 161, Cesar Hidalgo ext 260 \u00f3 al correo syepes@coltrans.com.co, otmmed2@colotm.com, otmbun1@coltrans.com.co","CLO-0002":"Como requisito indispensable para efectuar el OTM necesitamos los siguientes documentos:\\n- HBL original\\n- Copia Factura Comercial con T\u00e9rmino de Negociaci\u00f3n\\n- Copia Lista de Empaque\\n- Copia P\u00f3liza de Seguro\\n- Certificaci\u00f3n posici\u00f3n arancelaria y\/o registro de importaci\u00f3n\\n- Valor CIF de la mercanc\u00eda\\n\\nSi su mercanc\u00eda requiere tramite Invima favor enviar original del certificado del proveedor de mercanc\u00eda apta para el consumo humano + el registro de importaci\u00f3n.\\n\\nSi los documentos ya han sido enviados, favor omitir este mensaje.\\n\\nCualquier informaci\u00f3n adicional respecto al OTM favor contactar a Departamento Mar\u00edtimo Coltrans S.A.","MDE-0004":"Como requisito indispensable para efectuar el OTM necesitamos los siguientes documentos:\\n- HBL original\\n- Copia Factura Comercial con T\u00e9rmino de Negociaci\u00f3n\\n- Copia Lista de Empaque\\n- Copia P\u00f3liza de Seguro\\n- Certificaci\u00f3n posici\u00f3n arancelaria y\/o registro de importaci\u00f3n\\n- Valor CIF de la mercanc\u00eda\\n\\nSi su mercanc\u00eda requiere tramite Invima favor enviar original del certificado del proveedor de mercanc\u00eda apta para el consumo humano + el registro de importaci\u00f3n.\\n\\nSi los documentos ya han sido enviados, favor omitir este mensaje.\\n\\nCualquier informaci\u00f3n adicional respecto al OTM favor contactar a Jean Pierre Uribe Ardila Ext 165 al correo otmmed1@coltrans.com.co o Yeison Bernal Ext: 161 al correo otmmed2@coltrans.com.co"}},"status":{"valor":true,"detalle":"Status","texto":"Respetado Cliente Buenos d\u00edas: \\n"},"ffletes":{"valor":true,"detalle":"Factura de Fletes","texto":{"fletes":"Respetado","cfletes":"Cliente Buenos","rlocales":"Nos permitimos"}},"fotm":{"valor":true,"detalle":"Factura de Otm","texto":"Respetado Cliente Buenos d\u00edas: \\nAdjunto enviamos la Factura de tr\u00e1mite OTM."},"fcontenedores":{"valor":true,"detalle":"Factura de Contenedores","texto":"Respetado Cliente Buenos d\u00edas: \\nAdjunto enviamos la Factura de Contenedores."},"desconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n","texto":"Respetado Cliente Buenos d\u00edas: \\nNos complace informar que hemos terminado nuestro proceso de desconsolidaci\u00f3n y que la carga del asunto, se encuentra disponible para pasar a la siguiente fase dentro de su proceso de importaci\u00f3n."},"planilla":{"valor":true,"detalle":"Notificaci\u00f3n de Planilla","texto":"Respetado Cliente Buenos d\u00edas: \\nNos permitimos informar el n\u00famero de planilla de env\u00edo asignado por la DIAN - Muisca, con el fin de que prosiga su proceso de nacionalizaci\u00f3n."},"contenedores":{"valor":true,"detalle":"Contenedores","texto":"Respetado Cliente Buenos d\u00edas: \\n"},"pto-llegada":{"valor":true,"detalle":"Llegada Puerto","texto":"Buenos d\u00edas: \\nSe notifica que la carga arrib\u00f3 con la siguiente informaci\u00f3n:\\n"},"pto-desconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n Puerto","texto":"Buenos d\u00edas: \\nSe desconsolid\u00f3 la carga con la siguiente informaci\u00f3n:"},"pto-planilla":{"valor":true,"detalle":"Planilla Puerto","texto":"Buenos d\u00edas: \\nNotificaci\u00f3n de los n\u00fameros de planilla de envio asignados por la DIAN\\n"},"pto-dian":{"valor":true,"detalle":"DIAN 1207","texto":"Buenos d\u00edas: \\nNotificaci\u00f3n del formulario de la DIAN 1207\\n"},"otm":{"valor":true,"detalle":"Status Otm","texto":"Buenos d\u00edas: \\n"}},"otm":{"llegada":{"valor":true,"detalle":"Confirmaci\u00f3n de Llegada","texto":"Respetado cliente buenos d\u00edas: \\nConfirmamos la llegada de su carga con la siguiente informaci\u00f3n.\\n"},"status":{"valor":true,"detalle":"Status","texto":"Respetado Cliente Buenos d\u00edas: \\n"},"ffletes":{"valor":true,"detalle":"Factura de Fletes","texto":"{\"fletes\": \"Respetado\", \"cfletes\": \"Cliente Buenos\", \"rlocales\":\"Nos permitimos\"}"},"fotm":{"valor":true,"detalle":"Factura de Otm","texto":"Respetado Cliente Buenos d\u00edas: \\nAdjunto enviamos la Factura de tr\u00e1mite OTM."},"fcontenedores":{"valor":true,"detalle":"Factura de Contenedores","texto":"Respetado Cliente Buenos d\u00edas: \\nAdjunto enviamos la Factura de Contenedores."},"desconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n","texto":"Respetado Cliente Buenos d\u00edas: \\nNos complace informar que hemos terminado nuestro proceso de desconsolidaci\u00f3n y que la carga del asunto, se encuentra disponible para pasar a la siguiente fase dentro de su proceso de importaci\u00f3n."},"planilla":{"valor":true,"detalle":"Notificaci\u00f3n de Planilla","texto":"Respetado Cliente Buenos d\u00edas: \\nNos permitimos informar el n\u00famero de planilla de env\u00edo asignado por la DIAN - Muisca, con el fin de que prosiga su proceso de nacionalizaci\u00f3n."},"contenedores":{"valor":true,"detalle":"Contenedores","texto":"Respetado Cliente Buenos d\u00edas: \\n"},"pto-llegada":{"valor":true,"detalle":"Llegada Puerto","texto":"Buenos d\u00edas: \\nSe notifica que la carga arrib\u00f3 con la siguiente informaci\u00f3n:\\n"},"pto-desconsolidacion":{"valor":true,"detalle":"Desconsolidaci\u00f3n Puerto","texto":"Buenos d\u00edas: \\nSe desconsolid\u00f3 la carga con la siguiente informaci\u00f3n:"},"pto-planilla":{"valor":true,"detalle":"Planilla Puerto","texto":"Buenos d\u00edas: \\nNotificaci\u00f3n de los n\u00fameros de planilla de envio asignados por la DIAN\\n"},"pto-dian":{"valor":true,"detalle":"DIAN 1207","texto":"Buenos d\u00edas: \\nNotificaci\u00f3n del formulario de la DIAN 1207\\n"},"otm":{"valor":true,"detalle":"Status Otm","texto":"Buenos d\u00edas: \\n"}}}');
    console.log(permisosC);

    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            //'Ext.ux.exporter': '../js/ext5/examples/ux/exporter/',
            'Colsys': '/js/Colsys',
            //'Ext.data': '/js/ext6/packages/core/src/data',
            //'Ext.util': '/js/ext6/packages/core/src/util'//,
                    //'Ext.grid.plugin.RowExpander':'/js/ext6/classic/classic/src/grid/plugin/RowExpander.js',
                    //'Ext.grid.plugin.RowWidget':'/js/ext6/classic/classic/src/grid/plugin/RowWidget.js',            
                    //'Ext.mixin':'/js/ext6/packages/core/src/mixin'

        }
    });

    Ext.require([
        /*'Ext.grid.*',
        'Ext.form.Panel',
        'Ext.data.*',
        'Ext.util.*',
        'Ext.view.View',
        'Ext.ux.DataView.DragSelector',
        'Ext.ux.DataView.LabelEditor'*/
    ]);
</script>

<table>
    <tr>
        <td>
            <div id="panel"></div>
        </td>
    </tr>
</table>
<script>

    Ext.onReady(function () {
        Ext.tip.QuickTipManager.init();

        Ext.create("Ext.container.Viewport", {
            renderTo: 'panel',
            layout: 'border',
            scope: this,
            items: [
                {
                    region: 'west',
                    xtype: 'Colsys.Status.FormBusqueda',
                    permisosC: permisosC
                },
                {
                    region: 'center',
                    xtype: 'tabpanel',
                    id: 'tabpanel-conf',
                    name: 'tabpanel-conf',
                    activeTab: 0
                },
                {
                    region: 'north',
                    html: '',
                    border: false,
                    height: 30,
                    style: {
                        display: 'none'
                    }
                }
            ]
        });

        tabpanel = Ext.getCmp('tabpanel-conf');

<?
foreach ($inoMaster as $m) {
    ?>
            idmaster =<?= $m->getCaIdmaster() ?>;
            numRef = '<?= $m->getCaReferencia() ?>';
            if (!tabpanel.getChildByElement('tab' + idmaster) && idmaster !== "") {
                impoexpo = '<?= $m->getCaImpoexpo() ?>';
                transporte = '<?= $m->getCaTransporte() ?>';
                fchcerrado = '<?= $m->getCaFchcerrado() ?>';
                modulo = '<?= $modulo ?>';

                if (impoexpo === "INTERNO")
                    tmppermisos = permisosC.terrestre;
                else if (impoexpo === "Exportaci\u00F3n")
                    tmppermisos = permisosC.exportacion;
                else if (impoexpo === "Importaci\u00F3n")
                {
                    if (transporte === "Mar\u00EDtimo")
                        tmppermisos = permisosC.maritimo;
                    if (transporte === "A\u00E9reo")
                        tmppermisos = permisosC.aereo;
                } else if (impoexpo === "OTM-DTA"){
                    tmppermisos = permisosC.otm;
                } else if (impoexpo === "Triangulaci\u00F3n"){
                    if (transporte === "Mar\u00EDtimo")
                        tmppermisos = permisosC.maritimo;
                }                

                tabpanel.add({
                    title: numRef,
                    id: 'tab' + idmaster,
                    itemId: 'tab' + idmaster,
                    closable: true,
                    autoScroll: true,
                    items: [
                        {
                            xtype: 'Colsys.Status.PanelPrincipal',
                            id: 'panel-principal-' + idmaster,
                            idmaster: idmaster,
                            idtransporte: transporte,
                            idimpoexpo: impoexpo,
                            idreferencia: numRef,
                            permisos: tmppermisos,
                            modulo: modulo

                        }
                    ]
                }).show();
            }
            tabpanel.setActiveTab('tab' + idmaster);
    <?
}
?>
    });
</script>