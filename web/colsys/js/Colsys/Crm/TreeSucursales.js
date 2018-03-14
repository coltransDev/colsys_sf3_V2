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

        }
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
//                    isDisabled: function(view, rowIndex, colIndex, item, record) {
//                        return !me.permisos[2];
//                    },
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
                                        idcliente: this.up('panel').idcliente,
                                        idcontacto: rec.get('idcontacto')
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
                        var det = null;
                        var rec = grid.getStore().getAt(rowIndex);
                        
                        if (rec.get('idcontacto')) {
                            det = 'el Contacto ';
                        } else if (rec.get('idsucursal')) {
                            det = 'la Sucursal ';
                        }
                        det+= rec.get('text');
                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular ' + det + '?', function (choice) {
                            var url = null;
                            var idrecord = null;
                            if (rec.get('idcontacto')) {
                                url = '/crm/eliminarContacto';
                                idrecord = rec.get('idcontacto');
                            } else if (rec.get('idsucursal')) {
                                url = '/crm/eliminarSucursal';
                                idrecord = rec.get('idsucursal');
                            }
                            if (choice == 'yes') {
                                Ext.Ajax.request({
                                    waitMsg: 'Eliminado...',
                                    url: url,
                                    params: {
                                        idcontacto: idrecord,
                                        idsucursal: idrecord
                                    },
                                    failure: function (response, options) {
                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                        success = false;
                                    },
                                    success: function (response, options) {
                                        var res = Ext.JSON.decode(response.responseText);
                                        if (res.success) {
                                            store = grid.getStore();
                                            store.reload();
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
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[1]);
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
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Contactos<br>Por favor cierrela primero");
                    }
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[1]);
                    }
                }
            });
            tb.add({
                text: 'Refrescar',
                iconCls: 'refresh',
                handler: function () {
                    me.getStore().reload();
                }
            });
            me.addDocked(tb);
        }
    }
});