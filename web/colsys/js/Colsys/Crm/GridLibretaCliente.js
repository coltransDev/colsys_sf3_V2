
Ext.define('Colsys.Crm.GridLibretaCliente', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridLibretaCliente',
//    plugins: [
//        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
//    ],
    width: 640,
    //id: 'gridrespuestas' + this.idmaster,
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
//                    this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'email', type: 'string', mapping: 'email'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosLibretaCliente',
                            reader: {
                                type: 'json',
                                root: 'data'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "Email",
                            dataIndex: 'email',
                            width: '100%',
                            editor: {
                                xtype: 'textfield'
                            }
                        }
                    ]);

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Agregar',
                iconCls: 'add',
                id: 'AgregarContacto' + this.idcliente,
                handler: function () {
                    var store = this.up('grid').store;
                    var r = Ext.create(store.model);
                    r.set('idcliente' + this.up('grid').idcliente, this.up('grid').idcliente);
                    store.insert(0, r);
                }
            }, {
                xtype: 'button',
                text: 'Guardar',
                height: 30,
                iconCls: 'disk',
                id: 'guardarContacto' + this.idcliente,
                handler: function () {
                    var store = this.up('grid').getStore();

                    changes = [];
                    for (var i = 0; i < store.getCount(); i++) {
                        r = store.getAt(i);
                        changes[i] = r.data;
                    }

                    var str = JSON.stringify(changes);

                    Ext.Ajax.request({
                        url: '/crm/guardarGridLibretaCliente',
                        params: {
                            datos: str,
                            idcliente: this.up('grid').idcliente
                        },
                        success: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            Ext.Msg.alert("Success", "Se guardaron correctamente los datos");
                            store.reload();
                        }
                    });

                }
            }, {
                text: 'Recargar',
                iconCls: 'refresh',
                handler: function () {
                    me.getStore().reload();
                }
            }



            );
            this.addDocked(tb);
        },
        edit: function (editor, e, eOpts) {
        }
    }
});
