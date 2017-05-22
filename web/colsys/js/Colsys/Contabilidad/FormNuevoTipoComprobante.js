Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-sino',
    store: Ext.create('Ext.data.Store', {
        fields: ['name', 'value'],
        data: [
            {name: 'SI', value: true}, {name: 'NO', value: false}
        ]
    })

});
Ext.define('ComboTipo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-tipo',
    store: ['F', 'C', 'R']
});
Ext.define('Colsys.Contabilidad.FormNuevoTipoComprobante', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Contabilidad.FormNuevoTipoComprobante',
    id: "form-nuevotipocomprobante",
    bodyPadding: 5,
    width: 1000,
    listeners: {
        afterrender: function (ct,position){
            var store = Ext.getCmp("idempresa").getStore();
            store.load();
        },
        beforerender: function (ct,position){
            if (this.idtipo){
                var form = Ext.getCmp("form-nuevotipocomprobante").getForm();
                form.load({
                    url: '/contabilidad/datosIdTipocomprobante',
                    params: {
                        idtipo: this.idtipo
                    },
                    success: function(response, options){ 
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
                        idtipo = this.up('form').idtipo;
                        form = Ext.getCmp("form-nuevotipocomprobante").getForm();

                        if (form.isValid()) {

                            form.submit({
                                url: '/contabilidad/guardarTipoComprobante',
                                waitMsg: 'Guardando...',
                                waitTitle: 'Por favor espere...',
                                params: {
                                    idtipo: idtipo
                                },
                                success: function (form, action) {
                                    Ext.MessageBox.alert("Success", "Datos Almacenados Correctamente");
                                    Ext.getCmp("grid-tipocomprobantes").getStore().reload();
                                    Ext.getCmp("winNuevoTipo").close();
                                }
                            })
                        } else {
                            Ext.MessageBox.alert("Error", "Diligencie Completamente los Datos");
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
            height: 420,
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
                    xtype: 'combo-tipo',
                    fieldLabel: 'Tipo ',
                    forceSelection: true,
                    name: 'tipo',
                    id: 'tipo',
                    allowBlank: false,
                    labelWidth: 100
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Comprobante',
                    name: 'comprobante',
                    labelStyle: 'padding-left: 10px',
                    labelAlign: 'center',
                    id: 'comprobante',
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 10
                },
                {
                    xtype: 'textfield',
                    maxLength: 50,
                    fieldLabel: 'T\u00EDtulo',
                    name: 'titulo',
                    id: 'titulo',
                    labelWidth: 100
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Numeraci\u00F3n inicial',
                    labelAlign: 'center',
                    allowDecimals: false,
                    labelStyle: 'padding-left: 10px',
                    name: 'numeracioninicial',
                    id: 'numeracioninicial'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                
                {
                    xtype: 'numberfield',
                    fieldLabel: 'N\u00FAmero autorizaci\u00F3n',
                    allowDecimals: false,
                    name: 'noautorizacion',
                    id: 'noautorizacion',
                    maxLength: 5,
                },
                {
                    xtype: 'textfield',
                    labelAlign: 'center',
                    fieldLabel: 'Prefijo autorizaci\u00F3n',
                    name: 'prefijo',
                    labelStyle: 'padding-left: 10px',
                    maxLength: 5,
                    id: 'prefijo'

                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Autorizaci\u00F3n inicial',
                    allowDecimals: false,
                    name: 'inicial',
                    id: 'inicial'
                },
                
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Autorizaci\u00F3n final',
                    name: 'final',
                    labelStyle: 'padding-left: 10px',
                    allowDecimals: false,
                    id: 'final'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
               
                {
                    xtype: 'datefield',
                    fieldLabel: 'Fecha autorizaci\u00F3n',
                    name: 'fechaautorizacion',
                    id: 'fechaautorizacion',
                    format: 'Y-m-d',
                    useStrict: undefined
                },
                {
                    xtype: 'combo-sino',
                    fieldLabel: 'Activo',
                    labelStyle: 'padding-left: 10px',
                    name: 'activo',
                    allowBlank: false,
                    forceSelection: true,
                    id: 'activo',
                    displayField: 'name',
                    valueField: 'value'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.WgSucursalesEmpresa',
                    fieldLabel: 'Sucursal',
                    name: 'idsucursal',
                    id: 'idsucursal',
                    empresa: '2',
                    listeners: {
                        select : function ( combo, records, eOpts ){
                            data=records[0].data;
                            Ext.getCmp("idempresa").setValue(data.idempresa);
                            Ext.getCmp("idempresa").readOnly = true;
                        }
                    }
                },
                
                {
                    xtype: 'numberfield',
                    fieldLabel: 'Numeraci\u00F3n actual',
                    name: 'numeracionactual',
                    labelStyle: 'padding-left: 10px',
                    labelAlign: 'center',
                    allowDecimals: false,
                    id: 'numeracionactual'
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.wgEmpresas',
                    fieldLabel: 'Empresa',
                    forceSelection: true,
                    name: 'idempresa',
                    id: 'idempresa'
                },
                
                {
                    xtype: 'Colsys.Widgets.WgCuentasSiigo',
                    fieldLabel: 'Cuenta ReteIca',
                    //forceSelection: true,
                    labelStyle: 'padding-left: 10px',
                    allowDecimals: false,
                    labelAlign: 'center',
                    name: 'ctarteica',
                    id: 'ctarteica',
                    labelWidth: 100
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 7
                },
                {
                    xtype: 'Colsys.Widgets.WgCuentasSiigo',
                    fieldLabel: 'Cuenta ReteIva',
                    allowDecimals: false,
                    labelAlign: 'center',
                    name: 'ctarteiva',
                   // forceSelection: true,
                    id: 'ctarteiva',
                    labelWidth: 100
                    
                },
                
                {
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
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Mensaje',
                    name: 'mensaje',
                    id: 'mensaje',
                    height: 50,
                    columnWidth: .9
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 5
                },
                {
                    xtype: 'textfield',
                    fieldLabel: 'Descripci\u00F3n',
                    name: 'descripcion',
                    id: 'descripcion',
                    allowBlank: false,
                    height: 50,
                    labelWidth: 100,
                    columnWidth: .9
                }
            ]

        }]
})