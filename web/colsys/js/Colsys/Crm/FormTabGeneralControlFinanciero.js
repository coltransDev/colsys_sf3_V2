comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('ComboNit', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-nit',
    store: ['Agente', 'Proveedor', 'Usuario', 'Excepci\u00F3n Temporal', 'Excepci\u00F3n Permanente']
});

Ext.define('ComboRiesgo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-riesgo',
    store: ['M\u00ednimo', 'Medio', 'Alto']
});

Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['S\u00ed', 'No']
});

Ext.define('Colsys.Crm.FormTabGeneralControlFinanciero', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabGeneralControlFinanciero',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add({
                xtype: 'fieldset',
                id: 'fieldset_datosCliente_general' + me.idcliente,
                collapsible: false,
                defaults: {
                    width: 700
                },
                items: [{
                        xtype: 'fieldset',
                        title: 'Perfil Empresarial',
                        id: 'fieldset_perfil_empresarial' + me.idcliente,
                        collapsible: false,
                        defaults: {
                            hideLabel: false
                        },
                        items: [{
                                xtype: 'fieldcontainer',
                                id: 'fieldcontainer_perfil_empresarial_uno' + me.idcliente,
                                hideLabel: true,
                                combineErrors: true,
                                msgTarget: 'under',
                                layout: 'hbox',
                                defaults: {
                                    flex: 2,
                                    hideLabel: false
                                },
                                fieldDefaults: {
                                    labelWidth: 100,
                                    labelAlign: 'right',
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'Colsys.Widgets.WgTipoPersona',
                                        hideLabel: false,
                                        fieldLabel: 'Tipo Persona',
                                        id: 'tipopersona_tributaria' + me.idcliente,
                                        name: 'tipopersona',
                                        forceSelection: true,
                                        renderer: comboBoxRenderer(this),
                                        listeners: {
                                            select: {
                                                fn: function (combo, record, eOpts) {
                                                    if (combo.value == "2") {
                                                        // Ext.getCmp('fieldset_personajuridica_tributaria' + me.idcliente).setVisible(true);
                                                    } else {
                                                        // Ext.getCmp('fieldset_personajuridica_tributaria' + me.idcliente).setVisible(false);
                                                    }
                                                }
                                            }
                                        }
                                    }, {
                                        xtype: 'datefield',
                                        fieldLabel: 'Fch.Constituci&oacute;n',
                                        name: 'fechaconstitucion',
                                        id: 'fechaconstitucion_tributaria' + me.idcliente,
                                        labelWidth: 110,
                                        format: 'Y-m-d',
                                        submitFormat: 'Y-m-d',
                                        forceSelection: false
                                    }, {
                                        id: 'regimen_tributaria' + me.idcliente,
                                        name: 'regimen',
                                        xtype: 'Colsys.Widgets.WgRegimen',
                                        fieldLabel: 'R&eacute;gimen',
                                        renderer: comboBoxRenderer(this),
                                        labelWidth: 70
                                    }]
                            }, {
                                xtype: 'fieldcontainer',
                                id: 'fieldcontainer_perfil_empresarial_dos' + me.idcliente,
                                defaultType: 'checkbox',
                                hideLabel: true,
                                combineErrors: true,
                                msgTarget: 'under',
                                layout: 'hbox',
                                defaults: {
                                    flex: 1,
                                    hideLabel: false
                                },
                                fieldDefaults: {
                                    labelWidth: 100,
                                    labelAlign: 'right',
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        fieldLabel: 'Comerciante',
                                        boxLabel: '',
                                        name: 'comerciante',
                                        id: 'comerciante_tributaria' + me.idcliente
                                    }, {
                                        fieldLabel: 'UAP',
                                        boxLabel: '',
                                        name: 'uap',
                                        id: 'uap_tributaria' + me.idcliente
                                    }, {
                                        fieldLabel: 'Altex',
                                        boxLabel: '',
                                        name: 'altex',
                                        id: 'altex_tributaria' + me.idcliente
                                    }, {
                                        fieldLabel: 'OEA',
                                        boxLabel: '',
                                        name: 'oea',
                                        id: 'oea_tributaria' + me.idcliente
                                    }]
                            }]
                    }, {
                        xtype: 'fieldset',
                        title: 'C&oacute;digos CIIU',
                        id: 'fieldset_codigos_ciiu' + me.idcliente,
                        collapsible: false,
                        defaults: {
                            hideLabel: false
                        },
                        items: [{
                                xtype: 'fieldcontainer',
                                id: 'fieldcontainer_codigos_ciiu' + me.idcliente,
                                defaultType: 'checkbox',
                                hideLabel: true,
                                combineErrors: true,
                                msgTarget: 'under',
                                layout: 'hbox',
                                defaults: {
                                    flex: 4,
                                    hideLabel: false
                                },
                                fieldDefaults: {
                                    labelWidth: 80,
                                    labelAlign: 'right',
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        fieldLabel: 'Principal',
                                        xtype: 'Colsys.Widgets.WgCodigoCiiu',
                                        id: 'cod_ciiu_uno',
                                        name: 'cod_ciiu_uno',
                                        labelWidth: 100,
                                        flex: 5,
                                        store: Ext.create('Ext.data.Store', {
                                            fields: ['codigo', 'mostrar'],
                                            proxy: {
                                                type: 'ajax',
                                                url: '/widgets5/datosCodigos',
                                                reader: {
                                                    type: 'json',
                                                    root: 'root'
                                                }
                                            },
                                            autoLoad: true
                                        }),
                                        renderer: comboBoxRenderer(this)
                                    }, {
                                        fieldLabel: 'Secundario',
                                        xtype: 'Colsys.Widgets.WgCodigoCiiu',
                                        id: 'cod_ciiu_dos',
                                        name: 'cod_ciiu_dos',
                                        store: Ext.create('Ext.data.Store', {
                                            fields: ['codigo', 'mostrar'],
                                            proxy: {
                                                type: 'ajax',
                                                url: '/widgets5/datosCodigos',
                                                reader: {
                                                    type: 'json',
                                                    root: 'root'
                                                }
                                            },
                                            autoLoad: true
                                        }),
                                        renderer: comboBoxRenderer(this)
                                    }, {
                                        fieldLabel: 'Otros #3',
                                        xtype: 'Colsys.Widgets.WgCodigoCiiu',
                                        id: 'cod_ciiu_trs',
                                        name: 'cod_ciiu_trs',
                                        store: Ext.create('Ext.data.Store', {
                                            fields: ['codigo', 'mostrar'],
                                            proxy: {
                                                type: 'ajax',
                                                url: '/widgets5/datosCodigos',
                                                reader: {
                                                    type: 'json',
                                                    root: 'root'
                                                }
                                            },
                                            autoLoad: true
                                        }),
                                        renderer: comboBoxRenderer(this)
                                    }, {
                                        fieldLabel: 'Otros #4',
                                        xtype: 'Colsys.Widgets.WgCodigoCiiu',
                                        id: 'cod_ciiu_ctr',
                                        name: 'cod_ciiu_ctr',
                                        store: Ext.create('Ext.data.Store', {
                                            fields: ['codigo', 'mostrar'],
                                            proxy: {
                                                type: 'ajax',
                                                url: '/widgets5/datosCodigos',
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
                        title: 'Circular 170',
                        id: 'fieldset_Circular170_general' + me.idcliente,
                        collapsible: false,
                        items: [{
                                xtype: 'fieldcontainer',
                                id: 'fieldcontainer_datosCliente_general' + me.idcliente,
                                hideLabel: true,
                                combineErrors: true,
                                msgTarget: 'under',
                                layout: 'hbox',
                                defaults: {
                                    flex: 2,
                                    hideLabel: false
                                },
                                fieldDefaults: {
                                    labelWidth: 100,
                                    labelAlign: 'right',
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'datefield',
                                        fieldLabel: 'Diligenciado',
                                        name: 'fchcircular',
                                        id: 'fchcircular_general' + me.idcliente,
                                        format: 'Y-m-d',
                                        submitFormat: 'Y-m-d',
                                        forceSelection: true
                                    }, {
                                        xtype: 'combo-riesgo',
                                        hideLabel: false,
                                        fieldLabel: 'Nivel de Riesgo',
                                        name: 'nvlriesgo',
                                        id: 'nvlriesgo_general' + me.idcliente,
                                        forceSelection: true
                                    }, {
                                        xtype: 'combo-nit',
                                        hideLabel: false,
                                        fieldLabel: 'Excepci&oacute;n',
                                        labelWidth: 70,
                                        name: 'tipo',
                                        id: 'tipo_general' + me.idcliente,
                                        forceSelection: true
                                    }]
                            }]
                    }, {
                        xtype: 'fieldset',
                        title: 'Listas Vinculantes',
                        id: 'fieldset_vinculantes_general' + me.idcliente,
                        collapsible: false,
                        defaults: {
                            hideLabel: false
                        },
                        items: [{
                                xtype: 'fieldcontainer',
                                id: 'fieldcontainer_vinculantes_general' + me.idcliente,
                                hideLabel: true,
                                combineErrors: true,
                                msgTarget: 'under',
                                layout: 'hbox',
                                defaults: {
                                    hideLabel: false
                                },
                                fieldDefaults: {
                                    labelWidth: 100,
                                    labelAlign: 'right',
                                    margin: '0, 0, 5, 0'
                                },
                                items: [{
                                        xtype: 'combo-si-no',
                                        value: '',
                                        fieldLabel: 'Reportado',
                                        name: 'lista_clinton',
                                        id: 'lista_clinton_general' + me.idcliente,
                                        forceSelection: true,
                                        flex: 1
                                    }, {
                                        xtype: 'textfield',
                                        hideLabel: false,
                                        fieldLabel: 'Comentario',
                                        name: 'comentario',
                                        id: 'comentario_general' + me.idcliente,
                                        labelWidth: 80,
                                        width: 400,
                                        flex: 2
                                    }]
                            }]
                    }]
            });
        }
    }
});