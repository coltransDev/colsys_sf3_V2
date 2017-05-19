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
            //bodyStyle:'padding:30',
            style:"text-align: left",
            labelAlign:'right'
        },
        listeners: {
            afterrender : function (me, eOpts ){
                if(this.ino)
                    Ext.getCmp("idhouse").getStore().reload();
            }
        },
        /*items: [
            
            ],*/
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
                            //console.log(f.ino);                            
                            if(f.ino)
                            {                                
                                //Ext.getCmp("grid-facturacion-"+idmaster).getStore().reload();
                                Ext.getCmp('panel-factura-'+idmaster).getStore().reload();
                                box.hide();
                                Ext.getCmp("winFormEdit").close();
                            }
                            else
                            {
                              
                                //var store = Ext.getCmp("grid-movimientosComprobantes").getStore();
                                console.log(Ext.getCmp('id-grid-comprobante'));
                                Ext.getCmp('id-grid-comprobante').setIdComprobante(res.idcomprobante);
                                Ext.getCmp('btn-guardar0').click();
                                box.hide();
                                //click
                                //setPressed 
                            }
                        }
                    });
                }
            }
            
            
            
        }],        
        onRender: function(ct, position)
        {            
            var me=this;
            console.log(me);
            this.ino=(!this.ino)?false:this.ino;
            
            //alert(this.ino);
            this.add(
                {
                    xtype: 'hidden',
                    id:'idcomprobante',
                    name:'idcomprobante'
                },
                {
                    xtype: 'hidden',
                    id:'cuentapago',
                    name:'cuentapago'
                }
                /*{
                    xtype: 'textfield',
                    id:'_consecutivo',
                    name:'consecutivo',
                    fieldLabel: 'Consecutivo',
                    readOnly:true
                },
                {
                    xtype: 'textfield',
                    id:'_fecha',
                    name:'fecha',
                    fieldLabel: 'Fecha',
                    readOnly:true
                },*/
                
                );
                if(this.ino)
                {
                    this.add(
                    {
                        columnWidth:1/2.7,
                        xtype: 'Colsys.Widgets.wgTipoComprobante',
                        id:'idtipocomprobante',
                        name:'idtipocomprobante',
                        fieldLabel: 'Tipo ',                
                        labelWidth: 50,
                        allowBlank:false                        
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
                                //alert(data.toSource());
                                //alert(Ext.getCmp("cliente").getValue())
                                if(data.idsucursal!="" && data.idsucursal!="null")
                                {
                                    me.getForm().findField("idsucursal").store.add(
                                        {"compania":data.cliente+"-"+data.ciudad, "idcliente":data.idcliente,"idsucursal":data.idsucursal,"cuentapago":data.cuentapago,"ciudad":data.ciudad}
                                    );
                                    me.getForm().findField("idsucursal").setValue(data.idsucursal);

                                    me.getForm().findField("bienestrans").setValue(data.mercancia_desc);

                                }
                                me.getForm().findField("cuentapago").setValue(data.cuentapago);
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
                            columnWidth:1/3.9,
                            fieldLabel: 'Empresa',
                            //labelWidth: 60,
                            name: 'empresa',
                            id: 'idempresa',
                            //width: 220,
                            allowBlank: false,
                            listeners:{
                                select : function( combo, records, idx ){                            
                                    var me = this.up();
                                    //console.log(records.data);
                                    data=records.data;
                                    me.getForm().findField('idtipocomprobante').getStore().reload({params:{idempresa:data.id}});
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
                            listeners:{
                                select : function( combo, records, idx ){                            
                                    var me = this.up();
                                    data=records.data;
                                    //console.log(data);
                                    //Ext.getCmp('id-grid-comprobante').setIdSucursal(data.idsucursal);
                                    me.getForm().findField('idcc').getStore().reload({params:{"idsucursal":data.idsucursal  }});
                                    //me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
                                }
                            }
                        },
                        {
                            xtype: 'Colsys.Widgets.WgCentrocostos',
                            columnWidth:1/2.7,
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
                                    Ext.getCmp('id-grid-comprobante').setIdCc(data.id);
                                    
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
                    /*listeners:{
                                select : function( combo, records, idx ){
                                    data=records.data;                                    
                                    //me.getForm().findField('idcontacto').getStore().reload({params:{idcliente:data.idcliente}});
                                }
                            }*/
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
                    allowBlank:false
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
                            {"compania":data.cliente+"-"+data.ciudad, "idcliente":data.idcliente,"idsucursal":data.idsucursal,"cuentapago":data.cuentapago,"ciudad":data.ciudad}
                        );

                        me.getForm().findField("idsucursal").setValue(data.idsucursal);
                    }
                }                    
            });
        }
})
