Ext.define('Colsys.Widgets.WgSectorEconomico', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgSectorEconomico',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'sector',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'sector'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosSectorEconomico',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
    }),
    qtip: 'Listado '
});