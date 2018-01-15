/**
 * @autor Felipe Nariño
 Administraci\u00F3n de eventos
 para referencias en INO
 
 @comment Muestra una Grilla con los eventos para cada referencia
 permitiendo al usuario asignar la fecha, si fue realizado o no
 y documentos para los casos SAE y DEX.
 */

var win_header = null;
var win_liquid = null;
var win_hijas = null;
var win_hija = null;
var win_file = null;
var win_stick = null;
Ext.Loader.setConfig({
    enabled: true
});
Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('GuiaHija', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'rowIndex', type: 'string'},
        {name: 'charges_code', type: 'string'},
        {name: 'kind_rate', type: 'string'},
        {name: 'number_packages', type: 'string'},
        {name: 'kind_packages', type: 'string'},
        {name: 'gross_weight', type: 'string'},
        {name: 'gross_unit', type: 'string'},
        {name: 'weight_charge', type: 'string'},
        {name: 'weight_details', type: 'string'},
        {name: 'rate_charge', type: 'string'},
        {name: 'due_agent', type: 'string'},
        {name: 'due_carrier', type: 'string'},
        {name: 'other_charges', type: 'string'},
        {name: 'delivery_goods', type: 'string'}
    ]
});

Ext.define('ModelCarrier', {
    extend: 'Ext.data.Model',
    proxy: {
        type: 'ajax',
        url: '/inoF2/datosCarriers',
        reader: {
            type: 'json',
            root: 'root',
            totalProperty: 'total'
        }
    },
    fields: [
        {name: 'idcarrier', type: 'string'},
        {name: 'carrier', type: 'string'}
    ]
});

Ext.define('ComboCarriers', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-carriers',
    store: {
        pageSize: 10,
        model: 'ModelCarrier'
    },
    displayField: 'carrier',
    valueField: 'idcarrier',
    typeAhead: false,
    hideTrigger: true,
    anchor: '100%',
    listConfig: {
        loadingText: 'Buscando...',
        emptyText: 'No hay resultados'
    }
});

Ext.define('ComboCodCargos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-cod-cargos',
    store: ['CC', 'PP'],
    forceSelection: true
});

Ext.define('ComboTipoTarifasAwb', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipo-tarifas-awb',
    store: ['Valor Unitario', 'Valor Minimo'],
    forceSelection: true
});

Ext.define('ComboTipoTarifasHawb', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipo-tarifas-hawb',
    store: ['Valor Unitario', 'Valor Minimo', 'As Agreed'],
    forceSelection: true
});

Ext.define('ComboUnidadesPaquete', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-unidades-paquete',
    store: ['Paquetes', 'Piezas', 'Cajas', 'Cartones', 'Sacos', 'Estuches', 'Jaulas', 'Palets', 'Tamores', 'Barriles', 'Bidones', 'Rollos', 'Bobina', 'Laminas', 'Pallets', 'Boxes', 'Sacks', 'Bags', 'Bulk', 'Skid', 'Rolls', 'Barrels', 'Cartons', 'Case', 'Tarp']
});

Ext.define('ComboUnidadesPeso', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-unidades-peso',
    store: ['KGS', 'LBR', 'TONS']
});

