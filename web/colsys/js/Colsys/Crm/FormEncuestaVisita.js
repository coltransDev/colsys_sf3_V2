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
}
;

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
    columns: 6,
    vertical: false,
    items: checkBoxInstItems,
    checkItems: function (itemsChecked) {
        var checked = itemsChecked.split(",");
        this.items.each(function (checkItem, index, totalCount) {
            if (checked.indexOf(checkItem.boxLabel) != -1) {
                checkItem.setValue(true);
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
    {boxLabel: 'Otros', name: 'sistema_seguridad', inputValue: 'Otros'},
    {boxLabel: 'Vigilancia_Privada', name: 'sistema_seguridad', inputValue: 'Vigilancia_Privada'},
    {boxLabel: 'CCTV', name: 'sistema_seguridad', inputValue: 'CCTV'},
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
            if (!Ext.Object.isEmpty(oldValue)) {
                if (newValue.sistema_seguridad) {
                    if (newValue.sistema_seguridad.indexOf('Ninguno') != -1) {
                        this.items.each(function (checkItem, index, totalCount) {
                            if (checkItem.inputValue != 'Ninguno') {
                                checkItem.setValue(false);
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
                checkItem.setValue(true);
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
                                checkItem.setValue(false);
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
                checkItem.setValue(true);
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
    listeners: {
        afterrender: function (ct, position) {
            form = this.getForm();
            form.load({
                url: '/clientes/datosEncuestaVisitaById',
                params: {
                    idencuesta: this.idencuesta
                },
                success: function (form, action) {
                    rec = action.result;
                    var checkBox = Ext.getCmp("checkboxInst");
                    checkBox.checkItems(rec.data.instalaciones_tipo);
                    var checkBox = Ext.getCmp("checkboxSegu");
                    checkBox.checkItems(rec.data.sistema_seguridad);
                    var checkBox = Ext.getCmp("checkboxCert");
                    checkBox.checkItems(rec.data.certificaciones);
                    setReadOnlyForAll(form, true);
                }
            });
        },
        beforerender: function (me, eOpts) {
            this.add({
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
                items: [
                    {
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
                                xtype: 'Colsys.Widgets.WgContactos',
                                name: 'idcontacto',
                                idcliente: this.idcliente,
                                forceSelection: true,
                                allowBlank: false,
                                editable: false
                            }, {
                                xtype: 'Colsys.Widgets.WgSucursalesIds',
                                name: 'idsucursal',
                                empresa: this.idcliente,
                                fieldLabel: 'Suc.',
                                labelWidth: 30,
                                forceSelection: true, /*FIX-ME Habilitar con el nuevo m&oacute;dulo de clientes, para que exija la sucursal*/
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
                                xtype: 'container',
                                layout: 'column',
                                columnWidth: 1,
                                items: [{
                                        fieldLabel: '&#191;Tipo de instalaciones?',
                                        labelWidth: 143,
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
                                    }]
                            }, {
                                xtype: 'container',
                                layout: 'column',
                                columnWidth: 0.48,
                                items: [{
                                        fieldLabel: '&#191;Es al mismo tiempo lugar de Vivienda?',
                                        labelWidth: 130,
                                        xtype: 'combo-si-no',
                                        forceSelection: true,
                                        name: 'instalaciones_vivienda',
                                        columnWidth: 0.5
                                    }, {
                                        fieldLabel: '&#191;Uso de las instalaciones?',
                                        labelWidth: 90,
                                        xtype: 'combo-uso',
                                        forceSelection: true,
                                        name: 'instalaciones_uso',
                                        columnWidth: 0.5
                                    }]
                            }, {
                                xtype: 'container',
                                layout: 'column',
                                columnWidth: 0.52,
                                items: [{
                                        fieldLabel: '&#191;Tipo de pertenencia?',
                                        labelWidth: 90,
                                        xtype: 'combo-pertenencia',
                                        forceSelection: true,
                                        name: 'instalaciones_pertenencia',
                                        columnWidth: 0.5
                                    }, {
                                        fieldLabel: '&#191;Condiciones f&iacute;sicas acorde con el objeto social?',
                                        labelWidth: 170,
                                        xtype: 'combo-condiciones',
                                        forceSelection: true,
                                        name: 'instalaciones_condiciones',
                                        columnWidth: 0.5
                                    }]
                            }, {
                                xtype: 'container',
                                layout: 'column',
                                columnWidth: 1,
                                items: [{
                                        fieldLabel: '&#191;Cuenta con sistemas de seguridad y/o Vigilancia?',
                                        labelWidth: 160,
                                        xtype: 'check-seguridad',
                                        forceSelection: true,
                                        columnWidth: 0.60
                                    }, {
                                        xtype: 'textfield',
                                        labelWidth: 60,
                                        fieldLabel: '&#191;Cu&aacute;les?',
                                        name: 'sistema_seguridad_otro',
                                        allowBlank: true,
                                        columnWidth: 0.40
                                    }]
                            }]
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
                                labelWidth: 200,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'control_empleados',
                                columnWidth: 0.32
                            }, {
                                fieldLabel: '&#191;Tiene control para el ingreso y/o salida de visitantes?',
                                labelWidth: 200,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'control_visitantes',
                                columnWidth: 0.32
                            }, {
                                fieldLabel: '&#191;Se realiza cargue y/o descargue de mercanc&iacute;a dentro de las instalaciones?',
                                labelWidth: 233,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias',
                                columnWidth: 0.36
                            }, {
                                fieldLabel: '&#191;Cuenta con un procedimiento para cargue y/o descargue de mercanc&iacute;a?',
                                labelWidth: 220,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias_procedimiento',
                                columnWidth: 0.33
                            }, {
                                fieldLabel: '&#191;Dispone de un plano de &aacute;reas sensibles?',
                                labelWidth: 130,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'areas_sensibles',
                                columnWidth: 0.22
                            }, {
                                fieldLabel: '&#191;Tiene un procedimiento documentado para prevenci&oacute;n del lavado de activos y financiaci&oacute;n del terrorismo?',
                                labelWidth: 325,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'prevencion_lavado_activos',
                                columnWidth: 0.45
                            }, {
                                fieldLabel: '&#191;Tiene controles de acceso a la zona de cargue y descargue de mercancias?',
                                labelWidth: 240,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias_zona',
                                columnWidth: 0.38
                            }, {
                                xtype: 'textfield',
                                labelWidth: 70,
                                fieldLabel: '&#191;Cu&aacute;les controles? ',
                                name: 'manejo_mercancias_detalles',
                                columnWidth: 0.62,
                                allowBlank: true
                            }, {
                                fieldLabel: '&#191;Cuenta con certificaci&oacute;n en sistemas de calidad?',
                                labelWidth: 150,
                                xtype: 'check-certificaciones',
                                columnWidth: 0.70
                            }, {
                                id: 'cert_otro',
                                xtype: 'textfield',
                                name: 'certificacion_otro',
                                allowBlank: false,
                                disabled: true,
                                columnWidth: 0.30
                            }, {
                                fieldLabel: '&#191;Tiene planeado implementar un sistema de calidad y/o seguridad?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'implementacion_sistema',
                                columnWidth: 0.55
                            }, {
                                fieldLabel: '&#191;Cu&aacute;l y Cuando?',
                                labelWidth: 110,
                                xtype: 'textfield',
                                maxLength: 128,
                                allowBlank: true,
                                name: 'implementacion_sistema_detalles',
                                columnWidth: 0.45
                            }
                        ]
                    }, {
                        xtype: 'container',
                        layout: 'column',
                        items: [{
                                xtype: 'fieldset',
                                title: '-',
                                collapsible: false,
                                margin: '1 2 0 2',
                                columnWidth: 0.26,
                                items: {
                                    fieldLabel: '&#191;Recomienda trabajar con el cliente?',
                                    labelWidth: 140,
                                    xtype: 'combo-si-no',
                                    forceSelection: true,
                                    allowBlank: false,
                                    name: 'recomienda_trabajar',
                                    anchor: '100%'
                                }
                            }, {
                                xtype: 'fieldset',
                                title: 'Concepto de seguridad',
                                collapsible: false,
                                anchor: '100%',
                                margin: '1 2 0 2',
                                columnWidth: 0.37,
                                items: {
                                    xtype: 'textareafield',
                                    name: 'concepto_seguridad',
                                    allowBlank: false,
                                    anchor: '100%'
                                }
                            }, {
                                xtype: 'fieldset',
                                title: 'Observaciones',
                                collapsible: false,
                                anchor: '100%',
                                margin: '1 2 0 2',
                                columnWidth: 0.37,
                                items: {
                                    xtype: 'textareafield',
                                    name: 'observaciones',
                                    allowBlank: false,
                                    anchor: '100%'
                                }
                            }
                        ]
                    }
                ],
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
                            height: 50,
                            cls: 'boxLabelTitle'
                        }, {
                            xtype: 'label',
                            text: 'Si el cliente tiene bodegas y/o planta de producci\u00f3n para el manejo de la carga en un lugar diferente al de esta visita, se debe realizar la visita de verificaci\u00f3n a dichas instalaciones.',
                            maxWidth: 650,
                            height: 50,
                            cls: 'boxLabel'
                        }, '->', {
                            id: 'bntGuardar',
                            text: 'Guardar',
                            handler: function () {
                                var idcliente = this.up('form').idcliente;
                                var me = this;
                                var form = me.up('form').getForm();
                                var data = form.getFieldValues();

                                if (!data.instalaciones_tipo || data.instalaciones_tipo.length == 0) {
                                    Ext.MessageBox.alert("Mensaje", 'Seleccione por lo menos un tipo de instalaci&oacute;n!');
                                    return;
                                }
                                var inst = [];
                                for (var i = 0; i < data.instalaciones_tipo.length; i++) {
                                    if (data.instalaciones_tipo[i]) {
                                        inst.push(checkBoxInstItems[i].inputValue);
                                    }
                                }
                                data.instalaciones_tipo = inst.toString();

                                if (!data.sistema_seguridad || data.sistema_seguridad.length == 0) {
                                    Ext.MessageBox.alert("Mensaje", 'Seleccione por lo menos un sistema de seguridad!');
                                    return;
                                }
                                var segu = [];
                                for (var i = 0; i < data.sistema_seguridad.length; i++) {
                                    if (data.sistema_seguridad[i]) {
                                        segu.push(checkBoxSeguItems[i].inputValue);
                                    }
                                }
                                data.sistema_seguridad = segu.toString();

                                if (!data.certificacion || data.certificacion.length == 0) {
                                    Ext.MessageBox.alert("Mensaje", 'Seleccione por lo menos una opci&oacute;n de certificado!');
                                    return;
                                }
                                var cert = [];
                                for (var i = 0; i < data.certificacion.length; i++) {
                                    if (data.certificacion[i]) {
                                        cert.push(checkBoxCertItems[i].inputValue);
                                    }
                                }
                                data.certificacion = cert.toString();
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