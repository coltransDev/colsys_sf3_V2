<?
$encuestas = $sf_data->getRaw("encuestas");
include_component("formulario", "nuevoSeguimientoWindow");

?>
<style type="text/css">
    .x-grid-cell-inner { white-space:normal !important; }
</style>

<div id="panel" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>
<div id="grid" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>
<div id="tab1" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>


<script>
Ext.define('Listado', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'idform', type: 'int'},
        {name: 'servicio', type: 'string'},
        {name: 'pregunta', type: 'string'},
        {name: 'resultado', type: 'string'}
    ]
});

Ext.onReady(function() {
    
    Ext.QuickTips.init();
    
    Ext.create('Ext.form.Panel', {
        width: 500,
        height: 250,
        bodyPadding: 10,
        bodyStyle: {            
            textAlign: 'left'
        },
        title: 'Datos de la Encuesta',
        items: [{
            xtype: 'displayfield',
            fieldLabel: 'Compañía',            
            name: 'compania',
            value: '<?=str_replace("'","",$encuestas[0]['i_ca_nombre'])?>'
        }, {
            xtype: 'displayfield',
            fieldLabel: 'Sucursal',            
            name: 'visitor_score',
            value: '<?=$encuestas[0]['s_ca_nombre']?>'
        }, {
            xtype: 'displayfield',
            fieldLabel: 'Contacto',
            name: 'visitor_score',
            value: '<?= $encuestas[0]['cc_ca_nombres'] . ' ' . $encuestas[0]['cc_ca_papellido']?>'
        }, {
            xtype: 'displayfield',
            fieldLabel: 'Email',
            name: 'visitor_score',
            value: '<?= $encuestas[0]['cc_ca_email']?>'
        }, {
            xtype: 'displayfield',
            fieldLabel: 'Comercial',
            name: 'visitor_score',
            value: '<?= $encuestas[0]['u_ca_nombre']?>'
        }, {
            xtype: 'displayfield',
            fieldLabel: 'Fecha de Respuesta',
            name: 'visitor_score',
            value: '<?= $encuestas[0]['ce_ca_fchcreado']?>'
        }],
        renderTo: 'panel'
    });

    var store = Ext.create('Ext.data.Store', {
        model: 'Listado',
        data: <?= json_encode($sf_data->getRaw("consolidado")) ?>,
        sorters: {property: 'due', direction: 'ASC'},
        groupField: 'servicio'
    });

    /*var grid = Ext.create('Ext.grid.Panel', {
        title: 'Consolidado de Encuesta',
        iconCls: 'icon-grid',
        store: store,
        stateful: true,
        stateId: 'stateGrid',
        collapsible: true,
        width: 700,
        renderTo: 'grid',
        viewConfig: {
            stripeRows: true
        },
        features: [{
            id: 'group',
            ftype: 'groupingsummary',
            groupHeaderTpl: '{name}',
            hideGroupedHeader: true,
            enableGroupingMenu: false
        }],
        columns: [
            {
                text: 'Pregunta',
                width: 450,
                //locked: true,
                tdCls: 'task',
                sortable: true,
                dataIndex: 'pregunta',
                hideable: false
            },
            {
                text: 'Servicio',                
                flex: 1,                
                sortable: true,
                dataIndex: 'servicio'
            },
            {
                text: 'Respuesta',                    
                flex: 1,                
                sortable: true,
                dataIndex: 'resultado',
                hideable: false
            }
        ]
    });*/
    cellEditing = new Ext.grid.plugin.CellEditing({
            clicksToEdit: 1
    });
    // second tabs built from JS
    var tabs2 = Ext.widget('tabpanel', {
        renderTo: 'tab1',
        activeTab: 0,
        width: 800,
        height: 500,
        plain: true,
        defaults :{
            autoScroll: true,
            bodyPadding: 10
        },
        items: [{
            title: 'Encuesta',
                items : [{
                    xtype: 'grid',
                    store: store,
                    id: 'myGrid',
                    border: false,
                    plugins: [cellEditing],
                    features: [{
                        id: 'group',
                        ftype: 'groupingsummary',
                        groupHeaderTpl: '{name}',
                        hideGroupedHeader: true,
                        enableGroupingMenu: false
                    }],
                    columns: [
                        {header: "Pregunta", width: 350, dataIndex: 'pregunta', hideable: false},
                        {header: "Servicio", flex: 1, dataIndex: 'servicio', hidden: false},
                        {header: "Respuesta", flex: 1,  width: 350, dataIndex: 'resultado', hideable: false, css: 'text-align: justify;'}
                    ]
                }]
            },
            {
                title: 'Seguimientos',
                id: 'panel-seguimientos',
                loader: {
                    url: '<?=url_for("formulario/verSeguimientos")?>',
                    contentType: 'html',
                    loadMask: true,
                    autoLoad: true,
                    params :	{
                        idcliente: '<?=$encuestas[0]["i_ca_id"]?>'
                    }
                }
            }
        ],
        listeners: {            
            afterrender: function(panel) {
                var bar = panel.tabBar;
                bar.insert(2, [{
                    xtype: 'component',
                    flex: 1
                }, {
                    xtype: 'button',
                    text: 'Nuevo Seguimiento',
                    handler: function() {
                        var win = new NuevoSeguimientoWindow(
                                {idcliente: '<?=$encuestas[0]["i_ca_id"]?>',
                                 idform: '<?=$encuestas[0]['ce_ca_idformulario']?>',
                                 idencuesta: '<?=$encuestas[0]['ce_ca_id']?>'
                                });                        
                        win.show();
                    }
                }]);
            }
        }
    });
    
});
</script>