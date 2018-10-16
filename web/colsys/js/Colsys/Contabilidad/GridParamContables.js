winNuevoTipo = null;

Ext.define('Colsys.Contabilidad.GridParamContables', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridParamContables',
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
                            {name: 'idparametrocontable', mapping: 'ca_idparametrocontable'},
                            {name: 'idempresa', mapping: 'ca_idempresa'},
                            {name: 'tipo', mapping: 'ca_tipo'},
                            {name: 'idcuenta', mapping: 'ca_idcuenta'},
                            {name: 'base', mapping: 'ca_base'},
                            {name: 'porctarifa', mapping: 'ca_porctarifa'},
                            {name: 'ciudad', mapping: 'ca_ciudad'}
                        ],
                        autoLoad: false,
                        remoteSort: true,
                        proxy: {
                            type: 'ajax',
                            url: '/contabilidad/datosParamContables',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    [{
                            text: "idparametrocontable",
                            dataIndex: 'idparametrocontable',
                            width: 70,
                            hidden: true
                        },
                        {
                            text: "Tipo",
                            dataIndex: 'tipo',
                            width: 90
                        },
                        {
                            text: "Cuenta",
                            dataIndex: 'idcuenta',
                            width: 100
                        },
                        {
                            text: "Base",
                            dataIndex: 'base',
                            width: 150
                        },
                        {
                            text: "% Tarifa",
                            dataIndex: 'porctarifa',
                            width: 60
                        },
                        {
                            text: "Empresa",
                            dataIndex: 'idempresa',
                            width: 210
                        },
                        
                        {
                            text: "Ciudad",
                            dataIndex: 'ciudad',
                            width: 150
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
                                        height: 270,
                                        id: 'winNuevoTipo',
                                        items: {
                                            xtype: 'Colsys.Contabilidad.FormParamContable',
                                            idparametrocontable: rec.data.idparametrocontable
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
                        }/*,
                        {
                            xtype: 'actioncolumn',
                            iconCls: 'delete',
                            width: 25,
                            tooltip: 'Eliminar Parametro Contable',
                            handler: function (grid, rowIndex, colIndex) {
                                me = this;
                                var store = me.up('grid').getStore();
                                var rec = grid.getStore().getAt(rowIndex);
                                idparametrocontable = rec.data.idparametrocontable;
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminando...',
                                            url: '/contabilidad/eliminarParamContable',
                                            params: {
                                                idparametrocontable: idparametrocontable,
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
                        }*/
                    ]

                    );

            tb = new Ext.toolbar.Toolbar();
           /* tb.add({
                xtype: 'button',
                text: 'Nuevo',
                height: 30,
                iconCls: 'add',
                handler: function () {
                    if (winNuevoTipo == null) {
                        winNuevoTipo = new Ext.Window({
                            title: 'Nuevo Parametro contable',
                            width: 375,
                            height: 270,
                            id: 'winNuevaformapago',
                            items: {
                                xtype: 'Colsys.Contabilidad.FormParamContable',
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
            this.addDocked(tb);*/
        },
        afterrender: function (ct, position) {
            store = this.getStore();
            store.load({
                callback: function (records, operation, success) {
                    if (store.getCount() > 0) {
                        Ext.getCmp("grid-parametroscontables").getView().focusRow(0);
                    }
                }
            });
        }
    }
}
);
