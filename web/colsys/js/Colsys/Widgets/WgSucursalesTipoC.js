Ext.define('Colsys.Widgets.WgSucursalesEmpresa', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgSucursalesEmpresa',
    triggerTip: 'Click para limpiar',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'sucursal',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'sucursal','idempresa','empresa'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosSucursalesEmpresa',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip: 'Listado ',
    listeners: {
        beforerender: function(ct, position){
            empresa = this.empresa;
            this.getStore().load({
                params: {
                    empresa: empresa
                }
            });
        }
    }
    //labelWidth: 60


});
