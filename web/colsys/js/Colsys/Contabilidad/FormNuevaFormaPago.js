Ext.define('Colsys.Contabilidad.FormNuevaFormaPago', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Contabilidad.FormNuevaFormaPago',
    id: "form-nuevaFormaPago",
    bodyPadding: 5,
    width: 1000,
    listeners: {
        afterrender: function (ct,position){
            var store = Ext.getCmp("idempresa").getStore();
            store.load();
        },
        beforerender: function (ct,position){
            if (this.idformapago){
                var form = Ext.getCmp("form-nuevaFormaPago").getForm();
                form.load({
                    url: '/contabilidad/datosIdformaPago',
                    params: {
                        idformapago: this.idformapago
                    },
                    success: function(response, options){ 
                        res = Ext.JSON.decode(options.response.responseText);
                        console.log(res);
                        var store = Ext.getCmp("idempresa").getStore();
                        store.add(
                                {"id": res.data.idempresa, "name" : res.data.empresa}
                                );
                        Ext.getCmp("idempresa").setValue(res.data.idempresa);
                    }
                });
            }
        }
    },
    dockedItems: [{
            xtype: 'toolbar',
            dock: 'top',
            style: 'padding-right:500px;',
            items: [{
                    text: 'Guardar',
                    iconCls: 'disk',
                    handler: function () {
                        idformapago = this.up('form').idformapago;
                        form = Ext.getCmp("form-nuevaFormaPago").getForm();
                        
                        if (form.isValid()) {

                            form.submit({
                                url: '/contabilidad/guardarFormaPago',
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                params: {
                                    idformapago: idformapago,
                                    idcuenta: Ext.getCmp("cuenta").valueModels[0].data.ca_idcuenta
                                },
                                success: function (form, action) {
                                    Ext.MessageBox.alert("Success", "Datos Almacenados Correctamente");
                                    Ext.getCmp("grid-formaspago").getStore().reload();
                                    Ext.getCmp("winNuevoTipo").close();
                                }
                            })
                        } else {
                            Ext.MessageBox.alert("Error", "Diligencie completamente los datos");
                            error = 0;
                        }

                    }
                }]
        }],
    items: [{
            xtype: 'fieldset',
            columnWidth: .9,
            layout: 'column',
            width: 350,
            height: 120,
            defaults: {
                columnWidth: 1,
                labelAlign: 'left'
            },
            items: [
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Nombre ',
                    name: 'nombre',
                    id: 'nombre',
                    allowBlank: false,
                    maxLenght: 100,
                    labelWidth: 100
                },
                {
                    xtype: 'hidden',
                    fieldLabel: 'idformapago',
                    name: 'idformapago',
                    id: 'idformapago',
                    allowBlank: false,
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.wgEmpresas',
                    fieldLabel: 'Empresa',
                    //forceSelection: true,
                    name: 'idempresa',
                    id: 'idempresa'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.WgCuentasSiigo',
                    fieldLabel: 'Cuenta',
                    labelStyle: 'padding-left: 10px',
                    allowDecimals: false,
                    name: 'cuenta',
                    id: 'cuenta',
                    labelWidth: 100
                }
            ]

        }]
})