winNuevoTipo = null;

Ext.define('Colsys.Contabilidad.GridConceptosSiigo', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridConceptosSiigo',
    selModel: {
        selType: 'cellmodel'
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    width: 500,
    height: 500,
    listeners: {
        afterrender: function (ct, position) {
            store = this.getStore();
            store.load({
                callback: function (records, operation, success) {
                    if (store.getCount() > 0) {
                        Ext.getCmp("grid-conceptosSiigo").getView().focusRow(0);
                    }
                }
            });
        },
        beforerender: function (ct, position) {
            this.setHeight(400);
            this.setWidth(900);
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idconceptosiigo', mapping: 'ca_idconceptosiigo'},
                            {name: 'idempresa', mapping: 'ca_idempresa'},
                            {name: 'descripcion', mapping: 'ca_descripcion'},
                            {name: 'codigo', mapping: 'ca_codigo'},
                            {name: 'cuenta', mapping: 'ca_cuenta'},
                            {name: 'cc', mapping: 'ca_cc'},
                            {name: 'scc', mapping: 'ca_scc'},
                            {name: 'valor', mapping: 'ca_valor'},
                            {name: 'pt', mapping: 'ca_pt'},
                            {name: 'iva', mapping: 'ca_iva'},
                            {name: 'porciva', mapping: 'ca_porciva'},
                            {name: 'retfte', mapping: 'ca_retfte'},
                            {name: 'cuentarf', mapping: 'ca_cuentarf'},
                            {name: 'baserf', mapping: 'ca_baserf'},
                            {name: 'porcrf', mapping: 'ca_porcrf'},
                            {name: 'mone', mapping: 'ca_mone'},
                            {name: 'convenio', mapping: 'ca_convenio'},
                            {name: 'autoret', mapping: 'ca_autoret'},
                            {name: 'basear', mapping: 'ca_basear'},
                            {name: 'tipo', mapping: 'ca_tipo'}
                        ],
                        autoLoad: false,
                        remoteSort: true,
                        proxy: {
                            type: 'ajax',
                            url: '/contabilidad/datosConceptoSiigo',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            },
                            /*callback: function (records, operation, success) {
                             
                             }*/
                        }
                    }),
                    [{
                            text: "idparamids",
                            dataIndex: 'idconceptosiigo',
                            width: 70,
                            hidden: true
                        },
                        {
                            text: "Codigo",
                            dataIndex: 'codigo',
                            width: 100
                        },
                        {
                            text: "Empresa",
                            dataIndex: 'idempresa',
                            width: 100
                        },
                        {
                            text: "Descripción",
                            dataIndex: 'descripcion',
                            width: 350,
                            hidden: true
                        },
                        {
                            text: "Cuenta",
                            dataIndex: 'cuenta',
                            width: 80,
                        },
                        {
                            text: "CC",
                            dataIndex: 'cc',
                            width: 35,
                        },
                        {
                            text: "SCC",
                            dataIndex: 'scc',
                            width: 40,
                        },
                        {
                            text: "Valor",
                            dataIndex: 'valor',
                            width: 80,
                        },
                        {
                            text: "PT",
                            dataIndex: 'pt',
                            width: 25,
                        },
                        {
                            text: "IVA",
                            dataIndex: 'iva',
                            width: 40,
                        },
                        {
                            text: "%",
                            dataIndex: 'porciva',
                            width: 35,
                        },
                        {
                            text: "RetFte",
                            dataIndex: 'retfte',
                            width: 45,
                        },
                        {
                            text: "Cuenta Rtfte",
                            dataIndex: 'cuentarf',
                            width: 60,
                        },
                        {
                            text: "Base",
                            dataIndex: 'baserf',
                            width: 50,
                        },
                        {
                            text: "%",
                            dataIndex: 'porcrf',
                            width: 30,
                        },
                        {
                            text: "Moneda",
                            dataIndex: 'mone',
                            width: 60,
                            hidden: true

                        },
                        {
                            text: "Convenio",
                            dataIndex: 'convenio',
                            width: 60,
                            hidden: true
                        },
                        {
                            text: "Autoret",
                            dataIndex: 'autoret',
                            width: 60,
                        },
                        {
                            text: "Base",
                            dataIndex: 'basear',
                            width: 50,
                        },
                        {
                            text: "Parametro",
                            dataIndex: 'tipo',
                            width: 60,
                            hidden: true
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
                                        width: 720,
                                        height: 370,
                                        id: 'winNuevoTipo',
                                        items: {
                                            xtype: 'Colsys.Contabilidad.FormConceptoSiigo',
                                            idconceptosiigo: rec.data.idconceptosiigo
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
                                idconceptosiigo = rec.data.idconceptosiigo;
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminando...',
                                            url: '/contabilidad/eliminarConceptoSiigo',
                                            params: {
                                                idconceptosiigo: idconceptosiigo
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
                            title: 'Nuevo Concepto Siigo',
                            width: 720,
                            height: 370,
                            id: 'winNuevaformapago',
                            items: {
                                xtype: 'Colsys.Contabilidad.FormConceptoSiigo',
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
        }
    }
}
);
