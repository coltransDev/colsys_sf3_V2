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
$vendedores = $sf_data->getRaw("vendedores");
$empresas = $sf_data->getRaw("empresas");
?>

<style>
    /*Inicio Julio*/

    .x-panel-header-default-horizontal {
        padding: 0;
    }

    .x-grid-group-title {
        text-align: left;
        text-transform: uppercase;
        font-weight: bold;
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


<table width="830" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-form"></div><br>
        </td>
    </tr>
</table>

<table width="95%" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-report"></div><br>
        </td>
    </tr>
</table>

<script type="text/javascript">
    var win_file = null;

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

    Ext.define('ColsysGridCotizaciones', {
        extend: 'Colsys.Informes.ColsysGridExporter',
        alias: 'widget.grid-cotizaciones',
        bodyPadding: '0, 0, 0, 0',
        columnLines: true,
        loadMask: {msg: 'Cargando...'},
        features: [{
                id: 'group',
                ftype: 'groupingsummary',
                groupHeaderTpl: '{name}',
                hideGroupedHeader: true,
                enableGroupingMenu: false,
                showSummaryRow: true
            }],
        columns: [
            {text: "A\u00F1o", dataIndex: 'anio', width:100},
            {text: "Mes", dataIndex: 'mes'},
            {text: "Cotizaci\u00F3n", width:150, dataIndex: 'consecutivo', renderer: function (value, metaData, record) {
                    return Ext.String.format('<a href="/cotizaciones/verCotizacion/id/{0}" target="_blank">{1}</a>', record.get('idcotizacion'), value);
                }
            },
            {text: "Versi\u00F3n", dataIndex: 'version',  width:100,
                summaryType: 'count',
                summaryRenderer: function (value) {
                    return Ext.String.format('{0} Version{1}', value, value !== 1 ? 'es' : '');
                }
            },
            {text: "ID Cotizacion", dataIndex: 'idcotizacion', width:150},
            {text: "Cliente", dataIndex: 'cliente', width:250},
            {text: "Vendedor" , dataIndex: 'vendedor', width:150},
            {text: "Sucursal",  dataIndex: 'sucursal', width:100},
            {text: "Empresa", dataIndex: 'empresa', width:150},
            {text: "Estado", dataIndex: 'estado', width:150},
            {text: "Usu.Creado",  dataIndex: 'usucreado', width:150},
            {text: "Fch.Creado",  dataIndex: 'fchcreado', width:150},
            {text: "Usu.Actualizado", dataIndex: 'usuactualizado', width:150},
            {text: "Fch.Actualizado",  dataIndex: 'fchactualizado', width:150},
            {text: "Fch.Solicitud", dataIndex: 'fchsolicitud', width:150},
            {text: "Fch.Vencimiento",  dataIndex: 'fchvencimiento', width:150},
            {text: "Usu.Envío", dataIndex: 'usuenvio', width:150},
            {text: "Fch.Envío",  dataIndex: 'fchenvio', width:150},
            {text: "Id.Producto",  dataIndex: 'idproducto', width:100},
            {text: "Cod.Origen",  dataIndex: 'codorigen', width:100},
            {text: "Origen",  dataIndex: 'origen', width:200},
            {text: "Cod.Destino",  dataIndex: 'coddestino', width:100},
            {text: "Destino",  dataIndex: 'destino', width:150},
            {text: "Modalidad",  dataIndex: 'modalidad', width:80},
            {text: "Incoterms",  dataIndex: 'incoterms', width:150},
            {text: "Flujo",  dataIndex: 'impoexpo', width:150}, //importación ó exportación
            {text: "Transporte",  dataIndex: 'transporte', width:100},
            {text: "ID Línea",  dataIndex: 'idlinea', width:150},
            {text: "L\u00CDnea",  dataIndex: 'linea', width:200},
            {text: "ID.Concepto",  dataIndex: 'concepto', width:80}, 
            {text: "Tarifa Neta",  dataIndex: 'tarifaneta', width:100},
            {text: "Tarifa Mínima",  dataIndex: 'tarifamin', width:130},
            {text: "Valor Mínimo",  dataIndex: 'valormin', width:100},
            {text: "Etapa",  dataIndex: 'etapa', width:100},
            {text: "Moneda", dataIndex: 'idmoneda', width:80},
            {text: "Seguimiento", dataIndex: 'seguimiento', width:150}
            //{text: "Contacto" , dataIndex: 'contacto', width:150},
            //{text: "Usu.Anulado",  dataIndex: 'usuanulado', width:100},
            //{text: "Fch.Anulado",  dataIndex: 'fchanulado', width:100},
            // {text: "Valor Neto",  dataIndex: 'valorneto', width:100},
            //{text: "Fch.Terminada", dataIndex: 'fchterminada', width:150},
        ],
        store: Ext.create('Ext.data.Store', {
            autoLoad: false,
            fields: [
                {name: 'anio', type: 'string'},
                {name: 'mes', type: 'string'},
                {name: 'idcotizacion', type: 'string'},
                {name: 'consecutivo', type: 'string'},
                {name: 'version', type: 'string'},
                {name: 'cliente', type: 'string'},
//                {name: 'contacto', type: 'string'},
                {name: 'empresa', type: 'string'},
                {name: 'vendedor', type: 'string'},
                {name: 'sucursal', type: 'string'},
                {name: 'estado', type: 'string'},
                {name: 'usucreado', type: 'string'},
                {name: 'fchcreado', type: 'string'},
                {name: 'usuactualizado', type: 'string'},
                {name: 'fchactualizado', type: 'string'},
                {name: 'fchsolicitud', type: 'string'},
                {name: 'fchvencimiento', type: 'string'},
                {name: 'usuenvio', type: 'string'},
                {name: 'fchenvio', type: 'string'}, 
                {name: 'idproducto', type: 'string'},
                {name: 'codorigen', type: 'string'},
                {name: 'origen', type: 'string'},
                {name: 'coddestino', type: 'string'},
                {name: 'destino', type: 'string'},
                {name: 'modalidad', type: 'string'},
                {name: 'incoterms', type: 'string'},
                {name: 'impoexpo', type: 'string'},
                {name: 'transporte', type: 'string'},
                {name: 'linea', type: 'string'},
                {name: 'concepto', type: 'string'},
                {name: 'tarifaneta', type: 'string'},
                {name: 'tarifamin', type: 'string'},
//                {name: 'valorneto', type: 'string'},
                {name: 'valormin', type: 'string'},
                {name: 'etapa', type: 'string'},
                {name: 'idlinea', type: 'string'},
                {name: 'idmoneda', type: 'string'},
                {name: 'seguimiento', type: 'string'}
   
                
            ],
            groupField: 'vendedor',
            proxy: {
                type: 'ajax',
                timeout: 240000,
                url: '<?= url_for('reportesGer/reporteCotizacionesList') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }
        }),
        viewConfig: {
            loadingHeight: 100
        },
        listeners: {
            cellclick: function (table, td, cellIndex, record, tr, rowIndex, e, eOpts) {
                if (cellIndex == 18 && record.get('comprobantes')) {
                    if (win_file == null) {
                        var size = Ext.Element.getViewSize();
                        var idComp = record.get('comprobantes').split(",");
                        win_file = new Ext.Window({
                            title: 'Vista Preliminar del Documento',
                            floating: true,
                            height: size.height * .85,
                            width: size.width * .55,

                            items: [{
                                    xtype: 'component',
                                    itemId: 'panel-document-preview',
                                    autoEl: {
                                        tag: 'iframe',
                                        width: '100%',
                                        height: '100%',
                                        frameborder: '0',
                                        scrolling: 'auto',
                                        src: '/inoF2/imprimirCotizaciones' + '/consecutivo/' + idComp[0]
                                    }
                                }],
                            listeners: {
                                close: function (panel, eOpts) {
                                    win_file = null;
                                }
                            },
                            center: function () {
                                var me = this,
                                        top = window.pageYOffset || document.documentElement.scrollTop;
                                this.y = top;
                            },
                            bbar: [{
                                    fieldLabel: 'Ver otros Comprobantes',
                                    labelWidth: 150,
                                    width: 240,
                                    xtype: 'combobox',
                                    store: idComp,
                                    listeners: {
                                        change: function (combo, newVal, oldVal, eOpts) {
                                            this.up('panel').getComponent('panel-document-preview').getEl().dom.src = '/inoF2/imprimirCotizaciones' + '/consecutivo/' + newVal;
                                        }
                                    }
                                }]
                        });
                    }
                    win_file.center();
                    win_file.show();
                }
            }
        },
        collapsible: false,
        animCollapse: false
    });

    var abrirVentana = function (documento, consecutivo) {
        var url = "";
        if (documento == "Comprobante") {
            url = '/inoF2/imprimirCotizaciones' + '/consecutivo/' + consecutivo
        } else if (documento == "ReporteNeg") {
            url = '/reportesNeg/generarPDF' + '/consecutivo/' + consecutivo
        }
        if (win_file == null) {
            var size = Ext.Element.getViewSize();
            win_file = new Ext.Window({
                title: 'Vista Preliminar del Documento',
                floating: true,
                height: size.height * .85,
                width: size.width * .55,

                items: [{
                        xtype: 'component',
                        itemId: 'panel-document-preview',
                        autoEl: {
                            tag: 'iframe',
                            width: '100%',
                            height: '100%',
                            frameborder: '0',
                            scrolling: 'auto',
                            src: url
                        }
                    }],
                listeners: {
                    close: function (panel, eOpts) {
                        win_file = null;
                    }
                },
                center: function () {
                    var me = this,
                            top = window.pageYOffset || document.documentElement.scrollTop;
                    this.y = top;
                }
            });
        }
        win_file.center();
        win_file.show();
    }

    Ext.onReady(function () {
        Ext.create('Ext.container.Container', {
            id: 'containerReport',
            renderTo: Ext.get('se-report'),
            items: {
                id: 'gridCotizaciones',
                xtype: 'grid-cotizaciones'
            }
        });

        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Reporte Elaboraci\u00F3n de Cotizaciones',
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
                                    height: 140,
                                    width: 100,
                                    store: <?= json_encode($annos) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Empresa',
                                    name: 'empresa',
                                    id: 'empresa',
                                    allowBlank: true,
                                    height: 188,
                                    width: 100,
                                    store: <?= json_encode($empresas) ?>,
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
                                    title: 'Estado',
                                    name: 'estado',
                                    id: 'estado',
                                    allowBlank: false,
                                    height: 191,
                                    width: 118,
                                    store: {
                                        fields: [{name: 'idestado', type: 'string'}, {name: 'estado', type: 'string'}],
                                        data: <?= json_encode($estados) ?>
                                    },
                                    style: 'text-align: left',
                                    valueField: 'idestado',
                                    displayField: 'estado',
                                    ddReorder: false
                                }, {
                                    xtype: 'multiselect',
                                    msgTarget: 'side',
                                    title: 'Impo/Expo',
                                    name: 'impoexpo',
                                    id: 'impoexpo',
                                    allowBlank: false,
                                    width: 118,
                                    store: <?= json_encode($impoexpo) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }]
                        }, {
                            xtype: 'fieldset',
                            height: 330,
                            width: 135,
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
                                    width: 130,
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
                                    title: 'Transporte',
                                    name: 'transporte',
                                    id: 'transporte',
                                    allowBlank: false,
                                    width: 130,
                                    store: <?= json_encode($transportes) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }]
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Vendedores',
                            name: 'vendedor',
                            id: 'vendedor',
                            height: 330,
                            width: 340,
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
                    xtype: 'container',
                    columnWidth: 1,
                    collapsible: false,
                    border: 0,
                    layout: 'column',
                    defaults: {
                        xtype: 'fieldset',
                        collapsible: false,
                        height: 53
                    },
                    items: [{
                            title: 'Por periodo de env\u00EDo',
                            defaults: {anchor: '99%'},
                            columnWidth: 0.40,
                            layout: 'hbox',
                            items: [{
                                    xtype: 'datefield',
                                    width: 150,
                                    labelWidth: 40,
                                    fieldLabel: 'Desde',
                                    name: 'fch_ini',
                                    format: 'Y-m-d'
                                }, {
                                    xtype: 'datefield',
                                    width: 150,
                                    labelWidth: 40,
                                    fieldLabel: 'Hasta',
                                    name: 'fch_fin',
                                    format: 'Y-m-d'
                                }]
                        }, {
                            title: 'Cliente',
                            defaults: {anchor: '99%'},
                            columnWidth: 0.59,
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
                    // formBind: true, //only enabled once the form is valid
                    // disabled: true,
                    handler: function () {
                        var form = this.up('form');
                        var data = form.getForm().getFieldValues();

                        if (data.fch_ini == null && data.fch_fin == null && (data.anio.length == 0 || data.mes.length == 0)) {
                            Ext.Msg.alert("Error", "Debe seleccionar un periodo para el informe!");
                            return;
                        } else if (data.estado.length == 0) {
                            Ext.Msg.alert("Error", "Debe seleccionar un criterio de Estado para el informe!");
                            return;
                        } else if (data.sucursal.length == 0) {
                            Ext.Msg.alert("Error", "Debe seleccionar un elemento de Sucursal para el informe!");
                            return;
                        } else if (data.empresa.length == 0) {
                            Ext.Msg.alert("Error", "Debe seleccionar un criterio de Empresa para el informe!");
                            return;
                        } else {
                            var store = Ext.getCmp('gridCotizaciones').getStore();
                            store.removeAll();
                            form.collapse();
                            var str = JSON.stringify(data);
                            Ext.getBody().mask('Cargando Resultados');
                            store.getProxy().extraParams = {
                                datos: str
                            };
                            store.load();
                            Ext.getBody().unmask();
                        }
                    }
                }]
        });
    })
</script>
