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
    background: #ececec none repeat scroll 0 0;
    border-color: #cecece;
    border-style: solid;
    border-width: 1px;
    color: #3e4752;
    font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 15px;
    font-weight: 300;
}


</style>
<script>
Ext.Loader.setConfig({
    enabled: true,
    paths: {
        'Chart':'../js/ext5/src/',
        //'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
        'Colsys':'/js/Colsys',
        'Ext.ux':'../js/ext5/examples/ux'
    }
});

Ext.require([
    'Ext.grid.*',
    'Ext.form.Panel',
    'Ext.ux.exporter.Exporter',
    'Ext.ux.Explorer',
    /*,
    'Colsys.Ino.FormBusqueda'*/
]);

</script>
<?php
$permisos = $sf_data->getRaw("permisos");
$modo = $sf_data->getRaw("modo");
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
    
    
    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[
            //new Colsys.Ino.FormBusqueda(
            {
                region: 'west',
                xtype: 'Colsys.Ino.FormBusqueda'
            }
            //)
            ,{
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
    
    
    var permisos={'Consultar':true,'Crear':true,'Editar':true,'Anular':true,'General':true,'House':true,'Facturacion':true,'Costos':true,'Documentos':true}
    ref=12176;    
    tabpanel = Ext.getCmp('tabpanel1');
    
    if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
    {
        tabpanel.add(
        {
            title: '910.10.01.0010.16',
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [new Colsys.Ino.Mainpanel({'idmaster':ref,
                    'idtransporte': 'Terrestre',
                    'idimpoexpo': 'INTERNO',
                    'permisos':permisos
                })]
        }).show();
    }
    tabpanel.setActiveTab('tab'+ref);
    
    /*ref=12143;    
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
            items: [new Colsys.Ino.Mainpanel({"idmaster":ref,
                    idtransporte: 'Terrestre',
                    idimpoexpo: 'OTM-DTA'
                })]
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