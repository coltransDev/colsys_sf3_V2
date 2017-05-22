Ext.define('Colsys.Indicadores.FormFacturacion', {
    alias: 'widget.wFormFacturacion',
    extend: 'Ext.form.Panel',
    bodyStyle: 'padding: 10px;',
    items: [
        {
            xtype: 'Colsys.Widgets.WgTraficos',
            fieldLabel: 'Origen',
            prefijo: this.prefijo,
            name: 'origen',
            id: 'origen',
            labelWidth: 100,
            allowBlank: false,
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Transporte',
            name: 'transporte',
            id: 'transporte' ,
            labelWidth: 100,
            value: 'Mar\u00EDtimo',
            disabled: true
        },
        {
            xtype: 'Colsys.Widgets.WgClientes',
            fieldLabel: 'Cliente',
            name: 'cliente',
            id: 'cliente' ,
            labelWidth: 100,
            prefijo: this.prefijo,
            listeners: {
                beforerender: function(ct, position){
                    this.store.proxy.url = this.prefijo + '/widgets5/listaClientesJSON' ;
                }
            }
        },
        {
            xtype: 'datefield',
            fieldLabel: 'Fecha Inicio',
            //prefijo: this.prefijo,
            name: 'f_inicio',
            id: 'f_inicio',
            allowBlank: false,
            format: "Y-m-d",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d',
            labelWidth: 100
        },
        {
            xtype: 'datefield',
            fieldLabel: 'Fecha Fin',
            //prefijo: this.prefijo,
            name: 'f_fin',
            id: 'f_fin',
            allowBlank: false,
            format: "Y-m-d",
            altFormat: "Y-m-d",
            submitFormat: 'Y-m-d',
            labelWidth: 100
        },
        {
            xtype: 'numberfield',
            name: 'dias',
            fieldLabel: 'Dias',
            minValue: 0,
            allowBlank: false,
            id: 'dias',
            labelWidth: 100,
        },
        {
            xtype: 'button',
            text: 'Guardar',
            style: 'margin-left:40%;',
            handler: function () {
                me = this;
                var form = this.up('form').getForm();
                if (form.isValid()) {
                    form.submit({
                        url: me.up('form').prefijo + "/widgets5/guardarIdgCliente",
                        waitMsg: 'Guardando...',
                        waitTitle: 'Por favor espere...',
                        params: {
                            tipo: 'facturacion',
                            transporte: 'Mar\u00EDtimo'
                        },
                        success: function (form, action) {
                            if (action.result.success) {
                                Ext.MessageBox.alert('Mensaje', "Datos Almacenados Correctamente");
                                Ext.getCmp("parametrizacion").getStore().reload();
                                me.up('form').up('window').close();

                            }
                        },
                        failure: function (form, action) {
                            Ext.MessageBox.alert('Error Message', "Ya Existe un Registro con Estas Caracteristicas");
                        }
                    });
                } else {
                    Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
                }
            }
        }

    ]
});