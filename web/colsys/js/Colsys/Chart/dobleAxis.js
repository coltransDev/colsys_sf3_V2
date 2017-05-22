Ext.define('Colsys.Chart.dobleAxis', {
    extend: 'Ext.chart.CartesianChart',
    alias: 'widget.Colsys.Chart.dobleAxis',
    class: 'grf',
    
    width: '2000',
    autoScroll: true,
    height: 400,
    //insetPadding: '5 5 10 10',
    legend: {
        style: {
            border: 'none',
            top: '-60px'
        }
    },
    
    listeners: {
        afterrender: function (ct, position) {
            id = this.getId();
            $("#" + this.getId() + " div").css({border: 'none'});
        }
    }
});

