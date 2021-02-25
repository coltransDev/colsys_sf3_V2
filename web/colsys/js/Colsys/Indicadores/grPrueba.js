Ext.define('Colsys.Indicadores.grPrueba', {
    extend: 'Colsys.Chart.dobleAxis',
     plugins: {
        chartitemevents: {
            moveEvents: true
        }
    },
    store: {
        fields: ['pet', 'households'],
        data: [
            {pet: 'Cats', households: 38},
            {pet: 'Dogs', households: 45},
            {pet: 'Fish', households: 13}
        ]
    },
    axes: [{
        type: 'numeric',
        position: 'left'
    }, {
        type: 'category',
        position: 'bottom'
    }],
    series: [{
        type: 'bar',
        xField: 'pet',
        yField: 'households',
        listeners: {
            itemclick: function(t, item, event, eOpts) {                                            

//                            console.log(item.field);
//                            console.log(item.record.data.name);
                //console.log(item.record);
                Ext.Msg.alert(item.field);
                //console.log(item);
                //console.log('itemclick', item.field, item.record.data.name);
                //mostrardatostraficomes("transito", item.record.data.name, item.field);
            }
        }
    }/*, {
        type: 'line',
        xField: 'pet',
        yField: 'total',
        marker: true
    }*/],
//    listeners: { // Listen to itemclick events on all series.
//        itemclick: function (chart, item, event) {
//            console.log('itemclick', item.category, item.field);
//        }
//    }
}
);
