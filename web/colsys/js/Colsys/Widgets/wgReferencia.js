Ext.define('Colsys.Widgets.wgReferencia', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgReferencia',
    store: new Ext.data.Store(
    {
       //model: 'ClientesModel',       
       fields: [
            {name: 'ca_referencia'},
            {name: 'origen'},
            {name: 'destino'},
            {name: 'idorigen',mapping: 'o_ca_idciudad'},
            {name: 'iddestino',mapping: 'd_ca_idciudad'},
            {name: 'compania',mapping: 'cl_ca_compania'},
            {name: 'idcliente'},
            {name: 'ca_vendedor'},
            {name: 'ca_piezas'},
            {name: 'ca_peso'},
            {name: 'ca_volumen'},
            {name: 'ca_mercancia'},
            {name: 'ca_pedido'}
     ],
       proxy: {
          url: '/widgets5/listaReferencias',    
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
            emptyText: 'Seleccione una Referecia',
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
        };
    }
});