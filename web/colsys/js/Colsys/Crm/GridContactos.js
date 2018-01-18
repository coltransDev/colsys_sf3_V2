winTercero = null;

Ext.define('Colsys.Crm.GridContactos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridContactos',
    width: 640,
    //id: 'gridrespuestas' + this.idmaster,
    listeners: {
        afterrender: function (ct, position) {
            var storeAfter = this.getStore();
            storeAfter.load({
                params: {
                    idcliente: this.up('panel').idcliente
                }
            });
        },
        render: function (ct, position) {
            this.reconfigure(
//                    this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idcontacto', type: 'string', mapping: 'idcontacto'},
                            {name: 'nombre', type: 'string', mapping: 'nombre'},
                            {name: 'cargo', type: 'string', mapping: 'cargo'},
                            {name: 'area', type: 'string', mapping: 'area'},
                            {name: 'telefono', type: 'string', mapping: 'telefono'},
                            {name: 'email', type: 'string', mapping: 'email'},
                            {name: 'observaciones', type: 'string', mapping: 'observaciones'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosContactos',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "idcontacto",
                            dataIndex: 'idcontacto',
                            hidden: true
                        },
                        {
                            header: "Nombre",
                            dataIndex: 'nombre',
                            width: 120
                        },
                        {
                            header: "Cargo",
                            dataIndex: 'cargo',
                            width: 120
                        },
                        {
                            header: "Area",
                            dataIndex: 'area',
                            width: 110
                        },
                        {
                            header: "Telefono",
                            dataIndex: 'telefono',
                            width: 70,
                            editor: {
                                xtype: 'textfield'

                            }
                        },
                        {
                            header: "e-mail",
                            dataIndex: 'email',
                            width: 150,
                            readOnly: true
                        }, {
                            header: "Observaciones",
                            dataIndex: 'observaciones',
                            width: 120
                        },
                        {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 55,
                            items: [{
                                    iconCls: 'page_white_edit',
                                    tooltip: 'Editar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (winTercero == null)
                                        {
                                            winTercero = Ext.create('Ext.window.Window', {
                                                title: 'Edicion de Contacto',
                                                height: 540,
                                                width: 610,
                                                id: "winFormEdit",
                                                name: "winFormEdit",
                                                items:
                                                        {
                                                            xtype: "Colsys.Crm.FormContacto",
                                                            idcliente: this.up('panel').idcliente,
                                                            idcontacto: rec.data.idcontacto
                                                        },
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        winTercero = null;
                                                    }
                                                }
                                            });
                                            winTercero.show();
                                        } else
                                        {
                                            Ext.Msg.alert("Crm", "Existe una ventana abierta de Sucursal<br>Por favor cierrela primero");
                                        }
                                    }
                                }, {
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        store = grid.getStore();
                                        Ext.MessageBox.confirm('Confirmacion', "El Contacto NO puede ser eliminado de forma definitiva de la base de datos y en su lugar, el sistema automaticamente remplazara los campos Cargo y Departamente con la palabra 'Extrabajador'. Pulse el boton 'Yes' para proceder de esta forma.",
                                                function (e) {
                                                    if (e == 'yes') {
                                                        var box = Ext.MessageBox.wait('Procesando', 'Eliminando')
                                                        Ext.Ajax.request({
                                                            url: '/crm/eliminarContacto',
                                                            params: {
                                                                idcontacto: rec.data.idcontacto
                                                            },
                                                            success: function (response, opts) {
                                                                var obj = Ext.decode(response.responseText);
                                                                if (obj.errorInfo)
                                                                {
                                                                    Ext.MessageBox.alert("Colsys", "Se presento un error: ");
                                                                } else
                                                                {
                                                                    Ext.MessageBox.alert("Colsys", "Registro Eliminado Correctamente");
                                                                    store.reload();
                                                                }
                                                                box.hide();
                                                            },
                                                            failure: function (response, opts) {
                                                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                                box.hide();
                                                                store.reload();
                                                            }
                                                        });
                                                    }
                                                });
                                    }
                                }, {
                                    iconCls: 'error',
                                    tooltip: 'Habeas Data',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        store = grid.getStore();
                                        Ext.MessageBox.confirm('Confirmacion', "El Contacto no ser\u00E1 eliminado y en su lugar, la información personal y los datos de contacto ser\u00E1n sustituidos por un comentario.",
                                                function (e) {
                                                    if (e == 'yes') {
                                                        var box = Ext.MessageBox.wait('Procesando', 'Habeas Data')
                                                        Ext.Ajax.request({
                                                            url: '/crm/habeasDataContacto',
                                                            params: {
                                                                idcontacto: rec.data.idcontacto
                                                            },
                                                            success: function (response, opts) {
                                                                var obj = Ext.decode(response.responseText);
                                                                if (obj.errorInfo)
                                                                {
                                                                    Ext.MessageBox.alert("Colsys", "Se presento un error: ");
                                                                } else
                                                                {
                                                                    Ext.MessageBox.alert("Colsys", "Registro Procesado Correctamente");
                                                                    store.reload();
                                                                }
                                                                box.hide();
                                                            },
                                                            failure: function (response, opts) {
                                                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                                box.hide();
                                                                store.reload();
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
                xtype: 'button',
                text: 'Nuevo Contacto',
                height: 30,
                iconCls: 'add',
                id: 'nuevocontacto' + this.up('panel').idcliente,
                handler: function () {
                    if (winTercero == null)
                    {
                        winTercero = Ext.create('Ext.window.Window', {
                            title: 'Edicion de Contacto',
                            closeAction: 'destroy',
                            height: 540,
                            width: 610,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            items:
                                    {
                                        xtype: "Colsys.Crm.FormContacto",
                                        idsucursal: this.up('panel').idsucursal,
                                        idcliente: this.up('panel').idcliente
                                    },
                            listeners: {
                                destroy: function (obj, eOpts)
                                {
                                    winTercero = null;
                                }
                            }
                        });
                        winTercero.show();
                    } else
                    {
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Contactos<br>Por favor cierrela primero");
                    }
                }
            }
            );
            this.addDocked(tb);
        },
        edit: function (editor, e, eOpts) {
        }
    }
});
