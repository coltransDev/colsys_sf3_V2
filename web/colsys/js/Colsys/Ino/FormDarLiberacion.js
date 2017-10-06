Ext.define('EstadoLiberacion', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-estadoliberacion',
    store: ['Sin Liberar', 'Retenida', 'Liberada']
});

Ext.define('NotaLiberacion', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-notaliberacion',
    store: ['Se libera sobre canje', 'Cartera al d\u00eda', 'Viene carga ruteada', 'Liberaci\u00F3n autorizada por Gerente Comercial',
        'Liberaci\u00F3n autorizada por Gerente Regional', 'Carga para nacionalizar en Colmas', 'Se libera para tr\u00E1nsito OTM',
        'Acuerdo compromiso de pago', 'Instrucci\u00F3n dada por el Agente']
});

Ext.define('Colsys.Ino.FormDarLiberacion', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormDarLiberacion',
    id: 'FormDarLiberacion',
    name: 'FormDarLiberacion',
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
                        labelWidth: 110
                    },
                    items: [{
                            xtype: 'datefield',
                            fieldLabel: 'Fch.Liberaci\u00F3n',
                            name: 'fchliberacion',
                            id: 'fchliberacion',
                            flex: 3,
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: false
                        }, {
                            xtype: 'combo-estadoliberacion',
                            name: 'estado_liberacion',
                            id: 'estado_liberacion',
                            flex: 4,
                            alowBlank: false,
                            fieldLabel: 'Estado Liberaci\u00F3n'
                        }
                    ]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '5 0 5 0',
                    defaults: {
                        labelWidth: 110
                    },
                    items: [{
                            xtype: 'combo-notaliberacion',
                            name: 'nota_liberacion',
                            id: 'nota_liberacion',
                            flex: 1,
                            alowBlank: false,
                            fieldLabel: 'Nota Liberaci\u00F3n'
                        }]
                }],
            listeners: {
                afterrender: function (me, eOpts) {
                    me.setTitle('Doc.Transporte: '+me.up('form').doctransporte);
                }
            }
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
                    height: 80,
                    grow: true,
                    name: 'observaciones',
                    anchor: '100%'
                }]

        }
    ],
    listeners: {
        afterrender: function (me, eOpts) {
            form = this.getForm();

            form.load({
                url: '/inoF2/cargarDarLiberacion',
                params: {
                    idhouse: me.idhouse
                },
                success: function (response, options) {
                    var res = Ext.JSON.decode(options.response.responseText);
                },
                failure: function (form, action) {
                    Ext.Msg.alert("M\u00F3dulo de Liberaciones", "Error cargando los datos " + action.result.errorInfo + "</ br>");
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

                if (form.isValid()) {
                    form.submit({
                        url: '/inoF2/guardarDarLiberacion',
                        params: {
                            idhouse: this.up('form').idhouse
                        },
                        waitMsg: 'Guardando',
                        success: function (response, options) {
                            Ext.getCmp("winDarLiberacion").destroy();
                            Ext.Msg.alert("Dar Liberaci\u00F3n", "Datos almacenados correctamente");
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