var formAwbsTransporte = Ext.create('Ext.form.Panel', {
    bodyPadding: 5,
    defaults: {
        anchor: '100%',
        labelWidth: 50,
        margin: '2 0 0 0',
        defaultType: 'container',
        collapsible: false
    },
    layout: 'column', // arrange fieldsets side by side
    items: [{
            xtype: 'hiddenfield',
            name: 'iddoctransporte'
        }, {
            xtype: 'hiddenfield',
            name: 'idmaster'
        }, {
            xtype: 'fieldset',
            columnWidth: 0.38,
            title: 'Fch.Documento',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'datefield',
                name: 'fchdoctransporte',
                format: 'Y-m-d',
                allowBlank: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.60,
            title: 'Ruta y Destino',
            flex: 1,
            items: [{
                    xtype: 'container',
                    anchor: '100%',
                    layout: 'hbox',
                    items: [{
                            xtype: 'container',
                            layout: 'anchor',
                            items: [{
                                    xtype: 'textfield',
                                    fieldLabel: 'To',
                                    name: 'iddestino_uno',
                                    allowBlank: false,
                                    maxLength: 3,
                                    maxLengthText: 'Excede el tamaño permitido',
                                    labelWidth: 25,
                                    width: 70,
                                    listeners: {
                                        change: function (field) {
                                            field.setValue(field.getValue().toUpperCase());
                                        }
                                    }
                                }, {
                                    xtype: 'textfield',
                                    fieldLabel: 'To',
                                    name: 'iddestino_dos',
                                    allowBlank: true,
                                    maxLength: 3,
                                    maxLengthText: 'Excede el tamaño permitido',
                                    labelWidth: 25,
                                    width: 70,
                                    listeners: {
                                        change: function (field) {
                                            field.setValue(field.getValue().toUpperCase());
                                        }
                                    }
                                }, {
                                    xtype: 'textfield',
                                    fieldLabel: 'To',
                                    name: 'iddestino_trs',
                                    allowBlank: true,
                                    maxLength: 3,
                                    maxLengthText: 'Excede el tamaño permitido',
                                    labelWidth: 25,
                                    width: 70,
                                    listeners: {
                                        change: function (field) {
                                            field.setValue(field.getValue().toUpperCase());
                                        }
                                    }
                                }]
                        }, {
                            xtype: 'container',
                            layout: 'anchor',
                            defaults: {
                                flex: 1,
                                style: {
                                    padding: '10px'
                                }
                            },
                            items: [{
                                    xtype: 'combo-carriers',
                                    fieldLabel: '&nbsp;By Carrier',
                                    name: 'idcarrier_uno',
                                    labelWidth: 68,
                                    anchor: '95%'
                                }, {
                                    xtype: 'combo-carriers',
                                    fieldLabel: '&nbsp;By Carrier',
                                    name: 'idcarrier_dos',
                                    labelWidth: 68,
                                    anchor: '95%'
                                }, {
                                    xtype: 'combo-carriers',
                                    fieldLabel: '&nbsp;By Carrier',
                                    name: 'idcarrier_trs',
                                    labelWidth: 68,
                                    anchor: '95%'
                                }]
                        }]
                }],
        }, {
            xtype: 'fieldset',
            columnWidth: 0.15,
            title: 'Cod.Cargos',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'combo-cod-cargos',
                name: 'charges_code',
                allowBlank: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.27,
            title: 'Consecutivo',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'consecutivo',
                allowBlank: false,
                maxLength: 20,
                maxLengthText: 'Excede el tamaño permitido',
                listeners: {
                    blur: function (field) {
                        var me = this;
                        Ext.Ajax.request({
                            url: '/inoF2/validarGuiaNumero',
                            params: {
                                ref: this.idreferencia,
                                datos: field.getValue()
                            },
                            success: function (response) {
                                if (Ext.decode(response.responseText).valid) {
                                    me.clearInvalid();
                                    me.textValid = true;
                                } else {
                                    me.markInvalid(Ext.decode(response.responseText).errorInfo);
                                    me.textValid = false;
                                }
                            }
                        });
                    }
                }
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.55,
            title: 'Informaci\u00F3n Contable',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textareafield',
                name: 'accounting_info',
                allowBlank: true,
                maxLength: 512,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.98,
            title: 'Aeropuerto de Salida',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'airport_departure',
                allowBlank: false,
                maxLength: 100,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.98,
            title: 'Aeropuerto de Llegada',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'airport_destination',
                allowBlank: false,
                maxLength: 100,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.98,
            title: 'Instrucciones para Manipulaci\u00F3n',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'handing_info',
                allowBlank: false,
                maxLength: 128,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.98,
            title: 'Certificaci\u00F3n',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'shipper_certifies',
                allowBlank: false,
                maxLength: 128,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }
    ],
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var me = this;
                var form = me.up('form').getForm();
                var data = form.getFieldValues();
                var str = JSON.stringify(data);
                
                if (form.isValid()) {
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/inoF2/guardarAwbsTransporte',
                        params: {
                            id: data.idmaster,
                            datos: str
                        },
                        failure: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.err)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function (response, options) {
                            me.findParentByType('window').close();
                            store = Ext.getCmp("Impresion-" + data.idmaster).getStore();
                            store.reload();
                        }
                    });
                }
            }
        }, {
            text: 'Cancelar',
            handler: function () {
                this.findParentByType('window').close();
            }
        }
    ]
});

