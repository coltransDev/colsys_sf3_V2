winNuevoTipo = null;
comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('ComboNaturaleza', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-naturaleza',
    store: ['D', 'C']
});

Ext.define('Colsys.Contabilidad.GridTipoComprobante', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridTipoComprobante',
    style: 'margin:0px 200px;',
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            if (record.get('ca_activo') == false) {
                return "row_purple";
            }
        }
    },
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
                            {name: 'idtipo', mapping: 'ca_idtipo'},
                            {name: 'tipo', mapping: 'ca_tipo'},
                            {name: 'comprobante', mapping: 'ca_comprobante'},
                            {name: 'sucursal', mapping: 'ca_sucursal'},
                            {name: 'empresa', mapping: 'ca_empresa'},
                            {name: 'activo', mapping: 'ca_activo'}
                        ],
                        autoLoad: false,
                        remoteSort: true,
                        proxy: {
                            type: 'ajax',
                            url: '/contabilidad/datosTipoComprobantes',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    [{
                            text: "idtipo",
                            dataIndex: 'idtipo',
                            width: 70,
                            hidden: true
                        },
                        {
                            text: "Tipo",
                            dataIndex: 'tipo',
                            width: 70
                        },
                        {
                            text: "Comprobante",
                            dataIndex: 'comprobante',
                            width: 100
                        },
                        {
                            text: "Empresa",
                            dataIndex: 'empresa',
                            width: 150
                        },
                        {
                            text: "Sucursal",
                            dataIndex: 'sucursal',
                            width: 150
                        },
                        {
                            text: "activo",
                            dataIndex: 'activo',
                            width: 150,
                            hidden: true
                        },
                        {
                            xtype: 'actioncolumn',
                            iconCls: 'page_white_edit',
                            width: 25,
                            tooltip: 'Editar el tipo de comprobante',
                            handler: function (grid, rowIndex, colIndex) {
                                me = this;
                                var store = me.up('grid').getStore();

                                var rec = grid.getStore().getAt(rowIndex);

                                if (winNuevoTipo == null) {
                                    winNuevoTipo = new Ext.Window({
                                        title: 'Nuevo Tipo de Comprobante',
                                        width: 720,
                                        height: 500,
                                        id: 'winNuevoTipo',
                                        items: {
                                            xtype: 'Colsys.Contabilidad.FormNuevoTipoComprobante',
                                            idtipo: rec.data.idtipo
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
                                idtipo = rec.data.idtipo;
                                Ext.MessageBox.confirm('Confirmaci\u00F3n de Eliminaci\u00F3n', 'Est\u00E1 seguro que desea anular el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminando...',
                                            url: '/contabilidad/eliminarTipoComprobante',
                                            params: {
                                                idtipo: idtipo
                                            },
                                            failure: function (response, options) {
                                                Ext.MessageBox.alert("Mensaje", 'Se present\u00F3 un error Eliminando el registro.<br>' + response.errorInfo);
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
                            title: 'Nuevo Tipo de Comprobante',
                            width: 720,
                            height: 500,
                            id: 'winNuevoTipo',
                            items: {
                                xtype: 'Colsys.Contabilidad.FormNuevoTipoComprobante',
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
                        Ext.getCmp("grid-tipocomprobantes").getView().focusRow(0);
                    }
                }
            });
        }
    }

}
);
