<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$impoexpo = $sf_data->getRaw("impoexpo");
$transportes = $sf_data->getRaw("transportes");
$annos = $sf_data->getRaw("annos");
$meses = $sf_data->getRaw("meses");
$sucursales = $sf_data->getRaw("sucursales");
$vendedores = $sf_data->getRaw("vendedores");
$estados = $sf_data->getRaw("estados");
$traficos = $sf_data->getRaw("traficos");
$columnas = $sf_data->getRaw("columnas");

$filtros = array();
foreach ($columnas['fields'] as $key => $value) {
    if ($columnas['fields'][$key]['groupBy'] === true) {
        $filtros['fields'][] = $value;
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
</style>


<table width="1200" align="center">
    <td style="text-align: center">
        <div id="se-form"></div><br>
    </td>
</table>

<script type="text/javascript">
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Ext.ux': '/js/ext5/examples/ux/'
        }
    });

    Ext.require([
        'Ext.ux.form.MultiSelect'
    ]);

    Ext.define('Modalidad', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'impoexpo', type: 'string'},
            {name: 'transporte', type: 'string'},
            {name: 'modalidad', type: 'string'}
        ]
    });

    var storeModalidad = Ext.create('Ext.data.Store', {
        autoLoad: false,
        model: 'Modalidad',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('widgets/datosModalidades') ?>',
            reader: {
                type: 'json',
                root: 'root'
            }
        }
    });

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
            {name: 'name', type: 'string'},
            {name: 'sigla', type: 'string'},
        ]
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

    Ext.define('ComboClientes', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-clientes',
        store: {
            pageSize: 10,
            model: 'ModelIds',
            listeners: {
                beforeload: function (store, operation, eOpts) {
                    store.getProxy().setExtraParam('Tipo', 'Cliente')
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
                    store.getProxy().setExtraParam('tipo', 'Proveedor');
                }
            }
        },
        listConfig: {
            loadingText: 'buscando...',
            emptyText: 'No existen registros',
            getInnerTpl: function () {
                return '<tpl for="."><div class="search-item"><strong>{sigla} - {name}</strong></div></tpl>';
            }
        },
        displayField: 'name',
        valueField: 'id',
        typeAhead: false,
        hideTrigger: true,
        anchor: '100%'
    });


    Ext.define('GridSelColumnas', {
        extend: 'Ext.grid.Panel',
        xtype: 'grid-columns',
        title: 'Columnas',
        hideHeaders: true,
        height: 330,
        width: 220,

        initComponent: function () {
            Ext.apply(this, {
                store: new Ext.data.Store({
                    fields: ['text', 'id', 'checked'],
                    data: <?= json_encode($columnas) ?>,
                    proxy: {
                        type: 'memory',
                        reader: {
                            type: 'json',
                            root: 'fields'
                        }
                    }
                }),
                columns: [
                    {width: 165, dataIndex: 'text'},
                    {width: 30, dataIndex: 'default', xtype: 'checkcolumn'}
                ]
            });
            this.callParent();
        }
    });


    Ext.onReady(function () {
        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Cuadro INO Ver.2',
            bodyPadding: '0, 0, 0, 0',
            layout: 'column',
            standardSubmit: true,
            items: [{
                    xtype: 'container',
                    layout: 'hbox',
                    items: [{
                            xtype: 'fieldset',
                            height: 330,
                            width: 110,
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
                                    height: 102,
                                    width: 105,
                                    store: <?= json_encode($annos) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Impo/Expo',
                                    name: 'impoexpo',
                                    id: 'impoexpo',
                                    allowBlank: false,
                                    height: 161,
                                    width: 105,
                                    store: <?= json_encode($impoexpo) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false,
                                    listeners: {
                                        change: function (comboMulti, newValue, oldValue, eOpts) {
                                            store = Ext.getCmp('modalidad').getStore();
                                            store.load({
                                                params: {
                                                    impoexpo: newValue
                                                }
                                            });
                                        }
                                    }
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Estado',
                                    name: 'estado',
                                    id: 'estado',
                                    allowBlank: false,
                                    width: 115,
                                    store: <?= json_encode($estados) ?>,
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
                            width: 118,
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Transporte',
                                    name: 'transporte',
                                    id: 'transporte',
                                    allowBlank: false,
                                    width: 115,
                                    store: <?= json_encode($transportes) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false,
                                    listeners: {
                                        change: function (comboMulti, newValue, oldValue, eOpts) {
                                            store = Ext.getCmp('puerto').getStore();
                                            store.load({
                                                params: {
                                                    puerto: newValue,
                                                    idpais: 'CO-057'
                                                }
                                            });
                                            store = Ext.getCmp('modalidad').getStore();
                                            store.load({
                                                params: {
                                                    transporte: newValue,
                                                    impoexpo: Ext.getCmp('impoexpo').value
                                                }
                                            });
                                        }
                                    }
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Modalidad',
                                    name: 'modalidad',
                                    id: 'modalidad',
                                    height: 238,
                                    width: 115,
                                    store: storeModalidad,
                                    style: 'text-align: left',
                                    valueField: 'modalidad',
                                    displayField: 'modalidad',
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
                            width: 150,
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
                            ddReorder: false,
                            listeners: {
                                change: function (select, newValue, oldValue, eOpts) {
                                    store = Ext.getCmp('vendedor').getStore();
                                    store.clearFilter();
                                    store.filter('sucursal', newValue);
                                }
                            }
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Vendedores',
                            name: 'vendedor',
                            id: 'vendedor',
                            height: 330,
                            width: 190,
                            store: {
                                fields: [{name: 'idUsuario', type: 'string'}, {name: 'usuario', type: 'string'}, {name: 'sucursal', type: 'string'}],
                                data: <?= json_encode($vendedores) ?>,
                                filters: [
                                    function (item) {
                                        return item.sucursal = '';
                                    }
                                ]
                            },
                            style: 'text-align: left',
                            valueField: 'idUsuario',
                            displayField: 'usuario',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Puertos',
                            name: 'puerto',
                            id: 'puerto',
                            height: 330,
                            width: 150,
                            store: storePuerto,
                            style: 'text-align: left',
                            valueField: 'idciudad',
                            displayField: 'ciudad',
                            ddReorder: false
                        }, {
                            xtype: 'grid-columns',
                            name: 'columnas',
                            id: 'columnas'
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    items: [{
                            xtype: 'fieldset',
                            layout: 'anchor',
                            width: 700,
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
                            width: 487,
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

                        var gridPanel = Ext.getCmp('columnas');
                        var storeGrid = gridPanel.getStore();

                        var form = this.up('form').getForm();
                        if (form.isValid()) {
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

                            x = 0;
                            changes = [];
                            for (var i = 0; i < storeGrid.getCount(); i++) {
                                var record = storeGrid.getAt(i);
                                if (record.get("default")) {
                                    changes[x] = {titulo: record.get("text"), sql: record.get("sql"), alias: record.get("alias")};
                                    x++;
                                }
                            }

                            if (changes.length < 1) {
                                Ext.Msg.alert('Error', 'Debe seleccionar por lo menos una Columna para el Informe!');
                                return false;
                            }
                            var str_2 = JSON.stringify(changes);

                            form.submit({
                                url: '<?= url_for('reportesGer/salidaCuadroInoV2Ext5') ?>',
                                params: {
                                    filters: str_1,
                                    columns: str_2
                                }
                            });
                        }
                    }
                }]
        });
    })
</script>
