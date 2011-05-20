<?php

?>
<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">
		
			/*var chart;
			//$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'column'
					},
					title: {
						text: 'Stacked column chart'
					},
					xAxis: {
						categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Total fruit consumption'
						}
					},
					legend: {
						align: 'right',
						x: -100,
						verticalAlign: 'top',
						y: 20,
						floating: true,
						backgroundColor: '#FFFFFF',
						borderColor: '#CCC',
						borderWidth: 1,
						shadow: false
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.x +'</b><br/>'+
								 this.series.name +': '+ this.y +'<br/>'+
								 'Total: '+ this.point.stackTotal;
						}
					},
					plotOptions: {
						column: {
							stacking: 'normal'
						}
					},
				    series: [{
						name: 'John',
						data: [5, 3, 4, 7, 2]
					}, {
						name: 'Jane',
						data: [2, 2, 3, 2, 1]
					}, {
						name: 'Joe',
						data: [3, 4, 4, 2, 5]
					}]
				});				
				
			//});
            
            */
            
ChartsPie = function( config ){
        var chart=new Highcharts.Chart(
        {
           chart:((config.renderTo)?{
               renderTo:config.renderTo,
               defaultSeriesType: 'column'
           }:{
						renderTo: 'container',
						defaultSeriesType: 'column'
					}),

           title:((config.title)?{
               text:config.title
           }:{text: 'Titulo Grafica'}), 
           
           xAxis:((config.serieX)?{categories:config.serieX}:{categories: []}), 
           yAxis:((config.titleY || config.minY )?{
						min: (config.minY)?config.minY:0,
						title: {
							text: (config.titleY)?config.titleY:"Titulo en Y"
						}
					}:{
						min: 0,
						title: {
							text: 'Total fruit consumption'
						}
					}), 
           legend:((config.legend)?config.legend:{
						align: 'right',
						x: -100,
						verticalAlign: 'top',
						y: 20,
						floating: true,
						backgroundColor: '#FFFFFF',
						borderColor: '#CCC',
						borderWidth: 1,
						shadow: false
					}), 
           tooltip:((config.tooltip)?config.tooltip:{
						formatter: function() {
							return '<b>'+ this.x +'</b><br/>'+
								 this.series.name +': '+ this.y +'<br/>'+
								 'Total: '+ this.point.stackTotal;
						}
					}), 
           plotOptions:((config.plotOptions)?config.plotOptions:{
						column: {
							stacking: 'normal'
						}
					}),            
           series:((config.series)?config.series:{})
           
        }
    );
};

Ext.extend(ChartsPie, Highcharts, {
    

});

var chart;
        chart=new ChartsPie({
					/*chart: {
						renderTo: 'container',
						defaultSeriesType: 'column'
					},
					title: {
						text: 'Stacked column chart'
					},*/
					xAxis: {
						categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
					},/*
					yAxis: {
						min: 0,
						title: {
							text: 'Total fruit consumption'
						}
					},
					legend: {
						align: 'right',
						x: -100,
						verticalAlign: 'top',
						y: 20,
						floating: true,
						backgroundColor: '#FFFFFF',
						borderColor: '#CCC',
						borderWidth: 1,
						shadow: false
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.x +'</b><br/>'+
								 this.series.name +': '+ this.y +'<br/>'+
								 'Total: '+ this.point.stackTotal;
						}
					},
					plotOptions: {
						column: {
							stacking: 'normal'
						}
					},*/
				    series: [{
						name: 'John',
						data: [5, 3, 4, 7, 2]
					}, {
						name: 'Jane',
						data: [2, 2, 3, 2, 1]
					}, {
						name: 'Joe',
						data: [3, 4, 4, 2, 5]
					}]
				});	
				
		</script>

        
		



