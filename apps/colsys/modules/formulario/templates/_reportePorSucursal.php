<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($grid as $key => $dataGrid) {
    $dataJSON[] = array("name" => $dataGrid["sucursal"], "data" => array($dataGrid["promedio"]));
}

foreach($grid as $g){
    $sumGral += $g["suma"];
    $casosGral += $g["casos"];    
}
$avgGral = round(($sumGral/$casosGral),2);

if(isset($options["subtitle"]) && $options["subtitle"])
    $subtitle = '<span style="color: #6D869F; font-size:9px;">' . $options["subtitle"] . '</span><br/>';
        
if ($options["login"])
    $subtitle.= 'V:<span style="color: #6D869F; font-size:9px;">' . $options["comercial"] . '</span><br/>';

if ($options["cliente"] && $options["cliente"] != "Escriba el nombre del cliente...")
    $subtitle.='C:<span style="color: #6D869F; font-size:9px;">' . ucwords(strtolower($options["cliente"])) . '</span><br/>';

if ($options["idservicio"])
    $subtitle.= 'S:<span style="color: #6D869F; font-size:9px;">' . $servicio->getCaValue() . '</span><br/>';

if (isset($options["idpregunta"]) && $options["idpregunta"])
    $subtitle.= 'P:<span style="color: #6D869F; font-size:9px;">' . $options["pregunta"] . '</span>';

?>
<div id="grid2" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>
<div id="grafica2" class="bigbutton"  style="width: 1050px; height: 350px; margin: 0 auto"></div>

<script>
Ext.define('Resultados', {
    extend: 'Ext.data.Model',        
    fields: [
        {name: 'title', type: 'string'},
        {name: 'idform', type: 'int'},
        {name: 'idsucursal', type: 'string'},
        {name: 'sucursal', type: 'string'},
        {name: 'promedio', type: 'float'}            
    ]
});
    
Ext.onReady(function() {
    Ext.QuickTips.init();

    var store = Ext.create('Ext.data.Store', {
        model: 'Resultados',
        data: <?= json_encode($sf_data->getRaw("grid")) ?>,
        sorters: {property: 'due', direction: 'ASC'},
        groupField: 'title'
    });

    var grid2 = Ext.create('Ext.grid.Panel', {
        title: 'Calificación por Sucursal',
        iconCls: 'icon-grid',
        store: store,
        stateful: true,
        stateId: 'stateGrid',        
        width: 750,
        renderTo: 'grid2',
        viewConfig: {
            stripeRows: true
        },
        features: [{
            id: 'group',               
            ftype: 'summary'
        }],
        columns: [
            {
                text: 'Sucursales',                
                flex: 40/100,                
                sortable: true,
                dataIndex: 'sucursal',
                hideable: false,
                summaryType: 'count',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return ((value === 0 || value > 1) ? '<span style="font-weight:bold;">Todas las Sucursales</span>' : '(1 Sucursal)');
                }
            },
            {
                text: 'Total  <br />Promedio',
                sortable: true,                
                dataIndex: 'promedio',
                flex: 40/100,
                summaryType: "average",
                summaryRenderer: function(v, params, data) {
                    return '<span style="font-weight:bold;">'+<?=$avgGral?>+'</span>';
                }
            }
        ]

    });
});

 // Gráfica 2
$(function() {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
            renderTo: 'grafica2',
            type: 'column'
        },
        title: {
                text: 'Promedio x Sucursal'
        },
        subtitle: {
                text: '<?= $formulario->getCaTitulo() ?>'
        },
        xAxis: {
            categories: ['']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Valor'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">Sucursal</span><br>',
            pointFormat: '<span style="color:{point.color}">{series.name}</span>: <b>{point.y}</b><br/>',                
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        series: <?= json_encode($dataJSON)?>
        });
        <? if ($subtitle) { ?>
            var text = chart.renderer.text('<?= $subtitle ?>',
                    800, 65).
                    css({
                        width: 240,
                        color: 'blue',
                        textAlign: 'right',
                        fontSize: '10px',
                        background: 'black'
                    }).attr({
                zIndex: 999
            }).add();

            var box = text.getBBox();
            chart.renderer.rect(box.x - 5, box.y - 5, box.width + 10, box.height + 10, 5)
                    .attr({
                        fill: '#FFFFEF',
                        stroke: 'gray',
                        'stroke-width': 1,
                        zIndex: 4
                    })
                .add();
        <? } ?>
    });
});
</script>