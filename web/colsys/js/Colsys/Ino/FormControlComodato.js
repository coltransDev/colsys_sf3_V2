var tpl = new Ext.create('Ext.XTemplate',
        '<tpl for=".">',
        '<tpl for="ciudad" if="this.shouldShowHeader(ciudad)"><div class="group-header">{[this.showHeader(values.ciudad)]}</div></tpl>',
        '<div class="x-boundlist-item"><strong>{nombre}</strong> - {direccion}</div>',
        '</tpl>', {
            shouldShowHeader: function (ciudad) {
                return this.currentGroup !== ciudad;
            },
            showHeader: function (ciudad) {
                this.currentGroup = ciudad;
                return ciudad;
            }
        });

Ext.define('Patios', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-patios',
    displayField: 'nombre',
    valueField: 'idpatio',
    store: Ext.create('Ext.data.Store', {
        fields: ['ciudad', 'idpatio', 'nombre', 'direccion'],
        proxy: {
            type: 'ajax',
            url: '/inoF2/datosPatiosDevolucion',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        listConfig: {
            cls: 'grouped-list'
        },
        autoLoad: false
    }),
    listConfig: {
        cls: 'grouped-list'
    },
    tpl: tpl,
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
                            fieldLabel: 'Fecha Arribo',
                            name: 'fecha_arribo',
                            id: 'fecha_arribo',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            readOnly: true,
                            listeners: {
                                change: function (me, newValue, oldValue, eOpts) {
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
                                change: function (me, newValue, oldValue, eOpts) {
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
                            fieldLabel: 'Entrg.Comodato',
                            name: 'fecha_entrega',
                            id: 'fecha_entrega',
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

        },
        {
            xtype: 'checkboxfield',
            boxLabel: 'Copiar datos a los dem&aacute;s contenedores',
            name: 'copiar',            
            id: 'copiar',
            margin: '0 0 5 0',
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
        }
    ],
    calculaLimite: function () {
        fecha = Ext.getCmp("fecha_arribo").getValue();
        dias = Ext.getCmp("dias_libres").getValue();
        if (fecha && dias) {
            var dt = Ext.Date.add(new Date(fecha), Ext.Date.DAY, dias - 1);
            Ext.getCmp("limite_devolucion").setValue(Ext.Date.format(dt, 'Y-m-d'));
        }
    },
    listeners: {
        afterrender: function (me, eOpts) {
            form = this.getForm();
            var me = this;

            form.load({
                url: '/inoF2/cargarControlMandato',
                params: {
                    idequipo: me.idequipo
                },
                success: function (response, options) {
                    var res = Ext.JSON.decode(options.response.responseText);                    
                    me.calculaLimite();
                    Ext.getCmp("idpatio").store.add(
                            {"idpatio": res.data.idpatio, "nombre": res.data.patio}
                    );
                    Ext.getCmp("idpatio").setValue(res.data.idpatio);
                    Ext.Msg.alert("Control de Mandatos", res.msg);
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
                data["fecha_arribo"] = Ext.Date.format(new Date(Ext.getCmp("fecha_arribo").getValue()), 'Y-m-d');
                data["limite_devolucion"] = Ext.Date.format(new Date(Ext.getCmp("limite_devolucion").getValue()), 'Y-m-d');
                if (Ext.getCmp("fecha_entrega").getValue()) {
                    data["fecha_entrega"] = Ext.Date.format(new Date(Ext.getCmp("fecha_entrega").getValue()), 'Y-m-d');
                } else {
                    data["fecha_entrega"] = null;
                }
                    
                if (Ext.getCmp("devolucion_fch").getValue()) {
                    data["devolucion_fch"] = Ext.Date.format(new Date(Ext.getCmp("devolucion_fch").getValue()), 'Y-m-d');
                } else {
                    data["devolucion_fch"] = null;
                }
                data["patio"] = Ext.getCmp("idpatio").getRawValue();
                data["copiar"] = Ext.getCmp("copiar").getRawValue();
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