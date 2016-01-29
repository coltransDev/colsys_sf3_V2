<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$data = $sf_data->getRaw("data");
//echo "<pre>".print_r($data)."</pre>";
?>
<script type="text/javascript">
Ext.define('mdProveedorAduana',{
    extend: 'Ext.data.Model',
    fields: [
            {name: 'idproveedor', mapping: 'idproveedor'},
            {name: 'nomproveedor', mapping: 'nombreproveedor'},
            {name: 'idciudad',mapping: 'idciudad'},
            {name: 'ciudad',mapping: 'ciudad'}
   ]
});
Ext.define('wgProveedorAduana', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wProveedor',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdProveedorAduana',
        proxy: {
        type: 'ajax',
        url: '<?=url_for('widgets/listaProveedorAduanasJSON')?>',
         reader: {
             type: 'json',
             rootProperty: 'proveedores'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    queryMode: 'remote',
    valueField:'idproveedor',
    displayField:'nomproveedor',
    minChars: 3
});
</script>
