Ext.define('Colsys.Crm.GridTabVinculantes', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridTabVinculantes',
    listeners: {
        afterrender: function (ct, position) {
            var storeAfter = this.getStore();
            storeAfter.load({
                params: {
                    id: this.idcliente
                }
            });
        },
        render: function (ct, position) {
            var me = this;
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'fchconsultado', type: 'string', mapping: 'fchconsultado'},
                            {name: 'tipo_consulta', type: 'string', mapping: 'tipo_consulta'},
                            {name: 'parametro', type: 'string', mapping: 'parametro'},
                            {name: 'idrespuesta', type: 'string', mapping: 'idrespuesta'},
                            {name: 'respuesta', type: 'string', mapping: 'respuesta'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/ids/consultaWsListaSinte',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "Fch.Consultado",
                            dataIndex: 'fchconsultado',
                            flex: 1
                        }, {
                            header: "Tipo Consulta",
                            dataIndex: 'tipo_consulta',
                            flex: 1
                        }, {
                            header: "Parametro",
                            dataIndex: 'parametro',
                            flex: 1
                        }, {
                            header: "Id. Respuesta",
                            dataIndex: 'idrespuesta'
                        }, {
                            header: "Respuesta",
                            dataIndex: 'respuesta'
                        }
                    ]);
        }
    }
});
