Ext.define('Colsys.Riesgos.FormProceso', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Riesgos.FormProceso',
    bodyPadding:10,
    defaults: {        
        bodyStyle:'padding:4px',
        labelWidth:100,
        allowBlank: false
    },
    url: '/riesgos/guardarFormProceso',
    listeners: {        
        render: function (me, eOpts) {            
            this.add(
                {xtype: 'hidden',                       id: 'ca_idproceso', name: 'idproceso',      value: me.idproceso},                
                {xtype: 'Colsys.Widgets.wgEmpresas',    id: 'ca_idempresa', name: 'ca_idempresa',   fieldLabel: 'Empresa', forceSelection: false, allowBlank:true},                
                {xtype: 'numberfield',                  id: 'ca_orden',     name: 'ca_orden',       fieldLabel: 'Orden', minvalue: 1},
                {xtype: 'textfield',                    id: 'ca_prefijo',   name: 'ca_prefijo',     fieldLabel: 'Prefijo'},                
                {xtype: 'textfield',                    id: 'ca_proceso',   name: 'ca_proceso',     fieldLabel: 'Proceso'},
                {xtype: 'checkboxfield',                id:'ca_activo',     name:'ca_activo',       fieldLabel: 'Activo'}                
            )
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'button',
                text: 'Guardar',
                height: 30,
                iconCls: 'disk',
                handler: function () {                    
                    var form = this.up('form');
//                    var idriesgo = form.idriesgo;

                    if (form.isValid()) {                
                        form.submit({                            
                            success: function(form, action) {                                
                                Ext.getCmp('win-grid-nvoproceso').close();                                
                                Ext.MessageBox.alert("Mensaje", 'Los datos se han guardado \u00E9xitosamente.<br/>');
                                Ext.getCmp('grid-procesos').getStore().reload();                                
                                
                            },
                            failure: function(form, action) {
                                console.log(action);
                                Ext.Msg.alert('Failed', action.result.errorInfo);
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
                handler: function (t) {                                        
                    this.up("window").close();
                }
            });
            this.addDocked(tb);
        }
    },
    cargar: function(idproceso){        
        var me=this;
        me.form.load({
            url:'/riesgos/datosProcesos',
            waitMsg:'cargando...',
            params:{                
                idproceso: idproceso
            },
            success: function (response, options) {
                var res = Ext.JSON.decode(options.response.responseText);                
                Ext.getCmp("ca_idempresa").getStore().add({id:res.data.ca_idempresa,name: res.data.ca_empresa});
                Ext.getCmp("ca_idempresa").setValue(res.data.ca_idempresa);
                
            },
            failure: function(){
                alert("Los datos no han cargado correctamente!");
            }            
        });
    }
})