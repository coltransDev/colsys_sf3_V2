<style>
.x-grid-cell-inner {    
    white-space: pre-line !important;
}

.x-column-header.grid-maestra{
        font: 300 9px helvetica, arial, verdana, sans-serif;
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
.x-form-item {
    border-spacing: 1px;
    border-collapse: separate;
}


</style>

<script>
    
    function verPdf(idcomp)
    {
       var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                        sorc: "/inocomprobantes/generarComprobantePDF/id/"+idcomp
                    });
                    windowpdf.show();
    }
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Chart': '../js/ext5/src/',            
            'Ext.grid.plugin.Exporter':'../js/ext6/classic/classic/src/grid/plugin/Exporter.js',
            'Ext.grid.plugin':'../js/ext6/classic/classic/src/grid/plugin/',            
            'Ext.exporter':'../js/ext6/classic/classic/src/exporter/',
            'Ext.view.grid':'../js/ext6/classic/classic/src/view/grid/',
            'Ext.overrides':'../js/ext6/classic/classic/src/overrides/',                 
            'Colsys': '/js/Colsys'
        }
    });

    Ext.require([        
    ]);
</script>
<?php
$permisos = $sf_data->getRaw("permisos");

$tipofacturacion = $sf_data->getRaw("tipofacturacion");

include_component("widgets5", "wgEmpresas");
include_component("contabilidad", "gridConceptosSiigo");
include_component("contabilidad", "gridCuentas");
include_component("contabilidad", "formConsultaComprobantes");
include_component("contabilidad", "gridConsultaComprobantes", array("permisos" => $permisos));


include_component("contabilidad", "formWsFactColdepositos");
include_component("contabilidad", "gridWsFactColdepositos");

?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr><td>
        <div id="panel"></div>
        <div id="sub-panel"></div>
    </td></tr>
</table>
<script>

    Ext.onReady(function () {
        tipofacturacion='<?=$tipofacturacion?>';
        Ext.tip.QuickTipManager.init();

        var msg = function (title, msg) {
            Ext.Msg.show({
                title: title,
                msg: msg,
                minWidth: 200,
                modal: true,
                icon: Ext.Msg.INFO,
                buttons: Ext.Msg.OK
            });
        };

        var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';


        var store = Ext.create('Ext.data.TreeStore', {
            root: {
                expanded: false
            },
            proxy: {
                type: 'ajax',
                url: '<?= url_for("contabilidad/datosIndex") ?>'
            }
        });


        Ext.create("Ext.container.Viewport", {
            renderTo: 'panel',
            layout: 'border',
            scope: this,
            items: [{
                region: 'west',
                title: 'Contabilidad',
                autoScroll: true,
                collapsible: true,
                width: 220,
                items: [{
                    xtype: 'treepanel',
                    id: 'tree-id',
                    autoScroll: true,
                    rootVisible: false,
                    border: false,
                    store: store,
                    dockedItems: [{
                        xtype: 'toolbar',
                        dock: 'top'
                    }],
                    listeners: {
                        itemclick: function (t, record, item, index) {
                            
                            if (!isNaN(record.data.id))
                            {
                                var vport = t.up('viewport');
                                tabpanel = vport.down('tabpanel');
                                this.permisos={'Crear':true};
                                if (!tabpanel.getChildByElement('tab' + record.data.id) && record.data.id != "")
                                {
                                    if (record.data.id == "1")
                                        obj = [new GridCuentas({id: 'grid-cuentas', name: 'grid-cuentas', width: 800, height: 800, idpanel: record.data.id})];
                                    else if (record.data.id == "2")
                                        obj = [new GridConceptosSiigo({id: 'grid-conceptos-siigo', name: 'grid-conceptos-siigo'})];
                                    else if (record.data.id == "3")
                                    {
                                        obj = [
                                            new FormConsultaComprobantes({id: 'form-consulta-comprobantes', name: 'form-consulta-comprobantes', frame: true, idpanel: record.data.id})
                                                    ,
                                            new GridConsComprobantes({id: 'grid-consulta-comprobantes', name: 'grid-consulta-comprobantes', idgrid: 'grid-'+record.data.id})
                                        ];                                        
                                    } else if (record.data.id == "4")
                                    {

                                        obj = [
                                            new FormWsFactColdepositos({id: 'form-ws-fact-coldepositos', name: 'form-ws-fact-coldepositos', frame: true})                                                    ,
                                            new GridWsFactColdepositos({id: 'grid-ws-fact-coldepositos', name: 'grid-ws-fact-coldepositos'})
                                        ];
                                        
                                    } else if (record.data.id == "5")
                                    {
                                        
                                        if (tipofacturacion == "Grid") 
                                        {
                                            obj = [
                                                {
                                                xtype: 'Colsys.Ino.GridFacturacion',
                                                title: "Ingresos" ,
                                                id: "grid-facturacion-" + this.idmaster,
                                                name: "grid-facturacion-" + this.idmaster,
                                                permisos: this.permisos,
                                                iconCls: 'money_dollar',
                                                autoScroll: true,
                                                autoHeight: true,
                                                ino:false
                                                }
                                            ];
                                        }else{
                                            obj = [
                                            {
                                                xtype: 'Colsys.Ino.PanelFacturacion',
                                                title: "Ingresos",
                                                id: "panel-facturacion-" + this.idmaster,
                                                name: "panel-facturacion-" + this.idmaster,
                                                permisos: this.permisos,
                                                autoScroll: true,
                                                autoHeight: true,
                                                iconCls: 'money_dollar',
                                                ino:false
                                           }];                       
                                        }
                                    }else if(record.data.id == "12"){
                                        obj = [{
                                                xtype: 'Colsys.Integracion.PanelTransacciones',
                                                id: 'panel-transacciones',
                                                name: 'panel-transacciones',
                                                idgrid: record.data.id
                                        }];
                                    }
                                    else if(record.data.id == "13"){
                                        obj = [{
                                                xtype: 'Colsys.Contabilidad.PanelFacturacionPr',
                                                title: "Facturacion Proveedor Internacional",
                                                id: 'panel-facturacion-pr',
                                                name: 'panel-facturacion-pr',
                                                idpanel: record.data.id,
                                                permisos: this.permisos,
                                                iconCls:'money_dollar',
                                                autoScroll: true,
                                                autoHeight: true
                                        }];
                                    }

                                    tabpanel.add(
                                            {
                                                title: record.data.text,
                                                id: 'tab' + record.data.id,
                                                itemId: 'tab' + record.data.id,
                                                closable: true,
                                                autoScroll: true,
                                                items: [{                                                        
                                                    items: [
                                                        Ext.create('Ext.panel.Panel', {                                                            
                                                            bodyPadding: 10,                                                            
                                                            id: 'tab-form' + record.data.id,
                                                            items: obj
                                                        })
                                                    ]
                                                }]
                                            }
                                    ).show();
                                }
                                tabpanel.setActiveTab('tab' + record.data.id);
                            }
                        }
                    }
                }]
            },{
                region: 'center',
                xtype: 'tabpanel',
                activeTab: 0,
                id:'tabpanel1',
                name:'tabpanel1',
                items: []
            },
            {
                region: 'north',
                html: '',
                border: false,
                height: 30,
                style: {
                    display: 'none'
                }
            }]
        });
    });
</script>