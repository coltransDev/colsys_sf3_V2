var comboCliente = null;
var comboBoxRenderer = null;
winEvento = null;

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

Ext.define('Colsys.Riesgos.GridEventos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridEventos',    
    //autoHeight: true,
    //autoScroll: true,
    frame: true,
    features: [{
        id: 'feature-proceso',
        ftype: 'groupingsummary',
        groupHeaderTpl: ['{name} ({[values.children.length]})'],
        hideGroupedHeader: true,
        startCollapsed: true
    },{
        ftype: 'summary',
        dock: 'bottom'
    }],
    listeners: {
        activate: function(ct, position){
           if(this.load==false || this.load=="undefined" || !this.load){                
                this.store.proxy.extraParams = {
                    idriesgo: this.idriesgo
                }          
                this.load=true;
            }
        },
        afterrender: function(ct, position){
            this.columns = this.getColumns();
            var idriesgo = this.idriesgo;
            var permisos = this.permisos;            
            var items = [];
            
            if(idriesgo){
                items.push({
                    text: 'Nuevo Evento',
                    iconCls: 'add',
                    disabled: !permisos.eventos.crear,
                    handler : function(){                
                        this.up('grid').ventanaEvento(null);            
                    }
                })
            }else{                
                items.push({
                    text: 'Expandir',                    
                    iconCls: 'fa fa-arrows-alt-v green',
                    disabled: !permisos,                    
                    handler : function(t){
                        var me = this;
                        this.up('grid').onToggle(me);
                    }
                });
            }
            items.push(
                {
                    text: 'Recargar',
                    iconCls: 'refresh',
                    handler: function () {
                        this.up("grid").getStore().reload();
                    }
                },
                {
                    xtype: 'button',
                    text: 'Exportar XLXS',
                    iconCls: 'csv',
                    cfg: {
                        type: 'excel07',
                        ext: 'xlsx'
                    },
                    handler: function(){
                        var grid = this.up("grid");
                        var cfg = Ext.merge({
                            title: 'Eventos',
                            fileName: 'Eventos' + '.' + (this.cfg.ext || this.cfg.type)
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
                }
            );
    
            tbar = [{
                xtype: 'toolbar',
                dock: 'top',
                id: 'bar-eve-'+ this.indexId,                
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
                        disabled: !permisos.valoracion.editar,
                        iconCls: 'application_form_edit',
                        handler: function() {
                            Ext.getCmp("grid-eve"+idriesgo).ventanaEvento(record);
                        }
                    }
                ]
            }).showAt(e.getXY());
            
        },
        beforerender: function(ct, position){
            this.idgrid = this.indexId;
            
            comboCliente = Ext.create('Colsys.Widgets.WgClientes', {
                displayField: 'compania',
                valueField: 'idcliente',
                listeners:{
                    select: function (a, record, idx){
                        var selected = this.up('grid').getSelectionModel().getSelection()[0];
                        var row = this.up('grid').store.indexOf(selected);
                        var store = this.up('grid').getStore();                        
                        store.data.items[row].set('idcliente' + this.idgrid, record[0].data.ca_idcliente);
                        store.data.items[row].set('vendedor' + this.idgrid, record[0].data.ca_vendedor);
                    }
                }
            });
            comboSucursal = Ext.create('Colsys.Widgets.WgSucursalesEmpresa', {
                displayField: 'sucursal',
                valueField: 'id',
                empresa: 2,
                listeners:{
                    select: function (a, record, idx){
                        var selected = this.up('grid').getSelectionModel().getSelection()[0];
                        var row = this.up('grid').store.indexOf(selected);
                        var store = this.up('grid').getStore();                        
                        store.data.items[row].set('idcliente' + this.idgrid, record[0].data.ca_idcliente);
                        store.data.items[row].set('vendedor' + this.idgrid, record[0].data.ca_vendedor);

                    }
                }
            });
            
            comboBoxRenderer = function (combo) {
                return function (value) {
                    var idx = combo.store.find(combo.valueField, value);
                    var rec = combo.store.getAt(idx);
                    return (rec === null ? value : rec.get(combo.displayField));
                };
            };
            Ext.define('modelStatus',{
                    extend: 'Ext.data.Model',
                    id: 'modelStatus',
                    fields: [
                       {name: 'empresa'+this.idgrid,    type: 'string',    mapping: 'empresa'},
                       {name: 'proceso'+this.idgrid,    type: 'string',    mapping: 'proceso'},
                       {name: 'codigo'+this.idgrid,    type: 'string',    mapping: 'codigo'},
                       {name: 'riesgo'+this.idgrid,    type: 'string',    mapping: 'riesgo'},
                       {name: 'idevento'+this.idgrid,     type: 'integer',    mapping: 'idevento'},
                       {name: 'idcausa'+this.idgrid,      type: 'integer',    mapping: 'idcausa'},
                       {name: 'fchevento'+this.idgrid,    type: 'date',       mapping: 'fchevento',    dateFormat: 'Y-m-d'},
                       {name: 'descripcion'+this.idgrid,  type: 'string',     mapping: 'descripcion'},
                       {name: 'causa'+this.idgrid,        type: 'string',     mapping: 'causa'},
                       {name: 'tipodoc'+this.idgrid,      type: 'string',     mapping: 'tipodoc'},
                       {name: 'pa'+this.idgrid,           type: 'string',     mapping: 'pa'},
                       {name: 'documento'+this.idgrid,    type: 'string',     mapping: 'documento'},
                       {name: 'idcliente'+this.idgrid,    type: 'integer',    mapping: 'idcliente'},
                       {name: 'cliente'+this.idgrid,      type: 'string',     mapping: 'cliente'},
                       {name: 'idsucursal'+this.idgrid,   type: 'string',     mapping: 'idsucursal'},
                       {name: 'sucursal'+this.idgrid,     type: 'string',     mapping: 'sucursal'},
                       {name: 'perdida_ope'+this.idgrid,  mapping: 'perdida_ope'},
                       {name: 'perdida_leg'+this.idgrid,  type: 'float',      mapping: 'perdida_leg'},
                       {name: 'perdida_eco'+this.idgrid,  type: 'float',      mapping: 'perdida_eco'},
                       {name: 'perdida_com'+this.idgrid,  type: 'float',      mapping: 'perdida_com'},
                       {name: 'fchcreado'+this.idgrid,    type: 'date',      mapping: 'fchcreado',  dateFormat: 'Y-m-d H:i:s'},
                       {name: 'usucreado'+this.idgrid,    type: 'string',      mapping: 'usucreado'}
                    ]
            });
            this.reconfigure(
               
                store =  Ext.create('Ext.data.Store', {
                    model: modelStatus,
                    id: 'storeGrid',                    
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosGridEventos',
                        extraParams:{
                            idriesgo: this.idriesgo,
                            idproceso: this.idproceso,
                            idempresa: this.idempresa
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total'
                        }
                    },        
                    sorters: [{
                        property: 'fecha',
                        direction: 'ASC'
                    }],
                    autoLoad: true
                }),
                [
                    {
                        xtype: 'hidden',
                        dataIndex: 'idevento' + this.idgrid
                    },
                    {
                        header: "Empresa",
                        dataIndex: 'empresa' + this.idgrid,
                        width: 150,
                        hidden: this.idempresa?true:(this.idproceso?true:(this.idriesgo?true:false))
                    },
                    {
                        header: "Proceso",
                        dataIndex: 'proceso' + this.idgrid,
                        width: 150,
                        hidden: this.idempresa?false:(this.idproceso?true:(this.idriesgo?true:false))
                    },
                    {
                        header: "C&oacute;digo",
                        dataIndex: 'codigo' + this.idgrid,
                        hidden: this.idempresa?false:(this.idproceso?false:(this.idriesgo?true:false))
                    },
                    {
                        header: "Riesgo",
                        dataIndex: 'riesgo' + this.idgrid,
                        width: 200,
                        hidden: this.idempresa?false:(this.idproceso?false:(this.idriesgo?true:false))
                    },                                     
                    {
                        header: "Fch. Evento",
                        dataIndex: 'fchevento' + this.idgrid,
                        sortable: true,                                                 
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
                                return y + "-" + m + "-" + d;
                            }
                        }
                    },
                    {
                        header: "Evento",
                        dataIndex: 'descripcion' + this.idgrid,                    
                        hideable: false,
                        sortable: true,                                                
                        cellWrap: true,
                        width: 250,
                        renderer: function(value,metadata,record){
                            value = Ext.String.htmlEncode(value);
                            metadata.tdAttr = 'data-qtip="Creado por: '+ record.data.usucreado+' '+record.data.fchcreado + '"';
                            return value;                            
                        }
                    },
                    {
                        header: "Causa",
                        dataIndex: 'causa' + this.idgrid,
                        width: 150,
                        hideable: true,
                        sortable: true,                                                
                        cellWrap: true
                    },
                    {
                        header: "Tipo Documento",
                        dataIndex: 'tipodoc' + this.idgrid,                        
                        hideable: true,
                        sortable: true,                                                
                        cellWrap: true,
                        hidden: true
                    },
                    {
                        header: "PA",
                        dataIndex: 'pa' + this.idgrid,                        
                        hideable: true,
                        sortable: true                        
                    },
                    {
                        header: "Documento",
                        dataIndex: 'documento' + this.idgrid,
                        width: 150,
                        hideable: true,
                        sortable: true,                        
                        renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                            var tipodoc = record.data.tipodoc;
                            return value+"<br><span style='color:gray'>"+tipodoc+"</span>";
                        }
                    },
                    {
                        header: "Cliente",
                        dataIndex: 'cliente' + this.idgrid,
                        width: 200,
                        hideable: false,
                        sortable: true                                                
                    },
                    {
                        header: "Sucursal",
                        dataIndex: 'sucursal' + this.idgrid,
                        hideable: true,
                        sortable: true                        
                    },                    
                    {
                        header: 'P\u00E9rdida Operativa',
                        dataIndex: 'perdida_ope' + this.idgrid,                        
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
                        dataIndex: 'perdida_leg' + this.idgrid,                        
                        align: 'right',
                        renderer:Ext.util.Format.usMoney,
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return '<span style="font-size: 11px; font-weight:bold">'+Ext.util.Format.usMoney(value)+'</span>';
                        }
                    },
                    {
                        header: 'P\u00E9rdida Econ\u00F3mica',
                        dataIndex: 'perdida_eco' + this.idgrid,                        
                        align: 'right',
                        renderer:Ext.util.Format.usMoney,
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return '<span style="font-size: 11px; font-weight:bold">'+Ext.util.Format.usMoney(value)+'</span>';
                        }
                    },
                    {
                        header: 'P\u00E9rdida Comercial',
                        dataIndex: 'perdida_com' + this.idgrid,                        
                        align: 'right',
                        renderer:Ext.util.Format.usMoney,
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return '<span style="font-size: 11px; font-weight:bold">'+Ext.util.Format.usMoney(value)+'</span>';
                        }
                    },
                    {
                        header: "Usu. Creado",
                        dataIndex: 'usucreado' + this.idgrid,
                        hideable: true,
                        sortable: true,                                                
                        cellWrap: true,
                        hidden: true
                    },
                    {
                        header: "Fch. Creado",
                        dataIndex: 'fchcreado' + this.idgrid,
                        sortable: true,                                                 
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
                        
            /*if(this.idriesgo == 0){                
                this.store.setGroupField('proceso');
            }*/
        },
        onRender: function(ct, position){
            Colsys.Riesgos.GridEventos.superclass.onRender.call(this, ct, position);
            
        }
    },
    ventanaEvento : function(record){
        
        var idevento = record?record.data.idevento:'';
        var title = record?"Editar Evento":"Nuevo Evento";
        
        if (winEvento == null) {
            winEvento = Ext.create('Ext.window.Window', {
                title: title,
                width: 700,
                height: 510,
                id:'winEvento',                    
                name:'winEvento',
                maximizable: true,
                layout: 'anchor',
                closeAction: 'destroy',
                items: [ // Let's put an empty grid in just to illustrate fit layout                        
                    Ext.create('Colsys.Riesgos.FormEvento', {
                        id: 'form-evento' + this.idriesgo,
                        name: 'form-evento'+ this.idriesgo,
                        border: false,
                        layout: 'anchor',
                        anchor: '100% 100%',
                        idriesgo: this.idriesgo,
                        idevento: idevento
                    })                       
                ],
                listeners: {
                    close: function (win, eOpts) {
                        winEvento = null;                            
                    },
                    show: function(){
                        winEvento.superclass.show.apply(this, arguments);
                    }
                }
            });
        }else{
            alert("Ya existe una ventana de evento abierta")
        }    
            
        if (record != null) {
            Ext.getCmp("form-evento" + this.idriesgo).cargar(this.idriesgo, idevento);
        } else {
            Ext.getCmp("form-evento" + this.idriesgo).getForm().reset();
        }
        winEvento.show();
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