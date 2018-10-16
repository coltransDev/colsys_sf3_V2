Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-sino',
    store: Ext.create('Ext.data.Store', {
        fields: ['name', 'value'],
        data: [
            {name: 'SI', value: 'S'}, {name: 'NO', value: "N"}
        ]
    })

});
Ext.define('ComboTipo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipo',
    store: ['S', 'O']
});
Ext.define('ComboPt', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-pt',
    store: ['P', 'T']
});
Ext.define('Colsys.Contabilidad.FormConceptoSiigo', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Contabilidad.FormConceptoSiigo',
    id: "form-nuevoconceptosiigo",
    bodyPadding: 5,
    width: 1000,
    listeners: {
        afterrender: function (ct, position) {
            var store = Ext.getCmp("idempresa").getStore();
            store.load();


        },
        beforerender: function (ct, position) {
            if (this.idconceptosiigo) {
                var form = Ext.getCmp("form-nuevoconceptosiigo").getForm();
                form.load({
                    url: '/contabilidad/datosIdConceptoSiigo',
                    params: {
                        idconceptosiigo: this.idconceptosiigo
                    },
                    success: function (response, options) {
                        res = Ext.JSON.decode(options.response.responseText);
                        var str = Ext.getCmp("cc").getStore();
                        a = str.queryBy(function (record, id) {
                            return (record.get('centro') == res.data.cc && record.get('subcentro') == res.data.scc);
                        });
                        Ext.getCmp("cc").setValue(a.items[0].id);
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
                        idconceptosiigo = this.up('form').idconceptosiigo;
                        form = Ext.getCmp("form-nuevoconceptosiigo").getForm();

                        if (form.isValid()) {
                            scc = Ext.getCmp("cc").displayTplData[0].subcentro;
                            cc = Ext.getCmp("cc").displayTplData[0].centro;
                            form.submit({
                                url: '/contabilidad/guardarConceptoSiigo',
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                params: {
                                    idconceptosiigo: idconceptosiigo,
                                    scc: scc,
                                    CC: cc
                                },
                                success: function (form, action) {
                                    Ext.MessageBox.alert("Success", "Datos Almacenados Correctamente");
                                    Ext.getCmp("grid-conceptosSiigo").getStore().reload();
                                    Ext.getCmp("winNuevoTipo").close();
                                }
                            })
                        } else {
                            Ext.MessageBox.alert("Error", "Es necesario diligenciar los Campos obligatorios ");
                            error = 0;
                        }

                    }
                }]
        }],
    items: [{
            xtype: 'fieldset',
            columnWidth: .9,
            layout: 'column',
            width: 700,
            height: 300,
            defaults: {
                columnWidth: .45,
                labelAlign: 'left'
            },
            items: [
                {
                    xtype: 'textfield',
                    id: 'idconceptosiigo',
                    hidden: true
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Nombre',
                    name: 'descripcion',
                    id: 'descripcion',
                    allowBlank: false,
                    //  height: 50,
                    labelWidth: 100,
                    columnWidth: .9
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5
                },
                {
                    xtype: 'numberfield',
                    minValue: 0,
                    value: 0,
                    fieldLabel: 'Codigo',
                    name: 'codigo',
                    allowBlank: false,
                    id: 'codigo',
                    labelWidth: 100
                },
                /* {
                 xtype: 'textfield',
                 fieldLabel: 'Descripcion',
                 name: 'descripcion',
                 labelStyle: 'padding-left: 10px',
                 labelAlign: 'center',
                 id: 'descripcion',
                 labelWidth: 100,
                 maxLenght: 100
                 },*/


                {
                    xtype: 'Colsys.Widgets.WgCuentasSiigo',
                    labelStyle: 'padding-left: 10px',
                    labelAlign: 'center',
                    maxLength: 50,
                    fieldLabel: 'Cuenta',
                    name: 'cuenta',
                    id: 'cuenta',
                    labelWidth: 100,
                    allowBlank: false,
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 10
                },
                {
                    xtype: 'Colsys.Widgets.WgCentrocostos',
                    fieldLabel: 'Centro Costos',
                    listartodos: true,
                    allowBlank: false,
                    forceSelection: true,
                    name: 'cc',
                    id: 'cc',
                },
                {
                    xtype: 'numberfield',
                    minValue: 0,
                    value: 0,
                    labelAliuardn: 'center',
                    fieldLabel: 'Valor',
                    name: 'valor',
                    labelStyle: 'padding-left: 10px',
                    maxLength: 5,
                    id: 'valor',
                    allowBlank: false,

                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'combo-pt',
                    forceSelection: true,
                    fieldLabel: 'Propio-Tercero',
                    name: 'pt',
                    id: 'pt',
                    allowBlank: false,
                },
                {
                    xtype: 'combo-sino',
                    fieldLabel: 'IVA',
                    name: 'iva',
                    labelStyle: 'padding-left: 10px',
                    id: 'iva',
                    displayField: 'name',
                    valueField: 'value',
                    allowBlank: false,
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'numberfield',
                    minValue: 0,
                    value: 0,
                    fieldLabel: '% IVA',
                    name: 'porciva',
                    id: 'porciva',
                    allowBlank: false,
                },
                {
                    xtype: 'combo-sino',
                    fieldLabel: 'ReteFuente',
                    labelStyle: 'padding-left: 10px',
                    name: 'rtefte',
                    allowBlank: false,
                    displayField: 'name',
                    valueField: 'value',
                    id: 'rtefte'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.WgCuentasSiigo',
                    fieldLabel: 'Cuenta Retfte',
                    name: 'ctartefte',
                    allowBlank: false,
                    labelWidth: 100,
                    id: 'ctartefte'
                },
                {
                    xtype: 'numberfield',
                    minValue: 0,
                    value: 0,
                    fieldLabel: 'Base',
                    name: 'base',
                    labelStyle: 'padding-left: 10px',
                    labelAlign: 'center',
                    allowDecimals: false,
                    allowBlank: false,
                    id: 'base'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: '%',
                    value: 0,
                    minValue: 0,
                    forceSelection: true,
                    name: 'porcrtefte',
                    allowBlank: false,
                    id: 'porcrtefte'
                },
                {
                    xtype: 'combo-sino',
                    fieldLabel: 'Autoretenedor',
                    //forceSelection: true,
                    labelStyle: 'padding-left: 10px',
                    allowDecimals: false,
                    allowBlank: false,
                    labelAlign: 'center',
                    name: 'autoret',
                    displayField: 'name',
                    valueField: 'value',
                    id: 'autoret',
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                /*{
                 xtype: 'Colsys.Widgets.WgCuentasSiigo',
                 fieldLabel: 'Cuenta ReteIva',
                 allowDecimals: false,
                 labelAlign: 'center',
                 name: 'ctarteiva',
                 // forceSelection: true,
                 id: 'ctarteiva',
                 labelWidth: 100
                 
                 },*/
                /*{
                 xtype: 'Colsys.Widgets.WgCuentasSiigo',
                 fieldLabel: 'Cuenta Iva',
                 labelStyle: 'padding-left: 10px',
                 allowDecimals: false,
                 name: 'ctaiva',
                 // forceSelection: true,
                 labelAlign: 'center',
                 id: 'ctaiva',
                 labelWidth: 100
                 },
                 {
                 xtype: 'tbspacer',
                 columnWidth: 1,
                 height: 7
                 },*/
                {
                    xtype: 'Colsys.Widgets.wgEmpresas',
                    fieldLabel: 'Empresa',
                    name: 'idempresa',
                    allowBlank: false,
                    id: 'idempresa'
                },
                {
                    xtype: 'numberfield',
                    minValue: 0,
                    value: 0,
                    fieldLabel: 'Base AR',
                    name: 'basear',
                    labelStyle: 'padding-left: 10px',
                    labelAlign: 'center',
                    allowDecimals: false,
                    id: 'basear'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5,
                    hidden: true
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Moneda',
                    minValue: 0,
                    value: 0,
                    name: 'moneda',
                    id: 'moneda',
                    hidden: true
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'convenio',
                    name: 'convenio',
                    labelStyle: 'padding-left: 10px',
                    minValue: 0,
                    value: 0,
                    labelAlign: 'center',
                    allowDecimals: false,
                    id: 'convenio',
                    hidden: true
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5
                },
                {
                    xtype: 'combo-tipo',
                    fieldLabel: 'Tipo',
                    name: 'tipo',
                    allowBlank: false,
                    forceSelection: true,
                    id: 'tipo'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5
                }

            ]

        }]
})