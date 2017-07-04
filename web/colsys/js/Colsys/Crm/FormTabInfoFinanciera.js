Ext.define('Colsys.Crm.FormTabInfoFinanciera', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormTabInfoFinanciera',
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var me = this;
                idcliente = me.up('form').idcliente;
                var form = me.up('form').getForm();
                if (form.isValid()) {

                    var activostotales = Ext.getCmp('ca_activostotales');
                    var activoscorrientes = Ext.getCmp('ca_activoscorrientes');
                    var pasivostotales = Ext.getCmp('ca_pasivostotales');
                    var pasivoscorrientes = Ext.getCmp('ca_pasivoscorrientes');
                    var inventarios = Ext.getCmp('ca_inventarios');
                    var patrimonios = Ext.getCmp('ca_patrimonios');
                    var utilidades = Ext.getCmp('ca_utilidades');
                    var ventas = Ext.getCmp('ca_ventas');
                    var anno = Ext.getCmp('ca_anno');

                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/clientes/guardarDatosFinancieros',
                        params: {
                            activostotales: activostotales.value,
                            activoscorrientes: activoscorrientes.value,
                            pasivostotales: pasivostotales.value,
                            pasivoscorrientes: pasivoscorrientes.value,
                            inventarios: inventarios.value,
                            patrimonios: patrimonios.value,
                            utilidades: utilidades.value,
                            ventas: ventas.value,
                            idcliente: idcliente,
                            anno: anno.value
                        },
                        failure: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.errorInfo)
                                Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');

                        },
                        success: function (response, options) {
                            var res = Ext.decode(response.responseText);
                            ids = res.ids;
                            if (res.success) {
                                Ext.getCmp("winFormEdit").destroy();
                                Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                store = Ext.getCmp('gridTabInfoFinanciera' + idcliente).getStore().reload();
//                                storeInfoFinanciera.reload();

                            } else {
                                Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                            }
                        }
                    });
                }
            }
        }],
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            this.add(
                    {
                        xtype: 'fieldset',
                        title: ' ',
                        width: 620,
                        height: 260,
                        collapsible: false,
                        items: [{
                                xtype: 'fieldcontainer',
                                hideLabel: true,
                                combineErrors: true,
                                height: 45,
                                msgTarget: 'under',
                                layout: 'column',
                                defaults: {
                                    flex: 2,
                                    hideLabel: false
                                },
                                items: [{
                                        xtype: 'numberfield',
                                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                                        fieldLabel: 'A\u00F1o',
                                        id: 'ca_anno',
                                        width: 220
                                    }, {
                                        xtype: 'tbspacer',
                                        height: 10,
                                        width: 500
                                    }, {
                                        xtype: 'numberfield',
                                        //value: '0',
                                        fieldLabel: 'Activos Totales',
                                        name: 'ca_activostotales',
                                        id: 'ca_activostotales',
                                        hideTrigger: true,
                                        //decimalSeparator: '.',
                                        thousandSeparator: '.',
                                        decimalSeparator: ',',
                                        renderer: Ext.util.Format.numberRenderer('0,000'),
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        width: 220

                                    }, {
                                        xtype: 'numberfield',
                                        value: '0',
                                        fieldLabel: 'Activos Corrientes',
                                        name: 'ca_activoscorrientes',
                                        id: 'ca_activoscorrientes',
                                        width: 260,
                                        labelWidth: 150,
                                        hideTrigger: true,
                                        decimalPrecision: 2,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false
                                    }, {
                                        xtype: 'tbspacer',
                                        height: 10,
                                        width: 500
                                    }, {
                                        xtype: 'numberfield',
                                        value: '0',
                                        fieldLabel: 'Pasivos Totales',
                                        name: 'ca_pasivostotales',
                                        id: 'ca_pasivostotales',
                                        width: 220,
                                        hideTrigger: true,
                                        decimalPrecision: 2,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false
                                    }, {
                                        xtype: 'numberfield',
                                        value: '0',
                                        fieldLabel: 'Pasivos Corrientes',
                                        name: 'ca_pasivoscorrientes',
                                        id: 'ca_pasivoscorrientes',
                                        width: 260,
                                        labelWidth: 150,
                                        hideTrigger: true,
                                        decimalPrecision: 2,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false
                                    }, {
                                        xtype: 'tbspacer',
                                        height: 10,
                                        width: 500
                                    }, {
                                        xtype: 'numberfield',
                                        value: '0',
                                        fieldLabel: 'Inventarios',
                                        name: 'ca_inventarios',
                                        id: 'ca_inventarios',
                                        width: 220,
                                        hideTrigger: true,
                                        decimalPrecision: 2,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false
                                    }, {
                                        xtype: 'numberfield',
                                        value: '0',
                                        fieldLabel: 'Patrimonio',
                                        name: 'ca_patrimonios',
                                        id: 'ca_patrimonios',
                                        width: 260,
                                        labelWidth: 150,
                                        hideTrigger: true,
                                        decimalPrecision: 2,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false
                                    }, {
                                        xtype: 'tbspacer',
                                        height: 10,
                                        width: 500
                                    }, {
                                        xtype: 'numberfield',
                                        value: '0',
                                        fieldLabel: 'Utilidades',
                                        name: 'ca_utilidades',
                                        id: 'ca_utilidades',
                                        width: 220,
                                        hideTrigger: true,
                                        decimalPrecision: 2,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false
                                    }, {
                                        xtype: 'numberfield',
                                        value: '0',
                                        fieldLabel: 'Ventas',
                                        name: 'ca_ventas',
                                        id: 'ca_ventas',
                                        width: 260,
                                        labelWidth: 150,
                                        hideTrigger: true,
                                        decimalPrecision: 2,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false
                                    }]
                            }]
                    }
            );
        },
        afterrender: function (me, eOpts) {
            me = this;
            form = me.getForm();
            if (me.rec) {
                form.loadRecord(me.rec);
            }
        }
    }
});