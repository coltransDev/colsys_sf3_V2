Ext.define('Colsys.Ino.FormFactura', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormFactura',
    //      title: 'Factura',
    //bodyPadding: 5,
    anchor: '90%',
    layout: 'column',
    autoHeight: true,
    //autoScroll: true,
    defaults: {
        //columnWidth: 1 / 2.1,
        style: "text-align: left",
        labelAlign: 'right',
        bodyStyle: 'border-spacing: 1px',
        
    },
    //plugins = [{ptype : 'datatip'}],
    listeners: {
        afterrender: function (me, eOpts) {
            /*if (this.ino)
                Ext.getCmp("idhouse").getStore().reload();*/
            
        }
    },
    bbar: [{
            text: 'Guardar',
            handler: function () {
                var f = this.up('form');
                var form = f.getForm();
                idmaster = form.owner.idmaster;
                if (form.isValid()) {
                    form.submit({
                        url: '/inoF2/guardarFactura',
                        waitMsg: 'Guardando',
                        success: function (response, options) {
                            var res = Ext.JSON.decode(options.response.responseText);

                            var box = Ext.MessageBox.wait('Procesando', 'Generacion de Factura');
                            //if(f.ino)
                            {
                                if(Ext.getCmp('panel-factura-' + idmaster))
                                    Ext.getCmp('panel-factura-' + idmaster).getStore().reload();
                                box.hide();
                                Ext.getCmp("winFormEdit").close();
                            }
                        }
                    });
                }
            }
        }],
    onRender: function (ct, position)
    {
        var me = this;
        //console.log(me)
        this.ino = (!this.ino) ? false : this.ino;
        var items = new Array();
        items.push({
            xtype: 'hidden',
            id: 'idcomprobante',
            name: 'idcomprobante'
        },{
            xtype: 'hidden',
            id: 'baseentry',
            name: 'baseentry'
        });
        if (this.ino)
        {
            items.push(            
            {
                xtype: 'Colsys.Widgets.wgEmpresas',
                columnWidth: 1 / 3.1,
                fieldLabel: 'Empresa',
                name: 'idempresa',
                id: 'idempresa',
                //width: 220,
                allowBlank: false,
                listeners: {
                    render: function (ct, position) {
                        this.store.reload();
                        this.superclass.onRender.call(this, ct, position);
                    },
                    select: function (combo, records, idx) {
                        var me = this.up();
                        //console.log(records.data);
                        data = records.data;
                        
                        //console.log(me)
                        
                        tipo = "F";
                        if(me.baseentry)
                            tipo = "C";
                        if (me.notacredito)
                            tipo += ",C";
                        me.getForm().findField('idtipocomprobante').getStore().reload({params: {"idmaster": idmaster, "idempresa": data.id, "tipo": tipo, "puerto": Ext.getCmp("iddestino" + idmaster) ? Ext.getCmp("iddestino" + idmaster).getValue() : null}});
                        
                        
                        if (Ext.getCmp("txttrm"))
                        {
                            if(data.id!="2" )
                            {
                                Ext.getCmp("txttrm").setDisabled(true);
                                Ext.getCmp("txttrm").setVisible(false);
                            }
                            else if((me.impoexpo=="Importaci\u00F3n" && me.transporte=="Mar\u00EDtimo") || (me.ino==false))                            
                            {
                                Ext.getCmp("txttrm").setDisabled(false);
                                Ext.getCmp("txttrm").setVisible(true);
                            }
                        }
                        
                        if (me.ino)
                        {
                            //me.getForm().findField('idhouse').setIdempresa(data.idempresa);
                            Ext.getCmp("idhouse").getStore().reload({params: {"idmaster": idmaster, "idempresa": data.id }});
                        }
                        
/*                        if (Ext.getCmp("txttrm" ))
                        {
                            Ext.getCmp("txttrm" ).setValue('Para embarques Mar&iacute;timos, la factura debe ser liquidada a la TRM del día de pago mas $30 siempre y cuando esta nos sea inferior a la tasa de emisión de esta factura. También puede consultar la tasa de cambio para pago de sus facturas, llamando a nuestro PBX 4239300 Opción 1.');
                        }*/
                    }
                }
            },
            {
                columnWidth: 1 / 2.7,
                xtype: 'Colsys.Widgets.wgTipoComprobante',
                id: 'idtipocomprobante',
                name: 'idtipocomprobante',
                fieldLabel: 'Tipo ',
                labelWidth: 50,
                allowBlank: false,
                idmaster: me.idmaster,
                impoexpo: me.idimpoexpo,
                notacredito: me.notacredito,
                baseentry: me.baseentry,
                listeners: {
                    select: function (combo, records, idx) {
                        var me = this.up();
                        data = records.data;
                        me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
                        
                        
                        //console.log(data.detalle);
                        me.getForm().findField("detalle").setValue(data.detalle);
                    }
                }
            },
            {
                columnWidth: 0.5,
                xtype: 'Colsys.Widgets.wgHouse',
                id: 'idhouse',
                name: 'idhouse',
                fieldLabel: 'House',
                queryMode: 'local',
                displayField: 'name',
                idmaster: this.idmaster,
                valueField: 'id',
                allowBlank: false,
                width: 400,
                listeners: {
                    select: function (combo, records, idx) {
                        var me = this.up();
                        data = records.data;
                        if (data.idsucursal != "" && data.idsucursal != "null")
                        {
                            me.getForm().findField("idsucursal").store.add(
                                    {"compania": data.cliente + "-" + data.ciudad, "idcliente": data.idcliente, "idsucursal": data.idsucursal, "ciudad": data.ciudad}
                            );

                            me.getForm().findField("idsucursal").setValue(data.idsucursal);
                            me.getForm().findField('plazo').setValue(data.plazo);
                            me.getForm().findField('plazo').setMaxValue(data.plazo);
                            

                            if (me.ino)
                            {
                                if (me.getForm().findField('idanticipo'))
                                {
                                    me.getForm().findField('idanticipo').setIdcliente(data.idcliente);
                                    me.getForm().findField('idanticipo').store.reload();
                                }
                            }
                            me.getForm().findField("bienestrans").setValue(data.mercancia_desc);
                        }
                        
                        
                        if (Ext.getCmp("txttrm" ))
                            Ext.getCmp("txttrm" ).setValue(data.txttrm);
                    }
                }
            });
        } else
        {
            items.push(
                {
                    xtype: 'Colsys.Widgets.wgEmpresas',
                    columnWidth: 1 / 2.5,
                    fieldLabel: 'Empresa',
                    //labelWidth: 60,
                    name: 'idempresa',
                    id: 'idempresa',
                    //width: 220,
                    allowBlank: false,
                    listeners: {
                        render: function (ct, position) {
                            this.store.reload();
                            this.superclass.onRender.call(this, ct, position);
                        },
                        select: function (combo, records, idx) {
                            var me = this.up();
                            //console.log(records.data);
                            data = records.data;
                            me.getForm().findField('idtipocomprobante').getStore().reload({params: {idempresa: data.id}});
                            me.getForm().findField('idsucursal').setIdempresa(data.id);
                            if (Ext.getCmp("combo-conceptos" + me.idmaster))
                                Ext.getCmp("combo-conceptos" + me.idmaster).setIdempresa(data.id);
                            
                            me.getForm().findField('idcc').getStore().reload({params: {"idempresa": data.id}});
                        }
                    }
                },
                {
                    columnWidth: 1 / 2.5,
                    xtype: 'Colsys.Widgets.wgTipoComprobante',
                    id: 'idtipocomprobante',
                    name: 'idtipocomprobante',
                    fieldLabel: 'Tipo ',                    
                    allowBlank: false,
                    load1: true,
                    listeners: {
                        select: function (combo, records, idx) {
                            var me = this.up();
                            data = records.data;
                        }
                    }
                },
                {
                    xtype: 'Colsys.Widgets.WgCentrocostos',
                    columnWidth: 1 / 2.5,
                    fieldLabel: 'Centro de Costos',
                    name: 'cc',
                    id: 'idcc',
                    labelWidth: 100,                    
                    allowBlank: false,
                    listeners: {
                        select: function (combo, records, idx) {
                            data = records.data;
                        }
                    }
                },
                {
                    columnWidth: 1 / 2.5,                     
                    xtype: 'textfield',
                    fieldLabel: "Referencia",
                    name: "referencia",
                    id: "referencia",
                    allowBlank: true
                }
            );
        }

        items.push(
                {
                    columnWidth: 0.9,
                    xtype: 'Colsys.Widgets.wgClienteSucursal',
                    fieldLabel: "Cliente",
                    name: "idsucursal",
                    id: "idsucursal",
                    allowBlank: false,
                    listeners: {
                        select: function (combo, records, idx) {
                            data = records.data;
                            if (me.ino)
                            {
                                me.getForm().findField('idanticipo').setIdcliente(data.idcliente);
                                me.getForm().findField('idanticipo').store.reload();                                
                                me.getForm().findField('plazo').setValue(data.plazo);
                                me.getForm().findField('plazo').setMaxValue(data.plazo);
                                
                            }
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
        );

       

        items.push({
            columnWidth: 0.4,
            xtype: 'numberfield',
            fieldLabel: 'Tasa de Cambio',
            id: 'tcambio',
            name: 'tcambio'
            },
            {
                columnWidth: 0.5,
                xtype: 'Colsys.Widgets.wgMoneda',
                id: 'idmoneda',
                name: 'idmoneda',
                fieldLabel: 'Moneda',
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
                columnWidth: 0.9,
                xtype: 'textfield',
                fieldLabel: 'Bienes Trans',
                id: 'bienestrans',
                name: 'bienestrans',                
                maxLength: '65'                
            },
            {
                columnWidth: 0.9,
                xtype: 'textareafield',
                fieldLabel: 'Detalle',
                id: 'detalle',
                name: 'detalle'
            },
            {
                columnWidth: 0.9,
                
                xtype: 'textareafield',
                height:'10',
                fieldLabel: 'Anexos',
                id: 'anexos',
                name: 'anexos'
                
            },
            
        );

        //if( (me.transporte=="A\u00E9reo" &&  me.impoexpo=="Exportaci\u00F3n") || (me.transporte=="A\u00E9reo" &&  me.impoexpo=="Importaci\u00F3n") ||  (me.transporte=="Mar\u00EDtimo" &&  me.impoexpo=="Exportaci\u00F3n") )
        //console.log(me.transporte);
        //console.log(me.impoexpo);
        //console.log(this.ino);
        if( ( (me.impoexpo=="Importaci\u00F3n" && me.transporte=="Mar\u00EDtimo") || (me.impoexpo=="OTM-DTA" && me.transporte=="Terrestre") )|| this.ino==false )
        {
            

            items.push({
                columnWidth: 0.9,
                xtype: 'textareafield',
                fieldLabel: 'Texto Trm',
                id: 'txttrm',
                name: 'txttrm',
                //value:unescape('Para embarques Mar&iacute;timos, la factura debe ser liquidada a la TRM del día de pago mas $30 siempre y cuando esta nos sea inferior a la tasa de emisión de esta factura. También puede consultar la tasa de cambio para pago de sus facturas, llamando a nuestro PBX 4239300 Opción 1.')
            });
        }

        if (this.ino)
        {
            items.push({
                columnWidth: 0.3,
                xtype: 'Colsys.Widgets.wgAnticipo',
                id: 'idanticipo',
                name: 'idanticipo[]',
                fieldLabel: 'Anticipo',
                queryMode: 'local',
                displayField: 'name',
                idmaster: this.idmaster,
                idcomprobante: this.idcomprobante,
                valueField: 'id',
                width: 200
            },
            {
                columnWidth: 0.6,
                xtype: 'Colsys.Widgets.WgExclusionesIdg',
                id: 'idexclusion',
                name: 'idexclusion',
                fieldLabel: 'Exclusiones Idg',
                width: 400,
                impoexpo: me.impoexpo,
                transporte: me.transporte
            },
            {
                columnWidth: 0.3,
                xtype: 'numberfield',
                id: 'plazo',
                name: 'plazo',
                fieldLabel: 'Dias de credito',
                minValue: 0,
                tooltip:"Si es diferente a los dias parametrizados del cliente"
            }
            );
        }
        else
        {
            items.push(
                {
                    columnWidth: 0.27,
                    xtype: 'numberfield',
                    fieldLabel: 'Piezas',
                    id: 'piezas',
                    name: 'piezas'
                },
                {
                    columnWidth: 0.27,
                    xtype: 'numberfield',
                    fieldLabel: 'Peso',
                    id: 'peso',
                    name: 'peso'
                },
                {
                    columnWidth: 0.27,
                    xtype: 'numberfield',
                    fieldLabel: 'Volumen',
                    id: 'volumen',
                    name: 'volumen'
                },
                {
                columnWidth: 0.4,
                xtype: 'textfield',
                fieldLabel: 'Doc transporte',
                id: 'doctransporte',
                name: 'doctransporte'
                },
                {
                    columnWidth: 0.5,
                    xtype: 'textfield',
                    fieldLabel: 'Trayecto',
                    id: 'trayecto',
                    name: 'trayecto'
                }
            );
            
        }
        
        /*this.add(
        {
            xtype: 'fieldset',
            title: 'Informaci&oacute;n General de la Factura',
            id: 'informacionfactura' + this.idmaster,
            name: 'informacionfactura' + this.idmaster,
            autoHeight: true,            
            
            layout: 'column',
            defaults: {                
                columnWidth: 1 / 2.1,
                style: "text-align: left",
                labelAlign: 'right',
                bodyStyle: 'padding:4px'
            },
            items: items
        });*/
        this.add(items);
        this.superclass.onRender.call(this, ct, position);
    },
    cargar: function (idcomprobante,docentry=null)
    {
        var me = this;
        me.form.load({
            url: '/inoF2/datosFormFactura',            
            params: {"idcomprobante": idcomprobante},
            success: function (response, options) {
                var res = Ext.JSON.decode(options.response.responseText);

                data = res.data;
                if (data.idsucursal != "" && data.idsucursal != "null")
                {
                    me.getForm().findField("idsucursal").store.add(
                            {"compania": data.cliente + "-" + data.ciudad, "idcliente": data.idcliente, "idsucursal": data.idsucursal, "ciudad": data.ciudad}
                    );

                    me.getForm().findField("idsucursal").setValue(data.idsucursal);
                    me.getForm().findField('idsucursal').setIdempresa(data.idempresa);
                }
                
                if (Ext.getCmp("txttrm"))
                {
                    if(data.idempresa=="8" && (me.impoexpo=="OTM-DTA" && me.transporte=="Terrestre"))
                        Ext.getCmp("txttrm").disabled=true;
                }
                
                

                if (me.getForm().findField('idanticipo'))
                {
                    me.getForm().findField('idanticipo').setIdcliente(data.idcliente);
                    me.getForm().findField('idanticipo').store.reload();
                }
                
                if (me.getForm().findField('idexclusion')){
                    me.getForm().findField('idexclusion').getStore().reload({params: {id: data.idexclusion}});
                }

                if (!me.ino )
                {
                    me.getForm().findField('idtipocomprobante').getStore().reload({params: {idempresa: data.idempresa}});

                    me.getForm().findField('idsucursal').setIdempresa(data.idempresa);                    
                    me.getForm().findField('idcc').getStore().reload({params: {"idempresa": data.idempresa}});
                }
                else
                {
                    Ext.getCmp("idhouse").getStore().reload({params: {"idmaster": me.idmaster, "idempresa": data.idempresa }});
                }
                if(docentry!=null && docentry!="")
                {
                    me.getForm().findField('idtipocomprobante').setValue("");
                    me.getForm().findField('idcomprobante').setValue(0);
                    me.getForm().findField('baseentry').setValue(docentry);
                }
                
                
            }
        });
    }
})
