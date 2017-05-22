Ext.define('Colsys.Riesgos.FormEvento', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Riesgos.FormEvento',
    bodyPadding: 5,
    autoScroll: true,    
    defaults: {        
        bodyStyle:'padding:4px',
        labelWidth:100
    },
    url: '/riesgos/guardarFormEvento',
    listeners: {
        
        render: function (me, eOpts) {
            
            this.add(
                {xtype: 'hidden', id: 'idevento', name: 'idevento', value: this.idevento},
                {xtype: 'hidden', id: 'idriesgo', name: 'idriesgo', value: this.idriesgo},
                {xtype: 'hidden', id: 'nuevo', name: 'nuevo', value: this.nuevo},
                {                   
                    xtype: 'datefield',
                    fieldLabel: 'Fch. Evento',
                    id: 'fchevento',
                    name: 'fchevento',
                    allowBlank: false,
                    format: "Y-m-d",
                    altFormat: "Y-m-d",
                    maxValue: new Date(),
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    submitFormat: 'Y-m-d'
                },
                {
                    xtype: 'htmleditor',
                    fieldLabel: 'Descripci\u00F3n',
                    id: 'descripcion',
                    name: 'descripcion',
                    anchor: '90%',
                    allowBlank: false
                },
                Ext.create('Ext.form.ComboBox', {
                    fieldLabel: 'Causa',
                    id: 'idcausa',
                    name: 'idcausa',
                    store: Ext.create('Ext.data.Store', {
                            fields: ['valor'],
                            proxy: {
                                type: 'ajax',
                                url: '/riesgos/datosCausas',
                                extraParams:{
                                    idriesgo: this.idriesgo
                                },
                                reader: {
                                    type: 'json',
                                    rootProperty: 'root'
                                }
                             },
                             autoLoad: true
                        }),                    
                    displayField: 'valor',
                    valueField: 'id',                    
                    qtip:'Listado',
                    anchor: '90%',
                    queryMode: 'local',
                    forceSelection: true,                    
                    listConfig: {
                        loadingText: 'buscando...',
                        emptyText: 'No existen registros',
                        getInnerTpl: function() {
                            return '<tpl for="."><div class="search-item1">{valor}</div></tpl>';
                        }
                    }
                }),
                {
                    xtype:'textfield',
                    fieldLabel: 'PA',
                    id:'pa',
                    name:'pa'
                },
                {
                    xtype: 'Colsys.Widgets.WgParametros',
                    caso_uso: 'CU054',
                    fieldLabel: 'Tipo Doc.',                    
                    id:'tipodoc',
                    name:'tipodoc',
                    allowBlank: false
                },
                {
                    xtype: 'textfield',                
                    fieldLabel: 'Documento / Referencia / Otro',
                    id:'documento',
                    name:'documento'
                },
                {
                    xtype: 'Colsys.Widgets.WgClientes',
                    fieldLabel: 'Cliente',                    
                    name: 'idcliente',
                    id: 'idcliente'                  
                },
                {
                    xtype: 'Colsys.Widgets.WgSucursalesEmpresa',
                    fieldLabel: 'Sucursal',
                    name: 'idsucursal',
                    id: 'idsucursal',
                    empresa: 2
                },                
                {
                    xtype: 'timefield',
                    fieldLabel: 'P\u00E9rd. Operativa',
                    id: 'perdida_ope',
                    name: 'perdida_ope',
                    format: 'H:i:s'
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'P\u00E9rd. Legal',
                    id: 'perdida_leg',
                    name: 'perdida_leg'
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'P\u00E9rd. Econ\u00F3mica',
                    id: 'perdida_eco',
                    name: 'perdida_eco'
                },
                {
                    xtype: 'numberfield',
                    fieldLabel: 'P\u00E9rd. Comercial',
                    id: 'perdida_com',
                    name: 'perdida_com'
                })
                
                
            
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'button',
                text: 'Guardar',
                height: 30,
                iconCls: 'disk',
                handler: function () {                    
                    var form = this.up('form');
                    var idriesgo = form.idriesgo;
                    var nuevo = form.nuevo;

                    if (form.isValid()) {                
                        form.submit({                            
                            success: function(form, action) { 
                                if(nuevo){                                                                        
                                    Ext.MessageBox.alert("Mensaje", 'El evento se ha guardado \u00E9xitosamente.<br/><a href="https://www.colsys.com.co/email/verEmail/id/'+action.result.idemail+'" target="_blank">Ver Email</a>');
                                    location.href="/riesgos/indexExt5";
                                }else{
                                    Ext.getCmp('winEvento').close();                                
                                    Ext.MessageBox.alert("Mensaje", 'El evento se ha guardado \u00E9xitosamente.<br/><a href="https://10.192.1.70/email/verEmail/id/'+action.result.idemail+'" target="_blank">Ver Email</a>');
                                    Ext.getCmp('grid-eve'+idriesgo).getStore().reload();                                
                                }
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
                    Ext.getCmp('winEvento').close(); 
                }
            });
            this.addDocked(tb);
        }
    },
    cargar: function(idriesgo, idevento){        
        var me=this;
        me.form.load({
            url:'/riesgos/datosFormEventos',
            waitMsg:'cargando...',
            params:{
                idriesgo: idriesgo,
                idevento: idevento
            },
            success: function (response, options) {
                var res = Ext.JSON.decode(options.response.responseText);
                Ext.getCmp("idcliente").getStore().add({idcliente:res.data.idcliente,compania: res.data.cliente});
                Ext.getCmp("idcliente").setValue(res.data.idcliente);
                
                Ext.getCmp("tipodoc").getStore().add({id:res.data.iddoc,name: res.data.tipodoc});
                Ext.getCmp("tipodoc").setValue(res.data.iddoc);
                
                Ext.getCmp("idevento").setValue(res.data.idevento);
                Ext.getCmp("idsucursal").setValue(res.data.idsucursal);
                
                Ext.getCmp("idcausa").getStore().add({id:res.data.idcausa, valor:res.data.causa});
            },
            failure: function(){
                alert("Los datos no han cargado correctamente!");
            }            
        });
    },
    llenarCampos: function(idriesgo, data){ 
        console.log(data);
        var me=this;
        me.form.load({
            url:'/riesgos/datosFormEventos',
            waitMsg:'cargando...',
            params:{
                idriesgo: idriesgo,
                iddoc: data['iddoc'],
                documento: data['documento'],
                idcliente: data['idcliente'],
                idsucursal: data['idsucursal'],
                nuevo: true                
            },
            success: function (response, options) {
                var res = Ext.JSON.decode(options.response.responseText);
                Ext.getCmp("idcliente").getStore().add({idcliente:res.data.idcliente,compania: res.data.cliente});
                Ext.getCmp("idcliente").setValue(res.data.idcliente);
                
                Ext.getCmp("tipodoc").getStore().add({id:res.data.iddoc,name: res.data.tipodoc});
                Ext.getCmp("tipodoc").setValue(res.data.iddoc);
                
                Ext.getCmp("idevento").setValue(res.data.idevento);
                Ext.getCmp("idsucursal").setValue(res.data.idsucursal);
                
                Ext.getCmp("idcausa").getStore().add({id:res.data.idcausa, valor:res.data.causa});
            },
            failure: function(){
                alert("Los datos no han cargado correctamente!");
            }            
        });
    }
})