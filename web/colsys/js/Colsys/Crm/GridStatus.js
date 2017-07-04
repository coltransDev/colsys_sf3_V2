Ext.define('Colsys.Crm.GridStatus', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridStatus',
    width: 900,
    tbar: [{
            xtype: 'fieldcontainer',
            fieldLabel: 'Filtros',
            layout: 'hbox',
            defaultType: 'checkboxfield',
            items: [
                {
                    boxLabel: 'Mar&iacute;timo',
                    inputValue: '1',
                    id: 'maritimo',
                    listeners: {
                        change: function (m, newValue, oldValue, eOpts) {
                            alert('Maritimo');
                        }
                    }
                },
                {
                    xtype: 'displayfield',
                    value: ' ',
                    fieldStyle: 'padding-left: 5px;',
                    columnWidth: 0.01
                },
                {
                    boxLabel: 'Terrestre',
                    inputValue: '2',
                    id: 'Terrestre'
                },
                {
                    xtype: 'displayfield',
                    value: ' ',
                    fieldStyle: 'padding-left: 5px;',
                    columnWidth: 0.01
                },
                {
                    boxLabel: 'OTM',
                    inputValue: '3',
                    id: 'OTM'
                }
            ]
        }],
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            //console.log(record.data.etapa_actual);
            /*if (record.data.etapa_actual == 'Status'){
             return "row_green";
             }
             if (record.data.etapa_actual == 'Pendiente de Instrucciones'){
             return "row_yellow";
             }            
             if (record.data.etapa_actual == 'ETA'){
             return "row_blue";
             }*/
        }
    },
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
                            {name: 'fecha_rep', type: 'string', mapping: 'fecha_rep'},
                            {name: 'reporte', type: 'string', mapping: 'reporte'},
                            {name: 'origen', type: 'string', mapping: 'origen'},
                            {name: 'destino', type: 'string', mapping: 'destino'},
                            {name: 'modalidad', type: 'string', mapping: 'modalidad'},
                            {name: 'proveedor', type: 'string', mapping: 'proveedor'},
                            {name: 'orden', type: 'string', mapping: 'orden'},
                            {name: 'etapa_actual', type: 'string', mapping: 'etapa_actual'}
                        ],
//                        groupField: 'proveedor',
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosStatus',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            autoLoad: false
                        }
                    }),
                    [
                        {
                            header: "Fecha Rep",
                            sortable: false,
                            dataIndex: 'fecha_rep',
                            width: 90
                        },
                        {
                            header: "Reporte",
                            sortable: false,
                            dataIndex: 'reporte',
                            width: 130
                        },
                        {
                            header: "Origen",
                            sortable: false,
                            dataIndex: 'origen',
                            width: 90
                        },
                        {
                            header: "Destino",
                            sortable: false,
                            dataIndex: 'destino',
                            width: 90
                        },
                        {
                            header: "Modalidad",
                            sortable: false,
                            dataIndex: 'modalidad',
                            width: 90
                        }, {
                            header: "Proveedor",
                            sortable: false,
                            dataIndex: 'proveedor',
                            width: 230
                        }, {
                            header: "Orden",
                            sortable: false,
                            dataIndex: 'orden',
                            width: 90
                        }, {
                            header: "Etapa actual",
                            sortable: false,
                            dataIndex: 'etapa_actual',
                            width: 90
                        }

                    ]);
//            tb = new Ext.toolbar.Toolbar();
//            tb.add();
//            this.addDocked(tb);
        }
    }
});