var formAwbsLiquidacion = Ext.create('Ext.form.Panel', {
    bodyPadding: 5,
    defaults: {
        anchor: '100%',
        labelWidth: 50,
        margin: '2 0 0 0',
        defaultType: 'container',
        collapsible: false
    },
    layout: 'column', // arrange fieldsets side by side
    items: [{
            xtype: 'hiddenfield',
            name: 'iddoctransporte'
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Number Packages',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'number_packages',
                xtype: 'numberfield',
                name: 'number_packages',
                allowBlank: true,
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Kind Packages',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'kind_packages',
                xtype: 'combo-unidades-paquete',
                name: 'kind_packages',
                forceSelection: false,
                allowBlank: true
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Gross Weight',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'numberfield',
                name: 'gross_weight',
                allowBlank: true,
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Gross Unit',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'combo-unidades-peso',
                name: 'gross_unit',
                forceSelection: false,
                allowBlank: true
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Commodity Item #',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'commodity_item',
                allowBlank: true,
                maxLength: 512,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Chargeable Details',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'weight_details',
                allowBlank: true,
                maxLength: 17,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Chargeable Weight',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'weight_charge',
                xtype: 'numberfield',
                name: 'weight_charge',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                listeners: {
                    change: function (field) {
                        rate = Ext.getCmp('rate_charge');
                        total = Ext.getCmp('total_charge');
                        total.setValue(field.getValue() * rate.getValue());
                    }
                }
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Tipo Tarifa',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'kind_rate',
                xtype: 'combo-tipo-tarifas-awb',
                name: 'kind_rate',
                allowBlank: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Rate Charge',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'rate_charge',
                xtype: 'numberfield',
                name: 'rate_charge',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                listeners: {
                    change: function (field) {
                        weight = Ext.getCmp('weight_charge');
                        total = Ext.getCmp('total_charge');
                        total.setValue(field.getValue() * weight.getValue());
                    }
                }
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Total',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'total_charge',
                xtype: 'numberfield',
                name: 'total_charge',
                readOnly: true,
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Due Agent',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'numberfield',
                name: 'due_agent',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Due Carrier',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'numberfield',
                name: 'due_carrier',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 1,
            title: 'Nature and Qantity of Goods',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textareafield',
                name: 'delivery_goods',
                allowBlank: true,
                height: 65,
                maxLength: 512,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.99,
            title: 'Other Charges',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textareafield',
                name: 'other_charges',
                allowBlank: true,
                height: 100,
                maxLength: 512,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }],
    dockedItems: [{
            xtype: 'toolbar',
            items: [{
                    text: 'Imprimir',
                    tooltip: 'Generar Documento de Transporte',
                    iconCls: 'page_white_acrobat',
                    handler: function () {
                        var id = this.up('form').getForm().getRecord().get('iddoctransporte');
                        if (win_file == null) {
                            win_file = new Ext.Window({
                                title: 'Vista Preliminar del Documento',
                                height: 600,
                                width: 900,
                                items: [{
                                        xtype: 'component',
                                        itemId: 'panel-document-preview',
                                        autoEl: {
                                            tag: 'iframe',
                                            width: '100%',
                                            height: '100%',
                                            frameborder: '0',
                                            scrolling: 'auto',
                                            src: '/inoF2/imprimirAwbsTransporte' + '/id/' + id + '/borrador/' + Ext.getCmp('borradorChk').value + '/plantilla/' + Ext.getCmp('plantillaChk').value + '/copia/' + Ext.getCmp('copiaChk').value
                                        }
                                    }],
                                listeners: {
                                    close: function (panel, eOpts) {
                                        win_file = null;
                                    }
                                }
                            })
                        }
                        win_file.show();
                    }
                }, {
                    text: 'Stickers',
                    tooltip: 'Generar los Stickers para Impresion',
                    iconCls: 'page_white_acrobat',
                    handler: function () {
                        var id = this.up('form').getForm().getRecord().get('iddoctransporte');
                        if (win_stick == null) {
                            win_stick = new Ext.Window({
                                title: 'Vista Preliminar de Stickers',
                                height: 600,
                                width: 900,
                                items: [{
                                        xtype: 'component',
                                        itemId: 'panel-sticker-preview',
                                        autoEl: {
                                            tag: 'iframe',
                                            width: '100%',
                                            height: '100%',
                                            frameborder: '0',
                                            scrolling: 'auto',
                                            src: '/inoF2/imprimirAwbsStickers' + '/id/' + id
                                        }
                                    }],
                                listeners: {
                                    close: function (panel, eOpts) {
                                        win_stick = null;
                                    }
                                }
                            })
                        }
                        win_stick.show();
                    }
                }, {
                    xtype: 'tbspacer'
                }, {
                    xtype: 'fieldcontainer',
                    defaultType: 'checkboxfield',
                    layout: 'hbox',
                    items: [{
                            boxLabel: 'Con Plantilla&nbsp;&nbsp;',
                            name: 'plantilla',
                            checked: true,
                            id: 'plantillaChk'
                        }, {
                            boxLabel: 'Borrador&nbsp;&nbsp;',
                            name: 'borrador',
                            id: 'borradorChk'
                        }, {
                            boxLabel: 'Copia&nbsp;&nbsp;',
                            name: 'copia',
                            id: 'copiaChk'
                        }
                    ]
                }]
        }],
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var me = this;
                var form = me.up('form').getForm();
                var data = form.getFieldValues();
                var str = JSON.stringify(data);

                if (form.isValid()) {
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/inoF2/guardarLiquidDocs',
                        params: {
                            datos: str
                        },
                        failure: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.err)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function (response, options) {
                            me.findParentByType('window').close();
                            store = storeAwbsTransporte;
                            store.reload();
                        }
                    });
                }
            }
        }, {
            text: 'Cancelar',
            handler: function () {
                this.findParentByType('window').close();
            }
        }
    ]
});

