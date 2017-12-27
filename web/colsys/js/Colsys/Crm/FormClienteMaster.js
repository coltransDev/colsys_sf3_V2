// Form para Edición Datos del Cliente

comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

var idalternoInicial;

Ext.define('Colsys.Crm.FormClienteMaster', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormClienteMaster',
    defaults: {
        bodyStyle: 'padding:4px',
        labelWidth: 100
    },
    listeners: {
        beforerender: function (me, eOpts) {
            this.add({
                xtype: 'tabpanel',
                id: 'tab-panel-general',
                name: 'tab-panel-general',
                layout: 'anchor',
                anchor: '100% 100%',
                collapsible: false,
                items: [{
                        title: 'Informaci&oacute;n General',
                        items: [{
                                xtype: 'fieldset',
                                title: 'Datos B&aacute;sicos',
                                defaults: {
                                    bodyStyle: 'padding:4px',
                                    anchor: '100%'
                                },
                                fieldDefaults: {
                                    labelAlign: 'right',
                                    labelWidth: 95,
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'container',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: 'Tipo de ID',
                                                xtype: 'Colsys.Widgets.WgTipoIdentificacion',
                                                id: 'tipo_identificacion',
                                                name: 'tipo_identificacion',
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
                                                renderer: comboBoxRenderer(this),
                                                listeners: {
                                                    select: function (a, record, idx) {
                                                        if (record.data.name != 'NIT') {
                                                            Ext.getCmp('dv_id').disable();
                                                        } else {
                                                            Ext.getCmp('dv_id').enable();
                                                        }
                                                        store = Ext.getCmp('ciudad').getStore();
                                                        rec = record.data.trafico;
                                                        store.clearFilter();
                                                        if (record.data.name != 'Consecutivo Colsys') {
                                                            store.filterBy(function (record, id) {
                                                                if (rec == record.data.trafico)
                                                                    return true;
                                                                else
                                                                    return false;
                                                            });
                                                            Ext.getCmp('idalterno_id').enable();
                                                        } else {
                                                            Ext.getCmp('idalterno_id').disable();
                                                        }
                                                        if (record.data.trafico == 'Colombia') {
                                                            Ext.getCmp('ciudad').enable(false);
                                                            Ext.getCmp('ciudad2').disable(true);
                                                            Ext.getCmp('direccion0').disable(true);
                                                            Ext.getCmp('fieldsetdireccion2').setVisible(true);
                                                            Ext.getCmp('fieldsetdireccion1').setVisible(false);
                                                        } else {
                                                            Ext.getCmp('ciudad').disable(true);
                                                            Ext.getCmp('ciudad2').enable(true);
                                                            Ext.getCmp('direccion0').enable(true);
                                                            Ext.getCmp('fieldsetdireccion1').setVisible(true);
                                                            Ext.getCmp('fieldsetdireccion2').setVisible(false);
                                                        }

                                                    }
                                                }
                                            }, {
                                                xtype: 'numberfield',
                                                fieldLabel: 'Identificacion',
                                                name: 'idalterno_id',
                                                id: 'idalterno_id',
                                                allowNegative: false,
                                                allowBlank: false,
                                                hideTrigger: true,
                                                keyNavEnabled: false,
                                                mouseWheelEnabled: false,
                                                listeners: {
                                                    blur: function (meBlur, e, eOpts) {
                                                        //alert('Inicial: ' + idalternoInicial + " - Actual: " + Ext.getCmp('idalterno_id').value)
                                                        if (Ext.getCmp('idalterno_id').value !== idalternoInicial) {
                                                            form = me.getForm();
                                                            form.load({
                                                                url: '/crm/ValidarNITExistente',
                                                                params: {
                                                                    idalterno: Ext.getCmp('idalterno_id').value
                                                                },
                                                                success: function (response, options) {
                                                                    res = Ext.JSON.decode(options.response.responseText);
                                                                    Ext.MessageBox.alert('Mensaje', res.data);
                                                                    Ext.getCmp('idalterno_id').setValue("");
                                                                },
                                                                failure: function (response, options) {
                                                                    res = Ext.JSON.decode(options.response.responseText);
                                                                    Ext.getCmp('representante_fs').setVisible(!res.agente);
                                                                }
                                                            });
                                                        }
                                                    }
                                                }
                                            }, {
                                                xtype: 'displayfield',
                                                value: '-',
                                                fieldStyle: 'padding-left: 5px;',
                                            }, {
                                                xtype: 'numberfield',
                                                name: 'dv_id',
                                                id: 'dv_id',
                                                allowNegative: false,
                                                allowBlank: false,
                                                minValue: 0,
                                                maxValue: 9,
                                                width: 50,
                                                listeners: {
                                                    blur: function (meBlur, e, eOpts) {
                                                        form = me.getForm();
                                                        form.load({
                                                            url: '/crm/validarDigitoVerificacion',
                                                            params: {
                                                                idalterno: Ext.getCmp('idalterno_id').value,
                                                                dv: Ext.getCmp('dv_id').value
                                                            },
                                                            success: function (response, options) {
                                                                res = Ext.JSON.decode(options.response.responseText);
                                                                Ext.MessageBox.alert('Mensaje', res.data);
                                                                Ext.getCmp('dv_id').setValue("");
                                                            }
                                                        });
                                                    }
                                                }
                                            }]
                                    }, {
                                        xtype: 'container',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: {
                                            fieldLabel: 'Cliente',
                                            xtype: 'textfield',
                                            flex: 1,
                                            id: 'cliente',
                                            name: 'cliente',
                                            allowBlank: false
                                        }
                                    }, {
                                        xtype: 'container',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: 'Comercial',
                                                xtype: 'Colsys.Widgets.WgComerciales',
                                                id: 'comercial',
                                                name: 'comercial',
                                                renderer: comboBoxRenderer(this),
                                                allowBlank: false,
                                            }, {
                                                fieldLabel: 'Coord.Aduana',
                                                xtype: 'Colsys.Widgets.WgCoordinadoresAduana',
                                                id: 'coord_aduana',
                                                name: 'coord_aduana',
                                                renderer: comboBoxRenderer(this)
                                            }]
                                    }]
                            }, {
                                xtype: 'fieldset',
                                title: 'Domicilio Principal',
                                id: 'fieldsetdireccion1',
                                hidden: true,
                                layout: 'anchor',
                                defaults: {
                                    bodyStyle: 'padding:4px',
                                    anchor: '100%'
                                },
                                fieldDefaults: {
                                    labelAlign: 'right',
                                    margin: '0, 0, 5, 0'
                                },
                                items: {
                                    xtype: 'container',
                                    layout: 'hbox',
                                    combineErrors: true,
                                    defaultType: 'textfield',
                                    items: [{
                                            fieldLabel: 'Direcci&oacute;n',
                                            xtype: 'textfield',
                                            id: 'direccion0',
                                            labelWidth: 95,
                                            allowBlank: false,
                                            name: 'direccion0',
                                            flex: 2
                                        }, {
                                            fieldLabel: 'Localidad',
                                            xtype: 'textfield',
                                            id: 'localidad2',
                                            labelWidth: 65,
                                            name: 'localidad2',
                                            flex: 1
                                        }, {
                                            fieldLabel: 'Ciudad',
                                            xtype: 'Colsys.Widgets.WgCiudades2',
                                            labelWidth: 55,
                                            id: 'ciudad2',
                                            name: 'ciudad2',
                                            clientes: true,
                                            renderer: comboBoxRenderer(this),
                                            allowBlank: false,
                                            flex: 1
                                        }]
                                }
                            }, {
                                xtype: 'fieldset',
                                title: 'Domicilio Principal',
                                id: 'fieldsetdireccion2',
                                hidden: false,
                                defaults: {
                                    bodyStyle: 'padding:4px',
                                    hideLabel: 'true',
                                    anchor: '100%'
                                },
                                fieldDefaults: {
                                    labelAlign: 'right',
                                    margin: '0, 5, 5, 0',
                                    width: 54,
                                },
                                items: [{
                                        xtype: 'fieldcontainer',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: 'Direcci&oacute;n',
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'direccion1',
                                                name: 'direccion1',
                                                tipoCombo: 3,
                                                flex: 1,
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
                                                xtype: 'textfield',
                                                id: 'direccion2',
                                                name: 'direccion2',
                                            }, {
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'direccion3',
                                                name: 'direccion3',
                                                tipoCombo: 4,
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
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'direccion4',
                                                name: 'direccion4',
                                                tipoCombo: 5,
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
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'direccion5',
                                                name: 'direccion5',
                                                tipoCombo: 6,
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
                                                xtype: 'numberfield',
                                                id: 'direccion6',
                                                name: 'direccion6',
                                            }, {
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'direccion7',
                                                name: 'direccion7',
                                                tipoCombo: 4,
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
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'direccion8',
                                                name: 'direccion8',
                                                tipoCombo: 5,
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
                                                xtype: 'numberfield',
                                                id: 'direccion9',
                                                name: 'direccion9'
                                            }, {
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'direccion10',
                                                name: 'direccion10',
                                                tipoCombo: 7,
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
                                            }]
                                    }, {
                                        xtype: 'fieldcontainer',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: 'Oficina',
                                                id: 'oficina',
                                                name: 'oficina',
                                                width: 150
                                            }, {
                                                fieldLabel: 'Torre',
                                                labelWidth: 35,
                                                width: 90,
                                                id: 'torre',
                                                name: 'torre'
                                            }, {
                                                fieldLabel: 'Bloque',
                                                labelWidth: 45,
                                                width: 90,
                                                id: 'bloque',
                                                name: 'bloque'
                                            }, {
                                                fieldLabel: 'Interior',
                                                labelWidth: 45,
                                                width: 90,
                                                id: 'interior',
                                                name: 'interior'
                                            }, {
                                                fieldLabel: 'Complemento',
                                                labelWidth: 90,
                                                xtype: 'textfield',
                                                id: 'complemento',
                                                name: 'complemento',
                                                flex: 3
                                            }]
                                    }, {
                                        xtype: 'fieldcontainer',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: 'Ciudad',
                                                xtype: 'Colsys.Widgets.WgCiudades2',
                                                id: 'ciudad',
                                                name: 'ciudad',
                                                clientes: true,
                                                renderer: comboBoxRenderer(this),
                                                allowBlank: false,
                                                flex: 1
                                            }, {
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                fieldLabel: 'Localidad',
                                                id: 'localidad',
                                                name: 'localidad',
                                                tipoCombo: 8,
                                                displayField: 'localidad',
                                                valueField: 'localidad',
                                                flex: 1,
                                                store: Ext.create('Ext.data.Store', {
                                                    fields: ['id', 'nombre', 'localidad'],
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
                                                listConfig: {
                                                    loadingText: 'buscando...',
                                                    emptyText: 'No existen registros',
                                                    getInnerTpl: function () {
                                                        return '<tpl for="."><div class="search-item"><b>{localidad}</b> <br> {nombre} </div></tpl>';
                                                    }
                                                }
                                            }, {
                                                fieldLabel: 'C&oacute;digo Postal',
                                                xtype: 'textfield',
                                                id: 'codigo_postal',
                                                name: 'codigo_postal',
                                                flex: 1
                                            }
                                        ]
                                    }, {
                                        xtype: 'fieldcontainer',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: 'Tel&eacute;fono',
                                                xtype: 'textfield',
                                                id: 'telefono',
                                                name: 'telefono',
                                                flex: 1
                                            }, {
                                                fieldLabel: 'Fax',
                                                xtype: 'textfield',
                                                labelWidth: 35,
                                                id: 'fax',
                                                name: 'fax',
                                                flex: 1
                                            }, {
                                                xtype: 'textfield',
                                                fieldLabel: 'e-mail',
                                                labelWidth: 45,
                                                id: 'e_mail',
                                                name: 'e_mail',
                                                flex: 2
                                            }]
                                    }, {
                                        xtype: 'fieldcontainer',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                xtype: 'textfield',
                                                fieldLabel: 'P&aacute;gina Web',
                                                id: 'website',
                                                name: 'website',
                                                width: 370
                                            }]
                                    }
                                ]
                            }, {
                                id: 'representante_fs',
                                xtype: 'fieldset',
                                title: 'Representante Legal',
                                defaults: {
                                    bodyStyle: 'padding:4px',
                                    anchor: '100%'
                                },
                                fieldDefaults: {
                                    labelAlign: 'right',
                                    labelWidth: 95,
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'container',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: 'Nombres',
                                                xtype: 'textfield',
                                                id: 'nombre',
                                                name: 'nombre',
                                                allowBlank: false,
                                                maxLength: 30,
                                                flex: 3
                                            }, {
                                                fieldLabel: '1er Apellido',
                                                xtype: 'textfield',
                                                id: 'apellido1',
                                                name: 'apellido1',
                                                allowBlank: false,
                                                labelWidth: 85,
                                                maxLength: 15,
                                                flex: 2
                                            }, {
                                                fieldLabel: '2do Apellido',
                                                xtype: 'textfield',
                                                id: 'apellido2',
                                                name: 'apellido2',
                                                labelWidth: 85,
                                                maxLength: 15,
                                                flex: 2
                                            }, {
                                                fieldLabel: 'Titulo',
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'titulo',
                                                name: 'titulo',
                                                allowBlank: false,
                                                labelWidth: 50,
                                                tipoCombo: 1,
                                                flex: 2,
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
                                            }]
                                    }, {
                                        xtype: 'container',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        defaultType: 'textfield',
                                        items: [{
                                                fieldLabel: ' Tipo de ID',
                                                id: 'tpRepresentante',
                                                name: 'tpRepresentante',
                                                xtype: 'Colsys.Widgets.WgTipoIdentificacion',
                                                store: Ext.create('Ext.data.Store', {
                                                    fields: ['id', 'name', 'trafico'],
                                                    proxy: {
                                                        type: 'ajax',
                                                        url: '/widgets5/datosTipoIdentificacion',
                                                        reader: {
                                                            type: 'json',
                                                            root: 'root'
                                                        },
                                                        extraParams: {
                                                            idtrafico: 'CO-057'
                                                        }
                                                    },
                                                    autoLoad: true
                                                }),
                                                triggerAction: 'all',
                                                editable: false,
                                                allowBlank: false,
                                                renderer: comboBoxRenderer(this)
                                            }, {
                                                fieldLabel: 'Identificaci&oacute;n',
                                                xtype: 'textfield',
                                                id: 'idRepresentante',
                                                name: 'idRepresentante',
                                                flex: 1,
                                                allowNegative: false,
                                                allowBlank: false,
                                                hideTrigger: true,
                                                keyNavEnabled: false,
                                                mouseWheelEnabled: false,
                                                regex: /^[-\A-Z\s0-9]*$/,
                                                regexText: 'Solo se aceptan n\u00FAmeros, rayas y letras en may\u00FAcula'
                                            }, {
                                                fieldLabel: 'Genero',
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'genero',
                                                name: 'genero',
                                                labelWidth: 60,
                                                tipoCombo: 2,
                                                flex: 1,
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
                                            }]
                                    }]
                            }, {
                                xtype: 'fieldset',
                                title: 'Propiedades',
                                defaultType: 'checkbox',
                                layout: 'hbox',
                                defaults: {
                                    border: false
                                },
                                items: [{
                                        boxLabel: 'Cuentas Globales',
                                        name: 'cuenta_global',
                                        id: 'cuenta_global'
                                    }, {
                                        xtype: 'displayfield',
                                        value: ' ',
                                        fieldStyle: 'padding-left: 5px;',
                                    }, {
                                        boxLabel: 'Cliente de Cuadro',
                                        name: 'consolidar',
                                        id: 'consolidar'
                                    }
                                ]
                            }
                        ]
                    }, {
                        title: 'M&aacute;s Informaci&oacute;n',
                        items: [{
                                xtype: 'fieldset',
                                title: 'Perfil Econ&oacute;mico',
                                defaults: {
                                    bodyStyle: 'padding:4px',
                                    anchor: '100%'
                                },
                                fieldDefaults: {
                                    labelAlign: 'right',
                                    labelWidth: 95,
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'textareafield',
                                        name: 'actividad',
                                        id: 'actividad',
                                        fieldLabel: 'Actividad',
                                        height: 83,
                                        flex: 1
                                    }]
                            }, {
                                xtype: 'fieldset',
                                title: 'Evaluaci&oacute;n del Cliente',
                                defaults: {
                                    bodyStyle: 'padding:4px',
                                    anchor: '100%'
                                },
                                fieldDefaults: {
                                    labelAlign: 'right',
                                    labelWidth: 95,
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'container',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        items: [{
                                                fieldLabel: 'Status',
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'status',
                                                name: 'status',
                                                tipoCombo: 9,
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
                                                fieldLabel: 'Acuerdo de Confidencialidad',
                                                xtype: 'datefield',
                                                labelWidth: 220,
                                                flex: 2,
                                                id: 'confidencialidad',
                                                name: 'confidencialidad',
                                                format: 'Y-m-d',
                                                submitFormat: 'Y-m-d'
                                            }, {
                                                xtype: 'displayfield',
                                                value: '',
                                                flex: 1
                                            }]
                                    }, {
                                        xtype: 'container',
                                        layout: 'hbox',
                                        combineErrors: true,
                                        items: [{
                                                fieldLabel: 'Entidad',
                                                xtype: 'Colsys.Widgets.WgFormCliente',
                                                id: 'entidad',
                                                name: 'entidad',
                                                tipoCombo: 11,
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
                                                xtype: 'combobox',
                                                labelWidth: 220,
                                                fieldLabel: 'Reportado en Ley Insolvencia Econ.',
                                                flex: 2,
                                                name: 'leyinsolvencia',
                                                id: 'leyinsolvencia',
                                                store: ['No', 'S\u00ED']
                                            }, {
                                                xtype: 'displayfield',
                                                value: '',
                                                flex: 1
                                            }]
                                    }]
                            }, {
                                xtype: 'fieldset',
                                title: 'Comentarios Acerca del Cliente',
                                anchor: "100%",
                                height: 243,
                                autoScroll: true,
                                defaults: {
                                    bodyStyle: 'padding:4px'
                                },
                                items: [
                                    {
                                        xtype: 'textareafield',
                                        id: 'comentario',
                                        name: 'comentario',
                                        anchor: "100% 100%"
                                    }
                                ]
                            }]
                    }, {
                        title: 'Preferencias del Cliente',
                        items: [{
                                xtype: 'fieldset',
                                title: 'Preferencias',
                                height: 457,
                                defaults: {
                                    bodyStyle: 'padding:4px',
                                    anchor: '100%'
                                },
                                fieldDefaults: {
                                    labelAlign: 'right',
                                    labelWidth: 95,
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'textareafield',
                                        id: 'preferencias',
                                        name: 'preferencias',
                                        anchor: "100% 100%"
                                    }
                                ]
                            }]
                    }
                ],
                buttons: [{
                        xtype: 'button',
                        text: 'Guardar',
                        height: 30,
                        iconCls: 'disk',
                        handler: function () {
                            var idcliente = this.up('form').idcliente;
                            var form = this.up('form').getForm();
//                            var invalidFields = this.up('form').query("field{isValid()==false}"); //Lista los campos que no pasan la validación
//                            for (i = 0; i < invalidFields.length; i++) {
//                                console.log(invalidFields[i].name);
//                            }

                            if (form.isValid()) {
                                form.submit({
                                    url: '/crm/guardarDatosCliente',
                                    waitMsg: 'Guardando',
                                    params: {
                                        idcliente: idcliente
                                    },
                                    success: function (resp, op) {
                                        respuestaGuardar = Ext.JSON.decode(op.response.responseText);
                                        ref = respuestaGuardar.idcliente;
                                        nombreCliente = respuestaGuardar.nombreCliente;
                                        //Actualizar Form cuando se edita el cliente
                                        if (idcliente != null) {
                                            formMaster = Ext.getCmp("form-master-" + idcliente).getForm();
                                            formMaster.load({
                                                url: '/crm/datosCliente',
                                                params: {
                                                    idcliente: idcliente
                                                },
                                                success: function (response, options) {
                                                    res = Ext.JSON.decode(options.response.responseText);
                                                    Ext.getCmp('fieldset_coltrans' + idcliente).setTitle('<b>Coltrans:</b> ' + res.data.coltrans_estado);
                                                    Ext.getCmp('fieldset_colmas' + idcliente).setTitle('<b>Colmas:</b> ' + res.data.colmas_estado);
                                                    Ext.getCmp('form-master-' + idcliente).setTitle(res.data.identificacion);
                                                }
                                            });
//                                            formMasInfo = Ext.getCmp("Actividad" + idcliente).getForm();
//                                            formMasInfo.load({
//                                                url: '/crm/datosCliente',
//                                                params: {
//                                                    idcliente: idcliente
//                                                }
//                                            });
                                        }

                                        if (idcliente == null) {
                                            tabpanel = Ext.getCmp('tabpanel1');
                                            tabpanel.add({
                                                title: nombreCliente,
                                                id: 'tab' + ref,
                                                itemId: 'tab' + ref,
                                                closable: true,
                                                autoScroll: true,
                                                items: [
                                                    new Colsys.Crm.Mainpanel({
                                                        id: ref,
                                                        idcliente: ref,
                                                        permisos: ""
                                                    })
                                                ]
                                            }).show();

                                            tabpanel.setActiveTab('tab' + ref);
                                        }

                                        Ext.Msg.alert("Sucursal", "Datos almacenados correctamente");
                                        if (idcliente) {
                                            Ext.getCmp("FormClienteMaster" + idcliente).destroy();
                                        } else {
                                            Ext.getCmp("FormClienteMaster").destroy();
                                        }
                                        Ext.getCmp("winFormEdit").destroy();

                                    },
                                    failure: function (form, action) {
                                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (action.result ? ": " + action.result.errorInfo : "") + " " + (action.response ? "\n Codigo HTTP " + action.response.status : ""));
                                    }
                                });
                            } else {
                                Ext.Msg.alert("Error", "Ingresar los campos requeridos");
                            }
                        }
                    }]
            });
        },
        afterrender: function (ct, position) {
//            alert(this.idcliente);
            var me = this;
            form = this.getForm();
            form.load({
                url: '/crm/cargarDatosCliente',
                params: {
                    idcliente: this.idcliente
                },
                success: function (response, options) {
                    res = Ext.JSON.decode(options.response.responseText);
                    //recargar, validar y ubica el tipo identificacion
                    store = Ext.getCmp("tipo_identificacion").getStore();
                    store.reload({
                        callback: function (response, options) {

                            rec = store.findRecord("id", res.data.tipo_identificacion);
                            if (rec != null) {
                                Ext.getCmp("tipo_identificacion").setValue(rec);

                                //Limpiar filtro ciudadales 
                                store2 = Ext.getCmp('ciudad').getStore();
                                store2.clearFilter();

                                //cargar filtro de ciudades por primera vez y no aplica el filtro para consecutivo colsys
                                if (res.data.tipo_identificacion != 3) {
                                    store2.filterBy(function (record, id) {
                                        if (rec.data.trafico == record.data.trafico)
                                            return true;
                                        else
                                            return false;
                                    });
                                } else {
                                    Ext.getCmp('idalterno_id').disable();
                                }
                                //Habilitar campos direccion segun pais
                                if (rec.data.trafico == 'Colombia') {
                                    Ext.getCmp('ciudad').enable(false);
                                    Ext.getCmp('ciudad2').disable(true);
                                    Ext.getCmp('direccion0').disable(true);
                                    Ext.getCmp('fieldsetdireccion2').setVisible(true);
                                    Ext.getCmp('fieldsetdireccion1').setVisible(false);
                                } else {
                                    Ext.getCmp('ciudad').disable(true);
                                    Ext.getCmp('ciudad2').enable(true);
                                    Ext.getCmp('direccion0').enable(true);
                                    Ext.getCmp('fieldsetdireccion1').setVisible(true);
                                    Ext.getCmp('fieldsetdireccion2').setVisible(false);
                                }
                            }
                            idalternoInicial = Ext.getCmp("idalterno_id").value;
                            //Validar el si se puede editar el digito de verificacion en NIT(1)
                            if (res.data.tipo_identificacion != '1') {
                                Ext.getCmp('dv_id').disable();
                            } else {
                                Ext.getCmp('dv_id').enable();
                            }

                        }
                    });
                }
            });
        }
    }
});