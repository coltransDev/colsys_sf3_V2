Ext.define('Colsys.Contabilidad.FormParamIds', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Contabilidad.FormParamIds',
    id: "form-nuevoParamIds",
    bodyPadding: 5,
    width: 1000,
    listeners: {
        afterrender: function (ct, position) {
            this.add({
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
                        xtype: 'hidden',
                        name: 'idparamids',
                        id: 'idparamids'
                    },
                    {
                        xtype: 'Colsys.Widgets.WgParametros',
                        fieldLabel: 'Parametro ',
                        name: 'parametro',
                        id: 'parametro',
                        caso_uso: 'CU263',
                        allowBlank: false,
                        labelWidth: 100,
                        displayField: 'valor2',
                        valueField: 'name'
                                /*listeners: {
                                 render : function(me,eOpts){
                                 
                                 console.log(me);
                                 }
                                 }*/

                    },
                    {
                        xtype: 'tbspacer',
                        columnWidth: 1,
                        height: 7
                    },
                    {
                        xtype: 'textfield',
                        fieldLabel: 'Valor',
                        name: 'valor',
                        id: 'valor',
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
                    }
                ]
            });
            var store = Ext.getCmp("idempresa").getStore();
            store.load();
        },
        beforerender: function (ct, position) {
            if (this.idparamids) {
                var form = Ext.getCmp("form-nuevoParamIds").getForm();
                form.load({
                    url: '/contabilidad/datosIdParametroIds',
                    params: {
                        idparamids: this.idparamids
                    },
                    success: function (response, options) {
                        res = Ext.JSON.decode(options.response.responseText);
                        console.log(res);
                        var store = Ext.getCmp("idempresa").getStore();
                        store.add(
                                {"id": res.data.idempresa, "name": res.data.empresa}
                        );
                        Ext.getCmp("idempresa").setValue(res.data.idempresa);
                        storeParametros = Ext.getCmp("parametro").getStore();
                        storeParametros.load({
                            params: {
                                caso_uso: 'CU263'
                            },
                            callback: function (response, opc) {
                                parametr = storeParametros.findRecord("name", res.data.parametro);
                                if (parametr != null){
                                    Ext.getCmp("parametro").setValue(parametr.data.name);
                                }
                            }
                        });
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
                        idparamids = this.up('form').idparamids;
                        form = Ext.getCmp("form-nuevoParamIds").getForm();
                        if (form.isValid()) {

                            form.submit({
                                url: '/contabilidad/guardarParamIds',
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                params: {
                                    idparamids: idparamids,
                                    param: Ext.getCmp("parametro").value
                                },
                                success: function (form, action) {
                                    Ext.MessageBox.alert("Success", "Datos Almacenados Correctamente");
                                    Ext.getCmp("grid-parametrosids").getStore().reload();
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
    // items: []
})

