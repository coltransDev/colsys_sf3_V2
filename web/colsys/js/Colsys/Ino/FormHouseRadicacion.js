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

Ext.define('Colsys.Ino.FormHouseRadicacion', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormHouseRadicacion',
    id: 'FormHouseRadicacion'+this.idmaster,
    name: 'FormHouseRadicacion'+this.idmaster,
    autoHeight: true,
    autoScroll: false,
    border: false,
    //width: 600,
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
                    margin: '0 0 5 0',
                    defaults: {
                        labelWidth: 90
                    },
                    items: [{
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Dispo.Carga',
                            name: 'dispocarga',
                            id: 'dispocarga',
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
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Tipo Doc.Viaje',
                            name: 'tipodocviaje',
                            id: 'tipodocviaje',
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
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    defaults: {
                        labelWidth: 90
                    },
                    items: [{
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Condiciones',
                            name: 'idcondiciones',
                            flex: 1,
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
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Negociaci\u00F3n',
                            name: 'tiponegociacion',
                            id: 'tiponegociacion',
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
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    defaults: {
                        labelWidth: 90
                    },
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
                            fieldLabel: 'Valor FOB',
                            name: 'vlrfob',
                            flex: 1,
                            allowBlank: false
                        }, {
                            fieldLabel: 'Valor Flete',
                            name: 'vlrflete',
                            flex: 1,
                            allowBlank: false
                        }, {
                            xtype: 'Colsys.Widgets.WgFormRadicacion',
                            fieldLabel: 'Dst.DTA/OTM',
                            name: 'iddestino',
                            labelWidth: 95,
                            flex: 1,
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
                        }]
                }, {
                    xtype: 'container',
                    layout: 'hbox',
                    defaultType: 'textfield',
                    margin: '0 0 5 0',
                    defaults: {
                        labelWidth: 90
                    },
                    items: [{
                            xtype: 'combo-depositos',
                            fieldLabel: 'Dep\u00F3sito',
                            name: 'coddeposito',
                            id: 'coddepositoh',
                            flex: 1,
                            allowBlank: true
                        }]
                }]
            ,
            listeners: {
                beforerender: function () {
                    var me = this;
                    var form = this.up('form');
                    me.setTitle("Documento Transporte. "+form.doctransporte);
                }
            }
        }, {
            xtype: 'fieldset',
            title: 'Descripci\u00F3n de la Mercanc\u00EDa',
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
                    name: 'mercancia_desc',
                    anchor: '100%'
                }]

        }
    ],
    listeners: {
        afterrender: function (me, eOpts) {
            form = this.getForm();

            form.load({
                url: '/inoF2/cargarHouseRadicacion',
                params: {
                    idhouse: me.idhouse
                },
                success: function (response, options) {
                    var res = Ext.JSON.decode(options.response.responseText);
                    Ext.getCmp("coddepositoh").store.add(
                            {"codigo": res.data.coddeposito, "nombre": res.data.deposito}
                    );
                    Ext.getCmp("coddepositoh").setValue(res.data.coddeposito);
                },
                failure: function (form, action) {
                    Ext.Msg.alert("Master Radicacion", "Error cargando los datos " + action.result.errorInfo + "</ br>");
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
            data["fchtrans"] = Ext.Date.format(new Date(), 'Y-m-d');
            data["disposicion"] = Ext.getCmp("dispocarga").getRawValue();
            data["tipodocumento"] = Ext.getCmp("tipodocviaje").getRawValue();
            data["deposito"] = Ext.getCmp("coddepositoh").getRawValue();
            data["negociacion"] = Ext.getCmp("tiponegociacion").getRawValue();
            var str = JSON.stringify(data);

            if (form.isValid()) {
                form.submit({
                    url: '/inoF2/guardarHouseRadicacion',
                    params: {
                        idhouse: this.up('form').idhouse,
                        datos: str
                    },
                    waitMsg: 'Guardando',
                    success: function (response, options) {
                        Ext.getCmp("winHouseRadicacion").destroy();
                        Ext.Msg.alert("Radicaciones", "Datos almacenados correctamente");
                        Ext.getCmp("GridHouseRadicacion").getStore().reload();
                    },
                    failure: function (form, action) {
                        Ext.Msg.alert("Contacto", "Error en guardar " + action.result.errorInfo + "</ br>");
                    }
                });
            }
        }
    }]

});