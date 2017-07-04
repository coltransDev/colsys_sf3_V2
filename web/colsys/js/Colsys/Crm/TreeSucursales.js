winEdicion = null;
Ext.define('Colsys.Crm.TreeSucursales', {
    extend: 'Ext.tree.Panel',
    alias: 'widget.Colsys.Crm.TreeSucursales',
    rootVisible: false,
    multiSelect: false,
    singleExpand: false,
    columnLines: true,
    lines: false,
    viewConfig: {
        plugins: {
            ptype: 'treeviewdragdrop',
            containerScroll: true
        },
        listeners: {
            afterRender: function () {
                idcliente = this.up('panel').idcliente;
                this.store.load({
                    params: {
                        idcliente: idcliente
                    }
                });
            }
//          ,  itemclick: function (record, item, index, e, eOpts) {
//                rec = this.getStore().getAt(e);
//                if (rec.data.leaf == false && rec.data.idsucursal != null) {
//                    idcliente = this.up('panel').idcliente;
//                    Ext.getCmp('Contactos' + idcliente).idsucursal = rec.data.idsucursal;
//                    Ext.getCmp('Contactos' + idcliente).getStore().load({
//                        params: {
//                            idsucursal: rec.data.idsucursal,
//                            idcliente: idcliente
//                        }
//                    });
//                    Ext.getCmp('nuevocontacto' + idcliente).setVisible(true);
//                }
//            }

        }
//      ,  getRowClass: function (record, rowIndex, rowParams, store) {
//            if (record.get("idarchivo") == record.get("nombre"))
//                return 'row_green';
//        }
    },
    columns: [{
            xtype: 'treecolumn',
            text: 'Sucursales',
            flex: 2,
            sortable: false,
            dataIndex: 'text',
//            renderer: function (value, metaData, record, row, col, store, gridView) {
//                return value;
//            }
        }, {
            xtype: 'hiddenfield',
            dataIndex: 'idsucursal'
        }, {
            xtype: 'hiddenfield',
            dataIndex: 'idcontacto'
        }, {
            text: 'Tel&eacute;fonos',
            dataIndex: 'telefono',
            width: 120,
            sortable: true
        }, {
            text: 'Celular',
            dataIndex: 'celular',
            width: 120,
            sortable: true
        }, {
            text: 'Correo',
            dataIndex: 'correo',
            flex: 1,
            sortable: true
        }, {
            text: 'Departamento',
            dataIndex: 'departamento',
            width: 150,
            sortable: true
        }, {
            text: 'Cumpleanos',
            dataIndex: 'cumpleanos',
            width: 80,
            sortable: true
        }, {
            text: 'Fijo',
            dataIndex: 'fijo',
            width: 50,
            sortable: true
        }, {
            text: 'Identificaci&oacute;n',
            dataIndex: 'identificacion',
            width: 100,
            sortable: true
        }, {
            text: 'Act',
            xtype: 'actioncolumn',
            width: 45,
            items: [{
                    getClass: function (v, meta, rec) {
                        if (!rec.get('idsucursal') && !rec.get('idcontacto')) {
                            return null;
                        } else if (!rec.get('idcontacto')) {
                            return 'building';
                        } else {
                            return 'user';
                        }
                    },
                    getTip: function (v, meta, rec) {
                        if (!rec.get('idsucursal') && !rec.get('idcontacto')) {
                            return null;
                        } else if (!rec.get('idcontacto')) {
                            return 'Editar Sucursal';
                        } else {
                            return 'Editar Contacto';
                        }
                    },
                    handler: function (grid, rowIndex, colIndex) {
                        var rec = grid.getStore().getAt(rowIndex);
                        if (!rec.get('idcontacto')) {
                            if (winEdicion == null) {
                                winEdicion = Ext.create('Ext.window.Window', {
                                    title: 'Editar Sucursal',
                                    height: 220,
                                    width: 600,
                                    id: "winFormEdit",
                                    name: "winFormEdit",
                                    items: {
                                        xtype: "Colsys.Crm.FormSucursal",
                                        // idcliente: me.idcliente
                                    },
                                    listeners: {
                                        destroy: function (obj, eOpts) {
                                            winEdicion = null;
                                        }
                                    }
                                });
                                winEdicion.down('form').getForm().loadRecord(rec);
                                winEdicion.show();
                            } else {
                                Ext.Msg.alert("Crm", "Existe una ventana abierta de Sucursal<br>Por favor cierrela primero");
                            }
                        } else if (rec.get('idcontacto')) {
                            if (winEdicion == null) {
                                winEdicion = Ext.create('Ext.window.Window', {
                                    title: 'Editar Contacto',
                                    closeAction: 'destroy',
                                    height: 400,
                                    width: 610,
                                    id: "winFormEdit",
                                    name: "winFormEdit",
                                    items: {
                                        xtype: "Colsys.Crm.FormContacto",
                                        // idsucursal: this.up('panel').idsucursal,
                                        // idcliente: this.up('panel').idcliente
                                    },
                                    listeners: {
                                        destroy: function (obj, eOpts) {
                                            winEdicion = null;
                                        }
                                    }
                                });
                                winEdicion.down('form').getForm().loadRecord(rec);
                                winEdicion.show();
                            } else {
                                Ext.Msg.alert("Crm", "Existe una ventana abierta de Contactos<br>Por favor cierrela primero");
                            }
                        }
                    }
                }, {
                    getClass: function (v, meta, rec) {
                        if (rec.get('idsucursal') || rec.get('idcontacto')) {
                            return 'delete';
                        }
                    },
                    getTip: function (v, meta, rec) {
                        if (rec.get('idsucursal') || rec.get('idcontacto')) {
                            return 'Eliminar';
                        }
                    },
                    handler: function (grid, rowIndex, colIndex) {
                        var rec = grid.getStore().getAt(rowIndex),
                                action = (rec.get('change') < 0 ? 'Hold' : 'Buy');

                        Ext.Msg.alert(action, action + ' ' + rec.get('company'));
                    }
                }]
        }
    ],
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Nueva Sucursal',
                name: 'btonad' + me.idcliente,
                tooltip: 'Crear Sucursal',
                iconCls: 'add',
                scope: this,
                handler: function () {
                    if (winEdicion == null) {
                        winEdicion = Ext.create('Ext.window.Window', {
                            title: 'Crear Sucursal',
                            height: 220,
                            width: 600,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            items: {
                                xtype: "Colsys.Crm.FormSucursal",
                                idcliente: me.idcliente
                            },
                            listeners: {
                                destroy: function (obj, eOpts) {
                                    winEdicion = null;
                                }
                            }
                        });
                        winEdicion.show();
                    } else {
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Sucursal<br>Por favor cierrela primero");
                    }
                }
            });
            tb.add({
                text: 'Nuevo Contacto',
                name: 'btoncn' + me.idcliente,
                tooltip: 'Crear Contacto',
                iconCls: 'add',
                id: 'nuevocontacto' + me.idcliente,
                handler: function () {
                    if (winEdicion == null) {
                        winEdicion = Ext.create('Ext.window.Window', {
                            title: 'Crear Contacto',
                            closeAction: 'destroy',
                            height: 400,
                            width: 610,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            items: {
                                xtype: "Colsys.Crm.FormContacto",
                                // idsucursal: this.up('panel').idsucursal,
                                // idcliente: this.up('panel').idcliente
                            },
                            listeners: {
                                destroy: function (obj, eOpts) {
                                    winEdicion = null;
                                }
                            }
                        });
                        winEdicion.show();
                    } else {
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Contactos<br>Por favor cierrela primero");
                    }
                }
            });
            me.addDocked(tb);
        }
    }
});