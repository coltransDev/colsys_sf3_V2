Ext.define('AduanaAg', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-aduanaag',
    displayField: 'nombre',
    valueField: 'idagente',
    store: Ext.create('Ext.data.Store', {
        fields: ['idagente', 'nombre'],
        proxy: {
            type: 'ajax',
            url: '/inoF2/datosAgentesAduana',
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

Ext.define('Colsys.Ino.FormLiberarDocumentos', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormLiberarDocumentos',
    id: 'FormLiberarDocumentos',
    name: 'FormLiberarDocumentos',
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
                            xtype: 'combo-aduanaag',
                            name: 'idagente',
                            id: 'idagente',
                            flex: 1,
                            alowBlank: false,
                            fieldLabel: 'Agente de Aduana'
                        }
                    ]
                }],
            listeners: {
                afterrender: function (me, eOpts) {
                    me.setTitle('Doc.Transporte: ' + me.up('form').doctransporte);
                }
            }
        }, {
            xtype: 'fieldset',
            title: 'Detalles de Liberaci\u00F3n',
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
                    name: 'detalles',
                    anchor: '100%'
                }]

        }
    ],
    listeners: {
        afterrender: function (me, eOpts) {
            form = this.getForm();

            form.load({
                url: '/inoF2/cargarLiberarDocumentos',
                params: {
                    idhouse: me.idhouse
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

                if (form.isValid()) {
                    form.submit({
                        url: '/inoF2/guardarLiberarDocumentos',
                        params: {
                            idhouse: this.up('form').idhouse,
                            agente: Ext.getCmp("idagente").getRawValue()
                        },
                        waitMsg: 'Guardando',
                        success: function (response, options) {
                            Ext.getCmp("winLiberarDocumentos").destroy();
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