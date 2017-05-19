Ext.define('Colsys.Widgets.WgTransporte', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgTransporte',
    triggerTip: 'Click para limpiar',
    displayField: 'valor',
    valueField: 'valor',
    store: Ext.create('Ext.data.Store', {
           fields: ['valor'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosTransporte',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            },
            autoLoad: true
   }),
    qtip:'Listado',
     listeners: {
        beforerender: function (ct, position) {
            prefijo = this.prefijo;
            console.log('fasdfsd'+prefijo);
            if (prefijo) {
                store = this.getStore();
                store.proxy.url = prefijo + '/widgets5/datosTransporte';
                store.load();
            }
        }
    },
    queryMode: 'local',
    forceSelection:true,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{valor}</div></tpl>';
        }
    }
});