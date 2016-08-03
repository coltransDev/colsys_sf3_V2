<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$referencia = $sf_data->getRaw("referencia");
?>
<script type="text/javascript">
    var win_header = null;
    var win_liquid = null;
    var win_hijas = null;
    var win_hija = null;
    var win_file = null;

    Ext.onReady(function () {

        Ext.define('AwbsTransporte', {
            extend: 'Ext.data.Model',
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
                {name: 'rate_charge', type: 'string'},
                {name: 'due_agent', type: 'string'},
                {name: 'due_carrier', type: 'string'},
                {name: 'delivery_goods', type: 'string'},
                {name: 'other_charges', type: 'string'},
                {name: 'shipper_certifies', type: 'string'},
                {name: 'childrens', type: 'string'},
                {name: 'fchliquidado', type: 'string'},
                {name: 'usuliquidado', type: 'string'}
            ]
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
                url: '<?= url_for('inoExpo/datosCarriers') ?>',
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

        Ext.define('ComboTipoTarifas', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-tipo-tarifas',
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

        var storeAwbsTransporte = Ext.create('Ext.data.Store', {
            autoLoad: true,
            model: 'AwbsTransporte',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('inoExpo/datosAwbsTransporte') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                extraParams: {
                    id: '<?= $referencia ?>'
                },
                // Parameter name to send filtering information in
                filterParam: 'query',
            }
        });

        var formAwbsTransporte = Ext.create('Ext.form.Panel', {
            bodyPadding: 5,
            defaults: {
                anchor: '100%',
                labelWidth: 50,
                defaultType: 'container',
                collapsible: false,
            },
            layout: 'column', // arrange fieldsets side by side
            items: [{
                    xtype: 'hiddenfield',
                    name: 'iddoctransporte'
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
                                    labelWidth: 75,
                                    anchor: '95%'
                                }, {
                                    xtype: 'combo-carriers',
                                    fieldLabel: '&nbsp;By Carrier',
                                    name: 'idcarrier_dos',
                                    labelWidth: 75,
                                    anchor: '95%'
                                }, {
                                    xtype: 'combo-carriers',
                                    fieldLabel: '&nbsp;By Carrier',
                                    name: 'idcarrier_trs',
                                    labelWidth: 75,
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
                                    url: '<?= url_for('inoExpo/validarGuiaNumero') ?>',
                                    params: {
                                        ref: '<?= $referencia ?>',
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
                    title: 'Información Contable',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'textareafield',
                        name: 'accounting_info',
                        allowBlank: true,
                        maxLength: 128,
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
                    title: 'Instrucciones para Manipulación',
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
                    title: 'Certificación',
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
                                url: '<?= url_for('inoExpo/guardarAwbsTransporte') ?>',
                                params: {
                                    id: '<?= $referencia ?>',
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
        
        var formAwbsLiquidacion = Ext.create('Ext.form.Panel', {
            bodyPadding: 5,
            defaults: {
                anchor: '100%',
                labelWidth: 50,
                defaultType: 'container',
                collapsible: false,
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
                    columnWidth: 0.490,
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
                                                src: '<?= url_for('inoExpo/imprimirAwbsTransporte') ?>' + '/id/' + id + '/borrador/' + Ext.getCmp('borradorChk').value + '/plantilla/' + Ext.getCmp('plantillaChk').value + '/copia/' + Ext.getCmp('copiaChk').value
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
                                url: '<?= url_for('inoExpo/guardarLiquidDocs') ?>',
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
                defaultType: 'container',
                collapsible: false,
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
                        xtype: 'combo-tipo-tarifas',
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
                    columnWidth: 0.490,
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
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.490,
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
                }],
            buttons: [{
                    text: 'Guardar',
                    handler: function () {
                        var me = this;
                        var form = me.up('form').getForm();
                        var data = form.getFieldValues();
                        store = gridHawbs.getStore();
                        store.getAt(data['rowIndex']).set(data);
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
                    url: '<?= url_for('inoExpo/datosHawbs') ?>',
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
                                title: 'Liquidación de Guia Hija',
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
                        Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea borrar el registro?', function (choice) {
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
                        var record = Ext.create('GuiaHija', {});
                        this.up("grid").getStore().insert(this.up("grid").getStore().getCount(), record);
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
                                        src: '<?= url_for('inoExpo/imprimirAwbsTransporte') ?>' + '/id/' + id + '/borrador/' + Ext.getCmp('borradorHija').value + '/plantilla/' + Ext.getCmp('plantillaHija').value + '/copia/' + Ext.getCmp('copiaHija').value + '/guiahija/true'
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
                                Ext.MessageBox.alert("Error", 'La información está incompleta o no es válida.');
                                return;
                            }
                        }
                        var str = JSON.stringify(changes);
                        if (str.length > 5) {
                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for('inoExpo/guardarHawbs') ?>',
                                params: {
                                    id: store.proxy.extraParams,
                                    datos: str
                                },
                                success: function (response, opts) {
                                    var res = Ext.decode(response.responseText);
                                    if (res.success) {
                                        store.reload();
                                        Ext.MessageBox.alert("Mensaje", 'Se guardo Correctamente la información');
                                    } else if (!res.success) {
                                        Ext.MessageBox.alert("Error", 'Se presentó el siguiente error: ' + res.errorInfo);
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

        // create the grid
        new Ext.grid.GridPanel({
            id: 'gridAwbsTransporte',
            title: 'Documentos de Transporte<br/><?= $referencia ?>',
            store: storeAwbsTransporte,
            renderTo: 'se-form',
            stripeRows: true,
            height: 400,
            width: 950,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            columns: [{
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
                    width: 130,
                }, {
                    header: 'Destination',
                    dataIndex: 'airport_destination',
                    width: 130,
                }, {
                    header: 'Liquidado',
                    columns: [
                        {
                            header: 'Usuario',
                            width: 90,
                            dataIndex: 'usuliquidado'
                        }, {
                            header: 'Fecha',
                            width: 90,
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
                                        width: 600,
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
                                    url: '<?= url_for("inoExpo/valoresPorDefecto") ?>',
                                    params: {
                                        idconfig: 260, // Id Caso de Uso Valores por defecto para la Guía
                                        referencia: '<?= $referencia ?>'
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
                            tooltip: 'Guías Hijas',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (win_hijas == null) {
                                    win_hijas = new Ext.Window({
                                        id: 'winGuiasHijas',
                                        title: 'Liquidación Guías Hijas',
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
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea borrar el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminado...',
                                            url: '<?= url_for("inoExpo/eliminarAwbsTransporte") ?>',
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
                }
            ],
            renderTo: Ext.get('se-form'),
            // inline buttons
            dockedItems: [{
                xtype: 'toolbar',
                items: [{
                    text: 'Adicionar',
                    tooltip: 'Adicionar un registro',
                    iconCls: 'add',
                    scope: this,
                    handler: function () {
                        if (win_header == null) {
                            win_header = new Ext.Window({
                                id: 'winAwbsTransporte',
                                title: 'Cabecera del Documento',
                                width: 600,
                                closeAction: 'close',
                                items: {
                                    xtype: formAwbsTransporte
                                }
                            })
                        }
                        win_header.down('form').getForm().load({
                            url: '<?= url_for("inoExpo/valoresPorDefecto") ?>',
                            params: {
                                idconfig: 260, // Id Caso de Uso Valores por defecto para la Guía
                                referencia: '<?= $referencia ?>'
                            },
                            failure: function (form, action) {
                                Ext.Msg.alert("Load failed", action.result.errorMessage);
                            }
                        });
                        win_header.show();
                    }
                }, {
                    text: 'Regresar',
                    tooltip: 'Regresar al Menú de Búsqueda',
                    iconCls: 'refresh',
                    scope: this,
                    handler: function () {
                        document.location.href = "/inoExpo/gestionDocsTransporte";
                    }
                }]
            }],
            // paging bar on the bottom
            bbar: Ext.create('Ext.PagingToolbar', {
                store: storeAwbsTransporte,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
        });

    });
</script>