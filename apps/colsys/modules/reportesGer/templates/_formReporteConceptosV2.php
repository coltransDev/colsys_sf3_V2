<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$annos = $sf_data->getRaw("annos");
$meses = $sf_data->getRaw("meses");
$transportes = $sf_data->getRaw("transportes");
$impoexpo = $sf_data->getRaw("impoexpo");
$estados = $sf_data->getRaw("estados");
$sucursales = $sf_data->getRaw("sucursales");
$traficos = $sf_data->getRaw("traficos");
$incoterms = $sf_data->getRaw("incoterms");
$conceptos = $sf_data->getRaw("conceptos");
$columnas = $sf_data->getRaw("columnas");

$filtros = array();
$exclude = array("Cliente", "Agente", "Transportista");
foreach ($columnas as $key => $value) {
    if (in_array($value['text'], $exclude)) {
        continue;
    }
    if ($value['groupBy'] === true) {
        $filtros[] = $columnas[$key];
    }
}
?>

<style>
    /*Inicio Julio*/

    .x-panel-header-default-horizontal {
        padding: 0;
    }

    .x-panel-header-title-default {
        color: #157fcc;
        font-family: helvetica,arial,verdana,sans-serif;
        font-size: 12px;
        font-weight: 100;
        line-height: 14px;
    }

    .x-tab-bar-default-top > .x-tab-bar-body-default {
        padding: 0;
    }

    .x-autocontainer-innerCt {
        display: table-cell;
        height: 100%;
        vertical-align: top;
    }
    .x-border-box, .x-border-box * {
        box-sizing: border-box;
    }


    .x-border-box, .x-border-box * {
        box-sizing: border-box;
    }
    .x-autocontainer-innerCt {
        display: table-cell;
        height: 100%;
        vertical-align: top;
    }
    .x-autocontainer-innerCt {
        display: table-cell;
        height: 100%;
        vertical-align: top;
    }
    .x-border-box, .x-border-box * {
        box-sizing: border-box;
    }

    .x-panel-body-default {
        color: #3e4752;
        font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 12px;
        font-weight: 300;
    }

    .x-tab-inner-default {
        color: black;
        font: 300 12px/16px helvetica,arial,verdana,sans-serif;
        max-width: 100%;
    }
    .tool_in_tabpanel {
        right: 0px !important;
        left: auto !important;
        top: 3px !important;
    }
    .no-icon {
        display : none;
        background-image:url('ext/resources/images/default/s.gif') !important;
    }

    /*Fin Julio*/
    .rowVencido {
        background-color: #9999CC !important;
        color:white;
    }
    .rowRojo {
        background-color: #FF0000 !important;
        color:white;
    }
    .rowAmarillo{
        background-color: #FFFF00 !important;
        color:black;
    }    
    .rowVerde{
        background-color: #04B404 !important;
        color:white;
    }    
    .rowOk{
        background-color: #1D3F99 !important;
        color:white;
    }    
</style>

<table width="950" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-form"></div><br>
        </td>
    </tr>
</table>

<table width="950" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-rspn"></div><br>
        </td>
    </tr>
</table>

