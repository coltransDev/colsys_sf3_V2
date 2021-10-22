<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$annos = $sf_data->getRaw("annos");
$meses = $sf_data->getRaw("meses");
$impoexpo = $sf_data->getRaw("impoexpo");
$transportes = $sf_data->getRaw("transportes");
$departamentos = $sf_data->getRaw("departamentos");
$sucursales = $sf_data->getRaw("sucursales");
$colaboradores = $sf_data->getRaw("colaboradores");
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


<table width="710" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-form"></div><br>
        </td>
    </tr>
</table>

<table width="95%" align="center">
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
        'Ext.ux.form.MultiSelect'
    ]);

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

    Ext.onReady(function () {
        Ext.create('Ext.form.Panel', {
            id: 'panelResponse',
            title: 'Informe por Colaborador',
            renderTo: Ext.get('se-rspn'),
            bodyPadding: '0, 0, 0, 0',
            collapsible: true
        });

        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Reporte Volumen de Trabajo por Colaborador',
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
                            width: 105,
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
                                    height: 154,
                                    width: 100,
                                    store: <?= json_encode($annos) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                },{
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Impo/Expo',
                                    name: 'impoexpo',
                                    id: 'impoexpo',
                                    allowBlank: true,
                                    height: 174,
                                    width: 100,
                                    store: <?= json_encode($impoexpo) ?>,
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
                            width: 132,
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                xtype: 'multiselect',
                                msgTarget: 'side',
                                title: 'Sucursales',
                                name: 'sucursal',
                                id: 'sucursal',
                                allowBlank: false,
                                height: 239,
                                width: 128,
                                store: <?= json_encode($sucursales) ?>,
                                style: 'text-align: left',
                                ddReorder: false
                            }, {
                                xtype: 'multiselect',
                                msgTarget: 'side',
                                title: 'Transporte',
                                name: 'transporte',
                                id: 'transporte',
                                allowBlank: true,
                                width: 128,
                                store: <?= json_encode($transportes) ?>,
                                style: 'text-align: left',
                                ddReorder: false
                            }]
                        }, {
                            xtype: 'fieldset',
                            height: 330,
                            width: 340,
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                xtype: 'multiselect',
                                msgTarget: 'side',
                                title: 'Departamentos',
                                name: 'departamento',
                                id: 'departamento',
                                allowBlank: false,
                                height: 164,
                                width: 338,
                                store: <?= json_encode($departamentos) ?>,
                                style: 'text-align: left',
                                ddReorder: false,
                                listeners: {
                                    change: function (select, newValue, oldValue, eOpts) {
                                        store = Ext.getCmp('colaborador').getStore();
                                        store.clearFilter();
                                        store.filter('sucursal', Ext.getCmp('sucursal').getValue());
                                        store.filter('departamento', newValue);
                                    }
                                }
                            }, {
                                xtype: 'multiselect',
                                msgTarget: 'side',
                                title: 'Colaboradores',
                                name: 'colaborador',
                                id: 'colaborador',
                                height: 164,
                                width: 338,
                                store: {
                                    fields: [{name: 'idUsuario', type: 'string'}, {name: 'usuario', type: 'string'}, {name: 'departamento', type: 'string'}, {name: 'sucursal', type: 'string'}],
                                    data: <?= json_encode($colaboradores) ?>,
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
                            }]
                        }]
                }, {
                    xtype: 'container',
                    columnWidth: 1,
                    collapsible: false,
                    border: 0,
                    layout: 'column',
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
                        var form = this.up('form');
                        if (form.getForm().isValid()) {
                            var data = form.getForm().getFieldValues();
                            var str = JSON.stringify(data);
                            form.collapse();
                            
                            var panel = Ext.getCmp('panelResponse');
                            panel.getForm().load({
                                // method: 'GET',
                                timeout: 600000,
                                url: 'reporteColaboradorList',
                                params: {
                                    datos: str
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
