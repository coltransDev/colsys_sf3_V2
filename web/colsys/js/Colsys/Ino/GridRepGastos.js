/*winrepgastos = null;
 comboBoxRenderer = function (combo) {
 return function (value) {
 
 var idx = combo.store.find(combo.valueField, value);
 var rec = combo.store.getAt(idx);
 return (rec === null ? value : rec.get(combo.displayField));
 };
 };
 
 
 Ext.define('Colsys.Ino.GridRepGastos', {
 extend: 'Ext.tree.Panel',
 alias: 'widget.Colsys.Ino.GridRepGastos',
 width: 840,
 height: 450,
 useArrows: true,
 collapsed: false,
 expanded: true,
 store: Ext.create('Ext.data.TreeStore', {
 expanded: true,
 fields: [
 {name: 'concepto'},
 {name: 'idconcepto'},
 {name: 'aplicacion'},
 {name: 'cantidad'},
 {name: 'moneda'},
 {name: 'cobrar'},
 {name: 'seleccionado'}
 ],
 proxy: {
 type: 'ajax',
 url: '/inoF2/datosRepGastos'
 
 },
 autoLoad: false
 }),
 rootVisible: true,
 selModel: {
 selType: 'cellmodel'
 },
 plugins: [
 new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
 ],
 frame: true,
 columns: [
 {
 xtype: "checkcolumn",
 dataIndex: 'seleccionado',
 sortable: false,
 hideable: false,
 width: 40,
 renderer: function (value, metaData, record, row, col, store, gridView) {
 
 var cssPrefix = Ext.baseCSSPrefix,
 cls = cssPrefix + 'grid-checkcolumn';
 if (this.disabled) {
 cellValues.tdCls += ' ' + this.disabledCls;
 }
 if (value === null) {
 cellValues.tdCls += ' ' + this.disabledCls;
 }
 if (value) {
 cls += ' ' + cssPrefix + 'grid-checkcolumn-checked';
 }
 if (record.get("leaf")) {
 return '<img class="' + cls + '" src="' + Ext.BLANK_IMAGE_URL + '"/>';
 }
 
 
 
 },
 listeners: {
 checkchange: function (grid, rowIndex, colIndex) {
 
 
 }
 }
 },
 {
 header: 'idConcepto',
 dataIndex: 'idconcepto',
 width: 50,
 hidden: true
 },
 {
 xtype: 'treecolumn',
 header: 'Concepto',
 dataIndex: 'concepto',
 width: 250
 },
 {
 header: 'Aplicacion',
 dataIndex: 'aplicacion',
 width: 120,
 align: 'right'
 },
 
 {
 header: 'Moneda',
 dataIndex: 'moneda',
 width: 120,
 align: 'right'
 },
 {
 header: 'Cobrar',
 dataIndex: 'cobrar',
 width: 120,
 align: 'right',
 //renderer: Ext.util.Format.usMoney,
 renderer:
 
 Ext.util.Format.Currency = function (v)
 {
 if (v){
 v = (Math.round((v - 0) * 100)) / 100;
 v = (v == Math.floor(v)) ? v + ".00" : ((v * 10 == Math.floor(v * 10)) ? v + "0" : v);
 return ('&dollar;' + v).replace(/\./, ',');
 }
 else{
 return "";
 }
 }
 
 }
 ],
 listeners: {
 afterrender: function (ct, position) {
 
 idhouse = this.idhouse;
 
 this.store.load({
 params: {
 idhouse: idhouse
 }
 
 });
 tb = new Ext.toolbar.Toolbar();
 tb.add(
 [
 {
 text: 'Importar',
 iconCls: 'import',
 id: 'btn-importargastos' + this.idhouse,
 handler: function () {
 
 var storG = this.up('panel').getStore();
 idmaster = this.up('panel').idmaster;
 idcomprobante = this.up('panel').idcomprobante;
 store = Ext.getCmp("conceptosfac").getStore();
 grid = Ext.getCmp("conceptosfac");
 
 for (var i = 0; i < storG.getCount(); i++) {
 var record = storG.getAt(i);
 if (record.get('seleccionado') == true) {
 var r = Ext.create(store.getModel());
 r.set('concepto', record.get('idconcepto'));
 r.set('idconcepto', record.get('idconcepto'));
 r.set('valor', record.get('cobrar'));
 r.set('idcomprobante', idcomprobante);
 
 store.insert(0, r);
 grid.view.refresh();
 grid.getSelectionModel().setCurrentPosition({row: store.getCount(), column: 1});
 
 }
 
 }
 
 
 }
 
 }
 ]);
 this.addDocked(tb);
 
 
 },
 beforerender: function (ct, position) {
 
 }
 }
 });
 */



