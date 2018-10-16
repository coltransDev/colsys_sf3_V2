Ext.define('Colsys.Contabilidad.FormParamContable', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Contabilidad.FormParamContable',
    id: "form-nuevoParamContable",
    bodyPadding: 5,
    width: 1000,
    listeners: {
        afterrender: function (ct,position){
            var store = Ext.getCmp("idempresa").getStore();
            store.load();
        },
        beforerender: function (ct,position){
            if (this.idparametrocontable){
                var form = Ext.getCmp("form-nuevoParamContable").getForm();
                form.load({
                    url: '/contabilidad/datosIdParametroContable',
                    params: {
                        idparametrocontable: this.idparametrocontable
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
                        idparametrocontable = this.up('form').idparametrocontable;
                        form = Ext.getCmp("form-nuevoParamContable").getForm();
                        
                        if (form.isValid()) {

                            form.submit({
                                url: '/contabilidad/guardarParamContable',
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                params: {
                                    idparametrocontable: idparametrocontable,
                                    idcuenta: Ext.getCmp("cuenta").valueModels[0].data.ca_idcuenta
                                },
                                success: function (form, action) {
                                    Ext.MessageBox.alert("Success", "Datos Almacenados Correctamente");
                                    Ext.getCmp("grid-parametroscontables").getStore().reload();
                                    Ext.getCmp("winNuevoTipo").close();
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
            columnWidth: .9,
            layout: 'column',
            width: 350,
            height: 200,
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
                    xtype: 'hidden',
                    name: 'idparametrocontable',
                    id: 'idparametrocontable'
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Tipo ',
                    name: 'tipo',
                    id: 'tipo',
                    allowBlank: false,
                    maxLength: 10,
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.WgCuentasSiigo',
                    fieldLabel: 'Cuenta',
                    allowDecimals: true,
                    name: 'cuenta',
                    id: 'cuenta',
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Base',
                    name: 'base',
                    allowDecimals: true,
                    id: 'base',
                    allowBlank: false,
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Porcentaje Tarifa',
                    name: 'porctarifa',
                    id: 'porctarifa',
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
                    name: 'idempresa',
                    id: 'idempresa'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.WgCiudadesCol',
                    fieldLabel: 'Ciudad',
                    name: 'ciudad',
                    id: 'ciudad'
                }
            ]
        }]
})