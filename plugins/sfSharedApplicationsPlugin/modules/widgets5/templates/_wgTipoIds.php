<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

    Ext.define('Ext.colsys.wgTipoIds', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.wTipoIds',
        triggerTip: 'Click para limpiar',
        store: new Ext.data.Store({
            fields: ['tipo', 'nombre', 'aplicacion'],
            data: <?= json_encode($data) ?>
        }),
        qtip: 'Listado ',
        queryMode: 'local',
        displayField: 'nombre',
        valueField: 'id',
        //labelWidth: 60,
        listConfig: {
            loadingText: 'buscando...',
            emptyText: 'No existen registros',
            getInnerTpl: function () {
                return '<tpl for="."><div class="search-item1">{nombre}</div></tpl>';
            }
        },
        onRender: function (ct, position) {
            //this.store.load();
            this.store.proxy.extraParams = {
                aplicacion: this.aplicacion
            }
            Ext.colsys.wgReporte.superclass.onRender.call(this, ct, position);
        }

    });
</script>