<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript">
Ext.define('Ext.colsys.wgReferencia', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wReferencia',
    store: new Ext.data.Store(
    {
       //model: 'ClientesModel',       
       fields: [
        {name: 'ca_referencia',mapping: 'm_ca_referencia'},
			{name: 'origen',mapping: 'o_ca_ciudad'},
            {name: 'destino',mapping: 'd_ca_ciudad'},
            {name: 'idorigen',mapping: 'o_ca_idciudad'},
			{name: 'iddestino',mapping: 'd_ca_idciudad'},
            {name: 'compania',mapping: 'cl_ca_compania'},
            {name: 'idcliente',mapping: 'm_ca_idcliente'},
			{name: 'ca_vendedor',mapping: 'm_ca_vendedor'},
			{name: 'ca_piezas',mapping: 'm_ca_piezas'},
			{name: 'ca_peso',mapping: 'm_ca_peso'},
            {name: 'ca_volumen',mapping: 'm_ca_volumen'},
			{name: 'ca_mercancia',mapping: 'm_ca_mercancia'}
     ],
       proxy: {
          url: '<?=url_for('widgets/listaReferencias')?>',    
          type: 'ajax',
          reader: 
          {
             root: 'root',
             totalProperty: 'totalCount',
             id: 'id',
             type: 'json'
          }
       }
    }),
    valueField:'ca_referencia',
    displayField:'ca_referencia',
    typeAhead: false,
    loadingText: 'buscando...',
    triggerAction: 'all',     
    selectOnFocus: true,
    allowBlank: false,
    enableKeyEvents: true,
    minChars: 3,
    listConfig: {
                loadingText: 'buscando...',
                emptyText: 'No matching posts found.',

                // Custom rendering template for each item
                getInnerTpl: function() {
                    return '<tpl for="."><div class="search-item"><strong>{ca_referencia}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>';
                }
            },
    initComponent: function() {
        var me = this;
 
        Ext.applyIf(me, {
            emptyText: 'Seleccione una Referecias',
            loadingText: 'Loading...',
            store: {type: 'roletemplatesremote'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function(store) {
        store.proxy.extraParams = {
            impoexpo: this.impoexpo,
            transporte: this.transporte
        }
    }
});

</script>

