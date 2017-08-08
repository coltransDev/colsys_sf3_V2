winTercero = null;
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
                        }
                    ]);

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Agregar',
                iconCls: 'add',
                id: 'agregarCredito' + me.idcliente,
                handler: function () {
                    if (winTercero == null) {
                        winTercero = Ext.create('Ext.window.Window', {
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
                                    winTercero = null;
                                }
                            }
                        });
                        winTercero.show();
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
