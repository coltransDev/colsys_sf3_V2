<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$registros = $sf_data->getRaw("registros");
$columns = $sf_data->getRaw("columns");
?>

<table width="1000" align="center">
    <td style="text-align: center">
        <div id="se-list"></div><br>
    </td>
</table>

<script type="text/javascript">
    Ext.define('ModelReport', {
        extend: 'Ext.data.TreeModel',
        fields: [
            {name: 'text', type: 'string'}
        ]
    });

    Ext.onReady(function () {

        Ext.create('Ext.tree.Panel', {
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
                    text: 'Regresar al Menú',
                    handler: function () {
                        document.location = '<?= url_for('reportesGer/reporteReportesDeNegocioExt5') ?>';
                    }
                }],
            renderTo: Ext.get('se-list')
        });
    });
</script>