var formHawbLiquidacion = Ext.create('Ext.form.Panel', {
    bodyPadding: 5,
    defaults: {
        anchor: '100%',
        labelWidth: 50,
        margin: '2 0 0 0',
        defaultType: 'container',
        collapsible: false
    },
    layout: 'column', // arrange fieldsets side by side
    items: [{
            xtype: 'hiddenfield',
            name: 'rowIndex'
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Cod.Cargos',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'charges_code',
                xtype: 'combo-cod-cargos',
                name: 'charges_code',
                allowBlank: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Tipo Tarifa',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'kind_rate',
                xtype: 'combo-tipo-tarifas-hawb',
                name: 'kind_rate',
                allowBlank: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Number Packages',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'numberfield',
                name: 'number_packages',
                allowBlank: true,
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Kind Packages',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'combo-unidades-paquete',
                name: 'kind_packages',
                forceSelection: false,
                allowBlank: true
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Gross Weight',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'numberfield',
                name: 'gross_weight',
                allowBlank: true,
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Gross Unit',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'combo-unidades-peso',
                name: 'gross_unit',
                forceSelection: false,
                allowBlank: true
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Chargeable Details',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'weight_details',
                allowBlank: true,
                maxLength: 17,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Chargeable Weight',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'aweight_charge',
                xtype: 'numberfield',
                name: 'weight_charge',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                listeners: {
                    change: function (field) {
                        rate = Ext.getCmp('arate_charge');
                        total = Ext.getCmp('atotal_charge');
                        total.setValue(field.getValue() * rate.getValue());
                    }
                }
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Rate Charge',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'arate_charge',
                xtype: 'numberfield',
                name: 'rate_charge',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                listeners: {
                    change: function (field) {
                        weight = Ext.getCmp('aweight_charge');
                        total = Ext.getCmp('atotal_charge');
                        total.setValue(field.getValue() * weight.getValue());
                    }
                }
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Total',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                id: 'atotal_charge',
                xtype: 'numberfield',
                name: 'total_charge',
                readOnly: true,
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Due Agent',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'numberfield',
                name: 'due_agent',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.245,
            title: 'Due Carrier',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'numberfield',
                name: 'due_carrier',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.630,
            title: 'Other Charges',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textareafield',
                name: 'other_charges',
                allowBlank: true,
                height: 55,
                maxLength: 512,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 0.350,
            title: 'Commodity Item #',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textfield',
                name: 'commodity_item',
                allowBlank: true,
                maxLength: 512,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }, {
            xtype: 'fieldset',
            columnWidth: 1,
            title: 'Nature and Qantity of Goods',
            defaults: {anchor: '100%'},
            layout: 'anchor',
            items: {
                xtype: 'textareafield',
                name: 'delivery_goods',
                allowBlank: true,
                height: 55,
                maxLength: 512,
                maxLengthText: 'Excede el tamaño permitido'
            }
        }],
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var me = this;
                var form = me.up('form').getForm();
                var data = form.getFieldValues();
                store = gridHawbs.getStore();
                if (data['rowIndex']) {
                    store.getAt(data['rowIndex']).set(data);
                } else {
                    store.insert(store.getCount(), data);
                }
                me.findParentByType('window').close();
            }
        }, {
            text: 'Cancelar',
            handler: function () {
                this.findParentByType('window').close();
            }
        }
    ]
});

