Ext.define('ComboTipoTI', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipoTI',
    store: ['Agente de Carga', 'Naviera', 'Aerolinea', 'Transporte Terrestre']
});

Ext.define('ComboTipoContacto', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipocontacto',
    store: ['Dep&oacute;sito', 'Operador Portuario', 'Empresa de Transporte nal/urbano', 'Empresa de vigilancia/Escoltas']
});

Ext.define('ComboTipoCe', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipo-ce',
    store: ['UAP', 'ALTEX']
});

Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('ComboDeclaraciones', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-declaraciones',
    store: ['Diario', 'Semanal', 'Pago', 'Levante']
});

Ext.define('Colsys.Crm.FormTabInfoGeneralFicha', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabInfoGeneralFicha',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        id: 'fieldsetContenedorGeneral_ficha' + me.idcliente,
                        hideLabel: true,
                        width: 980,
                        collapsible: false,
                        layout: 'hbox',
                        items: [{
                                xtype: 'fieldset',
                                id: 'fieldsetContenedorIzq_ficha' + me.idcliente,
                                hideLabel: true,
                                width: 490,
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
                                        id: 'fieldcontainerIzq_ficha' + me.idcliente,
                                        hideLabel: false,
                                        label: 'Condiciones Especiales',
                                        combineErrors: true,
                                        height: 360,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 1,
                                            hideLabel: false
                                        },
                                        items: [{
                                                xtype: 'fieldset',
                                                id: 'fieldsetCondiciones_ficha' + me.idcliente,
                                                title: 'Condiciones Especiales',
                                                width: 450,
                                                height: 220,
                                                collapsible: false,
                                                items: [{
                                                        xtype: 'fieldcontainer',
                                                        id: 'fieldcontainerCondiciones_ficha' + me.idcliente,
                                                        hideLabel: true,
                                                        combineErrors: true,
                                                        width: 420,
                                                        height: 300,
                                                        msgTarget: 'under',
                                                        layout: 'column',
                                                        defaults: {
                                                            flex: 1,
                                                            hideLabel: false
                                                        },
                                                        items: [{
                                                                xtype: 'combo-tipo-ce',
                                                                name: 'tipoCE',
                                                                id: 'tipoCE'+ me.idcliente,
                                                                fieldLabel: 'Tipo',
                                                                width: 200,
                                                                labelWidth: 80,
                                                                listeners: {
                                                                    change: function (field, newValue, oldValue) {
                                                                        if (newValue.toString() == "UAP") {
                                                                            Ext.getCmp("cierreCE"+me.idcliente).setVisible(true);
                                                                            Ext.getCmp("bancoCE"+me.idcliente).setVisible(true);
                                                                        }
                                                                        if (newValue.toString() == "ALTEX") {
                                                                            Ext.getCmp("cierreCE"+me.idcliente).setVisible(false);
                                                                            Ext.getCmp("bancoCE"+me.idcliente).setVisible(false);
                                                                        }
                                                                    }

                                                                }

                                                            }, {
                                                                xtype: 'textfield',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'C&oacute;digo',
                                                                labelWidth: 70,
                                                                name: 'codigoCE',
                                                                id: 'codigoCE'+ me.idcliente,
                                                                width: 220
                                                            }, {
                                                                xtype: 'tbspacer',
                                                                height: 15
                                                            }, {
                                                                xtype: 'textfield',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'N&uacute;mero de resoluci&oacute;n',
                                                                labelWidth: 90,
                                                                name: 'nroresolucionCE',
                                                                id: 'nroresolucionCE'+ me.idcliente,
                                                                width: 420
                                                            }, {
                                                                xtype: 'datefield',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Vencimiento',
                                                                labelWidth: 90,
                                                                format: 'Y-m-d',
                                                                name: 'fchvencimientoRCE',
                                                                id: 'fchvencimientoRCE'+ me.idcliente,
                                                                width: 200
                                                            }, {
                                                                xtype: 'tbspacer',
                                                                height: 15
                                                            }, {
                                                                xtype: 'textfield',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'N&uacute;mero P&oacute;liza',
                                                                labelWidth: 90,
                                                                name: 'nropolizaCE',
                                                                id: 'nropolizaCE'+ me.idcliente,
                                                                width: 220
                                                            }, {
                                                                xtype: 'datefield',
                                                                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                                                format: 'Y-m-d',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Vencimiento',
                                                                labelWidth: 90,
                                                                name: 'fchvencimientoPCE',
                                                                id: 'fchvencimientoPCE'+ me.idcliente,
                                                                width: 200
                                                            }, {
                                                                xtype: 'tbspacer',
                                                                height: 15
                                                            }, {
                                                                xtype: 'textfield',
                                                                hideLabel: false,
                                                                id: 'cierreCE'+ me.idcliente,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Fechas de cierre',
                                                                labelWidth: 90,
                                                                name: 'cierreCE',
                                                                width: 220
                                                            }, {
                                                                xtype: 'textareafield',
                                                                id: 'bancoCE'+ me.idcliente,
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Bancos',
                                                                labelWidth: 90,
                                                                name: 'bancoCE',
                                                                width: 420,
                                                                height: 50
                                                            }]
                                                    }]
                                            }, {
                                                xtype: 'fieldset',
                                                title: 'Seguro',
                                                id: 'fieldsetSeguro_ficha' + me.idcliente,
                                                width: 450,
                                                height: 120,
                                                collapsible: false,
                                                items: [{
                                                        xtype: 'fieldcontainer',
                                                        id: 'fieldcontainerSeguro_ficha' + me.idcliente,
                                                        hideLabel: true,
                                                        combineErrors: true,
                                                        width: 420,
                                                        height: 300,
                                                        msgTarget: 'under',
                                                        layout: 'column',
                                                        defaults: {
                                                            flex: 1,
                                                            hideLabel: false
                                                        },
                                                        items: [{
                                                                xtype: 'textfield',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Compa\u00F1&iacute;a Aseguradora',
                                                                labelWidth: 100,
                                                                name: 'ciaaseguradoraMS',
                                                                id: 'ciaaseguradoraMS'+ me.idcliente,
                                                                width: 400
                                                            }, {
                                                                xtype: 'tbspacer',
                                                                height: 20
                                                            }, {
                                                                xtype: 'textfield',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Porcentaje del Seguro',
                                                                labelWidth: 100,
                                                                name: 'porcentajeMS',
                                                                id: 'porcentajeMS'+ me.idcliente,
                                                                width: 200
                                                            }, {
                                                                xtype: 'datefield',
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Vigencia',
                                                                labelWidth: 80,
                                                                name: 'vigenciaMS',
                                                                id: 'vigenciaMS'+ me.idcliente,
                                                                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                                                format: 'Y-m-d',
                                                                width: 200
                                                            }, {
                                                                xtype: 'tbspacer',
                                                                height: 20
                                                            }, {
                                                                xtype: 'combo-si-no',
                                                                name: 'cotizacionMS',
                                                                id: 'cotizacionMS'+ me.idcliente,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Cotizaci&oacute;n de seguro',
                                                                width: 250,
                                                                labelWidth: 100
                                                            }]
                                                    }]
                                            }]
                                    }]
                            }, {
                                xtype: 'fieldset',
                                id: 'fieldsetContenedorDer_ficha' + me.idcliente,
                                hideLabel: true,
                                width: 490,
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
                                        id: 'fieldcontainerDer_ficha' + me.idcliente,
                                        hideLabel: true,
                                        combineErrors: true,
                                        height: 360,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 1,
                                            hideLabel: false
                                        },
                                        items: [{
                                                xtype: 'fieldset',
                                                id: 'fieldsetObservaciones_ficha' + me.idcliente,
                                                title: 'Observaciones Generales',
                                                width: 450,
                                                height: 400,
                                                collapsible: false,
                                                items: [{
                                                        xtype: 'fieldcontainer',
                                                        id: 'fieldcontainerObservaciones_ficha' + me.idcliente,
                                                        hideLabel: true,
                                                        combineErrors: true,
                                                        width: 450,
                                                        height: 300,
                                                        msgTarget: 'under',
                                                        layout: 'column',
                                                        defaults: {
                                                            flex: 1,
                                                            hideLabel: false
                                                        },
                                                        items: [{
                                                                xtype: 'textareafield',
                                                                id: 'observaciones_generales' + me.idcliente,
                                                                hideLabel: false,
                                                                labelAlign: 'left',
                                                                fieldLabel: 'Observaciones',
                                                                labelWidth: 90,
                                                                name: 'observaciones_generales',
                                                                width: 400,
                                                                height: 300
                                                            }]
                                                    }]
                                            }

                                        ]
                                    }]
                            }]
                    }
            );
        }
    }
});