Ext.define('Colsys.Ino.GridRepGastos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridRepGastos',
    width: 840,
    height: 450,
    selModel: {
        selType: 'cellmodel'
    },
    features: [{
            id: 'comprobante',
            ftype: 'groupingsummary',
            //hideGroupedHeader: true,
            totalSummary: 'fixed', // Can be: 'fixed', true, false. Default: false
            totalSummaryTopLine: true, // Default: true
            totalSummaryColumnLines: true // Default: false


        }],
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    frame: true,
    listeners: {
        afterrender: function (ct, position) {
            idhouse = this.idhouse;
            this.store.proxy.extraParams = {
                idhouse: idhouse
            }
            this.store.reload();


            tb = new Ext.toolbar.Toolbar();
            tb.add(
                    [
                        {
                            text: 'Importar',
                            iconCls: 'import',
                            id: 'btn-importargastos' + this.idhouse,
                            handler: function () {

                                var storG = this.up('panel').getStore();
                                idmaster = this.up('panel').idmaster;
                                idcomprobante = this.up('panel').idcomprobante;
                                store = Ext.getCmp("conceptosfac").getStore();
                                grid = Ext.getCmp("conceptosfac");
                                alertamoneda = 0;

                                for (var i = 0; i < storG.getCount(); i++) {
                                    var record = storG.getAt(i);
                                    for (var j = 0; j < store.getCount(); j++) {
                                        recordconceptos = store.getAt(j);
                                        if (record.get("moneda") != recordconceptos.get('idmoneda') && !isNaN(recordconceptos.get("moneda"))) {
                                            alertamoneda = 1;
                                        }
                                    }
                                }
                                if (alertamoneda == 1) {
                                    Ext.MessageBox.alert("Conflicto", "Est&aacute; importando conceptos con monedas diferentes");
                                } 
                                //else
                                {

                                    for (var i = 0; i < storG.getCount(); i++) {
                                        var record = storG.getAt(i);
                                        if (record.get('seleccionado') == true) {
                                            var r = Ext.create(store.getModel());
                                            r.set('concepto', record.get('idconcepto'));
                                            r.set('idconcepto', record.get('idconcepto'));
                                            r.set('valor', record.get('cobrar'));
                                            r.set('idcomprobante', idcomprobante);
                                            store.insert(0, r);
                                            grid.view.refresh();
                                            grid.getSelectionModel().setCurrentPosition({row: store.getCount(), column: 1});
                                        }

                                    }
                                    Ext.MessageBox.alert("Colsys", "Datos importados correctamente");
                                }


                            }

                        }
                    ]);
            this.addDocked(tb);
        },
        beforerender: function (ct, position) {
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'idconcepto', mapping: 'idconcepto'},
                            {name: 'concepto', mapping: 'concepto'},
                            {name: 'aplicacion', mapping: 'aplicacion'},
                            {name: 'moneda', mapping: 'moneda'},
                            {name: 'cobrar', mapping: 'cobrar'},
                            {name: 'agrupador', mapping: 'agrupador'}

                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosRepGastos',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        groupField: 'agrupador',
                        sorters: [{
                                property: 'agrupador',
                                direction: 'ASC'
                            }],
                        autoLoad: false
                    }),
                    [
                        {
                            id: 'agrupador',
                            dataIndex: 'agrupador',
                            hidden: true

                        },
                        {
                            xtype: "checkcolumn",
                            dataIndex: 'seleccionado',
                            sortable: false,
                            hideable: false,
                            width: 40
                                    /*renderer: function (value, metaData, record, row, col, store, gridView) {
                                     
                                     var cssPrefix = Ext.baseCSSPrefix,
                                     cls = cssPrefix + 'grid-checkcolumn';
                                     if (this.disabled) {
                                     cellValues.tdCls += ' ' + this.disabledCls;
                                     }
                                     if (value === null) {
                                     cellValues.tdCls += ' ' + this.disabledCls;
                                     }
                                     if (value) {
                                     cls += ' ' + cssPrefix + 'grid-checkcolumn-checked';
                                     }
                                     if (record.get("leaf")) {
                                     return '<img class="' + cls + '" src="' + Ext.BLANK_IMAGE_URL + '"/>';
                                     }
                                     
                                     
                                     
                                     },*/

                        },
                        {
                            header: 'idConcepto',
                            dataIndex: 'idconcepto',
                            width: 50,
                            hidden: true
                        },
                        {
                            header: 'Concepto',
                            dataIndex: 'concepto',
                            width: 250
                        },
                        {
                            header: 'Aplicacion',
                            dataIndex: 'aplicacion',
                            width: 120,
                            align: 'right'
                        },
                        {
                            header: 'Moneda',
                            dataIndex: 'moneda',
                            width: 120,
                            align: 'right'
                        },
                        {
                            header: 'Cobrar',
                            dataIndex: 'cobrar',
                            width: 120,
                            align: 'right',
                            renderer:
                                    Ext.util.Format.Currency = function (v)
                                    {
                                        if (v) {
                                            v = (Math.round((v - 0) * 100)) / 100;
                                            v = (v == Math.floor(v)) ? v + ".00" : ((v * 10 == Math.floor(v * 10)) ? v + "0" : v);
                                            
                                            return ('&dollar;' + v).replace(/\./, ',');
                                        } else {
                                            return "";
                                        }
                                    }
                        }
                    ]

                    );
        }
    }
});