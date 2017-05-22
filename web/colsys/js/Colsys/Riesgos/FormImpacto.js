Ext.define('Colsys.Riesgos.FormImpacto', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Riesgos.FormImpacto',
    bodyPadding: 5,
    autoScroll: true,    
    defaults: {        
        bodyStyle:'padding:4px',
        labelWidth:100
    },
    url: '/riesgos/guardarFormImpacto',
    listeners: {        
        render: function (me, eOpts) {            
            this.add(
                {xtype: 'hidden',       id: 'idvaloracion', name: 'idvaloracion',   value: this.idval},
                {xtype: 'hidden',       id: 'idriesgo',     name: 'idriesgo',       value: this.idriesgo},                
                {xtype: 'textfield',    id: 'operativo',    name: 'operativo',      fieldLabel: 'Impacto Operativo'},
                {xtype: 'textfield',    id: 'legal',        name: 'legal',          fieldLabel: 'Impacto Legal'},
                {xtype: 'textfield',    id: 'economico',    name: 'economico',      fieldLabel: 'Impacto Economico'},
                {xtype: 'textfield',    id: 'comercial',    name: 'comercial',      fieldLabel: 'Impacto Comercial'}
            )
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'button',
                text: 'Guardar',
                height: 30,
                iconCls: 'disk',
                handler: function () {                    
                    var form = this.up('form');
                    var idriesgo = form.idriesgo;

                    if (form.isValid()) {                
                        form.submit({                            
                            success: function(form, action) {                                
                                Ext.getCmp('winImpacto').close();                                
                                Ext.MessageBox.alert("Mensaje", 'Los datos se han guardado \u00E9xitosamente.<br/>');
                                Ext.getCmp('grid-eve'+idriesgo).getStore().reload();                                
                            },
                            failure: function(form, action) {
                                /*Ext.Msg.alert('Failed', action.result.msg);*/
                            }
                        });
                    }else{
                        Ext.MessageBox.alert("Mensaje", 'Por favor complete todos los campos!');
                    }
                }
            },{
                xtype: 'button',
                text: 'Cerrar',
                height: 30,
                iconCls: 'close',
                handler: function () {                                        
                    Ext.getCmp('winImpacto').close(); 
                }
            });
            this.addDocked(tb);
        }
    },
    cargar: function(idval){        
        var me=this;
        me.form.load({
            url:'/riesgos/datosFormImpacto',
            waitMsg:'cargando...',
            params:{                
                idvaloracion: idval
            },
            success: function (response, options) {
                var res = Ext.JSON.decode(options.response.responseText);
                
            },
            failure: function(){
                alert("Los datos no han cargado correctamente!");
            }            
        });
    }
})