var win_header = null;
Ext.define('Colsys.Crm.FormTabTransporteInternacional', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabTransporteInternacional',
    listeners: {
        beforerender: function (me, eOpts) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        columnWidth: 1,
                        title: 'Datos Agente de Carga',
                        defaults: {anchor: '100%'},
                        layout: 'anchor',
                        items: [{
                                xtype: 'hiddenfield',
                                name: 'filaNumero'
                            }, {
                                xtype: 'combo-tipoTI',
                                fieldLabel: 'Tipo',
                                forceSelection: true,
                                name: 'tipoI',
                                listeners: {
                                    select: function (combo, records, eOpts) {
                                        if (combo.value == "Naviera") {
                                            Ext.getCmp("dropoffI").setVisible(true);
                                            Ext.getCmp("contenedorvacioI").setVisible(true);
                                        } else {
                                            Ext.getCmp("dropoffI").setVisible(false);
                                            Ext.getCmp("contenedorvacioI").setVisible(false);
                                            Ext.getCmp("dropoffI").reset();
                                            Ext.getCmp("contenedorvacioI").reset();

                                        }

                                    }
                                }
                            }, {
                                xtype: 'textfield',
                                fieldLabel: 'Nombre',
                                name: 'nombre_tipotransporteI'
                            }, {
                                xtype: 'textfield',
                                fieldLabel: 'Convenio',
                                name: 'convenioI'
                            }, {
                                xtype: 'textfield',
                                fieldLabel: 'Contacto',
                                name: 'contactoI'
                            }, {
                                xtype: 'textfield',
                                fieldLabel: 'Telefono',
                                name: 'telefonoI'
                            }, {
                                xtype: 'checkboxgroup',
                                name: '',
                                fieldLabel: 'Pago de Fletes',
                                labelWidth: 110,
                                vertical: false,
                                items: [
                                    {boxLabel: '', name: 'pagofletesI', inputValue: '1', width: 60}
                                ]
                            }, {
                                xtype: 'checkboxgroup',
                                name: '',
                                id: 'dropoffI',
                                fieldLabel: 'Drop Off',
                                labelWidth: 110,
                                vertical: false,
                                items: [
                                    {boxLabel: '', name: 'dropoffI', inputValue: '1', width: 60}
                                ]
                            }, {
                                xtype: 'checkboxgroup',
                                name: '',
                                id: 'contenedorvacioI',
                                fieldLabel: 'Devol. contenedor vacio',
                                labelWidth: 110,
                                vertical: false,
                                items: [
                                    {boxLabel: '', name: 'contenedorvacioI', inputValue: '1', width: 60}
                                ]
                            }]
                    }
            );

        },
        afterrender: function (me, eOpts) {
            me = this;
            form = me.getForm();
            if(me.rec){
                form.loadRecord(me.rec);
            }
        }

    },
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var me = this;
                var form = me.up('form').getForm();
                var idcliente = me.up('form').idcliente;
                var data = form.getFieldValues();
                if (form.isValid()) {
                    if (data.filaNumero) {
//                            var store = storeFichaTecnicaTI;
                        store = Ext.getCmp("gridTabTransporte" + idcliente).getStore();
                        rec = store.findRecord('filaNumero', data.filaNumero);
                        rec.data.tipoI = data.tipoI;
                        rec.data.nombre_tipotransporteI = data.nombre_tipotransporteI;
                        rec.data.convenioI = data.convenioI;
                        rec.data.telefonoI = data.telefonoI;
                        rec.data.contactoI = data.contactoI;
                        rec.data.pagofletesI = data.pagofletesI;
                        rec.data.dropoffI = data.dropoffI;
                        rec.data.contenedorvacioI = data.contenedorvacioI;
                        store.commitChanges();
                    } else {
                        store = Ext.getCmp("gridTabTransporte" + idcliente).getStore();
                        var tam = store.getCount();
                        store.add({
                            filaNumero: tam,
                            tipoI: data.tipoI,
                            nombre_tipotransporteI: data.nombre_tipotransporteI,
                            convenioI: data.convenioI,
                            telefonoI: data.telefonoI,
                            contactoI: data.contactoI,
                            pagofletesI: data.pagofletesI,
                            dropoffI: data.dropoffI,
                            contenedorvacioI: data.contenedorvacioI
                        });
                    }
                    this.findParentByType('window').close();
                }
            }
        }, {
            text: 'Cancelar',
            handler: function () {
                this.findParentByType('window').close();
            }
        }]
});