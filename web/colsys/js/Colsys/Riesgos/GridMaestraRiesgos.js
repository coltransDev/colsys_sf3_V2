var comboBoxRenderer = null;
winNivel = null;
var htmlN = 
        '<table class="tabla_escala">'+        
        '<tr><td><p class="parrafo" >MUY CRITICO</p><p class="descripcion">REQUIERE DE ATENCI\u00d3N URGENTE</p></td>'+
        '<td style="background-color:#FF0000;"><p class="valor">60 - 100</p></td></tr>'+
        '<tr><td><p class="parrafo" >CRITICO</p><p class="descripcion">REQUIERE DE ATENCI\u00d3N PRIORITARIA</p></td>'+
        '<td style="background-color:#FFCC00;"><p class="valor">25 - 59</p></td></tr>'+
        '<tr><td><p class="parrafo" >TOLERABLE</p><p class="descripcion">DE PREFERIRSE, DAR TRATAMIENTO ADICIONAL</p></td>'+
        '<td style="background-color:#008000;"><p class="valor">6 - 24</p></td></tr>'+
        '<tr><td><p class="parrafo" >ACEPTABLE</p><p class="descripcion">NO REQUIERE TRATAMIENTO ADICIONAL</p></td>'+
        '<td style="background-color:#3366FF;"><p class="valor">1 - 5</p></td></tr>'+
        '</table>';

