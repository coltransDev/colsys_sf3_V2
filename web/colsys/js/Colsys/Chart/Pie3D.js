Ext.define('Colsys.Chart.Pie3D', {
    extend: 'Ext.chart.PolarChart',
    alias: 'widget.Colsys.Chart.Pie3D',
    width: '90%',
    height: 500,
    interactions: ['itemhighlight', 'rotatePie3d'],
    thickness: 58,
    legend: {
        docked: 'bottom'
    },
    style: {
        border: 'solid',
        borderColor: '#157FCC',
        borderRadius: '10px',
        padding: '20px',
        borderWidth: '2px',
        boxShadow: '5px 5px 5px #888888',
        margin: '2%',
        marginBottom: '6%'
    },
    listeners: {
        afterrender: function (ct, position) {
            $("#" + this.getId() + " div").css({border: 'none'});

        }
    },
    series: [{
            type: 'pie3d',
            distortion: 0.6,
            highlight: {
                margin: 40
            },
            angleField: 'peso',
            label: {
                field: 'mes',
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
                    //ctx.fill = colors[index % colors.length];

                    return ctx;
                }
            },
            listeners: {
                itemdblclick: function (series, item, event, eOpts) {
                    mostrardatosMes("peso", item.record.data.mes);
                }
            },
            donut: 25,
            style: {
                miterLimit: 10,
                lineCap: 'miter',
                lineWidth: 2
            }
        }]
}); 