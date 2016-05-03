
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
    width: 1140,
    listeners: {
        render: function (me, eOpts) {
            idmaster = this.idmaster;

            this.add({
                xtype: 'fieldset',
                autoHeight: true,
                style: 'display:inline-block;text-align:center',
                title: '',
                hideLabel: true,
                width: 1110,
                collapsible: false,
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
                        width: 930,
                        height: 40,
                        collapsible: false,
                        layout: 'column',
                        border: 0,
                        defaults: {
                            flex: 1,
                            hideLabel: false
                        },
                        items: [{
                                xtype: 'label',
                                text: 'Elaborado Por:',
                                style: 'display:inline-block;text-align:left;font-weight:bold;',
                                allowBlank: true,
                                width: 260,
                                readOnly: true
                            },
                            {
                                xtype: 'label',
                                text: 'Actualizado Por:',
                                style: 'display:inline-block;text-align:left;font-weight:bold;',
                                width: 260,
                                readOnly: true
                            },
                            {
                                xtype: 'label',
                                text: 'Liquidado Por:',
                                width: 260,
                                style: 'display:inline-block;text-align:left;font-weight:bold;',
                                readOnly: true
                            },
                            {
                                xtype: 'label',
                                text: 'Cerrado Por:',
                                style: 'display:inline-block;text-align:left;font-weight:bold;',
                                width: 260,
                                readOnly: true
                            },
                            {
                                xtype: 'tbspacer',
                                height: 5,
                                width: 1200
                            },
                            {
                                xtype: 'label',
                                text: '',
                                id: 'creado' + this.idmaster,
                                style: 'display:inline-block;text-align:left;',
                                name: 'creado',
                                width: 260,
                                readOnly: true
                            },
                            {
                                xtype: 'label',
                                text: '',
                                style: 'display:inline-block;text-align:left;',
                                id: 'actualizado' + this.idmaster,
                                name: 'actualizado',
                                width: 260,
                                readOnly: true
                            },
                            {
                                xtype: 'label',
                                text: '',
                                style: 'display:inline-block;text-align:left;',
                                id: 'liquidado' + this.idmaster,
                                name: 'liquidado',
                                width: 260,
                                readOnly: true
                            },
                            {
                                xtype: 'label',
                                text: '',
                                style: 'display:inline-block;text-align:left;',
                                id: 'cerrado' + this.idmaster,
                                name: 'cerrado',
                                width: 260,
                                readOnly: true
                            }
                        ]
                    }]
            }
            );

            // this.add(
            // {
            //buttons: [
            var btnLiquidar = {
                text: 'Liquidar',
                id: 'btnLiquidar' + this.idmaster,
                width: 150,
                columnWidth: 0.2,
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
                                Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');

                        },
                        success: function (response, options) {
                            var res = Ext.decode(response.responseText);
                            ids = res.ids;
                            if (res.success) {
                                Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                if (res.usuarioLiquidado != " ") {
                                    Ext.getCmp("liquidado" + idmaster).setText(res.usuarioLiquidado);
                                    if(Ext.getCmp("btnLiquidar" + idmaster)){
                                        Ext.getCmp("btnLiquidar" + idmaster).setText("Cancelar Liquidacion");
                                    }
                                    if(Ext.getCmp("btnCerrar" + idmaster)){
                                        Ext.getCmp("btnCerrar" + idmaster).show();
                                    }
                                } else {
                                    Ext.getCmp("liquidado" + idmaster).setText(" ");
                                    if(Ext.getCmp("btnLiquidar" + idmaster)){
                                        Ext.getCmp("btnLiquidar" + idmaster).setText("Liquidar");
                                    }
                                    if(Ext.getCmp("btnCerrar" + idmaster)){
                                        Ext.getCmp("btnCerrar" + idmaster).hide();
                                    }
                                }

                            } else {
                                Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                            }
                        }
                    });
                }
            };

            // ]
            //});


            var btnCerrar = {
                text: 'Cerrar',
                width: 150,
                columnWidth: 0.2,
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
                                Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');

                        },
                        success: function (response, options) {
                            var res = Ext.decode(response.responseText);
                            ids = res.ids;
                            if (res.success) {
                                Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                if (res.usuarioCerrado != " ") {

                                    Ext.getCmp("cerrado" + idmaster).setText(res.usuarioCerrado);
                                    if(Ext.getCmp("btnCerrar" + idmaster))
                                        Ext.getCmp("btnCerrar" + idmaster).setText("Abrir");
                                    if(Ext.getCmp("btnLiquidar" + idmaster))
                                        Ext.getCmp("btnLiquidar" + idmaster).hide();

                                } else {
                                    Ext.getCmp("cerrado" + idmaster).setText(" ");
                                    if(Ext.getCmp("btnLiquidar" + idmaster)){
                                        Ext.getCmp("btnLiquidar" + idmaster).show();
                                        Ext.getCmp("btnLiquidar" + idmaster).setText("Cancelar Liquidacion");
                                    }
                                    if(Ext.getCmp("btnCerrar" + idmaster)){
                                        Ext.getCmp("btnCerrar" + idmaster).setText("Cerrar");
                                    }
                                }


                            } else {
                                Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                            }
                        }
                    });
                }
            };
            if (this.permisos.Liquidar == true && this.permisos.Cerrar == true){
                
                var botones = {
                    buttons: [btnLiquidar, btnCerrar]
                };
            }
            if (this.permisos.Liquidar == true && this.permisos.Cerrar == false){
                var botones = {
                    buttons: [btnLiquidar]
                };
            }
            if (this.permisos.Liquidar == false && this.permisos.Cerrar == true){
                var botones = {
                    buttons: [btnCerrar]
                };
            }
            if (this.permisos.Liquidar == false && this.permisos.Cerrar == false){
                var botones = {
                    buttons: []
                };
            }
            
            this.add(
                    botones
            );


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



                    if (Ext.getCmp("liquidado" + idmaster).text != "" && Ext.getCmp("liquidado" + idmaster).text != " ") {
                        
                        if(Ext.getCmp("btnLiquidar" + idmaster))
                            Ext.getCmp("btnLiquidar" + idmaster).setText("Cancelar Liquidacion");
                    } else {
                        Ext.getCmp("btnCerrar" + idmaster).hide();
                    }
                    
                    if (Ext.getCmp("cerrado" + idmaster).text != "" && Ext.getCmp("cerrado" + idmaster).text != " ") {
                        if(Ext.getCmp("btnLiquidar" + idmaster))
                            Ext.getCmp("btnLiquidar" + idmaster).hide();
                        if(Ext.getCmp("btnCerrar" + idmaster))
                        Ext.getCmp("btnCerrar" + idmaster).setText("Abrir");
                    }
                }
            });
        }
    }
})