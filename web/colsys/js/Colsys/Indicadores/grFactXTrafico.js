Ext.define('Colsys.Indicadores.grFactXTrafico', {
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
            
            res = me.res;
            
            
            //asignarinfo(me, res[indice].gridvaloresfact);
            this.asignarAxes(res[indice].y, idgrafica, indice, idform);
            //this.asignarSeries(res[indice].y, tipo, idform, indice,res);
            this.asignarSeries(res[indice].y, idgrafica, indice, idform, res);
            
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
                res: me.res/*,
                tipo: tipo*/
            });
            this.addDocked(tb);
        }
    },
    asignarAxes: function (dato, idgrafica, indice, idform) {
        
//        this.setAxes(
//            [{
//                type: 'numeric3d',
//                position: 'left',                
//                grid: true,                
//                title: {
//                    text: 'Valor COP'
//                },
//                fields: dato,
//                grid: {
//                    odd: {
//                        fillStyle: 'rgba(255, 255, 255, 0.06)'
//                    },
//                    even: {
//                        fillStyle: 'rgba(0, 0, 0, 0.03)'
//                    }
//                },
//                renderer: function (axis, label, layoutContext) {
//                    var value = layoutContext.renderer(label);
//                    return value === 0 ? '$0' : Ext.util.Format.usMoney(value);
//                }
//            }, {
//                type: 'category3d',                
//                position: 'bottom',                
//                title: {
//                    text: 'Month',
//                    fontSize: 15
//                },
//                fields: 'name'
//            }]
//        );
        this.setAxes(
            [{
                type: 'numeric3d',
                position: 'left',                
                grid: true,                
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
                type: 'category3d',                
                position: 'bottom',                
                title: {
                    text: 'Month',
                    fontSize: 15
                },
                fields: 'name'
            }]
        );
    },
    asignarSeries: function (dato, idgrafica, indice, idform,  res) {       
//            this.addSeries({                
//                type: 'bar3d',
//                xField: 'name',
//                yField: dato,
//                stacked: false,
//                axis: 'left',   
//                //width: 140,
//                style: {
//                    maxBarWidth: 200,
//                    minBarWidth: 8
//                },
//                label: {     
//                    //font: '8px Helvetica',
//                    field: dato,
//                    display: 'insideEnd',
//                    renderer: function (value) {
//                        return Ext.util.Format.usMoney(value);
//                    }
//                },
//                tooltip: {
//                    trackMouse: true,
//                    width: 140,
//                    height: 28,
//                    renderer: function (toolTip, record, ctx, index, store) {
//                        if (record.get(ctx.field)) {
//                            //toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(2)+" m\u00B3");
//                            toolTip.setHtml(ctx.field + ": " + Ext.util.Format.usMoney(record.get(ctx.field)));
//                        } else {
//                            toolTip.setHtml(ctx.field + ": 0");
//                        }
//                        //ctx.fill = colors[index % colors.length];
//
//                        return ctx;
//                    }
//                },
//                listeners: {
//                    itemdblclick: function (series, item, event, eOpts) {
//                        mostrardatostraficomes("transito", item.record.data.name, item.field, idform, res[indice].datosgrid);
//                    }
//                }
//            });   
            this.addSeries({                
                type: 'line',
                xField: 'name',
                yField: 'valor',
                stacked: false,
                axis: 'left',
                marker: {
                    type: 'square',
                    animation: {
                        duration: 200,
                        easing: 'backOut'
                    }
                },
                highlightCfg: {
                    scaling: 2
                },
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
                        return Ext.util.Format.usMoney(value);
                    }
                },
                tooltip: {
                    trackMouse: true,
                    width: 140,
                    height: 28,
                    renderer: function (toolTip, record, ctx, index, store) {
                        if (record.get(ctx.field)) {
                            //toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(2)+" m\u00B3");
                            toolTip.setHtml(ctx.field + ": " + Ext.util.Format.usMoney(record.get(ctx.field)));
                        } else {
                            toolTip.setHtml(ctx.field + ": 0");
                        }
                        //ctx.fill = colors[index % colors.length];

                        return ctx;
                    }
                },
                listeners: {
                    itemdblclick: function (series, item, event, eOpts) {
                        mostrardatostraficomes("transito", item.record.data.name, item.field, idform, res[indice].datosgrid);
                    }
                }
            });

    }
});


