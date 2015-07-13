<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$data = $sf_data->getRaw("data");


?>


<script type="text/javascript">

Ext.define('Ext.colsys.wgParametro', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wParametro',
    triggerTip: 'Click para limpiar',
    spObj:'',
    spForm:'',  
    queryMode: 'local',
    displayField: 'name',
    valueField: 'id',
    labelWidth: '100',
    spExtraParam:'',
    store: new Ext.data.Store( {
        fields: ['id','name','caso_uso'],
        data : <?=json_encode($data )?>
    })   
    ,
    qtip:'Listado ',
    labelWidth: 60,    
    onFocus: function( field, newVal, oldVal ){
        this.store.filter('caso_uso', this.caso_uso, true, true);
    }
});
</script>