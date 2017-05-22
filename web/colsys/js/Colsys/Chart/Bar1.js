Ext.define('Colsys.Chart.Bar1', {  
   extend: 'Ext.chart.CartesianChart',
   alias:'widget.Colsys.Chart.Bar1',
   width: 600,
   height: 400,
   //theme: 'Muted',
   
   innerPadding: '0 10 0 10',
   //interactions: ['reset', 'rotate'],
   /*store: {
       fields: ['name', 'apples', 'oranges'],
       data: [{
           name: 'Eric',
           apples: 10,
           oranges: 3
       }, {
           name: 'Mary',
           apples: 7,
           oranges: 2
       }, {
           name: 'John',
           apples: 5,
           oranges: 2
       }, {
           name: 'Bob',
           apples: 2,
           oranges: 3
       }, {
           name: 'Joe',
           apples: 19,
           oranges: 1
       }, {
           name: 'Macy',
           apples: 13,
           oranges: 4
       }]
   },
   tbar: [
        '->',
        {
            text: Ext.os.is.Desktop ? 'Download' : 'Preview',
            handler: 'onDownload'
        }
    ],*/
   animation: Ext.isIE8 ? false : {
            easing: 'backOut',
            duration: 500
        },
   /*axes: [{
       type: 'numeric3d',
       position: 'left',
       fields: ['apples', 'oranges'],
       title: {
           text: 'Inventory',
           fontSize: 15
       },
       grid: {
           odd: {
               fillStyle: 'rgba(255, 255, 255, 0.06)'
           },
           even: {
               fillStyle: 'rgba(0, 0, 0, 0.03)'
           }
       },
       renderer: 'onAxisLabelRender'
       
   }, {
       type: 'category3d',
       position: 'bottom',
       title: {
           text: 'People',
           fontSize: 15
       },
       fields: 'name'
   }],
   series: {
       type: 'bar3d',
       xField: 'name',
       yField: ['apples', 'oranges'],
       label: {
                field: 'apples',
                display: 'insideEnd',
                renderer: 'onSeriesLabelRender'
            },
            tooltip: {
                trackMouse: true,
                renderer: 'onTooltipRender'
            },
            highlightCfg: {
                saturationFactor: 1.5
            },
   },*/
   
   /*onDownload: function () {
        var chart = this.lookupReference('chart');

        if (Ext.os.is.Desktop) {
            chart.download({
                filename: 'Industry size in major economies for 2011'
            });
        } else {
            chart.preview();
        }
    },*/

    onSeriesLabelRender: function (v) {
        return Ext.util.Format.number(v );
    },

    

    onAxisLabelRender: function (axis, label, layoutContext) {
        // Custom renderer overrides the native axis label renderer.
        // Since we don't want to do anything fancy with the value
        // ourselves except adding a thousands separator, but at the same time
        // don't want to loose the formatting done by the native renderer,
        // we let the native renderer process the value first.
        
        return Ext.util.Format.number(layoutContext.renderer(label) );
    }
});