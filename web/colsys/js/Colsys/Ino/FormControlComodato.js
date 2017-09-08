Ext.define('Patios', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-patios',
    displayField: 'nombre',
    valueField: 'idpatio',
    store: Ext.create('Ext.data.Store', {
        fields: ['idpatio', 'nombre'],
        proxy: {
            type: 'ajax',
            url: '/inoF2/datosPatiosDevolucion',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    queryParam: 'q',
    queryMode: 'remote',
    forceSelection: true
});

Ext.define('Colsys.Ino.FormControlComodato', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormControlComodato',
    id: 'FormControlComodato',
    name: 'FormControlComodato',
    autoHeight: true,
    autoScroll: false,
    border: false,
    fieldDefaults: {
        labelAlign: 'right',
        labelWidth: 95,
        msgTarget: 'qtip'
    },
    items: [{
            xtype: 'fieldset',
            defaultType: 'textfield',
            margin: '0 0 5 0',
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            items: [{
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '5 0 5 0',
                    defaults: {
                        labelWidth: 100,
                        flex: 4
                    },
                    items: [{
                            xtype: 'datefield',
                            fieldLabel: 'Fch.Entrega',
                            name: 'entrega_comodato',
                            id: 'entrega_comodato',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: false,
                            listeners: {
                                change: function ( me, newValue, oldValue, eOpts ){
                                    me.up('form').calculaLimite();
                                }
                            }
                        }, {
                            xtype: 'numberfield',
                            fieldLabel: 'D\u00edas Libres',
                            name: 'dias_libres',
                            id: 'dias_libres',
                            labelWidth: 70,
                            flex: 2,
                            allowBlank: false,
                            hideTrigger: true,
                            decimalPrecision: 0,
                            keyNavEnabled: false,
                            mouseWheelEnabled: false,
                            listeners: {
                                change: function ( me, newValue, oldValue, eOpts ){
                                    me.up('form').calculaLimite();
                                }
                            }
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Lim.Devoluci\u00F3n',
                            name: 'limite_devolucion',
                            id: 'limite_devolucion',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: false,
                            readOnly: true
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fch.Inspecci\u00F3n',
                            name: 'inspeccion_fch',
                            id: 'inspeccion_fch',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        }
                    ]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '5 0 5 0',
                    items: [{
                            xtype: 'combo-patios',
                            fieldLabel: 'Sitio Devoluci\u00F3n',
                            labelWidth: 100,
                            name: 'idpatio',
                            id: 'idpatio',
                            flex: 3,
                            allowBlank: false
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Devoluci\u00F3n',
                            name: 'devolucion_fch',
                            id: 'devolucion_fch',
                            labelWidth: 80,
                            flex: 1,
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        }]
                }]
        }, {
            xtype: 'fieldset',
            title: 'Observaciones',
            defaultType: 'textfield',
            margin: '0 0 5 0',
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            items: [{
                    xtype: 'textareafield',
                    height: 140,
                    grow: true,
                    name: 'observaciones',
                    anchor: '100%'
                }]

        }
    ],
    calculaLimite: function() {
        fecha = Ext.getCmp("entrega_comodato").getValue();
        dias = Ext.getCmp("dias_libres").getValue();
        if (fecha && dias) {
            var dt = Ext.Date.add(new Date(fecha), Ext.Date.DAY, dias);
            Ext.getCmp("limite_devolucion").setValue(Ext.Date.format(dt, 'Y-m-d'));
        }
    },
    listeners: {
        afterrender: function (me, eOpts) {
            form = this.getForm();
            
            form.load({
                url: '/inoF2/cargarControlMandato',
                params: {
                    idequipo: me.idequipo
                },
                success: function (response, options) {
                    var res = Ext.JSON.decode(options.response.responseText);
                    Ext.getCmp("idpatio").store.add(
                            {"idpatio": res.data.idpatio, "nombre": res.data.patio}
                    );
                    Ext.getCmp("idpatio").setValue(res.data.idpatio);
                },
                failure: function (form, action) {
                    Ext.Msg.alert("Control de Mandatos", "Error cargando los datos " + action.result.errorInfo + "</ br>");
                }
            });
        }
    },
    buttons: [{
            text: 'Guardar',
            formBind: true,
            handler: function () {
                var me = this;
                var form = this.up('form').getForm();
                var data = form.getFieldValues();
                data["entrega_comodato"] = Ext.Date.format(new Date(Ext.getCmp("entrega_comodato").getValue()), 'Y-m-d');
                data["limite_devolucion"] = Ext.Date.format(new Date(Ext.getCmp("limite_devolucion").getValue()), 'Y-m-d');
                if (Ext.getCmp("inspeccion_fch")) {
                    data["inspeccion_fch"] = Ext.Date.format(new Date(Ext.getCmp("inspeccion_fch").getValue()), 'Y-m-d');
                }
                if (Ext.getCmp("devolucion_fch")) {
                    data["devolucion_fch"] = Ext.Date.format(new Date(Ext.getCmp("devolucion_fch").getValue()), 'Y-m-d');
                }
                data["patio"] = Ext.getCmp("idpatio").getRawValue();
                var str = JSON.stringify(data);

                if (form.isValid()) {
                    form.submit({
                        url: '/inoF2/guardarControlMandato',
                        params: {
                            idequipo: this.up('form').idequipo,
                            datos: str
                        },
                        waitMsg: 'Guardando',
                        success: function (response, options) {
                            Ext.getCmp("winControlComodato").destroy();
                            Ext.Msg.alert("Control Mandato", "Datos almacenados correctamente");
                            // Ext.getCmp("GridContenedores").getStore().reload();
                        },
                        failure: function (form, action) {
                            Ext.Msg.alert("Contacto", "Error en guardar " + action.result.errorInfo + "</ br>");
                        }
                    });
                }
            }
        }
    ]
});