comboBoxRenderer = function (combo) {
    return function (value) {
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('Colsys.Crm.FormTabTributariaControlFinanciero', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabTributariaControlFinanciero',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        id: 'fieldset_datosCliente_tributaria' + me.idcliente,
                        title: 'Nuevos Datos para el Cliente',
                        width: 640,
                        collapsible: false,
                        defaults: {
                            labelWidth: 89,
                            anchor: '90%',
                            layout: {
                                type: 'column',
                                defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                            }},
                        items: [{
                                xtype: 'fieldset',
                                id: 'fieldset_persona_tributaria' + me.idcliente,
                                title: 'Persona',
                                width: 620,
                                collapsible: false,
                                defaults: {
                                    labelWidth: 89,
                                    anchor: '90%',
                                    layout: {
                                        type: 'column',
                                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                    }},
                                items: [{
                                        xtype: 'fieldcontainer',
                                        id: 'fieldcontainer_persona_tributaria' + me.idcliente,
                                        hideLabel: true,
                                        combineErrors: true,
                                        height: 80,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 2,
                                            hideLabel: false
                                        },
                                        items: [{
                                                xtype: 'Colsys.Widgets.WgTipoPersona',
                                                hideLabel: false,
                                                fieldLabel: 'Tipo Persona',
                                                labelWidth: 100,
                                                id: 'tipopersona_tributaria' + me.idcliente,
                                                name: 'tipopersona',
                                                width: 240,
                                                forceSelection: true,
                                                renderer: comboBoxRenderer(this),
                                                listeners: {
                                                    select: {
                                                        fn: function (combo, record, eOpts) {
                                                            if (combo.value == "2") {
                                                                Ext.getCmp('fieldset_personajuridica_tributaria' + me.idcliente).setVisible(true);
                                                            } else {
                                                                Ext.getCmp('fieldset_personajuridica_tributaria' + me.idcliente).setVisible(false);
                                                            }
                                                        }
                                                    }
                                                }
                                            }, {
                                                xtype: 'Colsys.Widgets.WgSectorEconomico',
                                                hideLabel: false,
                                                fieldLabel: 'Sector Econ&oacute;mico',
                                                labelWidth: 100,
                                                id: 'sectoreconomico_tributaria' + me.idcliente,
                                                name: 'sectoreconomico',
                                                width: 280,
                                                forceSelection: true,
                                                listeners: {
                                                    select: {
                                                        fn: function (combo, record, eOpts) {

                                                        }
                                                    }
                                                },
                                                renderer: comboBoxRenderer(this),
                                                allowBlank: false
                                            }, {
                                                xtype: 'datefield',
                                                fieldLabel: 'Fecha de Constituci&oacute;n',
                                                name: 'fechaconstitucion',
                                                id: 'fechaconstitucion_tributaria' + me.idcliente,
                                                width: 235,
                                                format: 'Y-m-d',
                                                submitFormat: 'Y-m-d',
                                                forceSelection: false
                                            }, {
                                                id: 'regimen_tributaria' + me.idcliente,
                                                name: 'regimen',
                                                xtype: 'Colsys.Widgets.WgRegimen',
                                                fieldLabel: 'R&eacute;gimen',
                                                renderer: comboBoxRenderer(this)
                                            }]
                                    }]
                            },
                            //fieldsetPersonaJuridica
                            {
                                xtype: 'fieldset',
                                title: 'Persona jur&iacute;dica',
                                id: 'fieldset_personajuridica_tributaria' + me.idcliente,
                                hidden: true,
                                width: 620,
                                collapsible: false,
                                defaults: {
                                    labelWidth: 89,
                                    anchor: '90%',
                                    layout: {
                                        type: 'column',
                                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                    }},
                                items: [{
                                        xtype: 'fieldcontainer',
                                        id: 'fieldcontainer_personajuridica_tributaria' + me.idcliente,
                                        combineErrors: true,
                                        height: 50,
                                        width: 200,
                                        msgTarget: 'under',
                                        items: [{
                                                xtype: 'tbspacer',
                                                columnWidth: 0.2
                                            }, {
                                                xtype: 'fieldset',
                                                id: 'fieldset_personajuridica1_tributaria' + me.idcliente,
                                                title: '',
                                                columnWidth: 0.8,
                                                defaultType: 'checkbox',
                                                layout: 'column',
                                                items: [{
                                                        fieldLabel: 'UAP',
                                                        boxLabel: '',
                                                        name: 'uap',
                                                        id: 'uap_tributaria' + me.idcliente
                                                    }, {
                                                        fieldLabel: 'Altex',
                                                        boxLabel: '',
                                                        name: 'altex',
                                                        id: 'altex_tributaria' + me.idcliente
                                                    }]
                                            }]
                                    }]
                            }
                        ]
                    }
            );
        }
    }
});