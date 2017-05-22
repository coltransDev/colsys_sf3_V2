Ext.define('Colsys.Widgets.WgContactos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgContactos',
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
            url: '/widgets5/datosContactos',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    listeners: {
        afterrender: function (ct, position) {
            //alert(this.idcliente);
            if(this.idcliente!="")
            {
                this.store.load({
                    params: {
                        idcliente: this.idcliente
                    }
                });
            }
        }
    },
    qtip: 'Listado '
});