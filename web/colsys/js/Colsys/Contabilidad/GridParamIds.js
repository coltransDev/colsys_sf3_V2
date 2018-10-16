winNuevoTipo = null;

Ext.define('Colsys.Contabilidad.GridParamIds', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridParamIds',
    selModel: {
        selType: 'cellmodel'
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    width: 500,
    height: 500,
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(400);
            this.setWidth(820);
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idparamids', mapping: 'ca_idparamids'},
                            {name: 'parametro', mapping: 'ca_parametro'},
                            {name: 'valor', mapping: 'ca_valor'},
                            {name: 'idempresa', mapping: 'ca_empresa'}
                        ],
                        autoLoad: false,
                        remoteSort: true,
                        proxy: {
                            type: 'ajax',
                            url: '/contabilidad/datosParamIds',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    [{
                            text: "idparamids",
                            dataIndex: 'idparamids',
                            width: 70,
                            hidden: true
                        },
                        {
                            text: "Parametro",
                            dataIndex: 'parametro',
                            width: 350,
                        },
                        {
                            text: "valor",
                            dataIndex: 'valor',
                            width: 100
                        },
                        {
                            text: "Empresa",
                            dataIndex: 'idempresa',
                            width: 210
                        },
                        {
                            xtype: 'actioncolumn',
                            iconCls: 'page_white_edit',
                            width: 25,
                            tooltip: 'Editar forma de pago',
                            handler: function (grid, rowIndex, colIndex) {
                                me = this;
                                var store = me.up('grid').getStore();

                                var rec = grid.getStore().getAt(rowIndex);
                                if (winNuevoTipo == null) {
                                    winNuevoTipo = new Ext.Window({
                                        title: 'Editar Parametro Contable',
                                        width: 375,
                                        height: 200,
                                        id: 'winNuevoTipo',
                                        items: {
                                            xtype: 'Colsys.Contabilidad.FormParamIds',
                                            idparamids: rec.data.idparamids
                                        },
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winNuevoTipo = null;
                                            }
                                        }
                                    })
                                }
                                winNuevoTipo.show();
                            }
                        },
                        {
                            xtype: 'actioncolumn',
                            iconCls: 'delete',
                            width: 25,
                            tooltip: 'Eliminar Parametro Ids',
                            handler: function (grid, rowIndex, colIndex) {
                                me = this;
                                var store = me.up('grid').getStore();
                                var rec = grid.getStore().getAt(rowIndex);
                                idparamids = rec.data.idparamids;
                                Ext.MessageBox.confirm('Confirmaci\u00F3n de Eliminaci\u00F3n', 'Est\u00E1 seguro que desea anular el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminando...',
                                            url: '/contabilidad/eliminarParamIds',
                                            params: {
                                                idparamids: idparamids
                                            },
                                            failure: function (response, options) {
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                                success = false;
                                            },
                                            success: function (response, options) {
                                                var res = Ext.JSON.decode(response.responseText);
                                                if (res.success) {
                                                    Ext.MessageBox.alert("Mensaje", 'Registro eliminado correctamente.<br>');
                                                    store.reload();
                                                } else {
                                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.errorInfo);
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        }
                    ]

                    );

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'button',
                text: 'Nuevo',
                height: 30,
                iconCls: 'add',
                handler: function () {
                    if (winNuevoTipo == null) {
                        winNuevoTipo = new Ext.Window({
                            title: 'Nuevo Parametro Clientes',
                            width: 375,
                            height: 200,
                            id: 'winNuevoTipo',
                            items: {
                                xtype: 'Colsys.Contabilidad.FormParamIds',
                            },
                            listeners: {
                                close: function (win, eOpts) {
                                    winNuevoTipo = null;
                                }
                            }
                        })
                    }
                    winNuevoTipo.show();
                }
            }

            );
            this.addDocked(tb);
        },
        afterrender: function (ct, position) {
            store = this.getStore();
            store.load({
                callback: function (records, operation, success) {
                    if (store.getCount() > 0) {
                        Ext.getCmp("grid-parametrosids").getView().focusRow(0);
                    }
                }
            });
        }
    }
}
);
