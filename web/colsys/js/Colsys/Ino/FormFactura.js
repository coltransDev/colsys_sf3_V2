Ext.define('Colsys.Ino.FormFactura', {
        extend: 'Ext.form.Panel',
        alias: 'widget.Colsys.Ino.FormFactura',
  //      title: 'Factura',
        //bodyPadding: 5,
        anchor: '90%',
        layout:'column',
        autoHeight: true,
        //autoScroll: true,
        defaults:{
            columnWidth: 1/2.1,
            style:"text-align: left",
            labelAlign:'right'
        },
        listeners: {
            afterrender : function (me, eOpts ){
                if(this.ino)
                    Ext.getCmp("idhouse").getStore().reload();
            }
        },
        bbar: [{
            text: 'Guardar',
            handler: function(){
               
                var f=this.up('form');
                var form = f.getForm();                
                idmaster=form.owner.idmaster;
                if(form.isValid()){
                    form.submit({
                        url: '/inoF2/guardarFactura',
                        waitMsg: 'Guardando',
                        success: function(response,options) {
                            var res = Ext.JSON.decode( options.response.responseText );
                            
                            var box = Ext.MessageBox.wait('Procesando', 'Generacion de Factura');          
                            //if(f.ino)
                            {
                                Ext.getCmp('panel-factura-'+idmaster).getStore().reload();
                                box.hide();
                                Ext.getCmp("winFormEdit").close();
                            }
                        }
                    });
                }
            }
        }],        
        onRender: function(ct, position)
        {            
            var me=this;
            this.ino=(!this.ino)?false:this.ino;
            this.add(
                {
                    xtype: 'hidden',
                    id:'idcomprobante',
                    name:'idcomprobante'
                },                
                );
                if(this.ino)
                {
                    //console.log(me.permisos)
                    this.add(
                            {
                            xtype: 'Colsys.Widgets.wgEmpresas',
                            columnWidth:1/3.1,
                            fieldLabel: 'Empresa',
                            //labelWidth: 60,
                            name: 'idempresa',
                            id: 'idempresa',
                            //width: 220,
                            allowBlank: false,
                            listeners:{
                                render: function(ct, position){                                    
                                    this.store.reload();
                                    this.superclass.onRender.call(this, ct, position);
                                },
                                select : function( combo, records, idx ){                            
                                    var me = this.up();
                                    //console.log(records.data);
                                    data=records.data;
                                    
                                    tipo="F";
                                    if(me.notacredito)
                                        tipo+=",C";
                                    me.getForm().findField('idtipocomprobante').getStore().reload({params:{"idmaster":idmaster,"idempresa":data.id,"tipo":tipo,"puerto":Ext.getCmp("iddestino" + idmaster)?Ext.getCmp("iddestino" + idmaster).getValue():null}});
                                    /*me.getForm().findField('idsucursal').setIdempresa(data.id);
                                    if(Ext.getCmp("combo-conceptos"+me.idmaster))
                                        Ext.getCmp("combo-conceptos"+me.idmaster).setIdempresa(data.id);
                                    me.getForm().findField('idcc').getStore().reload({params:{"idempresa":data.id  }});*/
                                
                                   //me.getForm().findField('idsucursalempresa').getStore().reload({params:{empresa:data.id}});
                                }
                            }
                        },
                    {
                        columnWidth:1/2.7,
                        xtype: 'Colsys.Widgets.wgTipoComprobante',
                        id:'idtipocomprobante',
                        name:'idtipocomprobante',
                        fieldLabel: 'Tipo ',                
                        labelWidth: 50,
                        allowBlank:false,
                        idmaster:me.idmaster,
                        impoexpo:me.idimpoexpo,
                        notacredito:me.notacredito,
                        listeners:{
                            select : function( combo, records, idx ){                            
                                var me = this.up();                                
                                data=records.data;
                                me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
                                console.log(data.detalle);
                                me.getForm().findField("detalle").setValue(data.detalle);
                            }
                        }
                    },
                    {
                        columnWidth: 0.5,
                        xtype: 'Colsys.Widgets.wgHouse',
                        id:'idhouse',
                        name:'idhouse',
                        fieldLabel: 'House',
                        queryMode: 'local',
                        displayField: 'name',
                        idmaster: this.idmaster,
                        valueField: 'id',                
                        allowBlank:false,
                        width: 400,
                        listeners:{
                            select : function( combo, records, idx ){   
                                var me = this.up();
                                data=records.data;
                                if(data.idsucursal!="" && data.idsucursal!="null")
                                {
                                    me.getForm().findField("idsucursal").store.add(
                                        {"compania":data.cliente+"-"+data.ciudad, "idcliente":data.idcliente,"idsucursal":data.idsucursal,"ciudad":data.ciudad}
                                    );

                                    me.getForm().findField("idsucursal").setValue(data.idsucursal);

                                    if(me.ino)
                                    {
                                        if(me.getForm().findField('idanticipo'))
                                        {
                                            me.getForm().findField('idanticipo').setIdcliente(data.idcliente);
                                            me.getForm().findField('idanticipo').store.reload();
                                        }
                                    }
                                    me.getForm().findField("bienestrans").setValue(data.mercancia_desc);
                                }
                            }
                        }
                    }
                    );
                }
                else
                {
                    this.add(
                        {
                            xtype: 'Colsys.Widgets.wgEmpresas',
                            columnWidth:1/3.1,
                            fieldLabel: 'Empresa',
                            //labelWidth: 60,
                            name: 'idempresa',
                            id: 'idempresa',
                            //width: 220,
                            allowBlank: false,
                            listeners:{
                                render: function(ct, position){                                    
                                    this.store.reload();
                                    this.superclass.onRender.call(this, ct, position);
                                },
                                select : function( combo, records, idx ){                            
                                    var me = this.up();
                                    //console.log(records.data);
                                    data=records.data;
                                    me.getForm().findField('idtipocomprobante').getStore().reload({params:{idempresa:data.id}});
                                    me.getForm().findField('idsucursal').setIdempresa(data.id);
                                    if(Ext.getCmp("combo-conceptos"+me.idmaster))
                                        Ext.getCmp("combo-conceptos"+me.idmaster).setIdempresa(data.id);
                                    me.getForm().findField('idcc').getStore().reload({params:{"idempresa":data.id  }});
                                
                                   //me.getForm().findField('idsucursalempresa').getStore().reload({params:{empresa:data.id}});
                                }
                            }
                        },

                        {
                            columnWidth:1/3.1,
                            xtype: 'Colsys.Widgets.wgTipoComprobante',
                            id:'idtipocomprobante',
                            name:'idtipocomprobante',
                            fieldLabel: 'Tipo ',                
                            labelWidth: 50,
                            allowBlank:false,
                            load1:true,
                            listeners:{
                                select : function( combo, records, idx ){                            
                                    var me = this.up();
                                    data=records.data;
                                    //console.log(data);
                                    //Ext.getCmp('id-grid-comprobante').setIdSucursal(data.idsucursal);
                                    
                                    //me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
                                }
                            }
                        },
                        {
                            xtype: 'Colsys.Widgets.WgCentrocostos',
                            columnWidth:1/3.1,
                            fieldLabel: 'Centro de Costos',
                            name: 'cc',
                            id: 'idcc',
                            //width: 220,
                            allowBlank: false,
                            listeners:{
                                select : function( combo, records, idx ){                            
                                    //var me = this.up();
                                    //console.log(records.data);
                                    data=records.data;                            
                                    //Ext.getCmp('id-grid-comprobante').setIdSucursalgetStore().reload({params:{empresa:data.id}});
                                    //console.log(Ext.getCmp('id-grid-comprobante'));
                                    //Ext.getCmp('id-grid-comprobante').setIdCc(data.id);
                                    
                                    //Ext.getCmp('conceptosfac').setIdCc(data.id);
                                    
                                }
                            }
                        }
                    );
                }
        
                this.add(
                {
                    columnWidth: 0.9,
                    xtype: 'Colsys.Widgets.wgClienteSucursal',
                    fieldLabel: "Cliente",
                    name: "idsucursal",
                    id: "idsucursal",
                    allowBlank: false,
                    listeners:{
                                select : function( combo, records, idx ){
                                    data=records.data;                                    
                                    
                                    //if(Ext.getCmp('idanticipo'))
                                    if(me.ino)
                                    {
                                        me.getForm().findField('idanticipo').setIdcliente(data.idcliente);                    
                                        me.getForm().findField('idanticipo').store.reload();
                                    }
                                    //me.getForm().findField('idcontacto').getStore().reload({params:{idcliente:data.idcliente}});
                                }
                            }
                },
                {
                    columnWidth: 0.9,
                    xtype: 'textfield',
                    fieldLabel: "Contacto",
                    name: "idcontacto",
                    id: "idcontacto",
                    allowBlank: true
                }
                /*{
                        columnWidth: 0.9,
                        xtype: 'Colsys.Widgets.WgContactos',
                        fieldLabel: "Contacto",
                        name: "idcontacto",
                        id: "idcontacto",
                        allowBlank: true                
                    }*/);
                
                /*if(!this.ino)
                {
                    this.add(
                    {
                        columnWidth: 0.9,
                        xtype: 'Colsys.Widgets.WgContactos',
                        fieldLabel: "Contacto",
                        name: "idcontacto",
                        id: "idcontacto",
                        allowBlank: false                
                    });
                }*/
        
                this.add({    
                    columnWidth: 0.4,
                    xtype: 'numberfield',
                    fieldLabel: 'Tasa de Cambio',
                    id:'tcambio',
                    name:'tcambio'
                },
                {
                    columnWidth: 0.5,
                    xtype: 'Colsys.Widgets.wgMoneda',
                    id:'idmoneda',
                    name:'idmoneda',
                    fieldLabel: 'Moneda',
                    queryMode: 'local',
                    displayField: 'name',
                    valueField: 'id',
                    allowBlank:false,
                    listeners: {
                        afterrender: function (t, eOpts) {
                            var store = t.store;
                            store.clearFilter();
                            store.filterBy(function (record, id) {
                                if (record.data.sugerido)
                                    return true;
                                else
                                    return false;
                            });
                        }
                    }
                },
                {
                    columnWidth: 0.9,
                    xtype: 'textareafield',
                    fieldLabel: 'Bienes Trans',
                    id:'bienestrans',
                    name:'bienestrans'
                },
                {
                    columnWidth: 0.9,
                    xtype: 'textareafield',
                    fieldLabel: 'Detalle',
                    id:'detalle',
                    name:'detalle'
                },
                {
                    columnWidth: 0.9,
                    xtype: 'textareafield',
                    fieldLabel: 'Anexos',
                    id:'anexos',
                    name:'anexos'
                }
                );
                if(this.ino)
                {
                    this.add({
                        columnWidth: 0.5,
                        xtype: 'Colsys.Widgets.wgAnticipo',
                        id:'idanticipo',
                        name:'idanticipo[]',
                        fieldLabel: 'Anticipo',
                        queryMode: 'local',
                        displayField: 'name',
                        idmaster: this.idmaster,
                        idcomprobante: this.idcomprobante,
                        valueField: 'id',                    
                        width: 400
                    });
                }
            this.superclass.onRender.call(this, ct, position);
        },
        cargar: function(idcomprobante)
        {   var me=this;
            me.form.load({
                url:'/inoF2/datosFormFactura',
                //waitMsg:'cargando...',
                params:{"idcomprobante":idcomprobante},
                success: function(response,options) {
                    var res = Ext.JSON.decode( options.response.responseText );

                    data=res.data;                    
                    if(data.idsucursal!="" && data.idsucursal!="null")
                    {    
                        me.getForm().findField("idsucursal").store.add(
                            {"compania":data.cliente+"-"+data.ciudad, "idcliente":data.idcliente,"idsucursal":data.idsucursal,"ciudad":data.ciudad}
                        );

                        me.getForm().findField("idsucursal").setValue(data.idsucursal);
                        me.getForm().findField('idsucursal').setIdempresa(data.idempresa);                    
                    }
                    
                    
                    //if(data.id!="" && data.id!="null")
                    if(me.getForm().findField('idanticipo'))
                    {
                        me.getForm().findField('idanticipo').setIdcliente(data.idcliente);
                        me.getForm().findField('idanticipo').store.reload();
                    }
                    
                    if(!me.ino)
                    {
                        me.getForm().findField('idtipocomprobante').getStore().reload({params:{idempresa:data.idempresa}});
                        
                        me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
                        /*if(Ext.getCmp("combo-conceptos"+me.idmaster))
                            Ext.getCmp("combo-conceptos"+me.idmaster).setIdempresa(data.idempresa);*/
                        me.getForm().findField('idcc').getStore().reload({params:{"idempresa":data.idempresa  }});
                        //me.getForm().findField("idtipocomprobante").setValue(data.idtipocomprobante);
                        
                    }
                    
                    //alert("cargado");
                    
                    
                    //console.log(data);
                    /*if(data.idanticipo!="" && data.idanticipo!="null")
                    {    
                        //console.log("337");
                        me.getForm().findField("idanticipo").store.add(
                            {"id":data.idanticipo, "name":data.anticipo}
                        );
                        me.getForm().findField("idanticipo").setValue(data.idanticipo);
                    }*/
                    
                }                    
            });
        }
})
