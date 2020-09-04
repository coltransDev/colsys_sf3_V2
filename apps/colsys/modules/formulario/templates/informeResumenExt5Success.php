<!--<div style="margin-bottom:15px; margin-top: 15px;" align="center"><b><?= html_entity_decode($formulario->getCaMedicion())?></b></div>-->
<table width="98%" align="center">
    <th><h2>Informe Resumen <?= html_entity_decode($formulario->getCaTitulo())?></h2></th>
    <tr>
        <td style="text-align: center">
            <div id="grid"></div><br>
        </td>
    </tr>
</table>

<?
$data = $sf_data->getRaw("data");
        
?>
<script>
    
    var res = Ext.decode('<?=json_encode($data)?>');
    
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Colsys': '/js/Colsys',
            'Ext.ux': '/js/ext5/examples/ux/',
            'Ext': '/js/ext6/classic/classic/src/'
        }
    });

    Ext.require([
        'Ext.ux.IFrame',
        'Ext.ux.form.MultiSelect'
    ]);


    Ext.onReady(function() {
        Ext.QuickTips.init();
        
        Ext.create('Colsys.Informes.PivotGridExporter', {
            id: 'pivotResponse',
            collapsible: false,
            //width: 1000,
            height: 750,
            renderTo: 'grid', 
            selModel: {
                type: 'rowmodel'
            },
            constrainHeader: true,
            startRowGroupsCollapsed: false,
            matrix: {
                store: new Ext.data.Store({
                    fields: res.fields,
                    proxy: {
                        type: 'memory',
                        data: res.datos,
                        reader: {
                            type: 'json'
                        }
                    },
                    autoLoad: true
                }),                
                viewLayoutType: 'tabular',
                calculateAsExcel: true,                
                rowSubTotalsPosition : 'none',
                colGrandTotalsPosition: 'last',
                rowGrandTotalsPosition: 'last',
                leftAxis: res.leftAxis,
                topAxis: res.topAxis,
                aggregate: res.aggregate
            },
            listeners: {
                pivotbuildtotals: function(matrix, totals) {

                    var dataAvg = {},

                        dataMax = {};

                    Ext.Array.each(matrix.model, function(field) {

                        var result,agg;

                        if (field.col && field.agg) {
                            agg = matrix.aggregate.getByKey(field.agg);
                            result = matrix.results.get(matrix.grandTotalKey, field.col);
                            if (result && agg) {
                                dataAvg[field.name] = result.calculateByFn(
                                                        'totalavg', 
                                                        agg.dataIndex, 
                                                        Ext.pivot.Aggregators.avg);
                                dataMax[field.name] = result.calculateByFn(
                                                        'totalmax', 
                                                        agg.dataIndex, 
                                                        Ext.pivot.Aggregators.max);
                            }
                        }
                    });

                    totals.push({
                        title: 'Grand total (Promedio)',
                        values: dataAvg
                    });
                },
                pivotcolumnsbuilt ( matrix, columns, eOpts ){
                    
                    Ext.Array.each(columns, function(column) {
                        header = column.dimension.getConfig('header');
                        Ext.Array.each(res.leftAxis, function(axis) {
                            if(header == axis.header){
                                column.dimension.setConfig ('width', axis.width);
                            }
                        });
                    });
                    
                }
            }
        });
    });
</script>