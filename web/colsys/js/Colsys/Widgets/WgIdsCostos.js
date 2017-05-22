Ext.define('Colsys.Widgets.WgIdsCostos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgIdsCostos',
    store: new Ext.data.Store(
    {
       fields: [
        {name: 'idalterno'},
        {name: 'nombre'},
        {name: 'id'}
     ],
       proxy: {
          url: '/widgets5/datosIdsCostos',
          type: 'ajax',
          autoLoad: true,
          reader: 
          {
             root: 'root',
             totalProperty: 'totalCount',
             id: 'id',
             type: 'json'
          }
       }
    }),
     displayField: 'nombre',
     valueField: 'id',
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',
     hiddenName: 'idalterno',
     name: 'idalterno',
     id: 'idalterno',
     //fieldLabel: 'Cliente',
     selectOnFocus: true,     
     enableKeyEvents: true,
     minChars: 4,
     //labelWidth: 50,
     initComponent: function() {
        var me = this; 
        Ext.applyIf(me, {
            emptyText: 'Seleccione un concepto',
            loadingText: 'Loading...',
            store: {type: 'roletemplateslocal'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function(store) {
    
    },
    setIdempresa: function(idempresa)
    {
        //this.idempresa=idempresa;
    }
     ,
     listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1"><b>{nombre}</b><br>Nit: {idalterno}</div></tpl>';
        }
    }
     
});