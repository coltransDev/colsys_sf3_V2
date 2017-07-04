comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};
function setReadOnlyForAll(form, readOnly) {
    Ext.suspendLayouts();
    form.getFields().each(function (field) {
        field.setReadOnly(readOnly);
    });
    if (readOnly)
        Ext.getCmp('bntGuardar').setVisible(false);
    else
        Ext.getCmp('bntGuardar').setVisible(true);

    Ext.resumeLayouts();
};

Ext.define('ComboContactos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-contactos',
    queryMode: 'local',
    valueField: 'idcontacto',
    displayField: 'nombre',
    store: {
        fields: [{name: 'idcontacto', type: 'string'}, {name: 'nombre', type: 'string'}],
        data: []
    }
});

Ext.define('ComboSucursales', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-sucursales',
    queryMode: 'local',
    valueField: 'idsucursal',
    displayField: 'direccion',
    store: {
        fields: [{name: 'idsucursal', type: 'string'}, {name: 'direccion', type: 'string'}],
        data: []
    }
});

var checkBoxInstItems = [
    {boxLabel: 'Local', name: 'instalaciones_tipo', inputValue: 'Local'},
    {boxLabel: 'Oficina', name: 'instalaciones_tipo', inputValue: 'Oficina'},
    {boxLabel: 'Bodega', name: 'instalaciones_tipo', inputValue: 'Bodega'},
    {boxLabel: 'Casa', name: 'instalaciones_tipo', inputValue: 'Casa'},
    {boxLabel: 'Apartamento', name: 'instalaciones_tipo', inputValue: 'Apartamento'},
    {boxLabel: 'Planta/Producci&oacute;n', name: 'instalaciones_tipo', inputValue: 'Planta/Producci&oacute;n'},
];

Ext.define('CheckInstalaciones', {
    id: 'checkboxInst',
    extend: 'Ext.form.CheckboxGroup',
    alias: 'widget.check-instalaciones',
    xtype: 'checkboxgroup',
    columns: 3,
    vertical: false,
    items: checkBoxInstItems,
    checkItems: function (itemsChecked) {
        var checked = itemsChecked.split(",");
        this.items.each(function (checkItem, index, totalCount) {
            if (checked.indexOf(checkItem.boxLabel) != -1) {
                checkItem.setValue(1);
            }
        });
    }
});

Ext.define('ComboPertenencia', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-pertenencia',
    store: ['Propia', 'Arrendado', 'Otro']
});

Ext.define('ComboUso', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-uso',
    store: ['Exclusivo', 'Compartido']
});

Ext.define('ComboCondiciones', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-condiciones',
    store: ['Normal', 'Lujosas', 'Otro']
});

var checkBoxSeguItems = [
    {boxLabel: 'Alarma', name: 'sistema_seguridad', inputValue: 'Alarma'},
    {boxLabel: 'Biom&eacute;tricos', name: 'sistema_seguridad', inputValue: 'Biom&eacute;tricos'},
    {boxLabel: 'CCTV', name: 'sistema_seguridad', inputValue: 'CCTV'},
    {boxLabel: 'Vigilancia_Privada', name: 'sistema_seguridad', inputValue: 'Vigilancia_Privada'},
    {boxLabel: 'Todos', name: 'sistema_seguridad', inputValue: 'Todos'},
    {boxLabel: 'Ninguno', name: 'sistema_seguridad', inputValue: 'Ninguno'}
];

Ext.define('CheckSeguridad', {
    id: 'checkboxSegu',
    extend: 'Ext.form.CheckboxGroup',
    alias: 'widget.check-seguridad',
    xtype: 'checkboxgroup',
    columns: 3,
    vertical: false,
    items: checkBoxSeguItems,
    listeners: {
        change: function (checkBox, newValue, oldValue, eOpts) {
            if (Ext.Object.isEmpty(oldValue)) {
                if (newValue.sistema_seguridad.indexOf('Todos') != -1) {
                    this.items.each(function (checkItem, index, totalCount) {
                        if (checkItem.inputValue != 'Ninguno' && checkItem.inputValue != 'Todos') {
                            checkItem.setValue(1);
                        } else {
                            checkItem.setValue(0);
                        }
                    });
                }
            } else if (!Ext.Object.isEmpty(oldValue)) {
                if (newValue.sistema_seguridad) {
                    if (newValue.sistema_seguridad.indexOf('Ninguno') != -1) {
                        this.items.each(function (checkItem, index, totalCount) {
                            if (checkItem.inputValue != 'Ninguno') {
                                checkItem.setValue(0);
                            }
                        });
                    }
                }
            }
        }
    },
    checkItems: function (itemsChecked) {
        var checked = itemsChecked.split(",");
        this.items.each(function (checkItem, index, totalCount) {
            if (checked.indexOf(checkItem.boxLabel) != -1) {
                checkItem.setValue(1);
            }
        });
    }
});

