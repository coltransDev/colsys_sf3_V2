<center>
    <div id="content-div"></div>
</center>

<script>
    Ext.onReady(function () {
        Ext.create('Ext.data.Store', {
            autoLoad: true,
            storeId: 'consultasStore',
            fields: ['fchconsultado', 'tipo_consulta', 'idrespuesta', 'respuesta'],
            proxy: {
                type: 'ajax',
                url: '<?= url_for('ids/consultaWsListaSinte') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                extraParams: {
                    id: '<?= $id ?>',
                    tipoConsulta: '<?= $tipoConsulta ?>'
                }
            }
        });

        Ext.create('Ext.grid.Panel', {
            title: 'Consultas Realizadas al NIT <?=$idalterno?><br /><?=$nombre?>',
            store: Ext.data.StoreManager.lookup('consultasStore'),
            columns: [
                {text: 'Fch.Consultado', dataIndex: 'fchconsultado', flex: 1},
                {text: 'Tipo Consulta', dataIndex: 'tipo_consulta', flex: 1},
                {text: 'Id. Respusta', dataIndex: 'idrespuesta'},
                {text: 'Respusta', dataIndex: 'respuesta'}
            ],
            height: 250,
            width: 600,
            renderTo: 'content-div'
        });
    });
</script>
