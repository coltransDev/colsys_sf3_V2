<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sucursales = $sf_data->getRaw("sucursales");

foreach ($sucursales as $key => $sucursal) {
    if (!$sucursal)
        $serieX[] = "Sin asignar";
    else
        $serieX[] = $sucursal;
}

$grid = $sf_data->getRaw("grid");
ksort($grid);

foreach ($grid as $pregunta => $gridServicio) {
    ksort($gridServicio);
    foreach ($gridServicio as $servicio => $dataSucursal) {
        ksort($dataSucursal);
        foreach ($serieX as $suc) {
            if ($dataSucursal[$suc])
                $data[$pregunta][$servicio]["data"][] = round(($dataSucursal[$suc]["suma"] / $dataSucursal[$suc]["casos"]), 2);
            else
                $data[$pregunta][$servicio]["data"][] = 0;
        }
    }
}

foreach ($data as $pregunta => $gridServicio) {
    foreach ($gridServicio as $servicio => $dataGrid) {
        $dataJSON[$pregunta][] = array("name" => $servicio, "data" => $dataGrid["data"]);
    }
}

if(isset($options["subtitle"]) && $options["subtitle"])
    $subtitle = '<span style="color: #6D869F; font-size:9px;">' . $options["subtitle"] . '</span><br/>';
        
if ($options["login"])
    $subtitle.= 'V:<span style="color: #6D869F; font-size:9px;">' . $options["comercial"] . '</span><br/>';

if ($options["cliente"] && $options["cliente"] != "Escriba el nombre del cliente...")
    $subtitle.='C:<span style="color: #6D869F; font-size:9px;">' . ucwords(strtolower($options["cliente"])) . '</span><br/>';

$i = 5;
foreach ($dataJSON as $pregunta => $gridJSON) {
    $title = '<span style="font-size:14px;">' . $pregunta . '</span><br/>';
    ?>
    <div id="grafica<?= $i ?>"  class="bigbutton" style="width: 1050px; height: 350px; margin: 0 auto; margin-bottom:15px; margin-top: 15px;"></div>

    <script>

        // Gr?fica 4
        $(function() {
            var chart;
            $(document).ready(function() {
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'grafica<?= $i ?>',
                        type: 'column'
                    },
                    title: {
                        text: '<?= $title ?>'
                    },
                    subtitle: {
                        text: '<?=  $formulario->getCaTitulo() ?>'
                    },
                    xAxis: [{
                            categories: <?= json_encode($serieX) ?>
                        }],
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Valor'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        },
                        series: {
                            borderWidth: 0
                        }
                    },
                    series: <?= json_encode($gridJSON) ?>
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
    <?
    $i++;
}?>