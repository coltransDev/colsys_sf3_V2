<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

Ext.define('chartPie',{
    extend: 'Ext.panel.Panel',
    title: 'Grafica',
    id:"grafica"+this.contconsulta,
    autoScroll: true,
    fixed:true,
    overflowY :'scroll',
    //width: 500,
    //height: 800,
    layout: 'column',
    defaults: {
        //anchor: '100%'
        columnWidth: 1/2                            
    },
    //renderTo: Ext.getBody(),
    items: [
        /*new Chart.ux.Highcharts({                                
                                id: this.id,
                                name:this.id,
                                //bufferedRenderer: true,
                                store: Ext.data.JsonStore({
                                    //bufferedRenderer: true,
                                    fields: ['indicador', 'total'],                                    
                                    proxy: {
                                        url: '<?=url_for("/falabellaAdu2/datosGrafica")?>',
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
                                }),
                                height: 350,
                                series: [
                                    {
                                        type: 'pie',
                                        name: 'Carpetas',
                                        categorieField: 'indicador',
                                        dataField: 'total'
                                    }
                                ],
                                chartConfig: {
                                    colors: arrayColors,
                                    chart: {  
                                        renderer: 'SVG',
                                        options3d: {
                                            type: 'pie',
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
                                    plotOptions: {
                                        pie: {
                                            animation: animate,
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            depth: 35,
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}: <b>{point.percentage:.1f}%</b>'
                                            }
                                        }                                        
                                    },
                                    subtitle: {
                                        text: this.subtitle,
                                        style: {
                                            margin: '0 100px 0 0' // center it
                                        }
                                    }
                                }
                            })*/
        grafica({id:'hcd'+this.contconsulta,title:((!this.titleGraph)?'Indicador de documentos':this.titleGraph),subtitle:((!config.subtitleGraph)?'Indicador de documentos':this.subtitleGraph),datos:JSON.stringify(this.res)}),

    ]
})
</script>