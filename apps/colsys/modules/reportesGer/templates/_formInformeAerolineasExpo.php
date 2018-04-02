<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$aerolineas = $sf_data->getRaw("aerolineas");
?>
<div align="center" id="container"></div>
<br />
<div align="center" id="results"></div>
<br />
<div align="center" id="totals"></div>

<script language="javascript">
    var win_pasivos = null;

    var formGenerarPasivos = Ext.create('Ext.form.Panel', {
        bodyPadding: '5 5 0',
        width: 350,
        fieldDefaults: {
            msgTarget: 'side',
            labelWidth: 140
        },
        items: [{
                xtype: 'datefield',
                fieldLabel: 'Fecha Generaci\u00F3n',
                name: 'comprobante_fch',
                allowBlank: false,
                format: 'Y-m-d',
                tooltip: 'Ingrese la Fecha de Contabilizaci\u00F3n.'
            }, {
                xtype: 'textfield',
                fieldLabel: '# Registros a Procesar',
                name: 'registros_num',
                readOnly: true,
                tooltip: 'N\u00FAmero de Registros a Procesar'
            }
        ],
        buttons: [{
                text: 'Generar',
                handler: function () {
                    var me = this;
                    var form = me.up('form').getForm();
                    var comprobante_fch = form.getValues().comprobante_fch;
                    var idproveedor = Ext.getCmp('formCriterios').getForm().getValues().idCarrier;
                    var store = Ext.getCmp('grid_results').getStore();
                    
                    j = 0;
                    changes = [];
                    for (var i = 0; i < store.getCount(); i++) {
                        r = store.getAt(i);
                        if (r.data.sel) {
                            changes[j] = r.data;
                            j++;
                        }
                    }

                    var str = JSON.stringify(changes);
                    
                    if (form.isValid()) {
                        Ext.Ajax.request({
                            waitMsg: 'Generando Pasivos...',
                            url: '/reportesGer/generarPasivos',
                            params: {
                                comprobante_fch: comprobante_fch,
                                idproveedor: idproveedor,
                                datos: str
                            },
                            failure: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.errorInfo)
                                    Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');

                            },
                            success: function (response, options) {
                                var res = Ext.decode(response.responseText);
                                ids = res.ids;
                                if (res.success) {
                                    Ext.MessageBox.alert("Mensaje", 'Pasivos Generados Satisfactoriamente!');
                                    storeInfoFinanciera.reload();
                                    this.up('window').close();
                                } else {
                                    Ext.MessageBox.alert("Mensaje", 'Error en la Generaci\u00F3n de los Pasivos');
                                }
                            }
                        });
                        
                    }
                }
            }, {
                text: 'Cancelar',
                handler: function () {
                    this.up('window').close();
                }
            }]
    });

    Ext.onReady(function () {
        Ext.QuickTips.init();

        // create the grid
        Ext.create('Ext.grid.Panel', {
            id: 'grid_totals',
            store: Ext.create('Ext.data.Store', {
                fields: [
                    {name: 'charges_code', type: 'string'},
                    {name: 'flete_usd', type: 'float'},
                    {name: 'flete_cop', type: 'int'},
                    {name: 'dagent_usd', type: 'float'},
                    {name: 'dagent_cop', type: 'int'},
                    {name: 'dcarrier_usd', type: 'float'},
                    {name: 'dcarrier_cop', type: 'int'},
                    {name: 'otros_usd', type: 'float'},
                    {name: 'otros_cop', type: 'int'},
                    {name: 'total_usd', type: 'float'},
                    {name: 'total_cop', type: 'int'}
                ],
                proxy: {
                    type: 'memory',
                    reader: {
                        type: 'json',
                        root: 'tots'
                    },
                    autoLoad: false
                }
            }),
            columns: [
                {
                    text: "Carga",
                    flex: 1,
                    dataIndex: 'charges_code'
                }, {
                    text: "Flete USD",
                    width: 110,
                    dataIndex: 'flete_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    align: "right"
                }, {
                    text: "Flete COP",
                    width: 120,
                    dataIndex: 'flete_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    align: "right"
                }, {
                    text: "DAgent USD",
                    width: 110,
                    dataIndex: 'dagent_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    align: "right"
                }, {
                    text: "DAgent COP",
                    width: 120,
                    dataIndex: 'dagent_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    align: "right"
                }, {
                    text: "DCarrier USD",
                    width: 110,
                    dataIndex: 'dcarrier_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    align: "right"
                }, {
                    text: "DCarrier COP",
                    width: 120,
                    dataIndex: 'dcarrier_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    align: "right"
                }, {
                    text: "Otros USD",
                    width: 110,
                    dataIndex: 'otros_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    align: "right"
                }, {
                    text: "Otros COP",
                    width: 120,
                    dataIndex: 'otros_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    align: "right"
                }, {
                    text: "Total USD",
                    width: 110,
                    dataIndex: 'total_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    align: "right"
                }, {
                    text: "Total COP",
                    width: 120,
                    dataIndex: 'total_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    align: "right"
                }
            ],
            viewConfig: {
                stripeRows: true
            },
            renderTo: 'totals',
            width: 1218,
            height: 100
        });


        // create the grid
        Ext.create('Ext.grid.Panel', {
            id: 'grid_results',
            store: Ext.create('Ext.data.Store', {
                fields: [
                    {name: 'sel', type: 'string'},
                    {name: 'referencia', type: 'string'},
                    {name: 'master', type: 'string'},
                    {name: 'comprobante', type: 'string'},
                    {name: 'origen', type: 'string'},
                    {name: 'destino', type: 'string'},
                    {name: 'fchsalida', type: 'string'},
                    {name: 'peso', type: 'float'},
                    {name: 'charges_code', type: 'string'},
                    {name: 'tarifa', type: 'float'},
                    {name: 'tcambio', type: 'float'},
                    {name: 'flete_usd', type: 'float'},
                    {name: 'flete_cop', type: 'int'},
                    {name: 'dagent_usd', type: 'float'},
                    {name: 'dagent_cop', type: 'int'},
                    {name: 'dcarrier_usd', type: 'float'},
                    {name: 'dcarrier_cop', type: 'int'},
                    {name: 'otros_usd', type: 'float'},
                    {name: 'otros_cop', type: 'int'},
                    {name: 'total_usd', type: 'float'},
                    {name: 'total_cop', type: 'int'}
                ]
            }),
            cargarDatos: function (idCarrier, fechaInicial, fechaFinal) {
                Ext.Ajax.request(
                        {
                            waitMsg: 'Cargando Datos...',
                            url: '/reportesGer/datosInformeAerolineasExpo',
                            params: {
                                idCarrier: idCarrier,
                                fechaInicial: fechaInicial,
                                fechaFinal: fechaFinal
                            },
                            success: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);

                                Ext.getCmp('grid_results').getStore().loadData(res.root);
                                Ext.getCmp('grid_totals').getStore().loadData(res.tots);
                            },
                            failure: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.err)
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                                else
                                    Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                            }
                        });
                return true;
            },
            columns: [
                {
                    text: "Sel",
                    xtype: 'checkcolumn',
                    menuDisabled: true,
                    width: 45,
                    dataIndex: 'sel',
                    renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                        if (!record.data.idcomprobante) {
                            return (new Ext.grid.column.CheckColumn).renderer(value);
                        } else {
                             metaData.css = " x-item-disabled";
                        }
                    }
                }, {
                    text: "Referencia",
                    width: 140,
                    dataIndex: 'referencia'
                }, {
                    text: "Master",
                    width: 140,
                    dataIndex: 'master'
                }, {
                    text: "Comprobante",
                    width: 100,
                    dataIndex: 'idcomprobante'
                }, {
                    text: "Origen",
                    width: 130,
                    dataIndex: 'origen'
                }, {
                    text: "Destino",
                    width: 150,
                    dataIndex: 'destino'
                }, {
                    text: "Fecha",
                    width: 100,
                    dataIndex: 'fchsalida'
                }, {
                    text: "Kilos",
                    width: 80,
                    dataIndex: 'peso',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "CC/PP",
                    width: 65,
                    dataIndex: 'charges_code'
                }, {
                    text: "Tarifa",
                    width: 80,
                    dataIndex: 'tarifa',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000.00');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "TCambio",
                    width: 90,
                    dataIndex: 'tcambio',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    align: "right"
                }, {
                    text: "Flete USD",
                    width: 110,
                    dataIndex: 'flete_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000.00');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "Flete COP",
                    width: 120,
                    dataIndex: 'flete_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "DAgent USD",
                    width: 110,
                    dataIndex: 'dagent_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000.00');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "DAgent COP",
                    width: 120,
                    dataIndex: 'dagent_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "DCarrier USD",
                    width: 110,
                    dataIndex: 'dcarrier_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000.00');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "DCarrier COP",
                    width: 120,
                    dataIndex: 'dcarrier_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "Otros USD",
                    width: 110,
                    dataIndex: 'otros_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000.00');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "Otros COP",
                    width: 120,
                    dataIndex: 'otros_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "Total USD",
                    width: 110,
                    dataIndex: 'total_usd',
                    xtype: 'numbercolumn',
                    format: '0,000.00',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000.00');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }, {
                    text: "Total COP",
                    width: 120,
                    dataIndex: 'total_cop',
                    xtype: 'numbercolumn',
                    format: '0,000',
                    summaryType: "sum",
                    summaryRenderer: function (v, params, data) {
                        v = Ext.util.Format.number(v, '0,000');
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    },
                    align: "right"
                }
            ],
            features: [{
                    id: 'group',
                    ftype: 'summary'
                }],
            renderTo: 'results',
            width: 1218,
            height: 300,
            dockedItems: [{
                    xtype: 'toolbar',
                    items: [{
                            iconCls: 'disk',
                            text: 'Generar Pasivos',
                            scope: this,
                            handler: function () {
                                regs = 0;
                                
                                Ext.getCmp('grid_results').getStore().each(function(record){
                                    if(record.get('sel')){
                                        regs++;
                                    }
                                });
                                fecha = Ext.getCmp('formCriterios').getForm().getValues().fechaFinal;
                                
                                if (win_pasivos == null) {
                                    win_pasivos = new Ext.Window({
                                        id: 'winGenerarPasivos',
                                        title: 'Generaci\u00F3n de Pasivos',
                                        width: 352,
                                        closeAction: 'close',
                                        items: {
                                            xtype: formGenerarPasivos
                                        }
                                    });
                                }
                                var data = {
                                    "comprobante_fch": fecha,
                                    "registros_num" : regs
                                };
                                win_pasivos.down('form').getForm().setValues(data);
                                win_pasivos.show();
                            }
                        }]
                }]
        });

        var form = Ext.create('Ext.form.Panel', {
            id: 'formCriterios',
            renderTo: 'container',
            title: 'Criterios de Selecci\u00F3n',
            autoHeight: true,
            width: 800,
            bodyPadding: 10,
            defaults: {
                anchor: '100%',
                labelWidth: 60
            },
            items: [{
                    xtype: 'fieldcontainer',
                    fieldLabel: 'Aerolinea',
                    combineErrors: true,
                    msgTarget: 'side',
                    layout: 'hbox',
                    defaults: {
                        flex: 1,
                        hideLabel: true
                    },
                    items: [{
                            id: 'idCarrier',
                            name: 'idCarrier',
                            xtype: 'combo',
                            queryMode: 'local',
                            displayField: 'carrier',
                            valueField: 'idcarrier',
                            forceSelection: true,
                            allowBlank: true,
                            store: <?= json_encode($aerolineas) ?>,
                            flex: 2
                        }, {
                            xtype: 'label',
                            text: 'Periodo:',
                            margin: '4 5 0 5',
                            flex: 0
                        }, {
                            xtype: 'datefield',
                            name: 'fechaInicial',
                            fieldLabel: 'Inicial',
                            format: 'Y-m-d',
                            value: '<?= $fechaInicial ?>',
                            margin: '0 5 0 0',
                            allowBlank: false
                        }, {
                            xtype: 'datefield',
                            name: 'fechaFinal',
                            fieldLabel: 'Final',
                            format: 'Y-m-d',
                            value: '<?= $fechaFinal ?>',
                            allowBlank: false
                        }
                    ]
                }
            ],
            buttons: [{
                    text: 'Generar Reporte',
                    handler: function () {
                        grid = Ext.getCmp('grid_results');
                        grid.cargarDatos(form.getValues().idCarrier, form.getValues().fechaInicial, form.getValues().fechaFinal);
                    }
                }, {
                    text: 'Limpiar',
                    handler: function () {
                        this.up('form').getForm().reset();
                    }
                }
            ]
        });

    });
</script>