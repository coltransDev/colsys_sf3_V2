Ext.define('Colsys.Indicadores.Internos.WindowVersion', {
    extend: 'Ext.window.Window',
    alias: 'widget.Colsys.Indicadores.Internos.WindowVersion',    
    layout: 'fit',
    closeAction: 'destroy',
    listeners:{
        render: function (me, eOpts){
            
            me.add(
                Ext.create('Ext.form.Panel', {                        
                    bodyPadding: 10,
                    url: '/indicadores/guardarRepositorio',
                    layout: 'anchor',
                    id: 'form-version-'+me.indice,
                    defaults: {
                        anchor: '100%'
                    },                        
                    items: [{
                        xtype: 'hidden',
                        name: 'version',                        
                    },
                    {
                        xtype: 'hidden',
                        name: 'indice',
                        value: me.indice
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
                        xtype: 'Colsys.Widgets.WgSucursalesEmpresa',
                        fieldLabel: 'Sucursal',
                        name: 'idsucursal',
                        id: 'idsucursal',
                        allowBlank: false,
                        empresa: 2
                    },
                    {
                        xtype: 'textareafield',
                        name: 'observaciones',
                        fieldLabel: 'Observaciones',
                        allowBlank: true  // requires a non-empty value
                    }
                    ],
                    // Reset and Submit buttons
                    buttons: [{
                        text: 'Guardar',
                        formBind: true, //only enabled once the form is valid
                        disabled: true,
                        handler: function(t, eOpts) {
                            
                            var form = this.up('form').getForm();                            
                            if (form.isValid()) {
                                
                                var filepdf = t.up("window").pdf; 
                                
                                form.submit({
                                    params: {
                                        idg: me.idg,
                                        ano: me.ano,
                                        mes: me.mes,
                                        tipo: 'archivo',
                                        data: filepdf
                                    },
                                    success: function(form, action) {
                                       
                                       Ext.getCmp('window-pdf-idg-'+me.indice).close();
                                       Ext.getCmp('grid-archivos-'+me.indice).getStore().reload();
                                       Ext.getCmp('tabrepos-'+me.indice).up("tabpanel").setActiveTab('tabrepos-'+me.indice);
                                       me.close();
                                       Ext.Msg.alert('Mensaje', "El archivo se ha creado satisfactoriamente");
                                       
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
                            
                            var idg = me.up("window").idg;
                            var ano = me.up("window").ano;
                            var mes = me.up("window").mes;                                                     
                            
                            
                            if(idg){
                                var f = this.getForm();
                                //console.log(f);
                                f.load({
                                    url: '/indicadores/datosVersiones',
                                    //waitMsg: 'Cargando datos...',
                                    params: {
                                        idg: idg,
                                        ano: ano,
                                        mes: mes
                                    },
                                    success: function(response, options){ 
                                        res = Ext.JSON.decode(options.response.responseText);                                                                                
                                        //Ext.getCmp('form-version-'+idproceso).child('label[id=labelv]').setText("Version # "+res.data.version);
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