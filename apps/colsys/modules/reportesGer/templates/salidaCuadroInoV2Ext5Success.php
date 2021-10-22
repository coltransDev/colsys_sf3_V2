<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$columns = $sf_data->getRaw("columns");
$registros = $sf_data->getRaw("registros");
$expor_data = $sf_data->getRaw("expor_data");
$expor_cols = $sf_data->getRaw("expor_cols");

$leftAxis = $sf_data->getRaw("leftAxis");
$topAxis = $sf_data->getRaw("topAxis");
$aggregate = $sf_data->getRaw("aggregate");
?>

<table width="98%" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-list"></div><br>
        </td>
    </tr>
    <tr>
        <td style="text-align: center">
            <div id="se-rspn"></div><br>
        </td>
    </tr>
</table>

<script type="text/javascript">
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            //'Ext.ux': '/js/ext5/examples/ux/',
            //'Ext.ux.exporter': '/js/ext5/examples/ux/exporter/',
            'Colsys': '/js/Colsys',
            'Ext': '/js/ext6/classic/classic/src/'
        }
    });

//    Ext.require([
//        'Ext.grid.plugin.Exporter',
//        'Ext.view.grid.ExporterController'
//    ]);

    Ext.define('ModelReport', {
        extend: 'Ext.data.TreeModel',
        fields: [
            {name: 'text', type: 'string'}
        ]
    });

    Ext.define('ModelExport', {
        extend: 'Ext.data.Model',
        fields: <?= json_encode($expor_cols) ?>
    });

    Ext.create('Ext.Component', {
        id: 'appBox',
        style: {display: 'none'},
        autoEl: {tag: 'div'},
        renderTo: Ext.getBody()
    });

    Ext.onReady(function () {
        Ext.create('Colsys.Informes.PivotGridExporter', {
            id: 'treeResponse',
            title: 'Resumen en Cifras',
            matrix: {
                type: 'local',
                store: new Ext.data.Store({
                    // model: 'ModelExport',
                    fields: <?= json_encode($expor_cols) ?>,
                    proxy: {
                        type: 'memory',
                        data: <?= json_encode($expor_data) ?>,
                        reader: {
                            type: 'json'
                        }
                    },
                    autoLoad: true
                }),
                calculateAsExcel: true,
                colGrandTotalsPosition: 'none',
                rowGrandTotalsPosition: 'last',
                leftAxis: <?= json_encode($leftAxis) ?>,
                topAxis: <?= json_encode($topAxis) ?>,
                aggregate: <?= json_encode($aggregate) ?>
            },

            renderTo: Ext.get('se-rspn')
        });

        Ext.create('Colsys.Informes.TreeGridExporter', {
            id: 'treeReport',
            title: 'Cuadro INO Ver.2',            
            store: new Ext.data.TreeStore({
                model: 'ModelReport',
                proxy: {
                    type: 'memory',
                    data: <?= json_encode($registros) ?>,
                    reader: {
                        type: 'json'
                    }
                },
                listeners: {
                    load: function (treeStore) {
                        var ingresos = costos = deducciones = utilidad = peso = volumen = teus = false;
                        for (var i = 0; i < treeStore.getCount(); i++) {
                            var contador = [];
                            var record = treeStore.getAt(i);
                            var nro = this.nroReferencias(treeStore.getNodeById(record.get('id')), contador);
                            if (record.get('uid')) {
                                record.set('text', record.get('text') + ' (' + nro + ' Refs.)');
                                record.commit();
                            }
                            var nro = this.nroNegocios(treeStore.getNodeById(record.get('id')));
                            if (record.get('uid')) {
                                record.set('hst_ca_doctransporte', 'Cant.: ' + nro);
                                record.commit();
                            }
                            if (!ingresos && !isNaN(record.get('hst_ca_ingresos'))) {
                                ingresos = true;
                            }
                            if (!costos && !isNaN(record.get('hst_ca_costos'))) {
                                costos = true;
                            }
                            if (!deducciones && !isNaN(record.get('hst_ca_deducciones'))) {
                                deducciones = true;
                            }
                            if (!utilidad && !isNaN(record.get('hst_ca_utilidad'))) {
                                utilidad = true;
                            }
                            if (!peso && !isNaN(record.get('hst_ca_peso'))) {
                                peso = true;
                            }
                            if (!volumen && !isNaN(record.get('hst_ca_volumen'))) {
                                volumen = true;
                            }
                            if (!teus && !isNaN(record.get('hst_ca_teus'))) {
                                teus = true;
                            }
                        }
                        if (ingresos) {
                            this.sumColumn('hst_ca_ingresos', treeStore);
                        }
                        if (costos) {
                            this.sumColumn('hst_ca_costos', treeStore);
                        }
                        if (deducciones) {
                            this.sumColumn('hst_ca_deducciones', treeStore);
                        }
                        if (utilidad) {
                            this.sumColumn('hst_ca_utilidad', treeStore);
                        }
                        if (peso) {
                            this.sumColumn('hst_ca_peso', treeStore);
                        }
                        if (volumen) {
                            this.sumColumn('hst_ca_volumen', treeStore);
                        }
                        if (teus) {
                            this.sumColumn('hst_ca_teus', treeStore);
                        }
                    }
                },
                nroReferencias: function (node, contador) {   // Cuenta el número de casos recursivamente
                    if (node.childNodes.length < 1) {
                        if (contador.indexOf(node.get('text')) == -1) {
                            contador.push(node.get('text'));
                            return 1;
                        } else {
                            return 0;
                        }
                    }
                    var nro = 0;
                    for (var i = 0; i < node.childNodes.length; i++) {
                        var child = node.childNodes[i];
                        nro += this.nroReferencias(child, contador);
                    }
                    return nro;
                },
                nroNegocios: function (node) {   // Cuenta el número de casos recursivamente
                    if (node.childNodes.length < 1) {
                        return 1;
                    }
                    var nro = 0;
                    for (var i = 0; i < node.childNodes.length; i++) {
                        var child = node.childNodes[i];
                        nro += this.nroNegocios(child);
                    }
                    return nro;
                },
                sumColumn: function (column, treeStore) {  // Suma la columna
                    for (var i = 0; i < treeStore.getCount(); i++) {
                        var record = treeStore.getAt(i);
                        var sum = this.allSumValues(column, treeStore.getNodeById(record.get('id')));
                        if (record.get('uid')) {
                            record.set(column, sum);
                            record.commit();
                        }
                    }
                },
                allSumValues: function (field, node) {    // Suma la Columna de Ingresos recursivamente
                    if (node.childNodes.length < 1) {
                        return parseFloat(node.get(field));
                    }
                    var sum = 0;
                    for (var i = 0; i < node.childNodes.length; i++) {
                        var child = node.childNodes[i];
                        sum += this.allSumValues(field, child);
                    }
                    return sum;
                }
            }),            
            columns: <?= json_encode($columns) ?>,
            listeners: {
                celldblclick: function (tree, td, cellIndex, record, tr, rowIndex, e, eOpts) {
                    window.open('<?= url_for('/inoF2/indexExt5') ?>' + '/idmaster/' + record.get('mst_ca_idmaster'));
                }
            },
            renderTo: Ext.get('se-list')
        });
    });
</script>
