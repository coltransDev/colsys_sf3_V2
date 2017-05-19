<style>
    .x-grid-cell-inner {    
        white-space: pre-line !important;
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
            'Ext.ux.exporter': '../js/ext5/examples/ux/exporter/',
            'Colsys': '/js/Colsys'
        }
    });

    Ext.require([
        'Ext.grid.*',
        'Ext.form.Panel',
        'Chart.ux.Highcharts',
        'Chart.ux.Highcharts.PieSerie',
        'Chart.ux.Highcharts.ColumnSerie',
        'Ext.ux.exporter.Exporter'
    ]);
</script>
<?php
$permisos = $sf_data->getRaw("permisos");

include_component("widgets5", "wgEmpresas");
include_component("contabilidad", "gridConceptosSiigo");
include_component("contabilidad", "gridCuentas");
include_component("contabilidad", "formConsultaComprobantes");
include_component("contabilidad", "gridConsultaComprobantes", array("permisos" => $permisos));


include_component("contabilidad", "formWsFactColdepositos");
include_component("contabilidad", "gridWsFactColdepositos");

//include_component("riesgos", "formArchivos");
//include_component("riesgos", "treeGridFiles");
?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
            <div id="panel"></div>
            <div id="sub-panel"></div>
        </td></tr></table>
<script>

    Ext.onReady(function () {
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
                                    //alert(!isNaN(record.data.id))
                                    if (!isNaN(record.data.id))
                                    {
                                        var vport = t.up('viewport');
                                        tabpanel = vport.down('tabpanel');

                                        if (!tabpanel.getChildByElement('tab' + record.data.id) && record.data.id != "")
                                        {
                                            if (record.data.id == "1")
                                                obj = [new GridCuentas({id: 'grid-cuentas', name: 'grid-cuentas', width: 800, height: 800})];
                                            else if (record.data.id == "2")
                                                obj = [new GridConceptosSiigo({id: 'grid-conceptos-siigo', name: 'grid-conceptos-siigo'})];
                                            else if (record.data.id == "3")
                                            {
                                                //obj={};
                                                //include_component("contabilidad", "formConsultaComprobantes");
                                                /*Ext.Loader.loadScript(
                                                 {url:'<?= url_for("contabilidad/formConsultaComprobantes") ?>'}
                                                 )*/


                                                obj = [
                                                    new FormConsultaComprobantes({id: 'form-consulta-comprobantes', name: 'form-consulta-comprobantes', frame: true})
                                                            ,
                                                    new GridConsComprobantes({id: 'grid-consulta-comprobantes', name: 'grid-consulta-comprobantes'})
                                                ];
                                                //obj=new GridConsComprobantes({id:'grid-consulta-comprobantes',name:'grid-consulta-comprobantes'});
                                            } else if (record.data.id == "4")
                                            {

                                                obj = [
                                                    new FormWsFactColdepositos({id: 'form-ws-fact-coldepositos', name: 'form-ws-fact-coldepositos', frame: true})
                                                            ,
                                                    new GridWsFactColdepositos({id: 'grid-ws-fact-coldepositos', name: 'grid-ws-fact-coldepositos'})
                                                ];
                                                //obj=new GridConsComprobantes({id:'grid-consulta-comprobantes',name:'grid-consulta-comprobantes'});
                                            } else if (record.data.id == "5")
                                            {
                                                obj = [/*{xtype: 'Colsys.Contabilidad.FormComprobantes', id: 'form-comprobantes', name: 'form-comprobantes', frame: true}
                                                    ,
                                                    {xtype: 'Colsys.Contabilidad.GridMovimientosComprobantes', id: 'grid-movimientosComprobantes', name: 'grid-movimientosComprobantes'}
                                                */
                                               {
                                                    xtype: 'Colsys.Ino.FormFactura',
                                                    id: 'form-panel' + this.idmaster,
                                                    name: 'form-panel' + this.idmaster,
                                                    idmaster: this.idmaster,
                                                    height: 330,
                                                    width: 800,
                                                    ino:false
                                                },
                                                {
                                                    xtype: 'Colsys.Ino.GridConceptosFact',
                                                    id:'id-grid-comprobante',
                                                    name:'id-grid-comprobante',
                                                    idcomprobante: '0',
                                                    /*idmaster: idmaster*/
                                                }
                                                ];
                                            }




                                            tabpanel.add(
                                                    {
                                                        title: record.data.text,
                                                        id: 'tab' + record.data.id,
                                                        itemId: 'tab' + record.data.id,
                                                        autoScroll: true,
                                                        items: [
                                                            {
                                                                //autoScroll:true,
                                                                items: [
                                                                    Ext.create('Ext.panel.Panel', {
                                                                        //title: 'Registro de Incidente',    
                                                                        bodyPadding: 10,
                                                                        //width: 350,
                                                                        //autoScroll:true,
                                                                        id: 'tab-form' + record.data.id,
                                                                        items: obj
                                                                    })
                                                                ]
                                                            }
                                                        ]
                                                    }
                                            ).show();
                                        }
                                        tabpanel.setActiveTab('tab' + record.data.id);
                                    }
                                }
                            }
                        }]
                }, {
                    region: 'center',
                    xtype: 'tabpanel',
                    activeTab: 0,
                    id:'tabpanel1',
                    name:'tabpanel1',
                    items: [/*{
                     title: 'Default Tab',
                     html:'Selecciona una opcion del menu'
                     }*/


                        //Ext.create('ReportsPanel', {closable: true,title:"Maritimo",id:'tab1',idsserie:"2"}),
                        //Ext.create('ReportsPanel', {closable: true,title:"Aereo",id:'tab2',idsserie:"4"})


                    ]
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
    });


</script>