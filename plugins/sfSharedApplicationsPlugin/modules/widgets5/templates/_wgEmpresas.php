<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

Ext.define('wgEmpresas', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wempresas',
    triggerTip: 'Click para limpiar',    
    queryMode: 'local',
    valueField: 'id',
    displayField: 'name',
    //fieldLabel: 'Documento',
    store: new Ext.data.Store( {
        fields: ['id','name'],
        data : <?=json_encode($data )?>
    }),
    qtip:'Listado de Empresas',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{name}</div></tpl>';
        }
    }
    
});

</script>