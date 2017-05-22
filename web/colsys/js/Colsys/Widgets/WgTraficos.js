Ext.define('Colsys.Widgets.WgTraficos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgTraficos',
    triggerTip: 'Click para limpiar',
    spObj: '',
    queryMode: 'local',
    spForm: '',
    spExtraParam: '',
    displayField: 'name',
    valueField: 'id',
    minChars: 3,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function () {
            return '<tpl for="."><div class="search-item1">{name}</div></tpl>';
        }
    },
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'name'],
        proxy: {
            type: 'ajax',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip: 'Listado de Conceptos',
    listeners: {
        beforerender: function (ct, position) {
            prefijo = this.prefijo;
            if (prefijo) {
                store = this.getStore();
                store.proxy.url = prefijo + '/widgets5/datosTraficos';
                store.load();
            }
        }
    },
    initComponent: function () {
        var me = this;
        Ext.applyIf(me, {
            emptyText: 'Seleccione un Pais',
            loadingText: 'Loading...',
            store: {type: 'roletemplateslocal'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
    beforeTemplateLoad: function (store) {

    }
});
