<div style="margin-bottom:15px; margin-top: 15px;" align="center"><b><?= html_entity_decode($formulario->getCaMedicion())?></b></div>
<div id="grid" style="margin-bottom:15px; margin-top: 15px;" align="center"></div>
<script>
    var res = '<?=$sf_data->getRaw("data")?>'
    
    console.log(res);

    Ext.onReady(function() {
        Ext.QuickTips.init();

        Ext.create('Colsys.Informes.PivotGridExporter', {
            id: 'pivotResponse',
            collapsible: false,
            renderTo: 'grid',
            matrix: {
                store: new Ext.data.Store({
                    fields: res.data.fields,
                    proxy: {
                        type: 'memory',
                        data: res.data.datos,
                        reader: {
                            type: 'json'
                        }
                    },
                    autoLoad: true
                }),
                calculateAsExcel: true,
                colGrandTotalsPosition: 'none',
                rowGrandTotalsPosition: 'last',
                leftAxis: res.data.leftAxis,
                topAxis: res.data.topAxis,
                aggregate: res.data.aggregate
            }
        });
    });
</script>