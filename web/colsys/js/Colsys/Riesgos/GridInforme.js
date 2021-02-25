var comboCliente = null;
var comboBoxRenderer = null;
winEvento = null;

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

Ext.define('Colsys.Riesgos.GridInforme', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridInforme',    
    autoHeight: true,
    autoScroll: true,
    //frame: true,
    /*features: [{
        id: 'feature-proceso',
        ftype: 'groupingsummary',
        groupHeaderTpl: ['{name} ({[values.children.length]})'],
        hideGroupedHeader: true,
        startCollapsed: true
    },{
        ftype: 'summary',
        dock: 'bottom'
    }],*/
    listeners: {
        activate: function(ct, position){
           if(this.load==false || this.load=="undefined" || !this.load){                
                this.store.proxy.extraParams = {
                    idproceso: this.idproceso,
                    idempresa: this.idempresa
                }          
                this.load=true;
            }
        },
        afterrender: function(ct, position){
            this.columns = this.getColumns();
            var idriesgo = this.idriesgo;
            var permisos = this.permisos;            
            var items = [];
            
            items.push(
                {
                    text: 'Recargar',
                    iconCls: 'refresh',
                    id: 'button-recargar-' + this.indexId,
                    handler: function () {
                        this.up("grid").getStore().reload();
                    }
                },
                {
                    xtype: 'button',
                    id: 'button-export-' + this.indexId,
                    text: 'Exportar XLXS',
                    iconCls: 'csv',
                    cfg: {
                        type: 'excel07',
                        ext: 'xlsx'
                    },
                    handler: function(){
                        var grid = this.up("grid");
                        var cfg = Ext.merge({
                            title: 'Riesgos',
                            fileName: 'Riesgos' + '.' + (this.cfg.ext || this.cfg.type)
                        }, this.cfg);

                        var myMask = new Ext.LoadMask({
                            msg    : 'Generando archivo, por favor espere...',
                            target : grid
                        });
                        myMask.show(); 
                        
                        Ext.syncRequire(['Ext.grid.plugin.Exporter','Ext.view.grid.ExporterController'], function() {
                            
                            myMask.hide();
                            grid.addPlugin({
                                ptype: 'gridexporter'
                            });
                            grid.saveDocumentAs(cfg);                            
                        }, {prop: 'value'});
                    }
                },
                {
                    xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                    width: 300,                    
                    id:'ca_clasificacion-grid-'+this.indexId,                    
                    store: Ext.create('Ext.data.Store', {
                        fields: [{type: 'string', name: 'name'},{type: 'integer',name: 'id'}],
                        proxy: {
                            type: 'ajax',
                            url: '/widgets5/datosParametros',
                            extraParams:{
                                caso_uso: 'CU286'
                            },
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        autoLoad: true
                    }),
                    listeners:{
                        change: function (me, newValue, oldValue, eOpts){
                            me.nextSibling('button').enable();
                        }
                    }
                },
                {
                    xtype: 'button',
                    id:'button-grid-'+this.indexId,
                    hideLabel: false,
                    text: 'Clasificar por',
                    iconCls: 'search',
                    width: 120,
                    tooltip: 'Filtrar',
                    disabled: true,
                    allowBlank: false,                
                    handler: function(me, e) {
                        
                        idclasificacion = JSON.stringify(me.previousSibling('combobox').getValue());
//                        idclasificacion = [];
//                        idclasificacion = JSON.stringify(Ext.getCmp("ca_clasificacion-"+indexId).getValue());
//
//                        var src = "/riesgos/pdfProceso/idproceso/"+idproceso+"/idclasificacion/"+idclasificacion;
//                        var myFrame = Ext.ComponentQuery.query('#iframe-pdf-' + indexId)[0];
//                        myFrame.load(src);

    //                        console.log("idclasificacion", idclasificacion);
    //                        console.log("gridinforme", this.up("panel").down("grid"));
    ////                      
    //                        var gridInforme = this.up("panel").down("panel").down("panel");
    //                        var src = "/riesgos/pdfProceso/idproceso/"+idproceso+"/idclasificacion/"+idclasificacion;
    //                        var myFrame = Ext.ComponentQuery.query('#iframe-pdf-' + gridInforme.indexId)[0];
    //                        myFrame.load(src);
    //                        
    //                        var graficaInforme = this.up("panel").down("chart");                        
    //                        var store =  graficaInforme.getStore();                        
    //                        if(store.getProxy().extraParams){
    //                            store.getProxy().extraParams.idclasificacion =  idclasificacion;
    //                            store.load();
    //                        }
    //                        
                            console.log(this.up("grid").getStore());
                            storeGrid = this.up("grid").getStore();
                            storeGrid.getProxy().extraParams.idclasificacion =  idclasificacion;
                            storeGrid.load();
                    } 
                }
            );
    
            tbar = [{
                xtype: 'toolbar',
                dock: 'top',
                id: 'bar-' + this.indexId,
                items:items
            }];

            this.addDocked(tbar);
            
        },
        beforeitemcontextmenu: function(view, record, item, index, e){
            e.stopEvent();
            var idriesgo = this.idriesgo;
            var permisos = this.permisos;
            
                var record = this.store.getAt(index);                        
                var menu = new Ext.menu.Menu({
                    items: [
                        {
                            text: 'Editar',
                            //disabled: !permisos,
                            iconCls: 'application_form',
                            handler: function() {
                                Ext.getCmp("grid-eve"+idriesgo).ventanaEvento(record);
                            }
                        }
                    ]
                }).showAt(e.getXY());
            
        },
        beforerender: function(ct, position){
            
            this.idgrid = this.indexId;
            
//            comboCliente = Ext.create('Colsys.Widgets.WgClientes', {
//                displayField: 'compania',
//                valueField: 'idcliente',
//                listeners:{
//                    select: function (a, record, idx){
//                        var selected = this.up('grid').getSelectionModel().getSelection()[0];
//                        var row = this.up('grid').store.indexOf(selected);
//                        var store = this.up('grid').getStore();                        
//                        store.data.items[row].set('idcliente' + this.up('grid').idriesgo, record[0].data.ca_idcliente);
//                        store.data.items[row].set('vendedor' + this.up('grid').idriesgo, record[0].data.ca_vendedor);
//                    }
//                }
//            });
//            comboSucursal = Ext.create('Colsys.Widgets.WgSucursalesEmpresa', {
//                displayField: 'sucursal',
//                valueField: 'id',
//                empresa: 2,
//                listeners:{
//                    select: function (a, record, idx){
//                        var selected = this.up('grid').getSelectionModel().getSelection()[0];
//                        var row = this.up('grid').store.indexOf(selected);
//                        var store = this.up('grid').getStore();                        
//                        store.data.items[row].set('idcliente' + this.up('grid').idmaster, record[0].data.ca_idcliente);
//                        store.data.items[row].set('vendedor' + this.up('grid').idmaster, record[0].data.ca_vendedor);
//
//                    }
//                }
//            });
//            
//            comboBoxRenderer = function (combo) {
//                return function (value) {
//                    var idx = combo.store.find(combo.valueField, value);
//                    var rec = combo.store.getAt(idx);
//                    return (rec === null ? value : rec.get(combo.displayField));
//                };
//            };

            Ext.define('modelInforme',{
                    extend: 'Ext.data.Model',
                    id: 'model-grid-informe' + this.idgrid,
                    fields: [                        
                        {name: 'idriesgo' + this.idgrid, type: 'integer', mapping: 'ca_idriesgo'},
                        {name: 'empresa' + this.idgrid, type: 'string', mapping: 'ca_empresa'},
                        {name: 'sucursal' + this.idgrid, type: 'string', mapping: 'ca_sucursal'},
                        {name: 'proceso' + this.idgrid, type: 'string', mapping: 'ca_proceso'},
                        {name: 'codigo' + this.idgrid, type: 'string', mapping: 'ca_codigo'},
                        {name: 'riesgo' + this.idgrid, type: 'string', mapping: 'ca_riesgo'},
                        {name: 'causas' + this.idgrid, type: 'string', mapping: 'ca_causas'},
                        {name: 'ap' + this.idgrid, type: 'string', mapping: 'ca_ap'},
                        {name: 'documento' + this.idgrid, type: 'string', mapping: 'ca_documento'},
                        {name: 'compania' + this.idgrid, type: 'string', mapping: 'ca_compania'},
                        {name: 'perdida_ope' + this.idgrid, mapping: 'ca_perdida_ope'},
                        {name: 'perdida_leg' + this.idgrid, type: 'float', mapping: 'ca_perdida_leg'},
                        {name: 'perdida_eco' + this.idgrid, type: 'float', mapping: 'ca_perdida_eco'},
                        {name: 'perdida_com' + this.idgrid, type: 'float', mapping: 'ca_perdida_com'},
                        {name: 'laft' + this.idgrid, type: 'boolean', mapping: 'ca_laft'},
                        {name: 'oea' + this.idgrid, type: 'boolean', mapping: 'ca_oea'},
                        {name: 'calidad' + this.idgrid, type: 'boolean', mapping: 'ca_calidad'},
                        {name: 'legal' + this.idgrid, type: 'boolean', mapping: 'ca_legal'},
                        {name: 'reputacional' + this.idgrid, type: 'boolean', mapping: 'ca_reputacional'},
                        {name: 'operacional' + this.idgrid, type: 'boolean', mapping: 'ca_operacional'},
                        {name: 'contagio' + this.idgrid, type: 'boolean', mapping: 'ca_contagio'},
                        {name: 'activo' + this.idgrid, type: 'boolean', mapping: 'ca_activo'}                  
                    ]
            });
            this.reconfigure(
               
                store =  Ext.create('Ext.data.Store', {
                    model: 'modelInforme',
                    id: 'store-grid-informe-' + this.idgrid,                    
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosGridInforme',
                        extraParams:{
                            idproceso: this.idproceso,
                            idempresa: this.idempresa
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total'
                        }
                    },        
                    /*sorters: [{
                        property: 'fecha',
                        direction: 'ASC'
                    }],*/
                    autoLoad: true
                }),
                [
                    {
                        xtype: 'hidden',
                        dataIndex: 'idriesgo'+this.idgrid
                    }, 
                    {
                        header: "Empresa",
                        dataIndex: 'empresa'+this.idgrid, 
                        hideable: false,
                        sortable: true,                        
//                        flex: 1,
//                        cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        }
                    },
                    {
                        header: "Sucursal",
                        dataIndex: 'sucursal'+this.idgrid, 
                        hideable: false,
                        sortable: true,                        
//                        flex: 1,
//                        cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        }
                    },
                    {
                        header: "Proceso",
                        dataIndex: 'proceso'+this.idgrid, 
                        hideable: false,
                        sortable: true, 
                        width:200, 
//                        flex: 1,
//                        cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        }
                    },
                    {
                        header: "C&oacute;d.",
                        dataIndex: 'codigo'+this.idgrid,
                        hideable: false,
                        sortable: true,
                        width:50,
                    }, 
                    {
                        header: "Riesgo",
                        dataIndex: 'riesgo'+this.idgrid, 
                        hideable: false,
                        sortable: true,
                        width:250, 
//                        flex: 1,
//                        cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        }
                    },
                    {
                        header: "Causas",
                        dataIndex: 'causas'+this.idgrid,                    
                        hideable: false,
                        sortable: true, 
                        width:350, 
//                        flex: 2,
//                        cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        }
                    },
                    {
                        header: "AP",
                        dataIndex: 'ap'+this.idgrid,                    
                        hideable: false,
                        sortable: true,                        
//                        flex: 2,
//                        cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        }
                    },
                    {
                        header: "Documento",
                        dataIndex: 'documento'+this.idgrid,                    
                        hideable: false,
                        sortable: true,                        
//                        flex: 1,
                        //cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        }
                    },
                    {
                        header: "Cliente",
                        dataIndex: 'compania'+this.idgrid,                    
                        hideable: false,
                        sortable: true,
                        width:200, 
//                        flex: 1,
                    },
                    {
                        header: 'P\u00E9rdida Operativa',
                        dataIndex: 'perdida_ope'+this.idgrid,                        
//                        flex: 1,
                        align: 'right',                        
                        summaryType: function(records){                            
                            var startDate = new Date("1/1/1970 00:00:00");
                            Ext.Array.forEach(records, function (record){                                
                                if (record.data.perdida_ope){
                                    tmp = new Date("1/1/1970 " + record.data.perdida_ope);
                                    startDate = new Date(startDate.getTime() + (tmp.getHours()*1000*60*60)+ (tmp.getMinutes()*1000*60)+(tmp.getSeconds()*1000));                                    
                                }
                            });
                            
                            var hour_adic = 0;
                            if(startDate.getDate()>1){
                                hour_adic = (startDate.getDate()-1)*24;
                            }
                            
                            var h = addZero(startDate.getHours()+hour_adic);
                            var m = addZero(startDate.getMinutes());
                            var s = addZero(startDate.getSeconds());
                            
                            return '<span style="font-size: 11px; font-weight:bold">' + h + ":" + m + ":" + s + '</span>';
                        }
                    },
                    {
                        header: 'P\u00E9rdida Legal',
                        dataIndex: 'perdida_leg'+this.idgrid,                        
//                        flex: 1,
                        align: 'right',
                        renderer:Ext.util.Format.usMoney,
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return '<span style="font-size: 11px; font-weight:bold">'+Ext.util.Format.usMoney(value)+'</span>';
                        }
                    },
                    {
                        header: 'P\u00E9rdida Econ\u00F3mica',
                        dataIndex: 'perdida_eco'+this.idgrid,                        
//                        flex: 1,
                        align: 'right',
                        renderer:Ext.util.Format.usMoney,
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return '<span style="font-size: 11px; font-weight:bold">'+Ext.util.Format.usMoney(value)+'</span>';
                        }
                    },
                    {
                        header: 'P\u00E9rdida Comercial',
                        dataIndex: 'perdida_com'+this.idgrid,                        
//                        flex: 1,
                        align: 'right',
                        renderer:Ext.util.Format.usMoney,
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return '<span style="font-size: 11px; font-weight:bold">'+Ext.util.Format.usMoney(value)+'</span>';
                        }
                    }, 
                    {text: 'Clasificaci&oacute;n del Riesgo',
                        columns:[
                            {
                                text : 'LA/FT-FPADM',
                                dataIndex : 'laft'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                width:100 
                            },
                            {
                                text : 'OEA',
                                dataIndex : 'oea'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                width:100
                            },
                            {
                                text : 'Calidad',
                                dataIndex : 'calidad'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                width:100
                            },
                            {
                                text : 'Legal',
                                dataIndex : 'legal'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                width:100 
                            },
                            {
                                text : 'Reputacional',
                                dataIndex : 'reputacional'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                width:100
                            },
                            {
                                text : 'Operacional',
                                dataIndex : 'operacional'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                width:100 
                            },
                            {
                                text : 'De contagio',
                                dataIndex : 'contagio'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                width:100 
                            }
                        ]
                    },
                    {
                        text : 'Activo',
                        dataIndex : 'activo'+this.idgrid,
                        sortable: true,                        
                        xtype : 'checkcolumn',
                        width:100
                    }/*,
                    {
                        header: "Usu. Creado",
                        dataIndex: 'usucreado'+this.idriesgo,                    
                        hideable: true,
                        sortable: true,                        
                        flex: 1,
                        cellWrap: true,
                        hidden: true
                    },
                    {
                        header: "Fch. Creado",
                        dataIndex: 'fchcreado'+this.idriesgo,                    
                        sortable: true,                         
                        flex: 1,
                        hidden: true,
                        renderer: function (a, b, c, d){
                            if (a) {
                                var formattedDate = new Date(a);
                                var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                var d = formattedDate.getDate();                                
                                if (d < 10) {
                                    d = "0" + d;
                        }
                                var m = formattedDate.getMonth();
                                m += 1;  
                                if (m < 10) {
                                    m = "0" + m;
                                }
                                var y = formattedDate.getFullYear();
                                return y + "-" + m + "-" + d +' '+ formattedDate.getHours() +':' +formattedDate.getMinutes() +':' +formattedDate.getSeconds();
                            }
                        }
                    }*/
                ]
            );
                        
            /*if(this.idriesgo == 0){                
                this.store.setGroupField('proceso');
            }*/
        },
        onRender: function(ct, position){
            Colsys.Riesgos.GridInforme.superclass.onRender.call(this, ct, position);
            
        }
    },
    onToggle: function(t,eOpts){
        
        var tipo = t.text;        
        switch(tipo){
            case "Expandir":                
                t.setText("Contraer");                
                t.up('grid').getView().getFeature('feature-proceso').expandAll();
                break;
            case "Contraer":                
                t.setText("Expandir");                
                t.up('grid').getView().getFeature('feature-proceso').collapseAll();
                break;
        }
    }
});