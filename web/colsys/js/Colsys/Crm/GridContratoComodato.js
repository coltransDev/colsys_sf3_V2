var idcomodato = 0;
Ext.define('Colsys.Crm.GridContratoComodato', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridContratoComodato',
    plugins: [Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 2,
            listeners: {
                'validateedit': function (editor, e) {
                }
            }
        })],
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
            store = me.getStore();
            me.getStore().load({
                params: {
                    id: this.idcliente
                },
                callback: function () {

                }
            });
            bbar = new Ext.PagingToolbar({
                dock: 'bottom',
                displayInfo: true,
                store: me.getStore(),
                idcliente: me.idcliente,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            });
            me.addDocked(bbar);
        },
        beforerender: function (ct, position) {
            var me = this;
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        autoLoad: false,
                        fields: [
                            {name: 'idcliente', type: 'string'},
                            {name: 'fchfirmado', type: 'date', format: 'Y-m-d'},
                            {name: 'fchvencimiento', type: 'date', format: 'Y-m-d'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/clientes/datosContratoComodato',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            extraParams: {
                                id: me.idcliente
                            },
                            filterParam: 'query'
                        }
                    }),
                    [
                        {
                            header: 'Fecha Firmado',
                            width: 140,
                            dataIndex: 'fchfirmado',
                            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                            editor: new Ext.form.DateField({
                                id: 'fecha_firmado' + me.idcliente,
                                width: 90,
                                allowBlank: false,
                                format: 'Y-m-d',
                                renderer: Ext.util.Format.dateRenderer('Y-m-d')
                            })
                        }, {
                            header: 'Fecha Vencimiento',
                            width: 120,
                            dataIndex: 'fchvencimiento',
                            renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                            editor: new Ext.form.DateField({
                                id: 'fecha_vencimiento' + me.idcliente,
                                width: 90,
                                allowBlank: false,
                                format: 'Y-m-d',
                                renderer: Ext.util.Format.dateRenderer('Y-m-d')
                            })
                        }, {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 20,
                            items: [{
                                    tooltip: 'Eliminar',
                                    id: 'btnAnular',
                                    isDisabled: function (view, rowIndex, colIndex, item, record) {
                                        return !me.permisos[32];
                                    },
                                    getClass: function (v, meta, rec) {
                                        if (rec.get('idcliente') && me.permisos[32]) {
                                            return 'delete';
                                        }
                                    },
                                    getTip: function (v, meta, rec) {
                                        if (rec.get('idcliente') && me.permisos[32]) {
                                            return 'Eliminar Registro';
                                            l
                                        }
                                    },
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (rec.get('idcliente')) {
                                            Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea eliminar el Contrato de Comodato?', function (choice) {
                                                if (choice == 'yes') {
                                                    Ext.Ajax.request({
                                                        waitMsg: 'Eliminado...',
                                                        url: '/clientes/eliminarContratoComodato',
                                                        params: {
                                                            idcliente: me.idcliente,
                                                            fchfirmado: Ext.Date.format(new Date(rec.data.fchfirmado), 'Y-m-d'),
                                                            fchvencimiento: Ext.Date.format(new Date(rec.data.fchvencimiento), 'Y-m-d')
                                                        },
                                                        failure: function (response, options) {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                            success = false;
                                                        },
                                                        success: function (response, options) {
                                                            var res = Ext.JSON.decode(response.responseText);
                                                            if (res.success) {
                                                                store.reload();
                                                            } else {
                                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                            }
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    }
                                }]
                        }
                    ]);
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Adicionar',
                tooltip: 'Adicionar un registro',
                iconCls: 'add',
                scope: this,
                handler: function () {
                    var store = this.getStore();
                    var r = Ext.create(store.model);
                    store.insert(0, r);
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[30]);
                    }
                }
            }, {
                text: 'Guardar',
                tooltip: '',
                iconCls: 'disk',
                scope: this,
                handler: function () {
                    var store = this.getStore();
                    var records = store.getModifiedRecords();
                    var lenght = records.length;
                    changes = [];
                    for (var i = 0; i < lenght; i++) {
                        r = records[i];
                        if (r.getChanges()) {
                            console.log(r.id);
                            records[i].data.id = r.id;
                            records[i].data.fchfirmado = Ext.Date.format(new Date(r.data.fchfirmado), 'Y-m-d');
                            records[i].data.fchvencimiento = Ext.Date.format(new Date(r.data.fchvencimiento), 'Y-m-d');
                            changes[i] = records[i].data;
                        }
                    }
                    var str = JSON.stringify(changes);
                    if (str.length > 5) {
                        Ext.Ajax.request({
                            url: '/clientes/guardarContratoComodato',
                            params: {
                                datos: str,
                                idcliente: this.idcliente
                            },
                            success: function (response, opts) {
                                var res = Ext.decode(response.responseText);
                                if (res.ids && res.success) {
                                    id = res.ids;
                                    for (i = 0; i < id.length; i++) {
                                        var rec = store.getById(id[i]);
                                        rec.set('idcliente', res.idcliente);
                                        rec.commit();
                                    }
                                    Ext.MessageBox.alert("Mensaje", 'Se guard&oacute; Correctamente la informaci&oacute;n');
                                } else {
                                    Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar la fila <br>' + res.errorInfo);
                                }
                                store.reload();
                            },
                            failure: function (response, opts) {
                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                box.hide();
                            }
                        });
                    }
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[31]);
                    }
                }
            });
            this.addDocked(tb);
        }
    }
});
