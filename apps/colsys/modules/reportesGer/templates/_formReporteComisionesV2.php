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
$informe = $sf_data->getRaw("informe");
$sucursales = $sf_data->getRaw("sucursales");
$vendedores = $sf_data->getRaw("vendedores");
$incoterms = $sf_data->getRaw("incoterms");
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

    Ext.define('ColsysGridValidador', {
        extend: 'Colsys.Informes.ColsysGridExporter',
        alias: 'widget.grid-validador',
        bodyPadding: '0, 0, 0, 0',
        columnLines: true,
        loadMask: {msg: 'Cargando...'},
        features: [{
                id: 'group',
                ftype: 'groupingsummary',
                groupHeaderTpl: '{name}',
                hideGroupedHeader: true,
                enableGroupingMenu: false
            }],
        columns: [
            {text: "A\u00F1o", dataIndex: 'anio'},
            {text: "Mes", dataIndex: 'mes'},
            {text: "Referencia", flex: 1, dataIndex: 'referencia', renderer: function (value, metaData, record) {
                    return Ext.String.format('<a href="/inoF2/indexExt5/idmaster/{0}" target="_blank">{1}</a>', record.get('idmaster'), value);
                }},
            {text: "Estado", dataIndex: 'std_cerrado'},
            {text: "Cliente", flex: 1, dataIndex: 'cliente'},
            {text: "Estado Cl.", flex: 1, dataIndex: 'std_cliente_emp'},
            {text: "Fch.Estado", flex: 1, dataIndex: 'std_cliente_fch'},
            {text: "Vendedor", flex: 1, dataIndex: 'vendedor'},
            {text: "Comercial", flex: 1, dataIndex: 'comercial'},
            {text: "Sucursal", flex: 1, dataIndex: 'sucursal'},
            {text: "Doc.Transporte", flex: 1, dataIndex: 'doctransporte',
                summaryType: 'count',
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return ((value === 0 || value > 1) ? '(' + value + ' Negocios)' : '(1 Negocio)');
                }},
            {text: "Incoterms", flex: 1, dataIndex: 'incoterms'},
            {text: "Circular0170", flex: 1, dataIndex: 'circular0170'},
            {text: "Vlr.Ino", flex: 1, dataIndex: 'ino_valor', xtype: 'numbercolumn', format: '0,000', align: 'right',
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.numberRenderer('0,000'),
                field: {
                    xtype: 'numberfield'
                }},
            {text: "Comision Ino", flex: 1, dataIndex: 'ino_comision', xtype: 'numbercolumn', format: '0,000', align: 'right',
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.numberRenderer('0,000'),
                field: {
                    xtype: 'numberfield'
                }},
            {text: "Vlr.Pagado", flex: 1, dataIndex: 'comision_pag', xtype: 'numbercolumn', format: '0,000', align: 'right',
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.numberRenderer('0,000'),
                field: {
                    xtype: 'numberfield'
                }},
            {text: "X Pagar", flex: 1, dataIndex: 'comision_pen', xtype: 'numbercolumn', format: '0,000', align: 'right',
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.numberRenderer('0,000'),
                field: {
                    xtype: 'numberfield'
                }},
            {text: "Diferencia", flex: 1, dataIndex: 'diferencia', xtype: 'numbercolumn', format: '0,000', align: 'right',
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.numberRenderer('0,000'),
                field: {
                    xtype: 'numberfield'
                }},
            {text: "Comprobantes", flex: 1, dataIndex: 'comprobantes'}
        ],
        store: Ext.create('Ext.data.Store', {
            autoLoad: false,
            fields: [
                {name: 'anio', type: 'string'},
                {name: 'mes', type: 'string'},
                {name: 'referencia', type: 'string'},
                {name: 'std_cerrado', type: 'string'},
                {name: 'doctransporte', type: 'string'},
                {name: 'circular0170', type: 'string'},
                {name: 'incoterms', type: 'string'},
                {name: 'vendedor', type: 'string'},
                {name: 'sucursal', type: 'string'},
                {name: 'comercial', type: 'string'},
                {name: 'ino_valor', type: 'number'},
                {name: 'ino_comision', type: 'number'},
                {name: 'comision_pag', type: 'number'},
                {name: 'comision_pen', type: 'number'},
                {name: 'diferencia', type: 'number'},
                {name: 'comprobantes', type: 'string'}
            ],
            groupField: 'vendedor',
            proxy: {
                type: 'ajax',
                timeout: 240000,
                url: '<?= url_for('reportesGer/reporteComisionesList') ?>',
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
                                        src: '/inoF2/imprimirComisiones' + '/consecutivo/' + idComp[0]
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
                                            this.up('panel').getComponent('panel-document-preview').getEl().dom.src = '/inoF2/imprimirComisiones' + '/consecutivo/' + newVal;
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

    Ext.define('ColsysGridDetallado', {
        extend: 'Colsys.Informes.ColsysGridExporter',
        alias: 'widget.grid-detallado',
        bodyPadding: '0, 0, 0, 0',
        columnLines: true,
        loadMask: {msg: 'Cargando...'},
        features: [{
                id: 'group',
                ftype: 'groupingsummary',
                groupHeaderTpl: '{name}',
                hideGroupedHeader: true,
                enableGroupingMenu: false
            }],
        viewConfig: {
            loadingHeight: 100,
            getRowClass: function (record, rowIndex, rowParams, store) {
                bg = record.data.bgcolor;
                return bg;
            }
        },
        columns: [
            {text: "Comprobante", dataIndex: 'comprobante'},
            {text: "Cons.", width: 70, dataIndex: 'consecutivo', renderer: function (value, metaData, record) {
                    if (value != "" && value != "null")
                        return '<a href="javascript:abrirVentana(\'Comprobante\',\'' + record.get('consecutivo') + '\')" >' + value + '</a>';
                    else
                        return '';
                }},
            {text: "Cliente", flex: 1, dataIndex: 'cliente'},
            {text: "Estado Cl.", width: 100, dataIndex: 'std_cliente_emp'},
            {text: "Fch.Estado", flex: 1, dataIndex: 'std_cliente_fch'},
            {text: "Comercial", dataIndex: 'comercial'},
            {text: "Sucursal", dataIndex: 'sucursal'},
            {text: "Doc.Transporte", flex: 1, dataIndex: 'doctransporte',
                summaryType: 'count',
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return ((value === 0 || value > 1) ? '(' + value + ' Negocios)' : '(1 Negocio)');
                }},
            {text: "Incoterms", width: 100, dataIndex: 'incoterms'},
            {text: "Circular0170", dataIndex: 'circular0170'},
            {text: "Valor Ino", width: 100, dataIndex: 'ino_total', xtype: 'numbercolumn', format: '0,000', align: 'right',
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.numberRenderer('0,000'),
                field: {
                    xtype: 'numberfield'
                }},
            {text: "Comision", width: 90, dataIndex: 'comision', xtype: 'numbercolumn', format: '0,000', align: 'right',
                summaryType: 'sum',
                summaryRenderer: Ext.util.Format.numberRenderer('0,000'),
                field: {
                    xtype: 'numberfield'
                }},
            {text: "Reporte Neg.", width: 110, dataIndex: 'reporte_neg', renderer: function (value, metaData, record) {
                    if (value != "" && value != "null")
                        return '<a href="javascript:abrirVentana(\'ReporteNeg\',\'' + record.get('reporte_neg') + '\')" >' + value + '</a>';
                    else
                        return '';
                }},
            {text: "Fecha RN", width: 100, dataIndex: 'reporte_fch'},
            {text: "Referencia", width: 100, dataIndex: 'referencia', renderer: function (value, metaData, record) {
                    return Ext.String.format('<a href="/inoF2/indexExt5/idmaster/{0}" target="_blank">{1}</a>', record.get('idmaster'), value);
                }},
            {text: "Estado Ref.", width: 100, dataIndex: 'estado_ref'},
            {text: "Facturas", flex: 1, dataIndex: 'facturas'},
            {text: "Docs.Cruce", flex: 1, dataIndex: 'crucedocs'},
            {text: "Causado", width: 100, dataIndex: 'fchcausado'},
            {text: "Liquidado", width: 100, dataIndex: 'fchliquidado'}
        ],
        store: Ext.create('Ext.data.Store', {
            autoLoad: false,
            groupField: 'comprobante',
            proxy: {
                type: 'ajax',
                timeout: 120000,
                url: '<?= url_for('reportesGer/reporteComisionesDets') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }
        }),
        collapsible: false,
        animCollapse: false
    });

    Ext.define('ColsysGridPorCobrar', {
        extend: 'Colsys.Informes.ColsysGridExporter',
        alias: 'widget.grid-por-cobrar',
        bodyPadding: '0, 0, 0, 0',
        title: 'Informe de Comisiones Pendientes por Cobrar',
        columnLines: true,
        loadMask: {msg: 'Cargando...'},
        features: [{
                id: 'group',
                ftype: 'groupingsummary',
                groupHeaderTpl: '{name}',
                hideGroupedHeader: true,
                enableGroupingMenu: false
            }],
        viewConfig: {
            loadingHeight: 100,
            getRowClass: function (record, rowIndex, rowParams, store) {
                bg = record.data.bgcolor;
                return bg;
            }
        },
        columns: [
            {text: 'Vendedor', dataIndex: 'vendedor', width: 80},
            {text: 'Llave', dataIndex: 'llave', width: 80},
            {text: 'Referencia', dataIndex: 'referencia', width: 130},
            {text: 'Doc.Transporte', dataIndex: 'doctransporte', flex: 2},
            {text: 'Cliente', dataIndex: 'cliente', flex: 2},
            {text: 'Reporte', dataIndex: 'reporte', width: 90},
            {text: 'Incoterm', dataIndex: 'incoterms', idth: 50},
            {text: 'Concepto', dataIndex: 'concepto', flex: 1},
            {text: 'Valor Ino', dataIndex: 'utilidad', align: 'right', renderer: Ext.util.Format.usMoney, width: 140,
                summaryType: function (records) {
                    var total = 0,
                            record;

                    for (i = 0; i < records.length; ++i) {
                        record = records[i];
                        total += parseFloat(record.get('utilidad'));
                    }
                    return total;
                },
                summaryRenderer: Ext.util.Format.usMoney},
            {text: 'Comisi\u00f3n', dataIndex: 'comision', align: 'right', renderer: Ext.util.Format.usMoney, width: 120,
                summaryType: function (records) {
                    var total = 0,
                            record;

                    for (i = 0; i < records.length; ++i) {
                        record = records[i];
                        total += parseFloat(record.get('comision'));
                    }
                    return total;
                },
                summaryRenderer: Ext.util.Format.usMoney},
            {text: 'Factura(s)', dataIndex: 'facturas', width: 80},
            {text: 'Comp.Cruce', dataIndex: 'crucescomp', width: 80},
            {text: 'Caus\u00f3', dataIndex: 'usucausado', width: 80},
            {text: 'Fecha', dataIndex: 'fchcausado', width: 140},
            {text: 'Comentario', dataIndex: 'comentario', width: 140},
            {text: 'Color', dataIndex: 'bgcolor', width: 0},
            {text: 'Vendedor', dataIndex: 'vendedor', width: 0}
        ],
        store: Ext.create('Ext.data.Store', {
            autoLoad: false,
            groupField: 'vendedor',
            proxy: {
                type: 'ajax',
                timeout: 3600000,
                url: '<?= url_for('reportesGer/reporteComisionesSinp') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }
        }),
        collapsible: false,
        animCollapse: false
    });

    Ext.define('ColsysGridConPerdida', {
        extend: 'Colsys.Informes.ColsysGridExporter',
        alias: 'widget.grid-con-perdida',
        bodyPadding: '0, 0, 0, 0',
        title: 'Informe de Casos con Perdida',
        columnLines: true,
        loadMask: {msg: 'Cargando...'},
//        features: [{
//                id: 'group',
//                ftype: 'groupingsummary',
//                groupHeaderTpl: '{name}',
//                hideGroupedHeader: true,
//                enableGroupingMenu: false
//            }],
//        viewConfig: {
//            loadingHeight: 100,
//            getRowClass: function (record, rowIndex, rowParams, store) {
//                bg = record.data.bgcolor;
//                return bg;
//            }
//        },
        viewConfig: {
            loadingHeight: 100
        },
        columns: [
            {text: "Referencia", flex: 1, dataIndex: 'referencia', renderer: function (value, metaData, record) {
                    return Ext.String.format('<a href="/inoF2/indexExt5/idmaster/{0}" target="_blank">{1}</a>', record.get('idmaster'), value);
                }},                    
            {text: 'Doc.Master', dataIndex: 'master', flex: 2, },
            {text: 'Cliente', dataIndex: 'cliente', flex: 2},
            {text: 'Reporte', dataIndex: 'reporte_neg', width: 90},
            {text: 'Fch.Rep', dataIndex: 'reporte_fch', width: 50},
            {text: 'Incoterm', dataIndex: 'incoterms', width: 50},
            {text: 'Doc.Transporte', dataIndex: 'doctransporte', flex: 2},
            {text: 'Vendedor', dataIndex: 'vendedor', width: 180},
            {text: 'Sucursal', dataIndex: 'sucursal', width: 80},
            {text: 'Fecha Llegada', dataIndex: 'fchllegada', width: 100},
            {text: 'Estado', dataIndex: 'estado_ref', width: 80},

            {text: 'Valor Facturado', dataIndex: 'vlrfacturado', align: 'right', renderer: Ext.util.Format.usMoney, width: 140,
                summaryType: function (records) {
                    var total = 0,
                            record;

                    for (i = 0; i < records.length; ++i) {
                        record = records[i];
                        total += parseFloat(record.get('vlrfacturado'));
                    }
                    return total;
                },
                summaryRenderer: Ext.util.Format.usMoney},
            {text: 'Deducciones', dataIndex: 'vlrdeducciones', align: 'right', renderer: Ext.util.Format.usMoney, width: 120,
                summaryType: function (records) {
                    var total = 0,
                            record;

                    for (i = 0; i < records.length; ++i) {
                        record = records[i];
                        total += parseFloat(record.get('vlrdeducciones'));
                    }
                    return total;
                },
                summaryRenderer: Ext.util.Format.usMoney},
            {text: 'Costos', dataIndex: 'vlrcostos', align: 'right', renderer: Ext.util.Format.usMoney, width: 120,
                summaryType: function (records) {
                    var total = 0,
                            record;

                    for (i = 0; i < records.length; ++i) {
                        record = records[i];
                        total += parseFloat(record.get('vlrcostos'));
                    }
                    return total;
                },
                summaryRenderer: Ext.util.Format.usMoney},
            {text: 'Vlr.Ino', dataIndex: 'vlrperdida', align: 'right', renderer: Ext.util.Format.usMoney, width: 120,
                summaryType: function (records) {
                    var total = 0,
                            record;

                    for (i = 0; i < records.length; ++i) {
                        record = records[i];
                        total += parseFloat(record.get('vlrperdida'));
                    }
                    return total;
                },
                summaryRenderer: Ext.util.Format.usMoney},
            {text: 'Ing.Individual', dataIndex: 'vlrsobreventa', align: 'right', renderer: Ext.util.Format.usMoney, width: 120,
                summaryType: function (records) {
                    var total = 0,
                            record;

                    for (i = 0; i < records.length; ++i) {
                        record = records[i];
                        total += parseFloat(record.get('vlrsobreventa'));
                    }
                    return total;
                },
                summaryRenderer: Ext.util.Format.usMoney},
        ],
        store: Ext.create('Ext.data.Store', {
            autoLoad: false,
            groupField: 'vendedor',
            proxy: {
                type: 'ajax',
                timeout: 3600000,
                url: '<?= url_for('reportesGer/reporteCasosConPerdida') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }
        }),
        collapsible: false,
        animCollapse: false
    });

    var abrirVentana = function (documento, consecutivo) {
        var url = "";
        if (documento == "Comprobante") {
            url = '/inoF2/imprimirComisiones' + '/consecutivo/' + consecutivo
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
            renderTo: Ext.get('se-report')
        });

        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Reporte Validador de Comisiones',
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
                                    width: 80,
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
                                    width: 80,
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
                                    height: 174,
                                    width: 115,
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
                                    width: 115,
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
                                    width: 115,
                                    store: <?= json_encode($estados) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false
                                }]
                        }, {
                            xtype: 'fieldset',
                            height: 330,
                            width: 148,
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
                                    height: 215,
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
                                    title: 'Informe',
                                    name: 'informe',
                                    id: 'informe',
                                    allowBlank: false,
                                    width: 143,
                                    maxSelections: 1,
                                    store: <?= json_encode($informe) ?>,
                                    style: 'text-align: left',
                                    ddReorder: false,
                                    listeners: {
                                        change: function (multiselect) {
                                            Ext.getCmp('containerReport').removeAll();
                                            if ((multiselect.getValue())[0] == 'Validador') {
                                                Ext.getCmp('containerReport').add({
                                                    id: 'gridValidador',
                                                    xtype: 'grid-validador'
                                                });
                                            } else if ((multiselect.getValue())[0] == 'Detallado') {
                                                Ext.getCmp('containerReport').add({
                                                    id: 'gridDetallado',
                                                    xtype: 'grid-detallado'
                                                });
                                            } else if ((multiselect.getValue())[0] == 'Por Cobrar') {
                                                Ext.getCmp('containerReport').add({
                                                    id: 'gridPorCobrar',
                                                    xtype: 'grid-por-cobrar'
                                                });
                                            } else if ((multiselect.getValue())[0] == 'Con Perdida') {
                                                Ext.getCmp('containerReport').add({
                                                    id: 'gridConPerdida',
                                                    xtype: 'grid-con-perdida'
                                                });
                                            }
                                        }
                                    }
                                }]
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Vendedores',
                            name: 'vendedor',
                            id: 'vendedor',
                            height: 330,
                            width: 345,
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
                            title: 'Por peri\u00F3do de cierre',
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
                        } else if (data.impoexpo.length == 0) {
                            Ext.Msg.alert("Error", "Debe seleccionar un criterio de Impo/Expo para el informe!");
                            return;
                        } else if (data.transporte.length == 0) {
                            Ext.Msg.alert("Error", "Debe seleccionar un criterio de Transporte para el informe!");
                            return;
                        } else if (data.estado.length == 0) {
                            Ext.Msg.alert("Error", "Debe seleccionar un criterio de Estado para el informe!");
                            return;
                        } else if (data.sucursal.length == 0) {
                            Ext.Msg.alert("Error", "Debe seleccionar un elemento de Sucursal para el informe!");
                            return;
                        } else {
                            if (data.informe[0] == "Validador") {
                                var store = Ext.getCmp('gridValidador').getStore();
                            } else if (data.informe[0] == "Detallado") {
                                var store = Ext.getCmp('gridDetallado').getStore();
                            } else if (data.informe[0] == "Por Cobrar") {
                                var store = Ext.getCmp('gridPorCobrar').getStore();
                            } else if (data.informe[0] == "Con Perdida") {
                                var store = Ext.getCmp('gridConPerdida').getStore();
                            }
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

        Ext.getCmp('informe').setValue('Validador');
    })
</script>
