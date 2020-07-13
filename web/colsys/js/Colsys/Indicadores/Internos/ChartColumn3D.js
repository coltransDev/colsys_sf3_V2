Ext.define('Colsys.Indicadores.Internos.ChartColumn3D', {
    extend: 'Ext.chart.CartesianChart',    
    alias: 'widget.Colsys.Indicadores.Internos.ChartColumn3D',    
    xtype: 'cartesian',
    theme: 'Muted',
    interactions: ['itemhighlight'],
    animation: {
        duration: 200
    },
    legend: {
        type: 'dom',
        docked: 'bottom'
    },
    axes: [],
    series:[],
    listeners:{
        render: function(me, eOpts){
            
            var info = me.info;
            me.addSeries({
                type: 'bar3d',
                title:  [],
                axis: 'left',
                stacked: false,
                xField: ['mes'],
                yField: me.usuarios,
                tooltip: {
                    trackMouse: true,
                    width: 140,
                    height: 28,
                    renderer: function (toolTip, record, ctx) {
                        if(me.info.tipodiff == "H:i:s"){
                            var time = new Date(parseInt(record.get(ctx.field)));
                            toolTip.setHtml(ctx.field + ': '+ Ext.Date.format(time, 'H:i:s') + " horas");
                        }else{
                            toolTip.setHtml(ctx.field + ': '+ record.get(ctx.field) + " d\u00edas");
                        }
                    }
                },
                /*label: {
                            //font: '8px Helvetica',
                    field: me.usuarios,
                    display: 'insideEnd',
                    renderer: function (value) {
                        var time = new Date(parseInt(value));
                        return Ext.Date.format(time, 'H:i:s');
                    }
                },*/
                style: {
                    maxBarWidth: 200,
                    minBarWidth: 8
                },
                listeners: {
                    itemdblclick: function (series, item, event, eOpts) {
        //                mostrardatosMes("zarpe",item.record.data.name);
                    }
                }
            })
        }
    }
    
    //series: []
});

//Ext.define('Colsys.view.charts.column3d.BasicController', {
//    extend: 'Ext.app.ViewController',
//    alias: 'controller.column-grouped-3d',
//
//    onAxisLabelRender: function (axis, label, layoutContext) {
//        // Custom renderer overrides the native axis label renderer.
//        // Since we don't want to do anything fancy with the value
//        // ourselves except adding a thousands separator, but at the same time
//        // don't want to loose the formatting done by the native renderer,
//        // we let the native renderer process the value first.
//        var value = layoutContext.renderer(label) / 1000;
//        return value === 0 ? '$0' : Ext.util.Format.number(value, '$0K');
//    },
//
//    onSeriesLabelRender: function (value) {
//        return Ext.util.Format.number(value / 1000, '$0K');
//    },
//
//    onGridColumnRender: function (v) {
//        return Ext.util.Format.number(v, '$0,000');
//    }
//
//});
