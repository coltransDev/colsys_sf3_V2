var arrayColors = ['#3366FF','#008000','#FFCC00','#FF0000'];

Ext.define('Colsys.Chart.Area1', {
    extend: 'Ext.chart.CartesianChart',    
    alias: 'widget.Colsys.Chart.Area1',
    xtype: 'cartesian',        
    width: '100%',
    //height: 500,
    insetPadding: 40,            
    axes: [{
        type: 'numeric',
        fields: 'x', // Serie Area               
        position: 'top',
        majorTickSteps: 20,
        hidden: true,
        minimum: 1,
        maximum: 21                
    },{
        type: 'numeric',
        fields: 'impacto', // Serie Scatter                
        title: 'Impacto',
        position: 'bottom',
        majorTickSteps: 20,
        minimum: 1,
        maximum: 21,                
        grid: true
    },{
        type: 'numeric',
        position: 'left',
        fields: ['probabilidad'], // Serie Scatter                
        title: 'Probabilidad',
        majorTickSteps: 5,
        increment: 1,
        grid: true,
        minimum: 1,
        maximum: 6
    },{
        type: 'numeric',
        position: 'right',// Serie Area
        hidden: true,
        majorTickSteps: 5,
        increment: 1,
        grid: true,
        minimum: 1,
        maximum: 6
    }],
    series:[
        {
            type: 'area',
            axis: 'right',
            title: [ 'Aceptable', 'Tolerable', 'Cr\u00EDtico', 'Muy Cr\u00EDtico' ],
            xField: 'x',
            yField: [ 'aceptable','tolerable','critico','mcritico'],                
            style: {
                opacity: 0.80
            },
            colors: arrayColors,
            highlight: true
        }
    ]
});