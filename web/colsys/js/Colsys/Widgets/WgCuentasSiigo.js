Ext.define('Colsys.Widgets.WgCuentasSiigo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgCuentasSiigo',
    triggerTip: 'Click para limpiar',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    displayField: 'nombrecuenta',
    valueField: 'codigocuenta',
    store: Ext.create('Ext.data.Store', {
        fields: ['codigocuenta', 'ca_idempresa', 'nombrecuenta', 'naturaleza', 'detallaccostos'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosCuentasSiigo',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        },
        autoLoad: true
    }),
    triggers: {
        clear: {
            cls: 'x-form-clear-trigger',
            handler: function () {
                this.setValue(' ');
            }
        }
    },
    qtip: 'Listado ',
    labelWidth: 60


});



