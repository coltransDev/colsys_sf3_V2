Ext.define('Colsys.Widgets.WgRegimen', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgRegimen',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'regimen',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'regimen'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosRegimen',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
    }),
    qtip: 'Listado '
});