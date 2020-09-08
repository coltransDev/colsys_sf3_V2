Ext.define('Colsys.Widgets.WgTiposcomprobantes', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgTiposcomprobantes',
    triggerTip: 'Click para limpiar',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'comprobante',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'comprobante'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosTipocomprobanteC',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        },
        autoLoad: true
    }),
    qtip: 'Listado ',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><b>{titulo}</b><p><span>{empresa}</span><p><span>{aplicacion}</span></p><p><span>{numeracion}</span></p><tpl if="!activo"><span class="rojo">Inactivo</span></div></tpl></tpl>';
                    
        }
    }
});