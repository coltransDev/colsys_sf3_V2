Ext.define('Colsys.Indicadores.grFacturacion', {
    extend: 'Colsys.Chart.dobleAxis',
     plugins: {
        ptype: 'chartitemevents',
        moveEvents: true
    },
    axes: [{
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
            adjustByMajorUnit: true,
            minimum: 0,
            grid: true,
            increment: 1,
            majorTickSteps : 5,                        
            title: {
                text: 'Negocios',
                fontSize: 15
            },
            fields: 'negocios'
        }, {
            type: 'category3d',
            grid: true,
            position: 'bottom',            
            title: {
                text: 'Mes',
                fontSize: 15
            },
            fields: 'name'
        }],
    store: {
        model: Ext.create('Ext.data.Model', {
            fields: [
                {name: 'namef', type: 'string'},
                {name: 'porcentajef', type: 'float'},
                {name: 'negociosf', type: 'integer'}
            ]
        })
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
    },
    listeners: {
        afterrender: function (ct, position) {
            
            var me = this;            
            var indice = me.up().indice;
            var idform = me.up().idform;
            var idgrafica = me.up().idgrafica;
            res = me.res;            
            
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
            
            asignarinfo(me, res[indice].facturacion);
            this.asignarSeries(me);
            ajustarEjeY(me, res[indice].facturacion);            
        }
    },
    asignarSeries: function (gr5) {
        gr5.addSeries([{
                type: 'bar3d',
                title: 'Negocios',
                axis: 'left',
                stacked: false,
                xField: ['name'],
                yField: ['negocios'],
                tooltip: {
                    trackMouse: true,
                    width: 140,
                    height: 28,
                    renderer: function (toolTip, record, ctx) {
                        toolTip.setHtml(ctx.field + ': ' + record.get(ctx.field) + " Negocios");
                    }
                },
                listeners: {
                    itemdblclick: function (series, item, event, eOpts) {
                        mostrardatosMes("facturacion", item.record.data.name);
                    }
                }
            },
            {
                type: 'line',
                title: '% de Cumplimiento',
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

            }]);
    }
}
);
