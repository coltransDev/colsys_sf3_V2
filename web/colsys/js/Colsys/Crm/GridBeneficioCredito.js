winBeneficio = null;
Ext.define('Colsys.Crm.GridBeneficioCredito', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridBeneficioCredito',
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    width: 1000,
    listeners: {
        afterrender: function (ct, position) {
            var storeAfter = this.getStore();
            storeAfter.load({
                params: {
                    idcliente: this.idcliente
                }
            });
        },
        render: function (ct, position) {
            var me = this;
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idempresa', mapping: 'idempresa'},
                            {name: 'empresa', mapping: 'empresa'},
                            {name: 'cupo', mapping: 'cupo'},
                            {name: 'dias', mapping: 'dias'},
                            {name: 'observaciones', mapping: 'observaciones'},
                            {name: 'creacion', mapping: 'creacion'},
                            {name: 'ult_modificacion', mapping: 'ult_modificacion'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosBeneficioCredito',
                            reader: {
                                type: 'json',
                                root: 'data'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "Empresa",
                            dataIndex: 'empresa',
                            width: 150
                        }, {
                            header: "Cupo",
                            dataIndex: 'cupo',
                            width: 150
                        }, {
                            header: "D&iacute;as de Cr&eacute;dito",
                            dataIndex: 'dias',
                            width: 150
                        }, {
                            header: "Observaciones",
                            dataIndex: 'observaciones',
                            width: 150
                        }, {
                            header: "Creaci&oacute;n",
                            dataIndex: 'creacion',
                            width: 180
                        }, {
                            header: "Ultima modificaci&oacute;n",
                            dataIndex: 'ult_modificacion',
                            width: 180
                        }, {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 40,
                            items: [{
                                    tooltip: 'Editar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        
                                        if (winBeneficio == null) {
                                            winBeneficio = new Ext.Window({
                                                id: 'winMandatos',
                                                title: 'Editar Beneficio Crediticio',
                                                height: 210,
                                                width: 400,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.FormBeneficioCredito',
                                                        id: 'winFormEdit',
                                                        idcredito: rec.data.idcredito
                                                    }],
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        winBeneficio = null;
                                                    }
                                                }
                                            });
                                        }
                                        winBeneficio.show();
                                    },
                                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                                        return !me.permisos[27];
                                    },
                                    getClass: function (v, meta, rec) {
                                        if (me.permisos[27]) {
                                            return 'page_white_edit';
                                        }
                                    }
                                }, {
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar Beneficio',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea eliminar el beneficio?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminado...',
                                                    url: '/crm/eliminarBeneficioCredito',
                                                    params: {
                                                        idcredito: rec.data.idcredito
                                                    },
                                                    failure: function (response, options) {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando los registros.<br>' + response.errorInfo);
                                                        success = false;
                                                    },
                                                    success: function (response, options) {
                                                        var res = Ext.JSON.decode(response.responseText);
                                                        if (res.success) {
                                                            store.reload();
                                                        } else {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando los registros.<br>' + res.responseInfo);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }]
                        }
                    ]);

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Agregar',
                iconCls: 'add',
                id: 'agregarCredito' + me.idcliente,
                handler: function () {
                    if (winBeneficio == null) {
                        winBeneficio = Ext.create('Ext.window.Window', {
                            title: 'Registrar Beneficio Crediticio',
                            closeAction: 'destroy',
                            height: 210,
                            width: 400,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            items: {
                                xtype: "Colsys.Crm.FormBeneficioCredito",
                                idcliente: this.up('grid').idcliente
                            },
                            listeners: {
                                destroy: function (obj, eOpts) {
                                    winBeneficio = null;
                                }
                            }
                        });
                        winBeneficio.show();
                    } else {
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Beneficios Crediticios<br>Por favor cierrela primero");
                    }
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[26]);
                    }
                }
            }
            );
            this.addDocked(tb);
        }
    }
});
