winNuevoTipo = null;

Ext.define('Colsys.Contabilidad.GridParametrosGenerales', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridParametrosGenerales',
    style: 'margin:0px 200px;',
    selModel: {
        selType: 'cellmodel'
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    width: 500,
    height: 500,
    listeners: {
        beforeedit: function (editor, e, eOpts) {

        },
        edit: function (editor, e, eOpts) {

        },
        beforeitemcontextmenu: function (view, record, item, index, e)
        {

        },
        beforerender: function (ct, position) {
            this.setHeight(400);
            this.setWidth(550);
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idformapago', mapping: 'ca_idformapago'},
                            {name: 'nombre', mapping: 'ca_nombre'},
                            {name: 'empresa', mapping: 'ca_empresa'},
                            {name: 'cuenta', mapping: 'ca_cuenta'}
                        ],
                        autoLoad: true,
                        remoteSort: true,
                        proxy: {
                            type: 'ajax',
                            url: '/contabilidad/datosFormasPago',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    [{
                            text: "idformapago",
                            dataIndex: 'idformapago',
                            width: 70,
                            hidden: true
                        },
                        {
                            text: "Nombre",
                            dataIndex: 'nombre',
                            width: 240
                        },
                        {
                            text: "Empresa",
                            dataIndex: 'empresa',
                            width: 100
                        },
                        {
                            text: "Cuenta",
                            dataIndex: 'cuenta',
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
                                        title: 'Editar forma de pago',
                                        width: 375,
                                        height: 190,
                                        id: 'winNuevoTipo',
                                        items: {
                                            xtype: 'Colsys.Contabilidad.FormNuevaFormaPago',
                                            idformapago: rec.data.idformapago
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
                            tooltip: 'Eliminar tipo de comprobante',
                            handler: function (grid, rowIndex, colIndex) {
                                me = this;
                                var store = me.up('grid').getStore();
                                var rec = grid.getStore().getAt(rowIndex);
                                idformapago = rec.data.idformapago;
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminando...',
                                            url: '/contabilidad/eliminarFormapago',
                                            params: {
                                                idformapago: idformapago,
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
                            title: 'Nueva Forma de Pago',
                            width: 375,
                            height: 190,
                            id: 'winNuevaformapago',
                            items: {
                                xtype: 'Colsys.Contabilidad.FormNuevaFormaPago',
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

        }
    }

}
);
