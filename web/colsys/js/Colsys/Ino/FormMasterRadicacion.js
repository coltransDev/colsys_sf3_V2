var win_generacion = null;

function setReadOnlyForAll(form, readOnly, digitar, reversar, generar) {
    Ext.suspendLayouts();
    form.getForm().getFields().each(function (field) {
        field.setReadOnly(readOnly);
    });
    //console.log(form.permisos);
    if (form.permisos.MuiscaEd)
        Ext.getCmp('bntGuardar').setVisible(!readOnly);
    else
        Ext.getCmp('bntGuardar').setVisible(false);
    if (form.permisos.MuiscaDig)
        Ext.getCmp('bntDigitar').setVisible(!digitar);
    else
        Ext.getCmp('bntDigitar').setVisible(false);
    if (form.permisos.MuiscaRev)
        Ext.getCmp('bntReversar').setVisible(reversar);
    else
        Ext.getCmp('bntReversar').setVisible(false);
    if (form.permisos.GenerarXml)
        Ext.getCmp('bntGenerar').setVisible(generar);
    else
        Ext.getCmp('bntGenerar').setVisible(false);
    Ext.resumeLayouts();
};

Ext.define('Depositos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-depositos',
    displayField: 'nombre',
    valueField: 'codigo',
    store: Ext.create('Ext.data.Store', {
        fields: ['codigo', 'nombre'],
        proxy: {
            type: 'ajax',
            url: '/inoF2/datosDianDepositos',
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

Ext.define('Transportista', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-transportistas',
    displayField: 'nombre',
    valueField: 'idtransportista',
    store: Ext.create('Ext.data.Store', {
        fields: ['idtransportista', 'nombre'],
        proxy: {
            type: 'ajax',
            url: '/inoF2/datosTransportistas',
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

Ext.define('Colsys.Ino.FormMasterRadicacion', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormMasterRadicacion',
    id: 'FormMasterRadicacion',
    name: 'FormMasterRadicacion',
    autoHeight: true,
    autoScroll: false,
    border: false,
    width: 900,
    fieldDefaults: {
        labelAlign: 'right',
        labelWidth: 95,
        msgTarget: 'qtip'
    },
    items: [{
            xtype: 'fieldset',
            title: 'Informaci\u00F3n para Muisca',
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
                    margin: '0 0 5 0',
                    items: [{
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Concepto',
                            name: 'codconcepto',
                            id: 'codconcepto',
                            flex: 2,
                            allowBlank: false,
                            tipoCombo: 0,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }, {
                            fieldLabel: 'Form.Anterior',
                            name: 'iddocanterior',
                            flex: 1
                        }, {
                            fieldLabel: 'Doc.Transbordo',
                            name: 'iddoctrasbordo',
                            flex: 1
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    items: [{
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Tipo Doc.Viaje',
                            name: 'tipodocviaje',
                            flex: 1,
                            allowBlank: false,
                            tipoCombo: 7,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Dispo.Carga',
                            name: 'dispocarga',
                            flex: 1,
                            allowBlank: false,
                            tipoCombo: 2,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    defaults: {
                        labelWidth: 75
                    },
                    items: [{
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Administraci\u00F3n',
                            name: 'codadministracion',
                            labelWidth: 95,
                            flex: 2,
                            allowBlank: false,
                            tipoCombo: 1,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }, {
                            xtype: 'combo-depositos',
                            fieldLabel: 'Dep\u00F3sito',
                            name: 'coddeposito',
                            id: 'coddeposito',
                            flex: 3,
                            allowBlank: true
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    items: [{
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Tipo Carga',
                            name: 'tipocarga',
                            flex: 1,
                            allowBlank: false,
                            tipoCombo: 6,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Negociaci\u00F3n',
                            name: 'tiponegociacion',
                            flex: 1,
                            allowBlank: false,
                            tipoCombo: 5,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fch.Inicial',
                            name: 'fchinicial',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            flex: 1,
                            allowBlank: false
                        }, {
                            xtype: 'datefield',
                            fieldLabel: 'Fch.Final',
                            name: 'fchfinal',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            flex: 1,
                            allowBlank: false
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    items: [{
                            xtype: 'combo-transportistas',
                            fieldLabel: 'Transportista',
                            name: 'idtransportista',
                            id: 'idtransportista',
                            flex: 1,
                            allowBlank: false
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Precursores',
                            name: 'precursores',
                            width: 165,
                            allowBlank: false,
                            tipoCombo: 11,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Condiciones',
                            name: 'idcondiciones',
                            width: 210,
                            allowBlank: false,
                            tipoCombo: 4,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Resp.Transp.',
                            name: 'responsabilidad',
                            width: 165,
                            allowBlank: false,
                            tipoCombo: 11,
                            store: Ext.create('Ext.data.Store', {
                                fields: ['nombre', 'valor'],
                                proxy: {
                                    type: 'ajax',
                                    url: '/widgets5/datosCombosRadicacion',
                                    reader: {
                                        type: 'json',
                                        root: 'root'
                                    }
                                },
                                autoLoad: true
                            })
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    items: [{
                            fieldLabel: 'Digitaci\u00F3n OK',
                            name: 'usumuisca',
                            readOnly: true,
                            flex: 1
                        }, {
                            fieldLabel: 'Fecha',
                            name: 'fchmuisca',
                            readOnly: true,
                            labelWidth: 50,
                            flex: 1
                        }, {
                            fieldLabel: 'Radicaci\u00F3n',
                            name: 'usuradicado',
                            readOnly: true,
                            labelWidth: 75,
                            flex: 1
                        }, {
                            fieldLabel: 'Fecha',
                            name: 'fchradicado',
                            readOnly: true,
                            labelWidth: 50,
                            flex: 1
                        }, {
                            fieldLabel: 'Radicaci\u00F3n',
                            name: 'radicacion',
                            readOnly: true,
                            labelWidth: 75,
                            flex: 1
                        }]
                }]
        }
    ],
    listeners: {
        afterrender: function (me, eOpts) {
            form = this.getForm();

            form.load({
                url: '/inoF2/cargarMasterRadicacion',
                params: {
                    idmaster: me.idmaster
                },
                success: function (response, options) {
                    var editar = true;
                    var digitar = true;
                    var reversar = false;
                    var generar = false;
                    var res = Ext.JSON.decode(options.response.responseText);
                    Ext.getCmp("coddeposito").store.add(
                            {"codigo": res.data.coddeposito, "nombre": res.data.deposito}
                    );
                    Ext.getCmp("coddeposito").setValue(res.data.coddeposito);

                    Ext.getCmp("idtransportista").store.add(
                            {"idtransportista": res.data.idtransportista, "nombre": res.data.transportista}
                    );
                    Ext.getCmp("idtransportista").setValue(res.data.idtransportista);
                    if (res.data.fchmuisca == null) {
                        editar = false;
                        digitar = false;
                    } else {
                        reversar = true;
                    }
                    if (me.permisos.GenerarXml) {
                        generar = true;
                    }
                    setReadOnlyForAll(me, editar, digitar, reversar, generar);
                },
                failure: function (form, action) {
                    Ext.Msg.alert("Master Radicacion", "Error cargando los datos " + action.result.errorInfo + "</ br>");
                }
            });
        },
        beforerender: function (ct, position) {
            var me = this;
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                id: 'bntGuardar',
                text: 'Guardar',
                tooltip: 'Guardar Informaci\u00F3n del Master',
                iconCls: 'add',
                scope: this,
                handler: function () {
                    var form = this.getForm();
                    if (form.isValid()) {
                        var data = form.getFieldValues();
                        data["fchtrans"] = Ext.Date.format(new Date(), 'Y-m-d');
                        data["fchinicial"] = Ext.Date.format(new Date(data["fchinicial"]), 'Y-m-d');
                        data["fchfinal"] = Ext.Date.format(new Date(data["fchfinal"]), 'Y-m-d');
                        data["deposito"] = Ext.getCmp("coddeposito").getRawValue();
                        data["transportista"] = Ext.getCmp("idtransportista").getRawValue();

                        var str = JSON.stringify(data);

                        form.submit({
                            url: '/inoF2/guardarMasterRadicacion',
                            params: {
                                idmaster: me.idmaster,
                                datos: str
                            },
                            waitMsg: 'Guardando',
                            success: function (response, options) {
                                Ext.Msg.alert("Contacto", "Datos almacenados correctamente");
                            },
                            failure: function (form, action) {
                                Ext.Msg.alert("Master Radicacion", "Error en guardar " + action.result.errorInfo + "</ br>");
                            }
                        });
                    }
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos.MuiscaEd);
                    }
                }
            });
            tb.add({
                id: 'bntDigitar',
                text: 'Digitaci\u00F3n Muisca OK',
                tooltip: 'Confirma la finalizaci\u00F3n de la Digitaci\u00F3n',
                iconCls: 'tick',
                scope: this,
                handler: function () {
                    Ext.MessageBox.confirm('Digitaci&oacute;n Muisca OK', 'Desea confirmar la Digitaci&oacute;n Muisca?', function (choice) {
                        if (choice == 'yes') {
                            Ext.Ajax.request({
                                waitMsg: 'Enviando Mensajes...',
                                url: '/inoF2/digitacionRadicacionOk',
                                params: {
                                    idmaster: me.idmaster
                                },
                                failure: function (response, options) {
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error notificando Digitaci\u00F3n OK<br>' + response.errorInfo);
                                    success = false;
                                },
                                success: function (response, options) {
                                    var res = Ext.JSON.decode(response.responseText);
                                    if (res.success) {
                                        Ext.Msg.alert("Radicaciones", "Mensaje de Notificaci\u00F3n Enviado - Digitaci\u00F3n Muisca Ok ");
                                    } else {
                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error notificando Digitaci\u00F3n OK<br>' + res.errorInfo);
                                    }
                                }
                            });
                        }
                    });
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos.MuiscaDig);
                    }
                }
            });
            tb.add({
                id: 'bntReversar',
                text: 'Reversar Digitaci\u00F3n',
                tooltip: 'Confirma la reverci\u00F3n de la Digitaci\u00F3n',
                iconCls: 'error',
                scope: this,
                handler: function () {
                    Ext.MessageBox.confirm('Reversar Digitaci&oacute;n Muisca', 'Desea reversar la Digitaci&oacute;n Muisca?', function (choice) {
                        if (choice == 'yes') {
                            Ext.Ajax.request({
                                waitMsg: 'Enviando Mensajes...',
                                url: '/inoF2/reversarDigitacionOk',
                                params: {
                                    idmaster: me.idmaster
                                },
                                failure: function (response, options) {
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error notificando Digitaci\u00F3n OK<br>' + response.errorInfo);
                                    success = false;
                                },
                                success: function (response, options) {
                                    var res = Ext.JSON.decode(response.responseText);
                                    if (res.success) {
                                        Ext.Msg.alert("Radicaciones", "Mensaje de Notificaci\u00F3n Enviado - Digitaci\u00F3n Muisca Ok ");
                                    } else {
                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error notificando Digitaci\u00F3n OK<br>' + res.errorInfo);
                                    }
                                }
                            });
                        }
                    });
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos.MuiscaRev);
                    }
                }
            });
            tb.add({
                id: 'bntGenerar',
                text: 'Generar XML',
                tooltip: 'Genera Archivo XML para Radicar',
                iconCls: 'note-add',
                scope: this,
                handler: function () {
                    if (win_generacion == null) {
                        win_generacion = new Ext.Window({
                            id: 'winGenerarXml',
                            title: 'Generar Xml',
                            width: 400,
                            height: 160,
                            closeAction: 'destroy',
                            listeners: {
                                destroy: function (obj, eOpts)
                                {
                                    win_generacion = null;
                                }
                            },
                            items: {
                                xtype: 'Colsys.Ino.FormGenerarXml',
                                idmaster: me.idmaster
                            }
                        });
                    }
                    win_generacion.show();
                },
                listeners: {
                    beforerender: function () {
                        this.setVisible(me.permisos.GenerarXml);
                    }
                }
            });
            this.addDocked(tb);
        }
    }
});