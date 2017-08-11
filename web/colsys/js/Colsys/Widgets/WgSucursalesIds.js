Ext.define('Colsys.Widgets.WgSucursalesIds', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgSucursalesIds',
    triggerTip: 'Click para limpiar',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'idsucursal',
    displayField: 'sucursal',
    store: Ext.create('Ext.data.Store', {
        fields: ['idsucursal', 'sucursal', 'ciudad'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosIdsSucursales',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip: 'Listado ',
    listeners: {
        beforerender: function (ct, position) {
            empresa = this.empresa;
            if (this.prefijo) {
                this.store.proxy.url = this.prefijo + '/widgets5/datosIdsSucursales';
            }
            if (empresa) {
                this.getStore().load({
                    params: {
                        empresa: empresa
                    }
                });
            }
        }
    }
});