var gridHawbs = Ext.create('Ext.grid.Panel', {
    store: Ext.create('Ext.data.Store', {
        model: 'GuiaHija',
        proxy: {
            type: 'ajax',
            url: '/inoF2/datosHawbs',
            reader: {
                type: 'json',
                root: 'root'
            }
        }
    }),
    columns: [{
            text: 'Cod.Cargos',
            dataIndex: 'charges_code'
        }, {
            text: 'Tipo Tarifa',
            dataIndex: 'kind_rate'
        }, {
            text: 'Tarifa',
            dataIndex: 'rate_charge'
        }, {
            text: 'Due Agent',
            dataIndex: 'due_agent'
        }, {
            text: 'Due Carrier',
            dataIndex: 'due_carrier'
        }, {
            text: 'Other Charges',
            dataIndex: 'other_charges',
            flex: 1
        }, {
            text: 'Nature and Qantity of Goods',
            dataIndex: 'delivery_goods',
            flex: 1
        }, {
            menuDisabled: true,
            sortable: false,
            xtype: 'actioncolumn',
            width: 44,
            items: [{
                    iconCls: 'page_white_edit',
                    tooltip: 'Editar el Registro',
                    handler: function (grid, rowIndex, colIndex) {
                        var rec = grid.getStore().getAt(rowIndex);
                        rec.set('rowIndex', rowIndex);
                        if (win_hija == null) {
                            win_hija = new Ext.Window({
                                id: 'winHawbTransporte',
                                title: 'Liquidaci\u00F3n de Guia Hija',
                                width: 600,
                                closeAction: 'close',
                                items: {
                                    xtype: formHawbLiquidacion
                                }
                            })
                        }
                        win_hija.down('form').loadRecord(rec);
                        win_hija.show();
                    }
                }, {
                    iconCls: 'delete',
                    tooltip: 'Eliminar el Registro',
                    handler: function (grid, rowIndex, colIndex) {
                        var rec = grid.getStore().getAt(rowIndex);
                        Ext.MessageBox.confirm('Confirmaci\u00F3n de Eliminaci\u00F3n', 'Está seguro que desea borrar el registro?', function (choice) {
                            if (choice == 'yes') {
                                grid.getStore().remove(rec);
                            }
                        });
                    }
                }]
        }],
    height: 300,
    dockedItems: [{
            xtype: 'toolbar',
            items: [{
                    text: 'Adicionar',
                    tooltip: 'Adicionar un registro',
                    iconCls: 'add',
                    handler: function () {
                        var rec = Ext.create('GuiaHija', {});
                        rec.set('rowIndex', null);
                        if (win_hija == null) {
                            win_hija = new Ext.Window({
                                id: 'winHawbTransporte',
                                title: 'Liquidaci\u00F3n de Guia Hija',
                                width: 600,
                                closeAction: 'close',
                                items: {
                                    xtype: formHawbLiquidacion
                                }
                            })
                        }
                        win_hija.down('form').loadRecord(rec);
                        win_hija.show();
                    }
                }, {
                    text: 'Recargar',
                    iconCls: 'refresh',
                    id: 'btn-guardarrecarga',
                    handler: function () {
                        this.up("grid").getStore().reload();
                    }
                }, {
                    text: 'Imprimir',
                    tooltip: 'Generar Documento de Transporte',
                    iconCls: 'page_white_acrobat',
                    handler: function () {
                        var store = this.up("grid").getStore();
                        var id = store.proxy.extraParams['id'];
                        if (win_file == null) {
                            win_file = new Ext.Window({
                                title: 'Vista Preliminar del Documento',
                                height: 600,
                                width: 900,
                                items: [{
                                        xtype: 'component',
                                        itemId: 'panel-hawbs-preview',
                                        autoEl: {
                                            tag: 'iframe',
                                            width: '100%',
                                            height: '100%',
                                            frameborder: '0',
                                            scrolling: 'auto',
                                            src: '/inoF2/imprimirAwbsTransporte' + '/id/' + id + '/borrador/' + Ext.getCmp('borradorHija').value + '/plantilla/' + Ext.getCmp('plantillaHija').value + '/copia/' + Ext.getCmp('copiaHija').value + '/guiahija/true'
                                        }
                                    }],
                                listeners: {
                                    close: function (panel, eOpts) {
                                        win_file = null;
                                    }
                                }
                            })
                        }
                        win_file.show();
                    }
                }, {
                    xtype: 'tbspacer'
                }, {
                    xtype: 'fieldcontainer',
                    defaultType: 'checkboxfield',
                    layout: 'hbox',
                    items: [{
                            boxLabel: 'Con Plantilla&nbsp;&nbsp;',
                            name: 'plantilla',
                            checked: true,
                            id: 'plantillaHija'
                        }, {
                            boxLabel: 'Borrador&nbsp;&nbsp;',
                            name: 'borrador',
                            id: 'borradorHija'
                        }, {
                            boxLabel: 'Copia&nbsp;&nbsp;',
                            name: 'copia',
                            id: 'copiaHija'
                        }
                    ]
                }]
        }],
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var store = this.up("grid").getStore();

                x = 0;
                changes = [];
                for (var i = 0; i < store.getCount(); i++) {
                    var record = store.getAt(i);
                    if (record.isValid()) {
                        changes[x] = record.data;
                        x++;
                    } else {
                        Ext.MessageBox.alert("Error", 'La informaci\u00F3n está incompleta o no es válida.');
                        return;
                    }
                }
                var str = JSON.stringify(changes);
                if (str.length > 5) {
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/inoF2/guardarHawbs',
                        params: {
                            id: store.proxy.extraParams,
                            datos: str
                        },
                        success: function (response, opts) {
                            var res = Ext.decode(response.responseText);
                            if (res.success) {
                                store.reload();
                                Ext.MessageBox.alert("Mensaje", 'Se guardo Correctamente la informaci\u00F3n');
                            } else if (!res.success) {
                                Ext.MessageBox.alert("Error", 'Se present\u00F3 el siguiente error: ' + res.errorInfo);
                            }
                        },
                        failure: function (response, opts) {
                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            box.hide();
                        }
                    });
                }
            }
        }, {
            text: 'Cancelar',
            handler: function () {
                this.findParentByType('window').close();
            }
        }
    ]
});

