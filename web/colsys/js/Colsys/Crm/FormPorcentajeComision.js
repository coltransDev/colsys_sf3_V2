Ext.define('Empresa', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-empresa',
    store: Ext.create('Ext.data.Store', {
        fields: ['abbr', 'name'],
        data: [
            {"abbr": "Coltrans", "name": "Coltrans"},
            {"abbr": "Colmas", "name": "Colmas"},
            {"abbr": "ColOTM", "name": "ColOTM"},
            {"abbr": "Coldepositos", "name": "Coldepositos"}
        ]
    })
});

Ext.define('Colsys.Crm.FormPorcentajeComision', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormPorcentajeComision',
    bodyPadding: 5,
    id: 'FormPorcentaje',
    name: 'FormPorcentaje',
    layout: 'column',
    autoHeight: true,
    autoScroll: false,
    defaults: {
        columnWidth: 1,
        //bodyStyle:'padding:30',
        style: "text-align: left",
        labelAlign: 'right'
    },
    buttons: [{
            text: 'Guardar',
            formBind: true,
            handler: function () {
                var idcliente = this.up('form').idcliente;
                var form = this.up('form').getForm();
                var data = form.getFieldValues();

                if (form.isValid()) {

                    if (data.inicio >= data.fin) {
                        Ext.MessageBox.alert("Error", 'Error en la fechas de vigencia del Documento');
                        return;
                    }

                    form.submit({
                        url: '/crm/guardarPorcentajeComision',
                        waitMsg: 'Guardando',
                        params: {
                            idcliente: idcliente
                        },
                        success: function (response, options) {
                            Ext.getCmp("winFormEdit").destroy();
                            Ext.Msg.alert("Porcentaje de comisi&oacute;n", "Datos almacenados correctamente");
                            Ext.getCmp("gridPorcetajeComision" + idcliente).getStore().reload();
                        },
                        failure: function (form, action) {
                            Ext.Msg.alert("Porcentaje de comisi&oacute;n", "Error en guardar " + action.result.errorInfo + "</ br>");
                        }
                    });
                }
            }
        }],
    listeners: {
        afterrender: function (me, eOpts) {
            this.add({
                xtype: 'fieldset',
                height: 110,
                width: 550,
                columnWidth: 1,
                layout: 'column',
//            columns: 2,
                defaults: {
                    columnWidth: 0.5,
                    bodyStyle: 'padding:4px',
                    allowBlank: false
                },
                items: [
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Inicio',
                        name: 'inicio',
                        id: "inicio",
                        columnWidth: 0.8,
                        format: 'Y-m-d',
                        submitFormat: 'Y-m-d'
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Fin',
                        name: 'fin',
                        id: "fin",
                        columnWidth: 0.8,
                        format: 'Y-m-d',
                        submitFormat: 'Y-m-d'
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        xtype: 'numberfield',
                        fieldLabel: 'Porcentaje',
                        name: 'porcentaje',
                        id: "porcentaje",
                        columnWidth: 0.5
                    },
                    {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    },
                    {
                        fieldLabel: 'Empresa',
                        xtype: 'combo-empresa',
                        id: 'empresa',
                        name: 'empresa',
                        displayField: 'name',
                        columnWidth: 0.8,
                        valueField: 'abbr'
                    }
                ]});
        }
    }

});