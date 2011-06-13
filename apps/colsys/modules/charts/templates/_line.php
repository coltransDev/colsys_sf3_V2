<?php

?>

<script type="text/javascript">            
ChartsLine = function( config ){
    
        var chart=new Highcharts.Chart(
        {
           chart:((config.renderTo || config.height  || config.width)?{
               renderTo:(config.renderTo)?config.renderTo:"",
               defaultSeriesType: 'line',
               height:(config.height)?config.height:null,
               width:(config.width)?config.width:null
           }:{
               renderTo: $(this).parent().attr("id"),
						defaultSeriesType: 'column'
					}),

           title:((config.title)?{
               text:config.title
           }:{text: 'Titulo Grafica'}), 
           
           xAxis:((config.serieX)?
               {
                categories:config.serieX,
                labels: {
							rotation: -90,
							align: 'right',
							style: {
								 font: 'normal 11px Verdana, sans-serif'
							}
						}

               }
                :{categories: []}),
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
						line: {
							dataLabels: {
								enabled: true
							},
							enableMouseTracking: false
						}

					}),
           series:((config.series)?config.series:{})
           
        }
    );
};

Ext.extend(ChartsLine, Highcharts, {
    

});
		</script>

        
		



