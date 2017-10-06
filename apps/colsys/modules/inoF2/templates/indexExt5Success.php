
<style>
.x-grid-cell-inner {    
    white-space: pre-line !important;
}

.x-panel-header-title-default1
{
    color: #157fcc;
    font-family: helvetica,arial,verdana,sans-serif;    
    font-weight: 300;
    line-height: 16px;
    font-size: 11px !important;
    margin: 15px;
}

.x-toolbar-spacer-default {
  width: 2px;
  height: 4px !important;
}

.x-panel-body-default {
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 13px !important;
    font-weight: 300;
}



/*nuevo*/
.thumb {
    background-color: white;
    border-radius: 3px;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.60);
    display: table-cell;
    padding: 12px;
    box-sizing: border-box;
}

.thumb-title {
    color: #3e4752;
    font-weight: 800;
}

.thumb-title-small {
    color: #878ea2;
    font-size: 10px;
    font-weight: 500;
}

.statement-type {
    color: #878ea2;
    float: left;
    font-size: 14px;
    font-weight: bold;
    margin: 20px 5px 0;
    width: 100%;
}

.x-panel-body-default {
    /*background: #ececec none repeat scroll 0 0;*/
    /*background: #fff none repeat scroll 0 0;*/
    border-color: #cecece;
    border-style: solid;
    border-width: 1px;
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 15px;
    font-weight: 300;
}


</style>
<?
$permisos=$sf_data->getRaw("permisos");

?>
<script  src="/js/ckeditor/ckeditor.js" ></script>
<script>
//var permisos={'Consultar':true,'Crear':true,'Editar':true,'Anular':true,'Cerrar':true,'Liquidar':true,'General':true,'House':true,'Facturacion':true,'Costos':true,'Documentos':true}
var permisosG= Ext.decode('<?=json_encode($permisos)?>');
//alert(permisosG.maritimo.toSource());
Ext.Loader.setConfig({
    enabled: true,
    paths: {
        'Chart':'/js/ext5/src/',
        //'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
        'Colsys':'/js/Colsys',
        'Ext.ux':'/js/ext5/examples/ux'        
    }
});

Ext.require([
    //'Ext.grid.*',
    //'Ext.form.Panel',
    'Ext.ux.exporter.Exporter',
    'Ext.ux.Explorer',
    'Ext.ux.CKeditor'
    /*,
    'Colsys.Ino.FormBusqueda'*/
]);

</script>
<?php
//$permisos = $sf_data->getRaw("permisos");
$modo = $sf_data->getRaw("modo");
$inoMaster = $sf_data->getRaw("inoMaster");
//$idmaster=12176;
include_component("inoF2", "mainPanel");
?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
<div id="sub-panel"></div>
</td></tr></table>
<script>

Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();
    
    //var permisos={'Consultar':true,'Crear':true,'Editar':true,'Anular':true,'General':true,'House':true,'Facturacion':true,'Costos':true,'Documentos':true}
    

    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[
            {
                region: 'west',
                xtype: 'Colsys.Ino.FormBusqueda',
                'permisosG':permisosG
            },
            {
                region: 'center',
                xtype: 'tabpanel',
                id:'tabpanel1',
                name:'tabpanel1',
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
    
    tabpanel = Ext.getCmp('tabpanel1');
    <?
    foreach($inoMaster as $m)
    {
?>
        ref=<?=$m->getCaIdmaster()?>;
    
    numRef='<?=$m->getCaReferencia()?>';
    if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
    {
        impoexpo='<?=$m->getCaImpoexpo()?>';
        transporte = '<?=$m->getCaTransporte()?>';
        fchcerrado = '<?=$m->getCaFchcerrado()?>';
        
        if(impoexpo=="INTERNO")
            tmppermisos=permisosG.terrestre;
        else if(impoexpo=="Exportaci\u00F3n")
            tmppermisos=permisosG.exportacion;
        else if(impoexpo=="Importaci\u00F3n")
        {
            if(transporte=="Mar\u00EDtimo")
                tmppermisos=permisosG.maritimo;
            if(transporte=="A\u00E9reo")
                tmppermisos=permisosG.aereo;
        }
        else if(impoexpo=="OTM-DTA")
            tmppermisos=permisosG.otm;

        //alert(tmppermisos.toSource());
        if(fchcerrado!="")
        {
            tmppermisos.Editar=false;
            tmppermisos.Crear=false;
            tmppermisos.Anular=false;
        }
        
        tabpanel.add(
        {
            title: numRef,
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [
                new Colsys.Ino.Mainpanel({                    
                    region: 'north',
                    "idmaster": ref, "idimpoexpo": impoexpo,
                    "idtransporte":transporte,
                    'idreferencia':numRef,
                    'permisos': tmppermisos, "tipofacturacion":0, "idticket":0,
                    "modalidad":'<?=$m->getCaModalidad()?>'
                }),
               {
                    region: 'south',
                    xtype: 'Colsys.Ino.FormCierre',
                    id: 'formCierre'+ref,
                    name: 'formCierre'+ref,
                    idmaster: ref,
                    'permisos': tmppermisos,
                    alignTarget :'bottom'
                    
                }
            ]
        }).show();
    }
    tabpanel.setActiveTab('tab'+ref);
        
<?
    }
    ?>

    /*

    ref=12143;    
    tabpanel = Ext.getCmp('tabpanel1');
    
    if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
    {
        tabpanel.add(
        {
            title: '720.80.01.0026.16',
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [
                new Colsys.Ino.Mainpanel({
                    region: 'north',
                    "idmaster":ref,
                    "idimpoexpo": 'OTM-DTA',
                    "idtransporte":'Terrestre',
                    'idreferencia':numRef,
                    'permisos': permisos.otm
                    
                }),
               {
                    region: 'south',
                    xtype: 'Colsys.Ino.FormCierre',
                    id: 'formCierre'+ref,
                    name: 'formCierre'+ref,
                    idmaster: ref,
                    'permisos': permisos.otm,
                    alignTarget :'bottom'
                    
                }
            ]
            
        }).show();
    }
    tabpanel.setActiveTab('tab'+ref);
    */

    /*function openFile(val){
        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
            sorc: val
        });
        windowpdf.show();
    }*/
});

function openFile(val){
    var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
        sorc: val
    });
    windowpdf.show();
}


</script>

<!--<div style="float:left;border:">-->