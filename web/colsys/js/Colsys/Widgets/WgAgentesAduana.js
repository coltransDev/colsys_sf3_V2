Ext.define('Colsys.Widgets.WgAgentesAduana', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgAgentesAduana',
    triggerTip: 'Click para limpiar',
    spObj: '',
    spForm: '',
    queryMode: 'local',
    displayField: 'nombre',
    valueField: 'id',
    hiddenValue: 'id',
    labelWidth: '100',
    spExtraParam: '',
    store: new Ext.data.Store({
        fields: ['id', 'nombre'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosAgentesAduana',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
//        data : ''
    }),
    qtip: 'Listado '
});