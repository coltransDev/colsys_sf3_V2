Ext.define('ComboPorcentajes', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-porcentaje',
    store: ['Coltrans', 'Colmas', 'ColOTM', 'Coldepositos']
});

winTercero = null;
Ext.define('Colsys.Crm.GridPorcetajeComision', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridPorcetajeComision',
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
                            {name: 'inicio', mapping: 'inicio'},
                            {name: 'fin', mapping: 'fin'},
                            {name: 'porcentaje', mapping: 'porcentaje'},
                            {name: 'empresa', mapping: 'empresa'},
                            {name: 'creacion', mapping: 'creacion'},
                            {name: 'ult_modificacion', mapping: 'ult_modificacion'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosPorcentajeComision',
                            reader: {
                                type: 'json',
                                root: 'data'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "Inicio",
                            dataIndex: 'inicio',
                            width: 100
                        },
                        {
                            header: "Fin",
                            dataIndex: 'fin',
                            width: 100
                        },
                        {
                            header: "Porcentaje",
                            dataIndex: 'porcentaje',
                            width: 100
                        },
                        {
                            header: "Empresa",
                            dataIndex: 'empresa',
                            width: 100
                        },
                        {
                            header: "Creaci&oacute;n",
                            dataIndex: 'creacion',
                            width: 280
                        },
                        {
                            header: "Ultima modificaci&oacute;n",
                            dataIndex: 'ult_modificacion',
                            width: 280
                        }
                    ]);

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Agregar',
                iconCls: 'add',
                id: 'agregarPorcentaje' + me.idcliente,
                handler: function () {
                    if (winTercero == null)
                    {
                        winTercero = Ext.create('Ext.window.Window', {
                            title: 'Registrar Porcentaje',
                            closeAction: 'destroy',
                            height: 190,
                            width: 400,
                            id: "winFormEdit",
                            name: "winFormEdit",
                            items:
                                    {
                                        xtype: "Colsys.Crm.FormPorcentajeComision",
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
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Porcentaje de comisi&oacute;n<br>Por favor cierrela primero");
                    }
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos[20]);
                    }
                }
            }
            );
            this.addDocked(tb);
        }
    }
});