<script type="text/javascript">
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Colsys': '/js/Colsys',
            'Ext.ux': '/js/ext5/examples/ux/',
            'Ext': '/js/ext6/classic/classic/src/'
        }
    });

    Ext.require([
        'Ext.ux.IFrame',
        'Ext.ux.form.MultiSelect'
    ]);

    Ext.define('Puerto', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'idciudad', type: 'string'},
            {name: 'ciudad', type: 'string'}
        ]
    });

    var storePuerto = Ext.create('Ext.data.Store', {
        autoLoad: false,
        model: 'Puerto',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('widgets/datosCiudades') ?>',
            reader: {
                type: 'json',
                root: 'root'
            }
        }
    });

    Ext.define('ModelIds', {
        extend: 'Ext.data.Model',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('reportesGer/busquedaIds') ?>',
            reader: {
                type: 'json',
                root: 'root',
                totalProperty: 'total'
            }
        },
        fields: [
            {name: 'id', type: 'string'},
            {name: 'name', type: 'string'}
        ]
    });

    Ext.define('ComboClientes', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-clientes',
        store: {
            pageSize: 10,
            model: 'ModelIds',
            listeners: {
                beforeload: function (store, operation, eOpts) {
                    store.getProxy().setExtraParam('Tipo', 'Cliente');
                }
            }
        },
        displayField: 'name',
        valueField: 'id',
        typeAhead: false,
        hideTrigger: true,
        anchor: '100%',
        listConfig: {
            loadingText: 'Buscando...',
            emptyText: 'No hay resultados'
        }
    });

    Ext.define('ComboAgentes', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-agentes',
        store: {
            pageSize: 10,
            model: 'ModelIds',
            listeners: {
                beforeload: function (store, operation, eOpts) {
                    store.getProxy().setExtraParam('Tipo', 'Agente')
                }
            }
        },
        displayField: 'name',
        valueField: 'id',
        typeAhead: false,
        hideTrigger: true,
        anchor: '100%',
        listConfig: {
            loadingText: 'Buscando...',
            emptyText: 'No hay resultados'
        }
    });

    Ext.define('ComboTransportistas', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-transportistas',
        store: {
            pageSize: 10,
            model: 'ModelIds',
            listeners: {
                beforeload: function (store, operation, eOpts) {
                    store.getProxy().setExtraParam('Tipo', 'Proveedor');
                }
            }
        },
        displayField: 'name',
        valueField: 'id',
        typeAhead: false,
        hideTrigger: true,
        anchor: '100%',
        listConfig: {
            loadingText: 'Buscando...',
            emptyText: 'No hay resultados'
        }
    });

    Ext.define('ItemsSelector', {
        extend: 'Ext.container.Container',
        xtype: 'wItemsSelectorFields',
        layout: {
            type: 'hbox'
        },
        items: [{
                title: 'Campos disponibles',
                xtype: 'treepanel',
                id: 'fieldsTreePanel',
                store: new Ext.data.TreeStore({
                    root: {
                        text: 'Campos',
                        expanded: true,
                        groupBy: true
                    },
                    proxy: {
                        type: 'memory',
                        data: <?= json_encode($filtros) ?>,
                        reader: {
                            type: 'json',
                            root: 'fields'
                        }
                    }
                }),
                margin: '0 15 0 0',
                flex: 1,
                height: 189,
                viewConfig: {
                    plugins: {
                        ptype: 'treeviewdragdrop',
                        appendOnly: true,
                        sortOnDrop: true,
                        containerScroll: true
                    }
                }
            }, {
                title: 'Criterio de Ordenamiento',
                xtype: 'treepanel',
                id: 'criterialTreePanel',
                store: new Ext.data.TreeStore({
                    root: {
                        text: 'Filtros',
                        id: 'src',
                        expanded: true,
                        children: []
                    },
                    folderSort: true,
                    sorters: [{
                            property: 'text',
                            direction: 'ASC'
                        }]
                }),
                flex: 1,
                height: 189,
                viewConfig: {
                    plugins: {
                        ptype: 'treeviewdragdrop',
                        appendOnly: true,
                        sortOnDrop: false,
                        sortableColumns: true,
                        containerScroll: true
                    }
                }
            }]
    });

    Ext.onReady(function () {
        Ext.create('Ext.form.Panel', {
            id: 'panelResponse',
            title: 'Informe por Conceptos',
            renderTo: Ext.get('se-rspn'),
            bodyPadding: '0, 0, 0, 0',
            collapsible: true
        });

        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Generador de Reportes por Concepto',
            bodyPadding: '0, 0, 0, 0',
            layout: 'column',
            collapsible: true,
            standardSubmit: true,
            items: [{
                    xtype: 'container',
                    columnWidth: 1,
                    collapsible: false,
                    border: 0,
                    layout: 'column',
                    padding: '0, 0, 0, 0',
                    items: [{
                            xtype: 'fieldset',
                            height: 330,
                            width: 85,
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Años',
                                    name: 'anio',
                                    id: 'anio',
                                    allowBlank: false,
                                    height: 140,
                                    width: 82,
                                    store: <?= json_encode($annos) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Incoterms',
                                    name: 'incoterm',
                                    id: 'incoterm',
                                    allowBlank: true,
                                    height: 188,
                                    width: 82,
                                    store: <?= json_encode($incoterms) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }]
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Meses',
                            name: 'mes',
                            id: 'mes',
                            allowBlank: false,
                            height: 330,
                            width: 115,
                            store: {
                                fields: [{name: 'idmes', type: 'string'}, {name: 'nommes', type: 'string'}],
                                data: <?= json_encode($meses) ?>
                            },
                            style: 'text-align: left',
                            valueField: 'idmes',
                            displayField: 'nommes',
                            ddReorder: false
                        }, {
                            xtype: 'fieldset',
                            height: 330,
                            width: 120,
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Impo/Expo',
                                    name: 'impoexpo',
                                    id: 'impoexpo',
                                    allowBlank: false,
                                    height: 173,
                                    width: 118,
                                    store: <?= json_encode($impoexpo) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Transporte',
                                    name: 'transporte',
                                    id: 'transporte',
                                    allowBlank: false,
                                    width: 118,
                                    store: <?= json_encode($transportes) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Estado',
                                    name: 'estado',
                                    id: 'estado',
                                    allowBlank: false,
                                    width: 118,
                                    store: <?= json_encode($estados) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }]
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Traficos',
                            name: 'trafico',
                            id: 'trafico',
                            allowBlank: false,
                            height: 330,
                            width: 137,
                            store: {
                                fields: [{name: 'idTrafico', type: 'string'}, {name: 'trafico', type: 'string'}],
                                data: <?= json_encode($traficos) ?>
                            },
                            style: 'text-align: left',
                            valueField: 'idTrafico',
                            displayField: 'trafico',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Sucursales',
                            name: 'sucursal',
                            id: 'sucursal',
                            allowBlank: false,
                            height: 330,
                            width: 135,
                            store: <?= json_encode($sucursales) ?>,
                            style: 'text-align: left',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Conceptos',
                            name: 'concepto',
                            id: 'concepto',
                            allowBlank: false,
                            height: 330,
                            width: 340,
                            store: {
                                fields: [{name: 'idConcepto', type: 'string'}, {name: 'concepto', type: 'string'}],
                                data: <?= json_encode($conceptos) ?>
                            },
                            style: 'text-align: left',
                            valueField: 'idConcepto',
                            displayField: 'concepto',
                            ddReorder: false
                        }]
                }, {
                    xtype: 'container',
                    columnWidth: 1,
                    collapsible: false,
                    border: 0,
                    layout: 'column',
                    padding: '0, 0, 0, 0',
                    items: [{
                            xtype: 'fieldset',
                            layout: 'anchor',
                            width: 500,
                            defaults: {
                                anchor: '99%'
                            },
                            items: [{
                                    xtype: 'fieldset',
                                    title: 'Cliente',
                                    collapsible: false,
                                    defaults: {anchor: '99%'},
                                    columnWidth: 0.99,
                                    items: {
                                        xtype: 'combo-clientes',
                                        name: 'cliente',
                                        id: 'cliente'
                                    }
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Agente',
                                    collapsible: false,
                                    defaults: {anchor: '99%'},
                                    columnWidth: 0.99,
                                    items: {
                                        xtype: 'combo-agentes',
                                        name: 'agente',
                                        id: 'agente'
                                    }
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Transportista',
                                    collapsible: false,
                                    defaults: {anchor: '98%'},
                                    columnWidth: 0.99,
                                    items: {
                                        xtype: 'combo-transportistas',
                                        name: 'transportista',
                                        id: 'transportista'
                                    }

                                }]
                        }, {
                            layout: 'anchor',
                            width: 435,
                            defaults: {
                                anchor: '99%'
                            },
                            items: [{
                                    xtype: 'wItemsSelectorFields'
                                }]
                        }]
                }
            ],
            buttons: [{
                    text: 'Limpiar',
                    handler: function () {
                        this.up('form').getForm().reset();
                    }
                }, {
                    text: 'Generar Reporte',
                    formBind: true, //only enabled once the form is valid
                    disabled: true,
                    handler: function () {
                        var treePanel = Ext.getCmp('criterialTreePanel');
                        var storeTree = treePanel.getStore();
                        if (storeTree.count() <= 1) {
                            Ext.Msg.alert('Error', 'Debe seleccionar por lo menos un Criterio de Ordenamiento!');
                            return false;
                        }

                        var form = this.up('form');

                        if (form.getForm().isValid()) {
                            var data = form.getForm().getFieldValues();
                            var str = JSON.stringify(data);
                            form.collapse();

                            x = 0;
                            changes = [];
                            for (var i = 0; i < storeTree.getCount(); i++) {
                                var record = storeTree.getAt(i);
                                if (Ext.Object.getSize(record.getChanges()) != 0) {
                                    changes[x] = {titulo: record.get("text"), sql: record.get("sql"), alias: record.get("alias")};
                                    x++;
                                }
                            }
                            var str_1 = JSON.stringify(changes);
                            var str_2 = JSON.stringify(<?= json_encode($columnas) ?>);

                            var panel = Ext.getCmp('panelResponse');
                            panel.getForm().load({
                                // method: 'GET',
                                url: 'reporteConceptosListExt5',
                                params: {
                                    datos: str,
                                    filtros: str_1,
                                    columnas: str_2
                                },
                                success: function (form, action) {
                                    var res = Ext.JSON.decode(action.response.responseText);
                                    Ext.getBody().mask('Cargando Resultados');
                                    if (pivot) {
                                        delete pivot;
                                    }
                                    var pivot = Ext.create('Colsys.Informes.PivotGridExporter', {
                                        id: 'pivotResponse',
                                        collapsible: false,
                                        matrix: {
                                            store: new Ext.data.Store({
                                                fields: res.data.fields,
                                                proxy: {
                                                    type: 'memory',
                                                    data: res.data.datos,
                                                    reader: {
                                                        type: 'json'
                                                    }
                                                },
                                                autoLoad: true
                                            }),
                                            calculateAsExcel: true,
                                            colGrandTotalsPosition: 'none',
                                            rowGrandTotalsPosition: 'last',
                                            leftAxis: res.data.leftAxis,
                                            topAxis: res.data.topAxis,
                                            aggregate: res.data.aggregate
                                        }
                                    });
                                    panel.add(pivot);
                                    Ext.getBody().unmask();
                                },
                                failure: function (form, action) {
                                    console.log(action);
                                    Ext.Msg.alert("Problemas cargando la información", action.result.errorInfo);
                                },
                                waitMsg: 'Leyendo información de la Base de Datos',
                                waitTitle: 'Cargando...'
                            });
                        }
                    }
                }]
        });

    })
</script>
