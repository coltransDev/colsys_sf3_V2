var states = Ext.create('Ext.data.Store', {
    fields: ['abbr', 'name'],
    id: 'saludos',
    name: 'saludos',
    data: [
    ]
});

comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('Mes', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-mes',
    store: Ext.create('Ext.data.Store', {
        fields: ['abbr', 'name'],
        data: [
            {"abbr": "01", "name": "Enero"},
            {"abbr": "02", "name": "Febrero"},
            {"abbr": "03", "name": "Marzo"},
            {"abbr": "04", "name": "Abril"},
            {"abbr": "05", "name": "Mayo"},
            {"abbr": "06", "name": "Junio"},
            {"abbr": "07", "name": "Julio"},
            {"abbr": "08", "name": "Agosto"},
            {"abbr": "09", "name": "Septiembre"},
            {"abbr": "10", "name": "Octubre"},
            {"abbr": "11", "name": "Noviembre"},
            {"abbr": "12", "name": "Diciembre"}
        ]
    })
});

Ext.define('Tipo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipo',
    store: Ext.create('Ext.data.Store', {
        fields: ['abbr', 'name'],
        data: [
            {"abbr": 1, "name": "Agente de aduana"}
        ]
    })
});

Ext.define('Colsys.Crm.FormContacto', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormContacto',
    id: 'FormContacto',
    name: 'FormContacto',
    layout: 'anchor',
    defaults: {
        style: "text-align: right",
        labelAlign: 'right'
    },
    items: [{
            xtype: 'fieldset',
            title: 'informaci&oacute;n General',
            layout: 'anchor',
            defaults: {
                labelAlign: 'right',
                anchor: '100%',
                msgTarget: 'qtip',
                margin: '0, 0, 5, 0'
            },
            items: [{
                    xtype: 'hiddenfield',
                    id: 'idcontacto',
                    name: 'idcontacto'
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            fieldLabel: 'Saludo',
                            xtype: 'Colsys.Widgets.WgFormCliente',
                            id: 'saludo',
                            name: 'saludo',
                            tipoCombo: 1,
                            allowBlank: true,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['id', 'nombre'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombos',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            }),
                            renderer: comboBoxRenderer(this)
                        }, {
                            fieldLabel: 'Nombres',
                            labelWidth: 80,
                            name: 'nombres',
                            id: "nombres",
                            flex: 2,
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            fieldLabel: 'Pri. Apellido',
                            name: 'primer_apellido',
                            id: "primer_apellido"
                        }, {
                            fieldLabel: 'Seg. Apellido',
                            name: 'segundo_apellido',
                            id: "segundo_apellido",
                            allowBlank: true
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            fieldLabel: ' Tipo de ID',
                            id: 'identificacion_tipo',
                            name: 'identificacion_tipo',
                            xtype: 'Colsys.Widgets.WgTipoIdentificacion',
                            store: Ext.create('Ext.data.Store', {
                                fields: ['id', 'name', 'trafico'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosTipoIdentificacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            }),
                            renderer: comboBoxRenderer(this)
                        }, {
                            fieldLabel: 'Identificaci&oacute;n',
                            labelWidth: 115,
                            id: 'identificacion',
                            name: 'identificacion'
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            xtype: 'Colsys.Widgets.WgCargos',
                            fieldLabel: 'Cargo General',
                            name: 'cargo_general',
                            id: "cargo_general",
                            renderer: comboBoxRenderer(this),
                            listeners: {
                                select: function (a, record, idx) {
                                    if (record.data.mostrar == 'TRUE') {
                                        Ext.getCmp('fieldsetadicional').setVisible(true);
                                        Ext.getCmp('tipo_ident').enable();
                                        Ext.getCmp('num_ident').enable();
                                    } else {
                                        Ext.getCmp('fieldsetadicional').setVisible(false);
                                        Ext.getCmp('tipo_ident').disable();
                                        Ext.getCmp('num_ident').disable();
                                    }
                                }
                            }
                        }, {
                            fieldLabel: 'Cargo Espec&iacute;fico',
                            labelWidth: 115,
                            name: 'cargo',
                            id: "cargo"
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false
                    },
                    items: [{
                            fieldLabel: '&Aacute;rea o Dpto.',
                            name: 'departamento',
                            id: "departamento",
                            flex: 3
                        }, {
                            fieldLabel: 'Cumplea\u00f1os',
                            xtype: 'combo-mes',
                            id: 'mes',
                            name: 'mes',
                            displayField: 'name',
                            valueField: 'abbr',
                            flex: 2
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'D&iacute;a',
                            labelWidth: 30,
                            maxValue: 31,
                            minValue: 1,
                            name: 'dia',
                            id: "dia",
                            flex: 1
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            fieldLabel: 'Nro. Celular',
                            name: 'celular',
                            id: "celular",
                            allowBlank: true
                        }, {
                            fieldLabel: 'Telefono',
                            name: 'telefono',
                            id: "telefono"
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            fieldLabel: 'Correo Electr.',
                            name: 'correo',
                            id: "correo",
                        }, {
                            fieldLabel: 'Tipo',
                            xtype: 'combo-tipo',
                            id: 'tipo',
                            name: 'tipo',
                            displayField: 'name',
                            valueField: 'abbr',
                            allowBlank: true,
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            xtype: 'Colsys.Widgets.WgSucursalesEmpresa',
                            fieldLabel: 'Sucursal',
                            name: 'idsucursal',
                            id: 'idsucursal',
                            renderer: comboBoxRenderer(this),
                            empresa: this.idcliente
                        }, {
                            xtype: 'checkboxgroup',
                            id: 'notificar',
                            fieldLabel: 'Contacto Fijo de Mensajes',
                            labelWidth: 170,
                            name: 'notificar',
                            allowBlank: true,
                            items: [{
                                    boxLabel: '',
                                    name: 'fijo',
                                    id: 'fijo',
                                    inputValue: true
                                }
                            ]
                        }]
                }, {
                    xtype: 'fieldcontainer',
                    layout: 'hbox',
                    combineErrors: true,
                    defaultType: 'textfield',
                    defaults: {
                        labelWidth: 90,
                        allowBlank: false,
                        flex: 1
                    },
                    items: [{
                            xtype: 'textareafield',
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            id: "observaciones"
                        }]
                }
            ]
        }
    ],
    buttons: [{
            text: 'Guardar',
            formBind: true,
            handler: function () {
                var idcontacto = this.up('form').idcontacto;
                var form = this.up('form').getForm();

                if (form.isValid()) {
                    form.submit({
                        url: '/crm/guardarContacto',
                        waitMsg: 'Guardando',
                        success: function (response, options) {
                            Ext.getCmp("winFormEdit").destroy();
                            Ext.Msg.alert("Contacto", "Datos almacenados correctamente");
                            console.log(this.up('form').getForm());
                            // Ext.getCmp("Contactos" + idcliente).getStore().reload();
                        },
                        failure: function (form, action) {
                            Ext.Msg.alert("Contacto", "Error en guardar " + action.result.errorInfo + "</ br>");
                        }
                    });
                }
            }
        }],
    listeners: {
        afterrender: function (me, eOpts) {
            form = this.getForm();
            form.load({
                url: '/crm/cargarContacto',
                params: {
                    idcontacto: this.idcontacto
                },
                success: function (response, options) {
                    res = Ext.JSON.decode(options.response.responseText);
                    if (res.mostrar == 'TRUE') {
                        Ext.getCmp('fieldsetadicional').setVisible(true);
                        Ext.getCmp('tipo_ident').enable();
                        Ext.getCmp('num_ident').enable();
                    } else {
                        Ext.getCmp('fieldsetadicional').setVisible(false);
                        Ext.getCmp('tipo_ident').disable();
                        Ext.getCmp('num_ident').disable();
                    }
                }
            });
        }
    }

});