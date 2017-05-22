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
    autoHeight: true,
    autoScroll: true,
    frame: true,
    title: 'Eventos Riesgo',    
    features: [{
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
            
            if(this.permisos === true){
                tbar = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    id: 'bar-eve-'+idriesgo,                
                    items: [{
                        text: 'Nuevo Evento',
                        iconCls: 'add',
                        handler : function(){                
                            this.up('grid').ventanaEvento(null);            
                        }
                    },
                    {
                        text: 'Recargar',
                        iconCls: 'refresh',
                        handler: function () {
                            this.up("grid").getStore().reload();
                        }
                    },
                    {
                        xtype: 'exporterbutton',
                        text: 'XLS',
                        iconCls: 'csv',
                        format:'excel'
                    }]
                }];
            
                this.addDocked(tbar);
            }
        },
        beforeitemcontextmenu: function(view, record, item, index, e){
            e.stopEvent();
            var idriesgo = this.idriesgo;
            var permisos = this.permisos;
            
            if (permisos === true){
                var record = this.store.getAt(index);                        
                var menu = new Ext.menu.Menu({
                    items: [
                        {
                            text: 'Editar',
                            iconCls: 'application_form',
                            handler: function() {
                                Ext.getCmp("grid-eve"+idriesgo).ventanaEvento(record);
                            }
                        }
                    ]
                }).showAt(e.getXY());
            }
        },
        beforerender: function(ct, position){
            comboCliente = Ext.create('Colsys.Widgets.WgClientes', {
                displayField: 'compania',
                valueField: 'idcliente',
                listeners:{
                    select: function (a, record, idx){
                        var selected = this.up('grid').getSelectionModel().getSelection()[0];
                        var row = this.up('grid').store.indexOf(selected);
                        var store = this.up('grid').getStore();                        
                        store.data.items[row].set('idcliente' + this.up('grid').idriesgo, record[0].data.ca_idcliente);
                        store.data.items[row].set('vendedor' + this.up('grid').idriesgo, record[0].data.ca_vendedor);
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
                        store.data.items[row].set('idcliente' + this.up('grid').idmaster, record[0].data.ca_idcliente);
                        store.data.items[row].set('vendedor' + this.up('grid').idmaster, record[0].data.ca_vendedor);

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
                       {name: 'idevento'+this.idriesgo,     type: 'integer',    mapping: 'idevento'},
                       {name: 'idcausa'+this.idriesgo,      type: 'integer',    mapping: 'idcausa'},
                       {name: 'fchevento'+this.idriesgo,    type: 'date',       mapping: 'fchevento',    dateFormat: 'Y-m-d'},
                       {name: 'descripcion'+this.idriesgo,  type: 'string',     mapping: 'descripcion'},
                       {name: 'causa'+this.idriesgo,        type: 'string',     mapping: 'causa'},
                       {name: 'tipodoc'+this.idriesgo,      type: 'string',     mapping: 'tipodoc'},
                       {name: 'pa'+this.idriesgo,           type: 'string',     mapping: 'pa'},
                       {name: 'documento'+this.idriesgo,    type: 'string',     mapping: 'documento'},
                       {name: 'idcliente'+this.idriesgo,    type: 'integer',    mapping: 'idcliente'},
                       {name: 'cliente'+this.idriesgo,      type: 'string',     mapping: 'cliente'},
                       {name: 'idsucursal'+this.idriesgo,   type: 'string',     mapping: 'idsucursal'},
                       {name: 'sucursal'+this.idriesgo,     type: 'string',     mapping: 'sucursal'},
                       {name: 'perdida_tot'+this.idriesgo,  type: 'float',      mapping: 'perdida_tot'},
                       {name: 'perdida_ope'+this.idriesgo,  mapping: 'perdida_ope'},
                       {name: 'perdida_leg'+this.idriesgo,  type: 'float',      mapping: 'perdida_leg'},
                       {name: 'perdida_eco'+this.idriesgo,  type: 'float',      mapping: 'perdida_eco'},
                       {name: 'perdida_com'+this.idriesgo,  type: 'float',      mapping: 'perdida_com'}
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
                            idriesgo: this.idriesgo
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
                        dataIndex: 'idevento'+this.idriesgo
                    },                
                    {
                        header: "Fch. Evento",
                        dataIndex: 'fchevento'+this.idriesgo,
                        sortable: true,                         
                        flex: 1,
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
                        dataIndex: 'descripcion'+this.idriesgo,                    
                        hideable: false,
                        sortable: true,                        
                        flex: 3,
                        cellWrap: true
                    },
                    {
                        header: "Causa",
                        dataIndex: 'causa'+this.idriesgo,                    
                        hideable: true,
                        sortable: true,                        
                        flex: 1,
                        cellWrap: true
                    },
                    {
                        header: "PA",
                        dataIndex: 'pa'+this.idriesgo,                    
                        flex: 1,
                        hideable: true,
                        sortable: true,
                        flex: 1
                    },
                    {
                        header: "Documento",
                        dataIndex: 'documento'+this.idriesgo,                    
                        hideable: true,
                        sortable: true,
                        flex: 1,
                        renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                            var tipodoc = record.data.tipodoc;
                            return value+"<br><span style='color:gray'>"+tipodoc+"</span>";
                        }
                    },
                    {
                        header: "Cliente",
                        dataIndex: 'cliente' + this.idriesgo,
                        hideable: false,
                        sortable: true,                         
                        flex: 2
                    },
                    {
                        header: "Sucursal",
                        dataIndex: 'sucursal' + this.idriesgo,
                        hideable: true,
                        sortable: true,                         
                        flex: 1
                    },                    
                    {
                        header: 'P\u00E9rd. Operativa',
                        dataIndex: 'perdida_ope'+this.idriesgo,                        
                        flex: 1,
                        align: 'right',                        
                        summaryType: function(records){                            
                            var startDate = new Date("1/1/1970 00:00:00");
                            Ext.Array.forEach(records, function (record){
                                if (record.data.perdida_ope){
                                    tmp = new Date("1/1/1970 " + record.data.perdida_ope);
                                    startDate = new Date(startDate.getTime() + tmp.getMinutes()*60000);
                                }
                            });
                            var h = addZero(startDate.getHours());
                            var m = addZero(startDate.getMinutes());
                            var s = addZero(startDate.getSeconds());
                            
                            return '<span style="font-size: 11px; font-weight:bold">' + h + ":" + m + ":" + s + '</span>';
                        }
                    },
                    {
                        header: 'P\u00E9rd. Legal',
                        dataIndex: 'perdida_leg'+this.idriesgo,
                        //width: 120,
                        flex: 1,
                        align: 'right',
                        renderer:Ext.util.Format.usMoney
                    },
                    {
                        header: 'P\u00E9rd. Econ\u00F3mica',
                        dataIndex: 'perdida_eco'+this.idriesgo,                        
                        flex: 1,
                        align: 'right',
                        renderer:Ext.util.Format.usMoney
                    },
                    {
                        header: 'P\u00E9rd. Comercial',
                        dataIndex: 'perdida_com'+this.idriesgo,                        
                        flex: 1,
                        align: 'right',
                        renderer:Ext.util.Format.usMoney
                    },
                    {
                        header: 'P\u00E9rd. Total',
                        dataIndex: 'perdida_tot'+this.idriesgo,                        
                        flex: 1,
                        align: 'right',
                        renderer:Ext.util.Format.usMoney,
                        summaryType: 'sum',
                        summaryRenderer: function(value, summaryData, dataIndex) {
                            return '<span style="font-size: 11px; font-weight:bold">'+Ext.util.Format.usMoney(value)+'</span>';
                        }
                        
                    }
                ]
            )
        },
        onRender: function(ct, position){
            Colsys.Riesgos.GridEventos.superclass.onRender.call(this, ct, position);
            
        }
    },    
    /*tbar: [
        {
            text: 'Nuevo Evento',
            iconCls: 'add',
            handler : function(){                
                this.up('grid').ventanaEvento(null);            
            }
        },
        {
            text: 'Recargar',
            iconCls: 'refresh',
            handler: function () {
                this.up("grid").getStore().reload();
            }
        },
        {
            xtype: 'exporterbutton',
            text: 'XLS',
            iconCls: 'csv',
            format:'excel'
        }
        
    ],*/
    ventanaEvento : function(record){
        
        var idevento = record?record.data.idevento:'';
        var title = record?"Editar Evento":"Nuevo Evento";
        
        if (winEvento == null) {
            winEvento = Ext.create('Ext.window.Window', {
                title: title,
                width: 700,
                height: 650,
                id:'winEvento',                    
                name:'winEvento',
                maximizable: true,
                layout: 'anchor',
                closeAction: 'destroy',
                items: [ // Let's put an empty grid in just to illustrate fit layout                        
                    Ext.create('Colsys.Riesgos.FormEvento', {
                        id: 'form-evento'+ this.idriesgo,
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
    }
});