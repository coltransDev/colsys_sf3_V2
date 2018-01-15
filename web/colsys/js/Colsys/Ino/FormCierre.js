
/**
 * @autor Felipe Nariño 
 * @return Formulario para Cerrar y Liquidar en INOF2
 * @date:  2016-04-21
 */

Ext.define('Colsys.Ino.FormCierre', {
    extend: 'Ext.form.Panel',
    alias: 'widget.wFormCierre',
    url: '/inoF2/datosCierre',
    bodyPadding: 5,
    listeners: {
        render: function(ct, position){
            idmaster = this.idmaster;
            this.add({
                //xtype: 'fieldset',
                autoHeight: true,
               // defaultType:'label',
                defaults: {
                    
                    labelWidth: 89,
                    anchor: '98%',
                    layout: {
                        type: 'column',
                        defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                    }},
                items: [{
                    xtype: 'fieldcontainer',
                    title: ' ',
                    height: 40,
                    collapsible: false,
                    layout: 'column',
                    border: 0,
                    defaultType:'label',
                    defaults: {
                        flex: 1,
                        hideLabel: false,
                        allowBlank: true,
                        readOnly: true,
                        width: '23%'
                    },
                    items: [{
                            text: 'Elaborado Por:',
                            style: 'display:inline-block;text-align:left;font-weight:bold;'
                        },
                        {
                            text: 'Actualizado Por:',
                            style: 'display:inline-block;text-align:left;font-weight:bold;'
                        },
                        {                        
                            text: 'Liquidado Por:',                            
                            style: 'display:inline-block;text-align:left;font-weight:bold;'
                        },
                        {                            
                            text: 'Cerrado Por:',
                            style: 'display:inline-block;text-align:left;font-weight:bold;'
                        },                        
                        {
                            id: 'creado' + this.idmaster,
                            style: 'display:inline-block;text-align:left;',
                            name: 'creado'
                        },
                        {                        
                            style: 'display:inline-block;text-align:left;',
                            id: 'actualizado' + this.idmaster,
                            name: 'actualizado'
                        },
                        {
                            style: 'display:inline-block;text-align:left;',
                            id: 'liquidado' + this.idmaster,
                            name: 'liquidado'
                        },
                        {
                            style: 'display:inline-block;text-align:left;',
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
                                idmaster = this.up('form').idmaster;
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
                                            if (res.usuarioLiquidado != " ") {
                                                Ext.getCmp("liquidado" + idmaster).setText(res.usuarioLiquidado);                                                    
                                                Ext.getCmp("btnLiquidar" + idmaster).setText("Cancelar Liquidacion");
                                                Ext.getCmp("btnLiquidar" + idmaster).setWidth(150);
                                                Ext.getCmp("btnCerrar" + idmaster).show();
                                            } else {
                                                Ext.getCmp("liquidado" + idmaster).setText("");                                                    
                                                Ext.getCmp("btnLiquidar" + idmaster).setText("Liquidar");
                                                Ext.getCmp("btnLiquidar" + idmaster).setWidth(100);
                                                Ext.getCmp("btnCerrar" + idmaster).hide();
                                            }
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
                            width: 100,                                
                            id: 'btnCerrar' + this.idmaster,
                            handler: function () {
                                opcion = this.getText();
                                idmaster = this.up('form').idmaster;

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
                                        ids = res.ids;
                                        if (res.success) {
                                            Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                            if (res.usuarioCerrado != " ") {

                                                Ext.getCmp("cerrado" + idmaster).setText(res.usuarioCerrado);                                                    
                                                Ext.getCmp("btnCerrar" + idmaster).setText("Abrir");
                                                Ext.getCmp("btnLiquidar" + idmaster).hide();

                                            } else {
                                                Ext.getCmp("cerrado" + idmaster).setText(" ");                                                    
                                                Ext.getCmp("btnLiquidar" + idmaster).show();
                                                Ext.getCmp("btnLiquidar" + idmaster).setText("Cancelar Liquidacion");
                                                Ext.getCmp("btnLiquidar" + idmaster).setWidth(150);
                                                Ext.getCmp("btnCerrar" + idmaster).setText("Cerrar");
                                            }
                                        } else {
                                            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                                        }
                                    }
                                });
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
                    if(me.permisos.Liquidar==true)
                    {
                        if (res.data.liquidado!="" && res.data.cerrado==""  ) {

                            Ext.getCmp("btnLiquidar" + idmaster).show(false);
                            Ext.getCmp("btnCerrar" + idmaster).show(false);
                            Ext.getCmp("btnLiquidar" + idmaster).setText("Cancelar Liquidacion");
                            Ext.getCmp("btnLiquidar" + idmaster).setWidth(150);
                        } 
                        else
                        {
                            //Ext.getCmp("btnLiquidar" + idmaster).setDisabled(false);
                            Ext.getCmp("btnLiquidar" + idmaster).show();
                        }
                    }
                    
                    if(me.permisos.Cerrar==true)
                    {
                        if (res.data.cerrado!="") {
                            Ext.getCmp("btnCerrar" + idmaster).show(false);
                            Ext.getCmp("btnLiquidar" + idmaster).hide();
                            Ext.getCmp("btnCerrar" + idmaster).setText("Abrir");
                        }
                    }
                }
            });
            this.superclass.onRender.call(this, ct, position);
        }
    }
})
