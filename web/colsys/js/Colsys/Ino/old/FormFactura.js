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
        
        /*items: [
            
            ],*/
        bbar: [{
            text: 'Guardar',
            handler: function(){
                var form = this.up('form').getForm();                
                idmaster=form.owner.idmaster;                
                if(form.isValid()){
                    form.submit({
                        url: '/inoF/guardarFactura',
                        waitMsg: 'Guardando',
                        success: function(response,options) {
                            var res = Ext.JSON.decode( options.response.responseText );
                            
                            var box = Ext.MessageBox.wait('Procesando', 'Generacion de Factura');                            
                            //Ext.getCmp("grid-facturacion-"+idmaster).getStore().reload();
                            Ext.getCmp('panel-factura-'+idmaster).getStore().reload();
                            box.hide();
                            Ext.getCmp("winFormEdit").hide();
                        }
                    });
                }
            }
        }],        
        onRender: function(ct, position)
        {    
            var me=this;
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
                },
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
                {
                    columnWidth: 0.4,
                    xtype: 'Colsys.Widgets.wgTipoComprobante',
                    id:'idtipocomprobante',
                    name:'idtipocomprobante',
                    fieldLabel: 'Tipo ',                
                    allowBlank:false,
                    listeners:{
                        select : function( combo, records, idx ){
                            var me = this.up();
                            data=records[0].data;
                            me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
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
                            data=records[0].data;
                            //alert(data.toSource());
                            //alert(Ext.getCmp("cliente").getValue())
                            if(data.idsucursal!="" && data.idsucursal!="null")
                            {
                                me.getForm().findField("idsucursal").store.add(
                                    {"compania":data.cliente+"-"+data.ciudad, "idcliente":data.idcliente,"idsucursal":data.idsucursal,"cuentapago":data.cuentapago,"ciudad":data.ciudad}
                                );

                                me.getForm().findField("idsucursal").setValue(data.idsucursal);
                            }
                            me.getForm().findField("cuentapago").setValue(data.cuentapago);
                        }
                    }
                },
                {
                    columnWidth: 0.9,
                    xtype: 'Colsys.Widgets.wgClienteSucursal',
                    fieldLabel: "Cliente",
                    name: "idsucursal",
                    id: "idsucursal",
                    allowBlank: false                
                },
                {    
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