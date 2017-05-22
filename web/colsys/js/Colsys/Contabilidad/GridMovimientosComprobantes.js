comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};
Ext.define('ComboNaturaleza', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-naturaleza',
    store: ['D', 'C']
});
Ext.define('Colsys.Contabilidad.GridMovimientosComprobantes', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridMovimientosComprobantes',
    //width: 400,
    //height: 200,
    //title: 'Summary Test',
    //style: 'padding: 20px',
    features: [{
            ftype: 'summary',
            id: 'comprobante',
            //ftype: 'groupingsummary',
            hideGroupedHeader: true,
            totalSummary: 'fixed', // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true, // Default: true
            totalSummaryColumnLines: true  // Default: false
        }],
    selModel: {
        selType: 'cellmodel'
    },
//    viewConfig: {
//        trackOver: false
//    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    //bufferedRenderer: false,
    width: 1000,
    height: 500,
    listeners: {
//        beforeedit: function (editor, e, eOpts) {
//            this.view.refresh();
//           /* var store = this.getStore();
//            var cuenta = store.data.items[e.rowIdx].get("cuenta");
//            var costos = store.data.items[e.rowIdx].get("costos");
//            var factura = store.data.items[e.rowIdx].get("factura");
//            if (e.field == 'descripcion') {
//                return true;
//            }*/
//
//            /*if (typeof cuenta === 'undefined' || cuenta == " ") {
//             if (e.field == 'factura') {
//             return true;
//             }
//             } else {
//             if (e.field == 'factura') {
//             return false;
//             }
//             }
//             
//             if (typeof factura === 'undefined' || factura == " ") {
//             if (e.field == 'cuenta') {
//             
//             return true;
//             }
//             } else {
//             if (e.field == 'cuenta') {
//             return false;
//             }
//             }*/
//
//            /*if (e.field == "costos" && costos == "-") {
//                return false;
//            }
//
//            if (e.field == 'costos') {
//                if (!(typeof factura === 'undefined' || factura == " ")) {
//                    return false;
//                }
//            }*/
//
//        },
        edit: function (editor, e, eOpts) {
            var store = this.getStore();
            var cuenta = store.data.items[e.rowIdx].get("cuenta");
            if (e.field == 'cuenta') {
                var str = Ext.getCmp("cuentagrid").getStore();
                record = str.findRecord("codigocuenta", cuenta);
                if (record) {
                    if (record.data.naturaleza) {
                        store.data.items[e.rowIdx].set("naturaleza", record.data.naturaleza);
                    }
                    if (record.data.detallaccostos != "S") {
                        store.data.items[e.rowIdx].set("costos", "-");
                    } else {
                        store.data.items[e.rowIdx].set("costos", "");
                    }
                    store.data.items[e.rowIdx].set("factura", "");
                } else {
                    store.data.items[e.rowIdx].set("costos", "");
                }

            }
            if (e.field == 'factura') {
                store.data.items[e.rowIdx].set("naturaleza", "C");
                consec = store.data.items[e.rowIdx].get("factura");
                strfac = Ext.getCmp("factura").getStore();
                rec = strfac.findRecord("consecutivo", consec);
                if (rec) {
                    Ext.getCmp("tercero").getStore().add(
                            {"nombre": rec.data.nombre, "id": rec.data.id, "cuentaformapago": rec.data.cuentaformapago}
                    );
                    store.data.items[e.rowIdx].set("tercero", (rec.data.id));
                    store.data.items[e.rowIdx].set("valor", (rec.data.valor));
                    store.data.items[e.rowIdx].set("cuenta", "");
                }
            }
            if (e.field == 'valor') {
                var r = Ext.create(store.model);
                r.set('valor', 0);
                store.insert(store.getCount(), r);
                this.view.refresh();
            }

        },
        beforeitemcontextmenu: function (view, record, item, index, e)
        {
            var idmast = this.idmaster;
            e.stopEvent();
            var record = this.store.getAt(index);
            var menu = new Ext.menu.Menu({
                items: [
                    {
                        text: 'Eliminar',
                        iconCls: 'delete',
                        handler: function () {
                            store.removeAt(index);
                        }
                    }
                ]
            }).showAt(e.getXY());
        },
        beforerender: function (ct, position) {
            this.setHeight(400);
            this.setWidth(1000);
            this.reconfigure(
                    //     this.superclass.onRender.call(this, ct, position),


                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'cuenta', mapping: 'cuenta'},
                            {name: 'factura', mapping: 'factura'},
                            {name: 'valor', mapping: 'valor', type: 'float'},
                            {name: 'descripcion', mapping: 'descripcion'},
                            {name: 'costos', mapping: 'costos'},
                            {name: 'naturaleza', mapping: 'naturaleza'},
                            {name: 'tercero', mapping: 'tercero'},
                            {name: 'cuentaformapago', mapping: 'cuentaformapago'}
                        ],
                        autoLoad: false,
                        remoteSort: true,
                        proxy: {
                            type: 'ajax',
                            url: '/contabilidad/datosCuentas',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    [{
                            text: "Cuenta",
                            dataIndex: 'cuenta',
                            sortable: false,
                            hideable: false,
                            width: 150,
                            editor: Ext.create('Colsys.Widgets.WgCuentasSiigo', {
                                id: 'cuentagrid',
                                forceSelection: false
                            }),
                            renderer: comboBoxRenderer(Ext.getCmp('cuentagrid'))
                        },
                        {
                            text: "Factura",
                            dataIndex: 'factura',
                            sortable: false,
                            hideable: false,
                            width: 200,
                            editor: Ext.create('Colsys.Widgets.WgFacturas', {
                                id: 'factura',
                                tipo: 'F'
                            })
                        },
                        {
                            text: "Naturaleza",
                            dataIndex: 'naturaleza',
                            hideable: false,
                            sortable: false,
                            width: 85,
                            editor: {
                                xtype: 'combo-naturaleza',
                                forceSelection: true
                            }

                        },
                        {
                            text: "Centro Costos",
                            dataIndex: 'costos',
                            sortable: false,
                            hideable: false,
                            width: 150,
                            editor: Ext.create('Colsys.Widgets.WgCentrocostos', {
                                id: 'centrocostosgrid'
                            }),
                            renderer: comboBoxRenderer(Ext.getCmp('centrocostosgrid'))
                        },
                        {
                            text: "Tercero",
                            dataIndex: 'tercero',
                            sortable: false,
                            hideable: false,
                            width: 150,
                            editor: Ext.create('Colsys.Widgets.WgIds', {
                                id: 'tercero',
                                store: new Ext.data.Store(
                                        {
                                            fields: [
                                                {name: 'idalterno'},
                                                {name: 'nombre'},
                                                {name: 'id'},
                                                {name: 'cuentaformapago'}
                                            ],
                                            proxy: {
                                                url: '/widgets5/datosIds',
                                                type: 'ajax',
                                                autoLoad: true,
                                                reader:
                                                        {
                                                            root: 'root',
                                                            totalProperty: 'totalCount',
                                                            id: 'id',
                                                            type: 'json'
                                                        }
                                            }
                                        }),
                                displayField: 'nombre',
                                valueField: 'id',
                                listeners: {
                                    select: function (combo, records, eOpts) {
                                        // this.up('grid').view.refresh();
                                    }
                                }
                            }),
                            renderer: comboBoxRenderer(Ext.getCmp('tercero'))
                        },
                        {
                            text: "Valor",
                            dataIndex: 'valor',
                            sortable: false,
                            hideable: false,
                            width: 120,
                            renderer: Ext.util.Format.numberRenderer('0,0.00'),
                            summaryType: 'sum',
                            editor: {
                                xtype: "numberfield",
                                listeners: {
                                    blur: function (me, e, eOpts) {
                                        this.up('grid').view.refresh();
                                    }
                                }
                            },
                            summaryRenderer: function (value, summaryData, dataIndex) {
                                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
                            }
                        },
                        {
                            text: "Descripcion",
                            sortable: false,
                            hideable: false,
                            dataIndex: 'descripcion',
                            width: 400,
                            editor: {
                                xtype: "textfield"
                            }
                        }
                    ]

                    );
        },
        afterrender: function (ct, position) {
            var store = this.getStore();
            var r = Ext.create(store.model);
            r.set('valor', 0);
            store.insert(0, r);
        }
    }
    /*tbar: [
     {
     text: 'Agregar',
     iconCls: 'add',
     handler: function () {
     var store = this.up("grid").getStore();
     var r = Ext.create(store.model);
     r.set('valor',0);
     store.insert(store.getCount(), r);
     }
     }
     ]*/
}
);