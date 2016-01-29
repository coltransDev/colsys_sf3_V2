<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">


Ext.define('mdTercero',{
    extend: 'Ext.data.Model',
    fields: [
        {name: 'idtercero', mapping: 't_ca_idtercero'},
            {name: 'nombre', mapping: 't_ca_nombre'},
            {name: 'ciudad', mapping: 'c_ca_ciudad'},
            {name: 'pais', mapping: 'p_ca_nombre'},
            {name: 'direccion', mapping: 't_ca_direccion'},
            {name: 'contacto', mapping: 't_ca_contacto'},
            {name: 'idreporte'}
    ]
});
Ext.define('Ext.colsys.wgTercero', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wTercero',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdTercero',
        proxy: {
        type: 'ajax',
        url: '<?=url_for('widgets/listaTercerosJSON')?>',
         reader: {
             type: 'json',
             rootProperty: 'terceros'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    queryMode: 'remote',
    valueField:'idtercero',
    displayField:'nombre',
    minChars: 3/*,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{compania}</strong><br /><span><br />{nombre_ven}</span> </div></tpl>';
        }
    }*/
});
</script>