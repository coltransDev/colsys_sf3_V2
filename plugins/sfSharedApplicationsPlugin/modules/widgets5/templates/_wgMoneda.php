<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

    Ext.define('Ext.colsys.wgMoneda', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.wMoneda',
        triggerTip: 'Click para limpiar',
        store: new Ext.data.Store({
            fields: ['id', 'name'],
            data: <?= json_encode($data) ?>
        }),
        qtip: 'Listado ',
        queryMode: 'local',
        displayField: 'id',
        valueField: 'id',
        forceSelection: true,
        listConfig: {
            loadingText: 'buscando...',
            emptyText: 'No existen registros',
            getInnerTpl: function () {
                return '<tpl for="."><div class="search-item1">{id}</div></tpl>';
            }
        }
    });
</script>