Ext.define('Colsys.Widgets.WgCiudadesTrafico', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgCiudadesTrafico',
    triggerTip: 'Click para limpiar',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'name',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'name'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosCiudadesTrafico',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip: 'Listado ',
    listeners: {
        focus: function(ct, position){
            prefijo = this.prefijo;
            trafico = this.trafico;
            store = this.getStore();
            if (prefijo) {
                
                store.proxy.url = prefijo + '/widgets5/datosCiudadesTrafico';
                if(trafico){
                    store.proxy.extraParams = {"trafico": trafico};
                }
                
            }
            store.load();
        }
    }


});
