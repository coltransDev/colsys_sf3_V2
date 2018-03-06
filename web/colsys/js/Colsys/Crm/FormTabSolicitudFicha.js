Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('Colsys.Crm.FormTabSolicitudFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabSolicitudFicha',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        hideLabel: false,
                        title: 'Solicitud de Fondos o Anticipos',
                        width: 650,
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
                                        hideLabel: true,
                                        combineErrors: true,
                                        height: 360,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        columnWidth: 1,
                                        defaults: {
                                            columnWidth: 0.45,
                                            bodyStyle: 'padding:4px'
                                        },
                                        items: [{
                                                xtype: 'tbspacer',
                                                height: 60,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'portuariosSF',
                                                fieldLabel: 'Gastos portuarios',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'almacenajesSF',
                                                fieldLabel: 'Almacenajes',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 40,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'fleteSF',
                                                fieldLabel: 'Fiete Internacional',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'transporteSF',
                                                width: 250,
                                                fieldLabel: 'Transporte interno, urbano',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 40,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'icainvimaSF',
                                                width: 250,
                                                fieldLabel: 'ICA,INVIMA',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'otrosgastosSF',
                                                width: 250,
                                                fieldLabel: 'Otros gastos',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 40,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'tributosSF',
                                                width: 250,
                                                fieldLabel: 'Tributos aduaneros',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'ingresosSF',
                                                width: 250,
                                                fieldLabel: 'Ingresos propios',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 20,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'htmleditor',
                                                name: 'bancosSF',
                                                height: 50,
                                                width: 500,
                                                fieldLabel: 'Bancos',
                                                labelWidth: 150,
                                                columnWidth: 1,
                                                listeners: {
                                                    initialize: function(field, e) {
                                                        field.getToolbar().hide();
                                                    }
                                                }
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 20,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'transferenciaF',
                                                width: 250,
                                                labelWidth: 150,
                                                fieldLabel: 'Transferencia'
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'textfield',
                                                name: 'plazotransferenciaF',
                                                width: 250,
                                                fieldLabel: 'Plazo'
                                            }, {
                                                xtype: 'tbspacer',
                                                height: 20,
                                                columnWidth: 1
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'chequeF',
                                                fieldLabel: 'Cheque',
                                                width: 250,
                                                labelWidth: 150
                                            }, {
                                                xtype: 'displayfield',
                                                value: ' ',
                                                fieldStyle: 'padding-left: 5px;',
                                                columnWidth: 0.01
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'consignacionF',
                                                width: 250,
                                                fieldLabel: 'Consignaci&oacute;n Efectivo',
                                                labelWidth: 150
                                            }, {
                                                xtype: 'tbspacer',
                                                columnWidth: 1,
                                                height: 20
                                            }, {
                                                xtype: 'combo-si-no',
                                                name: 'pagoelectronicoF',
                                                fieldLabel: 'Pago Electr&oacute;nico',
                                                width: 250,
                                                labelWidth: 150
                                            }]
                                    }]
                            }]
                    }
            );
        }
    }
});