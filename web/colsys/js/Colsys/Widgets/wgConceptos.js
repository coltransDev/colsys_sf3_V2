Ext.define('Colsys.Widgets.wgConceptos', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.wgConceptos',
  triggerTip: 'Click para limpiar',
  spObj:'',
  mode:'local',
  spForm:'',  
  spExtraParam:'',
  displayField: 'name',
  valueField: 'id',
  minChars:3,
  listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{name}</div></tpl>';
        }
    },
    store: Ext.create('Ext.data.Store', {
        fields: ['id','name'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosConceptos',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip:'Listado de Conceptos',
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
        store.proxy.extraParams = {
            transporte:this.idtransporte,
            impoexpo:this.idimpoexpo,
            costo:this.costo
        }
    }
});
