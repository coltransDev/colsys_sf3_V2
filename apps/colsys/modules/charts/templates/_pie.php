<?php

?>

<script type="text/javascript">            
ChartsPie = function( config ){
    
        var chart=new Highcharts.Chart(
        {
           chart:((config.renderTo || config.height  || config.width)?{
               renderTo:(config.renderTo)?config.renderTo:"",               
               height:(config.height)?config.height:null,
               width:(config.width)?config.width:null
           }:{
               renderTo: $(this).parent().attr("id"),
						defaultSeriesType: 'column'
					}),

           title:((config.title)?{
               text:config.title
           }:{text: 'Titulo Grafica'}),           
           yAxis:((config.titleY || config.minY )?{
						min: (config.minY)?config.minY:0,
						title: {
							text: (config.titleY)?config.titleY:"Titulo en Y"
						}
                        ,plotBands:((config.plotBands)? config.plotBands :[])
                        ,plotLines:((config.plotLines)? config.plotLines :[])
                        
					}:{
						min: 0,
						title: {
							text: 'Total fruit consumption'
						}
                        ,plotBands:((config.plotBands)? config.plotBands :[])
                        ,plotLines:((config.plotLines)? config.plotLines :[])
					})                    
                    , 
           legend:((config.legend)?config.legend:{
						align: 'center',
                        verticalAlign:'bottom',
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
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {
									return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
								}
							}
						}

					}),
           series:[{
						type: 'pie',
						name: (config.title)?config.title:'',
						data: ((config.series)?config.series:{})
					}]
                
           
        }
    );
};

Ext.extend(ChartsPie, Highcharts, {
    

});
/*
var chart;
        chart=new ChartsColumn({
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
				});	*/
				
		</script>

        
		



