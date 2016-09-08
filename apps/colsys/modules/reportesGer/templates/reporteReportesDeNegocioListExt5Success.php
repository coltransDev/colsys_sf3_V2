<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$registros = $sf_data->getRaw("registros");
$columns = $sf_data->getRaw("columns");
$params = $sf_data->getRaw("params");
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

    Ext.create('Ext.Component', {
        id: 'appBox',
        style: {display: 'none'},
        autoEl: {tag: 'div'},
        renderTo: Ext.getBody()
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
                    text: 'Exportar a Excel ',
                    handler: function () {
                        Ext.create('Ext.panel.Panel', {
                            layout: 'fit',
                            renderTo: Ext.get('appBox'),
                            items: [{
                                    xtype: 'component',
                                    autoEl: {tag: 'iframe', name: 'myIframe'}
                                }, {
                                    xtype: 'form', hidden: true,
                                    listeners: {
                                        afterrender: function (form) {
                                            form.getForm().doAction('standardsubmit', {
                                                target: 'myIframe', method: 'POST',
                                                url: '<?= url_for("reportesGer/reporteReportesDeNegocioListExt5") ?>',
                                                params: {
                                                    anio: '<?=$params["anio"]?>',
                                                    mes: '<?=$params["mes"]?>',
                                                    trafico: '<?=$params["trafico"]?>',
                                                    impoexpo: '<?=$params["impoexpo"]?>',
                                                    transporte: '<?=$params["transporte"]?>',
                                                    sucursal: '<?=$params["sucursal"]?>',
                                                    vendedor: '<?=$params["vendedor"]?>',
                                                    destino: '<?=$params["destino"]?>',
                                                    modalidad: '<?=$params["modalidad"]?>',
                                                    cliente: '<?=$params["cliente"]?>',
                                                    agente: '<?=$params["agente"]?>',
                                                    transportista: '<?=$params["transportista"]?>',
                                                    fchRepIni: '<?=$params["fchRepIni"]?>',
                                                    fchRepFin: '<?=$params["fchRepFin"]?>',
                                                    fchEtdIni: '<?=$params["fchEtdIni"]?>',
                                                    fchEtdFin: '<?=$params["fchEtdFin"]?>',
                                                    fchCnfIni: '<?=$params["fchCnfIni"]?>',
                                                    fchCnfFin: '<?=$params["fchCnfFin"]?>',
                                                    filters: JSON.stringify(<?=$params["filters"]?>),
                                                    columns: JSON.stringify(<?=$params["columns"]?>),
                                                    expoExcel: true
                                                },
                                            });
                                        }
                                    }
                                }]
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
