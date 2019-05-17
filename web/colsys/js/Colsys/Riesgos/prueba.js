Ext.require([
    'Ext.chart.Chart'
]);

Ext.define('CricketScore', {
    extend: 'Ext.data.Model',
    fields: ['over', 'score']
});

var store = Ext.create('Ext.data.Store', {
    model: 'CricketScore',
    data: [
        { over: 5, score: 35 },
        { over: 10, score: 75 },
        { over: 15, score: 110 },
        { over: 20, score: 135 },
        { over: 25, score: 171 },
        { over: 30, score: 200 },
        { over: 35, score: 225 },
        { over: 40, score: 240 },
        { over: 45, score: 285 },
        { over: 50, score: 345 },
    ]
});

Ext.create('Ext.chart.Chart', {
   renderTo: Ext.getBody(),
   width: 400,
   height: 300,
   theme: 'Green',
   store: store,
    animate: true,
   axes: [
        {
            title: 'Score',
            type: 'Numeric',
            position: 'left',
            fields: ['score'],
            minimum: 0,
            maximum: 400
        },
        {
            title: 'Over',
            type: 'Numeric',
            position: 'bottom',
            fields: ['over']
        }
    ],
    
      series: [
        {
            type: 'column',
			axis: 'left',
            xField: 'over',
            yField: 'score'
        }
    ]
});/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


