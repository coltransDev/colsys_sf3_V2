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
        docked: 'right'
    },    
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
            var idproceso = me.idproceso;
            var idempresa = me.idempresa;
            
            
            me.setStore( 
                Ext.create('Ext.data.JsonStore', {                                            
                    fields: ['x', 'aceptable','tolerable','critico','mcritico','impacto','probabilidad'],
                    proxy: {
                        url: '/riesgos/datosGraficaAreaxRiesgo',
                        extraParams: {
                            idriesgo: idriesgo,
                            idproceso: idproceso,
                            idempresa: idempresa
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
            labelIcon = this.labelIcon;
            var indexId = this.indexId;

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
                    field: labelIcon,
                    display: 'over',                                                                                    
                    font: '6px',   
                    fillStyle: 'black',
                    translationY: 18
                }
            }];
        
            var panelHtml = '<div style="width:100%;height:1px;border:solid;border-color :#38610B;border-bottom-color:#868A08;"></div>'+
                             '<div style="width:100%;height:20px;padding:0;margin:2px;">'+
                                '<div>'+
                                    '<p style="width:100%;height:20px;text-align:center;font-weight:bold;font-size:20px;">'+
                                        '<b>' + "Mapa de Calor / " + '</b> '+
                                        '<b style="font-size:20px;">' + chart.subtitulo + ' / </b> '+
                                        '<b style="font-size:20px;">' + chart.ano +
                                    '</p>'+
                                '</div>'+
                            '</div>';

            
            chart.addSeries(serie);
            tbar = [{
                xtype: 'toolbar',
                dock: 'top',
                id: 'bar-top-chart-' + indexId,
                items: [{
                    xtype: 'button',
                    id: 'btn-chart-download-'  + indexId,
                    text: 'Descargar Imagen',
                    handler: function(btn, e, eOpts) {                
                        chart.downloadCanvas("Mapa de Calor", chart.subtitulo, chart.ano);
                    }
                }, {
                    xtype: 'button',
                    id: 'btn-chart-preview-'  + indexId,
                    text: 'Vista Previa',
                    handler: function(btn, e, eOpts) {
                       chart.previewIndicadores("Mapa de Calor", chart.subtitulo, chart.ano);
                    }
                },{
                    text: 'Ver Tabla',
                    id: 'btn-chart-tabla-'  + indexId,
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
                },{
                    xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                    width: 300,                    
                    id:'ca_clasificacion-chart-'+ indexId,                    
                    store: Ext.create('Ext.data.Store', {
                        fields: [{type: 'string', name: 'name'},{type: 'integer',name: 'id'}],
                        proxy: {
                            type: 'ajax',
                            url: '/widgets5/datosParametros',
                            extraParams:{
                                caso_uso: 'CU286'
                            },
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        autoLoad: true
                    }),
                    listeners:{
                        change: function (me, newValue, oldValue, eOpts){                            
                            me.nextSibling('button').enable();
                        }
                    }
                },
                {
                    xtype: 'button',
                    id:'button-chart-'+ indexId,
                    hideLabel: false,
                    text: 'Clasificar por',
                    iconCls: 'search',
                    width: 120,
                    tooltip: 'Filtrar',
                    disabled: true,
                    allowBlank: false,                
                    handler: function(me, e) {                    
                        idclasificacion = JSON.stringify(me.previousSibling('combobox').getValue());                        
                        var store =  me.up("chart").getStore();                        
                        if(store.getProxy().extraParams){
                            store.getProxy().extraParams.idclasificacion =  idclasificacion;
                            store.load();
                        }
                    } 
                }]
            },{
                xtype: 'toolbar',
                dock: 'bottom',
                id: 'bar-botton-chart-' + indexId,
                items: [
                    Ext.create('Ext.Panel', {
                        id: 'footer-' + chart.indexId,
                        border: false,
                        flex: 1,
                        width: '100%',
                        /*style: {
                            border: 'none',
                            height: '10px',
                            width: '100%'
                        },*/
                        html: panelHtml,
                        listeners: {
                            render: function (ct, position) {
                                this.setBorder(0);
                            }
                        }
                    })
                ]
            }]
            chart.addDocked(tbar);   
//            console.log("footerchart",chart.id);
//            console.log("charttb0",this.getDockedItems()[0]) ;
//            console.log("charttb1",this.getDockedItems()[1]) ;
//            
//            tbtop = this.getDockedItems()[0];            
//            tbtop.id = 'tbar-top-' + chart.indexId,
//            tbtop.add();
//            
//            tbdown = this.getDockedItems()[1];            
//            tbdown.id = 'tbar-down-' + chart.indexId,
//            tbdown.add(
//                Ext.create('Ext.Panel', {
//                    id: 'footer-' + chart.indexId,
//                    border: false,
//                    flex: 1,
//                    width: '100%',
//                    style: {
//                        border: 'none',
//                        height: '20px',
//                        width: '100%'
//                    },
//                    html: '<div style="width:100%;height:2px;border:solid;border-color :#38610B;border-bottom-color:#868A08;"></div><div style="width:100%;height:60px;padding:0;margin:10px;"><div><p style="width:100%;height:60px;text-align:center;font-weight:bold;font-size:22px;"><b>' + "Mapa de Calor" + '</b><br><b style="font-size:10px;">' + chart.subtitulo + '</b><br><b style="font-size:10px;">' + chart.ano + '</b></p></div></div>',
//                    listeners: {
//                        render: function (ct, position) {
//                            this.setBorder(0);
//                        }
//                    }
//                })
//            );            
        }
    }
});