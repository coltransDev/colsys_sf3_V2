Ext.define('Colsys.Riesgos.WindowVersion', {
    extend: 'Ext.window.Window',
    alias: 'widget.Colsys.Riesgos.WindowVersion',    
    layout: 'fit',
    closeAction: 'destroy',
    listeners:{
        render: function (me, eOpts){
            
            me.add(
                Ext.create('Ext.form.Panel', {                        
                    bodyPadding: 10,
                    url: '/riesgos/pdfProceso',
                    layout: 'anchor',
                    id: 'form-version-'+me.idproceso,
                    defaults: {
                        anchor: '100%'
                    },                        
                    items: [{
                        xtype: 'hidden',
                        name: 'version',                        
                    },
                    {
                        xtype: 'label',
                        name:'labelv',
                        id: 'labelv',
                        forId: 'FieldId'//,                        
                        //margin: '0 0 0 10'
                    },
                    {
                        xtype: 'textfield',
                        name: 'filename',
                        fieldLabel: 'Nombre',
                        allowBlank: false  // requires a non-empty value
                    },
                    {
                        xtype: 'textareafield',
                        name: 'observaciones',
                        fieldLabel: 'Notas',
                        allowBlank: true  // requires a non-empty value
                    }
                    ],
                    // Reset and Submit buttons
                    buttons: [{
                        text: 'Guardar',
                        formBind: true, //only enabled once the form is valid
                        disabled: true,
                        handler: function() {
                            var form = this.up('form').getForm();                            
                            if (form.isValid()) {   
                                console.log("dfas");
                                form.submit({
                                    params: {
                                        idproceso: me.idproceso,
                                        tipo: 'repos'
                                    },
                                    success: function(form, action) {
                                       me.close();
                                       Ext.getCmp('window-pdf-'+me.idproceso).close();
                                       Ext.getCmp('tree-id').getStore().reload();
                                       Ext.Msg.alert('Mensaje', action.result.mensaje);
                                    },
                                    failure: function(form, action) {
                                        console.log(action.result);
                                        Ext.Msg.alert('Error', action.result.erroInfo);
                                    }
                                })
                            }
                        }
                    }],
                    listeners: {
                        afterrender: function(me, eOpts){
                            
                            var idproceso = me.up("window").idproceso;                            
                            if(idproceso){
                                var f = this.getForm();
                                console.log(f);
                                f.load({
                                    url: '/riesgos/datosVersiones',
                                    params: {
                                        idproceso: idproceso
                                    },
                                    success: function(response, options){ 
                                        res = Ext.JSON.decode(options.response.responseText);                                        
                                        Ext.getCmp('form-version-'+idproceso).child('label[id=labelv]').setText("Version # "+res.data.version);
                                    }
                                });
                            }
                        }
                    }
                })
            );
        }
    }
});