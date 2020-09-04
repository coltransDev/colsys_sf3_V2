<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($grid as $key => $dataGrid) {
    if ($dataGrid["totRes"])
        $dataJSON[] = array("name" => $dataGrid["sucursal"], "data" => array($dataGrid["totRes"]));
}

if (isset($options["subtitle"]) && $options["subtitle"])
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

<div id="grid1" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>
<p><br/>&nbsp;<br/></p>
<div id="grafica1" class="bigbutton"  style="width: 1050px; height: 350px; margin: 0 auto"></div>

<script>
    Ext.define('Encuesta', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'title', type: 'string'},
            {name: 'idform', type: 'int'},
            {name: 'idsucursal', type: 'string'},
            {name: 'sucursal', type: 'string'},
            {name: 'idcliente', type: 'int'},
            {name: 'idservicio', type: 'int'},
            {name: 'idpregunta', type: 'int'},
            {name: 'totEnv', type: 'int'},
            {name: 'cliEnv', type: 'int'},
            {name: 'totRes', type: 'int'}
        ]
    });

    Ext.onReady(function() {
        Ext.QuickTips.init();

        var store = Ext.create('Ext.data.Store', {
            model: 'Encuesta',
            data: <?= json_encode($sf_data->getRaw("grid")) ?>,
            sorters: {property: 'due', direction: 'ASC'},
            groupField: 'title'
        });

        // Grid 1
        var grid = Ext.create('Ext.grid.Panel', {
            title: 'Encuestas',
            iconCls: 'icon-grid',
            store: store,
            stateful: true,
            stateId: 'stateGrid',
            width: 750,
            height: 380,
            renderTo: 'grid1',
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
                    id: "suc",
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
                    text: 'Total  <br />de Contactos',
                    width: 100,
                    sortable: true,
                    dataIndex: 'totEnv',
                    flex: 20/100,
                    summaryType: "sum",
                    summaryRenderer: function(v, params, data) {
                        return '<span style="font-weight:bold;">' + v + '</span>';
                    }
                },
                {
                    text: 'Total <br />de Empresas<br/>Activas',
                    width: 100,
                    sortable: true, 
                    flex: 20/100,
                    align: 'right',
                    dataIndex: 'cliEnv',
                    summaryType: "sum",
                    summaryRenderer: function(value, params, data) {
                        var idform = '<?= $formulario->getCaId() ?>';
                        var login = '<?= $options["login"] ? "/login/" . $options["login"] : "" ?>';
                        var idcliente = '<?= $options["idcliente"] ? "/idcliente/" . $options["idcliente"] : "" ?>';                        
                        var idsuc = '<?= $options["idsucursal"] ? $options["idsucursal"] : "NA"?>';
                        var url = '<?= url_for("formulario/listaEmpresasEnviadasExt4?ca_id=") ?>' + idform + '/idsucursal/' + idsuc + login + idcliente;                        
                        return '<span style="font-weight:bold;">' + value + ' ' +'<a href="' + url + '" target="_blank"><img src="/images/16x16/report.gif" alt="Ver reporte"/></a></span>';
                    },
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                        var idform = record.data.idform;
                        var idsuc = record.data.idsucursal;
                        var login = '<?= $options["login"] ? "/login/" . $options["login"] : "" ?>';
                        var idcliente = '<?= $options["idcliente"] ? "/idcliente/" . $options["idcliente"] : "" ?>';                         
                        var url = '<?= url_for("formulario/listaEmpresasEnviadasExt4?ca_id=") ?>' + idform + "/idsucursal/" + idsuc + login + idcliente;                        
                        return value + ' ' + '<a href="' + url + '" target="_blank"><img src="/images/16x16/report.gif" alt="Ver reporte"/></a>';
                    },
                },
                {
                    text: 'Empresas <br />encuestadas',
                    width: 100,
                    flex: 20/100,
                    align: 'right',
                    sortable: true,                    
                    dataIndex: 'totRes',
                    summaryType: "sum",
                    summaryRenderer: function(value, params, data) {
                        var idform = '<?= $formulario->getCaId() ?>';
                        var login = '<?= $options["login"] ? "/login/" . $options["login"] : "" ?>';
                        var idcliente = '<?= $options["idcliente"] ? "/idcliente/" . $options["idcliente"] : "" ?>'; 
                        var idservicio = '<?= $options["idservicio"] ? "/seid/" . $options["idservicio"] :"/seid/0"?>';
                        var idpregunta = '<?= $options["idpregunta"] ? "/pid/" . $options["idpregunta"] : "/pid/0"?>';                        
                        var idsuc = '<?= $options["idsucursal"] ? $options["idsucursal"] : "NA"?>';                        
                        var url = '<?= url_for("formulario/contactosExt4?ca_id=") ?>' + idform + '/idsucursal/' + idsuc + login + idcliente + idservicio + idpregunta;                        
                        var url1 = '<?= url_for("formulario/informeResumenExt5?ca_id=") ?>' + idform + '/idsucursal/' + idsuc + login + idcliente + idservicio + idpregunta;                        
                        return '<span style="font-weight:bold;">'+ value + ' ' + '<a href="' + url + '" target="_blank"><img src="/images/16x16/show_complete.png" title="Seguimiento" alt="Seguimientos"/></a>&nbsp<a href="' + url1 + '" target="_blank"><img src="/images/16x16/report.gif" alt="Ver Resumen" title="Ver Resumen"/></a></span>';
                    },
                    renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                        var idform = record.data.idform;
                        var idsuc = record.data.idsucursal;                        
                        var login = '<?= $options["login"] ? "/login/" . $options["login"] : "" ?>';
                        var idcliente = '<?= $options["idcliente"] ? "/idcliente/" . $options["idcliente"] : "" ?>'; 
                        var idservicio = '<?= $options["idservicio"] ? "/seid/" . $options["idservicio"] : "/seid/0"?>';
                        var idpregunta = '<?= $options["idpregunta"] ? "/pid/" . $options["idpregunta"] : "/pid/0" ?>'; 
                        var url = '<?= url_for("formulario/contactosExt4?ca_id=") ?>' + idform + login + idcliente + idservicio + idpregunta + "/idsucursal/" + idsuc;
                        var url1 = '<?= url_for("formulario/informeResumenExt5?ca_id=") ?>' + idform + login + idcliente + idservicio + idpregunta + "/idsucursal/" + idsuc;
                        return value + ' ' + '<a href="' + url + '" target="_blank"><img src="/images/16x16/show_complete.png" title="Seguimientos" alt="Seguimientos"/></a>&nbsp<a href="' + url1 + '" target="_blank"><img src="/images/16x16/report.gif" alt="Ver Resumen" title="Ver Resumen"/></a>';
                    }
                },
            ]
        });
    });

// Gráfica 1
    $(function() {
        var chart;
        $(document).ready(function() {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'grafica1',
                    type: 'column'
                },
                title: {
                    text: 'Total de Encuestas Recibidas por Sucursal'
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
                        text: '# Encuestas'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">Sucursal</span><br>',
                    pointFormat: '<span style="color:{point.color}">{series.name}</span>: <b>{point.y}</b><br/>'
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
                series: <?= json_encode($dataJSON) ?>
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