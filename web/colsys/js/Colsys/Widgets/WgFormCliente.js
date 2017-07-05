Ext.define('Colsys.Widgets.WgFormCliente', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgFormCliente',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'nombre',
    displayField: 'nombre',
    listeners: {
        afterrender: function(ct, position){         
            {
                this.store.load({
                    params: {
                        tipoCombo: this.tipoCombo
                    }
                });
            }         
        }
    },
    qtip: 'Listado '
});