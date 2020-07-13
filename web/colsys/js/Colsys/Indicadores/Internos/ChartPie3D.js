Ext.define('Colsys.Indicadores.Internos.ChartPie3D', {
    extend: 'Ext.chart.PolarChart',
    legend: {
        docked: 'bottom'
    },
    series: [{
        type: 'pie3d',
        distortion: 0.6,
        highlight: {
            margin: 40
        },
        angleField: 'data',
        label: {
            field: 'usuario',
            display: 'horizontal',
            renderer: function (text, sprite, config, rendererData, index) {
            }
        },
        tooltip: {
            trackMouse: true,
            width: 140,
            height: 28,
            renderer: function (toolTip, record, ctx, index, store) {

                if (record.get(ctx.field)) {
                    toolTip.setHtml(ctx.field + ": " + parseFloat(record.get(ctx.field)).toFixed(0));
                } else {
                    toolTip.setHtml(ctx.field + ": 0");
                }
                return ctx;
            }
        },
        listeners: {
            itemdblclick: function (series, item, event, eOpts) {
//                mostrardatosMes("peso", item.record.data.mes);
            }
        },
        donut: 40,
        style: {
            miterLimit: 10,
            lineCap: 'miter',
            lineWidth: 2
        }
    }]    
});