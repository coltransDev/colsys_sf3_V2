Ext.define('Colsys.Indicadores.grDatosVolumen', {
    extend: 'Colsys.Chart.dobleAxis',
    plugins: {
        ptype: 'chartitemevents',
        moveEvents: true
    },
    animation: Ext.isIE8 ? false : {
        easing: 'backOut',
        duration: 500
    },
    listeners: {        
        afterrender: function (ct, position) {            
            var me = this;
            
            var indice = me.up().indice;
            var idform = me.up().idform;
            var idgrafica = me.up().idgrafica;                        
            var tipo = me.tipo;
            res = me.res;
            
            if (tipo == "LCL")
                datos = res[indice].root;                
            if (tipo == "FCL")
                datos = res[indice].datosFCL;
            
            this.asignarAxes(res[indice].y, idgrafica, indice, idform, tipo);
            this.asignarSeries(res[indice].y, idgrafica, indice, idform, res, tipo);
            
            str =   Ext.create('Ext.data.Store', {
                id: 'str-'+ idgrafica + indice + idform,
                model: Ext.create('Ext.data.Model', {
                    fields: [me.res[indice].modelgrafica2],
                    id: 'modelo-' + idgrafica + indice + idform
                }),
                data: datos
            });
            this.setStore(str);
            
            tb =    Ext.create('Colsys.Indicadores.ToolbarGrafica',{
                id: 'toolbar-'+ idgrafica + indice + idform,
                indice: indice,
                idform: idform,
                ngrafica: me.up().ngrafica,
                subtitulo: me.up().subtitulo,
                transporte: me.up().transporte,                        
                filtro: me.filtro,
                res: me.res,
                tipo: tipo
            });
            this.addDocked(tb);
        }
    },
    asignarAxes: function (dato, idgrafica, indice, idform, tipo) {
        
        this.setAxes(
            [{
                type: 'numeric3d',
                position: 'left',                
                adjustByMajorUnit: true,
                minimum: 0,                        
                majorTickSteps : 5,
                increment: 1,
                title: {
                    text: tipo=="LCL"?'Volume (m\u00B3)':'Volume (Teus)'
                },
                fields: dato,
                grid: {
                    odd: {
                        fillStyle: 'rgba(255, 255, 255, 0.06)'
                    },
                    even: {
                        fillStyle: 'rgba(0, 0, 0, 0.03)'
                    }
                }
            }, {
                type: 'category3d',
                position: 'bottom',
                title: {
                    text: 'Mes',
                    fontSize: 15
                },
                fields: 'name'
            }]
        );
    },
    asignarSeries: function (dato, idgrafica, indice, idform,  res, tipo) {       
       if (tipo == "FCL") {
            this.addSeries({                
                type: 'bar3d',
                xField: 'name',
                yField: dato,
                stacked: false,
                axis: 'left',   
                //width: 140,
                style: {
                    maxBarWidth: 200,
                    minBarWidth: 8
                },
                label: {     
                    font: '10px Helvetica',
                    field: dato,
                    display: 'insideEnd',
                    renderer: function (value) {
                        return parseFloat(value).toFixed(0);
                    }
                },
                tooltip: {
                    trackMouse: true,
                    width: 140,
                    height: 28,
                    renderer: function (toolTip, record, ctx, index, store) {
                        if (record.get(ctx.field)) {
                            toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(2)+" teus");
                        } else {
                            toolTip.setHtml(ctx.field + ": 0");
                        }
                        return ctx;
                    }
                },
                listeners: {
                    itemdblclick: function (series, item, event, eOpts) {                        
                        data = [];                          
                        var grafica = Ext.getCmp("grafica1FCL"+indice+idform);                        
                        var datos = grafica.res[indice].datosgrid;
                        
                        for (var i = 0; i < datos.length; i++) {
                            if(datos[i]["modalidad"]== "FCL"){
                                if (datos[i]["mes"] == item.record.data.name && datos[i]["traorigen"] == item.field) {
                                    data.push(datos[i]);
                                }
                            }
                        }                        

                        Ext.create('Ext.window.Window', {                            
                            title: 'Resumen de Datos',                            
                            header: {
                                titlePosition: 2,
                                titleAlign: 'center'
                            },
                            closable: true,                            
                            maximizable: true,
                            width: 1000,
                            minWidth: 350,
                            height: 550,                            
                            closeAction: 'destroy',                            
                            items: [
                                Ext.create('Ext.grid.Panel', {                                     
                                    bufferedRenderer: true,
                                    store: Ext.data.JsonStore({                        
                                        fields: [
                                            {name: 'anio', type: 'string'},
                                            {name: 'mes', type: 'string'},
                                            {name: 'empresa', type: 'string'},
                                            {name: 'reporte', type: 'string'},
                                            {name: 'doctransporte', type: 'string'},
                                            {name: 'orden', type: 'string'},
                                            {name: 'traorigen', type:'string'},
                                            {name: 'destino'},
                                            {name: 'proveedor'},
                                            {name: 'modalidad'},
                                            {name: 'piezas', type: 'integer'},
                                            {name: 'peso', type: 'integer'},
                                            {name: 'volumen', type: 'float'},
                                            {name: 'teus', type: 'integer'}
                                        ],
                                        data: data,
                                        proxy: {
                                            type: 'ajax',                            
                                            reader: {
                                                 type: 'json',
                                                 rootProperty: 'root'
                                            }                            
                                        },
                                        autoLoad: false
                                    }),
                                    features: [{           
                                        ftype: 'summary'
                                    }],
                                    listeners:{
                                        afterRender:function(ct, position){

                                            tb = new Ext.toolbar.Toolbar();
                                            tb.add(
                                            [{
                                                xtype: 'exporterbutton',
                                                text: 'Exportar CSV',
                                                iconCls: 'csv'
                                                }
                                            ]);                                            
                                            if(this.id.indexOf("-locked")<0)
                                                this.addDocked(tb);
                                        }
                                    }, 
                                    autoScroll:true,        
                                    lockedGridConfig: {
                                        header: false,
                                        collapsible: true
                                    },
                                    lockedViewConfig: {
                                        scroll: 'horizontal'
                                    },
                                    columns: [{
                                        text: "A\u00F1o",
                                        dataIndex: 'anio',                                        
                                        width: 60
                                    },
                                    {
                                        text: "Mes",
                                        dataIndex: 'mes',
                                        width: 60                                       
                                    },
                                    {
                                        text: "RN",                                        
                                        dataIndex: 'consecutivo',                                        
                                        width: 110,                                        
                                        renderer: function (value, metaData, record, rowIndex, colIndex, store, view) {
                                            return '<a href="/tracking/reportes/detalleReporte/rep/' + value + '" target="_blank">' + value + '</a>';
                                        }
                                    },
                                    {
                                        text: "Orden No",
                                        dataIndex: 'orden',                                        
                                        width: 120,
                                        summaryRenderer: function (value, summaryData, dataIndex) {
                                            return "<b> # Embarques</b>";
                                        }
                                    },
                                    {
                                        text: "Doc.<br/>Transporte",
                                        dataIndex: 'doctransporte',                                        
                                        width: 140,
                                        summaryType: 'count',
                                        summaryRenderer: function(value, summaryData, dataIndex) {
                                            return "<span style='font-weight: bold;'> "+value+"</span>";
                                        }
                                    },
                                    {
                                        text: "Tra. Origen",
                                        dataIndex: 'traorigen',                                        
                                        width: 120
                                    },
                                    {
                                        text: "Destino",
                                        dataIndex: 'destino',                                        
                                        width: 100                                        
                                    },
                                    {
                                        text: "Transportador",
                                        dataIndex: 'line',                                        
                                        hidden: true,
                                        width: 100                                        
                                    },
                                    {
                                        text: "Proveedor",
                                        dataIndex: 'proveedor',                                        
                                        width: 150
                                    },
                                    {
                                        text: "Mod.",
                                        dataIndex: 'modalidad',                                        
                                        width: 60                                        
                                    },
                                    {
                                        text: "Piezas",
                                        dataIndex: 'piezas',                                        
                                        width: 70,                                        
                                        summaryType: 'sum',
                                        summaryRenderer: function(value, summaryData, dataIndex) {
                                            return "<span style='font-weight: bold;'> "+value+"</span>";
                                        }                                        
                                    },
                                    {
                                        text: "Peso",
                                        dataIndex: 'peso',                                        
                                        width: 70,                                        
                                        summaryType: 'sum',                
                                        summaryRenderer: function(value, summaryData, dataIndex) {
                                            return "<span style='font-weight: bold;'> "+value+"</span>";
                                        }                                        
                                    },
                                    {
                                        text: "Vol.",
                                        dataIndex: 'volumen',                                        
                                        width: 70,
                                       summaryType: 'sum',                
                                        summaryRenderer: function(value, summaryData, dataIndex) {
                                            return "<span style='font-weight: bold;'> "+value+"</span>";
                                        }
                                    },{
                                        text: "Teus",
                                        dataIndex: 'teus',                                        
                                        width: 70,
                                        summaryType: 'sum',                
                                        summaryRenderer: function(value, summaryData, dataIndex) {
                                            return "<span style='font-weight: bold;'> "+value+"</span>";
                                        }
                                    }]
                                })
                            ]
                        }).show();
                    }
                }
            });
        }
        if (tipo == "LCL") {
            this.addSeries({
                type: 'bar3d',                
                xField: 'name',
                yField: dato,
                stacked: false,
                axis: 'left',                
                style: {
                    maxBarWidth: 200,
                    minBarWidth: 8
                },
                label: {
                    font: '10px Helvetica',
                    field: dato,
                    display: 'insideEnd',
                    renderer: function (value) {
                        return parseFloat(value).toFixed(2);
                    }
                },
                tooltip: {
                    trackMouse: true,
                    width: 140,
                    height: 28,
                    renderer: function (toolTip, record, ctx, index, store) {

                        if (record.get(ctx.field)) {
                            toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(2)+" m\u00B3");
                        } else {
                            toolTip.setHtml(ctx.field + ": 0");
                        }                        

                        return ctx;
                    }
                },
                listeners: {
                    itemdblclick: function (series, item, event, eOpts) {                        
                        mostrardatosVolumen(item.record.data.name, item.field, 'LCL', "volumen", idform, res[indice].datosgrid);
                    }
                }
            });
        }
    }
});