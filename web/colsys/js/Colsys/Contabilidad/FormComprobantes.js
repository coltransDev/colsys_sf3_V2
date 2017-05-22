Ext.define('Colsys.Contabilidad.FormComprobantes', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Contabilidad.FormComprobantes',
    title: 'Creaci&oacute;n de Comprobantes',
    bodyPadding: 5,
    width: 1000,
    dockedItems: [{
            xtype: 'toolbar',
            dock: 'top',
            style: 'padding-right:500px;',
            items: [{
                    text: 'Guardar',
                    iconCls: 'disk',
                    handler: function () {
                        form = Ext.getCmp("form-comprobantes").getForm();
                        var store = Ext.getCmp("grid-movimientosComprobantes").getStore();
                        var error = 0;
                        var msjerror = "";
                        changes = [];
                        var records = store.getModifiedRecords();
                        creditos = 0;
                        for (i = 0; i < records.length; i++) {
                            var rec = records[i];

                            if (rec.data.valor) {
                                if (rec.data.valor != 0 && rec.data.valor != "") {
                                    if (rec.data.cuenta && rec.data.factura) {
                                        msjerror += "No se permite seleccionar Factura Y Cuenta en registro " + parseInt(i + 1) + "</br>";
                                    }
                                    if (!rec.data.factura && !rec.data.cuenta) {
                                        msjerror += "Se debe seleccionar Factura o Cuenta en registro " + parseInt(i + 1) + "</br>";
                                        error = 1;
                                    }
                                    if (!rec.data.valor) {
                                        msjerror += " Es obligatorio asignar un valor en el registro " + parseInt(i + 1) + "</br>";
                                        error = 1;
                                    }
                                    if (!rec.data.costos && (rec.data.cuenta)) {
                                        if (rec.data.cuenta != " ") {
                                            msjerror += " Es obligatorio asignar centro de costos en el registro " + parseInt(i + 1) + "</br>";
                                            error = 1;
                                        }
                                    }
                                    if (!rec.data.naturaleza) {
                                        msjerror += " Es obligatorio asignar naturaleza en el registro " + parseInt(i + 1) + "</br>";
                                        error = 1;
                                    } else {
                                        if (rec.data.naturaleza == "C")
                                            creditos++;
                                    }
                                    if (rec.data.naturaleza) {
                                        if (rec.data.naturaleza == " ") {
                                            msjerror += " Es obligatorio asignar naturaleza en el registro " + parseInt(i + 1) + "</br>";
                                            error = 1;
                                        }
                                    }


                                    if (!rec.data.tercero) {
                                        msjerror += " Es obligatorio asignar tercero en el registro " + parseInt(i + 1) + "</br>";
                                        error = 1;
                                    }

                                    if (rec.data.cuenta) {
                                        if (rec.data.cuenta == " ") {
                                            rec.data.cuenta = null;
                                        }
                                    }
                                    terc = records[i].data.tercero;
                                    storetercero = Ext.getCmp("tercero").getStore();
                                    cuentaformapago = storetercero.findRecord("id", terc);

                                    if (cuentaformapago != null)
                                        records[i].data.cuentaformapago = cuentaformapago.data.cuentaformapago;
                                    else {
                                        msjerror += " El Tercero en el registro " + parseInt(i + 1) + "No tiene Cuenta de Forma de pago" + "</br>";
                                        error = 1;
                                    }


                                    if (records[i].data) {
                                        if (records[i].data.cuentaformapago == null) {
                                            msjerror += " El Tercero en el registro " + parseInt(i + 1) + "No tiene Cuenta de Forma de pago" + "</br>";
                                            error = 1;
                                        }
                                    }

                                    if (rec.data.factura) {
                                        fac = records[i].data.factura;
                                        storetercero = Ext.getCmp("factura").getStore();
                                        factura = storetercero.findRecord("consecutivo", fac);
                                        if (factura != null) {
                                            records[i].data.referencia = factura.data.referencia;
                                            records[i].data.idcomprobante = factura.data.idcomprobante;
                                        } else {
                                            msjerror += " Factura invalida en el registro " + parseInt(i + 1) + "</br>";
                                            error = 1;
                                        }

                                    }
                                    records[i].data.id = rec.id;
                                    changes[i] = records[i].data;
                                }
                            }



                        }
                        if (creditos == 0) {
                            msjerror += "Debe existir al menos un registro de tipo credito" + "</br>";
                            error = 1;
                        }
                        if (!form.isValid()){
                            msjerror += "Debe diligenciar todos los campos obligatorios" + "</br>";
                            error = 1;
                        }


                        if (form.isValid() && error == 0) {

                            var str = JSON.stringify(changes);

                            form.submit({
                                url: '/contabilidad/guardarComprobante',
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                params: {
                                    datos: str
                                },
                                success: function (form, action) {
                                    if (action.result.idcomprobante) {
                                        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                            sorc: "/inocomprobantes/generarComprobantePDF/id/" + action.result.idcomprobante
                                        });
                                        windowpdf.show();
                                    } else if (action.result.errorInfo) {
                                        Ext.MessageBox.alert("Error", action.result.errorInfo);
                                    }
                                }
                            })
                        } else {
                            Ext.MessageBox.alert("Error", msjerror);
                            error = 0;
                        }

                    }
                }]
        }],
    items: [{
            xtype: 'fieldset',
            height: 130,
            layout: 'column',
            defaults: {
                columnWidth: .45,
                labelAlign: 'left'
            },
            items: [
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5
                },
                {
                    xtype: 'Colsys.Widgets.WgTiposcomprobantes',
                    fieldLabel: 'Tipo Comprobante',
                    name: 'tipocomprobante',
                    id: 'tipocomprobante',
                    allowBlank: false,
                    labelWidth: 100,
                    listeners: {
                        select: function  ( combo , record , eOpts ) {
                            if (record.data.comprobante == "R1"){
                                Ext.getCmp("anticipo").setVisible(true);
                                Ext.getCmp("refer").setVisible(true);
                            }
                            else{
                                Ext.getCmp("anticipo").setVisible(false);
                                Ext.getCmp("refer").setVisible(false);
                                
                                Ext.getCmp("refer").allowBlank = false;
                            }
                            Ext.getCmp("refer").setValue("");
                        }
                    }
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: .1,
                },
                {
                    xtype: 'Colsys.Widgets.WgCuentasSiigo',
                    fieldLabel: 'Cuenta',
                    name: 'cuenta',
                    labelStyle: 'padding-left: 10px',
                    labelAlign: 'center',
                    id: 'cuenta',
                    allowBlank: false,
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 10
                },
                {
                    xtype: 'Colsys.Widgets.WgCentrocostos',
                    fieldLabel: 'Centro Costos',
                    name: 'centrocostos',
                    id: 'centrocostos',
                    allowBlank: false,
                    labelWidth: 100
                },
                {
                    //xtype:'Colsys.Widgets.WgClientes',        
                    xtype: 'Colsys.Widgets.wgClienteSucursal',
                    fieldLabel: 'Cliente',
                    labelAlign: 'center',
                    labelStyle: 'padding-left: 10px',
                    name: 'cliente',
                    allowBlank: false,
                    id: 'cliente',
                    labelWidth: 100,
                    listeners: {
                        select: function (combo, records, eOpts) {
                            var idsucursal = combo.value;
                            var store = combo.getStore();
                            var registro = store.findRecord("idsucursal", idsucursal);
                            Ext.getCmp("cli").setValue(registro.data.idcliente);
                        }
                    }
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 10
                },
                {
                    xtype: 'checkboxfield',
                    boxLabel: 'Anticipo',
                    name: 'anticipo',
                    inputValue: '1',
                    hidden: true,
                    id: 'anticipo',
                    listeners: {
                        change: function (me, newValue, oldValue, eOpts) {
                            if (newValue == 1){
                                Ext.getCmp("refer").setVisible(true);
                                Ext.getCmp("refer").allowBlank = false;
                            }
                            else{
                                Ext.getCmp("refer").setVisible(false);
                                Ext.getCmp("refer").allowBlank = true;
                                Ext.getCmp("refer").setValue("");
                            }
                        }

                    }
                },
                {
                    xtype: 'Colsys.Widgets.WgReferencias',
                    fieldLabel: 'Referencia',
                    name: 'refer',
                    id: 'refer',
                    displayField: 'referencia',
                    valueField: 'idmaster',
                    hidden: true,
                    listeners: {
                        select: function (combo, records, e0pts){
                        }
                    }
                },
                
                {
                    xtype: 'textfield',
                    fieldLabel: 'cli',
                    hidden: true,
                    name: 'cli',
                    id: 'cli'
                }
            ]

        }]
})