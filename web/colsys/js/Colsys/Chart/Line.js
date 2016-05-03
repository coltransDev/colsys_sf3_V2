/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.define('Colsys.Chart.Line', {
    extend: 'Chart.ux.Highcharts',
    alias: 'widget.Colsys.Chart.Line',
    requires:['Chart.ux.Highcharts.LineSerie'],
    height: 350,
    onRender: function(ct, position){        
        this.store=Ext.data.JsonStore({
            //bufferedRenderer: true,
            fields: ['indicador', 'total'],                                    
            proxy: {
                url: this.url,
                extraParams: {
                    datos:this.datos
                },
                type: 'ajax',                            
                reader: {
                     type: 'json',
                     rootProperty: 'root'
                }                            
            },
            autoLoad: true
        });
        
        this.chartConfig= {
            colors: arrayColors,
            chart: {  
                renderer: 'SVG',
                options3d: {
                    type: 'line',
                    enabled: true,
                    alpha: 50,
                    beta: 0
                }
            },
            title: {
                text: this.title,
                style: {
                    margin: '10px 100px 0 0' // center it
                }
            },
            xAxis: {
            categories: ['2015-12', '2016-01', '2016-02']
            },
            yAxis: {
                title: {
                    text: this.titleY
                }
            },
            
            plotOptions: {
                /*line: {
                    animation: animate,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: <b>{point.percentage:.1f}%</b>'
                    }
                }*/
                line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
            },
            subtitle: {
                text: this.subtitle,
                style: {
                    margin: '0 100px 0 0' // center it
                }
            }
        };        
      this.superclass.onRender.call(this, ct, position);    
    }
})