comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('Colsys.Crm.FormBeneficioCredito', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormBeneficioCredito',
    bodyPadding: 5,
    id: 'FormBeneficioCredito',
    name: 'FormBeneficioCredito',
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

                    form.submit({
                        url: '/crm/guardarBeneficioCredito',
                        waitMsg: 'Guardando',
                        params: {
                            idcliente: idcliente
                        },
                        success: function (response, options) {
                            Ext.getCmp("winFormEdit").destroy();
                            Ext.Msg.alert("Beneficios Crediticios", "Datos almacenados correctamente");
                            Ext.getCmp("gridBeneficioCredito" + idcliente).getStore().reload();
                        },
                        failure: function (form, action) {
                            Ext.Msg.alert("Beneficios Crediticios", "Error en guardar " + action.result.errorInfo + "</ br>");
                        }
                    });
                }
            }
        }],
    listeners: {
        afterrender: function (me, eOpts) {
            this.add({
                xtype: 'fieldset',
                height: 120,
                width: 550,
                columnWidth: 1,
                layout: 'column',
//            columns: 2,
                defaults: {
                    columnWidth: 0.5,
                    bodyStyle: 'padding:4px',
                    allowBlank: false
                },
                items: [{
                        xtype: 'hiddenfield',
                        name: 'idcredito'
                    }, {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    }, {
                        xtype: 'numberfield',
                        fieldLabel: 'Cupo de Cr&eacute;dito',
                        name: 'cupo',
                        id: "cupo",
                        columnWidth: 0.75,
                        thousandSeparator: '.',
                        decimalSeparator: ',',
                        renderer: Ext.util.Format.numberRenderer('0,000'),
                        hideTrigger: true,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false
                    }, {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    }, {
                        xtype: 'numberfield',
                        fieldLabel: 'D&iacute;as de Cr&eacute;dito',
                        name: 'dias',
                        id: "dias",
                        columnWidth: 0.5,
                        hideTrigger: true,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false
                    }, {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    }, {
                        xtype: 'Colsys.Widgets.wgEmpresas',
                        fieldLabel: 'Empresa',
                        name: 'idempresa',
                        id: "idempresa",
                        renderer: comboBoxRenderer(this),
                        columnWidth: 1
                    }, {
                        xtype: 'tbspacer',
                        height: 25,
                        columnWidth: 1
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Observaciones',
                        name: 'observaciones',
                        id: "observaciones",
                        columnWidth: 1
                    }
                ]
            });
            
            if (me.idcredito) {
                form = me.getForm();
                form.load({
                    url: '/crm/datosUnBeneficioCredito',
                    params: {
                        idCredito: me.idcredito
                    }
                });
            }
        }
    }

});