var checkBoxCertItems = [
    {boxLabel: 'ISO_9001', name: 'certificacion', inputValue: 'ISO_9001'},
    {boxLabel: 'ISO_14001', name: 'certificacion', inputValue: 'ISO_14001'},
    {boxLabel: 'ISO_18001', name: 'certificacion', inputValue: 'ISO_18001'},
    {boxLabel: 'ISO_28000', name: 'certificacion', inputValue: 'ISO_28000'},
    {boxLabel: 'BASC', name: 'certificacion', inputValue: 'BASC'},
    {boxLabel: 'C-PAT', name: 'certificacion', inputValue: 'C-PAT'},
    {boxLabel: 'OEA', name: 'certificacion', inputValue: 'OEA'},
    {boxLabel: 'NINGUNO', name: 'certificacion', inputValue: 'NINGUNO'},
    {boxLabel: 'OTRA', name: 'certificacion', inputValue: 'OTRA'}
];

Ext.define('CheckCertificaciones', {
    id: 'checkboxCert',
    extend: 'Ext.form.CheckboxGroup',
    alias: 'widget.check-certificaciones',
    xtype: 'checkboxgroup',
    columns: 5,
    vertical: true,
    items: checkBoxCertItems,
    listeners: {
        change: function (checkBox, newValue, oldValue, eOpts) {
            if (Ext.Object.isEmpty(newValue)) {
                Ext.getCmp("cert_otro").setDisabled(true);
            } else {
                this.items.each(function (checkItem, index, totalCount) {
                    if (checkItem.inputValue == 'OTRA') {
                        Ext.getCmp("cert_otro").setDisabled(!checkItem.checked);
                    }
                });
            }
            if (!Ext.Object.isEmpty(oldValue)) {
                if (newValue.certificacion) {
                    if (newValue.certificacion.indexOf('NINGUNO') != -1) {
                        Ext.getCmp("cert_otro").setDisabled(true);
                        this.items.each(function (checkItem, index, totalCount) {
                            if (checkItem.inputValue != 'NINGUNO') {
                                checkItem.setValue(0);
                            }
                        });
                    }
                }
            }
        }
    },
    checkItems: function (itemsChecked) {
        var checked = itemsChecked.split(",");
        this.items.each(function (checkItem, index, totalCount) {
            if (checked.indexOf(checkItem.boxLabel) != -1) {
                checkItem.setValue(1);
            }
        });
    }
});

Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('Colsys.Crm.FormEncuestaVisita', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormEncuestaVisita',
    height: 570,
    listeners: {
        afterrender: function (ct, position) {
            form = this.getForm();
            form.load({
                url: '/clientes/datosEncuestaVisitaById',
                params: {
                    idencuesta: this.idencuesta
                },
                success: function (response, options) {
                    setReadOnlyForAll(form, true);
                }
            });
        },
        beforerender: function (me, eOpts) {
            this.add({
                xtype: 'tabpanel',
                items: [{
                        title: 'Informaci&oacute;n General',
                        xtype: 'panel',
                        bodyPadding: 4,
                        defaults: {
                            anchor: '100%',
                            labelWidth: 60
                        },
                        fieldDefaults: {
                            anchor: '100%'
                        },
                        layout: {
                            type: 'vbox',
                            align: 'stretch'
                        },
                        items: [{
                                xtype: 'fieldcontainer',
                                fieldLabel: 'Contacto',
                                combineErrors: true,
                                msgTarget: 'side',
                                layout: 'hbox',
                                defaults: {
                                    allowBlank: false,
                                    flex: 1
                                },
                                items: [{
                                        xtype: 'combo-contactos',
                                        name: 'idcontacto',
                                        forceSelection: true,
                                        allowBlank: false,
                                        editable: false
                                    }, {
                                        fieldLabel: 'Suc.',
                                        labelWidth: 30,
                                        xtype: 'combo-sucursales',
                                        name: 'idsucursal',
                                        // forceSelection: true,    /*FIX-ME Habilitar con el nuevo m&oacute;dulo de clientes, para que exija la sucursal*/
                                        allowBlank: true,
                                        editable: false
                                    }, {
                                        fieldLabel: 'Fecha Visita',
                                        labelWidth: 80,
                                        xtype: 'datefield',
                                        name: 'fchvisita'
                                    }
                                ]
                            }, {
                                xtype: 'fieldset',
                                title: 'Infraestructura',
                                collapsible: false,
                                defaults: {
                                    anchor: '100%',
                                    margin: '1 2 0 2',
                                    allowBlank: false
                                },
                                layout: 'column',
                                items: [{
                                        fieldLabel: '&#191;Tipo de instalaciones?',
                                        labelWidth: 145,
                                        xtype: 'check-instalaciones',
                                        forceSelection: true,
                                        columnWidth: 0.72
                                    }, {
                                        xtype: 'textfield',
                                        labelWidth: 40,
                                        fieldLabel: 'Otras',
                                        name: 'instalaciones_otro',
                                        allowBlank: true,
                                        columnWidth: 0.28
                                    }, {
                                        fieldLabel: '&#191;Uso de las instalaciones?',
                                        labelWidth: 170,
                                        xtype: 'combo-uso',
                                        forceSelection: true,
                                        name: 'instalaciones_uso',
                                        columnWidth: 0.5
                                    }, {
                                        fieldLabel: '&#191;Tipo de pertenencia?',
                                        labelWidth: 150,
                                        xtype: 'combo-pertenencia',
                                        forceSelection: true,
                                        name: 'instalaciones_pertenencia',
                                        columnWidth: 0.5
                                    }, {
                                        fieldLabel: '&#191;Es al mismo tiempo lugar de Vivienda?',
                                        labelWidth: 170,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'instalaciones_vivienda',
                                        columnWidth: 0.45
                                    }, {
                                        fieldLabel: '&#191;Condiciones f&iacute;sicas acorde con el objeto social?',
                                        labelWidth: 230,
                                        xtype: 'combo-condiciones',
                                        forceSelection: true,
                                        name: 'instalaciones_condiciones',
                                        columnWidth: 0.55
                                    }, {
                                        fieldLabel: '&#191;Cuenta con sistemas de seguridad y/o Vigilancia?',
                                        labelWidth: 160,
                                        xtype: 'check-seguridad',
                                        forceSelection: true,
                                        columnWidth: 0.75
                                    }, {
                                        xtype: 'textfield',
                                        labelWidth: 40,
                                        fieldLabel: 'Otras',
                                        name: 'sistema_seguridad_otro',
                                        allowBlank: true,
                                        columnWidth: 0.25
                                    }
                                ]
                            }, {
                                xtype: 'fieldset',
                                title: 'Seguridad',
                                collapsible: false,
                                defaults: {
                                    anchor: '100%',
                                    margin: '1 2 0 2',
                                    allowBlank: false
                                },
                                layout: 'column',
                                items: [{
                                        fieldLabel: '&#191;Tiene control para el ingreso y/o salida de empleados?',
                                        labelWidth: 250,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'control_empleados',
                                        columnWidth: 0.50
                                    }, {
                                        fieldLabel: '&#191;Tiene control para el ingreso y/o salida de visitantes?',
                                        labelWidth: 250,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'control_visitantes',
                                        columnWidth: 0.50
                                    }, {
                                        fieldLabel: '&#191;Se realiza cargue y/o descargue de mercanc&iacute;a dentro de las instalaciones?',
                                        labelWidth: 250,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'manejo_mercancias',
                                        columnWidth: 0.50
                                    }, {
                                        fieldLabel: '&#191;Cuenta con un procedimiento para cargue y/o descargue de la mercanc&iacute;a?',
                                        labelWidth: 250,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'manejo_mercancias_procedimiento',
                                        columnWidth: 0.50
                                    }, {
                                        fieldLabel: '&#191;Tiene controles de acceso a la zona de cargue y descargue de mercancias?',
                                        labelWidth: 250,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'manejo_mercancias_zona',
                                        columnWidth: 0.50
                                    }, {
                                        xtype: 'textfield',
                                        labelWidth: 70,
                                        fieldLabel: '&#191;Cuales controles? ',
                                        name: 'manejo_mercancias_detalles',
                                        columnWidth: 0.50,
                                        allowBlank: true
                                    }, {
                                        fieldLabel: '&#191;Dispone de un plano de &aacute;reas sensibles?',
                                        labelWidth: 130,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'areas_sensibles',
                                        columnWidth: 0.30
                                    }, {
                                        fieldLabel: '&#191;Tiene un procedimiento documentado para la prevenci&oacute;n del lavado de activos y financiaci&oacute;n del terrorismo?',
                                        labelWidth: 340,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'prevencion_lavado_activos',
                                        columnWidth: 0.70
                                    }, {
                                        fieldLabel: '&#191;Cuenta con certificaci&oacute;n en sistemas de calidad?',
                                        labelWidth: 150,
                                        xtype: 'check-certificaciones',
                                        columnWidth: 0.79
                                    }, {
                                        id: 'cert_otro',
                                        xtype: 'textfield',
                                        name: 'certificacion_otro',
                                        allowBlank: false,
                                        disabled: true,
                                        columnWidth: 0.21
                                    }, {
                                        fieldLabel: '&#191;Tiene planeado implementar un sistema de calidad y/o seguridad?',
                                        labelWidth: 210,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'implementacion_sistema',
                                        columnWidth: 0.40
                                    }, {
                                        fieldLabel: '&#191;Cu&aacute;l y Cuando?',
                                        labelWidth: 60,
                                        xtype: 'textfield',
                                        maxLength: 128,
                                        allowBlank: true,
                                        name: 'implementacion_sistema_detalles',
                                        columnWidth: 0.60
                                    }
                                ]
                            }
                        ]
                    }, {
                        title: 'Recomendaci&oacute;n',
                        xtype: 'panel',
                        bodyPadding: 4,
                        defaults: {
                            anchor: '100%',
                            labelWidth: 60
                        },
                        fieldDefaults: {
                            anchor: '100%'
                        },
                        layout: {
                            type: 'vbox',
                            align: 'stretch'
                        },
                        items: [{
                                xtype: 'container',
                                collapsible: false,
                                defaults: {
                                    anchor: '100%',
                                    margin: '1 2 0 2',
                                    allowBlank: false
                                },
                                layout: 'column',
                                items: [{
                                        fieldLabel: '&#191;Recomienda trabajar con el cliente?',
                                        labelWidth: 220,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'recomienda_trabajar',
                                        columnWidth: 0.40
                                    }, {
                                        xtype: 'displayfield',
                                        columnWidth: 0.60
                                    }, {
                                        xtype: 'fieldset',
                                        title: 'Concepto de seguridad',
                                        collapsible: false,
                                        anchor: '100%',
                                        margin: '1 2 0 2',
                                        columnWidth: 0.495,
                                        items: {
                                            xtype: 'textareafield',
                                            width: 343,
                                            height: 55,
                                            name: 'concepto_seguridad',
                                            allowBlank: false
                                        }
                                    }, {
                                        xtype: 'fieldset',
                                        title: 'Observaciones',
                                        collapsible: false,
                                        anchor: '100%',
                                        margin: '1 2 0 2',
                                        columnWidth: 0.495,
                                        items: {
                                            xtype: 'textareafield',
                                            name: 'observaciones',
                                            width: 343,
                                            height: 55,
                                            allowBlank: false
                                        }
                                    }
                                ]
                            }]
                    }],
                setReadOnlyForAll: function (readOnly) {
                    Ext.suspendLayouts();
                    this.getForm().getFields().each(function (field) {
                        field.setReadOnly(readOnly);
                    });
                    if (readOnly)
                        Ext.getCmp('bntGuardar').setVisible(false);
                    else
                        Ext.getCmp('bntGuardar').setVisible(true);

                    Ext.resumeLayouts();
                },
                dockedItems: {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer',
                    buttonAlign: 'right',
                    items: [{
                            xtype: 'label',
                            text: 'Importante',
                            maxWidth: 70,
                            cls: 'boxLabelTitle'
                        }, {
                            xtype: 'label',
                            text: 'Si el cliente tiene bodegas y/o planta de producci&oacute;n para el manejo de la carga en un lugar diferente al de esta visita, se debe realizar la visita de verificaci&oacute;n a dichas instalaciones.',
                            maxWidth: 430,
                            cls: 'boxLabel'
                        }, '->', {
                            id: 'bntGuardar',
                            text: 'Guardar',
                            handler: function () {
                                var idcliente = this.up('form').idcliente;
                                var me = this;
                                var form = me.up('form').getForm();
                                var data = form.getFieldValues();
                                var str = JSON.stringify(data);

                                if (form.isValid()) {
                                    Ext.Ajax.request({
                                        waitMsg: 'Guardando cambios...',
                                        url: '/clientes/guardarEncuestaVisita',
                                        params: {
                                            datos: str
                                        },
                                        failure: function (response, options) {
                                            var res = Ext.util.JSON.decode(response.responseText);
                                            if (res.errorInfo)
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                            else
                                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                                        },
                                        success: function (response, options) {
                                            //me.findParentByType('window').close();
                                            Ext.getCmp("formEncuestaVisita").destroy();
                                            Ext.getCmp("winEncuestaVisita").destroy();
                                            Ext.getCmp("gridNuevaEncuesta" + idcliente).getStore().reload();
                                            Ext.MessageBox.alert("Mensaje", 'Encuesta almacenada correctamente<br>');
                                        }
                                    });
                                }
                            }
                        }, {
                            text: 'Cancelar',
                            handler: function () {
                                Ext.getCmp("formEncuestaVisita").destroy();
                                Ext.getCmp("winEncuestaVisita").destroy();
                            }
                        }
                    ]
                }
            });
        }
    }
});