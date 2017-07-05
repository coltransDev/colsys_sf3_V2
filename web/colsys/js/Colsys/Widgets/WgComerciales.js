Ext.define('Colsys.Widgets.WgComerciales', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgComerciales',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'login',
    displayField: 'nombre',
    store: Ext.create('Ext.data.Store', {
        fields: ['login', 'nombre'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosComerciales',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
    }),
    qtip: 'Listado '
});