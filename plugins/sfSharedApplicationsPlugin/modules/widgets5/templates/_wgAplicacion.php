<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

    Ext.define('Ext.colsys.wgAplicacion', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.wAplicacion',
        triggerTip: 'Click para limpiar',
        store: new Ext.data.Store({
            autoLoad: false,
            fields: ['aplicacion'],
            proxy: {
                type: 'ajax',
                url: '<?= url_for('widgets5/datosAplicacionJSON') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }

        }),
        qtip: 'Listado ',
        queryMode: 'local',
        displayField: 'aplicacion',
        valueField: 'aplicacion',
        forceSelection: true,
        listConfig: {
            loadingText: 'buscando...',
            emptyText: 'No existen registros',
            getInnerTpl: function () {
                return '<tpl for="."><div class="search-item1">{aplicacion}</div></tpl>';
            }
        }
    });
</script>