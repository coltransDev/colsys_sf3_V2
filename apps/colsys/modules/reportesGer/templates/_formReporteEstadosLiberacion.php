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
$sufijos = $sf_data->getRaw("sufijos");
$sucursales = $sf_data->getRaw("sucursales");
$traficos = $sf_data->getRaw("traficos");
$ciudades = $sf_data->getRaw("ciudades");
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


<table width="815" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-form"></div><br>
        </td>
    </tr>
</table>

<table width="100%" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-report"></div><br>
        </td>
    </tr>
</table>

<script type="text/javascript">
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Ext.ux': '../js/ext5/examples/ux/'
        }
    });

    Ext.require([
        'Ext.ux.form.MultiSelect',
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer'
    ]);

    Ext.onReady(function () {

        Ext.create('Ext.grid.Panel', {
            id: 'gridReport',
            renderTo: Ext.get('se-report'),
            bodyPadding: '0, 0, 0, 0',
            columnLines: true,
            columns: [
                {text: "Referencia", flex: 1, dataIndex: 'referencia', width: 130, locked: true},
                {text: "Cliente", flex: 1, dataIndex: 'cliente'},
                {text: "Doc.Transporte", flex: 1, dataIndex: 'doctransporte'},
                {text: "Fecha.Llegada", dataIndex: 'fchllegada'},
                {text: "Estado Liberaci\u00F3n", dataIndex: 'estado_liberacion'},
                {text: "Nota Liberaci\u00F3n", dataIndex: 'nota_liberacion'},
                {text: "Aut.Liberaci\u00F3n", dataIndex: 'usuliberacion'},
                {text: "Aut.Fecha", dataIndex: 'fchliberacion'},
                {text: "Observa.Lib", flex: 1, dataIndex: 'observaciones_lib'},
                {text: "Agente", dataIndex: 'agente'},
                {text: "Liber\u00F3", dataIndex: 'usulibero'},
                {text: "Fecha", dataIndex: 'fchlibero'},
                {text: "Detalles", flex: 1, dataIndex: 'detalles'}
            ],
            store: Ext.create('Ext.data.Store', {
                autoLoad: false,
                fields: [
                    {name: 'referencia', type: 'string'},
                    {name: 'cliente', type: 'string'},
                    {name: 'doctransporte', type: 'string'},
                    {name: 'fchllegada', type: 'string'},
                    {name: 'estado_liberacion', type: 'string'},
                    {name: 'nota_liberacion', type: 'string'},
                    {name: 'usuliberacion', type: 'string'},
                    {name: 'fchliberacion', type: 'string'},
                    {name: 'observaciones_lib', type: 'string'},
                    {name: 'Agente', type: 'string'},
                    {name: 'usulibero', type: 'string'},
                    {name: 'fchlibero', type: 'string'},
                    {name: 'detalles', type: 'string'},
                    {name: 'observaciones', type: 'string'}
                ],
                proxy: {
                    type: 'ajax',
                    timeout: 120000,
                    url: '<?= url_for('reportesGer/reporteEstadosLiberacionListExt5') ?>',
                    reader: {
                        type: 'json',
                        root: 'root'
                    }
                }
            }),
            autoScroll: true,
            lockedGridConfig: {
                header: false,
                collapsible: true
            },
            lockedViewConfig: {
                scroll: 'horizontal'
            },
            height: 600,
            plugins: [{
                    ptype: 'rowexpander',
                    rowBodyTpl: new Ext.XTemplate(
                            '<p style=\'text-align: justify; font-size:12px;\'><b>Observaciones:</b> {observaciones}</p>'
                            )
                }],
            viewConfig: {
                getRowClass: function (record, rowIndex, rowParams, store) {
                    return record.get('color');
                }
            },
            dockedItems: [{
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        {xtype: 'exporterbutton',
                            text: 'Exportar',
                            iconCls: 'csv',
                            format: 'excel',
                            store: this.store
                        }
                    ]
                }],
            collapsible: false
        });

        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Reporte Referencias Procesadas',
            bodyPadding: '0, 0, 0, 0',
            layout: 'column',
            standardSubmit: true,
            items: [{
                    xtype: 'fieldset',
                    columnWidth: 0.99,
                    collapsible: false,
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
                                    height: 174,
                                    width: 100,
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
                                    width: 100,
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
                                    width: 100,
                                    store: <?= json_encode($transportes) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false,
                                    listeners: {
                                        change: function (comboMulti, newValue, oldValue, eOpts) {
                                            store = Ext.getCmp('destino').getStore();
                                            store.load({
                                                params: {
                                                    puerto: newValue,
                                                    idpais: 'CO-057'
                                                }
                                            });
                                        }
                                    }
                                }]
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Meses',
                            name: 'mes',
                            id: 'mes',
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
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Sufijos',
                            name: 'sufijo',
                            id: 'sufijo',
                            allowBlank: false,
                            height: 330,
                            width: 135,
                            store: <?= json_encode($sufijos) ?>,
                            style: 'text-align: left',
                            ddReorder: false
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
                            title: 'Destinos',
                            name: 'destino',
                            id: 'destino',
                            height: 330,
                            width: 150,
                            store: {
                                fields: [{name: 'idCiudad', type: 'string'}, {name: 'ciudad', type: 'string'}],
                                data: <?= json_encode($ciudades) ?>
                            },
                            style: 'text-align: left',
                            valueField: 'idCiudad',
                            displayField: 'ciudad',
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
                        }]
                }
            ],
            dockedItems: [{
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer',
                    items: [{
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Arribo Ini',
                            name: 'fechaArrInicial',
                            format: 'Y-m-d'
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fecha Arribo Fin',
                            name: 'fechaArrFinal',
                            format: 'Y-m-d'
                        }, '->', {
                            text: 'Limpiar',
                            handler: function () {
                                this.up('form').getForm().reset();
                            }
                        }, {
                            text: 'Generar Reporte',
                            formBind: true, //only enabled once the form is valid
                            disabled: true,
                            handler: function () {
                                var form = this.up('form').getForm();
                                var data = form.getFieldValues();
                                if ((data.anio.length == 0 || data.mes.length == 0) && data.fechaArrInicial === null && data.fechaArrFinal === null) {
                                    Ext.Msg.alert('Error', 'Debe elegir una a\u00F1 o y un mes para la referencia o fecha inicial y final para el arribo!');
                                    return false
                                }
                                var store = Ext.getCmp('gridReport').getStore();
                                store.removeAll();

                                var str = JSON.stringify(data);
                                store.getProxy().extraParams = {
                                    datos: str
                                };
                                store.load();
                            }
                        }]
                }]
        });

    })
</script>
