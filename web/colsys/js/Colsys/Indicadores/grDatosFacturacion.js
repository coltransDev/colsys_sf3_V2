Ext.define('Colsys.Indicadores.grDatosFacturacion', {
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
            this.asignarAxes(res[indice].y, idgrafica, indice, idform, tipo);            
            this.asignarSeries(res[indice].y, idgrafica, indice, idform, res, tipo);            
            
            str =   Ext.create('Ext.data.Store', {
                id: 'str-'+ idgrafica + indice + idform,
                model: Ext.create('Ext.data.Model', {
                    fields: [me.res[indice].modelgrafica10],
                    id: 'modelo-' + idgrafica + indice + idform
                }),
                data: me.res[indice].gridvaloresfact
            });
            this.setStore(str);
            
            tb =    Ext.create('Colsys.Indicadores.ToolbarGrafica',{
                id: 'toolbar-'+ idgrafica + indice + idform,
                idgrafica: idgrafica,
                indice: indice,
                idform: idform, 
                ngrafica: me.up().ngrafica,
                subtitulo: me.up().subtitulo,
                transporte: me.up().transporte,                        
                filtro: me.filtro,
                res: me.res
            });
            this.addDocked(tb);
            
            if(res[indice].gridvaloresfact){
                if(tipo == "xMes"){                
                    max = getHighest(res[indice].gridvaloresfact, "valor");
                    factor = 10000000;
                    var axes = me.getAxes();
                    var SampleValuesAxis =  axes[0];    

                    SampleValuesAxis.setMaximum(max+factor);
                    if((max+factor)>(factor*10)){
                        SampleValuesAxis.setMaximum(max+(factor*10));
                    }
                    me.setInnerPadding ({
                        left: 60,
                        right: 60
                    });
                }                    
            }
        }
    },
    asignarAxes: function (dato, idgrafica, indice, idform, tipo) {
        
        switch(tipo){
            case "xTrafico":         
                this.setAxes(
                    [{
                        type: 'numeric3d',
                        position: 'left',                
                        grid: true,                
                        title: {
                            text: 'Valor COP'
                        },
                        fields: dato,
                        grid: {
                            odd: {
                                fillStyle: 'rgba(255, 255, 255, 0.06)'
                            },
                            even: {
                                fillStyle: 'rgba(0, 0, 0, 0.03)'
                            }
                        },
                        renderer: function (axis, label, layoutContext) {
                            var value = layoutContext.renderer(label);
                            return value === 0 ? '$0' : Ext.util.Format.usMoney(value);
                        }
                    }, {
                        type: 'category3d',                
                        position: 'bottom',                
                        title: {
                            text: 'Mes',
                            fontSize: 15
                        },
                        fields: 'mes'
                    }]
                );
                break;
            case "xMes":         
                this.setAxes(
                    [{
                        type: 'numeric',
                        position: 'left',                
                        grid: true,
                        adjustByMajorUnit: true,
                        minimum: 0,                        
                        majorTickSteps : 5,                                
                        title: {
                            text: 'Valor COP'   
                        },
                        fields: 'valor',
                        grid: {
                            odd: {
                                fillStyle: 'rgba(255, 255, 255, 0.06)'
                            },
                            even: {
                                fillStyle: 'rgba(0, 0, 0, 0.03)'
                            }
                        },
                        renderer: function (axis, label, layoutContext) {
                            var value = layoutContext.renderer(label);
                            return value === 0 ? '$0' : Ext.util.Format.usMoney(value);
                        }
                    }, {
                        type: 'category',                
                        position: 'bottom',                
                        title: {
                            text: 'Mes',
                            fontSize: 15
                        },
                        fields: 'mes'
                    }]
                );
                break;
        }
    },
    asignarSeries: function (dato, idgrafica, indice, idform,  res, tipo) {       
        switch(tipo){
            case "xTrafico":
                this.addSeries({                
                    type: 'bar3d',
                    xField: 'mes',
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
                            return Ext.util.Format.usMoney(value);
                        }
                    },
                    tooltip: {
                        trackMouse: true,
                        width: 240,
                        height: 28,
                        renderer: function (toolTip, record, ctx, index, store) {
                            if (record.get(ctx.field)) {                                
                                toolTip.setHtml(ctx.field + ": " + Ext.util.Format.usMoney(record.get(ctx.field)));
                            } else {
                                toolTip.setHtml(ctx.field + ": 0");
                            }
                            return ctx;
                        }
                    },
                    listeners: {
                        itemdblclick: function (series, item, event, eOpts) {
                            mostrardatostraficomes("transito", item.record.data.mes, item.field, idform, res[indice].datosgrid);
                        }
                    }
                });
                break;
            case "xMes":
                this.addSeries({                
                    type: 'line', 
                    title: 'Valor Facturado',
                    xField: 'mes',                    
                    yField: 'valor',                    
                    axis: 'left',
                    style: {
                        lineWidth: 2
                    },
                    marker: {
                        radius: 4,
                        lineWidth: 2
                    },
                    label: {     
                        display: 'over',
                        font: '10px Helvetica',
                        field: 'valor',
                        display: 'insideEnd',
                        renderer: function (value) {
                            return Ext.util.Format.usMoney(value);
                        }
                    },
                    tooltip: {
                        trackMouse: true,
                        width: 280,
                        height: 28,
                        renderer: function (tooltip, record, item) {
                            var title = item.series.getTitle();
                            tooltip.setHtml(title + ' en ' + record.get('mes') + ': ' + Ext.util.Format.usMoney(record.get(item.series.getYField())));                            
                        }
                    },
                    listeners: {
                        itemdblclick: function (series, item, event, eOpts) {
                            mostrardatostraficomes("transito", item.record.data.mes, item.field, idform, res[indice].datosgrid);
                        }
                        
                    }
                });
               break;
       }
    }
});