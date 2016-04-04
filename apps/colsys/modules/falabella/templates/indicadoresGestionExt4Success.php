<?php
    //sfContext::getInstance()->getResponse()->removeStylesheet("/css/print.css");    
    include_component("widgets4","wgTrafico");    
    include_component("falabella", "gridPanelObservaciones");
    include_component("falabella", "gridPanelDatosWindow");
    $years = $sf_data->getRaw("years");
?>
<style>
    .iconDetails {
        margin-left:2%;
        float:left; 
        height:100%;        
    } 
    
    hr { 
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 10px;
        border: 5px inset #B9BE67;
    }
</style>
<script type="text/javascript" src="/js/jquery/jquery-1.4.3.min.js"></script>
<script src="/js/highcharts4/js/highcharts.js"></script>
<script src="/js/highcharts4/js/modules/exporting.js"></script>

<div align="center" id="formulario" class="esconder"></div><br/>

<script>
    Ext.require([
        'Ext.form.field.File',
        'Ext.form.Panel',
        'Ext.window.MessageBox'
    ]);
    
    function getObjects(obj, key, val) {
        var objects = [];
        for (var i in obj) {
            if (!obj.hasOwnProperty(i)) continue;
            if (typeof obj[i] == 'object') {
                objects = objects.concat(getObjects(obj[i], key, val));
            } else {
                if (i == key && obj[i] == val || i == key && val == '') { //
                    objects.push(obj);
                } else if (obj[i] == val && key == '') {
                    if (objects.lastIndexOf(obj) == -1) {
                        objects.push(obj);
                    }
                }
            }
        }
        return objects;
    }
                    
    var optionsPie = {
        chart: {
            type: 'pie',
            events: {
                load: function() {
                    console.log("Inicialización de Evento");
                }
            },
            options3d: {
                enabled: true,
                alpha: 60,
                beta: 0
            },
            style:{
                overflow: 'visible'
            }
        },
        data: {
            table: 'ejemplo'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        legend: {
            enabled: true
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer'/*,
                //depth: 20,
                dataLabels: {
                    enabled: true,
                    distance: 5,
                    style: {
                        fontSize: '9px'
                    },
                    format: '{point.name}: <b>{point.percentage:.1f}%</b>'
                }*/
            }
        }
    }
                                
    Ext.onReady(function() {

        Ext.QuickTips.init();

        var formPanel = Ext.create('Ext.form.Panel', {
            width: 500,
            height: 200,
            bodyPadding: 10,
            bodyStyle: {            
                textAlign: 'left'
            },            
            url: '<?=url_for("falabella/indicadoresGestionExt4")?>',
            waitMsgTarget: true,
            title: 'Indicadores de Gestión Falabella',
            items: [{
                    xtype:"hidden",
                    name:"criterio",
                    id:"idcriterio",
                    value: "buscar"
                },
                {  
                    xtype: 'combo',                    
                    name: 'year',
                    id: 'year',
                    fieldLabel: 'Año',
                    queryMode: 'local',                                    
                    displayField: 'year',
                    valueField: 'year',
                    allowBlank: false,
                    width:250,
                    store: new Ext.data.Store( {
                       fields: ['year'],
                       data : <?=json_encode($years)?>
                    })
                },
                {  
                    xtype: 'combo',
                    id: 'combo',
                    fieldLabel: 'Periodo',
                    queryMode: 'local',                
                    displayField: 'name',
                    valueField: 'id',
                    allowBlank: false,
                    width:250,
                    store: Ext.create('Ext.data.Store', {
                        fields: ['id', 'name'],
                        data: [
                          {'id': 1, 'name': 'Ene-Feb'},
                          {'id': 2, 'name': 'Mar-Abr'},
                          {'id': 3, 'name': 'May-Jun'},
                          {'id': 4, 'name': 'Jul-Ago'},
                          {'id': 5, 'name': 'Sep-Oct'},
                          {'id': 6, 'name': 'Nov-Dic'},
                        ]
                    })
                },                
                {
                    xtype: 'wTrafico',
                    width:250,
                    fieldLabel: "Trafico",
                    name: "idtrafico",
                    id: "idtrafico"
                },
                {  
                    xtype: 'combo',
                    id: 'transporte',
                    fieldLabel: 'Transporte',
                    queryMode: 'local',                
                    displayField: 'name',
                    valueField: 'id',
                    allowBlank: false,
                    width:250,
                    store: Ext.create('Ext.data.Store', {
                        fields: ['id', 'name'],
                        data: [
                          {'id': 'air', 'name': 'Aéreo'},
                          {'id': 'sea', 'name': 'Marítimo'}
                        ]
                    })
                }
            ],
            buttons: [{
                text: 'Enviar',
                handler: function() {
                    // The getForm() method returns the Ext.form.Basic instance:
                    var form = formPanel.getForm();
                    
                    if (form.isValid()) {
                        // Submit the Ajax request and handle the response
                        form.submit({
                            waitMsg: "Generando informe...",
                            success: function(form, action) {
                                //$("#indicadores").html(action.response.responseText)
                                
                                var res= JSON.parse(action.response.responseText);
                                var subtitleBim =  res.subtitle + "<br/>" +res.transporte.toUpperCase();
                                var subtitleAcu =  res.ano + "<br/>" +res.transporte.toUpperCase();
                                
                                var options = {
                                    chart: {                                        
                                        type: 'column',
                                        events: {
                                            load: function () {
                                            }
                                        },
                                        style:{
                                            overflow: 'visible'
                                        }
                                    },
                                    title: {
                                        style: {
                                            color: 'black'
                                        }
                                    },
                                    subtitle: {
                                        style: {
                                            color: 'blue'
                                        }
                                    },
                                    yAxis: [{
                                        min: 0,
                                        tickInterval: 10,
                                        title: {
                                            text: 'No. of References'
                                        }
                                    }, {
                                        id: 'performance-axis',
                                        lineWidth: 2,
                                        lineColor: '#A2BE67',
                                        opposite: true,                                        
                                        min: 0,
                                        max: 100,
                                        title: {
                                            text: 'Performance %',
                                            style: {
                                                color: '#A2BE67'
                                            }
                                        },
                                        labels: {
                                            format: '{value}%',
                                            style: {
                                                color: '#A2BE67'
                                            }
                                        }
                                    }],
                                    legend: {
                                        enabled: true
                                    },
                                    tooltip: {
                                        /*
                                        formatter: function() {
                                            var unit = {
                                                'References': 'References',
                                                'Performance': '%'
                                            }[this.series.name];
                                        shared: true*/
                                        formatter: function() {

                                            var serie = this.series;
                                            var index = this.series.data.indexOf(this.point);
                                            var s = '<b>' + this.x + '</b><br>';

                                            $.each(serie.chart.series, function(index1, value) {
                                                var color = value["color"];
                                                var s1 = value["chart"]["series"][index1]["processedYData"][index];
                                                var tool = value["chart"]["series"][index1]["tooltipOptions"]["valueSuffix"];
                                                if (s1 != null)
                                                    s += '<span style="color:' + color + '">' + value["chart"]["series"][index1]["name"] + '</span>' + ' : ' + s1 + tool + '<br>';
                                            });
                                            return s;
                                        }
                                    },
                                    plotOptions: {
                                        series: {
                                            dataLabels: {
                                                enabled: true,
                                                formatter: function() {
                                                    var unit = {
                                                        'References': 'Refs',
                                                        'Performance': '%'
                                                    }[this.series.name];      
                                                    if ([this.series.name] != 'References' && [this.series.name] != 'Performance')
                                                        return '' + this.y + ' ' + 'm³';
                                                    else
                                                        return '' + this.y + ' ' + unit;
                                                }                                                
                                            }
                                        }
                                    }
                                };
                                
                                var observacion = new Array();
                                $.each(res.obs, function( index, value ) {
                                    observacion[index] = value;                              
                                })
                                
                                //Grafica 1
                                if(res.data){
                                    
                                    var category = new Array();
                                    var serie = new Array();
                                    var datay = new Array();
                                    var idreportes = new Array();                                    
                                    var idgrafica = 1;

                                    $.each(res.data, function( index, value ) {                                    
                                        category.push(index);
                                        idreportes[index] = value["idreportes"];
                                        $.each(value, function(index1, value1){
                                            if(index1 === "total"){
                                                serie.push(value1);
                                            }else if(index1  === "performance_asn"){
                                                datay.push(value1);                                            
                                            }
                                        })                                    
                                    })
                                    
                                    if(observacion[idgrafica] && observacion[idgrafica].length > 0){
                                        options.chart.events.load = function(){
                                            var label = this.renderer.label(observacion[idgrafica])
                                            .css({
                                                width: '850px',
                                                color: '#222',
                                                fontSize: '16px'
                                            })
                                            .attr({
                                                'stroke': 'silver',
                                                'stroke-width': 2,
                                                'r': 5,
                                                'fill': '#DFEAF2',
                                                'padding': 10
                                            })
                                            .add();

                                            label.align(Highcharts.extend(label.getBBox(), {
                                                align: 'center',
                                                x: 0, // offset
                                                verticalAlign: 'bottom',
                                                y: 100 // offset
                                            }), null, 'spacingBox');
                                        };
                                        options.chart.spacingBottom = 100;
                                    }
                                    
                                    $("#grafica1").show();
                                    options.chart.renderTo = 'container1';                                    
                                    var chart = new Highcharts.Chart(options);
                                    
                                    chart.xAxis[0].setCategories(category);
                                    chart.setTitle({ text: 'ASN PERFORMANCE BIMONTHLY'});
                                    chart.setTitle(null, { text: subtitleBim});
                                    
                                    chart.addSeries({
                                        name: 'References',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay
                                    });
                                }
                                
                                //Grafica 2  
                                if(res.data2){
                                                             
                                    var category2 = new Array();
                                    var serie2 = new Array();
                                    var datay2 = new Array();
                                    
                                    $.each(res.data2, function( index, value ) {                                    
                                        category2.push(index);
                                        $.each(value, function(index1, value1){
                                            if(index1=="total"){
                                                serie2.push(value1);
                                            }else if(index1  == "performance_asn"){
                                                datay2.push(value1);                                            
                                            }
                                        })                                    
                                    })
                                    
                                    options.chart.events.load = function(event){
                                        console.log("No requiere observaciones");                                        
                                    }
                                    options.chart.spacingBottom = 0;
                                    
                                    $("#grafica2").show();
                                    options.chart.renderTo = 'container2';
                                    var chart = new Highcharts.Chart(options);


                                    chart.xAxis[0].setCategories(category2);
                                    chart.setTitle({ text: 'ASN PERFORMANCE AGGREGATE'});
                                    chart.setTitle(null, { text: subtitleAcu});
                                    chart.addSeries({
                                        name: 'References',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie2
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay2
                                    });
                                }
                                
                                //Grafica 3
                                if(res.dataTraf){
                                
                                    var category3 = new Array();
                                    var serie3 = new Array();
                                    var datay3 = new Array();
                                    var idgrafica = 3;
                                    
                                    $.each(res.dataTraf, function( index, value ) {                                    
                                        category3.push(index);
                                        $.each(value, function(index2, value2){
                                            if(index2 === "total"){
                                                serie3.push(value2);
                                            }else if(index2  === "performance_asn"){
                                                datay3.push(value2);                                            
                                            }
                                        })                                    
                                    })
                                    
                                    if(observacion[idgrafica] && observacion[idgrafica].length > 0){
                                        options.chart.events.load = function(event){
                                            var label = this.renderer.label(observacion[idgrafica])
                                            .css({
                                                width: '850px',
                                                color: '#222',
                                                fontSize: '16px'
                                            })
                                            .attr({
                                                'stroke': 'silver',
                                                'stroke-width': 2,
                                                'r': 5,
                                                'fill': '#DFEAF2',
                                                'padding': 10
                                            })
                                            .add();

                                            label.align(Highcharts.extend(label.getBBox(), {
                                                align: 'center',
                                                x: 0, // offset
                                                verticalAlign: 'bottom',
                                                y: 100 // offset
                                            }), null, 'spacingBox');
                                        };
                                        options.chart.spacingBottom = 100;
                                    }
                                    
                                    $("#grafica3").show();
                                    options.chart.renderTo = 'container3';
                                    var chart = new Highcharts.Chart(options);

                                    chart.xAxis[0].setCategories(category3);
                                    chart.setTitle({ text: 'ASN PERFORMANCE BY ORIGIN BIMONTHLY'});
                                    chart.setTitle(null, { text: subtitleBim});
                                    
                                    chart.addSeries({
                                        name: 'References',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie3
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay3
                                    });
                                }
                            
                                //Grafica 4
                                if(res.dataTrafCon){
                                
                                    var category4 = new Array();
                                    var serie4 = new Array();
                                    var datay4 = new Array();
                                    
                                    $.each(res.dataTrafCon, function( index, value ) {                                    
                                        category4.push(index);
                                        $.each(value, function(index4, value4){
                                            if(index4 === "total"){
                                                serie4.push(value4);
                                            }else if(index4  === "performance_asn"){
                                                datay4.push(value4);                                            
                                            }
                                        })                                    
                                    })
                                    
                                    options.chart.events.load = function(event){
                                        console.log("No requiere observaciones");                                        
                                    }
                                    options.chart.spacingBottom = 0;

                                    $("#grafica4").show();
                                    options.chart.renderTo = 'container4';
                                    var chart = new Highcharts.Chart(options);

                                    chart.xAxis[0].setCategories(category4);                                    
                                    chart.setTitle({ text: 'ASN PERFORMANCE BY ORIGIN AGGREGATE'});
                                    chart.setTitle(null, { text: subtitleAcu});
                                    
                                    chart.addSeries({
                                        name: 'References',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie4,
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay4
                                    });
                                }
                            
                                //Grafica 5
                                if(res.data){
                                
                                    var category5 = new Array();
                                    var serie5 = new Array();
                                    var datay5 = new Array();
                                    var idgrafica = 5;
                                    
                                    $.each(res.data, function( index, value ) {                                    
                                        category5.push(index);
                                        $.each(value, function(index5, value5) {
                                            if (index5 === "total") {
                                                serie5.push(value5);
                                            } else if (index5 === "performance_doc") {
                                                datay5.push(value5);
                                            }
                                        })
                                    })
                                    
                                    if(observacion[idgrafica] && observacion[idgrafica].length > 0){
                                        options.chart.events.load = function(event){
                                            var label = this.renderer.label(observacion[idgrafica])
                                            .css({
                                                width: '850px',
                                                color: '#222',
                                                fontSize: '16px'
                                            })
                                            .attr({
                                                'stroke': 'silver',
                                                'stroke-width': 2,
                                                'r': 5,
                                                'fill': '#DFEAF2',
                                                'padding': 10
                                            })
                                            .add();

                                            label.align(Highcharts.extend(label.getBBox(), {
                                                align: 'center',
                                                x: 0, // offset
                                                verticalAlign: 'bottom',
                                                y: 100 // offset
                                            }), null, 'spacingBox');
                                        };
                                        options.chart.spacingBottom = 100;
                                    }

                                    $("#grafica5").show();
                                    options.chart.renderTo = 'container5';
                                    var chart = new Highcharts.Chart(options);

                                    chart.xAxis[0].setCategories(category5);
                                    chart.setTitle({ text: 'DOCUMENT PERFORMANCE BIMONTHLY'});
                                    chart.setTitle(null, { text: subtitleBim});
                                    
                                    chart.addSeries({
                                        name: 'References',
                                        color: '#BA6ABC',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie5
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay5
                                    });                                
                                }
                            
                                //Grafica 6
                                if(res.data2){

                                    var category6 = new Array();
                                    var serie6 = new Array();
                                    var datay6 = new Array();
                                    
                                    $.each(res.data2, function( index, value ) {                                    
                                        category6.push(index);
                                        $.each(value, function(index6, value6) {
                                            if (index6 === "total") {
                                                serie6.push(value6);
                                            } else if (index6 === "performance_doc") {
                                                datay6.push(value6);
                                            }
                                        })
                                    })
                                    
                                    options.chart.events.load = function(event){
                                        console.log("No requiere observaciones");                                        
                                    }
                                    options.chart.spacingBottom = 0;

                                    $("#grafica6").show();
                                    options.chart.renderTo = 'container6';
                                    var chart = new Highcharts.Chart(options);

                                    chart.xAxis[0].setCategories(category6);
                                    chart.setTitle({ text: 'DOCUMENT PERFORMANCE AGGREGATE'});
                                    chart.setTitle(null, { text: subtitleAcu});
                                    
                                    chart.addSeries({
                                        name: 'References',
                                        color: '#BA6ABC',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie6
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay6
                                    });                                    
                                }
                                
                                //Grafica 7
                                if(res.data){

                                    var category7 = new Array();
                                    var serie7 = new Array();
                                    var datay7 = new Array();
                                    var idgrafica = 7;
                                    
                                    $.each(res.data, function( index, value ) {                                    
                                        category7.push(index);
                                        $.each(value, function(index7, value7) {
                                            if (index7 === "total") {
                                                serie7.push(value7);
                                            } else if (index7=== "performance_des") {
                                                datay7.push(value7);
                                            }
                                        })
                                    })
                                    
                                    if(observacion[idgrafica] && observacion[idgrafica].length > 0){
                                        options.chart.events.load = function(event){
                                            var label = this.renderer.label(observacion[idgrafica])
                                            .css({
                                                width: '850px',
                                                color: '#222',
                                                fontSize: '16px'
                                            })
                                            .attr({
                                                'stroke': 'silver',
                                                'stroke-width': 2,
                                                'r': 5,
                                                'fill': '#DFEAF2',
                                                'padding': 10
                                            })
                                            .add();

                                            label.align(Highcharts.extend(label.getBBox(), {
                                                align: 'center',
                                                x: 0, // offset
                                                verticalAlign: 'bottom',
                                                y: 100 // offset
                                            }), null, 'spacingBox');
                                        };
                                        options.chart.spacingBottom = 100;
                                    }

                                    $("#grafica7").show();
                                    options.chart.renderTo = 'container7';
                                    var chart = new Highcharts.Chart(options);

                                    chart.xAxis[0].setCategories(category7);
                                    chart.setTitle({ text: 'DEPARTURE PERFORMANCE BIMONTHLY'});
                                    chart.setTitle(null, { text: subtitleBim});
                                    
                                    chart.addSeries({
                                        name: 'References',
                                        color: '#DB843D',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie7
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay7
                                    });                                    
                                }
                                
                                //Grafica 8
                                if(res.data2){

                                    var category8 = new Array();
                                    var serie8 = new Array();
                                    var datay8 = new Array();
                                    
                                    $.each(res.data2, function( index, value ) {                                    
                                        category8.push(index);
                                        $.each(value, function(index8, value8) {
                                            if (index8 === "total") {
                                                serie8.push(value8);
                                            } else if (index8=== "performance_des") {
                                                datay8.push(value8);
                                            }
                                        })
                                    })
                                    
                                    options.chart.events.load = function(event){
                                        console.log("No requiere observaciones");                                        
                                    }
                                    options.chart.spacingBottom = 0;

                                    $("#grafica8").show();
                                    options.chart.renderTo = 'container8';
                                    var chart = new Highcharts.Chart(options);

                                    chart.xAxis[0].setCategories(category8);
                                    chart.setTitle({ text: 'DEPARTURE PERFORMANCE AGGREGATE'});
                                    chart.setTitle(null, { text: subtitleAcu});
                                    
                                    chart.addSeries({
                                        name: 'References',
                                        color: '#DB843D',
                                        tooltip: {
                                            valueSuffix: ' Refs'
                                        },
                                        data: serie8
                                    });
                                    
                                    chart.addSeries({
                                        name: 'Performance',
                                        type: 'line',
                                        color: '#A2BE67',
                                        yAxis: 'performance-axis',
                                        tooltip: {
                                            valueSuffix: ' %'
                                        },
                                        data: datay8
                                    });                                    
                                }
                                
                                //Grafica 9
                                if(res.load){
                                    
                                    var chartSeriesData = [];
                                    var chartSeriesDataAcum = [];
                                    var idgrafica = 9;
                                    
                                    $.each(res.load, function( index, value ) {                                    
                                            var series_name = value["index"];
                                            var series_data = value["value"];
                                            var series = [
                                                    series_name,
                                                    parseFloat(series_data)
                                                ];
                                            chartSeriesData.push(series);                                  
                                    })
                                    
                                    $.each(res.loadAcum, function( index, value ) {                                    
                                            var series_name = value["index"];
                                            var series_data = value["value"];

                                            var series = [
                                                    series_name,
                                                    parseFloat(series_data)
                                                ];
                                            chartSeriesDataAcum.push(series);                                  
                                    })
                                    
                                    if(observacion[idgrafica] && observacion[idgrafica].length > 0){
                                        optionsPie.chart.events.load = function(event){
                                            var label = this.renderer.label(observacion[idgrafica])
                                            .css({
                                                width: '850px',
                                                color: '#222',
                                                fontSize: '16px'
                                            })
                                            .attr({
                                                'stroke': 'silver',
                                                'stroke-width': 2,
                                                'r': 5,
                                                'fill': '#DFEAF2',
                                                'padding': 10
                                            })
                                            .add();

                                            label.align(Highcharts.extend(label.getBBox(), {
                                                align: 'center',
                                                x: 0, // offset
                                                verticalAlign: 'bottom',
                                                y: 100 // offset
                                            }), null, 'spacingBox');
                                        };
                                        optionsPie.chart.spacingBottom = 300;
                                    }
                                    
                                    $("#grafica9").show();
                                    optionsPie.chart.renderTo = 'container9';
                                    var chart = new Highcharts.Chart(optionsPie);
                                    
                                    chart.setTitle({ text: 'LOAD PERFORMANCE'});                                    

                                    //Funcion para agregar un título a cada gráfica
                                    (function (Highcharts) {
                                        Highcharts.wrap(Highcharts.seriesTypes.pie.prototype, 'render', function (proceed) {

                                            center = this.center || (this.yAxis && this.yAxis.center),
                                            titleOption = this.options.title,
                                            
                                            proceed.call(this);

                                            if (center && titleOption) {
                                                box = {
                                                    x: chart.plotLeft + center[0] - 0.5 * center[2],
                                                    y: chart.plotTop + center[1] - 0.5 * center[2],
                                                    width: center[2],
                                                    height: center[2]
                                                };
                                                if (!this.title) {
                                                    this.title = this.chart.renderer.label(titleOption.text)
                                                    .css(titleOption.style)
                                                    .add()
                                                }
                                                var labelBBox = this.title.getBBox();
                                                if (titleOption.align == "center")
                                                    box.x -= labelBBox.width/2;
                                                else if (titleOption.align == "right")
                                                    box.x -= labelBBox.width;
                                                this.title.align(titleOption, null, box);
                                            }
                                        });

                                    } (Highcharts));
                                    // Se ubica doble serie Pie para dividir los dataLabel
                                    chart.addSeries({
                                        type: 'pie',
                                        name: 'Value',
                                        title: {
                                            style: { 
                                                color: '#2400FF',
                                            },
                                            align: 'left',
                                            text: '<b>BIMONTLY</b>',
                                            verticalAlign: 'top',
                                            y: -40,
                                            x: 80
                                        },
                                        dataLabels: {
                                            enabled: true,
                                            distance: 5,
                                            style: {
                                                fontSize: '9px'
                                            },
                                            format: '{point.name}'
                                        },
                                        center: [200, 120],
                                        size: 250,
                                        data: chartSeriesData
                                    });
                                    
                                    chart.addSeries({
                                        type: 'pie',
                                        dataLabels: {                                            
                                            distance: -30,
                                            style: {
                                                fontSize: '13px'
                                            },
                                            formatter: function () {
                                                if(this.percentage!=0)  return Math.round(this.percentage)  + '%';
                                            }
                                        },
                                        name: 'Value',
                                        center: [200, 120],
                                        size: 250,
                                        data: chartSeriesData
                                    });
                                    
                                    chart.addSeries({
                                        type: 'pie',
                                        name: 'Valor',
                                        title: {
                                            style: { 
                                                color: '#2400FF',
                                            },
                                            align: 'left',
                                            text: '<b>AGGREGATE</b>',
                                            verticalAlign: 'top',
                                            y: -40,
                                            x: 80
                                        },
                                        dataLabels: {
                                            enabled: true,
                                            distance: 5,
                                            style: {
                                                fontSize: '9px'
                                            },
                                            format: '{point.name}'
                                        },
                                        center: [670, 120],
                                        size: 250,
                                        data: chartSeriesDataAcum
                                    });
                                    
                                    chart.addSeries({
                                        type: 'pie',
                                        name: 'Valor',                                        
                                        dataLabels: {                                            
                                            distance: -30,
                                            style: {
                                                fontSize: '13px'
                                            },
                                            formatter: function () {
                                                if(this.percentage!=0)  return Math.round(this.percentage)  + '%';
                                            }
                                        },
                                        center: [670, 120],
                                        size: 250,
                                        data: chartSeriesDataAcum
                                    });
                                }
                                
                                //Grafica 10
                                if(res.dataVol){

                                    var category10 = new Array();
                                    var chartSeriesData = [];                                    
                                    
                                    $.each(res.data2, function( index, value ) {                                    
                                        category10.push(index);                                        
                                    })
                                    
                                    options.chart.events.load = function(event){
                                        console.log("No requiere observaciones");                                        
                                    }
                                    options.chart.spacingBottom = 0;
                                    
                                    $("#grafica10").show();
                                    options.chart.renderTo = 'container10';
                                    var chart = new Highcharts.Chart(options);

                                    chart.xAxis[0].setCategories(category10);
                                    if(res.transporte == "sea"){
                                    chart.yAxis[0].update({
                                        title:{
                                            text: "Volume (m³)"
                                        }
                                    });
                                    }else if(res.transporte == "air"){
                                       chart.yAxis[0].update({
                                        title:{
                                            text: "Volume (Kg/Vol)"
                                        }
                                    }); 
                                    }
                                    chart.yAxis[1].remove(true);
                                    
                                    chart.setTitle({ text: 'VOLUME BY ORIGIN AGGREGATE'});
                                    chart.setTitle(null, { text: subtitleAcu});
                                    if(res.transporte == "sea"){
                                    $.each(res.dataVol, function( index, value ) {
                                        chart.addSeries({                                        
                                            name: value["name"],
                                            data: value["data"],
                                            tooltip: {
                                                valueSuffix: ' m³'
                                            }
                                        });
                                    })
                                    }else if(res.transporte == "air"){
                                        $.each(res.dataVol, function( index, value ) {
                                        chart.addSeries({                                        
                                            name: value["name"],
                                            data: value["data"],
                                            tooltip: {
                                                valueSuffix: ' Kg/Vol'
                                            },
                                            dataLabels: {                                            
                                                /*distance: -30,
                                                style: {
                                                    fontSize: '13px'
                                                },*/
                                                formatter: function () {
                                                    return this.y  + 'Kg';
                                            }
                                        }
                                        });
                                    })
                                    }
                                }
                                
                                 //Grafica 11
                                 
                                if(res.pieLineaBim){
                                    
                                    var chartSeriesData = [];
                                    var chartSeriesDataAcum = [];
                                    var series_name = "";
                                    var idgrafica = 11;
                                    
                                    $.each(res.pieLineaBim, function( index, value ) {
                                        
                                        if(value["index"].length>25)
                                            series_name = value["index"].substring(0, (value["index"].length/2))+"<br/>"+value["index"].substring((value["index"].length/2),value["index"].length); 
                                        else
                                            series_name = value["index"];                                        
                                        var series_data = value["value"];                                        
                                        var series = [
                                                series_name,
                                                parseFloat(series_data)
                                            ];
                                        chartSeriesData.push(series);                                  
                                    })
                                    
                                    $.each(res.pieLineaAcum, function( index, value ) {
                                            
                                            series_name = value["index"];                                            
                                            var series_data = value["value"];

                                            var series = [
                                                    series_name,
                                                    parseFloat(series_data)
                                                ];
                                            chartSeriesDataAcum.push(series);                                  
                                    })
                                    
                                    if(observacion[idgrafica] && observacion[idgrafica].length > 0){
                                        optionsPie.chart.events.load = function(event){
                                            var label = this.renderer.label(observacion[idgrafica])
                                            .css({
                                                width: '850px',
                                                color: '#222',
                                                fontSize: '16px'
                                            })
                                            .attr({
                                                'stroke': 'silver',
                                                'stroke-width': 2,
                                                'r': 5,
                                                'fill': '#DFEAF2',
                                                'padding': 10
                                            })
                                            .add();

                                            label.align(Highcharts.extend(label.getBBox(), {
                                                align: 'center',
                                                x: 0, // offset
                                                verticalAlign: 'bottom',
                                                y: 150 // offset
                                            }), null, 'spacingBox');
                                        };
                                        optionsPie.chart.spacingBottom = 300;
                                    }
                                    
                                    $("#grafica11").show();
                                    optionsPie.chart.renderTo = 'container11';                                    
                                    var chart = new Highcharts.Chart(optionsPie);
                                    
                                    chart.setTitle({ text: 'CARRIER ALLOCATION'});
                                    
                                    chart.addSeries({
                                        type: 'pie',                                        
                                        title: {
                                            style: { 
                                                color: '#2400FF',
                                            },
                                            align: 'left',
                                            text: '<b>BIMONTLY</b>',
                                            verticalAlign: 'top',
                                            y: -40,
                                            x: 80
                                        },
                                        dataLabels: {
                                            enabled: true,
                                            distance: 5,
                                            style: {
                                                fontSize: '9px'
                                            },
                                            format: '{point.name}'
                                        },
                                        id:"p1",
                                        name: 'Value',
                                        center: [220, 120],
                                        size: 210,
                                        data: chartSeriesData
                                    });
                                    
                                    chart.addSeries({
                                        type: 'pie',                                        
                                        dataLabels: {                                            
                                            distance: -30,
                                            style: {
                                                fontSize: '13px'
                                            },
                                            formatter: function () {
                                                if(this.percentage!=0)  return Math.round(this.percentage)  + '%';
                                            }
                                        },
                                        name: 'Value',
                                        center: [220, 120],
                                        size: 210,
                                        data: chartSeriesData
                                    });
                                    
                                    chart.addSeries({
                                        type: 'pie',
                                        title: {                                           
                                            style: { 
                                                color: '#2400FF',
                                            },
                                            align: 'left',
                                            text: '<b>AGGREGATE</b>',
                                            verticalAlign: 'top',
                                            y: -40,
                                            x: 80
                                        },
                                        dataLabels: {
                                            enabled: true,
                                            distance: 5,
                                            style: {
                                                fontSize: '9px'
                                            },
                                            format: '{point.name}'
                                        },
                                        id:"p2",
                                        name: 'Valor',
                                        center: [670, 120],
                                        size: 210,
                                        data: chartSeriesDataAcum
                                    });
                                    
                                    chart.addSeries({
                                        type: 'pie',
                                        dataLabels: {                                            
                                            distance: -30,
                                            style: {
                                                fontSize: '13px'
                                            },
                                            formatter: function () {
                                                if(this.percentage!=0)  return Math.round(this.percentage)  + '%';
                                            }
                                        },
                                        name: 'Valor',
                                        center: [670, 120],
                                        size: 210,
                                        data: chartSeriesDataAcum
                                    });
                                }
                                
                                //Actualización de cada gráfica para implementar la opción de mostrar un grid con los datos cuando se da click en cada serie
                                var grafMes = [1,2,5,6,7,8];
                                var grafTrafico = [3,4,10];

                                for(var i=1; i<12; i++){
                                    var j = jQuery.inArray(i, grafMes );
                                    var k = jQuery.inArray(i, grafTrafico );                                        
                                    var charUpdate = $('#container'+i).highcharts();
                                    if(j>=0){
                                        charUpdate.series[0].update({
                                            point: {
                                                events: {
                                                    click: function () {                                                         
                                                        //console.log('Month: ' + this.category + ', value: ' + this.y);
                                                    var win = new GridPanelDatosWindow({
                                                        datos: getObjects(res.datos,'mes',this.category)
                                                    });                        
                                                    win.show();
                                                    win.setTitle(res.ano +' - '+this.category);
                                                    }
                                                }
                                            }
                                        });
                                    }else if(k>=0){
                                        charUpdate.series[0].update({
                                            point: {
                                                events: {
                                                    click: function () {
                                                        var win = new GridPanelDatosWindow({
                                                            datos: getObjects(res.datos,'origen',this.category)
                                                        });                        
                                                        win.show();
                                                        win.setTitle(res.ano +' - '+this.category);
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }
                                
                                // Grid de Datos
                                $("#grid-datos").empty();//Es necesario cuando se renderiza sobre un dato ya generado                                
                                <?include_component("falabella", "gridDatosIdg")?>                    
                                grid.getStore().removeAll();
                                grid.getStore().loadData(res.datos, true);
                                grid.setTitle(res.transporte.toUpperCase() + ' - ' + res.ano);                                                               
                                $("#grid-datos").show();                                
                                    
                            },
                            failure: function(form, action) {
                                Ext.Msg.alert('Failed', action.result.msg);
                            }
                        });
                    }else{
                        Ext.MessageBox.alert('Formulario:', '¡Por favor complete los campos subrayados!');
                    }
                }
            },{
                text: 'Borrar',
                handler: function() {
                    var form = formPanel.getForm();
                    form.reset();
                }
            }],
            renderTo: 'formulario'
        });

        var submitForm = function(){
            formPanel.getForm().submit({
                url: '<?=url_for("falabella/indicadoresGestionExt4")?>'                
            });
        };
    });
    
</script>
<!--<div id="indicadores"></div>-->
<?
for ($i = 1; $i <= 11; $i++) {
    ?>
    <div id="grafica<?=$i?>" class="bigbutton" style="width: 950px; height: 450px; margin: 0 auto">
        <div>
            <img src="/images/clientes/logotipoFalabella1.png" class='iconDetails'>
        </div><br/><br/>
        <div id="container<?=$i?>"  style="width: 950px; height: 350px; margin: 0 auto"></div>
        <hr>
        <div align="center">
            COLTRANS S.A.S - FALABELLA DE COLOMBIA
            <img src="/images/branding/coltrans/logo_left.gif" class='iconDetails' style="float:right;">
        </div>        
    </div><br/><br/><br/><br/><br/>
    <?
}
?>
<div id="grid-datos" style="width: 1000px; margin: 0 auto"></div>

<script>
$("#grid-datos").hide();
    
for ( var i = 1, l = 11; i <= l; i++ ) {
    $("#grafica"+i).hide();
    //$("#grafica"+i).css('background', 'transparent');
}

function imprimir(){    
    $(".esconder").hide();
    $(".mostrar").show();
    $('*').css('background', '#FFFFFF');
    $('.x-panel-header-default-framed-top').css('background', '#157FCC');
    $(".toolbar").hide();
    $(".header").hide();
    $(".footer").hide();
    window.print();
}

function verObservaciones(){

    Ext.onReady(function() {

        Ext.create('Ext.window.Window', {
            title: 'Observaciones',
            height: 300,
            width: 800,
            layout: 'fit',
            closeAction: 'destroy', 
            items: {  // Let's put an empty grid in just to illustrate fit layout
                xtype: 'gObs',                
                border: false
            }
        }).show();

    })   
}
</script>