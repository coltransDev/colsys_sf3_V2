<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

Ext.define('Ext.colsys.wgTipoComprobante', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wTipoComprobante',
    triggerTip: 'Click para limpiar',    
    store: new Ext.data.Store( {
       fields: ['id','name','idempresa'],
       data : <?=json_encode($data )?>
      }),
    qtip:'Listado ',
    queryMode: 'local',
    displayField: 'name',
    valueField: 'id',
  //labelWidth: 60,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{name}</div></tpl>';
        }
    }
});
</script>