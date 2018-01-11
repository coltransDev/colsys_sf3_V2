
winTercero = null;
Ext.define('Colsys.Crm.GridSeguimientosClientes', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridSeguimientosClientes',
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    width: 640,
    listeners: {
        afterrender: function (ct, position) {

        },
        activate: function (me, eOpts ){
            var storeAfter = this.getStore();
            storeAfter.load({
                params: {
                    idcliente: this.idcliente
                }
            });
        }, 
        render: function (me, position) {
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'usuario', type: 'string', mapping: 'usuario'},
                            {name: 'fecha', type: 'string', mapping: 'fecha'},
                            {name: 'tipo', type: 'string', mapping: 'tipo'},
                            {name: 'asunto', type: 'string', mapping: 'asunto'},
                            {name: 'detalle', type: 'string', mapping: 'detalle'},
                            {name: 'compromisos', type: 'string', mapping: 'compromisos'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosSeguimientoClientes',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "Usuario",
                            dataIndex: 'usuario',
                            width: 130
                        },
                        {
                            header: "Fecha",
                            dataIndex: 'fecha',
                            width: 130
                        },
                        {
                            header: "Tipo",
                            dataIndex: 'tipo',
                            width: 120
                        },
                        {
                            header: "Asunto",
                            dataIndex: 'asunto',
                            width: 120
                        },
                        {
                            header: "Detalle",
                            dataIndex: 'detalle',
                            width: 350
                        }, {
                            header: "Compromisos",
                            dataIndex: 'compromisos',
                            width: 250
                        }
                    ]);
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'button',
                text: 'Nuevo Seguimiento',
                height: 30,
                iconCls: 'add',
                id: 'nuevoSeguimiento' + me.idcliente,
                handler: function () {
//                    alert(me.idcliente);
                    if (winTercero == null)
                    {
                        winTercero = Ext.create('Ext.window.Window', {
                            title: 'Datos del Seguimiento',
                            closeAction: 'destroy',
                            height: 400,
                            width: 610,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            items:
                                    {
                                        xtype: "Colsys.Crm.FormSeguimiento",
                                        idcliente: this.up('grid').idcliente
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
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Seguimientos<br>Por favor cierrela primero");
                    }
                }
            }, {
                text: 'Recargar',
                iconCls: 'refresh',
                handler: function () {
                    me.getStore().reload();
                }
            });
            this.addDocked(tb);
        }
    }
});
