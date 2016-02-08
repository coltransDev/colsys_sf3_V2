<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?><script type="text/javascript">
    Ext.onReady(function () {

        Ext.define('NumsDocsTransporte', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'consecutivo', type: 'string'},
                {name: 'referencia', type: 'string'},
                {name: 'observaciones', type: 'string'},
                {name: 'fchcreado', type: 'string'},
                {name: 'usucreado', type: 'string'},
                {name: 'fchimpreso', type: 'string'},
                {name: 'usuimpreso', type: 'string'},
                {name: 'fchremitido', type: 'string'},
                {name: 'usuremitido', type: 'string'},
                {name: 'fchanulado', type: 'string'},
                {name: 'usuanulado', type: 'string'}
            ]
        });

        Ext.define('rangoNumeros', {
            extend: 'Ext.window.Window',
            title: 'Rago Nuevo de Documentos a Registrar',
            height: 155,
            width: 300,
            layout: 'fit',
            modal: true,
            buttonAlign: 'left',
            items: [{
                    xtype: 'form',
                    frame: false,
                    border: 0,
                    layout: {
                        type: 'hbox',
                        align: 'middle'
                    },
                    fieldDefaults: {
                        msgTarget: 'side',
                        labelWidth: 150
                    },
                    items: [{
                            xtype: 'container',
                            flex: 1,
                            padding: 15,
                            layout: {
                                type: 'vbox',
                                align: 'stretch'
                            },
                            items: [{
                                    xtype: 'numberfield',
                                    name: 'inicio',
                                    fieldLabel: 'Digite Primer Número',
                                    allowBlank: false,
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false
                                }, {
                                    xtype: 'numberfield',
                                    name: 'final',
                                    fieldLabel: 'Digite Último Número',
                                    allowBlank: false,
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false
                                }
                            ]
                        }]
                }],
            buttons: [{
                    text: 'Crear Documentos',
                    handler: function () {
                        var me = this;
                        var form = me.up('window').down('form').getForm();
                        var data = form.getFieldValues();
                        var str = JSON.stringify(data);

                        if (form.isValid()) {
                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for("inoExpo/registrarNumsDocsTransporte") ?>',
                                params: {
                                    datos: str
                                },
                                success: function (response, opts) {
                                    var res = Ext.decode(response.responseText);
                                    if (res.success) {
                                        Ext.MessageBox.alert("Mensaje", 'Se guardo Correctamente la información');
                                    } else if (!res.success) {
                                        Ext.MessageBox.alert("Error", 'Se presentó el siguiente error: ' + res.errorInfo);
                                    }
                                },
                                failure: function (response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                }
                            });
                            me.up('window').close();
                        }
                    }
                }]
        });

        Ext.define('remitirNumeros', {
            extend: 'Ext.window.Window',
            title: 'Remitir un Rago Documentos a otra sucursal',
            height: 185,
            width: 300,
            layout: 'fit',
            modal: true,
            buttonAlign: 'left',
            items: [{
                    xtype: 'form',
                    frame: false,
                    border: 0,
                    layout: {
                        type: 'hbox',
                        align: 'middle'
                    },
                    fieldDefaults: {
                        msgTarget: 'side',
                        labelWidth: 130
                    },
                    items: [{
                            xtype: 'container',
                            flex: 1,
                            padding: 15,
                            layout: {
                                type: 'vbox',
                                align: 'stretch'
                            },
                            items: [{
                                    xtype: 'numberfield',
                                    name: 'inicio',
                                    fieldLabel: 'Digite Primer Número',
                                    allowBlank: false,
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false
                                }, {
                                    xtype: 'numberfield',
                                    name: 'final',
                                    fieldLabel: 'Digite Último Número',
                                    allowBlank: false,
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false
                                }, {
                                    xtype: 'textfield',
                                    name: 'observaciones',
                                    fieldLabel: 'Observaciones',
                                    allowBlank: false,
                                    maxLength: 128,
                                    maxLengthText: 'Excede el tamaño permitido'
                                }
                            ]
                        }]
                }],
            buttons: [{
                    text: 'Remitir Documentos',
                    handler: function () {
                        var me = this;
                        var form = me.up('window').down('form').getForm();
                        var data = form.getFieldValues();
                        var str = JSON.stringify(data);

                        if (form.isValid()) {
                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for("inoExpo/remitirNumsDocsTransporte") ?>',
                                params: {
                                    datos: str
                                },
                                success: function (response, opts) {
                                    var res = Ext.decode(response.responseText);
                                    if (res.success) {
                                        Ext.MessageBox.alert("Mensaje", 'Se guardo Correctamente la información');
                                    } else if (!res.success) {
                                        Ext.MessageBox.alert("Error", 'Se presentó el siguiente error: ' + res.errorInfo);
                                    }
                                },
                                failure: function (response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                }
                            });
                            
                            me.up('window').close();
                        }
                    }
                }]
        });

        var storeNumsDocsTransporte = Ext.create('Ext.data.Store', {
            autoLoad: true,
            model: 'NumsDocsTransporte',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('inoExpo/datosNumsDocsTransporte') ?>',
                reader: {
                    type: 'json',
                    root: 'root',
                    totalProperty: 'total'
                }
            }
        });

        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 2
        });

        // create the grid
        new Ext.grid.GridPanel({
            id: 'gridNumsDocsTransportes',
            title: 'Control Numeros Documento de Transporte',
            store: storeNumsDocsTransporte,
            stripeRows: true,
            height: 400,
            width: 1000,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            columns: [
                {
                    header: "No.",
                    dataIndex: 'consecutivo',
                    width: 80,
                }, {
                    header: "Referencia",
                    flex: -1,
                    dataIndex: 'referencia',
                    editor: {
                        allowBlank: false
                    }
                }, {
                    header: "Observaciones",
                    flex: -1,
                    dataIndex: 'observaciones',
                    editor: {
                        allowBlank: false
                    }
                }, {
                    text: 'Creación',
                    columns: [{
                            header: "Usuario",
                            width: 80,
                            dataIndex: 'usucreado'
                        }, {
                            header: "Fecha",
                            width: 100,
                            dataIndex: 'fchcreado'
                        }]
                }, {
                    text: 'Impresión',
                    columns: [{
                            header: "Usuario",
                            width: 80,
                            dataIndex: 'usuimpreso'
                        }, {
                            header: "Fecha",
                            width: 100,
                            dataIndex: 'fchimpreso'
                        }]
                }, {
                    text: 'Remitido',
                    columns: [{
                            header: "Usuario",
                            width: 80,
                            dataIndex: 'usuremitido'
                        }, {
                            header: "Fecha",
                            width: 100,
                            dataIndex: 'fchremitido'
                        }]
                }, {
                    text: 'Anulado',
                    columns: [{
                            header: "Usuario",
                            width: 80,
                            dataIndex: 'usuanulado'
                        }, {
                            header: "Fecha",
                            width: 100,
                            dataIndex: 'fchanulado'
                        }]
                }, {
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 25,
                    items: [{
                            iconCls: 'delete',
                            tooltip: 'Anular Documento',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                Ext.MessageBox.confirm('Confirmación de Anulación', 'Está seguro que desea anular el documento?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminado...',
                                            url: '<?= url_for("inoExpo/anularNumsDocsTransporte") ?>',
                                            params: {
                                                consecutivo: rec.data.consecutivo
                                            },
                                            failure: function (response, options) {
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                success = false;
                                            },
                                            success: function (response, options) {
                                                var res = Ext.JSON.decode(response.responseText);
                                                if (res.success) {
                                                    grid.getStore().reload();
                                                } else {
                                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        }]
                }
            ],
            renderTo: Ext.get('se-form'),
            plugins: [cellEditing],
            // inline buttons
            dockedItems: [{
                    xtype: 'toolbar',
                    items: [{
                            text: 'Registrar',
                            tooltip: 'Registra un Consecutivo de Documentos de Transporte',
                            iconCls: 'import',
                            scope: this,
                            handler: function () {
                                Ext.create('rangoNumeros').show();
                            }
                        }, {
                            text: 'Remitir',
                            tooltip: 'Remitir Documentos de Transporte a otra sucursal',
                            iconCls: 'refresh',
                            scope: this,
                            handler: function () {
                                Ext.create('remitirNumeros').show();
                            }
                        }
                    ]
                }],
            // paging bar on the bottom
            bbar: Ext.create('Ext.PagingToolbar', {
                store: storeNumsDocsTransporte,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
        });
    });
</script>