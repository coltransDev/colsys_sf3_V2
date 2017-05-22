
Ext.define('Colsys.Chart.Pie1', {    
        extend: 'Ext.chart.PolarChart',
        alias: 'widget.Colsys.Chart.Pie1',   
        xtype: 'polar',                            
        width: 600,
        height: 400,
        //theme: 'Muted',        
        interactions: ['itemhighlight', 'rotatePie3d'],
        legend: {
            docked: 'bottom'
        },
        onRender: function ( ct , position )
        {
            
            
            this.superclass.onRender.call(this, ct, position);
        }

        
    /*,
        store: {
            fields: ['data3'],
            data: [{
                'name':'primero',
                'data3': 14
            }, {
                'name':'segundo',
                'data3': 16
            }, {
                'name':'tercero',
                'data3': 14
            }, {
                'name':'cuarto',
                'data3': 6
            }, {
                'name':'quinto',
                'data3': 36
            }]
        },
        series: {
            type: 'pie3d',
            angleField: 'data3',
            donut: 30,
            colorSpread: 50,
            label: {
                field: 'name',
                display: 'rotate'
            }
        }*/
   
   
});
