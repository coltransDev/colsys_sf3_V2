var idtransporte = null;
Ext.define('Colsys.Contabilidad.FormFacturaPr', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Contabilidad.FormFacturaPr',    
    listeners: {
        render: function (me, eOpts) {
            this.add({
                xtype: 'fieldset',
                id: 'fieldset-form-' + this.panel,                
                border: false,
                layout: {
                    type: 'table',
                    columns: 2,                    
                    tableAttrs: {
                        style: {
                            width: '100%'
                        }
                    }
                },
                defaults: {
                    width: '90%'
                },
                items: [
                    {
                        xtype: 'hidden',
                        id:'idcomprobante',
                        name:'idcomprobante'
                    },
                    {
                        xtype: 'Colsys.Widgets.wgEmpresas',
                        fieldLabel: 'Empresa',
                        //forceSelection: true,
                        id: 'idempresa',
                        name: 'idempresa',                        
                        allowBlank: false,
                        listeners: {
                            render: function (ct, position) {
                                this.store.reload();
                                this.superclass.onRender.call(this, ct, position);
                            },
                            select: function (combo, records, eOpts) {
                                var idpanel = combo.up().up("panel").idpanel; 
                                
                                var idempresa = combo.getValue();
                                
                                var me = this.up("form");                                
                                me.getForm().findField('idtipocomprobante').getStore().reload({params:{idempresa:idempresa, tipo: 'P,D', app: 1}});
                                me.getForm().findField('idcc').getStore().reload({params:{idempresa:idempresa}});
                                
                                Ext.getCmp("idsucursal").idempresa = idempresa;
                            }
                        }
                    },
                    {
                        xtype: 'Colsys.Widgets.wgTipoComprobante',
                        fieldLabel: 'Tipo Comprobante',
                        id: 'idtipocomprobante',
                        name: 'idtipocomprobante',
                        tipo: 'P,D',
                        aplicacion: 1,
                        allowBlank: false,
                        listeners: {                            
                            select: function (combo, records, eOpts) {
                                var me = this.up("form");
                                if(records.data.tipo=="D")
                                {
                                    me.getForm().findField('collect').setHidden(false);
                                }
                                else
                                {
                                    me.getForm().findField('collect').setHidden(true);
                                }
                                me.updateLayout();
                            }
                        }
                    },
                    {
                        xtype: 'Colsys.Widgets.WgCentrocostos',                        
                        fieldLabel: 'Centro de Costos',
                        name: 'cc',
                        id: 'idcc',
                        labelWidth: 100,
                        allowBlank: false,
                        listeners:{
                            select : function( combo, records, idx ){                            
                               

                            }
                        }
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Fch. Factura',
                        id: 'fecha',
                        name: 'fecha',
                        allowBlank: false,
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d'
                    },
                    {
                        xtype: 'textfield',
                        fieldLabel: '# Factura',
                        id: 'consecutivo',
                        name: 'consecutivo'
                    },
                    {
                        xtype: 'Colsys.Widgets.WgProveedorSucursal',
                        fieldLabel: 'Proveedor',
                        forceSelection: true,
                        id: 'idsucursal',
                        name: 'idsucursal',
                        idtransporte: idtransporte,
                        listeners: {
                            select: function (combo, records, eOpts) {                                        
                                var idalterno = records.data.idalterno;
                                if(!idalterno){
                                    combo.clearValue();
                                    Ext.Msg.alert('Error', "Este proveedor no puede ser seleccionado ya que no tiene Identificación Tributaria registrada en el sistema. Favor validar con contabilidad");                                            
                                }
                            }
                        }
                    },
                    {
                        xtype: 'numberfield',
                        id: 'tcambio',
                        name: 'tcambio',
                        fieldLabel: 'Tasa de Cambio',
                        minValue: 1
                    },
                    {
                        //columnWidth: 0.5,
                        xtype: 'Colsys.Widgets.wgMoneda',
                        id: 'idmoneda',
                        name: 'idmoneda',
                        fieldLabel: 'Moneda',
                        labelWidth: 100,
                        queryMode: 'local',
                        displayField: 'name',
                        valueField: 'id',
                        allowBlank: false,
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
                        xtype: 'checkbox',
                        fieldLabel: 'Collect?',
                        id:'collect',
                        name:'collect',
                        hidden:true,
                        autoEl: {
                            tag: 'div',
                            'data-qtip': 'NC Coltrans USA'
                        }
                        //tooltip:'NC Coltrans USA'
                        //columnWidth: 1,
                        //labelWidth:320,
                        //labelAlign : 'right'
                    }
                
                    
                ]
            });
        }
    },
    bbar: [{
        text: 'Guardar Cabecera',
        handler: function(){

            var form = this.up('form');
            var idpanel = form.idpanel;                        
                        
            Ext.getCmp("idsucursal").allowBlank = false;
            if (form.isValid()) {
                form.submit({
                    url: '/contabilidad/guardarFormFacturaPr',
                    waitMsg: 'Guardando...',
                    success: function (response, options) {
                        var res = Ext.JSON.decode(options.response.responseText);                        
                        
                        Ext.MessageBox.alert("Mensaje", 'Cabecera Guardada Correctamente. Idcomprobante=>'+ res.idcomprobante);
                        Ext.getCmp('panel-factura-pr'+idpanel).getStore().reload();                        
                        Ext.getCmp("win-factura-cabecera"+idpanel).close();
                    },
                    failure: function (form, action) {
                        Ext.MessageBox.alert("Error", action.result.errorInfo + " Idcomprobante:" + action.result.idcomprobante);
                    }
                });
            } else {
                Ext.Msg.alert('Incompleto', "Por favor verifique que la informaci\u00F3n de detalle del comprobante est\u00E1 completa");
            }
        }   
    }],
    cargar: function(idcomprobante){
        var me = this;
        me.form.load({
            url:'/inoF2/datosFormFactura',            
            params:{"idcomprobante":idcomprobante},
            success: function(response,options) {
                var res = Ext.JSON.decode( options.response.responseText );

                data=res.data;
                //me.getForm().findField("idempresa").setIdempresa(data.idempresa);
                me.getForm().findField('idempresa').getStore().reload({params:{id:data.idempresa}});
                //me.getForm().findField("idempresa").setValue(data.idempresa);
                
                me.getForm().findField('idtipocomprobante').getStore().reload({params:{idempresa:data.idempresa}});
                me.getForm().findField('idcc').getStore().reload({params:{"idempresa":data.idempresa  }});
                    
                me.getForm().findField("idsucursal").store.add(
                    {"compania":data.cliente+"-"+data.ciudad, "idcliente":data.idcliente,"idsucursal":data.idsucursal,"ciudad":data.ciudad}
                );

                me.getForm().findField("idsucursal").setValue(data.idsucursal);
                me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
                
                me.getForm().findField('idtipocomprobante').readOnly = true;
                
                if(data.tipocomprobante=="D")
                {
                    me.getForm().findField('collect').setHidden(false);
                    me.updateLayout();
                }
                
                //me.updateLayout();
                
            }                    
        });
    }
});