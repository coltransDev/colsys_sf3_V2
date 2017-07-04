
Ext.define('Colsys.Crm.GridHistoricoClientes', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridHistoricoClientes',
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
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
            this.reconfigure(
//                    this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'operacion', type: 'string', mapping: 'operacion'},
                            {name: 'fecha', type: 'string', mapping: 'fecha'},
                            {name: 'usuario', type: 'string', mapping: 'usuario'},
                            {name: 'tabla', type: 'string', mapping: 'tabla'},
                            {name: 'campo', type: 'string', mapping: 'campo'},
                            {name: 'dato_anterior', type: 'string', mapping: 'dato_anterior'},
                            {name: 'dato_nuevo', type: 'string', mapping: 'dato_nuevo'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosHistoricoClientes',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "Operaci&oacute;n",
                            dataIndex: 'operacion',
                            width: 90
                        },
                        {
                            header: "Fecha",
                            dataIndex: 'fecha',
                            width: 130
                        },
                        {
                            header: "Usuario",
                            dataIndex: 'usuario',
                            width: 90
                        },
                        {
                            header: "Tabla",
                            dataIndex: 'tabla',
                            width: 90
                        },
                        {
                            header: "Campo",
                            dataIndex: 'campo',
                            width: 130
                        }, {
                            header: "Dato Anterior",
                            dataIndex: 'dato_anterior',
                            width: 200
                        }, {
                            header: "Nuevo Dato",
                            dataIndex: 'dato_nuevo',
                            width: 200
                        }
                    ]);
        }
    }
});
