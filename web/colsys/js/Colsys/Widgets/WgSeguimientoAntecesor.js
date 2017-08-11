Ext.define('Colsys.Widgets.WgSeguimientoAntecesor', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgSeguimientoAntecesor',
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
            url: '/widgets5/SeguimientoAntecesor',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: true
    }),
    listeners: {
        focus: function(ct, position){         
            if(this.load==false || this.load=="undefined" || !this.load)
            {
                this.store.reload({
                    params: {
                        idcliente: this.idcliente
                    }
                });
                this.load=true;
            }         
        }
    },
    qtip: 'Listado'
});