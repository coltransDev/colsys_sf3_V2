Ext.define('Colsys.Contabilidad.GridMaestraConceptos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Contabilidad.GridMaestraConceptos',    
    autoHeight: true,
    autoScroll: true,    
    height:400,    
//    plugins: [
//        new Ext.grid.plugin.CellEditing({clicksToEdit: 2})
//    ],
    plugins:{
        cellediting: true,
        gridexporter: true
    },
    listeners: {        
        beforerender: function(ct, position){            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: [
                        { name: 'sel'+this.idgrid },
                        { name: 'ca_idconcepto'+this.idgrid,        mapping: 'mc_ca_idconcepto',       type:'integer'  },
                        { name: 'ca_concepto_esp'+this.idgrid,      mapping: 'mc_ca_concepto_esp',     type:'string'   },
                        { name: 'ca_concepto_eng'+this.idgrid  ,    mapping: 'mc_ca_concepto_eng',     type:'string'   },
                        { name: 'ca_compra'+this.idgrid,            mapping: 'mc_ca_compra',           type:'boolean'  },
                        { name: 'ca_venta'+this.idgrid,             mapping: 'mc_ca_venta',            type:'boolean'  },
                        { name: 'ca_importacion'+this.idgrid,       mapping: 'mc_ca_importacion',      type:'boolean'  },
                        { name: 'ca_exportacion'+this.idgrid,       mapping: 'mc_ca_exportacion',      type:'boolean'  },
                        { name: 'ca_aereo'+this.idgrid,             mapping: 'mc_ca_aereo',            type:'boolean'  },
                        { name: 'ca_maritimo'+this.idgrid,          mapping: 'mc_ca_maritimo',         type:'boolean'  },
                        { name: 'ca_terrestre_interno'+this.idgrid, mapping: 'mc_ca_terrestre_interno',type:'boolean'  },
                        { name: 'ca_otm'+this.idgrid,               mapping: 'mc_ca_otm',              type:'boolean'  },
                        { name: 'ca_contenedor'+this.idgrid,        mapping: 'mc_ca_contenedor',       type:'boolean'  },
                        { name: 'ca_terrestre_nacional'+this.idgrid,mapping: 'mc_ca_terrestre_nacional',type:'boolean' },
                        { name: 'ca_depositos'+this.idgrid,         mapping: 'mc_ca_depositos',        type:'boolean'  },
                        { name: 'ca_origen'+this.idgrid,            mapping: 'mc_ca_origen',           type:'boolean'  },
                        { name: 'ca_general'+this.idgrid,           mapping: 'mc_ca_general',          type:'boolean'  },
                        { name: 'ca_destino'+this.idgrid,           mapping: 'mc_ca_destino',          type:'boolean'  },
                        { name: 'ca_contiguo'+this.idgrid,          mapping: 'mc_ca_contiguo',         type:'boolean'  }
                    ],
                    autoLoad:true,
                    remoteSort: false,
                    proxy: {
                        type: 'ajax',
                        url: '/contabilidad/datosMaestraConceptos',
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    }
                }),
                [
                    {text : '',                 dataIndex: 'sel'+this.idgrid,               xtype:  'checkcolumn',                  width:30 },
                    {text: ""  ,                dataIndex: 'ca_idconcepto'+this.idgrid,     hidden:true,                sortable: true},
                    {text: "Concepto (Spa)"  ,  dataIndex: 'ca_concepto_esp'+this.idgrid,                               sortable: true, flex: 3, editor: {xtype: 'textfield',maxLength: 30}},
                    {text: "Concepto (Eng)",    dataIndex: 'ca_concepto_eng'+this.idgrid,                               sortable: true, flex: 3, editor: {xtype: 'textfield',maxLength: 30}},
                    {text: "Compra"    ,        dataIndex: 'ca_compra'+this.idgrid,             xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Venta"   ,          dataIndex: 'ca_venta'+this.idgrid,              xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Importaci\u00F3n",  dataIndex: 'ca_importacion'+this.idgrid,        xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Exportaci\u00F3n",  dataIndex: 'ca_exportacion'+this.idgrid,        xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "A\u00E9reo",        dataIndex: 'ca_aereo'+this.idgrid,              xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},            
                    {text: "Mar\u00EDtimo",     dataIndex: 'ca_maritimo'+this.idgrid,           xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Terrestre Interno", dataIndex: 'ca_terrestre_interno'+this.idgrid,  xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Otm",               dataIndex: 'ca_otm'+this.idgrid,                xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Contenedor",        dataIndex: 'ca_contenedor'+this.idgrid,         xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Terrestre Nacional",dataIndex: 'ca_terrestre_nacional'+this.idgrid, xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},            
                    {text: "Dep\u00F3sitos",    dataIndex: 'ca_depositos'+this.idgrid,          xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Origen",            dataIndex: 'ca_origen'+this.idgrid,             xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "General",           dataIndex: 'ca_general'+this.idgrid,            xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Destino",           dataIndex: 'ca_destino'+this.idgrid,            xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Contiguo",          dataIndex: 'ca_contiguo'+this.idgrid,           xtype:  'checkcolumn',  sortable: true, flex: 1, cls: 'grid-maestra', ignoreExport: false}
                ]
            )
            var obj = {
                xtype: 'toolbar',
                dock: 'top',                    
                id: 'bar-grid-'+this.idgrid,                
                items: [{
                    text: 'Agregar',
                    iconCls: 'add',
                    handler: function () {
                        var store = this.up('grid').store;
                        var r = Ext.create(store.model);
                        r.set('idgrid', this.up('grid').idgrid);
                        store.insert(0, r);
                        this.up('grid').getView().focusRow(0);
                    }
                },{
                    text: 'Guardar',
                    iconCls: 'disk',
                    handler: function () {                        
                        var store = this.up('grid').getStore();
                        var idgrid = this.up('grid').idgrid;
                        var records = store.getModifiedRecords();                        
                        var str = "";
                        var r = Ext.create(store.getModel());
                        
                        fields = new Array();
                        for (i = 0; i < r.fields.length; i++){
                            fields.push(r.fields[i].name.replace(idgrid, ""));
                        }

                        changes = [];                        
                        for (var i = 0; i < records.length; i++) {
                            r = records[i];
                            records[i].data.id = r.id                            
                            row = new Object();
                            for (j = 0; j < fields.length; j++){
                                eval("row." + fields[j] + "=records[i].data." + fields[j] + idgrid + ";")
                            }
                            row.id = r.id
                            changes[i] = row;
                        }                        
                        var str = JSON.stringify(changes);
                        
                        if (str.length > 5){
                            Ext.Ajax.request({
                                url: '/contabilidad/guardarMaestraConceptos',
                                params: {
                                    datos: str
                                },
                                callback: function (options, success, response) {
                                    var res = Ext.util.JSON.decode(response.responseText);
                                    if (success) {
                                        var res = Ext.decode(response.responseText);
                                        ids = res.ids;
                                        if (res.ids && res.idconceptos) {
                                            for (i = 0; i < ids.length; i++) {
                                                var rec = store.getById(ids[i]);
                                                rec.set(("idconcepto" + idgrid), res.idconceptos[i]);
                                                rec.commit();
                                                store.reload();                                                
                                            }
                                            Ext.MessageBox.alert("Mensaje", 'Informaci\u00F3n almacenada correctamente<br>');
                                        }
                                    } else {
                                        Ext.MessageBox.alert("Error", 'Error al guardar<br>' + res.errorInfo);
                                    }
                                }
                            });
                        }
                    }
                },{
                    text: 'Recargar',
                    iconCls: 'refresh',
                    //id:'btn-guardarrecarga',
                    handler : function(){
                        this.up("grid").getStore().reload();
                    }
                },{
                    xtype: 'button',
                    text: 'Exportar XLXS',
                    iconCls: 'csv',
                    handler: function(){
                        this.up("grid").saveDocumentAs({
                            type: 'csv',
                            title: 'Maestra de Conceptos',
                            fileName: 'Maestra_de_Conceptos.csv'
                        })
                    }
                },{
                    xtype: "textfield",
                    fieldLabel: 'Buscar',
                    listeners:{
                        change:function( obj, newValue, oldValue, eOpts ){
                            var idgrid = this.up("grid").idgrid;                            
                            var store=this.up("grid").getStore();
                            store.clearFilter();
                            if(newValue!=""){
                                store.filterBy(function(record, id){                                    
                                    var str=record.get("ca_concepto_esp"+idgrid);
                                    var str1=record.get("ca_concepto_eng"+idgrid);
                                    
                                    var txt=new RegExp(newValue,"ig");
                                    if(str.search(txt) == -1 && str1.toString().search(txt) == -1)
                                        return false;
                                    else
                                        return true;
                                });
                            }
                        }
                    }
                }]
            };
            this.addDocked(obj);
        },        
        rowclick: function (t, record, element, rowIndex, e, eOpts ) {
            
            var idgridMaestra = Ext.getCmp('grid-maestra-conceptos').idgrid;
            var idgridDetalle = Ext.getCmp('grid-detalle-conceptos').idgrid;            
            
            eval("var idconceptoMaestra = record.data.ca_idconcepto"+idgridMaestra+";")
            
            Ext.getCmp('grid-detalle-conceptos').store.clearFilter();
            Ext.getCmp('grid-detalle-conceptos').store.filterBy(function(recordDetalle) {
                eval("var idpadre = recordDetalle.data.ca_idpadre"+idgridDetalle+";")
                
                if(idpadre === idconceptoMaestra) {
                    return true;
                } else {
                    return false;
                }
            });
            Ext.getCmp('grid-detalle-conceptos').store.reload();   
            Ext.getCmp('grid-detalle-conceptos').idpadre = idconceptoMaestra;
        }
    }
});