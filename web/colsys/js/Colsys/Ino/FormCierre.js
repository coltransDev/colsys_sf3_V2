
Ext.define('Colsys.Ino.FormCierre', {
    extend: 'Ext.form.Panel',
    alias: 'widget.wFormCierre',
    url: '/inoF2/datosCierre',
    bodyPadding: 1,
    listeners: {
        render: function(ct, position){
            idmaster = this.idmaster;
            this.add({
                autoHeight: true,               
                defaults: {
                    anchor: '98%',
                    layout: {
                        type: 'column',
                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                    }},
                items: [{
                    xtype: 'fieldcontainer',
                    title: ' ',
                    height: 45,
                    collapsible: true,
                    layout: 'column',
                    border: 0,
                    defaultType:'label',
                    defaults: {
                        flex: 1,
                        hideLabel: false,
                        allowBlank: true,
                        readOnly: true,
                        width: '15%'
                    },
                    items: [                        
                        {
                            id: 'creado' + this.idmaster,
                            style: 'display:inline-block;text-align:left;font-size: 10px',
                            name: 'creado'
                        },
                        {                        
                            style: 'display:inline-block;text-align:left;font-size: 10px',
                            id: 'actualizado' + this.idmaster,
                            name: 'actualizado'
                        },
                        {
                            style: 'display:inline-block;text-align:left;font-size: 10px',
                            id: 'liquidado' + this.idmaster,
                            name: 'liquidado'
                        },
                        {
                            style: 'display:inline-block;text-align:left;font-size: 10px',
                            id: 'cerrado' + this.idmaster,
                            name: 'cerrado'
                        },                            
                        {
                            xtype: 'button',
                            text: 'Liquidar',
                            hidden :true,
                            id: 'btnLiquidar' + this.idmaster,
                            width: 100,
                            handler: function () {
                                opcion = this.getText();
                                form=this.up('form');
                                idmaster = form.idmaster;
                                Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '/inoF2/LiquidarReferencia',
                                    params: {
                                        idmaster: idmaster,
                                        opcion: opcion
                                    },
                                    failure: function (response, options) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        if (res.errorInfo)
                                            Ext.MessageBox.alert("Mensaje", 'Error al Liquidar la Referencia');
                                    },
                                    success: function (response, options) {
                                        var res = Ext.decode(response.responseText);
                                        ids = res.ids;
                                        if (res.success){                                            
                                            Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                            
                                            var tabpanel = Ext.getCmp('tabpanel1');
                                            ref=idmaster;
                                            
                                            tabpanel.getChildByElement('tab'+ref).close();                                            
                                            
                                            if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                            {
                                                
                                                res.datos.idmaster=ref;
                                                datos={"title":res.datos.referencia,"id":'tab' + ref,'datos':res.datos};
                                                tabpanel.agregar(datos);
                                            }
                                            tabpanel.setActiveTab('tab' + ref);
                                            
                                        } else {                                            
                                            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>'+res.errorInfo);
                                        }
                                    }
                                });
                            }
                        },
                        {
                            xtype: 'button',
                            text: 'Cerrar',
                           hidden :true,
                            width: 70,                                
                            id: 'btnCerrar' + this.idmaster,
                            handler: function () {
                                var me = this;
                                opcion = this.getText();
                                idmaster = this.up('form').idmaster;
                                me.setDisabled(true);

                                Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '/inoF2/CerrarReferencia',
                                    params: {
                                        idmaster: idmaster,
                                        opcion: opcion
                                    },
                                    failure: function (response, options) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        if (res.errorInfo)
                                            Ext.MessageBox.alert("Mensaje", 'Error al Cerrar la Referencia');
                                    },
                                    success: function (response, options) {
                                        var res = Ext.decode(response.responseText);                                        
                                        if (res.success) {
                                            Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                            
                                            var tabpanel = Ext.getCmp('tabpanel1');
                                            ref=idmaster;
                                            
                                            tabpanel.getChildByElement('tab'+ref).close();                                            
                                            
                                            if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                                            {
                                                res.datos.idmaster=ref;
                                                datos={"title":res.datos.referencia,"id":'tab' + ref,'datos':res.datos};
                                                tabpanel.agregar(datos);
                                            }
                                            tabpanel.setActiveTab('tab' + ref);
                                            me.setDisabled(false);
                                        } else {
                                            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>'+res.errorInfo);
                                        }
                                    }
                                });
                            }
                        },
                        {
                            xtype: 'button',
                            text: '',
                            iconCls: 'building',                            
                            id: 'btnHistorial' + this.idmaster,
                            width: 30,
                            handler: function () {
                                idmaster = this.up('form').idmaster;
                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                    sorc: '/inoF2/verHistorialRef/idmaster/'+idmaster
                                });
                                windowpdf.show();
                            }
                        },
                        {
                            xtype: 'button',
                            text: '',                            
                            id: 'btnSap' + this.idmaster,
                            width: 60,
                            height:24,
                            html: '<img src="/images/icons/sap.jpg"/>',
                            handler: function () {
                                idmaster = this.up('form').idmaster;
                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                    sorc: '/inoF2/verCompSAP/idmaster/'+idmaster
                                });
                                windowpdf.show();
                            }
                        }
                    ]
                }]
            }
            );

            var me=this;
           this.getForm().load({
                params: {
                    idmaster: idmaster
                },
                success: function (a, b) {
                    var res = Ext.util.JSON.decode(b.response.responseText);
                    
                    if (res.data.creado) {
                        Ext.getCmp("creado" + idmaster).setText(res.data.creado);
                    }

                    if (res.data.liquidado) {
                        Ext.getCmp("liquidado" + idmaster).setText(res.data.liquidado);
                    }

                    if (res.data.actualizado) {
                        Ext.getCmp("actualizado" + idmaster).setText(res.data.actualizado);
                    }

                    if (res.data.cerrado) {
                        Ext.getCmp("cerrado" + idmaster).setText(res.data.cerrado);
                    }
                    

                    if(me.permisos.Cerrar==true)
                    {
                        if (res.data.cerrado=="") {                            
                            Ext.getCmp("btnCerrar" + idmaster).setText("Cerrar");
                            Ext.getCmp("btnCerrar" + idmaster).show();
                        }
                    }
                    if(me.permisos.Abrir==true){
                        Ext.getCmp("btnCerrar" + idmaster).show();
                        if (res.data.liquidado!="" && res.data.cerrado==""  ) {
                            Ext.getCmp("btnCerrar" + idmaster).setText("Cerrar");
                        } else if (res.data.liquidado=="" && res.data.cerrado==""  ) {
                            Ext.getCmp("btnCerrar" + idmaster).hide();
                        } else {
                            Ext.getCmp("btnCerrar" + idmaster).setText("Abrir");
                        }
                    }
                    
                    var formCierre = Ext.getCmp("formCierre"+idmaster).down("fieldcontainer"); 
                    var referencia = Ext.getCmp('tab' + idmaster).title;
                    if(res.data.cerrado!=""){
                        formCierre.add({
                            xtype: 'button',
                            text: '',
                            tooltip:'Solicitud apertura de referencia',
                            iconCls: 'open',                            
                            id: 'btnApertura' + this.idmaster,
                            width: 30,
                            handler: function () {
                                idmaster = formCierre.up('form').idmaster;
                                Ext.create('Ext.window.Window', {
                                        title: 'Solicitud Apertura de Referencia',
                                        id: 'window-apertura-'+idmaster,
                                        width: 500,
                                        items: [  // Let's put an empty grid in just to illustrate fit layout
                                            Ext.create('Colsys.Ino.FormAuditoria', {
                                                id:'form-apertura-'+idmaster,
                                                idmaster: idmaster,
                                                idreferencia: referencia,
                                                tipo: 'apertura',
                                                listeners:{
                                                    beforerender: function(ct, position){
                                                        this.getForm().findField("type").setValue("Apertura referencia");
                                                        this.getForm().findField("type").hidden = true;
                                                        this.getForm().findField("status").hidden = true;
                                                        this.getForm().findField("comboHouse").hidden = true;
                                                        this.getForm().findField("assignedto").allowBlank = true;
                                                        this.getForm().findField("assignedto").hidden = true;                                                        
                                                        this.getForm().findField("reportedby").hidden = true;
                                                    }
                                                }
                                            })
                                        ]
                                }).show();
                            }
                        })
                    }else{
                        if(me.permisos.Auditoria && res.data.ningresos == 0){
                            formCierre.add({
                                xtype: 'button',
                                text: '',
                                tooltip:'Autorizaci\u00f3n cierre de referencia',
                                iconCls: 'audit',                            
                                id: 'btnAutorizacion' + this.idmaster,
                                width: 30,
                                handler: function () {
                                    idmaster = formCierre.up('form').idmaster;
                                    Ext.create('Ext.window.Window', {
                                            title: 'Autorizaci\u00f3n cierre de referencia',
                                            id: 'window-autorizacion-'+idmaster,
                                            width: 500,
                                            items: [  // Let's put an empty grid in just to illustrate fit layout
                                                Ext.create('Colsys.Ino.FormAuditoria', {
                                                    id:'form-autorizacion-'+idmaster,
                                                    idmaster: idmaster,
                                                    idreferencia: referencia,
                                                    tipo: 'autorizacion',
                                                    listeners:{
                                                        beforerender: function(ct, position){
                                                            this.getForm().findField("type").setValue("Autorizaci\u00f3n cierre de referencia");
                                                            this.getForm().findField("type").hidden = true;
                                                            this.getForm().findField("status").setValue(4);//Finalizado
                                                            this.getForm().findField("status").hidden = true;
                                                            this.getForm().findField("comboHouse").hidden = true;
                                                            this.getForm().findField("reportedby").fieldLabel = 'Autorizar a';
                                                            this.getForm().findField("assignedto").fieldLabel = 'Autorizado por';
                                                        }
                                                    }
                                                })
                                            ]
                                    }).show();
                                }
                            })
                        }
                    }
                }
            });
            this.superclass.onRender.call(this, ct, position);
        }
    }
});