Ext.define('Colsys.Riesgos.GridMaestraRiesgos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridMaestraRiesgos',    
    frame: true,
    //autoHeight: true,
    //autoScroll: true,
    selModel: {
        selType: 'cellmodel'
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
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
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            if (!record.data.ca_activo)
                return "row_pink"; 
            else if(!record.data.ca_aprobado)
                return "row_orange";
        } 
    },
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
            var me = this;
            this.columns = this.getColumns();
            
            var items = [];
            
            items.push({
                    text: 'Guardar',
                    id: 'button-save-riesgos',                    
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
                                url: '/riesgos/guardarGridMaestraRiesgos',
                                params: {
                                    datos: str
                                },
                                callback: function (options, success, response) {
                                    var res = Ext.util.JSON.decode(response.responseText);
                                    if (success) {
                                        var res = Ext.decode(response.responseText);
                                        ids = res.ids;
                                        if (res.ids && res.idsriesgos) {
                                            for (i = 0; i < ids.length; i++) {
                                                var rec = store.getById(ids[i]);
                                                rec.set(("idriesgo" + idgrid), res.idsriesgos[i]);
                                                rec.commit();
                                                store.reload();                                                
                                            }
                                            Ext.getCmp("tree-id").getStore().reload();
                                            Ext.MessageBox.alert("Mensaje", 'Informaci\u00F3n almacenada correctamente<br>');
                                        }
                                    } else {
                                        Ext.MessageBox.alert("Error", 'Error al guardar<br>' + res.errorInfo);
                                    }
                                }
                            });
                        }
                    }
                },                
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
                    text: 'Exportar CSV',
                    iconCls: 'csv',
                    cfg: {
                        type: 'csv',
                        ext: 'csv'
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
                    text: 'Ver Tabla',
                    id:'btn-riesgos-tabla-'+this.indexId,                                       
                    iconCls: 'table',
                    handler: function () {
                        if(winNivel == null){
                            winNivel = Ext.create('Ext.window.Window',{
                                width: 300,
                                height: 260,
                                id:'winNivel',                    
                                name:'winNivel',                        
                                title: 'NIVEL DE RIESGO',
                                layout: 'anchor',
                                html: htmlN,
                                closeAction: 'hide',
                                listeners: {
                                    afterrender: function(ct, position){                                            
                                        $(".parrafo").css({'font-weight': 'bold','font-size': '10px', 'text-align':'center'});
                                        $(".descripcion").css({'text-align':'center'});
                                        $(".valor").css({'min-width':'80px','font-size': '10px','text-align':'center'});                                
                                        $(".tabla_escala").css({'border-radius':'5px','border':'1px solid #CCCCCC', 'border-collapse': 'collapse'});                                
                                        $(".tabla_escala tr td").css({'border':'1px solid #CCCCCC','line-height':'10px'});
                                    }
                                }
                           })
                        }
                        winNivel.show(); 
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
            var me = this;
            eval("var idriesgo = record.data.idriesgo"+this.idgrid+";")
            //var idriesgo = record.data.ca_idriesgo;
            //var permisos = this.permisos;
            console.log("idriedgo2233",idriesgo);
            console.log("idriesgodesdrecord",record.data.ca_idriesgo);
            console.log("record",record);
                var record = this.store.getAt(index);    
                console.log("recorditemcontextmenu",record);
                var menu = new Ext.menu.Menu({
                    items: [
                        {
                            text: 'Editar',                            
                            iconCls: 'application_form',
                            handler: function() {
                                Ext.getCmp("grid-eve"+idriesgo).ventanaEvento(record);
                            }
                        },
                        {
                            text: 'Eliminar',                            
                            iconCls: 'fa fa-trash-alt',
                            handler: function() {
                                Ext.MessageBox.confirm('Confirmacion', 'Est&aacute; seguro que desea eliminar el riesgo '+record.data.ca_codigo+' ?',function (e) {
                                    if (e == 'yes') {
                                        var box = Ext.MessageBox.wait('Procesando', 'Eliminando Riesgo');
                                        Ext.Ajax.request({
                                            url: '/riesgos/eliminarRiesgo',
                                            params: {
                                                idriesgo: idriesgo
                                            },
                                            success: function (response, opts) {
                                                var res = Ext.util.JSON.decode(response.responseText);

                                                if(res.success){
                                                    Ext.MessageBox.alert("Mensaje", res.mensaje);
                                                }else{
                                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando<br>' + res.errorInfo);   
                                                }
                                                me.getStore().reload();                                                
                                                Ext.getCmp("tree-id").getStore().reload();
                                            },
                                            failure: function (response, opts) {
                                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                box.hide();
                                            }
                                        });
                                    }
                                })                            
                            }
                        }
                    ]
                }).showAt(e.getXY());
            
        },
        beforerender: function(ct, position){
            
            this.idgrid = this.indexId;
            console.log("idgridmaestrariesgos",this.idgrid);
            
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
            comboBoxRenderer = function (combo) {
                return function (value) {
                    var idx = combo.store.find(combo.valueField, value);
                    var rec = combo.store.getAt(idx);
                    return (rec === null ? value : rec.get(combo.displayField));
                };
            };

            Ext.define('modelInforme',{
                    extend: 'Ext.data.Model',
                    id: 'model-grid-riesgos-' + this.idgrid,
                    fields: [                        
                        {name: 'idriesgo' + this.idgrid, type: 'integer', mapping: 'ca_idriesgo'},
                        {name: 'empresa' + this.idgrid, type: 'string', mapping: 'ca_empresa'},
                        {name: 'idproceso' + this.idgrid, type: 'string', mapping: 'ca_idproceso'},
                        {name: 'proceso' + this.idgrid, type: 'string', mapping: 'ca_proceso'},
                        {name: 'codigo' + this.idgrid, type: 'string', mapping: 'ca_codigo'},
                        {name: 'riesgo' + this.idgrid, type: 'string', mapping: 'ca_riesgo'},
                        {name: 'aprobado' + this.idgrid, type: 'boolean', mapping: 'ca_aprobado'},
                        {name: 'activo' + this.idgrid, type: 'boolean', mapping: 'ca_activo'},
                        {name: 'ano' + this.idgrid, type: 'integer', mapping: 'ca_ano'},
                        {name: 'sucursal' + this.idgrid, type: 'string', mapping: 'ca_sucursal'},
                        {name: 'score' + this.idgrid, type: 'float', mapping: 'ca_score'},
                        {name: 'laft' + this.idgrid, type: 'boolean', mapping: 'ca_laft'},
                        {name: 'oea' + this.idgrid, type: 'boolean', mapping: 'ca_oea'},
                        {name: 'calidad' + this.idgrid, type: 'boolean', mapping: 'ca_calidad'},
                        {name: 'legal' + this.idgrid, type: 'boolean', mapping: 'ca_legal'},
                        {name: 'reputacional' + this.idgrid, type: 'boolean', mapping: 'ca_reputacional'},
                        {name: 'operacional' + this.idgrid, type: 'boolean', mapping: 'ca_operacional'},
                        {name: 'contagio' + this.idgrid, type: 'boolean', mapping: 'ca_contagio'},
                        {name: 'usucreado' + this.idgrid, type: 'string', mapping: 'ca_usucreado'},
                        {name: 'fchcreado' + this.idgrid, type: 'date', mapping: 'ca_fchcreado', dateFormat: 'Y-m-d'},
                        {name: 'usuactualizado' + this.idgrid, type: 'string', mapping: 'ca_usuactualizado'},
                        {name: 'fchactualizado' + this.idgrid, type: 'date', mapping: 'ca_fchactualizado', dateFormat: 'Y-m-d'}
                    ]
            });
            this.reconfigure(
               
                store =  Ext.create('Ext.data.Store', {
                    model: 'modelInforme',
                    id: 'store-grid-riesgos-' + this.idgrid,                    
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosGridRiesgos',
                        /*extraParams:{
                            idproceso: this.idproceso,
                            idempresa: this.idempresa
                        },*/
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
                    },{
                        xtype: 'rownumberer'
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
                        header: "Proceso",
                        dataIndex: 'proceso'+this.idgrid, 
                        hideable: false,
                        sortable: true, 
                        width:200, 
//                        flex: 1,
//                        cellWrap: true,
                        renderer: function(value,metadata,record){
                            return Ext.String.htmlDecode(value);                    
                        },
                        editor: Ext.create('Colsys.Widgets.WgProcesos',{
                            id: 'proceso' + this.idgrid
                        }),
                        renderer: comboBoxRenderer(Ext.getCmp('proceso' + this.idgrid))
                    },
                    {
                        header: "C&oacute;d.",
                        dataIndex: 'codigo'+this.idgrid,
                        hideable: false,
                        sortable: true,
                        width:50,
                        editor: {
                            xtype: 'textfield'
                        }
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
                        text : 'Activo',
                        dataIndex : 'activo'+this.idgrid,
                        sortable: true,                        
                        xtype : 'checkcolumn',
                        //cls: 'grid-maestra', 
                        ignoreExport: false,
//                        trueText: 'Si',
//                        falseText: 'No',
                        align : 'center', 
                        width: 100
                    },
                    {
                        text : 'Aprobado',
                        dataIndex : 'aprobado'+this.idgrid,
                        sortable: true,                        
                        xtype : 'checkcolumn',
                        cls: 'grid-maestra', 
                        ignoreExport: false,
                        width:100
                    },
                    {text: 'Valoraci&oacute;n',
                        columns:[{
                            header: "A\u00F1o",
                            dataIndex: 'ano'+this.idgrid,                    
                            sortable: true,
                            align: 'center',
                            renderer: function(value){
                                return value?value:"";
                            }
                        },{
                            header: "Sucursal",
                            dataIndex: 'sucursal'+this.idgrid,                    
                            sortable: true
                        },{
                            header: "Score",
                            dataIndex: 'score'+this.idgrid,                            
                            sortable: true,                            
                            align: 'center',
                            renderer: function(value,meta){                                
                                
                                if(value > 60) {
                                    meta.style = "background-color:#FF0000;";                                    
                                } else if(value >= 25 && value <= 60){
                                    meta.style = "background-color:#FFCC00;";                                    
                                } else if(value > 6 && value < 25){
                                    meta.style = "background-color:#008000;";                                    
                                }else{
                                    meta.style = "background-color:#3366FF;";                                    
                                }
                                return value?"<span style='font-weight: bold;'>"+Ext.util.Format.number(value,'0,0.00')+"</span>":"";
                                    
                                
                            }
                        }]
                    },
                    {text: 'Clasificaci&oacute;n del Riesgo',
                        columns:[
                            {
                                text : 'LA/FT-FPADM',
                                dataIndex : 'laft'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                cls: 'grid-maestra', 
                                ignoreExport: false,
                                width:100 
                            },
                            {
                                text : 'OEA',
                                dataIndex : 'oea'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                cls: 'grid-maestra', 
                                ignoreExport: false,
                                width:100
                            },
                            {
                                text : 'Calidad',
                                dataIndex : 'calidad'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                cls: 'grid-maestra', 
                                ignoreExport: false,
                                width:100
                            },
                            {
                                text : 'Legal',
                                dataIndex : 'legal'+this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                cls: 'grid-maestra', 
                                ignoreExport: false,
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
                                cls: 'grid-maestra', 
                                ignoreExport: false,
                                width:100 
                            },
                            {
                                text : 'De contagio',
                                dataIndex : 'contagio' + this.idgrid,
                                sortable: true,                        
                                xtype : 'checkcolumn',
                                cls: 'grid-maestra', 
                                ignoreExport: false,
                                width:100 
                            },
                        ]
                    },
                    {
                        header: "Usu. Creado",
                        dataIndex: 'usucreado' + this.idgrid,
                        hideable: true,
                        sortable: true,                        
                        flex: 1,
                        cellWrap: true,
                        hidden: true
                    },
                    {
                        header: "Fch. Creado",
                        dataIndex: 'fchcreado' + this.idgrid,
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
                    },
                    ,
                    {
                        header: "Usu. Actualizado",
                        dataIndex: 'usuactualizado' + this.idgrid,
                        hideable: true,
                        sortable: true,                        
                        flex: 1,
                        cellWrap: true,
                        hidden: true
                    },
                    {
                        header: "Fch. Actualizado",
                        dataIndex: 'fchactualizado' + this.idgrid,
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
                    }
                ]
            );                        
            
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