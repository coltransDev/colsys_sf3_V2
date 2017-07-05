Ext.define('Colsys.Widgets.WgCargos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgCargos',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'name',
    displayField: 'name',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'name', 'mostrar'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosCargos',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
    }),
    qtip: 'Listado '
});