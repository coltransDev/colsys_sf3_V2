Ext.define('Colsys.Widgets.WgFormRadicacion', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgFormRadicacion',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'valor',
    displayField: 'nombre',
    listeners: {
        afterrender: function (ct, position) {
            {
                this.store.load({
                    params: {
                        tipoCombo: this.tipoCombo
                    }
                });
            }
        }
    },
    qtip: 'Concepto de Radicación '
});