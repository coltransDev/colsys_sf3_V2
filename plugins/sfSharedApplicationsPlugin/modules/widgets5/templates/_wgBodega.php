<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">


Ext.define('mdBodega',{
    extend: 'Ext.data.Model',
    fields: [
        {name: 'idbodega'},
        {name: 'tipo'},
        {name: 'transporte'},
        {name: 'nombre'},
        {name: 'identificacion'},
        {name: 'direccion'}
    ]
});
Ext.define('Ext.colsys.wgBodega', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wBodega',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdBodega',
        proxy: {
        type: 'ajax',
        url: '<?=url_for('widgets5/listaBodegasJSON')?>',
         reader: {
             type: 'json',
             rootProperty: 'root'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    queryMode: 'remote',
    valueField: 'idbodega',
    displayField: 'nombre',
    minChars: 3,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><b>{nombre}/ {tipo} - Nit:{identificacion}</b><br /><span> <br />{direccion}</span> </div></tpl>';
        }
    }
});
</script>