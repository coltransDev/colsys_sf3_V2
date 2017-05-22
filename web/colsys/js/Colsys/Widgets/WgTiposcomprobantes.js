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
    qtip: 'Listado '


});


