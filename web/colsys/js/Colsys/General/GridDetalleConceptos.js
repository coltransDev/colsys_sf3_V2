Ext.define('Colsys.General.GridDetalleConceptos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.General.GridDetalleConceptos',    
    autoHeight: true,
    autoScroll: true,    
    //height:400,    
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
                        { name: 'ca_idconcepto'+this.idgrid,        mapping: 'c_ca_idconcepto',     type:'integer'  },
                        { name: 'ca_concepto'+this.idgrid,          mapping: 'c_ca_concepto',       type:'string'   },
                        { name: 'ca_tipo'+this.idgrid,              mapping: 'c_ca_tipo',           type:'string'   },
                        { name: 'ca_incoterms'+this.idgrid,         mapping: 'c_ca_incoterms',      type:'string'   },
                        { name: 'ca_flete'+this.idgrid,             mapping: 'c_ca_flete',          type:'boolean'  },
                        { name: 'ca_recargolocal'+this.idgrid,      mapping: 'c_ca_recargolocal',   type:'boolean'  },
                        { name: 'ca_recargoorigen'+this.idgrid,     mapping: 'c_ca_recargoorigen',  type:'boolean'  },
                        { name: 'ca_recargootmdta'+this.idgrid,     mapping: 'c_ca_recargootmdta',  type:'boolean'  },
                        { name: 'ca_costo'+this.idgrid,             mapping: 'c_ca_costo',          type:'boolean'  },
                        { name: 'ca_aplicaciones'+this.idgrid,      mapping: 'c_ca_aplicaciones',   type:'string'   },
                        { name: 'ca_idpadre'+this.idgrid,           mapping: 'c_ca_idpadre'                         }
                    ],
                    autoLoad:true,
                    remoteSort: false,
                    proxy: {
                        type: 'ajax',
                        url: '/config/datosDetalleConceptos',
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    }
                }),
                [
                    {text : '',                 dataIndex: 'sel'+this.idgrid,               xtype:  'checkcolumn',  width:30 },
                    {text: "Idconcepto"  ,                dataIndex: 'ca_idconcepto'+this.idgrid,     hidden:false,            sortable: true},
                    {text: "Concepto",          dataIndex: 'ca_concepto'+this.idgrid,                               sortable: true, flex: 3, editor: {xtype: 'textfield',maxLength: 30}},
                    {
                        text: "Tipo",
                        dataIndex: 'ca_tipo'+this.idgrid,
                        sortable: true,
                        flex: 2, 
                        editor: this.comboTipoRecargo,
                        renderer: this.comboBoxRenderer(this.comboTipoRecargo)
                    },                    
                    {
                        text: "Incoterms",
                        dataIndex: 'ca_incoterms'+this.idgrid,
                        sortable: true, 
                        flex: 3,
                        cls: 'grid-maestra',
                        editor:{
                            xtype: 'tagfield',                            
                            store: Ext.create('Ext.data.Store', {
                                fields: ['valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosIncoterms',
                                    reader: {
                                        type: 'json',
                                        rootProperty: 'root'
                                    }
                                },
                                autoLoad: true
                            }),
                            displayField: 'valor',
                            valueField: 'valor',
                            queryMode: 'local',
                            delimiter: '|'
                        }
                    },                    
                    {text: "Flete",             dataIndex: 'ca_flete'+this.idgrid,          xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra'},            
                    {text: "Recargo Local",     dataIndex: 'ca_recargolocal'+this.idgrid,   xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra'},
                    {text: "Recargo Origen",    dataIndex: 'ca_recargoorigen'+this.idgrid,  xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra'},
                    {text: "Recarto Otm",       dataIndex: 'ca_recargootmdta'+this.idgrid,  xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra'},
                    {text: "Costo",             dataIndex: 'ca_costo'+this.idgrid,          xtype:  'checkcolumn',  sortable: true, cls: 'grid-maestra'},
                    {text: "Aplicaciones",      dataIndex: 'ca_aplicaciones'+this.idgrid,                           sortable: true, cls: 'grid-maestra',
                        editor: this.comboAplicaciones,
                        renderer: this.comboBoxRenderer(this.comboAplicaciones)
                    },
                    {text: "Idpadre",             dataIndex: 'ca_idpadre'+this.idgrid,          sortable: true, cls: 'grid-maestra'},
                ]
            )
    
            tb = new Ext.toolbar.Toolbar({
                dock: 'top',                    
                id: 'bar-grid-detalle-'+this.idgrid
            });
            
            if(permisosC.Crear){
                tb.add({
                        text: 'Agregar',
                        iconCls: 'add',
                        handler: function () {
                            var store = this.up('grid').store;
                            var r = Ext.create(store.model);                           
                            r.set('idgrid', this.up('grid').idgrid);
                            r.set('ca_idpadre'+this.up('grid').idgrid, this.up('grid').idpadre);                        
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
                                    url: '/config/guardarDetalleConceptos',
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
                    });
                }
                
                tb.add({
                    text: 'Recargar',
                    iconCls: 'refresh',
                    id:'btn-guardarrecarga',
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
                            title: 'Detalle de Conceptos',
                            fileName: 'Detalle_de_Conceptos.csv'
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
                                    var str=record.get("ca_concepto"+idgrid);
                                    var str1=record.get("ca_incoterms"+idgrid);
                                    
                                    var txt=new RegExp(newValue,"ig");
                                    if(str.search(txt) == -1 && str1.toString().search(txt) == -1)
                                        return false;
                                    else
                                        return true;
                                });
                            }
                        }
                    }
                });
            
            this.addDocked(tb);
        }
    },
    initComponent: function(){
        this.comboTipoRecargo=new Ext.form.ComboBox({
            store: Ext.create('Ext.data.Store', {
                fields: ['id', 'valor'],
                data: [
                    {"id": "Recargo en Origen", "valor": "Recargo en Origen"},
                    {"id": "Recargo Local", "valor": "Recargo Local"},
                    {"id": "Recargo OTM-DTA", "valor": "Recargo OTM-DTA"},
                    {"id": "Recargo", "valor": "Recargo"}
                ]
            }),
            queryMode: 'local',
            displayField: 'valor',
            valueField: 'id'
        });
        
        this.comboAplicaciones=new Ext.form.ComboBox({
            store: Ext.create('Ext.data.Store', {
                fields: ['id', 'valor'],
                data: [
                    {"id": "Contenedores", "valor": "Contenedores"}
                ]
            }),
            queryMode: 'local',
            displayField: 'valor',
            valueField: 'id'
        });
        
        this.comboMaestraConceptos=new Ext.form.ComboBox({
            store: Ext.create('Ext.data.Store', {
                fields: ['id', 'valor'],
                data: [
                    {"id": "Recargo en Origen", "valor": "Recargo en Origen"},
                    {"id": "Recargo Local", "valor": "Recargo Local"},
                    {"id": "Recargo OTM-DTA", "valor": "Recargo OTM-DTA"},
                    {"id": "Recargo", "valor": "Recargo"}
                ]
            }),
            queryMode: 'local',
            displayField: 'valor',
            valueField: 'id'
        });
        
        this.comboBoxRenderer = function(combo) {
            return function(value) {      
              var idx = combo.store.find(combo.valueField, value);
              var rec = combo.store.getAt(idx);
              return (rec === null ? value : rec.get(combo.displayField) );
            }
        }
        this.callParent();
    }
});