Ext.define('Colsys.Widgets.WgTipoPersona', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgTipoPersona',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'tipo',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'tipo'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosTipoPersona',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
    }),
    qtip: 'Listado '
});