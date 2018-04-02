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
?>

<table width="1000" align="center">
    <td style="text-align: center">
        <div id="se-list"></div><br>
    </td>
</table>

<script type="text/javascript">
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Ext.ux': '/js/ext5/examples/ux/',
            'Ext.ux.exporter': '/js/ext5/examples/ux/exporter/'
        }
    });

    Ext.require([
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer'
    ]);

    Ext.define('ModelReport', {
        extend: 'Ext.data.TreeModel',
        fields: [
            {name: 'text', type: 'string'}
        ]
    });

    Ext.create('Ext.Component', {
        id: 'appBox',
        style: {display: 'none'},
        autoEl: {tag: 'div'},
        renderTo: Ext.getBody()
    });

    Ext.onReady(function () {

        Ext.create('Ext.tree.Panel', {
            id: 'treeReport',
            title: 'Informe sobre Reportes de Negocio',
            rootVisible: false,
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
                        var equipos = false;
                        for (var i = 0; i < treeStore.getCount(); i++) {
                            var record = treeStore.getAt(i);
                            var nro = this.allDescendants(treeStore.getNodeById(record.get('id')));
                            if (record.get('uid')) {
                                record.set('text', record.get('text') + ' (' + nro + ')');
                                record.commit();
                            }
                            if (!equipos && !isNaN(record.get('equipos'))) {
                                equipos = true;
                            }
                        }
                        if (equipos) {
                            for (var i = 0; i < treeStore.getCount(); i++) {
                                var record = treeStore.getAt(i);
                                var cnt = this.allContainers(treeStore.getNodeById(record.get('id')));
                                if (record.get('uid')) {
                                    record.set('equipos', cnt + ' equipos');
                                    record.commit();
                                }
                            }
                            for (var i = 0; i < treeStore.getCount(); i++) {
                                var record = treeStore.getAt(i);
                                var cbm = this.allVolumes(treeStore.getNodeById(record.get('id')));
                                if (record.get('uid')) {
                                    record.set('volumen', cbm.toFixed(2) + ' M³');
                                    record.commit();
                                }
                            }
                            for (var i = 0; i < treeStore.getCount(); i++) {
                                var record = treeStore.getAt(i);
                                var cbm = this.allWeights(treeStore.getNodeById(record.get('id')));
                                if (record.get('uid')) {
                                    record.set('peso', cbm.toFixed(2) + ' Kgs');
                                    record.commit();
                                }
                            }
                        }

                    }
                },
                allDescendants: function (node) {   // Cuenta el número de casos recursivamente
                    if (node.childNodes.length < 1) {
                        return 1;
                    }
                    var nro = 0;
                    for (var i = 0; i < node.childNodes.length; i++) {
                        var child = node.childNodes[i];
                        nro += this.allDescendants(child);
                    }
                    return nro;
                },
                allContainers: function (node) {    // Cuenta el número de equipos recursivamente
                    if (node.childNodes.length < 1) {
                        var x = 0;
                        var rec = node.data.equipos.split("<br />");
                        for (i = 0; i < rec.length; i++) {
                            var cmp = rec[i].split(" ");
                            if (!isNaN(parseFloat(cmp[3]))) {
                                x += parseFloat(cmp[3]);
                            }
                        }
                        return x;
                    }
                    var cnt = 0;
                    for (var i = 0; i < node.childNodes.length; i++) {
                        var child = node.childNodes[i];
                        cnt += this.allContainers(child);
                    }
                    return cnt;
                },
                allVolumes: function (node) {    // Suma la columna de Volumenes recursivamente
                    if (node.childNodes.length < 1) {
                        var x = 0;
                        if (node.data.volumen) {
                            var cmp = node.data.volumen.split(" ");
                            if (!isNaN(parseFloat(cmp[0]))) {
                                x = parseFloat(cmp[0]);
                            }
                        }
                        return x;
                    }
                    var cbm = 0;
                    for (var i = 0; i < node.childNodes.length; i++) {
                        var child = node.childNodes[i];
                        cbm += this.allVolumes(child);
                    }
                    return cbm;
                },
                allWeights: function (node) {    // Suma la columna de Pesos recursivamente
                    if (node.childNodes.length < 1) {
                        var x = 0;
                        if (node.data.peso) {
                            var cmp = node.data.peso.split(" ");
                            if (!isNaN(parseFloat(cmp[0]))) {
                                x = parseFloat(cmp[0]);
                            }
                        }
                        return x;
                    }
                    var wgh = 0;
                    for (var i = 0; i < node.childNodes.length; i++) {
                        var child = node.childNodes[i];
                        wgh += this.allWeights(child);
                    }
                    return wgh;
                }
            }),
            plugins: [{
                    ptype: 'bufferedrenderer'
                }],
            columns: <?= json_encode($columns) ?>,
            columnLines: true,
            height: 800,
            width: 1200,
            listeners: {
                celldblclick: function (tree, td, cellIndex, record, tr, rowIndex, e, eOpts) {
                    window.open('<?= url_for('/reportes/verReporte') ?>' + '/id/' + record.get('rp_ca_idreporte'));
                }
            },
            buttons: [{
                    xtype: 'exporterbutton',
                    text: 'Exportar a Excel ',
                    iconCls: 'csv',
                    format: 'excel',
                    listeners: {
                        beforerender: function (button, e, eOpts) {
                            Ext.define('ModelExport', {
                                extend: 'Ext.data.Model',
                                fields: <?= json_encode($expor_cols) ?>
                            });

                            store = new Ext.data.Store({
                                model: 'ModelExport',
                                data: <?= json_encode($expor_data) ?>
                            });
                            button.store = store;
                        }
                    },
                    traverse: function (node) {
                        me = this;
                        // do something with node
                        if (node.hasChildNodes()) {
                            if (node.get('text') != 'Root') {
                                // console.log(node.get('text'));
                            }
                        } else {
                            console.log(node.data);
                        }

                        node.eachChild(function (child) {
                            me.traverse(child); // handle the child recursively
                        });
                    }
                }, {
                    text: 'Regresar al Menú',
                    handler: function () {
                        document.location = '<?= url_for('reportesGer/reporteReportesDeNegocioExt5') ?>';
                    }
                }],
            renderTo: Ext.get('se-list')
        });
    });
</script>
