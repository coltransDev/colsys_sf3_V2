Ext.define('Colsys.General.GridMaestraConceptos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.General.GridMaestraConceptos',    
    autoHeight: true,
    autoScroll: true,
    plugins:{
       cellediting: true
    },
    listeners: {        
        beforerender: function(ct, position){            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: [
                        { name: 'sel'+this.idgrid },
                        { name: 'ca_idconcepto'+this.idgrid,                mapping: 'mc_ca_idconcepto',            type:'integer'  },
                        { name: 'ca_concepto_esp'+this.idgrid,              mapping: 'mc_ca_concepto_esp',          type:'string'   },
                        { name: 'ca_concepto_eng'+this.idgrid  ,            mapping: 'mc_ca_concepto_eng',          type:'string'   },
                        { name: 'ca_compra'+this.idgrid,                    mapping: 'mc_ca_compra',                type:'boolean'  },
                        { name: 'ca_venta'+this.idgrid,                     mapping: 'mc_ca_venta',                 type:'boolean'  },
                        { name: 'ca_importacion'+this.idgrid,               mapping: 'mc_ca_importacion',           type:'boolean'  },
                        { name: 'ca_exportacion'+this.idgrid,               mapping: 'mc_ca_exportacion',           type:'boolean'  },
                        { name: 'ca_triangulacion'+this.idgrid,             mapping: 'mc_ca_triangulacion',         type:'boolean'  },
                        { name: 'ca_aereo'+this.idgrid,                     mapping: 'mc_ca_aereo',                 type:'boolean'  },
                        { name: 'ca_maritimo'+this.idgrid,                  mapping: 'mc_ca_maritimo',              type:'boolean'  },
                        { name: 'ca_terrestre_internacional'+this.idgrid,   mapping: 'mc_ca_terrestre_internacional', type:'boolean'  },
                        { name: 'ca_otm'+this.idgrid,                       mapping: 'mc_ca_otm',                   type:'boolean'  },
                        { name: 'ca_contenedor'+this.idgrid,                mapping: 'mc_ca_contenedor',            type:'boolean'  },
                        { name: 'ca_terrestre_nacional'+this.idgrid,        mapping: 'mc_ca_terrestre_nacional',    type:'boolean' },
                        { name: 'ca_depositos'+this.idgrid,                 mapping: 'mc_ca_depositos',             type:'boolean'  },
                        { name: 'ca_bodeganal'+this.idgrid,                 mapping: 'mc_ca_bodeganal',             type:'boolean'  },
                        { name: 'ca_origen'+this.idgrid,                    mapping: 'mc_ca_origen',                type:'boolean'  },
                        { name: 'ca_general'+this.idgrid,                   mapping: 'mc_ca_general',               type:'boolean'  },
                        { name: 'ca_destino'+this.idgrid,                   mapping: 'mc_ca_destino',               type:'boolean'  },
                        { name: 'ca_contiguo'+this.idgrid,                  mapping: 'mc_ca_contiguo',              type:'boolean'  },
                        { name: 'ca_admon'+this.idgrid,                     mapping: 'mc_ca_admon',                 type:'boolean'  },
                        { name: 'ca_estado_coltrans'+this.idgrid,           mapping: 'mc_estado_coltrans',          type:'boolean'  },
                        { name: 'ca_estado_colotm'+this.idgrid,             mapping: 'mc_estado_colotm',            type:'boolean'  },
                        { name: 'ca_estado_coldepositos'+this.idgrid,       mapping: 'mc_estado_coldepositos',      type:'boolean'  },
                        { name: 'ca_estado_colbodnal'+this.idgrid,          mapping: 'mc_estado_colbodnal',         type:'boolean'  }
                    ],
                    autoLoad:true,
                    remoteSort: false,
                    proxy: {
                        type: 'ajax',
                        url: '/config/datosMaestraConceptos',
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    }
                }),
                [
                    {text : '',                         dataIndex: 'sel'+this.idgrid,                           xtype:  'checkcolumn',                  width:30 },
                    {text: ""  ,                        dataIndex: 'ca_idconcepto'+this.idgrid,                 hidden:true,            sortable: true},
                    {
                        text: "Concepto (Spa)",
                        dataIndex: 'ca_concepto_esp'+this.idgrid,
                        width: 200,
                        sortable: true,
                        editor: {
                            xtype: 'textfield',maxLength: 50
                        },
                        renderer: function (value, metaData, record, rowIdx, colIdx, store, view) {
                            eval("var idconcepto = record.data.ca_idconcepto"+this.idgrid+";");                            
                            if(idconcepto > 0)
                                return idconcepto+'-'+value;
                            else
                                return value;
                        }
                    },
                    {text: "Concepto (Eng)",            dataIndex: 'ca_concepto_eng'+this.idgrid,               width: 300,                        sortable: true, editor: {xtype: 'textfield',maxLength: 50}},
                    {text: "Compra"    ,                dataIndex: 'ca_compra'+this.idgrid,                     xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Venta"   ,                  dataIndex: 'ca_venta'+this.idgrid,                      xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Importaci\u00F3n",          dataIndex: 'ca_importacion'+this.idgrid,                xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Exportaci\u00F3n",          dataIndex: 'ca_exportacion'+this.idgrid,                xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},                    
                    {text: "A\u00E9reo",                dataIndex: 'ca_aereo'+this.idgrid,                      xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},            
                    {text: "Mar\u00EDtimo",             dataIndex: 'ca_maritimo'+this.idgrid,                   xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Terrestre Internacional",   dataIndex: 'ca_terrestre_internacional'+this.idgrid,    xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Otm",                       dataIndex: 'ca_otm'+this.idgrid,                        xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Contenedor",                dataIndex: 'ca_contenedor'+this.idgrid,                 xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Terrestre Nacional",        dataIndex: 'ca_terrestre_nacional'+this.idgrid,         xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},            
                    {text: "Dep\u00F3sitos",            dataIndex: 'ca_depositos'+this.idgrid,                  xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Col. Bod. Nal",             dataIndex: 'ca_bodeganal'+this.idgrid,                  xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Origen",                    dataIndex: 'ca_origen'+this.idgrid,                     xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "General",                   dataIndex: 'ca_general'+this.idgrid,                    xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Destino",                   dataIndex: 'ca_destino'+this.idgrid,                    xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Contiguo",                  dataIndex: 'ca_contiguo'+this.idgrid,                   xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {text: "Admon.",                    dataIndex: 'ca_admon'+this.idgrid,                      xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra', ignoreExport: false},
                    {
                        text: "Coltrans",   
                        dataIndex: 'ca_estado_coltrans'+this.idgrid,                        
                        sortable: true,                         
                        cls: 'grid-maestra', 
                        ignoreExport: false,
                        renderer: function(value){
                            return value?'<img src="/images/16x16/button_ok.gif"/>':'<img src="/images/16x16/button_cancel.gif"/>';
                        }
                    },
                    {
                        text: "Colotm",   
                        dataIndex: 'ca_estado_colotm'+this.idgrid,                        
                        sortable: true,                         
                        cls: 'grid-maestra', 
                        ignoreExport: false,
                        renderer: function(value){
                            return value?'<img src="/images/16x16/button_ok.gif"/>':'<img src="/images/16x16/button_cancel.gif"/>';
                        }
                    },
                    {
                        text: "Coldepositos",   
                        dataIndex: 'ca_estado_coldepositos'+this.idgrid,                        
                        sortable: true,                         
                        cls: 'grid-maestra', 
                        ignoreExport: false,
                        renderer: function(value){
                            return value?'<img src="/images/16x16/button_ok.gif"/>':'<img src="/images/16x16/button_cancel.gif"/>';
                        }
                    },
                    {
                        text: "Col. Bod. Nal",   
                        dataIndex: 'ca_estado_colbodnal'+this.idgrid,                        
                        sortable: true,                         
                        cls: 'grid-maestra', 
                        ignoreExport: false,
                        renderer: function(value){
                            return value?'<img src="/images/16x16/button_ok.gif"/>':'<img src="/images/16x16/button_cancel.gif"/>';
                        }
                    }
                ]
            )
    
            tb = new Ext.toolbar.Toolbar({
                dock: 'top',                    
                id: 'bar-grid-'+this.idgrid
            });
    
            console.log("crear"+permisosC.Crear);
            if(permisosC.Crear){
                tb.add({
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
                        modified = [];
                        serie = [];
                        for (var i = 0; i < records.length; i++) {
                            r = records[i];
                            records[i].data.id = r.id                            
                            
                            row = new Object();
                            for (j = 0; j < fields.length; j++){
                                eval("row." + fields[j] + "=records[i].data." + fields[j] + idgrid + ";")                                
                            }
                            row.id = r.id
                            changes[i] = row;                            
                            modified = r.getChanges();
                            console.log(modified);
                            for (var key in modified){                                
                                var x = key.indexOf(idgrid);
                                var name = key.substr(0,x);
                                serie.push({"ca_idconcepto": row.ca_idconcepto, "name": name, "value":modified[key]});
                            }                        
                        }
                        console.log(serie.length);
                        console.log(serie);
                        var str = JSON.stringify(changes);
                        if (serie.length > 0)
                            var mod = JSON.stringify(serie);                        
                        console.log(mod);
                        if (str.length > 5){
                            Ext.Ajax.request({
                                url: '/config/guardarMaestraConceptos',
                                params: {
                                    datos: str,
                                    datosMod: mod?mod:null
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
                });
            }
            
            tb.add({
                text: 'Recargar',
                iconCls: 'refresh',                
                handler : function(){
                    this.up("grid").getStore().reload();
                }
            },{
                xtype: 'button',
                text: 'Exportar XLXS',
                iconCls: 'csv',
                handler: function(){
                    this.addExporter(this.up("grid"), "Maestra de Conceptos", 15000);
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
                                var str2=record.get("ca_idconcepto"+idgrid);

                                var txt=new RegExp(newValue,"ig");
                                if(str.search(txt) == -1 && str1.search(txt) == -1 && str2.toString().search(txt) == -1)
                                    return false;
                                else
                                    return true;
                            });
                        }
                    }
                }
            });            
            
            this.addDocked(tb);
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