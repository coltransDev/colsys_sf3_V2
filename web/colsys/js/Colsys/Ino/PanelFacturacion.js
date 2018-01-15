/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




var constrainedWin2, winNotCre = null;
Ext.define('Colsys.Ino.PanelFacturacion', {
    extend: 'Ext.panel.Panel',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFacturacion',
    bodyPadding: 5,
    //layout:'column',
    //columns : 2,
    defaults: {
        //columnWidth: 1/3,
        bodyStyle: 'padding:3,marging:3',
        style: "text-align: left",
        labelAlign: 'right'
    },
    /*items:[
     {
     xtype:'Colsys.Widgets.WgImpoexpo',
     fieldLabel: 'impoexpo',
     id:'fmImpoexpo',
     name:'fmImpoexpo'
     },
     {            
     xtype:'Colsys.Widgets.WgTransporte',
     fieldLabel: 'Transporte',
     id:'fmTransporte',
     name:'fmTransporte'
     }
     ],*/
    onRender: function (ct, position) {

        if(Ext.getCmp('tab' + this.idmaster))
            this.setHeight(Ext.getCmp('tab' + this.idmaster).getHeight() - 130);
        if(this.up('tabpanel').up('tabpanel'))
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 80);
        var me = this;
        if (this.permisos.Crear == true ) {
            tb = new Ext.toolbar.Toolbar();
            tb.add(
                    [{
                        text: 'Agregar',
                        iconCls: 'add',
                        handler: function () {                            
                            this.up('panel').ventanaFac(null,me)
                        }
                    }
                ]);

            tb.add(
            {
                text: 'Recargar',
                iconCls: 'refresh',
                handler: function () {
                    Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                }
            },
            Ext.create('Ext.form.ComboBox', {
                fieldLabel: 'Opciones',
                id:'opcion'+this.idmaster,
                name:'opcion'+this.idmaster,
                store: Ext.create('Ext.data.Store', {
                    fields: ['id', 'name'],
                    data : [
                        {"id":"1", "name":"Generar"},
                        {"id":"2", "name":"Duplicar"},
                        {"id":"3", "name":"Imprimir"}
                    ]
                }),
                width:150,
                labelWidth:50,
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id'
            }),
            {
                xtype: 'button',
                text: 'Enviar',
                handler: function() {
                    
                    var box = Ext.MessageBox.wait('Procesando', 'Enviando Datos')
                    var n = $( ".checked_"+me.idmaster+":checked" );
                    dat="";
                    for(i=0;i<n.length;i++)
                    {
                        if(dat!="")
                            dat+=","
                        dat+=n[i].value;
                        //console.log(n[i].value)
                    }
                    //console.log(dat);
                    opcion=Ext.getCmp("opcion"+me.idmaster).getValue();
                    
                    switch(opcion)
                    {
                        case "1":
                            Ext.Ajax.request({
                                url: '/inoF2/enviarSap',
                                params: {
                                    idcomprobante: "["+dat+"]"
                                },                                
                                success: function (response, opts) {
                                    var obj = Ext.decode(response.responseText);

                                    if (obj.errorInfo != "")
                                        Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                    else
                                        Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();                                    

                                    box.hide();

                                },
                                failure: function (response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                }
                            });
                        break;
                        case "2":
                            Ext.Ajax.request({
                                url: '/inoF2/duplicarComprobante',
                                params: {
                                    idcomprobante: "["+dat+"]"
                                },                                
                                success: function (response, opts) {
                                    var obj = Ext.decode(response.responseText);                                    
                                    if (obj.errorInfo )
                                    {
                                        Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                    }
                                    else
                                    {
                                        Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                                    }
                                    box.hide();

                                },
                                failure: function (response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                }
                            });
                        break;
                        case "3":
                            url="/inocomprobantes/generarComprobantePDF/id/"+"["+dat+"]";
                            window.open(url);
                            box.hide();
                            break;
                    }
                    
                    
                    /*Ext.Ajax.request({
                        url: url,
                        params: {
                            id: "["+dat+"]"
                        },
                        success: function (response, opts) {
                            var obj = Ext.decode(response.responseText);

                            if (obj.errorInfo != "")
                                Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                            else
                                Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                            //this.up().getStore().reload();

                            box.hide();

                        },
                        failure: function (response, opts) {
                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                            box.hide();
                        }
                    });*/
                    
                }
            }
            );
            this.addDocked(tb);
        }
        this.add(
        [
            {
                xtype: 'Colsys.Ino.PanelFactura',
                idmaster: this.idmaster,
                idtransporte: this.idtransporte,
                idimpoexpo: this.idimpoexpo,
                id: 'panel-factura-' + this.idmaster,
                name: 'panel-factura-' + this.idmaster,
                ino:this.ino,
                permisos: this.permisos
            }
        ]);
        



        this.superclass.onRender.call(this, ct, position);
    },
    listeners: {
        beforerender: function (me, opts)
        {
            //this.setHeight(Ext.getCmp('tab'+this.idmaster).getHeight()-190);
            //this.setWidth(this.up('tabpanel').up('tabpanel').getWidth()-80);
        }

    },
    ventanaFac: function (record, tipo)
    {
        //console.log("tipo"+tipo);
        

        if (constrainedWin2 == null)
        {
            constrainedWin2 = Ext.create('Ext.Window', {
                title: 'Factura',
                width: 800,
                //autoHeight: true,
                closeAction: 'destroy',
                //x: 120,
                //y: 120,
                id: "winFormEdit",
                name: "winFormEdit",
                //constrainHeader: true,
                frame: true,
                layout: 'form',
                items: [{
                        xtype: 'Colsys.Ino.FormFactura',
                        id: 'form-panel' + this.idmaster,
                        name: 'form-panel' + this.idmaster,
                        idmaster: this.idmaster,
                        idcomprobante:(record!=null)?record.data.idcomprobante:"0",
                        ino:(tipo.ino)?tipo.ino:false,
                        notacredito:(tipo.permisos.NotasCredito)?tipo.permisos.NotasCredito:false,
                        //ino:true,
                        height: 400,
                        width: 800
                    }],
                listeners: {
                    close: function (win, eOpts) {
                        constrainedWin2 = null;
                    }
                }
            })
        }
        if (record != null)
        {
            Ext.getCmp("form-panel" + this.idmaster).cargar(record.data.idcomprobante);
        } else
            Ext.getCmp("form-panel" + this.idmaster).getForm().reset();
        //if(tipo=="C")
//            Ext.getCmp("form-panel").config(tipo);
        constrainedWin2.show();
    }
})
