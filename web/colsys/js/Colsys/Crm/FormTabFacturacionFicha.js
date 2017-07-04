Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('Colsys.Crm.FormTabFacturacionFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabFacturacionFicha',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        hideLabel: true,
                        title: 'Facturaci&oacute;n',
                        width: 650,
                        height: 380,
                        collapsible: false,
                        defaults: {
                            labelWidth: 89,
                            anchor: '90%',
                            layout: {
                                type: 'column',
                                defaultMargins: {top: 0, right: 25, bottom: 0, left: 25}
                            }},
                        items: [{
                                xtype: 'fieldset',
                                hideLabel: true,
                                width: 620,
                                height: 350,
                                collapsible: false,
                                defaults: {
                                    labelWidth: 89,
                                    anchor: '90%',
                                    layout: {
                                        type: 'column',
                                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                    }},
                                items: [{
                                        xtype: 'fieldcontainer',
                                        hideLabel: false,
                                        combineErrors: true,
                                        height: 380,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        columnWidth: 1,
                                        defaults: {
                                            columnWidth: 0.495,
                                            bodyStyle: 'padding:4px'
                                        },
                                        items: [{
                                                xtype: 'tbspacer',
                                                height: 60,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'textfield',
                                                name: 'fechascierreF',
                                                fieldLabel: 'Fechas de Cierre',
                                                width: 500,
                                                labelWidth: 150,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'textfield',
                                                name: 'soportesF',
                                                fieldLabel: 'Soportes facturaci&oacute;n nacionalizaci&oacute;n',
                                                width: 500,
                                                labelWidth: 150,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'textfield',
                                                name: 'plazoF',
                                                fieldLabel: 'Plazo facturaci&oacute;n vs Despacho/Embarque',
                                                width: 500,
                                                labelWidth: 150,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'creditoF',
                                                fieldLabel: 'Cr&eacute;dito',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'textfield',
                                                name: 'diasF',
                                                fieldLabel: 'Dias',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 60,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'textfield',
                                                name: 'cupoF',
                                                width: 250,
                                                fieldLabel: 'Cupo',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'fondoanticipoF',
                                                width: 250,
                                                fieldLabel: 'Fondo Anticipo',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 60,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'textfield',
                                                name: 'valorF',
                                                fieldLabel: 'Valor',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'pagoF',
                                                width: 250,
                                                labelWidth: 150,
                                                fieldLabel: 'Pago'
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 60,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'tbspacer',
                                                width: 100
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'textfield',
                                                name: 'bancoF',
                                                fieldLabel: 'Banco',
                                                width: 200
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 40
                                            }, {
                                                xtype: 'textfield',
                                                name: 'contactoareaF',
                                                fieldLabel: 'Contacto &aacute;rea financiera',
                                                width: 500,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'textfield',
                                                name: 'telefonoF',
                                                fieldLabel: 'Tel.',
                                                width: 250
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'textfield',
                                                name: 'correoF',
                                                width: 250,
                                                fieldLabel: 'E-mail'
                                            }]
                                    }]
                            }]
                    }
            );
        }
    }
});