Ext.define('Colsys.Ino.GridAwbsTransporte', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridAwbsTransporte',

    selModel: {
        selType: 'cellmodel'
    },
    frame: true,
    listeners: {
        activate: function (ct, position) {
            this.getStore().load({
                params: {
                    idmaster: this.idmaster
                }
            });
        },
        beforeitemcontextmenu: function (view, record, item, index, e) {
            e.stopEvent();
            var record = this.store.getAt(index);
        },
        beforerender: function (ct, position) {
            me = this;
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        autoLoad: false,
                        fields: [
                            {name: 'iddoctransporte', type: 'string'},
                            {name: 'referencia', type: 'string'},
                            {name: 'iddestino_uno', type: 'string'},
                            {name: 'idcarrier_uno', type: 'string'},
                            {name: 'carrier_uno', type: 'string'},
                            {name: 'iddestino_dos', type: 'string'},
                            {name: 'idcarrier_dos', type: 'string'},
                            {name: 'carrier_dos', type: 'string'},
                            {name: 'iddestino_trs', type: 'string'},
                            {name: 'idcarrier_trs', type: 'string'},
                            {name: 'carrier_trs', type: 'string'},
                            {name: 'consecutivo', type: 'string'},
                            {name: 'fchdoctransporte', type: 'string'},
                            {name: 'charges_code', type: 'string'},
                            {name: 'airport_departure', type: 'string'},
                            {name: 'airport_destination', type: 'string'},
                            {name: 'accounting_info', type: 'string'},
                            {name: 'handing_info', type: 'string'},
                            {name: 'number_packages', type: 'string'},
                            {name: 'kind_packages', type: 'string'},
                            {name: 'gross_weight', type: 'string'},
                            {name: 'gross_unit', type: 'string'},
                            {name: 'weight_charge', type: 'string'},
                            {name: 'weight_details', type: 'string'},
                            {name: 'kind_rate', type: 'string'},
                            {name: 'rate_charge', type: 'string'},
                            {name: 'due_agent', type: 'string'},
                            {name: 'due_carrier', type: 'string'},
                            {name: 'commodity_item', type: 'string'},
                            {name: 'delivery_goods', type: 'string'},
                            {name: 'other_charges', type: 'string'},
                            {name: 'shipper_certifies', type: 'string'},
                            {name: 'childrens', type: 'string'},
                            {name: 'fchliquidado', type: 'string'},
                            {name: 'usuliquidado', type: 'string'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosAwbsTransporte',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            },
                            filterParam: 'query'
                        }
                    }),
                    [{
                            header: 'Consecutivo',
                            dataIndex: 'consecutivo',
                            width: 95
                        }, {
                            header: 'Fecha Doc.',
                            width: 100,
                            dataIndex: 'fchdoctransporte'
                        }, {
                            header: 'Chgs',
                            dataIndex: 'charges_code',
                            width: 55,
                        }, {
                            header: 'Routing',
                            flex: -1,
                            columns: [
                                {
                                    header: 'To',
                                    width: 60,
                                    dataIndex: 'iddestino_uno'
                                }, {
                                    header: 'By',
                                    width: 120,
                                    dataIndex: 'carrier_uno'
                                }
                            ]
                        }, {
                            header: 'Departure',
                            dataIndex: 'airport_departure',
                            flex: -1
                        }, {
                            header: 'Destination',
                            dataIndex: 'airport_destination',
                            flex: -1
                        }, {
                            header: 'Liquidado',
                            columns: [
                                {
                                    header: 'Usuario',
                                    width: 120,
                                    dataIndex: 'usuliquidado'
                                }, {
                                    header: 'Fecha',
                                    width: 120,
                                    dataIndex: 'fchliquidado'
                                }
                            ]
                        }, {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 75,
                            items: [{
                                    iconCls: 'page_white_edit',
                                    tooltip: 'Editar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (win_header == null) {
                                            win_header = new Ext.Window({
                                                id: 'winAwbsTransporte',
                                                title: 'Cabecera del Documento',
                                                width: 650,
                                                closeAction: 'close',
                                                items: {
                                                    xtype: formAwbsTransporte
                                                }
                                            })
                                        }
                                        win_header.down('form').loadRecord(rec);
                                        win_header.show();
                                    }
                                }, {
                                    iconCls: 'upload-icon',
                                    tooltip: 'Liquidar Documento de Transporte',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.Ajax.request({
                                            url: '/inoF2/valoresPorDefecto',
                                            params: {
                                                idconfig: 260, // Id Caso de Uso Valores por defecto para la Guía
                                                idmaster: me.idmaster
                                            },
                                            success: function (response, options) {
                                                var res = Ext.JSON.decode(response.responseText);
                                                if (win_liquid == null) {
                                                    win_liquid = new Ext.Window({
                                                        id: 'winLiquidDoc',
                                                        title: 'Liquidar Documento de Transporte',
                                                        width: 600,
                                                        closeAction: 'close',
                                                        items: {
                                                            xtype: formAwbsLiquidacion
                                                        }
                                                    })
                                                }
                                                if (rec.data.delivery_goods == "") {
                                                    rec.set('delivery_goods', res.data.nature_quantity);
                                                }
                                                win_liquid.down('form').loadRecord(rec);
                                                win_liquid.show();
                                            },
                                            failure: function (form, action) {
                                                Ext.Msg.alert("Load failed", action.result.errorMessage);
                                            }
                                        });
                                    }
                                }, {
                                    iconCls: 'event-add',
                                    tooltip: 'Gu\u00EDas Hijas',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (win_hijas == null) {
                                            win_hijas = new Ext.Window({
                                                id: 'winGuiasHijas',
                                                title: 'Liquidaci\u00F3n Gu\u00EDas Hijas',
                                                width: 1000,
                                                closeAction: 'close',
                                                items: {
                                                    xtype: gridHawbs
                                                }
                                            })
                                        }
                                        var store = win_hijas.down('grid').getStore();
                                        store.getProxy().extraParams = {
                                            id: rec.data.iddoctransporte
                                        };
                                        store.load();
                                        win_hijas.show();
                                    }
                                }, {
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar el Registro',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmaci\u00F3n de Eliminaci\u00F3n', 'Está seguro que desea borrar el registro?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminado...',
                                                    url: '/inoF2/eliminarAwbsTransporte',
                                                    params: {
                                                        id: rec.data.iddoctransporte
                                                    },
                                                    failure: function (response, options) {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                        success = false;
                                                    },
                                                    success: function (response, options) {
                                                        var res = Ext.JSON.decode(response.responseText);
                                                        if (res.success) {
                                                            store = storeAwbsTransporte;
                                                            store.reload();
                                                        } else {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }]
                        }]
                    );

            //if (this.permisos.Crear == true || this.permisos.Editar == true) {
                tb = new Ext.toolbar.Toolbar();
                tb.add({
                    text: 'Adicionar',
                    tooltip: 'Adicionar un registro',
                    iconCls: 'add',
                    scope: this,
                    handler: function () {
                        if (win_header == null) {
                            win_header = new Ext.Window({
                                id: 'winAwbsTransporte',
                                title: 'Cabecera del Documento',
                                width: 650,
                                closeAction: 'close',
                                items: {
                                    xtype: formAwbsTransporte
                                }
                            })
                        }
                        win_header.down('form').getForm().load({
                            url: '/inoF2/valoresPorDefecto',
                            params: {
                                idconfig: 260, // Id Caso de Uso Valores por defecto para la Guía
                                referencia: this.idreferencia,
                                idmaster: this.idmaster,
                                idhouse: null
                            },
                            failure: function (form, action) {
                                Ext.Msg.alert("Load failed", action.result.errorMessage);
                            }
                        });
                        win_header.show();
                    }
                });
                this.addDocked(tb);
            //}
        }
    }

});