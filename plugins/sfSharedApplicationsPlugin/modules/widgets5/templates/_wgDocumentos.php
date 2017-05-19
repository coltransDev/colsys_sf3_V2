<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

/*Ext.define('mdDocs',{
    extend: 'Ext.data.Model',
    fields: [
        { name: 'id', type: 'string' },
        { name: 'name', type: 'string' },
        { name: 'idsserie', type: 'string' }
    ]
});*/

Ext.define('wgDocumentos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wDocumentos',
    allowBlank: false,
    queryMode: 'local',
    valueField: 'id',
    displayField: 'name',
    fieldLabel: 'Documento',
    store: new Ext.data.Store( {
       fields: ['id','name','idsserie'],
       data : <?=json_encode($data )?>
      }),
    qtip:'Listado de Series TRD',
    /*onRender: function(ct, position){

        if(!this.idsserie)
         {
             this.idsserie=Ext.getCmp(this.linkSerie).getValue();
         }

        this.store.load({
            params : {
                idsserie : this.idsserie
            }
        });

        wgDocumentos.superclass.onRender.call(this, ct, position);            
    },*/
    onFocus: function( field, newVal, oldVal ){
        if(this.linkSerie)
        {
            if(Ext.getCmp(this.linkSerie))
                this.idsserie=Ext.getCmp(this.linkSerie).getValue();
        }
            
        this.store.filter('idsserie', this.idsserie, true, true);
    }
});

</script>