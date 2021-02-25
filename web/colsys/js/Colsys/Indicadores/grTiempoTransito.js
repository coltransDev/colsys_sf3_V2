Ext.define('Colsys.Indicadores.grTiempoTransito', {
    alias: 'widget.wPanelGrafica',
    extend: 'Colsys.Chart.dobleAxis',
    plugins: {
        ptype: 'chartitemevents'
        //moveEvents: true
    },
    listeners:{
        afterrender: function (ct, position) {            
            var me = this;            
            var indice = me.up().indice;
            var idform = me.up().idform;
            var idgrafica = me.up().idgrafica;
            
            str =   Ext.create('Ext.data.Store', {
                id: 'str-'+ idgrafica + indice + idform,
                model: Ext.create('Ext.data.Model', {
                    fields: [me.res[indice].modelgrafica2],
                    id: 'modelo-' + idgrafica + indice + idform
                }),
                data: me.res[indice].grafica2
            });
            this.setStore(str);
            
            this.setAxes(
                [{
                    type: 'numeric',
                    position: 'right',                                                                                                
                    minimum: 0,
                    maximum: 120,
                    title: {
                        text: '% De Cumplimiento',
                        fontSize: 15
                    },                                                                                
                    fields: 'porcentaje'
                }, {                    
                    type: 'numeric3d',
                    position: 'left',
                    adjustByMajorUnit: false,
                    minimum: 0,
                    grid: true,
                    increment: 1,
                    title: {
                        text: 'Negocios',
                        fontSize: 15
                    },                                                                                                        
                    fields: me.fields
                }, {
                    type: 'category3d',                    
                    position: 'bottom',
                    grid: true,
                    title: {
                        text: 'Mes',
                        fontSize: 15
                    },
                    fields: 'name'
                }]);
            
            this.addSeries(
                [{
                    type: 'bar3d',                    
                    style: {
                        maxBarWidth: 200,
                        minBarWidth: 8
                    },
                    axis: 'left',
                    stacked: false,
                    xField: 'name',
                    yField: me.res[indice].y,
                    tooltip: {
                        trackMouse: true,
                        width: 140,
                        height: 28,
                        renderer: function (toolTip, record, ctx) {
                            toolTip.setHtml(ctx.field + ': ' + record.get(ctx.field) + " Negocios");
                        }
                    },
                    listeners: {
                        itemdblclick: function(t, item, event, eOpts) {                                            
                            mostrardatostraficomes("transito", item.record.data.name, item.field, idform, me.res[indice].datosgrid);
                        }
                    }
                },
                {
                    type: 'line',                    
                    axis: 'right',
                    xField: 'name',
                    yField: ['porcentaje'],
                    stacked: false,
                    marker: true,
                    label: {
                        field: ['porcentaje'],
                        display: 'over',
                        font: '10px Helvetica',
                        renderer: function (text, label, labelCfg, data, index) {
                            var record = data.store.getAt(index);
                            return record.get('porcentaje') + '%';
                        }
                    },
                    tooltip: {
                        trackMouse: true,
                        width: 140,
                        height: 28,
                        renderer: function (toolTip, record, ctx) {
                            toolTip.setHtml("<b>" + ctx.field + "</b>" + ': ' + record.get(ctx.field) + "%");
                        }
                    }
                }]
            );
            
            tb =    Ext.create('Colsys.Indicadores.ToolbarGrafica',{
                        id: 'toolbar-'+ idgrafica + indice + idform,
                        indice: indice,
                        idform: idform,
                        ngrafica: me.up().ngrafica,
                        subtitulo: me.up().subtitulo,
                        transporte: me.up().transporte,                        
                        filtro: me.filtro,
                        res: me.res
                    });
            this.addDocked(tb);            
        }
    },    
    tooltip: {
        trackMouse: true,
        width: 140,
        height: 28,
        renderer: function (toolTip, record, ctx) {
            if (record.get(ctx.field)) {
                toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(0));
            } else {
                toolTip.setHtml(ctx.field + ": 0");
            }
        }
    }
})