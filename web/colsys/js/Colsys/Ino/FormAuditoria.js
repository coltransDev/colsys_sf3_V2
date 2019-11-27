Ext.define('Colsys.Ino.FormAuditoria', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormAuditoria',    
    bodyPadding: 5,    
    listeners:{
        beforerender: function(ct, position){
            var me = this;
            
            var comboProcesos = Ext.create('Ext.form.field.ComboBox', {
                fieldLabel: 'Proceso',                
                store: new Ext.data.Store({                    
                    fields: [                        
                        {name: 'idgrupo'},
                        {name: 'nombre'}
                    ],
                    proxy: {
                        url: '/pm/datosAreas',    
                        type: 'ajax',                        
                        reader: {
                            id: 'idgrupo',
                            rootProperty: 'grupos',
                            totalProperty: 'total',                          
                            type: 'json'
                        }
                    },
                    autoLoad: false                    
                }),
                queryMode: 'local',                
                displayField: 'nombre',
                valueField: 'idgrupo',
                id: 'combo-procesos'+me.idmaster, 
                name: 'area',
                hiddenName: 'idarea',
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                autoScroll: true,
                allowBlank: false,
                listConfig: {
                    loadingText: 'buscando...',
                    emptyText: 'No existen registros',
                    getInnerTpl: function () {
                        return '<tpl for="."><div class="search-item"><span style=" font-weight: bold;">{nombre}</span></div></tpl>';
                    }
                },
                onFocus : function( field, newVal, oldVal ){     
                    this.store.load({
                        params : {                              
                            departamento: 4
                        }
                    });
                },
                listeners:{
                    select: function(combo, record, eOpts){
                        comboProyectos = Ext.getCmp("combo-proyectos"+me.idmaster);
                        
                        comboProyectos.getStore().load({
                            params: {
                                idgrupo: combo.getValue()
                            }
                        });
                        
                        comboHallazgos = Ext.getCmp("combo-hallazgos"+me.idmaster);
                        
                        comboHallazgos.getStore().load({
                            params: {
                                departamento: 4
                            }
                        });
                        
                        /*Asigna el hallazgo al usuario que se autenticó si pertenece al proceso*/
                        
                        Ext.Ajax.request({
                            url: '/inoF2/getUsuarioAutenticado',
                            success: function(response, opts) {                                
                                var obj = Ext.decode(response.responseText);                                

                                usuarioAsignado = Ext.getCmp("usuario-asig-"+me.idmaster);


                                usuarioAsignado.getStore().load({
                                    params: {
                                        idgrupo: combo.getValue()
                                    },
                                    callback: function(records, operation, success) {
                                        var record = usuarioAsignado.getStore().findRecord('login',obj.login);

                                        if(record)
                                            usuarioAsignado.setValue(record.data.login);                                            
                                        else{
                                            usuarioAsignado.setValue(null);
                                            if(me.tipo != 'apertura')
                                                Ext.MessageBox.alert("Mensaje", 'El usuario creador del hallazgo no pertenece al proceso seleccionado');                                        
                                        }

                                        if(me.tipo == 'apertura'){                                                
                                            var usuarioReportado = Ext.getCmp("usuario-reportado-"+me.idmaster);                                                
                                            usuarioReportado.getStore().add({login:obj.login,nombre: obj.nombre});                                                
                                            usuarioReportado.setValue(obj.login); 
                                        }
                                    }
                                });
                            },
                            failure: function(response, opts) {
                                console.log('server-side failure with status code ' + response.status);
                            }
                        });
                        
                        comboStatus = Ext.getCmp('combo-status-'+me.idmaster);
                        
                        comboStatus.getStore().load({
                            params: {
                                idgrupo: combo.getValue()
                            }                  
                        });                        
                }
                }
            }); 
            
            var comboTemas = Ext.create('Ext.form.field.ComboBox', {
                fieldLabel: 'Tema',
                store: new Ext.data.Store({                    
                    fields: [                        
                        {name: 'idproyecto'},
                        {name: 'nombre'}
                    ],
                    proxy: {
                        url: '/pm/datosProyectos',    
                        type: 'ajax',                        
                        reader: {
                            id: 'idproyecto',
                            rootProperty: 'proyectos',
                            totalProperty: 'total',                          
                            type: 'json'
                        }
                    },
                    autoLoad: false                    
                }),
                queryMode: 'local',                
                displayField: 'nombre',
                valueField: 'idproyecto',
                id: 'combo-proyectos'+me.idmaster, 
                name: 'project',
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                autoScroll: true,
                allowBlank: false,
                listConfig: {
                    loadingText: 'buscando...',
                    emptyText: 'No existen registros',
                    getInnerTpl: function () {
                        return '<tpl for="."><div class="search-item"><span style=" font-weight: bold;">{nombre}</span></div></tpl>';
                    }
                }
            }); 
            
            var comboHallazgos = Ext.create('Ext.form.field.ComboBox', {
                fieldLabel: 'Hallazgo',
                store: new Ext.data.Store({                    
                    fields: [                        
                        {name: 'iddepartamento'},
                        {name: 'clasification'}
                    ],
                    proxy: {
                        url: '/pm/datosClasificacion',    
                        type: 'ajax',                        
                        reader: {                            
                            rootProperty: 'root',
                            totalProperty: 'total',                          
                            type: 'json'
                        }
                    },
                    autoLoad: false                    
                }),
                queryMode: 'local',                
                displayField: 'clasification',
                valueField: 'clasification',
                id: 'combo-hallazgos'+me.idmaster,
                name: 'type',
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                autoScroll: true,
                allowBlank: false,
                listConfig: {
                    loadingText: 'buscando...',
                    emptyText: 'No existen registros',
                    getInnerTpl: function () {
                        return '<tpl for="."><div class="search-item"><span style=" font-weight: bold;">{clasification}</span></div></tpl>';
                    }
                }
            });
            
            var houses =    Ext.create('Colsys.Widgets.wgHouse', {
                fieldLabel: 'House',
                id: 'comboHouse'+this.idmaster,
                name: 'comboHouse',
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id'
            });
            
            houses.idmaster = this.idmaster;
            houses.getStore().load({
                params: {
                    idmaster: this.idmaster
                }
            });
            
            var usuarioAsignado = Ext.create('Ext.form.field.ComboBox', {
                fieldLabel: 'Reportado por',
                store: new Ext.data.Store({                    
                    fields: [                        
                        {name: 'login'}
                    ],
                    proxy: {
                        url: '/pm/datosAsignaciones',    
                        type: 'ajax',                        
                        reader: {                            
                            rootProperty: 'usuarios',
                            totalProperty: 'total',                          
                            type: 'json'
                        }
                    },
                    autoLoad: false                    
                }),
                queryMode: 'local',                
                displayField: 'login',
                valueField: 'login',
                id: "usuario-asig-" + this.idmaster,
                name: 'assignedto',
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                autoScroll: true,
                listConfig: {
                    loadingText: 'buscando...',
                    emptyText: 'No existen registros',
                    getInnerTpl: function () {
                        return '<tpl for="."><div class="search-item"><span style=" font-weight: bold;">{login}</span></div></tpl>';
                    }
                }
            });
            
           
            
            var usuarioReportado = Ext.create('Colsys.Widgets.wgUsuario', {
                id: "usuario-reportado-" + this.idmaster,
                name: 'reportedby',                
                fieldLabel: 'Reportado a',
                allowBlank: false
            });
            
            var empresa = Ext.create('Colsys.Widgets.wgEmpresas', {
                id: "empresa-" + this.idmaster,
                name: 'idempresa',
                fieldLabel: 'Empresa',
                allowBlank: false,
                listeners:{
                    select: function(combo, record, eOpts){
                        var tema = Ext.getCmp('combo-proyectos' + me.idmaster).getRawValue();
                        var hallazgo = Ext.getCmp('combo-hallazgos' + me.idmaster).getRawValue();
                        var house = Ext.getCmp('comboHouse' + me.idmaster).getRawValue();                        
                        var asunto = 'REF: '+me.idreferencia + ' - ' + tema + ' - ' + hallazgo;
                        house?asunto+=' - ' + house:asunto;
                        Ext.getCmp('title-' + me.idmaster).setValue(asunto);
                    }
                }
            });
            
            var comboStatus = Ext.create('Ext.form.field.ComboBox', {
                fieldLabel: 'Status',
                store: new Ext.data.Store({                    
                    fields: [                        
                        {name: 'status'},
                        {name: 'valor'}
                    ],
                    proxy: {
                        url: '/pm/datosStatus',    
                        type: 'ajax',                        
                        reader: {                            
                            rootProperty: 'root',
                            totalProperty: 'total',                          
                            type: 'json'
                        }
                    },
                    autoLoad: false                    
                }),
                queryMode: 'local',                
                displayField: 'valor',
                valueField: 'status',
                id: 'combo-status-'+me.idmaster,
                name: 'status',
                bodyStyle: 'padding-bottom:15px;background:#eee;',
                autoScroll: true,
                allowBlank: true
            });

            this.add(
                    {
                    xtype: 'hiddenfield',
                    name: 'idticket',
                    id: 'idticket-'+me.idmaster,
                    value: me.idticket
                },{
                    xtype: 'hiddenfield',
                    name: 'idmaster',
                    id: 'idmaster-'+me.idmaster,
                    value: me.idmaster
                },{
                xtype: 'fieldset',
                id: 'fieldset-clasificacion-'+me.idmaster,
                title: 'Clasificaci\u00F3n', 
                layout: {
                    type: 'vbox',
                    pack: 'start',
                    align: 'stretch'
                },
                items: [                    
                    comboProcesos,
                    comboTemas,
                    comboHallazgos,
                    houses,
                    usuarioAsignado, 
                    usuarioReportado,
                    comboStatus,
                    empresa
                ]
            },{
                xtype: 'fieldset',
                id: 'fieldset-detalles-'+me.idmaster,
                title: 'Detalles',
                layout: {
                    type: 'vbox',
                    pack: 'start',
                    align: 'stretch'
                },
                items: [{
                    xtype: 'textareafield',
                    id:'title-'+me.idmaster,
                    name : 'title',
                    fieldLabel: 'Asunto',
                    allowBlank: false,
                    editable: false
                },
                {
                    xtype     : 'textareafield',
                    grow      : true,
                    id        : 'text-'+me.idmaster,
                    name      : 'text',
                    fieldLabel: 'Descripci\u00F3n',
                    anchor    : '100%',
                    allowBlank: false
                },
                {
                    xtype: 'fileuploadfield',
                    id: 'archivo-'+me.idmaster,
                    name: 'archivo',
                    width: 250,
                    fieldLabel: 'Adjuntar',
                    emptyText: 'Seleccione un archivo',
                    buttonCfg: {
                        text: '',
                        iconCls: 'upload-icon'
                    }
                }]
            });
            
            
            
        //
        }
    },
    buttons: [{
        text: 'Guardar',
        handler: function() {
            // The getForm() method returns the Ext.form.Basic instance:
            var form = this.up('form').getForm();
            var me = this.up('form');
            
            if (form.isValid()) {
                // Submit the Ajax request and handle the response
                form.submit({
                    url: '/pm/formTicketGuardar',
                    waitMsg: 'Guardando',
                    success: function(form, action) {
                        
                       var idmaster = me.idmaster;
                       var formHallazgo = Ext.getCmp('form-hallazgo-'+idmaster);
                       if(formHallazgo){
                            formHallazgo.store.load({
                                 params : {  
                                     idmaster: idmaster,
                                     iddepartamento: 4,
                                     tipo: "ino"
                                 }                                
                             });
                         
                        
                            formHallazgo.getStore().on(
                                "load",function() {                    
                                    var recordSelected = formHallazgo.getStore().getAt(0);   
                                    if(recordSelected)
                                        formHallazgo.setValue(recordSelected.get('h_ca_idticket'));                    
                                    else{                        
                                        var f = Ext.getCmp("form-vista-ticket"+idmaster).getForm();
                                        f.reset();
                                    }
                                },
                                this,
                                {
                                    single: true
                                }
                            ); 
                            formHallazgo.getStore().sort('h_ca_idticket', 'ASC');
                        }
                        Ext.Msg.alert('Success', 'El requerimiento de auditor\u00EDa ha sido guardado con \u00E9xito');                          
                        me.up("window").destroy();                        
                    },
                    failure: function(form, action) {
                        Ext.Msg.alert('Failed', action.result ? action.result.message : 'No response');
                    }
                });
            }
        }
    }],
    cargar: function(idmaster, idticket){        
        var me=this;
        
        me.form.load({
            url:'/pm/datosTicket',
            waitMsg:'cargando...',
            params:{
                idticket: idticket                
            },
            success: function (response, options) {
                var res = Ext.JSON.decode(options.response.responseText);
                
                me.idticket = idticket;
                proceso = Ext.getCmp('combo-procesos'+idmaster);
                proceso.getStore().add({idgrupo:res.data.idgroup,nombre: res.data.group});
                proceso.setValue(res.data.idgroup);
                proceso.store.load({
                    params : {  
                        idgrupo: res.data.idgroup
                    }                                
                })
                
                
                comboProyectos = Ext.getCmp("combo-proyectos"+ idmaster); 
                comboProyectos.getStore().add({idproyecto:res.data.idproject,nombre: res.data.project});
                comboProyectos.setValue(res.data.idproject);
                comboProyectos.getStore().load({
                    params: {
                        idgrupo: res.data.idgroup                                
                    }
                });
                
                comboHallazgos = Ext.getCmp("combo-hallazgos"+idmaster);                        
                comboHallazgos.getStore().load({
                    params: {
                        departamento: 4
                    }
                });
                        
                usuarioAsignado = Ext.getCmp("usuario-asig-"+idmaster);
                usuarioAsignado.getStore().load({
                    params: {
                        idgrupo: res.data.idgroup
                    }
                });
                
                usuarioReportado = Ext.getCmp("usuario-reportado-"+idmaster);
                usuarioReportado.getStore().add({login:res.data.login,nombre: res.data.loginName});
                usuarioReportado.setValue(res.data.login);
                
                empresa = Ext.getCmp("empresa-"+idmaster);
                empresa.getStore().add({id:res.data.idempresa,name: res.data.empresa});
                empresa.setValue(res.data.idempresa);
                
                
                status = Ext.getCmp("combo-status-"+idmaster);
                
                Ext.getCmp("combo-status-"+idmaster).getStore().reload();
                Ext.getCmp("combo-status-"+idmaster).getStore().add({status:res.data.status,status: res.data.status_name});
                Ext.getCmp("combo-status-"+idmaster).setValue(res.data.status);
            },
            failure: function(){
                alert("Los datos no han cargado correctamente!");
            }            
        });
    }
});