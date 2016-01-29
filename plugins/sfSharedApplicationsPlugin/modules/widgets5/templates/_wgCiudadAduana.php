<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">
Ext.define('mdCiudadAduana',{
    extend: 'Ext.data.Model',
    fields: [
            {name: 'idciudad', mapping: 'idciudad'},
            {name: 'ciudad', mapping: 'ciudad'},
            {name: 'trafico', mapping: 'trafico'}
           ]
});
Ext.define('wgCiudadAduana', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wCiudadAdu',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdCiudadAduana',
        proxy: {
        type: 'ajax',
        url: '<?=url_for('widgets/datosCiudadesPaisesAdu')?>',
         reader: {
             type: 'json',
             rootProperty: 'ciudades'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    valueField:'idciudad',
    displayField:'ciudad',
    minChars: 3
});
</script>


