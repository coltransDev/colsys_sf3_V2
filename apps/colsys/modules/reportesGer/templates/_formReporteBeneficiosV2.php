<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$circular170 = $sf_data->getRaw("circular170");
$creditos = $sf_data->getRaw("creditos");
$sucursales = $sf_data->getRaw("sucursales");
$empresas = $sf_data->getRaw("empresas");
$vendedores = $sf_data->getRaw("vendedores");
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
            'Ext.ux.exporter': '/js/ext5/examples/ux/exporter/',
            'Ext': '/js/ext6/classic/classic/src/'
        }
    });

    Ext.require([
        'Ext.ux.form.MultiSelect',
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer'
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
        Ext.create('Ext.grid.Panel', {
            id: 'gridReport',
            title: 'Informe Beneficios Crediticios',
            renderTo: Ext.get('se-rspn'),
            bodyPadding: '0, 0, 0, 0',
            collapsible: true,
            loadMask: true,
            width: 2680,
            bbar: [{
                id: 'exporter-bnt',
                xtype: 'exporterbutton',
                text: 'Exportar a Excel ',
                title: 'Reporte de Beneficios Crediticios',
                iconCls: 'csv',
                format: 'excel',
            }],
            columns: [
                {text: "Id", width: 120, dataIndex: 'idalterno'},
                {text: "Dv", width: 70, dataIndex: 'dv'},
                {text: "Socio de Negocio", flex: 1, dataIndex: 'socio'},
                {text: "Vendedor", dataIndex: 'vendedor'},
                {text: "Email", dataIndex: 'email'},
                {text: "Sucursal", dataIndex: 'sucursal'},
                {text: "Circular 0170", renderer: Ext.util.Format.dateRenderer('Y-m-d'), dataIndex: 'fchcircular'},
                {text: "Estado Circular", dataIndex: 'stdcircular'},
                {text: "Cupo Cr\u00E9dito", dataIndex: 'cupo', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "D\u00EDas Cr\u00E9dito", dataIndex: 'dias', align: "right"},
                {text: "Per.Gracia", renderer: Ext.util.Format.dateRenderer('Y-m-d'), dataIndex: 'fchgracia'},
                {text: "Empresa", dataIndex: 'empresa'},
                {text: "Pagos/Terceros", dataIndex: 'terceros'},
                {text: "Observaciones", dataIndex: 'observaciones'},
                {text: "Fch.Creado", dataIndex: 'fchcreado'},
                {text: "Usu.Creado", dataIndex: 'usucreado'},
                {text: "Fch.Actualizado", dataIndex: 'fchactualizado'},
                {text: "Usu.Actualizado", dataIndex: 'usuactualizado'},
                {text: "EEFF", width: 70, dataIndex: 'anno'},
                {text: "Activos Totales", dataIndex: 'activostotales', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "Activos Corrientes", dataIndex: 'activoscorrientes', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "Pasivos Totales", dataIndex: 'pasivostotales', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "Pasivos Corrientes", dataIndex: 'pasivoscorrientes', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "Inventarios", dataIndex: 'inventarios', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "Patrimonios", dataIndex: 'patrimonios', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "Utilidades", dataIndex: 'utilidades', xtype: 'numbercolumn', format: '0,000', align: "right"},
                {text: "Ventas", dataIndex: 'ventas', xtype: 'numbercolumn', format: '0,000', align: "right"}
            ],
            store: Ext.create('Ext.data.Store', {
                autoLoad: false,
                fields: [
                    {name: 'idalterno', type: 'string'},
                    {name: 'dv', type: 'string'},
                    {name: 'socio', type: 'string'},
                    {name: 'vendedor', type: 'string'},
                    {name: 'email', type: 'string'},
                    {name: 'sucursal', type: 'string'},
                    {name: 'fchcircular', type: 'date'},
                    {name: 'stdcircular', type: 'string'},
                    {name: 'cupo', type: 'float'},
                    {name: 'dias', type: 'integer'},
                    {name: 'fchgracia', type: 'date'},
                    {name: 'terceros', type: 'string'},
                    {name: 'empresa', type: 'string'},
                    {name: 'observaciones', type: 'string'},
                    {name: 'fchcreado', type: 'string'},
                    {name: 'usucreado', type: 'string'},
                    {name: 'fchactualizado', type: 'string'},
                    {name: 'usuactualizado', type: 'string'},
                    {name: 'anno', type: 'integer'},
                    {name: 'activostotales', type: 'float'},
                    {name: 'activoscorrientes', type: 'float'},
                    {name: 'pasivostotales', type: 'float'},
                    {name: 'pasivoscorrientes', type: 'float'},
                    {name: 'inventarios', type: 'float'},
                    {name: 'patrimonios', type: 'float'},
                    {name: 'utilidades', type: 'float'},
                    {name: 'ventas', type: 'float'}
                ],
                proxy: {
                    type: 'ajax',
                    url: 'reporteBeneficiosList',
                    reader: {
                        type: 'json',
                        root: 'root'
                    }
                }
            }),
            collapsible: true,
            animCollapse: false
        });

        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Reporte Beneficios Crediticios por Socio de Negocios',
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
                            width: 143,
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Empresa',
                                    name: 'empresa',
                                    id: 'empresa',
                                    allowBlank: true,
                                    height: 239,
                                    width: 140,
                                    store: <?= json_encode($empresas) ?>,
                                    style: 'text-align: left',
                                    valueField: 'idEmpresa',
                                    displayField: 'empresa',
                                    ddReorder: false
                                }]
                        }, {
                            xtype: 'fieldset',
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
                                    ddReorder: false,
                                    listeners: {
                                        change: function (select, newValue, oldValue, eOpts) {
                                            store = Ext.getCmp('vendedor').getStore();
                                            store.clearFilter();
                                            store.filter('sucursal', Ext.getCmp('sucursal').getValue());
                                        }
                                    }
                                }]
                        }, {
                            xtype: 'fieldset',
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Vendedor',
                                    name: 'vendedor',
                                    id: 'vendedor',
                                    height: 239,
                                    width: 312,
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
                                }]
                        }, {
                            xtype: 'fieldset',
                            width: 105,
                            border: 0,
                            padding: '0, 0, 0, 0',
                            collapsible: false,
                            layout: 'column',
                            items: [{
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Circular0170',
                                    name: 'circular170',
                                    id: 'circular170',
                                    allowBlank: true,
                                    height: 119,
                                    width: 100,
                                    store: <?= json_encode($circular170) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Estado',
                                    name: 'credito',
                                    id: 'credito',
                                    allowBlank: true,
                                    height: 120,
                                    width: 100,
                                    store: <?= json_encode($creditos) ?>,
                                    style: 'text-align: left',
                                    maxSelections: 1,
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
                        var data = form.getForm().getFieldValues();
                        var store = Ext.getCmp('gridReport').getStore();
                        store.removeAll();
                        form.collapse();

                        var myMask = new Ext.LoadMask({
                            msg: 'Please wait...',
                            target: Ext.getCmp('gridReport')
                        });

                        myMask.show();
                        var str = JSON.stringify(data);
                        store.load({
                            params: {
                                datos: str,
                                exporter: false
                            }, callback: function (records, operation, success) {
                                myMask.hide();
                            },
                            scope: this
                        });

                    }
                }]
        });

    })


</script>
