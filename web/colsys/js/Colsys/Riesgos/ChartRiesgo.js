var arrayColors = ['#3366FF','#008000','#FFCC00','#FF0000'];
winNivel = null;
var htmlN = 
        '<table class="tabla_escala">'+        
        '<tr><td><p class="parrafo" >MUY CRITICO</p><p class="descripcion">REQUIERE DE ATENCI\u00d3N URGENTE</p></td>'+
        '<td style="background-color:#FF0000;"><p class="valor">60 - 100</p></td></tr>'+
        '<tr><td><p class="parrafo" >CRITICO</p><p class="descripcion">REQUIERE DE ATENCI\u00d3N PRIORITARIA</p></td>'+
        '<td style="background-color:#FFCC00;"><p class="valor">25 - 59</p></td></tr>'+
        '<tr><td><p class="parrafo" >TOLERABLE</p><p class="descripcion">DE PREFERIRSE, DAR TRATAMIENTO ADICIONAL</p></td>'+
        '<td style="background-color:#008000;"><p class="valor">6 - 24</p></td></tr>'+
        '<tr><td><p class="parrafo" >ACEPTABLE</p><p class="descripcion">NO REQUIERE TRATAMIENTO ADICIONAL</p></td>'+
        '<td style="background-color:#3366FF;"><p class="valor">1 - 5</p></td></tr>'+
        '</table>';

Ext.define('Colsys.Riesgos.ChartRiesgo', {
    extend: 'Ext.chart.CartesianChart',    
    alias: 'widget.Colsys.Chart.ChartRiesgo',
    xtype: 'cartesian',        
    width: '100%',    
    insetPadding: 40,
    legend: {
        docked: 'bottom'
    },    
    dockedItems: [{
        xtype: 'toolbar',
        dock: 'top',
        items: [{
            xtype: 'button',
            text: 'Descargar Imagen',
            handler: function(btn, e, eOpts) {                
                this.up("cartesian").downloadCanvas();
            }
        }, {
            xtype: 'button',
            text: 'Vista Previa',
            handler: function(btn, e, eOpts) {
               this.up("cartesian").preview();
            }
        },{
            text: 'Ver Tabla',
            iconCls: 'table',
            handler: function () {
                if(winNivel == null){
                    winNivel = Ext.create('Ext.window.Window',{
                        width: 300,
                        height: 260,
                        id:'winNivel',                    
                        name:'winNivel',                        
                        title: 'NIVEL DE RIESGO',
                        layout: 'anchor',
                        html: htmlN,
                        closeAction: 'hide',
                        listeners: {
                            afterrender: function(ct, position){                                            
                                $(".parrafo").css({'font-weight': 'bold','font-size': '10px', 'text-align':'center'});
                                $(".descripcion").css({'text-align':'center'});
                                $(".valor").css({'min-width':'80px','font-size': '10px','text-align':'center'});                                
                                $(".tabla_escala").css({'border-radius':'5px','border':'1px solid #CCCCCC', 'border-collapse': 'collapse'});                                
                                $(".tabla_escala tr td").css({'border':'1px solid #CCCCCC','line-height':'10px'});
                            }
                        }
                   })
                }
                winNivel.show(); 
            }
        }]
    }],
    axes: [{
        type: 'numeric',
        fields: 'x', // Serie Area               
        position: 'top',
        majorTickSteps: 20,
        hidden: true,
        minimum: 1,
        maximum: 21                
    },{
        type: 'numeric',
        fields: 'impacto', // Serie Scatter                
        title: 'Impacto',
        position: 'bottom',
        majorTickSteps: 20,
        minimum: 1,
        maximum: 21,                
        grid: true
    },{
        type: 'numeric',
        position: 'left',
        fields: ['probabilidad'], // Serie Scatter                
        title: 'Probabilidad',
        majorTickSteps: 5,
        increment: 1,
        grid: true,
        minimum: 1,
        maximum: 6
    },{
        type: 'numeric',
        position: 'right',// Serie Area
        hidden: true,
        majorTickSteps: 5,
        increment: 1,
        grid: true,
        minimum: 1,
        maximum: 6
    }],
    series:[
        {
            type: 'area',
            axis: 'right',
            title: [ 'Aceptable', 'Tolerable', 'Cr\u00EDtico', 'Muy Cr\u00EDtico' ],
            xField: 'x',
            yField: [ 'aceptable','tolerable','critico','mcritico'],                
            style: {
                opacity: 0.80
            },
            colors: arrayColors,
            highlight: true
        }
    ],
    listeners:{
        beforerender: function (me, eOpts) {            
            var idriesgo = me.idriesgo;
            
            me.setStore( 
                Ext.create('Ext.data.JsonStore', {                                            
                    fields: ['x', 'aceptable','tolerable','critico','mcritico','impacto','probabilidad'],
                    proxy: {
                        url: '/riesgos/datosGraficaAreaxRiesgo',
                        extraParams: {
                            idriesgo: idriesgo
                        },
                        type: 'ajax',                            
                        reader: {
                             type: 'json',
                             rootProperty: 'root'
                        }                            
                    },
                    autoLoad: true
                })
            );                                  
        },
        afterrender: function(){
            var chart = this;

            var serie = [{
                type: 'scatter',
                xField: 'impacto',
                yField: 'probabilidad',
                showInLegend: false,
                axis: 'right',
                marker: {
                    type: 'ellipse',                                                                            
                    cx: 0,
                    cy: 0,
                    rx: 16,
                    ry: 5 
                },
                style: {
                    renderer: function (sprite, config, rendererData, index) {
                        config.fill = 'white'               
                    }
                },
                label: {
                    field: 'score',
                    display: 'over',                                                                                    
                    font: '6px',   
                    fillStyle: 'black',
                    translationY: 18
                }
            }];

            chart.addSeries(serie);
        }
    }            
});