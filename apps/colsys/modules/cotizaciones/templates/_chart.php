<?php

?>
<script type="text/javascript">
    Ext.chart.Chart.CHART_URL = '/css/yui/charts/assets/charts.swf';
    ChartPanel = function( config ){
  /*  var store = new Ext.data.JsonStore({
        fields: ['season', 'total'],
        data: [{
            season: 'Summer',
            total: 150
        },{
            season: 'Fall',
            total: 245
        },{
            season: 'Winter',
            total: 117
        },{
            season: 'Spring',
            total: 184
        }]
    });*/
//		alert(config.id)
var store = new Ext.data.JsonStore({
        fields: ['opcion', 'total'],
        data: config.data
    });


        Ext.apply(this, config);
        ChartPanel.superclass.constructor.call(this, {        
        items: {
            store: store,
            xtype: 'piechart',            
            dataField: 'total',
            categoryField: 'opcion',
            //extra styles get applied to the chart defaults
            extraStyle:
            {
                legend:
                {
                    display: 'bottom',
                    padding: 5,
                    font:
                    {
                        family: 'Tahoma',
                        size: 13
                    }
                }
            }
        }
    }
    );
    };

    Ext.extend(ChartPanel, Ext.form.FormPanel, {

    });
</script>


