Ext.define('Colsys.Indicadores.grVolumen', {
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
        beforerender: function (ct, position) {

            pref = this.pref;
            filtro = this.filtro;
            store = Ext.create('Ext.data.Store', {
                proxy: {
                    url: pref + '/widgets5/datosGraficasIndicadores',
                    type: 'ajax',
                    autoLoad: false,
                    reader: {
                        root: 'root',
                        totalProperty: 'totalCount',
                        type: 'json'
                    },
                    extraParams: {
                        filtro: filtro
                    }
                }
            });
            this.setStore(store);
        },
        afterrender: function (ct, position) {
            //alert("HOLA");
            if (this.tipo == "LCL")
                gr1 = Ext.getCmp('grafica1' + indice + idform);
            if (this.tipo == "FCL")
                gr1FCL = Ext.getCmp('grafica1FCL' + indice + idform);
            indice = this.indice;
            //console.log(indice);
            idform = this.idform;
            res = this.res;
            subtitulo = this.subtitulo;
            tipo = this.tipo;
            transporte = this.transporte;

            tb = new Ext.toolbar.Toolbar({
                style: {
                    border: 'none'
                }
            });
            tb.add(
                    {
                        xtype: "panel",
                        width: '60%',
                        html: '<img style="float:left;margin-left:5%;" src="../../images/coltrans_logo.png"></img>',
                        border: false
                    },
                    '->',
                    {
                        xtype: 'button',
                        border: false,
                        iconCls: 'menu_responsive',
                        arrowVisible: false,
                        menu: {
                            items: [
                                {
                                    text: 'Detalles',
                                    border: false,
                                    iconCls: 'zoom_img',
                                    class: 'ven1',
                                    indice: indice,
                                    handler: function () {
                                        /* for(a = 1; a<= indice ; a++){
                                         console.log(Ext.getCmp('w1' + a + idform));
                                         }*/
                                        //console.log(this.up().indice);
                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
                                        tipo = this.up('menu').up('button').up('toolbar').up().tipo;

                                        if (tipo == "LCL") {
                                            Ext.create('Colsys.Indicadores.winVolumenTrafico', {
                                                id: 'w1' + indi + idfor,
                                                indice: indi,
                                                idform: idfor,
                                                res: res,
                                                closeAction: 'destroy'
                                            });


                                            Ext.create('Ext.fx.Anim', {
                                                target: Ext.getCmp('w1' + indi + idfor),
                                                duration: 1000,
                                                from: {
                                                    width: 0,
                                                    opacity: 0,
                                                    height: 0,
                                                    left: 0
                                                },
                                                to: {
                                                    width: 250,
                                                    // height:  (Ext.getCmp('gridvolumen' + indi + idfor).getHeight() + 50)
                                                }
                                            });
                                            if (res[indi]) {
                                                //Ext.getCmp('gridvolumen' + this.indice + idform).getStore().setData(res[this.indice].gridvolumen);
                                                Ext.getCmp('w1' + indi + idfor).show();
                                            }
                                        }
                                        if (tipo == "FCL") {
                                            Ext.create('Colsys.Indicadores.winVolumenFCL', {
                                                id: 'w1FCL' + indi + idfor,
                                                indice: indi,
                                                idform: idfor,
                                                res: res,
                                                closeAction: 'destroy'
                                            });


                                            Ext.create('Ext.fx.Anim', {
                                                target: Ext.getCmp('w1FCL' + indi + idfor),
                                                duration: 1000,
                                                from: {
                                                    width: 0,
                                                    opacity: 0,
                                                    height: 0,
                                                    left: 0
                                                },
                                                to: {
                                                    width: 250,
                                                    // height:  (Ext.getCmp('gridvolumen' + indi + idfor).getHeight() + 50)
                                                }
                                            });
                                            if (res[indi]) {
                                                //Ext.getCmp('gridvolumen' + this.indice + idform).getStore().setData(res[this.indice].gridvolumen);
                                                Ext.getCmp('w1FCL' + indi + idfor).show();
                                            }
                                        }



                                    }
                                },
                                {
                                    //xtype: 'button',
                                    text: 'Descargar Imagen',
                                    iconCls: 'page_save',
                                    handler: function (btn, e, eOpts) {
                                        if (tipo == "LCL")
                                            gr1.downloadCanvas('Volumen x Tr\u00E1fico', subtitulo, transporte);
                                        if (tipo == "FCL")
                                            gr1FCL.downloadCanvas('Volumen x Tr\u00E1fico', subtitulo, transporte);
                                    }
                                },
                                {
                                    // xtype: 'button',
                                    text: 'Vista Previa',
                                    iconCls: 'photo_img',
                                    handler: function (btn, e, eOpts) {
                                        if (tipo == "LCL")
                                            gr1.previewIndicadores('Volumen x Tr&aacute;fico', subtitulo, transporte);
                                        if (tipo == "FCL")
                                            gr1FCL.previewIndicadores('Volumen x Tr&aacute;fico', subtitulo, transporte);
                                    }
                                },
                                {
                                    text: 'Informe del Periodo',
                                    iconCls: 'csv',
                                    handler: function (btn, e, eOpts) {
                                        indi = this.up('menu').up('button').up('toolbar').up().indice;
                                        res = this.up('menu').up('button').up('toolbar').up().res;
                                        idfor = this.up('menu').up('button').up('toolbar').up().idform;
                                        tipo = this.up('menu').up('button').up('toolbar').up().tipo;
                                        
                                        console.log(tipo);
                                        filtro = "volumen";
                                        var data = []
                                        var datos = res[indi].datosgrid;
                                        for (var i = 0; i < datos.length; i++) {
                                            if(datos[i]["modalidad"]== tipo){
                                                    data.push(datos[i]);
                                            }
                                        }
                                        winindicadores = Ext.create('Colsys.Indicadores.winIndicadores', {
                                            id: 'winIndicadores' + idfor+indi,
                                            datos: data,
                                            listeners: {
                                                destroy: function () {
                                                    winindicadores = null;
                                                }
                                            }
                                        }).show();                                        
                                        Ext.getCmp('gridindicadores1').ocultar(filtro);
                                        winindicadores.show();
                                    }
                                }
                            ]
                        }
                    }

            );
            this.addDocked(tb);
        }
    },
    asignarAxes: function (gr1, indice, idform, dato,tipo) {
        if (tipo == "LCL") {
            gr1.setAxes([{
                    type: 'numeric3d',
                    position: 'left',
                    grid: true,
                    id: 'g1-axesl' + indice + idform + tipo,
                    title: {
                        text: 'Volume (m\u00B3)',
                        fontSize: 15
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
                        text: 'Month',
                        fontSize: 15
                    },
                    fields: 'name'
                }]);
        }
        if (tipo == "FCL") {
            gr1FCL.setAxes([{
                    type: 'numeric3d',
                    position: 'left',
                    grid: true,
                    id: 'g1-axesl' + indice + idform + tipo,
                    title: {
                        text: 'Volume (Teus)',
                        fontSize: 15
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
                        text: 'Month',
                        fontSize: 15
                    },
                    fields: 'name'
                }]);
        }

    },
    asignarSeries: function (gr1, dato,tipo,idform, indice) {
       if (tipo == "FCL") {
            gr1FCL.addSeries({
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
                    //font: '8px Helvetica',
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
                        //ctx.fill = colors[index % colors.length];

                        return ctx;
                    }
                },
                listeners: {
                    itemdblclick: function (series, item, event, eOpts) {                        
                        //mostrardatosVolumen(item.record.data.name, item.field, 'FCL', "volumen", idform);
                        data = [];  
                        var grafica = Ext.getCmp("grafica1FCL"+indice+idform);
                        //console.log(Ext.getCmp("grafica1FCL"+indice+idform));
                        //console.log(grafica.res);
                        //console.log(grafica.res[indice].datosgrid);
                        
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
            gr1.addSeries({
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
                    //font: '8px Helvetica',
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
                        //ctx.fill = colors[index % colors.length];

                        return ctx;
                    }
                },
                listeners: {
                    itemdblclick: function (series, item, event, eOpts) {                        
                        mostrardatosVolumen(item.record.data.name, item.field, 'LCL', "volumen", idform);
                    }
                }

            });
        }



    }
});


